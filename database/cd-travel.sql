-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2016 at 03:18 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cd-travel`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `name`, `email`, `phone`) VALUES
(11, 'Péter', 'peter@gmail.com', '06309886543'),
(12, 'András', 'andras@gmail.com', '06304567123'),
(13, 'Dóra', 'dora@gmail.com', '06708912345'),
(14, 'Dániel', 'danial@gmail.com', '06204714284'),
(15, 'János', 'janos@gmail.com', '06707435412'),
(17, 'Ágnes', 'agnes@gmail.com', '06304569812'),
(18, 'Máté', 'mate@gmail.com', '06203459812');

-- --------------------------------------------------------

--
-- Table structure for table `holydays`
--

CREATE TABLE IF NOT EXISTS `holydays` (
  `holyday_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `vacation_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `holydays`
--

INSERT INTO `holydays` (`holyday_id`, `customer_id`, `vacation_id`) VALUES
(19, 13, 10),
(21, 13, 11),
(25, 11, 12),
(26, 12, 12),
(27, 17, 15),
(28, 18, 15);

-- --------------------------------------------------------

--
-- Table structure for table `vacations`
--

CREATE TABLE IF NOT EXISTS `vacations` (
  `vacation_id` int(11) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `seats` int(11) NOT NULL,
  `starting_date` varchar(100) NOT NULL,
  `end_date` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vacations`
--

INSERT INTO `vacations` (`vacation_id`, `destination`, `seats`, `starting_date`, `end_date`) VALUES
(10, 'Budapest', 50, '2016-02-28', '2016-03-03'),
(11, 'Jászfényszaru', 20, '2016-02-29', '2016-03-06'),
(12, 'Dubai', 350, '2016-03-05', '2016-03-17'),
(13, 'Párizs', 186, '2016-03-01', '2016-03-06'),
(14, 'New York', 256, '2016-03-04', '2016-03-10'),
(15, 'London', 234, '2016-03-05', '2016-03-31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `holydays`
--
ALTER TABLE `holydays`
  ADD PRIMARY KEY (`holyday_id`);

--
-- Indexes for table `vacations`
--
ALTER TABLE `vacations`
  ADD PRIMARY KEY (`vacation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `holydays`
--
ALTER TABLE `holydays`
  MODIFY `holyday_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `vacations`
--
ALTER TABLE `vacations`
  MODIFY `vacation_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
