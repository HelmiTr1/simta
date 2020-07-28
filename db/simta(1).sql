-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2020 at 03:48 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simta`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_aspeknilai`
--

CREATE TABLE `tb_aspeknilai` (
  `id` int(11) NOT NULL,
  `aspeknilai` varchar(100) NOT NULL,
  `bobot` float NOT NULL,
  `kategori` varchar(10) NOT NULL,
  `input_by` varchar(20) DEFAULT NULL,
  `input_at` datetime DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `row_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_aspeknilai`
--

INSERT INTO `tb_aspeknilai` (`id`, `aspeknilai`, `bobot`, `kategori`, `input_by`, `input_at`, `modified_by`, `modified_at`, `row_status`) VALUES
(1, 'Penyajian Presentasi', 10, 'sidang', NULL, NULL, NULL, NULL, 1),
(2, 'Kemampuan Menjelaskan Ide', 15, 'sidang', NULL, NULL, NULL, NULL, 1),
(3, 'Pemahaman Konsep Dasar', 15, 'sidang', NULL, NULL, NULL, NULL, 1),
(4, 'Hasil yang dicapai', 40, 'sidang', NULL, NULL, NULL, NULL, 1),
(5, 'Obyektifitas menanggapi pertanyaan', 20, 'sidang', NULL, NULL, NULL, NULL, 1),
(10, 'Keaktifan', 30, 'proses', NULL, NULL, NULL, NULL, 1),
(11, 'Kemampuan mencari solusi', 30, 'proses', NULL, NULL, NULL, NULL, 1),
(12, 'Skill pengerjaan', 40, 'proses', NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_bimbingan`
--

CREATE TABLE `tb_bimbingan` (
  `id` int(11) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `dospem1` varchar(16) NOT NULL,
  `dospem2` varchar(16) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `input_by` varchar(20) DEFAULT NULL,
  `input_at` timestamp NULL DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL,
  `row_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_bimbingan`
--

INSERT INTO `tb_bimbingan` (`id`, `nim`, `dospem1`, `dospem2`, `judul`, `input_by`, `input_at`, `modified_by`, `modified_at`, `row_status`) VALUES
(5, 'A1317010', '1988070320190310', '1986070120190310', '-', NULL, NULL, NULL, NULL, 1),
(6, 'A1317011', '1990072920190310', '1989060120190310', '-', NULL, NULL, NULL, NULL, 1),
(7, 'A1317016', '1988070320190310', '1985110120190310', '-', NULL, NULL, NULL, NULL, 1),
(8, 'A1317022', '1989042120190320', '1988070320190310', '-', NULL, NULL, NULL, NULL, 1),
(9, 'A1317023', '1990072920190310', '1988070320190310', '-', NULL, NULL, NULL, NULL, 1),
(10, 'A1317026', '1989042120190320', '1992050520190320', '-', NULL, NULL, NULL, NULL, 1),
(11, 'A1317052', '1989042120190320', '1988070320190310', '-', NULL, NULL, NULL, NULL, 1),
(12, 'A1317109', '1990112020190310', '1990071120150410', '-', NULL, NULL, NULL, NULL, 1),
(13, 'A1317073', '1990112020190310', '1984080220190310', '-', NULL, NULL, NULL, NULL, 1),
(14, 'A1317090', '1990072920190310', '1989092720190310', '-', NULL, NULL, NULL, NULL, 1),
(15, 'A1317048', '1990071120150410', '1989060120190310', '-', NULL, NULL, NULL, NULL, 1),
(16, 'A1317060', '1990041720180320', '1989060120190310', '-', NULL, NULL, NULL, NULL, 1),
(17, 'A1317088', '1987061220190320', '1990041720180320', '-', NULL, NULL, NULL, NULL, 1),
(18, 'A1317111', '1990112020190310', '1989060120190310', '-', NULL, NULL, NULL, NULL, 1),
(19, 'A1317068', '1989042120190320', '1990072920190310', '-', NULL, NULL, NULL, NULL, 1),
(20, 'A1317080', '1990072920190310', '1990041720180320', '-', NULL, NULL, NULL, NULL, 1),
(21, 'A1317034', '1989060120190310', '1984080220190310', '-', NULL, NULL, NULL, NULL, 1),
(22, 'A1317054', '1990071120150410', '1984020220190320', '-', NULL, NULL, NULL, NULL, 1),
(23, 'A1317046', '1990112020190310', '1989060120190310', '-', NULL, NULL, NULL, NULL, 1),
(24, 'A1317056', '1987061220190320', '1984020220190320', '-', NULL, NULL, NULL, NULL, 1),
(25, 'A1317066', '1984020220190320', '1990112020190310', '-', NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_content`
--

CREATE TABLE `tb_content` (
  `id` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `isi` varchar(100) NOT NULL,
  `id_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `input_by` varchar(20) DEFAULT NULL,
  `input_at` timestamp NULL DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL,
  `row_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_content`
--

INSERT INTO `tb_content` (`id`, `judul`, `isi`, `id_level`, `id_menu`, `url`, `icon`, `input_by`, `input_at`, `modified_by`, `modified_at`, `row_status`) VALUES
(1, 'Data Hari', 'Menampilkan informasi hari untuk membuat jadwal', 1, 3, 'sidang/hari', 'ni ni-calendar-grid-58', 'default', '2020-05-26 19:35:14', 'admin', '2020-07-12 20:05:12', -1),
(2, 'Data Waktu', 'Menampilkan informasi waktu pada jadwal sidang', 1, 3, 'sidang/waktu', 'ni ni-time-alarm', 'default', '2020-05-26 21:08:24', 'admin', '2020-07-12 20:22:05', -1),
(3, 'Waktu Sidang', 'Menampilkan informasi hari dan jam sidang', 1, 3, 'sidang/waktusidang', 'ni ni-bullet-list-67', 'default', '2020-05-26 22:32:37', 'admin', '2020-07-24 17:24:14', 1),
(4, 'Generate Jadwal Sidang', 'Melakukan generate jadwal sidang', 1, 3, 'sidang/jadwal', 'ni ni-bullet-list-67', 'default', '2020-05-26 22:34:12', 'default', '2020-05-29 23:02:49', 1),
(5, 'Penilaian', 'Melakukan input nilai mahasiswa', 2, 3, 'sidang/nilai', 'ni ni-paper-diploma', 'default', '2020-05-28 01:22:13', NULL, NULL, 1),
(6, 'Penilaian', 'Menampilkan informasi nilai hasil sidang mahasiswa', 3, 3, 'sidang/nilai/mahasiswa', 'ni ni-paper-diploma', 'default', '2020-05-28 01:23:50', 'admin', '2020-06-20 18:02:28', 1),
(7, 'Ruangan', 'Menampilkan informasi ruangan untuk jadwal sidang', 1, 3, 'sidang/ruangan', 'ni ni-tag', 'default', '2020-05-31 02:41:21', NULL, NULL, 1),
(8, 'Berkas Revisi Diterima', 'Menampilkan berkas lampiran tanda selesai revisi', 1, 4, 'berkas/revisi?s=terima', 'ni ni-collection', 'admin', '2020-06-01 05:09:12', 'admin', '2020-06-17 18:58:05', 1),
(9, 'Upload Berkas Revisi', 'Upload berkas lampiran revisi tanda selesai revisi', 3, 4, 'berkas/revisi1', 'ni ni-paper-diploma', 'admin', '2020-06-01 05:59:30', NULL, NULL, 1),
(10, 'Jadwal Sidang', 'Menampilkan informasi jadwal sidang tugas akhir', 1, 3, 'sidang/jadwal/result', 'ni ni-calendar-grid-58', 'admin', '2020-06-11 19:05:20', NULL, NULL, 1),
(11, 'Data Revisi', 'Menampilkan informasi berkas revisi yang dikumpulkan', 4, 4, 'berkas/fix', 'ni ni-collection', 'admin', '2020-06-11 21:18:04', NULL, NULL, 1),
(12, 'Rekapitulasi Nilai', 'Menampilkan informasi nilai yang telah diisikan oleh dosen', 1, 3, 'sidang/nilai/rekap', 'ni ni-archive-2', 'admin', '2020-06-17 16:44:42', 'admin', '2020-07-24 19:43:03', 1),
(13, 'Berkas Revisi Ditolak', 'Menampilkan informasi berkas revisi yang telah ditolak', 1, 4, 'berkas/revisi?s=tolak', 'ni ni-fat-remove', 'admin', '2020-06-17 19:43:22', NULL, NULL, 1),
(14, 'Jadwal Sidang', 'Menampilkan informasi detail jadwal sidang', 3, 3, 'sidang/jadwal/detail?s=mahasiswa', 'ni ni-calendar-grid-58', 'admin', '2020-06-17 20:33:59', NULL, NULL, 1),
(15, 'Jadwal Sidang', 'Menampilan informasi tentang jadwal sidang', 2, 3, 'sidang/jadwal/detail?s=dosen', 'ni ni-calendar-grid-58', 'admin', '2020-06-17 20:34:50', NULL, NULL, 1),
(16, 'coba', 'coba', 1, 3, 'coba', 'coba', 'admin', '2020-07-26 17:42:15', 'admin', '2020-07-26 17:43:33', -1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_dosen`
--

CREATE TABLE `tb_dosen` (
  `nidn` varchar(16) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `input_by` varchar(20) DEFAULT NULL,
  `input_at` timestamp NULL DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL,
  `row_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_dosen`
--

INSERT INTO `tb_dosen` (`nidn`, `nama`, `alamat`, `jenis_kelamin`, `agama`, `input_by`, `input_at`, `modified_by`, `modified_at`, `row_status`) VALUES
('1090801031', 'Wan Yuliyanti, M.Pd', '-', '-', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('1970060719951220', 'Titik Wijayati, M.Pd', '-', '-', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('1984020220190320', 'Wiwik Kusrini, S.Kom., M.Cs', '-', '-', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('1984080220190310', 'Agustian Noor, M.Kom', '-', '-', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('1985110120190310', 'Muhammad Noor, M.H.I', '-', '-', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('1986070120190310', 'Hendrik Setyo Utomo, ST., MMSI', '-', '-', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('1987061220190320', 'Yunita Prastyaningsih, M.Kom', '-', '-', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('1988070320190310', 'Jaka Permadi, S.Si., M.Cs', '-', '-', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('1989042120190320', 'Herfia Rhomadhona, S.Kom., M.Cs', '-', '-', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('1989060120190310', 'Khairul Anwar Hafizd, M.Kom', '-', '-', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('1989092720190310', 'Arif Supriyanto, S.Kom., M.Cs', '-', '-', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('1990041720180320', 'Winda Aprianti, M.Si', '-', '-', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('1990071120150410', 'Veri Julianto, M.Si', '-', '-', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('1990072920190310', 'Fathurrahmani, M.Kom', '-', '-', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('1990112020190310', 'Herpendi, M.Kom', '-', '-', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('1992050520190320', 'Rabini Sayyidati, M.Pd', '-', '-', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_hari`
--

CREATE TABLE `tb_hari` (
  `id` int(11) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `status` int(11) NOT NULL,
  `input_by` varchar(20) NOT NULL,
  `input_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_by` varchar(20) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `row_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_hari`
--

INSERT INTO `tb_hari` (`id`, `hari`, `status`, `input_by`, `input_at`, `modified_by`, `modified_at`, `row_status`) VALUES
(1, 'Senin', 1, '', '2020-05-27 14:23:46', '', '2020-05-27 14:23:46', 1),
(2, 'Selasa', 1, '', '2020-05-27 14:23:46', '', '2020-05-27 14:23:46', 1),
(3, 'Rabu', 1, '', '2020-05-27 14:23:46', '', '2020-05-27 14:23:46', 1),
(4, 'Kamis', 1, '', '2020-05-27 14:23:46', '', '2020-05-27 14:23:46', 1),
(5, 'Jum\'at', 1, '', '2020-05-27 14:23:46', '', '2020-05-27 14:23:46', 1),
(6, 'Sabtu', 0, '', '2020-05-27 14:23:46', 'default', '2020-05-27 07:39:19', 1),
(7, 'Minggu', 0, '', '2020-05-27 14:23:46', 'default', '2020-05-27 07:39:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwalsidang`
--

CREATE TABLE `tb_jadwalsidang` (
  `id` int(11) NOT NULL,
  `id_waktusidang` int(11) NOT NULL,
  `id_ruangan` int(11) NOT NULL,
  `id_bimbingan` int(11) NOT NULL,
  `dospen1` varchar(16) NOT NULL,
  `dospen2` varchar(16) NOT NULL,
  `input_by` varchar(20) DEFAULT NULL,
  `input_at` timestamp NULL DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL,
  `row_status` int(11) NOT NULL,
  `batch` int(11) DEFAULT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jadwalsidang`
--

INSERT INTO `tb_jadwalsidang` (`id`, `id_waktusidang`, `id_ruangan`, `id_bimbingan`, `dospen1`, `dospen2`, `input_by`, `input_at`, `modified_by`, `modified_at`, `row_status`, `batch`, `tanggal`) VALUES
(17, 1, 8, 5, '1986070120190310', '1985110120190310', 'admin', '2020-07-28 05:43:31', NULL, NULL, 1, 1, '2020-07-28'),
(18, 2, 10, 6, '1990071120150410', '1989092720190310', 'admin', '2020-07-28 05:43:31', NULL, NULL, 1, 1, '2020-07-28'),
(19, 3, 10, 7, '1989060120190310', '1989042120190320', 'admin', '2020-07-28 05:43:31', NULL, NULL, 1, 1, '2020-07-28'),
(20, 4, 7, 8, '1989092720190310', '1989092720190310', 'admin', '2020-07-28 05:43:31', NULL, NULL, 1, 1, '2020-07-28'),
(21, 5, 8, 9, '1090801031', '1986070120190310', 'admin', '2020-07-28 05:43:31', NULL, NULL, 1, 1, '2020-07-29'),
(22, 6, 7, 10, '1986070120190310', '1987061220190320', 'admin', '2020-07-28 05:43:31', NULL, NULL, 1, 1, '2020-07-29'),
(23, 7, 8, 11, '1989060120190310', '1989092720190310', 'admin', '2020-07-28 05:43:31', NULL, NULL, 1, 1, '2020-07-29'),
(24, 8, 7, 12, '1987061220190320', '1985110120190310', 'admin', '2020-07-28 05:43:31', NULL, NULL, 1, 1, '2020-07-29'),
(25, 9, 6, 13, '1090801031', '1990041720180320', 'admin', '2020-07-28 05:43:31', NULL, NULL, 1, 1, '2020-07-30'),
(26, 10, 6, 14, '1989042120190320', '1989092720190310', 'admin', '2020-07-28 05:43:31', NULL, NULL, 1, 1, '2020-07-30'),
(27, 11, 6, 15, '1989042120190320', '1988070320190310', 'admin', '2020-07-28 05:43:32', NULL, NULL, 1, 1, '2020-07-30'),
(28, 12, 8, 16, '1990041720180320', '1988070320190310', 'admin', '2020-07-28 05:43:32', NULL, NULL, 1, 1, '2020-07-30'),
(29, 13, 7, 17, '1988070320190310', '1985110120190310', 'admin', '2020-07-28 05:43:32', NULL, NULL, 1, 1, '2020-07-31'),
(30, 14, 6, 18, '1984080220190310', '1090801031', 'admin', '2020-07-28 05:43:32', NULL, NULL, 1, 1, '2020-07-31'),
(31, 15, 8, 19, '1990071120150410', '1090801031', 'admin', '2020-07-28 05:43:32', NULL, NULL, 1, 1, '2020-07-31'),
(32, 16, 7, 21, '1986070120190310', '1984080220190310', 'admin', '2020-07-28 05:43:32', NULL, NULL, 1, 1, '2020-07-31');

-- --------------------------------------------------------

--
-- Table structure for table `tb_level`
--

CREATE TABLE `tb_level` (
  `id` int(11) NOT NULL,
  `level` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_level`
--

INSERT INTO `tb_level` (`id`, `level`) VALUES
(1, 'Koordinator'),
(2, 'Dosen'),
(3, 'Mahasiswa'),
(4, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mahasiswa`
--

CREATE TABLE `tb_mahasiswa` (
  `nim` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `input_by` varchar(20) DEFAULT NULL,
  `input_at` timestamp NULL DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL,
  `row_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_mahasiswa`
--

INSERT INTO `tb_mahasiswa` (`nim`, `nama`, `alamat`, `jenis_kelamin`, `agama`, `input_by`, `input_at`, `modified_by`, `modified_at`, `row_status`) VALUES
('A1317010', 'Anita', '-', 'Perempuan', 'Islam', NULL, NULL, NULL, NULL, 1),
('A1317011', 'Anita Nurlaila', '-', 'Perempuan', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('A1317016', 'Bibit Wahyudi', '-', 'Laki-laki', 'Islam', NULL, NULL, NULL, NULL, 1),
('A1317022', 'Estri Nunik Hidayati', '-', 'Perempuan', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('A1317023', 'Fajar', '-', 'Laki-laki', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('A1317025', 'Gusti Ahmad Hafi', '-', 'Laki-laki', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('A1317026', 'Helmi tri Budi Yulianto', '-', 'Laki-laki', 'Islam', NULL, NULL, NULL, NULL, 1),
('A1317027', 'Hesti Ratih Ningtias', '-', 'Perempuan', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('A1317031', 'Istiqomah', '-', 'Perempuan', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('A1317034', 'Kiki Maulida', '-', 'Perempuan', 'Islam', NULL, NULL, NULL, NULL, 1),
('A1317046', 'Melda Hikmah', '-', 'Perempuan', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('A1317048', 'Meliana', '-', 'Perempuan', 'Islam', NULL, NULL, NULL, NULL, 1),
('A1317050', 'Meyhastanti Cahyaning Fijar', '-', 'Perempuan', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('A1317051', 'Mila Camelia', '-', 'Perempuan', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('A1317052', 'Mita Maulinda', '-', 'Perempuan', 'Islam', NULL, NULL, NULL, NULL, 1),
('A1317054', 'Muhammad Khairi', '-', 'Laki-laki', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('A1317056', 'Muhammad Teddy Taufani', '-', 'Laki-laki', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('A1317060', 'Nanda Sejatining Tyas', '-', 'Perempuan', 'Islam', NULL, NULL, NULL, NULL, 1),
('A1317064', 'Noor Latipah', '-', 'Perempuan', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('A1317065', 'Nor Janah', '-', 'Perempuan', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('A1317066', 'Norhatiah', '-', 'Perempuan', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('A1317068', 'Novia Sari', '-', 'Perempuan', 'Islam', NULL, NULL, NULL, NULL, 1),
('A1317071', 'Rahma Dwi Cahyani', '-', 'Perempuan', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('A1317073', 'Reka Nur Andinni', '-', 'Perempuan', 'Islam', NULL, NULL, NULL, NULL, 1),
('A1317074', 'Renaldi Haris Aksara', '-', 'Laki-laki', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('A1317079', 'Reyfindy', '-', 'Perempuan', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('A1317080', 'Riki Hidayat', '-', 'Laki-laki', 'Islam', NULL, NULL, NULL, NULL, 1),
('A1317083', 'Riska Hartati', '-', 'Perempuan', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('A1317088', 'Selvya Meirida Andani', '-', 'Perempuan', 'Islam', NULL, NULL, NULL, NULL, 1),
('A1317090', 'Sinta Esti Rahayu', '-', 'Prempuan', 'Islam', NULL, NULL, NULL, NULL, 1),
('A1317094', 'Susanti', '-', 'Perempuan', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('A1317096', 'Tri Lutriatul Rahayu', '-', 'Perempuan', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('A1317097', 'Tsamara Dara Rizkita', '-', 'Perempuan', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('A1317107', 'Muhammad Aditya Effendi', '-', 'Laki-laki', 'Islam', 'null', '0000-00-00 00:00:00', 'null', '0000-00-00 00:00:00', 1),
('A1317109', 'Muhammad Muslih Amirudin', '-', 'Laki-laki', 'Islam', NULL, NULL, NULL, NULL, 1),
('A1317111', 'Siti Naziha', '-', 'Perempuan', 'Islam', NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_menu`
--

CREATE TABLE `tb_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(20) NOT NULL,
  `url` varchar(100) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `input_by` varchar(20) DEFAULT NULL,
  `input_at` timestamp NULL DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL,
  `row_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_menu`
--

INSERT INTO `tb_menu` (`id`, `menu`, `url`, `icon`, `input_by`, `input_at`, `modified_by`, `modified_at`, `row_status`) VALUES
(1, 'Home', 'home', 'ni ni-tv-2', 'default', '2020-05-26 06:51:11', 'default', '2020-05-26 07:38:02', 1),
(2, 'Dashboard', 'home', 'ni ni-tv-2', 'default', '2020-05-26 07:03:17', 'default', '2020-05-28 18:28:25', 1),
(3, 'Sidang', 'sidang', 'ni ni-calendar-grid-58', 'default', '2020-05-26 07:04:23', NULL, NULL, 1),
(4, 'Kelengkapan Berkas', 'berkas', 'ni ni-single-copy-04', 'default', '2020-05-26 07:08:01', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_menuaccess`
--

CREATE TABLE `tb_menuaccess` (
  `id` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_menuaccess`
--

INSERT INTO `tb_menuaccess` (`id`, `id_menu`, `id_level`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 1, 4),
(4, 2, 1),
(5, 3, 1),
(7, 3, 3),
(9, 4, 1),
(10, 4, 3),
(11, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilaisidang`
--

CREATE TABLE `tb_nilaisidang` (
  `id` int(11) NOT NULL,
  `id_bimbingan` int(11) NOT NULL,
  `id_dosen` varchar(16) NOT NULL,
  `id_aspeknilai` int(11) NOT NULL,
  `nilai` float NOT NULL,
  `status` int(11) NOT NULL,
  `input_by` varchar(20) DEFAULT NULL,
  `input_at` datetime DEFAULT NULL,
  `modified_by` varchar(10) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `row_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_revisi`
--

CREATE TABLE `tb_revisi` (
  `id` int(11) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `input_by` varchar(20) DEFAULT NULL,
  `input_at` datetime DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `row_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_ruangan`
--

CREATE TABLE `tb_ruangan` (
  `id` int(11) NOT NULL,
  `kode_ruangan` varchar(10) NOT NULL,
  `nama_ruangan` varchar(20) NOT NULL,
  `input_by` varchar(20) DEFAULT NULL,
  `input_at` timestamp NULL DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL,
  `row_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_ruangan`
--

INSERT INTO `tb_ruangan` (`id`, `kode_ruangan`, `nama_ruangan`, `input_by`, `input_at`, `modified_by`, `modified_at`, `row_status`) VALUES
(6, 'G2.L1.D', 'C++', 'admin', '2020-06-16 21:24:32', 'admin', '2020-07-26 18:05:06', 1),
(7, 'G2.L2.E', 'Bootstrap', 'admin', '2020-06-16 21:24:56', NULL, NULL, 1),
(8, 'G1.L1.F', 'JAVA', 'admin', '2020-06-17 00:13:52', NULL, NULL, 1),
(9, 'G2.L1.F', 'Lab Komputer C', 'admin', '2020-07-26 18:05:39', 'admin', '2020-07-26 18:07:25', -1),
(10, 'G2.L2.F', 'HTML', 'admin', '2020-07-27 08:33:21', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level_id` int(11) NOT NULL,
  `input_by` varchar(20) DEFAULT NULL,
  `input_at` timestamp NULL DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL,
  `row_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `level_id`, `input_by`, `input_at`, `modified_by`, `modified_at`, `row_status`) VALUES
(6, 'admin', '$2y$10$hLyDI/rvl4TjtSBImn8/V.e4OlKo/g4.p.d/AVgdXn.FHZJOa0iaO', 1, 'default', '2020-05-28 05:58:32', 'admin', '2020-07-26 17:15:38', 1),
(7, 'A1317026', '$2y$10$WbXvDg1D34oZsA1o.B1vceldFRRduzKpoFbip5H33oHi7oUPbJT96', 3, 'default', '2020-05-28 08:10:25', 'admin', '2020-07-26 17:16:03', 1),
(8, '19990001', '$2y$10$UD.o6Zctqej6hNlr4iSkt.YICnSdd.4gGY/zzpK35l1EFDUZa2UHe', 2, 'admin', '2020-06-11 19:23:23', 'admin', '2020-07-27 09:32:24', -1),
(9, '19990002', '$2y$10$18J7yr6lI0XADFdz9vEb8uj0ccyElY46vCwourvdYHnWGgJwRZ82m', 2, 'admin', '2020-06-29 20:37:08', 'admin', '2020-07-27 09:32:31', -1),
(10, 'adminti', '$2y$10$kZUlAvxMgAxs8Qy4Dlhr0O8FyeCOefplYecWWGElfQzUnCfoT/1tO', 4, 'admin', '2020-06-29 20:37:36', NULL, NULL, 1),
(11, 'A1317025', '$2y$10$/LCJd56htS.BrAgqUlz4duXQR3CY7x17AK0WmzFbpFiWKdXQzxMb6', 3, 'admin', '2020-07-26 08:52:46', NULL, NULL, 1),
(12, 'A1317027', '$2y$10$fsfvDVFv9L307RkNHlhmKO9lexyBkXxeFvGVr8r5yBTBb0Ik3bEQi', 3, 'admin', '2020-07-26 08:55:45', NULL, NULL, 1),
(13, 'A1317028', '$2y$10$rmHwMt/segzUhcjCjYVZdO2c1UGQU9kd2T/ldLdL6J9kDlIt8z/je', 3, 'admin', '2020-07-26 08:57:12', NULL, NULL, 1),
(14, 'A1317029', '$2y$10$E5mnvwWih7wDWVMw7mzg9O4HSOGDoHnzkoZ8oEMLhcddCHQmgWFpO', 3, 'admin', '2020-07-26 09:11:37', NULL, NULL, 1),
(15, 'A1317030', '$2y$10$aVGr1pD8pfBc56OMhtwtpudUD1VwndHbiJnCtm3vOWZEDEY584Td6', 3, 'admin', '2020-07-26 09:14:18', 'admin', '2020-07-26 16:57:20', -1),
(16, 'A1317031', '$2y$10$0D5MSblu.R354OuFp2nfiO.p3opT9fW28Cexu89o4SHnd8LlYr/Qe', 3, 'admin', '2020-07-26 15:55:43', 'admin', '2020-07-26 16:59:37', -1),
(17, 'A1317032', '$2y$10$KNRnDhtrhnViIHj3HlSOGe4EowKcBScWZigVbT711MTSIHfo3Etzq', 3, 'admin', '2020-07-26 16:10:52', 'admin', '2020-07-26 17:14:08', -1),
(18, 'A1317033', '$2y$10$m234Qh06wOFZYV1.eRJrIu77lijN1g.dD73ylt4ET6QGRZQjS5uKy', 3, 'admin', '2020-07-26 16:13:45', NULL, NULL, 1),
(19, 'A1317034', '$2y$10$7JSkblXtiBjKJW7O8bP6v.zuyfnlsi9YQ9MXLo44l3GaJq0qVSMES', 3, 'admin', '2020-07-26 16:15:36', 'admin', '2020-07-26 17:27:00', -1),
(20, 'A1317035', '$2y$10$1AADa3U5syNTCM7lT0ZZ6eWtsPx27w1VDKItMIbCT6ejhtwZv1jTG', 3, 'admin', '2020-07-26 16:22:03', 'admin', '2020-07-26 17:19:58', -1),
(21, 'A1317036', '$2y$10$MIWHzxYaF7uGyOARC/3hlu9m20SrgTn56DhLlCCTV7ia4AuCfbyGq', 3, 'admin', '2020-07-26 16:45:45', NULL, NULL, 1),
(22, 'A1317037', '$2y$10$KetxBCYmGKU9iuiIQATCwODankXF7VcEgoUVzTKj1jE9gpb0jyZwS', 3, 'admin', '2020-07-26 16:50:17', NULL, NULL, 1),
(23, 'A1317038', '$2y$10$6bjpmX5.792652DJwa2SUeMLfg4v9YvFKQ5yP4A6ywJ.NCj02Mgri', 3, 'admin', '2020-07-26 16:52:38', NULL, NULL, 1),
(24, 'A1317039', '$2y$10$SLCsBcRpzQ1UsWe/FtTGpO6MHs7IxAWUwtDL61BkQiecD3mvMNslu', 3, 'admin', '2020-07-26 16:54:47', NULL, NULL, 1),
(25, '1090801031', '$2y$10$UFufzrl1PRUiDoj3fI8IruFS/lMz.gjxHBE36TjrIA1p8nCbgLqpy', 2, 'admin', '2020-07-27 09:33:35', NULL, NULL, 1),
(26, '1970060719951220', '$2y$10$zikQghDjXuaiMLykj299u.9A6MCs8zhJ19a7h.YYed1/othXEdO4q', 2, 'admin', '2020-07-27 09:34:23', NULL, NULL, 1),
(27, '1984020220190320', '$2y$10$.irVHxBcyV9iVG8rSm0xyOTZp/qQOKgxiCw5tlt0yx8MVburYuDtG', 2, 'admin', '2020-07-27 09:35:10', NULL, NULL, 1),
(28, '1984080220190310', '$2y$10$T8kvQZhjXOyUnv.3Nz2em.kXBr.HVf1ErO/N8l955z4TsR4km6nXW', 2, 'admin', '2020-07-27 09:35:55', NULL, NULL, 1),
(29, '1985110120190310', '$2y$10$9M6nMe1ReUsR9q.Whrt7NOQrkIUlz5Cl0h8TI19l3/FJh2toZaEji', 2, 'admin', '2020-07-27 09:36:23', NULL, NULL, 1),
(30, '1986070120190310', '$2y$10$8K8xhswirK8S5QP2C9URSu1EQXf7ebN0/SvkT.mm0/1PiC00LPMcW', 2, 'admin', '2020-07-27 09:36:47', NULL, NULL, 1),
(31, '1987061220190320', '$2y$10$P4mREd4UlddklQRnHYEDeO1Lu5Hf0jxYImT9dzVaDRBxGF2k67bQG', 2, 'admin', '2020-07-27 09:38:21', NULL, NULL, 1),
(32, '1988070320190310', '$2y$10$dbLjMcCAEPWseAvnhNCOjuP8vxc5q5IRtXHZisr8lNNhaKS/yTb4u', 2, 'admin', '2020-07-27 09:38:55', NULL, NULL, 1),
(33, '1989042120190320', '$2y$10$m5QbM81XfiLUFjeEUnad/ed1hnUHpv828y.77csbSZ9yIgOgIqwQ.', 2, 'admin', '2020-07-27 09:40:51', NULL, NULL, 1),
(34, '1989060120190310', '$2y$10$U7pdVcmWlV/UZC6DOZAi6Oy.jUfDIItcaHWJWa7KgYjZ0W19zHxP2', 2, 'admin', '2020-07-27 09:41:28', NULL, NULL, 1),
(35, '1989092720190310', '$2y$10$vUZKhmLJzJgSlsIhRYHoZeWeJAd6nUi40YW5Apn5SQa8oaP8y6OGa', 2, 'admin', '2020-07-27 09:42:01', NULL, NULL, 1),
(36, '1990041720180320', '$2y$10$1XEUxL.XnQNKPGzRZLOuzOdBz4MBt18T9Ct.KGUXjhuB4qCsM5Y0O', 2, 'admin', '2020-07-27 09:42:46', NULL, NULL, 1),
(37, '1990071120150410', '$2y$10$fWWwafrm8vte1473tMI4Q.E9JT5Jg0IDrA8AO/le3Lo.2/l44QsI6', 2, 'admin', '2020-07-27 09:43:18', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_waktu`
--

CREATE TABLE `tb_waktu` (
  `id` int(11) NOT NULL,
  `waktu` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `input_by` varchar(20) DEFAULT NULL,
  `input_at` timestamp NULL DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL,
  `row_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_waktu`
--

INSERT INTO `tb_waktu` (`id`, `waktu`, `status`, `input_by`, `input_at`, `modified_by`, `modified_at`, `row_status`) VALUES
(1, '08.00-10.00', 1, '', '2020-05-28 01:36:00', 'default', '2020-05-27 19:38:08', 1),
(2, '10.00-12.00', 1, '', '2020-05-28 01:36:00', '', '2020-05-28 01:36:00', 1),
(3, '13.00-15.00', 1, '', '2020-05-28 01:36:00', '', '2020-05-28 01:36:00', 1),
(4, '15.00-17.00', 1, '', '2020-05-28 01:36:00', '', '2020-05-28 01:36:00', 1),
(5, '14.00-16.00', 1, '', '2020-05-28 01:36:00', 'default', '2020-05-27 19:37:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_waktusidang`
--

CREATE TABLE `tb_waktusidang` (
  `id` int(11) NOT NULL,
  `id_hari` int(11) NOT NULL,
  `id_waktu` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `input_by` varchar(20) DEFAULT NULL,
  `input_at` timestamp NULL DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL,
  `row_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_waktusidang`
--

INSERT INTO `tb_waktusidang` (`id`, `id_hari`, `id_waktu`, `status`, `input_by`, `input_at`, `modified_by`, `modified_at`, `row_status`) VALUES
(1, 1, 1, 1, '', '2020-05-28 02:06:12', '', '2020-05-28 02:06:12', 1),
(2, 1, 2, 1, '', '2020-05-28 02:06:12', '', '2020-05-28 02:06:12', 1),
(3, 1, 3, 1, '', '2020-05-28 03:10:31', '', '2020-05-28 03:10:31', 1),
(4, 1, 4, 1, '', '2020-05-28 03:10:31', '', '2020-05-28 03:10:31', 1),
(5, 2, 1, 1, '', '2020-05-28 02:06:12', '', '2020-05-28 02:06:12', 1),
(6, 2, 2, 1, '', '2020-05-28 02:06:12', '', '2020-05-28 02:06:12', 1),
(7, 2, 3, 1, '', '2020-05-28 03:10:31', '', '2020-05-28 03:10:31', 1),
(8, 2, 4, 1, '', '2020-05-28 03:10:31', '', '2020-05-28 03:10:31', 1),
(9, 3, 1, 1, '', '2020-05-28 02:06:12', '', '2020-05-28 02:06:12', 1),
(10, 3, 2, 1, '', '2020-05-28 02:06:12', '', '2020-05-28 02:06:12', 1),
(11, 3, 3, 1, '', '2020-05-28 03:10:31', '', '2020-05-28 03:10:31', 1),
(12, 3, 4, 1, '', '2020-05-28 03:10:31', '', '2020-05-28 03:10:31', 1),
(13, 4, 1, 1, '', '2020-05-28 02:06:12', '', '2020-05-28 02:06:12', 1),
(14, 4, 2, 1, '', '2020-05-28 02:06:12', '', '2020-05-28 02:06:12', 1),
(15, 4, 3, 1, '', '2020-05-28 03:10:31', '', '2020-05-28 03:10:31', 1),
(16, 4, 4, 1, '', '2020-05-28 03:10:31', '', '2020-05-28 03:10:31', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_aspeknilai`
--
ALTER TABLE `tb_aspeknilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_bimbingan`
--
ALTER TABLE `tb_bimbingan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nim1` (`nim`),
  ADD KEY `fk_dosen1` (`dospem1`),
  ADD KEY `fk_dosen2` (`dospem2`);

--
-- Indexes for table `tb_content`
--
ALTER TABLE `tb_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_level3` (`id_level`),
  ADD KEY `fk_menu2` (`id_menu`);

--
-- Indexes for table `tb_dosen`
--
ALTER TABLE `tb_dosen`
  ADD PRIMARY KEY (`nidn`);

--
-- Indexes for table `tb_hari`
--
ALTER TABLE `tb_hari`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_jadwalsidang`
--
ALTER TABLE `tb_jadwalsidang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_idwaktusidang1` (`id_waktusidang`),
  ADD KEY `fk_ruangan1` (`id_ruangan`),
  ADD KEY `fk_bimbingan1` (`id_bimbingan`),
  ADD KEY `fk_dospen1` (`dospen1`),
  ADD KEY `fk_dospen2` (`dospen2`);

--
-- Indexes for table `tb_level`
--
ALTER TABLE `tb_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_menuaccess`
--
ALTER TABLE `tb_menuaccess`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_idmenu1` (`id_menu`),
  ADD KEY `fkLevel2` (`id_level`);

--
-- Indexes for table `tb_nilaisidang`
--
ALTER TABLE `tb_nilaisidang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_idbimbingan4` (`id_bimbingan`),
  ADD KEY `fk_iddosen5` (`id_dosen`),
  ADD KEY `fk_aspeknilai1` (`id_aspeknilai`);

--
-- Indexes for table `tb_revisi`
--
ALTER TABLE `tb_revisi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nim3` (`nim`);

--
-- Indexes for table `tb_ruangan`
--
ALTER TABLE `tb_ruangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_level1` (`level_id`);

--
-- Indexes for table `tb_waktu`
--
ALTER TABLE `tb_waktu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_waktusidang`
--
ALTER TABLE `tb_waktusidang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_hari1` (`id_hari`),
  ADD KEY `fk_id_waktu1` (`id_waktu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_aspeknilai`
--
ALTER TABLE `tb_aspeknilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_bimbingan`
--
ALTER TABLE `tb_bimbingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tb_content`
--
ALTER TABLE `tb_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_hari`
--
ALTER TABLE `tb_hari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_jadwalsidang`
--
ALTER TABLE `tb_jadwalsidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tb_level`
--
ALTER TABLE `tb_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_menu`
--
ALTER TABLE `tb_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_menuaccess`
--
ALTER TABLE `tb_menuaccess`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_nilaisidang`
--
ALTER TABLE `tb_nilaisidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_revisi`
--
ALTER TABLE `tb_revisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_ruangan`
--
ALTER TABLE `tb_ruangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tb_waktu`
--
ALTER TABLE `tb_waktu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_waktusidang`
--
ALTER TABLE `tb_waktusidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_bimbingan`
--
ALTER TABLE `tb_bimbingan`
  ADD CONSTRAINT `tb_bimbingan_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `tb_mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_bimbingan_ibfk_2` FOREIGN KEY (`dospem1`) REFERENCES `tb_dosen` (`nidn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_bimbingan_ibfk_3` FOREIGN KEY (`dospem2`) REFERENCES `tb_dosen` (`nidn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_content`
--
ALTER TABLE `tb_content`
  ADD CONSTRAINT `tb_content_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `tb_level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_content_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `tb_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_jadwalsidang`
--
ALTER TABLE `tb_jadwalsidang`
  ADD CONSTRAINT `tb_jadwalsidang_ibfk_1` FOREIGN KEY (`id_waktusidang`) REFERENCES `tb_waktusidang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_jadwalsidang_ibfk_2` FOREIGN KEY (`dospen1`) REFERENCES `tb_dosen` (`nidn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_jadwalsidang_ibfk_3` FOREIGN KEY (`dospen2`) REFERENCES `tb_dosen` (`nidn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_jadwalsidang_ibfk_4` FOREIGN KEY (`id_ruangan`) REFERENCES `tb_ruangan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_jadwalsidang_ibfk_5` FOREIGN KEY (`id_bimbingan`) REFERENCES `tb_bimbingan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_menuaccess`
--
ALTER TABLE `tb_menuaccess`
  ADD CONSTRAINT `tb_menuaccess_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `tb_level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_menuaccess_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `tb_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_nilaisidang`
--
ALTER TABLE `tb_nilaisidang`
  ADD CONSTRAINT `tb_nilaisidang_ibfk_1` FOREIGN KEY (`id_bimbingan`) REFERENCES `tb_bimbingan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_nilaisidang_ibfk_2` FOREIGN KEY (`id_aspeknilai`) REFERENCES `tb_aspeknilai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_nilaisidang_ibfk_3` FOREIGN KEY (`id_dosen`) REFERENCES `tb_dosen` (`nidn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_revisi`
--
ALTER TABLE `tb_revisi`
  ADD CONSTRAINT `tb_revisi_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `tb_mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `tb_level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_waktusidang`
--
ALTER TABLE `tb_waktusidang`
  ADD CONSTRAINT `tb_waktusidang_ibfk_1` FOREIGN KEY (`id_hari`) REFERENCES `tb_hari` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_waktusidang_ibfk_2` FOREIGN KEY (`id_waktu`) REFERENCES `tb_waktu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
