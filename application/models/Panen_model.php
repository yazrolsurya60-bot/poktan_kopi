<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panen_model extends CI_Model {

    public function get_all_panen($id_user = null, $filters = []) {
        $this->db->select('tb_panen.*, tb_lahan.nama_lahan, tb_lahan.lokasi, tb_user.nama as nama_petani');
        $this->db->from('tb_panen');
        $this->db->join('tb_lahan', 'tb_lahan.id_lahan = tb_panen.id_lahan', 'left');
        $this->db->join('tb_user', 'tb_user.id_user = tb_panen.id_user', 'left');
        
        if ($id_user !== null) {
            $this->db->where('tb_panen.id_user', $id_user);
        }

        // Filters (M04-F06)
        if (!empty($filters['start_date'])) {
            $this->db->where('tb_panen.tanggal_panen >=', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('tb_panen.tanggal_panen <=', $filters['end_date']);
        }
        if (!empty($filters['id_lahan'])) {
            $this->db->where('tb_panen.id_lahan', $filters['id_lahan']);
        }
        if (!empty($filters['kualitas'])) {
            $this->db->like('tb_panen.kualitas', $filters['kualitas']);
        }
        
        $this->db->order_by('tb_panen.tanggal_panen', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_statistik_panen($id_user = null) {
        // M04-F07: Grafik hasil panen per periode (6 bulan terakhir)
        $this->db->select('DATE_FORMAT(tanggal_panen, "%Y-%m") as bulan, SUM(jumlah_panen) as total_panen');
        $this->db->from('tb_panen');
        if ($id_user !== null) {
            $this->db->where('id_user', $id_user);
        }
        $this->db->where('tanggal_panen >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)');
        $this->db->group_by('bulan');
        $this->db->order_by('bulan', 'ASC');
        return $this->db->get()->result_array();
    }

   public function check_unrecorded_harvest($id_user) {
        // M04-F09: Cek lahan aktif yang belum dipanen > 30 hari menggunakan LEFT JOIN (Lebih aman dari bug alias MySQL)
        $query = "
            SELECT l.id_lahan, l.nama_lahan 
            FROM tb_lahan l 
            LEFT JOIN tb_panen p ON p.id_lahan = l.id_lahan 
                AND p.tanggal_panen >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
            WHERE l.id_user = ? 
              AND l.status_lahan = 'Active' 
              AND p.id_lahan IS NULL
        ";
        return $this->db->query($query, [$id_user])->result_array();
    }

    public function get_panen_by_id($id_panen) {
        $this->db->select('tb_panen.*, tb_lahan.nama_lahan, tb_lahan.lokasi, tb_user.nama as nama_petani');
        $this->db->from('tb_panen');
        $this->db->join('tb_lahan', 'tb_lahan.id_lahan = tb_panen.id_lahan', 'left');
        $this->db->join('tb_user', 'tb_user.id_user = tb_panen.id_user', 'left');
        $this->db->where('tb_panen.id_panen', $id_panen);
        return $this->db->get()->row_array();
    }

    public function insert_panen($data) {
        return $this->db->insert('tb_panen', $data);
    }

    public function update_panen($id_panen, $data) {
        $this->db->where('id_panen', $id_panen);
        return $this->db->update('tb_panen', $data);
    }

    public function delete_panen($id_panen) {
        $this->db->where('id_panen', $id_panen);
        return $this->db->delete('tb_panen');
    }

    public function get_lahan_by_petani($id_user) {
        $this->db->where('id_user', $id_user);
        $this->db->where('status_lahan', 'Active');
        return $this->db->get('tb_lahan')->result_array();
    }
    public function get_panen_by_lahan($id_lahan) {
    // Ubah bagian 'panen' menjadi 'tb_panen'
    return $this->db->where('id_lahan', $id_lahan)
                    ->get('tb_panen') 
                    ->result();
}
}
