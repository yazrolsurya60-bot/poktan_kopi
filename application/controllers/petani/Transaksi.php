<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id_user') || $this->session->userdata('role') != 'Petani') {
            redirect('auth/login');
        }
        $this->load->model('Transaksi_model');
        $this->load->model('Notifikasi_model');
        $this->load->helper('url');
    }

    public function index() {
        $id_user = $this->session->userdata('id_user');

        // Data untuk Template & Header Page
        $data['title']        = 'Pesanan Masuk - Petani Kopi';
        $data['title_page']   = 'Transaksi Produk Saya';
        $data['subtitle']     = 'Daftar transaksi dari produk yang Anda jual';
        $data['role']         = 'Petani';

        $data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);

        // Ambil semua produk milik petani ini (atau kelompok tani)
        // Jika ingin semua produk kelompok tani, bagian `where` bisa disesuaikan. Berdasarkan kode lama:
        $this->db->where('id_user', $id_user);
        $produk_saya    = $this->db->get('tb_produk')->result_array();
        $id_produk_saya = array_column($produk_saya, 'id_produk');

        if (empty($id_produk_saya)) {
            $data['transaksi'] = [];
        } else {
            $this->db->select('t.*, u.nama as nama_pembeli');
            $this->db->from('tb_transaksi t');
            $this->db->join('tb_user u', 't.id_user = u.id_user', 'inner');
            $this->db->join('tb_detail_transaksi d', 't.id_transaksi = d.id_transaksi');
            $this->db->where_in('d.id_produk', $id_produk_saya);
            $this->db->group_by('t.id_transaksi');
            $this->db->order_by('t.tanggal_transaksi', 'DESC');
            $data['transaksi'] = $this->db->get()->result_array();
        }

        // Load Template Modular
        $this->load->view('templates/petani/header', $data);
        $this->load->view('templates/petani/sidebar', $data);
        $this->load->view('petani/transaksi/index', $data);
        $this->load->view('templates/petani/footer');
    }

    public function detail($id_transaksi) {
        $id_user = $this->session->userdata('id_user');

        $data['title']        = 'Detail Transaksi #' . $id_transaksi . ' - Petani Kopi';
        $data['title_page']   = 'Detail Transaksi #' . $id_transaksi;
        $data['subtitle']     = 'Informasi lengkap pesanan produk Anda';
        $data['role']         = 'Petani';

        $data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);

        // Cek apakah transaksi ini berisi produk milik petani yang login
        $this->db->select('d.*');
        $this->db->from('tb_detail_transaksi d');
        $this->db->join('tb_produk p', 'd.id_produk = p.id_produk');
        $this->db->join('tb_transaksi t', 'd.id_transaksi = t.id_transaksi');
        $this->db->where('d.id_transaksi', $id_transaksi);
        $this->db->where('p.id_user', $id_user);
        $this->db->where('t.id_user IS NOT NULL', null, false);
        $detail = $this->db->get()->result_array();

        if (empty($detail)) {
            show_404();
        }

        $data['transaksi'] = $this->Transaksi_model->get_transaksi($id_transaksi);
        $data['details']   = $this->Transaksi_model->get_detail_transaksi($id_transaksi);

        // Load Template Modular
        $this->load->view('templates/petani/header', $data);
        $this->load->view('templates/petani/sidebar', $data);
        $this->load->view('petani/transaksi/detail', $data);
        $this->load->view('templates/petani/footer');
    }
}
