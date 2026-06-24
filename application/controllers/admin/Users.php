<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // Ensure admin logged in
        if (!$this->session->userdata('id_user') || $this->session->userdata('role') !== 'Admin') {
            redirect('auth/login');
        }
        $this->load->model('User_model');
        $this->load->helper(['url', 'form']);
    }

    // List users
    public function index() {
        $data['users'] = $this->User_model->get_all_users();
        $this->load->view('admin/users/v_manajemen_user', $data);
    }

    // Add new user
    public function add() {
        if ($this->input->post()) {
            $data = [
                'username' => $this->input->post('username'),
                'email'    => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'role'     => $this->input->post('role'),
                'status'   => 'active'
            ];
            $this->User_model->insert_user($data);
            $this->session->set_flashdata('success', 'User berhasil ditambahkan.');
            redirect('admin/user');
        } else {
            $this->load->view('admin/users/add');
        }
    }

    // Edit existing user
    public function edit($id) {
        $user = $this->User_model->get_by_id($id);
        if (!$user) {
            show_404();
        }
        if ($this->input->post()) {
            $data = [
                'username' => $this->input->post('username'),
                'email'    => $this->input->post('email'),
                'role'     => $this->input->post('role')
            ];
            $pwd = $this->input->post('password');
            if (!empty($pwd)) {
                $data['password'] = $pwd;
            }
            $this->User_model->update_user($id, $data);
            $this->session->set_flashdata('success', 'User berhasil diperbarui.');
            redirect('admin/user');
        } else {
            $data['user'] = $user;
            $this->load->view('admin/users/edit', $data);
        }
    }

    // Delete user
    public function delete($id) {
        $this->User_model->delete_user($id);
        $this->session->set_flashdata('success', 'User dihapus.');
        redirect('admin/user');
    }

    // Toggle active / inactive status via AJAX
    public function toggle($id) {
        $this->User_model->toggle_status($id);
        echo json_encode(['success' => true]);
    }
}
?>
