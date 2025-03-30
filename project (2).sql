-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2025 at 10:02 AM
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
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Course` varchar(20) NOT NULL,
  `Semester` varchar(20) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Upload` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`id`, `User_id`, `Course`, `Semester`, `Title`, `Upload`) VALUES
(10, 1, 'BCA', '4th', 'DSA assignmnet', 'Sim.pdf'),
(11, 136, 'BCA', '1st', 'Holiday', 'Sim.pdf'),
(12, 136, 'BCA', '1st', 'Holiday', 'last-and-FINAL-documentation-final.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `marks_id` int(255) NOT NULL,
  `User_id` int(11) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `subject1` varchar(20) NOT NULL,
  `marks1` float NOT NULL,
  `subject2` varchar(20) NOT NULL,
  `marks2` float NOT NULL,
  `subject3` varchar(20) NOT NULL,
  `marks3` float NOT NULL,
  `subject4` varchar(20) NOT NULL,
  `marks4` float NOT NULL,
  `subject5` varchar(20) NOT NULL,
  `marks5` float NOT NULL,
  `gpa` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`marks_id`, `User_id`, `semester`, `subject1`, `marks1`, `subject2`, `marks2`, `subject3`, `marks3`, `subject4`, `marks4`, `subject5`, `marks5`, `gpa`) VALUES
(36, 147, '4th', 'SAD', 3.2, 'OS', 3.6, 'SE', 3, 'NM', 2.8, 'DBMS', 3.2, 3.16);

-- --------------------------------------------------------

--
-- Table structure for table `notice_board`
--

CREATE TABLE `notice_board` (
  `Notice_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `notice` text NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notice_board`
--

INSERT INTO `notice_board` (`Notice_id`, `User_id`, `Title`, `notice`, `Date`) VALUES
(236, 1, 'HOLIDAY', 'tomorrow is a holiday\r\n', '2024-05-16'),
(237, 1, 'EXAM NOTICE', 'the pre boards for BCA 4th are atarting from 21 baishakh\r\n', '2024-05-23'),
(238, 1, 'Holiday', 'tomorrow is a holiday', '2024-05-26'),
(239, 1, 'holiday', 'tomorrow is a holiday', '2024-05-26');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `Timetable_ID` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Course` varchar(100) DEFAULT NULL,
  `Semester` varchar(50) DEFAULT NULL,
  `time1` varchar(11) NOT NULL,
  `time2` varchar(11) NOT NULL,
  `time3` varchar(11) NOT NULL,
  `time4` varchar(11) NOT NULL,
  `time5` varchar(11) NOT NULL,
  `period1` varchar(255) NOT NULL,
  `period2` varchar(255) NOT NULL,
  `period3` varchar(255) NOT NULL,
  `period4` varchar(255) NOT NULL,
  `period5` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`Timetable_ID`, `User_id`, `Course`, `Semester`, `time1`, `time2`, `time3`, `time4`, `time5`, `period1`, `period2`, `period3`, `period4`, `period5`) VALUES
(5, 1, 'BCA', '2nd', '6:30-7:30', '7:30-8:30', '8:30-9:30', '9:30-10:30', '10:30-11:30', 'Maths', 'English', 'Nepali', 'Sociology', 'Computer'),
(6, 1, 'BCA', '4th', '6:30-7:30', '7:30-8:30', '8:30-9:30', '9:30-10:30', '10:30-11:30', 'SAD', 'OS', 'SE', 'NM', 'DBMS');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Gender` enum('Male','Female','Other') NOT NULL,
  `Role` enum('student','teacher','admin') DEFAULT NULL,
  `Nationality` varchar(50) DEFAULT NULL,
  `User_id` int(100) NOT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Course` varchar(100) DEFAULT NULL,
  `Semester` varchar(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `EmergencyContactPersonName` varchar(100) DEFAULT NULL,
  `EmergencyContactNumber` tinytext DEFAULT NULL,
  `Photo` varchar(255) NOT NULL,
  `reset_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `FirstName`, `LastName`, `DOB`, `Gender`, `Role`, `Nationality`, `User_id`, `Password`, `Course`, `Semester`, `Email`, `PhoneNumber`, `Address`, `EmergencyContactPersonName`, `EmergencyContactNumber`, `Photo`, `reset_token`) VALUES
(1, 'Admin', 'Admin', NULL, '', 'admin', NULL, 123, '$2y$10$/Rr0qNp9r5xoghgJSED00eRt3PjrU2WXp0PscqD4n6olCE72CuDMO', NULL, NULL, 'shreestha113@gmail.com', NULL, NULL, NULL, NULL, '', ''),
(136, 'teacher', 'chitrakar', '1999-12-13', 'Male', 'teacher', 'Nepali', 6001, '$2y$10$zdYMYgjY/zXb2NBLXG4bP.T8ElMQM/U9q.HmgR5FlkEQPGH59N.x6', 'BCA', '4th', 'teacher@gmail.com', '9812312312', 'kathmandu', 'jwala ', '9812312312', 'photos/teacher.jpg', ''),
(147, 'Student', 'shrestha', '2005-05-05', 'Male', 'student', 'Nepali', 41001, '$2y$10$NH32ptiRFQGA0fnjBm2kbuhjSzbkOfA2MfEjJD7RvPX6QcUIb51sG', 'BCA', '4th', 'student@gmail.com', '9812312312', 'kathmandu', 'Samridhi', '9812312312', 'photos/student.jpg', ''),
(148, 'Student', 'sthapit', '2005-06-06', 'Female', 'student', 'Nepali', 41002, '$2y$10$NH32ptiRFQGA0fnjBm2kbuhjSzbkOfA2MfEjJD7RvPX6QcUIb51sG', 'BCA', '2nd', 'sthapit@gmail.com', '9812312312', 'kathmandu', 'Samridhi', '9812312312', 'photos/student.jpg', ''),
(150, 'Student', 'Samridhi', '0009-02-22', 'Female', 'student', 'Nepali', 41005, '$2y$10$Xn7ch4qzfagr8/jfLP4xQuAM4pfWk5RzGK1wIMBwxFOuYBe5oCEnO', 'BCA', '2nd', 'sad@gmail.com', '9812312312', 'kathmanduy', 'Samridhi', '9812312312', 'photos/441501510_1722153185218220_7186884947252189154_n (1).png', ''),
(151, 'Teacher', 'Teacher', '2025-03-30', 'Male', 'teacher', 'Nepal', 1010, '$2y$10$419vhrtksGweKge4FbFPwue2fvEo8PEsrdL5lnCw/mHyQejSe.heC', 'BCA', '6th', 'shreestha113@gmail.com', '9812345678', 'ason', 'Ram', '9812345678', 'photos/Screenshot 2024-06-04 172857.png', ''),
(152, 'Student', 'Student', '2000-01-01', 'Male', 'student', 'Nepal`', 1011, '$2y$10$5yzCI1v0Y4t5NmakXocBjO5S/nw5v6u5nys3BTWuE9XyNxUyDmJ16', 'BCA', '6th', 'shreestha113@gmail.com', '9812345678', 'jhapa', 'ramu', '9878894612', 'photos/Screenshot 2024-05-19 224606.png', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_assignment` (`User_id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`marks_id`),
  ADD KEY `User_id_fk` (`User_id`);

--
-- Indexes for table `notice_board`
--
ALTER TABLE `notice_board`
  ADD PRIMARY KEY (`Notice_id`),
  ADD KEY `fk_notice_board` (`User_id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`Timetable_ID`),
  ADD KEY `fk_timetable` (`User_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `marks_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `notice_board`
--
ALTER TABLE `notice_board`
  MODIFY `Notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `Timetable_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `fk_assignment` FOREIGN KEY (`User_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `User_id_fk` FOREIGN KEY (`User_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notice_board`
--
ALTER TABLE `notice_board`
  ADD CONSTRAINT `fk_notice_board` FOREIGN KEY (`User_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `timetable`
--
ALTER TABLE `timetable`
  ADD CONSTRAINT `fk_timetable` FOREIGN KEY (`User_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
