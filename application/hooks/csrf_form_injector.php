<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function inject_csrf_into_forms($output = '')
{
    $CI =& get_instance();

    // 🔴 FIX: Parameter $output bisa berupa ARRAY
    if (is_array($output) && isset($output['output'])) {
        $output = $output['output'];
    }

    // Fallback: Jika $output kosong/array, ambil langsung dari Output library
    if (!is_string($output) || $output === '') {
        $output = $CI->output->get_output();
        if (is_array($output) && isset($output['output'])) {
            $output = $output['output'];
        }
        if (!is_string($output)) {
            $output = is_array($output) ? implode('', $output) : (string) $output;
        }
    }

    if ($CI->config->item('csrf_protection')) {
        $token_name = $CI->security->get_csrf_token_name();
        $token_hash = $CI->security->get_csrf_hash();

        // Konversi hash array ke string dengan aman
        if (is_array($token_hash)) {
            $token_hash = reset($token_hash);
        }

        if (!empty($token_hash)) {
            $hidden = '<input type="hidden" name="' . $token_name . '" value="' . $token_hash . '" />';
            $pattern = '/(<form\b[^>]*method\s*=\s*["\'](post|POST)["\'][^>]*>)/';
            $output = preg_replace_callback($pattern, function ($m) use ($hidden) {
                if (strpos($m[1], 'csrf') !== false) return $m[1];
                return $m[1] . $hidden;
            }, $output);
        }
    }

    // 🔒 URL BERSIH - Sembunyikan nama controller dari URL di output HTML
    // Ganti base_url('auth/...') dengan URL bersih tanpa nama controller
    $base = rtrim($CI->config->item('base_url'), '/');

    // Mapping URL lama ke URL bersih
    $url_map = array(
        $base . '/auth/login'        => $base . '/masuk',
        $base . '/auth/register'     => $base . '/buat-akun',
        $base . '/auth/logout'       => $base . '/keluar',
        $base . '/auth/ubah_password'=> $base . '/profil-saya',
        $base . '/auth/profile'      => $base . '/profil-saya',
        $base . '/auth/forgot_password' => $base . '/lupa-password',
    );

    // Ganti semua URL auth di output dengan URL bersih
    foreach ($url_map as $old => $new) {
        $output = str_replace($old, $new, $output);
    }

    echo $output;
}