<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lahan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // 🔴 CEK LOGIN & ROLE
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login');
        }
        
        if ($this->session->userdata('role') != 'Admin') {
            redirect('auth/login');
        }
        
        $this->load->model('Lahan_model');
        $this->load->model('Notifikasi_model'); // 🔴 TAMBAHKAN INI!
        $this->load->helper('text');
        $this->load->helper('url');
    }

    public function index() {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Admin';
        
        $filters = [
            'status_lahan' => $this->input->get('status_lahan'),
            'lokasi' => $this->input->get('lokasi')
        ];

        $data['title'] = "Panel Admin: Data Lahan Kopi";
        $data['lahan'] = $this->Lahan_model->get_all_lahan(null, $filters);

        $this->load->view('admin/lahan/index', $data);
    }
    
    // ── DETAIL LAHAN ──────────────────────────────────────────────
    public function detail($id) {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Admin';
        
        $data['lahan'] = $this->Lahan_model->get_lahan_by_id($id);
        
        if (!$data['lahan']) {
            show_404();
        }
        
        $this->load->view('admin/lahan/detail', $data);
    }
    
    // ── TAMBAH LAHAN ──────────────────────────────────────────────
    public function tambah() {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Admin';
        
        $data['petani_list'] = $this->Lahan_model->get_all_petani();
        
        $this->load->view('admin/lahan/tambah', $data);
    }
    
    // ── PROSES TAMBAH ──────────────────────────────────────────────
    public function tambah_aksi() {
        // 🔴 METHOD INI REDIRECT, TIDAK PERLU NOTIFIKASI
        
        $this->form_validation->set_rules('id_user', 'Petani', 'required');
        $this->form_validation->set_rules('nama_lahan', 'Nama Lahan', 'required');
        $this->form_validation->set_rules('jenis_kopi', 'Jenis Kopi', 'required');
        $this->form_validation->set_rules('luas', 'Luas', 'required|numeric');
        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $id_user = $this->session->userdata('id_user');
            
            // 🔴 AMBIL NOTIFIKASI - 3 BARIS (KALAU VALIDASI GAGAL)
            $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
            $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
            $data['role'] = 'Admin';
            
            $data['petani_list'] = $this->Lahan_model->get_all_petani();
            $this->load->view('admin/lahan/tambah', $data);
            return;
        }
        
        $data = [
            'id_user' => $this->input->post('id_user'),
            'nama_lahan' => $this->input->post('nama_lahan'),
            'jenis_kopi' => $this->input->post('jenis_kopi'),
            'luas' => $this->input->post('luas'),
            'lokasi' => $this->input->post('lokasi'),
            'catatan' => $this->input->post('catatan'),
            'status_lahan' => $this->input->post('status_lahan') ?: 'Active'
        ];
        
        // Upload foto lahan
        if (!empty($_FILES['foto_lahan']['name'])) {
            $config['upload_path'] = './uploads/lahan/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['max_size'] = 2048;
            
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0777, true);
            }
            
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto_lahan')) {
                $data['foto_lahan'] = $this->upload->data('file_name');
            }
        }
        
        $this->Lahan_model->insert_lahan($data);
        
        // Kirim notifikasi ke petani
        $this->load->helper('notifikasi');
        send_notifikasi(
            $data['id_user'],
            'Petani',
            '📋 Lahan Baru Ditambahkan',
            'Admin telah menambahkan lahan baru: ' . $data['nama_lahan'] . ' untuk Anda.',
            'info',
            base_url('petani/lahan')
        );
        
        $this->session->set_flashdata('success', 'Data lahan berhasil ditambahkan!');
        redirect('admin/lahan');
    }
    
    // ── EDIT LAHAN ──────────────────────────────────────────────
    public function edit($id) {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Admin';
        
        $data['lahan'] = $this->Lahan_model->get_lahan_by_id($id);
        
        if (!$data['lahan']) {
            show_404();
        }
        
        $data['petani_list'] = $this->Lahan_model->get_all_petani();
        
        $this->load->view('admin/lahan/edit', $data);
    }
    
    // ── PROSES UPDATE ──────────────────────────────────────────────
    public function update_aksi($id) {
        // 🔴 METHOD INI REDIRECT, TIDAK PERLU NOTIFIKASI
        
        $data = [
            'id_user' => $this->input->post('id_user'),
            'nama_lahan' => $this->input->post('nama_lahan'),
            'jenis_kopi' => $this->input->post('jenis_kopi'),
            'luas' => $this->input->post('luas'),
            'lokasi' => $this->input->post('lokasi'),
            'catatan' => $this->input->post('catatan'),
            'status_lahan' => $this->input->post('status_lahan')
        ];
        
        // Upload foto lahan
        if (!empty($_FILES['foto_lahan']['name'])) {
            $config['upload_path'] = './uploads/lahan/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['max_size'] = 2048;
            
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0777, true);
            }
            
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto_lahan')) {
                $data['foto_lahan'] = $this->upload->data('file_name');
            }
        }
        
        $this->Lahan_model->update_lahan($id, $data);
        $this->session->set_flashdata('success', 'Data lahan berhasil diperbarui!');
        redirect('admin/lahan');
    }
    
    // ── HAPUS LAHAN ──────────────────────────────────────────────
    public function hapus($id) {
        // 🔴 METHOD INI REDIRECT, TIDAK PERLU NOTIFIKASI
        
        $this->Lahan_model->delete_lahan($id);
        $this->session->set_flashdata('success', 'Data lahan berhasil dihapus!');
        redirect('admin/lahan');
    }
    
    // ── TOGGLE STATUS ──────────────────────────────────────────────
    public function toggle_status($id) {
        // 🔴 METHOD INI REDIRECT, TIDAK PERLU NOTIFIKASI
        
        $lahan = $this->Lahan_model->get_lahan_by_id($id);
        
        if ($lahan) {
            $new_status = ($lahan['status_lahan'] == 'Active') ? 'Inactive' : 'Active';
            $this->Lahan_model->update_lahan($id, ['status_lahan' => $new_status]);
            
            // Kirim notifikasi ke petani
            $this->load->helper('notifikasi');
            send_notifikasi(
                $lahan['id_user'],
                'Petani',
                '🔄 Status Lahan Diperbarui',
                'Status lahan ' . $lahan['nama_lahan'] . ' diubah menjadi ' . $new_status . '.',
                'warning',
                base_url('petani/lahan')
            );
            
            $this->session->set_flashdata('success', 'Status lahan berhasil diubah!');
        }
        
        redirect('admin/lahan');
    }
}
