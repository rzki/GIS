-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2021 at 07:40 AM
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
(20, 'Damara Village', 'Jl. Puri Gading, Jimbaran, Kec. Kuta Sel., Kabupaten Badung, Bali 80361', '115.14416027075643,-8.800106052857357, 115.14444458491201,-8.800217447738431, 115.14472997201666,-8.799182004438729, 115.14410233510718,-8.798884950516936, 115.14359271539435,-8.798375714667838, 115.14335131658301,-8.79885842783374, 115.14376544939299,-8.799241415259212, 115.14411735541218,-8.799546956170559', '', 2, 'Diterima'),
(21, 'Bali Arum Jimbaran', 'Jl. Raya Kampus Unud, Jimbaran, Kec. Kuta Sel., Kabupaten Badung, Bali 80361', '115.17996990634859,-8.791171057805157, 115.18051707698763,-8.790741128867403, 115.18156850292146,-8.790905669630932, 115.18153095199526,-8.791839835161149, 115.18268966628966,-8.79229099380662, 115.1832690234369,-8.793161463052128, 115.18229055345729,-8.793329187411457, 115.18129277170377,-8.793276110101035, 115.18120694101528,-8.794305808565662, 115.18031644762235,-8.79414657703144, 115.18023061693386,-8.792777183011268, 115.17962765654376,-8.792197577602977', '', 1, 'Diterima'),
(23, 'Mandala Griya', 'Jl. Maya Loka, Benoa, Kec. Kuta Sel., Kabupaten Badung, Bali 80361', '115.21101594036737,-8.799473554948527, 115.20980358189264,-8.799569036440392, 115.20988941258112,-8.79855056592386, 115.2108764654986,-8.798444475083885, 115.21080136364618,-8.79776549298813, 115.20884871548334,-8.797616965488684, 115.2087521559588,-8.799982789287244, 115.21099448269526,-8.80007827064775', '', 2, 'Diterima'),
(30, 'Casa Nuansa Ring Jimbaran', 'Jl. Nuansa Timur, Jimbaran, Kec. Kuta Sel., Kab. Badung, Bali 80361', '115.18797898279448,-8.801216437871808, 115.187701106006,-8.801280053060797, 115.18764317035676,-8.801582224047962, 115.18785989297614,-8.801660682599437', '', 7, 'Diterima'),
(34, 'Mumbul Sector Garden', 'Jl. Mahoni Raya, Nusa Dua Selatan, Benoa, Kec. Kuta Sel., Kabupaten Badung, Bali', '115.20167219645376,-8.798977181737301, 115.20062077051992,-8.799003688160333, 115.2005456686675,-8.799608034090484, 115.19990193850393,-8.79971405959053, 115.19970345503683,-8.801134798360577, 115.20071625709535,-8.802086902367003, 115.2027064561844,-8.802362566757402, 115.20282983779909,-8.80129171547485, 115.20167219612634,-8.800313103095151', '', 7, 'Diterima'),
(35, 'Kori Nuansa Barat', 'Jl. Nuansa Barat IV, Jimbaran, Kec. Kuta Sel., Kabupaten Badung, Bali 80361', '115.1820094584764,-8.799666348341717, 115.18177878850112,-8.80010635389902, 115.18213820450913,-8.80038732102943, 115.18242788308272,-8.799857194189842', '', 7, 'Diterima'),
(36, 'Kori Nuansa Hill Kampial', 'Jl. Nuansa Hill, Jimbaran, Kec. Kuta Sel., Kab. Badung, Bali 80361', '115.1879317763087,-8.806549459593134, 115.18771719958751,-8.807047769829676, 115.18866670157878,-8.807540778232704, 115.18910658385722,-8.806909939405898', '', 2, 'Diterima'),
(37, 'Kori Nuansa Ring Bukit', 'Jl. Nuansa Ring Bukit, Jimbaran, Kec. Kuta Sel., Kab. Badung, Bali 80361', '115.18647372706255,-8.805407054174177, 115.18634766323888,-8.805809944598055, 115.1871791480335,-8.806109461536659, 115.18731325848422,-8.805693318467851', '', 2, 'Diterima'),
(38, 'Kori Nuansa Tukad Nangka Jimbaran', 'Jl. Nuansa Tukad Nangka Jimbaran, Jimbaran, Kec. Kuta Sel., Kab. Badung, Bali 80361', '115.1814451216342,-8.799179690825838, 115.18126809583921,-8.799481863770584, 115.1807262896182,-8.799200895952819, 115.18091404424925,-8.798866915061822', '', 2, 'Diterima'),
(39, 'Ocean Bay Sun', 'Jl. Ocean Bay Sun, Benoa, Kec. Kuta Sel., Kab. Badung 80361', '115.21415626983072,-8.797089919700658, 115.21359032372857,-8.79708726904473, 115.2130377886715,-8.796933530968843, 115.2129814622822,-8.796697622417929, 115.21315044145013,-8.796154236981598, 115.21378880719567,-8.796326530011157, 115.21361714581874,-8.79674798493018, 115.21412676553157,-8.796811600725343', '', 2, 'Diterima');

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
  `harga` int(11) NOT NULL,
  `gambar` varchar(64) NOT NULL,
  `id_perum` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tiperumah_master`
--

INSERT INTO `tiperumah_master` (`id_tipe`, `nama_perum`, `tipe_rumah`, `luas_bangunan`, `luas_tanah`, `spesifikasi`, `daya_listrik`, `harga`, `gambar`, `id_perum`, `id_user`) VALUES
(53, 'Damara Village', 'Damita', '69', '105', '2 lantai, 2 kamar tidur, 2 kamar mandi, dapur, parking space, kolam renang (opsional)', '1300 watt', 0, 'Tipe Damita--602134bc5e630.jpg', 20, 2),
(54, 'Damara Village', 'Dahayu', '101', '100', '2 lantai, 3 kamar tidur + 1 opsional, 2 kamar mandi + 1 opsional, dapur, ruang tamu, kolam renang (opsional), parking space', '2200 watt', 0, 'Tipe Dahayu--6021350265778.jpg', 20, 2),
(55, 'Bali Arum Jimbaran', 'Sandat', '55', '100', '2 kamar tidur, ruang tamu, dapur, ruang makan, 1 kamar mandi, teras, parking space', '1300 Watt', 0, 'Tipe-Sandat--6021385b76425.jpg', 21, 1),
(56, 'Bali Arum Jimbaran', 'Cempaka', '80', '130', '2 lantai, 3 kamar tidur (1 kamar lantai 1 &amp; 2 kamar lantai 2), kamar mandi (lantai 1), ruang tamu, dapur, teras, balkon (lantai 2), parking space', '1300 Watt', 0, 'Tipe-Cempaka--60213976ba507.jpg', 21, 1),
(57, 'Bali Arum Jimbaran', 'Jepun', '120', '140', '2 lantai, 3 kamar tidur (1 kamar lantai 1 &amp; 2 kamar lantai 2), kamar mandi (lantai 1), ruang tamu, dapur, teras, balkon (lantai 2), parking space', '2200 watt', 0, 'Tipe-Jepun--60213a25c385a.jpg', 21, 1),
(58, 'Bali Arum Jimbaran', 'Padma', '140', '170', '2 lantai, 4 kamar tidur (2 kamar lantai 1 &amp; 2 kamar lantai 2), 2 kamar mandi (lantai 1 &amp; lantai 2), ruang tamu, dapur, teras, balkon (lantai 2), parking space', '2200 watt (bisa di naikkan sampai 4400 watt)', 0, 'Tipe-Padma--60213b068cadb.jpg', 21, 1),
(61, 'Mandala Griya', 'ASRI 37', '37', '70', '2 kamar tidur, kamar mandi, ruang tamu, dapur, teras, parking space', '1300 watt', 0, 'Tipe-37--6021492189df1.jpg', 23, 2),
(62, 'Mandala Griya', 'ASRI 40', '40', '72', '2 kamar tidur, kamar mandi, ruang tamu, dapur, teras, parking space', '1300 watt', 0, 'Tipe-40--6021497134c14.jpg', 23, 2),
(63, 'Mandala Griya', 'ASRI 55', '55', '72', '3 kamar tidur, kamar mandi, ruang tamu, dapur, teras, parking space', '1300 watt', 0, 'Tipe-55--60214af67f512.jpg', 23, 2),
(65, 'Casa Nuansa Ring Jimbaran', 'Casa 1', '45', '82', '2 lantai, 3 kamar tidur (1 kamar lt1 &amp; 2 kamar lt2), 2 kamar mandi / wc ( lt1 &amp; lt2 ), ruang tamu, dapur, teras, parking space', '1300 Watt', 0, 'Tipe-Casa 1--602cb32bef890.jpg', 30, 7),
(66, 'Casa Nuansa Ring Jimbaran', 'Casa 2', '50', '82', '2 lantai, 3 kamar tidur (1 kamar lt1 &amp; 2 kamar lt2), 2 kamar mandi / wc ( lt1 &amp; lt2 ), ruang tamu, dapur, teras, parking space', '1300 Watt', 0, 'Tipe-Casa 2--602cb3a68f861.jpg', 30, 7);

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
(1, 'Admin', 'Dalung', 'admin', 'admin@gmail.com', '$2y$10$s3ez8IDwFm1C1BXiFOxj8O.y0a5QzE4L56GDYpT3D87xnhVU2KNrm', 'admin'),
(2, 'Rizky Dhani', 'Dalung', 'rizkydh', 'rizkydhani15@gmail.com', '$2y$10$OmJDus3oUMmuiTx4MAkzxeWJQgTputnCRPCi4dzvrMLcM9ZB81oV.', 'user'),
(7, 'I Gede Yoga Pramana', 'Gianyar', 'yogapra26', 'yogapramana@gmail.com', '$2y$10$A0pE89AwmTBThOGDzKsDE.i9ChgTJX9myr7bWH24SJBJWRXNHgdQC', 'user'),
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
  MODIFY `id_perum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tiperumah_master`
--
ALTER TABLE `tiperumah_master`
  MODIFY `id_tipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

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
