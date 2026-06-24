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

        // Hitung statistik untuk KPI cards
        $semua = $this->Petani_model->get_daftar_petani();
        $active_count = 0;
        $inactive_count = 0;
        $suspended_count = 0;
        foreach($semua as $p) {
            if ($p['status_petani'] == 'Active' || $p['status_petani'] == 'Terverifikasi') $active_count++;
            else if ($p['status_petani'] == 'Pending' || $p['status_petani'] == 'Inactive') $inactive_count++;
            else if ($p['status_petani'] == 'Ditolak' || $p['status_petani'] == 'Suspended') $suspended_count++;
        }
        $data['total_petani'] = count($semua);
        $data['active_count'] = $active_count;
        $data['inactive_count'] = $inactive_count;
        $data['suspended_count'] = $suspended_count;

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

        // Upload Foto Profil jika ada
        $upload_path = './uploads/dokumen/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }
        $config['upload_path']   = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048;
        $this->upload->initialize($config);

        if (!empty($_FILES['foto_profil']['name'])) {
            if ($this->upload->do_upload('foto_profil')) {
                $data['foto_profil'] = $this->upload->data('file_name');
            }
        }

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

        $upload_path = './uploads/dokumen/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }

        $config['upload_path']   = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size']      = 2048;
        $this->upload->initialize($config);

        $fields = ['file_ktp', 'file_npwp', 'file_sertifikat', 'foto_profil'];
        foreach ($fields as $field) {
            if (!empty($_FILES[$field]['name'])) {
                if ($this->upload->do_upload($field)) {
                    $data[$field] = $this->upload->data('file_name');
                }
            }
        }

        $this->Petani_model->update_petani($id, $data);
        $this->session->set_flashdata('pesan', 'Data berhasil diperbarui!');
        redirect('admin/petani');
    }

    // ── 7. VERIFIKASI Petani ─────────────────────────────────────────
    public function verifikasi($id) {
        $data['petani'] = $this->Petani_model->get_petani_by_id($id);
        if (!$data['petani']) { show_404(); }

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $action = $this->input->post('action'); // 'approve' or 'reject'
            $catatan = $this->input->post('catatan_verifikasi');

            $status_baru = ($action === 'approve') ? 'Active' : 'Suspended';
            
            $update_data = [
                'status_petani' => $status_baru,
                'catatan_verifikasi' => $catatan
            ];
            
            if ($action === 'approve') {
                $update_data['status_ktp'] = 'Terverifikasi';
                $update_data['status_npwp'] = 'Terverifikasi';
                $update_data['status_sertifikat'] = 'Terverifikasi';
            } else {
                $update_data['status_ktp'] = 'Ditolak';
                $update_data['status_npwp'] = 'Ditolak';
                $update_data['status_sertifikat'] = 'Ditolak';
            }

            $this->Petani_model->update_petani($id, $update_data);
            $this->session->set_flashdata('pesan', 'Verifikasi berhasil diproses!');
            redirect('admin/petani');
        }

        $this->load->view('admin/Petani_verifikasi', $data);
    }

    // ── 8. VERIFIKASI Dokumen Spesifik (Opsional, tapi dibiarkan) ──
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
        $this->load->view('admin/Petani_export');
    }
}