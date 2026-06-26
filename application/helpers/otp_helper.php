<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ============================================================
 * OTP SENDER HELPER
 * ============================================================
 * Helper ini menyediakan 1 pintu untuk kirim kode OTP, baik lewat
 * Email maupun WhatsApp/SMS.
 *
 * PENTING UNTUK PRODUKSI:
 * Saat ini belum ada API key WhatsApp/SMS gateway maupun SMTP yang
 * dikonfigurasi di project ini, jadi fungsi di bawah berjalan dalam
 * "MODE SIMULASI": kode OTP tetap dibuat & disimpan di database secara
 * normal, tapi pengiriman aslinya di-skip dan kodenya ditampilkan
 * langsung di halaman (seperti link verifikasi email yang sudah ada
 * di Auth::register()).
 *
 * Supaya kirim OTP sungguhan, isi salah satu/kedua bagian di bawah:
 *   1) Email  -> isi config di application/config/email.php lalu
 *                aktifkan blok CI Email Library di kirim_otp_email().
 *   2) WhatsApp/SMS -> daftar di provider seperti Fonnte, Zenziva,
 *                Twilio, dll, lalu isi OTP_WA_API_URL & OTP_WA_API_KEY
 *                di bawah dan aktifkan blok curl di kirim_otp_whatsapp().
 * ============================================================
 */

// Ganti dengan endpoint & API key gateway WhatsApp/SMS kamu
if (!defined('OTP_WA_API_URL')) define('OTP_WA_API_URL', ''); // contoh Fonnte: https://api.fonnte.com/send
if (!defined('OTP_WA_API_KEY')) define('OTP_WA_API_KEY', '');

if (!function_exists('kirim_otp_email')) {
    function kirim_otp_email($email_tujuan, $kode_otp) {
        $CI =& get_instance();

        // ---- AKTIFKAN BLOK INI KALAU SMTP SUDAH DIKONFIGURASI ----
        /*
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => 587,
            'smtp_user' => 'emailkamu@gmail.com',
            'smtp_pass' => 'app_password_kamu',
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n",
        ];
        $CI->load->library('email', $config);
        $CI->email->from('noreply@liberchain.com', 'Liberchain');
        $CI->email->to($email_tujuan);
        $CI->email->subject('Kode Verifikasi Liberchain');
        $CI->email->message("Kode OTP kamu: <b>$kode_otp</b>. Berlaku 5 menit, jangan beri tahu siapapun.");
        $terkirim = $CI->email->send();

        return [
            'sukses'   => (bool) $terkirim,
            'simulasi' => false,
        ];
        */

        // ---- MODE SIMULASI (default, tanpa SMTP) ----
        log_message('info', "[SIMULASI OTP EMAIL] Kode untuk $email_tujuan: $kode_otp");

        return [
            'sukses'   => true,
            'simulasi' => true,
        ];
    }
}

if (!function_exists('kirim_otp_whatsapp')) {
    function kirim_otp_whatsapp($no_hp_tujuan, $kode_otp) {

        // ---- AKTIFKAN BLOK INI KALAU SUDAH PUNYA API KEY GATEWAY WA ----
        /*
        if (OTP_WA_API_URL && OTP_WA_API_KEY) {
            $ch = curl_init(OTP_WA_API_URL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: ' . OTP_WA_API_KEY]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, [
                'target'  => $no_hp_tujuan,
                'message' => "Kode verifikasi Liberchain kamu: $kode_otp (berlaku 5 menit)",
            ]);
            $response = curl_exec($ch);
            $sukses = !curl_errno($ch);
            curl_close($ch);

            return [
                'sukses'   => $sukses,
                'simulasi' => false,
            ];
        }
        */

        // ---- MODE SIMULASI (default, tanpa gateway WA/SMS) ----
        log_message('info', "[SIMULASI OTP WHATSAPP] Kode untuk $no_hp_tujuan: $kode_otp");

        return [
            'sukses'   => true,
            'simulasi' => true,
        ];
    }
}

if (!function_exists('kirim_otp')) {
    function kirim_otp($metode, $tujuan, $kode_otp) {
        if ($metode === 'whatsapp') {
            return kirim_otp_whatsapp($tujuan, $kode_otp);
        }
        return kirim_otp_email($tujuan, $kode_otp);
    }
}