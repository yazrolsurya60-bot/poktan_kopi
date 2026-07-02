<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert" style="border-radius:10px;">
                    <i class="bi bi-check-circle-fill mr-2"></i><?= $this->session->flashdata('success'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert" style="border-radius:10px;">
                    <i class="bi bi-exclamation-triangle-fill mr-2"></i><?= $this->session->flashdata('error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
                </div>
            <?php endif; ?>

            <div class="card dashboard-card">
                <div class="card-header d-flex align-items-center">
                    <div class="header-icon mr-3"><i class="bi bi-truck"></i></div>
                    <div>
                        <h4 class="mb-0">Dashboard Kurir</h4>
                        <small class="text-muted">Daftar pengiriman yang perlu bukti pengiriman</small>
                    </div>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($trackings)): ?>
                        <div class="text-center py-5">
                            <i class="bi bi-check-circle text-success" style="font-size: 3.5rem;"></i>
                            <h5 class="mt-3">Semua Pengiriman Selesai</h5>
                            <p class="text-muted">Tidak ada pengiriman aktif yang perlu ditangani saat ini.</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Invoice</th>
                                        <th>Pembeli</th>
                                        <th>Status</th>
                                        <th>Bukti</th>
                                        <th>Terakhir Update</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($trackings as $track): ?>
                                        <tr>
                                            <td>
                                                <strong class="text-coffee">#<?= $track->invoice ?></strong>
                                            </td>
                                            <td><?= $track->pembeli ?></td>
                                            <td>
                                                <span class="status-badge <?= $track->status_class ?>">
                                                    <i class="bi <?= $track->status_icon ?>"></i>
                                                    <?= $track->status_label ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php if (!empty($track->bukti_pengiriman)): ?>
                                                    <span class="badge badge-success-soft">
                                                        <i class="bi bi-check2-circle"></i> Sudah Upload
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge badge-warning-soft">
                                                        <i class="bi bi-exclamation-circle"></i> Belum Ada
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <small class="text-muted"><?= date('d M Y H:i', strtotime($track->updated_at)) ?></small>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($track->status_pengiriman != 'diterima' && $track->status_pengiriman != 'dibatalkan'): ?>
                                                    <a href="<?= base_url('kurir/tracking/upload_bukti/' . $track->id_tracking) ?>"
                                                       class="btn btn-coffee btn-sm">
                                                        <i class="bi bi-upload"></i>
                                                        <?= !empty($track->bukti_pengiriman) ? 'Update Bukti' : 'Upload Bukti' ?>
                                                    </a>
                                                <?php else: ?>
                                                    <span class="text-muted small">—</span>
                                                <?php endif; ?>
                                            </td>
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
:root {
    --roasted-brown: #4A2C11;
    --dark-coffee: #2C1808;
    --amber-cream: #E6A15C;
    --bg-cream: #FAF6F0;
}

.dashboard-card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(44, 24, 8, 0.08);
    overflow: hidden;
}

.dashboard-card .card-header {
    background: linear-gradient(135deg, var(--dark-coffee) 0%, var(--roasted-brown) 100%);
    color: white;
    border-bottom: none;
    padding: 18px 20px;
}

.dashboard-card .card-header .text-muted { color: rgba(250,246,240,0.65) !important; }

.header-icon {
    width: 44px; height: 44px;
    background: rgba(230,161,92,0.18);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.4rem; color: var(--amber-cream);
    flex-shrink: 0;
}

.text-coffee { color: var(--roasted-brown); }

.table thead th {
    background: var(--bg-cream);
    color: var(--dark-coffee);
    font-weight: 600;
    font-size: 0.78rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-bottom: 2px solid rgba(74,44,17,0.08);
    padding: 12px 16px;
}

.table tbody td {
    padding: 14px 16px;
    vertical-align: middle;
    border-color: rgba(74,44,17,0.05);
}

.table tbody tr:hover { background: rgba(250,246,240,0.6); }

.status-badge {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 0.72rem;
    font-weight: 600;
}
.status-badge.pending    { background: #FEF3C7; color: #92400E; }
.status-badge.processing { background: #DBEAFE; color: #1E40AF; }
.status-badge.delivery   { background: #EDE9FE; color: #5B21B6; }
.status-badge.complete   { background: #D1FAE5; color: #065F46; }
.status-badge.cancelled  { background: #FEE2E2; color: #991B1B; }

.badge-success-soft {
    background: #D1FAE5; color: #065F46;
    font-size: 0.72rem; padding: 4px 10px; border-radius: 20px; font-weight: 600;
}
.badge-warning-soft {
    background: #FEF3C7; color: #92400E;
    font-size: 0.72rem; padding: 4px 10px; border-radius: 20px; font-weight: 600;
}

.btn-coffee {
    background: var(--roasted-brown);
    color: white; border: none;
    border-radius: 8px;
    font-size: 0.8rem; font-weight: 600;
    padding: 6px 14px;
    transition: all 0.25s;
}
.btn-coffee:hover {
    background: var(--dark-coffee);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(44,24,8,0.2);
}
</style>