<style>
:root {
    --roasted-brown: #4A2C11;
    --dark-coffee:   #2C1808;
    --amber-cream:   #E6A15C;
    --bg-cream:      #FAF6F0;
    --card-white:    #FFFFFF;
}
body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg-cream); color: var(--dark-coffee); }

.list-card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 4px 24px rgba(44,24,8,0.08);
    overflow: hidden;
}
.list-card .card-header {
    background: linear-gradient(135deg, var(--dark-coffee), var(--roasted-brown));
    color: #fff;
    padding: 18px 22px;
    border-bottom: none;
}
.list-card .card-header .text-muted { color: rgba(250,246,240,0.6) !important; }

.table thead th {
    background: var(--bg-cream);
    color: var(--dark-coffee);
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .06em;
    border-bottom: 2px solid rgba(74,44,17,0.08);
    padding: 12px 16px;
    white-space: nowrap;
}
.table tbody td {
    padding: 14px 16px;
    vertical-align: middle;
    border-color: rgba(74,44,17,0.05);
    font-size: 0.87rem;
}
.table tbody tr:hover { background: rgba(250,246,240,0.55); }

.invoice-badge {
    font-weight: 700;
    color: var(--roasted-brown);
    font-family: monospace;
    font-size: 0.88rem;
}

.status-badge {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 4px 11px; border-radius: 20px;
    font-size: 0.72rem; font-weight: 700;
}
.status-badge.pending    { background: #FEF3C7; color: #92400E; }
.status-badge.processing { background: #DBEAFE; color: #1E40AF; }
.status-badge.delivery   { background: #EDE9FE; color: #5B21B6; }
.status-badge.complete   { background: #D1FAE5; color: #065F46; }
.status-badge.cancelled  { background: #FEE2E2; color: #991B1B; }

.kurir-assigned {
    display: inline-flex; align-items: center; gap: 5px;
    background: #D1FAE5; color: #065F46;
    padding: 3px 10px; border-radius: 20px;
    font-size: 0.72rem; font-weight: 700;
}
.kurir-unassigned {
    display: inline-flex; align-items: center; gap: 5px;
    background: #FEF3C7; color: #92400E;
    padding: 3px 10px; border-radius: 20px;
    font-size: 0.72rem; font-weight: 700;
}

.btn-update {
    background: var(--roasted-brown); color: #fff; border: none;
    border-radius: 8px; padding: 6px 14px;
    font-size: 0.78rem; font-weight: 700;
    text-decoration: none;
    display: inline-flex; align-items: center; gap: 6px;
    transition: all .2s;
}
.btn-update:hover {
    background: var(--dark-coffee); color: #fff;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(44,24,8,0.2);
    text-decoration: none;
}

.stat-chip {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.15);
    border-radius: 8px; padding: 6px 14px;
    font-size: 0.78rem; font-weight: 600; color: #fff;
}
</style>

<div class="container-fluid">

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" style="border-radius:12px;">
            <i class="bi bi-check-circle-fill mr-2"></i><?= $this->session->flashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" style="border-radius:12px;">
            <i class="bi bi-exclamation-triangle-fill mr-2"></i><?= $this->session->flashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    <?php endif; ?>

    <div class="card list-card">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between flex-wrap" style="gap:10px;">
                <div class="d-flex align-items-center" style="gap:12px;">
                    <div style="width:42px;height:42px;background:rgba(230,161,92,.18);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.3rem;color:var(--amber-cream);">
                        <i class="bi bi-truck"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 font-weight-bold">Tracking Pengiriman</h5>
                        <small class="text-muted">Kelola status &amp; penugasan kurir</small>
                    </div>
                </div>
                <?php if (!empty($trackings)): ?>
                    <?php
                        $total      = count($trackings);
                        $with_kurir = count(array_filter((array)$trackings, fn($t) => !empty($t->id_kurir)));
                        $no_kurir   = $total - $with_kurir;
                    ?>
                    <div class="d-flex" style="gap:8px;">
                        <span class="stat-chip"><i class="bi bi-list-check"></i> <?= $total ?> Pengiriman</span>
                        <span class="stat-chip"><i class="bi bi-person-check"></i> <?= $with_kurir ?> Assigned</span>
                        <?php if ($no_kurir > 0): ?>
                            <span class="stat-chip" style="background:rgba(230,161,92,.18);border-color:rgba(230,161,92,.3);">
                                <i class="bi bi-exclamation-circle"></i> <?= $no_kurir ?> Belum Assign
                            </span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="card-body p-0">
            <?php if (empty($trackings)): ?>
                <div class="text-center py-5">
                    <i class="bi bi-check-circle-fill text-success" style="font-size:3rem;"></i>
                    <h5 class="mt-3">Tidak ada data tracking</h5>
                    <p class="text-muted small">Belum ada transaksi yang memiliki tracking.</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Invoice</th>
                                <th>Pembeli</th>
                                <th>Status</th>
                                <th>Kurir</th>
                                <th>Terakhir Update</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($trackings as $track): ?>
                                <tr>
                                    <td class="text-muted" style="font-size:.78rem;"><?= $no++ ?></td>
                                    <td><span class="invoice-badge"><?= $track->invoice ?? '-' ?></span></td>
                                    <td><?= $track->pembeli ?? '-' ?></td>
                                    <td>
                                        <span class="status-badge <?= $track->status_class ?>">
                                            <i class="bi <?= $track->status_icon ?>"></i>
                                            <?= $track->status_label ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if (!empty($track->nama_kurir)): ?>
                                            <span class="kurir-assigned">
                                                <i class="bi bi-person-check-fill"></i>
                                                <?= $track->nama_kurir ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="kurir-unassigned">
                                                <i class="bi bi-person-x"></i> Belum
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <?= $track->updated_at ? date('d M Y H:i', strtotime($track->updated_at)) : '—' ?>
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url('admin/tracking/update/' . $track->id_tracking) ?>"
                                           class="btn-update">
                                            <i class="bi bi-pencil-square"></i> Kelola
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
</div>