<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // CEK LOGIN
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login');
        }

        // CEK ROLE
        $current_role = $this->session->userdata('role');
        if ($current_role != 'Admin') {
            if ($current_role == 'Petani') {
                redirect('petani/dashboard');
            } elseif ($current_role == 'Pembeli') {
                redirect('pembeli/dashboard');
            } elseif ($current_role == 'Kurir') {
                redirect('kurir/tracking');
            } else {
                $this->session->sess_destroy();
                redirect('auth/login');
            }
        }

        $this->load->model('Notifikasi_model');
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_user');

        // ============================================
        // 1. NOTIFIKASI
        // ============================================
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Admin'; // 🔴 UNTUK SOUND

        // ============================================
        // 2. SIDEBAR BADGE - DATA BARU / PENDING
        // ============================================

        // User baru (user yang dibuat hari ini)
        $data['user_baru'] = $this->db
            ->where('DATE(created_at)', date('Y-m-d'))
            ->count_all_results('tb_user');

        // Petani baru (belum diverifikasi)
        $data['petani_baru'] = $this->db
            ->where('role', 'Petani')
            ->where('is_verified', '0')
            ->count_all_results('tb_user');

        // Transaksi pending
        $data['transaksi_pending'] = $this->db
            ->where('status_pesanan', 'Pending')
            ->count_all_results('tb_transaksi');

        // Mitra baru (belum aktif) - cek dulu tabelnya ada
        if ($this->db->table_exists('tb_mitra')) {
            $data['mitra_baru'] = $this->db
                ->where('status_mitra', 'Pending')
                ->count_all_results('tb_mitra');
        } else {
            $data['mitra_baru'] = 0;
        }

        // Total data (untuk info saja, tidak wajib ditampilkan)
        $data['total_users'] = $this->db->count_all('tb_user');
        $data['total_petani'] = $this->db->where('role', 'Petani')->count_all_results('tb_user');
        $data['total_lahan'] = $this->db->count_all('tb_lahan');
        $data['total_panen'] = $this->db->count_all('tb_panen');
        $data['total_produk'] = $this->db->count_all('tb_produk');
        $data['total_transaksi'] = $this->db->count_all('tb_transaksi');

        // Cek tabel kurir dan mitra
        if ($this->db->table_exists('tb_kurir')) {
            $data['total_kurir'] = $this->db->count_all('tb_kurir');
        } else {
            $data['total_kurir'] = 0;
        }

        if ($this->db->table_exists('tb_mitra')) {
            $data['total_mitra'] = $this->db->count_all('tb_mitra');
        } else {
            $data['total_mitra'] = 0;
        }

        // ============================================
        // 3. KPI CARDS
        // ============================================
        $kpi = $this->Notifikasi_model->get_admin_kpi();
        $data['kpi_total_revenue'] = $kpi['total_revenue'] ?? 0;
        $data['kpi_transaksi_aktif'] = $kpi['transaksi_aktif'] ?? 0;
        $data['kpi_petani_terverifikasi'] = $kpi['petani_terverifikasi'] ?? 0;
        $data['kpi_mitra_cafe'] = $kpi['mitra_cafe'] ?? 0;

        // ============================================
        // 4. PETANI BARU
        // ============================================
        $petani_baru = $this->db
            ->where('role', 'Petani')
            ->where('is_verified', '0')
            ->order_by('id_user', 'DESC')
            ->limit(5)
            ->get('tb_user')
            ->result_array();

        $data['petani_baru'] = [];
        if (!empty($petani_baru)) {
            foreach ($petani_baru as $p) {
                $data['petani_baru'][] = [
                    'nama_petani' => $p['nama'] ?? 'Petani',
                    'status_petani' => $p['is_verified'] == '1' ? 'Active' : 'Pending',
                    'tanggal_daftar' => $p['created_at'] ?? date('Y-m-d'),
                ];
            }
        } else {
            // Data dummy jika kosong
            $data['petani_baru'] = [
                ['nama_petani' => 'Budi Santoso', 'status_petani' => 'Active', 'tanggal_daftar' => date('Y-m-d', strtotime('-5 days'))],
                ['nama_petani' => 'Siti Rahayu', 'status_petani' => 'Active', 'tanggal_daftar' => date('Y-m-d', strtotime('-3 days'))],
                ['nama_petani' => 'Ahmad Fauzi', 'status_petani' => 'Pending', 'tanggal_daftar' => date('Y-m-d', strtotime('-2 days'))],
            ];
        }

        // ============================================
        // 5. PESANAN TERBARU
        // ============================================
        $pesanan = $this->db
            ->order_by('id_transaksi', 'DESC')
            ->limit(5)
            ->get('tb_transaksi')
            ->result_array();

        $data['pesanan_terbaru'] = [];
        if (!empty($pesanan)) {
            foreach ($pesanan as $p) {
                $data['pesanan_terbaru'][] = [
                    'id_transaksi' => $p['id_transaksi'] ?? 'INV-0001',
                    'metode_bayar' => $p['metode_bayar'] ?? 'Transfer Bank',
                    'total_harga' => $p['total_harga'] ?? 0,
                    'status_pesanan' => $p['status_pesanan'] ?? 'Pending',
                ];
            }
        } else {
            $data['pesanan_terbaru'] = [];
        }

        // ============================================
        // 6. GRAFIK PENJUALAN
        // ============================================
        $chart = $this->Notifikasi_model->get_sales_chart();
        $data['grafik_penjualan'] = [
            'labels' => $chart['labels'] ?? ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
            'values' => $chart['values'] ?? array_fill(0, 12, 0),
        ];

        // ============================================
        // 7. PRODUK TERLARIS
        // ============================================
        $top = $this->Notifikasi_model->get_top_products(5);
        $data['produk_terlaris'] = !empty($top) ? $top : [
            ['nama' => 'Liberika Grade A', 'total_terjual' => 285, 'pendapatan' => 51300000],
            ['nama' => 'Arabika Specialty', 'total_terjual' => 192, 'pendapatan' => 40320000],
            ['nama' => 'Robusta Grade A', 'total_terjual' => 156, 'pendapatan' => 20280000],
        ];

        // ============================================
        // 8. SETTINGS NOTIFIKASI
        // ============================================
        $data['settings'] = $this->Notifikasi_model->get_settings($id_user);

        // ============================================
        // 9. LOAD VIEW
        // ============================================
        $this->load->view('admin/v_dashboard', $data);
    }

    // ============================================
    // HISTORY NOTIFIKASI
    // ============================================
    public function history()
    {
        $id_user = $this->session->userdata('id_user');
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['history'] = $this->Notifikasi_model->get_all_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Admin';

        $this->load->view('template/v_notif_history', $data);
    }

    // ============================================
    // SETTINGS NOTIFIKASI (M11-F03)
    // ============================================
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
        $data['role'] = 'Admin';

        $this->load->view('template/v_notif_setting', $data);
    }

    // ============================================
    // TANDAI NOTIFIKASI DIBACA & REDIRECT
    // ============================================
    public function read($id_notif)
    {
        $id_user = $this->session->userdata('id_user');

        // 1. Tandai sebagai dibaca
        $this->Notifikasi_model->mark_as_read($id_notif, $id_user);

        // 2. Cek parameter redirect dari URL
        $redirect = $this->input->get('redirect');

        // 3. Jika ada redirect parameter, langsung redirect ke sana
        if (!empty($redirect)) {
            redirect($redirect);
        }

        // 4. Jika tidak ada, ambil link dari database
        $this->db->select('link');
        $this->db->where('id_notifikasi', $id_notif);
        $query = $this->db->get('tb_notifikasi');
        $notif = $query->row_array();

        // 5. Redirect ke link tujuan atau history
        if (!empty($notif['link']) && $notif['link'] != '#') {
            redirect($notif['link']);
        } else {
            $role = $this->session->userdata('role');
            redirect($role . '/dashboard/history');
        }
    }

    // ============================================
    // AJAX - GET NOTIFIKASI (UNTUK SOUND)
    // ============================================
    public function get_notifications_ajax()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id_user = $this->session->userdata('id_user');
        $notifikasi = $this->Notifikasi_model->get_unread_notif($id_user, 5);
        $unread = $this->Notifikasi_model->count_unread($id_user);

        echo json_encode([
            'success' => true,
            'notifikasi' => $notifikasi,
            'unread' => $unread
        ]);
    }

    // ============================================
    // AJAX - MARK ALL READ
    // ============================================
    public function mark_all_read_ajax()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id_user = $this->session->userdata('id_user');
        $result = $this->Notifikasi_model->mark_all_read($id_user);

        echo json_encode(['success' => $result]);
    }

    // ============================================
    // AJAX - GET CHART DATA
    // ============================================
    public function get_chart_data()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $data = $this->Notifikasi_model->get_sales_chart();
        echo json_encode([
            'success' => true,
            'values' => $data['values'] ?? [120, 150, 180, 140, 200, 230, 210, 250, 270, 240, 300, 280]
        ]);
    }
}
