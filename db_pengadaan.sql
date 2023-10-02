-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2023 at 05:48 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pengadaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) DEFAULT NULL,
  `jenis_barang` varchar(50) DEFAULT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `jenis_barang`, `satuan`, `keterangan`) VALUES
(1, 'HP', 'Komputer', 'Set', 'Komputer'),
(2, 'Oxygen', 'Alat Kesehatan', '1', 'Tabung Oxygen'),
(4, 'Voluptates in sequi ', 'Ullam eius aut iure ', 'Accusantium beatae i', 'Ratione exercitation');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengajuan`
--

CREATE TABLE `detail_pengajuan` (
  `id` int(11) NOT NULL,
  `id_pengajuan` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `biaya` decimal(10,0) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `qty_vendor` int(11) DEFAULT NULL,
  `harga_vendor` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'unit', 'Unit'),
(2, 'staff', 'Staff Pengadaan'),
(3, 'kabag', 'Kepala Bagian'),
(4, 'direktur', 'Direktur'),
(5, 'vendor', 'Vendor');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id` int(11) NOT NULL,
  `kode_pengajuan` varchar(50) DEFAULT NULL,
  `pengajuan` varchar(50) DEFAULT NULL,
  `jenis_pengajuan` varchar(50) DEFAULT NULL,
  `tgl_pengajuan` date DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `total` decimal(10,0) DEFAULT NULL,
  `verifikasi_1` int(11) DEFAULT NULL,
  `verifikasi_2` int(11) DEFAULT NULL,
  `verifikasi_3` int(11) DEFAULT NULL,
  `memo_2` varchar(50) DEFAULT NULL,
  `memo_3` varchar(50) DEFAULT NULL,
  `catatan_2` text DEFAULT NULL,
  `catatan_3` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_vendor` int(11) DEFAULT NULL,
  `user_vendor` int(11) DEFAULT NULL,
  `no_faktur` varchar(50) DEFAULT NULL,
  `tgl_faktur` date DEFAULT NULL,
  `total_vendor` decimal(10,0) DEFAULT NULL,
  `rekomendasi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penyerahan_barang`
--

CREATE TABLE `penyerahan_barang` (
  `id` int(11) NOT NULL,
  `id_pengajuan` int(11) DEFAULT NULL,
  `kode_unit` int(11) DEFAULT NULL,
  `tanggal_penyerahan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `id_surat` int(11) NOT NULL,
  `no_surat` varchar(50) DEFAULT NULL,
  `ttd_pengaju` varchar(255) DEFAULT NULL,
  `ttd_aprover` varchar(255) DEFAULT NULL,
  `tgl_pengajuan` date DEFAULT NULL,
  `tgl_persetujuan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_detailpengajuan`
--

CREATE TABLE `temp_detailpengajuan` (
  `id` int(11) NOT NULL,
  `id_pengajuan` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `biaya` decimal(10,0) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id_unit` int(11) NOT NULL,
  `kode_unit` varchar(50) DEFAULT NULL,
  `nama_unit` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id_unit`, `kode_unit`, `nama_unit`) VALUES
(1, 'DIR', 'Direktur'),
(2, 'PLN', 'Bidang Pelayanan dan Penunjang Medis'),
(3, 'PRWT', 'Bidang Keperawatan'),
(4, 'SDI-KEUANGAN', 'Bagian SDI & Keuangan'),
(5, 'UMUM', 'Bagian Umum, Dakwah dan Kemitraan'),
(6, 'IGD', 'IGD'),
(7, 'IBS', 'IBS (Kamar Operasi)'),
(8, 'ICU', 'ICU'),
(9, 'LAB', 'Laboratorium & Bank Darah'),
(10, 'RADIOLOGI', 'Radiologi'),
(11, 'FARM', 'Farmasi'),
(12, 'GIZI', 'Gizi'),
(13, 'RM', 'Rekam Medis dan Casemix'),
(14, 'REHABMEDIK', 'Rehab Medik'),
(15, 'SEC', 'SEC'),
(16, 'PICU', 'PICU'),
(17, 'ISO', 'Isolasi'),
(18, 'RWJ', 'Rawat Jalan'),
(19, 'RWI', 'Rawat Inap'),
(20, 'SDI-Administrasi', 'SDI & Administratsi'),
(21, 'Keuangan-Akuntansi', 'Keuangan & Akuntansi'),
(22, 'PKRS', 'Kemitraan & PKRS'),
(23, 'DKWH', 'Dakwah'),
(24, 'UMUM', 'Umum'),
(25, 'IRNA-IRJA', 'RAWAT INAP DAN RAWAT JALAN'),
(26, 'IPSRS', 'IPSRS'),
(27, 'FRDS', 'Firdaus'),
(28, 'BAITUNNISA', 'Baitunnisa'),
(29, 'ADN', 'Adn'),
(30, 'NAIM', 'NAIM'),
(31, 'VK', 'VK'),
(32, 'MAWA', 'MAWA'),
(33, 'PERISTI', 'PERISTI'),
(34, 'DRSLLM', 'DARUSSALAM'),
(35, 'IT', 'IT'),
(36, 'CS', 'Customer Service'),
(37, 'LNDRY', 'Laundry'),
(38, 'CCSD', 'CCSD');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `id_unit` int(11) DEFAULT NULL,
  `id_vendor` int(11) DEFAULT NULL,
  `ttd` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `nama_lengkap`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `id_unit`, `id_vendor`, `ttd`, `foto`) VALUES
(1, '127.0.0.1', 'staff', 'Putri Wapa, A.Md, Tem', '$2y$10$aBtR.PqzP0FMJGXFCZKK8uDg9CvaSrrHwGW5/0/soE6jxle84RV7K', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1696216064, 1, 'Admin', 'istrator', 'ADMIN', '0', NULL, NULL, 'logo_pt1.png', 'kisspng-flag-of-indonesia-portable-network-graphics-flag-o-cupping-therapy-method-can-cure-diabetes-mellitus-5ba9e034b71357_9580860615378596367499.jpg'),
(6, '::1', 'kabag', 'Indra Zulkhan , SE', '$2y$10$HGBa.hKuR5RQL5yux0YEyuAvycRDch4oXRLmR2ONtp1wFcP7RlT4i', 'kabag@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1693785028, 1696206588, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'user.png', ''),
(7, '::1', 'unit', 'Reza Rifani, Amd', '$2y$10$pPYaHXROBXAf54B4qun2/.ExwvmXMN8QeWs9GV9WIeoCJ56s80gJq', 'unit@unit.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1693785094, 1696206438, 1, NULL, NULL, NULL, NULL, 6, NULL, 'WhatsApp_Image_2023-09-01_at_19_05_58_(1)1.jpeg', ''),
(10, '::1', 'vendor', 'Rizki Fauzi', '$2y$10$oPGIGCDmr59HSOyWaZHum.KB8S369yYv7IofuWypCXpfkZceT23jy', 'vendor@vendor.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1693962128, 1696206692, 1, NULL, NULL, NULL, NULL, NULL, 1, 'favicon.png', ''),
(14, '::1', 'direktur', 'dr. Rifqiannor, MARS', '$2y$10$gkQAk11y99jyBlLzXsy2jerrq09DPRNpeZ/E5WSxcLLUP.TOfYKIi', 'direktur@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1694070426, 1696206649, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'WhatsApp_Image_2023-09-01_at_19_05_58_(1).jpeg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(2, 1, 2),
(36, 6, 3),
(37, 7, 1),
(27, 10, 5),
(30, 14, 4);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(20) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `situs_web` varchar(50) DEFAULT NULL,
  `catatan` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `nama`, `alamat`, `no_telp`, `email`, `situs_web`, `catatan`) VALUES
(1, 'PT. ABC Delimaa', 'Jl. Sutoyo S', '082157820897', 'abc@abc.com', 'abc.com', '-');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `detail_pengajuan`
--
ALTER TABLE `detail_pengajuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_detail_pengajuan_barang` (`id_barang`),
  ADD KEY `kode_pengajuan` (`id_pengajuan`) USING BTREE;

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penyerahan_barang`
--
ALTER TABLE `penyerahan_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_penyerahan_barang_pengajuan` (`id_pengajuan`),
  ADD KEY `FK_penyerahan_barang_unit` (`kode_unit`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `temp_detailpengajuan`
--
ALTER TABLE `temp_detailpengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `detail_pengajuan`
--
ALTER TABLE `detail_pengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penyerahan_barang`
--
ALTER TABLE `penyerahan_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `temp_detailpengajuan`
--
ALTER TABLE `temp_detailpengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pengajuan`
--
ALTER TABLE `detail_pengajuan`
  ADD CONSTRAINT `FK_detail_pengajuan_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `FK_detail_pengajuan_pengajuan` FOREIGN KEY (`id_pengajuan`) REFERENCES `pengajuan` (`id`);

--
-- Constraints for table `penyerahan_barang`
--
ALTER TABLE `penyerahan_barang`
  ADD CONSTRAINT `FK_penyerahan_barang_pengajuan` FOREIGN KEY (`id_pengajuan`) REFERENCES `pengajuan` (`id`),
  ADD CONSTRAINT `FK_penyerahan_barang_unit` FOREIGN KEY (`kode_unit`) REFERENCES `unit` (`id_unit`);

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
