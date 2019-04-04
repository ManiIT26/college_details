-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2019 at 03:40 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `college_attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `college_details`
--

CREATE TABLE `college_details` (
  `college_id` int(11) NOT NULL,
  `college_name` varchar(100) NOT NULL,
  `college_addr` text NOT NULL,
  `college_latitude` varchar(255) NOT NULL,
  `college_longitude` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `college_details`
--

INSERT INTO `college_details` (`college_id`, `college_name`, `college_addr`, `college_latitude`, `college_longitude`, `status`, `created_on`) VALUES
(1, 'MAHENDRA ENGINEERING COLLEGE', 'Mallasamudram A', '11.476461', '77.999423', 1, '2019-02-12 10:18:33'),
(2, 'MAHENDRA INSTITUTE OF ENGINEERING AND TECHNOLOGY', 'Mallasamudram', '11.477190', '78.003150', 1, '2019-02-12 10:25:55'),
(3, 'MAHENDRA INSTITUTE OF TECHNOLOGY', 'mallasamudram', '11.477759', '78.003741', 1, '2019-02-12 10:25:57'),
(4, 'SDD', 'dd', 'fddf', 'dfdf', 0, '2019-02-12 10:26:04');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `college_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `college_id`, `department_name`, `status`, `created_on`) VALUES
(3, 1, 'EEE', 1, '2019-02-12 11:33:20'),
(2, 1, 'ECE', 1, '2019-02-12 11:33:08'),
(4, 1, 'IT', 1, '2019-02-12 11:33:25'),
(5, 1, 'MECH', 1, '2019-02-12 11:33:30'),
(6, 1, 'CSE', 1, '2019-02-12 11:52:58'),
(7, 2, 'EEE', 1, '2019-02-12 11:53:00'),
(8, 2, 'IT', 1, '2019-02-12 11:33:42'),
(9, 2, 'PCE', 1, '2019-02-12 11:33:47'),
(10, 2, 'MECH', 1, '2019-02-12 11:33:57'),
(11, 3, 'IT', 1, '2019-02-12 11:34:01'),
(12, 3, 'CSE', 1, '2019-02-12 11:34:05'),
(13, 3, 'PCE', 0, '2019-02-12 12:13:30');

-- --------------------------------------------------------

--
-- Table structure for table `role_details`
--

CREATE TABLE `role_details` (
  `role_id` int(11) NOT NULL,
  `college_id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_details`
--

INSERT INTO `role_details` (`role_id`, `college_id`, `role`, `status`, `created_on`) VALUES
(1, 1, 'HOD', 1, '2019-02-12 12:01:01'),
(2, 1, 'Principal', 1, '2019-02-12 12:16:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(55) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_type`, `status`, `created_on`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'super_admin', 1, '2019-02-12 06:56:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `college_details`
--
ALTER TABLE `college_details`
  ADD PRIMARY KEY (`college_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `role_details`
--
ALTER TABLE `role_details`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `college_details`
--
ALTER TABLE `college_details`
  MODIFY `college_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `role_details`
--
ALTER TABLE `role_details`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
