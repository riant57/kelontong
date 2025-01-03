-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2025 at 11:25 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kelontong`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Pakan Ternak', NULL, '2024-06-03 18:03:40'),
(8, 'Minumam', NULL, '2024-06-03 18:03:27'),
(9, 'Makanan', NULL, '2024-06-03 18:03:18'),
(10, 'Sembako', NULL, '2024-06-03 18:03:07'),
(11, 'Obat obatan', '2024-06-03 18:03:57', NULL),
(12, 'Peralatan Mandi Dan Mencuci', '2024-06-03 18:04:21', NULL),
(13, 'Jajanan dan Makanan Ringan', '2024-06-03 18:05:17', NULL),
(14, 'Perlengkapan Rumah Tangga', '2024-06-03 18:05:50', NULL),
(15, 'Lain - lain', '2024-06-03 18:06:18', NULL),
(16, 'Peralatan Listrik', '2024-06-03 18:07:30', NULL),
(17, 'Pulsa dan Paket Data', '2024-06-03 18:07:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `desk`
--

CREATE TABLE `desk` (
  `id` int(11) NOT NULL,
  `desk_number` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `count_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `desk`
--

INSERT INTO `desk` (`id`, `desk_number`, `name`, `count_order`, `created_at`, `updated_at`) VALUES
(1, 0, 'Bawa Pulang', 1, NULL, '2023-12-14 17:10:59'),
(2, 1, 'Nomor Meja', 3, NULL, '2020-03-01 06:56:19');

-- --------------------------------------------------------

--
-- Table structure for table `detail`
--

CREATE TABLE `detail` (
  `id` int(100) NOT NULL,
  `id_data` int(11) NOT NULL,
  `iterasi` int(100) NOT NULL,
  `c1` double NOT NULL,
  `c2` double NOT NULL,
  `c3` double NOT NULL,
  `kluster` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail`
--

INSERT INTO `detail` (`id`, `id_data`, `iterasi`, `c1`, `c2`, `c3`, `kluster`) VALUES
(1, 1, 1, 109.5, 109.9, 131.8, 1),
(2, 2, 1, 115.2, 108.7, 132.7, 2),
(3, 3, 1, 142.8, 103.8, 125.1, 2),
(4, 4, 1, 0, 46.4, 98.9, 1),
(5, 5, 1, 56.1, 56.7, 111, 1),
(6, 6, 1, 115.1, 99.5, 142.1, 2),
(7, 7, 1, 102.1, 122.5, 137.8, 1),
(8, 8, 1, 101.4, 101.8, 114.8, 1),
(9, 9, 1, 114.1, 113.2, 131.8, 2),
(10, 23, 1, 309.1, 285.6, 230.9, 3),
(11, 1, 2, 91, 106.8, 357.2, 1),
(12, 2, 2, 103.5, 98.4, 350.5, 2),
(13, 3, 2, 142.1, 78.3, 290.9, 2),
(14, 4, 2, 37.5, 66.7, 309.1, 1),
(15, 5, 2, 89.1, 62, 287.1, 2),
(16, 6, 2, 143.5, 84.8, 282.2, 2),
(17, 7, 2, 71.6, 144, 356.3, 1),
(18, 8, 2, 77.8, 127.2, 308.4, 1),
(19, 9, 2, 113.5, 138.4, 281.1, 1),
(20, 23, 2, 315.9, 284.6, 0, 3),
(21, 1, 3, 108.8, 106.5, 357.2, 2),
(22, 2, 3, 123.8, 91.1, 350.5, 2),
(23, 3, 3, 157.1, 70.2, 290.9, 2),
(24, 4, 3, 55.1, 82.6, 309.1, 1),
(25, 5, 3, 104, 68.1, 287.1, 2),
(26, 6, 3, 161, 70.2, 282.2, 2),
(27, 7, 3, 59.4, 164.8, 356.3, 1),
(28, 8, 3, 53, 157, 308.4, 1),
(29, 9, 3, 96.5, 167.4, 281.1, 1),
(30, 23, 3, 314.2, 294.4, 0, 3),
(31, 1, 4, 136.1, 85.2, 357.2, 2),
(32, 2, 4, 150.5, 70.6, 350.5, 2),
(33, 3, 4, 174.5, 73.6, 290.9, 2),
(34, 4, 4, 67.1, 77.7, 309.1, 1),
(35, 5, 4, 109.3, 78.3, 287.1, 2),
(36, 6, 4, 169.2, 90, 282.2, 2),
(37, 7, 4, 68.7, 150.4, 356.3, 1),
(38, 8, 4, 36.5, 150.3, 308.4, 1),
(39, 9, 4, 71.9, 169.5, 281.1, 1),
(40, 23, 4, 308.6, 305, 0, 3),
(41, 1, 5, 136.1, 85.2, 357.2, 2),
(42, 2, 5, 150.5, 70.6, 350.5, 2),
(43, 3, 5, 174.5, 73.6, 290.9, 2),
(44, 4, 5, 67.1, 77.7, 309.1, 1),
(45, 5, 5, 109.3, 78.3, 287.1, 2),
(46, 6, 5, 169.2, 90, 282.2, 2),
(47, 7, 5, 68.7, 150.4, 356.3, 1),
(48, 8, 5, 36.5, 150.3, 308.4, 1),
(49, 9, 5, 71.9, 169.5, 281.1, 1),
(50, 23, 5, 308.6, 305, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User'),
(3, 'kasir', ''),
(4, 'Manajer', '');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `quantity` int(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`id`, `name`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 'satu', 190, NULL, NULL),
(2, 'dua', 195, NULL, NULL),
(3, 'tiga', 200, NULL, NULL),
(4, 'tes', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `material_product`
--

CREATE TABLE `material_product` (
  `id` int(11) NOT NULL,
  `material_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material_product`
--

INSERT INTO `material_product` (`id`, `material_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 18, 2, NULL, NULL),
(2, 3, 18, 1, NULL, NULL),
(3, 2, 20, 1, NULL, NULL),
(4, 1, NULL, 1, NULL, NULL),
(5, 3, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(12) NOT NULL,
  `name` varchar(150) NOT NULL,
  `address` varchar(250) NOT NULL,
  `phone` int(12) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `address`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'Umum', '', 0, '2024-06-04 00:41:56', '0000-00-00 00:00:00'),
(2, 'Kasmiati', 'Kandangan RT 08', 0, '2024-06-04 01:22:31', '0000-00-00 00:00:00'),
(3, 'Komsatun', 'Kandangan RT 08', 0, '2024-06-04 01:22:47', '0000-00-00 00:00:00'),
(4, 'Desi', 'Kandangan RT 08', 0, '2024-06-04 01:22:57', '0000-00-00 00:00:00'),
(5, 'Supini', 'Kandangan RT 08', 0, '2024-06-04 01:23:05', '0000-00-00 00:00:00'),
(6, 'Kasti Kadi', 'Kandangan RT 08', 0, '2024-06-04 01:23:20', '0000-00-00 00:00:00'),
(7, 'Mahfud De Yul', 'Kandangan RT 08', 0, '2024-06-04 01:23:47', '0000-00-00 00:00:00'),
(8, 'Amir Anis', 'Kandangan RT 08', 0, '2024-06-04 01:24:06', '0000-00-00 00:00:00'),
(9, 'Hamim', 'Kandangan RT 08', 0, '2024-06-04 01:24:18', '0000-00-00 00:00:00'),
(10, 'Mariani', 'Kandangan RT 08', 0, '2024-06-04 01:24:30', '0000-00-00 00:00:00'),
(11, 'Kardi Irawan', 'Kandangan RT 08', 0, '2024-06-04 01:24:42', '0000-00-00 00:00:00'),
(12, 'Dartin', 'Kandangan RT 08', 0, '2024-06-04 01:24:53', '0000-00-00 00:00:00'),
(13, 'Rukis Mbak Ning', 'Kandangan RT 08', 0, '2024-06-04 01:25:08', '0000-00-00 00:00:00'),
(14, 'Sukip Kasmani', 'Kandangan RT 08', 0, '2024-06-04 01:25:22', '0000-00-00 00:00:00'),
(15, 'Waras ', 'Kandangan RT 07', 0, '2024-06-04 01:25:33', '2024-06-04 01:34:48'),
(16, 'Harun', 'Kandangan RT 07', 0, '2024-06-04 01:25:44', '2024-06-04 01:34:40'),
(17, 'Dasuki', 'Kandangan RT 07', 0, '2024-06-04 01:25:55', '2024-06-04 01:34:34'),
(18, 'Ila ', 'Kandangan RT 07', 0, '2024-06-04 01:26:05', '2024-06-04 01:33:56'),
(19, 'Hadi', 'Kandangan RT 07', 0, '2024-06-04 01:26:18', '0000-00-00 00:00:00'),
(20, 'Farida', 'Kandangan RT 07', 0, '2024-06-13 22:46:38', '2024-06-13 22:46:56'),
(21, 'Kasih ', 'Kandangan RT 07', 0, '2024-06-13 22:47:48', '0000-00-00 00:00:00'),
(22, 'Cici ', 'Kandangan RT 07', 0, '2024-06-13 22:47:59', '0000-00-00 00:00:00'),
(23, 'Kasti', 'Kandangan RT 07', 0, '2024-06-13 22:48:06', '0000-00-00 00:00:00'),
(24, 'Via', 'Kandangan RT 07', 0, '2024-06-13 22:48:35', '0000-00-00 00:00:00'),
(25, 'Sofi', 'Kandangan RT 07', 0, '2024-06-13 22:48:59', '0000-00-00 00:00:00'),
(26, 'istri Sofi', 'Kandangan RT 07', 0, '2024-06-13 22:49:08', '0000-00-00 00:00:00'),
(27, 'De Min', 'Kandangan RT 07', 0, '2024-06-13 22:49:26', '0000-00-00 00:00:00'),
(28, 'Sukeni', 'Kandangan RT 07', 0, '2024-06-13 22:49:34', '2024-06-13 22:50:19'),
(29, 'Umiyati ', 'Kandangan RT 07', 0, '2024-07-02 11:41:39', '0000-00-00 00:00:00'),
(30, 'Fatimah', 'Kandangan RT 07', 0, '2024-07-10 05:39:45', '2024-07-10 05:40:19'),
(31, 'Kasimin', 'Kandangan RT 07', 0, '2024-09-16 06:23:35', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(12) NOT NULL,
  `sales_id` int(12) NOT NULL,
  `member_id` int(12) NOT NULL,
  `nominal` int(12) NOT NULL,
  `sisa` int(12) NOT NULL,
  `total` int(12) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `sales_id`, `member_id`, `nominal`, `sisa`, `total`, `created_at`) VALUES
(1, 1, 31, 12000, -3000, 12000, '2024-09-16'),
(2, 2, 1, 10000, 0, 10000, '2024-09-16'),
(3, 3, 1, 135000, 0, 135000, '2024-09-29'),
(4, 4, 1, 20000, 0, 20000, '2024-10-13'),
(5, 5, 12, 12000, 0, 12000, '2024-10-20'),
(6, 6, 1, 0, 0, 0, '2024-10-20'),
(7, 7, 1, 0, -20000, 0, '2024-10-20'),
(8, 8, 1, 17500, 0, 17500, '2024-11-04'),
(9, 9, 31, 20000, 0, 20000, '2024-12-02');

-- --------------------------------------------------------

--
-- Table structure for table `payment_return`
--

CREATE TABLE `payment_return` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `hpp` int(12) NOT NULL,
  `sale_price` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `weight` float NOT NULL DEFAULT 0,
  `product_unit_id` int(12) NOT NULL,
  `note` varchar(256) NOT NULL,
  `image` varchar(128) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `is_active`, `name`, `hpp`, `sale_price`, `category_id`, `stock`, `weight`, `product_unit_id`, `note`, `image`, `created_at`, `updated_at`) VALUES
(31, 1, 'Pur 511', 10500, 12000, 1, 140, 1, 1, '', '1721259121235.jpg', '2024-07-17 23:32:01', NULL),
(32, 1, 'Felibite Pink', 10875, 13000, 1, 160, 0.5, 1, '', '1721259251555.jpg', '2024-07-17 23:34:11', NULL),
(33, 0, 'Felibite Oranye', 10875, 13000, 1, 80, 0.5, 1, '', '1721259369680.jpg', '2024-07-17 23:36:09', NULL),
(34, 1, 'LPG', 17500, 20000, 14, 9, 3, 1, '', '1721429218535.jpg', '2024-07-19 22:46:58', NULL),
(35, 1, 'Pur 511 Gema Feed', 8600, 12000, 1, 500, 1, 1, '', '1721622588045.jpg', '2024-07-22 04:29:48', NULL),
(36, 1, 'Excel Ungu', 10125, 12000, 1, 234, 0.5, 1, '', '1721689982212.jpg', '2024-07-22 23:13:02', NULL),
(37, 1, 'Dedek', 4000, 5000, 1, 138, 1, 1, '', '1721878823975.jpg', '2024-07-25 03:40:23', NULL),
(38, 1, 'Beras', 12500, 13500, 10, 180, 1, 1, '', '1721878979970.jpeg', '2024-07-25 03:42:59', NULL),
(39, 1, 'Aqua 1.5 liter', 4500, 6000, 8, 12, 1.5, 2, '', '1725185292259.jpeg', '2024-09-01 10:08:12', NULL),
(40, 1, 'Jagung Besar', 5400, 7000, 1, 35, 1, 1, '', '1726393285199.jpeg', '2024-09-15 09:41:25', NULL),
(41, 1, 'Jagung Kecil', 10000, 11000, 1, 5, 1, 1, '', '1726393354911.jpg', '2024-09-15 09:42:34', NULL),
(42, 1, 'Minyak Goreng Fortune Bantal', 16083, 17500, 10, 11, 1, 2, '', '1726457052985.jpeg', '2024-09-16 03:24:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_unit`
--

CREATE TABLE `product_unit` (
  `id` int(12) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_unit`
--

INSERT INTO `product_unit` (`id`, `name`, `created_at`) VALUES
(1, 'kg', '2024-06-12 05:40:15'),
(2, 'Liter', '2024-06-12 05:40:15'),
(3, 'g', '2024-06-12 05:40:58'),
(4, 'ml', '2024-06-12 05:40:58');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `expired` date NOT NULL,
  `supplier_id` int(12) NOT NULL,
  `product_id` int(12) NOT NULL,
  `date` varchar(64) DEFAULT NULL,
  `detail` varchar(128) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `note` varchar(256) DEFAULT NULL,
  `is_returned` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `expired`, `supplier_id`, `product_id`, `date`, `detail`, `price`, `quantity`, `total`, `note`, `is_returned`, `created_at`, `updated_at`) VALUES
(4, '2025-12-31', 5, 33, '2024-07-15', NULL, 10875, 40, 435000, '', 0, NULL, NULL),
(5, '2025-12-31', 5, 32, '2024-07-15', NULL, 10875, 40, 435000, '', 0, NULL, NULL),
(6, '2025-12-31', 5, 31, '2024-07-15', NULL, 10500, 20, 210000, '', 0, NULL, NULL),
(7, '2025-07-20', 2, 34, '2024-07-19', NULL, 17500, 10, 175000, '', 0, NULL, NULL),
(8, '2025-12-31', 5, 35, '2024-07-21', NULL, 8600, 50, 430000, '', 0, '2024-07-22 04:30:20', '2024-07-22 04:31:49'),
(9, '2024-12-31', 6, 37, '2024-07-24', NULL, 3700, 84, 310800, '', 0, '2024-07-25 03:41:13', NULL),
(10, '2024-12-31', 1, 38, '2024-07-24', NULL, 12000, 25, 300000, '', 0, '2024-07-25 03:43:36', NULL),
(11, '2025-07-29', 1, 38, '2024-07-28', NULL, 12000, 30, 360000, '', 0, '2024-07-28 22:40:04', NULL),
(12, '2024-12-31', 5, 36, '2024-07-28', NULL, 10500, 40, 420000, '', 0, '2024-07-28 22:46:30', '2024-07-28 23:12:34'),
(13, '2024-08-04', 5, 35, '2024-08-04', NULL, 8600, 50, 430000, '', 0, '2024-08-04 04:53:09', NULL),
(14, '2024-08-04', 5, 32, '2024-08-04', NULL, 10875, 40, 435000, '', 0, '2024-08-04 04:54:20', NULL),
(15, '2024-08-17', 5, 31, '2024-08-17', NULL, 10500, 20, 210000, '', 0, '2024-08-17 09:59:31', NULL),
(16, '2024-08-17', 5, 35, '2024-08-17', NULL, 8600, 50, 430000, '', 0, '2024-08-17 10:00:10', NULL),
(17, '2024-08-17', 5, 36, '2024-08-17', NULL, 10125, 40, 405000, '', 0, '2024-08-17 10:02:19', NULL),
(18, '2024-09-01', 5, 35, '2024-09-01', NULL, 8600, 50, 430000, '', 0, '2024-09-01 09:56:37', NULL),
(19, '2024-09-01', 5, 36, '2024-09-01', NULL, 10125, 40, 405000, '', 0, '2024-09-01 09:57:25', NULL),
(20, '2024-09-01', 5, 32, '2024-09-01', NULL, 10875, 40, 435000, '', 0, '2024-09-01 09:57:55', NULL),
(21, '2024-09-01', 7, 39, '2024-09-01', NULL, 4500, 12, 54000, '', 0, '2024-09-01 10:09:52', NULL),
(22, '2024-09-13', 8, 38, '2024-09-13', NULL, 12000, 85, 1020000, 'Beli 2x 55kg dan 30kg', 0, '2024-09-13 05:59:41', NULL),
(23, '2024-09-15', 5, 35, '2024-09-15', NULL, 8600, 50, 430000, '', 0, '2024-09-15 09:38:04', NULL),
(24, '2024-09-15', 5, 31, '2024-09-15', NULL, 10500, 20, 210000, '', 0, '2024-09-15 09:38:28', NULL),
(25, '2024-09-15', 9, 41, '2024-09-15', NULL, 10000, 5, 50000, '', 0, '2024-09-15 09:43:12', NULL),
(26, '2024-09-15', 9, 40, '2024-09-15', NULL, 6000, 10, 60000, '', 0, '2024-09-15 09:43:44', NULL),
(27, '2024-09-15', 1, 37, '2024-09-15', NULL, 4000, 67, 268000, '', 0, '2024-09-15 09:45:42', NULL),
(28, '2024-09-15', 1, 38, '2024-09-15', NULL, 12500, 20, 250000, '', 0, '2024-09-15 09:46:05', '2024-11-03 22:31:39'),
(29, '2024-09-16', 4, 42, '2024-09-16', NULL, 16083, 12, 192996, '', 0, '2024-09-16 03:25:34', NULL),
(30, '2024-09-29', 5, 36, '2024-09-29', NULL, 10125, 40, 405000, '', 0, '2024-09-29 04:29:50', NULL),
(31, '2024-10-13', 5, 35, '2024-10-13', NULL, 8600, 50, 430000, '', 0, '2024-10-13 09:35:50', NULL),
(32, '2024-10-13', 5, 31, '2024-10-13', NULL, 10500, 20, 210000, '', 0, '2024-10-13 09:36:25', NULL),
(33, '2024-10-20', 5, 36, '2024-10-20', NULL, 10125, 40, 405000, '', 0, '2024-10-20 04:21:43', NULL),
(34, '2024-10-20', 5, 33, '2024-10-20', NULL, 10875, 40, 435000, '', 0, '2024-10-20 04:22:56', NULL),
(35, '2024-10-20', 5, 31, '2024-10-20', NULL, 10500, 20, 210000, '', 0, '2024-10-20 04:23:34', NULL),
(36, '2024-10-27', 5, 35, '2024-10-27', NULL, 8600, 50, 430000, '', 0, '2024-10-27 09:22:32', NULL),
(37, '2024-10-27', 5, 32, '2024-10-27', NULL, 10875, 40, 435000, '', 0, '2024-10-27 09:23:05', NULL),
(38, '2025-11-04', 9, 40, '2024-11-03', NULL, 5400, 25, 135000, '', 0, '2024-11-03 22:04:32', NULL),
(39, '2024-11-17', 5, 35, '2024-11-17', NULL, 8500, 50, 425000, '', 0, '2024-11-17 01:03:46', NULL),
(40, '2024-12-01', 5, 35, '2024-12-01', NULL, 8600, 50, 430000, '', 0, '2024-12-01 12:39:05', NULL),
(41, '2024-12-01', 5, 31, '2024-12-01', NULL, 10500, 20, 210000, '', 0, '2024-12-01 12:40:06', NULL),
(42, '2025-12-29', 5, 35, '2024-12-29', NULL, 8600, 50, 430000, '', 0, '2024-12-30 21:57:22', NULL),
(43, '2025-12-29', 5, 31, '2024-12-29', NULL, 10500, 20, 210000, '', 0, '2024-12-30 21:58:09', NULL),
(44, '2025-12-29', 5, 36, '2024-12-29', NULL, 10125, 40, 405000, '', 0, '2024-12-30 21:59:09', NULL),
(45, '2025-12-29', 1, 38, '2024-12-29', NULL, 12000, 30, 360000, '', 0, '2024-12-30 22:00:42', NULL),
(46, '2025-12-29', 1, 37, '2024-12-29', NULL, 3800, 1, 3800, '', 0, '2024-12-30 22:01:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_detail`
--

CREATE TABLE `purchase_detail` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `detail` varchar(128) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `note` varchar(256) DEFAULT NULL,
  `expired_at` varchar(64) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_detail`
--

INSERT INTO `purchase_detail` (`id`, `purchase_id`, `detail`, `price`, `quantity`, `total`, `note`, `expired_at`, `created_at`, `updated_at`) VALUES
(1, 5, 'Tomat e', 2, 1, 2000, 'Tes', '', NULL, NULL),
(2, 5, 'sas', 1, 1, 1, '', '', NULL, NULL),
(3, 2, 'xxi', 1, 1, 1, '', '', NULL, NULL),
(4, 5, 'sa', 1, 1, 1, '', '', NULL, NULL),
(5, 5, 'as', 11, 1, 11, '', '', NULL, NULL),
(6, 2, 'q', 12, 1, 12, '', '', NULL, NULL),
(7, 5, 'qw', 11, 1, 11, '', '', NULL, NULL),
(9, 2, 'Tapioka', 122, 1, 122, '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return`
--

CREATE TABLE `purchase_return` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `product_id` int(12) NOT NULL,
  `price` varchar(128) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `note` varchar(128) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_return`
--

INSERT INTO `purchase_return` (`id`, `purchase_id`, `product_id`, `price`, `quantity`, `total`, `note`, `created_at`, `updated_at`) VALUES
(4, 12, 36, '10500', 5, 52500, '', '2024-07-29', '2024-07-29');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `desk` int(11) DEFAULT NULL,
  `total` int(12) NOT NULL,
  `total_price` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `discount_nominal` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_returned` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`id`, `member_id`, `desk`, `total`, `total_price`, `discount`, `discount_nominal`, `status`, `is_returned`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 31, 0, 15000, 15000, 0, 0, 1, 0, 1, '2024-09-15 17:00:00', NULL),
(2, 1, 0, 10000, 10000, 0, 0, 1, 0, 1, '2024-09-15 17:00:00', NULL),
(3, 1, 0, 135000, 135000, 0, 0, 1, 0, 1, '2024-09-28 17:00:00', NULL),
(4, 1, 0, 20000, 20000, 0, 0, 1, 0, 1, '2024-10-12 17:00:00', NULL),
(5, 12, 0, 12000, 12000, 0, 0, 1, 0, 1, '2024-10-19 17:00:00', NULL),
(6, 1, 0, 0, 5000, 0, 0, 1, 0, 1, '2024-10-19 17:00:00', NULL),
(7, 1, 0, 20000, 20000, 0, 0, 1, 0, 1, '2024-10-19 17:00:00', NULL),
(8, 1, 0, 17500, 17500, 0, 0, 1, 0, 1, '2024-11-03 17:00:00', NULL),
(9, 31, 0, 20000, 20000, 0, 0, 1, 0, 1, '2024-12-01 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sale_detail`
--

CREATE TABLE `sale_detail` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `member_id` int(11) NOT NULL,
  `product` varchar(256) NOT NULL,
  `quantity` int(11) NOT NULL,
  `hpp` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `margin` int(12) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_detail`
--

INSERT INTO `sale_detail` (`id`, `sale_id`, `product_id`, `member_id`, `product`, `quantity`, `hpp`, `price`, `total`, `margin`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 37, 31, 'Dedek', 3, 4000, 5000, 15000, 3000, 1, '2024-09-15 17:00:00', NULL),
(2, 2, 37, 1, 'Dedek', 2, 4000, 5000, 10000, 2000, 1, '2024-09-15 17:00:00', NULL),
(3, 3, 38, 1, 'Beras', 10, 12500, 13500, 135000, 10000, 1, '2024-09-28 17:00:00', NULL),
(4, 4, 34, 1, 'LPG', 1, 17500, 20000, 20000, 2500, 1, '2024-10-12 17:00:00', NULL),
(5, 5, 36, 12, 'Excel Ungu', 1, 10125, 12000, 12000, 1875, 1, '2024-10-19 17:00:00', NULL),
(6, 6, 37, 1, 'Dedek', 1, 4000, 5000, 5000, 1000, 1, '2024-10-19 17:00:00', NULL),
(7, 7, 37, 1, 'Dedek', 4, 4000, 5000, 20000, 4000, 1, '2024-10-19 17:00:00', NULL),
(8, 8, 42, 1, 'Minyak Goreng Fortune Bantal', 1, 16083, 17500, 17500, 1417, 1, '2024-11-03 17:00:00', NULL),
(9, 9, 37, 31, 'Dedek', 4, 4000, 5000, 20000, 4000, 1, '2024-12-01 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sale_detail_return`
--

CREATE TABLE `sale_detail_return` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `member_id` int(11) NOT NULL,
  `product` varchar(256) NOT NULL,
  `quantity` int(11) NOT NULL,
  `hpp` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `margin` int(12) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sale_return`
--

CREATE TABLE `sale_return` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `discount_nominal` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `note` varchar(128) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(12) NOT NULL,
  `name` varchar(100) NOT NULL,
  `owner` varchar(100) NOT NULL,
  `address` varchar(250) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `owner`, `address`, `phone`, `created_at`) VALUES
(1, 'Selep Kawis', 'RIzal', 'Widang', '', '2024-06-04 00:38:56'),
(2, 'Dani Jaya', 'Agus Muslim', 'Klewer', '', '2024-06-05 01:41:03'),
(3, 'Selep Widang', 'Om Jang', 'Tuban', '', '2024-06-05 01:41:25'),
(4, 'Toko Loteng', 'Ping An', 'Babat', '', '2024-06-05 01:43:10'),
(5, 'Rayahu Pakan Ternak', '', '', '', '2024-07-18 06:36:55'),
(6, 'Wulan Blogan', 'Wulan', '', '', '2024-07-25 10:40:38'),
(7, 'Pak Haji Widang', '', '', '', '2024-09-01 17:09:29'),
(8, 'Selep Palek Jarno', '', '', '', '2024-09-13 12:56:25'),
(9, 'Pasar Babat', '', '', '', '2024-09-15 16:42:51');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `no` int(100) NOT NULL,
  `nama_dpn` varchar(100) NOT NULL,
  `nama_blkng` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `grup` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`no`, `nama_dpn`, `nama_blkng`, `username`, `password`, `grup`) VALUES
(1, 'rian', 'tri', 'rian', '12345', 1),
(3, 'riann', 'trii', 'r', '22', 0),
(4, 'coba', 'ba', 'cob', 'coba', 0),
(5, '', '', 'q', 'n', 0),
(6, '', '', 'jk', 'kkh', 0),
(7, 'q', 'q', 'q', '34', 0),
(8, 'coba', 'satu', 'dua', 'tiga', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$12$cabrZKBhVn6eScbPekrLrOd49/zvX.v/3Z3QyZIjkHVoxuNEAF3rW', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1735942773, 1, 'Admin', 'istrator', 'ADMIN', '628573341688'),
(2, '::1', 'kasir@gmail.com', '$2y$10$DPacgIHzx5DnP97QHIiRxe.5K85Ebew/TiLm6WiSAz17lPec710T6', 'kasir@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1580262442, 1719527645, 1, 'Kasir', 'A', 'ABC', '085733418888');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(7, 1, 1),
(8, 1, 2),
(9, 2, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `desk`
--
ALTER TABLE `desk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_product`
--
ALTER TABLE `material_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_return`
--
ALTER TABLE `payment_return`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_unit`
--
ALTER TABLE `product_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_detail`
--
ALTER TABLE `purchase_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_id` (`purchase_id`);

--
-- Indexes for table `purchase_return`
--
ALTER TABLE `purchase_return`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_id` (`purchase_id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_detail`
--
ALTER TABLE `sale_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `product_id` (`product`);

--
-- Indexes for table `sale_detail_return`
--
ALTER TABLE `sale_detail_return`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `product_id` (`product`);

--
-- Indexes for table `sale_return`
--
ALTER TABLE `sale_return`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_id` (`sale_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `desk`
--
ALTER TABLE `desk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail`
--
ALTER TABLE `detail`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `material_product`
--
ALTER TABLE `material_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment_return`
--
ALTER TABLE `payment_return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `product_unit`
--
ALTER TABLE `product_unit`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `purchase_detail`
--
ALTER TABLE `purchase_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `purchase_return`
--
ALTER TABLE `purchase_return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sale_detail`
--
ALTER TABLE `sale_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sale_detail_return`
--
ALTER TABLE `sale_detail_return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_return`
--
ALTER TABLE `sale_return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `no` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `purchase_return`
--
ALTER TABLE `purchase_return`
  ADD CONSTRAINT `purchase_return_ibfk_1` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
