<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Kurir_model
 * ============================================
 * Model ini dipakai BERSAMA oleh 2 modul karena keduanya butuh akses
 * ke tabel `tb_kurir`:
 *   - Modul 07: Tracking Pengiriman (Acep)
 *   - Modul 08: Manajemen Kurir (Anisya)
 *
 * Supaya tidak saling menimpa lagi saat git pull, SEMUA method dari
 * kedua modul digabung di SATU file ini. Kalau salah satu modul butuh
 * method tambahan, tambahkan di file ini juga, jangan buat file baru
 * dengan nama yang sama.
 * ============================================
 * Kolom tb_kurir (sesuai liberchain.sql):
 * id_kurir, nama_kurir, no_telepon, email, status (Active/Inactive/Offline),
 * lokasi_terakhir, lat_terakhir, lng_terakhir, created_at, updated_at
 */
class Kurir_model extends CI_Model
{
    private $table = 'tb_kurir';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // ============================================================
    // ============ MILIK MODUL 07 (Acep — Tracking) ===============
    // ============================================================

    public function get_kurir_by_id($id_kurir)
    {
        $this->db->where('id_kurir', $id_kurir);
        return $this->db->get($this->table)->row();
    }

    public function get_available_kurir()
    {
        $this->db->where('status', 'Active');
        $this->db->order_by('nama_kurir');
        return $this->db->get($this->table)->result();
    }

    public function get_kurir_by_tracking($id_tracking)
    {
        $this->db->select('k.*');
        $this->db->from('tb_kurir k');
        $this->db->join('tb_tracking t', 't.id_kurir = k.id_kurir');
        $this->db->where('t.id_tracking', $id_tracking);
        return $this->db->get()->row();
    }

    public function update_location($id_kurir, $lat, $lng, $lokasi = null)
    {
        $data = [
            'lat_terakhir'    => $lat,
            'lng_terakhir'    => $lng,
            'lokasi_terakhir' => $lokasi,
            'updated_at'      => date('Y-m-d H:i:s'),
        ];
        $this->db->where('id_kurir', $id_kurir);
        return $this->db->update($this->table, $data);
    }

    // ============================================================
    // ======== MILIK MODUL 08 (Anisya — Manajemen Kurir) ==========
    // ============================================================

    public function get_all($status = null, $keyword = null)
    {
        $this->db->where('deleted_at', null);

        if ($status && in_array($status, ['Active', 'Inactive'])) {
            $this->db->where('status', $status);
        }

        if (!empty($keyword)) {
            $this->db->group_start();
            $this->db->like('nama_kurir', $keyword);
            $this->db->or_like('no_telepon', $keyword);
            $this->db->or_like('email', $keyword);
            $this->db->group_end();
        }

        $this->db->order_by('created_at', 'DESC');
        return $this->db->get($this->table)->result_array();
    }

    public function get_by_id($id_kurir, $with_deleted = false)
    {
        $this->db->where('id_kurir', $id_kurir);
        if (!$with_deleted) {
            $this->db->where('deleted_at', null);
        }
        return $this->db->get($this->table)->row_array();
    }

    public function get_detail_with_history($id_kurir)
    {
        $kurir = $this->get_by_id($id_kurir, true);
        if (!$kurir) {
            return null;
        }

        $this->db->select('
                tb_tracking.id_tracking,
                tb_tracking.id_transaksi,
                tb_tracking.status_pengiriman,
                tb_tracking.estimasi_tiba,
                tb_tracking.tanggal_kirim,
                tb_tracking.tanggal_terima,
                tb_tracking.created_at AS tracking_created_at,
                tb_transaksi.invoice,
                tb_transaksi.total_harga
            ')
            ->from('tb_tracking')
            ->join('tb_transaksi', 'tb_transaksi.id_tracking = tb_tracking.id_tracking', 'left')
            ->where('tb_tracking.id_kurir', $id_kurir)
            ->order_by('tb_tracking.created_at', 'DESC');

        $pengiriman = $this->db->get()->result_array();

        foreach ($pengiriman as &$p) {
            $p['history'] = $this->db
                ->where('id_tracking', $p['id_tracking'])
                ->order_by('created_at', 'ASC')
                ->get('tb_tracking_history')
                ->result_array();
        }

        return [
            'kurir'      => $kurir,
            'pengiriman' => $pengiriman,
        ];
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id_kurir, $data)
    {
        $this->db->where('id_kurir', $id_kurir);
        return $this->db->update($this->table, $data);
    }

    public function delete($id_kurir)
    {
        return $this->db->where('id_kurir', $id_kurir)
            ->update($this->table, ['deleted_at' => date('Y-m-d H:i:s')]);
    }

    public function restore($id_kurir)
    {
        return $this->db->where('id_kurir', $id_kurir)
            ->update($this->table, ['deleted_at' => null]);
    }

    public function count_by_status($status)
    {
        return $this->db->where('status', $status)
            ->where('deleted_at', null)
            ->count_all_results($this->table);
    }

    public function count_all()
    {
        return $this->db->where('deleted_at', null)->count_all_results($this->table);
    }

    public function is_in_use($id_kurir)
    {
        $status_aktif = ['diproses', 'dikirim', 'dalam_perjalanan', 'tiba_di_kota_tujuan', 'out_for_delivery'];

        $count = $this->db->where('id_kurir', $id_kurir)
            ->where_in('status_pengiriman', $status_aktif)
            ->count_all_results('tb_tracking');

        return $count > 0;
    }

    // ============================================================
    // 🔥 METHOD UNTUK ASSIGN KURIR LANGSUNG KE TB_TRANSAKSI
    // ============================================================

    public function get_pengiriman_belum_assign()
    {
        $this->db->select('
                t.id_transaksi,
                t.invoice,
                t.total_harga,
                t.grand_total,
                t.status_pesanan,
                t.status_bayar,
                t.alamat_kirim,
                t.kota_kirim,
                t.nama_penerima,
                t.no_hp,
                u.nama AS nama_pembeli,
                u.email
            ')
            ->from('tb_transaksi t')
            ->join('tb_user u', 'u.id_user = t.id_user', 'left')
            ->where('t.status_pesanan', 'Diproses')
            ->where('t.status_bayar', 'Lunas')
            ->where('(t.id_kurir IS NULL OR t.id_kurir = 0)')
            ->order_by('t.tanggal_transaksi', 'ASC');

        return $this->db->get()->result_array();
    }

    public function get_kurir_aktif()
    {
        return $this->db->where('status', 'Active')
            ->where('deleted_at IS NULL')
            ->order_by('nama_kurir', 'ASC')
            ->get($this->table)
            ->result_array();
    }

    public function assign_kurir_ke_transaksi($id_transaksi, $id_kurir)
    {
        $data = [
            'id_kurir' => $id_kurir,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id_transaksi', $id_transaksi);
        return $this->db->update('tb_transaksi', $data);
    }

    public function is_kurir_sibuk($id_kurir)
    {
        $this->db->where('id_kurir', $id_kurir);
        $this->db->where_in('status_pesanan', ['Diproses', 'Dikirim']);
        $this->db->where('status_bayar', 'Lunas');
        return $this->db->count_all_results('tb_transaksi') > 0;
    }

    public function get_transaksi_belum_assign()
    {
        return $this->get_pengiriman_belum_assign();
    }

    public function get_pengiriman_belum_assign_by_user($id_user)
    {
        $this->db->select('
                t.id_transaksi,
                t.invoice,
                t.total_harga,
                t.grand_total,
                t.status_pesanan,
                t.status_bayar,
                t.alamat_kirim,
                t.kota_kirim,
                t.nama_penerima,
                t.no_hp,
                u.nama AS nama_pembeli,
                u.email
            ')
            ->from('tb_transaksi t')
            ->join('tb_user u', 'u.id_user = t.id_user', 'left')
            ->where('t.id_user', $id_user)
            ->where('t.status_pesanan', 'Diproses')
            ->where('t.status_bayar', 'Lunas')
            ->where('(t.id_kurir IS NULL OR t.id_kurir = 0)')
            ->order_by('t.tanggal_transaksi', 'ASC');

        return $this->db->get()->result_array();
    }

    public function get_performance_kurir()
    {
        $kurir_list = $this->db->where('deleted_at', null)
            ->order_by('nama_kurir', 'ASC')
            ->get($this->table)
            ->result_array();

        foreach ($kurir_list as &$k) {
            $id_kurir = $k['id_kurir'];

            $k['total_pengiriman'] = $this->db
                ->where('id_kurir', $id_kurir)
                ->count_all_results('tb_tracking');

            $k['selesai'] = $this->db
                ->where('id_kurir', $id_kurir)
                ->where_in('status_pengiriman', ['delivered', 'diterima'])
                ->count_all_results('tb_tracking');

            $k['dibatalkan'] = $this->db
                ->where('id_kurir', $id_kurir)
                ->where('status_pengiriman', 'dibatalkan')
                ->count_all_results('tb_tracking');

            $k['sedang_berjalan'] = $k['total_pengiriman'] - $k['selesai'] - $k['dibatalkan'];

            $avg = $this->db->select('AVG(TIMESTAMPDIFF(HOUR, tanggal_kirim, tanggal_terima)) AS avg_jam', false)
                ->where('id_kurir', $id_kurir)
                ->where('tanggal_kirim IS NOT NULL', null, false)
                ->where('tanggal_terima IS NOT NULL', null, false)
                ->get('tb_tracking')
                ->row_array();

            $k['rata_rata_jam_kirim'] = $avg['avg_jam'] !== null ? round($avg['avg_jam'], 1) : null;
        }

        return $kurir_list;
    }

    public function assign_kurir($id_tracking, $id_kurir)
    {
        $this->db->trans_start();

        $this->db->where('id_tracking', $id_tracking)->update('tb_tracking', [
            'id_kurir'          => $id_kurir,
            'status_pengiriman' => 'diproses',
        ]);

        $kurir = $this->get_by_id($id_kurir);

        $this->db->insert('tb_tracking_history', [
            'id_tracking' => $id_tracking,
            'status'      => 'diproses',
            'lokasi'      => $kurir['lokasi_terakhir'] ?? null,
            'keterangan'  => 'Kurir ' . ($kurir['nama_kurir'] ?? '') . ' ditugaskan untuk pengiriman ini',
        ]);

        // Kirim Notifikasi ke Pembeli dan Kurir
        $tracking = $this->db->select('t.id_transaksi, tr.id_user as pembeli_id, tr.invoice')
            ->from('tb_tracking t')
            ->join('tb_transaksi tr', 'tr.id_transaksi = t.id_transaksi')
            ->where('t.id_tracking', $id_tracking)
            ->get()->row();

        if ($tracking && $kurir) {
            $CI =& get_instance();
            $CI->load->helper('notifikasi');
            
            // 1. Notifikasi ke pembeli
            notifikasi_tracking(
                $tracking->pembeli_id,
                $tracking->invoice,
                'Kurir Ditugaskan',
                "Kurir " . ($kurir['nama_kurir'] ?? 'Kurir') . " telah ditugaskan untuk mengantar pesanan Anda."
            );

            // 2. Notifikasi ke kurir
            $user_kurir = $this->db
                ->where('email', $kurir['email'])
                ->where('role', 'Kurir')
                ->get('tb_user')->row();

            if ($user_kurir) {
                send_notifikasi(
                    $user_kurir->id_user,
                    'Kurir',
                    'Penugasan Pengiriman Baru',
                    "Anda ditugaskan mengantar pesanan #{$tracking->invoice}. Segera upload bukti pengiriman.",
                    'info',
                    base_url('kurir/tracking')
                );
            }
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}
?>