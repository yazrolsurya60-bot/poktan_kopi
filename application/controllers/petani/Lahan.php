<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lahan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Lahan_model');
        $this->load->model('Notifikasi_model'); 
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('text');

        // Proteksi login dasar (Opsional namun disarankan)
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $id_user = $this->session->userdata('id_user');
        
        // AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Petani';
        
        $filters = [
            'status_lahan' => $this->input->get('status_lahan'),
            'keyword'      => $this->input->get('keyword')
        ];

        $data['title'] = "Panel petani: Data Lahan Kopi";
        
        // 🔄 REVISI 1: Parameter pertama diganti $id_user agar petani hanya melihat lahannya sendiri
        $data['lahan'] = $this->Lahan_model->get_all_lahan($id_user, $filters);

        $this->load->view('petani/lahan/index', $data);
    }

    public function tambah() {
        $id_user = $this->session->userdata('id_user');
        
        // AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Petani';
        
        if ($this->input->server('REQUEST_METHOD') != 'POST') {
            $this->load->view('petani/lahan/tambah', $data);
            return;
        }

        $config['upload_path']   = './assets/uploads/lahan/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
        $config['max_size']      = 2048;
        $this->load->library('upload', $config);

        $data_insert = array(
            'id_user'      => $id_user,
            'nama_lahan'   => $this->input->post('nama_lahan'),
            'jenis_kopi'   => $this->input->post('jenis_kopi'),
            'jenis_tanah'  => $this->input->post('jenis_tanah'), // Pastikan diinput
            'luas'         => $this->input->post('luas'),
            'lokasi'       => $this->input->post('lokasi'),
            'latitude'     => $this->input->post('latitude'),
            'longitude'    => $this->input->post('longitude'),
            'status_lahan' => $this->input->post('status_lahan'),
            'catatan'      => $this->input->post('catatan')
        );

        if (!empty($_FILES['foto_lahan']['name'])) {
            if ($this->upload->do_upload('foto_lahan')) {
                $data_insert['foto_lahan'] = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('petani/lahan/tambah');
            }
        }

        if ($this->db->insert('tb_lahan', $data_insert)) {
            $this->session->set_flashdata('success', 'Data lahan berhasil disimpan!');
            redirect('petani/lahan');
        } else {
            echo "Database Error: Gagal menyimpan ke tabel.";
        }
    }

    public function edit($id) {
        $id_user = $this->session->userdata('id_user');
        
        // AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Petani';
        
        $data['lahan'] = $this->db->get_where('tb_lahan', ['id_lahan' => $id])->row_array();

        if (!$data['lahan']) {
            show_404();
        }

        $this->load->view('petani/lahan/edit', $data);
    }

    public function update() {
        $id = $this->input->post('id_lahan');

        // 🔄 REVISI 2: Menambahkan data 'jenis_tanah' dan 'catatan' agar ikut ter-update
        $data = array(
            'nama_lahan'   => $this->input->post('nama_lahan'),
            'jenis_kopi'   => $this->input->post('jenis_kopi'),
            'jenis_tanah'  => $this->input->post('jenis_tanah'), 
            'luas'         => $this->input->post('luas'),
            'lokasi'       => $this->input->post('lokasi'),
            'latitude'     => $this->input->post('latitude'),
            'longitude'    => $this->input->post('longitude'),
            'status_lahan' => $this->input->post('status_lahan'),
            'catatan'      => $this->input->post('catatan')
        );

        // 🔄 REVISI 3: Menambahkan upload penanganan foto baru pada form edit
        if (!empty($_FILES['foto_lahan']['name'])) {
            $config['upload_path']   = './assets/uploads/lahan/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
            $config['max_size']      = 2048;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto_lahan')) {
                $data['foto_lahan'] = $this->upload->data('file_name');
            }
        }

        $this->db->where('id_lahan', $id);
        $this->db->update('tb_lahan', $data);

        $this->session->set_flashdata('success', 'Data lahan berhasil diupdate!');
        redirect('petani/lahan');
    }

    public function detail($id) {
        $id_user = $this->session->userdata('id_user');
        
        // AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Petani';
        
        $data['lahan'] = $this->Lahan_model->get_detail($id);
        
        if (empty($data['lahan'])) {
            show_404();
        }

        $this->load->model('Panen_model'); 
        $data['riwayat_panen'] = $this->Panen_model->get_panen_by_lahan($id);
        
        $this->load->view('petani/lahan/detail', $data);
    }

    public function hapus($id) {
        $this->Lahan_model->hapus_data($id);
        $this->session->set_flashdata('success', 'Data berhasil dihapus');
        redirect('petani/lahan');
    }
}