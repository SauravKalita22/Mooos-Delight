-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2022 at 01:26 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dairydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` int(11) NOT NULL,
  `email` varchar(75) NOT NULL,
  `name` varchar(255) NOT NULL,
  `comments` text NOT NULL,
  `addedon` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `email`, `name`, `comments`, `addedon`) VALUES
(1, 'Sauravkalita@gmail.com', 'Saurav Kalita', 'I had some questions regarding your product cheese from the vendor', '2022-03-02 22:03:06');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id` int(11) NOT NULL DEFAULT 1,
  `userid` int(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `productprice` varchar(255) NOT NULL,
  `quantity` int(100) NOT NULL,
  `dateplaced` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`id`, `userid`, `image`, `productname`, `productprice`, `quantity`, `dateplaced`, `status`) VALUES
(0, 0, '', '', '', 0, '2022-02-22 08:13:44', 0),
(1, 2, '/dairy/media/product/968992921_Cheese Slices.png', 'Cheese (5 slices pack)', '100', 1, '2022-03-02 21:42:03', 1),
(1, 2, '/dairy/media/product/311060628_panir.png', 'Paneer (500g)', '200', 2, '2022-03-02 21:42:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mrp` float NOT NULL,
  `price` float NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `bestsell` varchar(255) NOT NULL,
  `featured` varchar(255) NOT NULL,
  `new` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `vendor_id`, `name`, `mrp`, `price`, `image`, `status`, `bestsell`, `featured`, `new`) VALUES
(1, 1, 'Cheese (150g)', 150, 130, '615803360_cheese.png', 1, 'yes', 'no', '2022-02-22 08:14:16'),
(2, 1, 'Milk (1L)', 80, 70, '160718684_milk1.png', 1, 'yes', 'no', '2022-02-22 08:15:19'),
(3, 1, 'Paneer (250g)', 125, 110, '717736098_panir.png', 1, 'yes', 'no', '2022-02-22 08:16:44'),
(4, 1, 'Buttermilk (250ml)', 120, 100, '607398552_buttermilk.png', 1, 'yes', 'no', '2022-02-22 08:17:56'),
(5, 0, 'Cheese (pack of 10 Slices)', 200, 180, '842579710_Cheese Slices.png', 1, 'no', 'yes', '2022-02-22 08:18:58'),
(6, 1, 'Cheese (10 Slices Pack)', 160, 130, '138413320_Cheese Slices.png', 1, 'no', 'yes', '2022-02-22 08:20:18'),
(7, 4, 'Cheese (500g)', 300, 250, '602714406_cheese.png', 1, 'no', 'yes', '2022-02-22 08:33:19'),
(8, 2, 'Yogurt (100g)', 50, 35, '519812274_yogurt.png', 1, 'yes', 'no', '2022-02-22 08:35:06'),
(9, 2, 'Yogurt (500g)', 250, 190, '172897467_yogurt.png', 1, 'no', 'yes', '2022-02-22 08:35:38'),
(10, 3, 'Cheese (5 slices pack)', 120, 100, '968992921_Cheese Slices.png', 1, 'no', 'yes', '2022-02-22 08:36:36'),
(15, 2, 'Milk (500ml)', 45, 35, '155165874_milk1.png', 1, 'no', 'no', '2022-03-02 21:13:35'),
(16, 3, 'Buttermilk (Chaas,500ml)', 200, 180, '588168734_buttermilk.png', 1, 'no', 'no', '2022-03-02 21:14:50'),
(17, 4, 'Paneer (500g)', 240, 200, '311060628_panir.png', 1, 'no', 'no', '2022-03-02 21:15:48');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(2) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'user',
  `dateadded` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `fname`, `lname`, `email`, `password`, `type`, `dateadded`) VALUES
(0, 'admin', 'admin', 'admin@admin.com', 'admin', 'admin', '2022-02-21 19:46:41'),
(1, 'Aman', 'Madhukar', 'am@gmail.com', '123am', 'user', '2022-02-21 19:54:19'),
(2, 'Saurav', 'Kalita', 'sk@gmail.com', '123sk', 'user', '2022-03-02 21:25:57');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `id` int(100) NOT NULL,
  `userid` int(100) NOT NULL,
  `orderid` int(100) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `mobileno` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `houseno` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `payment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`id`, `userid`, `orderid`, `fullname`, `mobileno`, `pincode`, `houseno`, `address`, `city`, `state`, `payment`) VALUES
(1, 2, 1, 'Saurav Kalita', '1234567890', '123456', 'A-109', 'Malad West , Mumbai', 'Mumbai', 'Maharashtra', 'COD');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `vendor` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `vendor`, `status`) VALUES
(1, 'MK Dairy', 1),
(2, 'FreshFromFarm Dairy', 1),
(3, 'Sethi\'s Dairy', 1),
(4, 'Deepam\'s Dairy', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
