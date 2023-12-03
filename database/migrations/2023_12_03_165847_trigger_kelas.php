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
        CREATE TRIGGER log_insert_kelas
        AFTER INSERT ON kelas
        FOR EACH ROW
        BEGIN
        INSERT INTO log_kelas(ID_Kelas, Wali_Kelas, Nama_Kelas, Tingkatan, Kelompok_Kelas, Action, Username, Waktu)
        VALUES (new.ID_Kelas, new.Wali_Kelas, new.Nama_Kelas, new.Tingkatan, new.Kelompok_Kelas, "Insert", "CURRENT_USER()", NOW());
        END
        ');

        DB::unprepared('
        CREATE TRIGGER log_update_kelas
        AFTER update ON kelas
        FOR EACH ROW
        BEGIN
        INSERT INTO log_kelas(ID_Kelas, Wali_Kelas, Nama_Kelas, Tingkatan, Kelompok_Kelas, Action, Username, Waktu)
        VALUES (new.ID_Kelas, new.Wali_Kelas, new.Nama_Kelas, new.Tingkatan, new.Kelompok_Kelas, "update", "CURRENT_USER()", NOW());
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER log_insert_kelas');
        DB::unprepared('DROP TRIGGER log_update_kelas');
    }
};
