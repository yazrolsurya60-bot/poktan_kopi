<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petani extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Proteksi login
        if (!$this->session->userdata('id_user') || $this->session->userdata('role') !== 'Admin') {
            redirect('auth/login');
        }
        $this->load->model('Petani_model');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->helper('url');
    }

    // ── 1. LIST Petani ──────────────────────────────────────────────
    public function index() {
        $status = $this->input->get('status');
        $data['daftar_petani'] = $this->Petani_model->get_daftar_petani($status);
        $data['status_filter'] = $status;

        $this->load->view('admin/Petani_list', $data);
    }

    // ── 2. DETAIL Petani ─────────────────────────────────────────────
    public function detail($id) {
        $data['petani'] = $this->Petani_model->get_petani_by_id($id);
        if (!$data['petani']) { show_404(); }

        $this->load->view('admin/Petani_detail', $data);
    }

    // ── 3. FORM Tambah ───────────────────────────────────────────────
    public function tambah() {
        $this->load->view('admin/Petani_form');
    }

    // ── 4. PROSES Tambah ─────────────────────────────────────────────
    public function tambah_aksi() {
        $this->form_validation->set_rules('nama_petani', 'Nama Petani', 'required|trim');
        $this->form_validation->set_rules('nik',         'NIK',         'required|trim');
        $this->form_validation->set_rules('no_hp',       'No HP',       'required|trim');
        $this->form_validation->set_rules('alamat',      'Alamat',      'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/Petani_form');
            return;
        }

        $data = [
            'nama_petani'   => $this->input->post('nama_petani'),
            'nik'           => $this->input->post('nik'),
            'no_hp'         => $this->input->post('no_hp'),
            'email'         => $this->input->post('email'),
            'alamat'        => $this->input->post('alamat'),
            'status_petani' => $this->input->post('status') ?: 'Pending',
            'tanggal_daftar' => date('Y-m-d'),
        ];

        $this->Petani_model->insert_petani($data);
        $this->session->set_flashdata('pesan', 'Data petani berhasil ditambahkan!');
        redirect('admin/petani');
    }

    // ── 5. FORM Edit ─────────────────────────────────────────────────
    public function edit($id) {
        $data['petani'] = $this->Petani_model->get_petani_by_id($id);
        if (!$data['petani']) { show_404(); }

        $this->load->view('admin/Petani_edit', $data);
    }

    // ── 6. PROSES Update ─────────────────────────────────────────────
    public function update_aksi($id) {
        $data = [
            'nama_petani'   => $this->input->post('nama_petani'),
            'nik'           => $this->input->post('nik'),
            'no_hp'         => $this->input->post('no_hp'),
            'email'         => $this->input->post('email'),
            'alamat'        => $this->input->post('alamat'),
            'status_petani' => $this->input->post('status'),
        ];

        // Pastikan folder uploads/dokumen ada
        $upload_path = './uploads/dokumen/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }

        // Konfigurasi Upload
        $config = [
            'upload_path'   => $upload_path,
            'allowed_types' => 'jpg|jpeg|png|pdf',
            'max_size'      => 2048,
        ];
        $this->load->library('upload', $config);

        $fields = ['file_ktp', 'file_npwp', 'file_sertifikat'];
        foreach ($fields as $field) {
            if (!empty($_FILES[$field]['name'])) {
                $this->upload->initialize($config);
                if ($this->upload->do_upload($field)) {
                    $data[$field] = $this->upload->data('file_name');
                }
            }
        }

        $this->Petani_model->update_petani($id, $data);
        $this->session->set_flashdata('pesan', 'Data dan dokumen berhasil diperbarui!');
        redirect('admin/petani/detail/' . $id);
    }

    // ── 7. VERIFIKASI Petani ─────────────────────────────────────────
    public function verifikasi($id) {
        $petani = $this->Petani_model->get_petani_by_id($id);
        if (!$petani) { show_404(); }

        $this->Petani_model->update_petani($id, ['status_petani' => 'Terverifikasi']);
        $this->session->set_flashdata('pesan', 'Petani berhasil diverifikasi!');
        redirect('admin/petani/detail/' . $id);
    }

    // ── 8. VERIFIKASI Dokumen Spesifik ──────────────────────────────
    public function verifikasi_dokumen($id, $jenis_dokumen) {
        $allowed = ['status_ktp', 'status_npwp', 'status_sertifikat'];
        if (in_array($jenis_dokumen, $allowed)) {
            $this->Petani_model->update_petani($id, [$jenis_dokumen => 'Terverifikasi']);
            $this->session->set_flashdata('pesan', 'Dokumen berhasil diverifikasi!');
        } else {
            $this->session->set_flashdata('error', 'Jenis dokumen tidak valid!');
        }
        redirect('admin/petani/detail/' . $id);
    }

    // ── 9. HAPUS Petani ──────────────────────────────────────────────
    public function hapus($id) {
        $this->Petani_model->delete_petani($id);
        $this->session->set_flashdata('pesan', 'Data petani berhasil dihapus!');
        redirect('admin/petani');
    }

    // ── 10. EXPORT PAGE ──────────────────────────────────────────────
    public function export_page() {
        $data['daftar_petani'] = $this->Petani_model->get_daftar_petani();
        $this->load->view('admin/Petani_list', $data);
    }
}