-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2023 at 07:45 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `debt`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cust_id` int(11) NOT NULL,
  `u_id` varchar(20) NOT NULL,
  `name` varchar(150) NOT NULL,
  `number` varchar(20) NOT NULL,
  `gender` char(1) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `added_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cust_id`, `u_id`, `name`, `number`, `gender`, `address`, `added_at`, `updated_at`) VALUES
(2, '0258741036', 'Collins Obeng', '0114477852', 'F', 'away bus', '2023-05-25 11:23:28', NULL),
(4, '0987766554', 'Grace Davis Mafia', '0558997744', 'F', 'RMU', '2023-05-25 12:22:29', NULL),
(6, '0123456789', 'Church Bell', '6635222531', 'F', 'church girl', '2023-05-25 12:22:29', NULL),
(10, '0249985632', 'Debbie  Tsekpo', '0557841236', 'M', 'Trasaco Estate', '2023-05-25 18:29:33', NULL),
(11, '0258741036', 'Deborah Frema Ababio', '2245778432', 'F', 'Devtracco Estate', '2023-05-25 18:29:33', NULL),
(17, '3322114455', 'Benjamin Ansu', '4125307896', 'M', 'Carpenter', '2023-05-26 12:37:48', NULL),
(19, '3322114455', 'Aunty Bee', '6320147898', 'F', 'enkasa', '2023-05-26 12:59:19', NULL),
(20, '3322114455', 'Joshua Salifu Ali', '0241597536', 'M', 'Teshie Estate', '2023-05-31 17:12:17', NULL),
(21, '3322114455', 'Nii Bodu ', '0547418523', 'M', 'mantse avenue', '2023-05-31 17:19:36', NULL),
(22, '0541236547', 'Kofi Gator', '0241000000', 'M', 'Dubai', '2023-06-01 09:48:56', NULL),
(23, '3322114455', 'Prince David Akoto', '0547240625', 'M', 'gx00545', '2023-05-31 20:05:07', NULL),
(25, '0541236547', 'Stephanie Asare', '0201598741', 'F', 'Kumasi', '2023-06-01 09:48:56', NULL),
(27, '0541236547', 'Delphin Opare', '0125463333', 'F', 'Osu', '2023-06-02 09:30:51', NULL),
(28, '0541236547', 'Amelia Darko', '0578965413', 'F', 'rmue', '2023-06-02 14:06:22', NULL),
(29, '0541236547', 'Kofi Chen', '025479632', 'M', '2 wee Lane Crescent', '2023-06-02 14:25:47', NULL),
(30, '0541236547', 'Abigail Osei', '0576767621', 'F', 'Madina', '2023-06-03 19:36:51', NULL),
(31, '0000000000', 'kaklo shi', '0212325241', 'F', 'Yah', '2023-06-08 09:50:53', NULL),
(32, '0541236547', 'Francis Arthur', '0214521452', 'M', 'mamprobi', '2023-06-12 22:16:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `u_id` varchar(20) DEFAULT NULL,
  `item_name` varchar(150) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `added_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `u_id`, `item_name`, `description`, `unit_price`, `quantity`, `added_at`, `updated_at`) VALUES
(2, '3322114455', 'Don Simon', 'Large', '22.95', 24, '2023-05-26 18:36:24', NULL),
(3, '3322114455', 'Dell laptop', 'x540', '12000.00', 6, '2023-05-31 16:41:49', NULL),
(4, '3322114455', 'PS5', 'UK model', '15000.00', 5, '2023-05-31 16:43:39', NULL),
(5, '3322114455', 'Ceres', 'Large', '20.52', 7, '2023-05-31 16:47:54', NULL),
(7, '3322114455', 'Projector', 'Epson', '2400.16', 3, '2023-05-31 16:54:57', NULL),
(8, '3322114455', 'Fan', 'Table top', '135.40', 5, '2023-06-01 10:18:57', NULL),
(10, '0541236547', 'Pepsi', 'large', '7.80', 50, '2023-06-02 11:41:48', NULL),
(12, '0541236547', 'Nokia', 'x2310', '62.30', 20, '2023-06-02 15:10:10', NULL),
(13, '0541236547', 'Xingher Singlets', 'Men Singlets', '20.00', 15, '2023-06-02 15:38:30', NULL),
(14, '0541236547', 'jkghsaiu diusa ', 'kljhihsbdfioahio', '90.00', 9798, '2023-06-02 19:17:56', NULL),
(15, '0541236547', 'oiahod a', 'ljkhbkandskl', '67.00', 45, '2023-06-02 19:18:10', NULL),
(16, '0541236547', 'key-soap', 'detergent', '27.08', 15, '2023-06-02 19:18:24', NULL),
(18, '0000000000', 'voltic', 'bottle water', '20.12', 5, '2023-06-08 09:52:45', NULL),
(19, '0541236547', 'Phone cover', 'iphone ', '1500.00', 10, '2023-06-12 22:17:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `log_id` int(11) NOT NULL,
  `u_id` varchar(20) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`log_id`, `u_id`, `username`, `password`) VALUES
(1, '0547240625', 'jeongprince@yahoo.com', '$2y$10$NihPuQvgGaQjcTTYDWYQtuwi5Z0y7HsCfIAWAt1qDoa'),
(2, '0987766554', 'collinobeng@gmail.com', '$2y$10$3LrAzNv1NWuKK7iuG0a7MOMsKbZAn1DvAM7Id/MZSnk'),
(3, '0123456789', 'roro@y.com', '$2y$10$IXMkyLBb3XP6Taq3/NyuNelnlz6M.kIIi6sPf6lc9lY'),
(4, '0258741036', 'philipo@gmail.com', '$2y$10$yhKDBsOPbmQQYPFZ3xCvGusWHu19dT1iCyIjX22dGR3'),
(5, '3322114455', 'nuto@123.com', '$2y$10$YEmgLzcktEI3Hxdsy1dBueRppBoaKnjVyIq6siXSsIQ'),
(6, '0145632014', 'francisratty@gmail.com', '$2y$10$Myo7I.sqxz93irrYuYmLeudVNpdy7Zj7f1s7jTAxdBo'),
(7, '0247896541', 'church@gh.com', '$2y$10$xMFM.ziqL3pWYCaHUD.dVeWWEfP1ZVDfasNZ.sfilGu'),
(8, '0249985632', 'derrickco@gmail.com', '$2y$10$Q/TuYuusxjpIlIaFOTr3eu4F5hCMes4dSuTp.uvb9BI'),
(9, '0541236547', 'p@gmail.com', '$2y$10$aucSDvsyfjLTgbWG7Y3Ii.pDRRMe4u9HWpmHEKMsSEhcKxEYRiMXy'),
(10, '0000000000', 'daza@gmail.com', '$2y$10$22lwza3IDwVCGcMIwx0VoOKKI4nozkZtScOXACEaUYNbdQZvQ8l1.');

-- --------------------------------------------------------

--
-- Table structure for table `ordered_items`
--

CREATE TABLE `ordered_items` (
  `order_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `user_id` varchar(20) DEFAULT NULL,
  `item_name` varchar(150) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `added_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `pay_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `amount` decimal(6,2) NOT NULL,
  `mode` varchar(20) NOT NULL,
  `added_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `quantity` int(20) NOT NULL,
  `unit_price` decimal(6,2) NOT NULL,
  `total` decimal(6,2) GENERATED ALWAYS AS (`quantity` * `unit_price`) STORED,
  `added_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
ALTER TABLE sales ADD COLUMN user_id VARCHAR(20) NOT NULL AFTER cust_id,
ADD CONSTRAINT fk_sales_user FOREIGN KEY (user_id) REFERENCES users(phone_number);
-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `phone_number` varchar(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `full_name` varchar(100) GENERATED ALWAYS AS (concat(`first_name`,' ',`last_name`)) STORED,
  `gender` char(1) NOT NULL,
  `email` varchar(50) NOT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `added_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`phone_number`, `first_name`, `last_name`, `gender`, `email`, `photo`, `added_at`, `updated_at`) VALUES
('0000000000', 'da', 'za', 'F', 'daza@gmail.com', NULL, '2023-06-08 09:47:51', NULL),
('0123456789', 'ro', 'ro', 'F', 'roro@y.com', NULL, '2023-05-18 20:34:04', NULL),
('0145632014', 'francis ', 'ratty', 'M', 'francisratty@gmail.com', NULL, '2023-05-25 13:27:11', NULL),
('0247896541', 'church', 'bell', 'F', 'church@gh.com', NULL, '2023-05-25 13:45:03', NULL),
('0249985632', 'Derrick Nii', 'Adjetey Adjei', 'M', 'derrickco@gmail.com', NULL, '2023-05-25 18:16:25', NULL),
('0258741036', 'philip', 'nana', 'M', 'philipo@gmail.com', NULL, '2023-05-24 10:27:14', NULL),
('0541236547', 'prince', 'david', 'M', 'p@gmail.com', NULL, '2023-05-31 19:32:42', NULL),
('0547240625', 'Prince ', 'David', 'M', 'jeongprince@yahoo.com', NULL, '2023-05-09 08:50:35', NULL),
('0987766554', 'Collins ', 'Obeng', 'M', 'collinobeng@gmail.com', NULL, '2023-05-09 09:52:56', NULL),
('3322114455', 'mavis ', 'nutortsi', 'F', 'nuto@123.com', NULL, '2023-05-24 10:30:11', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cust_id`),
  ADD KEY `FK_u_id1` (`u_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `FK_u_id2` (`u_id`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `FK_u_id` (`u_id`);

--
-- Indexes for table `ordered_items`
--
ALTER TABLE `ordered_items`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `FK_cust_id2` (`cust_id`),
  ADD KEY `FK_u_id3` (`user_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `FK_cust_id` (`cust_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `FK_item_id1` (`item_id`),
  ADD KEY `FK_cust_id1` (`cust_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`phone_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ordered_items`
--
ALTER TABLE `ordered_items`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `FK_u_id1` FOREIGN KEY (`u_id`) REFERENCES `users` (`phone_number`) ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `FK_u_id2` FOREIGN KEY (`u_id`) REFERENCES `users` (`phone_number`) ON UPDATE CASCADE;

--
-- Constraints for table `logins`
--
ALTER TABLE `logins`
  ADD CONSTRAINT `FK_u_id` FOREIGN KEY (`u_id`) REFERENCES `users` (`phone_number`) ON UPDATE CASCADE;

--
-- Constraints for table `ordered_items`
--
ALTER TABLE `ordered_items`
  ADD CONSTRAINT `FK_cust_id2` FOREIGN KEY (`cust_id`) REFERENCES `customers` (`cust_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_u_id3` FOREIGN KEY (`user_id`) REFERENCES `users` (`phone_number`) ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `FK_cust_id` FOREIGN KEY (`cust_id`) REFERENCES `customers` (`cust_id`) ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `FK_cust_id1` FOREIGN KEY (`cust_id`) REFERENCES `customers` (`cust_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_item_id1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
