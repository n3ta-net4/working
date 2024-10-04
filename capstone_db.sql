-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2024 at 07:15 AM
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
-- Database: `capstone_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `appointment_date`, `appointment_time`, `status`) VALUES
(25, 7, '2024-10-16', '03:30:00', 'approved'),
(26, 7, '2024-10-16', '01:30:00', 'approved'),
(27, 7, '2024-10-16', '02:00:00', 'approved'),
(28, 7, '2024-10-03', '03:30:00', 'approved'),
(29, 7, '2024-10-03', '04:00:00', 'rejected'),
(30, 7, '2024-10-22', '05:00:00', 'rejected'),
(31, 7, '2024-10-09', '05:00:00', 'rejected'),
(32, 7, '2024-10-09', '04:00:00', 'rejected'),
(33, 7, '2024-10-09', '03:30:00', 'rejected'),
(34, 7, '2024-10-03', '04:00:00', 'rejected'),
(35, 7, '2024-10-03', '04:30:00', 'rejected'),
(36, 7, '2024-10-03', '05:00:00', 'rejected'),
(37, 7, '2024-10-03', '04:30:00', 'approved'),
(38, 7, '2024-10-03', '09:30:00', 'rejected'),
(39, 7, '2024-10-03', '09:30:00', 'approved'),
(40, 7, '2024-10-03', '10:30:00', 'approved'),
(41, 7, '2024-10-03', '12:00:00', 'approved'),
(42, 7, '2024-10-02', '05:00:00', 'rejected'),
(43, 7, '2024-10-02', '04:30:00', 'approved'),
(44, 7, '2024-10-02', '04:00:00', 'approved'),
(45, 7, '2024-10-02', '05:00:00', 'rejected'),
(46, 7, '2024-10-02', '05:00:00', 'rejected'),
(47, 7, '2024-10-02', '05:00:00', 'approved'),
(48, 7, '2024-10-02', '10:00:00', 'approved'),
(49, 7, '2024-10-02', '09:30:00', 'approved'),
(50, 7, '2024-10-02', '11:00:00', 'approved'),
(51, 7, '2024-10-02', '11:30:00', 'approved'),
(52, 7, '2024-10-02', '12:00:00', 'approved'),
(53, 7, '2024-10-02', '02:30:00', 'approved'),
(54, 7, '2024-10-02', '02:00:00', 'approved'),
(55, 7, '2024-10-02', '03:00:00', 'approved'),
(56, 7, '2024-10-03', '02:00:00', 'approved'),
(57, 7, '2024-10-03', '02:30:00', 'approved'),
(58, 7, '2024-10-03', '03:00:00', 'approved'),
(59, 7, '2024-10-04', '02:00:00', 'approved'),
(60, 7, '2024-10-04', '02:30:00', 'approved'),
(61, 7, '2024-10-04', '03:00:00', 'approved'),
(62, 7, '2024-10-04', '10:00:00', 'approved'),
(63, 7, '2024-10-04', '10:30:00', 'approved'),
(64, 7, '2024-10-04', '11:00:00', 'rejected'),
(65, 7, '2024-10-04', '12:00:00', 'approved'),
(66, 7, '2024-10-04', '12:30:00', 'rejected'),
(67, 7, '2024-10-04', '01:00:00', 'approved'),
(68, 7, '2024-10-04', '11:30:00', 'approved'),
(69, 7, '2024-10-04', '12:30:00', 'approved'),
(70, 7, '2024-10-04', '04:00:00', 'approved'),
(71, 7, '2024-10-04', '04:30:00', 'rejected'),
(72, 7, '2024-10-04', '05:00:00', 'approved'),
(73, 7, '2024-10-03', '04:00:00', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(6, 'admin', 'admin@yahoo.com', '$2y$10$QG/U8XiJXPDhvrsV3mTUhORxcMwCAxjgZq8Yy0qLvbAT/.vf3Q7wm', 'admin', '2024-09-29 17:38:16'),
(7, 'user', 'user@yahoo.com', '$2y$10$141MOWlmMYxbWXhbPmrf0.CNRjIwdyKO.V0dBULxFCxjoDcabMZsi', 'user', '2024-09-29 17:38:24'),
(8, 'Miguel Araneta', 'test2@yahoo.com', '$2y$10$CWanmwgpIjR6J7afmlZr.eiVznNq6zFoZPoM3AX1Kz07680zTwKDS', 'user', '2024-09-29 19:34:30'),
(9, 'Christine Buhatin', 'test3@yahoo.com', '$2y$10$O.kz0JodgY28ugDW.zhUrOpFx/UJWdZuh.vMNx1Bmh6AA.y1.vSuO', 'user', '2024-09-29 19:34:40'),
(10, 'Test User', 'testuser@yahoo.com', '$2y$10$RpBWT0UoT8hML4ELwYgrbuDRQiU6jaw.02jLCd.MODPJe.45s1dPm', 'user', '2024-09-29 19:41:40'),
(11, 'Test Admin', 'testadmin@yahoo.com', '$2y$10$p.kDzVMW2NLeNZ3aS8gMg.VUbJL5lWtAvY4pt8rBUFsgB71ke0DJ2', 'admin', '2024-09-29 19:42:24'),
(12, 'user1', 'user1@yahoo.com', '$2y$10$hNL0vL50nK3OrpMHN2sSauHGnDrgmvXG6W/IwXgMgHijzS.6UaDhm', 'user', '2024-09-30 18:31:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
