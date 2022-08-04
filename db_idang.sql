-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2022 at 03:41 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_idang`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2022_06_02_024522_tb_tamu', 1),
(4, '2022_06_02_024945_tb_kondangan', 1),
(5, '2022_06_02_030054_tb_chat', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_chat`
--

CREATE TABLE `tb_chat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_a` int(11) NOT NULL,
  `id_b` int(11) NOT NULL,
  `chat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_chat`
--

INSERT INTO `tb_chat` (`id`, `id_a`, `id_b`, `chat`, `created_at`, `updated_at`) VALUES
(9, 1, 6, 'test', '2022-06-02 23:04:19', '2022-06-02 23:04:19'),
(10, 5, 6, 'Test', '2022-06-02 23:51:26', '2022-06-02 23:51:26');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kondangan`
--

CREATE TABLE `tb_kondangan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `nama_kondangan` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `status` enum('aktif','non_aktif') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_mulai` timestamp NULL DEFAULT NULL,
  `tgl_selesai` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_kondangan`
--

INSERT INTO `tb_kondangan` (`id`, `id_anggota`, `nama_kondangan`, `foto`, `alamat`, `status`, `tgl_mulai`, `tgl_selesai`, `created_at`, `updated_at`) VALUES
(3, 5, 'halal bi halalsdsdsd', '20220602090358.png', 'Testsdsdsd', 'aktif', '2022-06-02 02:01:00', '2022-06-02 04:17:00', '2022-06-02 02:03:58', '2022-07-25 02:31:56'),
(4, 6, 'Kondangan A', '20220606041844.png', 'Desa A', 'aktif', '2022-06-06 03:00:00', '2022-06-06 06:00:00', '2022-06-05 21:18:44', '2022-06-05 21:18:43'),
(5, 5, 'Hajatan', '20220725092310.png', 'Test', 'non_aktif', '2022-07-25 04:16:00', '2022-07-25 08:15:00', '2022-07-25 02:23:10', '2022-07-25 02:30:57');

-- --------------------------------------------------------

--
-- Table structure for table `tb_magang`
--

CREATE TABLE `tb_magang` (
  `id` int(11) NOT NULL,
  `jenis_barang` enum('beras','padi','uang') DEFAULT NULL,
  `jenis_magang` enum('pemasukan magang','pemasukan hutang','pengeluaran magang') DEFAULT NULL,
  `jenis_satuan` enum('kg','rp') DEFAULT NULL,
  `id_tamu` int(11) DEFAULT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `id_undangan` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_magang`
--

INSERT INTO `tb_magang` (`id`, `jenis_barang`, `jenis_magang`, `jenis_satuan`, `id_tamu`, `id_anggota`, `id_undangan`, `jumlah`, `created_at`, `updated_at`) VALUES
(17, 'beras', 'pemasukan hutang', 'kg', 6, 8, 3, 232, '2022-07-13 20:20:47', '2022-07-13 20:20:47'),
(18, 'uang', 'pemasukan hutang', 'rp', 6, 8, 4, 2323, '2022-07-13 20:21:36', '2022-07-13 20:21:36'),
(19, 'beras', 'pengeluaran magang', 'kg', 4, 8, 3, 12, '2022-07-13 20:23:33', '2022-07-13 20:23:33'),
(20, 'beras', 'pemasukan magang', 'kg', 6, 8, 3, 34, '2022-07-13 20:27:03', '2022-07-13 20:27:03'),
(21, 'beras', 'pemasukan hutang', 'kg', 4, 5, 3, 2323, '2022-07-25 01:15:29', '2022-07-25 01:15:29'),
(22, 'padi', 'pemasukan magang', 'kg', 4, 5, 3, 10, '2022-07-25 01:32:49', '2022-07-25 01:32:49'),
(23, 'uang', 'pemasukan hutang', 'rp', 4, 5, 3, 10, '2022-07-25 01:33:06', '2022-07-25 01:33:06'),
(24, 'beras', 'pengeluaran magang', 'kg', 5, 5, 3, 10, '2022-07-25 01:33:30', '2022-07-25 01:33:30'),
(25, 'beras', 'pengeluaran magang', 'kg', 6, 6, NULL, 2323, '2022-08-01 21:13:42', '2022-08-01 21:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `tb_masarakat`
--

CREATE TABLE `tb_masarakat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_undangan` int(11) DEFAULT NULL,
  `jenis_kelamin` enum('l','p') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `nomor_hp` char(13) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `nama` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_masarakat`
--

INSERT INTO `tb_masarakat` (`id`, `id_undangan`, `jenis_kelamin`, `id_user`, `nomor_hp`, `nama`, `alamat`, `created_at`, `updated_at`) VALUES
(3, 4, 'l', 1, '084545155125', 'tamu Aadadadad', 'alamat A', '2022-06-05 21:26:07', '2022-08-01 21:09:34'),
(4, 3, 'l', 5, '842122623222', 'Idang 1', 'indramayu', '2022-06-06 01:02:45', '2022-07-25 02:41:49'),
(5, NULL, 'p', 5, '544518451451', 'Idang', 'Test', '2022-06-06 02:32:38', '2022-07-25 02:40:33'),
(6, NULL, NULL, 8, '34534', 'adadad', 'adadad', '2022-07-13 20:16:27', '2022-07-13 20:16:27'),
(7, NULL, 'p', 1, 'adadfadad', 'tamu Aadadadad', 'adadada', '2022-08-01 21:09:40', '2022-08-01 21:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tamu`
--

CREATE TABLE `tb_tamu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_undangan` int(11) DEFAULT NULL,
  `jenis_kelamin` enum('l','p') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `nomor_hp` char(13) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `nama` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_tamu`
--

INSERT INTO `tb_tamu` (`id`, `id_undangan`, `jenis_kelamin`, `id_user`, `nomor_hp`, `nama`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, 0, '', 'idang', 'indramayu', '2022-06-02 02:44:48', '2022-06-02 02:44:48'),
(2, 3, NULL, 0, '', 'fandi', 'fandi', '2022-06-03 01:13:36', '2022-06-03 01:13:36'),
(4, 3, 'l', 5, '842122623222', 'Idang 1', 'indramayu', '2022-06-06 01:02:45', '2022-07-25 02:41:49'),
(5, NULL, 'p', 5, '544518451451', 'Idang', 'Test', '2022-06-06 02:32:38', '2022-07-25 02:40:33'),
(6, NULL, NULL, 8, '34534', 'adadad', 'adadad', '2022-07-13 20:16:27', '2022-07-13 20:16:27'),
(7, NULL, 'l', 6, 'adadadad', 'adadad', 'qeqeqeqe', '2022-08-01 21:10:44', '2022-08-01 21:10:44'),
(8, NULL, 'p', 6, 'rerer', 'qrqrqrqrq', 'qeqeqe', '2022-08-01 21:12:21', '2022-08-01 21:12:21');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tamu_magang`
--

CREATE TABLE `tb_tamu_magang` (
  `id` int(11) NOT NULL,
  `nama` char(50) DEFAULT NULL,
  `alamat` text,
  `tanggal` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_tamu_magang`
--

INSERT INTO `tb_tamu_magang` (`id`, `nama`, `alamat`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 'afandi', 'indramayua', '2022-06-07', '2022-06-07 01:24:21', '2022-06-07 01:58:22'),
(2, 'test', 'tedt 2', '2022-06-08', '2022-06-07 01:59:21', '2022-06-07 01:59:21'),
(3, 'terer', 'ererer', '2022-07-14', '2022-07-13 20:00:32', '2022-07-13 20:00:32'),
(4, 'adad', '232', '2022-07-14', '2022-07-13 20:23:33', '2022-07-13 20:23:33'),
(5, 'fgdg', 'dfdgd', '2022-07-25', '2022-07-25 01:33:30', '2022-07-25 01:33:30'),
(6, 'adsadad', 'adadad', '2022-08-02', '2022-08-01 21:13:42', '2022-08-01 21:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', 'admin', 'admin', NULL, '$2y$10$wMJ/Z4POzQBlSLii2am.HuDjLCIGEab.JH9oYGRS5Sxf0lVU9CKk.', NULL, NULL, NULL),
(5, 'anggota', 'anggota@admin.com', 'anggota', 'user', NULL, '$2y$10$1yl/T5tZYtwAS3BqMfRl1O/mPCFqOgQYk42JiZUxW3yB5zJxwdcLK', NULL, '2022-06-01 23:24:05', '2022-06-01 23:24:05'),
(6, 'anggota 2', 'anggota_2@gmail.com', 'anggota_2', 'user', NULL, '$2y$10$N9jU6KcAvcwGozcMLLHLSOc3SqewlP/y3Gog8VBEyCHhF2uH287xS', NULL, '2022-06-02 19:21:40', '2022-06-02 19:21:40'),
(7, 'arda', 'ardiansdr@gmail.com', 'ardian', 'user', NULL, '$2y$10$TCktKIlzBMIRdE2af5EUZ.de9v5JpvKGqts2d4.ocJCJaFlp7qh3y', NULL, '2022-06-07 21:26:42', '2022-06-07 21:26:42'),
(8, 'ardian', 'ardiansdr2@gmail.com', 'ardiantry', 'user', NULL, '$2y$10$JM8jF5j4/asqQiQDHyTDw.N.MmeltbSQZnlbj3PLgzbjS6I..p.Aq', NULL, '2022-07-13 20:00:05', '2022-07-13 20:00:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_chat`
--
ALTER TABLE `tb_chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kondangan`
--
ALTER TABLE `tb_kondangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_magang`
--
ALTER TABLE `tb_magang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_masarakat`
--
ALTER TABLE `tb_masarakat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tamu`
--
ALTER TABLE `tb_tamu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tamu_magang`
--
ALTER TABLE `tb_tamu_magang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_chat`
--
ALTER TABLE `tb_chat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_kondangan`
--
ALTER TABLE `tb_kondangan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_magang`
--
ALTER TABLE `tb_magang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tb_masarakat`
--
ALTER TABLE `tb_masarakat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_tamu`
--
ALTER TABLE `tb_tamu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_tamu_magang`
--
ALTER TABLE `tb_tamu_magang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
