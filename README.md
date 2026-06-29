# LiberChain - Sistem Supply Chain Kopi

## 📖 Gambaran Proyek

**LiberChain** adalah sistem manajemen berbasis web untuk koperasi petani kopi (Poktan). Sistem ini memungkinkan administrator, petani, pembeli, dan mitra untuk mengelola:

- **Data Lahan** – lokasi, ukuran, pemilik.
- **Catatan Panen** – data panen periodik per lahan.
- **Produk** – detail batch kopi, harga, gambar.
- **Manajemen Pengguna** – admin, petani, pembeli, mitra.
- **Verifikasi Akun** – sistem verifikasi khusus untuk petani.
- **Laporan & Dashboard** – visualisasi produksi, penjualan, dan logistik.

Dibangun dengan **CodeIgniter 3** (PHP) mengikuti arsitektur MVC, aplikasi menyediakan antarmuka bersih dan responsif untuk browser desktop maupun seluler.

---

## ✨ Fitur Utama

### 🔐 Sistem Autentikasi & OTP
- **Registrasi dengan OTP** - Verifikasi WhatsApp menggunakan Fonnte API
- **Reset Password via OTP** - Lupa password dengan verifikasi WhatsApp
- **Kontrol akses berbasis peran** (Admin, Petani, Pembeli, Guest)
- **Verifikasi Akun Petani** - Admin dapat memverifikasi akun petani baru

### 👥 Manajemen User (Admin)
- **CRUD User Lengkap** - Tambah, edit, hapus, dan lihat detail user
- **Aktivasi/Nonaktifkan Akun** - Kontrol status user (Aktif/Nonaktif)
- **Verifikasi Petani** - Verifikasi khusus untuk akun petani
- **Pencarian & Filter** - Cari user berdasarkan nama, username, role, atau status
- **Form Tambah User** - Nama lengkap, username, nomor telepon, email, password, role
- **Form Edit User** - Edit data user termasuk status verifikasi (khusus petani)

### 🌾 Manajemen Petani
- **Data Lahan** - Kelola lahan pertanian
- **Catatan Panen** - Input data panen periodik
- **Upload Foto** - Dokumentasi lahan dan panen

### 📦 Manajemen Produk
- **CRUD Produk** - Kelola produk kopi
- **Upload Gambar** - Foto produk dengan preview
- **Manajemen Harga** - Update harga produk

### 🚚 Manajemen Kurir & Mitra
- **Data Kurir** - Kelola data kurir pengiriman
- **Data Mitra** - Kelola mitra bisnis

### 📊 Laporan & Analytics
- **Dashboard Interaktif** - Grafik dan statistik
- **Ekspor Data** - Export CSV/Excel untuk data petani dan produk
- **Laporan Transaksi** - Riwayat transaksi

### 🎨 UI/UX Modern
- Desain responsif dengan gradien dan glassmorphism
- Micro-animasi halus untuk pengalaman pengguna
- Sidebar navigasi yang elegan
- Alert messages dengan icon yang informatif

---

## 🛠️ Teknologi yang Digunakan

| Lapisan | Teknologi |
|---------|-----------|
| **Backend** | PHP 7.x, CodeIgniter 3 (MVC) |
| **Database** | MySQL / MariaDB |
| **Frontend** | HTML5, CSS3 (vanilla, komponen UI khusus), JavaScript (jQuery) |
| **WhatsApp API** | Fonnte API untuk pengiriman OTP |
| **Server** | Apache (XAMPP) |
| **Version Control** | Git |

---

## 📦 Panduan Instalasi

### 1. Prasyarat
- XAMPP (Apache, PHP 7.2+, MySQL) terpasang di Windows
- Composer (opsional)
- Akun Fonnte API untuk fitur WhatsApp OTP

### 2. Clone Repositori
```bash
git clone https://github.com/yazrolsurya60-bot/poktan_kopi.git
cd poktan_kopi
```

### 3. Konfigurasi Database
- Buat database MySQL baru: `poktan_kopi`
- Import struktur database dari `migration_otp_system.sql`
- Atau jalankan migrasi melalui browser: `http://localhost/poktan_kopi/apply_migration.php`

### 4. Konfigurasi Aplikasi
Edit `application/config/config.php`:
```php
$config['base_url'] = 'http://localhost/poktan_kopi/';
$config['encryption_key'] = 'your-encryption-key-here';
```

Edit `application/config/database.php`:
```php
$db['default'] = array(
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'liberchain',
    'dbdriver' => 'mysqli',
    // ... pengaturan lainnya ...
);
```

### 5. Konfigurasi Fonnte API (WhatsApp OTP)
Edit `application/helpers/fonnte_helper.php`:
```php
$token = "YOUR_FONNTE_API_TOKEN"; // Ganti dengan token Anda
```

### 6. Setel Izin Folder
```bash
# Windows (Command Prompt sebagai Administrator)
icacls uploads /grant Everyone:(OI)(CI)F
icacls application/cache /grant Everyone:(OI)(CI)F
```

### 7. Jalankan Aplikasi
- Mulai layanan Apache & MySQL melalui XAMPP
- Buka `http://localhost/poktan_kopi/` di browser
- Login sebagai admin (cek database untuk kredensial default)

---

## ⚙️ Rincian Konfigurasi

- **Base URL** – `application/config/config.php`
- **Kunci enkripsi** – `$config['encryption_key']` untuk keamanan sesi
- **Database** – `application/config/database.php`
- **WhatsApp API** – `application/helpers/fonnte_helper.php` (token Fonnte)
- **Lingkungan** – `$config['environment']` untuk development/production

---

## 🗄️ Struktur Database

### Tabel Utama:
1. **tb_user** - Data pengguna sistem
   - Kolom baru: `no_telepon`, `is_verified`
   
2. **tb_otp** - Penyimpanan kode OTP (baru)
   - Untuk verifikasi registrasi dan reset password
   
3. **tb_lahan** - Data lahan pertanian
4. **tb_panen** - Catatan panen
5. **tb_produk** - Data produk kopi
6. **tb_transaksi** - Riwayat transaksi
7. **tb_kurir** - Data kurir
8. **tb_mitra** - Data mitra

---

## 🚀 Menjalankan Secara Lokal

### Menggunakan XAMPP (Recommended)
1. Start Apache dan MySQL di XAMPP Control Panel
2. Buka browser dan akses `http://localhost/poktan_kopi/`

### Menggunakan PHP Built-in Server (untuk testing)
```bash
php -S localhost:8000 -t .
```

---

## 📂 Struktur Direktori

```
├─ application/            # Inti MVC CodeIgniter
│   ├─ config/            # File konfigurasi
│   │   ├─ config.php     # Konfigurasi umum
│   │   ├─ database.php   # Konfigurasi database
│   │   └─ autoload.php   # Autoload libraries & helpers
│   ├─ controllers/       # Kontroler
│   │   ├─ Auth.php       # Autentikasi (login, register, forgot password)
│   │   ├─ admin/
│   │   │   └─ Users.php  # Manajemen user (CRUD, verifikasi)
│   │   ├─ petani/        # Controller untuk petani
│   │   ├─ pembeli/       # Controller untuk pembeli
│   │   └─ ...
│   ├─ models/            # Model data
│   │   └─ User_model.php # Model user dengan OTP functions
│   ├─ views/             # Template HTML
│   │   ├─ admin/users/   # Views manajemen user
│   │   │   ├─ v_manajemen_user.php  # Daftar user
│   │   │   ├─ add.php               # Form tambah user
│   │   │   ├─ edit.php              # Form edit user
│   │   │   ├─ v_detail_user.php     # Detail user
│   │   │   └─ v_verifikasi_petani.php # Verifikasi petani
│   │   ├─ auth/
│   │   │   ├─ v_register.php        # Form registrasi dengan OTP
│   │   │   ├─ v_forgot_password.php # Reset password dengan OTP
│   │   │   └─ v_login.php           # Halaman login
│   │   └─ ...
│   └─ helpers/
│       └─ fonnte_helper.php  # Helper untuk WhatsApp OTP
├─ assets/                # CSS, JS, gambar UI
├─ uploads/               # Upload gambar (produk, profil, dll.)
│   ├─ produk/
│   ├─ dokumen/
│   ├─ panen/
│   └─ profile/
├─ migration_otp_system.sql  # Script migrasi database OTP
├─ apply_migration.php       # Runner migrasi (hapus setelah pakai)
└─ README.md              # Dokumentasi proyek
```

---

## 🔄 Fitur OTP (One-Time Password)

### Alur Registrasi dengan OTP:
1. User mengisi form registrasi (nama, username, nomor telepon, password, role)
2. Sistem generate OTP 6 digit dan kirim via WhatsApp (Fonnte API)
3. User memasukkan kode OTP di halaman verifikasi
4. Jika valid, akun dibuat (Petani perlu verifikasi admin, Pembeli langsung aktif)

### Alur Reset Password:
1. User memasukkan nomor telepon yang terdaftar
2. Sistem kirim OTP ke WhatsApp
3. User verifikasi OTP
4. User dapat mengganti password baru

### Keamanan OTP:
- Kadaluarsa 5 menit
- Maksimal 5 percobaan
- Terenkripsi dan aman

---

## 👥 Role & Permission

| Role | Deskripsi | Verifikasi |
|------|-----------|------------|
| **Admin** | Kelola seluruh sistem | - |
| **Petani** | Input lahan, panen, produk | Perlu verifikasi admin |
| **Pembeli** | Lihat produk, beli kopi | Otomatis terverifikasi |
| **Guest** | Akses terbatas | - |

---

## 🧪 Testing

### Manual Testing Checklist:
- [ ] Registrasi dengan OTP (Petani & Pembeli)
- [ ] Verifikasi OTP (kode benar & salah)
- [ ] Reset password dengan OTP
- [ ] Login dengan akun baru
- [ ] Admin dapat menambah user
- [ ] Admin dapat edit user
- [ ] Admin dapat aktivasi/nonaktifkan user
- [ ] Admin dapat verifikasi petani
- [ ] Pencarian user bekerja
- [ ] Upload foto produk

---

## 🐛 Troubleshooting

### OTP Tidak Terkirim:
1. Pastikan token Fonnte API valid di `fonnte_helper.php`
2. Pastikan nomor telepon dalam format yang benar (628xxx)
3. Cek log di `application/logs/`

### Error 500 saat Registrasi:
1. Jalankan migrasi database: `apply_migration.php`
2. Pastikan tabel `tb_otp` dan kolom baru di `tb_user` sudah ada
3. Cek error log untuk detail

### Upload Gambar Gagal:
1. Pastikan folder `uploads/` memiliki permission write (chmod 777)
2. Cek `upload_max_filesize` di `php.ini`

---

## 🤝 Kontribusi

1. Fork repositori
2. Buat cabang fitur (`git checkout -b feature/fitur-anda`)
3. Commit perubahan dengan pesan yang jelas
4. Buat Pull Request menuju `main`
5. Pastikan kode mengikuti standar yang ada

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah **MIT License** – lihat file `LICENSE` untuk detailnya.

---

## 📞 Dukungan & Kontak

Untuk pertanyaan atau kontribusi, hubungi pemelihara repositori:
- **GitHub**: https://github.com/yazrolsurya60-bot/poktan_kopi
- **Email**: [kontak pengembang]

---

## 📝 Changelog

### v2.0.0 (2026-06-29) - OTP System & Admin Improvements
- ✨ Sistem OTP untuk registrasi dan reset password
- ✨ Integrasi WhatsApp API (Fonnte)
- ✨ Manajemen user CRUD lengkap
- ✨ Fitur aktivasi/nonaktifkan user
- ✨ Verifikasi akun petani oleh admin
- ✨ Form tambah user dengan field lengkap (nama, username, no. telepon, role)
- ✨ Form edit user dengan verifikasi status
- 🐛 Fixed HTTP 500 error saat registrasi OTP
- 🐛 Fixed OTP verification tidak menampilkan feedback

### v1.0.0 (2026-06-25) - Initial Release
- Manajemen lahan, panen, produk
- Dashboard dan laporan
- Multi-role authentication

---

*Dibuat pada 2026-06-25 | Terakhir diperbarui: 2026-06-29*