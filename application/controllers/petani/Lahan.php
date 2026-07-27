<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lahan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Lahan_model');
        $this->load->model('Notifikasi_model'); 
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('text');

        // Proteksi login
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login');
        }
        
        // Validasi Role Petani
        if ($this->session->userdata('role') != 'Petani') {
            redirect('auth/login');
        }
    }

    public function index() {
        $id_user = $this->session->userdata('id_user');
        
        // ============================================
        // DATA TEMPLATE
        // ============================================
        $data['title']        = 'Data Lahan Kopi - Petani';
        $data['title_page']   = 'Manajemen Lahan';
        $data['subtitle']     = 'Kelola data lahan dan titik koordinat perkebunan Anda';
        $data['role']         = 'Petani';

        // ============================================
        // AMBIL NOTIFIKASI
        // ============================================
        $data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        
        // ============================================
        // DATA LAHAN & FILTER
        // ============================================
        $filters = [
            'status_lahan' => $this->input->get('status_lahan'),
            'keyword'      => $this->input->get('keyword')
        ];
        $data['lahan'] = $this->Lahan_model->get_all_lahan($id_user, $filters);
        $data['kpi_lahan_aktif'] = count(array_filter($data['lahan'], fn($l) => strtolower($l['status_lahan']) == 'active' || strtolower($l['status_lahan']) == 'aktif'));

        // Load View Modular
        $this->load->view('templates/petani/header', $data);
        $this->load->view('templates/petani/sidebar', $data);
        $this->load->view('petani/lahan/index', $data);
        $this->load->view('templates/petani/footer');
    }

    public function tambah() {
        $id_user = $this->session->userdata('id_user');
        
        // DATA TEMPLATE
        $data['title']        = 'Tambah Lahan Baru - Petani';
        $data['title_page']   = 'Tambah Lahan';
        $data['subtitle']     = 'Masukkan data detail dan titik koordinat lahan baru';
        $data['role']         = 'Petani';
        $data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        
        if ($this->input->server('REQUEST_METHOD') != 'POST') {
            $this->load->view('templates/petani/header', $data);
            $this->load->view('templates/petani/sidebar', $data);
            $this->load->view('petani/lahan/tambah', $data);
            $this->load->view('templates/petani/footer');
            return;
        }

        // Proses Simpan Data
        $config['upload_path']   = './assets/uploads/lahan/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
        $config['max_size']      = 2048;
        $this->load->library('upload', $config);

        $data_insert = array(
            'id_user'      => $id_user,
            'nama_lahan'   => $this->input->post('nama_lahan'),
            'jenis_kopi'   => $this->input->post('jenis_kopi'),
            'jenis_tanah'  => $this->input->post('jenis_tanah'),
            'luas'         => $this->input->post('luas'),
            'lokasi'       => $this->input->post('lokasi'),
            'latitude'     => $this->input->post('latitude'),
            'longitude'    => $this->input->post('longitude'),
            'status_lahan' => $this->input->post('status_lahan'),
            'catatan'      => $this->input->post('catatan')
        );

        if (!empty($_FILES['foto_lahan']['name'])) {
            if ($this->upload->do_upload('foto_lahan')) {
                $data_insert['foto_lahan'] = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('petani/lahan/tambah');
            }
        }

        if ($this->db->insert('tb_lahan', $data_insert)) {
            $this->session->set_flashdata('success', 'Data lahan berhasil disimpan!');
            redirect('petani/lahan');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyimpan data ke tabel.');
            redirect('petani/lahan/tambah');
        }
    }

    public function edit($id) {
        $id_user = $this->session->userdata('id_user');
        
        // DATA TEMPLATE
        $data['title']        = 'Edit Lahan - Petani';
        $data['title_page']   = 'Edit Lahan';
        $data['subtitle']     = 'Perbarui informasi lahan perkebunan Anda';
        $data['role']         = 'Petani';
        $data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        
        $data['lahan'] = $this->db->get_where('tb_lahan', ['id_lahan' => $id, 'id_user' => $id_user])->row_array();

        if (!$data['lahan']) {
            show_404();
        }

        $this->load->view('templates/petani/header', $data);
        $this->load->view('templates/petani/sidebar', $data);
        $this->load->view('petani/lahan/edit', $data);
        $this->load->view('templates/petani/footer');
    }

    public function update() {
        $id = $this->input->post('id_lahan');

        $data = array(
            'nama_lahan'   => $this->input->post('nama_lahan'),
            'jenis_kopi'   => $this->input->post('jenis_kopi'),
            'jenis_tanah'  => $this->input->post('jenis_tanah'), 
            'luas'         => $this->input->post('luas'),
            'lokasi'       => $this->input->post('lokasi'),
            'latitude'     => $this->input->post('latitude'),
            'longitude'    => $this->input->post('longitude'),
            'status_lahan' => $this->input->post('status_lahan'),
            'catatan'      => $this->input->post('catatan')
        );

        if (!empty($_FILES['foto_lahan']['name'])) {
            $config['upload_path']   = './assets/uploads/lahan/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
            $config['max_size']      = 2048;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto_lahan')) {
                $data['foto_lahan'] = $this->upload->data('file_name');
            }
        }

        $this->db->where('id_lahan', $id);
        $this->db->update('tb_lahan', $data);

        $this->session->set_flashdata('success', 'Data lahan berhasil diupdate!');
        redirect('petani/lahan');
    }

    public function detail($id) {
        $id_user = $this->session->userdata('id_user');
        
        $data['title']        = 'Detail Lahan - Petani';
        $data['title_page']   = 'Informasi Lahan';
        $data['subtitle']     = 'Detail komprehensif dan riwayat panen lahan';
        $data['role']         = 'Petani';
        $data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        
        $data['lahan'] = $this->Lahan_model->get_detail($id);
        
        // Pastikan hanya bisa lihat lahan sendiri
        if (empty($data['lahan']) || $data['lahan']['id_user'] != $id_user) {
            show_404();
        }

        $this->load->model('Panen_model'); 
        $data['riwayat_panen'] = $this->Panen_model->get_panen_by_lahan($id);
        
        $this->load->view('templates/petani/header', $data);
        $this->load->view('templates/petani/sidebar', $data);
        $this->load->view('petani/lahan/detail', $data);
        $this->load->view('templates/petani/footer');
    }

    public function hapus($id) {
        $this->Lahan_model->hapus_data($id);
        $this->session->set_flashdata('success', 'Data berhasil dihapus');
        redirect('petani/lahan');
    }
}