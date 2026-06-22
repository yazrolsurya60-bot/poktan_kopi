<style>
/* --- CSS THEME LOG LOGIC MOCKUP (EARTH TONE) --- */
.page-title {
    font-weight: 700;
    color: #111111;
    font-size: 24px;
}

.breadcrumb-custom {
    font-size: 13px;
    color: #6c757d;
}

/* --- PREMIUM CARD DESIGN --- */
.card-mockup {
    background: #ffffff;
    border: 1px solid #e0e0e0;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.01);
}

.card-mockup .card-header-custom {
    background-color: #b97a29;
    /* Warna aksen cokelat emas penanda edit data */
    color: #ffffff;
    font-weight: 600;
    font-size: 15px;
    border-radius: 11px 11px 0 0;
    padding: 12px 20px;
}

/* --- FORM ELEMENTS --- */
.form-label-custom {
    color: #333333;
    font-weight: 600;
    font-size: 13px;
    margin-bottom: 6px;
}

.form-control-custom {
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    padding: 10px 14px;
    color: #333333;
    font-size: 13px;
    height: auto;
}

.form-control-custom:focus {
    border-color: #b97a29;
    box-shadow: 0 0 0 0.2rem rgba(185, 122, 41, 0.1);
}

.input-readonly-custom {
    background-color: #f8f9fa !important;
    font-family: monospace;
    font-weight: bold;
    color: #4a2f15;
}

/* --- BUTTONS --- */
.btn-mockup-primary {
    background-color: #4a2f15;
    color: #ffffff;
    border-radius: 8px;
    padding: 10px 20px;
    font-size: 13px;
    font-weight: 600;
    border: none;
    transition: all 0.2s ease;
}

.btn-mockup-primary:hover {
    background-color: #2b1b0c;
    color: #ffffff;
}

.btn-mockup-secondary {
    background-color: #ffffff;
    color: #333333;
    border-radius: 8px;
    padding: 10px 20px;
    font-size: 13px;
    font-weight: 600;
    border: 1px solid #e0e0e0;
    transition: all 0.2s ease;
}

.btn-mockup-secondary:hover {
    background-color: #f8f9fa;
    color: #111111;
    text-decoration: none;
}

/* --- PREVIEW IMAGE BOX --- */
.preview-box {
    border: 1px dashed #d9c3b0;
    border-radius: 8px;
    padding: 8px;
    background-color: #fdfbf9;
    max-width: 180px;
}
</style>

<main id="main" class="main bg-light min-vh-100 pt-3">
    <div class="container-fluid animate__animated animate__fadeIn">

        <div class="mb-4">
            <h2 class="page-title mb-0">Ubah Data Lahan Kebun</h2>
            <div class="breadcrumb-custom">Dashboard &nbsp;/&nbsp; Manajemen Lahan &nbsp;/&nbsp; Edit Lahan</div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card card-mockup shadow-sm">
                    <div class="card-header-custom">
                        <i class="bi bi-pencil-square me-1"></i> Form Modifikasi Atribut Lahan (ID:
                        #<?= $lahan['id_lahan'] ?>)
                    </div>
                    <div class="card-body pt-4">
                        <form action="<?= base_url('petani/lahan/edit/'.$lahan['id_lahan']) ?>" method="POST"
                            enctype="multipart/form-data">

                            <div class="mb-3">
                                <label class="form-label-custom">Nama Lahan / Kebun</label>
                                <input type="text" name="nama_lahan" class="form-control form-control-custom"
                                    value="<?= set_value('nama_lahan', $lahan['nama_lahan']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label-custom">Jenis Varietas Kopi</label>
                                <select name="jenis_kopi" class="form-select form-control-custom" required>
                                    <option value="Arabika" <?= $lahan['jenis_kopi'] == 'Arabika' ? 'selected' : '' ?>>
                                        Arabika</option>
                                    <option value="Robusta" <?= $lahan['jenis_kopi'] == 'Robusta' ? 'selected' : '' ?>>
                                        Robusta</option>
                                    <option value="Liberika"
                                        <?= $lahan['jenis_kopi'] == 'Liberika' ? 'selected' : '' ?>>Liberika</option>
                                    <option value="Excelsa" <?= $lahan['jenis_kopi'] == 'Excelsa' ? 'selected' : '' ?>>
                                        Excelsa</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label-custom">Luas Lahan (Hektar)</label>
                                <div class="input-group">
                                    <input type="number" step="0.01" name="luas"
                                        class="form-control form-control-custom"
                                        value="<?= set_value('luas', $lahan['luas']) ?>" required>
                                    <span
                                        class="input-group-text form-control-custom bg-light font-weight-bold d-flex align-items-center"
                                        style="border-radius: 0 8px 8px 0; border-left: none;">Ha</span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label-custom">Alamat Lengkap / Lokasi Fisik</label>
                                <textarea name="lokasi" class="form-control form-control-custom" rows="3"
                                    required><?= set_value('lokasi', $lahan['lokasi']) ?></textarea>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label class="form-label-custom"><i class="bi bi-geo-alt-fill text-danger"></i>
                                        Latitude</label>
                                    <input type="text" id="lat" name="latitude"
                                        class="form-control form-control-custom input-readonly-custom"
                                        value="<?= $lahan['latitude'] ?>" readonly required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom"><i class="bi bi-geo-alt-fill text-danger"></i>
                                        Longitude</label>
                                    <input type="text" id="lng" name="longitude"
                                        class="form-control form-control-custom input-readonly-custom"
                                        value="<?= $lahan['longitude'] ?>" readonly required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label-custom">Foto Fisik Lahan Saat Ini</label>
                                <div class="mb-2 preview-box">
                                    <?php if(!empty($lahan['foto_lahan'])): ?>
                                    <img src="<?= base_url('uploads/lahan/'.$lahan['foto_lahan']); ?>"
                                        class="img-fluid rounded shadow-sm" alt="Preview">
                                    <?php else: ?>
                                    <span class="text-muted small d-block p-2 text-center">Belum ada foto</span>
                                    <?php endif; ?>
                                </div>
                                <label class="form-label-custom mt-2">Ganti Foto Baru (Kosongkan jika tidak
                                    diubah)</label>
                                <input type="file" name="foto_lahan" class="form-control form-control-custom">
                            </div>

                            <div class="mb-3">
                                <label class="form-label-custom">Status Operasional Lahan</label>
                                <select name="status_lahan" class="form-select form-control-custom">
                                    <option value="Aktif" <?= $lahan['status_lahan'] == 'Aktif' ? 'selected' : '' ?>>
                                        Aktif (Siap Tanam / Produksi)</option>
                                    <option value="Nonaktif"
                                        <?= $lahan['status_lahan'] == 'Nonaktif' ? 'selected' : '' ?>>Nonaktif (Masa
                                        Istirahat Tanah)</option>
                                    <option value="Tidak Produktif"
                                        <?= $lahan['status_lahan'] == 'Tidak Produktif' ? 'selected' : '' ?>>Tidak
                                        Produktif / Rusak</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label-custom">Catatan Tambahan & Perawatan</label>
                                <textarea name="catatan" class="form-control form-control-custom" rows="2"
                                    placeholder="Catatan kondisi tanah saat ini..."><?= set_value('catatan', isset($lahan['catatan']) ? $lahan['catatan'] : '') ?></textarea>
                            </div>

                            <div class="d-flex gap-2 border-top pt-3 justify-content-start">
                                <button type="submit" class="btn btn-mockup-primary px-4 me-2">
                                    <i class="bi bi-check-circle-fill"></i> Perbarui Data Lahan
                                </button>
                                <a href="<?= base_url('petani/lahan') ?>" class="btn btn-mockup-secondary px-4">
                                    Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card card-mockup h-100 shadow-sm">
                    <div class="card-header-custom" style="background-color: #2b1b0c;">
                        <i class="bi bi-globe-asia-australia text-warning"></i> Geser Pin Peta Untuk Mengubah Lokasi
                        Spasial Lahan
                    </div>
                    <div class="card-body pt-4">
                        <div class="alert alert-info border-0 mb-3"
                            style="background-color: #f0f7ff; color: #004085; font-size: 12px; border-radius: 8px;">
                            <i class="bi bi-info-circle-fill me-1"></i>
                            <strong>Petunjuk:</strong> Peta di bawah otomatis memuat lokasi koordinat lama Anda. Untuk
                            memperbaruinya, silakan <strong>klik pada lokasi baru di peta</strong> untuk memindahkan
                            penanda pin.
                        </div>

                        <div id="mapEditGeotag" style="height: 560px; border-radius: 10px; border: 1px solid #e0e0e0;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<link class="stylesheet" href="<?= base_url('assets/leaflet/leaflet.css') ?>" />
<script src="<?= base_url('assets/leaflet/leaflet.js') ?>"></script>
<script>
// Membaca koordinat lama dari database lahan
var oldLat = <?= !empty($lahan['latitude']) ? $lahan['latitude'] : '-2.5' ?>;
var oldLng = <?= !empty($lahan['longitude']) ? $lahan['longitude'] : '118.0' ?>;
var currentZoom = <?= !empty($lahan['latitude']) ? '15' : '5' ?>;

// Inisialisasi Peta
var map = L.map('mapEditGeotag').setView([oldLat, oldLng], currentZoom);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap & LiberChain Supply Chain'
}).addTo(map);

// Taruh penanda marker default di posisi koordinat lama
var marker;
if ("<?= $lahan['latitude'] ?>" !== "" && "<?= $lahan['longitude'] ?>" !== "") {
    marker = L.marker([oldLat, oldLng]).addTo(map);
    marker.bindPopup("<b style='color:#b97a29;'>Posisi Lahan Saat Ini</b>").openPopup();
}

// Event listener click pada peta untuk memperbarui titik koordinat spasial
map.on('click', function(e) {
    var newLat = e.latlng.lat.toFixed(6);
    var newLng = e.latlng.lng.toFixed(6);

    // Memperbarui nilai pada input form box kiri
    document.getElementById('lat').value = newLat;
    document.getElementById('lng').value = newLng;

    // Pindahkan posisi pin marker ke area klik yang baru
    if (marker) {
        marker.setLatLng(e.latlng);
    } else {
        marker = L.marker(e.latlng).addTo(map);
    }

    // Tampilkan informasi popup titik baru
    marker.bindPopup("<b style='color:#4a2f15;'>Koordinat Baru Dipilih</b><br>Lat: " + newLat + "<br>Lng: " +
        newLng).openPopup();
});
</script>