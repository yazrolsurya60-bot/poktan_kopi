<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mitra_model');
    }

    public function index() {
        // Ambil data mitra yang statusnya Active dan diurutkan berdasarkan urutan_tampil
        $data['mitra_list'] = $this->Mitra_model->get_active_mitra_landing();
        
        $this->load->view('v_landing', $data);
    }

    public function detail($id) {
        $data['mitra'] = $this->Mitra_model->get_by_id($id);
        if (!$data['mitra'] || $data['mitra']['status_mitra'] !== 'Active') {
            show_404();
        }
        $this->load->view('v_landing_detail', $data);
    }
}
