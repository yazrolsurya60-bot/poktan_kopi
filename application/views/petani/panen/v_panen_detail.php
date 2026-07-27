<style>
    .custom-card { border-radius: 14px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.05); background: #fff; }
    .card-header-custom { padding: 18px 24px; border-bottom: 1px solid rgba(74, 44, 17, 0.06); font-weight: 700; color: #2C1808; font-size: 0.95rem; }
    .card-body-custom { padding: 24px; }
    
    .detail-row { border-bottom: 1px dashed rgba(74, 44, 17, 0.1); padding-bottom: 12px; margin-bottom: 12px; }
    .detail-label { font-size: 0.75rem; color: #70655E; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 4px; }
    .detail-value { font-size: 0.95rem; font-weight: 600; color: #2C1808; }
    .foto-box { background: #f8f9fa; border: 1px solid #edf2f7; border-radius: 12px; padding: 10px; }
    .foto-box img { width: 100%; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); object-fit: cover; }
</style>

<div class="mb-3">
    <a href="<?= base_url('petani/panen'); ?>" class="btn btn-light border font-weight-bold" style="border-radius: 10px;"><i class="bi bi-arrow-left mr-1"></i> Kembali</a>
</div>

<div class="custom-card">
    <div class="card-header-custom">
        <i class="bi bi-info-circle mr-2 text-warning"></i> Informasi Lengkap Panen
    </div>
    <div class="card-body-custom">
        <div class="row">
            <div class="col-lg-7 pr-lg-4">
                <div class="detail-row">
                    <div class="detail-label">Tanggal Panen</div>
                    <div class="detail-value text-dark"><?= date('d F Y', strtotime($panen['tanggal_panen'])); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Nama Lahan & Lokasi</div>
                    <div class="detail-value">
                        <?= htmlspecialchars($panen['nama_lahan'] ?? '-'); ?> 
                        <br><small class="text-muted font-weight-normal"><i class="bi bi-geo-alt"></i> <?= htmlspecialchars($panen['lokasi'] ?? '-'); ?></small>
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Jumlah Hasil Panen</div>
                    <div class="detail-value text-success" style="font-size: 1.5rem; font-weight: 800;">
                        <?= number_format($panen['jumlah_panen'], 0, ',', '.'); ?> <small class="text-muted" style="font-size:0.9rem;">Kg</small>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Catatan Tambahan</div>
                    <div class="detail-value text-secondary" style="font-weight: 500; font-size: 0.9rem; line-height: 1.6;">
                        <?= !empty($panen['catatan']) ? nl2br(htmlspecialchars($panen['catatan'])) : '<i class="text-light-muted font-weight-normal">Tidak ada catatan</i>'; ?>
                    </div>
                </div>
                <div class="detail-row" style="border:none;">
                    <div class="detail-label">Waktu Pencatatan Sistem</div>
                    <div class="detail-value text-muted" style="font-size: 0.8rem; font-weight: 400;">
                        <?= date('d F Y - H:i:s', strtotime($panen['created_at'])); ?>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-5 mt-4 mt-lg-0 border-left pl-lg-4">
                <div class="detail-label mb-2"><i class="bi bi-image mr-1"></i> Foto Dokumentasi Panen</div>
                <div class="foto-box text-center">
                    <?php if ($panen['foto_panen']): ?>
                        <img src="<?= base_url('uploads/panen/'.$panen['foto_panen']); ?>" alt="Foto Panen">
                    <?php else: ?>
                        <div class="py-5">
                            <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2 mb-0 small">Belum ada foto yang diunggah.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>