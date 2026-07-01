<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // ============================================
    // KPI UTAMA LAPORAN
    // ============================================
    public function get_kpi_laporan() {
        $total_pendapatan_row = $this->db->select_sum('total_harga')
            ->where('status_pesanan', 'Selesai')
            ->get('tb_transaksi')->row();
        $total_pendapatan = $total_pendapatan_row->total_harga ?? 0;

        $total_transaksi = $this->db->count_all_results('tb_transaksi');

        $total_petani = $this->db->where('status_petani', 'Active')
            ->count_all_results('tb_petani');

        $total_mitra = $this->db->where('status_mitra', 'Active')
            ->count_all_results('tb_mitra');

        if ($total_pendapatan == 0 && $total_transaksi > 0) {
            $sum_row = $this->db->select_sum('total_harga')->get('tb_transaksi')->row();
            $total_pendapatan = $sum_row->total_harga ?? 0;
        }

        $volume_penjualan = $total_transaksi > 0 ? ($total_transaksi * 150) : 0;
        $laba_bersih      = $total_pendapatan > 0 ? (int)($total_pendapatan * 0.30) : 0;
        $rata_transaksi   = $total_transaksi > 0 ? (int)($total_pendapatan / $total_transaksi) : 0;

        if ($total_pendapatan == 0) {
            $total_pendapatan = 40000000;
            $volume_penjualan = 450;
            $laba_bersih      = 12000000;
            $rata_transaksi   = 13333333;
        }

        return [
            'total_pendapatan' => $total_pendapatan,
            'total_transaksi'  => $total_transaksi,
            'volume_penjualan' => $volume_penjualan,
            'laba_bersih'      => $laba_bersih,
            'rata_transaksi'   => $rata_transaksi,
            'total_petani'     => $total_petani,
            'total_mitra'      => $total_mitra,
        ];
    }

    // ============================================
    // LAPORAN PENJUALAN
    // ============================================
    public function get_laporan_penjualan($filter = []) {
        // Ambil data transaksi riil + nama pembeli dari tb_user
        $this->db->select('t.*, COALESCE(u.nama, t.nama_penerima, t.email_pembeli, "Umum") as nama_pembeli')
            ->from('tb_transaksi t')
            ->join('tb_user u', 'u.id_user = t.id_user', 'left')
            ->order_by('t.id_transaksi', 'DESC');

        if (!empty($filter['status']) && $filter['status'] != 'semua') {
            $this->db->where('t.status_pesanan', $filter['status']);
        }

        $transaksi = $this->db->limit(100)->get()->result_array();

        if (empty($transaksi)) return [];

        // Enrich dengan nama produk dan jumlah dari tb_detail_transaksi
        foreach ($transaksi as &$t) {
            $detail = $this->db
                ->select('p.nama_produk, SUM(dt.jumlah) as jumlah_kg')
                ->from('tb_detail_transaksi dt')
                ->join('tb_produk p', 'p.id_produk = dt.id_produk', 'left')
                ->where('dt.id_transaksi', $t['id_transaksi'])
                ->get()->row();
            $t['nama_produk'] = $detail ? ($detail->nama_produk ?? 'Kopi') : 'Kopi';
            $t['jumlah_kg']   = $detail ? ($detail->jumlah_kg ?? 0) : 0;
            $t['tanggal']     = date('Y-m-d', strtotime($t['tanggal_transaksi']));
            $t['id_transaksi_label'] = $t['invoice'] ?? ('INV-' . str_pad($t['id_transaksi'], 6, '0', STR_PAD_LEFT));
        }
        return $transaksi;
    }

    // ============================================
    // LAPORAN PETANI
    // ============================================
    public function get_laporan_petani() {
        // Ambil petani yang tidak di-delete
        $petani = $this->db->where('is_deleted', 0)->get('tb_petani')->result_array();
        if (empty($petani)) return [];

        foreach ($petani as &$p) {
            // Total panen riil dari tb_panen
            $panen_row = $this->db->select_sum('jumlah_panen')
                ->where('id_user', $p['id_petani'])
                ->get('tb_panen')->row();
            $p['total_panen'] = (int)($panen_row->jumlah_panen ?? 0);

            // Omset dari transaksi yang melibatkan petani ini
            $omset_row = $this->db->select_sum('total_harga')
                ->where('id_petani', $p['id_petani'])
                ->get('tb_transaksi')->row();
            $p['omset'] = (int)($omset_row->total_harga ?? ($p['total_panen'] * 150000));

            // Jumlah lahan aktif
            $p['lahan_aktif'] = $this->db
                ->where('id_user', $p['id_petani'])
                ->where('status_lahan', 'Active')
                ->count_all_results('tb_lahan');
        }
        usort($petani, function($a, $b) { return $b['total_panen'] - $a['total_panen']; });
        return $petani;
    }

    // ============================================
    // LAPORAN PRODUK
    // ============================================
    public function get_laporan_produk() {
        $produk = $this->db
            ->where('status_produk', 'Aktif')
            ->get('tb_produk')->result_array();
        if (empty($produk)) return [];

        foreach ($produk as &$pr) {
            // Mapping field jenis dari jenis_kopi
            $pr['jenis']  = $pr['jenis_kopi'] ?? '-';
            $pr['status'] = ($pr['stok_produk'] ?? 0) > 0 ? 'Tersedia' : 'Habis';

            // Hitung total terjual & pendapatan dari tb_detail_transaksi
            $sales = $this->db
                ->select('SUM(dt.jumlah) as total_terjual, SUM(dt.subtotal) as pendapatan')
                ->from('tb_detail_transaksi dt')
                ->join('tb_transaksi t', 't.id_transaksi = dt.id_transaksi', 'left')
                ->where('dt.id_produk', $pr['id_produk'])
                ->get()->row();
            $pr['total_terjual'] = (int)($sales->total_terjual ?? 0);
            $pr['pendapatan']    = (float)($sales->pendapatan ?? 0);
        }
        return $produk;
    }

    // ============================================
    // LAPORAN KEUANGAN
    // ============================================
    public function get_laporan_keuangan() {
        $kpi = $this->get_kpi_laporan();
        $pendapatan_kotor = $kpi['total_pendapatan'];
        $estimasi_biaya   = (int)($pendapatan_kotor * 0.70);
        $laba_bersih      = $pendapatan_kotor - $estimasi_biaya;

        // Ambil data bulanan riil dari tb_transaksi
        $bulan_id = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',
                     7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];

        $rows = $this->db
            ->select('MONTH(tanggal_transaksi) as bln, SUM(total_harga) as pendapatan, COUNT(*) as jml')
            ->from('tb_transaksi')
            ->group_by('MONTH(tanggal_transaksi)')
            ->order_by('MONTH(tanggal_transaksi)', 'ASC')
            ->get()->result_array();

        $detail_keuangan = [];
        if (!empty($rows)) {
            foreach ($rows as $r) {
                $pend = (int)$r['pendapatan'];
                $peng = (int)($pend * 0.70);
                $detail_keuangan[] = [
                    'bulan'        => $bulan_id[(int)$r['bln']] ?? 'Bulan ' . $r['bln'],
                    'pendapatan'   => $pend,
                    'pengeluaran'  => $peng,
                    'laba'         => $pend - $peng,
                ];
            }
        } else {
            // Fallback jika belum ada transaksi sama sekali
            $detail_keuangan = [['bulan' => 'Juni', 'pendapatan' => 0, 'pengeluaran' => 0, 'laba' => 0]];
        }

        return [
            'pendapatan_kotor' => $pendapatan_kotor,
            'estimasi_biaya'   => $estimasi_biaya,
            'laba_bersih'      => $laba_bersih,
            'detail'           => $detail_keuangan,
        ];
    }

    // ============================================
    // LAPORAN PANEN
    // ============================================
    public function get_laporan_panen() {
        $panen = $this->db
            ->select('p.*, pt.nama_petani, l.nama_lahan as lahan, l.jenis_kopi as jenis_kopi_lahan')
            ->from('tb_panen p')
            ->join('tb_petani pt', 'pt.id_petani = p.id_user', 'left')
            ->join('tb_lahan l', 'l.id_lahan = p.id_lahan', 'left')
            ->order_by('p.tanggal_panen', 'DESC')
            ->get()->result_array();

        if (empty($panen)) return [];

        foreach ($panen as &$pn) {
            // Gunakan jenis_kopi dari tb_panen, atau fallback ke lahan
            if (empty($pn['jenis_kopi'])) $pn['jenis_kopi'] = $pn['jenis_kopi_lahan'] ?? 'Liberika';
            if (empty($pn['lahan']))      $pn['lahan'] = 'Kebun Kopi';
            if (empty($pn['kualitas']))   $pn['kualitas'] = 'Grade A';
        }
        return $panen;
    }

    // ============================================
    // LAPORAN TRACKING
    // ============================================
    public function get_laporan_tracking() {
        $transaksi = $this->db->select('id_transaksi, status_pesanan, metode_bayar, total_harga')
            ->get('tb_transaksi')->result_array();
        if (empty($transaksi)) {
            return $this->_get_dummy_tracking();
        }
        $total = count($transaksi);
        $status_count = ['Pending' => 0, 'Diproses' => 0, 'Dikirim' => 0, 'Selesai' => 0, 'Dibatalkan' => 0];
        foreach ($transaksi as $t) {
            $s = $t['status_pesanan'];
            if (isset($status_count[$s])) $status_count[$s]++;
        }
        return ['statistik' => $status_count, 'total' => $total, 'log' => $transaksi];
    }

    private function _get_dummy_tracking() {
        return [
            'statistik' => ['Pending' => 2, 'Diproses' => 5, 'Dikirim' => 8, 'Selesai' => 30, 'Dibatalkan' => 1],
            'total'     => 46,
            'log'       => [
                ['id_transaksi' => 'TRX-001', 'status_pesanan' => 'Selesai',  'kurir' => 'JNE',     'estimasi' => '2026-06-03', 'resi' => 'JNE123456'],
                ['id_transaksi' => 'TRX-002', 'status_pesanan' => 'Dikirim',  'kurir' => 'Sicepat', 'estimasi' => '2026-06-20', 'resi' => 'SCP789012'],
                ['id_transaksi' => 'TRX-003', 'status_pesanan' => 'Diproses', 'kurir' => '-',       'estimasi' => '-',          'resi' => '-'],
            ],
        ];
    }

    // ============================================
    // LAPORAN MITRA
    // ============================================
    public function get_laporan_mitra() {
        $mitra = $this->db->get('tb_mitra')->result_array();
        if (empty($mitra)) return [];

        foreach ($mitra as &$m) {
            // Hitung total order dari tb_transaksi yang dihubungkan ke mitra (via id_user mitra jika ada)
            // tb_mitra memiliki id_mitra — transaksi tidak langsung terhubung, jadi kita hitung dari tb_transaksi keseluruhan
            // Tampilkan data mitra riil apa adanya
            if (!isset($m['total_order']))     $m['total_order']     = 0;
            if (!isset($m['total_pembelian'])) $m['total_pembelian'] = 0;
            if (!isset($m['produk_favorit']))  $m['produk_favorit']  = '-';
            if (!isset($m['rating']))          $m['rating']          = '-';
        }
        return $mitra;
    }

    private function _get_dummy_mitra() {
        return [
            ['id_mitra' => 1, 'nama_mitra' => 'Cafe Merapi',         'status_mitra' => 'Active',   'total_order' => 48, 'total_pembelian' => 24000000, 'produk_favorit' => 'Liberika Grade A', 'rating' => 5],
            ['id_mitra' => 2, 'nama_mitra' => 'Toko Kopi Nusantara', 'status_mitra' => 'Active',   'total_order' => 35, 'total_pembelian' => 18500000, 'produk_favorit' => 'Arabika Grade A',  'rating' => 4],
            ['id_mitra' => 3, 'nama_mitra' => 'CV. Aroma Kopi',      'status_mitra' => 'Inactive', 'total_order' => 12, 'total_pembelian' => 7200000,  'produk_favorit' => 'Robusta Grade A',  'rating' => 3],
        ];
    }

    // ============================================
    // DATA CHART
    // ============================================
    public function get_chart_penjualan_bulanan() {
        return [
            'labels'     => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
            'pendapatan' => [12000000, 15000000, 18000000, 14000000, 20000000, 23000000, 21000000, 25000000, 27000000, 24000000, 30000000, 28000000],
            'volume'     => [80, 100, 120, 93, 133, 153, 140, 167, 180, 160, 200, 187],
        ];
    }

    public function get_chart_produk_terlaris() {
        return [
            'labels' => ['Liberika Grade A', 'Arabika Grade A', 'Robusta Grade A', 'Liberika Grade B', 'Arabika Specialty'],
            'data'   => [285, 220, 180, 95, 72],
        ];
    }

    public function get_chart_status_transaksi() {
        $data = $this->get_laporan_tracking();
        $stat = $data['statistik'];
        return ['labels' => array_keys($stat), 'data' => array_values($stat)];
    }
}
