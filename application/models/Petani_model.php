<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petani_model extends CI_Model {

    protected $table = 'tb_petani'; 

    // Mengambil daftar petani dengan penanganan filter yang lebih aman
    public function get_daftar_petani($status = null) {
        $this->db->from($this->table);
        $this->db->where('is_deleted', 0);
        
        // Cek jika status ada dan bukan string kosong
        if (!empty($status)) {
            $this->db->where('status_petani', $status);
        }
        
        // Urutkan terbaru di atas (opsional tapi disarankan untuk admin)
        $this->db->order_by('id_petani', 'DESC');
        
        return $this->db->get()->result_array();
    }

    // Mengambil 1 data petani spesifik dengan pengecekan
    public function get_petani_by_id($id) {
        if (empty($id)) {
            return false;
        }
        return $this->db->get_where($this->table, ['id_petani' => $id])->row_array();
    }

    // Memasukkan data pendaftaran petani baru
    public function insert_petani($data) {
        return $this->db->insert($this->table, $data);
    }

    // Mengubah data petani
    public function update_petani($id, $data) {
        if (empty($id)) {
            return false;
        }
        $this->db->where('id_petani', $id);
        return $this->db->update($this->table, $data);
    }

    // Menghapus baris data petani (Soft Delete)
    public function delete_petani($id) {
        if (empty($id)) {
            return false;
        }
        $this->db->where('id_petani', $id);
        return $this->db->update($this->table, ['is_deleted' => 1]);
    }
}