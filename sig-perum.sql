-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2021 at 01:56 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sig-perum`
--

-- --------------------------------------------------------

--
-- Table structure for table `perumahan_master`
--

CREATE TABLE `perumahan_master` (
  `id_perum` int(11) NOT NULL,
  `nama_perum` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `koordinat` text NOT NULL,
  `gambar` varchar(64) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perumahan_master`
--

INSERT INTO `perumahan_master` (`id_perum`, `nama_perum`, `alamat`, `koordinat`, `gambar`, `id_user`, `status`) VALUES
(10, 'Bali Arum', 'Jl. Perum Bali Harum, Kutuh, Kec. Kuta Sel., Kabupaten Badung, Bali 80361', '115.18000960415522,-8.79118265113868, 115.1807820803515,-8.790780034155054, 115.18147945469538,-8.791013128251565, 115.18135070866266,-8.791765385471658, 115.18235921925226,-8.792199786832633, 115.18315315312067,-8.792676568227781, 115.18280983036676,-8.793397036727274, 115.18136143749872,-8.79325930021071, 115.18126487797419,-8.79404333815934, 115.18022418087641,-8.793852626378632, 115.18025636738459,-8.792676568227781, 115.17967701023737,-8.792136215933555', 'Bali Arum-600d67cba0aef.jpg', 7, 1),
(14, 'dalung', 'dalung', '115.15765285439558,-8.61876780730084, 115.16769504494734,-8.618555806025732, 115.167094230128,-8.622541410100894, 115.15730953164167,-8.622075011795632', 'dalung-6010a8ebda980.jpg', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tiperumah_master`
--

CREATE TABLE `tiperumah_master` (
  `id_tipe` int(11) NOT NULL,
  `tipe_rumah` varchar(50) NOT NULL,
  `luas_bangunan` varchar(50) NOT NULL,
  `luas_tanah` varchar(50) NOT NULL,
  `spesifikasi` varchar(100) NOT NULL,
  `daya_listrik` varchar(100) NOT NULL,
  `id_perum` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `alamat`, `username`, `email`, `password`, `level`) VALUES
(1, 'admin', 'dalung', 'admin', 'admin@gmail.com', '$2y$10$Fh5bXNzuPRLTU0C.lFbNHewjnbdMafzm5YtGKLdz494Ppp9mXhcpm', 'admin'),
(2, 'rizky dhani', 'dalung', 'rizkydh', 'rizky@gmail.com', '$2y$10$HaDgNIoWoxBOkmUB553kveo1zq.mxeV7GQrjHq.iZja5u5oV2lICS', 'user'),
(7, 'Yoga Pramana', 'Gianyar', 'yogapra26', 'yogapramana@gmail.com', '$2y$10$YOMi4LD3cpmu19/VAJss6.OBESqKMcWoSUXQKiM62xlzHqFn6AkDu', 'user'),
(8, 'tes', 'tes', 'tes123', 'tes@gmail.com', '$2y$10$qyvsCVSLsoxhTkVQK6I63OjZn6XsWo.g1JltqSB2Ae4san/uCUKnC', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `perumahan_master`
--
ALTER TABLE `perumahan_master`
  ADD PRIMARY KEY (`id_perum`),
  ADD KEY `id-user` (`id_user`);

--
-- Indexes for table `tiperumah_master`
--
ALTER TABLE `tiperumah_master`
  ADD PRIMARY KEY (`id_tipe`),
  ADD KEY `fk_id_perum` (`id_perum`),
  ADD KEY `fk_id-user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `perumahan_master`
--
ALTER TABLE `perumahan_master`
  MODIFY `id_perum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tiperumah_master`
--
ALTER TABLE `tiperumah_master`
  MODIFY `id_tipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `perumahan_master`
--
ALTER TABLE `perumahan_master`
  ADD CONSTRAINT `id-user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tiperumah_master`
--
ALTER TABLE `tiperumah_master`
  ADD CONSTRAINT `fk_id-user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_perum` FOREIGN KEY (`id_perum`) REFERENCES `perumahan_master` (`id_perum`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
