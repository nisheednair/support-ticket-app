-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Oct 18, 2025 at 12:38 PM
-- Server version: 8.0.42
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_responses`
--

CREATE TABLE `tbl_responses` (
  `id` int NOT NULL,
  `user_response` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci	 DEFAULT NULL,
  `response_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci	 NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ticket_id` bigint DEFAULT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_response_images`
--

CREATE TABLE `tbl_response_images` (
  `id` int NOT NULL,
  `response_id` int NOT NULL,
  `image_data` longblob NOT NULL,
  `image_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci	 NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci	,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ticket`
--

CREATE TABLE `tbl_ticket` (
  `ticket_id` bigint NOT NULL,
  `piority` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci	 DEFAULT NULL,
  `project` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci	 DEFAULT NULL,
  `activity` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci	 DEFAULT NULL,
  `type` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci	 DEFAULT NULL,
  `status` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci	 DEFAULT NULL,
  `task_by` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci	 DEFAULT NULL,
  `open_by` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci	 DEFAULT NULL,
  `root_cause` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci	,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci	,
  `solution` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci	,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `image` longblob,
  `images` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci	 DEFAULT NULL,
  `closed_date` timestamp NULL DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `problem_issue` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_ticket`
--

INSERT INTO `tbl_ticket` (`ticket_id`, `piority`, `project`, `activity`, `type`, `status`, `task_by`, `open_by`, `root_cause`, `title`, `solution`, `created_date`, `image`, `images`, `closed_date`, `user_id`, `problem_issue`) VALUES
(1, 'low', 'Inpatient', NULL, NULL, NULL, 'moderator', 'ip1', NULL, 'Test', NULL, '2025-10-18 04:12:55', NULL, NULL, NULL, 9, 'System Failure');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci	 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci	 NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci	 DEFAULT NULL,
  `lastname` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci	 DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci	 NOT NULL,
  `role` enum('admin','user','moderator') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci	 NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `profile_image` longblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `username`, `password`, `name`, `lastname`, `email`, `role`, `created_at`, `profile_image`) VALUES
(1, 'nisheednair', '$2y$10$jP/f56Vt2LNCCQUQdPkDEOp8C/Z1D9FcvPmhPurNXFINjA/hPvrMy', NULL, NULL, 'nisheednair@gmail.com', 'admin', '2025-10-15 19:50:37', NULL),
(7, 'admin', '$2y$10$KY/zK3qHyIFR7zmlrCnpgOgbD7jYzSXYCzwVrjnsiQBMVTHUfWV6y', NULL, NULL, 'nisheed@mhs.com.sa', 'admin', '2025-10-15 22:02:31', NULL),
(8, 'user', '$2y$10$YciNysZPySpuyHqpyuSyJebSELRz6CrAsC4FPZhG9Hxwa6a8hWPfC', NULL, NULL, 'nisheednair@hotmail.com', 'user', '2025-10-17 05:41:59', NULL),
(9, 'moderator', '$2y$10$vRSLfk1qT3C6onlseWr7aOXINICkVHI/tVgKuc33Rj0jnB4DmLeii', NULL, NULL, 'it@mhs.com.sa', 'moderator', '2025-10-17 05:47:29', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_responses`
--
ALTER TABLE `tbl_responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_response_images`
--
ALTER TABLE `tbl_response_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ticket`
--
ALTER TABLE `tbl_ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_responses`
--
ALTER TABLE `tbl_responses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_response_images`
--
ALTER TABLE `tbl_response_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_ticket`
--
ALTER TABLE `tbl_ticket`
  MODIFY `ticket_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
