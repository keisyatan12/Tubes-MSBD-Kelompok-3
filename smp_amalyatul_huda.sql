-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2023 at 11:11 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smp_amalyatul_huda`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi_ekskul`
--

CREATE TABLE `absensi_ekskul` (
  `ID_Absensi` int(11) NOT NULL,
  `ID_Ekskul_Siswa` varchar(10) NOT NULL,
  `Tanggal` date NOT NULL,
  `Hadir` int(2) DEFAULT NULL,
  `Izin` int(2) DEFAULT NULL,
  `Alpa` int(2) DEFAULT NULL,
  `Sakit` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi_ekskul`
--

INSERT INTO `absensi_ekskul` (`ID_Absensi`, `ID_Ekskul_Siswa`, `Tanggal`, `Hadir`, `Izin`, `Alpa`, `Sakit`) VALUES
(1, 'PRK001', '2023-11-06', 10, 2, 3, 2),
(2, 'MNR001', '2023-11-09', 20, 7, 2, 8);

--
-- Triggers `absensi_ekskul`
--
DELIMITER $$
CREATE TRIGGER `log_insert_absensi_ekskul` AFTER INSERT ON `absensi_ekskul` FOR EACH ROW BEGIN 
INSERT INTO log_absensi_ekskul(ID_Absensi, ID_Ekskul_Siswa, Tanggal, Hadir,
Izin, Alpa, Sakit, Action, Username, Waktu)
VALUES (new.ID_Absensi, new.ID_Ekskul_Siswa, new.Tanggal, new.Hadir,
new.Izin, new.Alpa, new.Sakit, "Insert", "CURRENT_USER()", NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_absensi_ekskul` AFTER UPDATE ON `absensi_ekskul` FOR EACH ROW BEGIN 
INSERT INTO log_absensi_ekskul(ID_Absensi, ID_Ekskul_Siswa, Tanggal, Hadir,
Izin, Alpa, Sakit, Action, Username, Waktu)
VALUES (new.ID_Absensi, new.ID_Ekskul_Siswa, new.Tanggal, new.Hadir,
new.Izin, new.Alpa, new.Sakit, "Update", "CURRENT_USER()", NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `absensi_kelas`
--

CREATE TABLE `absensi_kelas` (
  `ID_Absensi` int(11) NOT NULL,
  `ID_Siswa` int(10) NOT NULL,
  `Kelas` varchar(10) NOT NULL,
  `Tanggal` date NOT NULL,
  `Hadir` int(2) DEFAULT NULL,
  `Izin` int(2) DEFAULT NULL,
  `Alpa` int(2) DEFAULT NULL,
  `Sakit` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi_kelas`
--

INSERT INTO `absensi_kelas` (`ID_Absensi`, `ID_Siswa`, `Kelas`, `Tanggal`, `Hadir`, `Izin`, `Alpa`, `Sakit`) VALUES
(1, 117795632, 'SMP8A', '2023-11-06', 1, 0, 0, 0),
(2, 91676040, 'SMP8A', '2023-11-06', 0, 1, 0, 0),
(3, 78791950, 'SMP8A', '2023-11-06', 1, 0, 0, 0),
(4, 109600822, 'SMP8A', '2023-11-06', 1, 0, 0, 0),
(5, 114715088, 'SMP8B', '2023-11-06', 1, 0, 0, 0),
(6, 108254549, 'SMP8B', '2023-11-06', 1, 0, 0, 0),
(7, 117795632, 'SMP8A', '2023-12-06', 1, 0, 0, 0),
(8, 91676040, 'SMP8A', '2023-12-06', 0, 1, 0, 0),
(9, 109600822, 'SMP8A', '2023-12-06', 0, 0, 1, 0),
(10, 114715088, 'SMP9B', '2023-12-06', 1, 0, 0, 0),
(11, 117795632, 'SMP8A', '2023-11-07', 1, 0, 0, 0),
(12, 117795632, 'SMP8A', '2023-11-08', 0, 1, 0, 0),
(13, 117795632, 'SMP8A', '2023-11-09', 1, 0, 0, 0),
(14, 117795632, 'SMP8A', '2023-11-10', 0, 0, 1, 0),
(15, 117795632, 'SMP8A', '2023-12-11', 0, 1, 0, 0),
(16, 117795632, 'SMP8A', '2023-12-12', 1, 0, 0, 0),
(17, 117795632, 'SMP8A', '2023-12-12', 0, 0, 0, 1),
(18, 117795632, 'SMP8A', '2023-12-13', 1, 0, 0, 0),
(19, 117795632, 'SMP8A', '2023-12-14', 1, 0, 0, 0),
(20, 117795632, 'SMP8A', '2023-12-15', 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `detail_nilai`
-- (See below for the actual view)
--
CREATE TABLE `detail_nilai` (
`Nilai_ID` int(11)
,`Kode_Mapel` char(5)
,`ID_Siswa` int(10)
,`Thn_Ajaran` int(11)
,`Jenis` enum('F1','F2','F3','UTS','UAS')
,`Nilai_Pengetahuan` int(3)
,`Nilai_Keterampilan` int(3)
,`Nama_Mapel` varchar(50)
,`KKM` int(2)
,`NUPTK` bigint(20)
,`Nama_Guru` varchar(150)
,`NISN` int(10)
,`Nama_Siswa` varchar(150)
,`Tahun_Ajaran` char(9)
,`Semester` enum('GANJIL','GENAP')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `detail_prestasi`
-- (See below for the actual view)
--
CREATE TABLE `detail_prestasi` (
`ID_Prestasi` varchar(10)
,`NISN` int(10)
,`Nama_Siswa` varchar(150)
,`Jenis_Prestasi` enum('Akademik','Non Akademik')
,`Deskripsi` varchar(150)
,`Tanggal` date
);

-- --------------------------------------------------------

--
-- Table structure for table `ekskul_siswa`
--

CREATE TABLE `ekskul_siswa` (
  `ID_Ekskul_Siswa` varchar(10) NOT NULL,
  `Kode_Ekskul` char(5) NOT NULL,
  `ID_Siswa` int(10) NOT NULL,
  `Thn_Ajaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ekskul_siswa`
--

INSERT INTO `ekskul_siswa` (`ID_Ekskul_Siswa`, `Kode_Ekskul`, `ID_Siswa`, `Thn_Ajaran`) VALUES
('MNR001', 'MNR', 108254549, 1),
('PRK001', 'PRK', 117795632, 1),
('PRK002', 'PRK', 91676040, 3),
('PST001', 'PST', 91676040, 1);

--
-- Triggers `ekskul_siswa`
--
DELIMITER $$
CREATE TRIGGER `log_insert_ekskul_siswa` AFTER INSERT ON `ekskul_siswa` FOR EACH ROW BEGIN 
INSERT INTO log_ekskul_siswa(ID_Ekskul_Siswa, Kode_Ekskul, ID_Siswa,
			Thn_Ajaran, Action, Username, Waktu)
VALUES (new.ID_Ekskul_Siswa, new.Kode_Ekskul, new.ID_Siswa,
	new.Thn_Ajaran, "Insert", "CURRENT_USER()", NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_ekskul_siswa` AFTER UPDATE ON `ekskul_siswa` FOR EACH ROW BEGIN 
INSERT INTO log_ekskul_siswa(ID_Ekskul_Siswa, Kode_Ekskul, ID_Siswa,
			Thn_Ajaran, Action, Username, Waktu)
VALUES (new.ID_Ekskul_Siswa, new.Kode_Ekskul, new.ID_Siswa,
	new.Thn_Ajaran, "Update", "USERNAME", NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ekstrakurikuler`
--

CREATE TABLE `ekstrakurikuler` (
  `Kode_Ekskul` char(5) NOT NULL,
  `Nama_Ekskul` varchar(30) NOT NULL,
  `Guru_Ekskul` bigint(20) NOT NULL,
  `Hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') DEFAULT NULL,
  `Waktu_Mulai` time DEFAULT NULL,
  `Waktu_Selesai` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ekstrakurikuler`
--

INSERT INTO `ekstrakurikuler` (`Kode_Ekskul`, `Nama_Ekskul`, `Guru_Ekskul`, `Hari`, `Waktu_Mulai`, `Waktu_Selesai`) VALUES
('FSL', 'FUTSAL', 1554758660110042, 'Sabtu', '15:30:00', '17:00:00'),
('MNR', 'MENARI', 1148770671130093, 'Rabu', '15:00:00', '16:00:00'),
('PRK', 'PRAMUKA', 8450774675230033, 'Jumat', '15:00:00', '17:00:00'),
('PST', 'PENCAK SILAT', 2344763664110023, 'Selasa', '14:30:00', '17:00:00');

--
-- Triggers `ekstrakurikuler`
--
DELIMITER $$
CREATE TRIGGER `log_delete_ekstrakurikuler` AFTER DELETE ON `ekstrakurikuler` FOR EACH ROW BEGIN
INSERT INTO log_ekstrakurikuler(Kode_ekskul,Nama_Ekskul,Guru_Ekskul,Hari,
			Waktu_Mulai,Waktu_Selesai,Action,Username,Waktu)
VALUES (OLD.Kode_ekskul, OLD.Nama_Ekskul, OLD.Guru_Ekskul, OLD.Hari,
	OLD.Waktu_Mulai, OLD.Waktu_Selesai, "Delete", "CURRENT_USER()", NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_insert_ekstrakurikuler` AFTER INSERT ON `ekstrakurikuler` FOR EACH ROW BEGIN
INSERT INTO log_ekstrakurikuler(Kode_ekskul,Nama_Ekskul,Guru_Ekskul,Hari,
			Waktu_Mulai,Waktu_Selesai,Action,Username,Waktu)
VALUES (new.Kode_ekskul, new.Nama_Ekskul, new.Guru_Ekskul, new.Hari,
	new.Waktu_Mulai, new.Waktu_Selesai, "Insert", "CURRENT_USER()", NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_ekstrakurikuler` AFTER UPDATE ON `ekstrakurikuler` FOR EACH ROW BEGIN
INSERT INTO log_ekstrakurikuler(Kode_ekskul,Nama_Ekskul,Guru_Ekskul,Hari,
			Waktu_Mulai,Waktu_Selesai,Action,Username,Waktu)
VALUES (new.Kode_ekskul, new.Nama_Ekskul, new.Guru_Ekskul, new.Hari,
	new.Waktu_Mulai, new.Waktu_Selesai, "Update", "CURRENT_USER()", NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `NUPTK` bigint(20) NOT NULL,
  `NIK` varchar(18) NOT NULL,
  `Nama_Guru` varchar(150) NOT NULL,
  `Jenis_Kelamin` enum('L','P') DEFAULT NULL,
  `Tempat_Lahir` varchar(100) NOT NULL,
  `Tanggal_Lahir` date NOT NULL,
  `Status_Kepegawaian` enum('GTY/PTY','Guru Honor') NOT NULL,
  `Jenis_PTK` enum('Guru Mapel','Guru Wali Kelas') NOT NULL,
  `Jenjang_Pendidikan` varchar(100) NOT NULL,
  `TMT_Kerja` date NOT NULL,
  `JJM` int(2) NOT NULL,
  `Status` enum('Aktif','Resign','Diberhentikan','Cuti') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`NUPTK`, `NIK`, `Nama_Guru`, `Jenis_Kelamin`, `Tempat_Lahir`, `Tanggal_Lahir`, `Status_Kepegawaian`, `Jenis_PTK`, `Jenjang_Pendidikan`, `TMT_Kerja`, `JJM`, `Status`) VALUES
(1148770671130093, '1222035608920007', 'Herlia Puspita Dewi', 'P', 'Pulau Raja', '1992-08-16', 'GTY/PTY', 'Guru Wali Kelas', 'S1-Bahasa Indonesia', '2017-07-18', 36, 'Aktif'),
(1252771672230163, '121987652200', 'Putri Yunita', 'L', 'Medan', '1993-06-17', 'Guru Honor', '', 'S1-Ekonomi', '2016-07-18', 12, 'Diberhentikan'),
(1554758660110042, '1271142202800007', 'Muhammad Haris', 'L', 'Pangakalian', '1980-02-22', 'Guru Honor', 'Guru Mapel', 'S1-Hukum', '2019-07-15', 18, 'Aktif'),
(2344763664110023, '1208304408060001', 'SYAHPUTRA EFENDI', 'L', 'MEDAN', '1985-10-12', 'GTY/PTY', 'Guru Mapel', 'S1 - MATEMATIKA', '2017-07-18', 30, 'Aktif'),
(5853776677230002, '1207256105980001', 'Nurhasanah', 'P', 'Manunggal', '1998-05-21', 'GTY/PTY', 'Guru Wali Kelas', 'S1-Pendidikan Agama Islam', '2019-07-18', 12, 'Aktif'),
(7545772673130023, '1271065312940001', 'Della Tria Putri', 'P', 'Medan', '1994-12-13', 'GTY/PTY', 'Guru Wali Kelas', 'S1-Bahasa Inggris', '2016-07-18', 24, 'Resign'),
(8450774675230033, '1219084209000005', 'SITI AMINAH', 'P', 'PADANG KEDONDONG', '1996-11-18', 'GTY/PTY', 'Guru Mapel', 'S-1 Pendidikan Kepelatiha', '2019-07-01', 18, 'Aktif'),
(9261764666210083, '1219054901020008', 'WINASTRI', 'P', 'HELVETIA', '1986-09-29', 'GTY/PTY', 'Guru Wali Kelas', 'S1 - PENDIDIKAN SENI BUDAYA', '2009-07-17', 4, 'Aktif'),
(9736764665230312, '1213034404860005', 'Nursakinah', 'P', 'Hutarimbaru', '1986-04-04', 'GTY/PTY', 'Guru Wali Kelas', 'S1-Ilmu Pengetahuan Sosial', '2017-07-18', 24, 'Cuti'),
(125298476722301635, '1219054404930002', 'SHAFIRA HILMI WAHYUDI', 'P', 'MEDAN', '1998-06-03', 'GTY/PTY', 'Guru Mapel', 'SMA/SEDERAJAT', '2020-07-13', 18, 'Aktif');

--
-- Triggers `guru`
--
DELIMITER $$
CREATE TRIGGER `log_insert_guru` AFTER INSERT ON `guru` FOR EACH ROW BEGIN
INSERT INTO log_guru(NUPTK, NIK, Nama_Guru, Jenis_Kelamin, Tempat_Lahir, Tanggal_Lahir, Status_kepegawaian,
			Jenis_PTK, Jenjang_Pendidikan, TMT_Kerja, JJM, Status, Action, Username, Waktu)
VALUES (new.NUPTK, new.NIK, new.Nama_Guru, new.Jenis_Kelamin, new.Tempat_Lahir, new.Tanggal_Lahir, new.Status_kepegawaian,
	new.Jenis_PTK, new.Jenjang_Pendidikan, new.TMT_Kerja, new.JJM, new.Status, "Insert", "CURRENT_USER()", NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_guru` AFTER UPDATE ON `guru` FOR EACH ROW BEGIN
INSERT INTO log_guru(NUPTK, NIK, Nama_Guru, Jenis_Kelamin, Tempat_Lahir, Tanggal_Lahir, Status_kepegawaian,
			Jenis_PTK, Jenjang_Pendidikan, TMT_Kerja, JJM, Status, Action, Username, Waktu)
VALUES (new.NUPTK, new.NIK, new.Nama_Guru, new.Jenis_Kelamin, new.Tempat_Lahir, new.Tanggal_Lahir, new.Status_kepegawaian,
	new.Jenis_PTK, new.Jenjang_Pendidikan, new.TMT_Kerja, new.JJM, new.Status, "Update", "CURRENT_USER()", NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `guru_non_aktif`
-- (See below for the actual view)
--
CREATE TABLE `guru_non_aktif` (
`NUPTK` bigint(20)
,`NIK` varchar(18)
,`Nama_Guru` varchar(150)
,`Jenis_Kelamin` enum('L','P')
,`Tempat_Lahir` varchar(100)
,`Tanggal_Lahir` date
,`Status_Kepegawaian` enum('GTY/PTY','Guru Honor')
,`Jenis_PTK` enum('Guru Mapel','Guru Wali Kelas')
,`Jenjang_Pendidikan` varchar(100)
,`TMT_Kerja` date
,`JJM` int(2)
,`Status` enum('Aktif','Resign','Diberhentikan','Cuti')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `info_nilai_ekskul`
-- (See below for the actual view)
--
CREATE TABLE `info_nilai_ekskul` (
`ID_Nilai` int(11)
,`ID_Ekskul_Siswa` varchar(10)
,`Nilai` int(2)
,`Kode_Ekskul` char(5)
,`ID_Siswa` int(10)
,`Nama_Siswa` varchar(150)
,`Nama_Ekskul` varchar(30)
,`Guru_Ekskul` bigint(20)
,`Nama_Guru` varchar(150)
,`Thn_Ajaran` char(9)
,`Semester` enum('GANJIL','GENAP')
);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_mapel`
--

CREATE TABLE `jadwal_mapel` (
  `ID_Jadwal` varchar(10) NOT NULL,
  `ID_Kelas` varchar(10) NOT NULL,
  `Kode_Mapel` char(5) NOT NULL,
  `ID_Thn_Ajaran` int(11) NOT NULL,
  `Waktu_Mulai` time DEFAULT NULL,
  `Waktu_Selesai` time DEFAULT NULL,
  `Hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `jadwal_mapel`
--
DELIMITER $$
CREATE TRIGGER `log_insert_jadwal_mapel` AFTER INSERT ON `jadwal_mapel` FOR EACH ROW BEGIN
INSERT INTO log_jadwal_mapel(ID_Jadwal, ID_Kelas, Kode_Mapel, ID_Thn_Ajaran, Waktu_Mulai, Waktu_Selesai,
Hari, Action, Username, Waktu)
VALUES (new.ID_Jadwal, new.ID_Kelas, new.Kode_Mapel, new.ID_Thn_Ajaran, new.Waktu_Mulai, new.Waktu_Selesai,
new.Hari, "Insert", "CURRENT_USER()", NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_jadwal_mapel` AFTER UPDATE ON `jadwal_mapel` FOR EACH ROW BEGIN
INSERT INTO log_jadwal_mapel(ID_Jadwal, ID_Kelas, Kode_Mapel, ID_Thn_Ajaran, Waktu_Mulai, Waktu_Selesai,
Hari, Action, Username, Waktu)
VALUES (new.ID_Jadwal, new.ID_Kelas, new.Kode_Mapel, new.ID_Thn_Ajaran, new.Waktu_Mulai, new.Waktu_Selesai,
new.Hari, "Update", "CURRENT_USER()", NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `ID_Kelas` varchar(10) NOT NULL,
  `Wali_Kelas` bigint(20) NOT NULL,
  `Nama_Kelas` varchar(150) NOT NULL,
  `Tingkatan` enum('7','8','9') NOT NULL,
  `Kelompok_Kelas` enum('A','B','C','D','E') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`ID_Kelas`, `Wali_Kelas`, `Nama_Kelas`, `Tingkatan`, `Kelompok_Kelas`) VALUES
('SMP8A', 1148770671130093, 'Kelas 8-1', '8', 'A'),
('SMP8B', 9736764665230312, 'Kelas 8-2', '8', 'B'),
('SMP9A', 8450774675230033, 'Kelas 9-1', '9', 'A'),
('SMP9B', 9261764666210083, 'Kelas 9-2', '9', 'B'),
('TJH34', 7545772673130023, 'Kelas 7-1', '7', 'A'),
('TJH35', 5853776677230002, 'Kelas 7-2', '7', 'B');

--
-- Triggers `kelas`
--
DELIMITER $$
CREATE TRIGGER `log_insert_kelas` AFTER INSERT ON `kelas` FOR EACH ROW BEGIN
INSERT INTO log_kelas (ID_Kelas, Wali_Kelas, Nama_Kelas, Tingkatan, Kelompok_Kelas,
Action, Username, Waktu)
VALUES (new.ID_Kelas, new.Wali_Kelas, new.Nama_Kelas, new.Tingkatan, new.Kelompok_Kelas,
"Insert", "CURRENT_USER", NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_kelas` AFTER UPDATE ON `kelas` FOR EACH ROW BEGIN
INSERT INTO log_kelas(ID_Kelas, Wali_Kelas, Nama_Kelas, Tingkatan, Kelompok_Kelas,
Action, Username, Waktu)
VALUES (new.ID_Kelas, new.Wali_Kelas, new.Nama_Kelas, new.Tingkatan, new.Kelompok_Kelas,
"Update", "CURRENT_USER", NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kepala_sekolah`
--

CREATE TABLE `kepala_sekolah` (
  `ID_Kepsek` int(11) NOT NULL,
  `Nama_Kepsek` varchar(150) NOT NULL,
  `Jenjang_Pendidikan` varchar(100) NOT NULL,
  `Jenis_Kelamin` enum('L','P') DEFAULT NULL,
  `Tempat_Lahir` varchar(100) NOT NULL,
  `Tanggal_Lahir` date NOT NULL,
  `TMT_Kerja` date NOT NULL,
  `Status` enum('Aktif','Resign','Diberhentikan','Cuti') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kepala_sekolah`
--

INSERT INTO `kepala_sekolah` (`ID_Kepsek`, `Nama_Kepsek`, `Jenjang_Pendidikan`, `Jenis_Kelamin`, `Tempat_Lahir`, `Tanggal_Lahir`, `TMT_Kerja`, `Status`) VALUES
(1, 'SYAFRIZAL', 'S-1 EKONOMI', 'L', 'MEDAN', '1993-06-17', '2016-07-18', 'Aktif');

--
-- Triggers `kepala_sekolah`
--
DELIMITER $$
CREATE TRIGGER `log_insert_kepala_sekolah` AFTER INSERT ON `kepala_sekolah` FOR EACH ROW BEGIN
INSERT INTO log_kepala_sekolah(ID_Kepsek, Nama_Kepsek, Jenjang_Pendidikan, Jenis_Kelamin, Tempat_Lahir, Tanggal_Lahir,
Jenjang_Pendidikan, Status, Action, Username, Waktu)
VALUES (new.ID_Kepsek, new.Nama_Kepsek, new.Jenjang_Pendidikan, new.Jenis_Kelamin, new.Tempat_Lahir, new.Tanggal_Lahir,
new.Jenjang_Pendidikan, new.Status, "Insert", "CURRENT_USER()", NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_kepala_sekolah` AFTER UPDATE ON `kepala_sekolah` FOR EACH ROW BEGIN
INSERT INTO log_kepala_sekolah(ID_Kepsek, Nama_Kepsek, Jenjang_Pendidikan, Jenis_Kelamin, Tempat_Lahir, Tanggal_Lahir,
Jenjang_Pendidikan, Status, Action, Username, Waktu)
VALUES (new.ID_Kepsek, new.Nama_Kepsek, new.Jenjang_Pendidikan, new.Jenis_Kelamin, new.Tempat_Lahir, new.Tanggal_Lahir,
new.Jenjang_Pendidikan, new.Status, "Update", "CURRENT_USER()", NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kip_kps_pip`
--

CREATE TABLE `kip_kps_pip` (
  `ID_Status` int(11) NOT NULL,
  `Siswa_ID` int(10) NOT NULL,
  `Status_KIP` enum('Ya','Tidak') NOT NULL,
  `No_KIP` varchar(30) DEFAULT NULL,
  `Status_KPS` enum('Ya','Tidak') NOT NULL,
  `No_KPS` varchar(30) DEFAULT NULL,
  `Status_Eligible_PIP` enum('Ya','Tidak') NOT NULL,
  `Alasan_Eligible_PIP` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kip_kps_pip`
--

INSERT INTO `kip_kps_pip` (`ID_Status`, `Siswa_ID`, `Status_KIP`, `No_KIP`, `Status_KPS`, `No_KPS`, `Status_Eligible_PIP`, `Alasan_Eligible_PIP`) VALUES
(1, 78791950, 'Ya', '120008374', 'Ya', '8362773673', 'Tidak', NULL),
(2, 109600822, 'Ya', '3472748934', 'Tidak', '', '', NULL);

--
-- Triggers `kip_kps_pip`
--
DELIMITER $$
CREATE TRIGGER `log_insert_kip_kps_pip` AFTER INSERT ON `kip_kps_pip` FOR EACH ROW BEGIN
INSERT INTO log_kip_kps_pip(ID_Status, Siswa_ID, Status_KIP, No_KIP, Status_KPS, No_KPS,
Status_Eligible_PIP, Alasan_Eligible_PIP, Action, Username, Waktu)
VALUES (new.ID_Status, new.Siswa_ID, new.Status_KIP, new.No_KIP, new.Status_KPS, new.No_KPS,
new.Status_Eligible_PIP, new.Alasan_Eligible_PIP, "Insert", "CURRRENT_USER()", NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_kip_kps_pip` AFTER UPDATE ON `kip_kps_pip` FOR EACH ROW BEGIN
INSERT INTO log_kip_kps_pip(ID_Status, Siswa_ID, Status_KIP, No_KIP, Status_KPS, No_KPS,
Status_Eligible_PIP, Alasan_Eligible_PIP, Action, Username, Waktu)
VALUES (new.ID_Status, new.Siswa_ID, new.Status_KIP, new.No_KIP, new.Status_KPS, new.No_KPS,
new.Status_Eligible_PIP, new.Alasan_Eligible_PIP, "Update", "CURRRENT_USER()", NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `list_ekstrakurikuler`
-- (See below for the actual view)
--
CREATE TABLE `list_ekstrakurikuler` (
`Kode_Ekskul` char(5)
,`Nama_Ekskul` varchar(30)
,`Hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu')
,`Waktu_Mulai` time
,`Waktu_Selesai` time
,`Guru_Ekskul` varchar(150)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `list_guru_aktif`
-- (See below for the actual view)
--
CREATE TABLE `list_guru_aktif` (
`NUPTK` bigint(20)
,`NIK` varchar(18)
,`Nama_Guru` varchar(150)
,`Jenis_Kelamin` enum('L','P')
,`Tempat_Lahir` varchar(100)
,`Tanggal_Lahir` date
,`Status_Kepegawaian` enum('GTY/PTY','Guru Honor')
,`Jenis_PTK` enum('Guru Mapel','Guru Wali Kelas')
,`Jenjang_Pendidikan` varchar(100)
,`TMT_Kerja` date
,`JJM` int(2)
,`Status` enum('Aktif','Resign','Diberhentikan','Cuti')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `list_siswa_aktif`
-- (See below for the actual view)
--
CREATE TABLE `list_siswa_aktif` (
`NISN` int(10)
,`NIPD` int(3)
,`Nama_Siswa` varchar(150)
,`Jenis_Kelamin` enum('L','P')
,`Tempat_Lahir` varchar(100)
,`Tanggal_Lahir` date
,`Agama` enum('Islam','Kristen','Katholik','Hindu','Buddha','Konghucu')
,`Alamat` varchar(255)
,`No_hp` varchar(13)
,`Status_dlm_Klrg` enum('Anak Kandung','Anak Tiri')
,`Nama_Ayah` varchar(150)
,`Nama_Ibu` varchar(150)
,`Pekerjaan_Ayah` varchar(50)
,`Pekerjaan_Ibu` varchar(50)
,`No_Rek_Bank` varchar(50)
,`Bank_Atas_Nama` varchar(50)
,`Status_Siswa` enum('Aktif','Lulus','Pindah','Dropout','Tidak Aktif')
,`Sekolah_Asal` varchar(100)
,`Anak_Ke` int(2)
);

-- --------------------------------------------------------

--
-- Table structure for table `log_absensi_ekskul`
--

CREATE TABLE `log_absensi_ekskul` (
  `ID_Absensi` int(11) NOT NULL,
  `ID_Ekskul_Siswa` varchar(10) NOT NULL,
  `Tanggal` date NOT NULL,
  `Hadir` int(2) DEFAULT NULL,
  `Izin` int(2) DEFAULT NULL,
  `Alpa` int(2) DEFAULT NULL,
  `Sakit` int(2) DEFAULT NULL,
  `Action` varchar(6) DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_absensi_kelas`
--

CREATE TABLE `log_absensi_kelas` (
  `ID_Absensi` int(11) NOT NULL,
  `ID_Siswa` int(10) NOT NULL,
  `Kelas` varchar(10) NOT NULL,
  `Tanggal` date NOT NULL,
  `Hadir` int(2) DEFAULT NULL,
  `Izin` int(2) DEFAULT NULL,
  `Alpa` int(2) DEFAULT NULL,
  `Sakit` int(2) DEFAULT NULL,
  `Action` varchar(6) DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_ekskul_siswa`
--

CREATE TABLE `log_ekskul_siswa` (
  `ID_Ekskul_Siswa` varchar(10) DEFAULT NULL,
  `Kode_Ekskul` char(5) DEFAULT NULL,
  `ID_Siswa` int(10) DEFAULT NULL,
  `Thn_Ajaran` int(11) DEFAULT NULL,
  `Action` varchar(6) DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_ekstrakurikuler`
--

CREATE TABLE `log_ekstrakurikuler` (
  `Kode_Ekskul` char(5) DEFAULT NULL,
  `Nama_Ekskul` varchar(30) DEFAULT NULL,
  `Guru_Ekskul` bigint(20) DEFAULT NULL,
  `HARI` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') DEFAULT NULL,
  `Waktu_Mulai` time DEFAULT NULL,
  `Waktu_Selesai` time DEFAULT NULL,
  `Action` varchar(6) DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_guru`
--

CREATE TABLE `log_guru` (
  `NUPTK` bigint(20) DEFAULT NULL,
  `NIP` varchar(18) DEFAULT NULL,
  `Nama_Guru` varchar(150) DEFAULT NULL,
  `Jenis_Kelamin` enum('L','P') DEFAULT NULL,
  `Tempat_Lahir` varchar(100) DEFAULT NULL,
  `Tanggal_Lahir` varchar(100) DEFAULT NULL,
  `Status_kepegawaian` enum('GTY/PTY','Guru Honor') DEFAULT NULL,
  `Jenis_PTK` enum('Guru Mapel','Guru Wali Kelas') DEFAULT NULL,
  `Jenjang_Pendidikan` varchar(100) DEFAULT NULL,
  `TMT_Kerja` date DEFAULT NULL,
  `JJM` int(2) DEFAULT NULL,
  `Status` enum('Aktif','Resign','Diberhentikan','Cuti') DEFAULT NULL,
  `Action` varchar(6) DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_jadwal_mapel`
--

CREATE TABLE `log_jadwal_mapel` (
  `ID_Jadwal` varchar(10) DEFAULT NULL,
  `ID_Kelas` varchar(10) DEFAULT NULL,
  `Kode_Mapel` char(5) DEFAULT NULL,
  `ID_Thn_Ajaran` int(11) DEFAULT NULL,
  `Waktu_Mulai` time DEFAULT NULL,
  `Waktu_Selesai` time DEFAULT NULL,
  `Hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') DEFAULT NULL,
  `Action` varchar(6) DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_kelas`
--

CREATE TABLE `log_kelas` (
  `ID_Kelas` varchar(10) DEFAULT NULL,
  `Wali_Kelas` bigint(20) DEFAULT NULL,
  `Nama_Kelas` varchar(150) DEFAULT NULL,
  `Tingkatan` enum('7','8','9') DEFAULT NULL,
  `Kelompok_Kelas` enum('A','B','C','D','E') DEFAULT NULL,
  `Action` varchar(6) DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_kepala_sekolah`
--

CREATE TABLE `log_kepala_sekolah` (
  `ID_Kepsek` int(11) DEFAULT NULL,
  `Nama_Kepsek` varchar(150) DEFAULT NULL,
  `Jenis_Kelamin` enum('L','P') DEFAULT NULL,
  `Tempat_Lahir` varchar(100) DEFAULT NULL,
  `Tanggal_Lahir` date DEFAULT NULL,
  `Jenjang_Pendidikan` varchar(100) DEFAULT NULL,
  `Status` enum('Aktif','Resign','Diberhentikan','Cuti') DEFAULT NULL,
  `Action` varchar(6) DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_kip_kps_pip`
--

CREATE TABLE `log_kip_kps_pip` (
  `ID_Status` int(11) DEFAULT NULL,
  `Siswa_ID` int(16) DEFAULT NULL,
  `Status_KIP` enum('Ya','Tidak') DEFAULT NULL,
  `No_KIP` varchar(30) DEFAULT NULL,
  `Status_KPS` enum('Ya','Tidak') DEFAULT NULL,
  `No_KPS` varchar(30) DEFAULT NULL,
  `Status_Eligible_PIP` enum('Ya','Tidak') DEFAULT NULL,
  `Alasan_Eligible_PIP` varchar(50) DEFAULT NULL,
  `Action` varchar(6) DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_mata_pelajaran`
--

CREATE TABLE `log_mata_pelajaran` (
  `Kode_Mapel` char(5) DEFAULT NULL,
  `Nama_mapel` varchar(50) DEFAULT NULL,
  `KKM` int(2) DEFAULT NULL,
  `Guru_Mapel` bigint(20) DEFAULT NULL,
  `Action` varchar(6) DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_nilai`
--

CREATE TABLE `log_nilai` (
  `Nilai_ID` int(11) DEFAULT NULL,
  `Kode_Mapel` char(5) DEFAULT NULL,
  `ID_Siswa` int(10) DEFAULT NULL,
  `Thn_Ajaran` int(11) DEFAULT NULL,
  `Jenis` enum('F1','F2','F3','UTS','UAS') DEFAULT NULL,
  `Nilai_Pengetahuan` int(3) DEFAULT NULL,
  `Nilai_Keterampilan` int(3) DEFAULT NULL,
  `Action` varchar(6) DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_nilai`
--

INSERT INTO `log_nilai` (`Nilai_ID`, `Kode_Mapel`, `ID_Siswa`, `Thn_Ajaran`, `Jenis`, `Nilai_Pengetahuan`, `Nilai_Keterampilan`, `Action`, `Username`, `Waktu`) VALUES
(1, 'BIND', 117795632, 2, 'F1', 87, 70, 'Insert', 'CURRENT_USER()', '2023-11-27 16:48:54'),
(2, 'BIND', 117795632, 2, 'F2', 80, 78, 'Insert', 'CURRENT_USER()', '2023-11-27 16:48:54'),
(3, 'BIND', 117795632, 2, 'F3', 75, 78, 'Insert', 'CURRENT_USER()', '2023-11-27 16:48:54'),
(4, 'BIND', 117795632, 2, 'UTS', 80, 75, 'Insert', 'CURRENT_USER()', '2023-11-27 16:48:54'),
(5, 'BIND', 117795632, 2, 'UTS', 88, 75, 'Insert', 'CURRENT_USER()', '2023-11-27 16:48:54'),
(6, 'BIND', 117795632, 2, 'F1', 89, 80, 'Insert', 'CURRENT_USER()', '2023-11-27 16:48:54'),
(7, 'BING', 117795632, 2, 'F2', 80, 90, 'Insert', 'CURRENT_USER()', '2023-11-27 16:48:54'),
(8, 'BING', 117795632, 2, 'F3', 98, 78, 'Insert', 'CURRENT_USER()', '2023-11-27 16:48:54'),
(9, 'BING', 117795632, 2, 'UTS', 89, 78, 'Insert', 'CURRENT_USER()', '2023-11-27 16:48:54'),
(10, 'BING', 117795632, 2, 'UAS', 89, 78, 'Insert', 'CURRENT_USER()', '2023-11-27 16:48:54'),
(5, 'BIND', 117795632, 2, 'UAS', 88, 75, 'Update', 'CURRENT_USER()', '2023-11-27 16:58:57'),
(6, 'BING', 117795632, 2, 'F1', 89, 80, 'Update', 'CURRENT_USER()', '2023-11-27 17:00:15');

-- --------------------------------------------------------

--
-- Table structure for table `log_nilai_ekskul`
--

CREATE TABLE `log_nilai_ekskul` (
  `ID_Nilai` int(11) DEFAULT NULL,
  `ID_Ekskul_Siswa` varchar(10) DEFAULT NULL,
  `Nilai` enum('A','B','C','D','E') DEFAULT NULL,
  `Action` varchar(6) DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_nilai_ekskul`
--

INSERT INTO `log_nilai_ekskul` (`ID_Nilai`, `ID_Ekskul_Siswa`, `Nilai`, `Action`, `Username`, `Waktu`) VALUES
(1, 'MNR001', '', 'Insert', 'root@localhost', '2023-11-27 15:50:35'),
(2, 'PRK001', '', 'Insert', 'root@localhost', '2023-11-27 15:50:35');

-- --------------------------------------------------------

--
-- Table structure for table `log_prestasi`
--

CREATE TABLE `log_prestasi` (
  `ID_Prestasi` varchar(10) DEFAULT NULL,
  `Siswa` int(10) DEFAULT NULL,
  `Jenis_Prestasi` enum('Akademik','Non Akademik') DEFAULT NULL,
  `Deskripsi` varchar(150) DEFAULT NULL,
  `Tanggal` date DEFAULT NULL,
  `Action` varchar(6) DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_rapor`
--

CREATE TABLE `log_rapor` (
  `ID_Rapor` int(11) DEFAULT NULL,
  `ID_Nilai` int(11) DEFAULT NULL,
  `ID_Nilai_Ekskul` int(11) DEFAULT NULL,
  `ID_Prestasi` varchar(10) DEFAULT NULL,
  `ID_Absensi` int(11) DEFAULT NULL,
  `Action` varchar(6) DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_roles`
--

CREATE TABLE `log_roles` (
  `ID_Roles` bigint(20) DEFAULT NULL,
  `Email` varchar(150) DEFAULT NULL,
  `Password` varchar(60) DEFAULT NULL,
  `Nama_Role` enum('Kepala Sekolah','Siswa','Guru','Tata Usaha') DEFAULT NULL,
  `Action` varchar(6) DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_role_assignment`
--

CREATE TABLE `log_role_assignment` (
  `ID_Role_Assignment` int(11) DEFAULT NULL,
  `ID_ROles` bigint(20) DEFAULT NULL,
  `NISN` int(10) DEFAULT NULL,
  `NUPTK` bigint(20) DEFAULT NULL,
  `ID_Pegawai` int(11) DEFAULT NULL,
  `ID_Kepsek` int(11) DEFAULT NULL,
  `Action` varchar(6) DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_siswa`
--

CREATE TABLE `log_siswa` (
  `NISN` int(10) DEFAULT NULL,
  `NIPD` int(3) DEFAULT NULL,
  `Nama_Siswa` varchar(150) DEFAULT NULL,
  `Jenis_Kelamin` enum('L','P') DEFAULT NULL,
  `Tempat_Lahir` varchar(100) DEFAULT NULL,
  `Agama` enum('Islam','Kristen','Katholik','Hindu','Buddha','Konghucu') DEFAULT NULL,
  `Alamat` varchar(255) DEFAULT NULL,
  `No_hp` varchar(13) DEFAULT NULL,
  `Status_dlm_Klrg` enum('Anak Kandung','Anak Tiri') DEFAULT NULL,
  `Nama_Ayah` varchar(150) DEFAULT NULL,
  `Nama_Ibu` varchar(150) DEFAULT NULL,
  `Pekerjaan_Ayah` varchar(50) DEFAULT NULL,
  `Pekerjaan_Ibu` varchar(50) DEFAULT NULL,
  `Bank_Atas_Nama` varchar(50) DEFAULT NULL,
  `Status_Siswa` enum('Aktif','Lulus','Pindah','Dropout','Tidak Aktif') DEFAULT NULL,
  `Sekolah_Asal` varchar(100) DEFAULT NULL,
  `Anak_Ke` int(2) DEFAULT NULL,
  `Action` varchar(6) DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_tata_usaha`
--

CREATE TABLE `log_tata_usaha` (
  `ID_Pegawai` int(11) DEFAULT NULL,
  `Nama_Pegawai` varchar(150) DEFAULT NULL,
  `Jenis_kelamin` enum('L','P') DEFAULT NULL,
  `TMT_Kerja` date DEFAULT NULL,
  `Tempat_Lahir` varchar(100) DEFAULT NULL,
  `Tanggal_Lahir` date DEFAULT NULL,
  `Jenjang_Pendidikan` varchar(100) DEFAULT NULL,
  `Status` enum('Aktif','Resign','Diberhentikan','Cuti') DEFAULT NULL,
  `Action` varchar(6) DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_wali_siswa`
--

CREATE TABLE `log_wali_siswa` (
  `ID_Wali` int(11) DEFAULT NULL,
  `Nama_Wali` varchar(150) DEFAULT NULL,
  `Siswa_yang_Diwakilkan` int(10) DEFAULT NULL,
  `Pekerjaan_Wali` varchar(50) DEFAULT NULL,
  `No_Rek_Bank` varchar(50) DEFAULT NULL,
  `Bank_Atas_Nama` varchar(50) DEFAULT NULL,
  `Action` varchar(6) DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `Kode_Mapel` char(5) NOT NULL,
  `Nama_Mapel` varchar(50) NOT NULL,
  `KKM` int(2) NOT NULL,
  `Guru_Mapel` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`Kode_Mapel`, `Nama_Mapel`, `KKM`, `Guru_Mapel`) VALUES
('BIND', 'BAHASA INDONESIA', 75, 1148770671130093),
('BING', 'BAHASA INGGRIS', 70, 7545772673130023),
('IPA', 'ILMU PENGETAHUAN ALAM', 75, 1148770671130093),
('IPS', 'ILMU PENGETAHUAN SOSIAL', 75, 9736764665230312),
('MTK', 'MATEMATIKA', 75, 9261764666210083),
('PBP', 'PENDIDIKAN BUDI PEKERTI', 75, 5853776677230002),
('PJOK', 'PENDIDIKAN JASMANI, OLAHRAGA DAN KESEHATAN', 70, 2344763664110023),
('PPKN', 'PENDIDIKAN PANCASILA DAN KEWARGANEGARAAN', 75, 1554758660110042),
('SBY', 'SENI BUDAYA', 70, 8450774675230033);

--
-- Triggers `mata_pelajaran`
--
DELIMITER $$
CREATE TRIGGER `log_delete_mata_pelajaran` AFTER DELETE ON `mata_pelajaran` FOR EACH ROW BEGIN
INSERT INTO log_mata_pelajaran(Kode_Mapel, Nama_Mapel, KKM, Guru_Mapel,
		Action, Username, Waktu)
VALUES (OLD.Kode_Mapel, OLD.Nama_Mapel, OLD.KKM, OLD.Guru_Mapel,
		"Delete", "CURRENT_USER()", NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_insert_mata_pelajaran` AFTER INSERT ON `mata_pelajaran` FOR EACH ROW BEGIN
INSERT INTO log_mata_pelajaran(Kode_Mapel, Nama_Mapel, KKM, Guru_Mapel,
Action, Username, Waktu)
VALUES (new.Kode_Mapel, new.Nama_Mapel, new.KKM, new.Guru_Mapel,
"Insert", "CURRENT_USER()", NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_mata_pelajaran` AFTER UPDATE ON `mata_pelajaran` FOR EACH ROW BEGIN
INSERT INTO log_mata_pelajaran(Kode_Mapel, Nama_Mapel, KKM, Guru_Mapel,
		Action, Username, Waktu)
VALUES (new.Kode_Mapel, new.Nama_Mapel, new.KKM, new.Guru_Mapel,
		"Update", "CURRENT_USER()", NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `Nilai_ID` int(11) NOT NULL,
  `Kode_Mapel` char(5) NOT NULL,
  `ID_Siswa` int(10) NOT NULL,
  `Thn_Ajaran` int(11) NOT NULL,
  `Jenis` enum('F1','F2','F3','UTS','UAS') DEFAULT NULL,
  `Nilai_Pengetahuan` int(3) NOT NULL,
  `Nilai_Keterampilan` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`Nilai_ID`, `Kode_Mapel`, `ID_Siswa`, `Thn_Ajaran`, `Jenis`, `Nilai_Pengetahuan`, `Nilai_Keterampilan`) VALUES
(1, 'BIND', 117795632, 2, 'F1', 87, 70),
(2, 'BIND', 117795632, 2, 'F2', 80, 78),
(3, 'BIND', 117795632, 2, 'F3', 75, 78),
(4, 'BIND', 117795632, 2, 'UTS', 80, 75),
(5, 'BIND', 117795632, 2, 'UAS', 88, 75),
(6, 'BING', 117795632, 2, 'F1', 89, 80),
(7, 'BING', 117795632, 2, 'F2', 80, 90),
(8, 'BING', 117795632, 2, 'F3', 98, 78),
(9, 'BING', 117795632, 2, 'UTS', 89, 78),
(10, 'BING', 117795632, 2, 'UAS', 89, 78);

--
-- Triggers `nilai`
--
DELIMITER $$
CREATE TRIGGER `log_insert_nilai` AFTER INSERT ON `nilai` FOR EACH ROW BEGIN
INSERT INTO log_nilai(Nilai_ID, Kode_Mapel, ID_Siswa, Thn_Ajaran, Jenis,
		Nilai_Pengetahuan, Nilai_Keterampilan, Action, Username, Waktu)
VALUES (new.Nilai_ID, new.Kode_Mapel, new.ID_Siswa, new.Thn_Ajaran, new.Jenis,
	new.Nilai_Pengetahuan, new.Nilai_Keterampilan, "Insert", "CURRENT_USER()", NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_nilai` AFTER UPDATE ON `nilai` FOR EACH ROW BEGIN
INSERT INTO log_nilai(Nilai_ID, Kode_Mapel, ID_Siswa, Thn_Ajaran, Jenis,
		Nilai_Pengetahuan, Nilai_Keterampilan, Action, Username, Waktu)
VALUES (new.Nilai_ID, new.Kode_Mapel, new.ID_Siswa, new.Thn_Ajaran, new.Jenis,
	new.Nilai_Pengetahuan, new.Nilai_Keterampilan, "Update", "CURRENT_USER()", NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `nilai_ekskul`
--

CREATE TABLE `nilai_ekskul` (
  `ID_Nilai` int(11) NOT NULL,
  `ID_Ekskul_Siswa` varchar(10) NOT NULL,
  `Nilai` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai_ekskul`
--

INSERT INTO `nilai_ekskul` (`ID_Nilai`, `ID_Ekskul_Siswa`, `Nilai`) VALUES
(1, 'MNR001', 80),
(2, 'PRK001', 90);

--
-- Triggers `nilai_ekskul`
--
DELIMITER $$
CREATE TRIGGER `log_insert_nilai_ekskul` AFTER INSERT ON `nilai_ekskul` FOR EACH ROW BEGIN
    INSERT INTO log_nilai_ekskul(ID_Nilai, ID_Ekskul_Siswa, Nilai, 
        Action, Username, Waktu)
    VALUES (new.ID_Nilai, new.ID_Ekskul_Siswa, new.Nilai, 
        'Insert', CURRENT_USER(), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_nilai_ekskul` AFTER UPDATE ON `nilai_ekskul` FOR EACH ROW BEGIN
INSERT INTO log_nilai_ekskul(ID_Nilai, ID_Ekskul_Siswa, Nilai, 
			Action, Username, Waktu)
VALUES (new.ID_Nilai, new.ID_Ekskul_Siswa, new.Nilai, 
	"Update", "CURRENT_USER()", NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `prestasi`
--

CREATE TABLE `prestasi` (
  `ID_Prestasi` varchar(10) NOT NULL,
  `Siswa` int(10) DEFAULT NULL,
  `Jenis_Prestasi` enum('Akademik','Non Akademik') DEFAULT NULL,
  `Deskripsi` varchar(150) DEFAULT NULL,
  `Tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prestasi`
--

INSERT INTO `prestasi` (`ID_Prestasi`, `Siswa`, `Jenis_Prestasi`, `Deskripsi`, `Tanggal`) VALUES
('P01', 78791950, 'Non Akademik', 'Karate', '2023-10-12');

--
-- Triggers `prestasi`
--
DELIMITER $$
CREATE TRIGGER `log_insert_prestasi` AFTER INSERT ON `prestasi` FOR EACH ROW BEGIN
INSERT INTO log_prestasi(ID_Prestasi, Siswa, Jenis_Prestasi, Deskripsi,
			Tanggal, Action, Username, Waktu)
VALUES (new.ID_Prestasi, new.Siswa, new.Jenis_Prestasi, new.Deskripsi,
			new.Tanggal, "Insert", "CURRENT_USER()", NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_prestasi` AFTER UPDATE ON `prestasi` FOR EACH ROW BEGIN
INSERT INTO log_prestasi(ID_Prestasi, Siswa, Jenis_Prestasi, Deskripsi,
			Tanggal, Action, Username, Waktu)
VALUES (new.ID_Prestasi, new.Siswa, new.Jenis_Prestasi, new.Deskripsi,
			new.Tanggal, "Update", "CURRENT_USER()", NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `rapor`
--

CREATE TABLE `rapor` (
  `ID_Rapor` int(11) NOT NULL,
  `ID_Nilai` int(11) NOT NULL,
  `ID_Nilai_Ekskul` int(11) NOT NULL,
  `ID_Prestasi` varchar(10) NOT NULL,
  `ID_Absensi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `rapor`
--
DELIMITER $$
CREATE TRIGGER `log_insert_rapor` AFTER INSERT ON `rapor` FOR EACH ROW BEGIN
    INSERT INTO log_rapor(ID_Rapor, ID_Nilai, ID_Nilai_Ekskul, ID_Prestasi,
        ID_Absensi, Action, Username, Waktu)
    VALUES (new.ID_Rapor, new.ID_Nilai, new.ID_Nilai_Ekskul, new.ID_Prestasi,
        new.ID_Absensi, 'Insert', CURRENT_USER(), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_rapor` AFTER UPDATE ON `rapor` FOR EACH ROW BEGIN
    INSERT INTO log_rapor(ID_Rapor, ID_Nilai, ID_Nilai_Ekskul, ID_Prestasi,
        ID_Absensi, Action, Username, Waktu)
    VALUES (new.ID_Rapor, new.ID_Nilai, new.ID_Nilai_Ekskul, new.ID_Prestasi,
        new.ID_Absensi, 'Update', CURRENT_USER(), NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `ID_Roles` bigint(20) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Password` varchar(60) NOT NULL,
  `Nama_Role` enum('Kepala Sekolah','Siswa','Guru','Tata Usaha') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `roles`
--
DELIMITER $$
CREATE TRIGGER `disable_update_roles` BEFORE UPDATE ON `roles` FOR EACH ROW BEGIN 
    IF (OLD.ID_Roles <> NEW.ID_Roles) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Tidak dapat mengubah role';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_insert_roles` AFTER INSERT ON `roles` FOR EACH ROW BEGIN 
    INSERT INTO log_insert_roles(ID_Roles, Email, Password, Nama_Role,
        Action, Username, Waktu)
    VALUES (new.ID_Roles, new.Email, new.Password, new.Nama_Role,
        'Insert', CURRENT_USER(), NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `role_assignment`
--

CREATE TABLE `role_assignment` (
  `ID_Role_Assignment` int(11) NOT NULL,
  `ID_Roles` bigint(20) DEFAULT NULL,
  `NISN` int(10) DEFAULT NULL,
  `NUPTK` bigint(20) DEFAULT NULL,
  `ID_Pegawai` int(11) DEFAULT NULL,
  `ID_Kepsek` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `role_assignment`
--
DELIMITER $$
CREATE TRIGGER `log_insert_role_assignment` AFTER INSERT ON `role_assignment` FOR EACH ROW BEGIN 
    INSERT INTO log_role_assignment(ID_Role_Assignment, ID_Roles, NISN, NUPTK, ID_Pegawai,
				ID_Kepsek, Action, Username, Waktu)
    VALUES (new.ID_Role_Assignment, new.ID_Roles, new.NISN, new.NUPTK, new.ID_Pegawai,
				new.ID_Kepsek, 'Insert', CURRENT_USER(), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_role_assignment` AFTER UPDATE ON `role_assignment` FOR EACH ROW BEGIN 
INSERT INTO log_roles_assignmnet(ID_Role_Assignment, ID_Roles, NISN, NUPTK, ID_Pegawai,
				ID_Kepsek, Action, Username, Waktu)
VALUES (new.ID_Role_Assignment, new.ID_Roles, new.NISN, new.NUPTK, new.ID_Pegawai,
				new.ID_Kepsek, "Update", "CURRENT_USER()", NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `roster`
-- (See below for the actual view)
--
CREATE TABLE `roster` (
`ID_Jadwal` varchar(10)
,`Nama_Kelas` varchar(150)
,`Wali_Kelas` bigint(20)
,`Kode_Mapel` char(5)
,`Nama_Mapel` varchar(50)
,`Guru_Mapel` bigint(20)
,`Thn_Ajaran` char(9)
,`Semester` enum('GANJIL','GENAP')
,`Waktu_Mulai` time
,`Waktu_Selesai` time
,`Hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu')
);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `NISN` int(10) NOT NULL,
  `NIPD` int(3) NOT NULL,
  `Nama_Siswa` varchar(150) NOT NULL,
  `Jenis_Kelamin` enum('L','P') DEFAULT NULL,
  `Tempat_Lahir` varchar(100) NOT NULL,
  `Tanggal_Lahir` date NOT NULL,
  `Agama` enum('Islam','Kristen','Katholik','Hindu','Buddha','Konghucu') DEFAULT NULL,
  `Alamat` varchar(255) DEFAULT NULL,
  `No_hp` varchar(13) NOT NULL,
  `Status_dlm_Klrg` enum('Anak Kandung','Anak Tiri') DEFAULT NULL,
  `Nama_Ayah` varchar(150) NOT NULL,
  `Nama_Ibu` varchar(150) NOT NULL,
  `Pekerjaan_Ayah` varchar(50) DEFAULT NULL,
  `Pekerjaan_Ibu` varchar(50) DEFAULT NULL,
  `No_Rek_Bank` varchar(50) DEFAULT NULL,
  `Bank_Atas_Nama` varchar(50) DEFAULT NULL,
  `Status_Siswa` enum('Aktif','Lulus','Pindah','Dropout','Tidak Aktif') DEFAULT NULL,
  `Sekolah_Asal` varchar(100) DEFAULT NULL,
  `Anak_Ke` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`NISN`, `NIPD`, `Nama_Siswa`, `Jenis_Kelamin`, `Tempat_Lahir`, `Tanggal_Lahir`, `Agama`, `Alamat`, `No_hp`, `Status_dlm_Klrg`, `Nama_Ayah`, `Nama_Ibu`, `Pekerjaan_Ayah`, `Pekerjaan_Ibu`, `No_Rek_Bank`, `Bank_Atas_Nama`, `Status_Siswa`, `Sekolah_Asal`, `Anak_Ke`) VALUES
(78791950, 0, 'ADITYA ALFARIZ', 'L', 'MEDAN', '2007-10-15', 'Islam', 'JL. K.L. YOS SUDARSO LINK III KM 9,5, KELURAHAN MABAR, KECAMATAN MEDAN DENAI, 20242', '082361335050', 'Anak Kandung', 'RAHMANSYAH', 'NUR ASYIAH', 'WIRASWASTA', 'TIDAK BEKERJA', NULL, NULL, 'Aktif', 'SDS PUTRA NEGERI', 1),
(91676040, 211, 'ADAM AGUSTIAN', 'L', 'MEDAN', '2009-08-11', 'Islam', 'JL. NUSA INDAH GG. FLAMBOYAN, KELURAHAN TANJUNG MULIA, KECAMATAN MEDAN DELI, KODE POS 20241', '081397922960', 'Anak Kandung', 'ADI ISWANTO', 'WINARTIK', 'WIRASWASTA', 'TIDAK BEKERJA', NULL, NULL, 'Aktif', NULL, 2),
(108254549, 0, 'AILA ALMIRA', 'P', 'MEDAN', '2010-09-16', 'Islam', 'JL. NUSA INDAH Gg. FLAMBOYAN, KELURAHAN TANJUNG MULIA, KECAMATAN MEDAN DELI, 20241', '085679037660', 'Anak Kandung', 'ANDI PURNAMA', 'BEDA MANDASARI', 'WIRASWASTA', 'TIDAK BEKERJA', NULL, NULL, 'Aktif', 'SDS AMALYATUL HUDA', 3),
(109600822, 0, 'AFDU FIKAR', 'L', 'SEI MUKA', '2010-12-13', 'Islam', 'JL. DUSUN IV A PASAR VII DESA MANUNGGAL, KECAMATAN MEDAN DENAI, ', '082361335050', 'Anak Kandung', 'MISKUN', 'IIN NURLENI', 'WIRASWASTA', 'TIDAK BEKERJA', NULL, NULL, 'Aktif', 'SDS AMALYATUL HUDA', 1),
(114715088, 0, 'AHMAD JUHARI SITEPU', 'L', 'SEI MUKA', '2012-01-22', 'Islam', 'DUSUN III Anjung Ganjang, KECAMATAN SIMPANG EMPAT,21271', '082267878625', 'Anak Kandung', 'AGUS SITEPU', 'DARMA WATI BR BUTAR BUTAR', 'WIRASWASTA', 'TIDAK BEKERJA', NULL, NULL, 'Aktif', 'UPTD SDN 016546 TELUK DALAM', 1),
(117795632, 0, 'ABDUL ROSYIIT', 'L', 'LANGKAT', '2011-04-26', 'Islam', 'DUSUN 1 TANJUNG JATI KECAMATAN BINJAI, KODE POS 20761', '082164934533', 'Anak Kandung', 'MISDIANTO', 'SRI WAHYUNI', 'WIRASWASTA', 'TIDAK BEKERJA', NULL, NULL, 'Aktif', 'SD NEGERI 026606', 3);

--
-- Triggers `siswa`
--
DELIMITER $$
CREATE TRIGGER `log_insert_siswa` AFTER INSERT ON `siswa` FOR EACH ROW BEGIN
    INSERT INTO log_siswa(NISN, NIPD, Nama_Siswa, Jenis_Kelamin, Tempat_Lahir, Agama, Alamat, No_hp, Status_dlm_Klrg, Nama_Ayah, Nama_Ibu,
        Pekerjaan_Ayah, Pekerjaan_Ibu, Bank_Atas_Nama, Status_Siswa, Sekolah_Asal, Anak_Ke, Action, Username, Waktu)
    VALUES (new.NISN, new.NIPD, new.Nama_Siswa, new.Jenis_Kelamin, new.Tempat_Lahir, new.Agama, new.Alamat, new.No_hp, new.Status_dlm_Klrg, new.Nama_Ayah, new.Nama_Ibu,
        new.Pekerjaan_Ayah, new.Pekerjaan_Ibu, new.Bank_Atas_Nama, new.Status_Siswa, new.Sekolah_Asal, new.Anak_Ke, 'Insert', CURRENT_USER(), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_siswa` AFTER UPDATE ON `siswa` FOR EACH ROW BEGIN
    INSERT INTO log_siswa(NISN, NIPD, Nama_Siswa, Jenis_Kelamin, Tempat_Lahir, Agama, Alamat, No_hp, Status_dlm_Klrg, Nama_Ayah, Nama_Ibu,
        Pekerjaan_Ayah, Pekerjaan_Ibu, Bank_Atas_Nama, Status_Siswa, Sekolah_Asal, Anak_Ke, Action, Username, Waktu)
    VALUES (new.NISN, new.NIPD, new.Nama_Siswa, new.Jenis_Kelamin, new.Tempat_Lahir, new.Agama, new.Alamat, new.No_hp, new.Status_dlm_Klrg, new.Nama_Ayah, new.Nama_Ibu,
        new.Pekerjaan_Ayah, new.Pekerjaan_Ibu, new.Bank_Atas_Nama, new.Status_Siswa, new.Sekolah_Asal, new.Anak_Ke, 'Update', CURRENT_USER(), NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `siswa_inactive`
-- (See below for the actual view)
--
CREATE TABLE `siswa_inactive` (
`NISN` int(10)
,`NIPD` int(3)
,`Nama_Siswa` varchar(150)
,`Jenis_Kelamin` enum('L','P')
,`Tempat_Lahir` varchar(100)
,`Tanggal_Lahir` date
,`Agama` enum('Islam','Kristen','Katholik','Hindu','Buddha','Konghucu')
,`Alamat` varchar(255)
,`No_hp` varchar(13)
,`Status_dlm_Klrg` enum('Anak Kandung','Anak Tiri')
,`Nama_Ayah` varchar(150)
,`Nama_Ibu` varchar(150)
,`Pekerjaan_Ayah` varchar(50)
,`Pekerjaan_Ibu` varchar(50)
,`No_Rek_Bank` varchar(50)
,`Bank_Atas_Nama` varchar(50)
,`Status_Siswa` enum('Aktif','Lulus','Pindah','Dropout','Tidak Aktif')
,`Sekolah_Asal` varchar(100)
,`Anak_Ke` int(2)
);

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `ID_Thn_Ajaran` int(11) NOT NULL,
  `Thn_Ajaran` char(9) NOT NULL,
  `Semester` enum('GANJIL','GENAP') NOT NULL,
  `Tanggal_Mulai` date NOT NULL,
  `Tanggal_Selesai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`ID_Thn_Ajaran`, `Thn_Ajaran`, `Semester`, `Tanggal_Mulai`, `Tanggal_Selesai`) VALUES
(1, '2025/2026', 'GENAP', '2025-07-12', '2026-12-20'),
(2, '2022/2023', 'GANJIL', '2022-07-12', '2022-12-26'),
(3, '2022/2023', 'GENAP', '2023-01-10', '2023-06-28'),
(4, '2025/2026', 'GENAP', '2025-07-10', '2026-12-25');

-- --------------------------------------------------------

--
-- Table structure for table `tata_usaha`
--

CREATE TABLE `tata_usaha` (
  `ID_Pegawai` int(11) NOT NULL,
  `Nama_Pegawai` varchar(150) NOT NULL,
  `Jenis_Kelamin` enum('L','P') DEFAULT NULL,
  `TMT_Kerja` date NOT NULL,
  `Tempat_Lahir` varchar(100) NOT NULL,
  `Tanggal_Lahir` date NOT NULL,
  `Jenjang_Pendidikan` varchar(100) NOT NULL,
  `Status` enum('Aktif','Resign','Diberhentikan','Cuti') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tata_usaha`
--

INSERT INTO `tata_usaha` (`ID_Pegawai`, `Nama_Pegawai`, `Jenis_Kelamin`, `TMT_Kerja`, `Tempat_Lahir`, `Tanggal_Lahir`, `Jenjang_Pendidikan`, `Status`) VALUES
(12345627, 'Keisya', 'P', '2016-07-18', 'Medan', '1993-06-17', 'S1-TI', 'Aktif'),
(19880834, 'CHANDRA', 'L', '2010-10-11', 'MEDAN', '1988-02-23', 'D-3 ILMU KOMPUTER', 'Aktif');

--
-- Triggers `tata_usaha`
--
DELIMITER $$
CREATE TRIGGER `log_insert_tata_usaha` AFTER INSERT ON `tata_usaha` FOR EACH ROW BEGIN 
INSERT INTO log_tata_usaha(ID_Pegawai, Nama_Pegawai, Jenis_Kelamin, TMT_Kerja, Tempat_Lahir,
			Tanggal_Lahir, Jenjang_Pendidikan, Status, Action, Username, Waktu)
VALUES (new.ID_Pegawai, new.Nama_Pegawai, new.Jenis_Kelamin, new.TMT_Kerja, new.Tempat_Lahir,
			new.Tanggal_Lahir, new.Jenjang_Pendidikan, new.Status, "Insert", "CURRENT_USER()", NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_tata_usaha` AFTER UPDATE ON `tata_usaha` FOR EACH ROW BEGIN 
INSERT INTO log_tata_usaha(ID_Pegawai, Nama_Pegawai, Jenis_Kelamin, TMT_Kerja, Tempat_Lahir,
			Tanggal_Lahir, Jenjang_Pendidikan, Status, Action, Username, Waktu)
VALUES (new.ID_Pegawai, new.Nama_Pegawai, new.Jenis_Kelamin, new.TMT_Kerja, new.Tempat_Lahir,
			new.Tanggal_Lahir, new.Jenjang_Pendidikan, new.Status, "Update", "CURRENT_USER()", NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_nilai_f1`
-- (See below for the actual view)
--
CREATE TABLE `view_nilai_f1` (
`Nilai_ID` int(11)
,`Kode_Mapel` char(5)
,`ID_Siswa` int(10)
,`Thn_Ajaran` int(11)
,`Nilai_Pengetahuan` int(3)
,`Nilai_Keterampilan` int(3)
,`Nama_Guru` varchar(150)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_nilai_f2`
-- (See below for the actual view)
--
CREATE TABLE `view_nilai_f2` (
`Nilai_ID` int(11)
,`Kode_Mapel` char(5)
,`ID_Siswa` int(10)
,`Thn_Ajaran` int(11)
,`Nilai_Pengetahuan` int(3)
,`Nilai_Keterampilan` int(3)
,`Nama_Guru` varchar(150)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_nilai_f3`
-- (See below for the actual view)
--
CREATE TABLE `view_nilai_f3` (
`Nilai_ID` int(11)
,`Kode_Mapel` char(5)
,`ID_Siswa` int(10)
,`Thn_Ajaran` int(11)
,`Nilai_Pengetahuan` int(3)
,`Nilai_Keterampilan` int(3)
,`Nama_Guru` varchar(150)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_nilai_uas`
-- (See below for the actual view)
--
CREATE TABLE `view_nilai_uas` (
`Nilai_ID` int(11)
,`Kode_Mapel` char(5)
,`ID_Siswa` int(10)
,`Thn_Ajaran` int(11)
,`Nilai_Pengetahuan` int(3)
,`Nilai_Keterampilan` int(3)
,`Nama_Guru` varchar(150)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_nilai_uts`
-- (See below for the actual view)
--
CREATE TABLE `view_nilai_uts` (
`Nilai_ID` int(11)
,`Kode_Mapel` char(5)
,`ID_Siswa` int(10)
,`Thn_Ajaran` int(11)
,`Nilai_Pengetahuan` int(3)
,`Nilai_Keterampilan` int(3)
,`Nama_Guru` varchar(150)
);

-- --------------------------------------------------------

--
-- Table structure for table `wali_siswa`
--

CREATE TABLE `wali_siswa` (
  `ID_Wali` int(11) NOT NULL,
  `Nama_Wali` varchar(150) NOT NULL,
  `Siswa_yang_Diwakilkan` int(10) DEFAULT NULL,
  `Pekerjaan_Wali` varchar(50) DEFAULT NULL,
  `No_Rek_Bank` varchar(50) DEFAULT NULL,
  `Bank_Atas_Nama` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wali_siswa`
--

INSERT INTO `wali_siswa` (`ID_Wali`, `Nama_Wali`, `Siswa_yang_Diwakilkan`, `Pekerjaan_Wali`, `No_Rek_Bank`, `Bank_Atas_Nama`) VALUES
(1, 'SAKIFA INDIRA PUTRI', 114715088, 'PENGUSAHA', NULL, NULL);

--
-- Triggers `wali_siswa`
--
DELIMITER $$
CREATE TRIGGER `log_insert_wali_siswa` AFTER INSERT ON `wali_siswa` FOR EACH ROW BEGIN 
	INSERT INTO log_wali_siswa(ID_Wali, Nama_Wali, Siswa_yang_Diwakilkan, Pekerjaan_Wali,
				No_Rek_Bank, Bank_Atas_Nama, Action, Username, Waktu)

	VALUES (new.ID_Wali, new.Nama_Wali, new.Siswa_yang_Diwakilkan, new.Pekerjaan_Wali,
				new.No_Rek_Bank, new.Bank_Atas_Nama, "Insert", "CURRENT_USER()", NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_wali_siswa` AFTER UPDATE ON `wali_siswa` FOR EACH ROW BEGIN 
	INSERT INTO log_wali_siswa(ID_Wali, Nama_Wali, Siswa_yang_Diwakilkan, Pekerjaan_Wali,
				No_Rek_Bank, Bank_Atas_Nama, Action, Username, Waktu)

	VALUES (new.ID_Wali, new.Nama_Wali, new.Siswa_yang_Diwakilkan, new.Pekerjaan_Wali,
				new.No_Rek_Bank, new.Bank_Atas_Nama, "Insert", "CURRENT_USER()", NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure for view `detail_nilai`
--
DROP TABLE IF EXISTS `detail_nilai`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detail_nilai`  AS SELECT `n`.`Nilai_ID` AS `Nilai_ID`, `n`.`Kode_Mapel` AS `Kode_Mapel`, `n`.`ID_Siswa` AS `ID_Siswa`, `n`.`Thn_Ajaran` AS `Thn_Ajaran`, `n`.`Jenis` AS `Jenis`, `n`.`Nilai_Pengetahuan` AS `Nilai_Pengetahuan`, `n`.`Nilai_Keterampilan` AS `Nilai_Keterampilan`, `mp`.`Nama_Mapel` AS `Nama_Mapel`, `mp`.`KKM` AS `KKM`, `g`.`NUPTK` AS `NUPTK`, `g`.`Nama_Guru` AS `Nama_Guru`, `s`.`NISN` AS `NISN`, `s`.`Nama_Siswa` AS `Nama_Siswa`, `ta`.`Thn_Ajaran` AS `Tahun_Ajaran`, `ta`.`Semester` AS `Semester` FROM ((((`nilai` `n` join `mata_pelajaran` `mp` on(`n`.`Kode_Mapel` = `mp`.`Kode_Mapel`)) join `guru` `g` on(`mp`.`Guru_Mapel` = `g`.`NUPTK`)) join `siswa` `s` on(`n`.`ID_Siswa` = `s`.`NISN`)) join `tahun_ajaran` `ta` on(`n`.`Thn_Ajaran` = `ta`.`ID_Thn_Ajaran`)) ;

-- --------------------------------------------------------

--
-- Structure for view `detail_prestasi`
--
DROP TABLE IF EXISTS `detail_prestasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detail_prestasi`  AS SELECT `p`.`ID_Prestasi` AS `ID_Prestasi`, `s`.`NISN` AS `NISN`, `s`.`Nama_Siswa` AS `Nama_Siswa`, `p`.`Jenis_Prestasi` AS `Jenis_Prestasi`, `p`.`Deskripsi` AS `Deskripsi`, `p`.`Tanggal` AS `Tanggal` FROM (`prestasi` `p` join `siswa` `s` on(`p`.`Siswa` = `s`.`NISN`)) ;

-- --------------------------------------------------------

--
-- Structure for view `guru_non_aktif`
--
DROP TABLE IF EXISTS `guru_non_aktif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `guru_non_aktif`  AS SELECT `guru`.`NUPTK` AS `NUPTK`, `guru`.`NIK` AS `NIK`, `guru`.`Nama_Guru` AS `Nama_Guru`, `guru`.`Jenis_Kelamin` AS `Jenis_Kelamin`, `guru`.`Tempat_Lahir` AS `Tempat_Lahir`, `guru`.`Tanggal_Lahir` AS `Tanggal_Lahir`, `guru`.`Status_Kepegawaian` AS `Status_Kepegawaian`, `guru`.`Jenis_PTK` AS `Jenis_PTK`, `guru`.`Jenjang_Pendidikan` AS `Jenjang_Pendidikan`, `guru`.`TMT_Kerja` AS `TMT_Kerja`, `guru`.`JJM` AS `JJM`, `guru`.`Status` AS `Status` FROM `guru` WHERE `guru`.`Status` <> 'Aktif' ;

-- --------------------------------------------------------

--
-- Structure for view `info_nilai_ekskul`
--
DROP TABLE IF EXISTS `info_nilai_ekskul`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `info_nilai_ekskul`  AS SELECT `ne`.`ID_Nilai` AS `ID_Nilai`, `ne`.`ID_Ekskul_Siswa` AS `ID_Ekskul_Siswa`, `ne`.`Nilai` AS `Nilai`, `es`.`Kode_Ekskul` AS `Kode_Ekskul`, `es`.`ID_Siswa` AS `ID_Siswa`, `s`.`Nama_Siswa` AS `Nama_Siswa`, `ek`.`Nama_Ekskul` AS `Nama_Ekskul`, `ek`.`Guru_Ekskul` AS `Guru_Ekskul`, `g`.`Nama_Guru` AS `Nama_Guru`, `ta`.`Thn_Ajaran` AS `Thn_Ajaran`, `ta`.`Semester` AS `Semester` FROM (((((`nilai_ekskul` `ne` join `ekskul_siswa` `es` on(`ne`.`ID_Ekskul_Siswa` = `es`.`ID_Ekskul_Siswa`)) join `ekstrakurikuler` `ek` on(`es`.`Kode_Ekskul` = `ek`.`Kode_Ekskul`)) join `guru` `g` on(`ek`.`Guru_Ekskul` = `g`.`NUPTK`)) join `siswa` `s` on(`es`.`ID_Siswa` = `s`.`NISN`)) join `tahun_ajaran` `ta` on(`es`.`Thn_Ajaran` = `ta`.`ID_Thn_Ajaran`)) ;

-- --------------------------------------------------------

--
-- Structure for view `list_ekstrakurikuler`
--
DROP TABLE IF EXISTS `list_ekstrakurikuler`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `list_ekstrakurikuler`  AS SELECT `e`.`Kode_Ekskul` AS `Kode_Ekskul`, `e`.`Nama_Ekskul` AS `Nama_Ekskul`, `e`.`Hari` AS `Hari`, `e`.`Waktu_Mulai` AS `Waktu_Mulai`, `e`.`Waktu_Selesai` AS `Waktu_Selesai`, `g`.`Nama_Guru` AS `Guru_Ekskul` FROM (`ekstrakurikuler` `e` join `guru` `g` on(`e`.`Guru_Ekskul` = `g`.`NUPTK`)) ;

-- --------------------------------------------------------

--
-- Structure for view `list_guru_aktif`
--
DROP TABLE IF EXISTS `list_guru_aktif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `list_guru_aktif`  AS SELECT `guru`.`NUPTK` AS `NUPTK`, `guru`.`NIK` AS `NIK`, `guru`.`Nama_Guru` AS `Nama_Guru`, `guru`.`Jenis_Kelamin` AS `Jenis_Kelamin`, `guru`.`Tempat_Lahir` AS `Tempat_Lahir`, `guru`.`Tanggal_Lahir` AS `Tanggal_Lahir`, `guru`.`Status_Kepegawaian` AS `Status_Kepegawaian`, `guru`.`Jenis_PTK` AS `Jenis_PTK`, `guru`.`Jenjang_Pendidikan` AS `Jenjang_Pendidikan`, `guru`.`TMT_Kerja` AS `TMT_Kerja`, `guru`.`JJM` AS `JJM`, `guru`.`Status` AS `Status` FROM `guru` WHERE `guru`.`Status` = 'Aktif' ;

-- --------------------------------------------------------

--
-- Structure for view `list_siswa_aktif`
--
DROP TABLE IF EXISTS `list_siswa_aktif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `list_siswa_aktif`  AS SELECT `siswa`.`NISN` AS `NISN`, `siswa`.`NIPD` AS `NIPD`, `siswa`.`Nama_Siswa` AS `Nama_Siswa`, `siswa`.`Jenis_Kelamin` AS `Jenis_Kelamin`, `siswa`.`Tempat_Lahir` AS `Tempat_Lahir`, `siswa`.`Tanggal_Lahir` AS `Tanggal_Lahir`, `siswa`.`Agama` AS `Agama`, `siswa`.`Alamat` AS `Alamat`, `siswa`.`No_hp` AS `No_hp`, `siswa`.`Status_dlm_Klrg` AS `Status_dlm_Klrg`, `siswa`.`Nama_Ayah` AS `Nama_Ayah`, `siswa`.`Nama_Ibu` AS `Nama_Ibu`, `siswa`.`Pekerjaan_Ayah` AS `Pekerjaan_Ayah`, `siswa`.`Pekerjaan_Ibu` AS `Pekerjaan_Ibu`, `siswa`.`No_Rek_Bank` AS `No_Rek_Bank`, `siswa`.`Bank_Atas_Nama` AS `Bank_Atas_Nama`, `siswa`.`Status_Siswa` AS `Status_Siswa`, `siswa`.`Sekolah_Asal` AS `Sekolah_Asal`, `siswa`.`Anak_Ke` AS `Anak_Ke` FROM `siswa` WHERE `siswa`.`Status_Siswa` = 'Aktif' ;

-- --------------------------------------------------------

--
-- Structure for view `roster`
--
DROP TABLE IF EXISTS `roster`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `roster`  AS SELECT `jm`.`ID_Jadwal` AS `ID_Jadwal`, `k`.`Nama_Kelas` AS `Nama_Kelas`, `k`.`Wali_Kelas` AS `Wali_Kelas`, `jm`.`Kode_Mapel` AS `Kode_Mapel`, `mp`.`Nama_Mapel` AS `Nama_Mapel`, `mp`.`Guru_Mapel` AS `Guru_Mapel`, `ta`.`Thn_Ajaran` AS `Thn_Ajaran`, `ta`.`Semester` AS `Semester`, `jm`.`Waktu_Mulai` AS `Waktu_Mulai`, `jm`.`Waktu_Selesai` AS `Waktu_Selesai`, `jm`.`Hari` AS `Hari` FROM (((`jadwal_mapel` `jm` join `kelas` `k` on(`jm`.`ID_Kelas` = `k`.`ID_Kelas`)) join `mata_pelajaran` `mp` on(`jm`.`Kode_Mapel` = `mp`.`Kode_Mapel`)) join `tahun_ajaran` `ta` on(`jm`.`ID_Thn_Ajaran` = `ta`.`ID_Thn_Ajaran`)) ;

-- --------------------------------------------------------

--
-- Structure for view `siswa_inactive`
--
DROP TABLE IF EXISTS `siswa_inactive`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `siswa_inactive`  AS SELECT `siswa`.`NISN` AS `NISN`, `siswa`.`NIPD` AS `NIPD`, `siswa`.`Nama_Siswa` AS `Nama_Siswa`, `siswa`.`Jenis_Kelamin` AS `Jenis_Kelamin`, `siswa`.`Tempat_Lahir` AS `Tempat_Lahir`, `siswa`.`Tanggal_Lahir` AS `Tanggal_Lahir`, `siswa`.`Agama` AS `Agama`, `siswa`.`Alamat` AS `Alamat`, `siswa`.`No_hp` AS `No_hp`, `siswa`.`Status_dlm_Klrg` AS `Status_dlm_Klrg`, `siswa`.`Nama_Ayah` AS `Nama_Ayah`, `siswa`.`Nama_Ibu` AS `Nama_Ibu`, `siswa`.`Pekerjaan_Ayah` AS `Pekerjaan_Ayah`, `siswa`.`Pekerjaan_Ibu` AS `Pekerjaan_Ibu`, `siswa`.`No_Rek_Bank` AS `No_Rek_Bank`, `siswa`.`Bank_Atas_Nama` AS `Bank_Atas_Nama`, `siswa`.`Status_Siswa` AS `Status_Siswa`, `siswa`.`Sekolah_Asal` AS `Sekolah_Asal`, `siswa`.`Anak_Ke` AS `Anak_Ke` FROM `siswa` WHERE `siswa`.`Status_Siswa` <> 'Aktif' ;

-- --------------------------------------------------------

--
-- Structure for view `view_nilai_f1`
--
DROP TABLE IF EXISTS `view_nilai_f1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_nilai_f1`  AS SELECT `n`.`Nilai_ID` AS `Nilai_ID`, `n`.`Kode_Mapel` AS `Kode_Mapel`, `n`.`ID_Siswa` AS `ID_Siswa`, `n`.`Thn_Ajaran` AS `Thn_Ajaran`, `n`.`Nilai_Pengetahuan` AS `Nilai_Pengetahuan`, `n`.`Nilai_Keterampilan` AS `Nilai_Keterampilan`, `g`.`Nama_Guru` AS `Nama_Guru` FROM ((`nilai` `n` join `mata_pelajaran` `m` on(`n`.`Kode_Mapel` = `m`.`Kode_Mapel`)) join `guru` `g` on(`m`.`Guru_Mapel` = `g`.`NUPTK`)) WHERE `n`.`Jenis` = 'F1' ;

-- --------------------------------------------------------

--
-- Structure for view `view_nilai_f2`
--
DROP TABLE IF EXISTS `view_nilai_f2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_nilai_f2`  AS SELECT `n`.`Nilai_ID` AS `Nilai_ID`, `n`.`Kode_Mapel` AS `Kode_Mapel`, `n`.`ID_Siswa` AS `ID_Siswa`, `n`.`Thn_Ajaran` AS `Thn_Ajaran`, `n`.`Nilai_Pengetahuan` AS `Nilai_Pengetahuan`, `n`.`Nilai_Keterampilan` AS `Nilai_Keterampilan`, `g`.`Nama_Guru` AS `Nama_Guru` FROM ((`nilai` `n` join `mata_pelajaran` `m` on(`n`.`Kode_Mapel` = `m`.`Kode_Mapel`)) join `guru` `g` on(`m`.`Guru_Mapel` = `g`.`NUPTK`)) WHERE `n`.`Jenis` = 'F2' ;

-- --------------------------------------------------------

--
-- Structure for view `view_nilai_f3`
--
DROP TABLE IF EXISTS `view_nilai_f3`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_nilai_f3`  AS SELECT `n`.`Nilai_ID` AS `Nilai_ID`, `n`.`Kode_Mapel` AS `Kode_Mapel`, `n`.`ID_Siswa` AS `ID_Siswa`, `n`.`Thn_Ajaran` AS `Thn_Ajaran`, `n`.`Nilai_Pengetahuan` AS `Nilai_Pengetahuan`, `n`.`Nilai_Keterampilan` AS `Nilai_Keterampilan`, `g`.`Nama_Guru` AS `Nama_Guru` FROM ((`nilai` `n` join `mata_pelajaran` `m` on(`n`.`Kode_Mapel` = `m`.`Kode_Mapel`)) join `guru` `g` on(`m`.`Guru_Mapel` = `g`.`NUPTK`)) WHERE `n`.`Jenis` = 'F3' ;

-- --------------------------------------------------------

--
-- Structure for view `view_nilai_uas`
--
DROP TABLE IF EXISTS `view_nilai_uas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_nilai_uas`  AS SELECT `n`.`Nilai_ID` AS `Nilai_ID`, `n`.`Kode_Mapel` AS `Kode_Mapel`, `n`.`ID_Siswa` AS `ID_Siswa`, `n`.`Thn_Ajaran` AS `Thn_Ajaran`, `n`.`Nilai_Pengetahuan` AS `Nilai_Pengetahuan`, `n`.`Nilai_Keterampilan` AS `Nilai_Keterampilan`, `g`.`Nama_Guru` AS `Nama_Guru` FROM ((`nilai` `n` join `mata_pelajaran` `m` on(`n`.`Kode_Mapel` = `m`.`Kode_Mapel`)) join `guru` `g` on(`m`.`Guru_Mapel` = `g`.`NUPTK`)) WHERE `n`.`Jenis` = 'UAS' ;

-- --------------------------------------------------------

--
-- Structure for view `view_nilai_uts`
--
DROP TABLE IF EXISTS `view_nilai_uts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_nilai_uts`  AS SELECT `n`.`Nilai_ID` AS `Nilai_ID`, `n`.`Kode_Mapel` AS `Kode_Mapel`, `n`.`ID_Siswa` AS `ID_Siswa`, `n`.`Thn_Ajaran` AS `Thn_Ajaran`, `n`.`Nilai_Pengetahuan` AS `Nilai_Pengetahuan`, `n`.`Nilai_Keterampilan` AS `Nilai_Keterampilan`, `g`.`Nama_Guru` AS `Nama_Guru` FROM ((`nilai` `n` join `mata_pelajaran` `m` on(`n`.`Kode_Mapel` = `m`.`Kode_Mapel`)) join `guru` `g` on(`m`.`Guru_Mapel` = `g`.`NUPTK`)) WHERE `n`.`Jenis` = 'UTS' ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi_ekskul`
--
ALTER TABLE `absensi_ekskul`
  ADD PRIMARY KEY (`ID_Absensi`),
  ADD KEY `ID_Ekskul_Siswa` (`ID_Ekskul_Siswa`);

--
-- Indexes for table `absensi_kelas`
--
ALTER TABLE `absensi_kelas`
  ADD PRIMARY KEY (`ID_Absensi`),
  ADD KEY `ID_Siswa` (`ID_Siswa`),
  ADD KEY `Kelas` (`Kelas`);

--
-- Indexes for table `ekskul_siswa`
--
ALTER TABLE `ekskul_siswa`
  ADD PRIMARY KEY (`ID_Ekskul_Siswa`),
  ADD KEY `Kode_Ekskul` (`Kode_Ekskul`),
  ADD KEY `ID_Siswa` (`ID_Siswa`),
  ADD KEY `Thn_Ajaran` (`Thn_Ajaran`);

--
-- Indexes for table `ekstrakurikuler`
--
ALTER TABLE `ekstrakurikuler`
  ADD PRIMARY KEY (`Kode_Ekskul`),
  ADD KEY `Guru_Ekskul` (`Guru_Ekskul`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`NUPTK`);

--
-- Indexes for table `jadwal_mapel`
--
ALTER TABLE `jadwal_mapel`
  ADD PRIMARY KEY (`ID_Jadwal`),
  ADD KEY `ID_Kelas` (`ID_Kelas`),
  ADD KEY `Kode_Mapel` (`Kode_Mapel`),
  ADD KEY `ID_Thn_Ajaran` (`ID_Thn_Ajaran`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`ID_Kelas`),
  ADD KEY `Wali_Kelas` (`Wali_Kelas`);

--
-- Indexes for table `kepala_sekolah`
--
ALTER TABLE `kepala_sekolah`
  ADD PRIMARY KEY (`ID_Kepsek`);

--
-- Indexes for table `kip_kps_pip`
--
ALTER TABLE `kip_kps_pip`
  ADD PRIMARY KEY (`ID_Status`),
  ADD KEY `Siswa_ID` (`Siswa_ID`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`Kode_Mapel`),
  ADD KEY `Guru_Mapel` (`Guru_Mapel`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`Nilai_ID`),
  ADD KEY `Kode_Mapel` (`Kode_Mapel`),
  ADD KEY `ID_Siswa` (`ID_Siswa`),
  ADD KEY `Thn_Ajaran` (`Thn_Ajaran`);

--
-- Indexes for table `nilai_ekskul`
--
ALTER TABLE `nilai_ekskul`
  ADD PRIMARY KEY (`ID_Nilai`),
  ADD KEY `ID_Ekskul_Siswa` (`ID_Ekskul_Siswa`);

--
-- Indexes for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD PRIMARY KEY (`ID_Prestasi`),
  ADD KEY `Siswa` (`Siswa`);

--
-- Indexes for table `rapor`
--
ALTER TABLE `rapor`
  ADD PRIMARY KEY (`ID_Rapor`),
  ADD KEY `ID_Nilai` (`ID_Nilai`),
  ADD KEY `ID_Nilai_Ekskul` (`ID_Nilai_Ekskul`),
  ADD KEY `ID_Prestasi` (`ID_Prestasi`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID_Roles`);

--
-- Indexes for table `role_assignment`
--
ALTER TABLE `role_assignment`
  ADD PRIMARY KEY (`ID_Role_Assignment`),
  ADD KEY `ID_Roles` (`ID_Roles`),
  ADD KEY `NISN` (`NISN`),
  ADD KEY `NUPTK` (`NUPTK`),
  ADD KEY `ID_Pegawai` (`ID_Pegawai`),
  ADD KEY `ID_Kepsek` (`ID_Kepsek`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`NISN`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`ID_Thn_Ajaran`);

--
-- Indexes for table `tata_usaha`
--
ALTER TABLE `tata_usaha`
  ADD PRIMARY KEY (`ID_Pegawai`);

--
-- Indexes for table `wali_siswa`
--
ALTER TABLE `wali_siswa`
  ADD PRIMARY KEY (`ID_Wali`),
  ADD KEY `Siswa_yang_Diwakilkan` (`Siswa_yang_Diwakilkan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi_ekskul`
--
ALTER TABLE `absensi_ekskul`
  MODIFY `ID_Absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `absensi_kelas`
--
ALTER TABLE `absensi_kelas`
  MODIFY `ID_Absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `kepala_sekolah`
--
ALTER TABLE `kepala_sekolah`
  MODIFY `ID_Kepsek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kip_kps_pip`
--
ALTER TABLE `kip_kps_pip`
  MODIFY `ID_Status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `Nilai_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nilai_ekskul`
--
ALTER TABLE `nilai_ekskul`
  MODIFY `ID_Nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rapor`
--
ALTER TABLE `rapor`
  MODIFY `ID_Rapor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_assignment`
--
ALTER TABLE `role_assignment`
  MODIFY `ID_Role_Assignment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `ID_Thn_Ajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tata_usaha`
--
ALTER TABLE `tata_usaha`
  MODIFY `ID_Pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19880835;

--
-- AUTO_INCREMENT for table `wali_siswa`
--
ALTER TABLE `wali_siswa`
  MODIFY `ID_Wali` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi_ekskul`
--
ALTER TABLE `absensi_ekskul`
  ADD CONSTRAINT `absensi_ekskul_ibfk_1` FOREIGN KEY (`ID_Ekskul_Siswa`) REFERENCES `ekskul_siswa` (`ID_Ekskul_Siswa`) ON UPDATE CASCADE;

--
-- Constraints for table `absensi_kelas`
--
ALTER TABLE `absensi_kelas`
  ADD CONSTRAINT `absensi_kelas_ibfk_1` FOREIGN KEY (`ID_Siswa`) REFERENCES `siswa` (`NISN`) ON UPDATE CASCADE,
  ADD CONSTRAINT `absensi_kelas_ibfk_2` FOREIGN KEY (`Kelas`) REFERENCES `kelas` (`ID_Kelas`) ON UPDATE CASCADE;

--
-- Constraints for table `ekskul_siswa`
--
ALTER TABLE `ekskul_siswa`
  ADD CONSTRAINT `ekskul_siswa_ibfk_1` FOREIGN KEY (`Kode_Ekskul`) REFERENCES `ekstrakurikuler` (`Kode_Ekskul`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `ekskul_siswa_ibfk_2` FOREIGN KEY (`ID_Siswa`) REFERENCES `siswa` (`NISN`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ekskul_siswa_ibfk_3` FOREIGN KEY (`Thn_Ajaran`) REFERENCES `tahun_ajaran` (`ID_Thn_Ajaran`) ON UPDATE CASCADE;

--
-- Constraints for table `ekstrakurikuler`
--
ALTER TABLE `ekstrakurikuler`
  ADD CONSTRAINT `ekstrakurikuler_ibfk_1` FOREIGN KEY (`Guru_Ekskul`) REFERENCES `guru` (`NUPTK`) ON UPDATE CASCADE;

--
-- Constraints for table `jadwal_mapel`
--
ALTER TABLE `jadwal_mapel`
  ADD CONSTRAINT `jadwal_mapel_ibfk_1` FOREIGN KEY (`ID_Kelas`) REFERENCES `kelas` (`ID_Kelas`) ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_mapel_ibfk_2` FOREIGN KEY (`Kode_Mapel`) REFERENCES `mata_pelajaran` (`Kode_Mapel`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `jadwal_mapel_ibfk_3` FOREIGN KEY (`ID_Thn_Ajaran`) REFERENCES `tahun_ajaran` (`ID_Thn_Ajaran`) ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`Wali_Kelas`) REFERENCES `guru` (`NUPTK`) ON UPDATE CASCADE;

--
-- Constraints for table `kip_kps_pip`
--
ALTER TABLE `kip_kps_pip`
  ADD CONSTRAINT `kip_kps_pip_ibfk_1` FOREIGN KEY (`Siswa_ID`) REFERENCES `siswa` (`NISN`) ON UPDATE CASCADE;

--
-- Constraints for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD CONSTRAINT `mata_pelajaran_ibfk_1` FOREIGN KEY (`Guru_Mapel`) REFERENCES `guru` (`NUPTK`) ON UPDATE CASCADE;

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`Kode_Mapel`) REFERENCES `mata_pelajaran` (`Kode_Mapel`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`ID_Siswa`) REFERENCES `siswa` (`NISN`) ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_3` FOREIGN KEY (`Thn_Ajaran`) REFERENCES `tahun_ajaran` (`ID_Thn_Ajaran`) ON UPDATE CASCADE;

--
-- Constraints for table `nilai_ekskul`
--
ALTER TABLE `nilai_ekskul`
  ADD CONSTRAINT `nilai_ekskul_ibfk_1` FOREIGN KEY (`ID_Ekskul_Siswa`) REFERENCES `ekskul_siswa` (`ID_Ekskul_Siswa`) ON UPDATE CASCADE;

--
-- Constraints for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD CONSTRAINT `prestasi_ibfk_1` FOREIGN KEY (`Siswa`) REFERENCES `siswa` (`NISN`) ON UPDATE CASCADE;

--
-- Constraints for table `rapor`
--
ALTER TABLE `rapor`
  ADD CONSTRAINT `rapor_ibfk_1` FOREIGN KEY (`ID_Nilai`) REFERENCES `nilai` (`Nilai_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rapor_ibfk_2` FOREIGN KEY (`ID_Nilai_Ekskul`) REFERENCES `nilai_ekskul` (`ID_Nilai`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rapor_ibfk_3` FOREIGN KEY (`ID_Prestasi`) REFERENCES `prestasi` (`ID_Prestasi`) ON UPDATE CASCADE;

--
-- Constraints for table `role_assignment`
--
ALTER TABLE `role_assignment`
  ADD CONSTRAINT `role_assignment_ibfk_1` FOREIGN KEY (`ID_Roles`) REFERENCES `roles` (`ID_Roles`) ON UPDATE CASCADE,
  ADD CONSTRAINT `role_assignment_ibfk_2` FOREIGN KEY (`NISN`) REFERENCES `siswa` (`NISN`) ON UPDATE CASCADE,
  ADD CONSTRAINT `role_assignment_ibfk_3` FOREIGN KEY (`NUPTK`) REFERENCES `guru` (`NUPTK`) ON UPDATE CASCADE,
  ADD CONSTRAINT `role_assignment_ibfk_4` FOREIGN KEY (`ID_Pegawai`) REFERENCES `tata_usaha` (`ID_Pegawai`) ON UPDATE CASCADE,
  ADD CONSTRAINT `role_assignment_ibfk_5` FOREIGN KEY (`ID_Kepsek`) REFERENCES `kepala_sekolah` (`ID_Kepsek`) ON UPDATE CASCADE;

--
-- Constraints for table `wali_siswa`
--
ALTER TABLE `wali_siswa`
  ADD CONSTRAINT `wali_siswa_ibfk_1` FOREIGN KEY (`Siswa_yang_Diwakilkan`) REFERENCES `siswa` (`NISN`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
