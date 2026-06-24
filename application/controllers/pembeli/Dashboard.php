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
        
<<<<<<< HEAD
        if (!$this->session->userdata('id_user')) {
            $this->session->set_userdata([
                'id_user' => 3,
                'role' => 'Pembeli',
                'nama' => 'Test Pembeli'
            ]);
            // redirect('auth/login');
=======
        // Jika belum login, redirect ke halaman login
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login');
>>>>>>> 433eb8e300ef0f8efe1ca5225c15c9218cf570ab
        }

        // ============================================
        // 🔴 VALIDASI ROLE - HANYA PEMBELI YANG BISA AKSES
        // ============================================
        
        $current_role = $this->session->userdata('role');
        
        // Jika role bukan Pembeli, redirect ke dashboard yang sesuai
        if ($current_role != 'Pembeli') {
            if ($current_role == 'Admin') {
                redirect('admin/dashboard');
            } elseif ($current_role == 'Petani') {
                redirect('petani/dashboard');
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
    // INDEX - DASHBOARD UTAMA PEMBELI (M11-F01)
    // ============================================
    
    public function index()
    {
        // Ambil id_user dari session (dari Modul 1)
        $id_user = $this->session->userdata('id_user');

        // Data Notifikasi (M11-F01)
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);

        // Data KPI Pembeli
        $kpi = $this->Notifikasi_model->get_pembeli_kpi($id_user);
        $data['kpi_poin'] = $kpi['poin'] ?? 0;
        $data['kpi_level'] = $this->get_level($data['kpi_poin']);
        $data['kpi_level_class'] = $this->get_level_class($data['kpi_poin']);
        $data['kpi_total_transaksi'] = $kpi['total_transaksi'] ?? 0;
        $data['kpi_total_belanja'] = $kpi['total_belanja'] ?? 0;
        $data['kpi_pesanan_dikirim'] = $kpi['pesanan_dikirim'] ?? 0;

        // Data Pesanan Terbaru
        // 🔴 NOTE: Karena tb_transaksi belum punya id_user, tampilkan semua
        $data['pesanan_terbaru'] = $this->db->order_by('id_transaksi', 'DESC')
            ->limit(5)
            ->get('tb_transaksi')
            ->result_array();

        // Data Rekomendasi Produk
        $data['rekomendasi_produk'] = $this->Notifikasi_model->get_recommendations($id_user, 4);

        // Data Grafik Belanja
        $data['grafik_belanja'] = $this->Notifikasi_model->get_shopping_chart($id_user);

        // Load View
        $this->load->view('pembeli/v_dashboard', $data);
    }

    // ============================================
    // FUNGSI LEVEL MEMBER
    // ============================================
    
    private function get_level($poin)
    {
        if ($poin >= 10000) return 'Platinum';
        if ($poin >= 5000) return 'Gold';
        if ($poin >= 2000) return 'Silver';
        return 'Bronze';
    }

    private function get_level_class($poin)
    {
        if ($poin >= 10000) return 'platinum';
        if ($poin >= 5000) return 'gold';
        if ($poin >= 2000) return 'silver';
        return 'bronze';
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
            redirect('pembeli/dashboard/settings');
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
        redirect('pembeli/dashboard/history');
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
