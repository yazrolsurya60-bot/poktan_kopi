<?php
// application/controllers/Notifikasi.php

defined('BASEPATH') or exit('No direct script access allowed');

class Notifikasi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Notifikasi_model');

		// Cek Login User
		if (!$this->session->userdata('id_user')) {
			redirect('auth/login');
		}
	}

	/**
	 * Halaman History Notifikasi (M11-F02)
	 */
	public function history()
	{
		$id_user = $this->session->userdata('id_user');

		$data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
		$data['history']      = $this->Notifikasi_model->get_all_notif($id_user);
		$data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);

		$this->load->view('template/v_notif_history', $data);
	}

	/**
	 * Halaman Pengaturan Notifikasi (M11-F03)
	 */
	public function setting()
	{
		$id_user = $this->session->userdata('id_user');

		if ($this->input->post()) {
			$this->Notifikasi_model->update_settings($id_user, $this->input->post());
			$this->session->set_flashdata('success', 'Preferensi notifikasi berhasil diperbarui.');
			redirect('notifikasi/setting');
		}

		$data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
		$data['settings']     = $this->Notifikasi_model->get_settings($id_user);
		$data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);

		$this->load->view('template/v_notif_setting', $data);
	}

	/**
	 * Tandai notifikasi sebagai dibaca & Redirect
	 */
	public function read($id_notif)
	{
		$id_user = $this->session->userdata('id_user');

		// 1. Tandai sebagai dibaca di Database (status_baca = 1)
		$this->Notifikasi_model->mark_as_read($id_notif, $id_user);

		// 2. Cek apakah ada parameter redirect GET dari URL
		$redirect_get = $this->input->get('redirect');

		// 3. Dapatkan link bawaan dari database
		$this->db->select('link');
		$this->db->where('id_notifikasi', $id_notif);
		$query = $this->db->get('tb_notifikasi');
		$notif = $query->row_array();

		$target_link = $redirect_get ?? $notif['link'] ?? null;

		// 4. Redirect ke halaman tujuan
		if (!empty($target_link) && $target_link != '#') {
			redirect($target_link);
		} else {
			// ✅ PERBAIKAN: Jika link kosong, kembalikan ke halaman history notifikasi ini lagi
			redirect('notifikasi/history');
		}
	}
}
