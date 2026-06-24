<?php
// application/helpers/notifikasi_helper.php

if (!function_exists('send_notifikasi')) {
    function send_notifikasi($user_id, $role, $judul, $pesan, $icon = 'info', $link = null) {
        $CI =& get_instance();
        $CI->load->model('Notifikasi_model');
        
        $settings = $CI->Notifikasi_model->get_settings($user_id);
        
        $key_map = [
            'Pesanan Baru' => 'notif_transaksi',
            'Konfirmasi Pembayaran' => 'notif_pembayaran',
            'Peringatan Stok' => 'notif_stok',
            'Laporan' => 'notif_laporan',
            'Registrasi Petani' => 'notif_petani',
            'Status Pengiriman' => 'notif_kurir',
            'Update Pengiriman' => 'notif_kurir',
            'Lokasi Kurir' => 'notif_kurir',
            'Promo' => 'notif_promo',
            'Update Sistem' => 'notif_sistem'
        ];
        
        $key = 'notif_sistem';
        foreach ($key_map as $keyword => $setting_key) {
            if (strpos($judul, $keyword) !== false) {
                $key = $setting_key;
                break;
            }
        }
        
        if (isset($settings[$key]) && $settings[$key] == 0) {
            return false;
        }
        
        $data = [
            'id_user' => $user_id,
            'judul' => $judul,
            'isi_notifikasi' => $pesan,
            'link' => $link,
            'icon' => $icon,
            'status_baca' => 0,
            'tanggal_buat' => date('Y-m-d H:i:s')
        ];
        
        return $CI->Notifikasi_model->save_notifikasi($data);
    }
}

// ============================================
// MODUL 7: NOTIFIKASI TRACKING
// ============================================

if (!function_exists('notifikasi_tracking')) {
    function notifikasi_tracking($pembeli_id, $invoice, $status, $status_detail = null) {
        $CI =& get_instance();
        $CI->load->model('Notifikasi_model');
        
        $settings = $CI->Notifikasi_model->get_settings($pembeli_id);
        if (isset($settings['notif_kurir']) && $settings['notif_kurir'] == 0) {
            return false;
        }
        
        $judul = 'Update Pengiriman';
        $pesan = "Pesanan #{$invoice}";
        if ($status_detail) {
            $pesan .= " - {$status_detail}";
        } else {
            $pesan .= " status: {$status}";
        }
        
        $link = base_url('pembeli/tracking');
        
        $data = [
            'id_user' => $pembeli_id,
            'judul' => $judul,
            'isi_notifikasi' => $pesan,
            'link' => $link,
            'icon' => 'info',
            'status_baca' => 0,
            'tanggal_buat' => date('Y-m-d H:i:s')
        ];
        
        return $CI->Notifikasi_model->save_notifikasi($data);
    }
}

// ============================================
// NOTIFIKASI LAINNYA (Modul 6, 11)
// ============================================

if (!function_exists('notifikasi_pesanan_baru')) {
    function notifikasi_pesanan_baru($petani_id, $invoice, $produk) {
        $judul = 'Pesanan Baru Masuk';
        $pesan = "Pesanan #{$invoice} untuk produk {$produk} telah masuk.";
        return send_notifikasi($petani_id, 'petani', $judul, $pesan, 'success', base_url('petani/transaksi'));
    }
}

if (!function_exists('notifikasi_konfirmasi_bayar')) {
    function notifikasi_konfirmasi_bayar($admin_id, $invoice) {
        $judul = 'Konfirmasi Pembayaran';
        $pesan = "Pembayaran #{$invoice} menunggu konfirmasi.";
        return send_notifikasi($admin_id, 'admin', $judul, $pesan, 'warning', base_url('admin/transaksi/konfirmasi'));
    }
}

if (!function_exists('notifikasi_stok_tipis')) {
    function notifikasi_stok_tipis($petani_id, $produk, $sisa) {
        $judul = 'Peringatan Stok Menipis';
        $pesan = "Stok {$produk} tersisa {$sisa} kg. Segera isi ulang!";
        return send_notifikasi($petani_id, 'petani', $judul, $pesan, 'danger', base_url('petani/produk'));
    }
}

if (!function_exists('notifikasi_poin')) {
    function notifikasi_poin($pembeli_id, $poin, $total_poin) {
        $judul = 'Poin Reward Ditambahkan';
        $pesan = "Anda mendapatkan {$poin} poin! Total poin: {$total_poin}";
        return send_notifikasi($pembeli_id, 'pembeli', $judul, $pesan, 'success', base_url('pembeli/poin'));
    }
}
