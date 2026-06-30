<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keranjang_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Ambil semua item keranjang milik user/session
     */
    public function get_keranjang($id_user = null, $session_id = null) {
        $this->db->select('k.*, p.nama_produk, p.foto_utama as foto_produk, p.stok_produk, p.harga as harga_produk, u.nama as nama_petani');
        $this->db->from('tb_keranjang k');
        $this->db->join('tb_produk p', 'k.id_produk = p.id_produk', 'left');
        $this->db->join('tb_user u', 'p.id_user = u.id_user', 'left');

        if ($id_user) {
            $this->db->where('k.id_user', $id_user);
        } else {
            $this->db->where('k.session_id', $session_id);
            $this->db->where('k.id_user IS NULL');
        }

        return $this->db->get()->result_array();
    }

    /**
     * Tambah item ke keranjang (atau update jumlah jika sudah ada)
     */
    public function tambah($data) {
        // 🔥 CEK: Pastikan harga_satuan diisi dari produk
        if (!isset($data['harga_satuan']) || $data['harga_satuan'] <= 0) {
            // Ambil harga dari database jika tidak ada
            $this->db->where('id_produk', $data['id_produk']);
            $produk = $this->db->get('tb_produk')->row_array();
            if ($produk) {
                $data['harga_satuan'] = $produk['harga'];
            }
        }

        // Cek apakah produk sudah ada di keranjang
        $this->db->where('id_produk', $data['id_produk']);

        if (!empty($data['id_user'])) {
            $this->db->where('id_user', $data['id_user']);
        } else {
            $this->db->where('session_id', $data['session_id']);
            $this->db->where('id_user IS NULL');
        }

        $existing = $this->db->get('tb_keranjang')->row_array();

        if ($existing) {
            // Update jumlah
            $new_qty = $existing['jumlah'] + $data['jumlah'];
            $this->db->where('id_keranjang', $existing['id_keranjang']);
            return $this->db->update('tb_keranjang', ['jumlah' => $new_qty]);
        } else {
            // Insert baru
            return $this->db->insert('tb_keranjang', $data);
        }
    }

    /**
     * Update jumlah item di keranjang
     */
    public function update($id_keranjang, $data) {
        $this->db->where('id_keranjang', $id_keranjang);
        return $this->db->update('tb_keranjang', $data);
    }

    /**
     * Hapus satu item dari keranjang
     */
    public function hapus($id_keranjang) {
        $this->db->where('id_keranjang', $id_keranjang);
        return $this->db->delete('tb_keranjang');
    }

    /**
     * Kosongkan semua keranjang milik user/session (setelah checkout)
     */
    public function kosongkan($id_user = null, $session_id = null) {
        if ($id_user) {
            $this->db->where('id_user', $id_user);
        } else {
            $this->db->where('session_id', $session_id);
            $this->db->where('id_user IS NULL');
        }
        return $this->db->delete('tb_keranjang');
    }

    /**
     * 🔥 FIX: Hitung total harga semua item di keranjang
     * PAKAI harga_satuan dari keranjang (bukan dari produk)
     */
    public function total_harga($id_user = null, $session_id = null) {
        $this->db->select_sum('(jumlah * harga_satuan)', 'total');
        $this->db->from('tb_keranjang');

        if ($id_user) {
            $this->db->where('id_user', $id_user);
        } else {
            $this->db->where('session_id', $session_id);
            $this->db->where('id_user IS NULL');
        }

        $result = $this->db->get()->row();
        return $result ? (int) $result->total : 0;
    }

    /**
     * Hitung jumlah item (baris) di keranjang
     */
    public function count_keranjang($id_user = null, $session_id = null) {
        if ($id_user) {
            $this->db->where('id_user', $id_user);
        } else {
            $this->db->where('session_id', $session_id);
            $this->db->where('id_user IS NULL');
        }
        return $this->db->count_all_results('tb_keranjang');
    }

    /**
     * Pindahkan keranjang guest ke akun user setelah login
     */
    public function merge_guest_to_user($session_id, $id_user) {
        // Ambil keranjang guest
        $guest_items = $this->db
            ->where('session_id', $session_id)
            ->where('id_user IS NULL')
            ->get('tb_keranjang')
            ->result_array();

        foreach ($guest_items as $item) {
            // Cek apakah produk sudah ada di keranjang user
            $existing = $this->db
                ->where('id_user', $id_user)
                ->where('id_produk', $item['id_produk'])
                ->get('tb_keranjang')
                ->row_array();

            if ($existing) {
                // Gabungkan jumlah
                $this->db->where('id_keranjang', $existing['id_keranjang']);
                $this->db->update('tb_keranjang', [
                    'jumlah' => $existing['jumlah'] + $item['jumlah']
                ]);
                // Hapus item guest
                $this->db->where('id_keranjang', $item['id_keranjang']);
                $this->db->delete('tb_keranjang');
            } else {
                // 🔥 FIX: Pastikan harga_satuan diambil dari produk
                $this->db->where('id_produk', $item['id_produk']);
                $produk = $this->db->get('tb_produk')->row_array();
                $harga_satuan = $produk ? $produk['harga'] : $item['harga_satuan'];
                
                // Assign ke user
                $this->db->where('id_keranjang', $item['id_keranjang']);
                $this->db->update('tb_keranjang', [
                    'id_user'      => $id_user,
                    'session_id'   => null,
                    'harga_satuan' => $harga_satuan
                ]);
            }
        }
    }
}
?>