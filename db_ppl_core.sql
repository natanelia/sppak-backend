SET time_zone = "+07:00";

-- Database: `db_ppl`
CREATE DATABASE IF NOT EXISTS db_ppl_core;

USE db_ppl_core;

-- Table structure for table `skpd`
CREATE TABLE `skpd` (
  `id` varchar(20) NOT NULL,
  `id_jabatan` varchar(20) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL -- ACTIVE = true, INACTIVE = false  
);

-- Table structure for table `pegawai`
CREATE TABLE `pegawai` (
  `nip` varchar(20) NOT NULL,
  `id_penduduk` varchar(16) NOT NULL,
  `id_jabatan` varchar(20) NOT NULL,
  `id_atasan` varchar(20) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `golongan` varchar(25) NOT NULL, -- eselon, bisa diambil dari pangkat atau grade
  `unit_kerja` varchar(100) NOT NULL,
  `pangkat` varchar(25) NOT NULL, -- kelas jabatan atau grade, bisa diambil dari jabatan
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `status` tinyint(1) NOT NULL -- ACTIVE = true, INACTIVE = false  
);

-- Table structure for table `jabatan`
CREATE TABLE `jabatan` (
  `id` varchar(25) NOT NULL,
  `id_rumpun` varchar(25) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kualifikasi` enum('Pendidikan','Keahlian') NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `kode` varchar(25) NOT NULL,
  `nilai` int(10) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL -- ACTIVE = true, INACTIVE = false  
);

-- Table structure for table `rumpun`
CREATE TABLE `rumpun` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nomor_urut` varchar(25) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL -- ACTIVE = true, INACTIVE = false  
);

-- Table structure for table `penduduk`
CREATE TABLE `penduduk` (
  `id` varchar(16) NOT NULL, -- diisi NIK atau nomor paspor
  `nama` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` int(11) NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,

  `id_keluarga` varchar(16),
  `id_ayah` varchar(16),
  `id_ibu` varchar(16),
  `hubungan_keluarga` varchar(50) NOT NULL,

  `golongan_darah` varchar(2),
  `agama` varchar(50),
  `wni` tinyint(1), -- TRUE = WNI, FALSE = NOT WNI, kalo ganda maka WNI true
  `status_perkawinan` varchar(50) NOT NULL,
  `pekerjaan` varchar(50),
  `pendidikan` varchar(50),
  
  `id_izin_tetap` varchar(20),
  `id_passport` varchar(16),

  `created_at` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `status` tinyint(1) NOT NULL -- ACTIVE = true, INACTIVE = false  
);

-- Table structure for table `keluarga`
CREATE TABLE `keluarga` (
  `id` varchar(16) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `id_rt` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `status` tinyint(1) NOT NULL -- ACTIVE = true, INACTIVE = false  
);

-- Table structure for table `rt`
CREATE TABLE `rt` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat_kantor` varchar(255) NOT NULL,
  `id_pengurus` varchar(16) NOT NULL,
  `id_rw` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL -- ACTIVE = true, INACTIVE = false  
);

-- Table structure for table `rw`
CREATE TABLE `rw` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat_kantor` varchar(255) NOT NULL,
  `id_pengurus` varchar(16) NOT NULL,
  `id_kelurahan` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL -- ACTIVE = true, INACTIVE = false  
);

-- Table structure for table `kelurahan`
CREATE TABLE `kelurahan` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat_kantor` varchar(255) NOT NULL,
  `id_pengurus` varchar(16) NOT NULL,
  `id_kecamatan` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL -- ACTIVE = true, INACTIVE = false  
);

-- Table structure for table `kecamatan`
CREATE TABLE `kecamatan` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat_kantor` varchar(255) NOT NULL,
  `id_pengurus` varchar(16) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL -- ACTIVE = true, INACTIVE = false  
);

-- Table structure for table `kota`
CREATE TABLE `kota` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat_kantor` varchar(255) NOT NULL,
  `id_pengurus` varchar(16) NOT NULL,
  `id_provinsi` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL -- ACTIVE = true, INACTIVE = false  
);

-- Table structure for table `provinsi`
CREATE TABLE `provinsi` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat_kantor` varchar(255) NOT NULL,
  `id_pengurus` varchar(16) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL -- ACTIVE = true, INACTIVE = false  
);

-- Indexes for table `provinsi`
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id`);

-- Indexes for table `kota`
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_provinsi` (`id_provinsi`);

-- Indexes for table `kecamatan`
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kota` (`id_kota`);

-- Indexes for table `kelurahan`
ALTER TABLE `kelurahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kecamatan` (`id_kecamatan`);

-- Indexes for table `rw`
ALTER TABLE `rw`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kelurahan` (`id_kelurahan`);

-- Indexes for table `rt`
ALTER TABLE `rt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rw` (`id_rw`);

-- Indexes for table `penduduk`
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tempat_lahir` (`tempat_lahir`),
  ADD KEY `id_keluarga` (`id_keluarga`),
  ADD KEY `id_ayah` (`id_ayah`),
  ADD KEY `id_ibu` (`id_ibu`);

-- Indexes for table `keluarga`
ALTER TABLE `keluarga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rt` (`id_rt`);

-- Indexes for table `pegawai`
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_atasan` (`id_atasan`),
  ADD KEY `id_penduduk` (`id_penduduk`);

-- Indexes for table `jabatan`
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rumpun` (`id_rumpun`);

-- Indexes for table `rumpun`
ALTER TABLE `rumpun`
  ADD PRIMARY KEY (`id`);

-- Indexes for table `skpd`
ALTER TABLE `skpd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jabatan` (`id_jabatan`);

-- Constraints for table `penduduk`
ALTER TABLE `penduduk`
  ADD CONSTRAINT `penduduk_ibfk_1` FOREIGN KEY (`tempat_lahir`) REFERENCES `kota` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `penduduk_ibfk_2` FOREIGN KEY (`id_ayah`) REFERENCES `penduduk` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `penduduk_ibfk_3` FOREIGN KEY (`id_ibu`) REFERENCES `keluarga` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `penduduk_ibfk_4` FOREIGN KEY (`id_keluarga`) REFERENCES `keluarga` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- Constraints for table `keluarga`
ALTER TABLE `keluarga`
  ADD CONSTRAINT `keluarga_ibfk_1` FOREIGN KEY (`id_rt`) REFERENCES `rt` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- Constraints for table `rt`
ALTER TABLE `rt`
  ADD CONSTRAINT `rt_ibfk_1` FOREIGN KEY (`id_rw`) REFERENCES `rw` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `rt_ibfk_2` FOREIGN KEY (`id_pengurus`) REFERENCES `penduduk` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- Constraints for table `rw`
ALTER TABLE `rw`
  ADD CONSTRAINT `rw_ibfk_1` FOREIGN KEY (`id_kelurahan`) REFERENCES `kelurahan` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `rw_ibfk_2` FOREIGN KEY (`id_pengurus`) REFERENCES `penduduk` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- Constraints for table `kelurahan`
ALTER TABLE `kelurahan`
  ADD CONSTRAINT `kelurahan_ibfk_1` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `kelurahan_ibfk_2` FOREIGN KEY (`id_pengurus`) REFERENCES `penduduk` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- Constraints for table `kecamatan`
ALTER TABLE `kecamatan`
  ADD CONSTRAINT `kecamatan_ibfk_1` FOREIGN KEY (`id_kota`) REFERENCES `kota` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `kecamatan_ibfk_2` FOREIGN KEY (`id_pengurus`) REFERENCES `penduduk` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- Constraints for table `kota`
ALTER TABLE `kota`
  ADD CONSTRAINT `kota_ibfk_1` FOREIGN KEY (`id_provinsi`) REFERENCES `provinsi` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `kota_ibfk_2` FOREIGN KEY (`id_pengurus`) REFERENCES `penduduk` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- Constraints for table `pegawai`
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `pegawai_ibfk_2` FOREIGN KEY (`id_atasan`) REFERENCES `pegawai` (`nip`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `pegawai_ibfk_3` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- Constraints for table `jabatan`
ALTER TABLE `jabatan`
  ADD CONSTRAINT `jabatan_ibfk_1` FOREIGN KEY (`id_rumpun`) REFERENCES `rumpun` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- Constraints for table `skpd`
ALTER TABLE `skpd`
  ADD CONSTRAINT `skpd_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
