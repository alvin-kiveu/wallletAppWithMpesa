-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2024 at 12:56 AM
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
-- Database: `wallet`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounbalance`
--

CREATE TABLE `accounbalance` (
  `ID` int(11) NOT NULL,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounbalance`
--

INSERT INTO `accounbalance` (`ID`, `balance`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `ID` int(11) NOT NULL,
  `MerchantRequestID` varchar(500) NOT NULL,
  `CheckoutRequestID` varchar(500) NOT NULL,
  `ResultCode` varchar(500) NOT NULL,
  `Amount` int(11) NOT NULL,
  `MpesaReceiptNumber` varchar(500) NOT NULL,
  `PhoneNumber` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`ID`, `MerchantRequestID`, `CheckoutRequestID`, `ResultCode`, `Amount`, `MpesaReceiptNumber`, `PhoneNumber`) VALUES
(3, '', '', '', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `username` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `phone` varchar(1000) DEFAULT NULL,
  `password` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `phone`, `password`) VALUES
(2, 'Alvin Kiveu', 'admin', 'alvo967@gmail.com', '254768168060', '8173306b4dda9469c6b06689a85d4c11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounbalance`
--
ALTER TABLE `accounbalance`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounbalance`
--
ALTER TABLE `accounbalance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
