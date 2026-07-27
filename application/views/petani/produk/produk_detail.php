<style>
    .detail-card { background: var(--card-white); border: 1px solid rgba(74, 44, 17, 0.06); border-radius: var(--radius-card); box-shadow: var(--shadow-soft); overflow: hidden; }
    .detail-card .card-header-custom { padding: 20px 28px; border-bottom: 1px solid rgba(74, 44, 17, 0.06); background: var(--bg-cream); display: flex; align-items: center; justify-content: space-between; }
    .detail-card .card-header-custom h5 { font-weight: 700; color: var(--dark-coffee); margin: 0; }
    .detail-card .card-body-custom { padding: 28px; }
    .detail-group { margin-bottom: 20px; }
    .detail-group:last-child { margin-bottom: 0; }
    .detail-label { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; color: var(--text-secondary); letter-spacing: 0.7px; margin-bottom: 4px; }
    .detail-value { font-size: 1rem; font-weight: 600; color: var(--dark-coffee); padding: 8px 14px; background: var(--bg-cream); border-radius: 8px; border: 1px solid rgba(74, 44, 17, 0.06); }
    .detail-value .badge-status { padding: 6px 16px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; display: inline-block; }
    .badge-status.aktif { background: #D1FAE5; color: #065F46; }
    .badge-status.nonaktif { background: #FEE2E2; color: #991B1B; }
    .badge-info { background: var(--bg-cream); color: var(--text-secondary); padding: 6px 14px; border-radius: 6px; font-weight: 500; font-size: 0.85rem; }
    .detail-image { width: 100%; max-height: 300px; object-fit: cover; border-radius: 12px; box-shadow: var(--shadow-soft); border: 1px solid rgba(74, 44, 17, 0.06); }
    .btn-back { background: var(--bg-cream); color: var(--text-secondary); border: 1px solid rgba(74, 44, 17, 0.1); padding: 10px 24px; border-radius: 10px; font-weight: 600; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
    .btn-back:hover { background: #e8e0d8; color: var(--dark-coffee); text-decoration: none; }
    .btn-edit-detail { background: var(--amber-cream); color: white; border: none; padding: 10px 24px; border-radius: 10px; font-weight: 600; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
    .btn-edit-detail:hover { background: var(--roasted-brown); color: white; text-decoration: none; }
    .btn-delete-detail { background: #FEE2E2; color: #991B1B; border: none; padding: 10px 24px; border-radius: 10px; font-weight: 600; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
    .btn-delete-detail:hover { background: #991B1B; color: white; text-decoration: none; }
</style>

<!-- DETAIL CARD -->
<div class="detail-card">
    <div class="card-header-custom">
        <h5><i class="bi bi-info-circle-fill" style="color: var(--amber-cream);"></i> Informasi Produk</h5>
        <div class="d-flex gap-2" style="gap: 8px;">
            <a href="<?= base_url('petani/produk/edit/' . (isset($produk) ? $produk->id_produk : '')); ?>" class="btn-edit-detail">
                <i class="bi bi-pencil-square"></i> Edit
            </a>
            <a href="<?= base_url('petani/produk/hapus/' . (isset($produk) ? $produk->id_produk : '')); ?>" class="btn-delete-detail" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                <i class="bi bi-trash"></i> Hapus
            </a>
        </div>
    </div>
    <div class="card-body-custom">
        <div class="row">
            <!-- KOLOM KIRI: FOTO -->
            <div class="col-lg-4 mb-4 mb-lg-0">
                <?php if(isset($produk) && !empty($produk->foto_utama)) : ?>
                    <img src="<?= base_url('uploads/produk/'.$produk->foto_utama); ?>" alt="<?= $produk->nama_produk; ?>" class="detail-image">
                <?php else : ?>
                    <div style="width:100%; height:300px; background:var(--bg-cream); border-radius:12px; display:flex; align-items:center; justify-content:center; border:1px solid rgba(74,44,17,0.06); flex-direction:column; gap:10px;">
                        <i class="bi bi-image" style="font-size:3rem; color:var(--text-secondary); opacity:0.3;"></i>
                        <span class="text-muted" style="font-size:0.85rem;">Tidak ada foto</span>
                    </div>
                <?php endif; ?>
            </div>

            <!-- KOLOM KANAN: DETAIL -->
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="detail-group">
                            <div class="detail-label">Nama Produk</div>
                            <div class="detail-value"><?= isset($produk) ? $produk->nama_produk : '-'; ?></div>
                        </div>

                        <div class="detail-group">
                            <div class="detail-label">Jenis Kopi</div>
                            <div class="detail-value">
                                <span class="badge-info"><?= isset($produk) ? $produk->jenis_kopi : '-'; ?></span>
                            </div>
                        </div>

                        <div class="detail-group">
                            <div class="detail-label">Proses Pengolahan</div>
                            <div class="detail-value"><?= (isset($produk) && !empty($produk->proses)) ? $produk->proses : '<span class="text-muted">-</span>'; ?></div>
                        </div>

                        <div class="detail-group">
                            <div class="detail-label">Harga per Kilogram</div>
                            <div class="detail-value" style="color: var(--roasted-brown); font-weight: 700; font-size: 1.1rem;">
                                Rp <?= isset($produk) ? number_format($produk->harga, 0, ',', '.') : '0'; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="detail-group">
                            <div class="detail-label">Stok Tersedia</div>
                            <div class="detail-value">
                                <?= isset($produk) ? $produk->stok_produk : '0'; ?> <small style="color: var(--text-secondary);">kg</small>
                            </div>
                        </div>

                        <div class="detail-group">
                            <div class="detail-label">Total Pendapatan</div>
                            <div class="detail-value" style="color: var(--roasted-brown); font-weight: 700; font-size: 1.1rem;">
                                <?php
                                $harga = isset($produk) ? $produk->harga : 0;
                                $stok = isset($produk) ? $produk->stok_produk : 0;
                                $total = $harga * $stok;
                                echo 'Rp ' . number_format($total, 0, ',', '.');
                                ?>
                            </div>
                        </div>

                        <div class="detail-group">
                            <div class="detail-label">Altitude (Ketinggian Tanam)</div>
                            <div class="detail-value"><?= (isset($produk) && !empty($produk->altitude)) ? $produk->altitude : '<span class="text-muted">-</span>'; ?></div>
                        </div>

                        <div class="detail-group">
                            <div class="detail-label">Status Penjualan</div>
                            <div class="detail-value">
                                <?php
                                $status_text = isset($produk) ? ($produk->status_produk ?? 'Aktif') : 'Aktif';
                                $status_class = (strtolower($status_text) == 'nonaktif') ? 'nonaktif' : 'aktif';
                                ?>
                                <span class="badge-status <?= $status_class; ?>"><?= $status_text; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TOMBOL KEMBALI -->
        <div class="mt-4 pt-3 border-top" style="border-color: rgba(74,44,17,0.06); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
            <a href="<?= base_url('petani/produk'); ?>" class="btn-back">
                <i class="bi bi-arrow-left"></i> Kembali ke Katalog Produk
            </a>
            <div class="text-muted" style="font-size:0.75rem;">
                <i class="bi bi-clock"></i> ID Produk: #<?= isset($produk) ? $produk->id_produk : 'PROD-001'; ?>
            </div>
        </div>
    </div>
</div>
