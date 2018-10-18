-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 23, 2018 at 11:54 AM
-- Server version: 5.6.40-84.0
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tip4tips2018_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Create', 'create', NULL, NULL),
(2, 'edit', 'Edit', NULL, NULL),
(3, 'View', 'view', NULL, NULL),
(4, 'Delete', 'delete', NULL, NULL),
(5, 'List', 'list', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(10) UNSIGNED NOT NULL,
  `consultant_id` int(10) UNSIGNED NOT NULL,
  `lead_id` int(10) UNSIGNED NOT NULL,
  `create_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `consultant_id`, `lead_id`, `create_by`, `created_at`, `updated_at`) VALUES
(3, 7, 6, 1, '2018-01-23 12:26:24', '2018-01-23 12:26:24'),
(4, 7, 6, 1, '2018-01-23 12:31:28', '2018-01-23 12:31:28'),
(5, 7, 6, 1, '2018-01-23 12:32:12', '2018-01-23 12:32:12'),
(6, 6, 6, 1, '2018-01-23 12:46:04', '2018-01-23 12:46:04'),
(7, 7, 6, 1, '2018-01-24 02:24:49', '2018-01-24 02:24:49'),
(8, 6, 6, 1, '2018-01-24 02:38:37', '2018-01-24 02:38:37'),
(9, 6, 6, 1, '2018-01-31 02:37:01', '2018-01-31 02:37:01'),
(10, 6, 14, 1, '2018-02-06 13:06:00', '2018-02-06 13:06:00'),
(11, 6, 9, 1, '2018-02-08 03:49:51', '2018-02-08 03:49:51'),
(12, 6, 25, 1, '2018-02-08 04:39:41', '2018-02-08 04:39:41'),
(13, 16, 26, 1, '2018-03-01 04:42:42', '2018-03-01 04:42:42'),
(14, 18, 36, 1, '2018-03-22 00:49:32', '2018-03-22 00:49:32'),
(15, 6, 36, 1, '2018-03-22 00:50:54', '2018-03-22 00:50:54'),
(16, 6, 36, 1, '2018-03-22 00:53:48', '2018-03-22 00:53:48'),
(17, 16, 36, 1, '2018-03-22 01:00:20', '2018-03-22 01:00:20'),
(18, 16, 40, 1, '2018-05-24 10:30:02', '2018-05-24 10:30:02');

-- --------------------------------------------------------

--
-- Table structure for table `evaluationautos`
--

CREATE TABLE `evaluationautos` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_by` int(10) UNSIGNED NOT NULL,
  `person_is` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `giftcategories`
--

CREATE TABLE `giftcategories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `giftcategories`
--

INSERT INTO `giftcategories` (`id`, `name`, `code`, `description`, `created_at`, `updated_at`) VALUES
(2, 'Electronic', 'electronic', NULL, NULL, NULL),
(3, 'House tool', 'housetool', NULL, NULL, NULL),
(4, 'Accessories', 'accessories', NULL, NULL, NULL),
(5, 'activity', 'activity', NULL, NULL, NULL),
(6, 'Bags', 'bags', NULL, NULL, NULL),
(7, 'Bikes & Cars', 'bikes&cars', NULL, NULL, NULL),
(8, 'Clothes', 'clothes', NULL, NULL, NULL),
(9, 'Cosmetics', 'cosmetics', NULL, NULL, NULL),
(10, 'Entertaiment', 'entertaiment', NULL, NULL, NULL),
(11, 'Fine Foods', 'finefoods', NULL, NULL, NULL),
(12, 'Furniture', 'furniture', NULL, NULL, NULL),
(13, 'High Tech', 'hightech', NULL, NULL, NULL),
(14, 'House Ware', 'houseware', NULL, NULL, NULL),
(15, 'Jewels', 'jewels', NULL, NULL, NULL),
(16, 'Medical', 'medical', NULL, NULL, NULL),
(17, 'Sport items', 'sportitems', NULL, NULL, NULL),
(18, 'Travel', 'travel', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gifts`
--

CREATE TABLE `gifts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `point` decimal(8,0) NOT NULL DEFAULT '0',
  `category_id` int(10) UNSIGNED NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_is` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gifts`
--

INSERT INTO `gifts` (`id`, `name`, `description`, `point`, `category_id`, `thumbnail`, `delete_is`, `created_at`, `updated_at`) VALUES
(5, 'Quà tặng trải nghiệm đặc biệt - Sensesclub Crystal', 'Hop qua SensesClub tinh te de chieu dai nguoi than \r\nmot trai nghiem do ho tuy chon\r\nMoi hop qua tang trai nghiem SensesClub la mot suat trai nghiem doc dao tuy chon.\r\nMoi hop qua bao gom:\r\n* mot quyen sach giup cho nguoi duoc nhan lua chon trai nghiem va', '35', 18, '1519974719.jpg', 0, '2018-01-23 08:14:44', '2018-03-02 07:12:03'),
(6, 'Food Boxes Lock and Lock', NULL, '47', 3, '1519974620.jpg', 0, '2018-01-23 08:16:15', '2018-03-02 07:10:24'),
(7, '10.5-inch iPad Pro Wi-Fi 64GB - Rose Gold - Apple', '10.5-inch iPad Pro Wi-Fi 64GB - Rose Gold - Apple\r\nCost:  $649.00', '1200', 13, '1519973766.', 0, '2018-03-02 07:01:02', '2018-03-02 07:01:02'),
(8, 'iPhone X 256GB', 'iPhone X lột xác hoàn toàn với thiết kế mới độc đáo. Màn hình tràn viền phủ hầu hết mặt trước loại bỏ luôn nút home mang đến một trải nghiệm mới vô cùng độc đáo và khác biệt.\r\nCost: 1.149,00 $', '10500', 13, '1519974364.jpg', 0, '2018-03-02 07:08:39', '2018-03-03 02:05:43'),
(9, 'Samsung Galaxy J8 2018', 'The Samsung Galaxy J8 2018 is a good smartphone which is packed with quality features. Its excellent configurations deliver powerful performance and are capable of handling multiple tasks with ease. You can capture excellent photos and record good quality videos with the help of its great pair of cameras. The front LED flash assists you to click selfies even in low light conditions. Overall, the Samsung Galaxy J8 2018 is one of the best devices around this price tag.', '10000', 13, '1519974797.jpg', 0, '2018-03-02 07:15:14', '2018-03-02 07:15:14'),
(10, 'Samsung RSA1STSL Side-By-Side Fridge 550L', 'Catalogue Code: IP08468\r\nModel No: RSA1STSL\r\nTotal Capacity: 555 LCapacity Freezer: 180 LLED DisplayCooling Feature(s): Multi flowNet Dimension (WxHxD): 912x1789x734 mm.\r\nCost: 2,899.00$', '12000', 2, '1519974985.jpg;width=600', 0, '2018-03-02 07:17:42', '2018-03-02 07:18:02'),
(11, 'LG TONE PRO wireless Bluetooth headset (HBS-760)', 'Recently, we highlighted the upcoming release of LG’s Tone Active headset that will be releasing in October, but what about what’s available today? We have spent some time with LG’s TONE PRO HBS-760 (2015’s model) headset, to see where their earbuds take their stand in the always growing wireless market.', '500', 2, '1519975159.jpg', 0, '2018-03-02 07:20:42', '2018-03-02 07:20:42'),
(12, 'Bangkok-Pattaya - Khách sạn 3* Tặng vé xem Nanta show', 'Bangkok-Pattaya - Khách sạn 3* Tặng vé xem Nanta show (Tour Tiết Kiệm)', '1435', 18, '1519975369.jpg', 0, '2018-03-02 07:23:52', '2018-03-02 07:23:52'),
(13, 'DÂY CHUYỀN PNJ VÀNG 18K', 'Dây chuyền, chất liệu vàng 18K, dây công vuông 9C .', '12989', 15, '1519975511.jpg', 0, '2018-03-02 07:26:19', '2018-03-02 07:26:19'),
(14, 'Apple Ipad Mini 32 Gb Wifi + 3G', 'A beautiful display, powerful A5 chip, FaceTime HD camera, iSight camera with 1080p HD video recording, ultrafast wireless, and over 275,000 apps ready to download from the App Store.\r\n\r\niPad mini is an iPad in every way, shape, and slightly smaller form.', '1468', 13, '1519975662.jpg', 0, '2018-03-02 07:28:22', '2018-03-02 07:28:22'),
(15, 'SMART TIVI LG 65 INCH 65UJ632T, 4K HDR', NULL, '4505', 2, '1519975781.png', 0, '2018-03-02 07:30:27', '2018-03-02 07:30:27'),
(16, 'Vision 2018', NULL, '11999', 7, '1519978184.JPG', 0, '2018-03-02 08:10:56', '2018-03-02 08:10:56'),
(17, 'Gift name -1', '323', '3', 12, '1519982556.jpg', 1, '2018-03-02 09:22:46', '2018-03-02 09:24:07'),
(18, 'Nha Trang', 'Voucher for 3 days 2 nights', '0', 18, '1530628021.png', 0, '2018-03-25 12:23:27', '2018-07-03 14:27:01');

-- --------------------------------------------------------

--
-- Table structure for table `leadprocesses`
--

CREATE TABLE `leadprocesses` (
  `id` int(10) UNSIGNED NOT NULL,
  `lead_id` int(10) UNSIGNED NOT NULL,
  `status_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leadprocesses`
--

INSERT INTO `leadprocesses` (`id`, `lead_id`, `status_id`, `created_at`, `updated_at`) VALUES
(17, 11, 3, '2018-02-01 11:54:04', '2018-02-01 11:54:04'),
(18, 15, 3, '2018-02-06 13:32:14', '2018-02-06 13:32:14'),
(19, 14, 1, '2018-02-08 03:38:21', '2018-02-08 03:38:21'),
(20, 13, 2, '2018-02-08 03:38:32', '2018-02-08 03:38:32'),
(21, 10, 4, '2018-02-08 03:40:52', '2018-02-08 03:40:52'),
(22, 18, 1, '2018-02-08 03:49:12', '2018-02-08 03:49:12'),
(23, 18, 2, '2018-02-08 03:49:15', '2018-02-08 03:49:15'),
(24, 18, 3, '2018-02-08 03:49:18', '2018-02-08 03:49:18'),
(25, 9, 1, '2018-02-08 03:50:05', '2018-02-08 03:50:05'),
(26, 9, 2, '2018-02-08 03:50:13', '2018-02-08 03:50:13'),
(27, 9, 4, '2018-02-08 03:50:16', '2018-02-08 03:50:16'),
(28, 22, 1, '2018-02-08 03:54:26', '2018-02-08 03:54:26'),
(29, 21, 1, '2018-02-08 03:54:39', '2018-02-08 03:54:39'),
(30, 21, 2, '2018-02-08 03:54:42', '2018-02-08 03:54:42'),
(31, 20, 1, '2018-02-08 03:54:52', '2018-02-08 03:54:52'),
(32, 20, 2, '2018-02-08 03:54:55', '2018-02-08 03:54:55'),
(33, 20, 3, '2018-02-08 03:54:59', '2018-02-08 03:54:59'),
(34, 19, 1, '2018-02-08 03:55:08', '2018-02-08 03:55:08'),
(35, 19, 2, '2018-02-08 03:55:12', '2018-02-08 03:55:12'),
(36, 19, 4, '2018-02-08 03:55:14', '2018-02-08 03:55:14'),
(37, 25, 1, '2018-02-08 04:40:26', '2018-02-08 04:40:26'),
(38, 25, 2, '2018-02-08 04:40:30', '2018-02-08 04:40:30'),
(39, 25, 3, '2018-02-08 04:40:33', '2018-02-08 04:40:33'),
(40, 33, 2, '2018-02-08 11:25:58', '2018-02-08 11:25:58'),
(41, 32, 1, '2018-02-08 11:26:22', '2018-02-08 11:26:22'),
(42, 36, 3, '2018-03-02 09:03:43', '2018-03-02 09:03:43'),
(43, 36, 1, '2018-03-06 02:03:58', '2018-03-06 02:03:58'),
(44, 36, 4, '2018-03-07 08:16:32', '2018-03-07 08:16:32'),
(45, 32, 2, '2018-03-07 08:20:37', '2018-03-07 08:20:37'),
(46, 31, 1, '2018-03-12 12:14:03', '2018-03-12 12:14:03'),
(47, 30, 1, '2018-03-13 11:18:00', '2018-03-13 11:18:00'),
(48, 29, 2, '2018-03-13 11:54:22', '2018-03-13 11:54:22'),
(49, 28, 1, '2018-03-14 11:25:51', '2018-03-14 11:25:51'),
(50, 27, 1, '2018-03-14 11:27:34', '2018-03-14 11:27:34'),
(51, 32, 3, '2018-03-15 02:20:52', '2018-03-15 02:20:52'),
(52, 37, 3, '2018-03-23 03:22:47', '2018-03-23 03:22:47'),
(53, 31, 2, '2018-03-26 11:20:28', '2018-03-26 11:20:28'),
(54, 38, 1, '2018-04-26 08:05:42', '2018-04-26 08:05:42'),
(55, 38, 2, '2018-04-26 08:05:56', '2018-04-26 08:05:56'),
(56, 40, 3, '2018-05-24 02:41:51', '2018-05-24 02:41:51'),
(57, 39, 2, '2018-06-17 05:55:07', '2018-06-17 05:55:07');

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `birthday` date DEFAULT '1900-01-01',
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `tipster_id` int(10) UNSIGNED NOT NULL,
  `region_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `fullname`, `gender`, `birthday`, `address`, `email`, `phone`, `notes`, `product_id`, `status`, `tipster_id`, `region_id`, `created_at`, `updated_at`) VALUES
(6, 'Lead 1', 0, NULL, NULL, 'lead1@gmail.com', '09038213123', 'New CEO of XZY company.\r\nAlso interested by a car insurance. \r\nPlease contact ASAP', 4, 0, 2, 2, '2018-01-23 12:26:11', '2018-01-31 03:32:22'),
(7, 'Philippe ROBERT', 0, NULL, NULL, NULL, '197870909', NULL, 4, 0, 2, 1, '2018-01-26 04:08:24', '2018-01-31 11:59:48'),
(9, 'Mathieu Lindeman', 0, NULL, NULL, 'mathieu@gmail.com', NULL, 'Urgent!!!', 4, 4, 2, 2, '2018-01-30 07:30:59', '2018-02-08 03:50:16'),
(10, 'Duc Nguon', 0, NULL, NULL, 'duc.nguon@amagumolabs.com', NULL, 'URGENT CONTACT ASAP', 4, 4, 2, 2, '2018-01-31 12:19:39', '2018-02-08 03:40:52'),
(11, 'Binh Minh NGUYEN', 0, NULL, NULL, 'minh@amagumolabs.com', NULL, NULL, 4, 3, 3, 2, '2018-01-31 12:20:20', '2018-02-01 11:54:04'),
(12, 'Jean-David Silberzan', 0, NULL, NULL, 'jd@email.com', NULL, NULL, 4, 0, 4, 2, '2018-02-06 02:33:30', '2018-02-06 02:33:30'),
(13, 'Thuy', 0, NULL, NULL, 'thuy@email.com', NULL, NULL, 4, 2, 4, 2, '2018-02-06 02:35:33', '2018-02-08 03:38:32'),
(14, 'Bùi Tiến Dũng', 0, NULL, NULL, NULL, '0983987613', NULL, 5, 1, 3, 2, '2018-02-06 12:56:06', '2018-02-08 03:38:21'),
(15, 'Trần Quang Khải', 0, NULL, NULL, 'khaiquang@gmail.com', '0938786323', NULL, 10, 3, 4, 1, '2018-02-06 13:23:05', '2018-02-06 13:32:14'),
(16, 'Đào Duy Từ', 0, NULL, NULL, 'tuduy@gmail.com', '098765872', NULL, 9, 0, 10, 1, '2018-02-06 13:24:25', '2018-02-06 13:24:25'),
(18, 'Phạm Trần Nhật Kỳ', 0, NULL, NULL, 'nhatky@gmail.com', '09876621345', NULL, 10, 3, 11, 2, '2018-02-08 03:49:00', '2018-02-08 03:49:18'),
(19, 'Võ Thị Thanh Nhàn', 0, NULL, NULL, 'nhanvo@gmail.com', '0988783617', NULL, 6, 4, 4, 2, '2018-02-08 03:52:15', '2018-02-08 03:55:14'),
(20, 'Bùi Tuấn Khương', 0, NULL, NULL, NULL, 'khuongbui@gmail.com', NULL, 7, 3, 4, 2, '2018-02-08 03:52:46', '2018-02-08 03:54:59'),
(21, 'Phí Ngọc Hưng', 0, NULL, NULL, 'ngochung@gmail.com', NULL, NULL, 5, 2, 4, 2, '2018-02-08 03:53:48', '2018-02-08 03:54:42'),
(22, 'Phùng Văn Trung', 0, NULL, NULL, NULL, '0987762345', NULL, 8, 1, 4, 2, '2018-02-08 03:54:15', '2018-02-08 03:54:26'),
(23, 'Trần Thanh Duy', 0, NULL, NULL, NULL, '093787662', NULL, 11, 0, 2, 2, '2018-02-08 04:35:52', '2018-02-08 04:35:52'),
(24, 'Hồ Ngọc Hà', 1, NULL, NULL, 'hangocho@gmail.com', NULL, NULL, 10, 0, 3, 2, '2018-02-08 04:37:02', '2018-02-08 04:37:02'),
(25, 'Cường Seven', 0, NULL, NULL, 'cuong7@gmail.com', NULL, NULL, 5, 3, 3, 2, '2018-02-08 04:37:42', '2018-02-08 04:40:33'),
(26, 'Nguyễn Minh Nhật', 0, NULL, NULL, 'nguyenminhnhat@gmail.com', '0165965487', 'Call him in today', 8, 0, 13, 2, '2018-02-08 08:26:52', '2018-03-01 04:42:25'),
(27, 'Đoàn Thị Ngọc Thắm', 1, NULL, NULL, 'ngoctham1990@gmail.com', '0985866123', 'Đoàn Thị Ngọc Thắm là một khác hàng tiềm năng', 11, 1, 13, 2, '2018-02-08 08:27:43', '2018-03-14 11:27:34'),
(28, 'Trần Công Tâm', 0, NULL, NULL, 'trangcongtam@yahoo.com', '0986123233', 'Trần Công Tâm là khách hàng mới', 6, 1, 13, 2, '2018-02-08 08:28:56', '2018-03-14 11:25:51'),
(29, 'Lâm Tâm Như', 1, NULL, NULL, 'lamtamnhu@gmail.com', '09873222323', 'Lâm Tâm Như là khách hàng nước ngoài', 12, 2, 13, 4, '2018-02-08 08:30:49', '2018-03-13 11:54:22'),
(30, 'Phạm Thị Kim Ngọc', 1, NULL, NULL, 'phamthikimngoc@gmail.com', '098612343', 'Phạm Kim Ngọc là khách hàng rất có tìm năng', 8, 1, 3, 3, '2018-02-08 08:39:16', '2018-03-13 11:18:00'),
(31, 'Trần Thanh Tâm', 0, NULL, NULL, 'tranthanhtam@gmail.com', '01659878232', 'Trần Thanh Tâm', 9, 2, 19, 3, '2018-02-08 08:39:47', '2018-03-26 11:20:28'),
(32, 'Nguyễn Minh Đạt', 0, NULL, NULL, 'nguyenminhdat@gmail.com', '098651233233', 'Nguyễn Minh Đạt là khách hàng mới', 4, 3, 3, 1, '2018-02-08 08:41:43', '2018-03-15 02:20:52'),
(36, 'Robert Redford', 0, NULL, NULL, 'anhchanglangtu_1232000@yahoo.com', '01659655963', 'Office located in Vo Van Tan\r\ntest of long nguyen', 7, 4, 13, 4, '2018-03-02 09:03:07', '2018-04-12 09:04:38'),
(37, 'toto - long', 0, NULL, NULL, 'longca2004us@yahoo.com - long', '1234567890 - long', 'need to call asap (23/3/2018) - lomg', 10, 3, 22, 2, '2018-03-23 02:27:19', '2018-06-16 08:22:26'),
(38, 'Dinh Van', 0, NULL, NULL, NULL, '190790790709', 'TEST PHILIPPE', 4, 2, 3, 2, '2018-04-26 08:05:15', '2018-04-26 08:05:56'),
(39, 'sdfsdf long 2', 0, NULL, NULL, 'sdfsfd@gmail.com', 'sdfsdfsdfs', NULL, 5, 2, 2, 2, '2018-05-16 06:25:37', '2018-06-17 05:55:07'),
(40, 'sdfsdf123', 0, NULL, NULL, 'sdfsfd123', 'sdfsdfsdfs123', 'admin test', 6, 3, 15, 3, '2018-05-16 06:25:52', '2018-06-16 00:58:51'),
(47, 'Nguyen Thanh Hãi', 0, NULL, NULL, 'phuongchi_300@yahoo.com.vn', '090950415890xxxx', 'Test', 5, 0, 23, 2, '2018-06-27 06:48:51', '2018-06-27 06:48:51'),
(49, 'Nguyen Thanh Hãi', 0, NULL, NULL, 'phuongchi_400@yahoo.com.vn', '09095041589111111111', 'Test', 5, 0, 23, 2, '2018-06-27 07:17:16', '2018-06-27 07:17:16'),
(50, 'Nguyen Thanh Hãi', 0, NULL, NULL, 'phuongchi_399@yahoo.com.vn', '01234567890123456789', NULL, 4, 0, 2, 2, '2018-06-27 07:41:45', '2018-06-27 07:41:45'),
(51, 'Nuyễn T. Hải', 0, NULL, NULL, 'phuongchi_590@yahoo.com.vn 12345', '01234567890123456789', 'test', 8, 0, 2, 2, '2018-06-27 08:17:05', '2018-06-28 03:51:16'),
(52, 'anh ABC', 0, NULL, NULL, 'longca5004us@yahoo.com 123456', '01234567890123456789 aaaa', 'test 16/7/2018', 5, 0, 22, 2, '2018-07-16 05:54:09', '2018-07-16 05:54:09');

-- --------------------------------------------------------

--
-- Table structure for table `logs_sent_message_templates`
--

CREATE TABLE `logs_sent_message_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `sender_id` int(10) UNSIGNED DEFAULT NULL,
  `receiver_id` int(10) UNSIGNED DEFAULT NULL,
  `message_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs_sent_message_templates`
--

INSERT INTO `logs_sent_message_templates` (`id`, `sender_id`, `receiver_id`, `message_id`, `subject`, `content`, `created_at`, `updated_at`) VALUES
(1, 0, 13, 'update_lead_call', 'E-mail Thông báo về trạng thái của lead', '<p>Xin chào Phạm Ánh Chiến,</p><p>Lead Đoàn Thị Ngọc Thắm của bạn đã được tư vấn viên gọi để tư vấn.</p><p>Cảm ơn và trân trọng.</p>', '2018-03-14 11:27:34', '2018-03-14 11:27:34'),
(2, 0, 3, 'update_lead_win', 'Congratulatory letter', '<p>Hello Philippe NGUYEN,</p><p>Your lead Nguyễn Minh Đạt has been changed status to \"WIN\".</p><p>You has been received [points] points.</p><p>Thank you and best regards.</p>', '2018-03-15 02:20:52', '2018-03-15 02:20:52'),
(3, 0, 3, 'plus_points_tipster', 'Notification about bonus points', '<p>Hello Philippe NGUYEN,</p><p>Congratulations you have received <b>150</b> points from the introduction<b> Nguyễn Minh Đạt</b> for product Medical.</p><p>Your current points: <b>310</b></p><p>Thank you and best reagards.</p>', '2018-03-15 02:21:10', '2018-03-15 02:21:10'),
(4, 0, 21, 'thank_you_letter', 'Thư cảm ơn', '<p>Xin chào Hoang Nguyen,</p><p>Lead \"toto\" đã được tiếp nhận bởi bộ phận tư vấn viên của chúng tôi.</p><p>Cảm ơn sự hỗ trợ của bạn và chúc bạn nhận được nhiều điểm thưởng.</p><p><br></p>', '2018-03-23 02:27:19', '2018-03-23 02:27:19'),
(5, 0, 21, 'update_lead_win', 'Thư chúc mừng', '<p>Xin chào Hoang Nguyen,</p><p>Lead toto đã được chuyển đến trạng thái \"THÀNH CÔNG\".</p><p>Chúc mừng bạn đã nhận được [points] points.</p><p>Cảm ơn và trân trọng</p>', '2018-03-23 03:22:47', '2018-03-23 03:22:47'),
(6, 0, 21, 'plus_points_tipster', 'Thông báo về điểm thưởng', '<p>Xin chào Hoang Nguyen,</p><p>Chúc mừng bạn đã nhận được <b>1</b> điểm từ việc giới thiệu lead <b>toto</b> với sản phẩm Auto/Moto.</p><p>Điểm hiện tại của bạn là: <b>1 </b>points.<b></b></p><p>Cảm ơn và trân trọng.</p>', '2018-03-23 21:33:55', '2018-03-23 21:33:55'),
(7, 0, 21, 'update_points_tipster', 'Thông báo về cập nhật điểm thưởng', '<p>Xin chào Hoang Nguyen,</p><p>\r\n\r\nXin lỗi điểm thưởng cho lead toto với sản phẩm Auto/Moto đã được thay đổi.<br>Bạn nhận được 2 điểm.</p><p>Điểm hiện tại của bạn là: 2 điểm.</p><p>Cảm ơn và trân trọng.</p><p>(Nếu bạn có bất kỳ thắc mắc nào, vui lòng liên hệ với Admin)</p>', '2018-03-23 21:34:52', '2018-03-23 21:34:52'),
(8, 0, 19, 'update_lead_quote', 'E-mail thông báo về trạng thái của lead', '<p>\r\n\r\n</p><p>Xin chào Pham Thi Dang Thuy Lead,</p><p>Lead Trần Thanh Tâm của bạn đã được chuyển&nbsp;đến&nbsp;trạng thái \"Báo Giá\".</p><p>Cảm ơn và trân trọng.</p>\r\n\r\n<br><p></p>', '2018-03-26 11:20:28', '2018-03-26 11:20:28'),
(9, 0, 3, 'thank_you_letter', 'Thank you letter', '<p>Hello Philippe NGUYEN,</p><p>The Lead Dinh Van has been received by the consultant.</p><p>Thank you for your support and wish you get more point bonus.</p>', '2018-04-26 08:05:15', '2018-04-26 08:05:15'),
(10, 0, 3, 'update_lead_call', 'Notification e-mail about Lead status', '<p>Hello Philippe NGUYEN,</p><p>Your Lead Dinh Van has been called by consultant.</p><p>Thank you and best regards.</p>', '2018-04-26 08:05:42', '2018-04-26 08:05:42'),
(11, 0, 3, 'update_lead_quote', 'Notification e-mail about lead status', '<p>\r\n\r\n</p><p>Hello Philippe NGUYEN,</p><p>Your Lead Dinh Van has been quote by consultant.</p><p>Thank you and best regards.</p><p></p>', '2018-04-26 08:05:56', '2018-04-26 08:05:56'),
(12, 0, 2, 'thank_you_letter', 'Thư cảm ơn', '<p>Xin chào Nguyễn Thị Nhật Hạ,</p><p>Lead \"sdfsdf\" đã được tiếp nhận bởi bộ phận tư vấn viên của chúng tôi.</p><p>Cảm ơn sự hỗ trợ của bạn và chúc bạn nhận được nhiều điểm thưởng.</p><p><br></p>', '2018-05-16 06:25:37', '2018-05-16 06:25:37'),
(13, 0, 2, 'thank_you_letter', 'Thư cảm ơn', '<p>Xin chào Nguyễn Thị Nhật Hạ,</p><p>Lead \"sdfsdf\" đã được tiếp nhận bởi bộ phận tư vấn viên của chúng tôi.</p><p>Cảm ơn sự hỗ trợ của bạn và chúc bạn nhận được nhiều điểm thưởng.</p><p><br></p>', '2018-05-16 06:25:52', '2018-05-16 06:25:52'),
(14, 0, 2, 'update_lead_win', 'Thư chúc mừng', '<p>Xin chào Nguyễn Thị Nhật Hạ,</p><p>Lead sdfsdf đã được chuyển đến trạng thái \"THÀNH CÔNG\".</p><p>Chúc mừng bạn đã nhận được [points] points.</p><p>Cảm ơn và trân trọng</p>', '2018-05-24 02:41:51', '2018-05-24 02:41:51'),
(15, 0, 15, 'plus_points_tipster', 'Thông báo về điểm thưởng', '<p>Xin chào Trần Cao Vân,</p><p>Chúc mừng bạn đã nhận được <b>1</b> điểm từ việc giới thiệu lead <b>sdfsdf</b> với sản phẩm Auto/Moto.</p><p>Điểm hiện tại của bạn là: <b>1 </b>points.<b></b></p><p>Cảm ơn và trân trọng.</p>', '2018-05-24 10:29:39', '2018-05-24 10:29:39'),
(16, 0, 15, 'update_points_tipster', 'Thông báo về cập nhật điểm thưởng', '<p>Xin chào Trần Cao Vân,</p><p>\r\n\r\nXin lỗi điểm thưởng cho lead sdfsdf với sản phẩm Auto/Moto đã được thay đổi.<br>Bạn nhận được 1 điểm.</p><p>Điểm hiện tại của bạn là: 1 điểm.</p><p>Cảm ơn và trân trọng.</p><p>(Nếu bạn có bất kỳ thắc mắc nào, vui lòng liên hệ với Admin)</p>', '2018-05-24 10:31:24', '2018-05-24 10:31:24'),
(17, 0, 15, 'update_points_tipster', 'Thông báo về cập nhật điểm thưởng', '<p>Xin chào Trần Cao Vân,</p><p>\r\n\r\nXin lỗi điểm thưởng cho lead sdfsdf với sản phẩm Auto/Moto đã được thay đổi.<br>Bạn nhận được {\"id\":10,\"tipster_id\":15,\"lead_id\":40,\"point\":0,\"activity\":null,\"comment\":null,\"created_at\":\"2018-05-24 10:29:39\",\"updated_at\":\"2018-05-24 10:31:49\"} điểm.</p><p>Điểm hiện tại của bạn là: 0 điểm.</p><p>Cảm ơn và trân trọng.</p><p>(Nếu bạn có bất kỳ thắc mắc nào, vui lòng liên hệ với Admin)</p>', '2018-05-24 10:31:49', '2018-05-24 10:31:49'),
(18, 0, 2, 'update_lead_quote', 'E-mail thông báo về trạng thái của lead', '<p>\r\n\r\n</p><p>Xin chào Nguyễn Thị Nhật Hạ,</p><p>Lead sdfsdf long 2 của bạn đã được chuyển&nbsp;đến&nbsp;trạng thái \"Báo Giá\".</p><p>Cảm ơn và trân trọng.</p>\r\n\r\n<br><p></p>', '2018-06-17 05:55:07', '2018-06-17 05:55:07'),
(19, 0, 2, 'thank_you_letter', 'Thư cảm ơn', '<p>Xin chào Nguyễn Thị Nhật Hạ,</p><p>Lead \"sdfsdf123\" đã được tiếp nhận bởi bộ phận tư vấn viên của chúng tôi.</p><p>Cảm ơn sự hỗ trợ của bạn và chúc bạn nhận được nhiều điểm thưởng.</p><p><br></p>', '2018-06-19 02:09:33', '2018-06-19 02:09:33'),
(20, 0, 23, 'thank_you_letter', 'Thư cảm ơn', '<p>Xin chào Long Nguyen,</p><p>Lead \"Nguyen Thanh Hãi\" đã được tiếp nhận bởi bộ phận tư vấn viên của chúng tôi.</p><p>Cảm ơn sự hỗ trợ của bạn và chúc bạn nhận được nhiều điểm thưởng.</p><p><br></p>', '2018-06-27 06:39:09', '2018-06-27 06:39:09'),
(21, 0, 23, 'thank_you_letter', 'Thư cảm ơn', '<p>Xin chào Long Nguyen,</p><p>Lead \"Nguyen Thanh Hãi\" đã được tiếp nhận bởi bộ phận tư vấn viên của chúng tôi.</p><p>Cảm ơn sự hỗ trợ của bạn và chúc bạn nhận được nhiều điểm thưởng.</p><p><br></p>', '2018-06-27 06:48:51', '2018-06-27 06:48:51'),
(22, 0, 23, 'thank_you_letter', 'Thư cảm ơn', '<p>Xin chào Long Nguyen,</p><p>Lead \"Nguyen Thanh Hãi\" đã được tiếp nhận bởi bộ phận tư vấn viên của chúng tôi.</p><p>Cảm ơn sự hỗ trợ của bạn và chúc bạn nhận được nhiều điểm thưởng.</p><p><br></p>', '2018-06-27 07:17:16', '2018-06-27 07:17:16'),
(23, 0, 2, 'thank_you_letter', 'Thư cảm ơn', '<p>Xin chào Nguyễn Thị Nhật Hạ,</p><p>Lead \"Nguyen Thanh Hãi\" đã được tiếp nhận bởi bộ phận tư vấn viên của chúng tôi.</p><p>Cảm ơn sự hỗ trợ của bạn và chúc bạn nhận được nhiều điểm thưởng.</p><p><br></p>', '2018-06-27 07:41:45', '2018-06-27 07:41:45'),
(24, 0, 2, 'thank_you_letter', 'Thư cảm ơn', '<p>Xin chào Nguyễn Thị Nhật Hạ,</p><p>Lead \"Nuyễn T. Hải\" đã được tiếp nhận bởi bộ phận tư vấn viên của chúng tôi.</p><p>Cảm ơn sự hỗ trợ của bạn và chúc bạn nhận được nhiều điểm thưởng.</p><p><br></p>', '2018-06-27 08:17:05', '2018-06-27 08:17:05'),
(25, 0, 22, 'thank_you_letter', 'Thư cảm ơn', '<p>Xin chào Long Nguyen,</p><p>Lead \"anh ABC\" đã được tiếp nhận bởi bộ phận tư vấn viên của chúng tôi.</p><p>Cảm ơn sự hỗ trợ của bạn và chúc bạn nhận được nhiều điểm thưởng.</p><p><br></p>', '2018-07-16 05:54:09', '2018-07-16 05:54:09');

-- --------------------------------------------------------

--
-- Table structure for table `log_activities`
--

CREATE TABLE `log_activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `affected_object` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `action` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_activities`
--

INSERT INTO `log_activities` (`id`, `user_id`, `affected_object`, `action`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Lead', 'Created', 'Created Lead : Trần Quang Khải', '2018-02-06 13:23:05', '2018-02-06 13:23:05'),
(2, 10, 'Lead', 'Created', 'Created Lead : Đào Duy Từ', '2018-02-06 13:24:25', '2018-02-06 13:24:25'),
(3, 1, 'Tipster', 'Created', 'Created Tipster : Nguyễn Minh Hùng', '2018-02-06 13:27:11', '2018-02-06 13:27:11'),
(7, 1, 'Lead', 'Created', 'Created Lead : Nguyễn Minh Hùng', '2018-02-08 03:44:41', '2018-02-08 03:44:41'),
(8, 1, 'Lead', 'Created', 'Created Lead : Phạm Trần Nhật Kỳ', '2018-02-08 03:49:00', '2018-02-08 03:49:00'),
(9, 1, 'Lead', 'Update points', 'Update points Lead : Lead', '2018-02-08 03:49:29', '2018-02-08 03:49:29'),
(10, 1, 'Lead', 'Created', 'Created Lead : Võ Thị Thanh Nhàn', '2018-02-08 03:52:15', '2018-02-08 03:52:15'),
(11, 1, 'Lead', 'Created', 'Created Lead : Bùi Tuấn Khương', '2018-02-08 03:52:46', '2018-02-08 03:52:46'),
(12, 1, 'Lead', 'Created', 'Created Lead : Phí Ngọc Hưng', '2018-02-08 03:53:48', '2018-02-08 03:53:48'),
(13, 1, 'Lead', 'Created', 'Created Lead : Phùng Văn Trung', '2018-02-08 03:54:15', '2018-02-08 03:54:15'),
(14, 3, 'Lead', 'Created', 'Created Lead : Trần Thanh Duy', '2018-02-08 04:35:52', '2018-02-08 04:35:52'),
(15, 3, 'Lead', 'Created', 'Created Lead : Hồ Ngọc Hà', '2018-02-08 04:37:02', '2018-02-08 04:37:02'),
(16, 3, 'Lead', 'Created', 'Created Lead : Cường Seven', '2018-02-08 04:37:42', '2018-02-08 04:37:42'),
(17, 6, 'Lead', 'Update points', 'Update points of Tipster : tipster3', '2018-02-08 04:40:39', '2018-02-08 04:40:39'),
(18, 1, 'Tipster', 'Created', 'Created Tipster : Lương Gia Hân', '2018-02-08 08:13:59', '2018-02-08 08:13:59'),
(19, 9, 'Tipster', 'Created', 'Created Tipster : Phạm Ánh Chiến', '2018-02-08 08:18:49', '2018-02-08 08:18:49'),
(20, 9, 'Tipster', 'Created', 'Created Tipster : Tạ Hoàng Phương Trung', '2018-02-08 08:24:13', '2018-02-08 08:24:13'),
(21, 13, 'Lead', 'Created', 'Created Lead : Nguyễn Minh Nhật', '2018-02-08 08:26:52', '2018-02-08 08:26:52'),
(22, 13, 'Lead', 'Created', 'Created Lead : Đoàn Thị Ngọc Thắm', '2018-02-08 08:27:43', '2018-02-08 08:27:43'),
(23, 9, 'Tipster', 'Created', 'Created Tipster : Trần Cao Vân', '2018-02-08 08:27:59', '2018-02-08 08:27:59'),
(24, 13, 'Lead', 'Created', 'Created Lead : Trần Công Tâm', '2018-02-08 08:28:18', '2018-02-08 08:28:18'),
(25, 13, 'Lead', 'Created', 'Created Lead : Trần Công Tâm', '2018-02-08 08:28:56', '2018-02-08 08:28:56'),
(26, 13, 'Lead', 'Created', 'Created Lead : Lâm Tâm Như', '2018-02-08 08:30:49', '2018-02-08 08:30:49'),
(27, 3, 'Lead', 'Created', 'Created Lead : Phạm Thị Kim Ngọc', '2018-02-08 08:39:16', '2018-02-08 08:39:16'),
(28, 3, 'Lead', 'Created', 'Created Lead : Trần Thanh Tâm', '2018-02-08 08:39:47', '2018-02-08 08:39:47'),
(29, 3, 'Lead', 'Created', 'Created Lead : Nguyễn Minh Đạt', '2018-02-08 08:41:43', '2018-02-08 08:41:43'),
(30, 3, 'Lead', 'Created', 'Created Lead : Phạm Phú Toàn', '2018-02-08 08:43:00', '2018-02-08 08:43:00'),
(31, 3, 'Lead', 'Created', 'Created Lead : Đinh Ngọc Diệp', '2018-02-08 08:43:34', '2018-02-08 08:43:34'),
(32, 1, 'Tipster', 'update', 'update Tipster : Trần Cao Vân', '2018-02-09 12:31:39', '2018-02-09 12:31:39'),
(33, 1, 'Community Manager', 'update', 'update Community Manager : Admin', '2018-02-13 09:52:17', '2018-02-13 09:52:17'),
(34, 1, 'Gift', 'update', 'update Gift : Quà tặng trải nghiệm đặc biệt - Sensesclub Crystal', '2018-02-13 09:52:42', '2018-02-13 09:52:42'),
(35, 1, 'Lead', 'delete', 'delete Lead : Phạm Phú Toàn', '2018-02-26 23:58:28', '2018-02-26 23:58:28'),
(37, 1, 'Tipster', 'created', 'created Tipster : Marion Nguyen', '2018-02-27 01:43:16', '2018-02-27 01:43:16'),
(38, 1, 'Tipster', 'update', 'update Tipster : Trần Cao Vân', '2018-02-27 02:34:10', '2018-02-27 02:34:10'),
(39, 1, 'Gift', 'update', 'update Gift : Food Boxes Lock and Lock', '2018-02-27 02:35:53', '2018-02-27 02:35:53'),
(40, 1, 'Product', 'delete', 'delete Product : Medical', '2018-03-01 02:45:23', '2018-03-01 02:45:23'),
(41, 1, 'Product', 'created', 'created Product : Medical', '2018-03-01 02:46:42', '2018-03-01 02:46:42'),
(42, 1, 'Product', 'delete', 'delete Product : Other', '2018-03-01 02:49:48', '2018-03-01 02:49:48'),
(43, 1, 'Product', 'created', 'created Product : Other', '2018-03-01 04:40:35', '2018-03-01 04:40:35'),
(44, 1, 'Lead', 'update', 'update Lead : Nguyễn Minh Nhật', '2018-03-01 04:42:25', '2018-03-01 04:42:25'),
(45, 1, 'Product', 'update', 'update Product : Auto/Moto', '2018-03-01 04:44:33', '2018-03-01 04:44:33'),
(46, 1, 'Product', 'update', 'update Product : Medical', '2018-03-01 04:45:38', '2018-03-01 04:45:38'),
(47, 1, 'Product', 'update', 'update Product : Shops', '2018-03-01 04:46:46', '2018-03-01 04:46:46'),
(48, 1, 'Lead', 'delete', 'delete Lead : Đinh Ngọc Diệp', '2018-03-01 10:14:02', '2018-03-01 10:14:02'),
(49, 1, 'Tipster', 'created', 'created Tipster : Philippe Nguyen', '2018-03-01 10:16:26', '2018-03-01 10:16:26'),
(50, 1, 'Lead', 'update', 'update Lead : Nguyễn Minh Đạt', '2018-03-02 06:49:21', '2018-03-02 06:49:21'),
(51, 1, 'Gift', 'created', 'created Gift : 10.5-inch iPad Pro Wi-Fi 64GB - Rose Gold - Apple', '2018-03-02 07:01:02', '2018-03-02 07:01:02'),
(52, 1, 'Gift', 'created', 'created Gift : iPhone X 256GB', '2018-03-02 07:08:39', '2018-03-02 07:08:39'),
(53, 1, 'Gift', 'update', 'update Gift : Food Boxes Lock and Lock', '2018-03-02 07:10:24', '2018-03-02 07:10:24'),
(54, 1, 'Gift', 'update', 'update Gift : Quà tặng trải nghiệm đặc biệt - Sensesclub Crystal', '2018-03-02 07:12:03', '2018-03-02 07:12:03'),
(55, 1, 'Gift', 'created', 'created Gift : Samsung Galaxy J8 2018', '2018-03-02 07:15:14', '2018-03-02 07:15:14'),
(56, 1, 'Gift', 'created', 'created Gift : Samsung RSA1STSL Side-By-Side Fridge 550L', '2018-03-02 07:17:42', '2018-03-02 07:17:42'),
(57, 1, 'Gift', 'update', 'update Gift : Samsung RSA1STSL Side-By-Side Fridge 550L', '2018-03-02 07:18:02', '2018-03-02 07:18:02'),
(58, 1, 'Gift', 'created', 'created Gift : LG TONE PRO wireless Bluetooth headset (HBS-760)', '2018-03-02 07:20:42', '2018-03-02 07:20:42'),
(59, 1, 'Gift', 'created', 'created Gift : Bangkok-Pattaya - Khách sạn 3* Tặng vé xem Nanta show', '2018-03-02 07:23:52', '2018-03-02 07:23:52'),
(60, 1, 'Gift', 'created', 'created Gift : DÂY CHUYỀN PNJ VÀNG 18K', '2018-03-02 07:26:19', '2018-03-02 07:26:19'),
(61, 1, 'Gift', 'created', 'created Gift : Apple Ipad Mini 32 Gb Wifi + 3G', '2018-03-02 07:28:22', '2018-03-02 07:28:22'),
(62, 1, 'Gift', 'created', 'created Gift : SMART TIVI LG 65 INCH 65UJ632T, 4K HDR', '2018-03-02 07:30:27', '2018-03-02 07:30:27'),
(63, 1, 'Gift', 'created', 'created Gift : Vision 2018', '2018-03-02 08:10:56', '2018-03-02 08:10:56'),
(64, 1, 'Community Manager', 'update', 'update Community Manager : Admin', '2018-03-02 08:16:38', '2018-03-02 08:16:38'),
(65, 1, 'Product', 'update', 'update Product : Factory', '2018-03-02 08:43:05', '2018-03-02 08:43:05'),
(66, 1, 'Product', 'update', 'update Product : Office', '2018-03-02 08:43:53', '2018-03-02 08:43:53'),
(67, 1, 'Product', 'update', 'update Product : Home', '2018-03-02 08:44:40', '2018-03-02 08:44:40'),
(68, 1, 'Product', 'update', 'update Product : Travel', '2018-03-02 08:45:37', '2018-03-02 08:45:37'),
(69, 1, 'Product', 'update', 'update Product : Student', '2018-03-02 08:46:29', '2018-03-02 08:46:29'),
(70, 1, 'Lead', 'created', 'created Lead : Lead 01', '2018-03-02 09:02:48', '2018-03-02 09:02:48'),
(71, 1, 'Lead', 'created', 'created Lead : Lead 02', '2018-03-02 09:03:07', '2018-03-02 09:03:07'),
(72, 1, 'Lead', 'update', 'update Lead : Lead 02', '2018-03-02 09:03:24', '2018-03-02 09:03:24'),
(73, 1, 'Lead', 'update', 'update Lead', '2018-03-02 09:03:43', '2018-03-02 09:03:43'),
(74, 1, 'Tipster', 'update points for', 'update points for Tipster : Nguyễn Minh Hùng', '2018-03-02 09:03:48', '2018-03-02 09:03:48'),
(75, 1, 'Tipster', 'update points for', 'update points for Tipster : Phạm Ánh Chiến', '2018-03-02 09:04:08', '2018-03-02 09:04:08'),
(76, 1, 'Lead', 'update', 'update Lead : Lead 02', '2018-03-02 09:04:27', '2018-03-02 09:04:27'),
(77, 1, 'Lead', 'delete', 'delete Lead : Lead 01', '2018-03-02 09:04:55', '2018-03-02 09:04:55'),
(78, 1, 'Tipster', 'created', 'created Tipster : PHAM PHU CHINH', '2018-03-02 09:06:53', '2018-03-02 09:06:53'),
(79, 1, 'Tipster', 'created', 'created Tipster : PHAM PHU CHINH', '2018-03-02 09:07:56', '2018-03-02 09:07:56'),
(80, 1, 'Tipster', 'created', 'created Tipster : PHAM PHU CHINH', '2018-03-02 09:08:42', '2018-03-02 09:08:42'),
(81, 1, 'Tipster', 'update', 'update Tipster : Phạm Phú Chinh', '2018-03-02 09:09:30', '2018-03-02 09:09:30'),
(82, 1, 'Tipster', 'delete', 'delete Tipster : Phạm Phú Chinh', '2018-03-02 09:09:59', '2018-03-02 09:09:59'),
(83, 1, 'Tipster', 'update', 'update Tipster : Phạm Phú Chinh', '2018-03-02 09:11:23', '2018-03-02 09:11:23'),
(84, 1, 'User', 'created', 'created User : PHAM PHU CHINH', '2018-03-02 09:13:43', '2018-03-02 09:13:43'),
(85, 1, 'Community Manager', 'update', 'update Community Manager : PHAM PHU CHINH', '2018-03-02 09:14:17', '2018-03-02 09:14:17'),
(86, 1, 'Community Manager', 'update', 'update Community Manager : PHAM PHU CHINH', '2018-03-02 09:14:31', '2018-03-02 09:14:31'),
(87, 1, 'Tipster', 'created', 'created Tipster : Pham Thi Dang Thuy', '2018-03-02 09:14:35', '2018-03-02 09:14:35'),
(88, 1, 'User', 'delete', 'delete User : PHAM PHU CHINH', '2018-03-02 09:16:03', '2018-03-02 09:16:03'),
(89, 1, 'Tipster', 'delete', 'delete Tipster : Trần Cao Vân', '2018-03-02 09:19:06', '2018-03-02 09:19:06'),
(90, 1, 'Product', 'created', 'created Product : product name 01', '2018-03-02 09:19:24', '2018-03-02 09:19:24'),
(91, 1, 'Tipster', 'delete', 'delete Tipster : Trần Cao Vân', '2018-03-02 09:19:39', '2018-03-02 09:19:39'),
(92, 1, 'Tipster', 'update', 'update Tipster : Trần Cao Vân', '2018-03-02 09:19:49', '2018-03-02 09:19:49'),
(93, 1, 'Product', 'delete', 'delete Product : product name 01', '2018-03-02 09:20:00', '2018-03-02 09:20:00'),
(94, 1, 'Tipster', 'update', 'update Tipster : Trần Cao Vân', '2018-03-02 09:20:31', '2018-03-02 09:20:31'),
(95, 1, 'Gift', 'created', 'created Gift : Gift name -1', '2018-03-02 09:22:46', '2018-03-02 09:22:46'),
(97, 1, 'Gift', 'update', 'update Gift : iPhone X 256GB', '2018-03-03 02:05:43', '2018-03-03 02:05:43'),
(98, 1, 'Lead', 'update', 'update Lead : Robert Redford', '2018-03-06 01:32:45', '2018-03-06 01:32:45'),
(99, 1, 'Lead', 'update', 'update Lead', '2018-03-06 02:03:58', '2018-03-06 02:03:58'),
(100, 1, 'Tipster', 'update points for', 'update points for Tipster : Hà Duy Minh', '2018-03-06 04:45:21', '2018-03-06 04:45:21'),
(101, 1, 'Lead', 'update', 'update Lead', '2018-03-07 08:16:32', '2018-03-07 08:16:32'),
(102, 1, 'Lead', 'update', 'update Lead', '2018-03-07 08:20:37', '2018-03-07 08:20:37'),
(103, 1, 'Tipster', 'created', 'created Tipster : Pham Thi Dang Thuy Lead', '2018-03-09 11:27:12', '2018-03-09 11:27:12'),
(104, 1, 'Lead', 'update', 'update Lead : Trần Thanh Tâm', '2018-03-12 12:12:07', '2018-03-12 12:12:07'),
(105, 1, 'Lead', 'update', 'update Lead', '2018-03-12 12:12:15', '2018-03-12 12:12:15'),
(106, 1, 'Lead', 'update', 'update Lead', '2018-03-12 12:14:03', '2018-03-12 12:14:03'),
(107, 1, 'Lead', 'update', 'update Lead : Robert Redford', '2018-03-13 09:43:29', '2018-03-13 09:43:29'),
(108, 1, 'Lead', 'update', 'update Lead', '2018-03-13 11:18:00', '2018-03-13 11:18:00'),
(109, 1, 'Lead', 'update', 'update Lead', '2018-03-13 11:54:22', '2018-03-13 11:54:22'),
(110, 1, 'Lead', 'update', 'update Lead : Robert Redford', '2018-03-14 02:32:35', '2018-03-14 02:32:35'),
(111, 1, 'Lead', 'update', 'update Lead : Nguyễn Minh Đạt', '2018-03-14 02:32:51', '2018-03-14 02:32:51'),
(112, 1, 'Message template', 'update', 'update Message template : update_lead_quote', '2018-03-14 02:34:06', '2018-03-14 02:34:06'),
(115, 1, 'Lead', 'update', 'update Lead', '2018-03-14 11:27:34', '2018-03-14 11:27:34'),
(116, 1, 'Tipster', 'update', 'update Tipster : Philippe NGUYEN', '2018-03-15 02:19:20', '2018-03-15 02:19:20'),
(117, 1, 'Lead', 'update', 'update Lead', '2018-03-15 02:20:52', '2018-03-15 02:20:52'),
(118, 1, 'Tipster', 'update points for', 'update points for Tipster : Philippe NGUYEN', '2018-03-15 02:21:10', '2018-03-15 02:21:10'),
(119, 1, 'Lead', 'created', 'created Lead : Ha Tu', '2018-03-16 10:50:14', '2018-03-16 10:50:14'),
(122, 1, 'Community Manager', 'update', 'update Community Manager : PHAM PHU CHINH', '2018-03-21 13:53:46', '2018-03-21 13:53:46'),
(123, 1, 'Lead', 'update', 'update Lead : Robert Redford', '2018-03-22 00:48:48', '2018-03-22 00:48:48'),
(124, 1, 'Lead', 'update', 'update Lead : Robert Redford', '2018-03-22 00:53:25', '2018-03-22 00:53:25'),
(125, 1, 'Lead', 'update', 'update Lead : Robert Redford', '2018-03-22 00:58:24', '2018-03-22 00:58:24'),
(126, 20, 'Community Manager', 'update', 'update Community Manager', '2018-03-22 08:51:56', '2018-03-22 08:51:56'),
(127, 20, 'Community Manager', 'update', 'update Community Manager : Nguyen Duy Tung', '2018-03-22 08:52:27', '2018-03-22 08:52:27'),
(128, 20, 'Community Manager', 'update', 'update Community Manager : Nguyen Duy Tung', '2018-03-22 08:53:41', '2018-03-22 08:53:41'),
(129, 1, 'Tipster', 'update', 'update Tipster : Phạm Ánh Chiến', '2018-03-22 17:50:27', '2018-03-22 17:50:27'),
(130, 1, 'Tipster', 'created', 'created Tipster : Hoang Nguyen', '2018-03-23 01:29:02', '2018-03-23 01:29:02'),
(131, 1, 'Tipster', 'created', 'created Tipster : Hoang Nguyen', '2018-03-23 01:33:14', '2018-03-23 01:33:14'),
(132, 1, 'Tipster', 'update', 'update Tipster : Hoang Nguyen', '2018-03-23 02:10:34', '2018-03-23 02:10:34'),
(133, 1, 'Tipster', 'created', 'created Tipster : Hoang Nguyen', '2018-03-23 02:12:49', '2018-03-23 02:12:49'),
(134, 1, 'Lead', 'created', 'created Lead : toto', '2018-03-23 02:27:19', '2018-03-23 02:27:19'),
(135, 1, 'Lead', 'update', 'update Lead : toto', '2018-03-23 03:22:22', '2018-03-23 03:22:22'),
(137, 1, 'Lead', 'update', 'update Lead', '2018-03-23 03:22:47', '2018-03-23 03:22:47'),
(138, 1, 'Lead', 'update', 'update Lead : toto', '2018-03-23 03:22:54', '2018-03-23 03:22:54'),
(139, 1, 'Tipster', 'created', 'created Tipster : Hai Nguyen', '2018-03-23 07:17:01', '2018-03-23 07:17:01'),
(140, 1, 'Tipster', 'update points for', 'update points for Tipster : Hoang Nguyen', '2018-03-23 21:33:55', '2018-03-23 21:33:55'),
(141, 1, 'Lead', 'update', 'update Lead : toto', '2018-03-23 21:34:05', '2018-03-23 21:34:05'),
(142, 1, 'Tipster', 'update points for', 'update points for Tipster : Hoang Nguyen', '2018-03-23 21:34:52', '2018-03-23 21:34:52'),
(143, 1, 'Lead', 'update', 'update Lead : toto', '2018-03-23 21:35:00', '2018-03-23 21:35:00'),
(144, 1, 'Community Manager', 'update', 'update Community Manager : Bùi Chí Công', '2018-03-25 11:53:57', '2018-03-25 11:53:57'),
(145, 1, 'Community Manager', 'update', 'update Community Manager : Bùi Chí Công', '2018-03-25 11:54:29', '2018-03-25 11:54:29'),
(146, 1, 'Gift', 'created', 'created Gift : Nha Trang', '2018-03-25 12:23:27', '2018-03-25 12:23:27'),
(147, 1, 'Gift', 'update', 'update Gift : Nha Trang', '2018-03-25 12:25:32', '2018-03-25 12:25:32'),
(148, 1, 'Product', 'update', 'update Product : Medical', '2018-03-25 12:35:12', '2018-03-25 12:35:12'),
(149, 1, 'Tipster', 'update', 'update Tipster : Hoang Nguyen', '2018-03-25 12:57:18', '2018-03-25 12:57:18'),
(150, 1, 'Tipster', 'update', 'update Tipster : Hoang Nguyen', '2018-03-25 12:57:47', '2018-03-25 12:57:47'),
(151, 1, 'Tipster', 'update', 'update Tipster : Hoang Nguyen', '2018-03-25 13:05:47', '2018-03-25 13:05:47'),
(152, 1, 'Tipster', 'update', 'update Tipster : Hoang Nguyen', '2018-03-25 13:06:48', '2018-03-25 13:06:48'),
(153, 16, 'Lead', 'update', 'update Lead', '2018-03-26 11:20:28', '2018-03-26 11:20:28'),
(154, 1, 'Tipster', 'update', 'update Tipster : Hoang Nguyen', '2018-04-02 11:00:22', '2018-04-02 11:00:22'),
(155, 1, 'Tipster', 'update', 'update Tipster : Hoang Nguyen', '2018-04-02 11:03:37', '2018-04-02 11:03:37'),
(156, 1, 'Tipster', 'update', 'update Tipster', '2018-04-02 11:09:10', '2018-04-02 11:09:10'),
(157, 1, 'Tipster', 'update', 'update Tipster : Nguyen Duy Tung', '2018-04-02 11:09:25', '2018-04-02 11:09:25'),
(158, 19, 'Tipster', 'update', 'update Tipster : Pham Thi Dang Thuy Lead', '2018-04-03 04:50:08', '2018-04-03 04:50:08'),
(159, 19, 'Tipster', 'update', 'update Tipster : Pham Thi Dang Thuy - Tipster', '2018-04-03 04:54:11', '2018-04-03 04:54:11'),
(160, 1, 'Region', 'update', 'update Region : Ha Noi', '2018-04-04 11:29:27', '2018-04-04 11:29:27'),
(161, 1, 'Gift', 'update', 'update Gift : Nha Trang', '2018-04-09 03:42:59', '2018-04-09 03:42:59'),
(162, 1, 'Gift', 'update', 'update Gift : Nha Trang', '2018-04-09 03:43:06', '2018-04-09 03:43:06'),
(163, 8, 'Lead', 'update', 'update Lead : Robert Redford', '2018-04-12 09:04:38', '2018-04-12 09:04:38'),
(164, 1, 'Lead', 'created', 'created Lead : Dinh Van', '2018-04-26 08:05:15', '2018-04-26 08:05:15'),
(166, 1, 'Lead', 'update', 'update Lead', '2018-04-26 08:05:42', '2018-04-26 08:05:42'),
(167, 1, 'Lead', 'update', 'update Lead', '2018-04-26 08:05:56', '2018-04-26 08:05:56'),
(169, 1, 'Lead', 'update', 'update Lead', '2018-05-16 05:24:54', '2018-05-16 05:24:54'),
(170, 1, 'Lead', 'update', 'update Lead : Dinh Van', '2018-05-16 05:25:13', '2018-05-16 05:25:13'),
(171, 1, 'Lead', 'update', 'update Lead', '2018-05-16 05:25:23', '2018-05-16 05:25:23'),
(172, 1, 'Lead', 'created', 'created Lead : sdfsdf', '2018-05-16 06:25:37', '2018-05-16 06:25:37'),
(173, 1, 'Lead', 'created', 'created Lead : sdfsdf', '2018-05-16 06:25:52', '2018-05-16 06:25:52'),
(174, 1, 'Lead', 'update', 'update Lead : sdfsdf', '2018-05-24 02:41:30', '2018-05-24 02:41:30'),
(175, 1, 'Lead', 'update', 'update Lead', '2018-05-24 02:41:51', '2018-05-24 02:41:51'),
(176, 1, 'Tipster', 'update points for', 'update points for Tipster : Trần Cao Vân', '2018-05-24 10:29:39', '2018-05-24 10:29:39'),
(177, 1, 'Tipster', 'update points for', 'update points for Tipster : Trần Cao Vân', '2018-05-24 10:31:24', '2018-05-24 10:31:24'),
(178, 1, 'Tipster', 'update points for', 'update points for Tipster : Trần Cao Vân', '2018-05-24 10:31:49', '2018-05-24 10:31:49'),
(179, 1, 'Lead', 'update', 'update Lead : sdfsdf123', '2018-06-16 00:56:59', '2018-06-16 00:56:59'),
(180, 1, 'Lead', 'update', 'update Lead : sdfsdf123', '2018-06-16 00:57:30', '2018-06-16 00:57:30'),
(181, 1, 'Lead', 'update', 'update Lead : sdfsdf123', '2018-06-16 00:58:51', '2018-06-16 00:58:51'),
(182, 1, 'Lead', 'created', 'created Lead : Toto', '2018-06-16 01:02:34', '2018-06-16 01:02:34'),
(183, 1, 'Lead', 'created', 'created Lead : Toto', '2018-06-16 01:03:07', '2018-06-16 01:03:07'),
(184, 1, 'Lead', 'update', 'update Lead : toto', '2018-06-16 01:12:27', '2018-06-16 01:12:27'),
(185, 1, 'Lead', 'update', 'update Lead : toto - long', '2018-06-16 01:13:20', '2018-06-16 01:13:20'),
(186, 1, 'Tipster', 'created', 'created Tipster : Long Nguyen', '2018-06-16 08:12:32', '2018-06-16 08:12:32'),
(187, 1, 'Tipster', 'created', 'created Tipster : Long Nguyen', '2018-06-16 08:13:39', '2018-06-16 08:13:39'),
(188, 1, 'Product', 'created', 'created Product : Auto', '2018-06-16 09:29:24', '2018-06-16 09:29:24'),
(189, 1, 'Product', 'delete', 'delete Product : Auto', '2018-06-16 09:30:48', '2018-06-16 09:30:48'),
(190, 23, 'Lead', 'update', 'update Lead : sdfsdf', '2018-06-17 05:06:38', '2018-06-17 05:06:38'),
(191, 23, 'Lead', 'update', 'update Lead : sdfsdf long', '2018-06-17 05:24:37', '2018-06-17 05:24:37'),
(192, 23, 'Lead', 'update', 'update Lead : sdfsdf long 2', '2018-06-17 05:25:07', '2018-06-17 05:25:07'),
(196, 1, 'Product', 'created', 'created Product : other product - long', '2018-06-18 01:37:53', '2018-06-18 01:37:53'),
(197, 1, 'Product', 'created', 'created Product : other product - long', '2018-06-18 01:38:57', '2018-06-18 01:38:57'),
(198, 1, 'Product', 'delete', 'delete Product : other product - long', '2018-06-18 01:39:19', '2018-06-18 01:39:19'),
(199, 1, 'Product', 'created', 'created Product : other product - long', '2018-06-18 01:40:16', '2018-06-18 01:40:16'),
(200, 1, 'Product', 'created', 'created Product : other product - long', '2018-06-18 01:40:48', '2018-06-18 01:40:48'),
(201, 1, 'Product', 'delete', 'delete Product : other product - long', '2018-06-18 01:41:02', '2018-06-18 01:41:02'),
(202, 1, 'Product', 'created', 'created Product : other product - long', '2018-06-18 01:41:33', '2018-06-18 01:41:33'),
(203, 1, 'Product', 'update', 'update Product : other product - long', '2018-06-18 01:42:07', '2018-06-18 01:42:07'),
(204, 1, 'Product', 'update', 'update Product : other product - long', '2018-06-18 01:42:08', '2018-06-18 01:42:08'),
(205, 1, 'Product', 'update', 'update Product : other product - long', '2018-06-18 01:45:04', '2018-06-18 01:45:04'),
(206, 1, 'Lead', 'created', 'created Lead : sdfsdf123', '2018-06-19 02:09:33', '2018-06-19 02:09:33'),
(207, 1, 'Tipster', 'update', 'update Tipster', '2018-06-19 03:39:22', '2018-06-19 03:39:22'),
(208, 1, 'Tipster', 'update', 'update Tipster : Long Nguyen', '2018-06-19 03:40:05', '2018-06-19 03:40:05'),
(209, 1, 'Lead', 'update', 'update Lead : toto - long', '2018-06-25 16:07:50', '2018-06-25 16:07:50'),
(210, 1, 'Lead', 'created', 'created Lead : Phạm Phú Chinh3', '2018-06-25 16:08:03', '2018-06-25 16:08:03'),
(211, 1, 'User', 'created', 'created User : sale01', '2018-06-25 16:36:31', '2018-06-25 16:36:31'),
(212, 1, 'Lead', 'created', 'created Lead : Nguyen Thanh Hãi', '2018-06-27 06:39:09', '2018-06-27 06:39:09'),
(213, 1, 'Lead', 'created', 'created Lead : Nguyen Thanh Hãi', '2018-06-27 06:41:51', '2018-06-27 06:41:51'),
(214, 1, 'Lead', 'created', 'created Lead : Nguyen Thanh Hãi', '2018-06-27 06:48:51', '2018-06-27 06:48:51'),
(215, 1, 'Lead', 'created', 'created Lead : Nguyen Thanh Hãi', '2018-06-27 07:16:38', '2018-06-27 07:16:38'),
(216, 1, 'Lead', 'created', 'created Lead : Nguyen Thanh Hãi', '2018-06-27 07:17:16', '2018-06-27 07:17:16'),
(217, 1, 'Lead', 'created', 'created Lead : Nguyen Thanh Hãi', '2018-06-27 07:41:45', '2018-06-27 07:41:45'),
(218, 1, 'Lead', 'created', 'created Lead : Nuyễn T. Hải', '2018-06-27 08:17:05', '2018-06-27 08:17:05'),
(219, 1, 'Lead', 'update', 'update Lead : Nuyễn T. Hải', '2018-06-28 03:39:12', '2018-06-28 03:39:12'),
(220, 1, 'Lead', 'update', 'update Lead : Nuyễn T. Hải', '2018-06-28 03:51:16', '2018-06-28 03:51:16'),
(221, 1, 'Lead', 'update', 'update Lead : Nguyen Thanh Hãi', '2018-06-28 04:27:42', '2018-06-28 04:27:42'),
(222, 1, 'Lead', 'delete', 'delete Lead : Nguyen Thanh Hãi', '2018-06-28 04:27:59', '2018-06-28 04:27:59'),
(223, 1, 'Lead', 'delete', 'delete Lead : sdfsdf123', '2018-06-28 04:31:40', '2018-06-28 04:31:40'),
(224, 1, 'Tipster', 'created', 'created Tipster : toto insurance', '2018-06-28 07:48:09', '2018-06-28 07:48:09'),
(225, 1, 'Tipster', 'created', 'created Tipster : toto insurance', '2018-06-28 07:50:50', '2018-06-28 07:50:50'),
(226, 1, 'Tipster', 'created', 'created Tipster : toto insurance', '2018-06-28 08:22:47', '2018-06-28 08:22:47'),
(227, 1, 'Tipster', 'created', 'created Tipster : toto insurance', '2018-06-28 08:27:14', '2018-06-28 08:27:14'),
(228, 1, 'Tipster', 'update', 'update Tipster : toto insurance', '2018-06-28 09:04:40', '2018-06-28 09:04:40'),
(229, 1, 'Tipster', 'update', 'update Tipster : toto insurance', '2018-06-28 09:05:26', '2018-06-28 09:05:26'),
(230, 1, 'Tipster', 'update', 'update Tipster : toto insurance', '2018-06-28 09:06:50', '2018-06-28 09:06:50'),
(231, 1, 'Community Manager', 'update', 'update Community Manager : Sale Manager', '2018-06-28 11:38:52', '2018-06-28 11:38:52'),
(232, 1, 'Gift', 'update', 'update Gift : Vision 2018', '2018-07-03 14:26:50', '2018-07-03 14:26:50'),
(233, 1, 'Gift', 'update', 'update Gift : Nha Trang', '2018-07-03 14:27:01', '2018-07-03 14:27:01'),
(234, 1, 'Lead', 'created', 'created Lead : anh ABC', '2018-07-16 05:54:09', '2018-07-16 05:54:09');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` int(10) UNSIGNED NOT NULL,
  `receiver` int(10) UNSIGNED NOT NULL,
  `delete_is` tinyint(4) NOT NULL DEFAULT '0',
  `delete_sent` tinyint(1) DEFAULT '0',
  `delete_trash` tinyint(1) DEFAULT '0',
  `read_is` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `title`, `content`, `author`, `receiver`, `delete_is`, `delete_sent`, `delete_trash`, `read_is`, `created_at`, `updated_at`) VALUES
(1, 'Pass', '<p>At nec iriure <b>ornatus repudiar</b>e, vis ei virtute voluptua definitionem, mei ad graece oportere posidonium. Alii libris quaestio mel ut, quem indoctum vel ad, ex usu ipsum delectus scriptorem. Et prompta eloquentiam usu, usu labore iuvaret sadipscing an. Legimus ancillae praesent ad qui, sea ea posse prompta corpora, eu pri constituam concludaturque. Eum postulant elaboraret theophrastus te.<br></p>', 1, 3, 0, 0, 0, 0, '2018-02-06 13:41:40', '2018-02-06 13:41:40'),
(2, 'You are perfect!', '<p>\r\n\r\n<b>Lee Pac</b>e Height Weight Body Statistics | Lee pace, American actors and Hot guys\r\n\r\n<br></p>', 1, 3, 0, 0, 0, 0, '2018-02-08 08:51:47', '2018-02-08 08:51:47'),
(3, 'What do you in today?', '<p><br>Ne eam torquatos democritum scribentur, atqui melius id qui. Zril vivendo pri et, in albucius platonem scripserit vis. Graecis deserunt cu per. <i>Dicant instructior pri ex</i>, mel ad facete eligendi scriptorem, ea vix virtute accumsan. Choro verear assueverit ei sea, ut his hinc impetus oblique.<br></p>', 1, 3, 0, 0, 0, 1, '2018-02-08 08:54:34', '2018-03-02 08:23:48'),
(4, 'Ignota facete', '<p>Vix ne laudem vocent forensibus. Ignota facete deleniti no pro, ei duo epicurei dignissim. In his graece invidunt, ius et nonumes detraxit singulis, sed ei quando bonorum. Labore sanctus feugait ius an, has cu veri epicurei maiestatis. Quis doctus nostrud cum et, mel convenire vituperatoribus no.<br></p>', 3, 1, 1, 0, 1, 1, '2018-03-02 08:05:53', '2018-03-25 12:43:04'),
(5, 'Test mail', '<p><a target=\"_blank\" rel=\"nofollow\" href=\"https://dantricdn.com/thumb_w/600/2015/2015vision-color-black-side-2-01-1445575847010.JPG\">https://dantricdn.com/thumb_w/600/2015/2015vision-color-black-side-2-01-1445575847010.JPG</a><br></p>', 1, 4, 0, 1, 0, 0, '2018-03-02 08:12:07', '2018-03-02 08:25:15'),
(6, 'Title send 1', '<h2>Content send 1</h2>', 1, 14, 0, 1, 0, 0, '2018-03-02 08:13:56', '2018-03-02 08:24:41'),
(7, 'Hello How are you?', '<p>Vix ne laudem vocent forensibus. Ignota facete deleniti no pro, ei duo epicurei dignissim. In his graece invidunt, ius et nonumes detraxit singulis, sed ei quando bonorum. Labore sanctus feugait ius an, has cu veri epicurei maiestatis. Quis doctus nostrud cum et, mel convenire vituperatoribus no.<br></p>', 3, 1, 1, 0, 0, 1, '2018-03-02 08:26:59', '2018-03-19 09:03:50'),
(8, 'test', '<p>test from client</p>', 1, 2, 0, 0, 0, 0, '2018-06-17 09:15:22', '2018-06-17 09:15:22'),
(9, 'test', '<p>test from client</p>', 1, 23, 0, 0, 0, 0, '2018-06-17 09:15:22', '2018-06-17 09:15:22'),
(10, 'test', '<p>test from client</p>', 1, 22, 0, 0, 0, 0, '2018-06-17 09:15:22', '2018-06-17 09:15:22');

-- --------------------------------------------------------

--
-- Table structure for table `message_templates`
--

CREATE TABLE `message_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `message_id` varchar(191) DEFAULT NULL,
  `subject_vn` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `subject_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `content_vn` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `content_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message_templates`
--

INSERT INTO `message_templates` (`id`, `message_id`, `subject_vn`, `subject_en`, `content_vn`, `content_en`, `created_at`, `updated_at`) VALUES
(1, 'thank_you_letter', 'Thư cảm ơn', 'Thank you letter', '<p>Xin chào [tipster.name],</p><p>Lead \"[lead.name]\" đã được tiếp nhận bởi bộ phận tư vấn viên của chúng tôi.</p><p>Cảm ơn sự hỗ trợ của bạn và chúc bạn nhận được nhiều điểm thưởng.</p><p><br></p>', '<p>Hello [tipster.name],</p><p>The Lead [lead.name] has been received by the consultant.</p><p>Thank you for your support and wish you get more point bonus.</p>', '2018-03-07 04:23:33', '2018-03-09 03:23:40'),
(2, 'update_lead_call', 'E-mail Thông báo về trạng thái của lead', 'Notification e-mail about Lead status', '<p>Xin chào [tipster.name],</p><p>Lead [lead.name] của bạn đã được tư vấn viên gọi để tư vấn.</p><p>Cảm ơn và trân trọng.</p>', '<p>Hello [tipster.name],</p><p>Your Lead [lead.name] has been called by consultant.</p><p>Thank you and best regards.</p>', '2018-03-09 03:36:30', '2018-03-12 03:06:20'),
(3, 'update_lead_quote', 'E-mail thông báo về trạng thái của lead', 'Notification e-mail about lead status', '<p>\r\n\r\n</p><p>Xin chào [tipster.name],</p><p>Lead [lead.name] của bạn đã được chuyển&nbsp;đến&nbsp;trạng thái \"Báo Giá\".</p><p>Cảm ơn và trân trọng.</p>\r\n\r\n<br><p></p>', '<p>\r\n\r\n</p><p>Hello [tipster.name],</p><p>Your Lead [lead.name] has been quote by consultant.</p><p>Thank you and best regards.</p><p></p>', '2018-03-09 03:36:48', '2018-03-14 02:34:06'),
(4, 'update_lead_win', 'Thư chúc mừng', 'Congratulatory letter', '<p>Xin chào [tipster.name],</p><p>Lead [lead.name] đã được chuyển đến trạng thái \"THÀNH CÔNG\".</p><p>Chúc mừng bạn đã nhận được [points] points.</p><p>Cảm ơn và trân trọng</p>', '<p>Hello [tipster.name],</p><p>Your lead [lead.name] has been changed status to \"WIN\".</p><p>You has been received [points] points.</p><p>Thank you and best regards.</p>', '2018-03-09 03:37:07', '2018-03-11 21:22:16'),
(5, 'update_lead_lost', 'E-mail Thông báo về trạng thái của lead', 'Notification e-mail about lead status', '<p>Xin chào [tipster.name],</p><p>Lead [lead.name] của bạn đã chuyển sang trạng thái \"Thất bại\".</p><p>Cảm ơn và trân trọng.</p>', '<p>Hello [tipster.name],</p><p>Your lead [lead.name] has been changed to status \"Lost\".</p><p>Thank you and best regards.</p>', '2018-03-09 03:37:27', '2018-03-11 21:25:30'),
(6, 'update_points_tipster', 'Thông báo về cập nhật điểm thưởng', 'Notification about update bonus points', '<p>Xin chào [tipster.name],</p><p>\r\n\r\nXin lỗi điểm thưởng cho lead [lead.name] với sản phẩm [product.name] đã được thay đổi.<br>Bạn nhận được [points.new] điểm.</p><p>Điểm hiện tại của bạn là: [points.current] điểm.</p><p>Cảm ơn và trân trọng.</p><p>(Nếu bạn có bất kỳ thắc mắc nào, vui lòng liên hệ với Admin)</p>', '<p>Hello [tipster.name],</p><p>\r\n\r\nSorry you, The bonus points for lead [lead.name] with product [product.name] have changed.<br></p><p>You received [points.new] points.</p><p>Your current points : [points.current] points.</p><p>Thank you and best regards.</p><p>(If you have any questions, please contact with Admin).</p><p><br></p>', '2018-03-12 19:42:58', '2018-03-13 00:34:39'),
(7, 'plus_points_tipster', 'Thông báo về điểm thưởng', 'Notification about bonus points', '<p>Xin chào [tipster.name],</p><p>Chúc mừng bạn đã nhận được <b>[points.new]</b> điểm từ việc giới thiệu lead <b>[lead.name]</b> với sản phẩm [product.name].</p><p>Điểm hiện tại của bạn là: <b>[points.current] </b>points.<b></b></p><p>Cảm ơn và trân trọng.</p>', '<p>Hello [tipster.name],</p><p>Congratulations you have received <b>[points.new]</b> points from the introduction<b> [lead.name]</b> for product [product.name].</p><p>Your current points: <b>[points.current]</b></p><p>Thank you and best reagards.</p>', '2018-03-13 00:26:26', '2018-03-13 02:08:30');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(26, '2017_12_21_041854_create_categories_table', 1),
(55, '2010_12_29_025812_create_roletypes_table', 2),
(56, '2010_12_29_025947_create_roles_table', 2),
(57, '2014_10_11_042406_create_regions_table', 2),
(58, '2014_10_12_000000_create_users_table', 2),
(59, '2014_10_12_100000_create_password_resets_table', 2),
(60, '2017_12_21_041853_create_giftcategories_table', 2),
(61, '2017_12_21_041854_create_productcategories_table', 2),
(62, '2017_12_21_042555_create_messages_table', 2),
(63, '2017_12_21_051101_create_leads_table', 2),
(64, '2017_12_21_063650_create_evaluations_table', 2),
(65, '2017_12_21_070436_create_assignments_table', 2),
(66, '2017_12_21_071945_create_statuses_table', 2),
(67, '2017_12_21_072333_create_leadprocesses_table', 2),
(68, '2017_12_21_072804_create_actions_table', 2),
(69, '2017_12_21_072805_create_menus_table', 2),
(70, '2017_12_21_072805_create_permissions_table', 2),
(71, '2017_12_21_073609_create_role_permissions_table', 2),
(72, '2017_12_21_075408_create_gifts_table', 2),
(73, '2017_12_21_080118_create_orders_table', 2),
(74, '2017_12_21_080257_create_order_gifts_table', 2),
(75, '2017_12_21_093715_create_products_table', 2),
(76, '2017_12_21_094349_create_pages_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipster_id` int(10) UNSIGNED NOT NULL,
  `total` decimal(3,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_gifts`
--

CREATE TABLE `order_gifts` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `gift_id` int(10) UNSIGNED NOT NULL,
  `quality` decimal(8,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL,
  `parents` decimal(2,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('thuy.pham@amagumolabs.com', '$2y$10$5swxkmV4xj1s6N6vi7NjRusZ6aZSIsb99bKd4RIPNFnS7.TGoAISK', '2018-04-06 03:43:45');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `action_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `point_histories`
--

CREATE TABLE `point_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipster_id` int(10) UNSIGNED NOT NULL,
  `lead_id` int(10) UNSIGNED DEFAULT NULL,
  `point` int(10) NOT NULL,
  `activity` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `point_histories`
--

INSERT INTO `point_histories` (`id`, `tipster_id`, `lead_id`, `point`, `activity`, `comment`, `created_at`, `updated_at`) VALUES
(1, 3, 11, 10, NULL, NULL, '2018-02-01 16:41:13', '2018-02-01 16:41:13'),
(2, 4, 15, 50, NULL, NULL, '2018-02-06 13:32:23', '2018-02-06 13:32:23'),
(3, 11, 18, 50, NULL, NULL, '2018-02-08 03:49:29', '2018-02-08 03:49:29'),
(4, 3, 25, 150, NULL, NULL, '2018-02-08 04:40:39', '2018-02-08 04:40:39'),
(5, 11, 36, 12, NULL, NULL, '2018-03-02 09:03:48', '2018-03-02 09:03:48'),
(6, 13, 36, 2, NULL, NULL, '2018-03-02 09:04:08', '2018-03-02 09:04:08'),
(7, 4, 20, 80, NULL, NULL, '2018-03-06 04:45:21', '2018-03-06 04:45:21'),
(8, 3, 32, 150, NULL, NULL, '2018-03-15 02:21:10', '2018-03-15 02:21:10'),
(9, 21, 37, 2, NULL, NULL, '2018-03-23 21:33:55', '2018-03-23 21:34:52'),
(10, 15, 40, 0, NULL, NULL, '2018-05-24 10:29:39', '2018-05-24 10:31:49'),
(11, 23, NULL, 10, 'Init', NULL, '2018-06-17 10:16:15', '2018-06-17 10:16:15'),
(12, 23, NULL, 10, 'Init', NULL, '2018-06-17 10:19:00', '2018-06-17 10:19:00'),
(13, 21, NULL, 2, 'Bonus', '<p>dear Tipster Hoang Nguyen&nbsp;</p><p>Test cho bonus tipster Hoang Nguyen thêm 2 points =&gt; total =5 points<br></p><p>Sales Manager</p><p>XXXXXX</p>', '2018-06-28 09:19:01', '2018-06-28 09:19:01'),
(14, 21, NULL, 2, 'Bonus', '<p>dear Tipster Hoang Nguyen&nbsp;</p><p>Test cho bonus tipster Hoang Nguyen thêm 2 points =&gt; total =5 points<br></p><p>Sales Manager</p><p>XXXXXX</p>', '2018-06-28 09:19:03', '2018-06-28 09:19:03'),
(15, 26, NULL, 2, 'Init', '<p>Test</p><p>Try to add 2 points like init points to tispter totoinsurance&nbsp;</p>', '2018-06-28 10:02:21', '2018-06-28 10:02:21'),
(16, 26, NULL, -2, 'Buy Gift', '<p>Test: try to substract 2 points from totinsurance</p>', '2018-06-28 10:03:53', '2018-06-28 10:03:53'),
(17, 21, NULL, -2, 'Buy Gift', '<p>Try to substract 2 points from Tipster Hong Nguyen with option buy gift (-2)</p><p><br></p>', '2018-06-28 10:07:31', '2018-06-28 10:07:31');

-- --------------------------------------------------------

--
-- Table structure for table `productcategories`
--

CREATE TABLE `productcategories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productcategories`
--

INSERT INTO `productcategories` (`id`, `name`, `code`, `description`, `created_at`, `updated_at`) VALUES
(5, 'Insurance', 'insurance', NULL, '2018-01-16 21:24:43', '2018-01-16 21:24:43'),
(6, '1', '1', NULL, '2018-03-02 09:19:40', '2018-03-02 09:19:40');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `price` decimal(8,0) NOT NULL DEFAULT '0',
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quality` decimal(8,0) NOT NULL DEFAULT '0',
  `category_id` int(10) UNSIGNED NOT NULL,
  `delete_is` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `thumbnail`, `quality`, `category_id`, `delete_is`, `created_at`, `updated_at`) VALUES
(4, 'Medical', 'Reque voluptua ad qui. Ut pro sumo etiam legere, ei usu erant choro eruditi, elitr adversarium vel cu. Ut sit fastidii definiebas posidonium, has ne graeci dissentias. Eum eu hendrerit inciderint. Harum detraxit pri ne.', '-2', '1519879534.jpg', '-1', 5, 0, '2018-03-01 02:46:42', '2018-03-25 12:35:12'),
(5, 'Auto/Moto', NULL, '0', '1519879469.jpg', '0', 5, 0, NULL, '2018-03-01 04:44:33'),
(6, 'Shops', NULL, '0', '1519879603.png', '0', 5, 0, NULL, '2018-03-01 04:46:46'),
(7, 'Factory', NULL, '0', '1519980182.jpg', '0', 5, 0, NULL, '2018-03-02 08:43:05'),
(8, 'Office', NULL, '0', '1519980227.jpg', '0', 5, 0, NULL, '2018-03-02 08:43:53'),
(9, 'Home', NULL, '0', '1519980276.jpg', '0', 5, 0, NULL, '2018-03-02 08:44:40'),
(10, 'Travel', NULL, '0', '1519980333.jpg', '0', 5, 0, NULL, '2018-03-02 08:45:37'),
(11, 'Student', NULL, '0', '1519980384.jpg', '0', 5, 0, NULL, '2018-03-02 08:46:29'),
(12, 'Other', NULL, '0', 'no_image_available.jpg', '0', 5, 0, '2018-03-01 04:40:35', '2018-03-01 04:40:35'),
(15, 'product name 01', 'sdfsdf', '3', '1519982347.jpg', '1', 5, 1, '2018-03-02 09:19:24', '2018-03-02 09:20:00'),
(16, 'Auto', 'Insurance product for car', '0', 'no_image_available.jpg', '0', 5, 1, '2018-06-16 09:29:24', '2018-06-16 09:30:48'),
(17, 'other product - long', 'product of insurance for testing', '0', 'no_image_available.jpg', '0', 5, 1, '2018-06-18 01:38:57', '2018-06-18 01:39:19'),
(18, 'other product - long', 'for testing', '0', 'no_image_available.jpg', '0', 5, 1, '2018-06-18 01:40:48', '2018-06-18 01:41:02'),
(19, 'other product - long', 'for testing', '0', '1529286304.jpg', '0', 6, 0, '2018-06-18 01:41:33', '2018-06-18 01:45:04');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Ha Noi', 'hanoi', NULL, NULL),
(2, 'Ho Chi Minh', 'hochiminh', NULL, NULL),
(3, 'Da Nang', 'danang', NULL, NULL),
(4, 'Nha Trang', 'nhatrang', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roletype_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `code`, `roletype_id`) VALUES
(1, 'Admin', 'admin', 1),
(2, 'Community', 'community', 1),
(3, 'Sale', 'sale', 1),
(4, 'Insurance', 'insurance', 2),
(5, 'Car', 'car', 2),
(6, 'Real estate', 'realestate', 2),
(7, 'Service', 'service', 2),
(8, 'Ambassador', 'ambassador', 3),
(9, 'Tipster', 'tipster_normal', 3);

-- --------------------------------------------------------

--
-- Table structure for table `roletypes`
--

CREATE TABLE `roletypes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roletypes`
--

INSERT INTO `roletypes` (`id`, `name`, `code`) VALUES
(1, 'Manager', 'manager'),
(2, 'Consultant', 'consultant'),
(3, 'Tipster', 'tipster');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '0',
  `birthday` date DEFAULT '1900-01-01',
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `point` decimal(8,0) NOT NULL DEFAULT '0',
  `vote` decimal(4,0) NOT NULL DEFAULT '0',
  `delete_is` tinyint(4) NOT NULL DEFAULT '0',
  `role_id` int(10) UNSIGNED NOT NULL,
  `region_id` int(10) UNSIGNED NOT NULL,
  `preferred_lang` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'vn',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `fullname`, `avatar`, `gender`, `birthday`, `address`, `phone`, `point`, `vote`, `delete_is`, `role_id`, `region_id`, `preferred_lang`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@amagumolabs.com', '$2y$10$8q2YeXKpiQGxqffDUeCaauNwPoQqnN7CmPy6HxXeRP7d5JF6nvToG', 'Admin', '1518515533.png', 1, '2017-12-12', 'Ho Chi Minh, Viet Nam', '093893771', '0', '0', 0, 1, 1, 'vn', 'DOo7D4nNpfVaKRRBo8abIrM2VLRoZGRikuYkQqh3NIN0nlttdTYkvBiR4zOu', NULL, '2018-03-02 08:16:38'),
(2, 'tipster1', 'tipster1@gmail.com', '$2y$10$umRwAmT3NST33aLjGySLgOXmRD7aHm1/K0YEBDMJrFey0H0TsTPMy', 'Nguyễn Thị Nhật Hạ', 'user4-128x128.jpg', 1, '1990-12-20', 'Tan Binh', '01928739832', '0', '0', 0, 8, 2, 'vn', 'bpEWcJ7BYwqrps7crrUaJJRCqNyr5wljZsqjNenqw6Fh7cvA9NsVO867yXuh', '2018-01-16 22:17:29', '2018-02-08 03:46:22'),
(3, 'tipster2', 'saigonaut@gmail.com', '$2y$10$VYctWG6DoE4Mf3zqLLzwGu6RDxT8/DdriDS94ol0.iKsHcOtShOGm', 'Philippe NGUYEN', 'user1-128x128.jpg', 0, '1982-01-11', 'Hoan Kiem', '0989310732', '310', '0', 0, 9, 1, 'en', 'GZ5OUGfGKzvbf00VnTDVnf1YGWwsW9dVfeeDVTsw7TtWW9Rst5mxchNGEMai', '2018-01-17 20:38:44', '2018-03-15 02:21:10'),
(4, 'tipster3', 'tipster3@gmail.com', '$2y$10$FkYTVllLc60zli2MSwbg3u/miVmdPqsxWA12AM6v8GwAfJOuOAIIq', 'Hà Duy Minh', 'user2-160x160.jpg', 1, '1981-01-19', 'Tran Hung Dao', '0989310981', '130', '0', 0, 9, 3, 'vn', 'iQOdQiyUqf0VGL4E4xQiSm3MrWrR3xuAHG0lffqVnJL28TLVaZkk6HkO1j4A', '2018-01-17 20:40:37', '2018-03-06 04:45:21'),
(5, 'tipster4', 'tipster4@gmail.com', '$2y$10$PQUkjmW4GTPhfRU4.qMY1eF4z5klCeh29CrPMqURPCMmZPM8pVA/K', 'Nguyen Tran Ngoc Tran', 'user7-128x128.jpg', 0, '1992-01-20', 'Nguyen Chi Thanh', '0888172361', '0', '0', 0, 9, 4, 'vn', 'PR12DpAkY9kiDi1FyPJrHplbCMfpT1GVRdReroRNWOtiV7e7XLuYEGQe7zc4', '2018-01-17 20:42:36', '2018-01-31 10:29:43'),
(6, 'consultant1', 'consultant@gmail.com', '$2y$10$v1rQG22BYwgETQhb3s6ROu6mRK2V2qd5p6wDFmec1xls0RybQ.xbi', 'Consultant Thuy', 'user3-128x128.jpg', 1, '2000-01-10', 'Hai Ba Trung', '019876512', '0', '0', 0, 5, 2, 'vn', 'RqbTJeT1OBeKoqVqHv4uURIr4mEFe6AMLEkhxOxaj6WCSHDNhiCyQTpOY8rw', '2018-01-18 01:04:05', '2018-01-22 02:27:35'),
(7, 'hachit', 'chitha@gmail.com', '$2y$10$9JU56BB/CPq2YtepwRtjOOb6XtsPUdd4b7tQwJn57ZHkrSSgvLqM6', 'Ha Chi T', NULL, 0, '1980-01-12', 'Son Tra', '09897682721', '0', '0', 0, 6, 3, 'vn', NULL, '2018-01-22 00:02:30', '2018-01-22 00:02:30'),
(8, 'salemanager', 'salemanager@gmail.com 123456', '$2y$10$Hl8HdrjLhvAmDxDflz38POqbcd4Y.4fncNf2d0BFTjCU.m0tmOtdy', 'Sale Manager', NULL, 0, '1998-12-04', 'Hai Ba Trung', '0981237823 qqqqq', '0', '0', 0, 3, 2, 'vn', 'cWamnDv4MtxIJhLkOQdNP4wZUwh0uqOJWZSXEysznIeWaVdtBRgnHKQG4ceY', '2018-01-22 01:09:20', '2018-06-28 11:38:52'),
(9, 'community', 'communityman@gmail.com', '$2y$10$akhhKTnJ2ANdoW5OSy9rpuwRQoi/FMls4nGD7rYJ0Ekxv.74jeaE6', 'Community Manager', NULL, 1, '1987-03-21', 'Dong Den', '1231234123', '0', '0', 0, 2, 2, 'vn', 'LsEJ3naRS6mTEDPyl1mXCgepNwdf45LBf4EiF32vot1mGAzXp3GdgslWIO7Q', '2018-01-22 01:11:00', '2018-01-22 01:11:00'),
(10, 'nhathuy', 'nhatduy@gmail.com', '$2y$10$.MzoI4h6lblmeKDSeGAyauBZwDFYOtCafItaq21UzWbyQ2/6g/iya', 'Nguyễn Trần Nhất Huy', 'user6-128x128.jpg', 1, '1992-02-15', 'Bình Thạnh', '098276313', '0', '0', 0, 9, 2, 'vn', '6pXVENkoljapLfOyHgxFActPQEpex7gz24EiqwVBu9RbG5S3k4h3iTTKk4wx', '2018-02-06 13:18:07', '2018-02-06 13:18:07'),
(11, 'tipster5', 'hungnguyen@gmail.com', '$2y$10$VyzaVZZKp.hH0KCOGYb8se3egGjyA73KhBOBqQjXkoHTHid4m7R8y', 'Nguyễn Minh Hùng', 'user8-128x128.jpg', 0, '1992-02-21', 'Quận 12', '0987676652', '62', '0', 0, 9, 2, 'vn', NULL, '2018-02-06 13:27:11', '2018-03-02 09:03:48'),
(12, 'giahan', 'giahanluong@gmail.com', '$2y$10$mTyaz6M2BULA5jyGzG/rfOO.Q5I1samh4NzDdWkkJEHJxwR9SIodu', 'Lương Gia Hân', 'user7-128x128.jpg', 1, '2005-02-13', '10 district', '123456789', '0', '0', 0, 9, 2, 'vn', NULL, '2018-02-08 08:13:59', '2018-02-08 08:13:59'),
(13, 'anhchien', 'anhchien@gmail.com', '$2y$10$SRBYoy2GLY0dvI/tsKcA3uIwzxDPTj71F8ucbPozbnsWiHailv2Fe', 'Phạm Ánh Chiến', 'user10-128x128.jpg', 1, '1992-02-14', '7 District', '019827731', '5', '0', 0, 9, 2, 'vn', 'X0kzNzZcQvl7nH3q8Iic6xtahkuRYIVukphEaa9I8qSK5yeLwLuPygUOg2Qc', '2018-02-08 08:18:50', '2018-03-22 17:50:27'),
(14, 'phuongtrung', 'trungta@gmail.com', '$2y$10$stFpWBXq0pWgIHJDhoX/6eBaCsZShTZrUWecHE47wcvKw1wYCpSlC', 'Tạ Hoàng Phương Trung', 'sean-harmon-128x128.jpg', 0, '1988-02-14', 'Trường Sa street, Tân Bình district', '0987872187', '0', '0', 0, 9, 2, 'vn', NULL, '2018-02-08 08:24:13', '2018-02-08 08:24:13'),
(15, 'caovan@gmail.com', 'cavan@gmail.com', '$2y$10$tBgID75MmEveA87Hws3QweDsdwlkNa1K2DD3/MbFjkGa.rmVZ0MuG', 'Trần Cao Vân', '1519982428.png', 0, '1977-02-21', 'Hai Bà Trưng', '098978655', '0', '0', 0, 9, 1, 'vn', NULL, '2018-02-08 08:27:59', '2018-05-24 10:31:49'),
(16, 'consultant4', 'chicong@gmail.com', '$2y$10$FUQMPcvqpqj7NLHwjp.TdOMB8e/BaImQtwbXn.5caYvNdnZw3AgbG', 'Bùi Chí Công', NULL, 0, '1988-02-19', 'Tiền Giang', '092837234', '0', '0', 0, 4, 2, 'vn', 'fC2hhHRumvuionDZv0ku1OGp9BVBdYj2Lsg25FxwrfQuBz8pNE9yLW29KPfc', '2018-02-08 08:30:00', '2018-03-25 11:54:29'),
(17, 'minhman', 'minhman@gmail.com', '$2y$10$7e8rzcisRZkKeHbts5vh3uRCLr1BkXSEKrySVAo25oVfmmexEdtCS', 'Nguyễn Minh Mẫn', NULL, 0, '1984-02-12', 'Bình Thuận', '097879862', '0', '0', 0, 7, 2, 'vn', NULL, '2018-02-08 08:31:06', '2018-02-08 08:31:06'),
(18, 'userphuchinh', 'anhchanglangtu_1232000@yahoo.com', '$2y$10$hRzYI6lARVNkFdtSS5w5y.2OVQ/SvCn/L0Qs3rlfO8Rf52n6KC6hO', 'PHAM PHU CHINH', NULL, 0, '2018-03-02', '3232323', '01659655961', '0', '0', 1, 4, 3, 'vn', NULL, '2018-03-02 09:13:43', '2018-03-21 13:53:46'),
(19, 'pdthuy', 'thuy.pham@amagumolabs.com', '$2y$10$ntBfiantf4r/IYWCd9FVyOsGWtoJXmcjo41glUKT0kXzEU77S4BgG', 'Pham Thi Dang Thuy - Tipster', '1522731008.png', 1, '1990-10-23', NULL, '099989831', '0', '0', 0, 9, 2, 'vn', 'TEx6fWBBlS1OnjlMLNhdgWXDleOUk7WS9bRbBwRdoIuq7RZ9vilenXxuK2ne', '2018-03-09 11:27:12', '2018-04-03 04:54:11'),
(20, 'nguyenduytung', 'nguyenduytung@gmail.com', '$2y$10$d3xAPFqrhjbTBAroyXL4cuFicGhQElzieWZLP1Gv8OBm2aAL79Xv2', 'Nguyen Duy Tung', NULL, 0, '1900-01-01', NULL, NULL, '0', '0', 0, 9, 2, 'vn', 'VzTYPsvF4fVD7MEbkk3RS9cI7TA81NVyeAQ385MSMtQ8SDUmFv882WVrqAbr', '2018-03-22 08:49:37', '2018-04-02 11:09:25'),
(21, 'hoangnguyen', 'longca2004us@yahoo.com', '$2y$10$bjt8JrHxY.dBvQK9apPLZewAF6uTUHtLKsp7jJ3ksCqdU9/1Vn/Fm', 'Hoang Nguyen', 'no_image_available.jpg', 1, '2014-03-01', 'Address\r\nSaigon\r\nVietnam', '1234567890', '5', '0', 0, 9, 2, 'vn', NULL, '2018-03-23 01:33:14', '2018-06-28 10:07:31'),
(22, 'admin@amagumolabs.com', 'longca2005us@yahoo.com', '$2y$10$NUuUv.WL6sMRAsUbCm4vQuXtDzwtBKfEhuKKlVDxmTZyBM4n.4uk6', 'Long Nguyen', 'no_image_available.jpg', 0, '1960-10-21', NULL, '90940158', '0', '0', 0, 8, 2, 'vn', NULL, '2018-06-16 08:13:39', '2018-06-16 08:13:39'),
(23, 'Long Nguyen', 'phuongchi_299@yahoo.com.vn long nguyen', '$2y$10$xUfrO1FCSPs24IJ/H9FuOOGs.0Fh9SpD4YIXufV76rs2TYIJsl5NO', 'Long Nguyen', NULL, 0, '1900-01-01', NULL, NULL, '20', '0', 0, 9, 2, 'vn', 'QUeXwMQmFTO6hAPpruY08OtIJjpn3bPxu1lrGlFVotascrOrRgfaJu6PAWz3', '2018-06-17 03:50:15', '2018-06-19 03:40:05'),
(24, 'phuongchi', 'phuongchi_299@yahoo.com.vn', '$2y$10$5DOWElufSM8EjW9j7nrGT.kftsCDW/8EMsgqpk76SV7Ms.QrteRBy', NULL, NULL, 0, '1900-01-01', NULL, NULL, '0', '0', 0, 9, 2, 'vn', NULL, '2018-06-22 03:54:21', '2018-06-22 03:54:21'),
(25, 'sale01', 'sale01@gmail.com', '$2y$10$oP.A1.wWJJcVB7GruAXUYuu9oXAyoU5nNWUHfLF3s0UVsAekelWuK', 'sale01', 'no_image_available.jpg', 0, '2018-06-07', 'sdfsdsfd', '1212121212', '0', '0', 0, 3, 2, 'vn', NULL, '2018-06-25 16:36:31', '2018-06-25 16:36:31'),
(26, 'totoinsurance', 'longca1004us@yahoo.com', '$2y$10$rjMPpUrHoW1AiiQ/Rw/gdez80JJIrci4NLx1vjxUfgL0A.7wVbx9O', 'toto insurance', 'no_image_available.jpg', 0, '1957-10-21', '60 nguyen van linh, quan 7', '90940158', '0', '0', 0, 9, 2, 'vn', NULL, '2018-06-28 08:27:14', '2018-06-28 10:03:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `actions_code_unique` (`code`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluationautos`
--
ALTER TABLE `evaluationautos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `giftcategories`
--
ALTER TABLE `giftcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `giftcategories_code_unique` (`code`);

--
-- Indexes for table `gifts`
--
ALTER TABLE `gifts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gifts_category_id_foreign` (`category_id`);

--
-- Indexes for table `leadprocesses`
--
ALTER TABLE `leadprocesses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leadprocesses_lead_id_foreign` (`lead_id`),
  ADD KEY `leadprocesses_status_id_foreign` (`status_id`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `leads_email_unique` (`email`),
  ADD KEY `leads_tipster_id_foreign` (`tipster_id`),
  ADD KEY `leads_region_id_foreign` (`region_id`);

--
-- Indexes for table `logs_sent_message_templates`
--
ALTER TABLE `logs_sent_message_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_activities`
--
ALTER TABLE `log_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_code_unique` (`code`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_tipster_id_foreign` (`tipster_id`);

--
-- Indexes for table `order_gifts`
--
ALTER TABLE `order_gifts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_gifts_order_id_foreign` (`order_id`),
  ADD KEY `order_gifts_gift_id_foreign` (`gift_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_code_unique` (`code`),
  ADD KEY `permissions_action_id_foreign` (`action_id`),
  ADD KEY `permissions_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `point_histories`
--
ALTER TABLE `point_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productcategories`
--
ALTER TABLE `productcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `productcategories_code_unique` (`code`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `regions_name_unique` (`name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_code_unique` (`code`),
  ADD KEY `roles_roletype_id_foreign` (`roletype_id`);

--
-- Indexes for table `roletypes`
--
ALTER TABLE `roletypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_permissions_role_id_foreign` (`role_id`),
  ADD KEY `role_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `statuses_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `users_region_id_foreign` (`region_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `evaluationautos`
--
ALTER TABLE `evaluationautos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `giftcategories`
--
ALTER TABLE `giftcategories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `gifts`
--
ALTER TABLE `gifts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `leadprocesses`
--
ALTER TABLE `leadprocesses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `logs_sent_message_templates`
--
ALTER TABLE `logs_sent_message_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `log_activities`
--
ALTER TABLE `log_activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_gifts`
--
ALTER TABLE `order_gifts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `point_histories`
--
ALTER TABLE `point_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `productcategories`
--
ALTER TABLE `productcategories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `roletypes`
--
ALTER TABLE `roletypes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `gifts`
--
ALTER TABLE `gifts`
  ADD CONSTRAINT `gifts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `giftcategories` (`id`);

--
-- Constraints for table `leads`
--
ALTER TABLE `leads`
  ADD CONSTRAINT `leads_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`),
  ADD CONSTRAINT `leads_tipster_id_foreign` FOREIGN KEY (`tipster_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_tipster_id_foreign` FOREIGN KEY (`tipster_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_gifts`
--
ALTER TABLE `order_gifts`
  ADD CONSTRAINT `order_gifts_gift_id_foreign` FOREIGN KEY (`gift_id`) REFERENCES `gifts` (`id`),
  ADD CONSTRAINT `order_gifts_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_action_id_foreign` FOREIGN KEY (`action_id`) REFERENCES `actions` (`id`),
  ADD CONSTRAINT `permissions_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `productcategories` (`id`);

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_roletype_id_foreign` FOREIGN KEY (`roletype_id`) REFERENCES `roletypes` (`id`);

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`),
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
