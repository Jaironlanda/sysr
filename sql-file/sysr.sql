-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 04, 2021 at 08:02 AM
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
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `report_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `datetime_created` datetime NOT NULL,
  `datetime_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` longtext NOT NULL,
  `report_type_id` int(11) NOT NULL,
  `reporter_id` int(11) NOT NULL,
  `datetime_created` datetime NOT NULL,
  `datetime_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reportType`
--

CREATE TABLE `reportType` (
  `type_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `datetime_created` datetime NOT NULL,
  `datetime_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reportType`
--

INSERT INTO `reportType` (`type_id`, `name`, `datetime_created`, `datetime_updated`) VALUES
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

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_lvl` int(11) NOT NULL DEFAULT 1,
  `email` varchar(265) NOT NULL,
  `fullname` text NOT NULL,
  `pswd` varchar(265) NOT NULL,
  `datetime_created` datetime NOT NULL,
  `datetime_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_lvl`, `email`, `fullname`, `pswd`, `datetime_created`, `datetime_updated`) VALUES
(1, 2, 'admin@sysr.com', 'Administrator', '$2y$10$HpZwydPg9NRki3tp7Q/v7.wJwL/4wjEu/4FG3fgJ6Fea0d0oBFPQG', '2021-12-04 08:00:39', '2021-12-04 15:00:40'),
(2, 1, 'jaironlanda@gmail.com', 'Jairon Landa', '$2y$10$A5XuRL8D2ehId9nq5HlHOecBhdpci8a9HlxJkChyWcNKqZO.En98u', '2021-12-04 08:01:09', '2021-12-04 15:01:09'),
(3, 1, 'jaypark@gmail.com', 'Jaypark', '$2y$10$BbrXlerdqXsxOm.fuFGRverI9jBZbFi6YbHYQXctkNelC//yaGnnq', '2021-12-04 08:01:42', '2021-12-04 15:01:42'),
(4, 1, 'nizamjitai@gmail.com', 'Nizam Jitai', '$2y$10$IJBRsBgQ2.Q8HNu0uNDcGO24BHNX9KcnfwPnZCnFJUNdrf/.JZhPW', '2021-12-04 08:02:08', '2021-12-04 15:02:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `reportType`
--
ALTER TABLE `reportType`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reportType`
--
ALTER TABLE `reportType`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
