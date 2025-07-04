-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2025 at 12:17 PM
-- Server version: 8.0.42
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `feedback_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'Admin User', 'admin@gmail.com ', '$2y$10$paAYY7cxDv583KGdz7xlD.o0icUBzl8F6OgX0fHzjFi16RLoArTKG');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `branch` varchar(50) DEFAULT NULL,
  `year` int DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `username`, `name`, `email`, `subject`, `branch`, `year`, `password`, `user_id`, `comment`) VALUES
(1, 'faculty1', 'Dr.Ishwarya', 'ishwarya@abc.com', 'Data Structures', 'CSE', 3, '$2y$10$RxV1HcYsmWmvQrLezEhBuO8BbMzPjz./VZkL1Gimj1Z9cKvu4zNcW', NULL, NULL),
(2, 'faculty2', 'Dr.Sangeetha', 'sangeetha@abc.com', 'Operating Systems', 'CSE', 3, '$2b$12$BJt/drgRTWRK.TnScC12I.Mzpq//omIakfP4fEKkvlUoj1Is00tJS', NULL, NULL),
(3, 'faculty3', 'Dr.Yuvasri', 'yuvasri@abc.com', 'DBMS', 'CSE', 3, '$2b$12$kxJ4rFMetMg3sQjxV8ee6Oit3gVYU3Rd1oC./rqMJ0Nuj0LQ6iUJO', NULL, NULL),
(4, 'faculty4', 'Dr.Prasath', 'prasath@abc.com', 'Computer Networks', 'CSE', 3, '$2b$12$nkfqpBW2GECL5PJZqrkOu.jspQOLgdLk46DL4avwhWOQ8adG6KYIa', NULL, NULL),
(5, 'faculty5', 'Dr.sudhakar', 'sudhakar@abc.com', 'Software Engg', 'CSE', 3, '$2b$12$KtQJl63mcMV.HujybZ4e/OTVpg5mm9Jhf4Qd3bnOF5754pjueyaPK', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int NOT NULL,
  `student_id` int DEFAULT NULL,
  `faculty_id` int DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `comments` text,
  `submitted_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `subject_id` int DEFAULT NULL,
  `feedback` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `student_id`, `faculty_id`, `rating`, `comments`, `submitted_at`, `subject_id`, `feedback`, `comment`) VALUES
(4, 27, 1, 5, 'very good', '2025-06-26 12:45:39', 1, '', NULL),
(5, 27, 1, 5, 'good', '2025-06-26 12:51:49', 1, '', NULL),
(6, 27, 1, 5, 'good', '2025-06-26 13:08:30', 1, '', NULL),
(7, 27, 1, 1, 'good', '2025-06-26 14:33:17', 1, '', NULL),
(8, 27, 1, 5, 'good', '2025-06-26 16:24:47', 1, '', NULL),
(9, 27, 1, 5, 'good', '2025-06-26 16:36:15', 1, '', NULL),
(10, 27, 1, 5, 'good', '2025-06-26 17:16:33', 1, '', NULL),
(11, 27, 1, 5, '~~~````@#^', '2025-06-26 17:20:30', 1, '', NULL),
(12, 27, 1, 4, 'good', '2025-06-27 10:06:34', 1, '', NULL),
(13, 27, 1, 5, 'good', '2025-06-28 12:20:18', 0, NULL, NULL),
(14, 27, 1, 5, 'good', '2025-06-28 12:24:36', 0, NULL, NULL),
(15, 27, 1, 5, 'g', '2025-06-28 15:05:29', 2, NULL, NULL),
(16, 27, 3, 5, 'good', '2025-06-28 16:18:25', 3, NULL, NULL),
(17, 27, 1, 5, 'good', '2025-06-30 12:21:52', 1, NULL, NULL),
(18, 27, 3, 5, 'good', '2025-06-30 20:04:32', 3, NULL, NULL),
(19, 27, 2, 4, 'good', '2025-06-30 20:34:58', 2, NULL, NULL),
(20, 27, 1, 5, 'excellent', '2025-06-30 21:25:27', 1, NULL, NULL),
(21, 27, 1, 5, NULL, '2025-06-30 21:39:49', 1, NULL, 'good'),
(22, 27, 3, 5, 'good', '2025-07-01 10:35:13', 3, NULL, NULL),
(23, 27, 4, 5, 'good', '2025-07-01 10:36:39', 4, NULL, NULL),
(24, 27, 3, 5, 'good', '2025-07-01 10:38:29', 3, NULL, NULL),
(25, 27, 4, 4, 'good', '2025-07-01 10:38:56', 4, NULL, NULL),
(26, 27, 5, 5, 'good', '2025-07-01 10:41:01', 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `branch` varchar(50) DEFAULT NULL,
  `year` int DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `username`, `email`, `branch`, `year`, `password`) VALUES
(27, 'Student Two', NULL, 'CSE', 3, '$2y$10$DfApbN2oG26tY0kcxgE2GeGV7UAYA5fv26/3qTHBHLJ3eNVs4UN9i');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `year` int NOT NULL,
  `faculty_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`, `branch`, `year`, `faculty_id`) VALUES
(1, 'Data Structures', '', 2, 1),
(2, 'Operating Systems', '', 3, 2),
(3, 'DBMS', '', 3, 3),
(4, 'Computer Networks', '', 4, 4),
(5, 'Software Engg', '', 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('student','faculty','admin') DEFAULT NULL,
  `branch` varchar(50) DEFAULT NULL,
  `year` int DEFAULT NULL,
  `subject` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `branch`, `year`, `subject`) VALUES
(1, 'Dr.Ishwarya', 'faculty1', '$2y$10$VAHxBUuBibEOCvN3Jza10u0w8pmqKCzk2JJv0Z2kppuf79IAYOu7i', 'faculty', NULL, NULL, 'Data Structures'),
(2, 'Dr.Sangeetha', 'faculty2', '$2b$12$BJt/drgRTWRK.TnScC12I.Mzpq//omIakfP4fEKkvlUoj1Is00tJS', 'faculty', NULL, NULL, 'Operating Systems'),
(3, 'Dr.Yuvasri', 'faculty3', '$2b$12$kxJ4rFMetMg3sQjxV8ee6Oit3gVYU3Rd1oC./rqMJ0Nuj0LQ6iUJO', 'faculty', NULL, NULL, 'DBMS'),
(4, 'Dr.Prasath', 'faculty4', '$2b$12$nkfqpBW2GECL5PJZqrkOu.jspQOLgdLk46DL4avwhWOQ8adG6KYIa', 'faculty', NULL, NULL, 'Computer Networks'),
(5, 'Dr.sudhakar', 'faculty5', '$2b$12$KtQJl63mcMV.HujybZ4e/OTVpg5mm9Jhf4Qd3bnOF5754pjueyaPK', 'faculty', NULL, NULL, 'Software Engg'),
(27, 'Student Two', 'student3', '$2y$10$DfApbN2oG26tY0kcxgE2GeGV7UAYA5fv26/3qTHBHLJ3eNVs4UN9i', 'student', 'CSE', 3, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_faculty_user` (`user_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `faculty`
--
ALTER TABLE `faculty`
  ADD CONSTRAINT `fk_faculty_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
