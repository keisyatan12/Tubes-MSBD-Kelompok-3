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
        CREATE TRIGGER log_insert_nilai
        AFTER INSERT ON nilais
        FOR EACH ROW
        BEGIN
        INSERT INTO log_nilais(Nilai_ID, Kode_Mapel, Siswa_ID, Thn_Ajaran, Jenis, Nilai_Pengetahuan, Nilai_Keterampilan, Action, Username, Waktu)
        VALUES (new.Nilai_ID, new.Kode_Mapel, new.Siswa_ID, new.Thn_Ajaran, new.Jenis, new.Nilai_Pengetahuan, new.Nilai_Keterampilan, "Insert", "CURRENT_USER()", NOW());
        END
        ');

        DB::unprepared('
        CREATE TRIGGER log_update_nilai
        AFTER update ON nilais
        FOR EACH ROW
        BEGIN
        INSERT INTO log_nilais(Nilai_ID, Kode_Mapel, Siswa_ID, Thn_Ajaran, Jenis, Nilai_Pengetahuan, Nilai_Keterampilan, Action, Username, Waktu)
        VALUES (new.Nilai_ID, new.Kode_Mapel, new.Siswa_ID, new.Thn_Ajaran, new.Jenis, new.Nilai_Pengetahuan, new.Nilai_Keterampilan, "update", "CURRENT_USER()", NOW());
        END
        ');

        DB::unprepared('
        CREATE TRIGGER validasi_update_nilai
        BEFORE update ON nilais
        FOR EACH ROW
        BEGIN
        IF (NEW.nilai_keterampilan < 0 AND NEW.nilai_pengetahuan < 0 ) THEN
        SET NEW.nilai_keterampilan = 0;
        SET NEW.nilai_pengetahuan = 0;
        ELSEIF(NEW.nilai_pengetahuan < 0 ) THEN
        SET NEW.nilai_pengetahuan = 0;
        ELSEIF (NEW.nilai_keterampilan < 0 ) THEN
        SET NEW.nilai_keterampilan = 0;
        ELSEIF (NEW.nilai_pengetahuan > 100 OR NEW.nilai_keterampilan > 100) THEN
        SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "Error Nilai tidak dapat lebih dari 100";
        END IF;
        END
        ');

        DB::unprepared('
        CREATE TRIGGER validasi_input_nilai
        BEFORE INSERT ON nilais
        FOR EACH ROW
        BEGIN
        IF (NEW.nilai_keterampilan < 0 AND NEW.nilai_pengetahuan < 0 ) THEN
        SET NEW.nilai_keterampilan = 0;
        SET NEW.nilai_pengetahuan = 0;
        ELSEIF(NEW.nilai_pengetahuan < 0 ) THEN
        SET NEW.nilai_pengetahuan = 0;
        ELSEIF (NEW.nilai_keterampilan < 0 ) THEN
        SET NEW.nilai_keterampilan = 0;
        ELSEIF (NEW.nilai_pengetahuan > 100 OR NEW.nilai_keterampilan > 100) THEN
        SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "Error Nilai tidak dapat lebih dari 100";
        END IF;
        END
        ');
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER log_insert_nilai');
        DB::unprepared('DROP TRIGGER log_update_nilai');
        DB::unprepared('DROP TRIGGER validasi_input_nilai');
        DB::unprepared('DROP TRIGGER validasi_update_nilai');
    }
};
