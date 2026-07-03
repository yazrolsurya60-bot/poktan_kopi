<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petani_model extends CI_Model {

    protected $table = 'tb_petani'; 
    protected $table_wilayah = 'tb_wilayah';
    protected $table_petani_wilayah = 'tb_petani_wilayah';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // ============================================
    // GET PETANI BARU - DARI TB_USER (KARENA TB_PETANI KOSONG)
    // ============================================
    public function get_petani_baru($limit = 5) {
        // 🔴 AMBIL DARI TB_USER DULU (karena tb_petani kosong)
        $this->db->select('
            id_user as id_petani,
            nama as nama_petani,
            status,
            created_at as tanggal_daftar,
            no_hp,
            email,
            is_verified
        ');
        $this->db->from('tb_user');
        $this->db->where('role', 'Petani');
        $this->db->where('status', 'Pending');
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        
        // 🔴 FALLBACK: Jika tidak ada, ambil semua petani
        $this->db->select('
            id_user as id_petani,
            nama as nama_petani,
            status,
            created_at as tanggal_daftar,
            no_hp,
            email,
            is_verified
        ');
        $this->db->from('tb_user');
        $this->db->where('role', 'Petani');
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        
        return $query->result_array();
    }

    // ============================================
    // HITUNG PETANI BELUM DIVERIFIKASI
    // ============================================
    public function count_petani_pending() {
        // 🔴 HITUNG DARI TB_USER
        $this->db->where('role', 'Petani');
        $this->db->where('status', 'Pending');
        return $this->db->count_all_results('tb_user');
    }

    // ============================================
    // HITUNG PETANI AKTIF (TERVERIFIKASI)
    // ============================================
    public function count_petani_aktif() {
        // 🔴 HITUNG DARI TB_USER
        $this->db->where('role', 'Petani');
        $this->db->where('status', 'Active');
        return $this->db->count_all_results('tb_user');
    }

    // ============================================
    // GET ALL PETANI - DARI TB_USER
    // ============================================
    public function get_daftar_petani($status = null, $id_wilayah = null) {
        $this->db->select('
            id_user as id_petani,
            nama as nama_petani,
            status,
            created_at as tanggal_daftar,
            no_hp,
            email,
            is_verified
        ');
        $this->db->from('tb_user');
        $this->db->where('role', 'Petani');
        
        if (!empty($status)) {
            $this->db->where('status', $status);
        }
        
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get()->result_array();
    }

    // ============================================
    // GET PETANI BY ID - DARI TB_USER
    // ============================================
    public function get_petani_by_id($id) {
        if (empty($id)) {
            return false;
        }
        $this->db->where('id_user', $id);
        $this->db->where('role', 'Petani');
        return $this->db->get('tb_user')->row_array();
    }

    // ============================================
    // GET WILAYAH (jika ada)
    // ============================================
    public function get_all_wilayah() {
        if ($this->db->table_exists('tb_wilayah')) {
            return $this->db->order_by('nama_wilayah', 'ASC')->get('tb_wilayah')->result_array();
        }
        return [];
    }

    public function get_wilayah_by_petani($id_petani) {
        return [];
    }

    public function simpan_wilayah_petani($id_petani, $id_wilayah_list) {
        // Tidak digunakan karena pakai tb_user
        return true;
    }

    // ============================================
    // CRUD PETANI - KE TB_USER
    // ============================================
    public function insert_petani($data) {
        // Pastikan role = Petani
        $data['role'] = 'Petani';
        $this->db->insert('tb_user', $data);
        return $this->db->insert_id();
    }

    public function update_petani($id, $data) {
        if (empty($id)) {
            return false;
        }
        $this->db->where('id_user', $id);
        $this->db->where('role', 'Petani');
        return $this->db->update('tb_user', $data);
    }

    public function delete_petani($id) {
        if (empty($id)) {
            return false;
        }
        $this->db->where('id_user', $id);
        $this->db->where('role', 'Petani');
        return $this->db->update('tb_user', ['status' => 'Inactive']);
    }
}
?>
