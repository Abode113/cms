-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2018 at 12:06 AM
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
-- Database: `cms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `catcustomattrs`
--

CREATE TABLE `catcustomattrs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `catcustomattrs`
--

INSERT INTO `catcustomattrs` (`id`, `name`, `type`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'price', 'number', 10, '2018-12-02 00:17:22', '2018-12-02 00:17:22'),
(2, 'size', 'number', 10, '2018-12-02 00:17:29', '2018-12-02 00:17:29'),
(3, 'Genre', 'string', 18, '2018-12-02 00:15:49', '2018-12-02 00:15:49');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coverimage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `categoryOrder` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `image`, `coverimage`, `parent`, `categoryOrder`, `event_id`, `created_at`, `updated_at`) VALUES
(8, 'spotrs', 'spotrs', 0, 1, 1, '2018-12-01 23:57:53', '2018-12-01 23:57:53'),
(9, 'tennis', 'tennis', 8, 1, 1, '2018-12-02 00:03:41', '2018-12-02 00:03:41'),
(10, 'Arts', 'Arts', 0, 2, 1, '2018-12-02 00:03:27', '2018-12-02 00:03:27'),
(16, 'football', 'football', 8, 2, 1, '2018-12-02 00:00:51', '2018-12-02 00:00:51'),
(17, 'BasketBall', 'BasketBall', 8, 3, 0, '2018-12-02 00:02:21', '2018-12-02 00:02:21'),
(18, 'songs', 'songs', 0, 3, 0, '2018-12-02 00:04:57', '2018-12-02 00:04:57'),
(19, 'News', 'News', 0, 4, 0, '2018-12-02 00:06:05', '2018-12-02 00:06:05'),
(20, 'spotrs', 'spotrs', 0, 5, 0, '2018-12-02 00:07:55', '2018-12-02 00:07:55');

-- --------------------------------------------------------

--
-- Table structure for table `diclangs`
--

CREATE TABLE `diclangs` (
  `id` int(11) NOT NULL,
  `word` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Language_id` int(11) NOT NULL,
  `dictionary_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diclangs`
--

INSERT INTO `diclangs` (`id`, `word`, `Language_id`, `dictionary_id`, `created_at`, `updated_at`) VALUES
(4, 'word_1_en', 1, 14, '2018-11-24 10:10:13', '2018-11-24 23:11:52'),
(5, 'word_1_fr', 2, 14, '2018-11-24 10:10:13', '2018-11-24 23:11:52'),
(6, 'word_1_ar', 3, 14, '2018-11-24 10:10:14', '2018-11-24 23:11:52'),
(7, 'word_2_en', 1, 15, '2018-11-24 10:13:39', '2018-11-24 10:13:39'),
(8, 'word_2_fr', 2, 15, '2018-11-24 10:13:39', '2018-11-24 10:13:39'),
(9, 'word_2_ar', 3, 15, '2018-11-24 10:13:39', '2018-11-24 10:13:39'),
(10, 'Detail_en', 1, 16, '2018-11-24 10:13:49', '2018-11-24 23:12:58'),
(11, 'Detail_fr', 2, 16, '2018-11-24 10:13:49', '2018-11-24 23:12:58'),
(12, 'Detail_ar', 3, 16, '2018-11-24 10:13:50', '2018-11-24 23:12:59');

-- --------------------------------------------------------

--
-- Table structure for table `dictionaries`
--

CREATE TABLE `dictionaries` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dictionaries`
--

INSERT INTO `dictionaries` (`id`, `created_at`, `updated_at`) VALUES
(14, '2018-11-24 10:10:13', '2018-11-24 10:10:13'),
(15, '2018-11-24 10:13:39', '2018-11-24 10:13:39'),
(16, '2018-11-24 10:13:49', '2018-11-24 10:13:49');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `viewType_id` int(11) NOT NULL,
  `feildsToShow` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `itemcatvalues`
--

CREATE TABLE `itemcatvalues` (
  `id` int(10) UNSIGNED NOT NULL,
  `categoryCustom_Id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `itemcatvalues`
--

INSERT INTO `itemcatvalues` (`id`, `categoryCustom_Id`, `item_id`, `created_at`, `updated_at`) VALUES
(44, 1, 74, '2018-12-02 00:25:28', '2018-12-02 00:25:28'),
(45, 2, 74, '2018-12-02 00:25:28', '2018-12-02 00:25:28'),
(48, 3, 77, '2018-12-02 00:28:27', '2018-12-02 00:28:27'),
(50, 3, 79, '2018-12-02 05:14:54', '2018-12-02 05:14:54'),
(51, 3, 80, '2018-12-02 05:16:44', '2018-12-02 05:16:44'),
(52, 1, 81, '2018-12-02 05:19:43', '2018-12-02 05:19:43'),
(53, 2, 81, '2018-12-02 05:19:43', '2018-12-02 05:19:43'),
(54, 1, 82, '2018-12-02 05:20:48', '2018-12-02 05:20:48'),
(55, 2, 82, '2018-12-02 05:20:48', '2018-12-02 05:20:48'),
(56, 1, 83, '2018-12-02 05:22:25', '2018-12-02 05:22:25'),
(57, 2, 83, '2018-12-02 05:22:25', '2018-12-02 05:22:25'),
(58, 1, 84, '2018-12-02 05:23:12', '2018-12-02 05:23:12'),
(59, 2, 84, '2018-12-02 05:23:12', '2018-12-02 05:23:12');

-- --------------------------------------------------------

--
-- Table structure for table `itemcustomattrs`
--

CREATE TABLE `itemcustomattrs` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `itemcustomattrs`
--

INSERT INTO `itemcustomattrs` (`id`, `item_id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(3, 62, 'name22', 'type22', '2018-11-26 21:36:37', '2018-11-26 21:36:37'),
(5, 74, 'price', 'string', '2018-12-02 06:01:14', '2018-12-02 06:01:14'),
(6, 77, 'price', 'string', '2018-12-02 06:01:17', '2018-12-02 06:01:17'),
(7, 79, 'price', 'string', '2018-12-02 06:01:22', '2018-12-02 06:01:22'),
(8, 80, 'price', 'string', '2018-12-02 06:01:25', '2018-12-02 06:01:25'),
(9, 82, 'price', 'string', '2018-12-02 06:01:29', '2018-12-02 06:01:29'),
(10, 84, 'price', 'string', '2018-12-02 06:01:32', '2018-12-02 06:01:32');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coverimage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `itemOrder` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `image`, `coverimage`, `visible`, `itemOrder`, `category_id`, `event_id`, `created_at`, `updated_at`) VALUES
(65, 'Germany', 'Germany_c', 1, 1, 16, 0, '2018-12-02 05:05:47', '2018-12-02 05:05:47'),
(66, 'Brazil', 'Brazil_c', 1, 2, 16, 0, '2018-12-02 05:06:14', '2018-12-02 05:06:14'),
(67, 'France', 'France_c', 1, 3, 16, 0, '2018-12-02 05:06:32', '2018-12-02 05:06:32'),
(68, 'hotNews', 'HotNews_c', 1, 1, 19, 0, '2018-12-02 05:04:53', '2018-12-02 05:04:53'),
(69, 'syrianteam', 'syrianteam_c', 1, 1, 9, 0, '2018-12-02 05:07:38', '2018-12-02 05:07:38'),
(70, 'italianteam', 'italianteam_c', 1, 1, 17, 0, '2018-12-02 05:08:06', '2018-12-02 05:08:06'),
(71, 'americanteam', 'americanteam_c', 1, 2, 17, 0, '2018-12-02 05:08:32', '2018-12-02 05:08:32'),
(74, 'color', 'color_c', 1, 3, 10, 0, '2018-12-02 05:18:51', '2018-12-02 05:18:51'),
(77, 'mayores', 'mayores_c', 1, 3, 18, 0, '2018-12-02 05:08:57', '2018-12-02 05:08:57'),
(79, 'oath', 'oath_c', 1, 1, 18, 0, '2018-12-02 05:14:54', '2018-12-02 05:14:54'),
(80, 'vida', 'vida_c', 1, 4, 18, 0, '2018-12-02 05:16:44', '2018-12-02 05:16:44'),
(81, 'monaliza', 'monaliza_c', 1, 2, 10, 0, '2018-12-02 05:19:43', '2018-12-02 05:19:43'),
(82, 'monaliza', 'monaliza_c', 1, 4, 10, 0, '2018-12-02 05:20:48', '2018-12-02 05:20:48'),
(83, 'lionardo', 'lionardo_c', 1, 1, 10, 0, '2018-12-02 05:22:25', '2018-12-02 05:22:25'),
(84, 'lionardo', 'lionardo_c', 1, 1, 10, 0, '2018-12-02 05:23:12', '2018-12-02 05:23:12');

-- --------------------------------------------------------

--
-- Table structure for table `langcatcustoms`
--

CREATE TABLE `langcatcustoms` (
  `id` int(10) UNSIGNED NOT NULL,
  `lang_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catvalcustom_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `langcatcustoms`
--

INSERT INTO `langcatcustoms` (`id`, `lang_id`, `catvalcustom_id`, `value`, `created_at`, `updated_at`) VALUES
(61, '1', '44', '300', '2018-12-02 05:18:51', '2018-12-02 05:18:51'),
(62, '1', '45', '120', '2018-12-02 05:18:51', '2018-12-02 05:18:51'),
(63, '2', '44', '300', '2018-12-02 05:18:51', '2018-12-02 05:18:51'),
(64, '2', '45', '120', '2018-12-02 05:18:51', '2018-12-02 05:18:51'),
(65, '3', '44', '300', '2018-12-02 05:18:51', '2018-12-02 05:18:51'),
(66, '3', '45', '120', '2018-12-02 05:18:51', '2018-12-02 05:18:51'),
(73, '1', '48', 'pop_en', '2018-12-02 00:28:27', '2018-12-02 00:28:27'),
(74, '2', '48', 'pop_fr', '2018-12-02 00:28:27', '2018-12-02 00:28:27'),
(75, '3', '48', 'pop_ar', '2018-12-02 00:28:27', '2018-12-02 00:28:27'),
(79, '1', '50', 'pop_en', '2018-12-02 05:14:54', '2018-12-02 05:14:54'),
(80, '2', '50', 'pop_fr', '2018-12-02 05:14:54', '2018-12-02 05:14:54'),
(81, '3', '50', 'pop_ar', '2018-12-02 05:14:54', '2018-12-02 05:14:54'),
(82, '1', '51', 'pop_en', '2018-12-02 05:16:44', '2018-12-02 05:16:44'),
(83, '2', '51', 'pop_fr', '2018-12-02 05:16:44', '2018-12-02 05:16:44'),
(84, '3', '51', 'pop_ar', '2018-12-02 05:16:44', '2018-12-02 05:16:44'),
(85, '1', '52', '300', '2018-12-02 05:19:43', '2018-12-02 05:19:43'),
(86, '1', '53', '100', '2018-12-02 05:19:43', '2018-12-02 05:19:43'),
(87, '1', '54', '300', '2018-12-02 05:20:48', '2018-12-02 05:20:48'),
(88, '1', '55', '100', '2018-12-02 05:20:48', '2018-12-02 05:20:48'),
(89, '2', '54', '300', '2018-12-02 05:20:48', '2018-12-02 05:20:48'),
(90, '2', '55', '100', '2018-12-02 05:20:48', '2018-12-02 05:20:48'),
(91, '3', '54', '300', '2018-12-02 05:20:48', '2018-12-02 05:20:48'),
(92, '3', '55', '100', '2018-12-02 05:20:48', '2018-12-02 05:20:48'),
(93, '1', '56', '300', '2018-12-02 05:22:25', '2018-12-02 05:22:25'),
(94, '1', '57', '100', '2018-12-02 05:22:25', '2018-12-02 05:22:25'),
(95, '2', '56', '300', '2018-12-02 05:22:25', '2018-12-02 05:22:25'),
(96, '2', '57', '100', '2018-12-02 05:22:25', '2018-12-02 05:22:25'),
(97, '1', '58', '300', '2018-12-02 05:23:12', '2018-12-02 05:23:12'),
(98, '1', '59', '100', '2018-12-02 05:23:12', '2018-12-02 05:23:12'),
(99, '2', '58', '300', '2018-12-02 05:23:12', '2018-12-02 05:23:12'),
(100, '2', '59', '100', '2018-12-02 05:23:13', '2018-12-02 05:23:13'),
(101, '3', '58', '300', '2018-12-02 05:23:13', '2018-12-02 05:23:13'),
(102, '3', '59', '100', '2018-12-02 05:23:13', '2018-12-02 05:23:13');

-- --------------------------------------------------------

--
-- Table structure for table `langcategories`
--

CREATE TABLE `langcategories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `langcategories`
--

INSERT INTO `langcategories` (`id`, `category_id`, `language_id`, `title`, `desc`, `info`, `created_at`, `updated_at`) VALUES
(6, 8, 1, 'spotrs_title_en', 'spotrs_desc_en', 'spotrs_info_en', '2018-12-01 23:57:54', '2018-12-01 23:57:54'),
(7, 8, 2, 'spotrs_title_fr', 'spotrs_desc_fr', 'spotrs_info_fr', '2018-12-01 23:57:54', '2018-12-01 23:57:54'),
(8, 8, 3, 'spotrs_title_ar', 'spotrs_desc_ar', 'spotrs_info_ar', '2018-12-01 23:57:54', '2018-12-01 23:57:54'),
(9, 9, 1, 'tennis_title_en', 'tennis_desc_en', 'tennis_info_en', '2018-12-02 00:03:41', '2018-12-02 00:03:41'),
(10, 9, 2, 'tennis_title_fr', 'tennis_desc_fr', 'tennis_info_fr', '2018-12-02 00:03:41', '2018-12-02 00:03:41'),
(11, 9, 3, 'tennis_title_ar', 'tennis_desc_ar', 'tennis_info_ar', '2018-12-02 00:03:41', '2018-12-02 00:03:41'),
(12, 10, 1, 'Arts_title_en', 'Arts_desc_en', 'Arts_info_en', '2018-12-02 00:03:27', '2018-12-02 00:03:27'),
(13, 10, 2, 'Arts_title_fr', 'Arts_desc_fr', 'Arts_info_fr', '2018-12-02 00:03:27', '2018-12-02 00:03:27'),
(14, 10, 3, 'Arts_title_ar', 'Arts_desc_ar', 'Arts_info_ar', '2018-12-02 00:03:27', '2018-12-02 00:03:27'),
(15, 16, 1, 'football_title_en', 'football_desc_en', 'football_info_en', '2018-12-02 00:00:52', '2018-12-02 00:00:52'),
(16, 16, 2, 'football_title_fr', 'football_desc_fr', 'football_info_fr', '2018-12-02 00:00:52', '2018-12-02 00:00:52'),
(17, 16, 3, 'football_title_ar', 'football_desc_ar', 'football_info_ar', '2018-12-02 00:00:52', '2018-12-02 00:00:52'),
(18, 17, 1, 'BasketBall_title_en', 'BasketBall_desc_en', 'BasketBall_info_en', '2018-12-02 00:02:21', '2018-12-02 00:02:21'),
(19, 17, 2, 'BasketBall_title_fr', 'BasketBall_desc_fr', 'BasketBall_info_fr', '2018-12-02 00:02:21', '2018-12-02 00:02:21'),
(20, 17, 3, 'BasketBall_title_ar', 'BasketBall_desc_ar', 'BasketBall_info_ar', '2018-12-02 00:02:21', '2018-12-02 00:02:21'),
(21, 18, 1, 'songs_title_en', 'songs_desc_en', 'songs_info_en', '2018-12-02 00:04:57', '2018-12-02 00:04:57'),
(22, 18, 2, 'songs_title_fr', 'songs_desc_fr', 'songs_info_fr', '2018-12-02 00:04:57', '2018-12-02 00:04:57'),
(23, 18, 3, 'songs_title_ar', 'songs_desc_ar', 'songs_info_ar', '2018-12-02 00:04:57', '2018-12-02 00:04:57'),
(24, 19, 1, 'News_title_en', 'News_desc_en', 'News_info_en', '2018-12-02 00:06:06', '2018-12-02 00:06:06'),
(25, 19, 2, 'News_title_fr', 'News_desc_fr', 'News_info_fr', '2018-12-02 00:06:06', '2018-12-02 00:06:06'),
(26, 19, 3, 'News_title_ar', 'News_desc_ar', 'News_info_ar', '2018-12-02 00:06:06', '2018-12-02 00:06:06'),
(27, 20, 1, 'sportList_title_en', 'sportList_desc_en', 'sportList_info_en', '2018-12-02 00:07:56', '2018-12-02 00:07:56'),
(28, 20, 2, 'sportList_title_fr', 'sportList_desc_fr', 'sportList_info_fr', '2018-12-02 00:07:56', '2018-12-02 00:07:56'),
(29, 20, 3, 'sportList_title_ar', 'sportList_desc_ar', 'sportList_info_ar', '2018-12-02 00:07:56', '2018-12-02 00:07:56');

-- --------------------------------------------------------

--
-- Table structure for table `langitemcustoms`
--

CREATE TABLE `langitemcustoms` (
  `id` int(10) UNSIGNED NOT NULL,
  `lang_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `itemcustom_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `langitemcustoms`
--

INSERT INTO `langitemcustoms` (`id`, `lang_id`, `itemcustom_id`, `value`, `created_at`, `updated_at`) VALUES
(2, '1', '3', 'name_tess_en', '2018-11-27 15:10:11', '2018-11-27 15:10:11'),
(3, '2', '3', 'name_tess_fr', '2018-11-27 15:10:12', '2018-11-27 15:10:12'),
(4, '3', '3', 'name_tess_ar', '2018-11-27 15:10:12', '2018-11-27 15:10:12'),
(14, '1', '3', 'name_tess_enn', '2018-11-27 15:48:14', '2018-11-27 15:48:14'),
(15, '2', '3', 'name_tess_frr', '2018-11-27 15:48:14', '2018-11-27 15:48:14'),
(16, '3', '3', 'name_tess_arr', '2018-11-27 15:48:14', '2018-11-27 15:48:14');

-- --------------------------------------------------------

--
-- Table structure for table `langitems`
--

CREATE TABLE `langitems` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `langitems`
--

INSERT INTO `langitems` (`id`, `item_id`, `language_id`, `title`, `desc`, `info`, `created_at`, `updated_at`) VALUES
(40, 62, 1, 'test_title_10_en', 'test_desc_10_en', 'test_info_10_en', '2018-11-27 15:48:14', '2018-11-27 15:48:14'),
(41, 62, 2, 'test_title_10_fr', 'test_desc_10_fr', 'test_info_10_fr', '2018-11-27 15:48:14', '2018-11-27 15:48:14'),
(42, 62, 3, 'test_title_10_ar', 'test_desc_10_ar', 'test_info_10_ar', '2018-11-27 15:48:14', '2018-11-27 15:48:14'),
(43, 63, 1, 'test_title_11_en', 'test_desc_11_en', 'test_info_11_en', '2018-11-12 21:16:28', '2018-11-12 21:16:28'),
(44, 63, 2, 'test_title_11_fr', 'test_desc_11_fr', 'test_info_11_fr', '2018-11-12 21:16:28', '2018-11-12 21:16:28'),
(45, 63, 3, 'test_title_11_ar', 'test_desc_11_ar', 'test_info_11_ar', '2018-11-12 21:16:28', '2018-11-12 21:16:28'),
(46, 64, 1, 'test_title_12_en', 'test_desc_12_en', 'test_info_12_en', '2018-11-28 21:41:34', '2018-11-28 21:41:34'),
(47, 64, 2, 'test_title_12_fr', 'test_desc_12_fr', 'test_info_12_fr', '2018-11-28 21:41:34', '2018-11-28 21:41:34'),
(48, 64, 3, 'test_title_12_ar', 'test_desc_12_ar', 'test_info_12_ar', '2018-11-28 21:41:34', '2018-11-28 21:41:34'),
(49, 65, 1, 'Germany_title_en', 'Germany_desc_en', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:05:46', '2018-12-02 05:05:46'),
(50, 65, 2, 'Germany_title_fr', 'Germany_desc_fr', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:05:47', '2018-12-02 05:05:47'),
(51, 65, 3, 'Germany_title_ar', 'Germany_desc_ar', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:05:47', '2018-12-02 05:05:47'),
(52, 66, 1, 'Brazil_title_en', 'Brazil_desc_en', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:06:14', '2018-12-02 05:06:14'),
(53, 66, 2, 'Brazil_title_fr', 'Brazil_desc_fr', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:06:14', '2018-12-02 05:06:14'),
(54, 66, 3, 'Brazil_title_ar', 'Brazil_desc_ar', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:06:14', '2018-12-02 05:06:14'),
(55, 67, 1, 'France_title_en', 'France_desc_en', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:06:31', '2018-12-02 05:06:31'),
(56, 67, 2, 'France_title_fr', 'France_desc_fr', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:06:31', '2018-12-02 05:06:31'),
(57, 67, 3, 'France_title_ar', 'France_desc_ar', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:06:31', '2018-12-02 05:06:31'),
(58, 68, 1, 'HotNews_title_en', 'HotNews_desc_en', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:04:53', '2018-12-02 05:04:53'),
(59, 68, 2, 'HotNews_title_fr', 'HotNews_desc_fr', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:04:53', '2018-12-02 05:04:53'),
(60, 68, 3, 'HotNews_title_ar', 'HotNews_desc_ar', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:04:53', '2018-12-02 05:04:53'),
(61, 69, 1, 'syrianteam_title_en', 'syrianteam_desc_en', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:07:38', '2018-12-02 05:07:38'),
(62, 69, 2, 'syrianteam_title_fr', 'syrianteam_desc_fr', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:07:38', '2018-12-02 05:07:38'),
(63, 69, 3, 'syrianteam_title_ar', 'syrianteam_desc_ar', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:07:38', '2018-12-02 05:07:38'),
(64, 70, 1, 'italianTeam_title_en', 'italianTeam_desc_en', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:08:06', '2018-12-02 05:08:06'),
(65, 70, 2, 'italianTeam_title_fr', 'italianTeam_desc_fr', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:08:06', '2018-12-02 05:08:06'),
(66, 70, 3, 'italianTeam_title_ar', 'italianTeam_desc_ar', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:08:06', '2018-12-02 05:08:06'),
(67, 71, 1, 'AmericanTeam_title_en', 'AmericanTeam_desc_en', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:08:31', '2018-12-02 05:08:31'),
(68, 71, 2, 'AmericanTeam_title_fr', 'AmericanTeam_desc_fr', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:08:32', '2018-12-02 05:08:32'),
(69, 71, 3, 'AmericanTeam_title_ar', 'AmericanTeam_desc_ar', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:08:32', '2018-12-02 05:08:32'),
(70, 72, 1, 'monaliza_title_en', 'monaliza_desc_en', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:04:09', '2018-12-02 05:04:09'),
(71, 72, 2, 'monaliza_title_fr', 'monaliza_desc_fr', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:04:09', '2018-12-02 05:04:09'),
(72, 72, 3, 'monaliza_title_ar', 'monaliza_title_ar', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:04:09', '2018-12-02 05:04:09'),
(73, 73, 1, 'lionardo_title_en', 'lionardo_desc_en', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:21:10', '2018-12-02 05:21:10'),
(74, 73, 2, 'lionardo_title_fr', 'lionardo_desc_fr', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:21:10', '2018-12-02 05:21:10'),
(75, 73, 3, 'lionardo_title_ar', 'lionardo_desc_ar', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:21:10', '2018-12-02 05:21:10'),
(76, 74, 1, 'color_title_en', 'color_desc_en', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:18:51', '2018-12-02 05:18:51'),
(77, 74, 2, 'color_title_fr', 'color_desc_fr', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:18:51', '2018-12-02 05:18:51'),
(78, 74, 3, 'color_title_ar', 'color_desc_ar', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:18:51', '2018-12-02 05:18:51'),
(79, 75, 1, 'Oath_title_en', 'Oath_desc_en', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:13:47', '2018-12-02 05:13:47'),
(80, 75, 2, 'Oath_title_fr', 'Oath_desc_fr', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:13:47', '2018-12-02 05:13:47'),
(81, 75, 3, 'Oath_title_ar', 'Oath_desc_ar', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:13:47', '2018-12-02 05:13:47'),
(82, 76, 1, 'vida_title_en', 'vida_desc_en', 'vida_info_en', '2018-12-02 00:27:27', '2018-12-02 00:27:27'),
(83, 76, 2, 'vida_title_fr', 'vida_title_fr', 'vida_title_fr', '2018-12-02 00:27:27', '2018-12-02 00:27:27'),
(84, 76, 3, 'vida_title_ar', 'vida_title_ar', 'vida_title_ar', '2018-12-02 00:27:27', '2018-12-02 00:27:27'),
(85, 77, 1, 'mayores_title_en', 'mayores_desc_en', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:08:57', '2018-12-02 05:08:57'),
(86, 77, 2, 'mayores_title_fr', 'mayores_title_fr', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:08:57', '2018-12-02 05:08:57'),
(87, 77, 3, 'mayores_title_ar', 'mayores_title_ar', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:08:57', '2018-12-02 05:08:57'),
(88, 78, 1, 'mayores_title_en', 'mayores_title_en', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:12:19', '2018-12-02 05:12:19'),
(89, 78, 2, 'mayores_title_fr', 'monaliza_desc_fr', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:12:20', '2018-12-02 05:12:20'),
(90, 78, 3, 'mayores_title_ar', 'monaliza_desc_ar', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:12:20', '2018-12-02 05:12:20'),
(91, 79, 1, 'Oath_title_en', 'Oath_desc_en', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:14:54', '2018-12-02 05:14:54'),
(92, 79, 2, 'Oath_title_fr', 'Oath_desc_fr', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:14:55', '2018-12-02 05:14:55'),
(93, 79, 3, 'Oath_title_ar', 'Oath_desc_ar', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:14:55', '2018-12-02 05:14:55'),
(94, 80, 1, 'vida_title_en', 'vida_desc_en', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:16:44', '2018-12-02 05:16:44'),
(95, 80, 2, 'vida_title_fr', 'vida_title_fr', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:16:45', '2018-12-02 05:16:45'),
(96, 80, 3, 'vida_title_ar', 'vida_title_ar', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:16:45', '2018-12-02 05:16:45'),
(97, 82, 1, 'mayores_title_en', 'mayores_desc_en', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:20:48', '2018-12-02 05:20:48'),
(98, 82, 2, 'mayores_title_fr', 'monaliza_desc_fr', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:20:48', '2018-12-02 05:20:48'),
(99, 82, 3, 'mayores_title_ar', 'monaliza_desc_ar', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:20:48', '2018-12-02 05:20:48'),
(100, 84, 1, 'lionardo_title_en', 'lionardo_desc_en', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:23:13', '2018-12-02 05:23:13'),
(101, 84, 2, 'lionardo_title_fr', 'lionardo_desc_fr', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:23:13', '2018-12-02 05:23:13'),
(102, 84, 3, 'lionardo_title_ar', 'lionardo_desc_ar', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It\'s like the props in a furniture store—filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like. Second, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don\'t be afraid to use lorem ipsum to keep everyone focused.', '2018-12-02 05:23:13', '2018-12-02 05:23:13');

-- --------------------------------------------------------

--
-- Table structure for table `langmenuitems`
--

CREATE TABLE `langmenuitems` (
  `id` int(10) UNSIGNED NOT NULL,
  `menuitem_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `langmenuitems`
--

INSERT INTO `langmenuitems` (`id`, `menuitem_id`, `language_id`, `title`, `created_at`, `updated_at`) VALUES
(21, 57, 1, 'basketBall_en', '2018-12-02 00:31:52', '2018-12-02 00:31:52'),
(22, 57, 2, 'basketBall_fr', '2018-12-02 00:31:52', '2018-12-02 00:31:52'),
(23, 57, 3, 'basketBall_ar', '2018-12-02 00:31:52', '2018-12-02 00:31:52'),
(39, 63, 1, 'football_en', '2018-12-02 00:31:05', '2018-12-02 00:31:05'),
(40, 63, 2, 'football_fr', '2018-12-02 00:31:05', '2018-12-02 00:31:05'),
(41, 63, 3, 'football_ar', '2018-12-02 00:31:05', '2018-12-02 00:31:05'),
(42, 64, 1, 'tennis_en', '2018-12-02 00:33:22', '2018-12-02 00:33:22'),
(43, 64, 2, 'tennis_fr', '2018-12-02 00:33:23', '2018-12-02 00:33:23'),
(44, 64, 3, 'tennis_ar', '2018-12-02 00:33:23', '2018-12-02 00:33:23'),
(48, 66, 1, 'spotrs_en', '2018-12-02 00:30:32', '2018-12-02 00:30:32'),
(49, 66, 2, 'spotrs_fr', '2018-12-02 00:30:32', '2018-12-02 00:30:32'),
(50, 66, 3, 'spotrs_ar', '2018-12-02 00:30:32', '2018-12-02 00:30:32'),
(51, 67, 1, 'spotrs_en', '2018-12-02 00:34:07', '2018-12-02 00:34:07'),
(52, 67, 2, 'spotrs_fr', '2018-12-02 00:34:07', '2018-12-02 00:34:07'),
(53, 67, 3, 'spotrs_ar', '2018-12-02 00:34:07', '2018-12-02 00:34:07'),
(54, 68, 1, 'News_en', '2018-12-02 00:34:49', '2018-12-02 00:34:49'),
(55, 68, 2, 'News_fr', '2018-12-02 00:34:49', '2018-12-02 00:34:49'),
(56, 68, 3, 'News_ar', '2018-12-02 00:34:49', '2018-12-02 00:34:49'),
(57, 69, 1, 'songs_title_en', '2018-12-02 00:35:15', '2018-12-02 00:35:15'),
(58, 69, 2, 'songs_title_fr', '2018-12-02 00:35:15', '2018-12-02 00:35:15'),
(59, 69, 3, 'songs_title_ar', '2018-12-02 00:35:15', '2018-12-02 00:35:15'),
(60, 70, 1, 'Arts_en', '2018-12-02 00:35:53', '2018-12-02 00:35:53'),
(61, 70, 2, 'Arts_fr', '2018-12-02 00:35:53', '2018-12-02 00:35:53'),
(62, 70, 3, 'Arts_ar', '2018-12-02 00:35:53', '2018-12-02 00:35:53');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `LanguageName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `LanguageName`, `created_at`, `updated_at`) VALUES
(1, 'english', '2018-10-24 22:01:31', '2018-10-24 22:01:31'),
(2, 'french', '2018-10-24 22:01:31', '2018-10-24 22:01:31'),
(3, 'arabic', '2018-11-28 21:32:30', '2018-11-28 21:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `navOrder` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `category_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `navOrder`, `parent`, `visible`, `category_id`, `event_id`, `created_at`, `updated_at`) VALUES
(57, 2, 66, 0, 17, 1, '2018-12-02 00:31:52', '2018-12-02 00:31:52'),
(63, 1, 66, 0, 16, 1, '2018-12-02 00:31:05', '2018-12-02 00:31:05'),
(64, 3, 66, 0, 9, 1, '2018-12-02 00:33:23', '2018-12-02 00:33:23'),
(66, 0, 0, 0, 8, 0, '2018-12-02 00:30:32', '2018-12-02 00:30:32'),
(67, 6, 0, 1, 8, 0, '2018-12-02 00:34:07', '2018-12-02 00:34:07'),
(68, 2, 0, 1, 19, 0, '2018-12-02 00:34:49', '2018-12-02 00:34:49'),
(69, 3, 0, 0, 18, 0, '2018-12-02 00:35:15', '2018-12-02 00:35:15'),
(70, 4, 0, 1, 10, 0, '2018-12-02 00:35:53', '2018-12-02 00:35:53');

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
(46, '2018_11_05_001927_create_create_cat_customattr_table', 1),
(47, '2018_11_05_002051_create_create_item_customattr_table', 1),
(48, '2018_11_05_002201_create_create_item_cat_value_table', 1),
(49, '2018_11_05_002300_create_create_lang_item_custom_table', 1),
(50, '2018_11_05_002325_create_create_lang_cat_custom_table', 1),
(71, '2018_10_14_205652_create_menu_items_table', 2),
(72, '2018_10_14_205736_create_categories_table', 2),
(73, '2018_10_14_205753_create_items_table', 2),
(74, '2018_10_14_205817_create_events_table', 2),
(75, '2018_10_14_210255_create_themes_table', 2),
(76, '2018_10_24_212050_create_dictionaries_table', 2),
(77, '2018_10_24_212214_create_languages_table', 2),
(78, '2018_10_24_212618_create_langitems_table', 2),
(79, '2018_10_24_212733_create_langmenuitems_table', 2),
(80, '2018_10_24_212940_create_langcategories_table', 2),
(81, '2018_11_05_001927_create_catcustomattr_table', 2),
(82, '2018_11_05_002051_create_itemcustomattr_table', 2),
(83, '2018_11_05_002201_create_itemcatvalue_table', 2),
(84, '2018_11_05_002300_create_langitemcustom_table', 2),
(85, '2018_11_05_002325_create_langcatcustom_table', 2),
(86, '2018_11_13_214350_create_users_table', 3),
(87, '2018_11_13_214734_create_password_resets_table', 4),
(88, '2018_11_15_182934_laratrust_setup_tables', 5),
(89, '2018_11_23_230508_create_dic_lang_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'store_menuItem', 'Store', 'Add New Data', '2018-11-28 20:23:39', '2018-11-28 20:23:39'),
(3, 'edit_menuItem', 'Edit', 'Update Data with new', '2018-11-28 20:23:44', '2018-11-28 20:23:44'),
(4, 'delete_menuItem', 'Delete', 'delete existing Data', '2018-11-28 20:23:48', '2018-11-28 20:23:48'),
(5, 'browse_menuItem', 'Browse', 'view Data', '2018-11-28 20:23:52', '2018-11-28 20:23:52'),
(6, 'store_item', 'Store', 'Add New Data', '2018-11-28 20:24:35', '2018-11-28 20:24:35'),
(7, 'edit_item', 'Edit', 'Update Data with new', '2018-11-28 20:25:04', '2018-11-28 20:25:04'),
(8, 'delete_item', 'Delete', 'delete existing Data', '2018-11-28 20:25:25', '2018-11-28 20:25:25'),
(9, 'browse_item', 'Browse', 'view Data', '2018-11-28 20:25:45', '2018-11-28 20:25:45'),
(10, 'store_category', 'Store', 'Add New Data', '2018-11-28 20:26:13', '2018-11-28 20:26:13'),
(11, 'edit_category', 'Edit', 'Update Data with new', '2018-11-28 20:26:31', '2018-11-28 20:26:31'),
(12, 'delete_category', 'Delete', 'delete existing Data', '2018-11-28 20:26:50', '2018-11-28 20:26:50'),
(13, 'browse_category', 'Browse', 'view Data', '2018-11-28 20:27:26', '2018-11-28 20:27:26'),
(14, 'store_Language', 'Store', 'Add New Data', '2018-11-28 20:27:49', '2018-11-28 20:27:49'),
(15, 'edit_Language', 'Edit', 'Update Data with new', '2018-11-28 20:28:09', '2018-11-28 20:28:09'),
(16, 'delete_Language', 'Delete', 'delete existing Data', '2018-11-28 20:28:32', '2018-11-28 20:28:32'),
(17, 'browse_Language', 'Browse', 'view Data', '2018-11-28 20:28:50', '2018-11-28 20:28:50'),
(18, 'store_Dictionary', 'Store', 'Add New Data', '2018-11-28 20:29:37', '2018-11-28 20:29:37'),
(19, 'edit_Dictionary', 'Edit', 'Update Data with new', '2018-11-28 20:29:51', '2018-11-28 20:29:51'),
(20, 'delete_Dictionary', 'Delete', 'delete existing Data', '2018-11-28 20:30:14', '2018-11-28 20:30:14'),
(21, 'browse_Dictionary', 'Browse', 'view Data', '2018-11-28 20:31:07', '2018-11-28 20:31:07'),
(22, 'store_categoryCustom_attribute', 'Store', 'Add New Data', '2018-11-28 20:31:47', '2018-11-28 20:31:47'),
(23, 'edit_categoryCustom_attribute', 'Edit', 'Update Data with new', '2018-11-28 20:32:01', '2018-11-28 20:32:01'),
(24, 'delete_categoryCustom_attribute', 'Delete', 'delete existing Data', '2018-11-28 20:32:15', '2018-11-28 20:32:15'),
(25, 'browse_categoryCustom_attribute', 'Browse', 'view Data', '2018-11-28 20:32:34', '2018-11-28 20:32:34'),
(26, 'store_itemCustom_attribute', 'Store', 'Add New Data', '2018-11-28 20:33:06', '2018-11-28 20:33:06'),
(27, 'edit_itemCustom_attribute', 'Edit', 'Update Data with new', '2018-11-28 20:33:14', '2018-11-28 20:33:14'),
(28, 'delete_itemCustom_attribute', 'Delete', 'delete existing Data', '2018-11-28 20:33:26', '2018-11-28 20:33:26'),
(29, 'browse_itemCustom_attribute', 'Browse', 'view Data', '2018-11-28 20:33:37', '2018-11-28 20:33:37'),
(30, 'store_role', 'Store', 'Add New Data', '2018-11-28 20:33:57', '2018-11-28 20:33:57'),
(31, 'edit_role', 'Edit', 'Update Data with new', '2018-11-28 20:34:06', '2018-11-28 20:34:06'),
(32, 'delete_role', 'Delete', 'delete existing Data', '2018-11-28 20:34:18', '2018-11-28 20:34:18'),
(33, 'browse_role', 'Browse', 'view Data', '2018-11-28 20:34:29', '2018-11-28 20:34:29'),
(34, 'store_user', 'Store', 'Add New Data', '2018-11-28 20:36:04', '2018-11-28 20:36:04'),
(35, 'edit_user', 'Edit', 'Update Data with new', '2018-11-28 20:36:15', '2018-11-28 20:36:15'),
(36, 'delete_user', 'Delete', 'delete existing Data', '2018-11-28 20:36:25', '2018-11-28 20:36:25'),
(37, 'browse_user', 'Browse', 'view Data', '2018-11-28 21:32:59', '2018-11-28 21:32:59'),
(38, 'store_permission', 'Store', 'Add New Data', '2018-11-28 20:36:52', '2018-11-28 20:36:52'),
(39, 'edit_permission', 'Edit', 'Update Data with new', '2018-11-28 20:37:02', '2018-11-28 20:37:02'),
(40, 'delete_permission', 'Delete', 'delete existing Data', '2018-11-28 20:37:12', '2018-11-28 20:37:12'),
(41, 'browse_permission', 'Browse', 'view Data', '2018-11-28 20:37:23', '2018-11-28 20:37:23');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 4),
(1, 5),
(1, 25),
(3, 4),
(3, 5),
(3, 25),
(4, 4),
(4, 5),
(4, 25),
(5, 4),
(5, 5),
(5, 6),
(6, 4),
(6, 5),
(7, 4),
(7, 5),
(8, 4),
(8, 5),
(9, 4),
(9, 5),
(9, 6),
(10, 4),
(10, 5),
(11, 4),
(11, 5),
(12, 4),
(12, 5),
(13, 4),
(13, 5),
(13, 6),
(14, 4),
(15, 4),
(16, 4),
(17, 4),
(17, 5),
(18, 4),
(18, 5),
(19, 4),
(19, 5),
(20, 4),
(20, 5),
(21, 4),
(21, 5),
(22, 4),
(22, 5),
(23, 4),
(23, 5),
(24, 4),
(24, 5),
(25, 4),
(25, 5),
(26, 4),
(26, 5),
(27, 4),
(27, 5),
(28, 4),
(28, 5),
(29, 4),
(29, 5),
(30, 4),
(31, 4),
(32, 4),
(33, 4),
(34, 4),
(35, 4),
(36, 4),
(37, 4),
(38, 4),
(39, 4),
(40, 4),
(41, 4);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(4, 'admin_role_name', 'admin_role_display', 'admin_role_description', '2018-11-28 21:32:50', '2018-11-28 21:32:50'),
(5, 'dataentry_role_name', 'dataentry_role_display', 'dataentry_role_description', '2018-11-28 20:39:40', '2018-11-28 20:39:40'),
(6, 'enduser_role_name', 'enduser_role_display', 'enduser_role_description', '2018-11-28 20:40:33', '2018-11-28 20:40:33'),
(25, 'new_role_1', 'new_role_1', 'new_role_1', '2018-11-28 19:26:28', '2018-11-28 19:26:28');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(4, 2, 'App\\User'),
(5, 2, 'App\\User'),
(6, 2, 'App\\User'),
(5, 3, 'App\\User'),
(6, 3, 'App\\User'),
(6, 4, 'App\\User');

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'admin', 'admin@gmail.com', '$2y$10$pTBezs.MPNUTAETKuQ.NdeDHTz3g3BnhFLCtpbvir6PtC.cLJiEZu', 'WpsoFRf2Iy1zSmqfzS1PKtf3TmMThGI4Ix9pWfjkP8mzUfKfj21Pnja7Hgwl', '2018-11-17 10:55:46', '2018-11-17 10:55:46'),
(3, 'DataEntry', 'data@gmail.com', '$2y$10$gCUg7yQ5RiQIvyhBeJfd8em4XNLWDxPY31goC8lT7Xk4ai42TMKz6', 'J8dQ4OTMpEVITnRGAFKh5sQ0HSPVqA7AbrP4u2OGoElfy7jjFUQOymtHiIla', '2018-11-17 10:56:22', '2018-11-17 10:56:22'),
(4, 'EndUser', 'end@gmail.com', '$2y$10$YD4yopEVm8DiP3Jkdv5csO4LXuM2Dkd79BV.GT8vr7prGduz/.m8C', 'malejNM8wdWJp1hVviAVjsoblA9fVu4vK3Is8q4jBp7PkpAz696zzEcbPteD', '2018-11-17 10:56:53', '2018-11-17 10:56:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catcustomattrs`
--
ALTER TABLE `catcustomattrs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diclangs`
--
ALTER TABLE `diclangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dictionaries`
--
ALTER TABLE `dictionaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemcatvalues`
--
ALTER TABLE `itemcatvalues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemcustomattrs`
--
ALTER TABLE `itemcustomattrs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `langcatcustoms`
--
ALTER TABLE `langcatcustoms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `langcategories`
--
ALTER TABLE `langcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `langitemcustoms`
--
ALTER TABLE `langitemcustoms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `langitems`
--
ALTER TABLE `langitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `langmenuitems`
--
ALTER TABLE `langmenuitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`permission_id`,`user_id`,`user_type`),
  ADD KEY `permission_id` (`permission_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
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
-- AUTO_INCREMENT for table `catcustomattrs`
--
ALTER TABLE `catcustomattrs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `diclangs`
--
ALTER TABLE `diclangs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `dictionaries`
--
ALTER TABLE `dictionaries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `itemcatvalues`
--
ALTER TABLE `itemcatvalues`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `itemcustomattrs`
--
ALTER TABLE `itemcustomattrs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `langcatcustoms`
--
ALTER TABLE `langcatcustoms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `langcategories`
--
ALTER TABLE `langcategories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `langitemcustoms`
--
ALTER TABLE `langitemcustoms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `langitems`
--
ALTER TABLE `langitems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `langmenuitems`
--
ALTER TABLE `langmenuitems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
