<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema
;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE function durasi_bekerja( TMT_Kerja DATE)
            RETURNS INT
            BEGIN
            DECLARE Durasi INT;
            SET Durasi = YEAR(NOW()) - YEAR(TMT_Kerja);
            RETURN Durasi;
            END
        ');

        DB::unprepared('
        CREATE function nilai_tengah_semester(
            kodeMapel CHAR(5), idSiswa INT(10), tahun_ajaran INT(11))
            RETURNS DECIMAL(5,2)
            BEGIN
            DECLARE nilai_tengah_semester DECIMAL(5, 2);
            SELECT
            SUM(
                CASE WHEN jenis = "f1" THEN nilai_pengetahuan ELSE 0 END +
                CASE WHEN jenis = "f2" THEN nilai_pengetahuan ELSE 0 END +
                CASE WHEN jenis = "f3" THEN nilai_pengetahuan ELSE 0 END +
                CASE WHEN jenis = "uts" THEN nilai_pengetahuan ELSE 0 END
                ) INTO nilai_tengah_semester
            FROM nilai
            WHERE id_siswa = idSiswa AND kode_mapel = kodeMapel AND Thn_Ajaran = tahun_ajaran;
            RETURN nilai_tengah_semester / 4;
            END 
        ');

        DB::unprepared('
        CREATE FUNCTION nilai_akhir_semester(
            kodeMapel CHAR(5), idSiswa INT(10), tahun_ajaran INT(11))
            RETURNS DECIMAL(5,2)
            BEGIN
            DECLARE nilai_akhir_semester DECIMAL(5, 2);
            SELECT
            SUM(
                CASE WHEN jenis = "uas" THEN nilai_pengetahuan ELSE 0 END +
                CASE WHEN jenis IN ("F1", "F2", "F3", "uts") THEN nilai_tengah_semester(kodeMapel, idSiswa, tahun_ajaran) ELSE 0 END 
            ) INTO nilai_akhir_semester
            FROM nilai
            WHERE id_siswa = idSiswa AND kode_mapel = kodeMapel AND Thn_Ajaran = tahun_ajaran;
            RETURN nilai_akhir_semester / 5;
            END
        ');

        DB::unprepared('
        CREATE function indeks_nilai_ekskul(nilai INT)
        RETURNS VARCHAR(2)
        BEGIN
        DECLARE indeks VARCHAR(2);
        IF nilai >=90 THEN
        SET indeks = "A";
        ELSEIF nilai>= 80 THEN
        SET INDEKS = "B";
        ELSEIF nilai>= 70 THEN
        SET INDEKS = "C";
        ELSEIF nilai>= 60 THEN
        SET INDEKS = "D";
        ELSE
        SET INDEKS = "E";
        END IF;
        RETURN indeks;
        END
        ');

        DB::unprepared('
        CREATE FUNCTION indeks_rapor(idSiswa INT(10), kodeMapel CHAR(5), tahun_ajaran INT)
        RETURNS VARCHAR(2)
        BEGIN
        DECLARE nilai_rapor DECIMAL(5, 2);
        DECLARE indeks VARCHAR(2);
        SET nilai_rapor = nilai_akhir_semester(kodeMapel, idSiswa, tahun_ajaran);
        IF nilai_rapor >=90 THEN
        SET indeks = "A";
        ELSEIF nilai_rapor>= 80 THEN
        SET indeks = "B";
        ELSEIF nilai_rapor>= 70 THEN
        SET indeks = "C";
        ELSEIF nilai_rapor>= 60 THEN
        SET indeks = "D";
        ELSE
        SET indeks = "E";
        END IF;
        RETURN indeks;
        END
        ');

        DB::unprepared('
        CREATE FUNCTION time_status(
            start DATETIME,
            end DATETIME)
            RETURNS CHAR(7)
            BEGIN
            DECLARE status CHAR(7);
            IF start > NOW() THEN
            SET status = "inaktif";
            ELSEIF start <= NOW() AND end >= NOW() THEN
            SET status = "aktif";
            ELSE
            SET status = "berakhir";
            END IF;
            RETURN status;
            END
        ');
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP FUNCTION durasi_bekerja');
        DB::unprepared('DROP FUNCTION nilai_tengah_semester');
        DB::unprepared('DROP FUNCTION nilai_akhir_semester');
        DB::unprepared('DROP FUNCTION time_status');
        DB::unprepared('DROP FUNCTION indeks_rapor');
        DB::unprepared('DROP FUNCTION indeks_nilai_ekskul');
    }
};
