-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2021 at 10:27 AM
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
  `gambar_perum` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perumahan_master`
--

INSERT INTO `perumahan_master` (`id_perum`, `nama_perum`, `alamat`, `koordinat`, `gambar_perum`, `id_user`, `status`) VALUES
(20, 'Damara Village', 'Jl. Puri Gading, Jimbaran, Kec. Kuta Sel., Kabupaten Badung, Bali 80361', '115.14416027075643,-8.800106052857357, 115.14444458491201,-8.800217447738431, 115.14472997201666,-8.799182004438729, 115.14410233510718,-8.798884950516936, 115.14359271539435,-8.798375714667838, 115.14335131658301,-8.79885842783374, 115.14376544939299,-8.799241415259212, 115.14411735541218,-8.799546956170559', 'Perum-Damara Village-60249f95c4fcb.jpg', 2, 1),
(21, 'Bali Arum Jimbaran', 'Jl. Raya Kampus Unud, Jimbaran, Kec. Kuta Sel., Kabupaten Badung, Bali 80361', '115.17996990634859,-8.791171057805157, 115.18051707698763,-8.790741128867403, 115.18156850292146,-8.790905669630932, 115.18153095199526,-8.791839835161149, 115.18268966628966,-8.79229099380662, 115.1832690234369,-8.793161463052128, 115.18229055345729,-8.793329187411457, 115.18129277170377,-8.793276110101035, 115.18120694101528,-8.794305808565662, 115.18031644762235,-8.79414657703144, 115.18023061693386,-8.792777183011268, 115.17962765654376,-8.792197577602977', 'Perum-Bali Arum Jimbaran-6024e61d38aee.jpg', 1, 1),
(22, 'The Living Hill Residence', 'Jl. Taman Giri, Benoa, Kec. Kuta Sel., Kabupaten Badung, Bali 80361', '115.1940654513601,-8.795211846903948, 115.19419956181085,-8.79475007639582, 115.19469308826957,-8.794914615378532, 115.1946448085073,-8.795312693260135, 115.19521343681846,-8.7958116169341, 115.19509005520378,-8.795986770830485, 115.19461262199913,-8.795981463137842, 115.19438195202385,-8.79582223232413, 115.19411909554039,-8.795684232230204', 'Perum-The Living Hill Residence-6024a02fe8682.jpg', 1, 1),
(23, 'Mandala Griya', 'Jl. Maya Loka, Benoa, Kec. Kuta Sel., Kabupaten Badung, Bali 80361', '115.21101594036737,-8.799473554948527, 115.20980358189264,-8.799569036440392, 115.20988941258112,-8.79855056592386, 115.2108764654986,-8.798444475083885, 115.21080136364618,-8.79776549298813, 115.20884871548334,-8.797616965488684, 115.2087521559588,-8.799982789287244, 115.21099448269526,-8.80007827064775', 'Perum-Mandala Griya-6024a042974db.jpg', 2, 1);

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
  `gambar` varchar(64) NOT NULL,
  `id_perum` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tiperumah_master`
--

INSERT INTO `tiperumah_master` (`id_tipe`, `nama_perum`, `tipe_rumah`, `luas_bangunan`, `luas_tanah`, `spesifikasi`, `daya_listrik`, `gambar`, `id_perum`, `id_user`) VALUES
(53, 'Damara Village', 'Damita', '69', '105', '2 lantai, 2 kamar tidur, 2 kamar mandi, dapur, parking space, kolam renang (opsional)', '1300 watt', 'Tipe Damita--602134bc5e630.jpg', 20, 2),
(54, 'Damara Village', 'Dahayu', '101', '100', '2 lantai, 3 kamar tidur + 1 opsional, 2 kamar mandi + 1 opsional, dapur, ruang tamu, kolam renang (opsional), parking space', '2200 watt', 'Tipe Dahayu--6021350265778.jpg', 20, 2),
(55, 'Bali Arum Jimbaran', 'Sandat', '55', '100', '2 kamar tidur, ruang tamu, dapur, ruang makan, 1 kamar mandi, teras, parking space', '1300 Watt', 'Tipe-Sandat--6021385b76425.jpg', 21, 1),
(56, 'Bali Arum Jimbaran', 'Cempaka', '80', '130', '2 lantai, 3 kamar tidur (1 kamar lantai 1 &amp; 2 kamar lantai 2), kamar mandi (lantai 1), ruang tamu, dapur, teras, balkon (lantai 2), parking space', '1300 Watt', 'Tipe-Cempaka--60213976ba507.jpg', 21, 1),
(57, 'Bali Arum Jimbaran', 'Jepun', '120', '140', '2 lantai, 3 kamar tidur (1 kamar lantai 1 &amp; 2 kamar lantai 2), kamar mandi (lantai 1), ruang tamu, dapur, teras, balkon (lantai 2), parking space', '2200 watt', 'Tipe-Jepun--60213a25c385a.jpg', 21, 1),
(58, 'Bali Arum Jimbaran', 'Padma', '140', '170', '2 lantai, 4 kamar tidur (2 kamar lantai 1 &amp; 2 kamar lantai 2), 2 kamar mandi (lantai 1 &amp; lantai 2), ruang tamu, dapur, teras, balkon (lantai 2), parking space', '2200 watt (bisa di naikkan sampai 4400 watt)', 'Tipe-Padma--60213b068cadb.jpg', 21, 1),
(59, 'The Living Hill Residence', 'Keanu', '40', '72', '2 kamar tidur, kamar mandi, ruang tamu, dapur, teras, parking space', '1300 watt', 'Tipe-Keanu--60213f03802c0.jpg', 22, 1),
(60, 'The Living Hill Residence', 'Karamina', '40', '77', '2 kamar tidur, kamar mandi, ruang tamu, dapur, teras, parking space', '1300 watt', 'Tipe-Karamina--6021400099dcb.jpg', 22, 1),
(61, 'Mandala Griya', 'ASRI 37', '37', '70', '2 kamar tidur, kamar mandi, ruang tamu, dapur, teras, parking space', '1300 watt', 'Tipe-37--6021492189df1.jpg', 23, 2),
(62, 'Mandala Griya', 'ASRI 40', '40', '72', '2 kamar tidur, kamar mandi, ruang tamu, dapur, teras, parking space', '1300 watt', 'Tipe-40--6021497134c14.jpg', 23, 2),
(63, 'Mandala Griya', 'ASRI 55', '55', '72', '3 kamar tidur, kamar mandi, ruang tamu, dapur, teras, parking space', '1300 watt', 'Tipe-55--60214af67f512.jpg', 23, 2);

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
(1, 'Admin', 'Dalung', 'admin', 'admin@gmail.com', '$2y$10$//ALY173EcdGghHgQLFu3ekJ3Zx9C4SN7T.rzi/TUsIUbHvesVqJW', 'admin'),
(2, 'rizky dhani ismail', 'dalung', 'rizkydh', 'rizky@gmail.com', '$2y$10$nbE75P2FW6xUFpA9DSc7G.xsNURicxyfJKBZ8W0nXED81GaikOyXa', 'user'),
(7, 'Yoga Pramana', 'Gianyar', 'yogapra26', 'yogapramana@gmail.com', '$2y$10$YOMi4LD3cpmu19/VAJss6.OBESqKMcWoSUXQKiM62xlzHqFn6AkDu', 'user'),
(9, 'agung oka aryananda', 'denpasar', 'agungoka12', 'okaaryananda@gmail.com', '$2y$10$jN2J3oLSMnSzfTbe/W/3Tez2GxAGlGnLO13OA/3PMiXBsYn3QwLoe', 'user');

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
  MODIFY `id_perum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tiperumah_master`
--
ALTER TABLE `tiperumah_master`
  MODIFY `id_tipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
