<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // ============================================
    // 🔴 TAMBAHKAN METHOD INI (UNTUK NOTIFIKASI)
    // ============================================
    
    /**
     * Get users by role (dipakai untuk notifikasi ke admin)
     */
    public function get_users_by_role($role)
    {
        $this->db->where('role', $role);
        $this->db->where('status', 'Active');
        $query = $this->db->get('tb_user');
        return $query->result_array();
    }

    // ============================================
    // METHOD YANG SUDAH ADA (PERTAHANKAN)
    // ============================================

    // Authenticate user by username/email and md5 password
    public function login($username_or_phone, $password)
    {
        $this->db->group_start()
            ->where('username', $username_or_phone);

        if (is_numeric($username_or_phone)) {
            $this->db->or_where('no_telepon', $username_or_phone);

            if (substr($username_or_phone, 0, 1) == '0') {
                $phone_fonnte = '62' . substr($username_or_phone, 1);
                $this->db->or_where('no_telepon', $phone_fonnte);
            }
            
            if (substr($username_or_phone, 0, 2) == '62') {
                $phone_local = '0' . substr($username_or_phone, 2);
                $this->db->or_where('no_telepon', $phone_local);
            }
        }

        $this->db->group_end();
        $user = $this->db->get('tb_user')->row_array();

        if ($user && $user['password'] === md5($password)) {
            return $user;
        }
        return FALSE;
    }

    // Get user by ID
    public function get_by_id($id)
    {
        return $this->db->get_where('tb_user', ['id_user' => $id])->row_array();
    }

    // Get user by email
    public function get_by_email($email)
    {
        return $this->db->get_where('tb_user', ['email' => $email])->row_array();
    }

    // Get user by username
    public function get_by_username($username)
    {
        return $this->db->get_where('tb_user', ['username' => $username])->row_array();
    }

    // Get user by phone number
    public function get_by_phone($no_telepon)
    {
        return $this->db->get_where('tb_user', ['no_telepon' => $no_telepon])->row_array();
    }

    // Insert new user
    public function insert_user($data)
    {
        if (isset($data['password'])) {
            $data['password'] = md5($data['password']);
        }
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        $this->db->insert('tb_user', $data);
        return $this->db->insert_id();
    }

    // Update user
    public function update_user($id, $data)
    {
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = md5($data['password']);
        } else {
            unset($data['password']);
        }
        $data['updated_at'] = date('Y-m-d H:i:s');

        return $this->db->where('id_user', $id)->update('tb_user', $data);
    }

    // Delete user
    public function delete_user($id)
    {
        return $this->db->where('id_user', $id)->delete('tb_user');
    }

    // Retrieve all users with optional filtering
    public function get_all_users($search = '', $role = '', $status = '')
    {
        $this->db->select('*');
        $this->db->from('tb_user');

        if (!empty($search)) {
            $this->db->group_start()
                ->like('nama', $search)
                ->or_like('username', $search)
                ->or_like('email', $search)
                ->or_like('no_telepon', $search)
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
    public function toggle_status($id)
    {
        $user = $this->get_by_id($id);
        if (!$user)
            return false;
        $newStatus = ($user['status'] === 'active') ? 'inactive' : 'active';
        return $this->db->where('id_user', $id)->update('tb_user', ['status' => $newStatus]);
    }

    // Verify token for email verification or password reset
    public function verify_token($token, $type)
    {
        $column = ($type === 'verification') ? 'verification_token' : 'reset_token';

        $this->db->where($column, $token);
        $this->db->where('token_expiry >=', date('Y-m-d H:i:s'));
        return $this->db->get('tb_user')->row_array();
    }

    // ===== OTP Functions =====

    // Insert OTP ke database
    public function insert_otp($tujuan, $kode_otp, $metode = 'whatsapp', $id_user = NULL)
    {
        $this->db->where('tujuan', $tujuan);
        $this->db->where('metode', $metode);
        $this->db->where('status !=', 'Verified');
        $this->db->delete('tb_otp');

        $data = [
            'id_user' => $id_user,
            'tujuan' => $tujuan,
            'metode' => $metode,
            'kode_otp' => $kode_otp,
            'status' => 'Pending',
            'percobaan' => 0,
            'dikirim_pada' => date('Y-m-d H:i:s'),
            'kadaluarsa_pada' => date('Y-m-d H:i:s', strtotime('+5 minutes'))
        ];

        return $this->db->insert('tb_otp', $data);
    }

    // Verify OTP
    public function verify_otp($tujuan, $kode_otp, $metode = 'whatsapp')
    {
        $this->db->where('tujuan', $tujuan);
        $this->db->where('kode_otp', $kode_otp);
        $this->db->where('metode', $metode);
        $this->db->where('status', 'Pending');
        $this->db->where('kadaluarsa_pada >=', date('Y-m-d H:i:s'));
        
        $result = $this->db->get('tb_otp')->row_array();

        if ($result) {
            $this->db->where('id_otp', $result['id_otp'])->update('tb_otp', [
                'status' => 'Verified',
                'diverifikasi_pada' => date('Y-m-d H:i:s')
            ]);
            return true;
        } else {
            $this->db->where('tujuan', $tujuan);
            $this->db->where('metode', $metode);
            $this->db->where('status', 'Pending');
            $pending_otp = $this->db->get('tb_otp')->row_array();
            
            if ($pending_otp) {
                $this->db->where('id_otp', $pending_otp['id_otp'])->update('tb_otp', [
                    'percobaan' => $pending_otp['percobaan'] + 1
                ]);
            }
        }

        return false;
    }

    // Delete OTP
    public function delete_otp($tujuan, $metode = 'whatsapp')
    {
        return $this->db->delete('tb_otp', [
            'tujuan' => $tujuan,
            'metode' => $metode,
            'status' => 'Pending'
        ]);
    }

    // Get OTP for resend
    public function get_otp($tujuan, $metode = 'whatsapp')
    {
        $this->db->where('tujuan', $tujuan);
        $this->db->where('metode', $metode);
        $this->db->where('status', 'Pending');
        $this->db->where('kadaluarsa_pada >=', date('Y-m-d H:i:s'));
        $this->db->order_by('dikirim_pada', 'DESC');
        $this->db->limit(1);

        return $this->db->get('tb_otp')->row_array();
    }

    // Check if OTP attempt limit reached
    public function is_otp_attempt_exceeded($tujuan, $metode = 'whatsapp', $max_attempt = 5)
    {
        $this->db->where('tujuan', $tujuan);
        $this->db->where('metode', $metode);
        $this->db->where('status', 'Pending');
        $kode_otp = $this->db->get('tb_otp')->row_array();

        if ($kode_otp && $kode_otp['percobaan'] >= $max_attempt) {
            return true;
        }
        return false;
    }

    // ===== Petani Verification Functions =====

    // Verify petani account oleh admin
    public function verify_petani($id_user)
    {
        return $this->db->where('id_user', $id_user)
            ->where('role', 'Petani')
            ->update('tb_user', [
                'is_verified' => '1',
                'status' => 'Active',
                'updated_at' => date('Y-m-d H:i:s')
            ]);
    }

    // Reject petani account oleh admin
    public function reject_petani($id_user)
    {
        return $this->db->where('id_user', $id_user)
            ->where('role', 'Petani')
            ->update('tb_user', [
                'is_verified' => '0',
                'status' => 'Inactive',
                'updated_at' => date('Y-m-d H:i:s')
            ]);
    }

    // Get unverified petani
    public function get_unverified_petani()
    {
        return $this->db->where('role', 'Petani')
            ->where('is_verified', '0')
            ->order_by('created_at', 'DESC')
            ->get('tb_user')
            ->result_array();
    }

    // Get verified petani
    public function get_verified_petani()
    {
        return $this->db->where('role', 'Petani')
            ->where('is_verified', '1')
            ->order_by('created_at', 'DESC')
            ->get('tb_user')
            ->result_array();
    }

    // ===== User Status Management =====

    // Toggle user active/inactive status
    public function set_user_status($id_user, $status)
    {
        $allowed_status = ['Active', 'Inactive', 'Pending'];
        
        if (!in_array($status, $allowed_status)) {
            return false;
        }

        return $this->db->where('id_user', $id_user)
            ->update('tb_user', [
                'status' => $status,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
    }

    // Get user status
    public function get_user_status($id_user)
    {
        $user = $this->get_by_id($id_user);
        return $user ? $user['status'] : null;
    }
}
