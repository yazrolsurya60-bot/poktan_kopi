<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        // Cek login dan role Petani
        if (!$this->session->userdata('id_user') || $this->session->userdata('role') != 'Petani') {
            redirect('auth/login');
        }

        $this->load->model('Produk_model');
        $this->load->model('Notifikasi_model');
    }

    // Halaman utama produk
    public function index()
    {
        $id_user = $this->session->userdata('id_user');
        
        // Ambil Notifikasi
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Petani';
        
        // Data untuk Header Page
        $data['title'] = 'Katalog Produk - Petani Kopi';
		$data['title_page']  = 'Katalog Produk';
        $data['subtitle'] = 'Kelola daftar produk kopi dari seluruh petani yang siap dipasarkan';

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

        // Load Template Modular
        $this->load->view('templates/petani/header', $data);
        $this->load->view('templates/petani/sidebar', $data);
        $this->load->view('petani/produk/index', $data);
        $this->load->view('templates/petani/footer');
    }

    // Form tambah produk
    public function tambah()
    {
        $id_user = $this->session->userdata('id_user');
        
        $data['title']        = 'Tambah Produk - Petani Kopi';
        $data['title_page']   = 'Tambah Produk Baru';
        $data['subtitle']     = 'Lengkapi spesifikasi produk kopi untuk ditambahkan ke katalog';
        $data['role']         = 'Petani';
        
        $data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        
        // Load Template Modular
        $this->load->view('templates/petani/header', $data);
        $this->load->view('templates/petani/sidebar', $data);
        $this->load->view('petani/produk/produk_tambah', $data);
        $this->load->view('templates/petani/footer');
    }

    // Simpan produk baru
    public function simpan()
    {
        $foto = '';

        if (!empty($_FILES['foto_utama']['name'])) {
            $config['upload_path']   = './uploads/produk/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']      = 2048;
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto_utama')) {
                $upload = $this->upload->data();
                $foto = $upload['file_name'];
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('petani/produk/tambah');
                return;
            }
        }

        $data = array(
            'id_user'       => $this->session->userdata('id_user'),
            'nama_produk'   => $this->input->post('nama_produk'),
            'jenis_kopi'    => $this->input->post('jenis_kopi'),
            'grade'         => $this->input->post('grade'),
            'harga'         => $this->input->post('harga'),
            'stok_produk'   => $this->input->post('stok_produk'),
            'altitude'      => $this->input->post('altitude'),
            'proses'        => $this->input->post('proses'),
            'flavor_notes'  => $this->input->post('flavor_notes'),
            'status_produk' => $this->input->post('status_produk'),
            'deskripsi'     => $this->input->post('deskripsi'),
            'foto_utama'    => $foto
        );

        $this->Produk_model->insert($data);
        
        // 🔴 TAMBAHKAN NOTIFIKASI FLASHDATA BERHASIL TAMBAH
        $this->session->set_flashdata('success', 'Produk berhasil ditambahkan ke katalog!');
        redirect('petani/produk');
    }

    // Detail produk
    public function detail($id)
    {
        $id_user = $this->session->userdata('id_user');
        
        $data['title']        = 'Detail Produk - Petani Kopi';
        $data['title_page']   = 'Detail Produk';
        $data['subtitle']     = 'Informasi lengkap spesifikasi produk kopi';
        $data['role']         = 'Petani';
        
        $data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        
        $data['produk'] = $this->Produk_model->getById($id);
        if (!$data['produk']) {
            show_404();
        }

        $this->load->view('templates/petani/header', $data);
        $this->load->view('templates/petani/sidebar', $data);
        $this->load->view('petani/produk/produk_detail', $data);
        $this->load->view('templates/petani/footer');
    }

    // Form edit produk
    public function edit($id)
    {
        $id_user = $this->session->userdata('id_user');
        
        $data['title']        = 'Edit Produk - Petani Kopi';
        $data['title_page']   = 'Edit Produk';
        $data['subtitle']     = 'Perbarui spesifikasi produk kopi';
        $data['role']         = 'Petani';
        
        $data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        
        $data['produk'] = $this->Produk_model->getById($id);
        if (!$data['produk']) {
            show_404();
        }

        $this->load->view('templates/petani/header', $data);
        $this->load->view('templates/petani/sidebar', $data);
        $this->load->view('petani/produk/produk_edit', $data);
        $this->load->view('templates/petani/footer');
    }

    // Update produk
    public function update($id)
    {
        $cek_produk = $this->Produk_model->getById($id);
        if (!$cek_produk) {
            show_404();
        }

        $data = array(
            'nama_produk'   => $this->input->post('nama_produk'),
            'jenis_kopi'    => $this->input->post('jenis_kopi'),
            'grade'         => $this->input->post('grade'),
            'harga'         => $this->input->post('harga'),
            'stok_produk'   => $this->input->post('stok_produk'),
            'altitude'      => $this->input->post('altitude'),
            'proses'        => $this->input->post('proses'),
            'flavor_notes'  => $this->input->post('flavor_notes'),
            'deskripsi'     => $this->input->post('deskripsi'),
            'status_produk' => $this->input->post('status_produk')
        );

        if (!empty($_FILES['foto_utama']['name'])) {
            $config['upload_path']   = './uploads/produk/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']      = 2048;
            $config['encrypt_name']  = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            if ($this->upload->do_upload('foto_utama')) {
                $upload = $this->upload->data();
                $data['foto_utama'] = $upload['file_name'];
                
                if (!empty($cek_produk->foto_utama) && file_exists('./uploads/produk/' . $cek_produk->foto_utama)) {
                    unlink('./uploads/produk/' . $cek_produk->foto_utama);
                }
            }
        }

        $this->Produk_model->update($id, $data);
        
        // 🔴 TAMBAHKAN NOTIFIKASI FLASHDATA BERHASIL UPDATE
        $this->session->set_flashdata('success', 'Data produk berhasil diperbarui!');
        redirect('petani/produk');
    }

    // Hapus produk
    public function hapus($id)
    {
        $cek_produk = $this->Produk_model->getById($id);
        
        if ($cek_produk) {
            if (!empty($cek_produk->foto_utama) && file_exists('./uploads/produk/' . $cek_produk->foto_utama)) {
                unlink('./uploads/produk/' . $cek_produk->foto_utama);
            }
            $this->Produk_model->delete($id);
            
            // 🔴 TAMBAHKAN NOTIFIKASI FLASHDATA BERHASIL HAPUS
            $this->session->set_flashdata('success', 'Produk berhasil dihapus dari katalog!');
        }
        redirect('petani/produk');
    }
}
