<?php
// application/controllers/api/Notifikasi.php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Notifikasi_model');
        header('Content-Type: application/json');
        
        // 🔴 PERBAIKI: Gunakan 'id_user'
        if (!$this->session->userdata('id_user')) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            exit;
        }
    }
    
    /**
     * GET: Get notifications
     */
    public function get() {
        $id_user = $this->session->userdata('id_user');
        $limit = $this->input->get('limit') ?? 5;
        
        // 🔴 PERBAIKI: Gunakan method yang ada di model
        $notifikasi = $this->Notifikasi_model->get_unread_notif($id_user, $limit);
        $unread = $this->Notifikasi_model->count_unread($id_user);
        
        echo json_encode([
            'success' => true,
            'notifikasi' => $notifikasi,
            'unread' => $unread
        ]);
    }
    
    /**
     * POST: Mark notification as read
     */
    public function mark_read() {
        $id = $this->input->post('id');
        $id_user = $this->session->userdata('id_user');
        
        $result = $this->Notifikasi_model->mark_as_read($id, $id_user);
        echo json_encode(['success' => $result]);
    }
    
    /**
     * POST: Mark all notifications as read
     */
    public function mark_all_read() {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 PERBAIKI: Method hanya butuh id_user
        $result = $this->Notifikasi_model->mark_all_read($id_user);
        echo json_encode(['success' => $result]);
    }
    
    /**
     * POST: Update notification setting
     */
    public function update_setting() {
        $id_user = $this->session->userdata('id_user');
        $key = $this->input->post('key');
        $value = $this->input->post('value');
        
        // 🔴 PERBAIKI: Method update_settings butuh array
        $result = $this->Notifikasi_model->update_settings($id_user, [$key => $value]);
        echo json_encode(['success' => $result]);
    }
    
    /**
     * GET: Get notification settings
     */
    public function get_settings() {
        $id_user = $this->session->userdata('id_user');
        $settings = $this->Notifikasi_model->get_settings($id_user);
        echo json_encode(['success' => true, 'settings' => $settings]);
    }
}
