<style>
    .custom-card {
        background: var(--card-white);
        border: 1px solid rgba(74, 44, 17, 0.06);
        border-radius: var(--radius-card);
        box-shadow: var(--shadow-soft);
        transition: var(--transition-smooth);
        overflow: hidden;
    }
    .custom-card:hover {
        box-shadow: var(--shadow-hover);
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
    
    .btn-detail {
        background: var(--amber-cream);
        color: white;
        border: none;
        padding: 5px 14px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 600;
        transition: var(--transition-smooth);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .btn-detail:hover {
        background: var(--roasted-brown);
        color: white;
        text-decoration: none;
        transform: translateY(-1px);
        box-shadow: var(--shadow-hover);
    }
</style>

<!-- TRANSAKSI TABLE -->
<div class="custom-card">
    <div class="card-header-custom">
        <h6><i class="bi bi-receipt mr-2"></i> Daftar Transaksi</h6>
        <span class="badge" style="background: var(--bg-cream); color: var(--text-secondary); font-weight:500;">
            <?= count($transaksi ?? []); ?> transaksi
        </span>
    </div>
    <div class="card-body-custom" style="padding:0;">
        <?php if (empty($transaksi)): ?>
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size: 3rem; color: #ddd;"></i>
                <h5 class="mt-3">Belum ada transaksi</h5>
                <p class="text-muted">Produk Anda belum ada yang dipesan.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pembeli</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transaksi as $t): ?>
                            <tr>
                                <td><strong>#<?= $t['id_transaksi']; ?></strong></td>
                                <td><?= $t['nama_pembeli'] ?? 'Guest'; ?></td>
                                <td><strong>Rp <?= number_format($t['grand_total'] ?? 0, 0, ',', '.'); ?></strong></td>
                                <td>
                                    <?php
                                    $status = $t['status_pesanan'] ?? 'Pending';
                                    $class = 'pending';
                                    if ($status == 'Selesai') $class = 'complete';
                                    elseif ($status == 'Dikirim') $class = 'delivery';
                                    elseif ($status == 'Diproses') $class = 'processing';
                                    elseif ($status == 'Dibatalkan') $class = 'cancelled';
                                    ?>
                                    <span class="status-badge <?= $class; ?>">
                                        <?= $status; ?>
                                    </span>
                                </td>
                                <td><?= date('d/m/Y H:i', strtotime($t['tanggal_transaksi'])); ?></td>
                                <td>
                                    <a href="<?= base_url('petani/transaksi/detail/' . $t['id_transaksi']); ?>" class="btn-detail">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
