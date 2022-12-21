-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2022 at 07:24 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `compart`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(80) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(80) NOT NULL,
  `balance` decimal(10,0) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fullname`, `username`, `password`, `email`, `balance`, `created_at`, `modified_at`) VALUES
(3, 'admin', 'admin12', '$2y$10$DN./6AZy44AE14UfunS7/.juoGZznmjiVvl8vqwZ2nXqSl/wNm5qi', 'admin@gmail.com', '0', '2022-12-19 22:44:14', '2022-12-19 22:44:14');

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `id` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`id`, `amount`, `quantity`, `created_at`, `modified_at`, `deleted_at`, `product_id`, `user_id`) VALUES
(110, '95', 1, '2022-12-20 05:01:19', NULL, NULL, 50, 11);

-- --------------------------------------------------------

--
-- Table structure for table `checkout_session`
--

CREATE TABLE `checkout_session` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkout_session`
--

INSERT INTO `checkout_session` (`id`, `status`, `quantity`, `total`, `created_at`, `modified_at`, `deleted_at`, `product_id`, `seller_id`, `user_id`) VALUES
(40, 2, 1, '113', '2022-12-20 01:33:24', '2022-12-20 01:34:07', NULL, 49, 5, 8),
(41, 2, 2, '216', '2022-12-20 01:50:48', '2022-12-20 01:51:31', NULL, 51, 3, 8),
(42, 2, 2, '190', '2022-12-20 04:20:44', '2022-12-20 09:26:57', NULL, 50, 5, 8),
(43, 2, 2, '162', '2022-12-20 08:04:45', '2022-12-20 08:05:26', NULL, 54, 3, 8),
(44, 2, 2, '226', '2022-12-20 08:06:05', '2022-12-20 08:06:48', NULL, 49, 5, 8),
(45, 0, 1, '10', '2022-12-20 09:25:22', NULL, NULL, 30, 3, 8);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `category` varchar(80) NOT NULL,
  `merk` varchar(80) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `discount` decimal(10,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `inventory_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `desc`, `category`, `merk`, `picture`, `price`, `discount`, `created_at`, `modified_at`, `deleted_at`, `inventory_id`, `seller_id`) VALUES
(28, 'HyperX Alloy Origins Core - Mechanical Gaming Keyboard', '- Tenkeyless with detachable cable\r\n- RGB Backlighting\r\n- Customizable with NGENUITY Software\r\n- Three adjustable keyboard angles', 'Keyboard', 'Hyperx', '638a0dbd84ef3.webp', '60', '2', '2022-12-02 08:37:49', '2022-12-02 08:37:49', '2022-12-20 09:28:03', 46, 3),
(29, 'SIGNATURE M650', 'Upgrade to smarter scrolling, greater comfort, and more productivity The Signature M650 features SmartWheel scrolling that delivers precision or speed when you need it.\r\n', 'Mouse', 'Logitech', '638a11a655de5.webp', '30', '10', '2022-12-02 08:54:30', '2022-12-03 04:48:25', NULL, 47, 3),
(30, 'Monitor 4K UltraFine™ 23.7 inci', '- 23.7 inch 4K IPS display\r\n- DCI-P3 & 500nits\r\n- Lightning™ 3\r\n- Daisy Chain 4K\r\n- Mac compatible\r\n- Stand Height & Tilt Can Be Discussed', 'Monitor', 'LG', '638ab50a2aa55.webp', '10', '5', '2022-12-02 20:31:38', '2022-12-03 04:49:55', NULL, 48, 3),
(31, 'Z790 UD  aaa', '- Intel® Socket LGA 1700：Support 13th and 12th Gen Series Processors', 'Motherboard', 'Gigabyte', '638b28b2d7ae1.webp', '70', '80', '2022-12-02 20:35:54', '2022-12-20 09:22:15', '2022-12-20 09:22:31', 49, 3),
(48, 'HyperX Alloy Origins - Naruto Edition - Mechanical Gaming Keyboard', 'Limited Itachi Edition\r\nHyperX mechanical switches\r\nFull aircraft-grade aluminum body\r\nCompatibility: PC, PS5, PS4, Xbox Series X|S, Xbox One', 'Keyboard', 'Hyperx', '63a1600cb89d3.webp', '119', '0', '2022-12-20 01:11:08', '2022-12-20 01:15:37', NULL, 105, 5),
(49, 'HyperX Alloy Origins - Itachi Edition - Mechanical Gaming Keyboard', 'Limited Itachi Edition\r\nHyperX mechanical switches\r\nFull aircraft-grade aluminum body\r\nCompatibility: PC, PS5, PS4, Xbox Series X|S, Xbox One', 'Keyboard', 'Hyperx', '63a16055109cf.webp', '119', '5', '2022-12-20 01:12:21', NULL, NULL, 106, 5),
(50, 'HyperX Alloy MKW100 - Mechnical Gaming Keyboard', 'Dynamic per-key RGB lighting\r\nDurable aluminum frame\r\nDetachable wrist rest\r\nReliable dust-proof mechanical switches', 'Keyboard', 'Hyperx', '63a161049130f.webp', '119', '20', '2022-12-20 01:15:16', NULL, NULL, 107, 5),
(51, 'Processor Intel Core i5 4570 / 4590 / 4670 / 4690 Tray Socket 1150 Ci5 - 4590', '- i5 4570\r\nFrekuensi Dasar Prosesor : 3.20 GHz\r\nFrekuensi Turbo Maks : 3.60 GHz\r\n\r\n- i5 4590 : 3.30 GHz\r\nFrekuensi Dasar Prosesor : 3.30 GHz\r\nFrekuensi Turbo Maks : 3.70 GHz\r\n\r\n- i5 4670 : 3.40 GHz\r\nFrekuensi Dasar Prosesor : 3.40 GHz\r\nFrekuensi Turbo Maks : 3.80 GHz\r\n\r\n- i5 4690 : 3.50 GHz\r\nFrekuensi Dasar Prosesor : 3.50 GHz\r\nFrekuensi Turbo Maks : 3.90 GHz\r\n', 'CPU', 'intel', '63a166ad9ca0e.jpg', '123', '12', '2022-12-20 01:38:49', '2022-12-20 05:03:42', '2022-12-20 08:07:57', 108, 3),
(52, 'HyperX Cloud Stinger - Gaming Headset - PS5-PS4', 'Official PlayStation® licensed headset\r\nLightweight with 90-degree rotating ear cups\r\nHyperX Signature comfort and durability\r\nSwivel-to-mute noise-cancelling mic', 'Headset', 'Hyperx', '63a1bfb1dee76.webp', '27', '5', '2022-12-20 07:59:13', NULL, NULL, 109, 3),
(53, 'HyperX Cloud Stinger 2 wireless - Gaming Headset', 'DTS® Headphone:X® Spatial Audio\r\nLong-Lasting Battery Life\r\nSignature HyperX Comfort\r\nReliable 2.4GHz Wireless', 'Headset', 'Hyperx', '63a1c0245a5f1.webp', '80', '10', '2022-12-20 08:01:08', NULL, NULL, 110, 3),
(54, 'HyperX Armada 27 QHD Gaming Monitor', 'All-in-One package: Desk mount included\r\n27-inch diagonal QHD (2560x1440) IPS widescreen gaming monitor\r\nHigher resolution for immersive gaming\r\nSharper image quality for a mesmerizing experience', 'Monitor', 'Hyperx', '63a1c0ad56eba.webp', '90', '10', '2022-12-20 08:03:25', NULL, NULL, 111, 3),
(56, 'afahghs', 'ahtaftfatyfa', 'vafyus', 'amhgyjgs', '63a1d3695f5a1.webp', '166', '13', '2022-12-20 09:23:21', NULL, NULL, 113, 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_inventory`
--

CREATE TABLE `product_inventory` (
  `id` int(11) NOT NULL,
  `quantity` int(255) NOT NULL,
  `sold` int(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_inventory`
--

INSERT INTO `product_inventory` (`id`, `quantity`, `sold`, `created_at`, `modified_at`, `deleted_at`) VALUES
(46, 2, 8, '2022-12-02 08:37:49', '2022-12-02 08:37:49', NULL),
(47, 0, 10, '2022-12-02 08:54:30', '2022-12-03 04:48:25', NULL),
(48, 1, 9, '2022-12-02 20:31:38', '2022-12-03 04:49:55', NULL),
(49, 80, 10, '2022-12-02 20:35:54', '2022-12-20 09:22:15', NULL),
(50, 2, 8, '2022-12-03 01:08:05', '2022-12-03 01:08:05', NULL),
(51, 2, 8, '2022-12-03 01:08:32', '2022-12-03 01:08:32', NULL),
(52, 2, 8, '2022-12-03 01:09:56', '2022-12-03 01:09:56', NULL),
(53, 2, 8, '2022-12-03 01:12:00', '2022-12-03 01:12:00', NULL),
(54, 2, 8, '2022-12-03 01:14:54', '2022-12-03 01:14:54', NULL),
(55, 2, 8, '2022-12-03 01:16:03', '2022-12-03 01:16:03', NULL),
(56, 2, 8, '2022-12-03 01:16:28', '2022-12-03 01:16:28', NULL),
(57, 2, 8, '2022-12-03 01:17:08', '2022-12-03 01:17:08', NULL),
(58, 2, 8, '2022-12-03 01:17:22', '2022-12-03 01:17:22', NULL),
(59, 2, 8, '2022-12-03 01:18:07', '2022-12-03 01:18:07', NULL),
(60, 2, 8, '2022-12-03 01:19:13', '2022-12-03 01:19:13', NULL),
(61, 2, 8, '2022-12-03 01:19:40', '2022-12-03 01:19:40', NULL),
(62, 2, 8, '2022-12-03 01:20:17', '2022-12-03 01:20:17', NULL),
(65, 2, 8, '2022-12-03 01:20:44', '2022-12-03 01:20:44', NULL),
(66, 2, 8, '2022-12-03 01:21:41', '2022-12-03 01:21:41', NULL),
(67, 2, 8, '2022-12-03 01:22:11', '2022-12-03 01:22:11', NULL),
(68, 2, 8, '2022-12-03 01:22:39', '2022-12-03 01:22:39', NULL),
(69, 2, 8, '2022-12-03 01:22:42', '2022-12-03 01:22:42', NULL),
(70, 4, 8, '2022-12-03 01:23:11', '2022-12-03 01:23:11', NULL),
(71, 4, 8, '2022-12-03 01:27:22', '2022-12-03 01:27:22', NULL),
(72, 2, 8, NULL, NULL, NULL),
(73, 4, 8, '2022-12-03 01:30:31', '2022-12-03 01:30:31', NULL),
(74, 4, 8, '2022-12-03 01:32:45', '2022-12-03 01:32:45', NULL),
(75, 4, 8, '2022-12-03 01:32:49', '2022-12-03 01:32:49', NULL),
(76, 4, 8, '2022-12-03 01:33:23', '2022-12-03 01:33:23', NULL),
(77, 4, 8, '2022-12-03 01:33:49', '2022-12-03 01:33:49', NULL),
(78, 4, 8, '2022-12-03 01:34:43', '2022-12-03 01:34:43', NULL),
(79, 4, 8, '2022-12-03 01:34:48', '2022-12-03 01:34:48', NULL),
(80, 4, 8, '2022-12-03 01:35:03', '2022-12-03 01:35:03', NULL),
(81, 2, 8, '2022-12-03 01:38:01', '2022-12-03 01:38:01', NULL),
(82, 7, 13, '2022-12-03 08:15:33', '2022-12-18 16:57:19', NULL),
(83, 2, 11, '2022-12-03 08:18:27', '2022-12-04 08:55:24', NULL),
(84, 2, 8, '2022-12-03 22:52:53', '2022-12-03 22:52:53', NULL),
(85, 1, 8, '2022-12-04 08:21:18', '2022-12-04 08:21:18', NULL),
(86, 2, 8, '2022-12-04 08:25:09', '2022-12-04 08:25:09', NULL),
(87, 2, 8, '2022-12-04 08:26:17', '2022-12-04 08:26:17', NULL),
(88, 2, 8, '2022-12-04 08:26:43', '2022-12-04 08:26:43', NULL),
(89, 2, 8, '2022-12-04 08:27:06', '2022-12-04 08:27:06', NULL),
(90, 2, 8, '2022-12-04 08:27:12', '2022-12-04 08:27:12', NULL),
(91, 2, 8, '2022-12-04 08:27:27', '2022-12-04 08:27:27', NULL),
(92, 2, 8, '2022-12-04 08:28:27', '2022-12-04 08:28:27', NULL),
(93, 2, 8, '2022-12-04 08:28:35', '2022-12-04 08:28:35', NULL),
(94, 2, 8, '2022-12-04 08:29:36', '2022-12-04 08:29:36', NULL),
(95, 2, 8, '2022-12-04 08:30:32', '2022-12-04 08:30:32', NULL),
(96, 2, 8, '2022-12-04 08:31:22', '2022-12-04 08:31:22', NULL),
(97, 2, 8, '2022-12-04 08:32:29', '2022-12-04 08:32:29', NULL),
(98, 2, 8, '2022-12-04 08:33:16', '2022-12-04 08:33:16', NULL),
(99, 2, 8, '2022-12-04 08:33:33', '2022-12-04 08:33:33', NULL),
(100, 2, 8, '2022-12-04 08:33:35', '2022-12-04 08:33:35', NULL),
(101, 9, 11, '2022-12-04 08:34:29', '2022-12-04 08:34:29', NULL),
(103, 2, 8, '2022-12-04 08:42:47', '2022-12-04 08:42:47', NULL),
(104, 100, 12, '2022-12-04 08:58:55', '2022-12-19 21:34:49', NULL),
(105, 80, 0, '2022-12-20 01:11:08', '2022-12-20 01:11:08', NULL),
(106, 97, 3, '2022-12-20 01:12:21', '2022-12-20 01:12:21', NULL),
(107, 98, 2, '2022-12-20 01:15:16', '2022-12-20 01:15:16', NULL),
(108, 98, 2, '2022-12-20 01:38:49', '2022-12-20 01:39:25', NULL),
(109, 100, 0, '2022-12-20 07:59:13', '2022-12-20 07:59:13', NULL),
(110, 100, 0, '2022-12-20 08:01:08', '2022-12-20 08:01:08', NULL),
(111, 98, 2, '2022-12-20 08:03:25', '2022-12-20 08:03:25', NULL),
(112, 100, 0, '2022-12-20 08:18:05', '2022-12-20 08:18:05', NULL),
(113, 30, 0, '2022-12-20 09:23:21', '2022-12-20 09:23:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `balance` decimal(10,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`id`, `fullname`, `username`, `password`, `email`, `balance`, `created_at`, `modified_at`, `address_id`) VALUES
(3, 'rehan', 'rehan12', '$2y$10$GdtE54tcZSdWJydyhnZZNO2jGt78GfnndAqQBTiR/VTiZNtE7maPG', 'haog@gmail.com', '0', '2022-12-02 04:18:01', '2022-12-02 04:18:01', NULL),
(4, 'aa', 'koko', '$2y$10$98Ifu6Nj1H0jKYbuFD9xWOhP54.dUHzXln5LTKn1xVhUBidzdOCOO', 'kok@fmail.com', '0', '2022-12-02 09:37:27', '2022-12-02 09:37:27', NULL),
(5, 'irgiyansyah', 'ionia', '$2y$10$aJc8/qp60vjDi9M4sJoYfOvS2rrxYtWeHY/eFt4qcmdPs40FkuYzi', 'ionia@gmail.com', '0', '2022-12-03 08:02:03', '2022-12-03 08:02:03', NULL),
(6, 'yourname', 'youare', '$2y$10$g8DPXwmwXB5nf5QaZEnemONxUkASxFaE5/T5DrZL.M6bzBaWpDezC', 'youa@gmail.com', '0', '2022-12-03 11:15:38', '2022-12-03 11:15:38', NULL),
(7, 'ucup', 'ucup12', '$2y$10$LxgC3/u5ztWfhncrtiKwr.zHnR3Np1Bn/rpPN1D2dMWvtcXvoOK2W', 'ucup@gmail.com', '0', '2022-12-20 04:24:22', '2022-12-20 04:24:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `seller_address`
--

CREATE TABLE `seller_address` (
  `id` int(11) NOT NULL,
  `address_line` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `postal_code` int(10) NOT NULL,
  `seller_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller_address`
--

INSERT INTO `seller_address` (`id`, `address_line`, `city`, `postal_code`, `seller_id`) VALUES
(3, 'JL Industri 12 KM', 'Bogor', 1201, 5),
(4, 'JL Pasar KM 21', 'Jakarta', 1241, 3);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_session`
--

CREATE TABLE `shopping_session` (
  `id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `balance` decimal(10,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `username`, `password`, `email`, `balance`, `created_at`, `modified_at`) VALUES
(4, 'al', 'aleale', '$2y$10$qTkh6ycZ7xPJiOA6V4envuM1G7Bh6wYjboZk8GrJrkIa1GRxt9sRq', '12ale@gamilc.ocm', '100', '2022-11-30 17:00:00', '0000-00-00 00:00:00'),
(5, 'afae', 'afah', '$2y$10$NaWnqgKfQEEpGo05Gym.vewQUypHtoT6OXADHhtt3AXo1kCFjdTCm', '12ale@gamilc.ocm', '100', '2022-11-30 17:00:00', '0000-00-00 00:00:00'),
(6, 'sudah ada', 'ap', '$2y$10$p2sbaqd5r9gLm4aBDpC3ku5d67z/uhGbGzSogRfH.M59B4dxZsp72', 'anfoafn@famo.com', '0', '2022-11-30 17:00:00', '0000-00-00 00:00:00'),
(7, 'afa', 'af', '$2y$10$YgH3ufcE5pHJVKF9.hRmaeV3VwVv/OuMK3IRGSI2WY/TiwgXOmfEy', '12ale@gamilc.com', '0', '2022-11-30 17:00:00', '0000-00-00 00:00:00'),
(8, 'Desintya', 'desintya12', '$2y$10$LBcAFuWEtL6RSF8LVqCuUOF..r3pqlXjp.WalRlWh4NU0bqg31.7m', 'kelompok4@gmail.com', '0', '2022-12-03 23:22:02', '2022-12-03 23:22:02'),
(9, 'safira', 'saff12', '$2y$10$VQ0Z16b9UBi3urpto59RI.aJY88LPLArqGfJKmS6cES6Znwmtbyzu', 'safira@gmail.com', '0', '2022-12-19 10:29:25', '2022-12-19 10:29:25'),
(10, 'test', 'test12', '$2y$10$t994owtF.CZS0rAsGLN7D.4XzUmHipphDBiYivpHBwiWheuc8alty', 'TESTA@GMAIL.VOM', '0', '2022-12-19 22:37:27', '2022-12-19 22:37:27'),
(11, 'frasiska', 'frasiska12', '$2y$10$Jx5B8JBLZQaJ2V907HShteu10em3/X1D88/BfNW3V1huPbXHtbJgm', 'frasiska123@gmail.com', '0', '2022-12-20 04:58:58', '2022-12-20 04:58:58'),
(12, 'sfghftusa', 'sffsyussa', '$2y$10$l1a5VNmcPf4p9m9B6HCjre5hvIPlzwUegh.M5PYvaAWaRpPnxZC/S', 'sfsfgjsa@gmail.com', '0', '2022-12-20 09:21:13', '2022-12-20 09:21:13');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `id` int(11) NOT NULL,
  `address_line` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `postal_code` int(10) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`id`, `address_line`, `city`, `postal_code`, `user_id`) VALUES
(8, 'JL KM 4', 'Bogor', 1314, 8),
(9, 'JL KM 3 Industri', 'Surabaya', 1391, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `checkout_session`
--
ALTER TABLE `checkout_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `seller_id` (`seller_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventory_id` (`inventory_id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `product_inventory`
--
ALTER TABLE `product_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `seller_address`
--
ALTER TABLE `seller_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `shopping_session`
--
ALTER TABLE `shopping_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `checkout_session`
--
ALTER TABLE `checkout_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `product_inventory`
--
ALTER TABLE `product_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `seller_address`
--
ALTER TABLE `seller_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shopping_session`
--
ALTER TABLE `shopping_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `checkout_session`
--
ALTER TABLE `checkout_session`
  ADD CONSTRAINT `checkout_session_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `checkout_session_ibfk_2` FOREIGN KEY (`seller_id`) REFERENCES `seller` (`id`),
  ADD CONSTRAINT `checkout_session_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`inventory_id`) REFERENCES `product_inventory` (`id`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`seller_id`) REFERENCES `seller` (`id`);

--
-- Constraints for table `seller`
--
ALTER TABLE `seller`
  ADD CONSTRAINT `seller_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `seller_address` (`id`);

--
-- Constraints for table `seller_address`
--
ALTER TABLE `seller_address`
  ADD CONSTRAINT `seller_address_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `seller` (`id`);

--
-- Constraints for table `shopping_session`
--
ALTER TABLE `shopping_session`
  ADD CONSTRAINT `shopping_session_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `user_address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
