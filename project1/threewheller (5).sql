-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2024 at 09:47 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `threewheller`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(5) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `father_name` varchar(20) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` int(3) NOT NULL,
  `aadhar_no` int(8) DEFAULT NULL,
  `address` varchar(20) DEFAULT NULL,
  `dl_no` varchar(20) DEFAULT NULL,
  `phone` int(10) DEFAULT NULL,
  `r_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `name`, `father_name`, `gender`, `dob`, `age`, `aadhar_no`, `address`, `dl_no`, `phone`, `r_no`) VALUES
(9, 'Khazi parveez', 'Mohammed ghousepeer', 'Male', '2003-08-31', 20, 5555555, 'Javalli pete gubbi', '555555', 2147483647, 14),
(10, 'Hari', 'Surendra', 'Male', '2003-03-02', 21, 89898989, 'Oblapura', '878787', 2147483647, 15);

-- --------------------------------------------------------

--
-- Table structure for table `login_table`
--

CREATE TABLE `login_table` (
  `user_id` int(11) NOT NULL,
  `email` varchar(20) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_table`
--

INSERT INTO `login_table` (`user_id`, `email`, `user_name`, `password`) VALUES
(111, 'admin@gmail.com', 'test@123', 'admi');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `v_id` int(5) DEFAULT NULL,
  `chassis_no` varchar(15) DEFAULT NULL,
  `engin_no` varchar(15) DEFAULT NULL,
  `r_no` int(5) NOT NULL,
  `r_date` date DEFAULT curdate(),
  `re_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`v_id`, `chassis_no`, `engin_no`, `r_no`, `r_date`, `re_date`) VALUES
(28, '444444444', '4444444444', 14, '2024-06-20', '2039-06-20'),
(29, '555555555', '454545454', 15, '2024-06-20', '2039-06-20');

-- --------------------------------------------------------

--
-- Table structure for table `vehical`
--

CREATE TABLE `vehical` (
  `v_id` int(5) NOT NULL,
  `chassis_no` varchar(15) NOT NULL,
  `engine_no` varchar(15) NOT NULL,
  `fuel_type` varchar(15) NOT NULL,
  `v_type` varchar(15) NOT NULL,
  `model_no` int(5) NOT NULL,
  `manufacturer` varchar(15) NOT NULL,
  `vehical_status` varchar(10) NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehical`
--

INSERT INTO `vehical` (`v_id`, `chassis_no`, `engine_no`, `fuel_type`, `v_type`, `model_no`, `manufacturer`, `vehical_status`) VALUES
(27, '333333333', '333333333', 'PETROL', 'Goods', 2008, 'Piaggio', 'INACTIVE'),
(28, '444444444', '4444444444', 'PETROL', 'Goods', 2008, 'Bajaj', 'ACTIVE'),
(29, '555555555', '454545454', 'PETROL', 'Passenger', 2005, 'Piaggio', 'ACTIVE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `fk_r_no` (`r_no`);

--
-- Indexes for table `login_table`
--
ALTER TABLE `login_table`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`r_no`),
  ADD KEY `fk_v_id` (`v_id`);

--
-- Indexes for table `vehical`
--
ALTER TABLE `vehical`
  ADD PRIMARY KEY (`v_id`),
  ADD UNIQUE KEY `chasis_no` (`chassis_no`),
  ADD UNIQUE KEY `engine_no` (`engine_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=01;

--
-- AUTO_INCREMENT for table `login_table`
--
ALTER TABLE `login_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `r_no` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0001;

--
-- AUTO_INCREMENT for table `vehical`
--
ALTER TABLE `vehical`
  MODIFY `v_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=01;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_r_no` FOREIGN KEY (`r_no`) REFERENCES `registration` (`r_no`);

--
-- Constraints for table `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `fk_v_id` FOREIGN KEY (`v_id`) REFERENCES `vehical` (`v_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
