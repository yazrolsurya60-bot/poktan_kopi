<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan - Liberchain</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --roasted-brown: #4A2C11;
            --dark-coffee: #2C1808;
            --amber-cream: #E6A15C;
            --bg-cream: #FAF6F0;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #FAF6F0 0%, #e8e0d8 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .card-custom {
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(44,24,8,0.12);
            border: 1px solid rgba(74,44,17,0.08);
            overflow: hidden;
            background: #FFFFFF;
            max-width: 800px;
            margin: 0 auto;
        }
        .card-header-custom {
            background: linear-gradient(135deg, var(--dark-coffee), var(--roasted-brown));
            padding: 24px 30px;
            border-bottom: 3px solid var(--amber-cream);
        }
        .card-header-custom h4 {
            color: white;
            font-weight: 800;
            margin: 0;
        }
        .card-header-custom p {
            color: rgba(255,255,255,0.7);
            margin: 4px 0 0;
            font-size: 0.9rem;
        }
        .card-header-custom .badge-status {
            display: inline-block;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
        }
        .badge-status.pending { background: #FEF3C7; color: #92400E; }
        .badge-status.complete { background: #D1FAE5; color: #065F46; }
        .badge-status.processing { background: #DBEAFE; color: #1E40AF; }
        .badge-status.shipped { background: #EDE9FE; color: #5B21B6; }
        .badge-status.cancelled { background: #FEE2E2; color: #991B1B; }
        .badge-status.lunas { background: #D1FAE5; color: #065F46; }
        .badge-status.belum { background: #FEF3C7; color: #92400E; }
        .section-title {
            font-weight: 700;
            font-size: 0.85rem;
            color: var(--dark-coffee);
            border-bottom: 2px solid var(--bg-cream);
            padding-bottom: 10px;
            margin-bottom: 16px;
        }
        .section-title i {
            color: var(--amber-cream);
            margin-right: 8px;
        }
        .detail-row {
            display: flex;
            padding: 6px 0;
            border-bottom: 1px solid rgba(74,44,17,0.04);
        }
        .detail-row .label {
            width: 130px;
            font-weight: 600;
            color: var(--text-secondary);
            font-size: 0.82rem;
            flex-shrink: 0;
        }
        .detail-row .value {
            flex: 1;
            font-weight: 500;
            color: var(--dark-coffee);
            font-size: 0.85rem;
        }
        .table-custom {
            font-size: 0.85rem;
        }
        .table-custom thead th {
            background: var(--bg-cream);
            color: var(--text-secondary);
            font-weight: 700;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid rgba(74,44,17,0.06);
        }
        .table-custom tfoot td {
            font-weight: 700;
            padding: 10px 12px;
        }
        .table-custom tfoot .total-row {
            border-top: 2px solid var(--roasted-brown);
        }
        .table-custom tfoot .total-row td {
            color: var(--roasted-brown);
            font-size: 1.1rem;
        }
        .btn-back {
            background: var(--roasted-brown);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-back:hover {
            background: var(--dark-coffee);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(74,44,17,0.3);
        }
        .btn-outline-coklat {
            background: transparent;
            color: var(--roasted-brown);
            border: 2px solid var(--roasted-brown);
            border-radius: 10px;
            padding: 10px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-outline-coklat:hover {
            background: var(--roasted-brown);
            color: white;
            transform: translateY(-2px);
        }
        .empty-state {
            text-align: center;
            padding: 30px 0;
            color: #999;
        }
        .empty-state i {
            font-size: 3rem;
            display: block;
            margin-bottom: 12px;
            opacity: 0.3;
        }
        .btn-group-custom {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }
        .badge-status .icon {
            margin-right: 4px;
        }
    </style>
</head>
<body>
<div class="card card-custom">
    <!-- HEADER -->
    <div class="card-header-custom">
        <div class="d-flex justify-content-between align-items-start flex-wrap">
            <div>
                <h4><i class="bi bi-box-seam mr-2"></i> Detail Pesanan</h4>
                <p>Invoice: <strong><?= $transaksi['invoice'] ?? '-'; ?></strong></p>
            </div>
            <div class="text-right">
                <?php
                $status = $transaksi['status_pesanan'] ?? 'Pending';
                $class = 'pending';
                if ($status == 'Selesai' || $status == 'Complete') $class = 'complete';
                elseif ($status == 'Dibatalkan' || $status == 'Cancelled') $class = 'cancelled';
                elseif ($status == 'Diproses' || $status == 'Processing') $class = 'processing';
                elseif ($status == 'Dikirim' || $status == 'Shipped') $class = 'shipped';
                ?>
                <span class="badge-status <?= $class; ?>">
                    <i class="bi bi-circle-fill icon" style="font-size:0.5rem;"></i> <?= $status; ?>
                </span>
            </div>
        </div>
    </div>
    
    <div class="card-body p-4">
        
        <!-- Status -->
        <div class="row mb-4">
            <div class="col-md-6 mb-2">
                <div class="p-3" style="background: var(--bg-cream); border-radius: 10px;">
                    <small class="text-muted" style="font-weight:600; font-size:0.7rem; text-transform:uppercase; letter-spacing:0.5px;">
                        <i class="bi bi-clock"></i> Status Pesanan
                    </small>
                    <div class="mt-1">
                        <?php
                        $status = $transaksi['status_pesanan'] ?? 'Pending';
                        $class = 'pending';
                        if ($status == 'Selesai' || $status == 'Complete') $class = 'complete';
                        elseif ($status == 'Dibatalkan' || $status == 'Cancelled') $class = 'cancelled';
                        elseif ($status == 'Diproses' || $status == 'Processing') $class = 'processing';
                        elseif ($status == 'Dikirim' || $status == 'Shipped') $class = 'shipped';
                        ?>
                        <span class="badge-status <?= $class; ?>" style="font-size:0.85rem;">
                            <?= $status; ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-2">
                <div class="p-3" style="background: var(--bg-cream); border-radius: 10px;">
                    <small class="text-muted" style="font-weight:600; font-size:0.7rem; text-transform:uppercase; letter-spacing:0.5px;">
                        <i class="bi bi-credit-card"></i> Status Pembayaran
                    </small>
                    <div class="mt-1">
                        <?php
                        $bayar = $transaksi['status_bayar'] ?? 'Belum Bayar';
                        $bayar_class = ($bayar == 'Lunas' || $bayar == 'Paid') ? 'lunas' : 'belum';
                        ?>
                        <span class="badge-status <?= $bayar_class; ?>" style="font-size:0.85rem;">
                            <?= $bayar; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Informasi Pesanan -->
        <div class="row">
            <div class="col-md-6">
                <div class="section-title"><i class="bi bi-person"></i> Data Penerima</div>
                <div class="detail-row">
                    <span class="label">Nama</span>
                    <span class="value"><?= $transaksi['nama_penerima'] ?? '-'; ?></span>
                </div>
                <div class="detail-row">
                    <span class="label">Alamat</span>
                    <span class="value"><?= $transaksi['alamat_kirim'] ?? '-'; ?></span>
                </div>
                <div class="detail-row">
                    <span class="label">Kota</span>
                    <span class="value"><?= $transaksi['kota_kirim'] ?? '-'; ?></span>
                </div>
                <div class="detail-row">
                    <span class="label">No HP</span>
                    <span class="value"><?= $transaksi['no_hp'] ?? '-'; ?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="section-title"><i class="bi bi-info-circle"></i> Detail Transaksi</div>
                <div class="detail-row">
                    <span class="label">Tanggal</span>
                    <span class="value"><?= date('d/m/Y H:i', strtotime($transaksi['tanggal_transaksi'] ?? date('Y-m-d H:i:s'))); ?></span>
                </div>
                <div class="detail-row">
                    <span class="label">Metode Bayar</span>
                    <span class="value"><?= $transaksi['metode_bayar'] ?? '-'; ?></span>
                </div>
                <div class="detail-row">
                    <span class="label">Subtotal</span>
                    <span class="value">Rp <?= number_format($transaksi['total_harga'] ?? 0, 0, ',', '.'); ?></span>
                </div>
                <div class="detail-row">
                    <span class="label">Ongkir</span>
                    <span class="value">Rp <?= number_format($transaksi['ongkir'] ?? 0, 0, ',', '.'); ?></span>
                </div>
                <div class="detail-row" style="border-bottom: none; margin-top:4px; padding-top:8px; border-top:2px solid var(--amber-cream);">
                    <span class="label" style="font-weight:700; color:var(--roasted-brown);">Grand Total</span>
                    <span class="value" style="font-weight:800; color:var(--roasted-brown); font-size:1.1rem;">
                        Rp <?= number_format($transaksi['grand_total'] ?? 0, 0, ',', '.'); ?>
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Produk -->
        <div class="mt-4">
            <div class="section-title"><i class="bi bi-box-seam"></i> Produk</div>
            <?php if (empty($details)): ?>
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p>Tidak ada produk dalam pesanan ini</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th class="text-center" style="width:80px;">Qty</th>
                                <th class="text-right" style="width:150px;">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($details as $d): ?>
                            <tr>
                                <td><?= $d['nama_produk'] ?? 'Produk tidak tersedia'; ?></td>
                                <td class="text-center"><?= $d['jumlah'] ?? 0; ?></td>
                                <td class="text-right">Rp <?= number_format(($d['harga_satuan'] ?? 0) * ($d['jumlah'] ?? 0), 0, ',', '.'); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" class="text-right">Subtotal</td>
                                <td class="text-right">Rp <?= number_format($transaksi['total_harga'] ?? 0, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-right">Ongkir</td>
                                <td class="text-right">Rp <?= number_format($transaksi['ongkir'] ?? 0, 0, ',', '.'); ?></td>
                            </tr>
                            <tr class="total-row">
                                <td colspan="2" class="text-right" style="font-size:1rem;">Grand Total</td>
                                <td class="text-right" style="font-size:1.2rem; color: var(--roasted-brown); font-weight:800;">
                                    Rp <?= number_format($transaksi['grand_total'] ?? 0, 0, ',', '.'); ?>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Tombol -->
        <div class="btn-group-custom">
            <a href="<?= base_url('guest/tracking'); ?>" class="btn-back">
                <i class="bi bi-arrow-left mr-1"></i> Kembali
            </a>
            <a href="<?= base_url('auth/register'); ?>" class="btn-outline-coklat">
                <i class="bi bi-person-plus mr-1"></i> Daftar Member
            </a>
        </div>
        
    </div>
</div>
</body>
</html>