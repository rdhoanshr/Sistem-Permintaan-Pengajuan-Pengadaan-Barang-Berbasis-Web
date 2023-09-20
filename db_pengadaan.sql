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
  `nama_barang` varchar(50) DEFAULT NULL,
  `jenis_barang` varchar(50) DEFAULT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_pengadaan.barang: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
INSERT INTO `barang` (`id_barang`, `nama_barang`, `jenis_barang`, `satuan`, `keterangan`) VALUES
	(1, 'Oxygen', 'Alat Kesehatan', 'Tabung', 'Tabung Oxygen'),
	(2, 'Oxygen', 'Alat Kesehatan', '1', 'Tabung Oxygen'),
	(4, 'Voluptates in sequi ', 'Ullam eius aut iure ', 'Accusantium beatae i', 'Ratione exercitation');
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_pengadaan.detail_pengajuan: ~4 rows (lebih kurang)
/*!40000 ALTER TABLE `detail_pengajuan` DISABLE KEYS */;
INSERT INTO `detail_pengajuan` (`id`, `id_pengajuan`, `id_barang`, `jumlah`, `biaya`, `id_user`, `qty_vendor`, `harga_vendor`) VALUES
	(11, 1, 1, 12, 90123000, 7, NULL, NULL),
	(12, 1, 2, 21, 9000000, 7, NULL, NULL),
	(15, 1, 4, 1, 200000, 7, NULL, NULL),
	(16, 2, 1, 20, 83, 7, NULL, NULL);
/*!40000 ALTER TABLE `detail_pengajuan` ENABLE KEYS */;

-- membuang struktur untuk table db_pengadaan.groups
CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_pengadaan.groups: ~4 rows (lebih kurang)
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `status` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_vendor` int(11) DEFAULT NULL,
  `total_vendor` decimal(10,0) DEFAULT NULL,
  `rekomendasi` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_pengadaan.pengajuan: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `pengajuan` DISABLE KEYS */;
INSERT INTO `pengajuan` (`id`, `kode_pengajuan`, `pengajuan`, `jenis_pengajuan`, `tgl_pengajuan`, `keterangan`, `total`, `verifikasi_1`, `verifikasi_2`, `verifikasi_3`, `status`, `id_user`, `id_vendor`, `total_vendor`, `rekomendasi`) VALUES
	(1, '004/PB/9/2023', 'Pengadaan Kantin', 'Fisik', '2023-09-07', 'Kantin Baru', 99323000, 1, 6, 14, 1, 7, 1, NULL, NULL),
	(2, '005/PB/9/2023', 'Voluptatem ipsam rer', 'Fugiat repellendus', '2023-09-07', 'Est itaque dolor la', 83, NULL, NULL, NULL, 0, 7, NULL, NULL, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_pengadaan.penyerahan_barang: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `penyerahan_barang` DISABLE KEYS */;
INSERT INTO `penyerahan_barang` (`id`, `id_pengajuan`, `kode_unit`, `tanggal_penyerahan`) VALUES
	(1, 1, 1, '2023-09-20');
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_pengadaan.surat: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `surat` DISABLE KEYS */;
INSERT INTO `surat` (`id_surat`, `no_surat`, `ttd_pengaju`, `ttd_aprover`, `tgl_pengajuan`, `tgl_persetujuan`) VALUES
	(9, '004/PB/9/2023', 'WhatsApp_Image_2023-09-01_at_19_05_58_(1)1.jpeg', 'WhatsApp_Image_2023-09-01_at_19_05_58_(1).jpeg', '2023-09-07', '2023-09-07'),
	(10, '005/PB/9/2023', 'WhatsApp_Image_2023-09-01_at_19_05_58_(1)1.jpeg', NULL, '2023-09-07', NULL);
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_pengadaan.temp_detailpengajuan: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `temp_detailpengajuan` DISABLE KEYS */;
/*!40000 ALTER TABLE `temp_detailpengajuan` ENABLE KEYS */;

-- membuang struktur untuk table db_pengadaan.unit
CREATE TABLE IF NOT EXISTS `unit` (
  `id_unit` int(11) NOT NULL AUTO_INCREMENT,
  `nama_unit` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_unit`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_pengadaan.unit: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `unit` DISABLE KEYS */;
INSERT INTO `unit` (`id_unit`, `nama_unit`) VALUES
	(1, 'IGD'),
	(2, 'Farmasi');
/*!40000 ALTER TABLE `unit` ENABLE KEYS */;

-- membuang struktur untuk table db_pengadaan.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_email` (`email`),
  UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  UNIQUE KEY `uc_remember_selector` (`remember_selector`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_pengadaan.users: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `id_unit`, `id_vendor`, `ttd`) VALUES
	(1, '127.0.0.1', 'staff', '$2y$10$aBtR.PqzP0FMJGXFCZKK8uDg9CvaSrrHwGW5/0/soE6jxle84RV7K', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1695207976, 1, 'Admin', 'istrator', 'ADMIN', '0', NULL, NULL, ''),
	(6, '::1', 'kabag', '$2y$10$HGBa.hKuR5RQL5yux0YEyuAvycRDch4oXRLmR2ONtp1wFcP7RlT4i', 'kabag@gmai.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1693785028, 1695209379, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(7, '::1', 'unit', '$2y$10$pPYaHXROBXAf54B4qun2/.ExwvmXMN8QeWs9GV9WIeoCJ56s80gJq', 'unit@unit.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1693785094, 1695209362, 1, NULL, NULL, NULL, NULL, 1, NULL, 'WhatsApp_Image_2023-09-01_at_19_05_58_(1)1.jpeg'),
	(10, '::1', 'vendor', '$2y$10$oPGIGCDmr59HSOyWaZHum.KB8S369yYv7IofuWypCXpfkZceT23jy', 'vendor@vendor.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1693962128, 1695207406, 1, NULL, NULL, NULL, NULL, NULL, 1, NULL),
	(14, '::1', 'direktur', '$2y$10$gkQAk11y99jyBlLzXsy2jerrq09DPRNpeZ/E5WSxcLLUP.TOfYKIi', 'direktur@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1694070426, 1694883971, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'WhatsApp_Image_2023-09-01_at_19_05_58_(1).jpeg');
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel db_pengadaan.users_groups: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
	(2, 1, 2),
	(12, 6, 3),
	(13, 7, 1),
	(27, 10, 5),
	(30, 14, 4);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;

-- membuang struktur untuk table db_pengadaan.vendor
CREATE TABLE IF NOT EXISTS `vendor` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `situs_web` varchar(50) DEFAULT NULL,
  `catatan` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_pengadaan.vendor: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `vendor` DISABLE KEYS */;
INSERT INTO `vendor` (`id`, `nama`, `alamat`, `no_telp`, `email`, `situs_web`, `catatan`) VALUES
	(1, 'PT. ABCD', 'Banjarmasin', '081232312839', 'abc@abc.com', 'abc.com', '-');
/*!40000 ALTER TABLE `vendor` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
