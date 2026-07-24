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
    // GET PETANI BARU - DARI TB_PETANI
    // ============================================
    public function get_petani_baru($limit = 5) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('status_petani', 'Pending');
        $this->db->order_by('tanggal_daftar', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('tanggal_daftar', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    // ============================================
    // HITUNG PETANI
    // ============================================
    public function count_petani_pending() {
        $this->db->where('status_petani', 'Pending');
        return $this->db->count_all_results($this->table);
    }

    public function count_petani_aktif() {
        $this->db->where('status_petani', 'Active');
        return $this->db->count_all_results($this->table);
    }

    // ============================================
    // COUNT DATA UNTUK PAGINATION
    // ============================================
    public function count_all_petani($status = null, $id_wilayah = null) {
        $this->db->from($this->table);
        if (!empty($status)) {
            $this->db->where('status_petani', $status);
        }
        return $this->db->count_all_results();
    }

    // ============================================
    // GET ALL PETANI (DENGAN PAGINATION)
    // ============================================
    public function get_daftar_petani_paginated($limit = 10, $start = 0, $status = null, $id_wilayah = null) {
        $this->db->select('*');
        $this->db->from($this->table);

        if (!empty($status)) {
            $this->db->where('status_petani', $status);
        }
        
        $this->db->order_by('id_petani', 'DESC');
        $this->db->limit($limit, $start);
        $petani = $this->db->get()->result_array();

        foreach ($petani as &$p) {
            $p['wilayah'] = $this->get_wilayah_by_petani($p['id_petani']);
            $p['status']  = $p['status_petani'] ?? '-';
            $p['foto']    = $p['foto_profil'] ?? null;
        }

        return $petani;
    }

    // ============================================
    // GET ALL PETANI - TANPA PAGINATION (EXPORT & STATISTIK)
    // ============================================
    public function get_daftar_petani($status = null, $id_wilayah = null) {
        $this->db->select('*');
        $this->db->from($this->table);

        if (!empty($status)) {
            $this->db->where('status_petani', $status);
        }
        
        $this->db->order_by('tanggal_daftar', 'DESC');
        $petani = $this->db->get()->result_array();

        foreach ($petani as &$p) {
            $p['wilayah'] = $this->get_wilayah_by_petani($p['id_petani']);
            $p['status']  = $p['status_petani'] ?? '-';
            $p['foto']    = $p['foto_profil'] ?? null;
        }

        return $petani;
    }

    // ============================================
    // GET PETANI BY ID - DARI TB_PETANI
    // ============================================
    public function get_petani_by_id($id) {
        if (empty($id)) {
            return false;
        }
        
        $this->db->select('*');
        $this->db->where('id_petani', $id);
        $petani = $this->db->get($this->table)->row_array();

        if ($petani) {
            $petani['wilayah'] = $this->get_wilayah_by_petani($id);
            $petani['status']  = $petani['status_petani'] ?? '-';
            $petani['foto']    = $petani['foto_profil'] ?? null;
        }

        return $petani;
    }

    // ============================================
    // WILAYAH
    // ============================================
    public function get_all_wilayah() {
        if ($this->db->table_exists('tb_wilayah')) {
            return $this->db->order_by('nama_wilayah', 'ASC')->get('tb_wilayah')->result_array();
        }
        return [];
    }

    public function get_wilayah_by_petani($id_petani) {
        if ($this->db->table_exists('tb_petani_wilayah') && $this->db->table_exists('tb_wilayah')) {
            $this->db->select('w.*');
            $this->db->from('tb_wilayah w');
            $this->db->join('tb_petani_wilayah pw', 'pw.id_wilayah = w.id_wilayah');
            $this->db->where('pw.id_petani', $id_petani);
            return $this->db->get()->result_array();
        }
        return [];
    }

    public function simpan_wilayah_petani($id_petani, $id_wilayah_list) {
        if ($this->db->table_exists('tb_petani_wilayah')) {
            $this->db->where('id_petani', $id_petani);
            $this->db->delete('tb_petani_wilayah');

            if (!empty($id_wilayah_list) && is_array($id_wilayah_list)) {
                $batch = [];
                foreach ($id_wilayah_list as $id_w) {
                    $batch[] = [
                        'id_petani'  => $id_petani,
                        'id_wilayah' => $id_w
                    ];
                }
                $this->db->insert_batch('tb_petani_wilayah', $batch);
            }
        }
        return true;
    }

    // ============================================
    // CRUD PETANI - KE TB_PETANI
    // ============================================
    public function insert_petani($data) {
        $insert_data = [
            'nama_petani'    => $data['nama_petani'] ?? '',
            'nik'            => $data['nik'] ?? NULL,
            'no_hp'          => $data['no_hp'] ?? NULL,
            'alamat'         => $data['alamat'] ?? NULL,
            'domisili'       => $data['domisili'] ?? NULL,
            'status_petani'  => $data['status_petani'] ?? 'Pending',
            'tanggal_daftar' => date('Y-m-d')
        ];

        if (!empty($data['foto_profil'])) {
            $insert_data['foto_profil'] = $data['foto_profil'];
        }

        $this->db->insert($this->table, $insert_data);
        return $this->db->insert_id();
    }

    public function update_petani($id, $data) {
        if (empty($id)) {
            return false;
        }

        $this->db->where('id_petani', $id);
        return $this->db->update($this->table, $data);
    }

    // HAPUS PERMANEN (HARD DELETE) DARI DATABASE
    public function delete_petani($id) {
        if (empty($id)) {
            return false;
        }
        
        // 1. Hapus relasi wilayah terlebih dahulu jika ada
        if ($this->db->table_exists('tb_petani_wilayah')) {
            $this->db->where('id_petani', $id);
            $this->db->delete('tb_petani_wilayah');
        }

        // 2. Hapus data petani dari database
        $this->db->where('id_petani', $id);
        return $this->db->delete($this->table);
    }
}