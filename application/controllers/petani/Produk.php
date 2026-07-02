<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->model('Notifikasi_model'); // 🔴 TAMBAHKAN
    }

    // Halaman utama produk
    public function index()
    {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Petani';
        
        $keyword = $this->input->get('keyword');

        if (!empty($keyword)) {
            $this->db->group_start();
            $this->db->like('nama_produk', $keyword);
            $this->db->or_like('jenis_kopi', $keyword);
            $this->db->or_like('grade', $keyword);
            $this->db->group_end();
            $data['produk'] = $this->db->get('tb_produk')->result();
        } else {
            $data['produk'] = $this->Produk_model->getAll();
        }

        $this->load->view('petani/produk/index', $data);
    }

    // Form tambah produk
    public function tambah()
    {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Petani';
        
        $this->load->view('petani/produk/produk_tambah', $data);
    }

    // Simpan produk baru
    public function simpan()
    {
        // 🔴 METHOD INI REDIRECT, TIDAK PERLU NOTIFIKASI
        
        $foto = '';

        if (!empty($_FILES['foto_utama']['name'])) {
            $config['upload_path'] = './uploads/produk/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto_utama')) {
                $upload = $this->upload->data();
                $foto = $upload['file_name'];
            } else {
                echo $this->upload->display_errors();
                return;
            }
        }

        $data = array(
            'id_user' => $this->session->userdata('id_user'), // 🔴 TAMBAHKAN ID_USER
            'nama_produk' => $this->input->post('nama_produk'),
            'jenis_kopi' => $this->input->post('jenis_kopi'),
            'grade' => $this->input->post('grade'),
            'harga' => $this->input->post('harga'),
            'stok_produk' => $this->input->post('stok_produk'),
            'altitude' => $this->input->post('altitude'),
            'proses' => $this->input->post('proses'),
            'flavor_notes' => $this->input->post('flavor_notes'),
            'status_produk' => $this->input->post('status_produk'),
            'deskripsi' => $this->input->post('deskripsi'),
            'foto_utama' => $foto
        );

        $this->Produk_model->insert($data);
        redirect('petani/produk');
    }

    // Detail produk
    public function detail($id)
    {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Petani';
        
        $data['produk'] = $this->Produk_model->getById($id);
        $this->load->view('petani/produk_detail', $data);
    }

    // Form edit produk
    public function edit($id)
    {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Petani';
        
        $data['produk'] = $this->Produk_model->getById($id);
        $this->load->view('petani/produk_edit', $data);
    }

    // Update produk
    public function update($id)
    {
        // 🔴 METHOD INI REDIRECT, TIDAK PERLU NOTIFIKASI
        
        $data = array(
            'nama_produk' => $this->input->post('nama_produk'),
            'jenis_kopi' => $this->input->post('jenis_kopi'),
            'grade' => $this->input->post('grade'),
            'harga' => $this->input->post('harga'),
            'stok_produk' => $this->input->post('stok_produk'),
            'altitude' => $this->input->post('altitude'),
            'proses' => $this->input->post('proses'),
            'flavor_notes' => $this->input->post('flavor_notes'),
            'deskripsi' => $this->input->post('deskripsi'),
            'status_produk' => $this->input->post('status_produk')
        );

        if (!empty($_FILES['foto_utama']['name'])) {
            $config['upload_path'] = './uploads/produk/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('foto_utama')) {
                $upload = $this->upload->data();
                $data['foto_utama'] = $upload['file_name'];
            }
        }

        $this->Produk_model->update($id, $data);
        redirect('petani/produk');
    }

    // Hapus produk
    public function hapus($id)
    {
        // 🔴 METHOD INI REDIRECT, TIDAK PERLU NOTIFIKASI
        $this->Produk_model->delete($id);
        redirect('petani/produk');
    }
}
