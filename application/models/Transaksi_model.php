<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // ==================== TRANSAKSI ====================
    
    public function buat_transaksi($data) {
        $this->db->insert('tb_transaksi', $data);
        return $this->db->insert_id();
    }

    public function tambah_detail($data) {
        return $this->db->insert('tb_detail_transaksi', $data);
    }

    public function get_transaksi($id_transaksi) {
        $this->db->select('t.*, u.nama as nama_pembeli, u.email, u.no_hp as user_hp');
        $this->db->from('tb_transaksi t');
        $this->db->join('tb_user u', 't.id_user = u.id_user', 'left');
        $this->db->where('t.id_transaksi', $id_transaksi);
        return $this->db->get()->row_array();
    }

    public function get_detail_transaksi($id_transaksi) {
        // 🔥 FIX: kolom yang benar adalah 'foto_utama', bukan 'foto_produk'
        $this->db->select('d.*, p.nama_produk, p.foto_utama');
        $this->db->from('tb_detail_transaksi d');
        $this->db->join('tb_produk p', 'd.id_produk = p.id_produk', 'left');
        $this->db->where('d.id_transaksi', $id_transaksi);
        return $this->db->get()->result_array();
    }

    // ============================================================
    // 🔥 METHOD BARU 1: Ambil transaksi MEMBER saja (untuk admin)
    // ============================================================
    public function get_all_transaksi_member($filter = array()) {
        $this->db->select('t.*, u.nama as nama_pembeli');
        $this->db->from('tb_transaksi t');
        $this->db->join('tb_user u', 't.id_user = u.id_user', 'left');
        
        // 🔥 HANYA MEMBER (id_user NOT NULL)
        $this->db->where('t.id_user IS NOT NULL');
        
        if (!empty($filter['status_pesanan'])) {
            $this->db->where('t.status_pesanan', $filter['status_pesanan']);
        }
        if (!empty($filter['id_user'])) {
            $this->db->where('t.id_user', $filter['id_user']);
        }
        if (!empty($filter['tanggal_awal']) && !empty($filter['tanggal_akhir'])) {
            $this->db->where('DATE(t.tanggal_transaksi) >=', $filter['tanggal_awal']);
            $this->db->where('DATE(t.tanggal_transaksi) <=', $filter['tanggal_akhir']);
        }
        
        $this->db->order_by('t.tanggal_transaksi', 'DESC');
        return $this->db->get()->result_array();
    }

    // ============================================================
    // 🔥 METHOD BARU 2: Cari transaksi GUEST (untuk tracking guest)
    // ============================================================
    public function get_guest_transaksi($invoice, $email) {
        $this->db->select('t.*');
        $this->db->from('tb_transaksi t');
        $this->db->where('t.invoice', $invoice);
        $this->db->where('t.email_pembeli', $email);
        $this->db->where('t.id_user IS NULL'); // 🔥 GUEST
        return $this->db->get()->row_array();
    }

    // ============================================================
    // 🔥 METHOD BARU 3: Ambil transaksi user dengan daftar produk
    // ============================================================
    public function get_transaksi_by_user_with_products($id_user, $limit = null) {
        $this->db->select('t.*, 
                           (SELECT GROUP_CONCAT(p.nama_produk SEPARATOR ", ") 
                            FROM tb_detail_transaksi d 
                            JOIN tb_produk p ON d.id_produk = p.id_produk 
                            WHERE d.id_transaksi = t.id_transaksi) as produk_list');
        $this->db->from('tb_transaksi t');
        $this->db->where('t.id_user', $id_user);
        $this->db->order_by('t.tanggal_transaksi', 'DESC');
        if ($limit) {
            $this->db->limit($limit);
        }
        return $this->db->get()->result_array();
    }

    // ============================================================
    // METHOD LAMA (tetap dipertahankan)
    // ============================================================
    public function get_all_transaksi($filter = array()) {
        $this->db->select('t.*, u.nama as nama_pembeli');
        $this->db->from('tb_transaksi t');
        $this->db->join('tb_user u', 't.id_user = u.id_user', 'left');
        
        if (!empty($filter['status_pesanan'])) {
            $this->db->where('t.status_pesanan', $filter['status_pesanan']);
        }
        if (!empty($filter['id_user'])) {
            $this->db->where('t.id_user', $filter['id_user']);
        }
        if (!empty($filter['tanggal_awal']) && !empty($filter['tanggal_akhir'])) {
            $this->db->where('DATE(t.tanggal_transaksi) >=', $filter['tanggal_awal']);
            $this->db->where('DATE(t.tanggal_transaksi) <=', $filter['tanggal_akhir']);
        }
        
        $this->db->order_by('t.tanggal_transaksi', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_transaksi_by_user($id_user, $limit = null) {
        $this->db->select('t.*');
        $this->db->from('tb_transaksi t');
        $this->db->where('t.id_user', $id_user);
        $this->db->order_by('t.tanggal_transaksi', 'DESC');
        if ($limit) {
            $this->db->limit($limit);
        }
        return $this->db->get()->result_array();
    }

    public function update_status($id_transaksi, $status, $data_extra = array()) {
        $data = array('status_pesanan' => $status);
        if ($status == 'Dibatalkan') {
            $data['tanggal_batal'] = date('Y-m-d H:i:s');
        }
        $data = array_merge($data, $data_extra);
        $this->db->where('id_transaksi', $id_transaksi);
        return $this->db->update('tb_transaksi', $data);
    }

    public function update_status_bayar($id_transaksi, $status_bayar) {
        $this->db->where('id_transaksi', $id_transaksi);
        return $this->db->update('tb_transaksi', array('status_bayar' => $status_bayar));
    }

    public function count_by_status($status = null) {
        if ($status) {
            $this->db->where('status_pesanan', $status);
        }
        return $this->db->count_all_results('tb_transaksi');
    }

    // ==================== BUKTI BAYAR ====================

    public function upload_bukti($data) {
        return $this->db->insert('tb_bukti_bayar', $data);
    }

    public function get_bukti_by_transaksi($id_transaksi) {
        $this->db->where('id_transaksi', $id_transaksi);
        return $this->db->get('tb_bukti_bayar')->row_array();
    }

    public function verifikasi_bukti($id_transaksi, $status, $keterangan = null) {
        $data = array(
            'status_verifikasi' => $status,
            'verified_at'       => date('Y-m-d H:i:s')
        );
        if ($keterangan) {
            $data['keterangan'] = $keterangan;
        }
        $this->db->where('id_transaksi', $id_transaksi);
        return $this->db->update('tb_bukti_bayar', $data);
    }

    // ==================== ONGKIR ====================

    public function get_ongkir($kota_asal, $kota_tujuan) {
        $this->db->where('kota_asal', $kota_asal);
        $this->db->where('kota_tujuan', $kota_tujuan);
        return $this->db->get('tb_ongkir')->row_array();
    }

    // ============================================================
    // 🔥 FIX: HITUNG ONGKIR - PAKAI KOLOM 'tarif' & 'estimasi_hari'
    // ============================================================
    public function hitung_ongkir_server($kota_asal, $kota_tujuan, $berat_gram = 1000) {
        $this->db->where('kota_asal', $kota_asal);
        $this->db->where('kota_tujuan', $kota_tujuan);
        $ongkir = $this->db->get('tb_ongkir')->row_array();

        if (!$ongkir) {
            return array(
                'success' => false,
                'message' => 'Rute pengiriman ' . $kota_asal . ' → ' . $kota_tujuan . ' tidak ditemukan.',
                'ongkir'  => 0,
            );
        }

        // 🔥 PAKAI KOLOM 'tarif' (sesuai struktur tb_ongkir terbaru)
        $tarif = isset($ongkir['tarif']) ? (int) $ongkir['tarif'] : 0;

        if ($tarif <= 0) {
            return array(
                'success' => false,
                'message' => 'Tarif ongkir untuk rute ini tidak valid.',
                'ongkir'  => 0,
            );
        }

        // Hitung biaya berdasarkan berat, minimal 1 kg
        $kg    = max(1, ceil($berat_gram / 1000));
        $biaya = $kg * $tarif;

        // 🔥 PAKAI KOLOM 'estimasi_hari'
        $estimasi = isset($ongkir['estimasi_hari']) ? $ongkir['estimasi_hari'] : 1;

        return array(
            'success'     => true,
            'kota_asal'   => $kota_asal,
            'kota_tujuan' => $kota_tujuan,
            'berat_gram'  => $berat_gram,
            'estimasi'    => $estimasi,
            'ongkir'      => $biaya,
        );
    }

    // ==================== NOMOR INVOICE ====================

    public function generate_invoice() {
        $last = $this->db
            ->select('invoice')
            ->order_by('id_transaksi', 'DESC')
            ->limit(1)
            ->get('tb_transaksi')
            ->row();

        if ($last && preg_match('/INV-(\d+)/', $last->invoice, $m)) {
            $next = (int)$m[1] + 1;
        } else {
            $next = 1;
        }
        return 'INV-' . str_pad($next, 6, '0', STR_PAD_LEFT);
    }

    // Ambil transaksi yang sudah upload bukti tapi belum diverifikasi
    public function get_transaksi_butuh_konfirmasi() {
        $this->db->select('t.id_transaksi, t.id_user, t.invoice, t.total_harga, t.ongkir, t.grand_total, t.nama_penerima, t.no_hp, t.status_bayar, t.status_pesanan, t.metode_bayar, t.tanggal_transaksi, u.nama as nama_pembeli, b.id_bukti, b.file_bukti, b.nama_bank, b.nama_pengirim, b.jumlah_transfer, b.tanggal_transfer, b.status_verifikasi');
        $this->db->from('tb_transaksi t');
        $this->db->join('tb_user u', 't.id_user = u.id_user', 'left');
        $this->db->join('tb_bukti_bayar b', 'b.id_transaksi = t.id_transaksi', 'inner');
        $this->db->where('b.status_verifikasi', 'Pending');
        $this->db->where('t.status_bayar !=', 'Lunas');
        $this->db->where('t.status_pesanan !=', 'Dibatalkan');
        $this->db->order_by('t.tanggal_transaksi', 'DESC');
        return $this->db->get()->result_array();
    }
}
?>