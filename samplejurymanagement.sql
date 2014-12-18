-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2014 at 12:26 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `samplejurymanagement`
--
USE 937736_samplejurymanagement;

-- --------------------------------------------------------

--
-- Table structure for table `juries`
--

CREATE TABLE IF NOT EXISTS `juries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Country` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `TotalVotedApps` int(11) DEFAULT NULL,
  `Enabled` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `juries`
--

INSERT INTO `juries` (`id`, `FirstName`, `LastName`, `Email`, `Country`, `TotalVotedApps`, `Enabled`, `created_at`, `updated_at`) VALUES
(3, 'Aadish', 'Surana', 'aadish@instani.com.au', 'India', NULL, 1, '2014-11-17 17:31:30', '2014-11-17 17:31:30'),
(4, 'Yoghesh', 'Patel', 'yogesh@instani.com.au', 'India', NULL, 1, '2014-11-17 17:51:55', '2014-11-18 02:20:22'),
(5, 'Jawad', 'Khan', 'jawad@instani.com.au', 'Pakistan', NULL, 1, '2014-11-17 18:00:23', '2014-11-17 18:00:23'),
(6, 'Afzal', 'Ahmad', 'afzal@instani.com', 'Hong Kong', NULL, 1, '2014-11-17 18:24:06', '2014-11-18 01:24:02'),
(7, 'Karen', 'Kwun', 'karen@instani.com.au', 'Hong Kong', NULL, 1, '2014-11-17 19:10:04', '2014-11-17 19:10:04'),
(9, 'Minh Tien', 'Nguyen', 'minhtien.swin@gmail.com', 'Vietnam', NULL, 0, '2014-11-17 19:34:25', '2014-11-18 02:01:21'),
(11, 'Damian', 'Lilliard', 'damian@gmail.com', 'USA', NULL, 1, '2014-11-17 19:42:58', '2014-11-17 19:42:58'),
(12, 'Nguyen', 'Le Toai', 'nguyen.lt@gmail.com', 'Hong Kong', NULL, 1, '2014-11-18 01:21:13', '2014-11-18 01:21:13'),
(13, 'Jason', 'Kapono', 'j.kapono@gmail.com', 'USA', NULL, 1, '2014-11-18 02:10:58', '2014-11-18 02:10:58'),
(14, 'Phuc', 'Hong Pham', 'phuc.swin@gmail.com', 'Vietnam', NULL, 0, '2014-11-18 12:44:45', '2014-11-18 12:44:57'),
(15, 'Yogi', 'Patel', 'yogesh@instani.com.au', 'China', NULL, 1, '2014-11-18 12:47:01', '2014-11-18 12:47:01'),
(17, 'Dat', 'Do Thanh Vu', 'datvu.swin@gmail.com', 'Vietnam', NULL, 1, '2014-11-18 15:36:50', '2014-11-18 15:36:50');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_11_18_005530_create_juries_table', 1),
('2014_11_18_022037_add_jury_to_juries_table', 2),
('2014_11_18_123208_add_enabled_to_juries_table', 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
