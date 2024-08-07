-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2024 at 09:33 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contact_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `user_id`, `name`, `company`, `email`, `phone`, `created_at`) VALUES
(1, '1', 'R-jhel B. Tandugon', NULL, 'jherietandugon@gmail.com', '09971478896', NULL),
(3, '2', 'R-jhel B. Tandugon Sr.', 'FDCI', 'rjheltandugon10182001@gmail.com', '09971478896', NULL),
(4, '2', 'test', 'Sscibiz informatics', 'test@gmail.com', '1234556778', NULL),
(5, '2', 'Gian Karla Narboada', 'FDCI', 'fdchr.narboada@gmail.com', '09162349143', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, NULL, 'admin', '$2y$10$tckFCBz/a/JGQ5FUaqApROH2XM5gFhux151g4h6h9g665m6IB1HvW', NULL),
(2, 'R-jhel B. Tandugon', 'jherietandugon@gmail.com', '$2y$10$wwG.Vdl7CFNraia1y2G0cu2YtEM09mkUEkGbS77ZJis3EgIdq54ke', NULL),
(3, 'R-jhel B. Tandugon', 'jherietandugon1@gmail.com', '$2y$10$Kv86b0YUavMD9WIwtVUhIOYoetMv0iETi3OTb.5FYCk.8McjxYk7O', NULL),
(4, 'R-jhel B. Tandugon 3', 'jherietandugon3@gmail.com', '$2y$10$AMKXYP.0Pt.Pj13oIYnIfOBdgRWbuBt4U67MSjN0Ys9ErYbNaHlPi', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
