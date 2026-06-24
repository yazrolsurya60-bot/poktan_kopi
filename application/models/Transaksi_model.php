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
            'verified_at' => date('Y-m-d H:i:s')
        );
        if ($keterangan) {
            $data['keterangan'] = $keterangan;
        }
        $this->db->where('id_transaksi', $id_transaksi);
        return $this->db->update('tb_bukti_bayar', $data);
    }
}
?>