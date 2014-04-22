-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 22, 2014 at 09:45 AM
-- Server version: 5.5.35-0ubuntu0.13.10.2
-- PHP Version: 5.5.3-1ubuntu2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `projet`
--

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('4igte9c021jc2g5uevo6ilh8h6', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/33.0.1750.152 Chrome/33.0.1750.152 ', 1398162632, 's:0:"";'),
('ngpacs28ivpjrmkqbmp2u3kk65', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0', 1398174295, 's:0:"";');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` varchar(40) NOT NULL,
  `admin` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `admin`) VALUES
(1, ':username', ':password', 0),
(2, ':username', ':password', 0),
(3, 'skander', 'NzAyNDA0Mw==', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

DROP TABLE IF EXISTS `user_data`;
CREATE TABLE IF NOT EXISTS `user_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(256) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `password` varchar(40) NOT NULL,
  `admin` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `email` (`email`(255)),
  KEY `username` (`user_name`),
  KEY `admin` (`admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id`, `email`, `first_name`, `last_name`, `user_name`, `password`, `admin`) VALUES
(3, 'jabouzi@gmail.com', 'Skander', 'Jabouzi', 'skander', 'NzAyNDA0Mw==', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
CREATE TABLE IF NOT EXISTS `user_info` (
  `user_name` varchar(30) NOT NULL,
  `user_password` varchar(20) NOT NULL,
  `user_group` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_name`, `user_password`, `user_group`) VALUES
('hugo', 'Rel5JPw8HdjTU', NULL),
('philippe', 'Re9nTijnSO6X6', NULL),
('simon', 'VFKN7238rygpc', NULL),
('skander', 'af5NbgJW0KJbE', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_vhost`
--

DROP TABLE IF EXISTS `user_vhost`;
CREATE TABLE IF NOT EXISTS `user_vhost` (
  `user_name` varchar(30) NOT NULL,
  `user_vhost` varchar(50) NOT NULL,
  PRIMARY KEY (`user_name`,`user_vhost`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_vhost`
--

INSERT INTO `user_vhost` (`user_name`, `user_vhost`) VALUES
('hugo', '*'),
('philippe', '*'),
('simon', '*'),
('skander', '*');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_vhost`
--
ALTER TABLE `user_vhost`
  ADD CONSTRAINT `user_vhost_ibfk_1` FOREIGN KEY (`user_name`) REFERENCES `user_info` (`user_name`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
