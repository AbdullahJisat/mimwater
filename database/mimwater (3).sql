-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 28, 2022 at 01:38 PM
-- Server version: 5.7.33
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mimwater`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', 'admin', '2022-06-07 05:20:19', '$2y$10$e8s4N2DOPEbkb6AJiGyZVOUS1sDvy1cPdc6f7GwVuwWqASUtBqezy', NULL, 'r8kYCYpulZNJ1DEx31gYsJfhmvvXeEmHouyfxHc52WnMR4dL57xKDNiQ9TlJ', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'oil', '2022-06-13 23:55:04', '2022-06-13 23:55:04'),
(2, 'water', '2022-06-26 02:28:23', '2022-06-26 02:28:23');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `image`, `created_at`, `updated_at`) VALUES
(1, '/storage/upload/client_image/client-1.jpg', NULL, NULL),
(2, '/storage/upload/client_image/client-2.jpg', NULL, NULL),
(3, '/storage/upload/client_image/client-3.jpg', NULL, NULL),
(4, '/storage/upload/client_image/client-4.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client_reviews`
--

CREATE TABLE `client_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) DEFAULT '1' COMMENT '1-active,2-inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_reviews`
--

INSERT INTO `client_reviews` (`id`, `client_name`, `designation_id`, `image`, `company_name`, `review`, `status`, `created_at`, `updated_at`) VALUES
(1, 'err', 1, '/storage/upload/client_image/client-err.jpg', 'tee', 'fdsffsfsdgfhfgjgjjgjghj fgkjgjg;jkkdghkjkgj\r\nggkglhfghklfkhfgh\r\nhfhkljfhjfhjfh\r\nhhjfhklfjhkldfjh', 1, '2022-06-28 05:40:29', '2022-06-28 05:40:29'),
(2, 'wew', 4, '/storage/upload/client_image/client-wew.jpg', 'erwe', 'gdfggdfgdfgdfgdgdgdfg\r\ng\r\ndfg\r\ng\r\ng\r\ndfg\r\ndgdgdfgd\r\ngdg\r\nd\r\ngd\r\ngd\r\ngd\r\ngdf\r\ngdf\r\ngdf', 1, '2022-06-28 05:46:00', '2022-06-28 05:46:00');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `read` int(11) DEFAULT NULL COMMENT '1-read,0-unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `read`, `created_at`, `updated_at`) VALUES
(1, 'ffss', 'sfs@gmail.com', 'fffdggfgffhfhfhfhff\r\nhf\r\nffhfhfhfhfh\r\nhfhfhf', 1, '2022-06-28 07:07:40', '2022-06-28 07:21:29'),
(2, 'admin', 'admin@gmail.com', 'fsdfsfsfssfsfsd\r\nsdfsd\r\nfsd\r\nfsfsdfsfs', 1, '2022-06-28 07:22:12', '2022-06-28 07:22:42'),
(3, 'Shahidul Islam', 'sijisat@gmail.com', 'dsadasdghjsgjgsdjfs\r\nsfhjkfshfhsfshjkfhsf\r\nfhsdjkfhsjfhsjfhsjkfs\r\nfskfhsfhskshfks', 1, '2022-06-28 07:23:20', '2022-06-28 07:25:21');

-- --------------------------------------------------------

--
-- Table structure for table `costs`
--

CREATE TABLE `costs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `costs`
--

INSERT INTO `costs` (`id`, `category_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, '100.00', '2022-06-13 23:55:14', '2022-06-13 23:55:14'),
(2, 2, '125.00', '2022-06-26 02:30:58', '2022-06-26 02:30:58');

-- --------------------------------------------------------

--
-- Table structure for table `cost_categories`
--

CREATE TABLE `cost_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dealers`
--

CREATE TABLE `dealers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shopname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '1 - active & 0 - inactive',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dealers`
--

INSERT INTO `dealers` (`id`, `name`, `email`, `username`, `phone`, `location`, `shopname`, `shop_location`, `nid`, `email_verified_at`, `password`, `image`, `price`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Shahidul Islam', 'sijisat@gmail.com', 'jisat', '01647579646', 'dhaka', 'jio', 'dhaka', '3224', NULL, '$2y$10$e8s4N2DOPEbkb6AJiGyZVOUS1sDvy1cPdc6f7GwVuwWqASUtBqezy', NULL, NULL, NULL, NULL, '2022-06-07 05:22:17', '2022-06-07 05:22:17'),
(2, 'Shahidul Islam', 'ggat@gmail.com', 'AbdullahJisat', '801647579646', 'dhaka', 'dhak', 'dhaka', '3232', NULL, '123456789', NULL, NULL, NULL, NULL, '2022-06-14 05:06:01', '2022-06-14 05:06:01'),
(5, 'Shahidul Islam', 'ss@gmail.com', 'fiora', '016475964', 'dhaka', 'jio', 'dhaka', '32584', NULL, '$2y$10$e8s4N2DOPEbkb6AJiGyZVOUS1sDvy1cPdc6f7GwVuwWqASUtBqezy', NULL, NULL, NULL, NULL, '2022-06-14 05:55:49', '2022-06-14 05:55:49'),
(6, 'Shahidul Islam', 'wewe@gmail.comww', 'tahrin32', '1647579646', 'dhaka', 'jio', 'dhaka', '1233', NULL, '$2y$10$r8haTy6gFbl0w.3yniqrj.jLxMkdwtrwvJgofapNmFfOA6vdo2iza', NULL, NULL, 1, NULL, '2022-06-16 08:11:00', '2022-06-16 08:11:00'),
(7, 'jahirIslam', 'jahir@FMAIL.COM', 'jahir', '53534535', 'ctg', 'jahi', 'ctg', '34324343', NULL, '$2y$10$Cnl7fdt6Ih4N5NzM9/fnBuhMOBOP13jb1LA058t5tr7Ef7sdA5Gf.', NULL, NULL, 1, NULL, '2022-06-19 05:02:03', '2022-06-19 05:02:03'),
(8, 'new deale', 'newdealer@gmail.com', 'newdealer', '0128841245', 'dhaka', 'houqe', 'dhaka', '12447', NULL, '$2y$10$JtxSqhzQZBL633y2Cq50ae0P0t24z.pEbwdOBMyTVRb2iDY5l.10S', NULL, '40.00', 1, NULL, '2022-06-26 02:25:36', '2022-06-26 02:25:36');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Administartor', '2022-06-07 01:22:11', '2022-06-07 01:22:11'),
(2, 'HR', '2022-06-26 05:00:05', '2022-06-26 05:00:05'),
(3, 'wew', '2022-06-28 07:27:24', '2022-06-28 07:27:24');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Chairman', '2022-06-07 01:23:09', '2022-06-07 01:23:09'),
(2, 'AGM', '2022-06-19 04:29:59', '2022-06-19 04:29:59'),
(3, 'HR', '2022-06-26 05:00:24', '2022-06-26 05:00:24'),
(4, 'ceo', '2022-06-28 05:45:37', '2022-06-28 05:45:37');

-- --------------------------------------------------------

--
-- Table structure for table `directors`
--

CREATE TABLE `directors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `directors`
--

INSERT INTO `directors` (`id`, `name`, `image`, `email`, `phone`, `department_id`, `designation_id`, `created_at`, `updated_at`) VALUES
(1, 'Shahidul Islam', NULL, 'sijisat@gmail.com', '01647579646', 1, 1, '2022-06-07 01:23:27', '2022-06-07 01:23:27'),
(2, 'Shahidul Islam', '/storage/upload/director_image/director-0.png', 'ssa@gmail.com', '1647579646', 1, 1, '2022-06-16 08:42:42', '2022-06-16 08:42:42'),
(3, 'asfar', '/storage/upload/director_image/director-0.jpg', 'asfar@gmail.com', '0164757878', 1, 2, '2022-06-19 04:30:49', '2022-06-19 04:30:49'),
(4, 'eeew', '/storage/upload/director_image/director-eeew.jpg', 'ewe@gmail.com', '1647579634534', 1, 2, '2022-06-19 04:39:31', '2022-06-19 04:39:31'),
(5, 'kuddus', '/storage/upload/director_image/director-kuddus.jpg', 'kuddus@gmail.com', '015447', 2, 3, '2022-06-26 05:00:56', '2022-06-26 05:00:56'),
(6, 'fsdfsd', '/storage/upload/director_image/director-fsdfsd.jpg', 'ss@gmail.com', '232323242', 3, 4, '2022-06-28 07:27:52', '2022-06-28 07:27:52'),
(7, 're', '/storage/upload/director_image/director-re.jpg', 'ww@gmail.com', '23433', 2, 3, '2022-06-28 07:29:34', '2022-06-28 07:29:34');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `image`, `created_at`, `updated_at`) VALUES
(1, '/storage/upload/item_image/gallery-1.png', NULL, NULL),
(2, '/storage/upload/item_image/gallery-2.png', NULL, NULL),
(3, '/storage/upload/item_image/gallery-3.png', NULL, NULL),
(4, '/storage/upload/item_image/gallery-4.png', NULL, NULL),
(5, '/storage/upload/item_image/gallery-5.png', NULL, NULL),
(6, '/storage/upload/item_image/gallery-6.png', NULL, NULL),
(7, '/storage/upload/item_image/gallery-7.png', NULL, NULL),
(8, '/storage/upload/item_image/gallery-8.png', NULL, NULL),
(9, '/storage/upload/item_image/gallery-1.png', NULL, NULL),
(10, '/storage/upload/item_image/gallery-2.png', NULL, NULL),
(11, '/storage/upload/item_image/gallery-3.png', NULL, NULL),
(12, '/storage/upload/item_image/gallery-4.png', NULL, NULL),
(13, '/storage/upload/item_image/gallery-5.png', NULL, NULL),
(14, '/storage/upload/item_image/gallery-6.png', NULL, NULL),
(15, '/storage/upload/item_image/gallery-7.png', NULL, NULL),
(16, '/storage/upload/item_image/gallery-8.png', NULL, NULL),
(17, '/storage/upload/gallery_image/gallery-1.jpg', NULL, NULL),
(18, '/storage/upload/gallery_image/gallery-2.jpg', NULL, NULL),
(19, '/storage/upload/gallery_image/gallery-3.jpg', NULL, NULL),
(20, '/storage/upload/gallery_image/gallery-4.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'water', '/storage/upload/item_image/water-.png', '2022-06-07 05:23:40', '2022-06-07 05:23:40'),
(2, 'tel', '/storage/upload/tel_image/tel-.jpg', '2022-06-26 07:23:36', '2022-06-26 07:23:36'),
(3, 'oil', '/storage/upload/oil_image/oil-.jpg', '2022-06-28 04:20:19', '2022-06-28 04:20:19'),
(4, '300ml', '/storage/upload/300ml_image/300ml-.jpg', '2022-06-28 04:30:26', '2022-06-28 04:30:26');

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_04_21_083627_create_admins_table', 1),
(3, '2022_05_08_063936_create_salesmen_table', 1),
(4, '2022_05_28_073018_create_dealers_table', 1),
(5, '2022_05_28_093004_create_retailers_table', 1),
(6, '2022_05_28_122307_create_items_table', 1),
(7, '2022_05_30_073508_create_request_bottles_table', 1),
(8, '2022_05_30_095821_create_stock_items_table', 1),
(9, '2022_06_01_073226_add_price_to_retailer_table', 1),
(10, '2022_06_01_073415_add_price_to_dealers_table', 1),
(11, '2022_06_01_083207_create_categories_table', 1),
(12, '2022_06_01_083302_create_costs_table', 1),
(13, '2022_06_01_083547_create_cost_categories_table', 1),
(14, '2022_06_06_120844_create_departments_table', 1),
(15, '2022_06_06_120911_create_designations_table', 1),
(16, '2022_06_06_120912_create_directors_table', 1),
(17, '2022_06_07_081544_create_galleries_table', 2),
(20, '2022_06_09_075550_create_payments_table', 3),
(21, '2022_06_11_080459_create_stock_out_items_table', 3),
(22, '2022_06_14_070604_add_total_to_payments_table', 4),
(23, '2022_06_19_121143_create_production_facilities_table', 5),
(24, '2022_06_19_122840_create_news_events_table', 6),
(25, '2022_06_28_111055_create_client_reviews_table', 7),
(26, '2022_06_28_115704_create_clients_table', 8),
(27, '2022_06_28_124249_create_contacts_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `news_events`
--

CREATE TABLE `news_events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news_events`
--

INSERT INTO `news_events` (`id`, `image`, `created_at`, `updated_at`) VALUES
(1, '/storage/upload/newsEvents_image/newsEvents-1.jpg', NULL, NULL),
(2, '/storage/upload/newsEvents_image/newsEvents-2.jpg', NULL, NULL),
(3, '/storage/upload/newsEvents_image/newsEvents-3.jpg', NULL, NULL),
(4, '/storage/upload/newsEvents_image/newsEvents-4.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `retailer_id` int(10) UNSIGNED DEFAULT NULL,
  `dealer_id` int(10) UNSIGNED DEFAULT NULL,
  `salesman_id` int(10) UNSIGNED DEFAULT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL,
  `item_id` text COLLATE utf8mb4_unicode_ci,
  `amount` decimal(8,2) DEFAULT NULL,
  `due` decimal(8,2) DEFAULT NULL,
  `total` decimal(8,2) DEFAULT NULL,
  `payment_type` tinyint(3) UNSIGNED DEFAULT NULL COMMENT '1-cash,2-check,3-mobile',
  `payment_status` tinyint(3) UNSIGNED DEFAULT NULL COMMENT '1-success,2-failed,3-due,4-partial due',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `invoice_no`, `retailer_id`, `dealer_id`, `salesman_id`, `admin_id`, `item_id`, `amount`, `due`, `total`, `payment_type`, `payment_status`, `created_at`, `updated_at`) VALUES
(16, NULL, 7, NULL, 1, NULL, '38', '20.00', '80.00', '100.00', 1, NULL, '2022-06-28 03:46:01', '2022-06-28 03:46:01'),
(17, NULL, 7, NULL, 1, NULL, '2', '80.00', '0.00', '80.00', 1, NULL, '2022-06-28 04:10:56', '2022-06-28 04:10:56'),
(18, NULL, 7, NULL, 1, NULL, '2', '100.00', '150.00', '250.00', 1, NULL, '2022-06-28 04:15:30', '2022-06-28 04:15:30'),
(19, NULL, 7, NULL, 1, NULL, '2', '200.00', '200.00', '400.00', 1, NULL, '2022-06-28 04:17:03', '2022-06-28 04:17:03');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `production_facilities`
--

CREATE TABLE `production_facilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `production_facilities`
--

INSERT INTO `production_facilities` (`id`, `image`, `created_at`, `updated_at`) VALUES
(1, '/storage/upload/ProductionFacilities_image/ProductionFacilities-1.jpg', NULL, NULL),
(2, '/storage/upload/ProductionFacilities_image/ProductionFacilities-2.jpg', NULL, NULL),
(3, '/storage/upload/ProductionFacilities_image/ProductionFacilities-3.jpg', NULL, NULL),
(4, '/storage/upload/ProductionFacilities_image/ProductionFacilities-4.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `request_bottles`
--

CREATE TABLE `request_bottles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED DEFAULT NULL,
  `retailer_id` int(10) UNSIGNED DEFAULT NULL,
  `dealer_id` int(10) UNSIGNED DEFAULT NULL,
  `quantity` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `request_bottles`
--

INSERT INTO `request_bottles` (`id`, `item_id`, `retailer_id`, `dealer_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 5, '2022-06-14 00:55:53', '2022-06-14 00:55:53'),
(2, 1, 1, NULL, 10, '2022-06-14 06:00:23', '2022-06-14 06:00:23'),
(3, 1, 1, NULL, 6, '2022-06-16 12:09:19', '2022-06-16 12:09:19'),
(4, 1, 1, NULL, 23, '2022-06-19 05:08:48', '2022-06-19 05:08:48'),
(5, 1, 7, NULL, 67, '2022-06-19 05:10:42', '2022-06-19 05:10:42'),
(6, 1, NULL, 7, 34, '2022-06-19 05:12:32', '2022-06-19 05:12:32');

-- --------------------------------------------------------

--
-- Table structure for table `retailers`
--

CREATE TABLE `retailers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shopname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salesman_id` int(10) UNSIGNED DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '1 - active & 0 - inactive',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `retailers`
--

INSERT INTO `retailers` (`id`, `name`, `email`, `username`, `phone`, `location`, `shopname`, `shop_location`, `nid`, `email_verified_at`, `password`, `image`, `salesman_id`, `price`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'retail', 'retail@gmail.com', 'retail', '01845536056', 'dhaka', 'dhak', 'dhaka', '232', NULL, '$2y$10$e8s4N2DOPEbkb6AJiGyZVOUS1sDvy1cPdc6f7GwVuwWqASUtBqezy', NULL, 1, '20.00', NULL, NULL, '2022-06-07 05:23:21', '2022-06-07 05:23:21'),
(2, 'Shahidul Islam', 'sijisat@gmail.com', '12fsdf', '01647579646', 'dhaka', 'jio', 'dhaka', '34324', NULL, '123456789', NULL, 1, NULL, NULL, NULL, '2022-06-14 00:42:44', '2022-06-14 00:42:44'),
(3, 'Shahidul Islam', 't@gmail.com', 'tahrin', '47579646', 'dhaka', 'jio', 'dhaka', '322443', NULL, '123456789', NULL, 1, '50.00', NULL, NULL, '2022-06-14 06:02:40', '2022-06-14 06:02:40'),
(6, 'Shahidul 45', '545@gmail.com', 'tio', '579646', 'dhaka', 'jio', 'dhaka', '322465', NULL, '$2y$10$TN5zj7ZD7cTNzmU8e.WtdewrLp26XHhElPnrnqtJhm1jDslv0uBNy', NULL, NULL, '40.00', 1, NULL, '2022-06-14 06:23:27', '2022-06-14 06:23:27'),
(7, 'jamil', 'jamil@gmail.com', 'jamil', '125445', 'dhaka', 'salim', 'dhkaa', '47785', NULL, '$2y$10$J7qDvnfU5H9KIWo09Pd2QOtyg1qEXAGzWZWV5RpSmIku4kiKS2Rte', NULL, NULL, '50.00', 1, NULL, '2022-06-26 07:22:57', '2022-06-26 07:22:57');

-- --------------------------------------------------------

--
-- Table structure for table `salesmen`
--

CREATE TABLE `salesmen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '1 - active & 0 - inactive',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salesmen`
--

INSERT INTO `salesmen` (`id`, `name`, `email`, `username`, `phone`, `location`, `nid`, `email_verified_at`, `password`, `image`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'salesman', 'salesman@admin.com', 'salesman', '01645567', 'dhaka', '3434343', '2022-06-08 02:36:36', '$2y$10$IEk0xMgpwmPNWNb/wOWCUePHPcA/fNMBPhup4BxZT4TnwFoXsMVWK', NULL, 1, 'qvwTwObk9VyKYko9o2YVdm1K4z3e8YKKUrt15B0jbED8PU4FX4inIs3Gv15q', NULL, NULL),
(2, 'Shahidul Islam', 'sijisat@gmail.com', 'koi', '01647579646', 'dhaka', '197215174310011', NULL, '123456789', NULL, NULL, NULL, '2022-06-13 23:29:00', '2022-06-13 23:29:00'),
(4, 'Shahidul Islam', 'sat@gmail.com', 'ass', '801647579646', 'dhaka', '34', NULL, '123456789', NULL, NULL, NULL, '2022-06-14 05:03:18', '2022-06-14 05:03:18'),
(5, 'Shahidul Islam', 'wqw@gmail.comw', 'tahrin', '1647579646', 'dhaka', '3224232', NULL, '$2y$10$ehLZDDsJzg6KmF5Htr/G4.beyYyYLhfEUDLajJropsnfmyPnohF6i', NULL, 1, NULL, '2022-06-16 08:03:17', '2022-06-16 08:03:17'),
(6, 'new', 'new@gmail.com', 'newsalesman', '018522477', 'dhaka', '1285145454', NULL, '$2y$10$v1efzJUadqBiUSfwpB5rKOOceAsedLyalnsNXd/VFvAfqFcnMyUTO', NULL, 1, NULL, '2022-06-26 02:24:28', '2022-06-26 02:24:28');

-- --------------------------------------------------------

--
-- Table structure for table `stock_items`
--

CREATE TABLE `stock_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED DEFAULT NULL,
  `retailer_id` int(10) UNSIGNED DEFAULT NULL,
  `dealer_id` int(10) UNSIGNED DEFAULT NULL,
  `quantity` int(10) UNSIGNED DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `stock` tinyint(3) UNSIGNED DEFAULT NULL COMMENT '0-out,1-in',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_items`
--

INSERT INTO `stock_items` (`id`, `item_id`, `retailer_id`, `dealer_id`, `quantity`, `price`, `stock`, `created_at`, `updated_at`) VALUES
(16, 1, 1, NULL, 36, '0.00', 1, '2022-06-11 03:51:40', '2022-06-12 03:11:04'),
(17, 1, 2, NULL, 0, '0.00', 1, '2022-06-14 00:56:33', '2022-06-14 00:57:33'),
(18, 1, 3, NULL, 22, '0.00', 1, '2022-06-14 06:03:26', '2022-06-14 07:24:16'),
(19, 1, 6, NULL, 0, '0.00', 1, '2022-06-14 06:24:19', '2022-06-14 06:51:14'),
(20, 1, NULL, 8, 8, '0.00', 1, '2022-06-26 03:07:11', '2022-06-26 03:23:14'),
(21, 2, 7, NULL, 5, '0.00', 1, '2022-06-26 07:24:10', '2022-06-28 04:16:43');

-- --------------------------------------------------------

--
-- Table structure for table `stock_out_items`
--

CREATE TABLE `stock_out_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED DEFAULT NULL,
  `retailer_id` int(10) UNSIGNED DEFAULT NULL,
  `dealer_id` int(10) UNSIGNED DEFAULT NULL,
  `quantity` int(10) UNSIGNED DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_out_items`
--

INSERT INTO `stock_out_items` (`id`, `item_id`, `retailer_id`, `dealer_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(9, 1, 1, NULL, 2, '40.00', '2022-06-11 04:08:41', '2022-06-11 04:08:41'),
(10, 1, 1, NULL, 1, '20.00', '2022-06-11 23:15:45', '2022-06-11 23:15:45'),
(11, 1, 1, NULL, 3, '60.00', '2022-06-12 02:56:13', '2022-06-12 02:56:13'),
(12, 1, 1, NULL, 3, '60.00', '2022-06-12 02:57:06', '2022-06-12 02:57:06'),
(13, 1, 1, NULL, 2, '40.00', '2022-06-12 02:57:40', '2022-06-12 02:57:40'),
(14, 1, 1, NULL, 1, '20.00', '2022-06-12 03:01:19', '2022-06-12 03:01:19'),
(15, 1, 1, NULL, 3, '60.00', '2022-06-12 03:09:57', '2022-06-12 03:09:57'),
(16, 1, 1, NULL, 3, '60.00', '2022-06-12 03:10:51', '2022-06-12 03:10:51'),
(17, 1, 1, NULL, 3, '60.00', '2022-06-12 03:11:04', '2022-06-12 03:11:04'),
(18, 1, 2, NULL, 5, '0.00', '2022-06-14 00:57:34', '2022-06-14 00:57:34'),
(19, 1, 3, NULL, 5, '0.00', '2022-06-14 06:07:21', '2022-06-14 06:07:21'),
(20, 1, 3, NULL, 5, '250.00', '2022-06-14 06:12:42', '2022-06-14 06:12:42'),
(21, 1, 6, NULL, 10, '400.00', '2022-06-14 06:24:42', '2022-06-14 06:24:42'),
(22, 1, 6, NULL, 5, '200.00', '2022-06-14 06:51:14', '2022-06-14 06:51:14'),
(23, 1, 3, NULL, 0, '0.00', '2022-06-14 07:23:05', '2022-06-14 07:23:05'),
(24, 1, 3, NULL, 8, '400.00', '2022-06-14 07:23:19', '2022-06-14 07:23:19'),
(25, 1, 3, NULL, 5, '250.00', '2022-06-14 07:24:16', '2022-06-14 07:24:16'),
(26, 1, NULL, 8, 10, '400.00', '2022-06-26 03:14:10', '2022-06-26 03:14:10'),
(27, 1, NULL, 8, 5, '200.00', '2022-06-26 03:14:47', '2022-06-26 03:14:47'),
(28, 1, NULL, 8, 5, '200.00', '2022-06-26 03:22:41', '2022-06-26 03:22:41'),
(29, 1, NULL, 8, 2, '80.00', '2022-06-26 03:23:14', '2022-06-26 03:23:14'),
(30, 2, 7, NULL, 2, '100.00', '2022-06-26 07:24:39', '2022-06-26 07:24:39'),
(31, 2, 7, NULL, 2, '100.00', '2022-06-26 07:42:55', '2022-06-26 07:42:55'),
(32, 2, 7, NULL, 2, '100.00', '2022-06-26 07:47:51', '2022-06-26 07:47:51'),
(33, 2, 7, NULL, 2, '100.00', '2022-06-26 23:51:52', '2022-06-26 23:51:52'),
(34, 2, 7, NULL, 2, '100.00', '2022-06-28 02:04:51', '2022-06-28 02:04:51'),
(35, 2, 7, NULL, 0, '0.00', '2022-06-28 02:57:37', '2022-06-28 02:57:37'),
(36, 2, 7, NULL, 0, '0.00', '2022-06-28 03:32:59', '2022-06-28 03:32:59'),
(37, 2, 7, NULL, 0, '0.00', '2022-06-28 03:39:44', '2022-06-28 03:39:44'),
(38, 2, 7, NULL, 2, '100.00', '2022-06-28 03:45:49', '2022-06-28 03:45:49'),
(39, 2, 7, NULL, 0, '0.00', '2022-06-28 03:47:41', '2022-06-28 03:47:41'),
(40, 2, 7, NULL, 0, '0.00', '2022-06-28 04:11:15', '2022-06-28 04:11:15'),
(41, 2, 7, NULL, 5, '250.00', '2022-06-28 04:15:21', '2022-06-28 04:15:21'),
(42, 2, 7, NULL, 5, '250.00', '2022-06-28 04:16:43', '2022-06-28 04:16:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_reviews`
--
ALTER TABLE `client_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `costs`
--
ALTER TABLE `costs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cost_categories`
--
ALTER TABLE `cost_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealers`
--
ALTER TABLE `dealers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dealers_email_unique` (`email`),
  ADD UNIQUE KEY `dealers_username_unique` (`username`),
  ADD UNIQUE KEY `dealers_phone_unique` (`phone`),
  ADD UNIQUE KEY `dealers_nid_unique` (`nid`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `directors`
--
ALTER TABLE `directors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_events`
--
ALTER TABLE `news_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `production_facilities`
--
ALTER TABLE `production_facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_bottles`
--
ALTER TABLE `request_bottles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retailers`
--
ALTER TABLE `retailers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `retailers_email_unique` (`email`),
  ADD UNIQUE KEY `retailers_username_unique` (`username`),
  ADD UNIQUE KEY `retailers_phone_unique` (`phone`),
  ADD UNIQUE KEY `retailers_nid_unique` (`nid`);

--
-- Indexes for table `salesmen`
--
ALTER TABLE `salesmen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `salesmen_email_unique` (`email`),
  ADD UNIQUE KEY `salesmen_username_unique` (`username`),
  ADD UNIQUE KEY `salesmen_phone_unique` (`phone`),
  ADD UNIQUE KEY `salesmen_nid_unique` (`nid`);

--
-- Indexes for table `stock_items`
--
ALTER TABLE `stock_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_out_items`
--
ALTER TABLE `stock_out_items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `client_reviews`
--
ALTER TABLE `client_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `costs`
--
ALTER TABLE `costs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cost_categories`
--
ALTER TABLE `cost_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealers`
--
ALTER TABLE `dealers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `directors`
--
ALTER TABLE `directors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `news_events`
--
ALTER TABLE `news_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `production_facilities`
--
ALTER TABLE `production_facilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `request_bottles`
--
ALTER TABLE `request_bottles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `retailers`
--
ALTER TABLE `retailers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `salesmen`
--
ALTER TABLE `salesmen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stock_items`
--
ALTER TABLE `stock_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `stock_out_items`
--
ALTER TABLE `stock_out_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
