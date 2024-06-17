-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2023 at 03:22 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tgecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `delivery_id` int(11) NOT NULL,
  `delivery_scheduled_date` date NOT NULL,
  `delivery_dispatched_date` date DEFAULT NULL,
  `delivery_completed_date` date DEFAULT NULL,
  `delivery_agent_id` int(11) NOT NULL,
  `delivery_status` int(11) DEFAULT 4
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`delivery_id`, `delivery_scheduled_date`, `delivery_dispatched_date`, `delivery_completed_date`, `delivery_agent_id`, `delivery_status`) VALUES
(1, '2022-11-25', '2022-11-24', '2022-11-25', 2, 0),
(2, '2022-11-08', '2022-11-07', '2022-11-08', 1, 1),
(4, '2022-11-30', '2023-01-14', '2023-01-14', 3, 1),
(7, '2022-12-01', '2023-01-18', '2023-01-18', 5, 1),
(8, '2022-11-29', '2022-11-28', '2022-11-29', 1, 1),
(9, '2022-12-07', '2022-12-06', '2022-12-07', 9, 1),
(10, '2023-01-12', '2023-01-11', '2023-01-18', 2, 1),
(11, '2023-01-23', '2023-01-16', '2023-01-16', 10, 1),
(12, '2023-01-27', '2023-01-18', NULL, 1, 0),
(13, '2023-01-16', '2023-01-18', '2023-01-18', 3, 1),
(14, '2023-01-16', '2023-01-14', '2023-01-14', 1, 1),
(15, '2023-02-17', '2023-01-18', '2023-01-18', 3, 1),
(16, '2023-01-30', NULL, NULL, 2, 1),
(17, '2023-02-01', NULL, NULL, 9, 0),
(18, '2023-02-03', '2023-01-20', NULL, 5, 2),
(19, '2023-02-01', NULL, NULL, 2, 3),
(20, '2023-01-27', '2023-01-20', NULL, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `deliveryagent`
--

CREATE TABLE `deliveryagent` (
  `agent_id` int(11) NOT NULL,
  `agent_name` varchar(128) NOT NULL,
  `agent_location` varchar(128) NOT NULL,
  `agent_address` varchar(256) NOT NULL,
  `agent_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deliveryagent`
--

INSERT INTO `deliveryagent` (`agent_id`, `agent_name`, `agent_location`, `agent_address`, `agent_status`) VALUES
(1, 'Sheneli', 'Walpola', '169/420, Angoda Road, Walpola', 1),
(2, 'Dulan', 'Wijerama', '42, Wijerama Junction', 1),
(3, 'Ayesh', 'Nugegoda', '44, Fernando road, Nugegoda', 1),
(4, 'Ayesh', 'Nugegoda', '44, Fernando road, Nugegoda', 0),
(5, 'Sithike Fernando', 'Polonnaruwa', '44, Don\'s road, Nugegoda', 1),
(9, 'Imthishan', 'Borella', '420, Platinum road, Borella', 1),
(10, 'James Turnkey', 'Godagama', '48, Cluber\'s road, Godagama', 1),
(11, 'Inshaf', 'Colombo 06', '106, Sanath Jayasooriya Mawatha, Colombo 06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(11) NOT NULL,
  `emp_fname` varchar(128) NOT NULL,
  `emp_lname` varchar(128) NOT NULL,
  `emp_address` text NOT NULL,
  `emp_dob` date NOT NULL,
  `emp_nic` varchar(12) NOT NULL,
  `emp_email1` varchar(128) NOT NULL,
  `emp_email2` varchar(128) DEFAULT 'N/A',
  `emp_telno1` varchar(20) NOT NULL,
  `emp_telno2` varchar(20) DEFAULT 'N/A',
  `emp_job_id` int(11) NOT NULL,
  `emp_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_fname`, `emp_lname`, `emp_address`, `emp_dob`, `emp_nic`, `emp_email1`, `emp_email2`, `emp_telno1`, `emp_telno2`, `emp_job_id`, `emp_status`) VALUES
(1, 'Amy', 'Pascal', '123D, Wackwella road, Galle', '1983-02-28', '123412341234', 'amypascal@gmail.com', 'N/A', '0718252477', 'N/A', 2, 1),
(3, 'Sasha', 'Blouse', '46, Titan road, Shiganshina', '1990-07-13', '123412341111', 'sasha@yahoo.com', 'N/A', '0718252467', 'N/A', 1, 1),
(4, 'Menuka', 'Dulneth', '9D, Ferdinand road, Kollupitiya', '2023-01-13', '123312341234', 'menuka123@gmail.com', 'N/A', '0718352477', 'N/A', 1, 1),
(5, 'Vidun', 'Perera', '33, Pencil throwing road, Sindukiyawala', '2002-02-14', '123439341234', 'vidun@gmail.com', 'N/A', '0714352477', 'N/A', 5, 1),
(6, 'Sasindu ', 'Kalu', '125, Nangi road, Dehiwala', '2006-02-08', '323412341234', 'sasu@pedio.com', 'N/A', '0719252477', 'N/A', 3, 1),
(7, 'Heshan', 'Kotupitiya', '420, Delwala road, Cook\'s place', '2006-07-24', '123412348234', 'heshanthethird@sfdealings.org', 'N/A', '0769420247', 'N/A', 6, 1),
(8, 'Mario', 'Silvera', '43, Naginna road, Kotavehera', '2005-11-17', '184612342222', 'mario123@gmail.com', 'N/A', '077458821', 'N/A', 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_id` int(11) NOT NULL,
  `job_name` varchar(128) NOT NULL,
  `job_description` text NOT NULL,
  `job_department` varchar(128) NOT NULL,
  `job_salary` decimal(12,2) NOT NULL,
  `job_OTPay` decimal(7,2) NOT NULL,
  `job_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_id`, `job_name`, `job_description`, `job_department`, `job_salary`, `job_OTPay`, `job_status`) VALUES
(1, 'Web Developer', 'Will be responsible for maintaining the company website as well as keeping it up to date with the latest technologies and security measures.', 'IT Department', 120000.00, 2000.00, 1),
(2, 'Software Developer', 'Will be responsible for designing, developing and maintain software applications for the company.', 'IT Department', 125000.00, 2200.00, 1),
(3, 'Marketing Manager', 'Will be responsible for conducting marketing campaigns for the company and increasing sales.', 'Marketing Department', 165000.00, 1800.00, 1),
(5, 'Data Scientist', 'Sample', 'IT Department', 150000.00, 3500.00, 1),
(6, 'Finance Manager', 'Sample', 'Finance Department', 100000.00, 2000.00, 1),
(7, 'Database Admin', 'Sample', 'IT Department', 169000.00, 2500.00, 1),
(8, 'Network Administrator', 'Sample Extra Modification', 'IT Department', 138000.00, 3400.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_amount` decimal(12,2) NOT NULL,
  `payment_order_id` int(11) DEFAULT NULL,
  `payment_comment` text DEFAULT NULL,
  `payment_supplier_id` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_date`, `payment_amount`, `payment_order_id`, `payment_comment`, `payment_supplier_id`, `payment_status`) VALUES
(1, '2022-07-12', 2250000.00, 2, NULL, 2, 1),
(5, '2022-07-12', 180000000.00, 3, NULL, 3, 1),
(6, '2022-07-12', 10000.00, NULL, 'Overdue Interest', 3, 1),
(7, '2022-07-14', 325000000.00, 6, NULL, 7, 1),
(8, '2022-07-03', 1000.00, NULL, 'Overdue Interest', 4, 1),
(9, '2022-07-20', 30000.00, 8, NULL, 2, 1),
(10, '2022-07-21', 3000000.00, 9, NULL, 3, 1),
(11, '2022-07-27', 2250000.00, 1, NULL, 3, 1),
(12, '2022-07-27', 6750000.00, 7, NULL, 3, 1),
(13, '2022-07-27', 600000.00, 9, NULL, 3, 1),
(14, '2022-07-27', 600000.00, 4, NULL, 4, 1),
(15, '2022-07-27', 18000000.00, 5, NULL, 4, 1),
(16, '2022-07-27', 6570000.00, 8, NULL, 2, 1),
(17, '2022-11-20', 1000.00, 10, NULL, 6, 1),
(18, '2022-11-27', 100000.00, 12, NULL, 9, 1),
(19, '2023-01-08', 1000.00, 13, NULL, 3, 1),
(20, '2023-01-13', 100000.00, 13, '', 6, 1),
(21, '2023-01-13', 100000.00, NULL, 'Testing', 6, 1),
(22, '2023-01-13', 100000.00, 13, 'Testing', 6, 1),
(23, '2023-01-20', 15000.00, 15, '', 6, 1),
(24, '2023-01-20', 1000.00, NULL, 'Overdue Interest', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `payroll_emp_id` int(11) NOT NULL,
  `payroll_year` year(4) NOT NULL,
  `payroll_month` int(2) NOT NULL,
  `payroll_days_attended` int(2) NOT NULL DEFAULT 0,
  `payroll_OTHours` int(11) NOT NULL DEFAULT 0,
  `payroll_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `payroll_paid_status` int(11) NOT NULL DEFAULT 0,
  `payroll_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`payroll_emp_id`, `payroll_year`, `payroll_month`, `payroll_days_attended`, `payroll_OTHours`, `payroll_amount`, `payroll_paid_status`, `payroll_status`) VALUES
(1, '2022', 7, 20, 1, 127200.00, 1, 1),
(1, '2022', 8, 22, 4, 133800.00, 1, 1),
(1, '2022', 9, 0, 0, 0.00, 0, 1),
(1, '2022', 10, 20, 3, 131600.00, 1, 1),
(1, '2022', 11, 0, 0, 0.00, 0, 1),
(1, '2022', 12, 0, 0, 0.00, 0, 1),
(1, '2023', 1, 27, 3, 131600.00, 1, 1),
(1, '2023', 2, 0, 0, 0.00, 0, 1),
(3, '2022', 7, 21, 5, 130000.00, 1, 1),
(3, '2022', 8, 0, 0, 0.00, 0, 1),
(3, '2022', 9, 23, 7, 134000.00, 1, 1),
(3, '2022', 10, 0, 0, 0.00, 0, 1),
(3, '2022', 11, 28, 1, 122000.00, 1, 1),
(3, '2022', 12, 0, 0, 0.00, 0, 1),
(3, '2023', 1, 0, 0, 0.00, 0, 1),
(3, '2023', 2, 0, 0, 0.00, 0, 1),
(4, '2023', 1, 0, 0, 0.00, 0, 1),
(4, '2023', 2, 0, 0, 0.00, 0, 1),
(5, '2023', 1, 0, 0, 0.00, 0, 1),
(5, '2023', 2, 0, 0, 0.00, 0, 1),
(6, '2023', 1, 0, 0, 0.00, 0, 1),
(6, '2023', 2, 0, 0, 0.00, 0, 1),
(7, '2023', 1, 30, 8, 116000.00, 1, 1),
(7, '2023', 2, 0, 0, 0.00, 0, 1),
(8, '2023', 1, 0, 0, 0.00, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_category` varchar(128) NOT NULL,
  `product_brand` varchar(256) NOT NULL,
  `product_name` varchar(256) NOT NULL,
  `product_price` decimal(12,2) NOT NULL,
  `product_image` text NOT NULL,
  `product_stock_status` int(11) NOT NULL DEFAULT 0,
  `product_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_category`, `product_brand`, `product_name`, `product_price`, `product_image`, `product_stock_status`, `product_status`) VALUES
(1, 'Processor', 'Intel', 'Intel Core i7 10750H', 150000.00, 'Product1.jpg', 1, 1),
(6, 'Processor', 'Intel', 'Intel Core i9 10850H', 225000.00, 'Product6.png', 1, 1),
(7, 'Phone', 'Samsung', 'Samsung Galaxy S22 Ultra', 450000.00, 'Product7.png', 1, 1),
(8, 'Laptop', 'Dell', 'Dell XPS', 600000.00, 'Product8.jpg', 1, 1),
(9, 'Processor', 'Intel', 'Core i7 10750H', 150000.00, 'Product9.jpg', 0, 0),
(10, 'Processor', 'Intel', 'Core i9 10850', 210000.00, 'Product10.png', 0, 0),
(11, 'Phone', 'Apple ', 'Apple iPhone 13', 300000.00, 'Product11.png', 0, 1),
(14, 'Processor', 'Intel', 'Intel Core i7 9750H', 120000.00, 'Product14.jpg', 1, 1),
(15, 'Graphics Card', 'Nvidia', 'Nvidia RTX 3090 24GB', 6500000.00, 'Product15.jpg', 1, 1),
(16, 'Phone', 'OnePlus', 'One Plus Nord CE 5G (8GB + 128GB)', 220000.00, 'Product16.jpg', 1, 1),
(19, 'Phone', 'Apple', 'Apple iPhone 13 Pro', 320000.00, 'Product19.jpg', 1, 1),
(22, 'Phone', 'Apple', 'Apple iPhone 12 Pro', 240000.00, 'Product22.webp', 1, 1),
(23, 'Laptop', 'MSI', 'MSI GF63 ', 520000.00, 'Product23.jpg', 1, 1),
(24, 'Laptop', 'Asus', 'Asus ROG Strix G15', 800000.00, 'Product24.png', 1, 1),
(25, 'Laptop', 'HP', 'HP AMD Ryzen 3 3250U', 280000.00, 'Product25.jpg', 1, 1),
(26, 'Laptop', 'Razer', 'Razer Blade Stealth 13 (2022)', 785000.00, 'Product26.webp', 1, 1),
(27, 'Motherboard', 'ssab', 'srbsb', 500.00, 'Product27.png', 1, 0),
(28, 'Motherboard', 'eaevae', 'veavaev', 300.00, 'Product28.webp', 0, 0),
(29, 'Graphics Card', 'Nvidia', 'Nvidia RTX 2060 6GB', 300000.00, 'Product29.jpg', 1, 1),
(30, 'Laptop', 'Dell', 'Dell BB SS', 1000.00, 'Product30.jpg', 1, 1),
(32, 'Phone', 'Apple', 'iPhone 14', 1000000.00, 'Product32.webp', 1, 1),
(33, 'Tablet', 'Apple', 'ipad', 200000.00, 'Product33.jpg', 0, 0),
(34, 'Phone', 'Apple', 'iphone 7', 100000.00, 'Product34.jpg', 0, 0),
(35, 'Phone', 'Apple', 'iphone 7', 100000.00, 'Product35.jpg', 0, 0),
(36, 'Phone', 'Random2', 'Randomness2', 100000.00, 'Product36.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Clerk');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `sale_id` int(11) NOT NULL,
  `sale_product_id` int(11) NOT NULL,
  `sale_date` date NOT NULL,
  `sale_qty` int(11) NOT NULL,
  `sale_payment` decimal(12,2) NOT NULL,
  `sale_delivery_id` int(11) DEFAULT NULL,
  `sale_delivery_allocated_date` date DEFAULT NULL,
  `sale_user_id` int(11) NOT NULL,
  `sale_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`sale_id`, `sale_product_id`, `sale_date`, `sale_qty`, `sale_payment`, `sale_delivery_id`, `sale_delivery_allocated_date`, `sale_user_id`, `sale_status`) VALUES
(1, 14, '2022-07-25', 1, 120000.00, 10, '2023-01-09', 2, 1),
(2, 16, '2022-07-25', 1, 220000.00, 13, '2023-01-14', 2, 1),
(3, 15, '2022-07-25', 1, 6500000.00, 8, '2022-07-25', 2, 1),
(4, 29, '2022-07-25', 1, 300000.00, 20, '2023-01-20', 2, 1),
(5, 29, '2022-07-25', 1, 300000.00, 20, '2023-01-20', 2, 1),
(6, 29, '2022-07-25', 1, 300000.00, 20, '2023-01-20', 2, 1),
(7, 29, '2022-07-26', 2, 600000.00, 20, '2023-01-20', 2, 1),
(8, 16, '2022-07-26', 3, 660000.00, 20, '2023-01-20', 2, 1),
(9, 16, '2022-07-26', 2, 440000.00, 20, '2023-01-20', 2, 1),
(10, 16, '2022-07-26', 4, 880000.00, 20, '2023-01-20', 2, 1),
(11, 29, '2022-07-26', 7, 2100000.00, 20, '2023-01-20', 2, 1),
(12, 16, '2022-07-26', 2, 440000.00, 20, '2023-01-20', 2, 1),
(13, 6, '2022-08-26', 2, 450000.00, 9, '2022-07-26', 2, 1),
(14, 15, '2022-07-27', 1, 6500000.00, 19, '2023-01-20', 2, 1),
(15, 6, '2022-09-10', 3, 675000.00, 19, '2023-01-20', 2, 1),
(16, 16, '2022-09-18', 3, 660000.00, 19, '2023-01-20', 2, 1),
(17, 15, '2022-11-19', 2, 13000000.00, 19, '2023-01-20', 2, 1),
(18, 32, '2022-11-27', 3, 3000000.00, 4, '2023-01-27', 2, 1),
(19, 33, '2023-01-08', 4, 800000.00, 15, '2023-01-18', 2, 1),
(20, 14, '2023-01-14', 1, 120000.00, 14, '2023-01-14', 2, 1),
(21, 6, '2023-01-16', 2, 450000.00, 15, '2023-01-18', 2, 1),
(22, 32, '2023-01-16', 1, 1000000.00, 11, '2023-01-16', 16, 1),
(23, 6, '2023-01-16', 1, 225000.00, 15, '2023-01-18', 2, 1),
(24, 16, '2023-01-16', 3, 660000.00, 15, '2023-01-18', 2, 1),
(25, 15, '2023-01-16', 2, 13000000.00, 18, '2023-01-20', 2, 1),
(26, 29, '2023-01-18', 1, 300000.00, NULL, NULL, 2, 1),
(27, 14, '2023-01-18', 1, 120000.00, NULL, NULL, 2, 1),
(28, 16, '2023-01-18', 1, 220000.00, NULL, NULL, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL,
  `stock_product_id` int(11) NOT NULL,
  `stock_qty_max` int(11) NOT NULL,
  `stock_qty_buffer` int(11) NOT NULL,
  `stock_qty_current` int(11) NOT NULL DEFAULT 0,
  `stock_created_date` date NOT NULL,
  `stock_updated_date` date NOT NULL,
  `stock_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `stock_product_id`, `stock_qty_max`, `stock_qty_buffer`, `stock_qty_current`, `stock_created_date`, `stock_updated_date`, `stock_status`) VALUES
(1, 1, 250, 100, 0, '2022-07-10', '2022-07-10', 1),
(6, 6, 200, 75, 42, '2022-07-10', '2023-01-16', 1),
(7, 7, 500, 250, 0, '2022-07-05', '2022-07-05', 1),
(8, 8, 300, 150, 0, '2022-07-19', '2022-07-19', 1),
(14, 14, 200, 100, 152, '2022-07-10', '2023-01-18', 1),
(15, 15, 150, 25, 54, '2022-07-12', '2023-01-16', 1),
(16, 16, 200, 50, 11, '2022-07-16', '2023-01-18', 1),
(19, 19, 200, 50, 0, '2022-07-21', '2022-07-21', 1),
(22, 22, 200, 50, 0, '2022-07-21', '2022-07-21', 1),
(23, 23, 50, 10, 0, '2022-07-21', '2022-07-21', 1),
(24, 24, 20, 4, 0, '2022-07-21', '2022-07-21', 1),
(25, 25, 200, 50, 0, '2022-07-21', '2022-07-21', 1),
(26, 26, 200, 50, 0, '2022-07-21', '2022-07-21', 1),
(27, 27, 43, 3, 0, '2022-07-21', '2022-07-21', 0),
(29, 29, 100, 50, 0, '2022-07-21', '2023-01-18', 1),
(30, 30, 100, 20, 0, '2022-09-10', '2022-09-10', 1),
(32, 32, 100, 20, 56, '2022-11-27', '2023-01-16', 1),
(33, 33, 200, 100, 116, '2023-01-08', '2023-01-08', 0),
(35, 35, 100, 25, 20, '2023-01-20', '2023-01-20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stockorder`
--

CREATE TABLE `stockorder` (
  `order_id` int(11) NOT NULL,
  `order_product_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `order_qty` int(11) NOT NULL,
  `order_payment` decimal(12,2) NOT NULL,
  `order_completed_payment` decimal(12,2) NOT NULL DEFAULT 0.00,
  `order_supplier_id` int(11) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stockorder`
--

INSERT INTO `stockorder` (`order_id`, `order_product_id`, `order_date`, `order_qty`, `order_payment`, `order_completed_payment`, `order_supplier_id`, `order_status`) VALUES
(1, 6, '2022-07-10', 10, 2250000.00, 2250000.00, 3, 1),
(2, 6, '2022-07-10', 10, 2250000.00, 2250000.00, 2, 1),
(3, 8, '2022-07-13', 300, 180000000.00, 180000000.00, 3, 1),
(4, 14, '2022-07-11', 5, 600000.00, 600000.00, 4, 1),
(5, 14, '2022-07-11', 150, 18000000.00, 18000000.00, 4, 1),
(6, 15, '2022-07-12', 50, 325000000.00, 325000000.00, 7, 1),
(7, 6, '2022-07-17', 30, 6750000.00, 6750000.00, 3, 1),
(8, 16, '2022-07-17', 30, 6600000.00, 6600000.00, 2, 1),
(9, 29, '2022-07-21', 12, 3600000.00, 3600000.00, 3, 1),
(10, 15, '2022-11-19', 10, 65000000.00, 1000.00, 6, 1),
(12, 32, '2022-11-27', 30, 30000000.00, 100000.00, 9, 1),
(13, 33, '2023-01-08', 20, 4000000.00, 201000.00, 6, 1),
(14, 35, '2023-01-20', 20, 2000000.00, 0.00, 6, 1),
(15, 32, '2023-01-20', 30, 30000000.00, 15000.00, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(256) NOT NULL,
  `supplier_location` varchar(256) NOT NULL,
  `supplier_address` varchar(256) NOT NULL,
  `supplier_pending_payment` decimal(12,2) NOT NULL DEFAULT 0.00,
  `supplier_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `supplier_location`, `supplier_address`, `supplier_pending_payment`, `supplier_status`) VALUES
(2, 'Ashika Munasinghe', 'Nugegoda', '111, Church road, Nugegoda', 0.00, 0),
(3, 'ABC Traders', 'NoTown                            ', '00, NoRoad, NoTown', -11000.00, 1),
(4, 'Thumuditha stores', 'Kotuwa', '47C, Railway junction, Kotuwa', -1000.00, 1),
(6, 'Abu\'s Accessories', 'Maharagama', 'Choco lane, Peradeniya road, Maharagama', 100983000.00, 1),
(7, 'JJ Stores', 'Wattala                            ', '69C, Johannusberg road, Wattala', 0.00, 0),
(8, 'Eyasa Munasinghe', 'Mattegoda', '56B/51,Greenvelley 1st lane, Galwaladeniya Road', 0.00, 0),
(9, 'Sasindu', 'Nugegoda              ', '21, 22, Nugegoda road, Nugegoda', 29900000.00, 1),
(10, 'Eyasa Munasinghe', 'Mattegoda', '56B/51,Greenvelley 1st lane, Galwaladeniya Road', 0.00, 1),
(11, 'Chanakya Stores', 'Wellawatta              ', '312, Hapugashena road, Wellawatta', 0.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `suppliercontact`
--

CREATE TABLE `suppliercontact` (
  `supplierContact_id` int(11) NOT NULL,
  `supplierContact_type` varchar(128) NOT NULL,
  `supplierContact_value` varchar(128) NOT NULL,
  `supplierContact_supplier_id` int(11) NOT NULL,
  `supplierContact_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliercontact`
--

INSERT INTO `suppliercontact` (`supplierContact_id`, `supplierContact_type`, `supplierContact_value`, `supplierContact_supplier_id`, `supplierContact_status`) VALUES
(1, 'Email', 'ashika@gmail.com', 2, 1),
(2, 'Email', 'ashika123@gmail.com', 2, 1),
(3, 'Telephone', '0777777777', 2, 1),
(4, 'Telephone', '0717777777', 2, 1),
(5, 'Telephone', '0777777770', 2, 1),
(6, 'Email', 'NoEmail@gmail.com', 3, 1),
(7, 'Email', 'NoEmail1@gmail.com', 3, 1),
(8, 'Telephone', '0718454444', 3, 0),
(9, 'Telephone', '0718454443', 3, 1),
(10, 'Email', 'thumu@gmail.com', 4, 1),
(11, 'Telephone', '0112354789', 4, 1),
(12, 'Email', 'unreal@gmail.com', 3, 1),
(13, 'Telephone', '0717757488', 4, 1),
(14, 'Telephone', '0717757466', 3, 1),
(15, 'Telephone', '0717757489', 4, 1),
(16, 'Email', 'unreal3@gmail.com', 3, 1),
(17, 'Email', 'Thumuditha2@gmail.com', 4, 1),
(18, 'Email', 'Thumuditha4@gmail.com', 4, 1),
(19, 'Telephone', '0717757465', 4, 1),
(22, 'Email', 'abu@gmail.com', 6, 0),
(23, 'Telephone', '0112000012', 6, 1),
(24, 'Email', 'abu2@gmail.com', 6, 0),
(25, 'Email', 'abu@gmail.com', 6, 1),
(26, 'Email', 'Techmagic@gmail.com', 7, 1),
(27, 'Email', 'Techmagic2@gmail.com', 7, 1),
(28, 'Email', 'Techmagic3@gmail.com', 7, 1),
(29, 'Telephone', '0771122333', 7, 1),
(30, 'Email', 'eyasa1979@gmail.com', 8, 1),
(31, 'Telephone', '0773544499', 8, 1),
(32, 'Email', 'sasidukalu@gmail.com', 9, 1),
(33, 'Telephone', '0777448800', 9, 1),
(34, 'Email', 'sasidukalu2@gmail.com', 9, 1),
(35, 'Email', 'eyasa1979@gmail.com', 10, 1),
(36, 'Telephone', '0718363862', 10, 1),
(37, 'Email', 'chanakyastores@gmail.com', 11, 1),
(38, 'Telephone', '0113487255', 11, 1),
(39, 'Telephone', '076890547', 11, 1),
(40, 'Email', 'chanakyatest2@gmail.com', 11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_fname` varchar(64) NOT NULL,
  `user_lname` varchar(64) NOT NULL,
  `user_dob` date NOT NULL,
  `user_nic` varchar(12) NOT NULL,
  `user_image` text NOT NULL DEFAULT 'N/A',
  `user_email` varchar(128) NOT NULL,
  `user_address` varchar(512) DEFAULT NULL,
  `user_pwd` varchar(256) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `user_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_fname`, `user_lname`, `user_dob`, `user_nic`, `user_image`, `user_email`, `user_address`, `user_pwd`, `user_role_id`, `user_status`) VALUES
(1, 'Sasvidu', 'Ranthul', '2007-01-31', '785993844V', 'Profile1.png', 'amsranthul@gmail.com', 'XtremeTech', '$2y$10$nEX1EKE48HMESAYAKlsLKunf393Kqw.mI5t/7Fis35G.Q4SCKA4VG', 1, 1),
(2, 'Kamal', 'Fernand', '1977-07-05', '921456862V', 'Profile2.jpg', 'kasun@esoft.lk', '47, Koggala road, Colombo 05', '$2y$10$W3zculGsqK7QuMJkYV.I4uVfGb/uTXJshNREKPktXq7yVHAGiEYsG', 2, 1),
(3, 'Sanuka', 'Jayasuriya', '2007-05-02', '346512891100', 'N/A', 'test@gmail.com', '56, Dehivala road, Nugegoda', '$2y$10$OSx8t90.p9cNbCT/1J8wDO9AqMo/sNrek8.pRa8wZ8c96lHnBj342', 2, 1),
(4, 'Eyasa', 'Munasinghe', '1979-03-30', '346512891101', 'N/A', 'eyasa1979@gmail.com', '147C/12, Wijerama road, Colombo 07', '$2y$10$3QRah0xegvdItRz5ggaOjelqeyk/X6hlgELr/fbRX8HjUgq1ZVE0K', 2, 1),
(5, 'Inuka', 'Botheju', '2008-02-11', '346512891102', 'N/A', 'Inuka@gmail.com', '13, Elyceum Housing Complex, Mattegoda', '$2y$10$Do4f7Mbg5WTNgO62JK.ewukuB0RHSc2jYT.KX2BNrgKZ6zlj1LnVW', 2, 1),
(6, 'Azmaan', 'Nazoofar', '2007-03-08', '797979797V', 'N/A', 'AZ@gmail.com', '44, Senanayake place, Galwela', '$2y$10$PWf.RbHrxpLl13qUbtPS6uOdVF1X32YgUXB5hW9Ce/YSqqnf3/y2m', 2, 1),
(7, 'Fathong', 'Rizwan', '2006-05-30', '934456862V', 'Profile7.jpg', 'fathah@gmail.com', 'XtremeTech', '$2y$10$GkcrBK8a/igVHzj129LXGOStHFpiFhv.otx1oJ.BboyedT5FErqUi', 3, 1),
(8, 'Yehen', 'Tennakon', '1988-07-22', '111100002222', 'N/A', 'yt@esoft.lk', 'XtremeTech', '$2y$10$4Kc3N9LcJzOSwOv2WS1QC.0XMQ9FsI09OmhSimzPjv4.XbuJLVaJG', 1, 1),
(10, 'Soa', 'Jaya', '2022-07-17', '346512891107', 'N/A', 'test1@test.com', '28, Wathikanuwa road, Mattala', '$2y$10$cHcQsEAkVT7NImIzjpVi.e5V/UjFaWpOGBegyT3MQmbi08BUDhkHa', 2, 1),
(11, 'Meenu', 'Pathirana', '1984-08-08', '111100003333', 'N/A', 'meenupathirana@gmail.com', 'XtremeTech', '$2y$10$p8QU10qJcKL6rtQ93PW1W..a.uvzyv3HdlexrbwJDJp65Bjh9vgCC', 3, 1),
(12, 'Sanuk', 'Munasinghe', '2022-11-20', '111100003332', 'N/A', 'sanuksanuk@yahoo.com', 'XtremeTech', '$2y$10$bmsPS6DjLodCj8s9qKZGQeJrJXvgHvg24eDtQU3X66L9HMvKKclyu', 1, 1),
(13, 'Eyasa2', 'Munasinghe2', '1987-06-09', '446512591100', 'N/A', 'eyasa19792@gmail.com', '38, Hector Kobbakaduwa place, Pamunugama', '$2y$10$5YuqY1JTq9IytIb1fet0MeTRBTer7xZd5XO/W/9w18ObVUq91lEne', 2, 1),
(14, 'Eyasa3', 'Munasinghe3', '1972-06-14', '311512291111', 'N/A', 'eyasa19793@gmail.com', '39, Hector Kobbakaduwa place, Pamunugama', '$2y$10$stYW1rT4HlwiXwDGTOGXdu2QOtdFREJO0en1RlA9dNeBrUdG8SgTq', 2, 1),
(15, 'Thevidu', 'Tennakon', '1991-06-15', '111166002222', 'N/A', 'theviya@gmail.com', 'XtremeTech', '$2y$10$TJJ/yj1z60e2mf/Ll4O.7OxugTJhY152tuLU7MWVl3BjIGX3OcZkG', 3, 1),
(16, 'Eyasa5', 'Munasinghe5', '1984-06-16', '446696991100', 'N/A', 'eyasa19795@gmail.com', '41, Hector Kobbakaduwa place, Pamunugama', '$2y$10$jN90JIPDMc3VzxGGjd7IauIgyUGziDJIiSG8nLgAIkVoNIP9gXLy2', 2, 1),
(17, 'Manuth', 'Ramanayake', '2002-06-06', '111122229999', 'N/A', 'manuth@gmail.com', 'XtremeTech', '$2y$10$uNCa3aIMoDxBb19GNA2j8eEygknSnWl0ASEnkQTuoCiN1KWJy9PYu', 3, 1),
(18, 'Nimesh', 'Chandima', '1975-06-11', '197229098844', 'N/A', 'nimesh@gmail.com', '48, Castle Lane, Colombo 06', '$2y$10$B4K9OEVoAHWn131U1/KaEeuMY6O5YC3zWTYtnGPY4tOG.sHxIFQ3K', 2, 1),
(19, 'Shenuka', 'Perera', '2005-06-23', '346512893344', 'N/A', 'shenuka@gmail.com', '69, King\'s road, Chad\'s Avenue', '$2y$10$K4rkPebexAhskUSWmd8P6O0T/Rpfqm4Snol.7pvzmQbB.oSuSLai2', 2, 1),
(21, 'Sithmi', 'Walsooriya', '2005-06-08', '197948733844', 'N/A', 'sithi@gmail.com', '46, South Park Avenue, Papiliyana', '$2y$10$AmgLMmgSyPZ4TuLgswfBcOIP5lDkgyADx3ICqYLhMDWOq92dIO7Mi', 2, 1),
(22, 'Jungkook', 'Suga', '1996-06-19', '111100008785', 'N/A', 'jk119@gmail.com', '44, BTS road, Somewhere', '$2y$10$mqqfRiq0XAzNSVIkD3EAYe0bcWeOVSJs28MelZq9FmEYEUCSvcCv6', 2, 1),
(23, 'Eyasa77', 'Munasinghe77', '2006-06-27', '346512897777', 'N/A', 'eyasa1977@gmail.com', '56B/51,Greenvelley 1st lane, Galwaladeniya Road', '$2y$10$4Z.0s9JLAqOXviYaLhKOhu3yvQhkm2oxzxszvI3rPZLbvLtYrzQ0O', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_id`);

--
-- Indexes for table `deliveryagent`
--
ALTER TABLE `deliveryagent`
  ADD PRIMARY KEY (`agent_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`payroll_emp_id`,`payroll_year`,`payroll_month`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `stockorder`
--
ALTER TABLE `stockorder`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_product_id` (`order_product_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `suppliercontact`
--
ALTER TABLE `suppliercontact`
  ADD PRIMARY KEY (`supplierContact_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD KEY `user_role_id` (`user_role_id`),
  ADD KEY `user_role_id_2` (`user_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delivery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `deliveryagent`
--
ALTER TABLE `deliveryagent`
  MODIFY `agent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `stockorder`
--
ALTER TABLE `stockorder`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `suppliercontact`
--
ALTER TABLE `suppliercontact`
  MODIFY `supplierContact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `role`
--
ALTER TABLE `role`
  ADD CONSTRAINT `role_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user` (`user_role_id`);

--
-- Constraints for table `stockorder`
--
ALTER TABLE `stockorder`
  ADD CONSTRAINT `stockorder_ibfk_1` FOREIGN KEY (`order_product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
