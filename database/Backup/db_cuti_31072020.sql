-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Jul 2020 pada 14.34
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cuti`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_m_access`
--

CREATE TABLE `tb_m_access` (
  `ID` varchar(10) NOT NULL,
  `DESCRIPTION` varchar(50) DEFAULT NULL,
  `CREATED_DT` datetime DEFAULT current_timestamp(),
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `UPDATED_DT` datetime DEFAULT NULL,
  `UPDATED_BY` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_m_access`
--

INSERT INTO `tb_m_access` (`ID`, `DESCRIPTION`, `CREATED_DT`, `CREATED_BY`, `UPDATED_DT`, `UPDATED_BY`) VALUES
('AD', 'Administator', '2020-07-23 19:14:21', 'Admin', NULL, NULL),
('G1', 'Golongan 1', '2020-07-23 19:14:21', 'Admin', NULL, NULL),
('G2', 'Golongan 2', '2020-07-23 19:14:21', 'Admin', NULL, NULL),
('G3', 'Golongan 3', '2020-07-23 19:14:21', 'Admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_m_approval`
--

CREATE TABLE `tb_m_approval` (
  `ID` int(11) NOT NULL,
  `DESCRIPTION` varchar(20) DEFAULT NULL,
  `CREATED_DT` datetime DEFAULT current_timestamp(),
  `CREATED_BY` varchar(10) DEFAULT 'Admin',
  `UPDATED_DT` datetime DEFAULT NULL,
  `UPDATED_BY` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_m_approval`
--

INSERT INTO `tb_m_approval` (`ID`, `DESCRIPTION`, `CREATED_DT`, `CREATED_BY`, `UPDATED_DT`, `UPDATED_BY`) VALUES
(1, 'Rejected', '2020-07-30 09:24:59', 'Admin', NULL, NULL),
(2, 'Waiting', '2020-07-30 09:24:59', 'Admin', NULL, NULL),
(3, 'Approved', '2020-07-30 09:24:59', 'Admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_m_division`
--

CREATE TABLE `tb_m_division` (
  `ID` varchar(10) NOT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `CREATED_DT` datetime DEFAULT current_timestamp(),
  `CREATED_BY` varchar(20) DEFAULT 'Admin',
  `UPDATED_DT` datetime DEFAULT NULL,
  `UPDATED_BY` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_m_division`
--

INSERT INTO `tb_m_division` (`ID`, `DESCRIPTION`, `CREATED_DT`, `CREATED_BY`, `UPDATED_DT`, `UPDATED_BY`) VALUES
('DI', 'Divisi Investasi', '2020-07-23 19:27:19', 'Admin', NULL, NULL),
('DK', 'Divisi Kepegawaian', '2020-07-27 12:36:21', 'Admin', '2020-07-29 10:38:28', 'Admin'),
('DKPP', 'Divisi Kepesertaan dan Pelayanan Pensiun', '2020-07-23 19:27:19', 'Admin', '2020-07-27 10:02:58', 'Admin'),
('DUTI', 'Divisi Umum dan Teknologi Informasi', '2020-07-23 19:27:19', 'Admin', '2020-07-28 03:37:16', 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_m_occupation`
--

CREATE TABLE `tb_m_occupation` (
  `ID` int(10) NOT NULL,
  `POSITION` varchar(50) DEFAULT NULL,
  `ACCESS` varchar(10) DEFAULT NULL,
  `CREATED_DT` datetime DEFAULT current_timestamp(),
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `UPDATED_DT` datetime DEFAULT NULL,
  `UPDATED_BY` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_m_occupation`
--

INSERT INTO `tb_m_occupation` (`ID`, `POSITION`, `ACCESS`, `CREATED_DT`, `CREATED_BY`, `UPDATED_DT`, `UPDATED_BY`) VALUES
(1, 'Administrator', 'AD', '2020-07-23 19:22:59', 'Admin', NULL, NULL),
(2, 'Manager', 'G3', '2020-07-23 19:22:59', 'Admin', '2020-07-29 10:39:31', 'Admin'),
(3, 'Supervisor', 'G2', '2020-07-23 19:22:59', 'Admin', NULL, NULL),
(4, 'Staff', 'G1', '2020-07-23 19:22:59', 'Admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_m_sex`
--

CREATE TABLE `tb_m_sex` (
  `ID` varchar(10) NOT NULL,
  `DESCRIPTION` varchar(50) DEFAULT NULL,
  `CREATED_DT` datetime DEFAULT current_timestamp(),
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `UPDATED_DT` datetime DEFAULT NULL,
  `UPDATED_BY` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_m_sex`
--

INSERT INTO `tb_m_sex` (`ID`, `DESCRIPTION`, `CREATED_DT`, `CREATED_BY`, `UPDATED_DT`, `UPDATED_BY`) VALUES
('F', 'Perempuan', '2020-07-23 19:30:55', 'Admin', NULL, NULL),
('M', 'Laki-laki', '2020-07-23 19:30:55', 'Admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_m_status`
--

CREATE TABLE `tb_m_status` (
  `ID` int(11) NOT NULL,
  `DESCRIPTION` varchar(50) DEFAULT NULL,
  `CREATED_DT` datetime DEFAULT current_timestamp(),
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `UPDATED_DT` datetime DEFAULT NULL,
  `UPDATED_BY` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_m_status`
--

INSERT INTO `tb_m_status` (`ID`, `DESCRIPTION`, `CREATED_DT`, `CREATED_BY`, `UPDATED_DT`, `UPDATED_BY`) VALUES
(0, 'Nonaktif', '2020-07-23 19:29:33', 'Admin', NULL, NULL),
(1, 'Aktif', '2020-07-23 19:29:33', 'Admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_r_employee`
--

CREATE TABLE `tb_r_employee` (
  `NOREG` varchar(20) NOT NULL,
  `NAME` varchar(100) DEFAULT NULL,
  `USERNAME` varchar(50) DEFAULT NULL,
  `EMAIL` text DEFAULT NULL,
  `SEX` varchar(2) DEFAULT NULL,
  `POSITION` int(11) DEFAULT NULL,
  `DIVISION` varchar(10) DEFAULT NULL,
  `PHOTO` varchar(50) DEFAULT 'noimage.png',
  `PIC` varchar(20) DEFAULT NULL,
  `CREATED_DT` datetime DEFAULT current_timestamp(),
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `UPDATED_DT` datetime DEFAULT NULL,
  `UPDATED_BY` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_r_employee`
--

INSERT INTO `tb_r_employee` (`NOREG`, `NAME`, `USERNAME`, `EMAIL`, `SEX`, `POSITION`, `DIVISION`, `PHOTO`, `PIC`, `CREATED_DT`, `CREATED_BY`, `UPDATED_DT`, `UPDATED_BY`) VALUES
('Adm/DUTI/1', 'Administator', 'Admin', NULL, 'M', 1, 'DUTI', 'noimage.png', NULL, '2020-07-23 20:03:32', 'Admin', '2020-07-29 07:30:29', 'Admin'),
('Emp/DI/1', 'Rani Kuniawati', 'Rani', NULL, 'F', 2, 'DI', 'noimage.png', NULL, '2020-07-23 20:39:04', 'Admin', NULL, NULL),
('Emp/DI/2', 'Madada Nurkholida', 'Madada', NULL, 'F', 4, 'DI', 'noimage.png', 'Emp/DI/3', '2020-07-28 10:13:15', NULL, NULL, NULL),
('Emp/DI/3', 'Tia Khairina', 'Tia', NULL, 'F', 3, 'DI', 'noimage.png', 'Emp/DI/1', '2020-07-23 21:13:44', 'Admin', NULL, NULL),
('Emp/DI/4', 'Ayu Fitriani', 'Ayu', NULL, 'F', 3, 'DI', 'noimage.png', 'Emp/DI/1', '2020-07-29 10:00:26', NULL, NULL, NULL),
('Emp/DI/5', 'Natasya Amelia Apriliani', 'Natasya', NULL, 'F', 4, 'DI', 'noimage.png', 'Emp/DI/4', '2020-07-29 10:01:09', NULL, '2020-07-30 10:55:25', 'Admin'),
('Emp/DK/1', 'Reddy Orlan Ibrahim', 'Reddy', NULL, 'M', 2, 'DK', 'noimage.png', NULL, '2020-07-29 09:53:50', NULL, NULL, NULL),
('Emp/DK/2', 'Ibnu Satria', 'Ibnu', NULL, 'M', 4, 'DK', 'noimage.png', 'Emp/DK/1', '2020-07-29 09:56:52', NULL, NULL, NULL),
('Emp/DK/3', 'Bayu Rizki Darmawan', 'Bayu', NULL, 'M', 4, 'DK', 'noimage.png', 'Emp/DK/1', '2020-07-29 09:59:14', NULL, NULL, NULL),
('Emp/DKPP/1', 'Khoirul Aqil', 'Aqil', NULL, 'M', 3, 'DKPP', 'noimage.png', 'Emp/DKPP/2', '2020-07-28 09:33:05', NULL, NULL, NULL),
('Emp/DKPP/2', 'Rudi Hermawan', 'Rudi', NULL, 'M', 2, 'DKPP', 'noimage.png', NULL, '2020-07-23 21:14:26', 'Admin', NULL, NULL),
('Emp/DKPP/3', 'Rian Subagyo', 'RianS', NULL, 'M', 4, 'DKPP', 'noimage.png', 'Emp/DKPP/1', '2020-07-23 21:38:00', 'Admin', '2020-07-30 10:55:11', 'Admin'),
('Emp/DKPP/4', 'Bima Fatahilah', 'Bima', NULL, 'M', 4, 'DKPP', 'noimage.png', 'Emp/DKPP/5', '2020-07-28 10:25:17', NULL, '2020-07-29 10:33:53', 'Admin'),
('Emp/DKPP/5', 'Anton Tri Atmojo', 'Anton', NULL, 'M', 3, 'DKPP', 'noimage.png', 'Emp/DKPP/2', '2020-07-28 15:06:07', NULL, NULL, NULL),
('Emp/DKPP/6', 'Aif Firmansyah', 'Aif', NULL, 'M', 4, 'DKPP', 'noimage.png', 'Emp/DKPP/5', '2020-07-28 15:12:33', NULL, NULL, NULL),
('Emp/DUTI/2', 'Agung Hermawan', 'Agung', NULL, 'M', 3, 'DUTI', 'noimage.png', 'Emp/DUTI/3', '2020-07-28 09:21:11', NULL, NULL, NULL),
('Emp/DUTI/3', 'Aji Pangestu', 'Pangestu', NULL, 'M', 2, 'DUTI', 'noimage.png', NULL, '2020-07-23 20:39:46', 'Admin', NULL, NULL),
('Emp/DUTI/4', 'Widi Ardiansyah', 'Widi', NULL, 'M', 3, 'DUTI', 'noimage.png', 'Emp/DUTI/3', '2020-07-28 09:40:53', NULL, NULL, NULL),
('Emp/DUTI/5', 'Rian Subhanhadi', 'Rian', NULL, 'M', 4, 'DUTI', 'pexels-photo-220453.jpeg', 'Emp/DUTI/7', '2020-07-23 20:42:37', 'Admin', '2020-07-30 10:55:01', 'Admin'),
('Emp/DUTI/6', 'Rianto Anggara', 'Rianto', NULL, 'M', 4, 'DUTI', 'noimage.png', 'Emp/DUTI/2', '2020-07-28 09:31:21', NULL, '2020-07-29 10:00:18', 'Admin'),
('Emp/DUTI/7', 'Faiz Imanuddin', 'Faiz', 'agunghn07@gmail.com', 'M', 3, 'DUTI', 'noimage.png', 'Emp/DUTI/3', '2020-07-28 15:10:09', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_r_logon`
--

CREATE TABLE `tb_r_logon` (
  `ID` int(11) NOT NULL,
  `NOREG` varchar(15) DEFAULT NULL,
  `PASSWORD` varchar(100) DEFAULT NULL,
  `STATUS` int(11) DEFAULT NULL,
  `CREATED_DT` datetime DEFAULT current_timestamp(),
  `CREATED_BY` varchar(20) DEFAULT 'Admin',
  `UPDATED_DT` datetime DEFAULT NULL,
  `UPDATED_BY` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_r_logon`
--

INSERT INTO `tb_r_logon` (`ID`, `NOREG`, `PASSWORD`, `STATUS`, `CREATED_DT`, `CREATED_BY`, `UPDATED_DT`, `UPDATED_BY`) VALUES
(1, 'Adm/DUTI/1', '$2y$10$J9cqndCK.YFNgoCuUsKXWuYeBpjdaMrANVwxVRgfOHNV5g9hWAiGW', 1, '2020-07-23 20:05:45', 'Admin', NULL, NULL),
(2, 'Emp/DUTI/4', '$2y$10$Wg8kQCfJieb3tz3vAHNCCO4MocUBdiLWxVLfGHMKZlnI1RLKMtDvC', 0, '2020-07-28 09:40:53', 'Admin', NULL, NULL),
(3, 'Emp/DI/1', '$2y$10$Nkxfqxw8GUrp949m00QKIO2ZSBoe.lKN5het.SHfYg1pYyV1GS.aW', 0, '2020-07-23 20:39:04', 'Admin', NULL, NULL),
(4, 'Emp/DUTI/3', '$2y$10$efiGJe6pwNng0MPqVRFKX.p0oLGgOKGB/JqjLd6BZL0D/6uV4OvRG', 0, '2020-07-23 20:39:46', 'Admin', '2020-07-25 09:09:17', 'Admin'),
(5, 'Emp/DI/2', '$2y$10$Ej.IdfKXCkEpYBjKke/x/.P2eGyKNrgOu/wAc32dG.B5H9kuVKJZq', 0, '2020-07-28 10:13:16', 'Admin', NULL, NULL),
(6, 'Emp/DKPP/4', '$2y$10$3Jm.yq96cs2oWBOs6wvnSO50bBDK4f7BkKlDch3pbaBmmBdZ3HPCW', 0, '2020-07-28 10:25:17', 'Admin', NULL, NULL),
(7, 'Emp/DUTI/5', '$2y$10$Ta7Sx.nL81SOXZZ.td28ie7gIRmOuDSKFeJyfDedeBZ3NEkQQSZmi', 1, '2020-07-23 20:42:37', 'Admin', '2020-07-29 11:17:04', 'Admin'),
(8, 'Emp/DKPP/5', '$2y$10$kTkbPcDMLWSGQ5D9vxjIju3.gifu6suDvuPPFn/gT/aoeQOlIy78q', 0, '2020-07-28 15:06:07', 'Admin', NULL, NULL),
(9, 'Emp/DI/3', '$2y$10$PpkcFRdPVdfS5kVLKZw57.8BPqGSWrRx90b/8mLFBkZ9sC5ACV992', 0, '2020-07-23 21:13:44', 'Admin', NULL, NULL),
(10, 'Emp/DKPP/2', '$2y$10$OjXpyfvLEAsXdnDEhBeZYeojcM79ewMz4dst8c52l7DPDqRubhwcu', 0, '2020-07-23 21:14:26', 'Admin', '2020-07-28 03:03:07', 'Admin'),
(11, 'Emp/DKPP/3', '$2y$10$Rq9AOJGa2n72Wk5OxRf5teapt0aGceojWtZGzmfUrlFzD/wNF0IPa', 0, '2020-07-23 21:38:00', 'Admin', NULL, NULL),
(12, 'Emp/DUTI/2', '$2y$10$xLq4fWJdvKKSRqqnNuBRFONXv28/ud5dlFukNLRITbZFZfWWMEGb2', 0, '2020-07-28 09:21:12', 'Admin', '2020-07-29 11:05:30', 'Admin'),
(13, 'Emp/DUTI/6', '$2y$10$7zKeXtx1WZI78CEUwBaT0OeZRFdoAAlt1JoYHV9eHSGpT9SMBpOxC', 0, '2020-07-28 09:31:22', 'Admin', '2020-07-28 10:28:25', 'Admin'),
(14, 'Emp/DKPP/1', '$2y$10$6PGnVxGHnlKkU46A4vDI1O1s/oNrvg12f4OCDCca9WyuyVsJQhB6C', 0, '2020-07-28 09:33:06', 'Admin', NULL, NULL),
(15, 'Emp/DUTI/7', '$2y$10$dvGm0TXKZRL3jvBN2Be57e/WsKysW2sBKELj8/upsRqUjcNnACVp2', 0, '2020-07-28 15:10:09', 'Admin', NULL, NULL),
(16, 'Emp/DKPP/6', '$2y$10$JqCLwSmMZFVWBWpzgzx0bOUx2vtorglwM0eIRMolB4iieNLmVBAVq', 0, '2020-07-28 15:12:33', 'Admin', NULL, NULL),
(17, 'Emp/DK/1', '$2y$10$Du5mI8lNf.N0h4OYAuVp9ukFara9jlhn0b9vW3IKF78gS.uYMDOp.', 0, '2020-07-29 09:53:50', 'Admin', NULL, NULL),
(18, 'Emp/DK/2', '$2y$10$OQXF/zVUidwvmg5N5Bnwy.buCeglPsTumxDZqK0ardzzcQ83ZY6dS', 0, '2020-07-29 09:56:52', 'Admin', NULL, NULL),
(19, 'Emp/DK/3', '$2y$10$OUXIe8rpWgD5F8hS1FvWxu5IpgHDyItU2Dz9VfyulM9PQ9.4PeAR6', 0, '2020-07-29 09:59:14', 'Admin', NULL, NULL),
(20, 'Emp/DI/4', '$2y$10$rNJXYexe5JZ.eY2iBK2ateTDB9amxYlI/zb2hJ86PsqRHbzOldlYG', 0, '2020-07-29 10:00:26', 'Admin', NULL, NULL),
(21, 'Emp/DI/5', '$2y$10$Yp0u96l1wkuK7EdYOHphrOGAZoWP62IZ0zA0ztJcYrromoXJ2XQt2', 0, '2020-07-29 10:01:09', 'Admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_r_token`
--

CREATE TABLE `tb_r_token` (
  `id_token` int(100) NOT NULL,
  `user_noreg` varchar(20) DEFAULT NULL,
  `access_token` text DEFAULT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_r_token`
--

INSERT INTO `tb_r_token` (`id_token`, `user_noreg`, `access_token`, `last_activity`) VALUES
(67, 'Emp/DUTI/5', '$1$bBMF89uI$vHRDQncqzfLYIFmgl1H0l0', '2020-07-30 14:03:45'),
(70, 'Emp/DUTI/5', '$1$SsYwdf4B$R3V/RTBEde0etJv8Se/9b0', '2020-07-30 15:55:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_t_cuti`
--

CREATE TABLE `tb_t_cuti` (
  `ID` int(11) NOT NULL,
  `EMP_NOREG` varchar(20) DEFAULT NULL,
  `PERIODE` varchar(10) DEFAULT NULL,
  `SISA_CUTI` int(11) NOT NULL,
  `CREATED_DT` datetime DEFAULT current_timestamp(),
  `CREATED_BY` varchar(10) DEFAULT 'Admin',
  `UPDATED_DT` datetime DEFAULT NULL,
  `UPDATED_BY` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_t_cuti`
--

INSERT INTO `tb_t_cuti` (`ID`, `EMP_NOREG`, `PERIODE`, `SISA_CUTI`, `CREATED_DT`, `CREATED_BY`, `UPDATED_DT`, `UPDATED_BY`) VALUES
(1, 'EMP/DI/1', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(2, 'EMP/DI/2', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(3, 'EMP/DI/3', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(4, 'Emp/DI/4', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(5, 'EMP/DI/5', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(6, 'EMP/DK/1', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(7, 'EMP/DK/2', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(8, 'EMP/DK/3', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(9, 'EMP/DKPP/1', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(10, 'EMP/DKPP/2', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(11, 'EMP/DKPP/3', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(12, 'EMP/DKPP/4', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(13, 'EMP/DKPP/5', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(14, 'EMP/DKPP/6', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(15, 'EMP/DUTI/2', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(16, 'EMP/DUTI/3', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(17, 'EMP/DUTI/4', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(18, 'EMP/DUTI/5', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(19, 'EMP/DUTI/6', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(20, 'EMP/DUTI/7', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_t_pengajuan_cuti`
--

CREATE TABLE `tb_t_pengajuan_cuti` (
  `ID` int(11) NOT NULL,
  `NOMOR_CUTI` varchar(20) DEFAULT NULL,
  `NOREG` varchar(20) NOT NULL,
  `TANGGAL_PENGAJUAN` datetime DEFAULT NULL,
  `START_DT` date DEFAULT NULL,
  `UNTIL_DT` date DEFAULT NULL,
  `ALASAN` text NOT NULL,
  `APPROVAL_1` int(11) DEFAULT NULL,
  `APPROVAL_2` int(11) DEFAULT NULL,
  `APPROVAL_3` int(11) DEFAULT NULL,
  `IS_APPROVE` int(11) DEFAULT NULL,
  `CREATED_DT` datetime DEFAULT current_timestamp(),
  `CREATED_BY` varchar(50) DEFAULT NULL,
  `UPDATED_DT` datetime DEFAULT NULL,
  `UPDATED_BY` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_t_pengajuan_cuti`
--

INSERT INTO `tb_t_pengajuan_cuti` (`ID`, `NOMOR_CUTI`, `NOREG`, `TANGGAL_PENGAJUAN`, `START_DT`, `UNTIL_DT`, `ALASAN`, `APPROVAL_1`, `APPROVAL_2`, `APPROVAL_3`, `IS_APPROVE`, `CREATED_DT`, `CREATED_BY`, `UPDATED_DT`, `UPDATED_BY`) VALUES
(1, 'Emp/DUTI/5/20-1', 'Emp/DUTI/5', '2020-07-31 04:05:48', '2020-08-09', '2020-08-10', 'Mengurus surat kehilangan SIM dan STNK di Polsek Tangerang Kota', 2, NULL, NULL, 2, '2020-07-31 16:05:48', 'Rian', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_m_access`
--
ALTER TABLE `tb_m_access`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `tb_m_approval`
--
ALTER TABLE `tb_m_approval`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `tb_m_division`
--
ALTER TABLE `tb_m_division`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `tb_m_occupation`
--
ALTER TABLE `tb_m_occupation`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_tb_m_occupation_ACCESS` (`ACCESS`);

--
-- Indeks untuk tabel `tb_m_sex`
--
ALTER TABLE `tb_m_sex`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `tb_m_status`
--
ALTER TABLE `tb_m_status`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `tb_r_employee`
--
ALTER TABLE `tb_r_employee`
  ADD PRIMARY KEY (`NOREG`),
  ADD UNIQUE KEY `UQ_tb_r_employee_USERNAME` (`USERNAME`),
  ADD KEY `FK_tb_r_employee_SEX` (`SEX`),
  ADD KEY `FK_tb_r_employee_DIVISION` (`DIVISION`),
  ADD KEY `FK_tb_r_employee_POSITION` (`POSITION`),
  ADD KEY `FK_tb_r_employee_NOREG` (`PIC`);

--
-- Indeks untuk tabel `tb_r_logon`
--
ALTER TABLE `tb_r_logon`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_tb_r_logon_STATUS` (`STATUS`),
  ADD KEY `FK_tb_r_logon_NOREG` (`NOREG`);

--
-- Indeks untuk tabel `tb_r_token`
--
ALTER TABLE `tb_r_token`
  ADD PRIMARY KEY (`id_token`),
  ADD KEY `FK_tb_r_token_user_noreg` (`user_noreg`);

--
-- Indeks untuk tabel `tb_t_cuti`
--
ALTER TABLE `tb_t_cuti`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UQ_tb_t_cuti_EMP_NOREG` (`EMP_NOREG`);

--
-- Indeks untuk tabel `tb_t_pengajuan_cuti`
--
ALTER TABLE `tb_t_pengajuan_cuti`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_r_token`
--
ALTER TABLE `tb_r_token`
  MODIFY `id_token` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT untuk tabel `tb_t_cuti`
--
ALTER TABLE `tb_t_cuti`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_t_pengajuan_cuti`
--
ALTER TABLE `tb_t_pengajuan_cuti`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_m_occupation`
--
ALTER TABLE `tb_m_occupation`
  ADD CONSTRAINT `FK_tb_m_occupation_ACCESS` FOREIGN KEY (`ACCESS`) REFERENCES `tb_m_access` (`ID`);

--
-- Ketidakleluasaan untuk tabel `tb_r_employee`
--
ALTER TABLE `tb_r_employee`
  ADD CONSTRAINT `FK_tb_r_employee_DIVISION` FOREIGN KEY (`DIVISION`) REFERENCES `tb_m_division` (`ID`),
  ADD CONSTRAINT `FK_tb_r_employee_NOREG` FOREIGN KEY (`PIC`) REFERENCES `tb_r_employee` (`NOREG`),
  ADD CONSTRAINT `FK_tb_r_employee_POSITION` FOREIGN KEY (`POSITION`) REFERENCES `tb_m_occupation` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tb_r_employee_SEX` FOREIGN KEY (`SEX`) REFERENCES `tb_m_sex` (`ID`);

--
-- Ketidakleluasaan untuk tabel `tb_r_logon`
--
ALTER TABLE `tb_r_logon`
  ADD CONSTRAINT `FK_tb_r_logon_NOREG` FOREIGN KEY (`NOREG`) REFERENCES `tb_r_employee` (`NOREG`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_tb_r_logon_STATUS` FOREIGN KEY (`STATUS`) REFERENCES `tb_m_status` (`ID`);

--
-- Ketidakleluasaan untuk tabel `tb_r_token`
--
ALTER TABLE `tb_r_token`
  ADD CONSTRAINT `FK_tb_r_token_user_noreg` FOREIGN KEY (`user_noreg`) REFERENCES `tb_r_employee` (`NOREG`);

--
-- Ketidakleluasaan untuk tabel `tb_t_cuti`
--
ALTER TABLE `tb_t_cuti`
  ADD CONSTRAINT `FK_tb_t_cuti_EMP_NOREG` FOREIGN KEY (`EMP_NOREG`) REFERENCES `tb_r_employee` (`NOREG`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
