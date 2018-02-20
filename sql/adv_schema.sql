-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2017 at 04:13 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ims2`
--

-- --------------------------------------------------------

--
-- Table structure for table `adv_schema`
--

CREATE TABLE `adv_schema` (
  `advNum` int(11) NOT NULL,
  `itemName` varchar(255) NOT NULL,
  `advDescription` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adv_schema`
--

INSERT INTO `adv_schema` (`advNum`, `itemName`, `advDescription`) VALUES
(2, 'frankfurter', 'asdasd'),
(3, 'roll products', 'zxczxcxc'),
(4, 'chocolate', 'Hello\r\nCustomer\r\nSCHEME SCHEME SCHEME'),
(5, 'pasta', ''),
(6, 'sugar', 'sd,mf smd,fn s,md f,msd f');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adv_schema`
--
ALTER TABLE `adv_schema`
  ADD PRIMARY KEY (`advNum`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adv_schema`
--
ALTER TABLE `adv_schema`
  MODIFY `advNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
