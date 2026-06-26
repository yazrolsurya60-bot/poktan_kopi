<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login');
        }
        $this->load->model('Transaksi_model');
        $this->load->model('Panen_model');
        $this->load->model('Notifikasi_model');
        $this->load->model('Produk_model');
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
        $data['total_diproses'] = 0;
        $data['total_dikirim'] = 0;
        $data['total_menunggu_pembayaran'] = 0;
        
        foreach ($data['transaksi'] as $t) {
            $status = $t['status_pesanan'] ?? 'Pending';
            switch ($status) {
                case 'Selesai':
                case 'Complete':
                    $data['total_selesai']++;
                    break;
                case 'Pending':
                    $data['total_pending']++;
                    break;
                case 'Dibatalkan':
                case 'Cancelled':
                    $data['total_batal']++;
                    break;
                case 'Diproses':
                case 'Processing':
                    $data['total_diproses']++;
                    break;
                case 'Dikirim':
                case 'Shipped':
                    $data['total_dikirim']++;
                    break;
                case 'Menunggu Pembayaran':
                    $data['total_menunggu_pembayaran']++;
                    break;
            }
        }
        
        $this->load->view('pembeli/transaksi/history', $data);
    }

    public function detail($id_transaksi) {
        $data['title'] = 'Detail Transaksi';
        
        // Ambil data transaksi
        $data['transaksi'] = $this->Transaksi_model->get_transaksi($id_transaksi);
        
        if (!$data['transaksi']) {
            show_404();
        }
        
        $id_user = $data['transaksi']['id_user'] ?? null;
        if ($id_user != $this->session->userdata('id_user')) {
            show_404();
        }
        
        // ============================================
        // FIX: HITUNG ULANG SEMUA TOTAL DARI DETAIL
        // ============================================
        $data['details'] = $this->Transaksi_model->get_detail_transaksi($id_transaksi);
        if (!is_array($data['details'])) {
            $data['details'] = [];
        }
        
        // Hitung ulang total dari detail produk
        $total_dari_detail = 0;
        foreach ($data['details'] as &$detail) {
            // Hitung subtotal per item
            $harga_satuan = floatval($detail['harga_satuan'] ?? 0);
            $jumlah = intval($detail['jumlah'] ?? 0);
            $subtotal = $harga_satuan * $jumlah;
            $detail['subtotal'] = $subtotal;
            $total_dari_detail += $subtotal;
        }
        
        // Ambil ongkir dari database atau default 0
        $ongkir = floatval($data['transaksi']['ongkir'] ?? 0);
        
        // ============================================
        // REKALKULASI TOTAL - PAKAI YANG DARI DETAIL
        // ============================================
        // Jika total dari detail > 0, gunakan itu (lebih akurat)
        if ($total_dari_detail > 0) {
            $data['transaksi']['total_harga'] = $total_dari_detail;
        } else {
            // Fallback ke data dari database
            $data['transaksi']['total_harga'] = floatval($data['transaksi']['total_harga'] ?? 0);
        }
        
        // Hitung ulang grand total
        $data['transaksi']['grand_total'] = $data['transaksi']['total_harga'] + $ongkir;
        
        // ============================================
        // DEBUG: Log untuk melihat data sebenarnya
        // ============================================
        log_message('debug', '=== DETAIL TRANSAKSI #' . $id_transaksi . ' ===');
        log_message('debug', 'Total dari detail: ' . $total_dari_detail);
        log_message('debug', 'Ongkir: ' . $ongkir);
        log_message('debug', 'Total_harga dari DB: ' . ($data['transaksi']['total_harga'] ?? 0));
        log_message('debug', 'Grand Total hasil: ' . $data['transaksi']['grand_total']);
        log_message('debug', 'Jumlah detail: ' . count($data['details']));
        
        // ============================================
        // SET DEFAULT VALUES UNTUK VIEW
        // ============================================
        $data['transaksi']['status_pesanan'] = $data['transaksi']['status_pesanan'] ?? 'Pending';
        $data['transaksi']['status_bayar'] = $data['transaksi']['status_bayar'] ?? 'Belum Bayar';
        $data['transaksi']['metode_bayar'] = $data['transaksi']['metode_bayar'] ?? '-';
        $data['transaksi']['alamat_kirim'] = $data['transaksi']['alamat_kirim'] ?? '-';
        $data['transaksi']['kota_kirim'] = $data['transaksi']['kota_kirim'] ?? '-';
        $data['transaksi']['kode_pos'] = $data['transaksi']['kode_pos'] ?? '-';
        $data['transaksi']['ongkir'] = $ongkir;
        
        $data['bukti'] = $this->Transaksi_model->get_bukti_by_transaksi($id_transaksi);
        if (empty($data['bukti'])) {
            $data['bukti'] = null;
        }
        
        $this->load->view('pembeli/transaksi/detail', $data);
    }

    public function invoice($id_transaksi) {
        $data['title'] = 'Invoice';
        
        $data['transaksi'] = $this->Transaksi_model->get_transaksi($id_transaksi);
        if (!$data['transaksi']) {
            show_404();
        }
        
        $id_user = $data['transaksi']['id_user'] ?? null;
        if ($id_user != $this->session->userdata('id_user')) {
            show_404();
        }
        
        // ============================================
        // FIX: HITUNG ULANG TOTAL DARI DETAIL
        // ============================================
        $data['details'] = $this->Transaksi_model->get_detail_transaksi($id_transaksi);
        if (!is_array($data['details'])) {
            $data['details'] = [];
        }
        
        // Hitung ulang semua total
        $total_dari_detail = 0;
        foreach ($data['details'] as &$detail) {
            $harga_satuan = floatval($detail['harga_satuan'] ?? 0);
            $jumlah = intval($detail['jumlah'] ?? 0);
            $subtotal = $harga_satuan * $jumlah;
            $detail['subtotal'] = $subtotal;
            $total_dari_detail += $subtotal;
        }
        
        $ongkir = floatval($data['transaksi']['ongkir'] ?? 0);
        
        // Gunakan total dari detail
        if ($total_dari_detail > 0) {
            $data['transaksi']['total_harga'] = $total_dari_detail;
        } else {
            $data['transaksi']['total_harga'] = floatval($data['transaksi']['total_harga'] ?? 0);
        }
        
        $data['transaksi']['grand_total'] = $data['transaksi']['total_harga'] + $ongkir;
        $data['transaksi']['ongkir'] = $ongkir;
        
        // ============================================
        // SET DEFAULT VALUES
        // ============================================
        $data['transaksi']['status_pesanan'] = $data['transaksi']['status_pesanan'] ?? 'Pending';
        $data['transaksi']['status_bayar'] = $data['transaksi']['status_bayar'] ?? 'Belum Bayar';
        $data['transaksi']['metode_bayar'] = $data['transaksi']['metode_bayar'] ?? '-';
        $data['transaksi']['alamat_kirim'] = $data['transaksi']['alamat_kirim'] ?? '-';
        $data['transaksi']['kota_kirim'] = $data['transaksi']['kota_kirim'] ?? '-';
        $data['transaksi']['kode_pos'] = $data['transaksi']['kode_pos'] ?? '-';
        $data['transaksi']['nama_pembeli'] = $data['transaksi']['nama_pembeli'] ?? 'Guest';
        $data['transaksi']['id_transaksi'] = $data['transaksi']['id_transaksi'] ?? $id_transaksi;
        $data['transaksi']['tanggal_transaksi'] = $data['transaksi']['tanggal_transaksi'] ?? date('Y-m-d H:i:s');
        
        // ============================================
        // DEBUG LOG
        // ============================================
        log_message('debug', '=== INVOICE #' . $id_transaksi . ' ===');
        log_message('debug', 'Total dari detail: ' . $total_dari_detail);
        log_message('debug', 'Ongkir: ' . $ongkir);
        log_message('debug', 'Grand Total: ' . $data['transaksi']['grand_total']);
        
        $this->load->view('pembeli/transaksi/invoice', $data);
    }

    public function batalkan($id_transaksi) {
        $transaksi = $this->Transaksi_model->get_transaksi($id_transaksi);
        if (!$transaksi) {
            show_404();
        }
        
        $id_user = $transaksi['id_user'] ?? null;
        if ($id_user != $this->session->userdata('id_user')) {
            show_404();
        }
        
        $status_pesanan = $transaksi['status_pesanan'] ?? 'Pending';
        $statuses_boleh_batal = ['Pending', 'Diproses', 'Menunggu Pembayaran'];
        
        if (!in_array($status_pesanan, $statuses_boleh_batal)) {
            $this->session->set_flashdata('error', '❌ Transaksi tidak bisa dibatalkan karena status sudah ' . $status_pesanan);
            redirect('pembeli/transaksi/detail/' . $id_transaksi);
        }
        
        $alasan = trim($this->input->post('alasan'));
        if (empty($alasan)) {
            $alasan = 'Dibatalkan oleh pembeli';
        }
        
        $update_data = [
            'status_pesanan' => 'Dibatalkan',
            'alasan_batal' => $alasan,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $this->Transaksi_model->update_status($id_transaksi, 'Dibatalkan', $update_data);
        $this->Transaksi_model->update_status_bayar($id_transaksi, 'Batal');
        
        $details = $this->Transaksi_model->get_detail_transaksi($id_transaksi);
        if (!empty($details) && is_array($details)) {
            $this->load->model('Produk_model');
            foreach ($details as $detail) {
                if (isset($detail['id_produk']) && isset($detail['jumlah'])) {
                    $this->Produk_model->tambah_stok($detail['id_produk'], $detail['jumlah']);
                }
            }
        }
        
        $this->Notifikasi_model->save_notifikasi([
            'id_user' => $this->session->userdata('id_user'),
            'judul' => '❌ Pesanan Dibatalkan',
            'isi_notifikasi' => 'Pesanan #' . $id_transaksi . ' telah dibatalkan.',
            'link' => 'pembeli/transaksi/detail/' . $id_transaksi,
            'icon' => 'danger'
        ]);
        
        $this->Notifikasi_model->save_notifikasi([
            'id_user' => 1,
            'judul' => '📝 Pesanan Dibatalkan',
            'isi_notifikasi' => 'Pesanan #' . $id_transaksi . ' dibatalkan oleh pembeli. Alasan: ' . $alasan,
            'link' => 'admin/transaksi/detail/' . $id_transaksi,
            'icon' => 'warning'
        ]);
        
        $this->session->set_flashdata('success', '✅ Transaksi berhasil dibatalkan');
        redirect('pembeli/transaksi/history');
    }

    public function upload_bukti() {
        $id_transaksi = $this->input->post('id_transaksi');
        
        if (empty($id_transaksi)) {
            $this->session->set_flashdata('error', '❌ ID transaksi tidak valid');
            redirect('pembeli/transaksi/history');
        }
        
        $transaksi = $this->Transaksi_model->get_transaksi($id_transaksi);
        if (!$transaksi) {
            show_404();
        }
        
        $id_user = $transaksi['id_user'] ?? null;
        if ($id_user != $this->session->userdata('id_user')) {
            show_404();
        }
        
        $status_pesanan = $transaksi['status_pesanan'] ?? 'Pending';
        $status_bayar = $transaksi['status_bayar'] ?? 'Belum Bayar';
        
        if (!in_array($status_pesanan, ['Pending', 'Diproses', 'Menunggu Pembayaran'])) {
            $this->session->set_flashdata('error', '❌ Transaksi sudah ' . $status_pesanan . ', tidak bisa upload bukti');
            redirect('pembeli/transaksi/detail/' . $id_transaksi);
        }
        
        if ($status_bayar == 'Lunas') {
            $this->session->set_flashdata('error', '❌ Transaksi sudah lunas');
            redirect('pembeli/transaksi/detail/' . $id_transaksi);
        }
        
        $bukti_existing = $this->Transaksi_model->get_bukti_by_transaksi($id_transaksi);
        if (!empty($bukti_existing) && ($bukti_existing['status_verifikasi'] ?? '') == 'Pending') {
            $this->session->set_flashdata('error', '❌ Bukti sedang menunggu verifikasi');
            redirect('pembeli/transaksi/detail/' . $id_transaksi);
        }
        
        $config['upload_path'] = './uploads/bukti/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size'] = 2048;
        $config['max_width'] = 4000;
        $config['max_height'] = 4000;
        $config['encrypt_name'] = TRUE;
        $config['remove_spaces'] = TRUE;
        
        if (!is_dir('./uploads/bukti/')) {
            mkdir('./uploads/bukti/', 0777, TRUE);
        }
        
        $this->load->library('upload', $config);
        
        if (empty($_FILES['file_bukti']['name'])) {
            $this->session->set_flashdata('error', '❌ Silakan pilih file bukti');
            redirect('pembeli/transaksi/detail/' . $id_transaksi);
        }
        
        if (!$this->upload->do_upload('file_bukti')) {
            $error_msg = $this->upload->display_errors('', '');
            $this->session->set_flashdata('error', '❌ Upload gagal: ' . $error_msg);
            redirect('pembeli/transaksi/detail/' . $id_transaksi);
        }
        
        $upload_data = $this->upload->data();
        $file_name = $upload_data['file_name'];
        
        $nama_bank = trim($this->input->post('nama_bank'));
        $nama_pengirim = trim($this->input->post('nama_pengirim'));
        $tanggal_transfer = $this->input->post('tanggal_transfer');
        $jumlah_transfer = (float) $this->input->post('jumlah_transfer');
        
        if (empty($nama_bank) || empty($nama_pengirim) || empty($tanggal_transfer) || $jumlah_transfer <= 0) {
            if (file_exists('./uploads/bukti/' . $file_name)) {
                unlink('./uploads/bukti/' . $file_name);
            }
            $this->session->set_flashdata('error', '❌ Semua field harus diisi dengan benar');
            redirect('pembeli/transaksi/detail/' . $id_transaksi);
        }
        
        $data_bukti = array(
            'id_transaksi' => $id_transaksi,
            'nama_bank' => $nama_bank,
            'nama_pengirim' => $nama_pengirim,
            'tanggal_transfer' => $tanggal_transfer,
            'jumlah_transfer' => $jumlah_transfer,
            'file_bukti' => $file_name,
            'status_verifikasi' => 'Pending',
            'created_at' => date('Y-m-d H:i:s')
        );
        
        if (!empty($bukti_existing) && ($bukti_existing['status_verifikasi'] ?? '') == 'Ditolak') {
            $this->Transaksi_model->update_bukti($id_transaksi, $data_bukti);
        } else {
            $this->Transaksi_model->upload_bukti($data_bukti);
        }
        
        $this->Transaksi_model->update_status_bayar($id_transaksi, 'Pending');
        
        $this->Notifikasi_model->save_notifikasi([
            'id_user' => 1,
            'judul' => '📷 Bukti Pembayaran Baru',
            'isi_notifikasi' => 'Pembeli ' . ($transaksi['nama_pembeli'] ?? 'User') . ' mengupload bukti untuk transaksi #' . $id_transaksi,
            'link' => 'admin/transaksi/detail/' . $id_transaksi,
            'icon' => 'success'
        ]);
        
        $this->session->set_flashdata('success', '✅ Bukti pembayaran berhasil diupload');
        redirect('pembeli/transaksi/detail/' . $id_transaksi);
    }
}