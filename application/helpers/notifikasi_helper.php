<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// ============================================
// NOTIFIKASI UTAMA
// ============================================

if (!function_exists('send_notifikasi')) {
    function send_notifikasi($user_id, $role, $judul, $pesan, $icon = 'info', $link = null) {
        $CI =& get_instance();
        
        if (!isset($CI->Notifikasi_model)) {
            $CI->load->model('Notifikasi_model');
        }
        
        // Cek user
        $user = $CI->db
            ->where('id_user', $user_id)
            ->get('tb_user')
            ->row_array();
        
        if (!$user) {
            return false;
        }
        
        // Cek setting notifikasi user
        $settings = $CI->Notifikasi_model->get_settings($user_id);
        
        // Mapping judul ke key setting untuk PEMBELI
        $key_map = [
            'Status Pesanan' => 'notif_pesanan',
            'Update Pesanan' => 'notif_pesanan',
            'Pesanan Dibatalkan' => 'notif_pesanan',
            'Pesanan Baru' => 'notif_pesanan',
            'Tracking Kiriman' => 'notif_kurir',
            'Update Pengiriman' => 'notif_kurir',
            'Lokasi Kurir' => 'notif_kurir',
            'Tracking' => 'notif_kurir',
            'Konfirmasi Pembayaran' => 'notif_pembayaran',
            'Pembayaran Diterima' => 'notif_pembayaran',
            'Pembayaran Diverifikasi' => 'notif_pembayaran',
            'Promo' => 'notif_promo',
            'Diskon' => 'notif_promo',
            'Update Sistem' => 'notif_sistem',
            'Maintenance' => 'notif_sistem',
            // Untuk Admin & Petani
            'Pesanan Baru Masuk' => 'notif_transaksi',
            'Peringatan Stok' => 'notif_stok',
            'Laporan' => 'notif_laporan',
            'Registrasi Petani' => 'notif_petani',
            'Registrasi User' => 'notif_petani',
            'Pendaftaran' => 'notif_petani',
            'Verifikasi' => 'notif_petani',
            'Terverifikasi' => 'notif_petani',
            'Test' => 'notif_sistem',
            'Akun Petani Terverifikasi' => 'notif_petani',
            'Akun Terverifikasi' => 'notif_petani'
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
            'isi_notifikasi' => $pesan,
            'link' => $link,
            'icon' => $icon,
            'status_baca' => 0,
            'tanggal_buat' => date('Y-m-d H:i:s')
        ];
        
        return $CI->Notifikasi_model->insert_notification($data);
    }
}

// ============================================
// NOTIFIKASI KHUSUS PEMBELI
// ============================================

if (!function_exists('notifikasi_pembeli_pesanan')) {
    function notifikasi_pembeli_pesanan($pembeli_id, $invoice, $status) {
        $judul = 'Status Pesanan';
        $pesan = "Pesanan #{$invoice} status: {$status}";
        return send_notifikasi(
            $pembeli_id,
            'Pembeli',
            $judul,
            $pesan,
            'info',
            base_url('pembeli/transaksi/detail/' . $invoice)
        );
    }
}

if (!function_exists('notifikasi_pembeli_tracking')) {
    function notifikasi_pembeli_tracking($pembeli_id, $invoice, $status_detail) {
        $judul = 'Tracking Kiriman';
        $pesan = "Pesanan #{$invoice} - {$status_detail}";
        return send_notifikasi(
            $pembeli_id,
            'Pembeli',
            $judul,
            $pesan,
            'info',
            base_url('pembeli/tracking/detail/' . $invoice)
        );
    }
}

if (!function_exists('notifikasi_pembeli_pembayaran')) {
    function notifikasi_pembeli_pembayaran($pembeli_id, $invoice) {
        $judul = 'Konfirmasi Pembayaran';
        $pesan = "Pembayaran untuk pesanan #{$invoice} telah dikonfirmasi.";
        return send_notifikasi(
            $pembeli_id,
            'Pembeli',
            $judul,
            $pesan,
            'success',
            base_url('pembeli/transaksi/detail/' . $invoice)
        );
    }
}

if (!function_exists('notifikasi_pembeli_promo')) {
    function notifikasi_pembeli_promo($pembeli_id, $judul, $pesan) {
        return send_notifikasi(
            $pembeli_id,
            'Pembeli',
            $judul,
            $pesan,
            'primary',
            base_url('landing/produk')
        );
    }
}

// ============================================
// NOTIFIKASI KHUSUS LAINNYA (BACKWARD COMPATIBLE)
// ============================================

if (!function_exists('notifikasi_tracking')) {
    function notifikasi_tracking($pembeli_id, $invoice, $status, $status_detail = null) {
        return notifikasi_pembeli_tracking($pembeli_id, $invoice, $status_detail ?? $status);
    }
}

if (!function_exists('notifikasi_pesanan_pembeli')) {
    function notifikasi_pesanan_pembeli($pembeli_id, $invoice, $status) {
        return notifikasi_pembeli_pesanan($pembeli_id, $invoice, $status);
    }
}

if (!function_exists('notifikasi_konfirmasi_bayar')) {
    function notifikasi_konfirmasi_bayar($admin_id, $invoice) {
        $judul = 'Konfirmasi Pembayaran';
        $pesan = "Pembayaran #{$invoice} menunggu konfirmasi.";
        return send_notifikasi(
            $admin_id,
            'Admin',
            $judul,
            $pesan,
            'warning',
            base_url('admin/transaksi/konfirmasi')
        );
    }
}

if (!function_exists('notifikasi_pesanan_baru')) {
    function notifikasi_pesanan_baru($petani_id, $invoice, $produk) {
        $judul = 'Pesanan Baru Masuk';
        $pesan = "Pesanan #{$invoice} untuk produk {$produk} telah masuk.";
        return send_notifikasi(
            $petani_id,
            'Petani',
            $judul,
            $pesan,
            'success',
            base_url('petani/transaksi')
        );
    }
}

if (!function_exists('notifikasi_stok_tipis')) {
    function notifikasi_stok_tipis($petani_id, $produk, $sisa) {
        $judul = 'Peringatan Stok Menipis';
        $pesan = "Stok {$produk} tersisa {$sisa} kg. Segera isi ulang!";
        return send_notifikasi(
            $petani_id,
            'Petani',
            $judul,
            $pesan,
            'danger',
            base_url('petani/produk')
        );
    }
}

if (!function_exists('notifikasi_semua_admin')) {
    function notifikasi_semua_admin($judul, $pesan, $icon = 'info', $link = null) {
        $CI =& get_instance();
        
        $admins = $CI->db
            ->where('role', 'Admin')
            ->get('tb_user')
            ->result_array();
        
        $results = [];
        
        foreach ($admins as $admin) {
            $results[] = send_notifikasi(
                $admin['id_user'],
                'Admin',
                $judul,
                $pesan,
                $icon,
                $link
            );
        }
        
        return $results;
    }
}

if (!function_exists('notifikasi_pembeli')) {
    function notifikasi_pembeli($pembeli_id, $judul, $pesan, $icon = 'info', $link = null) {
        return send_notifikasi(
            $pembeli_id,
            'Pembeli',
            $judul,
            $pesan,
            $icon,
            $link
        );
    }
}

if (!function_exists('notifikasi_petani')) {
    function notifikasi_petani($petani_id, $judul, $pesan, $icon = 'info', $link = null) {
        return send_notifikasi(
            $petani_id,
            'Petani',
            $judul,
            $pesan,
            $icon,
            $link
        );
    }
}

if (!function_exists('notifikasi_admin')) {
    function notifikasi_admin($admin_id, $judul, $pesan, $icon = 'info', $link = null) {
        return send_notifikasi(
            $admin_id,
            'Admin',
            $judul,
            $pesan,
            $icon,
            $link
        );
    }
}
?>
