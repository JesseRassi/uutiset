-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2020 at 09:47 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobbaripojat`
--

-- --------------------------------------------------------

--
-- Table structure for table `uutiset`
--

CREATE TABLE `uutiset` (
  `id` int(11) NOT NULL,
  `pvm` datetime NOT NULL,
  `avainsana0` varchar(50) DEFAULT NULL,
  `avainsana1` varchar(50) DEFAULT NULL,
  `avainsana2` varchar(50) DEFAULT NULL,
  `avainsana3` varchar(50) DEFAULT NULL,
  `avainsana4` varchar(50) DEFAULT NULL,
  `uutiset` tinyint(1) NOT NULL DEFAULT 0,
  `kotimaa` tinyint(1) NOT NULL DEFAULT 0,
  `ulkomaat` tinyint(1) NOT NULL DEFAULT 0,
  `politiikka` tinyint(1) NOT NULL DEFAULT 0,
  `talous` tinyint(1) NOT NULL DEFAULT 0,
  `urheilu` tinyint(1) NOT NULL DEFAULT 0,
  `viihde` tinyint(1) NOT NULL DEFAULT 0,
  `terveys` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uutiset`
--

INSERT INTO `uutiset` (`id`, `pvm`, `avainsana0`, `avainsana1`, `avainsana2`, `avainsana3`, `avainsana4`, `uutiset`, `kotimaa`, `ulkomaat`, `politiikka`, `talous`, `urheilu`, `viihde`, `terveys`) VALUES
(2, '2020-02-29 04:02:36', 'sd', 'sdf', 'dsf', 'vx', 'df', 1, 0, 0, 0, 0, 0, 1, 1),
(5, '2020-03-01 04:48:53', 'a', 'b', 'c', 'd', 'e', 0, 0, 0, 0, 0, 1, 0, 0),
(7, '2020-03-05 07:42:47', 'dkjf', 'kljsfic', 'ijsvijd', 'jsdfj', 'c', 0, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `yllapito`
--

CREATE TABLE `yllapito` (
  `id` int(11) NOT NULL,
  `kayttaja` varchar(20) NOT NULL,
  `salasana` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `yllapito`
--

INSERT INTO `yllapito` (`id`, `kayttaja`, `salasana`) VALUES
(5, 'admin', '$2y$10$DJ3RC9lfP76bnJF21zdsHOgnldyJmszJhbJhgAXWXmEr2yXLwT0jG'),
(6, 'testi', '$2y$10$DJg0i0C1UDuk5JoKZIiesu5kyUdhJzxU.bkBs7kgzGTqZBUcvyJA2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `uutiset`
--
ALTER TABLE `uutiset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yllapito`
--
ALTER TABLE `yllapito`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `yllapito`
--
ALTER TABLE `yllapito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
