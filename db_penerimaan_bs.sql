-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2023 at 12:47 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_penerimaan_bs`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pegawai`
--

CREATE TABLE `tbl_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pegawai`
--

INSERT INTO `tbl_pegawai` (`id_pegawai`, `nama_pegawai`, `email`) VALUES
(1, 'Nazaruddin', 'nazaruddin@email.com'),
(2, 'Ahmad Diva Wiguna', 'adwiguna@email.com'),
(3, 'Ahmad Taufiq', 'ataufiq@email.com'),
(4, 'Muhammad Rais', 'mrais@email.com'),
(5, 'Selva', 'selva@email.com'),
(6, 'Andi Muhammad Fadjrin Arif', 'fadjrin@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penerimaan_barang`
--

CREATE TABLE `tbl_penerimaan_barang` (
  `id` int(11) NOT NULL,
  `no_resi` varchar(25) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `nama_barang` varchar(25) NOT NULL,
  `deskripsi` text NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `foto_barang` text NOT NULL,
  `status` enum('Diterima','Belum Diterima') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_penerimaan_barang`
--

INSERT INTO `tbl_penerimaan_barang` (`id`, `no_resi`, `tanggal`, `nama_barang`, `deskripsi`, `id_pegawai`, `foto_barang`, `status`) VALUES
(1, '928294380', '2023-12-06', 'Jubah', 'Yang dikenakan dibadan', 1, '', 'Belum Diterima'),
(2, '87485048', '2023-12-18', 'Meja', 'benda yang digunakan untuk makan, menulis, dll', 3, 'uploads/1702941087_9c91d3e2e5a75708577f.jpg', 'Diterima'),
(3, '61283590', '2023-12-07', 'Kulkas', 'Lemari pendingin yang digunakan untuk mendinginkan makanan', 5, 'uploads/1702942178_4fc60aa0a7d537e3d548.jpg', 'Belum Diterima'),
(4, '193302226', '2023-12-11', 'Kursi', 'Benda yang diduduki', 1, 'uploads/1702942266_ef35d1f838e412f32c33.jpg', 'Belum Diterima'),
(5, '611510665', '2023-12-15', 'Headset', 'Alat untuk mendengarkan suara', 4, 'uploads/1702942312_1a40fa9220479bbf6a4e.jpg', 'Belum Diterima'),
(6, '629677621', '2023-12-12', 'printer', 'Untuk mencetak dokumen', 2, 'uploads/1702942426_7c26dacdf523c91acb9b.jpeg', 'Belum Diterima'),
(7, '936437063', '2023-12-03', 'Laptop', 'Benda yang digunakan untuk mengetik dokumen, program', 6, 'uploads/1702942496_4bd579c0e10716580b85.jpeg', 'Belum Diterima'),
(8, '425915574', '2023-12-01', 'Monitor', 'Alat yang menampilkan gambar', 1, 'uploads/1702942554_754fd8022a9360d03632.jpg', 'Diterima'),
(9, '991548330', '2023-12-09', 'Keyboard', 'Alat yang digunakan untuk mengetik', 4, 'uploads/1702942617_2fd8dc46d0df1cce26ac.jpeg', 'Diterima'),
(10, '453951769', '2023-12-18', 'Handphone', 'alat yang digunakan menelpon', 3, 'uploads/1702942673_a896f7b19f1279e89b6a.jpeg', 'Belum Diterima'),
(11, '403527447', '2023-12-18', 'Proyektor', 'Alat yang digunakan presentasi', 5, 'uploads/1702942753_56e4e9f14192b4de0f5a.jpg', 'Diterima');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penerimaan_surat`
--

CREATE TABLE `tbl_penerimaan_surat` (
  `id` int(11) NOT NULL,
  `no.surat` varchar(25) NOT NULL,
  `nama_surat` varchar(25) NOT NULL,
  `deskripsi` text NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `foto_surat` text NOT NULL,
  `status` enum('Sudah Diterima','Belum Diterima') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin6', 'admin6@email.com', '$2y$10$FEvsbk0CktTcO.ENxXxI/OlSRro0LG1pLiixFQ./TZLTj3kYxeDHe'),
(2, 'Ade Kurniawan', 'ade.kurniawan@ptdes.net', '$2y$10$ocWX1P8ZRlugdXWeTwQk5O8F6JPu7SPpqv5xVzPjxx152KPEI3cpK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `tbl_penerimaan_barang`
--
ALTER TABLE `tbl_penerimaan_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `tbl_penerimaan_surat`
--
ALTER TABLE `tbl_penerimaan_surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_penerimaan_barang`
--
ALTER TABLE `tbl_penerimaan_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_penerimaan_surat`
--
ALTER TABLE `tbl_penerimaan_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_penerimaan_barang`
--
ALTER TABLE `tbl_penerimaan_barang`
  ADD CONSTRAINT `tbl_penerimaan_barang_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `tbl_pegawai` (`id_pegawai`);

--
-- Constraints for table `tbl_penerimaan_surat`
--
ALTER TABLE `tbl_penerimaan_surat`
  ADD CONSTRAINT `tbl_penerimaan_surat_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `tbl_pegawai` (`id_pegawai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
