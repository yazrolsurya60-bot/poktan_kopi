<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Otp_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Generate kode OTP 6 digit dan simpan ke DB.
     * OTP lama yang masih Pending untuk tujuan yang sama otomatis di-expire,
     * supaya tidak ada kode ganda yang berlaku bersamaan.
     */
    public function buat_otp($tujuan, $metode, $id_user = null, $session_id = null) {
        // Expire-kan OTP lama yang belum terverifikasi untuk tujuan ini
        $this->db->where('tujuan', $tujuan)
                  ->where('status', 'Pending')
                  ->update('tb_otp', ['status' => 'Expired']);

        $kode = (string) random_int(100000, 999999);

        $data = [
            'id_user'         => $id_user,
            'session_id'      => $session_id,
            'tujuan'          => $tujuan,
            'metode'          => $metode,
            'kode_otp'        => $kode,
            'status'          => 'Pending',
            'percobaan'       => 0,
            'dikirim_pada'    => date('Y-m-d H:i:s'),
            'kadaluarsa_pada' => date('Y-m-d H:i:s', strtotime('+5 minutes')),
        ];

        $this->db->insert('tb_otp', $data);

        return $kode;
    }

    public function get_otp_aktif($tujuan) {
        return $this->db->where('tujuan', $tujuan)
                          ->where('status', 'Pending')
                          ->order_by('id_otp', 'DESC')
                          ->get('tb_otp')
                          ->row_array();
    }

    /**
     * Cocokkan kode yang diinput user.
     * return: 'success' | 'invalid' | 'expired' | 'too_many_attempts'
     */
    public function verifikasi_kode($tujuan, $kode_input) {
        $otp = $this->get_otp_aktif($tujuan);

        if (!$otp) {
            return 'expired';
        }

        if ($otp['percobaan'] >= 5) {
            $this->db->where('id_otp', $otp['id_otp'])->update('tb_otp', ['status' => 'Expired']);
            return 'too_many_attempts';
        }

        if (strtotime($otp['kadaluarsa_pada']) < time()) {
            $this->db->where('id_otp', $otp['id_otp'])->update('tb_otp', ['status' => 'Expired']);
            return 'expired';
        }

        if ($otp['kode_otp'] !== (string) $kode_input) {
            $this->db->where('id_otp', $otp['id_otp'])->set('percobaan', 'percobaan+1', FALSE)->update('tb_otp');
            return 'invalid';
        }

        $this->db->where('id_otp', $otp['id_otp'])->update('tb_otp', [
            'status'             => 'Verified',
            'diverifikasi_pada'  => date('Y-m-d H:i:s'),
        ]);

        return 'success';
    }

    public function tandai_user_terverifikasi($id_user, $tujuan, $metode) {
        $update = ['kontak_terverifikasi' => 1];
        if ($metode === 'whatsapp') {
            $update['no_telp'] = $tujuan;
        }
        $this->db->where('id_user', $id_user)->update('tb_user', $update);
    }
}