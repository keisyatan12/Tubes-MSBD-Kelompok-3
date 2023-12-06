<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
        CREATE TRIGGER log_insert_nilai_ekskul
        AFTER INSERT ON nilai_ekskuls
        FOR EACH ROW
        BEGIN
        INSERT INTO log_nilai_ekskuls(ID_Nilai_Ekskul, ID_Ekskul_Siswa, Nilai, Action, Username, Waktu)
        VALUES (new.ID_Nilai_Ekskul, new.ID_Ekskul_Siswa, new.Nilai, "Insert", "CURRENT_USER()", NOW());
        END
        ');

        DB::unprepared('
        CREATE TRIGGER log_update_nilai_ekskul
        AFTER update ON nilai_ekskuls
        FOR EACH ROW
        BEGIN
        INSERT INTO log_nilai_ekskuls(ID_Nilai_Ekskul, ID_Ekskul_Siswa, Nilai, Action, Username, Waktu)
        VALUES (new.ID_Nilai_Ekskul, new.ID_Ekskul_Siswa, new.Nilai, "update", "CURRENT_USER()", NOW());
        END
        ');

        DB::unprepared('
        CREATE TRIGGER validasi_update_nilai_ekskul
        AFTER update ON nilai_ekskuls
        FOR EACH ROW
        BEGIN
        IF NEW.nilai > 100 THEN
        SIGNAL SQLSTATE "45000"
        SET MESSAGE_TEXT = "Error Nilai tidak dapat lebih dari 100";
        END IF;
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER log_insert_nilai_ekskul');
        DB::unprepared('DROP TRIGGER log_update_nilai_ekskul');
        DB::unprepared('DROP TRIGGER validasi_update_nilai_ekskul');
    }
};
