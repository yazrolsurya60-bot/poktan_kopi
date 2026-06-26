<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // 🔴 PROTEKSI AKSES: Cek login
        if (!$this->session->userdata('id_user')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu.');
            redirect('auth/login');
        }

        // 🔴 PROTEKSI AKSES: Cek role harus Pembeli
        if ($this->session->userdata('role') != 'Pembeli') {
            $this->session->set_flashdata('error', 'Akses ditolak. Hanya untuk Member.');
            redirect('auth/login');
        }

        $this->load->model('Notifikasi_model');
        $this->load->helper('form');
        $this->load->helper('file');
        $this->load->library('form_validation');
        $this->load->library('upload');
    }

    /**
     * INDEX - Menampilkan halaman profil pembeli
     * Data diambil real-time dari database berdasarkan session id_user
     */
    public function index() {
        $id_user = $this->session->userdata('id_user');

        // 🔴 AMBIL DATA USER DARI DATABASE REAL-TIME
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('tb_user');
        $user = $query->row();

        // 🔴 CEK APAKAH DATA USER DITEMUKAN
        if (!$user) {
            $this->session->set_flashdata('error', 'Data pengguna tidak ditemukan.');
            redirect('auth/login');
        }

        // 🔴 KIRIM DATA KE VIEW
        $data['user'] = $user;

        // Data notifikasi
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);

        // Data KPI untuk statistik
        $kpi = $this->Notifikasi_model->get_pembeli_kpi($id_user);
        $data['total_transaksi'] = $kpi['total_transaksi'] ?? 0;
        $data['total_poin'] = $kpi['poin'] ?? 0;
        $data['pesanan_dikirim'] = $kpi['pesanan_dikirim'] ?? 0;
        $data['level_name'] = $this->get_level($data['total_poin']);
        $data['level_class'] = $this->get_level_class($data['total_poin']);

        // 🔴 UPDATE SESSION agar header menampilkan data terbaru
        $this->session->set_userdata([
            'nama' => $user->nama,
            'username' => $user->username,
            'email' => $user->email
        ]);

        // 🔴 LOAD VIEW DI FOLDER auth
        $this->load->view('auth/v_profile', $data);
    }

    /**
     * UPDATE - Memproses perubahan data profil
     * Validasi duplikasi username & email, upload foto, hapus foto lama
     */
    public function update() {
        $id_user = $this->session->userdata('id_user');

        // Ambil data dari form
        $nama = trim($this->input->post('nama'));
        $username = trim($this->input->post('username'));
        $email = trim($this->input->post('email'));

        // 🔴 VALIDASI: Nama wajib diisi
        if (empty($nama)) {
            $this->session->set_flashdata('error', 'Nama lengkap wajib diisi.');
            redirect('pembeli/profil');
            return;
        }

        // 🔴 VALIDASI: Username wajib diisi dan minimal 4 karakter
        if (empty($username) || strlen($username) < 4) {
            $this->session->set_flashdata('error', 'Username minimal 4 karakter.');
            redirect('pembeli/profil');
            return;
        }

        // 🔴 VALIDASI: Email wajib diisi dan format valid
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->session->set_flashdata('error', 'Email tidak valid.');
            redirect('pembeli/profil');
            return;
        }

        // 🔴 CEK DUPLIKASI USERNAME
        $this->db->where('username', $username);
        $this->db->where('id_user !=', $id_user);
        $cek_username = $this->db->get('tb_user')->num_rows();

        if ($cek_username > 0) {
            $this->session->set_flashdata('error', 'Username "' . $username . '" sudah digunakan oleh pengguna lain.');
            redirect('pembeli/profil');
            return;
        }

        // 🔴 CEK DUPLIKASI EMAIL
        $this->db->where('email', $email);
        $this->db->where('id_user !=', $id_user);
        $cek_email = $this->db->get('tb_user')->num_rows();

        if ($cek_email > 0) {
            $this->session->set_flashdata('error', 'Email "' . $email . '" sudah digunakan oleh pengguna lain.');
            redirect('pembeli/profil');
            return;
        }

        // 🔴 AMBIL DATA USER LAMA UNTUK CEK FOTO
        $this->db->where('id_user', $id_user);
        $user_lama = $this->db->get('tb_user')->row();

        // 🔴 SIAPKAN DATA YANG AKAN DIUPDATE
        $data_update = [
            'nama' => $nama,
            'username' => $username,
            'email' => $email,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // 🔴 PROSES UPLOAD FOTO
        if (!empty($_FILES['foto']['name'])) {
            // Buat folder jika belum ada
            $upload_path = './uploads/profil/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            }

            // 🔴 KONFIGURASI UPLOAD
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048; // 2MB
            $config['encrypt_name'] = TRUE; // Enkripsi nama file

            $this->upload->initialize($config);

            if ($this->upload->do_upload('foto')) {
                $upload_data = $this->upload->data();
                $foto_baru = $upload_data['file_name'];

                // 🔴 HAPUS FOTO LAMA jika ada
                if (!empty($user_lama->foto) && file_exists($upload_path . $user_lama->foto)) {
                    @unlink($upload_path . $user_lama->foto);
                }

                $data_update['foto'] = $foto_baru;

                // Update session foto
                $this->session->set_userdata('foto', $foto_baru);
            } else {
                // Jika upload gagal
                $error = $this->upload->display_errors('', '');
                $this->session->set_flashdata('error', 'Gagal upload foto: ' . $error);
                redirect('pembeli/profil');
                return;
            }
        }

        // 🔴 UPDATE DATABASE
        $this->db->where('id_user', $id_user);
        $result = $this->db->update('tb_user', $data_update);

        if ($result) {
            // Update session dengan data terbaru
            $this->session->set_userdata([
                'nama' => $nama,
                'username' => $username,
                'email' => $email
            ]);

            $this->session->set_flashdata('success', 'Profil berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui profil. Silakan coba lagi.');
        }

        redirect('pembeli/profil');
    }

    /**
     * MENENTUKAN LEVEL MEMBER BERDASARKAN POIN
     */
    private function get_level($poin) {
        if ($poin >= 10000) return 'Platinum';
        if ($poin >= 5000) return 'Gold';
        if ($poin >= 2000) return 'Silver';
        return 'Bronze';
    }

    /**
     * MENENTUKAN CLASS CSS LEVEL MEMBER
     */
    private function get_level_class($poin) {
        if ($poin >= 10000) return 'platinum';
        if ($poin >= 5000) return 'gold';
        if ($poin >= 2000) return 'silver';
        return 'bronze';
    }
}
