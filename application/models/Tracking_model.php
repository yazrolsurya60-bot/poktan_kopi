<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracking_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * M07-F01: Get tracking by transaction ID
     */
    public function get_tracking_by_transaksi($id_transaksi, $id_user = null) {
        $this->db->select('
            t.*,
            tr.id_user as pembeli_id,
            tr.invoice,
            tr.status_pesanan,
            tr.total_harga,
            k.nama_kurir,
            k.no_telepon as kurir_telp,
            k.lat_terakhir as kurir_lat,
            k.lng_terakhir as kurir_lng,
            (SELECT COUNT(*) FROM tb_tracking_history th WHERE th.id_tracking = t.id_tracking) as total_update
        ');
        $this->db->from('tb_tracking t');
        $this->db->join('tb_transaksi tr', 'tr.id_transaksi = t.id_transaksi');
        $this->db->join('tb_kurir k', 'k.id_kurir = t.id_kurir', 'left');
        $this->db->where('t.id_transaksi', $id_transaksi);
        if ($id_user) $this->db->where('tr.id_user', $id_user);
        $query = $this->db->get();
        return $query->row();
    }
    
    /**
     * M07-F01: Get tracking by ID (dengan total_update)
     */
    public function get_tracking_by_id($id_tracking) {
        $this->db->select('
            t.*,
            tr.id_user as pembeli_id,
            tr.invoice,
            tr.total_harga,
            k.nama_kurir,
            k.no_telepon as kurir_telp,
            k.lat_terakhir as kurir_lat,
            k.lng_terakhir as kurir_lng,
            (SELECT COUNT(*) FROM tb_tracking_history th WHERE th.id_tracking = t.id_tracking) as total_update
        ');
        $this->db->from('tb_tracking t');
        $this->db->join('tb_transaksi tr', 'tr.id_transaksi = t.id_transaksi');
        $this->db->join('tb_kurir k', 'k.id_kurir = t.id_kurir', 'left');
        $this->db->where('t.id_tracking', $id_tracking);
        $query = $this->db->get();
        return $query->row();
    }
    
    /**
     * M07-F05: Get tracking history
     */
    public function get_tracking_history($id_tracking, $limit = null) {
        $this->db->from('tb_tracking_history');
        $this->db->where('id_tracking', $id_tracking);
        $this->db->order_by('created_at', 'DESC');
        if ($limit) $this->db->limit($limit);
        return $this->db->get()->result();
    }
    
    /**
     * M07-F02: Update tracking status (Petani)
     */
    public function update_status($id_tracking, $status, $keterangan = null) {
        $data = ['status_pengiriman' => $status, 'updated_at' => date('Y-m-d H:i:s')];
        if ($status == 'dikirim') $data['tanggal_kirim'] = date('Y-m-d H:i:s');
        if ($status == 'diterima') $data['tanggal_terima'] = date('Y-m-d H:i:s');
        $this->db->where('id_tracking', $id_tracking);
        $result = $this->db->update('tb_tracking', $data);
        if ($result) $this->save_history($id_tracking, $status, $keterangan);
        return $result;
    }

    // ============================================================
    // 🔥 METHOD BARU UNTUK ADMIN UPDATE STATUS (M07-F02)
    // ============================================================
    
    /**
     * M07-F02: Update tracking status by Admin (dengan pencatat admin)
     */
    public function update_status_admin($id_tracking, $status, $keterangan = null, $admin_id = null) {
        $data = [
            'status_pengiriman' => $status,
            'status_updated_by' => $admin_id,
            'status_updated_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($status == 'dikirim') {
            $data['tanggal_kirim'] = date('Y-m-d H:i:s');
        }

        if ($status == 'diterima') {
            $data['tanggal_terima'] = date('Y-m-d H:i:s');
        }

        $this->db->where('id_tracking', $id_tracking);
        $result = $this->db->update('tb_tracking', $data);

        if ($result) {
            // Tambahkan keterangan siapa yang update
            $admin_name = $this->get_admin_name($admin_id);
            $history_keterangan = $keterangan ?: "Status diperbarui oleh Admin: {$admin_name}";
            $this->save_history($id_tracking, $status, $history_keterangan);
        }

        return $result;
    }

    /**
     * Get admin name by ID
     */
    private function get_admin_name($admin_id) {
        $this->db->select('nama');
        $this->db->where('id_user', $admin_id);
        $query = $this->db->get('tb_user');
        return $query->row()->nama ?? 'Admin';
    }
    
    /**
     * M07-F03: Update kurir location
     */
    public function update_kurir_location($id_kurir, $lat, $lng, $lokasi = null) {
        $data = [
            'lat_terakhir' => $lat,
            'lng_terakhir' => $lng,
            'lokasi_terakhir' => $lokasi,
            'updated_at' => date('Y-m-d H:i:s'),
            'status' => 'Active'
        ];
        $this->db->where('id_kurir', $id_kurir);
        return $this->db->update('tb_kurir', $data);
    }
    
    /**
     * M07-F03: Update tracking with kurir location
     */
    public function update_tracking_location($id_tracking, $lat, $lng, $lokasi = null, $status = null) {
        $tracking = $this->get_tracking_by_id($id_tracking);
        if ($tracking && $tracking->id_kurir) {
            $this->update_kurir_location($tracking->id_kurir, $lat, $lng, $lokasi);
        }
        $status_update = $status ?: 'dalam_perjalanan';
        $keterangan = "Lokasi terakhir: " . ($lokasi ?: "Koordinat {$lat}, {$lng}");
        $this->save_history($id_tracking, $status_update, $keterangan, $lat, $lng, $lokasi);
        if (!$status) {
            $this->db->where('id_tracking', $id_tracking);
            $this->db->update('tb_tracking', ['updated_at' => date('Y-m-d H:i:s')]);
        }
        return true;
    }
    
    /**
     * Save tracking history
     */
    public function save_history($id_tracking, $status, $keterangan = null, $lat = null, $lng = null, $lokasi = null) {
        $data = [
            'id_tracking' => $id_tracking,
            'status' => $status,
            'latitude' => $lat,
            'longitude' => $lng,
            'lokasi' => $lokasi,
            'keterangan' => $keterangan,
            'created_at' => date('Y-m-d H:i:s')
        ];
        return $this->db->insert('tb_tracking_history', $data);
    }
    
    /**
     * M07-F07: Approve diterima (Pembeli)
     */
    public function approve_diterima($id_tracking, $id_user) {
        $this->db->select('t.*');
        $this->db->from('tb_tracking t');
        $this->db->join('tb_transaksi tr', 'tr.id_transaksi = t.id_transaksi');
        $this->db->where('t.id_tracking', $id_tracking);
        $this->db->where('tr.id_user', $id_user);
        $query = $this->db->get();
        if ($query->num_rows() == 0) return false;
        $tracking = $query->row();
        if ($tracking->status_pengiriman != 'delivered') return false;
        $data = [
            'status_pengiriman' => 'diterima',
            'tanggal_terima' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id_tracking', $id_tracking);
        $result = $this->db->update('tb_tracking', $data);
        if ($result) $this->save_history($id_tracking, 'diterima', 'Barang telah diterima oleh pembeli');
        return $result;
    }
    
    /**
     * M07-F08: Get estimasi tiba
     */
    public function get_estimasi_tiba($id_tracking) {
        $tracking = $this->get_tracking_by_id($id_tracking);
        if (!$tracking) return null;
        if (in_array($tracking->status_pengiriman, ['delivered', 'diterima'])) {
            return $tracking->tanggal_terima ?: $tracking->updated_at;
        }
        if (!$tracking->estimasi_tiba) {
            $estimasi = date('Y-m-d H:i:s', strtotime('+5 days'));
            if ($tracking->status_pengiriman == 'dikirim') $estimasi = date('Y-m-d H:i:s', strtotime('+3 days'));
            if ($tracking->status_pengiriman == 'dalam_perjalanan') $estimasi = date('Y-m-d H:i:s', strtotime('+2 days'));
            if ($tracking->status_pengiriman == 'out_for_delivery') $estimasi = date('Y-m-d H:i:s', strtotime('+4 hours'));
            $this->db->where('id_tracking', $id_tracking);
            $this->db->update('tb_tracking', ['estimasi_tiba' => $estimasi]);
            return $estimasi;
        }
        return $tracking->estimasi_tiba;
    }
    
    /**
     * Get user tracking
     */
    public function get_user_tracking($id_user, $limit = null) {
        $this->db->select('t.*, tr.invoice, tr.total_harga, tr.status_pesanan, k.nama_kurir, k.lat_terakhir as kurir_lat, k.lng_terakhir as kurir_lng');
        $this->db->from('tb_tracking t');
        $this->db->join('tb_transaksi tr', 'tr.id_transaksi = t.id_transaksi');
        $this->db->join('tb_kurir k', 'k.id_kurir = t.id_kurir', 'left');
        $this->db->where('tr.id_user', $id_user);
        $this->db->where_not_in('t.status_pengiriman', ['diterima', 'dibatalkan']);
        $this->db->order_by('t.created_at', 'DESC');
        if ($limit) $this->db->limit($limit);
        return $this->db->get()->result();
    }
    
    /**
     * Get petani tracking
     */
    public function get_petani_tracking($id_user) {
        $this->db->select('t.*, tr.invoice, u.nama as pembeli, k.nama_kurir');
        $this->db->from('tb_tracking t');
        $this->db->join('tb_transaksi tr', 'tr.id_transaksi = t.id_transaksi');
        $this->db->join('tb_transaksi_detail td', 'td.id_transaksi = tr.id_transaksi', 'left');
        $this->db->join('tb_produk p', 'p.id_produk = td.id_produk', 'left');
        $this->db->join('tb_user u', 'u.id_user = tr.id_user');
        $this->db->join('tb_kurir k', 'k.id_kurir = t.id_kurir', 'left');
        $this->db->where('p.id_user', $id_user);
        $this->db->where_not_in('t.status_pengiriman', ['diterima', 'dibatalkan']);
        $this->db->order_by('t.created_at', 'DESC');
        return $this->db->get()->result();
    }
    
    /**
     * Get tracking by status
     */
    public function get_tracking_by_status($status = null, $limit = null) {
        $this->db->select('t.*, tr.invoice, u.nama as pembeli, k.nama_kurir, t.bukti_pengiriman');
        $this->db->from('tb_tracking t');
        $this->db->join('tb_transaksi tr', 'tr.id_transaksi = t.id_transaksi');
        $this->db->join('tb_user u', 'u.id_user = tr.id_user');
        $this->db->join('tb_kurir k', 'k.id_kurir = t.id_kurir', 'left');
        if ($status) $this->db->where('t.status_pengiriman', $status);
        $this->db->order_by('t.created_at', 'DESC');
        if ($limit) $this->db->limit($limit);
        return $this->db->get()->result();
    }
    
    /**
     * M07-F06: Get status label (konsisten dengan dashboard)
     */
    public function get_status_label($status) {
        $labels = [
            'pending'           => ['label' => 'Menunggu', 'class' => 'pending', 'icon' => 'bi bi-clock'],
            'diproses'          => ['label' => 'Diproses', 'class' => 'processing', 'icon' => 'bi bi-gear'],
            'dikirim'           => ['label' => 'Dikirim', 'class' => 'delivery', 'icon' => 'bi bi-truck'],
            'dalam_perjalanan'  => ['label' => 'Dalam Perjalanan', 'class' => 'delivery', 'icon' => 'bi bi-arrow-right-circle'],
            'tiba_di_kota_tujuan' => ['label' => 'Tiba di Kota Tujuan', 'class' => 'delivery', 'icon' => 'bi bi-geo-alt'],
            'out_for_delivery'  => ['label' => 'Out for Delivery', 'class' => 'delivery', 'icon' => 'bi bi-bicycle'],
            'delivered'         => ['label' => 'Telah Dikirim', 'class' => 'complete', 'icon' => 'bi bi-check-circle'],
            'diterima'          => ['label' => 'Diterima', 'class' => 'complete', 'icon' => 'bi bi-check2-circle'],
            'dibatalkan'        => ['label' => 'Dibatalkan', 'class' => 'cancelled', 'icon' => 'bi bi-x-circle']
        ];
        return isset($labels[$status]) ? $labels[$status] : ['label' => $status, 'class' => 'pending', 'icon' => 'bi bi-info-circle'];
    }

    /**
     * M07-F09: Upload bukti pengiriman
     */
    public function upload_bukti($id_tracking, $file_name, $id_user) {
        $data = [
            'bukti_pengiriman' => $file_name,
            'bukti_upload_at' => date('Y-m-d H:i:s'),
            'bukti_upload_by' => $id_user,
            'status_pengiriman' => 'delivered',
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id_tracking', $id_tracking);
        $result = $this->db->update('tb_tracking', $data);
        if ($result) {
            $this->save_history($id_tracking, 'delivered', 'Bukti pengiriman telah diunggah oleh kurir');
        }
        return $result;
    }

    /**
     * M07-F09: Get bukti pengiriman
     */
    public function get_bukti($id_tracking) {
        $this->db->select('bukti_pengiriman, bukti_upload_at, bukti_upload_by');
        $this->db->where('id_tracking', $id_tracking);
        return $this->db->get('tb_tracking')->row();
    }

    /**
     * Buat tracking untuk transaksi yang sudah ada (tanpa data dummy)
     */
    public function create_tracking_for_existing_transactions() {
        // Ambil semua transaksi yang belum punya tracking
        $this->db->select('id_transaksi, invoice, id_user');
        $this->db->where('id_tracking IS NULL', NULL, FALSE);
        $transactions = $this->db->get('tb_transaksi')->result();
        
        $created = 0;
        foreach ($transactions as $trx) {
            // Cek apakah sudah ada di tb_tracking (mencegah unique key violation)
            $exists = $this->db->get_where('tb_tracking', ['id_transaksi' => $trx->id_transaksi])->row();
            if ($exists) {
                $this->db->where('id_transaksi', $trx->id_transaksi);
                $this->db->update('tb_transaksi', ['id_tracking' => $exists->id_tracking]);
                continue;
            }

            // Buat tracking
            $data = [
                'id_transaksi' => $trx->id_transaksi,
                'status_pengiriman' => 'pending',
                'created_at' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('tb_tracking', $data);
            $id_tracking = $this->db->insert_id();
            
            // Update transaksi
            $this->db->where('id_transaksi', $trx->id_transaksi);
            $this->db->update('tb_transaksi', ['id_tracking' => $id_tracking]);
            $created++;
        }
        
        return $created;
    }

    /**
     * Get tracking list assigned to a specific courier user
     */
    public function get_kurir_tracking($id_user, $limit = null) {
        $user = $this->db->get_where('tb_user', ['id_user' => $id_user])->row();
        if (!$user || empty($user->email)) return [];

        $kurir = $this->db->get_where('tb_kurir', ['email' => $user->email])->row();
        if (!$kurir) return [];

        $this->db->select('t.*, tr.invoice, u.nama as pembeli, k.nama_kurir, t.bukti_pengiriman');
        $this->db->from('tb_tracking t');
        $this->db->join('tb_transaksi tr', 'tr.id_transaksi = t.id_transaksi');
        $this->db->join('tb_user u', 'u.id_user = tr.id_user');
        $this->db->join('tb_kurir k', 'k.id_kurir = t.id_kurir');
        $this->db->where('t.id_kurir', $kurir->id_kurir);
        $this->db->order_by('t.created_at', 'DESC');
        if ($limit) $this->db->limit($limit);
        return $this->db->get()->result();
    }
}