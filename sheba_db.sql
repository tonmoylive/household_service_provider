-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql206.infinityfree.com
-- Generation Time: May 03, 2025 at 12:46 PM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sheba_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin_tb`
--

CREATE TABLE `adminlogin_tb` (
  `a_login_id` int(11) NOT NULL,
  `a_name` varchar(60) NOT NULL,
  `a_email` varchar(60) NOT NULL,
  `a_password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Dumping data for table `adminlogin_tb`
--

INSERT INTO `adminlogin_tb` (`a_login_id`, `a_name`, `a_email`, `a_password`) VALUES
(1, 'Admin', 'admin@gmail.com', 'anik');

-- --------------------------------------------------------

--
-- Table structure for table `assignwork_tb`
--

CREATE TABLE `assignwork_tb` (
  `rno` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `request_info` text NOT NULL,
  `request_desc` text NOT NULL,
  `requester_name` varchar(60) NOT NULL,
  `requester_add1` text NOT NULL,
  `requester_add2` text NOT NULL,
  `requester_city` varchar(60) NOT NULL,
  `requester_state` varchar(60) NOT NULL,
  `requester_zip` int(11) NOT NULL,
  `requester_email` varchar(60) NOT NULL,
  `requester_mobile` varchar(11) NOT NULL,
  `assign_tech` varchar(60) NOT NULL,
  `assign_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Dumping data for table `assignwork_tb`
--

INSERT INTO `assignwork_tb` (`rno`, `request_id`, `request_info`, `request_desc`, `requester_name`, `requester_add1`, `requester_add2`, `requester_city`, `requester_state`, `requester_zip`, `requester_email`, `requester_mobile`, `assign_tech`, `assign_date`) VALUES
(15, 5, 'Cable/DTH Services', 'Cable Connection', 'Mahfuz', 'House no 110', 'Aam Chottor', 'Shah Mokhdum', 'Rajshahi', 6200, 'mahfuz@gmail.com', '01637888411', 'Jahid', '2025-04-08 03:30 PM'),
(18, 6, 'Painter', 'Wall Paint', 'Abdullah', 'House no 36', 'Nowdapara', 'Shah Mokhdum', 'Rajshahi', 6212, 'abdullah@gmail.com', '01432628043', 'Roton', '2025-04-21 11:30 AM'),
(19, 7, 'Water Tank Cleaning', 'Water tank clean', 'Rimi', 'House no 36', 'Shal Bagan', 'Shah Mokhdum', 'Rajshahi', 6201, 'rimi283@gmail.com', '01773932773', 'Sobuj', '2025-04-20 11:00 AM'),
(20, 8, 'Electrician', 'To fix my bed room switch board', 'Tusar', 'House no 387', 'Nowhata', 'Paba', 'Rajshahi', 6213, 'tusar@gmail.com', '01723432849', 'Robi', '2025-04-20 10:30 AM'),
(21, 9, 'Home Cleaning Services', 'Home cleaning services', 'Nusrat husnin athoy', '405', 'Nowhata', 'paba', 'rajshahi', 6213, 'nusrathusnin@gmail.com', '01747235453', 'Mabiya', '2025-04-22 10:30 AM'),
(22, 22, 'Carpenter', 'Fix my bed room door', 'Alif', 'House no 12', 'Vugroil', 'Biman Bondor', 'Rajshahi', 6237, 'demo@gmail.com', '01634836498', 'Sajjad', '2025-04-22 03:30 PM'),
(23, 23, 'Water Tank Cleaning', 'water tank cleaning', 'Nusrat husnin athoy', '405', 'Nowhata', 'paba', 'rajshahi', 6213, 'nusrathusnin@gmail.com', '01747235453', 'Sobuj', '2025-04-23 09:00 AM'),
(24, 25, 'Electrician', 'à¦¨à¦¤à§à¦¨ à¦¸à§à¦‡à¦š à¦¬à§‹à¦°à§à¦¡ à¦²à¦¾à¦—à¦¾à¦¤à§‡ à¦¹à¦¬à§‡ ', 'à¦†à§Ÿà¦°à¦¿à¦¨', 'à¦¬à¦¾à¦¸à¦¾ à¦¨à¦‚ à§ªà§©à§¦', 'à¦¨à¦“à¦¹à¦¾à¦Ÿà¦¾', 'à¦ªà¦¬à¦¾', 'à¦°à¦¾à¦œà¦¶à¦¾à¦¹à§€', 6213, 'demo@gmail.com', '01683268963', 'Munna', '2025-04-26 11:30 AM'),
(25, 26, 'AC/Appliance Technician', 'compresser clean', 'Shopno', 'House no 12', 'Rajshahi Airport Colony', 'Paba', 'Rajshahi', 6210, 'shopno047@gmail.com', '01723128880', 'Shimul', '2025-04-29 11:00 AM');

-- --------------------------------------------------------

--
-- Table structure for table `requesterlogin_tb`
--

CREATE TABLE `requesterlogin_tb` (
  `r_login_id` int(11) NOT NULL,
  `r_name` varchar(60) NOT NULL,
  `r_email` varchar(60) NOT NULL,
  `r_password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Dumping data for table `requesterlogin_tb`
--

INSERT INTO `requesterlogin_tb` (`r_login_id`, `r_name`, `r_email`, `r_password`) VALUES
(12, 'Demo', 'demo@gmail.com', '123456'),
(13, 'Jamal', 'jamal@gmail.com', 'jamal@1'),
(14, 'Robin', 'robin@gmail.com', 'robin'),
(15, 'Tusar', 'tusar@gmail.com', 'tusar'),
(16, '  Nusrat husnin athoy', 'nusrathusnin@gmail.com', 'nusrathusnin12345'),
(17, 'Rafi', 'rafi125@gmail.com', 'Rafi@1'),
(19, 'Shopno', 'shopno047@gmail.com', 'password1');

-- --------------------------------------------------------

--
-- Table structure for table `submitrequest_tb`
--

CREATE TABLE `submitrequest_tb` (
  `request_id` int(11) NOT NULL,
  `request_info` text NOT NULL,
  `request_desc` text NOT NULL,
  `requester_name` varchar(60) NOT NULL,
  `requester_add1` text NOT NULL,
  `requester_add2` text NOT NULL,
  `requester_city` varchar(60) NOT NULL,
  `requester_state` varchar(60) NOT NULL,
  `requester_zip` int(11) NOT NULL,
  `requester_email` varchar(60) NOT NULL,
  `requester_mobile` varchar(11) NOT NULL,
  `request_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Dumping data for table `submitrequest_tb`
--

INSERT INTO `submitrequest_tb` (`request_id`, `request_info`, `request_desc`, `requester_name`, `requester_add1`, `requester_add2`, `requester_city`, `requester_state`, `requester_zip`, `requester_email`, `requester_mobile`, `request_date`) VALUES
(23, 'Water Tank Cleaning', 'water tank cleaning', 'Nusrat husnin athoy', '405', 'Nowhata', 'paba', 'rajshahi', 6213, 'nusrathusnin@gmail.com', '01747235453', '2025-04-23'),
(24, 'Electrician', 'Setup a combine board for fridge ', 'Rafi', 'House no 4', 'Mastar Para', 'Shah Mokhdum', 'Rajshahi', 6168, 'rafi125@gmail.com', '01394649648', '2025-04-23');

-- --------------------------------------------------------

--
-- Table structure for table `technician_tb`
--

CREATE TABLE `technician_tb` (
  `empid` int(11) NOT NULL,
  `empName` varchar(60) NOT NULL,
  `empCity` varchar(60) NOT NULL,
  `empMobile` varchar(11) NOT NULL,
  `empEmail` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Dumping data for table `technician_tb`
--

INSERT INTO `technician_tb` (`empid`, `empName`, `empCity`, `empMobile`, `empEmail`) VALUES
(16, 'Jahid', 'Rajshahi', '01752384199', 'Cable/DTH Services'),
(17, 'Rocky', 'Baya, Rajshahi', '01945463211', 'CCTV Installation and Maintenance'),
(18, 'Munna', 'Baya', '01382391622', 'Electrician'),
(19, 'Rana', 'Nowhata', '01740379382', 'Plumber'),
(20, 'Robi', 'Nowhata', '01429344199', 'Electrician'),
(21, 'Roton', 'Aam Cottor', '01716805720', 'Painter'),
(22, 'Sobuj', 'Biman Chottor', '01629739232', 'Water Tank Cleaning'),
(23, 'Shimul', 'Nowdapara', '01397558423', 'AC/Appliance Technician'),
(24, 'Mannan', 'Aam Chotor', '01434683463', 'Waste Collection & Disposal'),
(25, 'Mabiya', 'Nowhata', '01645463184', 'Home Cleaning Services'),
(26, 'Sajjad', 'Baya', '01783828362', 'Carpenter');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin_tb`
--
ALTER TABLE `adminlogin_tb`
  ADD PRIMARY KEY (`a_login_id`);

--
-- Indexes for table `assignwork_tb`
--
ALTER TABLE `assignwork_tb`
  ADD PRIMARY KEY (`rno`);

--
-- Indexes for table `requesterlogin_tb`
--
ALTER TABLE `requesterlogin_tb`
  ADD PRIMARY KEY (`r_login_id`);

--
-- Indexes for table `submitrequest_tb`
--
ALTER TABLE `submitrequest_tb`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `technician_tb`
--
ALTER TABLE `technician_tb`
  ADD PRIMARY KEY (`empid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin_tb`
--
ALTER TABLE `adminlogin_tb`
  MODIFY `a_login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assignwork_tb`
--
ALTER TABLE `assignwork_tb`
  MODIFY `rno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `requesterlogin_tb`
--
ALTER TABLE `requesterlogin_tb`
  MODIFY `r_login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `submitrequest_tb`
--
ALTER TABLE `submitrequest_tb`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `technician_tb`
--
ALTER TABLE `technician_tb`
  MODIFY `empid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
