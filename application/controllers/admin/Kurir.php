<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Kurir Controller (ADMIN)
 * ============================================
 * Modul 08: Manajemen Kurir — (Anisya)
 * ============================================
 */
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
            } else {
                $this->session->sess_destroy();
                redirect('auth/login');
            }
        }

        $this->load->model('Kurir_model');
        $this->load->model('Notifikasi_model'); // 🔴 TAMBAHKAN INI!
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Admin';
        
        $status_filter = $this->input->get('status');
        $keyword       = $this->input->get('keyword');

        $data['list_kurir'] = $this->Kurir_model->get_all($status_filter, $keyword);
        $data['keyword']    = $keyword;

        $data['kurir_active']   = $this->Kurir_model->count_by_status('Active');
        $data['kurir_inactive'] = $this->Kurir_model->count_by_status('Inactive');

        $this->load->view('admin/kurir/index', $data);
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

        // 🔴 KIRIM NOTIFIKASI KE ADMIN
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

    public function detail($id_kurir = null)
    {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Admin';
        
        $detail = $this->Kurir_model->get_detail_with_history($id_kurir);

        if (!$detail) {
            $this->session->set_flashdata('error', 'Data kurir tidak ditemukan.');
            redirect('admin/kurir');
        }

        $data['kurir']      = $detail['kurir'];
        $data['pengiriman'] = $detail['pengiriman'];

        $this->load->view('admin/kurir/detail', $data);
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

    // ============================================
    // M08-F05: HAPUS KURIR (SOFT DELETE)
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

    public function toggle($id_kurir = null)
    {
        $kurir = $this->Kurir_model->get_by_id($id_kurir);

        if (!$kurir) {
            $this->session->set_flashdata('error', 'Data kurir tidak ditemukan.');
            redirect('admin/kurir');
        }

        $status_baru = ($kurir['status'] == 'Active') ? 'Inactive' : 'Active';
        $this->Kurir_model->update($id_kurir, ['status' => $status_baru]);

        // 🔴 KIRIM NOTIFIKASI KE ADMIN
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

    // ============================================
    // M08-F06: HALAMAN ASSIGN KURIR
    // ============================================
    public function assign()
    {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Admin';
        
        $data['pengiriman_pending'] = $this->Kurir_model->get_pengiriman_belum_assign();
        $data['kurir_aktif']        = $this->Kurir_model->get_kurir_aktif();

        $this->load->view('admin/kurir/assign', $data);
    }

    // ============================================
    // 🔥 M08-F06: PROSES ASSIGN (PAKAI QUERY MANUAL)
    // ============================================
    public function proses_assign()
    {
        if (!$this->input->post()) {
            redirect('admin/kurir/assign');
        }

        $id_transaksi = $this->input->post('id_transaksi');
        $id_kurir     = $this->input->post('id_kurir');

        if (!$id_transaksi || !$id_kurir) {
            $this->session->set_flashdata('error', '❌ Transaksi dan kurir wajib dipilih.');
            redirect('admin/kurir/assign');
        }

        // 🔥 UPDATE PAKAI QUERY MANUAL
        $sql = "UPDATE tb_transaksi SET id_kurir = ? WHERE id_transaksi = ? AND (id_kurir IS NULL OR id_kurir = 0)";
        $this->db->query($sql, array($id_kurir, $id_transaksi));

        if ($this->db->affected_rows() > 0) {
            // Notifikasi ke Kurir
            $kurir = $this->db->query("SELECT * FROM tb_kurir WHERE id_kurir = ?", array($id_kurir))->row_array();
            
            $this->load->model('Notifikasi_model');
            if ($kurir && $kurir['id_user']) {
                $this->Notifikasi_model->save_notifikasi([
                    'id_user' => $kurir['id_user'],
                    'judul' => '📦 Tugas Pengiriman Baru',
                    'isi_notifikasi' => 'Anda ditugaskan untuk mengantar pesanan #' . $id_transaksi,
                    'link' => 'kurir/tracking/detail/' . $id_transaksi,
                    'icon' => 'info'
                ]);
            }

            // Notifikasi ke Admin
            $this->Notifikasi_model->save_notifikasi([
                'id_user' => 1,
                'judul' => '✅ Kurir Ditugaskan',
                'isi_notifikasi' => 'Kurir ' . ($kurir['nama_kurir'] ?? '') . ' ditugaskan untuk transaksi #' . $id_transaksi,
                'link' => 'admin/transaksi/detail/' . $id_transaksi,
                'icon' => 'success'
            ]);

            $this->session->set_flashdata('success', '✅ Kurir berhasil ditugaskan untuk transaksi #' . $id_transaksi);
        } else {
            $this->session->set_flashdata('error', '❌ Gagal menugaskan kurir. Mungkin transaksi sudah memiliki kurir.');
        }

        redirect('admin/kurir/assign');
    }

    public function performance()
    {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Admin';
        
        $data['performance'] = $this->Kurir_model->get_performance_kurir();

        $this->load->view('admin/kurir/performance', $data);
    }

    private function _validate()
    {
        $this->form_validation->set_rules('nama_kurir', 'Nama Kurir', 'required|trim|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('no_telepon', 'No. Telepon', 'required|trim|numeric|min_length[9]|max_length[20]');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|max_length[100]');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[Active,Inactive]');
    }
}