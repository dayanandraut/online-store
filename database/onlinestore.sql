-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2021 at 08:10 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinestore`
--

-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

CREATE TABLE `basket` (
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `placed_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `seller_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `basket`
--

INSERT INTO `basket` (`customer_id`, `product_id`, `quantity`, `placed_date`, `seller_id`) VALUES
(15, 1, 2, '2020-12-15 14:40:55', 1),
(17, 2, 2, '2020-12-15 14:44:02', 4),
(18, 2, 3, '2020-12-15 14:48:53', 5),
(20, 1, 3, '2020-12-16 07:06:24', 5);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courier`
--

CREATE TABLE `courier` (
  `courier_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_no` int(11) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_no` bigint(10) NOT NULL,
  `balance` double NOT NULL,
  `c_lat` double NOT NULL,
  `c_lon` double NOT NULL,
  `c_s_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `name`, `email_id`, `password`, `phone_no`, `balance`, `c_lat`, `c_lon`, `c_s_id`) VALUES
(14, 'hari', 'hari@gmail.com', 'hari1234', 8970000123, 700, 12.982414743349537, 80.19284894085172, 2),
(15, 'daya', 'daya@gmail.com', 'dayapass', 8500032004, 840, 28.485901932075024, 77.04896712604665, 1),
(16, 'sagar', 'sagar@gmail.com', 'sagar123', 9845610021, 920, 28.651914560446087, 77.33402088526225, 1),
(17, 'gaurish', 'gaurish@gmail.com', 'gaurish123', 9000002134, 840, 30.32117861021247, 77.93445357489458, 4),
(18, 'mithlesh', 'mithlesh@gmail.com', 'mith1234', 9000002134, 720, 12.876790473128736, 77.65613957929975, 5),
(19, 'luffy', 'luffy@gmail.com', 'luffy1234', 9810001543, 880, 29.931118501738013, 77.84550961431972, 3),
(20, 'ramesh', 'ramesh@gmail.com', 'ramesh123', 9000002134, 800, 13.017243009705425, 77.50403545798082, 5);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `delivery_status` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `availability` tinyint(1) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `brand`, `availability`, `category_id`, `price`) VALUES
(1, 'Dove soap', 'Dove', 41, 1, 40),
(2, 'Sunsilk shampoo', 'Sunsilk', 7, 2, 80),
(3, 'Dove shampoo', 'Dove', 19, 2, 300);

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `s_id` int(11) NOT NULL,
  `seller_name` varchar(255) NOT NULL,
  `phone_no` bigint(11) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `s_lat` double NOT NULL,
  `s_lon` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`s_id`, `seller_name`, `phone_no`, `email_id`, `password`, `s_lat`, `s_lon`) VALUES
(1, 'Vikash Imports Delhi', 9811790485, 'vk@gmail.com', 'vk@123', 28.6186706, 77.1871687),
(2, 'Amma Grocery Chennai', 9812345679, 'amma@gmail.com', 'amma', 13.0480438, 79.9288015),
(3, 'Roshan Stores Roorkee', 9800345987, 'roshan@gmail.com', 'roshan123', 29.8599234, 77.8262114),
(4, 'Kedarnath Store Dehradun', 9880345984, 'kedarnath@gmail.com', 'kedar123', 30.3008562, 78.0121458),
(5, 'Reddy Store Bangalore', 9280377904, 'reddy@gmail.com', 'reddy123', 12.974996, 77.5364153);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`customer_id`,`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `courier`
--
ALTER TABLE `courier`
  ADD PRIMARY KEY (`courier_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`),
  ADD UNIQUE KEY `email_id` (`email_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courier`
--
ALTER TABLE `courier`
  MODIFY `courier_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
