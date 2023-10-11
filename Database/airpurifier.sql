-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2023 at 02:23 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `airpurifier`
--

-- --------------------------------------------------------

--
-- Table structure for table `airpurifier`
--

CREATE TABLE `airpurifier` (
  `id` int(11) NOT NULL,
  `power` varchar(255) NOT NULL DEFAULT 'OFF',
  `level` varchar(25) NOT NULL DEFAULT 'Medium',
  `humidity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `airpurifier`
--

INSERT INTO `airpurifier` (`id`, `power`, `level`, `humidity`) VALUES
(1, 'OFF', 'High', 53);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `isOnline` tinyint(1) NOT NULL DEFAULT 0,
  `isBlocked` tinyint(1) NOT NULL DEFAULT 0,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `fullName`, `userName`, `birthday`, `position`, `password`, `isOnline`, `isBlocked`, `isAdmin`, `datecreated`) VALUES
(6, 'newuser4@email.com', 'New User', 'newuser', '1990-01-01', 'Developer', '$2y$10$XhxKofWF15dnsKJAEd.rSe1q7fMg.LUJgS0nc7JobzE4GYPoeurYK', 0, 0, 0, '2023-10-10 08:36:05'),
(7, 'newuser32@email.com', 'New User', 'newuser', '1990-01-01', 'Developer', '$2y$10$TkX4LJQ4xZ9P4tvqQWwdG.tGhTx1t0xLM7A4KbelSr.P2nQ5KkOtu', 0, 0, 0, '2023-10-10 08:36:32'),
(8, 'newuser32@email.com', 'New User', 'newuser', '1990-01-01', 'Developer', '$2y$10$UOvjBbOHXmiQsZZF5hW6Cu.4p2E9iAUV/cKG38NcmlydzOgb3mkku', 0, 0, 0, '2023-10-10 08:39:04'),
(9, 'newuser32@email.com', 'New User', 'newuser', '1990-01-01', 'Developer', '$2y$10$VIHsjzUIFMhD9BQypGdBIuMi4bouejgQOF6VZtZMYkIbuuHTAyE1.', 0, 0, 0, '2023-10-10 08:39:36'),
(10, 'newuser32@email.com', 'New User', 'newuser', '1990-01-01', 'Developer', '$2y$10$39TRBjaRcDkhwsck5LmqgO7lpeo2Mmz6NDzCLK9lesX45c9hbUXNy', 0, 0, 0, '2023-10-10 08:39:52'),
(11, 'newuser32@email.com', 'New User', 'newuser', '1990-01-01', 'Developer', '$2y$10$fFxcT5h.2scTcrSwF9lspO0F7Qt2/H92PtIhBF5c4IcMwg93NcrBG', 0, 0, 0, '2023-10-10 08:40:19'),
(12, 'fernan@gmail..com', 'Fernan Andaya', 'fernan', '0000-00-00', 'developer', '$2y$10$ZidvCSbLx7vOJ95MArVfP.Y6LG5OHQt9D1HC8hBDmaygVmDxcF6GO', 0, 0, 1, '2023-10-10 09:54:36'),
(13, 'boy@gmail.com', 'Boy abunda', 'boy', '0000-00-00', 'helper', '$2y$10$bxqC8yZIV39t83AK4KAcL.bUx3YfCUrf406U124zH6cSxwmN1M2Ay', 0, 0, 0, '2023-10-11 06:19:21'),
(14, 'alden@gmail.com', 'Alden Richard', 'alden', '0000-00-00', 'Janitor', '$2y$10$Tv1KBDHAexjlNGCO2l2IPORLa/ttaoin8u3YRIyTK5xpVw3bzVvoG', 0, 0, 0, '2023-10-11 06:46:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airpurifier`
--
ALTER TABLE `airpurifier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airpurifier`
--
ALTER TABLE `airpurifier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
