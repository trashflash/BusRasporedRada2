-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2018 at 01:53 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rasporedrada`
--

-- --------------------------------------------------------

--
-- Table structure for table `absences`
--

CREATE TABLE IF NOT EXISTS `absences` (
  `ID_Absence` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Driver` int(11) NOT NULL,
  `FromDate` date NOT NULL,
  `ToDate` date NOT NULL,
  `Reason` varchar(15) NOT NULL,
  PRIMARY KEY (`ID_Absence`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `absences`
--

INSERT INTO `absences` (`ID_Absence`, `ID_Driver`, `FromDate`, `ToDate`, `Reason`) VALUES
(1, 100, '2018-08-15', '2018-08-22', 'GODIŠNJI ODMOR'),
(2, 102, '2018-08-16', '2018-08-30', 'BOLOVANJE');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `ID_Admin` int(11) NOT NULL,
  `Username` varchar(35) NOT NULL,
  `Password` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

CREATE TABLE IF NOT EXISTS `buses` (
  `ID_Bus` int(11) NOT NULL,
  `TypeBus` varchar(25) NOT NULL,
  `Description` varchar(200) DEFAULT NULL,
  `Plates` varchar(10) NOT NULL,
  `Broken` tinyint(1) NOT NULL,
  `Reserved` tinyint(1) NOT NULL,
  `Photo_Link_Bus` varchar(100) DEFAULT NULL,
  UNIQUE KEY `ID_Bus` (`ID_Bus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`ID_Bus`, `TypeBus`, `Description`, `Plates`, `Broken`, `Reserved`, `Photo_Link_Bus`) VALUES
(6, 'PRIGRADSKI', 'prigradski 50 mesta', 'SU006PP', 0, 0, 'images/bus/23-08-2018-1535034807.jpg'),
(102, 'GRADSKI ZGLOBNI', '110 mesta, 2002. god, beli', 'SU014LC', 0, 0, 'images/bus/23-08-2018-1535032349.jpg'),
(202, 'GRADSKI SOLO', 'solo, 70 mesta, 2017 god.', 'SU202XZ', 0, 0, 'images/bus/23-08-2018-1535034773.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE IF NOT EXISTS `drivers` (
  `ID_Driver` int(11) NOT NULL,
  `First_Name` varchar(40) NOT NULL,
  `Last_Name` varchar(11) NOT NULL,
  `Password` varchar(55) DEFAULT NULL,
  `Digital_Tachograph` tinyint(1) DEFAULT NULL,
  `Area` int(11) DEFAULT NULL,
  `Bus_Own` int(11) DEFAULT NULL,
  `Photo_Link_Driver` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`ID_Driver`, `First_Name`, `Last_Name`, `Password`, `Digital_Tachograph`, `Area`, `Bus_Own`, `Photo_Link_Driver`) VALUES
(0, 'Nema', 'Nema', NULL, NULL, NULL, NULL, NULL),
(100, 'Zoltan', 'Boros', '193d23dde80fd4f1dc74c389894a52f4', 0, 1, 6, NULL),
(102, 'Bence', 'Boros', '923352284767451ab158a387a283df26', 0, 1, 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `OrderID` int(11) NOT NULL AUTO_INCREMENT,
  `OrderDate` date NOT NULL,
  `OrderText` varchar(1500) NOT NULL,
  `OrderImportance` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`OrderID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `OrderDate`, `OrderText`, `OrderImportance`) VALUES
(1, '2018-08-15', 'gnhghfgfjhjhjkhjkhjk', 0);

-- --------------------------------------------------------

--
-- Table structure for table `published`
--

CREATE TABLE IF NOT EXISTS `published` (
  `Date_Published` date NOT NULL,
  `Published` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tours`
--

CREATE TABLE IF NOT EXISTS `tours` (
  `ID_Tour` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Description` varchar(100) DEFAULT NULL,
  `Start_Time` time NOT NULL,
  `End_Time` time NOT NULL,
  `Total_Time` time NOT NULL,
  `Type_Tour` int(11) NOT NULL,
  `Type_Day` int(11) NOT NULL,
  `Photo_Link_Tour` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tours`
--

INSERT INTO `tours` (`ID_Tour`, `Name`, `Description`, `Start_Time`, `End_Time`, `Total_Time`, `Type_Tour`, `Type_Day`, `Photo_Link_Tour`) VALUES
(10111, '1/I', '1/I Linija 1 prepodne', '04:50:00', '09:00:00', '04:10:00', 3, 15, NULL),
(10113, '1/I ', '1/I C Linija 1 prepodne ', '04:50:00', '09:00:00', '04:10:00', 3, 15, NULL),
(10123, '1/II', '1/II C Linija 1 poslepodne', '11:40:00', '16:25:00', '04:45:00', 3, 15, NULL),
(10133, '1/III', 'šđđčććđžalKASHJKASDHKDHKD', '14:40:00', '23:10:00', '08:30:00', 3, 15, NULL),
(10213, '2/I', '2/I C LINIJA 1 prepodne', '04:25:00', '08:05:00', '04:20:00', 3, 15, 'null'),
(10223, '2/II', '2/II C LINIJA 16 POSLEPODNE', '12:10:00', '16:45:00', '04:35:00', 3, 15, NULL),
(10233, '2/III', '2/III C LINIJA 1 POSLEPODNE-UVE?E', '14:25:00', '23:30:00', '09:05:00', 3, 15, NULL),
(10313, '3/I', '3/I C LINIJA 1 PREPODNE', '04:15:00', '10:30:00', '06:15:00', 3, 15, NULL),
(10413, '4/I', '4/I C LINIJA 1 PREPODNE', '04:50:00', '12:40:00', '07:50:00', 3, 15, NULL),
(10423, '4/II', '4/II C LINIJA 1 POSLEPODNE', '14:55:00', '21:30:00', '06:35:00', 3, 15, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `workplan`
--

CREATE TABLE IF NOT EXISTS `workplan` (
  `ID_Work` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Tour` int(11) NOT NULL,
  `ID_Driver` int(11) NOT NULL,
  `ID_Bus1` int(11) DEFAULT NULL,
  `ID_Bus2` int(11) DEFAULT NULL,
  `Date_Work` date NOT NULL,
  `Start_Time` time NOT NULL,
  `End_Time` time NOT NULL,
  `Total_Time` time NOT NULL,
  PRIMARY KEY (`ID_Work`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=183 ;

--
-- Dumping data for table `workplan`
--

INSERT INTO `workplan` (`ID_Work`, `ID_Tour`, `ID_Driver`, `ID_Bus1`, `ID_Bus2`, `Date_Work`, `Start_Time`, `End_Time`, `Total_Time`) VALUES
(1, 10113, 0, NULL, NULL, '0000-00-00', '04:50:00', '09:00:00', '04:10:00'),
(2, 10113, 100, NULL, NULL, '0000-00-00', '04:50:00', '09:00:00', '04:10:00'),
(3, 10113, 0, NULL, NULL, '2018-07-03', '04:50:00', '09:00:00', '04:10:00'),
(4, 10113, 0, NULL, NULL, '2018-07-02', '04:50:00', '09:00:00', '04:10:00'),
(5, 10113, 0, NULL, NULL, '2018-07-02', '04:50:00', '09:00:00', '04:10:00'),
(6, 10113, 100, NULL, NULL, '2018-07-04', '04:50:00', '09:00:00', '04:10:00'),
(7, 10113, 0, NULL, NULL, '2018-07-04', '04:50:00', '09:00:00', '04:10:00'),
(8, 10123, 0, NULL, NULL, '2018-07-04', '11:40:00', '16:25:00', '04:45:00'),
(9, 10133, 0, NULL, NULL, '2018-07-04', '14:40:00', '23:10:00', '08:30:00'),
(10, 10213, 0, NULL, NULL, '2018-07-04', '04:25:00', '08:05:00', '04:20:00'),
(11, 10223, 0, NULL, NULL, '2018-07-04', '12:10:00', '16:45:00', '04:35:00'),
(12, 10223, 0, NULL, NULL, '2018-07-04', '14:25:00', '23:30:00', '09:05:00'),
(13, 10313, 0, NULL, NULL, '2018-07-04', '04:15:00', '10:30:00', '06:15:00'),
(14, 10413, 0, NULL, NULL, '2018-07-04', '04:50:00', '12:40:00', '07:50:00'),
(15, 10423, 0, NULL, NULL, '2018-07-04', '14:55:00', '21:30:00', '06:35:00'),
(21, 10113, 0, NULL, NULL, '2018-07-09', '04:50:00', '09:00:00', '04:10:00'),
(22, 10113, 0, NULL, NULL, '2018-07-09', '04:50:00', '09:00:00', '04:10:00'),
(23, 10123, 0, NULL, NULL, '2018-07-09', '11:40:00', '16:25:00', '04:45:00'),
(24, 10133, 0, NULL, NULL, '2018-07-09', '14:40:00', '23:10:00', '08:30:00'),
(25, 10213, 0, NULL, NULL, '2018-07-09', '04:25:00', '08:05:00', '04:20:00'),
(26, 10223, 0, NULL, NULL, '2018-07-09', '12:10:00', '16:45:00', '04:35:00'),
(27, 10223, 0, NULL, NULL, '2018-07-09', '14:25:00', '23:30:00', '09:05:00'),
(28, 10313, 0, NULL, NULL, '2018-07-09', '04:15:00', '10:30:00', '06:15:00'),
(29, 10413, 0, NULL, NULL, '2018-07-09', '04:50:00', '12:40:00', '07:50:00'),
(30, 10423, 0, NULL, NULL, '2018-07-09', '14:55:00', '21:30:00', '06:35:00'),
(36, 10113, 0, NULL, NULL, '2018-07-25', '04:50:00', '09:00:00', '04:10:00'),
(37, 10113, 100, NULL, NULL, '2018-07-25', '04:50:00', '09:00:00', '04:10:00'),
(38, 10123, 0, 102, NULL, '2018-07-25', '11:40:00', '16:25:00', '04:45:00'),
(39, 10133, 100, NULL, NULL, '2018-07-25', '14:40:00', '23:10:00', '08:30:00'),
(40, 10213, 0, 6, NULL, '2018-07-25', '04:25:00', '08:05:00', '04:20:00'),
(41, 10223, 102, NULL, NULL, '2018-07-25', '12:10:00', '16:45:00', '04:35:00'),
(42, 10223, 0, NULL, NULL, '2018-07-25', '14:25:00', '23:30:00', '09:05:00'),
(43, 10313, 0, NULL, NULL, '2018-07-25', '04:15:00', '10:30:00', '06:15:00'),
(44, 10413, 0, NULL, NULL, '2018-07-25', '04:50:00', '12:40:00', '07:50:00'),
(45, 10423, 0, NULL, NULL, '2018-07-25', '14:55:00', '21:30:00', '06:35:00'),
(51, 10113, 0, NULL, NULL, '2018-07-16', '04:50:00', '09:00:00', '04:10:00'),
(52, 10113, 0, NULL, NULL, '2018-07-16', '04:50:00', '09:00:00', '04:10:00'),
(53, 10123, 0, NULL, NULL, '2018-07-16', '11:40:00', '16:25:00', '04:45:00'),
(54, 10133, 0, NULL, NULL, '2018-07-16', '14:40:00', '23:10:00', '08:30:00'),
(55, 10213, 0, NULL, NULL, '2018-07-16', '04:25:00', '08:05:00', '04:20:00'),
(56, 10223, 0, NULL, NULL, '2018-07-16', '12:10:00', '16:45:00', '04:35:00'),
(57, 10223, 0, NULL, NULL, '2018-07-16', '14:25:00', '23:30:00', '09:05:00'),
(58, 10313, 0, NULL, NULL, '2018-07-16', '04:15:00', '10:30:00', '06:15:00'),
(59, 10413, 0, NULL, NULL, '2018-07-16', '04:50:00', '12:40:00', '07:50:00'),
(60, 10423, 0, NULL, NULL, '2018-07-16', '14:55:00', '21:30:00', '06:35:00'),
(61, 10113, 0, NULL, NULL, '2018-08-27', '04:50:00', '09:00:00', '04:10:00'),
(62, 10113, 0, NULL, NULL, '2018-08-27', '04:50:00', '09:00:00', '04:10:00'),
(63, 10123, 0, NULL, NULL, '2018-08-27', '11:40:00', '16:25:00', '04:45:00'),
(64, 10133, 0, NULL, NULL, '2018-08-27', '14:40:00', '23:10:00', '08:30:00'),
(65, 10213, 0, NULL, NULL, '2018-08-27', '04:25:00', '08:05:00', '04:20:00'),
(66, 10223, 0, NULL, NULL, '2018-08-27', '12:10:00', '16:45:00', '04:35:00'),
(67, 10223, 0, NULL, NULL, '2018-08-27', '14:25:00', '23:30:00', '09:05:00'),
(68, 10313, 0, NULL, NULL, '2018-08-27', '04:15:00', '10:30:00', '06:15:00'),
(69, 10413, 0, NULL, NULL, '2018-08-27', '04:50:00', '12:40:00', '07:50:00'),
(70, 10423, 0, NULL, NULL, '2018-08-27', '14:55:00', '21:30:00', '06:35:00'),
(76, 10113, 0, NULL, NULL, '2018-08-27', '04:50:00', '09:00:00', '04:10:00'),
(77, 10113, 0, NULL, NULL, '2018-08-27', '04:50:00', '09:00:00', '04:10:00'),
(78, 10123, 0, NULL, NULL, '2018-08-27', '11:40:00', '16:25:00', '04:45:00'),
(79, 10133, 0, NULL, NULL, '2018-08-27', '14:40:00', '23:10:00', '08:30:00'),
(80, 10213, 0, NULL, NULL, '2018-08-27', '04:25:00', '08:05:00', '04:20:00'),
(81, 10223, 0, NULL, NULL, '2018-08-27', '12:10:00', '16:45:00', '04:35:00'),
(82, 10223, 0, NULL, NULL, '2018-08-27', '14:25:00', '23:30:00', '09:05:00'),
(83, 10313, 0, NULL, NULL, '2018-08-27', '04:15:00', '10:30:00', '06:15:00'),
(84, 10413, 0, NULL, NULL, '2018-08-27', '04:50:00', '12:40:00', '07:50:00'),
(85, 10423, 0, NULL, NULL, '2018-08-27', '14:55:00', '21:30:00', '06:35:00'),
(91, 10113, 102, 6, NULL, '2018-08-15', '04:50:00', '09:00:00', '04:10:00'),
(92, 10113, 0, 95, NULL, '2018-08-15', '04:50:00', '09:00:00', '04:10:00'),
(93, 10123, 102, 75, NULL, '2018-08-15', '11:40:00', '16:25:00', '04:45:00'),
(94, 10133, 0, 102, NULL, '2018-08-15', '14:40:00', '23:10:00', '08:30:00'),
(95, 10213, 0, 71, NULL, '2018-08-15', '04:25:00', '08:05:00', '04:20:00'),
(96, 10223, 0, NULL, NULL, '2018-08-15', '12:10:00', '16:45:00', '04:35:00'),
(97, 10223, 0, 6, NULL, '2018-08-15', '14:25:00', '23:30:00', '09:05:00'),
(98, 10313, 0, 102, NULL, '2018-08-15', '04:15:00', '10:30:00', '06:15:00'),
(99, 10413, 0, NULL, NULL, '2018-08-15', '04:50:00', '12:40:00', '07:50:00'),
(100, 10423, 0, NULL, NULL, '2018-08-15', '14:55:00', '21:30:00', '06:35:00'),
(101, 10113, 0, NULL, NULL, '2018-08-15', '04:50:00', '09:00:00', '04:10:00'),
(102, 10113, 0, NULL, NULL, '2018-08-15', '04:50:00', '09:00:00', '04:10:00'),
(103, 10123, 0, NULL, NULL, '2018-08-15', '11:40:00', '16:25:00', '04:45:00'),
(104, 10133, 0, NULL, NULL, '2018-08-15', '14:40:00', '23:10:00', '08:30:00'),
(105, 10213, 0, NULL, NULL, '2018-08-15', '04:25:00', '08:05:00', '04:20:00'),
(106, 10223, 0, NULL, NULL, '2018-08-15', '12:10:00', '16:45:00', '04:35:00'),
(107, 10223, 0, NULL, NULL, '2018-08-15', '14:25:00', '23:30:00', '09:05:00'),
(108, 10313, 0, NULL, NULL, '2018-08-15', '04:15:00', '10:30:00', '06:15:00'),
(109, 10413, 0, NULL, NULL, '2018-08-15', '04:50:00', '12:40:00', '07:50:00'),
(110, 10423, 0, NULL, NULL, '2018-08-15', '14:55:00', '21:30:00', '06:35:00'),
(122, 10113, 0, NULL, NULL, '2018-09-01', '04:50:00', '09:00:00', '04:10:00'),
(123, 10113, 0, NULL, NULL, '2018-09-01', '04:50:00', '09:00:00', '04:10:00'),
(124, 10123, 0, NULL, NULL, '2018-09-01', '11:40:00', '16:25:00', '04:45:00'),
(125, 10133, 0, NULL, NULL, '2018-09-01', '14:40:00', '23:10:00', '08:30:00'),
(126, 10213, 0, NULL, NULL, '2018-09-01', '04:25:00', '08:05:00', '04:20:00'),
(127, 10223, 0, NULL, NULL, '2018-09-01', '12:10:00', '16:45:00', '04:35:00'),
(128, 10223, 0, NULL, NULL, '2018-09-01', '14:25:00', '23:30:00', '09:05:00'),
(129, 10313, 0, NULL, NULL, '2018-09-01', '04:15:00', '10:30:00', '06:15:00'),
(130, 10413, 0, NULL, NULL, '2018-09-01', '04:50:00', '12:40:00', '07:50:00'),
(131, 10423, 0, NULL, NULL, '2018-09-01', '14:55:00', '21:30:00', '06:35:00'),
(132, 10113, 0, NULL, NULL, '2018-09-01', '04:50:00', '09:00:00', '04:10:00'),
(133, 10113, 0, NULL, NULL, '2018-09-01', '04:50:00', '09:00:00', '04:10:00'),
(134, 10123, 0, NULL, NULL, '2018-09-01', '11:40:00', '16:25:00', '04:45:00'),
(135, 10133, 0, NULL, NULL, '2018-09-01', '14:40:00', '23:10:00', '08:30:00'),
(136, 10213, 0, NULL, NULL, '2018-09-01', '04:25:00', '08:05:00', '04:20:00'),
(137, 10223, 0, NULL, NULL, '2018-09-01', '12:10:00', '16:45:00', '04:35:00'),
(138, 10223, 0, NULL, NULL, '2018-09-01', '14:25:00', '23:30:00', '09:05:00'),
(139, 10313, 0, NULL, NULL, '2018-09-01', '04:15:00', '10:30:00', '06:15:00'),
(140, 10413, 0, NULL, NULL, '2018-09-01', '04:50:00', '12:40:00', '07:50:00'),
(141, 10423, 0, NULL, NULL, '2018-09-01', '14:55:00', '21:30:00', '06:35:00'),
(153, 10113, 0, NULL, NULL, '2018-09-05', '04:50:00', '09:00:00', '04:10:00'),
(154, 10113, 0, NULL, NULL, '2018-09-05', '04:50:00', '09:00:00', '04:10:00'),
(155, 10123, 0, NULL, NULL, '2018-09-05', '11:40:00', '16:25:00', '04:45:00'),
(156, 10133, 0, NULL, NULL, '2018-09-05', '14:40:00', '23:10:00', '08:30:00'),
(157, 10213, 0, NULL, NULL, '2018-09-05', '04:25:00', '08:05:00', '04:20:00'),
(158, 10223, 0, NULL, NULL, '2018-09-05', '12:10:00', '16:45:00', '04:35:00'),
(159, 10223, 0, NULL, NULL, '2018-09-05', '14:25:00', '23:30:00', '09:05:00'),
(160, 10313, 0, NULL, NULL, '2018-09-05', '04:15:00', '10:30:00', '06:15:00'),
(161, 10413, 0, NULL, NULL, '2018-09-05', '04:50:00', '12:40:00', '07:50:00'),
(162, 10423, 0, NULL, NULL, '2018-09-05', '14:55:00', '21:30:00', '06:35:00'),
(168, 10113, 0, NULL, NULL, '2018-08-31', '04:50:00', '09:00:00', '04:10:00'),
(169, 10113, 0, NULL, NULL, '2018-08-31', '04:50:00', '09:00:00', '04:10:00'),
(170, 10123, 0, NULL, NULL, '2018-08-31', '11:40:00', '16:25:00', '04:45:00'),
(171, 10133, 0, NULL, NULL, '2018-08-31', '14:40:00', '23:10:00', '08:30:00'),
(172, 10213, 0, NULL, NULL, '2018-08-31', '04:25:00', '08:05:00', '04:20:00'),
(173, 10223, 0, NULL, NULL, '2018-08-31', '12:10:00', '16:45:00', '04:35:00'),
(174, 10223, 0, NULL, NULL, '2018-08-31', '14:25:00', '23:30:00', '09:05:00'),
(175, 10313, 0, NULL, NULL, '2018-08-31', '04:15:00', '10:30:00', '06:15:00'),
(176, 10413, 0, NULL, NULL, '2018-08-31', '04:50:00', '12:40:00', '07:50:00'),
(177, 10423, 0, NULL, NULL, '2018-08-31', '14:55:00', '21:30:00', '06:35:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
