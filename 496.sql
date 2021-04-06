-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2021 at 12:13 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `496`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `empID` int(11) NOT NULL,
  `subject` text NOT NULL,
  `text` text NOT NULL,
  `title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `empID`, `subject`, `text`, `title`) VALUES
(1, 1, 'Schedule', 'Please check the new shift schedule. Let a manager know if there are any issues!', 'New Shift Schedule is out');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `CompanyID` int(11) NOT NULL,
  `CompanyName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`CompanyID`, `CompanyName`) VALUES
(1, 'Eli\'s Eatery');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `empID` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `CompanyID` int(11) NOT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `wage` int(11) NOT NULL,
  `hoursWorked` int(11) NOT NULL,
  `hoursWorkedLastWeek` int(11) NOT NULL,
  `managerStatus` tinyint(1) NOT NULL,
  `password` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`empID`, `uid`, `CompanyID`, `firstName`, `lastName`, `wage`, `hoursWorked`, `hoursWorkedLastWeek`, `managerStatus`, `password`) VALUES
(1, 3, 1, 'Eli', 'Estes', 3, 2, 3, 1, 123);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `empID` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `start_event` datetime NOT NULL,
  `end_event` datetime NOT NULL,
  `color` varchar(191) DEFAULT NULL,
  `text_color` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `empID`, `title`, `start_event`, `end_event`, `color`, `text_color`) VALUES
(2, 0, 'Project 1', '2021-02-16 08:30:00', '2021-02-16 09:00:00', '#6453e9', '#ffffff'),
(3, 1, 'Test Event', '2021-03-26 08:30:00', '2021-03-26 09:00:00', '#6453e9', '#ffffff');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `rid` int(11) NOT NULL,
  `empID` int(11) NOT NULL,
  `start_req` datetime NOT NULL,
  `end_req` datetime NOT NULL,
  `resolved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`rid`, `empID`, `start_req`, `end_req`, `resolved`) VALUES
(1, 1, '2021-04-01 12:00:00', '2021-04-03 12:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `created_at`) VALUES
(1, 'zdilliha@gmail.com', '$2y$10$mhnKVRfUjTW1QyQJo8NCWezcBzy8aAXIA2avATOZDm0Sx3vXPkFlK', '2021-03-16 22:02:43'),
(2, 'admin', '$2y$10$erl.ERrbdWwpPDJjVqaPpunBFNc/7ceDGlj2845SZJzqKP/NrrNey', '2021-03-16 23:02:18'),
(3, 'eli', '$2y$10$1cZi/.UcBbn/LUKT8QLEEemI36ZoOYo.dZ1F1QS2oIKGlvNPdqDnO', '2021-03-22 21:34:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empID` (`empID`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`CompanyID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`empID`),
  ADD KEY `CompanyID` (`CompanyID`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `empID_2` (`empID`),
  ADD KEY `empID` (`empID`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `empID` (`empID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcement`
--
ALTER TABLE `announcement`
  ADD CONSTRAINT `announcement_ibfk_1` FOREIGN KEY (`empID`) REFERENCES `employee` (`empID`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`CompanyID`) REFERENCES `company` (`CompanyID`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`empID`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
