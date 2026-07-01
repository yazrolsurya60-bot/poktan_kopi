<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Panen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Cek login
        if (!$this->session->userdata('id_user')) {
            // $this->session->set_userdata([
            //     'id_user' => 2,
            //     'role' => 'Petani',
            //     'nama' => 'Test Petani'
            // ]);
            redirect('auth/login');
        }

        // Cek role Petani
        $current_role = $this->session->userdata('role');
        if ($current_role != 'Petani') {
            if ($current_role == 'Admin') {
                redirect('admin/dashboard');
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

    // M04-F02: Lihat Panen (List & Filter)
    public function index()
    {
        $id_user = $this->session->userdata('id_user');
        
        // M04-F09: Cek Notifikasi Jadwal Panen (Lahan yg belum panen > 30 hari)
        $unrecorded = $this->Panen_model->check_unrecorded_harvest($id_user);
        foreach ($unrecorded as $lahan) {
            // Cek apakah notif yang sama sudah ada hari ini
            $this->db->where('id_user', $id_user);
            $this->db->where('judul', 'Pengingat Panen');
            // $this->db->like('pesan', $lahan['nama_lahan']);
            // $this->db->where('DATE(created_at)', date('Y-m-d'));
            $cek = $this->db->get('tb_notifikasi')->row();

            if (!$cek) {
                $this->db->insert('tb_notifikasi', [
                    'id_user' => $id_user,
                    'judul' => 'Pengingat Panen',
                    // 'pesan' => 'Lahan ' . $lahan['nama_lahan'] . ' belum memiliki catatan panen dalam 30 hari terakhir. Harap perbarui data panen Anda.',
                    // 'tipe' => 'Warning',
                    // 'is_read' => 0,
                    // 'created_at' => date('Y-m-d H:i:s')
                ]);
            }
        }

        $filters = [
            'start_date' => $this->input->get('start_date'),
            'end_date'   => $this->input->get('end_date'),
            'id_lahan'   => $this->input->get('id_lahan'),
            'kualitas'   => $this->input->get('kualitas')
        ];

        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        
        $data['panen_list'] = $this->Panen_model->get_all_panen($id_user, $filters);
        $data['lahan_list'] = $this->Panen_model->get_lahan_by_petani($id_user);
        
        // M04-F07: Statistik Panen
        $data['statistik'] = $this->Panen_model->get_statistik_panen($id_user);

        $this->load->view('petani/panen/v_panen_index', $data);
    }

    // M04-F08: Export Excel
    public function export_excel()
    {
        $id_user = $this->session->userdata('id_user');
        $filters = [
            'start_date' => $this->input->get('start_date'),
            'end_date'   => $this->input->get('end_date'),
            'id_lahan'   => $this->input->get('id_lahan'),
            'kualitas'   => $this->input->get('kualitas')
        ];

        $panen_list = $this->Panen_model->get_all_panen($id_user, $filters);

        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Laporan_Panen_Petani_" . date('Ymd') . ".xls");

        echo "<table border='1'>";
        echo "<tr><th>No</th><th>Tanggal Panen</th><th>Lahan</th><th>Jumlah (Kg)</th><th>Kualitas</th><th>Catatan</th></tr>";
        $no = 1;
        foreach ($panen_list as $p) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $p['tanggal_panen'] . "</td>";
            echo "<td>" . $p['nama_lahan'] . "</td>";
            echo "<td>" . $p['jumlah_panen'] . "</td>";
            echo "<td>" . $p['kualitas'] . "</td>";
            echo "<td>" . $p['catatan'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    // M04-F01: Input Panen
    public function tambah()
    {
        $id_user = $this->session->userdata('id_user');
        
        if ($this->input->post()) {
            $config['upload_path']   = './uploads/panen/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = 2048;
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);
            // Buat folder jika belum ada
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0777, TRUE);
            }

            if (!$this->upload->do_upload('foto_panen')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('petani/panen/tambah');
            } else {
                $uploadData = $this->upload->data();
                $foto_panen = $uploadData['file_name'];

                $data = [
                    'id_user'       => $id_user,
                    'id_lahan'      => $this->input->post('id_lahan'),
                    'tanggal_panen' => $this->input->post('tanggal_panen'),
                    'jumlah_panen'  => $this->input->post('jumlah_panen'),
                    'kualitas'      => $this->input->post('kualitas'),
                    'catatan'       => $this->input->post('catatan'),
                    'foto_panen'    => $foto_panen
                ];

                $this->Panen_model->insert_panen($data);
                $this->session->set_flashdata('success', 'Data panen berhasil ditambahkan.');
                redirect('petani/panen');
            }
        }

        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['lahan_list'] = $this->Panen_model->get_lahan_by_petani($id_user);
        
        $this->load->view('petani/panen/v_panen_form', $data);
    }

    // M04-F04: Edit Panen
    public function edit($id_panen)
    {
        $id_user = $this->session->userdata('id_user');
        $panen = $this->Panen_model->get_panen_by_id($id_panen);
        
        if (!$panen || $panen['id_user'] != $id_user) {
            show_404();
        }

        if ($this->input->post()) {
            $data = [
                'id_lahan'      => $this->input->post('id_lahan'),
                'tanggal_panen' => $this->input->post('tanggal_panen'),
                'jumlah_panen'  => $this->input->post('jumlah_panen'),
                'kualitas'      => $this->input->post('kualitas'),
                'catatan'       => $this->input->post('catatan'),
            ];

            if (!empty($_FILES['foto_panen']['name'])) {
                $config['upload_path']   = './uploads/panen/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = 2048;
                $config['encrypt_name']  = TRUE;

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto_panen')) {
                    $uploadData = $this->upload->data();
                    $data['foto_panen'] = $uploadData['file_name'];
                    // Hapus foto lama
                    if ($panen['foto_panen'] && file_exists('./uploads/panen/' . $panen['foto_panen'])) {
                        unlink('./uploads/panen/' . $panen['foto_panen']);
                    }
                }
            }

            $this->Panen_model->update_panen($id_panen, $data);
            $this->session->set_flashdata('success', 'Data panen berhasil diperbarui.');
            redirect('petani/panen');
        }

        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['lahan_list'] = $this->Panen_model->get_lahan_by_petani($id_user);
        $data['panen'] = $panen;
        
        $this->load->view('petani/panen/v_panen_form', $data);
    }

    // M04-F03: Detail Panen
    public function detail($id_panen)
    {
        $id_user = $this->session->userdata('id_user');
        $panen = $this->Panen_model->get_panen_by_id($id_panen);
        
        if (!$panen || $panen['id_user'] != $id_user) {
            show_404();
        }

        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['panen'] = $panen;
        
        $this->load->view('petani/panen/v_panen_detail', $data);
    }

    // M04-F05: Hapus Panen
    public function hapus($id_panen)
    {
        $id_user = $this->session->userdata('id_user');
        $panen = $this->Panen_model->get_panen_by_id($id_panen);
        
        if ($panen && $panen['id_user'] == $id_user) {
            if ($panen['foto_panen'] && file_exists('./uploads/panen/' . $panen['foto_panen'])) {
                unlink('./uploads/panen/' . $panen['foto_panen']);
            }
            $this->Panen_model->delete_panen($id_panen);
            $this->session->set_flashdata('success', 'Data panen berhasil dihapus.');
        }
        redirect('petani/panen');
    }
}
