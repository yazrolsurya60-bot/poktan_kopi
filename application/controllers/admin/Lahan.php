<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lahan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Lahan_model');
        $this->load->helper('text');
    }

    public function index() {
        $filters = [
            'status_lahan' => $this->input->get('status_lahan'),
            'lokasi' => $this->input->get('lokasi')
        ];

        $data['title'] = "Panel Admin: Data Lahan Kopi";
        // Menggunakan get_all_lahan() dengan parameter null agar admin bisa memonitor seluruh petani
        $data['lahan'] = $this->Lahan_model->get_all_lahan(null, $filters);

        // Load halaman view admin utama Anda
        $this->load->view('admin/lahan/index', $data);
    }
}