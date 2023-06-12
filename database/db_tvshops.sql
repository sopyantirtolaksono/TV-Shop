-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2019 at 06:40 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tvshops`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'bekhan', 'bekhan321', 'Bekhan Supriyanto');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(5) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'Demak', 50000),
(2, 'Cirebon', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(100) NOT NULL,
  `password_pelanggan` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `telepon_pelanggan` varchar(20) NOT NULL,
  `alamat_pelanggan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `telepon_pelanggan`, `alamat_pelanggan`) VALUES
(1, 'jhon@gmail.com', 'jhon321', 'Jhon Doe', '089111111111', ''),
(2, 'fulan@gmail.com', 'fulan321', 'Fulan', '089222222222', ''),
(3, 'ferry@gmail.com', 'ferry321', 'Ferry Irawan', '087123432126', 'Desa Randugarut Rt.04 Rw.02 Kecamatan Tugu Kota Semarang'),
(4, 'ajisp@gmail.com', 'aji321', 'Muhammad Aji Syahputra', '085542567890', 'Jl. Kelud Raya Semarang Barat');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(1, 1, 'Jhon Doe', 'BNI', 9050000, '2019-05-21', '20190521010849background-gradient.jpeg'),
(2, 3, 'Fulan', 'Mandiri', 14550000, '2019-05-21', '20190521011559background-gradient.jpeg'),
(3, 4, 'Ferry Irawan', 'BRI', 9020000, '2019-05-26', '20190526030437background-gradient.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_ongkir` int(5) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'Pending',
  `resi_pengiriman` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `id_ongkir`, `tanggal_pembelian`, `total_pembelian`, `nama_kota`, `tarif`, `alamat_pengiriman`, `status_pembelian`, `resi_pengiriman`) VALUES
(1, 1, 1, '2019-05-21', 9050000, 'Demak', 50000, 'Mraggen Demak Jawa Tengah Kode Pos 50021', 'Barang dikirim', 'R01'),
(2, 1, 2, '2019-05-21', 6520000, 'Cirebon', 20000, 'Cirebon Kota Jawa Barat Kode Pos 54323', 'Pending', ''),
(3, 2, 1, '2019-05-21', 14550000, 'Demak', 50000, 'Kranggen Wetan Demak Kab Jawa Tengah Kode Pos 50341', 'Sudah kirim pembayaran', ''),
(4, 3, 2, '2019-05-21', 9020000, 'Cirebon', 20000, 'Cipopo Karangleunyi Kab. Cirebon Jawa Barat', 'Barang dikirim', 'R1'),
(6, 3, 2, '2019-05-21', 4520000, 'Cirebon', 20000, 'Cirebon Jawa Barat Kode Pos 56634', 'Pending', ''),
(7, 1, 1, '2019-05-23', 6350000, 'Demak', 50000, 'Desa karanglanggeng Rt.02 Rw.01 Kecamatan Mranggen Kabupaten Demak Jawa Tengah Kode Pos 50523', 'Pending', ''),
(8, 1, 1, '2019-05-25', 9700000, 'Demak', 50000, 'Mranggen Demak 50123', 'Pending', ''),
(9, 3, 2, '2019-05-26', 20500, 'Cirebon', 20000, 'FIKTIF AJA', 'Pending', ''),
(10, 4, 1, '2019-06-04', 24200000, 'Demak', 50000, 'Mranggen Demak Kota Demak Kode Pos 50313', 'Pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `subberat` int(11) NOT NULL,
  `subharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`, `nama`, `harga`, `berat`, `subberat`, `subharga`) VALUES
(1, 1, 1, 2, 'Polytron', 4500000, 1000, 2000, 9000000),
(2, 2, 7, 1, 'Samsung', 6500000, 3000, 3000, 6500000),
(3, 3, 8, 2, 'Sony', 5000000, 3000, 6000, 10000000),
(4, 3, 9, 1, 'LG', 4500000, 2500, 2500, 4500000),
(5, 4, 1, 1, 'Polytron', 4500000, 1000, 1000, 4500000),
(6, 4, 9, 1, 'LG', 4500000, 2500, 2500, 4500000),
(7, 5, 1, 0, 'Polytron', 4500000, 1000, 0, 0),
(8, 6, 1, 1, 'Polytron', 4500000, 1000, 1000, 4500000),
(9, 7, 10, 1, 'Panasonic', 6300000, 3100, 3100, 6300000),
(10, 8, 14, 1, 'LG AI Think-Q', 9650000, 1000, 1000, 9650000),
(11, 9, 17, 1, 'SEMBARANG', 500, 10000, 10000, 500),
(12, 10, 14, 1, 'LG AI Think-Q', 9650000, 1000, 1000, 9650000),
(13, 10, 13, 1, 'CANON', 5500000, 1000, 1000, 5500000),
(14, 10, 9, 2, 'LG', 4500000, 2500, 5000, 9000000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `berat_produk` int(11) NOT NULL,
  `foto_produk` varchar(100) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `stok_produk` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `berat_produk`, `foto_produk`, `deskripsi_produk`, `stok_produk`) VALUES
(1, 'POLYTRON', 4500000, 1000, 'televisi 2.jpg', 'Warna Silver, Type 21, Model LED', 10),
(7, 'SAMSUNG', 6500000, 3000, 'televisi 3.jpg', 'Warna Hitam, Type 21, Model OLED', 10),
(8, 'SONY', 5000000, 3000, 'televisi 4.jpg', 'Warna Silver, Type 27, Model Flat Design', 10),
(9, 'LG', 4500000, 2500, 'televisi 5.jpg', 'Warna Hitam, Type 21, Model LCD', 8),
(10, 'PANASONIC', 6300000, 3100, 'televisi 6.jpg', 'Warna Putih, Type 33, Model LCD', 10),
(12, 'SHARP', 4000000, 1500, 'lcd_3.jpg', 'Warna Hitam\r\nModel LCD\r\nType 23 Inc\r\nSpeaker Double Sound dengan Automatic Found\r\nTV jenis ini adalah seri pertama dari produk SHARP yang mengadopsi sistem automatic found\r\n', 10),
(13, 'CANON', 5500000, 1000, 'led_1.jpg', 'Warna Silver\r\nModel LED\r\nType 32 Inc\r\nSpeaker Double Sound dengan Automatic Found\r\nSupport of SMART TV AI\r\nTV jenis ini adalah seri pertama dari produk CANON yang mengadopsi sistem automatic found dan sistem SMART TV AI\r\n', 9),
(14, 'LG AI Think-Q', 9650000, 1000, 'oled_2.jpg', 'Warna Hitam\r\nModel OLED\r\nType 55 Inc\r\nSpeaker Double Sound dengan Automatic Found\r\nSistem SMART TV AI Think-Q\r\nTV jenis ini adalah seri pertama dari produk LG yang mengadopsi sistem automatic found dan juga sistem SMART OLED TV AI Think-Q', 9),
(16, 'SAMSUNG Smart Screen', 8500000, 1000, 'oled_4.jpg', 'TV Samsung dengan keunggulan sistem smart screennya yang sangat canggih dan mampu mendeteksi keinginan penggunanya. Dalam tv ini disematkan AI atau kecerdasan buatan pada screen OLED.', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
