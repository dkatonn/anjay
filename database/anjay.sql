-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jan 2025 pada 13.51
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anjay`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `item_id`) VALUES
(16, 1, 1),
(18, 1, 19),
(19, 1, 18);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`item_id`, `item_name`) VALUES
(1, 'Ayam'),
(2, 'Ikan'),
(3, 'Sop');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `item_id` int(11) NOT NULL,
  `item_brand` varchar(200) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_price` double(10,3) NOT NULL,
  `item_image` varchar(255) NOT NULL,
  `item_detail` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`item_id`, `item_brand`, `item_name`, `item_price`, `item_image`, `item_detail`) VALUES
(1, 'Ayam', 'Ayam Bakar', 18.000, './assets/Ayam bakar.jpg\r\n', ''),
(17, 'Ayam', 'Ayam Bakar Sambal Dabu Dabu + Nasi', 34.000, './assets/ayam bakar dabu.jpg', NULL),
(18, 'Ayam', 'Ayam Geprek Sambal Ijo Dower Tanpa Nasi', 27.000, './assets/ayam geprek.jpg', NULL),
(19, 'Ayam', 'Ayam Goreng Serundeng Tanpa Nasi', 27.000, './assets/ayam goreng serundeng.jpg', NULL),
(20, 'Ayam', 'Ayam Kriuk + Nasi', 34.000, './assets/Ayam kriuk nasi.jpg', NULL),
(21, 'Ikan', 'Ikan Nila Bakar Sambal Terasi', 29.000, './assets/ikan nila.jpg', NULL),
(22, 'Ikan', 'Lele Bakar + Nasi', 24.000, './assets/Lele bakar nasi.jpg', NULL),
(23, 'Ikan', 'Lele Kriuk + Nasi', 24.000, './assets/Lele kriuk nasi.jpg', NULL),
(24, 'Ayam', 'Ayam Bakar Satu Ekor', 70.000, './assets/satu ekor.jpg', NULL),
(25, 'Sop', 'Sop Ayam Tanpa Nasi', 27.000, './assets/Sop ayam.jpg', NULL),
(26, 'Sop', 'Sop Iga Tanpa Nasi', 35.000, './assets/sop iga.jpg', NULL),
(27, 'Tambahan', 'Udang Saos Tiram Tanpa Nasi', 36.000, './assets/udangg.jpg', NULL),
(28, 'Tambahan', 'Cah Kangkung Saos Tauco', 16.000, './assets/kangkungg.jpg', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `Id` int(10) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`Id`, `firstName`, `lastName`, `alamat`, `email`, `password`) VALUES
(1, 'muzi', 'ardi', '', 'muzi.ardiansah135@gmail.com', '202cb962ac59075b964b07152d234b70'),
(2, 'muzi', 'ardi', '', 'muji.ardiansah135@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(3, 'budi', 'budi', 'bekasi', 'budi@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(4, 'dimas', 'katon', 'mutiara gading timur blok n26', 'dimasberightback@gmail.com', '338d811d532553557ca33be45b6bde55'),
(5, 'kaon', 'dddim', 'mutiara gading timur blok n26', 'katonberightback@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(6, 'Dimas', 'Katon', 'bekasi', 'dimas@gmail.com', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Struktur dari tabel `usersadmin`
--

CREATE TABLE `usersadmin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `usersadmin`
--

INSERT INTO `usersadmin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$2IbFVUZ9WxeVOPsHBtb0ueZvKZxsqBZHRoTdI3DhEWEyAxz4/Oc8G');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wishlist`
--

CREATE TABLE `wishlist` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`item_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- Indeks untuk tabel `usersadmin`
--
ALTER TABLE `usersadmin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `usersadmin`
--
ALTER TABLE `usersadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
