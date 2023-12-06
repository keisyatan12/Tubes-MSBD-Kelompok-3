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
        CREATE TRIGGER log_insert_tata_usaha
        AFTER INSERT ON tata_usahas
        FOR EACH ROW
        BEGIN
        INSERT INTO log_tata_usahas(ID_Pegawai, Nama_Pegawai, Jenis_Kelamin, TMT_Kerja, Tempat_Lahir, Tanggal_Lahir, Jenjang_Pendidikan, Status, Action, Username, Waktu)
        VALUES (new.ID_Pegawai, new.Nama_Pegawai, new.Jenis_Kelamin, new.TMT_Kerja, new.Tempat_Lahir, new.Tanggal_Lahir, new.Jenjang_Pendidikan, new.Status, "Insert", "CURRENT_USER()", NOW());
        END
        ');

        DB::unprepared('
        CREATE TRIGGER log_update_tata_usaha
        AFTER update ON tata_usahas
        FOR EACH ROW
        BEGIN
        INSERT INTO log_tata_usahas(ID_Pegawai, Nama_Pegawai, Jenis_Kelamin, TMT_Kerja, Tempat_Lahir, Tanggal_Lahir, Jenjang_Pendidikan, Status, Action, Username, Waktu)
        VALUES (new.ID_Pegawai, new.Nama_Pegawai, new.Jenis_Kelamin, new.TMT_Kerja, new.Tempat_Lahir, new.Tanggal_Lahir, new.Jenjang_Pendidikan, new.Status, "update", "CURRENT_USER()", NOW());
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER log_insert_tata_usaha');
        DB::unprepared('DROP TRIGGER log_update_tata_usaha');
    }
};
