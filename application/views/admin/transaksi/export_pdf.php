<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: Arial, sans-serif; 
            font-size: 11px; 
            padding: 20px; 
            background: #fff;
        }
        .header { 
            text-align: center; 
            border-bottom: 3px solid #4A2C11; 
            padding-bottom: 15px; 
            margin-bottom: 25px; 
        }
        .header h1 { 
            margin: 0; 
            color: #4A2C11; 
            font-size: 22px; 
            font-weight: 700;
        }
        .header p { 
            margin: 5px 0 0; 
            color: #70655E; 
            font-size: 12px; 
        }
        .header .date {
            font-size: 11px;
            color: #A8988A;
            margin-top: 3px;
        }
        .table { 
            width: 100%; 
            border-collapse: collapse; 
            margin: 15px 0; 
        }
        .table th { 
            background: #4A2C11; 
            color: white; 
            padding: 8px 10px; 
            text-align: left; 
            font-size: 9px; 
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .table td { 
            padding: 6px 10px; 
            border-bottom: 1px solid #e5e7eb; 
            font-size: 10px;
        }
        .table tr:nth-child(even) { 
            background: #FAF6F0; 
        }
        .text-right { 
            text-align: right; 
        }
        .text-center { 
            text-align: center; 
        }
        .footer { 
            text-align: center; 
            margin-top: 25px; 
            border-top: 1px solid #e5e7eb; 
            padding-top: 15px; 
            font-size: 9px; 
            color: #70655E; 
        }
        .total-row { 
            font-weight: bold; 
            background: #FDF5ED !important; 
        }
        .total-row td { 
            border-top: 2px solid #4A2C11; 
            padding: 8px 10px;
        }
        .badge { 
            display: inline-block;
            padding: 2px 10px;
            border-radius: 12px;
            font-size: 8px;
            font-weight: bold;
        }
        .badge-success { background: #D1FAE5; color: #065F46; }
        .badge-warning { background: #FEF3C7; color: #92400E; }
        .badge-danger { background: #FEE2E2; color: #991B1B; }
        .badge-info { background: #DBEAFE; color: #1E40AF; }
        .badge-secondary { background: #E5E7EB; color: #4B5563; }
        .info-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 10px;
            color: #70655E;
        }
        @media print {
            .no-print { display: none; }
            body { padding: 10px; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📋 LAPORAN TRANSAKSI</h1>
        <p>Supply Chain Kopi - Liberchain</p>
        <div class="date">Periode: <?= date('d F Y'); ?></div>
    </div>
    
    <div class="info-bar">
        <span><strong>Total Transaksi:</strong> <?= count($transaksi); ?> transaksi</span>
        <span><strong>Dicetak:</strong> <?= date('d/m/Y H:i:s'); ?></span>
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th style="width:8%;">ID</th>
                <th style="width:15%;">Pembeli</th>
                <th style="width:15%;" class="text-right">Total</th>
                <th style="width:15%;">Status Pesanan</th>
                <th style="width:13%;">Status Bayar</th>
                <th style="width:14%;">Metode</th>
                <th style="width:20%;">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($transaksi)): ?>
                <?php foreach ($transaksi as $t): ?>
                <tr>
                    <td>#<?= $t['id_transaksi']; ?></td>
                    <td><?= $t['nama_pembeli'] ?? 'Guest'; ?></td>
                    <td class="text-right">Rp <?= number_format($t['grand_total'], 0, ',', '.'); ?></td>
                    <td>
                        <?php
                        $badge = 'secondary';
                        if ($t['status_pesanan'] == 'Selesai') $badge = 'success';
                        elseif ($t['status_pesanan'] == 'Pending') $badge = 'warning';
                        elseif ($t['status_pesanan'] == 'Dibatalkan') $badge = 'danger';
                        elseif ($t['status_pesanan'] == 'Dikirim') $badge = 'info';
                        ?>
                        <span class="badge badge-<?= $badge; ?>"><?= $t['status_pesanan']; ?></span>
                    </td>
                    <td>
                        <?php
                        $badge = $t['status_bayar'] == 'Lunas' ? 'success' : 'warning';
                        ?>
                        <span class="badge badge-<?= $badge; ?>"><?= $t['status_bayar']; ?></span>
                    </td>
                    <td><?= $t['metode_bayar']; ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($t['tanggal_transaksi'])); ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center" style="padding: 30px;">Belum ada data transaksi</td>
                </tr>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="6" class="text-right">TOTAL TRANSAKSI</td>
                <td class="text-right"><?= count($transaksi); ?> transaksi</td>
            </tr>
        </tfoot>
    </table>
    
    <div class="footer">
        <p>&copy; <?= date('Y'); ?> Liberchain - Supply Chain Kopi. All Rights Reserved.</p>
        <p>Laporan ini dibuat secara otomatis oleh sistem.</p>
    </div>
    
    <!-- Tombol Print (hanya muncul di browser, tidak di PDF) -->
    <div class="text-center no-print" style="margin-top:20px;">
        <button onclick="window.print()" style="padding:10px 30px; background:#4A2C11; color:white; border:none; border-radius:8px; cursor:pointer; font-weight:bold;">
            🖨️ Cetak / Save as PDF
        </button>
        <a href="<?= base_url('admin/transaksi'); ?>" style="padding:10px 30px; background:#6c757d; color:white; border:none; border-radius:8px; cursor:pointer; font-weight:bold; text-decoration:none; margin-left:10px;">
            Kembali
        </a>
    </div>
</body>
</html>