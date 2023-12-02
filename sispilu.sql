-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 02 Des 2023 pada 09.16
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

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
-- Struktur dari tabel `tb_caleg`
--

CREATE TABLE `tb_caleg` (
  `nik` varchar(11) NOT NULL,
  `nama_caleg` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto_caleg` varchar(50) DEFAULT NULL,
  `id_role` int(11) NOT NULL,
  `id_parpol` varchar(11) NOT NULL
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
(1, 'PDIP CILEGON', 'Grogol, Cilegon Barat', '099087', '', 2),
(3, 'PDIP Depok', 'Jln. Sempu 1 No.7 Kel. Beji, Kec. Beji Kota Depok', '089663366710', 'PDIP Depok.png', 2);

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
(4, 'Parpol');

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
(3, '12123', 'Andri M', '1', 'Jln. Sempu 1 No.7 Kel. Beji, Kec. Beji Kota Depok', '082118471055', '12123.png', '1', '$2y$12$kptFNWVI4oqm/yvRTQJbbOAwidu3RVVuKAZX1L8Pi0.EfhSjm32WW');

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
  `lokasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_tps`
--

INSERT INTO `tb_tps` (`id_tps`, `nama_tps`, `alamat`, `desa`, `kecamatan`, `lokasi`) VALUES
(1, 'TPS 01', 'Grogol RT 03/08, Cilegon Barat', 'Grogol', 'Cilegon Barat', '-6.3592698110021155, 106.82927899924012');

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
  `rt` int(5) NOT NULL,
  `rw` int(5) NOT NULL,
  `kelurahan` varchar(50) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `kota` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_vote_caleg`
--

CREATE TABLE `tb_vote_caleg` (
  `id_saksi` int(11) NOT NULL,
  `id_tps` int(11) NOT NULL,
  `id_caleg` int(11) NOT NULL,
  `jml_vote` int(11) NOT NULL
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
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_role` int(11) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `id_role`, `remember_token`) VALUES
(1, 'Indra Maulana', 'inmaulana09@gmail.com', '$2y$10$tYDNKxvfRj9UbyZv1MNf2e5lKJXU51Dc8z8hqPJGTxUduIciP1T06', 2, NULL),
(2, 'Indra Maulana', 'in@gmail.com', '$2y$10$tYDNKxvfRj9UbyZv1MNf2e5lKJXU51Dc8z8hqPJGTxUduIciP1T06', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_caleg`
--
ALTER TABLE `tb_caleg`
  ADD PRIMARY KEY (`nik`);

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
  MODIFY `id_saksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_tps`
--
ALTER TABLE `tb_tps`
  MODIFY `id_tps` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_voters`
--
ALTER TABLE `tb_voters`
  MODIFY `id_voters` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
