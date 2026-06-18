-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2025 at 10:40 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `merge`
--

-- --------------------------------------------------------

--
-- Table structure for table `invdescs`
--

CREATE TABLE `invdescs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `inv_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invdescs`
--

INSERT INTO `invdescs` (`id`, `note`, `type`, `amount`, `user_id`, `inv_id`, `created_at`, `updated_at`) VALUES
(9, NULL, '0', 1000, 6, 1, '2025-12-09 08:50:39', '2025-12-09 08:50:39'),
(10, NULL, '1', 100, 6, 1, '2025-12-09 08:51:59', '2025-12-09 08:51:59'),
(11, 'ซื้อข้า่วแจก', '1', 400, 6, 1, '2025-12-09 08:58:56', '2025-12-09 08:58:56'),
(12, 'เลี้ยงสาว', '1', 50, 6, 1, '2025-12-09 09:01:27', '2025-12-09 09:01:27'),
(13, NULL, '1', 500, 6, 1, '2025-12-09 09:01:42', '2025-12-09 09:01:42'),
(14, NULL, '1', 400, 6, 1, '2025-12-09 09:02:03', '2025-12-09 09:02:03'),
(15, NULL, '1', 10, 1, 1, '2025-12-09 09:02:45', '2025-12-09 09:02:45'),
(16, NULL, '1', 10, 1, 2, '2025-12-09 09:04:22', '2025-12-09 09:04:22'),
(17, NULL, '0', 10, 7, 2, '2025-12-09 09:04:32', '2025-12-09 09:04:32'),
(18, NULL, '1', 10, 7, 2, '2025-12-09 09:04:47', '2025-12-09 09:04:47'),
(19, NULL, '0', 1, 3, 3, '2025-12-09 09:05:31', '2025-12-09 09:05:31'),
(20, NULL, '1', 1, 12, 3, '2025-12-09 09:06:09', '2025-12-09 09:06:09'),
(21, NULL, '0', 10, 2, 3, '2025-12-09 09:06:41', '2025-12-09 09:06:41'),
(22, NULL, '1', 10, 5, 3, '2025-12-09 09:07:06', '2025-12-09 09:07:06'),
(23, NULL, '1', 1, 3, 3, '2025-12-09 09:07:25', '2025-12-09 09:07:25');

-- --------------------------------------------------------

--
-- Table structure for table `invowners`
--

CREATE TABLE `invowners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `inv_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invowners`
--

INSERT INTO `invowners` (`id`, `amount`, `inv_id`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 50, 1, 6, '2025-12-09 08:50:39', '2025-12-09 09:02:03'),
(4, 10, 1, 1, '2025-12-09 09:02:45', '2025-12-09 09:02:45'),
(5, 0, 2, 7, '2025-12-09 09:04:32', '2025-12-09 09:04:47'),
(6, 0, 3, 3, '2025-12-09 09:05:31', '2025-12-09 09:07:25'),
(7, 10, 3, 2, '2025-12-09 09:06:41', '2025-12-09 09:06:41');

-- --------------------------------------------------------

--
-- Table structure for table `invs`
--

CREATE TABLE `invs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `desc` varchar(255) NOT NULL,
  `imgpath` varchar(255) DEFAULT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invs`
--

INSERT INTO `invs` (`id`, `desc`, `imgpath`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'เงินสด', '1765262765.jpg', 0, '2025-12-09 06:46:05', '2025-12-09 06:46:05'),
(2, 'กล่องตีอาวุธ', '1765262784.jpg', 0, '2025-12-09 06:46:24', '2025-12-09 06:46:24'),
(3, 'เหรียญแก๊ง', '1765263607.jpg', 0, '2025-12-09 06:47:36', '2025-12-09 07:23:25'),
(4, 'ไอติมหมี', '1765265025.jpg', 0, '2025-12-09 07:23:45', '2025-12-09 07:23:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invdescs`
--
ALTER TABLE `invdescs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invowners`
--
ALTER TABLE `invowners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invs`
--
ALTER TABLE `invs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invdescs`
--
ALTER TABLE `invdescs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `invowners`
--
ALTER TABLE `invowners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `invs`
--
ALTER TABLE `invs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
