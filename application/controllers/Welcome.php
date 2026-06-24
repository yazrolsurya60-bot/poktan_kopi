<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
    }

    public function index() {
        if($this->session->userdata('logged_in')) {
            if($this->session->userdata('role') == 'Admin') {
                redirect('admin/dashboard');
            } else {
                redirect('petani/dashboard');
            }
        }
        
        $data['title'] = 'Login - LiberChain';
        $this->load->view('login', $data);
    }

    public function login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $user = $this->User_model->login($username, $password);
        
        if($user) {
            $session_data = array(
                'id_user' => $user['id_user'],
                'username' => $user['username'],
                'nama' => $user['nama'],
                'email' => $user['email'],
                'role' => $user['role'],
                'status' => $user['status'],
                'logged_in' => TRUE
            );
            $this->session->set_userdata($session_data);
            
            if($user['role'] == 'Admin') {
                redirect('admin/dashboard');
            } else {
                redirect('petani/dashboard');
            }
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah!');
            redirect('welcome');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('welcome');
    }
}
