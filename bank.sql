-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2020 at 08:28 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `transfer_record`
--

CREATE TABLE `transfer_record` (
  `id` int(11) NOT NULL,
  `from_user` varchar(255) NOT NULL,
  `to_user` varchar(255) NOT NULL,
  `credit` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transfer_record`
--

INSERT INTO `transfer_record` (`id`, `from_user`, `to_user`, `credit`, `datetime`) VALUES
(1, 'Manish', 'Riyanka', 50, '2020-12-07 18:22:20'),
(2, 'Kinjal', 'Riyanka', 100, '2020-12-07 19:21:33'),
(3, 'Ashish', 'Ayush', 100, '2020-12-07 19:48:53'),
(4, 'Pankaj', 'Ayush', 150, '2020-12-07 19:51:06'),
(5, 'Nidhi', 'Riyanka', 50, '2020-12-07 19:54:12');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `credit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `credit`) VALUES
(1, 'Riyanka', 'riya@yahoo.com', 400),
(2, 'Ayush', 'ayu@gmail.com', 350),
(3, 'Kush', 'kush@gmail.com', 300),
(4, 'Dharmi', '', 500),
(5, 'Manish', 'manish@yahoo.com', 950),
(6, 'Parth', 'parth@gmail.com', 1000),
(7, 'Kinjal', '', 900),
(8, 'Ashish', 'ashish@yahoo.com', 900),
(9, 'Nidhi', 'nidhi@gmail.com', 950),
(10, 'Pankaj', 'pankaj@gmail.com', 850);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transfer_record`
--
ALTER TABLE `transfer_record`
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
-- AUTO_INCREMENT for table `transfer_record`
--
ALTER TABLE `transfer_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
