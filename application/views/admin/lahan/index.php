<!-- ALERT FLASH MESSAGES -->
<?php if ($this->session->flashdata('success')) : ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle mr-1"></i> <?= $this->session->flashdata('success'); ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif; ?>

<!-- CARD FILTER DATA LAHAN -->
<div class="card shadow-sm border-0 mb-4" style="border-radius: var(--radius-card);">
    <div class="card-body bg-white rounded-lg">
        <h6 class="font-weight-bold text-muted mb-3"><i class="fas fa-filter mr-1"></i> Filter Data Lahan</h6>
        <form action="<?= base_url('admin/lahan') ?>" method="GET">
            <div class="form-row align-items-end">
                <div class="col-md-4 mb-2">
                    <label class="small font-weight-bold text-secondary">Status Lahan</label>
                    <select name="status_lahan" class="form-control form-control-sm"
                        style="border-color: #bfa594; height: 38px; border-radius: 8px;">
                        <option value="">-- Semua Status --</option>
                        <option value="Active" <?= $this->input->get('status_lahan') == 'Active' ? 'selected' : ''; ?>>Active</option>
                        <option value="Inactive" <?= $this->input->get('status_lahan') == 'Inactive' ? 'selected' : ''; ?>>Inactive</option>
                    </select>
                </div>

                <div class="col-md-5 mb-2">
                    <label class="small font-weight-bold text-secondary">Cari Nama Lahan / Alamat / Lokasi</label>
                    <input type="text" name="keyword" class="form-control form-control-sm"
                        style="border-color: #bfa594; height: 38px; border-radius: 8px;"
                        placeholder="Masukkan nama lahan, daerah, atau kota..."
                        value="<?= htmlspecialchars($this->input->get('keyword') ?? ''); ?>">
                </div>

                <div class="col-md-3 mb-2">
                    <div class="btn-group w-100">
                        <button type="submit" class="btn btn-coffee-submit btn-sm w-100 font-weight-bold" style="height: 38px;">
                            <i class="fas fa-search"></i> Cari
                        </button>
                        <a href="<?= base_url('admin/lahan') ?>" class="btn btn-outline-secondary btn-sm d-flex align-items-center justify-content-center">
                            <i class="fas fa-undo"></i>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- CARD TABEL DATA LAHAN -->
<div class="card shadow border-0" style="border-radius: var(--radius-card); overflow: hidden;">
    <div class="card-header card-header-coffee d-flex justify-content-between align-items-center py-3">
        <h5 class="m-0 font-weight-bold" style="font-size: 1.05rem;"><i class="fas fa-map-marked-alt mr-2"></i>Daftar Pengawasan Seluruh Lahan</h5>
        <span class="badge badge-table-total px-3 py-2 font-weight-bold" style="border-radius: 20px;">Total: <?= count($lahan) ?> Item Terdata</span>
    </div>
    <div class="card-body bg-white">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover mb-0" width="100%" cellspacing="0" style="font-size: 0.85rem;">
                <thead class="thead-light text-center">
                    <tr>
                        <th width="5%" class="align-middle">No</th>
                        <th width="10%" class="align-middle">Foto Lahan</th>
                        <th class="align-middle">Nama Lahan</th>
                        <th class="align-middle">Jenis Kopi</th>
                        <th class="align-middle">Jenis Tanah</th>
                        <th class="align-middle">Luas (Ha)</th>
                        <th class="align-middle">Alamat / Lokasi</th>
                        <th class="align-middle">Catatan Perawatan</th>
                        <th width="12%" class="align-middle">Status Lahan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($lahan)) : ?>
                    <?php $no = 1; foreach ($lahan as $lh) : ?>
                    <tr>
                        <td class="text-center align-middle font-weight-bold text-muted"><?= $no++; ?></td>
                        <td class="text-center align-middle">
                            <?php if (!empty($lh['foto_lahan'])) : ?>
                            <img src="<?= base_url('assets/uploads/lahan/' . $lh['foto_lahan']) ?>" class="img-thumbnail rounded shadow-sm" style="max-width: 75px; height: auto;">
                            <?php else : ?>
                            <span class="badge badge-secondary p-1 small shadow-sm">No Photo</span>
                            <?php endif; ?>
                        </td>
                        <td class="align-middle">
                            <span class="font-weight-bold" style="color: var(--roasted-brown);"><?= $lh['nama_lahan']; ?></span>
                            <br><small class="text-muted font-italic">Pemilik ID: #<?= $lh['id_user']; ?></small>
                        </td>
                        <td class="align-middle text-center font-weight-bold"><?= $lh['jenis_kopi']; ?></td>
                        <td class="align-middle text-center">
                            <?= isset($lh['jenis_tanah']) && !empty($lh['jenis_tanah']) ? $lh['jenis_tanah'] : '<span class="text-muted font-italic">-</span>'; ?>
                        </td>
                        <td class="align-middle text-center text-dark font-weight-bold"><?= number_format($lh['luas'], 2, ',', '.'); ?> Ha</td>
                        <td class="align-middle text-muted small"><?= $lh['lokasi']; ?></td>
                        <td class="align-middle text-secondary small">
                            <?= !empty($lh['catatan']) ? character_limiter($lh['catatan'], 50) : '<span class="text-muted font-italic">- Tidak ada catatan -</span>'; ?>
                        </td>
                        <td class="text-center align-middle">
                            <?php if (strtolower($lh['status_lahan']) == 'active') : ?>
                            <span class="badge badge-success px-3 py-2 shadow-sm" style="border-radius: 20px;"><i class="fas fa-check-circle mr-1"></i> Active</span>
                            <?php else : ?>
                            <span class="badge badge-danger px-3 py-2 shadow-sm" style="border-radius: 20px;"><i class="fas fa-times-circle mr-1"></i> Inactive</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else : ?>
                    <tr>
                        <td colspan="9" class="text-center text-muted py-5">
                            <i class="fas fa-folder-open fa-3x mb-3 text-secondary"></i>
                            <p class="mb-0 font-weight-bold text-secondary">Data lahan tidak ditemukan atau filter tidak cocok.</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
