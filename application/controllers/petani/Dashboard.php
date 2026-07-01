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
        
        if (!$this->session->userdata('id_user')) {
            $this->session->set_userdata([
                'id_user' => 2,
                'role' => 'Petani',
                'nama' => 'Test Petani'
            ]);
            // redirect('auth/login');
        }

        // ============================================
        // 🔴 VALIDASI ROLE - HANYA PETANI YANG BISA AKSES
        // ============================================
        
        $current_role = $this->session->userdata('role');
        
        if ($current_role != 'Petani') {
            if ($current_role == 'Admin') {
                redirect('admin/dashboard');
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

    // ============================================
    // INDEX - DASHBOARD UTAMA PETANI (M11-F01)
    // ============================================
    
    public function index()
    {
        $id_user = $this->session->userdata('id_user');

        // ============================================
        // 🔴 1. AMBIL SETTINGS NOTIFIKASI
        // ============================================
        $data['settings'] = $this->Notifikasi_model->get_settings($id_user);

        // ============================================
        // 2. NOTIFIKASI + ROLE UNTUK SOUND
        // ============================================
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Petani'; // 🔴 UNTUK SOUND

        // ============================================
        // 3. KPI CARDS
        // ============================================
        $kpi = $this->Notifikasi_model->get_petani_kpi($id_user);
        $data['kpi_total_panen'] = $kpi['total_panen'] ?? 0;
        $data['kpi_omset_penjualan'] = $kpi['omset_penjualan'] ?? 0;
        $data['kpi_lahan_aktif'] = $kpi['lahan_aktif'] ?? 0;
        $data['kpi_pesanan_masuk'] = $kpi['pesanan_masuk'] ?? 0;

        // ============================================
        // 4. PESANAN MASUK TERBARU
        // ============================================
        $data['pesanan_masuk'] = $this->db->order_by('id_transaksi', 'DESC')
            ->limit(5)
            ->get('tb_transaksi')
            ->result_array();

        // ============================================
        // 5. STOK MENIPIS
        // ============================================
        $data['notif_stok_tipis'] = $this->db->where('stok_produk <', 20)
            ->limit(5)
            ->get('tb_produk')
            ->result_array();

        // ============================================
        // 6. GRAFIK PANEN
        // ============================================
        $data['grafik_panen'] = $this->Notifikasi_model->get_harvest_chart($id_user);

        // ============================================
        // 7. PRODUK TERJUAL
        // ============================================
        $data['produk_terjual'] = $this->Notifikasi_model->get_petani_top_products($id_user, 5);

        // ============================================
        // 8. JADWAL PANEN
        // ============================================
        $data['jadwal_panen'] = $this->db
            ->where('id_user', $id_user)
            ->where('tanggal_panen >=', date('Y-m-d'))
            ->order_by('tanggal_panen', 'ASC')
            ->limit(5)
            ->get('tb_panen')
            ->result_array();

        // ============================================
        // 9. LOAD VIEW
        // ============================================
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
        $data['role'] = 'Petani';

        $this->load->view('template/v_notif_history', $data);
    }

    // ============================================
    // M11-F03: SETTING NOTIFIKASI (DIPERBAIKI)
    // ============================================
    
    public function settings()
    {
        $id_user = $this->session->userdata('id_user');

        // 🔴 CEK APAKAH REQUEST VIA AJAX
        $is_ajax = $this->input->is_ajax_request();

        if ($this->input->post()) {
            $this->Notifikasi_model->update_settings($id_user, $this->input->post());

            // 🔴 JIKA AJAX, KIRIM RESPONSE JSON
            if ($is_ajax) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Preferensi notifikasi berhasil diperbarui.'
                ]);
                return;
            }

            // 🔴 JIKA BUKAN AJAX (FORM BIASA), REDIRECT
            $this->session->set_flashdata('success', 'Preferensi notifikasi berhasil diperbarui.');
            redirect('petani/dashboard');
        }

        // 🔴 GET REQUEST - TAMPILKAN HALAMAN SETTING
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['settings'] = $this->Notifikasi_model->get_settings($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Petani';

        $this->load->view('template/v_notif_setting', $data);
    }

    // ============================================
    // 🔴 UPDATE SETTINGS DARI DASHBOARD (AJAX)
    // ============================================
    public function update_settings_ajax()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id_user = $this->session->userdata('id_user');
        $field = $this->input->post('field');
        $value = $this->input->post('value');

        // Validasi field yang boleh diupdate
        $allowed_fields = [
            'notif_transaksi', 'notif_pembayaran', 'notif_stok', 
            'notif_kurir', 'notif_panen', 'notif_laporan', 'notif_sistem'
        ];

        if (!in_array($field, $allowed_fields)) {
            echo json_encode(['success' => false, 'message' => 'Field tidak valid']);
            return;
        }

        // Ambil settings saat ini
        $settings = $this->Notifikasi_model->get_settings($id_user);
        
        // Update field
        $settings[$field] = $value ? 1 : 0;
        
        // Simpan ke database
        $result = $this->Notifikasi_model->update_settings($id_user, $settings);
        
        echo json_encode(['success' => $result]);
    }

    // ============================================
    // 🔴 TANDAI NOTIFIKASI DIBACA & REDIRECT
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
            redirect('petani/dashboard/history');
        }
    }

    // ============================================
    // TANDAI SEMUA NOTIFIKASI DIBACA
    // ============================================
    
    public function mark_all_read()
    {
        $id_user = $this->session->userdata('id_user');
        $this->Notifikasi_model->mark_all_read($id_user);
        
        if ($this->input->is_ajax_request()) {
            echo json_encode(['success' => true]);
            return;
        }
        
        redirect('petani/dashboard/history');
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

        $id_user = $this->session->userdata('id_user');
        $data = $this->Notifikasi_model->get_harvest_chart($id_user);
        
        echo json_encode([
            'success' => true,
            'values' => $data['values'] ?? array_fill(0, 12, 0)
        ]);
    }
}
