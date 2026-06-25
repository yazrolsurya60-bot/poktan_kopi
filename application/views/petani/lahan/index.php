<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Menggunakan Bootstrap Icons agar seirama dengan v_dashboard.php -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Tetap menyertakan FontAwesome jika konten utama tabel/aksi masih membutuhkannya -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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

    /* --- SIDEBAR PREMIUM PREMIUM (Selaras 100% dengan v_dashboard) --- */
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

    .menu-item a .menu-badge {
        margin-left: auto;
        background: rgba(230, 161, 92, 0.2);
        color: var(--amber-cream);
        font-size: 0.7rem;
        padding: 2px 10px;
        border-radius: 20px;
        font-weight: 600;
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

    .sidebar-heading {
        color: #735a47;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 16px 24px 8px 24px;
    }

    /* Sidebar Footer - Tombol Keluar Premium */
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

    .text-coffee-primary {
        color: #241408;
    }

    .bg-success-light {
        background-color: #e8f5e9 !important;
    }

    .bg-danger-light {
        background-color: #ffebee !important;
    }

    .bg-warning-light {
        background-color: #fff3e0 !important;
    }

    .bg-info-light {
        background-color: #e3f2fd !important;
    }

    .text-orange {
        color: #f57c00 !important;
    }

    .bg-orange-light {
        background-color: #fff3e0 !important;
    }

    /* Customisasi Table Modern */
    .table-modern thead th {
        background-color: #f8f9fa;
        color: #6c757d;
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #edf2f7 !important;
        border-top: none !important;
    }

    .table-modern tbody td {
        border-bottom: 1px solid #edf2f7 !important;
        color: #495057;
        font-size: 0.9rem;
    }

    .table-modern tbody tr:hover {
        background-color: #fdfcfb;
    }

    .btn-action {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        font-size: 0.85rem;
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
                <!-- DASHBOARD (Tidak aktif jika sedang di halaman lahan) -->
                <li
                    class="menu-item <?= ($this->uri->segment(2) == 'dashboard' || $this->uri->segment(2) == '') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/dashboard'); ?>">
                        <i class="bi bi-grid-1x2-fill"></i> Dashboard
                    </a>
                </li>

                <!-- KELOLA LAHAN (Otomatis Aktif & Berlatar Coklat di Halaman Ini) -->
                <li class="menu-item <?= ($this->uri->segment(2) == 'lahan') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/lahan'); ?>">
                        <i class="bi bi-geo-alt-fill"></i> Kelola Lahan
                        <span class="menu-badge"><?= count($lahan) ?></span>
                    </a>
                </li>

                <!-- MANAJEMEN PANEN -->
                <li class="menu-item <?= ($this->uri->segment(2) == 'panen') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/panen'); ?>">
                        <i class="bi bi-textarea-rose"></i> Manajemen Panen
                    </a>
                </li>

                <!-- KATALOG PRODUK -->
                <li class="menu-item <?= ($this->uri->segment(2) == 'produk') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/produk'); ?>">
                        <i class="bi bi-box-seam"></i> Katalog Produk
                        <span class="menu-badge">5</span>
                    </a>
                </li>

                <!-- PESANAN MASUK -->
                <li class="menu-item <?= ($this->uri->segment(2) == 'transaksi') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/transaksi'); ?>">
                        <i class="bi bi-cart-check-fill"></i> Pesanan Masuk
                        <span class="menu-badge">8</span>
                    </a>
                </li>

                <!-- TRACKING KIRIMAN -->
                <li class="menu-item <?= ($this->uri->segment(2) == 'tracking') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/tracking'); ?>">
                        <i class="bi bi-truck"></i> Tracking Kiriman
                    </a>
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
                <!-- Tombol menu responsive untuk ukuran mobile -->
                <button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle"
                    style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
                    <i class="bi bi-list"></i>
                </button>
                <h3 class="font-weight-bold text-coffee-primary d-inline-block align-middle mb-1"
                    style="letter-spacing: -0.5px;">Manajemen Lahan</h3>
                <p class="text-muted small mb-0">Dashboard / Kelola Lahan</p>
            </div>
        </div>

        <?php if ($this->session->flashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="fas fa-check-circle mr-1"></i> <?= $this->session->flashdata('success'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>

        <!-- Baris Kotak Statistik -->
        <div class="row no-gutters mx-n2 mb-4">
            <div class="col-12 col-sm-6 col-md-3 px-2 mb-3 mb-md-0">
                <div class="card border-0 shadow-sm h-100" style="border-radius: var(--radius-card);">
                    <div class="card-body d-flex align-items-center justify-content-between p-3">
                        <div>
                            <span class="text-muted font-weight-bold small d-block mb-1">Total Lahan</span>
                            <h2 class="font-weight-bold text-dark mb-0"><?= count($lahan) ?></h2>
                            <span class="text-muted" style="font-size: 11px;">Semua Lahan</span>
                        </div>
                        <div class="bg-warning-light text-warning rounded p-3 d-flex align-items-center justify-content-center"
                            style="width: 48px; height: 48px; border-radius: 12px !important;">
                            <i class="fas fa-map fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3 px-2 mb-3 mb-md-0">
                <div class="card border-0 shadow-sm h-100" style="border-radius: var(--radius-card);">
                    <div class="card-body d-flex align-items-center justify-content-between p-3">
                        <div>
                            <span class="text-muted font-weight-bold small d-block mb-1">Lahan Aktif</span>
                            <h2 class="font-weight-bold text-dark mb-0">
                                <?php 
                                    $aktif = 0;
                                    foreach($lahan as $lh) { if(strtolower($lh['status_lahan']) == 'active' || $lh['status_lahan'] == 'aktif') $aktif++; }
                                    echo $aktif;
                                ?>
                            </h2>
                            <span class="text-success font-weight-bold d-block mt-1" style="font-size: 11px;">
                                <?= count($lahan) > 0 ? round(($aktif / count($lahan)) * 100, 1) : 0; ?>% dari total
                            </span>
                        </div>
                        <div class="bg-success-light text-success rounded p-3 d-flex align-items-center justify-content-center"
                            style="width: 48px; height: 48px; border-radius: 12px !important;">
                            <i class="fas fa-check-circle fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3 px-2 mb-3 mb-sm-0">
                <div class="card border-0 shadow-sm h-100" style="border-radius: var(--radius-card);">
                    <div class="card-body d-flex align-items-center justify-content-between p-3">
                        <div>
                            <span class="text-muted font-weight-bold small d-block mb-1">Lahan Nonaktif</span>
                            <h2 class="font-weight-bold text-dark mb-0">
                                <?php 
                                    $nonaktif = 0;
                                    foreach($lahan as $lh) { if(strtolower($lh['status_lahan']) == 'inactive' || $lh['status_lahan'] == 'nonaktif') $nonaktif++; }
                                    echo $nonaktif;
                                ?>
                            </h2>
                            <span class="text-muted d-block mt-1" style="font-size: 11px;">
                                <?= count($lahan) > 0 ? round(($nonaktif / count($lahan)) * 100, 1) : 0; ?>% dari total
                            </span>
                        </div>
                        <div class="bg-orange-light text-orange rounded p-3 d-flex align-items-center justify-content-center"
                            style="width: 48px; height: 48px; border-radius: 12px !important;">
                            <i class="fas fa-times-circle fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3 px-2">
                <div class="card border-0 shadow-sm h-100" style="border-radius: var(--radius-card);">
                    <div class="card-body d-flex align-items-center justify-content-between p-3">
                        <div>
                            <span class="text-muted font-weight-bold small d-block mb-1">Total Luas (Ha)</span>
                            <h2 class="font-weight-bold text-dark mb-0">
                                <?php 
                                    $total_luas = 0;
                                    foreach($lahan as $lh) { $total_luas += (float)$lh['luas']; }
                                    echo number_format($total_luas, 2, ',', '.');
                                ?>
                            </h2>
                            <span class="text-info font-weight-bold d-block mt-1" style="font-size: 11px;">Hektar
                                Lahan</span>
                        </div>
                        <div class="bg-info-light text-info rounded p-3 d-flex align-items-center justify-content-center"
                            style="width: 48px; height: 48px; border-radius: 12px !important;">
                            <i class="fas fa-chart-area fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter dan Tombol Tambah -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: var(--radius-card);">
            <div class="card-body p-3">
                <form action="<?= base_url('petani/lahan') ?>" method="GET" class="m-0">
                    <div class="form-row align-items-center justify-content-between">
                        <div class="col-12 col-md-8">
                            <div class="form-row">
                                <div class="col-12 col-sm-5 mb-2 mb-sm-0">
                                    <input type="text" name="lokasi"
                                        class="form-control form-control-sm bg-light border-0 pl-3"
                                        placeholder="Cari lahan atau lokasi..."
                                        value="<?= $this->input->get('lokasi'); ?>"
                                        style="height: 38px; border-radius: 6px;">
                                </div>
                                <div class="col-12 col-sm-4 mb-2 mb-sm-0">
                                    <select name="status_lahan" class="form-control form-control-sm bg-light border-0"
                                        style="height: 38px; border-radius: 6px;">
                                        <option value="">Semua Status</option>
                                        <option value="Active"
                                            <?= $this->input->get('status_lahan') == 'Active' ? 'selected' : ''; ?>>
                                            Active</option>
                                        <option value="Inactive"
                                            <?= $this->input->get('status_lahan') == 'Inactive' ? 'selected' : ''; ?>>
                                            Inactive</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3 d-flex">
                                    <button type="submit" class="btn btn-sm text-white flex-grow-1 mr-2"
                                        style="border-radius: 6px; background-color: var(--amber-cream); border-color: var(--amber-cream);">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                    <a href="<?= base_url('petani/lahan') ?>" class="btn btn-sm btn-secondary"
                                        style="border-radius: 6px;">
                                        <i class="fas fa-sync-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 text-right mt-2 mt-md-0">
                            <a href="<?= base_url('petani/lahan/tambah') ?>"
                                class="btn font-weight-bold text-white px-3"
                                style="background-color: var(--roasted-brown); height: 38px; border-radius: 6px; display: inline-flex; align-items: center;">
                                <i class="fas fa-plus mr-2"></i> Tambah Lahan
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Modern Data Lahan -->
        <div class="card border-0 shadow-sm" style="border-radius: var(--radius-card); overflow: hidden;">
            <div class="table-responsive">
                <table class="table table-modern align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th width="12%" class="text-center">Foto Lahan</th>
                            <th width="18%">Nama Lahan</th>
                            <th width="13%">Jenis Kopi</th>
                            <th width="10%">Luas (Ha)</th>
                            <th width="18%">Lokasi / Alamat</th>
                            <th width="14%">Catatan Perawatan</th>
                            <th class="text-center" width="10%">Status</th>
                            <th class="text-center" width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($lahan)) : ?>
                        <?php $no = 1; foreach ($lahan as $lh) : ?>
                        <tr>
                            <td class="text-center align-middle font-weight-bold text-muted"><?= $no++; ?></td>
                            <td class="text-center align-middle">
                                <?php if (!empty($lh['foto_lahan'])) : ?>
                                <img src="<?= base_url('assets/uploads/lahan/' . $lh['foto_lahan']) ?>"
                                    class="img-thumbnail rounded shadow-sm"
                                    style="max-width: 65px; height: auto; object-fit: cover;">
                                <?php else : ?>
                                <span class="badge badge-secondary p-1 small text-white" style="font-size: 10px;">No
                                    Photo</span>
                                <?php endif; ?>
                            </td>
                            <td class="align-middle">
                                <span class="font-weight-bold text-dark"><?= $lh['nama_lahan']; ?></span>
                                <small class="text-muted d-block" style="font-size: 10px;">Lat/Lng:
                                    <?= var_export($lh['latitude'], true) ?>,
                                    <?= var_export($lh['longitude'], true) ?></small>
                            </td>
                            <td class="align-middle font-weight-bold text-coffee-primary">
                                <?= isset($lh['jenis_kopi']) ? $lh['jenis_kopi'] : '-'; ?></td>
                            <td class="align-middle font-weight-bold text-dark">
                                <?= number_format((float)$lh['luas'], 2, ',', '.'); ?></td>
                            <td class="align-middle text-muted small">
                                <?= isset($lh['lokasi']) ? character_limiter($lh['lokasi'], 45) : '-'; ?></td>
                            <td class="align-middle text-secondary small italic">
                                <?= (!empty($lh['catatan'])) ? character_limiter($lh['catatan'], 40) : '<span class="text-light-muted">- tidak ada catatan -</span>'; ?>
                            </td>
                            <td class="text-center align-middle">
                                <?php if (strtolower($lh['status_lahan']) == 'active' || $lh['status_lahan'] == 'aktif') : ?>
                                <span class="badge bg-success-light text-success font-weight-bold px-2.5 py-2"
                                    style="border-radius: 4px; font-size: 11px;">Active</span>
                                <?php else : ?>
                                <span class="badge bg-warning-light text-orange font-weight-bold px-2.5 py-2"
                                    style="border-radius: 4px; font-size: 11px;">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="<?= base_url('petani/lahan/detail/' . $lh['id_lahan']) ?>"
                                        class="btn btn-action mr-1 text-white" style="background-color: #5c3d2e;">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?= base_url('petani/lahan/edit/' . $lh['id_lahan']) ?>"
                                        class="btn btn-warning btn-action text-white mr-1">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="<?= base_url('petani/lahan/hapus/' . $lh['id_lahan']) ?>"
                                        class="btn btn-danger btn-action"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data lahan ini?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="9" class="text-center text-muted py-5 bg-white">
                                <i class="fas fa-folder-open fa-3x mb-3 text-secondary"></i>
                                <h6 class="font-weight-bold text-secondary mb-1">Belum Ada Data Lahan Kopi</h6>
                                <small class="text-muted">Silakan lakukan penambahan titik koordinat lahan baru
                                    menggunakan menu di atas.</small>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Logika skrip responsive toggle sidebar mobile dari v_dashboard
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
