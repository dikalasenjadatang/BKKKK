-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2024 at 06:28 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_konseling`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id_user` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pa` enum('Y','N') NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`id_user`, `nama`, `email`, `pa`, `status`) VALUES
('G000000001', 'Administrator', 'admin@mail.com', 'N', 'Y'),
('G000000002', 'Zalma Afriadeni', 'zalma@mail.com', 'N', 'N'),
('G000000019', 'Akun Baru', 'akun@gmil.com', 'Y', 'Y'),
('G000000021', 'test', 'test@gmail.com', 'Y', 'N'),
('G000000024', 'Guru baru daftar', 'gurubaru@gmail.com', 'N', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jurusan`
--

CREATE TABLE `tb_jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(30) NOT NULL,
  `singkatan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jurusan`
--

INSERT INTO `tb_jurusan` (`id_jurusan`, `nama_jurusan`, `singkatan`) VALUES
(1, 'Teknik Komputer & Jaringan', 'TKJ'),
(4, 'Broadcasting', 'BC');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `id_kelompok` enum('1','2') NOT NULL DEFAULT '1',
  `nama_kategori` varchar(100) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `id_kelompok`, `nama_kategori`, `keterangan`) VALUES
(4, '1', 'Disiplin Dalam PBM', 'Menyangkut Segala Kegiatan Siswa Dalam PBM');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(10) NOT NULL,
  `id_guru` varchar(20) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `nama_kelas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `id_guru`, `id_jurusan`, `nama_kelas`) VALUES
(14, '', 1, 'XII TKJ 1'),
(15, '', 1, 'XII TKJ 2'),
(16, '', 4, 'X BC 1'),
(17, 'G000000019', 4, 'X BC 3');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ortu`
--

CREATE TABLE `tb_ortu` (
  `id_ortu` varchar(20) NOT NULL,
  `nama_ortu` varchar(50) NOT NULL,
  `email_ortu` varchar(50) NOT NULL,
  `telepon` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_ortu`
--

INSERT INTO `tb_ortu` (`id_ortu`, `nama_ortu`, `email_ortu`, `telepon`) VALUES
('O000000005', 'ortu', 'ortu@mail.com', '+6285244779990'),
('O000000008', 'Baru', 'rahmatafriyanton@gmail.com', '+6282268882318'),
('O000000011', 'Orang Tua Baru', 'res@mail.com', '+6287777777777'),
('O000000012', 'Test', '', '+6299999999999'),
('O000000013', 'Ortu Vikri', 'hafizulfadli11@gmail.com', '+6282666522442'),
('O000000015', 'Testing', 'wwa@mail.com', '+628234567890'),
('O000000018', 'Ortu Zab', 'zabrimal24@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_panggilan_ortu`
--

CREATE TABLE `tb_panggilan_ortu` (
  `id_panggilan` int(11) NOT NULL,
  `id_ortu` varchar(20) NOT NULL,
  `id_siswa` varchar(20) NOT NULL,
  `tanggal_panggil` date NOT NULL,
  `tanggal_hadir` date NOT NULL,
  `no_panggilan` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status_panggilan` enum('1','2','3') NOT NULL DEFAULT '1',
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_panggilan_ortu`
--

INSERT INTO `tb_panggilan_ortu` (`id_panggilan`, `id_ortu`, `id_siswa`, `tanggal_panggil`, `tanggal_hadir`, `no_panggilan`, `keterangan`, `status_panggilan`, `aktif`) VALUES
(14, 'O000000008', 'S000000001', '2018-11-09', '2018-11-09', 1, 'qeg qkj', '3', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggaran`
--

CREATE TABLE `tb_pelanggaran` (
  `id_pelanggaran` int(11) NOT NULL,
  `id_tata_tertib` int(11) NOT NULL,
  `id_siswa` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi_pelanggaran` varchar(255) NOT NULL,
  `tindakan` varchar(255) NOT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pelanggaran`
--

INSERT INTO `tb_pelanggaran` (`id_pelanggaran`, `id_tata_tertib`, `id_siswa`, `tanggal`, `deskripsi_pelanggaran`, `tindakan`, `status`) VALUES
(2, 7, 'S000000002', '2018-10-12', 'Hafizul berjualan dikelas', 'Barang dagangan disita oleh guru BK', '2'),
(3, 8, 'S000000001', '2018-10-08', 'iy li ugli g', 'hfk yfk', '1'),
(4, 8, 'S000000001', '2018-10-13', 'jgkjmn', 'jkjhv', '1'),
(6, 8, 'S000000001', '2018-10-10', 'i ougb,km ', 'kufkij', '1'),
(7, 7, 'S000000001', '2018-10-22', 'mjgctkuxtcfhn', 'jtmxjucfhnv', '1'),
(8, 8, 'S000000001', '2018-11-11', 'wdugwudgwbdwd', 'wdgw wug kw', '1'),
(9, 8, 'S000000001', '2018-11-11', 'wdugwudgwbdwd', 'wdgw wug kw', '1'),
(10, 8, 'S000000001', '2018-11-11', 'wdugwudgwbdwd', 'wdgw wug kw', '1'),
(11, 8, 'S000000001', '2018-11-11', 'wdugwudgwbdwd', 'wdgw wug kw', '1'),
(12, 8, 'S000000001', '2018-11-11', 'wdugwudgwbdwd', 'wdgw wug kw', '1'),
(13, 8, 'S000000001', '2018-11-11', 'wdugwudgwbdwd', 'wdgw wug kw', '1'),
(14, 8, 'S000000005', '2018-11-11', 'jgkkuggugvm ', 'jkg uliukvhm ', '2'),
(15, 8, 'S000000005', '2018-11-11', 'jgkkuggugvm ', 'jkg uliukvhm ', '2'),
(16, 7, 'S000000001', '2018-11-11', 'testing sms', 'wh wfwlkfw', '1'),
(17, 7, 'S000000001', '2018-11-11', 'testing sms', 'wh wfwlkfw', '1'),
(18, 7, 'S000000001', '2018-11-11', 'testing sms', 'wh wfwlkfw', '1'),
(19, 7, 'S000000001', '2018-11-10', 'fkjbva fke', 'e we ', '1'),
(20, 8, 'S000000001', '2018-11-12', 'wjeh qfwkegfw,e', 'r hwrwhdwkfkjw', '1'),
(21, 8, 'S000000001', '2018-11-14', 'Datang terlambat', 'suruh pulang', '1'),
(22, 7, 'S000000001', '2022-09-02', 'aaasa', 'sasas', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_user` varchar(20) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_ortu` varchar(12) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` enum('1','2','3') NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_user`, `id_kelas`, `id_ortu`, `nama_siswa`, `email`, `status`) VALUES
('S000000001', 15, 'O000000008', 'Rahmat Afriyanton', 'rahmatafriyanton@gmail.com', '1'),
('S000000002', 15, 'O000000008', 'Hafizul Fadly', 'hafiz@mail.com', '1'),
('S000000005', 15, 'O000000011', 'Vickri Pratama Arfa', 'vikri@mail.com', '1'),
('S000000010', 16, 'O000000013', 'Anak BC', 'anak@mail.com', '1'),
('S000000012', 14, 'O000000018', 'Zabrimal', 'zabrimal@mail.com', '1'),
('S000000021', 0, '', 'Siswa Baru', 'siswa@mail.com', '3');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tata_tertib`
--

CREATE TABLE `tb_tata_tertib` (
  `id_tata_tertib` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_tata_tertib` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `hukuman` varchar(255) NOT NULL,
  `level` enum('1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tata_tertib`
--

INSERT INTO `tb_tata_tertib` (`id_tata_tertib`, `id_kategori`, `nama_tata_tertib`, `deskripsi`, `hukuman`, `level`) VALUES
(7, 4, 'Peserta Didik Dilarang Berjualan Dikelas', 'Peserta Didik Dilarang Berjualan Dikelas dan dilingkungan sekolah', 'Diproses oleh guru yang menemukan dan dipanggil orang tua melalui wali kelas', '1'),
(8, 4, 'Datang Terlambat', 'kej flseglesghlaisfh na .f.akjwf', 'Disuruh Pulang', '2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('1','2','3','4') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `password`, `level`) VALUES
('G000000001', 'b60d29f81ed3c7f339b78ff446206158', '1'),
('G000000002', '5f57fffec89760747b20c956090a81db', '2'),
('G000000019', 'e10adc3949ba59abbe56e057f20f883e', '2'),
('G000000021', '4906c0919d26ca6e5a972a89b1f8b769', '2'),
('G000000024', 'e10adc3949ba59abbe56e057f20f883e', '2'),
('O000000002', 'f38b5ebaeac2adad94ef953f9f9ca6d8', '3'),
('O000000005', '101567da31c7a1cc990c2a4f4c1f3210', '3'),
('O000000008', 'e10adc3949ba59abbe56e057f20f883e', '3'),
('O000000011', '101567da31c7a1cc990c2a4f4c1f3210', '3'),
('O000000012', '101567da31c7a1cc990c2a4f4c1f3210', '3'),
('O000000013', '101567da31c7a1cc990c2a4f4c1f3210', '3'),
('O000000015', '101567da31c7a1cc990c2a4f4c1f3210', '3'),
('O000000018', '101567da31c7a1cc990c2a4f4c1f3210', '3'),
('S000000001', '875c35775898c0e35d5c2c71d5c33308', '4'),
('S000000002', '101567da31c7a1cc990c2a4f4c1f3210', '4'),
('S000000005', '101567da31c7a1cc990c2a4f4c1f3210', '4'),
('S000000010', '101567da31c7a1cc990c2a4f4c1f3210', '4'),
('S000000012', '101567da31c7a1cc990c2a4f4c1f3210', '4'),
('S000000021', 'e10adc3949ba59abbe56e057f20f883e', '4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD UNIQUE KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indexes for table `tb_ortu`
--
ALTER TABLE `tb_ortu`
  ADD PRIMARY KEY (`id_ortu`),
  ADD UNIQUE KEY `id_user` (`id_ortu`);

--
-- Indexes for table `tb_panggilan_ortu`
--
ALTER TABLE `tb_panggilan_ortu`
  ADD PRIMARY KEY (`id_panggilan`);

--
-- Indexes for table `tb_pelanggaran`
--
ALTER TABLE `tb_pelanggaran`
  ADD PRIMARY KEY (`id_pelanggaran`),
  ADD KEY `id_tata_tertib` (`id_tata_tertib`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tb_tata_tertib`
--
ALTER TABLE `tb_tata_tertib`
  ADD PRIMARY KEY (`id_tata_tertib`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_panggilan_ortu`
--
ALTER TABLE `tb_panggilan_ortu`
  MODIFY `id_panggilan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_pelanggaran`
--
ALTER TABLE `tb_pelanggaran`
  MODIFY `id_pelanggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_tata_tertib`
--
ALTER TABLE `tb_tata_tertib`
  MODIFY `id_tata_tertib` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD CONSTRAINT `tb_guru_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD CONSTRAINT `tb_kelas_ibfk_1` FOREIGN KEY (`id_jurusan`) REFERENCES `tb_jurusan` (`id_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_ortu`
--
ALTER TABLE `tb_ortu`
  ADD CONSTRAINT `tb_ortu_ibfk_1` FOREIGN KEY (`id_ortu`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pelanggaran`
--
ALTER TABLE `tb_pelanggaran`
  ADD CONSTRAINT `tb_pelanggaran_ibfk_5` FOREIGN KEY (`id_tata_tertib`) REFERENCES `tb_tata_tertib` (`id_tata_tertib`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pelanggaran_ibfk_6` FOREIGN KEY (`id_siswa`) REFERENCES `tb_siswa` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD CONSTRAINT `tb_siswa_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_tata_tertib`
--
ALTER TABLE `tb_tata_tertib`
  ADD CONSTRAINT `tb_tata_tertib_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
