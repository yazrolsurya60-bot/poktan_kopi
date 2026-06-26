<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Transaksi_model');
        $this->load->model('Keranjang_model');
        $this->load->model('User_model');
        $this->load->helper('url');
        $this->load->helper('form');
        
        // ============================================
        // GUEST CART - UNTUK USER YANG BELUM LOGIN
        // ============================================
        if (!$this->session->userdata('id_user') && !$this->session->userdata('session_id')) {
            $this->session->set_userdata('session_id', session_id());
        }
    }

    // ==================== KERANJANG ====================
    
    public function keranjang() {
        $data['title'] = 'Keranjang Belanja';
        
        $id_user = $this->session->userdata('id_user');
        $session_id = $this->session->userdata('session_id') ?: session_id();
        
        $data['cart_items'] = $this->Keranjang_model->get_keranjang($id_user, $session_id);
        $data['total_harga'] = $this->Keranjang_model->total_harga($id_user, $session_id);
        $data['total_item'] = $this->Keranjang_model->count_keranjang($id_user, $session_id);
        
        $this->load->view('keranjang/index', $data);
    }

    public function tambah_keranjang() {
        $id_produk = $this->input->post('id_produk');
        $jumlah = $this->input->post('jumlah') ?: 1;
        
        $this->load->model('Produk_model');
        $produk = $this->Produk_model->getById($id_produk);
        
        if (!$produk) {
            echo json_encode(['status' => 'error', 'message' => 'Produk tidak ditemukan']);
            return;
        }
        
        if ($produk->stok_produk < $jumlah) {
            echo json_encode(['status' => 'error', 'message' => 'Stok tidak mencukupi']);
            return;
        }
        
        $data = array(
            'id_user' => $this->session->userdata('id_user'),
            'session_id' => $this->session->userdata('session_id') ?: session_id(),
            'id_produk' => $id_produk,
            'jumlah' => $jumlah,
            'harga_satuan' => $produk->harga
        );
        
        if ($this->Keranjang_model->tambah($data)) {
            $total_item = $this->Keranjang_model->count_keranjang(
                $this->session->userdata('id_user'),
                $this->session->userdata('session_id') ?: session_id()
            );
            echo json_encode(['status' => 'success', 'message' => 'Produk ditambahkan', 'total_item' => $total_item]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan']);
        }
    }

    public function update_keranjang() {
        $id_keranjang = $this->input->post('id_keranjang');
        $jumlah = $this->input->post('jumlah');
        
        if ($jumlah <= 0) {
            $this->Keranjang_model->hapus($id_keranjang);
        } else {
            $this->Keranjang_model->update($id_keranjang, ['jumlah' => $jumlah]);
        }
        
        $id_user = $this->session->userdata('id_user');
        $session_id = $this->session->userdata('session_id') ?: session_id();
        
        echo json_encode([
            'status' => 'success',
            'total_harga' => number_format($this->Keranjang_model->total_harga($id_user, $session_id), 0, ',', '.'),
            'total_item' => $this->Keranjang_model->count_keranjang($id_user, $session_id)
        ]);
    }

    public function hapus_keranjang() {
        $id_keranjang = $this->input->post('id_keranjang');
        $this->Keranjang_model->hapus($id_keranjang);
        
        $id_user = $this->session->userdata('id_user');
        $session_id = $this->session->userdata('session_id') ?: session_id();
        
        echo json_encode([
            'status' => 'success',
            'total_harga' => number_format($this->Keranjang_model->total_harga($id_user, $session_id), 0, ',', '.'),
            'total_item' => $this->Keranjang_model->count_keranjang($id_user, $session_id)
        ]);
    }

    // ==================== CHECKOUT ====================

    public function checkout() {
        $data['title'] = 'Checkout';
        
        $id_user = $this->session->userdata('id_user');
        $session_id = $this->session->userdata('session_id') ?: session_id();
        
        $data['cart_items'] = $this->Keranjang_model->get_keranjang($id_user, $session_id);
        
        if (empty($data['cart_items'])) {
            $this->session->set_flashdata('error', 'Keranjang kosong');
            redirect('transaksi/keranjang');
        }

        // ============================================================
        // GATE VERIFIKASI OTP — wajib lewat sebelum checkout, supaya
        // akun/pesanan bohongan tidak bisa merugikan pemilik (stok
        // kepotong tapi pesanan tidak jelas). Sekali kontak terverifikasi
        // (tersimpan di tb_user.kontak_terverifikasi), user tidak akan
        // ditanya lagi di checkout berikutnya.
        // ============================================================
        $sudah_terverifikasi = $this->session->userdata('otp_verified');
        if (!$sudah_terverifikasi && $id_user) {
            $user_cek = $this->User_model->get_by_id($id_user);
            if ($user_cek && !empty($user_cek['kontak_terverifikasi'])) {
                $sudah_terverifikasi = true;
                $this->session->set_userdata('otp_verified', true);
            }
        }

        if (!$sudah_terverifikasi) {
            $this->session->set_userdata('redirect_after_otp', 'transaksi/checkout');
            redirect('verifikasi');
        }
        
        $data['subtotal'] = $this->Keranjang_model->total_harga($id_user, $session_id);
        $data['user'] = $id_user ? $this->User_model->get_by_id($id_user) : null;
        $data['kota'] = ['Jakarta', 'Bandung', 'Surabaya', 'Yogyakarta', 'Semarang'];
        
        $this->load->view('transaksi/checkout', $data);
    }

    public function hitung_ongkir() {
        $kota_asal = $this->input->post('kota_asal');
        $kota_tujuan = $this->input->post('kota_tujuan');

        $hasil = $this->Transaksi_model->hitung_ongkir_server($kota_asal, $kota_tujuan);

        if ($hasil !== null) {
            echo json_encode([
                'status' => 'success',
                'tarif' => $hasil['tarif'],
                'estimasi' => $hasil['estimasi'],
                'tarif_formatted' => 'Rp ' . number_format($hasil['tarif'], 0, ',', '.')
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Ongkir tidak tersedia untuk rute ini, silakan hubungi admin']);
        }
    }

    public function proses_checkout() {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('nama_penerima', 'Nama Penerima', 'required');
        $this->form_validation->set_rules('alamat_kirim', 'Alamat Kirim', 'required');
        $this->form_validation->set_rules('kota_kirim', 'Kota', 'required');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required');
        $this->form_validation->set_rules('metode_bayar', 'Metode Bayar', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('transaksi/checkout');
        }
        
        $id_user = $this->session->userdata('id_user');
        $session_id = $this->session->userdata('session_id') ?: session_id();
        
        $cart_items = $this->Keranjang_model->get_keranjang($id_user, $session_id);
        
        if (empty($cart_items)) {
            $this->session->set_flashdata('error', 'Keranjang kosong');
            redirect('transaksi/keranjang');
        }
        
        $subtotal = 0;
        foreach ($cart_items as $item) {
            $subtotal += $item['harga_satuan'] * $item['jumlah'];
        }

        // ============================================
        // FIX: GANTI KOTA ASAL JADI JAKARTA
        // ============================================
        $kota_asal = 'Jakarta';  // ← UBAH DARI 'Pontianak' KE 'Jakarta'
        $kota_tujuan = $this->input->post('kota_kirim');
        $hasil_ongkir = $this->Transaksi_model->hitung_ongkir_server($kota_asal, $kota_tujuan);

        if ($hasil_ongkir === null) {
            $this->session->set_flashdata('error', 'Ongkir untuk kota tujuan "' . $kota_tujuan . '" belum tersedia. Silakan pilih kota lain atau hubungi admin.');
            redirect('transaksi/checkout');
        }

        $ongkir = $hasil_ongkir['tarif'];
        $grand_total = $subtotal + $ongkir;

        $data_transaksi = array(
            'id_user'        => $id_user,
            'invoice'        => $this->Transaksi_model->generate_invoice(),
            'total_harga'    => $subtotal,
            'ongkir'         => $ongkir,
            'grand_total'    => $grand_total,
            'nama_penerima'  => $this->input->post('nama_penerima'),
            'alamat_kirim'   => $this->input->post('alamat_kirim'),
            'kota_kirim'     => $this->input->post('kota_kirim'),
            'kode_pos'       => $this->input->post('kode_pos'),
            'no_hp'          => $this->input->post('no_hp'),
            'metode_bayar'   => $this->input->post('metode_bayar'),
            'status_pesanan' => 'Pending',
            'status_bayar'   => 'Pending'
        );

        $this->db->trans_begin();

        $id_transaksi = $this->Transaksi_model->buat_transaksi($data_transaksi);

        if (!$id_transaksi) {
            $this->db->trans_rollback();
            $this->session->set_flashdata('error', 'Gagal membuat transaksi');
            redirect('transaksi/checkout');
        }

        $this->load->model('Produk_model');
        foreach ($cart_items as $item) {
            $subtotal_item = $item['harga_satuan'] * $item['jumlah'];
            $this->Transaksi_model->tambah_detail(array(
                'id_transaksi' => $id_transaksi,
                'id_produk' => $item['id_produk'],
                'jumlah' => $item['jumlah'],
                'harga_satuan' => $item['harga_satuan'],
                'subtotal' => $subtotal_item
            ));

            $this->Produk_model->kurangi_stok($item['id_produk'], $item['jumlah']);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->session->set_flashdata('error', 'Gagal menyimpan detail transaksi, silakan coba lagi');
            redirect('transaksi/checkout');
        }

        $this->db->trans_commit();

        $this->Keranjang_model->kosongkan($id_user, $session_id);
        
        $this->session->set_flashdata('success', 'Transaksi berhasil!');
        redirect('transaksi/detail/' . $id_transaksi);
    }

    public function detail($id_transaksi) {
        $data['title'] = 'Detail Transaksi';
        
        $data['transaksi'] = $this->Transaksi_model->get_transaksi($id_transaksi);
        if (!$data['transaksi']) {
            show_404();
        }
        
        $data['details'] = $this->Transaksi_model->get_detail_transaksi($id_transaksi);
        $data['bukti'] = $this->Transaksi_model->get_bukti_by_transaksi($id_transaksi);
        
        $this->load->view('transaksi/detail', $data);
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
            redirect('transaksi/detail/' . $id_transaksi);
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
        redirect('transaksi/detail/' . $id_transaksi);
    }

    public function batalkan($id_transaksi) {
        $transaksi = $this->Transaksi_model->get_transaksi($id_transaksi);
        if (!$transaksi) {
            show_404();
        }
        
        if (!in_array($transaksi['status_pesanan'], ['Pending', 'Diproses'])) {
            $this->session->set_flashdata('error', 'Transaksi tidak bisa dibatalkan');
            redirect('transaksi/detail/' . $id_transaksi);
        }
        
        $alasan = $this->input->post('alasan') ?: 'Dibatalkan oleh pengguna';
        $this->Transaksi_model->update_status($id_transaksi, 'Dibatalkan', ['alasan_batal' => $alasan]);
        $this->Transaksi_model->update_status_bayar($id_transaksi, 'Batal');
        
        $details = $this->Transaksi_model->get_detail_transaksi($id_transaksi);
        $this->load->model('Produk_model');
        foreach ($details as $detail) {
            $this->Produk_model->tambah_stok($detail['id_produk'], $detail['jumlah']);
        }
        
        $this->session->set_flashdata('success', 'Transaksi dibatalkan');
        redirect('transaksi/detail/' . $id_transaksi);
    }

    public function invoice($id_transaksi) {
        $this->load->model('Transaksi_model');
        $data['transaksi'] = $this->Transaksi_model->get_transaksi($id_transaksi);
        if (!$data['transaksi']) {
            show_404();
        }
        $data['details'] = $this->Transaksi_model->get_detail_transaksi($id_transaksi);
        
        $this->load->view('admin/transaksi/invoice', $data);
    }

    public function cart_count() {
        $id_user = $this->session->userdata('id_user');
        $session_id = $this->session->userdata('session_id') ?: session_id();
        $total = $this->Keranjang_model->count_keranjang($id_user, $session_id);
        echo json_encode(['total' => $total]);
    }
}