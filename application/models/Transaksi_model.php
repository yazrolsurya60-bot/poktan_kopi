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
        $this->db->select('d.*, p.nama_produk, p.foto_produk');
        $this->db->from('tb_detail_transaksi d');
        $this->db->join('tb_produk p', 'd.id_produk = p.id_produk', 'left');
        $this->db->where('d.id_transaksi', $id_transaksi);
        return $this->db->get()->result_array();
    }

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

    public function hitung_ongkir_server($kota_asal, $kota_tujuan, $berat_gram = 1000) {
        $this->db->where('kota_asal', $kota_asal);
        $this->db->where('kota_tujuan', $kota_tujuan);
        $ongkir = $this->db->get('tb_ongkir')->row_array();

        if (!$ongkir) {
            return array(
                'success' => false,
                'message' => 'Rute pengiriman tidak ditemukan.',
                'ongkir'  => 0,
            );
        }

        // ============================================================
        // PENTING: cek nama kolom asli di tabel tb_ongkir kamu
        // (buka phpMyAdmin -> tabel tb_ongkir -> lihat nama kolomnya).
        // Kode di bawah ini coba beberapa kemungkinan nama kolom yang
        // umum dipakai, supaya tidak error walau namanya beda dari
        // 'harga_per_kg'. Setelah tahu nama kolom aslinya, sebaiknya
        // sederhanakan jadi satu baris saja, misal:
        //   $harga_per_kg = (int) $ongkir['nama_kolom_asli'];
        // ============================================================
        $kemungkinan_kolom = array('harga_per_kg', 'tarif_per_kg', 'harga_kg', 'tarif', 'harga');
        $harga_per_kg = null;
        foreach ($kemungkinan_kolom as $kolom) {
            if (isset($ongkir[$kolom])) {
                $harga_per_kg = (int) $ongkir[$kolom];
                break;
            }
        }

        if ($harga_per_kg === null) {
            return array(
                'success' => false,
                'message' => 'Konfigurasi tarif ongkir tidak valid (nama kolom harga tidak ditemukan).',
                'ongkir'  => 0,
            );
        }

        // Hitung biaya berdasarkan berat, minimal 1 kg
        $kg    = max(1, ceil($berat_gram / 1000));
        $biaya = $kg * $harga_per_kg;

        return array(
            'success'     => true,
            'kota_asal'   => $kota_asal,
            'kota_tujuan' => $kota_tujuan,
            'berat_gram'  => $berat_gram,
            'estimasi'    => isset($ongkir['estimasi']) ? $ongkir['estimasi'] : '-',
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