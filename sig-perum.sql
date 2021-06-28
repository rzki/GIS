-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2021 at 12:08 AM
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
  `no_telp` varchar(15) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perumahan_master`
--

INSERT INTO `perumahan_master` (`id_perum`, `nama_perum`, `alamat`, `koordinat`, `no_telp`, `id_user`, `status`) VALUES
(20, 'Damara', 'Jl. Puri Gading, Jimbaran, Kec. Kuta Sel., Kabupaten Badung, Bali', '115.14263033866884,-8.795638417743113, 115.14235138893129,-8.796454822064279, 115.14260888099672,-8.797250019347802, 115.14286637306215,-8.797949791544472, 115.14296293258668,-8.798660164997209, 115.14304876327516,-8.799158485859424, 115.14328479766847,-8.799444754987528, 115.14378905296327,-8.79963560094991, 115.14432549476625,-8.800218740780824, 115.14458298683168,-8.800409586344111, 115.14487266540529,-8.799338729410335, 115.144100189209,-8.798670767575723, 115.14394998550416,-8.797949791544472, 115.14431476593019,-8.797271224585312, 115.14357447624208,-8.796656272204308, 115.14385342597963,-8.795871676304264, 115.14324188232423,-8.795553596411722', '+62811945360', 2, 'Diterima'),
(23, 'Mandala Griya', 'Jl. Maya Loka, Benoa, Kec. Kuta Sel., Kabupaten Badung, Bali 80361', '115.21083249068907,-8.797674123867314, 115.20875086386698,-8.797451469055162, 115.20862210344498,-8.80015512557119, 115.21117585181435,-8.800314163574765, 115.21112220163852,-8.799391742202737, 115.21015649847365,-8.799306921731263, 115.21039255924728,-8.798681370153947, 115.21109001153302,-8.798395100435457', ' +62 361 702544', 2, 'Diterima'),
(38, 'Kori Nuansa Tukad Nangka Jimbaran', 'Jl. Nuansa Tukad Nangka Jimbaran, Jimbaran, Kec. Kuta Sel., Kab. Badung, Bali 80361', '115.1814451216342,-8.799179690825838, 115.18126809583921,-8.799481863770584, 115.1807262896182,-8.799200895952819, 115.18091404424925,-8.798866915061822', '(0361) 235305', 2, 'Diterima'),
(68, 'Nusa Dua Highland', 'Jalan Siligita, Benoa, South Kuta, Badung Regency, Bali 80361', '115.21353139311053,-8.798188349945551, 115.21237791433023,-8.798723780463783, 115.21230816910168,-8.799587889468535, 115.2131719369325,-8.799927170980212, 115.21420738532596,-8.799593190744549, 115.21407325988638,-8.798766190768747', '', 12, 'Diterima');

-- --------------------------------------------------------

--
-- Table structure for table `perum_gambar`
--

CREATE TABLE `perum_gambar` (
  `id_gambar` int(11) NOT NULL,
  `gambar_perum` varchar(150) NOT NULL,
  `id_perum` int(11) NOT NULL,
  `uploaded_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perum_gambar`
--

INSERT INTO `perum_gambar` (`id_gambar`, `gambar_perum`, `id_perum`, `uploaded_on`) VALUES
(214, 'Perum-Damara Village-603ef61f45e90.jpg', 20, '2021-03-03 03:36:15'),
(215, 'Perum-Damara Village-603ef61f478fa.jpg', 20, '2021-03-03 03:36:15'),
(216, 'Perum-Damara Village-603ef61f480ad.png', 20, '2021-03-03 03:36:15'),
(238, 'Perum-Mandala Griya-60bec6de766ac.jpg', 23, '2021-06-08 03:24:46'),
(254, 'Perum-Nusa Dua Highland-60c2a1ba6b102.jpg', 68, '2021-06-11 01:35:22'),
(255, 'Perum-Nusa Dua Highland-60c2a1ba6bbf0.jpg', 68, '2021-06-11 01:35:22'),
(258, 'Perum-Nusa Dua Highland-60c2a1de8a83e.jpg', 68, '2021-06-11 01:35:58'),
(259, 'Perum-Nusa Dua Highland-60c2a1de8ad49.jpg', 68, '2021-06-11 01:35:58'),
(260, 'Perum-Nusa Dua Highland-60c2a1de8b1d3.jpg', 68, '2021-06-11 01:35:58'),
(261, 'Perum-Damara-60c2ae94515b2.png', 20, '2021-06-11 02:30:12');

-- --------------------------------------------------------

--
-- Table structure for table `tiperumah_master`
--

CREATE TABLE `tiperumah_master` (
  `id_tipe` int(11) NOT NULL,
  `nama_perum` varchar(100) NOT NULL,
  `tipe_rumah` varchar(50) NOT NULL,
  `luas_bangunan` varchar(50) NOT NULL,
  `luas_tanah` varchar(50) NOT NULL,
  `spesifikasi` text NOT NULL,
  `daya_listrik` varchar(100) NOT NULL,
  `harga` bigint(11) NOT NULL,
  `id_perum` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tiperumah_master`
--

INSERT INTO `tiperumah_master` (`id_tipe`, `nama_perum`, `tipe_rumah`, `luas_bangunan`, `luas_tanah`, `spesifikasi`, `daya_listrik`, `harga`, `id_perum`, `id_user`) VALUES
(53, 'Damara Village', 'Damita', '69', '100', '2 lantai, 2 kamar tidur, 2 kamar mandi, dapur, parking space, kolam renang (opsional)', '2200 watt', 1500000000, 20, 2),
(54, 'Damara Village', 'Dahayu', '101', '100', '2 lantai, 3 kamar tidur + 1 opsional, 2 kamar mandi + 1 opsional, dapur, ruang tamu, kolam renang (opsional), parking space', '2200 watt', 2600000000, 20, 2),
(61, 'Mandala Griya', 'ASRI 37', '37', '70', '2 kamar tidur, kamar mandi, ruang tamu, dapur, teras, parking space', '1300', 627000000, 23, 2),
(62, 'Mandala Griya', 'ASRI 40', '40', '72', '2 kamar tidur, kamar mandi, ruang tamu, dapur, teras, parking space', '1300', 655000000, 23, 2),
(63, 'Mandala Griya', 'ASRI 55', '55', '72', '3 kamar tidur, kamar mandi, ruang tamu, dapur, teras, parking space', '1300', 1300000000, 23, 2),
(96, 'Damara Village', 'Daksa', '100', '105', '2 lantai, 2 kamar tidur (lt1), 2 kamar tidur (lt2), ruang tamu, dapur, 2 kamar mandi (lt1 dan lt2), parking space, pool', '2200 watt', 2100000000, 20, 1),
(100, 'Kori Nuansa Tukad Nangka Jimbaran', 'Tipe 1', '36', '80', '2 km tidur, 1 km mandi, ruang tamu, dapur, teras, parking space', '1300', 550000000, 38, 2),
(107, 'Damara', 'Damita', '60', '80', '2 lantai, 2 kamar tidur + 2 kamar mandi + dapur + ruang makan + carport', '2200', 1500000000, 20, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tipe_gambar`
--

CREATE TABLE `tipe_gambar` (
  `id_gambar` int(11) NOT NULL,
  `gambar_tipe` varchar(150) NOT NULL,
  `id_tipe` int(11) NOT NULL,
  `uploaded_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipe_gambar`
--

INSERT INTO `tipe_gambar` (`id_gambar`, `gambar_tipe`, `id_tipe`, `uploaded_on`) VALUES
(151, 'Perum-Damara Village_Tipe-Damita-603ef6a62bd1b.jpg', 53, '2021-03-03 03:38:30'),
(152, 'Perum-Damara Village_Tipe-Damita-603ef6a62c784.png', 53, '2021-03-03 03:38:30'),
(163, 'Perum-Damara-Tipe-Damita-60c2af1503d7b.jpg', 107, '2021-06-11 02:32:21'),
(164, 'Perum-Damara-Tipe-Damita-60c2af1504577.png', 107, '2021-06-11 02:32:21');

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
(1, 'Admin', 'Kuta Selatan', 'admin', 'adminsigperum@gmail.com', '$2y$10$cFhVQ5J9xlwDz1p9IgcQt.UOH2EI7/IUrUefxCLzTa9JeSnrCIoyi', 'admin'),
(2, 'Rizky Dhani Ismail', 'Dalung, Kuta Utara', 'rizkydhni', 'rizkydhani15@gmail.com', '$2y$10$FOMgZRL7bi/FY3YPXaD0Z.TpDVqSkYzqY6pygnkUtVlDPWWaeHBdW', 'user'),
(12, 'Yoga Pramana', 'Pejeng', 'yogapra26', 'yogapramana26@gmail.com', '$2y$10$kikCji1zHi4sdReJCHQGgOTrTCc64QG3uO0mgiKwgDjM8ukDE8hjC', 'user'),
(13, 'Rizky Dhani', 'Dalung, Kuta Utara', 'rizkydhani123', 'rizkydhani15@gmail.com', '$2y$10$MalWsSBrCC3ilhDTKPOjkOTdV3tlk8gXtPIbtifrhcl58eBbCV6PG', 'user');

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
-- Indexes for table `perum_gambar`
--
ALTER TABLE `perum_gambar`
  ADD PRIMARY KEY (`id_gambar`),
  ADD KEY `id_perum` (`id_perum`);

--
-- Indexes for table `tiperumah_master`
--
ALTER TABLE `tiperumah_master`
  ADD PRIMARY KEY (`id_tipe`),
  ADD KEY `fk_id_perum` (`id_perum`),
  ADD KEY `fk_id-user` (`id_user`);

--
-- Indexes for table `tipe_gambar`
--
ALTER TABLE `tipe_gambar`
  ADD PRIMARY KEY (`id_gambar`),
  ADD KEY `fk-id_tipe` (`id_tipe`);

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
  MODIFY `id_perum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `perum_gambar`
--
ALTER TABLE `perum_gambar`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- AUTO_INCREMENT for table `tiperumah_master`
--
ALTER TABLE `tiperumah_master`
  MODIFY `id_tipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `tipe_gambar`
--
ALTER TABLE `tipe_gambar`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `perumahan_master`
--
ALTER TABLE `perumahan_master`
  ADD CONSTRAINT `id-user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `perum_gambar`
--
ALTER TABLE `perum_gambar`
  ADD CONSTRAINT `id_perum` FOREIGN KEY (`id_perum`) REFERENCES `perumahan_master` (`id_perum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tiperumah_master`
--
ALTER TABLE `tiperumah_master`
  ADD CONSTRAINT `fk_id-user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_perum` FOREIGN KEY (`id_perum`) REFERENCES `perumahan_master` (`id_perum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tipe_gambar`
--
ALTER TABLE `tipe_gambar`
  ADD CONSTRAINT `fk-id_tipe` FOREIGN KEY (`id_tipe`) REFERENCES `tiperumah_master` (`id_tipe`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
