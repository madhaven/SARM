-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2019 at 08:10 PM
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
(1, 'jitinjitin'),
(2, 'jeenajeena'),
(6, 'Asdf@123'),
(7, 'ajualexajualex'),
(8, 'test1test1'),
(9, 'test2test2'),
(10, 'test3test3'),
(11, 'test5test5'),
(12, 'test6test6'),
(13, 'test7test7'),
(14, 'test8test8'),
(15, 'test9test9'),
(16, 'test0test0'),
(17, 'testtest');

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
(1, 1, 'clothes', 'clothes', 'size XL', 5, 'pieces', 'hotel', '0000-00-00 00:00:00', 1);

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
(1, 1, 'something', 'food', 'hot and warm', 5, 'plates', 'home', '2019-11-08 03:23:00', 1),
(2, 7, 'Food', 'Bread and Butter', 'Something', 60, 'Piece', 'Malanadu', '2019-11-30 14:50:00', 1),
(3, 1, 'Clothes dresses', 'clothes', 'Size XL', 10, 'shirts', 'home', '2019-02-03 15:02:00', 1),
(4, 1, 'cars wheels transport', 'Transportation', 'transport on 4 wheeler. Big wheels petrol cars. Reach wherever you want no matter what the issue is.', 5, 'vehicles', 'punjab', '2020-03-03 01:59:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `dp` varchar(50) NOT NULL DEFAULT 'source/dp.jpg',
  `permissions` int(2) NOT NULL DEFAULT 0,
  `authorizedby` int(100) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `phone`, `username`, `dp`, `permissions`, `authorizedby`) VALUES
(1, 'jitin@gmail.com', '8943432729', 'jitin', 'dp/IMG_20160421_00322920191117195840.jpg', 1, 1),
(2, 'jeena@gmail.com', '9843949323', 'jeena', 'source/dp.jpg', 1, 1),
(7, 'ajualex@gmail.com', '8129322316', 'aju_alx', 'dp/20190911_13071920191119071650.jpg', 1, 1),
(8, 'test@gmail.lom', '8932321719', 'test1', '0', 0, 1),
(9, 'test2@gmail.com', '8943432729', 'test2', '0', 0, 1),
(10, 'test3@gmail.com', '8943432729', 'test3', '0', 0, 0),
(11, 'test5@gmail.com', '8943432729', 'test5', '0', 0, 0),
(12, 'test6@gmail.com', '8943432729', 'test6', '0', 0, 0),
(13, 'test7@gmail.com', '8943432729', 'test7', '0', 0, 0),
(14, 'test8@gmail.com', '8943432729', 'test8', '0', 0, 0),
(15, 'test9@gmail.com', '8943432729', 'test9', '0', 0, 0),
(16, 'test0@gmail.com', '8943432729', 'test0', '0', 0, 1),
(17, 'test@gmail.com', '8943432729', 'test', '0', 0, 1);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supply`
--
ALTER TABLE `supply`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
