<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Panen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Cek login & proteksi role Admin
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login');
        }

        $current_role = $this->session->userdata('role');
        if ($current_role != 'Admin') {
            if ($current_role == 'Petani') {
                redirect('petani/dashboard');
            } elseif ($current_role == 'Pembeli') {
                redirect('pembeli/dashboard');
            } elseif ($current_role == 'Kurir') {
                redirect('kurir/tracking');
            } else {
                $this->session->sess_destroy();
                redirect('auth/login');
            }
        }

        $this->load->model('Panen_model');
        $this->load->model('Notifikasi_model');
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_user');
        
        $filters = [
            'start_date' => $this->input->get('start_date'),
            'end_date'   => $this->input->get('end_date'),
            'id_lahan'   => $this->input->get('id_lahan'),
            'kualitas'   => $this->input->get('kualitas')
        ];

        $data['title']        = 'Rekap Hasil Panen - Sistem Supply Chain Kopi';
        $data['title_page']   = 'Rekap Hasil Panen';
        $data['subtitle']     = 'Laporan rekapitulasi data panen dari seluruh petani.';
        $data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role']         = 'Admin';
        
        // Admin melihat semua data panen dengan filter
        $data['panen_list']   = $this->Panen_model->get_all_panen(null, $filters);
        
        // Load Template Partials
        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('admin/panen/v_panen_index', $data);
        $this->load->view('templates/admin/footer');
    }

    public function detail($id_panen)
    {
        $id_user = $this->session->userdata('id_user');
        $panen = $this->Panen_model->get_panen_by_id($id_panen);
        
        if (!$panen) {
            show_404();
        }

        $data['title']        = 'Detail Panen - Sistem Supply Chain Kopi';
        $data['title_page']   = 'Detail Panen';
        $data['subtitle']     = 'Informasi lengkap hasil panen Petani.';
        $data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['role']         = 'Admin';
        $data['panen']        = $panen;
        
        // Load Template Partials
        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('admin/panen/v_panen_detail', $data);
        $this->load->view('templates/admin/footer');
    }

    public function export_excel()
    {
        $filters = [
            'start_date' => $this->input->get('start_date'),
            'end_date'   => $this->input->get('end_date'),
            'kualitas'   => $this->input->get('kualitas')
        ];

        $panen_list = $this->Panen_model->get_all_panen(null, $filters);

        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Laporan_Panen_Admin_" . date('Ymd') . ".xls");

        echo "<table border='1'>";
        echo "<tr><th>No</th><th>Tanggal Panen</th><th>Nama Petani</th><th>Lahan</th><th>Jumlah (Kg)</th><th>Kualitas</th><th>Catatan</th></tr>";
        $no = 1;
        foreach ($panen_list as $p) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $p['tanggal_panen'] . "</td>";
            echo "<td>" . $p['nama_petani'] . "</td>";
            echo "<td>" . $p['nama_lahan'] . "</td>";
            echo "<td>" . $p['jumlah_panen'] . "</td>";
            echo "<td>" . $p['kualitas'] . "</td>";
            echo "<td>" . $p['catatan'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}
