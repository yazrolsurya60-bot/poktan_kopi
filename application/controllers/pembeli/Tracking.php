<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracking extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login');
        }
        
        if ($this->session->userdata('role') != 'Pembeli') {
            show_error('Akses ditolak. Hanya untuk Pembeli.', 403);
        }
        
        $this->load->model('Tracking_model');
        $this->load->model('Notifikasi_model');
        $this->load->helper('notifikasi');
    }
    
    public function index() {
        $id_user = $this->session->userdata('id_user');
        
        $data['trackings'] = $this->Tracking_model->get_user_tracking($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user, 5);
        
        foreach ($data['trackings'] as &$track) {
            $status_info = $this->Tracking_model->get_status_label($track->status_pengiriman);
            $track->status_label = $status_info['label'];
            $track->status_class = $status_info['class'];
            $track->status_icon = $status_info['icon'];
            $track->estimasi = $this->Tracking_model->get_estimasi_tiba($track->id_tracking);
        }
        
        $this->load->view('template/header', ['title' => 'Tracking Pesanan']);
        $this->load->view('pembeli/tracking_list', $data);
        $this->load->view('template/footer');
    }
    
    public function detail($id_tracking) {
        $id_user = $this->session->userdata('id_user');
        
        $tracking = $this->Tracking_model->get_tracking_by_id($id_tracking);
        
        if (!$tracking || $tracking->pembeli_id != $id_user) {
            show_404();
        }
        
        $history = $this->Tracking_model->get_tracking_history($id_tracking);
        
        $status_info = $this->Tracking_model->get_status_label($tracking->status_pengiriman);
        $tracking->status_label = $status_info['label'];
        $tracking->status_class = $status_info['class'];
        $tracking->status_icon = $status_info['icon'];
        $tracking->estimasi = $this->Tracking_model->get_estimasi_tiba($id_tracking);
        
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user, 5);
        $data['tracking'] = $tracking;
        $data['history'] = $history;
        $data['status_list'] = $this->get_status_step($tracking->status_pengiriman);
        
        $this->load->view('template/header', ['title' => 'Detail Tracking #' . $tracking->invoice]);
        $this->load->view('pembeli/tracking_detail', $data);
        $this->load->view('template/footer');
    }
    
    public function approve($id_tracking) {
        $id_user = $this->session->userdata('id_user');
        
        $result = $this->Tracking_model->approve_diterima($id_tracking, $id_user);
        
        if ($result) {
            $tracking = $this->Tracking_model->get_tracking_by_id($id_tracking);
            
            if ($tracking) {
                $admin = $this->db->get_where('tb_user', ['role' => 'Admin', 'status' => 'Active'])->row();
                if ($admin) {
                    send_notifikasi(
                        $admin->id_user,
                        'admin',
                        'Konfirmasi Penerimaan',
                        "Pesanan #{$tracking->invoice} telah diterima oleh pembeli.",
                        'success',
                        base_url('admin/transaksi/detail/' . $tracking->id_transaksi)
                    );
                }
                
                $this->session->set_flashdata('success', 'Pesanan berhasil dikonfirmasi diterima.');
            }
            
            redirect('pembeli/tracking');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengkonfirmasi penerimaan. Pastikan status pesanan sudah "Telah Dikirim".');
            redirect('pembeli/tracking/detail/' . $id_tracking);
        }
    }
    
    public function history() {
        $id_user = $this->session->userdata('id_user');
        
        $data['history'] = $this->Tracking_model->get_user_tracking($id_user, 20);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user, 5);
        
        foreach ($data['history'] as &$track) {
            $status_info = $this->Tracking_model->get_status_label($track->status_pengiriman);
            $track->status_label = $status_info['label'];
            $track->status_class = $status_info['class'];
            $track->status_icon = $status_info['icon'];
        }
        
        $this->load->view('template/header', ['title' => 'History Tracking']);
        $this->load->view('pembeli/tracking_history', $data);
        $this->load->view('template/footer');
    }
    
    private function get_status_step($current_status) {
        $steps = [
            'pending' => 'Menunggu',
            'diproses' => 'Diproses',
            'dikirim' => 'Dikirim',
            'dalam_perjalanan' => 'Dalam Perjalanan',
            'delivered' => 'Telah Dikirim',
            'diterima' => 'Diterima'
        ];
        
        $status_order = array_keys($steps);
        $current_index = array_search($current_status, $status_order);
        if ($current_index === false) $current_index = 0;
        
        $result = [];
        foreach ($steps as $key => $label) {
            $index = array_search($key, $status_order);
            $result[$key] = [
                'label' => $label,
                'active' => $index <= $current_index,
                'current' => $index == $current_index
            ];
        }
        
        return $result;
    }
}