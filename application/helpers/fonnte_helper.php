<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Fonnte Helper
 * Helper untuk mengirim OTP via WhatsApp menggunakan Fonnte API
 * 
 * @author Muhammad Ragyl
 * @version 1.0
 */

if (!function_exists('send_otp_fonnte')) {
    /**
     * Mengirim OTP ke nomor WhatsApp menggunakan Fonnte API
     * 
     * @param string $no_telepon Nomor telepon penerima (format 62812345678)
     * @param string $otp Kode OTP yang akan dikirim
     * @return array Array dengan status 'success' atau 'error'
     */
    function send_otp_fonnte($no_telepon, $otp)
    {
        // Token Fonnte API
        $token = "Ew545YpDBcWyeeN7GGrG";
        
        // URL API Fonnte
        $url = "https://api.fonnte.com/send";
        
        // Persiapkan data pesan
        $message = "Kode OTP Anda: " . $otp . "\n\nKode ini berlaku selama 5 menit.\nJangan berikan kode ini kepada siapa pun.";
        
        // Data yang akan dikirim
        $data = [
            'target' => $no_telepon,
            'message' => $message,
            'delay' => '0'
        ];
        
        // Konfigurasi CURL
        $curl = curl_init();
        $curl_options = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $token,
                'Content-Type: application/x-www-form-urlencoded'
            ),
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0
        );
        
        // Add CURLOPT_FOLLOW_LOCATION only if the constant is defined
        if (defined('CURLOPT_FOLLOW_LOCATION')) {
            $curl_options[CURLOPT_FOLLOW_LOCATION] = true;
        }
        
        curl_setopt_array($curl, $curl_options);
        
        // Eksekusi CURL
        $response = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);
        curl_close($curl);
        
        // Parsing response
        if ($error) {
            return [
                'status' => 'error',
                'message' => 'CURL Error: ' . $error
            ];
        }
        
        // Response dari Fonnte biasanya JSON
        $decoded_response = json_decode($response, true);
        
        if ($http_code == 200 || (isset($decoded_response['status']) && $decoded_response['status'])) {
            return [
                'status' => 'success',
                'message' => 'OTP berhasil dikirim',
                'response' => $decoded_response
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Gagal mengirim OTP',
                'http_code' => $http_code,
                'response' => $decoded_response
            ];
        }
    }
}

if (!function_exists('generate_otp')) {
    /**
     * Generate OTP random 6 digit
     * 
     * @return string OTP 6 digit
     */
    function generate_otp()
    {
        return str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
    }
}

if (!function_exists('format_phone_number')) {
    /**
     * Format nomor telepon ke format Fonnte (62xxx)
     * 
     * @param string $no_telepon Nomor telepon
     * @return string Nomor telepon dalam format 62xxx
     */
    function format_phone_number($no_telepon)
    {
        // Hapus semua karakter non-digit
        $no_telepon = preg_replace('/\D/', '', $no_telepon);
        
        // Jika dimulai dengan 0, ganti dengan 62
        if (substr($no_telepon, 0, 1) == '0') {
            $no_telepon = '62' . substr($no_telepon, 1);
        }
        
        // Jika belum ada 62, tambahkan
        if (substr($no_telepon, 0, 2) != '62') {
            $no_telepon = '62' . $no_telepon;
        }
        
        return $no_telepon;
    }
}

if (!function_exists('validate_phone_number')) {
    /**
     * Validasi nomor telepon Indonesia
     * 
     * @param string $no_telepon Nomor telepon
     * @return bool true jika valid, false jika tidak
     */
    function validate_phone_number($no_telepon)
    {
        // Hapus semua karakter non-digit
        $no_telepon = preg_replace('/\D/', '', $no_telepon);
        
        // Telepon Indonesia minimal 10 digit, maksimal 12 digit
        if (strlen($no_telepon) < 10 || strlen($no_telepon) > 12) {
            return false;
        }
        
        // Harus diawali dengan 0 atau dimulai dengan 62
        if (substr($no_telepon, 0, 1) != '0' && substr($no_telepon, 0, 2) != '62') {
            return false;
        }
        
        return true;
    }
}

?>
