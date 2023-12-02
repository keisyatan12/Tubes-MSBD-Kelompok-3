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
        //1. Procedure cari siswa berdasarkan NISN
        DB::unprepared('
    
        CREATE PROCEDURE cari_siswa_per_nisn(nisn_siswa INT(11))
        BEGIN
        SELECT NISN, NIPD, Nama_Siswa, Jenis_Kelamin, Tempat_Lahir, Tanggal_Lahir, Agama, Alamat, No_hp, Status_dlm_Klrg, Nama_Ayah, Nama_Ibu, Pekerjaan_Ayah, Pekerjaan_Ibu, No_Rek_Bank, Bank_Atas_Nama, Status_Siswa, Sekolah_Asal, Anak_Ke
        FROM siswas
        WHERE NISN = nisn_siswa;
        END
        
        ');

        //2. Procedure cari siswa per kelas
        DB::unprepared('
        CREATE PROCEDURE cari_siswa_per_kelas(IN nama_kelas_siswa VARCHAR(150))
        BEGIN
        SELECT NISN, NIPD, Nama_Siswa, Jenis_Kelamin, Tempat_Lahir, Tanggal_Lahir, Agama, Alamat, No_hp, Status_dlm_Klrg, Nama_Ayah, Nama_Ibu, Pekerjaan_Ayah, Pekerjaan_Ibu, No_Rek_Bank, Bank_Atas_Nama, Status_Siswa, Sekolah_Asal, Anak_Ke
        FROM siswas
        JOIN absensi_kelas ON siswas.NISN = absensi_kelas.Siswa_ID
        JOIN kelas ON absensi_kelas.Kelas = kelas.ID_Kelas
        WHERE kelas.Nama_Kelas = nama_kelas_siswa;
        END
        ');

        //3. Procedure cari siswa per ekskul
        DB::unprepared('
        CREATE PROCEDURE cari_siswa_per_ekskul(IN nama_ekskul_siswa VARCHAR(30))
        BEGIN
        SELECT NISN, NIPD, Nama_Siswa, Jenis_Kelamin, Tempat_Lahir, Tanggal_Lahir, Agama, Alamat, No_hp, Status_dlm_Klrg, Nama_Ayah, Nama_Ibu, Pekerjaan_Ayah, Pekerjaan_Ibu, No_Rek_Bank, Bank_Atas_Nama, Status_Siswa, Sekolah_Asal, Anak_Ke
        FROM siswas
        JOIN ekskul_siswas ON siswas.NISN = ekskul_siswas.Siswa_ID
        JOIN ekstrakurikulers ON ekskul_siswas.Ekskul_Kode = ekstrakurikulers.Kode_Ekskul
        WHERE ekstrakurikulers.Nama_Ekskul = nama_ekskul_siswa;
        END

        ');

        //4. Procedure tambah guru
        DB::unprepared('
        CREATE PROCEDURE tambah_guru(IN nuptk_guru BIGINT(20), IN NIP_guru VARCHAR(18), IN nama VARCHAR(150), IN jk ENUM("L","P"), IN tmpt_lhr VARCHAR(100), IN tgl_lhr DATE, IN status_pegawai ENUM("GTY/PTY","Guru Honor"),
        IN Jenis_PTK_guru ENUM("Guru Mapel","Guru Wali Kelas"), IN Jenjang_pendidikan_guru VARCHAR(100), IN TMT date, IN jjm_guru INT(11), IN Status_guru ENUM("Aktif","Resign","Diberhentikan","Cuti"))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        INSERT INTO guruses(NUPTK, NIP, Nama_Guru, Jenis_Kelamin, Tempat_Lahir, Tanggal_Lahir, Status_Kepegawaian, Jenis_PTK, Jenjang_Pendidikan, TMT_Kerja, JJM, Status)
        VALUES(nuptk_guru, NIP_guru, nama, jk, tmpt_lhr, tgl_lhr, status_pegawai, Jenis_PTK_guru, Jenjang_pendidikan_guru, TMT, jjm_guru, Status_guru);
        END;
        COMMIT;
        END IF;
        END
        ');

        //5. Procedure update guru
        DB::unprepared('
        CREATE PROCEDURE update_guru(IN nuptk_guru BIGINT(20), IN NIP_guru VARCHAR(18), IN nama VARCHAR(150), IN jk ENUM("L","P"), IN tmpt_lhr VARCHAR(100), IN tgl_lhr DATE, IN status_pegawai ENUM("GTY/PTY","Guru Honor"),
        IN Jenis_PTK_guru ENUM("Guru Mapel","Guru Wali Kelas"), IN Jenjang_pendidikan_guru VARCHAR(100), IN TMT date, IN jjm_guru INT(11), IN Status_guru ENUM("Aktif","Resign","Diberhentikan","Cuti"))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        UPDATE guruses SET
        NUPTK = nuptk_guru,
        NIP = NIP_guru,
        Nama_Guru = nama,
        Jenis_Kelamin = jk,
        Tempat_Lahir = tmpt_lhr,
        Tanggal_Lahir = tgl_lhr,
        Status_Kepegawaian = status_pegawai,
        Jenis_PTK = Jenis_PTK_guru,
        Jenjang_Pendidikan = Jenjang_pendidikan_guru,
        TMT_Kerja = TMT,
        JJM = jjm_guru,
        Status = Status_guru WHERE NUPTK = nuptk_guru;
        END;
        COMMIT;
        END IF;
        END
        ');

        //6. Procedure add tata usaha
        DB::unprepared('
        CREATE PROCEDURE tambah_tata_usaha(IN pegawai_id BIGINT(20), nama VARCHAR(150), jk ENUM("L","P"), TMT DATE, tmpt_lhr VARCHAR(100), tgl_lhr DATE,
        Jenjang_pendidikan_tu VARCHAR(100), Status_tu ENUM("Aktif","Resign","Diberhentikan","Cuti"))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        INSERT INTO tata_usahas(ID_Pegawai, Nama_Pegawai, Jenis_Kelamin, TMT_Kerja, Tempat_Lahir, Tanggal_Lahir, Jenjang_Pendidikan, Status)
        VALUES(pegawai_id, nama, jk, TMT, tmpt_lhr, tgl_lhr, Jenjang_pendidikan_tu, Status_tu);
        END;
        COMMIT;
        END IF;
        END
        ');

        //7. Procedure update tata usaha
        DB::unprepared('
        CREATE PROCEDURE update_tata_usaha(IN pegawai_id BIGINT(20), nama VARCHAR(150), jk ENUM("L","P"), TMT DATE, tmpt_lhr VARCHAR(100), tgl_lhr DATE, Jenjang_pendidikan_tu VARCHAR(100), Status_tu ENUM("Aktif","Resign","Diberhentikan","Cuti"))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        UPDATE tata_usahas SET
        ID_Pegawai = pegawai_id,
        Nama_Pegawai = nama,
        Jenis_Kelamin = jk,
        TMT_Kerja = TMT,
        Tempat_Lahir = tmpt_lhr,
        Tanggal_Lahir = tgl_lhr,
        Jenjang_Pendidikan = Jenjang_pendidikan_tu,
        Status = Status_tu WHERE ID_Pegawai = pegawai_id;
        END;
        COMMIT;
        END IF;
        END

        ');

        //8. Procedure add tahun ajaran
        DB::unprepared('
        CREATE PROCEDURE tambah_tahun_ajaran(IN id BIGINT(20), Tahun CHAR(9), Sem ENUM("Ganjil","Genap"), Mulai DATE, Selesai DATE)
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        INSERT INTO tahun_ajarans(ID_Thn_Ajaran, Thn_Ajaran, Semester, Tanggal_Mulai, Tanggal_Selesai)
        VALUES(id, Tahun, Sem, Mulai, Selesai);
        END;
        COMMIT;
        END IF;
        END

        ');

        //9. Procedure update tahun ajaran
        DB::unprepared('
        CREATE PROCEDURE update_tahun_ajaran(IN id BIGINT(20), Tahun CHAR(9), Sem ENUM("Ganjil","Genap"), Mulai DATE, Selesai DATE)
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        UPDATE tahun_ajarans SET
        ID_Thn_Ajaran = id,
        Thn_Ajaran = Tahun,
        Semester = Sem,
        Tanggal_Mulai = Mulai,
        Tanggal_Selesai = Selesai WHERE ID_Thn_Ajaran = id;
        END;
        COMMIT;
        END IF;
        END
        ');

        //10. Procedure add kelas
        DB::unprepared('
        CREATE PROCEDURE tambah_kelas(IN id VARCHAR(10), wk BIGINT(20), nama_kls VARCHAR(150), tingkat ENUM("7","8","9"), Kelompok ENUM("A","B","C","D","E"))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        INSERT INTO kelas(ID_Kelas, Wali_Kelas, Nama_Kelas, Tingkatan, Kelompok_Kelas)
        VALUES(id, wk, nama_kls, tingkat, Kelompok);
        END;
        COMMIT;
        END IF;
        END
        ');

        //11. Procedure update kelas
        DB::unprepared('
        CREATE PROCEDURE update_kelas(IN id VARCHAR(10), wk BIGINT(20), nama_kls VARCHAR(150), tingkat ENUM("7","8","9"), Kelompok ENUM("A","B","C","D","E"))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        UPDATE kelas SET
        ID_Kelas = id,
        Wali_Kelas = wk,
        Nama_Kelas = nama_kls,
        Tingkatan = tingkat,
        Kelompok_Kelas = Kelompok WHERE ID_Kelas = id;
        END;
        COMMIT;
        END IF;
        END
        ');

        //12. Procedure add siswa
        DB::unprepared('
        CREATE PROCEDURE tambah_siswa(IN nisn_siswa INT(11), nipd_siswa INT(11), Nama VARCHAR(150), jk ENUM("L","P"), tmpt_lhr VARCHAR(100), tgl_lhr DATE, religi ENUM("Islam","Kristen","Katholik","Hindu","Buddha","Konghucu"), address VARCHAR(255), hp VARCHAR(13), status_anak ENUM("Anak Kandung","Anak Tiri"), ayah VARCHAR(150), ibu VARCHAR(150), kerja_ayah VARCHAR(50), kerja_ibu VARCHAR(50), no_rek VARCHAR(50), atas_nama VARCHAR(50), status_disklh ENUM("Aktif","Lulus","Pindah","Dropout","Tidak Aktif"), asal VARCHAR(100), urutan_anak INT(11))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        INSERT INTO siswas(NISN, NIPD, Nama_Siswa, Jenis_Kelamin, Tempat_Lahir, Tanggal_Lahir, Agama, Alamat, No_hp, Status_dlm_Klrg, Nama_Ayah, Nama_Ibu, Pekerjaan_Ayah, Pekerjaan_Ibu, No_Rek_Bank, Bank_Atas_Nama, Status_Siswa, Sekolah_Asal, Anak_Ke)
        VALUES(nisn_siswa, nipd_siswa, Nama, jk, tmpt_lhr, tgl_lhr, religi, address, hp, status_anak, ayah, ibu, kerja_ayah, kerja_ibu, no_rek, atas_nama, status_disklh, asal, urutan_anak);
        END;
        COMMIT;
        END IF;
        END
        ');

        //13. Procedure update siswa
        DB::unprepared('
        CREATE PROCEDURE update_siswa(IN nisn_siswa INT(11), nipd_siswa INT(11), Nama VARCHAR(150), jk ENUM("L","P"), tmpt_lhr VARCHAR(100), tgl_lhr DATE, religi ENUM("Islam","Kristen","Katholik","Hindu","Buddha","Konghucu"), address VARCHAR(255), hp VARCHAR(13), status_anak ENUM("Anak Kandung","Anak Tiri"), ayah VARCHAR(150), ibu VARCHAR(150), kerja_ayah VARCHAR(50), kerja_ibu VARCHAR(50), no_rek VARCHAR(50), atas_nama VARCHAR(50), status_disklh ENUM("Aktif","Lulus","Pindah","Dropout","Tidak Aktif"), asal VARCHAR(100), urutan_anak INT(11))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        UPDATE siswas SET
        NISN = nisn_siswa,
        NIPD = nipd_siswa,
        Nama_Siswa = Nama,
        Jenis_Kelamin = jk,
        Tempat_Lahir = tmpt_lhr,
        Tanggal_Lahir = tgl_lhr,
        Agama = religi,
        Alamat = address,
        No_hp = hp,
        Status_dlm_Klrg = status_anak,
        Nama_Ayah = ayah,
        Nama_Ibu = ibu,
        Pekerjaan_Ayah = kerja_ayah,
        Pekerjaan_Ibu = kerja_ibu,
        No_Rek_Bank = no_rek,
        Bank_Atas_Nama = atas_nama,
        Status_Siswa = status_disklh,
        Sekolah_Asal = asal,
        Anak_Ke = urutan_anak WHERE NISN = nisn_siswa;
        END;
        COMMIT;
        END IF;
        END
        ');

        //14. Procedure add roster
        DB::unprepared('
        CREATE PROCEDURE add_jadwal_mapel(IN id VARCHAR(10), kelas_id VARCHAR(10), mapel_kode CHAR(5), id_thn BIGINT(20), mulai TIME, selesai TIME, hari ENUM("Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        INSERT INTO jadwal_mapels(ID_Jadwal, Kelas_ID , Kode_Mapel, Thn_Ajaran_ID, Waktu_Mulai, Waktu_Selesai, Hari)
        VALUES(id, kelas_id, mapel_kode, id_thn, mulai, selesai, hari);
        END;
        COMMIT;
        END IF;
        END
        ');

        //15. Procedure update roster
        DB::unprepared('
        CREATE PROCEDURE update_jadwal_mapel(IN id VARCHAR(10), kelas_id VARCHAR(10), mapel_kode CHAR(5), id_thn BIGINT(20), mulai TIME, selesai TIME, hari ENUM("Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        UPDATE jadwal_mapels SET
        ID_Jadwal = id,
        Kelas_ID = kelas_id,
        Kode_Mapel = mapel_kode,
        Thn_Ajaran_ID = id_thn,
        Waktu_Mulai = mulai,
        Waktu_Selesai = selesai,
        Hari = hari WHERE ID_Jadwal = id;
        END;
        COMMIT;
        END IF;
        END
        ');

        //16. Procedure add prestasi
        DB::unprepared('
        CREATE PROCEDURE tambah_prestasi(IN id VARCHAR(10), siswa_id INT(11), jenis ENUM("Akademik","Non-Akademik"), desk VARCHAR(150), tgl DATE)
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        INSERT INTO prestasis(ID_Prestasi, Siswa, Jenis_Prestasi, Deskripsi, Tanggal)
        VALUES(id, siswa_id, jenis, desk, tgl);
        END;
        COMMIT;
        END IF;
        END
        ');

        //17. Procedure update prestasi
        DB::unprepared('
        CREATE PROCEDURE update_prestasi(IN id VARCHAR(10), siswa_id INT(11), jenis ENUM("Akademik","Non-Akademik"), desk VARCHAR(150), tgl DATE)
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        UPDATE prestasis SET
        ID_Prestasi = id,
        Siswa = siswa_id,
        Jenis_Prestasi = jenis,
        Deskripsi = desk,
        Tanggal = tgl WHERE ID_Prestasi = id;
        END;
        COMMIT;
        END IF;
        END
        ');

        //18. Procedure add nilai
        DB::unprepared('
        CREATE PROCEDURE tambah_nilai(IN id INT(11), mapel_kode CHAR(5), siswa_id INT(11), id_thn BIGINT(20), type ENUM("F1","F2","F3","UTS","UAS"), pengetahuan INT(11), keterampilan INT(11))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        INSERT INTO nilais(Nilai_ID, Kode_Mapel, Siswa_ID, Thn_Ajaran, Jenis, Nilai_Pengetahuan, Nilai_Keterampilan)
        VALUES(id, mapel_kode, siswa_id, id_thn, type, pengetahuan, keterampilan);
        END;
        COMMIT;
        END IF;
        END
        ');

        //19. Procedure update nilai
        DB::unprepared('
        CREATE PROCEDURE update_nilai(IN id INT(11), mapel_kode CHAR(5), siswa_id INT(11), id_thn BIGINT(20), type ENUM("F1","F2","F3","UTS","UAS"), pengetahuan INT(11), keterampilan INT(11))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        UPDATE nilais SET
        Nilai_ID = id,
        Kode_Mapel = mapel_kode,
        Siswa_ID = siswa_id,
        Thn_Ajaran = id_thn,
        Jenis = type,
        Nilai_Pengetahuan = pengetahuan,
        Nilai_Keterampilan = keterampilan WHERE Nilai_ID = id;
        END;
        COMMIT;
        END IF;
        END
        ');

        //20. Procedure add ekskul
        DB::unprepared('
        CREATE PROCEDURE tambah_ekskul(IN ekskul_kode CHAR(5), nama VARCHAR(30), guru BIGINT(20), hari_ekskul ENUM("Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"), mulai TIME, selesai TIME)
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        INSERT INTO ekstrakurikulers(Kode_Ekskul, Nama_Ekskul, Guru_Ekskul, Hari, Waktu_Mulai, Waktu_Selesai)
        VALUES(ekskul_kode, nama, guru, hari_ekskul, mulai, selesai);
        END;
        COMMIT;
        END IF;
        END
        ');

        //21. Procedure update ekskul
        DB::unprepared('
        CREATE PROCEDURE update_ekskul(IN ekskul_kode CHAR(5), nama VARCHAR(30), guru BIGINT(20), hari_ekskul ENUM("Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"), mulai TIME, selesai TIME)
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        UPDATE ekstrakurikulers SET
        Kode_Ekskul = ekskul_kode,
        Nama_Ekskul = nama,
        Guru_Ekskul = guru,
        Hari = hari_ekskul,
        Waktu_Mulai = mulai,
        Waktu_Selesai = selesai WHERE Kode_Ekskul = ekskul_kode;
        END;
        COMMIT;
        END IF;
        END
        ');

        //22. Procedure delete ekskul
        DB::unprepared('
        CREATE PROCEDURE hapus_ekskul(IN ekskul_kode CHAR(5))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        DELETE FROM ekstrakurikulers WHERE Kode_Ekskul = ekskul_kode;
        END;
        COMMIT;
        END IF;
        END
        ');

        //23. Procedure add mapel
        DB::unprepared('
        CREATE PROCEDURE tambah_mapel(IN mapel_kode CHAR(5), nama VARCHAR(50), kkm_mapel INT(11), guru BIGINT(20))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        INSERT INTO mata_pelajarans(Kode_Mapel, Nama_Mapel, KKM, Guru_Mapel)
        VALUES(mapel_kode, nama, kkm_mapel, guru);
        END;
        COMMIT;
        END IF;
        END
        ');

        //24. Procedure update mapel
        DB::unprepared('
        CREATE PROCEDURE update_mapel(IN mapel_kode CHAR(5), nama VARCHAR(50), kkm_mapel INT(11), guru BIGINT(20))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        UPDATE mata_pelajarans SET
        Kode_Mapel = mapel_kode,
        Nama_Mapel = nama,
        KKM = kkm_mapel,
        Guru_Mapel = guru WHERE Kode_Mapel = mapel_kode;
        END;
        COMMIT;
        END IF;
        END
        ');

        //25. Procedure delete mapel
        DB::unprepared('
        CREATE PROCEDURE hapus_mapel(IN mapel_kode CHAR(5))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        DELETE FROM mata_pelajarans WHERE Kode_Mapel = mapel_kode;
        END;
        COMMIT;
        END IF;
        END
        ');

        //26. Procedure add ekskul_siswa
        DB::unprepared('
        CREATE PROCEDURE tambah_siswa_ekskul(IN id_siswa_ekskul VARCHAR(10), ekskul_kode CHAR(5), siswa_id INT(11), id_thn BIGINT(20))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        INSERT INTO ekskul_siswas(ID_Ekskul_Siswa, Ekskul_Kode, Siswa_ID, Thn_Ajaran) VALUES(id_siswa_ekskul, ekskul_kode, siswa_id, id_thn);
        END;
        COMMIT;
        END IF;
        END
        ');

        //27. Procedure update ekskul_siswa
        DB::unprepared('
        CREATE PROCEDURE update_siswa_ekskul(IN id_siswa_ekskul VARCHAR(10), ekskul_kode CHAR(5), siswa_id INT(11), id_thn BIGINT(20))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        UPDATE ekskul_siswas SET
        ID_Ekskul_Siswa = id_siswa_ekskul,
        Ekskul_Kode = ekskul_kode,
        Siswa_ID = siswa_id,
        Thn_Ajaran = id_thn WHERE ID_Ekskul_Siswa = id_siswa_ekskul;
        END;
        COMMIT;
        END IF;
        END
        ');

        //28. Procedure add kip_kps_pip
        DB::unprepared('
        CREATE PROCEDURE tambah_kip_kps_pip(IN status_id INT(11), siswa_id INT(11), kip_status ENUM("Ya","Tidak"), kip_no VARCHAR(30), kps_status ENUM("Ya","Tidak"), kps_no VARCHAR(30), pip_eligible ENUM("Ya","Tidak"), alasan_eligible VARCHAR(50))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        INSERT INTO kips_kps_pips(ID_Status, ID_Siswa , Status_KIP, No_KIP, Status_KPS, No_KPS, Status_Eligible_PIP, Alasan_Eligible_PIP)
        VALUES(status_id, siswa_id, kip_status, kip_no, kps_status, kps_no, pip_eligible, alasan_eligible);
        END;
        COMMIT;
        END IF;
        END
        ');

        //29. Procedure update kip kps pip
        DB::unprepared('
        CREATE PROCEDURE update_kip_kps_pip(IN status_id INT(11), siswa_id iNT(11), kip_status ENUM("Ya","Tidak"), kip_no VARCHAR(30), kps_status ENUM("Ya","Tidak"), kps_no VARCHAR(30), pip_eligible ENUM("Ya","Tidak"), alasan_eligible VARCHAR(50))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        UPDATE kip_kps_pips SET
        ID_Status = status_id,
        ID_Siswa = siswa_id,
        Status_KIP = kip_status,
        No_KIP = kip_no,
        Status_KPS = kps_status,
        No_KPS = kps_no,
        Status_Eligible_PIP = pip_eligible,
        Alasan_Eligible_PIP = alasan_eligible WHERE ID_Status = status_id;
        END;
        COMMIT;
        END IF;
        END

        ');

        //30. Procedure add absensi_ekskul
        DB::unprepared('
        CREATE PROCEDURE tambah_absensi_ekskul(IN absensi_id INT(11), id_siswa_ekskul VARCHAR(10), tgl DATE, siswa_hadir INT(11), siswa_izin INT(11), siswa_alpa INT(11), siswa_sakit INT(11))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        INSERT INTO absensi_ekskuls(ID_Absensi, ID_Ekskul_Siswa, Tanggal, Hadir, Izin, Alpa, Sakit)
        VALUES(absensi_id, id_siswa_ekskul, tgl, siswa_hadir, siswa_izin, siswa_alpa, siswa_sakit);
        END;
        COMMIT;
        END IF;
        END

        ');

        //31. Procedure update absensi ekskul
        DB::unprepared('
        CREATE PROCEDURE update_absensi_ekskul(IN absensi_id INT(11), id_siswa_ekskul VARCHAR(10), tgl DATE, siswa_hadir INT(11), siswa_izin INT(11), siswa_alpa INT(11), siswa_sakit INT(11))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        UPDATE absensi_ekskuls SET
        ID_Absensi = absensi_id,
        ID_Ekskul_Siswa = id_siswa_ekskul,
        Tanggal = tgl,
        Hadir = siswa_hadir,
        Izin = siswa_izin,
        Alpa = siswa_alpa,
        Sakit = siswa_sakit WHERE ID_Absensi = absensi_id;
        END;
        COMMIT;
        END IF;
        END
        ');

        //32. Procedure add absensi kelas
        DB::unprepared('
        CREATE PROCEDURE tambah_absensi_kelas(IN absensi_id INT(11), siswa_id INT(11), kelas_nama VARCHAR(10), tgl DATE, siswa_hadir INT(11), siswa_izin INT(11), siswa_alpa INT(11), siswa_sakit INT(11))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        INSERT INTO absensi_kelas(ID_Absensi, Siswa_ID , Kelas, Tanggal, Hadir, Izin, Alpa, Sakit) VALUES(absensi_id, siswa_id, kelas_nama, tgl, siswa_hadir, siswa_izin, siswa_alpa, siswa_sakit);
        END;
        COMMIT;
        END IF;
        END
        ');

        //33. Procedure update absensi kelas
        DB::unprepared('
        CREATE PROCEDURE update_absensi_kelas(IN absensi_id INT(11), siswa_id INT(11), kelas_nama VARCHAR(10), tgl DATE, siswa_hadir INT(11), siswa_izin INT(11), siswa_alpa INT(11), siswa_sakit INT(11))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        UPDATE absensi_kelas SET
        ID_Absensi = absensi_id,
        Siswa_ID = siswa_id,
        Kelas = kelas_nama,
        Tanggal = tgl,
        Hadir = siswa_hadir,
        Izin = siswa_izin,
        Alpa = siswa_alpa,
        Sakit = siswa_sakit WHERE ID_Absensi = absensi_id;
        END;
        COMMIT;
        END IF;
        END
        ');

        //34. Procedure add kepala sekolah
        DB::unprepared('
        CREATE PROCEDURE tambah_kepala_sekolah(IN kepsek_id BIGINT(20), nama VARCHAR(150), jenjang_pendidikan_kepsek VARCHAR(100), jk ENUM("L","P"), tmpt_lhr VARCHAR(100), tgl_lhr DATE, TMT DATE, status_kepsek ENUM("Aktif","Resign","Diberhentikan","Cuti"))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        INSERT INTO kepala_sekolahs(ID_Kepsek, Nama_Kepsek, Jenjang_Pendidikan, Jenis_Kelamin, Tempat_Lahir, Tanggal_Lahir, TMT_Kerja, Status)
        VALUES(kepsek_id, nama, jenjang_pendidikan_kepsek, jk, tmpt_lhr, tgl_lhr, TMT, status_kepsek);
        END;
        COMMIT;
        END IF;
        END
        ');

        //35. Procedure update kepala sekolah
        DB::unprepared('
        CREATE PROCEDURE update_kepala_sekolah(IN kepsek_id BIGINT(20), nama VARCHAR(150), jenjang_pendidikan_kepsek VARCHAR(100), jk ENUM("L","P"), tmpt_lhr VARCHAR(100), tgl_lhr DATE, TMT DATE, status_kepsek ENUM("Aktif","Resign","Diberhentikan","Cuti"))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        UPDATE kepala_sekolahs SET
        ID_Kepsek = kepsek_id,
        Nama_Kepsek = nama,
        Jenjang_Pendidikan = jenjang_pendidikan_kepsek,
        Jenis_Kelamin = jk,
        Tempat_Lahir = tmpt_lhr,
        Tanggal_Lahir = tgl_lhr,
        TMT_Kerja = TMT,
        Status = status_kepsek WHERE ID_Kepsek = kepsek_id;
        END;
        COMMIT;
        END IF;
        END
        ');

        //36. Procedure add nilai ekskul
        DB::unprepared('
        CREATE PROCEDURE tambah_nilai_ekskul(IN nilai_id INT(11), id_siswa_ekskul VARCHAR(10), nilai_siswa ENUM("A","B","C","D","E"))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        INSERT INTO nilai_ekskuls(ID_Nilai_Ekskul, ID_Ekskul_Siswa, Nilai)
        VALUES(nilai_id, id_siswa_ekskul, nilai_siswa);
        END;
        COMMIT;
        END IF;
        END
        ');

        //37. Procedure update nilai ekskul
        DB::unprepared('
        CREATE PROCEDURE update_nilai_ekskul(IN nilai_id INT(11), id_siswa_ekskul VARCHAR(10), nilai_siswa ENUM("A","B","C","D","E"))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        UPDATE nilai_ekskuls SET
        ID_Nilai_Ekskul = nilai_id,
        ID_Ekskul_Siswa = id_siswa_ekskul,
        Nilai = nilai_siswa WHERE ID_Nilai_Ekskul = nilai_id;
        END;
        COMMIT;
        END IF;
        END
        ');

        //38. Procedure add rapor
        DB::unprepared('
        CREATE PROCEDURE tambah_rapor(IN rapor_id INT(11), nilai_id INT(11), nilai_ekskul_id INT(11), prestasi_id VARCHAR(10), absensi_id INT(11), ekskul_absensi INT(11))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        INSERT INTO rapors(ID_Rapor, ID_Nilai, ID_Ekskul_Nilai, Prestasi_ID, Absensi_ID, Absensi_Ekskul)
        VALUES(rapor_id, nilai_id, nilai_ekskul_id, prestasi_id, absensi_id, ekskul_absensi);
        END;
        COMMIT;
        END IF;
        END
        ');

        //39. Procedure update rapor
        DB::unprepared('
        CREATE PROCEDURE update_rapor(IN rapor_id INT(11), nilai_id INT(11), nilai_ekskul_id INT(11), prestasi_id VARCHAR(10), absensi_id INT(11), ekskul_absensi INT(11))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        UPDATE rapors SET
        ID_Rapor = rapor_id,
        ID_Nilai = nilai_id,
        ID_Ekskul_Nilai = nilai_ekskul_id,
        Prestasi_ID = prestasi_id,
        Absensi_ID = absensi_id,
        Absensi_Ekskul = ekskul_absensi WHERE ID_Rapor = rapor_id;
        END;
        COMMIT;
        END IF;
        END
        ');

        //40. Procedure add roles
        DB::unprepared('
        CREATE PROCEDURE tambah_roles(IN roles_id BIGINT(20), email_roles VARCHAR(150), password_roles VARCHAR(60), role_nama ENUM("Kepala Sekolah","Siswa","Guru","Tata Usaha"))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN   
        INSERT INTO roles(ID_Roles, Email, Password, Nama_Role)
        VALUES(roles_id, email_roles, password_roles, role_nama);
        END;
        COMMIT;
        END IF;
        END 
        ');

        //41. Procedure update roles
        DB::unprepared('
        CREATE PROCEDURE update_roles(IN roles_id BIGINT(20), email_roles VARCHAR(150), password_roles VARCHAR(60), role_nama ENUM("Kepala Sekolah","Siswa","Guru","Tata Usaha"))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN  
        UPDATE roles SET
        ID_Roles = roles_id,
        Email = email_roles,
        Password = password_roles,
        Nama_Role = role_nama WHERE ID_Roles = roles_id;
        END;
        COMMIT;
        END IF;
        END
        ');

        //42. Procedure add roles_assignment
        DB::unprepared('
        CREATE PROCEDURE tambah_role_assign(IN role_assign_id INT(11), roles_id BIGINT(20), nisn_siswa INT(11), nuptk_guru BIGINT(20), pegawai_id BIGINT(20), kepsek_id BIGINT(20))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN 
        INSERT INTO role_assignments(ID_Role_Assignment, Role_ID, Siswa_ID, NUPTK_Guru, Pegawai_ID, Kepsek_ID)
        VALUES(role_assign_id, roles_id, nisn_siswa, nuptk_guru, pegawai_id, kepsek_id);
        END;
        COMMIT;
        END IF;
        END
        ');

        //43. Procedure update roles_assignment
        DB::unprepared('
        CREATE PROCEDURE update_role_assign(IN role_assign_id INT(11), roles_id BIGINT(20), nisn_siswa INT(11), nuptk_guru BIGINT(20), pegawai_id BIGINT(20), kepsek_id BIGINT(20))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN 
        UPDATE role_assignments SET
        ID_Role_Assignment = role_assign_id,
        Role_ID = roles_id,
        Siswa_ID = nisn_siswa,
        NUPTK_Guru = nuptk_guru,
        Pegawai_ID = pegawai_id,
        Kepsek_ID = kepsek_id WHERE ID_Role_Assignment = role_assign_id;
        END;
        COMMIT;
        END IF;
        END
        ');

        //44. Procedure add wali_siswa
        DB::unprepared('
        CREATE PROCEDURE tambah_wali_siswa(IN wali_id INT(11), nama VARCHAR(150), perwakilan_untuk INT(11), kerja_wali VARCHAR(50), no_rek VARCHAR(50), atas_nama VARCHAR(50))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        INSERT INTO wali_siswas(ID_Wali, Nama_Wali, ID_Siswa, Pekerjaan_Wali, No_Rek_Bank, Bank_Atas_Nama) 
        VALUES(wali_id, nama, perwakilan_untuk, kerja_wali, no_rek, atas_nama);
        END;
        COMMIT;
        END IF;
        END
        ');

        //45. Procedure update wali_siswa
        DB::unprepared('
        CREATE PROCEDURE update_wali_siswa(IN wali_id INT(11), nama VARCHAR(150), perwakilan_untuk INT(11), kerja_wali VARCHAR(50), no_rek VARCHAR(50), atas_nama VARCHAR(50))
        BEGIN
        DECLARE exit_handler BOOLEAN DEFAULT FALSE;
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
        START TRANSACTION;
        IF exit_handler THEN ROLLBACK;
        ELSE BEGIN
        UPDATE wali_siswas SET
        ID_Wali = wali_id,
        Nama_Wali = nama,
        ID_Siswa = perwakilan_untuk,
        Pekerjaan_Wali = kerja_wali,
        No_Rek_Bank = no_rek,
        Bank_Atas_Nama = atas_nama WHERE ID_Wali = wali_id;
        END;
        COMMIT;
        END IF;
        END
        ');

        //46. Procedure predikat
        DB::unprepared('
        CREATE PROCEDURE predikat_nilai(IN nilaiPengetahuan INT(11), IN nilaiKeterampilan INT(11), OUT predikatPengetahuan CHAR(1), OUT predikatKeterampilan CHAR(1))
        BEGIN
        IF nilaiPengetahuan >= 85 THEN SET predikatPengetahuan = "A";
        ELSEIF nilaiPengetahuan >= 70 THEN SET predikatPengetahuan = "B";
        ELSEIF nilaiPengetahuan >= 60 THEN SET predikatPengetahuan = "C";
        ELSEIF nilaiPengetahuan >= 50 THEN SET predikatPengetahuan = "D";
        ELSE SET predikatPengetahuan = "E";
        END IF;
        IF nilaiKeterampilan >= 85 THEN SET predikatKeterampilan = "A";
        ELSEIF nilaiKeterampilan >= 70 THEN SET predikatKeterampilan = "B";
        ELSEIF nilaiKeterampilan >= 60 THEN SET predikatKeterampilan = "C";
        ELSEIF nilaiKeterampilan >= 50 THEN SET predikatKeterampilan = "D";
        ELSE SET predikatKeterampilan = "E";
        END IF;
        END

        ');




    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE cari_siswa_per_nisn");
        DB::unprepared("DROP PROCEDURE cari_siswa_per_kelas");
        DB::unprepared("DROP PROCEDURE cari_siswa_per_ekskul");
        DB::unprepared("DROP PROCEDURE tambah_guru");
        DB::unprepared("DROP PROCEDURE update_guru");
        DB::unprepared("DROP PROCEDURE tambah_tata_usaha");
        DB::unprepared("DROP PROCEDURE update_tata_usaha");
        DB::unprepared("DROP PROCEDURE tambah_tahun_ajaran");
        DB::unprepared("DROP PROCEDURE update_tahun_ajaran");
        DB::unprepared("DROP PROCEDURE tambah_kelas");
        DB::unprepared("DROP PROCEDURE update_kelas");
        DB::unprepared("DROP PROCEDURE tambah_siswa");
        DB::unprepared("DROP PROCEDURE update_siswa");
        DB::unprepared("DROP PROCEDURE add_jadwal_mapel");
        DB::unprepared("DROP PROCEDURE update_jadwal_mapel");
        DB::unprepared("DROP PROCEDURE tambah_prestasi");
        DB::unprepared("DROP PROCEDURE update_prestasi");
        DB::unprepared("DROP PROCEDURE tambah_nilai");
        DB::unprepared("DROP PROCEDURE update_nilai");
        DB::unprepared("DROP PROCEDURE tambah_ekskul");
        DB::unprepared("DROP PROCEDURE update_ekskul");
        DB::unprepared("DROP PROCEDURE hapus_ekskul");
        DB::unprepared("DROP PROCEDURE tambah_mapel");
        DB::unprepared("DROP PROCEDURE update_mapel");
        DB::unprepared("DROP PROCEDURE hapus_mapel");
        DB::unprepared("DROP PROCEDURE tambah_siswa_ekskul");
        DB::unprepared("DROP PROCEDURE update_siswa_ekskul");
        DB::unprepared("DROP PROCEDURE tambah_kip_kps_pip");
        DB::unprepared("DROP PROCEDURE update_kip_kps_pip");
        DB::unprepared("DROP PROCEDURE tambah_absensi_ekskul");
        DB::unprepared("DROP PROCEDURE update_absensi_ekskul");
        DB::unprepared("DROP PROCEDURE tambah_absensi_kelas");
        DB::unprepared("DROP PROCEDURE update_absensi_kelas");
        DB::unprepared("DROP PROCEDURE tambah_kepala_sekolah");
        DB::unprepared("DROP PROCEDURE update_kepala_sekolah");
        DB::unprepared("DROP PROCEDURE tambah_nilai_ekskul");
        DB::unprepared("DROP PROCEDURE update_nilai_ekskul");
        DB::unprepared("DROP PROCEDURE tambah_rapor");
        DB::unprepared("DROP PROCEDURE update_rapor");
        DB::unprepared("DROP PROCEDURE tambah_roles");
        DB::unprepared("DROP PROCEDURE update_roles");
        DB::unprepared("DROP PROCEDURE tambah_role_assign");
        DB::unprepared("DROP PROCEDURE update_role_assign");
        DB::unprepared("DROP PROCEDURE tambah_wali_siswa");
        DB::unprepared("DROP PROCEDURE update_wali_siswa");
        DB::unprepared("DROP PROCEDURE predikat_nilai");
        
        
    }
};
