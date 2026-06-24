<?php 

// Helper fungsi untuk menampilkan status dokumen
function get_badge($status) {
    return ($status == 'Terverifikasi') ? 'bg-success' : 'bg-warning text-dark';
}
?>

<div class="content-wrapper" style="min-height: 100vh; padding: 25px; background-color: #fcfaf7;">
    <main id="main" class="main">
        
        <div class="pagetitle mb-4">
            <h1 style="color: #4a2c11; font-weight: 700;">Detail Petani</h1>
            <nav>
                <ol class="breadcrumb" style="background: none; padding: 0;">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/petani'); ?>" style="color: #8B4513;">Manajemen Petani</a></li>
                    <li class="breadcrumb-item active">Detail Petani</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm text-center p-4 mb-4" style="border-radius: 15px;">
                        <img src="<?= base_url('assets/img/user.png'); ?>" class="rounded-circle mb-3 border shadow-sm" width="150" height="150" style="object-fit: cover;">
                        <h4 class="fw-bold"><?= $petani['nama_petani']; ?></h4>
                        <p class="text-muted small">ID: <?= $petani['id_petani']; ?></p>
                        <span class="badge <?= $petani['status_petani'] == 'Active' ? 'bg-success' : 'bg-warning text-dark'; ?> px-3 py-2">
                            <?= $petani['status_petani']; ?>
                        </span>
                        <div class="mt-4">
                            <a href="<?= base_url('admin/petani/edit/'.$petani['id_petani']); ?>" class="btn btn-warning w-100 text-white">
                                <i class="bi bi-pencil-square"></i> Edit Petani
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold" style="color: #4a2c11; border-bottom: 2px solid #eee; padding-bottom: 10px;">Informasi Petani</h5>
                            <div class="row mt-3">
                                <div class="col-sm-6">
                                    <p class="text-muted mb-1">NIK</p><h6 class="fw-bold mb-3"><?= $petani['nik'] ?? '-'; ?></h6>
                                    <p class="text-muted mb-1">No. HP</p><h6 class="fw-bold mb-3"><?= $petani['no_hp'] ?? '-'; ?></h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-muted mb-1">Email</p><h6 class="fw-bold mb-3"><?= $petani['email'] ?? '-'; ?></h6>
                                    <p class="text-muted mb-1">Tanggal Daftar</p><h6 class="fw-bold mb-3"><?= date('d F Y', strtotime($petani['tanggal_daftar'])); ?></h6>
                                </div>
                                <div class="col-sm-12"><p class="text-muted mb-1">Alamat</p><h6 class="fw-bold"><?= $petani['alamat'] ?? '-'; ?></h6></div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold" style="color: #4a2c11; border-bottom: 2px solid #eee; padding-bottom: 10px;">Dokumen Petani</h5>
                            <div class="row mt-3">
                                <?php 
                                $docs = [
                                    ['label' => 'KTP', 'file' => $petani['file_ktp'], 'status' => $petani['status_ktp'] ?? 'Menunggu'],
                                    ['label' => 'NPWP', 'file' => $petani['file_npwp'], 'status' => $petani['status_npwp'] ?? 'Menunggu'],
                                    ['label' => 'Sertifikat', 'file' => $petani['file_sertifikat'], 'status' => $petani['status_sertifikat'] ?? 'Menunggu']
                                ];
                                foreach($docs as $d): ?>
                                <div class="col-md-4">
                                    <div class="border p-3 text-center rounded shadow-sm bg-light">
                                        <i class="bi bi-file-earmark-text fs-1 text-secondary"></i>
                                        <p class="mt-2 mb-1 fw-bold"><?= $d['label']; ?></p>
                                        <span class="badge <?= get_badge($d['status']); ?> mb-2"><?= $d['status']; ?></span>
                                        <br>
                                        <?php if(!empty($d['file'])): ?>
                                            <a href="<?= base_url('uploads/ktp/'.$d['file']); ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i> Lihat</a>
                                        <?php else: ?>
                                            <small class="text-muted">File tidak ada</small>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
