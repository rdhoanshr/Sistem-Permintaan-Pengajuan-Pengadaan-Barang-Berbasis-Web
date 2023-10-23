-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.0.33 - MySQL Community Server - GPL
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
CREATE DATABASE IF NOT EXISTS `db_pengadaan` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_pengadaan`;

-- membuang struktur untuk table db_pengadaan.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `id_barang` int NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(50) DEFAULT NULL,
  `nama_barang` varchar(50) DEFAULT NULL,
  `id_jenis` int DEFAULT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_pengadaan.barang: ~6 rows (lebih kurang)
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
INSERT INTO `barang` (`id_barang`, `kode_barang`, `nama_barang`, `id_jenis`, `satuan`, `keterangan`) VALUES
	(1, 'B001', 'HP', 1, 'Set', 'Komputer'),
	(2, 'B002', 'Oxygen', 1, 'Tabung', 'Tabung Oxygen'),
	(5, 'B004', 'Laptop', 1, 'Pcs', 'laptop kerja'),
	(7, '123', 'JKA', 1, '231', '123'),
	(8, 'asas', 'as', 6, 'Satuan 12', 'Usaha Warung 1'),
	(10, 'TES', 'TESS', 5, '1', 'Rusak');
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;

-- membuang struktur untuk table db_pengadaan.detail_pengajuan
CREATE TABLE IF NOT EXISTS `detail_pengajuan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pengajuan` int DEFAULT NULL,
  `id_barang` int DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `biaya` decimal(10,0) DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `qty_vendor` int DEFAULT NULL,
  `harga_vendor` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_detail_pengajuan_barang` (`id_barang`),
  KEY `kode_pengajuan` (`id_pengajuan`) USING BTREE,
  CONSTRAINT `FK_detail_pengajuan_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_detail_pengajuan_pengajuan` FOREIGN KEY (`id_pengajuan`) REFERENCES `pengajuan` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_pengadaan.detail_pengajuan: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `detail_pengajuan` DISABLE KEYS */;
INSERT INTO `detail_pengajuan` (`id`, `id_pengajuan`, `id_barang`, `jumlah`, `biaya`, `id_user`, `qty_vendor`, `harga_vendor`) VALUES
	(1, 1, 2, 10, 9000000, 7, NULL, NULL),
	(2, 2, 5, 31, 97, 7, NULL, NULL);
/*!40000 ALTER TABLE `detail_pengajuan` ENABLE KEYS */;

-- membuang struktur untuk table db_pengadaan.groups
CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Membuang data untuk tabel db_pengadaan.groups: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`, `name`, `description`) VALUES
	(1, 'unit', 'Unit'),
	(2, 'staff', 'Staff Pengadaan'),
	(3, 'kabag', 'Kepala Bagian'),
	(4, 'direktur', 'Direktur');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;

-- membuang struktur untuk table db_pengadaan.jenis_barang
CREATE TABLE IF NOT EXISTS `jenis_barang` (
  `id_jenis` int NOT NULL AUTO_INCREMENT,
  `nama_jenisbarang` varchar(255) NOT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_pengadaan.jenis_barang: ~4 rows (lebih kurang)
/*!40000 ALTER TABLE `jenis_barang` DISABLE KEYS */;
INSERT INTO `jenis_barang` (`id_jenis`, `nama_jenisbarang`) VALUES
	(1, 'Komputer 1'),
	(3, 'Akay'),
	(5, 'TAS'),
	(6, 'Mouse');
/*!40000 ALTER TABLE `jenis_barang` ENABLE KEYS */;

-- membuang struktur untuk table db_pengadaan.login_attempts
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Membuang data untuk tabel db_pengadaan.login_attempts: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;

-- membuang struktur untuk table db_pengadaan.pengajuan
CREATE TABLE IF NOT EXISTS `pengajuan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_pengajuan` varchar(50) DEFAULT NULL,
  `pengajuan` varchar(50) DEFAULT NULL,
  `jenis_pengajuan` varchar(50) DEFAULT NULL,
  `tgl_pengajuan` date DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `total` decimal(10,0) DEFAULT NULL,
  `verifikasi_1` int DEFAULT NULL,
  `verifikasi_2` int DEFAULT NULL,
  `verifikasi_3` int DEFAULT NULL,
  `memo_2` varchar(50) DEFAULT NULL,
  `memo_3` varchar(50) DEFAULT NULL,
  `catatan_2` text,
  `catatan_3` text,
  `alasan_1` text,
  `alasan_2` text,
  `alasan_3` text,
  `status` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `id_vendor` int DEFAULT NULL,
  `user_vendor` int DEFAULT NULL,
  `no_faktur` varchar(50) DEFAULT NULL,
  `tgl_faktur` date DEFAULT NULL,
  `total_vendor` decimal(10,0) DEFAULT NULL,
  `rekomendasi` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_pengadaan.pengajuan: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `pengajuan` DISABLE KEYS */;
INSERT INTO `pengajuan` (`id`, `kode_pengajuan`, `pengajuan`, `jenis_pengajuan`, `tgl_pengajuan`, `keterangan`, `total`, `verifikasi_1`, `verifikasi_2`, `verifikasi_3`, `memo_2`, `memo_3`, `catatan_2`, `catatan_3`, `alasan_1`, `alasan_2`, `alasan_3`, `status`, `id_user`, `id_vendor`, `user_vendor`, `no_faktur`, `tgl_faktur`, `total_vendor`, `rekomendasi`) VALUES
	(1, '001/IGD/RSI-SA/06/X/2023', 'Tahu', 'Barang habis pakai', '2023-10-23', 'Untuk pengadaan lab', 9000000, 1, 6, NULL, '001/RSI-SA/06/X/2023', NULL, 'Oke', NULL, 'Keterangan tidak jelas', 'Nama Pengajuan tidak jelas', 'Nama masih salah', 13, 7, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, '002/IGD/RSI-SA/06/X/2023', 'Optio consequatur ', 'Barang habis pakai', '2023-10-23', 'Est impedit alias ', 97, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 7, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `pengajuan` ENABLE KEYS */;

-- membuang struktur untuk table db_pengadaan.penyerahan_barang
CREATE TABLE IF NOT EXISTS `penyerahan_barang` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pengajuan` int DEFAULT NULL,
  `kode_unit` int DEFAULT NULL,
  `tanggal_penyerahan` date DEFAULT NULL,
  `tanggal_terima` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_penyerahan_barang_pengajuan` (`id_pengajuan`),
  KEY `FK_penyerahan_barang_unit` (`kode_unit`),
  CONSTRAINT `FK_penyerahan_barang_pengajuan` FOREIGN KEY (`id_pengajuan`) REFERENCES `pengajuan` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_penyerahan_barang_unit` FOREIGN KEY (`kode_unit`) REFERENCES `unit` (`id_unit`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_pengadaan.penyerahan_barang: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `penyerahan_barang` DISABLE KEYS */;
/*!40000 ALTER TABLE `penyerahan_barang` ENABLE KEYS */;

-- membuang struktur untuk table db_pengadaan.surat
CREATE TABLE IF NOT EXISTS `surat` (
  `id_surat` int NOT NULL AUTO_INCREMENT,
  `no_surat` varchar(50) DEFAULT NULL,
  `ttd_pengaju` varchar(255) DEFAULT NULL,
  `ttd_aprover` varchar(255) DEFAULT NULL,
  `tgl_pengajuan` date DEFAULT NULL,
  `tgl_persetujuan` date DEFAULT NULL,
  PRIMARY KEY (`id_surat`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_pengadaan.surat: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `surat` DISABLE KEYS */;
INSERT INTO `surat` (`id_surat`, `no_surat`, `ttd_pengaju`, `ttd_aprover`, `tgl_pengajuan`, `tgl_persetujuan`) VALUES
	(1, '001/IGD/RSI-SA/06/X/2023', 'WhatsApp_Image_2023-09-01_at_19_05_58_(1)1.jpeg', NULL, '2023-10-23', NULL),
	(2, '002/IGD/RSI-SA/06/X/2023', 'WhatsApp_Image_2023-09-01_at_19_05_58_(1)1.jpeg', NULL, '2023-10-23', NULL);
/*!40000 ALTER TABLE `surat` ENABLE KEYS */;

-- membuang struktur untuk table db_pengadaan.temp_detailpengajuan
CREATE TABLE IF NOT EXISTS `temp_detailpengajuan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pengajuan` int DEFAULT NULL,
  `id_barang` int DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `biaya` decimal(10,0) DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_pengadaan.temp_detailpengajuan: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `temp_detailpengajuan` DISABLE KEYS */;
/*!40000 ALTER TABLE `temp_detailpengajuan` ENABLE KEYS */;

-- membuang struktur untuk table db_pengadaan.unit
CREATE TABLE IF NOT EXISTS `unit` (
  `id_unit` int NOT NULL AUTO_INCREMENT,
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
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int unsigned DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int unsigned NOT NULL,
  `last_login` int unsigned DEFAULT NULL,
  `active` tinyint unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `id_unit` int DEFAULT NULL,
  `id_vendor` int DEFAULT NULL,
  `ttd` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_email` (`email`),
  UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  UNIQUE KEY `uc_remember_selector` (`remember_selector`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

-- Membuang data untuk tabel db_pengadaan.users: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `ip_address`, `username`, `nama_lengkap`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `id_unit`, `id_vendor`, `ttd`, `foto`) VALUES
	(1, '127.0.0.1', 'staff', 'Putri Wapa, A.Md, Tem', '$2y$10$aBtR.PqzP0FMJGXFCZKK8uDg9CvaSrrHwGW5/0/soE6jxle84RV7K', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1698065916, 1, 'Admin', 'istrator', 'ADMIN', '0', NULL, NULL, '1103417904.jpg', 'user1.png'),
	(6, '::1', 'kabag', 'Indra Zulkhan , SE', '$2y$10$HGBa.hKuR5RQL5yux0YEyuAvycRDch4oXRLmR2ONtp1wFcP7RlT4i', 'kabag@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1693785028, 1698063333, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'user.png', ''),
	(7, '::1', 'unit', 'Dede', '$2y$10$pPYaHXROBXAf54B4qun2/.ExwvmXMN8QeWs9GV9WIeoCJ56s80gJq', 'unit@unit.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1693785094, 1698061171, 1, NULL, NULL, NULL, NULL, 6, NULL, 'WhatsApp_Image_2023-09-01_at_19_05_58_(1)1.jpeg', ''),
	(14, '::1', 'direktur', 'dr. Rifqiannor, MARS', '$2y$10$gkQAk11y99jyBlLzXsy2jerrq09DPRNpeZ/E5WSxcLLUP.TOfYKIi', 'direktur@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1694070426, 1698063374, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'WhatsApp_Image_2023-09-01_at_19_05_58_(1).jpeg', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- membuang struktur untuk table db_pengadaan.users_groups
CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `group_id` mediumint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb3;

-- Membuang data untuk tabel db_pengadaan.users_groups: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
	(2, 1, 2),
	(36, 6, 3),
	(38, 7, 1),
	(30, 14, 4);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;

-- membuang struktur untuk table db_pengadaan.vendor
CREATE TABLE IF NOT EXISTS `vendor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` text,
  `no_telp` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `situs_web` varchar(50) DEFAULT NULL,
  `catatan` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_pengadaan.vendor: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `vendor` DISABLE KEYS */;
INSERT INTO `vendor` (`id`, `kode`, `nama`, `alamat`, `no_telp`, `email`, `situs_web`, `catatan`) VALUES
	(1, 'V001', 'PT. ABC Delimaa', 'Jl. Sutoyo S', '082157820897', 'abc@abc.com', 'abc.com', '-'),
	(3, 'V002', 'PT. ABC Delim', 'dadadas', '08213218378213', 'a@a.com', '--', '-');
/*!40000 ALTER TABLE `vendor` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
