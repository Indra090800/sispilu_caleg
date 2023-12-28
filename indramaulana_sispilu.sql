-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 28 Des 2023 pada 03.52
-- Versi server: 10.11.6-MariaDB-1:10.11.6+maria~deb11
-- Versi PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `indramaulana_sispilu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_log`
--

CREATE TABLE `tb_log` (
  `id_saksi` int(11) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `id` int(11) NOT NULL,
  `id_tps` int(11) NOT NULL,
  `jam` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_parpol`
--

CREATE TABLE `tb_parpol` (
  `id_parpol` int(11) NOT NULL,
  `nama_parpol` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `foto_logo` varchar(50) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_parpol`
--

INSERT INTO `tb_parpol` (`id_parpol`, `nama_parpol`, `alamat`, `no_telp`, `foto_logo`, `id_role`) VALUES
(4, 'DPC PDIP Cilegon', 'Kota Cilegon', '081219366664', 'DPC PDIP Cilegon.png', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_role`
--

CREATE TABLE `tb_role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_role`
--

INSERT INTO `tb_role` (`id_role`, `nama_role`) VALUES
(1, 'caleg'),
(2, 'admin'),
(3, 'Parpol'),
(5, 'Kecamatan'),
(6, 'Kelurahan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_saksi`
--

CREATE TABLE `tb_saksi` (
  `id_saksi` int(11) NOT NULL,
  `nik_ktp` varchar(20) NOT NULL,
  `nama_saksi` varchar(100) NOT NULL,
  `id_parpol` varchar(11) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `foto_saksi` varchar(50) DEFAULT NULL,
  `id_tps` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_saksi`
--

INSERT INTO `tb_saksi` (`id_saksi`, `nik_ktp`, `nama_saksi`, `id_parpol`, `alamat`, `no_hp`, `foto_saksi`, `id_tps`, `password`) VALUES
(9, '0001', 'Inggar Diah', '4', 'Sukasenang 03/01', '088975488794', '0001.png', '9', '$2y$12$OiCPva3O8E.fQSiQ81h.VeVAJINl.xJZmh0zAIT.uUtsrsLLOy5cK'),
(10, '0002', 'Uswatun Hasanah', '4', 'Sukasenang 03/01', '081387531609', '0002.png', '9', '$2y$12$foHSP7j2VPyo/UMJqT68S.Qyeats3ANZoW/FgkmxdQasjgyyWzIh.'),
(11, '0003', 'Nopan Fachroni', '4', 'Sukasenang 02/02', '089532605049', '0003.png', '14', '$2y$12$J4Ud4Jh342cb39JApTyoUuqTPTrtNDFxJPtDiFRSJKvRnt.eVF6om'),
(12, '0004', 'Calim', '4', 'Sukasenang 02/02', '089637522119', '0004.png', '14', '$2y$12$Ft2P7FDJrIGJJr5787C6XeZVr5wPyuUywfvzF8ejvd8HVjFd6IPci'),
(13, '0005', 'Wahyudin Aziz', '4', 'Babakanturi 04/02', '081210534352', '0005.png', '18', '$2y$12$bDbwpiDPXD6Wdylyjn8voOYETYbFTuemTQApumlT467tc.FLXUHUy'),
(14, '0006', 'Nuryanah', '4', 'Babakanturi 07/02', '085217222357', '0006.png', '19', '$2y$12$8BJ/eGcY7avXj6U.puNIquHenTLnvpCK6oFRYXGED.7fTKt.auqXW'),
(15, '0007', 'Amelia Febriyani', '4', 'Babakanturi 07/02', '085930134034', '0007.png', '19', '$2y$12$qEpE/vPRWy3Z6BbRPsMMH.cH0ImiWB/.BEFoSGSv.d4ZdizyjLnMC'),
(16, '0008', 'Ani Sofyansyah', '4', 'Babakanturi 06/02', '083114337061', '0008.png', '20', '$2y$12$Vw828x48iuLLP032P2xePu.o2A/Vl8R9jrDLiXBN5JgLx0UW6eKpK'),
(17, '0009', 'Abdul Rahman', '4', 'Bumi Waras 01/03', '082312451899', '0009.png', '22', '$2y$12$wxbX5.WURElVarL.YO/HQu6BXGjCgGR1BUyyskig5u78LfNIsGHxC'),
(18, '0010', 'Muhammad Muslim', '4', 'Bumiwaras 03/03', '0895619627113', '0010.png', '23', '$2y$12$Ed14iNoRLNq2pK4VROVGJ.lNm.RXvqabDg1cUUFUc/kQ4qm94Miyi'),
(19, '0011', 'Nur Hidayatullah', '4', 'Bumiwaras 03/03', '089603362808', '0011.png', '23', '$2y$12$l528vEnmRw0XLdclgIymkOaAXnI1uHqZkJwbDpVlL1M5ZBoAR9F9C'),
(20, '0012', 'Dades Krisdiawan', '4', 'Bumiwaras 02/03', '081287025271', '0012.png', '24', '$2y$12$HGGHclyokGtPWStCXH4eyO.7B4.0h7kzPshfhctQj5aQls/WRRXDG'),
(21, '0013', 'Ida Yati', '4', 'Lingkungan Bumiwaras 04/03', '085945096109', '0013.png', '25', '$2y$12$38b3zAehg.KMcN1MW8QPhOIAyJxiZQ/87GO5l3oR7Fj8N8I/8rtES');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tps`
--

CREATE TABLE `tb_tps` (
  `id_tps` int(11) NOT NULL,
  `nama_tps` varchar(200) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `desa` varchar(25) NOT NULL,
  `kecamatan` varchar(25) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `foto_bukti` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_tps`
--

INSERT INTO `tb_tps` (`id_tps`, `nama_tps`, `alamat`, `desa`, `kecamatan`, `lokasi`, `foto_bukti`) VALUES
(7, 'TPS 001 Sukasari', 'Lingkungan Sukasari', 'Tamansari', 'Pulomerak', '01/01', NULL),
(8, 'TPS 002 Babakanseri', 'Lingkungan Babakanseri', 'Tamansari', 'Pulomerak', '02/01', NULL),
(9, 'TPS 003 Sukasenang', 'Lingkungan Sukasenang', 'Tamansari', 'Pulomerak', '03/01', NULL),
(10, 'TPS 004 Sukasenang', 'Lingkungan Sukasenang', 'Tamansari', 'Pulomerak', '04/01', NULL),
(11, 'TPS 005 Sukasenang', 'Lingkungan Sukasenang', 'Tamansari', 'Pulomerak', '05/01', NULL),
(12, 'TPS 006 Babakanseri', 'Lingkungan Babaknseri', 'Tamansari', 'Pulomerak', '06/01', NULL),
(13, 'TPS 007 Sukasenang', 'Lingkungan Sukasenang', 'Tamansari', 'Pulomerak', '01/02', NULL),
(14, 'TPS 008 Sukasenang', 'Lingkungan Sukasenang', 'Tamansari', 'Pulomerak', '02/02', NULL),
(15, 'TPS 009 Babakanturi', 'Lingkungan Babakanturi', 'Tamansari', 'Pulomerak', '03/02', NULL),
(16, 'TPS 010 Babakanturi', 'Lingkungan Babakanturi', 'Tamansari', 'Pulomerak', '05/02', NULL),
(17, 'TPS 011 Babakanturi', 'Lingkungan Babakanturi', 'Tamansari', 'Pulomerak', '03/02', NULL),
(18, 'TPS 012 Babakanturi', 'Lingkungan Babakanturi', 'Tamansari', 'Pulomerak', '04/02', NULL),
(19, 'TPS 013 Babakanturi', 'Lingkungan Babakanturi', 'Tamansari', 'Pulomerak', '07/02', NULL),
(20, 'TPS 014 Babakanturi', 'Lingkungan Babakanturi', 'Tamansari', 'Pulomerak', '06/02', NULL),
(21, 'TPS 015 Babakanturi', 'Lingkungan Babakanturi', 'Tamansari', 'Pulomerak', '06/02', NULL),
(22, 'TPS 016 Bumiwaras', 'Lingkungan Bumiwaras', 'Tamansari', 'Pulomerak', '01/03', NULL),
(23, 'TPS 017 Bumiwaras', 'Lingkungan Bumiwaras', 'Tamansari', 'Pulomerak', '03/03', NULL),
(24, 'TPS 018 Bumiwaras', 'Lingkungan Bumiwaras', 'Tamansari', 'Pulomerak', '02/03', NULL),
(25, 'TPS 019 Bumiwaras', 'Lingkungan Bumiwaras', 'Tamansari', 'Pulomerak', '04/03', NULL),
(26, 'TPS 020 Bumiwaras', 'Lingkungan Bumiwaras', 'Tamansari', 'Pulomerak', '05/03', NULL),
(27, 'TPS 021 Kp. Baru', 'Lingkungan Baru', 'Tamansari', 'Pulomerak', '01/04', NULL),
(28, 'TPS 022 Kp. Baru', 'Lingkungan Baru', 'Tamansari', 'Pulomerak', '02/04', NULL),
(29, 'TPS 023 Kp. Baru', 'Lingkungan Baru', 'Tamansari', 'Pulomerak', '03/04', NULL),
(30, 'TPS 024 Kp. Baru', 'Lingkungan Baru', 'Tamansari', 'Pulomerak', '03/04', NULL),
(31, 'TPS 025 Kp. Baru', 'Lingkungan Baru', 'Tamansari', 'Pulomerak', '03/04', NULL),
(32, 'TPS 026 Kp. Baru', 'Lingkungan Baru', 'Tamansari', 'Pulomerak', '04/04', NULL),
(33, 'TPS 027 Kp. Baru', 'Lingkungan Baru', 'Tamansari', 'Pulomerak', '04/04', NULL),
(34, 'TPS 028 Kp. Sawah', 'Lingkungan Sawah', 'Tamansari', 'Pulomerak', '05/04', NULL),
(35, 'TPS 029 Kp. Sawah', 'Lingkungan Sawah', 'Tamansari', 'Pulomerak', '05/04', NULL),
(36, 'TPS 030 Kp. Baru', 'Lingkungan Baru', 'Tamansari', 'Pulomerak', '06/04', NULL),
(37, 'TPS 031 Kp. Baru', 'Lingkungan Baru', 'Tamansari', 'Pulomerak', '06/04', NULL),
(38, 'TPS 032 Kp. Baru', 'Lingkungan Baru', 'Tamansari', 'Pulomerak', '07/04', NULL),
(39, 'TPS 033 Sudimampir', 'Lingkungan Sudimampir', 'Tamansari', 'Pulomerak', '01/05', NULL),
(40, 'TPS 034 Sudimampir', 'Lingkungan Sudimampir', 'Tamansari', 'Pulomerak', '02/05', NULL),
(43, 'TPS 035 Medaksa Sebrang', 'Lingkungan Medaksa Sebrang', 'Tamansari', 'Pulomerak', '04/05', NULL),
(44, 'TPS 036 Medaksa Sebrang', 'Lingkungan Medaksa Sebrang', 'Tamansari', 'Pulomerak', '05/05', NULL),
(45, 'TPS 037 Medaksa Sebrang', 'Lingkungan Medaksa Sebrang', 'Tamansari', 'Pulomerak', '04/05', NULL),
(46, 'TPS 038 Sumurjaya', 'Lingkungan Sumurjaya', 'Tamansari', 'Pulomerak', '01/06', NULL),
(47, 'TPS 039 Sumurjaya', 'Lingkungan Sumurjaya', 'Tamansari', 'Pulomerak', '01/06', NULL),
(48, 'TPS 040 Sumurjaya', 'Lingkungan Sumurjaya', 'Tamansari', 'Pulomerak', '02/06', NULL),
(49, 'TPS 041 Sumurjaya', 'Lingkungan Sumurjaya', 'Tamansari', 'Pulomerak', '02/06', NULL),
(50, 'TPS 042 Sumurjaya', 'Lingkungan Sumurjaya', 'Tamansari', 'Pulomerak', '03/06', NULL),
(51, 'TPS 043 Sumurjaya', 'Lingkungan Sumurjaya', 'Tamansari', 'Pulomerak', '04/06', NULL),
(52, 'TPS 044 Sumurjaya', 'Lingkungan Sumurjaya', 'Tamansari', 'Pulomerak', '04/06', NULL),
(53, 'TPS 045 Langon Indah', 'Lingkungan Langon Indah', 'Tamansari', 'Pulomerak', '05/06', NULL),
(54, 'TPS 046 Langon Indah', 'Lingkungan Langon Indah', 'Tamansari', 'Pulomerak', '05/06', NULL),
(55, 'TPS 001 Medaksa', 'Lingkungan Medaksa', 'Mekarsari', 'Pulomerak', '01/01', NULL),
(56, 'TPS 002 Medaksa', 'Lingkungan Medaksa', 'Mekarsari', 'Pulomerak', '03/01', NULL),
(57, 'TPS 003 Medaksa', 'Lingkungan Medaksa', 'Mekarsari', 'Pulomerak', '02/01', NULL),
(58, 'TPS 004 Gamblang', 'Lingkungan Gamblang', 'Mekarsari', 'Pulomerak', '04/01', NULL),
(59, 'TPS 005 Sukarela', 'Lingkungan Sukarela', 'Mekarsari', 'Pulomerak', '06/01', NULL),
(60, 'TPS 006 Langon I', 'Lingkungan Langon I', 'Mekarsari', 'Pulomerak', '05/01', NULL),
(61, 'TPS 007 Langon I', 'Lingkungan Langon I', 'Mekarsari', 'Pulomerak', '05/01', NULL),
(62, 'TPS 008 Langonsari', 'Lingkungan Langonsari', 'Mekarsari', 'Pulomerak', '07/01', NULL),
(63, 'TPS 009 Langon II', 'Lingkungan Langon II', 'Mekarsari', 'Pulomerak', '04/05', NULL),
(64, 'TPS 010 Langon II', 'Lingkungan Langon II', 'Mekarsari', 'Pulomerak', '03/05', NULL),
(65, 'TPS 011 Langon III', 'Lingkungan Langon III', 'Mekarsari', 'Pulomerak', '01/05', NULL),
(66, 'TPS 012 Ciporong', 'Lingkungan Ciporong', 'Mekarsari', 'Pulomerak', '03/04', NULL),
(67, 'TPS 013 Tembulun', 'Lingkungan Tembulun', 'Mekarsari', 'Pulomerak', '01/04', NULL),
(68, 'TPS 014 Tembulun', 'Lingkungan Tembulun', 'Mekarsari', 'Pulomerak', '01/04', NULL),
(69, 'TPS 015 Gunung Batur I', 'Lingkungan Gunung Batur I', 'Mekarsari', 'Pulomerak', '01/03', NULL),
(70, 'TPS 016 Gunung Batur I', 'Lingkungan Gunung Batur I', 'Mekarsari', 'Pulomerak', '01/03', NULL),
(71, 'TPS 017 Gunung Batur II', 'Lingkungan Gunung Batur II', 'Mekarsari', 'Pulomerak', '02/03', NULL),
(72, 'TPS 018 Gunung Batur II', 'Lingkungan Gunung Batur II', 'Mekarsari', 'Pulomerak', '02/03', NULL),
(73, 'TPS 019 Mekarjaya', 'Lingkungan Mekarjaya', 'Mekarsari', 'Pulomerak', '01/07', NULL),
(74, 'TPS 020 Mekarjaya', 'Lingkungan Mekarjaya', 'Mekarsari', 'Pulomerak', '01/07', NULL),
(75, 'TPS 021 Kp. Serut', 'Lingkungan Serut', 'Mekarsari', 'Pulomerak', '02/07', NULL),
(76, 'TPS 022 Sukamulya', 'Lingkungan Sukamulya', 'Mekarsari', 'Pulomerak', '03/07', NULL),
(77, 'TPS 023 Sukamulya', 'Lingkungan Sukamulya', 'Mekarsari', 'Pulomerak', '03/07', NULL),
(78, 'TPS 024 Mekarmulya', 'Lingkungan Mekarmulya', 'Mekarsari', 'Pulomerak', '05/07', NULL),
(79, 'TPS 025 Sukahurip', 'Lingkungan Sukahurip', 'Mekarsari', 'Pulomerak', '04/07', NULL),
(80, 'TPS 026 Sukajadi', 'Lingkungan Sukajadi', 'Mekarsari', 'Pulomerak', '06/02', NULL),
(81, 'TPS 027 Sukajadi', 'Lingkungan Sukajadi', 'Mekarsari', 'Pulomerak', '02/02', NULL),
(82, 'TPS 028 Sukajadi', 'Lingkungan Sukajadi', 'Mekarsari', 'Pulomerak', '02/02', NULL),
(83, 'TPS 029 Sukajadi', 'Lingkungan Sukajadi', 'Mekarsari', 'Pulomerak', '01/02', NULL),
(84, 'TPS 030 Sukajadi', 'Lingkungan Sukajadi', 'Mekarsari', 'Pulomerak', '04/02', NULL),
(85, 'TPS 031 Sukajadi', 'Lingkungan Sukajadi', 'Mekarsari', 'Pulomerak', '05/02', NULL),
(86, 'TPS 032 Sukajadi', 'Lingkungan Sukajadi', 'Mekarsari', 'Pulomerak', '05/02', NULL),
(87, 'TPS 033 Sukajadi', 'Lingkungan Sukajadi', 'Mekarsari', 'Pulomerak', '03/02', NULL),
(88, 'TPS 034 Sukajadi', 'Lingkungan Sukajadi', 'Mekarsari', 'Pulomerak', '03/02', NULL),
(89, 'TPS 035 Sukamaju', 'Lingkungan Sukamaju', 'Mekarsari', 'Pulomerak', '06/06', NULL),
(90, 'TPS 036 Sukamaju', 'Lingkungan Sukamaju', 'Mekarsari', 'Pulomerak', '06/06', NULL),
(91, 'TPS 037 Sukamaju', 'Lingkungan Sukamaju', 'Mekarsari', 'Pulomerak', '01/06', NULL),
(92, 'TPS 038 Sukamaju', 'Lingkungan Sukamaju', 'Mekarsari', 'Pulomerak', '01/06', NULL),
(93, 'TPS 039 Sukasari', 'Lingkungan Sukasari', 'Mekarsari', 'Pulomerak', '02/06', NULL),
(94, 'TPS 040 Kp. Baru', 'Lingkungan Baru', 'Mekarsari', 'Pulomerak', '04/06', NULL),
(95, 'TPS 041 Sukajaya', 'Lingkungan Sukajaya', 'Mekarsari', 'Pulomerak', '03/06', NULL),
(96, 'TPS 001 Kebon Pisang', 'Lingkungan Kebon Pisang', 'Lebak Gede', 'Pulomerak', '01/01', NULL),
(97, 'TPS 002 Pulorida', 'Lingkungan Pulorida', 'Lebak Gede', 'Pulomerak', '02/01', NULL),
(98, 'TPS 003 Pulorida', 'Lingkungan Pulorida', 'Lebak Gede', 'Pulomerak', '03/01', NULL),
(99, 'TPS 004 Ranca Pulorida', 'Lingkungan Ranca Pulorida', 'Lebak Gede', 'Pulomerak', '04/01', NULL),
(100, 'TPS 005 Sawah Pulorida', 'Lingkungan Sawah Pulorida', 'Lebak Gede', 'Pulomerak', '05/01', NULL),
(101, 'TPS 006 Temposo', 'Lingkungan Temposo', 'Lebak Gede', 'Pulomerak', '06/01', NULL),
(102, 'TPS 007 Sawah Pulorida', 'Lingkungan Sawah Pulorida', 'Lebak Gede', 'Pulomerak', '05/01', NULL),
(103, 'TPS 008 Kepindis', 'Lingkungan Kepindis', 'Lebak Gede', 'Pulomerak', '01/08', NULL),
(104, 'TPS 009 Kepindis', 'Lingkungan Kepindis', 'Lebak Gede', 'Pulomerak', '02/08', NULL),
(105, 'TPS 010 Sekong', 'Lingkungan Sekong', 'Lebak Gede', 'Pulomerak', '01/02', NULL),
(106, 'TPS 011 Sekong', 'Lingkungan Sekong', 'Lebak Gede', 'Pulomerak', '01/02', NULL),
(107, 'TPS 012 Tanjung Sekong', 'Lingkungan Tanjung Sekong', 'Lebak Gede', 'Pulomerak', '02/02', NULL),
(108, 'TPS 013 Sabrang', 'Lingkungan Sabrang', 'Lebak Gede', 'Pulomerak', '01/07', NULL),
(109, 'TPS 014 Sabrang', 'Lingkungan Sabrang', 'Lebak Gede', 'Pulomerak', '01/07', NULL),
(110, 'TPS 015 Sabrang', 'Lingkungan Sabrang', 'Lebak Gede', 'Pulomerak', '03/07', NULL),
(111, 'TPS 016 Sumur Bambu', 'Lingkungan Sumur Bambu', 'Lebak Gede', 'Pulomerak', '04/07', NULL),
(112, 'TPS 017 Sabrang Dopal', 'Lingkungan Sabrang Dopal', 'Lebak Gede', 'Pulomerak', '05/07', NULL),
(113, 'TPS 018 Kp. Baru II', 'Lingkungan Baru II', 'Lebak Gede', 'Pulomerak', '01/06', NULL),
(114, 'TPS 019 Kp. Baru II', 'Lingkungan Baru II', 'Lebak Gede', 'Pulomerak', '02/06', NULL),
(115, 'TPS 020 Kp. Baru II', 'Lingkungan Baru II', 'Lebak Gede', 'Pulomerak', '04/06', NULL),
(116, 'TPS 021 Kp. Baru I', 'Lingkungan Baru I', 'Lebak Gede', 'Pulomerak', '01/04', NULL),
(117, 'TPS 022 Kp. Baru I', 'Lingkungan Baru I', 'Lebak Gede', 'Pulomerak', '02/04', NULL),
(118, 'TPS 023 Kp. Baru I', 'Lingkungan Baru I', 'Lebak Gede', 'Pulomerak', '04/04', NULL),
(119, 'TPS 024 Kp. Baru I', 'Lingkungan Baru I', 'Lebak Gede', 'Pulomerak', '05/04', NULL),
(120, 'TPS 025 Lebak Gede', 'Lingkungan Lebak Gede', 'Lebak Gede', 'Pulomerak', '01/03', NULL),
(121, 'TPS 026 Lebak Gede', 'Lingkungan Lebak Gede', 'Lebak Gede', 'Pulomerak', '02/03', NULL),
(122, 'TPS 027 Lebak Gede', 'Lingkungan Lebak Gede', 'Lebak Gede', 'Pulomerak', '03/03', NULL),
(123, 'TPS 028 Cereme', 'Lingkungan Cereme', 'Lebak Gede', 'Pulomerak', '05/03', NULL),
(124, 'TPS 029 Kp. Sawah', 'Lingkungan Sawah', 'Lebak Gede', 'Pulomerak', '06/03', NULL),
(125, 'TPS 030 Sawah Belgia', 'Lingkungan Sawah Belgia', 'Lebak Gede', 'Pulomerak', '07/03', NULL),
(126, 'TPS 031 Lebak Indah', 'Lingkungan Lebak Indah', 'Lebak Gede', 'Pulomerak', '01/09', NULL),
(127, 'TPS 032 Lebak Indah', 'Lingkungan Lebak Indah', 'Lebak Gede', 'Pulomerak', '02/09', NULL),
(128, 'TPS 033 Komp. PLN', 'Komplek PLN Lebak Gede', 'Lebak Gede', 'Pulomerak', '03/09', NULL),
(129, 'TPS 034 Wilulang', 'Lingkungan Wilulang', 'Lebak Gede', 'Pulomerak', '04/09', NULL),
(130, 'TPS 035 Wilulang', 'Lingkungan Wilulang', 'Lebak Gede', 'Pulomerak', '05/09', NULL),
(131, 'TPS 036 Kelapa Baris', 'Lingkungan Kelapa Baris', 'Lebak Gede', 'Pulomerak', '06/09', NULL),
(132, 'TPS 037 Kelapa Baris', 'Lingkungan Kelapa Baris', 'Lebak Gede', 'Pulomerak', '07/09', NULL),
(133, 'TPS 038 Cipala', 'Lingkungan Cipala', 'Lebak Gede', 'Pulomerak', '01/05', NULL),
(134, 'TPS 039 Cipala', 'Lingkungan Cipala', 'Lebak Gede', 'Pulomerak', '02/05', NULL),
(135, 'TPS 040 Cipala', 'Lingkungan Cipala', 'Lebak Gede', 'Pulomerak', '03/05', NULL),
(136, 'TPS 041 Gunung Penawen', 'Lingkungan Gunung Penawen', 'Lebak Gede', 'Pulomerak', '05/05', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_traffic`
--

CREATE TABLE `tb_traffic` (
  `id_traffic` int(11) NOT NULL,
  `jml_vote` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `jam` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_voters`
--

CREATE TABLE `tb_voters` (
  `id_voters` int(11) NOT NULL,
  `nama_voters` varchar(100) NOT NULL,
  `nik_voters` int(17) NOT NULL,
  `usia` int(4) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `rt` varchar(5) NOT NULL,
  `rw` varchar(5) NOT NULL,
  `desa` varchar(50) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `id_saksi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_voters`
--

INSERT INTO `tb_voters` (`id_voters`, `nama_voters`, `nik_voters`, `usia`, `alamat`, `rt`, `rw`, `desa`, `kecamatan`, `kota`, `no_hp`, `id_saksi`) VALUES
(5, 'Indra Maulana', 1231321, 24, 'Jl. K.H. Mustofa No.1, Banjar, Kec. Banjar, Kota Banjar, Jawa Barat 46311', '06', '04', 'Banjar', 'Beji', 'Banjar', '34353453', 9),
(6, 'Fulan', 1234567890, 30, 'Lingkungan Sukasenang', '03', '01', 'Tamansari', 'Pulomerak', 'Cilegon', '08170200702', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_vote_caleg`
--

CREATE TABLE `tb_vote_caleg` (
  `id_saksi` int(11) NOT NULL,
  `id_tps` int(11) NOT NULL,
  `jml_vote` int(11) NOT NULL,
  `jam` varchar(15) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_vote_parpol`
--

CREATE TABLE `tb_vote_parpol` (
  `id_saksi` int(11) NOT NULL,
  `id_tps` int(11) NOT NULL,
  `id_parpol` int(11) NOT NULL,
  `jml_vote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama_caleg` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_role` int(11) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `foto_caleg` varchar(50) DEFAULT NULL,
  `id_parpol` int(11) DEFAULT NULL,
  `wilayah` varchar(100) DEFAULT NULL,
  `id_kor` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nik`, `nama_caleg`, `email`, `password`, `id_role`, `alamat`, `no_hp`, `foto_caleg`, `id_parpol`, `wilayah`, `id_kor`, `remember_token`) VALUES
(1, '12345', 'Indra Maulana', 'inmaulana09@gmail.com', '$2y$10$tYDNKxvfRj9UbyZv1MNf2e5lKJXU51Dc8z8hqPJGTxUduIciP1T06', 2, 'Banjar', '09898879', '', NULL, '', NULL, NULL),
(13, '005', 'Ades Asido', 'ades@gmail.com', '$2y$12$rg96dEv/XYfJKvmaTmoIb.sWUIo2ng2B561s8zBOEcrZEpEGnCo/K', 1, 'Gerogl', '081219366664', '005.png', 4, NULL, NULL, NULL),
(14, '3672031507860002', 'Asep Candra Kombara', 'asepcandra@gmail.com', '$2y$12$luvm.StrLHi8R2qn/VEeH.fR11l0Q3BmmYOpq/A.uHpkGhVCn59uW', 5, 'Lingkungan Baru 1 RT 004 RW 004, Lebak Gede, Pulomerak, Cilegon', '087877561161', '3672031507860002.jpeg', 4, 'Pulomerak', 13, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_parpol`
--
ALTER TABLE `tb_parpol`
  ADD PRIMARY KEY (`id_parpol`);

--
-- Indeks untuk tabel `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `tb_saksi`
--
ALTER TABLE `tb_saksi`
  ADD PRIMARY KEY (`id_saksi`);

--
-- Indeks untuk tabel `tb_tps`
--
ALTER TABLE `tb_tps`
  ADD PRIMARY KEY (`id_tps`);

--
-- Indeks untuk tabel `tb_traffic`
--
ALTER TABLE `tb_traffic`
  ADD PRIMARY KEY (`id_traffic`);

--
-- Indeks untuk tabel `tb_voters`
--
ALTER TABLE `tb_voters`
  ADD PRIMARY KEY (`id_voters`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_parpol`
--
ALTER TABLE `tb_parpol`
  MODIFY `id_parpol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_saksi`
--
ALTER TABLE `tb_saksi`
  MODIFY `id_saksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tb_tps`
--
ALTER TABLE `tb_tps`
  MODIFY `id_tps` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT untuk tabel `tb_traffic`
--
ALTER TABLE `tb_traffic`
  MODIFY `id_traffic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_voters`
--
ALTER TABLE `tb_voters`
  MODIFY `id_voters` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
