<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mitra_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_mitra($search = '', $kategori = '', $status = '') {
        $this->db->select('*');
        $this->db->from('tb_mitra');

        if (!empty($search)) {
            $this->db->group_start()
                     ->like('nama_mitra', $search)
                     ->group_end();
        }

        if (!empty($kategori)) {
            $this->db->where('kategori_mitra', $kategori);
        }

        if (!empty($status)) {
            $this->db->where('status_mitra', $status);
        }

        $this->db->order_by('urutan_tampil', 'ASC');
        return $this->db->get()->result_array();
    }

    public function get_active_mitra_landing() {
        return $this->db->where('status_mitra', 'Active')
                        ->order_by('urutan_tampil', 'ASC')
                        ->get('tb_mitra')
                        ->result_array();
    }

    public function get_by_id($id) {
        return $this->db->get_where('tb_mitra', ['id_mitra' => $id])->row_array();
    }

    public function insert_mitra($data) {
        $this->db->insert('tb_mitra', $data);
        return $this->db->insert_id();
    }

    public function update_mitra($id, $data) {
        return $this->db->where('id_mitra', $id)->update('tb_mitra', $data);
    }

    public function delete_mitra($id) {
        // Soft delete implementation: set status to Inactive
        return $this->db->where('id_mitra', $id)->update('tb_mitra', ['status_mitra' => 'Inactive']);
    }

    public function toggle_status($id) {
        $mitra = $this->get_by_id($id);
        if (!$mitra) return false;
        $newStatus = ($mitra['status_mitra'] === 'Active') ? 'Inactive' : 'Active';
        return $this->db->where('id_mitra', $id)->update('tb_mitra', ['status_mitra' => $newStatus]);
    }
}
