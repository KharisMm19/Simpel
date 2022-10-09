-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2021 at 08:14 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simpel2`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_lhp`
--

CREATE TABLE `detail_lhp` (
  `id_detail_lhp` int(11) NOT NULL,
  `id_skpd` int(11) NOT NULL,
  `id_lhp` int(11) NOT NULL,
  `id_temuan` int(11) NOT NULL,
  `id_rekomendasi` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_lhp`
--

INSERT INTO `detail_lhp` (`id_detail_lhp`, `id_skpd`, `id_lhp`, `id_temuan`, `id_rekomendasi`, `createdAt`) VALUES
(1198741974, 1, 407797508, 1187183202, 1083246865, '2021-07-22 12:10:06'),
(1242027161, 1, 407797508, 500531073, 79199619, '2021-07-22 12:10:26'),
(1474212351, 1, 407797508, 500531073, 1185826575, '2021-07-22 12:10:25');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `id_rekomendasi` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `id_rekomendasi`, `file_name`) VALUES
(432614540, 1083246865, '003-Alur_Pengajuan_Proposal_Tahap_2_TA__2020-2021_(1).pdf'),
(696120391, 1185826575, 'Farid_Kevin_Nafis_Falaah_FIS.xlsx'),
(1092133762, 1185826575, 'SPK-master.zip'),
(1347227425, 1083246865, 'Akun_Pancingan_Baru_lagi.zip'),
(1505184752, 1185826575, '003-Alur_Pengajuan_Proposal_Tahap_2_TA__2020-2021_(1)1.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_user`
--

CREATE TABLE `jenis_user` (
  `id_jenis_user` int(11) NOT NULL,
  `nama_jenis_user` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_user`
--

INSERT INTO `jenis_user` (`id_jenis_user`, `nama_jenis_user`) VALUES
(1, 'Admin'),
(2, 'Auditor'),
(3, 'Tim Tindak Lanjut'),
(4, 'SKPD');

-- --------------------------------------------------------

--
-- Table structure for table `lhp`
--

CREATE TABLE `lhp` (
  `id_lhp` int(11) NOT NULL,
  `no_lhp` varchar(255) NOT NULL,
  `judul_lhp` varchar(255) NOT NULL,
  `id_skpd` int(11) NOT NULL,
  `tahun` varchar(5) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lhp`
--

INSERT INTO `lhp` (`id_lhp`, `no_lhp`, `judul_lhp`, `id_skpd`, `tahun`, `createdAt`) VALUES
(407797508, 'B23/INSP-SEKRT/Test/2021', 'Audit investigasi pada BPKAD', 1, '2020', '2021-07-22 12:09:56');

-- --------------------------------------------------------

--
-- Table structure for table `rekomendasi`
--

CREATE TABLE `rekomendasi` (
  `id_rekomendasi` int(11) NOT NULL,
  `id_lhp` int(11) NOT NULL,
  `id_skpd` int(11) NOT NULL,
  `id_temuan` int(11) NOT NULL,
  `id_status` int(11) NOT NULL DEFAULT 3,
  `rekomendasi` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekomendasi`
--

INSERT INTO `rekomendasi` (`id_rekomendasi`, `id_lhp`, `id_skpd`, `id_temuan`, `id_status`, `rekomendasi`, `keterangan`, `createdAt`) VALUES
(79199619, 407797508, 1, 500531073, 3, 'kepada kepala Dinas Kesehatan memerintahkan PPTK keg. perjalanan dinas studi banding bla bla bla menyetorkan kelebihan biaya perjalanan dinas sebesar 300 juta', NULL, '2021-07-22 12:10:26'),
(1083246865, 407797508, 1, 1187183202, 1, 'kepada kepala BPKADA memerintahkan PPTK keg. perjalanan dinas studi banding bla bla bla menyetorkan kelebihan biaya perjalanan dinas sebesar 200 juta', 'Upload Bukti Setoran', '2021-07-22 12:10:05'),
(1185826575, 407797508, 1, 500531073, 1, 'kepada kepala BPKADA memerintahkan PPTK keg. perjalanan dinas studi banding bla bla bla menyetorkan kelebihan biaya perjalanan dinas sebesar 300 juta', 'Kurang Upload Bukti Pembayaran Lagi', '2021-07-22 12:10:25');

-- --------------------------------------------------------

--
-- Table structure for table `skpd`
--

CREATE TABLE `skpd` (
  `id_skpd` int(11) NOT NULL,
  `nama_skpd` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skpd`
--

INSERT INTO `skpd` (`id_skpd`, `nama_skpd`) VALUES
(1, 'Badan Pengelola Keuangan dan Aset Daerah Kabupaten Tabalong'),
(3, 'Inspektorat Daerah Kabupaten Tabalong'),
(9, 'Badan Kepegawaian Pendidikan dan Pelatihan Kabupaten Tabalong'),
(10, 'Badan Pengelola Pajak dan Retribusi Daerah Kabupaten Tabalong'),
(11, 'Badan Perencanaan Pembangunan Daerah Kabupaten Tabalong'),
(12, 'Dinas Kepemudaan Olahraga dan Pariwisata Kabupaten Tabalong'),
(13, 'Dinas Kesehatan Kabupaten Tabalong'),
(14, 'Dinas Ketahanan Pangan Kabupaten Tabalong'),
(15, 'Dinas Komunikasi, Informatika dan Statistik Kabupaten Tabalong'),
(16, 'Dinas Koperasi, Usaha Kecil dan Menengah Kabupaten Tabalong'),
(17, 'Dinas Lingkungan Hidup Kabupaten Tabalong'),
(18, 'Dinas Pekerjaan Umum dan Penataan Ruang Kabupaten Tabalong'),
(19, 'Dinas Pemberdayaan Masyarakat dan Pemerintahan Desa Kabupaten Tabalong'),
(20, 'Dinas Pemberdayaan Perempuan Perlindungan Anak Pengendalian Penduduk dan KB Kabupaten Tabalong'),
(21, 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu Kabupaten Tabalong'),
(22, 'Dinas Pendidikan Kabupaten Tabalong'),
(23, 'Dinas Perhubungan Kabupaten Tabalong'),
(24, 'Dinas Perikanan Kabupaten Tabalong'),
(25, 'Dinas Perindustrian dan Perdagangan Kabupaten Tabalong'),
(26, 'Dinas Perpustakaan dan Kearsipan Kabupaten Tabalong'),
(27, 'Dinas Perumahan Rakyat, Kawasan Permukiman dan Pertanahan Kabupaten Tabalong'),
(28, 'Dinas Sosial Kabupaten Tabalong'),
(29, 'Dinas Tenaga Kerja Kabupaten Tabalong'),
(30, 'Satuan Polisi Pamong Praja Kabupaten Tabalong'),
(31, 'Sekertariat Daerah Kabupaten Tabalong'),
(32, 'Sekertariat DPRD Kabupaten Tabalong'),
(33, 'Badan Kesatuan Bangsa dan Politik Kabupaten Tabalong'),
(34, 'Kecamatan Banua Lawas'),
(35, 'Kecamatan Bintang Ara'),
(36, 'Kecamatan Haruai'),
(37, 'Kecamatan Jaro'),
(38, 'Kecamatan Kelua'),
(39, 'Kecamatan Muara Harus'),
(40, 'Kecamatan Murung Pudak'),
(41, 'Kecamatan Pugaan'),
(42, 'Kecamatan Tanjung'),
(43, 'Kecamatan Tanta'),
(44, 'Kecamatan Upau');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `status`) VALUES
(1, 'Sesuai'),
(2, 'Belum Sesuai'),
(3, 'Belum Ditindak-lanjuti');

-- --------------------------------------------------------

--
-- Table structure for table `temuan`
--

CREATE TABLE `temuan` (
  `id_temuan` int(11) NOT NULL,
  `id_lhp` int(11) NOT NULL,
  `id_skpd` int(11) NOT NULL,
  `temuan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temuan`
--

INSERT INTO `temuan` (`id_temuan`, `id_lhp`, `id_skpd`, `temuan`) VALUES
(500531073, 407797508, 1, 'kelebihan pembayaran uang makan'),
(1187183202, 407797508, 1, 'kelebihan pembayaran perjalanan dinas keg. rapat koordinasi');

-- --------------------------------------------------------

--
-- Table structure for table `tindak_lanjut`
--

CREATE TABLE `tindak_lanjut` (
  `id_tindak_lanjut` int(11) NOT NULL,
  `id_lhp` int(11) NOT NULL,
  `id_skpd` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tindak_lanjut`
--

INSERT INTO `tindak_lanjut` (`id_tindak_lanjut`, `id_lhp`, `id_skpd`, `createdAt`) VALUES
(668103911, 407797508, 1, '2021-07-22 13:41:14'),
(886243673, 407797508, 1, '2021-07-22 13:51:55'),
(1278490924, 407797508, 1, '2021-07-22 14:03:04'),
(1281296423, 407797508, 1, '2021-07-22 13:59:06'),
(1297690593, 407797508, 1, '2021-07-22 13:28:43'),
(1536178934, 407797508, 1, '2021-07-22 13:29:03'),
(1607495952, 407797508, 1, '2021-07-22 14:01:32'),
(1627397804, 407797508, 1, '2021-07-22 14:08:49'),
(1912318323, 407797508, 1, '2021-07-22 14:04:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `id_jenis_user` int(11) NOT NULL,
  `id_skpd` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nomor_telepon` varchar(20) NOT NULL,
  `foto_user` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `id_jenis_user`, `id_skpd`, `nama_user`, `username`, `password`, `email`, `nomor_telepon`, `foto_user`) VALUES
(3, 1, 3, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@mail.com', '123456789', 'admin.png'),
(4, 2, 3, 'Auditor', 'auditor', 'f7d07071ed9431ecae3a8d45b4c82bb2', 'auditor@mail.com', '123456789', 'admin.png'),
(6, 3, 3, 'Tindak Lanjut', 'tindaklanjut', '7974af09d758df51c4057ea9bd0c9029', 'tindaklanjut@mail.com', '123456789', 'userlogo4.png'),
(10, 4, 1, 'bpkad', 'bpkad', '8a7b37ac7e5d37ff06b1268ac9afffe4', 'bpkad@mail.com', '081215343', 'userlogo411.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_lhp`
--
ALTER TABLE `detail_lhp`
  ADD PRIMARY KEY (`id_detail_lhp`),
  ADD KEY `id_skpd` (`id_skpd`),
  ADD KEY `id_lhp` (`id_lhp`),
  ADD KEY `id_temuan` (`id_temuan`),
  ADD KEY `id_rekomendasi` (`id_rekomendasi`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rekomendasi` (`id_rekomendasi`);

--
-- Indexes for table `jenis_user`
--
ALTER TABLE `jenis_user`
  ADD PRIMARY KEY (`id_jenis_user`);

--
-- Indexes for table `lhp`
--
ALTER TABLE `lhp`
  ADD PRIMARY KEY (`id_lhp`),
  ADD KEY `id_skpd` (`id_skpd`);

--
-- Indexes for table `rekomendasi`
--
ALTER TABLE `rekomendasi`
  ADD PRIMARY KEY (`id_rekomendasi`),
  ADD KEY `id_temuan` (`id_temuan`),
  ADD KEY `id_lhp` (`id_lhp`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `id_skpd` (`id_skpd`);

--
-- Indexes for table `skpd`
--
ALTER TABLE `skpd`
  ADD PRIMARY KEY (`id_skpd`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `temuan`
--
ALTER TABLE `temuan`
  ADD PRIMARY KEY (`id_temuan`),
  ADD KEY `id_lhp` (`id_lhp`),
  ADD KEY `id_skpd` (`id_skpd`);

--
-- Indexes for table `tindak_lanjut`
--
ALTER TABLE `tindak_lanjut`
  ADD PRIMARY KEY (`id_tindak_lanjut`),
  ADD KEY `id_lhp` (`id_lhp`),
  ADD KEY `id_skpd` (`id_skpd`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_jenis_user` (`id_jenis_user`),
  ADD KEY `id_skpd` (`id_skpd`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_lhp`
--
ALTER TABLE `detail_lhp`
  MODIFY `id_detail_lhp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2079180282;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2146777736;

--
-- AUTO_INCREMENT for table `jenis_user`
--
ALTER TABLE `jenis_user`
  MODIFY `id_jenis_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lhp`
--
ALTER TABLE `lhp`
  MODIFY `id_lhp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2085983933;

--
-- AUTO_INCREMENT for table `rekomendasi`
--
ALTER TABLE `rekomendasi`
  MODIFY `id_rekomendasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2114979894;

--
-- AUTO_INCREMENT for table `skpd`
--
ALTER TABLE `skpd`
  MODIFY `id_skpd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `temuan`
--
ALTER TABLE `temuan`
  MODIFY `id_temuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1881803502;

--
-- AUTO_INCREMENT for table `tindak_lanjut`
--
ALTER TABLE `tindak_lanjut`
  MODIFY `id_tindak_lanjut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1912318324;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_lhp`
--
ALTER TABLE `detail_lhp`
  ADD CONSTRAINT `detail_lhp_ibfk_1` FOREIGN KEY (`id_skpd`) REFERENCES `skpd` (`id_skpd`),
  ADD CONSTRAINT `detail_lhp_ibfk_2` FOREIGN KEY (`id_lhp`) REFERENCES `lhp` (`id_lhp`),
  ADD CONSTRAINT `detail_lhp_ibfk_3` FOREIGN KEY (`id_temuan`) REFERENCES `temuan` (`id_temuan`),
  ADD CONSTRAINT `detail_lhp_ibfk_4` FOREIGN KEY (`id_rekomendasi`) REFERENCES `rekomendasi` (`id_rekomendasi`);

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`id_rekomendasi`) REFERENCES `rekomendasi` (`id_rekomendasi`);

--
-- Constraints for table `lhp`
--
ALTER TABLE `lhp`
  ADD CONSTRAINT `lhp_ibfk_1` FOREIGN KEY (`id_skpd`) REFERENCES `skpd` (`id_skpd`);

--
-- Constraints for table `rekomendasi`
--
ALTER TABLE `rekomendasi`
  ADD CONSTRAINT `rekomendasi_ibfk_1` FOREIGN KEY (`id_temuan`) REFERENCES `temuan` (`id_temuan`),
  ADD CONSTRAINT `rekomendasi_ibfk_2` FOREIGN KEY (`id_lhp`) REFERENCES `lhp` (`id_lhp`),
  ADD CONSTRAINT `rekomendasi_ibfk_3` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`),
  ADD CONSTRAINT `rekomendasi_ibfk_4` FOREIGN KEY (`id_skpd`) REFERENCES `skpd` (`id_skpd`);

--
-- Constraints for table `temuan`
--
ALTER TABLE `temuan`
  ADD CONSTRAINT `temuan_ibfk_1` FOREIGN KEY (`id_lhp`) REFERENCES `lhp` (`id_lhp`),
  ADD CONSTRAINT `temuan_ibfk_2` FOREIGN KEY (`id_skpd`) REFERENCES `skpd` (`id_skpd`);

--
-- Constraints for table `tindak_lanjut`
--
ALTER TABLE `tindak_lanjut`
  ADD CONSTRAINT `tindak_lanjut_ibfk_1` FOREIGN KEY (`id_skpd`) REFERENCES `skpd` (`id_skpd`),
  ADD CONSTRAINT `tindak_lanjut_ibfk_2` FOREIGN KEY (`id_lhp`) REFERENCES `lhp` (`id_lhp`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_jenis_user`) REFERENCES `jenis_user` (`id_jenis_user`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_skpd`) REFERENCES `skpd` (`id_skpd`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
