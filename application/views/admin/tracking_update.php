<style>
:root {
    --roasted-brown: #4A2C11;
    --dark-coffee:   #2C1808;
    --amber-cream:   #E6A15C;
    --bg-cream:      #FAF6F0;
    --card-white:    #FFFFFF;
}
body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg-cream); color: var(--dark-coffee); }

.page-card {
    background: var(--card-white);
    border-radius: 16px;
    box-shadow: 0 4px 24px rgba(44,24,8,0.08);
    border: 1px solid rgba(74,44,17,0.07);
    margin-bottom: 24px;
    overflow: hidden;
}
.page-card .card-head {
    padding: 18px 22px 14px;
    border-bottom: 1px solid rgba(74,44,17,0.07);
    display: flex;
    align-items: center;
    gap: 12px;
}
.head-icon {
    width: 40px; height: 40px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
}
.head-icon.brown  { background: rgba(74,44,17,0.10); color: var(--roasted-brown); }
.head-icon.amber  { background: rgba(230,161,92,0.18); color: var(--amber-cream); }
.head-icon.blue   { background: #EFF6FF; color: #2563EB; }
.head-icon.green  { background: #D1FAE5; color: #059669; }

.page-card .card-body { padding: 22px; }

/* Status timeline pill */
.status-pill {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 6px 14px; border-radius: 20px;
    font-size: 0.78rem; font-weight: 700;
}
.status-pill.pending      { background: #FEF3C7; color: #92400E; }
.status-pill.processing   { background: #DBEAFE; color: #1E40AF; }
.status-pill.delivery     { background: #EDE9FE; color: #5B21B6; }
.status-pill.complete     { background: #D1FAE5; color: #065F46; }
.status-pill.cancelled    { background: #FEE2E2; color: #991B1B; }

/* Info grid */
.info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
.info-item label { font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; color: #9CA3AF; display: block; margin-bottom: 3px; }
.info-item span  { font-size: 0.9rem; font-weight: 600; color: var(--dark-coffee); }

/* Form elements */
.form-control { border-radius: 10px; border: 1.5px solid rgba(74,44,17,0.12); padding: 10px 14px; font-size: 0.88rem; transition: border-color .2s; }
.form-control:focus { border-color: var(--amber-cream); box-shadow: 0 0 0 3px rgba(230,161,92,0.12); outline: none; }
.form-select { border-radius: 10px; border: 1.5px solid rgba(74,44,17,0.12); padding: 10px 14px; font-size: 0.88rem; transition: border-color .2s; width: 100%; appearance: none; background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%234A2C11' d='M6 8L1 3h10z'/%3E%3C/svg%3E") no-repeat right 14px center; }

.btn-coffee {
    background: var(--roasted-brown); color: #fff; border: none;
    border-radius: 10px; padding: 11px 20px; font-weight: 700; font-size: 0.88rem;
    transition: all .25s; cursor: pointer; display: inline-flex; align-items: center; gap: 7px;
}
.btn-coffee:hover { background: var(--dark-coffee); transform: translateY(-1px); box-shadow: 0 6px 16px rgba(44,24,8,0.18); }

.btn-amber {
    background: var(--amber-cream); color: #2C1808; border: none;
    border-radius: 10px; padding: 11px 20px; font-weight: 700; font-size: 0.88rem;
    transition: all .25s; cursor: pointer; display: inline-flex; align-items: center; gap: 7px;
}
.btn-amber:hover { filter: brightness(0.92); transform: translateY(-1px); box-shadow: 0 6px 16px rgba(230,161,92,0.3); }

.btn-back {
    background: #F3F4F6; color: #374151; border: none;
    border-radius: 10px; padding: 10px 18px; font-weight: 600; font-size: 0.85rem;
    text-decoration: none; display: inline-flex; align-items: center; gap: 6px;
    transition: background .2s;
}
.btn-back:hover { background: #E5E7EB; text-decoration: none; color: #374151; }

/* Kurir option card */
.kurir-radio { display: none; }
.kurir-label {
    display: flex; align-items: center; gap: 12px;
    border: 1.5px solid rgba(74,44,17,0.10);
    border-radius: 12px; padding: 12px 16px;
    cursor: pointer; transition: all .2s;
    margin-bottom: 8px;
}
.kurir-label:hover { border-color: var(--amber-cream); background: rgba(230,161,92,0.05); }
.kurir-radio:checked + .kurir-label { border-color: var(--roasted-brown); background: rgba(74,44,17,0.04); }
.kurir-avatar {
    width: 38px; height: 38px; border-radius: 50%;
    background: linear-gradient(135deg, var(--roasted-brown), var(--amber-cream));
    color: #fff; display: flex; align-items: center; justify-content: center;
    font-weight: 800; font-size: 0.9rem; flex-shrink: 0;
}
.kurir-info { flex: 1; }
.kurir-info strong { display: block; font-size: 0.88rem; color: var(--dark-coffee); }
.kurir-info small  { color: #9CA3AF; font-size: 0.75rem; }
.kurir-check { color: var(--amber-cream); font-size: 1rem; opacity: 0; transition: opacity .2s; }
.kurir-radio:checked + .kurir-label .kurir-check { opacity: 1; }

/* Currently assigned badge */
.assigned-badge {
    display: inline-flex; align-items: center; gap: 6px;
    background: #D1FAE5; color: #065F46;
    padding: 6px 12px; border-radius: 8px;
    font-size: 0.8rem; font-weight: 700;
}

/* Alert overrides */
.alert { border-radius: 12px; font-size: 0.87rem; }
</style>

<div class="container-fluid" style="max-width: 960px;">

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill mr-2"></i><?= $this->session->flashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle-fill mr-2"></i><?= $this->session->flashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    <?php endif; ?>

    <!-- ===== HEADER INFO ===== -->
    <div class="page-card">
        <div class="card-head">
            <div class="head-icon brown"><i class="bi bi-box-seam"></i></div>
            <div>
                <h5 class="mb-0 font-weight-bold" style="color:var(--dark-coffee);">Detail Pengiriman — #<?= $tracking->invoice ?></h5>
                <small class="text-muted">Update status &amp; assign kurir untuk pesanan ini</small>
            </div>
        </div>
        <div class="card-body">
            <div class="info-grid">
                <div class="info-item">
                    <label>Invoice</label>
                    <span>#<?= $tracking->invoice ?></span>
                </div>
                <div class="info-item">
                    <label>Status Saat Ini</label>
                    <span>
                        <span class="status-pill <?= $tracking->status_class ?? 'pending' ?>">
                            <i class="bi <?= $tracking->status_icon ?? 'bi-clock' ?>"></i>
                            <?= $tracking->status_label ?? ucfirst($tracking->status_pengiriman) ?>
                        </span>
                    </span>
                </div>
                <div class="info-item">
                    <label>Kurir Saat Ini</label>
                    <span>
                        <?php if (!empty($tracking->nama_kurir)): ?>
                            <span class="assigned-badge">
                                <i class="bi bi-person-check-fill"></i>
                                <?= $tracking->nama_kurir ?>
                            </span>
                        <?php else: ?>
                            <span class="text-muted">— Belum ada kurir —</span>
                        <?php endif; ?>
                    </span>
                </div>
                <div class="info-item">
                    <label>Terakhir Diupdate</label>
                    <span><?= $tracking->updated_at ? date('d M Y H:i', strtotime($tracking->updated_at)) : '—' ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- ===== ASSIGN KURIR ===== -->
        <div class="col-md-5">
            <div class="page-card">
                <div class="card-head">
                    <div class="head-icon amber"><i class="bi bi-person-badge-fill"></i></div>
                    <div>
                        <h6 class="mb-0 font-weight-bold">Tugaskan Kurir</h6>
                        <small class="text-muted">Pilih kurir untuk mengantar pesanan</small>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (!empty($kurir_list)): ?>
                        <form method="POST" action="<?= base_url('admin/tracking/update/' . $tracking->id_tracking) ?>">
                            <input type="hidden" name="action" value="assign_kurir">
                            <div style="max-height: 320px; overflow-y: auto; padding-right: 4px;">
                                <?php foreach ($kurir_list as $k): ?>
                                    <input type="radio" name="id_kurir" id="kurir_<?= $k->id_kurir ?>"
                                           value="<?= $k->id_kurir ?>" class="kurir-radio"
                                           <?= ($tracking->id_kurir == $k->id_kurir) ? 'checked' : '' ?>>
                                    <label for="kurir_<?= $k->id_kurir ?>" class="kurir-label">
                                        <div class="kurir-avatar"><?= strtoupper(substr($k->nama_kurir, 0, 1)) ?></div>
                                        <div class="kurir-info">
                                            <strong><?= $k->nama_kurir ?></strong>
                                            <small><?= $k->email ?? $k->no_telepon ?? '-' ?></small>
                                        </div>
                                        <i class="bi bi-check-circle-fill kurir-check"></i>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                            <button type="submit" class="btn-amber mt-3 w-100" style="justify-content:center;">
                                <i class="bi bi-person-check"></i> Tugaskan Kurir
                            </button>
                        </form>
                    <?php else: ?>
                        <div class="text-center py-4 text-muted">
                            <i class="bi bi-people" style="font-size:2rem;"></i>
                            <p class="mt-2 small">Tidak ada kurir aktif yang tersedia.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- ===== UPDATE STATUS ===== -->
        <div class="col-md-7">
            <div class="page-card">
                <div class="card-head">
                    <div class="head-icon blue"><i class="bi bi-arrow-repeat"></i></div>
                    <div>
                        <h6 class="mb-0 font-weight-bold">Update Status Pengiriman</h6>
                        <small class="text-muted">Ubah status sesuai alur pengiriman</small>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (!empty($status_options)): ?>
                        <form method="POST" action="<?= base_url('admin/tracking/update/' . $tracking->id_tracking) ?>">
                            <input type="hidden" name="action" value="update_status">

                            <div class="form-group">
                                <label class="font-weight-bold small text-muted text-uppercase" style="letter-spacing:.05em;">Status Baru</label>
                                <select name="status" class="form-select" required>
                                    <option value="">— Pilih Status —</option>
                                    <?php foreach ($status_options as $opt): ?>
                                        <option value="<?= $opt['value'] ?>"><?= $opt['label'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold small text-muted text-uppercase" style="letter-spacing:.05em;">Keterangan <span class="text-muted font-weight-normal">(opsional)</span></label>
                                <textarea name="keterangan" class="form-control" rows="3"
                                    placeholder="Contoh: Barang sedang diproses di gudang..."></textarea>
                                <small class="text-muted">Akan tampil di halaman tracking pembeli.</small>
                            </div>

                            <!-- Status Flow Visual -->
                            <div class="p-3 mb-3" style="background:#FAF6F0; border-radius:10px; border:1px solid rgba(74,44,17,0.07);">
                                <small class="text-muted font-weight-bold d-block mb-2">
                                    <i class="bi bi-diagram-3 mr-1"></i> Alur Status Pengiriman
                                </small>
                                <div style="font-size:0.72rem; color:#6B7280; line-height:1.8;">
                                    Pending → Diproses → Dikirim → Dalam Perjalanan →
                                    Tiba di Kota Tujuan → Telah Dikirim → Diterima
                                </div>
                            </div>

                            <button type="submit" class="btn-coffee w-100" style="justify-content:center;">
                                <i class="bi bi-save2"></i> Simpan Update Status
                            </button>
                        </form>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="bi bi-check-circle-fill text-success" style="font-size:2.5rem;"></i>
                            <p class="mt-2 text-muted">Pesanan sudah di status akhir.<br>Tidak ada status lanjutan yang tersedia.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div><!-- /.row -->

    <!-- Back button -->
    <div class="mb-4">
        <a href="<?= base_url('admin/tracking') ?>" class="btn-back">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Tracking
        </a>
    </div>

</div><!-- /.container-fluid -->