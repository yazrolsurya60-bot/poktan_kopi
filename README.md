# LiberChain

## 📖 Gambaran Proyek

**LiberChain** adalah sistem manajemen berbasis web untuk koperasi petani kopi (Poktan). Sistem ini memungkinkan administrator, petani, manajer produk, kurir, dan mitra untuk mengelola:

- **Data Lahan** – lokasi, ukuran, pemilik.
- **Catatan Panen** – data panen periodik per lahan.
- **Produk** – detail batch kopi, harga, gambar.
- **Manajemen Pengguna** – admin, petani, kurir, mitra.
- **Laporan & Dashboard** – visualisasi produksi, penjualan, dan logistik.

Dibangun dengan **CodeIgniter 3** (PHP) mengikuti arsitektur MVC, aplikasi menyediakan antarmuka bersih dan responsif untuk browser desktop maupun seluler.

---

## ✨ Fitur Utama

- **Kontrol akses berbasis peran** (Admin, Petani, Kurir, Mitra)
- Operasi CRUD lengkap untuk lahan, panen, produk, dan pengguna
- Penanganan unggah foto produk
- Dashboard interaktif dengan diagram dan tabel
- Ekspor data (CSV/Excel) untuk data petani dan produk
- Dukungan multi-bahasa (i18n) untuk masa depan
- Otentikasi aman & penanganan sesi
- Desain responsif modern dengan gradien, efek glassmorphism, dan micro‑animasi halus

---

## 🛠️ Teknologi yang Digunakan

| Lapisan | Teknologi |
|---------|-----------|
| **Backend** | PHP 7.x, CodeIgniter 3 (MVC) |
| **Database** | MySQL / MariaDB |
| **Frontend** | HTML5, CSS3 (vanilla, komponen UI khusus), JavaScript (jQuery) |
| **Server** | Apache (XAMPP) |
| **Version Control** | Git |

---

## 📦 Panduan Instalasi

1. **Prasyarat**
   - XAMPP (Apache, PHP, MySQL) terpasang di Windows.
   - Composer (opsional, untuk manajemen dependensi di masa depan).
2. **Clone repositori**
   ```bash
   git clone https://github.com/yazrolsurya60-bot/poktan_kopi.git
   ```
3. **Konfigurasi basis data**
   - Buat basis data MySQL baru, misalnya `liberchain`.
   - Impor file dump SQL `database/poktan_kopi.sql` jika tersedia.
4. **Perbarui konfigurasi**
   - Edit `application/config/config.php`:
     ```php
     $config['base_url'] = 'http://localhost/poktan_kopi/';
     $db['default'] = array(
       'hostname' => 'localhost',
       'username' => 'root',
       'password' => '',
       'database' => 'liberchain',
       // ... pengaturan lainnya ...
     );
     ```
5. **Setel izin folder**
   - Pastikan folder `uploads/` dan `application/cache/` dapat ditulisi oleh Apache.
6. **Jalankan aplikasi**
   - Mulai layanan Apache & MySQL melalui XAMPP.
   - Buka `http://localhost/poktan_kopi/` di peramban.

---

## ⚙️ Rincian Konfigurasi

- **Base URL** – didefinisikan di `application/config/config.php`.
- **Kunci enkripsi** – atur `$config['encryption_key']` untuk keamanan sesi.
- **Pengaturan email** – konfigurasi SMTP opsional di `application/config/email.php` untuk notifikasi.
- **Lingkungan** – ubah `$config['environment']` menjadi `development` atau `production` untuk mengatur tingkat laporan error.

---

## 🚀 Menjalankan Secara Lokal

```bash
# Menggunakan server bawaan PHP (untuk pengujian cepat)
php -S localhost:8000 -t public
```

Atau cukup gunakan layanan Apache XAMPP sebagaimana dijelaskan di atas.

---

## 📂 Struktur Direktori

```
├─ application/            # Inti MVC CodeIgniter
│   ├─ config/            # File konfigurasi (config.php, routes.php, dll.)
│   ├─ controllers/       # Kontroler (Welcome.php, admin/, petani/)
│   ├─ models/            # Model data (Panen_model.php, dll.)
│   └─ views/             # Template HTML (admin/, petani/, landing/)
├─ assets/                # CSS, JS, gambar UI
├─ uploads/               # Gambar produk yang diunggah
├─ database/              # File dump SQL opsional
└─ README.md              # Dokumentasi proyek (file ini)
```

---

## 🤝 Kontribusi

1. Fork repositori.
2. Buat cabang fitur (`git checkout -b feature/fitur-anda`).
3. Commit perubahan dengan pesan yang jelas.
4. Buat Pull Request menuju `main`.
5. Pastikan semua tes yang ada lulus (`phpunit` – jika ada suite tes).

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah **MIT License** – lihat file `LICENSE` untuk detailnya.

---

## 📞 Dukungan & Kontak

Untuk pertanyaan atau kontribusi, hubungi pemelihara repositori:
- **GitHub**: https://github.com/yazrolsurya60-bot/poktan_kopi
---

*Dibuat pada 2026‑06‑25.*
