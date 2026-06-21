<?php
// application/helpers/notifikasi_helper.php

if (!function_exists('send_notifikasi')) {
    /**
     * Kirim notifikasi ke user
     */
    function send_notifikasi($user_id, $role, $judul, $pesan, $icon = 'info', $link = null) {
        $CI =& get_instance();
        $CI->load->model('Notifikasi_model');
        
        // Cek setting user
        $settings = $CI->Notifikasi_model->get_settings($user_id);
        
        // Mapping key berdasarkan judul/tipe notifikasi
        $key_map = [
            'Pesanan Baru' => 'notifTransaksi',
            'Konfirmasi Pembayaran' => 'notifPembayaran',
            'Peringatan Stok' => 'notifStok',
            'Laporan' => 'notifLaporan',
            'Registrasi Petani' => 'notifPetani',
            'Status Pengiriman' => 'notifKurir',
            'Promo' => 'notifPromo',
            'Update Sistem' => 'notifSistem'
        ];
        
        // Cari key yang sesuai
        $key = 'notifSistem';
        foreach ($key_map as $keyword => $setting_key) {
            if (strpos($judul, $keyword) !== false) {
                $key = $setting_key;
                break;
            }
        }
        
        // Jika setting nonaktif, skip
        if (isset($settings[$key]) && $settings[$key] == 0) {
            return false;
        }
        
        $data = [
            'id_user' => $user_id,
            'role_user' => $role,
            'judul' => $judul,
            'pesan' => $pesan,
            'icon' => $icon,
            'link' => $link,
            'is_read' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        return $CI->Notifikasi_model->save_notifikasi($data);
    }
}

if (!function_exists('notifikasi_pesanan_baru')) {
    /**
     * Notifikasi pesanan baru ke petani
     */
    function notifikasi_pesanan_baru($petani_id, $invoice, $produk) {
        $judul = 'Pesanan Baru Masuk';
        $pesan = "Pesanan #{$invoice} untuk produk {$produk} telah masuk.";
        return send_notifikasi($petani_id, 'petani', $judul, $pesan, 'success', base_url('petani/transaksi'));
    }
}

if (!function_exists('notifikasi_konfirmasi_bayar')) {
    /**
     * Notifikasi konfirmasi pembayaran ke admin
     */
    function notifikasi_konfirmasi_bayar($admin_id, $invoice) {
        $judul = 'Konfirmasi Pembayaran';
        $pesan = "Pembayaran #{$invoice} menunggu konfirmasi.";
        return send_notifikasi($admin_id, 'admin', $judul, $pesan, 'warning', base_url('admin/transaksi/konfirmasi'));
    }
}

if (!function_exists('notifikasi_stok_tipis')) {
    /**
     * Notifikasi stok menipis ke petani
     */
    function notifikasi_stok_tipis($petani_id, $produk, $sisa) {
        $judul = 'Peringatan Stok Menipis';
        $pesan = "Stok {$produk} tersisa {$sisa} kg. Segera isi ulang!";
        return send_notifikasi($petani_id, 'petani', $judul, $pesan, 'danger', base_url('petani/produk'));
    }
}

if (!function_exists('notifikasi_tracking')) {
    /**
     * Notifikasi update tracking ke pembeli
     */
    function notifikasi_tracking($pembeli_id, $invoice, $status) {
        $judul = 'Update Pengiriman';
        $pesan = "Pesanan #{$invoice} status: {$status}";
        return send_notifikasi($pembeli_id, 'pembeli', $judul, $pesan, 'info', base_url('pembeli/tracking'));
    }
}

if (!function_exists('notifikasi_poin')) {
    /**
     * Notifikasi poin reward ke pembeli
     */
    function notifikasi_poin($pembeli_id, $poin, $total_poin) {
        $judul = 'Poin Reward Ditambahkan';
        $pesan = "Anda mendapatkan {$poin} poin! Total poin: {$total_poin}";
        return send_notifikasi($pembeli_id, 'pembeli', $judul, $pesan, 'success', base_url('pembeli/poin'));
    }
}
