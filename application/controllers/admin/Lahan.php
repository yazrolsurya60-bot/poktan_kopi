<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lahan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Lahan_model');
        $this->load->library('session');

        // Proteksi: Pastikan hanya Admin yang bisa masuk ke sini [cite: 74]
        if ($this->session->userdata('role') !== 'Admin') {
            redirect('auth');
        }
    }

    // Admin hanya memiliki hak akses VIEW untuk memonitor semua lahan petani kelompok tani [cite: 74]
    public function index() {
        $filter = [
            'status_lahan' => $this->input->get('status_lahan'),
            'lokasi'       => $this->input->get('lokasi')
        ];

        $data['title'] = "Monitoring Lahan Poktan";
        // Mengirimkan nilai null pada parameter pertama agar model menarik data semua petani [cite: 74]
        $data['lahan'] = $this->Lahan_model->get_all_lahan(null, $filter);
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/lahan/index', $data); // Mengarah ke view admin khusus monitor
        $this->load->view('templates/footer');
    }
}