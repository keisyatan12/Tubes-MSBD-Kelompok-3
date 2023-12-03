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
        CREATE TRIGGER log_insert_rapor
        AFTER INSERT ON rapors
        FOR EACH ROW
        BEGIN
        INSERT INTO log_rapors(ID_Rapor, ID_Nilai, ID_Ekskul_Nilai, Prestasi_ID, Absensi_ID, Absensi_Ekskul, Action, Username, Waktu)
        VALUES (new.ID_Rapor, new.ID_Nilai, new.ID_Ekskul_Nilai, new.Prestasi_ID, new.Absensi_ID, new.Absensi_Ekskul, "Insert", CURRENT_USER(), NOW());
        END
        ');

        DB::unprepared('
        CREATE TRIGGER log_update_rapor
        AFTER update ON rapors
        FOR EACH ROW
        BEGIN
        INSERT INTO log_rapors(ID_Rapor, ID_Nilai, ID_Ekskul_Nilai, Prestasi_ID, Absensi_ID, Absensi_Ekskul, Action, Username, Waktu)
        VALUES (new.ID_Rapor, new.ID_Nilai, new.ID_Ekskul_Nilai, new.Prestasi_ID, new.Absensi_ID, new.Absensi_Ekskul, "update", CURRENT_USER(), NOW());
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER log_insert_rapor');
        DB::unprepared('DROP TRIGGER log_update_rapor');
    }
};
