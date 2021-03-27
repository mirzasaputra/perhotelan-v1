-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 27, 2021 at 12:22 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id_booking` varchar(15) NOT NULL,
  `id_tamu` varchar(15) NOT NULL,
  `tgl_booking` date NOT NULL,
  `tgl_check_in` date NOT NULL,
  `waktu_check_in` varchar(12) NOT NULL,
  `tgl_checkout` date NOT NULL,
  `waktu_checkout` varchar(12) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id_booking`, `id_tamu`, `tgl_booking`, `tgl_check_in`, `waktu_check_in`, `tgl_checkout`, `waktu_checkout`, `status`) VALUES
('ID478440', 'ID27538', '2021-03-27', '2021-03-29', '12:00', '2021-03-31', '12:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `booking_detail`
--

CREATE TABLE `booking_detail` (
  `id_booking_detail` int(11) NOT NULL,
  `id_booking` varchar(15) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `jumlah_dewasa` int(11) NOT NULL,
  `jumlah_anak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_detail`
--

INSERT INTO `booking_detail` (`id_booking_detail`, `id_booking`, `id_kamar`, `jumlah_dewasa`, `jumlah_anak`) VALUES
(4, 'ID478440', 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` int(11) NOT NULL,
  `fasilitas_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id`, `fasilitas_name`) VALUES
(2, 'Makan gratis di setiap pagi'),
(4, 'Wifi internet gratis'),
(5, 'Kolam renang');

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
(1, '100', '1', '2', '2', 'kotor'),
(2, '101', '1', '2', '2', 'Terpakai'),
(3, '102', '1', '2', '2', 'Tersedia'),
(4, '103', '1', '2', '2', 'Tersedia'),
(5, '104', '2', '2', '2', 'kotor');

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

--
-- Dumping data for table `laundry`
--

INSERT INTO `laundry` (`id_laundry`, `id_kamar`, `waktu`, `tanggal`, `type`, `total`, `status`) VALUES
(1, 2, '22:39', '2021-03-05', 'gentlemen', '15000', 'selesai'),
(2, 2, '14:13', '2021-03-07', 'ladies', '35000', 'selesai');

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

--
-- Dumping data for table `laundry_detail`
--

INSERT INTO `laundry_detail` (`id_laundry_detail`, `id_laundry`, `id_jenis_laundry`, `article`, `qty`, `total`) VALUES
(13, 1, 2, 'adasd', '1', '15000'),
(14, 2, 21, 'qweqwe', '1', '35000');

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
(7, 'A01', 'Penuh'),
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
  `email` varchar(100) NOT NULL,
  `logo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`id_perusahaan`, `nama_hotel`, `nama_perusahaan`, `jalan`, `no_jalan`, `kecamatan`, `kabupaten`, `provinsi`, `no_telp`, `no_fax`, `website`, `email`, `logo`) VALUES
(1, 'Hotel Santika', 'PT. Jaya Abadi', 'Pattimura', '23', 'Muncar', 'Banyuwangi', 'Jawa Timur', '0(333) 3633', '0(333) 2333', 'www.santikamyhotel.com', 'santikahotel.id@gmail.com', 'logo_951484_07_03_2021.jpeg');

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

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_transaksi_kamar`, `id_meja`, `total`, `waktu`, `tanggal`, `lokasi_pemesanan`, `status`) VALUES
('ID60579223', 'ID294988', 7, '85000', '18:13', '2021-03-05', 'Dari Resto', 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_detail`
--

CREATE TABLE `pesanan_detail` (
  `id_pesanan_detail` int(11) UNSIGNED NOT NULL,
  `id_pesanan` varchar(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `qty` int(10) NOT NULL,
  `total_harga` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan_detail`
--

INSERT INTO `pesanan_detail` (`id_pesanan_detail`, `id_pesanan`, `id_menu`, `qty`, `total_harga`) VALUES
(20, 'ddgfhjk', 1, 1, '1212'),
(23, 'ID60579223', 6, 1, '85000');

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

--
-- Dumping data for table `tamu`
--

INSERT INTO `tamu` (`id_tamu`, `prefix`, `nama_depan`, `nama_belakang`, `tipe_identitas`, `no_identitas`, `warga_negara`, `jalan`, `no_jalan`, `kabupaten`, `provinsi`, `no_telp`) VALUES
('ID27538', 'Mr', 'Mirza', 'Saputra', 'KTP', '3546217632', 'Indonesia', 'Patung Raya', '10', 'Banyuwangi', 'Jawa Timur', '0897487387382');

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
(1, 'Standart', '600000', '300000'),
(2, 'VVIP', '2000000', '1000000');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_kamar`
--

CREATE TABLE `transaksi_kamar` (
  `id_transaksi_kamar` varchar(11) NOT NULL,
  `no_invoice` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `id_tamu` varchar(11) NOT NULL,
  `id_kamar` int(11) DEFAULT NULL,
  `jumlah_dewasa` varchar(10) DEFAULT NULL,
  `jumlah_anak` varchar(10) DEFAULT NULL,
  `tgl_checkin` date NOT NULL,
  `waktu_checkin` varchar(20) NOT NULL,
  `tgl_checkout` date NOT NULL,
  `waktu_checkout` varchar(20) NOT NULL,
  `total_biaya_kamar` varchar(20) NOT NULL,
  `bayar` varchar(30) NOT NULL,
  `diskon` int(11) NOT NULL,
  `deposit` varchar(20) NOT NULL,
  `surcharge` varchar(30) NOT NULL,
  `total` int(11) NOT NULL,
  `metode_pembayaran` varchar(100) NOT NULL,
  `metode_deposit` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_kamar`
--

INSERT INTO `transaksi_kamar` (`id_transaksi_kamar`, `no_invoice`, `tanggal`, `id_tamu`, `id_kamar`, `jumlah_dewasa`, `jumlah_anak`, `tgl_checkin`, `waktu_checkin`, `tgl_checkout`, `waktu_checkout`, `total_biaya_kamar`, `bayar`, `diskon`, `deposit`, `surcharge`, `total`, `metode_pembayaran`, `metode_deposit`, `status`) VALUES
('ID179753', 'INV-83315152-29', '2021-03-24', 'ID27538', NULL, NULL, NULL, '2021-03-24', '22:48', '2021-03-25', '12:00', '2600000', '2426000', 520000, '300000', '100000', 2726000, 'cash', 'cash', 'check out'),
('ID1849285', 'INV-49670515-19', '2021-03-27', 'ID27538', NULL, NULL, NULL, '2021-03-27', '17:39', '2021-03-31', '12:00', '2400000', '', 0, '100000', '', 0, '', 'cash', 'check in'),
('ID2401924', 'INV-5179659-2', '2021-03-17', 'ID27538', NULL, NULL, NULL, '2021-03-17', '18:17', '2021-03-18', '12:00', '400000', '384000', 0, '100000', '', 484000, 'transfer', 'transfer', 'check out'),
('ID2765778', 'INV-43855836-76', '2021-03-20', 'ID27538', NULL, NULL, NULL, '2021-03-20', '22:22', '2021-03-22', '12:00', '1700000', '1787000', 170000, '200000', '100000', 1987000, 'cash', 'cash', 'check out'),
('ID3614002', 'INV-30548740-62', '2021-03-19', 'ID27538', NULL, NULL, NULL, '2021-03-19', '18:24', '2021-03-21', '12:00', '300000', '413000', 0, '100000', '150000', 513000, 'cash', 'cash', 'check out'),
('ID8541574', 'INV-41571741-32', '2021-03-17', 'ID27538', NULL, NULL, NULL, '2021-03-17', '18:14', '2021-03-19', '12:00', '600000', '626000', 0, '100000', '', 726000, 'cash', 'cash', 'check out');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_kamar_detail`
--

CREATE TABLE `transaksi_kamar_detail` (
  `id_transaksi_kamar_detail` bigint(20) NOT NULL,
  `id_transaksi_kamar` varchar(20) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `jumlah_anak` int(11) NOT NULL,
  `jumlah_dewasa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_kamar_detail`
--

INSERT INTO `transaksi_kamar_detail` (`id_transaksi_kamar_detail`, `id_transaksi_kamar`, `id_kamar`, `jumlah_anak`, `jumlah_dewasa`) VALUES
(14, 'ID8541574', 1, 0, 2),
(15, 'ID8541574', 2, 0, 1),
(16, 'ID2401924', 5, 1, 2),
(17, 'ID2401924', 4, 0, 2),
(18, 'ID3614002', 3, 1, 2),
(19, 'ID2765778', 1, 0, 2),
(20, 'ID2765778', 2, 1, 2),
(21, 'ID2765778', 3, 0, 2),
(22, 'ID2765778', 4, 2, 2),
(23, 'ID2765778', 5, 2, 2),
(24, 'ID179753', 1, 0, 2),
(25, 'ID179753', 5, 1, 2),
(26, 'ID1849285', 2, 1, 2);

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

--
-- Dumping data for table `transaksi_laundry`
--

INSERT INTO `transaksi_laundry` (`id_transaksi_laundry`, `id_laundry`, `waktu`, `tanggal`, `total`, `bayar`) VALUES
(7, 1, '22:42', '2021-03-05', '18150', '19000'),
(8, 2, '14:15', '2021-03-07', '42350', '43000');

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
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`);

--
-- Indexes for table `booking_detail`
--
ALTER TABLE `booking_detail`
  ADD PRIMARY KEY (`id_booking_detail`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `transaksi_kamar_detail`
--
ALTER TABLE `transaksi_kamar_detail`
  ADD PRIMARY KEY (`id_transaksi_kamar_detail`);

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
-- AUTO_INCREMENT for table `booking_detail`
--
ALTER TABLE `booking_detail`
  MODIFY `id_booking_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jenis_laundry`
--
ALTER TABLE `jenis_laundry`
  MODIFY `id_jenis_laundry` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `laundry`
--
ALTER TABLE `laundry`
  MODIFY `id_laundry` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `laundry_detail`
--
ALTER TABLE `laundry_detail`
  MODIFY `id_laundry_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `id_pesanan_detail` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tipe_kamar`
--
ALTER TABLE `tipe_kamar`
  MODIFY `id_tipe_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi_kamar_detail`
--
ALTER TABLE `transaksi_kamar_detail`
  MODIFY `id_transaksi_kamar_detail` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `transaksi_laundry`
--
ALTER TABLE `transaksi_laundry`
  MODIFY `id_transaksi_laundry` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
