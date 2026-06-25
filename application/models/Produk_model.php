<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {

    private $table = 'tb_produk';

    public function getAll()
    {
        return $this->db->order_by('id_produk','DESC')
                        ->get($this->table)
                        ->result();
    }

    public function getById($id)
    {
        return $this->db
                    ->where('id_produk',$id)
                    ->get($this->table)
                    ->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table,$data);
    }

    public function update($id,$data)
    {
        return $this->db
                    ->where('id_produk',$id)
                    ->update($this->table,$data);
    }

    public function delete($id)
    {
        return $this->db
                    ->where('id_produk',$id)
                    ->delete($this->table);
    }

    public function kurangi_stok($id_produk, $jumlah)
    {
        $this->db->set('stok_produk', 'stok_produk - ' . (int)$jumlah, FALSE);
        $this->db->where('id_produk', $id_produk);
        $this->db->where('stok_produk >=', $jumlah);
        return $this->db->update($this->table);
    }

    public function tambah_stok($id_produk, $jumlah)
    {
        $this->db->set('stok_produk', 'stok_produk + ' . (int)$jumlah, FALSE);
        $this->db->where('id_produk', $id_produk);
        return $this->db->update($this->table);
    }
}