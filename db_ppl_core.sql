-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1build0.15.04.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 04, 2016 at 08:18 PM
-- Server version: 5.6.28-0ubuntu0.15.04.1
-- PHP Version: 5.6.4-4ubuntu6.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_ppl_core`
--

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE IF NOT EXISTS `jabatan` (
  `id` varchar(25) NOT NULL,
  `id_rumpun` varchar(25) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kualifikasi` enum('Pendidikan','Keahlian') NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `kode` varchar(25) NOT NULL,
  `nilai` int(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE IF NOT EXISTS `kecamatan` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat_kantor` varchar(255) NOT NULL,
  `id_pengurus` varchar(16) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `nama`, `alamat_kantor`, `id_pengurus`, `id_kota`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Malang Sekali', 'Jalan Tinombala 22', '3573041003950011', 37, '2016-03-31 14:48:51', NULL, 1),
(2, 'Cimenyan', 'Ap #342-9800 Lacus. Avenue', '3573041003950011', 4, '2016-05-15 01:34:01', NULL, 1),
(3, 'Cilengkrang', 'P.O. Box 821, 2745 Imperdiet Road', '3573041003950011', 4, '2015-09-22 20:08:18', NULL, 0),
(4, 'Bojongsoang', 'P.O. Box 774, 1602 Praesent St.', '3573041003950011', 4, '2015-08-29 09:28:27', NULL, 1),
(5, 'Margahayu', 'P.O. Box 910, 1246 Gravida Avenue', '3573041003950011', 4, '2016-12-01 14:28:03', NULL, 0),
(6, 'Margaasih', '4451 Blandit St.', '3573041003950011', 4, '2016-07-06 02:33:16', NULL, 1),
(7, 'Katapang', 'P.O. Box 197, 9689 Quis Road', '3573041003950011', 4, '2016-10-19 08:34:54', NULL, 0),
(8, 'Dayeuhkolot', '500-4547 Suspendisse Ave', '3573041003950011', 4, '2016-09-30 05:56:14', NULL, 0),
(9, 'Banjar', 'P.O. Box 494, 5114 Scelerisque Av.', '3573041003950011', 4, '2015-07-28 10:44:08', NULL, 1),
(10, 'Pameungpeuk', '732 Lacus. Rd.', '3573041003950011', 4, '2015-10-04 02:05:13', NULL, 0),
(11, 'Pangalengan', 'P.O. Box 654, 2684 Gravida. Av.', '3573041003950011', 4, '2015-05-06 12:08:31', NULL, 0),
(12, 'Arjasari', '4773 Nulla. Rd.', '3573041003950011', 4, '2015-10-31 19:00:30', NULL, 1),
(13, 'Cimaung', '538-4942 Sapien, St.', '3573041003950011', 4, '2016-05-13 14:55:11', NULL, 1),
(14, 'Cicalengka', 'Ap #627-2890 Nibh. Av.', '3573041003950011', 4, '2016-06-07 19:18:22', NULL, 1),
(15, 'Nagreg', 'P.O. Box 694, 2529 Sed Ave', '3573041003950011', 4, '2016-12-02 20:07:57', NULL, 1),
(16, 'Cikancung', 'P.O. Box 643, 1759 Nunc Road', '3573041003950011', 4, '2015-04-08 05:26:50', NULL, 0),
(17, 'Rancaekek', 'Ap #235-3584 A, Rd.', '3573041003950011', 4, '2015-07-16 01:36:05', NULL, 1),
(18, 'Ciparay', '763-1688 Amet, Road', '3573041003950011', 4, '2016-11-10 04:21:57', NULL, 0),
(19, 'Pacet', '5357 Sit St.', '3573041003950011', 4, '2015-06-21 23:34:12', NULL, 1),
(20, 'Kertasari', '8127 Leo. Ave', '3573041003950011', 4, '2016-04-08 19:01:51', NULL, 1),
(21, 'Baleendah', '976-2539 Et St.', '3573041003950011', 4, '2017-02-04 03:13:19', NULL, 0),
(22, 'Majalaya', 'P.O. Box 126, 4054 Mattis. Av.', '3573041003950011', 4, '2015-09-12 14:59:56', NULL, 0),
(23, 'Solokanjeruk', 'Ap #158-8629 Sem Road', '3573041003950011', 4, '2017-01-28 14:14:59', NULL, 0),
(24, 'Paseh', 'P.O. Box 431, 7116 Ipsum St.', '3573041003950011', 4, '2015-09-26 21:00:21', NULL, 0),
(25, 'Ibun', 'P.O. Box 609, 6707 Donec St.', '3573041003950011', 4, '2016-04-01 11:24:18', NULL, 0),
(26, 'Soreang', 'P.O. Box 553, 2066 Donec Ave', '3573041003950011', 4, '2017-01-04 14:41:40', NULL, 1),
(27, 'Pasirjambu', 'P.O. Box 855, 7052 Tristique Avenue', '3573041003950011', 4, '2016-01-21 02:26:17', NULL, 0),
(28, 'Ciwidey', 'P.O. Box 457, 7914 A, Avenue', '3573041003950011', 4, '2015-12-31 10:12:18', NULL, 1),
(29, 'Rancabali', 'Ap #724-7580 Orci. Ave', '3573041003950011', 4, '2016-04-05 07:32:43', NULL, 0),
(30, 'Cangkuang', '5536 Facilisis Rd.', '3573041003950011', 4, '2015-08-21 21:01:42', NULL, 0),
(31, 'Cileunyi', '4341 Bibendum. Rd.', '3573041003950011', 4, '2016-04-24 16:48:42', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `keluarga`
--

CREATE TABLE IF NOT EXISTS `keluarga` (
  `id` varchar(16) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `id_rt` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keluarga`
--

INSERT INTO `keluarga` (`id`, `alamat`, `id_rt`, `created_at`, `status`) VALUES
('1', 'Jalan Ciumbuleuit 51/155A', 1, '2016-03-31 14:50:42', 1),
('2', 'Baker Street 221B', 78, '2016-04-04 20:16:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kelurahan`
--

CREATE TABLE IF NOT EXISTS `kelurahan` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat_kantor` varchar(255) NOT NULL,
  `id_pengurus` varchar(16) NOT NULL,
  `id_kecamatan` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelurahan`
--

INSERT INTO `kelurahan` (`id`, `nama`, `alamat_kantor`, `id_pengurus`, `id_kecamatan`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Pisang Candi', 'Jalan Gelut 11', '3573041003950011', 1, '2016-03-31 14:49:17', NULL, 1),
(2, 'Sicilia', 'Ap #716-1262 Magna. Avenue', '3573041003950011', 7, '2016-10-07 03:12:05', NULL, 0),
(3, 'RS', 'Ap #703-4534 Malesuada Ave', '3573041003950011', 28, '2015-07-09 10:21:33', NULL, 1),
(4, 'WB', '3732 Amet, St.', '3573041003950011', 4, '2016-08-19 13:47:20', NULL, 1),
(5, 'Abruzzo', '782-8481 In, Avenue', '3573041003950011', 18, '2016-01-26 06:12:03', NULL, 1),
(6, 'Minas Gerais', 'P.O. Box 364, 6366 Turpis St.', '3573041003950011', 14, '2017-01-15 12:39:18', NULL, 1),
(7, 'G', 'Ap #606-2381 Dolor Rd.', '3573041003950011', 13, '2015-10-06 12:09:22', NULL, 1),
(8, 'Wie', 'P.O. Box 717, 754 Consequat Ave', '3573041003950011', 22, '2017-02-03 07:11:05', NULL, 1),
(9, 'BK', 'P.O. Box 157, 2774 Vel Avenue', '3573041003950011', 30, '2015-04-21 00:13:15', NULL, 0),
(10, 'Iowa', 'P.O. Box 810, 3212 Metus. Ave', '3573041003950011', 19, '2015-10-23 03:07:20', NULL, 0),
(11, 'AB', 'Ap #505-2244 Vestibulum Ave', '3573041003950011', 20, '2016-07-17 08:56:04', NULL, 1),
(12, 'North Island', 'P.O. Box 545, 8778 Elit, Road', '3573041003950011', 30, '2016-07-20 03:14:54', NULL, 1),
(13, 'Limburg', 'Ap #840-3076 Massa. St.', '3573041003950011', 18, '2015-05-14 16:55:23', NULL, 0),
(14, 'Leinster', 'P.O. Box 917, 1009 Lobortis St.', '3573041003950011', 30, '2016-05-26 10:47:55', NULL, 0),
(15, 'Ontario', '281-4781 Cum Avenue', '3573041003950011', 16, '2015-04-17 19:01:43', NULL, 0),
(16, 'Östergötlands län', 'Ap #495-8330 Sagittis Ave', '3573041003950011', 6, '2017-02-24 17:54:11', NULL, 0),
(17, 'GA', '624-2520 Tincidunt Av.', '3573041003950011', 11, '2016-11-08 19:59:26', NULL, 0),
(18, 'HH', 'P.O. Box 512, 9963 Enim Rd.', '3573041003950011', 25, '2016-07-30 15:27:21', NULL, 1),
(19, 'Buteshire', 'P.O. Box 865, 2844 Eget Av.', '3573041003950011', 22, '2016-12-31 21:32:53', NULL, 0),
(20, 'Lanarkshire', 'Ap #970-1739 Ornare. Road', '3573041003950011', 31, '2015-05-24 19:23:45', NULL, 0),
(21, 'WA', 'P.O. Box 184, 2333 Ipsum Road', '3573041003950011', 16, '2016-02-19 04:08:53', NULL, 1),
(22, 'RJ', 'P.O. Box 808, 9501 Mauris Ave', '3573041003950011', 22, '2016-05-04 17:22:07', NULL, 1),
(23, 'Wie', 'Ap #600-5377 Luctus Road', '3573041003950011', 12, '2016-09-24 08:32:55', NULL, 0),
(24, 'SI', 'Ap #969-1625 Suspendisse Road', '3573041003950011', 29, '2016-09-15 17:36:13', NULL, 1),
(25, 'Sardegna', '6282 Tellus. St.', '3573041003950011', 27, '2017-03-29 00:08:26', NULL, 0),
(26, 'Hamburg', 'P.O. Box 140, 3731 Eu Avenue', '3573041003950011', 13, '2016-07-18 05:52:49', NULL, 1),
(27, 'Overijssel', '3929 Quam Street', '3573041003950011', 10, '2015-06-10 12:58:13', NULL, 0),
(28, 'North Island', 'P.O. Box 486, 6071 Proin Avenue', '3573041003950011', 12, '2015-08-25 02:11:31', NULL, 1),
(29, 'Gl', '611-2661 Pede. St.', '3573041003950011', 12, '2016-07-19 09:37:33', NULL, 0),
(30, 'Jönköpings län', '786-2126 Vestibulum Rd.', '3573041003950011', 20, '2015-11-30 10:29:11', NULL, 0),
(31, 'SJ', '409-2625 Mauris Street', '3573041003950011', 11, '2017-02-24 04:29:00', NULL, 1),
(32, 'Quebec', '9518 Dui Avenue', '3573041003950011', 11, '2016-04-15 23:43:54', NULL, 0),
(33, 'South Australia', '5845 Lectus Avenue', '3573041003950011', 2, '2017-03-27 17:04:49', NULL, 1),
(34, 'Kano', 'P.O. Box 403, 3520 Massa Avenue', '3573041003950011', 5, '2016-06-08 21:33:28', NULL, 0),
(35, 'NI', '1791 Condimentum. Rd.', '3573041003950011', 15, '2015-06-16 02:00:19', NULL, 0),
(36, 'Basilicata', 'P.O. Box 152, 8380 Dolor, Street', '3573041003950011', 14, '2017-01-17 17:16:28', NULL, 0),
(37, 'DE', '917-1580 Mauris St.', '3573041003950011', 13, '2016-03-05 10:39:17', NULL, 1),
(38, 'Zl', '927-205 Gravida Road', '3573041003950011', 2, '2015-07-13 07:24:48', NULL, 0),
(39, 'QC', 'P.O. Box 435, 6413 Velit Rd.', '3573041003950011', 16, '2016-08-12 22:54:04', NULL, 1),
(40, 'WV', '4399 Litora St.', '3573041003950011', 11, '2016-10-05 10:27:56', NULL, 1),
(41, 'Ontario', 'P.O. Box 346, 4280 Eu St.', '3573041003950011', 16, '2015-07-03 12:21:09', NULL, 0),
(42, 'TN', 'Ap #714-6585 Est Street', '3573041003950011', 29, '2016-11-08 11:44:08', NULL, 0),
(43, 'Kayseri', '4067 Mauris Av.', '3573041003950011', 22, '2016-10-04 19:20:40', NULL, 0),
(44, 'AN', 'Ap #881-3128 Lorem Rd.', '3573041003950011', 17, '2015-10-03 12:19:31', NULL, 0),
(45, 'Waals-Brabant', 'P.O. Box 960, 6341 Malesuada St.', '3573041003950011', 19, '2015-08-13 11:45:07', NULL, 1),
(46, 'Zuid Holland', '707-7402 Odio St.', '3573041003950011', 27, '2015-04-25 12:37:54', NULL, 1),
(47, 'Antwerpen', '154-5318 Bibendum. St.', '3573041003950011', 31, '2016-11-28 16:54:00', NULL, 1),
(48, 'Akwa Ibom', 'Ap #852-6902 Lobortis St.', '3573041003950011', 29, '2016-12-04 11:12:19', NULL, 1),
(49, 'Metropolitana de Santiago', '6747 Ridiculus Rd.', '3573041003950011', 29, '2017-03-29 00:24:51', NULL, 0),
(50, 'Andalucía', 'P.O. Box 872, 2754 Arcu Rd.', '3573041003950011', 27, '2016-12-30 11:21:43', NULL, 1),
(51, 'SJ', '4699 Dictum Rd.', '3573041003950011', 23, '2015-06-21 10:22:10', NULL, 1),
(52, 'BE', 'P.O. Box 393, 5255 Bibendum Av.', '3573041003950011', 31, '2015-04-11 09:52:48', NULL, 1),
(53, 'VA', 'Ap #889-8471 Lacus. Avenue', '3573041003950011', 1, '2016-12-30 17:05:24', NULL, 0),
(54, 'Piemonte', 'P.O. Box 740, 8105 Vestibulum. Av.', '3573041003950011', 9, '2015-06-29 08:49:37', NULL, 1),
(55, 'Mazowieckie', '480-665 Id Rd.', '3573041003950011', 1, '2016-06-16 21:11:38', NULL, 1),
(56, 'Bur', '782-6887 Nisi Ave', '3573041003950011', 28, '2015-04-29 18:36:25', NULL, 1),
(57, 'IL', 'P.O. Box 252, 4628 Dictum Rd.', '3573041003950011', 10, '2015-07-26 12:49:26', NULL, 0),
(58, 'NO', '3918 Eros. Rd.', '3573041003950011', 30, '2016-08-29 14:38:57', NULL, 1),
(59, 'North Island', 'P.O. Box 951, 969 Fusce Road', '3573041003950011', 23, '2017-02-03 06:29:15', NULL, 0),
(60, 'NSW', 'Ap #779-4114 Magna. Av.', '3573041003950011', 6, '2016-11-01 16:18:24', NULL, 1),
(61, 'Wie', 'P.O. Box 887, 1457 Nibh St.', '3573041003950011', 28, '2016-11-16 19:37:06', NULL, 1),
(62, 'MS', '3978 Eu Ave', '3573041003950011', 5, '2016-06-01 09:43:33', NULL, 1),
(63, 'MAR', '4385 Purus, Road', '3573041003950011', 14, '2015-08-25 19:21:52', NULL, 0),
(64, 'Berlin', 'P.O. Box 183, 8352 Elit, Rd.', '3573041003950011', 13, '2016-11-01 08:46:49', NULL, 0),
(65, 'Bur', 'P.O. Box 241, 8283 Fames Road', '3573041003950011', 23, '2017-03-27 17:44:45', NULL, 1),
(66, 'L', '8071 Dolor. Avenue', '3573041003950011', 31, '2016-04-10 19:17:51', NULL, 0),
(67, 'AS', '133-4080 Natoque St.', '3573041003950011', 19, '2016-04-24 00:16:36', NULL, 1),
(68, 'Canarias', '747-1888 Integer St.', '3573041003950011', 5, '2015-12-11 00:40:16', NULL, 0),
(69, 'Jigawa', 'P.O. Box 710, 8946 Maecenas Street', '3573041003950011', 22, '2016-11-01 17:51:12', NULL, 0),
(70, 'West Lothian', 'Ap #874-5867 Volutpat. St.', '3573041003950011', 10, '2016-08-10 17:11:39', NULL, 0),
(71, 'O', '8658 Tellus Rd.', '3573041003950011', 17, '2015-09-19 21:05:51', NULL, 0),
(72, 'IN', '7162 Lectus Rd.', '3573041003950011', 25, '2017-02-06 19:38:40', NULL, 1),
(73, 'Virginia', 'Ap #822-8473 Rutrum St.', '3573041003950011', 16, '2016-09-06 19:55:10', NULL, 0),
(74, 'Connacht', 'Ap #967-183 A Rd.', '3573041003950011', 17, '2016-12-14 09:24:26', NULL, 0),
(75, 'Istanbul', 'P.O. Box 193, 7725 Magna. Avenue', '3573041003950011', 12, '2016-06-18 10:18:56', NULL, 1),
(76, 'KO', '3054 Viverra. St.', '3573041003950011', 20, '2016-12-25 18:24:32', NULL, 1),
(77, 'CL', 'P.O. Box 650, 6460 Aptent Ave', '3573041003950011', 9, '2016-08-10 23:59:22', NULL, 0),
(78, 'Alberta', 'Ap #679-6848 Dui, Rd.', '3573041003950011', 9, '2017-04-01 07:54:07', NULL, 1),
(79, 'MS', 'P.O. Box 345, 6028 Nibh. Av.', '3573041003950011', 11, '2016-03-01 07:02:22', NULL, 0),
(80, 'Zl', 'P.O. Box 227, 6705 Justo. Rd.', '3573041003950011', 30, '2016-03-15 11:50:28', NULL, 1),
(81, 'L', '702-866 Hendrerit Rd.', '3573041003950011', 23, '2016-03-19 06:56:35', NULL, 1),
(82, 'Île-de-France', '201-3350 Suscipit Avenue', '3573041003950011', 5, '2015-12-31 02:37:33', NULL, 1),
(83, 'Friesland', 'Ap #709-7664 Tellus, Road', '3573041003950011', 3, '2017-02-17 17:09:29', NULL, 0),
(84, 'AQ', '9053 Fusce Rd.', '3573041003950011', 12, '2015-09-22 03:12:50', NULL, 1),
(85, 'Trentino-Alto Adige', '336-8124 Dolor Av.', '3573041003950011', 6, '2015-12-20 00:31:52', NULL, 0),
(86, 'ON', '186-6062 Semper Rd.', '3573041003950011', 19, '2016-01-01 13:30:57', NULL, 1),
(87, 'Delaware', '426-5529 Vel, Av.', '3573041003950011', 22, '2016-08-19 14:26:31', NULL, 1),
(88, 'Styria', '1890 Ridiculus Av.', '3573041003950011', 3, '2016-03-15 23:41:41', NULL, 0),
(89, 'Sl?skie', '844-2822 Posuere Ave', '3573041003950011', 11, '2015-12-31 22:20:36', NULL, 0),
(90, 'São Paulo', '828-4659 Duis Road', '3573041003950011', 4, '2015-11-18 16:50:56', NULL, 0),
(91, 'PA', '603-9085 Non Rd.', '3573041003950011', 7, '2016-02-06 17:55:14', NULL, 0),
(92, 'Karnataka', '8363 Amet Avenue', '3573041003950011', 27, '2016-10-27 14:35:01', NULL, 0),
(93, 'Antwerpen', '241-405 Ante Street', '3573041003950011', 11, '2015-08-24 21:01:35', NULL, 1),
(94, 'ON', '2468 Cursus Rd.', '3573041003950011', 16, '2016-10-18 04:14:33', NULL, 1),
(95, 'SJ', 'Ap #734-3596 Metus Av.', '3573041003950011', 13, '2016-07-27 16:42:49', NULL, 1),
(96, 'SK', 'P.O. Box 322, 5982 Eu, Avenue', '3573041003950011', 10, '2015-10-23 07:26:31', NULL, 0),
(97, 'Noord Holland', 'Ap #330-5732 Vestibulum Av.', '3573041003950011', 6, '2016-06-22 20:42:06', NULL, 1),
(98, 'North Island', '6916 Sociis Street', '3573041003950011', 17, '2017-01-13 20:49:13', NULL, 1),
(99, 'W', 'Ap #411-1383 Aenean Rd.', '3573041003950011', 29, '2016-01-20 20:20:31', NULL, 0),
(100, 'NV', 'P.O. Box 252, 2230 Urna. Avenue', '3573041003950011', 13, '2016-12-03 04:32:22', NULL, 1),
(101, 'Brussels Hoofdstedelijk Gewest', '8875 Donec Road', '3573041003950011', 26, '2016-11-20 13:45:08', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE IF NOT EXISTS `kota` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat_kantor` varchar(255) NOT NULL,
  `id_pengurus` varchar(16) DEFAULT NULL,
  `id_provinsi` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id`, `nama`, `alamat_kantor`, `id_pengurus`, `id_provinsi`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Bogor', 'Jl. Ir. H. Juanda No. 10 Bogor', '3573041003950012', 32, '2016-04-04 16:54:05', NULL, 1),
(2, 'Sukabumi', 'Jl. R. Syamsudin S.H. No. 25 Sukabumi', '3573041003950012', 32, '2016-04-04 16:54:42', NULL, 1),
(3, 'Cianjur', 'Kantor Bupati Jl.H.Siti Jenar No.31,Cianjur', '3573041003950011', 32, '2016-04-04 16:58:09', NULL, 1),
(4, 'Bandung', 'Kantor Walikota Jl.Wastukencana No.2,Bandung', '3573041003950011', 32, '2016-04-04 16:58:56', NULL, 1),
(5, 'Garut', 'Kantor Bupati Jl.Pembangunan No.189,Garut', '3573041003950011', 32, '2016-04-04 16:59:32', NULL, 1),
(6, 'Tasikmalaya', 'Kantor Bupati Jl.Mayor Utarya No.1,Tasikmalaya', '3573041003950011', 32, '2016-04-04 17:00:03', NULL, 1),
(7, 'Ciamis', 'Kantor Bupati Jl.Jend.Sudirman No.16,Ciamis', '3573041003950011', 32, '2016-04-04 17:00:36', NULL, 1),
(8, 'Kuningan', 'Kantor Bupati Jl.Siliwangi No.88,Kuningan', '3573041003950011', 32, '2016-04-04 17:01:10', NULL, 1),
(9, 'Cirebon', 'Kantor Walikota Jl.Siliwangi No.84,Cirebon', '3573041003950011', 32, '2016-04-04 17:01:45', NULL, 1),
(10, 'Majalengka', 'Kantor Bupati Jl.A.Yani No.1,Majalengka', '3573041003950011', 32, '2016-04-04 17:02:22', NULL, 1),
(11, 'Sumedang', 'Kantor Bupati Jl.Prabu Geusan Ulun No.36,Sumedang', '3573041003950011', 32, '2016-04-04 17:02:56', NULL, 1),
(12, 'Indramayu', 'Kantor Bupati Jl.Mayjen.Sutoyo No.1/E,Indramayu', '3573041003950011', 32, '2016-04-04 17:03:29', NULL, 1),
(13, 'Subang', 'Kantor Bupati Jl.Dewi Sartika No.2,Subang', '3573041003950011', 32, '2016-04-04 17:03:55', NULL, 1),
(14, 'Purwakarta', 'Kantor Bupati Jl.Gandanegara No.25,Purwakarta', '3573041003950012', 32, '2016-04-04 17:04:25', NULL, 1),
(15, 'Karawang', 'Kantor Bupati Jl.A.Yani No.1,Karawang', '3573041003950011', 32, '2016-04-04 17:05:00', NULL, 1),
(16, 'Bekasi', 'Kantor Walikota Jl.Ir.H.Juanda No.100,Bekasi', '3573041003950011', 32, '2016-04-04 17:05:30', NULL, 1),
(37, 'Kota Bandung', 'Jalan Ciumbuleuit XX', NULL, NULL, '2016-03-30 23:01:31', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `nip` varchar(20) NOT NULL,
  `id_penduduk` varchar(16) NOT NULL,
  `id_jabatan` varchar(20) NOT NULL,
  `id_atasan` varchar(20) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `golongan` varchar(25) NOT NULL,
  `unit_kerja` varchar(100) NOT NULL,
  `pangkat` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE IF NOT EXISTS `penduduk` (
  `id` varchar(16) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` int(11) NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `id_keluarga` varchar(16) DEFAULT NULL,
  `id_ayah` varchar(16) DEFAULT NULL,
  `id_ibu` varchar(16) DEFAULT NULL,
  `hubungan_keluarga` varchar(50) NOT NULL,
  `golongan_darah` varchar(2) DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `wni` tinyint(1) DEFAULT NULL,
  `status_perkawinan` varchar(50) NOT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL,
  `pendidikan` varchar(50) DEFAULT NULL,
  `id_izin_tetap` varchar(20) DEFAULT NULL,
  `id_passport` varchar(16) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id`, `nama`, `tanggal_lahir`, `tempat_lahir`, `jenis_kelamin`, `id_keluarga`, `id_ayah`, `id_ibu`, `hubungan_keluarga`, `golongan_darah`, `agama`, `wni`, `status_perkawinan`, `pekerjaan`, `pendidikan`, `id_izin_tetap`, `id_passport`, `created_at`, `status`) VALUES
('3573041003950011', 'Natan', '1995-03-10', 37, '', NULL, NULL, NULL, 'Anak', 'B', 'Kristen', 1, '', 'Mahasiswa', 'Sekolah Menengah', NULL, NULL, '2016-03-31 14:48:42', 1),
('3573041003950012', 'Juol', '1995-05-20', 37, 'l', '1', '3573041003950011', NULL, 'Cucu', 'A', 'Islam', 1, '', 'Gabut', 'SD', NULL, NULL, '2016-04-02 09:46:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE IF NOT EXISTS `provinsi` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat_kantor` varchar(255) NOT NULL,
  `id_pengurus` varchar(16) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id`, `nama`, `alamat_kantor`, `id_pengurus`, `created_at`, `updated_at`, `status`) VALUES
(32, 'Jawa Barat', 'JL. DIPONEGORO NO. 22 BANDUNG', '3573041003950011', '2016-04-04 16:49:43', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rt`
--

CREATE TABLE IF NOT EXISTS `rt` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat_kantor` varchar(255) NOT NULL,
  `id_pengurus` varchar(16) NOT NULL,
  `id_rw` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rt`
--

INSERT INTO `rt` (`id`, `nama`, `alamat_kantor`, `id_pengurus`, `id_rw`, `created_at`, `updated_at`, `status`) VALUES
(1, '001', 'Jalan CiumbuRT 121', '3573041003950011', 1, '2016-03-31 14:49:27', NULL, 1),
(2, 'Berlin', 'Ap #591-5170 Enim Street', '3573041003950011', 70, '2001-11-23 11:40:37', NULL, 1),
(3, 'Michigan', 'P.O. Box 477, 9490 Arcu Ave', '3573041003950011', 32, '2016-08-10 16:45:50', NULL, 0),
(4, 'Berlin', '692-3616 Vel Rd.', '3573041003950011', 55, '2008-03-31 11:23:34', NULL, 0),
(5, 'QLD', '6034 Placerat, St.', '3573041003950011', 67, '2006-11-05 16:58:50', NULL, 1),
(6, 'C', 'P.O. Box 366, 7860 Erat. Rd.', '3573041003950011', 12, '2004-07-18 08:52:06', NULL, 1),
(7, 'Los Lagos', '205-3353 Curabitur Av.', '3573041003950011', 59, '2007-05-24 19:01:20', NULL, 0),
(8, 'British Columbia', '4313 Eu St.', '3573041003950011', 30, '2014-02-09 19:32:55', NULL, 0),
(9, 'Northwest Territories', 'Ap #569-7072 A, Av.', '3573041003950011', 6, '2014-04-28 01:24:15', NULL, 1),
(10, 'Noord Holland', 'P.O. Box 584, 5753 Luctus Street', '3573041003950011', 19, '2012-01-27 20:46:41', NULL, 1),
(11, 'Paraíba', '810-2857 Urna, Rd.', '3573041003950011', 2, '2004-01-12 09:44:35', NULL, 0),
(12, 'NSW', '3660 Nullam Road', '3573041003950011', 12, '2008-01-07 06:55:29', NULL, 0),
(13, 'Wie', '5243 Pede. Street', '3573041003950011', 33, '2002-04-13 07:40:47', NULL, 0),
(14, 'HI', '276-8414 Egestas. Ave', '3573041003950011', 47, '2005-05-09 14:34:14', NULL, 1),
(15, 'North Island', 'P.O. Box 235, 5289 Nam Avenue', '3573041003950011', 11, '2002-07-04 14:48:56', NULL, 1),
(16, 'ON', '138-2544 Faucibus Road', '3573041003950011', 9, '2000-08-04 10:21:28', NULL, 0),
(17, 'South Island', 'Ap #656-561 Dui Street', '3573041003950011', 23, '2011-07-17 13:07:54', NULL, 0),
(18, 'MA', '7057 Magna. Rd.', '3573041003950011', 84, '2000-08-23 10:04:49', NULL, 1),
(19, 'Wie', '2807 Donec St.', '3573041003950011', 50, '2010-10-18 00:38:49', NULL, 0),
(20, 'Ontario', 'P.O. Box 359, 1036 Amet Rd.', '3573041003950011', 67, '2001-05-09 19:56:11', NULL, 1),
(21, 'NI', 'P.O. Box 161, 1414 A, Road', '3573041003950011', 100, '2004-06-12 19:16:37', NULL, 1),
(22, 'SJ', 'P.O. Box 882, 6991 Cras Street', '3573041003950011', 20, '2002-11-16 18:16:31', NULL, 1),
(23, 'Sicilia', '1578 Orci Avenue', '3573041003950011', 8, '2015-02-15 01:11:07', NULL, 1),
(24, 'OK', '729-3724 Euismod Ave', '3573041003950011', 65, '2014-12-25 09:16:09', NULL, 1),
(25, 'KS', 'Ap #103-3039 Ut Street', '3573041003950011', 77, '2009-03-16 02:47:13', NULL, 1),
(26, 'NE', '912-6398 Rutrum Rd.', '3573041003950011', 41, '2004-12-14 14:54:16', NULL, 1),
(27, 'N.', '1773 Feugiat Ave', '3573041003950011', 85, '2015-07-14 22:19:12', NULL, 0),
(28, 'Zachodniopomorskie', 'Ap #447-5800 Vel Ave', '3573041003950011', 71, '2007-07-12 15:07:20', NULL, 0),
(29, 'Campania', 'P.O. Box 627, 2974 Augue Rd.', '3573041003950011', 18, '2007-10-04 22:22:41', NULL, 0),
(30, 'Metropolitana de Santiago', '3055 Mollis. St.', '3573041003950011', 26, '2008-11-06 13:34:44', NULL, 0),
(31, 'Comunitat Valenciana', 'P.O. Box 656, 816 Magna St.', '3573041003950011', 27, '2002-12-08 11:09:18', NULL, 0),
(32, 'U.', '3307 Cum Street', '3573041003950011', 22, '2015-09-26 21:06:39', NULL, 0),
(33, 'Orkney', 'P.O. Box 717, 932 Nisl Avenue', '3573041003950011', 36, '2005-12-27 05:53:14', NULL, 0),
(34, 'BE', 'P.O. Box 250, 7848 Aliquet Road', '3573041003950011', 38, '2013-04-29 08:35:13', NULL, 1),
(35, 'RF', '427-4060 Nascetur Ave', '3573041003950011', 39, '2010-10-23 22:46:22', NULL, 0),
(36, 'Guanacaste', '663-7005 Pellentesque Road', '3573041003950011', 57, '2005-08-05 11:49:21', NULL, 0),
(37, 'Bahia', 'Ap #294-6150 Urna. Rd.', '3573041003950011', 14, '2012-01-18 09:59:10', NULL, 1),
(38, 'Quebec', 'P.O. Box 850, 4164 Magna Ave', '3573041003950011', 76, '2007-08-08 17:32:15', NULL, 1),
(39, 'Bahia', '1655 Magna. Avenue', '3573041003950011', 79, '2007-04-05 03:23:42', NULL, 1),
(40, 'QC', 'Ap #708-3207 Vitae Street', '3573041003950011', 23, '2009-07-17 04:13:07', NULL, 0),
(41, 'Gl', '2575 Eu, St.', '3573041003950011', 4, '2016-09-29 06:11:25', NULL, 0),
(42, 'AB', '670-5916 Nec, Street', '3573041003950011', 71, '2006-11-05 15:02:46', NULL, 1),
(43, 'North Rhine-Westphalia', 'Ap #576-4661 Molestie St.', '3573041003950011', 100, '2002-06-26 02:52:26', NULL, 0),
(44, 'Warmi?sko-mazurskie', '477-8315 Eu Rd.', '3573041003950011', 58, '2003-08-28 03:01:27', NULL, 0),
(45, 'Alajuela', '6805 Vel St.', '3573041003950011', 5, '2004-08-14 19:31:01', NULL, 0),
(46, 'Ontario', 'Ap #102-7447 Lacus. Ave', '3573041003950011', 73, '2002-05-13 09:37:04', NULL, 0),
(47, 'VIC', 'Ap #760-4435 Mauris Rd.', '3573041003950011', 62, '2013-08-05 23:16:20', NULL, 1),
(48, 'Kocaeli', 'Ap #793-3336 Amet Avenue', '3573041003950011', 93, '2007-07-13 09:46:39', NULL, 0),
(49, 'Catalunya', 'Ap #611-9025 Tellus Ave', '3573041003950011', 48, '2003-08-19 06:43:24', NULL, 0),
(50, 'CE', 'Ap #338-6529 Magna, Rd.', '3573041003950011', 53, '2010-12-11 11:43:07', NULL, 1),
(51, 'RJ', 'Ap #351-4173 Pulvinar St.', '3573041003950011', 61, '2012-08-03 00:58:53', NULL, 1),
(52, 'South Island', '664-4473 A, St.', '3573041003950011', 67, '2006-05-08 10:09:53', NULL, 1),
(53, 'Noord Holland', 'P.O. Box 996, 2069 Aliquam St.', '3573041003950011', 43, '2007-03-11 17:30:28', NULL, 1),
(54, 'Istanbul', 'Ap #950-8037 Molestie. Road', '3573041003950011', 20, '2014-03-02 03:57:42', NULL, 1),
(55, 'Colorado', '979-6800 Scelerisque Avenue', '3573041003950011', 43, '2010-11-05 11:27:55', NULL, 0),
(56, 'Alberta', '812-900 Curae; St.', '3573041003950011', 13, '2004-04-06 15:43:27', NULL, 0),
(57, 'Ontario', '427-9275 Et Street', '3573041003950011', 99, '2000-08-14 20:06:06', NULL, 0),
(58, 'BE', 'Ap #764-9591 Non Ave', '3573041003950011', 53, '2008-06-10 05:46:46', NULL, 0),
(59, 'Ist', '7702 Diam Ave', '3573041003950011', 96, '2012-08-03 23:23:36', NULL, 1),
(60, 'Berlin', '3923 Justo. Rd.', '3573041003950011', 27, '2006-05-09 14:13:32', NULL, 1),
(61, 'Stockholms län', 'P.O. Box 839, 7175 Arcu Street', '3573041003950011', 28, '2011-06-19 12:05:08', NULL, 0),
(62, 'RJ', '5877 Eu Road', '3573041003950011', 57, '2000-12-08 04:30:33', NULL, 0),
(63, 'UP', '8443 Est Road', '3573041003950011', 61, '2005-12-02 09:29:46', NULL, 0),
(64, 'UT', 'P.O. Box 958, 7806 Eleifend Street', '3573041003950011', 11, '2006-06-20 04:37:55', NULL, 1),
(65, 'Veneto', 'P.O. Box 822, 6888 Adipiscing Av.', '3573041003950011', 10, '2013-08-01 14:38:01', NULL, 1),
(66, 'HB', 'Ap #707-7257 Mauris Rd.', '3573041003950011', 44, '2013-08-30 22:19:48', NULL, 1),
(67, 'Kujawsko-pomorskie', 'P.O. Box 357, 8046 Adipiscing St.', '3573041003950011', 67, '2000-04-28 00:00:24', NULL, 0),
(68, 'W', '637-6536 Tellus Rd.', '3573041003950011', 75, '2011-02-25 13:31:43', NULL, 1),
(69, 'Denbighshire', '1098 A St.', '3573041003950011', 67, '2004-03-07 12:31:12', NULL, 0),
(70, 'Victoria', '2367 Donec St.', '3573041003950011', 33, '2001-02-04 21:07:46', NULL, 0),
(71, 'NI', '1919 Arcu St.', '3573041003950011', 95, '2013-02-02 16:12:55', NULL, 0),
(72, 'WA', 'P.O. Box 139, 3376 Augue Rd.', '3573041003950011', 40, '2005-03-24 21:54:01', NULL, 0),
(73, 'Lombardia', 'Ap #279-1232 Rutrum St.', '3573041003950011', 17, '2011-11-15 22:14:39', NULL, 0),
(74, 'Castilla y León', '1263 Fusce Rd.', '3573041003950011', 91, '2013-11-14 07:32:32', NULL, 0),
(75, 'SIC', 'Ap #810-5168 Turpis. Avenue', '3573041003950011', 62, '2009-09-07 07:35:16', NULL, 1),
(76, 'Munster', '4716 Sodales. Ave', '3573041003950011', 70, '2000-10-02 03:19:50', NULL, 1),
(77, 'Valparaíso', '890 Luctus, Rd.', '3573041003950011', 77, '2010-10-07 13:36:24', NULL, 1),
(78, 'MAR', '3685 Et St.', '3573041003950011', 9, '2006-08-16 01:09:07', NULL, 0),
(79, 'SK', '4137 Est Avenue', '3573041003950011', 90, '2006-07-09 09:00:30', NULL, 1),
(80, 'NI', 'P.O. Box 676, 4643 Et St.', '3573041003950011', 45, '2012-04-04 03:51:26', NULL, 0),
(81, 'LA', 'P.O. Box 674, 532 Sodales St.', '3573041003950011', 20, '2009-05-31 05:42:32', NULL, 1),
(82, 'C', '185-6756 Lacinia Street', '3573041003950011', 95, '2014-06-22 17:23:13', NULL, 0),
(83, 'New South Wales', 'Ap #388-2093 Hendrerit St.', '3573041003950011', 2, '2010-08-09 08:02:51', NULL, 0),
(84, 'LAZ', 'Ap #294-2642 Mollis St.', '3573041003950011', 95, '2009-08-21 23:55:58', NULL, 0),
(85, 'MA', 'Ap #862-680 Eu Rd.', '3573041003950011', 89, '2015-05-27 12:04:09', NULL, 1),
(86, 'MP', 'Ap #946-7551 Justo St.', '3573041003950011', 25, '2000-05-25 06:42:11', NULL, 1),
(87, 'Ontario', '422-978 Dictum Av.', '3573041003950011', 44, '2003-11-15 07:21:50', NULL, 1),
(88, 'Veneto', '9361 Tincidunt Road', '3573041003950011', 56, '2006-11-02 21:17:44', NULL, 1),
(89, 'QLD', '892-7015 Nibh. St.', '3573041003950011', 59, '2001-12-04 15:20:58', NULL, 1),
(90, 'Metropolitana de Santiago', '881-3906 Turpis. Ave', '3573041003950011', 48, '2012-03-28 03:55:07', NULL, 0),
(91, 'Cartago', '798-3119 A, Ave', '3573041003950011', 66, '2008-03-22 09:41:20', NULL, 1),
(92, 'BE', '8397 Eget, Ave', '3573041003950011', 32, '2008-04-18 09:40:38', NULL, 0),
(93, 'Massachusetts', '380-3362 Fringilla Av.', '3573041003950011', 11, '2000-04-26 22:50:51', NULL, 1),
(94, 'Odisha', 'Ap #620-4449 Convallis, Avenue', '3573041003950011', 36, '2014-07-21 23:56:48', NULL, 1),
(95, 'Berlin', '929-1665 Aliquet Road', '3573041003950011', 37, '2004-08-11 06:38:14', NULL, 1),
(96, 'F', 'Ap #469-8195 Vitae Av.', '3573041003950011', 13, '2015-11-25 20:44:42', NULL, 0),
(97, 'IL', '533-6299 Sociis Rd.', '3573041003950011', 32, '2001-07-17 01:46:21', NULL, 1),
(98, 'Minas Gerais', '798-2526 Id Rd.', '3573041003950011', 41, '2014-09-14 04:39:54', NULL, 0),
(99, 'E', 'Ap #759-6247 Enim. Ave', '3573041003950011', 51, '2003-11-22 15:20:26', NULL, 0),
(100, 'Toscana', 'Ap #486-4535 Sem Rd.', '3573041003950011', 86, '2006-02-19 23:42:58', NULL, 0),
(101, 'L', '940 Elit, Rd.', '3573041003950011', 5, '2010-12-26 19:54:31', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rumpun`
--

CREATE TABLE IF NOT EXISTS `rumpun` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nomor_urut` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rw`
--

CREATE TABLE IF NOT EXISTS `rw` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat_kantor` varchar(255) NOT NULL,
  `id_pengurus` varchar(16) NOT NULL,
  `id_kelurahan` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rw`
--

INSERT INTO `rw` (`id`, `nama`, `alamat_kantor`, `id_pengurus`, `id_kelurahan`, `created_at`, `updated_at`, `status`) VALUES
(1, '', '', '3573041003950011', 1, '2016-03-31 14:49:23', NULL, 1),
(2, 'Vienna', 'P.O. Box 897, 5105 Non Ave', '3573041003950011', 90, '2015-03-08 20:14:59', NULL, 1),
(3, 'Ontario', 'P.O. Box 736, 1962 Posuere, Avenue', '3573041003950011', 65, '2010-08-13 02:07:46', NULL, 1),
(4, 'CA', 'P.O. Box 730, 7908 Cursus Rd.', '3573041003950011', 52, '2004-05-12 10:24:41', NULL, 0),
(5, 'U', 'P.O. Box 515, 7385 Lorem, Ave', '3573041003950011', 79, '2008-03-01 15:38:51', NULL, 0),
(6, 'LD', 'Ap #299-2770 Mollis. Rd.', '3573041003950011', 22, '2008-02-20 14:24:23', NULL, 0),
(7, 'San José', '6507 Ornare, Rd.', '3573041003950011', 81, '2007-06-30 18:04:26', NULL, 1),
(8, 'RM', 'Ap #581-9260 Praesent Avenue', '3573041003950011', 59, '2012-09-14 01:09:59', NULL, 1),
(9, 'HB', '303-5253 Posuere Ave', '3573041003950011', 19, '2012-04-06 00:50:04', NULL, 0),
(10, 'Wie', 'Ap #455-4028 Cum Ave', '3573041003950011', 26, '2015-07-21 14:06:51', NULL, 0),
(11, 'AR', '4670 Ullamcorper Road', '3573041003950011', 12, '2013-12-02 10:53:04', NULL, 1),
(12, 'Ist', 'Ap #111-1842 Mauris, Rd.', '3573041003950011', 84, '2003-03-10 06:34:01', NULL, 1),
(13, 'E', '9442 Nulla. St.', '3573041003950011', 92, '2008-06-06 00:20:51', NULL, 0),
(14, 'JI', '5391 Luctus Rd.', '3573041003950011', 52, '2007-09-04 08:48:40', NULL, 1),
(15, 'PE', 'P.O. Box 545, 2798 Convallis, Ave', '3573041003950011', 2, '2013-09-15 10:41:26', NULL, 1),
(16, 'Ontario', 'Ap #547-4757 Semper Ave', '3573041003950011', 98, '2009-01-30 17:38:08', NULL, 1),
(17, 'Berlin', '807-7746 Dolor Street', '3573041003950011', 89, '2016-03-17 13:15:58', NULL, 0),
(18, 'LO', '284-5846 Torquent Street', '3573041003950011', 75, '2000-11-28 17:10:30', NULL, 1),
(19, 'Limburg', '8978 Ut Av.', '3573041003950011', 97, '2003-03-16 18:04:10', NULL, 0),
(20, 'North Island', '8705 Metus. St.', '3573041003950011', 39, '2001-01-12 01:42:08', NULL, 1),
(21, 'PM', '516-1370 Cras Ave', '3573041003950011', 72, '2008-02-24 21:03:23', NULL, 0),
(22, 'O', '394-9028 Proin Street', '3573041003950011', 63, '2004-11-11 04:14:23', NULL, 0),
(23, 'Hat', '4476 Ridiculus Av.', '3573041003950011', 69, '2014-10-06 13:09:40', NULL, 1),
(24, 'Bremen', '693-8363 Quisque St.', '3573041003950011', 74, '2009-10-16 21:38:37', NULL, 1),
(25, 'RJ', '978-6845 Vestibulum St.', '3573041003950011', 49, '2002-04-09 20:36:14', NULL, 0),
(26, 'Dorset', 'Ap #210-7217 Ornare Road', '3573041003950011', 74, '2007-07-24 01:36:37', NULL, 0),
(27, 'C', 'Ap #216-7456 Nec St.', '3573041003950011', 18, '2007-06-23 03:20:44', NULL, 1),
(28, 'WA', 'P.O. Box 242, 689 Mus. Avenue', '3573041003950011', 17, '2004-08-04 15:18:39', NULL, 0),
(29, 'NA', 'Ap #940-7986 Mi. Street', '3573041003950011', 22, '2004-04-21 13:43:22', NULL, 1),
(30, 'KN', '854-6453 Eu Rd.', '3573041003950011', 51, '2000-07-20 06:13:42', NULL, 1),
(31, 'Stockholms län', '743-5046 Euismod Ave', '3573041003950011', 21, '2005-07-21 05:11:41', NULL, 1),
(32, 'MP', '367-8865 Ac St.', '3573041003950011', 37, '2003-05-30 09:00:40', NULL, 0),
(33, 'LA', 'Ap #923-2166 Felis. Road', '3573041003950011', 40, '2002-08-17 11:23:17', NULL, 0),
(34, 'New South Wales', 'Ap #851-1263 At St.', '3573041003950011', 82, '2014-06-26 10:45:36', NULL, 1),
(35, 'Hamburg', '942-8080 Euismod St.', '3573041003950011', 59, '2006-05-26 11:57:27', NULL, 1),
(36, 'Akwa Ibom', 'Ap #485-456 Dictum. Road', '3573041003950011', 37, '2015-04-18 01:04:50', NULL, 1),
(37, 'La Rioja', '8467 Nunc St.', '3573041003950011', 36, '2009-07-01 12:15:16', NULL, 1),
(38, 'Rio Grande do Sul', '420-9280 Magna, St.', '3573041003950011', 89, '2015-06-30 05:19:09', NULL, 1),
(39, 'Ontario', '798 Facilisi. Avenue', '3573041003950011', 62, '2003-04-29 16:36:42', NULL, 0),
(40, 'Podkarpackie', '396 Quis, Av.', '3573041003950011', 21, '2007-01-03 00:15:36', NULL, 0),
(41, 'LU', '461-7429 Sed Road', '3573041003950011', 94, '2007-12-12 14:55:03', NULL, 0),
(42, 'Istanbul', '4658 Dictum Av.', '3573041003950011', 17, '2002-09-02 12:49:38', NULL, 1),
(43, 'Wyoming', 'Ap #781-7810 Tincidunt. Road', '3573041003950011', 74, '2011-09-15 14:41:00', NULL, 1),
(44, 'North Island', '8072 Facilisis Street', '3573041003950011', 20, '2016-07-30 15:59:48', NULL, 0),
(45, 'Connacht', '111-771 Vivamus Road', '3573041003950011', 73, '2008-02-17 04:50:23', NULL, 0),
(46, 'LU', '753-8213 Hendrerit Avenue', '3573041003950011', 4, '2001-10-24 03:35:43', NULL, 1),
(47, 'WY', 'P.O. Box 255, 8026 Quis Rd.', '3573041003950011', 56, '2005-11-21 00:16:24', NULL, 1),
(48, 'Goiás', '9492 Donec Ave', '3573041003950011', 7, '2016-12-26 01:42:04', NULL, 1),
(49, 'Wie', '764 Nisi St.', '3573041003950011', 56, '2014-12-20 02:12:38', NULL, 1),
(50, 'Northwest Territories', '9067 Vitae, Street', '3573041003950011', 89, '2014-11-10 08:28:44', NULL, 1),
(51, 'Colorado', 'Ap #323-2027 Penatibus Av.', '3573041003950011', 14, '2014-09-13 23:27:50', NULL, 1),
(52, 'HH', 'Ap #245-6697 Interdum Avenue', '3573041003950011', 21, '2008-12-06 15:34:00', NULL, 0),
(53, 'NI', 'P.O. Box 200, 2891 Lobortis St.', '3573041003950011', 70, '2013-01-01 10:39:07', NULL, 1),
(54, 'Vienna', 'Ap #847-7439 Proin Road', '3573041003950011', 33, '2017-03-22 12:20:12', NULL, 0),
(55, 'VB', '1158 Risus. Rd.', '3573041003950011', 6, '2016-02-29 08:06:10', NULL, 1),
(56, 'CA', 'Ap #355-4930 Magna. Ave', '3573041003950011', 85, '2003-09-30 15:55:59', NULL, 1),
(57, 'PA', '2944 Sed Street', '3573041003950011', 63, '2002-12-24 20:21:13', NULL, 1),
(58, 'GA', 'P.O. Box 210, 1764 Sed Avenue', '3573041003950011', 30, '2001-03-24 22:39:15', NULL, 0),
(59, 'QC', 'Ap #552-8831 Cursus Rd.', '3573041003950011', 101, '2014-08-24 07:56:20', NULL, 1),
(60, 'NI', 'Ap #554-9518 Scelerisque Rd.', '3573041003950011', 10, '2011-06-23 02:31:17', NULL, 0),
(61, 'New South Wales', '7470 Consectetuer Ave', '3573041003950011', 30, '2012-10-12 00:58:19', NULL, 1),
(62, 'L', 'Ap #368-271 Enim. Ave', '3573041003950011', 18, '2016-09-13 17:26:50', NULL, 0),
(63, 'RS', 'P.O. Box 477, 9574 Nullam Rd.', '3573041003950011', 72, '2013-04-27 03:50:56', NULL, 0),
(64, 'Himachal Pradesh', '526-7513 Nunc Street', '3573041003950011', 8, '2016-03-10 05:24:56', NULL, 1),
(65, 'Mazowieckie', '596-3970 Tellus. Ave', '3573041003950011', 49, '2012-02-09 10:58:17', NULL, 1),
(66, 'Ontario', '118-7607 Tellus Road', '3573041003950011', 40, '2016-04-15 03:33:40', NULL, 1),
(67, 'Gl', 'P.O. Box 429, 9521 Rutrum St.', '3573041003950011', 41, '2004-03-23 01:51:13', NULL, 1),
(68, 'Jharkhand', '715-577 Ac Avenue', '3573041003950011', 31, '2004-12-05 17:48:51', NULL, 1),
(69, 'Queensland', '761-5336 Erat. Ave', '3573041003950011', 66, '2004-12-21 00:34:04', NULL, 0),
(70, 'HB', '832-3366 Blandit Av.', '3573041003950011', 4, '2009-01-07 13:53:29', NULL, 0),
(71, 'Wyoming', '317-6002 Eget St.', '3573041003950011', 49, '2001-02-15 20:52:31', NULL, 0),
(72, 'MP', '1017 Magnis Av.', '3573041003950011', 71, '2015-02-01 04:02:59', NULL, 1),
(73, 'Ulster', 'P.O. Box 533, 840 Vivamus St.', '3573041003950011', 55, '2002-12-31 17:26:51', NULL, 0),
(74, 'Castilla - La Mancha', 'P.O. Box 439, 1459 Duis Ave', '3573041003950011', 46, '2006-04-24 19:22:07', NULL, 1),
(75, 'OR', 'P.O. Box 245, 8782 Cum Ave', '3573041003950011', 36, '2016-07-05 00:44:19', NULL, 1),
(76, 'PM', '7815 Vivamus Ave', '3573041003950011', 89, '2008-02-02 04:46:45', NULL, 1),
(77, 'CA', '298-2990 Molestie. St.', '3573041003950011', 43, '2007-03-24 13:58:29', NULL, 0),
(78, 'Ulster', 'Ap #385-8756 Est. Rd.', '3573041003950011', 80, '2015-10-10 16:22:12', NULL, 1),
(79, 'MI', '8148 Feugiat. Road', '3573041003950011', 51, '2010-01-17 16:18:16', NULL, 0),
(80, 'Paraná', 'P.O. Box 315, 8006 Est Street', '3573041003950011', 73, '2003-08-13 18:49:32', NULL, 0),
(81, 'A', 'P.O. Box 324, 1288 Feugiat. Road', '3573041003950011', 84, '2001-12-04 20:44:52', NULL, 0),
(82, 'BE', 'P.O. Box 529, 722 Eget Rd.', '3573041003950011', 73, '2001-12-30 18:07:52', NULL, 1),
(83, 'Queensland', 'Ap #322-6246 Elementum Street', '3573041003950011', 39, '2015-11-13 09:04:18', NULL, 1),
(84, 'Languedoc-Roussillon', '9906 Sit Street', '3573041003950011', 67, '2009-03-31 00:13:25', NULL, 1),
(85, 'North Island', 'P.O. Box 389, 6588 Vulputate, St.', '3573041003950011', 46, '2015-07-07 01:55:56', NULL, 1),
(86, 'WI', 'P.O. Box 299, 7348 Tempus St.', '3573041003950011', 6, '2007-06-04 04:55:50', NULL, 1),
(87, 'NA', 'P.O. Box 385, 5442 Ac Rd.', '3573041003950011', 62, '2011-11-13 00:02:20', NULL, 1),
(88, 'CA', 'Ap #883-8244 Tristique Avenue', '3573041003950011', 43, '2010-11-09 15:07:46', NULL, 1),
(89, 'North Island', 'P.O. Box 160, 3450 Ipsum St.', '3573041003950011', 13, '2010-10-01 03:59:24', NULL, 0),
(90, 'MP', '4419 Adipiscing Street', '3573041003950011', 98, '2014-10-24 17:54:59', NULL, 0),
(91, 'NI', '604-848 Vel Avenue', '3573041003950011', 42, '2012-07-04 18:51:41', NULL, 0),
(92, 'E', '9087 Et Rd.', '3573041003950011', 87, '2011-03-06 03:45:16', NULL, 1),
(93, 'UP', '939-9960 Interdum. St.', '3573041003950011', 16, '2015-06-14 01:14:11', NULL, 1),
(94, 'Östergötlands län', '6214 Blandit Rd.', '3573041003950011', 9, '2008-03-16 22:27:35', NULL, 0),
(95, 'WV', '4501 Nascetur Road', '3573041003950011', 62, '2008-05-29 00:20:23', NULL, 0),
(96, 'RM', 'P.O. Box 243, 7649 Tempor Avenue', '3573041003950011', 1, '2001-11-20 17:12:24', NULL, 0),
(97, 'WI', '639-5687 Augue Rd.', '3573041003950011', 101, '2009-11-06 17:42:43', NULL, 0),
(98, 'Anambra', 'P.O. Box 697, 2178 Turpis Road', '3573041003950011', 39, '2010-05-30 15:58:30', NULL, 1),
(99, 'Michigan', 'P.O. Box 476, 4116 Justo St.', '3573041003950011', 84, '2014-05-16 09:39:39', NULL, 1),
(100, 'C', 'Ap #665-4733 Sed Rd.', '3573041003950011', 92, '2006-12-05 13:05:16', NULL, 1),
(101, 'Centre', 'P.O. Box 610, 799 Mauris Avenue', '3573041003950011', 37, '2015-04-20 03:03:07', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `skpd`
--

CREATE TABLE IF NOT EXISTS `skpd` (
  `id` varchar(20) NOT NULL,
  `id_jabatan` varchar(20) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
 ADD PRIMARY KEY (`id`), ADD KEY `id_rumpun` (`id_rumpun`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
 ADD PRIMARY KEY (`id`), ADD KEY `id_kota` (`id_kota`), ADD KEY `kecamatan_ibfk_2` (`id_pengurus`);

--
-- Indexes for table `keluarga`
--
ALTER TABLE `keluarga`
 ADD PRIMARY KEY (`id`), ADD KEY `id_rt` (`id_rt`);

--
-- Indexes for table `kelurahan`
--
ALTER TABLE `kelurahan`
 ADD PRIMARY KEY (`id`), ADD KEY `id_kecamatan` (`id_kecamatan`), ADD KEY `kelurahan_ibfk_2` (`id_pengurus`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
 ADD PRIMARY KEY (`id`), ADD KEY `id_provinsi` (`id_provinsi`), ADD KEY `kota_ibfk_2` (`id_pengurus`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
 ADD PRIMARY KEY (`nip`), ADD KEY `id_jabatan` (`id_jabatan`), ADD KEY `id_atasan` (`id_atasan`), ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
 ADD PRIMARY KEY (`id`), ADD KEY `tempat_lahir` (`tempat_lahir`), ADD KEY `id_keluarga` (`id_keluarga`), ADD KEY `id_ayah` (`id_ayah`), ADD KEY `id_ibu` (`id_ibu`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rt`
--
ALTER TABLE `rt`
 ADD PRIMARY KEY (`id`), ADD KEY `id_rw` (`id_rw`), ADD KEY `rt_ibfk_2` (`id_pengurus`);

--
-- Indexes for table `rumpun`
--
ALTER TABLE `rumpun`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rw`
--
ALTER TABLE `rw`
 ADD PRIMARY KEY (`id`), ADD KEY `id_kelurahan` (`id_kelurahan`), ADD KEY `rw_ibfk_2` (`id_pengurus`);

--
-- Indexes for table `skpd`
--
ALTER TABLE `skpd`
 ADD PRIMARY KEY (`id`), ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jabatan`
--
ALTER TABLE `jabatan`
ADD CONSTRAINT `jabatan_ibfk_1` FOREIGN KEY (`id_rumpun`) REFERENCES `rumpun` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `kecamatan`
--
ALTER TABLE `kecamatan`
ADD CONSTRAINT `kecamatan_ibfk_1` FOREIGN KEY (`id_kota`) REFERENCES `kota` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `kecamatan_ibfk_2` FOREIGN KEY (`id_pengurus`) REFERENCES `penduduk` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `keluarga`
--
ALTER TABLE `keluarga`
ADD CONSTRAINT `keluarga_ibfk_1` FOREIGN KEY (`id_rt`) REFERENCES `rt` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `kelurahan`
--
ALTER TABLE `kelurahan`
ADD CONSTRAINT `kelurahan_ibfk_1` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `kelurahan_ibfk_2` FOREIGN KEY (`id_pengurus`) REFERENCES `penduduk` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `kota`
--
ALTER TABLE `kota`
ADD CONSTRAINT `kota_ibfk_1` FOREIGN KEY (`id_provinsi`) REFERENCES `provinsi` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `kota_ibfk_2` FOREIGN KEY (`id_pengurus`) REFERENCES `penduduk` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `pegawai_ibfk_2` FOREIGN KEY (`id_atasan`) REFERENCES `pegawai` (`nip`) ON UPDATE CASCADE,
ADD CONSTRAINT `pegawai_ibfk_3` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `penduduk`
--
ALTER TABLE `penduduk`
ADD CONSTRAINT `penduduk_ibfk_1` FOREIGN KEY (`tempat_lahir`) REFERENCES `kota` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `penduduk_ibfk_2` FOREIGN KEY (`id_ayah`) REFERENCES `penduduk` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `penduduk_ibfk_3` FOREIGN KEY (`id_ibu`) REFERENCES `keluarga` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `penduduk_ibfk_4` FOREIGN KEY (`id_keluarga`) REFERENCES `keluarga` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `rt`
--
ALTER TABLE `rt`
ADD CONSTRAINT `rt_ibfk_1` FOREIGN KEY (`id_rw`) REFERENCES `rw` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `rt_ibfk_2` FOREIGN KEY (`id_pengurus`) REFERENCES `penduduk` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `rw`
--
ALTER TABLE `rw`
ADD CONSTRAINT `rw_ibfk_1` FOREIGN KEY (`id_kelurahan`) REFERENCES `kelurahan` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `rw_ibfk_2` FOREIGN KEY (`id_pengurus`) REFERENCES `penduduk` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `skpd`
--
ALTER TABLE `skpd`
ADD CONSTRAINT `skpd_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
