<!DOCTYPE html>
<html>
<head>
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background: #f5f1ea; font-family: 'Segoe UI', sans-serif; }
        .card-custom { border-radius: 16px; box-shadow: 0 10px 40px rgba(44,24,8,0.1); border: none; }
        .status-badge { padding: 5px 14px; border-radius: 20px; font-weight: 600; font-size: 0.8rem; }
        .status-badge.pending { background: #FEF3C7; color: #92400E; }
        .status-badge.complete { background: #D1FAE5; color: #065F46; }
        .status-badge.cancelled { background: #FEE2E2; color: #991B1B; }
        .status-badge.processing { background: #DBEAFE; color: #1E40AF; }
        .status-badge.shipped { background: #EDE9FE; color: #5B21B6; }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="card card-custom">
        <div class="card-header bg-white border-0 pt-4">
            <h4 class="font-weight-bold" style="color: #4A2C11;">
                <i class="bi bi-box-seam"></i> Detail Pesanan #<?= $transaksi['id_transaksi']; ?>
            </h4>
            <p class="text-muted">Invoice: <strong><?= $transaksi['invoice']; ?></strong></p>
        </div>
        <div class="card-body">
            
            <!-- Status -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded">
                        <small class="text-muted">Status Pesanan</small>
                        <div>
                            <?php
                            $status = $transaksi['status_pesanan'] ?? 'Pending';
                            $class = 'pending';
                            if ($status == 'Selesai') $class = 'complete';
                            elseif ($status == 'Dibatalkan') $class = 'cancelled';
                            elseif ($status == 'Diproses') $class = 'processing';
                            elseif ($status == 'Dikirim') $class = 'shipped';
                            ?>
                            <span class="status-badge <?= $class; ?>"><?= $status; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded">
                        <small class="text-muted">Status Pembayaran</small>
                        <div>
                            <?php
                            $bayar = $transaksi['status_bayar'] ?? 'Belum Bayar';
                            $bayar_class = $bayar == 'Lunas' ? 'complete' : 'pending';
                            ?>
                            <span class="status-badge <?= $bayar_class; ?>"><?= $bayar; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Informasi -->
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr><td width="120"><strong>Nama Penerima</strong></td><td><?= $transaksi['nama_penerima']; ?></td></tr>
                        <tr><td><strong>Alamat</strong></td><td><?= $transaksi['alamat_kirim']; ?></td></tr>
                        <tr><td><strong>Kota</strong></td><td><?= $transaksi['kota_kirim']; ?></td></tr>
                        <tr><td><strong>No HP</strong></td><td><?= $transaksi['no_hp']; ?></td></tr>
                        <tr><td><strong>Tanggal</strong></td><td><?= date('d/m/Y H:i', strtotime($transaksi['tanggal_transaksi'])); ?></td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr><td width="120"><strong>Metode Bayar</strong></td><td><?= $transaksi['metode_bayar'] ?? '-'; ?></td></tr>
                        <tr><td><strong>Subtotal</strong></td><td>Rp <?= number_format($transaksi['total_harga'], 0, ',', '.'); ?></td></tr>
                        <tr><td><strong>Ongkir</strong></td><td>Rp <?= number_format($transaksi['ongkir'], 0, ',', '.'); ?></td></tr>
                        <tr><td><strong>Grand Total</strong></td><td><strong style="color: #4A2C11;">Rp <?= number_format($transaksi['grand_total'], 0, ',', '.'); ?></strong></td></tr>
                    </table>
                </div>
            </div>
            
            <!-- Produk -->
            <h6 class="mt-3 font-weight-bold">Produk</h6>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th class="text-center">Qty</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($details as $d): ?>
                    <tr>
                        <td><?= $d['nama_produk']; ?></td>
                        <td class="text-center"><?= $d['jumlah']; ?></td>
                        <td class="text-right">Rp <?= number_format($d['subtotal'], 0, ',', '.'); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <!-- Tombol -->
            <div class="text-center mt-3">
                <a href="<?= base_url('guest/tracking'); ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <a href="<?= base_url('auth/register'); ?>" class="btn btn-success">
                    <i class="bi bi-person-plus"></i> Daftar Member
                </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>