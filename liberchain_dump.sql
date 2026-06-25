-- Database Dump untuk liberchain

DROP TABLE IF EXISTS `tb_kurir`;

CREATE TABLE `tb_kurir` (
  `id_kurir` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kurir` varchar(100) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` enum('Active','Inactive','Offline') DEFAULT 'Offline',
  `lokasi_terakhir` varchar(255) DEFAULT NULL,
  `lat_terakhir` decimal(10,8) DEFAULT NULL,
  `lng_terakhir` decimal(11,8) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_kurir`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tb_kurir` VALUES("1","Joko Kurir","081234567890","joko@kurir.com","Active","Terminal Buah Batu","-6.93587900","107.64167700","2026-06-23 16:43:50","2026-06-23 13:51:24");
INSERT INTO `tb_kurir` VALUES("2","Siti Kurir","081298765432","siti@kurir.com","Active","Terminal Buah Batu","-6.93587900","107.64167700","2026-06-23 16:43:50","2026-06-23 18:57:37");


DROP TABLE IF EXISTS `tb_lahan`;

CREATE TABLE `tb_lahan` (
  `id_lahan` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `nama_lahan` varchar(150) NOT NULL,
  `jenis_kopi` varchar(100) NOT NULL,
  `lokasi` text NOT NULL,
  `luas` double NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `foto_lahan` varchar(255) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `status_lahan` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`id_lahan`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tb_lahan` VALUES("2","0","kebun kopi b","Liberika","sejangkung","2","","","","pemupukan","Inactive");
INSERT INTO `tb_lahan` VALUES("5","2","kebun kopi d","Arabika","sempadian","2","1.3094763268710337","109.13326262030752","WhatsApp_Image_2026-06-23_at_19_23_06_(1).jpeg","pemupukan","Active");
INSERT INTO `tb_lahan` VALUES("6","2","kebun kopi dela","Arabika","suka ramai","20","1.4708619748862348","109.3780515342951","WhatsApp_Image_2026-06-23_at_19_23_06_(1)1.jpeg","kopi impor mahal ","Active");
INSERT INTO `tb_lahan` VALUES("7","2","kebun kopi putri","Liberika","kuayan","2.5","1.373660080034318","109.43195341620596","WhatsApp_Image_2026-06-23_at_19_23_06.jpeg","penanaman kopi","Active");


DROP TABLE IF EXISTS `tb_mitra`;

CREATE TABLE `tb_mitra` (
  `id_mitra` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mitra` varchar(150) NOT NULL,
  `kategori_mitra` varchar(100) NOT NULL,
  `urutan_tampil` int(11) NOT NULL DEFAULT 1,
  `logo_mitra` varchar(255) DEFAULT 'default.png',
  `status_mitra` varchar(20) DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_mitra`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tb_mitra` VALUES("1","Mitra Satu","Cafe","1","","Active","2026-06-22 22:51:21");
INSERT INTO `tb_mitra` VALUES("2","Mitra Dua","Toko","2","default.png","Active","2026-06-22 22:51:21");
INSERT INTO `tb_mitra` VALUES("3","Mitra Tiga","Distributor","3","","Active","2026-06-22 22:51:21");


DROP TABLE IF EXISTS `tb_notifikasi`;

CREATE TABLE `tb_notifikasi` (
  `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `isi_notifikasi` text NOT NULL,
  `status_baca` enum('0','1') NOT NULL DEFAULT '0',
  `tanggal_buat` datetime NOT NULL DEFAULT current_timestamp(),
  `judul` varchar(100) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `icon` varchar(50) DEFAULT 'info',
  PRIMARY KEY (`id_notifikasi`),
  KEY `id_user_idx` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tb_notifikasi` VALUES("1","3","Pesanan #INV-000002 status: Lokasi terbaru","","2026-06-23 13:48:19","Update Pengiriman","http://localhost/poktan_kopi/pembeli/tracking","info");
INSERT INTO `tb_notifikasi` VALUES("2","3","Pesanan #INV-000002 status: Lokasi terbaru","","2026-06-23 13:48:35","Update Pengiriman","http://localhost/poktan_kopi/pembeli/tracking","info");
INSERT INTO `tb_notifikasi` VALUES("3","3","Pesanan #INV-000001 status: Lokasi terbaru","","2026-06-23 13:51:24","Update Pengiriman","http://localhost/poktan_kopi/pembeli/tracking","info");
INSERT INTO `tb_notifikasi` VALUES("4","3","Pesanan #INV-000002 status: Lokasi terbaru","0","2026-06-23 18:57:37","Update Pengiriman","http://localhost/poktan_kopi/pembeli/tracking","info");


DROP TABLE IF EXISTS `tb_panen`;

CREATE TABLE `tb_panen` (
  `id_panen` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `jumlah_panen` int(11) DEFAULT 0,
  `tanggal_panen` date DEFAULT NULL,
  `id_lahan` int(11) DEFAULT NULL,
  `kualitas` varchar(100) DEFAULT NULL,
  `foto_panen` varchar(255) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_panen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



DROP TABLE IF EXISTS `tb_petani`;

CREATE TABLE `tb_petani` (
  `id_petani` int(11) NOT NULL AUTO_INCREMENT,
  `nama_petani` varchar(100) NOT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `file_ktp` varchar(255) DEFAULT NULL,
  `file_npwp` varchar(255) DEFAULT NULL,
  `file_sertifikat` varchar(255) DEFAULT NULL,
  `status_ktp` varchar(50) DEFAULT 'Menunggu',
  `status_npwp` varchar(50) DEFAULT 'Menunggu',
  `status_sertifikat` varchar(50) DEFAULT 'Menunggu',
  `status_petani` varchar(20) DEFAULT 'Pending',
  `tanggal_daftar` date DEFAULT current_timestamp(),
  `foto_profil` varchar(255) DEFAULT NULL,
  `catatan_verifikasi` text DEFAULT NULL,
  PRIMARY KEY (`id_petani`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tb_petani` VALUES("1","Ahmad Fauzi","","","","","","","","Menunggu","Menunggu","Menunggu","Pending","2026-06-21","","");
INSERT INTO `tb_petani` VALUES("3","Dewi Lestari","","","","","","","","Menunggu","Menunggu","Menunggu","Active","2026-06-21","","");
INSERT INTO `tb_petani` VALUES("4","Tara Amelia","36733728182729","0899992222333","taraaaamel@gmail.com","Sambas","","","","Menunggu","Menunggu","Menunggu","Active","2026-06-24","download_(1).jpg","");
INSERT INTO `tb_petani` VALUES("5","Ahmad Wijaya","3275011203980001","081234567890","ahmadwijaya@email.com","Dusun Krajan, Desa Sukamaju, Kec. Bumiaji, Kota Batu, Jawa Timur 65332","","","","Terverifikasi","Terverifikasi","Terverifikasi","Active","2024-01-12","","");
INSERT INTO `tb_petani` VALUES("6","Siti Rahayu","3275012204990002","081322221111","siti@email.com","Jl. Merdeka No. 10","","","","Terverifikasi","Pending","Pending","Active","2024-02-15","","");
INSERT INTO `tb_petani` VALUES("7","Budi Santoso","3275013105000003","081255556666","budi@email.com","Jl. Mawar No. 12","","","","Ditolak","Pending","Pending","Inactive","2024-03-20","","");
INSERT INTO `tb_petani` VALUES("8","Joko Prasetyo","3275011507020004","081377778888","joko@email.com","Jl. Melati No. 1","","","","Ditolak","Ditolak","Ditolak","Suspended","2024-04-10","","");
INSERT INTO `tb_petani` VALUES("9","Dewi Lestari","3275012608030005","081299990000","dewi@email.com","Jl. Anggrek No. 5","","","","Terverifikasi","Terverifikasi","Terverifikasi","Active","2024-05-05","","");


DROP TABLE IF EXISTS `tb_produk`;

CREATE TABLE `tb_produk` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `nama_produk` varchar(150) NOT NULL,
  `stok_produk` int(11) DEFAULT 0,
  `jenis_kopi` varchar(50) DEFAULT NULL,
  `grade` varchar(20) DEFAULT NULL,
  `harga` decimal(12,2) DEFAULT NULL,
  `altitude` varchar(100) DEFAULT NULL,
  `proses` varchar(100) DEFAULT NULL,
  `flavor_notes` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto_utama` varchar(255) DEFAULT NULL,
  `status_produk` enum('Aktif','Nonaktif') DEFAULT 'Aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tb_produk` VALUES("1","1","Liberica Honey","150","Liberica","A","120000.00","800-1200 mdpl","Honey","Cokelat, Karamel, Nutty","Kopi Liberica dengan proses honey","","Aktif","2026-06-22 16:35:16");
INSERT INTO `tb_produk` VALUES("3","1","Robusta Premium Lampung","200","Robusta","A","95000.00","800 mdpl","Natural","Dark Chocolate, Smoky, Earthy","Kopi Robusta pilihan dengan karakter body kuat dan rasa pahit yang seimbang, cocok untuk espresso blend.","","Aktif","2026-06-23 21:56:09");
INSERT INTO `tb_produk` VALUES("4","1","Arabica Gayo Specialty","50","Arabica","AA","175000.00","1600mdpl","Full Washed","Fruity, Floral, Citrus","Biji kopi Arabica specialty dari dataran tinggi Gayo dengan karakter rasa fruity dan aroma floral yang kuat.","","Aktif","2026-06-23 22:49:12");
INSERT INTO `tb_produk` VALUES("6","1","arabica","15","Arabica","B","75000.00","600mdpl","Natural","fruity","enak","","Aktif","2026-06-23 23:08:25");
INSERT INTO `tb_produk` VALUES("8","1","liberika","14","Liberica","B","50000.00","500mdpl","Full Washed","fruity","m","2a4ccf513865e2b161f13cf31976428e.jpg","Aktif","2026-06-23 23:34:28");
INSERT INTO `tb_produk` VALUES("10","1","liberika","2","Liberica","A","20000.00","500mdpl","Full Washed","p","p","0ce25a1c5ef14da41f2cb3656eff11b2.jpg","Aktif","2026-06-23 23:39:55");


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

INSERT INTO `tb_setting_notifikasi` VALUES("1","1","1","1","1","1","0","0","1","2026-06-21 15:01:00");
INSERT INTO `tb_setting_notifikasi` VALUES("3","1","1","1","1","1","0","0","1","2026-06-21 18:17:33");


DROP TABLE IF EXISTS `tb_tracking`;

CREATE TABLE `tb_tracking` (
  `id_tracking` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) NOT NULL,
  `id_kurir` int(11) DEFAULT NULL,
  `status_pengiriman` enum('pending','diproses','dikirim','dalam_perjalanan','tiba_di_kota_tujuan','out_for_delivery','delivered','diterima','dibatalkan') DEFAULT 'pending',
  `estimasi_tiba` datetime DEFAULT NULL,
  `tanggal_kirim` datetime DEFAULT NULL,
  `tanggal_terima` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_tracking`),
  UNIQUE KEY `unique_transaksi` (`id_transaksi`),
  KEY `idx_kurir` (`id_kurir`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tb_tracking` VALUES("1","1","1","dalam_perjalanan","2026-06-26 16:43:50","","","2026-06-23 16:43:50","2026-06-23 13:51:24");
INSERT INTO `tb_tracking` VALUES("2","2","2","dikirim","2026-06-28 16:43:51","","","2026-06-23 16:43:51","2026-06-23 18:57:37");
INSERT INTO `tb_tracking` VALUES("7","4","1","pending","","","","2026-06-23 18:18:34","2026-06-23 18:18:34");


DROP TABLE IF EXISTS `tb_tracking_history`;

CREATE TABLE `tb_tracking_history` (
  `id_history` int(11) NOT NULL AUTO_INCREMENT,
  `id_tracking` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id_history`),
  KEY `idx_tracking` (`id_tracking`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tb_tracking_history` VALUES("1","1","pending","","","","Pesanan diterima","2026-06-21 16:43:51");
INSERT INTO `tb_tracking_history` VALUES("2","1","diproses","","","","Pesanan sedang diproses","2026-06-22 16:43:51");
INSERT INTO `tb_tracking_history` VALUES("3","1","dikirim","","","","Pesanan telah dikirim","2026-06-23 04:43:51");
INSERT INTO `tb_tracking_history` VALUES("4","2","dalam_perjalanan","-6.20000000","106.81666600","Gudang Jakarta","Lokasi terakhir: Gudang Jakarta","2026-06-23 13:48:19");
INSERT INTO `tb_tracking_history` VALUES("5","2","dalam_perjalanan","-0.02310000","109.33490000","Gudang Jakarta","Lokasi terakhir: Gudang Jakarta","2026-06-23 13:48:35");
INSERT INTO `tb_tracking_history` VALUES("6","1","dalam_perjalanan","-6.93587900","107.64167700","Terminal Buah Batu","Lokasi terakhir: Terminal Buah Batu","2026-06-23 13:51:24");
INSERT INTO `tb_tracking_history` VALUES("7","2","dalam_perjalanan","-6.93587900","107.64167700","Terminal Buah Batu","Lokasi terakhir: Terminal Buah Batu","2026-06-23 18:57:37");


DROP TABLE IF EXISTS `tb_transaksi`;

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `total_harga` int(11) DEFAULT 0,
  `status_pesanan` varchar(50) DEFAULT 'Pending',
  `metode_bayar` varchar(50) DEFAULT 'Transfer',
  `invoice` varchar(50) DEFAULT NULL,
  `id_tracking` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_transaksi`),
  KEY `idx_user` (`id_user`),
  KEY `idx_tracking_transaksi` (`id_tracking`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tb_transaksi` VALUES("1","3","15000000","Diproses","Transfer Bank","INV-000001","1","2026-06-23 17:02:01");
INSERT INTO `tb_transaksi` VALUES("2","3","25000000","Dikirim","E-Wallet","INV-000002","2","2026-06-23 17:02:01");
INSERT INTO `tb_transaksi` VALUES("3","","14200000","Pending","COD","INV-000003","","2026-06-23 17:02:01");
INSERT INTO `tb_transaksi` VALUES("4","2","1500000","Diproses","Transfer","INV-PETANI-001","7","2026-06-23 18:18:34");


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
  `verification_token` varchar(255) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tb_user` VALUES("1","admin","0192023a7bbd73250516f069df18b500","Ketua Poktan","admin@poktan.com","Admin","","Active","2026-06-21 19:32:57","2026-06-21 19:32:57","","","");
INSERT INTO `tb_user` VALUES("2","petani","e24f980d21884c0fff8a3048f21822bf","Ahmad Petani","petani@poktan.com","Petani","","Active","2026-06-21 19:32:57","2026-06-21 19:32:57","","","");
INSERT INTO `tb_user` VALUES("3","pembeli","547ea1ce04c68f6bda9e2da0d1f253f5","Budi Pembeli","pembeli@poktan.com","Pembeli","","Active","2026-06-21 19:32:57","2026-06-21 19:32:57","","","");
INSERT INTO `tb_user` VALUES("4","ragyl","e10adc3949ba59abbe56e057f20f883e","Muhammad Ragyl Alfari","ragyl03alfari@gmail.com","Petani","","Active","2026-06-22 11:50:16","2026-06-22 11:50:19","","","");
INSERT INTO `tb_user` VALUES("5","teguh","e10adc3949ba59abbe56e057f20f883e","Teguh Maulana","teguhmaulana@gmail.com","Pembeli","","Active","2026-06-22 15:06:01","2026-06-22 15:06:08","","","");


