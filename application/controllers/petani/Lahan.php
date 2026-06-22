<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lahan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Lahan_model');
        $this->load->library('form_validation');
        $this->load->library('session'); // Memastikan pemanggilan huruf kecil agar aman dari error

        // Proteksi: Pastikan hanya user ber-role Petani yang bisa mengakses [cite: 74]
        if ($this->session->userdata('role') !== 'Petani') {
            redirect('auth');
        }
    }

    // Menampilkan list lahan milik petani yang sedang login 
    public function index() {
        $id_user = $this->session->userdata('id_user');
        
        $filter = [
            'status_lahan' => $this->input->get('status_lahan'),
            'lokasi'       => $this->input->get('lokasi')
        ];

        $data['title'] = "Manajemen Lahan Kopi";
        $data['lahan'] = $this->Lahan_model->get_all_lahan($id_user, $filter);
        
        $this->load->view('templates/header', $data);
        $this->load->view('petani/lahan/index', $data);
        $this->load->view('templates/footer');
    }

    // Form Tambah + Proses Simpan Lahan [cite: 76]
    public function tambah() {
        $this->form_validation->set_rules('nama_lahan', 'Nama Lahan', 'required');
        $this->form_validation->set_rules('jenis_kopi', 'Jenis Kopi', 'required');
        $this->form_validation->set_rules('luas', 'Luas Lahan', 'required|numeric');
        $this->form_validation->set_rules('latitude', 'Latitude', 'required');
        $this->form_validation->set_rules('longitude', 'Longitude', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Tambah Lahan Baru";
            $this->load->view('templates/header', $data);
            $this->load->view('petani/lahan/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $foto_name = null;
            if (!empty($_FILES['foto_lahan']['name'])) {
                $config['upload_path']   = './assets/uploads/lahan/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size']      = 2048;
                $config['file_name']     = 'lahan_'.time();

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto_lahan')) {
                    $upload_data = $this->upload->data();
                    $foto_name = $upload_data['file_name'];
                }
            }

            $insert_data = [
                'id_user'      => $this->session->userdata('id_user'),
                'nama_lahan'   => $this->input->post('nama_lahan'),
                'jenis_kopi'   => $this->input->post('jenis_kopi'),
                'lokasi'       => $this->input->post('lokasi'),
                'luas'         => $this->input->post('luas'),
                'latitude'     => $this->input->post('latitude'),
                'longitude'    => $this->input->post('longitude'),
                'foto_lahan'   => $foto_name,
                'catatan'      => $this->input->post('catatan'),
                'status_lahan' => $this->input->post('status_lahan')
            ];

            $this->Lahan_model->insert_lahan($insert_data);
            $this->session->set_flashdata('success', 'Lahan baru berhasil disimpan.');
            redirect('petani/lahan');
        }
    }

    // Detail Lahan Petani [cite: 76]
    public function detail($id_lahan) {
        $data['lahan'] = $this->Lahan_model->get_lahan_by_id($id_lahan);
        
        // Cek kepemilikan data agar tidak diintip petani lain
        if (empty($data['lahan']) || $data['lahan']['id_user'] != $this->session->userdata('id_user')) {
            show_404();
        }

        $data['title'] = "Detail Lahan - " . $data['lahan']['nama_lahan'];
        
        $this->load->view('templates/header', $data);
        $this->load->view('petani/lahan/detail', $data);
        $this->load->view('templates/footer');
    }

    // Form Edit + Proses Update Lahan [cite: 76]
    public function edit($id_lahan) {
        $data['lahan'] = $this->Lahan_model->get_lahan_by_id($id_lahan);
        if (empty($data['lahan']) || $data['lahan']['id_user'] != $this->session->userdata('id_user')) {
            show_404();
        }

        $this->form_validation->set_rules('nama_lahan', 'Nama Lahan', 'required');
        $this->form_validation->set_rules('jenis_kopi', 'Jenis Kopi', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Edit Lahan Kopi";
            $this->load->view('templates/header', $data);
            $this->load->view('petani/lahan/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $update_data = [
                'nama_lahan'   => $this->input->post('nama_lahan'),
                'jenis_kopi'   => $this->input->post('jenis_kopi'),
                'lokasi'       => $this->input->post('lokasi'),
                'luas'         => $this->input->post('luas'),
                'latitude'     => $this->input->post('latitude'),
                'longitude'    => $this->input->post('longitude'),
                'catatan'      => $this->input->post('catatan'),
                'status_lahan' => $this->input->post('status_lahan')
            ];

            if (!empty($_FILES['foto_lahan']['name'])) {
                $config['upload_path']   = './assets/uploads/lahan/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size']      = 2048;
                $config['file_name']     = 'lahan_'.time();

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto_lahan')) {
                    $upload_data = $this->upload->data();
                    $update_data['foto_lahan'] = $upload_data['file_name'];
                    
                    if ($data['lahan']['foto_lahan'] && file_exists('./assets/uploads/lahan/'.$data['lahan']['foto_lahan'])) {
                        unlink('./assets/uploads/lahan/'.$data['lahan']['foto_lahan']);
                    }
                }
            }

            $this->Lahan_model->update_lahan($id_lahan, $update_data);
            $this->session->set_flashdata('success', 'Data Lahan berhasil diperbarui.');
            redirect('petani/lahan');
        }
    }

    // Menghapus data lahan [cite: 76]
    public function hapus($id_lahan) {
        $lahan = $this->Lahan_model->get_lahan_by_id($id_lahan);
        if ($lahan && $lahan['id_user'] == $this->session->userdata('id_user')) {
            if ($lahan['foto_lahan'] && file_exists('./assets/uploads/lahan/'.$lahan['foto_lahan'])) {
                unlink('./assets/uploads/lahan/'.$lahan['foto_lahan']);
            }
            $this->Lahan_model->delete_lahan($id_lahan);
            $this->session->set_flashdata('success', 'Lahan berhasil dihapus.');
        }
        redirect('petani/lahan');
    }
}