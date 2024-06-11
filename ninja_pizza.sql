-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2024 at 01:26 PM
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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` char(50) DEFAULT NULL,
  `email` char(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `account_type` char(20) DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `account_type`) VALUES
(11, 'murtada', 'murtada.admin@gmail.com', '$2y$10$JrZBS7lsC2XNIE/0gUDeX.TxNuka7PFe19gx/ipmbIwu3xehe1f32', 'admin'),
(12, 'admin', 'admin@gmail.com', '$2y$10$yZ0STFsaLvZYP4fMs.iKcOL6UUA4swZ3XW6Lb.Hh5ZVPH2nUHxi4e', 'admin'),
(13, 'Baghdad', 'baghdad@gmail.com', '$2y$10$h7lhltjWe8EYv2Ap3qcjtuSNOOdeH0sYiE1TD6OQzHZQ86HXAymeW', 'admin'),
(14, 'Baghdad', 'baghdad2@gmail.com', '$2y$10$Ww8HRRp6NKbCxSWi7dAMvu4B3AKk1oWeC2ePcuHbF9q.cSUXbpOIa', 'admin'),
(15, 'Baghdad', 'baghdad99@gmail.com', '$2y$10$Ac8MkTimmB7huFJdTX3RL.0LjR4n/mPN46ZKdi/Zgjb3nvYe1i5qW', 'admin'),
(16, 'Baghdad', 'baghdad8@gmail.com', '$2y$10$.lvIciZuqHcm6Hl/kJTSZOmINnHgj0sA/hPG2Y6Dn40DKaKVjRhCK', 'admin'),
(17, 'Baghdad', 'baghdad11@gmail.com', '$2y$10$c8Gm4INd5/55oqsLYGQdSuJL2ide1evnQ5NapJjff79sAHFFRgQ0W', 'admin'),
(23, 'admin test', 'admintest@gmail.com', '$2y$10$SeAIiRUpFxNBIROGXwItwO6Qw8geq.aAhfzQJ1Faz1x3/g9S5W7KG', 'admin'),
(24, 'admin test', 'admin11@gmail.com', '$2y$10$t5n4ZaCyTPOoi3bT7JlV0.BtJGAQsJ/k4E3p6gqSTrCIfmU7kNHVK', 'admin');

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
(54, 'moaml', 'moaml-new@gmail.com', '$2y$10$GmI2qRhmrN0ypxDAaHnwiO2GoTFZe3ychLXIijhm9wUCJSA9k5kF2', 'client'),
(55, 'alal', 'alal@gmail.com', '$2y$10$kZPGtbKIdjCwD7xpt8UImucRRWs/PpCUDRWBv1dupS3bYZiWsDQwq', 'client'),
(60, 'client test', 'client.test@gmail.com', '$2y$10$XClzUiYA07tHrJ3jL7uRIe59o6Go9iIsBQ2Hv6X4JG3DN5ft/YJ62', 'client'),
(61, 'murtada', 'murt.work@gmail.com', '$2y$10$7bg9iutgBBKGyuMVirMpROVEgnY3UhLnbjKTfeuExsRrWQws2jOdy', 'client');

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
(12, 'salah alallak', 'salah@gmail.com', '$2y$10$hBLby2ay9r5hMnubJz5F1etWiEMakGbrwPK8W6i9IAzwvnocQ5VHW', 'driver'),
(13, 'falah', 'falah@gmail.com', '$2y$10$uvkefsWLobQrmioqxysND.ypss3I0Bse.9b4hQh1LANjJEBc97VJq', 'driver'),
(14, 'driver test', 'driver.test@gmail.com', '$2y$10$8VScha6YpuTjE4fLaT6AzekU.ir73ANZylHp.55hGnnVop86Gcvoq', 'driver');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
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

INSERT INTO `orders` (`id`, `client_id`, `restaurant_id`, `driver_id`, `order_status`, `order_details`, `total`, `created_at`) VALUES
(290, 35, 8, 9, '0', '63, 88, 89, 90', 87, '2024-06-11 11:13:40'),
(291, 35, 9, 8, '0', '18, 23', 9, '2024-06-11 11:14:23'),
(292, 35, 8, 11, '1', '63, 88', 23, '2024-06-11 11:16:23'),
(293, 35, 8, 12, '0', '88, 89, 117, 90', 97, '2024-06-11 11:18:19');

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
(11, 'm2k', 'm2k@gmail.com', '$2y$10$Np56rqm6dFuI9zHQrtngE.9nfsf/zPq.rmESoUwV8CD7.DTNgBXNe', 'restaurant'),
(12, 'king', 'king@gmail.com', '$2y$10$rCX1xREEOvmWFCgTear8wOXdRuUVo8NY/6rdV1JoqcHnxax1YdUVm', 'restaurant'),
(13, 'res', 'res11t@gmail.com', '$2y$10$n3b7lpTjGNv7vL6jk4pbhuF96mPDUQR0Bq2QDsukKVxlaf5OXq/ge', 'restaurant'),
(14, 'res', 'res111t@gmail.com', '$2y$10$2ld.GIYQSlTrtFK1cxXaWO7zulNuII4ZjQz7ovHqUKucO3dOg/Qhi', 'restaurant'),
(15, 'restttttttt', 'reseet@gmail.com', '$2y$10$I3XdY.5Bt2.DwTSlvcLj8uINJ1sF/EZxjIIiItWelSOt//3CGhHM6', 'restaurant'),
(16, 'restaurant test', 'resttest@gmail.com', '$2y$10$fxU/EiSjYOVNFDWlkIyQT.HUEQv6XaWKrm1LbZF9qGd0R8CAZutri', 'restaurant');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`),
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=294;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
