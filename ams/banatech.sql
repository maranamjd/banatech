-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2020 at 06:31 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(92, 'CB232', '17:42:20', '2020-03-25', '17:42:53', '2020-03-25', '17:42:30', '00:00:33', 5),
(93, 'CB123', '17:42:47', '2020-03-25', '17:43:27', '2020-03-25', '17:42:57', '00:00:40', 4),
(94, 'CB12323', '17:43:15', '2020-03-25', '17:58:16', '2020-03-25', '17:43:25', '00:15:01', 7),
(95, 'CB12323', '13:19:26', '2020-03-26', '13:20:31', '2020-03-26', '13:19:36', '00:01:05', 7),
(96, 'CB123', '13:19:36', '2020-03-26', '13:20:22', '2020-03-26', '13:19:46', '00:00:46', 4),
(97, 'CB232', '13:19:46', '2020-03-26', '13:20:39', '2020-03-26', '13:19:56', '00:00:53', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(50) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `mname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `img` longblob NOT NULL,
  `email` varchar(30) NOT NULL,
  `role` varchar(30) NOT NULL,
  `stat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`id`, `emp_id`, `fname`, `mname`, `lname`, `img`, `email`, `role`, `stat`) VALUES
(1, 'admin', 'YWRtaW4=', '', '', '', 'nice@gmail.com', 'Admin', ''),
(4, 'CB123', 'Mike', 'qwe', 'Mretert', '', '', 'Employee', 'Active'),
(7, 'CB12323', 'qwe', 'erer', 'asdasd', '', '', 'Employee', 'Active'),
(5, 'CB232', 'John', 'adfa', 'wew', '', '', 'Employee', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `date_in_tbl`
--
ALTER TABLE `date_in_tbl`
  ADD PRIMARY KEY (`time_id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `date_in_tbl`
--
ALTER TABLE `date_in_tbl`
  MODIFY `time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
