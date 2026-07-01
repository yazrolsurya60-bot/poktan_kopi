<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4><i class="bi bi-pencil-square"></i> Update Status - #<?= $tracking->invoice ?></h4>
                    <p class="text-muted small">Update status pengiriman oleh Admin</p>
                </div>
                <div class="card-body">
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
                    <?php endif; ?>

                    <div class="alert alert-info">
                        <strong>Status Saat Ini:</strong> 
                        <span class="status-badge <?= $tracking->status_class ?>">
                            <i class="bi <?= $tracking->status_icon ?>"></i>
                            <?= $tracking->status_label ?>
                        </span>
                        <br>
                        <small class="text-muted">Invoice: #<?= $tracking->invoice ?> | Pembeli: <?= $tracking->pembeli_id ?></small>
                    </div>

                    <?php if (empty($status_options)): ?>
                        <div class="alert alert-warning">
                            <i class="bi bi-info-circle"></i> 
                            Tidak ada status selanjutnya yang tersedia. Pesanan sudah di status akhir.
                        </div>
                        <a href="<?= base_url('admin/tracking') ?>" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    <?php else: ?>
                        <form method="POST">
                            <div class="form-group">
                                <label for="status">Pilih Status Baru</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="">-- Pilih Status --</option>
                                    <?php foreach ($status_options as $opt): ?>
                                        <option value="<?= $opt['value'] ?>"><?= $opt['label'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Keterangan (Opsional)</label>
                                <textarea name="keterangan" id="keterangan" class="form-control" rows="3" 
                                          placeholder="Contoh: Barang sudah sampai di gudang distribusi..."></textarea>
                                <small class="text-muted">Keterangan akan muncul di riwayat tracking pembeli</small>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" 
                                        style="background: var(--roasted-brown, #4A2C11); border: none; border-radius:10px;">
                                    <i class="bi bi-save"></i> Update Status
                                </button>
                            </div>
                        </form>

                        <a href="<?= base_url('admin/tracking') ?>" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
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