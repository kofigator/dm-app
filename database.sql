-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2023 at 01:45 AM
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
  `city` varchar(50) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `added_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cust_id`, `u_id`, `name`, `number`, `gender`, `city`, `address`, `added_at`, `updated_at`) VALUES
(3, '0555555555', 'Prince', '0214521451', 'F', 'Accra', 'Spintex', '2023-05-31 20:10:12', NULL),
(4, '0555555555', 'Ratty', '0124563214', 'M', 'Nungua', 'RMU', '2023-06-14 02:33:05', NULL),
(7, '0555555555', 'Ratty', '0124563215', 'M', 'Nungua', 'RMU', '2023-06-14 02:53:24', NULL),
(8, '0555555555', 'Ratty', '0124563216', 'M', 'Osu', 'RMU', '2023-06-14 02:53:45', NULL),
(9, '0555555555', 'asba', '0124563217', 'M', 'Osu', 'Osu Police Station', '2023-06-14 02:57:22', NULL),
(10, '0555555555', 'Sulley', '0125632123', 'M', 'Lapaz', 'Hannah Road 209 Jn', '2023-06-14 03:47:42', NULL),
(11, '0541236547', 'Collins Obeng', '0247856932', 'M', 'Kumasi', 'Hse No. 9', '2023-06-19 20:01:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `u_id` varchar(20) DEFAULT NULL,
  `item_name` varchar(150) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `cost_price` decimal(10,2) DEFAULT NULL,
  `unit_price` decimal(6,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `added_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `profit` decimal(10,2) GENERATED ALWAYS AS (`unit_price` - `cost_price`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `u_id`, `item_name`, `description`, `cost_price`, `unit_price`, `quantity`, `added_at`, `updated_at`) VALUES
(2, '0555555555', 'Shirt', 'Short sleeve', '40.00', '52.00', 10, '2023-06-07 19:28:52', NULL),
(3, '0555555555', 'Spectacles', 'Blue shades specs', '98.00', '150.00', 3, '2023-06-07 19:31:07', NULL),
(7, '0555555555', 'adfasdas', 'asdada', '8.00', '17.00', 4, '2023-06-13 21:07:34', NULL),
(8, '0555555555', 'Gun powder', 'Gun powder for original guns', '254.00', '350.00', 5, '2023-06-13 21:20:13', NULL),
(9, '0541236547', 'Digestive Biscuit', 'small', '2.50', '4.00', 10, '2023-06-19 20:12:04', NULL),
(10, '0541236547', 'Bel-cola', 'large', '2.20', '5.20', 15, '2023-06-19 22:04:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `log_id` int(11) NOT NULL,
  `u_id` varchar(20) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`log_id`, `u_id`, `username`, `password`) VALUES
(1, '0555351061', 'y@gmail.com', '$2y$10$AdF5zioMRy/cWWoLmNERI.sWtTUIgeBLI1ru7G9qarA'),
(2, '0554545452', 'd@gmail.com', '$2y$10$i5gd/myXShhX61G0n8PtuuGORt.jn5oyQ.qbq3witil'),
(3, '0244123123', 'd@gmail.com', '$2y$10$N5tVyq1.STjiqouPx15qrOwPAqFVbeKc51kKxkKSV3k'),
(4, '0555555555', 'f@gmail.com', '$2y$10$GwBF974VzWCld8C4hNngY.slbP8tQh5d8olg008.ST3LM9czEjJmi'),
(5, '0547240625', 'jeongprince@yahoo.com', '$2y$10$NihPuQvgGaQjcTTYDWYQtuwi5Z0y7HsCfIAWAt1qDoa'),
(6, '0987766554', 'collinobeng@gmail.com', '$2y$10$3LrAzNv1NWuKK7iuG0a7MOMsKbZAn1DvAM7Id/MZSnk'),
(7, '0123456789', 'roro@y.com', '$2y$10$IXMkyLBb3XP6Taq3/NyuNelnlz6M.kIIi6sPf6lc9lY'),
(8, '0258741036', 'philipo@gmail.com', '$2y$10$yhKDBsOPbmQQYPFZ3xCvGusWHu19dT1iCyIjX22dGR3'),
(9, '3322114455', 'nuto@123.com', '$2y$10$YEmgLzcktEI3Hxdsy1dBueRppBoaKnjVyIq6siXSsIQ'),
(10, '0145632014', 'francisratty@gmail.com', '$2y$10$Myo7I.sqxz93irrYuYmLeudVNpdy7Zj7f1s7jTAxdBo'),
(11, '0247896541', 'church@gh.com', '$2y$10$xMFM.ziqL3pWYCaHUD.dVeWWEfP1ZVDfasNZ.sfilGu'),
(12, '0249985632', 'derrickco@gmail.com', '$2y$10$Q/TuYuusxjpIlIaFOTr3eu4F5hCMes4dSuTp.uvb9BI'),
(13, '0541236547', 'p@gmail.com', '$2y$10$aucSDvsyfjLTgbWG7Y3Ii.pDRRMe4u9HWpmHEKMsSEhcKxEYRiMXy'),
(14, '0000000000', 'daza@gmail.com', '$2y$10$22lwza3IDwVCGcMIwx0VoOKKI4nozkZtScOXACEaUYNbdQZvQ8l1.');

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
  `user_id` varchar(20) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `amount` decimal(6,2) NOT NULL,
  `mode` varchar(20) NOT NULL,
  `added_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`pay_id`, `user_id`, `cust_id`, `amount`, `mode`, `added_at`) VALUES
(11, '0541236547', 11, '20.00', 'MOMO', '2023-06-19 21:57:08'),
(12, '0541236547', 11, '20.00', 'MOMO', '2023-06-19 21:58:41'),
(13, '0541236547', 11, '16.00', 'CASH', '2023-06-19 22:07:24'),
(14, '0541236547', 11, '16.00', 'CASH', '2023-06-19 22:08:08'),
(15, '0541236547', 11, '16.00', 'CASH', '2023-06-19 22:10:45'),
(16, '0541236547', 11, '16.00', 'CASH', '2023-06-19 22:11:12'),
(17, '0541236547', 11, '16.00', 'CASH', '2023-06-19 22:12:42');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `trans_id` varchar(20) DEFAULT NULL,
  `user_id` varchar(20) NOT NULL,
  `quantity` int(20) NOT NULL,
  `unit_price` decimal(6,2) NOT NULL,
  `total` decimal(6,2) GENERATED ALWAYS AS (`quantity` * `unit_price`) STORED,
  `added_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `item_id`, `cust_id`, `trans_id`, `user_id`, `quantity`, `unit_price`, `added_at`) VALUES
(29, 9, 11, 'ra29Ydc8Ec', '0541236547', 7, '4.00', '2023-06-19 21:57:08'),
(30, 9, 11, 'S1YY9ldUEB', '0541236547', 7, '4.00', '2023-06-19 21:58:41'),
(31, 9, 11, 'qWkiOEWNnP', '0541236547', 2, '4.00', '2023-06-19 22:07:24'),
(32, 10, 11, 'qWkiOEWNnP', '0541236547', 2, '5.20', '2023-06-19 22:07:24'),
(33, 9, 11, '2hkLn9Adsj', '0541236547', 2, '4.00', '2023-06-19 22:08:08'),
(34, 10, 11, '2hkLn9Adsj', '0541236547', 2, '5.20', '2023-06-19 22:08:08'),
(35, 9, 11, 'bhmmZOY6ef', '0541236547', 2, '4.00', '2023-06-19 22:10:45'),
(36, 10, 11, 'bhmmZOY6ef', '0541236547', 2, '5.20', '2023-06-19 22:10:45'),
(37, 9, 11, 'XUqd4wnJ61', '0541236547', 2, '4.00', '2023-06-19 22:11:12'),
(38, 10, 11, 'XUqd4wnJ61', '0541236547', 2, '5.20', '2023-06-19 22:11:12'),
(39, 9, 11, '4VyyLCuQZg', '0541236547', 2, '4.00', '2023-06-19 22:12:42'),
(40, 10, 11, '4VyyLCuQZg', '0541236547', 2, '5.20', '2023-06-19 22:12:42');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `t_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `trans_num` varchar(200) NOT NULL,
  `added_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`t_id`, `user_id`, `trans_num`, `added_at`) VALUES
(1, '541236547', 'w5F4K9o1C3', '2023-06-19 20:14:50'),
(2, '541236547', 'IG22NEBNCT', '2023-06-19 20:19:55'),
(3, '541236547', 'vvQJcFKoi9', '2023-06-19 21:13:39'),
(4, '541236547', 'E9l5skR2jT', '2023-06-19 21:14:30'),
(5, '541236547', 'vT4adraEMN', '2023-06-19 21:15:24'),
(6, '0541236547', 'XKTfAAxHsB', '2023-06-19 21:35:40'),
(7, '0541236547', 'v8Jc00SFVd', '2023-06-19 21:36:17'),
(8, '0541236547', '7D12cY8jx4', '2023-06-19 21:57:08'),
(9, '0541236547', 'ra29Ydc8Ec', '2023-06-19 21:57:08'),
(10, '0541236547', 'UL1lWcQt6k', '2023-06-19 21:58:41'),
(11, '0541236547', 'S1YY9ldUEB', '2023-06-19 21:58:41'),
(12, '0541236547', 'DW2VX7BBjJ', '2023-06-19 22:07:24'),
(13, '0541236547', 'qWkiOEWNnP', '2023-06-19 22:07:24'),
(14, '0541236547', 'BVgpG47gEM', '2023-06-19 22:08:08'),
(15, '0541236547', '2hkLn9Adsj', '2023-06-19 22:08:08'),
(16, '0541236547', 'bhmmZOY6ef', '2023-06-19 22:10:45'),
(17, '0541236547', 'XUqd4wnJ61', '2023-06-19 22:11:12'),
(18, '0541236547', '4VyyLCuQZg', '2023-06-19 22:12:42');

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
('0145632014', 'francis ', 'ratty', 'M', 'francisratty@gmail.com', NULL, '2023-05-25 13:27:11', NULL),
('0244123123', 'Daniel', 'Amunu', 'M', 'd@gmail.com', NULL, '2023-05-31 19:12:22', NULL),
('0541236547', 'prince', 'david', 'M', 'p@gmail.com', NULL, '2023-05-31 19:32:42', NULL),
('0555351061', 'Francis', 'Yaw', 'M', 'y@gmail.com', NULL, '2023-05-02 17:18:32', NULL),
('0555555555', 'Francis', 'Anlimah', 'M', 'f@gmail.com', NULL, '2023-05-31 19:22:33', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cust_id`),
  ADD UNIQUE KEY `uniq_cust_user` (`number`),
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
  ADD KEY `FK_cust_id` (`cust_id`),
  ADD KEY `fk_payments_user` (`user_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `FK_item_id1` (`item_id`),
  ADD KEY `FK_cust_id1` (`cust_id`),
  ADD KEY `fk_sales_user` (`user_id`),
  ADD KEY `fk_trans_user` (`trans_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`t_id`),
  ADD UNIQUE KEY `trans_id` (`trans_num`);

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
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ordered_items`
--
ALTER TABLE `ordered_items`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
  ADD CONSTRAINT `FK_cust_id` FOREIGN KEY (`cust_id`) REFERENCES `customers` (`cust_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_payments_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`phone_number`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `FK_cust_id1` FOREIGN KEY (`cust_id`) REFERENCES `customers` (`cust_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_item_id1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sales_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`phone_number`),
  ADD CONSTRAINT `fk_trans_user` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_num`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
