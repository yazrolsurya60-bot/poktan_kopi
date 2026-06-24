<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login');
        }
        $this->load->model('Transaksi_model');
        $this->load->helper('url');
        $this->load->helper('form');
    }

    public function index() {
        redirect('pembeli/transaksi/history');
    }

    public function history() {
        $data['title'] = 'Riwayat Transaksi';
        $id_user = $this->session->userdata('id_user');
        $data['transaksi'] = $this->Transaksi_model->get_transaksi_by_user($id_user);
        
        $data['total_transaksi'] = count($data['transaksi']);
        $data['total_selesai'] = 0;
        $data['total_pending'] = 0;
        $data['total_batal'] = 0;
        
        foreach ($data['transaksi'] as $t) {
            if ($t['status_pesanan'] == 'Selesai') $data['total_selesai']++;
            elseif ($t['status_pesanan'] == 'Pending') $data['total_pending']++;
            elseif ($t['status_pesanan'] == 'Dibatalkan') $data['total_batal']++;
        }
        
        $this->load->view('pembeli/transaksi/history', $data);
    }

    public function detail($id_transaksi) {
        $data['title'] = 'Detail Transaksi';
        
        $data['transaksi'] = $this->Transaksi_model->get_transaksi($id_transaksi);
        if (!$data['transaksi'] || $data['transaksi']['id_user'] != $this->session->userdata('id_user')) {
            show_404();
        }
        
        $data['details'] = $this->Transaksi_model->get_detail_transaksi($id_transaksi);
        $data['bukti'] = $this->Transaksi_model->get_bukti_by_transaksi($id_transaksi);
        
        $this->load->view('pembeli/transaksi/detail', $data);
    }

    public function batalkan($id_transaksi) {
        $transaksi = $this->Transaksi_model->get_transaksi($id_transaksi);
        if (!$transaksi || $transaksi['id_user'] != $this->session->userdata('id_user')) {
            show_404();
        }
        
        if (!in_array($transaksi['status_pesanan'], ['Pending', 'Diproses'])) {
            $this->session->set_flashdata('error', 'Transaksi tidak bisa dibatalkan');
            redirect('pembeli/transaksi/detail/' . $id_transaksi);
        }
        
        $alasan = $this->input->post('alasan') ?: 'Dibatalkan oleh pembeli';
        $this->Transaksi_model->update_status($id_transaksi, 'Dibatalkan', ['alasan_batal' => $alasan]);
        $this->Transaksi_model->update_status_bayar($id_transaksi, 'Batal');
        
        $details = $this->Transaksi_model->get_detail_transaksi($id_transaksi);
        $this->load->model('Panen_model');
        foreach ($details as $detail) {
            $this->Panen_model->tambah_stok($detail['id_produk'], $detail['jumlah']);
        }
        
        $this->session->set_flashdata('success', 'Transaksi berhasil dibatalkan');
        redirect('pembeli/transaksi/history');
    }

    public function upload_bukti() {
        $id_transaksi = $this->input->post('id_transaksi');
        
        $config['upload_path'] = './uploads/bukti/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = TRUE;
        
        if (!is_dir('./uploads/bukti/')) {
            mkdir('./uploads/bukti/', 0777, TRUE);
        }
        
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload('file_bukti')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('pembeli/transaksi/detail/' . $id_transaksi);
        }
        
        $upload_data = $this->upload->data();
        
        $data_bukti = array(
            'id_transaksi' => $id_transaksi,
            'nama_bank' => $this->input->post('nama_bank'),
            'nama_pengirim' => $this->input->post('nama_pengirim'),
            'tanggal_transfer' => $this->input->post('tanggal_transfer'),
            'jumlah_transfer' => $this->input->post('jumlah_transfer'),
            'file_bukti' => $upload_data['file_name'],
            'status_verifikasi' => 'Pending'
        );
        
        $this->Transaksi_model->upload_bukti($data_bukti);
        $this->Transaksi_model->update_status_bayar($id_transaksi, 'Pending');
        
        $this->session->set_flashdata('success', 'Bukti pembayaran berhasil diupload');
        redirect('pembeli/transaksi/detail/' . $id_transaksi);
    }
}
?>