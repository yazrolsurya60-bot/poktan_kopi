<?php 
$this->load->view('admin/v_header'); 
$this->load->view('admin/v_sidebar'); 
?>

<div class="content-wrapper" style="min-height: 100vh; padding: 30px; background-color: #fcfaf7;">
    <main id="main" class="main">
        <div class="pagetitle mb-4">
            <h1 style="color: #4a2c11; font-weight: 700;">Edit Data Petani</h1>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-body p-4">
                <form action="<?= base_url('admin/petani/update_aksi/'.$petani['id_petani']); ?>" method="POST" enctype="multipart/form-data">
                    
                    <h5 class="fw-bold mb-3" style="color: #4a2c11;">Informasi Pribadi</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_petani" class="form-control" value="<?= $petani['nama_petani']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">NIK</label>
                            <input type="text" name="nik" class="form-control" value="<?= $petani['nik']; ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">No. HP</label>
                            <input type="number" name="no_hp" class="form-control" value="<?= $petani['no_hp']; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= $petani['email']; ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="2"><?= $petani['alamat']; ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Status Petani</label>
                        <select name="status" class="form-select">
                            <option value="Active" <?= $petani['status_petani'] == 'Active' ? 'selected' : ''; ?>>Active</option>
                            <option value="Pending" <?= $petani['status_petani'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                        </select>
                    </div>

                    <hr>
                    <h5 class="fw-bold mb-3" style="color: #4a2c11;">Update Dokumen</h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">KTP (JPG/PNG/PDF)</label>
                            <input type="file" name="file_ktp" class="form-control">
                            <small class="text-muted d-block mt-1">File: <?= $petani['file_ktp'] ?? 'Belum ada'; ?></small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">NPWP (JPG/PNG/PDF)</label>
                            <input type="file" name="file_npwp" class="form-control">
                            <small class="text-muted d-block mt-1">File: <?= $petani['file_npwp'] ?? 'Belum ada'; ?></small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Sertifikat (JPG/PNG/PDF)</label>
                            <input type="file" name="file_sertifikat" class="form-control">
                            <small class="text-muted d-block mt-1">File: <?= $petani['file_sertifikat'] ?? 'Belum ada'; ?></small>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="<?= base_url('admin/petani/detail/'.$petani['id_petani']); ?>" class="btn btn-outline-secondary px-4">Batal</a>
                        <button type="submit" class="btn btn-warning px-4 text-white">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<?php $this->load->view('admin/v_foother'); ?>