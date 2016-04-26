-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 26, 2016 at 09:49 PM
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
  `vote1` int(3) NOT NULL DEFAULT '0',
  `vote2` int(3) NOT NULL DEFAULT '0',
  `vote3` int(3) NOT NULL DEFAULT '0',
  `vote4` int(3) NOT NULL DEFAULT '0',
  `vote5` int(3) NOT NULL DEFAULT '0',
  `linkOne` varchar(50) NOT NULL,
  `linkTwo` varchar(50) DEFAULT NULL,
  `linkThree` varchar(50) DEFAULT NULL,
  `picture` varchar(50) NOT NULL,
  `userCreated` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Event`
--

INSERT INTO `Event` (`name`, `factOne`, `factTwo`, `factThree`, `factFour`, `factFive`, `vote1`, `vote2`, `vote3`, `vote4`, `vote5`, `linkOne`, `linkTwo`, `linkThree`, `picture`, `userCreated`) VALUES
('G Day', 'Ludacris performed as the pregame entertainment', 'There were over 100,000 people in attendance', 'Jacob Eason premiered as the black teams Quarterback', 'It occurred on 4/16/16', 'The game was streamed on ESPNU', 5, 4, 3, 2, 1, 'http://www.georgiadogs.com/gday/', NULL, NULL, '', 'Neal Raines'),
('Prince', 'Inducted into the Rock and Roll Hall of Fame in 2004', 'Died April 21st, 2016', 'Birthname was Prince Rogers Nelson', 'A master architect of funk, rock, R&amp;B and pop music', 'Won seven Grammy Awards, a Golden Globe Award, and an Academy Award', 7, 4, 3, 1, 0, 'https://en.wikipedia.org/wiki/Prince_%28musician%2', NULL, NULL, '', 'admin');

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
