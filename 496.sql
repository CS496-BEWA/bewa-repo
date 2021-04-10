-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2021 at 05:39 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

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
(1, 1, 'Testing', 'This is a test Announcement', 'Testing'),
(2, 1, 'test announcement 2', 'This is a second Announcement', 'Testing 2'),
(3, 1, 'Test Subject', 'Test Text', 'Test Title');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `empID` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `wage` int(11) NOT NULL DEFAULT 0,
  `hoursWorked` int(11) NOT NULL DEFAULT 0,
  `hoursWorkedLastWeek` int(11) NOT NULL DEFAULT 0,
  `managerStatus` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`empID`, `uid`, `wage`, `hoursWorked`, `hoursWorkedLastWeek`, `managerStatus`) VALUES
(3, 22, 0, 0, 0, 1);

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
(2, 0, 'Project 1', '2021-02-16 08:30:00', '2021-02-16 09:00:00', '#6453e9', '#ffffff');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `rid` int(11) NOT NULL,
  `empID` int(11) NOT NULL,
  `reqType` tinyint(1) NOT NULL,
  `start_req` datetime NOT NULL,
  `end_req` datetime NOT NULL,
  `resolved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`rid`, `empID`, `reqType`, `start_req`, `end_req`, `resolved`) VALUES
(1, 1, 0, '2021-04-01 12:00:00', '2021-04-03 12:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `isAdmin` tinyint(1) NOT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `created_at`, `isAdmin`, `firstName`, `lastName`) VALUES
(1, 'zdilliha@gmail.com', '$2y$10$mhnKVRfUjTW1QyQJo8NCWezcBzy8aAXIA2avATOZDm0Sx3vXPkFlK', '2021-03-16 22:02:43', 1, '', ''),
(2, 'admin', '$2y$10$erl.ERrbdWwpPDJjVqaPpunBFNc/7ceDGlj2845SZJzqKP/NrrNey', '2021-03-16 23:02:18', 1, 'adminFirstName', 'adminLastName'),
(3, 'zach1', '$2y$10$1Ea43sr3P6BmKPBeXHJsVejPxlIFzgF3wfyv/DAo4fbBVTl/UWxsi', '2021-03-17 12:47:45', 0, '', ''),
(4, 'testingNames', '$2y$10$.VARZpfNlotHs56PEulLoOjQkWsWf12T2PwQK4mQlK0NGfz3YbVE.', '2021-03-30 23:50:56', 0, 'First Name', 'Last Name'),
(20, 'admin2', '$2y$10$EoOSibb7AM0aWInuRfKtIO7v/BEnKR6iNl5JKGx/o6S/I4J9N86Ru', '2021-04-07 20:06:27', 1, 'test', 'updatethree'),
(21, 'admin3', '$2y$10$CW0IhpdjkPIuSRa9fNQapeB9FlgES2MxWkmFJY.L9PS42TvDQr.aK', '2021-04-07 22:27:53', 0, 'admin3', 'admin3'),
(22, 'testingAdminAdd', '$2y$10$uxvj1bEbsUN4iTVxgu8LPOAS2332JOQ/N13hrNrldTZEWf170bEKW', '2021-04-09 21:35:07', 1, 'test', 'manager');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`empID`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `empID_2` (`empID`),
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
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `empID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
