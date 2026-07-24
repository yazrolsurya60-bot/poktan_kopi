<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		// CEK LOGIN & ROLE ADMIN
		if (!$this->session->userdata('id_user')) {
			redirect('auth/login');
		}

		if ($this->session->userdata('role') != 'Admin') {
			redirect('auth/login');
		}

		$this->load->model('Produk_model');
		$this->load->model('Notifikasi_model');
		$this->load->helper('url');
		$this->load->helper('notifikasi');
	}

	// Halaman utama produk
	public function index()
	{
		$id_user = $this->session->userdata('id_user');

		$data['title']        = 'Manajemen Produk - Sistem Supply Chain Kopi';
		$data['title_page']   = 'Manajemen Produk';
		$data['subtitle']     = 'Kelola data produk komoditas kopi Anda di sini';
		$data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
		$data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
		$data['role']         = 'Admin';

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

		// Load Template Partial
		$this->load->view('templates/admin/header', $data);
		$this->load->view('templates/admin/sidebar', $data);
		$this->load->view('admin/v_produk', $data);
		$this->load->view('templates/admin/footer');
	}

	// Form tambah produk
	public function tambah()
	{
		$id_user = $this->session->userdata('id_user');

		$data['title']        = 'Tambah Produk Baru - Admin';
		$data['title_page']   = 'Tambah Produk Baru';
		$data['subtitle']     = 'Silakan lengkapi spesifikasi produk komoditas kopi';
		$data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
		$data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
		$data['role']         = 'Admin';
		$data['produk']       = $this->Produk_model->getAll();

		$this->load->view('templates/admin/header', $data);
		$this->load->view('templates/admin/sidebar', $data);
		$this->load->view('admin/produk_tambah', $data);
		$this->load->view('templates/admin/footer');
	}

	// Simpan produk baru
	public function simpan()
	{
		$id_user = $this->session->userdata('id_user');
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
			'id_user'       => $id_user,
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

		send_notifikasi(
			$id_user,
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

		$data['title']        = 'Detail Produk - Admin';
		$data['title_page']   = 'Detail Produk';
		$data['subtitle']     = 'Informasi detail spesifikasi produk kopi';
		$data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
		$data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
		$data['role']         = 'Admin';

		$data['produk'] = $this->Produk_model->getById($id);
		$data['galeri'] = $this->Produk_model->getGaleriByProduk($id);

		$this->load->view('templates/admin/header', $data);
		$this->load->view('templates/admin/sidebar', $data);
		$this->load->view('admin/produk_detail', $data);
		$this->load->view('templates/admin/footer');
	}

	// Form edit produk
	public function edit($id)
	{
		$id_user = $this->session->userdata('id_user');

		$data['title']        = 'Edit Produk - Admin';
		$data['title_page']   = 'Edit Produk';
		$data['subtitle']     = 'Edit spesifikasi produk komoditas kopi';
		$data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
		$data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
		$data['role']         = 'Admin';

		$data['produk'] = $this->Produk_model->getById($id);
		$data['galeri'] = $this->Produk_model->getGaleriByProduk($id);

		$this->load->view('templates/admin/header', $data);
		$this->load->view('templates/admin/sidebar', $data);
		$this->load->view('admin/produk_edit', $data);
		$this->load->view('templates/admin/footer');
	}

	// Update produk
	public function update($id)
	{
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
			}
		}

		$this->Produk_model->update($id, $data);

		$this->session->set_flashdata('success', 'Produk berhasil diperbarui!');
		redirect('admin/produk');
	}

	// Hapus produk
	public function hapus($id)
	{
		$this->Produk_model->delete($id);
		$this->session->set_flashdata('success', 'Produk berhasil dihapus!');
		redirect('admin/produk');
	}
}