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
        }

        /* Header Laporan (pakai table, bukan flex, agar aman di Dompdf) */
        .report-header-table {
            width: 100%;
            border-bottom: 3px solid #6d4c41;
            padding-bottom: 16px;
            margin-bottom: 24px;
        }
        .report-header-table td { vertical-align: middle; }
        .logo-side h2 {
            font-size: 1.4rem;
            color: #6d4c41;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .logo-side p {
            font-size: 0.75rem;
            color: #888;
            margin-top: 2px;
        }
        .meta-side {
            text-align: right;
            font-size: 0.75rem;
            color: #888;
        }
        .meta-side strong {
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

        /* Tabel Data */
        table.data-table {
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
        .badge-inactive   { background: #FFF8E1; color: #FFC107; }
        .badge-suspended { background: #FFEBEE; color: #F44336; }
        .badge-other     { background: #eeeeee; color: #555; }

        /* Footer */
        .report-footer-table {
            width: 100%;
            margin-top: 32px;
            font-size: 0.75rem;
            color: #aaa;
            border-top: 1px solid #eee;
            padding-top: 12px;
        }
        .report-footer-table td.right { text-align: right; }
    </style>
</head>
<body>

<!-- Header Laporan -->
<table class="report-header-table">
    <tr>
        <td class="logo-side" style="width: 50%;">
            <h2>POKTAN KOPI</h2>
            <p>Sistem Supply Chain Kopi | liberchain</p>
        </td>
        <td class="meta-side">
            <strong>Laporan Data Petani</strong>
            Tanggal Cetak: <?= date('d F Y, H:i'); ?> WIB
        </td>
    </tr>
</table>

<!-- Judul -->
<div class="report-title">
    <h3>Daftar Data Petani</h3>
    <p>Total <?= count($daftar_petani); ?> petani terdaftar dalam sistem</p>
</div>

<!-- Tabel Data -->
<table class="data-table">
    <thead>
        <tr>
            <th style="width: 30px;">No</th>
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
                    // Hanya 3 status resmi sesuai modul: Active / Inactive / Suspended
                    // Semua field di-fallback dulu (?? '') supaya aman kalau data null/kosong,
                    // biar tidak muncul PHP warning yang bisa merusak HTML sebelum di-render Dompdf.
                    $status_petani = $p['status_petani'] ?? '';
                    $stat = strtolower($status_petani);
                    if ($stat == 'active') $badge = 'badge-active';
                    elseif ($stat == 'suspended') $badge = 'badge-suspended';
                    elseif ($stat == 'inactive') $badge = 'badge-inactive';
                    else $badge = 'badge-other';

                    $nama_petani    = $p['nama_petani'] ?? '-';
                    $nik            = $p['nik'] ?? '';
                    $no_hp          = $p['no_hp'] ?? '';
                    $email          = $p['email'] ?? '';
                    $alamat         = $p['alamat'] ?? '';
                    $tanggal_raw    = $p['tanggal_daftar'] ?? '';
                    $tanggal_ts     = !empty($tanggal_raw) ? strtotime($tanggal_raw) : false;
                    $tanggal_daftar = $tanggal_ts ? date('d/m/Y', $tanggal_ts) : '-';
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><strong><?= htmlspecialchars($nama_petani); ?></strong></td>
                    <td><?= htmlspecialchars($nik ?: '-'); ?></td>
                    <td><?= htmlspecialchars($no_hp ?: '-'); ?></td>
                    <td><?= htmlspecialchars($email ?: '-'); ?></td>
                    <td><?= htmlspecialchars($alamat ?: '-'); ?></td>
                    <td style="text-align: center;">
                        <span class="badge-status <?= $badge; ?>"><?= htmlspecialchars($status_petani ?: '-'); ?></span>
                    </td>
                    <td><?= $tanggal_daftar; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="8" style="text-align: center; padding: 20px; color: #aaa;">Belum ada data petani.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Footer -->
<table class="report-footer-table">
    <tr>
        <td>Dicetak oleh: Admin Sistem Supply Chain Kopi</td>
        <td class="right">Halaman 1 dari 1</td>
    </tr>
</table>

<script>
    window.onload = function() {
        window.print();
    };
</script>
</body>
</html>
