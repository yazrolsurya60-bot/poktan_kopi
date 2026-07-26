<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    /* STYLING KHUSUS HALAMAN LAHAN */
    .text-coffee-primary { color: #241408; }
    .bg-success-light { background-color: #e8f5e9 !important; }
    .bg-warning-light { background-color: #fff3e0 !important; }
    .bg-info-light { background-color: #e3f2fd !important; }
    .text-orange { color: #f57c00 !important; }
    .bg-orange-light { background-color: #fff3e0 !important; }

    .table-modern thead th {
        background-color: #f8f9fa;
        color: #6c757d; font-weight: 700; font-size: 0.8rem; text-transform: uppercase;
        letter-spacing: 0.5px; border-bottom: 1px solid #edf2f7 !important; border-top: none !important;
    }
    .table-modern tbody td { border-bottom: 1px solid #edf2f7 !important; color: #495057; font-size: 0.9rem; }
    .table-modern tbody tr:hover { background-color: #fdfcfb; }

    .btn-action {
        width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center;
        border-radius: 6px; font-size: 0.85rem;
    }
</style>

<!-- KONTEN UTAMA LAHAN -->
<?php if ($this->session->flashdata('success')): ?>
<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
    <i class="fas fa-check-circle mr-1"></i> <?= $this->session->flashdata('success'); ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif; ?>

<!-- Statistik Lahan -->
<div class="row no-gutters mx-n2 mb-4">
    <div class="col-12 col-sm-6 col-md-3 px-2 mb-3 mb-md-0">
        <div class="card border-0 shadow-sm h-100" style="border-radius: var(--radius-card, 14px);">
            <div class="card-body d-flex align-items-center justify-content-between p-3">
                <div>
                    <span class="text-muted font-weight-bold small d-block mb-1">Total Lahan</span>
                    <h2 class="font-weight-bold text-dark mb-0"><?= count($lahan) ?></h2>
                    <span class="text-muted" style="font-size: 11px;">Semua Lahan</span>
                </div>
                <div class="bg-warning-light text-warning rounded p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; border-radius: 12px !important;">
                    <i class="fas fa-map fa-lg"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3 px-2 mb-3 mb-md-0">
        <div class="card border-0 shadow-sm h-100" style="border-radius: var(--radius-card, 14px);">
            <div class="card-body d-flex align-items-center justify-content-between p-3">
                <div>
                    <span class="text-muted font-weight-bold small d-block mb-1">Lahan Aktif</span>
                    <h2 class="font-weight-bold text-dark mb-0">
                        <?php $aktif = 0; foreach ($lahan as $lh) { if (strtolower($lh['status_lahan']) == 'active' || strtolower($lh['status_lahan']) == 'aktif') $aktif++; } echo $aktif; ?>
                    </h2>
                    <span class="text-success font-weight-bold d-block mt-1" style="font-size: 11px;">
                        <?= count($lahan) > 0 ? round(($aktif / count($lahan)) * 100, 1) : 0; ?>% dari total
                    </span>
                </div>
                <div class="bg-success-light text-success rounded p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; border-radius: 12px !important;">
                    <i class="fas fa-check-circle fa-lg"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3 px-2 mb-3 mb-sm-0">
        <div class="card border-0 shadow-sm h-100" style="border-radius: var(--radius-card, 14px);">
            <div class="card-body d-flex align-items-center justify-content-between p-3">
                <div>
                    <span class="text-muted font-weight-bold small d-block mb-1">Lahan Nonaktif</span>
                    <h2 class="font-weight-bold text-dark mb-0">
                        <?php $nonaktif = 0; foreach ($lahan as $lh) { if (strtolower($lh['status_lahan']) == 'inactive' || strtolower($lh['status_lahan']) == 'nonaktif') $nonaktif++; } echo $nonaktif; ?>
                    </h2>
                    <span class="text-muted d-block mt-1" style="font-size: 11px;">
                        <?= count($lahan) > 0 ? round(($nonaktif / count($lahan)) * 100, 1) : 0; ?>% dari total
                    </span>
                </div>
                <div class="bg-orange-light text-orange rounded p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; border-radius: 12px !important;">
                    <i class="fas fa-times-circle fa-lg"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3 px-2">
        <div class="card border-0 shadow-sm h-100" style="border-radius: var(--radius-card, 14px);">
            <div class="card-body d-flex align-items-center justify-content-between p-3">
                <div>
                    <span class="text-muted font-weight-bold small d-block mb-1">Total Luas (Ha)</span>
                    <h2 class="font-weight-bold text-dark mb-0">
                        <?php $total_luas = 0; foreach ($lahan as $lh) { $total_luas += (float)$lh['luas']; } echo number_format($total_luas, 2, ',', '.'); ?>
                    </h2>
                    <span class="text-info font-weight-bold d-block mt-1" style="font-size: 11px;">Hektar Lahan</span>
                </div>
                <div class="bg-info-light text-info rounded p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; border-radius: 12px !important;">
                    <i class="fas fa-chart-area fa-lg"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter & Tambah -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: var(--radius-card, 14px);">
    <div class="card-body p-3">
        <form action="<?= base_url('petani/lahan') ?>" method="GET" class="m-0">
            <div class="form-row align-items-center justify-content-between">
                <div class="col-12 col-md-8">
                    <div class="form-row">
                        <div class="col-12 col-sm-5 mb-2 mb-sm-0">
                            <input type="text" name="keyword" class="form-control form-control-sm bg-light border-0 pl-3" placeholder="Cari nama lahan atau alamat..." value="<?= $this->input->get('keyword'); ?>" style="height: 38px; border-radius: 6px;">
                        </div>
                        <div class="col-12 col-sm-4 mb-2 mb-sm-0">
                            <select name="status_lahan" class="form-control form-control-sm bg-light border-0" style="height: 38px; border-radius: 6px;">
                                <option value="">Semua Status</option>
                                <option value="Active" <?= $this->input->get('status_lahan') == 'Active' ? 'selected' : ''; ?>>Active</option>
                                <option value="Inactive" <?= $this->input->get('status_lahan') == 'Inactive' ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-3 d-flex">
                            <button type="submit" class="btn btn-sm text-white flex-grow-1 mr-2" style="border-radius: 6px; background-color: var(--amber-cream); border-color: var(--amber-cream);">
                                <i class="fas fa-search"></i> Cari
                            </button>
                            <a href="<?= base_url('petani/lahan') ?>" class="btn btn-sm btn-secondary" style="border-radius: 6px;"><i class="fas fa-sync-alt"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 text-right mt-2 mt-md-0">
                    <a href="<?= base_url('petani/lahan/tambah') ?>" class="btn font-weight-bold text-white px-3" style="background-color: var(--roasted-brown); height: 38px; border-radius: 6px; display: inline-flex; align-items: center;">
                        <i class="fas fa-plus mr-2"></i> Tambah Lahan
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Tabel Data Lahan -->
<div class="card border-0 shadow-sm" style="border-radius: var(--radius-card, 14px); overflow: hidden;">
    <div class="table-responsive">
        <table class="table table-modern align-middle mb-0">
            <thead>
                <tr>
                    <th class="text-center" width="5%">No</th>
                    <th width="10%" class="text-center">Foto Lahan</th>
                    <th width="16%">Nama Lahan</th>
                    <th width="12%">Jenis Kopi</th>
                    <th width="12%">Jenis Tanah</th>
                    <th width="8%">Luas (Ha)</th>
                    <th width="15%">Lokasi / Alamat</th>
                    <th width="12%">Catatan</th>
                    <th class="text-center" width="10%">Status</th>
                    <th class="text-center" width="10%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($lahan)): ?>
                <?php $no = 1; foreach ($lahan as $lh): ?>
                <tr>
                    <td class="text-center align-middle font-weight-bold text-muted"><?= $no++; ?></td>
                    <td class="text-center align-middle">
                        <?php if (!empty($lh['foto_lahan'])): ?>
                            <img src="<?= base_url('assets/uploads/lahan/' . $lh['foto_lahan']) ?>" class="img-thumbnail rounded shadow-sm" style="max-width: 60px; height: auto; object-fit: cover;">
                        <?php else: ?>
                            <span class="badge badge-secondary p-1 small text-white" style="font-size: 10px;">No Photo</span>
                        <?php endif; ?>
                    </td>
                    <td class="align-middle">
                        <span class="font-weight-bold text-dark"><?= $lh['nama_lahan']; ?></span>
                        <small class="text-muted d-block" style="font-size: 10px;">Lat/Lng: <?= $lh['latitude'] ?? '-'; ?>, <?= $lh['longitude'] ?? '-'; ?></small>
                    </td>
                    <td class="align-middle font-weight-bold text-coffee-primary"><?= isset($lh['jenis_kopi']) ? $lh['jenis_kopi'] : '-'; ?></td>
                    <td class="align-middle text-dark font-weight-medium"><?= isset($lh['jenis_tanah']) ? $lh['jenis_tanah'] : '<span class="text-muted font-italic">-</span>'; ?></td>
                    <td class="align-middle font-weight-bold text-dark"><?= number_format((float)$lh['luas'], 2, ',', '.'); ?></td>
                    <td class="align-middle text-muted small"><?= isset($lh['lokasi']) ? character_limiter($lh['lokasi'], 35) : '-'; ?></td>
                    <td class="align-middle text-secondary small"><?= (!empty($lh['catatan'])) ? character_limiter($lh['catatan'], 30) : '<span class="text-light-muted">-</span>'; ?></td>
                    <td class="text-center align-middle">
                        <?php if (strtolower($lh['status_lahan']) == 'active' || strtolower($lh['status_lahan']) == 'aktif'): ?>
                            <span class="badge bg-success-light text-success font-weight-bold px-3 py-2" style="border-radius: 4px; font-size: 11px;">Active</span>
                        <?php else: ?>
                            <span class="badge bg-warning-light text-orange font-weight-bold px-3 py-2" style="border-radius: 4px; font-size: 11px;">Inactive</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center align-items-center">
                            <a href="<?= base_url('petani/lahan/detail/' . $lh['id_lahan']) ?>" class="btn btn-action mr-1 text-white" style="background-color: #5c3d2e;" title="Detail"><i class="fas fa-eye"></i></a>
                            <a href="<?= base_url('petani/lahan/edit/' . $lh['id_lahan']) ?>" class="btn btn-warning btn-action text-white mr-1" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                            <a href="<?= base_url('petani/lahan/hapus/' . $lh['id_lahan']) ?>" class="btn btn-danger btn-action" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data lahan ini?')"><i class="fas fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="10" class="text-center text-muted py-5 bg-white">
                        <i class="fas fa-folder-open fa-3x mb-3 text-secondary"></i>
                        <h6 class="font-weight-bold text-secondary mb-1">Belum Ada Data Lahan Kopi</h6>
                        <small class="text-muted">Silakan lakukan penambahan lahan menggunakan menu di atas.</small>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>