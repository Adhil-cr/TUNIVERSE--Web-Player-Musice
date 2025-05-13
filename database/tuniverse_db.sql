-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2025 at 05:43 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tuniverse_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `liked_songs`
--

CREATE TABLE `liked_songs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `song_name` varchar(255) NOT NULL,
  `liked_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `liked_songs`
--

INSERT INTO `liked_songs` (`id`, `user_id`, `song_name`, `liked_at`) VALUES
(12, 1, 'All Girls Are The Same - Juice WRLD', '2025-03-18 16:47:47'),
(13, 1, 'Valakilukana kunjoolee - Kalabavan Mani', '2025-03-18 16:56:04'),
(14, 1, 'Chandanamani sandhyakaludee - MG Sreekumar', '2025-03-18 17:00:30'),
(21, 1, 'Oru Kathilola - M. G. Sreekumar', '2025-03-19 18:06:10'),
(22, 1, 'Manwa Laage - Shreya Ghoshal ', '2025-03-19 18:08:38'),
(24, 1, 'Let Her Go x Husn - Grevero Mashup', '2025-03-19 18:14:15'),
(26, 1, '𝘬𝘰𝘥𝘪 𝘢𝘳𝘶𝘷i - Pradeep Kumar', '2025-03-20 06:15:45'),
(27, 2, 'Kannane karimukil ambarane - Haricharan, Seshadri & Divya S Menon', '2025-03-20 06:21:45'),
(28, 2, 'Ajitha Hare - Gouri Lakshmi', '2025-03-20 06:22:01');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`email`, `password`, `username`, `ID`) VALUES
('muhammedadhil639@gmail.com', '$2y$10$DZ8cM0iDHtQv22PIdnU2uu1bbBS.bvuhJZfWd77g.gKncny5niKFK', 'Adhilcr', 1),
('krishnapriyaps447@gmail.com', '$2y$10$zWijCTchluqmr6LE89KEu.UdJXar9Tv9JvUI4tKLKWFUncSWJlNE6', 'Krishna', 2),
('karthikasajeev@gmail.com', '$2y$10$8ilLFJJ5HRm1HeLo4ZMN3.dw9xjlcnkKFl811rDegfZ8cNen.SqB6', 'karthika', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `liked_songs`
--
ALTER TABLE `liked_songs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `liked_songs_ibfk_1` (`user_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `liked_songs`
--
ALTER TABLE `liked_songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `liked_songs`
--
ALTER TABLE `liked_songs`
  ADD CONSTRAINT `liked_songs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
