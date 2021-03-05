-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2019 at 07:33 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perhotelan`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_laundry`
--

CREATE TABLE `jenis_laundry` (
  `id_jenis_laundry` int(11) NOT NULL,
  `nama` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `harga` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_laundry`
--

INSERT INTO `jenis_laundry` (`id_jenis_laundry`, `nama`, `type`, `harga`) VALUES
(1, 'Shirt', 'gentlemen', '20000'),
(2, 'Safari Shirt', 'gentlemen', '15000'),
(3, 'Under Shirt', 'gentlemen', '20000'),
(4, 'Under Short', 'gentlemen', '20000'),
(5, 'Trousers', 'gentlemen', '25000'),
(6, 'Shourt', 'gentlemen', '20000'),
(7, 'T-Shirt', 'gentlemen', '15000'),
(8, 'Suit', 'gentlemen', '18000'),
(9, 'Jacket', 'gentlemen', '15000'),
(10, 'Sarung', 'gentlemen', '25000'),
(11, 'Pijamas', 'gentlemen', '25000'),
(12, 'Handkerchief', 'gentlemen', '30000'),
(13, 'Necktie', 'gentlemen', '15000'),
(14, 'Socks', 'gentlemen', '15000'),
(15, 'Blouse', 'ladies', '20000'),
(16, 'Dress', 'ladies', '30000'),
(17, 'Kebaya', 'ladies', '40000'),
(18, 'Skirt', 'ladies', '35000'),
(19, 'Night Grown', 'ladies', '25000'),
(20, 'Panty', 'ladies', '20000'),
(21, 'Blassire', 'ladies', '35000'),
(22, 'Scarf', 'ladies', '30000'),
(23, 'Slip', 'ladies', '20000'),
(24, 'Blouse/Skirt', 'children', '15000'),
(25, 'Trouse', 'children', '15000'),
(26, 'Dress', 'children', '25000'),
(27, 'T-Shirt', 'children', '15000'),
(28, 'Short', 'children', '18000'),
(29, 'Under Shirt', 'children', '15000'),
(30, 'Under Short', 'children', '20000'),
(31, 'Jacket', 'children', '35000');

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `no_kamar` varchar(50) NOT NULL,
  `id_tipe_kamar` varchar(11) NOT NULL,
  `max_dewasa` varchar(10) NOT NULL,
  `max_anak` varchar(10) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `no_kamar`, `id_tipe_kamar`, `max_dewasa`, `max_anak`, `status`) VALUES
(1, '100', '1', '2', '2', 'Tersedia'),
(2, '101', '1', '2', '2', 'Tersedia'),
(3, '102', '1', '2', '2', 'Tersedia'),
(4, '103', '1', '2', '2', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `laundry`
--

CREATE TABLE `laundry` (
  `id_laundry` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `waktu` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `type` varchar(50) NOT NULL,
  `total` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `laundry_detail`
--

CREATE TABLE `laundry_detail` (
  `id_laundry_detail` int(11) NOT NULL,
  `id_laundry` int(11) NOT NULL,
  `id_jenis_laundry` int(11) NOT NULL,
  `article` text NOT NULL,
  `qty` varchar(30) NOT NULL,
  `total` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE `meja` (
  `id_meja` int(11) NOT NULL,
  `kd_meja` varchar(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`id_meja`, `kd_meja`, `status`) VALUES
(3, 'A02', 'Kosong'),
(4, 'A03', 'Kosong'),
(5, 'A04', 'Kosong'),
(7, 'A01', 'Kosong'),
(8, 'A05', 'Kosong'),
(9, 'A06', 'Kosong'),
(10, 'A07', 'Kosong');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `img_menu` varchar(150) NOT NULL,
  `harga_menu` varchar(20) NOT NULL,
  `kategori` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `img_menu`, `harga_menu`, `kategori`) VALUES
(2, 'Pizza', 'Menu_13711547_24420166.jpg', '100000', 'Makanan'),
(4, 'Hamburger', 'Menu_85589599_20065307.jpg', '80000', 'Makanan'),
(5, 'Sate Ayam', 'Menu_88854980_79116821.jpg', '50000', 'Makanan'),
(6, 'Sushi', 'Menu_42721557_58386230.jpg', '85000', 'Makanan');

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id_perusahaan` int(11) NOT NULL,
  `nama_hotel` text NOT NULL,
  `nama_perusahaan` text NOT NULL,
  `jalan` varchar(50) NOT NULL,
  `no_jalan` varchar(10) NOT NULL,
  `kecamatan` char(100) NOT NULL,
  `kabupaten` char(100) NOT NULL,
  `provinsi` char(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `no_fax` varchar(20) NOT NULL,
  `website` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`id_perusahaan`, `nama_hotel`, `nama_perusahaan`, `jalan`, `no_jalan`, `kecamatan`, `kabupaten`, `provinsi`, `no_telp`, `no_fax`, `website`, `email`) VALUES
(1, 'Hotel Santika', 'PT. Jaya Abadi', 'Pattimura', '23', 'Muncar', 'Banyuwangi', 'Jawa Timur', '0(333) 3633', '0(333) 2333', 'www.santikamyhotel.com', 'santikahotel.id@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` varchar(11) NOT NULL,
  `id_transaksi_kamar` varchar(11) NOT NULL,
  `id_meja` int(11) NOT NULL,
  `total` varchar(30) NOT NULL,
  `waktu` varchar(15) NOT NULL,
  `tanggal` date NOT NULL,
  `lokasi_pemesanan` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_detail`
--

CREATE TABLE `pesanan_detail` (
  `id_pesanan_detail` int(11) NOT NULL,
  `id_pesanan` varchar(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `qty` int(10) NOT NULL,
  `total_harga` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tamu`
--

CREATE TABLE `tamu` (
  `id_tamu` varchar(11) NOT NULL,
  `prefix` char(20) NOT NULL,
  `nama_depan` varchar(100) NOT NULL,
  `nama_belakang` varchar(100) NOT NULL,
  `tipe_identitas` varchar(50) NOT NULL,
  `no_identitas` varchar(30) NOT NULL,
  `warga_negara` varchar(30) NOT NULL,
  `jalan` varchar(50) NOT NULL,
  `no_jalan` varchar(10) NOT NULL,
  `kabupaten` char(50) NOT NULL,
  `provinsi` char(50) NOT NULL,
  `no_telp` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tipe_kamar`
--

CREATE TABLE `tipe_kamar` (
  `id_tipe_kamar` int(11) NOT NULL,
  `tipe_kamar` text NOT NULL,
  `harga_per_mlm` varchar(50) NOT NULL,
  `harga_per_org` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipe_kamar`
--

INSERT INTO `tipe_kamar` (`id_tipe_kamar`, `tipe_kamar`, `harga_per_mlm`, `harga_per_org`) VALUES
(1, 'Standart', '150000', '70000');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_kamar`
--

CREATE TABLE `transaksi_kamar` (
  `id_transaksi_kamar` varchar(11) NOT NULL,
  `no_invoice` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `id_tamu` varchar(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `jumlah_dewasa` varchar(10) NOT NULL,
  `jumlah_anak` varchar(10) NOT NULL,
  `tgl_checkin` date NOT NULL,
  `waktu_checkin` varchar(20) NOT NULL,
  `tgl_checkout` date NOT NULL,
  `waktu_checkout` varchar(20) NOT NULL,
  `total_biaya_kamar` varchar(20) NOT NULL,
  `bayar` varchar(30) NOT NULL,
  `deposit` varchar(20) NOT NULL,
  `surcharge` varchar(30) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_laundry`
--

CREATE TABLE `transaksi_laundry` (
  `id_transaksi_laundry` int(11) NOT NULL,
  `id_laundry` int(11) NOT NULL,
  `waktu` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `total` varchar(30) NOT NULL,
  `bayar` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_resto`
--

CREATE TABLE `transaksi_resto` (
  `id_transaksi_resto` int(11) NOT NULL,
  `id_pesanan` varchar(11) NOT NULL,
  `total` varchar(30) NOT NULL,
  `bayar` varchar(30) NOT NULL,
  `waktu` varchar(15) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` text NOT NULL,
  `image` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(30) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `image`, `username`, `password`, `level`, `no_telp`, `status`) VALUES
(1, 'Mirza Dwiyan Saputra', 'User_191101_113006.png', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Super Admin', '085258546987', 'petugas hotel'),
(3, 'Mirza Saputra', 'default.jpg', 'waiter', 'e9daa4e8a187ff9b6b1c4f30b232ea58', 'Waiter', '082564987521', 'petugas resto'),
(5, 'Mirza Dwiyan Saputra', 'User_553466_329620.jpg', 'frontoffice', 'e9daa4e8a187ff9b6b1c4f30b232ea58', 'Front Office', '089697635133', 'petugas hotel'),
(6, 'Mirza Dwiyan Saputra', 'User_506591_220245.png', 'roomservice', 'e9daa4e8a187ff9b6b1c4f30b232ea58', 'Room Service', '089697635133', 'petugas hotel'),
(7, 'Mirza Dwiyan Saputra', 'User_164733_738983.png', 'laundry', 'e9daa4e8a187ff9b6b1c4f30b232ea58', 'Laundry', '089697635133', 'petugas hotel'),
(17, 'Mirza Saputra', 'default.jpg', 'adminresto', 'e9daa4e8a187ff9b6b1c4f30b232ea58', 'Admin Resto', '082456985802', 'petugas resto'),
(18, 'Mirza Saputra', 'User_29148917_79842189.jpg', 'kasir', 'e9daa4e8a187ff9b6b1c4f30b232ea58', 'Kasir', '085258546987', 'petugas resto'),
(19, 'Mirza Dwiyan Saputra', 'default.jpg', 'owner', '72122ce96bfec66e2396d2e25225d70a', 'Owner', '089697635133', 'petugas hotel');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_laundry`
--
ALTER TABLE `jenis_laundry`
  ADD PRIMARY KEY (`id_jenis_laundry`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `laundry`
--
ALTER TABLE `laundry`
  ADD PRIMARY KEY (`id_laundry`);

--
-- Indexes for table `laundry_detail`
--
ALTER TABLE `laundry_detail`
  ADD PRIMARY KEY (`id_laundry_detail`);

--
-- Indexes for table `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`id_meja`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD PRIMARY KEY (`id_pesanan_detail`);

--
-- Indexes for table `tamu`
--
ALTER TABLE `tamu`
  ADD PRIMARY KEY (`id_tamu`);

--
-- Indexes for table `tipe_kamar`
--
ALTER TABLE `tipe_kamar`
  ADD PRIMARY KEY (`id_tipe_kamar`);

--
-- Indexes for table `transaksi_kamar`
--
ALTER TABLE `transaksi_kamar`
  ADD PRIMARY KEY (`id_transaksi_kamar`);

--
-- Indexes for table `transaksi_laundry`
--
ALTER TABLE `transaksi_laundry`
  ADD PRIMARY KEY (`id_transaksi_laundry`);

--
-- Indexes for table `transaksi_resto`
--
ALTER TABLE `transaksi_resto`
  ADD PRIMARY KEY (`id_transaksi_resto`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_laundry`
--
ALTER TABLE `jenis_laundry`
  MODIFY `id_jenis_laundry` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `laundry`
--
ALTER TABLE `laundry`
  MODIFY `id_laundry` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `laundry_detail`
--
ALTER TABLE `laundry_detail`
  MODIFY `id_laundry_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `meja`
--
ALTER TABLE `meja`
  MODIFY `id_meja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  MODIFY `id_pesanan_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tipe_kamar`
--
ALTER TABLE `tipe_kamar`
  MODIFY `id_tipe_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi_laundry`
--
ALTER TABLE `transaksi_laundry`
  MODIFY `id_transaksi_laundry` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi_resto`
--
ALTER TABLE `transaksi_resto`
  MODIFY `id_transaksi_resto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
