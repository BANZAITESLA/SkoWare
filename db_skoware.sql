-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2021 at 09:22 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_skoware`
--
CREATE DATABASE IF NOT EXISTS `db_skoware` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_skoware`;

-- --------------------------------------------------------

--
-- Table structure for table `meja_dan_kursi`
--

CREATE TABLE `meja_dan_kursi` (
  `no_meja` int(11) NOT NULL,
  `status` enum('Tersedia','Penuh') DEFAULT NULL,
  `id_pelanggan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meja_dan_kursi`
--

INSERT INTO `meja_dan_kursi` (`no_meja`, `status`, `id_pelanggan`) VALUES
(1, 'Tersedia', NULL),
(2, 'Penuh', 2),
(3, 'Penuh', 1),
(4, 'Tersedia', NULL),
(5, 'Penuh', 3);

-- --------------------------------------------------------

--
-- Table structure for table `menu_minuman`
--

CREATE TABLE `menu_minuman` (
  `id_menu` varchar(8) NOT NULL,
  `nama_menu` varchar(50) DEFAULT NULL,
  `harga_item` double DEFAULT 0,
  `stok` int(11) DEFAULT 0,
  `gambar` varchar(255) DEFAULT NULL,
  `id_pegawai` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` varchar(8) NOT NULL,
  `nama_pegawai` varchar(30) DEFAULT NULL,
  `jabatan` enum('','Pelayan','Kasir','Koki','Pemilik Restoran') DEFAULT NULL,
  `alamat` varchar(30) DEFAULT NULL,
  `no_telp` varchar(12) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `jabatan`, `alamat`, `no_telp`, `password`) VALUES
('KK001', 'Spongebob Squarepants', 'Koki', 'Jl. Conch No. 124, Bikini Bott', '08985564678', '78cc877cdc0b40a6d53acaf371787e3a'),
('KS001', 'Squidward Tentacles', 'Kasir', 'Jl. Conch No. 125, Bikini Bott', '082863612116', '9c00ddb4d34253ff63a58b87c11e0c5a'),
('PL001', 'Patrick Star', 'Pelayan', 'Jl. Conch No. 123, Bikini Bott', '08123456699', '5e6e26d3f32457d3c4227918ffb7bd20'),
('PM001', 'Resto UNIKOM', 'Pemilik Restoran', 'Jl. Rumah Jangkar, Bikini Bott', '02654284877', 'd11e91307ac7e2d6733d5de1cc8f62a3');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(30) DEFAULT NULL,
  `jml_pelanggan` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `jml_pelanggan`) VALUES
(1, 'Sandy Cheeks', 1),
(2, 'Karen', 2),
(3, 'Pearl Krabs', 4);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pesanan` int(11) NOT NULL,
  `tgl_bayar` date DEFAULT current_timestamp(),
  `qty` int(11) DEFAULT 0,
  `total` double DEFAULT 0,
  `sub_total` double DEFAULT 0,
  `id_menu` varchar(8) CHARACTER SET utf8mb4 DEFAULT NULL,
  `id_pelanggan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=dec8;

-- --------------------------------------------------------

--
-- Table structure for table `waiting_list`
--

CREATE TABLE `waiting_list` (
  `waktu_datang` datetime DEFAULT current_timestamp(),
  `no_telp` varchar(12) DEFAULT NULL,
  `id_pesanan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meja_dan_kursi`
--
ALTER TABLE `meja_dan_kursi`
  ADD PRIMARY KEY (`no_meja`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `menu_minuman`
--
ALTER TABLE `menu_minuman`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `waiting_list`
--
ALTER TABLE `waiting_list`
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `meja_dan_kursi`
--
ALTER TABLE `meja_dan_kursi`
  ADD CONSTRAINT `meja_dan_kursi_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_minuman`
--
ALTER TABLE `menu_minuman`
  ADD CONSTRAINT `menu_minuman_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu_minuman` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `waiting_list`
--
ALTER TABLE `waiting_list`
  ADD CONSTRAINT `waiting_list_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pembayaran` (`id_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
