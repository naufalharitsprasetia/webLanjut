-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 23, 2025 at 03:57 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uasweblanjut`
--

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `access_token` text COLLATE utf8mb4_general_ci NOT NULL,
  `refresh_token` text COLLATE utf8mb4_general_ci NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `user_id`, `access_token`, `refresh_token`, `expires_at`) VALUES
(1, 1, 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwidXNlcm5hbWUiOiJuYXVmYWwiLCJpYXQiOjE3MzkxNjE4NDAsImV4cCI6MTczOTE2NTQ0MH0.WMMYbwL4ft4LIFlThF4MbnKYXUH4KtURu6bkBO4nejGkVFYy9Yhp2_hlI_WAGm8hjGCI5FSP7GabJopyf-B08CCa-_y3b8DkbwN0zw2Rh49pHCu76gNbywkibuLUr0PIFdPiHke5bC7QaTiYmO0LAVq2dPPs-y8TYynchjTkJpCZ37jEM6gfqLVNnJcvCSQ5c3BcXHQafjw7j2wuJUkmrg-OkLgRkvVzyYLxOfG4Z_ROjd7cXN9fcJC3KsbpuljBst1_XeFJfuVrGIHjeA67aOiYKQWuCZrdJUhVyNzkGSe_FEQog3cTiaRzNoQgmmDUZjutMDBJ7ZwdB5VnZi9G8g', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwiaWF0IjoxNzM5MTYxODQwLCJleHAiOjE3Mzk3NjY2NDB9.zA3mnQXiiqaEINnGI9hSCuxonp__Y_g9haVWchnKzmE', '2025-02-10 11:45:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'naufal', '$2a$10$juDwwEMG6tw2Isln6Kk7o.EDnNnpLRDAs/7YzOL2n50TQ8.REIfg.'),
(2, 'asdas', '$2a$10$i0onHD6KyaUP7Bb7dtJJBeCLAbqaAc0Gs9/Yfg6cYOIMOQ0VQsfUS'),
(3, 'alvinarya', '$2a$10$6DklU62UnFXO41i.lM.hQeN35fJ5o8MpCffTOb8b6YIssMGMC6AK2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
