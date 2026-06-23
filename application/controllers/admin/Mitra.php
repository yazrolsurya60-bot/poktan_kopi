<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mitra extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Cek login dan role Admin (Sesuai Modul 1 & Modul 11)
        if (!$this->session->userdata('id_user') || $this->session->userdata('role') !== 'Admin') {
            redirect('auth/login');
        }
        $this->load->model('Mitra_model');
        $this->load->model('Notifikasi_model'); // Untuk badge notif di header
        $this->load->helper(['url', 'form']);
        $this->load->library('upload');
    }

    public function index() {
        $id_user = $this->session->userdata('id_user');
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);

        $search = $this->input->get('search');
        $kategori = $this->input->get('kategori');
        $status = $this->input->get('status');

        $data['mitra'] = $this->Mitra_model->get_all_mitra($search, $kategori, $status);
        
        // Ambil list unik kategori untuk filter
        $kategori_list = [];
        foreach($data['mitra'] as $m) {
            if(!empty($m['kategori_mitra']) && !in_array($m['kategori_mitra'], $kategori_list)){
                $kategori_list[] = $m['kategori_mitra'];
            }
        }
        $data['kategori_list'] = $kategori_list;

        $this->load->view('admin/mitra/v_mitra_index', $data);
    }

    public function add() {
        if ($this->input->post()) {
            $data = [
                'nama_mitra' => $this->input->post('nama_mitra'),
                'kategori_mitra' => $this->input->post('kategori_mitra'),
                'urutan_tampil' => $this->input->post('urutan_tampil') ?? 1,
                'status_mitra' => 'Active',
            ];

            // Handle file upload
            if (!empty($_FILES['logo_mitra']['name'])) {
                $upload = $this->_do_upload();
                if ($upload['status']) {
                    $data['logo_mitra'] = $upload['filename'];
                } else {
                    $this->session->set_flashdata('error', $upload['error']);
                    redirect('admin/mitra/add');
                }
            } else {
                $data['logo_mitra'] = 'default.png';
            }

            $this->Mitra_model->insert_mitra($data);
            $this->session->set_flashdata('success', 'Mitra berhasil ditambahkan.');
            redirect('admin/mitra');
        } else {
            $id_user = $this->session->userdata('id_user');
            $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
            $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
            $this->load->view('admin/mitra/v_mitra_add', $data);
        }
    }

    public function edit($id) {
        $mitra = $this->Mitra_model->get_by_id($id);
        if (!$mitra) show_404();

        if ($this->input->post()) {
            $data = [
                'nama_mitra' => $this->input->post('nama_mitra'),
                'kategori_mitra' => $this->input->post('kategori_mitra'),
                'urutan_tampil' => $this->input->post('urutan_tampil') ?? 1,
            ];

            // Handle file upload
            if (!empty($_FILES['logo_mitra']['name'])) {
                $upload = $this->_do_upload();
                if ($upload['status']) {
                    $data['logo_mitra'] = $upload['filename'];
                    // Option: remove old logo if not default
                } else {
                    $this->session->set_flashdata('error', $upload['error']);
                    redirect('admin/mitra/edit/'.$id);
                }
            }

            $this->Mitra_model->update_mitra($id, $data);
            $this->session->set_flashdata('success', 'Mitra berhasil diperbarui.');
            redirect('admin/mitra');
        } else {
            $id_user = $this->session->userdata('id_user');
            $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
            $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
            $data['mitra'] = $mitra;
            $this->load->view('admin/mitra/v_mitra_edit', $data);
        }
    }

    public function delete($id) {
        $mitra = $this->Mitra_model->get_by_id($id);
        if (!$mitra) show_404();

        // Hapus file logo fisik dari server jika bukan default
        if (!empty($mitra['logo_mitra']) && $mitra['logo_mitra'] !== 'default.png') {
            $logo_path = './assets/uploads/mitra/' . $mitra['logo_mitra'];
            if (file_exists($logo_path)) {
                @unlink($logo_path);
            }
        }

        $this->Mitra_model->delete_mitra($id);
        $this->session->set_flashdata('success', 'Mitra telah dihapus permanen dari database.');
        redirect('admin/mitra');
    }

    public function toggle($id) {
        $this->Mitra_model->toggle_status($id);
        echo json_encode(['success' => true]);
    }

    public function update_urutan($id) {
        $urutan = (int)$this->input->post('urutan_tampil');
        if ($urutan > 0) {
            $this->Mitra_model->update_mitra($id, ['urutan_tampil' => $urutan]);
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Nilai tidak valid']);
        }
    }

    private function _do_upload() {
        $upload_path = './assets/uploads/mitra/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, TRUE);
        }

        $config['upload_path']   = $upload_path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size']      = 2048; // 2MB
        $config['encrypt_name']  = TRUE;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('logo_mitra')) {
            return ['status' => false, 'error' => $this->upload->display_errors('','')];
        } else {
            return ['status' => true, 'filename' => $this->upload->data('file_name')];
        }
    }
}