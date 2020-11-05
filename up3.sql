-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2020 at 08:08 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `up3`
--

-- --------------------------------------------------------

--
-- Table structure for table `distribusi`
--

CREATE TABLE `distribusi` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_material_distribusi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satuan_distribusi` enum('meter','unit','buah') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_material_distribusi` enum('app','kabel','trafo','tiang_beton','material_pendukung') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga_satuan_dist` bigint(22) DEFAULT NULL,
  `asuransi_dan_transportasi_dist` bigint(22) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `distribusi`
--

INSERT INTO `distribusi` (`id`, `nama_material_distribusi`, `satuan_distribusi`, `jenis_material_distribusi`, `harga_satuan_dist`, `asuransi_dan_transportasi_dist`, `created_at`, `updated_at`) VALUES
(3, 'PHBTR Pasangan Luar PL-250-2-LBS', 'buah', 'material_pendukung', 10000, 110, '2020-01-15 22:14:47', '2020-01-23 08:25:57'),
(4, 'LVSB;DIST;3P;380V;250A;2LINE;OD', 'buah', 'material_pendukung', NULL, NULL, '2020-01-15 22:47:34', '2020-01-15 22:47:34');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_12_18_035002_create_customers_table', 1),
(4, '2018_12_18_035015_create_sales_table', 1),
(5, '2018_12_18_035038_create_suppliers_table', 1),
(6, '2018_12_18_041830_create_categories_table', 1),
(7, '2018_12_18_042809_create_products_table', 1),
(8, '2018_12_18_043146_create_product_masuk_table', 1),
(9, '2018_12_18_043233_create_product_keluar_table', 1),
(10, '2018_12_19_044911_add_field_role_to_table_users', 1);

-- --------------------------------------------------------

--
-- Table structure for table `niagas`
--

CREATE TABLE `niagas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_material_niaga` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satuan_niaga` enum('meter','unit','buah') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_niaga` date DEFAULT NULL,
  `harga_satuan_niaga` bigint(20) DEFAULT NULL,
  `transportasi_dan_asuransi_niaga` bigint(20) DEFAULT NULL,
  `no_spb_niaga` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pabrikan_niaga` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prk_niaga` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_material_niaga` enum('app','trafo','kabel','tiang_beton','material_pendukung') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `niagas`
--

INSERT INTO `niagas` (`id`, `nama_material_niaga`, `satuan_niaga`, `tanggal_niaga`, `harga_satuan_niaga`, `transportasi_dan_asuransi_niaga`, `no_spb_niaga`, `pabrikan_niaga`, `prk_niaga`, `jenis_material_niaga`, `created_at`, `updated_at`) VALUES
(4, 'Lemari APP Pengukuran Langsung Tanpa MCB', 'buah', NULL, 2400000, 286500, NULL, NULL, NULL, 'app', '2020-01-15 22:28:17', '2020-01-15 22:28:17'),
(5, 'Transformator', 'buah', NULL, 12000000, 1200, NULL, NULL, NULL, 'trafo', '2020-01-23 21:17:38', '2020-01-23 21:17:48');

-- --------------------------------------------------------

--
-- Table structure for table `pabrikan`
--

CREATE TABLE `pabrikan` (
  `id` int(10) UNSIGNED NOT NULL,
  `pabrikan_mstr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pabrikan`
--

INSERT INTO `pabrikan` (`id`, `pabrikan_mstr`, `created_at`, `updated_at`) VALUES
(1, 'PT. Ega Tekelindo Prima', NULL, NULL),
(3, 'PT. Ulusoy Electric Industri', '2020-01-15 21:03:51', '2020-01-15 21:10:09');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penetapan_dist`
--

CREATE TABLE `penetapan_dist` (
  `id` int(11) UNSIGNED NOT NULL,
  `prk_id` int(10) UNSIGNED DEFAULT NULL,
  `distribusi_id` int(10) UNSIGNED DEFAULT NULL,
  `tanggal_penetapan_dist` date DEFAULT NULL,
  `total_penetapan_dist` bigint(22) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prk`
--

CREATE TABLE `prk` (
  `id` int(10) UNSIGNED NOT NULL,
  `noPrk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prk`
--

INSERT INTO `prk` (`id`, `noPrk`, `created_at`, `updated_at`) VALUES
(1, 'PRK.2019.DJBT.18.001', '2020-01-15 21:27:20', '2020-01-15 21:35:02'),
(3, 'PRK.2019.DJBT.18.002', '2020-01-16 00:43:26', '2020-01-16 00:43:26');

-- --------------------------------------------------------

--
-- Table structure for table `rkap_dist`
--

CREATE TABLE `rkap_dist` (
  `id` int(11) UNSIGNED NOT NULL,
  `prk_id` int(10) UNSIGNED DEFAULT NULL,
  `distribusi_id` int(10) UNSIGNED DEFAULT NULL,
  `tanggal_rkap_dist` date DEFAULT NULL,
  `total_rkap_dist` bigint(22) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rkap_dist`
--

INSERT INTO `rkap_dist` (`id`, `prk_id`, `distribusi_id`, `tanggal_rkap_dist`, `total_rkap_dist`, `created_at`, `updated_at`) VALUES
(3, 1, 4, '2020-01-23', 125, '2020-01-23 07:10:28', '2020-01-23 07:10:28'),
(4, 3, 3, '2020-01-23', 124, '2020-01-23 08:24:00', '2020-01-23 08:24:00');

-- --------------------------------------------------------

--
-- Table structure for table `rkap_niaga`
--

CREATE TABLE `rkap_niaga` (
  `id` int(11) UNSIGNED NOT NULL,
  `prk_id` int(10) UNSIGNED DEFAULT NULL,
  `niaga_id` int(10) UNSIGNED DEFAULT NULL,
  `tanggal_rkap_niaga` date DEFAULT NULL,
  `total_rkap_niaga` bigint(22) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spb`
--

CREATE TABLE `spb` (
  `id` int(10) UNSIGNED NOT NULL,
  `no_spb_mstr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spb`
--

INSERT INTO `spb` (`id`, `no_spb_mstr`, `created_at`, `updated_at`) VALUES
(2, '4729/DAN.02.03/DIST-JATIM/2019', '2020-01-15 21:53:28', '2020-01-15 21:53:28');

-- --------------------------------------------------------

--
-- Table structure for table `spb_dist`
--

CREATE TABLE `spb_dist` (
  `id` int(11) UNSIGNED NOT NULL,
  `prk_id` int(10) UNSIGNED DEFAULT NULL,
  `distribusi_id` int(10) UNSIGNED DEFAULT NULL,
  `pabrikan_id` int(10) UNSIGNED DEFAULT NULL,
  `spb_id` int(10) UNSIGNED DEFAULT NULL,
  `tanggal_spb_dist` date DEFAULT NULL,
  `total_spb_dist` bigint(22) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spb_dist`
--

INSERT INTO `spb_dist` (`id`, `prk_id`, `distribusi_id`, `pabrikan_id`, `spb_id`, `tanggal_spb_dist`, `total_spb_dist`, `created_at`, `updated_at`) VALUES
(3, 3, 3, 3, 2, '2020-01-31', 111, '2020-01-24 07:10:42', '2020-01-24 07:10:42'),
(4, 1, 4, 1, 2, '2020-01-25', 111, '2020-01-24 22:04:41', '2020-01-24 22:04:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` enum('admin','perencanaan','konstruksi') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `gambar`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Arcellino Ifano', 'admin123', 'admin@gmail.com', '$2y$10$v4afp5aHtf7jo69kNDI7EuSOYYFSgx8JMOJWWZM3YKngQriNhrmRO', '56356-2019-12-20-13-28-21.jpg', 'admin', 'ZrPQbLyEgtN1XybOxMdJj1l9lfWN7fOpuppcdHF99jTtTUjijIyohkld8ysF', '2019-11-27 06:36:40', '2020-01-06 18:41:50'),
(9, 'perencanaan-up3 Jember', 'perencanaan-up3', 'perencanaan-up3@gmail.com', '$2y$10$Gn1y7NBB6m7mAznSv6RzJOcGoHgvzSLAnfIQPbSx5rfJGUDzGxPYq', NULL, 'perencanaan', 'vTkoe6Msqpw4QNiy5O9UtJcCu3j9ccZEMmPFD2TLx3gbEyau8cCelmfXutOJ', '2020-01-09 19:18:32', '2020-01-09 19:18:32'),
(10, 'jaringan-up3 jember', 'jaringan-up3', 'jaringan-up3@gmail.com', '$2y$10$xze/53kvVv.jtmtSitZi0.uiBVvZjjzbjx19JkCwOyM6fGHhTSlg.', NULL, '', 'zilKLaJgwrzrJUWtIn8I4xLEHOpGRJLX2R2HDBbF9QZbwbvzSV0cjxYWhJza', '2020-01-09 19:19:31', '2020-01-09 19:19:31'),
(11, 'gudang-up3 jember', 'gudangs-up3', 'gudangs-up3@gmail.com', '$2y$10$AgRYq/YhX3XxC3vP4sHIQuc61E/yJNVd.0Dc6AxMPHmFT2y2tZXee', NULL, '', 'sJD6GAfQK0egNONen2NFvypDZKYdsBoDB8nTvNqdWZMbbCgMvAlez9JwfpOZ', '2020-01-09 19:20:26', '2020-01-09 19:21:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `distribusi`
--
ALTER TABLE `distribusi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `niagas`
--
ALTER TABLE `niagas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pabrikan`
--
ALTER TABLE `pabrikan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `penetapan_dist`
--
ALTER TABLE `penetapan_dist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prk_id` (`prk_id`),
  ADD KEY `distribusi_id` (`distribusi_id`);

--
-- Indexes for table `prk`
--
ALTER TABLE `prk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rkap_dist`
--
ALTER TABLE `rkap_dist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prk_id` (`prk_id`),
  ADD KEY `distribusi_id` (`distribusi_id`);

--
-- Indexes for table `rkap_niaga`
--
ALTER TABLE `rkap_niaga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prk_id` (`prk_id`),
  ADD KEY `niaga_id` (`niaga_id`);

--
-- Indexes for table `spb`
--
ALTER TABLE `spb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spb_dist`
--
ALTER TABLE `spb_dist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prk_id` (`prk_id`),
  ADD KEY `distribusi_id` (`distribusi_id`),
  ADD KEY `spb_id` (`spb_id`),
  ADD KEY `pabrikan_id` (`pabrikan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `distribusi`
--
ALTER TABLE `distribusi`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `niagas`
--
ALTER TABLE `niagas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pabrikan`
--
ALTER TABLE `pabrikan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `penetapan_dist`
--
ALTER TABLE `penetapan_dist`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prk`
--
ALTER TABLE `prk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rkap_dist`
--
ALTER TABLE `rkap_dist`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rkap_niaga`
--
ALTER TABLE `rkap_niaga`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `spb`
--
ALTER TABLE `spb`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `spb_dist`
--
ALTER TABLE `spb_dist`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penetapan_dist`
--
ALTER TABLE `penetapan_dist`
  ADD CONSTRAINT `penetapan_dist_ibfk_1` FOREIGN KEY (`prk_id`) REFERENCES `prk` (`id`),
  ADD CONSTRAINT `penetapan_dist_ibfk_2` FOREIGN KEY (`distribusi_id`) REFERENCES `distribusi` (`ID`);

--
-- Constraints for table `rkap_dist`
--
ALTER TABLE `rkap_dist`
  ADD CONSTRAINT `rkap_dist_ibfk_1` FOREIGN KEY (`prk_id`) REFERENCES `prk` (`id`),
  ADD CONSTRAINT `rkap_dist_ibfk_2` FOREIGN KEY (`distribusi_id`) REFERENCES `distribusi` (`ID`);

--
-- Constraints for table `rkap_niaga`
--
ALTER TABLE `rkap_niaga`
  ADD CONSTRAINT `rkap_niaga_ibfk_1` FOREIGN KEY (`prk_id`) REFERENCES `prk` (`id`),
  ADD CONSTRAINT `rkap_niaga_ibfk_2` FOREIGN KEY (`niaga_id`) REFERENCES `niagas` (`id`);

--
-- Constraints for table `spb_dist`
--
ALTER TABLE `spb_dist`
  ADD CONSTRAINT `spb_dist_ibfk_1` FOREIGN KEY (`prk_id`) REFERENCES `prk` (`id`),
  ADD CONSTRAINT `spb_dist_ibfk_2` FOREIGN KEY (`distribusi_id`) REFERENCES `distribusi` (`ID`),
  ADD CONSTRAINT `spb_dist_ibfk_3` FOREIGN KEY (`spb_id`) REFERENCES `spb` (`id`),
  ADD CONSTRAINT `spb_dist_ibfk_4` FOREIGN KEY (`pabrikan_id`) REFERENCES `pabrikan` (`id`),
  ADD CONSTRAINT `spb_dist_ibfk_5` FOREIGN KEY (`pabrikan_id`) REFERENCES `pabrikan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
