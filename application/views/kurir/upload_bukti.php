<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <!-- Flash Message -->
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert" style="border-radius:10px;">
                    <i class="bi bi-check-circle-fill mr-2"></i><?= $this->session->flashdata('success'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert" style="border-radius:10px;">
                    <i class="bi bi-exclamation-triangle-fill mr-2"></i><?= $this->session->flashdata('error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <div class="card card-upload shadow-soft mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 text-white"><i class="bi bi-upload"></i> Upload Bukti Pengiriman</h4>
                    <span class="badge badge-amber text-uppercase">#<?= $tracking->invoice ?></span>
                </div>
                <div class="card-body">
                    <!-- Invoice Information Card -->
                    <div class="info-card p-3 mb-4">
                        <h5 class="info-card-title border-bottom pb-2 mb-3"><i class="bi bi-info-circle-fill text-amber"></i> Informasi Pengiriman</h5>
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <span class="text-muted d-block small">Nomor Invoice</span>
                                <strong>#<?= $tracking->invoice ?></strong>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <span class="text-muted d-block small">Total Harga</span>
                                <strong>Rp <?= number_format($tracking->total_harga, 0, ',', '.') ?></strong>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <span class="text-muted d-block small">Nama Kurir</span>
                                <strong><?= $tracking->nama_kurir ?: '-' ?></strong>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <span class="text-muted d-block small">Status Saat Ini</span>
                                <span class="badge badge-info text-capitalize"><?= str_replace('_', ' ', $tracking->status_pengiriman) ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Existing Proof Section -->
                    <?php if (!empty($tracking->bukti_pengiriman)): ?>
                        <div class="existing-proof-box p-3 mb-4 text-center">
                            <h6 class="text-left border-bottom pb-2 mb-3"><i class="bi bi-file-earmark-check-fill text-success"></i> Bukti yang Sudah Diupload</h6>
                            <?php 
                            $ext = pathinfo($tracking->bukti_pengiriman, PATHINFO_EXTENSION);
                            if (strtolower($ext) === 'pdf'): 
                            ?>
                                <div class="py-3">
                                    <i class="bi bi-file-earmark-pdf-fill text-danger display-4"></i>
                                    <p class="mb-2 text-muted small"><?= $tracking->bukti_pengiriman ?></p>
                                    <a href="<?= base_url('assets/uploads/bukti_pengiriman/' . $tracking->bukti_pengiriman) ?>" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill">
                                        <i class="bi bi-eye"></i> Lihat PDF Bukti
                                    </a>
                                </div>
                            <?php else: ?>
                                <div class="text-center py-2">
                                    <a href="<?= base_url('assets/uploads/bukti_pengiriman/' . $tracking->bukti_pengiriman) ?>" target="_blank">
                                        <img src="<?= base_url('assets/uploads/bukti_pengiriman/' . $tracking->bukti_pengiriman) ?>" class="img-fluid img-thumbnail existing-img shadow-sm" alt="Bukti Pengiriman">
                                    </a>
                                    <p class="mt-2 mb-0 text-muted small"><i class="bi bi-clock"></i> Diupload pada: <?= date('d M Y H:i', strtotime($tracking->bukti_upload_at)) ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Upload Form -->
                    <form method="POST" enctype="multipart/form-data" action="<?= base_url('kurir/tracking/upload_bukti/' . $tracking->id_tracking) ?>">
                        <div class="form-group mb-4">
                            <label for="bukti_file" class="font-weight-bold d-block">Pilih Berkas Bukti (Gambar / PDF)</label>
                            <small class="text-muted d-block mb-3">Format yang didukung: JPG, PNG, GIF, PDF (Maks. 2MB)</small>
                            
                            <div class="custom-file-wrapper text-center p-4">
                                <input type="file" name="bukti_file" id="bukti_file" class="custom-file-input-hidden" accept="image/*,application/pdf" required>
                                <label for="bukti_file" class="custom-file-label-styled">
                                    <i class="bi bi-cloud-arrow-up text-amber display-4 mb-2 d-block"></i>
                                    <span class="d-block font-weight-bold text-dark text-label-main">Pilih atau Seret Berkas</span>
                                    <span class="text-muted small text-label-sub">Maksimal ukuran file: 2MB</span>
                                </label>
                                <div id="file-info" class="mt-2 text-success font-weight-bold small"></div>
                            </div>
                        </div>

                        <!-- Live Preview Area -->
                        <div id="new-preview-container" class="preview-box p-3 mb-4 text-center text-muted border rounded" style="display: none;">
                            <h6 class="text-left border-bottom pb-2 mb-3"><i class="bi bi-image"></i> Pratinjau Berkas Baru</h6>
                            <img id="new-preview-img" src="#" alt="Preview" class="img-fluid img-thumbnail new-img shadow-sm mb-2" style="max-height: 250px; display: none;">
                            <div id="new-preview-pdf" style="display: none;" class="py-3">
                                <i class="bi bi-file-earmark-pdf-fill text-danger display-4 mb-2 d-block"></i>
                                <span class="d-block text-dark font-weight-bold">Berkas PDF terdeteksi</span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-coffee btn-lg btn-block shadow-sm">
                            <i class="bi bi-send-fill"></i> Upload & Konfirmasi Pengiriman
                        </button>
                    </form>
                    
                    <a href="<?= base_url('kurir/tracking') ?>" class="btn btn-secondary btn-block mt-3" style="border-radius:10px;">
                        <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --roasted-brown: #4A2C11;
    --dark-coffee: #2C1808;
    --amber-cream: #E6A15C;
    --bg-cream: #FAF6F0;
    --card-white: #FFFFFF;
    --text-secondary: #70655E;
    --shadow-soft: 0 8px 30px rgba(44, 24, 8, 0.08);
    --shadow-hover: 0 12px 40px rgba(44, 24, 8, 0.15);
}

.card-upload {
    border: none;
    border-radius: 16px;
    overflow: hidden;
    background: var(--card-white);
}

.card-upload .card-header {
    background: linear-gradient(135deg, var(--dark-coffee) 0%, var(--roasted-brown) 100%);
    border-bottom: none;
    padding: 20px;
}

.badge-amber {
    background-color: var(--amber-cream);
    color: var(--dark-coffee);
    font-weight: 700;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
}

.info-card {
    background-color: var(--bg-cream);
    border-radius: 12px;
    border: 1px solid rgba(74, 44, 17, 0.08);
}

.info-card-title {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--dark-coffee);
}

.text-amber {
    color: var(--amber-cream);
}

.existing-proof-box {
    background-color: #f8fafc;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
}

.existing-img {
    max-height: 180px;
    object-fit: contain;
    border-radius: 8px;
}

.custom-file-wrapper {
    position: relative;
    border: 2px dashed rgba(230, 161, 92, 0.4);
    border-radius: 12px;
    background: var(--bg-cream);
    transition: all 0.3s ease;
    cursor: pointer;
}

.custom-file-wrapper:hover {
    border-color: var(--amber-cream);
    background-color: rgba(230, 161, 92, 0.05);
}

.custom-file-input-hidden {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 10;
}

.custom-file-label-styled {
    margin-bottom: 0;
    cursor: pointer;
    display: block;
}

.btn-coffee {
    background: var(--roasted-brown);
    color: white;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    padding: 12px 20px;
    transition: all 0.3s ease;
}

.btn-coffee:hover {
    background: var(--dark-coffee);
    color: white;
    transform: translateY(-1px);
}

.preview-box {
    background-color: #fafbfb;
}

.new-img {
    border-radius: 8px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('bukti_file');
    if (!fileInput) return;

    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        const previewContainer = document.getElementById('new-preview-container');
        const previewImg = document.getElementById('new-preview-img');
        const previewPdf = document.getElementById('new-preview-pdf');
        const fileInfo = document.getElementById('file-info');
        const textLabelMain = document.querySelector('.text-label-main');

        if (file) {
            fileInfo.innerHTML = `<i class="bi bi-file-earmark-check"></i> ${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
            textLabelMain.textContent = "Berkas Dipilih";
            previewContainer.style.display = 'block';

            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewImg.style.display = 'inline-block';
                    previewPdf.style.display = 'none';
                }
                reader.readAsDataURL(file);
            } else if (file.type === 'application/pdf') {
                previewImg.style.display = 'none';
                previewPdf.style.display = 'block';
            } else {
                previewImg.style.display = 'none';
                previewPdf.style.display = 'none';
            }
        } else {
            previewContainer.style.display = 'none';
            fileInfo.innerHTML = '';
            textLabelMain.textContent = "Pilih atau Seret Berkas";
        }
    });
});
</script>
