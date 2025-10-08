-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2025 at 03:32 PM
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
-- Database: `cyber_security`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$gYg3/Yi8qEd6CFpRBz//zeqTTRI7oe9Mbfw0KOFKYsxihmxw3vLdy');

-- --------------------------------------------------------

--
-- Table structure for table `scanned_website`
--

CREATE TABLE `scanned_website` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `sqli_result` text NOT NULL,
  `xss_result` text NOT NULL,
  `headers_result` text NOT NULL,
  `server_result` text NOT NULL,
  `scan_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scanned_website`
--

INSERT INTO `scanned_website` (`id`, `user_id`, `url`, `sqli_result`, `xss_result`, `headers_result`, `server_result`, `scan_timestamp`) VALUES
(1, NULL, 'https://otx.alienvault.com/indicator/domain/dfwdiesel.net', '✅ No SQL Injection Vulnerability Detected.', '✅ No XSS Vulnerability Detected.', '🚨 Missing Security Headers: Content-Security-Policy', '✅ Server software appears up-to-date: CloudFront.', '2025-03-02 13:54:50'),
(2, NULL, 'ww38.fantasticfilms.ru', 'Unable to connect to the URL for SQL Injection check.', 'Unable to connect to the URL for XSS check.', 'Unable to retrieve headers for the given URL.', 'Unable to retrieve server information for the given URL.', '2025-03-02 14:29:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'enoch', 'enoch@gmail.com', '$2y$10$UTE4Mak1ycJmwMNz46cJuu8Xy1gvBDrwipaRV/8SNvv/oTHCUXVKy', '2025-03-02 13:17:39'),
(2, 'enoch2', 'enoch2@gmail.com', '$2y$10$MYuePFU.6M3IrCi7nTwKM.OZo4w8V5WGHg3tmGZQ1HHkoZZzzy1Wq', '2025-03-02 14:29:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `scanned_website`
--
ALTER TABLE `scanned_website`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `scanned_website`
--
ALTER TABLE `scanned_website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `scanned_website`
--
ALTER TABLE `scanned_website`
  ADD CONSTRAINT `scanned_website_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
