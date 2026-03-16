-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 16, 2026 at 03:23 PM
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
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `program_id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `title` varchar(150) NOT NULL,
  `years` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`program_id`, `code`, `title`, `years`) VALUES
(1, 'CS2324', 'ComputerStudies', 4),
(2, 'BS2344', 'Information Technology', 4),
(3, 'DS1222', 'Data Science', 4),
(4, 'NS3344', 'Nursing', 4),
(5, 'CS2323', 'Computer Development', 4),
(6, '1223333', 'BSDS', 4),
(7, 'CS6767', 'Computer Theology', 4),
(8, 'IT45521', 'IT Informing', 4),
(9, 'IT67676', 'Test Program', 4);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `title` varchar(150) NOT NULL,
  `unit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `code`, `title`, `unit`) VALUES
(1, 'CS0001', 'Programming Language', 3),
(2, 'CS7778', 'Basic Electronics', 3),
(3, 'IT2387', 'Object Oriented Programming', 3),
(4, 'GE2387', 'Electives 1', 3),
(5, 'CS233333', 'CSDA', 5),
(6, 'IT67686', 'Technoprenourship', 3),
(7, 'IT6555558', 'Subject test', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_type` enum('admin','staff','teacher','student') NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `account_type`, `created_on`, `created_by`, `updated_on`, `updated_by`) VALUES
(1, 'admin', '$2y$10$Zl98vElUPAR9zBz3bKBN3eQIMKQ2G/4.yaKsBt9qeOR5sZ2vEqNc6', 'admin', '2026-02-03 15:45:22', 0, NULL, NULL),
(2, 'Mark', '$2y$10$jn5eZLuhfUIF4MNPOpxG9.zmasqWv8gC9mojNM0etqW3M6DDo5XWa', 'staff', '2026-02-04 22:18:14', 1, NULL, NULL),
(3, 'John', '$2y$10$w4C4ifCBogT5jK/l07SWiO4JwB9cWx79KEtUZ5vnQS6RS9SpjLwdO', 'student', '2026-02-04 22:32:46', 1, NULL, NULL),
(4, 'bert', '$2y$10$SC4t7P017guzVEa5AHiFf.gqfIWzdRQFIQqfSxoIg0er82G1XZnmG', 'student', '2026-03-01 19:21:56', 1, '2026-03-05 00:11:26', 4),
(5, 'Alberta', '$2y$10$pTdawVqGQnTXbBrtNr9QMu8NTDBEIQUAxApKNJgmViVXrtYy8BfyK', 'teacher', '2026-03-01 19:22:14', 1, NULL, NULL),
(6, 'Hubert', '$2y$10$XcrjqlpJP0Rw2DCACYRjyuC0HK4X0F02Y2id0fZKfeIZ/NaqJXoQS', 'teacher', '2026-03-01 19:37:15', 1, '2026-03-01 19:37:28', 1),
(10, 'Alonzo', '$2y$10$Meh99rsfKYw.FVv3PYt5U.OFtEkxEPYGqkkbA42hoI6OhHINKOApi', 'teacher', '2026-03-05 00:02:12', 1, '2026-03-05 00:02:23', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`program_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
