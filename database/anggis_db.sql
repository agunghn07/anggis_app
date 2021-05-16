-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Bulan Mei 2021 pada 08.29
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anggis_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_m_list`
--

CREATE TABLE `tb_m_list` (
  `ID` int(11) NOT NULL,
  `TITLE` varchar(200) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `CREATED_DT` datetime DEFAULT current_timestamp(),
  `CREATED_BY` varchar(100) DEFAULT 'ADMIN',
  `CHANGED_DT` datetime DEFAULT NULL,
  `CHANGED_BY` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_m_list`
--

INSERT INTO `tb_m_list` (`ID`, `TITLE`, `DESCRIPTION`, `CREATED_DT`, `CREATED_BY`, `CHANGED_DT`, `CHANGED_BY`) VALUES
(1, 'Pemeriksaan Berkas / DOC12A', 'Kelengkapan Berkas / DOC12A', '2021-05-11 22:14:11', 'ADMIN', '2021-05-13 01:05:28', 'ADMIN'),
(2, 'Pemeriksaan Risalah', 'Risalah Rapat Persetujuan', '2021-05-11 22:15:19', 'ADMIN', NULL, NULL),
(3, 'Pemeriksaan Berkas / DOC12B', 'Kelengkapan Berkas DOC12B', '2021-05-11 22:16:45', 'ADMIN', '2021-05-13 01:05:16', 'ADMIN'),
(4, 'Pemeriksaan Dokumen Resmi', 'Kelengkapan Atribut Dokumen', '2021-05-11 22:18:15', 'ADMIN', NULL, NULL),
(5, 'Rapat Persetujuan', 'Rapat konsultasi perusahaan', '2021-05-11 22:19:15', 'ADMIN', '2021-05-12 07:05:03', 'ADMIN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_m_sublist`
--

CREATE TABLE `tb_m_sublist` (
  `ID` int(11) NOT NULL,
  `ID_LIST` int(11) NOT NULL,
  `DESCRIPTION` varchar(200) DEFAULT NULL,
  `CREATED_DT` datetime DEFAULT current_timestamp(),
  `CREATED_BY` varchar(100) DEFAULT 'ADMIN',
  `CHANGED_DT` datetime DEFAULT NULL,
  `CHANGED_BY` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_m_sublist`
--

INSERT INTO `tb_m_sublist` (`ID`, `ID_LIST`, `DESCRIPTION`, `CREATED_DT`, `CREATED_BY`, `CHANGED_DT`, `CHANGED_BY`) VALUES
(1, 1, 'Judul Pekerjaan', '2021-05-11 22:14:11', 'ADMIN', '2021-05-13 01:05:28', 'ADMIN'),
(2, 1, 'Tanggal Pelaksanaan', '2021-05-11 22:14:11', 'ADMIN', '2021-05-13 01:05:28', 'ADMIN'),
(3, 1, 'Perusahaan', '2021-05-11 22:14:11', 'ADMIN', '2021-05-13 01:05:28', 'ADMIN'),
(4, 1, 'Persetujuan', '2021-05-11 22:14:11', 'ADMIN', '2021-05-13 01:05:28', 'ADMIN'),
(5, 1, 'Penyesuaian Redaksi', '2021-05-11 22:14:11', 'ADMIN', '2021-05-13 01:05:28', 'ADMIN'),
(6, 2, 'Judul Risalah', '2021-05-11 22:15:19', 'ADMIN', NULL, NULL),
(7, 2, 'Tanggal Risalah', '2021-05-11 22:15:19', 'ADMIN', NULL, NULL),
(8, 2, 'Persetujuan', '2021-05-11 22:15:19', 'ADMIN', NULL, NULL),
(9, 3, 'Penyesuaian Redaksi', '2021-05-11 22:16:45', 'ADMIN', '2021-05-13 01:05:16', 'ADMIN'),
(10, 3, 'Tanggal Pelaksaan', '2021-05-11 22:16:45', 'ADMIN', '2021-05-13 01:05:16', 'ADMIN'),
(11, 3, 'Persetujuan', '2021-05-11 22:16:45', 'ADMIN', '2021-05-13 01:05:16', 'ADMIN'),
(13, 3, 'Perusahaan', '2021-05-11 22:17:22', 'ADMIN', '2021-05-13 01:05:16', 'ADMIN'),
(14, 4, 'Judul Dokumen', '2021-05-11 22:18:15', 'ADMIN', NULL, NULL),
(15, 4, 'Tanggal Dokumen', '2021-05-11 22:18:15', 'ADMIN', NULL, NULL),
(16, 4, 'Kesimpulan', '2021-05-11 22:18:15', 'ADMIN', NULL, NULL),
(17, 5, 'Tanggal Rapat', '2021-05-11 22:19:15', 'ADMIN', '2021-05-12 07:05:03', 'ADMIN'),
(18, 5, 'Pembahasan Rapat', '2021-05-11 22:19:15', 'ADMIN', '2021-05-12 07:05:03', 'ADMIN'),
(19, 5, 'Konsumsi', '2021-05-11 22:19:15', 'ADMIN', '2021-05-12 07:05:03', 'ADMIN'),
(20, 5, 'Pendanaan', '2021-05-12 06:14:33', 'ADMIN', '2021-05-12 07:05:03', 'ADMIN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_m_user`
--

CREATE TABLE `tb_m_user` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(100) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `ROLE` varchar(10) NOT NULL,
  `CREATED_DT` datetime DEFAULT current_timestamp(),
  `CREATED_BY` varchar(50) DEFAULT 'SYSTEM'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_m_user`
--

INSERT INTO `tb_m_user` (`ID`, `USERNAME`, `PASSWORD`, `ROLE`, `CREATED_DT`, `CREATED_BY`) VALUES
(1, 'Admin', '1234', 'admin', '2021-05-16 12:15:46', 'SYSTEM'),
(2, 'User', '1234', 'user', '2021-05-16 13:13:17', 'SYSTEM');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_r_babp`
--

CREATE TABLE `tb_r_babp` (
  `NO_BABP` varchar(10) NOT NULL,
  `TANGGAL_BABP` date DEFAULT NULL,
  `APP` varchar(100) NOT NULL,
  `PERUSAHAAN` varchar(100) NOT NULL,
  `CREATED_DT` datetime DEFAULT current_timestamp(),
  `CREATED_BY` varchar(100) DEFAULT 'SYSTEM'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_r_babp`
--

INSERT INTO `tb_r_babp` (`NO_BABP`, `TANGGAL_BABP`, `APP`, `PERUSAHAAN`, `CREATED_DT`, `CREATED_BY`) VALUES
('B09102', '2021-05-22', 'Angkasa Pura 1', 'Aviasi', '2021-05-16 01:35:20', 'SYSTEM'),
('B09104', '2021-05-19', 'Angkasa Pura Property', 'Outsourcing', '2021-05-16 01:34:23', 'SYSTEM'),
('B09105', '2021-05-17', 'Airnav', 'Aviasi', '2021-05-16 01:32:53', 'SYSTEM'),
('B09107', '2021-05-15', 'Angkasa Pura Solution', 'Outsourcing', '2021-05-16 01:31:01', 'SYSTEM'),
('B09109', '2021-05-14', 'Angkasa Pura 2', 'Aviasi', '2021-05-16 01:28:52', 'SYSTEM'),
('B09112', '2021-05-01', 'Kosami', 'Outsourcing', '2021-05-16 01:09:36', 'SYSTEM');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_r_checklist`
--

CREATE TABLE `tb_r_checklist` (
  `ID` int(11) NOT NULL,
  `ID_LIST` int(11) NOT NULL,
  `ID_BABP` varchar(10) NOT NULL,
  `ID_SUBLIST` int(11) NOT NULL,
  `CREATED_DT` datetime DEFAULT current_timestamp(),
  `CREATED_BY` varchar(100) DEFAULT 'SYSTEM'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_r_checklist`
--

INSERT INTO `tb_r_checklist` (`ID`, `ID_LIST`, `ID_BABP`, `ID_SUBLIST`, `CREATED_DT`, `CREATED_BY`) VALUES
(164, 1, 'B09112', 2, '2021-05-16 01:09:50', 'SYSTEM'),
(165, 1, 'B09112', 4, '2021-05-16 01:09:50', 'SYSTEM'),
(166, 2, 'B09112', 7, '2021-05-16 01:10:03', 'SYSTEM'),
(168, 2, 'B09112', 8, '2021-05-16 01:10:12', 'SYSTEM'),
(172, 4, 'B09112', 14, '2021-05-16 01:10:36', 'SYSTEM'),
(173, 4, 'B09112', 16, '2021-05-16 01:10:57', 'SYSTEM'),
(174, 5, 'B09112', 17, '2021-05-16 01:11:10', 'SYSTEM'),
(175, 5, 'B09112', 20, '2021-05-16 01:11:10', 'SYSTEM'),
(176, 3, 'B09112', 10, '2021-05-16 01:11:37', 'SYSTEM'),
(177, 3, 'B09112', 13, '2021-05-16 01:11:42', 'SYSTEM'),
(194, 1, 'B09109', 2, '2021-05-16 01:29:11', 'SYSTEM'),
(195, 1, 'B09109', 3, '2021-05-16 01:29:11', 'SYSTEM'),
(196, 2, 'B09109', 6, '2021-05-16 01:29:15', 'SYSTEM'),
(201, 3, 'B09107', 10, '2021-05-16 01:31:33', 'SYSTEM'),
(203, 1, 'B09105', 5, '2021-05-16 01:33:17', 'SYSTEM'),
(204, 3, 'B09105', 10, '2021-05-16 01:33:27', 'SYSTEM'),
(205, 3, 'B09105', 13, '2021-05-16 01:33:27', 'SYSTEM'),
(206, 4, 'B09105', 15, '2021-05-16 01:33:30', 'SYSTEM'),
(207, 5, 'B09105', 18, '2021-05-16 01:33:34', 'SYSTEM'),
(208, 5, 'B09105', 20, '2021-05-16 01:33:34', 'SYSTEM'),
(209, 4, 'B09105', 16, '2021-05-16 01:33:38', 'SYSTEM'),
(210, 1, 'B09104', 2, '2021-05-16 01:34:31', 'SYSTEM'),
(211, 2, 'B09104', 8, '2021-05-16 01:34:34', 'SYSTEM'),
(212, 3, 'B09104', 9, '2021-05-16 01:34:39', 'SYSTEM'),
(213, 3, 'B09104', 10, '2021-05-16 01:34:39', 'SYSTEM'),
(214, 3, 'B09104', 11, '2021-05-16 01:34:39', 'SYSTEM'),
(215, 3, 'B09104', 13, '2021-05-16 01:34:39', 'SYSTEM'),
(216, 4, 'B09104', 15, '2021-05-16 01:34:42', 'SYSTEM'),
(217, 5, 'B09104', 17, '2021-05-16 01:34:47', 'SYSTEM'),
(218, 5, 'B09104', 19, '2021-05-16 01:34:47', 'SYSTEM'),
(219, 5, 'B09104', 20, '2021-05-16 01:34:47', 'SYSTEM'),
(220, 1, 'B09102', 1, '2021-05-16 01:35:29', 'SYSTEM'),
(221, 1, 'B09102', 3, '2021-05-16 01:35:29', 'SYSTEM'),
(222, 1, 'B09102', 5, '2021-05-16 01:35:29', 'SYSTEM'),
(223, 2, 'B09102', 7, '2021-05-16 01:35:36', 'SYSTEM'),
(224, 3, 'B09102', 9, '2021-05-16 01:35:40', 'SYSTEM'),
(225, 3, 'B09102', 13, '2021-05-16 01:35:40', 'SYSTEM'),
(226, 4, 'B09102', 14, '2021-05-16 01:35:49', 'SYSTEM'),
(227, 4, 'B09102', 15, '2021-05-16 01:35:49', 'SYSTEM'),
(228, 4, 'B09102', 16, '2021-05-16 01:35:49', 'SYSTEM'),
(229, 5, 'B09102', 18, '2021-05-16 01:35:52', 'SYSTEM'),
(230, 2, 'B09107', 7, '2021-05-16 11:37:46', 'SYSTEM'),
(231, 4, 'B09109', 15, '2021-05-16 13:02:40', 'SYSTEM'),
(232, 4, 'B09109', 16, '2021-05-16 13:02:40', 'SYSTEM'),
(233, 1, 'B09107', 4, '2021-05-16 13:12:07', 'SYSTEM'),
(234, 4, 'B09107', 16, '2021-05-16 13:12:18', 'SYSTEM'),
(235, 5, 'B09107', 17, '2021-05-16 13:12:21', 'SYSTEM'),
(236, 5, 'B09107', 19, '2021-05-16 13:12:21', 'SYSTEM');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_r_note`
--

CREATE TABLE `tb_r_note` (
  `ID` int(11) NOT NULL,
  `ID_LIST` int(11) NOT NULL,
  `ID_BABP` varchar(10) NOT NULL,
  `NOTE` varchar(255) DEFAULT NULL,
  `CREATED_DT` datetime DEFAULT current_timestamp(),
  `CREATED_BY` varchar(20) DEFAULT 'SYSTEM'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_r_note`
--

INSERT INTO `tb_r_note` (`ID`, `ID_LIST`, `ID_BABP`, `NOTE`, `CREATED_DT`, `CREATED_BY`) VALUES
(71, 1, 'B09112', 'Catatan 1', '2021-05-16 01:09:50', 'SYSTEM'),
(72, 2, 'B09112', '', '2021-05-16 01:09:53', 'SYSTEM'),
(73, 3, 'B09112', 'Catatan 3', '2021-05-16 01:10:09', 'SYSTEM'),
(74, 4, 'B09112', '', '2021-05-16 01:10:19', 'SYSTEM'),
(75, 5, 'B09112', 'Catatan 5', '2021-05-16 01:10:25', 'SYSTEM'),
(78, 1, 'B09109', 'Catatan tambahan', '2021-05-16 01:29:11', 'SYSTEM'),
(79, 2, 'B09109', '', '2021-05-16 01:29:15', 'SYSTEM'),
(80, 1, 'B09107', '', '2021-05-16 01:31:11', 'SYSTEM'),
(81, 2, 'B09107', '', '2021-05-16 01:31:15', 'SYSTEM'),
(82, 3, 'B09107', '', '2021-05-16 01:31:33', 'SYSTEM'),
(83, 1, 'B09105', 'Catatan 1', '2021-05-16 01:33:17', 'SYSTEM'),
(84, 2, 'B09105', '', '2021-05-16 01:33:19', 'SYSTEM'),
(85, 3, 'B09105', 'Catatan 2', '2021-05-16 01:33:27', 'SYSTEM'),
(86, 4, 'B09105', '', '2021-05-16 01:33:30', 'SYSTEM'),
(87, 5, 'B09105', 'Catatan 3', '2021-05-16 01:33:34', 'SYSTEM'),
(88, 1, 'B09104', '', '2021-05-16 01:34:31', 'SYSTEM'),
(89, 2, 'B09104', '', '2021-05-16 01:34:34', 'SYSTEM'),
(90, 3, 'B09104', '', '2021-05-16 01:34:39', 'SYSTEM'),
(91, 4, 'B09104', '', '2021-05-16 01:34:42', 'SYSTEM'),
(92, 5, 'B09104', '', '2021-05-16 01:34:47', 'SYSTEM'),
(93, 1, 'B09102', '', '2021-05-16 01:35:29', 'SYSTEM'),
(94, 2, 'B09102', 'Catatan 1', '2021-05-16 01:35:36', 'SYSTEM'),
(95, 3, 'B09102', '', '2021-05-16 01:35:40', 'SYSTEM'),
(96, 4, 'B09102', 'Catatan 2', '2021-05-16 01:35:49', 'SYSTEM'),
(97, 5, 'B09102', '', '2021-05-16 01:35:52', 'SYSTEM'),
(98, 3, 'B09109', '', '2021-05-16 13:02:36', 'SYSTEM'),
(99, 4, 'B09109', '', '2021-05-16 13:02:39', 'SYSTEM'),
(100, 4, 'B09107', '', '2021-05-16 13:12:18', 'SYSTEM'),
(101, 5, 'B09107', '', '2021-05-16 13:12:21', 'SYSTEM');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_r_token`
--

CREATE TABLE `tb_r_token` (
  `id_token` int(100) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `access_token` text DEFAULT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_m_list`
--
ALTER TABLE `tb_m_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `tb_m_sublist`
--
ALTER TABLE `tb_m_sublist`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_TB_M_SUBLIST_ID_LIST` (`ID_LIST`);

--
-- Indeks untuk tabel `tb_m_user`
--
ALTER TABLE `tb_m_user`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `tb_r_babp`
--
ALTER TABLE `tb_r_babp`
  ADD PRIMARY KEY (`NO_BABP`);

--
-- Indeks untuk tabel `tb_r_checklist`
--
ALTER TABLE `tb_r_checklist`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_SUBLIST` (`ID_SUBLIST`),
  ADD KEY `fk_tb_r_checklist_id_babp` (`ID_BABP`),
  ADD KEY `fk_tb_r_checklist_id_list` (`ID_LIST`);

--
-- Indeks untuk tabel `tb_r_note`
--
ALTER TABLE `tb_r_note`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_tb_r_note_id_babp` (`ID_BABP`),
  ADD KEY `fk_tb_r_note_id_list` (`ID_LIST`);

--
-- Indeks untuk tabel `tb_r_token`
--
ALTER TABLE `tb_r_token`
  ADD PRIMARY KEY (`id_token`),
  ADD KEY `fk_tb_r_toke_user_id` (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_m_list`
--
ALTER TABLE `tb_m_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_m_sublist`
--
ALTER TABLE `tb_m_sublist`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_m_user`
--
ALTER TABLE `tb_m_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_r_checklist`
--
ALTER TABLE `tb_r_checklist`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT untuk tabel `tb_r_note`
--
ALTER TABLE `tb_r_note`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT untuk tabel `tb_r_token`
--
ALTER TABLE `tb_r_token`
  MODIFY `id_token` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_m_sublist`
--
ALTER TABLE `tb_m_sublist`
  ADD CONSTRAINT `FK_TB_M_SUBLIST_ID_LIST` FOREIGN KEY (`ID_LIST`) REFERENCES `tb_m_list` (`ID`);

--
-- Ketidakleluasaan untuk tabel `tb_r_checklist`
--
ALTER TABLE `tb_r_checklist`
  ADD CONSTRAINT `fk_tb_r_checklist_id_babp` FOREIGN KEY (`ID_BABP`) REFERENCES `tb_r_babp` (`NO_BABP`),
  ADD CONSTRAINT `fk_tb_r_checklist_id_list` FOREIGN KEY (`ID_LIST`) REFERENCES `tb_m_list` (`ID`),
  ADD CONSTRAINT `tb_r_checklist_ibfk_1` FOREIGN KEY (`ID_SUBLIST`) REFERENCES `tb_m_sublist` (`ID`);

--
-- Ketidakleluasaan untuk tabel `tb_r_note`
--
ALTER TABLE `tb_r_note`
  ADD CONSTRAINT `fk_tb_r_note_id_babp` FOREIGN KEY (`ID_BABP`) REFERENCES `tb_r_babp` (`NO_BABP`),
  ADD CONSTRAINT `fk_tb_r_note_id_list` FOREIGN KEY (`ID_LIST`) REFERENCES `tb_m_list` (`ID`);

--
-- Ketidakleluasaan untuk tabel `tb_r_token`
--
ALTER TABLE `tb_r_token`
  ADD CONSTRAINT `fk_tb_r_toke_user_id` FOREIGN KEY (`user_id`) REFERENCES `tb_m_user` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
