<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper('notifikasi');
        
        // Cek login dan role admin
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login');
        }
        if ($this->session->userdata('role') != 'Admin') {
            redirect('auth/login');
        }
    }

    /**
     * Verifikasi petani (M02-F06)
     * URL: admin/verifikasi/petani/{id_user}
     */
    public function petani($id_user)
    {
        // Dapatkan data user
        $user = $this->User_model->get_by_id($id_user);
        if (!$user || $user['role'] != 'Petani') {
            $this->session->set_flashdata('error', 'Petani tidak ditemukan.');
            redirect('admin/user');
        }

        // Update status verifikasi
        $this->User_model->verify_petani($id_user);

        // ============================================
        // 🔴 KIRIM NOTIFIKASI KE PETANI
        // ============================================
        send_notifikasi(
            $id_user,
            'petani',
            '✅ Akun Petani Terverifikasi',
            "Selamat, akun Anda sebagai Petani telah diverifikasi oleh Admin. Anda sekarang bisa login dan mengakses semua fitur.",
            'success',
            base_url('auth/login')
        );

        // Kirim notifikasi ke semua admin lain
        $admins = $this->User_model->get_users_by_role('Admin');
        foreach ($admins as $admin) {
            if ($admin['id_user'] != $this->session->userdata('id_user')) {
                send_notifikasi(
                    $admin['id_user'],
                    'admin',
                    'Petani Terverifikasi',
                    "Petani {$user['nama']} telah diverifikasi oleh " . $this->session->userdata('nama'),
                    'success',
                    base_url('admin/user')
                );
            }
        }

        $this->session->set_flashdata('success', 'Petani berhasil diverifikasi dan notifikasi telah dikirim.');
        redirect('admin/user');
    }

    /**
     * Tolak verifikasi petani
     * URL: admin/verifikasi/tolak/{id_user}
     */
    public function tolak($id_user)
    {
        $user = $this->User_model->get_by_id($id_user);
        if (!$user || $user['role'] != 'Petani') {
            $this->session->set_flashdata('error', 'Petani tidak ditemukan.');
            redirect('admin/user');
        }

        // Update status
        $this->User_model->reject_petani($id_user);

        // ============================================
        // 🔴 KIRIM NOTIFIKASI KE PETANI
        // ============================================
        send_notifikasi(
            $id_user,
            'petani',
            '❌ Verifikasi Petani Ditolak',
            "Maaf, akun Anda sebagai Petani ditolak. Silakan hubungi admin untuk informasi lebih lanjut.",
            'danger',
            base_url('auth/login')
        );

        $this->session->set_flashdata('error', 'Verifikasi petani ditolak dan notifikasi telah dikirim.');
        redirect('admin/user');
    }
}
