<?php
// Mencegah output karakter aneh di awal file
if (ob_get_level()) ob_end_clean();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Export Excel - <?= ucfirst($tab); ?></title>
    <style>
        table { border-collapse: collapse; width: 100%; font-family: sans-serif; font-size: 11pt; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #E6A15C; color: #fff; font-weight: bold; }
        .title { font-size: 14pt; font-weight: bold; text-align: center; margin-bottom: 15px; }
        .num { text-align: right; }
    </style>
</head>
<body>
    <div class="title">
        LAPORAN <?= strtoupper($tab); ?> - SISTEM SUPPLY CHAIN KOPI<br>
        <span style="font-size: 10pt; font-weight: normal;">Tanggal Export: <?= $tanggal; ?></span>
    </div>

    <table>
        <?php if ($tab == 'petani'): ?>
            <thead><tr><th>No</th><th>Nama Petani</th><th>Status</th><th>Lahan Aktif</th><th>Total Panen (Kg)</th><th>Estimasi Omset (Rp)</th><th>Tgl Daftar</th></tr></thead>
            <tbody>
                <?php foreach ($rows as $i => $r): ?>
                    <tr><td><?= $i+1; ?></td><td><?= $r['nama_petani']; ?></td><td><?= $r['status_petani']; ?></td><td class="num"><?= $r['lahan_aktif'] ?? 0; ?></td><td class="num"><?= $r['total_panen'] ?? 0; ?></td><td class="num"><?= $r['omset'] ?? 0; ?></td><td><?= $r['tanggal_daftar']; ?></td></tr>
                <?php endforeach; ?>
            </tbody>
        <?php elseif ($tab == 'produk'): ?>
            <thead><tr><th>No</th><th>Nama Produk</th><th>Jenis</th><th>Harga/Kg (Rp)</th><th>Stok (Kg)</th><th>Total Terjual (Kg)</th><th>Pendapatan (Rp)</th></tr></thead>
            <tbody>
                <?php foreach ($rows as $i => $r): ?>
                    <tr><td><?= $i+1; ?></td><td><?= $r['nama_produk']; ?></td><td><?= $r['jenis'] ?? '-'; ?></td><td class="num"><?= $r['harga'] ?? 0; ?></td><td class="num"><?= $r['stok_produk'] ?? 0; ?></td><td class="num"><?= $r['total_terjual'] ?? 0; ?></td><td class="num"><?= $r['pendapatan'] ?? 0; ?></td></tr>
                <?php endforeach; ?>
            </tbody>
        <?php elseif ($tab == 'keuangan'): ?>
            <thead><tr><th>No</th><th>Bulan</th><th>Pendapatan (Rp)</th><th>Estimasi Biaya (Rp)</th><th>Laba Bersih (Rp)</th></tr></thead>
            <tbody>
                <?php foreach ($rows['detail'] as $i => $r): ?>
                    <tr><td><?= $i+1; ?></td><td><?= $r['bulan']; ?></td><td class="num"><?= $r['pendapatan']; ?></td><td class="num"><?= $r['pengeluaran']; ?></td><td class="num"><?= $r['laba']; ?></td></tr>
                <?php endforeach; ?>
                <tr><th colspan="2" style="text-align:right;">TOTAL</th><th class="num"><?= $rows['pendapatan_kotor']; ?></th><th class="num"><?= $rows['estimasi_biaya']; ?></th><th class="num"><?= $rows['laba_bersih']; ?></th></tr>
            </tbody>
        <?php elseif ($tab == 'panen'): ?>
            <thead><tr><th>No</th><th>Nama Petani</th><th>Lahan</th><th>Jenis Kopi</th><th>Jml Panen (Kg)</th><th>Kualitas</th><th>Tgl Panen</th></tr></thead>
            <tbody>
                <?php foreach ($rows as $i => $r): ?>
                    <tr><td><?= $i+1; ?></td><td><?= $r['nama_petani']; ?></td><td><?= $r['lahan'] ?? '-'; ?></td><td><?= $r['jenis_kopi'] ?? '-'; ?></td><td class="num"><?= $r['jumlah_panen']; ?></td><td><?= $r['kualitas'] ?? '-'; ?></td><td><?= $r['tanggal_panen'] ?? '-'; ?></td></tr>
                <?php endforeach; ?>
            </tbody>
        <?php elseif ($tab == 'mitra'): ?>
            <thead><tr><th>No</th><th>Nama Mitra</th><th>Status</th><th>Total Order</th><th>Total Pembelian (Rp)</th><th>Produk Favorit</th><th>Rating</th></tr></thead>
            <tbody>
                <?php foreach ($rows as $i => $r): ?>
                    <tr><td><?= $i+1; ?></td><td><?= $r['nama_mitra']; ?></td><td><?= $r['status_mitra']; ?></td><td class="num"><?= $r['total_order'] ?? 0; ?></td><td class="num"><?= $r['total_pembelian'] ?? 0; ?></td><td><?= $r['produk_favorit'] ?? '-'; ?></td><td class="num"><?= $r['rating'] ?? 0; ?>/5</td></tr>
                <?php endforeach; ?>
            </tbody>
        <?php else: // Penjualan (default) ?>
            <thead><tr><th>No</th><th>ID Transaksi</th><th>Pembeli/Mitra</th><th>Produk</th><th>Jml (Kg)</th><th>Total Harga (Rp)</th><th>Status</th><th>Metode Bayar</th><th>Tanggal</th></tr></thead>
            <tbody>
                <?php foreach ($rows as $i => $r): ?>
                    <tr><td><?= $i+1; ?></td><td><?= $r['id_transaksi'] ?? ('TRX-'.($i+1)); ?></td><td><?= $r['nama_pembeli'] ?? '-'; ?></td><td><?= $r['nama_produk'] ?? '-'; ?></td><td class="num"><?= $r['jumlah_kg'] ?? 0; ?></td><td class="num"><?= $r['total_harga'] ?? 0; ?></td><td><?= $r['status_pesanan']; ?></td><td><?= $r['metode_bayar']; ?></td><td><?= $r['tanggal'] ?? '-'; ?></td></tr>
                <?php endforeach; ?>
            </tbody>
        <?php endif; ?>
    </table>
</body>
</html>
