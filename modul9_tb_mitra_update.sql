-- SQL UPDATE UNTUK MODUL 9
-- Mengeksekusi ini akan menambahkan kolom yang kurang pada tabel tb_mitra bawaan Anda

ALTER TABLE `tb_mitra`
ADD COLUMN `nama_mitra` varchar(150) NOT NULL AFTER `id_mitra`,
ADD COLUMN `kategori_mitra` varchar(100) NOT NULL AFTER `nama_mitra`,
ADD COLUMN `logo_mitra` varchar(255) DEFAULT 'default.png' AFTER `kategori_mitra`,
ADD COLUMN `urutan_tampil` int(11) NOT NULL DEFAULT 1 AFTER `logo_mitra`,
ADD COLUMN `created_at` timestamp NOT NULL DEFAULT current_timestamp() AFTER `status_mitra`;

-- Mengisi data default untuk baris yang sudah ada agar tidak kosong
UPDATE `tb_mitra` SET `nama_mitra` = 'Mitra Satu', `kategori_mitra` = 'Cafe', `urutan_tampil` = 1 WHERE `id_mitra` = 1;
UPDATE `tb_mitra` SET `nama_mitra` = 'Mitra Dua', `kategori_mitra` = 'Toko', `urutan_tampil` = 2 WHERE `id_mitra` = 2;
UPDATE `tb_mitra` SET `nama_mitra` = 'Mitra Tiga', `kategori_mitra` = 'Distributor', `urutan_tampil` = 3 WHERE `id_mitra` = 3;
