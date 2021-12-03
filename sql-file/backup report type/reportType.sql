-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 03, 2021 at 02:27 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sysr`
--

-- --------------------------------------------------------

--
-- Table structure for table `reportType`
--

CREATE TABLE `reportType` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `datetime_created` datetime NOT NULL,
  `datetime_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reportType`
--

INSERT INTO `reportType` (`id`, `name`, `datetime_created`, `datetime_updated`) VALUES
(1, 'Sedition', '2021-11-26 18:22:48', '2021-11-27 01:27:11'),
(2, 'Threats to National Security', '2021-11-26 18:22:48', '2021-11-27 01:27:11'),
(3, 'Fraud/Finance/Trade', '2021-11-26 18:22:48', '2021-11-27 01:27:11'),
(4, 'Copyright', '2021-11-26 18:22:48', '2021-11-27 01:27:11'),
(5, 'Defamation ', '2021-11-26 18:22:48', '2021-11-27 01:27:11'),
(6, 'Insulting the Religion', '2021-11-26 18:22:48', '2021-11-27 01:27:11'),
(7, 'Immoral/Indecent/\r\nOffensive/Fraud', '2021-11-26 18:22:48', '2021-11-27 01:27:11'),
(8, 'Identity Theft', '2021-11-26 18:22:48', '2021-11-27 01:27:11'),
(9, 'Medicines Advertisement/ Sale', '2021-11-26 18:22:48', '2021-11-27 01:27:11'),
(10, 'Distribution of destructive weapons', '2021-11-26 18:22:48', '2021-11-27 01:27:11'),
(11, 'Gaming/Betting', '2021-11-26 18:22:48', '2021-11-27 01:27:11'),
(12, 'Threats to life/property', '2021-11-26 18:22:48', '2021-11-27 01:27:11'),
(13, 'Hacking', '2021-11-26 18:27:45', '2021-11-27 01:28:00'),
(14, 'Personal Data Usage', '2021-11-26 18:27:45', '2021-11-27 01:28:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reportType`
--
ALTER TABLE `reportType`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reportType`
--
ALTER TABLE `reportType`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
