-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Jul 2020 pada 03.44
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
('DK', 'Divisi Kepegawaian', '2020-07-27 12:36:21', 'Admin', '2020-07-27 08:00:40', 'Admin'),
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
(2, 'Manager', 'G3', '2020-07-23 19:22:59', 'Admin', '2020-07-28 03:38:01', 'Admin'),
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

INSERT INTO `tb_r_employee` (`NOREG`, `NAME`, `USERNAME`, `SEX`, `POSITION`, `DIVISION`, `PHOTO`, `PIC`, `CREATED_DT`, `CREATED_BY`, `UPDATED_DT`, `UPDATED_BY`) VALUES
('Adm/DUTI/1', 'Administator', 'Admin', 'M', 1, 'DUTI', 'noimage.png', NULL, '2020-07-23 20:03:32', 'Admin', '2020-07-27 10:04:39', 'Admin'),
('Emp/DI/1', 'Rani Kuniawati', 'Rani', 'F', 2, 'DI', 'noimage.png', NULL, '2020-07-23 20:39:04', 'Admin', NULL, NULL),
('Emp/DI/2', 'Madada Nurkholida', 'Madada', 'F', 4, 'DI', 'noimage.png', 'Emp/DI/3', '2020-07-28 10:13:15', NULL, NULL, NULL),
('Emp/DI/3', 'Tia Khairina', 'Tia', 'F', 3, 'DI', 'noimage.png', 'Emp/DI/1', '2020-07-23 21:13:44', 'Admin', NULL, NULL),
('Emp/DKPP/1', 'Khoirul Aqil', 'Aqil', 'M', 3, 'DKPP', 'noimage.png', 'Emp/DKPP/2', '2020-07-28 09:33:05', NULL, NULL, NULL),
('Emp/DKPP/2', 'Rudi Hermawan', 'Rudi', 'M', 2, 'DKPP', 'noimage.png', NULL, '2020-07-23 21:14:26', 'Admin', NULL, NULL),
('Emp/DKPP/3', 'Rian Subagyo', 'RianS', 'M', 4, 'DKPP', 'noimage.png', 'Emp/DKPP/5', '2020-07-23 21:38:00', 'Admin', '2020-07-29 08:42:55', 'Admin'),
('Emp/DKPP/4', 'Bima Fatahilah', 'Bima', 'M', 4, 'DKPP', 'noimage.png', 'Emp/DKPP/1', '2020-07-28 10:25:17', NULL, NULL, NULL),
('Emp/DKPP/5', 'Anton Tri Atmojo', 'Anton', 'M', 3, 'DKPP', 'noimage.png', 'Emp/DKPP/2', '2020-07-28 15:06:07', NULL, NULL, NULL),
('Emp/DKPP/6', 'Aif Firmansyah', 'Aif', 'M', 4, 'DKPP', 'noimage.png', 'Emp/DKPP/5', '2020-07-28 15:12:33', NULL, NULL, NULL),
('Emp/DUTI/2', 'Agung Hermawan', 'Agung', 'M', 3, 'DUTI', 'noimage.png', 'Emp/DUTI/3', '2020-07-28 09:21:11', NULL, NULL, NULL),
('Emp/DUTI/3', 'Aji Pangestu', 'Pangestu', 'M', 2, 'DUTI', 'noimage.png', NULL, '2020-07-23 20:39:46', 'Admin', NULL, NULL),
('Emp/DUTI/4', 'Widi Ardiansyah', 'Widi', 'M', 3, 'DUTI', 'noimage.png', 'Emp/DUTI/3', '2020-07-28 09:40:53', NULL, NULL, NULL),
('Emp/DUTI/5', 'Rian Subhanhadi', 'Rian', 'M', 4, 'DUTI', 'noimage.png', 'Emp/DUTI/2', '2020-07-23 20:42:37', 'Admin', '2020-07-29 08:43:31', 'Admin'),
('Emp/DUTI/6', 'Rianto Anggara', 'Rianto', 'M', 4, 'DUTI', 'noimage.png', 'Emp/DUTI/4', '2020-07-28 09:31:21', NULL, '2020-07-29 08:43:26', 'Admin'),
('Emp/DUTI/7', 'Faiz Imanuddin', 'Faiz', 'M', 3, 'DUTI', 'noimage.png', 'Emp/DUTI/3', '2020-07-28 15:10:09', NULL, NULL, NULL);

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
(1, 'Adm/DUTI/1', '$2y$10$lkaDyIf7Z9VWdI5UijUPWextsM3dYq6o21hZpQmGy4KE3fvOEr0Oq', 1, '2020-07-23 20:05:45', 'Admin', NULL, NULL),
(2, 'Emp/DUTI/4', '$2y$10$Wg8kQCfJieb3tz3vAHNCCO4MocUBdiLWxVLfGHMKZlnI1RLKMtDvC', 0, '2020-07-28 09:40:53', 'Admin', NULL, NULL),
(3, 'Emp/DI/1', '$2y$10$Nkxfqxw8GUrp949m00QKIO2ZSBoe.lKN5het.SHfYg1pYyV1GS.aW', 0, '2020-07-23 20:39:04', 'Admin', NULL, NULL),
(4, 'Emp/DUTI/3', '$2y$10$efiGJe6pwNng0MPqVRFKX.p0oLGgOKGB/JqjLd6BZL0D/6uV4OvRG', 0, '2020-07-23 20:39:46', 'Admin', '2020-07-25 09:09:17', 'Admin'),
(5, 'Emp/DI/2', '$2y$10$Ej.IdfKXCkEpYBjKke/x/.P2eGyKNrgOu/wAc32dG.B5H9kuVKJZq', 0, '2020-07-28 10:13:16', 'Admin', NULL, NULL),
(6, 'Emp/DKPP/4', '$2y$10$3Jm.yq96cs2oWBOs6wvnSO50bBDK4f7BkKlDch3pbaBmmBdZ3HPCW', 0, '2020-07-28 10:25:17', 'Admin', NULL, NULL),
(7, 'Emp/DUTI/5', '$2y$10$qKE17VaQdJo2tYDfj5tO8.Gj6H7GO8NzFL5XW.LLexP.cIQ5rfBCm', 0, '2020-07-23 20:42:37', 'Admin', NULL, NULL),
(8, 'Emp/DKPP/5', '$2y$10$kTkbPcDMLWSGQ5D9vxjIju3.gifu6suDvuPPFn/gT/aoeQOlIy78q', 0, '2020-07-28 15:06:07', 'Admin', NULL, NULL),
(9, 'Emp/DI/3', '$2y$10$PpkcFRdPVdfS5kVLKZw57.8BPqGSWrRx90b/8mLFBkZ9sC5ACV992', 0, '2020-07-23 21:13:44', 'Admin', NULL, NULL),
(10, 'Emp/DKPP/2', '$2y$10$OjXpyfvLEAsXdnDEhBeZYeojcM79ewMz4dst8c52l7DPDqRubhwcu', 0, '2020-07-23 21:14:26', 'Admin', '2020-07-28 03:03:07', 'Admin'),
(11, 'Emp/DKPP/3', '$2y$10$Rq9AOJGa2n72Wk5OxRf5teapt0aGceojWtZGzmfUrlFzD/wNF0IPa', 0, '2020-07-23 21:38:00', 'Admin', NULL, NULL),
(12, 'Emp/DUTI/2', '$2y$10$X3E2cAnBCTCF8MIDHwRER.gkwEfb/UOaIfzR9iXrkyiRxw18Yl4C2', 1, '2020-07-28 09:21:12', 'Admin', '2020-07-28 08:02:48', 'Admin'),
(13, 'Emp/DUTI/6', '$2y$10$7zKeXtx1WZI78CEUwBaT0OeZRFdoAAlt1JoYHV9eHSGpT9SMBpOxC', 0, '2020-07-28 09:31:22', 'Admin', '2020-07-28 10:28:25', 'Admin'),
(14, 'Emp/DKPP/1', '$2y$10$6PGnVxGHnlKkU46A4vDI1O1s/oNrvg12f4OCDCca9WyuyVsJQhB6C', 0, '2020-07-28 09:33:06', 'Admin', NULL, NULL),
(15, 'Emp/DUTI/7', '$2y$10$dvGm0TXKZRL3jvBN2Be57e/WsKysW2sBKELj8/upsRqUjcNnACVp2', 0, '2020-07-28 15:10:09', 'Admin', NULL, NULL),
(16, 'Emp/DKPP/6', '$2y$10$JqCLwSmMZFVWBWpzgzx0bOUx2vtorglwM0eIRMolB4iieNLmVBAVq', 0, '2020-07-28 15:12:33', 'Admin', NULL, NULL);

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
(6, 'Adm/DUTI/1', '$1$j9ylRxk1$MyoIFoUMRR0N3ng3mEzlA.', '2020-07-29 01:41:50');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_m_access`
--
ALTER TABLE `tb_m_access`
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
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_r_token`
--
ALTER TABLE `tb_r_token`
  MODIFY `id_token` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
