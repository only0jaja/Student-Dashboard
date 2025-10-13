-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2025 at 06:24 PM
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
-- Database: `studentapplicationdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `student_applications`
--

CREATE TABLE `student_applications` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `age` int(11) NOT NULL,
  `height` varchar(10) NOT NULL,
  `date_of_birth` date NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `civil_status` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `emergency_name` varchar(100) NOT NULL,
  `emergency_relation` varchar(100) NOT NULL,
  `emergency_phone` varchar(20) NOT NULL,
  `emergency_email` varchar(255) DEFAULT NULL,
  `campus` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `guardian_first_name` varchar(100) NOT NULL,
  `guardian_middle_name` varchar(100) DEFAULT NULL,
  `guardian_last_name` varchar(100) NOT NULL,
  `guardian_relationship` varchar(100) NOT NULL,
  `guardian_dob` date NOT NULL,
  `guardian_occupation` varchar(100) DEFAULT NULL,
  `guardian_employer` varchar(100) DEFAULT NULL,
  `guardian_email` varchar(255) DEFAULT NULL,
  `guardian_phone` varchar(20) NOT NULL,
  `guardian_address` text NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_applications`
--

INSERT INTO `student_applications` (`id`, `first_name`, `last_name`, `middle_name`, `gender`, `age`, `height`, `date_of_birth`, `nationality`, `religion`, `civil_status`, `email`, `phone`, `address`, `emergency_name`, `emergency_relation`, `emergency_phone`, `emergency_email`, `campus`, `department`, `guardian_first_name`, `guardian_middle_name`, `guardian_last_name`, `guardian_relationship`, `guardian_dob`, `guardian_occupation`, `guardian_employer`, `guardian_email`, `guardian_phone`, `guardian_address`, `photo_path`, `created_at`) VALUES
(1, 'carl', 'mirabueno', 'b', 'Male', 23, '166', '2002-02-08', 'filipino', 'inc', 'single', 'carljoshuamirabueno@gmail.com', '09350874484', 'bahay ko', 'carl b mirabueno', 'pader', '09350874484', 'carljoshuamirabueno@gmail.com', 'Main Campus', 'College', 'deve', 'dwd', 'dwdw', 'other', '2025-08-01', 'cat house', 'werwa4wa', 'carl.mirabueno@cdsp.edu.ph', '1234567890', 'bahay ko', NULL, '2025-09-04 15:28:53'),
(2, 'carl', 'mirabueno', 'b', 'Male', 23, '166', '2002-02-08', 'filipino', 'inc', 'single', 'carljoshuamirabueno@gmail.com', '09350874484', 'bahay ko', 'carl b mirabueno', 'pader', '09350874484', 'carljoshuamirabueno@gmail.com', 'Main Campus', 'College', 'deve', 'dwd', 'dwdw', 'other', '2025-08-01', 'cat house', 'werwa4wa', 'carl.mirabueno@cdsp.edu.ph', '1234567890', 'bahay ko', NULL, '2025-09-04 15:36:01'),
(3, 'carl', 'mirabueno', 'b', 'Male', 23, '166', '2002-02-08', 'filipino', 'inc', '', 'carljoshuamirabueno@gmail.com', '09350874484', 'bahay ko', 'carl b mirabueno', 'pader', '09350874484', 'carljoshuamirabueno@gmail.com', 'Main Campus', 'College', 'deve', 'dwd', 'dwdw', 'grandparent', '2025-08-01', 'cat house', 'werwa4wa', 'carl.mirabueno@cdsp.edu.ph', '1234567890', 'bahay ko', NULL, '2025-09-04 15:36:21'),
(4, 'carl', 'mirabueno', 'b', 'Male', 23, '166', '2002-02-08', 'filipino', 'inc', '', 'carljoshuamirabueno@gmail.com', '09350874484', 'bahay ko', 'carl b mirabueno', 'pader', '09350874484', 'carljoshuamirabueno@gmail.com', 'Main Campus', 'Senior High', 'deve', 'dwd', 'dwdw', 'other', '2025-08-01', 'cat house', 'werwa4wa', 'carl.mirabueno@cdsp.edu.ph', '1234567890', 'bahay ko', NULL, '2025-09-04 15:45:00'),
(5, 'MARK JOSHUA', 'PUNZALAN', 'B', 'Male', 21, '165', '2004-03-10', 'PINAY', 'BORN AGAIN', 'married', 'markjoshuapunzalan2@gmail.com', '1234567890', 'bahay ko', 'carl b mirabueno', 'ako', '09350874484', 'markjoshuapunzalan2@gmail.com', 'South Campus', 'College', 'carl', 'b', 'mirabueno', 'other', '2025-09-10', 'cat house', 'dwararwa', 'markjoshuapunzalan2@gmail.com', '09350874484', 'bahay ko', NULL, '2025-09-04 16:07:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `otp` varchar(255) NOT NULL,
  `is_verified` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `otp`, `is_verified`) VALUES
(1, 'sdaw', 'carl.mirabueno@cdsp.edu.ph', '$2y$10$KrkHtGXpKHcsuLn1XtiHmuTdKWCT8Se0DG9Ie2YcI8/hsjl93Ymhi', '193013', '0'),
(2, 'cmir', 'carljoshuamirabueno@gmail.com', '$2y$10$qcvPaxk8T6TOTELj.GXeWu0UodIcUNtjzA7tSWH7VyWteLDhJEUQO', '612978', '1'),
(5, 'mjpunzalan', 'markjoshuapunzalan2@gmail.com', '$2y$10$2LbEOcWHPGgG5o3mS9aYRu02ZMgy22Jp8NDMwxwdHLIO08o50EP0y', '674547', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_applications`
--
ALTER TABLE `student_applications`
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
-- AUTO_INCREMENT for table `student_applications`
--
ALTER TABLE `student_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
