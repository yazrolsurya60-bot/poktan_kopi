<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lahan_model extends CI_Model {

    // Mengambil semua data lahan (untuk petani tertentu atau monitoring admin) dengan filter 
    public function get_all_lahan($id_user = null, $filter = []) {
        $this->db->select('*');
        $this->db->from('tb_lahan');

        if ($id_user !== null) {
            $this->db->where('id_user', $id_user);
        }
        if (!empty($filter['status_lahan'])) {
            $this->db->where('status_lahan', $filter['status_lahan']);
        }
        if (!empty($filter['lokasi'])) {
            $this->db->like('lokasi', $filter['lokasi']);
        }

        return $this->db->get()->result_array();
    }

    // Input lahan baru [cite: 76]
    public function insert_lahan($data) {
        return $this->db->insert('tb_lahan', $data);
    }

    // Detail satu lahan [cite: 76]
    public function get_lahan_by_id($id_lahan) {
        $this->db->where('id_lahan', $id_lahan);
        return $this->db->get('tb_lahan')->row_array();
    }

    // Update data lahan [cite: 76]
    public function update_lahan($id_lahan, $data) {
        $this->db->where('id_lahan', $id_lahan);
        return $this->db->update('tb_lahan', $data);
    }

    // Hapus data lahan permanen
    public function delete_lahan($id_lahan) {
        $this->db->where('id_lahan', $id_lahan);
        return $this->db->delete('tb_lahan');
    }
}