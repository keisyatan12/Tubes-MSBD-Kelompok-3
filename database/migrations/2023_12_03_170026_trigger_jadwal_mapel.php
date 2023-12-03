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
        CREATE TRIGGER log_insert_jadwal_mapel
        AFTER INSERT ON jadwal_mapelS
        FOR EACH ROW
        BEGIN
        INSERT INTO log_jadwal_mapelS(ID_Jadwal, Kelas_ID, Kode_Mapel, Thn_Ajaran_ID, Waktu_Mulai, Waktu_Selesai, Hari, Action, Username, Waktu)
        VALUES (new.ID_Jadwal, new.Kelas_ID, new.Kode_Mapel, new.Thn_Ajaran_ID, new.Waktu_Mulai, new.Waktu_Selesai, new.Hari, "Insert", "CURRENT_USER()", NOW());
        END
        ');

        DB::unprepared('
        CREATE TRIGGER log_update_jadwal_mapel
        AFTER update ON jadwal_mapelS
        FOR EACH ROW
        BEGIN
        INSERT INTO log_jadwal_mapelS(ID_Jadwal, Kelas_ID, Kode_Mapel, Thn_Ajaran_ID, Waktu_Mulai, Waktu_Selesai, Hari, Action, Username, Waktu)
        VALUES (new.ID_Jadwal, new.Kelas_ID, new.Kode_Mapel, new.Thn_Ajaran_ID, new.Waktu_Mulai, new.Waktu_Selesai, new.Hari, "update", "CURRENT_USER()", NOW());
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER log_insert_jadwal_mapel');
        DB::unprepared('DROP TRIGGER log_update_jadwal_mapel');
    }
};
