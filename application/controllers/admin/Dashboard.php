<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // ============================================
        // CEK LOGIN
        // ============================================
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
            } else {
                $this->session->sess_destroy();
                redirect('auth/login');
            }
        }

        // ============================================
        // LOAD MODEL YANG DIPERLUKAN SAJA
        // ============================================
        $this->load->model('Notifikasi_model');
        // HAPUS baris ini: $this->load->model('Admin_model');
    }

    // ============================================
    // INDEX - DASHBOARD UTAMA (M11-F01)
    // ============================================
    public function index()
    {
        $id_user = $this->session->userdata('id_user');

        // ============================================
        // 1. NOTIFIKASI
        // ============================================
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);

        // ============================================
        // 2. KPI CARDS (M11-F01)
        // ============================================
        $kpi = $this->Notifikasi_model->get_admin_kpi();
        $data['kpi_total_revenue'] = $kpi['total_revenue'] ?? 87500000;
        $data['kpi_transaksi_aktif'] = $kpi['transaksi_aktif'] ?? 156;
        $data['kpi_petani_terverifikasi'] = $kpi['petani_terverifikasi'] ?? 48;
        $data['kpi_mitra_cafe'] = $kpi['mitra_cafe'] ?? 32;

        // ============================================
        // 3. PETANI BARU (M11-F01)
        // ============================================
        $petani_baru = $this->db
            ->where('status_petani', 'Pending')
            ->order_by('id_petani', 'DESC')
            ->limit(5)
            ->get('tb_petani')
            ->result_array();

        $data['petani_baru'] = [];
        if (!empty($petani_baru)) {
            foreach ($petani_baru as $p) {
                $data['petani_baru'][] = [
                    'nama_petani' => $p['nama_petani'] ?? $p['nama'] ?? 'Petani',
                    'status_petani' => $p['status_petani'] ?? 'Pending',
                    'tanggal_daftar' => $p['tanggal_daftar'] ?? date('Y-m-d'),
                ];
            }
        } else {
            // Data dummy jika kosong
            $data['petani_baru'] = [
                ['nama_petani' => 'Budi Santoso', 'status_petani' => 'Active', 'tanggal_daftar' => '2026-06-20'],
                ['nama_petani' => 'Siti Rahayu', 'status_petani' => 'Active', 'tanggal_daftar' => '2026-06-18'],
                ['nama_petani' => 'Ahmad Fauzi', 'status_petani' => 'Pending', 'tanggal_daftar' => '2026-06-15'],
                ['nama_petani' => 'Dewi Lestari', 'status_petani' => 'Active', 'tanggal_daftar' => '2026-06-12'],
                ['nama_petani' => 'Joko Widodo', 'status_petani' => 'Pending', 'tanggal_daftar' => '2026-06-10'],
            ];
        }

        // ============================================
        // 4. PESANAN TERBARU (M11-F01)
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
                    'metode_bayar' => $p['metode_bayar'] ?? $p['metode_pembayaran'] ?? 'Transfer Bank',
                    'total_harga' => $p['total'] ?? $p['total_harga'] ?? 0,
                    'status_pesanan' => $p['status_pesanan'] ?? $p['status_transaksi'] ?? 'Pending',
                ];
            }
        } else {
            // Data dummy jika kosong
            $data['pesanan_terbaru'] = [
                ['id_transaksi' => 'INV-2026-008', 'metode_bayar' => 'Transfer Bank', 'total_harga' => 2850000, 'status_pesanan' => 'Delivery'],
                ['id_transaksi' => 'INV-2026-007', 'metode_bayar' => 'QRIS', 'total_harga' => 1750000, 'status_pesanan' => 'Complete'],
                ['id_transaksi' => 'INV-2026-006', 'metode_bayar' => 'Transfer Bank', 'total_harga' => 3200000, 'status_pesanan' => 'Complete'],
                ['id_transaksi' => 'INV-2026-005', 'metode_bayar' => 'COD', 'total_harga' => 950000, 'status_pesanan' => 'Pending'],
                ['id_transaksi' => 'INV-2026-004', 'metode_bayar' => 'Transfer Bank', 'total_harga' => 1250000, 'status_pesanan' => 'Processing'],
            ];
        }

        // ============================================
        // 5. GRAFIK PENJUALAN (M10-F02)
        // ============================================
        $chart = $this->Notifikasi_model->get_sales_chart();
        $data['grafik_penjualan'] = [
            'labels' => $chart['labels'] ?? ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
            'values' => $chart['values'] ?? [120, 150, 180, 140, 200, 230, 210, 250, 270, 240, 300, 280],
        ];

        // ============================================
        // 6. PRODUK TERLARIS (M10-F04)
        // ============================================
        $top = $this->Notifikasi_model->get_top_products(5);
        $data['produk_terlaris'] = !empty($top) ? $top : [
            ['nama' => 'Liberika Grade A', 'total_terjual' => 285, 'pendapatan' => 51300000],
            ['nama' => 'Arabika Specialty', 'total_terjual' => 192, 'pendapatan' => 40320000],
            ['nama' => 'Robusta Grade A', 'total_terjual' => 156, 'pendapatan' => 20280000],
            ['nama' => 'Liberika Grade B', 'total_terjual' => 98, 'pendapatan' => 12250000],
            ['nama' => 'Arabika Grade A', 'total_terjual' => 75, 'pendapatan' => 13125000],
        ];

        // ============================================
        // 7. SETTINGS NOTIFIKASI (M11-F03)
        // ============================================
        $data['settings'] = $this->Notifikasi_model->get_settings($id_user);

        // ============================================
        // 8. LOAD VIEW
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

        $this->load->view('template/v_notif_setting', $data);
    }

    // ============================================
    // TANDAI NOTIFIKASI DIBACA
    // ============================================
    public function read($id_notif)
    {
        $id_user = $this->session->userdata('id_user');
        $this->Notifikasi_model->mark_as_read($id_notif, $id_user);

        $redirect = $this->input->get('redirect') ?? 'admin/dashboard/history';
        redirect($redirect);
    }

    // ============================================
    // AJAX - GET NOTIFIKASI
    // ============================================
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

    // ============================================
    // AJAX - MARK ALL READ
    // ============================================
    public function mark_all_read_ajax()
    {
        $id_user = $this->session->userdata('id_user');
        $result = $this->Notifikasi_model->mark_all_read($id_user);

        echo json_encode(['success' => $result]);
    }

    // ============================================
    // AJAX - GET CHART DATA
    // ============================================
    public function get_chart_data()
    {
        $data = $this->Notifikasi_model->get_sales_chart();
        echo json_encode([
            'success' => true,
            'values' => $data['values'] ?? [120, 150, 180, 140, 200, 230, 210, 250, 270, 240, 300, 280]
        ]);
    }
}