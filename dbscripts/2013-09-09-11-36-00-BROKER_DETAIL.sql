-- phpMyAdmin SQL Dump
-- version 3.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 06, 2013 at 05:41 PM
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
-- Table structure for table `BROKER_DETAIL`
--

CREATE TABLE IF NOT EXISTS `BROKER_DETAIL` (
  `BROKER_ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `BROKER_CODE` varchar(50) NOT NULL,
  `BROKER_NAME` varchar(50) NOT NULL,
  `BROKER_TYPE` enum('W','R') NOT NULL DEFAULT 'R',
  `PRODUCT_TYPE` enum('PROPERTY','CASUALTY','PROFESSIONAL') NOT NULL,
  `SUBTYPE_OF_BROKER` varchar(55) NOT NULL,
  PRIMARY KEY (`BROKER_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `BROKER_DETAIL`
--

INSERT INTO `BROKER_DETAIL` (`BROKER_ID`, `BROKER_CODE`, `BROKER_NAME`, `BROKER_TYPE`, `PRODUCT_TYPE`, `SUBTYPE_OF_BROKER`) VALUES
(1, '00100', 'Aon', 'R', 'PROPERTY', ''),
(2, '00200', 'Arthur J. Gallagher', 'R', 'PROPERTY', ''),
(3, '00300', 'Lockton', 'R', 'PROPERTY', ''),
(4, '00400', 'Marsh', 'R', 'PROPERTY', ''),
(5, '00500', 'Wells Fargo', 'R', 'PROPERTY', ''),
(6, '00600', 'Willis', 'R', 'PROPERTY', ''),
(7, '00700', 'Haylor Freyer & Coon', 'R', 'PROPERTY', ''),
(8, '00800', 'ARA Risk Management', 'R', 'PROPERTY', ''),
(9, '00900', 'NSM Insurance', 'R', 'PROPERTY', ''),
(10, '01000', 'Northern Trust services', 'R', 'PROPERTY', ''),
(11, '01100', 'William Gallagher', 'R', 'PROPERTY', ''),
(12, '01200', 'Crystal', 'R', 'PROPERTY', ''),
(13, '01300', 'Beecher', 'R', 'PROPERTY', ''),
(14, '01400', 'Thomas E. Sears', 'R', 'PROPERTY', ''),
(15, '01500', 'Integro', 'R', 'PROPERTY', ''),
(16, '01600', 'Preferred Concepts', 'R', 'PROPERTY', ''),
(17, '01700', 'ProQuest', 'R', 'PROPERTY', ''),
(18, '01800', 'Lemme Insurance', 'R', 'PROPERTY', ''),
(19, '10000', 'AmWins', 'W', 'PROPERTY', ''),
(20, '10001', 'CRC-Crump', 'W', 'PROPERTY', ''),
(21, '10002', 'Partners Specialty', 'W', 'PROPERTY', ''),
(22, '10003', 'Peachtree', 'W', 'PROPERTY', ''),
(23, '10004', 'Risk Placement Services', 'W', 'PROPERTY', ''),
(24, '10005', 'RT Specialty', 'W', 'PROPERTY', ''),
(25, '10006', 'Swett', 'W', 'PROPERTY', ''),
(26, '10007', 'Westrope', 'W', 'PROPERTY', ''),
(27, '10008', 'Worldwide', 'W', 'PROPERTY', ''),
(28, '10009', 'Core Risk Partners', 'W', 'PROPERTY', ''),
(29, '10010', 'ARC Excess', 'W', 'PROPERTY', ''),
(30, '10011', 'Atlantic Risk', 'W', 'PROPERTY', ''),
(31, '10012', 'RLA Intermediaries', 'W', 'PROPERTY', ''),
(32, '10013', 'ARS Latiff', 'W', 'PROPERTY', ''),
(33, '10014', 'MacDuff Underwriters', 'W', 'PROPERTY', ''),
(34, '10015', 'WTCI', 'W', 'PROPERTY', ''),
(35, '10016', 'Energi', 'W', 'PROPERTY', ''),
(36, '10017', 'Maximum', 'W', 'PROPERTY', ''),
(37, '10018', 'Gresham & Associates', 'W', 'PROPERTY', ''),
(38, '10019', 'USG Insurance Services', 'W', 'PROPERTY', ''),
(39, '10020', 'ECC Insurance', 'W', 'PROPERTY', ''),
(40, '10021', 'Breckenridge Insurance', 'W', 'PROPERTY', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
