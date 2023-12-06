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
        CREATE TRIGGER log_insert_kepala_sekolah
        AFTER INSERT ON kepala_sekolahs
        FOR EACH ROW
        BEGIN
        INSERT INTO log_kepala_sekolahs(ID_Kepsek, Nama_Kepsek, Jenis_Kelamin, Tempat_Lahir, Tanggal_Lahir, Jenjang_Pendidikan, TMT_Kerja, Status, Action, Username, Waktu)
        VALUES (new.ID_Kepsek, new.Nama_Kepsek, new.Jenis_Kelamin, new.Tempat_Lahir, new.Tanggal_Lahir, new.Jenjang_Pendidikan, new.TMT_Kerja, new.Status, "Insert", CURRENT_USER(), NOW());
        END
        ');

        DB::unprepared('
        CREATE TRIGGER log_update_kepala_sekolah
        AFTER update ON kepala_sekolahs
        FOR EACH ROW
        BEGIN
        INSERT INTO log_kepala_sekolahs(ID_Kepsek, Nama_Kepsek, Jenis_Kelamin, Tempat_Lahir, Tanggal_Lahir, Jenjang_Pendidikan, TMT_Kerja, Status, Action, Username, Waktu)
        VALUES (new.ID_Kepsek, new.Nama_Kepsek, new.Jenis_Kelamin, new.Tempat_Lahir, new.Tanggal_Lahir, new.Jenjang_Pendidikan, new.TMT_Kerja, new.Status, "update", CURRENT_USER(), NOW());
        END
        ');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER log_insert_kepala_sekolah');
        DB::unprepared('DROP TRIGGER log_update_kepala_sekolah');
    }
};
