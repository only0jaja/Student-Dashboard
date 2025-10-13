-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2025 at 05:28 PM
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
-- Database: `student_dashboard_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications_2`
--

CREATE TABLE `applications_2` (
  `applicant_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `course` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` enum('New','Reviewed','Accepted','Rejected') DEFAULT 'New',
  `notified` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications_2`
--

INSERT INTO `applications_2` (`applicant_id`, `name`, `course`, `email`, `status`, `notified`, `created_at`) VALUES
(1, 'Maria Santos', 'BSIT', 'maria.santos@example.com', 'New', 1, '2025-10-13 23:10:16'),
(2, 'John Dela Cruz', 'BSCS', 'john.delacruz@example.com', 'New', 1, '2025-10-13 23:10:16'),
(3, 'Anna Lopez', 'BSIS', 'anna.lopez@example.com', 'Reviewed', 1, '2025-10-11 23:10:16'),
(4, 'Michael Reyes', 'BSSE', 'michael.reyes@example.com', 'Accepted', 1, '2025-10-08 23:10:16'),
(5, 'Karla Mendoza', 'BSIT', 'karla.mendoza@example.com', 'Rejected', 1, '2025-10-10 23:10:16');

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
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `message`, `created_at`) VALUES
(1, 'New Application', 'New applicant: Maria Santos has applied.', '2025-10-13 23:10:18'),
(2, 'New Application', 'New applicant: Maria Santos has applied.', '2025-10-13 23:10:19'),
(3, 'New Application', 'New applicant: Maria Santos has applied.', '2025-10-13 23:10:19'),
(4, 'New Application', 'New applicant: Maria Santos has applied.', '2025-10-13 23:10:19'),
(5, 'New Application', 'New applicant: Maria Santos has applied.', '2025-10-13 23:10:19'),
(6, 'New Application', 'New applicant: Maria Santos has applied.', '2025-10-13 23:10:22'),
(7, 'New Application', 'New applicant: Maria Santos has applied.', '2025-10-13 23:10:22'),
(8, 'New Application', 'New applicant: Maria Santos has applied.', '2025-10-13 23:10:46'),
(9, 'New Application', 'New applicant: John Dela Cruz has applied.', '2025-10-13 23:10:46');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `library_points` int(11) DEFAULT 0,
  `course` varchar(100) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `year_level` varchar(10) DEFAULT NULL,
  `status` enum('Active','Inactive','Finished','Dropped') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `student_id`, `library_points`, `course`, `section`, `year_level`, `status`) VALUES
(1, 'John Doe', '23-394-51', 90, 'BSIT', '1A', '3rd Year', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications_2`
--
ALTER TABLE `applications_2`
  ADD PRIMARY KEY (`applicant_id`);

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications_2`
--
ALTER TABLE `applications_2`
  MODIFY `applicant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
