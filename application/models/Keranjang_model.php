<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keranjang_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_keranjang($id_user = null, $session_id = null) {
        $this->db->select('k.*, p.nama_produk, p.stok_produk, p.harga_produk');
        $this->db->from('tb_keranjang k');
        $this->db->join('tb_produk p', 'k.id_produk = p.id_produk');
        
        if ($id_user) {
            $this->db->where('k.id_user', $id_user);
        } elseif ($session_id) {
            $this->db->where('k.session_id', $session_id);
        }
        
        return $this->db->get()->result_array();
    }

    public function count_keranjang($id_user = null, $session_id = null) {
        if ($id_user) {
            $this->db->where('id_user', $id_user);
        } elseif ($session_id) {
            $this->db->where('session_id', $session_id);
        }
        return $this->db->count_all_results('tb_keranjang');
    }

    public function total_harga($id_user = null, $session_id = null) {
        $items = $this->get_keranjang($id_user, $session_id);
        $total = 0;
        foreach ($items as $item) {
            $total += $item['harga_satuan'] * $item['jumlah'];
        }
        return $total;
    }

    public function tambah($data) {
        $this->db->where('id_produk', $data['id_produk']);
        if (!empty($data['id_user'])) {
            $this->db->where('id_user', $data['id_user']);
        } else {
            $this->db->where('session_id', $data['session_id']);
        }
        $cek = $this->db->get('tb_keranjang')->row_array();
        
        if ($cek) {
            $this->db->where('id_keranjang', $cek['id_keranjang']);
            return $this->db->update('tb_keranjang', array(
                'jumlah' => $cek['jumlah'] + $data['jumlah']
            ));
        } else {
            return $this->db->insert('tb_keranjang', $data);
        }
    }

    public function update($id_keranjang, $data) {
        $this->db->where('id_keranjang', $id_keranjang);
        return $this->db->update('tb_keranjang', $data);
    }

    public function hapus($id_keranjang) {
        $this->db->where('id_keranjang', $id_keranjang);
        return $this->db->delete('tb_keranjang');
    }

    public function kosongkan($id_user = null, $session_id = null) {
        if ($id_user) {
            $this->db->where('id_user', $id_user);
        } elseif ($session_id) {
            $this->db->where('session_id', $session_id);
        }
        return $this->db->delete('tb_keranjang');
    }
}
?>