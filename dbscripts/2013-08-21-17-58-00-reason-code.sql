-- phpMyAdmin SQL Dump
-- version 3.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 21, 2013 at 05:55 PM
-- Server version: 5.5.12
-- PHP Version: 5.3.6

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
-- Table structure for table `REASON_CODE`
--

CREATE TABLE IF NOT EXISTS `REASON_CODE` (
  `REASON_CODE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `REASON_CODES` varchar(30) NOT NULL,
  `REASON` varchar(164) NOT NULL,
  `STATUS` enum('lost','declined') NOT NULL,
  PRIMARY KEY (`REASON_CODE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `REASON_CODE`
--

INSERT INTO `REASON_CODE` (`REASON_CODE_ID`, `REASON_CODES`, `REASON`, `STATUS`) VALUES
(1, 'D1', 'Product unavailable', 'declined'),
(2, 'D2', 'Below our minimum premium', 'declined'),
(3, 'D3', 'Pricing', 'declined'),
(4, 'D4', 'Appetite/program structure', 'declined'),
(5, 'D5', 'Broker clearance conflict', 'declined'),
(6, 'D6', 'Not otherwise classified', 'declined'),
(7, 'L1', 'Remained with incumbent', 'lost'),
(8, 'L2', 'No response – No underlying info, no response to questions, no expiring information provided', 'lost'),
(9, 'L3', 'Price', 'lost'),
(10, 'L4', 'Insured chose alternative program structure', 'lost'),
(11, 'L5', 'Broker lost the account', 'lost'),
(12, 'L6', 'Not otherwise classified', 'lost'),
(13, 'NA', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
