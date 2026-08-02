<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guest_tracking extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tracking_model');
        $this->load->model('Transaksi_model');
        $this->load->helper('url');
    }

    // ============================================================
    // INDEX - Form cek tracking guest
    // ============================================================
    public function index()
    {
        $data['title'] = 'Cek Status Pesanan';
        $data['error'] = $this->session->flashdata('error');
        $data['success'] = $this->session->flashdata('success');

        $this->load->view('guest/tracking/index', $data);
    }

    // ============================================================
    // CEK - Proses pencarian tracking
    // ============================================================
    public function cek()
    {
        $invoice = trim($this->input->post('invoice'));
        $email = trim($this->input->post('email'));

        if (empty($invoice) || empty($email)) {
            $this->session->set_flashdata('error', 'Mohon masukkan invoice dan email.');
            redirect('guest/tracking');
        }

        // Cari transaksi berdasarkan invoice dan email
        $transaksi = $this->Transaksi_model->get_guest_transaksi($invoice, $email);

        if (!$transaksi) {
            $this->session->set_flashdata('error', 'Data pesanan tidak ditemukan. Periksa kembali invoice dan email Anda.');
            redirect('guest/tracking');
        }

        // Redirect ke halaman detail tracking
        redirect('guest/tracking/detail/' . $transaksi['id_transaksi']);
    }

    // ============================================================
    // DETAIL - Tampilkan detail tracking
    // ============================================================
    public function detail($id_transaksi)
    {
        $transaksi = $this->Transaksi_model->get_transaksi($id_transaksi);

        if (!$transaksi) {
            $this->session->set_flashdata('error', 'Data pesanan tidak ditemukan.');
            redirect('guest/tracking');
        }

        // Force transaksi to array
        $transaksi = (array) $transaksi;

        // Ambil tracking
        $tracking = $this->Tracking_model->get_tracking_by_id($id_transaksi);
        if (!$tracking) {
            $tracking = (object) [
                'id_tracking' => null,
                'status_pengiriman' => 'pending',
                'estimasi_tiba' => null,
                'tanggal_kirim' => null,
                'tanggal_terima' => null
            ];
        }

        $data['title'] = 'Detail Pesanan - ' . ($transaksi['invoice'] ?? '');
        $data['transaksi'] = $transaksi;
        $data['tracking'] = $tracking;
        $data['status_info'] = $this->Tracking_model->get_status_label($tracking->status_pengiriman ?? 'pending');

        // Ambil history tracking
        $data['history'] = $tracking->id_tracking 
            ? $this->Tracking_model->get_tracking_history($tracking->id_tracking) 
            : [];

        $this->load->view('guest/tracking/detail', $data);
    }
}