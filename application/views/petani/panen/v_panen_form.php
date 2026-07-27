<style>
    .custom-card { border-radius: 14px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.05); background: #fff; }
    .card-header-custom { padding: 18px 24px; border-bottom: 1px solid rgba(74, 44, 17, 0.06); font-weight: 700; color: #2C1808; font-size: 0.95rem; }
    .card-body-custom { padding: 24px; }
    
    .form-control, .custom-select { border-radius: 10px; font-size: 0.9rem; padding: 10px 15px; height: auto; border: 1px solid #ddd; }
    .form-control:focus, .custom-select:focus { border-color: #E6A15C; box-shadow: none; }
    label { font-weight: 600; font-size: 0.85rem; color: #555; margin-bottom: 8px; }
</style>

<div class="mb-3">
    <a href="<?= base_url('petani/panen'); ?>" class="btn btn-light border font-weight-bold" style="border-radius: 10px;"><i class="bi bi-arrow-left mr-1"></i> Kembali</a>
</div>

<?php if ($this->session->flashdata('error')): ?>
<div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert" style="border-radius: 10px;">
    <i class="bi bi-exclamation-triangle-fill mr-1"></i> <?= $this->session->flashdata('error'); ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif; ?>

<div class="custom-card">
    <div class="card-header-custom">
        <i class="bi bi-file-earmark-text mr-2 text-warning"></i> Form Data Panen
    </div>
    <div class="card-body-custom">
        <?php 
        $action_url = isset($panen) ? base_url('petani/panen/edit/'.$panen['id_panen']) : base_url('petani/panen/tambah');
        ?>
        <form action="<?= $action_url; ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 form-group mb-3">
                    <label>Pilih Lahan <span class="text-danger">*</span></label>
                    <select name="id_lahan" class="form-control custom-select" required>
                        <option value="">-- Pilih Lahan --</option>
                        <?php foreach ($lahan_list as $l): ?>
                            <option value="<?= $l['id_lahan']; ?>" <?= (isset($panen) && $panen['id_lahan'] == $l['id_lahan']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($l['nama_lahan']) . ' - ' . htmlspecialchars(substr($l['lokasi'], 0, 30)) . '...'; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label>Tanggal Panen <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_panen" class="form-control" value="<?= isset($panen) ? $panen['tanggal_panen'] : date('Y-m-d'); ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group mb-3">
                    <label>Jumlah Panen (Kg) <span class="text-danger">*</span></label>
                    <input type="number" name="jumlah_panen" class="form-control" min="1" value="<?= isset($panen) ? $panen['jumlah_panen'] : ''; ?>" required placeholder="Contoh: 150">
                </div>
            </div>

            <div class="form-group mb-3">
                <label>Catatan Tambahan (Opsional)</label>
                <textarea name="catatan" class="form-control" rows="3" placeholder="Masukkan kondisi lahan, hama, atau catatan khusus lainnya..."><?= isset($panen) ? $panen['catatan'] : ''; ?></textarea>
            </div>

            <div class="form-group mb-4">
                <label>Foto Panen <?= !isset($panen) ? '<span class="text-danger">*</span>' : '<small class="text-muted">(Abaikan jika tidak ingin mengubah foto)</small>'; ?></label>
                <input type="file" name="foto_panen" class="form-control-file p-2 border rounded w-100" <?= !isset($panen) ? 'required' : ''; ?> accept="image/*">
                <small class="form-text text-muted mt-1">Format: JPG, JPEG, PNG. Ukuran maksimal: 2MB.</small>
                
                <?php if (isset($panen) && $panen['foto_panen']): ?>
                    <div class="mt-3 p-2 border rounded d-inline-block bg-light">
                        <span class="d-block small text-muted mb-1 font-weight-bold">Foto saat ini:</span>
                        <img src="<?= base_url('uploads/panen/'.$panen['foto_panen']); ?>" alt="Foto Panen" class="img-thumbnail" style="height: 150px; object-fit: cover;">
                    </div>
                <?php endif; ?>
            </div>

            <hr class="mt-4 mb-3 border-light">
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn text-white font-weight-bold px-4 py-2" style="background-color: #4A2C11; border-radius: 10px;">
                    <i class="bi bi-save mr-2"></i> Simpan Data Panen
                </button>
            </div>
        </form>
    </div>
</div>