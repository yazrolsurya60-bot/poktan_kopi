<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice #<?php echo $transaksi['id_transaksi']; ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Georgia', 'Times New Roman', serif;
            font-size: 12px;
            padding: 30px;
            background: #f5f0eb;
        }
        .invoice-wrapper {
            max-width: 820px;
            margin: 0 auto;
            background: #ffffff;
            padding: 40px 45px;
            border-radius: 16px;
            box-shadow: 0 12px 48px rgba(44, 24, 8, 0.12);
            border: 1px solid rgba(74, 44, 17, 0.06);
        }

        /* HEADER */
        .invoice-header {
            text-align: center;
            border-bottom: 3px solid #4A2C11;
            padding-bottom: 20px;
            margin-bottom: 28px;
            position: relative;
        }
        .invoice-header .brand-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #4A2C11, #E6A15C);
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            margin-bottom: 8px;
        }
        .invoice-header h1 {
            font-family: 'Georgia', serif;
            font-size: 30px;
            font-weight: 700;
            color: #4A2C11;
            letter-spacing: 1px;
            margin: 0;
        }
        .invoice-header .sub {
            color: #70655E;
            font-size: 13px;
            margin-top: 2px;
        }
        .invoice-header .invoice-number {
            font-size: 15px;
            font-weight: 700;
            color: #4A2C11;
            margin-top: 6px;
            letter-spacing: 0.5px;
        }
        .invoice-header .invoice-number span {
            background: #FAF6F0;
            padding: 4px 16px;
            border-radius: 20px;
            display: inline-block;
        }

        /* INFO GRID */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px 30px;
            margin-bottom: 24px;
            background: #FAF6F0;
            padding: 18px 22px;
            border-radius: 12px;
        }
        .info-grid .info-item {
            display: flex;
            flex-direction: column;
        }
        .info-grid .info-item .label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #70655E;
            font-weight: 600;
            margin-bottom: 2px;
        }
        .info-grid .info-item .value {
            font-size: 13px;
            font-weight: 600;
            color: #2C1808;
        }
        .info-grid .info-item .value .status-badge {
            display: inline-block;
            padding: 3px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
        }
        .status-badge.success { background: #D1FAE5; color: #065F46; }
        .status-badge.warning { background: #FEF3C7; color: #92400E; }
        .status-badge.danger { background: #FEE2E2; color: #991B1B; }
        .status-badge.info { background: #DBEAFE; color: #1E40AF; }

        /* ALAMAT */
        .alamat-box {
            background: #ffffff;
            border: 1px solid rgba(74, 44, 17, 0.06);
            border-radius: 10px;
            padding: 14px 18px;
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .alamat-box .label { font-size: 10px; text-transform: uppercase; color: #70655E; font-weight: 600; }
        .alamat-box .value { font-size: 13px; font-weight: 500; color: #2C1808; }

        /* TABLE */
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0 16px;
        }
        .product-table thead th {
            background: #4A2C11;
            color: #ffffff;
            padding: 10px 14px;
            text-align: left;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            font-weight: 600;
        }
        .product-table thead th.text-right { text-align: right; }
        .product-table thead th.text-center { text-align: center; }
        .product-table tbody td {
            padding: 10px 14px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 12px;
            color: #2C1808;
        }
        .product-table tbody tr:nth-child(even) { background: #FAF6F0; }
        .product-table tbody tr:hover { background: #f0ebe5; }
        .product-table tbody td.text-right { text-align: right; }
        .product-table tbody td.text-center { text-align: center; }
        .product-table tfoot td {
            padding: 10px 14px;
            font-weight: 600;
        }
        .product-table tfoot .total-row td {
            border-top: 2px solid #4A2C11;
            padding: 12px 14px;
            font-size: 14px;
        }
        .product-table tfoot .total-row .grand-total {
            color: #4A2C11;
            font-weight: 700;
        }

        /* FOOTER */
        .invoice-footer {
            text-align: center;
            margin-top: 30px;
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
            font-size: 11px;
            color: #70655E;
        }
        .invoice-footer .thankyou {
            font-size: 14px;
            font-weight: 600;
            color: #4A2C11;
            margin-bottom: 4px;
        }

        /* TOMBOL */
        .btn-group {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 18px;
            flex-wrap: wrap;
        }
        .btn-group .btn {
            padding: 10px 32px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            transition: all 0.3s ease;
            font-family: 'Arial', sans-serif;
        }
        .btn-group .btn-print {
            background: #4A2C11;
            color: white;
        }
        .btn-group .btn-print:hover {
            background: #2C1808;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(74, 44, 17, 0.25);
        }
        .btn-group .btn-back {
            background: #70655E;
            color: white;
        }
        .btn-group .btn-back:hover {
            background: #5a4f48;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(112, 101, 94, 0.25);
        }

        @media print {
            .no-print { display: none !important; }
            body { background: #fff; padding: 0; }
            .invoice-wrapper { box-shadow: none; border: none; padding: 20px; border-radius: 0; }
            .info-grid { background: #f8f5f0; }
        }

        @media (max-width: 600px) {
            .invoice-wrapper { padding: 20px; }
            .info-grid { grid-template-columns: 1fr; gap: 8px; }
            .alamat-box { flex-direction: column; gap: 6px; }
            .btn-group .btn { width: 100%; justify-content: center; }
        }
    </style>
</head>
<body>

<div class="invoice-wrapper">

    <!-- HEADER -->
    <div class="invoice-header">
        <div class="brand-icon">☕</div>
        <h1>INVOICE</h1>
        <div class="sub">Supply Chain Kopi — Liberchain</div>
        <div class="invoice-number"><span>#INV-<?php echo str_pad($transaksi['id_transaksi'], 6, '0', STR_PAD_LEFT); ?></span></div>
    </div>

    <!-- INFO GRID -->
    <div class="info-grid">
        <div class="info-item">
            <span class="label">Tanggal Transaksi</span>
            <span class="value"><?php echo date('d F Y H:i', strtotime($transaksi['tanggal_transaksi'])); ?></span>
        </div>
        <div class="info-item" style="text-align:right;">
            <span class="label">Status</span>
            <span class="value">
                <span class="status-badge <?php echo $transaksi['status_pesanan'] == 'Selesai' ? 'success' : ($transaksi['status_pesanan'] == 'Pending' ? 'warning' : 'danger'); ?>">
                    <?php echo $transaksi['status_pesanan']; ?>
                </span>
            </span>
        </div>
        <div class="info-item">
            <span class="label">Pembeli</span>
            <span class="value"><?php echo $transaksi['nama_pembeli'] ?? 'Guest'; ?></span>
        </div>
        <div class="info-item" style="text-align:right;">
            <span class="label">Metode Bayar</span>
            <span class="value"><?php echo $transaksi['metode_bayar']; ?></span>
        </div>
        <div class="info-item">
            <span class="label">Status Bayar</span>
            <span class="value">
                <span class="status-badge <?php echo $transaksi['status_bayar'] == 'Lunas' ? 'success' : 'warning'; ?>">
                    <?php echo $transaksi['status_bayar']; ?>
                </span>
            </span>
        </div>
        <div class="info-item" style="text-align:right;">
            <span class="label">Invoice</span>
            <span class="value">#INV-<?php echo str_pad($transaksi['id_transaksi'], 6, '0', STR_PAD_LEFT); ?></span>
        </div>
    </div>

    <!-- ALAMAT -->
    <div class="alamat-box">
        <div>
            <div class="label">Alamat Kirim</div>
            <div class="value"><?php echo $transaksi['alamat_kirim']; ?></div>
        </div>
        <div>
            <div class="label">Kota / Kode Pos</div>
            <div class="value"><?php echo $transaksi['kota_kirim']; ?> — <?php echo $transaksi['kode_pos']; ?></div>
        </div>
    </div>

    <!-- TABEL PRODUK -->
    <table class="product-table">
        <thead>
            <tr>
                <th style="width:6%;">#</th>
                <th style="width:44%;">Produk</th>
                <th style="width:15%;" class="text-center">Qty</th>
                <th style="width:20%;" class="text-right">Harga</th>
                <th style="width:15%;" class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($details as $d): ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['nama_produk']; ?></td>
                <td class="text-center"><?php echo $d['jumlah']; ?></td>
                <td class="text-right">Rp <?php echo number_format($d['harga_satuan'], 0, ',', '.'); ?></td>
                <td class="text-right">Rp <?php echo number_format($d['subtotal'], 0, ',', '.'); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align:right;">Subtotal</td>
                <td style="text-align:right;">Rp <?php echo number_format($transaksi['total_harga'], 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align:right;">Ongkir</td>
                <td style="text-align:right;">Rp <?php echo number_format($transaksi['ongkir'], 0, ',', '.'); ?></td>
            </tr>
            <tr class="total-row">
                <td colspan="4" style="text-align:right; font-size:15px;">Grand Total</td>
                <td style="text-align:right; font-size:16px; color:#4A2C11; font-weight:700;">
                    Rp <?php echo number_format($transaksi['grand_total'], 0, ',', '.'); ?>
                </td>
            </tr>
        </tfoot>
    </table>

    <!-- FOOTER -->
    <div class="invoice-footer">
        <div class="thankyou">☕ Terima kasih telah berbelanja di Liberchain</div>
        <p>&copy; <?php echo date('Y'); ?> Liberchain — Supply Chain Kopi. All rights reserved.</p>

        <!-- TOMBOL -->
        <div class="no-print btn-group">
            <button onclick="window.print()" class="btn btn-print">
                🖨️ Cetak Invoice
            </button>
            <a href="<?php echo base_url('admin/transaksi/detail/' . $transaksi['id_transaksi']); ?>" class="btn btn-back">
                🔙 Kembali ke Detail
            </a>
        </div>
    </div>

</div>

</body>
</html>