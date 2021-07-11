-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2021 at 06:11 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stockbarang`
--

-- --------------------------------------------------------

--
-- Table structure for table `keluar`
--

CREATE TABLE `keluar` (
  `idkeluar` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `penerima` varchar(25) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keluar`
--

INSERT INTO `keluar` (`idkeluar`, `idbarang`, `tanggal`, `penerima`, `qty`) VALUES
(6, 2, '2021-07-09 01:15:48', 'Santos', 80),
(8, 7, '2021-07-09 01:14:53', 'Toko jajanhp', 150),
(9, 11, '2021-07-09 01:37:27', 'Toko RS comp', 50),
(10, 10, '2021-07-09 03:33:02', 'Toko Sunta', 100),
(11, 13, '2021-07-11 04:10:10', 'Toko Elect Ros', 50);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `iduser` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`iduser`, `email`, `password`) VALUES
(1, 'mferrymdr@gmail.com', 'Password'),
(2, 'fer@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NULL DEFAULT current_timestamp(),
  `keterangan` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idbarang`, `tanggal`, `keterangan`, `qty`) VALUES
(17, 7, '2021-07-09 00:45:20', 'baba', 300),
(18, 11, '2021-07-09 02:05:04', 'baba', 500),
(19, 9, '2021-07-09 03:20:51', 'Sinta', 60),
(20, 10, '2021-07-09 03:28:59', 'sinta', 51),
(22, 14, '2021-07-11 04:09:23', 'Baba', 3),
(23, 13, '2021-07-11 04:10:35', 'Sandi', 150);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `idbarang` int(11) NOT NULL,
  `namabarang` varchar(50) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`idbarang`, `namabarang`, `deskripsi`, `stock`) VALUES
(2, 'RAM 8 GB Samsung', 'RAM 8 GB Samsung dual channel 4x2', 100),
(5, 'Mouse Robot', 'Mouse Robot Wireless Model M210', 150),
(7, 'Keyboard Logitech Pro X ', 'Gaming Keyboard', 450),
(9, 'Charger Lenovo Type C', 'Charger Leptop Type C 65W', 210),
(10, 'Xiaomi Mi Wifi Router 4C ', 'Xiaomi Mi Wifi Router 4C Smart Router 2.4GHz 64MB 4 Antennas', 101),
(11, 'Plilips Mouse Wireless', 'Plilips Mouse Wireless M-374', 500),
(12, 'Vention Kabel LAN RJ45', 'Vention Kabel LAN RJ45 Gigabit Ethernet Cat6 - 5 meter', 100),
(13, 'Vention Hub USB 3.0 4-Port ', 'Vention Hub USB 3.0 4-Port - for Computer & Laptop cable length 15 cm', 150),
(14, 'Lenovo Yoga 6 Ryzen 5 Pro 4650U 16GB SSD 512 ', 'Lenovo Yoga 6 Ryzen 5 Pro 4650U RAM 16GB SSD 512GB Windows 10', 13),
(15, 'Asus Vivobook 14 K413 Intel i7-10510U', 'Asus Vivobook 14 K413 RAM 8GB SSD 512GB/FHD/Win 10', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`idkeluar`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idbarang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keluar`
--
ALTER TABLE `keluar`
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
