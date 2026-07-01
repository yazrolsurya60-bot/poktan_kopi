<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Kurir Controller (PETANI)
 * ============================================
 * Modul 08: Manajemen Kurir — (Anisya)
 * ============================================
 * Sesuai PRD M-08, role Petani HANYA punya akses ke:
 * - M08-F06 : Assign Kurir — tapi dibatasi HANYA untuk transaksi/
 *             pengiriman hasil panen miliknya sendiri (id_user = id_user login)
 *
 * Petani TIDAK punya akses ke tambah/edit/hapus/detail/performance kurir,
 * itu semua tetap eksklusif milik Admin (lihat controllers/admin/Kurir.php).
 */
class Kurir extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('id_user')) {
            redirect('auth/login');
        }

        // Controller ini KHUSUS untuk role Petani
        $current_role = $this->session->userdata('role');

        if ($current_role != 'Petani') {
            if ($current_role == 'Admin') {
                redirect('admin/dashboard');
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
    }

    // ============================================
    // M08-F06: HALAMAN ASSIGN KURIR (sisi Petani)
    // Hanya menampilkan pengiriman dari transaksi miliknya sendiri
    // ============================================
    public function assign()
    {
        $id_user = $this->session->userdata('id_user');

        $data['pengiriman_pending'] = $this->Kurir_model->get_pengiriman_belum_assign_by_user($id_user);
        $data['kurir_aktif']        = $this->Kurir_model->get_kurir_aktif();

        $this->load->view('petani/kurir/assign', $data);
    }

    // ============================================
    // M08-F06: PROSES ASSIGN (sisi Petani)
    // Validasi tambahan: transaksi yang di-assign HARUS milik petani ini,
    // supaya petani tidak bisa assign kurir ke transaksi orang lain.
    // ============================================
    public function proses_assign()
    {
        if (!$this->input->post()) {
            redirect('petani/kurir/assign');
        }

        $id_user     = $this->session->userdata('id_user');
        $id_tracking = $this->input->post('id_tracking');
        $id_kurir    = $this->input->post('id_kurir');

        if (!$id_tracking || !$id_kurir) {
            $this->session->set_flashdata('error', 'Pengiriman dan kurir wajib dipilih.');
            redirect('petani/kurir/assign');
        }

        // Pastikan id_tracking yang dikirim memang milik petani ini.
        // Dicocokkan terhadap daftar pengiriman miliknya sendiri,
        // supaya petani tidak bisa "menebak" id_tracking milik orang lain.
        $milik_sendiri = $this->Kurir_model->get_pengiriman_belum_assign_by_user($id_user);
        $valid_ids      = array_column($milik_sendiri, 'id_tracking');

        if (!in_array((int) $id_tracking, $valid_ids, true)) {
            $this->session->set_flashdata('error', 'Pengiriman tidak ditemukan atau bukan milik Anda.');
            redirect('petani/kurir/assign');
        }

        $kurir = $this->Kurir_model->get_by_id($id_kurir);

        if (!$kurir || $kurir['status'] != 'Active') {
            $this->session->set_flashdata('error', 'Kurir tidak tersedia atau sedang tidak aktif.');
            redirect('petani/kurir/assign');
        }

        $success = $this->Kurir_model->assign_kurir($id_tracking, $id_kurir);

        if ($success) {
            $this->session->set_flashdata('success', 'Kurir berhasil ditugaskan untuk pengiriman ini.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menugaskan kurir. Silakan coba lagi.');
        }

        redirect('petani/kurir/assign');
    }
}
