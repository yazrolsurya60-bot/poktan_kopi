<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    .custom-card { border-radius: 15px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); border: none; }
    .form-label-custom { font-weight: 600; color: #333; margin-bottom: 8px; font-size: 0.9rem; }
    
    /* PERBAIKAN: Tambahkan height: auto !important agar dropdown tidak terpotong */
    .form-control-custom, .form-select-custom { 
        padding: 12px; 
        border-radius: 10px; 
        border: 1px solid #ddd; 
        font-size: 0.9rem;
        height: auto !important; 
    }
    
    /* Sedikit penyesuaian padding khusus select agar panah dropdown tidak terlalu mepet */
    select.form-control-custom, select.form-select-custom {
        padding: 12px 30px 12px 12px !important;
    }

    .btn-save { background-color: var(--roasted-brown); color: white; border-radius: 10px; padding: 10px 30px; font-weight: 600; }
    .btn-save:hover { background-color: var(--dark-coffee); color: white; }
    .btn-cancel { border-radius: 10px; padding: 10px 30px; border: 1px solid #ddd; background: #fff; font-weight: 600; }
    #map { height: 350px; border-radius: 15px; border: 2px solid #ddd; width: 100%; display: block; }
    .map-instruction { font-size: 0.85rem; color: #666; margin-top: 8px; }
</style>

<div class="card custom-card p-4 mb-4">
    <form action="<?= base_url('petani/lahan/tambah') ?>" method="POST" enctype="multipart/form-data">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="form-group mb-3">
                    <label class="form-label-custom">Nama Lahan *</label>
                    <input type="text" name="nama_lahan" class="form-control form-control-custom" placeholder="Masukkan nama lahan" required>
                </div>
                
                <div class="form-group mb-3">
                    <label class="form-label-custom">Jenis Kopi *</label>
                    <select name="jenis_kopi" class="form-control form-select-custom" required>
                        <option value="" disabled selected>Pilih jenis kopi</option>
                        <option value="Robusta">Robusta</option>
                        <option value="Arabika">Arabika</option>
                        <option value="Liberika">Liberika</option>
                    </select>
                </div>
                
                <div class="form-group mb-3">
                    <label class="form-label-custom">Jenis Tanah *</label>
                    <input type="text" name="jenis_tanah" class="form-control form-control-custom" placeholder="Contoh: Gambut, Aluvial, Podsolik" required>
                </div>
                
                <div class="form-group mb-3">
                    <label class="form-label-custom">Luas Lahan (Ha) *</label>
                    <input type="number" step="0.01" name="luas" class="form-control form-control-custom" placeholder="Contoh: 2.50" required>
                </div>
                
                <div class="form-group mb-3">
                    <label class="form-label-custom">Foto Lahan</label>
                    <input type="file" name="foto_lahan" class="form-control-file p-2 border rounded w-100" accept="image/*">
                </div>
                
                <div class="form-group mb-3">
                    <label class="form-label-custom">Status *</label>
                    <select name="status_lahan" class="form-control form-select-custom" required>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
                
                <div class="form-group mb-3">
                    <label class="form-label-custom">Catatan Tambahan</label>
                    <textarea name="catatan" class="form-control form-control-custom" rows="2" placeholder="Masukkan catatan..."></textarea>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group mb-3">
                    <label class="form-label-custom">Lokasi / Alamat *</label>
                    <textarea name="lokasi" class="form-control form-control-custom" rows="2" placeholder="Masukkan alamat lengkap" required></textarea>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label-custom">Peta Lokasi *</label>
                    <div id="map"></div>
                    <div class="map-instruction text-primary font-weight-bold"><i class="bi bi-info-circle mr-1"></i> Klik pada area peta untuk menentukan letak koordinat lahan.</div>
                </div>
                <div class="row">
                    <div class="col-6 form-group">
                        <label class="form-label-custom text-muted small">Latitude</label>
                        <input type="text" name="latitude" id="lat" class="form-control form-control-custom bg-light" placeholder="Latitude" readonly required>
                    </div>
                    <div class="col-6 form-group">
                        <label class="form-label-custom text-muted small">Longitude</label>
                        <input type="text" name="longitude" id="lng" class="form-control form-control-custom bg-light" placeholder="Longitude" readonly required>
                    </div>
                </div>
            </div>
        </div>
        <hr class="mt-4 border-light">
        <div class="d-flex justify-content-end mt-3">
            <a href="<?= base_url('petani/lahan') ?>" class="btn btn-cancel mr-2">Batal</a>
            <button type="submit" class="btn btn-save">Simpan Lahan</button>
        </div>
    </form>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Koordinat default (Sambas/Kalbar)
        var map = L.map('map').setView([-1.3129, 109.3090], 10); 
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '© OpenStreetMap' }).addTo(map);

        var marker;
        map.on('click', function(e) {
            if (marker) { map.removeLayer(marker); }
            marker = L.marker(e.latlng).addTo(map);
            document.getElementById('lat').value = e.latlng.lat;
            document.getElementById('lng').value = e.latlng.lng;
        });

        // Memastikan ukuran peta di-render penuh setelah CSS dimuat
        setTimeout(function() { map.invalidateSize(); }, 300);
    });
</script>