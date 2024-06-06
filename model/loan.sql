-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2024 at 06:07 AM
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
-- Database: `loan`
--

-- --------------------------------------------------------

--
-- Table structure for table `billings`
--

CREATE TABLE `billings` (
  `b_id` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  `l_id` int(10) NOT NULL,
  `b_date` date NOT NULL,
  `loaned_amount` int(50) NOT NULL,
  `interest` int(50) NOT NULL,
  `penalty` int(11) NOT NULL,
  `received_amount` int(50) NOT NULL,
  `amount_to_pay` int(50) NOT NULL,
  `due_date` date NOT NULL,
  `b_status` varchar(50) NOT NULL DEFAULT 'N/A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billings`
--

INSERT INTO `billings` (`b_id`, `id`, `l_id`, `b_date`, `loaned_amount`, `interest`, `penalty`, `received_amount`, `amount_to_pay`, `due_date`, `b_status`) VALUES
(19, 9, 32, '2024-06-06', 5000, 150, 100, 4850, 5100, '2024-06-26', 'N/A'),
(21, 9, 31, '2024-06-06', 5000, 150, 100, 4850, 5100, '2024-06-26', 'Completed'),
(22, 3, 46, '2024-06-06', 5000, 150, 0, 4850, 5000, '2024-12-05', 'Completed'),
(23, 3, 38, '2024-06-06', 5000, 150, 0, 4850, 5000, '2024-07-26', 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `l_id` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  `date` date NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `amount` int(50) NOT NULL,
  `payable_months` int(10) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `note` varchar(1000) NOT NULL DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`l_id`, `id`, `date`, `transaction_id`, `amount`, `payable_months`, `status`, `note`) VALUES
(31, 9, '2024-05-26', 'TXN1716680986199', 5000, 1, 'Approved', 'None'),
(32, 9, '2024-05-26', 'TXN1716681080825', 5000, 1, 'Approved', 'None'),
(38, 3, '2024-05-26', 'TXN1716723024601', 5000, 2, 'Approved', 'None'),
(46, 3, '2024-06-05', 'TXN1717601099867', 5000, 6, 'Approved', 'None'),
(47, 26, '2024-06-05', 'TXN1717619786805', 5000, 1, 'Rejected', 'No profile'),
(48, 26, '2024-06-05', 'TXN1717622696495', 5000, 3, 'Pending', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `n_id` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `savings`
--

CREATE TABLE `savings` (
  `s_id` int(10) NOT NULL,
  `s_date` date NOT NULL,
  `s_transaction_id` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `s_amount` int(50) NOT NULL,
  `current_amount` int(50) NOT NULL,
  `s_status` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `savings`
--

INSERT INTO `savings` (`s_id`, `s_date`, `s_transaction_id`, `category`, `s_amount`, `current_amount`, `s_status`) VALUES
(1, '2024-06-05', 'TXN1716723024608', 'Deposit', 500, 5000, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `acc_type` enum('Basic','Premium') DEFAULT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `bank_account` varchar(50) NOT NULL,
  `card_holder` varchar(100) NOT NULL,
  `tin_number` varchar(20) NOT NULL,
  `company_working` varchar(100) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `company_contact` varchar(20) NOT NULL,
  `position` varchar(100) NOT NULL,
  `money_earnings` decimal(10,2) DEFAULT NULL,
  `proof_of_billing` varchar(255) NOT NULL,
  `valid_id` varchar(255) NOT NULL,
  `coe` varchar(255) NOT NULL,
  `profile_img` varchar(255) NOT NULL DEFAULT '../controller/uploads/default_profile.png',
  `registration_status` varchar(20) NOT NULL DEFAULT 'Pending',
  `rejection_timestamp` datetime DEFAULT NULL,
  `blocked` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `user_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `acc_type`, `f_name`, `l_name`, `email`, `password`, `phone`, `address`, `birthdate`, `gender`, `age`, `bank_name`, `bank_account`, `card_holder`, `tin_number`, `company_working`, `company_name`, `company_address`, `company_contact`, `position`, `money_earnings`, `proof_of_billing`, `valid_id`, `coe`, `profile_img`, `registration_status`, `rejection_timestamp`, `blocked`, `status`, `user_type`) VALUES
(2, '', 'Mark Eliezon', 'Aniñon', 'eliezonmcquenn@gmail.com', '$2y$10$.6GaAuWqrO7Ff6.lbF5kNeHzfv5d3SG.JkPfV03lVo5tIilmoIJcO', '09506832657', 'Tungkop, Minglanilla,Cebu', '2000-12-12', 'Male', 23, 'UNION BANK', '', '', '', '', '', '', '', '', NULL, '', '', '', '../controller/uploads/mark.jpg', 'Approved', NULL, NULL, NULL, 'Admin'),
(3, 'Premium', 'Maudy', 'Saylanon', 'maudy@gmail.com', '$2y$10$gY6tiT0kC4gDmUM.skixZ.16ty2ZeMP.PU2jwfmEPxfRLWioBitfC', '09502115285', 'Pancil, Barili, Cebu', '2002-07-20', 'Female', 21, 'UNION BANK', '101002', 'Maudy', '101002', 'SCC', 'Apollo', 'address', '101001', 'Documenter', 5000.00, '../controller/uploads/POB.jpg', '../controller/uploads/validID.jpg', '../controller/uploads/coe.jpg', '../controller/uploads/maudy.png', 'Approved', NULL, '', 'Active', ''),
(9, 'Basic', 'Mark Eliezon ', 'Aniñon', 'markeliezon12@gmail.com', '$2y$10$GcYCtd1ZleiDkDNz4xa8JeSsRbKO0zFaiEIKaK48snzRGTjg2fx5y', '09565711052', 'Tungkop, Minglanilla, Cebu', '2000-12-12', 'Male', 23, 'RGB BANK', '1011000011', 'Mark', '123-456-789', 'Delonix', 'Delonix', ' 1234 Business Park, Cebu City', '(032) 123-4567', 'Front-end Developer', 50000.00, '../controller/uploads/POB.jpg', '../controller/uploads/validID.jpg', '../controller/uploads/coe.jpg', '../controller/uploads/mark.jpg', 'Approved', NULL, '', 'Active', ''),
(15, 'Basic', 'New ', 'New', 'new@gmail.com', '$2y$10$BV/4AKTsfR3AgGZXfNIK/e4ITeB6COzK20Ome5VXmynbaHnlCQJe.', '09506832656', 'Tungkop, Minglanilla, Cebu', '2016-07-15', 'Male', 7, 'UNION BANK', '101001', 'Rex', '101001', 'Mike', 'SCC', 'Cebu, City', '101001', 'Front-end Developer', 5000.00, '../controller/uploads/POB.jpg', '../controller/uploads/validID.jpg', '../controller/uploads/coe.jpg', '', 'Pending', NULL, '', NULL, NULL),
(26, 'Basic', 'Japhzel', 'Mojado', 'japhzel@gmail.com', '$2y$10$89f1tIz.IcWJabPotS6ZYOoeYKPAelv9I407Tj/6Rtl.R4rnH2Usu', '0952451232', 'Naga, Cebu', '2001-05-14', 'Male', 23, 'RGB BANK', '1011000011', 'Japhzel', '86876', 'Software Consultancy Corporation', 'Software Consultancy Corporation', ' 1234 Business Park, Cebu City', '(032) 123-4567', 'Front-end Developer', 0.00, '../controller/uploads/pob.jpg', '../controller/uploads/validID.JPG', '../controller/uploads/COE.jpg', '../controller/uploads/default_profile.png', 'Approved', NULL, '', 'Active', NULL),
(28, 'Premium', 'Polar', 'Sky', 'polar@gmail.com', '$2y$10$6qrPSy/02kbFQL9x5tiHE.pwqzO8Swj5t83Bl8VYp8TQUOjKr0Y/G', '09506832656', 'Tungkop, Minglanilla, Cebu', '2023-03-17', 'Female', 1, 'UNION BANK', '1011000011', 'Mark', '561008', 'Software Consultancy Corporation', 'Software Consultancy Corporation', ' 1234 Business Park, Cebu City', '(032) 123-4567', 'asdasfsgdf', 5000.00, '../controller/uploads/372127323_821496226081793_4430819587260625423_n.jpg', '../controller/uploads/372127323_821496226081793_4430819587260625423_n.jpg', '../controller/uploads/372127323_821496226081793_4430819587260625423_n.jpg', '../controller/uploads/polar.jpg', 'Rejected', '2024-06-05 22:47:25', '', NULL, NULL),
(29, 'Basic', 'Test ', 'Test', 'test@gmail.com', '$2y$10$h3mLx/nOO8GOUOmnH.s95.zqFAJa2678KJFQUgvqEPrEAim4sGKUi', '0956751876', 'Tungkop, Minglanilla, Cebu', '2007-10-17', 'Male', 16, 'RGB BANK', '1011000011', 'Mark', '86876', 'Software Consultancy Corporation', 'Software Consultancy Corporation', 'address', 'dfsdfsd', 'saherfr', 50000.00, '../controller/uploads/4cda0fc3dda9007292a12792a3679838.png', '../controller/uploads/4cda0fc3dda9007292a12792a3679838.png', '../controller/uploads/4cda0fc3dda9007292a12792a3679838.png', '../controller/uploads/default_profile.png', 'Rejected', '2024-06-05 22:58:47', 'Blocked', NULL, NULL),
(30, 'Premium', 'John', 'Doe', 'johndoe@gmail.com', '$2y$10$BJefIn8BiKRAmoEBVH307.r6v/w4nK1bAt2lD8klHzIVrGKFhQa4O', '0956152148', 'Naga, Cebu', '2012-08-17', 'Male', 11, 'What Bank', '208948', 'Joe', '101001', 'Software Consultancy Corporation', 'Software Consultancy Corporation', ' 1234 Business Park, Cebu City', '(032) 123-4567', ' cwerherter', 50000.00, '../controller/uploads/csplogo.png', '../controller/uploads/csplogo1.png', '../controller/uploads/eloan.png', '../controller/uploads/default_profile.png', 'Pending', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billings`
--
ALTER TABLE `billings`
  ADD PRIMARY KEY (`b_id`),
  ADD KEY `billings_ibfk_1` (`id`),
  ADD KEY `billings_ibfk_2` (`l_id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`l_id`),
  ADD KEY `loanss_ibfk_1` (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`n_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `savings`
--
ALTER TABLE `savings`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `l_id` (`s_transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billings`
--
ALTER TABLE `billings`
  MODIFY `b_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `l_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `n_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `savings`
--
ALTER TABLE `savings`
  MODIFY `s_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `billings`
--
ALTER TABLE `billings`
  ADD CONSTRAINT `billings_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `billings_ibfk_2` FOREIGN KEY (`l_id`) REFERENCES `loans` (`l_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
