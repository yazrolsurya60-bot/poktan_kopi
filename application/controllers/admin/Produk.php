<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        // 🔴 CEK LOGIN & ROLE
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login');
        }
        
        if ($this->session->userdata('role') != 'Admin') {
            redirect('auth/login');
        }
        
        $this->load->model('Produk_model');
        $this->load->model('Notifikasi_model'); // 🔴 TAMBAHKAN INI!
        $this->load->helper('url');
        $this->load->helper('notifikasi'); // 🔴 TAMBAHKAN INI!
    }

    // Halaman utama produk
    public function index()
    {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Admin';
        
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

        $this->load->view('admin/v_produk', $data);
    }

    // Form tambah produk
    public function tambah()
    {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Admin';
        
        $data['produk'] = $this->Produk_model->getAll();

        $this->load->view('admin/produk_tambah', $data);
    }

    // Simpan produk baru
    public function simpan()
    {
        // 🔴 METHOD INI REDIRECT, TIDAK PERLU NOTIFIKASI
        
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
                echo $this->upload->display_errors();
                return;
            }
        }
        
        $data = array(
            'id_user'       => 1,
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

        $insert_id = $this->Produk_model->insert($data);

        if (!empty($_FILES['galeri']['name'][0])) {
            $filesCount = count($_FILES['galeri']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['file']['name']     = $_FILES['galeri']['name'][$i];
                $_FILES['file']['type']     = $_FILES['galeri']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['galeri']['tmp_name'][$i];
                $_FILES['file']['error']     = $_FILES['galeri']['error'][$i];
                $_FILES['file']['size']     = $_FILES['galeri']['size'][$i];
                
                $config2['upload_path']   = './uploads/produk/';
                $config2['allowed_types'] = 'jpg|jpeg|png';
                $config2['max_size']      = 2048;
                $config2['encrypt_name']  = TRUE;
                
                $this->load->library('upload', $config2);
                $this->upload->initialize($config2);
                if($this->upload->do_upload('file')){
                    $fileData = $this->upload->data();
                    $this->Produk_model->insert_galeri([
                        'id_produk' => $insert_id,
                        'foto' => $fileData['file_name']
                    ]);
                }
            }
        }

        // Kirim notifikasi ke admin
        send_notifikasi(
            1, // ID Admin
            'Admin',
            '📦 Produk Baru Ditambahkan',
            'Produk ' . $data['nama_produk'] . ' telah ditambahkan ke katalog.',
            'success',
            base_url('admin/produk')
        );

        $this->session->set_flashdata('success', 'Produk berhasil ditambahkan!');
        redirect('admin/produk');
    }
    
    // Detail produk
    public function detail($id)
    {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Admin';
        
        $data['produk'] = $this->Produk_model->getById($id);
        $data['galeri'] = $this->Produk_model->getGaleriByProduk($id);

        $this->load->view('admin/produk_detail', $data);
    }

    // Form edit produk
    public function edit($id)
    {
        $id_user = $this->session->userdata('id_user');
        
        // 🔴 AMBIL NOTIFIKASI - 3 BARIS
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role'] = 'Admin';
        
        $data['produk'] = $this->Produk_model->getById($id);
        $data['galeri'] = $this->Produk_model->getGaleriByProduk($id);

        $this->load->view('admin/produk_edit', $data);
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
            $config['upload_path']   = './uploads/produk/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']      = 2048;
            $config['encrypt_name']  = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('foto_utama')) {
                $upload = $this->upload->data();
                $data['foto_utama'] = $upload['file_name'];
            }
        }

        $this->Produk_model->update($id, $data);

        if (!empty($_FILES['galeri']['name'][0])) {
            $filesCount = count($_FILES['galeri']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['file']['name']     = $_FILES['galeri']['name'][$i];
                $_FILES['file']['type']     = $_FILES['galeri']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['galeri']['tmp_name'][$i];
                $_FILES['file']['error']     = $_FILES['galeri']['error'][$i];
                $_FILES['file']['size']     = $_FILES['galeri']['size'][$i];
                
                $config2['upload_path']   = './uploads/produk/';
                $config2['allowed_types'] = 'jpg|jpeg|png';
                $config2['max_size']      = 2048;
                $config2['encrypt_name']  = TRUE;
                
                $this->load->library('upload', $config2);
                $this->upload->initialize($config2);
                if($this->upload->do_upload('file')){
                    $fileData = $this->upload->data();
                    $this->Produk_model->insert_galeri([
                        'id_produk' => $id,
                        'foto' => $fileData['file_name']
                    ]);
                }
            }
        }

        $this->session->set_flashdata('success', 'Produk berhasil diperbarui!');
        redirect('admin/produk');
    }

    // Hapus produk
    public function hapus($id)
    {
        // 🔴 METHOD INI REDIRECT, TIDAK PERLU NOTIFIKASI
        
        $this->Produk_model->delete($id);
        $this->session->set_flashdata('success', 'Produk berhasil dihapus!');
        redirect('admin/produk');
    }
    
    // ── UPDATE STOK ──────────────────────────────────────────────────
    public function update_stok($id)
    {
        // 🔴 METHOD INI AJAX/REDIRECT, TIDAK PERLU NOTIFIKASI
        
        $stok = $this->input->post('stok_produk');
        $this->Produk_model->update($id, ['stok_produk' => $stok]);
        
        // Cek stok menipis (< 20)
        if ($stok < 20) {
            $produk = $this->Produk_model->getById($id);
            send_notifikasi(
                1, // ID Admin
                'Admin',
                '⚠️ Stok Menipis',
                'Stok produk ' . $produk['nama_produk'] . ' tersisa ' . $stok . ' kg. Segera isi ulang!',
                'warning',
                base_url('admin/produk')
            );
        }
        
        if ($this->input->is_ajax_request()) {
            echo json_encode(['success' => true]);
        } else {
            redirect('admin/produk');
        }
    }
}
