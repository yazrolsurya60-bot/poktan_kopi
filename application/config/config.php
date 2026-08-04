<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Base Site URL
|--------------------------------------------------------------------------
|
| Dynamic base_url - detects protocol, host, and subfolder automatically.
| This works on localhost AND on any hosting domain.
|
*/
$config['base_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') . '/';

/*
|--------------------------------------------------------------------------
| Index File
|--------------------------------------------------------------------------
|
*/
$config['index_page'] = '';

/*
|--------------------------------------------------------------------------
| URI PROTOCOL
|--------------------------------------------------------------------------
|
*/
$config['uri_protocol'] = 'REQUEST_URI';

/*
|--------------------------------------------------------------------------
| URL suffix
|--------------------------------------------------------------------------
|
*/
$config['url_suffix'] = '';

/*
|--------------------------------------------------------------------------
| Default Language
|--------------------------------------------------------------------------
|
*/
$config['language'] = 'english';

/*
|--------------------------------------------------------------------------
| Default Character Set
|--------------------------------------------------------------------------
|
*/
$config['charset'] = 'UTF-8';

/*
|--------------------------------------------------------------------------
| Enable/Disable System Hooks
|--------------------------------------------------------------------------
|
*/
$config['enable_hooks'] = TRUE;

/*
|--------------------------------------------------------------------------
| Class Extension Prefix
|--------------------------------------------------------------------------
|
*/
$config['subclass_prefix'] = 'MY_';

/*
|--------------------------------------------------------------------------
| Composer auto-loading
|--------------------------------------------------------------------------
|
*/
$config['composer_autoload'] = FALSE;

/*
|--------------------------------------------------------------------------
| Allowed URL Characters
|--------------------------------------------------------------------------
|
*/
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';

/*
|--------------------------------------------------------------------------
| Enable Query Strings
|--------------------------------------------------------------------------
|
*/
$config['enable_query_strings'] = FALSE;
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';
$config['directory_trigger'] = 'd';

/*
|--------------------------------------------------------------------------
| Allow $_GET array
|--------------------------------------------------------------------------
|
*/
$config['allow_get_array'] = TRUE;

/*
|--------------------------------------------------------------------------
| Error Logging Threshold
|--------------------------------------------------------------------------
|
*/
$config['log_threshold'] = 4;

/*
|--------------------------------------------------------------------------
| Error Logging Directory Path
|--------------------------------------------------------------------------
|
*/
$config['log_path'] = '';

/*
|--------------------------------------------------------------------------
| Cache Invalidaton and Delivery
|--------------------------------------------------------------------------
|
*/
$config['cache_path'] = '';

/*
|--------------------------------------------------------------------------
| Cache Include Query String
|--------------------------------------------------------------------------
|
*/
$config['cache_query_string'] = FALSE;

/*
|--------------------------------------------------------------------------
| Encryption Key
|--------------------------------------------------------------------------
|
*/
$config['encryption_key'] = 'L1b3rCh41n@2026!S3cur3K3y#PWA_R3d3f1n3';

/*
|--------------------------------------------------------------------------
| Session Variables
|--------------------------------------------------------------------------
|
*/
$config['sess_driver'] = 'files';
$config['sess_cookie_name'] = 'ci_session';
$config['sess_samesite'] = 'Lax';
$config['sess_expiration'] = 7200;
$config['sess_save_path'] = NULL;
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = TRUE;

/*
|--------------------------------------------------------------------------
| Cookie Related Variables
|--------------------------------------------------------------------------
|
*/
$config['cookie_prefix'] = '';
$config['cookie_domain'] = '';
$config['cookie_path'] = '/';
$config['cookie_secure'] = FALSE;
$config['cookie_httponly'] = TRUE;
$config['cookie_samesite'] = 'Lax';

/*
|--------------------------------------------------------------------------
| Standardize newlines
|--------------------------------------------------------------------------
|
*/
$config['standardize_newlines'] = FALSE;

/*
|--------------------------------------------------------------------------
| Global XSS Filtering
|--------------------------------------------------------------------------
|
*/
$config['global_xss_filtering'] = TRUE;

/*
|--------------------------------------------------------------------------
| Cross Site Request Forgery
|--------------------------------------------------------------------------
|
*/
$config['csrf_protection'] = TRUE;
$config['csrf_token_name'] = 'csrf_test_name';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 7200;
$config['csrf_regenerate'] = TRUE;

// 🔴 EXCLUSE URI UNTUK AJAX/API ENDPOINTS
// Endpoint ini tetap dilindungi oleh session auth dan input validation
// Form-based POST akan tetap dilindungi CSRF
$config['csrf_exclude_uris'] = array(
    // API Notifikasi
    'api/notifikasi/get',
    'api/notifikasi/mark_read',
    'api/notifikasi/mark_all_read',
    'api/notifikasi/update_setting',
    'api/notifikasi/get_settings',
    
    // API Tracking
    'api/tracking/(.*)',
    
    // AJAX Endpoints Transaksi
    'transaksi/tambah_keranjang',
    'transaksi/update_keranjang',
    'transaksi/hapus_keranjang',
    'transaksi/hitung_ongkir',
    'transaksi/cart_count',
    'transaksi/upload_bukti',
    'transaksi/batalkan/(.*)',
    
    // AJAX Endpoints Dashboard
    'admin/dashboard/get_notifications_ajax',
    'admin/dashboard/mark_all_read_ajax',
    'admin/dashboard/get_chart_data',
    'pembeli/dashboard/update_settings_ajax',
    'pembeli/dashboard/get_notifications_ajax',
    'pembeli/dashboard/get_chart_data',
    'pembeli/dashboard/mark_all_read',
    
    // Tracking AJAX
    'kurir/tracking/api_update_location',
    'api/tracking/update_location'
);

/*
|--------------------------------------------------------------------------
| Output Compression
|--------------------------------------------------------------------------
|
*/
$config['compress_output'] = FALSE;

/*
|--------------------------------------------------------------------------
| Master Time Reference
|--------------------------------------------------------------------------
|
*/
$config['time_reference'] = 'local';

/*
|--------------------------------------------------------------------------
| Rewrite PHP Short Tags
|--------------------------------------------------------------------------
|
*/
$config['rewrite_short_tags'] = FALSE;

/*
|--------------------------------------------------------------------------
| Timezone Setting (WIB - Jakarta)
|--------------------------------------------------------------------------
|
*/
date_default_timezone_set('Asia/Jakarta');

/*
|--------------------------------------------------------------------------
| Reverse Proxy IPs
|--------------------------------------------------------------------------
|
*/
$config['proxy_ips'] = '';

/*
|--------------------------------------------------------------------------
| Custom Application Settings
|--------------------------------------------------------------------------
|
| Jangan pernah menaruh API key langsung di source code.
| Gunakan environment variable FONNTE_API_TOKEN jika memungkinkan.
|
*/
// 🔴 SECURITY: Ganti dengan token asli Anda di server production
// Best practice: set di environment variable, bukan hardcode di sini
$config['fonnte_api_token'] = getenv('FONNTE_API_TOKEN') ?: '';
