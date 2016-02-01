-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 01 Février 2016 à 01:28
-- Version du serveur :  10.1.9-MariaDB
-- Version de PHP :  5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_starwars`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Lasers', 'Une sorte d''épée à lame énergétique', '2016-01-22 15:48:00', '0000-00-00 00:00:00'),
(2, 'Casques', 'blablabla', '2016-01-22 15:48:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `number_card` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `number_command` smallint(6) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `address`, `number_card`, `number_command`, `created_at`, `updated_at`) VALUES
(1, 1, '6712 Schroeder Shore\nNew Sophie, OK 43319', '1234567890123456', 28, '2016-02-01 00:05:17', '2016-02-01 00:05:17'),
(2, 2, '728 Rutherford Street Suite 906\nJenningsbury, WI 04055-2178', '1234567890123456', 49, '2016-01-31 11:59:11', '2016-01-31 11:59:11'),
(3, 3, '1786 Bradtke Spur Apt. 528\nDoyleside, NM 47104-0198', '1234567890123456', 0, '2016-01-28 09:24:42', '2016-01-22 15:48:00'),
(4, 4, '39731 Gleason Lakes Apt. 213\nSherwoodstad, MI 04351', '1234567890123456', 0, '2016-01-28 09:24:45', '2016-01-22 15:48:00'),
(5, 5, '31986 Ernestina Lakes Apt. 801\nLake Marquise, NE 97624-1330', '1234567890123456', 7, '2016-01-28 09:24:38', '2016-01-26 11:15:41'),
(7, 15, 'Paris France', '1234567890123456', 0, '2016-01-31 23:21:35', '2016-01-31 23:21:35'),
(8, 8, 'Paris France', '1234567890123456', 2, '2016-01-31 23:27:23', '2016-01-31 23:27:23'),
(11, 9, 'Paris France', '1234567890123456', 0, '2016-01-31 23:31:47', '2016-01-31 23:31:47'),
(13, 6, 'Paris France', '1234567890123456', 1, '2016-01-31 23:48:35', '2016-01-31 23:48:35'),
(14, 7, 'Paris France', '1234567890123456', 1, '2016-01-31 23:49:50', '2016-01-31 23:49:50'),
(15, 16, 'Paris France', '1234567890123456', 1, '2016-01-31 23:51:13', '2016-01-31 23:51:13'),
(16, 17, 'Paris France', '1234567890123456', 1, '2016-02-01 00:08:32', '2016-02-01 00:08:32'),
(17, 18, 'Paris France', '1234567890123456', 1, '2016-02-01 00:25:39', '2016-02-01 00:25:39');

-- --------------------------------------------------------

--
-- Structure de la table `histories`
--

CREATE TABLE `histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `command_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `command_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('finalized','unfinalized') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'unfinalized',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `histories`
--

INSERT INTO `histories` (`id`, `command_id`, `product_id`, `customer_id`, `price`, `quantity`, `command_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, '1581.90', 2, '2016-01-22 21:29:09', 'unfinalized', '2016-01-22 21:29:09', '2016-01-22 21:29:09'),
(2, 2, 4, 1, '1324.11', 1, '2016-01-25 09:10:46', 'unfinalized', '2016-01-25 09:10:46', '2016-01-25 09:10:46'),
(3, 3, 3, 2, '859.17', 1, '2016-01-25 09:38:54', 'unfinalized', '2016-01-25 09:38:54', '2016-01-25 09:38:54'),
(4, 3, 15, 2, '1022.27', 1, '2016-01-25 09:38:54', 'unfinalized', '2016-01-25 09:38:54', '2016-01-25 09:38:54'),
(5, 4, 3, 1, '859.17', 1, '2016-01-25 09:43:59', 'unfinalized', '2016-01-25 09:43:59', '2016-01-25 09:43:59'),
(6, 4, 15, 1, '1022.27', 1, '2016-01-25 09:43:59', 'unfinalized', '2016-01-25 09:43:59', '2016-01-25 09:43:59'),
(7, 5, 3, 1, '859.17', 1, '2016-01-25 09:45:35', 'unfinalized', '2016-01-25 09:45:35', '2016-01-25 09:45:35'),
(8, 5, 15, 1, '1022.27', 1, '2016-01-25 09:45:35', 'unfinalized', '2016-01-25 09:45:35', '2016-01-25 09:45:35'),
(9, 6, 3, 1, '859.17', 1, '2016-01-25 09:47:14', 'unfinalized', '2016-01-25 09:47:14', '2016-01-25 09:47:14'),
(10, 6, 15, 1, '1022.27', 1, '2016-01-25 09:47:14', 'unfinalized', '2016-01-25 09:47:14', '2016-01-25 09:47:14'),
(11, 7, 3, 1, '859.17', 1, '2016-01-25 09:48:57', 'unfinalized', '2016-01-25 09:48:57', '2016-01-25 09:48:57'),
(12, 7, 15, 1, '1022.27', 1, '2016-01-25 09:48:57', 'unfinalized', '2016-01-25 09:48:57', '2016-01-25 09:48:57'),
(13, 8, 3, 1, '859.17', 1, '2016-01-25 09:49:19', 'unfinalized', '2016-01-25 09:49:19', '2016-01-25 09:49:19'),
(14, 8, 15, 1, '1022.27', 1, '2016-01-25 09:49:19', 'unfinalized', '2016-01-25 09:49:19', '2016-01-25 09:49:19'),
(15, 9, 3, 1, '859.17', 1, '2016-01-25 09:51:37', 'unfinalized', '2016-01-25 09:51:37', '2016-01-25 09:51:37'),
(16, 9, 15, 1, '1022.27', 1, '2016-01-25 09:51:37', 'unfinalized', '2016-01-25 09:51:37', '2016-01-25 09:51:37'),
(17, 10, 7, 5, '1015.59', 1, '2016-01-26 11:06:24', 'unfinalized', '2016-01-26 11:06:24', '2016-01-26 11:06:24'),
(18, 10, 9, 5, '1082.88', 1, '2016-01-26 11:06:24', 'unfinalized', '2016-01-26 11:06:24', '2016-01-26 11:06:24'),
(19, 11, 7, 5, '1015.59', 1, '2016-01-26 11:09:25', 'unfinalized', '2016-01-26 11:09:25', '2016-01-26 11:09:25'),
(20, 11, 1, 5, '1679.40', 2, '2016-01-26 11:09:25', 'unfinalized', '2016-01-26 11:09:25', '2016-01-26 11:09:25'),
(21, 12, 15, 5, '1022.27', 1, '2016-01-26 11:11:00', 'unfinalized', '2016-01-26 11:11:00', '2016-01-26 11:11:00'),
(22, 12, 7, 5, '1015.59', 1, '2016-01-26 11:11:00', 'unfinalized', '2016-01-26 11:11:00', '2016-01-26 11:11:00'),
(23, 13, 15, 5, '1022.27', 1, '2016-01-26 11:11:47', 'unfinalized', '2016-01-26 11:11:47', '2016-01-26 11:11:47'),
(24, 13, 7, 5, '1015.59', 1, '2016-01-26 11:11:47', 'unfinalized', '2016-01-26 11:11:47', '2016-01-26 11:11:47'),
(25, 14, 15, 5, '1022.27', 1, '2016-01-26 11:15:00', 'unfinalized', '2016-01-26 11:15:00', '2016-01-26 11:15:00'),
(26, 14, 7, 5, '1015.59', 1, '2016-01-26 11:15:00', 'unfinalized', '2016-01-26 11:15:00', '2016-01-26 11:15:00'),
(27, 15, 15, 5, '1022.27', 1, '2016-01-26 11:15:41', 'unfinalized', '2016-01-26 11:15:41', '2016-01-26 11:15:41'),
(28, 16, 7, 1, '2031.18', 2, '2016-01-26 11:27:18', 'unfinalized', '2016-01-26 11:27:18', '2016-01-26 11:27:18'),
(29, 16, 3, 1, '859.17', 1, '2016-01-26 11:27:18', 'unfinalized', '2016-01-26 11:27:18', '2016-01-26 11:27:18'),
(30, 17, 3, 1, '859.17', 1, '2016-01-26 11:28:18', 'unfinalized', '2016-01-26 11:28:18', '2016-01-26 11:28:18'),
(31, 17, 16, 1, '100.00', 1, '2016-01-26 11:28:18', 'unfinalized', '2016-01-26 11:28:18', '2016-01-26 11:28:18'),
(32, 18, 2, 1, '790.95', 1, '2016-01-26 11:30:23', 'unfinalized', '2016-01-26 11:30:23', '2016-01-26 11:30:23'),
(33, 18, 16, 1, '100.00', 1, '2016-01-26 11:30:23', 'unfinalized', '2016-01-26 11:30:23', '2016-01-26 11:30:23'),
(37, 19, 13, 1, '1390.29', 1, '2016-01-26 11:41:39', 'unfinalized', '2016-01-26 11:41:39', '2016-01-26 11:41:39'),
(38, 19, 16, 1, '100.00', 1, '2016-01-26 11:41:39', 'unfinalized', '2016-01-26 11:41:39', '2016-01-26 11:41:39'),
(39, 20, 13, 1, '1390.29', 1, '2016-01-26 11:42:56', 'unfinalized', '2016-01-26 11:42:56', '2016-01-26 11:42:56'),
(40, 20, 16, 1, '100.00', 1, '2016-01-26 11:42:56', 'unfinalized', '2016-01-26 11:42:56', '2016-01-26 11:42:56'),
(41, 21, 10, 1, '2257.68', 2, '2016-01-27 11:52:30', 'unfinalized', '2016-01-27 11:52:30', '2016-01-27 11:52:30'),
(42, 21, 12, 1, '1343.11', 1, '2016-01-27 11:52:30', 'unfinalized', '2016-01-27 11:52:30', '2016-01-27 11:52:30'),
(43, 22, 7, 1, '1015.59', 1, '2016-01-28 08:58:28', 'unfinalized', '2016-01-28 08:58:28', '2016-01-28 08:58:28'),
(44, 23, 16, 1, '300.00', 3, '2016-01-28 09:10:02', 'unfinalized', '2016-01-28 09:10:02', '2016-01-28 09:10:02'),
(45, 24, 16, 1, '100.00', 1, '2016-01-28 09:45:58', 'unfinalized', '2016-01-28 09:45:58', '2016-01-28 09:45:58'),
(46, 25, 16, 1, '100.00', 1, '2016-01-28 09:46:05', 'unfinalized', '2016-01-28 09:46:05', '2016-01-28 09:46:05'),
(47, 26, 16, 1, '100.00', 1, '2016-01-28 09:53:02', 'unfinalized', '2016-01-28 09:53:02', '2016-01-28 09:53:02'),
(48, 27, 16, 1, '100.00', 1, '2016-01-28 09:54:18', 'unfinalized', '2016-01-28 09:54:18', '2016-01-28 09:54:18'),
(49, 28, 16, 1, '200.00', 2, '2016-01-28 09:55:03', 'unfinalized', '2016-01-28 09:55:03', '2016-01-28 09:55:03'),
(50, 29, 16, 1, '200.00', 2, '2016-01-28 10:00:40', 'unfinalized', '2016-01-28 10:00:40', '2016-01-28 10:00:40'),
(51, 30, 16, 1, '100.00', 1, '2016-01-28 10:06:39', 'unfinalized', '2016-01-28 10:06:39', '2016-01-28 10:06:39'),
(52, 31, 16, 1, '100.00', 1, '2016-01-28 10:12:21', 'unfinalized', '2016-01-28 10:12:21', '2016-01-28 10:12:21'),
(53, 32, 16, 1, '100.00', 1, '2016-01-28 10:13:35', 'unfinalized', '2016-01-28 10:13:35', '2016-01-28 10:13:35'),
(54, 33, 16, 1, '100.00', 1, '2016-01-29 14:48:26', 'unfinalized', '2016-01-28 10:21:36', '2016-01-28 10:23:05'),
(55, 33, 2, 1, '790.95', 1, '2016-01-29 14:48:23', 'unfinalized', '2016-01-28 10:21:36', '2016-01-28 10:23:05'),
(56, 34, 7, 1, '1015.59', 1, '2016-01-29 14:48:19', 'unfinalized', '2016-01-28 10:29:24', '2016-01-28 10:29:35'),
(57, 34, 16, 1, '100.00', 1, '2016-01-29 14:48:16', 'unfinalized', '2016-01-28 10:29:24', '2016-01-28 10:29:35'),
(58, 35, 6, 2, '65.50', 1, '2016-01-29 14:48:12', 'unfinalized', '2016-01-29 12:01:37', '2016-01-29 12:01:46'),
(59, 35, 4, 2, '49.00', 2, '2016-01-29 14:48:01', 'unfinalized', '2016-01-29 12:01:37', '2016-01-29 12:01:46'),
(60, 36, 2, 1, '90.95', 1, '2016-01-29 13:25:14', 'unfinalized', '2016-01-29 13:25:14', '2016-01-29 13:25:14'),
(61, 36, 6, 1, '131.00', 2, '2016-01-29 13:25:14', 'unfinalized', '2016-01-29 13:25:14', '2016-01-29 13:25:14'),
(62, 37, 5, 2, '179.80', 2, '2016-01-29 14:47:55', 'unfinalized', '2016-01-29 13:27:16', '2016-01-29 13:27:30'),
(63, 37, 3, 2, '79.90', 1, '2016-01-29 14:47:48', 'unfinalized', '2016-01-29 13:27:16', '2016-01-29 13:27:30'),
(64, 38, 6, 2, '65.50', 1, '2016-01-29 13:28:46', 'unfinalized', '2016-01-29 13:28:46', '2016-01-29 13:28:46'),
(65, 39, 6, 2, '65.50', 1, '2016-01-29 14:47:43', 'unfinalized', '2016-01-29 13:28:57', '2016-01-29 13:31:26'),
(66, 40, 6, 2, '65.50', 1, '2016-01-29 13:32:27', 'unfinalized', '2016-01-29 13:32:27', '2016-01-29 13:32:27'),
(67, 41, 5, 2, '89.90', 1, '2016-01-29 13:33:24', 'unfinalized', '2016-01-29 13:33:24', '2016-01-29 13:33:24'),
(68, 42, 6, 2, '65.50', 1, '2016-01-29 13:36:16', 'unfinalized', '2016-01-29 13:36:16', '2016-01-29 13:36:16'),
(69, 43, 7, 2, '105.50', 1, '2016-01-29 13:38:58', 'unfinalized', '2016-01-29 13:38:58', '2016-01-29 13:38:58'),
(70, 44, 10, 2, '28.84', 1, '2016-01-29 13:40:35', 'unfinalized', '2016-01-29 13:40:35', '2016-01-29 13:40:35'),
(71, 45, 10, 2, '28.84', 1, '2016-01-29 14:03:52', 'unfinalized', '2016-01-29 14:03:52', '2016-01-29 14:03:52'),
(72, 46, 4, 2, '24.50', 1, '2016-01-29 14:06:38', 'unfinalized', '2016-01-29 14:06:38', '2016-01-29 14:06:38'),
(73, 47, 4, 2, '24.50', 1, '2016-01-29 14:06:39', 'unfinalized', '2016-01-29 14:06:39', '2016-01-29 14:06:39'),
(74, 48, 16, 2, '200.00', 2, '2016-01-29 14:09:44', 'unfinalized', '2016-01-29 14:09:44', '2016-01-29 14:09:44'),
(75, 49, 16, 2, '100.00', 1, '2016-01-29 14:10:47', 'unfinalized', '2016-01-29 14:10:47', '2016-01-29 14:10:47'),
(76, 50, 16, 2, '100.00', 1, '2016-01-29 14:10:48', 'unfinalized', '2016-01-29 14:10:48', '2016-01-29 14:10:48'),
(77, 51, 12, 2, '87.60', 2, '2016-01-29 14:47:22', 'unfinalized', '2016-01-29 14:47:22', '2016-01-29 14:47:22'),
(78, 51, 7, 2, '105.50', 1, '2016-01-29 14:47:22', 'unfinalized', '2016-01-29 14:47:22', '2016-01-29 14:47:22'),
(79, 52, 12, 2, '87.60', 2, '2016-01-31 11:59:11', 'unfinalized', '2016-01-31 11:59:11', '2016-01-31 11:59:11'),
(80, 52, 1, 2, '125.80', 1, '2016-01-31 11:59:11', 'unfinalized', '2016-01-31 11:59:11', '2016-01-31 11:59:11'),
(81, 53, 9, 8, '82.88', 1, '2016-01-31 23:26:29', 'unfinalized', '2016-01-31 23:26:29', '2016-01-31 23:26:29'),
(82, 54, 6, 8, '65.50', 1, '2016-01-31 23:27:23', 'unfinalized', '2016-01-31 23:27:23', '2016-01-31 23:27:23'),
(84, 55, 2, 13, '90.95', 1, '2016-01-31 23:47:04', 'unfinalized', '2016-01-31 23:47:04', '2016-01-31 23:47:04'),
(85, 56, 2, 13, '90.95', 1, '2016-01-31 23:48:35', 'unfinalized', '2016-01-31 23:48:35', '2016-01-31 23:48:35'),
(86, 57, 13, 14, '134.50', 1, '2016-01-31 23:49:50', 'unfinalized', '2016-01-31 23:49:50', '2016-01-31 23:49:50'),
(87, 58, 14, 15, '74.50', 1, '2016-01-31 23:51:13', 'unfinalized', '2016-01-31 23:51:13', '2016-01-31 23:51:13'),
(88, 59, 14, 1, '74.50', 1, '2016-02-01 00:05:17', 'unfinalized', '2016-02-01 00:05:17', '2016-02-01 00:05:17'),
(89, 60, 6, 16, '65.50', 1, '2016-02-01 00:08:32', 'unfinalized', '2016-02-01 00:08:32', '2016-02-01 00:08:32'),
(90, 61, 2, 17, '90.95', 1, '2016-02-01 00:25:39', 'unfinalized', '2016-02-01 00:25:39', '2016-02-01 00:25:39');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_12_30_100623_create_categories_table', 1),
('2015_12_30_101327_create_tags_table', 1),
('2015_12_30_110744_create_products_table', 1),
('2015_12_30_113935_create_pictures_table', 1),
('2015_12_30_115324_create_product_tag_table', 1),
('2015_12_30_133031_create_customers_table', 1),
('2015_12_30_133733_create_histories_table', 1),
('2015_12_30_135523_alter_pictures_table', 1),
('2016_01_12_111536_alter_products_table', 1),
('2016_01_21_120745_alter_histories_table', 1),
('2016_01_26_113117_alter_products_table', 2);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pictures`
--

CREATE TABLE `pictures` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `uri` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` smallint(6) NOT NULL,
  `type` enum('png','jpg','gif') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `pictures`
--

INSERT INTO `pictures` (`id`, `product_id`, `title`, `uri`, `size`, `type`, `created_at`, `updated_at`) VALUES
(18, 3, 'Otilia Prohaska', 'casque_2.jpg', 32767, 'jpg', '2016-01-22 15:56:54', '2016-01-22 15:49:23'),
(19, 4, 'Dr. Jaron Gerlach', 'laser_2.jpg', 26498, 'jpg', '2016-01-22 15:57:00', '2016-01-22 15:49:35'),
(20, 5, 'Teresa Lindgren', 'casque_3.jpg', 32767, 'jpg', '2016-01-22 15:57:05', '2016-01-22 15:49:56'),
(21, 15, 'Annie Cronin', 'casque_1.jpg', 32767, 'jpg', '2016-01-22 15:57:11', '2016-01-22 15:50:24'),
(23, 13, 'Claudie Kulas', 'casque_2.jpg', 32767, 'jpg', '2016-01-22 15:57:19', '2016-01-22 15:50:46'),
(24, 12, 'Amelie Kirlin', 'laser_2.jpg', 26498, 'jpg', '2016-01-25 09:45:20', '2016-01-22 15:50:58'),
(25, 11, 'Lelia Graham II', 'casque_3.jpg', 32767, 'jpg', '2016-01-22 15:57:29', '2016-01-22 15:51:11'),
(26, 10, 'Victor Doyle', 'laser_3.jpg', 28481, 'jpg', '2016-01-22 15:57:34', '2016-01-22 15:51:22'),
(27, 9, 'Idell Gerlach', 'casque_4.jpg', 32767, 'jpg', '2016-01-22 15:57:38', '2016-01-22 15:51:31'),
(29, 7, 'Mortimer Gislason DVM', 'casque_5.jpg', 32767, 'jpg', '2016-01-22 15:57:47', '2016-01-22 15:51:51'),
(30, 6, 'Augustus Upton', 'laser_5.jpg', 20560, 'jpg', '2016-01-22 15:57:56', '2016-01-22 15:52:01'),
(31, 1, 'Vida Schumm', 'casque_6.jpg', 32767, 'jpg', '2016-01-22 15:57:59', '2016-01-22 15:52:11'),
(32, 2, 'Princess Aufderhar DVM', 'laser_6.jpg', 29371, 'jpg', '2016-01-22 15:58:06', '2016-01-22 15:52:26'),
(34, 14, 'Melyna O''Connell', 'casque_8.jpg', 32767, 'jpg', '2016-01-22 16:01:10', '2016-01-22 16:01:10'),
(37, 16, 'Foo foo', 'casque_7.jpg', 32767, 'jpg', '2016-01-25 09:41:51', '2016-01-25 09:41:51');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `score` int(10) UNSIGNED NOT NULL,
  `abstract` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `quantity` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `status` enum('opened','closed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'opened',
  `published_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `score`, `abstract`, `content`, `price`, `quantity`, `status`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'Vida Schumm', 'vida-schumm', 1, 'Neque aut dolores rerum inventore minima eligendi.', 'Est nulla eligendi et in. Et magnam eveniet harum.', '125.80', 58, 'opened', '2016-01-29 09:16:10', '2016-01-31 11:59:11', '2016-01-31 11:59:11'),
(2, 1, 'Princess Aufderhar DVM', 'princess-aufderhar-dvm', 5, 'Aspernatur ea ea soluta qui.', 'Praesentium qui voluptas est velit. Sit qui animi odit et eveniet odit officia. Eum praesentium saepe in. Eveniet vero voluptatem voluptatem mollitia ut suscipit.', '90.95', 95, 'opened', '2016-01-29 09:19:11', '2016-02-01 00:25:39', '2016-02-01 00:25:39'),
(3, 2, 'Otilia Prohaska', 'otilia-prohaska', 2, 'Qui est et voluptatem omnis. Placeat inventore esse similique omnis consequatur aut.', 'Assumenda vero eum iure. Corrupti cupiditate omnis est dolore omnis dignissimos. Est autem accusantium et. Ea aut earum saepe voluptas earum ipsa rerum.', '79.90', 73, 'opened', '2016-01-29 09:15:27', '2016-01-29 13:27:16', '2016-01-29 13:27:16'),
(4, 1, 'Dr. Jaron Gerlach', 'dr-jaron-gerlach', 3, 'Aliquam error esse consequatur ut optio inventore. Saepe repudiandae laboriosam ea impedit quasi neque.', 'Architecto nobis architecto quod voluptatem nostrum incidunt labore. Debitis autem reiciendis autem voluptatem officia voluptatem ducimus. Qui id provident saepe aut.', '24.50', 76, 'opened', '2016-01-29 09:17:32', '2016-01-29 14:06:39', '2016-01-29 14:06:39'),
(5, 2, 'Teresa Lindgren', 'teresa-lindgren', 2, 'Harum ducimus dolor quisquam qui quasi. Earum eum ipsam alias est totam earum. Sed non cumque illum quia qui assumenda cumque.', 'Voluptas enim at suscipit enim. Sequi accusamus nisi sequi qui perspiciatis. Et accusamus recusandae sed impedit saepe quidem officiis. Ut repellendus perferendis commodi necessitatibus ratione nobis omnis.', '89.90', 64, 'opened', '2016-01-29 09:17:16', '2016-01-29 13:33:24', '2016-01-29 13:33:24'),
(6, 1, 'Augustus Upton', 'augustus-upton', 8, 'Et architecto expedita non id dignissimos maiores dolorem. Omnis voluptatum eos et beatae consequatur animi.', 'Occaecati suscipit qui alias dignissimos labore tempore. Voluptatem praesentium facere mollitia culpa. Est voluptatem aliquid voluptatem nam.', '65.50', 100, 'opened', '2016-01-29 09:18:53', '2016-02-01 00:08:32', '2016-02-01 00:08:32'),
(7, 2, 'Mortimer Gislason DVM', 'mortimer-gislason-dvm', 4, 'Temporibus ipsum illo rerum laudantium amet. Saepe enim libero exercitationem molestiae aut eveniet maxime.', 'Accusantium et veritatis sit eveniet fuga expedita. Quia cum magnam necessitatibus. Id nostrum et est autem esse facilis aut.', '105.50', 130, 'opened', '2016-01-29 09:19:47', '2016-01-29 14:47:22', '2016-01-29 14:47:22'),
(9, 2, 'Idell Gerlach', 'idell-gerlach', 1, 'Sunt nemo perspiciatis expedita distinctio. Earum doloribus veritatis iusto et sapiente eveniet.', 'Ut rerum hic dolores asperiores alias consequuntur necessitatibus. Quibusdam autem veniam et. Labore enim dignissimos facere saepe. Praesentium ullam dignissimos voluptas voluptatem.', '82.88', 52, 'opened', '2016-01-29 09:19:22', '2016-01-31 23:26:30', '2016-01-31 23:26:30'),
(10, 1, 'Victor Doyle', 'victor-doyle', 3, 'Rerum a magnam tempore aut. Et ullam ipsum eum rerum voluptatum ut architecto.', 'Consequatur ea voluptatem eum. Blanditiis enim veniam ut quam sed est magnam. Corrupti rem vitae quia adipisci. Nulla accusantium dolorem numquam ex. Sit est iste id dignissimos.', '28.84', 58, 'opened', '2016-01-29 09:18:36', '2016-01-29 14:03:52', '2016-01-29 14:03:52'),
(11, 2, 'Lelia Graham II', 'lelia-graham-ii', 0, 'Debitis sunt recusandae dicta dolor. Consequatur temporibus ad magni.', 'Voluptas sed alias tenetur beatae a quos. Praesentium et nihil eligendi ut non.', '119.90', 42, 'opened', '2016-01-29 09:15:43', '2016-01-29 08:15:43', '2016-01-29 08:15:43'),
(12, 1, 'Amelie Kirlin', 'amelie-kirlin', 3, 'Eos fuga magnam perferendis ut tenetur. Magni incidunt excepturi qui molestias id corporis corporis dolorum. Tempore exercitationem amet et accusantium culpa.', 'Sequi aperiam cupiditate consectetur modi facilis dolores. Cum corrupti ut fugiat et et ab quis. Et laudantium facere quo voluptatem doloremque officiis. Alias quibusdam nesciunt consequatur quae facilis minus.', '43.80', 88, 'opened', '2016-01-29 09:17:53', '2016-01-31 11:59:11', '2016-01-31 11:59:11'),
(13, 2, 'Claudie Kulas', 'claudie-kulas', 3, 'Adipisci enim magnam sed assumenda dolor est harum. Dolor delectus architecto odio reiciendis iure ad voluptatem quaerat.', 'Amet sunt dicta nulla velit. Similique blanditiis vero enim voluptas aut nemo. Voluptates veniam fugiat eum aut molestiae quis quis.', '134.50', 47, 'opened', '2016-01-29 09:16:59', '2016-01-31 23:49:50', '2016-01-31 23:49:50'),
(14, 2, 'Melyna O''Connell', 'melyna-oconnell', 2, 'Eos eum voluptatem consequuntur aut. Vel officiis debitis vitae cum et.', 'Qui eligendi atque soluta neque. Numquam ut est esse fugiat officiis libero eaque. Quo eos temporibus alias iste. Quibusdam at aperiam asperiores reiciendis occaecati consectetur.', '74.50', 118, 'opened', '2016-01-29 09:16:29', '2016-02-01 00:05:17', '2016-02-01 00:05:17'),
(15, 2, 'Annie Cronin', 'annie-cronin', 0, 'Fugiat voluptate qui sunt quo animi ipsam.', 'Omnis voluptatum nobis officia. Ut iure voluptatibus voluptate praesentium explicabo dolorem omnis. Voluptatibus qui laborum vel architecto placeat.', '120.90', 60, 'opened', '2016-02-01 01:03:57', '2016-02-01 00:03:57', '2016-02-01 00:03:57'),
(16, 2, 'Foo foo', 'foo-foo', 19, 'foo foo', 'foo foo', '100.00', 111, 'opened', '2016-01-28 12:42:24', '2016-01-29 14:10:48', '2016-01-29 14:10:48');

-- --------------------------------------------------------

--
-- Structure de la table `product_tag`
--

CREATE TABLE `product_tag` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `product_tag`
--

INSERT INTO `product_tag` (`product_id`, `tag_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(3, 3),
(3, 6),
(3, 7),
(4, 7),
(4, 11),
(4, 12),
(5, 12),
(5, 13),
(6, 2),
(6, 12),
(6, 13),
(6, 14),
(7, 6),
(7, 11),
(7, 14),
(9, 5),
(9, 7),
(9, 9),
(9, 14),
(10, 2),
(10, 7),
(10, 11),
(11, 13),
(11, 14),
(11, 15),
(12, 13),
(12, 14),
(12, 15),
(13, 2),
(13, 7),
(14, 6),
(14, 7),
(15, 9),
(15, 10),
(15, 14),
(16, 2),
(16, 3);

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'star', '2016-01-25 10:52:30', '2016-01-22 15:48:00'),
(2, 'wars', '2016-01-25 10:52:32', '2016-01-22 15:48:00'),
(3, 'galaxy', '2016-01-25 10:55:04', '2016-01-22 15:48:00'),
(4, 'space', '2016-01-25 10:53:32', '2016-01-22 15:48:00'),
(5, 'laser', '2016-01-25 10:53:35', '2016-01-22 15:48:00'),
(6, 'power', '2016-01-25 10:55:27', '2016-01-22 15:48:00'),
(7, 'peace', '2016-01-25 10:55:35', '2016-01-22 15:48:00'),
(8, 'princess', '2016-01-25 10:55:48', '2016-01-22 15:48:00'),
(9, 'dark', '2016-01-25 10:55:57', '2016-01-22 15:48:00'),
(10, 'tatooine', '2016-01-25 10:55:58', '2016-01-22 15:48:00'),
(11, 'luc', '2016-01-25 10:56:06', '2016-01-22 15:48:00'),
(12, 'chewbacca', '2016-01-25 10:56:09', '2016-01-22 15:48:00'),
(13, 'planet', '2016-01-25 10:57:34', '2016-01-22 15:48:00'),
(14, 'mask', '2016-01-25 10:59:33', '2016-01-22 15:48:00'),
(15, 'phasma', '2016-01-25 10:59:30', '2016-01-22 15:48:00');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('administrator','editor','visitor') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'editor',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'yini', 'yini@yini.fr', '$2y$10$4QHiAdC9LUkvOljq2rS/BeEHN9uqrHO1.NwFSeCYKcPJ00ftp32by', 'administrator', 'reNqJKqZEP4wcCO9CxYmKYaisFXSjvDzz0UZWU61w2Ow4LcxYBuYP2Ek2SLX', '2016-02-01 00:24:55', '2016-02-01 00:24:55'),
(2, 'tony', 'tony@tony.fr', '$2y$10$8VKj3t5k99aP6RFLg1bgX.5rPLKaGFKelpnAGE4e2PJgxsM9RqyDy', 'visitor', 'sjBiBKwGtv6AD9WP75P2pcSzUtcsTbS1b6QnejUKrGaNxSPC9owZTwaepLLk', '2016-01-31 11:59:39', '2016-01-31 11:59:39'),
(3, 'roman', 'roman@roman.fr', '$2y$10$/oW6iXzJgkad0a8uoCL04ODrSno5bUQk65cp5gY9O9NvrJTEdD11O', 'visitor', NULL, '2016-01-22 15:47:59', '0000-00-00 00:00:00'),
(4, 'antoine', 'antoine@antoine.fr', '$2y$10$TwZtcvwDxw9OU.2wEZpYxOqfAY0QsGTjVSpGrvGxzXTShsMCCdatu', 'visitor', NULL, '2016-01-22 15:47:59', '0000-00-00 00:00:00'),
(5, 'anna', 'anna@anna.fr', '$2y$10$VDbS2bpi9ot.8qFRHah65.M3FF.02QGGVbxgTlFvzo22aJ0nOb2ti', 'editor', 'dbeG13Q3SUzZAq1N45TzDTA3vQohbw0Md4GBZOnKsiirC02C5SlYgWQXrs8c', '2016-01-29 11:58:43', '2016-01-29 11:58:43'),
(6, 'tom', 'tom@tom.fr', '$2y$10$p1b2bgS55.BvmgNlbIvtY.9MnYuMv3/VTx3dtOSTxJyym.A1kt4A6', 'visitor', 'FMj6KSHbbqaG2VVrvUyB5UZQoj9YQbnOsm938FscP1maL7XzvStE9VXqS2Hn', '2016-01-31 23:48:41', '2016-01-31 23:48:41'),
(7, 'mary', 'mary@mary.fr', '$2y$10$AyMcgHAegp5wr2kltlF8feMGrTGSX2h4xDLJaFYIaRW2Jl9mDS8ty', 'visitor', '0vqo2qncVWbVYO8xHjyAIb1HJ763BweEW2gbux45MgdMFoXxwWhgfv8PxFpC', '2016-01-31 23:50:16', '2016-01-31 23:50:16'),
(8, 'lea', 'lea@lea.fr', '$2y$10$3N.ZMcTmjL6puZe1I8n87.WHj5qiAs0GtPwxirbi1c4LIgVUUhZyq', 'visitor', '9mJpkxd2C911QFyTpFAi48pbNruLrpH1lITo1HFKU30FHWWKrEa2UW8v87k9', '2016-01-31 23:27:32', '2016-01-31 23:27:32'),
(9, 'julie', 'julie@julie.fr', '$2y$10$lAXtQ805QpSfxrjI.tYC.uZcYqm4rRwo5zN0iENnRBWHy.QnByyjK', 'visitor', '8RFVRyqkvbotYBMbuxsWoYyPIlWbiSlYCX1HPHLgKItj7Mxo5rsePhf7MdrS', '2016-01-31 23:33:00', '2016-01-31 23:33:00'),
(10, 'theo', 'theo@theo.fr', '$2y$10$Uw4cSzjndFE43kkrHT5FEe4VrCisLLfN2Yne23ZOBeHE8gM7zlvZO', 'visitor', NULL, '2016-01-31 21:51:42', '2016-01-31 21:51:42'),
(15, 'ben', 'ben@ben.fr', '$2y$10$bKzwamFZqd/wAupRJkLFC.pLQfctIgVrM3o3zCTF31NzcvLasw1dC', 'visitor', 'Uv6Thqa4YMvaOWsqoJkh1pxxl6lJyPHQ0vXboVnIQ8pAVY91cke3tPakjdeM', '2016-01-31 23:24:01', '2016-01-31 23:24:01'),
(16, 'jojo', 'jojo@jojo.fr', '$2y$10$6LjsudI7Vhl510HWXAI7ROKzjnHBbpSHrZ0yjwj.mxGcV.exeAOoO', 'visitor', '0R2kRuXHTaVZ0LgQ5sbnKvGvaHglBguIbFTQGg9ygxhh3edp4UyBsDQlXpnR', '2016-02-01 00:02:00', '2016-02-01 00:02:00'),
(17, 'elle', 'elle@elle.fr', '$2y$10$ZY06oAP.t2An4kCf3dEMnuT4OWGN3YMfJAB7nNzG0qMpIX2oB7B7a', 'visitor', 'RSYZmCItqVxrncNTx1CcJOtMAGvSRrvJhXSu6vT1UHyqZrHlps3MUEgNMsx6', '2016-02-01 00:08:40', '2016-02-01 00:08:40'),
(18, 'ava', 'ava@ava.fr', '$2y$10$VDHBQwiYyGX4Ol3M8VuCZOzthG0hfHWpzwdNwIsEZrN7Lt.DAPJdq', 'visitor', 'wTWNWCy0tBx3UxYgDWNuMIqABTWtyYKl4SGArmREPcRtRN7iMFc0SC5KAyEs', '2016-02-01 00:22:02', '2016-02-01 00:22:02');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_user_id_foreign` (`user_id`);

--
-- Index pour la table `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `histories_product_id_foreign` (`product_id`),
  ADD KEY `histories_customer_id_foreign` (`customer_id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Index pour la table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pictures_product_id_foreign` (`product_id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Index pour la table `product_tag`
--
ALTER TABLE `product_tag`
  ADD UNIQUE KEY `product_tag_product_id_tag_id_unique` (`product_id`,`tag_id`),
  ADD KEY `product_tag_tag_id_foreign` (`tag_id`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `histories`
--
ALTER TABLE `histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT pour la table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `histories`
--
ALTER TABLE `histories`
  ADD CONSTRAINT `histories_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `histories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `pictures_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `product_tag`
--
ALTER TABLE `product_tag`
  ADD CONSTRAINT `product_tag_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
