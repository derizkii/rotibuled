-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2025 at 12:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `satuan_kemasan` varchar(50) DEFAULT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 0,
  `minimal_stok` int(11) NOT NULL DEFAULT 0,
  `satuan` varchar(50) NOT NULL DEFAULT 'pcs',
  `kategori` varchar(100) NOT NULL DEFAULT 'Lain-lain',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `isi_satuan` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `nama_barang`, `satuan_kemasan`, `jumlah`, `minimal_stok`, `satuan`, `kategori`, `created_at`, `updated_at`, `deleted_at`, `isi_satuan`) VALUES
(56, 'Buled Original', 'Ball', 0, 1, 'pcs', 'Roti Buled', '2025-12-18 22:49:13', '2025-12-18 22:49:13', NULL, 72),
(57, 'Buled Cokelat', 'Ball', 0, 1, 'pcs', 'Roti Buled', '2025-12-18 23:10:49', '2025-12-18 23:10:49', NULL, 72),
(58, 'Buled Keju', 'Ball', 0, 1, 'pcs', 'Roti Buled', '2025-12-18 23:11:17', '2025-12-18 23:20:59', NULL, 72),
(59, 'sdssds', 'ew', 0, 2, '2', 'Roti Buled', '2025-12-25 23:11:22', '2025-12-25 23:11:29', '2025-12-25 23:11:29', 1),
(60, 'Chocolate', 'Pack', 0, 2, 'gr', 'Minuman', '2025-12-25 23:12:42', '2025-12-26 06:44:22', NULL, 1000),
(61, 'Lemon Tea', 'Pack', 0, 2, 'gr', 'Minuman', '2025-12-25 23:13:14', '2025-12-26 06:45:16', NULL, 1000),
(62, 'Thai Tea', 'Pack', 0, 2, 'gr', 'Minuman', '2025-12-25 23:13:41', '2025-12-26 06:46:37', NULL, 1000),
(63, 'Green Tea', 'Pack', 0, 2, 'gr', 'Minuman', '2025-12-25 23:14:11', '2025-12-26 06:44:48', NULL, 1000),
(64, 'Cappucinno', 'Pack', 0, 2, 'gr', 'Minuman', '2025-12-25 23:14:32', '2025-12-26 06:44:01', NULL, 1000),
(65, 'Hazelnut Choco', 'Pack', 0, 2, 'gr', 'Minuman', '2025-12-25 23:14:50', '2025-12-26 06:45:03', NULL, 1000),
(66, 'Lychee Tea', 'Pack', 0, 1, 'gr', 'Minuman', '2025-12-25 23:15:15', '2025-12-26 06:45:29', NULL, 1000),
(67, 'Milk Tea', 'Pack', 0, 1, 'gr', 'Minuman', '2025-12-25 23:15:42', '2025-12-26 06:45:40', NULL, 1000),
(68, 'Bubble Gum', 'Pack', 0, 1, 'gr', 'Minuman', '2025-12-25 23:15:59', '2025-12-26 06:43:51', NULL, 1000),
(69, 'Taro', 'Pack', 0, 1, 'gr', 'Minuman', '2025-12-25 23:16:23', '2025-12-26 06:46:25', NULL, 1000),
(70, 'Milo', 'Pack', 0, 1, 'gr', 'Minuman', '2025-12-25 23:16:44', '2025-12-26 06:45:51', NULL, 1000),
(71, 'Red Velvet', 'Pack', 0, 1, 'gr', 'Minuman', '2025-12-25 23:17:01', '2025-12-26 06:46:14', NULL, 1000),
(72, 'Cookies & Cream', 'Pack', 0, 1, 'gr', 'Minuman', '2025-12-25 23:17:22', '2025-12-26 06:44:34', NULL, 1000),
(73, 'Susu SKM', 'Botol', 0, 5, 'ml', 'Inventory', '2025-12-25 23:18:12', '2025-12-26 06:36:12', NULL, 1000),
(74, 'Susu UHT', 'Botol', 0, 5, 'ml', 'Inventory', '2025-12-25 23:18:31', '2025-12-26 06:36:30', NULL, 1000),
(75, 'Gula Cair', 'Dus', 0, 1, 'pcs', 'Inventory', '2025-12-25 23:19:13', '2025-12-25 23:19:13', NULL, 10),
(76, 'Plastik Seal', 'Pack', 0, 1, 'pcs', 'Inventory', '2025-12-25 23:19:38', '2025-12-25 23:19:38', NULL, 100),
(77, 'Plastik Kresek 15', 'Pack', 0, 5, 'pcs', 'Inventory', '2025-12-25 23:20:53', '2025-12-26 06:16:48', NULL, 50),
(78, 'Plastik Kresek 24', 'Pack', 0, 5, 'pcs', 'Inventory', '2025-12-25 23:22:05', '2025-12-26 06:17:26', NULL, 50),
(79, 'Plastik Cup 1', 'Pack', 0, 2, 'pcs', 'Inventory', '2025-12-25 23:22:27', '2025-12-26 06:24:53', NULL, 100),
(80, 'Plastik Cup 2', 'Pack', 0, 2, 'pcs', 'Inventory', '2025-12-25 23:22:51', '2025-12-26 06:28:16', NULL, 100),
(81, 'Plastik Segitiga', 'Pack', 0, 1, 'pcs', 'Inventory', '2025-12-25 23:23:14', '2025-12-26 06:21:34', NULL, 50),
(82, 'Plastik Tangan', 'Pack', 0, 1, 'pcs', 'Inventory', '2025-12-25 23:24:28', '2025-12-26 06:29:02', NULL, 100),
(83, 'Sedotan ', 'Pack', 0, 1, 'pcs', 'Inventory', '2025-12-25 23:24:43', '2025-12-26 06:29:32', NULL, 500),
(84, 'Soft Mix Vanilla', 'Liter / Bungkus', 0, 3, 'ml', 'Inventory', '2025-12-25 23:25:26', '2025-12-26 06:32:38', NULL, 3000),
(85, 'Soft Mix Chocolate', 'Liter / Bungkus', 0, 3, 'ml', 'Inventory', '2025-12-25 23:25:52', '2025-12-26 06:30:23', NULL, 3000),
(86, 'Cone Ice Cream', 'Dus', 0, 1, 'pcs', 'Inventory', '2025-12-25 23:26:18', '2025-12-26 06:32:57', NULL, 250),
(87, 'Cup 16 oz', 'Pack', 0, 1, 'pcs', 'Inventory', '2025-12-25 23:26:40', '2025-12-25 23:26:40', NULL, 50),
(88, 'Cup 14 oz', 'Pack', 0, 1, 'pcs', 'Inventory', '2025-12-25 23:26:59', '2025-12-25 23:26:59', NULL, 50),
(89, 'Cup Polos', 'Pack', 0, 1, 'pcs', 'Inventory', '2025-12-25 23:27:22', '2025-12-25 23:27:22', NULL, 50),
(90, 'Kertas Struk Print', 'Pack', 0, 1, 'roll', 'Inventory', '2025-12-25 23:27:42', '2025-12-26 06:33:44', NULL, 10),
(91, 'Buku Nota Manual', 'pcs', 0, 1, 'pcs', 'Inventory', '2025-12-25 23:29:07', '2025-12-25 23:29:07', NULL, 1),
(92, 'Strawberry Jam ', 'Toples', 0, 1, 'ml', 'Inventory', '2025-12-25 23:36:17', '2025-12-25 23:36:17', NULL, 2300),
(93, 'Chocolate Saus ', 'Toples', 0, 1, 'ml', 'Inventory', '2025-12-25 23:37:40', '2025-12-25 23:37:40', NULL, 1000),
(94, 'Mango Jam ', 'Botol', 0, 1, 'ml', 'Inventory', '2025-12-25 23:38:03', '2025-12-25 23:38:03', NULL, 2300),
(95, 'Box Roti Ice MIX BULED', 'Pack', 0, 1, 'pcs', 'Inventory', '2025-12-25 23:38:27', '2025-12-25 23:38:27', NULL, 50),
(96, 'Lakban Kecil', 'pcs', 0, 1, 'pcs', 'Inventory', '2025-12-25 23:38:45', '2025-12-25 23:38:45', NULL, 1),
(97, 'Topping Meises', 'Pack', 0, 1, 'gr', 'Inventory', '2025-12-25 23:39:17', '2025-12-26 06:38:19', NULL, 500),
(98, 'Topping Keju Batang', 'pcs', 0, 1, 'gr', 'Inventory', '2025-12-25 23:39:48', '2025-12-26 06:39:01', NULL, 250),
(99, 'Plastik 2 Liter', 'Bungkus', 0, 1, 'pcs', 'Inventory', '2025-12-25 23:41:56', '2025-12-25 23:41:56', NULL, 50),
(100, 'Pulpen', 'pcs', 0, 1, 'pcs', 'Inventory', '2025-12-25 23:42:16', '2025-12-25 23:42:16', NULL, 1),
(101, 'Sendok Kecil', 'Pack', 0, 1, 'pcs', 'Inventory', '2025-12-25 23:42:52', '2025-12-26 06:39:37', NULL, 100),
(102, 'Sendok Besar', 'Pack', 0, 1, 'pcs', 'Inventory', '2025-12-25 23:43:10', '2025-12-26 06:39:54', NULL, 50),
(103, 'Vanilla Latte', 'Pack', 0, 1, 'gr', 'Inventory', '2025-12-25 23:43:36', '2025-12-26 06:40:29', NULL, 1000),
(104, 'ChocoMalt', 'Pack', 0, 1, 'gr', 'Inventory', '2025-12-25 23:43:57', '2025-12-26 06:40:46', NULL, 1000),
(105, 'Teh Tarik', 'Pack', 0, 1, 'gr', 'Inventory', '2025-12-25 23:45:09', '2025-12-26 06:41:05', NULL, 1000),
(106, 'Pelumas Es Krim', 'pcs', 0, 1, 'gr', 'Inventory', '2025-12-25 23:45:22', '2025-12-26 06:41:29', NULL, 50),
(107, 'Tutup Cup Datar', 'Pack', 0, 1, 'pcs', 'Inventory', '2025-12-25 23:45:43', '2025-12-25 23:45:43', NULL, 50),
(108, 'Tutup Cup Datar Cembung', 'Pack', 0, 1, 'pcs', 'Inventory', '2025-12-25 23:46:03', '2025-12-25 23:46:03', NULL, 50),
(109, 'Kertas Cone', 'Pack', 0, 1, 'pcs', 'Inventory', '2025-12-25 23:46:17', '2025-12-25 23:46:17', NULL, 50),
(110, 'Ovaltine', 'Pack', 0, 1, 'gr', 'Minuman', '2025-12-25 23:55:25', '2025-12-26 06:46:02', NULL, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-12-02-000001', 'App\\Database\\Migrations\\CreateItems', 'default', 'App', 1764653987, 1),
(2, '2025-12-02-000002', 'App\\Database\\Migrations\\CreateStockLogs', 'default', 'App', 1764653987, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock_logs`
--

CREATE TABLE `stock_logs` (
  `id` int(11) UNSIGNED NOT NULL,
  `item_id` int(11) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `stok_awal` int(11) DEFAULT 0,
  `keluar` int(11) NOT NULL DEFAULT 0,
  `masuk` int(11) NOT NULL DEFAULT 0,
  `jumlah` int(11) NOT NULL DEFAULT 0,
  `status` enum('cukup','kurang','kosong') NOT NULL DEFAULT 'cukup',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_logs`
--

INSERT INTO `stock_logs` (`id`, `item_id`, `tanggal`, `stok_awal`, `keluar`, `masuk`, `jumlah`, `status`, `created_at`, `updated_at`) VALUES
(197, 56, '2025-12-19', 72, 0, 0, 72, 'cukup', '2025-12-19 01:03:03', '2025-12-19 02:54:49'),
(198, 57, '2025-12-19', 72, 40, 0, 32, 'kurang', '2025-12-19 01:03:23', '2025-12-19 01:56:20'),
(199, 58, '2025-12-19', 72, 72, 0, 0, 'kosong', '2025-12-19 01:03:37', '2025-12-19 01:59:01'),
(200, 57, '2025-12-20', 32, 0, 40, 72, 'cukup', '2025-12-19 01:59:40', '2025-12-26 06:11:57'),
(201, 56, '2025-12-20', 72, 0, 0, 72, 'cukup', '2025-12-19 01:59:59', '2025-12-19 02:56:35'),
(202, 58, '2025-12-20', 0, 0, 72, 72, 'cukup', '2025-12-19 02:09:56', '2025-12-19 02:09:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` varchar(5) NOT NULL,
  `nm_user` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nm_user`, `username`, `password`, `level`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
('AD001', 'Admin ', 'admin', '$2y$10$3A4Zf1SArtavmJgh5zHwKeTCJEuMS77kdKHogH0tEHXdEG2Ki62iK', 'Admin', 'Aktif', '2021-05-28 14:36:00', '2025-12-16 13:54:12', NULL),
('AD002', 'Kasir DeMarket', 'kasir', '$2y$10$h0jqQBYmpKPUT6PnHk20f.CuvnPT2kVVzP3K5.iyXoAP0ufGQ1n1O', 'Owner', 'Aktif', '2021-06-21 12:50:15', '2025-12-16 13:53:59', '2025-12-16 13:53:59'),
('AD003', 'Dias', 'diasdwig@gmail.com', '$2y$10$HF856VsRkYTqYXbJ.WclyOa4wL03akCfRMK9vcGTxkB0Qd70Ld2rS', 'Admin', 'Aktif', '2025-12-15 19:56:44', '2025-12-19 02:59:57', '2025-12-19 02:59:57'),
('AD004', 'Owner', 'owner', '$2y$10$R4dFF0kdoNx8xbUMGojy7ulUB38y7e.ApR.D.01GEO25NTE0O81di', 'Owner', 'Aktif', '2025-12-16 11:43:12', '2025-12-16 11:43:12', NULL),
('AD005', 'Farid Muttaqin', 'farid', '$2y$10$D38AF4ZB6QER6v.vHcyLVujFHpuWzotXNacUJc550SnxmQTz2CZxu', 'Owner', 'Aktif', '2025-12-26 06:48:12', '2025-12-26 06:48:12', NULL),
('AD006', 'Dede Rizki', 'dede', '$2y$10$Rdw9Mg/iXpk7U5RkxoUU9eAzO0N/oqS/F4/1R.rXYjfhXc45xjySK', 'Admin', 'Aktif', '2025-12-26 06:48:34', '2025-12-26 06:48:34', NULL);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `stock_logs`
--
ALTER TABLE `stock_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_logs_item_id_foreign` (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_logs`
--
ALTER TABLE `stock_logs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `stock_logs`
--
ALTER TABLE `stock_logs`
  ADD CONSTRAINT `stock_logs_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
