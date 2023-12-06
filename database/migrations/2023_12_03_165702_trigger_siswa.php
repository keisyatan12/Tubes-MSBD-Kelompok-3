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
        CREATE TRIGGER log_insert_siswa
        AFTER INSERT ON siswas
        FOR EACH ROW
        BEGIN
        INSERT INTO log_siswas(NISN, NIPD, Nama_Siswa, Jenis_Kelamin, Tempat_Lahir, Tanggal_Lahir, Agama, Alamat, No_hp, Status_dlm_Klrg, Nama_Ayah, Nama_Ibu, Pekerjaan_Ayah, Pekerjaan_Ibu, No_Rek_Bank, Bank_Atas_Nama, Status_Siswa, Sekolah_Asal, Anak_Ke, Action, Username, Waktu)
        VALUES (new.NISN, new.NIPD, new.Nama_Siswa, new.Jenis_Kelamin, new.Tempat_Lahir, new.Tanggal_Lahir, new.Agama, new.Alamat, No_hp, Status_dlm_Klrg, Nama_Ayah, Nama_Ibu, Pekerjaan_Ayah, Pekerjaan_Ibu, Bank_Atas_Nama, Status_Siswa, Sekolah_Asal, Anak_Ke, "Insert", "CURRENT_USER()", NOW());
        END
        ');

        DB::unprepared('
        CREATE TRIGGER log_update_siswa
        AFTER update ON siswas
        FOR EACH ROW
        BEGIN
        INSERT INTO log_siswas(NISN, NIPD, Nama_Siswa, Jenis_Kelamin, Tempat_Lahir, Tanggal_Lahir, Agama, Alamat, No_hp, Status_dlm_Klrg, Nama_Ayah, Nama_Ibu, Pekerjaan_Ayah, Pekerjaan_Ibu, No_Rek_Bank, Bank_Atas_Nama, Status_Siswa, Sekolah_Asal, Anak_Ke, Action, Username, Waktu)
        VALUES (new.NISN, new.NIPD, new.Nama_Siswa, new.Jenis_Kelamin, new.Tempat_Lahir, new.Tanggal_Lahir, new.Agama, new.Alamat, No_hp, Status_dlm_Klrg, Nama_Ayah, Nama_Ibu, Pekerjaan_Ayah, Pekerjaan_Ibu, Bank_Atas_Nama, Status_Siswa, Sekolah_Asal, Anak_Ke, "update", "CURRENT_USER()", NOW());
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER log_insert_siswa');
        DB::unprepared('DROP TRIGGER log_update_siswa');
    }
};
