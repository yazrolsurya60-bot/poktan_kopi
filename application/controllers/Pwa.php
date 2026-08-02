<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pwa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function manifest()
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(file_get_contents(FCPATH . 'manifest.json'));
    }

    public function service_worker()
    {
        $this->output
            ->set_content_type('application/javascript')
            ->set_output(file_get_contents(FCPATH . 'sw.js'));
    }

    public function install()
    {
        $data['title'] = 'Install LiberChain App';
        $this->load->view('pwa/install', $data);
    }
}