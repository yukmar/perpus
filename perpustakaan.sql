-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 02, 2019 at 06:16 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `isbn` varchar(13) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `id_penerbit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`isbn`, `judul`, `tahun_terbit`, `id_penerbit`) VALUES
('5010580803133', 'buku4', 2017, 3),
('7043753527569', 'judul1', 2017, 3),
('9786024270995', 'Bahasa Indonesia Untuk SMA/MA/SMK/MAK Kelas X', 2017, 1),
('9786024271008', 'Bahasa Indonesia Untuk SMA/MA/SMK/MAK Kelas XI', 2017, 1),
('9786024271015', 'Bahasa Indonesia Untuk SMA/MA/SMK/MAK Kelas XII', 2017, 1),
('9786024271152', 'Matematika Untuk SMA/MA/SMK/MAK Kelas X', 2017, 1),
('9786024271169', 'Matematika Untuk SMA/MA/SMK/MAK Kelas XI', 2017, 1),
('9786024271176', 'Matematika Untuk SMA/MA/SMK/MAK Kelas XII', 2017, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id_buku` varchar(4) NOT NULL,
  `id_peminjaman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengarangbuku`
--

CREATE TABLE `detail_pengarangbuku` (
  `id_pengarang` int(11) NOT NULL,
  `isbn` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pengarangbuku`
--

INSERT INTO `detail_pengarangbuku` (`id_pengarang`, `isbn`) VALUES
(1, '5010580803133'),
(2, '7043753527569'),
(3, '9786024270995'),
(9, '9786024270995'),
(10, '9786024270995'),
(11, '9786024270995'),
(3, '9786024271008'),
(9, '9786024271008'),
(10, '9786024271008'),
(11, '9786024271008'),
(9, '9786024271015'),
(3, '9786024271015'),
(11, '9786024271015'),
(6, '9786024271152'),
(27, '9786024271152'),
(13, '9786024271152'),
(14, '9786024271152'),
(18, '9786024271152'),
(23, '9786024271152'),
(17, '9786024271152'),
(18, '9786024271169'),
(13, '9786024271169'),
(14, '9786024271169'),
(23, '9786024271169'),
(6, '9786024271169'),
(26, '9786024271169'),
(27, '9786024271169'),
(55, '9786024271176'),
(29, '9786024271176'),
(31, '9786024271176'),
(32, '9786024271176'),
(33, '9786024271176'),
(34, '9786024271176'),
(35, '9786024271176'),
(36, '9786024271176');

-- --------------------------------------------------------

--
-- Table structure for table `item_buku`
--

CREATE TABLE `item_buku` (
  `id_buku` varchar(4) NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `harga` int(11) NOT NULL,
  `tgl_pembelian` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_buku`
--

INSERT INTO `item_buku` (`id_buku`, `isbn`, `harga`, `tgl_pembelian`) VALUES
('1', '9786024270995', 30000, '2019-11-03'),
('2', '9786024270995', 30000, '2019-11-03'),
('3', '9786024270995', 30000, '2019-11-03'),
('4', '9786024271008', 35000, '2019-11-04'),
('5', '9786024271008', 35000, '2019-11-04'),
('6', '7043753527569', 30000, '2019-11-15'),
('7', '5010580803133', 20000, '2019-11-06');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `nisn` varchar(10) NOT NULL,
  `nip` varchar(18) NOT NULL,
  `tgl_peminjaman` date NOT NULL DEFAULT current_timestamp(),
  `tgl_batas_peminjaman` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` int(11) NOT NULL,
  `nama_penerbit` varchar(255) NOT NULL,
  `kota` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`, `kota`) VALUES
(1, 'Pusat Kurikulum dan Perbukuan, Balitbang, Kemendikbud.', ''),
(3, 'penerbit1', 'kota1a');

-- --------------------------------------------------------

--
-- Table structure for table `pengarang`
--

CREATE TABLE `pengarang` (
  `id_pengarang` int(11) NOT NULL,
  `nama_pengarang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengarang`
--

INSERT INTO `pengarang` (`id_pengarang`, `nama_pengarang`) VALUES
(1, 'pengarang3'),
(2, 'pengarang2'),
(3, 'Suherli'),
(6, 'Bornok Sinaga'),
(9, 'Maman Suryaman'),
(10, 'Aji Septiaji'),
(11, 'Istiqomah'),
(13, 'Andri Kristianto Sitanggang'),
(14, 'Tri Andri Hutapea'),
(17, 'Mangara Simanjorang'),
(18, 'Sudianto Manullang'),
(23, 'Lasker Pangarapan Sinaga'),
(26, 'Mangaratua Marianus S.'),
(27, 'Pardomuan N. J. M. Sinambel'),
(29, 'Tjang Daniel Chandra'),
(30, 'Ipung Yuwono'),
(31, 'Lathiful Anwar'),
(32, 'Syaiful Hamzah Nasution'),
(33, 'Dahliatul Hasanah'),
(34, 'Makbul Muksar'),
(35, 'Vita Kusuma Sari'),
(36, 'Nur Atikah.'),
(55, 'Abdur Rahman As’ari');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `nip` varchar(18) NOT NULL,
  `nama_petugas` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`nip`, `nama_petugas`, `password`) VALUES
('883952488698869853', 'Wahyudi Setiawan', '$2y$11$d95wiWWQNfox7qwa3QHLleL/exsWpsKbYrNtPnjGLeHU9a2eiv8nG'),
('969058080334131030', 'sulastri setiawati', '$2y$11$AvG6XBVBy0m1vn7m3tmHYOnTDirJa/hOuJ6roUTjT.KO4UMGoTf1K');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nisn` varchar(10) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nisn`, `nama_siswa`, `password`) VALUES
('2056967053', 'Ayu Pertiwi', '$2y$11$vsQ.vHFBScFjQjJuU7PjauzaLuMCNabRTaoAiroVMv67TqVp9HnJ.'),
('2580748322', 'putranto', '$2y$11$bms2jrytjVBiHke9ZKdJSuzLR3pyg8v3uzXf8Ut.LJ4WKLo4d0/am'),
('3377593965', 'budiawan', '$2y$11$XN9fRTrQ7OMknJRGzdel1OSAz.pnxTW5G1W3Zzjtj8M8VQWAezgUy'),
('4408623260', 'Benu Kurniawati', '$2y$11$FW5RYu2cWBwQAC/j3rP6/eAbVwH9KTaUgajUEFwMpa1fU0JvPftZS'),
('5571864018', 'Ina Susilowati', '$2y$11$kADFtfKtCObozxTksIa1oeTmrGQsmZs4dOnQyGaW.o2d.q3fgm6H.'),
('6149323707', 'budi', '$2y$11$CAtXrDAmTckJCbPsCiigtu81J4q04dDzYRWO1i9uyxF5VRAr9B9ny'),
('6157650999', 'Bagus Perdana', '$2y$11$Q9pXaHH0YNjxDa4GV5.AmO8SPOYROGhiecyR94I7ziKZyS6BVQmDm'),
('6680679098', 'putra kurniawan', '$2y$11$7DUCzUXkQquoySvidRuLyO8pRbzsTjGGLi01uh818J7XRNgpsAl/u'),
('8191551020', 'saputri', '$2y$11$y6qm7i64WfLuTEEBtqv91.SKihfxmFr3DtNpKMRgNYdViaHTjek96');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`isbn`),
  ADD KEY `buku_ibfk_1` (`id_penerbit`);

--
-- Indexes for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD KEY `detail_peminjaman_ibfk_2` (`id_peminjaman`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `detail_pengarangbuku`
--
ALTER TABLE `detail_pengarangbuku`
  ADD KEY `detail_pengarangbuku_ibfk_1` (`id_pengarang`),
  ADD KEY `detail_pengarangbuku_ibfk_2` (`isbn`);

--
-- Indexes for table `item_buku`
--
ALTER TABLE `item_buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `isbn` (`isbn`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `nip` (`nip`),
  ADD KEY `nisn` (`nisn`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indexes for table `pengarang`
--
ALTER TABLE `pengarang`
  ADD PRIMARY KEY (`id_pengarang`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`nip`),
  ADD UNIQUE KEY `nip` (`nip`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD UNIQUE KEY `nisn` (`nisn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengarang`
--
ALTER TABLE `pengarang`
  MODIFY `id_pengarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD CONSTRAINT `detail_peminjaman_ibfk_2` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_peminjaman_ibfk_3` FOREIGN KEY (`id_buku`) REFERENCES `item_buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_pengarangbuku`
--
ALTER TABLE `detail_pengarangbuku`
  ADD CONSTRAINT `detail_pengarangbuku_ibfk_1` FOREIGN KEY (`id_pengarang`) REFERENCES `pengarang` (`id_pengarang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pengarangbuku_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `buku` (`isbn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_buku`
--
ALTER TABLE `item_buku`
  ADD CONSTRAINT `item_buku_ibfk_1` FOREIGN KEY (`isbn`) REFERENCES `buku` (`isbn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `petugas` (`nip`) ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
