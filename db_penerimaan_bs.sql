-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jan 2024 pada 06.12
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

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
-- Struktur dari tabel `tbl_pegawai`
--

CREATE TABLE `tbl_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_pegawai`
--

INSERT INTO `tbl_pegawai` (`id_pegawai`, `nama_pegawai`, `email`) VALUES
(1, 'Nazaruddin', 'nazaruddin@email.com'),
(2, 'Ahmad Diva Wiguna', 'adwiguna@email.com'),
(3, 'Ahmad Taufiq', 'ataufiq@email.com'),
(4, 'Muhammad Rais', 'mrais@email.com'),
(5, 'Selva', 'selva@email.com'),
(6, 'Andi Muhammad Fadjrin Arif', 'amfadjrin21@mhs.akba.ac.id'),
(7, 'Sultan Fadil', 'sifadil@email.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penerimaan_barang`
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
-- Dumping data untuk tabel `tbl_penerimaan_barang`
--

INSERT INTO `tbl_penerimaan_barang` (`id`, `no_resi`, `tanggal`, `nama_barang`, `deskripsi`, `id_pegawai`, `foto_barang`, `status`) VALUES
(2, '87485048', '2024-01-02', 'Meja', 'benda yang digunakan untuk makan, menulis, dll', 3, 'uploads/1702941087_9c91d3e2e5a75708577f.jpg', 'Diterima'),
(3, '61283590', '2023-12-07', 'Kulkas', 'Lemari pendingin yang digunakan untuk mendinginkan makanan', 5, 'uploads/1702942178_4fc60aa0a7d537e3d548.jpg', 'Diterima'),
(4, '193302226', '2023-12-11', 'Kursi', 'Benda yang diduduki', 1, 'uploads/1702942266_ef35d1f838e412f32c33.jpg', 'Diterima'),
(5, '611510665', '2023-12-15', 'Headset', 'Alat untuk mendengarkan suara', 4, 'uploads/1702942312_1a40fa9220479bbf6a4e.jpg', 'Diterima'),
(6, '629677621', '2023-12-12', 'printer', 'Untuk mencetak dokumen', 2, 'uploads/1702942426_7c26dacdf523c91acb9b.jpeg', 'Diterima'),
(8, '425915574', '2023-12-01', 'Monitor', 'Alat yang menampilkan gambar', 1, 'uploads/1702942554_754fd8022a9360d03632.jpg', 'Diterima'),
(9, '991548330', '2023-12-09', 'Keyboard', 'Alat yang digunakan untuk mengetik', 4, 'uploads/1702942617_2fd8dc46d0df1cce26ac.jpeg', 'Diterima'),
(10, '453951769', '2023-12-18', 'Handphone', 'alat yang digunakan menelpon', 3, 'uploads/1702942673_a896f7b19f1279e89b6a.jpeg', 'Belum Diterima'),
(11, '403527447', '2023-12-18', 'Proyektor', 'Alat yang digunakan presentasi', 5, 'uploads/1702942753_56e4e9f14192b4de0f5a.jpg', 'Diterima'),
(12, '592211804', '2023-12-18', 'Speaker', 'alat mendengar musik', 1, 'uploads/1702943866_6ce6ace09296ca5218d1.jpeg', 'Diterima'),
(13, '609574082', '2023-12-20', 'Map Plastik', 'Map plastik berwarna biru dengan ukuran A4. Kondisi barang baru dan masih dalam kemasan. Jumlah 50 buah.', 3, 'uploads/1703061018_0f10e0db23b7be3aa113.jpg', 'Diterima'),
(15, '24288699', '2023-12-21', 'Headset', 'Headset merek *** warna hitam jumlah 20 unit', 3, 'uploads/1703123938_4396da00cc708d815cbc.jpg', 'Belum Diterima'),
(16, '227350514', '2023-12-22', 'Mikrotik', 'Mikrotik berjumlah 15 unit', 7, 'uploads/1703207260_cac22de828b5ed9a072d.jpg', 'Diterima'),
(17, '387772494', '2023-12-22', 'Router tp-link', 'Router wifi berjumlah 15 unit', 6, 'uploads/1703208752_54a57c6f5f876a6faed8.jpg', 'Diterima'),
(18, '366767053', '2024-01-02', 'Handphone', 'Alat untuk berkomunikasi', 7, 'uploads/1704157248_b4db7a629b9189e8b9f3.jpg', 'Belum Diterima'),
(19, '673911628', '2024-01-02', 'Earphone', 'Headset wireless menggunakan bluetooth', 5, 'uploads/1704157299_ba5d0ed375afbf3a02f7.jpg', 'Belum Diterima');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penerimaan_surat`
--

CREATE TABLE `tbl_penerimaan_surat` (
  `id` int(11) NOT NULL,
  `no_surat` varchar(25) NOT NULL,
  `nama_surat` varchar(25) NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` text NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `foto_surat` text NOT NULL,
  `status` enum('Diterima','Belum Diterima') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_penerimaan_surat`
--

INSERT INTO `tbl_penerimaan_surat` (`id`, `no_surat`, `nama_surat`, `tanggal`, `deskripsi`, `id_pegawai`, `foto_surat`, `status`) VALUES
(2, '132ssa1', 'Surat Penarikan Mahasiswa', '2023-12-25', 'Surat Penarikan PKKM 2023', 6, 'uploads/1703495465_44b6faf3f1285ec0b69e.jpeg', 'Diterima'),
(3, '01/TI/A/2020', 'Surat Contoh Saja', '2023-12-25', 'Ini Hanyalah Contoh Surat Saja', 4, 'uploads/1703496474_1038856b1487a4a19fd5.jpeg', 'Diterima'),
(4, '012/TI/A/2020', 'Contoh Surat 2', '2023-12-25', 'Ini Contoh Surat', 5, 'uploads/1703496680_3c0ad5344fbe796f9aab.jpeg', 'Belum Diterima'),
(5, '03/TI/A/2020', 'Contoh Surat 3', '2023-12-25', 'Ini Contoh Surat 3', 7, 'uploads/1703496747_80a61b6323a8d513043b.jpeg', 'Diterima');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `remember_token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `email`, `password`, `remember_token`) VALUES
(1, 'admin6', 'admin6@email.com', '$2y$10$Bbr6ZbzFb9UR3PBoX.rg7OnZM1clh9/OV3CwiYIf3/2BSSSD8C86S', ''),
(2, 'Ade Kurniawan', 'ade.kurniawan@ptdes.net', '$2y$10$ocWX1P8ZRlugdXWeTwQk5O8F6JPu7SPpqv5xVzPjxx152KPEI3cpK', ''),
(3, 'Andi Fadjrin', 'andifadjrin@email.com', '$2y$10$WYuEWvYeLT7W/pAkOjU4IOZRhwElylCSl6G/zCGNcF8vzU57hjApG', 'IxgL4Khm6g3N6Oqx3BiUaHw1vWwWVhYf');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `tbl_penerimaan_barang`
--
ALTER TABLE `tbl_penerimaan_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `tbl_penerimaan_surat`
--
ALTER TABLE `tbl_penerimaan_surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tbl_penerimaan_barang`
--
ALTER TABLE `tbl_penerimaan_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `tbl_penerimaan_surat`
--
ALTER TABLE `tbl_penerimaan_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_penerimaan_barang`
--
ALTER TABLE `tbl_penerimaan_barang`
  ADD CONSTRAINT `tbl_penerimaan_barang_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `tbl_pegawai` (`id_pegawai`);

--
-- Ketidakleluasaan untuk tabel `tbl_penerimaan_surat`
--
ALTER TABLE `tbl_penerimaan_surat`
  ADD CONSTRAINT `tbl_penerimaan_surat_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `tbl_pegawai` (`id_pegawai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
