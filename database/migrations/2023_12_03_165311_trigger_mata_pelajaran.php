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
        CREATE TRIGGER log_insert_mata_pelajaran
        AFTER INSERT ON mata_pelajarans
        FOR EACH ROW
        BEGIN
        INSERT INTO log_mata_pelajarans(Kode_Mapel, Nama_Mapel, KKM, Guru_Mapel, Action, Username, Waktu)
        VALUES (new.Kode_Mapel, new.Nama_Mapel, new.KKM, new.Guru_Mapel, "Insert", "CURRENT_USER()", NOW());
        END
        ');

        DB::unprepared('
        CREATE TRIGGER log_update_mata_pelajaran
        AFTER update ON mata_pelajarans
        FOR EACH ROW
        BEGIN
        INSERT INTO log_mata_pelajarans(Kode_Mapel, Nama_Mapel, KKM, Guru_Mapel, Action, Username, Waktu)
        VALUES (new.Kode_Mapel, new.Nama_Mapel, new.KKM, new.Guru_Mapel, "update", "CURRENT_USER()", NOW());
        END
        ');

        DB::unprepared('
        CREATE TRIGGER log_delete_mata_pelajaran
        AFTER delete ON mata_pelajarans
        FOR EACH ROW
        BEGIN
        INSERT INTO log_mata_pelajarans(Kode_Mapel, Nama_Mapel, KKM, Guru_Mapel, Action, Username, Waktu)
        VALUES (old.Kode_Mapel, old.Nama_Mapel, old.KKM, old.Guru_Mapel, "delete", "CURRENT_USER()", NOW());
        END
        ');
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER log_insert_mata_pelajaran');
        DB::unprepared('DROP TRIGGER log_update_mata_pelajaran');
        DB::unprepared('DROP TRIGGER log_delete_mata_pelajaran');
    }
};
