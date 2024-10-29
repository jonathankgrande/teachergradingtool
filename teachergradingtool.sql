-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 29, 2024 at 06:21 PM
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
-- Database: `teachergradingtool`
--

-- --------------------------------------------------------

--
-- Table structure for table `final_scores`
--

CREATE TABLE `final_scores` (
  `score_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `final_score` decimal(5,2) DEFAULT NULL,
  `grade_status` enum('Passed','Failed','Incomplete') DEFAULT 'Incomplete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `grade_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `homework_1` int(11) DEFAULT NULL,
  `homework_2` int(11) DEFAULT NULL,
  `homework_3` int(11) DEFAULT NULL,
  `homework_4` int(11) DEFAULT NULL,
  `homework_5` int(11) DEFAULT NULL,
  `quiz_1` int(11) DEFAULT NULL,
  `quiz_2` int(11) DEFAULT NULL,
  `quiz_3` int(11) DEFAULT NULL,
  `quiz_4` int(11) DEFAULT NULL,
  `quiz_5` int(11) DEFAULT NULL,
  `dropped_quiz` int(11) DEFAULT NULL,
  `midterm` int(11) DEFAULT NULL,
  `final_project` int(11) DEFAULT NULL,
  `homework_avg` decimal(5,2) DEFAULT NULL,
  `quiz_avg` decimal(5,2) DEFAULT NULL,
  `final_grade` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `class` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `name`, `class`) VALUES
(1, 'Saul Alvarez', 'Calc 301'),
(2, 'Gennady Golovkin', 'Calc 301'),
(3, 'Floyd Mayweather', 'Calc 301'),
(4, 'Manny Pacquiao', 'Calc 301'),
(5, 'Mike Tyson', 'Calc 301'),
(6, 'Evander Holyfield', 'Calc 301'),
(7, 'Oscar De La Hoya', 'Calc 301'),
(8, 'Sugar Ray Leonard', 'Calc 301'),
(9, 'Muhammad Ali', 'Calc 301'),
(10, 'Joe Frazier', 'Calc 301');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `final_scores`
--
ALTER TABLE `final_scores`
  ADD PRIMARY KEY (`score_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`grade_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `final_scores`
--
ALTER TABLE `final_scores`
  MODIFY `score_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `final_scores`
--
ALTER TABLE `final_scores`
  ADD CONSTRAINT `final_scores_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
