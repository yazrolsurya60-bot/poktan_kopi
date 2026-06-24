<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracking extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login');
        }
        
        $this->load->model('Tracking_model');
        $this->load->model('Notifikasi_model');
        $this->load->helper('notifikasi');
        $this->load->library('form_validation');
    }
    
    public function index() {
        $id_user = $this->session->userdata('id_user');
        
        $data['trackings'] = $this->Tracking_model->get_tracking_by_status(null, 10);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user, 5);
        
        foreach ($data['trackings'] as &$track) {
            $status_info = $this->Tracking_model->get_status_label($track->status_pengiriman);
            $track->status_label = $status_info['label'];
            $track->status_class = $status_info['class'];
            $track->status_icon = $status_info['icon'];
        }
        
        $this->load->view('template/header', ['title' => 'Dashboard Kurir']);
        $this->load->view('kurir/tracking_dashboard', $data);
        $this->load->view('template/footer');
    }
    
    public function update_location($id_tracking) {
        $tracking = $this->Tracking_model->get_tracking_by_id($id_tracking);
        if (!$tracking) {
            show_404();
        }
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('latitude', 'Latitude', 'required|numeric');
            $this->form_validation->set_rules('longitude', 'Longitude', 'required|numeric');
            
            if ($this->form_validation->run() == TRUE) {
                $lat = $this->input->post('latitude');
                $lng = $this->input->post('longitude');
                $lokasi = $this->input->post('lokasi');
                
                $result = $this->Tracking_model->update_tracking_location(
                    $id_tracking,
                    $lat,
                    $lng,
                    $lokasi
                );
                
                if ($result) {
                    notifikasi_tracking(
                        $tracking->pembeli_id,
                        $tracking->invoice,
                        'Lokasi terbaru',
                        "Kurir berada di: " . ($lokasi ?: "Koordinat {$lat}, {$lng}")
                    );
                    
                    echo json_encode(['success' => true, 'message' => 'Lokasi berhasil diperbarui.']);
                    return;
                } else {
                    echo json_encode(['success' => false, 'message' => 'Gagal memperbarui lokasi.']);
                    return;
                }
            } else {
                echo json_encode(['success' => false, 'message' => validation_errors()]);
                return;
            }
        }
        
        $data['tracking'] = $tracking;
        $data['unread_count'] = $this->Notifikasi_model->count_unread($this->session->userdata('id_user'));
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($this->session->userdata('id_user'), 5);
        
        $this->load->view('template/header', ['title' => 'Update Lokasi']);
        $this->load->view('kurir/tracking_location', $data);
        $this->load->view('template/footer');
    }
    
    public function api_update_location() {
        header('Content-Type: application/json');
        
        if (!$this->session->userdata('id_user')) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            return;
        }
        
        $id_tracking = $this->input->post('id_tracking');
        $lat = $this->input->post('latitude');        // ✅ FIX: latitude
        $lng = $this->input->post('longitude');       // ✅ FIX: longitude
        $lokasi = $this->input->post('lokasi');
        
        if (!$id_tracking || !$lat || !$lng) {
            echo json_encode(['success' => false, 'message' => 'Parameter tidak lengkap']);
            return;
        }
        
        $tracking = $this->Tracking_model->get_tracking_by_id($id_tracking);
        if (!$tracking) {
            echo json_encode(['success' => false, 'message' => 'Tracking tidak ditemukan']);
            return;
        }
        
        $result = $this->Tracking_model->update_tracking_location($id_tracking, $lat, $lng, $lokasi);
        
        if ($result) {
            notifikasi_tracking(
                $tracking->pembeli_id,
                $tracking->invoice,
                'Lokasi terbaru',
                "Kurir berada di: " . ($lokasi ?: "Koordinat {$lat}, {$lng}")
            );
            
            echo json_encode(['success' => true, 'message' => 'Lokasi diperbarui']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal update lokasi']);
        }
    }
}