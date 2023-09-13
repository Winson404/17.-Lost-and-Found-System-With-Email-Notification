-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2022 at 05:11 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lost_and_found`
--

-- --------------------------------------------------------

--
-- Table structure for table `lost_found`
--

CREATE TABLE IF NOT EXISTS `lost_found` (
`Id` int(11) NOT NULL,
  `itemName` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `itemImage` varchar(255) NOT NULL,
  `itemOwner` varchar(255) NOT NULL,
  `ownerContact` varchar(255) NOT NULL,
  `dateLost` varchar(255) NOT NULL,
  `dateReported` varchar(50) NOT NULL,
  `itemStatus` varchar(50) NOT NULL DEFAULT '0' COMMENT '0=Lost, 1=Found, 2=Returned',
  `reporterId` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `lost_found`
--

INSERT INTO `lost_found` (`Id`, `itemName`, `description`, `itemImage`, `itemOwner`, `ownerContact`, `dateLost`, `dateReported`, `itemStatus`, `reporterId`) VALUES
(10, 'Ipad 2022', 'Ipad \r\nColor Silver', 'sample 2.jpg', 'Kobe Bean Bryant', '09451462382', '2022-12-15', 'December 09, 2022', '0', 62),
(11, 'Iphone ', 'Iphone Pro \r\nColor White\r\n', 'sample 3.jpg', 'Anne Krisna Suspene', '09451462302', '2022-12-20', 'December 09, 2022', '0', 62),
(12, 'Bose Speaker', 'Small Speaker\r\nColor Blue', 'sample 8.png', 'Lebron Raymone James', '09451462303', '2022-12-07', 'December 09, 2022', '0', 62),
(13, 'Airpods Pro', 'Ear Buds 2pcs and Case', 'sample 4.jpg', 'Bastian Luigi Frial', '09451462304', '2022-12-15', 'December 09, 2022', '0', 62),
(14, 'Wallet', 'Black wallet\r\nPersonal IDs', 'sample 13.jpg', 'Samuel Romeo', '09451462305', '2022-12-28', 'December 09, 2022', '0', 63),
(15, 'ID LACE', 'School ID LACE', 'sample 10.jpg', 'Luigi Martinez', '095485248', '2022-12-27', 'December 09, 2022', '0', 63),
(16, 'Watch', 'Gold Watch', 'sample 12.jpg', 'Michael', '4151216594', '2022-12-14', 'December 10, 2022', '1', 62),
(17, 'fds', 'fdsfs', 'minimalism-1644666519306-6515.jpg', 'fds', 'fds', '2022-12-07', 'December 13, 2022', '0', 62);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_Id` int(11) NOT NULL,
  `Id_Number` varchar(50) NOT NULL,
  `employeeNumber` varchar(255) NOT NULL,
  `course` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'User',
  `verification_code` varchar(255) NOT NULL,
  `date_registered` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_Id`, `Id_Number`, `employeeNumber`, `course`, `level`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `dob`, `age`, `address`, `email`, `contact`, `password`, `image`, `user_type`, `verification_code`, `date_registered`) VALUES
(40, '', '34', '', '', 'Bryan Miguel', 'Maddela', 'Frial', '', 'Male', '1999-11-01', 22, 'San Mateo Rizal', 'admin@gmail.com', '9276912442', '0192023a7bbd73250516f069df18b500', 'unnamed (7).jpg', 'Admin', '374025', '2022-09-10'),
(62, '201910148', '', 'BS ENGINEERING', 'BSIT', 'Kobe ', 'Bean', 'Bryant', '', 'Male', '2004-08-24', 18, 'Quezon City', 'frialbryan1@gmail.com', '9451462382', '0192023a7bbd73250516f069df18b500', 'sample pic1.jpg', 'User', '307256', '2022-12-09'),
(63, '', '10110199', '', '', 'Bon', 'Maddela', 'Frial', '', 'Male', '1996-10-24', 26, 'Manila City', 'bfrial@gmail.com', '9123456789', '0192023a7bbd73250516f069df18b500', 'sample 11.png', 'Employee', '', '2022-12-09'),
(64, '201910149', '', '4th', 'BSBA', 'Anne', 'Sioson', 'Suspene', '', 'Female', '2009-10-11', 13, 'Manila City', 'krisna.anne@gmail.com', '9451462302', 'dd7f84c0fe48965d37aadef3c815137c', 'sample 7.jpg', 'User', '', '2022-12-09'),
(65, '201910150', '', '2nd', 'BSIT', 'Miguel', 'Castro', 'Cruz', '', 'Male', '2006-06-15', 16, 'Malabon City', 'miguelcastro@gmail.com', '9451462381', '940bae10ca539c9d097187f5d5cc554f', 'sample 15.png', 'User', '', '2022-12-13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lost_found`
--
ALTER TABLE `lost_found`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lost_found`
--
ALTER TABLE `lost_found`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=66;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
