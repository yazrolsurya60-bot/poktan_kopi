<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        if (!$this->session->userdata('id_user') || $this->session->userdata('role') != 'Admin') {
            redirect('auth/login');
        }
        
        $this->load->model('Transaksi_model');
        $this->load->model('Notifikasi_model');
        $this->load->helper('url');
        $this->load->helper('form');
    }

    // ============================================================
    // INDEX - DAFTAR TRANSAKSI
    // ============================================================
    public function index() {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Admin';
        
        $data['title'] = 'Manajemen Transaksi';
        $data['transaksi'] = $this->Transaksi_model->get_all_transaksi_member();
        
        $data['count_pending'] = $this->Transaksi_model->count_by_status('Pending');
        $data['count_diproses'] = $this->Transaksi_model->count_by_status('Diproses');
        $data['count_dikirim'] = $this->Transaksi_model->count_by_status('Dikirim');
        $data['count_selesai'] = $this->Transaksi_model->count_by_status('Selesai');
        
        $this->load->view('admin/transaksi/index', $data);
    }

    // ============================================================
    // DETAIL TRANSAKSI
    // ============================================================
    public function detail($id_transaksi) {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Admin';
        
        $data['title'] = 'Detail Transaksi';
        
        $data['transaksi'] = $this->Transaksi_model->get_transaksi($id_transaksi);
        if (!$data['transaksi']) {
            show_404();
        }
        
        $data['details'] = $this->Transaksi_model->get_detail_transaksi($id_transaksi);
        $data['bukti'] = $this->Transaksi_model->get_bukti_by_transaksi($id_transaksi);
        
        $this->load->view('admin/transaksi/detail', $data);
    }

    // ============================================================
    // KONFIRMASI BAYAR + NOTIFIKASI
    // ============================================================
    public function konfirmasi_bayar() {
        $id_transaksi = $this->input->post('id_transaksi');
        $status = $this->input->post('status');
        $keterangan = $this->input->post('keterangan');
        
        $this->Transaksi_model->verifikasi_bukti($id_transaksi, $status, $keterangan);
        
        $transaksi = $this->Transaksi_model->get_transaksi($id_transaksi);
        
        if ($status == 'Diverifikasi') {
            $this->Transaksi_model->update_status_bayar($id_transaksi, 'Lunas');
            $this->Transaksi_model->update_status($id_transaksi, 'Diproses');
            $message = '✅ Pembayaran diverifikasi. Pesanan diproses.';
            
            if ($transaksi['id_user']) {
                $this->Notifikasi_model->save_notifikasi([
                    'id_user' => $transaksi['id_user'],
                    'judul' => '✅ Pembayaran Diverifikasi',
                    'isi_notifikasi' => 'Pembayaran untuk pesanan #' . $id_transaksi . ' telah diverifikasi. Pesanan sedang diproses.',
                    'link' => 'pembeli/transaksi/detail/' . $id_transaksi,
                    'icon' => 'success'
                ]);
            }
        } else {
            $this->Transaksi_model->update_status_bayar($id_transaksi, 'Pending');
            $message = '❌ Pembayaran ditolak. Upload ulang bukti.';
            
            if ($transaksi['id_user']) {
                $this->Notifikasi_model->save_notifikasi([
                    'id_user' => $transaksi['id_user'],
                    'judul' => '❌ Pembayaran Ditolak',
                    'isi_notifikasi' => 'Pembayaran untuk pesanan #' . $id_transaksi . ' ditolak. Silakan upload ulang bukti.',
                    'link' => 'pembeli/transaksi/detail/' . $id_transaksi,
                    'icon' => 'danger'
                ]);
            }
        }
        
        $this->session->set_flashdata('success', $message);
        redirect('admin/transaksi/detail/' . $id_transaksi);
    }

    // ============================================================
    // UPDATE STATUS PESANAN + NOTIFIKASI
    // ============================================================
    public function update_status($id_transaksi) {
        $status = $this->input->post('status');
        $valid_status = ['Pending', 'Diproses', 'Dikirim', 'Selesai', 'Dibatalkan'];
        
        if (!in_array($status, $valid_status)) {
            $this->session->set_flashdata('error', 'Status tidak valid');
            redirect('admin/transaksi/detail/' . $id_transaksi);
        }
        
        $this->Transaksi_model->update_status($id_transaksi, $status);
        
        // SINKRONISASI STATUS KE TRACKING PENGIRIMAN
        $this->load->model('Tracking_model');
        $tracking = $this->Tracking_model->get_tracking_by_transaksi($id_transaksi);
        if ($tracking) {
            $tracking_status = null;
            $keterangan = null;
            if ($status == 'Diproses') {
                $tracking_status = 'diproses';
                $keterangan = 'Status diperbarui ke Diproses melalui transaksi.';
            } elseif ($status == 'Dikirim') {
                $tracking_status = 'dikirim';
                $keterangan = 'Status diperbarui ke Dikirim melalui transaksi.';
            } elseif ($status == 'Selesai') {
                $tracking_status = 'diterima';
                $keterangan = 'Pesanan selesai. Status diperbarui ke Diterima.';
            } elseif ($status == 'Dibatalkan') {
                $tracking_status = 'dibatalkan';
                $keterangan = 'Transaksi dibatalkan.';
            }

            if ($tracking_status) {
                $this->db->where('id_transaksi', $id_transaksi)->update('tb_tracking', [
                    'status_pengiriman' => $tracking_status,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                $this->Tracking_model->save_history($tracking->id_tracking, $tracking_status, $keterangan);
            }
        }
        
        $transaksi = $this->Transaksi_model->get_transaksi($id_transaksi);
        if ($transaksi['id_user']) {
            $icon = ($status == 'Selesai') ? 'success' : (($status == 'Dibatalkan') ? 'danger' : 'info');
            $this->Notifikasi_model->save_notifikasi([
                'id_user' => $transaksi['id_user'],
                'judul' => '📦 Status Pesanan Berubah',
                'isi_notifikasi' => 'Pesanan #' . $id_transaksi . ' sekarang: ' . $status,
                'link' => 'pembeli/transaksi/detail/' . $id_transaksi,
                'icon' => $icon
            ]);
        }
        
        $this->session->set_flashdata('success', '✅ Status pesanan berhasil diupdate menjadi ' . $status);
        redirect('admin/transaksi/detail/' . $id_transaksi);
    }

    // ============================================================
    // EXPORT EXCEL
    // ============================================================
    public function export_excel() {
        // 🔴 METHOD INI DOWNLOAD, TIDAK PERLU NOTIFIKASI
        $transaksi = $this->Transaksi_model->get_all_transaksi_member();
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="Laporan_Transaksi_' . date('Y-m-d') . '.csv"');
        
        $output = fopen('php://output', 'w');
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        
        fputcsv($output, ['ID Transaksi', 'Pembeli', 'Total', 'Ongkir', 'Grand Total', 'Status', 'Status Bayar', 'Metode', 'Tanggal']);
        
        foreach ($transaksi as $t) {
            fputcsv($output, [
                $t['id_transaksi'],
                $t['nama_pembeli'] ?? 'Member',
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
        // 🔴 METHOD INI DOWNLOAD, TIDAK PERLU NOTIFIKASI
        $data['transaksi'] = $this->Transaksi_model->get_all_transaksi_member();
        $data['title'] = 'Laporan Transaksi';
        
        $this->load->view('admin/transaksi/export_pdf', $data);
    }

    // ============================================================
    // HALAMAN KONFIRMASI BAYAR (dari quick action dashboard)
    // ============================================================
    public function konfirmasi() {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Admin';
        
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
    // INVOICE
    // ============================================================
    public function invoice($id_transaksi) {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Admin';
        
        $data['transaksi'] = $this->Transaksi_model->get_transaksi($id_transaksi);
        if (!$data['transaksi']) {
            show_404();
        }
        $data['details'] = $this->Transaksi_model->get_detail_transaksi($id_transaksi);
        
        $this->load->view('admin/transaksi/invoice', $data);
    }
}
?>
