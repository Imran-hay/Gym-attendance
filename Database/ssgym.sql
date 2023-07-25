-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2023 at 01:33 PM
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
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `cash` int(11) NOT NULL,
  `workingdays` int(11) NOT NULL,
  `month` int(11) DEFAULT NULL,
  `id` varchar(20) NOT NULL,
  `RegistrationDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`cash`, `workingdays`, `month`, `id`, `RegistrationDate`) VALUES
(500, 0, 2, 'SS1', '2023-08-21'),
(500, 0, 1, 'SS2', '2023-08-21'),
(1000, 13, 1, 'SS3', '2023-07-25');

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
(0x89504e470d0a1a0a0000000d49484452000000570000005701030000004b064b2f00000006504c5445ffffff00000055c2d37e000000097048597300000ec400000ec401952b0e1b000000ac49444154388dcdd2bb11c3200c06e03f47e1ce8ce035d4b152bc015ec0ac948e35b86381a473e18b22928bdd8068adea2b10e80170b5b0cc813373523cc2ac943d54bbbcc284ade3c07d7be48ee5c2688e1aaa96faa5b6a397aa256e7fb46c1fbc44ccbfdc86e176cbe94eaa697a3af376503c0e3b308598145b36af4d9ed65c52883d69963978ec18a0f83bcf34c7a459f65beaef78e1f37cd3d1f006cde5bf4d2b692efbc5d963d5d78a0f6a000f09864353340000000049454e44ae426082, 'SS1'),
(0x89504e470d0a1a0a0000000d49484452000000570000005701030000004b064b2f00000006504c5445ffffff00000055c2d37e000000097048597300000ec400000ec401952b0e1b000000a749444154388dcdd2bd11c3200c05e0e7a370678fc01aea5829de802c002bb9630dee58c2852f8aec5cec06446b555fc1cf9300785acdcc910b73563cc1042a1eaa5d093071eb3872df1ea5633930992b43d5925fb25dbd542d35fcd1f2bcf23b61f9ed6d186e17bc48f56839998f8366c24436a6acba7892ab551fa3604f9a650e9ef681a1f89c675e52d62cef3b4afe8ebdbbd7b76d7883e6e323d9409acff7bd7bacfa59f505ae790d83215238400000000049454e44ae426082, 'SS2'),
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
('SS3'),
('SS2'),
('SS2'),
('SS3'),
('SS3'),
('SS2'),
('SS2'),
('SS3'),
('SS3'),
('SS2'),
('SS2'),
('SS3'),
('SS3'),
('SS3'),
('SS3'),
('SS2'),
('SS2'),
('SS2'),
('SS2'),
('SS2'),
('SS2'),
('SS2'),
('SS2'),
('SS2'),
('SS2'),
('SS2'),
('SS3'),
('SS3'),
('SS3'),
('SS3'),
('SS3'),
('SS3'),
('SS3'),
('SS3'),
('SS3'),
('SS3'),
('SS4'),
('SS4'),
('SS4'),
('SS4'),
('SS4'),
('SS4'),
('SS4'),
('SS4'),
('SS4'),
('SS4'),
('SS4'),
('SS4'),
('SS4'),
('SS4'),
('SS4'),
('SS4'),
('SS1'),
('SS1'),
('SS2'),
('SS2'),
('SS2'),
('SS2'),
('SS2'),
('SS2'),
('SS2'),
('SS2'),
('SS2'),
('SS2'),
('SS2'),
('SS2'),
('SS2'),
('SS2'),
('SS2'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS1'),
('SS3'),
('SS3'),
('SS3');

-- --------------------------------------------------------

--
-- Table structure for table `table_attendance`
--

CREATE TABLE `table_attendance` (
  `ID` varchar(20) DEFAULT NULL,
  `ATTENDANT_NAME` varchar(40) DEFAULT NULL,
  `TIMEIN` varchar(40) DEFAULT NULL,
  `TIMEOUT` varchar(40) DEFAULT NULL,
  `LOGDATE` varchar(40) DEFAULT NULL,
  `STATUS` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_attendance`
--

INSERT INTO `table_attendance` (`ID`, `ATTENDANT_NAME`, `TIMEIN`, `TIMEOUT`, `LOGDATE`, `STATUS`) VALUES
('SS1', 'milky mohammed', '2023-07-28 21:17:05', '2023-07-28 21:17:17', '2023-07-28', '1'),
('SS1', 'milky mohammed', '2023-07-28 21:17:16', '2023-07-28 21:17:17', '2023-07-28', '1'),
('SS1', 'milky mohammed', '2023-07-29 21:19:25', '2023-07-29 21:19:32', '2023-07-29', '1'),
('SS1', 'milky mohammed', '2023-07-29 21:19:32', '2023-07-29 21:19:32', '2023-07-29', '1'),
('SS1', 'milky mohammed', '2023-08-29 18:52:37', '2023-08-29 22:15:53', '2023-08-29', '1'),
('SS1', 'milky mohammed', '2023-08-29 18:54:56', '2023-08-29 22:15:53', '2023-08-29', '1'),
('SS1', 'milky mohammed', '2023-08-29 18:56:12', '2023-08-29 22:15:53', '2023-08-29', '1'),
('SS1', 'milky mohammed', '2023-08-29 18:56:24', '2023-08-29 22:15:53', '2023-08-29', '1'),
('SS1', 'milky mohammed', '2023-08-29 19:00:06', '2023-08-29 22:15:53', '2023-08-29', '1'),
('SS1', 'milky mohammed', '2023-08-29 19:00:11', '2023-08-29 22:15:53', '2023-08-29', '1'),
('SS1', 'milky mohammed', '2023-08-29 22:15:46', '2023-08-29 22:15:53', '2023-08-29', '1'),
('SS1', 'milky mohammed', '2023-08-29 22:15:51', '2023-08-29 22:15:53', '2023-08-29', '1'),
('SS1', 'milky mohammed', '2023-08-29 22:15:55', NULL, '2023-08-29', '0'),
('SS3', 'Ale damena', '2023-07-25 14:31:08', '2023-07-25 14:31:25', '2023-07-25', '1'),
('SS3', 'Ale damena', '2023-07-25 14:31:35', NULL, '2023-07-25', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(20) NOT NULL,
  `fullname` varchar(40) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `purpose` varchar(30) DEFAULT NULL,
  `occupation` varchar(30) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `age`, `gender`, `purpose`, `occupation`, `phone`) VALUES
('SS1', 'milky mohammed', 2, 'M', 'Body bulider', 'sdfdf', '0927727196'),
('SS2', 'emran hayredin', 22, 'M', 'dfsf', 'sdfdf', '0927727196'),
('SS3', 'Ale damena', 8, 'M', 'body buliding', 'nothing', '098767564');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

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
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

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

--
-- Constraints for table `table_attendance`
--
ALTER TABLE `table_attendance`
  ADD CONSTRAINT `table_attendance_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
