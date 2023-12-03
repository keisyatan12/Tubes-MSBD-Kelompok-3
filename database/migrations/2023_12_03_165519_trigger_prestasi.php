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
        CREATE TRIGGER log_insert_prestasi
        AFTER INSERT ON prestasis
        FOR EACH ROW
        BEGIN
        INSERT INTO log_prestasis(ID_Prestasi, Siswa, Jenis_Prestasi, Deskripsi, Tanggal, Action, Username, Waktu)
        VALUES (new.ID_Prestasi, new.Siswa, new.Jenis_Prestasi, new.Deskripsi, new.Tanggal, "Insert", CURRENT_USER(), NOW());
        END
        ');

        DB::unprepared('
        CREATE TRIGGER log_update_prestasi
        AFTER update ON prestasis
        FOR EACH ROW
        BEGIN
        INSERT INTO log_prestasis(ID_Prestasi, Siswa, Jenis_Prestasi, Deskripsi, Tanggal, Action, Username, Waktu)
        VALUES (new.ID_Prestasi, new.Siswa, new.Jenis_Prestasi, new.Deskripsi, new.Tanggal, "update", CURRENT_USER(), NOW());
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER log_insert_prestasi');
        DB::unprepared('DROP TRIGGER log_update_prestasi');
    }
};
