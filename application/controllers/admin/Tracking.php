<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracking extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        if (!$this->session->userdata('id_user')) {
            redirect('auth/login');
        }

        $current_role = $this->session->userdata('role');
        if ($current_role != 'Admin') {
            if ($current_role == 'Petani')        redirect('petani/dashboard');
            elseif ($current_role == 'Pembeli')   redirect('pembeli/dashboard');
            elseif ($current_role == 'Kurir')     redirect('kurir/tracking');
            else { $this->session->sess_destroy(); redirect('auth/login'); }
        }

        $this->load->model('Tracking_model');
        $this->load->model('Kurir_model');
        $this->load->model('Notifikasi_model');
        $this->load->helper('notifikasi');
        $this->load->library('form_validation');
    }

    // ============================================================
    // INDEX — Daftar semua tracking
    // ============================================================
    public function index()
    {
        // Sinkronisasi transaksi lama yang belum ada tracking
        $this->Tracking_model->create_tracking_for_existing_transactions();

        $id_user = $this->session->userdata('id_user');

        $data['trackings']    = $this->Tracking_model->get_tracking_by_status(null, 50);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user, 5);
        $data['role']         = 'Admin';

        foreach ($data['trackings'] as &$track) {
            $info = $this->Tracking_model->get_status_label($track->status_pengiriman);
            $track->status_label = $info['label'];
            $track->status_class = $info['class'];
            $track->status_icon  = $info['icon'];
        }

        $this->load->view('template/header', ['title' => 'Tracking Pengiriman - Admin', 'role' => 'Admin']);
        $this->load->view('admin/tracking_list', $data);
        $this->load->view('template/footer');
    }

    // ============================================================
    // UPDATE — Update status + assign kurir
    // ============================================================
    public function update($id_tracking)
    {
        $id_user = $this->session->userdata('id_user');

        $tracking = $this->Tracking_model->get_tracking_by_id($id_tracking);
        if (!$tracking) show_404();

        // ---- Handle POST ----
        if ($this->input->post('action') == 'update_status') {
            $this->_handle_update_status($tracking, $id_user);
        } elseif ($this->input->post('action') == 'assign_kurir') {
            $this->_handle_assign_kurir($tracking, $id_user);
        }

        // ---- Re-fetch setelah kemungkinan update ----
        $tracking = $this->Tracking_model->get_tracking_by_id($id_tracking);

        $data['tracking']      = $tracking;
        $data['status_options']= $this->_get_status_options($tracking->status_pengiriman);
        $data['kurir_list']    = $this->Kurir_model->get_available_kurir();
        $data['unread_count']  = $this->Notifikasi_model->count_unread($id_user);
        $data['notifikasi']    = $this->Notifikasi_model->get_unread_notif($id_user, 5);
        $data['role']          = 'Admin';

        $this->load->view('template/header', ['title' => 'Update Tracking - Admin', 'role' => 'Admin']);
        $this->load->view('admin/tracking_update', $data);
        $this->load->view('template/footer');
    }

    // ============================================================
    // PRIVATE — Handle update status
    // ============================================================
    private function _handle_update_status($tracking, $id_user)
    {
        $status     = $this->input->post('status');
        $keterangan = $this->input->post('keterangan');

        if (!$status) {
            $this->session->set_flashdata('error', 'Pilih status terlebih dahulu.');
            return;
        }

        $result = $this->Tracking_model->update_status_admin(
            $tracking->id_tracking, $status, $keterangan, $id_user
        );

        if ($result) {
            $label = $this->Tracking_model->get_status_label($status);

            // Notifikasi ke pembeli
            notifikasi_tracking(
                $tracking->pembeli_id,
                $tracking->invoice,
                $label['label'],
                $keterangan ?: "Status diperbarui ke: {$label['label']}"
            );

            $this->session->set_flashdata('success', 'Status berhasil diperbarui ke: ' . $label['label']);
            redirect('admin/tracking/update/' . $tracking->id_tracking);
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui status.');
        }
    }

    // ============================================================
    // PRIVATE — Handle assign kurir
    // ============================================================
    private function _handle_assign_kurir($tracking, $id_user)
    {
        $id_kurir = (int)$this->input->post('id_kurir');

        if (!$id_kurir) {
            $this->session->set_flashdata('error', 'Pilih kurir terlebih dahulu.');
            return;
        }

        $kurir = $this->Kurir_model->get_kurir_by_id($id_kurir);
        if (!$kurir) {
            $this->session->set_flashdata('error', 'Kurir tidak ditemukan.');
            return;
        }

        // Update id_kurir di tb_tracking
        $this->db->where('id_tracking', $tracking->id_tracking);
        $result = $this->db->update('tb_tracking', [
            'id_kurir'   => $id_kurir,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        if ($result) {
            // Simpan history
            $this->Tracking_model->save_history(
                $tracking->id_tracking,
                $tracking->status_pengiriman,
                "Kurir ditugaskan: {$kurir->nama_kurir}"
            );

            // Notifikasi ke pembeli
            notifikasi_tracking(
                $tracking->pembeli_id,
                $tracking->invoice,
                'Kurir Ditugaskan',
                "Kurir {$kurir->nama_kurir} telah ditugaskan untuk mengantar pesanan Anda."
            );

            // Notifikasi ke user kurir (jika ada email yang cocok di tb_user)
            $user_kurir = $this->db
                ->where('email', $kurir->email)
                ->where('role', 'Kurir')
                ->get('tb_user')->row();

            if ($user_kurir) {
                send_notifikasi(
                    $user_kurir->id_user,
                    'Kurir',
                    'Penugasan Pengiriman Baru',
                    "Anda ditugaskan mengantar pesanan #{$tracking->invoice}. Segera upload bukti pengiriman.",
                    'info',
                    base_url('kurir/tracking')
                );
            }

            $this->session->set_flashdata('success', "Kurir {$kurir->nama_kurir} berhasil ditugaskan.");
            redirect('admin/tracking/update/' . $tracking->id_tracking);
        } else {
            $this->session->set_flashdata('error', 'Gagal menugaskan kurir.');
        }
    }

    // ============================================================
    // PRIVATE — Status flow options (SEDERHANA UNTUK INTERNAL)
    // ============================================================
    private function _get_status_options($current_status)
    {
        // ALUR SEDERHANA UNTUK PENGIRIMAN INTERNAL
        // TIDAK ADA: tiba_di_kota_tujuan, out_for_delivery
        $flow = [
            'pending'   => ['diproses', 'dibatalkan'],
            'diproses'  => ['dikirim', 'dibatalkan'],
            'dikirim'   => ['dalam_perjalanan'],
            'dalam_perjalanan' => ['delivered'],
            'delivered' => ['diterima'],
        ];

        $options = $flow[$current_status] ?? [];
        $result  = [];
        foreach ($options as $s) {
            $info     = $this->Tracking_model->get_status_label($s);
            $result[] = ['value' => $s, 'label' => $info['label']];
        }
        return $result;
    }
}