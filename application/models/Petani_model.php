<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petani_model extends CI_Model {

    protected $table = 'tb_petani'; 
    protected $table_wilayah = 'tb_wilayah';
    protected $table_petani_wilayah = 'tb_petani_wilayah';

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
        
        $daftar = $this->db->get()->result_array();

        // Lampirkan daftar wilayah untuk masing-masing petani (1 query tambahan, lalu mapping di PHP)
        if (!empty($daftar)) {
            $ids = array_column($daftar, 'id_petani');
            $this->db->select('pw.id_petani, w.id_wilayah, w.nama_wilayah');
            $this->db->from($this->table_petani_wilayah . ' pw');
            $this->db->join($this->table_wilayah . ' w', 'w.id_wilayah = pw.id_wilayah');
            $this->db->where_in('pw.id_petani', $ids);
            $rows = $this->db->get()->result_array();

            $map = [];
            foreach ($rows as $r) {
                $map[$r['id_petani']][] = $r;
            }

            foreach ($daftar as &$p) {
                $p['wilayah'] = $map[$p['id_petani']] ?? [];
            }
        }

        return $daftar;
    }

    // Mengambil 1 data petani spesifik dengan pengecekan
    public function get_petani_by_id($id) {
        if (empty($id)) {
            return false;
        }
        $petani = $this->db->get_where($this->table, ['id_petani' => $id])->row_array();
        if ($petani) {
            $petani['wilayah'] = $this->get_wilayah_by_petani($id);
        }
        return $petani;
    }

    // Mengambil semua master wilayah (untuk checkbox di form tambah/edit)
    public function get_all_wilayah() {
        return $this->db->order_by('nama_wilayah', 'ASC')->get($this->table_wilayah)->result_array();
    }

    // Mengambil wilayah yang sedang dipilih oleh seorang petani (lengkap dengan alamat wilayah)
    public function get_wilayah_by_petani($id_petani) {
        $this->db->select('w.id_wilayah, w.nama_wilayah, w.alamat_wilayah');
        $this->db->from($this->table_petani_wilayah . ' pw');
        $this->db->join($this->table_wilayah . ' w', 'w.id_wilayah = pw.id_wilayah');
        $this->db->where('pw.id_petani', $id_petani);
        return $this->db->get()->result_array();
    }

    // Menyimpan ulang relasi petani <-> wilayah (dipakai saat tambah & edit)
    // $id_wilayah_list adalah array berisi id_wilayah yang dicentang, boleh lebih dari 1
    public function simpan_wilayah_petani($id_petani, $id_wilayah_list) {
        $this->db->where('id_petani', $id_petani);
        $this->db->delete($this->table_petani_wilayah);

        if (!empty($id_wilayah_list)) {
            $insert_batch = [];
            foreach ($id_wilayah_list as $id_wilayah) {
                $insert_batch[] = [
                    'id_petani'  => $id_petani,
                    'id_wilayah' => $id_wilayah,
                ];
            }
            $this->db->insert_batch($this->table_petani_wilayah, $insert_batch);
        }
    }

    // Memasukkan data pendaftaran petani baru
    public function insert_petani($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
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