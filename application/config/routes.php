<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Beranda';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

#$route['default_controller'] = 'welcome';
#$route['404_override'] = '';
#$route['translate_uri_dashes'] = FALSE;

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

// API Notifikasi
$route['api/notifikasi/get'] = 'api/Notifikasi/get';
$route['api/notifikasi/mark_read'] = 'api/Notifikasi/mark_read';
$route['api/notifikasi/mark_all_read'] = 'api/Notifikasi/mark_all_read';
$route['api/notifikasi/update_setting'] = 'api/Notifikasi/update_setting';
$route['api/notifikasi/get_settings'] = 'api/Notifikasi/get_settings';

// ============================================
// MODUL 5: MANAJEMEN PRODUK (Admin)
// ============================================
$route['admin/produk'] = 'admin/Produk/index';
$route['admin/produk/tambah'] = 'admin/Produk/tambah';
$route['admin/produk/simpan'] = 'admin/Produk/simpan';
$route['admin/produk/detail/(:num)'] = 'admin/Produk/detail/$1';
$route['admin/produk/edit/(:num)'] = 'admin/Produk/edit/$1';
$route['admin/produk/update/(:num)'] = 'admin/Produk/update/$1';
$route['admin/produk/hapus/(:num)'] = 'admin/Produk/hapus/$1';

// ============================================
// MODUL 5: MANAJEMEN PRODUK (Petani)
// ============================================
$route['petani/produk'] = 'petani/Produk/index';
$route['petani/produk/tambah'] = 'petani/Produk/tambah';
$route['petani/produk/simpan'] = 'petani/Produk/simpan';
$route['petani/produk/detail/(:num)'] = 'petani/Produk/detail/$1';
$route['petani/produk/edit/(:num)'] = 'petani/Produk/edit/$1';
$route['petani/produk/update/(:num)'] = 'petani/Produk/update/$1';
$route['petani/produk/hapus/(:num)'] = 'petani/Produk/hapus/$1';

// ============================================
// AUTHENTICATION
// ============================================
$route['auth/login'] = 'Auth/login';
$route['auth/register'] = 'Auth/register';
$route['auth/logout'] = 'Auth/logout';
$route['auth/forgot_password'] = 'Auth/forgot_password';
$route['auth/reset_password/(:any)'] = 'Auth/reset_password/$1';
$route['auth/verify/(:any)'] = 'Auth/verify/$1';
$route['auth/change_password'] = 'Auth/change_password';
$route['auth/profile'] = 'Auth/profile';

$route['petani/profil'] = 'Auth/profile';
$route['pembeli/profil'] = 'Auth/profile';

// Admin User Management
$route['admin/user'] = 'admin/Users/index';
$route['admin/user/add'] = 'admin/Users/add';
$route['admin/user/edit/(:num)'] = 'admin/Users/edit/$1';
$route['admin/user/delete/(:num)'] = 'admin/Users/delete/$1';
$route['admin/user/toggle/(:num)'] = 'admin/Users/toggle/$1';

// ============================================
// MODUL 9: MANAJEMEN MITRA
// ============================================
$route['admin/mitra'] = 'admin/Mitra/index';
$route['admin/mitra/add'] = 'admin/Mitra/add';
$route['admin/mitra/edit/(:num)'] = 'admin/Mitra/edit/$1';
$route['admin/mitra/delete/(:num)'] = 'admin/Mitra/delete/$1';
$route['admin/mitra/toggle/(:num)'] = 'admin/Mitra/toggle/$1';

$route['landing'] = 'Landing/index';
$route['landing/mitra'] = 'Landing/mitra';
$route['produk'] = 'Landing/index';
$route['tentang'] = 'Tentang/index';

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
$route['admin/transaksi/invoice/(:num)'] = 'admin/transaksi/invoice/$1';

// Pembeli Transaksi
$route['pembeli/transaksi/history'] = 'pembeli/transaksi/history';
$route['pembeli/transaksi/detail/(:num)'] = 'pembeli/transaksi/detail/$1';
$route['pembeli/transaksi/batalkan/(:num)'] = 'pembeli/transaksi/batalkan/$1';
$route['pembeli/transaksi/upload_bukti'] = 'pembeli/transaksi/upload_bukti';
$route['pembeli/transaksi/invoice/(:num)'] = 'pembeli/transaksi/invoice/$1';

// ============================================
// LANDING PRODUK
// ============================================
$route['landing/produk'] = 'produk/index';

// Pembeli Tracking (M07-F01, M07-F04, M07-F05, M07-F07)
$route['pembeli/tracking'] = 'pembeli/Tracking/index';
$route['pembeli/tracking/detail/(:num)'] = 'pembeli/Tracking/detail/$1';
$route['pembeli/tracking/history'] = 'pembeli/Tracking/history';
$route['pembeli/tracking/approve/(:num)'] = 'pembeli/Tracking/approve/$1';

// Petani Tracking (M07-F02)
$route['petani/tracking'] = 'petani/Tracking/index';
$route['petani/tracking/update/(:num)'] = 'petani/Tracking/update/$1';

// Kurir Tracking (M07-F03)
$route['kurir/tracking'] = 'kurir/Tracking/index';
$route['kurir/tracking/update_location/(:num)'] = 'kurir/Tracking/update_location/$1';
$route['kurir/tracking/api_update_location'] = 'kurir/Tracking/api_update_location';

// API Tracking
$route['api/tracking/get'] = 'api/Tracking/get';
$route['api/tracking/history'] = 'api/Tracking/history';
$route['api/tracking/estimasi'] = 'api/Tracking/estimasi';

$route['admin/kurir']                    = 'admin/Kurir/index';
$route['admin/kurir/tambah']             = 'admin/Kurir/tambah';
$route['admin/kurir/edit/(:num)']        = 'admin/Kurir/edit/$1';
$route['admin/kurir/hapus/(:num)']       = 'admin/Kurir/hapus/$1';
$route['admin/kurir/toggle/(:num)']      = 'admin/Kurir/toggle/$1';
$route['admin/kurir/assign']             = 'admin/Kurir/assign';
$route['admin/kurir/proses_assign']      = 'admin/Kurir/proses_assign';