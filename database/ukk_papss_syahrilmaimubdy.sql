-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 05, 2026 at 02:51 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukk_papss_syahrilmaimubdy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_syahrilmaimubdy`
--

CREATE TABLE `admin_syahrilmaimubdy` (
  `id_admin_syahrilmaimubdy` int NOT NULL,
  `username_syahrilmaimubdy` varchar(50) NOT NULL,
  `password_syahrilmaimubdy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_syahrilmaimubdy`
--

INSERT INTO `admin_syahrilmaimubdy` (`id_admin_syahrilmaimubdy`, `username_syahrilmaimubdy`, `password_syahrilmaimubdy`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500'),
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `aspirasi_syahrilmaimubdy`
--

CREATE TABLE `aspirasi_syahrilmaimubdy` (
  `id_aspirasi_syahrilmaimubdy` int NOT NULL,
  `nis_syahrilmaimubdy` int DEFAULT NULL,
  `id_kategori_syahrilmaimubdy` int DEFAULT NULL,
  `lokasi_syahrilmaimubdy` varchar(100) DEFAULT NULL,
  `keterangan_syahrilmaimubdy` text,
  `gambar_syahrilmaimubdy` varchar(255) DEFAULT NULL,
  `tanggal_syahrilmaimubdy` datetime DEFAULT CURRENT_TIMESTAMP,
  `status_syahrilmaimubdy` enum('Menunggu','Proses','Selesai') DEFAULT 'Menunggu',
  `feedback_syahrilmaimubdy` text,
  `feedback_gambar_syahrilmaimubdy` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aspirasi_syahrilmaimubdy`
--

INSERT INTO `aspirasi_syahrilmaimubdy` (`id_aspirasi_syahrilmaimubdy`, `nis_syahrilmaimubdy`, `id_kategori_syahrilmaimubdy`, `lokasi_syahrilmaimubdy`, `keterangan_syahrilmaimubdy`, `gambar_syahrilmaimubdy`, `tanggal_syahrilmaimubdy`, `status_syahrilmaimubdy`, `feedback_syahrilmaimubdy`, `feedback_gambar_syahrilmaimubdy`) VALUES
(1, 1234567890, 13, 'Kelas XII-RPL-1 Lantai 2', 'Kursi di baris belakang patah kakinya, siswa hampir jatuh.', '1cf47e793a17b3e931fb65a0833f2943.jpg', '2026-03-03 10:56:36', 'Selesai', ' Kursi sudah diganti yang baru oleh petugas.', '8b4e0bf619a4b5e8da4fbe79e66c2cf3.jpg'),
(2, 1234567890, 19, 'Lab Jaringan TKJ Lantai 3', 'Kabel LAN putus di switch nomor 2, koneksi hilang.', 'b8b0dcb4cd2bc2fa36ff9c33f6b5d922.jpg', '2026-03-03 11:00:13', 'Proses', 'Kabel sedang diganti, sementara pakai wireless.', 'eaaa00468f8ff9e76e8f58116f32935d.jpg'),
(3, 1234567890, 22, 'Rak Buku Sejarah', 'Buku sejarah banyak yang hilang halamannya, susah dibaca.', '25b91af883d751ec33a89c01597f63c5.jpg', '2026-03-03 11:03:19', 'Menunggu', NULL, NULL),
(4, 1234567891, 20, 'Lapangan Sepak Bola', 'Gawang sepak bola jaringnya robek parah, bola sering lolos.', 'e10b90fc126cc6b20b9e2835339aa7b6.jpg', '2026-03-03 11:04:01', 'Selesai', 'Jaring sudah diganti, siap dipakai latihan.', '9c076c6317ddf6fcc0b55d0c34bbcf43.jpg'),
(5, 1234567890, 16, 'Kantin Depan', 'Air minum dispenser bocor, lantai basah dan licin.', 'cac7cec85ae17211223e26b61f42fd11.jpg', '2026-03-03 11:06:18', 'Menunggu', 'Dispenser sedang diperbaiki, gunakan yang lain dulu.', '1946067ce7102cc1b50ded61485adf80.jpg'),
(6, 1234567891, 14, 'Seluruh Lantai 3 ', 'Sinyal WiFi hilang total di lantai 3, tidak bisa akses online.', '43f503db77ffd29fbf0602c507d75974.jpg', '2026-03-03 11:07:49', 'Menunggu', NULL, NULL),
(7, 1234567890, 23, 'Kamar Mandi Lantai 2', 'Kran airnya lepas pak, kerannya tidak bisa digunakan.', '05fc5d5d787a6a4f79d73ac6309e49d8.png', '2026-03-03 11:10:11', 'Selesai', 'Kran sudah diperbaiki, air mengalir normal. ', 'cc0ca4895a23796897b1b49782fefeec.jpg'),
(8, 1234567890, 12, 'Ruang Musik', 'Gitar sekolah senarnya putus semua, tidak bisa latihan band.', 'bb6bab38e7d25b1d5880eccd7695455b.jpg', '2026-03-03 11:11:55', 'Menunggu', 'Silahkan bawa ke ruangan teknisi untuk segera diperbaiki', 'ee43f8ffd53b0d3e4ea0277fa1d57fe5.jpeg'),
(9, 1234567891, 11, 'Kantor TU', 'Printer administrasi macet terus, surat izin lambat dicetak.', '3a88b507abe4ace511420822d2acde27.jpg', '2026-03-03 11:14:09', 'Proses', 'Printer sedang diservis, segera berfungsi normal lagi.', 'e10ab979bbd4960590064c7890df6caa.jpg'),
(11, 1234567890, 13, 'Kelas XII-RPL-1 Lantai 2', 'Izin Pak, Ac Kami Bocor.', '5c74a78004c1f9f62c90a8e3573f3495.jpg', '2026-03-04 02:30:51', 'Proses', 'Baik, sednag diperbaiki, silahkan pindah kelas dahulu', 'c566f8cbb195379e936a88b7668ce3e8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_syahrilmaimubdy`
--

CREATE TABLE `kategori_syahrilmaimubdy` (
  `id_kategori_syahrilmaimubdy` int NOT NULL,
  `nama_kategori_syahrilmaimubdy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_syahrilmaimubdy`
--

INSERT INTO `kategori_syahrilmaimubdy` (`id_kategori_syahrilmaimubdy`, `nama_kategori_syahrilmaimubdy`) VALUES
(11, 'Administrasi'),
(12, 'Ekstrakurikuler'),
(13, 'Fasilitas Kelas'),
(14, 'Internet & Teknologi'),
(16, 'Kantin'),
(17, 'Keamanan'),
(19, 'Laboratorium'),
(20, 'Lapangan Olahraga'),
(22, 'Perpustakaan'),
(23, 'Kamar Mandi'),
(24, 'Kebersihan Parkiran');

-- --------------------------------------------------------

--
-- Table structure for table `siswa_syahrilmaimubdy`
--

CREATE TABLE `siswa_syahrilmaimubdy` (
  `nis_syahrilmaimubdy` int NOT NULL,
  `kelas_syahrilmaimubdy` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa_syahrilmaimubdy`
--

INSERT INTO `siswa_syahrilmaimubdy` (`nis_syahrilmaimubdy`, `kelas_syahrilmaimubdy`) VALUES
(1234567890, 'XII-RPL-1'),
(1234567891, 'XII-RPL-2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_syahrilmaimubdy`
--
ALTER TABLE `admin_syahrilmaimubdy`
  ADD PRIMARY KEY (`id_admin_syahrilmaimubdy`),
  ADD KEY `username` (`username_syahrilmaimubdy`);

--
-- Indexes for table `aspirasi_syahrilmaimubdy`
--
ALTER TABLE `aspirasi_syahrilmaimubdy`
  ADD PRIMARY KEY (`id_aspirasi_syahrilmaimubdy`),
  ADD KEY `nis` (`nis_syahrilmaimubdy`),
  ADD KEY `id_kategori` (`id_kategori_syahrilmaimubdy`);

--
-- Indexes for table `kategori_syahrilmaimubdy`
--
ALTER TABLE `kategori_syahrilmaimubdy`
  ADD PRIMARY KEY (`id_kategori_syahrilmaimubdy`);

--
-- Indexes for table `siswa_syahrilmaimubdy`
--
ALTER TABLE `siswa_syahrilmaimubdy`
  ADD PRIMARY KEY (`nis_syahrilmaimubdy`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_syahrilmaimubdy`
--
ALTER TABLE `admin_syahrilmaimubdy`
  MODIFY `id_admin_syahrilmaimubdy` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `aspirasi_syahrilmaimubdy`
--
ALTER TABLE `aspirasi_syahrilmaimubdy`
  MODIFY `id_aspirasi_syahrilmaimubdy` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kategori_syahrilmaimubdy`
--
ALTER TABLE `kategori_syahrilmaimubdy`
  MODIFY `id_kategori_syahrilmaimubdy` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `siswa_syahrilmaimubdy`
--
ALTER TABLE `siswa_syahrilmaimubdy`
  MODIFY `nis_syahrilmaimubdy` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1234567893;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
