<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Petani extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Proteksi login & Role Admin
		if (!$this->session->userdata('id_user') || $this->session->userdata('role') !== 'Admin') {
			redirect('auth/login');
		}
		$this->load->model('Petani_model');
		$this->load->model('Notifikasi_model');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('pagination'); // Library Pagination
		$this->load->helper('url');
	}

	// ── 1. LIST Petani (Dengan Pagination) ───────────────────────────
	public function index()
	{
		$id_user = $this->session->userdata('id_user');

		$data['title']        = 'Manajemen Petani - Sistem Supply Chain Kopi';
		$data['title_page']   = 'Manajemen Petani';
		$data['subtitle']     = 'Kelola data seluruh petani kopi yang terdaftar di sistem';
		$data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
		$data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
		$data['role']         = 'Admin';

		$status  = $this->input->get('status');
		$wilayah = $this->input->get('wilayah');

		// Konfigurasi Pagination
		$config['base_url']             = base_url('admin/petani');
		$config['total_rows']           = $this->Petani_model->count_all_petani($status, $wilayah);
		$config['per_page']             = 10;
		$config['page_query_string']    = TRUE;
		$config['query_string_segment'] = 'per_page';
		$config['reuse_query_string']   = TRUE;

		// Styling Tombol Pagination
		$config['full_tag_open']   = '<ul class="pagination pagination-sm m-0">';
		$config['full_tag_close']  = '</ul>';
		$config['first_link']      = '&laquo;';
		$config['first_tag_open']  = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['last_link']       = '&raquo;';
		$config['last_tag_open']   = '<li class="page-item">';
		$config['last_tag_close']  = '</li>';
		$config['next_link']       = '&rsaquo;';
		$config['next_tag_open']   = '<li class="page-item">';
		$config['next_tag_close']  = '</li>';
		$config['prev_link']       = '&lsaquo;';
		$config['prev_tag_open']   = '<li class="page-item">';
		$config['prev_tag_close']  = '</li>';
		$config['cur_tag_open']    = '<li class="page-item active"><span class="page-link" style="background-color: #4A2C11; border-color: #4A2C11; color: #fff;">';
		$config['cur_tag_close']   = '</span></li>';
		$config['num_tag_open']    = '<li class="page-item">';
		$config['num_tag_close']   = '</li>';
		$config['attributes']      = array('class' => 'page-link text-dark');

		$this->pagination->initialize($config);

		$page = $this->input->get('per_page') ? $this->input->get('per_page') : 0;

		$data['daftar_petani']         = $this->Petani_model->get_daftar_petani_paginated($config['per_page'], $page, $status, $wilayah);
		$data['pagination_link']       = $this->pagination->create_links();
		$data['status_filter']         = $status;
		$data['wilayah_filter']        = $wilayah;
		$data['semua_wilayah']         = $this->Petani_model->get_all_wilayah();
		$data['total_petani_filtered'] = $config['total_rows'];

		// Hitung statistik untuk KPI cards
		$semua = $this->Petani_model->get_daftar_petani();
		$active_count = 0;
		$inactive_count = 0;
		$suspended_count = 0;
		foreach ($semua as $p) {
			if ($p['status_petani'] == 'Active')
				$active_count++;
			else if ($p['status_petani'] == 'Inactive')
				$inactive_count++;
			else if ($p['status_petani'] == 'Suspended')
				$suspended_count++;
		}
		$data['total_petani']    = count($semua);
		$data['active_count']   = $active_count;
		$data['inactive_count'] = $inactive_count;
		$data['suspended_count'] = $suspended_count;

		// Load Template Partials
		$this->load->view('templates/admin/header', $data);
		$this->load->view('templates/admin/sidebar', $data);
		$this->load->view('admin/Petani_list', $data);
		$this->load->view('templates/admin/footer');
	}

	// ── 2. DETAIL Petani ─────────────────────────────────────────────
	public function detail($id)
	{
		$id_user = $this->session->userdata('id_user');

		$data['title']        = 'Detail Petani - Sistem Supply Chain Kopi';
		$data['title_page']   = 'Detail Petani';
		$data['subtitle']     = 'Informasi lengkap dan status verifikasi dokumen petani';
		$data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
		$data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
		$data['role']         = 'Admin';

		$data['petani'] = $this->Petani_model->get_petani_by_id($id);
		if (!$data['petani']) {
			show_404();
		}

		// Load Template Partials
		$this->load->view('templates/admin/header', $data);
		$this->load->view('templates/admin/sidebar', $data);
		$this->load->view('admin/Petani_detail', $data);
		$this->load->view('templates/admin/footer');
	}

	// ── 3. FORM Tambah ───────────────────────────────────────────────
	public function tambah()
	{
		$id_user = $this->session->userdata('id_user');

		$data['title']        = 'Tambah Petani - Sistem Supply Chain Kopi';
		$data['title_page']   = 'Tambah Petani';
		$data['subtitle']     = 'Registrasi data petani baru ke dalam sistem';
		$data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
		$data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
		$data['role']         = 'Admin';

		$data['semua_wilayah'] = $this->Petani_model->get_all_wilayah();

		// Load Template Partials
		$this->load->view('templates/admin/header', $data);
		$this->load->view('templates/admin/sidebar', $data);
		$this->load->view('admin/Petani_form', $data);
		$this->load->view('templates/admin/footer');
	}

	// ── 4. PROSES Tambah ─────────────────────────────────────────────
	public function tambah_aksi()
	{
		$this->form_validation->set_rules('nama_petani', 'Nama Petani', 'required|trim');
		$this->form_validation->set_rules('nik', 'NIK', 'required|trim|numeric|exact_length[16]');
		$this->form_validation->set_rules('no_hp', 'No HP', 'required|trim|numeric|min_length[9]|max_length[15]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			$id_user = $this->session->userdata('id_user');

			$data['title']        = 'Tambah Petani - Sistem Supply Chain Kopi';
			$data['title_page']   = 'Tambah Petani';
			$data['subtitle']     = 'Registrasi data petani baru ke dalam sistem';
			$data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
			$data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
			$data['role']         = 'Admin';

			$data['semua_wilayah'] = $this->Petani_model->get_all_wilayah();

			$this->load->view('templates/admin/header', $data);
			$this->load->view('templates/admin/sidebar', $data);
			$this->load->view('admin/Petani_form', $data);
			$this->load->view('templates/admin/footer');
			return;
		}

		$data = [
			'nama_petani'    => $this->input->post('nama_petani', TRUE),
			'nik'            => $this->input->post('nik', TRUE),
			'no_hp'          => $this->input->post('no_hp', TRUE),
			'alamat'         => $this->input->post('alamat', TRUE),
			'domisili'       => $this->input->post('domisili', TRUE),
			'tanggal_lahir'  => $this->input->post('tanggal_lahir', TRUE),
			'status_petani'  => $this->input->post('status') ?: 'Inactive',
			'tanggal_daftar' => date('Y-m-d'),
		];

		// Upload Foto Profil jika ada
		$upload_path = './uploads/dokumen/';
		if (!is_dir($upload_path)) {
			mkdir($upload_path, 0755, true);
		}
		$config['upload_path']   = $upload_path;
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size']      = 2048;
		$this->upload->initialize($config);

		if (!empty($_FILES['foto_profil']['name'])) {
			if ($this->upload->do_upload('foto_profil')) {
				$data['foto_profil'] = $this->upload->data('file_name');
			}
		}

		$id_petani_baru = $this->Petani_model->insert_petani($data);

		$wilayah_dipilih = $this->input->post('wilayah') ?: [];
		$this->Petani_model->simpan_wilayah_petani($id_petani_baru, $wilayah_dipilih);

		// FLASH MESSAGE TAMBAH
		$this->session->set_flashdata('pesan', 'Data petani baru berhasil ditambahkan!');
		redirect('admin/petani');
	}

	// ── 5. FORM Edit ─────────────────────────────────────────────────
	public function edit($id)
	{
		$id_user = $this->session->userdata('id_user');

		$data['title']        = 'Edit Petani - Sistem Supply Chain Kopi';
		$data['title_page']   = 'Edit Petani';
		$data['subtitle']     = 'Perbarui data profil dan informasi wilayah petani';
		$data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
		$data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
		$data['role']         = 'Admin';

		$data['petani'] = $this->Petani_model->get_petani_by_id($id);
		if (!$data['petani']) {
			show_404();
		}
		$data['semua_wilayah'] = $this->Petani_model->get_all_wilayah();

		// Load Template Partials
		$this->load->view('templates/admin/header', $data);
		$this->load->view('templates/admin/sidebar', $data);
		$this->load->view('admin/Petani_edit', $data);
		$this->load->view('templates/admin/footer');
	}

	// ── 6. PROSES Update ─────────────────────────────────────────────
	public function update_aksi($id)
	{
		$this->form_validation->set_rules('nama_petani', 'Nama Petani', 'required|trim');
		$this->form_validation->set_rules('nik', 'NIK', 'required|trim|numeric|exact_length[16]');
		$this->form_validation->set_rules('no_hp', 'No HP', 'required|trim|numeric|min_length[9]|max_length[15]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			$this->edit($id);
			return;
		}

		$data = [
			'nama_petani'   => $this->input->post('nama_petani', TRUE),
			'nik'           => $this->input->post('nik', TRUE),
			'no_hp'         => $this->input->post('no_hp', TRUE),
			'alamat'        => $this->input->post('alamat', TRUE),
			'status_petani' => $this->input->post('status', TRUE),
		];

		$upload_path = './uploads/dokumen/';
		if (!is_dir($upload_path)) {
			mkdir($upload_path, 0755, true);
		}

		$config['upload_path']   = $upload_path;
		$config['allowed_types'] = 'jpg|jpeg|png|pdf';
		$config['max_size']      = 2048;
		$this->upload->initialize($config);

		$fields = ['file_sertifikat', 'foto_profil'];
		foreach ($fields as $field) {
			if (!empty($_FILES[$field]['name'])) {
				if ($this->upload->do_upload($field)) {
					$data[$field] = $this->upload->data('file_name');
				}
			}
		}

		$this->Petani_model->update_petani($id, $data);

		$wilayah_dipilih = $this->input->post('wilayah') ?: [];
		$this->Petani_model->simpan_wilayah_petani($id, $wilayah_dipilih);

		// FLASH MESSAGE EDIT
		$this->session->set_flashdata('pesan', 'Data petani berhasil diperbarui!');
		redirect('admin/petani');
	}

	// ── 7. VERIFIKASI Petani ─────────────────────────────────────────
	public function verifikasi($id)
	{
		$id_user = $this->session->userdata('id_user');

		$data['title']        = 'Verifikasi Petani - Sistem Supply Chain Kopi';
		$data['title_page']   = 'Verifikasi Petani';
		$data['subtitle']     = 'Lakukan proses verifikasi akun dan kelayakan dokumen petani';
		$data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
		$data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
		$data['role']         = 'Admin';

		$data['petani'] = $this->Petani_model->get_petani_by_id($id);
		if (!$data['petani']) {
			show_404();
		}

		// Load Template Partials
		$this->load->view('templates/admin/header', $data);
		$this->load->view('templates/admin/sidebar', $data);
		$this->load->view('admin/Petani_verifikasi', $data);
		$this->load->view('templates/admin/footer');
	}

	// ── 7b. PROSES Verifikasi Aksi ────────────────────────────────────
	public function verifikasi_aksi($id)
	{
		$petani = $this->Petani_model->get_petani_by_id($id);
		if (!$petani) {
			show_404();
		}

		$status  = $this->input->post('status');
		$catatan = $this->input->post('catatan');

		$update_data = [
			'status_petani'      => $status,
			'catatan_verifikasi' => $catatan
		];

		if ($status === 'Active') {
			$update_data['status_sertifikat'] = 'Terverifikasi';

			$this->load->helper('notifikasi');
			if (function_exists('send_notifikasi')) {
				send_notifikasi(
					$petani['id_user'] ?? $id,
					'Petani',
					'✅ Akun Petani Terverifikasi',
					'Akun Petani Anda telah diverifikasi oleh Admin. Sekarang Anda dapat mengelola lahan dan produk.',
					'success',
					base_url('petani/dashboard')
				);
			}
		} elseif ($status === 'Suspended') {
			$update_data['status_sertifikat'] = 'Ditolak';
		}

		$this->Petani_model->update_petani($id, $update_data);

		// FLASH MESSAGE VERIFIKASI
		$this->session->set_flashdata('pesan', 'Status verifikasi petani berhasil diperbarui!');
		redirect('admin/petani');
	}

	// ── 8. VERIFIKASI Dokumen Spesifik ────────────────────────────────
	public function verifikasi_dokumen($id, $jenis_dokumen, $status_baru = 'Terverifikasi')
	{
		$allowed_jenis  = ['status_sertifikat'];
		$allowed_status = ['Terverifikasi', 'Ditolak'];
		if (in_array($jenis_dokumen, $allowed_jenis) && in_array($status_baru, $allowed_status)) {
			$this->Petani_model->update_petani($id, [$jenis_dokumen => $status_baru]);
			$msg = ($status_baru === 'Terverifikasi') ? 'Dokumen sertifikat berhasil disetujui!' : 'Dokumen sertifikat berhasil ditolak!';
			$this->session->set_flashdata('pesan', $msg);
		} else {
			$this->session->set_flashdata('error', 'Parameter verifikasi tidak valid!');
		}
		redirect('admin/petani/detail/' . $id);
	}

	// ── 8b. UPLOAD Dokumen Petani oleh Admin ─────────────────────────
	public function upload_dokumen($id)
	{
		$petani = $this->Petani_model->get_petani_by_id($id);
		if (!$petani) {
			show_404();
		}

		$jenis_dokumen = $this->input->post('jenis_dokumen');
		$allowed_jenis = ['file_sertifikat'];

		if (!in_array($jenis_dokumen, $allowed_jenis)) {
			$this->session->set_flashdata('error', 'Jenis dokumen tidak valid!');
			redirect('admin/petani/detail/' . $id);
			return;
		}

		$upload_path = './uploads/dokumen/';
		if (!is_dir($upload_path)) {
			mkdir($upload_path, 0755, true);
		}

		$config['upload_path']   = $upload_path;
		$config['allowed_types'] = 'jpg|jpeg|png|pdf';
		$config['max_size']      = 5120;
		$config['file_name']     = $jenis_dokumen . '_petani_' . $id . '_' . time();
		$this->upload->initialize($config);

		if ($this->upload->do_upload('file_dokumen')) {
			$file_name  = $this->upload->data('file_name');
			$status_key = 'status_' . str_replace('file_', '', $jenis_dokumen);
			$this->Petani_model->update_petani($id, [
				$jenis_dokumen => $file_name,
				$status_key    => 'Menunggu'
			]);
			$this->session->set_flashdata('pesan', 'Dokumen berhasil diunggah!');
		} else {
			$this->session->set_flashdata('error', 'Unggah dokumen gagal: ' . $this->upload->display_errors('', ''));
		}

		redirect('admin/petani/detail/' . $id);
	}

	// ── 9. HAPUS Petani (PERMANEN DARI DATABASE & BERKAS) ────────────
	public function hapus($id)
	{
		if ($id) {
			$petani = $this->Petani_model->get_petani_by_id($id);
			if ($petani) {
				// Hapus foto profil dari folder jika ada
				if (!empty($petani['foto_profil']) && file_exists('./uploads/dokumen/' . $petani['foto_profil'])) {
					@unlink('./uploads/dokumen/' . $petani['foto_profil']);
				}
				// Hapus berkas sertifikat jika ada
				if (!empty($petani['file_sertifikat']) && file_exists('./uploads/dokumen/' . $petani['file_sertifikat'])) {
					@unlink('./uploads/dokumen/' . $petani['file_sertifikat']);
				}

				// Hapus Permanen dari Database
				$this->Petani_model->delete_petani($id);
				$this->session->set_flashdata('pesan', 'Data petani berhasil dihapus secara permanen dari database!');
			} else {
				$this->session->set_flashdata('error', 'Data petani tidak ditemukan!');
			}
		}
		redirect('admin/petani');
	}

	// ── 10. EXPORT PAGE ──────────────────────────────────────────────
	public function export_page()
	{
		$id_user = $this->session->userdata('id_user');

		$data['title']        = 'Export Data Petani - Sistem Supply Chain Kopi';
		$data['title_page']   = 'Export Data Petani';
		$data['subtitle']     = 'Unduh dan cetak laporan data petani sesuai kriteria yang diinginkan';
		$data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
		$data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
		$data['role']         = 'Admin';
		$data['semua_wilayah'] = $this->Petani_model->get_all_wilayah();

		// Load Template Partials
		$this->load->view('templates/admin/header', $data);
		$this->load->view('templates/admin/sidebar', $data);
		$this->load->view('admin/Petani_export', $data);
		$this->load->view('templates/admin/footer');
	}

	// ── 11. EXPORT PROCESS ───────────────────────────────────────────
	public function export_process()
	{
		$format = $this->input->post('format') ?: 'pdf';
		$status = $this->input->post('status');
		$wilayah = $this->input->post('id_wilayah');

		$data['daftar_petani'] = $this->Petani_model->get_daftar_petani($status, $wilayah);

		if ($format == 'excel') {
			header("Content-type: application/vnd-ms-excel");
			header("Content-Disposition: attachment; filename=Data_Petani_" . date('Y-m-d') . ".xls");
			echo "<table border='1'>";
			echo "<tr>
                    <th>No</th>
                    <th>Nama Petani</th>
                    <th>NIK</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th>Status Petani</th>
                    <th>Tanggal Daftar</th>
                  </tr>";
			$no = 1;
			foreach ($data['daftar_petani'] as $p) {
				echo "<tr>
                        <td>{$no}</td>
                        <td>{$p['nama_petani']}</td>
                        <td>{$p['nik']}</td>
                        <td>{$p['no_hp']}</td>
                        <td>{$p['alamat']}</td>
                        <td>{$p['status_petani']}</td>
                        <td>{$p['tanggal_daftar']}</td>
                      </tr>";
				$no++;
			}
			echo "</table>";
		} else {
			$this->load->view('admin/Petani_export_pdf', $data);
		}
	}

	// ── 12. EXPORT PDF ───────────────────────────────────────────────
	public function export_pdf()
	{
		$status = $this->input->get('status');
		$wilayah = $this->input->get('id_wilayah');
		$data['daftar_petani'] = $this->Petani_model->get_daftar_petani($status, $wilayah);
		$this->load->view('admin/Petani_export_pdf', $data);
	}

	// ── 13. EXPORT EXCEL ──────────────────────────────────────────────
	public function export_excel()
	{
		$status = $this->input->get('status');
		$wilayah = $this->input->get('id_wilayah');
		$data['daftar_petani'] = $this->Petani_model->get_daftar_petani($status, $wilayah);

		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Data_Petani_" . date('Y-m-d') . ".xls");
		echo "<table border='1'>";
		echo "<tr>
                <th>No</th>
                <th>Nama Petani</th>
                <th>NIK</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Status Petani</th>
                <th>Tanggal Daftar</th>
              </tr>";
		$no = 1;
		foreach ($data['daftar_petani'] as $p) {
			echo "<tr>
                    <td>{$no}</td>
                    <td>{$p['nama_petani']}</td>
                    <td>{$p['nik']}</td>
                    <td>{$p['no_hp']}</td>
                    <td>{$p['alamat']}</td>
                    <td>{$p['status_petani']}</td>
                    <td>{$p['tanggal_daftar']}</td>
                  </tr>";
			$no++;
		}
		echo "</table>";
	}
}