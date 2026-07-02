<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifikasi_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // ============================================
    // NOTIFIKASI CRUD
    // ============================================

    public function insert_notification($data)
    {
        $notif_data = [
            'id_user' => $data['id_user'],
            'judul' => $data['judul'] ?? 'Notifikasi',
            'isi_notifikasi' => $data['pesan'] ?? $data['isi_notifikasi'] ?? '',
            'link' => $data['link'] ?? null,
            'icon' => $data['tipe'] ?? $data['icon'] ?? 'info',
            'status_baca' => $data['is_read'] ?? 0,
            'tanggal_buat' => $data['created_at'] ?? date('Y-m-d H:i:s')
        ];

        $this->db->insert('tb_notifikasi', $notif_data);
        return $this->db->insert_id();
    }

    public function save_notifikasi($data)
    {
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

    public function get_unread_notif($id_user, $limit = null)
    {
        $this->db->where('id_user', $id_user);
        $this->db->where('status_baca', 0);
        $this->db->order_by('tanggal_buat', 'DESC');
        if ($limit)
            $this->db->limit($limit);
        return $this->db->get('tb_notifikasi')->result_array();
    }

    public function get_all_notif($id_user, $limit = null, $offset = null)
    {
        $this->db->where('id_user', $id_user);
        $this->db->order_by('tanggal_buat', 'DESC');
        if ($limit)
            $this->db->limit($limit, $offset);
        return $this->db->get('tb_notifikasi')->result_array();
    }

    public function count_unread($id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->where('status_baca', 0);
        return $this->db->count_all_results('tb_notifikasi');
    }

    public function mark_as_read($id_notif, $id_user)
    {
        $this->db->where('id_notifikasi', $id_notif);
        $this->db->where('id_user', $id_user);
        return $this->db->update('tb_notifikasi', ['status_baca' => 1]);
    }

    public function mark_all_read($id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->where('status_baca', 0);
        return $this->db->update('tb_notifikasi', ['status_baca' => 1]);
    }

    // ============================================
    // SETTINGS NOTIFIKASI
    // ============================================

    public function get_settings($id_user)
    {
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('tb_setting_notifikasi');

        if ($query->num_rows() == 0) {
            $role = $this->get_user_role($id_user);
            $default = $this->get_default_settings($role);
            $default['id_user'] = $id_user;
            $this->db->insert('tb_setting_notifikasi', $default);
            return $default;
        }
        return $query->row_array();
    }

    private function get_default_settings($role)
    {
        // Hanya field yang ADA di database
        $base = [
            'notif_transaksi' => 0,
            'notif_pembayaran' => 1,
            'notif_stok' => 0,
            'notif_kurir' => 1,
            'notif_pesanan' => 1,
            'notif_panen' => 0,
            'notif_petani' => 0,
            'notif_promo' => 0,
            'notif_laporan' => 0,
            'notif_sistem' => 1,
        ];

        if ($role == 'Admin') {
            $base['notif_petani'] = 1;
            $base['notif_transaksi'] = 1;
            $base['notif_stok'] = 1;
            $base['notif_pembayaran'] = 1;
            $base['notif_kurir'] = 1;
            $base['notif_sistem'] = 1;
            $base['notif_pesanan'] = 0;
            $base['notif_promo'] = 0;
            $base['notif_laporan'] = 1;
        } elseif ($role == 'Petani') {
            $base['notif_stok'] = 1;
            $base['notif_transaksi'] = 1;
            $base['notif_pembayaran'] = 1;
            $base['notif_kurir'] = 1;
            $base['notif_sistem'] = 1;
            $base['notif_panen'] = 1;
            $base['notif_petani'] = 0;
            $base['notif_promo'] = 0;
            $base['notif_pesanan'] = 0;
        } elseif ($role == 'Pembeli') {
            $base['notif_pesanan'] = 1;
            $base['notif_kurir'] = 1;
            $base['notif_pembayaran'] = 1;
            $base['notif_sistem'] = 1;
            $base['notif_transaksi'] = 0;
            $base['notif_stok'] = 0;
            $base['notif_panen'] = 0;
            $base['notif_petani'] = 0;
            $base['notif_promo'] = 0;
            $base['notif_laporan'] = 0;
        }

        return $base;
    }

    private function get_user_role($id_user)
    {
        $this->db->select('role');
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('tb_user');
        return $query->row()->role ?? 'Pembeli';
    }

    public function update_settings($id_user, $data)
    {
        // Mapping semua field yang ADA di database
        $mapped = [
            'notif_transaksi' => isset($data['notif_transaksi']) ? 1 : 0,
            'notif_pembayaran' => isset($data['notif_pembayaran']) ? 1 : 0,
            'notif_stok' => isset($data['notif_stok']) ? 1 : 0,
            'notif_kurir' => isset($data['notif_kurir']) ? 1 : 0,
            'notif_pesanan' => isset($data['notif_pesanan']) ? 1 : 0,
            'notif_panen' => isset($data['notif_panen']) ? 1 : 0,
            'notif_petani' => isset($data['notif_petani']) ? 1 : 0,
            'notif_promo' => isset($data['notif_promo']) ? 1 : 0,
            'notif_laporan' => isset($data['notif_laporan']) ? 1 : 0,
            'notif_sistem' => isset($data['notif_sistem']) ? 1 : 0,
        ];

        $this->db->where('id_user', $id_user);
        $query = $this->db->get('tb_setting_notifikasi');

        if ($query->num_rows() > 0) {
            $this->db->where('id_user', $id_user);
            return $this->db->update('tb_setting_notifikasi', $mapped);
        } else {
            $mapped['id_user'] = $id_user;
            return $this->db->insert('tb_setting_notifikasi', $mapped);
        }
    }

    // ============================================
    // KPI DASHBOARD (TANPA POIN)
    // ============================================

    public function get_pembeli_kpi($id_user)
    {
        // Total Transaksi
        $this->db->where('id_user', $id_user);
        $total_transaksi = $this->db->count_all_results('tb_transaksi');

        // Total Belanja
        $this->db->select_sum('total_harga');
        $this->db->where('id_user', $id_user);
        $this->db->where('status_pesanan !=', 'Dibatalkan');
        $query = $this->db->get('tb_transaksi');
        $total_belanja = $query->row()->total_harga ?? 0;

        // Pesanan Dikirim
        $this->db->where('id_user', $id_user);
        $this->db->where_in('status_pesanan', ['Diproses', 'Dikirim', 'Shipped', 'Processing']);
        $pesanan_dikirim = $this->db->count_all_results('tb_transaksi');

        return [
            'total_transaksi' => (int)$total_transaksi,
            'total_belanja' => (float)$total_belanja,
            'pesanan_dikirim' => (int)$pesanan_dikirim,
        ];
    }

    public function get_petani_kpi($id_user)
    {
        $this->db->select_sum('jumlah_panen');
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('tb_panen');
        $total_panen = $query->row()->jumlah_panen ?? 0;

        $this->db->select_sum('total_harga');
        $this->db->where('id_petani', $id_user);
        $this->db->where('status_pesanan', 'Selesai');
        $query = $this->db->get('tb_transaksi');
        $omset = $query->row()->total_harga ?? 0;

        $this->db->where('id_user', $id_user);
        $this->db->where('status_lahan', 'Active');
        $lahan_aktif = $this->db->count_all_results('tb_lahan');

        $this->db->where('id_petani', $id_user);
        $this->db->where_in('status_pesanan', ['Pending', 'Diproses']);
        $pesanan_masuk = $this->db->count_all_results('tb_transaksi');

        return [
            'total_panen' => $total_panen,
            'omset_penjualan' => $omset,
            'lahan_aktif' => $lahan_aktif,
            'pesanan_masuk' => $pesanan_masuk
        ];
    }

    public function get_admin_kpi()
    {
        $this->db->select_sum('total_harga');
        $this->db->where('status_pesanan', 'Selesai');
        $query = $this->db->get('tb_transaksi');
        $total_revenue = $query->row()->total_harga ?? 0;

        $this->db->where_in('status_pesanan', ['Pending', 'Diproses', 'Dikirim']);
        $transaksi_aktif = $this->db->count_all_results('tb_transaksi');

        $this->db->where('role', 'Petani');
        $this->db->where('is_verified', '1');
        $petani_terverifikasi = $this->db->count_all_results('tb_user');

        $mitra_cafe = 0;
        if ($this->db->table_exists('tb_mitra')) {
            $this->db->where('status_mitra', 'Active');
            $mitra_cafe = $this->db->count_all_results('tb_mitra');
        }

        return [
            'total_revenue' => $total_revenue,
            'transaksi_aktif' => $transaksi_aktif,
            'petani_terverifikasi' => $petani_terverifikasi,
            'mitra_cafe' => $mitra_cafe
        ];
    }

    // ============================================
    // CHART DATA
    // ============================================

    public function get_sales_chart()
    {
        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
        $values = [];

        for ($i = 11; $i >= 0; $i--) {
            $bulan = date('Y-m', strtotime("-$i month"));
            $this->db->select_sum('total_harga');
            $this->db->where("DATE_FORMAT(created_at, '%Y-%m') = '{$bulan}'", NULL, FALSE);
            $query = $this->db->get('tb_transaksi');
            $values[] = (int) ($query->row()->total_harga ?? 0);
        }

        return ['labels' => $labels, 'values' => $values];
    }

    public function get_sales_count_chart()
    {
        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
        $values = [];

        for ($i = 11; $i >= 0; $i--) {
            $bulan = date('Y-m', strtotime("-$i month"));
            $this->db->where("DATE_FORMAT(created_at, '%Y-%m') = '{$bulan}'", NULL, FALSE);
            $values[] = $this->db->count_all_results('tb_transaksi');
        }

        return ['labels' => $labels, 'values' => $values];
    }

    public function get_harvest_chart($id_user)
    {
        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
        $values = [];

        for ($i = 11; $i >= 0; $i--) {
            $bulan = date('Y-m', strtotime("-$i month"));
            $this->db->select_sum('jumlah_panen');
            $this->db->where('id_user', $id_user);
            $this->db->where("DATE_FORMAT(tanggal_panen, '%Y-%m') = '{$bulan}'", NULL, FALSE);
            $query = $this->db->get('tb_panen');
            $values[] = (int) ($query->row()->jumlah_panen ?? 0);
        }

        return ['labels' => $labels, 'values' => $values];
    }

    public function get_shopping_chart($id_user)
    {
        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
        $values = [];

        for ($i = 11; $i >= 0; $i--) {
            $bulan = date('Y-m', strtotime("-$i month"));
            $this->db->select_sum('total_harga');
            $this->db->where('id_user', $id_user);
            $this->db->where("DATE_FORMAT(created_at, '%Y-%m') = '{$bulan}'", NULL, FALSE);
            $query = $this->db->get('tb_transaksi');
            $values[] = (int) ($query->row()->total_harga ?? 0);
        }

        return ['labels' => $labels, 'values' => $values];
    }

    // ============================================
    // REKOMENDASI PRODUK (FIX)
    // ============================================

    public function get_recommendations($id_user, $limit = 4)
    {
        // 🔴 PAKAI TABEL YANG BENAR: tb_detail_transaksi
        if ($this->db->table_exists('tb_detail_transaksi')) {
            $this->db->distinct();
            $this->db->select('p.id_produk, p.nama_produk, p.harga, p.stok_produk as stok, p.foto_utama as foto');
            $this->db->from('tb_detail_transaksi dt');
            $this->db->join('tb_produk p', 'p.id_produk = dt.id_produk');
            $this->db->join('tb_transaksi t', 't.id_transaksi = dt.id_transaksi');
            $this->db->where('t.id_user', $id_user);
            $this->db->where('p.stok_produk >', 0);
            $this->db->order_by('t.created_at', 'DESC');
            $this->db->limit($limit);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
        }

        // 🔴 FALLBACK: Ambil produk dari tb_produk
        $this->db->select('id_produk, nama_produk, harga, stok_produk as stok, foto_utama as foto');
        $this->db->from('tb_produk');
        $this->db->where('stok_produk >', 0);
        $this->db->order_by('stok_produk', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();

        return $query->result_array();
    }

    // ============================================
    // TOP PRODUCTS (FIX)
    // ============================================

    public function get_top_products($limit = 5)
    {
        if ($this->db->table_exists('tb_detail_transaksi')) {
            $this->db->select('p.nama_produk, SUM(dt.jumlah) as total_terjual, SUM(dt.jumlah * dt.harga_satuan) as pendapatan');
            $this->db->from('tb_detail_transaksi dt');
            $this->db->join('tb_produk p', 'p.id_produk = dt.id_produk');
            $this->db->group_by('dt.id_produk');
            $this->db->order_by('total_terjual', 'DESC');
            $this->db->limit($limit);
            $result = $this->db->get()->result_array();

            if (!empty($result)) {
                return $result;
            }
        }

        $this->db->select('id_produk as id, nama_produk as nama, stok_produk as total_terjual, 0 as pendapatan');
        $this->db->from('tb_produk');
        $this->db->where('stok_produk >', 0);
        $this->db->order_by('stok_produk', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    public function get_petani_top_products($id_user, $limit = 5)
    {
        $this->db->select('id_produk as id, nama_produk as nama, stok_produk as total_terjual, 0 as pendapatan');
        $this->db->from('tb_produk');
        $this->db->where('id_user', $id_user);
        $this->db->where('stok_produk >', 0);
        $this->db->order_by('stok_produk', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    // ============================================
    // SIDEBAR BADGE
    // ============================================

    public function get_total_pendapatan()
    {
        $this->db->select_sum('total_harga');
        $this->db->where('status_pesanan', 'Selesai');
        $query = $this->db->get('tb_transaksi');
        return (int) ($query->row()->total_harga ?? 0);
    }

    public function get_total_transaksi()
    {
        return $this->db->count_all('tb_transaksi');
    }

    public function get_total_petani_terverifikasi()
    {
        $this->db->where('role', 'Petani');
        $this->db->where('is_verified', '1');
        return $this->db->count_all_results('tb_user');
    }

    public function get_total_users()
    {
        return $this->db->count_all('tb_user');
    }

    public function get_total_lahan($id_user)
    {
        $this->db->where('id_user', $id_user);
        return $this->db->count_all_results('tb_lahan');
    }

    public function get_total_panen($id_user)
    {
        $this->db->where('id_user', $id_user);
        return $this->db->count_all_results('tb_panen');
    }

    public function get_total_produk($id_user)
    {
        $this->db->where('id_user', $id_user);
        return $this->db->count_all_results('tb_produk');
    }

    public function get_pesanan_masuk($id_user)
    {
        $this->db->where('id_petani', $id_user);
        $this->db->where_in('status_pesanan', ['Pending', 'Diproses']);
        return $this->db->count_all_results('tb_transaksi');
    }

    public function get_stok_menipis($id_user, $limit = 5)
    {
        $this->db->where('id_user', $id_user);
        $this->db->where('stok_produk <', 20);
        $this->db->order_by('stok_produk', 'ASC');
        $this->db->limit($limit);
        return $this->db->get('tb_produk')->result_array();
    }

    public function get_jadwal_panen($id_user, $limit = 5)
    {
        $this->db->where('id_user', $id_user);
        $this->db->where('tanggal_panen >=', date('Y-m-d'));
        $this->db->order_by('tanggal_panen', 'ASC');
        $this->db->limit($limit);
        return $this->db->get('tb_panen')->result_array();
    }

    // ============================================
    // FUNGSI TAMBAHAN UNTUK NOTIFIKASI
    // ============================================

    public function send_to_pembeli($pembeli_id, $judul, $pesan, $icon = 'info', $link = null)
    {
        return $this->insert_notification([
            'id_user' => $pembeli_id,
            'judul' => $judul,
            'isi_notifikasi' => $pesan,
            'icon' => $icon,
            'link' => $link
        ]);
    }

    public function send_to_admin($admin_id, $judul, $pesan, $icon = 'info', $link = null)
    {
        return $this->insert_notification([
            'id_user' => $admin_id,
            'judul' => $judul,
            'isi_notifikasi' => $pesan,
            'icon' => $icon,
            'link' => $link
        ]);
    }

    public function send_to_petani($petani_id, $judul, $pesan, $icon = 'info', $link = null)
    {
        return $this->insert_notification([
            'id_user' => $petani_id,
            'judul' => $judul,
            'isi_notifikasi' => $pesan,
            'icon' => $icon,
            'link' => $link
        ]);
    }

    public function send_to_all_admins($judul, $pesan, $icon = 'info', $link = null)
    {
        $this->db->where('role', 'Admin');
        $admins = $this->db->get('tb_user')->result_array();

        $results = [];
        foreach ($admins as $admin) {
            $results[] = $this->insert_notification([
                'id_user' => $admin['id_user'],
                'judul' => $judul,
                'isi_notifikasi' => $pesan,
                'icon' => $icon,
                'link' => $link
            ]);
        }
        return $results;
    }
}
?>
