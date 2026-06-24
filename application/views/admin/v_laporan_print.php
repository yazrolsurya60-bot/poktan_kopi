<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan - <?= ucfirst($tab); ?></title>
    <style>
        @page { size: A4 portrait; margin: 15mm 15mm 15mm 15mm; }
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 10pt; color: #333; margin: 0; padding: 0; background: #fff; }
        .kop-surat { display: flex; align-items: center; border-bottom: 3px solid #2C1808; padding-bottom: 15px; margin-bottom: 20px; }
        .kop-logo { width: 60px; height: 60px; background: #E6A15C; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 30px; font-weight: bold; margin-right: 15px; }
        .kop-text h1 { margin: 0 0 5px 0; font-size: 18pt; color: #2C1808; text-transform: uppercase; }
        .kop-text p { margin: 0; font-size: 10pt; color: #555; }
        .doc-title { text-align: center; margin-bottom: 20px; }
        .doc-title h2 { margin: 0 0 5px 0; font-size: 14pt; color: #2C1808; text-decoration: underline; text-transform: uppercase; }
        .doc-title p { margin: 0; font-size: 9pt; color: #666; }
        .info-grid { display: flex; flex-wrap: wrap; margin-bottom: 20px; font-size: 9pt; }
        .info-item { width: 50%; margin-bottom: 5px; }
        .info-label { font-weight: bold; width: 120px; display: inline-block; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; font-size: 9pt; }
        th, td { border: 1px solid #ddd; padding: 8px 10px; text-align: left; }
        th { background-color: #FAF6F0; color: #4A2C11; font-weight: bold; text-transform: uppercase; font-size: 8pt; letter-spacing: 0.5px; border-bottom: 2px solid #E6A15C; }
        tr:nth-child(even) { background-color: #fcfcfc; }
        .num { text-align: right; }
        .ttd-section { margin-top: 50px; float: right; width: 250px; text-align: center; font-size: 10pt; }
        .ttd-name { margin-top: 70px; font-weight: bold; text-decoration: underline; }
        .status-badge { padding: 3px 8px; border-radius: 12px; font-size: 8pt; font-weight: bold; }
        .bg-green { background: #D1FAE5; color: #065F46; }
        .bg-yellow { background: #FEF3C7; color: #92400E; }
        .bg-red { background: #FEE2E2; color: #991B1B; }
        .bg-blue { background: #DBEAFE; color: #1E40AF; }
        .bg-gray { background: #F3F4F6; color: #4B5563; }
        .kpi-cards { display: flex; gap: 10px; margin-bottom: 20px; }
        .kpi-card { flex: 1; border: 1px solid #ddd; border-radius: 5px; padding: 10px; text-align: center; }
        .kpi-label { font-size: 8pt; color: #666; text-transform: uppercase; }
        .kpi-val { font-size: 12pt; font-weight: bold; color: #2C1808; margin-top: 5px; }
        @media print { body { -webkit-print-color-adjust: exact; print-color-adjust: exact; } button { display: none; } }
    </style>
</head>
<body onload="window.print()">

    <div class="kop-surat">
        <div class="kop-logo">P</div>
        <div class="kop-text">
            <h1>Poktan Liberchain</h1>
            <p>Sistem Manajemen Supply Chain Kopi Terpadu</p>
            <p>Jl. Perkebunan Kopi No. 123, Kabupaten Kopi, Indonesia</p>
        </div>
    </div>

    <div class="doc-title">
        <h2>Laporan Data <?= ucfirst($tab); ?></h2>
        <p>Dokumen ini dicetak otomatis dari sistem</p>
    </div>

    <div class="info-grid">
        <div class="info-item"><span class="info-label">Dicetak Pada</span>: <?= $tanggal; ?></div>
        <div class="info-item"><span class="info-label">Dicetak Oleh</span>: <?= $admin; ?></div>
        <div class="info-item"><span class="info-label">Jenis Data</span>: <?= strtoupper($tab); ?></div>
        <div class="info-item"><span class="info-label">Status</span>: Dokumen Resmi</div>
    </div>

    <?php if ($tab == 'penjualan' || $tab == 'keuangan'): ?>
    <div class="kpi-cards">
        <div class="kpi-card"><div class="kpi-label">Total Pendapatan</div><div class="kpi-val">Rp <?= number_format($kpi['total_pendapatan'] ?? 0, 0, ',', '.'); ?></div></div>
        <div class="kpi-card"><div class="kpi-label">Volume Penjualan</div><div class="kpi-val"><?= number_format($kpi['volume_penjualan'] ?? 0, 0, ',', '.'); ?> Kg</div></div>
        <div class="kpi-card"><div class="kpi-label">Total Transaksi</div><div class="kpi-val"><?= number_format($kpi['total_transaksi'] ?? 0, 0, ',', '.'); ?></div></div>
    </div>
    <?php endif; ?>

    <table>
        <?php if ($tab == 'petani'): ?>
            <thead><tr><th>No</th><th>Nama Petani</th><th>Status</th><th>Lahan Aktif</th><th>Total Panen</th><th>Estimasi Omset</th><th>Tanggal Daftar</th></tr></thead>
            <tbody>
                <?php foreach ($rows as $i => $r): ?>
                    <tr><td><?= $i+1; ?></td><td><b><?= htmlspecialchars($r['nama_petani']); ?></b></td><td><span class="status-badge <?= strtolower($r['status_petani']) == 'active' ? 'bg-green' : 'bg-yellow'; ?>"><?= htmlspecialchars($r['status_petani']); ?></span></td><td class="num"><?= $r['lahan_aktif'] ?? 0; ?></td><td class="num"><?= number_format($r['total_panen'] ?? 0, 0, ',', '.'); ?> Kg</td><td class="num">Rp <?= number_format($r['omset'] ?? 0, 0, ',', '.'); ?></td><td><?= $r['tanggal_daftar']; ?></td></tr>
                <?php endforeach; ?>
            </tbody>
        <?php elseif ($tab == 'produk'): ?>
            <thead><tr><th>No</th><th>Nama Produk</th><th>Jenis</th><th>Harga/Kg</th><th>Stok</th><th>Total Terjual</th><th>Pendapatan</th></tr></thead>
            <tbody>
                <?php foreach ($rows as $i => $r): ?>
                    <tr><td><?= $i+1; ?></td><td><b><?= htmlspecialchars($r['nama_produk']); ?></b></td><td><?= htmlspecialchars($r['jenis'] ?? '-'); ?></td><td class="num">Rp <?= number_format($r['harga'] ?? 0, 0, ',', '.'); ?></td><td class="num"><?= number_format($r['stok_produk'] ?? 0, 0, ',', '.'); ?> Kg</td><td class="num"><?= number_format($r['total_terjual'] ?? 0, 0, ',', '.'); ?> Kg</td><td class="num">Rp <?= number_format($r['pendapatan'] ?? 0, 0, ',', '.'); ?></td></tr>
                <?php endforeach; ?>
            </tbody>
        <?php elseif ($tab == 'keuangan'): ?>
            <thead><tr><th>No</th><th>Bulan</th><th>Pendapatan</th><th>Estimasi Biaya</th><th>Laba Bersih</th><th>Margin (%)</th></tr></thead>
            <tbody>
                <?php foreach ($rows as $i => $r): ?>
                    <?php $margin = $r['pendapatan'] > 0 ? round(($r['laba'] / $r['pendapatan']) * 100, 1) : 0; ?>
                    <tr><td><?= $i+1; ?></td><td><b><?= $r['bulan']; ?></b></td><td class="num">Rp <?= number_format($r['pendapatan'], 0, ',', '.'); ?></td><td class="num">Rp <?= number_format($r['pengeluaran'], 0, ',', '.'); ?></td><td class="num" style="color:#065F46; font-weight:bold;">Rp <?= number_format($r['laba'], 0, ',', '.'); ?></td><td class="num"><?= $margin; ?>%</td></tr>
                <?php endforeach; ?>
                <tr><th colspan="2" style="text-align:right;">TOTAL KESELURUHAN</th><th class="num">Rp <?= number_format($summary['pendapatan_kotor'], 0, ',', '.'); ?></th><th class="num">Rp <?= number_format($summary['estimasi_biaya'], 0, ',', '.'); ?></th><th class="num" style="color:#065F46;">Rp <?= number_format($summary['laba_bersih'], 0, ',', '.'); ?></th><th>-</th></tr>
            </tbody>
        <?php elseif ($tab == 'panen'): ?>
            <thead><tr><th>No</th><th>Nama Petani</th><th>Lahan</th><th>Jenis Kopi</th><th>Jml Panen</th><th>Kualitas</th><th>Tanggal Panen</th></tr></thead>
            <tbody>
                <?php foreach ($rows as $i => $r): ?>
                    <tr><td><?= $i+1; ?></td><td><b><?= htmlspecialchars($r['nama_petani']); ?></b></td><td><?= htmlspecialchars($r['lahan'] ?? '-'); ?></td><td><?= htmlspecialchars($r['jenis_kopi'] ?? '-'); ?></td><td class="num"><?= number_format($r['jumlah_panen'], 0, ',', '.'); ?> Kg</td><td><span class="status-badge <?= ($r['kualitas'] ?? '') == 'Grade A' ? 'bg-green' : 'bg-blue'; ?>"><?= htmlspecialchars($r['kualitas'] ?? '-'); ?></span></td><td><?= $r['tanggal_panen'] ?? '-'; ?></td></tr>
                <?php endforeach; ?>
            </tbody>
        <?php elseif ($tab == 'mitra'): ?>
            <thead><tr><th>No</th><th>Nama Mitra</th><th>Status</th><th>Total Order</th><th>Total Pembelian</th><th>Produk Favorit</th><th>Rating</th></tr></thead>
            <tbody>
                <?php foreach ($rows as $i => $r): ?>
                    <tr><td><?= $i+1; ?></td><td><b><?= htmlspecialchars($r['nama_mitra']); ?></b></td><td><span class="status-badge <?= strtolower($r['status_mitra']) == 'active' ? 'bg-green' : 'bg-gray'; ?>"><?= htmlspecialchars($r['status_mitra']); ?></span></td><td class="num"><?= $r['total_order'] ?? 0; ?></td><td class="num">Rp <?= number_format($r['total_pembelian'] ?? 0, 0, ',', '.'); ?></td><td><?= htmlspecialchars($r['produk_favorit'] ?? '-'); ?></td><td class="num"><?= $r['rating'] ?? 0; ?> / 5</td></tr>
                <?php endforeach; ?>
            </tbody>
        <?php else: // Penjualan ?>
            <thead><tr><th>No</th><th>ID Transaksi</th><th>Pembeli/Mitra</th><th>Produk</th><th>Jml</th><th>Total Harga</th><th>Status</th><th>Metode Bayar</th><th>Tanggal</th></tr></thead>
            <tbody>
                <?php if (empty($rows)): ?><tr><td colspan="9" style="text-align:center;">Data kosong</td></tr><?php endif; ?>
                <?php foreach ($rows as $i => $r): ?>
                    <?php 
                        $s_raw = strtolower($r['status_pesanan'] ?? '');
                        $bg = 'bg-yellow';
                        if ($s_raw == 'selesai' || $s_raw == 'dikirim') $bg = 'bg-green';
                        if ($s_raw == 'dibatalkan') $bg = 'bg-red';
                        if ($s_raw == 'diproses') $bg = 'bg-blue';
                    ?>
                    <tr><td><?= $i+1; ?></td><td><b><?= htmlspecialchars($r['id_transaksi'] ?? ('TRX-'.($i+1))); ?></b></td><td><?= htmlspecialchars($r['nama_pembeli'] ?? '-'); ?></td><td><?= htmlspecialchars($r['nama_produk'] ?? '-'); ?></td><td class="num"><?= number_format($r['jumlah_kg'] ?? 0, 0, ',', '.'); ?> Kg</td><td class="num">Rp <?= number_format($r['total_harga'] ?? 0, 0, ',', '.'); ?></td><td><span class="status-badge <?= $bg; ?>"><?= htmlspecialchars($r['status_pesanan']); ?></span></td><td><?= htmlspecialchars($r['metode_bayar']); ?></td><td><?= isset($r['tanggal']) ? date('d/m/Y', strtotime($r['tanggal'])) : '-'; ?></td></tr>
                <?php endforeach; ?>
            </tbody>
        <?php endif; ?>
    </table>

    <div class="ttd-section">
        Mengetahui,<br>Admin Sistem Poktan Liberchain
        <div class="ttd-name"><?= $admin; ?></div>
    </div>

    <div style="clear:both;"></div>
    
    <div style="text-align:center; margin-top:50px;">
        <button onclick="window.print()" style="padding:10px 20px; background:#4A2C11; color:white; border:none; border-radius:5px; cursor:pointer; font-weight:bold; font-family:'Plus Jakarta Sans',sans-serif;">
            <svg style="width:16px; height:16px; margin-bottom:-3px; margin-right:5px;" fill="currentColor" viewBox="0 0 16 16"><path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/><path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/></svg> Cetak Dokumen
        </button>
    </div>

</body>
</html>
