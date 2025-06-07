-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2018 at 08:36 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta18_reg`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `event_type` enum('0','1') NOT NULL,
  `min_members` int(11) NOT NULL,
  `max_members` int(11) NOT NULL,
  `fees` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `event_type`, `min_members`, `max_members`, `fees`) VALUES
(1, 'Auto Cad', '0', 1, 2, 100),
(2, 'Lathe War', '0', 1, 2, 100),
(3, 'Rubic Cube', '0', 1, 1, 100),
(4, 'Technical Circuit Art', '0', 1, 2, 100),
(5, 'Electro Zest', '0', 1, 2, 100),
(6, 'Electra', '0', 1, 2, 100),
(7, 'Automation Zone', '0', 1, 2, 100),
(8, 'Poster Presentation', '0', 1, 2, 100),
(9, 'Bollymania', '0', 1, 2, 100),
(10, 'Mini MIlitia', '0', 1, 1, 80),
(11, 'Layout Marking', '0', 3, 4, 100),
(12, 'Bridge It', '0', 3, 5, 100),
(13, 'Code-a-thon', '0', 1, 1, 100),
(14, 'Google-it', '0', 1, 1, 100),
(15, 'Lan Wars', '0', 1, 4, 100),
(16, 'Circuit Frenzy', '0', 1, 2, 100),
(17, 'Math Fab', '0', 1, 2, 100),
(18, 'Beat the clock', '0', 1, 2, 100),
(19, 'Box cricket', '1', 8, 8, 800),
(20, 'Futsal', '1', 6, 10, 1000),
(21, 'Chess', '0', 1, 1, 100),
(22, 'Installation', '1', 4, 4, 400),
(23, 'Robo Race', '1', 1, 3, 400),
(24, 'Twin Robo Maze', '1', 1, 3, 400),
(25, 'Circular Gate Maze', '1', 1, 2, 300),
(26, 'Internet of Things with RasPi', '0', 1, 1, 650),
(27, 'Advanced Automotive Mechanics', '0', 1, 1, 650),
(28, 'Artificial Intelligence and Machine Learning', '0', 1, 1, 650),
(29, 'RC Olympia', '1', 1, 2, 200),
(30, 'Robo Wrangle', '1', 1, 2, 200);

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `reg_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `ta_id` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `clg_name` varchar(150) NOT NULL,
  `event_id` int(11) NOT NULL,
  `nop` int(11) NOT NULL,
  `mob_no` varchar(11) NOT NULL,
  `fees_paid` int(11) NOT NULL,
  `registered_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin_role` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `admin_role`) VALUES
(1, 'ADMIN', 'admin@ta18.gcoej.ac.in', '$2y$10$2vGAzZcbKZapW7dBcYcX9e9Cifr2FkuriYIvi0dw9BL0FU3fR53mC', 1),
(6, 'RST', 'rishabh.s.thakur.1996@gmail.com', '$2y$10$kK8rNF32B4BaZ08r4DxepuTQnKh8TenDN4l4BQRofAdoYU7zjSDey', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`reg_id`,`name`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ta_id` (`ta_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `participants_ibfk_1` FOREIGN KEY (`reg_id`) REFERENCES `registration` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
