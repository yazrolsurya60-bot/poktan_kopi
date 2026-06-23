<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="bi bi-clock-history"></i> History Tracking</h4>
                </div>
                <div class="card-body">
                    <?php if (empty($history)): ?>
                        <div class="text-center py-5">
                            <i class="bi bi-clock-history fa-4x text-muted mb-3"></i>
                            <h5>Belum ada history tracking</h5>
                            <p class="text-muted">Anda belum memiliki pesanan yang sudah selesai.</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead><tr><th>Invoice</th><th>Status</th><th>Kurir</th><th>Tanggal</th><th>Aksi</th></tr></thead>
                                <tbody>
                                    <?php foreach ($history as $track): ?>
                                        <tr>
                                            <td><strong>#<?= $track->invoice ?></strong></td>
                                            <td><span class="status-badge <?= $track->status_class ?>"><i class="bi <?= $track->status_icon ?>"></i> <?= $track->status_label ?></span></td>
                                            <td><?= $track->nama_kurir ?: '-' ?></td>
                                            <td><?= date('d M Y', strtotime($track->created_at)) ?></td>
                                            <td><a href="<?= base_url('pembeli/tracking/detail/' . $track->id_tracking) ?>" class="btn btn-sm btn-info" style="border-radius:8px;"><i class="bi bi-eye"></i> Detail</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                    <a href="<?= base_url('pembeli/tracking') ?>" class="btn btn-secondary" style="border-radius:10px;"><i class="bi bi-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
:root { --roasted-brown: #4A2C11; --amber-cream: #E6A15C; --bg-cream: #FAF6F0; --dark-coffee: #2C1808; }
body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-cream); color: var(--dark-coffee); }
.status-badge { padding: 4px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: 600; display: inline-flex; align-items: center; gap: 4px; }
.status-badge.pending { background: #FEF3C7; color: #92400E; }
.status-badge.processing { background: #DBEAFE; color: #1E40AF; }
.status-badge.delivery { background: #EDE9FE; color: #5B21B6; }
.status-badge.complete { background: #D1FAE5; color: #065F46; }
.status-badge.cancelled { background: #FEE2E2; color: #991B1B; }
</style>