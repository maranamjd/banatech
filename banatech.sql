-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2020 at 04:21 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banatech`
--

-- --------------------------------------------------------

--
-- Table structure for table `additionals`
--

CREATE TABLE `additionals` (
  `id` int(1) NOT NULL,
  `EmployeeId` varchar(11) NOT NULL,
  `DeMinimis` decimal(15,2) NOT NULL,
  `FoodTravelAllowance` decimal(15,2) NOT NULL,
  `Incentives` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `additionals`
--

INSERT INTO `additionals` (`id`, `EmployeeId`, `DeMinimis`, `FoodTravelAllowance`, `Incentives`) VALUES
(1, 'A758423', '100.00', '150.00', '100.00'),
(2, 'A438235', '0.00', '100.00', '100.00'),
(20, 'B324332', '0.00', '100.00', '100.00');

-- --------------------------------------------------------

--
-- Table structure for table `contributions`
--

CREATE TABLE `contributions` (
  `iContributionId` int(1) UNSIGNED NOT NULL,
  `EmployeeId` varchar(45) DEFAULT NULL,
  `SSS` decimal(15,2) DEFAULT NULL,
  `Philhealth` decimal(15,2) DEFAULT NULL,
  `HDMF` decimal(15,2) DEFAULT 100.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contributions`
--

INSERT INTO `contributions` (`iContributionId`, `EmployeeId`, `SSS`, `Philhealth`, `HDMF`) VALUES
(1, 'A758423', '290.65', '275.00', '100.00'),
(2, 'A438235', '290.65', '137.50', '100.00'),
(20, 'B324332', '290.65', '137.50', '100.00');

-- --------------------------------------------------------

--
-- Table structure for table `date_in_tbl`
--

CREATE TABLE `date_in_tbl` (
  `time_id` int(11) NOT NULL,
  `emp_id` varchar(50) NOT NULL,
  `time_in` time NOT NULL,
  `date_in` date NOT NULL,
  `time_out` time NOT NULL,
  `date_out` date NOT NULL,
  `ranger` time NOT NULL,
  `tot` time NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `date_in_tbl`
--

INSERT INTO `date_in_tbl` (`time_id`, `emp_id`, `time_in`, `date_in`, `time_out`, `date_out`, `ranger`, `tot`, `id`) VALUES
(104, 'A758423', '07:55:42', '2020-05-01', '17:00:09', '2020-05-01', '07:55:52', '09:04:27', 1),
(105, 'A438235', '07:55:50', '2020-05-01', '17:00:18', '2020-05-01', '07:56:00', '09:04:28', 2),
(106, 'B324332', '07:55:58', '2020-05-01', '17:00:24', '2020-05-01', '07:56:08', '09:04:26', 20),
(113, 'B324332', '08:00:54', '2020-05-04', '17:00:24', '2020-05-04', '08:01:04', '08:59:30', 20),
(114, 'A438235', '08:01:01', '2020-05-04', '17:00:18', '2020-05-04', '08:01:11', '08:59:17', 2),
(115, 'A758423', '08:01:06', '2020-05-04', '17:00:12', '2020-05-04', '08:01:16', '08:59:06', 1),
(116, 'B324332', '08:00:30', '2020-05-05', '17:00:58', '2020-05-05', '08:00:40', '09:00:28', 20),
(117, 'A438235', '08:00:35', '2020-05-05', '17:00:52', '2020-05-05', '08:00:45', '09:00:17', 2),
(118, 'A758423', '08:00:41', '2020-05-05', '17:00:47', '2020-05-05', '08:00:51', '09:00:06', 1),
(119, 'B324332', '08:00:05', '2020-05-06', '17:00:31', '2020-05-06', '08:00:15', '09:00:26', 20),
(120, 'A438235', '08:00:10', '2020-05-06', '17:00:26', '2020-05-06', '08:00:20', '09:00:16', 2),
(121, 'A758423', '08:00:16', '2020-05-06', '17:00:20', '2020-05-06', '08:00:26', '09:00:04', 1),
(122, 'B324332', '08:00:36', '2020-05-07', '17:01:11', '2020-05-07', '08:00:46', '09:00:35', 20),
(123, 'A438235', '08:00:44', '2020-05-07', '17:01:04', '2020-05-07', '08:00:54', '09:00:20', 2),
(124, 'A758423', '08:00:49', '2020-05-07', '17:00:55', '2020-05-07', '08:00:59', '09:00:06', 1),
(125, 'B324332', '08:00:16', '2020-05-08', '17:00:44', '2020-05-08', '08:00:26', '09:00:28', 20),
(126, 'A438235', '08:00:22', '2020-05-08', '17:00:38', '2020-05-08', '08:00:32', '09:00:16', 2),
(127, 'A758423', '08:00:27', '2020-05-08', '17:00:32', '2020-05-08', '08:00:37', '09:00:05', 1),
(134, 'B324332', '08:00:15', '2020-05-11', '17:00:45', '2020-05-11', '08:00:25', '09:00:30', 20),
(135, 'A438235', '08:00:21', '2020-05-11', '17:00:40', '2020-05-11', '08:00:31', '09:00:19', 2),
(136, 'A758423', '08:00:26', '2020-05-11', '17:00:34', '2020-05-11', '08:00:36', '09:00:08', 1),
(137, 'B324332', '08:00:53', '2020-05-12', '17:00:30', '2020-05-12', '08:01:03', '08:59:37', 20),
(138, 'A438235', '08:00:59', '2020-05-12', '17:00:16', '2020-05-12', '08:01:09', '08:59:17', 2),
(139, 'A758423', '08:01:04', '2020-05-12', '17:00:09', '2020-05-12', '08:01:14', '08:59:05', 1),
(140, 'B324332', '08:00:36', '2020-05-13', '17:01:25', '2020-05-13', '08:00:46', '09:00:49', 20),
(141, 'A438235', '08:00:43', '2020-05-13', '17:01:19', '2020-05-13', '08:00:53', '09:00:36', 2),
(142, 'A758423', '08:00:50', '2020-05-13', '17:00:55', '2020-05-13', '08:01:00', '09:00:05', 1),
(143, 'B324332', '08:00:30', '2020-05-14', '17:01:03', '2020-05-14', '08:00:40', '09:00:33', 20),
(144, 'A438235', '08:00:36', '2020-05-14', '17:00:52', '2020-05-14', '08:00:46', '09:00:16', 2),
(145, 'A758423', '08:00:41', '2020-05-14', '17:00:45', '2020-05-14', '08:00:51', '09:00:04', 1),
(146, 'B324332', '08:00:09', '2020-05-15', '17:00:39', '2020-05-15', '08:00:19', '09:00:30', 20),
(147, 'A438235', '08:00:15', '2020-05-15', '17:00:33', '2020-05-15', '08:00:25', '09:00:18', 2),
(148, 'A758423', '08:00:21', '2020-05-15', '17:00:25', '2020-05-15', '08:00:31', '09:00:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `image` varchar(150) DEFAULT NULL,
  `id` int(1) UNSIGNED NOT NULL,
  `EmployeeId` varchar(45) NOT NULL,
  `FirstName` varchar(45) NOT NULL,
  `MiddleName` varchar(45) NOT NULL,
  `LastName` varchar(45) DEFAULT NULL,
  `Email` varchar(32) NOT NULL,
  `Position` varchar(45) DEFAULT NULL,
  `TimeIn` time NOT NULL,
  `TimeOut` time NOT NULL,
  `BasicPay` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`image`, `id`, `EmployeeId`, `FirstName`, `MiddleName`, `LastName`, `Email`, `Position`, `TimeIn`, `TimeOut`, `BasicPay`) VALUES
('1879182837.jpg', 1, 'A758423', 'Michael Joshua', 'Duran', 'Marana', 'marana.michaelj@gmail.com', 'Full Stack Developer', '08:00:00', '17:00:00', '45000.00'),
('3566.jpg', 2, 'A438235', 'Mark Joseph', 'Reyes', 'Colibao', 'colibaomarkjoseph@gmail.com', 'Accountant', '08:00:00', '17:00:00', '20000.00'),
('unknown.jpg', 84, 'B324332', 'Ava', 'Marie', 'Antaran', 'lego@gmail.com', 'accountant', '08:00:00', '17:00:00', '20000.00');

-- --------------------------------------------------------

--
-- Table structure for table `grosspay`
--

CREATE TABLE `grosspay` (
  `GrossPayId` int(11) NOT NULL,
  `EmployeeId` varchar(45) DEFAULT NULL,
  `Month` int(11) NOT NULL,
  `Year` int(11) NOT NULL,
  `Batch` int(11) NOT NULL,
  `BasicPay` decimal(15,2) DEFAULT NULL,
  `Absences` int(11) DEFAULT NULL,
  `Tardiness` int(11) DEFAULT NULL,
  `UnderTime` int(11) DEFAULT NULL,
  `RegOT` int(11) DEFAULT NULL,
  `RestOT` int(11) DEFAULT NULL,
  `NightDifferentials` int(11) NOT NULL,
  `RegHoliday` int(11) NOT NULL,
  `SpecialHoliday` int(11) NOT NULL,
  `SalaryAdjustments` decimal(15,2) NOT NULL,
  `GrossPay` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(1) UNSIGNED NOT NULL,
  `EmployeeId` varchar(45) DEFAULT NULL,
  `Month` int(11) NOT NULL,
  `Year` int(11) NOT NULL,
  `Batch` int(1) NOT NULL,
  `HDMF` decimal(15,2) DEFAULT NULL,
  `SSS` decimal(15,2) DEFAULT NULL,
  `OtherDeduction` decimal(15,2) DEFAULT NULL,
  `TotalLoan` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(1) NOT NULL,
  `EmployeeId` varchar(256) NOT NULL,
  `Type` int(1) NOT NULL,
  `NotifTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payrolls`
--

CREATE TABLE `payrolls` (
  `id` int(1) NOT NULL,
  `Month` int(11) NOT NULL,
  `Year` int(11) NOT NULL,
  `Batch` int(11) NOT NULL,
  `isApproved` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserId` int(1) UNSIGNED NOT NULL,
  `EmployeeId` varchar(255) DEFAULT NULL,
  `Password` varchar(512) DEFAULT NULL,
  `UserType` int(11) DEFAULT NULL,
  `hash` varchar(255) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 0,
  `hasDTR` int(11) NOT NULL DEFAULT 0,
  `hasLoans` int(11) NOT NULL DEFAULT 0,
  `hasPayslip` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `EmployeeId`, `Password`, `UserType`, `hash`, `isActive`, `hasDTR`, `hasLoans`, `hasPayslip`) VALUES
(1, 'A758423', 'ZEV0bzhaemF2L1ZTWnVOTVVzY210QT09Ojq6FBQ9YfV3ej0DxE9KZaYj', 0, '12472230e1bceac5476721717d8abe9b', 1, 0, 0, 0),
(2, 'A438235', 'ZEV0bzhaemF2L1ZTWnVOTVVzY210QT09Ojq6FBQ9YfV3ej0DxE9KZaYj', 1, 'c3992e9a68c5ae12bd18488bc579b30d', 1, 0, 0, 0),
(20, 'B324332', 'czAzNUVyUm16RFhNQ0RUWHNlVS9qQT09Ojpc1V2rkB8wbFElW1MNSzIF', 2, '258be18e31c8188555c2ff05b4d542c3', 1, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additionals`
--
ALTER TABLE `additionals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `EmployeeId` (`EmployeeId`);

--
-- Indexes for table `contributions`
--
ALTER TABLE `contributions`
  ADD PRIMARY KEY (`iContributionId`),
  ADD UNIQUE KEY `EmployeeId` (`EmployeeId`);

--
-- Indexes for table `date_in_tbl`
--
ALTER TABLE `date_in_tbl`
  ADD PRIMARY KEY (`time_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `EmployeeId_UNIQUE` (`EmployeeId`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `grosspay`
--
ALTER TABLE `grosspay`
  ADD PRIMARY KEY (`GrossPayId`),
  ADD UNIQUE KEY `EmployeeId` (`EmployeeId`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `EmployeeId` (`EmployeeId`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserId`),
  ADD UNIQUE KEY `EmployeeId` (`EmployeeId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additionals`
--
ALTER TABLE `additionals`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `contributions`
--
ALTER TABLE `contributions`
  MODIFY `iContributionId` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `date_in_tbl`
--
ALTER TABLE `date_in_tbl`
  MODIFY `time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `grosspay`
--
ALTER TABLE `grosspay`
  MODIFY `GrossPayId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `payrolls`
--
ALTER TABLE `payrolls`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
