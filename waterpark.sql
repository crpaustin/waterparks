-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2014 at 07:58 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `waterpark`
--

-- --------------------------------------------------------

--
-- Table structure for table `parks`
--

CREATE TABLE IF NOT EXISTS `parks` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zip` int(5) NOT NULL,
  `city` varchar(63) NOT NULL,
  `state` varchar(2) NOT NULL,
  `website` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `parks`
--

INSERT INTO `parks` (`id`, `name`, `address`, `zip`, `city`, `state`, `website`, `image`, `active`) VALUES
(1, 'Splash Country', '2700 Dollywood Parks Blvd.', 37863, 'Pigeon Forge', 'TN', 'http://www.dollywood.com/waterpark.aspx', '', 1),
(2, 'Water Park 2', '111 Random Road', 12345, 'Somewhere', 'FL', 'http://www.waterpark2.com', '', 0),
(3, 'Wilderness at the Smokies', '555 Somewhere Drive', 77677, 'Randomplace', 'NC', 'http://www.wildernessatthesmokies.com', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parks`
--
ALTER TABLE `parks`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `parks`
--
ALTER TABLE `parks`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
