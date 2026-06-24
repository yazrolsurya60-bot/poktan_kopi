

<div class="content-wrapper" style="padding: 30px; background-color: #fcfaf7; min-height: 100vh;">
    <main id="main" class="main">
        
        <div class="pagetitle mb-4">
            <h1 style="color: #4a2c11; font-weight: 700;">Tambah Petani</h1>
            <p>Dashboard / Manajemen Petani / Tambah</p>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-body p-4">
                <h5 class="card-title fw-bold">Form Data Petani</h5>
                
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                
                <form action="<?= base_url('admin/petani/tambah_aksi'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Petani *</label>
                                <input type="text" name="nama_petani" class="form-control" placeholder="Masukkan nama petani" value="<?= set_value('nama_petani'); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">NIK *</label>
                                <input type="text" name="nik" class="form-control" placeholder="Masukkan NIK" value="<?= set_value('nik'); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">No HP *</label>
                                <input type="number" name="no_hp" class="form-control" placeholder="Masukkan no HP" value="<?= set_value('no_hp'); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Masukkan email" value="<?= set_value('email'); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Alamat *</label>
                                <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap" required><?= set_value('alamat'); ?></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Foto Profil</label>
                                <div class="border p-4 text-center" style="border-style: dashed !important; border-radius: 8px;">
                                    <i class="bi bi-cloud-arrow-up fs-2"></i>
                                    <p>Upload foto profil <br><small class="text-muted">JPG, PNG (maks. 2MB)</small></p>
                                    <input type="file" name="foto_profil" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Status *</label>
                                <select name="status" class="form-select">
                                    <option value="Active" <?= set_select('status', 'Active'); ?>>Active</option>
                                    <option value="Pending" <?= set_select('status', 'Pending'); ?>>Pending</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <a href="<?= base_url('admin/petani'); ?>" class="btn btn-light px-4">Batal</a>
                        <button type="submit" class="btn text-white px-4" style="background-color: #4a2c11;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
