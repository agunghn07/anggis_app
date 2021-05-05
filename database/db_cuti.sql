-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Sep 2020 pada 16.22
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
('DHM', 'Divisi Hubungan Masyarakat', '2020-08-23 20:05:07', 'Admin', NULL, NULL),
('DI', 'Divisi Investasi', '2020-07-23 19:27:19', 'Admin', NULL, NULL),
('DK', 'Divisi Kepegawaian', '2020-07-27 12:36:21', 'Admin', '2020-08-24 07:51:07', 'Admin'),
('DKPP', 'Divisi Kepesertaan dan Pelayanan Pensiun', '2020-07-23 19:27:19', 'Admin', '2020-07-27 10:02:58', 'Admin'),
('DKU', 'Divisi Keuangan', '2020-08-29 17:06:29', 'Admin', NULL, NULL),
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
(1, 'Administrator', 'AD', '2020-07-23 19:22:59', 'Admin', '2020-08-29 05:20:50', 'Admin'),
(2, 'Manager', 'G3', '2020-07-23 19:22:59', 'Admin', '2020-08-24 07:53:29', 'Admin'),
(3, 'Supervisor', 'G2', '2020-07-23 19:22:59', 'Admin', '2020-08-24 11:57:56', 'Admin'),
(4, 'Staff', 'G1', '2020-07-23 19:22:59', 'Admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_m_read_status`
--

CREATE TABLE `tb_m_read_status` (
  `ID` int(11) NOT NULL,
  `DESCRIPTION` varchar(20) DEFAULT NULL,
  `CREATED_DT` datetime DEFAULT current_timestamp(),
  `CREATED_BY` varchar(10) DEFAULT 'Admin',
  `UPDATED_DT` datetime DEFAULT NULL,
  `UPDATED_BY` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_m_read_status`
--

INSERT INTO `tb_m_read_status` (`ID`, `DESCRIPTION`, `CREATED_DT`, `CREATED_BY`, `UPDATED_DT`, `UPDATED_BY`) VALUES
(0, 'Belum dibaca', '2020-07-31 21:10:35', 'Admin', NULL, NULL),
(1, 'Sudah dibaca', '2020-07-31 21:10:35', 'Admin', NULL, NULL);

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
-- Struktur dari tabel `tb_r_email`
--

CREATE TABLE `tb_r_email` (
  `ID` int(11) NOT NULL,
  `SENDER` varchar(20) DEFAULT NULL,
  `RECEIVER` varchar(20) DEFAULT NULL,
  `ID_CUTI` int(11) DEFAULT NULL,
  `SUBJECT` varchar(150) DEFAULT NULL,
  `MESSAGE` mediumtext DEFAULT NULL,
  `RECEIVE_DT` datetime DEFAULT current_timestamp(),
  `READ_STATUS` int(11) DEFAULT NULL,
  `CREATED_DT` datetime DEFAULT current_timestamp(),
  `CREATED_BY` varchar(50) DEFAULT NULL,
  `UPDATED_DT` datetime DEFAULT NULL,
  `UPDATED_BY` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_r_email`
--

INSERT INTO `tb_r_email` (`ID`, `SENDER`, `RECEIVER`, `ID_CUTI`, `SUBJECT`, `MESSAGE`, `RECEIVE_DT`, `READ_STATUS`, `CREATED_DT`, `CREATED_BY`, `UPDATED_DT`, `UPDATED_BY`) VALUES
(1, 'Emp/DUTI/9', 'Emp/DUTI/2', 1, 'Surat pengajuan cuti nomor : Emp/DUTI/9/20-1', '<!DOCTYPE html\r\n    PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n\r\n<head>\r\n    <meta name=\"viewport\" content=\"width=device-width\" />\r\n    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />\r\n    <title>Surat Elektronik Emp/DUTI/9/20-1</title>\r\n    <style>\r\n\r\n        /* make sure all tables have defaults */\r\n        table td {\r\n            vertical-align: top;\r\n        }\r\n\r\n        .body-wrap-email {\r\n            background-color: #f6f6f6;\r\n            width: 100%;\r\n        }\r\n\r\n        .container-email {\r\n            display: block !important;\r\n            max-width: 600px !important;\r\n            margin: 0 auto !important;\r\n            clear: both !important;\r\n        }\r\n\r\n        .content-email {\r\n            font-family: \"Helvetica Neue\", \"Helvetica\", Helvetica, Arial, sans-serif;\r\n            font-size: 13px;\r\n            max-width: 600px;\r\n            margin: 0 auto;\r\n            display: block;\r\n            padding: 20px;\r\n        }\r\n\r\n        .main-email {\r\n            background: #fff;\r\n            border: 1px solid #e9e9e9;\r\n            border-radius: 3px;\r\n        }\r\n\r\n        .content-wrap-email {\r\n            padding: 20px;\r\n        }\r\n\r\n        .content-block-email {\r\n            padding: 0 0 20px;\r\n        }\r\n\r\n        .btn-primary-email {\r\n            text-decoration: none;\r\n            color: #FFF !important;\r\n            background-color: #1ab394;\r\n            border: solid #1ab394;\r\n            border-width: 5px 10px;\r\n            line-height: 2;\r\n            font-weight: bold;\r\n            text-align: center;\r\n            cursor: pointer;\r\n            display: inline-block;\r\n            border-radius: 5px;\r\n            text-transform: capitalize;\r\n        }\r\n\r\n        .alert-email {\r\n            font-size: 16px;\r\n            color: #fff;\r\n            font-weight: 500;\r\n            padding: 20px;\r\n            text-align: center;\r\n            border-radius: 3px 3px 0 0;\r\n        }\r\n\r\n        .alert-email.alert-good-email {\r\n            font-family: \"Helvetica Neue\", \"Helvetica\", Helvetica, Arial, sans-serif;\r\n            font-size: 16px;\r\n            background: #1ab394;\r\n        }\r\n\r\n        /* RESPONSIVE AND MOBILE FRIENDLY STYLES*/\r\n        @media only screen and (max-width: 640px) {\r\n            #templateSurel h1, #templateSurel h2, #templateSurel h3, #templateSurel h4 {\r\n                font-weight: 600 !important;\r\n                margin: 20px 0 5px !important;\r\n            }\r\n\r\n            #templateSurel h1 {\r\n                font-size: 22px !important;\r\n            }\r\n\r\n            #templateSurel h2 {\r\n                font-size: 18px !important;\r\n            }\r\n\r\n            #templateSurel h3 {\r\n                font-size: 16px !important;\r\n            }\r\n\r\n            .container-email {\r\n                width: 100% !important;\r\n            }\r\n\r\n            .content-email, .content-wrap-email {\r\n                padding: 10px !important;\r\n            }\r\n        }\r\n\r\n    </style>\r\n</head>\r\n\r\n<body>\r\n\r\n    <table class=\"body-wrap-email\">\r\n        <tr>\r\n            <td></td>\r\n            <td class=\"container-email\" width=\"600\">\r\n                <div class=\"content-email\">\r\n                    <table class=\"main-email\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\r\n                        <tr>\r\n                            <td class=\"alert-email alert-good-email\">\r\n                            Surel Pengajuan Cuti Dengan Nomor Registrasi : Emp/DUTI/9/20-1                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td class=\"content-wrap-email\">\r\n                                <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\r\n                                    <tr>\r\n                                        <td class=\"content-block-email\">\r\n                                            Kepada <br>\r\n                                            Yth. Bapak/Ibu Supervisor<br>\r\n                                            <span>Divisi Umum dan Teknologi Informasi</span>\r\n                                        </td>\r\n                                    </tr>\r\n                                    <tr>\r\n                                        <td class=\"content-block-email\">\r\n                                            Dengan hormat, \r\n                                        </td>\r\n                                    </tr>\r\n                                    <tr>\r\n                                        <td class=\"content-block-email\">\r\n                                            Saya dengan keterangan sebagai berikut :\r\n                                        </td>\r\n                                    </tr>\r\n                                    <tr>\r\n                                        <td class=\"content-block-email\">\r\n                                            <table>\r\n                                                <tr>\r\n                                                    <td>Nama</td>\r\n                                                    <td>&emsp; :</td>\r\n                                                    <td>&nbsp; Ahmad Dzilal Haq</td>\r\n                                                </tr>\r\n                                                <tr>\r\n                                                    <td>Nomor Registrasi</td>\r\n                                                    <td>&emsp; :</td>\r\n                                                    <td>&nbsp; Emp/DUTI/9</td> \r\n                                                </tr>\r\n                                                <tr>\r\n                                                    <td>Posisi</td>\r\n                                                    <td>&emsp; :</td>\r\n                                                    <td>&nbsp; Staff</td>  \r\n                                                </tr>\r\n                                                <tr>\r\n                                                    <td>Divisi Karyawan</td>\r\n                                                    <td>&emsp; :</td>\r\n                                                    <td>&nbsp; Divisi Umum dan Teknologi Informasi</td>  \r\n                                                </tr>\r\n                                            </table>\r\n                                        </td>\r\n                                    </tr>\r\n                                    <tr>\r\n                                        <td class=\"content-block-email\">\r\n                                            Hendak melakukan pengajuan cuti dari tanggal 08 Sep 2020 \r\n                                            sampai tanggal 09 Sep 2020 dengan alasan : \r\n                                            <span style=\"font-style: italic;\"><strong>\"Test cuti staff DUTI Ahmad Dzilal Haq\"</strong>.</span>\r\n                                        </td>\r\n                                    </tr>\r\n                                    <tr>\r\n                                        <td class=\"content-block-email\">\r\n                                            Demikian surat elektronik ini dibuat, semoga Bapak/Ibu berkenan memberikan izin atas cuti saya. \r\n                                            Atas perhatiannya, saya ucapkan terima kasih.\r\n                                        </td>\r\n                                    </tr>\r\n                                    <tr>\r\n                                        <td class=\"content-block-email\">\r\n                                            <a href=\"http://localhost/cuti_app/NotifikasiSurel\" data-picposition=\"3\" data-nomorcuti=\"Emp/DUTI/9/20-1\" class=\"btn-primary-email\">Proses surat ini</a>\r\n                                        </td>\r\n                                    </tr>\r\n                                </table>\r\n                            </td>\r\n                        </tr>\r\n                    </table>\r\n                </div>\r\n            </td>\r\n            <td></td>\r\n        </tr>\r\n    </table>\r\n\r\n</body>\r\n\r\n</html>', '2020-09-01 13:58:38', 1, '2020-09-01 13:58:38', 'Ahmad Dzilal Haq', '2020-09-01 13:59:50', 'Agung'),
(2, 'Emp/DUTI/2', 'Emp/DUTI/3', 1, 'Surat pengajuan cuti nomor : Emp/DUTI/9/20-1', '<!DOCTYPE html\r\n    PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n\r\n<head>\r\n    <meta name=\"viewport\" content=\"width=device-width\" />\r\n    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />\r\n    <title>Surat Elektronik Emp/DUTI/9/20-1</title>\r\n    <style>\r\n\r\n        /* make sure all tables have defaults */\r\n        table td {\r\n            vertical-align: top;\r\n        }\r\n\r\n        .body-wrap-email {\r\n            background-color: #f6f6f6;\r\n            width: 100%;\r\n        }\r\n\r\n        .container-email {\r\n            display: block !important;\r\n            max-width: 600px !important;\r\n            margin: 0 auto !important;\r\n            clear: both !important;\r\n        }\r\n\r\n        .content-email {\r\n            font-family: \"Helvetica Neue\", \"Helvetica\", Helvetica, Arial, sans-serif;\r\n            font-size: 13px;\r\n            max-width: 600px;\r\n            margin: 0 auto;\r\n            display: block;\r\n            padding: 20px;\r\n        }\r\n\r\n        .main-email {\r\n            background: #fff;\r\n            border: 1px solid #e9e9e9;\r\n            border-radius: 3px;\r\n        }\r\n\r\n        .content-wrap-email {\r\n            padding: 20px;\r\n        }\r\n\r\n        .content-block-email {\r\n            padding: 0 0 20px;\r\n        }\r\n\r\n        .btn-primary-email {\r\n            text-decoration: none;\r\n            color: #FFF !important;\r\n            background-color: #1ab394;\r\n            border: solid #1ab394;\r\n            border-width: 5px 10px;\r\n            line-height: 2;\r\n            font-weight: bold;\r\n            text-align: center;\r\n            cursor: pointer;\r\n            display: inline-block;\r\n            border-radius: 5px;\r\n            text-transform: capitalize;\r\n        }\r\n\r\n        .alert-email {\r\n            font-size: 16px;\r\n            color: #fff;\r\n            font-weight: 500;\r\n            padding: 20px;\r\n            text-align: center;\r\n            border-radius: 3px 3px 0 0;\r\n        }\r\n\r\n        .alert-email.alert-good-email {\r\n            font-family: \"Helvetica Neue\", \"Helvetica\", Helvetica, Arial, sans-serif;\r\n            font-size: 16px;\r\n            background: #1ab394;\r\n        }\r\n\r\n        /* RESPONSIVE AND MOBILE FRIENDLY STYLES*/\r\n        @media only screen and (max-width: 640px) {\r\n            #templateSurel h1, #templateSurel h2, #templateSurel h3, #templateSurel h4 {\r\n                font-weight: 600 !important;\r\n                margin: 20px 0 5px !important;\r\n            }\r\n\r\n            #templateSurel h1 {\r\n                font-size: 22px !important;\r\n            }\r\n\r\n            #templateSurel h2 {\r\n                font-size: 18px !important;\r\n            }\r\n\r\n            #templateSurel h3 {\r\n                font-size: 16px !important;\r\n            }\r\n\r\n            .container-email {\r\n                width: 100% !important;\r\n            }\r\n\r\n            .content-email, .content-wrap-email {\r\n                padding: 10px !important;\r\n            }\r\n        }\r\n\r\n    </style>\r\n</head>\r\n\r\n<body>\r\n\r\n    <table class=\"body-wrap-email\">\r\n        <tr>\r\n            <td></td>\r\n            <td class=\"container-email\" width=\"600\">\r\n                <div class=\"content-email\">\r\n                    <table class=\"main-email\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\r\n                        <tr>\r\n                            <td class=\"alert-email alert-good-email\">\r\n                            Surel Pengajuan Cuti Dengan Nomor Registrasi : Emp/DUTI/9/20-1                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td class=\"content-wrap-email\">\r\n                                <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\r\n                                    <tr>\r\n                                        <td class=\"content-block-email\">\r\n                                            Kepada <br>\r\n                                            Yth. Bapak/Ibu Manager<br>\r\n                                            <span>Divisi Umum dan Teknologi Informasi</span>\r\n                                        </td>\r\n                                    </tr>\r\n                                    <tr>\r\n                                        <td class=\"content-block-email\">\r\n                                            Dengan hormat, \r\n                                        </td>\r\n                                    </tr>\r\n                                    <tr>\r\n                                        <td class=\"content-block-email\">\r\n                                            Saya dengan keterangan sebagai berikut :\r\n                                        </td>\r\n                                    </tr>\r\n                                    <tr>\r\n                                        <td class=\"content-block-email\">\r\n                                            <table>\r\n                                                <tr>\r\n                                                    <td>Nama</td>\r\n                                                    <td>&emsp; :</td>\r\n                                                    <td>&nbsp; Ahmad Dzilal Haq</td>\r\n                                                </tr>\r\n                                                <tr>\r\n                                                    <td>Nomor Registrasi</td>\r\n                                                    <td>&emsp; :</td>\r\n                                                    <td>&nbsp; Emp/DUTI/9</td> \r\n                                                </tr>\r\n                                                <tr>\r\n                                                    <td>Posisi</td>\r\n                                                    <td>&emsp; :</td>\r\n                                                    <td>&nbsp; Staff</td>  \r\n                                                </tr>\r\n                                                <tr>\r\n                                                    <td>Divisi Karyawan</td>\r\n                                                    <td>&emsp; :</td>\r\n                                                    <td>&nbsp; Divisi Umum dan Teknologi Informasi</td>  \r\n                                                </tr>\r\n                                            </table>\r\n                                        </td>\r\n                                    </tr>\r\n                                    <tr>\r\n                                        <td class=\"content-block-email\">\r\n                                            Hendak melakukan pengajuan cuti dari tanggal 08 Sep 2020 \r\n                                            sampai tanggal 09 Sep 2020 dengan alasan : \r\n                                            <span style=\"font-style: italic;\"><strong>\"Test cuti staff DUTI Ahmad Dzilal Haq\"</strong>.</span>\r\n                                        </td>\r\n                                    </tr>\r\n                                    <tr>\r\n                                        <td class=\"content-block-email\">\r\n                                            Demikian surat elektronik ini dibuat, semoga Bapak/Ibu berkenan memberikan izin atas cuti saya. \r\n                                            Atas perhatiannya, saya ucapkan terima kasih.\r\n                                        </td>\r\n                                    </tr>\r\n                                    <tr>\r\n                                        <td class=\"content-block-email\">\r\n                                            <a href=\"http://localhost/cuti_app/NotifikasiSurel\" data-picposition=\"3\" data-nomorcuti=\"Emp/DUTI/9/20-1\" class=\"btn-primary-email\">Proses surat ini</a>\r\n                                        </td>\r\n                                    </tr>\r\n                                </table>\r\n                            </td>\r\n                        </tr>\r\n                    </table>\r\n                </div>\r\n            </td>\r\n            <td></td>\r\n        </tr>\r\n    </table>\r\n\r\n</body>\r\n\r\n</html>', '2020-09-01 14:00:20', 1, '2020-09-01 14:00:20', 'Agung Hermawan', '2020-09-01 14:00:46', 'Pangestu'),
(3, 'Emp/DUTI/3', 'Emp/DK/1', 1, 'Surat pengajuan cuti nomor : Emp/DUTI/9/20-1', '<!DOCTYPE html\r\n    PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n\r\n<head>\r\n    <meta name=\"viewport\" content=\"width=device-width\" />\r\n    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />\r\n    <title>Surat Elektronik Emp/DUTI/9/20-1</title>\r\n    <style>\r\n\r\n        /* make sure all tables have defaults */\r\n        table td {\r\n            vertical-align: top;\r\n        }\r\n\r\n        .body-wrap-email {\r\n            background-color: #f6f6f6;\r\n            width: 100%;\r\n        }\r\n\r\n        .container-email {\r\n            display: block !important;\r\n            max-width: 600px !important;\r\n            margin: 0 auto !important;\r\n            clear: both !important;\r\n        }\r\n\r\n        .content-email {\r\n            font-family: \"Helvetica Neue\", \"Helvetica\", Helvetica, Arial, sans-serif;\r\n            font-size: 13px;\r\n            max-width: 600px;\r\n            margin: 0 auto;\r\n            display: block;\r\n            padding: 20px;\r\n        }\r\n\r\n        .main-email {\r\n            background: #fff;\r\n            border: 1px solid #e9e9e9;\r\n            border-radius: 3px;\r\n        }\r\n\r\n        .content-wrap-email {\r\n            padding: 20px;\r\n        }\r\n\r\n        .content-block-email {\r\n            padding: 0 0 20px;\r\n        }\r\n\r\n        .btn-primary-email {\r\n            text-decoration: none;\r\n            color: #FFF !important;\r\n            background-color: #1ab394;\r\n            border: solid #1ab394;\r\n            border-width: 5px 10px;\r\n            line-height: 2;\r\n            font-weight: bold;\r\n            text-align: center;\r\n            cursor: pointer;\r\n            display: inline-block;\r\n            border-radius: 5px;\r\n            text-transform: capitalize;\r\n        }\r\n\r\n        .alert-email {\r\n            font-size: 16px;\r\n            color: #fff;\r\n            font-weight: 500;\r\n            padding: 20px;\r\n            text-align: center;\r\n            border-radius: 3px 3px 0 0;\r\n        }\r\n\r\n        .alert-email.alert-good-email {\r\n            font-family: \"Helvetica Neue\", \"Helvetica\", Helvetica, Arial, sans-serif;\r\n            font-size: 16px;\r\n            background: #1ab394;\r\n        }\r\n\r\n        /* RESPONSIVE AND MOBILE FRIENDLY STYLES*/\r\n        @media only screen and (max-width: 640px) {\r\n            #templateSurel h1, #templateSurel h2, #templateSurel h3, #templateSurel h4 {\r\n                font-weight: 600 !important;\r\n                margin: 20px 0 5px !important;\r\n            }\r\n\r\n            #templateSurel h1 {\r\n                font-size: 22px !important;\r\n            }\r\n\r\n            #templateSurel h2 {\r\n                font-size: 18px !important;\r\n            }\r\n\r\n            #templateSurel h3 {\r\n                font-size: 16px !important;\r\n            }\r\n\r\n            .container-email {\r\n                width: 100% !important;\r\n            }\r\n\r\n            .content-email, .content-wrap-email {\r\n                padding: 10px !important;\r\n            }\r\n        }\r\n\r\n    </style>\r\n</head>\r\n\r\n<body>\r\n\r\n    <table class=\"body-wrap-email\">\r\n        <tr>\r\n            <td></td>\r\n            <td class=\"container-email\" width=\"600\">\r\n                <div class=\"content-email\">\r\n                    <table class=\"main-email\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\r\n                        <tr>\r\n                            <td class=\"alert-email alert-good-email\">\r\n                            Surel Pengajuan Cuti Dengan Nomor Registrasi : Emp/DUTI/9/20-1                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td class=\"content-wrap-email\">\r\n                                <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\r\n                                    <tr>\r\n                                        <td class=\"content-block-email\">\r\n                                            Kepada <br>\r\n                                            Yth. Bapak/Ibu Manager<br>\r\n                                            <span>Divisi Kepegawaian</span>\r\n                                        </td>\r\n                                    </tr>\r\n                                    <tr>\r\n                                        <td class=\"content-block-email\">\r\n                                            Dengan hormat, \r\n                                        </td>\r\n                                    </tr>\r\n                                    <tr>\r\n                                        <td class=\"content-block-email\">\r\n                                            Saya dengan keterangan sebagai berikut :\r\n                                        </td>\r\n                                    </tr>\r\n                                    <tr>\r\n                                        <td class=\"content-block-email\">\r\n                                            <table>\r\n                                                <tr>\r\n                                                    <td>Nama</td>\r\n                                                    <td>&emsp; :</td>\r\n                                                    <td>&nbsp; Ahmad Dzilal Haq</td>\r\n                                                </tr>\r\n                                                <tr>\r\n                                                    <td>Nomor Registrasi</td>\r\n                                                    <td>&emsp; :</td>\r\n                                                    <td>&nbsp; Emp/DUTI/9</td> \r\n                                                </tr>\r\n                                                <tr>\r\n                                                    <td>Posisi</td>\r\n                                                    <td>&emsp; :</td>\r\n                                                    <td>&nbsp; Staff</td>  \r\n                                                </tr>\r\n                                                <tr>\r\n                                                    <td>Divisi Karyawan</td>\r\n                                                    <td>&emsp; :</td>\r\n                                                    <td>&nbsp; Divisi Umum dan Teknologi Informasi</td>  \r\n                                                </tr>\r\n                                            </table>\r\n                                        </td>\r\n                                    </tr>\r\n                                    <tr>\r\n                                        <td class=\"content-block-email\">\r\n                                            Hendak melakukan pengajuan cuti dari tanggal 08 Sep 2020 \r\n                                            sampai tanggal 09 Sep 2020 dengan alasan : \r\n                                            <span style=\"font-style: italic;\"><strong>\"Test cuti staff DUTI Ahmad Dzilal Haq\"</strong>.</span>\r\n                                        </td>\r\n                                    </tr>\r\n                                    <tr>\r\n                                        <td class=\"content-block-email\">\r\n                                            Demikian surat elektronik ini dibuat, semoga Bapak/Ibu berkenan memberikan izin atas cuti saya. \r\n                                            Atas perhatiannya, saya ucapkan terima kasih.\r\n                                        </td>\r\n                                    </tr>\r\n                                    <tr>\r\n                                        <td class=\"content-block-email\">\r\n                                            <a href=\"http://localhost/cuti_app/NotifikasiSurel\" data-picposition=\"3\" data-nomorcuti=\"Emp/DUTI/9/20-1\" class=\"btn-primary-email\">Proses surat ini</a>\r\n                                        </td>\r\n                                    </tr>\r\n                                </table>\r\n                            </td>\r\n                        </tr>\r\n                    </table>\r\n                </div>\r\n            </td>\r\n            <td></td>\r\n        </tr>\r\n    </table>\r\n\r\n</body>\r\n\r\n</html>', '2020-09-01 14:01:41', 1, '2020-09-01 14:01:41', 'Aji Pangestu', '2020-09-01 14:03:09', 'Reddy'),
(4, 'Emp/DK/1', 'Emp/DUTI/9', 1, 'Surat penerimaan cuti nomor : Emp/DUTI/9/20-1', '<!DOCTYPE html\r\n    PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n\r\n<head>\r\n    <meta name=\"viewport\" content=\"width=device-width\" />\r\n    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />\r\n    <style>\r\n\r\n        /* make sure all tables have defaults */\r\n        table td {\r\n            vertical-align: top;\r\n        }\r\n\r\n        .body-wrap-email {\r\n            background-color: #f6f6f6;\r\n            width: 100%;\r\n        }\r\n\r\n        .container-email {\r\n            display: block !important;\r\n            max-width: 600px !important;\r\n            margin: 0 auto !important;\r\n            clear: both !important;\r\n        }\r\n\r\n        .content-email {\r\n            font-family: \"Helvetica Neue\", \"Helvetica\", Helvetica, Arial, sans-serif;\r\n            font-size: 13px;\r\n            max-width: 600px;\r\n            margin: 0 auto;\r\n            display: block;\r\n            padding: 20px;\r\n        }\r\n\r\n        .main-email {\r\n            background: #fff;\r\n            border: 1px solid #e9e9e9;\r\n            border-radius: 3px;\r\n        }\r\n\r\n        .content-wrap-email {\r\n            padding: 20px;\r\n        }\r\n\r\n        .content-block-email {\r\n            padding: 0 0 20px;\r\n        }\r\n\r\n        .btn-primary-email {\r\n            text-decoration: none;\r\n            color: #FFF !important;\r\n            background-color: #1ab394;\r\n            border: solid #1ab394;\r\n            border-width: 5px 10px;\r\n            line-height: 2;\r\n            font-weight: bold;\r\n            text-align: center;\r\n            cursor: pointer;\r\n            display: inline-block;\r\n            border-radius: 5px;\r\n            text-transform: capitalize;\r\n        }\r\n\r\n        .alert-email {\r\n            font-size: 16px;\r\n            color: #fff;\r\n            font-weight: 500;\r\n            padding: 20px;\r\n            text-align: center;\r\n            border-radius: 3px 3px 0 0;\r\n        }\r\n\r\n        .alert-email.alert-good-email {\r\n            font-family: \"Helvetica Neue\", \"Helvetica\", Helvetica, Arial, sans-serif;\r\n            font-size: 16px;\r\n            background: #1ab394;\r\n        }\r\n\r\n        /* RESPONSIVE AND MOBILE FRIENDLY STYLES*/\r\n        @media only screen and (max-width: 640px) {\r\n            #templateSurel h1, #templateSurel h2, #templateSurel h3, #templateSurel h4 {\r\n                font-weight: 600 !important;\r\n                margin: 20px 0 5px !important;\r\n            }\r\n\r\n            #templateSurel h1 {\r\n                font-size: 22px !important;\r\n            }\r\n\r\n            #templateSurel h2 {\r\n                font-size: 18px !important;\r\n            }\r\n\r\n            #templateSurel h3 {\r\n                font-size: 16px !important;\r\n            }\r\n\r\n            .container-email {\r\n                width: 100% !important;\r\n            }\r\n\r\n            .content-email, .content-wrap-email {\r\n                padding: 10px !important;\r\n            }\r\n        }\r\n\r\n    </style>\r\n</head>\r\n\r\n<body>\r\n\r\n    <table class=\"body-wrap-email\">\r\n        <tr>\r\n            <td></td>\r\n            <td class=\"container-email\" width=\"600\">\r\n                <div class=\"content-email\">\r\n                    <table class=\"main-email\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\r\n                        <tr>\r\n                            <td class=\"alert-email alert-good-email\">\r\n                            Surel Penerimaan Cuti Dengan Nomor Registrasi : Emp/DUTI/9/20-1                            </td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td class=\"content-wrap-email\">\r\n                                <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\r\n                                    <tr>\r\n                                        <td class=\"content-block-email\">\r\n                                            Kepada <br>\r\n                                            Yth. Saudara Ahmad Dzilal Haq<br>\r\n                                            Divisi Umum dan Teknologi Informasi                                        </td>\r\n                                    </tr>\r\n                                    <tr>\r\n                                        <td class=\"content-block-email\">\r\n                                            Sehubungan dengan surat pengajuan cuti yang anda ajukan pada tanggal 01 Sep 2020                                        </td>\r\n                                    </tr>\r\n									<tr>\r\n                                        <td class=\"content-block-email\">\r\n                                            Dengan ini kami sampaikan bahwa surat pengajuan cuti anda sudah kami <strong>Approve</strong>. \r\n                                            Anda kami persilahan untuk cuti pada tanggal 08 Sep 2020 - 09 Sep 2020 \r\n                                            dan mulai masuk kerja kembali pada tanggal 10 Sep 2020                                        </td>\r\n                                    </tr>\r\n                                    \r\n                                    <tr>\r\n                                        <td class=\"content-block-email\">\r\n                                            Demikian surat elektronik ini kami sampaikan, semoga saudara berkenan dapat menerima pesan ini dengan baik dan bijak.\r\n											Terima kasih\r\n                                        </td>\r\n                                    </tr>\r\n                                    <tr style=\"text-align: right\">\r\n                                        <td class=\"content-block-email\">\r\n                                            Reddy Orlan Ibrahim                                        </td>\r\n                                    </tr>\r\n									<tr style=\"text-align: right\">\r\n                                        <td class=\"content-block-email\">\r\n                                            <br>Manager<br><span>Divisi Kepegawaian</span>\r\n                                        </td>\r\n                                    </tr>\r\n                                </table>\r\n                            </td>\r\n                        </tr>\r\n                    </table>\r\n                </div>\r\n            </td>\r\n            <td></td>\r\n        </tr>\r\n    </table>\r\n\r\n</body>\r\n\r\n</html>', '2020-09-01 14:03:07', 1, '2020-09-01 14:03:07', 'Reddy Orlan Ibrahim', '2020-09-01 14:03:49', 'Dzilal');

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
  `SIGNATURE` varchar(40) DEFAULT NULL,
  `PIC` varchar(20) DEFAULT NULL,
  `CREATED_DT` datetime DEFAULT current_timestamp(),
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `UPDATED_DT` datetime DEFAULT NULL,
  `UPDATED_BY` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_r_employee`
--

INSERT INTO `tb_r_employee` (`NOREG`, `NAME`, `USERNAME`, `EMAIL`, `SEX`, `POSITION`, `DIVISION`, `PHOTO`, `SIGNATURE`, `PIC`, `CREATED_DT`, `CREATED_BY`, `UPDATED_DT`, `UPDATED_BY`) VALUES
('Adm/DUTI/1', 'Administator', 'Admin', NULL, 'M', 1, 'DUTI', 'noimage.png', NULL, NULL, '2020-07-23 20:03:32', 'Admin', '2020-08-24 11:54:59', 'Admin'),
('Emp/DHM/1', 'Teguh Imam Permana', 'Teguh', NULL, 'M', 2, 'DHM', 'noimage.png', 'Teguh.svg', NULL, '2020-08-23 20:47:24', NULL, '2020-08-24 07:56:21', 'Teguh'),
('Emp/DHM/2', 'Yogi Wahyu Romadhon', 'Yogi', NULL, 'M', 3, 'DHM', 'noimage.png', 'Yogi.svg', 'Emp/DHM/1', '2020-08-24 10:55:44', NULL, '2020-08-24 08:02:53', 'Yogi'),
('Emp/DHM/3', 'Almer Sesunan', 'Almer', NULL, 'M', 4, 'DHM', 'noimage.png', 'Almer.svg', 'Emp/DHM/2', '2020-08-24 11:32:06', NULL, NULL, NULL),
('Emp/DHM/4', 'Anas Apiyudin', 'Anas', NULL, 'M', 4, 'DHM', 'noimage.png', 'Anas.svg', 'Emp/DHM/2', '2020-08-24 11:51:38', NULL, '2020-08-24 08:03:22', 'Anas'),
('Emp/DHM/5', 'Dena Purnama', 'Dena', NULL, 'M', 3, 'DHM', 'noimage.png', 'Dena.svg', 'Emp/DHM/1', '2020-08-24 16:27:49', NULL, NULL, NULL),
('Emp/DHM/6', 'Ismi Nurhasanah', 'Ismi', NULL, 'F', 4, 'DHM', 'noimage.png', 'Ismi.svg', 'Emp/DHM/5', '2020-08-24 21:24:57', NULL, NULL, NULL),
('Emp/DI/1', 'Rani Kuniawati', 'Rani', NULL, 'F', 2, 'DI', 'noimage.png', NULL, NULL, '2020-07-23 20:39:04', 'Admin', NULL, NULL),
('Emp/DI/2', 'Madada Nurkholida', 'Madada', NULL, 'F', 4, 'DI', 'noimage.png', NULL, 'Emp/DI/3', '2020-07-28 10:13:15', NULL, '2020-08-08 04:37:11', 'Admin'),
('Emp/DI/3', 'Tia Khairina', 'Tia', NULL, 'F', 3, 'DI', 'noimage.png', NULL, 'Emp/DI/1', '2020-07-23 21:13:44', 'Admin', NULL, NULL),
('Emp/DI/4', 'Ayu Fitriani', 'Ayu', NULL, 'F', 3, 'DI', 'noimage.png', NULL, 'Emp/DI/1', '2020-07-29 10:00:26', NULL, NULL, NULL),
('Emp/DI/5', 'Natasya Amelia Apriliani', 'Natasya', NULL, 'F', 4, 'DI', 'noimage.png', NULL, 'Emp/DI/4', '2020-07-29 10:01:09', NULL, '2020-08-08 04:37:24', 'Admin'),
('Emp/DK/1', 'Reddy Orlan Ibrahim', 'Reddy', NULL, 'M', 2, 'DK', 'userpic3.jpg', 'reddy.svg', NULL, '2020-07-29 09:53:50', NULL, '2020-08-23 11:14:50', 'Reddy'),
('Emp/DK/2', 'Ibnu Satria', 'Ibnu', NULL, 'M', 4, 'DK', 'noimage.png', 'ibnu.svg', 'Emp/DK/1', '2020-07-29 09:56:52', NULL, '2020-08-20 12:01:50', 'Ibnu'),
('Emp/DK/3', 'Bayu Rizki Darmawan', 'Bayu', NULL, 'M', 4, 'DK', 'noimage.png', 'bayu.svg', 'Emp/DK/1', '2020-07-29 09:59:14', NULL, NULL, NULL),
('Emp/DKPP/1', 'Khoirul Aqil', 'Aqil', NULL, 'M', 3, 'DKPP', 'noimage.png', NULL, 'Emp/DKPP/2', '2020-07-28 09:33:05', NULL, NULL, NULL),
('Emp/DKPP/2', 'Rudi Hermawan', 'Rudi', NULL, 'M', 2, 'DKPP', 'avatar1.jpg', NULL, NULL, '2020-07-23 21:14:26', 'Admin', '2020-08-09 03:25:47', 'Rudi'),
('Emp/DKPP/3', 'Rian Subagyo', 'RianS', NULL, 'M', 4, 'DKPP', 'noimage.png', NULL, 'Emp/DKPP/1', '2020-07-23 21:38:00', 'Admin', '2020-07-30 10:55:11', 'Admin'),
('Emp/DKPP/4', 'Bima Fatahilah', 'Bima', NULL, 'M', 4, 'DKPP', 'avatar2.jpg', 'bima.svg', 'Emp/DKPP/5', '2020-07-28 10:25:17', NULL, '2020-08-08 06:01:35', 'Bima'),
('Emp/DKPP/5', 'Anton Tri Atmojo', 'Anton', NULL, 'M', 3, 'DKPP', 'avatar5.jpg', NULL, 'Emp/DKPP/2', '2020-07-28 15:06:07', NULL, '2020-08-10 04:12:28', 'Anton'),
('Emp/DKPP/6', 'Aif Firmansyah', 'Aif', NULL, 'M', 4, 'DKPP', 'noimage.png', NULL, 'Emp/DKPP/5', '2020-07-28 15:12:33', NULL, NULL, NULL),
('Emp/DKU/1', 'Ahmad Setia Aji', 'Ahmad', 'aaji93852@gmail.com', 'M', 2, 'DKU', 'noimage.png', 'Ahmad.svg', NULL, '2020-08-29 17:11:57', NULL, NULL, NULL),
('Emp/DKU/2', 'Bowo Relawanto', 'Relawan', 'agunghn07@gmail.com', 'M', 3, 'DKU', 'noimage.png', 'Relawan.svg', 'Emp/DKU/1', '2020-08-29 17:14:46', NULL, '2020-08-29 05:29:09', 'Relawan'),
('Emp/DKU/3', 'Budi Setiawan', 'Setiawan', 'budi@gmail.com', 'M', 4, 'DKU', 'noimage.png', 'Setiawan.svg', 'Emp/DKU/2', '2020-08-29 17:15:53', NULL, '2020-08-29 05:24:18', 'Admin'),
('Emp/DUTI/10', 'Fathur Rizki', 'Fathur', NULL, 'M', 4, 'DUTI', 'noimage.png', 'Fathur.svg', 'Emp/DUTI/4', '2020-08-27 20:59:26', NULL, NULL, NULL),
('Emp/DUTI/2', 'Agung Hermawan', 'Agung', 'agunghn07@gmail.com', 'M', 3, 'DUTI', 'a4.jpg', 'agung.svg', 'Emp/DUTI/3', '2020-07-28 09:21:11', NULL, '2020-07-31 08:21:27', 'Agung'),
('Emp/DUTI/3', 'Aji Pangestu', 'Pangestu', NULL, 'M', 2, 'DUTI', 'avatar-3.jpg', 'pangestu.svg', NULL, '2020-07-23 20:39:46', 'Admin', '2020-08-23 09:01:07', 'Pangestu'),
('Emp/DUTI/4', 'Widi Ardiansyah', 'Widi', 'agunghn07@gmail.com', 'M', 3, 'DUTI', 'noimage.png', NULL, 'Emp/DUTI/3', '2020-07-28 09:40:53', NULL, NULL, NULL),
('Emp/DUTI/5', 'Rian Subhanhadi', 'Rian', NULL, 'M', 4, 'DUTI', 'pexels-photo-220453.jpeg', NULL, 'Emp/DUTI/2', '2020-07-23 20:42:37', 'Admin', '2020-08-08 04:36:26', 'Admin'),
('Emp/DUTI/6', 'Rianto Anggara', 'Rianto', NULL, 'M', 4, 'DUTI', 'noimage.png', 'Rianto.svg', 'Emp/DUTI/7', '2020-07-28 09:31:21', NULL, '2020-08-24 10:11:46', 'Rianto'),
('Emp/DUTI/7', 'Faiz Imanuddin', 'Faiz', NULL, 'M', 3, 'DUTI', 'noimage.png', 'faiz.svg', 'Emp/DUTI/3', '2020-07-28 15:10:09', NULL, NULL, NULL),
('Emp/DUTI/8', 'Wahyu Setiawan', 'Wahyu', NULL, 'M', 4, 'DUTI', 'noimage.png', 'wahyu.svg', 'Emp/DUTI/2', '2020-08-01 20:20:42', NULL, '2020-08-14 09:15:33', 'Admin'),
('Emp/DUTI/9', 'Ahmad Dzilal Haq', 'Dzilal', 'Dzilal@gmail.com', 'M', 4, 'DUTI', 'a1.jpg', 'Dzilal.svg', 'Emp/DUTI/2', '2020-08-02 21:13:17', NULL, '2020-09-02 09:42:15', 'Dzilal');

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
(1, 'Adm/DUTI/1', '$2y$10$P/HT3tja3miX0T9ZYCj1qObQ2ZCPNORpdLgAdRwxPTpjZPDxDXpLm', 1, '2020-07-23 20:05:45', 'Admin', NULL, NULL),
(2, 'Emp/DUTI/4', '$2y$10$Wg8kQCfJieb3tz3vAHNCCO4MocUBdiLWxVLfGHMKZlnI1RLKMtDvC', 1, '2020-07-28 09:40:53', 'Admin', '2020-08-17 06:22:08', 'Admin'),
(3, 'Emp/DI/1', '$2y$10$Nkxfqxw8GUrp949m00QKIO2ZSBoe.lKN5het.SHfYg1pYyV1GS.aW', 1, '2020-07-23 20:39:04', 'Admin', '2020-08-21 11:01:53', 'Admin'),
(4, 'Emp/DUTI/3', '$2y$10$efiGJe6pwNng0MPqVRFKX.p0oLGgOKGB/JqjLd6BZL0D/6uV4OvRG', 1, '2020-07-23 20:39:46', 'Admin', '2020-08-27 09:00:25', 'Admin'),
(5, 'Emp/DI/2', '$2y$10$Ej.IdfKXCkEpYBjKke/x/.P2eGyKNrgOu/wAc32dG.B5H9kuVKJZq', 1, '2020-07-28 10:13:16', 'Admin', '2020-08-21 11:02:09', 'Admin'),
(6, 'Emp/DKPP/4', '$2y$10$1NJviF4.tEqODSAA7lE9xOSuzWmiaWxZWQ4qZSvm/8omGhd4QnsWW', 1, '2020-07-28 10:25:17', 'Admin', '2020-08-24 11:25:36', 'Admin'),
(7, 'Emp/DUTI/5', '$2y$10$Ta7Sx.nL81SOXZZ.td28ie7gIRmOuDSKFeJyfDedeBZ3NEkQQSZmi', 1, '2020-07-23 20:42:37', 'Admin', '2020-07-29 11:17:04', 'Admin'),
(8, 'Emp/DKPP/5', '$2y$10$kTkbPcDMLWSGQ5D9vxjIju3.gifu6suDvuPPFn/gT/aoeQOlIy78q', 1, '2020-07-28 15:06:07', 'Admin', '2020-08-08 05:39:02', 'Admin'),
(9, 'Emp/DI/3', '$2y$10$PpkcFRdPVdfS5kVLKZw57.8BPqGSWrRx90b/8mLFBkZ9sC5ACV992', 1, '2020-07-23 21:13:44', 'Admin', '2020-08-21 11:02:21', 'Admin'),
(10, 'Emp/DKPP/2', '$2y$10$OjXpyfvLEAsXdnDEhBeZYeojcM79ewMz4dst8c52l7DPDqRubhwcu', 1, '2020-07-23 21:14:26', 'Admin', '2020-08-08 08:32:24', 'Admin'),
(11, 'Emp/DKPP/3', '$2y$10$Rq9AOJGa2n72Wk5OxRf5teapt0aGceojWtZGzmfUrlFzD/wNF0IPa', 1, '2020-07-23 21:38:00', 'Admin', '2020-08-13 10:13:25', 'Admin'),
(12, 'Emp/DUTI/2', '$2y$10$Lzj1AxCWCFIfNDQAqeqJ.OoqbPYV0gC2aBSTSNqBz4vkNgLG4xhfK', 1, '2020-07-28 09:21:12', 'Admin', '2020-08-23 01:47:46', 'Admin'),
(13, 'Emp/DUTI/6', '$2y$10$7zKeXtx1WZI78CEUwBaT0OeZRFdoAAlt1JoYHV9eHSGpT9SMBpOxC', 1, '2020-07-28 09:31:22', 'Admin', '2020-08-10 09:03:47', 'Admin'),
(14, 'Emp/DKPP/1', '$2y$10$6PGnVxGHnlKkU46A4vDI1O1s/oNrvg12f4OCDCca9WyuyVsJQhB6C', 1, '2020-07-28 09:33:06', 'Admin', '2020-08-13 10:14:03', 'Admin'),
(15, 'Emp/DUTI/7', '$2y$10$dvGm0TXKZRL3jvBN2Be57e/WsKysW2sBKELj8/upsRqUjcNnACVp2', 1, '2020-07-28 15:10:09', 'Admin', '2020-08-10 09:03:45', 'Admin'),
(16, 'Emp/DKPP/6', '$2y$10$JqCLwSmMZFVWBWpzgzx0bOUx2vtorglwM0eIRMolB4iieNLmVBAVq', 1, '2020-07-28 15:12:33', 'Admin', '2020-08-23 01:59:56', 'Admin'),
(17, 'Emp/DK/1', '$2y$10$Du5mI8lNf.N0h4OYAuVp9ukFara9jlhn0b9vW3IKF78gS.uYMDOp.', 1, '2020-07-29 09:53:50', 'Admin', '2020-08-10 07:39:50', 'Admin'),
(18, 'Emp/DK/2', '$2y$10$OQXF/zVUidwvmg5N5Bnwy.buCeglPsTumxDZqK0ardzzcQ83ZY6dS', 1, '2020-07-29 09:56:52', 'Admin', '2020-08-20 12:01:08', 'Admin'),
(19, 'Emp/DK/3', '$2y$10$OUXIe8rpWgD5F8hS1FvWxu5IpgHDyItU2Dz9VfyulM9PQ9.4PeAR6', 1, '2020-07-29 09:59:14', 'Admin', '2020-08-20 12:35:00', 'Admin'),
(20, 'Emp/DI/4', '$2y$10$rNJXYexe5JZ.eY2iBK2ateTDB9amxYlI/zb2hJ86PsqRHbzOldlYG', 0, '2020-07-29 10:00:26', 'Admin', '2020-08-21 11:02:19', 'Admin'),
(21, 'Emp/DI/5', '$2y$10$Yp0u96l1wkuK7EdYOHphrOGAZoWP62IZ0zA0ztJcYrromoXJ2XQt2', 0, '2020-07-29 10:01:09', 'Admin', '2020-08-23 12:30:10', 'Admin'),
(22, 'Emp/DUTI/8', '$2y$10$JHrU8XSg1sYGRCBYVFgW5uGdyWuAiskUp87l894F27q6KtciaW.Di', 1, '2020-08-01 20:20:42', 'Admin', '2020-08-01 08:20:53', 'Admin'),
(23, 'Emp/DUTI/9', '$2y$10$vTLCN7Kor4IDV.SjjmeAVOjVM4TBA/h3YQp8Ip./rVH6Uvx0ly1C.', 1, '2020-08-02 21:13:17', 'Admin', '2020-08-02 09:15:59', 'Admin'),
(24, 'Emp/DHM/1', '$2y$10$7i8XDlT003fMrWU5G9jxM.1Xsv2t5/iQU3.SvyGZ96NsMOYwjZQli', 1, '2020-08-23 20:47:24', 'Admin', '2020-08-24 03:04:17', 'Admin'),
(25, 'Emp/DHM/2', '$2y$10$.pLKvp44SLgOYxknInhE0.zkHIn5RKwR6jnMSLqYqyk/bddIzd6Bq', 1, '2020-08-24 10:55:44', 'Admin', '2020-08-24 07:59:49', 'Admin'),
(26, 'Emp/DHM/3', '$2y$10$Ltmnl1gH3IgM9p/d.vrUJeMovjmdxvLpihAE6.taHx62HkMzYkLiW', 0, '2020-08-24 11:32:06', 'Admin', '2020-08-24 11:33:32', 'Admin'),
(27, 'Emp/DHM/4', '$2y$10$xgHLMH1u4jWY81yDmijh0OkCPwdZc7geMNuJB7W5SIfYaDPzgv1G6', 1, '2020-08-24 11:51:38', 'Admin', '2020-08-24 07:59:52', 'Admin'),
(28, 'Emp/DHM/5', '$2y$10$HgTS7AjaMnAjlWkUDFIlIOuVUTTIo2lsu9vfrDemG/mXU9U8Uv7Jq', 0, '2020-08-24 16:27:50', 'Admin', NULL, NULL),
(29, 'Emp/DHM/6', '$2y$10$s.8WbwhUj8a7k3ggmyckQ.REszMQDuJuqW/YZNXdEfkRprnL0DXzK', 1, '2020-08-24 21:24:58', 'Admin', '2020-08-24 09:25:39', 'Admin'),
(30, 'Emp/DUTI/10', '$2y$10$00yFvfuz48ht2iLkRjtUnOfpojeHev6Ax6OyxKxgVYud0PM87g3Om', 1, '2020-08-27 20:59:26', 'Admin', '2020-08-27 08:59:47', 'Admin'),
(31, 'Emp/DKU/1', '$2y$10$tCgxsR6cCuJnngMHiGaVNu8LfytQg/xRwi1tnlw8m4JGFQze4IUYy', 1, '2020-08-29 17:11:57', 'Admin', '2020-08-29 05:23:11', 'Admin'),
(32, 'Emp/DKU/2', '$2y$10$f/sTWgEB9vGzSB.7l9bRlue8f13noEl626mDHgh05dp5KLYt8fe3i', 1, '2020-08-29 17:14:46', 'Admin', '2020-08-29 05:23:18', 'Admin'),
(33, 'Emp/DKU/3', '$2y$10$uDM0UPX/zVEl9bFPsaZs.emwzqL1btntGkaRX8Cfi8piw3dt8gNx6', 1, '2020-08-29 17:15:53', 'Admin', '2020-08-29 05:23:21', 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_r_reset_token`
--

CREATE TABLE `tb_r_reset_token` (
  `ID` int(11) NOT NULL,
  `PARAM` varchar(150) NOT NULL,
  `TOKEN` varchar(150) NOT NULL,
  `CREATED_DT` datetime DEFAULT sysdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(11, 'Emp/DUTI/3', '$1$tf9PRPtt$Yf0Xy2A4JdBITvkQ2a47K/', '2020-09-02 14:44:20');

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
(8, 'EMP/DK/3', '2020', 11, '2020-07-30 09:12:06', 'Admin', '2020-08-20 12:37:45', 'Reddy'),
(9, 'EMP/DKPP/1', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(10, 'EMP/DKPP/2', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(11, 'EMP/DKPP/3', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(12, 'EMP/DKPP/4', '2020', 11, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(13, 'EMP/DKPP/5', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(14, 'Emp/DKPP/6', '2020', 11, '2020-07-30 09:12:06', 'Admin', '2020-08-21 10:10:53', 'Reddy'),
(15, 'EMP/DUTI/2', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(16, 'EMP/DUTI/3', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(17, 'Emp/DUTI/4', '2020', 10, '2020-07-30 09:12:06', 'Admin', '2020-08-27 11:16:51', 'Reddy'),
(18, 'EMP/DUTI/5', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(19, 'Emp/DUTI/6', '2020', 11, '2020-07-30 09:12:06', 'Admin', '2020-08-19 07:38:09', 'Reddy'),
(20, 'Emp/DUTI/7', '2020', 12, '2020-07-30 09:12:06', 'Admin', NULL, NULL),
(21, 'Emp/DUTI/8', '2020', 12, '2020-08-01 20:23:52', 'Admin', NULL, NULL),
(22, 'Emp/DUTI/9', '2020', 11, '2020-08-02 21:15:11', 'Admin', '2020-09-01 02:03:07', 'Reddy'),
(23, 'Emp/DHM/2', '2020', 11, '2020-08-24 20:07:39', 'Admin', '2020-08-26 02:37:34', 'Reddy'),
(24, 'Emp/DHM/3', '2020', 12, '2020-08-24 20:07:39', 'Admin', NULL, NULL),
(25, 'Emp/DHM/4', '2020', 11, '2020-08-24 20:07:39', 'Admin', '2020-08-24 09:01:09', 'Reddy'),
(26, 'Emp/DHM/5', '2020', 12, '2020-08-24 20:07:39', 'Admin', NULL, NULL),
(27, 'Emp/DHM/6', '2020', 12, '2020-08-24 21:24:58', 'Admin', NULL, NULL),
(28, 'Emp/DUTI/10', '2020', 12, '2020-08-27 20:59:26', 'Admin', NULL, NULL),
(29, 'Emp/DKU/1', '2020', 12, '2020-08-29 17:11:57', 'Admin', NULL, NULL),
(30, 'Emp/DKU/2', '2020', 12, '2020-08-29 17:14:46', 'Admin', NULL, NULL),
(31, 'Emp/DKU/3', '2020', 11, '2020-08-29 17:15:53', 'Admin', '2020-08-29 06:00:27', 'Reddy');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_t_pengajuan_cuti`
--

CREATE TABLE `tb_t_pengajuan_cuti` (
  `ID` int(11) NOT NULL,
  `NOMOR_CUTI` varchar(20) DEFAULT NULL,
  `NOREG` varchar(20) NOT NULL,
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

INSERT INTO `tb_t_pengajuan_cuti` (`ID`, `NOMOR_CUTI`, `NOREG`, `START_DT`, `UNTIL_DT`, `ALASAN`, `APPROVAL_1`, `APPROVAL_2`, `APPROVAL_3`, `IS_APPROVE`, `CREATED_DT`, `CREATED_BY`, `UPDATED_DT`, `UPDATED_BY`) VALUES
(1, 'Emp/DUTI/9/20-1', 'Emp/DUTI/9', '2020-09-08', '2020-09-09', 'Test cuti staff DUTI Ahmad Dzilal Haq', 3, 3, 3, 3, '2020-09-01 13:58:32', 'Dzilal', '2020-09-01 02:03:07', 'Reddy');

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
-- Indeks untuk tabel `tb_m_read_status`
--
ALTER TABLE `tb_m_read_status`
  ADD PRIMARY KEY (`ID`);

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
-- Indeks untuk tabel `tb_r_email`
--
ALTER TABLE `tb_r_email`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_tb_r_email_READ_STATUS` (`READ_STATUS`),
  ADD KEY `FK_tb_r_email_SENDER` (`SENDER`),
  ADD KEY `FK_tb_r_email_RECEIVER` (`RECEIVER`),
  ADD KEY `FK_tb_r_email_ID_CUTI` (`ID_CUTI`);

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
-- Indeks untuk tabel `tb_r_reset_token`
--
ALTER TABLE `tb_r_reset_token`
  ADD PRIMARY KEY (`ID`);

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
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_tb_t_pengajuan_cuti_NOREG` (`NOREG`),
  ADD KEY `FK_tb_t_pengajuan_cuti_APPROVAL_1` (`APPROVAL_1`),
  ADD KEY `FK_tb_t_pengajuan_cuti_APPROVAL_2` (`APPROVAL_2`),
  ADD KEY `FK_tb_t_pengajuan_cuti_APPROVAL_3` (`APPROVAL_3`),
  ADD KEY `FK_tb_t_pengajuan_cuti_IS_APPROVE` (`IS_APPROVE`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_m_read_status`
--
ALTER TABLE `tb_m_read_status`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_r_email`
--
ALTER TABLE `tb_r_email`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_r_reset_token`
--
ALTER TABLE `tb_r_reset_token`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_r_token`
--
ALTER TABLE `tb_r_token`
  MODIFY `id_token` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_t_cuti`
--
ALTER TABLE `tb_t_cuti`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
-- Ketidakleluasaan untuk tabel `tb_r_email`
--
ALTER TABLE `tb_r_email`
  ADD CONSTRAINT `FK_tb_r_email_ID_CUTI` FOREIGN KEY (`ID_CUTI`) REFERENCES `tb_t_pengajuan_cuti` (`ID`),
  ADD CONSTRAINT `FK_tb_r_email_READ_STATUS` FOREIGN KEY (`READ_STATUS`) REFERENCES `tb_m_read_status` (`ID`),
  ADD CONSTRAINT `FK_tb_r_email_RECEIVER` FOREIGN KEY (`RECEIVER`) REFERENCES `tb_r_employee` (`NOREG`),
  ADD CONSTRAINT `FK_tb_r_email_SENDER` FOREIGN KEY (`SENDER`) REFERENCES `tb_r_employee` (`NOREG`);

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

--
-- Ketidakleluasaan untuk tabel `tb_t_pengajuan_cuti`
--
ALTER TABLE `tb_t_pengajuan_cuti`
  ADD CONSTRAINT `FK_tb_t_pengajuan_cuti_APPROVAL_1` FOREIGN KEY (`APPROVAL_1`) REFERENCES `tb_m_approval` (`ID`),
  ADD CONSTRAINT `FK_tb_t_pengajuan_cuti_APPROVAL_2` FOREIGN KEY (`APPROVAL_2`) REFERENCES `tb_m_approval` (`ID`),
  ADD CONSTRAINT `FK_tb_t_pengajuan_cuti_APPROVAL_3` FOREIGN KEY (`APPROVAL_3`) REFERENCES `tb_m_approval` (`ID`),
  ADD CONSTRAINT `FK_tb_t_pengajuan_cuti_IS_APPROVE` FOREIGN KEY (`IS_APPROVE`) REFERENCES `tb_m_approval` (`ID`),
  ADD CONSTRAINT `FK_tb_t_pengajuan_cuti_NOREG` FOREIGN KEY (`NOREG`) REFERENCES `tb_r_employee` (`NOREG`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
