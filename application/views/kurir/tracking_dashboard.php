<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="bi bi-truck"></i> Dashboard Pengiriman</h4>
                </div>
                <div class="card-body">
                    <?php if (empty($trackings)): ?>
                        <div class="text-center py-5">
                            <i class="bi bi-check-circle fa-4x text-success mb-3"></i>
                            <h5>Belum ada pengiriman</h5>
                            <p class="text-muted">Tidak ada pengiriman yang perlu dilacak saat ini.</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead><tr><th>Invoice</th><th>Pembeli</th><th>Status</th><th>Terakhir Update</th><th>Aksi</th></tr></thead>
                                <tbody>
                                    <?php foreach ($trackings as $track): ?>
                                        <tr>
                                            <td><strong>#<?= $track->invoice ?></strong></td>
                                            <td><?= $track->pembeli ?></td>
                                            <td><span class="status-badge <?= $track->status_class ?>"><i class="bi <?= $track->status_icon ?>"></i> <?= $track->status_label ?></span></td>
                                            <td><?= date('d M Y H:i', strtotime($track->updated_at)) ?></td>
                                            <td><a href="<?= base_url('kurir/tracking/update_location/' . $track->id_tracking) ?>" class="btn btn-primary btn-sm" style="background: var(--roasted-brown, #4A2C11); border: none; border-radius:8px;"><i class="bi bi-geo-alt"></i> Update Lokasi</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
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