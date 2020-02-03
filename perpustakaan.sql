-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 20, 2019 at 08:08 AM
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
  `id_penerbit` int(11) DEFAULT NULL,
  `id_genre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`isbn`, `judul`, `tahun_terbit`, `id_penerbit`, `id_genre`) VALUES
('1122334455667', 'UM Ceria', 1998, 3, 2),
('1234512345986', 'Bobo Terus Biar', 2020, 3, 4),
('1234567890100', 'qwertyuiop', 2011, 1, 1),
('2596323964939', 'wefpwpeofk', 2019, 3, 4),
('4330936094370', 'eertyuiolkjhb', 2019, 1, 4),
('5010580803133', 'buku4', 2017, 3, 4),
('7043753527569', 'judul1', 2017, 3, 4),
('9786024270995', 'Bahasa Indonesia Untuk SMA/MA/SMK/MAK Kelas X', 2017, 1, 1),
('9786024271008', 'Bahasa Indonesia Untuk SMA/MA/SMK/MAK Kelas XI', 2017, 1, 1),
('9786024271015', 'Bahasa Indonesia Untuk SMA/MA/SMK/MAK Kelas XII', 2017, 1, 1),
('9786024271152', 'Matematika Untuk SMA/MA/SMK/MAK Kelas X', 2017, 1, 3),
('9786024271169', 'Matematika Untuk SMA/MA/SMK/MAK Kelas XI', 2017, 1, 3),
('9786024271176', 'Matematika Untuk SMA/MA/SMK/MAK Kelas XII', 2017, 1, 3),
('9876567890987', 'lekflkrmflekrmflk', 2018, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id_detailpeminjaman` int(11) NOT NULL,
  `id_buku` varchar(4) NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `tgl_pengembalian` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_peminjaman`
--

INSERT INTO `detail_peminjaman` (`id_detailpeminjaman`, `id_buku`, `id_peminjaman`, `tgl_pengembalian`) VALUES
(1, '1112', 1, '2019-12-06'),
(2, '7', 1, '2019-12-06'),
(3, '3', 2, '2019-12-06'),
(4, '4', 2, '2019-12-20'),
(5, '1112', 3, '2019-12-18'),
(7, '1002', 6, NULL),
(8, '6', 7, NULL),
(9, '2', 8, '2019-12-11'),
(10, '3', 8, '2019-12-11'),
(11, '2', 9, NULL),
(12, '3', 9, NULL),
(18, '1112', 16, '2019-12-20'),
(19, '1qq1', 17, '2019-12-20');

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
(36, '9786024271176'),
(58, '2596323964939'),
(61, '5010580803133'),
(61, '1234567890100'),
(59, '9876567890987'),
(59, '4330936094370'),
(61, '4330936094370'),
(70, '1122334455667'),
(72, '1234512345986'),
(73, '1234512345986');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id_genre` int(11) NOT NULL,
  `nama_genre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id_genre`, `nama_genre`) VALUES
(1, 'Bahasa Indonesia'),
(2, 'Bahasa Inggris'),
(3, 'Matematika'),
(4, 'Umum'),
(8, 'genre1');

-- --------------------------------------------------------

--
-- Stand-in structure for view `history_itembuku`
-- (See below for the actual view)
--
CREATE TABLE `history_itembuku` (
`nodet` int(11)
,`idpinjam` int(11)
,`idbuku` varchar(4)
,`isbn` varchar(13)
,`judul` varchar(255)
,`tahun_terbit` year(4)
,`nis` varchar(12)
,`nama_siswa` varchar(255)
,`nip` varchar(18)
,`nama_petugas` varchar(255)
,`tgl_pinjam` varchar(40)
,`tgl_bataspinjam` varchar(40)
,`tgl_kembali` varchar(40)
,`denda` bigint(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `info_itembuku`
-- (See below for the actual view)
--
CREATE TABLE `info_itembuku` (
`isbn` varchar(13)
,`judul` varchar(255)
,`thnterbit` year(4)
,`idpenerbit` int(11)
,`namapenerbit` varchar(255)
,`idbuku` varchar(4)
,`harga` int(11)
,`tglbeli` date
);

-- --------------------------------------------------------

--
-- Table structure for table `item_buku`
--

CREATE TABLE `item_buku` (
  `id_buku` varchar(4) NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `tgl_pembelian` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_buku`
--

INSERT INTO `item_buku` (`id_buku`, `isbn`, `harga`, `tgl_pembelian`) VALUES
('1002', '9786024270995', 21000, '2019-11-26'),
('1003', '9786024270995', 21000, '2019-11-25'),
('1112', '2596323964939', 21000, '2019-11-25'),
('1qq1', '1122334455667', 50000, '2019-11-20'),
('2', '9786024270995', 30000, '2019-11-03'),
('3', '9786024270995', 30000, '2019-11-03'),
('4', '9786024271008', 35000, '2019-11-04'),
('4532', '1234512345986', 75000, '2019-11-20'),
('5', '9786024271008', 35000, '2019-11-04'),
('6', '7043753527569', 30000, '2019-11-15'),
('7', '5010580803133', 20000, '2019-11-06'),
('lkjh', '4330936094370', 900, '2019-11-20'),
('lkle', '4330936094370', 900, '2019-11-20'),
('lwke', '4330936094370', 800, '2019-11-20'),
('q000', '1234567890100', 1200, '2019-11-17'),
('q001', '1234567890100', 20000, '2019-11-26'),
('q002', '1234567890100', 20000, '2019-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, 'XI TKJ 1'),
(2, 'X TKJ 1'),
(3, 'XI TKR 1'),
(4, 'XI TKR 3'),
(5, 'XI TP'),
(6, 'XI TEI 1'),
(11, 'XI TTT 3');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `nis` varchar(12) NOT NULL,
  `nip` varchar(18) NOT NULL,
  `tgl_peminjaman` date NOT NULL DEFAULT current_timestamp(),
  `tgl_batas_peminjaman` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `nis`, `nip`, `tgl_peminjaman`, `tgl_batas_peminjaman`) VALUES
(1, '2947/707.066', '883952488698869853', '2019-12-04', '2019-12-18'),
(2, '258074832212', '969058080334131030', '2019-12-04', '2019-12-18'),
(3, '557186401812', '969058080334131030', '2019-12-04', '2019-12-18'),
(6, '2947/707.066', '883952488698869853', '2019-12-06', '2019-12-20'),
(7, '2951/711.066', '883952488698869853', '2019-12-11', '2019-12-25'),
(8, '2951/711.066', '883952488698869853', '2019-11-27', '2019-12-05'),
(9, '2947/707.066', '883952488698869853', '2019-12-11', '2019-11-20'),
(15, '123456712347', '123456789012345678', '2019-12-20', '2020-01-03'),
(16, '123456712347', '123456789012345678', '2019-12-20', '2020-01-03'),
(17, '112233445566', '123456789012345678', '2019-12-20', '2020-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` int(11) NOT NULL,
  `nama_penerbit` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`, `alamat`) VALUES
(1, 'Pusat Kurikulum dan Perbukuan, Balitbang, Kemendikbud.', 'Jakarta'),
(3, 'penerbit1', 'jl. mawar kota bunga'),
(7, 'penerbit2', 'jl. mawar kota bunga');

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
(3, 'Suherli'),
(6, 'Bornok_Sinaga'),
(9, 'Maman_Suryaman'),
(10, 'Aji_Septiaji'),
(11, 'Istiqomah'),
(13, 'Andri_Kristianto_Sitanggang'),
(14, 'Tri_Andri_Hutapea'),
(17, 'Mangara_Simanjorang'),
(18, 'Sudianto_Manullang'),
(23, 'Lasker_Pangarapan_Sinaga'),
(26, 'Mangaratua_Marianus_S.'),
(27, 'Pardomuan_N._J._M._Sinambel'),
(29, 'Tjang_Daniel_Chandra'),
(30, 'Ipung_Yuwono'),
(31, 'Lathiful_Anwar'),
(32, 'Syaiful_Hamzah_Nasution'),
(33, 'Dahliatul_Hasanah'),
(34, 'Makbul_Muksar'),
(35, 'Vita_Kusuma_Sari'),
(36, 'Nur_Atikah.'),
(55, 'Abdur_Rahman_As’ari'),
(57, 'pengarang1'),
(58, 'pengarang4'),
(59, 'Pengarang5'),
(61, 'Pengarang11'),
(66, 'Pengarang51'),
(70, 'Yudha'),
(71, 'Maman'),
(72, 'Supano'),
(73, 'Urmano');

-- --------------------------------------------------------

--
-- Stand-in structure for view `pengarang_bukutotal`
-- (See below for the actual view)
--
CREATE TABLE `pengarang_bukutotal` (
`id` int(11)
,`pengarang` varchar(255)
,`total` bigint(21)
);

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
('123456789012345678', 'Default', '$2y$11$SytwuP5S1sufAiretboNEuUrP5C3/bBqb3dj1LOe0HIeYCIbXaGGi'),
('883952488698869853', 'Wahyudi Setiawan', '$2y$11$d95wiWWQNfox7qwa3QHLleL/exsWpsKbYrNtPnjGLeHU9a2eiv8nG'),
('969058080334131030', 'sulastri setiawati', '$2y$11$AvG6XBVBy0m1vn7m3tmHYOnTDirJa/hOuJ6roUTjT.KO4UMGoTf1K');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(12) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_kelas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `nama_siswa`, `password`, `id_kelas`) VALUES
('112233445566', 'Terserah', '$2y$11$X2/y4Pv.3lPGOnWY9PDsteNa6pH0.TPHDNwTy8UonaLjs//eu3.ZK', 6),
('123456712347', 'wlekfmlwekfmw', '$2y$11$UgvVFBiNFgFHZbN3ow/sOuHD0gMW4WVRzDeb8Ja/JvKIQkkWPkFsG', 1),
('123456789012', 'wlekfml', '$2y$11$2lwAZQVJOMM3FzdiSpBZeO1kFqeY431iGYzJ06tnMmjZQGVp1X06u', 1),
('258074832212', 'putranto', '$2y$11$bms2jrytjVBiHke9ZKdJSuzLR3pyg8v3uzXf8Ut.LJ4WKLo4d0/am', 3),
('2947/707.061', 'budiiiii', '$2y$11$B9.IBlsiYoVIduEDMJ8cmuvlwgJjghYrmVPxliORfyZwrkwKvC5ZS', 2),
('2947/707.066', 'Ayu Pertiwi', '$2y$11$3fxvAsn/JA8nQgc.3V/2nuPyDQf.HpwX9X3VIXkPVJPKVHElerRW2', 5),
('2951/711.066', 'ACHMAD QAMARUDIN ARIF', '$2y$11$3oBZGpl8e4rs5.2lBOK18uMgf.L0hik15qViYrygHxhn5d7zAl1nG', 1),
('2953/713.066', 'AHMAD HAKAM ARYA KUSUMA NUGRAHA', '$2y$11$w2A1F0BpGoUKBP2V6GR6meM5Ib7TFAUN0iVPUXzlBMYR5pUw0FkHq', 1),
('2967/727.066', 'ERLINDA AYU RAHMAWATI', '$2y$11$SkEmQlrfMjRM5JuiYXIp9uhfEcM6st.svEhgcFlp3.f5vApPC/2Ne', 1),
('3377593965', 'budiawan', '$2y$11$XN9fRTrQ7OMknJRGzdel1OSAz.pnxTW5G1W3Zzjtj8M8VQWAezgUy', 3),
('4408623260', 'Benu Kurniawati', '$2y$11$FW5RYu2cWBwQAC/j3rP6/eAbVwH9KTaUgajUEFwMpa1fU0JvPftZS', 4),
('557186401812', 'Ina Susilowati', '$2y$11$kADFtfKtCObozxTksIa1oeTmrGQsmZs4dOnQyGaW.o2d.q3fgm6H.', 6),
('6149323707', 'budi', '$2y$11$CAtXrDAmTckJCbPsCiigtu81J4q04dDzYRWO1i9uyxF5VRAr9B9ny', 6),
('614932370714', 'damar', '$2y$11$0G4M/Gs6P8UNGnRbJw6fH.qUSP/1dWO9ZBvypHCwPEESSkgv28NeG', 4),
('615765099915', 'Agus', '$2y$11$JafetjcLkHxo8WORv5frSu3FsnLuaajf.vVLCB9tsCR41.ct3IXce', 5),
('6680679098', 'putra kurniawan', '$2y$11$7DUCzUXkQquoySvidRuLyO8pRbzsTjGGLi01uh818J7XRNgpsAl/u', 1),
('8191551020', 'saputri', '$2y$11$y6qm7i64WfLuTEEBtqv91.SKihfxmFr3DtNpKMRgNYdViaHTjek96', 1),
('wlekflwkelkm', 'wlekfwlekm', '$2y$11$Lu17mfYwyxwoOgSQOqcwIuee6iQQhYFi3fz1QJFwsMvqdJbVZgZTq', 1);

-- --------------------------------------------------------

--
-- Structure for view `history_itembuku`
--
DROP TABLE IF EXISTS `history_itembuku`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `history_itembuku`  AS  select `detpin`.`id_detailpeminjaman` AS `nodet`,`pinjam`.`id_peminjaman` AS `idpinjam`,`item`.`id_buku` AS `idbuku`,`b`.`isbn` AS `isbn`,`b`.`judul` AS `judul`,`b`.`tahun_terbit` AS `tahun_terbit`,`s`.`nis` AS `nis`,`s`.`nama_siswa` AS `nama_siswa`,`p`.`nip` AS `nip`,`p`.`nama_petugas` AS `nama_petugas`,date_format(`pinjam`.`tgl_peminjaman`,'%d %b %Y') AS `tgl_pinjam`,date_format(`pinjam`.`tgl_batas_peminjaman`,'%d %b %Y') AS `tgl_bataspinjam`,date_format(`detpin`.`tgl_pengembalian`,'%d %b %Y') AS `tgl_kembali`,case when to_days(`detpin`.`tgl_pengembalian`) - to_days(`pinjam`.`tgl_batas_peminjaman`) > 0 then (to_days(`detpin`.`tgl_pengembalian`) - to_days(`pinjam`.`tgl_batas_peminjaman`)) * 500 else 0 end AS `denda` from (((((`detail_peminjaman` `detpin` left join `peminjaman` `pinjam` on(`detpin`.`id_peminjaman` = `pinjam`.`id_peminjaman`)) left join `item_buku` `item` on(`detpin`.`id_buku` = `item`.`id_buku`)) left join `buku` `b` on(`item`.`isbn` = `b`.`isbn`)) left join `siswa` `s` on(`pinjam`.`nis` = `s`.`nis`)) left join `petugas` `p` on(`pinjam`.`nip` = `p`.`nip`)) ;

-- --------------------------------------------------------

--
-- Structure for view `info_itembuku`
--
DROP TABLE IF EXISTS `info_itembuku`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `info_itembuku`  AS  select `b`.`isbn` AS `isbn`,`b`.`judul` AS `judul`,`b`.`tahun_terbit` AS `thnterbit`,`p`.`id_penerbit` AS `idpenerbit`,`p`.`nama_penerbit` AS `namapenerbit`,`i`.`id_buku` AS `idbuku`,`i`.`harga` AS `harga`,`i`.`tgl_pembelian` AS `tglbeli` from ((`buku` `b` left join `penerbit` `p` on(`b`.`id_penerbit` = `p`.`id_penerbit`)) left join `item_buku` `i` on(`b`.`isbn` = `i`.`isbn`)) ;

-- --------------------------------------------------------

--
-- Structure for view `pengarang_bukutotal`
--
DROP TABLE IF EXISTS `pengarang_bukutotal`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pengarang_bukutotal`  AS  select `p`.`id_pengarang` AS `id`,`p`.`nama_pengarang` AS `pengarang`,count(`d`.`id_pengarang`) AS `total` from (`pengarang` `p` left join `detail_pengarangbuku` `d` on(`p`.`id_pengarang` = `d`.`id_pengarang`)) group by `p`.`id_pengarang` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`isbn`),
  ADD KEY `id_penerbit` (`id_penerbit`),
  ADD KEY `id_genre` (`id_genre`);

--
-- Indexes for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD PRIMARY KEY (`id_detailpeminjaman`),
  ADD KEY `detail_peminjaman_ibfk_2` (`id_peminjaman`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `detail_pengarangbuku`
--
ALTER TABLE `detail_pengarangbuku`
  ADD KEY `detail_pengarangbuku_ibfk_1` (`id_pengarang`),
  ADD KEY `detail_pengarangbuku_ibfk_2` (`isbn`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id_genre`);

--
-- Indexes for table `item_buku`
--
ALTER TABLE `item_buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `isbn` (`isbn`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `peminjaman_ibfk_1` (`nip`),
  ADD KEY `peminjaman_ibfk_2` (`nis`);

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
  ADD PRIMARY KEY (`nis`),
  ADD UNIQUE KEY `nisn` (`nis`),
  ADD KEY `siswa_ibfk_1` (`id_kelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  MODIFY `id_detailpeminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id_genre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pengarang`
--
ALTER TABLE `pengarang`
  MODIFY `id_pengarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`) ON DELETE SET NULL ON UPDATE CASCADE;

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
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `petugas` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
