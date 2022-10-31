-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Okt 2022 pada 23.27
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi_simpan_pinjam`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `nasabah`
--

CREATE TABLE `nasabah` (
  `id_nasabah` int(11) NOT NULL,
  `id_sekolah` int(11) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `saldo` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `kabupaten_id` int(11) DEFAULT NULL,
  `kecamatan_id` int(11) DEFAULT NULL,
  `desa_id` int(11) DEFAULT NULL,
  `tanggal_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id_pengaturan` int(11) NOT NULL,
  `tanggal_pembayaran` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengaturan`
--

INSERT INTO `pengaturan` (`id_pengaturan`, `tanggal_pembayaran`) VALUES
(1, '20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id_pinjaman` int(11) NOT NULL,
  `id_sekolah` int(11) NOT NULL,
  `id_nasabah` int(11) NOT NULL,
  `jumlah_simpan` varchar(100) NOT NULL,
  `jumlah_bunga` varchar(100) NOT NULL,
  `jumlah_tagihan_bulanan` varchar(100) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `waktu_pinjam` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sekolah`
--

CREATE TABLE `sekolah` (
  `id_sekolah` int(11) NOT NULL,
  `nama_sekolah` varchar(100) NOT NULL,
  `jenjang` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `kabupaten_id` int(11) DEFAULT NULL,
  `kecamatan_id` int(11) DEFAULT NULL,
  `desa_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `no_faktur` varchar(100) NOT NULL,
  `id_nasabah` int(11) NOT NULL,
  `id_pinjaman` int(11) NOT NULL,
  `tanggal_transaisi` date NOT NULL,
  `waktu_transaisi` time NOT NULL,
  `jumlah_tagihan` varchar(100) NOT NULL,
  `bunga` varchar(100) NOT NULL,
  `total_transaisi` varchar(100) NOT NULL,
  `total_bayar` varchar(100) NOT NULL,
  `bukti_pembayaran` varchar(100) DEFAULT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `waktu_pembayaran` time NOT NULL,
  `keterangan_transaisi` text NOT NULL,
  `status_pembayaran` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_tagihan`
--

CREATE TABLE `transaksi_tagihan` (
  `id_tagihan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `no_faktur` varchar(100) NOT NULL,
  `bulan` varchar(100) NOT NULL,
  `tahun` varchar(15) DEFAULT NULL,
  `jumlah_bayar` varchar(100) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `foto`, `created_at`, `updated_at`) VALUES
(4, 'admin', '$2y$10$A.TaGnWxDiZYn1nlE/TVJ.Y2NrtgaU7suPBMNow/LrhFKdnMIrKYi', 'SUPER_ADMIN', 'default.png', '2022-04-15 11:55:35', '2022-07-07 00:42:35'),
(69, 'egooktafanda97', 'password', 'NASABAH', 'default.jpg', '2022-09-29 09:28:07', '2022-09-29 09:28:07'),
(70, 'egooktafanda97x', 'password', 'NASABAH', 'default.jpg', '2022-09-29 09:28:18', '2022-09-29 09:28:18'),
(71, 'egooktafanda97xxx', 'password', 'NASABAH', 'default.jpg', '2022-09-29 09:28:21', '2022-09-29 09:28:21'),
(73, 'panji', 'password', 'NASABAH', 'default.jpg', '2022-09-29 09:28:24', '2022-09-29 09:28:24'),
(74, 'sefri', 'sefri', 'NASABAH', 'default.jpg', '2022-09-29 09:28:54', '2022-09-29 09:28:54');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indeks untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id_pinjaman`);

--
-- Indeks untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id_sekolah`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`no_faktur`);

--
-- Indeks untuk tabel `transaksi_tagihan`
--
ALTER TABLE `transaksi_tagihan`
  ADD PRIMARY KEY (`id_tagihan`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id_pinjaman` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id_sekolah` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi_tagihan`
--
ALTER TABLE `transaksi_tagihan`
  MODIFY `id_tagihan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
