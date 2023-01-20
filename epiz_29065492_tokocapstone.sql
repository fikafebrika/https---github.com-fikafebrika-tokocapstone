-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql306.epizy.com
-- Generation Time: Apr 13, 2022 at 09:52 PM
-- Server version: 10.3.27-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_29065492_tokocapstone`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'admintoko', 'fika123', 'Fika Febrika');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `nama_kota` varchar(30) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'Palembang', 1000),
(3, 'Indralaya', 5000),
(4, 'Prabumulih', 7500),
(5, 'Muara Enim', 8500),
(6, 'Lampung', 9000),
(7, 'Lubuk Linggau', 8500),
(8, 'Banyuasin', 2500);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(30) NOT NULL,
  `password_pelanggan` varchar(255) NOT NULL,
  `nama_pelanggan` varchar(30) NOT NULL,
  `telepon_pelanggan` varchar(30) NOT NULL,
  `alamat_pelanggan` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `telepon_pelanggan`, `alamat_pelanggan`) VALUES
(23, 'wawan@gmail.com', '$2y$10$ji4ACUrhuXWhLCQWZxmcfuReHmmWYrR6WWB9JL.s3pfS3owc6brvW', 'Wawan Setiawan', '089876543218', 'Jl. Way Kambas No.08, RT 01 RW 23, Sukabumi'),
(24, 'abd@gmail.com', '$2y$10$m1sqpDf0/zkB0//yzd0RDuf1xRI/AMZ3wqpGGk0MUJpRJnJOXBwGG', 'abc', '098', 'Abc'),
(25, 'aaa@gmailm.com', '$2y$10$PFrAV/1kWIhPklmibOLf7OAKIdxPKV/KzgF/RnN52N6OTxySZrkA2', 'aaa', '098', 'Aaa'),
(26, 'fikafebrika@gmail.com', '$2y$10$kOqJo64ZY58v1ycg7PMQ8u9CuDFskQCCEQuJgGX.8EcR3FnkDd1cW', 'Fika Febrika', '087794054245', 'Jl. PHDM 1 Blok B No.96A, RT 42 RW 01'),
(27, 'andinilayanah@gmail.com', '$2y$10$KjXzmo2x9rKZUMz.T2lHNe6X8scAHrsyHDvb0517reelcS8tHVY8C', 'Andini Layanah', '0895621850359', 'Jl.sukatani');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `bank` varchar(30) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(31, 74, 'Wawan', 'BNI Syariah', 11500, '2020-04-19', '20200419102633img002.jpg'),
(34, 77, 'Wawan', 'BNI', 48500, '2021-06-30', '20210630130500Kuning Hijau Biru Futuristis Proses Organisasi Linimasa Infografik.png'),
(35, 82, 'Bambang', 'BCA', 29000, '2021-07-05', '20210705061826Screenshot (48).png');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `nama_kota` varchar(30) NOT NULL,
  `tarif` int(11) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `status_pembelian` varchar(50) NOT NULL DEFAULT 'Pending',
  `resi_pengiriman` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `id_ongkir`, `tanggal_pembelian`, `total_pembelian`, `nama_kota`, `tarif`, `alamat_pengiriman`, `status_pembelian`, `resi_pengiriman`) VALUES
(74, 23, 8, '2020-04-19', 11500, 'Banyuasin', 2500, 'Jl. Way Kambas No.08', 'Selesai', ''),
(77, 23, 5, '2020-04-20', 48500, 'Muara Enim', 8500, 'Jl. Way Kambas No.08 Kel.Kalidoni,  Kec.Kalidoni', 'Dalam Pengiriman', 'QM1234'),
(79, 26, 8, '2020-04-22', 6500, 'Banyuasin', 2500, 'Jl. PHDM 1 No.96A Blok B', 'Pending', ''),
(80, 27, 1, '2020-04-22', 36000, 'Palembang', 1000, 'Sukatani', 'Pending', ''),
(82, 23, 6, '2020-09-01', 29000, 'Lampung', 9000, 'Jl. Way Kambas No.08', 'Sudah Konfirmasi', ''),
(83, 23, 1, '2021-06-30', 14000, 'Palembang', 1000, 'Jl. Way Kambas No.08', 'Pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `subberat` int(11) NOT NULL,
  `subharga` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`, `nama`, `harga`, `berat`, `subberat`, `subharga`) VALUES
(62, 74, 9, 1, 'Penghapus Faber Castell', 4000, 5, 5, 4000),
(63, 74, 11, 1, 'Peruncing Faber Castell', 5000, 3, 3, 5000),
(66, 77, 16, 10, 'Isi Pena Tinta 1 Set', 4000, 3, 30, 40000),
(68, 79, 9, 1, 'Penghapus Faber Castell', 4000, 10, 10, 4000),
(69, 80, 15, 10, 'Pena Tinta Joyko', 3500, 5, 50, 35000),
(71, 82, 20, 10, 'Map Plastik', 2000, 5, 50, 20000),
(72, 83, 7, 1, 'Pena EXO', 13000, 5, 5, 13000);

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `berat_produk`, `foto_produk`, `deskripsi_produk`, `stok_produk`) VALUES
(7, 'Pena EXO', 13000, 5, 'pena.jpg', 'Pena custom boygrup kpop EXO, lancar jaya digunakan, tidak macet, dan yang paling penting tak cepat habis. Buruan dibeli..... stok terbatassss&#9;&#9;&#9;&#9;', 19),
(8, 'Pensil Faber Castell All Set', 48000, 20, 'pensil.jpg', 'Pensil All Set, semua jenis pensil Faber Castell (baik dari hasil goresan tipis di kertas hingga goresan tebal) dalam satu kotak. Kalian yang suka gambar, membuat sketsa, perlu semua jenis pensil ini.\r\n', 20),
(9, 'Penghapus Faber Castell', 4000, 10, 'penghapus.jpg', 'Penghapus dengan kualitas terbaik, tidak memberikan bekas di kertas ketika selesai menghapus dan tidak merusak kertas.', 39),
(10, 'Pena Lilin', 10000, 25, 'penalilin.jpg', 'Pena dengan kualitas baik dan harga terjangkau. 1 kotak isi 12 pena. Tidak menerima pembelian 1 buah pena, hanya menerima pembelian perkotak seharga Rp 10.000,-', 14),
(11, 'Peruncing Faber Castell', 5000, 5, 'peruncing.jpg', 'Peruncing kualitas terbaik, tidak mudah pecah, tidak mudah karatan, dan tahan lama', 39),
(12, 'Pena Standar', 18000, 30, 'penastandar.jpg', 'Pena standar, semua kalangan dapat memakai pena ini, tidak membuat kotor kertas dan tangan saat digunakan. Satu kotak isi 12 pena', 15),
(13, 'Crayon Titi 48', 54000, 250, 'crayon.jpg', 'Crayon kualitas terbaik dengan berbagai macam warna alami yang akan membuat indah pewarnaan pada gambar Anda', 4),
(14, 'Penggaris Pikachu', 3500, 5, 'HTB1KBDNXx2rK1RkSnhJq6ykdpXaC.jpg', 'Penggaris lucu dari Anime Pikachu yang akan mewarnai hari-hari Anda.', 10),
(15, 'Pena Tinta Joyko', 3500, 5, 'penatinta.jpg', 'Pena tinta kualitas terbaik, nyaman digunakan, membuat indah dan rapi tulisan', 60),
(16, 'Isi Pena Tinta 1 Set', 4000, 3, 'isipena.jpg', 'Isi pena tinta Joyko 0.5mm. 1 set isi 3 pcs. Bisa digunakan di semua pena tinta jenis dan merek apapun', 60),
(17, 'Kertas A4', 33000, 1000, 'kertasa4.jpg', 'Kertas A4 1 rim merek SIDU 70 gsm. Kertas tidak mudah rusak dan mempercepat melakukan percetakan', 10),
(18, 'Kertas F4', 35000, 1050, 'kertasf4.jpg', 'Kertas F4 satu rim merek SIDU 70 gsm. Kertas tidak mudah rusak dan membantu mempercepat proses percetakan', 10),
(19, 'Kotak Pensil', 10000, 5, 'kotakpensil.jpg', 'Kotak pensil cantik, lucu, dan indah. Dapat diisi dengan berbagai macam alat tulis pada umumnya', 20),
(20, 'Map Plastik', 2000, 5, 'map.jpg', 'Map plastik bentuk L ukuran folio. Dapat menyimpan berbagai lembaran kertas dengan aman. Cocok untuk Anda yang ingin rapi namun tidak inget ribet', 40),
(21, 'Pensil Warna Joyko', 20000, 50, 'pensilwarna.jpg', 'Pensil warna Joyko isi 12 pensil warna. Cocok untuk Anda yang suka buat sketsa berwarna atau suka pewarnaan sederhana', 10),
(22, 'Spidol Papan Tulis', 12000, 20, 'spidol.jpg', 'Spidol untuk menulis di papan tulis, tidak permanen, dan ada berbagai macam variasi warna, tidak mudah kering, dan tahan lama', 28),
(23, 'Label Uk.Kecil', 3000, 3, 'stempel.jpg', 'Label dapat dipakai di semua jenis kertas. Dapat digunakan untuk melabeli tulisan pena yang salah dan lain-lain', 28),
(26, 'Tipe-X', 3000, 50, 'tipx.jpg', 'Tipe-X Kenko tidak mudah kering dan mudah digunakan. Dapat digunakan di semua jenis kertas dan dapat membenarkan tulisan Anda yang salah di kertas.', 30);

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
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
