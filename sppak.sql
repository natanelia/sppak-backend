-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1build0.15.04.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 04, 2016 at 08:19 PM
-- Server version: 5.6.28-0ubuntu0.15.04.1
-- PHP Version: 5.6.4-4ubuntu6.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sppak`
--

-- --------------------------------------------------------

--
-- Table structure for table `anak`
--

CREATE TABLE IF NOT EXISTS `anak` (
`id` bigint(20) unsigned NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenisKelamin` enum('laki-laki','perempuan') NOT NULL DEFAULT 'laki-laki',
  `golonganDarah` enum('A','B','AB','O') NOT NULL,
  `kotaLahirId` int(11) NOT NULL,
  `waktuLahir` datetime NOT NULL,
  `jenisLahir` varchar(255) NOT NULL,
  `anakKe` int(11) NOT NULL,
  `penolongKelahiran` varchar(255) NOT NULL,
  `berat` int(11) NOT NULL,
  `panjang` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3279012810930002 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anak`
--

INSERT INTO `anak` (`id`, `nama`, `jenisKelamin`, `golonganDarah`, `kotaLahirId`, `waktuLahir`, `jenisLahir`, `anakKe`, `penolongKelahiran`, `berat`, `panjang`) VALUES
(3279010710950002, 'Octavianus Marcel Harjono', 'laki-laki', 'O', 37, '1995-10-07 14:02:00', 'Tunggal', 2, 'Dokter', 3, 60),
(3279012810930001, 'Hellen Haryono', 'laki-laki', 'O', 37, '1993-10-28 18:32:00', 'Tunggal', 1, 'Dokter', 4, 50);

-- --------------------------------------------------------

--
-- Table structure for table `instansiKesehatan`
--

CREATE TABLE IF NOT EXISTS `instansiKesehatan` (
`id` bigint(20) unsigned NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis` enum('rumahSakit','klinik') NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kotaId` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instansiKesehatan`
--

INSERT INTO `instansiKesehatan` (`id`, `nama`, `jenis`, `alamat`, `kotaId`, `created_at`, `updated_at`) VALUES
(1, 'RS Al Islam', 'rumahSakit', 'Jl. Soekarno Hatta No 644, Bandung', 32, '2016-04-02 10:00:00', '2016-04-02 10:00:00'),
(2, 'RS Bersalin Astana Anyar', 'rumahSakit', 'Jl. Astana Anyar No 224, Bandung', 32, '2016-04-03 02:23:48', '2016-04-03 02:23:48'),
(4, 'RS Bersalin Emma Poeradiredja', 'rumahSakit', 'Jl. Sumatera No 46-48, Bandung', 32, '2016-04-03 02:33:41', '2016-04-03 02:33:41'),
(5, 'RS Bersalin Limijati', 'rumahSakit', 'Jl. Laks L. RE Martadinata No 39, Bandung', 32, '2016-04-03 02:33:41', '2016-04-03 02:33:41'),
(6, 'RS Ibu dan Anak Sukajadi', 'rumahSakit', 'Jl. Sukajadi No 149, Bandung', 32, '2016-04-03 02:33:41', '2016-04-03 02:33:41'),
(7, 'RS Ibu dan Anak Hermina Pasteur', 'rumahSakit', 'Jl. Dr Djundjunan No 107, Bandung', 32, '2016-04-03 02:33:41', '2016-04-03 02:33:41'),
(8, 'RS Santo Borromeus', 'rumahSakit', 'Jl. Ir. H. Juanda No 100, Bandung', 32, '2016-04-03 02:33:41', '2016-04-03 02:33:41'),
(9, 'RS Bhayangkara Sartika Asih', 'rumahSakit', 'Jl. Moh Toha No 369, Bandung', 32, '2016-04-03 02:33:41', '2016-04-03 02:33:41'),
(10, 'RS Bina Sehat', 'rumahSakit', 'Jl. Raya Dayeuhkolot No 325, Bandung', 32, '2016-04-03 02:33:41', '2016-04-03 02:33:41'),
(11, 'RS Cikalongwetan', 'rumahSakit', 'Jl. Cikalong Wetan, Bandung', 32, '2016-04-03 02:33:41', '2016-04-03 02:33:41'),
(12, 'RS Dr Salamun', 'rumahSakit', 'Jl. Ciumbuleuit No 203, Bandung', 32, '2016-04-03 02:33:41', '2016-04-03 02:33:41'),
(13, 'RS Immanuel', 'rumahSakit', 'Jl. Kopo No 161, Bandung', 32, '2016-04-03 02:33:41', '2016-04-03 02:33:41'),
(14, 'RS Bhayangkara Sartika Asih', 'rumahSakit', 'Jl. Moh Toha No 369, Bandung', 32, '2016-04-03 02:33:41', '2016-04-03 02:33:41'),
(15, 'RS Kebonjati', 'rumahSakit', 'Jl. Kebonjati No 152, Bandung', 32, '2016-04-03 02:33:41', '2016-04-03 02:33:41'),
(16, 'RS Pindad', 'rumahSakit', 'Jl. Gatot Subroto No 517, Bandung', 32, '2016-04-03 02:33:41', '2016-04-03 02:33:41'),
(17, 'RS Rajawali', 'rumahSakit', 'Jl. Rajawali No 73, Bandung', 32, '2016-04-03 02:33:41', '2016-04-03 02:33:41'),
(18, 'RS Santo Yusup', 'rumahSakit', 'Jl. Cikutra No 7, Bandung', 32, '2016-04-03 02:33:41', '2016-04-03 02:33:41'),
(19, 'RS Umum Pusat Hasan Sadikin', 'rumahSakit', 'Jl. Pasteur No 38, Bandung', 32, '2016-04-03 02:33:41', '2016-04-03 02:33:41'),
(33, 'RS Pindad', 'rumahSakit', 'Jl. Gatot Subroto No 517, Bandung', 32, '2016-04-03 02:34:23', '2016-04-03 02:34:23'),
(34, 'RS Rajawali', 'rumahSakit', 'Jl. Rajawali No 73, Bandung', 32, '2016-04-03 02:34:23', '2016-04-03 02:34:23'),
(35, 'RS Santo Yusup', 'rumahSakit', 'Jl. Cikutra No 7, Bandung', 32, '2016-04-03 02:34:23', '2016-04-03 02:34:23'),
(36, 'RS Umum Pusat Hasan Sadikin', 'rumahSakit', 'Jl. Pasteur No 38, Bandung', 32, '2016-04-03 02:34:23', '2016-04-03 02:34:23'),
(37, 'RS Advent', 'rumahSakit', 'Jl. Cihampelas No 161, Bandung', 32, '2016-04-03 02:34:23', '2016-04-03 02:34:23'),
(38, 'Gegerkalong Clinics', 'klinik', 'Jl. Gegerkalong Hilir No 52, Bandung', 32, '2016-04-03 02:39:45', '2016-04-03 02:39:45'),
(39, 'Karapitan Sehat', 'klinik', 'Jl. Karapitan No 60, Bandung', 32, '2016-04-03 02:39:45', '2016-04-03 02:39:45'),
(40, 'Klinik Anugrah', 'klinik', 'Jl. Lengkong Besar No 117, Bandung', 32, '2016-04-03 02:39:45', '2016-04-03 02:39:45'),
(41, 'Klinik Babakan Ciparay', 'klinik', 'Jl. Babakan Ciparay Blk No 196, Bandung', 32, '2016-04-03 02:39:45', '2016-04-03 02:39:45'),
(42, 'Klinik Caringin', 'klinik', 'Jl. Babakan Ciparay No 249, Bandung', 32, '2016-04-03 02:39:45', '2016-04-03 02:39:45'),
(43, 'Klinik Chandra Sari', 'klinik', 'Jl. Kiaracondong No 206, Bandung', 32, '2016-04-03 02:39:45', '2016-04-03 02:39:45'),
(44, 'Klinik Grahita Husada', 'klinik', 'Jl. Kopo No 304, Bandung', 32, '2016-04-03 02:39:45', '2016-04-03 02:39:45'),
(45, 'Klinik Harapan Sehat', 'klinik', 'Jl. Jend. Gatot Subroto No 219, Bandung', 32, '2016-04-03 02:39:45', '2016-04-03 02:39:45');

-- --------------------------------------------------------

--
-- Table structure for table `kelahiran`
--

CREATE TABLE IF NOT EXISTS `kelahiran` (
`id` bigint(20) unsigned NOT NULL,
  `anakId` bigint(20) unsigned NOT NULL,
  `kelurahanId` int(11) DEFAULT NULL,
  `instansiKesehatanId` bigint(20) unsigned DEFAULT NULL,
  `kartuKeluargaId` varchar(16) DEFAULT NULL,
  `aktaNikahId` varchar(255) DEFAULT NULL,
  `ibuId` varchar(16) DEFAULT NULL,
  `ayahId` varchar(16) DEFAULT NULL,
  `saksiSatuId` bigint(20) unsigned DEFAULT NULL,
  `saksiDuaId` bigint(20) unsigned DEFAULT NULL,
  `pemohonId` varchar(16) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `verifikasiSaksi1` tinyint(1) NOT NULL DEFAULT '0',
  `verifikasiSaksi2` tinyint(1) NOT NULL DEFAULT '0',
  `verifikasiInstansiKesehatan` tinyint(1) NOT NULL DEFAULT '0',
  `verifikasiLurah` tinyint(1) NOT NULL DEFAULT '0',
  `verifikasiAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `waktuCetakTerakhir` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_pengguna_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_03_29_134340_create_anak_table', 1),
('2016_03_29_134602_create_instansi_kesehatan_table', 1),
('2016_03_29_135306_create_saksi_table', 1),
('2016_03_29_135654_create_kelahiran_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE IF NOT EXISTS `pengguna` (
`id` bigint(20) unsigned NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userable_id` int(11) NOT NULL,
  `userable_type` enum('Penduduk','Kelurahan','InstansiKesehatan','Pegawai') NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `email`, `password`, `userable_id`, `userable_type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'natanelia7@gmail.com', '$2y$10$OJCs50cEdAwsnGlfvbKz..Bsu27XH2SOjYlagOTE0EwZeGd/1TkAq', 2147483647, '', NULL, '2016-03-31 00:52:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `saksi`
--

CREATE TABLE IF NOT EXISTS `saksi` (
`id` bigint(20) unsigned NOT NULL,
  `pendudukId` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anak`
--
ALTER TABLE `anak`
 ADD PRIMARY KEY (`id`), ADD KEY `anak_nama_index` (`nama`), ADD KEY `anak_kotalahirid_foreign` (`kotaLahirId`);

--
-- Indexes for table `instansiKesehatan`
--
ALTER TABLE `instansiKesehatan`
 ADD PRIMARY KEY (`id`), ADD KEY `instansikesehatan_nama_index` (`nama`);

--
-- Indexes for table `kelahiran`
--
ALTER TABLE `kelahiran`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `kelahiran_anakid_unique` (`anakId`), ADD KEY `kelahiran_kelurahanid_foreign` (`kelurahanId`), ADD KEY `kelahiran_instansikesehatanid_foreign` (`instansiKesehatanId`), ADD KEY `kelahiran_kartukeluargaid_foreign` (`kartuKeluargaId`), ADD KEY `kelahiran_ibuid_foreign` (`ibuId`), ADD KEY `kelahiran_ayahid_foreign` (`ayahId`), ADD KEY `kelahiran_saksisatuid_foreign` (`saksiSatuId`), ADD KEY `kelahiran_saksiduaid_foreign` (`saksiDuaId`), ADD KEY `kelahiran_pemohonid_foreign` (`pemohonId`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
 ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `pengguna_email_unique` (`email`);

--
-- Indexes for table `saksi`
--
ALTER TABLE `saksi`
 ADD PRIMARY KEY (`id`), ADD KEY `saksi_pendudukid_foreign` (`pendudukId`), ADD KEY `saksi_token_index` (`token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anak`
--
ALTER TABLE `anak`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3279012810930002;
--
-- AUTO_INCREMENT for table `instansiKesehatan`
--
ALTER TABLE `instansiKesehatan`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `kelahiran`
--
ALTER TABLE `kelahiran`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `saksi`
--
ALTER TABLE `saksi`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `anak`
--
ALTER TABLE `anak`
ADD CONSTRAINT `anak_kotalahirid_foreign` FOREIGN KEY (`kotaLahirId`) REFERENCES `db_ppl_core`.`kota` (`id`);

--
-- Constraints for table `kelahiran`
--
ALTER TABLE `kelahiran`
ADD CONSTRAINT `kelahiran_anakid_foreign` FOREIGN KEY (`anakId`) REFERENCES `anak` (`id`),
ADD CONSTRAINT `kelahiran_ayahid_foreign` FOREIGN KEY (`ayahId`) REFERENCES `db_ppl_core`.`penduduk` (`id`),
ADD CONSTRAINT `kelahiran_ibuid_foreign` FOREIGN KEY (`ibuId`) REFERENCES `db_ppl_core`.`penduduk` (`id`),
ADD CONSTRAINT `kelahiran_instansikesehatanid_foreign` FOREIGN KEY (`instansiKesehatanId`) REFERENCES `instansiKesehatan` (`id`),
ADD CONSTRAINT `kelahiran_kartukeluargaid_foreign` FOREIGN KEY (`kartuKeluargaId`) REFERENCES `db_ppl_core`.`keluarga` (`id`),
ADD CONSTRAINT `kelahiran_kelurahanid_foreign` FOREIGN KEY (`kelurahanId`) REFERENCES `db_ppl_core`.`kelurahan` (`id`),
ADD CONSTRAINT `kelahiran_pemohonid_foreign` FOREIGN KEY (`pemohonId`) REFERENCES `db_ppl_core`.`penduduk` (`id`),
ADD CONSTRAINT `kelahiran_saksiduaid_foreign` FOREIGN KEY (`saksiDuaId`) REFERENCES `saksi` (`id`),
ADD CONSTRAINT `kelahiran_saksisatuid_foreign` FOREIGN KEY (`saksiSatuId`) REFERENCES `saksi` (`id`);

--
-- Constraints for table `saksi`
--
ALTER TABLE `saksi`
ADD CONSTRAINT `saksi_pendudukid_foreign` FOREIGN KEY (`pendudukId`) REFERENCES `db_ppl_core`.`penduduk` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
