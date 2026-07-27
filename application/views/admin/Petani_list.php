<!-- FLASH MESSAGES / NOTIFIKASI BERHASIL ATAU GAGAL -->
<?php if ($this->session->flashdata('pesan')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3"
        style="border-radius:12px; background-color: #E8F5E9; border: 1px solid #C8E6C9; color: #2E7D32; font-weight: 600;">
        <i class="bi bi-check-circle-fill mr-2"></i><?= $this->session->flashdata('pesan'); ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show mb-3"
        style="border-radius:12px; background-color: #FFEBEE; border: 1px solid #FFCDD2; color: #C62828; font-weight: 600;">
        <i class="bi bi-exclamation-triangle-fill mr-2"></i><?= $this->session->flashdata('error'); ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
<?php endif; ?>

<!-- STATISTIK KPI CARDS -->
<div class="row mb-4">
    <div class="col-md-3 mb-3 mb-md-0">
        <div class="card border-0 shadow-sm" style="border-radius: 14px; background: #fff;">
            <div class="card-body p-3 d-flex align-items-center">
                <div class="rounded-circle d-flex justify-content-center align-items-center mr-3"
                    style="width: 48px; height: 48px; background-color: #FFF3E0; color: #E6A15C; flex-shrink:0;">
                    <i class="bi bi-people-fill" style="font-size: 1.3rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted" style="font-size: 0.8rem; font-weight: 600;">Total Petani</h6>
                    <h3 class="mb-0 font-weight-bold" style="font-weight: 700; color: #2C1808;">
                        <?= isset($total_petani) ? $total_petani : 0; ?></h3>
                    <small class="text-muted" style="font-size: 0.7rem;">Semua Petani</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3 mb-md-0">
        <div class="card border-0 shadow-sm" style="border-radius: 14px; background: #fff;">
            <div class="card-body p-3 d-flex align-items-center">
                <div class="rounded-circle d-flex justify-content-center align-items-center mr-3"
                    style="width: 48px; height: 48px; background-color: #E8F5E9; color: #4CAF50; flex-shrink:0;">
                    <i class="bi bi-check-circle-fill" style="font-size: 1.3rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted" style="font-size: 0.8rem; font-weight: 600;">Active</h6>
                    <h3 class="mb-0 font-weight-bold" style="font-weight: 700; color: #2C1808;">
                        <?= isset($active_count) ? $active_count : 0; ?></h3>
                    <?php $pct_active = isset($total_petani) && $total_petani > 0 ? round(($active_count / $total_petani) * 100, 1) : 0; ?>
                    <small class="text-muted" style="font-size: 0.7rem;"><?= $pct_active; ?>% dari total</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3 mb-md-0">
        <div class="card border-0 shadow-sm" style="border-radius: 14px; background: #fff;">
            <div class="card-body p-3 d-flex align-items-center">
                <div class="rounded-circle d-flex justify-content-center align-items-center mr-3"
                    style="width: 48px; height: 48px; background-color: #FFF8E1; color: #FFC107; flex-shrink:0;">
                    <i class="bi bi-clock-history" style="font-size: 1.3rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted" style="font-size: 0.8rem; font-weight: 600;">Inactive</h6>
                    <h3 class="mb-0 font-weight-bold" style="font-weight: 700; color: #2C1808;">
                        <?= isset($inactive_count) ? $inactive_count : 0; ?></h3>
                    <?php $pct_inactive = isset($total_petani) && $total_petani > 0 ? round(($inactive_count / $total_petani) * 100, 1) : 0; ?>
                    <small class="text-muted" style="font-size: 0.7rem;"><?= $pct_inactive; ?>% dari total</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm" style="border-radius: 14px; background: #fff;">
            <div class="card-body p-3 d-flex align-items-center">
                <div class="rounded-circle d-flex justify-content-center align-items-center mr-3"
                    style="width: 48px; height: 48px; background-color: #FFEBEE; color: #F44336; flex-shrink:0;">
                    <i class="bi bi-slash-circle-fill" style="font-size: 1.3rem;"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted" style="font-size: 0.8rem; font-weight: 600;">Suspended</h6>
                    <h3 class="mb-0 font-weight-bold" style="font-weight: 700; color: #2C1808;">
                        <?= isset($suspended_count) ? $suspended_count : 0; ?></h3>
                    <?php $pct_suspend = isset($total_petani) && $total_petani > 0 ? round(($suspended_count / $total_petani) * 100, 1) : 0; ?>
                    <small class="text-muted" style="font-size: 0.7rem;"><?= $pct_suspend; ?>% dari total</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CARD TABLE DATA -->
<div class="card border-0 shadow-sm" style="border-radius: 14px; background: #fff;">
    <div class="card-body p-4">
        <!-- TOOLBAR -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap" style="gap: 15px;">
            <div class="d-flex flex-wrap align-items-center" style="gap: 10px;">
                <!-- FILTER SEARCH -->
                <div class="input-group" style="width: 220px;">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white border-right-0"
                            style="border-radius: 8px 0 0 8px; border-color: #e0e0e0;">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                    </div>
                    <input type="text" id="searchPetani" class="form-control border-left-0 pl-0"
                        placeholder="Cari petani..."
                        style="border-radius: 0 8px 8px 0; border-color: #e0e0e0; font-size: 0.85rem;">
                </div>

                <!-- FILTER FORM -->
                <form action="<?= base_url('admin/petani'); ?>" method="GET" class="d-flex align-items-center"
                    style="gap: 10px;">
                    <select name="status" class="form-control custom-select text-muted" onchange="this.form.submit()"
                        style="width: 140px; border-radius: 8px; border-color: #e0e0e0; font-size: 0.85rem;">
                        <option value="">Semua Status</option>
                        <option value="Active" <?= (isset($status_filter) && $status_filter == 'Active') ? 'selected' : ''; ?>>Active</option>
                        <option value="Inactive" <?= (isset($status_filter) && $status_filter == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                        <option value="Suspended" <?= (isset($status_filter) && $status_filter == 'Suspended') ? 'selected' : ''; ?>>Suspended</option>
                    </select>
                    <select name="wilayah" class="form-control custom-select text-muted" onchange="this.form.submit()"
                        style="width: 160px; border-radius: 8px; border-color: #e0e0e0; font-size: 0.85rem;">
                        <option value="">Semua Wilayah</option>
                        <?php if (!empty($semua_wilayah)): ?>
                            <?php foreach ($semua_wilayah as $w): ?>
                                <option value="<?= $w['id_wilayah']; ?>" <?= (isset($wilayah_filter) && $wilayah_filter == $w['id_wilayah']) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($w['nama_wilayah']); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </form>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="d-flex align-items-center" style="gap: 10px;">
                <a href="<?= base_url('admin/petani/tambah'); ?>" class="btn text-white px-3 py-2"
                    style="background-color: var(--roasted-brown, #4A2C11); font-weight: 600; border-radius: 8px; font-size: 0.85rem;">
                    <i class="bi bi-plus-lg mr-1"></i> Tambah Petani
                </a>
                <a href="<?= base_url('admin/petani/export_page'); ?>"
                    class="btn bg-white text-secondary border px-3 py-2"
                    style="border-radius: 8px; font-size: 0.85rem; border-color: #e0e0e0;">
                    <i class="bi bi-box-arrow-up mr-1"></i> Export
                </a>
            </div>
        </div>

        <!-- TABLE -->
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0"
                style="border-collapse: separate; border-spacing: 0 8px;">
                <thead>
                    <tr style="background-color: transparent;">
                        <th class="border-0 text-muted pb-2"
                            style="font-weight: 600; font-size: 0.8rem; padding-left: 15px;">No</th>
                        <th class="border-0 text-muted pb-2" style="font-weight: 600; font-size: 0.8rem;">Foto</th>
                        <th class="border-0 text-muted pb-2" style="font-weight: 600; font-size: 0.8rem;">Nama Petani
                        </th>
                        <th class="border-0 text-muted pb-2" style="font-weight: 600; font-size: 0.8rem;">NIK</th>
                        <th class="border-0 text-muted pb-2" style="font-weight: 600; font-size: 0.8rem;">No HP</th>
                        <th class="border-0 text-muted pb-2" style="font-weight: 600; font-size: 0.8rem;">Wilayah</th>
                        <th class="border-0 text-muted pb-2" style="font-weight: 600; font-size: 0.8rem;">Status</th>
                        <th class="border-0 text-muted pb-2 text-center" style="font-weight: 600; font-size: 0.8rem;">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody id="tbodyPetani">
                    <?php if (!empty($daftar_petani)): ?>
                        <?php $no = $this->input->get('per_page') ? $this->input->get('per_page') + 1 : 1;
                        foreach ($daftar_petani as $p): ?>
                            <tr style="box-shadow: 0 2px 6px rgba(0,0,0,0.02); background-color: #fff; border-radius: 8px;">
                                <td class="border-0 font-weight-bold"
                                    style="border-top-left-radius: 8px; border-bottom-left-radius: 8px; padding-left: 15px; width: 40px; font-weight:700; vertical-align:middle; font-size:0.85rem;">
                                    <?= $no++; ?></td>
                                <td class="border-0" style="vertical-align:middle;">
                                    <?php if (!empty($p['foto_profil'])): ?>
                                        <img src="<?= base_url('uploads/dokumen/' . $p['foto_profil']); ?>" class="rounded-circle"
                                            width="38" height="38" style="object-fit:cover;">
                                    <?php else: ?>
                                        <div class="rounded-circle bg-secondary d-flex justify-content-center align-items-center text-white"
                                            style="width: 38px; height: 38px; font-size: 1.1rem;">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="border-0 font-weight-bold text-dark"
                                    style="font-weight: 700; vertical-align:middle; font-size:0.85rem;">
                                    <?= htmlspecialchars($p['nama_petani']); ?></td>
                                <td class="border-0 text-muted" style="vertical-align:middle; font-size:0.85rem;">
                                    <?= htmlspecialchars($p['nik'] ?? '-'); ?></td>
                                <td class="border-0 text-muted" style="vertical-align:middle; font-size:0.85rem;">
                                    <?= htmlspecialchars($p['no_hp'] ?? '-'); ?></td>
                                <td class="border-0" style="vertical-align:middle;">
                                    <?php if (!empty($p['wilayah'])): ?>
                                        <?php foreach ($p['wilayah'] as $w): ?>
                                            <span class="badge rounded-pill px-2 py-1 mb-1 d-inline-block"
                                                style="background-color: #F5E6D3; color: #8D6E63; font-weight: 600; font-size: 0.7rem;">
                                                <?= htmlspecialchars($w['nama_wilayah']); ?>
                                            </span>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <span class="text-muted" style="font-size: 0.8rem;">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="border-0" style="vertical-align:middle;">
                                    <?php
                                    $badge_color = 'bg-secondary';
                                    $text_color = 'text-white';
                                    if ($p['status_petani'] == 'Active') {
                                        $badge_color = '#E8F5E9';
                                        $text_color = '#4CAF50';
                                    } elseif ($p['status_petani'] == 'Inactive') {
                                        $badge_color = '#FFF8E1';
                                        $text_color = '#FFC107';
                                    } elseif ($p['status_petani'] == 'Suspended') {
                                        $badge_color = '#FFEBEE';
                                        $text_color = '#F44336';
                                    }
                                    ?>
                                    <span class="badge rounded-pill px-3 py-2"
                                        style="background-color: <?= $badge_color; ?>; color: <?= $text_color; ?>; font-weight: 600; font-size: 0.75rem;">
                                        <?= $p['status_petani']; ?>
                                    </span>
                                </td>
                                <td class="border-0 text-center"
                                    style="border-top-right-radius: 8px; border-bottom-right-radius: 8px; vertical-align:middle;">
                                    <div class="d-flex justify-content-center" style="gap: 5px;">
                                        <a href="<?= base_url('admin/petani/detail/' . $p['id_petani']); ?>" class="btn btn-sm"
                                            style="background-color: #F5E6D3; color: #8D6E63; border-radius: 6px;"
                                            title="Detail">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="<?= base_url('admin/petani/verifikasi/' . $p['id_petani']); ?>"
                                            class="btn btn-sm"
                                            style="background-color: #E8F5E9; color: #4CAF50; border-radius: 6px;"
                                            title="Verifikasi">
                                            <i class="bi bi-patch-check-fill"></i>
                                        </a>
                                        <a href="<?= base_url('admin/petani/edit/' . $p['id_petani']); ?>" class="btn btn-sm"
                                            style="background-color: #FFF3E0; color: #FF9800; border-radius: 6px;" title="Edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <a href="<?= base_url('admin/petani/hapus/' . $p['id_petani']); ?>"
                                            onclick="return confirm('Yakin ingin menghapus data petani ini secara permanen?')"
                                            class="btn btn-sm"
                                            style="background-color: #FFEBEE; color: #F44336; border-radius: 6px;"
                                            title="Hapus">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 border-0 text-muted">Belum ada data petani terdaftar.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- FOOTER COUNTER & PAGINATION -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted" id="countPetani">
                Menampilkan <?= isset($daftar_petani) ? count($daftar_petani) : 0; ?> dari
                <?= isset($total_petani_filtered) ? $total_petani_filtered : 0; ?> data
            </small>

            <!-- TOMBOL PAGINATION DI KANAN BAWAH -->
            <nav aria-label="Page navigation">
                <?= isset($pagination_link) ? $pagination_link : ''; ?>
            </nav>
        </div>
    </div>
</div>

<!-- SCRIPT FILTER REALTIME -->
<script>
    document.getElementById('searchPetani')?.addEventListener('keyup', function () {
        var keyword = this.value.toLowerCase();
        var rows = document.querySelectorAll('#tbodyPetani tr');
        var visibleCount = 0;
        rows.forEach(function (row) {
            var text = row.textContent.toLowerCase();
            if (text.indexOf(keyword) > -1) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });
        var counter = document.getElementById('countPetani');
        if (counter) counter.textContent = 'Menampilkan ' + visibleCount + ' data';
    });
</script>