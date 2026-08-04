<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id_user') || $this->session->userdata('role') !== 'Admin') {
            redirect('auth/login');
        }
        $this->load->model('User_model');
        $this->load->model('Notifikasi_model');
        $this->load->helper(['url', 'form']);
    }

    // List all users
    public function index() {
        $id_user = $this->session->userdata('id_user');
        
        $data['title']        = 'Manajemen User - Sistem Supply Chain Kopi';
        $data['title_page']   = 'Manajemen User';
        $data['subtitle']     = 'Kelola data user aplikasi';
        $data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role']         = 'Admin';
        
        $search = $this->input->get('search');
        $role   = $this->input->get('role');
        $status = $this->input->get('status');
        
        $data['users']       = $this->User_model->get_all_users($search, $role, $status);
        $data['search']      = $search;
        $data['role_filter'] = $role;
        $data['status']      = $status;
        
        $this->load->view('templates/admin/header', $data);
        $this->load->view('admin/users/v_manajemen_user', $data);
        $this->load->view('templates/admin/footer', $data);
    }

    // List unverified petani
    public function unverified_petani() {
        $id_user = $this->session->userdata('id_user');
        
        $data['title']        = 'Verifikasi Petani - Sistem Supply Chain Kopi';
        $data['title_page']   = 'Verifikasi Akun Petani';
        $data['subtitle']     = 'Kelola permintaan verifikasi akun dari calon petani yang baru mendaftar';
        $data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role']         = 'Admin';
        
        $data['petani']       = $this->User_model->get_unverified_petani();
        
        $this->load->view('templates/admin/header', $data);
        $this->load->view('admin/users/v_verifikasi_petani', $data);
        $this->load->view('templates/admin/footer', $data);
    }

    // Verify petani account
    public function verify_petani($id) {
        $user = $this->User_model->get_by_id($id);
        if (!$user || $user['role'] !== 'Petani') {
            $this->session->set_flashdata('error', 'User tidak ditemukan atau bukan Petani.');
            redirect('admin/users/unverified_petani');
        }

        if ($this->User_model->verify_petani($id)) {
            $this->load->helper('notifikasi');
            send_notifikasi(
                $id,
                'Petani',
                '✅ Akun Terverifikasi',
                'Akun Petani Anda telah diverifikasi oleh Admin. Anda sekarang dapat mengelola lahan dan produk.',
                'success',
                base_url('petani/dashboard')
            );
            $this->session->set_flashdata('success', 'Akun Petani ' . $user['nama'] . ' berhasil diverifikasi.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memverifikasi akun Petani.');
        }
        redirect('admin/user');
    }

    // Reject petani account
    public function reject_petani($id) {
        $user = $this->User_model->get_by_id($id);
        if (!$user || $user['role'] !== 'Petani') {
            $this->session->set_flashdata('error', 'User tidak ditemukan atau bukan Petani.');
            redirect('admin/users/unverified_petani');
        }

        if ($this->User_model->reject_petani($id)) {
            $this->session->set_flashdata('success', 'Akun Petani ' . $user['nama'] . ' ditolak.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menolak akun Petani.');
        }
        redirect('admin/user');
    }

    // Activate user
    public function activate($id) {
        $user = $this->User_model->get_by_id($id);
        if (!$user) {
            $this->session->set_flashdata('error', 'User tidak ditemukan.');
            redirect('admin/user');
            return;
        }

        if ($this->User_model->set_user_status($id, 'Active')) {
            $this->session->set_flashdata('success', 'Akun ' . $user['nama'] . ' berhasil diaktifkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengaktifkan akun.');
        }
        redirect('admin/user');
    }

    // Deactivate user
    public function deactivate($id) {
        $user = $this->User_model->get_by_id($id);
        if (!$user) {
            $this->session->set_flashdata('error', 'User tidak ditemukan.');
            redirect('admin/user');
            return;
        }

        if ($this->User_model->set_user_status($id, 'Inactive')) {
            $this->session->set_flashdata('success', 'Akun ' . $user['nama'] . ' berhasil dinonaktifkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menonaktifkan akun.');
        }
        redirect('admin/user');
    }

    // View user detail
    public function view($id) {
        $id_user = $this->session->userdata('id_user');
        $data['title']        = 'Detail User - Sistem Supply Chain Kopi';
        $data['title_page']   = 'Detail User';
        $data['subtitle']     = 'Informasi lengkap data pengguna';
        $data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role']         = 'Admin';
        
        $user = $this->User_model->get_by_id($id);
        if (!$user) { show_404(); }

        $data['user'] = $user;
        $this->load->view('templates/admin/header', $data);
        $this->load->view('admin/users/v_detail_user', $data);
        $this->load->view('templates/admin/footer', $data);
    }

    // Add user
    public function add() {
        $id_user = $this->session->userdata('id_user');
        $data['title']        = 'Tambah User - Sistem Supply Chain Kopi';
        $data['title_page']   = 'Tambah User';
        $data['subtitle']     = 'Tambahkan user baru ke sistem';
        $data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role']         = 'Admin';
        
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim|max_length[100]');
            $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[4]|max_length[50]|is_unique[tb_user.username]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('no_telepon', 'Nomor Telepon', 'required|trim');
            $this->form_validation->set_rules('role', 'Role', 'required');

            if ($this->form_validation->run() == TRUE) {
                $no_telepon = $this->input->post('no_telepon', TRUE);
                if (function_exists('format_phone_number')) {
                    $no_telepon = format_phone_number($no_telepon);
                }
                
                if ($this->User_model->get_by_phone($no_telepon)) {
                    $this->session->set_flashdata('error', 'Nomor telepon sudah terdaftar.');
                    redirect('admin/user/add');
                    return;
                }

                $userData = [
                    'nama'        => $this->input->post('nama', TRUE),
                    'username'    => strtolower($this->input->post('username', TRUE)),
                    'password'    => $this->input->post('password'),
                    'no_telepon'  => $no_telepon,
                    'role'        => $this->input->post('role'),
                    'status'      => 'Active',
                    'is_verified' => ($this->input->post('role') === 'Petani') ? '0' : '1'
                ];

                if ($this->User_model->insert_user($userData)) {
                    $this->session->set_flashdata('success', 'User berhasil ditambahkan.');
                    redirect('admin/user');
                } else {
                    $this->session->set_flashdata('error', 'Gagal menambahkan user.');
                    redirect('admin/user/add');
                }
                return;
            } else {
                $this->session->set_flashdata('error', validation_errors());
            }
        }

        $this->load->view('templates/admin/header', $data);
        $this->load->view('admin/users/add', $data);
        $this->load->view('templates/admin/footer', $data);
    }

    // Edit user
    public function edit($id = null) {
        $id_user = $this->session->userdata('id_user');
        $data['title']        = 'Edit User - Sistem Supply Chain Kopi';
        $data['title_page']   = 'Edit User';
        $data['subtitle']     = 'Edit data user yang sudah terdaftar';
        $data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role']         = 'Admin';
        
        if (!$id) { redirect('admin/user'); }

        $user = $this->User_model->get_by_id($id);
        if (!$user) {
            $this->session->set_flashdata('error', 'User tidak ditemukan.');
            redirect('admin/user');
        }

        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim|max_length[100]');
            $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[4]|max_length[50]');
            $this->form_validation->set_rules('role', 'Role', 'required');

            if ($this->form_validation->run() == TRUE) {
                $username = strtolower($this->input->post('username', TRUE));

                $existing_user = $this->User_model->get_by_username($username);
                if ($existing_user && $existing_user['id_user'] != $id) {
                    $this->session->set_flashdata('error', 'Username sudah digunakan.');
                    redirect('admin/user/edit/' . $id);
                    return;
                }

                $updateData = [
                    'nama'     => $this->input->post('nama', TRUE),
                    'username' => $username,
                    'role'     => $this->input->post('role')
                ];

                $password = $this->input->post('password');
                if (!empty($password)) { 
                    // Gunakan model method agar konsisten dengan insert_user
                    $updateData['password'] = $password; 
                }

                $no_telepon = $this->input->post('no_telepon', TRUE);
                if (!empty($no_telepon)) {
                    $no_telepon_formatted = function_exists('format_phone_number') ? format_phone_number($no_telepon) : $no_telepon;
                    $existing_phone = $this->User_model->get_by_phone($no_telepon_formatted);
                    if ($existing_phone && $existing_phone['id_user'] != $id) {
                        $this->session->set_flashdata('error', 'Nomor telepon sudah digunakan oleh user lain.');
                        redirect('admin/user/edit/' . $id);
                        return;
                    }
                    $updateData['no_telepon'] = $no_telepon_formatted;
                }

                if ($this->input->post('role') === 'Petani') {
                    $updateData['is_verified'] = $this->input->post('is_verified') ?? $user['is_verified'];
                }

                if ($this->User_model->update_user($id, $updateData)) {
                    $this->session->set_flashdata('success', 'User berhasil diperbarui.');
                    redirect('admin/user');
                } else {
                    $this->session->set_flashdata('error', 'Gagal memperbarui user.');
                    redirect('admin/user/edit/' . $id);
                }
                return;
            } else {
                $this->session->set_flashdata('error', validation_errors());
            }
        }

        $data['user'] = $user;
        $this->load->view('templates/admin/header', $data);
        $this->load->view('admin/users/edit', $data);
        $this->load->view('templates/admin/footer', $data);
    }

    // Delete user
    public function delete($id) {
        $user = $this->User_model->get_by_id($id);
        if (!$user) {
            $this->session->set_flashdata('error', 'User tidak ditemukan.');
            redirect('admin/user');
        }

        if ($user['role'] === 'Admin') {
            $this->session->set_flashdata('error', 'Tidak dapat menghapus akun Admin.');
            redirect('admin/user');
        }

        if ($this->User_model->delete_user($id)) {
            $this->session->set_flashdata('success', 'User ' . $user['nama'] . ' berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus user.');
        }
        redirect('admin/user');
    }
}