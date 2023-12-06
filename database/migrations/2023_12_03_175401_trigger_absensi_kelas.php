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
        /* log_insert_absensi_ekskul */
        DB::unprepared('
        CREATE TRIGGER log_insert_absensi_kelas
        AFTER INSERT ON absensi_kelas
        FOR EACH ROW
        BEGIN
        INSERT INTO log_absensi_kelas(ID_Absensi, Siswa_ID, Kelas, Tanggal, Hadir, Izin, Alpa, Sakit, Action, Username, Waktu)
        VALUES (NEW.ID_Absensi, NEW.Siswa_ID, NEW.Kelas, NEW.Tanggal, NEW.Hadir, NEW.Izin, NEW.Alpa, NEW.Sakit, "Insert", CURRENT_USER(), NOW());
        END
        ');

        /* log_update_absensi_ekskul */
        DB::unprepared('
        CREATE TRIGGER log_update_absensi_kelas
        AFTER update ON absensi_kelas
        FOR EACH ROW
        BEGIN
        INSERT INTO log_absensi_kelas(ID_Absensi, Siswa_ID, Kelas, Tanggal, Hadir, Izin, Alpa, Sakit, Action, Username, Waktu)
        VALUES (NEW.ID_Absensi, NEW.Siswa_ID, NEW.Kelas, NEW.Tanggal, NEW.Hadir, NEW.Izin, NEW.Alpa, NEW.Sakit, "update", CURRENT_USER(), NOW());
        END
        ');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER log_insert_absensi_kelas');
        DB::unprepared('DROP TRIGGER log_update_absensi_kelas');
    }
};
