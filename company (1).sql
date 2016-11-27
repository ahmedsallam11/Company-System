-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 27, 2016 at 02:47 PM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `company`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `departmentID` int(11) NOT NULL,
  `departmentName` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`departmentID`, `departmentName`) VALUES
(14, 'HR'),
(15, 'CS'),
(16, 'Accounting');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employeeID` int(10) NOT NULL,
  `fName` varchar(50) COLLATE utf8_bin NOT NULL,
  `lName` varchar(50) COLLATE utf8_bin NOT NULL,
  `salary` int(10) NOT NULL,
  `departmentID` int(50) NOT NULL,
  `titleID` int(50) DEFAULT NULL,
  `supervisorID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employeeID`, `fName`, `lName`, `salary`, `departmentID`, `titleID`, `supervisorID`) VALUES
(1, 'Salwa', 'Saed', 6300, 5, 1, 0),
(3, 'mohamed', 'ibrahim', 1940, 8, 2, 19),
(19, 'Salam', 'Mohamed', 4500, 5, 1, 0),
(31, 'Mohamed', 'Ahmed', 2300, 14, 2, 34),
(32, 'Abdullah', 'Ahmed', 1300, 15, 2, 34),
(34, 'Mustafa', 'Saed', 6200, 15, 1, 0),
(35, 'Yousef', 'Hassan', 5400, 16, 1, 0),
(36, 'Ahmed', 'Mustafa', 1400, 14, 2, 37),
(37, 'Saly', 'Ibrahim', 7000, 14, 1, 0),
(38, 'Zeinab ', 'Ali', 3200, 14, 2, 37),
(39, 'Lelly', 'Adel', 3200, 16, 2, 35);

-- --------------------------------------------------------

--
-- Table structure for table `titles`
--

CREATE TABLE `titles` (
  `titleID` int(20) NOT NULL,
  `titleName` varchar(50) NOT NULL DEFAULT 'Ordinary'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `titles`
--

INSERT INTO `titles` (`titleID`, `titleName`) VALUES
(0, 'None'),
(1, 'Supervisor'),
(2, 'Ordinary');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`departmentID`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employeeID`);

--
-- Indexes for table `titles`
--
ALTER TABLE `titles`
  ADD PRIMARY KEY (`titleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `departmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employeeID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
