<<<<<<< HEAD
=======
<<<<<<< HEAD
# poktan_kopi
Seluruh perubahan kode yang di lakukan, di push di repositori ini. 
=======
>>>>>>> 5e259f91ac99edad6eba8d6d12534512a79b1062
# LiberChain – Sistem Manajemen Supply Chain Kopi

## Deskripsi Singkat
Aplikasi **LiberChain** adalah platform berbasis web yang dirancang untuk mengelola seluruh proses rantai pasokan kopi, mulai dari petani, produsen, hingga pembeli. Sistem ini menyediakan dashboard admin premium dengan tampilan modern (tema premium, warna hangat, tipografi *Plus Jakarta Sans*) serta modul manajemen pengguna lengkap.

## Penjelasan Aplikasi
LiberChain membantu mengoptimalkan rantai pasokan kopi dengan menyediakan fitur-fitur seperti pelacakan produksi, manajemen stok, laporan penjualan, serta integrasi data real-time antara petani, mitra, kurir, dan pembeli. Sistem ini memanfaatkan arsitektur MVC CodeIgniter untuk memisahkan logika bisnis, data, dan tampilan, memastikan pemeliharaan yang mudah dan skalabilitas.

Dengan antarmuka yang responsif dan desain modern, pengguna dapat mengakses dashboard melalui perangkat desktop maupun mobile, memantau status order, notifikasi, serta melihat statistik performa secara visual menggunakan Chart.js.

## Fitur Utama
- **Dashboard Admin**: Sidebar premium, statistik ringkas, notifikasi real‑time, dan grafik Chart.js.
- **Manajemen User** (CRUD): Tambah, edit, hapus, serta aktivasi/non‑aktivasi pengguna dengan peran *Admin*, *Petani*, *Pembeli*, atau *Guest*.
- **Autentikasi**: Login/logout berbasis session, proteksi akses admin.
- **Role‑Based Access Control**: Hanya admin yang dapat mengakses modul manajemen.
- **Responsive Design**: Tata letak menyesuaikan layar desktop hingga mobile.
- **Styling Premium**: Menggunakan variabel CSS (`--roasted-brown`, `--dark-coffee`, dll.) untuk konsistensi visual.
- **Tracking**: Real‑time pelacakan status order untuk petani, mitra, kurir, dan pembeli.
- **Laporan**: Generate laporan penjualan & produksi, dukungan ekspor Excel & PDF.
- **Manajemen Mitra & Panen**: CRUD lengkap untuk data mitra dan data panen, termasuk pencatatan volume panen, kualitas, tanggal, serta integrasi stok real‑time yang memungkinkan petani memperbarui hasil panen dan admin memantau ketersediaan stok.
- **API Endpoints**: Penyediaan API untuk integrasi dengan aplikasi pihak ketiga.


## Teknologi yang Digunakan
- **Backend**: CodeIgniter 3 (PHP) – MVC pattern, routing, model `User_model`.
- **Frontend**: HTML5, Bootstrap 5, CSS custom, JavaScript (jQuery) untuk interaksi AJAX (status toggle).
- **Database**: MySQL (password disimpan dengan MD5 untuk kompatibilitas legacy).

## Struktur Direktori Penting
```
application/
├─ controllers/
│   └─ admin/Users.php      # Kontroler CRUD user
│   └─ admin/Dashboard.php  # Dashboard utama
├─ models/
│   └─ User_model.php       # Interaksi DB user
├─ views/
│   ├─ admin/
│   │   ├─ v_dashboard.php # Tampilan dashboard premium
│   │   ├─ v_manajemen_user.php # Tampilan manajemen user (tema serasi)
│   │   └─ users/ (add, edit, index)
└─ config/routes.php        # Routing admin/*
```

## Cara Menjalankan
1. Pastikan **XAMPP** (Apache & MySQL) aktif.
2. Import skema database yang ada di `database.sql` (tidak termasuk dalam repo).
3. Sesuaikan `application/config/database.php` dengan kredensial lokal.
4. Jalankan `http://localhost/poktan_kopi/` → masuk ke login admin.
5. Setelah login, Anda dapat mengakses *Dashboard* dan *Manajemen User*.

## Catatan Pengembangan
- Email verifikasi dan fitur *Forgot Password* masih dicurigai karena belum terhubung ke server SMTP.
- Password disimpan menggunakan `md5()`; jika ingin meningkatkan keamanan, ganti dengan `password_hash()` dan migrasi data.
- Semua tampilan mengikuti tema yang didefinisikan di `v_dashboard.php`; pastikan perubahan CSS dilakukan di sana untuk konsistensi.

---
*Repository ini mencatat semua perubahan kode yang dipush ke Git. Pastikan commit secara teratur untuk melacak evolusi aplikasi.*
<<<<<<< HEAD
=======

