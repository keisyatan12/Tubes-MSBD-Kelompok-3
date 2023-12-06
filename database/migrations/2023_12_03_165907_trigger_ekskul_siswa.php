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
        CREATE TRIGGER log_insert_ekskul_siswa
        AFTER INSERT ON ekskul_siswas
        FOR EACH ROW
        BEGIN
        INSERT INTO log_ekskul_siswas(ID_Ekskul_Siswa, Ekskul_Kode, Siswa_ID, Thn_Ajaran, Action, Username, Waktu)
        VALUES (new.ID_Ekskul_Siswa, new.Ekskul_Kode, new.Siswa_ID, new.Thn_Ajaran, "Insert", CURRENT_USER(), NOW());
        END
        ');

        DB::unprepared('
        CREATE TRIGGER log_update_ekskul_siswa
        AFTER update ON ekskul_siswas
        FOR EACH ROW
        BEGIN
        INSERT INTO log_ekskul_siswas(ID_Ekskul_Siswa, Ekskul_Kode, Siswa_ID, Thn_Ajaran, Action, Username, Waktu)
        VALUES (new.ID_Ekskul_Siswa, new.Ekskul_Kode, new.Siswa_ID, new.Thn_Ajaran, "update", CURRENT_USER(), NOW());
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER log_insert_ekskul_siswa');
        DB::unprepared('DROP TRIGGER log_update_ekskul_siswa');
    }
};
