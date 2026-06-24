<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Kurir Controller
 * ============================================
 * Modul 08: Manajemen Kurir — (Anisya)
 * ============================================
 * - M08-F01 : List, filter status & cari kurir
 * - M08-F02 : Tambah kurir (modal di halaman index)
 * - M08-F03 : Edit kurir (modal di halaman index)
 * - M08-F04 : Hapus kurir
 * - M08-F05 : Toggle status kurir
 * - M08-F06 : Assign kurir ke pengiriman
 *
 * View dibuat full-page (sidebar + header + isi + script jadi satu file),
 * mengikuti pola v_dashboard.php (Modul 11 - Putri).
 */
class Kurir extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // 🔴 Cek apakah user sudah login
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login');
        }

        // 🔴 Hanya Admin yang boleh mengakses modul ini
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

        $this->load->model('Kurir_model');
        $this->load->library('form_validation');
    }

    // ============================================
    // M08-F01: INDEX - LIST KURIR + MODAL TAMBAH/EDIT
    // ============================================
    public function index()
    {
        $status_filter = $this->input->get('status');
        $keyword       = $this->input->get('keyword');

        $data['list_kurir']  = $this->Kurir_model->get_all($status_filter, $keyword);
        $data['keyword']     = $keyword;

        $data['kurir_active']   = $this->Kurir_model->count_by_status('Active');
        $data['kurir_inactive'] = $this->Kurir_model->count_by_status('Inactive');
        $data['kurir_offline']  = $this->Kurir_model->count_by_status('Offline');

        $this->load->view('admin/kurir/index', $data);
    }

    // ============================================
    // M08-F02: TAMBAH KURIR (proses dari modal index)
    // ============================================
    public function tambah()
    {
        if (!$this->input->post()) {
            redirect('admin/kurir');
        }

        $this->_validate();

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/kurir');
        }

        $data = [
            'nama_kurir'      => $this->input->post('nama_kurir'),
            'no_telepon'      => $this->input->post('no_telepon'),
            'email'           => $this->input->post('email') ?: null,
            'status'          => $this->input->post('status'),
            'lokasi_terakhir' => $this->input->post('lokasi_terakhir') ?: null,
        ];

        $this->Kurir_model->insert($data);

        $this->session->set_flashdata('success', 'Kurir baru berhasil ditambahkan.');
        redirect('admin/kurir');
    }

    // ============================================
    // M08-F03: EDIT KURIR (proses dari modal index)
    // ============================================
    public function edit($id_kurir = null)
    {
        if (!$this->input->post()) {
            redirect('admin/kurir');
        }

        $kurir = $this->Kurir_model->get_by_id($id_kurir);

        if (!$kurir) {
            $this->session->set_flashdata('error', 'Data kurir tidak ditemukan.');
            redirect('admin/kurir');
        }

        $this->_validate();

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/kurir');
        }

        $data = [
            'nama_kurir'      => $this->input->post('nama_kurir'),
            'no_telepon'      => $this->input->post('no_telepon'),
            'email'           => $this->input->post('email') ?: null,
            'status'          => $this->input->post('status'),
            'lokasi_terakhir' => $this->input->post('lokasi_terakhir') ?: null,
        ];

        $this->Kurir_model->update($id_kurir, $data);

        $this->session->set_flashdata('success', 'Data kurir berhasil diperbarui.');
        redirect('admin/kurir');
    }

    // ============================================
    // M08-F04: HAPUS KURIR
    // ============================================
    public function hapus($id_kurir = null)
    {
        $kurir = $this->Kurir_model->get_by_id($id_kurir);

        if (!$kurir) {
            $this->session->set_flashdata('error', 'Data kurir tidak ditemukan.');
            redirect('admin/kurir');
        }

        if ($this->Kurir_model->is_in_use($id_kurir)) {
            $this->session->set_flashdata('error', 'Kurir "' . $kurir['nama_kurir'] . '" sedang menangani pengiriman aktif, tidak dapat dihapus.');
            redirect('admin/kurir');
        }

        $this->Kurir_model->delete($id_kurir);

        $this->session->set_flashdata('success', 'Kurir berhasil dihapus.');
        redirect('admin/kurir');
    }

    // ============================================
    // M08-F05: TOGGLE STATUS (Active <-> Inactive)
    // ============================================
    public function toggle($id_kurir = null)
    {
        $kurir = $this->Kurir_model->get_by_id($id_kurir);

        if (!$kurir) {
            $this->session->set_flashdata('error', 'Data kurir tidak ditemukan.');
            redirect('admin/kurir');
        }

        $status_baru = ($kurir['status'] == 'Active') ? 'Inactive' : 'Active';
        $this->Kurir_model->update($id_kurir, ['status' => $status_baru]);

        $this->session->set_flashdata('success', 'Status kurir diubah menjadi ' . $status_baru . '.');
        redirect('admin/kurir');
    }

    // ============================================
    // M08-F06: HALAMAN ASSIGN KURIR
    // ============================================
    public function assign()
    {
        $data['pengiriman_pending'] = $this->Kurir_model->get_pengiriman_belum_assign();
        $data['kurir_aktif']        = $this->Kurir_model->get_kurir_aktif();

        $this->load->view('admin/kurir/assign', $data);
    }

    // ============================================
    // M08-F06: PROSES ASSIGN (dipanggil dari form di halaman assign)
    // ============================================
    public function proses_assign()
    {
        if (!$this->input->post()) {
            redirect('admin/kurir/assign');
        }

        $id_tracking = $this->input->post('id_tracking');
        $id_kurir    = $this->input->post('id_kurir');

        if (!$id_tracking || !$id_kurir) {
            $this->session->set_flashdata('error', 'Pengiriman dan kurir wajib dipilih.');
            redirect('admin/kurir/assign');
        }

        $kurir = $this->Kurir_model->get_by_id($id_kurir);

        if (!$kurir || $kurir['status'] != 'Active') {
            $this->session->set_flashdata('error', 'Kurir tidak tersedia atau sedang tidak aktif.');
            redirect('admin/kurir/assign');
        }

        $success = $this->Kurir_model->assign_kurir($id_tracking, $id_kurir);

        if ($success) {
            $this->session->set_flashdata('success', 'Kurir berhasil ditugaskan untuk pengiriman ini.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menugaskan kurir. Silakan coba lagi.');
        }

        redirect('admin/kurir/assign');
    }

    // ============================================
    // VALIDASI FORM (tambah & edit)
    // ============================================
    private function _validate()
    {
        // Mengatur pesan bahasa Indonesia untuk semua kolom sekaligus
$this->form_validation->set_message('required', 'Kolom {field} wajib diisi.');
$this->form_validation->set_message('min_length', 'Kolom {field} harus memiliki minimal {param} karakter.');
$this->form_validation->set_message('max_length', 'Kolom {field} tidak boleh lebih dari {param} karakter.');
$this->form_validation->set_message('numeric', 'Kolom {field} harus berupa angka.');
$this->form_validation->set_message('valid_email', 'Format {field} tidak valid.');
$this->form_validation->set_message('in_list', '{field} yang dipilih tidak sesuai dengan pilihan yang tersedia.');
        $this->form_validation->set_rules('nama_kurir', 'Nama Kurir', 'required|trim|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('no_telepon', 'No. Telepon', 'required|trim|numeric|min_length[9]|max_length[20]');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|max_length[100]');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[Active,Inactive,Offline]');
    }
}
