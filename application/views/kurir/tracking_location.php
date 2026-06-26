<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4><i class="bi bi-geo-alt"></i> Update Lokasi - #<?= $tracking->invoice ?></h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i> Update lokasi Anda secara real-time untuk memberikan informasi
                        akurat kepada pembeli.
                    </div>
                    <div id="locationMap" style="height: 400px; width: 100%; border-radius: 8px; margin-bottom: 20px;">
                    </div>
                    <form method="POST" id="locationForm"
                        action="<?= base_url('kurir/tracking/update_location/' . $tracking->id_tracking) ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="latitude">Latitude</label>
                                    <input type="text" name="latitude" id="latitude" class="form-control"
                                        placeholder="Contoh: -6.200000" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="longitude">Longitude</label>
                                    <input type="text" name="longitude" id="longitude" class="form-control"
                                        placeholder="Contoh: 106.816666" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lokasi">Nama Lokasi (Opsional)</label>
                            <input type="text" name="lokasi" id="lokasi" class="form-control"
                                placeholder="Contoh: Gudang Distribusi Jakarta">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-warning" onclick="getCurrentLocation()"
                                style="border-radius:10px;"><i class="bi bi-satellite"></i> Ambil Lokasi Saat
                                Ini</button>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block"
                            style="background: var(--roasted-brown, #4A2C11); border: none; border-radius:10px;"><i
                                class="bi bi-save"></i> Update Lokasi</button>
                    </form>
                    <a href="<?= base_url('petani/tracking/') ?>" class="btn btn-secondary mt-3"
                        style="border-radius:10px;"><i class="bi bi-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    let map, marker;
    document.addEventListener('DOMContentLoaded', function () {
        const defaultLat = -6.200000;
        const defaultLng = 106.816666;
        map = L.map('locationMap').setView([defaultLat, defaultLng], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map).bindPopup('Lokasi Anda saat ini');
        marker.on('dragend', function (e) {
            const pos = marker.getLatLng();
            document.getElementById('latitude').value = pos.lat.toFixed(8);
            document.getElementById('longitude').value = pos.lng.toFixed(8);
        });
        map.on('click', function (e) {
            const latlng = e.latlng;
            marker.setLatLng(latlng);
            document.getElementById('latitude').value = latlng.lat.toFixed(8);
            document.getElementById('longitude').value = latlng.lng.toFixed(8);
        });
    });

    function getCurrentLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    document.getElementById('latitude').value = lat.toFixed(8);
                    document.getElementById('longitude').value = lng.toFixed(8);
                    marker.setLatLng([lat, lng]);
                    map.setView([lat, lng], 15);
                },
                function (error) { alert('Gagal mengambil lokasi: ' + error.message); }
            );
        } else { alert('Browser tidak mendukung geolocation.'); }
    }

    // Tidak perlu AJAX, form akan submit biasa ke update_location
</script>