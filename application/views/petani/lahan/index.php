<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    body {
        background-color: #f7f5f2 !important;
        font-family: 'Nunito', 'Segoe UI', sans-serif;
    }

    /* --- STYLING SIDEBAR UTAMA DASHBOARD --- */
    .sidebar-container {
        min-width: 260px;
        max-width: 260px;
        background-color: #26170d;
        min-height: 100vh;
        color: #bfa594;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        box-shadow: 4px 0 10px rgba(0, 0, 0, 0.15);
    }

    .sidebar-brand-box {
        padding: 24px;
        display: flex;
        align-items: center;
    }

    .brand-icon-wrapper {
        background-color: #d9a441;
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        color: #ffffff;
        font-size: 1.25rem;
    }

    .brand-title {
        color: #ffffff;
        font-weight: 700;
        font-size: 1.1rem;
        letter-spacing: 0.5px;
        line-height: 1.2;
    }

    .brand-subtitle {
        color: #8c7161;
        font-size: 0.75rem;
    }

    .sidebar-menu {
        list-style: none;
        padding: 0 16px;
        margin: 0;
    }

    .sidebar-item {
        margin-bottom: 6px;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        padding: 11px 16px;
        color: rgba(255, 255, 255, 0.5) !important;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }

    .sidebar-link i {
        width: 24px;
        font-size: 1.1rem;
        margin-right: 12px;
        text-align: center;
    }

    .sidebar-link:hover {
        background-color: rgba(255, 255, 255, 0.04);
        color: #ffffff !important;
        text-decoration: none;
    }

    .sidebar-heading {
        color: #8c7161;
        font-size: 0.75rem;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 0.5px;
        padding: 12px 16px 4px 16px;
    }

    .sidebar-item.active .sidebar-link {
        background-color: #4a3319 !important;
        color: #ffffff !important;
        font-weight: 600;
        position: relative;
    }

    .sidebar-item.active .sidebar-link::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 4px;
        background-color: #d9a441;
        border-radius: 4px 0 0 4px;
    }

    .sidebar-item.active .sidebar-link i {
        color: #ffffff;
    }

    .sidebar-badge {
        background-color: #3d2b19;
        color: #a67c52;
        font-size: 0.75rem;
        padding: 2px 8px;
        border-radius: 50%;
        font-weight: 700;
        margin-left: auto;
        min-width: 22px;
        height: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .sidebar-item.active .sidebar-badge {
        background-color: #5e4226;
        color: #d9a441;
    }

    .btn-logout-sidebar {
        border: 1px solid rgba(255, 255, 255, 0.1);
        background-color: rgba(255, 255, 255, 0.02);
        color: rgba(255, 255, 255, 0.5);
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s;
    }

    .btn-logout-sidebar:hover {
        background-color: #611a1a;
        color: white;
        border-color: #8c2323;
    }

    /* --- STYLING KONTEN UTAMA --- */
    .main-content {
        margin-left: 260px;
        flex-grow: 1;
        padding: 30px;
        min-height: 100vh;
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
    </style>
</head>

<body>

    <div class="d-flex">
        <div class="sidebar-container d-flex flex-column justify-content-between">
            <div>
                <div class="sidebar-brand-box">
                    <div class="brand-icon-wrapper mr-3">
                        <i class="fas fa-award"></i>
                    </div>
                    <div>
                        <div class="brand-title">PETANI</div>
                        <div class="brand-subtitle">Liberchain</div>
                    </div>
                </div>
                <hr class="m-0" style="border-top: 1px solid rgba(255,255,255,0.05);">

                <ul class="sidebar-menu mt-4">
                    <li class="sidebar-item">
                        <a href="<?= base_url('petani/dashboard') ?>" class="sidebar-link">
                            <i class="fas fa-th-large"></i> Dashboard
                        </a>
                    </li>
                    <li class="sidebar-item active">
                        <a href="<?= base_url('petani/lahan') ?>" class="sidebar-link">
                            <i class="fas fa-map-marked-alt"></i> Kelola Lahan <span
                                class="sidebar-badge"><?= count($lahan) ?></span>
                        </a>
                    </li>

                    <li class="sidebar-heading">Manajemen Panen</li>

                    <li class="sidebar-item">
                        <a href="<?= base_url('petani/produk') ?>" class="sidebar-link">
                            <i class="fas fa-box"></i> Katalog Produk <span class="sidebar-badge">5</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="<?= base_url('petani/pesanan') ?>" class="sidebar-link">
                            <i class="fas fa-shopping-basket"></i> Pesanan Masuk <span class="sidebar-badge">8</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="<?= base_url('petani/tracking') ?>" class="sidebar-link">
                            <i class="fas fa-truck"></i> Tracking Kiriman
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="<?= base_url('petani/laporan') ?>" class="sidebar-link">
                            <i class="fas fa-file-alt"></i> Laporan
                        </a>
                    </li>
                </ul>
            </div>

            <div class="p-3">
                <hr style="border-top: 1px solid rgba(255,255,255,0.05);" class="mb-3">
                <a href="<?= base_url('auth/logout') ?>" class="btn btn-logout-sidebar btn-block py-2">
                    <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                </a>
            </div>
        </div>

        <div class="main-content">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="font-weight-bold text-coffee-primary mb-1" style="letter-spacing: -0.5px;">Manajemen
                        Lahan</h3>
                    <p class="text-muted small mb-0">Dashboard / Manajemen Lahan</p>
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

            <div class="row no-gutters mx-n2 mb-4">
                <div class="col-12 col-sm-6 col-md-3 px-2 mb-3 mb-md-0">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex align-items-center justify-content-between p-3">
                            <div>
                                <span class="text-muted font-weight-bold small d-block mb-1">Total Lahan</span>
                                <h2 class="font-weight-bold text-dark mb-0"><?= count($lahan) ?></h2>
                                <span class="text-muted" style="font-size: 11px;">Semua Lahan</span>
                            </div>
                            <div class="bg-warning-light text-warning rounded p-3 d-flex align-items-center justify-content-center"
                                style="width: 48px; height: 48px;">
                                <i class="fas fa-map fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3 px-2 mb-3 mb-md-0">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex align-items-center justify-content-between p-3">
                            <div>
                                <span class="text-muted font-weight-bold small d-block mb-1">Lahan Aktif</span>
                                <h2 class="font-weight-bold text-dark mb-0">
                                    <?php 
                                        $aktif = 0;
                                        foreach($lahan as $lh) { if(strtolower($lh['status_lahan']) == 'active' || $lh['status_lahan'] == 'Aktif') $aktif++; }
                                        echo $aktif;
                                    ?>
                                </h2>
                                <span class="text-success font-weight-bold d-block mt-1" style="font-size: 11px;">
                                    <?= count($lahan) > 0 ? round(($aktif / count($lahan)) * 100, 1) : 0; ?>% dari total
                                </span>
                            </div>
                            <div class="bg-success-light text-success rounded p-3 d-flex align-items-center justify-content-center"
                                style="width: 48px; height: 48px;">
                                <i class="fas fa-check-circle fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3 px-2 mb-3 mb-sm-0">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex align-items-center justify-content-between p-3">
                            <div>
                                <span class="text-muted font-weight-bold small d-block mb-1">Lahan Nonaktif</span>
                                <h2 class="font-weight-bold text-dark mb-0">
                                    <?php 
                                        $nonaktif = 0;
                                        foreach($lahan as $lh) { if(strtolower($lh['status_lahan']) == 'inactive' || $lh['status_lahan'] == 'Inactive') $nonaktif++; }
                                        echo $nonaktif;
                                    ?>
                                </h2>
                                <span class="text-muted d-block mt-1" style="font-size: 11px;">
                                    <?= count($lahan) > 0 ? round(($nonaktif / count($lahan)) * 100, 1) : 0; ?>% dari
                                    total
                                </span>
                            </div>
                            <div class="bg-orange-light text-orange rounded p-3 d-flex align-items-center justify-content-center"
                                style="width: 48px; height: 48px;">
                                <i class="fas fa-times-circle fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3 px-2">
                    <div class="card border-0 shadow-sm h-100">
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
                                style="width: 48px; height: 48px;">
                                <i class="fas fa-chart-area fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
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
                                        <select name="status_lahan"
                                            class="form-control form-control-sm bg-light border-0"
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
                                        <button type="submit" class="btn btn-sm btn-primary flex-grow-1 mr-2"
                                            style="border-radius: 6px;">
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
                                    style="background-color: #4a2e1b; height: 38px; border-radius: 6px; display: inline-flex; align-items: center;">
                                    <i class="fas fa-plus mr-2"></i> Tambah Lahan
                                </a>
                            </div>
                        </div>
                    </form>


                </div>
            </div>

            <div class="card border-0 shadow-sm" style="border-radius: 8px; overflow: hidden;">
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
                                    <?php if (strtolower($lh['status_lahan']) == 'active' || $lh['status_lahan'] == 'Aktif') : ?>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>