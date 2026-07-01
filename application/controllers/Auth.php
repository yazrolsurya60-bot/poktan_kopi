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
            $username_or_no_telepon = $this->input->post('username_or_no_telepon', TRUE);
            $password = $this->input->post('password');

            $this->form_validation->set_rules('username_or_no_telepon', 'Username atau No. Telepon', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == TRUE) {
                $user = $this->User_model->login($username_or_no_telepon, $password);

                if ($user) {
                    if ($user['status'] === 'Active') {
                        if ($user['role'] === 'Petani' && $user['is_verified'] === '0') {
                            $this->session->set_flashdata('error', 'Akun Anda sebagai Petani masih menunggu verifikasi dari Administrator. Silakan tunggu.');
                            redirect('auth/login');
                        }

                        $this->session->set_userdata([
                            'id_user' => $user['id_user'],
                            'username' => $user['username'],
                            'nama' => $user['nama'],
                            'no_telepon' => $user['no_telepon'],
                            'role' => $user['role'],
                            'foto' => $user['foto'],
                            'status' => $user['status'],
                            'is_verified' => $user['is_verified']
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
                        $this->session->set_flashdata('error', 'Akun Anda belum aktif.');
                    } else {
                        $this->session->set_flashdata('error', 'Akun Anda dinonaktifkan. Silakan hubungi Administrator.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Username/No. Telepon atau Password salah.');
                }
            }
        }

        $this->load->view('auth/v_login');
    }

    public function register()
    {
        $this->check_already_logged_in();

        if ($this->input->post()) {
            $action = $this->input->post('action');

            if ($action === 'register_form') {
                $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim|max_length[100]');
                $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[4]|max_length[50]|is_unique[tb_user.username]');
                $this->form_validation->set_rules('no_telepon', 'Nomor Telepon', 'required|trim');
                $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
                $this->form_validation->set_rules('role', 'Role', 'required|in_list[Petani,Pembeli]');

                if ($this->form_validation->run() == TRUE) {
                    $no_telepon = $this->input->post('no_telepon', TRUE);
                    if (!validate_phone_number($no_telepon)) {
                        $this->session->set_flashdata('error', 'Nomor telepon tidak valid.');
                        redirect('auth/register');
                    }

                    $no_telepon_formatted = format_phone_number($no_telepon);

                    $existing_user = $this->User_model->get_by_phone($no_telepon_formatted);
                    if ($existing_user) {
                        $this->session->set_flashdata('error', 'Nomor telepon sudah terdaftar.');
                        redirect('auth/register');
                    }

                    $otp = generate_otp();

                    $this->User_model->insert_otp($no_telepon_formatted, $otp, 'whatsapp');

                    $send_result = send_otp_fonnte($no_telepon_formatted, $otp);

                    if ($send_result['status'] === 'success') {
                        $this->session->set_userdata([
                            'register_nama' => $this->input->post('nama', TRUE),
                            'register_username' => strtolower($this->input->post('username', TRUE)),
                            'register_no_telepon' => $no_telepon_formatted,
                            'register_password' => $this->input->post('password'),
                            'register_role' => $this->input->post('role'),
                            'register_step' => 'otp_verification'
                        ]);

                        $this->session->set_flashdata('success', 'OTP telah dikirim ke WhatsApp Anda. Silakan masukkan kode OTP untuk melanjutkan.');
                        redirect('auth/register');
                    } else {
                        $this->session->set_flashdata('error', 'Gagal mengirim OTP. ' . $send_result['message']);
                        redirect('auth/register');
                    }
                }
            } else if ($action === 'verify_otp') {
                $register_step = $this->session->userdata('register_step');

                if ($register_step !== 'otp_verification') {
                    $this->session->set_flashdata('error', 'Silakan mulai registrasi dari awal.');
                    redirect('auth/register');
                }

                $kode_otp = $this->input->post('kode_otp', TRUE);

                log_message('debug', 'OTP Verification - Received kode_otp: ' . $kode_otp);

                $this->form_validation->set_rules('kode_otp', 'Kode OTP', 'required|numeric|exact_length[6]');

                if ($this->form_validation->run() == FALSE) {
                    log_message('debug', 'OTP Verification - Validation failed');
                } else if (empty($kode_otp)) {
                    $this->session->set_flashdata('error', 'Mohon masukkan kode OTP.');
                    redirect('auth/register');
                } else {
                    log_message('debug', 'OTP Verification - Validation passed, verifying OTP');
                    $no_telepon = $this->session->userdata('register_no_telepon');

                    if ($this->User_model->verify_otp($no_telepon, $kode_otp, 'whatsapp')) {
                        log_message('debug', 'OTP Verification - OTP verified successfully');
                        
                        $userData = [
                            'nama' => $this->session->userdata('register_nama'),
                            'username' => $this->session->userdata('register_username'),
                            'no_telepon' => $no_telepon,
                            'password' => $this->session->userdata('register_password'),
                            'role' => $this->session->userdata('register_role'),
                            'status' => 'Active',
                            'is_verified' => ($this->session->userdata('register_role') === 'Petani') ? '0' : '1'
                        ];

                        $userId = $this->User_model->insert_user($userData);

                        if ($userId) {
                            log_message('debug', 'OTP Verification - User created with ID: ' . $userId);
                            
                            // ============================================
                            // 🔴 TAMBAHAN KODE NOTIFIKASI
                            // ============================================
                            $this->load->helper('notifikasi');
                            
                            // Dapatkan semua admin
                            $admins = $this->User_model->get_users_by_role('Admin');
                            
                            $role_text = ($userData['role'] === 'Petani') ? 'Petani (Menunggu verifikasi)' : 'Pembeli';
                            $nama = $userData['nama'];
                            $username = $userData['username'];
                            
                            // Kirim notifikasi ke semua admin
                            foreach ($admins as $admin) {
                                send_notifikasi(
                                    $admin['id_user'],
                                    'admin',
                                    'Registrasi User Baru',
                                    "User baru mendaftar: {$nama} ({$username}) sebagai {$role_text}. Menunggu verifikasi.",
                                    'primary',
                                    base_url('admin/user')
                                );
                            }
                            
                            // Jika user adalah Petani, kirim notifikasi ke petani
                            if ($userData['role'] === 'Petani') {
                                send_notifikasi(
                                    $userId,
                                    'petani',
                                    'Pendaftaran Berhasil',
                                    "Selamat, akun Anda sebagai Petani berhasil dibuat. Tunggu verifikasi dari Admin untuk bisa login.",
                                    'success',
                                    base_url('auth/login')
                                );
                            }
                            // ============================================
                            // 🔴 AKHIR TAMBAHAN KODE NOTIFIKASI
                            // ============================================
                            
                            // Clear session registrasi
                            $this->session->unset_userdata([
                                'register_nama',
                                'register_username',
                                'register_no_telepon',
                                'register_password',
                                'register_role',
                                'register_step'
                            ]);

                            $role_text_display = ($userData['role'] === 'Petani') ? 'Petani (Menunggu verifikasi admin)' : 'Pembeli';
                            $this->session->set_flashdata('success', 'Akun Anda berhasil dibuat sebagai ' . $role_text_display . '. Silakan login.');
                            redirect('auth/login');
                        } else {
                            log_message('error', 'OTP Verification - Failed to create user');
                            $this->session->set_flashdata('error', 'Gagal membuat akun. Silakan coba lagi.');
                            redirect('auth/register');
                        }
                    } else {
                        log_message('debug', 'OTP Verification - Invalid or expired OTP');
                        $this->session->set_flashdata('error', 'Kode OTP tidak valid atau telah kedaluwarsa.');
                        redirect('auth/register');
                    }
                }
            } else if ($action === 'resend_otp') {
                $register_step = $this->session->userdata('register_step');

                if ($register_step !== 'otp_verification') {
                    $this->session->set_flashdata('error', 'Silakan mulai registrasi dari awal.');
                    redirect('auth/register');
                }

                $no_telepon = $this->session->userdata('register_no_telepon');

                $this->User_model->delete_otp($no_telepon, 'whatsapp');

                $otp = generate_otp();

                $this->User_model->insert_otp($no_telepon, $otp, 'whatsapp');

                $send_result = send_otp_fonnte($no_telepon, $otp);

                if ($send_result['status'] === 'success') {
                    $this->session->set_flashdata('success', 'OTP baru telah dikirim ke WhatsApp Anda.');
                } else {
                    $this->session->set_flashdata('error', 'Gagal mengirim ulang OTP.');
                }
                redirect('auth/register');
            }
        }

        $data['register_step'] = $this->session->userdata('register_step');
        $this->load->view('auth/v_register', $data);
    }

    public function verify($token = null)
    {
        if (!empty($token)) {
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
        } else {
            redirect('auth/login');
        }
    }

    public function forgot_password()
    {
        $this->check_already_logged_in();

        if ($this->input->post()) {
            $action = $this->input->post('action');

            if ($action === 'request_otp') {
                $no_telepon = $this->input->post('no_telepon', TRUE);
                $this->form_validation->set_rules('no_telepon', 'Nomor Telepon', 'required|trim');

                if ($this->form_validation->run() == TRUE) {
                    if (!validate_phone_number($no_telepon)) {
                        $this->session->set_flashdata('error', 'Nomor telepon tidak valid.');
                        redirect('auth/forgot_password');
                    }

                    $no_telepon_formatted = format_phone_number($no_telepon);

                    $user = $this->User_model->get_by_phone($no_telepon_formatted);
                    if (!$user) {
                        $this->session->set_flashdata('error', 'Nomor telepon tidak ditemukan dalam sistem.');
                        redirect('auth/forgot_password');
                    }

                    $otp = generate_otp();

                    $this->User_model->insert_otp($no_telepon_formatted, $otp, 'whatsapp', $user['id_user']);

                    $send_result = send_otp_fonnte($no_telepon_formatted, $otp);

                    if ($send_result['status'] === 'success') {
                        $this->session->set_userdata([
                            'reset_no_telepon' => $no_telepon_formatted,
                            'reset_id_user' => $user['id_user'],
                            'reset_step' => 'otp_verification'
                        ]);

                        $this->session->set_flashdata('success', 'OTP telah dikirim ke WhatsApp Anda.');
                        redirect('auth/forgot_password');
                    } else {
                        $this->session->set_flashdata('error', 'Gagal mengirim OTP: ' . $send_result['message']);
                        redirect('auth/forgot_password');
                    }
                }
            } else if ($action === 'verify_otp_reset') {
                $reset_step = $this->session->userdata('reset_step');

                if ($reset_step !== 'otp_verification') {
                    $this->session->set_flashdata('error', 'Silakan mulai proses reset password dari awal.');
                    redirect('auth/forgot_password');
                }

                $otp = $this->input->post('otp', TRUE);
                $this->form_validation->set_rules('otp', 'Kode OTP', 'required|numeric|exact_length[6]');

                if ($this->form_validation->run() == TRUE) {
                    $no_telepon = $this->session->userdata('reset_no_telepon');

                    if ($this->User_model->verify_otp($no_telepon, $otp, 'whatsapp')) {
                        $this->session->set_userdata('reset_step', 'password_change');
                        $this->session->set_flashdata('success', 'OTP terverifikasi. Silakan masukkan password baru.');
                        redirect('auth/forgot_password');
                    } else {
                        $this->session->set_flashdata('error', 'Kode OTP tidak valid atau telah kedaluwarsa.');
                        redirect('auth/forgot_password');
                    }
                }
            } else if ($action === 'change_password') {
                $reset_step = $this->session->userdata('reset_step');

                if ($reset_step !== 'password_change') {
                    $this->session->set_flashdata('error', 'Silakan verifikasi OTP terlebih dahulu.');
                    redirect('auth/forgot_password');
                }

                $this->form_validation->set_rules('password', 'Password Baru', 'required|min_length[6]');
                $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');

                if ($this->form_validation->run() == TRUE) {
                    $id_user = $this->session->userdata('reset_id_user');

                    if ($this->User_model->update_user($id_user, ['password' => $this->input->post('password')])) {
                        $this->session->unset_userdata([
                            'reset_no_telepon',
                            'reset_id_user',
                            'reset_step'
                        ]);

                        $this->session->set_flashdata('success', 'Password Anda berhasil diperbarui. Silakan login dengan password baru.');
                        redirect('auth/login');
                    } else {
                        $this->session->set_flashdata('error', 'Gagal memperbarui password.');
                        redirect('auth/forgot_password');
                    }
                }
            } else if ($action === 'resend_otp_reset') {
                $reset_step = $this->session->userdata('reset_step');

                if ($reset_step !== 'otp_verification' && $reset_step !== 'password_change') {
                    $this->session->set_flashdata('error', 'Silakan mulai proses reset password dari awal.');
                    redirect('auth/forgot_password');
                }

                $no_telepon = $this->session->userdata('reset_no_telepon');
                $id_user = $this->session->userdata('reset_id_user');

                $this->User_model->delete_otp($no_telepon, 'whatsapp');

                $otp = generate_otp();

                $this->User_model->insert_otp($no_telepon, $otp, 'whatsapp', $id_user);

                $send_result = send_otp_fonnte($no_telepon, $otp);

                if ($send_result['status'] === 'success') {
                    $this->session->set_userdata('reset_step', 'otp_verification');
                    $this->session->set_flashdata('success', 'OTP baru telah dikirim ke WhatsApp Anda.');
                } else {
                    $this->session->set_flashdata('error', 'Gagal mengirim ulang OTP.');
                }
                redirect('auth/forgot_password');
            }
        }

        $data['reset_step'] = $this->session->userdata('reset_step');
        $this->load->view('auth/v_forgot_password', $data);
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

            $username = strtolower($this->input->post('username', TRUE));
            $email = $this->input->post('email', TRUE);

            $existing_user = $this->User_model->get_by_username($username);
            if ($existing_user && $existing_user['id_user'] != $id_user) {
                $this->form_validation->set_message('username', 'Username sudah digunakan.');
                $this->form_validation->set_rules('username', 'Username', 'is_unique[tb_user.username]');
            }

            $existing_email = $this->User_model->get_by_email($email);
            if ($existing_email && $existing_email['id_user'] != $id_user) {
                $this->form_validation->set_message('email', 'Email sudah digunakan.');
                $this->form_validation->set_rules('email', 'Email', 'is_unique[tb_user.email]');
            }

            if ($this->form_validation->run() == TRUE) {
                $updateData = [
                    'nama' => $this->input->post('nama', TRUE),
                    'username' => $username,
                    'email' => $email
                ];

                if (!empty($_FILES['foto']['name'])) {
                    if (!is_dir('./uploads/profile/')) {
                        mkdir('./uploads/profile/', 0777, TRUE);
                    }

                    $config['upload_path'] = './uploads/profile/';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['max_size'] = 2048;
                    $config['encrypt_name'] = TRUE;

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('foto')) {
                        if (!empty($user['foto']) && file_exists('./uploads/profile/' . $user['foto'])) {
                            unlink('./uploads/profile/' . $user['foto']);
                        }

                        $uploadData = $this->upload->data();
                        $updateData['foto'] = $uploadData['file_name'];

                        $this->session->set_userdata('foto', $uploadData['file_name']);
                    } else {
                        $this->session->set_flashdata('error', 'Gagal mengupload foto: ' . $this->upload->display_errors('', ''));
                        redirect('auth/profile');
                    }
                }

                if ($this->User_model->update_user($id_user, $updateData)) {
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

        $this->load->model('Notifikasi_model');
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);

        $this->load->view('auth/v_profile', $data);
    }

    public function ubah_password()
    {
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

            $user = $this->db->get_where('tb_user', [
                'id_user' => $id_user,
                'password' => $password_lama
            ])->row();

            if ($user) {
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

    // Go back to registration form from OTP step, preserve form data
    public function back_to_form()
    {
        // Keep register data but clear the OTP step so form shows again
        $this->session->unset_userdata('register_step');
        $this->session->set_flashdata('info', 'Data formulir masih tersimpan. Silakan periksa kembali.');
        redirect('auth/register');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('beranda');
    }
}
