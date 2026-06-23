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

// ============================================
// MODUL 7: TRACKING PENGIRIMAN
// ============================================

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
