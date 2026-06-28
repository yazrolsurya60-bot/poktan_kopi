<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    private function check_already_logged_in()
    {
        if ($this->session->userdata('id_user')) {
            $role = $this->session->userdata('role');
            if ($role === 'Admin') {
                redirect('admin/dashboard');
            } elseif ($role === 'Petani') {
                redirect('petani/dashboard');
            } elseif ($role === 'Pembeli') {
                redirect('pembeli/dashboard');
            }
        }
    }

    public function login()
    {
        $this->check_already_logged_in();

        if ($this->input->post()) {
            $username_or_email = $this->input->post('username_or_email', TRUE);
            $password = $this->input->post('password');

            $this->form_validation->set_rules('username_or_email', 'Username atau Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == TRUE) {
                $user = $this->User_model->login($username_or_email, $password);

                if ($user) {
                    if ($user['status'] === 'Active') {
                        $this->session->set_userdata([
                            'id_user' => $user['id_user'],
                            'username' => $user['username'],
                            'nama' => $user['nama'],
                            'email' => $user['email'],
                            'role' => $user['role'],
                            'foto' => $user['foto'],
                            'status' => $user['status']
                        ]);

                        $this->session->set_flashdata('success', 'Selamat datang kembali, ' . $user['nama'] . '!');

                        if ($user['role'] === 'Admin') {
                            redirect('admin/dashboard');
                        } elseif ($user['role'] === 'Petani') {
                            redirect('petani/dashboard');
                        } else {
                            redirect('pembeli/dashboard');
                        }
                    } elseif ($user['status'] === 'Pending') {
                        // Generate mock verification token in case they need to verify
                        if (empty($user['verification_token'])) {
                            $token = md5($user['email'] . time());
                            $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
                            $this->User_model->update_user($user['id_user'], [
                                'verification_token' => $token,
                                'token_expiry' => $expiry
                            ]);
                            $user['verification_token'] = $token;
                        }

                        $this->session->set_flashdata('verify_needed', [
                            'id_user' => $user['id_user'],
                            'email' => $user['email'],
                            'token' => $user['verification_token']
                        ]);
                        $this->session->set_flashdata('error', 'Akun Anda belum aktif. Silakan verifikasi email Anda terlebih dahulu.');
                    } else {
                        $this->session->set_flashdata('error', 'Akun Anda dinonaktifkan. Silakan hubungi Administrator.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Username/Email atau Password salah.');
                }
            }
        }

        $this->load->view('auth/v_login');
    }

    public function register()
    {
        $this->check_already_logged_in();

        if ($this->input->post()) {
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim|max_length[100]');
            $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[4]|max_length[50]|is_unique[tb_user.username]');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_user.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('role', 'Role', 'required|in_list[Petani,Pembeli]');

            if ($this->form_validation->run() == TRUE) {
                $token = md5($this->input->post('email') . time());
                $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

                $userData = [
                    'nama' => $this->input->post('nama', TRUE),
                    'username' => strtolower($this->input->post('username', TRUE)),
                    'email' => $this->input->post('email', TRUE),
                    'password' => $this->input->post('password'),
                    'role' => $this->input->post('role'),
                    'status' => 'Pending',
                    'verification_token' => $token,
                    'token_expiry' => $expiry
                ];

                $userId = $this->User_model->insert_user($userData);

                if ($userId) {
                    $this->session->set_flashdata('register_success', [
                        'email' => $userData['email'],
                        'token' => $token
                    ]);
                    redirect('auth/register');
                } else {
                    $this->session->set_flashdata('error', 'Pendaftaran gagal. Silakan coba lagi.');
                }
            }
        }

        $this->load->view('auth/v_register');
    }

    public function verify($token)
    {
        $user = $this->User_model->verify_token($token, 'verification');

        if ($user) {
            $this->User_model->update_user($user['id_user'], [
                'status' => 'Active',
                'verification_token' => NULL,
                'token_expiry' => NULL
            ]);

            $this->session->set_flashdata('success', 'Email berhasil diverifikasi! Silakan login.');
            redirect('auth/login');
        } else {
            $this->session->set_flashdata('error', 'Token verifikasi tidak valid atau telah kedaluwarsa.');
            redirect('auth/login');
        }
    }

    public function forgot_password()
    {
        $this->check_already_logged_in();

        if ($this->input->post()) {
            $email = $this->input->post('email', TRUE);
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            if ($this->form_validation->run() == TRUE) {
                $user = $this->User_model->get_by_email($email);

                if ($user) {
                    $token = md5($email . time());
                    $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

                    $this->User_model->update_user($user['id_user'], [
                        'reset_token' => $token,
                        'token_expiry' => $expiry
                    ]);

                    $this->session->set_flashdata('reset_success', [
                        'email' => $email,
                        'token' => $token
                    ]);
                    redirect('auth/forgot_password');
                } else {
                    $this->session->set_flashdata('error', 'Email tidak ditemukan.');
                }
            }
        }

        $this->load->view('auth/v_forgot_password');
    }

    public function reset_password($token)
    {
        $this->check_already_logged_in();
        $user = $this->User_model->verify_token($token, 'reset');

        if (!$user) {
            $this->session->set_flashdata('error', 'Link reset password tidak valid atau telah kedaluwarsa.');
            redirect('auth/forgot_password');
        }

        if ($this->input->post()) {
            $this->form_validation->set_rules('password', 'Password Baru', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password Baru', 'required|matches[password]');

            if ($this->form_validation->run() == TRUE) {
                $this->User_model->update_user($user['id_user'], [
                    'password' => $this->input->post('password'),
                    'reset_token' => NULL,
                    'token_expiry' => NULL
                ]);

                $this->session->set_flashdata('success', 'Password Anda berhasil diperbarui. Silakan login dengan password baru.');
                redirect('auth/login');
            }
        }

        $data['token'] = $token;
        $this->load->view('auth/v_reset_password', $data);
    }

    public function profile()
    {
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login');
        }

        $id_user = $this->session->userdata('id_user');
        $user = $this->User_model->get_by_id($id_user);

        if ($this->input->post('action') === 'update_profile') {
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim|max_length[100]');
            $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[4]|max_length[50]');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

            // Validate uniqueness manually since we need to ignore current user ID
            $username = strtolower($this->input->post('username', TRUE));
            $email = $this->input->post('email', TRUE);

            $existing_user = $this->User_model->get_by_username($username);
            if ($existing_user && $existing_user['id_user'] != $id_user) {
                $this->form_validation->set_message('username', 'Username sudah digunakan.');
                $this->form_validation->set_rules('username', 'Username', 'is_unique[tb_user.username]'); // trigger validation error
            }

            $existing_email = $this->User_model->get_by_email($email);
            if ($existing_email && $existing_email['id_user'] != $id_user) {
                $this->form_validation->set_message('email', 'Email sudah digunakan.');
                $this->form_validation->set_rules('email', 'Email', 'is_unique[tb_user.email]'); // trigger validation error
            }

            if ($this->form_validation->run() == TRUE) {
                $updateData = [
                    'nama' => $this->input->post('nama', TRUE),
                    'username' => $username,
                    'email' => $email
                ];

                // Profile photo upload handling
                if (!empty($_FILES['foto']['name'])) {
                    // Create directory if not exists
                    if (!is_dir('./uploads/profile/')) {
                        mkdir('./uploads/profile/', 0777, TRUE);
                    }

                    $config['upload_path'] = './uploads/profile/';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['max_size'] = 2048;
                    $config['encrypt_name'] = TRUE;

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('foto')) {
                        // Delete old profile picture if exists
                        if (!empty($user['foto']) && file_exists('./uploads/profile/' . $user['foto'])) {
                            unlink('./uploads/profile/' . $user['foto']);
                        }

                        $uploadData = $this->upload->data();
                        $updateData['foto'] = $uploadData['file_name'];

                        // Update session foto
                        $this->session->set_userdata('foto', $uploadData['file_name']);
                    } else {
                        $this->session->set_flashdata('error', 'Gagal mengupload foto: ' . $this->upload->display_errors('', ''));
                        redirect('auth/profile');
                    }
                }

                if ($this->User_model->update_user($id_user, $updateData)) {
                    // Update session data
                    $this->session->set_userdata([
                        'nama' => $updateData['nama'],
                        'username' => $updateData['username'],
                        'email' => $updateData['email']
                    ]);

                    $this->session->set_flashdata('success', 'Profil Anda berhasil diperbarui.');
                } else {
                    $this->session->set_flashdata('error', 'Gagal memperbarui profil.');
                }
                redirect('auth/profile');
            }
        }

        // Change password action
        if ($this->input->post('action') === 'change_password') {
            $this->form_validation->set_rules('current_password', 'Password Saat Ini', 'required');
            $this->form_validation->set_rules('new_password', 'Password Baru', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_new_password', 'Konfirmasi Password Baru', 'required|matches[new_password]');

            if ($this->form_validation->run() == TRUE) {
                $current_password = $this->input->post('current_password');
                $new_password = $this->input->post('new_password');

                if (md5($current_password) === $user['password']) {
                    if ($this->User_model->update_user($id_user, ['password' => $new_password])) {
                        $this->session->set_flashdata('success', 'Password Anda berhasil diperbarui.');
                    } else {
                        $this->session->set_flashdata('error', 'Gagal memperbarui password.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Password saat ini salah.');
                }
                redirect('auth/profile');
            }
        }

        $data['user'] = $this->User_model->get_by_id($id_user);

        // Load layout based on user role to keep the panel context consistent
        $this->load->model('Notifikasi_model');
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);

        $this->load->view('auth/v_profile', $data);
    }

    // application/controllers/Auth.php

    public function ubah_password()
    {
        // Cek login
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login');
        }

        $this->form_validation->set_rules('password_lama', 'Password Lama', 'required');
        $this->form_validation->set_rules('password_baru', 'Password Baru', 'required|min_length[6]');
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'required|matches[password_baru]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/v_ubah_password');
        } else {
            $id_user = $this->session->userdata('id_user');
            $password_lama = md5($this->input->post('password_lama'));
            $password_baru = md5($this->input->post('password_baru'));

            // Cek password lama di DATABASE
            $user = $this->db->get_where('tb_user', [
                'id_user' => $id_user,
                'password' => $password_lama
            ])->row();

            if ($user) {
                // ✅ UPDATE PASSWORD DI DATABASE
                $this->db->where('id_user', $id_user)
                    ->update('tb_user', ['password' => $password_baru]);

                $this->session->set_flashdata('success', 'Password berhasil diubah!');
                redirect('auth/ubah_password');
            } else {
                $this->session->set_flashdata('error', 'Password lama salah!');
                redirect('auth/ubah_password');
            }
        }
    }


    public function logout()
    {
        $this->session->sess_destroy();
        redirect('beranda');
    }
}
