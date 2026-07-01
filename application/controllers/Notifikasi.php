<?php
// application/controllers/Notifikasi.php

defined('BASEPATH') or exit('No direct script access allowed');

class Notifikasi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Notifikasi_model');

		// 🔴 PERBAIKI: Gunakan 'id_user' bukan 'logged_in'
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

		// 🔴 TAMBAHKAN: Data notifikasi
		$data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
		$data['history'] = $this->Notifikasi_model->get_all_notif($id_user);
		$data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);

		// 🔴 PERBAIKI: Langsung load view tanpa header/footer
		$this->load->view('template/v_notif_history', $data);
	}

	/**
	 * Halaman Pengaturan Notifikasi (M11-F03)
	 */
	public function setting()
	{
		$id_user = $this->session->userdata('id_user');

		// 🔴 TAMBAHKAN: Proses submit form
		if ($this->input->post()) {
			$this->Notifikasi_model->update_settings($id_user, $this->input->post());
			$this->session->set_flashdata('success', 'Preferensi notifikasi berhasil diperbarui.');
			redirect('notifikasi/setting');
		}

		// 🔴 TAMBAHKAN: Data notifikasi
		$data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
		$data['settings'] = $this->Notifikasi_model->get_settings($id_user);
		$data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);

		// 🔴 PERBAIKI: Langsung load view tanpa header/footer
		$this->load->view('template/v_notif_setting', $data);
	}

	/**
	 * Tandai notifikasi sebagai dibaca
	 */
	public function read($id_notif)
	{
		$id_user = $this->session->userdata('id_user');

		// Tandai sebagai dibaca
		$this->Notifikasi_model->mark_as_read($id_notif, $id_user);

		// Dapatkan link
		$this->db->select('link');
		$this->db->where('id_notifikasi', $id_notif);
		$query = $this->db->get('tb_notifikasi');
		$notif = $query->row_array();

		// Redirect
		if (!empty($notif['link']) && $notif['link'] != '#') {
			redirect($notif['link']);
		} else {
			$role = $this->session->userdata('role');
			redirect($role . '/dashboard/history');
		}
	}
}
