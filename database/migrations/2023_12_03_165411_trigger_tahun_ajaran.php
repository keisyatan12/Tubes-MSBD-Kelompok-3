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
        CREATE TRIGGER validasi_update_tahun_ajaran
        BEFORE update ON tahun_ajarans
        FOR EACH ROW
        BEGIN
        DECLARE status CHAR(7);
        SET status = time_status(NEW.tanggal_mulai, NEW.tanggal_selesai);
        IF status = "aktif" THEN
        IF NEW.tanggal_mulai <> OLD.tanggal_mulai THEN
            SIGNAL SQLSTATE "45000"
            SET MESSAGE_TEXT = "TAHUN AJARAN SEDANG BERJALAN";
        ELSEIF NEW.tanggal_selesai <= NOW() THEN
            SIGNAL SQLSTATE "45000"
            SET MESSAGE_TEXT = "Tanggal Selesai tidak dapat lebih dari tanggal sekarang";
        END IF;
        ELSEIF status = "inaktif" THEN
            SIGNAL SQLSTATE "45000"
            SET MESSAGE_TEXT = "Tidak dapat mengubah tahun ajaran";
        END IF;
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER validasi_update_tahun_ajaran');
    }
};
