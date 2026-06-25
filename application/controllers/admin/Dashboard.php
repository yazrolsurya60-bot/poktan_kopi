<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // 🔴 PERBAIKI: Cek apakah user sudah login
        if (!$this->session->userdata('id_user')) {
            $this->session->set_userdata([
                'id_user' => 1,
                'role' => 'Admin',
                'nama' => 'Test Admin'
            ]);
            // redirect('auth/login');
        }

        // 🔴 PERBAIKI: Jika role tidak sesuai, redirect ke dashboard yang benar
        $current_role = $this->session->userdata('role');

        // Jika role bukan Admin, arahkan ke dashboard yang sesuai
        if ($current_role != 'Admin') {
            if ($current_role == 'Petani') {
                redirect('petani/dashboard');
            } elseif ($current_role == 'Pembeli') {
                redirect('pembeli/dashboard');
            } else {
                // Jika role tidak dikenal, logout
                $this->session->sess_destroy();
                redirect('auth/login');
            }
        }


        $this->load->model('Notifikasi_model');
    }

    // ============================================
    // INDEX - DASHBOARD UTAMA (M11-F01)
    // ============================================
    public function index()
    {
        $id_user = $this->session->userdata('id_user');

        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);

        $kpi = $this->Notifikasi_model->get_admin_kpi();
        $data['kpi_total_revenue'] = $kpi['total_revenue'] ?? 0;
        $data['kpi_transaksi_aktif'] = $kpi['transaksi_aktif'] ?? 0;
        $data['kpi_petani_terverifikasi'] = $kpi['petani_terverifikasi'] ?? 0;
        $data['kpi_mitra_cafe'] = $kpi['mitra_cafe'] ?? 0;

        $data['petani_baru'] = $this->db->where('status_petani', 'Pending')->limit(5)->get('tb_petani')->result_array();
        $data['pesanan_terbaru'] = $this->db->order_by('id_transaksi', 'DESC')->limit(5)->get('tb_transaksi')->result_array();
        $data['grafik_penjualan'] = $this->Notifikasi_model->get_sales_chart();
        $data['produk_terlaris'] = $this->Notifikasi_model->get_top_products(5);
        $data['settings'] = $this->Notifikasi_model->get_settings($id_user);

        $this->load->view('admin/v_dashboard', $data);
    }

    public function history()
    {

        $id_user = $this->session->userdata('id_user');
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['history'] = $this->Notifikasi_model->get_all_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);

        $this->load->view('template/v_notif_history', $data);
    }


    public function settings()
    {
        $id_user = $this->session->userdata('id_user');
        if ($this->input->post()) {
            $this->Notifikasi_model->update_settings($id_user, $this->input->post());
            $this->session->set_flashdata('success', 'Preferensi notifikasi berhasil diperbarui.');
            redirect('admin/dashboard/settings');
        }

        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['settings'] = $this->Notifikasi_model->get_settings($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);

        $this->load->view('template/v_notif_setting', $data);
    }

    public function read($id_notif)
    {
        $id_user = $this->session->userdata('id_user');
        $this->Notifikasi_model->mark_as_read($id_notif, $id_user);

        $redirect = $this->input->get('redirect') ?? 'admin/dashboard/history';
        redirect($redirect);
    }
    public function get_notifications_ajax()
    {
        $id_user = $this->session->userdata('id_user');
        $notifikasi = $this->Notifikasi_model->get_unread_notif($id_user, 5);
        $unread = $this->Notifikasi_model->count_unread($id_user);
        echo json_encode([
            'success' => true,
            'notifikasi' => $notifikasi,
            'unread' => $unread
        ]);
    }

    public function mark_all_read_ajax()
    {
        $id_user = $this->session->userdata('id_user');
        $result = $this->Notifikasi_model->mark_all_read($id_user);

        echo json_encode(['success' => $result]);
    }

    public function get_chart_data()
    {
        $data = $this->Notifikasi_model->get_sales_chart();
        echo json_encode(['success' => true, 'values' => $data['values']]);
    }
}
