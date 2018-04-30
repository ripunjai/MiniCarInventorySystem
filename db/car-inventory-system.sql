-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 29, 2018 at 06:47 PM
-- Server version: 5.7.19
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car-inventory-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_full_name` varchar(250) NOT NULL,
  `admin_contact` int(10) NOT NULL,
  `admin_adr` varchar(255) NOT NULL,
  `admin_doc` varchar(255) NOT NULL,
  `admin_email` varchar(250) NOT NULL,
  `admin_password` varchar(250) NOT NULL,
  `admin_menu` varchar(250) NOT NULL,
  `admin_status` enum('Active','Inactive') DEFAULT NULL,
  `admin_created_date` datetime NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_full_name`, `admin_contact`, `admin_adr`, `admin_doc`, `admin_email`, `admin_password`, `admin_menu`, `admin_status`, `admin_created_date`) VALUES
(2, 'Super Admin', 91, 'dadar', '', 'test@gmail.com', '123', 'Dashboard', 'Active', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE IF NOT EXISTS `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `color` varchar(20) DEFAULT NULL,
  `manufacturing_year` int(4) DEFAULT NULL,
  `registration_number` varchar(30) DEFAULT NULL,
  `note` text,
  `img1` varchar(50) DEFAULT NULL,
  `img2` varchar(50) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `deleted_flag` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `manufacturer_id` (`manufacturer_id`),
  KEY `model_id` (`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `manufacturer_id`, `model_id`, `color`, `manufacturing_year`, `registration_number`, `note`, `img1`, `img2`, `created_date`, `created_by`, `update_date`, `update_by`, `deleted_flag`) VALUES
(2, 1, 1, 'sdfs', 2015, 'sdf', 'sdfsdf', '1525013871488.jpg', '3050027742978.jpg', '2018-04-29 14:57:51', NULL, NULL, NULL, 0),
(3, 1, 1, 'red', 2018, 'sdfds34535', 'fdgdfgdfg', NULL, NULL, '2018-04-29 15:31:27', NULL, NULL, NULL, 0),
(4, 1, 2, 'dfgdfg', 2006, 'ghfg4567', 'gfhfgh', '', '', '2018-04-29 18:32:56', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

DROP TABLE IF EXISTS `manufacturer`;
CREATE TABLE IF NOT EXISTS `manufacturer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `deleted_flag` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`id`, `name`, `created_date`, `created_by`, `update_date`, `update_by`, `deleted_flag`) VALUES
(1, 'Maruti', '2018-04-29 11:35:37', NULL, NULL, NULL, 0),
(2, 'Tata', '2018-04-29 11:35:41', NULL, NULL, NULL, 0),
(3, 'asdasd', '2018-04-29 11:39:20', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

DROP TABLE IF EXISTS `model`;
CREATE TABLE IF NOT EXISTS `model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `deleted_flag` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `manufacturer_id` (`manufacturer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id`, `manufacturer_id`, `name`, `created_date`, `created_by`, `update_date`, `update_by`, `deleted_flag`) VALUES
(1, 1, 'WagonR', '2018-04-29 12:03:34', NULL, NULL, NULL, 0),
(2, 1, 'Maruti800', '2018-04-29 13:48:06', NULL, NULL, NULL, 0),
(3, 1, 'Maruti500', '2018-04-29 18:46:37', NULL, NULL, NULL, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model`
--
ALTER TABLE `model`
  ADD CONSTRAINT `model_ibfk_1` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
