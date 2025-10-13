-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2025 at 04:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrowed_books`
--

CREATE TABLE `borrowed_books` (
  `id` int(11) NOT NULL,
  `book_title` varchar(100) NOT NULL,
  `status` enum('Submitted','Not Submitted') NOT NULL,
  `borrowed_date` date NOT NULL,
  `return_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowed_books`
--

INSERT INTO `borrowed_books` (`id`, `book_title`, `status`, `borrowed_date`, `return_date`) VALUES
(1, 'Graphic Fundamentals', 'Not Submitted', '2024-02-10', '2024-03-10'),
(2, 'Data Structures', 'Submitted', '2024-01-15', '2024-02-15'),
(3, 'Operating Systems', 'Not Submitted', '2024-03-01', '2024-03-30');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_time` time NOT NULL,
  `instructor` varchar(100) DEFAULT NULL,
  `room` varchar(50) DEFAULT NULL,
  `day` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_code`, `course_name`, `course_time`, `instructor`, `room`, `day`) VALUES
(1, 'ART101', 'Graphic Design Fundamentals', '10:00:00', 'Prof. Smith', 'Room 101', ''),
(2, 'ART103', 'Digital Illustration', '14:00:00', 'Prof. Johnson', 'Room 202', ''),
(3, 'UXD301', 'UX/UI Design Principles', '13:00:00', 'Prof. Lee', 'Room 303', ''),
(4, 'ART101', 'History of Design Essay', '09:00:00', 'Prof. Adams', 'Room 101', ''),
(5, 'ART101', 'Graphic Design Fundamentals', '10:00:00', 'Prof. Smith', 'Room 101', 'Thu'),
(6, 'ART103', 'Digital Illustration', '14:00:00', 'Prof. Johnson', 'Room 202', 'Mon'),
(7, 'UXD301', 'UX/UI Design Principles', '13:00:00', 'Prof. Lee', 'Room 303', 'Sun'),
(8, 'ART101', 'History of Design Essay', '09:00:00', 'Prof. Adams', 'Room 101', 'Tue');

-- --------------------------------------------------------

--
-- Table structure for table `library_points`
--

CREATE TABLE `library_points` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `description` varchar(255) DEFAULT 'Earned Points',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `library_points`
--

INSERT INTO `library_points` (`id`, `student_id`, `points`, `description`, `created_at`) VALUES
(1, 1, 10, 'Borrowed a book', '2025-09-26 21:32:33'),
(2, 1, 10, 'Borrowed book', '2025-09-25 21:41:13'),
(3, 1, 15, 'Returned book early', '2025-09-24 21:41:13'),
(4, 1, 20, 'Joined reading program', '2025-09-23 21:41:13'),
(5, 1, 10, 'Attended seminar', '2025-09-22 21:41:13'),
(6, 1, 5, 'Daily login bonus', '2025-09-21 21:41:13'),
(7, 1, 25, 'Research contribution', '2025-09-20 21:41:13'),
(8, 1, 10, 'Book review submitted', '2025-09-19 21:41:13'),
(9, 1, 15, 'Participated in quiz', '2025-09-18 21:41:13'),
(10, 1, 10, 'Borrowed journal', '2025-09-17 21:41:13'),
(11, 1, 30, 'Library volunteer work', '2025-09-16 21:41:13'),
(12, 1, 10, 'Returned journal', '2025-09-15 21:41:13'),
(13, 1, 20, 'Helped in cataloging', '2025-09-14 21:41:13'),
(14, 1, 15, 'Participated in workshop', '2025-09-13 21:41:13'),
(15, 1, 10, 'Used e-library resources', '2025-09-12 21:41:13'),
(16, 1, 5, 'Daily login bonus', '2025-09-11 21:41:13'),
(17, 1, 20, 'Attended library event', '2025-09-10 21:41:13'),
(18, 1, 10, 'Submitted article summary', '2025-09-09 21:41:13'),
(19, 1, 25, 'Special recognition award', '2025-09-08 21:41:13'),
(20, 1, 15, 'Participated in debate', '2025-09-07 21:41:13'),
(21, 1, 10, 'Daily login bonus', '2025-09-06 21:41:13');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `message`, `created_at`) VALUES
(1, 'Books Not Submitted', 'There are 2 book(s) not yet returned.', '2025-09-27 13:39:56'),
(2, 'Books Not Submitted', 'There are 2 book(s) not yet returned.', '2025-09-27 13:40:03'),
(3, 'Books Not Submitted', 'There are 2 book(s) not yet returned.', '2025-09-27 13:40:34'),
(4, 'Books Not Submitted', 'There are 2 book(s) not yet returned.', '2025-09-27 13:40:49'),
(5, 'Books Not Submitted', 'There are 2 book(s) not yet returned.', '2025-09-27 13:41:17'),
(6, 'Overdue Book', 'Book \"Graphic Fundamentals\" is overdue.', '2025-09-27 13:43:05'),
(7, 'Overdue Book', 'Book \"Operating Systems\" is overdue.', '2025-09-27 13:43:05'),
(8, 'Overdue Book', 'Book \"Graphic Fundamentals\" is overdue.', '2025-09-27 13:44:16'),
(9, 'Overdue Book', 'Book \"Operating Systems\" is overdue.', '2025-09-27 13:44:16'),
(10, 'Overdue Book', 'Book \"Graphic Fundamentals\" is overdue.', '2025-09-27 13:45:59'),
(11, 'Overdue Book', 'Book \"Operating Systems\" is overdue.', '2025-09-27 13:45:59'),
(12, 'New Applicant', 'Anna Cruz submitted an application.', '2025-09-27 13:45:59'),
(13, 'New Applicant', 'Carlos Santos submitted an application.', '2025-09-27 13:45:59'),
(14, 'Overdue Book', 'Book \"Graphic Fundamentals\" is overdue.', '2025-09-27 13:47:49'),
(15, 'Overdue Book', 'Book \"Operating Systems\" is overdue.', '2025-09-27 13:47:49'),
(16, 'New Applicant', 'Anna Cruz submitted an application.', '2025-09-27 13:47:49'),
(17, 'New Applicant', 'Carlos Santos submitted an application.', '2025-09-27 13:47:49'),
(18, 'Overdue Book', 'Book \"Graphic Fundamentals\" is overdue.', '2025-09-27 13:48:18'),
(19, 'Overdue Book', 'Book \"Operating Systems\" is overdue.', '2025-09-27 13:48:18'),
(20, 'New Applicant', 'Anna Cruz submitted an application.', '2025-09-27 13:48:18'),
(21, 'New Applicant', 'Carlos Santos submitted an application.', '2025-09-27 13:48:18'),
(22, 'Overdue Book', 'Book \"Graphic Fundamentals\" is overdue.', '2025-09-27 13:49:49'),
(23, 'Overdue Book', 'Book \"Operating Systems\" is overdue.', '2025-09-27 13:49:49'),
(24, 'New Applicant', 'Anna Cruz submitted an application.', '2025-09-27 13:49:49'),
(25, 'New Applicant', 'Carlos Santos submitted an application.', '2025-09-27 13:49:49'),
(26, 'Overdue Book', 'Book \"Graphic Fundamentals\" is overdue.', '2025-09-27 13:51:03'),
(27, 'Overdue Book', 'Book \"Operating Systems\" is overdue.', '2025-09-27 13:51:03'),
(28, 'New Applicant', 'Anna Cruz submitted an application.', '2025-09-27 13:51:03'),
(29, 'New Applicant', 'Carlos Santos submitted an application.', '2025-09-27 13:51:03'),
(30, 'New Application', 'New applicant: Anna Cruz has applied.', '2025-09-27 13:52:47'),
(31, 'New Application', 'New applicant: Anna Cruz has applied.', '2025-09-27 13:53:33'),
(32, 'New Application', 'New applicant: Carlos Santos has applied.', '2025-09-27 13:53:33'),
(33, 'New Application', 'New applicant: carl has applied.', '2025-10-13 12:06:28'),
(34, 'New Application', 'New applicant: carl has applied.', '2025-10-13 12:06:29'),
(35, 'New Application', 'New applicant: carl has applied.', '2025-10-13 12:06:29'),
(36, 'New Application', 'New applicant: carl has applied.', '2025-10-13 12:06:45'),
(37, 'New Application', 'New applicant: carl has applied.', '2025-10-13 12:06:45'),
(38, 'New Application', 'New applicant: carl has applied.', '2025-10-13 12:06:45'),
(39, 'New Application', 'New applicant: carl has applied.', '2025-10-13 12:06:45'),
(40, 'New Application', 'New applicant: MARK JOSHUA has applied.', '2025-10-13 12:06:46'),
(41, 'New Application', 'New applicant: Rey Vergel has applied.', '2025-10-13 12:06:46'),
(42, 'New Application', 'New applicant: Rey Vergel has applied.', '2025-10-13 12:06:46'),
(43, 'New Application', 'New applicant: Rey Vergel has applied.', '2025-10-13 12:06:46'),
(44, 'New Application', 'New applicant: JOHN has applied.', '2025-10-13 12:06:46');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `application_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `student_id` varchar(20) NOT NULL,
  `course` varchar(100) NOT NULL,
  `section` varchar(50) NOT NULL,
  `year_level` varchar(20) NOT NULL,
  `status` enum('Active','Inactive','Finished','Dropped') DEFAULT 'Active',
  `library_points` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `application_id`, `user_id`, `student_id`, `course`, `section`, `year_level`, `status`, `library_points`) VALUES
(1, 1, 8, '23-324-51', 'BSA', '1A', '3rd Year', 'Active', 90),
(2, NULL, NULL, '25-395-52', 'BSIT', '1A', '1st Year', 'Active', 30),
(3, NULL, NULL, '25-394-51', 'BSIT', '1A', '1st Year', 'Active', 20),
(4, NULL, NULL, '24-326-51', 'BSCS', '2B', '2nd Year', 'Inactive', 15),
(5, NULL, NULL, '23-392-50', 'BSIT', '3C', '3rd Year', 'Finished', 50),
(6, NULL, NULL, '24-386-52', 'BSEd', '2A', '2nd Year', 'Dropped', 10),
(7, NULL, NULL, '25-395-53', 'BSBA', '1B', '1st Year', 'Active', 25);

-- --------------------------------------------------------

--
-- Table structure for table `student_applications`
--

CREATE TABLE `student_applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('New','Pending','Approved','Rejected') DEFAULT 'New',
  `notified` tinyint(1) DEFAULT 0,
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

INSERT INTO `student_applications` (`id`, `user_id`, `status`, `notified`, `first_name`, `last_name`, `middle_name`, `gender`, `age`, `height`, `date_of_birth`, `nationality`, `religion`, `civil_status`, `email`, `phone`, `address`, `emergency_name`, `emergency_relation`, `emergency_phone`, `emergency_email`, `campus`, `department`, `guardian_first_name`, `guardian_middle_name`, `guardian_last_name`, `guardian_relationship`, `guardian_dob`, `guardian_occupation`, `guardian_employer`, `guardian_email`, `guardian_phone`, `guardian_address`, `photo_path`, `created_at`) VALUES
(1, 2, 'New', 1, 'carl', 'mirabueno', 'b', 'Male', 23, '166', '2002-02-08', 'filipino', 'inc', 'single', 'carljoshuamirabueno@gmail.com', '09350874484', 'bahay ko', 'carl b mirabueno', 'pader', '09350874484', 'carljoshuamirabueno@gmail.com', 'Main Campus', 'College', 'deve', 'dwd', 'dwdw', 'other', '2025-08-01', 'cat house', 'werwa4wa', 'carl.mirabueno@cdsp.edu.ph', '1234567890', 'bahay ko', NULL, '2025-09-04 07:28:53'),
(2, 2, 'New', 1, 'carl', 'mirabueno', 'b', 'Male', 23, '166', '2002-02-08', 'filipino', 'inc', 'single', 'carljoshuamirabueno@gmail.com', '09350874484', 'bahay ko', 'carl b mirabueno', 'pader', '09350874484', 'carljoshuamirabueno@gmail.com', 'Main Campus', 'College', 'deve', 'dwd', 'dwdw', 'other', '2025-08-01', 'cat house', 'werwa4wa', 'carl.mirabueno@cdsp.edu.ph', '1234567890', 'bahay ko', NULL, '2025-09-04 07:36:01'),
(3, 2, 'New', 1, 'carl', 'mirabueno', 'b', 'Male', 23, '166', '2002-02-08', 'filipino', 'inc', '', 'carljoshuamirabueno@gmail.com', '09350874484', 'bahay ko', 'carl b mirabueno', 'pader', '09350874484', 'carljoshuamirabueno@gmail.com', 'Main Campus', 'College', 'deve', 'dwd', 'dwdw', 'grandparent', '2025-08-01', 'cat house', 'werwa4wa', 'carl.mirabueno@cdsp.edu.ph', '1234567890', 'bahay ko', NULL, '2025-09-04 07:36:21'),
(4, 2, 'New', 1, 'carl', 'mirabueno', 'b', 'Male', 23, '166', '2002-02-08', 'filipino', 'inc', '', 'carljoshuamirabueno@gmail.com', '09350874484', 'bahay ko', 'carl b mirabueno', 'pader', '09350874484', 'carljoshuamirabueno@gmail.com', 'Main Campus', 'Senior High', 'deve', 'dwd', 'dwdw', 'other', '2025-08-01', 'cat house', 'werwa4wa', 'carl.mirabueno@cdsp.edu.ph', '1234567890', 'bahay ko', NULL, '2025-09-04 07:45:00'),
(5, 5, 'New', 1, 'MARK JOSHUA', 'PUNZALAN', 'B', 'Male', 21, '165', '2004-03-10', 'PINAY', 'BORN AGAIN', 'married', 'markjoshuapunzalan2@gmail.com', '1234567890', 'bahay ko', 'carl b mirabueno', 'ako', '09350874484', 'markjoshuapunzalan2@gmail.com', 'South Campus', 'College', 'carl', 'b', 'mirabueno', 'other', '2025-09-10', 'cat house', 'dwararwa', 'markjoshuapunzalan2@gmail.com', '09350874484', 'bahay ko', NULL, '2025-09-04 08:07:36'),
(6, 6, 'New', 1, 'Rey Vergel', 'Abella', 'b', 'Male', 21, '180', '2025-09-17', 'filipino', 'christian', 'single', 'abellareyvergel@gmail.com', '09632538228', 'jdwjdjdw&#13;&#10;delapaz', 'Rey Vergel Abella', 'anak', '098872662362', 'abellareyvergel@gmail.com', 'Main Campus', 'College', 'Rey Vergel', '', 'Abella', 'family_friend', '2025-09-17', 'wala', 'walall', 'abellareyvergel@gmail.com', '09986636632', 'dito lng sana', NULL, '2025-09-17 04:35:34'),
(7, 6, 'New', 1, 'Rey Vergel', 'Abella', 'b', 'Female', 9, '180', '2025-09-17', 'filipino', 'christian', '', 'abellareyvergel@gmail.com', '09876663644', 'dyan lng', 'Rey Vergel b Abella', 'anak', '09876663644', 'abellareyvergel@gmail.com', 'North Campus', 'Senior High', 'Rey Vergel', 'b', 'Abella', 'aunt/uncle', '2025-09-17', 'wala ', 'walall', 'abellareyvergel@gmail.com', '09876663644', 'pacita felipe', NULL, '2025-09-17 06:33:49'),
(8, 6, 'New', 1, 'Rey Vergel', 'Abella', 'b', 'Female', 9, '180', '2025-09-17', 'filipino', 'christian', 'married', 'abellareyvergel@gmail.com', '09876663644', 'jdwjdjdw&#13;&#10;delapaz', 'Rey Vergel b Abella', 'anak', '09876663644', 'abellareyvergel@gmail.com', 'North Campus', 'Senior High', 'Rey Vergel', 'b', 'Abella', 'sibling', '2025-09-17', 'wala', 'walall', 'abellareyvergel@gmail.com', '09876663644', 'jdwjdjdw&#13;&#10;delapaz', NULL, '2025-09-17 06:37:41'),
(9, 8, 'New', 1, 'JOHN', 'OLIVERA', 'REY', 'Male', 21, '190', '1999-04-30', 'Filipino', 'Christian', 'single', 'johnrey.olivera22@gmail.com', '0910 091 0910', 'BLK1B LOT 56 BANAHAW ST. SOUTHERN HEIGHTS 2&#13;&#10;UNITED BETTER LIVING', 'carlo carillo', 'Tropa', '9121 012 1213', 'carlo@cdsp.edu.ph', 'Main Campus', 'College', 'NA', 'NA', 'NA', 'family_friend', '2025-09-03', 'ajahaha', 'c', 'adad@adasda.com', '1929 -123 1231', 'Banahaw avenue', NULL, '2025-09-29 21:44:27');

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
  `is_verified` varchar(255) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `otp_expires` datetime DEFAULT NULL,
  `user_type` enum('applicant','student','admin') DEFAULT 'applicant'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `otp`, `is_verified`, `reset_token`, `reset_expires`, `otp_expires`, `user_type`) VALUES
(1, 'sdaw', 'carl.mirabueno@cdsp.edu.ph', '$2y$10$KrkHtGXpKHcsuLn1XtiHmuTdKWCT8Se0DG9Ie2YcI8/hsjl93Ymhi', '193013', '0', NULL, NULL, NULL, 'applicant'),
(2, 'cmir', 'carljoshuamirabueno@gmail.com', '$2y$10$qcvPaxk8T6TOTELj.GXeWu0UodIcUNtjzA7tSWH7VyWteLDhJEUQO', '612978', '1', NULL, NULL, NULL, 'applicant'),
(5, 'mjpunzalan', 'markjoshuapunzalan2@gmail.com', '$2y$10$2LbEOcWHPGgG5o3mS9aYRu02ZMgy22Jp8NDMwxwdHLIO08o50EP0y', '674547', '1', NULL, NULL, NULL, 'applicant'),
(6, 'pogi', 'abellareyvergel@gmail.com', '$2y$10$38omSgnFQymV92fArTLrte/HuFDB1j/zxG9.EPoaopBEuN9KQ.WXa', '523535', '1', '0722984faf48f4f9a34a8b2cd93520eb38d85da5f5d10800580fe4e2693a6d7d', '2025-09-16 20:41:12', '2025-09-17 16:16:30', 'applicant'),
(7, 'oliver_22', 'oliverarey@yahoo.com', '$2y$10$NdEokO7ZGdGMaAaoGGiM.ua1eEcy03.pLFlNlr/q9JoV3b5WOP3TC', '860015', '0', NULL, NULL, NULL, 'applicant'),
(8, 'john rey', 'johnrey.olivera22@gmail.com', '$2y$10$CdqtCUWOeELftEaZBiOrb.0X5rsYNlBmPhm/avl3LerspyQUJpDhu', '', '1', NULL, NULL, NULL, 'admin'),
(9, 'olives', 'oliverajohnrey0220@gmail.com', '$2y$10$G98dyXr2tSH2s9U/3kCQYOKH/RXGSZM9a52xBIk/PjcrI2QsGwN0.', '974283', '1', NULL, NULL, NULL, 'applicant');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `library_points`
--
ALTER TABLE `library_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_students_user` (`user_id`),
  ADD KEY `fk_students_application` (`application_id`);

--
-- Indexes for table `student_applications`
--
ALTER TABLE `student_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_student_applications_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `library_points`
--
ALTER TABLE `library_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student_applications`
--
ALTER TABLE `student_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_students_application` FOREIGN KEY (`application_id`) REFERENCES `student_applications` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_students_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_applications`
--
ALTER TABLE `student_applications`
  ADD CONSTRAINT `fk_student_applications_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
