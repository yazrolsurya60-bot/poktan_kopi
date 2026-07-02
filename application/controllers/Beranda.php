<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

    public function index() {
        $this->load->database();

        $data['total_petani'] = $this->db->where('role', 'Petani')->count_all_results('tb_user');
        $data['total_mitra'] = $this->db->count_all_results('tb_mitra');
        $data['total_produk'] = $this->db->count_all_results('tb_produk');

        $this->load->view('v_beranda', $data);
    }
}
