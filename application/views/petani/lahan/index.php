<style>
/* --- THEME EARTH TONE (MOCKUP COFFEE LOGIC) --- */
.text-dark-coffee {
    color: #2b1b0c;
}

.bg-coffee {
    background-color: #5c3c1e;
    color: #ffffff;
}

.bg-coffee-dark {
    background-color: #2b1b0c;
    color: #ffffff;
}

/* Breadcrumb & Title */
.page-title {
    font-weight: 700;
    color: #111111;
    font-size: 24px;
}

.breadcrumb-custom {
    font-size: 13px;
    color: #6c757d;
}

/* Summary Stats Cards */
.stat-card {
    background: #ffffff;
    border: 1px solid #f2f2f2;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.01);
}

.stat-icon-box {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.stat-label {
    font-size: 12px;
    color: #666666;
    font-weight: 600;
}

.stat-value {
    font-size: 26px;
    font-weight: 700;
    color: #111111;
    line-height: 1.2;
}

.stat-subtext {
    font-size: 11px;
    color: #999999;
}

/* Form Controls */
.search-input-group {
    background: #ffffff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding-left: 12px;
}

.form-select-custom,
.form-input-custom {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    font-size: 13px;
    color: #444444;
    height: 40px;
}

/* Buttons */
.btn-tambah-lahan {
    background-color: #4a2f15;
    color: white;
    font-size: 13px;
    font-weight: 600;
    border-radius: 8px;
    padding: 0 18px;
    height: 40px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border: none;
}

.btn-tambah-lahan:hover {
    background-color: #2b1b0c;
    color: white;
}

.btn-export-custom {
    background-color: #ffffff;
    color: #333333;
    border: 1px solid #e0e0e0;
    font-size: 13px;
    font-weight: 600;
    border-radius: 8px;
    height: 40px;
    padding: 0 14px;
}

/* Table System */
.table-container-mockup {
    background: #ffffff;
    border-radius: 12px;
    overflow: hidden;
}

.table-mockup thead {
    background-color: #fbf9f6;
}

.table-mockup th {
    font-size: 12px;
    font-weight: 700;
    color: #555555;
    border-bottom: 1px solid #eeeeee;
    padding: 14px 10px;
}

.table-mockup td {
    font-size: 13px;
    color: #333333;
    vertical-align: middle;
    padding: 12px 10px;
    border-bottom: 1px solid #f6f6f6;
}

.img-thumb-lahan {
    width: 48px;
    height: 34px;
    object-fit: cover;
    border-radius: 4px;
}

/* Badges Status */
.badge-lonjong {
    font-size: 11px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 20px;
    display: inline-block;
}

.badge-aktif {
    background-color: #eaf7ed;
    color: #2e7d32;
}

.badge-nonaktif {
    background-color: #fff4ec;
    color: #d97736;
}

.badge-tidak-produktif {
    background-color: #fdf0f0;
    color: #d32f2f;
}

/* Action Buttons Circle/Square Grid */
.btn-action-icon {
    width: 32px;
    height: 32px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: none;
    color: white;
    font-size: 14px;
}

.btn-view-map {
    background-color: #f7f3ee;
    color: #6d4c41;
    border: 1px solid #e8dfd5;
}

.btn-act-detail {
    background-color: #4a2f15;
}

.btn-act-edit {
    background-color: #fbc02d;
    color: #222;
}

.btn-act-delete {
    background-color: #d32f2f;
}

.btn-action-icon:disabled,
.btn-action-icon.disabled {
    background-color: #ebebeb !important;
    color: #b5b5b5 !important;
    cursor: not-allowed;
    border: none;
}
</style>

<main id="main" class="main bg-light min-vh-100 pt-3">
    <div class="container-fluid">

        <!-- HEADER TITLE & BREADCRUMB -->
        <div class="mb-4">
            <h2 class="page-title mb-0">Manajemen Lahan</h2>
            <div class="breadcrumb-custom">Dashboard &nbsp;/&nbsp; Manajemen Lahan</div>
        </div>

        <!-- LOGIKAL HITUNG STATUS (MOCKUP STATS) -->
        <?php 
            $total = count($lahan);
            $aktif = 0; $nonaktif = 0; $tidak_prod = 0;
            foreach($lahan as $row) {
                if(strtolower($row['status_lahan']) == 'aktif') $aktif++;
                elseif(strtolower($row['status_lahan']) == 'nonaktif') $nonaktif++;
                else $tidak_prod++;
            }
            $pct_aktif = $total > 0 ? round(($aktif/$total)*100, 1) : 0;
            $pct_nonaktif = $total > 0 ? round(($nonaktif/$total)*100, 1) : 0;
            $pct_tidak_prod = $total > 0 ? round(($tidak_prod/$total)*100, 1) : 0;
        ?>

        <!-- 4 TOP SUMMARY CARDS (PERSIS SEPERTI image_8d95ff.jpg) -->
        <div class="row g-3 mb-4">
            <div class="col-10 col-sm-6 col-md-3">
                <div class="stat-card d-flex align-items-center gap-3">
                    <div class="stat-icon-box" style="background-color: #fdf5ea; color: #d97706;">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div>
                        <div class="stat-label">Total Lahan</div>
                        <div class="stat-value"><?= $total ?></div>
                        <div class="stat-subtext">Semua Lahan</div>
                    </div>
                </div>
            </div>
            <div class="col-10 col-sm-6 col-md-3">
                <div class="stat-card d-flex align-items-center gap-3">
                    <div class="stat-icon-box" style="background-color: #eaf7ed; color: #2e7d32;">
                        <i class="bi bi-arrow-down-circle-fill"></i>
                    </div>
                    <div>
                        <div class="stat-label">Lahan Aktif</div>
                        <div class="stat-value"><?= $aktif ?></div>
                        <div class="stat-subtext"><?= $pct_aktif ?>% dari total</div>
                    </div>
                </div>
            </div>
            <div class="col-10 col-sm-6 col-md-3">
                <div class="stat-card d-flex align-items-center gap-3">
                    <div class="stat-icon-box" style="background-color: #fef3c7; color: #b45309;">
                        <i class="bi bi-tree-fill"></i>
                    </div>
                    <div>
                        <div class="stat-label">Lahan Nonaktif</div>
                        <div class="stat-value"><?= $nonaktif ?></div>
                        <div class="stat-subtext"><?= $pct_nonaktif ?>% dari total</div>
                    </div>
                </div>
            </div>
            <div class="col-10 col-sm-6 col-md-3">
                <div class="stat-card d-flex align-items-center gap-3">
                    <div class="stat-icon-box" style="background-color: #fde8e8; color: #e11d48;">
                        <i class="bi bi-arrow-down-left-circle-fill"></i>
                    </div>
                    <div>
                        <div class="stat-label">Lahan Tidak Produktif</div>
                        <div class="stat-value"><?= $tidak_prod ?></div>
                        <div class="stat-subtext"><?= $pct_tidak_prod ?>% dari total</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- BARIS CONTROLS: FILTRASI & TOMBOL AKSI -->
        <?php $role = $this->session->userdata('role'); ?>
        <?php $route = ($role == 'Admin') ? 'admin' : 'petani'; ?>

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
            <!-- Form Filter Sebelah Kiri -->
            <form method="GET" action="<?= base_url($route.'/lahan') ?>"
                class="d-flex flex-wrap gap-2 flex-grow-1 max-width-lg">
                <div class="d-flex align-items-center search-input-group flex-grow-1" style="max-width: 240px;">
                    <i class="bi bi-search text-muted"></i>
                    <input type="text" name="search" class="form-control border-0 bg-transparent form-input-custom"
                        placeholder="Cari lahan..." value="<?= $this->input->get('search') ?>">
                </div>

                <select name="status" class="form-select form-select-custom" style="width: 140px;">
                    <option value="">Semua Status</option>
                    <option value="Aktif" <?= $this->input->get('status') == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                    <option value="Nonaktif" <?= $this->input->get('status') == 'Nonaktif' ? 'selected' : '' ?>>Nonaktif
                    </option>
                    <option value="Tidak Produktif"
                        <?= $this->input->get('status') == 'Tidak Produktif' ? 'selected' : '' ?>>Tidak Produktif
                    </option>
                </select>

                <select name="petani" class="form-select form-select-custom" style="width: 150px;">
                    <option value="">Semua Petani</option>
                    <!-- Tambahkan loop data petani jika ada -->
                </select>

                <button type="submit" class="btn btn-outline-secondary btn-sm rounded-8 px-3"><i
                        class="bi bi-funnel"></i></button>
            </form>

            <!-- Blok Tombol Kanan (Tambah & Export) -->
            <div class="d-flex align-items-center gap-2">
                <!-- AKSES FULL PETANI: Admin tidak bisa melihat tombol Tambah Lahan -->
                <?php if ($role == 'Petani'): ?>
                <a href="<?= base_url('petani/lahan/tambah') ?>" class="btn btn-tambah-lahan shadow-sm">
                    <i class="bi bi-plus-lg"></i> Tambah Lahan
                </a>
                <?php endif; ?>

                <div class="dropdown">
                    <button class="btn btn-export-custom dropdown-toggle d-flex align-items-center gap-2" type="button"
                        data-bs-toggle="dropdown">
                        <i class="bi bi-box-arrow-up"></i> Export
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-excel text-success"></i>
                                Excel</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-pdf text-danger"></i> PDF</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- MAIN DATA TABLE (Sesuai Struktur Mockup) -->
        <div class="card table-container-mockup border-0 shadow-sm mb-5">
            <div class="table-responsive">
                <table class="table table-mockup m-0">
                    <thead>
                        <tr>
                            <th width="50" class="text-center">No</th>
                            <th>Nama Lahan</th>
                            <th>Petani</th>
                            <th>Luas (Ha)</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th class="text-center">Peta</th>
                            <th class="text-center" width="140">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($lahan)): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">Tidak ada data lahan tersedia.</td>
                        </tr>
                        <?php endif; ?>

                        <?php $no = 1; foreach($lahan as $l): ?>
                        <tr>
                            <td class="text-center text-muted"><?= $no++ ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <!-- Foto fisik mini lahan -->
                                    <img src="<?= !empty($l['foto_lahan']) ? base_url('uploads/lahan/'.$l['foto_lahan']) : base_url('assets/img/default-lahan.jpg') ?>"
                                        class="img-thumb-lahan" alt="Kebun">
                                    <span class="font-weight-600 text-dark-coffee"><?= $l['nama_lahan'] ?></span>
                                </div>
                            </td>
                            <td class="text-secondary">
                                <?= isset($l['nama_petani']) ? $l['nama_petani'] : 'Ahmad Wijaya' ?></td>
                            <td><strong><?= number_format($l['luas'], 2, ',', '.') ?></strong></td>
                            <td class="text-muted" title="<?= $l['lokasi'] ?>">
                                <?= (strlen($l['lokasi']) > 30) ? substr($l['lokasi'], 0, 30).'...' : $l['lokasi'] ?>
                            </td>
                            <td>
                                <?php 
                                    $st = strtolower($l['status_lahan']);
                                    if($st == 'aktif') echo '<span class="badge-lonjong badge-aktif">Aktif</span>';
                                    elseif($st == 'nonaktif') echo '<span class="badge-lonjong badge-nonaktif">Nonaktif</span>';
                                    else echo '<span class="badge-lonjong badge-tidak-produktif">Tidak Produktif</span>';
                                ?>
                            </td>
                            <td class="text-center">
                                <button class="btn-action-icon btn-view-map"
                                    onclick="focusToMap('<?= $l['latitude'] ?>', '<?= $l['longitude'] ?>')"
                                    title="Lihat Titik Spasial">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </button>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <!-- Detail (Semua akses bisa lihat) -->
                                    <a href="<?= base_url($route.'/lahan/detail/'.$l['id_lahan']) ?>"
                                        class="btn-action-icon btn-act-detail" title="Detail">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>

                                    <!-- AKSES KONTROL EDIT & HAPUS: Hanya bisa diklik oleh Petani, Admin disabled total -->
                                    <?php if ($role == 'Petani'): ?>
                                    <a href="<?= base_url('petani/lahan/edit/'.$l['id_lahan']) ?>"
                                        class="btn-action-icon btn-act-edit" title="Edit">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <a href="<?= base_url('petani/lahan/hapus/'.$l['id_lahan']) ?>"
                                        class="btn-action-icon btn-act-delete"
                                        onclick="return confirm('Hapus lahan kebun ini?')" title="Hapus">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                    <?php else: ?>
                                    <!-- Tampilan disabled untuk Admin -->
                                    <button class="btn-action-icon" disabled><i class="bi bi-pencil-fill"></i></button>
                                    <button class="btn-action-icon" disabled><i class="bi bi-trash-fill"></i></button>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>

<script>
function focusToMap(lat, lng) {
    if (!lat || !lng) {
        alert('Koordinat titik lahan belum ditentukan!');
        return;
    }
    alert('Membuka koordinat spasial: ' + lat + ', ' + lng);
}
</script>