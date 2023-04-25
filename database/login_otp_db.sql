-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2023 at 04:29 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_otp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `otp_expiration` datetime DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `qr_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `email`, `password`, `otp`, `otp_expiration`, `date_created`, `qr_code`) VALUES
(1, 'Tanveer', 'ahmed', 'khan', 'tanveerrajput0894@gmail.com', '$2y$10$LSu2y6IjZchpN2p4230H0ekNZ9fTp/Wjl48D2c/u41.nghS3UkXeO', '721521', '2023-03-23 16:28:00', '2023-03-14 04:15:25', 'images/1679585269.png'),
(2, 'ali', 'murtaza', 'asdasds', 'ranatanveer0894@gmail.com', '$2y$10$HWhrgT9Q8FJ.XfVMwW9c3.Z2ZJ1dmaGg.2zswCqznIN4S8mozUQGy', NULL, NULL, '2023-03-14 04:18:20', ''),
(3, 'amara', 'asd', 'ali', 'amara.tanveer28@gmail.com', '$2y$10$6Xx/V9hyhntUHGd4JLD99uUwFvL3F7Z/MARqb1XQtEqVuJp1EnkfK', '349732', '2023-03-14 00:46:00', '2023-03-14 04:44:32', ''),
(4, 'jian', 'mang', 'malay', 'jian@gmail.com', '$2y$10$tmUw7yA6pBy5Mb5Ufyfb7OFmraDcYn4p6EF8RWYDWqeiays4HcLzu', NULL, NULL, '2023-03-15 04:06:50', ''),
(5, 'ali', 'ahmed', 'urs', 'ali@gmail.com', '$2y$10$jS3jo/X226kq9mFz/y2HF.R6Yaz36dzMUPFJtkw1c4YD8QQ22B5Ry', '722548', '2023-03-23 09:21:00', '2023-03-20 20:51:24', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
