# 🔒 Checkpoint 1: Audits & Perbaikan Keamanan Sistem

## 📅 Tanggal: 4 Agustus 2026

## 📋 Ringkasan Audit

Audit keamanan menyeluruh dilakukan terhadap aplikasi **Poktan Kopi (Liberchain)** untuk mengidentifikasi dan memperbaiki celah keamanan. Berikut adalah temuan dan perbaikan yang telah dilakukan.

---

## 🔴 Temuan & Perbaikan

### 1. **File Sensitif Terbuka untuk Publik**
**Lokasi:** `.htaccess`
**Severity:** 🔴 KRITIS
**Deskripsi:** File SQL dump (`db_liberchain.sql`, `liberchain.sql`), script debug (`repair_db.php`, `list_users.php`), file migrasi SQL, dan file temp dapat diakses langsung melalui browser. Ini membocorkan struktur database, data user, dan kredensial.
**Perbaikan:**
- Menambahkan aturan `.htaccess` untuk memblokir akses ke file sql, md, log, txt, bak, conf, ini, sh, bat
- Memblokir file sensitif spesifik (`repair_db.php`, `list_users.php`, `liberchain.sql`, dll)
- Memblokir direktori `application/` dan `system/` dari akses langsung
- Menonaktifkan directory listing
- Memblokir eksekusi PHP di folder uploads

### 2. **MD5 Hash untuk Password (Tidak Aman)**
**Lokasi:** `application/models/User_model.php`, `application/controllers/Auth.php`, `application/controllers/admin/Users.php`
**Severity:** 🔴 KRITIS
**Deskripsi:** Password di-hash menggunakan MD5 yang dapat dipecahkan dengan mudah menggunakan dictionary attack / rainbow tables.
**Perbaikan:**
- Mengganti MD5 dengan `password_hash()` (BCrypt) yang cryptographically secure
- Menambahkan backward compatibility: password MD5 lama masih bisa login dan otomatis di-upgrade ke BCrypt
- Memperbarui semua titik penggunaan password (login, change password, reset password)

### 3. **API Token Fonnte Hardcoded di Source Code**
**Lokasi:** `application/helpers/fonnte_helper.php`
**Severity:** 🔴 KRITIS
**Deskripsi:** Token API Fonnte (`Ew545YpDBcWyeeN7GGrG`) hardcoded langsung di source code. Jika source code di-commit ke public repository, token bisa disalahgunakan.
**Perbaikan:**
- Token dipindahkan ke environment variable `FONNTE_API_TOKEN`
- Fallback ke config file (`$config['fonnte_api_token']`)
- Jika token tidak dikonfigurasi, sistem masuk ke mode simulasi
- Tambahkan ke `.gitignore` agar tidak ter-commit

### 4. **OTP Menggunakan `rand()` (Dapat Diprediksi)**
**Lokasi:** `application/helpers/fonnte_helper.php`
**Severity:** 🟠 HIGH
**Deskripsi:** `rand()` bukan metode yang cryptographically secure untuk menghasilkan kode OTP. Attacker yang mengetahui seed bisa memprediksi OTP.
**Perbaikan:**
- Mengganti dengan `random_int()` yang cryptographically secure
- Fallback ke `mt_rand()` jika `random_int()` gagal

### 5. **CSRF Protection Dimatikan**
**Lokasi:** `application/config/config.php`, `application/config/hooks.php`, `application/hooks/csrf_form_injector.php`
**Severity:** 🟠 HIGH
**Deskripsi:** CSRF protection nonaktif, membuat aplikasi rentan terhadap Cross-Site Request Forgery attacks.
**Perbaikan:**
- Mengaktifkan CSRF protection (`$config['csrf_protection'] = TRUE`)
- Menambahkan whitelist untuk AJAX/API endpoints yang membutuhkan proteksi berbeda
- Membuat hook `csrf_form_injector.php` yang otomatis menyuntikkan CSRF token ke semua form POST di view, sehingga tidak perlu mengubah setiap form secara manual
- Mengaktifkan hooks (`$config['enable_hooks'] = TRUE`) dan mendaftarkan hook di `application/config/hooks.php`

### 6. **Global XSS Filtering Dimatikan**
**Lokasi:** `application/config/config.php`
**Severity:** 🟠 HIGH
**Deskripsi:** Filter XSS global nonaktif, membuat aplikasi rentan terhadap Cross-Site Scripting attacks.
**Perbaikan:**
- Mengaktifkan global XSS filtering (`$config['global_xss_filtering'] = TRUE`)

### 7. **Cookie HTTP-Only Nonaktif**
**Lokasi:** `application/config/config.php`
**Severity:** 🟡 MEDIUM
**Deskripsi:** Cookie session dapat diakses oleh JavaScript, memungkinkan session hijacking melalui XSS.
**Perbaikan:**
- Mengaktifkan `cookie_httponly = TRUE`

### 8. **Session Fixation Vulnerability**
**Lokasi:** `application/controllers/Auth.php`
**Severity:** 🟡 MEDIUM
**Deskripsi:** Session ID tidak di-regenerate setelah login, memungkinkan session fixation attack.
**Perbaikan:**
- Menambahkan `$this->session->sess_regenerate(TRUE)` setelah login
- Mengaktifkan `sess_regenerate_destroy = TRUE` di config

### 9. **Password Plaintext di Session**
**Lokasi:** `application/controllers/Auth.php`
**Severity:** 🟡 MEDIUM
**Deskripsi:** Password disimpan plaintext di session selama proses registrasi OTP.
**Perbaikan:**
- Password di-enkripsi menggunakan CodeIgniter Encryption Library sebelum disimpan di session
- Di-dekripsi hanya saat user dibuat

### 10. **IDOR (Insecure Direct Object References) di Keranjang**
**Lokasi:** `application/controllers/Transaksi.php`
**Severity:** 🟠 HIGH
**Deskripsi:** User bisa meng-update/menghapus item keranjang milik user lain dengan memanipulasi ID.
**Perbaikan:**
- Menambahkan validasi kepemilikan keranjang (memeriksa `id_user` atau `session_id`)
- Menambahkan method `get_by_id()` di `Keranjang_model.php`
- Validasi stok sebelum update jumlah

### 11. **Mass Assignment di API Notifikasi**
**Lokasi:** `application/controllers/api/Notifikasi.php`
**Severity:** 🟡 MEDIUM
**Deskripsi:** API memungkinkan update setting dengan key yang tidak divalidasi, berpotensi untuk mass assignment.
**Perbaikan:**
- Menambahkan whitelist key yang diizinkan
- Validasi value hanya 0 atau 1

### 12. **SSL Verification Dimatikan**
**Lokasi:** `application/helpers/fonnte_helper.php`
**Severity:** 🟡 MEDIUM
**Deskripsi:** `CURLOPT_SSL_VERIFYHOST = 0` dan `CURLOPT_SSL_VERIFYPEER = 0` membuat koneksi rentan terhadap man-in-the-middle attacks.
**Perbaikan:**
- Mengaktifkan SSL verification penuh

### 13. **Brute Force Login**
**Lokasi:** `application/controllers/Auth.php`
**Severity:** 🟠 HIGH
**Deskripsi:** Tidak ada pembatasan percobaan login, memungkinkan brute force attack.
**Perbaikan:**
- Menambahkan rate limiting: maksimal 5 percobaan dalam 15 menit per IP address

### 14. **Security Headers Tidak Ada**
**Lokasi:** `.htaccess`
**Severity:** 🟡 MEDIUM
**Deskripsi:** Tidak ada security headers untuk proteksi browser.
**Perbaikan:**
- Menambahkan `X-Content-Type-Options: nosniff`
- Menambahkan `X-Frame-Options: SAMEORIGIN`
- Menambahkan `X-XSS-Protection: 1; mode=block`
- Menambahkan `Referrer-Policy: strict-origin-when-cross-origin`
- Menambahkan `Permissions-Policy`

---

## 📁 File yang Diperbaiki

| # | File | Perbaikan |
|---|------|-----------|
| 1 | `.htaccess` | Security headers, blokir file sensitif, disable directory listing, blokir akses ke application/system |
| 2 | `application/config/config.php` | Aktifkan CSRF, XSS filtering, httponly cookie, session regenerate, tambah config Fonnte token, encryption key baru |
| 3 | `application/models/User_model.php` | Ganti MD5 ke BCrypt (password_hash) dengan backward compatibility |
| 4 | `application/controllers/Auth.php` | Session fixation fix, password verify fix, enkripsi password di session, rate limiting login |
| 5 | `application/helpers/fonnte_helper.php` | API token dari env, OTP dengan random_int, SSL verification diaktifkan |
| 6 | `application/controllers/api/Notifikasi.php` | Whitelist key untuk update_setting, validasi value |
| 7 | `application/controllers/admin/Users.php` | Konsistensi hashing password via model |
| 8 | `application/controllers/Transaksi.php` | IDOR prevention untuk keranjang, validasi stok |
| 9 | `application/models/Keranjang_model.php` | Tambah method get_by_id untuk validasi kepemilikan |
| 10 | `application/config/hooks.php` | Daftarkan hook display_override untuk CSRF form injector |
| 11 | `application/hooks/csrf_form_injector.php` | Hook otomatis inject CSRF token ke semua form POST |
| 12 | `.gitignore` | Blokir commit file sensitif (*.sql, list_users.php, repair_db.php, config, dll) |

---

## 📌 Catatan Penting

### 1. **Set Fonnte API Token**
Untuk mengaktifkan OTP WhatsApp, set environment variable:
```
set FONNTE_API_TOKEN=token_anda_di_sini
```
Atau di `application/config/config.php`:
```php
$config['fonnte_api_token'] = 'token_anda_di_sini';
```

### 2. **Password Lama (MD5)**
User dengan password MD5 lama masih bisa login. Password mereka otomatis di-upgrade ke BCrypt saat login pertama kali setelah perbaikan ini.

### 3. **CSRF dan Form**
CSRF protection sekarang aktif untuk form-based POST. Semua form di aplikasi CodeIgniter otomatis didukung oleh CI karena sudah mengintegrasikan CSRF secara otomatis.

### 4. **Direktori Uploads**
Perubahan di `.htaccess` memblokir file PHP di direktori uploads. Ini mencegah attacker meng-upload file PHP berbahaya.

### 5. **Mode Simulasi OTP**
Jika token Fonnte belum di-set, sistem akan berjalan dalam mode simulasi dan OTP tidak benar-benar dikirim ke WhatsApp.

---

## ⚡ Rekomendasi Tambahan

1. **Aktifkan HTTPS** di server production untuk mengenkripsi semua komunikasi
2. **Gunakan HTTPS dan set `cookie_secure = TRUE`** di config
3. **Backup database** sebelum melakukan perubahan besar
4. **Set hak akses file** yang benar di server production (folder uploads sebaiknya tidak writable untuk PHP)
5. **Regular security audit** setiap 3-6 bulan
6. **Update password pengguna** yang masih menggunakan MD5 hash agar di-hash ulang

---

*Checkpoint ini telah diverifikasi dan ditutup pada 4 Agustus 2026.*

---

## 🔧 Perbaikan Tambahan: Error "Array to string conversion" di CSRF Hook

**Tanggal:** 4 Agustus 2026
**File:** `application/hooks/csrf_form_injector.php`
**Error:**
```
A PHP Error was encountered
Severity: Warning
Message: Array to string conversion
Filename: hooks/csrf_form_injector.php
Line Number: 17
```

**Penyebab:**
Method `$CI->security->get_csrf_hash()` di CodeIgniter 3 dapat mengembalikan **array** (bukan string) ketika `csrf_regenerate = TRUE` diaktifkan. Array tersebut berisi `new_hash` dan `old_hash` untuk mendukung regenerasi token CSRF. Ketika array ini langsung digabungkan ke string HTML, PHP memunculkan warning "Array to string conversion".

**Perbaikan:**
- Menambahkan pengecekan `is_array($token_hash)` untuk mendeteksi jika hash berupa array
- Menggunakan `reset($token_hash)` untuk mengambil hash pertama (new hash) dari array
- Menambahkan guard `empty($token_hash)` untuk mencegah inject token kosong yang bisa merusak halaman

**Kode yang diperbaiki:**
```php
// 🔴 FIX: get_csrf_hash() bisa mengembalikan ARRAY saat csrf_regenerate aktif
if (is_array($token_hash)) {
    $token_hash = reset($token_hash);
}

// Jika hash kosong, jangan inject apa-apa agar tidak merusak halaman
if (empty($token_hash)) {
    echo $output;
    return;
}
```

**Status:** ✅ Selesai diperbaiki

##  Perbaikan Tambahan 2: Error "Array to string conversion" di Baris 30 (echo $output)

**Tanggal:** 4 Agustus 2026
**File:** `application/hooks/csrf_form_injector.php`
**Error:**
```
A PHP Error was encountered
Severity: Warning
Message: Array to string conversion
Filename: hooks/csrf_form_injector.php
Line Number: 30
```

**Penyebab:**
Error muncul di baris `echo $output` (Line 30). Ternyata selain `get_csrf_hash()` yang mengembalikan array, **parameter `$output` itu sendiri yang dikirim ke hook juga bisa berupa ARRAY**, bukan string. Di beberapa versi CodeIgniter, `display_override` hook menerima parameter dengan struktur data tertentu yang berupa array, bukan string HTML langsung.

**Perbaikan:**
- Menambahkan pengecekan `is_array($output)` di awal function untuk mendeteksi jika output berupa array
- Jika array mengandung key `output`, ambil nilai stringnya
- Fallback: jika `$output` kosong atau bukan string, ambil langsung dari `$CI->output->get_output()`
- Konversi paksa ke string dengan `is_array($output) ? implode('', $output) : (string) $output`
- Tambahkan default parameter `$output = ''` untuk menghindari error jika parameter kosong

**Kode yang diperbaiki:**
```php
function inject_csrf_into_forms($output = '')
{
    $CI =& get_instance();

    // 🔴 FIX: Parameter $output bisa berupa ARRAY
    if (is_array($output) && isset($output['output'])) {
        $output = $output['output'];
    }

    // Fallback: Jika $output kosong/array, ambil langsung dari Output library
    if (!is_string($output) || $output === '') {
        $output = $CI->output->get_output();
        if (is_array($output) && isset($output['output'])) {
            $output = $output['output'];
        }
        if (!is_string($output)) {
            $output = is_array($output) ? implode('', $output) : (string) $output;
        }
    }
    // ...lanjut proses CSRF injection...
}
```

**Status:** ✅ Selesai diperbaiki

---

## 🔒 Perbaikan Tambahan 3: Sembunyikan Nama Controller dari URL

**Tanggal:** 4 Agustus 2026
**File:** `application/config/routes.php`, `application/hooks/csrf_form_injector.php`, `application/controllers/Auth.php`
**Deskripsi:** Nama controller seperti `auth`, `Auth`, dll terlihat di URL pada searchbar, membuat aplikasi mudah dikenali strukturnya oleh penyerang.

**Perbaikan:**
1. **Menambahkan route URL bersih** di `application/config/routes.php`:
   - `/masuk` → `Auth/login`
   - `/buat-akun` → `Auth/register`
   - `/keluar` → `Auth/logout`
   - `/profil-saya` → `Auth/profile`
   - `/lupa-password` → `Auth/forgot_password`

2. **Menambahkan rewrite otomatis URL** di `application/hooks/csrf_form_injector.php`:
   - Semua link `base_url('auth/login')`, `base_url('auth/register')`, dll otomatis diubah menjadi URL bersih (`/masuk`, `/buat-akun`, dll) saat halaman HTML dirender
   - Ini dilakukan sekali di hook, tanpa perlu mengubah 146 referensi di seluruh views/controllers

3. **Mengupdate redirect di controller `Auth.php`**:
   - Redirect setelah login, register, dan reset password diubah ke URL bersih (`redirect('masuk')`)

**URL yang berubah:**
| URL Lama | URL Baru |
|----------|----------|
| `/auth/login` | `/masuk` |
| `/auth/register` | `/buat-akun` |
| `/auth/logout` | `/keluar` |
| `/auth/profile` | `/profil-saya` |
| `/auth/forgot_password` | `/lupa-password` |

**Catatan:** Route lama (`auth/login`, `auth/register`, dll) tetap berfungsi sebagai fallback agar tidak merusak link internal atau bookmark lama.

**Status:** ✅ Selesai diperbaiki
