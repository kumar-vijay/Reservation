-- phpMyAdmin SQL Dump
-- version 3.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 15, 2013 at 01:06 PM
-- Server version: 5.5.28
-- PHP Version: 5.3.18

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `QUARTERLY_REPORT`
--

CREATE TABLE IF NOT EXISTS `QUARTERLY_REPORT` (
  `QUARTERS` varchar(30) NOT NULL,
  `QVALUE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `QUARTERLY_REPORT`
--

INSERT INTO `QUARTERLY_REPORT` (`QUARTERS`, `QVALUE`) VALUES
('1st Quarter', 1),
('2nd Quarter', 2),
('3rd Quarter', 3),
('4th Quarter', 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
