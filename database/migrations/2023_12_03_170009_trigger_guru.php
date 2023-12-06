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
        CREATE TRIGGER log_insert_guru
        AFTER INSERT ON guruses
        FOR EACH ROW
        BEGIN
        INSERT INTO log_guruses(NUPTK, NIP, Nama_Guru, Jenis_Kelamin, Tempat_Lahir, Tanggal_Lahir, Status_Kepegawaian, Jenis_PTK, Jenjang_Pendidikan, TMT_Kerja, JJM, Status, Action, Username, Waktu)
        VALUES (new.NUPTK, new.NIP, new.Nama_Guru, new.Jenis_Kelamin, new.Tempat_Lahir, new.Tanggal_Lahir, new.Status_Kepegawaian, new.Jenis_PTK, new.Jenjang_Pendidikan, new.TMT_Kerja, new.JJM, new.Status, "Insert", CURRENT_USER(), NOW());
        END
        ');

        DB::unprepared('
        CREATE TRIGGER log_update_guru
        AFTER update ON guruses
        FOR EACH ROW
        BEGIN
        INSERT INTO log_guruses(NUPTK, NIP, Nama_Guru, Jenis_Kelamin, Tempat_Lahir, Tanggal_Lahir, Status_Kepegawaian, Jenis_PTK, Jenjang_Pendidikan, TMT_Kerja, JJM, Status, Action, Username, Waktu)
        VALUES (new.NUPTK, new.NIP, new.Nama_Guru, new.Jenis_Kelamin, new.Tempat_Lahir, new.Tanggal_Lahir, new.Status_Kepegawaian, new.Jenis_PTK, new.Jenjang_Pendidikan, new.TMT_Kerja, new.JJM, new.Status, "update", CURRENT_USER(), NOW());
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER log_insert_guru');
        DB::unprepared('DROP TRIGGER log_update_guru');
    }
};
