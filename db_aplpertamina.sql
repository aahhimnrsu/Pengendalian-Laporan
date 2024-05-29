-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2024 at 02:38 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_aplpertamina`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id` int(11) NOT NULL,
  `nama_barang` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id`, `nama_barang`) VALUES
(1, 'Safety Glasses'),
(2, 'Safety Helmet'),
(4, ' Resporatory Protection'),
(5, 'Safety Gloves'),
(6, 'Steel Toe Boots'),
(7, 'Wearpack Safety');

-- --------------------------------------------------------

--
-- Table structure for table `tb_peminjaman`
--

CREATE TABLE `tb_peminjaman` (
  `id` int(11) NOT NULL,
  `id_peminjam` int(11) NOT NULL,
  `nama_peminjam` varchar(100) NOT NULL,
  `nama_barang` text NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `foto` text NOT NULL,
  `kondisi` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_peminjaman`
--

INSERT INTO `tb_peminjaman` (`id`, `id_peminjam`, `nama_peminjam`, `nama_barang`, `jumlah`, `tanggal_peminjaman`, `tanggal_pengembalian`, `status`, `foto`, `kondisi`, `keterangan`) VALUES
(10, 4, 'Muhammad Raihan', 'Safety Gloves', 2, '2024-01-14', '2024-05-22', 'Telah Dikembalikan', '1Hze5z45gqzj7n5EfPzw.jpg', 'Rusak', 'dibayar'),
(11, 5, 'peminjam', 'Safety Gloves', 1, '2024-05-14', '2024-05-22', 'Belum Dikembalikan', '1Hze5z45gqzj7n5EfPzw.jpg', NULL, NULL),
(12, 2, 'admin', ' Resporatory Protection', 1, '2024-05-15', '2024-05-23', 'Telah Dikembalikan', '1Hze5z45gqzj7n5EfPzw.jpg', 'Baik', NULL),
(13, 2, 'admin', ' Resporatory Protection', 123, '2024-05-15', '2024-05-23', 'Belum Dikembalikan', '1Hze5z45gqzj7n5EfPzw.jpg', NULL, NULL),
(14, 2, 'admin', ' Resporatory Protection', 123, '2024-05-15', '2024-05-16', 'Belum Dikembalikan', '1Hze5z45gqzj7n5EfPzw.jpg', NULL, NULL),
(15, 6, 'Noni Tri Saputri', ' Resporatory Protection', 1, '2024-05-15', '2024-05-14', 'Belum Dikembalikan', '1Hze5z45gqzj7n5EfPzw.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `email` text NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `universitas` text NOT NULL,
  `alamat` text NOT NULL,
  `foto` text NOT NULL,
  `role` enum('Admin','Peminjam','Kepala Bagian') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `email`, `username`, `password`, `universitas`, `alamat`, `foto`, `role`) VALUES
(2, 'admin', '', 'admin', '12345', 'admin', 'rumahh', '1Hze5z45gqzj7n5EfPzw.jpg', 'Admin'),
(5, 'minjem', 'peminjam@gmail.com', 'peminjam', '', 'peminjam', 'testestes', 'WhatsApp-Image-2023-10-13-at-11.19.19-1-2-1024x768.jpeg', 'Peminjam'),
(6, 'Noni Tri Saputri', 'nonitrisaputri1215@gmail.com', 'noni', '123', 'Politeknik Negeri Sriwijaya', 'Jl. Sinilah', '1Hze5z45gqzj7n5EfPzw.jpg', 'Peminjam'),
(7, 'Amanda Ihsanan Putri', 'tes@gmail.com', 'manda', '123', 'Politeknik Negeri Sriwijaya', '123', '1Hze5z45gqzj7n5EfPzw.jpg', 'Peminjam');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
