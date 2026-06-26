<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->helper('url');
    }

    public function index() {
        $data['produk'] = $this->Produk_model->getAll();
        $this->load->view('v_landing_produk', $data);
    }
}