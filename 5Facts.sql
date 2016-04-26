-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 26, 2016 at 02:41 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `5Facts`
--

-- --------------------------------------------------------

--
-- Table structure for table `Event`
--

CREATE TABLE `Event` (
  `name` varchar(500) NOT NULL,
  `factOne` text NOT NULL,
  `factTwo` text NOT NULL,
  `factThree` text NOT NULL,
  `factFour` text NOT NULL,
  `factFive` text NOT NULL,
  `voteOne` int(3) NOT NULL DEFAULT '0',
  `voteTwo` int(3) NOT NULL DEFAULT '0',
  `voteThree` int(3) NOT NULL DEFAULT '0',
  `voteFour` int(3) NOT NULL DEFAULT '0',
  `voteFive` int(3) NOT NULL DEFAULT '0',
  `linkOne` varchar(50) NOT NULL,
  `linkTwo` varchar(50) DEFAULT NULL,
  `linkThree` varchar(50) DEFAULT NULL,
  `picture` varchar(50) NOT NULL,
  `userCreated` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Event`
--

INSERT INTO `Event` (`name`, `factOne`, `factTwo`, `factThree`, `factFour`, `factFive`, `voteOne`, `voteTwo`, `voteThree`, `voteFour`, `voteFive`, `linkOne`, `linkTwo`, `linkThree`, `picture`, `userCreated`) VALUES
('G Day', 'Ludacris Performed', 'There were over 100,000 people in attendance', 'It occurred on 4/16/16', 'Neal Raines did not attend', 'Jacob Eason premiered as the black team''s Quarterback ', 5, 4, 2, 1, 3, 'http://www.georgiadogs.com/gday/', NULL, NULL, '', 'Neal Raines');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `userName` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`userName`, `password`, `isAdmin`) VALUES
('admin', 'admin', 1),
('Neal Raines', 'pass', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Event`
--
ALTER TABLE `Event`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`userName`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD UNIQUE KEY `userName_2` (`userName`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
