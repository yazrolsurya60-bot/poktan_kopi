<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lahan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Me-load database, model, dan library yang diperlukan
        $this->load->model('Lahan_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('text');
    }

   public function index() {
        $filters = [
            'status_lahan' => $this->input->get('status_lahan'),
            'lokasi' => $this->input->get('lokasi')
        ];

        $data['title'] = "Panel petani: Data Lahan Kopi";
        // Menggunakan get_all_lahan() dengan parameter null agar admin bisa memonitor seluruh petani
        $data['lahan'] = $this->Lahan_model->get_all_lahan(null, $filters);

        // Load halaman view admin utama Anda
        $this->load->view('petani/lahan/index', $data);
    }

 public function tambah() {
    // 1. Cek apakah ada data yang dikirim
    if ($this->input->server('REQUEST_METHOD') != 'POST') {
        // Jika bukan akses POST, arahkan ke halaman form
        $this->load->view('petani/lahan/tambah');
        return;
    }

    // 2. Konfigurasi Upload
    $config['upload_path']   = './assets/uploads/lahan/';
    $config['allowed_types'] = 'jpg|jpeg|png|gif';
    $config['max_size']      = 2048;
    $this->load->library('upload', $config);

    // 3. Tangkap Data
    $data = array(
        'id_user'      => $this->session->userdata('id_user'),
        'nama_lahan'   => $this->input->post('nama_lahan'),
        'jenis_kopi'   => $this->input->post('jenis_kopi'),
        'jenis_tanah'  => $this->input->post('jenis_tanah'),
        'luas'         => $this->input->post('luas'),
        'lokasi'       => $this->input->post('lokasi'),
        'latitude'     => $this->input->post('latitude'),
        'longitude'    => $this->input->post('longitude'),
        'status_lahan' => $this->input->post('status_lahan'),
        'catatan'      => $this->input->post('catatan') // Pastikan 'catatan' ada di input name
    );

    // 4. Proses Upload Foto
    if (!empty($_FILES['foto_lahan']['name'])) {
        if ($this->upload->do_upload('foto_lahan')) {
            $data['foto_lahan'] = $this->upload->data('file_name');
        } else {
            // Tampilkan error jika gagal upload
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('petani/lahan/tambah');
        }
    }

    // 5. Insert ke Database
    if ($this->db->insert('tb_lahan', $data)) {
        $this->session->set_flashdata('success', 'Data lahan berhasil disimpan!');
        redirect('petani/lahan');
    } else {
        echo "Database Error: Gagal menyimpan ke tabel.";
    }

}
public function edit($id) {
    // Mengambil data lahan berdasarkan ID
    $data['lahan'] = $this->db->get_where('tb_lahan', ['id_lahan' => $id])->row_array();

    // Memastikan data ditemukan
    if (!$data['lahan']) {
        show_404();
    }

    $this->load->view('petani/lahan/edit', $data);
}
public function update() {
    // 1. Ambil ID dari input hidden
    $id = $this->input->post('id_lahan');

    // 2. Siapkan data yang akan diupdate
    $data = array(
        'nama_lahan'   => $this->input->post('nama_lahan'),
        'jenis_kopi'   => $this->input->post('jenis_kopi'),
        'jenis_tanah'  => $this->input->post('jenis_tanah'),
        'luas'         => $this->input->post('luas'),
        'lokasi'       => $this->input->post('lokasi'),
        'latitude'     => $this->input->post('latitude'),
        'longitude'    => $this->input->post('longitude'),
        'catatan'      => $this->input->post('catatan'),
        'status_lahan' => $this->input->post('status_lahan')
        
    );

    // 3. Proses upload foto jika user memilih file baru
        if (!empty($_FILES['foto_lahan']['name'])) {
            $config['upload_path']   = './assets/uploads/lahan/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size']      = 2048;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto_lahan')) {
                $data['foto_lahan'] = $this->upload->data('file_name');
            }
        }

    // 4. Lakukan update ke database
    $this->db->where('id_lahan', $id);
    $this->db->update('tb_lahan', $data); // Sesuaikan dengan nama tabel Anda

    // 5. Redirect kembali ke halaman daftar lahan
    $this->session->set_flashdata('message', 'Data berhasil diupdate!');
    redirect('petani/lahan');
}
public function detail($id) {
    // 1. Ambil data lahan
    $data['lahan'] = $this->Lahan_model->get_detail($id);
    
    // Validasi jika lahan tidak ditemukan
    if (empty($data['lahan'])) {
        show_404();
    }

    // 2. Ambil data panen (Memanggil model milik teman Anda)
    $this->load->model('Panen_model'); 
    $data['riwayat_panen'] = $this->Panen_model->get_panen_by_lahan($id);
    
    // 3. Load view
    // Pastikan nama file view-nya konsisten (apakah 'petani/lahan/detail' atau 'petani/lahan_detail')
    $this->load->view('petani/lahan/detail', $data);
}

    public function hapus($id) {
        $this->Lahan_model->hapus_data($id);
        $this->session->set_flashdata('message', 'Data berhasil dihapus');
        redirect('petani/lahan');
    }
    
  
}