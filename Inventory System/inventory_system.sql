-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2023 at 04:34 AM
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
-- Database: `inventory_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `incoming_order`
--

CREATE TABLE `incoming_order` (
  `id` int(11) NOT NULL,
  `Serial_Code` varchar(14) NOT NULL,
  `Product_Name` varchar(200) NOT NULL,
  `Unit` varchar(20) NOT NULL,
  `Quantity` int(100) NOT NULL,
  `Retail_Price` int(100) NOT NULL,
  `Sales_Price` int(100) NOT NULL,
  `Supplier` varchar(100) NOT NULL,
  `Category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` varchar(8) NOT NULL,
  `product` varchar(100) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `category` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product`, `unit`, `category`) VALUES
('12345677', 'bowl', 'pcs', 'Miscellanous'),
('12345678', 'boysen', 'can', 'Miscellanous'),
('15664674', 'Plant pot', 'pcs', 'Miscellanous'),
('23456789', 'hallow blocks', 'pcs', 'Construction'),
('27735345', 'Toilet brush', 'pcs', 'Plumbing'),
('76895632', 'Tissue', 'rolss', 'Plumbing'),
('96546465', 'Electrical wire', 'meter', 'Lighting'),
('98679878', 'Light switch', 'pcs', 'Lighting');

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

CREATE TABLE `product_list` (
  `Serial_Code` varchar(14) NOT NULL,
  `Product_Name` varchar(50) NOT NULL,
  `Unit` varchar(20) NOT NULL,
  `Quantity` int(50) NOT NULL,
  `Retail_Price` int(50) NOT NULL,
  `Sales_Price` int(50) NOT NULL,
  `Supplier` varchar(50) NOT NULL,
  `Category` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`Serial_Code`, `Product_Name`, `Unit`, `Quantity`, `Retail_Price`, `Sales_Price`, `Supplier`, `Category`) VALUES
('01234-12345677', 'bowl', 'pcs', 50, 12, 46, 'S4', 'Miscellanous'),
('12345-15664674', 'Plant pot', 'pcs', 12, 12, 24, 'S1', 'Miscellanous'),
('02345-12345678', 'boysen', 'can', 500, 10, 20, 'S5', 'Miscellanous'),
('02345-15664674', 'Plant pot', 'pcs', 230, 25, 50, 'S5', 'Miscellanous'),
('23456-23456789', 'hallow blocks', 'pcs', 0, 27, 30, 'S2', 'Construction'),
('02345-98679878', 'Light switch', 'pcs', 0, 90, 100, 'S5', 'Lighting'),
('ASDFG-34567898', 'wires', 'meter', 10, 70, 80, 'S6', 'Electrical'),
('02345-27735345', 'Toilet brush', 'pcs', 5, 10, 15, 'S5', 'Plumbing'),
('12345-12345678', 'boysen', 'can', 0, 12, 12, 'S1', 'Miscellanous'),
('denma-23456789', 'hallow blocks', 'pcs', 11, 100, 400, 'S7', 'Construction'),
('ASDFG-27735345', 'Toilet brush', 'pcs', 500, 30, 35, 'S6', 'Plumbing'),
('01234-12345678', 'boysen', 'can', 20, 10, 15, 'S4', 'Miscellanous');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `Code` varchar(5) NOT NULL,
  `Supplier_Name` varchar(100) NOT NULL,
  `Address` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`Code`, `Supplier_Name`, `Address`) VALUES
('01234', 'S4', 'SCCP'),
('02345', 'S5', 'SCCP'),
('12344', 'natalio pogi', 'gzmata'),
('12345', 'S1', 'SCCP'),
('23456', 'S2', 'SCCP'),
('34567', 'S3', 'SCCP'),
('ASDFG', 'S6', 'SCCP'),
('denma', 'S7', 'SCCP');

-- --------------------------------------------------------

--
-- Table structure for table `temporary`
--

CREATE TABLE `temporary` (
  `Serial_Code` varchar(14) NOT NULL,
  `Product` varchar(100) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` int(100) NOT NULL,
  `Total_Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_history`
--

CREATE TABLE `transaction_history` (
  `id` int(100) NOT NULL,
  `Reference_Code` varchar(8) NOT NULL,
  `Buyer` varchar(1000) NOT NULL,
  `Products` varchar(100) NOT NULL,
  `Quantity` int(100) NOT NULL,
  `Date` varchar(10) NOT NULL,
  `Total_Price` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_history`
--

INSERT INTO `transaction_history` (`id`, `Reference_Code`, `Buyer`, `Products`, `Quantity`, `Date`, `Total_Price`) VALUES
(1, '12121212', 'Denmarc', 'Light switch', 10, '01-30-2023', 900),
(2, '12123434', 'Klijht', 'Toilet brush', 5, '01-30-2023', 50),
(3, '12123434', 'Klijht', 'wires', 5, '01-30-2023', 350),
(4, '23456778', 'Rich', 'bowl', 50, '06-21-2023', 600),
(5, '23456778', 'Rich', 'Light switch', 5, '06-21-2023', 450),
(6, '67676767', 'Lanny', 'Plant pot', 20, '06-22-2023', 500),
(7, '67676767', 'Lanny', 'Light switch', 5, '06-22-2023', 450),
(8, '67676767', 'Lanny', 'wires', 10, '06-22-2023', 700);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `first_name`, `last_name`, `position`) VALUES
(1, 'den', '123', '   Denmarc', 'Angeles', 'Employee'),
(2, 'chad', '123', ' Richard', 'Dela Pena', 'Administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `incoming_order`
--
ALTER TABLE `incoming_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`Serial_Code`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`Code`);

--
-- Indexes for table `temporary`
--
ALTER TABLE `temporary`
  ADD PRIMARY KEY (`Serial_Code`);

--
-- Indexes for table `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `incoming_order`
--
ALTER TABLE `incoming_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_history`
--
ALTER TABLE `transaction_history`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
