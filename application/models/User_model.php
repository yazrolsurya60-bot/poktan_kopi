<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Authenticate user by username/email and md5 password
    public function login($username_or_email, $password) {
        $this->db->group_start()
                 ->where('username', $username_or_email)
                 ->or_where('email', $username_or_email)
                 ->group_end();
        $user = $this->db->get('tb_user')->row_array();

        if ($user && $user['password'] === md5($password)) {
            return $user;
        }
        return FALSE;
    }

    // Get user by ID
    public function get_by_id($id) {
        return $this->db->get_where('tb_user', ['id_user' => $id])->row_array();
    }

    // Get user by email
    public function get_by_email($email) {
        return $this->db->get_where('tb_user', ['email' => $email])->row_array();
    }

    // Get user by username
    public function get_by_username($username) {
        return $this->db->get_where('tb_user', ['username' => $username])->row_array();
    }

    // Insert new user
    public function insert_user($data) {
        if (isset($data['password'])) {
            $data['password'] = md5($data['password']);
        }
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        $this->db->insert('tb_user', $data);
        return $this->db->insert_id();
    }

    // Update user
    public function update_user($id, $data) {
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = md5($data['password']);
        } else {
            unset($data['password']); // Don't overwrite if empty
        }
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        return $this->db->where('id_user', $id)->update('tb_user', $data);
    }

    // Delete user
    public function delete_user($id) {
        return $this->db->where('id_user', $id)->delete('tb_user');
    }

    // Retrieve all users with optional filtering (Admin User Management)
    public function get_all_users($search = '', $role = '', $status = '') {
        $this->db->select('*');
        $this->db->from('tb_user');

        if (!empty($search)) {
            $this->db->group_start()
                     ->like('nama', $search)
                     ->or_like('username', $search)
                     ->or_like('email', $search)
                     ->group_end();
        }

        if (!empty($role)) {
            $this->db->where('role', $role);
        }

        if (!empty($status)) {
            $this->db->where('status', $status);
        }

        $this->db->order_by('created_at', 'DESC');
        return $this->db->get()->result_array();
    }

    // Toggle user active/inactive status
    public function toggle_status($id) {
        $user = $this->get_by_id($id);
        if (!$user) return false;
        $newStatus = ($user['status'] === 'active') ? 'inactive' : 'active';
        return $this->db->where('id_user', $id)->update('tb_user', ['status' => $newStatus]);
    }

    // Verify token for email verification or password reset
    public function verify_token($token, $type) {
        $column = ($type === 'verification') ? 'verification_token' : 'reset_token';
        
        $this->db->where($column, $token);
        $this->db->where('token_expiry >=', date('Y-m-d H:i:s'));
        return $this->db->get('tb_user')->row_array();
    }
}
