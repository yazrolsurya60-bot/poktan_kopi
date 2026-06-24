<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // ============================================
    // NOTIFIKASI CRUD (Modul 11 & Modul 7)
    // ============================================

    /**
     * Save notification
     */
    public function save_notifikasi($data) {
        $insert_data = [
            'id_user' => $data['id_user'],
            'judul' => $data['judul'] ?? 'Notifikasi',
            'isi_notifikasi' => $data['isi_notifikasi'] ?? $data['pesan'] ?? '',
            'link' => $data['link'] ?? null,
            'icon' => $data['icon'] ?? 'info',
            'status_baca' => $data['status_baca'] ?? 0,
            'tanggal_buat' => $data['tanggal_buat'] ?? date('Y-m-d H:i:s')
        ];
        return $this->db->insert('tb_notifikasi', $insert_data);
    }

    /**
     * Get unread notifications
     */
    public function get_unread_notif($id_user, $limit = null) {
        $this->db->where('id_user', $id_user);
        $this->db->where('status_baca', 0);
        $this->db->order_by('tanggal_buat', 'DESC');
        if ($limit) $this->db->limit($limit);
        return $this->db->get('tb_notifikasi')->result();
    }

    /**
     * Get all notifications with pagination
     */
    public function get_all_notif($id_user, $limit = null, $offset = null) {
        $this->db->where('id_user', $id_user);
        $this->db->order_by('tanggal_buat', 'DESC');
        if ($limit) $this->db->limit($limit, $offset);
        return $this->db->get('tb_notifikasi')->result();
    }

    /**
     * Count unread notifications
     */
    public function count_unread($id_user) {
        $this->db->where('id_user', $id_user);
        $this->db->where('status_baca', 0);
        return $this->db->count_all_results('tb_notifikasi');
    }

    /**
     * Mark notification as read
     */
    public function mark_as_read($id_notif, $id_user) {
        $this->db->where('id_notifikasi', $id_notif);
        $this->db->where('id_user', $id_user);
        return $this->db->update('tb_notifikasi', ['status_baca' => 1]);
    }

    /**
     * Mark all notifications as read
     */
    public function mark_all_read($id_user) {
        $this->db->where('id_user', $id_user);
        $this->db->where('status_baca', 0);
        return $this->db->update('tb_notifikasi', ['status_baca' => 1]);
    }

    /**
     * Get notification settings (DIPERTAHANKAN untuk Modul 7)
     */
    public function get_settings($id_user) {
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('tb_setting_notifikasi');
        if ($query->num_rows() == 0) {
            // Default settings (termasuk notif_kurir untuk Modul 7)
            $default = [
                'id_user' => $id_user,
                'notif_transaksi' => 1,
                'notif_pembayaran' => 1,
                'notif_stok' => 1,
                'notif_kurir' => 1,
                'notif_petani' => 1,
                'notif_promo' => 0,
                'notif_laporan' => 0,
                'notif_sistem' => 1
            ];
            $this->db->insert('tb_setting_notifikasi', $default);
            return $default;
        }
        return $query->row_array();
    }

    /**
     * Update notification settings
     */
    public function update_settings($id_user, $data) {
        unset($data['id_user']);
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('tb_setting_notifikasi');
        if ($query->num_rows() > 0) {
            $this->db->where('id_user', $id_user);
            return $this->db->update('tb_setting_notifikasi', $data);
        } else {
            $data['id_user'] = $id_user;
            return $this->db->insert('tb_setting_notifikasi', $data);
        }
    }

    // ============================================
    // KPI DASHBOARD (Modul 11) - TANPA TABEL TESTING
    // ============================================

    /**
     * Get KPI for Pembeli
     */
    public function get_pembeli_kpi($id_user) {
        // Total transaksi
        $this->db->where('id_user', $id_user);
        $total_transaksi = $this->db->count_all_results('tb_transaksi');

        // Total belanja
        $this->db->select_sum('total_harga');
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('tb_transaksi');
        $total_belanja = $query->row()->total_harga ?? 0;

        // Pesanan dalam pengiriman
        $this->db->where('id_user', $id_user);
        $this->db->where_in('status_pesanan', ['Diproses', 'Dikirim']);
        $pesanan_dikirim = $this->db->count_all_results('tb_transaksi');

        // Poin (tidak ada kolom di tb_user, default 0)
        $poin = 0;

        return [
            'total_transaksi' => $total_transaksi,
            'total_belanja'   => $total_belanja,
            'pesanan_dikirim' => $pesanan_dikirim,
            'poin'            => $poin
        ];
    }

    /**
     * Get KPI for Petani
     */
    public function get_petani_kpi($id_user) {
        // Total panen
        $this->db->select_sum('jumlah_panen');
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('tb_panen');
        $total_panen = $query->row()->jumlah_panen ?? 0;

        // Omset (tidak bisa dihitung tanpa tb_transaksi_detail)
        $omset = 0;

        // Lahan aktif
        $this->db->where('id_user', $id_user);
        $this->db->where('status_lahan', 'Active');
        $lahan_aktif = $this->db->count_all_results('tb_lahan');

        // Pesanan masuk (sederhana, hanya hitung transaksi dengan status tertentu)
        $this->db->where('id_user', $id_user);
        $this->db->where_in('status_pesanan', ['Pending', 'Diproses']);
        $pesanan_masuk = $this->db->count_all_results('tb_transaksi');

        return [
            'total_panen'      => $total_panen,
            'omset_penjualan'  => $omset,
            'lahan_aktif'      => $lahan_aktif,
            'pesanan_masuk'    => $pesanan_masuk
        ];
    }

    /**
     * Get KPI for Admin
     */
    public function get_admin_kpi() {
        // Total pendapatan (status selesai)
        $this->db->select_sum('total_harga');
        $this->db->where('status_pesanan', 'Selesai');
        $query = $this->db->get('tb_transaksi');
        $total_revenue = $query->row()->total_harga ?? 0;

        // Transaksi aktif
        $this->db->where_in('status_pesanan', ['Pending', 'Diproses', 'Dikirim']);
        $transaksi_aktif = $this->db->count_all_results('tb_transaksi');

        // Petani terverifikasi
        $this->db->where('status_petani', 'Active');
        $petani_terverifikasi = $this->db->count_all_results('tb_petani');

        // Mitra cafe aktif
        $this->db->where('status_mitra', 'Active');
        $mitra_cafe = $this->db->count_all_results('tb_mitra');

        return [
            'total_revenue'        => $total_revenue,
            'transaksi_aktif'      => $transaksi_aktif,
            'petani_terverifikasi' => $petani_terverifikasi,
            'mitra_cafe'           => $mitra_cafe
        ];
    }

    // ============================================
    // CHART DATA (Modul 10 & 11)
    // ============================================

    /**
     * Sales chart (Admin)
     */
    public function get_sales_chart() {
        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
        $values = [];
        for ($i = 0; $i < 12; $i++) {
            $bulan = date('Y-m', strtotime("-$i month"));
            $this->db->select_sum('total_harga');
            $this->db->where("DATE_FORMAT(created_at, '%Y-%m') = '{$bulan}'", NULL, FALSE);
            $query = $this->db->get('tb_transaksi');
            $values[] = (int) ($query->row()->total_harga ?? 0);
        }
        return ['labels' => array_reverse($labels), 'values' => array_reverse($values)];
    }

    /**
     * Harvest chart (Petani)
     */
    public function get_harvest_chart($id_user) {
        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
        $values = [];
        for ($i = 0; $i < 12; $i++) {
            $bulan = date('Y-m', strtotime("-$i month"));
            $this->db->select_sum('jumlah_panen');
            $this->db->where('id_user', $id_user);
            $this->db->where("DATE_FORMAT(tanggal_panen, '%Y-%m') = '{$bulan}'", NULL, FALSE);
            $query = $this->db->get('tb_panen');
            $values[] = (int) ($query->row()->jumlah_panen ?? 0);
        }
        return ['labels' => array_reverse($labels), 'values' => array_reverse($values)];
    }

    /**
     * Shopping chart (Pembeli)
     */
    public function get_shopping_chart($id_user) {
        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
        $values = [];
        for ($i = 0; $i < 12; $i++) {
            $bulan = date('Y-m', strtotime("-$i month"));
            $this->db->select_sum('total_harga');
            $this->db->where('id_user', $id_user);
            $this->db->where("DATE_FORMAT(created_at, '%Y-%m') = '{$bulan}'", NULL, FALSE);
            $query = $this->db->get('tb_transaksi');
            $values[] = (int) ($query->row()->total_harga ?? 0);
        }
        return ['labels' => array_reverse($labels), 'values' => array_reverse($values)];
    }

    // ============================================
    // TOP PRODUCTS (Modul 10 & 11) - TANPA DEPENDENSI TABEL TESTING
    // ============================================

    /**
     * Top products (Admin)
     */
    public function get_top_products($limit = 5) {
        $this->db->select('id_produk, nama_produk, stok_produk as total_terjual, 0 as pendapatan');
        $this->db->from('tb_produk');
        $this->db->where('stok_produk >', 0);
        $this->db->order_by('stok_produk', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    /**
     * Top products for Petani
     */
    public function get_petani_top_products($id_user, $limit = 5) {
        $this->db->select('id_produk, nama_produk, stok_produk as total_terjual, 0 as pendapatan');
        $this->db->from('tb_produk');
        $this->db->where('id_user', $id_user);
        $this->db->where('stok_produk >', 0);
        $this->db->order_by('stok_produk', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    /**
     * Recommendations (Pembeli)
     */
    public function get_recommendations($id_user, $limit = 4) {
        $this->db->select('*');
        $this->db->from('tb_produk');
        $this->db->where('stok_produk >', 0);
        $this->db->order_by('id_produk', 'RANDOM');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }
}
