<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petani extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Proteksi login (Pastikan session sudah jalan)
        if (!$this->session->userdata('id_user') || $this->session->userdata('role') !== 'Admin') {
            redirect('auth/login');
        }
        $this->load->model('Petani_model');
        $this->load->library('form_validation');
    }

    // 1. List Petani
    public function index() {
        $status = $this->input->get('status');
        $data['daftar_petani'] = $this->Petani_model->get_daftar_petani($status);
        $data['status_filter'] = $status;
        
        $this->load->view('admin/v_header');
        $this->load->view('admin/v_sidebar');
        $this->load->view('admin/petani_list', $data);
        $this->load->view('admin/v_foother');
    }

    // 2. Detail Petani
    public function detail($id) {
        $data['petani'] = $this->Petani_model->get_petani_by_id($id);
        if (!$data['petani']) { show_404(); }
        
        $this->load->view('admin/v_header');
        $this->load->view('admin/v_sidebar');
        $this->load->view('admin/petani_detail', $data);
        $this->load->view('admin/v_foother');
    }

    // 3. Form Tambah Petani
    public function tambah() {
        $this->load->view('admin/v_header');
        $this->load->view('admin/v_sidebar');
        $this->load->view('admin/petani_form');
        $this->load->view('admin/v_foother');
    }

    // 4. Form Edit Data
    public function edit($id) {
        $data['petani'] = $this->Petani_model->get_petani_by_id($id);
        if (!$data['petani']) { show_404(); }
        
        $this->load->view('admin/v_header');
        $this->load->view('admin/v_sidebar');
        $this->load->view('admin/petani_edit', $data);
        $this->load->view('admin/v_foother');
    }

    // 5. Proses Update Data & Upload Dokumen
    public function update_aksi($id) {
        $data = [
            'nama_petani'   => $this->input->post('nama_petani'),
            'nik'           => $this->input->post('nik'),
            'no_hp'         => $this->input->post('no_hp'),
            'email'         => $this->input->post('email'),
            'alamat'        => $this->input->post('alamat'),
            'status_petani' => $this->input->post('status')
        ];

        // Konfigurasi Upload
        $config['upload_path']   = './uploads/dokumen/'; 
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size']      = 2048;
        $this->load->library('upload', $config);

        $fields = ['file_ktp', 'file_npwp', 'file_sertifikat'];
        foreach ($fields as $field) {
            if (!empty($_FILES[$field]['name'])) {
                if ($this->upload->do_upload($field)) {
                    $file_data = $this->upload->data();
                    $data[$field] = $file_data['file_name'];
                }
            }
        }

        $this->Petani_model->update_petani($id, $data);
        $this->session->set_flashdata('pesan', 'Data dan dokumen berhasil diperbarui!');
        redirect('admin/petani/detail/' . $id);
    }

    // 6. Verifikasi Dokumen
    public function verifikasi_dokumen($id, $jenis_dokumen) {
        $allowed = ['status_ktp', 'status_npwp', 'status_sertifikat'];
        
        if (in_array($jenis_dokumen, $allowed)) {
            $this->Petani_model->update_petani($id, [$jenis_dokumen => 'Terverifikasi']);
            $this->session->set_flashdata('pesan', 'Dokumen berhasil diverifikasi!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memverifikasi dokumen!');
        }
        
        redirect('admin/petani/detail/' . $id);
    }

    // 7. Hapus Data
    public function hapus($id) {
        $this->Petani_model->delete_petani($id);
        $this->session->set_flashdata('pesan', 'Data berhasil dihapus!');
        redirect('admin/petani');
    }
}