-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jul 2026 pada 15.16
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `liberchain`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bukti_bayar`
--

CREATE TABLE `tb_bukti_bayar` (
  `id_bukti` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `nama_bank` varchar(100) DEFAULT NULL,
  `nama_pengirim` varchar(100) NOT NULL,
  `tanggal_transfer` date NOT NULL,
  `jumlah_transfer` int(11) NOT NULL,
  `file_bukti` varchar(255) NOT NULL,
  `status_verifikasi` enum('Pending','Diverifikasi','Ditolak') DEFAULT 'Pending',
  `keterangan` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `verified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_bukti_bayar`
--

INSERT INTO `tb_bukti_bayar` (`id_bukti`, `id_transaksi`, `nama_bank`, `nama_pengirim`, `tanggal_transfer`, `jumlah_transfer`, `file_bukti`, `status_verifikasi`, `keterangan`, `created_at`, `verified_at`) VALUES
(1, 5, 'BCA', 'Kafi Ahmad', '2026-06-02', 140000, 'a4f111b9e3b61c865336ba335f83f01c.png', 'Diverifikasi', NULL, '2026-06-25 03:30:51', '2026-06-24 22:31:38'),
(2, 6, 'BCA', 'Budi Santoso', '2026-06-25', 2200000, '53ac3c8b97d09fa69adf9a824f9c920c.png', 'Pending', NULL, '2026-06-25 07:56:03', NULL),
(3, 29, 'Cash COD', 'Kurir: Andi', '2026-07-02', 70000, 'b18150b32a25b7c6755cf345496145e0.png', 'Diverifikasi', 'COD Payment collected by Kurir', '2026-07-02 18:25:55', '2026-07-02 18:27:27'),
(4, 32, 'BCA', 'Kurir: Andi', '2026-07-02', 210000, '3cc29584ff698e220a4888e699dc3c7d.png', 'Diverifikasi', 'COD Payment collected by Kurir', '2026-07-02 19:06:42', '2026-07-02 19:07:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_transaksi`
--

CREATE TABLE `tb_detail_transaksi` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_satuan` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `tb_detail_transaksi`
--

INSERT INTO `tb_detail_transaksi` (`id_detail`, `id_transaksi`, `id_produk`, `jumlah`, `harga_satuan`, `subtotal`) VALUES
(1, 1, 1, 25, 150000.00, 3750000.00),
(2, 1, 2, 10, 180000.00, 1800000.00),
(3, 2, 1, 30, 150000.00, 4500000.00),
(4, 2, 3, 15, 130000.00, 1950000.00),
(5, 3, 2, 20, 180000.00, 3600000.00),
(6, 3, 4, 25, 120000.00, 3000000.00),
(7, 4, 1, 15, 150000.00, 2250000.00),
(8, 5, 3, 20, 130000.00, 2600000.00),
(9, 5, 4, 10, 120000.00, 1200000.00),
(10, 6, 2, 12, 180000.00, 2160000.00),
(11, 6, 5, 8, 200000.00, 1600000.00),
(12, 7, 1, 10, 150000.00, 1500000.00),
(13, 8, 3, 25, 130000.00, 3250000.00),
(14, 8, 5, 10, 200000.00, 2000000.00),
(15, 9, 2, 18, 180000.00, 3240000.00),
(16, 9, 4, 15, 120000.00, 1800000.00),
(17, 10, 1, 22, 150000.00, 3300000.00),
(18, 10, 3, 12, 130000.00, 1560000.00),
(19, 7, 10, 1, 20000.00, 20000.00),
(20, 8, 6, 1, 75000.00, 75000.00),
(21, 14, 8, 1, 50000.00, 50000.00),
(22, 14, 3, 1, 95000.00, 95000.00),
(23, 14, 6, 1, 75000.00, 75000.00),
(24, 15, 8, 1, 50000.00, 50000.00),
(25, 16, 3, 1, 95000.00, 95000.00),
(26, 17, 3, 3, 95000.00, 285000.00),
(27, 18, 3, 1, 95000.00, 95000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_keranjang`
--

CREATE TABLE `tb_keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 1,
  `harga_satuan` decimal(12,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `tb_keranjang`
--

INSERT INTO `tb_keranjang` (`id_keranjang`, `id_user`, `session_id`, `id_produk`, `jumlah`, `harga_satuan`, `created_at`) VALUES
(1, NULL, '05djib6obbvng9kcdpkq3813nt73b669', 3, 1, 95000.00, '2026-06-26 08:54:39'),
(4, NULL, '5425kdgbljt68nho1kr8knfkumkpbqhh', 3, 1, 95000.00, '2026-06-26 08:58:25'),
(5, NULL, 'jskuateqcgcj3uikghitkdkhp531ss48', 3, 1, 95000.00, '2026-06-26 09:01:04'),
(8, 6, 't2c937n8bugcdnukfn9d7krbqp7d7vne', 4, 1, 175000.00, '2026-06-28 17:39:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kurir`
--

CREATE TABLE `tb_kurir` (
  `id_kurir` int(11) NOT NULL,
  `nama_kurir` varchar(100) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `jenis_kendaraan` varchar(50) DEFAULT NULL,
  `plat_nomor` varchar(20) DEFAULT NULL,
  `status` enum('Active','Inactive','Offline') DEFAULT 'Offline',
  `lokasi_terakhir` varchar(255) DEFAULT NULL,
  `lat_terakhir` decimal(10,8) DEFAULT NULL,
  `lng_terakhir` decimal(11,8) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_kurir`
--

INSERT INTO `tb_kurir` (`id_kurir`, `nama_kurir`, `no_telepon`, `email`, `jenis_kendaraan`, `plat_nomor`, `status`, `lokasi_terakhir`, `lat_terakhir`, `lng_terakhir`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Joko Kurir', '081234567890', 'joko@kurir.com', NULL, NULL, 'Active', 'Terminal Buah Batu', -6.93587900, 107.64167700, '2026-06-23 16:43:50', '2026-06-29 14:29:28', NULL),
(2, 'Siti Kurir', '081298765432', 'siti@kurir.com', NULL, NULL, 'Active', 'Terminal Buah Batu', -6.93587900, 107.64167700, '2026-06-23 16:43:50', '2026-06-29 14:19:37', NULL),
(9, 'Andi', '085436724536', 'Andi1245@gmail.com', NULL, NULL, 'Active', 'Sambas', NULL, NULL, '2026-06-29 14:42:19', '2026-06-29 14:42:19', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_lahan`
--

CREATE TABLE `tb_lahan` (
  `id_lahan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_lahan` varchar(100) NOT NULL,
  `koordinat` varchar(255) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `mdpl` int(11) DEFAULT NULL,
  `foto_lahan` varchar(255) DEFAULT 'default_lahan.jpg',
  `status_lahan` varchar(20) DEFAULT 'Active',
  `keterangan` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mitra`
--

CREATE TABLE `tb_mitra` (
  `id_mitra` int(11) NOT NULL,
  `nama_mitra` varchar(150) NOT NULL,
  `kategori_mitra` varchar(100) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `no_telepon` varchar(30) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `urutan_tampil` int(11) NOT NULL DEFAULT 1,
  `logo_mitra` varchar(255) DEFAULT 'default.png',
  `status_mitra` varchar(20) DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `tb_mitra`
--

INSERT INTO `tb_mitra` (`id_mitra`, `nama_mitra`, `kategori_mitra`, `email`, `no_telepon`, `website`, `alamat`, `deskripsi`, `urutan_tampil`, `logo_mitra`, `status_mitra`, `created_at`) VALUES
(1, 'LIBER.CO', 'Cafe', '', '08115659448', '', '', 'CITA RASA UNIK BERAROMA BUAH\r\nCOCK UNTUK KAMU YANG DOYAN NGOPI SERU!', 1, '32ff4737e83b4efed1a1c9b0f57bb838.jpeg', 'Active', '2026-06-22 15:51:21'),
(10, 'Coffeeshop 101 Coffee House Pontianak', 'Cafe', '', '', '', '', '', 1, 'default.png', 'Active', '2026-07-01 04:19:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_notifikasi`
--

CREATE TABLE `tb_notifikasi` (
  `id_notifikasi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `isi_notifikasi` text NOT NULL,
  `status_baca` enum('0','1') NOT NULL DEFAULT '0',
  `tanggal_buat` datetime NOT NULL DEFAULT current_timestamp(),
  `judul` varchar(100) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `icon` varchar(50) DEFAULT 'info'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `tb_notifikasi`
--

INSERT INTO `tb_notifikasi` (`id_notifikasi`, `id_user`, `isi_notifikasi`, `status_baca`, `tanggal_buat`, `judul`, `link`, `icon`) VALUES
(125, 1, 'Pesanan #32 dari Budi menunggu konfirmasi.', '0', '2026-07-02 18:55:07', 'Pesanan Baru', 'admin/transaksi/detail/32', 'info'),
(126, 3, 'Pesanan #32 berhasil dibuat. Silakan upload bukti pembayaran.', '', '2026-07-02 18:55:07', 'Pesanan Berhasil', 'pembeli/transaksi/detail/32', 'success'),
(127, 3, 'Pesanan #32 sekarang: Diproses', '', '2026-07-02 18:55:50', '???? Status Pesanan Berubah', 'pembeli/transaksi/detail/32', 'info'),
(128, 3, 'Pesanan #INV-000001 - Kurir Andi telah ditugaskan untuk mengantar pesanan Anda.', '', '2026-07-02 18:56:07', 'Update Pengiriman', 'http://localhost/poktan_kopi/pembeli/tracking', 'info'),
(129, 11, 'Anda ditugaskan mengantar pesanan #INV-000001. Segera upload bukti pengiriman.', '', '2026-07-02 18:56:07', 'Penugasan Pengiriman Baru', 'http://localhost/poktan_kopi/kurir/tracking', 'info'),
(130, 3, 'Pesanan #INV-000001 - Status diperbarui ke: Dikirim', '', '2026-07-02 18:56:12', 'Update Pengiriman', 'http://localhost/poktan_kopi/pembeli/tracking', 'info'),
(131, 3, 'Pesanan #32 sekarang: Dikirim', '', '2026-07-02 18:56:54', '???? Status Pesanan Berubah', 'pembeli/transaksi/detail/32', 'info'),
(132, 3, 'Pesanan #INV-000001 - Status diperbarui ke: Dalam Perjalanan', '', '2026-07-02 19:04:53', 'Update Pengiriman', 'http://localhost/poktan_kopi/pembeli/tracking', 'info'),
(133, 3, 'Pesanan #INV-000001 - Pesanan telah sampai. Bukti pengiriman dan pembayaran COD telah diunggah oleh kurir.', '', '2026-07-02 19:06:42', 'Update Pengiriman', 'http://localhost/poktan_kopi/pembeli/tracking', 'info'),
(134, 3, 'Pesanan #INV-000001 - Status diperbarui ke: Diterima', '', '2026-07-02 19:07:07', 'Update Pengiriman', 'http://localhost/poktan_kopi/pembeli/tracking', 'info'),
(135, 3, 'Pesanan #32 sekarang: Selesai', '', '2026-07-02 19:07:16', '???? Status Pesanan Berubah', 'pembeli/transaksi/detail/32', 'success'),
(136, 3, 'Pembayaran untuk pesanan #32 telah diverifikasi. Pesanan sedang diproses.', '', '2026-07-02 19:07:21', '✅ Pembayaran Diverifikasi', 'pembeli/transaksi/detail/32', 'success');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ongkir`
--

CREATE TABLE `tb_ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `kota_asal` varchar(100) NOT NULL,
  `kota_tujuan` varchar(100) NOT NULL,
  `kecamatan_tujuan` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL,
  `estimasi_hari` int(11) NOT NULL DEFAULT 1,
  `status` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_ongkir`
--

INSERT INTO `tb_ongkir` (`id_ongkir`, `kota_asal`, `kota_tujuan`, `kecamatan_tujuan`, `tarif`, `estimasi_hari`, `status`) VALUES
(1, 'Sambas', 'Pontianak', 'Pontianak Kota', 20000, 1, 'Active'),
(2, 'Sambas', 'Pontianak', 'Pontianak Barat', 20000, 1, 'Active'),
(3, 'Sambas', 'Pontianak', 'Pontianak Selatan', 22000, 1, 'Active'),
(4, 'Sambas', 'Pontianak', 'Pontianak Tenggara', 22000, 1, 'Active'),
(5, 'Sambas', 'Pontianak', 'Pontianak Timur', 21000, 1, 'Active'),
(6, 'Sambas', 'Pontianak', 'Pontianak Utara', 20000, 1, 'Active'),
(7, 'Pontianak', 'Sambas', 'Sambas', 20000, 1, 'Active'),
(8, 'Pontianak', 'Sambas', 'Pemangkat', 22000, 1, 'Active'),
(9, 'Pontianak', 'Sambas', 'Tebas', 21000, 1, 'Active'),
(10, 'Pontianak', 'Sambas', 'Selakau', 21000, 1, 'Active'),
(11, 'Pontianak', 'Sambas', 'Selakau Timur', 22000, 1, 'Active'),
(12, 'Pontianak', 'Sambas', 'Semparuk', 21000, 1, 'Active'),
(13, 'Pontianak', 'Sambas', 'Salatiga', 22000, 1, 'Active'),
(14, 'Pontianak', 'Sambas', 'Subah', 23000, 1, 'Active'),
(15, 'Pontianak', 'Sambas', 'Sebawi', 23000, 1, 'Active'),
(16, 'Pontianak', 'Sambas', 'Tekarang', 22000, 1, 'Active'),
(17, 'Pontianak', 'Sambas', 'Jawai', 23000, 2, 'Active'),
(18, 'Pontianak', 'Sambas', 'Jawai Selatan', 23000, 2, 'Active'),
(19, 'Pontianak', 'Sambas', 'Teluk Keramat', 24000, 2, 'Active'),
(20, 'Pontianak', 'Sambas', 'Galing', 25000, 2, 'Active'),
(21, 'Pontianak', 'Sambas', 'Tangaran', 25000, 2, 'Active'),
(22, 'Pontianak', 'Sambas', 'Sejangkung', 24000, 2, 'Active'),
(23, 'Pontianak', 'Sambas', 'Sajingan Besar', 30000, 2, 'Active'),
(24, 'Pontianak', 'Sambas', 'Sajad', 25000, 2, 'Active'),
(25, 'Pontianak', 'Sambas', 'Paloh', 28000, 2, 'Active'),
(26, 'Sambas', 'Sambas', 'Sambas', 10000, 1, 'Active'),
(27, 'Pontianak', 'Pontianak', 'Pontianak Kota', 10000, 1, 'Active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_otp`
--

CREATE TABLE `tb_otp` (
  `id_otp` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `tujuan` varchar(100) NOT NULL COMMENT 'email atau no HP tujuan',
  `metode` enum('email','whatsapp') NOT NULL,
  `kode_otp` varchar(6) NOT NULL,
  `status` enum('Pending','Verified','Expired') NOT NULL DEFAULT 'Pending',
  `percobaan` int(3) NOT NULL DEFAULT 0,
  `dikirim_pada` datetime NOT NULL,
  `kadaluarsa_pada` datetime NOT NULL,
  `diverifikasi_pada` datetime DEFAULT NULL,
  `no_telepon` bigint(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_otp`
--

INSERT INTO `tb_otp` (`id_otp`, `id_user`, `session_id`, `tujuan`, `metode`, `kode_otp`, `status`, `percobaan`, `dikirim_pada`, `kadaluarsa_pada`, `diverifikasi_pada`, `no_telepon`) VALUES
(1, NULL, '822fqjpqqhg2t6usaadhfekkjernpjkq', '085845891908', 'whatsapp', '262565', 'Verified', 0, '2026-06-26 05:43:33', '2026-06-26 05:48:33', '2026-06-26 05:43:56', 0),
(2, NULL, '03givtaeqho864nd9iiblu2107fk37v0', 'va8723104@gmail.com', 'email', '540580', 'Verified', 0, '2026-06-26 05:58:47', '2026-06-26 06:03:47', '2026-06-26 05:59:13', 0),
(3, 3, 'jkvmsea5p028ladu0b216eqpb8d35je8', 'va8723104@gmail.com', 'email', '210149', 'Verified', 0, '2026-06-26 10:30:54', '2026-06-26 10:35:54', '2026-06-26 10:31:01', 0),
(4, NULL, 'jn8qp67ck2rbs346gn9frp2enre3j5d3', '085845891908', 'whatsapp', '244822', 'Verified', 0, '2026-06-26 10:46:46', '2026-06-26 10:51:46', '2026-06-26 10:46:52', 0),
(5, NULL, 'g4brj3ihdv1cbeikshouc1r2ogt6oom3', '085845891908', 'whatsapp', '903965', 'Verified', 0, '2026-06-26 10:59:46', '2026-06-26 11:04:46', '2026-06-26 10:59:56', 0),
(6, NULL, 'c9vufipas5qb0meah3hi795goq7doijo', '085845891908', 'whatsapp', '241354', 'Verified', 0, '2026-06-26 11:15:53', '2026-06-26 11:20:53', '2026-06-26 11:16:03', 0),
(7, NULL, 'bocqcc60cko7km0rthdjtms2u8lrg2qm', '082351343153', 'whatsapp', '594314', 'Verified', 0, '2026-06-28 12:37:51', '2026-06-28 12:42:51', '2026-06-28 12:40:19', 0),
(8, NULL, '2eco3mu4e045p3ek0hj54k0lc9a0528i', '082351343153', 'whatsapp', '663832', 'Verified', 0, '2026-06-28 19:11:42', '2026-06-28 19:16:42', '2026-06-28 19:11:51', 0),
(18, NULL, NULL, '6282351343153', 'whatsapp', '121088', 'Verified', 0, '2026-06-29 04:40:44', '2026-06-29 04:45:44', '2026-06-29 04:41:10', 0),
(19, NULL, NULL, '6285754906905', 'whatsapp', '546089', 'Verified', 0, '2026-06-29 09:52:50', '2026-06-29 09:57:50', '2026-06-29 09:53:25', 0),
(22, NULL, NULL, '6285754906905', 'whatsapp', '192279', 'Verified', 0, '2026-06-30 03:44:47', '2026-06-30 03:49:47', '2026-06-30 03:45:22', 0),
(24, 5, 'c8s2kbnkkm19k53rfiv3iepfr9g0c258', '085754906905', 'whatsapp', '544368', 'Verified', 0, '2026-06-30 15:45:19', '2026-06-30 15:50:19', '2026-06-30 15:45:28', 0),
(25, NULL, 'p9sd3d9k4re3ctb2k8vr1a3ttdop8nvi', 'pp6872811@gmail.com', 'email', '296410', 'Verified', 0, '2026-07-01 05:26:19', '2026-07-01 05:31:19', '2026-07-01 05:26:28', 0),
(26, NULL, 'm78c72su4o3d6v0sehcnf5npi1mdea3a', 'pp6872811@gmail.com', 'email', '542536', 'Verified', 0, '2026-07-01 06:11:07', '2026-07-01 06:16:07', '2026-07-01 06:11:16', 0),
(27, NULL, 'akok5t90ba139ll1d1k3pjd3d3rbf0i2', '085754906905', 'whatsapp', '900534', 'Verified', 0, '2026-07-01 13:11:22', '2026-07-01 13:16:22', '2026-07-01 13:11:28', 0),
(29, NULL, NULL, '6285754906905', 'whatsapp', '084054', 'Verified', 0, '2026-07-01 16:39:51', '2026-07-01 16:44:51', '2026-07-01 16:40:05', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_panen`
--

CREATE TABLE `tb_panen` (
  `id_panen` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah_panen` int(11) DEFAULT 0,
  `tanggal_panen` date NOT NULL,
  `id_lahan` int(11) NOT NULL,
  `kualitas` varchar(100) DEFAULT NULL,
  `foto_panen` varchar(255) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_petani`
--

CREATE TABLE `tb_petani` (
  `id_petani` int(11) NOT NULL,
  `nama_petani` varchar(100) NOT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `domisili` text DEFAULT NULL,
  `file_sk` varchar(255) DEFAULT NULL,
  `status_sk` varchar(50) DEFAULT 'Menunggu',
  `status_petani` varchar(20) DEFAULT 'Pending',
  `tanggal_daftar` date DEFAULT current_timestamp(),
  `foto_profil` varchar(255) DEFAULT NULL,
  `catatan_verifikasi` text DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `tb_petani`
--

INSERT INTO `tb_petani` (`id_petani`, `nama_petani`, `nik`, `no_hp`, `email`, `tanggal_lahir`, `alamat`, `domisili`, `file_sk`, `status_sk`, `status_petani`, `tanggal_daftar`, `foto_profil`, `catatan_verifikasi`, `is_deleted`) VALUES
(1, 'Ahmad Fauzi', '', '', '', NULL, '', NULL, NULL, 'Menunggu', 'Pending', '2026-06-21', '', '', 1),
(3, 'Dewi Lestari', '', '', '', NULL, '', NULL, NULL, 'Menunggu', 'Suspended', '2026-06-21', '', '', 1),
(4, 'Tara Amelia', '36733728182729', '0899992222333', 'taraaaamel@gmail.com', NULL, 'Sambas', NULL, NULL, 'Menunggu', 'Active', '2026-06-24', 'download_(1).jpg', '', 1),
(5, 'Ahmad Wijaya', '3275011203980001', '081234567890', 'ahmadwijaya@email.com', NULL, 'Dusun Krajan, Desa Sukamaju, Kec. Bumiaji, Kota Batu, Jawa Timur 65332', NULL, NULL, 'Menunggu', 'Active', '2024-01-12', 'PP_couple2.jpg', '', 1),
(6, 'Siti Rahayu', '3275012204990002', '081322221111', 'siti@email.com', NULL, 'Jl. Merdeka No. 10', NULL, NULL, 'Menunggu', 'Active', '2024-02-15', 'profil_couple_cowok_cewek1.jpg', '', 1),
(7, 'Budi Santoso', '3275013105000003', '081255556666', 'budi@email.com', NULL, 'Jl. Mawar No. 12', NULL, NULL, 'Menunggu', 'Active', '2024-03-20', 'PP_couple1.jpg', '', 1),
(8, 'Joko Prasetyo', '3275011507020004', '081377778888', 'joko@email.com', NULL, 'Jl. Melati No. 1', NULL, NULL, 'Menunggu', 'Active', '2024-04-10', 'PP_couple.jpg', '', 1),
(9, 'Dewi Lestari', '3275012608030005', '081299990000', 'dewi@email.com', NULL, 'Jl. Anggrek No. 5', NULL, NULL, 'Menunggu', 'Suspended', '2024-05-05', 'profil_couple_cowok_cewek.jpg', '', 1),
(10, 'Ayu Wulandari', '6120203948576839', '089876889977', 'ayuwulandari@gmail.com', NULL, 'Perasak', NULL, NULL, 'Menunggu', 'Active', '2026-06-29', 'download_(1).jpg', '', 1),
(11, 'Agus', '6112091109960005', '0899999999999', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Suspended', '2026-07-01', NULL, '', 0),
(12, 'Aliyas', '6101060506880002', '089999999999999', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(13, 'Andi', '6101061501900002', '089999999999999', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(14, 'Arpan', '6101061605580004', '089999999999', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(15, 'Asmadi', '6101060607690002', '0899999999999', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(16, 'Asmito', '6101061509870001', '08999999999999', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(17, 'Aswin', '6101061111910001', '08999999999999', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(18, 'Beni', '6101060107880018', '08999999999999', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(19, 'Budi', '6101061002830003', '089999999999999', '', NULL, 'Sendoyan Batu  Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(20, 'Damsir', '6101061703770002', '08999999999999', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(21, 'Dedi', '6101062307870001', '08999999999999', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(22, 'Erwan', '6101062107890004', '0899999999999', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(23, 'Hambli', '6101061205810001', '0899999999999', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(24, 'Hendri', '6101062505790001', '0899999999999', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(25, 'Hendri', '6101062810670001', '089876889977', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(26, 'Hendro', '6101061003890003', '089876889977', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(27, 'Heri', '6101062602820001', '0899999999999', '', NULL, 'Sendoyan Batu Kayar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(28, 'Iwan', '6101060107890021', '08989898998989', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(29, 'Jinni', '6101062908690001', '0899999999999', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(30, 'Juliadi', '6101060107920013', '0899999999999', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(31, 'Kamil', '6101061002850007', '089876889977', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(32, 'Lase', '6101060305870002', '0899999999999', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(33, 'Lisandri', '6101060401850004', '0899999999999', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(34, 'Maliki', '6101061506820006', '0899999999999', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(35, 'Masudi', '6101060910850001', '0899999999999', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(36, 'Rizal', '6101061211770003', '0899999999999', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(37, 'Rustandi M', '6101061009690002', '0899999999999', '', NULL, 'Sendoyan', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(38, 'Sabhan', '6101060512730003', '0899999999999', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(39, 'Sabihi', '6101060506600004', '0899999999999', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(40, 'Sabri', '6101061310900003', '0899999999999', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(41, 'Sarmili', '6101061703750005', '0899999999999', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(42, 'Zunaidi', '6101061903910002', '0899999999999', '', NULL, 'Sendoyan Batu Layar', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(43, 'Paijan', '6100000000000000', '0899999999999', '', NULL, 'Sempadian Tekarang', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(44, 'Davidson', '6199999999999999', '0899999999999', '', NULL, 'Sempadian Tekarang', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(45, 'Eko Haryono', '6188888888888888', '0899999999999', '', NULL, 'Sempadian Tekarang', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(46, 'Nurhalimah', '6177777777777777', '0899999999999', '', NULL, 'Sempadian Tekarang', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(47, 'Jawawi', '6166666666666666', '0899999999999', '', NULL, 'Sempadian Tekarang', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(48, 'Sabri', '6155555555555555', '0899999999999', '', NULL, 'Sempadian Tekarang', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(49, 'Edi Lamunan', '6144444444444444', '0899999999999', '', NULL, 'Sempadian Tekarang', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(50, 'Juhdi', '6133333333333333', '0899999999999', '', NULL, 'Sempadian Tekarang', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(51, 'Hairan', '6122222222222222', '0899999999999', '', NULL, 'Sempadian Tekarang', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(52, 'Juniardi', '6111111111111111', '0899999999999', '', NULL, 'Sempadian Tekarang', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(53, 'Burhanudin', '6100000000000000', '0899999999999', '', NULL, 'Sempadian Tekarang', NULL, NULL, 'Menunggu', 'Inactive', '2026-07-01', NULL, NULL, 0),
(54, 'Sina', '6111111111111111', '0899999999999', '', NULL, 'Sempadian Tekarang', NULL, NULL, 'Menunggu', 'Active', '2026-07-01', NULL, '', 0),
(55, 'Wahyudi', '6122222222222222', '0899999999999', '', NULL, 'Sempadian Tekarang', NULL, NULL, 'Menunggu', 'Suspended', '2026-07-01', NULL, '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_petani_wilayah`
--

CREATE TABLE `tb_petani_wilayah` (
  `id_petani_wilayah` int(11) NOT NULL,
  `id_petani` int(11) NOT NULL,
  `id_wilayah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `tb_petani_wilayah`
--

INSERT INTO `tb_petani_wilayah` (`id_petani_wilayah`, `id_petani`, `id_wilayah`) VALUES
(4, 4, 1),
(13, 5, 1),
(12, 6, 1),
(11, 7, 2),
(10, 8, 1),
(14, 9, 2),
(3, 10, 1),
(15, 55, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_produk` varchar(150) NOT NULL,
  `stok_produk` int(11) DEFAULT 0,
  `grade` varchar(50) DEFAULT NULL,
  `jenis_kopi` varchar(50) DEFAULT NULL,
  `harga` decimal(12,2) DEFAULT NULL,
  `altitude` varchar(100) DEFAULT NULL,
  `flavor_notes` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `proses` varchar(100) DEFAULT NULL,
  `foto_utama` varchar(255) DEFAULT NULL,
  `status_produk` enum('Aktif','Nonaktif') DEFAULT 'Aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `id_user`, `nama_produk`, `stok_produk`, `grade`, `jenis_kopi`, `harga`, `altitude`, `flavor_notes`, `deskripsi`, `proses`, `foto_utama`, `status_produk`, `created_at`) VALUES
(38, 0, 'Ceri', 50, NULL, 'Liberica', 7000.00, '500 Meter', NULL, NULL, 'Tanpa Proses', '1a75ba084ef62bf43dc94a5bba8ab41d.jpg', 'Aktif', '2026-07-01 13:19:33'),
(39, 0, 'Biji Kopi', 80, NULL, 'Liberica', 70000.00, '500 Meter', NULL, NULL, 'Pencucian, Pengupasan, Penjemuran', 'bc9d2d48c220175b1333b6cb8a9ea46c.jpg', 'Aktif', '2026-07-01 13:21:03'),
(40, 0, 'Kopi Bubuk', 100, NULL, 'Liberica', 120000.00, '500 Meter', NULL, NULL, 'Pencucian, Pengupasan, Penjemuran, Penggilingan, Pengemasan', '86c4d18e47c017d676fe61d1cf8a2304.jpg', 'Aktif', '2026-07-01 13:21:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produk_galeri`
--

CREATE TABLE `tb_produk_galeri` (
  `id_galeri` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `urutan` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_setting_notifikasi`
--

CREATE TABLE `tb_setting_notifikasi` (
  `id_user` int(11) NOT NULL,
  `notif_transaksi` tinyint(1) NOT NULL DEFAULT 1,
  `notif_pembayaran` tinyint(1) DEFAULT 1,
  `notif_stok` tinyint(1) NOT NULL DEFAULT 1,
  `notif_kurir` tinyint(1) DEFAULT 1,
  `notif_pesanan` tinyint(1) DEFAULT 1,
  `notif_panen` tinyint(1) DEFAULT 1,
  `notif_petani` tinyint(1) DEFAULT 1,
  `notif_promo` tinyint(1) DEFAULT 0,
  `notif_laporan` tinyint(1) DEFAULT 0,
  `notif_sistem` tinyint(1) NOT NULL DEFAULT 1,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `tb_setting_notifikasi`
--

INSERT INTO `tb_setting_notifikasi` (`id_user`, `notif_transaksi`, `notif_pembayaran`, `notif_stok`, `notif_kurir`, `notif_pesanan`, `notif_panen`, `notif_petani`, `notif_promo`, `notif_laporan`, `notif_sistem`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 0, 0, 1, 0, 1, 0, '2026-07-01 10:25:57'),
(2, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, '2026-07-01 19:28:23'),
(3, 0, 1, 0, 1, 1, 0, 0, 1, 0, 1, '2026-07-01 01:08:49'),
(6, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, '2026-06-26 11:00:08'),
(9, 1, 1, 1, 1, 0, 1, 0, 0, 0, 1, '2026-07-01 16:40:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tracking`
--

CREATE TABLE `tb_tracking` (
  `id_tracking` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_kurir` int(11) DEFAULT NULL,
  `status_pengiriman` enum('pending','diproses','dikirim','dalam_perjalanan','tiba_di_kota_tujuan','out_for_delivery','delivered','diterima','dibatalkan') DEFAULT 'pending',
  `estimasi_tiba` datetime DEFAULT NULL,
  `tanggal_kirim` datetime DEFAULT NULL,
  `tanggal_terima` datetime DEFAULT NULL,
  `bukti_pengiriman` varchar(255) DEFAULT NULL,
  `bukti_upload_at` datetime DEFAULT NULL,
  `bukti_upload_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_updated_by` int(11) DEFAULT NULL,
  `status_updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_tracking`
--

INSERT INTO `tb_tracking` (`id_tracking`, `id_transaksi`, `id_kurir`, `status_pengiriman`, `estimasi_tiba`, `tanggal_kirim`, `tanggal_terima`, `bukti_pengiriman`, `bukti_upload_at`, `bukti_upload_by`, `created_at`, `updated_at`, `status_updated_by`, `status_updated_at`) VALUES
(36, 25, 1, 'diterima', '2026-07-07 10:21:53', '2026-07-02 10:37:28', '2026-07-02 12:42:18', NULL, NULL, NULL, '2026-07-02 10:21:43', '2026-07-02 12:43:25', 1, '2026-07-02 12:42:18'),
(37, 26, 1, 'diterima', '2026-07-05 13:25:11', '2026-07-02 13:24:53', '2026-07-02 14:27:09', NULL, NULL, NULL, '2026-07-02 13:24:03', '2026-07-02 14:27:36', 1, '2026-07-02 13:29:04'),
(38, 27, 1, 'diterima', NULL, '2026-07-02 14:42:45', '2026-07-02 15:15:47', 'd37d319178e6c94e05a963dbc426417b.jpeg', '2026-07-02 14:59:18', 12, '2026-07-02 14:34:59', '2026-07-02 15:15:47', 1, '2026-07-02 15:15:47'),
(39, 28, 1, 'diterima', '2026-07-07 16:14:28', '2026-07-02 16:17:13', '2026-07-02 17:36:19', NULL, NULL, NULL, '2026-07-02 16:09:33', '2026-07-02 17:36:19', 1, '2026-07-02 17:35:31'),
(40, 29, 9, 'diterima', '2026-07-07 18:08:44', '2026-07-02 18:24:05', '2026-07-02 18:27:47', '09db4b4831b7f9176110625946dd401a.jpeg', '2026-07-02 18:25:55', 11, '2026-07-02 18:08:34', '2026-07-02 18:27:47', 1, '2026-07-02 18:27:47'),
(41, 30, NULL, 'dibatalkan', '2026-07-07 18:37:13', '2026-07-02 18:43:11', NULL, NULL, NULL, NULL, '2026-07-02 18:37:06', '2026-07-02 18:45:49', 1, '2026-07-02 18:45:49'),
(42, 31, NULL, 'dikirim', '2026-07-05 18:46:58', NULL, NULL, NULL, NULL, NULL, '2026-07-02 18:46:49', '2026-07-02 18:46:58', NULL, NULL),
(43, 32, 9, 'diterima', '2026-07-07 18:55:19', '2026-07-02 18:56:12', '2026-07-02 19:07:07', '4c9fa64e294ab1d8f860e0e927554b98.jpeg', '2026-07-02 19:06:42', 11, '2026-07-02 18:55:07', '2026-07-02 19:07:16', 1, '2026-07-02 19:07:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tracking_history`
--

CREATE TABLE `tb_tracking_history` (
  `id_history` int(11) NOT NULL,
  `id_tracking` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_tracking_history`
--

INSERT INTO `tb_tracking_history` (`id_history`, `id_tracking`, `status`, `latitude`, `longitude`, `lokasi`, `keterangan`, `created_at`) VALUES
(52, 43, 'pending', NULL, NULL, NULL, 'Kurir ditugaskan: Andi', '2026-07-02 18:56:07'),
(53, 43, 'dikirim', NULL, NULL, NULL, 'Status diperbarui oleh Admin: Ketua Poktan', '2026-07-02 18:56:12'),
(54, 43, 'dalam_perjalanan', NULL, NULL, NULL, 'Status diperbarui oleh Admin: Ketua Poktan', '2026-07-02 19:04:53'),
(55, 43, 'delivered', NULL, NULL, NULL, 'Bukti pengiriman telah diunggah oleh kurir', '2026-07-02 19:06:42'),
(56, 43, 'diterima', NULL, NULL, NULL, 'Status diperbarui oleh Admin: Ketua Poktan', '2026-07-02 19:07:07'),
(57, 43, 'diterima', NULL, NULL, NULL, 'Pesanan selesai. Status diperbarui ke Diterima.', '2026-07-02 19:07:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_tracking` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `email_pembeli` varchar(100) DEFAULT NULL,
  `invoice` varchar(50) DEFAULT NULL,
  `total_harga` int(11) DEFAULT 0,
  `ongkir` int(11) DEFAULT 0,
  `grand_total` int(11) DEFAULT 0,
  `alamat_kirim` text DEFAULT NULL,
  `kota_kirim` varchar(100) DEFAULT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `nama_penerima` varchar(100) DEFAULT NULL,
  `tanggal_transaksi` datetime DEFAULT current_timestamp(),
  `tanggal_konfirmasi` datetime DEFAULT NULL,
  `tanggal_batal` datetime DEFAULT NULL,
  `alasan_batal` text DEFAULT NULL,
  `id_petani` int(11) DEFAULT NULL,
  `id_kurir` int(11) DEFAULT NULL,
  `status_bayar` enum('Pending','Lunas','Batal') DEFAULT 'Pending',
  `status_pesanan` varchar(50) DEFAULT 'Pending',
  `metode_bayar` varchar(50) DEFAULT 'Transfer',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_tracking`, `id_user`, `email_pembeli`, `invoice`, `total_harga`, `ongkir`, `grand_total`, `alamat_kirim`, `kota_kirim`, `kode_pos`, `no_hp`, `nama_penerima`, `tanggal_transaksi`, `tanggal_konfirmasi`, `tanggal_batal`, `alasan_batal`, `id_petani`, `id_kurir`, `status_bayar`, `status_pesanan`, `metode_bayar`, `created_at`) VALUES
(32, 43, 3, 'pembeli@poktan.com', 'INV-000001', 190000, 20000, 210000, 'Jl.Sukarmai', 'Sambas', '342454', '086537654535', 'Budi', '2026-07-02 18:55:07', NULL, NULL, NULL, NULL, NULL, 'Lunas', 'Diproses', 'COD', '2026-07-02 18:55:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telepon` bigint(13) DEFAULT NULL,
  `kontak_terverifikasi` tinyint(1) NOT NULL DEFAULT 0,
  `role` enum('Admin','Petani','Pembeli') NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `status` enum('Active','Inactive','Pending') DEFAULT 'Pending',
  `is_verified` enum('0','1') DEFAULT '0',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `verification_token` varchar(255) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama`, `email`, `no_telepon`, `kontak_terverifikasi`, `role`, `foto`, `alamat`, `no_hp`, `status`, `is_verified`, `created_at`, `updated_at`, `verification_token`, `reset_token`, `token_expiry`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'Ketua Poktan', 'admin@poktan.com', 0, 1, 'Admin', NULL, NULL, NULL, 'Active', '0', '2026-06-21 19:32:57', '2026-06-28 22:44:15', NULL, NULL, NULL),
(2, 'petani', 'e24f980d21884c0fff8a3048f21822bf', 'Ahmad Petani', 'petani@poktan.com', NULL, 0, 'Petani', NULL, NULL, NULL, 'Active', '1', '2026-06-21 19:32:57', '2026-06-29 09:51:30', NULL, NULL, NULL),
(3, 'pembeli', '547ea1ce04c68f6bda9e2da0d1f253f5', 'Budi Pembeli', 'pembeli@poktan.com', NULL, 1, 'Pembeli', NULL, NULL, NULL, 'Active', '0', '2026-06-21 19:32:57', '2026-06-26 15:31:01', NULL, NULL, NULL),
(4, 'ragyl', 'e10adc3949ba59abbe56e057f20f883e', 'Muhammad Ragyl Alfari', 'ragyl03alfari@gmail.com', NULL, 0, 'Petani', NULL, NULL, NULL, 'Active', '0', '2026-06-22 11:50:16', '2026-06-22 11:50:19', NULL, NULL, NULL),
(5, 'teguh', 'e10adc3949ba59abbe56e057f20f883e', 'Teguh Maulana', 'teguhmaulana@gmail.com', NULL, 0, 'Pembeli', NULL, NULL, NULL, 'Active', '0', '2026-06-22 15:06:01', '2026-06-22 15:06:08', NULL, NULL, NULL),
(9, 'baku', 'e10adc3949ba59abbe56e057f20f883e', 'Baku', '', 6285754906905, 0, 'Petani', NULL, NULL, NULL, 'Active', '1', '2026-07-01 16:40:05', '2026-07-01 16:40:40', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_wilayah`
--

CREATE TABLE `tb_wilayah` (
  `id_wilayah` int(11) NOT NULL,
  `nama_wilayah` varchar(150) NOT NULL,
  `alamat_wilayah` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `tb_wilayah`
--

INSERT INTO `tb_wilayah` (`id_wilayah`, `nama_wilayah`, `alamat_wilayah`) VALUES
(1, 'Sempadian Tekarang', 'Kecamatan Tekarang, Kabupaten Sambas, Provinsi Kalimantan Barat'),
(2, 'Sendoyan Batu Layar', 'Dusun Batu Layar, Desa Sendoyan, Kecamatan Sejangkung, Kabupaten Sambas, Kalimantan Barat');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_bukti_bayar`
--
ALTER TABLE `tb_bukti_bayar`
  ADD PRIMARY KEY (`id_bukti`),
  ADD KEY `idx_transaksi` (`id_transaksi`);

--
-- Indeks untuk tabel `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `idx_transaksi_detail` (`id_transaksi`);

--
-- Indeks untuk tabel `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `idx_user_keranjang` (`id_user`),
  ADD KEY `idx_session_keranjang` (`session_id`);

--
-- Indeks untuk tabel `tb_kurir`
--
ALTER TABLE `tb_kurir`
  ADD PRIMARY KEY (`id_kurir`);

--
-- Indeks untuk tabel `tb_lahan`
--
ALTER TABLE `tb_lahan`
  ADD PRIMARY KEY (`id_lahan`);

--
-- Indeks untuk tabel `tb_mitra`
--
ALTER TABLE `tb_mitra`
  ADD PRIMARY KEY (`id_mitra`);

--
-- Indeks untuk tabel `tb_notifikasi`
--
ALTER TABLE `tb_notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`),
  ADD KEY `id_user_idx` (`id_user`);

--
-- Indeks untuk tabel `tb_ongkir`
--
ALTER TABLE `tb_ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indeks untuk tabel `tb_otp`
--
ALTER TABLE `tb_otp`
  ADD PRIMARY KEY (`id_otp`),
  ADD KEY `idx_tujuan` (`tujuan`),
  ADD KEY `idx_user` (`id_user`);

--
-- Indeks untuk tabel `tb_panen`
--
ALTER TABLE `tb_panen`
  ADD PRIMARY KEY (`id_panen`),
  ADD KEY `idx_lahan_panen` (`id_lahan`),
  ADD KEY `idx_user_panen` (`id_user`);

--
-- Indeks untuk tabel `tb_petani`
--
ALTER TABLE `tb_petani`
  ADD PRIMARY KEY (`id_petani`);

--
-- Indeks untuk tabel `tb_petani_wilayah`
--
ALTER TABLE `tb_petani_wilayah`
  ADD PRIMARY KEY (`id_petani_wilayah`),
  ADD UNIQUE KEY `unik_petani_wilayah` (`id_petani`,`id_wilayah`),
  ADD KEY `id_petani` (`id_petani`),
  ADD KEY `id_wilayah` (`id_wilayah`);

--
-- Indeks untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `tb_produk_galeri`
--
ALTER TABLE `tb_produk_galeri`
  ADD PRIMARY KEY (`id_galeri`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `tb_setting_notifikasi`
--
ALTER TABLE `tb_setting_notifikasi`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `tb_tracking`
--
ALTER TABLE `tb_tracking`
  ADD PRIMARY KEY (`id_tracking`),
  ADD UNIQUE KEY `unique_transaksi` (`id_transaksi`),
  ADD KEY `idx_kurir` (`id_kurir`);

--
-- Indeks untuk tabel `tb_tracking_history`
--
ALTER TABLE `tb_tracking_history`
  ADD PRIMARY KEY (`id_history`),
  ADD KEY `idx_tracking` (`id_tracking`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `idx_user` (`id_user`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `no_telepon` (`no_telepon`);

--
-- Indeks untuk tabel `tb_wilayah`
--
ALTER TABLE `tb_wilayah`
  ADD PRIMARY KEY (`id_wilayah`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_bukti_bayar`
--
ALTER TABLE `tb_bukti_bayar`
  MODIFY `id_bukti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_kurir`
--
ALTER TABLE `tb_kurir`
  MODIFY `id_kurir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_lahan`
--
ALTER TABLE `tb_lahan`
  MODIFY `id_lahan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_mitra`
--
ALTER TABLE `tb_mitra`
  MODIFY `id_mitra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_notifikasi`
--
ALTER TABLE `tb_notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT untuk tabel `tb_ongkir`
--
ALTER TABLE `tb_ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tb_otp`
--
ALTER TABLE `tb_otp`
  MODIFY `id_otp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `tb_panen`
--
ALTER TABLE `tb_panen`
  MODIFY `id_panen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_petani`
--
ALTER TABLE `tb_petani`
  MODIFY `id_petani` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT untuk tabel `tb_petani_wilayah`
--
ALTER TABLE `tb_petani_wilayah`
  MODIFY `id_petani_wilayah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `tb_produk_galeri`
--
ALTER TABLE `tb_produk_galeri`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_tracking`
--
ALTER TABLE `tb_tracking`
  MODIFY `id_tracking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `tb_tracking_history`
--
ALTER TABLE `tb_tracking_history`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_wilayah`
--
ALTER TABLE `tb_wilayah`
  MODIFY `id_wilayah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_produk_galeri`
--
ALTER TABLE `tb_produk_galeri`
  ADD CONSTRAINT `tb_produk_galeri_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
