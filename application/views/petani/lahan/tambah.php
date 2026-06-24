<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Lahan Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
    body {
        background-color: #f8f9fa;
    }

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

    .form-control-custom,
    .form-select-custom {
        padding: 12px;
        border-radius: 10px;
        border: 1px solid #ddd;
    }

    .btn-save {
        background-color: #2e7d32;
        color: white;
        border-radius: 10px;
        padding: 10px 30px;
    }

    .btn-cancel {
        border-radius: 10px;
        padding: 10px 30px;
        border: 1px solid #ddd;
        background: #fff;
    }

    #map {
        height: 300px;
        border-radius: 15px;
        border: 2px solid #ddd;
    }

    .map-instruction {
        font-size: 0.85rem;
        color: #666;
        margin-top: 5px;
    }
    </style>
</head>

<body>

    <div class="container py-5">
        <div class="card custom-card p-4">
            <h4 class="fw-bold mb-4">Tambah Data Lahan</h4>
            <form action="<?= base_url('petani/lahan/tambah') ?>" method="POST" enctype="multipart/form-data">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label-custom">Nama Lahan *</label>
                            <input type="text" name="nama_lahan" class="form-control form-control-custom"
                                placeholder="Masukkan nama lahan" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Jenis Kopi *</label>
                            <select name="jenis_kopi" class="form-select form-select-custom" required>
                                <option value="" disabled selected>Pilih jenis kopi</option>
                                <option value="Robusta">Robusta</option>
                                <option value="Arabika">Arabika</option>
                                <option value="Liberika">Liberika</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Luas Lahan (Ha) *</label>
                            <input type="number" step="0.01" name="luas" class="form-control form-control-custom"
                                placeholder="Contoh: 2.50" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Foto Lahan</label>
                            <input type="file" name="foto_lahan" class="form-control form-control-custom"
                                accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Status *</label>
                            <select name="status_lahan" class="form-select form-select-custom" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Catatan</label>
                            <textarea name="catatan" class="form-control form-control-custom" rows="2"
                                placeholder="Masukkan catatan tambahan"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label-custom">Lokasi / Alamat *</label>
                            <textarea name="lokasi" class="form-control form-control-custom" rows="2"
                                placeholder="Masukkan alamat lengkap" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Peta Lokasi *</label>
                            <div id="map"></div>
                            <div class="map-instruction text-primary fw-bold">Klik pada peta untuk menentukan koordinat
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="text" name="latitude" id="lat" class="form-control form-control-custom"
                                    placeholder="Latitude" readonly required>
                            </div>
                            <div class="col-6">
                                <input type="text" name="longitude" id="lng" class="form-control form-control-custom"
                                    placeholder="Longitude" readonly required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-3 mt-4">
                    <a href="<?= base_url('petani/lahan') ?>" class="btn btn-cancel">Batal</a>
                    <button type="submit" class="btn btn-save">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
    var map = L.map('map').setView([-2.5489, 118.0149], 5);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(map);

    var marker;
    map.on('click', function(e) {
        if (marker) {
            map.removeLayer(marker);
        }
        marker = L.marker(e.latlng).addTo(map);
        document.getElementById('lat').value = e.latlng.lat;
        document.getElementById('lng').value = e.latlng.lng;
    });
    </script>
</body>

</html>