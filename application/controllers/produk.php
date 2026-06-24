<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Panen_model');
        $this->load->helper('url');
    }

    public function index() {
        $data['produk'] = $this->Panen_model->get_all_produk();
        $this->load->view('v_landing_produk', $data);
    }
}