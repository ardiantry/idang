-- --------------------------------------------------------
-- Host:                         localhost
-- Versi server:                 10.1.34-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win32
-- HeidiSQL Versi:               12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk db_idang
CREATE DATABASE IF NOT EXISTS `db_idang` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `db_idang`;

-- membuang struktur untuk table db_idang.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_idang.migrations: ~5 rows (lebih kurang)
INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2022_06_02_024522_tb_tamu', 1),
	(4, '2022_06_02_024945_tb_kondangan', 1),
	(5, '2022_06_02_030054_tb_chat', 1);

-- membuang struktur untuk table db_idang.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_idang.password_resets: ~0 rows (lebih kurang)

-- membuang struktur untuk table db_idang.tb_chat
CREATE TABLE IF NOT EXISTS `tb_chat` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_a` int(11) NOT NULL,
  `id_b` int(11) NOT NULL,
  `chat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_idang.tb_chat: ~2 rows (lebih kurang)
INSERT IGNORE INTO `tb_chat` (`id`, `id_a`, `id_b`, `chat`, `created_at`, `updated_at`) VALUES
	(9, 1, 6, 'test', '2022-06-02 23:04:19', '2022-06-02 23:04:19'),
	(10, 5, 6, 'Test', '2022-06-02 23:51:26', '2022-06-02 23:51:26');

-- membuang struktur untuk table db_idang.tb_kondangan
CREATE TABLE IF NOT EXISTS `tb_kondangan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_anggota` int(11) DEFAULT NULL,
  `nama_kondangan` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `status` enum('aktif','non_aktif') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_mulai` timestamp NULL DEFAULT NULL,
  `tgl_selesai` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_idang.tb_kondangan: ~2 rows (lebih kurang)
INSERT IGNORE INTO `tb_kondangan` (`id`, `id_anggota`, `nama_kondangan`, `foto`, `alamat`, `status`, `tgl_mulai`, `tgl_selesai`, `created_at`, `updated_at`) VALUES
	(3, 5, 'halal bi halal', '20220602090358.png', 'Test', 'aktif', '2022-06-02 02:01:00', '2022-06-02 04:17:00', '2022-06-02 02:03:58', '2022-06-02 02:48:58'),
	(4, 6, 'Kondangan A', '20220606041844.png', 'Desa A', 'aktif', '2022-06-06 03:00:00', '2022-06-06 06:00:00', '2022-06-05 21:18:44', '2022-06-05 21:18:43');

-- membuang struktur untuk table db_idang.tb_magang
CREATE TABLE IF NOT EXISTS `tb_magang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_barang` enum('beras','padi','uang') DEFAULT NULL,
  `jenis_magang` enum('pemasukan magang','pemasukan hutang','pengeluaran magang') DEFAULT NULL,
  `jenis_satuan` enum('kg','rp') DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel db_idang.tb_magang: ~0 rows (lebih kurang)

-- membuang struktur untuk table db_idang.tb_tamu
CREATE TABLE IF NOT EXISTS `tb_tamu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_undangan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nomor_hp` char(13) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `nama` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_idang.tb_tamu: ~4 rows (lebih kurang)
INSERT IGNORE INTO `tb_tamu` (`id`, `id_undangan`, `id_user`, `nomor_hp`, `nama`, `alamat`, `created_at`, `updated_at`) VALUES
	(1, 3, 0, '', 'idang', 'indramayu', '2022-06-02 02:44:48', '2022-06-02 02:44:48'),
	(2, 3, 0, '', 'fandi', 'fandi', '2022-06-03 01:13:36', '2022-06-03 01:13:36'),
	(3, 4, 6, '084545155125', 'tamu A', 'alamat A', '2022-06-05 21:26:07', '2022-06-05 21:26:07'),
	(4, 3, 5, '842122623222', 'Idang 1', 'indramayu', '2022-06-06 01:02:45', '2022-06-06 01:02:45');

-- membuang struktur untuk table db_idang.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_idang.users: ~2 rows (lebih kurang)
INSERT IGNORE INTO `users` (`id`, `name`, `email`, `username`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin@admin.com', 'admin', 'admin', NULL, '$2y$10$wMJ/Z4POzQBlSLii2am.HuDjLCIGEab.JH9oYGRS5Sxf0lVU9CKk.', NULL, NULL, NULL),
	(5, 'anggota', 'anggota@admin.com', 'anggota', 'user', NULL, '$2y$10$1yl/T5tZYtwAS3BqMfRl1O/mPCFqOgQYk42JiZUxW3yB5zJxwdcLK', NULL, '2022-06-01 23:24:05', '2022-06-01 23:24:05'),
	(6, 'anggota 2', 'anggota_2@gmail.com', 'anggota_2', 'user', NULL, '$2y$10$N9jU6KcAvcwGozcMLLHLSOc3SqewlP/y3Gog8VBEyCHhF2uH287xS', NULL, '2022-06-02 19:21:40', '2022-06-02 19:21:40');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
