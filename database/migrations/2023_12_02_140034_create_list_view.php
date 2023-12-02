<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::statement("

        CREATE VIEW list_guru_aktif AS
        SELECT *
        FROM guruses
        WHERE Status = 'Aktif'
        ");

        DB::statement("
        
        CREATE VIEW guru_non_aktif AS
        SELECT *
        FROM guruses
        WHERE Status <> 'Aktif';
        ");

        DB::statement("
    
        CREATE VIEW list_siswa_aktif AS
        SELECT *
        FROM siswas
        WHERE Status_Siswa = 'Aktif';
        ");


        DB::statement("

        CREATE VIEW siswa_inactive AS
        SELECT *
        FROM siswas
        WHERE Status_Siswa != 'Aktif';   
        ");



        DB::statement("

        CREATE VIEW list_ekstrakurikuler AS
        SELECT
             e.Kode_Ekskul,
             e.Nama_Ekskul,
            e.Hari,
            e.Waktu_Mulai,
            e.Waktu_Selesai,
            g.Nama_Guru AS Guru_Ekskul
        FROM ekstrakurikulers e
        INNER JOIN guruses g ON e.Guru_Ekskul = g.NUPTK;            
        ");


            DB::statement("
            CREATE VIEW detail_nilai AS
            SELECT 
                n.*,
                mp.Nama_Mapel,
                mp.KKM,
                g.NUPTK,
                g.Nama_Guru,
                s.NISN,
                s.Nama_Siswa,
                ta.Thn_Ajaran AS Tahun_Ajaran,
                ta.Semester
            FROM nilais n
            JOIN mata_pelajarans mp ON n.Kode_Mapel = mp.Kode_Mapel
            JOIN guruses g ON mp.Guru_Mapel = g.NUPTK
            JOIN siswas s ON n.Siswa_ID = s.NISN
            JOIN tahun_ajarans ta ON n.Thn_Ajaran = ta.ID_Thn_Ajaran;
                    
                    ");


        DB::statement("
    
        CREATE VIEW info_nilai_ekskul AS
        SELECT 
            ne.ID_Nilai_Ekskul,
            ne.ID_Ekskul_Siswa,
            ne.Nilai,
            es.Ekskul_Kode,
            es.Siswa_ID,
            s.Nama_Siswa,
            ek.Nama_Ekskul,
            ek.Guru_Ekskul,
            g.Nama_Guru,
            ta.Thn_Ajaran,
            ta.Semester
        FROM nilai_ekskuls ne
        JOIN ekskul_siswas es ON ne.ID_Ekskul_Siswa = es.ID_Ekskul_Siswa
        JOIN ekstrakurikulers ek ON es.Ekskul_Kode = ek.Kode_Ekskul
        JOIN guruses g ON ek.Guru_Ekskul = g.NUPTK
        JOIN siswas s ON es.Siswa_ID = s.NISN
        JOIN tahun_ajarans ta ON es.Thn_Ajaran = ta.ID_Thn_Ajaran;
                ");


        DB::statement("

        CREATE VIEW detail_prestasi AS
        SELECT 
            p.ID_Prestasi,
            s.NISN,
            s.Nama_Siswa,
            p.Jenis_Prestasi,
            p.Deskripsi,
            p.Tanggal
        FROM prestasis p
        JOIN siswas s ON p.Siswa = s.NISN;
        
        ");


        DB::statement("

        CREATE VIEW View_Nilai_F1 AS
        SELECT n.Nilai_ID, n.Kode_Mapel, n.Siswa_ID, n.Thn_Ajaran, n.Nilai_Pengetahuan, n.Nilai_Keterampilan, g.Nama_Guru
        FROM nilais n
        JOIN mata_pelajarans m ON n.Kode_Mapel = m.Kode_Mapel
        JOIN guruses g ON m.Guru_Mapel = g.NUPTK
        WHERE n.Jenis = 'F1';
        
        ");

        DB::statement("

        CREATE VIEW View_Nilai_F2 AS
        SELECT n.Nilai_ID, n.Kode_Mapel, n.Siswa_ID, n.Thn_Ajaran, n.Nilai_Pengetahuan, n.Nilai_Keterampilan, g.Nama_Guru
        FROM nilais n
        JOIN mata_pelajarans m ON n.Kode_Mapel = m.Kode_Mapel
        JOIN guruses g ON m.Guru_Mapel = g.NUPTK
        WHERE n.Jenis = 'F2';
        
        ");


        DB::statement("
    
    
        CREATE VIEW View_Nilai_F3 AS
        SELECT n.Nilai_ID, n.Kode_Mapel, n.Siswa_ID, n.Thn_Ajaran, n.Nilai_Pengetahuan, n.Nilai_Keterampilan, g.Nama_Guru
        FROM nilais n
        JOIN mata_pelajarans m ON n.Kode_Mapel = m.Kode_Mapel
        JOIN guruses g ON m.Guru_Mapel = g.NUPTK
        WHERE n.Jenis = 'F3';
    
        ");


        DB::statement("
        
        CREATE VIEW View_Nilai_UTS AS
        SELECT n.Nilai_ID, n.Kode_Mapel, n.Siswa_ID, n.Thn_Ajaran, n.Nilai_Pengetahuan, n.Nilai_Keterampilan, g.Nama_Guru
        FROM nilais n
        JOIN mata_pelajarans m ON n.Kode_Mapel = m.Kode_Mapel
        JOIN guruses g ON m.Guru_Mapel = g.NUPTK
        WHERE n.Jenis = 'UTS';
        ");


        DB::statement("
    
        CREATE VIEW View_Nilai_UAS AS

        SELECT n.Nilai_ID, n.Kode_Mapel, n.Siswa_ID, n.Thn_Ajaran, n.Nilai_Pengetahuan, n.Nilai_Keterampilan, g.Nama_Guru
        FROM nilais n
        JOIN mata_pelajarans m ON n.Kode_Mapel = m.Kode_Mapel
        JOIN guruses g ON m.Guru_Mapel = g.NUPTK
        WHERE n.Jenis = 'UAS';
        ");

        DB::statement("
        CREATE VIEW roster AS
        SELECT jm.ID_Jadwal, k.Nama_Kelas, k.Wali_Kelas, jm.Kode_Mapel, 
            mp.Nama_Mapel, mp.Guru_Mapel, ta.Thn_Ajaran, ta.Semester, 
            jm.Waktu_Mulai, jm.Waktu_Selesai, jm.Hari
        FROM jadwal_mapels jm
        JOIN kelas k ON jm.Kelas_ID = k.ID_Kelas
        JOIN mata_pelajarans mp ON jm.Kode_Mapel = mp.Kode_Mapel
        JOIN tahun_ajarans ta ON jm.Thn_Ajaran_ID = ta.ID_Thn_Ajaran;

        ");
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        DB::statement('DROP VIEW  list_guru_aktif');
        DB::statement('DROP VIEW  guru_non_aktif');
        DB::statement('DROP VIEW  list_siswa_aktif');
        DB::statement('DROP VIEW  siswa_inactive');
        DB::statement('DROP VIEW  list_ekstrakurikuler');
        DB::statement('DROP VIEW  detail_nilai');
        DB::statement('DROP VIEW  info_nilai_ekskul');
        DB::statement('DROP VIEW  detail_prestasi');
        DB::statement('DROP VIEW  View_Nilai_F1');
        DB::statement('DROP VIEW  View_Nilai_F2');
        DB::statement('DROP VIEW  View_Nilai_F3');
        DB::statement('DROP VIEW  View_Nilai_UTS');
        DB::statement('DROP VIEW  View_Nilai_UAS');
        DB::statement('DROP VIEW  roster');
    }
};
