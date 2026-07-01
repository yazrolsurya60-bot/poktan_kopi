<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // Ensure admin logged in
        if (!$this->session->userdata('id_user') || $this->session->userdata('role') !== 'Admin') {
            redirect('auth/login');
        }
        $this->load->model('User_model');
        $this->load->model('Notifikasi_model'); // 🔴 TAMBAHKAN INI!
        $this->load->helper(['url', 'form']);
    }

    // List all users
    public function index() {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Admin';
        
        $search = $this->input->get('search');
        $role = $this->input->get('role');
        $status = $this->input->get('status');
        
        $data['users'] = $this->User_model->get_all_users($search, $role, $status);
        $data['search'] = $search;
        $data['role'] = $role;
        $data['status'] = $status;
        
        $this->load->view('admin/users/v_manajemen_user', $data);
    }

    // List unverified petani (for verification)
    public function unverified_petani() {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Admin';
        
        $data['petani'] = $this->User_model->get_unverified_petani();
        $this->load->view('admin/users/v_verifikasi_petani', $data);
    }

    // Verify petani account
    public function verify_petani($id) {
        $user = $this->User_model->get_by_id($id);
        
        if (!$user || $user['role'] !== 'Petani') {
            $this->session->set_flashdata('error', 'User tidak ditemukan atau bukan Petani.');
            redirect('admin/users/unverified_petani');
        }

        if ($this->User_model->verify_petani($id)) {
            // Kirim notifikasi ke petani
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
        
        redirect('admin/users/unverified_petani');
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
        
        redirect('admin/users/unverified_petani');
    }

    // Activate user account
    public function activate($id) {
        $user = $this->User_model->get_by_id($id);
        
        if (!$user) {
            if ($this->input->is_ajax_request()) {
                echo json_encode(['success' => false, 'message' => 'User tidak ditemukan.']);
            } else {
                $this->session->set_flashdata('error', 'User tidak ditemukan.');
                redirect('admin/users');
            }
            return;
        }

        if ($this->User_model->set_user_status($id, 'Active')) {
            if ($this->input->is_ajax_request()) {
                echo json_encode(['success' => true, 'message' => 'Akun diaktifkan.']);
            } else {
                $this->session->set_flashdata('success', 'Akun ' . $user['nama'] . ' berhasil diaktifkan.');
                redirect('admin/users');
            }
        } else {
            if ($this->input->is_ajax_request()) {
                echo json_encode(['success' => false, 'message' => 'Gagal mengaktifkan akun.']);
            } else {
                $this->session->set_flashdata('error', 'Gagal mengaktifkan akun.');
                redirect('admin/users');
            }
        }
    }

    // Deactivate user account
    public function deactivate($id) {
        $user = $this->User_model->get_by_id($id);
        
        if (!$user) {
            if ($this->input->is_ajax_request()) {
                echo json_encode(['success' => false, 'message' => 'User tidak ditemukan.']);
            } else {
                $this->session->set_flashdata('error', 'User tidak ditemukan.');
                redirect('admin/users');
            }
            return;
        }

        if ($this->User_model->set_user_status($id, 'Inactive')) {
            if ($this->input->is_ajax_request()) {
                echo json_encode(['success' => true, 'message' => 'Akun dinonaktifkan.']);
            } else {
                $this->session->set_flashdata('success', 'Akun ' . $user['nama'] . ' berhasil dinonaktifkan.');
                redirect('admin/users');
            }
        } else {
            if ($this->input->is_ajax_request()) {
                echo json_encode(['success' => false, 'message' => 'Gagal menonaktifkan akun.']);
            } else {
                $this->session->set_flashdata('error', 'Gagal menonaktifkan akun.');
                redirect('admin/users');
            }
        }
    }

    // Toggle user status (AJAX)
    public function toggle_status($id) {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $user = $this->User_model->get_by_id($id);
        
        if (!$user) {
            echo json_encode(['success' => false, 'message' => 'User tidak ditemukan.']);
            return;
        }

        $new_status = ($user['status'] === 'Active') ? 'Inactive' : 'Active';
        
        if ($this->User_model->set_user_status($id, $new_status)) {
            echo json_encode([
                'success' => true,
                'message' => 'Status diperbarui menjadi ' . $new_status,
                'new_status' => $new_status
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal mengubah status.']);
        }
    }

    // View user details
    public function view($id) {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Admin';
        
        $user = $this->User_model->get_by_id($id);
        
        if (!$user) {
            show_404();
        }

        $data['user'] = $user;
        $this->load->view('admin/users/v_detail_user', $data);
    }

    // Add new user
    public function add() {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Admin';
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim|max_length[100]');
            $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[4]|max_length[50]|is_unique[tb_user.username]');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_user.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('no_telepon', 'Nomor Telepon', 'required|trim');
            $this->form_validation->set_rules('role', 'Role', 'required|in_list[Admin,Petani,Pembeli,Guest]');

            if ($this->form_validation->run() == TRUE) {
                $no_telepon = $this->input->post('no_telepon', TRUE);
                
                // Format phone number
                $no_telepon_formatted = format_phone_number($no_telepon);
                
                // Check if phone already exists
                $existing_phone = $this->User_model->get_by_phone($no_telepon_formatted);
                if ($existing_phone) {
                    $this->session->set_flashdata('error', 'Nomor telepon sudah terdaftar.');
                    redirect('admin/user/add');
                }

                $userData = [
                    'nama' => $this->input->post('nama', TRUE),
                    'username' => strtolower($this->input->post('username', TRUE)),
                    'email' => $this->input->post('email', TRUE),
                    'password' => $this->input->post('password'),
                    'no_telepon' => $no_telepon_formatted,
                    'role' => $this->input->post('role'),
                    'status' => 'Active',
                    'is_verified' => ($this->input->post('role') === 'Petani') ? '0' : '1'
                ];

                $userId = $this->User_model->insert_user($userData);

                if ($userId) {
                    $this->session->set_flashdata('success', 'User berhasil ditambahkan.');
                    redirect('admin/user');
                } else {
                    $this->session->set_flashdata('error', 'Gagal menambahkan user.');
                    redirect('admin/user/add');
                }
            }
        }

        $this->load->view('admin/users/add', $data);
    }

    // Edit user
    public function edit($id = null) {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Admin';
        
        if (!$id) {
            redirect('admin/user');
        }

        $user = $this->User_model->get_by_id($id);
        
        if (!$user) {
            $this->session->set_flashdata('error', 'User tidak ditemukan.');
            redirect('admin/user');
        }

        if ($this->input->post()) {
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim|max_length[100]');
            $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[4]|max_length[50]');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
            $this->form_validation->set_rules('role', 'Role', 'required|in_list[Admin,Petani,Pembeli,Guest]');

            if ($this->form_validation->run() == TRUE) {
                $username = strtolower($this->input->post('username', TRUE));
                $email = $this->input->post('email', TRUE);

                // Check username uniqueness (excluding current user)
                $existing_user = $this->User_model->get_by_username($username);
                if ($existing_user && $existing_user['id_user'] != $id) {
                    $this->session->set_flashdata('error', 'Username sudah digunakan.');
                    redirect('admin/user/edit/' . $id);
                }

                // Check email uniqueness (excluding current user)
                $existing_email = $this->User_model->get_by_email($email);
                if ($existing_email && $existing_email['id_user'] != $id) {
                    $this->session->set_flashdata('error', 'Email sudah digunakan.');
                    redirect('admin/user/edit/' . $id);
                }

                $updateData = [
                    'nama' => $this->input->post('nama', TRUE),
                    'username' => $username,
                    'email' => $email,
                    'role' => $this->input->post('role')
                ];

                // Update password if provided
                $password = $this->input->post('password');
                if (!empty($password)) {
                    $updateData['password'] = $password;
                }

                // Update phone number if provided
                $no_telepon = $this->input->post('no_telepon', TRUE);
                if (!empty($no_telepon)) {
                    $no_telepon_formatted = format_phone_number($no_telepon);
                    
                    // Check if phone is used by another user
                    $existing_phone = $this->User_model->get_by_phone($no_telepon_formatted);
                    if ($existing_phone && $existing_phone['id_user'] != $id) {
                        $this->session->set_flashdata('error', 'Nomor telepon sudah digunakan oleh user lain.');
                        redirect('admin/user/edit/' . $id);
                    }
                    
                    $updateData['no_telepon'] = $no_telepon_formatted;
                }

                // Update verification status for Petani
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
            }
        }

        $data['user'] = $user;
        $this->load->view('admin/users/edit', $data);
    }

    // Delete user
    public function delete($id) {
        $user = $this->User_model->get_by_id($id);
        
        if (!$user) {
            $this->session->set_flashdata('error', 'User tidak ditemukan.');
            redirect('admin/user');
        }

        // Don't allow deleting admin
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
