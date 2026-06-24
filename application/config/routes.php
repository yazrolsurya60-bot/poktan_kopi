<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Landing';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['admin/dashboard'] = 'admin/dashboard/index';
$route['petani/dashboard'] = 'petani/dashboard/index';
$route['pembeli/dashboard'] = 'pembeli/dashboard/index';

// ============================================
// MODUL 10: LAPORAN & ANALYTICS
// ============================================
$route['admin/laporan'] = 'admin/laporan/index';
$route['admin/laporan/filter'] = 'admin/laporan/filter';
$route['admin/laporan/export_excel'] = 'admin/laporan/export_excel';
$route['admin/laporan/print_pdf'] = 'admin/laporan/print_pdf';
$route['admin/laporan/get_chart_data'] = 'admin/laporan/get_chart_data';

// Halaman Notifikasi
$route['notifikasi/history'] = 'Notifikasi/history';
$route['notifikasi/setting'] = 'Notifikasi/setting';
$route['notifikasi/read/(:num)'] = 'Notifikasi/read/$1';

// API Notifikasi (untuk AJAX)
$route['api/notifikasi/get'] = 'api/Notifikasi/get';
$route['api/notifikasi/mark_read'] = 'api/Notifikasi/mark_read';
$route['api/notifikasi/mark_all_read'] = 'api/Notifikasi/mark_all_read';
$route['api/notifikasi/update_setting'] = 'api/Notifikasi/update_setting';
$route['api/notifikasi/get_settings'] = 'api/Notifikasi/get_settings';

// Modul 5 - Manajemen Produk
$route['admin/produk'] = 'petani/Produk/index';
$route['admin/produk/tambah'] = 'petani/Produk/tambah';
$route['admin/produk/simpan'] = 'petani/Produk/simpan';

$route['admin/produk/detail/(:num)'] = 'petani/Produk/detail/$1';

$route['admin/produk/edit/(:num)'] = 'petani/Produk/edit/$1';

$route['admin/produk/update/(:num)'] = 'petani/Produk/update/$1';

$route['admin/produk/hapus/(:num)'] = 'petani/Produk/hapus/$1';
// Authentication Routes
$route['auth/login'] = 'Auth/login';
$route['auth/register'] = 'Auth/register';
$route['auth/logout'] = 'Auth/logout';
$route['auth/forgot_password'] = 'Auth/forgot_password';
$route['auth/reset_password/(:any)'] = 'Auth/reset_password/$1';
$route['auth/verify/(:any)'] = 'Auth/verify/$1';
$route['auth/change_password'] = 'Auth/change_password';
$route['auth/profile'] = 'Auth/profile';

// User Profile Redirections for farmers & buyers
$route['petani/profil'] = 'Auth/profile';
$route['pembeli/profil'] = 'Auth/profile';

// Admin User Management Routes
$route['admin/user'] = 'admin/Users/index';
$route['admin/user/add'] = 'admin/Users/add';
$route['admin/user/edit/(:num)'] = 'admin/Users/edit/$1';
$route['admin/user/delete/(:num)'] = 'admin/Users/delete/$1';
$route['admin/user/toggle/(:num)'] = 'admin/Users/toggle/$1';

// ============================================
// MODUL 9: MANAJEMEN MITRA & LANDING PAGE MITRA
// ============================================
$route['admin/mitra'] = 'admin/Mitra/index';
$route['admin/mitra/add'] = 'admin/Mitra/add';
$route['admin/mitra/edit/(:num)'] = 'admin/Mitra/edit/$1';
$route['admin/mitra/delete/(:num)'] = 'admin/Mitra/delete/$1';
$route['admin/mitra/toggle/(:num)'] = 'admin/Mitra/toggle/$1';

$route['landing'] = 'Landing/index';


// ============================================================
// MODUL 6: TRANSAKSI
// ============================================================

// Guest/Public
$route['transaksi/keranjang'] = 'transaksi/keranjang';
$route['transaksi/checkout'] = 'transaksi/checkout';
$route['transaksi/detail/(:num)'] = 'transaksi/detail/$1';
$route['transaksi/invoice/(:num)'] = 'transaksi/invoice/$1';
$route['transaksi/proses_checkout'] = 'transaksi/proses_checkout';
$route['transaksi/tambah_keranjang'] = 'transaksi/tambah_keranjang';
$route['transaksi/update_keranjang'] = 'transaksi/update_keranjang';
$route['transaksi/hapus_keranjang'] = 'transaksi/hapus_keranjang';
$route['transaksi/hitung_ongkir'] = 'transaksi/hitung_ongkir';
$route['transaksi/upload_bukti'] = 'transaksi/upload_bukti';
$route['transaksi/batalkan/(:num)'] = 'transaksi/batalkan/$1';

// Admin Transaksi
$route['admin/transaksi'] = 'admin/transaksi/index';
$route['admin/transaksi/detail/(:num)'] = 'admin/transaksi/detail/$1';
$route['admin/transaksi/konfirmasi_bayar'] = 'admin/transaksi/konfirmasi_bayar';
$route['admin/transaksi/update_status/(:num)'] = 'admin/transaksi/update_status/$1';
$route['admin/transaksi/export_excel'] = 'admin/transaksi/export_excel';
$route['admin/transaksi/export_pdf'] = 'admin/transaksi/export_pdf';
$route['admin/invoice/(:num)'] = 'admin/transaksi/invoice/$1';

// Pembeli Transaksi
$route['pembeli/transaksi/history'] = 'pembeli/transaksi/history';
$route['pembeli/transaksi/detail/(:num)'] = 'pembeli/transaksi/detail/$1';
$route['pembeli/transaksi/batalkan/(:num)'] = 'pembeli/transaksi/batalkan/$1';
$route['pembeli/transaksi/upload_bukti'] = 'pembeli/transaksi/upload_bukti';

// ============================================
// LANDING PRODUK - TAMBAHKAN INI!
// ============================================
$route['landing/produk'] = 'Landing/produk';

$route['admin/kurir']                    = 'admin/Kurir/index';
$route['admin/kurir/tambah']             = 'admin/Kurir/tambah';
$route['admin/kurir/edit/(:num)']        = 'admin/Kurir/edit/$1';
$route['admin/kurir/hapus/(:num)']       = 'admin/Kurir/hapus/$1';
$route['admin/kurir/toggle/(:num)']      = 'admin/Kurir/toggle/$1';
$route['admin/kurir/assign']             = 'admin/Kurir/assign';
$route['admin/kurir/proses_assign']      = 'admin/Kurir/proses_assign';
