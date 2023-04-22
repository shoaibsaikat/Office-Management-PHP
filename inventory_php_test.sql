-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2023 at 04:44 AM
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
(17, '2023-04-22 00:00:00.000000', NULL, NULL, '2023-04-25 00:00:00.000000', 2, 'Personal reason', 9, 11);

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
  `can_approve_inventory` tinyint(1) NOT NULL,
  `can_distribute_inventory` tinyint(1) NOT NULL,
  `can_approve_leave` tinyint(1) NOT NULL,
  `can_manage_asset` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `password`, `token`, `last_login`, `is_superuser`, `username`, `first_name`, `last_name`, `email`, `is_active`, `date_joined`, `supervisor_id`, `can_approve_inventory`, `can_distribute_inventory`, `can_approve_leave`, `can_manage_asset`) VALUES
(8, '$2y$12$fxJM6zhxYfXO8sjKKxdVu.bYduNRydSXjfIaAgxtCzdbSzv8y.AJW', NULL, NULL, 0, 'shoaib.rahman', 'Shoaib', 'Mina', 'shoaib.rahman@beza.gov.bd', 0, '0000-00-00 00:00:00.000000', 11, 0, 0, 0, 0),
(9, '$2y$12$L4DwZ6wcSMDR1rqKMqtLfeA80jz9tKpAhA2JaX/viBFrJ5k2JdJ2a', NULL, NULL, 0, 'distributor', 'Distributor', '', 'distributor@someone.com', 0, '0000-00-00 00:00:00.000000', NULL, 0, 0, 0, 0),
(11, '$2y$12$qdz.2fjbXwDbCM5k9Cvd/Onv33M0ZQNSn8S7GKmVzd3BJmY0CdNw2', '$2y$12$EO/22GHuHQFfRx2GOYtkFOPn9Xz4uBgzeFEsO30Q0rTPap8kfhuty', NULL, 0, 'approver', 'Approver', '', 'approver@someone.com', 0, '0000-00-00 00:00:00.000000', 8, 0, 0, 0, 0);

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
