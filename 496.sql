-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2021 at 03:43 AM
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
(4, 6, 'UploadSubject', 'Test', 'Test');

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
(3, 22, 9, 9, 9, 0),
(4, 23, 0, 0, 0, 1),
(6, 25, 10, 100, 40, 1),
(7, 26, 6, 6, 6, 0),
(8, 27, 0, 0, 0, 1),
(9, 28, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `rid` int(11) NOT NULL,
  `empID` int(11) NOT NULL,
  `reqType` tinyint(1) NOT NULL,
  `timeOffID` int(11) DEFAULT NULL,
  `shiftSwapID` int(11) DEFAULT NULL,
  `start_req` datetime NOT NULL DEFAULT current_timestamp(),
  `resolved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`rid`, `empID`, `reqType`, `timeOffID`, `shiftSwapID`, `start_req`, `resolved`) VALUES
(38, 6, 1, 48, NULL, '2021-04-15 22:45:31', 1),
(39, 6, 1, 49, NULL, '2021-04-15 22:45:49', 1),
(40, 6, 1, 50, NULL, '2021-04-15 22:47:52', 2),
(41, 6, 1, 51, NULL, '2021-04-16 14:04:26', 0),
(42, 6, 0, NULL, 1, '2021-04-16 19:55:35', 1),
(43, 9, 0, NULL, 2, '2021-04-16 20:29:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `shiftswaprequests`
--

CREATE TABLE `shiftswaprequests` (
  `id` int(11) NOT NULL,
  `empID1` int(11) NOT NULL,
  `empID2` int(11) NOT NULL,
  `shiftDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shiftswaprequests`
--

INSERT INTO `shiftswaprequests` (`id`, `empID1`, `empID2`, `shiftDate`) VALUES
(1, 6, 3, '2021-04-15'),
(2, 9, 3, '2021-04-21');

-- --------------------------------------------------------

--
-- Table structure for table `timeoffrequests`
--

CREATE TABLE `timeoffrequests` (
  `timeOffID` int(11) NOT NULL,
  `startTime` date NOT NULL,
  `endTime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timeoffrequests`
--

INSERT INTO `timeoffrequests` (`timeOffID`, `startTime`, `endTime`) VALUES
(48, '2021-04-14', '2021-04-16'),
(49, '2021-04-01', '2021-04-30'),
(50, '2021-04-17', '2021-04-24'),
(51, '2021-04-13', '2021-04-17');

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
(22, 'testingAdminAdd', '$2y$10$uxvj1bEbsUN4iTVxgu8LPOAS2332JOQ/N13hrNrldTZEWf170bEKW', '2021-04-09 21:35:07', 0, 'Zach', 'admin'),
(23, 'test5', '$2y$10$SudYR9NJ1so4AKUrWrv/a.8bvXRV7lmMk0NucebZpsFCFBsbgE7iu', '2021-04-10 17:31:13', 1, 'test', 'last'),
(25, 'admin2', '$2y$10$KRKHMX4oFL43uBhOKN0tbuHlyEC8JPZY4zJHP.SC.Hu74SziG5ZfG', '2021-04-11 15:56:53', 1, 'Zach', 'Dilliha'),
(26, 'admin3', '$2y$10$wb1KXVstIehFEk1Xni1TNu5VULjdB2okmNZxcu5E/zy3fFGoIWdPm', '2021-04-11 16:00:19', 0, 'Test', 'Test'),
(27, 'jhn22316', '$2y$10$TekcMDQRnCBhe5wyLiJjxOtyvx9AlcBAsj7GLhz9NAJZG3Ey76BXS', '2021-04-11 16:34:37', 1, 'Zach', 'Dilliha'),
(28, 'employee', '$2y$10$iuY91TIh2aKnyrtuFKvtJOvS52ullNjOpgeTE1GIeu1OuLFEPiJ6K', '2021-04-16 20:29:14', 0, 'EmployeeTest', 'EmployeeTest');

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
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`empID`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `empID` (`empID`),
  ADD KEY `shiftSwapID` (`shiftSwapID`),
  ADD KEY `timeOffID` (`timeOffID`);

--
-- Indexes for table `shiftswaprequests`
--
ALTER TABLE `shiftswaprequests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empID1` (`empID1`),
  ADD KEY `empID2` (`empID2`);

--
-- Indexes for table `timeoffrequests`
--
ALTER TABLE `timeoffrequests`
  ADD PRIMARY KEY (`timeOffID`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `empID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `shiftswaprequests`
--
ALTER TABLE `shiftswaprequests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `timeoffrequests`
--
ALTER TABLE `timeoffrequests`
  MODIFY `timeOffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`empID`) REFERENCES `employee` (`empID`),
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`shiftSwapID`) REFERENCES `shiftswaprequests` (`id`),
  ADD CONSTRAINT `request_ibfk_3` FOREIGN KEY (`timeOffID`) REFERENCES `timeoffrequests` (`timeOffID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
