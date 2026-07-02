<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lahan_model extends CI_Model {

    public function get_all_lahan($id_user = null, $filters = []) {
        $this->db->select('tb_lahan.*, tb_user.nama as nama_petani');
        $this->db->from('tb_lahan');
        $this->db->join('tb_user', 'tb_user.id_user = tb_lahan.id_user', 'left');
        
        // Jika ada ID User, filter berdasarkan user tersebut
        if ($id_user !== null) {
            $this->db->where('tb_lahan.id_user', $id_user);
        }

        // Filter status hanya dijalankan jika user memilih salah satu (Active/Inactive)
        if (!empty($filters['status_lahan'])) {
            $this->db->where('tb_lahan.status_lahan', $filters['status_lahan']);
        }

        // 🔄 REVISI: Mengubah pencarian lokasi lama menjadi universal keyword (Nama Lahan ATAU Lokasi)
        if (!empty($filters['keyword'])) {
            $this->db->group_start(); // Membuka tanda kurung (
            $this->db->like('tb_lahan.nama_lahan', $filters['keyword']);
            $this->db->or_like('tb_lahan.lokasi', $filters['keyword']);
            $this->db->group_end(); // Menutup tanda kurung )
        }

        return $this->db->get()->result_array();
    }

    // --- PERBAIKAN: Hanya gunakan SATU fungsi get_detail yang benar ---
    public function get_detail($id) {
        // Gunakan tb_lahan dan id_lahan agar sesuai dengan struktur database Anda
        return $this->db->get_where('tb_lahan', array('id_lahan' => $id))->row_array();
    }

    // M03-F01: Tambah Lahan
    public function insert_lahan($data) {
        return $this->db->insert('tb_lahan', $data);
    }

    // M03-F04: Edit Lahan
    public function update_lahan($id_lahan, $data) {
        $this->db->where('id_lahan', $id_lahan);
        return $this->db->update('tb_lahan', $data);
    }

    // M03-F05: Soft Delete
    public function soft_delete_lahan($id_lahan) {
        $this->db->where('id_lahan', $id_lahan);
        return $this->db->update('tb_lahan', ['status_lahan' => 'Inactive']);
    }

    // M03-F06: Hapus Data Permanen
    public function hapus_data($id) {
        $this->db->where('id_lahan', $id);
        $this->db->delete('tb_lahan');
    }
}