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

    // ============================================================
    // INDEX - DAFTAR TRANSAKSI
    // ============================================================
    public function index() {
        $data['title'] = 'Manajemen Transaksi';
        $data['transaksi'] = $this->Transaksi_model->get_all_transaksi();
        $data['count_pending'] = $this->Transaksi_model->count_by_status('Pending');
        $data['count_diproses'] = $this->Transaksi_model->count_by_status('Diproses');
        $data['count_dikirim'] = $this->Transaksi_model->count_by_status('Dikirim');
        $data['count_selesai'] = $this->Transaksi_model->count_by_status('Selesai');
        
        // LANGSUNG LOAD VIEW TANPA HEADER/SIDEBAR/FOOTER
        $this->load->view('admin/transaksi/index', $data);
    }

    // ============================================================
    // DETAIL TRANSAKSI
    // ============================================================
    public function detail($id_transaksi) {
        $data['title'] = 'Detail Transaksi';
        
        $data['transaksi'] = $this->Transaksi_model->get_transaksi($id_transaksi);
        if (!$data['transaksi']) {
            show_404();
        }
        
        $data['details'] = $this->Transaksi_model->get_detail_transaksi($id_transaksi);
        $data['bukti'] = $this->Transaksi_model->get_bukti_by_transaksi($id_transaksi);
        
        // LANGSUNG LOAD VIEW TANPA HEADER/SIDEBAR/FOOTER
        $this->load->view('admin/transaksi/detail', $data);
    }

    // ============================================================
    // KONFIRMASI BAYAR (M06-F06)
    // ============================================================
    public function konfirmasi_bayar() {
        $id_transaksi = $this->input->post('id_transaksi');
        $status = $this->input->post('status');
        $keterangan = $this->input->post('keterangan');
        
        $this->Transaksi_model->verifikasi_bukti($id_transaksi, $status, $keterangan);
        
        if ($status == 'Diverifikasi') {
            $this->Transaksi_model->update_status_bayar($id_transaksi, 'Lunas');
            $this->Transaksi_model->update_status($id_transaksi, 'Diproses');
            $message = '✅ Pembayaran diverifikasi. Pesanan diproses.';
        } else {
            $this->Transaksi_model->update_status_bayar($id_transaksi, 'Pending');
            $message = '❌ Pembayaran ditolak. Upload ulang bukti.';
        }
        
        $this->session->set_flashdata('success', $message);
        redirect('admin/transaksi/detail/' . $id_transaksi);
    }

    // ============================================================
    // UPDATE STATUS PESANAN (M06-F07)
    // ============================================================
    public function update_status($id_transaksi) {
        $status = $this->input->post('status');
        $valid_status = ['Pending', 'Diproses', 'Dikirim', 'Selesai', 'Dibatalkan'];
        
        if (!in_array($status, $valid_status)) {
            $this->session->set_flashdata('error', 'Status tidak valid');
            redirect('admin/transaksi/detail/' . $id_transaksi);
        }
        
        $this->Transaksi_model->update_status($id_transaksi, $status);
        $this->session->set_flashdata('success', '✅ Status pesanan berhasil diupdate menjadi ' . $status);
        redirect('admin/transaksi/detail/' . $id_transaksi);
    }

    // ============================================================
    // EXPORT EXCEL (CSV)
    // ============================================================
    public function export_excel() {
        $transaksi = $this->Transaksi_model->get_all_transaksi();
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="Laporan_Transaksi_' . date('Y-m-d') . '.csv"');
        
        $output = fopen('php://output', 'w');
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        
        fputcsv($output, ['ID Transaksi', 'Pembeli', 'Total', 'Ongkir', 'Grand Total', 'Status', 'Status Bayar', 'Metode', 'Tanggal']);
        
        foreach ($transaksi as $t) {
            fputcsv($output, [
                $t['id_transaksi'],
                $t['nama_pembeli'] ?? 'Guest',
                $t['total_harga'],
                $t['ongkir'] ?? 0,
                $t['grand_total'],
                $t['status_pesanan'],
                $t['status_bayar'],
                $t['metode_bayar'],
                $t['tanggal_transaksi']
            ]);
        }
        
        fclose($output);
        exit;
    }

    // ============================================================
    // EXPORT PDF
    // ============================================================
    public function export_pdf() {
        $data['transaksi'] = $this->Transaksi_model->get_all_transaksi();
        $data['title'] = 'Laporan Transaksi';
        
        // LANGSUNG LOAD VIEW TANPA HEADER/SIDEBAR/FOOTER
        $this->load->view('admin/transaksi/export_pdf', $data);
    }

    // ============================================================
    // HALAMAN KONFIRMASI BAYAR (dari quick action dashboard)
    // ============================================================
    public function konfirmasi() {
        $data['title'] = 'Konfirmasi Pembayaran';
        $data['transaksi_pending'] = $this->Transaksi_model->get_transaksi_butuh_konfirmasi();
        $data['count_menunggu']    = count($data['transaksi_pending']);
        $data['count_pending']     = $this->Transaksi_model->count_by_status('Pending');
        $data['count_diproses']    = $this->Transaksi_model->count_by_status('Diproses');
        $data['count_dikirim']     = $this->Transaksi_model->count_by_status('Dikirim');
        $data['count_selesai']     = $this->Transaksi_model->count_by_status('Selesai');
        $this->load->view('admin/transaksi/konfirmasi', $data);
    }

    // ============================================================
    // INVOICE (M06-F10)
    // ============================================================
    public function invoice($id_transaksi) {
        $data['transaksi'] = $this->Transaksi_model->get_transaksi($id_transaksi);
        if (!$data['transaksi']) {
            show_404();
        }
        $data['details'] = $this->Transaksi_model->get_detail_transaksi($id_transaksi);
        
        // LANGSUNG LOAD VIEW TANPA HEADER/SIDEBAR/FOOTER
        $this->load->view('admin/transaksi/invoice', $data);
    }
}
?>