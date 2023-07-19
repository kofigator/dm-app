-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2023 at 02:59 PM
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
  `archive` int(11) DEFAULT 0,
  `added_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cust_id`, `u_id`, `name`, `number`, `gender`, `city`, `address`, `archive`, `added_at`, `updated_at`) VALUES
(3, '0555555555', 'Prince', '0214521451', 'F', 'Accra', 'Spintex', 0, '2023-05-31 20:10:12', NULL),
(4, '0555555555', 'Ratty', '0124563214', 'M', 'Nungua', 'RMU', 0, '2023-06-14 02:33:05', NULL),
(7, '0555555555', 'Ratty', '0124563215', 'M', 'Nungua', 'RMU', 0, '2023-06-14 02:53:24', NULL),
(8, '0555555555', 'Ratty', '0124563216', 'M', 'Osu', 'RMU', 0, '2023-06-14 02:53:45', NULL),
(9, '0555555555', 'asba', '0124563217', 'M', 'Osu', 'Osu Police Station', 0, '2023-06-14 02:57:22', NULL),
(10, '0555555555', 'Sulley', '0125632123', 'M', 'Lapaz', 'Hannah Road 209 Jn', 0, '2023-06-14 03:47:42', NULL),
(11, '0541236547', 'Collins Obeng', '0247856932', 'M', 'Kumasi', 'Hse No. 9', 0, '2023-06-19 20:01:47', NULL),
(12, '0541236547', 'Francisca Deku', '0263512487', 'F', 'Tema', 'new town', 1, '2023-06-20 18:48:11', NULL),
(13, '0541236547', 'Kobby Halm', '0501478523', 'M', 'Madina', 'lake-side', 1, '2023-06-20 18:49:01', NULL),
(14, '0541236547', 'Mary Asare', '0249658741', 'F', 'Amasaman', 'blue koisk', 1, '2023-06-20 18:51:00', NULL),
(15, '0541236547', 'Deborah Tsekpo', '0241563247', 'F', 'Madina', 'bus-stop', 0, '2023-06-29 10:12:52', NULL),
(16, '0541236547', 'Koo Sammy', '0245669887', 'M', 'Accra', 'RMU Campus', 1, '2023-06-29 14:51:44', NULL),
(17, '0541236547', 'kwame K', '0243551555', 'M', 'Sakumono', 'Estaste Block C', 0, '2023-06-29 14:58:13', NULL),
(18, '0541236547', 'trial', '0241526332', 'M', 'Hi', 'Hello', 1, '2023-07-06 22:32:56', NULL),
(19, '0541236547', 'Kwaku Kyei', '0555904324', 'M', 'Tema', 'Ona Records', 1, '2023-07-07 12:31:19', NULL),
(20, '0541236547', 'David Osei', '0201478523', 'M', 'Tema', 'community 9', 1, '2023-07-07 13:36:32', NULL),
(21, '0541236547', 'maison fifi', '0245656897', 'M', 'Madina', 'a', 0, '2023-07-07 13:41:02', NULL);

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
  `archive` int(11) DEFAULT 0,
  `added_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `profit` decimal(10,2) GENERATED ALWAYS AS (`unit_price` - `cost_price`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `u_id`, `item_name`, `description`, `cost_price`, `unit_price`, `quantity`, `archive`, `added_at`, `updated_at`) VALUES
(9, '0541236547', 'Digestive Biscuit', 'small', '2.50', '4.00', 48, 0, '2023-06-19 20:12:04', NULL),
(10, '0541236547', 'Bel-cola', 'large', '2.20', '5.20', 204, 0, '2023-06-19 22:04:06', NULL),
(11, '0541236547', 'Back Pack', 'leather', '78.00', '110.00', 54, 1, '2023-06-20 18:52:44', NULL),
(12, '0541236547', 'Voltic Box', 'medium', '9.70', '15.00', 23, 0, '2023-06-20 18:57:11', NULL),
(13, '0541236547', 'Big Milk Tin', 'Large size', '500.00', '750.00', 88, 1, '2023-06-29 14:54:26', NULL),
(15, '0541236547', 'Printer Cable', '15m', '36.70', '55.00', 0, 1, '2023-07-03 09:36:57', NULL),
(16, '0541236547', 'Printer Cable', '15m', '15.00', '20.00', 0, 0, '2023-07-07 13:32:34', NULL);

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
  `pay_num` varchar(100) NOT NULL,
  `pay_type` varchar(100) NOT NULL,
  `amount` decimal(6,2) NOT NULL,
  `mode` varchar(20) NOT NULL,
  `added_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`pay_id`, `user_id`, `cust_id`, `pay_num`, `pay_type`, `amount`, `mode`, `added_at`) VALUES
(71, '0541236547', 17, 'YtIQ6BCrqS', 'initial', '50.00', 'CASH', '2023-06-29 16:08:57'),
(72, '0541236547', 15, 'x6bRetuSNS', 'initial', '566.00', 'MOMO', '2023-06-30 12:48:22'),
(73, '0541236547', 14, '60vSQrINWI', 'initial', '500.00', 'CASH', '2023-06-30 12:49:05'),
(74, '0541236547', 15, '7diKO14Uwq', 'initial', '1.00', 'MOMO', '2023-06-30 13:35:22'),
(75, '0541236547', 15, 'FhvJ7rrvED', 'initial', '1300.00', 'CASH', '2023-06-30 13:53:35'),
(76, '0541236547', 15, 'cljKs8CUKH', 'continual', '200.00', 'CASH', '2023-06-30 22:51:37'),
(77, '0541236547', 15, 'RNkUcnpR8K', 'continual', '1003.40', 'MOMO', '2023-07-02 21:33:50'),
(78, '0541236547', 17, 'eDmJwgMmBI', 'continual', '22.62', 'MOMO', '2023-07-03 08:34:14'),
(79, '0541236547', 17, '65tAy7e72A', 'continual', '0.78', 'MOMO', '2023-07-04 10:25:23'),
(80, '0541236547', 15, 'vaRa7zznsF', 'continual', '500.00', 'MOMO', '2023-07-04 12:11:01'),
(81, '0541236547', 17, 'yV1YSfVAqz', 'initial', '310.00', 'CASH', '2023-07-06 23:05:45'),
(82, '0541236547', 15, 'YhHVaNOj3P', 'continual', '250.00', 'MOMO', '2023-07-07 09:02:48'),
(83, '0541236547', 15, '2bSZGkyWJr', 'continual', '2250.00', 'MOMO', '2023-07-07 12:33:15'),
(84, '0541236547', 17, 'yfbL7sIuea', 'continual', '177.00', 'CASH', '2023-07-07 12:33:50'),
(85, '0541236547', 21, 'IhDAvHKxkd', 'initial', '50.00', 'CASH', '2023-07-07 13:41:02'),
(86, '0541236547', 21, '43CXWfrP9c', 'continual', '60.00', 'CASH', '2023-07-07 13:42:24'),
(87, '0541236547', 14, 'eqaH63lhmz', 'continual', '70.00', 'CASH', '2023-07-07 13:44:12'),
(88, '0541236547', 17, 'UzhqWOrbj7', 'initial', '70.00', 'CASH', '2023-07-07 13:54:05'),
(89, '0541236547', 17, '6PN5I1kbZ2', 'continual', '50.00', 'CASH', '2023-07-07 13:54:31'),
(90, '0541236547', 17, 'VHu98ToAzT', 'initial', '30.00', 'CASH', '2023-07-07 13:56:01'),
(91, '0541236547', 21, 'nvh6At1bJL', 'initial', '15.00', 'CASH', '2023-07-07 13:59:46'),
(92, '0541236547', 17, 'FbD9lWsOse', 'continual', '52.00', 'CASH', '2023-07-19 07:35:52'),
(93, '0541236547', 11, 'YO6GXFeU69', 'initial', '15.00', 'MOMO', '2023-07-19 07:50:56');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `trans_num` varchar(200) NOT NULL,
  `pay_num` varchar(100) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `quantity` int(20) NOT NULL,
  `unit_price` decimal(6,2) NOT NULL,
  `total` decimal(6,2) GENERATED ALWAYS AS (`quantity` * `unit_price`) STORED,
  `added_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `item_id`, `trans_num`, `pay_num`, `cust_id`, `user_id`, `quantity`, `unit_price`, `added_at`) VALUES
(81, 10, 'uUMyyrhYg5', 'YtIQ6BCrqS', 17, '0541236547', 2, '5.20', '2023-06-29 16:08:57'),
(82, 11, 'uUMyyrhYg5', 'YtIQ6BCrqS', 17, '0541236547', 2, '110.00', '2023-06-29 16:08:57'),
(83, 10, 'VKYCH2A7tg', 'x6bRetuSNS', 15, '0541236547', 7, '5.20', '2023-06-30 12:48:22'),
(84, 12, 'VKYCH2A7tg', 'x6bRetuSNS', 15, '0541236547', 2, '15.00', '2023-06-30 12:48:22'),
(85, 13, 'VKYCH2A7tg', 'x6bRetuSNS', 15, '0541236547', 6, '750.00', '2023-06-30 12:48:22'),
(86, 10, 'iLa4HUMRLX', '60vSQrINWI', 14, '0541236547', 2, '5.20', '2023-06-30 12:49:05'),
(87, 11, 'iLa4HUMRLX', '60vSQrINWI', 14, '0541236547', 4, '110.00', '2023-06-30 12:49:05'),
(88, 12, 'iLa4HUMRLX', '60vSQrINWI', 14, '0541236547', 6, '15.00', '2023-06-30 12:49:05'),
(89, 9, 'zs87Bqnkdo', '7diKO14Uwq', 15, '0541236547', 1, '4.00', '2023-06-30 13:35:22'),
(90, 13, 'DEGoatNuOz', 'FhvJ7rrvED', 15, '0541236547', 2, '750.00', '2023-06-30 13:53:35'),
(91, 15, 'jBn3yJmqQb', 'yV1YSfVAqz', 17, '0541236547', 6, '55.00', '2023-07-06 23:05:45'),
(92, 10, 'F0pJGkQITk', 'IhDAvHKxkd', 21, '0541236547', 2, '5.20', '2023-07-07 13:41:02'),
(93, 16, 'F0pJGkQITk', 'IhDAvHKxkd', 21, '0541236547', 5, '20.00', '2023-07-07 13:41:02'),
(94, 12, '5x528kJnmT', 'UzhqWOrbj7', 17, '0541236547', 4, '15.00', '2023-07-07 13:54:05'),
(95, 16, '5x528kJnmT', 'UzhqWOrbj7', 17, '0541236547', 2, '20.00', '2023-07-07 13:54:05'),
(96, 16, '8qXSSRE96A', 'VHu98ToAzT', 17, '0541236547', 3, '20.00', '2023-07-07 13:56:01'),
(97, 12, 'iNVw9lHqq8', 'nvh6At1bJL', 21, '0541236547', 1, '15.00', '2023-07-07 13:59:46'),
(98, 10, '3CneeKBj0f', 'YO6GXFeU69', 11, '0541236547', 3, '5.20', '2023-07-19 07:50:56');

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
(41, '0541236547', 'uUMyyrhYg5', '2023-06-29 16:08:57'),
(42, '0541236547', 'VKYCH2A7tg', '2023-06-30 12:48:22'),
(43, '0541236547', 'iLa4HUMRLX', '2023-06-30 12:49:05'),
(44, '0541236547', 'zs87Bqnkdo', '2023-06-30 13:35:22'),
(45, '0541236547', 'DEGoatNuOz', '2023-06-30 13:53:35'),
(46, '0541236547', 'jBn3yJmqQb', '2023-07-06 23:05:45'),
(47, '0541236547', 'F0pJGkQITk', '2023-07-07 13:41:02'),
(48, '0541236547', '5x528kJnmT', '2023-07-07 13:54:05'),
(49, '0541236547', '8qXSSRE96A', '2023-07-07 13:56:01'),
(50, '0541236547', 'iNVw9lHqq8', '2023-07-07 13:59:46'),
(51, '0541236547', '3CneeKBj0f', '2023-07-19 07:50:56');

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
  ADD KEY `fk_trans_user` (`trans_num`);

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
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

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
  ADD CONSTRAINT `fk_trans_user` FOREIGN KEY (`trans_num`) REFERENCES `transactions` (`trans_num`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
