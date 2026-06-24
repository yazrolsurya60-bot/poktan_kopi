<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link class="sub-concept-link" rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link class="sub-concept-link" rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    body {
        background-color: #f7f5f2 !important;
        font-family: 'Nunito', 'Segoe UI', sans-serif;
    }

    /* --- STYLING SIDEBAR --- */
    .sidebar-container {
        min-width: 280px;
        max-width: 280px;
        background-color: #241408;
        min-height: 100vh;
        color: #bfa594;
    }

    .sidebar-brand-box {
        padding: 24px;
        display: flex;
        align-items: center;
    }

    .brand-icon-wrapper {
        background-color: #3d2716;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        color: #e5934c;
        font-size: 1.25rem;
    }

    .brand-title {
        color: #e5934c;
        font-weight: 700;
        font-size: 1.25rem;
        letter-spacing: 0.5px;
        line-height: 1.2;
    }

    .brand-subtitle {
        color: #8c7161;
        font-size: 0.9rem;
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
        padding: 12px 16px;
        color: #bfa594;
        text-decoration: none;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .sidebar-link i {
        width: 24px;
        font-size: 1.1rem;
        margin-right: 12px;
        text-align: center;
    }

    .sidebar-link:hover {
        background-color: rgba(255, 255, 255, 0.03);
        color: #e5934c;
        text-decoration: none;
    }

    .sidebar-item.active .sidebar-link {
        background-color: #3b2414;
        color: #ffffff;
        position: relative;
    }

    .sidebar-item.active .sidebar-link::before {
        content: '';
        position: absolute;
        left: 0;
        top: 25%;
        height: 50%;
        width: 4px;
        background-color: #e5934c;
        border-radius: 0 4px 4px 0;
    }

    .sidebar-badge {
        background-color: #3b2414;
        color: #e5934c;
        font-size: 0.75rem;
        padding: 2px 8px;
        border-radius: 10px;
        font-weight: 700;
        margin-left: auto;
    }

    .btn-logout-sidebar {
        border: 1px solid #3b2414;
        background-color: transparent;
        color: #bfa594;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.2s;
    }

    .btn-logout-sidebar:hover {
        background-color: #c94a4a;
        color: white;
        border-color: #c94a4a;
    }

    /* --- STYLING KONTEN UTAMA --- */
    .main-content {
        flex-grow: 1;
        padding: 30px;
        height: 100vh;
        overflow-y: auto;
    }

    .text-coffee-primary {
        color: #241408;
    }

    .btn-coffee-submit {
        background-color: #4a2f1b;
        color: #f7f5f2;
    }

    .btn-coffee-submit:hover {
        background-color: #241408;
        color: #e5934c;
    }

    .card-header-coffee {
        background-color: #241408;
        color: #e5934c;
    }

    .badge-table-total {
        background-color: #3b2414;
        color: #e5934c;
    }
    </style>
</head>

<body>

    <div class="d-flex">
        <div class="sidebar-container d-flex flex-column justify-content-between">
            <div>
                <div class="sidebar-brand-box">
                    <div class="brand-icon-wrapper mr-3">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <div>
                        <div class="brand-title">POKTAN</div>
                        <div class="brand-subtitle">Liberchain</div>
                    </div>
                </div>
                <hr class="m-0" style="border-top: 1px solid rgba(255,255,255,0.05);">

                <ul class="sidebar-menu mt-4">
                    <li class="sidebar-item">
                        <a href="<?= base_url('admin/dashboard') ?>" class="sidebar-link">
                            <i class="fas fa-th-large"></i> Dashboard
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fas fa-users"></i> Manajemen User <span class="sidebar-badge">12</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fas fa-address-card"></i> Data Petani
                        </a>
                    </li>
                    <li class="sidebar-item active">
                        <a href="<?= base_url('admin/lahan') ?>" class="sidebar-link">
                            <i class="fas fa-map"></i> Manajemen Lahan
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fas fa-tree"></i> Manajemen Panen
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fas fa-box"></i> Manajemen Produk
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fas fa-wallet"></i> Transaksi <span class="sidebar-badge">8</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fas fa-truck"></i> Manajemen Kurir
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fas fa-store"></i> Manajemen Mitra
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fas fa-file-invoice-dollar"></i> Laporan & Analytics
                        </a>
                    </li>
                </ul>
            </div>

            <div class="p-3">
                <a href="<?= base_url('auth/logout') ?>" class="btn btn-logout-sidebar btn-block py-2">
                    <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                </a>
            </div>
        </div>

        <div class="main-content">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                <div>
                    <h3 class="font-weight-bold text-coffee-primary"><i class="fas fa-layer-group mr-2"
                            style="color: #4a2f1b;"></i>Panel Admin: Data Lahan Kopi</h3>
                    <p class="text-muted small mb-0">Memantau seluruh persebaran lahan petani kopi yang terdaftar di
                        sistem.</p>
                </div>
            </div>

            <?php if ($this->session->flashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-1"></i> <?= $this->session->flashdata('success'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif; ?>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body bg-white rounded">
                    <h6 class="font-weight-bold text-muted mb-3"><i class="fas fa-filter mr-1"></i> Filter Data Lahan
                    </h6>
                    <form action="<?= base_url('admin/lahan') ?>" method="GET">
                        <div class="form-row align-items-end">
                            <div class="col-md-4 mb-2">
                                <label class="small font-weight-bold text-secondary">Status Lahan</label>
                                <select name="status_lahan" class="form-control form-control-sm"
                                    style="border-color: #bfa594;">
                                    <option value="">-- Semua Status --</option>
                                    <option value="Active"
                                        <?= $this->input->get('status_lahan') == 'Active' ? 'selected' : ''; ?>>Active
                                    </option>
                                    <option value="Inactive"
                                        <?= $this->input->get('status_lahan') == 'Inactive' ? 'selected' : ''; ?>>
                                        Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-5 mb-2">
                                <label class="small font-weight-bold text-secondary">Cari Lokasi / Alamat</label>
                                <input type="text" name="lokasi" class="form-control form-control-sm"
                                    style="border-color: #bfa594;" placeholder="Masukkan nama daerah atau kota..."
                                    value="<?= $this->input->get('lokasi'); ?>">
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="btn-group w-100">
                                    <button type="submit" class="btn btn-coffee-submit btn-sm w-100 font-weight-bold">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                    <a href="<?= base_url('admin/lahan') ?>" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-undo"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow border-0">
                <div class="card-header card-header-coffee d-flex justify-content-between align-items-center">
                    <h5 class="m-0 font-weight-bold" style="font-size: 1.05rem;"><i
                            class="fas fa-map-marked-alt mr-2"></i>Daftar Pengawasan Seluruh Lahan</h5>
                    <span class="badge badge-table-total px-3 py-2 font-weight-bold">Total: <?= count($lahan) ?> Item
                        Terdata</span>
                </div>
                <div class="card-body bg-white">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover mb-0" width="100%" cellspacing="0">
                            <thead class="thead-light text-center">
                                <tr>
                                    <th width="5%" class="align-middle">No</th>
                                    <th width="12%" class="align-middle">Foto Lahan</th>
                                    <th class="align-middle">Nama Lahan</th>
                                    <th class="align-middle">Jenis Kopi</th>
                                    <th class="align-middle">Luas (Ha)</th>
                                    <th class="align-middle">Alamat / Lokasi</th>
                                    <th class="align-middle">Catatan Perawatan</th>
                                    <th width="15%" class="align-middle">Status Lahan</th>
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
                                            style="max-width: 75px; height: auto;">
                                        <?php else : ?>
                                        <span class="badge badge-secondary p-1 small shadow-sm">No Photo</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="align-middle">
                                        <span class="font-weight-bold"
                                            style="color: #4a2f1b;"><?= $lh['nama_lahan']; ?></span>
                                        <br><small class="text-muted font-italic">Pemilik ID:
                                            #<?= $lh['id_user']; ?></small>
                                    </td>
                                    <td class="align-middle text-center font-weight-bold"><?= $lh['jenis_kopi']; ?></td>
                                    <td class="align-middle text-center text-dark font-weight-bold">
                                        <?= number_format($lh['luas'], 2, ',', '.'); ?> Ha</td>
                                    <td class="align-middle text-muted small"><?= $lh['lokasi']; ?></td>

                                    <td class="align-middle text-secondary small">
                                        <?= !empty($lh['catatan']) ? character_limiter($lh['catatan'], 50) : '<span class="text-muted font-italic">- Tidak ada catatan -</span>'; ?>
                                    </td>

                                    <td class="text-center align-middle">
                                        <?php if (strtolower($lh['status_lahan']) == 'active') : ?>
                                        <span class="badge badge-success px-3 py-2 shadow-sm"><i
                                                class="fas fa-check-circle mr-1"></i> Active</span>
                                        <?php else : ?>
                                        <span class="badge badge-danger px-3 py-2 shadow-sm"><i
                                                class="fas fa-times-circle mr-1"></i> Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else : ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-5">
                                        <i class="fas fa-folder-open fa-3x mb-3 text-secondary"></i>
                                        <p class="mb-0 font-weight-bold text-secondary">Data lahan tidak ditemukan atau
                                            filter tidak cocok.</p>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>