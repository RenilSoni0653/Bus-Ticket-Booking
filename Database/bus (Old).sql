-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 19, 2020 at 01:36 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updation_date` varchar(40) DEFAULT NULL,
  `passUdateDate` varchar(50) DEFAULT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fname`, `mname`, `lname`, `username`, `gender`, `phone`, `email`, `password`, `reg_date`, `updation_date`, `passUdateDate`, `status`) VALUES
(1, 'Renil', 'Paragbhai', 'Soni', 'admin', 'Male', '7405608447', 'renilsoni0653@gmail.com', 'renilsoni', '2020-03-04 18:30:00', '2020-03-06', NULL, 1),
(3, 'Raj', 'Paragbhai', 'Soni', 'Raj_Soni', 'male', '7802802980', 'sonalsoni497@gmail.com', 'rajsoni', '2020-03-23 12:18:44', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `rid` varchar(10) NOT NULL,
  `bno` varchar(30) NOT NULL,
  `bname` varchar(30) NOT NULL,
  `source` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `arrival` varchar(10) NOT NULL,
  `departure` varchar(10) NOT NULL,
  `PNR` varchar(13) NOT NULL,
  `username` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `age` int(10) NOT NULL,
  `phone` bigint(30) NOT NULL,
  `seat_no` int(2) NOT NULL,
  `book_date` date NOT NULL,
  `price` int(30) NOT NULL,
  `message` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `posting_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`bid`)
) ENGINE=MyISAM AUTO_INCREMENT=167 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`bid`, `id`, `rid`, `bno`, `bname`, `source`, `destination`, `arrival`, `departure`, `PNR`, `username`, `gender`, `age`, `phone`, `seat_no`, `book_date`, `price`, `message`, `email`, `status`, `posting_date`) VALUES
(126, 6, 'R002', 'GJ-13-P-9898', 'Volvo-xc', 'Surat', 'Vadodra', '14:50', '17:0', '2020-03-28-16', 'abc', 'Male', 23, 7405608447, 16, '2020-03-28', 250, 'Nice', 'jinal@baxi.co.in', 1, '2020-03-27 08:43:58'),
(127, 6, 'R002', 'GJ-13-P-9898', 'Volvo-xc', 'Surat', 'Vadodra', '14:50', '17:0', '2020-03-28-17', 'Shreya', 'Female', 29, 7405608447, 17, '2020-03-28', 250, 'Nice', 'jinal@baxi.co.in', 0, '2020-03-27 08:43:58'),
(107, 1, 'R001', 'GJ-01-MV-8558', 'Volvo', 'Ahmedabad', 'Kadi', '20:50', '11:25', '2020-03-27-28', 'Renil', 'Male', 23, 7405608447, 28, '2020-03-27', 90, 'nice', 'renilsoni0653@gmail.com', 1, '2020-03-26 05:38:04'),
(106, 1, 'R001', 'GJ-01-MV-8558', 'Volvo', 'Ahmedabad', 'Surendranagar', '20:50', '13:30', '2020-03-26-28', 'Renil', 'Male', 23, 7405608447, 28, '2020-03-26', 150, 'nice', 'srenil0653@gmail.com', 0, '2020-03-25 14:47:20'),
(108, 1, 'R001', 'GJ-01-MV-8558', 'Volvo', 'Ahmedabad', 'Surendranagar', '20:50', '13:30', '2020-03-27-27', 'Shreya', 'Female', 23, 7405608447, 27, '2020-03-27', 150, 'n', 'renilsoni0653@gmail.com', 0, '2020-03-26 05:43:53'),
(105, 1, 'R001', 'GJ-01-MV-8558', 'Volvo', 'Ahmedabad', 'Surendranagar', '20:50', '13:30', '2020-03-26-27', 'Shreya', 'Female', 19, 7405608447, 27, '2020-03-26', 150, 'nice', 'srenil0653@gmail.com', 0, '2020-03-25 14:47:20'),
(154, 13, 'R001', 'GJ-01-MV-8558', 'Volvo', 'Ahmedabad', 'Surendranagar', '19:30', '23:00', '2020-06-16-28', 'Manav Ranpura', 'Male', 22, 7802802980, 28, '2020-06-16', 150, 'Nice System..', 'sonalsoni497@gmail.com', 1, '2020-06-15 14:12:16'),
(162, 23, 'R001', 'GJ-01-MV-8558', 'Volvo', 'Ahmedabad', 'Surendranagar', '19:30', '23:00', '2020-06-19-15', 'Renil', 'Male', 1, 7405608447, 15, '2020-06-19', 150, 'hi', 'renil@gmail.com', 1, '2020-06-19 03:54:15'),
(164, 23, 'R0912', 'GJ-01-AB-0010', 'Patel-01', 'Vadodra', 'surat', '10:30', '17:00', '2020-06-19-25', 'Nikhil Pravinbhai patadia', 'Male', 40, 7802802980, 25, '2020-06-19', 400, 'nice', 'rajsoni@gmail.com', 0, '2020-06-19 04:39:38'),
(165, 23, 'R001', 'GJ-01-MV-8558', 'Volvo', 'Ahmedabad', 'Kadi', '19:30', '11:25', '2020-06-19-17', 'Sonal', 'Female', 45, 7874321041, 17, '2020-06-19', 90, 'NIce', 'srenil0653@gmail.com', 0, '2020-06-19 13:18:43'),
(166, 23, 'R001', 'GJ-01-MV-8558', 'Volvo', 'Ahmedabad', 'Surendranagar', '19:30', '23:00', '2020-06-20-17', 'abcd', 'Male', 34, 4512698023, 17, '2020-06-20', 150, 'n', 'sonalsoni497@gmail.com', 0, '2020-06-19 13:22:07');

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

DROP TABLE IF EXISTS `buses`;
CREATE TABLE IF NOT EXISTS `buses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` varchar(11) NOT NULL,
  `bname` varchar(30) NOT NULL,
  `bno` varchar(30) NOT NULL,
  `total_seat` int(30) NOT NULL,
  `source` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `arrival` varchar(10) NOT NULL,
  `departure` varchar(10) NOT NULL,
  `price` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rid` (`rid`),
  UNIQUE KEY `bno` (`bno`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`id`, `rid`, `bname`, `bno`, `total_seat`, `source`, `destination`, `arrival`, `departure`, `price`, `status`, `created_at`, `updated_at`) VALUES
(9, 'R001', 'Volvo', 'GJ-01-MV-8558', 30, 'Ahmedabad', 'Surendranagar', '19:30', '23:00', 150, 1, '2020-03-22 13:00:15', '2020-03-22 13:00:15'),
(10, 'R002', 'Volvo-xc', 'GJ-13-P-9898', 30, 'Surat', 'Ahmedabad', '14:50', '20:20', 300, 1, '2020-03-22 13:01:15', '2020-03-22 13:01:15'),
(11, 'R003', 'Patel', 'GJ-01-KP-3425', 20, 'Ahmedabad', 'Surendranagar', '07:30', '11:00', 100, 1, '2020-03-24 03:25:54', '2020-03-24 03:25:54'),
(13, 'R004', 'GSRTC', 'GJ-12-AB-1234', 30, 'Surat', 'Ahmedabad', '09:55', '13:00', 340, 1, '2020-03-24 04:19:31', '2020-03-24 04:19:31'),
(14, 'R090', 'Red-GSRTC', 'GJ-10-CV-0987', 30, 'Ahmedabad', 'Jamnagar', '12:30', '17:00', 500, 1, '2020-04-16 05:28:45', '2020-04-16 05:28:45'),
(18, 'R0912', 'Patel-01', 'GJ-01-AB-0010', 25, 'Vadodra', 'surat', '10:30', '17:00', 400, 1, '2020-06-19 04:36:57', '2020-06-19 04:36:57');

-- --------------------------------------------------------

--
-- Table structure for table `compare`
--

DROP TABLE IF EXISTS `compare`;
CREATE TABLE IF NOT EXISTS `compare` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` varchar(10) NOT NULL,
  `bname` varchar(30) NOT NULL,
  `bno` varchar(30) NOT NULL,
  `total_seat` int(30) NOT NULL,
  `source` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `arrival` varchar(10) NOT NULL,
  `departure` varchar(10) NOT NULL,
  `price` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bno` (`bno`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `compare`
--

INSERT INTO `compare` (`id`, `rid`, `bname`, `bno`, `total_seat`, `source`, `destination`, `arrival`, `departure`, `price`, `status`, `created_at`, `update_at`) VALUES
(7, 'CR002', 'Ab-travels', 'GJ-02-AB-0987', 30, 'Surat', 'Ahmedabad', '09:30', '14:50', 200, 1, '2020-04-13 06:33:52', '2020-04-13 06:33:52'),
(5, 'CR0045', 'Eagle_Bus', 'GJ-09-AB-8657', 30, 'Surat', 'Ahmedabad', '20:00', '23:30', 100, 1, '2020-03-24 14:08:43', '2020-03-24 14:08:43');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

DROP TABLE IF EXISTS `complaint`;
CREATE TABLE IF NOT EXISTS `complaint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(20) NOT NULL,
  `rid` varchar(10) NOT NULL,
  `value` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  `posting_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`id`, `pid`, `rid`, `value`, `status`, `posting_date`) VALUES
(1, 1, 'R001', 'Bus is not clean Not good', 1, '2020-03-23 07:23:54'),
(3, 1, 'R001', 'Seat quality is not good - ', 1, '2020-03-27 04:30:27'),
(4, 1, 'R001', 'Seat quality is not good - ', 1, '2020-05-02 05:54:25'),
(5, 1, 'R001', 'Bus is not clean - ', 1, '2020-05-02 05:56:56'),
(6, 13, 'R001', 'Seat quality is not good - Nothing', 1, '2020-06-15 14:15:18');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(20) NOT NULL,
  `rid` varchar(10) NOT NULL,
  `value` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  `posting_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `pid`, `rid`, `value`, `status`, `posting_date`) VALUES
(1, 1, 'R001', 'Good', 1, '2020-03-23 07:31:40'),
(2, 1, 'R001', 'Satisfying', 1, '2020-03-27 04:30:46');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

DROP TABLE IF EXISTS `routes`;
CREATE TABLE IF NOT EXISTS `routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` varchar(11) NOT NULL,
  `bno` varchar(30) NOT NULL,
  `bname` varchar(30) NOT NULL,
  `source` varchar(30) NOT NULL,
  `destination` varchar(30) NOT NULL,
  `price` int(11) NOT NULL,
  `d_arrival_time` varchar(30) NOT NULL,
  `status` int(1) NOT NULL,
  `posting_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rid` (`rid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `rid`, `bno`, `bname`, `source`, `destination`, `price`, `d_arrival_time`, `status`, `posting_date`) VALUES
(6, 'R001', 'GJ-01-MV-8558', 'Volvo', 'Ahmedabad', 'Kadi', 90, '11:25', 1, '2020-03-22 13:19:17'),
(8, 'R003', 'GJ-01-KP-3425', 'Patel', 'Ahmedabad', 'Kalol', 100, '01:00', 1, '2020-03-24 05:25:43'),
(9, 'R002', 'GJ-13-P-9898', 'Volvo-xc', 'Surat', 'Vadodra', 250, '17:00', 1, '2020-03-27 08:35:45');

-- --------------------------------------------------------

--
-- Table structure for table `user_reg`
--

DROP TABLE IF EXISTS `user_reg`;
CREATE TABLE IF NOT EXISTS `user_reg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(45) DEFAULT NULL,
  `passUdateDate` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_reg`
--

INSERT INTO `user_reg` (`id`, `fname`, `mname`, `lname`, `gender`, `phone`, `email`, `password`, `reg_date`, `updationDate`, `passUdateDate`) VALUES
(1, 'Renil', 'Paragbhai', 'Soni', 'male', 7405608447, 'srenil0653@gmail.com', 'renilsoni', '2020-03-07 10:54:47', '20-03-2020 07:26:01', '20-03-2020 07:25:36'),
(2, 'Raj', 'Paragbhai', 'Soni', 'male', 7802802980, 'rajsoni@gmail.com', 'raj', '2020-03-07 13:28:56', NULL, NULL),
(3, 'Viraj', 'gaurangbhai', 'Shah', 'male', 7405608447, 'viru@gmail.com', 'viraj', '2020-03-09 11:06:43', NULL, NULL),
(4, 'raju', 'pp', 'shah', 'male', 9426312321, 'renilsoni0653@gmail.com', 'renilsoni12', '2020-03-14 10:24:27', NULL, '15-04-2020 11:14:31'),
(5, 'Sonal', 'Pravinbhai', 'Soni', 'female', 7874321041, 'sonalsoni497@gmail.com', 'sonalsoni', '2020-03-27 04:27:59', '19-04-2020 11:59:49', '03-05-2020 05:51:36'),
(6, 'Jinal', 'abcd', 'Baxi', 'female', 1234567890, 'jinal@baxi.co.in', '1234', '2020-03-27 08:38:39', NULL, NULL),
(23, 'Nikhil', 'Pravinbhai', 'Patadia', 'male', 9824941141, 'nikhil12@gmail.com', 'bmlraGlsMTI=', '2020-06-18 09:59:52', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
