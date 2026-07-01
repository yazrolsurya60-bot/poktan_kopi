<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Lahan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
    .custom-card {
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        border: none;
    }

    .form-label-custom {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .form-control-custom {
        padding: 12px;
        border-radius: 10px;
        border: 1px solid #ddd;
    }

    /* FIX: Pastikan map memiliki display block dan ukuran yang tegas */
    #map {
        height: 300px;
        width: 100%;
        border-radius: 15px;
        border: 2px solid #ddd;
        display: block;
    }
    </style>
</head>

<body>

    <div class="container py-5">
        <div class="card custom-card p-4">
            <h4 class="fw-bold mb-4">Edit Data Lahan</h4>
            <form action="<?= base_url('petani/lahan/update') ?>" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="id_lahan" value="<?= htmlspecialchars($lahan['id_lahan']) ?>">

                <div class="row g-4">
                    <!-- KOLOM KIRI -->
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label-custom">Nama Lahan</label>
                            <input type="text" name="nama_lahan" class="form-control form-control-custom"
                                value="<?= htmlspecialchars($lahan['nama_lahan']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Jenis Kopi</label>
                            <select name="jenis_kopi" class="form-select form-control-custom" required>
                                <option value="Robusta" <?= ($lahan['jenis_kopi'] == 'Robusta') ? 'selected' : '' ?>>
                                    Robusta</option>
                                <option value="Arabika" <?= ($lahan['jenis_kopi'] == 'Arabika') ? 'selected' : '' ?>>
                                    Arabika</option>
                                <option value="Liberika" <?= ($lahan['jenis_kopi'] == 'Liberika') ? 'selected' : '' ?>>
                                    Liberika</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">Jenis Tanah</label>
                            <input type="text" name="jenis_tanah" class="form-control form-control-custom"
                                value="<?= isset($lahan['jenis_tanah']) ? htmlspecialchars($lahan['jenis_tanah']) : '' ?>"
                                placeholder="Contoh: Gambut, Aluvial, Podsolik" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">Luas Lahan (Ha)</label>
                            <input type="number" step="0.01" name="luas" class="form-control form-control-custom"
                                value="<?= htmlspecialchars($lahan['luas']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">Foto Lahan (Kosongkan jika tidak ganti)</label>
                            <input type="file" name="foto_lahan" class="form-control form-control-custom">
                            <small class="text-muted">File saat ini:
                                <?= htmlspecialchars($lahan['foto_lahan'] ?: 'Tidak ada foto') ?></small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">Status</label>
                            <select name="status_lahan" class="form-select form-control-custom" required>
                                <option value="Active" <?= ($lahan['status_lahan'] == 'Active') ? 'selected' : '' ?>>
                                    Active</option>
                                <option value="Inactive"
                                    <?= ($lahan['status_lahan'] == 'Inactive') ? 'selected' : '' ?>>Inactive</option>
                            </select>
                        </div>

                        <!-- INPUT CATATAN (Diletakkan di bawah status sesuai form tambah) -->
                        <div class="mb-3">
                            <label class="form-label-custom">Catatan</label>
                            <textarea name="catatan" class="form-control form-control-custom" rows="3"
                                placeholder="Masukkan catatan tambahan"><?= isset($lahan['catatan']) ? htmlspecialchars($lahan['catatan']) : '' ?></textarea>
                        </div>
                    </div>

                    <!-- KOLOM KANAN -->
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label-custom">Lokasi / Alamat</label>
                            <textarea name="lokasi" class="form-control form-control-custom" rows="2"
                                required><?= htmlspecialchars($lahan['lokasi']) ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Peta Lokasi</label>
                            <div id="map"></div>
                        </div>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="text" name="latitude" id="lat" class="form-control form-control-custom"
                                    value="<?= htmlspecialchars($lahan['latitude']) ?>" readonly required>
                            </div>
                            <div class="col-6">
                                <input type="text" name="longitude" id="lng" class="form-control form-control-custom"
                                    value="<?= htmlspecialchars($lahan['longitude']) ?>" readonly required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-4">
                    <a href="<?= base_url('petani/lahan') ?>" class="btn btn-light"
                        style="border-radius: 10px; padding: 10px 20px;">Batal</a>
                    <button type="submit" class="btn btn-primary"
                        style="border-radius: 10px; padding: 10px 20px;">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var lat = <?= !empty($lahan['latitude']) ? $lahan['latitude'] : -2.5489 ?>;
        var lng = <?= !empty($lahan['longitude']) ? $lahan['longitude'] : 118.0149 ?>;

        var map = L.map('map').setView([lat, lng], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        var marker = L.marker([lat, lng]).addTo(map);

        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            document.getElementById('lat').value = e.latlng.lat;
            document.getElementById('lng').value = e.latlng.lng;
        });

        setTimeout(function() {
            map.invalidateSize();
        }, 300);
    });
    </script>
</body>

</html>