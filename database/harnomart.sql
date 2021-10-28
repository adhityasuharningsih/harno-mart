-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2021 at 11:41 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `harnomart`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` char(6) NOT NULL,
  `nm_barang` varchar(50) NOT NULL,
  `kategori` char(6) NOT NULL,
  `satuan` varchar(30) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nm_barang`, `kategori`, `satuan`, `harga`, `stok`, `created_at`, `updated_at`) VALUES
('BR0001', 'Bear Brand 189 ML', 'KT0019', 'Dus', 90000, 22, '2021-07-04 01:58:34', '2021-08-17 23:53:41'),
('BR0002', 'Top Delfi 24X16GR ', 'KT0002', 'Box', 250000, 14, '2021-07-03 19:16:04', '2021-08-12 04:28:01'),
('BR0003', 'Roma Malkist Coklat', 'KT0002', 'Renteng', 8500, 3, '2021-07-16 03:58:52', '2021-08-11 22:51:22'),
('BR0004', 'Kapal Api 50X65GR', 'KT0004', 'Dus', 230000, 6, '2021-07-25 03:45:05', '2021-08-28 04:25:37'),
('BR0005', 'Tolak Angin Cair 12-P', 'KT0006', 'Box', 230000, 14, '2021-07-25 03:47:16', '2021-08-11 20:19:27'),
('BR0006', 'Amplop Merpati 100 (152X90MM)', 'KT0007', 'Box', 11000, 6, '2021-07-25 03:48:06', '2021-07-25 23:48:14'),
('BR0007', 'Djarum 76 12 SLOP', 'KT0017', 'Slop', 127000, 9, '2021-07-25 03:48:43', '2021-07-25 06:32:29'),
('BR0008', 'Indomie Goreng 85GR', 'KT0001', 'Dus', 92000, 2, '2021-07-25 03:49:31', '2021-07-25 23:55:07'),
('BR0009', 'Mliwis Kecap Tanggung', 'KT0020', 'Pack', 109200, 5, '2021-07-25 03:52:17', '2021-07-25 06:32:30'),
('BR0010', 'Fresh Care Roll On ', 'KT0006', 'Box', 125000, 12, '2021-07-25 03:53:25', '2021-08-12 18:05:30'),
('BR0011', 'Adem Sari 7GR', 'KT0004', 'Renteng', 37000, 2, '2021-07-25 03:54:06', '2021-07-25 03:54:06'),
('BR0012', 'Charm 8-P Wing', 'KT0021', 'Pack', 30000, 2, '2021-07-25 03:55:13', '2021-07-25 03:55:13'),
('BR0013', 'Dancow Instant 27GR', 'KT0019', 'Renteng', 29000, 3, '2021-07-25 03:56:05', '2021-07-25 03:56:05'),
('BR0014', 'Makroni Jagung Mura', 'KT0002', 'Bal', 27000, 1, '2021-07-25 03:56:50', '2021-07-25 03:56:50'),
('BR0015', 'Domestos Nomos New', 'KT0022', 'Dus', 143000, 2, '2021-07-25 03:57:22', '2021-07-25 03:57:22'),
('BR0016', 'GG Surya Signature Coklat 12', 'KT0017', 'Slop', 160000, 3, '2021-07-25 03:58:11', '2021-07-25 23:48:15'),
('BR0017', 'GG International 50', 'KT0017', 'Slop', 66000, 0, '2021-07-25 03:58:35', '2021-07-25 23:48:15'),
('BR0018', 'Buku Sinar Dunia 38', 'KT0007', 'Pack', 22700, 2, '2021-07-25 03:59:00', '2021-07-25 23:55:08'),
('BR0019', 'Downy Sunrise 20ML (30str)', 'KT0014', 'Renteng', 10000, 3, '2021-07-25 04:00:23', '2021-07-25 04:21:05'),
('BR0020', 'Creme Ekonomi Lemon 196GR (30)', 'KT0013', 'Dus', 51000, 1, '2021-07-25 04:01:04', '2021-07-25 04:01:04'),
('BR0021', 'Pantene Shp AD 10ML (40+2)', 'KT0009', 'Renteng', 9500, 2, '2021-07-25 04:02:06', '2021-08-11 16:37:16');

-- --------------------------------------------------------

--
-- Table structure for table `brgkeluar`
--

CREATE TABLE `brgkeluar` (
  `id_brgkeluar` char(6) NOT NULL,
  `total` int(11) NOT NULL,
  `catatan` varchar(225) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brgkeluar`
--

INSERT INTO `brgkeluar` (`id_brgkeluar`, `total`, `catatan`, `created_at`, `updated_at`) VALUES
('BK0001', 261000, '', '2021-07-25 17:53:11', NULL),
('BK0002', 476500, 'Shampoo pantene sobek satu bungkus', '2021-07-25 23:48:14', NULL),
('BK0003', 157200, '', '2021-07-25 23:55:07', NULL),
('BK0004', 250000, '', '2021-07-29 07:45:37', NULL),
('BK0006', 19000, '', '2021-08-11 16:36:18', NULL),
('BK0007', 900000, '', '2021-08-17 23:53:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brgmasuk`
--

CREATE TABLE `brgmasuk` (
  `id_brgmasuk` char(6) NOT NULL,
  `id_supplier` char(6) NOT NULL,
  `foto_struk` varchar(30) NOT NULL,
  `catatan` varchar(225) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brgmasuk`
--

INSERT INTO `brgmasuk` (`id_brgmasuk`, `id_supplier`, `foto_struk`, `catatan`, `total`, `created_at`, `updated_at`) VALUES
('BM0001', 'SP0001', 'default.jpg', '', 258500, '2021-07-22 23:32:49', '2021-08-17 07:27:01'),
('BM0002', 'SP0001', 'Struk 1.jpg', 'nothing', 1198000, '2021-07-25 04:21:04', '2021-08-12 18:03:07'),
('BM0003', 'SP0004', 'Struk 1.jpg', '', 1611800, '2021-07-25 06:32:29', NULL),
('BM0004', 'SP0001', 'default.jpg', '', 1150000, '2021-07-28 20:04:14', NULL),
('BM0005', 'SP0003', 'default.jpg', '', 1000000, '2021-08-12 00:25:54', '2021-08-12 18:04:10'),
('BM0006', 'SP0004', 'default.jpg', '', 1930000, '2021-08-12 18:05:27', NULL),
('BM0007', 'SP0001', 'default.jpg', '', 450000, '2021-08-17 23:53:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `itembrgkeluar`
--

CREATE TABLE `itembrgkeluar` (
  `id_brgkeluar` char(6) NOT NULL,
  `id_barang` char(6) DEFAULT NULL,
  `nm_barang` varchar(50) NOT NULL,
  `satuan` varchar(30) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itembrgkeluar`
--

INSERT INTO `itembrgkeluar` (`id_brgkeluar`, `id_barang`, `nm_barang`, `satuan`, `harga`, `qty`) VALUES
('BK0001', 'BR0001', 'Bear Brand 189 ML', 'Dus', 87000, 3),
('BK0002', 'BR0004', 'Kapal Api 50X65GR', 'Dus', 230000, 1),
('BK0002', 'BR0006', 'Amplop Merpati 100 (152X90MM)', 'Box', 11000, 1),
('BK0002', 'BR0016', 'GG Surya Signature Coklat 12', 'Slop', 160000, 1),
('BK0002', 'BR0017', 'GG International 50', 'Slop', 66000, 1),
('BK0002', 'BR0021', 'Pantene Shp AD 10ML (40+2)', 'Renteng', 9500, 1),
('BK0003', 'BR0003', 'Roma Malkist Coklat', 'Renteng', 8500, 5),
('BK0003', 'BR0008', 'Indomie Goreng 85GR', 'Dus', 92000, 1),
('BK0003', 'BR0018', 'Buku Sinar Dunia 38', 'Pack', 22700, 1),
('BK0004', 'BR0004', 'Kapal Api 50X65GR', 'Dus', 250000, 1),
('BK0006', 'BR0021', 'Pantene Shp AD 10ML (40+2)', 'Renteng', 9500, 2),
('BK0007', 'BR0001', 'Bear Brand 189 ML', 'Dus', 90000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `itembrgmasuk`
--

CREATE TABLE `itembrgmasuk` (
  `id_brgmasuk` char(6) NOT NULL,
  `id_barang` char(6) DEFAULT NULL,
  `nm_barang` varchar(50) NOT NULL,
  `satuan` varchar(30) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itembrgmasuk`
--

INSERT INTO `itembrgmasuk` (`id_brgmasuk`, `id_barang`, `nm_barang`, `satuan`, `harga`, `qty`) VALUES
('BM0001', 'BR0002', 'Koki', 'Dus', 250000, 1),
('BM0001', 'BR0003', 'nganu', 'Dus', 8500, 1),
('BM0002', 'BR0001', 'Bear Brand 189 ML', 'Dus', 90000, 1),
('BM0002', 'BR0004', 'Kapal Api 50X65GR', 'Dus', 250000, 1),
('BM0002', 'BR0007', 'Djarum 76 12 SLOP', 'Slop', 127000, 1),
('BM0002', 'BR0008', 'Indomie Goreng 85GR', 'Dus', 92000, 1),
('BM0002', 'BR0010', 'Fresh Care Roll On ', 'Box', 125000, 1),
('BM0002', 'BR0016', 'GG Surya Signature Coklat 12', 'Slop', 160000, 1),
('BM0002', 'BR0019', 'Downy Sunrise 20ML (30str)', 'Renteng', 10000, 1),
('BM0003', 'BR0001', 'Bear Brand 189 ML', 'Dus', 87000, 1),
('BM0003', 'BR0003', 'Roma Malkist Coklat', 'Renteng', 8500, 1),
('BM0003', 'BR0005', 'Tolak Angin Cair 12-P', 'Box', 230000, 1),
('BM0003', 'BR0007', 'Djarum 76 12 SLOP', 'Slop', 127000, 1),
('BM0003', 'BR0009', 'Mliwis Kecap Tanggung', 'Pack', 109200, 1),
('BM0004', 'BR0001', 'Bear Brand 189 ML', 'Dus', 90000, 1),
('BM0004', 'BR0002', 'Top Delfi 24X16GR ', 'Box', 20000, 1),
('BM0004', 'BR0004', 'Kapal Api 50X65GR', 'Dus', 250000, 1),
('BM0005', 'BR0004', 'Kapal Api 50X65GR', 'Dus', 250000, 1),
('BM0005', 'BR0002', 'Top Delfi 24X16GR ', 'Box', 250000, 1),
('BM0006', 'BR0001', 'Bear Brand 189 ML', 'Dus', 90000, 1),
('BM0006', 'BR0004', 'Kapal Api 50X65GR', 'Dus', 230000, 1),
('BM0006', 'BR0010', 'Fresh Care Roll On ', 'Box', 125000, 1),
('BM0007', 'BR0001', 'Bear Brand 189 ML', 'Dus', 90000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` char(6) NOT NULL,
  `nm_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nm_kategori`) VALUES
('KT0001', 'Makanan Pokok'),
('KT0002', 'Makanan Kecil (Snack)'),
('KT0003', 'Minuman'),
('KT0004', 'Minuman Instant'),
('KT0005', 'Roti dan Makanan Kering'),
('KT0006', 'Obat-obatan'),
('KT0007', 'Alat Tulis dan Kantor'),
('KT0008', 'Sabun Mandi'),
('KT0009', 'Shampo'),
('KT0010', 'Pasta Gigi'),
('KT0011', 'Kosmetik'),
('KT0012', 'Detergent'),
('KT0013', 'Sabun Cream'),
('KT0014', 'Pelembut Pakaian'),
('KT0015', 'Perawatan Rumah'),
('KT0016', 'Perawatan Kamar Mandi'),
('KT0017', 'Rokok'),
('KT0018', 'Ice Cream'),
('KT0019', 'Susu'),
('KT0020', 'Bumbu Dapur'),
('KT0021', 'Pembalut'),
('KT0022', 'Obat Serangga');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` varchar(6) NOT NULL,
  `nm_supplier` varchar(50) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `email` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nm_supplier`, `alamat`, `no_hp`, `email`) VALUES
('SP0001', 'Wings', 'Jl. Maju jaya No.345 Sleman Yogyakarta', '081345670980', 'tehkantong@gmail.com'),
('SP0002', 'Frisian flag', 'skjflkshkfhlkjdlkjsj', '089765431234', 'dondon@gmail.com'),
('SP0003', 'PT.Anugrah Abadi', 'vbbnkljkbfghfgjfj', '089765431234', 'sadmin@tries.co.id'),
('SP0004', 'PT.Nusa Indah ', 'Jl.Jambu No.3 Kutoarjo', '081345670980', 'devel@clandys.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` char(7) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `alamat`, `no_hp`, `username`, `password`, `level`) VALUES
('USER001', 'mimin', 'kjkhjgghfhg', '081345670980', 'mimin', '1234', 1),
('USER002', 'joko', 'gdrhrujgj', '081345670980', 'admin', 'admin', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `kategori` (`kategori`);

--
-- Indexes for table `brgkeluar`
--
ALTER TABLE `brgkeluar`
  ADD PRIMARY KEY (`id_brgkeluar`);

--
-- Indexes for table `brgmasuk`
--
ALTER TABLE `brgmasuk`
  ADD PRIMARY KEY (`id_brgmasuk`),
  ADD KEY `brgmasuk_ibfk_1` (`id_supplier`);

--
-- Indexes for table `itembrgkeluar`
--
ALTER TABLE `itembrgkeluar`
  ADD KEY `id_brgkeluar` (`id_brgkeluar`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `itembrgmasuk`
--
ALTER TABLE `itembrgmasuk`
  ADD KEY `id_brgmasuk` (`id_brgmasuk`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Constraints for table `brgmasuk`
--
ALTER TABLE `brgmasuk`
  ADD CONSTRAINT `brgmasuk_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE NO ACTION;

--
-- Constraints for table `itembrgkeluar`
--
ALTER TABLE `itembrgkeluar`
  ADD CONSTRAINT `itembrgkeluar_ibfk_1` FOREIGN KEY (`id_brgkeluar`) REFERENCES `brgkeluar` (`id_brgkeluar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itembrgkeluar_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `itembrgmasuk`
--
ALTER TABLE `itembrgmasuk`
  ADD CONSTRAINT `itembrgmasuk_ibfk_1` FOREIGN KEY (`id_brgmasuk`) REFERENCES `brgmasuk` (`id_brgmasuk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itembrgmasuk_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE SET NULL ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
