-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2021 at 06:49 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carshowroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_db`
--

CREATE TABLE `admin_db` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_db`
--

INSERT INTO `admin_db` (`id`, `name`, `email`, `password`) VALUES
(1, 'Owner | Admin', 'mrcaradmin@domain.com', 'a923b613f5c06e8be3bd0f40406c8d0c');

-- --------------------------------------------------------

--
-- Table structure for table `cars_db`
--

CREATE TABLE `cars_db` (
  `id` int(255) NOT NULL,
  `car_price` varchar(255) NOT NULL,
  `car_details` varchar(255) NOT NULL,
  `car_img` varchar(255) NOT NULL,
  `car_model` varchar(255) NOT NULL,
  `car_brand` varchar(255) NOT NULL,
  `car_type` varchar(255) NOT NULL,
  `car_status` varchar(10) NOT NULL,
  `car_name` varchar(255) NOT NULL,
  `car_stock` varchar(3) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL DEFAULT 'none',
  `car_sold` varchar(255) DEFAULT NULL,
  `car_color` varchar(255) NOT NULL DEFAULT 'black'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cars_db`
--

INSERT INTO `cars_db` (`id`, `car_price`, `car_details`, `car_img`, `car_model`, `car_brand`, `car_type`, `car_status`, `car_name`, `car_stock`, `created_at`, `updated_at`, `car_sold`, `car_color`) VALUES
(1, '360000', 'High Roof -- 2021 Model -- Modified Shock Absorbers -- Nitro', 'cultus.jpg', '2021', 'Honda', 'Car', 'used', 'Cultus', '6', '19, Jun 2021 06:35:27 PM', 'none', '2', 'Silver'),
(2, '520000', 'High Roof -- 2021 Model -- Modified Shock Absorbers', 'ferrari.jpg', '2021', 'Ferrari', 'SUV', 'new', 'Ferrari', '3', '20, Jun 2021 01:35:27 PM', 'none', '6', 'Black'),
(3, '9600000', '2034 Model -- Red Color -- Modified Shock Absorbers -- Black Windscreen', 'camero.jpg', '2020', 'Chevrolet', 'Muscle', 'new', 'Chevy Zl1', '2', '20, Jun 2021 03:36:27 PM', 'none', '2', 'Red'),
(4, '9500000', '2021 Model -- Red Color -- Modified Shock Absorbers -- Black Windscreen', '522-fortuner44.jpg', '2121', 'Toyota', 'Mid-size SUV', 'new', 'Toyota Fortuner', '6', '20, Jun 2021 02:35:27 PM', '13, Jul 2021 07:31:32 PM', '4', 'Red'),
(5, '4500000', 'Bulletproof Screen -- 1200 HP Engine', '535-corvette.jpg', '2021', 'Chevrolet', 'Sports', 'new', 'Chevrolet Corvette', '2', '20, Jun 2021 03:35:27 PM', '20, Jun 2021 11:35:25 PM', '4', 'Red'),
(6, '3600000', '2021 Model -- 4 Doors -- Black Color -- 1800CC -- Petrol -- Automatic', '81426-civic.jpg', '2021', 'Honda', 'Car', 'new', 'CIVIC X', '5', '27, Jun 2021 01:15:41 PM', 'none', '1', 'White'),
(7, '237', 'Shower -- Dent', '11563-car1.jpg', '1990', 'Toyota', 'Car', 'used', 'Corolla', '1', '13, Jul 2021 07:44:15 PM', 'none', NULL, 'Red'),
(8, '841', 'Wheels Damaged', '94284-car2.jpg', '2000', 'Toyota', 'Car', 'used', 'Corolla', '1', '13, Jul 2021 07:45:12 PM', 'none', NULL, 'Sliver');

-- --------------------------------------------------------

--
-- Table structure for table `contact_db`
--

CREATE TABLE `contact_db` (
  `id` int(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_db`
--

INSERT INTO `contact_db` (`id`, `fullname`, `email`, `message`, `created_at`) VALUES
(1, 'Haseeb112', 'haseeb112@gmail.com', 'Hello There!', '19, Jun 2021 12:34:53 PM'),
(10, 'Haseeb112', 'haseeb112@gmail.com', 'Hi', '01, Jul 2021 08:08:10 PM'),
(11, 'haseeb113', 'haseeb113@gmail.com', 'Hi There', '01, Jul 2021 08:08:35 PM');

-- --------------------------------------------------------

--
-- Table structure for table `orders_db`
--

CREATE TABLE `orders_db` (
  `id` int(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `fathername` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `dateofbirth` varchar(255) NOT NULL,
  `cnic_number` varchar(255) NOT NULL,
  `expire` varchar(255) NOT NULL,
  `cnic_img` varchar(255) NOT NULL,
  `car_id` varchar(255) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `price` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_db`
--

INSERT INTO `orders_db` (`id`, `order_id`, `fullname`, `fathername`, `address`, `phone`, `dateofbirth`, `cnic_number`, `expire`, `cnic_img`, `car_id`, `message`, `price`, `created_at`, `status`, `email`) VALUES
(11, '339600793', 'Haseeb112', 'Haseeb', 'MDA Multan', '03036521244', '2021-06-29', '3236545636489', '2021-06-30', '84018-card.jpg', '5', 'I need a car', '4500000', '27, Jun 2021 03:00:56 PM', 'completed', 'haseeb112@gmail.com'),
(12, '334627574', 'Glenna Hinton', 'Davis Mcbride', 'Aut non sint conseq', '03036521499', '1975-07-13', '3236457987543', '1988-06-05', '12604-rustyuranium.jpg', '6', 'Provident et eu et ', '3600000', '13, Jul 2021 07:21:02 PM', 'completed', 'haseeb112@gmail.com'),
(13, '332149054', 'Bevis Stephens', 'Drew Turner', 'Suscipit est archite', '03036521466', '1993-08-11', '3230465784689', '2017-06-04', '46335-rustyuranium.jpg', '4', 'Sit quis vitae quam', '9500000', '13, Jul 2021 07:25:48 PM', 'completed', 'haseeb112@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users_db`
--

CREATE TABLE `users_db` (
  `id` int(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Inactive',
  `verified` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_db`
--

INSERT INTO `users_db` (`id`, `fullname`, `email`, `password`, `created_at`, `updated_at`, `username`, `status`, `verified`) VALUES
(4, 'Haseeb', 'haseeb112@gmail.com', '550e1bafe077ff0b0b67f4e32f29d751', '19, Jun 2021 09:56:23 PM', '27, Jun 2021 01:25:19 PM', 'haseebahmad', 'Inactive', 'pending'),
(5, 'abbass', 'abbass112@gmail.com', 'b604d0a75e3fe8a226dce9f5230aa96a', '22, Jun 2021 05:24:12 PM', '23, Jun 2021 01:58:58 PM', 'abbass112', 'Inactive', 'pending'),
(6, 'Rana Shehroz', 'shehroz132@gmail.com', '1070af0c7a9dca47b10530802f78332e', '27, Jun 2021 01:46:07 PM', '27, Jun 2021 01:54:40 PM', 'shehroz132', 'Inactive', 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_db`
--
ALTER TABLE `admin_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars_db`
--
ALTER TABLE `cars_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_db`
--
ALTER TABLE `contact_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_db`
--
ALTER TABLE `orders_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_db`
--
ALTER TABLE `users_db`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_db`
--
ALTER TABLE `admin_db`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cars_db`
--
ALTER TABLE `cars_db`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contact_db`
--
ALTER TABLE `contact_db`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders_db`
--
ALTER TABLE `orders_db`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users_db`
--
ALTER TABLE `users_db`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
