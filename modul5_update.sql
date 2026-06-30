CREATE TABLE `tb_produk_galeri` (
  `id_galeri` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  PRIMARY KEY (`id_galeri`),
  KEY `id_produk` (`id_produk`),
  CONSTRAINT `fk_produk_galeri` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
