<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('id_user')) {
            redirect('auth/login');
        }

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
        
        // 🔴 CEK APAKAH MODEL PETANI ADA
        if (file_exists(APPPATH . 'models/Petani_model.php')) {
            $this->load->model('Petani_model');
        } else {
            // Jika tidak ada, buat manual
            $this->load->database();
        }
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_user');

        // ============================================
        // 1. NOTIFIKASI
        // ============================================
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Admin';

        // ============================================
        // 2. SIDEBAR BADGE
        // ============================================
        $data['user_baru'] = $this->db
            ->where('DATE(created_at)', date('Y-m-d'))
            ->count_all_results('tb_user');

        // 🔴 PETANI BARU - DARI TB_USER
        $data['petani_baru_count'] = $this->db
            ->where('role', 'Petani')
            ->where('status', 'Pending')
            ->count_all_results('tb_user');

        $data['transaksi_pending'] = $this->db
            ->where('status_pesanan', 'Pending')
            ->count_all_results('tb_transaksi');

        if ($this->db->table_exists('tb_mitra')) {
            $data['mitra_baru'] = $this->db
                ->where('status_mitra', 'Pending')
                ->count_all_results('tb_mitra');
        } else {
            $data['mitra_baru'] = 0;
        }

        // ============================================
        // 3. KPI CARDS
        // ============================================
        $kpi = $this->Notifikasi_model->get_admin_kpi();
        $data['kpi_total_revenue'] = $kpi['total_revenue'] ?? 0;
        $data['kpi_transaksi_aktif'] = $kpi['transaksi_aktif'] ?? 0;
        
        // 🔴 PETANI TERVERIFIKASI - DARI TB_USER
        $data['kpi_petani_terverifikasi'] = $this->db
            ->where('role', 'Petani')
            ->where('status', 'Active')
            ->count_all_results('tb_user');
            
        $data['kpi_mitra_cafe'] = $kpi['mitra_cafe'] ?? 0;

        // ============================================
        // 4. PETANI BARU - REAL DATA DARI tb_user
        // ============================================
        $petani_baru = $this->db
            ->select('id_user, nama, status, created_at, no_hp, email, is_verified')
            ->where('role', 'Petani')
            ->where('status', 'Pending')
            ->order_by('created_at', 'DESC')
            ->limit(5)
            ->get('tb_user')
            ->result_array();
        
        if (!empty($petani_baru)) {
            $data['petani_baru'] = [];
            foreach ($petani_baru as $p) {
                $data['petani_baru'][] = [
                    'id_petani' => $p['id_user'],
                    'nama_petani' => $p['nama'] ?? 'Petani',
                    'status_petani' => $p['status'] ?? 'Pending',
                    'tanggal_daftar' => $p['created_at'] ?? date('Y-m-d'),
                    'no_hp' => $p['no_hp'] ?? '-',
                    'email' => $p['email'] ?? '-',
                    'is_verified' => $p['is_verified'] ?? '0',
                ];
            }
        } else {
            // 🔴 AMBIL SEMUA PETANI (ACTIVE) SEBAGAI FALLBACK
            $petani_aktif = $this->db
                ->select('id_user, nama, status, created_at, no_hp, email, is_verified')
                ->where('role', 'Petani')
                ->where('status', 'Active')
                ->order_by('created_at', 'DESC')
                ->limit(5)
                ->get('tb_user')
                ->result_array();
            
            if (!empty($petani_aktif)) {
                $data['petani_baru'] = [];
                foreach ($petani_aktif as $p) {
                    $data['petani_baru'][] = [
                        'id_petani' => $p['id_user'],
                        'nama_petani' => $p['nama'] ?? 'Petani',
                        'status_petani' => $p['status'] ?? 'Active',
                        'tanggal_daftar' => $p['created_at'] ?? date('Y-m-d'),
                        'no_hp' => $p['no_hp'] ?? '-',
                        'email' => $p['email'] ?? '-',
                        'is_verified' => $p['is_verified'] ?? '1',
                    ];
                }
            } else {
                // 🔴 DATA DUMMY
                $data['petani_baru'] = [
                    [
                        'id_petani' => 1,
                        'nama_petani' => 'Ahmad Petani', 
                        'status_petani' => 'Active', 
                        'tanggal_daftar' => date('Y-m-d', strtotime('-5 days')),
                        'no_hp' => '08123456789',
                        'email' => 'ahmad@example.com',
                        'is_verified' => '1'
                    ],
                    [
                        'id_petani' => 2,
                        'nama_petani' => 'Siti Rahayu', 
                        'status_petani' => 'Active', 
                        'tanggal_daftar' => date('Y-m-d', strtotime('-3 days')),
                        'no_hp' => '08123456788',
                        'email' => 'siti@example.com',
                        'is_verified' => '1'
                    ],
                ];
            }
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
        $data['produk_terlaris'] = !empty($top) ? $top : [];

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
    // METHOD LAINNYA (history, settings, read, dll)
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

    public function read($id_notif)
    {
        $id_user = $this->session->userdata('id_user');
        $this->Notifikasi_model->mark_as_read($id_notif, $id_user);

        $redirect = $this->input->get('redirect');
        if (!empty($redirect)) {
            redirect($redirect);
        }

        $this->db->select('link');
        $this->db->where('id_notifikasi', $id_notif);
        $query = $this->db->get('tb_notifikasi');
        $notif = $query->row_array();

        if (!empty($notif['link']) && $notif['link'] != '#') {
            redirect($notif['link']);
        } else {
            $role = $this->session->userdata('role');
            redirect($role . '/dashboard/history');
        }
    }

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

    public function mark_all_read_ajax()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id_user = $this->session->userdata('id_user');
        $result = $this->Notifikasi_model->mark_all_read($id_user);

        echo json_encode(['success' => $result]);
    }

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
