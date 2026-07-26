<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    .custom-card { border-radius: 15px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); border: none; }
    .form-label-custom { font-weight: 600; color: #333; margin-bottom: 8px; font-size: 0.9rem;}
    
    /* PERBAIKAN: Penyesuaian agar dropdown tidak terpotong */
    .form-control-custom { 
        padding: 12px; 
        border-radius: 10px; 
        border: 1px solid #ddd; 
        font-size: 0.9rem;
        height: auto !important; 
    }
    select.form-control-custom {
        padding: 12px 30px 12px 12px !important;
    }

    #map { height: 350px; width: 100%; border-radius: 15px; border: 2px solid #ddd; display: block; }
</style>

<div class="card custom-card p-4 mb-4">
    <form action="<?= base_url('petani/lahan/update') ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_lahan" value="<?= htmlspecialchars($lahan['id_lahan']) ?>">

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="form-group mb-3">
                    <label class="form-label-custom">Nama Lahan</label>
                    <input type="text" name="nama_lahan" class="form-control form-control-custom" value="<?= htmlspecialchars($lahan['nama_lahan']) ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label-custom">Jenis Kopi</label>
                    <select name="jenis_kopi" class="form-control form-control-custom" required>
                        <option value="Robusta" <?= ($lahan['jenis_kopi'] == 'Robusta') ? 'selected' : '' ?>>Robusta</option>
                        <option value="Arabika" <?= ($lahan['jenis_kopi'] == 'Arabika') ? 'selected' : '' ?>>Arabika</option>
                        <option value="Liberika" <?= ($lahan['jenis_kopi'] == 'Liberika') ? 'selected' : '' ?>>Liberika</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label-custom">Jenis Tanah</label>
                    <input type="text" name="jenis_tanah" class="form-control form-control-custom" value="<?= isset($lahan['jenis_tanah']) ? htmlspecialchars($lahan['jenis_tanah']) : '' ?>" placeholder="Contoh: Gambut, Aluvial" required>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label-custom">Luas Lahan (Ha)</label>
                    <input type="number" step="0.01" name="luas" class="form-control form-control-custom" value="<?= htmlspecialchars($lahan['luas']) ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label-custom">Foto Lahan <small class="text-muted">(Kosongkan jika tidak ganti)</small></label>
                    <input type="file" name="foto_lahan" class="form-control-file p-2 border rounded w-100">
                    <div class="mt-2 small text-muted">File saat ini: <?= htmlspecialchars($lahan['foto_lahan'] ?: 'Tidak ada foto') ?></div>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label-custom">Status</label>
                    <select name="status_lahan" class="form-control form-control-custom" required>
                        <option value="Active" <?= (strtolower($lahan['status_lahan']) == 'active') ? 'selected' : '' ?>>Active</option>
                        <option value="Inactive" <?= (strtolower($lahan['status_lahan']) == 'inactive') ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label-custom">Catatan</label>
                    <textarea name="catatan" class="form-control form-control-custom" rows="2"><?= isset($lahan['catatan']) ? htmlspecialchars($lahan['catatan']) : '' ?></textarea>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group mb-3">
                    <label class="form-label-custom">Lokasi / Alamat</label>
                    <textarea name="lokasi" class="form-control form-control-custom" rows="2" required><?= htmlspecialchars($lahan['lokasi']) ?></textarea>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label-custom">Peta Lokasi</label>
                    <div id="map"></div>
                </div>
                <div class="row">
                    <div class="col-6 form-group">
                        <input type="text" name="latitude" id="lat" class="form-control form-control-custom bg-light" value="<?= htmlspecialchars($lahan['latitude']) ?>" readonly required>
                    </div>
                    <div class="col-6 form-group">
                        <input type="text" name="longitude" id="lng" class="form-control form-control-custom bg-light" value="<?= htmlspecialchars($lahan['longitude']) ?>" readonly required>
                    </div>
                </div>
            </div>
        </div>

        <hr class="mt-4 border-light">
        <div class="d-flex justify-content-end mt-3">
            <a href="<?= base_url('petani/lahan') ?>" class="btn btn-light border mr-2 font-weight-bold" style="border-radius: 10px; padding: 10px 25px;">Batal</a>
            <button type="submit" class="btn btn-warning text-white font-weight-bold" style="border-radius: 10px; padding: 10px 25px;">Update Lahan</button>
        </div>
    </form>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var lat = <?= !empty($lahan['latitude']) ? $lahan['latitude'] : -1.3129 ?>;
        var lng = <?= !empty($lahan['longitude']) ? $lahan['longitude'] : 109.3090 ?>;
        
        var map = L.map('map').setView([lat, lng], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '© OpenStreetMap' }).addTo(map);

        var marker = L.marker([lat, lng]).addTo(map);

        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            document.getElementById('lat').value = e.latlng.lat;
            document.getElementById('lng').value = e.latlng.lng;
        });

        setTimeout(function() { map.invalidateSize(); }, 300);
    });
</script>