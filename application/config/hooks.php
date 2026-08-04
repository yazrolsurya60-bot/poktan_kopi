<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/userguide3/general/hooks.html
|
*/

/*
| 🔴 SECURITY: CSRF Form Injector Hook
| Otomatis menyuntikkan CSRF token ke semua form POST
| agar CSRF protection berfungsi tanpa mengubah setiap view.
*/
$hook['display_override'] = array(
    'class'    => '',
    'function' => 'inject_csrf_into_forms',
    'filename' => 'csrf_form_injector.php',
    'filepath' => 'hooks',
    'params'   => array()
);