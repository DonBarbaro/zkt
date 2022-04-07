-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2021 at 03:58 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `register`
--
DROP TABLE IF EXISTS 'rodina';
-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `rodina` (
  `id` int(10) NOT NULL,
  `firstname` varchar(20) COLLATE utf8_slovak_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_slovak_ci NOT NULL,
  `age` int(99) NOT NULL,
  `family` varchar(20) COLLATE utf8_slovak_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `rodina` (`id`, `firstname`, `lastname`, `age`, `family`) VALUES
(1, 'Jozef', 'Mrkvicka', 39, 'Dedo'),
(2, 'Noro ', 'Mojsej', 70, 'syn'),
(3, 'Mariana', 'Orincakova', 31, 'Teta');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `register`
--
ALTER TABLE `rodina`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `rodina`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
