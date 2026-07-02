<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracking extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        if (!$this->session->userdata('id_user')) {
            redirect('auth/login');
        }

        if ($this->session->userdata('role') !== 'Kurir') {
            show_error('Akses ditolak. Halaman ini hanya untuk Kurir.', 403);
        }

        $this->load->model('Tracking_model');
        $this->load->model('Notifikasi_model');
        $this->load->helper('notifikasi');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_user');

        $data['trackings'] = $this->Tracking_model->get_kurir_tracking($id_user, 10);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($id_user);
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($id_user, 5);

        foreach ($data['trackings'] as &$track) {
            $status_info = $this->Tracking_model->get_status_label($track->status_pengiriman);
            $track->status_label = $status_info['label'];
            $track->status_class = $status_info['class'];
            $track->status_icon = $status_info['icon'];
        }

        $this->load->view('template/header', ['title' => 'Dashboard Kurir']);
        $this->load->view('kurir/tracking_dashboard', $data);
        $this->load->view('template/footer');
    }

    public function update_location($id_tracking)
    {
        $tracking = $this->Tracking_model->get_tracking_by_id($id_tracking);
        if (!$tracking) {
            show_404();
        }

        if ($this->input->post()) {
            $this->form_validation->set_rules('latitude', 'Latitude', 'required|numeric');
            $this->form_validation->set_rules('longitude', 'Longitude', 'required|numeric');

            if ($this->form_validation->run() == TRUE) {
                $lat = $this->input->post('latitude');
                $lng = $this->input->post('longitude');
                $lokasi = $this->input->post('lokasi');

                $result = $this->Tracking_model->update_tracking_location(
                    $id_tracking,
                    $lat,
                    $lng,
                    $lokasi
                );

                if ($result) {
                    // ✅ KIRIM NOTIFIKASI KE PEMBELI
                    notifikasi_tracking(
                        $tracking->pembeli_id,
                        $tracking->invoice,
                        'Lokasi terbaru',
                        "Kurir berada di: " . ($lokasi ?: "Koordinat {$lat}, {$lng}")
                    );

                    echo json_encode(['success' => true, 'message' => 'Lokasi berhasil diperbarui.']);
                    return;
                } else {
                    echo json_encode(['success' => false, 'message' => 'Gagal memperbarui lokasi.']);
                    return;
                }
            } else {
                echo json_encode(['success' => false, 'message' => validation_errors()]);
                return;
            }
        }

        $data['tracking'] = $tracking;
        $data['unread_count'] = $this->Notifikasi_model->count_unread($this->session->userdata('id_user'));
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($this->session->userdata('id_user'), 5);

        $this->load->view('template/header', ['title' => 'Update Lokasi']);
        $this->load->view('kurir/tracking_location', $data);
        $this->load->view('template/footer');
    }

    public function api_update_location()
    {
        header('Content-Type: application/json');

        if (!$this->session->userdata('id_user')) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            return;
        }

        // Ambil data dari POST
        $id_tracking = $this->input->post('id_tracking');
        $lat = $this->input->post('latitude');
        $lng = $this->input->post('longitude');
        $lokasi = $this->input->post('lokasi');

        if (!$id_tracking || !$lat || !$lng) {
            echo json_encode(['success' => false, 'message' => 'Parameter tidak lengkap']);
            return;
        }

        $tracking = $this->Tracking_model->get_tracking_by_id($id_tracking);
        if (!$tracking) {
            echo json_encode(['success' => false, 'message' => 'Tracking tidak ditemukan']);
            return;
        }

        $result = $this->Tracking_model->update_tracking_location($id_tracking, $lat, $lng, $lokasi);

        if ($result) {
            // ✅ KIRIM NOTIFIKASI KE PEMBELI
            notifikasi_tracking(
                $tracking->pembeli_id,
                $tracking->invoice,
                'Lokasi terbaru',
                "Kurir berada di: " . ($lokasi ?: "Koordinat {$lat}, {$lng}")
            );

            echo json_encode(['success' => true, 'message' => 'Lokasi diperbarui']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal update lokasi']);
        }
    }

    public function upload_bukti($id_tracking)
    {
        $tracking = $this->Tracking_model->get_tracking_by_id($id_tracking);
        if (!$tracking) {
            show_404();
        }

        $this->load->model('Transaksi_model');

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $file_bukti_pengiriman = $tracking->bukti_pengiriman;
            $file_bukti_pembayaran = '';

            $this->load->library('upload');

            // 1. Upload Bukti Pengiriman (wajib jika belum ada, opsional jika sudah ada)
            if (!empty($_FILES['bukti_file']['name'])) {
                $upload_path_pengiriman = './assets/uploads/bukti_pengiriman/';
                if (!is_dir($upload_path_pengiriman)) {
                    mkdir($upload_path_pengiriman, 0755, TRUE);
                }

                $config_pengiriman['upload_path']   = $upload_path_pengiriman;
                $config_pengiriman['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
                $config_pengiriman['max_size']      = 2048; // max 2MB
                $config_pengiriman['encrypt_name']  = TRUE;

                $this->upload->initialize($config_pengiriman);

                if ($this->upload->do_upload('bukti_file')) {
                    $upload_data = $this->upload->data();
                    // Hapus berkas lama jika ada
                    if ($tracking->bukti_pengiriman && file_exists('./assets/uploads/bukti_pengiriman/' . $tracking->bukti_pengiriman)) {
                        @unlink('./assets/uploads/bukti_pengiriman/' . $tracking->bukti_pengiriman);
                    }
                    $file_bukti_pengiriman = $upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', 'Gagal upload bukti pengiriman: ' . $this->upload->display_errors('', ''));
                    redirect('kurir/tracking/upload_bukti/' . $id_tracking);
                }
            } elseif (empty($tracking->bukti_pengiriman)) {
                $this->session->set_flashdata('error', 'Silakan pilih berkas bukti pengiriman.');
                redirect('kurir/tracking/upload_bukti/' . $id_tracking);
            }

            // 2. Upload Bukti Pembayaran (wajib jika metode bayar COD dan belum ada bukti sebelumnya, opsional jika sudah ada)
            $existing_bukti = $this->Transaksi_model->get_bukti_by_transaksi($tracking->id_transaksi);
            if ($tracking->metode_bayar === 'COD') {
                if (!empty($_FILES['bukti_bayar_file']['name'])) {
                    $upload_path_pembayaran = './uploads/bukti/';
                    if (!is_dir($upload_path_pembayaran)) {
                        mkdir($upload_path_pembayaran, 0777, TRUE);
                    }

                    $config_pembayaran['upload_path']   = $upload_path_pembayaran;
                    $config_pembayaran['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
                    $config_pembayaran['max_size']      = 2048; // max 2MB
                    $config_pembayaran['encrypt_name']  = TRUE;

                    $this->upload->initialize($config_pembayaran);

                    if ($this->upload->do_upload('bukti_bayar_file')) {
                        $upload_data = $this->upload->data();
                        $file_bukti_pembayaran = $upload_data['file_name'];
                    } else {
                        // Cleanup first uploaded file if second one fails
                        if ($file_bukti_pengiriman && $file_bukti_pengiriman !== $tracking->bukti_pengiriman) {
                            @unlink('./assets/uploads/bukti_pengiriman/' . $file_bukti_pengiriman);
                        }
                        $this->session->set_flashdata('error', 'Gagal upload bukti pembayaran COD: ' . $this->upload->display_errors('', ''));
                        redirect('kurir/tracking/upload_bukti/' . $id_tracking);
                    }
                } elseif (!$existing_bukti) {
                    $this->session->set_flashdata('error', 'Silakan pilih berkas bukti pembayaran COD.');
                    redirect('kurir/tracking/upload_bukti/' . $id_tracking);
                }
            }

            // Simpan Bukti Pengiriman ke database
            $id_user = $this->session->userdata('id_user');
            $result = $this->Tracking_model->upload_bukti($id_tracking, $file_bukti_pengiriman, $id_user);

            // Simpan Bukti Pembayaran ke database jika COD
            if ($tracking->metode_bayar === 'COD') {
                $nama_kurir = $this->session->userdata('nama') ?? 'Kurir';
                $tipe_bayar = ($this->input->post('tipe_bayar') === 'cash') ? 'Cash COD' : ($this->input->post('nama_bank_cod') ?: 'Transfer COD');
                
                $bukti_data = [
                    'id_transaksi' => $tracking->id_transaksi,
                    'nama_bank' => $tipe_bayar,
                    'nama_pengirim' => 'Kurir: ' . $nama_kurir,
                    'tanggal_transfer' => date('Y-m-d'),
                    'jumlah_transfer' => (int)$this->input->post('jumlah_bayar'),
                    'status_verifikasi' => 'Pending',
                    'keterangan' => $this->input->post('keterangan_bayar') ?: 'COD Payment collected by Kurir',
                    'created_at' => date('Y-m-d H:i:s')
                ];

                if ($file_bukti_pembayaran) {
                    $bukti_data['file_bukti'] = $file_bukti_pembayaran;
                }

                if ($existing_bukti) {
                    if ($file_bukti_pembayaran && $existing_bukti['file_bukti'] && file_exists('./uploads/bukti/' . $existing_bukti['file_bukti'])) {
                        @unlink('./uploads/bukti/' . $existing_bukti['file_bukti']);
                    }
                    $this->db->where('id_transaksi', $tracking->id_transaksi);
                    $this->db->update('tb_bukti_bayar', $bukti_data);
                } else {
                    $this->db->insert('tb_bukti_bayar', $bukti_data);
                }
            }

            if ($result) {
                // Kirim notifikasi ke pembeli
                notifikasi_tracking(
                    $tracking->pembeli_id,
                    $tracking->invoice,
                    'delivered',
                    'Pesanan telah sampai. Bukti pengiriman ' . ($tracking->metode_bayar === 'COD' ? 'dan pembayaran COD ' : '') . 'telah diunggah oleh kurir.'
                );

                $this->session->set_flashdata('success', 'Bukti berhasil diunggah.');
                redirect('kurir/tracking');
            } else {
                $this->session->set_flashdata('error', 'Gagal menyimpan bukti ke database.');
                redirect('kurir/tracking/upload_bukti/' . $id_tracking);
            }
        }

        $data['tracking'] = $tracking;
        $data['bukti_bayar'] = $this->Transaksi_model->get_bukti_by_transaksi($tracking->id_transaksi);
        $data['unread_count'] = $this->Notifikasi_model->count_unread($this->session->userdata('id_user'));
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($this->session->userdata('id_user'), 5);

        $this->load->view('template/header', ['title' => 'Upload Bukti Pengiriman']);
        $this->load->view('kurir/upload_bukti', $data);
        $this->load->view('template/footer');
    }
}