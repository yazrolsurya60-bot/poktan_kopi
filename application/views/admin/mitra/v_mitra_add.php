<style>
    :root {
        --roasted-brown: #4A2C11; --dark-coffee: #2C1808; --amber-cream: #E6A15C;
        --forest-green: #2D6A4F; --bg-cream: #FAF6F0; --card-white: #FFFFFF;
        --text-secondary: #70655E;
        --shadow-soft: 0 8px 30px rgba(44,24,8,0.08); --shadow-hover: 0 12px 40px rgba(44,24,8,0.15);
        --radius-card: 14px; --transition-smooth: all 0.3s cubic-bezier(0.4,0,0.2,1);
    }

    .breadcrumb-nav { display:flex; align-items:center; gap:10px; margin-bottom:12px; }
    .btn-back { width:36px; height:36px; border-radius:9px; background:rgba(74,44,17,0.07); border:1px solid rgba(74,44,17,0.1); display:flex; align-items:center; justify-content:center; color:var(--roasted-brown); font-size:1rem; text-decoration:none; transition:var(--transition-smooth); }
    .btn-back:hover { background:var(--amber-cream); color:#fff; border-color:transparent; text-decoration:none; }
    .breadcrumb-text { font-size:0.75rem; color:var(--text-secondary); font-weight:500; }
    .breadcrumb-text span { color:var(--dark-coffee); font-weight:700; }

    .form-card { background:var(--card-white); border-radius:var(--radius-card); box-shadow:var(--shadow-soft); border:1px solid rgba(74,44,17,0.06); overflow:hidden; }
    .form-card-header { padding:18px 24px; border-bottom:1px solid rgba(74,44,17,0.06); background:rgba(250,246,240,0.5); display:flex; align-items:center; gap:12px; }
    .form-card-header .hdr-icon { width:36px; height:36px; border-radius:10px; background:rgba(230,161,92,0.15); display:flex; align-items:center; justify-content:center; color:var(--amber-cream); font-size:1rem; }
    .form-card-header h5 { margin:0; font-weight:700; font-size:0.9rem; color:var(--dark-coffee); }
    .form-card-header p { margin:0; font-size:0.77rem; color:var(--text-secondary); }
    .form-card-body { padding:26px; }

    .field-group { margin-bottom:20px; }
    .field-label { font-size:0.78rem; font-weight:700; color:var(--dark-coffee); margin-bottom:7px; display:flex; align-items:center; gap:6px; }
    .field-label i { color:var(--amber-cream); }
    .req { color:#dc2626; }
    .field-input { width:100%; padding:10px 14px; border:1px solid rgba(74,44,17,0.15); border-radius:10px; font-size:0.875rem; font-family:inherit; color:var(--dark-coffee); background:var(--bg-cream); transition:var(--transition-smooth); appearance:none; -webkit-appearance:none; }
    .field-input:focus { border-color:var(--amber-cream); box-shadow:0 0 0 3px rgba(230,161,92,0.18); outline:none; background:#fff; }
    .field-hint { font-size:0.73rem; color:var(--text-secondary); margin-top:5px; display:flex; align-items:center; gap:5px; }
    .field-hint i { color:var(--amber-cream); }
    .form-divider { height:1px; background:rgba(74,44,17,0.06); margin:22px 0; }

    .status-radio-group { display:flex; align-items:center; gap:18px; padding:10px 14px; background:var(--bg-cream); border:1px solid rgba(74,44,17,0.12); border-radius:10px; height:auto; }
    .status-radio { display:flex; align-items:center; gap:7px; font-size:0.85rem; font-weight:600; color:var(--dark-coffee); cursor:pointer; margin:0; }
    .status-radio input[type="radio"] { accent-color: var(--forest-green); width:15px; height:15px; cursor:pointer; margin:0; }

    .upload-zone { border:2px dashed rgba(74,44,17,0.15); border-radius:12px; padding:22px 16px; text-align:center; background:rgba(250,246,240,0.5); transition:var(--transition-smooth); cursor:pointer; position:relative; }
    .upload-zone:hover { border-color:var(--amber-cream); background:rgba(230,161,92,0.04); }
    .upload-zone.dragover { border-color:var(--amber-cream); background:rgba(230,161,92,0.07); }
    .upload-zone input[type="file"] { position:absolute; inset:0; opacity:0; cursor:pointer; width:100%; height:100%; }
    .upload-icon-wrap { width:46px; height:46px; border-radius:12px; background:rgba(230,161,92,0.12); display:flex; align-items:center; justify-content:center; margin:0 auto 10px; color:var(--amber-cream); font-size:1.3rem; }
    .upload-zone h6 { font-size:0.84rem; font-weight:700; color:var(--dark-coffee); margin:0 0 3px; }
    .upload-zone p  { font-size:0.73rem; color:var(--text-secondary); margin:0; }

    .preview-wrap { display:none; margin-top:12px; padding:12px; background:#fff; border-radius:10px; border:1px solid rgba(74,44,17,0.08); align-items:center; gap:12px; }
    .preview-img  { width:58px; height:58px; object-fit:contain; border-radius:9px; border:1px solid rgba(74,44,17,0.08); }
    .preview-info { flex:1; min-width:0; }
    .preview-name { font-size:0.8rem; font-weight:600; color:var(--dark-coffee); word-break:break-all; }
    .preview-size { font-size:0.72rem; color:var(--text-secondary); }
    .btn-clear-preview { width:28px; height:28px; border-radius:7px; border:none; background:rgba(239,68,68,0.09); color:#dc2626; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:var(--transition-smooth); flex-shrink:0; font-size:0.85rem; }
    .btn-clear-preview:hover { background:#dc2626; color:#fff; }

    .form-actions { display:flex; justify-content:flex-end; align-items:center; gap:10px; }
    .btn-save { background:var(--roasted-brown); color:#fff; border:none; border-radius:10px; padding:10px 22px; font-weight:700; font-size:0.875rem; display:inline-flex; align-items:center; gap:8px; transition:var(--transition-smooth); cursor:pointer; font-family:inherit; box-shadow:0 4px 14px rgba(74,44,17,0.22); }
    .btn-save:hover { background:var(--dark-coffee); color:#fff; transform:translateY(-2px); box-shadow:0 8px 20px rgba(44,24,8,0.28); }
    .btn-cancel { border:1px solid rgba(74,44,17,0.15); border-radius:10px; padding:10px 20px; font-weight:600; font-size:0.875rem; color:var(--text-secondary); background:transparent; text-decoration:none; display:inline-flex; align-items:center; gap:7px; transition:var(--transition-smooth); }
    .btn-cancel:hover { background:var(--bg-cream); color:var(--roasted-brown); border-color:var(--roasted-brown); text-decoration:none; }

    .tips-card { background:var(--card-white); border-radius:var(--radius-card); box-shadow:var(--shadow-soft); border:1px solid rgba(74,44,17,0.06); padding:20px 22px; margin-bottom:14px; }
    .tips-card h6 { font-size:0.8rem; font-weight:700; color:var(--dark-coffee); margin-bottom:12px; display:flex; align-items:center; gap:6px; }
    .tips-card h6 i { color:var(--amber-cream); }
    .tip-item { display:flex; align-items:flex-start; gap:8px; padding:7px 0; border-bottom:1px solid rgba(74,44,17,0.04); font-size:0.77rem; color:var(--text-secondary); font-weight:500; }
    .tip-item:last-child { border-bottom:none; }
    .tip-item i { color:var(--forest-green); font-size:0.82rem; margin-top:2px; flex-shrink:0; }

    .flash-alert { border-radius:12px; border:none; display:flex; align-items:center; gap:12px; padding:13px 17px; font-weight:500; font-size:0.875rem; margin-bottom:22px; }
    .flash-danger { background:rgba(239,68,68,0.09); color:#dc2626; border-left:4px solid #dc2626; }
</style>

<div class="breadcrumb-nav">
    <a href="<?= base_url('admin/mitra'); ?>" class="btn-back" title="Kembali"><i class="bi bi-arrow-left"></i></a>
    <span class="breadcrumb-text">Manajemen Mitra &rsaquo; <span>Tambah Mitra</span></span>
</div>

<?php if ($this->session->flashdata('error')): ?>
<div class="flash-alert flash-danger">
    <i class="bi bi-exclamation-triangle-fill"></i><span><?= $this->session->flashdata('error'); ?></span>
</div>
<?php endif; ?>

<div class="row" style="margin:0 -12px;">
    <!-- FORM UTAMA -->
    <div class="col-lg-8" style="padding:0 12px;margin-bottom:20px;">
        <div class="form-card">
            <div class="form-card-header">
                <div class="hdr-icon"><i class="bi bi-person-lines-fill"></i></div>
                <div><h5>Informasi Mitra</h5><p>Lengkapi data berikut untuk mendaftarkan mitra baru</p></div>
            </div>
            <div class="form-card-body">
                <form action="<?= base_url('admin/mitra/add'); ?>" method="POST" enctype="multipart/form-data" id="formAdd">

                    <div class="field-group">
                        <label class="field-label" for="nama_mitra"><i class="bi bi-building"></i> Nama Mitra <span class="req">*</span></label>
                        <input type="text" id="nama_mitra" name="nama_mitra" class="field-input" placeholder="contoh: Cafe Senja Arabica" required value="<?= set_value('nama_mitra'); ?>">
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="kategori_mitra"><i class="bi bi-tag-fill"></i> Kategori Mitra <span class="req">*</span></label>
                        <input type="text" id="kategori_mitra" name="kategori_mitra" class="field-input" placeholder="contoh: Cafe, Restoran, Distributor, Reseller" required value="<?= set_value('kategori_mitra'); ?>">
                        <p class="field-hint"><i class="bi bi-lightbulb"></i> Kategori digunakan sebagai filter di Landing Page.</p>
                    </div>

                    <div class="row" style="margin:0 -10px;">
                        <div class="col-md-6" style="padding:0 10px;">
                            <div class="field-group">
                                <label class="field-label" for="email"><i class="bi bi-envelope-fill"></i> Email</label>
                                <input type="email" id="email" name="email" class="field-input" placeholder="contoh: info@mitra.id" value="<?= set_value('email'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6" style="padding:0 10px;">
                            <div class="field-group">
                                <label class="field-label" for="no_telepon"><i class="bi bi-telephone-fill"></i> No Telepon</label>
                                <input type="text" id="no_telepon" name="no_telepon" class="field-input" placeholder="contoh: 0812-3456-7890" value="<?= set_value('no_telepon'); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="website"><i class="bi bi-globe2"></i> Website</label>
                        <input type="text" id="website" name="website" class="field-input" placeholder="contoh: https://www.mitra.id (opsional)" value="<?= set_value('website'); ?>">
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="alamat"><i class="bi bi-geo-alt-fill"></i> Alamat</label>
                        <textarea id="alamat" name="alamat" class="field-input" rows="2" placeholder="Masukkan alamat lengkap mitra" style="resize:vertical;"><?= set_value('alamat'); ?></textarea>
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="deskripsi"><i class="bi bi-card-text"></i> Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" class="field-input" rows="3" placeholder="Ceritakan singkat tentang mitra ini" style="resize:vertical;"><?= set_value('deskripsi'); ?></textarea>
                    </div>

                    <div class="form-divider"></div>

                    <div class="row" style="margin:0 -10px;">
                        <div class="col-md-6" style="padding:0 10px;">
                            <div class="field-group" style="margin-bottom:0;">
                                <label class="field-label"><i class="bi bi-toggle-on"></i> Status <span class="req">*</span></label>
                                <div class="status-radio-group">
                                    <label class="status-radio">
                                        <input type="radio" name="status_mitra" value="Active" <?= (set_value('status_mitra','Active') === 'Active') ? 'checked' : ''; ?>> Aktif
                                    </label>
                                    <label class="status-radio">
                                        <input type="radio" name="status_mitra" value="Inactive" <?= (set_value('status_mitra') === 'Inactive') ? 'checked' : ''; ?>> Tidak Aktif
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="padding:0 10px;">
                            <div class="field-group" style="margin-bottom:0;">
                                <label class="field-label" for="urutan_tampil"><i class="bi bi-sort-numeric-down"></i> Urutan Tampil <span class="req">*</span></label>
                                <input type="number" id="urutan_tampil" name="urutan_tampil" class="field-input" value="<?= set_value('urutan_tampil','1'); ?>" min="1" required>
                                <p class="field-hint"><i class="bi bi-info-circle"></i> Semakin kecil angka, semakin di awal.</p>
                            </div>
                        </div>
                    </div>

                    <div class="form-divider"></div>

                    <div class="field-group" style="margin-bottom:0;">
                        <label class="field-label"><i class="bi bi-image-fill"></i> Logo Mitra</label>
                        <div class="upload-zone" id="uploadZone">
                            <input type="file" name="logo_mitra" id="logo_mitra" accept="image/jpeg,image/png,image/gif">
                            <div class="upload-icon-wrap"><i class="bi bi-cloud-arrow-up-fill"></i></div>
                            <h6>Klik atau seret file ke sini</h6>
                            <p>JPG, PNG, GIF — maks. 2 MB</p>
                        </div>
                        <div class="preview-wrap" id="previewWrap">
                            <img id="previewImg" src="" alt="Preview" class="preview-img">
                            <div class="preview-info"><div class="preview-name" id="previewName"></div><div class="preview-size" id="previewSize"></div></div>
                            <button type="button" class="btn-clear-preview" id="clearFile" title="Hapus pilihan"><i class="bi bi-x-lg"></i></button>
                        </div>
                        <p class="field-hint mt-2"><i class="bi bi-info-circle"></i> Kosongkan jika belum punya logo — akan pakai gambar default.</p>
                    </div>

                    <div class="form-divider"></div>

                    <div class="form-actions">
                        <a href="<?= base_url('admin/mitra'); ?>" class="btn-cancel"><i class="bi bi-x-lg"></i> Batal</a>
                        <button type="submit" class="btn-save"><i class="bi bi-floppy-fill"></i> Simpan Mitra</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- SIDEBAR TIPS -->
    <div class="col-lg-4" style="padding:0 12px;">
        <div class="tips-card">
            <h6><i class="bi bi-lightbulb-fill"></i> Tips Pengisian</h6>
            <div class="tip-item"><i class="bi bi-check-circle-fill"></i><span>Gunakan nama resmi mitra sesuai perjanjian kerjasama.</span></div>
            <div class="tip-item"><i class="bi bi-check-circle-fill"></i><span>Kategori mempermudah pengunjung menemukan mitra yang tepat.</span></div>
            <div class="tip-item"><i class="bi bi-check-circle-fill"></i><span>Urutan kecil (1, 2, 3) tampil lebih awal di Landing Page.</span></div>
            <div class="tip-item"><i class="bi bi-check-circle-fill"></i><span>Logo ideal: 200×200px, format PNG transparan lebih disarankan.</span></div>
            <div class="tip-item"><i class="bi bi-check-circle-fill"></i><span>Status awal otomatis <strong>Aktif</strong> dan dapat diubah di daftar mitra.</span></div>
        </div>
        <div class="tips-card" style="background:linear-gradient(135deg,rgba(45,106,79,0.04) 0%,rgba(230,161,92,0.04) 100%);">
            <h6><i class="bi bi-globe2"></i> Tampil di Landing Page</h6>
            <div class="tip-item"><i class="bi bi-shop"></i><span>Mitra aktif akan muncul otomatis di halaman publik LiberChain.</span></div>
            <div class="tip-item"><i class="bi bi-toggle-on"></i><span>Mitra nonaktif tersembunyi dari publik namun data tetap tersimpan.</span></div>
        </div>
    </div>
</div>

<script>
$(function () {
    var fileInput = document.getElementById('logo_mitra');
    var previewWrap = document.getElementById('previewWrap');
    var previewImg  = document.getElementById('previewImg');
    var previewName = document.getElementById('previewName');
    var previewSize = document.getElementById('previewSize');
    var zone = document.getElementById('uploadZone');

    fileInput.addEventListener('change', function () { if (this.files[0]) showPreview(this.files[0]); });

    zone.addEventListener('dragover',  function (e) { e.preventDefault(); this.classList.add('dragover'); });
    zone.addEventListener('dragleave', function ()   { this.classList.remove('dragover'); });
    zone.addEventListener('drop',      function ()   { this.classList.remove('dragover'); });

    document.getElementById('clearFile').addEventListener('click', function () {
        fileInput.value = '';
        previewWrap.style.display = 'none';
        previewImg.src = '';
    });

    function showPreview(file) {
        var reader = new FileReader();
        reader.onload = function (e) {
            previewImg.src       = e.target.result;
            previewName.textContent = file.name;
            previewSize.textContent = fmtBytes(file.size);
            previewWrap.style.display = 'flex';
        };
        reader.readAsDataURL(file);
    }

    function fmtBytes(b) {
        if (b < 1024) return b + ' B';
        if (b < 1048576) return (b/1024).toFixed(1) + ' KB';
        return (b/1048576).toFixed(1) + ' MB';
    }

    setTimeout(function () { $('.flash-alert').fadeOut('slow'); }, 4000);
});
</script>