-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 23, 2017 at 09:36 PM
-- Server version: 5.5.55-0+deb8u1
-- PHP Version: 5.6.30-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zavrsni`
--

-- --------------------------------------------------------

--
-- Table structure for table `button`
--

CREATE TABLE IF NOT EXISTS `button` (
  `d4` smallint(6) NOT NULL,
  `d5` smallint(6) NOT NULL,
  `d6` smallint(6) NOT NULL,
  `d7` smallint(6) NOT NULL,
  `d8` smallint(6) NOT NULL,
  `pwm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `button`
--

INSERT INTO `button` (`d4`, `d5`, `d6`, `d7`, `d8`, `pwm`) VALUES
(0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tempLog`
--

CREATE TABLE IF NOT EXISTS `tempLog` (
  `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `temperature` float NOT NULL,
  `light` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tempLog`
--

INSERT INTO `tempLog` (`timeStamp`, `temperature`, `light`) VALUES
('2017-01-27 23:07:20', 22.95, 23),
('2017-01-27 23:22:20', 22.95, 24),
('2017-01-27 23:42:09', 22.95, 24);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tempLog`
--
ALTER TABLE `tempLog`
 ADD PRIMARY KEY (`timeStamp`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
