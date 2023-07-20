-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2023 at 08:38 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ssgym`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(20) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `pass`) VALUES
('Admin', 'db3e90d6384bc2100ec86ed3ff88f340');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `entry` time NOT NULL,
  `exits` time NOT NULL,
  `day` date NOT NULL,
  `id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `cash` int(11) NOT NULL,
  `workingdays` int(11) NOT NULL,
  `month` date DEFAULT NULL,
  `id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`cash`, `workingdays`, `month`, `id`) VALUES
(12, 12, '0000-00-00', 'SS2'),
(12, 12, '0000-00-00', 'SS3');

-- --------------------------------------------------------

--
-- Table structure for table `qrcode`
--

CREATE TABLE `qrcode` (
  `qrcode` blob DEFAULT NULL,
  `id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qrcode`
--

INSERT INTO `qrcode` (`qrcode`, `id`) VALUES
(0x89504e470d0a1a0a0000000d49484452000000570000005701030000004b064b2f00000006504c5445ffffff00000055c2d37e000000097048597300000ec400000ec401952b0e1b000000b049444154388dcdd2b10dc4200c0550472ee8c20291b2061d2b6583840560253ad6b0c404d75144e17c912eb982336d5c3d0aa4cf37004f1b5dab4bb956123c0286841b88b639c41c4ac72e61d71e72c7805ee52b43d39cdf9bfb2d4d9f47faa9a2619df055f0b092873a2d065d940c6a76651f2209d68cf40df0c760b928ae94247fe2c17a5d6ff9ec615a9464ee73b3fb1a49f2b9bbc376ec15b7d1f1666804d1fcdfe2ec0d08e6fc2191ae929f356f5bf9fea189b46fc80000000049454e44ae426082, 'SS3');

-- --------------------------------------------------------

--
-- Table structure for table `recent`
--

CREATE TABLE `recent` (
  `ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recent`
--

INSERT INTO `recent` (`ID`) VALUES
('SS2'),
('SS2'),
('SS3'),
('SS3');

-- --------------------------------------------------------

--
-- Table structure for table `table_attendance`
--

CREATE TABLE `table_attendance` (
  `ID` varchar(255) NOT NULL,
  `ATTENDANT_NAME` varchar(50) NOT NULL,
  `TIMEIN` varchar(250) NOT NULL,
  `TIMEOUT` varchar(250) NOT NULL,
  `LOGDATE` varchar(250) NOT NULL,
  `STATUS` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_attendance`
--

INSERT INTO `table_attendance` (`ID`, `ATTENDANT_NAME`, `TIMEIN`, `TIMEOUT`, `LOGDATE`, `STATUS`) VALUES
('SS2', 'fvd dfd', '2023-07-19 09:36:05', '2023-07-19 09:36:13', '2023-07-19', '1'),
('SS3', 'dsfsdf sdfdsf', '2023-07-19 09:36:55', '2023-07-19 09:36:55', '2023-07-19', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(20) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `purpose` varchar(30) DEFAULT NULL,
  `occupation` varchar(30) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `age`, `gender`, `purpose`, `occupation`, `phone`) VALUES
('ss001', 'milky', 'mohammed', 22, 'M', 'body builder', 'student', NULL),
('SS2', 'fvd', 'dfd', 3, 'M', 'dfsf', 'sdfdf', '0927727196'),
('SS3', 'dsfsdf', 'sdfdsf', 122, 'M', 'dfsf', 'sdfsdfs', '0927727196');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qrcode`
--
ALTER TABLE `qrcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_attendance`
--
ALTER TABLE `table_attendance`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Constraints for table `plan`
--
ALTER TABLE `plan`
  ADD CONSTRAINT `plan_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Constraints for table `qrcode`
--
ALTER TABLE `qrcode`
  ADD CONSTRAINT `qrcode_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
