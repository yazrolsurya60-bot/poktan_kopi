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
    background-color: #4a2f15;
    /* Warna cokelat tegas khas registrasi/tambah data */
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
    border-color: #4a2f15;
    box-shadow: 0 0 0 0.2rem rgba(74, 47, 21, 0.1);
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
</style>

<main id="main" class="main bg-light min-vh-100 pt-3">
    <div class="container-fluid animate__animated animate__fadeIn">

        <div class="mb-4">
            <h2 class="page-title mb-0">Registrasi Lahan Baru</h2>
            <div class="breadcrumb-custom">Dashboard &nbsp;/&nbsp; Manajemen Lahan &nbsp;/&nbsp; Tambah Lahan</div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card card-mockup shadow-sm">
                    <div class="card-header-custom">
                        <i class="bi bi-plus-circle-fill me-1"></i> Form Input Atribut Lahan Baru
                    </div>
                    <div class="card-body pt-4">
                        <form action="<?= base_url('petani/lahan/tambah') ?>" method="POST"
                            enctype="multipart/form-data">

                            <div class="mb-3">
                                <label class="form-label-custom">Nama Lahan / Kebun</label>
                                <input type="text" name="nama_lahan" class="form-control form-control-custom"
                                    placeholder="Contoh: Kebun Kopi Cikuray Blok B" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label-custom">Jenis Varietas Kopi</label>
                                <select name="jenis_kopi" class="form-select form-control-custom" required>
                                    <option value="" disabled selected>-- Pilih Varietas Kopi --</option>
                                    <option value="Arabika">Arabika</option>
                                    <option value="Robusta">Robusta</option>
                                    <option value="Liberika">Liberika</option>
                                    <option value="Excelsa">Excelsa</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label-custom">Luas Lahan (Hektar)</label>
                                <div class="input-group">
                                    <input type="number" step="0.01" name="luas"
                                        class="form-control form-control-custom" placeholder="Contoh: 2.5" required>
                                    <span
                                        class="input-group-text form-control-custom bg-light font-weight-bold d-flex align-items-center"
                                        style="border-radius: 0 8px 8px 0; border-left: none;">Ha</span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label-custom">Alamat Lengkap / Lokasi Fisik</label>
                                <textarea name="lokasi" class="form-control form-control-custom" rows="3"
                                    placeholder="Tuliskan alamat lengkap lokasi kebun kopi Anda..." required></textarea>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label class="form-label-custom"><i class="bi bi-geo-alt-fill text-danger"></i>
                                        Latitude</label>
                                    <input type="text" id="lat" name="latitude"
                                        class="form-control form-control-custom input-readonly-custom"
                                        placeholder="Klik pada peta..." readonly required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom"><i class="bi bi-geo-alt-fill text-danger"></i>
                                        Longitude</label>
                                    <input type="text" id="lng" name="longitude"
                                        class="form-control form-control-custom input-readonly-custom"
                                        placeholder="Klik pada peta..." readonly required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label-custom">Unggah Foto Fisik Lahan Kebun</label>
                                <input type="file" name="foto_lahan" class="form-control form-control-custom" required>
                                <small class="text-muted" style="font-size: 11px;"><i class="bi bi-info-circle"></i>
                                    Format yang didukung: JPG, JPEG, PNG.</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label-custom">Status Operasional Awal</label>
                                <select name="status_lahan" class="form-select form-control-custom">
                                    <option value="Aktif">Aktif (Siap Tanam / Produksi)</option>
                                    <option value="Nonaktif">Nonaktif (Masa Istirahat Tanah)</option>
                                    <option value="Tidak Produktif">Tidak Produktif / Rusak</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label-custom">Catatan Tambahan & Perawatan</label>
                                <textarea name="catatan" class="form-control form-control-custom" rows="2"
                                    placeholder="Tulis catatan kondisi tanah atau riwayat pemeliharaan (opsional)..."></textarea>
                            </div>

                            <div class="d-flex gap-2 border-top pt-3 justify-content-start">
                                <button type="submit" class="btn btn-mockup-primary px-4 me-2">
                                    <i class="bi bi-save-fill"></i> Simpan Lahan Baru
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
                        <i class="bi bi-globe-asia-australia text-warning"></i> Geotagging Penentuan Koordinat Spasial
                    </div>
                    <div class="card-body pt-4">
                        <div class="alert alert-warning border-0 mb-3"
                            style="background-color: #fffbeb; color: #b45309; font-size: 12px; border-radius: 8px;">
                            <i class="bi bi-info-circle-fill me-1"></i>
                            <strong>Panduan:</strong> Silakan cari lokasi kebun Anda pada peta di bawah, lalu
                            <strong>klik kiri langsung pada titik area kebun</strong>. Pin marker akan terpasang dan
                            nilai kolom koordinat di sisi kiri terisi otomatis.
                        </div>

                        <div id="mapTambahGeotag"
                            style="height: 560px; border-radius: 10px; border: 1px solid #e0e0e0;"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<link rel="stylesheet" href="<?= base_url('assets/leaflet/leaflet.css') ?>" />
<script src="<?= base_url('assets/leaflet/leaflet.js') ?>"></script>
<script>
// Koordinat default peta saat pertama kali dibuka (Tengah Indonesia)
var defaultLat = -2.5;
var defaultLng = 118.0;
var defaultZoom = 5;

// Render Peta
var map = L.map('mapTambahGeotag').setView([defaultLat, defaultLng], defaultZoom);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap & LiberChain Supply Chain Framework'
}).addTo(map);

// Penampung objek marker tunggal
var marker;

// Event menangkap klik peta untuk mengambil koordinat
map.on('click', function(e) {
    var latVal = e.latlng.lat.toFixed(6);
    var lngVal = e.latlng.lng.toFixed(6);

    // Memasukkan hasil koordinat ke dalam input form box kiri
    document.getElementById('lat').value = latVal;
    document.getElementById('lng').value = lngVal;

    // Plotting marker baru atau geser marker yang sudah ada
    if (marker) {
        marker.setLatLng(e.latlng);
    } else {
        marker = L.marker(e.latlng).addTo(map);
    }

    // Tampilkan balon info popup koordinat terpilih
    marker.bindPopup("<b style='color:#4a2f15;'>Titik Lahan Dipilih</b><br>Lat: " + latVal + "<br>Lng: " +
        lngVal).openPopup();
});
</script>