-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2024 at 09:18 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `airplanes`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `person_id` int(11) DEFAULT NULL,
  `datetime` datetime NOT NULL,
  `text` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `person_id`, `datetime`, `text`, `email`) VALUES
(1, NULL, '2024-12-18 22:51:31', '123', 'er@ew'),
(2, 3, '2024-12-18 22:52:03', 's', '1@1'),
(3, NULL, '2024-12-18 22:56:11', 'geargeargera', 'rg@g');

-- --------------------------------------------------------

--
-- Table structure for table `promo_codes`
--

CREATE TABLE `promo_codes` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `discount` decimal(5,2) NOT NULL,
  `valid_until` date DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promo_codes`
--

INSERT INTO `promo_codes` (`id`, `code`, `discount`, `valid_until`, `is_active`) VALUES
(1, 'SANTA25', 5.00, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchased_tickets`
--

CREATE TABLE `purchased_tickets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `original_price` decimal(10,2) NOT NULL,
  `final_price` decimal(10,2) NOT NULL,
  `promo_code_id` int(11) DEFAULT NULL,
  `purchase_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchased_tickets`
--

INSERT INTO `purchased_tickets` (`id`, `user_id`, `ticket_id`, `original_price`, `final_price`, `promo_code_id`, `purchase_date`) VALUES
(6, 5, 20, 319.99, 319.99, NULL, '2024-12-19 10:15:52');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `start_destination` text NOT NULL,
  `arrival_destination` text NOT NULL,
  `start_time` datetime NOT NULL,
  `arrival_time` datetime NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `start_destination`, `arrival_destination`, `start_time`, `arrival_time`, `price`) VALUES
(1, 'София', 'Лондон', '2024-03-20 08:01:00', '2024-03-20 10:30:00', 299.99),
(2, 'Париж', 'София', '2024-03-20 11:45:00', '2024-03-20 15:15:00', 349.99),
(4, 'Мадрид', 'София', '2024-03-21 14:00:00', '2024-03-21 18:00:00', 449.99),
(5, 'София', 'Берлин', '2024-03-22 06:15:00', '2024-03-22 08:30:00', 379.99),
(6, 'Амстердам', 'София', '2024-03-22 12:30:00', '2024-03-22 16:00:00', 289.99),
(7, 'София', 'Виена', '2024-03-23 09:45:00', '2024-03-23 11:00:00', 399.99),
(8, 'Барселона', 'София', '2024-03-23 16:15:00', '2024-03-23 19:45:00', 329.99),
(9, 'София', 'Прага', '2024-03-24 07:00:00', '2024-03-24 08:45:00', 419.99),
(10, 'Атина', 'София', '2024-03-24 13:30:00', '2024-03-24 14:45:00', 359.99),
(11, 'София', 'Париж', '2024-03-25 10:00:00', '2024-03-25 12:30:00', 299.99),
(12, 'Лондон', 'София', '2024-03-25 15:45:00', '2024-03-25 19:15:00', 449.99),
(13, 'София', 'Мадрид', '2024-03-26 08:30:00', '2024-03-26 11:30:00', 389.99),
(14, 'Рим', 'София', '2024-03-26 14:00:00', '2024-03-26 15:45:00', 339.99),
(15, 'София', 'Амстердам', '2024-03-27 06:45:00', '2024-03-27 09:15:00', 429.99),
(16, 'Берлин', 'София', '2024-03-27 12:30:00', '2024-03-27 14:45:00', 369.99),
(17, 'София', 'Барселона', '2024-03-28 09:00:00', '2024-03-28 11:30:00', 309.99),
(18, 'Виена', 'София', '2024-03-28 15:15:00', '2024-03-28 16:30:00', 399.99),
(19, 'София', 'Атина', '2024-03-29 08:45:00', '2024-03-29 10:00:00', 349.99),
(20, 'Прага', 'София', '2024-03-29 13:30:00', '2024-03-29 15:15:00', 329.99);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `names` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `names`, `email`, `password`, `is_admin`) VALUES
(1, '124', '124@421', '$argon2i$v=19$m=65536,t=4,p=1$T2N2Yk95WDhFbjF6Z0hFbA$waYdSMrydW4XJezRpvFcq0FfB6B9jVz1GI3a79tkRmE', '1'),
(2, '123', '123@123', '$argon2i$v=19$m=65536,t=4,p=1$anRwWlpWcGh4WEdJbjVlRg$JQ4F0dIvJ1Qc9gmssudv9yOnx4HRn2xe6l9Op8FobzQ', '2'),
(3, '1', '1@1', '$argon2i$v=19$m=65536,t=4,p=1$UDE1UEVSWXAyNFp3L1B4dg$wTqT6eFwNop5kJBcREyYCTd7OHtRXdH0lcaIJyyDpL0', '2'),
(4, 'user', 'user@user', '$argon2i$v=19$m=65536,t=4,p=1$OE1ja29hQ3NrWmZVUnlsTw$cCecTwbOLBe9VRF1RXaOKdQxwDV9ysZTCOgTJ4w3HPU', '1'),
(5, 'admin', 'admin@admin', '$argon2i$v=19$m=65536,t=4,p=1$QnNjOFhGUmIuZWpzRlpWSg$BQX7DMfvF6mCrHZ0aingX5TpLeojVgvTNEYOcDDJGys', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `purchased_tickets`
--
ALTER TABLE `purchased_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ticket_id` (`ticket_id`),
  ADD KEY `promo_code_id` (`promo_code_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `promo_codes`
--
ALTER TABLE `promo_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchased_tickets`
--
ALTER TABLE `purchased_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchased_tickets`
--
ALTER TABLE `purchased_tickets`
  ADD CONSTRAINT `purchased_tickets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `purchased_tickets_ibfk_2` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`),
  ADD CONSTRAINT `purchased_tickets_ibfk_3` FOREIGN KEY (`promo_code_id`) REFERENCES `promo_codes` (`id`);
COMMIT;
