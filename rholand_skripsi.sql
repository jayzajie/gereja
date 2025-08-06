-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Waktu pembuatan: 04 Agu 2025 pada 09.58
-- Versi server: 5.7.39
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rholand_skripsi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `baptisms`
--

CREATE TABLE `baptisms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_baptis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_jemaat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_anak` text COLLATE utf8mb4_unicode_ci,
  `nama_ayah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `umur_ayah` int(11) DEFAULT NULL,
  `gereja_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_ayah` text COLLATE utf8mb4_unicode_ci,
  `nama_ibu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `umur_ibu` int(11) DEFAULT NULL,
  `gereja_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_ibu` text COLLATE utf8mb4_unicode_ci,
  `tanggal_baptis` date NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dibaptis_oleh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_admin@gerejatoraja.com|127.0.0.1', 'i:1;', 1754229192),
('laravel_cache_admin@gerejatoraja.com|127.0.0.1:timer', 'i:1754229192;', 1754229192),
('laravel_cache_dinasprovinsi@dinas.com|127.0.0.1', 'i:1;', 1753878114),
('laravel_cache_dinasprovinsi@dinas.com|127.0.0.1:timer', 'i:1753878114;', 1753878114),
('laravel_cache_suryawijaya1147@gmail.com|127.0.0.1', 'i:1;', 1754229210),
('laravel_cache_suryawijaya1147@gmail.com|127.0.0.1:timer', 'i:1754229210;', 1754229210);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `calendar_events`
--

CREATE TABLE `calendar_events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `event_date` date NOT NULL,
  `event_time` time DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `calendar_events`
--

INSERT INTO `calendar_events` (`id`, `title`, `description`, `event_date`, `event_time`, `category`, `is_active`, `created_at`, `updated_at`) VALUES
(9, 'khusus ilham di baptism', 'asdsadsa', '2025-07-31', '01:01:00', 'acara', 1, '2025-07-30 05:02:19', '2025-07-30 05:02:19'),
(10, 'Ret-Ret Pengeurus', 'nnnnnn', '2025-08-05', '22:08:00', 'general', 1, '2025-08-03 06:02:28', '2025-08-03 06:02:28'),
(11, 'semua', 'bbbbb', '2025-08-13', '22:06:00', 'general', 1, '2025-08-03 06:03:00', '2025-08-03 06:03:00'),
(12, 'nmmnnmm', 'mmmm', '2025-08-22', '22:04:00', 'kegiatan', 1, '2025-08-03 06:03:13', '2025-08-03 06:03:13'),
(13, 'sddsjdsjdsd', 'dadada', '2025-08-28', '22:07:00', 'acara', 1, '2025-08-03 06:03:24', '2025-08-03 06:03:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `congregations`
--

CREATE TABLE `congregations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pastor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `email_verification_codes`
--

CREATE TABLE `email_verification_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'baptism',
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `expires_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `excel_files`
--

CREATE TABLE `excel_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `uploaded_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `excel_files`
--

INSERT INTO `excel_files` (`id`, `original_name`, `file_path`, `file_size`, `mime_type`, `description`, `status`, `uploaded_by`, `uploaded_at`, `created_at`, `updated_at`) VALUES
(1, 'inventory_2025-07-30_14-06-51.xlsx', 'excel-files/1753884441_inventory-2025-07-30-14-06-51.xlsx', '6684', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', NULL, 'active', 'dinasprovinsi@dinas.com', '2025-07-30 06:07:21', '2025-07-30 06:07:21', '2025-07-30 06:07:21'),
(2, 'inventory_2025-07-30_14-06-51.xlsx', 'excel-files/1754229682_inventory-2025-07-30-14-06-51.xlsx', '6684', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'nnmnmnmnmnm', 'active', 'Admin Gereja', '2025-08-03 06:01:22', '2025-08-03 06:01:22', '2025-08-03 06:01:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `information`
--

CREATE TABLE `information` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subcategory` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('draft','published','archived') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `priority` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'medium',
  `publish_date` date DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `information`
--

INSERT INTO `information` (`id`, `title`, `content`, `image`, `category`, `subcategory`, `status`, `priority`, `publish_date`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'Hero Section - Beranda', '<h1>Selamat Datang di Gereja Toraja Eben-Haezer Selili</h1>\n<p>Melayani dengan kasih dan ketulusan untuk kemuliaan Tuhan. Bergabunglah dengan keluarga besar kami dalam perjalanan iman.</p>\n<div class=\"hero-buttons\">\n    <a href=\"#about\" class=\"btn btn-primary\">Tentang Kami</a>\n    <a href=\"#contact\" class=\"btn btn-outline-light\">Hubungi Kami</a>\n</div>', NULL, 'home-setting', 'hero', 'published', 'high', '2025-07-30', 'Created by: Admin - Hero section untuk halaman utama', '2025-07-30 05:18:34', '2025-07-30 05:18:34'),
(2, 'About Section - Tentang Kami', '<h2>Tentang Gereja Kami</h2>\n<p>Gereja Toraja Eben-Haezer Selili adalah komunitas iman yang berkomitmen untuk melayani Tuhan dan sesama. Kami percaya bahwa setiap orang berharga di mata Tuhan dan memiliki tujuan yang mulia.</p>\n<div class=\"about-features\">\n    <div class=\"feature\">\n        <h4>🙏 Ibadah Bermakna</h4>\n        <p>Ibadah yang penuh makna dan menyentuh hati</p>\n    </div>\n    <div class=\"feature\">\n        <h4>👥 Komunitas Hangat</h4>\n        <p>Keluarga besar yang saling mendukung</p>\n    </div>\n    <div class=\"feature\">\n        <h4>📚 Pembelajaran Alkitab</h4>\n        <p>Mempelajari firman Tuhan bersama-sama</p>\n    </div>\n</div>', NULL, 'home-setting', 'about', 'published', 'high', '2025-07-30', 'Created by: Admin - About section untuk halaman utama', '2025-07-30 05:18:34', '2025-07-30 05:18:34'),
(3, 'Contact Section - Kontak', '<h2>Hubungi Kami</h2>\n<div class=\"contact-info\">\n    <div class=\"contact-item\">\n        <h4>📍 Alamat</h4>\n        <p>Jl. Lumba-Lumba, Selili, Kec. Samarinda Ilir, Samarinda, Kalimantan Timur 75251</p>\n    </div>\n    <div class=\"contact-item\">\n        <h4>📞 Telepon</h4>\n        <p>08135009713</p>\n    </div>\n    <div class=\"contact-item\">\n        <h4>✉️ Email</h4>\n        <p>ebenhaezerSelili@gmail.com</p>\n    </div>\n</div>', NULL, 'home-setting', 'contact', 'published', 'medium', '2025-07-30', 'Created by: Admin - Contact section untuk halaman utama', '2025-07-30 05:18:34', '2025-07-30 05:18:34'),
(4, 'Footer Section - Footer', '<div class=\"footer-content\">\n    <div class=\"footer-section\">\n        <h4>Gereja Toraja Eben-Haezer Selili</h4>\n        <p>Melayani dengan kasih dan ketulusan untuk kemuliaan Tuhan. Bergabunglah dengan keluarga besar kami dalam perjalanan iman.</p>\n    </div>\n    <div class=\"footer-section\">\n        <h4>Navigasi</h4>\n        <ul>\n            <li><a href=\"#home\">Beranda</a></li>\n            <li><a href=\"#about\">Tentang</a></li>\n            <li><a href=\"#services\">Pelayanan</a></li>\n            <li><a href=\"#contact\">Kontak</a></li>\n        </ul>\n    </div>\n    <div class=\"footer-section\">\n        <h4>Organisasi</h4>\n        <ul>\n            <li><a href=\"#\">PKBGT</a></li>\n            <li><a href=\"#\">PWGT</a></li>\n            <li><a href=\"#\">PPGT</a></li>\n            <li><a href=\"#\">SMGT</a></li>\n        </ul>\n    </div>\n</div>\n<div class=\"footer-bottom\">\n    <p>&copy; 2025 Gereja Toraja Eben-Haezer Selili. Semua hak dilindungi.</p>\n</div>', NULL, 'home-setting', 'footer', 'published', 'low', '2025-07-30', 'Created by: Admin - Footer section untuk halaman utama', '2025-07-30 05:18:34', '2025-07-30 05:18:34'),
(5, 'abcd', 'asasasas', 'information/1754229430_640px-Logo_Gereja_Toraja.png', 'kegiatan', 'special', 'published', 'medium', '2025-08-03', 'sasasasas', '2025-08-03 05:57:10', '2025-08-03 05:57:10'),
(6, 'KOMISI PELAYANAN, LITURGI & MULTIMEDIA (PLM)', 'Komisi: 1\n\n1. Ibadah Raya Hari Minggu\r\n2. Ibadah Kreatif (Dilaksanakan dua kali sebulan)\r\n3. Ibadah Berbahasa Toraja\r\n4. Ibadah Hari Raya Gerejawi : Tahun Baru, Epifani, Rabu Abu, Palmarum, Kamis Putih, Sabtu Sunyi, Jumat Agung, Paskah, Kenaikan Tuhan Yesus, Pentakosta, Natal, Akhir Tahun, Doa syukur Kemerdekaan, dan Hari Doa Alkitab\r\n5. Perayaan Paskah Jemaat\r\n\r\nCamp Paskah Klasis Kalimantan Timur & Tengah tahun 2025\r\n\r\nPerayaan Natal Jemaat', NULL, 'program-kerja', 'program-kerja', 'published', 'medium', '2025-08-03', NULL, '2025-08-03 05:58:16', '2025-08-03 07:06:53'),
(7, 'sasasa', 'Komisi: sa\n\nsasasasas', NULL, 'program-kerja', 'program-kerja', 'published', 'medium', '2025-08-03', NULL, '2025-08-03 06:31:43', '2025-08-03 06:31:43'),
(8, 'fffff', 'Komisi: 2\n\nffff', NULL, 'program-kerja', 'program-kerja', 'published', 'medium', '2025-08-03', NULL, '2025-08-03 06:51:29', '2025-08-03 06:51:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `jumlah` int(11) NOT NULL DEFAULT '0',
  `harga_satuan` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_nilai` decimal(15,2) NOT NULL DEFAULT '0.00',
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pcs',
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `tanggal_kadaluarsa` date DEFAULT NULL,
  `status` enum('tersedia','habis','rusak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tersedia',
  `supplier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `inventories`
--

INSERT INTO `inventories` (`id`, `nama_barang`, `kategori`, `deskripsi`, `jumlah`, `harga_satuan`, `total_nilai`, `satuan`, `lokasi`, `tanggal_masuk`, `tanggal_kadaluarsa`, `status`, `supplier`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 'aaaaa', 'benda', 'adadada', 2, '2000000.00', '4000000.00', 'pcs', 'gedung 1', '2025-07-30', '2025-07-31', 'tersedia', 'orang', 'aadada', '2025-07-30 06:06:41', '2025-07-30 06:06:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `marriages`
--

CREATE TABLE `marriages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_calon_pria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir_pria` date NOT NULL,
  `tempat_lahir_pria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_pria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan_pria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telepon_pria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_pria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ayah_pria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_ibu_pria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_calon_wanita` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir_wanita` date NOT NULL,
  `tempat_lahir_wanita` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_wanita` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan_wanita` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telepon_wanita` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_wanita` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ayah_wanita` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_ibu_wanita` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pernikahan` date NOT NULL,
  `tempat_pernikahan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_anggota` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('Lk','Pr') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_pasangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_baptis` date DEFAULT NULL,
  `tempat_baptis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_sidi` date DEFAULT NULL,
  `tempat_sidi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_baptis` enum('S','B') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_sidi` enum('S','B') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_nikah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_nikah` date DEFAULT NULL,
  `hubungan_keluarga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendidikan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_pernikahan` enum('K','B','J','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'B',
  `status` enum('pending','active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `members`
--

INSERT INTO `members` (`id`, `nomor_anggota`, `nama_lengkap`, `jenis_kelamin`, `tanggal_lahir`, `tempat_lahir`, `alamat`, `no_hp`, `email`, `pekerjaan`, `nama_ayah`, `nama_ibu`, `nama_pasangan`, `tanggal_baptis`, `tempat_baptis`, `tanggal_sidi`, `tempat_sidi`, `status_baptis`, `status_sidi`, `tempat_nikah`, `tanggal_nikah`, `hubungan_keluarga`, `pendidikan`, `status_pernikahan`, `status`, `foto`, `created_at`, `updated_at`) VALUES
(5, NULL, 'Muhammad Surya Wijaya', 'Lk', '2025-08-03', 'Samarinda', 'Jalan Lumba Lumba', '097666505858584', 'rholandsima345@gmail.com', 'adminsuper', 'Yohannis', 'Cornelia', '-', '2025-08-03', 'Gereja', '2025-08-03', 'Gereja', NULL, NULL, NULL, NULL, NULL, NULL, 'B', 'active', 'members/b2CNilnVF693MX8Bj2IrbPLvbKiY6GuaVgUl2uWN.png', '2025-08-03 06:20:43', '2025-08-03 06:20:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_03_21_000001_create_pastors_table', 1),
(5, '2024_03_21_000002_create_congregations_table', 1),
(6, '2024_06_28_130226_create_baptisms_table', 1),
(7, '2025_07_05_125854_create_inventories_table', 1),
(8, '2025_07_08_053743_create_information_table', 1),
(9, '2025_07_08_101020_add_subcategory_to_information_table', 1),
(10, '2025_07_10_123947_create_warta_mingguan_table', 1),
(11, '2025_07_12_202831_create_sejarah_gerejas_table', 1),
(12, '2025_07_12_202843_create_sejarah_jemaats_table', 1),
(13, '2025_07_12_214248_create_members_table_new', 1),
(14, '2025_07_13_000001_add_photo_and_end_date_to_pastors_table', 1),
(15, '2025_07_13_210325_add_image_to_information_table', 1),
(16, '2025_07_16_184257_fix_information_priority_column', 1),
(17, '2025_07_16_fix_information_table_category_column', 1),
(18, '2025_07_19_080116_create_email_verification_codes_table', 1),
(19, '2025_07_19_081037_add_email_to_baptisms_table', 1),
(20, 'xxxx_xx_xx_create_marriages_table', 1),
(21, 'xxxx_xx_xx_create_suggestions_table', 1),
(22, '2025_07_30_115746_create_calendar_events_table', 2),
(23, '2025_07_30_134305_create_excel_files_table', 3),
(24, '2025_08_03_add_family_fields_to_members_table', 4),
(25, '2025_08_03_add_new_fields_to_baptisms_table', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pastors`
--

CREATE TABLE `pastors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `birth_date` date DEFAULT NULL,
  `ordination_date` date DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pastors`
--

INSERT INTO `pastors` (`id`, `name`, `email`, `phone`, `address`, `birth_date`, `ordination_date`, `status`, `photo`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 'Muhammad Surya Wijaya', 'suryawijaya1147@gmail.com', '081289800000', 'Jalan Lumba Lumba', '2025-08-03', '2025-08-03', 'active', 'pastors/Td4P4wrPjHivGhlKEuLxauJnjzPIfOtf9RpEIrKC.jpg', '2025-08-03', '2025-08-03 05:55:56', '2025-08-03 05:55:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sejarah_gerejas`
--

CREATE TABLE `sejarah_gerejas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Sejarah Gereja Toraja',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `established_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sejarah_jemaats`
--

CREATE TABLE `sejarah_jemaats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Sejarah Gereja Toraja Jemaat Eben-Haezer Selili',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `established_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `suggestions`
--

CREATE TABLE `suggestions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_gmail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saran` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `suggestions`
--

INSERT INTO `suggestions` (`id`, `nama`, `no_hp`, `nama_gmail`, `saran`, `status`, `created_at`, `updated_at`) VALUES
(1, 'dinas123sada', '097666505858584', 'anjaykipas244@gmail.com', 'asdsadadadadasds', 'unread', '2025-08-03 00:50:07', '2025-08-03 00:50:07'),
(2, 'roland sima', '097666505858', 'anjaykipas244@gmail.com', 'nnnnnnnnn', 'unread', '2025-08-03 05:51:18', '2025-08-03 05:51:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'dinasprovinsi@dinas.com', 'dinasprovinsi@dinas.com', NULL, '$2y$12$pU4j7JR8cRawSCpcJAkHAeaP/hjwV0vpTXGcW8uEk50RsaIpfpFIm', NULL, '2025-07-30 04:40:15', '2025-07-30 04:40:15'),
(2, 'Administrator', 'admin@gerejatoraja.com', '2025-08-01 03:05:44', '$2y$12$SJ8lH.WgslX0lJP.epUJAOFgJLUCfDEg4i9S/.MAMJZiDAOZ045t.', NULL, '2025-08-01 03:05:46', '2025-08-01 03:05:46'),
(3, 'Admin Gereja', 'admin@eben-haezer.com', '2025-08-01 03:05:46', '$2y$12$/g38KGdoJxyDPXN4qxDClepjPiRkasgFLm7Wb8yxEBUcQ/jcXG.MK', 'PuwbZrEFAFYXRpoE6pipymOOvx4lRW4CrdZKArlzP8UA344fFsSQ8odWr6vd', '2025-08-01 03:05:47', '2025-08-01 03:05:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `warta_mingguan`
--

CREATE TABLE `warta_mingguan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_warta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` bigint(20) NOT NULL,
  `tanggal` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `baptisms`
--
ALTER TABLE `baptisms`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `calendar_events`
--
ALTER TABLE `calendar_events`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `congregations`
--
ALTER TABLE `congregations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `congregations_pastor_id_foreign` (`pastor_id`);

--
-- Indeks untuk tabel `email_verification_codes`
--
ALTER TABLE `email_verification_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_verification_codes_email_code_type_index` (`email`,`code`,`type`);

--
-- Indeks untuk tabel `excel_files`
--
ALTER TABLE `excel_files`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `marriages`
--
ALTER TABLE `marriages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pastors`
--
ALTER TABLE `pastors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pastors_email_unique` (`email`);

--
-- Indeks untuk tabel `sejarah_gerejas`
--
ALTER TABLE `sejarah_gerejas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sejarah_jemaats`
--
ALTER TABLE `sejarah_jemaats`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `suggestions`
--
ALTER TABLE `suggestions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `warta_mingguan`
--
ALTER TABLE `warta_mingguan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `baptisms`
--
ALTER TABLE `baptisms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `calendar_events`
--
ALTER TABLE `calendar_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `congregations`
--
ALTER TABLE `congregations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `email_verification_codes`
--
ALTER TABLE `email_verification_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `excel_files`
--
ALTER TABLE `excel_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `information`
--
ALTER TABLE `information`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `marriages`
--
ALTER TABLE `marriages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `pastors`
--
ALTER TABLE `pastors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `sejarah_gerejas`
--
ALTER TABLE `sejarah_gerejas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sejarah_jemaats`
--
ALTER TABLE `sejarah_jemaats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `suggestions`
--
ALTER TABLE `suggestions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `warta_mingguan`
--
ALTER TABLE `warta_mingguan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `congregations`
--
ALTER TABLE `congregations`
  ADD CONSTRAINT `congregations_pastor_id_foreign` FOREIGN KEY (`pastor_id`) REFERENCES `pastors` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
