-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 30, 2022 at 01:58 PM
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
-- Database: `meem`
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
(1, 'admin', 'admin@admin.com', 'admin', '2022-06-29 06:56:33', '$2y$10$AxKzHQMQFCbOaBM0gcHlUOpo8fkLoNxfbwY4O68G1vCxJizKTGTAe', NULL, 'HjYmQFMsedBmAoUx2U2rMfiKridkWjjyIb3bW5nOrhE9Clb1xMUzWrFrceyC', NULL, NULL);

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
(1, 'breakfast', '2022-06-29 07:02:49', '2022-06-29 07:02:49');

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
(1, '/storage/upload/client_image/client-1.jpeg', NULL, NULL),
(2, '/storage/upload/client_image/client-2.jpeg', NULL, NULL),
(3, '/storage/upload/client_image/client-3.jpeg', NULL, NULL),
(4, '/storage/upload/client_image/client-4.jpeg', NULL, NULL);

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
(1, 'client', 1, '/storage/upload/client_image/client-client.jpeg', 'souq', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2022-06-29 06:58:00', '2022-06-29 06:58:00');

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
(1, 1, '190.00', '2022-06-29 07:02:56', '2022-06-29 07:02:56');

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
(1, 'dealer', 'dealer@gmail.com', 'dealer', '0189165', 'chittagong', 'sohid shop', 'chittagong', '5106165763', NULL, '$2y$10$SJGKlzIE/GIpgzF81u1xn.suzmcCz8lxOxKbqRAbo1AUa5etWG/eG', NULL, '10.00', 1, NULL, '2022-06-29 06:58:34', '2022-06-29 06:58:34');

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
(1, 'Administration', '2022-06-29 06:59:54', '2022-06-29 06:59:54');

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
(1, 'CEO', '2022-06-29 06:57:13', '2022-06-29 06:57:13');

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
(1, 'Director', '/storage/upload/director_image/director-Director.png', 'dir@gmail.com', '01891656910', 1, 1, '2022-06-29 07:00:11', '2022-06-29 07:00:11');

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
(1, 'water 300ml', '/storage/upload/item_image/item-water 300ml.jpg', '2022-06-29 07:03:17', '2022-06-29 07:03:17');

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
(13, '2022_06_06_120844_create_departments_table', 1),
(14, '2022_06_06_120911_create_designations_table', 1),
(15, '2022_06_06_120912_create_directors_table', 1),
(16, '2022_06_07_081544_create_galleries_table', 1),
(17, '2022_06_09_075550_create_payments_table', 1),
(18, '2022_06_11_080459_create_stock_out_items_table', 1),
(19, '2022_06_14_070604_add_total_to_payments_table', 1),
(20, '2022_06_19_121143_create_production_facilities_table', 1),
(21, '2022_06_19_122840_create_news_events_table', 1),
(22, '2022_06_28_111055_create_client_reviews_table', 1),
(23, '2022_06_28_115704_create_clients_table', 1),
(24, '2022_06_28_124249_create_contacts_table', 1);

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
(1, '1', NULL, 1, NULL, 1, '1', '20.00', '0.00', '20.00', 1, NULL, '2022-06-29 07:14:59', '2022-06-30 07:47:04'),
(2, NULL, NULL, 1, NULL, 1, '1', '30.00', '0.00', '50.00', 1, NULL, '2022-06-29 07:20:32', '2022-06-30 07:47:04'),
(3, NULL, NULL, 1, NULL, 1, '1', '15.00', '0.00', '50.00', 1, NULL, '2022-06-29 07:21:15', '2022-06-30 07:47:04'),
(4, NULL, NULL, 1, NULL, 1, '1', '50.00', '0.00', '55.00', 1, NULL, '2022-06-29 07:32:53', '2022-06-30 07:47:04'),
(5, NULL, NULL, 1, NULL, 1, '1', '25.00', '0.00', '25.00', 1, NULL, '2022-06-29 07:33:56', '2022-06-30 07:47:04'),
(7, '2', 2, NULL, 1, NULL, '1', '20.00', '0.00', '60.00', NULL, NULL, '2022-06-30 04:58:02', '2022-06-30 05:20:38'),
(9, NULL, 1, NULL, 1, NULL, '1', '0.00', '0.00', '0.00', NULL, NULL, '2022-06-30 05:17:54', '2022-06-30 05:17:54'),
(10, NULL, 2, NULL, 1, NULL, '1', '20.00', '20.00', '40.00', NULL, NULL, '2022-06-30 05:20:38', '2022-06-30 05:20:38'),
(11, NULL, NULL, 1, NULL, 1, '1', '50.00', '0.00', '200.00', 1, NULL, '2022-06-30 07:46:26', '2022-06-30 07:47:04'),
(12, NULL, NULL, 1, NULL, 1, '1', '200.00', '0.00', '200.00', 1, NULL, '2022-06-30 07:47:04', '2022-06-30 07:47:04'),
(13, NULL, 3, NULL, 1, NULL, '1', NULL, '0.00', '200.00', NULL, NULL, '2022-06-30 07:52:27', '2022-06-30 07:52:47'),
(14, NULL, 3, NULL, 1, NULL, '1', '200.00', '0.00', '200.00', NULL, NULL, '2022-06-30 07:52:47', '2022-06-30 07:52:47');

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
(1, 1, NULL, 1, 300, '2022-06-29 07:04:08', '2022-06-29 07:04:08'),
(2, 1, NULL, 1, 500, '2022-06-30 07:54:31', '2022-06-30 07:54:31');

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
(1, 'retailer', 'retail@gmail.com', 'retailer', '0242', 'dhaka', 'jio', 'dhaka', '432423', NULL, '$2y$10$FN/9ny7yGdPjxJ9f/hdmYOhHV/9pv2BiE9DvTJcTev/Ex9jxTXLk6', NULL, 1, '30.00', 1, NULL, '2022-06-30 04:33:07', '2022-06-30 04:33:07'),
(2, 'retail2', 'retail2@gmail.com', 'retail2', '0402348242', 'dhaka', 'dhak', 'dhaka', '3234234', NULL, '$2y$10$HT7uura/5.XhGmaLQ/F9LuQtzMLV1n1Fwz9PnSl7iLy0pbY2AKp5O', NULL, 1, '20.00', 1, NULL, '2022-06-30 04:36:30', '2022-06-30 04:36:30'),
(3, 'retail', 'r@gmail.com', 'retail', '12354645', 'ctg', 'ctg shop', 'ctg', '345664567', NULL, '$2y$10$hiSr5Bc6PXIDX8R0EBrO.eGBV890l5Y4xuRzryIDrVzSJ4OqxNhFC', NULL, 1, '20.00', 1, NULL, '2022-06-30 07:49:37', '2022-06-30 07:49:37');

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
(1, 'salesman', 'salesman@gmail.com', 'salesman', '0125855225', 'chittagong', '12345677890', NULL, '$2y$10$84fwRFAYz5Bk3FNZ6qYtie9YWQifx2Wvtd54KZIaJXDgryjgW4wje', NULL, 1, NULL, '2022-06-29 06:59:18', '2022-06-29 06:59:18'),
(3, 'salesman2', 'salesman2@gmail.com', 'salesman2', '0424234', 'chittagong', '323123', NULL, '$2y$10$zs8x61Mv90y7FwW1nVQe1u.46PwZVcLUqQAgd/XhdDhGLXpXaZ9Dq', NULL, 1, NULL, '2022-06-30 07:41:57', '2022-06-30 07:41:57');

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
(1, 1, NULL, 1, 209, '0.00', 1, '2022-06-29 07:05:05', '2022-06-30 07:46:53'),
(2, 1, 1, NULL, 23, '0.00', 1, '2022-06-30 04:43:07', '2022-06-30 05:13:14'),
(3, 1, 2, NULL, 12, '0.00', 1, '2022-06-30 04:43:18', '2022-06-30 05:20:32'),
(4, 1, 3, NULL, 190, '0.00', 1, '2022-06-30 07:50:35', '2022-06-30 07:52:22');

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
(1, 1, NULL, 1, 2, '20.00', '2022-06-29 07:14:30', '2022-06-29 07:14:30'),
(2, 1, NULL, 1, 5, '50.00', '2022-06-29 07:20:22', '2022-06-29 07:20:22'),
(3, 1, NULL, 1, 3, '30.00', '2022-06-29 07:21:00', '2022-06-29 07:21:00'),
(4, 1, NULL, 1, 2, '20.00', '2022-06-29 07:30:39', '2022-06-29 07:30:39'),
(5, 1, NULL, 1, 2, '20.00', '2022-06-29 07:31:44', '2022-06-29 07:31:44'),
(6, 1, NULL, 1, 2, '20.00', '2022-06-29 07:33:34', '2022-06-29 07:33:34'),
(7, 1, 1, NULL, 2, '60.00', '2022-06-30 04:54:11', '2022-06-30 04:54:11'),
(8, 1, 2, NULL, 3, '60.00', '2022-06-30 04:57:47', '2022-06-30 04:57:47'),
(9, 1, 1, NULL, 0, '0.00', '2022-06-30 04:58:41', '2022-06-30 04:58:41'),
(10, 1, 1, NULL, 0, '0.00', '2022-06-30 05:13:14', '2022-06-30 05:13:14'),
(11, 1, 2, NULL, 0, '0.00', '2022-06-30 05:20:32', '2022-06-30 05:20:32'),
(12, 1, NULL, 1, 20, '200.00', '2022-06-30 07:45:20', '2022-06-30 07:45:20'),
(13, 1, NULL, 1, 5, '50.00', '2022-06-30 07:46:53', '2022-06-30 07:46:53'),
(14, 1, 3, NULL, 10, '200.00', '2022-06-30 07:52:22', '2022-06-30 07:52:22');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `client_reviews`
--
ALTER TABLE `client_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `costs`
--
ALTER TABLE `costs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dealers`
--
ALTER TABLE `dealers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `directors`
--
ALTER TABLE `directors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `news_events`
--
ALTER TABLE `news_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `production_facilities`
--
ALTER TABLE `production_facilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_bottles`
--
ALTER TABLE `request_bottles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `retailers`
--
ALTER TABLE `retailers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `salesmen`
--
ALTER TABLE `salesmen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock_items`
--
ALTER TABLE `stock_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock_out_items`
--
ALTER TABLE `stock_out_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
