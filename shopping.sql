-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Agu 2024 pada 05.47
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` varchar(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) NOT NULL,
  `role` int(14) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `creationDate`, `updationDate`, `role`, `status`) VALUES
('0', 'admin22', '21232f297a57a5a743894a0e4a801fc3', '2024-08-05 13:58:15', '2024-08-05 20:58:15', 1, 0),
('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2017-01-24 16:21:18', '11-11-2023 09:53:48 AM', 1, 1),
('12', 'owner', '72122ce96bfec66e2396d2e25225d70a', '2024-07-24 20:08:37', '2024-07-25 03:08:37', 4, 1),
('13', 'admin22', '21232f297a57a5a743894a0e4a801fc3', '2024-08-05 13:57:16', '2024-08-05 20:57:16', 1, 0),
('2', 'kasir', '72122ce96bfec66e2396d2e25225d70a', '2023-11-17 08:37:02', '', 2, 1),
('3', 'Pegawai', '72122ce96bfec66e2396d2e25225d70a', '2024-01-17 07:27:08', '', 3, 1),
('kas20240805', 'eee', 'f3f1ddc84e7df3ad94b465d2eab5f703', '2024-08-05 14:06:45', '2024-08-05 21:06:45', 2, 0),
('owner202408', 'helmi', '115f89503138416a242f40fb7d7f338e', '2024-08-05 14:10:50', '2024-08-05 21:10:50', 4, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `biaya`
--

CREATE TABLE `biaya` (
  `id_biaya` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(255) DEFAULT NULL,
  `categoryDescription` longtext DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id`, `categoryName`, `categoryDescription`, `creationDate`, `updationDate`) VALUES
(1, 'Buku', 'Cetak berbagai jenis buku dengan harga terbaik', '2022-05-05 12:44:40', NULL),
(2, 'Kemasan', 'Cetak kemasan untuk kebutuhan usaha anda', '2022-05-05 12:46:04', NULL),
(3, 'Stationary', 'Perlengkapan kantor anda', '2022-05-05 12:53:29', NULL),
(4, 'Promosi', 'Keperluan untuk promosi usaha anda', '2022-05-05 12:54:05', NULL),
(5, 'Undangan', 'Cetak undangan untuk moment berharga anda', '2022-05-05 12:57:56', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` varchar(20) NOT NULL,
  `userId` varchar(20) DEFAULT NULL,
  `productId` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `orderDate` date NOT NULL,
  `paymentMethod` varchar(50) DEFAULT NULL,
  `orderStatus` varchar(55) DEFAULT NULL,
  `buktipayment` varchar(225) NOT NULL,
  `design` varchar(225) NOT NULL,
  `total_harga` int(225) NOT NULL,
  `ongkir` int(14) NOT NULL,
  `order_number` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `userId`, `productId`, `quantity`, `orderDate`, `paymentMethod`, `orderStatus`, `buktipayment`, `design`, `total_harga`, `ongkir`, `order_number`) VALUES
('1', 'ID00001', '33', 2, '2024-08-07', 'Internet Banking', NULL, 'uploads/WhatsApp Image 2024-08-06 at 07.09.52.jpeg', '', 0, 0, NULL),
('100', '11', '3', 1, '2024-07-25', 'Internet Banking', NULL, 'uploads/ctivitymengelolaproduk.drawio (1).png', '', 0, 0, NULL),
('101', '11', '3', 1, '2024-07-29', 'Internet Banking', NULL, 'uploads/WhatsApp Image 2024-07-19 at 10.34.32.jpeg', '', 0, 0, NULL),
('102', '11', '3', 1, '2024-07-29', 'Internet Banking', NULL, 'uploads/WhatsApp Image 2024-07-19 at 10.34.32.jpeg', '', 0, 0, NULL),
('103', '11', '3', 1, '2024-08-01', 'Internet Banking', NULL, 'uploads/hipo_diagram_high_res.png', '', 0, 0, NULL),
('104', '11', '8', 1, '2024-08-01', 'Internet Banking', NULL, 'uploads/hipo_diagram_high_res.png', '', 0, 0, NULL),
('105', '11', '3', 9, '2024-08-05', 'Internet Banking', 'in Process', 'uploads/11.drawio.png', '', 0, 0, NULL),
('106', '0', '32', 1, '2024-08-07', 'Internet Banking', NULL, 'uploads/WhatsApp Image 2024-08-06 at 07.09.52.jpeg', '', 0, 0, NULL),
('107', '11', '44', 1, '2024-08-07', 'Internet Banking', NULL, 'uploads/OIP (1).jpg', '', 0, 0, NULL),
('69', '1', '8', 1, '2024-07-22', 'Internet Banking', 'Delivered', 'Internet Banking', '', 0, 0, NULL),
('71', '1', '3', 1, '2024-07-22', 'Internet Banking', NULL, 'Internet Banking', '', 0, 0, NULL),
('72', '1', '3', 1, '2024-07-22', 'Internet Banking', 'in Process', '20240721200134.jpeg', '', 0, 0, NULL),
('82', '11', '3', 1, '2024-07-24', 'COD', NULL, '', '', 0, 0, NULL),
('91', '11', '33', 1, '2024-07-24', 'Internet Banking', NULL, 'uploads/WhatsApp Image 2024-07-19 at 10.34.32.jpeg', '', 0, 0, NULL),
('92', '11', '3', 1, '2024-07-24', 'Internet Banking', NULL, 'uploads/Lembar Persyaratan.jpeg', '', 0, 0, NULL),
('93', '11', '32', 1, '2024-07-24', 'Internet Banking', NULL, 'uploads/WhatsApp Image 2024-07-17 at 10.57.43.jpeg', '', 0, 0, NULL),
('94', '11', '32', 200, '2024-07-24', 'Internet Banking', NULL, 'uploads/WhatsApp Image 2024-07-18 at 10.40.56.jpeg', '', 0, 0, NULL),
('95', '11', '3', 1, '2024-07-24', 'Internet Banking', NULL, 'uploads/WhatsApp Image 2024-07-17 at 11.52.21.jpeg', '', 0, 0, NULL),
('96', '11', '6', 1, '2024-07-24', 'Internet Banking', NULL, 'uploads/WhatsApp Image 2024-07-17 at 10.57.41 (2).jpeg', '', 0, 0, NULL),
('97', '11', '47', 1, '2024-07-24', 'Internet Banking', NULL, 'uploads/WhatsApp Image 2024-07-17 at 10.57.41 (2).jpeg', '', 0, 0, NULL),
('98', '11', '33', 1, '2024-07-24', 'Internet Banking', NULL, 'uploads/WhatsApp Image 2024-07-17 at 10.57.41 (2).jpeg', '', 0, 0, NULL),
('99', '11', '3', 1, '2024-07-25', 'Internet Banking', NULL, 'uploads/Flowmap.drawio.png', '', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ordertrackhistory`
--

CREATE TABLE `ordertrackhistory` (
  `id` int(11) NOT NULL,
  `orderId` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remark` mediumtext DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `ordertrackhistory`
--

INSERT INTO `ordertrackhistory` (`id`, `orderId`, `status`, `remark`, `postingDate`) VALUES
(7, 7, 'in Process', 'oke', '2022-05-14 09:08:25'),
(8, 8, 'in Process', 'oke', '2022-05-14 09:09:08'),
(9, 9, 'Delivered', 'ok', '2022-06-11 06:15:37'),
(10, 19, 'in Process', 'diikirim hari ini', '2022-06-19 10:47:10'),
(11, 20, 'in Process', 'dikirim hari ini', '2022-06-19 10:47:30'),
(12, 21, 'in Process', 'Silahkan siapkan untuk ongkos kirim 15rb', '2023-11-12 08:49:43'),
(13, 39, 'Delivered', 'Pesanan Terkirim', '2024-01-26 10:48:37'),
(14, 47, 'Delivered', 'Barang sudah terkirim', '2024-01-31 02:34:36'),
(15, 40, 'in Process', 'Pesanan Sedang di proses\r\n', '2024-07-21 07:39:53'),
(16, 40, 'Delivered', 'Pesabab dikirim', '2024-07-21 07:40:04'),
(17, 41, 'in Process', 'Sedang di proses\r\n', '2024-07-21 17:11:11'),
(18, 41, 'Delivered', 'Terkirim', '2024-07-21 17:11:20'),
(19, 77, 'in Process', 'Di proses', '2024-07-22 07:18:30'),
(20, 73, 'in Process', 'Tidak di proses karena pembayaran tidak valid', '2024-07-22 12:04:21'),
(21, 72, 'in Process', 'tidak', '2024-07-22 12:04:49'),
(22, 72, 'in Process', 'tidak', '2024-07-22 12:05:38'),
(23, 72, 'Reject', 'tidak', '2024-07-22 12:05:46'),
(24, 72, 'in Process', 'di proses\r\n', '2024-07-22 12:17:45'),
(25, 69, 'in Process', 'Sedang di proses', '2024-07-30 21:59:28'),
(26, 69, 'Delivered', 'terkirim', '2024-07-30 22:21:21'),
(27, 105, 'in Process', 'Pesanan di proses', '2024-08-04 23:43:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_sequence`
--

CREATE TABLE `order_sequence` (
  `sequence_date` date NOT NULL,
  `sequence_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `productreviews`
--

CREATE TABLE `productreviews` (
  `id` int(11) NOT NULL,
  `productId` int(11) DEFAULT NULL,
  `quality` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `review` longtext DEFAULT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` varchar(11) NOT NULL,
  `category` int(11) NOT NULL,
  `subCategory` int(11) DEFAULT NULL,
  `productName` varchar(255) DEFAULT NULL,
  `productCompany` varchar(255) DEFAULT NULL,
  `productPrice` int(11) DEFAULT NULL,
  `productPriceBeforeDiscount` int(11) DEFAULT NULL,
  `productDescription` longtext DEFAULT NULL,
  `productImage1` varchar(255) DEFAULT NULL,
  `productImage2` varchar(255) DEFAULT NULL,
  `productImage3` varchar(255) DEFAULT NULL,
  `shippingCharge` int(11) DEFAULT NULL,
  `productAvailability` varchar(255) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL,
  `berat_product` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `category`, `subCategory`, `productName`, `productCompany`, `productPrice`, `productPriceBeforeDiscount`, `productDescription`, `productImage1`, `productImage2`, `productImage3`, `shippingCharge`, `productAvailability`, `postingDate`, `updationDate`, `berat_product`) VALUES
('2', 5, 35, 'Undangan Pernikahan Klasik', 'Kertas Hammer', 3000, 5000, 'Cetak undangan pernikahan dengan bahan berkualitas, desain klasik, dan harga terjangkau untuk melengkapi keperluan acara pernikahan anda. Undangan pernikahan bertema klasik bisa disesuaikan dengan tema adat/suku anda<br>', 'undangan1.2.jpg', 'undangan1.3.jpg', 'undangan1.5.jpg', 0, 'Tersedia', '2022-05-07 12:45:51', NULL, 100),
('3', 1, 2, 'Annual Report', 'Kertas ', 5000, 7000, '<div style=\"text-align: left;\">Cetak Annual Report untuk keperuan kantor anda dengan kualitas dan harga terbaik.</div>', 'anR1.jpg', 'anR.jpg', 'anR2.webp', 0, 'Tersedia', '2022-05-07 12:56:24', NULL, 200),
('32', 2, 9, 'Soft Box', 'Kertas', 1200, 3000, 'Mencetak Soft Box untuk kemasan produk usaha anda dengan kualitas terbaik serta harga terbaik', 'softbox.jpg', 'softbox1.jpg', 'softbox2.jpg', 0, 'Tersedia', '2022-06-10 11:44:38', NULL, 100),
('33', 2, 10, 'Corrugated Box ', 'kertas', 2000, 3500, 'Mencetak Corrugated Box untuk kemasan produk usaha anda agar lebih menarik konsumen, dicetak dengan kualitas terbaik dan harga terbaik', 'corru.jpg', 'corru1.jpg', 'corru2.jpg', 0, 'Tersedia', '2022-06-10 11:46:50', NULL, 200),
('34', 2, 11, 'Kertas Label', 'kertas', 500, 1500, 'Mencetak Kertas Label unutk kerperluan produk usaha anda dengan kualitas terbaik dan harga terbaik juga, dicetak dengan design kustom yang akan menarik konsumen', 'label.png', 'label1.jpg', 'label2.png', 0, 'Tersedia', '2022-06-10 11:49:23', NULL, 100),
('36', 2, 13, 'Paper Bag', 'Kertas ', 4000, 5000, 'Mencetak Paper Bag untuk keperluan produk usaha anda dengan kualitas dan harga terbaik sebagai daya tarik konsumen', 'pbag.jpg', 'pbag1.jpg', 'pbag2.jpg', 0, 'Tersedia', '2022-06-10 11:53:52', NULL, 300),
('38', 2, 15, 'Food Tray', 'Kertas', 2500, 5000, 'Mencetak Food Tray untuk kemasan produk makanan anda dengan kualitas dan harga terbaik sebagai daya tarik konsumen', 'tray.jpg', 'tray1.jpg', 'tray2.jpg', 0, 'Tersedia', '2022-06-10 12:04:40', NULL, 200),
('4', 1, 3, 'Company Profile', 'Kertas ', 3000, 5000, 'Cetak Company Profile untuk keperluaan perusahaan anda dengan kualitas dan harga terbaik.', 'comPRO1.jpg', 'comPRO3.jpg', 'comPRO2.jpg', 0, 'Tersedia', '2022-05-07 13:02:01', NULL, 150),
('41', 2, 18, 'Sticker ', 'Kertas', 300, 1000, 'Mencetak Sticker untuk kerperluan produk usaha anda dengan kualitas dan harga terbaik, dicetak dengan design yang bisa anda kustom untuk menarik konsumen<br>', 'sticker1.jpg', 'sticker2.jpg', 'sticker3.jpg', 0, 'Tersedia', '2022-06-10 12:11:05', NULL, 30),
('42', 2, 19, 'Sticker Kemasan ', 'Kertas', 300, 1000, 'Mencetak Sticker Kemasan untuk kerperluan produk usaha anda dengan kualitas dan harga terbaik, dicetak dengan design yang bisa anda kustom untuk menarik konsumen<br>', 'Skemasan.jpg', 'Skemasan1.jpg', 'Skemasan2.jpg', 0, 'Tersedia', '2022-06-10 12:12:29', NULL, 30),
('44', 3, 21, 'Map Folder', 'Kertas ', 2000, 3000, 'Mencetak Map Folder untuk kerperluan kantor ataupun akademisi pendidikan&nbsp;', 'map.jpg', 'map1.jpg', 'map2.jpg', 0, 'Tersedia', '2022-06-10 12:28:44', NULL, 100),
('46', 3, 23, 'Agenda', 'Kertas', 7000, 10000, 'Menyediakan cetak agenda untuk keperluan pribadi, kantor, ataupun usaha anda', 'agenda.jpeg', 'agenda1.jpg', 'agenda2.jpg', 0, 'Tersedia', '2022-06-10 12:33:23', NULL, 200),
('47', 3, 24, 'Amplop', 'Kertas', 1000, 2000, 'Mencetak Amplop untuk keperluan kantor, akademisi pendidikan, pribadi, ataupun usaha anda.', 'amplop.jpg', 'amplop1.jpg', 'amplop2.jpg', 0, 'Tersedia', '2022-06-10 12:34:55', NULL, 100),
('50', 3, 27, 'Nota NCR', 'Kertas', 3000, 5000, 'Mencetak Nota NCR untuk keperluan kantor, akademisi pendidikan, pribadi, ataupun usaha anda.<br>', 'nota.jpg', 'nota1.jpg', 'nota2.jpg', 0, 'Tersedia', '2022-06-10 12:43:55', NULL, 100),
('51', 3, 28, 'Formulir', 'Kertas', 2000, 3000, 'Mencetak Formulir untuk keperluan kantor, akademisi pendidikan, pribadi, ataupun usaha anda.<br>', 'form.jpg', 'form1.jpg', 'form2.jpg', 0, 'Tersedia', '2022-06-10 12:45:09', NULL, 100),
('52', 3, 29, 'Kop Surat', 'Kertas', 500, 1500, 'Mencetak Kop Surat untuk keperluan kantor, akademisi pendidikan, pribadi, ataupun usaha anda.<br>', 'kop2.jpg', 'kop1.jpg', 'kop.jpg', 0, 'Tersedia', '2022-06-10 12:46:28', NULL, 300),
('53', 4, 30, 'Brosur', 'Kertas', 1500, 3000, 'Mencetak Brosur untuk segala keperluan informasi kantor, akademisi pendidikan, pribadi, ataupun usaha anda.<br>', 'brosur.jpg', 'brosur1.jpg', 'brosur2.jpg', 0, 'Tersedia', '2022-06-10 12:58:38', NULL, 100),
('54', 4, 31, 'Kalender', 'Kertas', 7000, 10000, 'Mencetak Kalender untuk segala keperluan informasi kantor, akademisi pendidikan, pribadi, ataupun usaha anda.<br>', 'kalender.jpg', 'kalender1.jpg', 'kalender2.jpg', 0, 'Tersedia', '2022-06-10 13:01:49', NULL, 700),
('55', 4, 32, 'Thankyou Card', 'Kertas', 1200, 2000, 'Mencetak Thankyou Card untuk segala keperluan informasi kantor, akademisi pendidikan, pribadi, ataupun usaha anda.<br>', 'tcard.jpg', 'tcard1.jpg', 'tcard2.jpg', 0, 'Tersedia', '2022-06-10 13:06:21', NULL, 200),
('56', 4, 33, 'Member Card', 'kertas', 1000, 3000, 'Mencetak Member Card untuk segala keperluan informasi kantor, akademisi pendidikan, pribadi, ataupun usaha anda.<br>', 'member2.jpg', 'member.jpg', 'member1.jpg', 0, 'Tersedia', '2022-06-10 13:08:33', NULL, 0),
('57', 4, 34, 'Katalog', 'Kertas', 5000, 7000, 'Mencetak Katalog untuk segala keperluan informasi kantor, akademisi pendidikan, pribadi, ataupun usaha anda.<br>', 'katalog.jpg', 'katalog1.jpg', 'katalog2.jpg', 0, 'Tersedia', '2022-06-10 13:10:45', NULL, 0),
('58', 4, 55, 'Menu', 'Kertas ', 2000, 4000, 'Mencetak Menu untuk segala keperluan usaha anda dengan design yang menarik sebagai daya tarik konsumen<br>', 'menu.jpg', 'menu1.jpg', 'menu2.jpg', 0, 'Tersedia', '2022-06-10 13:14:52', NULL, 0),
('6', 1, 5, 'Majalah ', 'Art paper', 7000, 12000, 'Mencetak majalah fashion, produk kosmetik, majalah anak, majalah kantor, pendidikan, dan sebagainya', 'majalah.JPG', 'majalah1.jpg', 'majalah2.jpg', 0, 'Tersedia', '2022-06-10 11:00:08', NULL, 300),
('61', 4, 58, 'Hanging mobile', 'Kertas', 600, 1500, 'Memcetak Hanging mobile untuk keperluan kantor, keperluan pribadi, dan usaha anda', 'hm1.jpg', 'hm.jpg', 'hm2.jpg', 0, 'Tersedia', '2022-06-10 15:09:08', NULL, 0),
('62', 4, 71, 'Booklet', 'Kertas', 5000, 7000, 'Mencetak Booklet untuk keperluan kantor, usaha, dan keperluan pribadi anda dengan kualitas dan harga terbaik', 'booklet.jpg', 'booklet1.jpg', 'booklet2.jpg', 0, 'Tersedia', '2022-06-10 15:11:58', NULL, 0),
('63', 5, 36, 'Undangan Anniversary Kantor', 'Kertas Hammer', 2000, 3000, 'Mencetak Undangan untuk Anniversary kantor anda', 'anniv1.jpg', 'anniv2.jpeg', 'anniv3.jpg', 0, 'Tersedia', '2022-06-10 15:14:01', NULL, 0),
('64', 5, 37, 'Undangan Ulangtahun', 'Kertas Hammer', 1500, 2500, 'Mencetak undangan untuk memperingati acara ulangtahun spesial anda', 'hbd1.jpg', 'hbd2.jpg', 'hbd3.webp', 0, 'Tersedia', '2022-06-10 15:15:42', NULL, 0),
('65', 5, 38, 'Undangan Natal dan Tahun Baru', 'Kertas ', 1500, 3000, 'Mencetak Undangan untuk acara Natal dan Tahun Baru yang sangat spesial', 'natal2.jpg', 'natal1.jpg', 'natal.jpg', 0, 'Tersedia', '2022-06-10 15:19:57', NULL, 0),
('66', 5, 39, 'Undangan Peresmian Perusahaan atau Kantor', 'Kertas', 1000, 2000, 'Mencetak Undangan untuk acara peresmian perusahaan, kantor, dan usaha anda', 'Uperusahaan1.jpg', 'Uperusahaan2.jpg', 'Uperusahaan3.jpg', 0, 'Tersedia', '2022-06-10 15:22:01', NULL, 0),
('8', 2, 7, 'Kemasan Makanan', 'Paper', 700, 2000, 'Cetak kemasan untuk usaha produk makanan anda dengan kualitas terbaik dan harga terbaik.', 'makanan1.jpg', 'makanan2.jpg', 'makanan3.jpg', 0, 'Tersedia', '2022-06-10 11:40:02', NULL, 200),
('B2024080600', 1, 1, 'MAJALAH', 'Universitas Muhammadiyah Jakarta', 20000, 42000, 'wewqe', 'erd2.drawio.png', 'ERD.drawio (6).png', 'Diagram Tanpa Judul.drawio (11).png', 0, 'Tersedia', '2024-08-05 23:18:10', NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening`
--

CREATE TABLE `rekening` (
  `ATM` bigint(20) NOT NULL,
  `norek` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rekening`
--

INSERT INTO `rekening` (`ATM`, `norek`) VALUES
(8770, 0),
(8770745196, 0),
(8770745196, 8770745196);

-- --------------------------------------------------------

--
-- Struktur dari tabel `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `categoryid` int(11) DEFAULT NULL,
  `subcategory` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `subcategory`
--

INSERT INTO `subcategory` (`id`, `categoryid`, `subcategory`, `creationDate`, `updationDate`) VALUES
(1, 1, 'Biografi', '2022-05-05 13:05:18', '27-01-2024 11:29:11 AM'),
(2, 1, 'Annual Report', '2022-05-05 13:05:24', NULL),
(3, 1, 'Company Profile', '2022-05-05 13:05:30', NULL),
(4, 1, 'E-Book', '2022-05-05 13:05:49', NULL),
(5, 1, 'Majalah', '2022-05-05 13:06:07', NULL),
(6, 1, 'Materi Presentasi', '2022-05-05 13:06:15', NULL),
(7, 2, 'Kemasan Makanan', '2022-05-05 13:08:03', NULL),
(8, 2, 'Hard Box', '2022-05-05 13:08:17', NULL),
(9, 2, 'Soft Box', '2022-05-05 13:08:27', NULL),
(11, 2, 'Kertas Label', '2022-05-05 13:09:03', NULL),
(12, 2, 'Produk Tag', '2022-05-05 13:09:16', NULL),
(13, 2, 'Paper Bag', '2022-05-05 13:09:28', NULL),
(15, 2, 'Food Tray', '2022-05-05 13:09:53', NULL),
(18, 2, 'Sticker ', '2022-05-05 13:10:27', NULL),
(19, 2, 'Sticker Kemasan', '2022-05-05 13:10:39', NULL),
(21, 3, 'Map Folder', '2022-05-05 13:20:54', NULL),
(24, 3, 'Amplop', '2022-05-05 13:21:29', NULL),
(27, 3, 'Nota NCR', '2022-05-05 13:22:04', NULL),
(28, 3, 'Formulir', '2022-05-05 13:22:16', NULL),
(29, 3, 'Kop Surat', '2022-05-05 13:22:27', NULL),
(30, 4, 'Brosur', '2022-05-05 13:23:48', NULL),
(31, 4, 'Kalender', '2022-05-05 13:23:58', NULL),
(32, 4, 'Thankyou Card', '2022-05-05 13:24:09', NULL),
(33, 4, 'Member Card', '2022-05-05 13:24:27', NULL),
(34, 4, 'Katalog', '2022-05-05 13:24:39', NULL),
(35, 5, 'Undangan Pernikahan', '2022-05-05 13:11:41', NULL),
(36, 5, 'Undangan Anniversary Kantor', '2022-05-05 13:12:11', NULL),
(37, 5, 'Undangan Ulangtahun', '2022-05-05 13:18:39', NULL),
(38, 5, 'Undangan Natal&Tahun Baru', '2022-05-05 13:19:01', NULL),
(39, 5, 'Undangan Peresmian Kantor', '2022-05-05 13:20:05', NULL),
(55, 4, 'Menu', '2022-05-05 13:25:24', NULL),
(58, 4, 'Hanging Mobile', '2022-05-05 13:27:38', NULL),
(59, 6, 'X-Banner', '2022-05-05 13:28:09', NULL),
(60, 6, 'Roll Up Banner', '2022-05-05 13:28:22', NULL),
(61, 6, 'Tripod Banner', '2022-05-05 13:33:59', NULL),
(62, 6, 'Spanduk', '2022-05-05 13:34:25', NULL),
(63, 6, 'Poster', '2022-05-05 13:34:37', NULL),
(64, 7, 'E-Money', '2022-05-05 13:36:08', NULL),
(65, 7, 'Tas Spundbond', '2022-05-05 13:36:36', NULL),
(66, 7, 'Gantungan Kunci', '2022-05-05 13:37:01', NULL),
(67, 7, 'Mug', '2022-05-05 13:37:12', NULL),
(68, 7, 'Pin', '2022-05-05 13:37:30', NULL),
(69, 7, 'Pulpen', '2022-05-05 13:37:41', NULL),
(70, 7, 'Tumblr', '2022-05-05 13:37:55', NULL),
(71, 4, 'Booklet', '2022-05-05 13:24:51', NULL),
(72, 7, 'Jam Dinding', '2022-05-05 13:38:35', NULL),
(73, 7, 'Payung', '2022-05-05 13:38:52', NULL),
(74, 7, 'Dompet', '2022-05-05 13:39:13', NULL),
(75, 8, 'Kaos', '2022-05-05 13:39:36', NULL),
(76, 8, 'Taplak Meja', '2022-05-05 13:39:49', NULL),
(77, 8, 'Apron', '2022-05-05 13:40:03', '10-06-2022 09:54:57 PM'),
(78, 8, 'Totebag', '2022-05-05 13:40:20', NULL),
(79, 8, 'Pouch', '2022-05-05 13:40:31', NULL),
(80, 8, 'Topi', '2022-05-05 13:40:40', NULL),
(81, 8, 'Jaket', '2022-05-05 13:41:02', NULL),
(82, 9, 'Kanvas Print', '2022-05-05 14:26:40', NULL),
(83, 9, 'Akrilik Paint', '2022-05-05 14:28:00', NULL),
(84, 9, 'Photo Print', '2022-05-05 14:28:19', NULL),
(102, 17, 'Gelas keramik', '2022-06-19 10:49:27', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `userEmail` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `userlog`
--

INSERT INTO `userlog` (`id`, `userEmail`, `userip`, `loginTime`, `logout`, `status`) VALUES
(1, 'jesicaaulia28@gmail.com', 0x3a3a3100000000000000000000000000, '2022-05-14 08:50:06', NULL, 1),
(28, 'jesica.aulia.pardede@gmail.com', 0x3a3a3100000000000000000000000000, '2022-06-10 16:50:23', NULL, 0),
(29, 'jejecans@gmail.com', 0x3a3a3100000000000000000000000000, '2022-06-10 16:50:37', NULL, 0),
(30, 'dindabcd@gmail.com', 0x3a3a3100000000000000000000000000, '2022-06-10 16:51:41', NULL, 1),
(31, 'dindabcd@gmail.com', 0x3a3a3100000000000000000000000000, '2022-06-11 05:52:42', '11-06-2022 01:44:04 PM', 1),
(32, 'enjelita@gmail.com', 0x3a3a3100000000000000000000000000, '2022-06-11 08:35:45', NULL, 0),
(33, 'enjellita@gmail.com', 0x3a3a3100000000000000000000000000, '2022-06-11 08:36:13', '11-06-2022 03:19:15 PM', 1),
(34, 'jesica.aulia.pardede@gmail.com', 0x3a3a3100000000000000000000000000, '2022-06-11 09:50:18', '11-06-2022 05:10:48 PM', 1),
(35, 'enjellita@gmail.com', 0x3a3a3100000000000000000000000000, '2022-06-11 11:48:08', NULL, 1),
(36, 'jejecans8@gmail.com', 0x3a3a3100000000000000000000000000, '2022-06-19 10:43:11', NULL, 1),
(37, 'helmio10394@gmail.com', 0x3a3a3100000000000000000000000000, '2023-11-11 04:28:09', NULL, 0),
(38, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2023-11-11 04:28:44', NULL, 1),
(39, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2023-11-12 08:14:32', '12-11-2023 02:21:56 PM', 1),
(40, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2023-11-12 08:52:32', NULL, 1),
(41, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2023-11-30 05:16:01', NULL, 1),
(42, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2023-12-01 05:34:18', NULL, 1),
(43, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2023-12-03 03:46:23', NULL, 0),
(44, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2023-12-03 03:46:32', NULL, 1),
(45, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2023-12-03 08:08:26', NULL, 0),
(46, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2023-12-03 08:08:32', NULL, 1),
(47, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2023-12-05 00:13:21', NULL, 1),
(48, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2023-12-06 12:30:27', NULL, 1),
(49, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2023-12-07 02:35:05', NULL, 1),
(50, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-09 23:37:36', NULL, 1),
(51, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-10 03:02:53', NULL, 0),
(52, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-10 03:02:57', NULL, 1),
(53, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-15 13:05:23', NULL, 1),
(54, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-16 09:47:57', '16-01-2024 05:30:45 PM', 1),
(55, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-16 12:01:08', NULL, 1),
(56, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-17 04:02:36', NULL, 1),
(57, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-17 04:40:10', NULL, 1),
(58, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-19 02:08:11', NULL, 1),
(59, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-21 07:05:54', NULL, 1),
(60, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-21 07:36:13', NULL, 1),
(61, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-26 20:42:42', NULL, 1),
(62, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-26 20:42:50', NULL, 0),
(63, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-26 20:43:53', NULL, 1),
(64, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-26 20:45:04', '27-01-2024 02:15:30 AM', 1),
(65, 'helmi@ccc', 0x3a3a3100000000000000000000000000, '2024-01-26 20:45:39', NULL, 0),
(66, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-27 05:49:08', NULL, 1),
(67, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-31 02:14:36', '31-01-2024 07:58:04 AM', 1),
(68, 'rully@umj.ac.id', 0x3a3a3100000000000000000000000000, '2024-01-31 02:30:49', '31-01-2024 08:03:48 AM', 1),
(69, 'rully@umj.ac.id', 0x3a3a3100000000000000000000000000, '2024-01-31 02:34:55', '31-01-2024 08:38:27 AM', 1),
(70, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-31 03:08:37', NULL, 1),
(71, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-03-09 04:26:54', NULL, 0),
(72, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-03-09 04:27:01', NULL, 0),
(73, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-03-09 04:27:06', '09-03-2024 10:04:57 AM', 1),
(74, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-03-09 04:35:09', '09-03-2024 10:34:32 AM', 1),
(75, 'rully@umj.ac.id', 0x3a3a3100000000000000000000000000, '2024-03-09 05:04:44', NULL, 1),
(76, 'helmio10394@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-18 02:16:07', NULL, 0),
(77, 'helmio10394@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-18 02:16:12', NULL, 0),
(78, 'helmio10394@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-18 02:16:17', NULL, 0),
(79, 'helmio10394@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-18 02:16:23', NULL, 0),
(80, 'helmio10394@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-18 02:16:31', NULL, 0),
(81, 'helmio10394@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-18 02:16:37', NULL, 0),
(82, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-18 02:17:40', NULL, 1),
(83, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-18 03:44:55', NULL, 0),
(84, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-18 03:44:59', '18-05-2024 09:51:51 AM', 1),
(85, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-18 04:32:40', NULL, 1),
(86, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-19 21:11:12', NULL, 1),
(87, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-23 23:45:53', NULL, 1),
(88, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-07-21 07:38:50', NULL, 0),
(89, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-07-21 07:38:59', NULL, 1),
(90, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-07-21 17:08:50', '22-07-2024 12:31:37 AM', 1),
(91, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-07-21 19:01:44', '22-07-2024 12:32:29 AM', 1),
(92, 'helmiozone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-07-22 07:13:18', NULL, 0),
(93, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-07-22 07:13:23', NULL, 1),
(94, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-07-22 10:00:39', NULL, 1),
(95, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-07-23 16:40:14', NULL, 1),
(96, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-07-23 19:09:02', '24-07-2024 01:21:23 PM', 1),
(97, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-07-24 11:49:24', '25-07-2024 01:40:27 AM', 1),
(98, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-07-25 00:25:27', NULL, 1),
(99, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-07-25 07:30:34', '25-07-2024 01:01:15 PM', 1),
(100, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-07-25 07:31:20', NULL, 1),
(101, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-07-25 07:32:28', NULL, 1),
(102, 'radenn649@gmail.com', 0x3a3a3100000000000000000000000000, '2024-07-29 00:55:05', NULL, 0),
(103, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-07-29 00:55:13', NULL, 0),
(104, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-07-29 01:09:40', '29-07-2024 07:28:55 AM', 1),
(105, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-07-29 01:59:24', '29-07-2024 07:29:53 AM', 1),
(106, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-07-29 02:07:46', NULL, 1),
(107, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-07-29 03:25:17', NULL, 1),
(108, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-07-30 22:15:43', '31-07-2024 03:49:38 AM', 1),
(109, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-07-31 23:23:59', '01-08-2024 05:01:05 AM', 1),
(110, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-01 01:10:47', '01-08-2024 06:41:13 AM', 1),
(111, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-01 01:11:21', '01-08-2024 06:43:38 AM', 1),
(112, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-01 01:13:46', '01-08-2024 07:33:43 AM', 1),
(113, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-01 02:45:53', NULL, 1),
(114, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-04 21:30:04', '05-08-2024 05:12:50 AM', 1),
(115, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-04 23:43:19', '05-08-2024 05:25:33 AM', 1),
(116, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-05 23:24:57', '06-08-2024 06:33:07 AM', 1),
(117, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-06 02:50:36', NULL, 1),
(118, '2018470047@ftumj.ac.id', 0x3a3a3100000000000000000000000000, '2024-08-06 21:37:35', '07-08-2024 03:44:24 AM', 1),
(119, 'helmizone20@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-06 22:14:32', NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` varchar(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` int(14) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `shippingAddress` longtext DEFAULT NULL,
  `shippingState` varchar(255) DEFAULT NULL,
  `shippingCity` varchar(255) DEFAULT NULL,
  `shippingPincode` int(11) DEFAULT NULL,
  `billingAddress` longtext DEFAULT NULL,
  `billingState` varchar(255) DEFAULT NULL,
  `billingCity` varchar(255) DEFAULT NULL,
  `billingPincode` int(11) DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL,
  `level` int(14) NOT NULL,
  `status` int(1) NOT NULL,
  `custom_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contactno`, `password`, `shippingAddress`, `shippingState`, `shippingCity`, `shippingPincode`, `billingAddress`, `billingState`, `billingCity`, `billingPincode`, `regDate`, `updationDate`, `level`, `status`, `custom_id`) VALUES
('1', 'jesica aulia pardede', 'jesicaaulia28@gmail.com', 822755464, '81dc9bdb52d04dc20036dbd8313ed055', 'jl.Pembangunan', 'Medan', 'Sumatera Utara', 0, 'medan', '18', '21', 20135, '2022-05-14 08:49:51', '21-07-2024 07:15:32 PM', 1, 0, NULL),
('10', 'jesica aulia', 'jejecans8@gmail.com', 822756683, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-19 10:43:00', NULL, 0, 0, NULL),
('11', 'Muhammad Arif Helmi', 'helmizone20@gmail.com', 828828281, '81dc9bdb52d04dc20036dbd8313ed055', 'Jalan lancar 3 no 19 rt 06 rw 07 kelurahan sumur batu kecamatan kemayoran', 'jakarta pusat', 'Kota Administrasi Jakarta Pusat', 10640, 'Jalan lancar 3 no 19 rt 06 rw 07 kelurahan sumur batu kecamatan kemayoran', '', '194', 10640, '2023-11-11 04:27:57', NULL, 0, 0, NULL),
('12', 'Bu Rully', 'rully@umj.ac.id', 822211333, '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, NULL, NULL, 'Jalan lancar 3 no 19 rt 06 rw 07 kelurahan sumur batu kecamatan kemayoran', '16', '311', 10640, '2024-01-31 02:30:25', NULL, 0, 0, NULL),
('13', 'Muhammad Arif Helmi', 'helmio10394@gmail.com', 822211333, '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-29 01:05:58', NULL, 0, 0, NULL),
('7', 'dinda', 'dindabcd@gmail.com', 896759603, 'e10adc3949ba59abbe56e057f20f883e', 'jl.sentosa', 'Sumatera Utara', 'Medan', NULL, 'Jl.sentosa', 'Sumatera Utara', 'Medan', 20153, '2022-06-10 16:51:15', NULL, 0, 0, NULL),
('8', 'enjelita', 'enjellita@gmail.com', 822653262, 'e10adc3949ba59abbe56e057f20f883e', 'Delitua', 'Sumatera Utara', 'Medan', 20166, 'Delitua', 'Sumatera Utara', 'Medan', 20166, '2022-06-11 08:35:29', NULL, 0, 0, NULL),
('9', 'jeje', 'jesica.aulia.pardede@gmail.com', 822755464, 'e10adc3949ba59abbe56e057f20f883e', 'jl.pembangunan', 'Sumatera Utara', 'Medan', 20153, 'Jl.Pembangunan', 'Sumatera Utara', 'Medan', 20153, '2022-06-11 09:50:03', NULL, 0, 0, NULL),
('ID00001', 'Kampus Unggul', '2018470047@ftumj.ac.id', 822211333, '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-06 21:37:11', NULL, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `wishlist`
--

INSERT INTO `wishlist` (`id`, `userId`, `productId`, `postingDate`) VALUES
(2, 7, 8, '2022-06-10 16:52:08'),
(3, 7, 4, '2022-06-10 16:52:28');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `order_sequence`
--
ALTER TABLE `order_sequence`
  ADD PRIMARY KEY (`sequence_date`);

--
-- Indeks untuk tabel `productreviews`
--
ALTER TABLE `productreviews`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT untuk tabel `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `productreviews`
--
ALTER TABLE `productreviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT untuk tabel `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
