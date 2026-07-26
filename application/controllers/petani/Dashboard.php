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
        $nama_user = $this->session->userdata('nama') ?? 'Petani';

        // ============================================
        // 🔴 DATA TEMPLATE (HEADER & SIDEBAR)
        // ============================================
        $data['title']        = 'Panel Produksi - Petani Kopi';
        $data['title_page']   = 'Panel Produksi';
        $data['subtitle']     = 'Selamat datang, <span style="color: var(--amber-cream); font-weight:600;">' . htmlspecialchars($nama_user) . '</span> <span id="currentDateTime" style="color: var(--text-secondary); font-size:0.85rem;"></span>';
        $data['role']         = 'Petani';

        // ============================================
        // 1. AMBIL SETTINGS NOTIFIKASI
        // ============================================
        $data['settings'] = $this->Notifikasi_model->get_settings($id_user);

        // ============================================
        // 2. NOTIFIKASI + ROLE UNTUK SOUND
        // ============================================
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);

        // ============================================
        // 3. KPI CARDS (DIUBAH KE DATA REAL DATABASE)
        // ============================================
        // Total Panen
        $this->db->select_sum('jumlah_panen');
        $this->db->where('id_user', $id_user);
        $data['kpi_total_panen'] = $this->db->get('tb_panen')->row()->jumlah_panen ?? 0;

        // Omset Penjualan (Pesanan Selesai) - FIX NAMA KOLOM id_petani
        $this->db->select_sum('total_harga'); 
        $this->db->where('id_petani', $id_user);
        $this->db->where('status_pesanan', 'Selesai');
        $data['kpi_omset_penjualan'] = $this->db->get('tb_transaksi')->row()->total_harga ?? 0;

        // Lahan Aktif
        $data['kpi_lahan_aktif'] = $this->db->where(['id_user' => $id_user, 'status_lahan' => 'Active'])->count_all_results('tb_lahan');

        // Pesanan Masuk (Baru/Pending/Diproses) - FIX NAMA KOLOM id_petani
        $data['kpi_pesanan_masuk'] = $this->db->where('id_petani', $id_user)
                                              ->where_in('status_pesanan', ['Pending', 'Diproses', 'Baru'])
                                              ->count_all_results('tb_transaksi');

        // ============================================
        // 4. PESANAN MASUK TERBARU (DIUBAH KE DATA REAL)
        // ============================================
        // FIX NAMA KOLOM id_petani
        $data['pesanan_masuk'] = $this->db->where('id_petani', $id_user)
            ->order_by('id_transaksi', 'DESC')
            ->limit(5)
            ->get('tb_transaksi')
            ->result_array();

        // ============================================
        // 5. STOK MENIPIS (DIUBAH KE DATA REAL)
        // ============================================
        $data['notif_stok_tipis'] = $this->db->where('id_user', $id_user)
            ->where('stok_produk <', 20)
            ->limit(5)
            ->get('tb_produk')
            ->result_array();

        // ============================================
        // 6. GRAFIK PANEN (DIUBAH KE DATA REAL)
        // ============================================
        $grafik_values = array_fill(0, 12, 0); 
        $this->db->select('MONTH(tanggal_panen) as bulan, SUM(jumlah_panen) as total');
        $this->db->where('id_user', $id_user);
        $this->db->where('YEAR(tanggal_panen)', date('Y'));
        $this->db->group_by('MONTH(tanggal_panen)');
        $panen_chart = $this->db->get('tb_panen')->result_array();
        
        foreach ($panen_chart as $row) {
            $grafik_values[(int)$row['bulan'] - 1] = (int)$row['total'];
        }
        $data['grafik_panen']['values'] = $grafik_values;

        // ============================================
        // 7. PRODUK TERJUAL (DIUBAH KE DATA REAL)
        // ============================================
        // FIX: tb_detail_transaksi & d.jumlah
        $this->db->select('p.nama_produk, SUM(d.jumlah) as total_terjual, SUM(d.subtotal) as pendapatan');
        $this->db->from('tb_detail_transaksi d');
        $this->db->join('tb_produk p', 'p.id_produk = d.id_produk');
        $this->db->join('tb_transaksi t', 't.id_transaksi = d.id_transaksi');
        $this->db->where('p.id_user', $id_user);
        $this->db->where('t.status_pesanan', 'Selesai');
        $this->db->group_by('p.id_produk');
        $this->db->order_by('total_terjual', 'DESC');
        $this->db->limit(5);
        $query_top = $this->db->get();
        $data['produk_terjual'] = $query_top ? $query_top->result_array() : [];

        // ============================================
        // 8. LOAD VIEW (MODULAR)
        // ============================================
        $this->load->view('templates/petani/header', $data);
        $this->load->view('templates/petani/sidebar', $data);
        $this->load->view('petani/v_dashboard', $data);
        $this->load->view('templates/petani/footer');
    }

    // ============================================
    // M11-F02: HISTORY NOTIFIKASI
    // ============================================
    
    public function history()
    {
        $id_user = $this->session->userdata('id_user');
        
        $data['title']        = 'Riwayat Notifikasi - Petani Kopi';
        $data['title_page']   = 'Riwayat Notifikasi';
        $data['subtitle']     = 'Daftar seluruh aktivitas dan notifikasi Anda';
        $data['role']         = 'Petani';

        $data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['history']      = $this->Notifikasi_model->get_all_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);

        // Load View Modular
  
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
        $data['title']        = 'Pengaturan Notifikasi - Petani Kopi';
        $data['title_page']   = 'Pengaturan Notifikasi';
        $data['subtitle']     = 'Sesuaikan preferensi sistem notifikasi Anda';
        $data['role']         = 'Petani';

        $data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['settings']     = $this->Notifikasi_model->get_settings($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);

        // Load View Modular

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
    // AJAX - GET CHART DATA (DIUBAH KE DATA REAL)
    // ============================================
    public function get_chart_data()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id_user = $this->session->userdata('id_user');
        
        $grafik_values = array_fill(0, 12, 0); 
        $this->db->select('MONTH(tanggal_panen) as bulan, SUM(jumlah_panen) as total');
        $this->db->where('id_user', $id_user);
        $this->db->where('YEAR(tanggal_panen)', date('Y'));
        $this->db->group_by('MONTH(tanggal_panen)');
        $panen_chart = $this->db->get('tb_panen')->result_array();
        
        foreach ($panen_chart as $row) {
            $grafik_values[(int)$row['bulan'] - 1] = (int)$row['total'];
        }
        
        echo json_encode([
            'success' => true,
            'values' => $grafik_values
        ]);
    }
}
