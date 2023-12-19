-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Des 2023 pada 15.22
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sispilu`
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

--
-- Dumping data untuk tabel `tb_log`
--

INSERT INTO `tb_log` (`id_saksi`, `deskripsi`, `id`, `id_tps`, `jam`) VALUES
(0, '6 delete vote from 6 in 2', 6, 2, '09:54'),
(6, '6 delete vote 2 for 6 in 2', 6, 2, '09:56'),
(6, '6 delete vote from 6 in 2', 6, 2, '09:56');

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
(1, 'PDIP Depok', 'Jln. Sempu 1 No.7 Kel. Beji, Kec. Beji Kota Depok', '089663366710', 'PDIP Depok.png', 2);

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
(3, 'Parpol');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_saksi`
--

CREATE TABLE `tb_saksi` (
  `id_saksi` int(11) NOT NULL,
  `nik_ktp` varchar(20) NOT NULL,
  `nama_saksi` varchar(50) NOT NULL,
  `id_parpol` varchar(11) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `foto_saksi` varchar(50) DEFAULT NULL,
  `id_tps` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_saksi`
--

INSERT INTO `tb_saksi` (`id_saksi`, `nik_ktp`, `nama_saksi`, `id_parpol`, `alamat`, `no_hp`, `foto_saksi`, `id_tps`, `password`) VALUES
(3, '12345', 'Andri Mulyana', '1', 'Jln. Sempu 1 No.7 Kel. Beji, Kec. Beji Kota Depok', '082118471055', '12123.png', '1', '$2y$12$GH4baR9UVoKtlBbqYxQOb.HxwTR2lQgXBC2.oI2LjqLj/L2lr6Nw.'),
(5, '123456', 'Randa', '1', 'Jln. Sempu 1 No.7 Kel. Beji, Kec. Beji Kota Depok', '082118471055', '12123.png', '3', '$2y$12$ayuHlkUCXuWF3vqeHpSYxe1dCObke4WqeYCLlDcd8jgARB/rFqIm2'),
(6, '123457', 'Duda', '1', 'Jln. Sempu 1 No.7 Kel. Beji, Kec. Beji Kota Depok', '082118471055', '12123.png', '2', '$2y$12$aI/cvlcMZ6df9zYxVy6A5OP/wLz64/THV0teuIK3lbyGEwyXBAOJq'),
(7, '123458', 'Wajib', '1', 'Beji', '90032342909', '123458.png', '4', '$2y$12$aQUxjrxJgrqCCs222I86PODknfqm9mSUqG4tUlwbBVFoPtLeHNhZm'),
(8, '123459', 'INDRA M', '1', 'BEJI', '979878970', '123459.jpg', '5', '$2y$12$3LSGZGSCyKjzAifYSX/F0eUZMWqvs0LpEZhqkGrxCDYOOHSIrYNU.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tps`
--

CREATE TABLE `tb_tps` (
  `id_tps` int(11) NOT NULL,
  `nama_tps` varchar(20) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `desa` varchar(25) NOT NULL,
  `kecamatan` varchar(25) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `foto_bukti` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_tps`
--

INSERT INTO `tb_tps` (`id_tps`, `nama_tps`, `alamat`, `desa`, `kecamatan`, `lokasi`, `foto_bukti`) VALUES
(1, 'TPS 01', 'Grogol RT 03/08, Cilegon Barat', 'Grogol', 'Cilegon Barat', '-6.362709080711586, 106.8237540967312', '1.jpg'),
(2, 'TPS 02', 'Grogol RT 03/08, Cilegon Barat', 'Grogol', 'Cilegon Barat', '-6.362709080711586, 106.8237540967312', '2.jpg'),
(3, 'TPS 03', 'Grogol RT 03/08, Cilegon Barat', 'Grogol', 'Cilegon Barat', '-6.362709080711586, 106.8237540967312', '3.jpg'),
(4, 'TPS 04', 'Beji', 'Beji', 'Beji', '121231009, -213217390', NULL),
(5, 'TPS 05', 'Hawai', 'Hawai', 'Beji Timur', '-6.362709080711586, 106.8237540967312', NULL);

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

--
-- Dumping data untuk tabel `tb_traffic`
--

INSERT INTO `tb_traffic` (`id_traffic`, `jml_vote`, `id`, `jam`) VALUES
(1, 66, 6, '15'),
(2, 5, 6, '15'),
(3, 9, 6, '15'),
(4, 21, 6, '15'),
(5, 6, 6, '09:52'),
(6, 8, 6, '09:53'),
(7, 6, 6, '09:55'),
(8, 6, 6, '09:56');

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
  `no_hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_voters`
--

INSERT INTO `tb_voters` (`id_voters`, `nama_voters`, `nik_voters`, `usia`, `alamat`, `rt`, `rw`, `desa`, `kecamatan`, `kota`, `no_hp`) VALUES
(2, 'Indra Maulana', 80232901, 23, 'Jln. Sempu 1 No.7 Kel. Beji, Kec. Beji Kota Depok', '06', '04', 'Banjar', 'Banjar', 'Banjar', '089663366719');

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

--
-- Dumping data untuk tabel `tb_vote_caleg`
--

INSERT INTO `tb_vote_caleg` (`id_saksi`, `id_tps`, `jml_vote`, `jam`, `id`) VALUES
(8, 5, 4, '15:32', 6);

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
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nik`, `nama_caleg`, `email`, `password`, `id_role`, `alamat`, `no_hp`, `foto_caleg`, `id_parpol`, `remember_token`) VALUES
(1, '12345', 'Indra Maulana', 'inmaulana09@gmail.com', '$2y$10$tYDNKxvfRj9UbyZv1MNf2e5lKJXU51Dc8z8hqPJGTxUduIciP1T06', 2, 'Banjar', '09898879', '', NULL, NULL),
(2, '12346', 'Andri M', 'in@gmail.com', '$2y$10$tYDNKxvfRj9UbyZv1MNf2e5lKJXU51Dc8z8hqPJGTxUduIciP1T06', 1, '', '', '', 1, NULL),
(6, '112', 'Indra', 'in11@gmail.com', '$2y$12$rfsYZSKjIXL.NPOJD1UDle8/4sD4OmAfnM0j0rvbbMFlerv8PxeO2', 1, 'Banjar', '2342342', '112.jpg', 1, NULL);

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
  MODIFY `id_parpol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_saksi`
--
ALTER TABLE `tb_saksi`
  MODIFY `id_saksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_tps`
--
ALTER TABLE `tb_tps`
  MODIFY `id_tps` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_traffic`
--
ALTER TABLE `tb_traffic`
  MODIFY `id_traffic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_voters`
--
ALTER TABLE `tb_voters`
  MODIFY `id_voters` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
