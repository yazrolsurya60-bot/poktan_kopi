<style>
    .custom-card {
        background: var(--card-white);
        border: 1px solid rgba(74, 44, 17, 0.06);
        border-radius: var(--radius-card);
        box-shadow: var(--shadow-soft);
        transition: var(--transition-smooth);
        overflow: hidden;
    }
    .custom-card .card-header-custom {
        padding: 18px 24px;
        border-bottom: 1px solid rgba(74, 44, 17, 0.06);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .custom-card .card-header-custom h6 {
        font-weight: 700;
        color: var(--dark-coffee);
        margin: 0;
        font-size: 0.85rem;
    }
    .custom-card .card-body-custom {
        padding: 24px;
    }
    .detail-label {
        font-weight: 600;
        color: var(--text-secondary);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    .detail-value {
        font-weight: 600;
        color: var(--dark-coffee);
    }
    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        display: inline-block;
    }
    .status-badge.pending { background: #FEF3C7; color: #92400E; }
    .status-badge.processing { background: #DBEAFE; color: #1E40AF; }
    .status-badge.delivery { background: #EDE9FE; color: #5B21B6; }
    .status-badge.complete { background: #D1FAE5; color: #065F46; }
    .status-badge.cancelled { background: #FEE2E2; color: #991B1B; }
    
    .btn-back {
        background: var(--roasted-brown);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 8px 20px;
        font-weight: 600;
        transition: var(--transition-smooth);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-back:hover {
        background: var(--dark-coffee);
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: var(--shadow-hover);
    }
    .table-custom {
        font-size: 0.85rem;
        margin-bottom: 0;
    }
    .table-custom thead th {
        background: rgba(250, 246, 240, 0.4);
        border-bottom: 2px solid rgba(74, 44, 17, 0.06);
        color: var(--text-secondary);
        font-weight: 600;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 10px;
    }
    .table-custom tbody td {
        padding: 12px 10px;
        border-bottom: 1px solid rgba(74, 44, 17, 0.04);
        vertical-align: middle;
    }
    .table-custom tbody tr:hover {
        background: rgba(250, 246, 240, 0.3);
    }
</style>

<!-- DETAIL CONTENT -->
<div class="row">
    <div class="col-md-6 mb-4">
        <div class="custom-card">
            <div class="card-header-custom">
                <h6><i class="bi bi-info-circle mr-2"></i> Informasi Pesanan</h6>
                <?php
                $status = $transaksi['status_pesanan'] ?? 'Pending';
                $class = 'pending';
                if ($status == 'Selesai') $class = 'complete';
                elseif ($status == 'Dikirim') $class = 'delivery';
                elseif ($status == 'Diproses') $class = 'processing';
                elseif ($status == 'Dibatalkan') $class = 'cancelled';
                ?>
                <span class="status-badge <?= $class; ?>">
                    <?= $status; ?>
                </span>
            </div>
            <div class="card-body-custom">
                <div class="row mb-2">
                    <div class="col-5 detail-label">ID Transaksi</div>
                    <div class="col-7 detail-value">#<?= $transaksi['id_transaksi']; ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 detail-label">Pembeli</div>
                    <div class="col-7 detail-value"><?= $transaksi['nama_pembeli'] ?? 'Guest'; ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 detail-label">Status Bayar</div>
                    <div class="col-7">
                        <span class="status-badge <?= $transaksi['status_bayar'] == 'Lunas' ? 'complete' : 'pending'; ?>">
                            <?= $transaksi['status_bayar']; ?>
                        </span>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 detail-label">Metode Bayar</div>
                    <div class="col-7 detail-value"><?= $transaksi['metode_bayar'] ?? '-'; ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 detail-label">Tanggal</div>
                    <div class="col-7 detail-value"><?= date('d/m/Y H:i', strtotime($transaksi['tanggal_transaksi'])); ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 detail-label">Alamat Kirim</div>
                    <div class="col-7 detail-value"><?= $transaksi['alamat_kirim'] ?? '-'; ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 detail-label">Kota</div>
                    <div class="col-7 detail-value"><?= $transaksi['kota_kirim'] ?? '-'; ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="custom-card">
            <div class="card-header-custom">
                <h6><i class="bi bi-box-seam mr-2"></i> Detail Produk</h6>
                <span class="badge" style="background: var(--bg-cream); color: var(--text-secondary);">
                    <?= count($details ?? []); ?> item
                </span>
            </div>
            <div class="card-body-custom" style="padding:0;">
                <div class="table-responsive">
                    <table class="table table-custom mb-0">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th class="text-center">Qty</th>
                                <th class="text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_harga = 0;
                            foreach ($details as $d):
                                $subtotal = ($d['harga_satuan'] ?? 0) * ($d['jumlah'] ?? 0);
                                $total_harga += $subtotal;
                            ?>
                                <tr>
                                    <td><?= $d['nama_produk']; ?></td>
                                    <td class="text-center"><?= $d['jumlah']; ?></td>
                                    <td class="text-right">Rp <?= number_format($subtotal, 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" class="text-right">Subtotal</th>
                                <th class="text-right">Rp <?= number_format($total_harga, 0, ',', '.'); ?></th>
                            </tr>
                            <tr>
                                <th colspan="2" class="text-right">Ongkir</th>
                                <th class="text-right">Rp <?= number_format($transaksi['ongkir'] ?? 0, 0, ',', '.'); ?></th>
                            </tr>
                            <tr style="border-top: 2px solid var(--amber-cream);">
                                <th colspan="2" class="text-right" style="font-size:1rem;">Grand Total</th>
                                <th class="text-right" style="font-size:1.1rem; color: var(--amber-cream); font-weight:700;">
                                    Rp <?= number_format($transaksi['grand_total'] ?? 0, 0, ',', '.'); ?>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BUTTON BACK -->
<div class="mt-3">
    <a href="<?= base_url('petani/transaksi'); ?>" class="btn-back">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Transaksi
    </a>
</div>
