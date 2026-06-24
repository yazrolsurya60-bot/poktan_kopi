<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Produk_model');
    }

    // Halaman utama produk + filter
    public function index()
    {
        $keyword = $this->input->get('keyword');

        if ($keyword) {

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
        $this->load->view('admin/produk_tambah');
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

    $this->Produk_model->insert($data);

    redirect('admin/produk');
}
    // Detail produk
    public function detail($id)
    {
        $data['produk'] = $this->Produk_model->getById($id);

        $this->load->view('admin/produk_detail', $data);
    }

    // Form edit produk
    public function edit($id)
    {
        $data['produk'] = $this->Produk_model->getById($id);

        $this->load->view('admin/produk_edit', $data);
    }

    // Update produk
    public function update($id)
    {
        $data = array(
            'nama_produk' => $this->input->post('nama_produk'),
            'jenis_kopi' => $this->input->post('jenis_kopi'),
            'grade' => $this->input->post('grade'),
            'harga' => $this->input->post('harga'),
            'stok_produk' => $this->input->post('stok_produk'),
            'altitude' => $this->input->post('altitude'),
            'proses' => $this->input->post('proses'),
            'flavor_notes' => $this->input->post('flavor_notes'),
            'status_produk' => $this->input->post('status_produk'),
            'deskripsi' => $this->input->post('deskripsi')
        );

        $this->Produk_model->update($id, $data);

        redirect('admin/produk');
    }

    // Hapus produk
    public function hapus($id)
    {
        $this->Produk_model->delete($id);

        redirect('admin/produk');
    }
}
