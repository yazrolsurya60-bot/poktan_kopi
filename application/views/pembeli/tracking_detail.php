<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4><i class="bi bi-truck"></i> Detail Tracking #<?= $tracking->invoice ?></h4>
                        <span class="status-badge <?= $tracking->status_class ?>">
                            <i class="bi <?= $tracking->status_icon ?>"></i>
                            <?= $tracking->status_label ?>
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless">
                                <tr><td><strong>Invoice</strong></td><td>#<?= $tracking->invoice ?></td></tr>
                                <tr><td><strong>Total Bayar</strong></td><td>Rp <?= number_format($tracking->grand_total ?? $tracking->total_harga, 0, ',', '.') ?></td></tr>
                                <?php if ($tracking->nama_kurir): ?>
                                <tr><td><strong>Kurir</strong></td><td><?= $tracking->nama_kurir ?></td></tr>
                                <tr><td><strong>Telepon Kurir</strong></td><td><?= $tracking->kurir_telp ?></td></tr>
                                <?php endif; ?>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless">
                                <tr><td><strong>Tanggal Order</strong></td><td><?= date('d M Y H:i', strtotime($tracking->created_at)) ?></td></tr>
                                <?php if ($tracking->tanggal_kirim): ?>
                                <tr><td><strong>Tanggal Kirim</strong></td><td><?= date('d M Y H:i', strtotime($tracking->tanggal_kirim)) ?></td></tr>
                                <?php endif; ?>
                                <?php if ($tracking->estimasi): ?>
                                <tr><td><strong>Estimasi Tiba</strong></td><td><span class="text-success"><?= date('d M Y H:i', strtotime($tracking->estimasi)) ?></span></td></tr>
                                <?php endif; ?>
                                <tr><td><strong>Total Update</strong></td><td><?= $tracking->total_update ?> kali</td></tr>
                            </table>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5>Status Pengiriman</h5>
                        <div class="tracking-progress">
                            <?php 
                            $step_labels = ['Diproses', 'Dikirim', 'Dalam Perjalanan', 'Telah Dikirim', 'Diterima'];
                            $status_values = ['diproses', 'dikirim', 'dalam_perjalanan', 'delivered', 'diterima'];
                            $current_index = array_search($tracking->status_pengiriman, $status_values);
                            if ($current_index === false) $current_index = 0;
                            ?>
                            <div class="progress" style="height: 4px;">
                                <div class="progress-bar" role="progressbar" style="width: <?= ($current_index / (count($step_labels) - 1)) * 100 ?>%; background: var(--amber-cream, #E6A15C);"></div>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <?php foreach ($step_labels as $i => $label): ?>
                                    <div class="text-center <?= $i <= $current_index ? 'text-success' : 'text-muted' ?>">
                                        <div class="step-circle <?= $i == $current_index ? 'active' : '' ?> <?= $i < $current_index ? 'completed' : '' ?>">
                                            <?php if ($i < $current_index): ?>
                                                <i class="bi bi-check"></i>
                                            <?php else: ?>
                                                <?= $i + 1 ?>
                                            <?php endif; ?>
                                        </div>
                                        <small><?= $label ?></small>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>



                    <?php if (!empty($tracking->bukti_pengiriman)): ?>
                    <div class="mb-4">
                        <h5><i class="bi bi-file-earmark-check-fill"></i> Bukti Pengiriman</h5>
                        <div class="bukti-card p-3">
                            <?php 
                            $ext = strtolower(pathinfo($tracking->bukti_pengiriman, PATHINFO_EXTENSION));
                            if ($ext === 'pdf'): ?>
                                <div class="text-center py-3">
                                    <i class="bi bi-file-earmark-pdf-fill text-danger" style="font-size:3rem;"></i>
                                    <p class="mb-2 text-muted small mt-1"><?= $tracking->bukti_pengiriman ?></p>
                                    <a href="<?= base_url('assets/uploads/bukti_pengiriman/' . $tracking->bukti_pengiriman) ?>" target="_blank" class="btn btn-sm btn-outline-danger" style="border-radius:8px;">
                                        <i class="bi bi-eye"></i> Lihat PDF
                                    </a>
                                </div>
                            <?php else: ?>
                                <div class="text-center">
                                    <a href="<?= base_url('assets/uploads/bukti_pengiriman/' . $tracking->bukti_pengiriman) ?>" target="_blank">
                                        <img src="<?= base_url('assets/uploads/bukti_pengiriman/' . $tracking->bukti_pengiriman) ?>" class="img-fluid img-thumbnail shadow-sm" style="max-height:220px; border-radius:10px;" alt="Bukti Pengiriman">
                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($tracking->bukti_upload_at)): ?>
                            <p class="mt-2 mb-0 text-muted small text-center">
                                <i class="bi bi-clock"></i> Diupload: <?= date('d M Y H:i', strtotime($tracking->bukti_upload_at)) ?>
                            </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="mb-4">
                        <h5><i class="bi bi-clock-history"></i> Riwayat Tracking</h5>
                        <div class="timeline">
                            <?php foreach ($history as $h): ?>
                                <?php $status_info = $this->Tracking_model->get_status_label($h->status); ?>
                                <div class="timeline-item">
                                    <div class="timeline-marker <?= $status_info['class'] ?>"></div>
                                    <div class="timeline-content">
                                        <div class="d-flex justify-content-between">
                                            <strong><?= $status_info['label'] ?></strong>
                                            <small class="text-muted"><?= date('d M Y H:i', strtotime($h->created_at)) ?></small>
                                        </div>
                                        <?php if ($h->lokasi): ?>
                                            <p class="mb-0 text-muted"><i class="bi bi-geo-alt"></i> <?= $h->lokasi ?></p>
                                        <?php endif; ?>
                                        <?php if ($h->keterangan && stripos($h->keterangan, 'Status diperbarui oleh Admin') === false): ?>
                                            <p class="mb-0 small"><?= $h->keterangan ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <?php if ($tracking->status_pengiriman == 'delivered'): ?>
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> Pesanan telah tiba di alamat tujuan. Silakan konfirmasi penerimaan.
                        </div>
                        <form action="<?= base_url('pembeli/tracking/approve/' . $tracking->id_tracking) ?>" method="POST" class="d-inline">
                            <button type="submit" class="btn btn-success btn-lg" style="background: #10b981; border: none; border-radius:10px;">
                                <i class="bi bi-check2-circle"></i> Konfirmasi Barang Diterima
                            </button>
                        </form>
                    <?php endif; ?>
                    <a href="<?= base_url('pembeli/tracking') ?>" class="btn btn-secondary" style="border-radius:10px;"><i class="bi bi-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
:root { --roasted-brown: #4A2C11; --amber-cream: #E6A15C; --bg-cream: #FAF6F0; --card-white: #FFFFFF; --text-secondary: #70655E; --dark-coffee: #2C1808; }
body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-cream); color: var(--dark-coffee); }
.status-badge { padding: 4px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: 600; display: inline-flex; align-items: center; gap: 4px; }
.status-badge.pending { background: #FEF3C7; color: #92400E; }
.status-badge.processing { background: #DBEAFE; color: #1E40AF; }
.status-badge.delivery { background: #EDE9FE; color: #5B21B6; }
.status-badge.complete { background: #D1FAE5; color: #065F46; }
.status-badge.cancelled { background: #FEE2E2; color: #991B1B; }
.step-circle { width: 30px; height: 30px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 12px; font-weight: bold; margin: 0 auto; transition: all 0.3s; background: #E5E7EB; color: #6B7280; }
.step-circle.active { background: var(--amber-cream); color: white; box-shadow: 0 0 0 4px rgba(230, 161, 92, 0.3); }
.step-circle.completed { background: #D1FAE5; color: #065F46; }
.timeline { position: relative; padding-left: 30px; }
.timeline-item { position: relative; padding-bottom: 20px; border-left: 2px solid #dee2e6; padding-left: 20px; }
.timeline-item:last-child { border-left: none; }
.timeline-marker { position: absolute; left: -8px; width: 14px; height: 14px; border-radius: 50%; border: 2px solid #fff; }
.timeline-marker.pending { background: #FEF3C7; box-shadow: 0 0 0 2px #FEF3C7; }
.timeline-marker.processing { background: #DBEAFE; box-shadow: 0 0 0 2px #DBEAFE; }
.timeline-marker.delivery { background: #EDE9FE; box-shadow: 0 0 0 2px #EDE9FE; }
.timeline-marker.complete { background: #D1FAE5; box-shadow: 0 0 0 2px #D1FAE5; }
.timeline-marker.cancelled { background: #FEE2E2; box-shadow: 0 0 0 2px #FEE2E2; }
.timeline-content { background: var(--card-white); padding: 10px 14px; border-radius: 8px; border: 1px solid rgba(74,44,17,0.06); transition: all 0.3s; }
.timeline-content:hover { border-color: var(--amber-cream); box-shadow: 0 8px 30px rgba(44,24,8,0.08); }
.bukti-card { background: #FAF6F0; border-radius: 12px; border: 1px solid rgba(74,44,17,0.08); }
</style>