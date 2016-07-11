-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 11, 2016 at 05:44 PM
-- Server version: 5.7.12-0ubuntu1.1
-- PHP Version: 7.0.4-7ubuntu2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `callCustomizer`
--

-- --------------------------------------------------------

--
-- Table structure for table `CustomNumbers`
--

CREATE TABLE `CustomNumbers` (
  `id` int(11) NOT NULL,
  `email` varchar(55) NOT NULL,
  `name` varchar(25) NOT NULL,
  `customNumber` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CustomNumbers`
--

INSERT INTO `CustomNumbers` (`id`, `email`, `name`, `customNumber`) VALUES
(2, 'pawansinghchouhan05@gmail.com', 'sunny', 54321),
(3, 'pawansinghchouhan05@gmail.com', 'sunny', 1264864684);

-- --------------------------------------------------------

--
-- Table structure for table `Tokens`
--

CREATE TABLE `Tokens` (
  `id` int(11) NOT NULL,
  `email` varchar(55) NOT NULL,
  `token` varchar(200) NOT NULL,
  `updated_at` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Tokens`
--

INSERT INTO `Tokens` (`id`, `email`, `token`, `updated_at`) VALUES
(1, 'pawansinghchouhan05@gmail.com', 'sd', 12345678);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(45) NOT NULL,
  `loginType` varchar(20) NOT NULL,
  `created_at` double NOT NULL,
  `updated_at` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `name`, `email`, `password`, `loginType`, `created_at`, `updated_at`) VALUES
(1, 'pawan', 'pawansinghchouhan05@gmail.com', '12345678', 'android', 122311545, 164896413);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CustomNumbers`
--
ALTER TABLE `CustomNumbers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Tokens`
--
ALTER TABLE `Tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `CustomNumbers`
--
ALTER TABLE `CustomNumbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Tokens`
--
ALTER TABLE `Tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
