<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Lahan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
    :root {
        --roasted-brown: #4A2C11;
        --dark-coffee: #2C1808;
        --amber-cream: #E6A15C;
        --bg-cream: #FAF6F0;
        --card-white: #FFFFFF;
        --text-secondary: #70655E;
        --sidebar-width: 260px;
        --shadow-soft: 0 8px 30px rgba(44, 24, 8, 0.08);
        --shadow-hover: 0 12px 40px rgba(44, 24, 8, 0.15);
        --radius-card: 14px;
        --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--bg-cream);
        color: var(--dark-coffee);
        overflow-x: hidden;
    }

    /* --- SIDEBAR PREMIUM PREMIUM --- */
    .sidebar {
        width: var(--sidebar-width);
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        background: linear-gradient(180deg, var(--dark-coffee) 0%, #1a0e04 100%);
        color: var(--bg-cream);
        z-index: 100;
        transition: var(--transition-smooth);
        box-shadow: 4px 0 25px rgba(44, 24, 8, 0.2);
        display: flex;
        flex-direction: column;
    }

    .sidebar-brand {
        padding: 28px 24px 20px;
        font-size: 1.1rem;
        font-weight: 700;
        border-bottom: 1px solid rgba(250, 246, 240, 0.08);
        color: var(--amber-cream);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .sidebar-brand .brand-icon {
        width: 40px;
        height: 40px;
        background: rgba(230, 161, 92, 0.15);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
    }

    .sidebar-menu-wrapper {
        flex: 1;
        overflow-y: auto;
        padding: 15px 0;
    }

    .sidebar-menu {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .menu-item a {
        display: flex;
        align-items: center;
        padding: 12px 24px;
        color: #A8988A;
        font-weight: 500;
        font-size: 0.9rem;
        text-decoration: none;
        transition: var(--transition-smooth);
        position: relative;
        margin: 2px 10px;
        border-radius: 10px;
    }

    .menu-item a i {
        font-size: 1.15rem;
        margin-right: 14px;
        width: 22px;
        text-align: center;
    }

    .menu-item a:hover {
        color: #ffffff;
        background: rgba(230, 161, 92, 0.12);
        text-decoration: none;
    }

    .menu-item.active a {
        color: #ffffff;
        background: rgba(230, 161, 92, 0.18);
    }

    .menu-item.active a::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 3px;
        height: 24px;
        background: var(--amber-cream);
        border-radius: 0 3px 3px 0;
    }

    .sidebar-footer {
        padding: 16px 20px;
        border-top: 1px solid rgba(250, 246, 240, 0.06);
        margin-top: auto;
    }

    .sidebar-footer .btn-logout {
        width: 100%;
        padding: 10px 16px;
        border: 1px solid rgba(250, 246, 240, 0.1);
        border-radius: 10px;
        background: transparent;
        color: #A8988A;
        font-weight: 500;
        font-size: 0.85rem;
        transition: var(--transition-smooth);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        cursor: pointer;
    }

    .sidebar-footer .btn-logout:hover {
        background: rgba(230, 161, 92, 0.1);
        color: #ffffff;
        border-color: rgba(230, 161, 92, 0.2);
        text-decoration: none;
    }

    /* --- STYLING KONTEN UTAMA --- */
    .main-content {
        margin-left: var(--sidebar-width);
        padding: 30px 40px 40px;
        min-height: 100vh;
        transition: var(--transition-smooth);
    }

    .text-coffee-primary { color: #241408; }

    /* Custom Form */
    .custom-card {
        border-radius: var(--radius-card);
        box-shadow: var(--shadow-soft);
        border: none;
    }

    .form-label-custom {
        font-weight: 600;
        color: #4A2C11;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    .form-control-custom,
    .form-select-custom {
        padding: 12px;
        border-radius: 10px;
        border: 1px solid #e0d6ce;
        background-color: #fdfcfb;
        color: #4A2C11;
    }
    
    .form-control-custom:focus,
    .form-select-custom:focus {
        border-color: #E6A15C;
        box-shadow: 0 0 0 0.2rem rgba(230, 161, 92, 0.25);
    }

    .btn-save {
        background-color: #E6A15C;
        color: #fff;
        border-radius: 10px;
        padding: 10px 30px;
        font-weight: 600;
    }
    
    .btn-save:hover {
        background-color: #d8904d;
        color: white;
    }

    .btn-cancel {
        border-radius: 10px;
        padding: 10px 30px;
        border: 1px solid #ddd;
        background: #fff;
        color: #666;
        font-weight: 600;
    }

    #map {
        height: 300px;
        border-radius: 15px;
        border: 2px solid #e0d6ce;
        width: 100%;
        display: block;
    }

    .map-instruction {
        font-size: 0.85rem;
        color: #E6A15C;
        margin-top: 8px;
    }

    /* SIDEBAR OVERLAY UNTUK RESPONSIVE */
    .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.4);
        z-index: 99;
    }

    .sidebar-overlay.active {
        display: block;
    }

    @media (max-width: 991.98px) {
        .sidebar {
            left: calc(-1 * var(--sidebar-width));
            box-shadow: none;
        }

        .sidebar.open {
            left: 0;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.3);
        }

        .main-content {
            margin-left: 0;
            padding: 20px 16px 30px;
        }
    }
    </style>
</head>

<body>

    <!-- SIDEBAR OVERLAY -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebarMenu">
        <div class="sidebar-brand">
            <div class="brand-icon">
                <i class="bi bi-patch-check-fill"></i>
            </div>
            <span>PETANI <br><small style="font-weight:400; font-size:0.7rem; color:#A8988A;">Liberchain</small></span>
        </div>

        <div class="sidebar-menu-wrapper">
            <ul class="sidebar-menu">
                <li class="menu-item <?= ($this->uri->segment(2) == 'dashboard' || $this->uri->segment(2) == '') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/dashboard'); ?>"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
                </li>
                <li class="menu-item <?= ($this->uri->segment(2) == 'lahan') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/lahan'); ?>"><i class="bi bi-geo-alt-fill"></i> Kelola Lahan</a>
                </li>
                <li class="menu-item <?= ($this->uri->segment(2) == 'panen') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/panen'); ?>"><i class="bi bi-textarea-rose"></i> Manajemen Panen</a>
                </li>
                <li class="menu-item <?= ($this->uri->segment(2) == 'produk') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/produk'); ?>"><i class="bi bi-box-seam"></i> Katalog Produk</a>
                </li>
                <li class="menu-item <?= ($this->uri->segment(2) == 'transaksi') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/transaksi'); ?>"><i class="bi bi-cart-check-fill"></i> Pesanan Masuk</a>
                </li>
                <li class="menu-item <?= ($this->uri->segment(2) == 'tracking') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/tracking'); ?>"><i class="bi bi-truck"></i> Tracking Kiriman</a>
                </li>
                <li class="menu-item <?= ($this->uri->segment(2) == 'laporan') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/laporan'); ?>"><i class="bi bi-file-earmark-bar-graph-fill"></i> Laporan</a>
                </li>
            </ul>
        </div>

        <div class="sidebar-footer">
            <button class="btn-logout" onclick="window.location.href='<?= base_url('auth/logout'); ?>'">
                <i class="bi bi-box-arrow-right"></i> Keluar
            </button>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle"
                    style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
                    <i class="bi bi-list"></i>
                </button>
                <h3 class="font-weight-bold text-coffee-primary d-inline-block align-middle mb-1"
                    style="letter-spacing: -0.5px;">Edit Data Lahan</h3>
                <p class="text-muted small mb-0">Dashboard / Kelola Lahan / Edit</p>
            </div>
            <div>
                <a href="<?= base_url('petani/lahan'); ?>" class="btn btn-sm btn-outline-secondary" style="border-radius: 8px;">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card custom-card p-4">
            <form action="<?= base_url('petani/lahan/update') ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_lahan" value="<?= htmlspecialchars($lahan['id_lahan']) ?>">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label-custom">Nama Lahan *</label>
                            <input type="text" name="nama_lahan" class="form-control form-control-custom"
                                value="<?= htmlspecialchars($lahan['nama_lahan']) ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label-custom">Jenis Kopi *</label>
                            <select name="jenis_kopi" class="form-control form-select-custom" required>
                                <option value="Robusta" <?= ($lahan['jenis_kopi'] == 'Robusta') ? 'selected' : '' ?>>Robusta</option>
                                <option value="Arabika" <?= ($lahan['jenis_kopi'] == 'Arabika') ? 'selected' : '' ?>>Arabika</option>
                                <option value="Liberika" <?= ($lahan['jenis_kopi'] == 'Liberika') ? 'selected' : '' ?>>Liberika</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label-custom">Luas Lahan (Ha) *</label>
                            <input type="number" step="0.01" name="luas" class="form-control form-control-custom"
                                value="<?= htmlspecialchars($lahan['luas']) ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label-custom">Foto Lahan (Kosongkan jika tidak diganti)</label>
                            <div class="custom-file mb-2">
                                <input type="file" name="foto_lahan" class="custom-file-input" id="fotoLahan" accept="image/*">
                                <label class="custom-file-label form-control-custom" for="fotoLahan" style="padding-top: 10px; height: 48px;">Pilih file baru...</label>
                            </div>
                            <?php if(!empty($lahan['foto_lahan'])): ?>
                                <small class="text-muted d-block mt-1">File saat ini: <a href="<?= base_url('assets/uploads/lahan/'.$lahan['foto_lahan']) ?>" target="_blank" class="text-warning"><?= htmlspecialchars($lahan['foto_lahan']) ?></a></small>
                            <?php endif; ?>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label-custom">Status *</label>
                            <select name="status_lahan" class="form-control form-select-custom" required>
                                <option value="Active" <?= ($lahan['status_lahan'] == 'Active' || $lahan['status_lahan'] == 'aktif') ? 'selected' : '' ?>>Active</option>
                                <option value="Inactive" <?= ($lahan['status_lahan'] == 'Inactive' || $lahan['status_lahan'] == 'nonaktif') ? 'selected' : '' ?>>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label-custom">Catatan Perawatan</label>
                            <textarea name="catatan" class="form-control form-control-custom" rows="3"><?= htmlspecialchars($lahan['catatan'] ?? '') ?></textarea>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label-custom">Lokasi / Alamat Lengkap *</label>
                            <textarea name="lokasi" class="form-control form-control-custom" rows="2"
                                required><?= htmlspecialchars($lahan['lokasi']) ?></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label-custom">Titik Peta Lokasi (Leaflet JS) *</label>
                            <div id="map"></div>
                            <div class="map-instruction fw-bold"><i class="fas fa-hand-pointer mr-1"></i> Klik atau geser penanda di peta untuk memperbarui koordinat.</div>
                        </div>
                        <div class="form-row">
                            <div class="col-6 form-group">
                                <input type="text" name="latitude" id="lat" class="form-control form-control-custom bg-light"
                                    value="<?= htmlspecialchars($lahan['latitude']) ?>" readonly required>
                            </div>
                            <div class="col-6 form-group">
                                <input type="text" name="longitude" id="lng" class="form-control form-control-custom bg-light"
                                    value="<?= htmlspecialchars($lahan['longitude']) ?>" readonly required>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr style="border-color: #f0e6dd; margin: 30px 0 20px;">
                <div class="d-flex justify-content-end">
                    <a href="<?= base_url('petani/lahan') ?>" class="btn btn-cancel mr-2">Batal</a>
                    <button type="submit" class="btn btn-save"><i class="fas fa-save mr-1"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <script>
    // Script ganti nama label file input
    $('.custom-file-input').on('change', function() { 
        let fileName = $(this).val().split('\\').pop(); 
        $(this).next('.custom-file-label').addClass("selected").html(fileName); 
    });

    document.addEventListener("DOMContentLoaded", function() {
        // Ambil koordinat dari database, gunakan default jika kosong
        var lat = <?= !empty($lahan['latitude']) ? $lahan['latitude'] : -2.5489 ?>;
        var lng = <?= !empty($lahan['longitude']) ? $lahan['longitude'] : 118.0149 ?>;

        var map = L.map('map').setView([lat, lng], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        var marker = L.marker([lat, lng], {draggable: true}).addTo(map);
        
        // Update koordinat saat marker digeser
        marker.on('dragend', function(e) {
            var position = marker.getLatLng();
            document.getElementById('lat').value = position.lat;
            document.getElementById('lng').value = position.lng;
        });

        // Update koordinat saat peta diklik
        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            document.getElementById('lat').value = e.latlng.lat;
            document.getElementById('lng').value = e.latlng.lng;
        });

        // FORCE RENDER
        setTimeout(function() {
            map.invalidateSize();
        }, 300);
    });

    // Responsive Sidebar
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarMenu = document.getElementById('sidebarMenu');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            sidebarMenu.classList.toggle('open');
            sidebarOverlay.classList.toggle('active');
        });
    }
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', function() {
            sidebarMenu.classList.remove('open');
            sidebarOverlay.classList.remove('active');
        });
    }
    </script>
</body>

</html>