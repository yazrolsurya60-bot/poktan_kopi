<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // CEK LOGIN
        if (!$this->session->userdata('id_user')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu.');
            redirect('auth/login');
        }

        // CEK ROLE HARUS PEMBELI
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
     */
    public function index() {
        $id_user = $this->session->userdata('id_user');

        // AMBIL DATA USER
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('tb_user');
        $user = $query->row();

        if (!$user) {
            $this->session->set_flashdata('error', 'Data pengguna tidak ditemukan.');
            redirect('auth/login');
        }

        $data['user'] = $user;

        // DATA NOTIFIKASI
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);

        // DATA KPI (TANPA POIN)
        $kpi = $this->Notifikasi_model->get_pembeli_kpi($id_user);
        $data['total_transaksi'] = $kpi['total_transaksi'] ?? 0;
        $data['pesanan_dikirim'] = $kpi['pesanan_dikirim'] ?? 0;

        // UPDATE SESSION
        $this->session->set_userdata([
            'nama' => $user->nama,
            'username' => $user->username,
            'email' => $user->email
        ]);

        $this->load->view('auth/v_profile', $data);
    }

    /**
     * UPDATE - Memproses perubahan data profil
     */
    public function update() {
        $id_user = $this->session->userdata('id_user');

        $nama = trim($this->input->post('nama'));
        $username = trim($this->input->post('username'));
        $email = trim($this->input->post('email'));

        // VALIDASI
        if (empty($nama)) {
            $this->session->set_flashdata('error', 'Nama lengkap wajib diisi.');
            redirect('pembeli/profil');
            return;
        }

        if (empty($username) || strlen($username) < 4) {
            $this->session->set_flashdata('error', 'Username minimal 4 karakter.');
            redirect('pembeli/profil');
            return;
        }

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->session->set_flashdata('error', 'Email tidak valid.');
            redirect('pembeli/profil');
            return;
        }

        // CEK DUPLIKASI USERNAME
        $this->db->where('username', $username);
        $this->db->where('id_user !=', $id_user);
        $cek_username = $this->db->get('tb_user')->num_rows();

        if ($cek_username > 0) {
            $this->session->set_flashdata('error', 'Username "' . $username . '" sudah digunakan oleh pengguna lain.');
            redirect('pembeli/profil');
            return;
        }

        // CEK DUPLIKASI EMAIL
        $this->db->where('email', $email);
        $this->db->where('id_user !=', $id_user);
        $cek_email = $this->db->get('tb_user')->num_rows();

        if ($cek_email > 0) {
            $this->session->set_flashdata('error', 'Email "' . $email . '" sudah digunakan oleh pengguna lain.');
            redirect('pembeli/profil');
            return;
        }

        // AMBIL DATA USER LAMA
        $this->db->where('id_user', $id_user);
        $user_lama = $this->db->get('tb_user')->row();

        $data_update = [
            'nama' => $nama,
            'username' => $username,
            'email' => $email,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // PROSES UPLOAD FOTO
        if (!empty($_FILES['foto']['name'])) {
            $upload_path = './uploads/profil/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            }

            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048;
            $config['encrypt_name'] = TRUE;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('foto')) {
                $upload_data = $this->upload->data();
                $foto_baru = $upload_data['file_name'];

                if (!empty($user_lama->foto) && file_exists($upload_path . $user_lama->foto)) {
                    @unlink($upload_path . $user_lama->foto);
                }

                $data_update['foto'] = $foto_baru;
                $this->session->set_userdata('foto', $foto_baru);
            } else {
                $error = $this->upload->display_errors('', '');
                $this->session->set_flashdata('error', 'Gagal upload foto: ' . $error);
                redirect('pembeli/profil');
                return;
            }
        }

        // UPDATE DATABASE
        $this->db->where('id_user', $id_user);
        $result = $this->db->update('tb_user', $data_update);

        if ($result) {
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
}
