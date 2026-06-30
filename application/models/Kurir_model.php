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

    // M08-F02: Ambil semua kurir (yang belum dihapus), bisa difilter status & dicari keyword
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

    // Ambil satu kurir berdasarkan ID (versi array, dipakai Controller Modul 08)
    // Hanya mengambil kurir yang belum di-soft-delete, kecuali $with_deleted = true
    public function get_by_id($id_kurir, $with_deleted = false)
    {
        $this->db->where('id_kurir', $id_kurir);
        if (!$with_deleted) {
            $this->db->where('deleted_at', null);
        }
        return $this->db->get($this->table)->row_array();
    }

    // M08-F03: Detail kurir + seluruh history pengiriman yang pernah ia tangani
    // Menggabungkan tb_tracking (status saat ini per transaksi) dengan
    // tb_tracking_history (jejak perubahan status per waktu)
    public function get_detail_with_history($id_kurir)
    {
        $kurir = $this->get_by_id($id_kurir, true);
        if (!$kurir) {
            return null;
        }

        // Daftar pengiriman yang pernah ditangani kurir ini
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

        // Ambil history detail (jejak status) untuk setiap tracking milik kurir ini
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

    // M08-F02: Tambah kurir baru
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // M08-F03: Update data kurir
    public function update($id_kurir, $data)
    {
        $this->db->where('id_kurir', $id_kurir);
        return $this->db->update($this->table, $data);
    }

    // M08-F05: Soft delete kurir — tidak benar-benar hapus baris,
    // hanya menandai deleted_at dengan waktu sekarang
    public function delete($id_kurir)
    {
        return $this->db->where('id_kurir', $id_kurir)
            ->update($this->table, ['deleted_at' => date('Y-m-d H:i:s')]);
    }

    // Restore kurir yang sudah di-soft-delete (jaga-jaga kalau dibutuhkan nanti)
    public function restore($id_kurir)
    {
        return $this->db->where('id_kurir', $id_kurir)
            ->update($this->table, ['deleted_at' => null]);
    }

    // M08-F02 / F07: Hitung jumlah kurir per status (summary card), exclude yang dihapus
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

    // M08-F04: Cek apakah kurir masih punya pengiriman aktif (sebelum hapus)
    public function is_in_use($id_kurir)
    {
        $status_aktif = ['diproses', 'dikirim', 'dalam_perjalanan', 'tiba_di_kota_tujuan', 'out_for_delivery'];

        $count = $this->db->where('id_kurir', $id_kurir)
            ->where_in('status_pengiriman', $status_aktif)
            ->count_all_results('tb_tracking');

        return $count > 0;
    }

    // M08-F06: Daftar kurir berstatus Active (untuk dropdown assign)
    public function get_kurir_aktif()
    {
        return $this->db->where('status', 'Active')
            ->where('deleted_at', null)
            ->order_by('nama_kurir', 'ASC')
            ->get($this->table)
            ->result_array();
    }

    // M08-F06: Daftar pengiriman yang belum ada kurirnya
    // (versi Admin — bisa lihat & assign semua transaksi)
    public function get_pengiriman_belum_assign()
    {
        $this->db->select('
                tb_tracking.id_tracking,
                tb_tracking.id_transaksi,
                tb_tracking.id_kurir,
                tb_tracking.status_pengiriman,
                tb_tracking.estimasi_tiba,
                tb_tracking.created_at,
                tb_transaksi.invoice,
                tb_transaksi.total_harga,
                tb_user.nama AS nama_pembeli
            ')
            ->from('tb_tracking')
            ->join('tb_transaksi', 'tb_transaksi.id_tracking = tb_tracking.id_tracking', 'left')
            ->join('tb_user', 'tb_user.id_user = tb_transaksi.id_user', 'left')
            ->where('tb_tracking.id_kurir IS NULL', null, false)
            ->where_not_in('tb_tracking.status_pengiriman', ['delivered', 'diterima', 'dibatalkan'])
            ->order_by('tb_tracking.created_at', 'ASC');

        return $this->db->get()->result_array();
    }

    // M08-F06: Daftar pengiriman yang belum ada kurirnya
    // (versi Petani — HANYA transaksi miliknya sendiri, filter pakai id_user)
    public function get_pengiriman_belum_assign_by_user($id_user)
    {
        $this->db->select('
                tb_tracking.id_tracking,
                tb_tracking.id_transaksi,
                tb_tracking.id_kurir,
                tb_tracking.status_pengiriman,
                tb_tracking.estimasi_tiba,
                tb_tracking.created_at,
                tb_transaksi.invoice,
                tb_transaksi.total_harga,
                tb_user.nama AS nama_pembeli
            ')
            ->from('tb_tracking')
            ->join('tb_transaksi', 'tb_transaksi.id_tracking = tb_tracking.id_tracking', 'left')
            ->join('tb_user', 'tb_user.id_user = tb_transaksi.id_user', 'left')
            ->where('tb_transaksi.id_user', $id_user)
            ->where('tb_tracking.id_kurir IS NULL', null, false)
            ->where_not_in('tb_tracking.status_pengiriman', ['delivered', 'diterima', 'dibatalkan'])
            ->order_by('tb_tracking.created_at', 'ASC');

        return $this->db->get()->result_array();
    }

    // M08-F08: Performance / laporan kinerja kurir
    // Menghitung: total pengiriman ditangani, jumlah selesai (delivered/diterima),
    // jumlah dibatalkan, dan rata-rata lama pengiriman (dari tanggal_kirim ke tanggal_terima)
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

            // Rata-rata lama pengiriman (jam) dari yang sudah selesai & punya kedua tanggal
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

    // M08-F06: Proses assign kurir ke 1 pengiriman + catat riwayat
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

        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}
