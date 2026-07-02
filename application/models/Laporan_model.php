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
    public function get_kpi_laporan($poktan = 0) {
        // Base Query Transaksi
        $this->db->select_sum('t.total_harga')
                 ->from('tb_transaksi t')
                 ->where('t.status_pesanan', 'Selesai');
        if ($poktan > 0) {
            $this->db->join('tb_petani_wilayah pw', 'pw.id_petani = t.id_petani', 'inner')
                     ->where('pw.id_wilayah', $poktan);
        }
        $total_pendapatan = $this->db->get()->row()->total_harga ?? 0;

        // Base Query Total Transaksi
        $this->db->from('tb_transaksi t');
        if ($poktan > 0) {
            $this->db->join('tb_petani_wilayah pw', 'pw.id_petani = t.id_petani', 'inner')
                     ->where('pw.id_wilayah', $poktan);
        }
        $total_transaksi = $this->db->count_all_results();

        // Volume Penjualan (Riil dari tb_detail_transaksi)
        $this->db->select_sum('dt.jumlah')
                 ->from('tb_detail_transaksi dt')
                 ->join('tb_transaksi t', 't.id_transaksi = dt.id_transaksi', 'inner')
                 ->where('t.status_pesanan', 'Selesai');
        if ($poktan > 0) {
            $this->db->join('tb_petani_wilayah pw', 'pw.id_petani = t.id_petani', 'inner')
                     ->where('pw.id_wilayah', $poktan);
        }
        $volume_penjualan = $this->db->get()->row()->jumlah ?? 0;

        // Total Petani
        $this->db->from('tb_petani p')->where('p.status_petani', 'Active');
        if ($poktan > 0) {
            $this->db->join('tb_petani_wilayah pw', 'pw.id_petani = p.id_petani', 'inner')
                     ->where('pw.id_wilayah', $poktan);
        }
        $total_petani = $this->db->count_all_results();

        $total_mitra = $this->db->where('status_mitra', 'Active')->count_all_results('tb_mitra');

        $laba_bersih      = $total_pendapatan > 0 ? (int)($total_pendapatan * 0.30) : 0;
        $rata_transaksi   = $total_transaksi > 0 ? (int)($total_pendapatan / $total_transaksi) : 0;

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
    public function get_laporan_penjualan($filter = [], $poktan = 0) {
        // Ambil data transaksi riil + nama pembeli dari tb_user
        $this->db->select('t.*, COALESCE(u.nama, t.nama_penerima, t.email_pembeli, "Umum") as nama_pembeli')
            ->from('tb_transaksi t')
            ->join('tb_user u', 'u.id_user = t.id_user', 'left');
            
        if ($poktan > 0) {
            $this->db->join('tb_petani_wilayah pw', 'pw.id_petani = t.id_petani', 'inner')
                     ->where('pw.id_wilayah', $poktan);
        }
        
        $this->db->order_by('t.id_transaksi', 'DESC');

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
    public function get_laporan_petani($poktan = 0) {
        // Ambil petani yang tidak di-delete
        $this->db->select('p.*')->from('tb_petani p')->where('p.is_deleted', 0);
        
        if ($poktan > 0) {
            $this->db->join('tb_petani_wilayah pw', 'pw.id_petani = p.id_petani', 'inner')
                     ->where('pw.id_wilayah', $poktan);
        }
        
        $petani = $this->db->get()->result_array();
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
    public function get_laporan_produk($poktan = 0) {
        $this->db->select('pr.*')->from('tb_produk pr')->where('pr.status_produk', 'Aktif');
        
        if ($poktan > 0) {
            $this->db->join('tb_petani p', 'p.id_petani = pr.id_user', 'inner')
                     ->join('tb_petani_wilayah pw', 'pw.id_petani = p.id_petani', 'inner')
                     ->where('pw.id_wilayah', $poktan);
        }
        
        $produk = $this->db->get()->result_array();
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
    public function get_laporan_keuangan($poktan = 0) {
        $kpi = $this->get_kpi_laporan($poktan);
        $pendapatan_kotor = $kpi['total_pendapatan'];
        $estimasi_biaya   = (int)($pendapatan_kotor * 0.70);
        $laba_bersih      = $pendapatan_kotor - $estimasi_biaya;

        // Ambil data bulanan riil dari tb_transaksi
        $bulan_id = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',
                     7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];

        $this->db->select('MONTH(t.tanggal_transaksi) as bln, SUM(t.total_harga) as pendapatan, COUNT(*) as jml')
            ->from('tb_transaksi t');
            
        if ($poktan > 0) {
            $this->db->join('tb_petani_wilayah pw', 'pw.id_petani = t.id_petani', 'inner')
                     ->where('pw.id_wilayah', $poktan);
        }
            
        $rows = $this->db->group_by('MONTH(t.tanggal_transaksi)')
            ->order_by('MONTH(t.tanggal_transaksi)', 'ASC')
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
    public function get_laporan_panen($poktan = 0) {
        $this->db->select('p.*, pt.nama_petani')
            ->from('tb_panen p')
            ->join('tb_petani pt', 'pt.id_petani = p.id_user', 'left');
            
        if ($poktan > 0) {
            $this->db->join('tb_petani_wilayah pw', 'pw.id_petani = p.id_user', 'inner')
                     ->where('pw.id_wilayah', $poktan);
        }
            
        $panen = $this->db->order_by('p.tanggal_panen', 'DESC')->get()->result_array();

        if (empty($panen)) return [];

        foreach ($panen as &$pn) {
            if (empty($pn['jenis_kopi'])) $pn['jenis_kopi'] = 'Liberika';
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
            
        $total = count($transaksi);
        $status_count = ['Pending' => 0, 'Diproses' => 0, 'Dikirim' => 0, 'Selesai' => 0, 'Dibatalkan' => 0];
        
        if (!empty($transaksi)) {
            foreach ($transaksi as $t) {
                $s = $t['status_pesanan'];
                if (isset($status_count[$s])) $status_count[$s]++;
            }
        }
        return ['statistik' => $status_count, 'total' => $total, 'log' => $transaksi];
    }

    // ============================================
    // LAPORAN MITRA
    // ============================================
    public function get_laporan_mitra($poktan = 0) {
        // Data mitra belum direlasikan secara langsung per poktan
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



    // ============================================
    // DATA CHART
    // ============================================
    public function get_chart_penjualan_bulanan() {
        $bulan_id = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',
                     7=>'Jul',8=>'Ags',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des'];
                     
        // Ambil data 6 bulan terakhir dari tb_transaksi dengan volume riil dari detail
        $rows = $this->db->select('MONTH(t.tanggal_transaksi) as bln, SUM(t.total_harga) as pendapatan, SUM(dt.jumlah) as volume')
            ->from('tb_transaksi t')
            ->join('tb_detail_transaksi dt', 'dt.id_transaksi = t.id_transaksi', 'left')
            ->where('t.status_pesanan', 'Selesai')
            ->group_by('MONTH(t.tanggal_transaksi)')
            ->order_by('MONTH(t.tanggal_transaksi)', 'ASC')
            ->limit(12)
            ->get()->result_array();
            
        $labels = [];
        $pendapatan = [];
        $volume = [];
        
        if (empty($rows)) {
            // Jika kosong, kembalikan chart kosong
            return ['labels' => ['Kosong'], 'pendapatan' => [0], 'volume' => [0]];
        }

        foreach ($rows as $r) {
            $labels[] = $bulan_id[(int)$r['bln']] ?? $r['bln'];
            $pendapatan[] = (int)$r['pendapatan'];
            $volume[] = (int)($r['volume'] ?? 0);
        }
        
        return [
            'labels'     => $labels,
            'pendapatan' => $pendapatan,
            'volume'     => $volume,
        ];
    }

    public function get_produk_terlaris($poktan = 0) {
        // Top 5 produk terlaris dari tb_detail_transaksi
        $this->db->select('p.nama_produk as nama, SUM(dt.jumlah) as total_terjual, SUM(dt.subtotal) as pendapatan')
            ->from('tb_detail_transaksi dt')
            ->join('tb_produk p', 'p.id_produk = dt.id_produk')
            ->join('tb_transaksi t', 't.id_transaksi = dt.id_transaksi')
            ->where('t.status_pesanan', 'Selesai');
            
        if ($poktan > 0) {
            $this->db->join('tb_petani_wilayah pw', 'pw.id_petani = t.id_petani', 'inner')
                     ->where('pw.id_wilayah', $poktan);
        }
            
        return $this->db->group_by('dt.id_produk')
            ->order_by('total_terjual', 'DESC')
            ->limit(5)
            ->get()->result_array();
    }

    public function get_chart_produk_terlaris($poktan = 0) {
        // Use existing get_produk_terlaris to fetch top products
        $produk = $this->get_produk_terlaris($poktan);
        if (empty($produk)) {
            return ['labels' => ['Tidak ada data'], 'data' => [0]];
        }
        $labels = [];
        $data = [];
        foreach ($produk as $p) {
            $labels[] = $p['nama'];
            $data[] = (int)$p['total_terjual'];
        }
        return ['labels' => $labels, 'data' => $data];
    }
    public function get_chart_status_transaksi() {
        $data = $this->get_laporan_tracking();
        $stat = $data['statistik'];
        return ['labels' => array_keys($stat), 'data' => array_values($stat)];
    }
}

