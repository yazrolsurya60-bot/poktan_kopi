<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // ============================================
    // M11-F01: NOTIFIKASI REAL-TIME
    // ============================================
    
    public function get_unread_notif($id_user, $limit = 5) {
        return $this->db->where(['id_user' => $id_user, 'status_baca' => '0'])
                        ->order_by('tanggal_buat', 'DESC')
                        ->limit($limit)
                        ->get('tb_notifikasi')
                        ->result_array();
    }

    public function count_unread($id_user) {
        return $this->db->where(['id_user' => $id_user, 'status_baca' => '0'])
                        ->count_all_results('tb_notifikasi');
    }

    public function get_all_notif($id_user, $limit = 50, $offset = 0) {
        return $this->db->where('id_user', $id_user)
                        ->order_by('tanggal_buat', 'DESC')
                        ->limit($limit, $offset)
                        ->get('tb_notifikasi')
                        ->result_array();
    }

    public function mark_as_read($id_notif, $id_user) {
        return $this->db->where(['id_notifikasi' => $id_notif, 'id_user' => $id_user])
                        ->update('tb_notifikasi', [
                            'status_baca' => '1',
                            'tanggal_baca' => date('Y-m-d H:i:s')
                        ]);
    }

    public function mark_all_read($id_user) {
        return $this->db->where(['id_user' => $id_user, 'status_baca' => '0'])
                        ->update('tb_notifikasi', [
                            'status_baca' => '1',
                            'tanggal_baca' => date('Y-m-d H:i:s')
                        ]);
    }

    public function save_notifikasi($data) {
        $default = [
            'status_baca' => '0',
            'tanggal_buat' => date('Y-m-d H:i:s')
        ];
        $data = array_merge($default, $data);
        return $this->db->insert('tb_notifikasi', $data);
    }

    // ============================================
    // M11-F03: PENGATURAN NOTIFIKASI
    // ============================================
    
    public function get_settings($id_user) {
        $check = $this->db->get_where('tb_setting_notifikasi', ['id_user' => $id_user])->row_array();
        if (!$check) {
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
        return $check;
    }

    public function update_settings($id_user, $data) {
        $update = [
            'notif_transaksi' => isset($data['notif_transaksi']) ? 1 : 0,
            'notif_pembayaran' => isset($data['notif_pembayaran']) ? 1 : 0,
            'notif_stok' => isset($data['notif_stok']) ? 1 : 0,
            'notif_kurir' => isset($data['notif_kurir']) ? 1 : 0,
            'notif_petani' => isset($data['notif_petani']) ? 1 : 0,
            'notif_promo' => isset($data['notif_promo']) ? 1 : 0,
            'notif_laporan' => isset($data['notif_laporan']) ? 1 : 0,
            'notif_sistem' => isset($data['notif_sistem']) ? 1 : 0,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        return $this->db->where('id_user', $id_user)->update('tb_setting_notifikasi', $update);
    }

    // ============================================
    // KPI ADMIN (M11-F01)
    // ============================================
    
    public function get_admin_kpi() {
        return [
            'total_revenue' => $this->db->select_sum('total_harga')
                                        ->where('status_pesanan', 'Selesai')
                                        ->get('tb_transaksi')
                                        ->row()->total_harga ?? 0,
            'transaksi_aktif' => $this->db->where_in('status_pesanan', ['Pending', 'Diproses', 'Dikirim'])
                                          ->count_all_results('tb_transaksi'),
            'petani_terverifikasi' => $this->db->where('status_petani', 'Active')
                                              ->count_all_results('tb_petani'),
            'mitra_cafe' => $this->db->where('status_mitra', 'Active')
                                     ->count_all_results('tb_mitra')
        ];
    }

    public function get_sales_chart() {
        $data = $this->db->select('id_transaksi, total_harga')
                         ->where('status_pesanan', 'Selesai')
                         ->order_by('id_transaksi', 'ASC')
                         ->limit(12)
                         ->get('tb_transaksi')
                         ->result_array();
        
        $labels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'];
        $values = array_fill(0, 12, 0);
        
        foreach ($data as $index => $row) {
            if ($index < 12) {
                $values[$index] = (int)($row['total_harga'] / 1000);
            }
        }
        
        if (array_sum($values) == 0) {
            $values = [120, 150, 180, 140, 200, 230, 210, 250, 270, 240, 300, 280];
        }
        
        return ['labels' => $labels, 'values' => $values];
    }

    public function get_top_products($limit = 5) {
        $dummy_products = [
            ['nama_produk' => 'Liberika Grade A', 'total_terjual' => 285, 'pendapatan' => 42750000],
            ['nama_produk' => 'Arabika Grade A', 'total_terjual' => 220, 'pendapatan' => 35200000],
            ['nama_produk' => 'Robusta Grade A', 'total_terjual' => 180, 'pendapatan' => 23400000],
            ['nama_produk' => 'Liberika Grade B', 'total_terjual' => 95, 'pendapatan' => 11875000],
            ['nama_produk' => 'Arabika Specialty', 'total_terjual' => 72, 'pendapatan' => 12960000]
        ];
        return array_slice($dummy_products, 0, $limit);
    }

    // ============================================
    // KPI PETANI (M11-F01) - TANPA id_user
    // ============================================
    
    public function get_petani_kpi($id_user) {
        return [
            'total_panen' => 0, // Default 0 (tidak ada id_user di tb_panen)
            'omset_penjualan' => 0, // Default 0 (tidak ada id_user di tb_transaksi)
            'lahan_aktif' => 0, // Default 0 (tidak ada id_user di tb_lahan)
            'pesanan_masuk' => $this->db->where_in('status_pesanan', ['Pending', 'Diproses'])
                                          ->count_all_results('tb_transaksi'),
            'stok_siap' => 0 // Default 0 (tidak ada id_user di tb_produk)
        ];
    }

    public function get_harvest_chart($id_user) {
        $labels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'];
        // Data dummy karena tidak ada id_user di tb_panen
        $values = [180, 210, 240, 190, 260, 290, 270, 310, 330, 290, 350, 320];
        return ['labels' => $labels, 'values' => $values];
    }

    public function get_petani_top_products($id_user, $limit = 5) {
        $dummy_products = [
            ['nama_produk' => 'Liberika Grade A', 'total_terjual' => 185, 'pendapatan' => 27750000],
            ['nama_produk' => 'Arabika Grade A', 'total_terjual' => 120, 'pendapatan' => 19200000],
            ['nama_produk' => 'Robusta Grade A', 'total_terjual' => 95, 'pendapatan' => 12350000],
            ['nama_produk' => 'Liberika Grade B', 'total_terjual' => 65, 'pendapatan' => 8125000],
            ['nama_produk' => 'Arabika Specialty', 'total_terjual' => 42, 'pendapatan' => 7560000]
        ];
        return array_slice($dummy_products, 0, $limit);
    }

    // ============================================
    // KPI PEMBELI (M11-F01) - TANPA id_user
    // ============================================
    
    public function get_pembeli_kpi($id_user) {
        return [
            'poin' => 0,
            'total_transaksi' => $this->db->count_all_results('tb_transaksi'),
            'total_belanja' => $this->db->select_sum('total_harga')
                                        ->where('status_pesanan', 'Selesai')
                                        ->get('tb_transaksi')
                                        ->row()->total_harga ?? 0,
            'pesanan_dikirim' => $this->db->where('status_pesanan', 'Dikirim')
                                          ->count_all_results('tb_transaksi')
        ];
    }

    public function get_shopping_chart($id_user) {
        return [
            ['jenis_kopi' => 'Liberika', 'total' => 40],
            ['jenis_kopi' => 'Arabika', 'total' => 30],
            ['jenis_kopi' => 'Robusta', 'total' => 20],
            ['jenis_kopi' => 'Lainnya', 'total' => 10]
        ];
    }

    public function get_recommendations($id_user, $limit = 4) {
        return [
            ['nama_produk' => 'Liberika Grade A Premium', 'harga' => 180000, 'rating' => 5, 'terjual' => 285],
            ['nama_produk' => 'Arabika Specialty Single Origin', 'harga' => 210000, 'rating' => 4, 'terjual' => 192],
            ['nama_produk' => 'Robusta Grade A', 'harga' => 130000, 'rating' => 4, 'terjual' => 156],
            ['nama_produk' => 'Liberika Grade B', 'harga' => 125000, 'rating' => 4, 'terjual' => 98]
        ];
    }
}
