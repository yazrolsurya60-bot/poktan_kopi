<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// ============================================
// NOTIFIKASI UTAMA (M11-F01)
// ============================================

if (!function_exists('send_notifikasi')) {
    function send_notifikasi($user_id, $role, $judul, $pesan, $icon = 'info', $link = null) {
        $CI =& get_instance();
        
        // Pastikan model di-load
        if (!isset($CI->Notifikasi_model)) {
            $CI->load->model('Notifikasi_model');
        }
        
        // Cek setting notifikasi user
        $settings = $CI->Notifikasi_model->get_settings($user_id);
        
        // Mapping judul ke key setting
        $key_map = [
            'Pesanan Baru' => 'notif_transaksi',
            'Konfirmasi Pembayaran' => 'notif_pembayaran',
            'Peringatan Stok' => 'notif_stok',
            'Laporan' => 'notif_laporan',
            'Registrasi Petani' => 'notif_petani',
            'Registrasi User' => 'notif_petani',
            'Pendaftaran' => 'notif_petani',
            'Status Pengiriman' => 'notif_kurir',
            'Update Pengiriman' => 'notif_kurir',
            'Lokasi Kurir' => 'notif_kurir',
            'Tracking' => 'notif_kurir',
            'Promo' => 'notif_promo',
            'Diskon' => 'notif_promo',
            'Update Sistem' => 'notif_sistem',
            'Maintenance' => 'notif_sistem',
            'Verifikasi' => 'notif_petani',
            'Terverifikasi' => 'notif_petani',
            'Test' => 'notif_sistem'
        ];
        
        $key = 'notif_sistem';
        foreach ($key_map as $keyword => $setting_key) {
            if (strpos($judul, $keyword) !== false) {
                $key = $setting_key;
                break;
            }
        }
        
        // Jika setting notifikasi dimatikan, tidak kirim
        if (isset($settings[$key]) && $settings[$key] == 0) {
            return false;
        }
        
        // Siapkan data
        $data = [
            'id_user' => $user_id,
            'judul' => $judul,
            'pesan' => $pesan,
            'isi_notifikasi' => $pesan,
            'link' => $link,
            'tipe' => $icon,
            'icon' => $icon,
            'is_read' => 0,
            'status_baca' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'tanggal_buat' => date('Y-m-d H:i:s')
        ];
        
        // Simpan ke database
        return $CI->Notifikasi_model->insert_notification($data);
    }
}

// ============================================
// NOTIFIKASI KHUSUS (M07, M11)
// ============================================

if (!function_exists('notifikasi_tracking')) {
    function notifikasi_tracking($pembeli_id, $invoice, $status, $status_detail = null) {
        $judul = 'Update Pengiriman';
        $pesan = "Pesanan #{$invoice}";
        if ($status_detail) {
            $pesan .= " - {$status_detail}";
        } else {
            $pesan .= " status: {$status}";
        }
        return send_notifikasi(
            $pembeli_id,
            'pembeli',
            $judul,
            $pesan,
            'info',
            base_url('pembeli/tracking')
        );
    }
}

if (!function_exists('notifikasi_pesanan_baru')) {
    function notifikasi_pesanan_baru($petani_id, $invoice, $produk) {
        $judul = 'Pesanan Baru Masuk';
        $pesan = "Pesanan #{$invoice} untuk produk {$produk} telah masuk.";
        return send_notifikasi(
            $petani_id,
            'petani',
            $judul,
            $pesan,
            'success',
            base_url('petani/transaksi')
        );
    }
}

if (!function_exists('notifikasi_pesanan_pembeli')) {
    function notifikasi_pesanan_pembeli($pembeli_id, $invoice, $status) {
        $judul = 'Update Status Pesanan';
        $pesan = "Pesanan #{$invoice} status: {$status}";
        return send_notifikasi(
            $pembeli_id,
            'pembeli',
            $judul,
            $pesan,
            'info',
            base_url('pembeli/transaksi')
        );
    }
}

if (!function_exists('notifikasi_konfirmasi_bayar')) {
    function notifikasi_konfirmasi_bayar($admin_id, $invoice) {
        $judul = 'Konfirmasi Pembayaran';
        $pesan = "Pembayaran #{$invoice} menunggu konfirmasi.";
        return send_notifikasi(
            $admin_id,
            'admin',
            $judul,
            $pesan,
            'warning',
            base_url('admin/transaksi/konfirmasi')
        );
    }
}

if (!function_exists('notifikasi_stok_tipis')) {
    function notifikasi_stok_tipis($petani_id, $produk, $sisa) {
        $judul = 'Peringatan Stok Menipis';
        $pesan = "Stok {$produk} tersisa {$sisa} kg. Segera isi ulang!";
        return send_notifikasi(
            $petani_id,
            'petani',
            $judul,
            $pesan,
            'danger',
            base_url('petani/produk')
        );
    }
}


// ============================================
// NOTIFIKASI KE SEMUA ADMIN (M11-F01)
// ============================================

if (!function_exists('notifikasi_semua_admin')) {
    function notifikasi_semua_admin($judul, $pesan, $icon = 'info', $link = null) {
        $CI =& get_instance();
        if (!isset($CI->User_model)) {
            $CI->load->model('User_model');
        }
        
        $admins = $CI->User_model->get_users_by_role('Admin');
        $results = [];
        
        foreach ($admins as $admin) {
            $results[] = send_notifikasi(
                $admin['id_user'],
                'admin',
                $judul,
                $pesan,
                $icon,
                $link
            );
        }
        
        return $results;
    }
}
