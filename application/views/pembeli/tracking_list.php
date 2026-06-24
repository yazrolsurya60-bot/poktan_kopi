<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="bi bi-truck"></i> Tracking Pesanan Aktif</h4>
                </div>
                <div class="card-body">
                    <?php if (empty($trackings)): ?>
                        <div class="text-center py-5">
                            <i class="bi bi-box-seam fa-4x text-muted mb-3"></i>
                            <h5>Tidak ada pengiriman aktif</h5>
                            <p class="text-muted">Belum ada pesanan yang sedang dalam proses pengiriman.</p>
                            <a href="<?= base_url('landing') ?>" class="btn" style="background: var(--roasted-brown, #4A2C11); color: white; border-radius:10px;">
                                <i class="bi bi-cart"></i> Belanja Sekarang
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <?php foreach ($trackings as $track): ?>
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card h-100 shadow-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <h5 class="card-title">#<?= $track->invoice ?></h5>
                                                <span class="status-badge <?= $track->status_class ?>">
                                                    <i class="bi <?= $track->status_icon ?>"></i>
                                                    <?= $track->status_label ?>
                                                </span>
                                            </div>
                                            <p class="card-text text-muted small">
                                                <i class="bi bi-calendar"></i> <?= date('d M Y H:i', strtotime($track->created_at)) ?>
                                            </p>
                                            <?php if ($track->nama_kurir): ?>
                                                <p class="card-text"><i class="bi bi-person"></i> Kurir: <?= $track->nama_kurir ?></p>
                                            <?php endif; ?>
                                            <?php if ($track->estimasi): ?>
                                                <p class="card-text text-success"><i class="bi bi-clock"></i> Estimasi tiba: <?= date('d M Y H:i', strtotime($track->estimasi)) ?></p>
                                            <?php endif; ?>
                                            <div class="mt-3">
                                                <a href="<?= base_url('pembeli/tracking/detail/' . $track->id_tracking) ?>" class="btn btn-primary btn-block" style="background: var(--roasted-brown, #4A2C11); border: none; border-radius:10px;">
                                                    <i class="bi bi-eye"></i> Detail Tracking
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --roasted-brown: #4A2C11;
    --dark-coffee: #2C1808;
    --amber-cream: #E6A15C;
    --bg-cream: #FAF6F0;
    --card-white: #FFFFFF;
    --text-secondary: #70655E;
}
body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-cream); color: var(--dark-coffee); }
.status-badge { padding: 4px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: 600; display: inline-flex; align-items: center; gap: 4px; }
.status-badge.pending { background: #FEF3C7; color: #92400E; }
.status-badge.processing { background: #DBEAFE; color: #1E40AF; }
.status-badge.delivery { background: #EDE9FE; color: #5B21B6; }
.status-badge.complete { background: #D1FAE5; color: #065F46; }
.status-badge.cancelled { background: #FEE2E2; color: #991B1B; }
</style>