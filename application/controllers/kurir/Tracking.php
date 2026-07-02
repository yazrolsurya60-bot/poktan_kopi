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

        if ($this->input->post()) {
            $upload_path = './assets/uploads/bukti_pengiriman/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0755, TRUE);
            }

            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $config['max_size']      = 2048; // max 2MB
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('bukti_file')) {
                $upload_data = $this->upload->data();
                $file_name = $upload_data['file_name'];
                $id_user = $this->session->userdata('id_user');

                $result = $this->Tracking_model->upload_bukti($id_tracking, $file_name, $id_user);

                if ($result) {
                    // Send notification to buyer
                    notifikasi_tracking(
                        $tracking->pembeli_id,
                        $tracking->invoice,
                        'delivered',
                        'Bukti pengiriman telah diunggah oleh kurir.'
                    );

                    $this->session->set_flashdata('success', 'Bukti pengiriman berhasil diunggah.');
                    redirect('kurir/tracking');
                } else {
                    $this->session->set_flashdata('error', 'Gagal menyimpan bukti pengiriman ke database.');
                }
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
            }
        }

        $data['tracking'] = $tracking;
        $data['unread_count'] = $this->Notifikasi_model->count_unread($this->session->userdata('id_user'));
        $data['notifikasi'] = $this->Notifikasi_model->get_unread_notif($this->session->userdata('id_user'), 5);

        $this->load->view('template/header', ['title' => 'Upload Bukti Pengiriman']);
        $this->load->view('kurir/upload_bukti', $data);
        $this->load->view('template/footer');
    }
}