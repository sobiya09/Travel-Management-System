-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2024 at 10:37 AM
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
-- Database: `travel_management2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `adminId` int(11) NOT NULL,
  `adminUsername` varchar(255) NOT NULL,
  `adminPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminId`, `adminUsername`, `adminPassword`) VALUES
(1, 'admin', '$2y$10$blEkHqi9qXPtRptIAfEApOt1QEDKoo6QwI3oAPbTn4RW8ctOkeWrC');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `guests` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `package_id`, `booking_date`, `guests`, `email`, `address`, `phone`) VALUES
(1, 1, 1, '2024-07-25', 3, 'test1@example.com', '123 Main St, City, Country', '1234567890'),
(2, 1, 2, '2024-06-21', 4, 'test2@example.com', '456 Elm St, City, Country', '2345678901'),
(3, 1, 3, '2024-06-13', 5, 'test3@example.com', '789 Oak St, City, Country', '3456789012'),
(5, 2, 2, '2024-07-24', 3, 'abarnasamy1122@gmail.com', 'Chunnakam', '0771234567'),
(6, 3, 2, '2024-07-18', 4, 'abarnasamy1122@gmail.com', 'Chunnakam', '0771234567'),
(7, 3, 5, '2024-07-31', 4, 'abarnasamy1122@gmail.com', 'Chunnakam', '0771234567'),
(8, 3, 6, '2024-07-24', 5, 'abarnasamy1122@gmail.com', 'Chunnakam', '0771234567'),
(9, 4, 2, '2024-07-11', 3, 'abarnasamy1122@gmail.com', 'Chunnakam', '0771234567'),
(10, 2, 2, '2024-07-19', 4, 'abarnasamy1122@gmail.com', 'Chunnakam', '0771234567');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `description`, `price`, `image_url`) VALUES
(1, 'Beach Vacation', 'Enjoy a relaxing vacation on the beach.', 5000.00, 'images/img-1.jpg'),
(2, 'Mountain Adventure', 'Explore the mountains and go hiking.', 10000.00, 'images/img-2.jpg'),
(3, 'City Tour', 'Discover the city and its attractions.', 15000.00, 'images/img-3.jpg'),
(4, 'Safari Adventure', 'Experience the thrill of a safari.', 700.00, 'images/img-4.jpg'),
(5, 'Cruise Holiday', 'Sail the seas on a luxurious cruise.', 1200.00, 'images/img-5.jpg'),
(6, 'Desert Expedition', 'Discover the beauty of the desert.', 800.00, 'images/img-6.jpg'),
(7, 'Historical Journey', 'Explore historical sites and monuments.', 400.00, 'images/img-7.jpg'),
(8, 'Island Escape', 'Relax on a secluded island.', 1500.00, 'images/img-8.jpg'),
(9, 'Ski Trip', 'Hit the slopes on a ski adventure.', 600.00, 'images/img-9.jpg'),
(10, 'Jungle Trek', 'Explore the dense jungle and its wildlife.', 450.00, 'images/img-10.jpg'),
(11, 'Cultural Experience', 'Immerse yourself in local cultures.', 350.00, 'images/img-11.jpg'),
(12, 'Spa Retreat', 'Relax and rejuvenate at a spa.', 1000.00, 'images/img-12.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email_address`, `phone_number`, `address`, `password`) VALUES
(1, 'sobiya', 'sobiya@example.com', '1234567890', 'Jaffna', '$2y$10$WhAjDmZmETR4.BhHdh4eqeA.upvi.uu2NA9NnV8gtUbblGJdODK6W'),
(2, 'Abarna', 'abarnasamy1122@gmail.com', '0771234567', 'Chunnakam', '$2y$10$tQToEzvjtHfPXl.6.IUsIO41dLAo7ms6oA/uCDu5R8ABZDU1JrLfG'),
(3, 'abcd', 'abarnasamy1122@gmail.com', '0771234567', 'Chunnakam', '$2y$10$Kodf4sedrHyZeIl/DGxkPuixJTaqdqzenuoiFRmJn3CilJSQqD7IW'),
(4, 'a', 'abarnasamy1122@gmail.com', '0771234567', 'Chunnakam', '$2y$10$RzLXcA51Iw9cuHY/nVVln.Y6ojTonoVsgW6ouCDdEpuyG8oJTPmzS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
