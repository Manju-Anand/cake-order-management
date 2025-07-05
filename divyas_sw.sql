-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2025 at 12:06 PM
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
-- Database: `divyas_sw`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(500) NOT NULL,
  `status` varchar(500) NOT NULL,
  `created` varchar(500) NOT NULL,
  `modified` varchar(500) NOT NULL,
  `sec-code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `status`, `created`, `modified`, `sec-code`) VALUES
(1, 'Cakes', 'Active', 'May 10,2024 11:23:56 am', 'May 10,2024 11:23:56 am', ''),
(2, 'Chips', 'Active', 'May 10,2024 11:24:34 am', 'May 10,2024 11:24:34 am', ''),
(3, 'Pickles', 'Active', 'May 10,2024 11:24:41 am', 'May 10,2024 11:24:41 am', ''),
(4, 'Biriyani ', 'Active', 'May 13,2024 10:33:03 am', 'May 13,2024 10:33:03 am', ''),
(5, 'Fried Rice', 'Active', 'May 13,2024 10:33:51 am', 'May 13,2024 10:33:51 am', '');

-- --------------------------------------------------------

--
-- Table structure for table `crelatives`
--

CREATE TABLE `crelatives` (
  `id` int(11) NOT NULL,
  `custid` varchar(11) NOT NULL,
  `relation` varchar(100) NOT NULL,
  `rname` varchar(200) NOT NULL,
  `rage` varchar(11) NOT NULL,
  `rdob` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crelatives`
--

INSERT INTO `crelatives` (`id`, `custid`, `relation`, `rname`, `rage`, `rdob`) VALUES
(1, '7', 'Wife', 'Dfdsf', '35', '2024-06-11'),
(2, '7', 'Daughter', 'Ddddd', '9', '2024-06-06'),
(4, '7', 'Father', 'sdfsdf', '76', '2024-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(590) NOT NULL,
  `address` text NOT NULL,
  `contactno` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `landmark` varchar(500) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created` varchar(500) NOT NULL,
  `modified` varchar(500) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `anniversaryDate` varchar(100) NOT NULL,
  `custRemarks` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `address`, `contactno`, `email`, `landmark`, `status`, `created`, `modified`, `dob`, `anniversaryDate`, `custRemarks`) VALUES
(1, 'Renu', 'Renu Bhavan 1', '98765432901', 'renu@gmail.com1', 'neat thomson bakery,manjadi,thiruvalla1', 'Active', 'May 11,2024 04:18:01 pm', 'May 11,2024 05:14:02 pm', '', '', ''),
(4, 'Renuka Menon', 'chengennur', '04792456738', 'renu@gmail.com', 'Sadkdsadff', 'Active', 'Jun 13,2024 09:56:23 am', 'Jun 13,2024 09:56:23 am', '', '', ''),
(5, 'Manish Kumar', 'Mlpy', '9876545678', 'manish@gmail.com', 'Askjfkasfaf', 'Active', 'Jun 13,2024 09:57:07 am', 'Jun 13,2024 09:57:07 am', '', '', ''),
(6, 'Karthik Raj', 'chengannasery', '8765943210', 'karthu@gmail.com', 'Ijfeworewtewt', 'Active', 'Jun 13,2024 09:57:45 am', 'Jun 13,2024 09:57:45 am', '', '', ''),
(7, 'Rrrrr n bn', 'rrrr', '444444444', 'fdsfsrewtreterter@2x.com', 'Sreerewrewt Retert Retert Dgerter Fdgerery', 'Active', 'Jun 17, 2024 10:58:04 am', 'Jun 17, 2024 02:42:45 pm', '2024-06-12', '2024-06-14', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `custid` varchar(11) NOT NULL,
  `additional_contact` text NOT NULL,
  `order_date` varchar(50) NOT NULL,
  `delivery_date` varchar(50) NOT NULL,
  `delivery_time` varchar(50) NOT NULL,
  `additinal_location` text NOT NULL,
  `containers` text NOT NULL,
  `container_status` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created` varchar(200) NOT NULL,
  `modified` varchar(200) NOT NULL,
  `total_amount` varchar(500) NOT NULL,
  `orderType` varchar(100) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `gmaplocation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `custid`, `additional_contact`, `order_date`, `delivery_date`, `delivery_time`, `additinal_location`, `containers`, `container_status`, `status`, `created`, `modified`, `total_amount`, `orderType`, `branch`, `gmaplocation`) VALUES
(8, '1', 'efewtwetewtetew', '2024-06-12', '2024-06-18', '08:58', 'sgasgasgas dsgdsgsdg sdgsdgsdg sdgdsg', 'Dsfdsgsd', 'Regained', 'Active', 'Jun 13, 2024 10:01:17 am', 'Jun 13, 2024 10:01:17 am', '550.00', 'Domestic', 'Kumbanad', 'Sdfasfasfa'),
(9, '5', 'weqweqwr ewtwetwet dsfewgt gerwgtwe ergerterg ', '2024-06-04', '2024-06-20', '02:00', 'dsgdsgdsg', 'Sfasfasf', 'Regained', 'Active', 'Jun 13, 2024 10:09:35 am', 'Jun 13, 2024 10:09:35 am', '1150.00', 'International', 'Pulimootil', 'Fdsfsd'),
(10, '1', 'asdasf', '2024-05-29', '2024-05-30', '12:00', 'dfsgdsfhgsfh', 'Sdgfdsg', 'Regained', 'Active', 'Jun 13, 2024 10:11:12 am', 'Jun 13, 2024 10:11:12 am', '700.00', 'Domestic', 'Kumbanad', 'Fdgdfg'),
(11, '1', '', '2024-05-31', '2024-06-01', '10:00', '', 'Efarerqer', 'Regained', 'Active', 'Jun 13, 2024 10:12:09 am', 'Jun 13, 2024 10:12:09 am', '1400.00', 'Domestic', 'Kumbanad', ''),
(12, '1', '', '2024-06-02', '2024-06-02', '10:00', '', 'Dsfdsgf', 'Dispatched', 'Active', 'Jun 13, 2024 10:13:26 am', 'Jun 13, 2024 10:13:26 am', '1750.00', 'Domestic', 'Kumbanad', ''),
(13, '1', 'sdfsdfsf', '2024-06-04', '2024-06-04', '04:00', '', 'Dsgsdg', 'Dispatched', 'Active', 'Jun 13, 2024 10:29:48 am', 'Jun 13, 2024 10:29:48 am', '200.00', 'Domestic', 'Kumbanad', 'Vdfgdfg'),
(14, '1', '', '2024-06-07', '2024-06-07', '10:00', '', 'Dfgfsg', 'Dispatched', 'Active', 'Jun 13, 2024 10:30:40 am', 'Jun 13, 2024 10:30:40 am', '1050.00', 'Domestic', 'Kumbanad', 'Dfsfdsg'),
(15, '1', '', '2024-06-10', '2024-06-10', '01:00', '', 'Dsgdsg', 'Dispatched', 'Active', 'Jun 13, 2024 10:31:27 am', 'Jun 13, 2024 10:31:27 am', '250.00', 'Domestic', 'Kumbanad', 'Fdsfsf'),
(16, '1', '', '2024-06-11', '2024-06-11', '01:00', '', 'Dsgsdg', 'Regained', 'Active', 'Jun 13, 2024 10:33:54 am', 'Jun 17, 2024 02:14:27 pm', '600.00', 'Domestic', 'Kumbanad', 'Dfsfdsgdsg');

-- --------------------------------------------------------

--
-- Table structure for table `order_payments`
--

CREATE TABLE `order_payments` (
  `id` int(11) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `payment_type` varchar(500) NOT NULL,
  `mod_of_pay` varchar(500) NOT NULL,
  `paid_amount` varchar(500) NOT NULL,
  `paid_date` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_payments`
--

INSERT INTO `order_payments` (`id`, `order_id`, `payment_type`, `mod_of_pay`, `paid_amount`, `paid_date`) VALUES
(14, '8', 'Advance Payment', 'Gpay', '200', '2024-06-13'),
(15, '8', 'Intrim Payment', 'Gpay', '150', '2024-06-13'),
(16, '9', 'Advance Payment', 'Cash', '500', '2024-06-09'),
(17, '9', 'Final Payment', 'Gpay', '650', '2024-06-13'),
(18, '10', 'Final Payment', 'Cash', '700', '2024-05-29'),
(19, '11', 'Final Payment', 'Gpay', '1400', '2024-06-01'),
(20, '12', 'Advance Payment', 'Cash', '500', '2024-06-02'),
(21, '13', 'Intrim Payment', 'Gpay', '100', '2024-06-04'),
(22, '14', 'Intrim Payment', 'Gpay', '1000', '2024-06-07'),
(23, '15', 'Advance Payment', 'Select Payment Type', '100', '2024-06-10'),
(24, '16', 'Intrim Payment', 'Gpay', '300', '2024-06-11'),
(25, '16', 'Intrim Payment', 'Cash', '100', '2024-06-10');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` int(11) NOT NULL,
  `product_id` varchar(55) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `mrp` varchar(100) NOT NULL,
  `gst` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `order_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `product_id`, `qty`, `mrp`, `gst`, `total`, `order_id`) VALUES
(13, '4', '1', '200', '9.52', '200.00', '8'),
(14, '2', '1', '350', '16.67', '350.00', '8'),
(15, '2', '1', '350', '16.67', '350.00', '9'),
(16, '4', '4', '200', '38.10', '800.00', '9'),
(17, '2', '2', '350', '33.33', '700.00', '10'),
(18, '1', '2', '700', '66.67', '1400.00', '11'),
(19, '2', '5', '350', '83.33', '1750.00', '12'),
(20, '4', '1', '200', '9.52', '200.00', '13'),
(21, '2', '3', '350', '50.00', '1050.00', '14'),
(22, '5', '5', '50', '11.90', '250.00', '15'),
(23, '4', '3', '200', '28.57', '600.00', '16');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `pname` varchar(200) NOT NULL,
  `category` varchar(50) NOT NULL,
  `measures` varchar(100) NOT NULL,
  `size` varchar(50) NOT NULL,
  `marketing_price` varchar(50) NOT NULL,
  `mrp` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created` varchar(100) NOT NULL,
  `modified` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `pname`, `category`, `measures`, `size`, `marketing_price`, `mrp`, `status`, `created`, `modified`) VALUES
(1, 'Cake', '1', 'KG', '2', '789', '700', 'Active', 'May 13,2024 10:24:42 am', 'May 13,2024 10:24:42 am'),
(2, 'Chicken Biriyani', '4', 'No', '3', '345', '350', 'Active', 'May 13,2024 10:34:54 am', 'May 13,2024 11:07:46 am'),
(4, 'Abcd', '4', 'No', '1', '234', '200', 'Active', 'May 22,2024 12:37:39 pm', 'May 22,2024 12:37:39 pm'),
(5, 'Efgh', '3', 'G', '500', '59', '50', 'Active', 'May 22,2024 12:38:08 pm', 'May 22,2024 12:38:08 pm');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `designation` varchar(500) NOT NULL,
  `empid` varchar(500) NOT NULL,
  `cmded` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `designation`, `empid`, `cmded`) VALUES
(5, 'Manju Anand', '$2y$10$Nqqt5J7QHrKZX.Y8xB7KYucHvo297BXsYJblnQPbEfCCsD7bbqprW', 'manju@signefo.com', 'Admin', '1', 'manju'),
(6, 'Admin', '$2y$10$3Jk3JtlPsbNSifhgHxdCMur3ajHKPzf/LWSmHML6WNaNxcBVhpSwa', 'admin@divyas.com', 'Admin', '1', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crelatives`
--
ALTER TABLE `crelatives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_payments`
--
ALTER TABLE `order_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `crelatives`
--
ALTER TABLE `crelatives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_payments`
--
ALTER TABLE `order_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
