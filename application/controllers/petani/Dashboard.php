<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // ============================================
        // 🔴 CEK LOGIN - MENGGUNAKAN SESSION DARI MODUL 1
        // ============================================
        
        // Jika belum login, redirect ke halaman login
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login');
        }

        // ============================================
        // 🔴 VALIDASI ROLE - HANYA PETANI YANG BISA AKSES
        // ============================================
        
        $current_role = $this->session->userdata('role');
        
        // Jika role bukan Petani, redirect ke dashboard yang sesuai
        if ($current_role != 'Petani') {
            if ($current_role == 'Admin') {
                redirect('admin/dashboard');
            } elseif ($current_role == 'Pembeli') {
                redirect('pembeli/dashboard');
            } else {
                // Jika role tidak dikenal, logout dan redirect ke login
                $this->session->sess_destroy();
                redirect('auth/login');
            }
        }

        // ============================================
        // 🔴 LOAD MODEL
        // ============================================
        
        $this->load->model('Notifikasi_model');
    }

    // ============================================
    // INDEX - DASHBOARD UTAMA PETANI (M11-F01)
    // ============================================
    
    public function index()
    {
        // Ambil id_user dari session (dari Modul 1)
        $id_user = $this->session->userdata('id_user');

        // Data Notifikasi (M11-F01)
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);

        // Data KPI Petani
        $kpi = $this->Notifikasi_model->get_petani_kpi($id_user);
        $data['kpi_total_panen'] = $kpi['total_panen'] ?? 0;
        $data['kpi_omset_penjualan'] = $kpi['omset_penjualan'] ?? 0;
        $data['kpi_lahan_aktif'] = $kpi['lahan_aktif'] ?? 0;
        $data['kpi_pesanan_masuk'] = $kpi['pesanan_masuk'] ?? 0;

        // Data Pesanan Masuk Terbaru
        // 🔴 NOTE: Karena tb_transaksi belum punya id_user, tampilkan semua
        $data['pesanan_masuk'] = $this->db->order_by('id_transaksi', 'DESC')
            ->limit(5)
            ->get('tb_transaksi')
            ->result_array();

        // Data Notifikasi Stok Menipis
        // 🔴 NOTE: Karena tb_produk belum punya id_user, tampilkan semua
        $data['notif_stok_tipis'] = $this->db->where('stok_produk <', 20)
            ->limit(5)
            ->get('tb_produk')
            ->result_array();

        // Data Grafik Panen
        $data['grafik_panen'] = $this->Notifikasi_model->get_harvest_chart($id_user);

        // Data Produk Terjual
        $data['produk_terjual'] = $this->Notifikasi_model->get_petani_top_products($id_user, 5);

        // Load View
        $this->load->view('petani/v_dashboard', $data);
    }

    // ============================================
    // M11-F02: HISTORY NOTIFIKASI
    // ============================================
    
    public function history()
    {
        $id_user = $this->session->userdata('id_user');
        
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['history'] = $this->Notifikasi_model->get_all_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);

        $this->load->view('template/v_notif_history', $data);
    }

    // ============================================
    // M11-F03: SETTING NOTIFIKASI
    // ============================================
    
    public function settings()
    {
        $id_user = $this->session->userdata('id_user');

        // Proses submit form
        if ($this->input->post()) {
            $this->Notifikasi_model->update_settings($id_user, $this->input->post());
            $this->session->set_flashdata('success', 'Preferensi notifikasi berhasil diperbarui.');
            redirect('petani/dashboard/settings');
        }

        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['settings'] = $this->Notifikasi_model->get_settings($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);

        $this->load->view('template/v_notif_setting', $data);
    }

    // ============================================
    // TANDAI NOTIFIKASI SEBAGAI DIBACA
    // ============================================
    
    public function read($id_notif)
    {
        $id_user = $this->session->userdata('id_user');
        $this->Notifikasi_model->mark_as_read($id_notif, $id_user);
        redirect('petani/dashboard/history');
    }

    // ============================================
    // TANDAI SEMUA NOTIFIKASI DIBACA
    // ============================================
    
    public function mark_all_read()
    {
        $id_user = $this->session->userdata('id_user');
        $this->Notifikasi_model->mark_all_read($id_user);
        redirect($this->session->userdata('role') . '/dashboard/history');
    }
}
