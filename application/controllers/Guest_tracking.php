<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guest_tracking extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Transaksi_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    
    public function index() {
        $data['title'] = 'Cek Status Pesanan';
        $this->load->view('guest/tracking_form', $data);
    }
    
    public function cek() {
        $this->form_validation->set_rules('invoice', 'Invoice', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('guest/tracking');
        }
        
        $invoice = $this->input->post('invoice');
        $email = $this->input->post('email');
        
        $transaksi = $this->Transaksi_model->get_guest_transaksi($invoice, $email);
        
        if (!$transaksi) {
            $this->session->set_flashdata('error', '❌ Pesanan tidak ditemukan. Cek kembali Invoice dan Email.');
            redirect('guest/tracking');
        }
        
        redirect('guest/tracking/detail/' . $transaksi['id_transaksi']);
    }
    
    public function detail($id_transaksi) {
        $data['transaksi'] = $this->Transaksi_model->get_transaksi($id_transaksi);
        
        // Validasi: pastikan ini transaksi GUEST (id_user NULL)
        if (!$data['transaksi'] || $data['transaksi']['id_user'] !== null) {
            show_404();
        }
        
        $data['details'] = $this->Transaksi_model->get_detail_transaksi($id_transaksi);
        $data['title'] = 'Detail Pesanan #' . $id_transaksi;
        
        $this->load->view('guest/tracking_detail', $data);
    }
}