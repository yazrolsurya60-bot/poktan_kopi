

<div class="content-wrapper" style="min-height: 100vh; padding: 25px; background-color: #fcfaf7;">
    <main id="main" class="main">
        
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="fw-bold mb-1" style="color: #4a2c11;">Manajemen Petani</h2>
                <nav>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard'); ?>" style="color: #d4a373; text-decoration: none;">Dashboard</a></li>
                        <li class="breadcrumb-item active" style="color: #4a2c11;">Data Petani</li>
                    </ol>
                </nav>
            </div>
            <a href="<?= base_url('admin/petani/export_page'); ?>" class="btn shadow-sm px-4 py-2" style="background-color: #4a2c11; color: #fff; border-radius: 10px;">
                <i class="bi bi-file-earmark-arrow-down me-2"></i> Export Data
            </a>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm p-4" style="border-radius: 15px; border-left: 5px solid #d4a373;">
                    <div class="d-flex align-items-center">
                        <div class="p-3 rounded-circle" style="background-color: #fdfaf5; color: #d4a373;">
                            <i class="bi bi-people-fill fs-4"></i>
                        </div>
                        <div class="ms-3">
                            <small class="text-muted text-uppercase fw-bold" style="font-size: 10px; letter-spacing: 1px;">Total Petani</small>
                            <h4 class="mb-0 fw-bold" style="color: #4a2c11;"><?= !empty($daftar_petani) ? count($daftar_petani) : 0; ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
            <div class="card-body p-0">
                <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                    <form method="GET" action="<?= base_url('admin/petani'); ?>" class="m-0">
                        <select name="status" class="form-select border-0 bg-light" onchange="this.form.submit()" style="border-radius: 8px; cursor: pointer;">
                            <option value="">Semua Status</option>
                            <option value="Terverifikasi" <?= (isset($status_filter) && $status_filter == 'Terverifikasi') ? 'selected' : ''; ?>>Terverifikasi</option>
                            <option value="Pending" <?= (isset($status_filter) && $status_filter == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                            <option value="Ditolak" <?= (isset($status_filter) && $status_filter == 'Ditolak') ? 'selected' : ''; ?>>Ditolak</option>
                        </select>
                    </form>
                    <a href="<?= base_url('admin/petani/tambah'); ?>" class="btn px-4" style="background-color: #d4a373; color: #fff; border-radius: 10px;">
                        + Tambah Petani
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background-color: #fdfaf5;">
                            <tr style="color: #4a2c11; text-transform: uppercase; font-size: 13px;">
                                <th class="p-4">No</th>
                                <th>Nama Petani</th>
                                <th>NIK</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($daftar_petani)): $no = 1; foreach($daftar_petani as $p): ?>
                            <tr>
                                <td class="ps-4"><?= $no++; ?></td>
                                <td class="fw-bold" style="color: #4a2c11;"><?= htmlspecialchars($p['nama_petani'] ?? '-'); ?></td>
                                <td><?= htmlspecialchars($p['nik'] ?? '-'); ?></td>
                                <td>
                                    <?php 
                                    $status = $p['status_petani'] ?? 'Pending'; 
                                    $bg = ($status == 'Terverifikasi') ? '#606c38' : (($status == 'Pending') ? '#d4a373' : '#bc4749');
                                    ?>
                                    <span class="badge" style="background-color: <?= $bg; ?>; color: #fff; padding: 6px 12px; border-radius: 6px; font-weight: 500;">
                                        <?= $status; ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group gap-1">
                                        <a href="<?= base_url('admin/petani/detail/'.$p['id_petani']); ?>" class="btn btn-sm" style="background-color: #e6ccb2; color: #4a2c11;">Detail</a>
                                        <?php if ($status == 'Pending'): ?>
                                            <a href="<?= base_url('admin/petani/verifikasi/'.$p['id_petani']); ?>" class="btn btn-sm btn-success">Verifikasi</a>
                                        <?php endif; ?>
                                        <a href="<?= base_url('admin/petani/hapus/'.$p['id_petani']); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin hapus?');">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; else: ?>
                            <tr><td colspan="5" class="text-center py-5 text-muted">Belum ada data petani.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
