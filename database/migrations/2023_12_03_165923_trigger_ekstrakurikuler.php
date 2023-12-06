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
        CREATE TRIGGER log_insert_ekstrakurikuler
        AFTER INSERT ON ekstrakurikulers
        FOR EACH ROW
        BEGIN
        INSERT INTO log_ekstrakurikulers(Kode_ekskul, Nama_Ekskul, Guru_Ekskul, Hari, Waktu_Mulai, Waktu_Selesai, Action, Username, Waktu)
        VALUES (new.Kode_ekskul, new.Nama_Ekskul, new.Guru_Ekskul, new.Hari, new.Waktu_Mulai, new.Waktu_Selesai, "Insert", "CURRENT_USER()", NOW());
        END
        ');

        DB::unprepared('
        CREATE TRIGGER log_update_ekstrakurikuler
        AFTER update ON ekstrakurikulers
        FOR EACH ROW
        BEGIN
        INSERT INTO log_ekstrakurikulers(Kode_ekskul, Nama_Ekskul, Guru_Ekskul, Hari, Waktu_Mulai, Waktu_Selesai, Action, Username, Waktu)
        VALUES (new.Kode_ekskul, new.Nama_Ekskul, new.Guru_Ekskul, new.Hari, new.Waktu_Mulai, new.Waktu_Selesai, "update", "CURRENT_USER()", NOW());
        END
        ');

        DB::unprepared('
        CREATE TRIGGER log_delete_ekstrakurikuler
        AFTER delete ON ekstrakurikulers
        FOR EACH ROW
        BEGIN
        INSERT INTO log_ekstrakurikulers(Kode_ekskul, Nama_Ekskul, Guru_Ekskul, Hari, Waktu_Mulai, Waktu_Selesai, Action, Username, Waktu)
        VALUES (old.Kode_ekskul, old.Nama_Ekskul, old.Guru_Ekskul, old.Hari, nold.Waktu_Mulai, old.Waktu_Selesai, "delete", "CURRENT_USER()", NOW());
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER log_insert_ekstrakurikuler');
        DB::unprepared('DROP TRIGGER log_update_ekstrakurikuler');
        DB::unprepared('DROP TRIGGER log_delete_ekstrakurikuler');
    }
};
