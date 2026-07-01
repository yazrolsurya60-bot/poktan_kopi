<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracking extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        // CEK LOGIN
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login');
        }

        // CEK ROLE ADMIN
        $current_role = $this->session->userdata('role');
        if ($current_role != 'Admin') {
            if ($current_role == 'Petani') {
                redirect('petani/dashboard');
            } elseif ($current_role == 'Pembeli') {
                redirect('pembeli/dashboard');
            } elseif ($current_role == 'Kurir') {
                redirect('kurir/tracking');
            } else {
                $this->session->sess_destroy();
                redirect('auth/login');
            }
        }

        $this->load->model('Tracking_model');
        $this->load->model('Notifikasi_model');
        $this->load->helper('notifikasi');
        $this->load->library('form_validation');
    }

    /**
     * M07-F02: Daftar tracking yang perlu diupdate oleh Admin
     */
    public function index()
    {
        $id_user = $this->session->userdata('id_user');

        $data['trackings'] = $this->Tracking_model->get_tracking_by_status(null, 20);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user, 5);
        $data['role'] = 'Admin';

        foreach ($data['trackings'] as &$track) {
            $status_info = $this->Tracking_model->get_status_label($track->status_pengiriman);
            $track->status_label = $status_info['label'];
            $track->status_class = $status_info['class'];
            $track->status_icon = $status_info['icon'];
        }

        $this->load->view('template/header', ['title' => 'Update Status Pengiriman - Admin']);
        $this->load->view('admin/tracking_list', $data);
        $this->load->view('template/footer');
    }

    /**
     * M07-F02: Form update status oleh Admin
     */
    public function update($id_tracking)
    {
        $id_user = $this->session->userdata('id_user');

        $tracking = $this->Tracking_model->get_tracking_by_id($id_tracking);
        if (!$tracking) {
            show_404();
        }

        if ($this->input->post()) {
            $this->form_validation->set_rules('status', 'Status', 'required');

            if ($this->form_validation->run() == TRUE) {
                $status = $this->input->post('status');
                $keterangan = $this->input->post('keterangan');

                // Update status dengan mencatat admin yang melakukan update
                $result = $this->Tracking_model->update_status_admin($id_tracking, $status, $keterangan, $id_user);

                if ($result) {
                    $status_label = $this->Tracking_model->get_status_label($status);

                    // Notifikasi ke pembeli
                    notifikasi_tracking(
                        $tracking->pembeli_id,
                        $tracking->invoice,
                        $status_label['label'],
                        $keterangan ?: "Status diperbarui oleh Admin ke: {$status_label['label']}"
                    );

                    // Notifikasi ke semua Admin (opsional)
                    notifikasi_semua_admin(
                        'Update Status Pengiriman',
                        "Admin mengupdate status #{$tracking->invoice} menjadi: {$status_label['label']}",
                        'info',
                        base_url('admin/tracking')
                    );

                    $this->session->set_flashdata('success', 'Status pengiriman berhasil diperbarui oleh Admin.');
                    redirect('admin/tracking');
                } else {
                    $this->session->set_flashdata('error', 'Gagal memperbarui status.');
                }
            }
        }

        $data['tracking'] = $tracking;
        $data['status_options'] = $this->get_status_options($tracking->status_pengiriman);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user, 5);
        $data['role'] = 'Admin';

        $this->load->view('template/header', ['title' => 'Update Status - Admin']);
        $this->load->view('admin/tracking_update', $data);
        $this->load->view('template/footer');
    }

    /**
     * Get available status options based on current status
     */
    private function get_status_options($current_status)
    {
        $flow = [
            'pending' => ['diproses', 'dibatalkan'],
            'diproses' => ['dikirim', 'dibatalkan'],
            'dikirim' => ['dalam_perjalanan'],
            'dalam_perjalanan' => ['tiba_di_kota_tujuan'],
            'tiba_di_kota_tujuan' => ['out_for_delivery'],
            'out_for_delivery' => ['delivered'],
            'delivered' => ['diterima']
        ];

        $options = isset($flow[$current_status]) ? $flow[$current_status] : [];
        $result = [];

        foreach ($options as $status) {
            $label = $this->Tracking_model->get_status_label($status);
            $result[] = ['value' => $status, 'label' => $label['label']];
        }

        return $result;
    }
}