-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2023 at 08:50 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_stormz`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `id_merk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `tipe`, `harga`, `foto`, `id_merk`) VALUES
(1122, 'GP 129 JXK P2', 524000, '63ec2c4b4811f.jpg', 101),
(1123, 'GP 129 JPX', 524000, '63ec2f2617b62.jpg', 101),
(1124, 'GN 130H', 1430000, '63ec308a1ac35.jpg', 101),
(1125, 'GN 205HX', 1806000, '63ec31331fe6c.jpg', 101),
(1126, 'GA 126 JAK', 658000, '63ec31c9d2ad3.jpg', 101),
(1127, 'TUTUP PANCING POMPA AIR PANASONIC MODEL BARU', 2000, '63ec328ba7007.jpg', 101),
(1128, 'MECHANICAL SEAL NAT 125 JP PANASONIC GP GA 129 130 JXK JAK JACK', 8500, '63ec330b95d8e.jpg', 101),
(1129, 'PWH 137 C', 535000, '63ec33a99e351.jpg', 102),
(1130, 'PWH 236 C', 817000, '63ec34069eeae.jpg', 102),
(1131, 'IMPELLER PH 100 SANYO SPARE PART POMPA AIR', 33000, '63ec356dd61b2.jpg', 102),
(1132, 'PRESSURE TANK SANYO PH 258 JP ASLI TABUNG TANGKI BAWAH POMPA AIR', 2027000, '63ec35f2b18c6.jpg', 102),
(1133, 'PS 130 BIT', 699000, '63ec367171990.jpg', 103),
(1134, 'PS 116 BIT', 469000, '63ec3760d91bf.jpg', 103),
(1135, 'ZPS 15-9-140', 805000, '63ec37d625e95.jpg', 103),
(1136, 'TUTUP PANCING PS 135, PS 130 BIT', 2000, '63ec3831b6246.jpg', 103),
(1137, 'PC 255 EA', 1933000, '63ec38ab93b41.jpg', 105),
(1138, 'WD 80 E', 469000, '63ec38f21bc2a.jpg', 105),
(1139, 'PBMH 60 4EA', 3152000, '63ec3935e2c7e.jpg', 105),
(1140, 'WTP 400 GX', 6120000, '63ec3a10c5c83.jpg', 110),
(1141, 'WMP 280 GX', 3841000, '63ec3aa136848.jpg', 110),
(1142, 'WP 105 ID', 1688000, '63ec3b0e20ed6.jpg', 112),
(1143, 'WP 355 ID', 2620000, '63ec3b5b43632.jpg', 112),
(1144, 'WP 255 ID', 2400000, '63ec3b95b5bb9.jpg', 112),
(1145, 'FWP 61 SS', 1352000, '63ec3bf8bdc69.jpg', 113),
(1146, 'FJC 105', 967000, '63ec3c4638ffa.jpg', 113),
(1148, 'TUTUP SELANG', 20000, '63fe80c466df1.jpg', 110),
(1149, 'SELANG', 30000, '63fe80e71d476.jpg', 102);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `kategori`) VALUES
(103, 'pompa air'),
(106, 'spare part'),
(117, 'selang'),
(118, 'tutup pompa');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_barang`
--

CREATE TABLE `tb_kategori_barang` (
  `id_kategori_barang` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori_barang`
--

INSERT INTO `tb_kategori_barang` (`id_kategori_barang`, `id_barang`, `id_kategori`) VALUES
(100, 1124, 103),
(101, 1122, 103),
(102, 1123, 103),
(103, 1125, 103),
(104, 1126, 103),
(105, 1127, 106),
(106, 1128, 106),
(107, 1129, 103),
(108, 1130, 103),
(109, 1131, 106),
(110, 1132, 106),
(111, 1133, 103),
(112, 1134, 103),
(113, 1135, 103),
(114, 1136, 106),
(115, 1137, 103),
(116, 1138, 103),
(117, 1139, 103),
(118, 1140, 103),
(119, 1141, 103),
(120, 1142, 103),
(121, 1143, 103),
(122, 1144, 103),
(123, 1145, 103),
(124, 1146, 103),
(125, 1148, 117),
(126, 1149, 118);

-- --------------------------------------------------------

--
-- Table structure for table `tb_merk`
--

CREATE TABLE `tb_merk` (
  `id_merk` int(11) NOT NULL,
  `merk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_merk`
--

INSERT INTO `tb_merk` (`id_merk`, `merk`) VALUES
(101, 'panasonic'),
(102, 'sanyo'),
(103, 'shimizu'),
(105, 'wasser'),
(106, 'sharp'),
(107, 'uchida'),
(110, 'hitachi'),
(111, 'maspion'),
(112, 'mitsubishi'),
(113, 'firman');

-- --------------------------------------------------------

--
-- Table structure for table `tb_stok`
--

CREATE TABLE `tb_stok` (
  `id_stok` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_stok`
--

INSERT INTO `tb_stok` (`id_stok`, `id_barang`, `stok`) VALUES
(40, 1122, 1359),
(41, 1123, 484),
(42, 1124, 318),
(43, 1125, 87),
(44, 1126, 71),
(45, 1127, 621),
(46, 1128, 980),
(47, 1129, 1233),
(48, 1130, 0),
(49, 1131, 71),
(50, 1132, 0),
(51, 1133, 778),
(52, 1134, 0),
(53, 1135, 0),
(54, 1136, 0),
(55, 1137, 43),
(56, 1138, 526),
(57, 1139, 536),
(58, 1140, 874),
(59, 1141, 452),
(60, 1142, 632),
(61, 1143, 4527),
(62, 1144, 6835),
(63, 1145, 2356),
(64, 1146, 546),
(65, 1148, 546),
(66, 1149, 213);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `tanggal` datetime NOT NULL,
  `status` enum('IN','OUT') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `username`, `tanggal`, `status`) VALUES
('TR20230301/IN/1', 'supp-1001', '2023-03-01 07:48:17', 'IN'),
('TR20230301/IN/2', 'supp-1002', '2023-03-01 07:59:36', 'IN'),
('TR20230301/IN/3', 'supp-1003', '2023-03-01 08:00:56', 'IN'),
('TR20230301/IN/4', 'supp-1001', '2023-03-01 19:48:35', 'IN'),
('TR20230301/OUT/1', 'staff-1001', '2023-03-01 06:42:55', 'OUT'),
('TR20230301/OUT/2', 'staff-1001', '2023-03-01 06:46:56', 'OUT');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_detail`
--

CREATE TABLE `tb_transaksi_detail` (
  `id_transaksi_detail` int(11) NOT NULL,
  `id_transaksi` varchar(255) NOT NULL,
  `id_stok` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `jumlah_akhir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_transaksi_detail`
--

INSERT INTO `tb_transaksi_detail` (`id_transaksi_detail`, `id_transaksi`, `id_stok`, `jumlah`, `jumlah_akhir`) VALUES
(1, 'TR20230301/OUT/1', 41, 8, 484),
(2, 'TR20230301/OUT/1', 45, 3, 621),
(3, 'TR20230301/OUT/2', 42, 1, 18),
(4, 'TR20230301/OUT/2', 46, 4, 980),
(5, 'TR20230301/OUT/2', 43, 3, 17),
(6, 'TR20230301/OUT/2', 40, 3, 1359),
(7, 'TR20230301/IN/1', 42, 300, 318),
(8, 'TR20230301/IN/1', 47, 1233, 1233),
(9, 'TR20230301/IN/1', 66, 213, 213),
(10, 'TR20230301/IN/1', 65, 546, 546),
(11, 'TR20230301/IN/1', 63, 2356, 2356),
(12, 'TR20230301/IN/1', 62, 6835, 6835),
(13, 'TR20230301/IN/1', 61, 4527, 4527),
(14, 'TR20230301/IN/1', 60, 632, 632),
(15, 'TR20230301/IN/1', 57, 536, 536),
(16, 'TR20230301/IN/1', 58, 874, 874),
(17, 'TR20230301/IN/2', 59, 452, 452),
(18, 'TR20230301/IN/2', 51, 675, 675),
(19, 'TR20230301/IN/2', 56, 526, 526),
(20, 'TR20230301/IN/2', 49, 71, 71),
(21, 'TR20230301/IN/3', 55, 43, 43),
(22, 'TR20230301/IN/3', 51, 13, 688),
(23, 'TR20230301/IN/4', 51, 90, 778),
(24, 'TR20230301/IN/4', 43, 70, 87);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_detail_temp`
--

CREATE TABLE `tb_transaksi_detail_temp` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `merk` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `stok_akhir` int(11) NOT NULL,
  `status` enum('IN','OUT') NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `perusahaan` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `role` enum('manager','staff','supplier') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`username`, `password`, `nama_lengkap`, `perusahaan`, `email`, `telepon`, `foto`, `role`) VALUES
('mgr-stormz', '$2y$10$.KSyhpeWGRFicEY8hEWwLeMc1aPODmd3QgbiJdCe/eIEnXpjoOb8q', 'Moch. Fachrizal Zakaria', 'PT Stormz Indonesia', 'mfachrizaalz@gmail.com', '087855736610', '63a9a3967c90b.jpg', 'manager'),
('staff-1001', '$2y$10$.KSyhpeWGRFicEY8hEWwLeMc1aPODmd3QgbiJdCe/eIEnXpjoOb8q', 'Moch. Fachrizal Zakaria', 'PT Stormz Indonesia', 'mfachrizalz@gmail.com', '087855736610', '63eecfdbc9d44.jpg', 'staff'),
('supp-1001', '$2y$10$.KSyhpeWGRFicEY8hEWwLeMc1aPODmd3QgbiJdCe/eIEnXpjoOb8q', 'Lutfhi Kurnia Hadi', 'CV Lutfhi Kurnia Hadi', 'luthfikh@gmail.com', '0879123532418', '63fea01eb97d4.jpg', 'supplier'),
('supp-1002', '$2y$10$.KSyhpeWGRFicEY8hEWwLeMc1aPODmd3QgbiJdCe/eIEnXpjoOb8q', 'Ronan Ardi', 'Ronan', 'ronan@gmail.com', '098765617', '63fea1ce279de.jpg', 'supplier'),
('supp-1003', '$2y$10$.KSyhpeWGRFicEY8hEWwLeMc1aPODmd3QgbiJdCe/eIEnXpjoOb8q', 'Nando Septian', 'PT Nando P', 'nando@gmail.com', '0987645623', '63fea23d1bb48.jpg', 'supplier'),
('supp-1004', '$2y$10$.KSyhpeWGRFicEY8hEWwLeMc1aPODmd3QgbiJdCe/eIEnXpjoOb8q', 'Dafa Pratama AS', 'CV Dafpa', 'dafa@gmail.com', '097823124', '63fea2ea68478.jpg', 'supplier');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_merk` (`id_merk`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_kategori_barang`
--
ALTER TABLE `tb_kategori_barang`
  ADD PRIMARY KEY (`id_kategori_barang`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_barang_kategori` (`id_barang`);

--
-- Indexes for table `tb_merk`
--
ALTER TABLE `tb_merk`
  ADD PRIMARY KEY (`id_merk`);

--
-- Indexes for table `tb_stok`
--
ALTER TABLE `tb_stok`
  ADD PRIMARY KEY (`id_stok`),
  ADD KEY `id_barang_stok` (`id_barang`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `tb_transaksi_detail`
--
ALTER TABLE `tb_transaksi_detail`
  ADD PRIMARY KEY (`id_transaksi_detail`),
  ADD KEY `id_stok` (`id_stok`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `tb_transaksi_detail_temp`
--
ALTER TABLE `tb_transaksi_detail_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`,`telepon`),
  ADD UNIQUE KEY `email_2` (`email`,`telepon`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1150;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `tb_kategori_barang`
--
ALTER TABLE `tb_kategori_barang`
  MODIFY `id_kategori_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `tb_merk`
--
ALTER TABLE `tb_merk`
  MODIFY `id_merk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `tb_stok`
--
ALTER TABLE `tb_stok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tb_transaksi_detail`
--
ALTER TABLE `tb_transaksi_detail`
  MODIFY `id_transaksi_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_transaksi_detail_temp`
--
ALTER TABLE `tb_transaksi_detail_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=344;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD CONSTRAINT `id_merk` FOREIGN KEY (`id_merk`) REFERENCES `tb_merk` (`id_merk`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tb_kategori_barang`
--
ALTER TABLE `tb_kategori_barang`
  ADD CONSTRAINT `id_barang_kategori` FOREIGN KEY (`id_barang`) REFERENCES `tb_barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tb_stok`
--
ALTER TABLE `tb_stok`
  ADD CONSTRAINT `id_barang_stok` FOREIGN KEY (`id_barang`) REFERENCES `tb_barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `username` FOREIGN KEY (`username`) REFERENCES `tb_user` (`username`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tb_transaksi_detail`
--
ALTER TABLE `tb_transaksi_detail`
  ADD CONSTRAINT `id_stok` FOREIGN KEY (`id_stok`) REFERENCES `tb_stok` (`id_stok`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `id_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `tb_transaksi` (`id_transaksi`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
