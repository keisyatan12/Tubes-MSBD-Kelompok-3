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
        CREATE TRIGGER log_insert_wali_siswa
        AFTER INSERT ON wali_siswas
        FOR EACH ROW
        BEGIN
        INSERT INTO log_wali_siswas(ID_Wali, Nama_Wali, ID_Siswa, Pekerjaan_Wali, No_Rek_Bank, Bank_Atas_Nama, Action, Username, Waktu)
        VALUES (new.ID_Wali, new.Nama_Wali, new.ID_Siswa, new.Pekerjaan_Wali, new.No_Rek_Bank, new.Bank_Atas_Nama, "Insert", "CURRENT_USER()", NOW());
        END
        ');

        DB::unprepared('
        CREATE TRIGGER log_update_wali_siswa
        AFTER update ON wali_siswas
        FOR EACH ROW
        BEGIN
        INSERT INTO log_wali_siswas(ID_Wali, Nama_Wali, ID_Siswa, Pekerjaan_Wali, No_Rek_Bank, Bank_Atas_Nama, Action, Username, Waktu)
        VALUES (new.ID_Wali, new.Nama_Wali, new.ID_Siswa, new.Pekerjaan_Wali, new.No_Rek_Bank, new.Bank_Atas_Nama, "update", "CURRENT_USER()", NOW());
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER log_insert_wali_siswa');
        DB::unprepared('DROP TRIGGER log_update_wali_siswa');
    }
};
