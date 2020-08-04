-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Bulan Mei 2019 pada 06.27
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir1`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `no_anggota` varchar(100) NOT NULL,
  `nama_anggota` varchar(40) NOT NULL,
  `alamat` varchar(40) NOT NULL,
  `bidang` varchar(20) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `no_telpon` int(14) NOT NULL,
  `hutang` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`no_anggota`, `nama_anggota`, `alamat`, `bidang`, `tanggal_masuk`, `tanggal_keluar`, `no_telpon`, `hutang`) VALUES
('0', '--Umum--', '', '', '0000-00-00', '0000-00-00', 0, 0),
('0222B', 'Budiman Rabbani', 'sekarbela', 'kesehatan', '2019-02-14', '0000-00-00', 2147483647, 0),
('L0001', 'M. Zaenudin Ahsan', 'Lombok Timur', 'Akutansi', '2019-04-10', '0000-00-00', 821826272, 0),
('L000C', 'Reza Rismawandi', 'Lombok Barat', 'Akutansi', '2019-04-17', '0000-00-00', 821826272, 0),
('L000D', 'Sulhan GOP', 'Udayana', 'Akutansi', '2019-04-10', '0000-00-00', 9133838, 0),
('L000F', 'Ramdani', 'Pagesangan', 'Kehutanan', '2019-04-08', '0000-00-00', 821826272, 0),
('L000G', 'Ilham Bintang', 'Sekarbela', 'Kesektariatan', '2019-04-18', '0000-00-00', 292822929, 60000),
('L00E', 'Iksanul', 'Pejeruk', 'Pertanian', '2019-04-10', '0000-00-00', 821826272, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `stok_barang` int(10) NOT NULL,
  `harga_barang` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `stok_barang`, `harga_barang`) VALUES
('B00000001', 'hahahah', 100, 1000),
('B0001', 'kecap bango', 0, 1000),
('B00011', 'milkita', 63, 500),
('B0002', 'kapal api', 366, 1000),
('B0004', 'enzim', 0, 2000),
('B0005', 'pepsoden', 662, 4000),
('B0006', 'biskuat', 50, 500),
('B0007', 'malkist', 0, 5000),
('B00071', 'yakult sehat', 6, 5000),
('B0009', 'lontong', 10, 10000),
('B02', 'tomat', 9, 10000),
('L0001', 'Rokok Surya', 9995, 10000),
('L000222', 'jeruk123', 97, 10000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hutang`
--

CREATE TABLE `hutang` (
  `id` int(11) NOT NULL,
  `no_anggota` varchar(100) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` double NOT NULL,
  `subtotal` double NOT NULL,
  `time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hutang`
--

INSERT INTO `hutang` (`id`, `no_anggota`, `id_barang`, `jumlah`, `harga`, `subtotal`, `time`) VALUES
(1, 'L000G', 'B0006', 3, 500, 1500, '2019-04-11'),
(2, 'L000G', 'L000222', 3, 10000, 30000, '2019-04-11'),
(3, 'L000G', 'B02', 3, 10000, 30000, '2019-04-11'),
(4, 'L000G', 'B00071', 70, 5000, 350000, '2019-04-11'),
(5, 'L000F', 'B0001', 3, 1000, 3000, '2019-04-11'),
(6, 'L000F', 'B0007', 44, 5000, 220000, '2019-04-11'),
(7, 'L0001', 'B00071', 2, 5000, 10000, '2019-04-11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `nota` varchar(30) NOT NULL,
  `nama_barang` varchar(40) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` double NOT NULL,
  `time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `nota`, `nama_barang`, `stok`, `harga`, `time`) VALUES
(11, 'abcdefg', 'fanta', 10, 5000, '2019-03-17'),
(12, 'abcdefg', 'fanta', 1, 5000, '2019-03-17'),
(13, 'abcdefg', 'pepsoden', 1, 5000, '2019-03-17'),
(14, 'NandaPunya', 'biskuat', 1, 1000, '2019-03-23'),
(16, 'NandaPunya', 'lontong', 10, 10000, '2019-03-23'),
(17, 'NandaPunya', 'lontong', 1, 1000, '2019-03-23'),
(18, 'NandaPunya', 'lontong', 1, 1000, '2019-03-23'),
(19, 'abcdefg', 'lontong', 1, 1000, '2019-03-23'),
(20, 'NandaPunya', 'pepsoden', 1, 10000, '2019-03-23'),
(21, 'NandaPunya', 'pepsoden', 1, 10000, '2019-03-23'),
(22, 'NandaPunya', 'biskuat', 10, 10000, '2019-03-23'),
(23, 'NandaPunya', 'biskuat', 1, 1000, '2019-03-23'),
(24, 'nsasjasjans', 'pepsoden', 10, 100000, '2019-04-02'),
(25, 'nsasjasjans', 'kecap bango', 10, 10000, '2019-04-05'),
(26, 'abc', 'jeruk', 100, 100000, '2019-04-10'),
(27, 'hahahahah', 'hahahah', 100, 100000, '2019-04-11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `nota` varchar(100) NOT NULL,
  `time` datetime NOT NULL,
  `total_harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`nota`, `time`, `total_harga`) VALUES
('5CA5519F1F0EC1', '2019-04-04 02:36:53', 1000),
('5CA551DC2592B1', '2019-04-04 02:37:55', 8000),
('5CA655DE946751', '2019-04-04 21:07:14', 4000),
('5CA6607F585591', '2019-04-04 21:56:05', 1000),
('5CA6628118B391', '2019-04-04 22:01:08', 1000),
('5CA670D10DF791', '2019-04-04 23:02:19', 1000),
('5CA67184EE8341', '2019-04-05 04:05:13', 1000),
('5CA671F4953A11', '2019-04-05 04:07:13', 47500),
('5CAB92D49515C1', '2019-04-09 01:28:50', 3000),
('5CAD01A1C7B0F1', '2019-04-10 03:33:55', 13000),
('5CAD03550F4071', '2019-04-10 03:41:04', 10000),
('5CAD6EC440E561', '2019-04-10 11:19:31', 12000),
('5CAD6F2C8EAE61', '2019-04-10 11:21:17', 1000),
('5CAD73B5D46201', '2019-04-10 11:40:37', 1500),
('5CAD743A05AA61', '2019-04-10 11:43:50', 1500),
('5CAD74D29737C1', '2019-04-10 11:45:25', 20000),
('5CAE5E310C9E27', '2019-04-11 04:21:36', 223000),
('5CAE60F231D521', '2019-04-11 04:32:46', 10000),
('5CAE832E9CCA71', '2019-04-11 06:59:06', 411500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `nota` varchar(30) NOT NULL,
  `nama_supplier` varchar(40) NOT NULL,
  `total_belanja` double NOT NULL,
  `time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`nota`, `nama_supplier`, `total_belanja`, `time`) VALUES
('35mfh583o2', 'boxi', 0, '2019-04-11'),
('abc', 'tokobunga', 100000, '2019-04-10'),
('abcdefg', 'toko puji', 11000, '2019-03-17'),
('hahahahah', 'bellashop', 100000, '2019-04-11'),
('NandaPunya', 'caseyuhu', 64000, '2019-03-23'),
('nsasjasjans', 'budi case', 110000, '2019-04-02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(100) NOT NULL,
  `nota` varchar(100) NOT NULL,
  `no_anggota` varchar(100) DEFAULT NULL,
  `id_barang` varchar(10) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `harga` int(100) NOT NULL,
  `qty` int(100) NOT NULL,
  `subtotal` int(100) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `nota`, `no_anggota`, `id_barang`, `id_user`, `harga`, `qty`, `subtotal`, `time`) VALUES
(63, '5CA5519F1F0EC1', 'L000G', 'B0001', 1, 1000, 1, 1000, '2019-04-04 02:36:53'),
(64, '5CA551DC2592B1', 'L0001', 'B0005', 1, 4000, 2, 8000, '2019-04-04 02:37:55'),
(65, '5CA655DE946751', '0', 'B0005', 1, 4000, 1, 4000, '2019-04-04 21:07:14'),
(66, '5CA6607F585591', 'L000D', 'B0001', 1, 1000, 1, 1000, '2019-04-04 21:56:05'),
(67, '5CA6628118B391', '0', 'B0002', 1, 1000, 1, 1000, '2019-04-04 22:01:08'),
(68, '5CA670D10DF791', '0', 'B0001', 1, 1000, 1, 1000, '2019-04-04 23:02:19'),
(69, '5CA67184EE8341', '0', 'B0001', 1, 1000, 1, 1000, '2019-04-05 04:05:13'),
(70, '5CA671F4953A11', 'L000F', 'B00011', 1, 500, 3, 1500, '2019-04-05 04:07:13'),
(71, '5CA671F4953A11', 'L000F', 'B0005', 1, 4000, 4, 16000, '2019-04-05 04:07:13'),
(72, '5CA671F4953A11', 'L000F', 'B0009', 1, 10000, 3, 30000, '2019-04-05 04:07:13'),
(73, '5CAB92D49515C1', '0222B', 'B0001', 1, 1000, 3, 3000, '2019-04-09 01:28:50'),
(74, '5CAD01A1C7B0F1', 'L000F', 'B0001', 1, 1000, 3, 3000, '2019-04-10 03:33:55'),
(75, '5CAD01A1C7B0F1', 'L000F', 'B0007', 1, 5000, 2, 10000, '2019-04-10 03:33:55'),
(76, '5CAD03550F4071', 'L000F', 'B0007', 1, 5000, 2, 10000, '2019-04-10 03:41:04'),
(77, '5CAD6EC440E561', 'L000D', 'B0005', 1, 4000, 3, 12000, '2019-04-10 11:19:31'),
(78, '5CAD6F2C8EAE61', 'L000D', 'B0001', 1, 1000, 1, 1000, '2019-04-10 11:21:17'),
(79, '5CAD73B5D46201', 'L000D', 'B00011', 1, 500, 3, 1500, '2019-04-10 11:40:37'),
(80, '5CAD73B5D46201', 'L000D', 'B00011', 1, 500, 3, 1500, '2019-04-10 11:41:14'),
(81, '5CAD743A05AA61', 'L000D', 'B00011', 1, 500, 3, 1500, '2019-04-10 11:42:41'),
(82, '5CAD743A05AA61', 'L000D', 'B00011', 1, 500, 3, 1500, '2019-04-10 11:43:15'),
(83, '5CAD743A05AA61', 'L000D', 'B00011', 1, 500, 3, 1500, '2019-04-10 11:43:50'),
(84, '5CAD74D29737C1', 'L000D', 'L0001', 1, 10000, 2, 20000, '2019-04-10 11:45:25'),
(85, '5CAE832E9CCA71', 'L000G', 'B0006', 1, 500, 3, 1500, '2019-04-11 06:59:06'),
(86, '5CAE832E9CCA71', 'L000G', 'L000222', 1, 10000, 3, 30000, '2019-04-11 06:59:06'),
(87, '5CAE832E9CCA71', 'L000G', 'B02', 1, 10000, 3, 30000, '2019-04-11 06:59:06'),
(88, '5CAE832E9CCA71', 'L000G', 'B00071', 1, 5000, 70, 350000, '2019-04-11 06:59:06'),
(89, '5CAE5E310C9E27', 'L000F', 'B0001', 7, 1000, 3, 3000, '2019-04-11 04:21:36'),
(90, '5CAE5E310C9E27', 'L000F', 'B0007', 7, 5000, 44, 220000, '2019-04-11 04:21:36'),
(91, '5CAE60F231D521', 'L0001', 'B00071', 1, 5000, 2, 10000, '2019-04-11 04:32:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('admin','kasir') NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `level`, `status`) VALUES
(1, 'Bang admin', 'admin', 'admin', 'admin', 'aktif'),
(7, 'Jaleha', 'KasirON', 'nnn', 'kasir', 'aktif'),
(8, 'JaleatuN', 'KasirOFF', 'KasirOFF', 'kasir', 'tidak aktif'),
(9, 'Budi', 'Budi', 'Budi', 'kasir', 'tidak aktif'),
(10, 'Ilham', 'Ilham', 'Ilham', 'kasir', 'tidak aktif');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`no_anggota`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `hutang`
--
ALTER TABLE `hutang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_anggota` (`no_anggota`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `nota` (`nota`),
  ADD KEY `nota_2` (`nota`),
  ADD KEY `nota_3` (`nota`),
  ADD KEY `nota_4` (`nota`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`nota`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`nota`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_anggota` (`no_anggota`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `nota` (`nota`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `hutang`
--
ALTER TABLE `hutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `hutang`
--
ALTER TABLE `hutang`
  ADD CONSTRAINT `hutang_ibfk_1` FOREIGN KEY (`no_anggota`) REFERENCES `anggota` (`no_anggota`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`nota`) REFERENCES `supplier` (`nota`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `nota` FOREIGN KEY (`nota`) REFERENCES `transaksi` (`nota`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`no_anggota`) REFERENCES `anggota` (`no_anggota`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
