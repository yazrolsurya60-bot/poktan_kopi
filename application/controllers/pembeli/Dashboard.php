<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('id_user')) {
            redirect('auth/login');
        }

        $current_role = $this->session->userdata('role');
        if ($current_role != 'Pembeli') {
            if ($current_role == 'Admin') {
                redirect('admin/dashboard');
            } elseif ($current_role == 'Petani') {
                redirect('petani/dashboard');
            } else {
                $this->session->sess_destroy();
                redirect('auth/login');
            }
        }

        $this->load->model('Notifikasi_model');
        $this->load->model('Transaksi_model');
        $this->load->model('Produk_model');
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_user');

        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Pembeli';

        $kpi = $this->Notifikasi_model->get_pembeli_kpi($id_user);
        $data['kpi_total_transaksi'] = $kpi['total_transaksi'] ?? 0;
        $data['kpi_total_belanja'] = $kpi['total_belanja'] ?? 0;
        $data['kpi_pesanan_dikirim'] = $kpi['pesanan_dikirim'] ?? 0;

        $this->db->where('id_user', $id_user);
        $this->db->order_by('id_transaksi', 'DESC');
        $this->db->limit(5);
        $data['pesanan_terbaru'] = $this->db->get('tb_transaksi')->result_array();

        $data['rekomendasi_produk'] = $this->Notifikasi_model->get_recommendations($id_user, 4);
        $data['grafik_belanja'] = $this->Notifikasi_model->get_shopping_chart($id_user);
        $data['settings'] = $this->Notifikasi_model->get_settings($id_user);

        $this->load->view('pembeli/v_dashboard', $data);
    }

    public function history()
    {
        $id_user = $this->session->userdata('id_user');

        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['history'] = $this->Notifikasi_model->get_all_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Pembeli';

        $this->load->view('template/v_notif_history', $data);
    }

    public function settings()
    {
        $id_user = $this->session->userdata('id_user');

        if ($this->input->post()) {
            $this->Notifikasi_model->update_settings($id_user, [
                'notif_pesanan' => $this->input->post('notif_pesanan') ? 1 : 0,
                'notif_kurir' => $this->input->post('notif_kurir') ? 1 : 0,
                'notif_pembayaran' => $this->input->post('notif_pembayaran') ? 1 : 0,
                'notif_sistem' => $this->input->post('notif_sistem') ? 1 : 0
            ]);

            $this->session->set_flashdata('success', 'Preferensi notifikasi berhasil diperbarui.');
            redirect('pembeli/dashboard/settings');
        }

        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['settings'] = $this->Notifikasi_model->get_settings($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Pembeli';

        $this->load->view('template/v_notif_setting', $data);
    }

    public function read($id_notif)
    {
        $id_user = $this->session->userdata('id_user');
        $this->Notifikasi_model->mark_as_read($id_notif, $id_user);
        
        $redirect = $this->input->get('redirect');
        if (!empty($redirect)) {
            redirect($redirect);
        }
        
        redirect('pembeli/dashboard/history');
    }

    public function mark_all_read()
    {
        $id_user = $this->session->userdata('id_user');
        $this->Notifikasi_model->mark_all_read($id_user);
        
        if ($this->input->is_ajax_request()) {
            echo json_encode(['success' => true]);
            return;
        }
        
        redirect('pembeli/dashboard/history');
    }

    public function get_notifications_ajax()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id_user = $this->session->userdata('id_user');
        $notifikasi = $this->Notifikasi_model->get_unread_notif($id_user, 5);
        $unread = $this->Notifikasi_model->count_unread($id_user);

        echo json_encode([
            'success' => true,
            'notifikasi' => $notifikasi,
            'unread' => $unread
        ]);
    }

    public function mark_all_read_ajax()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id_user = $this->session->userdata('id_user');
        $result = $this->Notifikasi_model->mark_all_read($id_user);

        echo json_encode(['success' => $result]);
    }

    public function get_chart_data()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id_user = $this->session->userdata('id_user');
        $data = $this->Notifikasi_model->get_shopping_chart($id_user);

        echo json_encode([
            'success' => true,
            'values' => $data['values'] ?? array_fill(0, 12, 0)
        ]);
    }
}
