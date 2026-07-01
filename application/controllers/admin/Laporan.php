<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Cek login (Modul 1 Auth)
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

        $this->load->model('Laporan_model');
        $this->load->model('Notifikasi_model');
    }

    public function index() {
        $id_user = $this->session->userdata('id_user');

        $data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);

        $data['kpi']        = $this->Laporan_model->get_kpi_laporan();
        $data['penjualan']  = $this->Laporan_model->get_laporan_penjualan();
        $data['petani']     = $this->Laporan_model->get_laporan_petani();
        $data['produk']     = $this->Laporan_model->get_laporan_produk();
        $data['keuangan']   = $this->Laporan_model->get_laporan_keuangan();
        $data['panen']      = $this->Laporan_model->get_laporan_panen();
        $data['tracking']   = $this->Laporan_model->get_laporan_tracking();
        $data['mitra']      = $this->Laporan_model->get_laporan_mitra();

        $data['chart_penjualan'] = $this->Laporan_model->get_chart_penjualan_bulanan();
        $data['chart_produk']    = $this->Laporan_model->get_chart_produk_terlaris();
        $data['chart_status']    = $this->Laporan_model->get_chart_status_transaksi();

        $data['filter_status'] = '';

        $this->load->view('admin/v_laporan', $data);
    }

    public function filter() {
        $id_user = $this->session->userdata('id_user');
        $filter  = ['status' => $this->input->post('status') ?? 'semua'];

        $data['notifikasi']   = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);

        $data['kpi']        = $this->Laporan_model->get_kpi_laporan();
        $data['penjualan']  = $this->Laporan_model->get_laporan_penjualan($filter);
        $data['petani']     = $this->Laporan_model->get_laporan_petani();
        $data['produk']     = $this->Laporan_model->get_laporan_produk();
        $data['keuangan']   = $this->Laporan_model->get_laporan_keuangan();
        $data['panen']      = $this->Laporan_model->get_laporan_panen();
        $data['tracking']   = $this->Laporan_model->get_laporan_tracking();
        $data['mitra']      = $this->Laporan_model->get_laporan_mitra();

        $data['chart_penjualan'] = $this->Laporan_model->get_chart_penjualan_bulanan();
        $data['chart_produk']    = $this->Laporan_model->get_chart_produk_terlaris();
        $data['chart_status']    = $this->Laporan_model->get_chart_status_transaksi();

        $data['filter_status'] = $filter['status'];
        $this->load->view('admin/v_laporan', $data);
    }

    public function export_excel() {
        $tab = $this->input->get('tab') ?? 'penjualan';

        header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
        header('Content-Disposition: attachment; filename="laporan_' . $tab . '_' . date('Ymd') . '.xls"');
        header('Cache-Control: max-age=0');

        $data['tab']     = $tab;
        $data['tanggal'] = date('d/m/Y H:i');

        switch ($tab) {
            case 'petani':   $data['rows'] = $this->Laporan_model->get_laporan_petani();   break;
            case 'produk':   $data['rows'] = $this->Laporan_model->get_laporan_produk();   break;
            case 'keuangan': $data['rows'] = $this->Laporan_model->get_laporan_keuangan(); break;
            case 'panen':    $data['rows'] = $this->Laporan_model->get_laporan_panen();    break;
            case 'mitra':    $data['rows'] = $this->Laporan_model->get_laporan_mitra();    break;
            default:         $data['rows'] = $this->Laporan_model->get_laporan_penjualan();break;
        }
        $this->load->view('admin/v_laporan_excel', $data);
    }

    public function print_pdf() {
        $tab    = $this->input->get('tab') ?? 'penjualan';
        $poktan = (int)($this->input->get('poktan') ?? 0); // 1 = Harum Manis, 2 = Batu Layar

        // Tanggal realtime format Indonesia
        $nm_bulan = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',
                     7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
        $nm_hari  = ['Sunday'=>'Minggu','Monday'=>'Senin','Tuesday'=>'Selasa',
                     'Wednesday'=>'Rabu','Thursday'=>'Kamis','Friday'=>'Jumat','Saturday'=>'Sabtu'];
        $data['tanggal'] = $nm_hari[date('l')] . ', ' . date('d') . ' ' . $nm_bulan[(int)date('m')] . ' ' . date('Y');
        $data['jam']     = date('H:i') . ' WIB';

        // Info Poktan
        $poktan_list = [
            0 => ['nama' => 'Poktan Liberchain', 'nama_singkat' => 'POKTAN LIBERCHAIN',
                  'alamat' => 'Sistem Manajemen Supply Chain Kopi Terpadu', 'lokasi' => 'Sambas'],
            1 => ['nama' => 'Kelompok Tani Harum Manis', 'nama_singkat' => 'KEL. TANI HARUM MANIS',
                  'alamat' => 'Desa Sempadian, Kecamatan Tekarang, Kabupaten Sambas, Kalimantan Barat',
                  'lokasi' => 'Sempadian, Tekarang'],
            2 => ['nama' => 'Kelompok Tani Batu Layar Sejahtera', 'nama_singkat' => 'KEL. TANI BATU LAYAR SEJAHTERA',
                  'alamat' => 'Desa Sendoyan, Kecamatan Sejangkung, Kabupaten Sambas, Kalimantan Barat',
                  'lokasi' => 'Sendoyan, Sejangkung'],
        ];
        $data['poktan']      = $poktan;
        $data['poktan_info'] = $poktan_list[$poktan] ?? $poktan_list[0];

        $data['tab']   = $tab;
        $data['admin'] = $this->session->userdata('nama') ?? 'Admin';

        switch ($tab) {
            case 'petani':   $data['rows'] = $this->Laporan_model->get_laporan_petani();   break;
            case 'produk':   $data['rows'] = $this->Laporan_model->get_laporan_produk();   break;
            case 'keuangan':
                $keu = $this->Laporan_model->get_laporan_keuangan();
                $data['rows']    = $keu['detail'];
                $data['summary'] = $keu;
                break;
            case 'panen':    $data['rows'] = $this->Laporan_model->get_laporan_panen();    break;
            case 'mitra':    $data['rows'] = $this->Laporan_model->get_laporan_mitra();    break;
            default:         $data['rows'] = $this->Laporan_model->get_laporan_penjualan();break;
        }
        $data['kpi'] = $this->Laporan_model->get_kpi_laporan();
        $this->load->view('admin/v_laporan_print', $data);
    }

    public function get_chart_data() {
        $type = $this->input->get('type') ?? 'penjualan';
        header('Content-Type: application/json');

        switch ($type) {
            case 'produk': $chart = $this->Laporan_model->get_chart_produk_terlaris(); break;
            case 'status': $chart = $this->Laporan_model->get_chart_status_transaksi(); break;
            default:       $chart = $this->Laporan_model->get_chart_penjualan_bulanan(); break;
        }
        echo json_encode(['success' => true, 'data' => $chart]);
    }
}
