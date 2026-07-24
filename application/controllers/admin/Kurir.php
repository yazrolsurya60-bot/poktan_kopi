<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurir extends CI_Controller
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

        $this->load->model('Kurir_model');
        $this->load->model('Notifikasi_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

public function index()
    {
        $id_user = $this->session->userdata('id_user');
        
        // SESUAIKAN DENGAN NAMAN VARIABEL TEMPLATE: 'title_page'
        $data['title']         = 'Manajemen Kurir - Sistem Supply Chain Kopi';
        $data['title_page']    = 'Manajemen Kurir';
        $data['subtitle']      = 'Kelola data kurir pengiriman Poktan Liberchain';
        $data['notifikasi']    = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count']  = $this->Notifikasi_model->count_unread($id_user);
        $data['role']          = 'Admin';
        
        $status_filter = $this->input->get('status');
        $keyword       = $this->input->get('keyword');

        $data['list_kurir']     = $this->Kurir_model->get_all($status_filter, $keyword);
        $data['keyword']        = $keyword;
        $data['kurir_active']   = $this->Kurir_model->count_by_status('Active');
        $data['kurir_inactive'] = $this->Kurir_model->count_by_status('Inactive');

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('admin/kurir/index', $data);
        $this->load->view('templates/admin/footer');
    }

    public function detail($id_kurir = null)
    {
        $id_user = $this->session->userdata('id_user');
        
        // SESUAIKAN DENGAN NAMAN VARIABEL TEMPLATE: 'title_page'
        $data['title']        = 'Detail Kurir - Sistem Supply Chain Kopi';
        $data['title_page']   = 'Detail Kurir';
        $data['subtitle']     = 'Profil kurir & riwayat seluruh pengiriman yang ditangani';
        $data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role']         = 'Admin';
        
        $detail = $this->Kurir_model->get_detail_with_history($id_kurir);

        if (!$detail) {
            $this->session->set_flashdata('error', 'Data kurir tidak ditemukan.');
            redirect('admin/kurir');
        }

        $data['kurir']      = $detail['kurir'];
        $data['pengiriman'] = $detail['pengiriman'];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('admin/kurir/detail', $data);
        $this->load->view('templates/admin/footer');
    }

    public function performance()
    {
        $id_user = $this->session->userdata('id_user');
        
        // SESUAIKAN DENGAN NAMAN VARIABEL TEMPLATE: 'title_page'
        $data['title']        = 'Performance Kurir - Sistem Supply Chain Kopi';
        $data['title_page']   = 'Performance Kurir';
        $data['subtitle']     = 'Laporan kinerja seluruh kurir berdasarkan riwayat pengiriman';
        $data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role']         = 'Admin';
        
        $data['performance']  = $this->Kurir_model->get_performance_kurir();

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('admin/kurir/performance', $data);
        $this->load->view('templates/admin/footer');
    }
    
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

        $this->load->helper('notifikasi');
        send_notifikasi(
            $this->session->userdata('id_user'),
            'Admin',
            '🚚 Kurir Baru Ditambahkan',
            'Kurir ' . $data['nama_kurir'] . ' telah ditambahkan ke sistem.',
            'success',
            base_url('admin/kurir')
        );

        $this->session->set_flashdata('success', 'Kurir baru berhasil ditambahkan.');
        redirect('admin/kurir');
    }

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

    public function toggle($id_kurir = null)
    {
        $kurir = $this->Kurir_model->get_by_id($id_kurir);

        if (!$kurir) {
            $this->session->set_flashdata('error', 'Data kurir tidak ditemukan.');
            redirect('admin/kurir');
        }

        $status_baru = ($kurir['status'] == 'Active') ? 'Inactive' : 'Active';
        $this->Kurir_model->update($id_kurir, ['status' => $status_baru]);

        $this->load->helper('notifikasi');
        send_notifikasi(
            $this->session->userdata('id_user'),
            'Admin',
            '🔄 Status Kurir Diubah',
            'Status kurir ' . $kurir['nama_kurir'] . ' diubah menjadi ' . $status_baru . '.',
            'warning',
            base_url('admin/kurir')
        );

        $this->session->set_flashdata('success', 'Status kurir diubah menjadi ' . $status_baru . '.');
        redirect('admin/kurir');
    }

    private function _validate()
    {
        $this->form_validation->set_rules('nama_kurir', 'Nama Kurir', 'required|trim|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('no_telepon', 'No. Telepon', 'required|trim|numeric|min_length[9]|max_length[20]');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|max_length[100]');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[Active,Inactive]');
    }
}