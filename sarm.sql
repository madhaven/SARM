-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2019 at 06:34 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sarm`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `uid` int(10) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`uid`, `password`) VALUES
(1, 'jitinjitin');

-- --------------------------------------------------------

--
-- Table structure for table `require`
--

CREATE TABLE `require` (
  `id` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `tags` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `details` varchar(500) NOT NULL,
  `number` int(10) NOT NULL,
  `units` varchar(20) NOT NULL,
  `location` varchar(50) NOT NULL,
  `expiry` datetime NOT NULL,
  `status` int(5) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `require`
--

INSERT INTO `require` (`id`, `uid`, `tags`, `name`, `details`, `number`, `units`, `location`, `expiry`, `status`) VALUES
(1, 1, 'some more shit', 'shit', 'it\'s really smelly', 2, 'piece', 'closet', '2019-11-15 00:32:00', 1),
(2, 1, 'mangaa', 'mangappazhama', 'pazhuthath mathi', 1, 'kashnam', 'marathinte moottil', '2019-11-22 02:21:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supply`
--

CREATE TABLE `supply` (
  `id` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `tags` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `details` varchar(500) NOT NULL,
  `number` int(10) NOT NULL,
  `units` varchar(20) NOT NULL,
  `location` varchar(50) NOT NULL,
  `expiry` datetime NOT NULL,
  `status` int(5) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supply`
--

INSERT INTO `supply` (`id`, `uid`, `tags`, `name`, `details`, `number`, `units`, `location`, `expiry`, `status`) VALUES
(1, 1, 'some shit', 'shit', 'it\'s smelly', 2, 'pieces', 'closet', '2019-11-13 14:03:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `permissions` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `phone`, `username`, `permissions`) VALUES
(1, 'jitinjg@gmail.com', '8943432840', 'jitin', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `require`
--
ALTER TABLE `require`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supply`
--
ALTER TABLE `supply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `require`
--
ALTER TABLE `require`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supply`
--
ALTER TABLE `supply`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
