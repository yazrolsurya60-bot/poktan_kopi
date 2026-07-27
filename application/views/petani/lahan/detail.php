<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    .detail-card { background: #ffffff; border-radius: 20px; padding: 25px; box-shadow: var(--shadow-soft); border: 1px solid rgba(74, 44, 17, 0.06); }
    .image-wrapper { width: 100%; height: 320px; border-radius: 15px; overflow: hidden; margin-bottom: 25px; border: 1px solid #edf2f7; }
    .image-wrapper img { width: 100%; height: 100%; object-fit: cover; }
    .label-text { color: var(--text-secondary); font-size: 0.85rem; display: block; margin-bottom: 4px; font-weight: 500; }
    .value-text { color: var(--dark-coffee); font-weight: 700; font-size: 1rem; }
    .status-pill { background: #d1fae5; color: #065f46; padding: 6px 16px; border-radius: 20px; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; }
    .status-pill.inactive { background: #fff3e0; color: #e65100; }
    #map-detail { width: 100%; height: 300px; border-radius: 15px; border: 1px solid #e2e8f0; margin-top: 10px; z-index: 1; }
    
    .table-panen th { background: #f8f9fa; border-top:none; font-size:0.85rem; text-transform: uppercase; color:var(--text-secondary); }
    .table-panen td { border-bottom: 1px solid #edf2f7; vertical-align: middle; }
</style>

<div class="row">
    <div class="col-lg-12">
        <a href="<?= base_url('petani/lahan') ?>" class="btn btn-light font-weight-bold mb-3 border" style="border-radius:10px;"><i class="bi bi-arrow-left mr-1"></i> Kembali ke Daftar Lahan</a>
    </div>

    <div class="col-lg-12">
        <div class="detail-card mb-4">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="font-weight-bold mb-0 text-coffee-primary"><?= htmlspecialchars($lahan['nama_lahan']) ?></h3>
                <span class="status-pill <?= strtolower($lahan['status_lahan']) == 'inactive' ? 'inactive' : '' ?>"><?= htmlspecialchars($lahan['status_lahan']) ?></span>
            </div>

            <div class="row">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <div class="image-wrapper">
                        <?php if(!empty($lahan['foto_lahan'])): ?>
                            <img src="<?= base_url('assets/uploads/lahan/'.$lahan['foto_lahan']) ?>" alt="Foto Lahan">
                        <?php else: ?>
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light text-muted">
                                <div><i class="bi bi-image" style="font-size:3rem;"></i><br>Tidak ada foto</div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="row mb-4">
                        <div class="col-sm-6 mb-3">
                            <span class="label-text">Jenis Kopi</span>
                            <span class="value-text"><i class="bi bi-cup-hot-fill text-warning mr-1"></i> <?= htmlspecialchars($lahan['jenis_kopi']) ?></span>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <span class="label-text">Jenis Tanah</span>
                            <span class="value-text"><?= !empty($lahan['jenis_tanah']) ? htmlspecialchars($lahan['jenis_tanah']) : '-' ?></span>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <span class="label-text">Luas Lahan</span>
                            <span class="value-text"><?= htmlspecialchars($lahan['luas']) ?> Ha</span>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <span class="label-text">Koordinat (Lat, Lng)</span>
                            <span class="value-text text-info"><?= htmlspecialchars($lahan['latitude']) ?>, <?= htmlspecialchars($lahan['longitude']) ?></span>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="label-text">Lokasi/Alamat Lengkap</span>
                            <span class="value-text" style="font-size:0.95rem; font-weight:600;"><?= htmlspecialchars($lahan['lokasi']) ?></span>
                        </div>
                    </div>

                    <div class="border-top pt-3">
                        <span class="label-text">Catatan Tambahan Lahan</span>
                        <p class="text-muted" style="line-height: 1.6; font-size:0.9rem;">
                            <?= !empty($lahan['catatan']) ? htmlspecialchars($lahan['catatan']) : '<i class="text-light-muted">Tidak ada catatan tambahan.</i>' ?>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="row mt-4 border-top pt-4">
                <div class="col-lg-6 mb-4">
                    <h5 class="font-weight-bold mb-3"><i class="bi bi-map text-secondary mr-2"></i> Peta Lokasi Lahan</h5>
                    <div id="map-detail"></div>
                </div>
                <div class="col-lg-6">
                    <h5 class="font-weight-bold mb-3"><i class="bi bi-clock-history text-secondary mr-2"></i> Riwayat Panen Terakhir</h5>
                    <div class="table-responsive">
                        <table class="table table-panen">
                            <thead>
                                <tr>
                                    <th>Tanggal Panen</th>
                                    <th>Hasil (Kg)</th>
                                    <th>Kualitas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($riwayat_panen)): ?>
                                    <?php foreach($riwayat_panen as $p): ?>
                                    <tr>
                                        <td class="font-weight-bold text-dark"><?= date('d M Y', strtotime($p->tanggal_panen)); ?></td>
                                        <td><span class="badge bg-light text-dark px-2 border"><?= htmlspecialchars($p->jumlah_panen); ?> kg</span></td>
                                        <td><span class="badge <?= strtolower($p->kualitas) == 'a' ? 'badge-success' : 'badge-warning' ?>"><?= htmlspecialchars($p->kualitas); ?></span></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-muted border">Belum ada riwayat panen tercatat pada lahan ini.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var lat = <?= !empty($lahan['latitude']) ? $lahan['latitude'] : 0 ?>;
        var lng = <?= !empty($lahan['longitude']) ? $lahan['longitude'] : 0 ?>;
        
        var map = L.map('map-detail').setView([lat, lng], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '© OpenStreetMap' }).addTo(map);
        
        L.marker([lat, lng]).addTo(map).bindPopup("<b><?= htmlspecialchars(addslashes($lahan['nama_lahan'])) ?></b>").openPopup();
        
        setTimeout(function() { map.invalidateSize(); }, 300);
    });
</script>