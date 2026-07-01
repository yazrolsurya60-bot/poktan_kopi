<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id_user') || $this->session->userdata('role') != 'Petani') {
            redirect('auth/login');
        }
        $this->load->model('Transaksi_model');
        $this->load->model('Notifikasi_model'); // 🔴 TAMBAHKAN
        $this->load->helper('url');
    }

    public function index() {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Petani';
        
        // Ambil semua produk milik petani ini
        $this->db->where('id_user', $id_user);
        $produk_saya = $this->db->get('tb_produk')->result_array();
        $id_produk_saya = array_column($produk_saya, 'id_produk');
        
        if (empty($id_produk_saya)) {
            $data['transaksi'] = [];
        } else {
            // Ambil transaksi yang mengandung produk petani
            $this->db->select('t.*, u.nama as nama_pembeli');
            $this->db->from('tb_transaksi t');
            $this->db->join('tb_user u', 't.id_user = u.id_user', 'left');
            $this->db->join('tb_detail_transaksi d', 't.id_transaksi = d.id_transaksi');
            $this->db->where_in('d.id_produk', $id_produk_saya);
            $this->db->group_by('t.id_transaksi');
            $this->db->order_by('t.tanggal_transaksi', 'DESC');
            $data['transaksi'] = $this->db->get()->result_array();
        }
        
        $data['title'] = 'Transaksi Produk Saya';
        $this->load->view('petani/transaksi/index', $data);
    }

    public function detail($id_transaksi) {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Petani';
        
        // Cek apakah transaksi ini berisi produk petani
        $this->db->select('d.*');
        $this->db->from('tb_detail_transaksi d');
        $this->db->join('tb_produk p', 'd.id_produk = p.id_produk');
        $this->db->where('d.id_transaksi', $id_transaksi);
        $this->db->where('p.id_user', $id_user);
        $detail = $this->db->get()->result_array();
        
        if (empty($detail)) {
            show_404();
        }
        
        $data['transaksi'] = $this->Transaksi_model->get_transaksi($id_transaksi);
        $data['details'] = $this->Transaksi_model->get_detail_transaksi($id_transaksi);
        $data['title'] = 'Detail Transaksi #' . $id_transaksi;
        
        $this->load->view('petani/transaksi/detail', $data);
    }
}
