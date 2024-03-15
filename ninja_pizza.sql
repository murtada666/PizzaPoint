-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2024 at 12:44 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ninja_pizza`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_type` varchar(255) DEFAULT 'client'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `password`, `account_type`) VALUES
(35, 'murtada', 'murt@gmail.com', '$2y$10$obLkhSJbkMi2PMP8ZFDm7udgxZYZR6u9.PGw2T3izK9F55gaTIJzq', 'client'),
(37, 'ali', 'ali@gmail.com', '$2y$10$VEM0gF559AjuMLhmYcXLTuxjHAyAY6AmORPXIDho.wxCjEsy27X/y', 'client'),
(38, 'moha', 'moha@gmail.com', '$2y$10$VQBEgmMftrUe5KGCgSgp3.aNRYvEHyYkRQfydgRwLUxe9YwrW6fRi', 'client'),
(39, 'ameer', 'ameer@gmail.com', '$2y$10$E/C3dGrtaOTXISuytdawhOkWnJ.iT.ccFYnKjYqhs7HsVwnXswf8C', 'client'),
(50, 'alolo', 'alolo@gmail.com', '$2y$10$OrYCr4FiCV9scxnM/V4nOON2VKxAdwtuLCOMxVTiAIpRMGgEsnUj6', 'client'),
(51, 'alo', 'alo@gmail.com', '$2y$10$rC.2tug6pBaKmdKKxnWndegUFk1roCRKVQ64xwPcjMn2Se32dsxuq', 'client'),
(52, 'lolo', 'lolo@gmail.com', '$2y$10$IAH4CpvIOc/0kJJY8P1vZOk2.CgwfF7J48hpQYAzd5EWkTJSrGVie', 'client'),
(53, 'ali', 'alihut@gmail.com', '$2y$10$QJPJuWgtschFpGPN.eiCPOahkz7x3PRc.V.NEY036xc/r4gqHPCGO', 'client'),
(54, 'moaml', 'moaml-new@gmail.com', '$2y$10$GmI2qRhmrN0ypxDAaHnwiO2GoTFZe3ychLXIijhm9wUCJSA9k5kF2', 'client');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_type` varchar(255) DEFAULT 'driver'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `email`, `password`, `account_type`) VALUES
(8, 'ali', 'ali55@gmail.com', '$2y$10$vnnRS53HL1M8AOqDteti3.o1TJ1/.XzvLKch.x9bGIsIZl7W/dpR6', 'driver'),
(9, 'hayder', 'hayder@gmail.com', '$2y$10$DaEvknLEdzw/ObPC9RGviOJUJcmLevlEgXtGnDEzUbjtoCVDK5ICi', 'driver'),
(11, 'moaml', 'moaml@gmail.com', '$2y$10$8BODsOlsifUINomxivkfbOMwkwoUjIHOxEax/d7xDDP3Q3LyvbLye', 'driver'),
(12, 'salah', 'salah@gmail.com', '$2y$10$hBLby2ay9r5hMnubJz5F1etWiEMakGbrwPK8W6i9IAzwvnocQ5VHW', 'driver'),
(13, 'falah', 'falah@gmail.com', '$2y$10$uvkefsWLobQrmioqxysND.ypss3I0Bse.9b4hQh1LANjJEBc97VJq', 'driver');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `order_status` varchar(20) DEFAULT '0',
  `order_details` text DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `client_id`, `restaurant_id`, `driver_id`, `order_status`, `order_details`, `total`, `created_at`) VALUES
(277, 35, 8, 8, '1', '63, 84, 85', 34, '2024-02-16 12:27:52'),
(278, 35, 9, 12, '0', '18, 23', 9, '2024-02-16 12:29:06'),
(279, 35, 8, 12, '4', '63, 84, 85', 34, '2024-02-16 12:29:15'),
(280, 35, 11, 9, '0', '82', 16, '2024-02-16 12:29:46'),
(281, 35, 9, 13, '0', '18, 23', 9, '2024-02-16 12:35:01'),
(282, 35, 8, 9, '2', '63, 85', 23, '2024-02-16 12:35:20'),
(283, 35, 8, 12, '4', '84, 85', 34, '2024-02-17 07:52:16'),
(284, 35, 9, 13, '0', '18', 3, '2024-02-17 11:56:18');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `order_status` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `order_status`, `description`) VALUES
(1, 0, 'placed/new order to restaurant(pending)'),
(2, 1, 'confirmed by restaurant(cooking)'),
(3, 2, 'completed/ new order to a driver'),
(4, 3, 'shipped from restaurant by a driver'),
(5, 4, 'delivered to client');

-- --------------------------------------------------------

--
-- Table structure for table `pizzas`
--

CREATE TABLE `pizzas` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `ingredients` varchar(255) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pizzas`
--

INSERT INTO `pizzas` (`id`, `restaurant_id`, `title`, `ingredients`, `price`, `created_at`) VALUES
(18, 9, 'The newest pizza', 'olive , tomato, cheese', 3, '2023-07-04 13:33:47'),
(23, 9, 'Murtada super', 'olive , tomato, cheese', 6, '2023-08-03 15:34:25'),
(63, 8, 'ninja subreme extra', 'tomato, olive, cheese', 12, '2024-01-18 18:51:26'),
(82, 11, 'm2k super', 'tomato, olive, cheese', 16, '2024-01-21 11:20:28'),
(84, 8, 'something', 'something, something, something', 11, '2024-02-12 18:49:02'),
(85, 8, 'something', 'something, something, something', 11, '2024-02-12 18:49:02'),
(88, 8, 'supreme', 'tomato, olive, cheese', 11, '2024-02-27 10:13:43'),
(89, 8, 'supre supreme', 'mushroom, olive, cheese', 32, '2024-02-27 10:14:37'),
(90, 8, 'supre supreme', 'mushroom, olive, cheese', 32, '2024-02-27 10:14:38'),
(91, 8, 'supre supreme', 'mushroom, olive, cheese', 32, '2024-02-27 10:14:41'),
(92, 8, 'supre supreme', 'mushroom, olive, cheese', 32, '2024-02-27 10:15:10'),
(93, 8, 'supre supreme', 'mushroom, olive, cheese', 32, '2024-02-27 10:15:22'),
(94, 8, 'supre', 'mushroom, olive, cheese', 22, '2024-02-27 10:15:31'),
(111, 8, 'pizza supreme', 'tomato, olive, cheese', 33, '2024-02-27 10:22:37'),
(116, 8, 'super murtada', 'mushroom, olive, cheese', 43, '2024-03-01 12:19:49'),
(117, 8, 'pizza pizza', 'mushroom, olive', 22, '2024-03-01 12:28:53'),
(118, 8, 'another', 'tomato, olive, cheese', 32, '2024-03-01 12:29:17'),
(119, 8, 'super cheese', 'tomato, olive, extra cheese', 12, '2024-03-01 12:32:56'),
(120, 11, 'M2K', 'tomato, cheese, somthing', 32, '2024-03-01 12:38:20');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_type` varchar(255) DEFAULT 'restaurant'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `email`, `password`, `account_type`) VALUES
(8, 'Pizza Hut', 'hut@gmail.com', '$2y$10$81CW56e0Wu60gJE4.4UU0eSWJq/Uhn6G5Gza6zACCyOD8CcCZ00jm', 'restaurant'),
(9, 'MHH', 'mhh@gmail.com', '$2y$10$emEbfR.egX1C4IQdinNTneLaqzmPJi74lW97pdhr2Tcvk2cq3l50.', 'restaurant'),
(10, 'SHMESANI', 'shmes@gmail.com', '$2y$10$445Ej1AgFQ0zCtHkeClUaOm/LKM7nIG4CBtbFBN/hJupt/2euReGy', 'restaurant'),
(11, 'm2k', 'm2k@gmail.com', '$2y$10$Np56rqm6dFuI9zHQrtngE.9nfsf/zPq.rmESoUwV8CD7.DTNgBXNe', 'restaurant');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `restaurant_id` (`restaurant_id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pizzas`
--
ALTER TABLE `pizzas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=635;

--
-- AUTO_INCREMENT for table `pizzas`
--
ALTER TABLE `pizzas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`);

--
-- Constraints for table `pizzas`
--
ALTER TABLE `pizzas`
  ADD CONSTRAINT `pizzas_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
