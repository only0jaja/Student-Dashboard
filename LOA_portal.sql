-- USERS TABLE
CREATE TABLE `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `otp` VARCHAR(255) DEFAULT NULL,
  `is_verified` TINYINT(1) DEFAULT 0,
  `reset_token` VARCHAR(255) DEFAULT NULL,
  `reset_expires` DATETIME DEFAULT NULL,
  `otp_expires` DATETIME DEFAULT NULL,
  `user_type` ENUM('applicant', 'student', 'admin') DEFAULT 'applicant',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- APPLICATIONS TABLE
CREATE TABLE `applications` (
  `applicant_id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL, -- 🔗 connection to users
  `first_name` VARCHAR(100) NOT NULL,
  `last_name` VARCHAR(100) NOT NULL,
  `middle_name` VARCHAR(100) DEFAULT NULL,
  `gender` VARCHAR(10) NOT NULL,
  `age` INT(11) NOT NULL,
  `height` VARCHAR(10) NOT NULL,
  `date_of_birth` DATE NOT NULL,
  `nationality` VARCHAR(100) NOT NULL,
  `religion` VARCHAR(100) NOT NULL,
  `civil_status` VARCHAR(50) DEFAULT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  `address` TEXT NOT NULL,
  `campus` VARCHAR(100) NOT NULL,
  `department` VARCHAR(100) NOT NULL,
  `course` VARCHAR(100) NOT NULL,
  `status` ENUM('New','Pending','Approved','Rejected') DEFAULT 'New',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- STUDENTS TABLE
CREATE TABLE `students` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL, -- 🔗 connection to users
  `application_id` INT(11) NOT NULL, -- 🔗 optional link to application
  `student_id` VARCHAR(20) NOT NULL,
  `course` VARCHAR(100) NOT NULL,
  `section` VARCHAR(50) NOT NULL,
  `year_level` VARCHAR(20) NOT NULL,
  `status` ENUM('Active','Inactive','Finished','Dropped') DEFAULT 'Active',
  `library_points` INT(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`application_id`) REFERENCES `applications`(`applicant_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
