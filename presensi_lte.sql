Skip to content
Search or jump to…

Pull requests
Issues
Marketplace
Explore
 
@SkinnyCoders 
0
01SkinnyCoders/presensi
forked from rickysukma/presensi
 Code Pull requests 0 Actions Projects 0 Wiki Security Insights Settings
presensi/crud.sql
@rickysukma rickysukma db
48234e3 29 days ago
113 lines (95 sloc)  3.14 KB
 
-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 08 Des 2019 pada 21.44
-- Versi server: 10.3.14-MariaDB
-- Versi PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `mesin`
--

DROP TABLE IF EXISTS `mesin`;
CREATE TABLE IF NOT EXISTS `mesin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sn` varchar(25) NOT NULL,
  `nama_mesin` varchar(255) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `comkey` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mesin`
--

INSERT INTO `mesin` (`id`, `sn`, `nama_mesin`, `ip`, `comkey`) VALUES
(1, 'bwx454235', 'presensi', '192.168.1.201', '1'),
(2, 'BWXP191562141', 'Presensi 2', '192.168.1.205', '12343');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekap_presensi`
--

DROP TABLE IF EXISTS `rekap_presensi`;
CREATE TABLE IF NOT EXISTS `rekap_presensi` (
  `id_rekap` int(11) NOT NULL AUTO_INCREMENT,
  `id_siswa` int(11) NOT NULL,
  `waktu` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id_rekap`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rekap_presensi`
--

INSERT INTO `rekap_presensi` (`id_rekap`, `id_siswa`, `waktu`, `status`) VALUES
(1, 2, '2019-11-21 21:51:24', 0),
(2, 1, '2019-11-25 13:32:06', 0),
(3, 1, '2019-11-25 13:36:31', 0),
(4, 1234, '2019-11-25 13:38:55', 0),
(5, 1, '2019-11-25 17:31:12', 1),
(6, 1234, '2019-11-25 17:34:40', 1),
(7, 1, '2019-11-25 17:34:47', 1),
(8, 1, '2019-11-27 12:21:03', 0),
(9, 1, '2019-12-07 11:02:21', 0),
(10, 1234, '2019-12-07 11:02:24', 0),
(11, 1, '2019-12-09 09:52:57', 0),
(12, 1234, '2019-12-09 09:53:01', 0),
(13, 2, '2019-11-21 21:51:24', 0),
(14, 1, '2019-11-25 13:32:06', 0),
(15, 1, '2019-11-25 13:36:31', 0),
(16, 1234, '2019-11-25 13:38:55', 0),
(17, 1, '2019-11-25 17:31:12', 1),
(18, 1234, '2019-11-25 17:34:40', 1),
(19, 1, '2019-11-25 17:34:47', 1),
(20, 1, '2019-11-27 12:21:03', 0),
(21, 1, '2019-12-07 11:02:21', 0),
(22, 1234, '2019-12-07 11:02:24', 0),
(23, 1, '2019-12-09 09:52:57', 0),
(24, 1234, '2019-12-09 09:53:01', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

DROP TABLE IF EXISTS `siswa`;
CREATE TABLE IF NOT EXISTS `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `fingerprint` varchar(1000) DEFAULT NULL,
  `rombel` int(11) NOT NULL,
  `id_mesin` int(11) NOT NULL,
  PRIMARY KEY (`id_siswa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
