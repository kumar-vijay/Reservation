-- phpMyAdmin SQL Dump
-- version 3.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 19, 2013 at 12:04 PM
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
-- Table structure for table `ADDRESS`
--

CREATE TABLE IF NOT EXISTS `ADDRESS` (
  `ADDRESS_ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `SUBMISSION_ID` int(11) NOT NULL,
  `ADDRESS_LINE1` varchar(50) NOT NULL,
  `ADDRESS_LINE2` varchar(50) NOT NULL,
  `CITY` varchar(30) NOT NULL,
  `STATE_ID` smallint(9) NOT NULL,
  `ZIP_CODE` varchar(10) NOT NULL,
  `COUNTRY` varchar(20) NOT NULL,
  `ADDRESS_TYPE` enum('mailing','submission') NOT NULL DEFAULT 'mailing',
  `CREATED_ON` datetime NOT NULL,
  `MODIFIED_ON` datetime NOT NULL,
  PRIMARY KEY (`ADDRESS_ID`),
  UNIQUE KEY `SUBMISSION_ID` (`SUBMISSION_ID`,`ADDRESS_TYPE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ADDRESS_HISTORY`
--

CREATE TABLE IF NOT EXISTS `ADDRESS_HISTORY` (
  `ADDRESS_HISTORY_ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `SUBMISSION_HISTORY_ID` int(11) NOT NULL,
  `ADDRESS_LINE1` varchar(50) NOT NULL,
  `ADDRESS_LINE2` varchar(50) NOT NULL,
  `CITY` varchar(30) NOT NULL,
  `STATE_ID` int(11) NOT NULL,
  `ZIP_CODE` varchar(10) NOT NULL,
  `COUNTRY` varchar(20) NOT NULL,
  `ADDRESS_TYPE` enum('mailing','submission') NOT NULL DEFAULT 'mailing',
  `NEW_ADDRESS_LINE1` varchar(50) NOT NULL,
  `NEW_ADDRESS_LINE2` varchar(50) NOT NULL,
  `NEW_CITY` varchar(30) NOT NULL,
  `NEW_STATE_ID` int(11) NOT NULL,
  `NEW_ZIP_CODE` varchar(10) NOT NULL,
  `NEW_COUNTRY` varchar(20) NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  `MODIFIED_ON` datetime NOT NULL,
  PRIMARY KEY (`ADDRESS_HISTORY_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `BROKERS`
--

CREATE TABLE IF NOT EXISTS `BROKERS` (
  `BROKER_ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `BROKER_CODE` varchar(19) NOT NULL,
  `SUBMISSION_ID` int(11) NOT NULL,
  PRIMARY KEY (`BROKER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `BROKERS_HISTORY`
--

CREATE TABLE IF NOT EXISTS `BROKERS_HISTORY` (
  `BROKER_HISTORY_ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `BROKER_CODE` varchar(19) NOT NULL,
  `NEW_BROKER_CODE` varchar(19) NOT NULL,
  `SUBMISSION_HISTORY_ID` int(11) NOT NULL,
  PRIMARY KEY (`BROKER_HISTORY_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`BROKER_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `BROKER_DETAIL`
--

INSERT INTO `BROKER_DETAIL` (`BROKER_ID`, `BROKER_CODE`, `BROKER_NAME`, `BROKER_TYPE`, `PRODUCT_TYPE`) VALUES
(1, '00500', 'Wells Fargo', 'R', 'PROPERTY'),
(2, '00600', 'Willis', 'R', 'PROPERTY'),
(3, '00700', 'Haylor Freyer & Coon', 'R', 'PROPERTY'),
(4, '00800', 'ARA Risk Management', 'R', 'PROPERTY'),
(5, '10000', 'AmWins', 'W', 'PROPERTY'),
(6, '10001', 'CRC-Crump', 'W', 'PROPERTY'),
(7, '10002', 'Partners Specialty', 'W', 'PROPERTY'),
(8, '10003', 'Peachtree', 'W', 'PROPERTY'),
(9, '10004', 'Risk Placement Services', 'W', 'PROPERTY'),
(10, '10005', 'RT Specialty', 'W', 'PROPERTY'),
(11, '10006', 'Swett', 'W', 'PROPERTY'),
(12, '10007', 'Westrope', 'W', 'PROPERTY'),
(13, '10008', 'Worldwide', 'W', 'PROPERTY'),
(14, '10009', 'Core Risk Partners', 'W', 'PROPERTY'),
(15, '10010', 'ARC Excess', 'W', 'PROPERTY'),
(16, '10011', 'Atlantic Risk', 'W', 'PROPERTY'),
(17, '10012', 'RLA Intermediaries', 'W', 'PROPERTY'),
(18, '10013', 'ARS Latiff', 'W', 'PROPERTY'),
(19, '10014', 'MacDuff Underwriters', 'W', 'PROPERTY'),
(20, '', 'NSM Insurance', 'W', 'PROPERTY');

-- --------------------------------------------------------

--
-- Table structure for table `CITY`
--

CREATE TABLE IF NOT EXISTS `CITY` (
  `CITY_ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `CITY` varchar(50) NOT NULL,
  `STATE_ID` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`CITY_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=303 ;

--
-- Dumping data for table `CITY`
--

INSERT INTO `CITY` (`CITY_ID`, `CITY`, `STATE_ID`) VALUES
(1, 'Birmingham-0098', 1),
(2, 'Huntsville-0126', 1),
(3, 'Mobile-0118', 1),
(4, 'Montgomery-0103', 1),
(5, 'Portmouth-0296', 1),
(6, 'Anchorage-0065', 2),
(7, 'Chandler-0081', 3),
(8, 'Gilbert-0099', 3),
(9, 'Glendale-0087', 3),
(10, 'Mesa-0038', 3),
(11, 'Peoria-0151', 3),
(12, 'Phoenix-0006', 3),
(13, 'Scottsdale-0092', 3),
(14, 'Surprise-0215', 3),
(15, 'Tempe-0145', 3),
(16, 'Tucson-0033', 3),
(17, 'Little Rock-0117', 4),
(18, 'Anaheim-0054', 5),
(19, 'Antioch-0268', 5),
(20, 'Bakersfield-0052', 5),
(21, 'Berkeley-0233', 5),
(22, 'Burbank-0267', 5),
(23, 'Carlsbad-0254', 5),
(24, 'Chula Vista-0076', 5),
(25, 'Concord-0205', 5),
(26, 'Corona-0154', 5),
(27, 'Costa Mesa-0236', 5),
(28, 'Daly City-0273', 5),
(29, 'Downey-0235', 5),
(30, 'El Cajon-0281', 5),
(31, 'El Monte-0231', 5),
(32, 'Elk Grove-0155', 5),
(33, 'Escondido-0168', 5),
(34, 'Fairfield-0257', 5),
(35, 'Fontana-0112', 5),
(36, 'Fremont-0095', 5),
(37, 'Fresno-0034', 5),
(38, 'Fullerton-0182', 5),
(39, 'Garden Grove-0136', 5),
(40, 'Glendale-0121', 5),
(41, 'Hayward-0167', 5),
(42, 'Huntington Beach-0122', 5),
(43, 'Inglewood-0238', 5),
(44, 'Irvine-0096', 5),
(45, 'Lancaster-0147', 5),
(46, 'Long Beach-0036', 5),
(47, 'Los Angeles-0002', 5),
(48, 'Modesto-0107', 5),
(49, 'Moreno Valley-0114', 5),
(50, 'Murrieta-0259', 5),
(51, 'New Port Beach-0287', 5),
(52, 'Norwalk-0256', 5),
(53, 'Oakland-0046', 5),
(54, 'Oceanside-0138', 5),
(55, 'Ontario-0142', 5),
(56, 'Orange-0180', 5),
(57, 'Oxnard-0110', 5),
(58, 'Palmdale-0156', 5),
(59, 'Pasadena-0181', 5),
(60, 'Pomona-0161', 5),
(61, 'Rancho Cucamonga-0141', 5),
(62, 'Rialto-0283', 5),
(63, 'Richmond-0264', 5),
(64, 'Riverside-0059', 5),
(65, 'Roseville-0211', 5),
(66, 'Sacramento-0035', 5),
(67, 'Salinas-0158', 5),
(68, 'San Bernardino-0097', 5),
(69, 'San Buenaventura (Ventura)-0251', 5),
(70, 'San Diego-0008', 5),
(71, 'San Francisco-0014', 5),
(72, 'San Jose-0010', 5),
(73, 'Santa Ana-0057', 5),
(74, 'Santa Clara-0218', 5),
(75, 'Santa Clarita-0133', 5),
(76, 'Santa Maria-0284', 5),
(77, 'Santa Monica-0302', 5),
(78, 'Santa Rosa-0139', 5),
(79, 'Simi Valley-0200', 5),
(80, 'Stockton-0063', 5),
(81, 'Sunnyvale-0176', 5),
(82, 'Temecula-0272', 5),
(83, 'Thousand Oaks-0194', 5),
(84, 'Torrance-0164', 5),
(85, 'Vallejo-0225', 5),
(86, 'Victorville-0221', 5),
(87, 'Visalia-0198', 5),
(88, 'West Covina-0255', 5),
(89, 'Arvada-0250', 6),
(90, 'Aurora-0056', 6),
(91, 'Centennial-0271', 6),
(92, 'Colorado Springs-0041', 6),
(93, 'Denver-0023', 6),
(94, 'Fort Collins-0163', 6),
(95, 'Lakewood-0171', 6),
(96, 'Pueblo-0249', 6),
(97, 'Thornton-0212', 6),
(98, 'Westminster-0245', 6),
(99, 'Bridgeport-0169', 7),
(100, 'Hartford-0202', 7),
(101, 'New Haven-0192', 7),
(102, 'Stamford-0206', 7),
(103, 'Waterbury-0240', 7),
(104, 'Farmington-0290', 7),
(105, 'Washington-0024', 9),
(106, 'Cape Coral-0149', 10),
(107, 'Clearwater-0247', 10),
(108, 'Coral Springs-0207', 10),
(109, 'Daytona Beach-0299', 10),
(110, 'Fort Lauderdale-0140', 10),
(111, 'Gainesville-0201', 10),
(112, 'Hialeah-0089', 10),
(113, 'Hollywood-0173', 10),
(114, 'Jacksonville-0012', 10),
(115, 'Miami Gardens-0242', 10),
(116, 'Miami-0044', 10),
(117, 'Miramar-0204', 10),
(118, 'Orlando-0078', 10),
(119, 'Palm Bay-0270', 10),
(120, 'Pembroke Pines-0148', 10),
(121, 'Pompano Beach-0277', 10),
(122, 'Port St. Lucie-0143', 10),
(123, 'Satellite Beach-0286', 10),
(124, 'St. Petersburg-0077', 10),
(125, 'Tallahassee-0125', 10),
(126, 'Tampa-0053', 10),
(127, 'West Palm Beach-0280', 10),
(128, 'Alpharetta-0289', 11),
(129, 'Athens-0226', 11),
(130, 'Atlanta-0040', 11),
(131, 'Augusta-0116', 11),
(132, 'Columbus-0119', 11),
(133, 'Norcross-0297', 11),
(134, 'Savannah-0179', 11),
(135, 'Summit-0298', 11),
(136, 'Honolulu-0055', 12),
(137, 'Boise-0101', 13),
(138, 'Aurora-0111', 14),
(139, 'Chicago-0003', 14),
(140, 'Elgin-0243', 14),
(141, 'Joliet-0162', 14),
(142, 'Naperville-0174', 14),
(143, 'Peoria-0228', 14),
(144, 'Rockford-0160', 14),
(145, 'Springfield-0224', 14),
(146, 'Itasca-0291', 14),
(147, 'Evansville-0220', 15),
(148, 'Fort Wayne-0074', 15),
(149, 'Indianapolis-0013', 15),
(150, 'South Bend-0279', 15),
(151, 'Cedar Rapids-0196', 16),
(152, 'Davenport-0282', 16),
(153, 'Des Moines-0104', 16),
(154, 'Kansas City-0165', 17),
(155, 'Olathe-0195', 17),
(156, 'Overland Park-0134', 17),
(157, 'Topeka-0193', 17),
(158, 'Wichita-0049', 17),
(159, 'Lexington-0062', 18),
(160, 'Louisville-0027', 18),
(161, 'Baton Rouge-0088', 19),
(162, 'Lafayette-0210', 19),
(163, 'New Orleans-0051', 19),
(164, 'Shreveport-0108', 19),
(165, 'Baltimore-0026', 21),
(166, 'Potomac-0294', 21),
(167, 'Boston-0021', 22),
(168, 'Cambridge-0258', 22),
(169, 'Lowell-0248', 22),
(170, 'Springfield-0157', 22),
(171, 'Worcester-0127', 22),
(172, 'Ann Arbor-0229', 23),
(173, 'Detroit-0018', 23),
(174, 'Flint-0278', 23),
(175, 'Grand Rapids-0124', 23),
(176, 'Lansing-0230', 23),
(177, 'Sterling Heights-0191', 23),
(178, 'Warren-0186', 23),
(179, 'Southfield-0293', 23),
(180, 'Minneapolis-0048', 24),
(181, 'Rochester-0246', 24),
(182, 'Saint Paul-0066', 24),
(183, 'Jackson-0135', 25),
(184, 'Columbia-0239', 26),
(185, 'Independence-0222', 26),
(186, 'Kansas City-0037', 26),
(187, 'Springfield-0146', 26),
(188, 'St. Louis-0058', 26),
(189, 'Billings-0263', 27),
(190, 'Lincoln-0071', 28),
(191, 'Omaha-0043', 28),
(192, 'Henderson-0073', 29),
(193, 'Las Vegas-0031', 29),
(194, 'North Las Vegas-0094', 29),
(195, 'Reno-0090', 29),
(196, 'Manchester-0241', 30),
(197, 'Elizabeth-0199', 31),
(198, 'Jersey City-0075', 31),
(199, 'Newark-0068', 31),
(200, 'Paterson-0166', 31),
(201, 'Edison-0288', 31),
(202, 'Mahwah-0292', 31),
(203, 'Roseland-0295', 31),
(204, 'Albuquerque-0032', 32),
(205, 'Buffalo-0072', 33),
(206, 'New York-0001', 33),
(207, 'Rochester-0100', 33),
(208, 'Syracuse-0170', 33),
(209, 'Yonkers-0115', 33),
(210, 'Cary-0178', 34),
(211, 'Charlotte-0017', 34),
(212, 'Durham-0084', 34),
(213, 'Fayetteville-0106', 34),
(214, 'Greensboro-0069', 34),
(215, 'High Point-0261', 34),
(216, 'Raleigh-0042', 34),
(217, 'Wilmington-0244', 34),
(218, 'Winston–Salem-0085', 34),
(219, 'Fargo-0253', 35),
(220, 'Akron-0113', 36),
(221, 'Cincinnati-0064', 36),
(222, 'Cleveland-0047', 36),
(223, 'Columbus-0015', 36),
(224, 'Dayton-0177', 36),
(225, 'Toledo-0067', 36),
(226, 'Broken Arrow-0285', 37),
(227, 'Norman-0234', 37),
(228, 'Oklahoma City-0029', 37),
(229, 'Tulsa-0045', 37),
(230, 'Eugene-0150', 38),
(231, 'Gresham-0252', 38),
(232, 'Portland-0028', 38),
(233, 'Salem-0153', 38),
(234, 'Allentown-0216', 39),
(235, 'Erie-0275', 39),
(236, 'Philadelphia-0005', 39),
(237, 'Pittsburgh-0061', 39),
(238, 'Radnor-0301', 39),
(239, 'Providence-0132', 40),
(240, 'Charleston-0208', 41),
(241, 'Columbia-0189', 41),
(242, 'Sioux Falls-0152', 42),
(243, 'Chattanooga-0137', 43),
(244, 'Clarksville-0184', 43),
(245, 'Franklin-0300', 43),
(246, 'Knoxville-0128', 43),
(247, 'Memphis-0020', 43),
(248, 'Murfreesboro-0237', 43),
(249, 'Nashville-0025', 43),
(250, 'Abilene-0219', 44),
(251, 'Amarillo-0120', 44),
(252, 'Arlington-0050', 44),
(253, 'Austin-0011', 44),
(254, 'Beaumont-0217', 44),
(255, 'Brownsville-0131', 44),
(256, 'Carrollton-0209', 44),
(257, 'Corpus Christi-0060', 44),
(258, 'Dallas-0009', 44),
(259, 'Denton-0223', 44),
(260, 'El Paso-0019', 44),
(261, 'Fort Worth-0016', 44),
(262, 'Frisco-0213', 44),
(263, 'Garland-0086', 44),
(264, 'Grand Prairie-0130', 44),
(265, 'Houston-0004', 44),
(266, 'Irving-0093', 44),
(267, 'Killeen-0190', 44),
(268, 'Laredo-0080', 44),
(269, 'Lubbock-0083', 44),
(270, 'McAllen-0187', 44),
(271, 'McKinney-0185', 44),
(272, 'Mesquite-0175', 44),
(273, 'Midland-0232', 44),
(274, 'Odessa-0274', 44),
(275, 'Pasadena-0159', 44),
(276, 'Plano-0070', 44),
(277, 'Richardson-0276', 44),
(278, 'Round Rock-0265', 44),
(279, 'San Antonio-0007', 44),
(280, 'Waco-0197', 44),
(281, 'Wichita Falls-0269', 44),
(282, 'Provo-0227', 45),
(283, 'Salt Lake City-0123', 45),
(284, 'West Jordan-0262', 45),
(285, 'West Valley City-0188', 45),
(286, 'Alexandria-0172', 47),
(287, 'Chesapeake-0091', 47),
(288, 'Hampton-0183', 47),
(289, 'Newport News-0129', 47),
(290, 'Norfolk-0079', 47),
(291, 'Richmond-0105', 47),
(292, 'Virginia Beach-0039', 47),
(293, 'Bellevue-0203', 48),
(294, 'Everett-0266', 48),
(295, 'Kent-0214', 48),
(296, 'Seattle-0022', 48),
(297, 'Spokane-0102', 48),
(298, 'Tacoma-0109', 48),
(299, 'Vancouver-0144', 48),
(300, 'Green Bay-0260', 50),
(301, 'Madison-0082', 50),
(302, 'Milwaukee-0030', 50);

-- --------------------------------------------------------

--
-- Table structure for table `COUNTRY`
--

CREATE TABLE IF NOT EXISTS `COUNTRY` (
  `COUNTRY_ID` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `COUNTRY` varchar(50) NOT NULL,
  PRIMARY KEY (`COUNTRY_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `COUNTRY`
--

INSERT INTO `COUNTRY` (`COUNTRY_ID`, `COUNTRY`) VALUES
(1, '001 - USA'),
(2, '002 - CANADA'),
(3, '003 - UK');

-- --------------------------------------------------------

--
-- Table structure for table `DOCUMENTS`
--

CREATE TABLE IF NOT EXISTS `DOCUMENTS` (
  `DOCUMENT_ID` smallint(6) NOT NULL AUTO_INCREMENT,
  `SUBMISSION_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `FILE_NAME` varchar(100) NOT NULL,
  `DOCUMENT_TYPE` enum('1','2','3','4','5','6','7') NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  `MODIFIED_ON` datetime NOT NULL,
  `REMOVE_FLAG` enum('removed','notremoved') NOT NULL,
  PRIMARY KEY (`DOCUMENT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `GROUPS`
--

CREATE TABLE IF NOT EXISTS `GROUPS` (
  `GROUP_ID` smallint(6) NOT NULL AUTO_INCREMENT,
  `GROUP_NAME` varchar(100) NOT NULL,
  `STATUS` enum('active','inactive') NOT NULL,
  `CREATED_ON` datetime DEFAULT NULL,
  `MODIFIED_ON` datetime DEFAULT NULL,
  `CREATED_BY_ID` smallint(6) NOT NULL,
  `MODIFIED_BY_ID` smallint(6) NOT NULL,
  PRIMARY KEY (`GROUP_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `GROUPS`
--

INSERT INTO `GROUPS` (`GROUP_ID`, `GROUP_NAME`, `STATUS`, `CREATED_ON`, `MODIFIED_ON`, `CREATED_BY_ID`, `MODIFIED_BY_ID`) VALUES
(1, 'admin', 'active', '2013-07-05 00:00:00', '2013-07-05 00:00:00', 0, 0),
(2, 'group name', 'inactive', '2013-07-15 10:41:25', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `GROUP_RIGHTS`
--

CREATE TABLE IF NOT EXISTS `GROUP_RIGHTS` (
  `GROUP_RIGHTS_ID` smallint(6) NOT NULL AUTO_INCREMENT,
  `GROUP_RIGHTS_NAME` varchar(50) NOT NULL,
  PRIMARY KEY (`GROUP_RIGHTS_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `GROUP_RIGHTS`
--

INSERT INTO `GROUP_RIGHTS` (`GROUP_RIGHTS_ID`, `GROUP_RIGHTS_NAME`) VALUES
(1, 'VIEW_GROUP_LIST'),
(2, 'VIEW_EDIT_GROUP'),
(3, 'VIEW_USER_LIST'),
(4, 'VIEW_EDIT_USER'),
(5, 'VIEW_SUBMISSION'),
(6, 'VIEW_EDIT_SUBMISSION'),
(7, 'EXPORT_SUBMISSION');

-- --------------------------------------------------------

--
-- Table structure for table `GROUP_RIGHTS_MAPPER`
--

CREATE TABLE IF NOT EXISTS `GROUP_RIGHTS_MAPPER` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `GROUP_ID` smallint(5) unsigned NOT NULL,
  `GROUP_RIGHTS_ID` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `GROUP_RIGHTS_MAPPER`
--

INSERT INTO `GROUP_RIGHTS_MAPPER` (`ID`, `GROUP_ID`, `GROUP_RIGHTS_ID`) VALUES
(1, 1, 1),
(3, 1, 2),
(4, 1, 3),
(5, 1, 4),
(6, 1, 5),
(7, 1, 6),
(8, 1, 7),
(9, 2, 1),
(10, 2, 2),
(11, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `PRODUCTS`
--

CREATE TABLE IF NOT EXISTS `PRODUCTS` (
  `PRODUCT_ID` smallint(6) NOT NULL AUTO_INCREMENT,
  `PRODUCT_NAME` varchar(50) NOT NULL,
  `SUBMISSION_TYPE` enum('Property','Casualty','Transportation','Professional Liability') NOT NULL,
  PRIMARY KEY (`PRODUCT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `PRODUCTS`
--

INSERT INTO `PRODUCTS` (`PRODUCT_ID`, `PRODUCT_NAME`, `SUBMISSION_TYPE`) VALUES
(3, '0101 Property', 'Property'),
(4, '0102 Inland Marine', 'Property'),
(5, '0103 Stand Alone Terroism', 'Property'),
(6, '0201 Primary Casualty', 'Casualty'),
(7, '0202 Umbrella', 'Casualty'),
(8, '0203 Excess Casualty', 'Casualty'),
(9, '0205 Medical', 'Casualty'),
(10, 'Transportation', 'Transportation'),
(11, 'Professional Liability', 'Professional Liability');

-- --------------------------------------------------------

--
-- Table structure for table `STATES`
--

CREATE TABLE IF NOT EXISTS `STATES` (
  `STATE_ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `BRANCH_ID` smallint(5) unsigned DEFAULT NULL,
  `STATE_NAME` varchar(50) NOT NULL,
  `COUNTRY_ID` smallint(6) unsigned NOT NULL,
  `COUNTRY` varchar(50) NOT NULL,
  PRIMARY KEY (`STATE_ID`),
  KEY `COUNTRY_ID` (`COUNTRY_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `STATES`
--

INSERT INTO `STATES` (`STATE_ID`, `BRANCH_ID`, `STATE_NAME`, `COUNTRY_ID`, `COUNTRY`) VALUES
(1, 2, 'AL_001', 1, '001 - USA'),
(2, 4, 'AK_002', 1, '001 - USA'),
(3, 4, 'AZ_004', 1, '001 - USA'),
(4, 3, 'AR_005', 1, '001 - USA'),
(5, 4, 'CA_006', 1, '001 - USA'),
(6, 4, 'CO_008', 1, '001 - USA'),
(7, 2, 'CT_009', 1, '001 - USA'),
(8, 2, 'DE_010', 1, '001 - USA'),
(9, NULL, 'DC_011', 1, '001 - USA'),
(10, 2, 'FL_012', 1, '001 - USA'),
(11, 2, 'GA_013', 1, '001 - USA'),
(12, 4, 'HI_015', 1, '001 - USA'),
(13, 4, 'ID_016', 1, '001 - USA'),
(14, 3, 'IL_017', 1, '001 - USA'),
(15, 3, 'IN_018', 1, '001 - USA'),
(16, 3, 'IA_019', 1, '001 - USA'),
(17, 3, 'KS_020', 1, '001 - USA'),
(18, 3, 'KY_021', 1, '001 - USA'),
(19, 3, 'LA_022', 1, '001 - USA'),
(20, 2, 'ME_023', 1, '001 - USA'),
(21, 2, 'MD_024', 1, '001 - USA'),
(22, 2, 'MA_025', 1, '001 - USA'),
(23, 3, 'MI_026', 1, '001 - USA'),
(24, 3, 'MN_027', 1, '001 - USA'),
(25, 2, 'MS_028', 1, '001 - USA'),
(26, 3, 'MO_029', 1, '001 - USA'),
(27, 4, 'MT_030', 1, '001 - USA'),
(28, 3, 'NE_031', 1, '001 - USA'),
(29, 4, 'NV_032', 1, '001 - USA'),
(30, 2, 'NH_033', 1, '001 - USA'),
(31, 2, 'NJ_034', 1, '001 - USA'),
(32, 4, 'NM_035', 1, '001 - USA'),
(33, 2, 'NY_036', 1, '001 - USA'),
(34, 2, 'NC_037', 1, '001 - USA'),
(35, 3, 'ND_038', 1, '001 - USA'),
(36, 3, 'OH_039', 1, '001 - USA'),
(37, 3, 'OK_040', 1, '001 - USA'),
(38, 4, 'OR_041', 1, '001 - USA'),
(39, 2, 'PA_042', 1, '001 - USA'),
(40, 2, 'RI_044', 1, '001 - USA'),
(41, 2, 'SC_045', 1, '001 - USA'),
(42, 3, 'SD_046', 1, '001 - USA'),
(43, 2, 'TN_047', 1, '001 - USA'),
(44, 3, 'TX_048', 1, '001 - USA'),
(45, 4, 'UT_049', 1, '001 - USA'),
(46, 2, 'VT_050', 1, '001 - USA'),
(47, 2, 'VA_051', 1, '001 - USA'),
(48, 4, 'WA_053', 1, '001 - USA'),
(49, 3, 'WV_054', 1, '001 - USA'),
(50, 3, 'WI_055', 1, '001 - USA'),
(51, 4, 'WY_056', 1, '001 - USA'),
(52, NULL, 'AS_060', 1, '001 - USA'),
(53, NULL, 'GU_066', 1, '001 - USA'),
(54, NULL, 'MP_069', 1, '001 - USA'),
(55, NULL, 'PR_072', 1, '001 - USA'),
(56, NULL, 'VI_078', 1, '001 - USA'),
(57, NULL, 'UM_074', 1, '001 - USA');

-- --------------------------------------------------------

--
-- Table structure for table `SUBMISSION`
--

CREATE TABLE IF NOT EXISTS `SUBMISSION` (
  `SUBMISSION_ID` int(11) NOT NULL AUTO_INCREMENT,
  `SUBMISSION_NO` char(15) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `SUBMISSION_TYPE` enum('Property','Casualty','Transportation','Professional Liability') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `SUBMISSION_BRANCH_ID` int(11) NOT NULL,
  `DB_NUMBER` varchar(30) NOT NULL,
  `INSURED_NAME` varchar(50) NOT NULL,
  `USER_ID` int(11) unsigned NOT NULL,
  `UNDERWRITER_ID` int(11) NOT NULL,
  `PRODUCT_ID` int(11) NOT NULL,
  `PRIMARY_STATUS` enum('working','blocked','declined','quoted','bound','lost','closed','indicated') NOT NULL,
  `BLOCK_REASON` enum('soft_block','hard_block','OFAC_block') NOT NULL,
  `SECONDARY_STATUS` enum('blocked','lost','closed') NOT NULL,
  `LIMIT` int(10) NOT NULL DEFAULT '0',
  `ATTACHMENT_POINT` int(10) NOT NULL DEFAULT '0',
  `PREMIUM` int(10) NOT NULL DEFAULT '0',
  `COMMISSION` int(10) NOT NULL DEFAULT '0',
  `TOTAL_INSURED_VALUE` int(10) NOT NULL DEFAULT '0',
  `RELATIVITY` int(10) NOT NULL DEFAULT '0',
  `BY_BERKSI_FROM_BROKER` date DEFAULT NULL,
  `BY_INDIA_BY_BERKSI` date DEFAULT NULL,
  `REMARKS` text NOT NULL,
  `INSURED_NAME_DNB` varchar(100) NOT NULL,
  `IS_NAME_DIFFERENT` enum('Y','N') NOT NULL DEFAULT 'N',
  `IS_ADDRESS_DIFFERENT` enum('Y','N') NOT NULL DEFAULT 'N',
  `EFFECTIVE_DATE` date NOT NULL,
  `EXPIRATION_DATE` date NOT NULL,
  `CREATION_DATE` datetime NOT NULL,
  `MODIFY_DATE` datetime NOT NULL,
  PRIMARY KEY (`SUBMISSION_ID`),
  UNIQUE KEY `SUBMISSION_NO` (`SUBMISSION_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SUBMISSION_BRANCH`
--

CREATE TABLE IF NOT EXISTS `SUBMISSION_BRANCH` (
  `BRANCH_ID` int(11) NOT NULL AUTO_INCREMENT,
  `BRANCH_CODE` varchar(30) NOT NULL,
  `STATUS` enum('active','inactive') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`BRANCH_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `SUBMISSION_BRANCH`
--

INSERT INTO `SUBMISSION_BRANCH` (`BRANCH_ID`, `BRANCH_CODE`, `STATUS`) VALUES
(1, '001 Boston', 'active'),
(2, '002 New York', 'active'),
(3, '003 Chicago', 'active'),
(4, '004 Los Angeles', 'active'),
(5, '005 Atlanta', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `SUBMISSION_EXTRA_DETAILS`
--

CREATE TABLE IF NOT EXISTS `SUBMISSION_EXTRA_DETAILS` (
  `SUBMISSION_EXTRA_ID` smallint(6) NOT NULL,
  `SUBMISSION_ID` int(11) NOT NULL,
  `INSURED_NAME_FRM_SUBM` varchar(100) NOT NULL,
  UNIQUE KEY `SUBMISSION_ID` (`SUBMISSION_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SUBMISSION_HISTORY`
--

CREATE TABLE IF NOT EXISTS `SUBMISSION_HISTORY` (
  `SUBMISSION_HISTORY_ID` int(11) NOT NULL AUTO_INCREMENT,
  `SUBMISSION_ID` int(11) NOT NULL,
  `SUBMISSION_TYPE` enum('Property','Casualty','Transportation','Professional Liability') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `SUBMISSION_BRANCH_ID` int(11) NOT NULL,
  `DB_NUMBER` varchar(30) NOT NULL,
  `INSURED_NAME` varchar(100) NOT NULL,
  `USER_ID` int(11) unsigned NOT NULL,
  `UNDERWRITER_ID` int(11) NOT NULL,
  `PRODUCT_ID` int(11) NOT NULL,
  `PRIMARY_STATUS` enum('working','blocked','declined','quoted','bound','lost','closed') NOT NULL,
  `BLOCK_REASON` enum('soft_block','hard_block','OFAC_block') NOT NULL,
  `SECONDARY_STATUS` enum('blocked','lost','closed') NOT NULL,
  `OCCUR_LIMIT` int(10) NOT NULL,
  `PREMIUM_DAMAGE` int(10) NOT NULL,
  `MEDICAL_LIMIT` int(10) NOT NULL,
  `PER_INJURY_LIMIT` int(10) NOT NULL,
  `AGGREGATE_LIMIT` int(10) NOT NULL,
  `OPERATION_AGGREGATE` int(10) NOT NULL,
  `PREMIUM` int(10) NOT NULL,
  `INSURED_NAME_DNB` varchar(100) NOT NULL,
  `IS_NAME_DIFFERENT` enum('Y','N') NOT NULL DEFAULT 'N',
  `IS_ADDRESS_DIFFERENT` enum('Y','N') NOT NULL DEFAULT 'N',
  `EFFECTIVE_DATE` date NOT NULL,
  `EXPIRATION_DATE` date NOT NULL,
  `NEW_SUBMISSION_TYPE` enum('Property','Casualty','Transportation','Professional Liability') NOT NULL,
  `NEW_SUBMISSION_BRANCH_ID` int(11) NOT NULL,
  `NEW_DB_NUMBER` varchar(30) NOT NULL,
  `NEW_INSURED_NAME` varchar(100) NOT NULL,
  `NEW_UNDERWRITER_ID` int(11) NOT NULL,
  `NEW_PRODUCT_ID` int(11) NOT NULL,
  `NEW_PRIMARY_STATUS` enum('working','blocked','declined','quoted','bound','lost','closed') NOT NULL,
  `NEW_BLOCK_REASON` enum('soft_block','hard_block','OFAC_block') NOT NULL,
  `NEW_SECONDARY_STATUS` enum('blocked','lost','closed') NOT NULL,
  `NEW_OCCUR_LIMIT` int(10) NOT NULL,
  `NEW_PREMIUM_DAMAGE` int(10) NOT NULL,
  `NEW_MEDICAL_LIMIT` int(10) NOT NULL,
  `NEW_PER_INJURY_LIMIT` int(10) NOT NULL,
  `NEW_AGGREGATE_LIMIT` int(10) NOT NULL,
  `NEW_OPERATION_AGGREGATE` int(10) NOT NULL,
  `NEW_PREMIUM` int(10) NOT NULL,
  `NEW_REMARKS` text NOT NULL,
  `NEW_INSURED_NAME_DNB` varchar(100) NOT NULL,
  `NEW_IS_NAME_DIFFERENT` enum('Y','N') NOT NULL DEFAULT 'N',
  `NEW_IS_ADDRESS_DIFFERENT` enum('Y','N') NOT NULL DEFAULT 'N',
  `NEW_EFFECTIVE_DATE` date NOT NULL,
  `NEW_EXPIRATION_DATE` date NOT NULL,
  `MODIFY_DATE` datetime NOT NULL,
  PRIMARY KEY (`SUBMISSION_HISTORY_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SUBMISSION_HISTORY_EXTRA_DETAILS`
--

CREATE TABLE IF NOT EXISTS `SUBMISSION_HISTORY_EXTRA_DETAILS` (
  `SUBMISSION_EXTRA_ID` int(11) NOT NULL AUTO_INCREMENT,
  `SUBMISSION_HISTORY_ID` int(11) NOT NULL,
  `INSURED_NAME_FRM_SUBM` varchar(100) NOT NULL,
  `NEW_INSURED_NAME_FRM_SUBM` varchar(100) NOT NULL,
  PRIMARY KEY (`SUBMISSION_EXTRA_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `SUBMISSION_SEARCH`
--
CREATE TABLE IF NOT EXISTS `SUBMISSION_SEARCH` (
`SUBMISSION_ID` int(11)
,`SUBMISSION_NUMBER` char(15)
,`DB_NUMBER` varchar(30)
,`INSURED_NAME_DNB` varchar(100)
,`EFFECTIVE_DATE` date
,`UNDERWRITER` varchar(50)
,`EXPIRATION_DATE` date
,`BROKER_CODE` varchar(19)
,`PRIMARY_STATUS` enum('working','blocked','declined','quoted','bound','lost','closed','indicated')
,`INSURED_NAME` varchar(50)
,`CREATION_DATE` datetime
,`MODIFY_DATE` datetime
,`BRANCH_CODE` varchar(30)
,`BRANCH_ID` int(11)
);
-- --------------------------------------------------------

--
-- Table structure for table `UNDERWRITER`
--

CREATE TABLE IF NOT EXISTS `UNDERWRITER` (
  `UNDERWRITER_ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `UNDERWRITER_NAME` varchar(50) NOT NULL,
  `BRANCH_ID` smallint(5) unsigned NOT NULL,
  `SUBMISSION_TYPE` enum('PROPERTY','CASUALTY','PROFESSIONAL','TRANSPORTATION') NOT NULL,
  PRIMARY KEY (`UNDERWRITER_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `UNDERWRITER`
--

INSERT INTO `UNDERWRITER` (`UNDERWRITER_ID`, `UNDERWRITER_NAME`, `BRANCH_ID`, `SUBMISSION_TYPE`) VALUES
(1, 'Bill Smyth', 1, 'CASUALTY'),
(2, 'Melissa Henry', 1, 'CASUALTY'),
(3, 'Meredith Bullock', 1, 'CASUALTY'),
(4, 'Michael Foley', 1, 'CASUALTY'),
(5, 'Justin Tuohey', 2, 'CASUALTY'),
(6, 'Karen London', 2, 'CASUALTY'),
(7, 'Kathy Reid', 3, 'CASUALTY'),
(8, 'Marcie Stephan', 3, 'CASUALTY'),
(9, 'Matt Hale', 3, 'CASUALTY'),
(10, 'Anjala Amin', 4, 'CASUALTY'),
(11, 'Tracy Shannon', 1, 'CASUALTY'),
(12, 'Morgan Wichmann', 2, 'CASUALTY'),
(13, 'Kelly Kendall', 1, 'CASUALTY'),
(14, 'David Bresnahan', 1, 'PROFESSIONAL');

-- --------------------------------------------------------

--
-- Table structure for table `USERS`
--

CREATE TABLE IF NOT EXISTS `USERS` (
  `USER_ID` smallint(6) NOT NULL AUTO_INCREMENT,
  `EMAIL_ID` varchar(100) NOT NULL,
  `FIRSTNAME` varchar(50) NOT NULL,
  `LASTNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `GROUP_ID` smallint(6) NOT NULL,
  `USER_STATUS` enum('Active','Inactive') NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  `MODIFIED_ON` datetime NOT NULL,
  `CREATED_BY_ID` smallint(6) NOT NULL,
  `MODIFIED_BY_ID` smallint(6) NOT NULL,
  PRIMARY KEY (`USER_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `USERS`
--

INSERT INTO `USERS` (`USER_ID`, `EMAIL_ID`, `FIRSTNAME`, `LASTNAME`, `PASSWORD`, `GROUP_ID`, `USER_STATUS`, `CREATED_ON`, `MODIFIED_ON`, `CREATED_BY_ID`, `MODIFIED_BY_ID`) VALUES
(1, 'devendra.singh@berkshireinsurance.com', 'devendra', 'singh', '1ea2b70c4e5965e3bc1224730969fcc8', 1, 'Active', '2013-07-05 00:00:00', '2013-07-05 00:00:00', 0, 0),
(2, 'nishant.yadav@berkshireindia.com', 'nishant', 'yadav', '0e11d184398255abe79cac2d7d7fec73', 1, 'Active', '2013-07-05 00:00:00', '2013-07-05 00:00:00', 0, 0),
(3, 'email@email.com', 'deven', 'singh', '1ea2b70c4e5965e3bc1224730969fcc8', 1, 'Active', '2013-07-12 15:19:06', '2013-07-12 15:19:06', 1, 1);

-- --------------------------------------------------------

--
-- Structure for view `SUBMISSION_SEARCH`
--
DROP TABLE IF EXISTS `SUBMISSION_SEARCH`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `SUBMISSION_SEARCH` AS select `SUB`.`SUBMISSION_ID` AS `SUBMISSION_ID`,`SUB`.`SUBMISSION_NO` AS `SUBMISSION_NUMBER`,`SUB`.`DB_NUMBER` AS `DB_NUMBER`,`SUB`.`INSURED_NAME_DNB` AS `INSURED_NAME_DNB`,`SUB`.`EFFECTIVE_DATE` AS `EFFECTIVE_DATE`,ifnull(`U`.`UNDERWRITER_NAME`,'NA') AS `UNDERWRITER`,`SUB`.`EXPIRATION_DATE` AS `EXPIRATION_DATE`,`BRO`.`BROKER_CODE` AS `BROKER_CODE`,`SUB`.`PRIMARY_STATUS` AS `PRIMARY_STATUS`,`SUB`.`INSURED_NAME` AS `INSURED_NAME`,`SUB`.`CREATION_DATE` AS `CREATION_DATE`,`SUB`.`MODIFY_DATE` AS `MODIFY_DATE`,`SUBMISSION_BRANCH`.`BRANCH_CODE` AS `BRANCH_CODE`,`SUBMISSION_BRANCH`.`BRANCH_ID` AS `BRANCH_ID` from (((`SUBMISSION` `SUB` join `BROKERS` `BRO` on((`BRO`.`SUBMISSION_ID` = `SUB`.`SUBMISSION_ID`))) left join `UNDERWRITER` `U` on((`U`.`UNDERWRITER_ID` = `SUB`.`UNDERWRITER_ID`))) left join `SUBMISSION_BRANCH` on((`SUBMISSION_BRANCH`.`BRANCH_ID` = `SUB`.`SUBMISSION_BRANCH_ID`)));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
