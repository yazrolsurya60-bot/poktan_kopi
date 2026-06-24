<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurir_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_kurir_by_id($id_kurir) {
        $this->db->where('id_kurir', $id_kurir);
        return $this->db->get('tb_kurir')->row();
    }
    
    public function get_available_kurir() {
        $this->db->where('status', 'Active');
        $this->db->order_by('nama_kurir');
        return $this->db->get('tb_kurir')->result();
    }
    
    public function get_kurir_by_tracking($id_tracking) {
        $this->db->select('k.*');
        $this->db->from('tb_kurir k');
        $this->db->join('tb_tracking t', 't.id_kurir = k.id_kurir');
        $this->db->where('t.id_tracking', $id_tracking);
        return $this->db->get()->row();
    }
    
    public function update_location($id_kurir, $lat, $lng, $lokasi = null) {
        $data = [
            'lat_terakhir' => $lat,
            'lng_terakhir' => $lng,
            'lokasi_terakhir' => $lokasi,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id_kurir', $id_kurir);
        return $this->db->update('tb_kurir', $data);
    }
}
