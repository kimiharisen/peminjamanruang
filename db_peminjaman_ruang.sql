-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2026 at 01:08 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_peminjaman_ruang`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_09_193219_create_peminjams_table', 1),
(5, '2026_05_09_193227_create_ruangs_table', 1),
(6, '2026_05_09_193237_create_peralatans_table', 1),
(7, '2026_05_09_193242_create_peminjamen_table', 1),
(8, '2026_05_09_193248_create_peminjaman_peralatan_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `peminjamans`
--

CREATE TABLE `peminjamans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `peminjam_id` bigint(20) UNSIGNED NOT NULL,
  `ruang_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `tanggal_pakai` date NOT NULL,
  `durasi_jam` int(11) NOT NULL,
  `status` enum('menunggu','disetujui','ditolak','selesai') NOT NULL DEFAULT 'menunggu',
  `waktu_pengembalian_aktual` datetime DEFAULT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjamans`
--

INSERT INTO `peminjamans` (`id`, `peminjam_id`, `ruang_id`, `tanggal_pengajuan`, `tanggal_pakai`, `durasi_jam`, `status`, `waktu_pengembalian_aktual`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '2026-05-09', '2026-05-10', 2, 'disetujui', NULL, 'Meminjam lab komputer untuk keperluan SU', '2026-05-09 13:51:04', '2026-05-09 13:54:27'),
(2, 2, 2, '2026-05-09', '2026-05-10', 3, 'selesai', '2026-05-10 04:07:00', 'Mengajar di Kelas ini', '2026-05-09 13:52:46', '2026-05-09 14:07:31'),
(3, 4, 4, '2026-05-09', '2026-05-17', 4, 'menunggu', NULL, 'pinjem parkiran', '2026-05-09 14:25:13', '2026-05-09 14:25:13');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_peralatan`
--

CREATE TABLE `peminjaman_peralatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `peminjaman_id` bigint(20) UNSIGNED NOT NULL,
  `peralatan_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjaman_peralatan`
--

INSERT INTO `peminjaman_peralatan` (`id`, `peminjaman_id`, `peralatan_id`, `jumlah`, `created_at`, `updated_at`) VALUES
(2, 1, 3, 2, '2026-05-09 13:51:04', '2026-05-09 13:51:15'),
(3, 1, 1, 1, '2026-05-09 13:51:04', '2026-05-09 13:51:15'),
(4, 2, 4, 3, '2026-05-09 13:52:46', '2026-05-09 13:52:46'),
(5, 3, 2, 1, '2026-05-09 14:25:13', '2026-05-09 14:25:13'),
(6, 3, 4, 1, '2026-05-09 14:25:13', '2026-05-09 14:25:13');

-- --------------------------------------------------------

--
-- Table structure for table `peminjams`
--

CREATE TABLE `peminjams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `nomor_hp` varchar(255) NOT NULL,
  `jenis_akun` enum('mahasiswa','dosen') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjams`
--

INSERT INTO `peminjams` (`id`, `nama`, `nim`, `nomor_hp`, `jenis_akun`, `created_at`, `updated_at`) VALUES
(1, 'Budi Santoso', '0106012210001', '081234567890', 'mahasiswa', '2026-05-09 12:58:31', '2026-05-09 13:21:59'),
(2, 'Dosen Pertama', '198705112020', '081298765432', 'dosen', '2026-05-09 12:58:31', '2026-05-09 13:21:17'),
(4, 'Kimi Harisen', '0706012210019', '081311113333', 'mahasiswa', '2026-05-09 13:21:01', '2026-05-09 13:21:01'),
(5, 'Mahasiswa Tumbal', '0706012210091', '081555444333', 'mahasiswa', '2026-05-09 13:22:54', '2026-05-09 13:23:54');

-- --------------------------------------------------------

--
-- Table structure for table `peralatans`
--

CREATE TABLE `peralatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nama_peralatan` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peralatans`
--

INSERT INTO `peralatans` (`id`, `kode`, `nama_peralatan`, `stok`, `kategori`, `created_at`, `updated_at`) VALUES
(1, '001', 'Projektor Epson', 3, 'Projektor', '2026-05-09 12:58:31', '2026-05-09 13:36:48'),
(2, '002', 'Kamera Sony', 2, 'Kamera', '2026-05-09 12:58:31', '2026-05-09 13:37:04'),
(3, '003', 'Mic Wireless', 4, 'Audio', '2026-05-09 12:58:31', '2026-05-09 13:37:17'),
(4, '004', 'TV LG', 3, 'TV', '2026-05-09 13:37:49', '2026-05-09 13:37:49');

-- --------------------------------------------------------

--
-- Table structure for table `ruangs`
--

CREATE TABLE `ruangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_ruang` varchar(255) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `gedung` varchar(255) NOT NULL,
  `lantai` int(11) NOT NULL,
  `status_ketersediaan` enum('tersedia','tidak_tersedia') NOT NULL DEFAULT 'tersedia',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ruangs`
--

INSERT INTO `ruangs` (`id`, `nama_ruang`, `kapasitas`, `gedung`, `lantai`, `status_ketersediaan`, `created_at`, `updated_at`) VALUES
(1, 'Lab Komputer A', 40, 'Gedung A', 2, 'tersedia', '2026-05-09 12:58:31', '2026-05-09 12:58:31'),
(2, 'Aula Utama', 150, 'Gedung B', 1, 'tersedia', '2026-05-09 12:58:31', '2026-05-09 12:58:31'),
(3, 'Ruang Rapat 301', 20, 'Gedung C', 3, 'tidak_tersedia', '2026-05-09 12:58:31', '2026-05-09 13:35:10'),
(4, 'Parkiran P14', 30, 'Gedung Parkiran', 7, 'tersedia', '2026-05-09 13:34:50', '2026-05-09 13:35:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin Sertifikasi', 'admin@example.com', '$2y$12$NJ9Ls/7Zbk1H/aDitWc8muETpCOGxEsR7P1y9De8zKwMc78/8lKxO', 'admin', '2026-05-09 12:58:30', '2026-05-09 12:58:30'),
(2, 'User Operator', 'user@example.com', '$2y$12$tqmebg0IbejVyDhcj1IBGOBhogsMegsSzPPswaJEBqdazEiZXKAEi', 'user', '2026-05-09 12:58:31', '2026-05-09 12:58:31'),
(3, 'Staff Akademik', 'staff@example.com', '$2y$12$3dMDYDHNwFp1usP2Gt5SmObZVGMM6N64ii2KEyx54oh3OzLTnzUxK', 'user', '2026-05-09 12:58:31', '2026-05-09 12:58:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjamans_peminjam_id_foreign` (`peminjam_id`),
  ADD KEY `peminjamans_ruang_id_foreign` (`ruang_id`);

--
-- Indexes for table `peminjaman_peralatan`
--
ALTER TABLE `peminjaman_peralatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjaman_peralatan_peminjaman_id_foreign` (`peminjaman_id`),
  ADD KEY `peminjaman_peralatan_peralatan_id_foreign` (`peralatan_id`);

--
-- Indexes for table `peminjams`
--
ALTER TABLE `peminjams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `peminjams_nim_unique` (`nim`);

--
-- Indexes for table `peralatans`
--
ALTER TABLE `peralatans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `peralatans_kode_unique` (`kode`);

--
-- Indexes for table `ruangs`
--
ALTER TABLE `ruangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `peminjamans`
--
ALTER TABLE `peminjamans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `peminjaman_peralatan`
--
ALTER TABLE `peminjaman_peralatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `peminjams`
--
ALTER TABLE `peminjams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `peralatans`
--
ALTER TABLE `peralatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ruangs`
--
ALTER TABLE `ruangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD CONSTRAINT `peminjamans_peminjam_id_foreign` FOREIGN KEY (`peminjam_id`) REFERENCES `peminjams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjamans_ruang_id_foreign` FOREIGN KEY (`ruang_id`) REFERENCES `ruangs` (`id`);

--
-- Constraints for table `peminjaman_peralatan`
--
ALTER TABLE `peminjaman_peralatan`
  ADD CONSTRAINT `peminjaman_peralatan_peminjaman_id_foreign` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjamans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjaman_peralatan_peralatan_id_foreign` FOREIGN KEY (`peralatan_id`) REFERENCES `peralatans` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
