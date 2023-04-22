-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2023 at 12:18 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_php_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `leave`
--

CREATE TABLE `leave` (
  `id` bigint(20) NOT NULL,
  `creation_date` datetime(6) NOT NULL,
  `approved` tinyint(1) DEFAULT NULL,
  `approve_date` datetime(6) DEFAULT NULL,
  `start_date` datetime(6) NOT NULL,
  `day_count` int(10) UNSIGNED NOT NULL,
  `comment` longtext NOT NULL,
  `approver_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave`
--

INSERT INTO `leave` (`id`, `creation_date`, `approved`, `approve_date`, `start_date`, `day_count`, `comment`, `approver_id`, `user_id`) VALUES
(19, '2023-04-22 00:00:00.000000', 0, NULL, '2023-04-26 00:00:00.000000', 1, 'Personal reason', 11, 8),
(20, '2023-04-22 00:00:00.000000', 1, '0000-00-00 00:00:00.000000', '2023-06-13 00:00:00.000000', 2, 'Family trip', 11, 8),
(21, '2023-04-22 00:00:00.000000', NULL, NULL, '2023-08-24 00:00:00.000000', 1, 'Birthday', 11, 8),
(22, '2023-04-22 00:00:00.000000', NULL, NULL, '2023-10-10 00:00:00.000000', 1, 'Official birthday', 11, 8),
(23, '2023-04-22 00:00:00.000000', NULL, NULL, '2023-12-14 00:00:00.000000', 3, 'Family trip', 11, 8),
(24, '2023-04-22 00:00:00.000000', NULL, NULL, '2023-08-17 00:00:00.000000', 4, 'Tour to outside', 11, 8),
(26, '2023-04-22 00:00:00.000000', NULL, NULL, '2023-07-19 00:00:00.000000', 1, 'Casual leave', 11, 8),
(27, '2023-04-22 00:00:00.000000', NULL, NULL, '2023-05-01 00:00:00.000000', 3, 'Need to go to village', 11, 12),
(28, '2023-04-22 00:00:00.000000', 1, '0000-00-00 00:00:00.000000', '2023-05-17 00:00:00.000000', 5, 'Marriage leave', 11, 12);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `password` varchar(128) NOT NULL,
  `token` char(255) DEFAULT NULL,
  `last_login` datetime(6) DEFAULT NULL,
  `is_superuser` tinyint(1) NOT NULL,
  `username` varchar(150) DEFAULT NULL,
  `first_name` varchar(150) DEFAULT NULL,
  `last_name` varchar(150) DEFAULT NULL,
  `email` varchar(254) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `date_joined` datetime(6) NOT NULL,
  `supervisor_id` int(11) DEFAULT NULL,
  `can_approve_leave` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `password`, `token`, `last_login`, `is_superuser`, `username`, `first_name`, `last_name`, `email`, `is_active`, `date_joined`, `supervisor_id`, `can_approve_leave`) VALUES
(8, '$2y$12$fxJM6zhxYfXO8sjKKxdVu.bYduNRydSXjfIaAgxtCzdbSzv8y.AJW', NULL, '2023-04-22 00:00:00.000000', 0, 'shoaib.rahman', 'Shoaib', 'Mina', 'shoaib.rahman@beza.gov.bd', 1, '0000-00-00 00:00:00.000000', 11, 0),
(11, '$2y$12$qdz.2fjbXwDbCM5k9Cvd/Onv33M0ZQNSn8S7GKmVzd3BJmY0CdNw2', '$2y$12$JUVUifzwdBk6DVCEkhL7pebfWyKWoT0K2uEDoKX1VPn8bfPQJnY9m', '2023-04-22 00:00:00.000000', 0, 'approver', 'Approver', '', 'approver@someone.com', 1, '0000-00-00 00:00:00.000000', NULL, 1),
(12, '$2y$12$P2blsCH4EjV94el5C.NaW.FEREAt7RCBlWVMiaTfvsABnhWqW6t1u', NULL, '2023-04-22 00:00:00.000000', 0, 'distributor', 'Distributor', 'Officer', 'abc@abc.com', 1, '2023-04-22 00:00:00.000000', 11, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leave`
--
ALTER TABLE `leave`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leave_approver_id_7c2c50d7_fk_user_id` (`approver_id`),
  ADD KEY `leave_user_id_b4b01ea9_fk_user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user_supervisor_id_479813ed_fk_user_id` (`supervisor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leave`
--
ALTER TABLE `leave`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leave`
--
ALTER TABLE `leave`
  ADD CONSTRAINT `leave_ibfk_1` FOREIGN KEY (`approver_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leave_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_supervisor_id_479813ed_fk_user_id` FOREIGN KEY (`supervisor_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
