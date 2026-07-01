-- SQL Dump for Liberchain Database
-- Generated automatically on 2026-06-22 12:26:06

CREATE DATABASE IF NOT EXISTS `liberchain`;
USE `liberchain`;

DROP TABLE IF EXISTS `tb_lahan`;
CREATE TABLE `tb_lahan` (
  `id_lahan` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `status_lahan` varchar(20) DEFAULT 'Active',
  PRIMARY KEY (`id_lahan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `tb_mitra`;
CREATE TABLE `tb_mitra` (
  `id_mitra` int(11) NOT NULL AUTO_INCREMENT,
  `status_mitra` varchar(20) DEFAULT 'Active',
  PRIMARY KEY (`id_mitra`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table `tb_mitra`
INSERT INTO `tb_mitra` (`id_mitra`, `status_mitra`) VALUES ('1', 'Active');
INSERT INTO `tb_mitra` (`id_mitra`, `status_mitra`) VALUES ('2', 'Active');
INSERT INTO `tb_mitra` (`id_mitra`, `status_mitra`) VALUES ('3', 'Inactive');

DROP TABLE IF EXISTS `tb_notifikasi`;
CREATE TABLE `tb_notifikasi` (
  `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `isi_notifikasi` text NOT NULL,
  `status_baca` enum('0','1') NOT NULL DEFAULT '0',
  `tanggal_buat` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_notifikasi`),
  KEY `id_user_idx` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `tb_panen`;
CREATE TABLE `tb_panen` (
  `id_panen` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `jumlah_panen` int(11) DEFAULT 0,
  PRIMARY KEY (`id_panen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `tb_petani`;
CREATE TABLE `tb_petani` (
  `id_petani` int(11) NOT NULL AUTO_INCREMENT,
  `nama_petani` varchar(100) NOT NULL,
  `status_petani` varchar(20) DEFAULT 'Pending',
  `tanggal_daftar` date DEFAULT curdate(),
  PRIMARY KEY (`id_petani`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table `tb_petani`
INSERT INTO `tb_petani` (`id_petani`, `nama_petani`, `status_petani`, `tanggal_daftar`) VALUES ('1', 'Ahmad Fauzi', 'Pending', '2026-06-22');
INSERT INTO `tb_petani` (`id_petani`, `nama_petani`, `status_petani`, `tanggal_daftar`) VALUES ('2', 'Supardi', 'Active', '2026-06-22');
INSERT INTO `tb_petani` (`id_petani`, `nama_petani`, `status_petani`, `tanggal_daftar`) VALUES ('3', 'Dewi Lestari', 'Active', '2026-06-22');

DROP TABLE IF EXISTS `tb_produk`;
CREATE TABLE `tb_produk` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `stok_produk` int(11) DEFAULT 0,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `tb_setting_notifikasi`;
CREATE TABLE `tb_setting_notifikasi` (
  `id_user` int(11) NOT NULL,
  `notif_transaksi` tinyint(1) NOT NULL DEFAULT 1,
  `notif_pembayaran` tinyint(1) DEFAULT 1,
  `notif_stok` tinyint(1) NOT NULL DEFAULT 1,
  `notif_kurir` tinyint(1) DEFAULT 1,
  `notif_petani` tinyint(1) DEFAULT 1,
  `notif_promo` tinyint(1) DEFAULT 0,
  `notif_laporan` tinyint(1) DEFAULT 0,
  `notif_sistem` tinyint(1) NOT NULL DEFAULT 1,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table `tb_setting_notifikasi`
INSERT INTO `tb_setting_notifikasi` (`id_user`, `notif_transaksi`, `notif_pembayaran`, `notif_stok`, `notif_kurir`, `notif_petani`, `notif_promo`, `notif_laporan`, `notif_sistem`, `updated_at`) VALUES ('1', '1', '1', '1', '1', '1', '0', '0', '1', '2026-06-22 08:16:38');
INSERT INTO `tb_setting_notifikasi` (`id_user`, `notif_transaksi`, `notif_pembayaran`, `notif_stok`, `notif_kurir`, `notif_petani`, `notif_promo`, `notif_laporan`, `notif_sistem`, `updated_at`) VALUES ('3', '1', '1', '1', '1', '1', '0', '0', '1', '2026-06-22 08:16:38');

DROP TABLE IF EXISTS `tb_transaksi`;
CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `total_harga` int(11) DEFAULT 0,
  `status_pesanan` varchar(50) DEFAULT 'Pending',
  `metode_bayar` varchar(50) DEFAULT 'Transfer',
  PRIMARY KEY (`id_transaksi`),
  KEY `idx_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table `tb_transaksi`
INSERT INTO `tb_transaksi` (`id_transaksi`, `id_user`, `total_harga`, `status_pesanan`, `metode_bayar`) VALUES ('1', NULL, '15000000', 'Diproses', 'Transfer Bank');
INSERT INTO `tb_transaksi` (`id_transaksi`, `id_user`, `total_harga`, `status_pesanan`, `metode_bayar`) VALUES ('2', NULL, '25000000', 'Dikirim', 'E-Wallet');
INSERT INTO `tb_transaksi` (`id_transaksi`, `id_user`, `total_harga`, `status_pesanan`, `metode_bayar`) VALUES ('3', NULL, '14200000', 'Pending', 'COD');

DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('Admin','Petani','Pembeli') NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive','Pending') DEFAULT 'Pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `tb_user`
INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama`, `email`, `role`, `foto`, `status`, `created_at`, `updated_at`) VALUES ('1', 'admin', '0192023a7bbd73250516f069df18b500', 'Ketua Poktan', 'admin@poktan.com', 'Admin', NULL, 'Active', '2026-06-22 08:16:38', '2026-06-22 08:16:38');
INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama`, `email`, `role`, `foto`, `status`, `created_at`, `updated_at`) VALUES ('2', 'petani', 'e24f980d21884c0fff8a3048f21822bf', 'Ahmad Petani', 'petani@poktan.com', 'Petani', NULL, 'Active', '2026-06-22 08:16:38', '2026-06-22 08:16:38');
INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama`, `email`, `role`, `foto`, `status`, `created_at`, `updated_at`) VALUES ('3', 'pembeli', '547ea1ce04c68f6bda9e2da0d1f253f5', 'Budi Pembeli', 'pembeli@poktan.com', 'Pembeli', NULL, 'Active', '2026-06-22 08:16:38', '2026-06-22 08:16:38');

