-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Agu 2021 pada 15.53
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 7.4.16

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_pesanan` int(11) DEFAULT NULL,
  `id_menu` varchar(8) DEFAULT NULL,
  `qty` int(11) DEFAULT 0,
  `sub_total` double DEFAULT 0,
  `status` enum('Selesai','Belum','Sampai','Gagal') NOT NULL DEFAULT 'Belum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `meja_dan_kursi`
--

CREATE TABLE `meja_dan_kursi` (
  `no_meja` int(11) NOT NULL,
  `status` enum('Tersedia','Penuh') DEFAULT NULL,
  `id_pesanan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_minuman`
--

CREATE TABLE `menu_minuman` (
  `id_menu` varchar(8) NOT NULL,
  `nama_menu` varchar(50) DEFAULT NULL,
  `harga_item` double DEFAULT 0,
  `stok` int(11) DEFAULT 0,
  `gambar` varchar(255) DEFAULT NULL,
  `id_pegawai` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menu_minuman`
--

INSERT INTO `menu_minuman` (`id_menu`, `nama_menu`, `harga_item`, `stok`, `gambar`, `id_pegawai`) VALUES
('MM001', 'Boba Sekoteng', 10000, 39, 'boba sekoteng.png', 'KK001'),
('MM002', 'Sekoteng Jahe', 10000, 21, 'Sekoteng Jahe.jpeg', 'KK001'),
('MM003', 'Sekoteng Bangkok', 10000, 43, 'Sekoteng Bangkok.jpg', 'KK001'),
('MM004', 'Sekoteng Jahe Madu', 10000, 40, 'Sekoteng Jahe Madu2.jpg', 'KK001'),
('MM005', 'Sekoteng Spesial', 15000, 43, 'Sekoteng Spesial.jpeg', 'KK001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
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
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `jabatan`, `alamat`, `no_telp`, `password`) VALUES
('KK001', 'Spongebob Squarepants', 'Koki', 'Jl. Conch No. 124, Bikini Bott', '08985564678', '78cc877cdc0b40a6d53acaf371787e3a'),
('KS001', 'Squidward Tentacles', 'Kasir', 'Jl. Conch No. 125, Bikini Bott', '082863612116', '9c00ddb4d34253ff63a58b87c11e0c5a'),
('PL001', 'Patrick Star', 'Pelayan', 'Jl. Conch No. 123, Bikini Bott', '08123456699', '5e6e26d3f32457d3c4227918ffb7bd20'),
('PM001', 'Resto UNIKOM', 'Pemilik Restoran', 'Jl. Rumah Jangkar, Bikini Bott', '02654284877', 'd11e91307ac7e2d6733d5de1cc8f62a3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(30) DEFAULT NULL,
  `jml_pelanggan` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `tgl_bayar` datetime DEFAULT NULL,
  `waktu_datang` datetime DEFAULT NULL,
  `no_telp` varchar(12) DEFAULT NULL,
  `total` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indeks untuk tabel `meja_dan_kursi`
--
ALTER TABLE `meja_dan_kursi`
  ADD PRIMARY KEY (`no_meja`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indeks untuk tabel `menu_minuman`
--
ALTER TABLE `menu_minuman`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pesanan_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menu_minuman` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `meja_dan_kursi`
--
ALTER TABLE `meja_dan_kursi`
  ADD CONSTRAINT `meja_dan_kursi_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `menu_minuman`
--
ALTER TABLE `menu_minuman`
  ADD CONSTRAINT `menu_minuman_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
