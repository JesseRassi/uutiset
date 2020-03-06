-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 06, 2020 at 10:21 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.12

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
(3, '2020-02-29 04:04:22', 'sd', 'sdf', 'dsf', 'c', 'df', 1, 0, 0, 0, 0, 0, 1, 1),
(4, '2020-03-01 03:06:51', 'c', 'b', 'a', 'd', 'e', 0, 0, 0, 1, 0, 1, 0, 0),
(5, '2020-03-01 04:48:53', 'a', 'b', 'c', 'd', 'e', 0, 0, 0, 0, 0, 1, 0, 0),
(6, '2020-03-05 06:41:30', 'a', 'c', 'b', 'd', 'e', 0, 0, 0, 0, 0, 1, 0, 0),
(7, '2020-03-05 07:42:47', 'dkjf', 'kljsfic', 'ijsvijd', 'jsdfj', 'c', 0, 1, 1, 1, 1, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `uutiset`
--
ALTER TABLE `uutiset`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
