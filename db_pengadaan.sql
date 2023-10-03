-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 5.7.33 - MySQL Community Server (GPL)
-- OS Server:                    Win64
-- HeidiSQL Versi:               11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk db_pengadaan
CREATE DATABASE IF NOT EXISTS `db_pengadaan` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_pengadaan`;

-- membuang struktur untuk table db_pengadaan.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(50) DEFAULT NULL,
  `nama_barang` varchar(50) DEFAULT NULL,
  `jenis_barang` varchar(50) DEFAULT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_pengadaan.barang: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
INSERT INTO `barang` (`id_barang`, `kode_barang`, `nama_barang`, `jenis_barang`, `satuan`, `keterangan`) VALUES
	(1, 'B001', 'HP', 'Komputer', 'Set', 'Komputer'),
	(2, 'B002', 'Oxygen', 'Alat Kesehatan', 'Tabung', 'Tabung Oxygen'),
	(5, 'B004', 'Laptop', 'Alat Elektronik', 'Pcs', 'laptop kerja');
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;

-- membuang struktur untuk table db_pengadaan.detail_pengajuan
CREATE TABLE IF NOT EXISTS `detail_pengajuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengajuan` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `biaya` decimal(10,0) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `qty_vendor` int(11) DEFAULT NULL,
  `harga_vendor` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_detail_pengajuan_barang` (`id_barang`),
  KEY `kode_pengajuan` (`id_pengajuan`) USING BTREE,
  CONSTRAINT `FK_detail_pengajuan_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  CONSTRAINT `FK_detail_pengajuan_pengajuan` FOREIGN KEY (`id_pengajuan`) REFERENCES `pengajuan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_pengadaan.detail_pengajuan: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `detail_pengajuan` DISABLE KEYS */;
INSERT INTO `detail_pengajuan` (`id`, `id_pengajuan`, `id_barang`, `jumlah`, `biaya`, `id_user`, `qty_vendor`, `harga_vendor`) VALUES
	(29, 1, 1, 5, 25000000, 7, NULL, NULL),
	(30, 1, 5, 2, 8000000, 7, NULL, NULL);
/*!40000 ALTER TABLE `detail_pengajuan` ENABLE KEYS */;

-- membuang struktur untuk table db_pengadaan.groups
CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_pengadaan.groups: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`, `name`, `description`) VALUES
	(1, 'unit', 'Unit'),
	(2, 'staff', 'Staff Pengadaan'),
	(3, 'kabag', 'Kepala Bagian'),
	(4, 'direktur', 'Direktur'),
	(5, 'vendor', 'Vendor');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;

-- membuang struktur untuk table db_pengadaan.login_attempts
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_pengadaan.login_attempts: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;

-- membuang struktur untuk table db_pengadaan.pengajuan
CREATE TABLE IF NOT EXISTS `pengajuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `catatan_2` text,
  `catatan_3` text,
  `status` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_vendor` int(11) DEFAULT NULL,
  `user_vendor` int(11) DEFAULT NULL,
  `no_faktur` varchar(50) DEFAULT NULL,
  `tgl_faktur` date DEFAULT NULL,
  `total_vendor` decimal(10,0) DEFAULT NULL,
  `rekomendasi` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_pengadaan.pengajuan: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `pengajuan` DISABLE KEYS */;
INSERT INTO `pengajuan` (`id`, `kode_pengajuan`, `pengajuan`, `jenis_pengajuan`, `tgl_pengajuan`, `keterangan`, `total`, `verifikasi_1`, `verifikasi_2`, `verifikasi_3`, `memo_2`, `memo_3`, `catatan_2`, `catatan_3`, `status`, `id_user`, `id_vendor`, `user_vendor`, `no_faktur`, `tgl_faktur`, `total_vendor`, `rekomendasi`) VALUES
	(1, '001/IGD/RSI-SA/06/X/2023', 'Pengadaan Ruang Rapat', 'Alat Elektronik', '2023-10-03', 'Penambahan Perangkat Komputer', 33000000, 1, 6, 14, '001/RSI-SA/06/X/2023', '001/RSI-SA/06/X/2023', 'Ok Lanjut!', 'Approved', 1, 7, 1, 10, '23/10001', '2023-10-03', NULL, NULL);
/*!40000 ALTER TABLE `pengajuan` ENABLE KEYS */;

-- membuang struktur untuk table db_pengadaan.penyerahan_barang
CREATE TABLE IF NOT EXISTS `penyerahan_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengajuan` int(11) DEFAULT NULL,
  `kode_unit` int(11) DEFAULT NULL,
  `tanggal_penyerahan` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_penyerahan_barang_pengajuan` (`id_pengajuan`),
  KEY `FK_penyerahan_barang_unit` (`kode_unit`),
  CONSTRAINT `FK_penyerahan_barang_pengajuan` FOREIGN KEY (`id_pengajuan`) REFERENCES `pengajuan` (`id`),
  CONSTRAINT `FK_penyerahan_barang_unit` FOREIGN KEY (`kode_unit`) REFERENCES `unit` (`id_unit`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_pengadaan.penyerahan_barang: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `penyerahan_barang` DISABLE KEYS */;
INSERT INTO `penyerahan_barang` (`id`, `id_pengajuan`, `kode_unit`, `tanggal_penyerahan`) VALUES
	(6, 1, 6, '2023-10-03');
/*!40000 ALTER TABLE `penyerahan_barang` ENABLE KEYS */;

-- membuang struktur untuk table db_pengadaan.surat
CREATE TABLE IF NOT EXISTS `surat` (
  `id_surat` int(11) NOT NULL AUTO_INCREMENT,
  `no_surat` varchar(50) DEFAULT NULL,
  `ttd_pengaju` varchar(255) DEFAULT NULL,
  `ttd_aprover` varchar(255) DEFAULT NULL,
  `tgl_pengajuan` date DEFAULT NULL,
  `tgl_persetujuan` date DEFAULT NULL,
  PRIMARY KEY (`id_surat`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_pengadaan.surat: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `surat` DISABLE KEYS */;
INSERT INTO `surat` (`id_surat`, `no_surat`, `ttd_pengaju`, `ttd_aprover`, `tgl_pengajuan`, `tgl_persetujuan`) VALUES
	(18, '001/IGD/RSI-SA/06/X/2023', 'WhatsApp_Image_2023-09-01_at_19_05_58_(1)1.jpeg', 'WhatsApp_Image_2023-09-01_at_19_05_58_(1).jpeg', '2023-10-03', '2023-10-03');
/*!40000 ALTER TABLE `surat` ENABLE KEYS */;

-- membuang struktur untuk table db_pengadaan.temp_detailpengajuan
CREATE TABLE IF NOT EXISTS `temp_detailpengajuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengajuan` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `biaya` decimal(10,0) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_pengadaan.temp_detailpengajuan: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `temp_detailpengajuan` DISABLE KEYS */;
/*!40000 ALTER TABLE `temp_detailpengajuan` ENABLE KEYS */;

-- membuang struktur untuk table db_pengadaan.unit
CREATE TABLE IF NOT EXISTS `unit` (
  `id_unit` int(11) NOT NULL AUTO_INCREMENT,
  `kode_unit` varchar(50) DEFAULT NULL,
  `nama_unit` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_unit`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_pengadaan.unit: ~38 rows (lebih kurang)
/*!40000 ALTER TABLE `unit` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `unit` ENABLE KEYS */;

-- membuang struktur untuk table db_pengadaan.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `id_unit` int(11) DEFAULT NULL,
  `id_vendor` int(11) DEFAULT NULL,
  `ttd` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_email` (`email`),
  UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  UNIQUE KEY `uc_remember_selector` (`remember_selector`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_pengadaan.users: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `ip_address`, `username`, `nama_lengkap`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `id_unit`, `id_vendor`, `ttd`, `foto`) VALUES
	(1, '127.0.0.1', 'staff', 'Putri Wapa, A.Md, Tem', '$2y$10$aBtR.PqzP0FMJGXFCZKK8uDg9CvaSrrHwGW5/0/soE6jxle84RV7K', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1696308457, 1, 'Admin', 'istrator', 'ADMIN', '0', NULL, NULL, 'logo_pt1.png', 'kisspng-flag-of-indonesia-portable-network-graphics-flag-o-cupping-therapy-method-can-cure-diabetes-mellitus-5ba9e034b71357_9580860615378596367499.jpg'),
	(6, '::1', 'kabag', 'Indra Zulkhan , SE', '$2y$10$HGBa.hKuR5RQL5yux0YEyuAvycRDch4oXRLmR2ONtp1wFcP7RlT4i', 'kabag@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1693785028, 1696272041, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'user.png', ''),
	(7, '::1', 'unit', 'Reza Rifani, Amd', '$2y$10$pPYaHXROBXAf54B4qun2/.ExwvmXMN8QeWs9GV9WIeoCJ56s80gJq', 'unit@unit.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1693785094, 1696272450, 1, NULL, NULL, NULL, NULL, 6, NULL, 'WhatsApp_Image_2023-09-01_at_19_05_58_(1)1.jpeg', ''),
	(10, '::1', 'vendor', 'Rizki Fauzi', '$2y$10$oPGIGCDmr59HSOyWaZHum.KB8S369yYv7IofuWypCXpfkZceT23jy', 'vendor@vendor.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1693962128, 1696272147, 1, NULL, NULL, NULL, NULL, NULL, 1, 'favicon.png', ''),
	(14, '::1', 'direktur', 'dr. Rifqiannor, MARS', '$2y$10$gkQAk11y99jyBlLzXsy2jerrq09DPRNpeZ/E5WSxcLLUP.TOfYKIi', 'direktur@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1694070426, 1696272079, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'WhatsApp_Image_2023-09-01_at_19_05_58_(1).jpeg', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- membuang struktur untuk table db_pengadaan.users_groups
CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_pengadaan.users_groups: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
	(2, 1, 2),
	(36, 6, 3),
	(37, 7, 1),
	(27, 10, 5),
	(30, 14, 4);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;

-- membuang struktur untuk table db_pengadaan.vendor
CREATE TABLE IF NOT EXISTS `vendor` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` text,
  `no_telp` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `situs_web` varchar(50) DEFAULT NULL,
  `catatan` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_pengadaan.vendor: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `vendor` DISABLE KEYS */;
INSERT INTO `vendor` (`id`, `kode`, `nama`, `alamat`, `no_telp`, `email`, `situs_web`, `catatan`) VALUES
	(1, 'V001', 'PT. ABC Delimaa', 'Jl. Sutoyo S', '082157820897', 'abc@abc.com', 'abc.com', '-'),
	(3, 'V002', 'PT. ABC Delim', 'dadadas', '08213218378213', 'a@a.com', '--', '-');
/*!40000 ALTER TABLE `vendor` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
