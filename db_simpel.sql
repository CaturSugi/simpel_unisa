-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 22, 2025 at 03:54 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simpel`
--

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE `buildings` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Gedung A Siti Walidah', '2025-05-15 18:35:21', '2025-05-15 18:35:21'),
(2, 'Gedung B Siti Bariyah', '2025-05-15 18:35:21', '2025-05-15 18:35:21'),
(3, 'Gedung C Siti Moendjijah', '2025-05-15 18:35:21', '2025-05-15 18:35:21'),
(4, 'Kampus 1 UNISA Yogyakarta', '2025-05-15 18:35:21', '2025-05-15 18:35:21'),
(5, 'Masjid Walidah Dahlan UNISA Yogyakarta', '2025-05-15 18:35:21', '2025-05-15 18:35:21'),
(6, 'Asrama Mahasiswa UNISA Yogyakarta', '2025-05-15 18:35:21', '2025-05-15 18:35:21'),
(7, 'Halaman UNISA Yogyakarta', '2025-05-15 18:35:21', '2025-05-15 18:35:21');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Sampah Plastik', '2025-05-15 18:35:20', '2025-05-15 18:35:20'),
(2, 'Sampah Kertas', '2025-05-15 18:35:20', '2025-05-15 18:35:20'),
(3, 'Sampah Basah', '2025-05-15 18:35:20', '2025-05-15 18:35:20'),
(4, 'Sampah Tisu', '2025-05-15 18:35:20', '2025-05-15 18:35:20'),
(5, 'Sampah Elektronik', '2025-05-15 18:35:20', '2025-05-15 18:35:20'),
(6, 'Sampah Kaca', '2025-05-15 18:35:20', '2025-05-15 18:35:20'),
(7, 'Sampah Logam', '2025-05-15 18:35:21', '2025-05-15 18:35:21');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(109, '2014_10_12_000000_create_users_table', 1),
(110, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(111, '2019_08_19_000000_create_failed_jobs_table', 1),
(112, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(113, '2024_11_07_162200_create_categories_table', 1),
(114, '2024_11_07_16250_create_buildings_table', 1),
(115, '2024_11_07_162555_create_trashs_table', 1),
(116, '2025_04_27_075644_alter_trashes_make_collection_date_nullable', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trashes`
--

CREATE TABLE `trashes` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `building_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `weight` decimal(8,2) NOT NULL,
  `collection_date` date DEFAULT NULL,
  `create_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trashes`
--

INSERT INTO `trashes` (`id`, `category_id`, `building_id`, `name`, `description`, `weight`, `collection_date`, `create_by`, `update_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 7, 'Sampah-Lcl8pk', 'Deskripsi sampah: tWpL5RcPNe', '178.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(2, 2, 3, 'Sampah-eU1FiJ', 'Deskripsi sampah: kPbtV82pwg', '164.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(3, 4, 5, 'Sampah-R6Ygl5', 'Deskripsi sampah: qKpYNcJ9zi', '20.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(4, 7, 5, 'Sampah-OiWD5F', 'Deskripsi sampah: oy98iITqkP', '75.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(5, 4, 3, 'Sampah-oj2qk9', 'Deskripsi sampah: W4JcA3T30f', '11.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(6, 6, 4, 'Sampah-RjpIQ6', 'Deskripsi sampah: aLKakTKiVH', '35.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(7, 2, 4, 'Sampah-iyNcpK', 'Deskripsi sampah: dTT5JHcBNR', '155.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(8, 2, 4, 'Sampah-IpignH', 'Deskripsi sampah: MvFY3uwSU1', '50.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(9, 1, 4, 'Sampah-F4iwdj', 'Deskripsi sampah: ETT17t1Uiv', '11.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(10, 5, 4, 'Sampah-qO1pbD', 'Deskripsi sampah: FQ567ihqtW', '177.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(11, 3, 7, 'Sampah-vGhILP', 'Deskripsi sampah: WEIZE8PlcP', '17.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(12, 5, 4, 'Sampah-LQjdHH', 'Deskripsi sampah: WDuiljj7uX', '55.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(13, 2, 7, 'Sampah-WSeGaR', 'Deskripsi sampah: CEkXiIsLwR', '109.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(14, 1, 7, 'Sampah-bRVHA6', 'Deskripsi sampah: WLZ8fY0CA9', '94.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(15, 6, 3, 'Sampah-dnLlw0', 'Deskripsi sampah: gByKQd3WsN', '138.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(16, 3, 4, 'Sampah-zn7lnH', 'Deskripsi sampah: PltBQHjKP1', '198.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(17, 5, 5, 'Sampah-zCwhvZ', 'Deskripsi sampah: bTAY46Wt3p', '45.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(18, 3, 1, 'Sampah-DMb43c', 'Deskripsi sampah: NacWDvWK5n', '86.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(19, 7, 6, 'Sampah-kwBRqW', 'Deskripsi sampah: fobw75ol7K', '81.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(20, 4, 3, 'Sampah-XomckR', 'Deskripsi sampah: wDpVnwCOuU', '145.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(21, 5, 3, 'Sampah-OgzbYM', 'Deskripsi sampah: bOJ6Ey7V2m', '19.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(22, 2, 7, 'Sampah-F450j9', 'Deskripsi sampah: fDKTxfNT12', '10.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(23, 4, 5, 'Sampah-FSqLxz', 'Deskripsi sampah: 1OO5bP7MCv', '86.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(24, 5, 3, 'Sampah-jLq6uc', 'Deskripsi sampah: pKJFxnADki', '101.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(25, 6, 5, 'Sampah-jB4vBo', 'Deskripsi sampah: UIlLZFRPW4', '188.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(26, 1, 7, 'Sampah-yoSvdk', 'Deskripsi sampah: sEuTWJDYac', '94.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(27, 5, 2, 'Sampah-UmGFpm', 'Deskripsi sampah: Z6CP446kpa', '156.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(28, 3, 1, 'Sampah-FHHGRt', 'Deskripsi sampah: QTy4E7lEyz', '126.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(29, 6, 2, 'Sampah-UaXzbH', 'Deskripsi sampah: QSjJl8hf3o', '10.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(30, 7, 6, 'Sampah-zMPaky', 'Deskripsi sampah: ZQDUrZljdE', '178.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(31, 5, 1, 'Sampah-IjbwRQ', 'Deskripsi sampah: KblTp8dUHp', '120.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(32, 1, 7, 'Sampah-2f4eMu', 'Deskripsi sampah: krzAjra8Kc', '152.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(33, 6, 2, 'Sampah-Two70p', 'Deskripsi sampah: vPB5Ba8wrE', '124.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(34, 7, 4, 'Sampah-g8zNVP', 'Deskripsi sampah: NwZuxJmq3y', '92.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(35, 5, 6, 'Sampah-TgS8Kl', 'Deskripsi sampah: xgBiinDaZO', '198.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(36, 5, 2, 'Sampah-nUDQQh', 'Deskripsi sampah: ov0Xngds93', '135.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(37, 1, 6, 'Sampah-LQ1bWd', 'Deskripsi sampah: qtA1yx8Rxk', '73.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(38, 7, 1, 'Sampah-NXhWQU', 'Deskripsi sampah: ZCTgXVMOQs', '121.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(39, 1, 2, 'Sampah-87k69i', 'Deskripsi sampah: qlYmTt0Y88', '163.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(40, 7, 3, 'Sampah-GCmD0D', 'Deskripsi sampah: VpxE5eWna5', '170.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(41, 1, 1, 'Sampah-RPuXxF', 'Deskripsi sampah: xccy7FAkCt', '180.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(42, 2, 1, 'Sampah-FHLtRG', 'Deskripsi sampah: gfAuhqZDsH', '199.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(43, 5, 3, 'Sampah-9GL06h', 'Deskripsi sampah: zRECOZQjVz', '43.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(44, 7, 1, 'Sampah-gzupPE', 'Deskripsi sampah: WE7fhhHxXa', '89.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(45, 6, 3, 'Sampah-XUpVEy', 'Deskripsi sampah: qbuektXRjq', '44.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(46, 4, 1, 'Sampah-e5zCEf', 'Deskripsi sampah: eyWvRnK8Ih', '115.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(47, 7, 7, 'Sampah-kCiLUa', 'Deskripsi sampah: saPJE9pFMD', '79.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(48, 1, 3, 'Sampah-MRsocU', 'Deskripsi sampah: gDAT1mR30X', '125.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(49, 6, 3, 'Sampah-EKXjMS', 'Deskripsi sampah: jpFRW1x9mE', '140.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(50, 5, 7, 'Sampah-6bw1Jo', 'Deskripsi sampah: TuSJGIaBEo', '160.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(51, 1, 6, 'Sampah-YUiTwh', 'Deskripsi sampah: tuiKCsp8qT', '85.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(52, 1, 5, 'Sampah-rfNImI', 'Deskripsi sampah: rViOQA4FVB', '155.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(53, 4, 3, 'Sampah-1TSFAx', 'Deskripsi sampah: 2P50rCapAT', '42.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(54, 1, 1, 'Sampah-4STrW9', 'Deskripsi sampah: 1CKTkJENaI', '98.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(55, 2, 3, 'Sampah-uALhr2', 'Deskripsi sampah: nAvI4slK2o', '184.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(56, 7, 4, 'Sampah-qpnMI6', 'Deskripsi sampah: 0qfWPBA7Z1', '120.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(57, 2, 7, 'Sampah-Ayy3Bf', 'Deskripsi sampah: n6utBefFCR', '123.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(58, 3, 6, 'Sampah-4UflwN', 'Deskripsi sampah: RthjMJvdJo', '135.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(59, 2, 1, 'Sampah-ueLfOd', 'Deskripsi sampah: fyCyFWCRsF', '23.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(60, 5, 6, 'Sampah-YRchxQ', 'Deskripsi sampah: AaCWUMnzWK', '161.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(61, 2, 3, 'Sampah-xvfBjW', 'Deskripsi sampah: ksbVFFo3Fe', '144.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(62, 7, 6, 'Sampah-gBZVHr', 'Deskripsi sampah: XHC4vIwQlW', '78.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(63, 1, 1, 'Sampah-ZarCg9', 'Deskripsi sampah: RyBJz33wtP', '126.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(64, 1, 1, 'Sampah-1FzKsB', 'Deskripsi sampah: EOT6WKgFdD', '39.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(65, 4, 4, 'Sampah-k8fpy1', 'Deskripsi sampah: EGqOkgTxKY', '86.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(66, 3, 2, 'Sampah-KdxxVC', 'Deskripsi sampah: 1RlnQfpMq2', '185.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(67, 6, 4, 'Sampah-dllyU7', 'Deskripsi sampah: QNTihHGODF', '160.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(68, 6, 1, 'Sampah-pUhhA4', 'Deskripsi sampah: mMNmLcigMo', '176.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(69, 2, 4, 'Sampah-4yYl0N', 'Deskripsi sampah: a85sj9tMbt', '76.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(70, 7, 7, 'Sampah-YMVhtW', 'Deskripsi sampah: NDGFkqArzx', '184.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(71, 7, 4, 'Sampah-pC6faS', 'Deskripsi sampah: zTVN2TszsP', '73.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(72, 2, 2, 'Sampah-DFmrGy', 'Deskripsi sampah: TthNggYNuk', '98.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(73, 1, 5, 'Sampah-dXAcAl', 'Deskripsi sampah: EBQ8Ust1F6', '156.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(74, 2, 1, 'Sampah-cp06C9', 'Deskripsi sampah: IAlfeP9C73', '112.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(75, 3, 1, 'Sampah-UofHvM', 'Deskripsi sampah: r9kKfAIoeZ', '103.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(76, 3, 6, 'Sampah-q2Cj63', 'Deskripsi sampah: 1zExhoOsLD', '44.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(77, 4, 2, 'Sampah-6hetuT', 'Deskripsi sampah: tVotte9Vdk', '167.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(78, 1, 6, 'Sampah-OxzGJH', 'Deskripsi sampah: vTOwCeuXWd', '161.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(79, 7, 5, 'Sampah-pmYlxl', 'Deskripsi sampah: 4hVhwvnDNm', '193.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(80, 3, 3, 'Sampah-hcjTJh', 'Deskripsi sampah: Bq0m0mjkZo', '155.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(81, 5, 2, 'Sampah-kJOYTC', 'Deskripsi sampah: oTYe3dj6rX', '7.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(82, 1, 2, 'Sampah-8q64Yu', 'Deskripsi sampah: kD7vay1KYD', '135.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(83, 4, 5, 'Sampah-AksM1P', 'Deskripsi sampah: UgDmtHrRvH', '18.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(84, 3, 4, 'Sampah-CPLV6Y', 'Deskripsi sampah: FgU26DNytN', '149.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(85, 1, 7, 'Sampah-Xxow6y', 'Deskripsi sampah: txR9DrkoWG', '80.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(86, 5, 6, 'Sampah-yeHR76', 'Deskripsi sampah: ncM8ToPYmJ', '60.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(87, 5, 7, 'Sampah-4DxKD7', 'Deskripsi sampah: EmsEw6r84j', '84.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(88, 3, 3, 'Sampah-D23JDK', 'Deskripsi sampah: qDsYcxtrUf', '52.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(89, 6, 1, 'Sampah-8noAcU', 'Deskripsi sampah: iBDCK5wX3b', '166.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(90, 5, 1, 'Sampah-c06k0d', 'Deskripsi sampah: IbEAuJMDzh', '122.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(91, 5, 6, 'Sampah-E2CvXP', 'Deskripsi sampah: E32o1dTcxn', '129.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(92, 6, 5, 'Sampah-tMXt7F', 'Deskripsi sampah: H0WGHYjIuf', '39.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(93, 6, 5, 'Sampah-flhrM2', 'Deskripsi sampah: kTA2qN8khE', '124.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(94, 7, 4, 'Sampah-OcYQM8', 'Deskripsi sampah: 2Cxq9AOwMG', '42.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(95, 3, 7, 'Sampah-ZH9W5c', 'Deskripsi sampah: 5GJxkhppP3', '47.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(96, 7, 1, 'Sampah-kuvNuz', 'Deskripsi sampah: 8Y2sDaUl3l', '39.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(97, 4, 1, 'Sampah-Kdt2ms', 'Deskripsi sampah: 4RWg4ASvr8', '56.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(98, 4, 4, 'Sampah-LbTm80', 'Deskripsi sampah: yQfpnjAwo5', '199.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(99, 5, 6, 'Sampah-8OxjIR', 'Deskripsi sampah: G9gKuSJxJR', '66.00', '2025-05-16', NULL, NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(100, 1, 4, 'Sampah-ZX53D2', 'Deskripsi sampah: UkRDNk8LKF', '171.00', '2025-05-16', NULL, NULL, '2025-05-14 18:35:21', '2025-05-14 18:35:21', NULL),
(101, 1, 4, 'sampah botol', 'Botol platik bening', '5.50', NULL, 'Admin', NULL, '2025-05-13 18:40:05', '2025-05-13 18:40:05', NULL),
(103, 3, 4, 'Sampah Organik', 'Tes Sampah', '20.50', NULL, 'admin', 'admin', '2025-05-15 06:37:52', '2025-05-15 06:37:52', NULL),
(104, 5, 3, 'Sampah ABC', NULL, '12.00', NULL, 'User', 'User', '2025-05-18 10:01:13', '2025-05-18 10:01:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', '$2y$10$xPHO44HM2Q2FQmNsCM6fiOqWurG1WbAmVlfVSROzCXaBvSxqYktHi', NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(2, 'User', 'user@gmail.com', 'user', '$2y$10$TnUBrjAEIp1XlVCafGZsYONX8iZyGMGbnZn3G5T3ba8ufzS29GfO2', NULL, '2025-05-15 18:35:21', '2025-05-15 18:35:21', NULL),
(3, 'Operator', 'operator@gmail.com', 'user', '$2y$10$semi6sNsPRAbmjEuzOAdgu36jm9o8NqjfW7qc.V5vIrm/.R9IzbAi', NULL, '2025-05-19 09:05:15', '2025-05-19 09:05:15', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `trashes`
--
ALTER TABLE `trashes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trashes_category_id_foreign` (`category_id`),
  ADD KEY `trashes_building_id_foreign` (`building_id`);

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
-- AUTO_INCREMENT for table `buildings`
--
ALTER TABLE `buildings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trashes`
--
ALTER TABLE `trashes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `trashes`
--
ALTER TABLE `trashes`
  ADD CONSTRAINT `trashes_building_id_foreign` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trashes_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
