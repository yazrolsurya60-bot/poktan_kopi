<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Export Data Petani - Sistem Supply Chain Kopi</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #333;
            background: #fff;
            padding: 30px;
        }

        /* Header Laporan */
        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #6d4c41;
            padding-bottom: 16px;
            margin-bottom: 24px;
        }
        .report-header .logo-side h2 {
            font-size: 1.4rem;
            color: #6d4c41;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .report-header .logo-side p {
            font-size: 0.75rem;
            color: #888;
            margin-top: 2px;
        }
        .report-header .meta-side {
            text-align: right;
            font-size: 0.75rem;
            color: #888;
        }
        .report-header .meta-side strong {
            display: block;
            font-size: 1.1rem;
            color: #333;
            font-weight: bold;
        }

        /* Judul Laporan */
        .report-title {
            text-align: center;
            margin-bottom: 20px;
        }
        .report-title h3 {
            font-size: 1.1rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #333;
        }
        .report-title p {
            font-size: 0.75rem;
            color: #888;
            margin-top: 4px;
        }

        /* Tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }
        thead tr {
            background-color: #6d4c41;
            color: #fff;
        }
        thead th {
            padding: 10px 12px;
            text-align: left;
            font-weight: 600;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }
        tbody tr:nth-child(even) {
            background-color: #fdf8f5;
        }
        tbody tr:hover {
            background-color: #f5ebe3;
        }
        tbody td {
            padding: 9px 12px;
            border-bottom: 1px solid #eee;
            font-size: 0.82rem;
            vertical-align: middle;
        }

        /* Badge Status */
        .badge-status {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .badge-active    { background: #E8F5E9; color: #4CAF50; }
        .badge-inactive  { background: #FFF8E1; color: #FFC107; }
        .badge-pending   { background: #FFF8E1; color: #FFC107; }
        .badge-suspended { background: #FFEBEE; color: #F44336; }
        .badge-other     { background: #eeeeee; color: #555; }

        /* Footer */
        .report-footer {
            margin-top: 32px;
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            color: #aaa;
            border-top: 1px solid #eee;
            padding-top: 12px;
        }

        /* Tombol Cetak */
        .print-toolbar {
            position: fixed;
            top: 16px;
            right: 16px;
            display: flex;
            gap: 10px;
            z-index: 999;
        }
        .btn-print {
            background-color: #6d4c41;
            color: #fff;
            border: none;
            padding: 10px 22px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }
        .btn-print:hover { background-color: #5d3e37; }
        .btn-back {
            background-color: #fff;
            color: #555;
            border: 1px solid #ddd;
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 0.9rem;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* Sembunyikan toolbar saat print */
        @media print {
            .print-toolbar { display: none; }
            body { padding: 15px; }
        }
    </style>
</head>
<body>

<!-- Toolbar (tidak ikut tercetak) -->
<div class="print-toolbar">
    <a href="<?= base_url('admin/petani/export_page'); ?>" class="btn-back">&#8592; Kembali</a>
    <button class="btn-print" onclick="window.print()">&#128438; Cetak / Simpan PDF</button>
</div>

<!-- Header Laporan -->
<div class="report-header">
    <div class="logo-side">
        <h2>&#9749; POKTAN KOPI</h2>
        <p>Sistem Supply Chain Kopi | liberchain</p>
    </div>
    <div class="meta-side">
        <strong>Laporan Data Petani</strong>
        Tanggal Cetak: <?= date('d F Y, H:i'); ?> WIB
    </div>
</div>

<!-- Judul -->
<div class="report-title">
    <h3>Daftar Data Petani</h3>
    <p>Total <?= count($daftar_petani); ?> petani terdaftar dalam sistem</p>
</div>

<!-- Tabel Data -->
<table>
    <thead>
        <tr>
            <th style="width: 40px;">No</th>
            <th>Nama Petani</th>
            <th>NIK</th>
            <th>No HP</th>
            <th>Email</th>
            <th>Alamat</th>
            <th style="text-align: center;">Status</th>
            <th>Tgl Daftar</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($daftar_petani)): ?>
            <?php $no = 1; foreach ($daftar_petani as $p): ?>
                <?php
                    $stat = strtolower($p['status_petani']);
                    if ($stat == 'active' || $stat == 'terverifikasi') $badge = 'badge-active';
                    elseif ($stat == 'suspended' || $stat == 'ditolak') $badge = 'badge-suspended';
                    elseif ($stat == 'pending' || $stat == 'inactive') $badge = 'badge-pending';
                    else $badge = 'badge-other';
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><strong><?= htmlspecialchars($p['nama_petani']); ?></strong></td>
                    <td><?= htmlspecialchars($p['nik'] ?: '-'); ?></td>
                    <td><?= htmlspecialchars($p['no_hp'] ?: '-'); ?></td>
                    <td><?= htmlspecialchars($p['email'] ?: '-'); ?></td>
                    <td><?= htmlspecialchars($p['alamat'] ?: '-'); ?></td>
                    <td style="text-align: center;">
                        <span class="badge-status <?= $badge; ?>"><?= $p['status_petani']; ?></span>
                    </td>
                    <td><?= date('d/m/Y', strtotime($p['tanggal_daftar'])); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="8" style="text-align: center; padding: 20px; color: #aaa;">Belum ada data petani.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Footer -->
<div class="report-footer">
    <span>Dicetak oleh: Admin Sistem Supply Chain Kopi</span>
    <span>Halaman 1 dari 1</span>
</div>

</body>
</html>
