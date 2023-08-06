-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Agu 2023 pada 18.08
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `kode_buku` varchar(10) NOT NULL,
  `ISBN` varchar(30) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` text NOT NULL,
  `penulis` varchar(150) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `lemari` varchar(100) NOT NULL,
  `rak` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id`, `kode_buku`, `ISBN`, `judul`, `deskripsi`, `gambar`, `penulis`, `penerbit`, `lemari`, `rak`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'BK_000001', '1600018015', 'Komik Doraemon', 'Komik Seru', 'IMG_20230119_172200_587.jpg', 'Fujiko F. Fujio', 'Gramedia', '', '', '2023-01-24 00:45:42', '2023-01-24 00:45:42', NULL),
(3, 'BK_000003', '1600018016', 'Komik Naruto', 'Komik Seru Juga', 'IMG_20230119_172200_5871.jpg', 'Mashasi Kisimoto', 'Gramedia', '', '', '2023-01-24 00:47:34', '2023-01-24 00:47:34', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bukutamu`
--

CREATE TABLE `bukutamu` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `profesi` varchar(50) NOT NULL,
  `instansi` varchar(255) NOT NULL COMMENT 'Instansi / Nama Sekolah / Lainnya',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bukutamu`
--

INSERT INTO `bukutamu` (`id`, `nama`, `profesi`, `instansi`, `created_at`) VALUES
(1, 'MUHAMMAD INSAN KAMIL', 'KARYAWAN', 'JATIS MOBILE', '2023-01-01 21:14:20'),
(2, 'raihan', 'PELAJAR', 'uniska', '2023-01-24 01:17:01'),
(3, 'BITE OFF', 'WIRAUSAHA', 'PT MERDEKA', '2023-01-30 19:22:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bukutamu_membership`
--

CREATE TABLE `bukutamu_membership` (
  `id` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bukutamu_membership`
--

INSERT INTO `bukutamu_membership` (`id`, `id_member`, `created_at`) VALUES
(1, 4, '2023-01-25 16:18:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ketersediaan`
--

CREATE TABLE `ketersediaan` (
  `id` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ketersediaan`
--

INSERT INTO `ketersediaan` (`id`, `id_buku`, `stok`) VALUES
(1, 1, 21),
(2, 3, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_buku_kembali`
--

CREATE TABLE `log_buku_kembali` (
  `id` int(11) NOT NULL,
  `kode_buku` varchar(10) NOT NULL,
  `kode_member` varchar(10) NOT NULL,
  `log_buku_pinjam_id` int(11) NOT NULL,
  `terlambat` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `log_buku_kembali`
--

INSERT INTO `log_buku_kembali` (`id`, `kode_buku`, `kode_member`, `log_buku_pinjam_id`, `terlambat`, `created_at`, `updated_at`) VALUES
(2, 'BK_000004', 'MB_000001', 2, 0, '2023-01-18 08:51:12', '2023-01-18 08:51:12'),
(3, 'BK_000001', 'MB_000004', 4, 0, '2023-02-19 18:13:44', '2023-02-19 18:13:44'),
(4, 'BK_000003', 'MB_000004', 5, 0, '2023-02-19 18:13:49', '2023-02-19 18:13:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_buku_pinjam`
--

CREATE TABLE `log_buku_pinjam` (
  `id` int(11) NOT NULL,
  `kode_buku` varchar(10) NOT NULL,
  `kode_member` varchar(10) NOT NULL,
  `batas_pinjam` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `log_buku_pinjam`
--

INSERT INTO `log_buku_pinjam` (`id`, `kode_buku`, `kode_member`, `batas_pinjam`, `created_at`, `updated_at`) VALUES
(3, 'BK_000003', 'MB_000004', '2023-01-30 00:00:00', '2023-01-24 00:49:24', '2023-01-24 00:49:24'),
(4, 'BK_000001', 'MB_000004', '2023-02-26 00:00:00', '2023-02-19 18:13:34', '2023-02-19 18:13:34'),
(5, 'BK_000003', 'MB_000004', '2023-02-26 00:00:00', '2023-02-19 18:13:38', '2023-02-19 18:13:38'),
(6, 'BK_000003', 'MB_000004', '2023-02-26 00:00:00', '2023-02-19 18:13:59', '2023-02-19 18:13:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `membership`
--

CREATE TABLE `membership` (
  `id` int(11) NOT NULL,
  `kode_member` varchar(10) NOT NULL,
  `nama_lengkap` varchar(150) NOT NULL,
  `no_identitas` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `nomor_hp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `membership`
--

INSERT INTO `membership` (`id`, `kode_member`, `nama_lengkap`, `no_identitas`, `alamat`, `nomor_hp`, `email`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'MB_000004', 'muhammad raihan', '19630216', 'banjarmasin', '08123123123', 'tester1231@gmail.com', '2023-01-23 00:58:37', '2023-01-23 00:58:37', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_users`
--

CREATE TABLE `role_users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_petugas` varchar(150) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_petugas`, `role_id`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', '$2y$10$fb/1IFwOcG9.jFBaH5CHpeZZ68hc/V1C9mwuSPZ0hO4qcqrhsGPZ2', 'Tara Arts', 1, 1, '2023-01-24 01:25:43', '2023-01-24 01:25:43', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bukutamu`
--
ALTER TABLE `bukutamu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bukutamu_membership`
--
ALTER TABLE `bukutamu_membership`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_member` (`id_member`);

--
-- Indeks untuk tabel `ketersediaan`
--
ALTER TABLE `ketersediaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indeks untuk tabel `log_buku_kembali`
--
ALTER TABLE `log_buku_kembali`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_buku_pinjam_id` (`log_buku_pinjam_id`);

--
-- Indeks untuk tabel `log_buku_pinjam`
--
ALTER TABLE `log_buku_pinjam`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `bukutamu`
--
ALTER TABLE `bukutamu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `bukutamu_membership`
--
ALTER TABLE `bukutamu_membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `ketersediaan`
--
ALTER TABLE `ketersediaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `log_buku_kembali`
--
ALTER TABLE `log_buku_kembali`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `log_buku_pinjam`
--
ALTER TABLE `log_buku_pinjam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `membership`
--
ALTER TABLE `membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `role_users`
--
ALTER TABLE `role_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bukutamu_membership`
--
ALTER TABLE `bukutamu_membership`
  ADD CONSTRAINT `bukutamu_membership_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `membership` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
