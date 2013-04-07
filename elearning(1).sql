-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 07. April 2013 jam 06:46
-- Versi Server: 5.5.16
-- Versi PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE IF NOT EXISTS `guru` (
  `nip_guru` varchar(25) NOT NULL,
  `nama_guru` varchar(35) NOT NULL,
  `jk` varchar(5) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(35) NOT NULL,
  PRIMARY KEY (`nip_guru`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`nip_guru`, `nama_guru`, `jk`, `username`, `password`) VALUES
('195302011993031002', 'Faradila', 'w', 'fara', 'fara'),
('195305021981031001', 'Panca Lien', 'w', 'panca', 'panca'),
('195305021982031002', 'Windi', 'w', 'windi', 'windi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `kode_kelas` varchar(15) NOT NULL,
  `nama_kelas` varchar(25) NOT NULL,
  PRIMARY KEY (`kode_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`kode_kelas`, `nama_kelas`) VALUES
('XA', 'Sepuluh A'),
('XB', 'Sepuluh B'),
('XC', 'Sepuluh C'),
('XD', 'Sepuluh D'),
('XII_Jaringan', 'Dua Belas Jaringan'),
('XII_Otomotif B', 'Dua Belas Otomotif B'),
('XII_Otomotif_A', 'Dua Belas Otomotif A'),
('XII_TataBusan_A', 'Dua Belas Tata Busana A'),
('XII_TataBusan_B', 'Dua Belas Tata Busana B'),
('XI_JARINGAN_A', 'Sebelas Jaringan A'),
('XI_OTOMOTIF A', 'Sebelas Otomotif A'),
('XI_OTOMOTIF B', 'Sebelas Otomotif B'),
('XI_TATABUSANA_A', 'Sebelas Tata Busana A'),
('XI_TATABUSANA_B', 'Sebelas Tata Busana B');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `username` varchar(25) NOT NULL,
  `password` varchar(55) NOT NULL,
  `level` enum('admin','kepsek','guru','siswa') NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`username`, `password`, `level`) VALUES
('dila', '35862fcf105f1aaa0b4f29ca71b96236', 'admin'),
('fara', 'a67d56672f2b5fb4232dfbd9a14fc25b', 'kepsek'),
('panca', 'c9e023417fa66e852e4d1f920c051017', 'guru'),
('windi', '4e3ccde7dc705b1abcce17019905279b', 'guru'),
('faradila', 'b74170a0d08278304b9ec275cf6fcd56', 'siswa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE IF NOT EXISTS `mapel` (
  `kode_mapel` varchar(15) NOT NULL,
  `nama_mapel` varchar(25) NOT NULL,
  PRIMARY KEY (`kode_mapel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`kode_mapel`, `nama_mapel`) VALUES
('A1', 'AGAMA'),
('A2', 'Akidah Akhlaq'),
('A3', 'Teknik Kendaraan Ringan'),
('A4', 'Quran Hadits'),
('B1', 'Bahasa Arab'),
('B2', 'Bahasa Inggris'),
('B3', 'Bahasa Jawa'),
('B4', 'MUATAN LOKAL'),
('PA1', 'Biologi'),
('PA2', 'Kimia'),
('PA3', 'Fisika'),
('PS1', 'Geografi'),
('PS2', 'Sejarah'),
('PS3', 'Sosiologi'),
('PS5', 'Pengenalan Jaringan'),
('PU1', 'Matematika'),
('PU2', 'Bahasa Indonesia'),
('PU3', 'Kewarganegaraan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mengajar`
--

CREATE TABLE IF NOT EXISTS `mengajar` (
  `id_mengajar` int(4) NOT NULL AUTO_INCREMENT,
  `nip_guru` varchar(25) NOT NULL,
  `kode_mapel` varchar(15) NOT NULL,
  `kode_kelas` varchar(15) NOT NULL,
  PRIMARY KEY (`id_mengajar`),
  UNIQUE KEY `nip_guru_2` (`nip_guru`,`kode_mapel`,`kode_kelas`),
  KEY `nip_guru` (`nip_guru`,`kode_kelas`),
  KEY `kode_kelas` (`kode_kelas`),
  KEY `kode_mapel` (`kode_mapel`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data untuk tabel `mengajar`
--

INSERT INTO `mengajar` (`id_mengajar`, `nip_guru`, `kode_mapel`, `kode_kelas`) VALUES
(24, '195305021981031001', 'B2', 'XA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE IF NOT EXISTS `nilai` (
  `nis` varchar(15) NOT NULL,
  `kode_kelas` varchar(15) NOT NULL,
  `kode_mapel` varchar(15) NOT NULL,
  `nilai` float NOT NULL,
  `saran_guru` text NOT NULL,
  KEY `kode_mapel` (`kode_mapel`),
  KEY `nis` (`nis`,`kode_kelas`),
  KEY `kode_kelas` (`kode_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`nis`, `kode_kelas`, `kode_mapel`, `nilai`, `saran_guru`) VALUES
('9934567770', 'XA', 'B2', 90, 'Pertahankan nilaimu!');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE IF NOT EXISTS `pengumuman` (
  `id_pengumuman` int(4) NOT NULL AUTO_INCREMENT,
  `nip_guru` varchar(25) NOT NULL,
  `objek` varchar(40) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `isi` text NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pengumuman`),
  KEY `nip_guru` (`nip_guru`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `nis` varchar(15) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `jk` varchar(5) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(35) NOT NULL,
  `kode_kelas` varchar(15) NOT NULL,
  `email` varchar(35) NOT NULL,
  PRIMARY KEY (`nis`),
  KEY `kode_mapel` (`kode_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`nis`, `nama`, `jk`, `username`, `password`, `kode_kelas`, `email`) VALUES
('9934567770', 'Faradilah Umami', 'w', 'faradila', 'faradila', 'XA', 'faradilahumami@gmail.com'),
('9951254512', 'Fina Mafatihul Khilmi', 'p', 'imi', 'imi', 'XC', 'imi@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tugas`
--

CREATE TABLE IF NOT EXISTS `tugas` (
  `id_tugas` int(4) NOT NULL AUTO_INCREMENT,
  `judul` varchar(35) NOT NULL,
  `nama_file` varchar(35) NOT NULL,
  `type` varchar(35) NOT NULL,
  `size` int(11) NOT NULL,
  `content` longblob NOT NULL,
  `jenis_tugas` varchar(25) NOT NULL,
  `kode_mapel` varchar(15) NOT NULL,
  `kode_kelas` varchar(15) NOT NULL,
  `nip_guru` varchar(25) NOT NULL,
  `ket` varchar(250) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_tugas`),
  KEY `kode_mapel` (`kode_mapel`,`kode_kelas`,`nip_guru`),
  KEY `kode_kelas` (`kode_kelas`),
  KEY `nip_guru` (`nip_guru`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `upload`
--

CREATE TABLE IF NOT EXISTS `upload` (
  `id_materi` int(4) NOT NULL AUTO_INCREMENT,
  `nama_file` varchar(100) NOT NULL,
  `size` int(4) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `nip_guru` varchar(100) NOT NULL,
  `nama_mapel` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `type` varchar(200) NOT NULL,
  `content` varchar(200) NOT NULL,
  `kode_mapel` varchar(200) NOT NULL,
  PRIMARY KEY (`id_materi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `upload`
--

INSERT INTO `upload` (`id_materi`, `nama_file`, `size`, `judul`, `nip_guru`, `nama_mapel`, `tanggal`, `type`, `content`, `kode_mapel`) VALUES
(1, 'Metabolisme.ppt', 715776, 'Metabolisme', '195302011993031002', '', '2012-05-24', 'application/vnd.ms-powerpoint', 'ÐÏà¡±\Zá\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0>\0\0þÿ	\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0d\0\0\0\0\0\0\0\0\0f\0\0\0\0\0þÿÿÿ\0\0\0\0h\0\0i\0\0j\0\0k\0\0l\0\0m\0\0n\0\0o\0\0p\0\0q\0\0e\0\0ÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿÿ', 'PA1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
