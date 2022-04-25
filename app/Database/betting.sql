-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 25, 2022 at 12:27 AM
-- Server version: 8.0.24
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `betting3`
--

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

CREATE TABLE `balance` (
  `user_id` int NOT NULL,
  `eur` int NOT NULL DEFAULT '0',
  `usd` int NOT NULL DEFAULT '0',
  `rub` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

--
-- Dumping data for table `balance`
--

INSERT INTO `balance` (`user_id`, `eur`, `usd`, `rub`, `created_at`, `updated_at`) VALUES
(1, 50000, 15000, 25000, '2022-01-30 22:54:53', '2022-04-24 21:08:36'),
(2, 40000, 25000, 32000, '2022-04-23 15:00:09', '2022-04-24 21:27:39');

-- --------------------------------------------------------

--
-- Table structure for table `bets`
--

CREATE TABLE `bets` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `bet_amount` int NOT NULL,
  `ratio` float NOT NULL,
  `currency` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `win` int DEFAULT NULL,
  `is_win` int NOT NULL,
  `status` enum('0','1','2') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

--
-- Dumping data for table `bets`
--

INSERT INTO `bets` (`id`, `user_id`, `bet_amount`, `ratio`, `currency`, `win`, `is_win`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 10000, 2.5, 'eur', 25000, 1, '1', '2022-04-24 21:27:13', '2022-04-24 21:27:13'),
(2, 2, 20000, 1.45, 'eur', 0, 0, '1', '2022-04-24 21:27:39', '2022-04-24 21:27:39');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `email` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `user_id`, `email`) VALUES
(1, 1, 'redhippo3@gmail.com'),
(2, 1, 'redhippo4@gmail.com'),
(3, 2, 'boddy1@gmail.com'),
(4, 2, 'boddy2@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `numbers`
--

CREATE TABLE `numbers` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `number` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

--
-- Dumping data for table `numbers`
--

INSERT INTO `numbers` (`id`, `user_id`, `number`) VALUES
(1, 1, '7 926 981-35-26'),
(2, 1, '7 962 834-53-77'),
(3, 2, '7 991 181-01-54'),
(4, 2, '380 96 884-88-69');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(35) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `login` varchar(16) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `gender` varchar(6) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `birth_date` date NOT NULL,
  `address` varchar(70) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `status` enum('0','1') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `password`, `gender`, `birth_date`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Alexandr Kuzmin', 'Redhippo3', '1234567890', 'male', '2022-04-20', 'Санкт-Петербург ул. Белы Куна д. 8', '1', '2022-04-23 14:45:56', '2022-04-23 14:45:56'),
(2, 'Egor Halonen', 'body', '1234567890', 'male', '2022-04-22', 'Санкт-Петербург Русановская ул. 19 корпус 1, литера А', '1', '2022-01-30 22:54:53', '2022-01-30 22:54:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balance`
--
ALTER TABLE `balance`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bets`
--
ALTER TABLE `bets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `numbers`
--
ALTER TABLE `numbers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bets`
--
ALTER TABLE `bets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `numbers`
--
ALTER TABLE `numbers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `balance`
--
ALTER TABLE `balance`
  ADD CONSTRAINT `balance_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `bets`
--
ALTER TABLE `bets`
  ADD CONSTRAINT `bets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `emails`
--
ALTER TABLE `emails`
  ADD CONSTRAINT `emails_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `numbers`
--
ALTER TABLE `numbers`
  ADD CONSTRAINT `numbers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
