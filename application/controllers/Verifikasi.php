<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Otp_model');
        $this->load->model('User_model');
        $this->load->helper(['url', 'form', 'otp']);
    }

    /**
     * Halaman verifikasi yang muncul sebelum checkout, mirip
     * pop-up verifikasi di Shopee. Kalau kontak user sudah pernah
     * lolos verifikasi (kontak_terverifikasi = 1) atau sesi sudah
     * verified, langsung lempar balik ke tujuan asal.
     * 
     * 🔥 FIX: Support untuk GUEST (id_user = NULL)
     */
    public function index() {
        $redirect_to = $this->session->userdata('redirect_after_otp') ?: 'transaksi/checkout';

        $id_user = $this->session->userdata('id_user');
        $user = $id_user ? $this->User_model->get_by_id($id_user) : null;

        // 🔥 Cek apakah sudah terverifikasi
        $sudah_terverifikasi = $this->session->userdata('otp_verified');

        // Untuk member: cek di database
        if (!$sudah_terverifikasi && $user && !empty($user['kontak_terverifikasi'])) {
            $sudah_terverifikasi = true;
            $this->session->set_userdata('otp_verified', true);
        }

        // 🔥 Jika sudah terverifikasi, langsung redirect
        if ($sudah_terverifikasi) {
            redirect($redirect_to);
        }

        $data['title'] = 'Verifikasi Keamanan';
        $data['user'] = $user;
        $data['redirect_to'] = $redirect_to;
        $data['is_guest'] = ($id_user === null);
        
        $this->load->view('verifikasi/index', $data);
    }

    /**
     * AJAX: kirim kode OTP ke email atau WhatsApp.
     * 🔥 FIX: Support untuk GUEST
     */
    public function kirim() {
        $metode = $this->input->post('metode'); // 'email' | 'whatsapp'
        $tujuan = trim($this->input->post('tujuan'));

        if (!in_array($metode, ['email', 'whatsapp'], TRUE) || empty($tujuan)) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap.']);
            return;
        }

        // 🔥 Untuk guest, metode default adalah email
        if ($metode === 'email' && !filter_var($tujuan, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => 'error', 'message' => 'Format email tidak valid.']);
            return;
        }
        if ($metode === 'whatsapp' && !preg_match('/^[0-9+]{9,15}$/', $tujuan)) {
            echo json_encode(['status' => 'error', 'message' => 'Format nomor WhatsApp tidak valid.']);
            return;
        }

        // Anti-spam: cegah klik kirim ulang dalam 60 detik
        $otp_aktif = $this->Otp_model->get_otp_aktif($tujuan);
        if ($otp_aktif && (time() - strtotime($otp_aktif['dikirim_pada'])) < 60) {
            $sisa = 60 - (time() - strtotime($otp_aktif['dikirim_pada']));
            echo json_encode(['status' => 'error', 'message' => "Tunggu $sisa detik sebelum kirim ulang."]);
            return;
        }

        $id_user = $this->session->userdata('id_user');
        $session_id = $this->session->userdata('session_id') ?: session_id();

        // 🔥 Buat OTP (support guest dengan id_user = null)
        $kode = $this->Otp_model->buat_otp($tujuan, $metode, $id_user, $session_id);
        $hasil_kirim = kirim_otp($metode, $tujuan, $kode);

        // Simpan tujuan di session untuk verifikasi nanti
        $this->session->set_userdata('otp_tujuan', $tujuan);
        $this->session->set_userdata('otp_metode', $metode);

        $response = [
            'status'  => 'success',
            'message' => $metode === 'email'
                ? 'Kode verifikasi telah dikirim ke email kamu.'
                : 'Kode verifikasi telah dikirim ke WhatsApp kamu.',
        ];

        // 🔥 Mode simulasi: tampilkan kode untuk testing
        if (!empty($hasil_kirim['simulasi'])) {
            $response['simulasi'] = true;
            $response['kode_demo'] = $kode;
            $response['message'] .= ' (Mode simulasi: kode ditampilkan untuk testing)';
        }

        echo json_encode($response);
    }

    /**
     * AJAX: cek kode OTP yang diinput user.
     * 🔥 FIX: Support untuk GUEST
     */
    public function cek() {
        $kode_input = trim($this->input->post('kode'));
        $tujuan = $this->session->userdata('otp_tujuan');
        $metode = $this->session->userdata('otp_metode');

        if (empty($tujuan)) {
            echo json_encode(['status' => 'error', 'message' => 'Sesi verifikasi tidak ditemukan, silakan kirim ulang kode.']);
            return;
        }

        $hasil = $this->Otp_model->verifikasi_kode($tujuan, $kode_input);

        switch ($hasil) {
            case 'success':
                // 🔥 Tandai sesi sebagai terverifikasi
                $this->session->set_userdata('otp_verified', true);

                $id_user = $this->session->userdata('id_user');
                
                // 🔥 Jika member, tandai di database
                if ($id_user) {
                    $this->Otp_model->tandai_user_terverifikasi($id_user, $tujuan, $metode);
                }

                $redirect_to = $this->session->userdata('redirect_after_otp') ?: 'transaksi/checkout';
                $this->session->unset_userdata('redirect_after_otp');
                $this->session->unset_userdata('otp_tujuan');
                $this->session->unset_userdata('otp_metode');

                echo json_encode([
                    'status' => 'success',
                    'message' => '✅ Verifikasi berhasil!',
                    'redirect' => base_url($redirect_to),
                ]);
                break;

            case 'invalid':
                echo json_encode(['status' => 'error', 'message' => '❌ Kode OTP salah, coba lagi.']);
                break;

            case 'too_many_attempts':
                echo json_encode(['status' => 'error', 'message' => '❌ Terlalu banyak salah input. Silakan kirim ulang kode baru.']);
                break;

            default: // expired
                echo json_encode(['status' => 'error', 'message' => '❌ Kode OTP sudah kedaluwarsa. Silakan kirim ulang.']);
                break;
        }
    }
}