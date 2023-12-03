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
        CREATE TRIGGER log_insert_kip_kps_pip
        AFTER INSERT ON kip_kps_pips
        FOR EACH ROW
        BEGIN
        INSERT INTO log_kip_kps_pips(ID_Status, ID_Siswa, Status_KIP, No_KIP, Status_KPS, No_KPS, Status_Eligible_PIP, Alasan_Eligible_PIP, Action, Username, Waktu)
        VALUES (new.ID_Status, new.ID_Siswa, new.Status_KIP, new.No_KIP, new.Status_KPS, new.No_KPS, new.Status_Eligible_PIP, new.Alasan_Eligible_PIP, "Insert", "CURRENT_USER()", NOW());
        END
        ');

        DB::unprepared('
        CREATE TRIGGER log_update_kip_kps_pip
        AFTER update ON kip_kps_pips
        FOR EACH ROW
        BEGIN
        INSERT INTO log_kip_kps_pips(ID_Status, ID_Siswa, Status_KIP, No_KIP, Status_KPS, No_KPS, Status_Eligible_PIP, Alasan_Eligible_PIP, Action, Username, Waktu)
        VALUES (new.ID_Status, new.ID_Siswa, new.Status_KIP, new.No_KIP, new.Status_KPS, new.No_KPS, new.Status_Eligible_PIP, new.Alasan_Eligible_PIP, "update", "CURRENT_USER()", NOW());
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER log_insert_kip_kps_pip');
        DB::unprepared('DROP TRIGGER log_update_kip_kps_pip');
    }
};
