<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id_user') || $this->session->userdata('role') != 'Admin') {
            redirect('auth/login');
        }
        $this->load->model('Transaksi_model');
        $this->load->helper('url');
        $this->load->helper('form');
    }

    public function index() {
        $data['title'] = 'Manajemen Transaksi';
        $data['transaksi'] = $this->Transaksi_model->get_all_transaksi();
        $data['count_pending'] = $this->Transaksi_model->count_by_status('Pending');
        $data['count_diproses'] = $this->Transaksi_model->count_by_status('Diproses');
        $data['count_dikirim'] = $this->Transaksi_model->count_by_status('Dikirim');
        $data['count_selesai'] = $this->Transaksi_model->count_by_status('Selesai');
        
        $this->load->view('admin/transaksi/index', $data);
    }

    public function detail($id_transaksi) {
        $data['title'] = 'Detail Transaksi';
        
        $data['transaksi'] = $this->Transaksi_model->get_transaksi($id_transaksi);
        if (!$data['transaksi']) {
            show_404();
        }
        
        $data['details'] = $this->Transaksi_model->get_detail_transaksi($id_transaksi);
        $data['bukti'] = $this->Transaksi_model->get_bukti_by_transaksi($id_transaksi);
        
        $this->load->view('admin/transaksi/detail', $data);
    }

    public function konfirmasi_bayar() {
        $id_transaksi = $this->input->post('id_transaksi');
        $status = $this->input->post('status');
        $keterangan = $this->input->post('keterangan');
        
        $this->Transaksi_model->verifikasi_bukti($id_transaksi, $status, $keterangan);
        
        if ($status == 'Diverifikasi') {
            $this->Transaksi_model->update_status_bayar($id_transaksi, 'Lunas');
            $this->Transaksi_model->update_status($id_transaksi, 'Diproses');
            $message = 'Pembayaran diverifikasi. Pesanan diproses.';
        } else {
            $this->Transaksi_model->update_status_bayar($id_transaksi, 'Pending');
            $message = 'Pembayaran ditolak. Upload ulang bukti.';
        }
        
        $this->session->set_flashdata('success', $message);
        redirect('admin/transaksi/detail/' . $id_transaksi);
    }

    public function update_status($id_transaksi) {
        $status = $this->input->post('status');
        $valid_status = ['Pending', 'Diproses', 'Dikirim', 'Selesai', 'Dibatalkan'];
        
        if (!in_array($status, $valid_status)) {
            $this->session->set_flashdata('error', 'Status tidak valid');
            redirect('admin/transaksi/detail/' . $id_transaksi);
        }
        
        $this->Transaksi_model->update_status($id_transaksi, $status);
        $this->session->set_flashdata('success', 'Status pesanan diupdate');
        redirect('admin/transaksi/detail/' . $id_transaksi);
    }

    // ================================================================
    // EXPORT EXCEL (CSV - Bisa dibuka di Excel, TANPA LIBRARY)
    // ================================================================
    public function export_excel() {
        $transaksi = $this->Transaksi_model->get_all_transaksi();
        
        // Set header untuk download CSV
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="Laporan_Transaksi_' . date('Y-m-d') . '.csv"');
        
        // Buka output
        $output = fopen('php://output', 'w');
        
        // Tambahkan BOM untuk UTF-8 (biar Excel baca dengan benar)
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        
        // Header CSV
        fputcsv($output, array('ID Transaksi', 'Pembeli', 'Total', 'Status Pesanan', 'Status Bayar', 'Metode Bayar', 'Tanggal'));
        
        // Data
        foreach ($transaksi as $t) {
            fputcsv($output, array(
                $t['id_transaksi'],
                $t['nama_pembeli'] ?? 'Guest',
                $t['grand_total'],
                $t['status_pesanan'],
                $t['status_bayar'],
                $t['metode_bayar'],
                $t['tanggal_transaksi']
            ));
        }
        
        fclose($output);
        exit;
    }

    // ================================================================
    // EXPORT PDF (Print to PDF - TANPA LIBRARY)
    // ================================================================
    public function export_pdf() {
        $data['transaksi'] = $this->Transaksi_model->get_all_transaksi();
        $data['title'] = 'Laporan Transaksi';
        
        // Load view untuk print
        $this->load->view('admin/transaksi/export_pdf', $data);
    }

    // ================================================================
    // INVOICE - DIPERBAIKI (path view + admin/)
    // ================================================================
    public function invoice($id_transaksi) {
        $data['transaksi'] = $this->Transaksi_model->get_transaksi($id_transaksi);
        if (!$data['transaksi']) {
            show_404();
        }
        $data['details'] = $this->Transaksi_model->get_detail_transaksi($id_transaksi);
        
        // Perbaikan: tambahkan admin/ karena file ada di admin/transaksi/invoice.php
        $this->load->view('admin/transaksi/invoice', $data);
    }
}
?>