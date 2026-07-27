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
    .edit-pill { display:inline-flex; align-items:center; gap:5px; padding:4px 12px; background:rgba(230,161,92,0.15); border:1px solid rgba(230,161,92,0.25); border-radius:20px; color:var(--amber-cream); font-size:0.7rem; font-weight:700; letter-spacing:0.4px; }

    .form-card { background:var(--card-white); border-radius:var(--radius-card); box-shadow:var(--shadow-soft); border:1px solid rgba(74,44,17,0.06); overflow:hidden; }
    .form-card-header { padding:18px 24px; border-bottom:1px solid rgba(74,44,17,0.06); background:rgba(250,246,240,0.5); display:flex; align-items:center; gap:12px; }
    .form-card-header .hdr-icon { width:36px; height:36px; border-radius:10px; background:rgba(230,161,92,0.15); display:flex; align-items:center; justify-content:center; color:var(--amber-cream); font-size:1rem; }
    .form-card-header h5 { margin:0; font-weight:700; font-size:0.9rem; color:var(--dark-coffee); }
    .form-card-header p  { margin:0; font-size:0.77rem; color:var(--text-secondary); }
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

    .current-logo-box { display:flex; align-items:center; gap:14px; padding:14px 16px; background:rgba(250,246,240,0.6); border:1px solid rgba(74,44,17,0.08); border-radius:11px; margin-bottom:14px; }
    .current-logo { width:62px; height:62px; object-fit:cover; border-radius:10px; border:1px solid rgba(74,44,17,0.08); background:#fff; }
    .current-logo-placeholder { width:62px; height:62px; border-radius:10px; border:1px dashed rgba(74,44,17,0.18); background:#fff; display:flex; align-items:center; justify-content:center; color:var(--text-secondary); font-size:1.4rem; }
    .cl-label { font-size:0.7rem; font-weight:600; color:var(--text-secondary); text-transform:uppercase; letter-spacing:0.5px; }
    .cl-name  { font-size:0.82rem; font-weight:600; color:var(--dark-coffee); word-break:break-all; margin-top:2px; }

    .upload-zone { border:2px dashed rgba(74,44,17,0.15); border-radius:12px; padding:18px 14px; text-align:center; background:rgba(250,246,240,0.5); transition:var(--transition-smooth); cursor:pointer; position:relative; }
    .upload-zone:hover { border-color:var(--amber-cream); background:rgba(230,161,92,0.04); }
    .upload-zone.dragover { border-color:var(--amber-cream); background:rgba(230,161,92,0.07); }
    .upload-zone input[type="file"] { position:absolute; inset:0; opacity:0; cursor:pointer; width:100%; height:100%; }
    .upload-icon-wrap { width:40px; height:40px; border-radius:10px; background:rgba(230,161,92,0.12); display:flex; align-items:center; justify-content:center; margin:0 auto 8px; color:var(--amber-cream); font-size:1.15rem; }
    .upload-zone h6 { font-size:0.82rem; font-weight:700; color:var(--dark-coffee); margin:0 0 3px; }
    .upload-zone p  { font-size:0.72rem; color:var(--text-secondary); margin:0; }

    .preview-wrap { display:none; margin-top:11px; padding:11px; background:#fff; border-radius:10px; border:1px solid rgba(230,161,92,0.22); align-items:center; gap:11px; }
    .preview-img  { width:54px; height:54px; object-fit:cover; border-radius:9px; border:1px solid rgba(74,44,17,0.08); }
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

    .info-card { background:var(--card-white); border-radius:var(--radius-card); box-shadow:var(--shadow-soft); border:1px solid rgba(74,44,17,0.06); overflow:hidden; margin-bottom:14px; }
    .info-card-header { padding:14px 18px; border-bottom:1px solid rgba(74,44,17,0.05); background:rgba(250,246,240,0.5); font-size:0.8rem; font-weight:700; color:var(--dark-coffee); display:flex; align-items:center; gap:7px; }
    .info-card-header i { color:var(--amber-cream); }
    .info-card-body { padding:14px 18px; }
    .meta-row { display:flex; justify-content:space-between; align-items:center; padding:7px 0; border-bottom:1px solid rgba(74,44,17,0.04); font-size:0.78rem; }
    .meta-row:last-child { border-bottom:none; }
    .meta-label { color:var(--text-secondary); font-weight:500; }
    .meta-value { color:var(--dark-coffee); font-weight:700; text-align:right; }
    .badge-active   { color:var(--forest-green); background:rgba(45,106,79,0.1);  padding:3px 9px; border-radius:20px; font-size:0.7rem; }
    .badge-inactive { color:#dc2626;             background:rgba(239,68,68,0.09); padding:3px 9px; border-radius:20px; font-size:0.7rem; }
    .quick-link { display:flex; align-items:center; gap:10px; padding:9px 11px; border-radius:9px; color:var(--dark-coffee); font-size:0.8rem; font-weight:600; text-decoration:none; transition:var(--transition-smooth); }
    .quick-link:hover { background:rgba(230,161,92,0.08); color:var(--dark-coffee); text-decoration:none; }
    .quick-link i { font-size:1rem; }
    .quick-link.danger { color:#dc2626; }
    .quick-link.danger:hover { background:rgba(239,68,68,0.07); color:#dc2626; }

    .flash-alert { border-radius:12px; border:none; display:flex; align-items:center; gap:12px; padding:13px 17px; font-weight:500; font-size:0.875rem; margin-bottom:22px; }
    .flash-danger { background:rgba(239,68,68,0.09); color:#dc2626; border-left:4px solid #dc2626; }
</style>

<div class="breadcrumb-nav">
    <a href="<?= base_url('admin/mitra'); ?>" class="btn-back" title="Kembali"><i class="bi bi-arrow-left"></i></a>
    <span class="breadcrumb-text">Manajemen Mitra &rsaquo; <span>Edit Mitra</span></span>
    <span class="edit-pill"><i class="bi bi-pencil-fill"></i> Mode Edit</span>
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
                <div class="hdr-icon"><i class="bi bi-pencil-square"></i></div>
                <div><h5>Edit Informasi Mitra</h5><p>Perbarui data mitra — perubahan langsung berlaku</p></div>
            </div>
            <div class="form-card-body">
                <form action="<?= base_url('admin/mitra/edit/'.$mitra['id_mitra']); ?>" method="POST" enctype="multipart/form-data" id="formEdit">

                    <div class="field-group">
                        <label class="field-label" for="nama_mitra"><i class="bi bi-building"></i> Nama Mitra <span class="req">*</span></label>
                        <input type="text" id="nama_mitra" name="nama_mitra" class="field-input" value="<?= htmlspecialchars($mitra['nama_mitra']); ?>" required>
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="kategori_mitra"><i class="bi bi-tag-fill"></i> Kategori Mitra <span class="req">*</span></label>
                        <input type="text" id="kategori_mitra" name="kategori_mitra" class="field-input" value="<?= htmlspecialchars($mitra['kategori_mitra']); ?>" required placeholder="contoh: Cafe, Restoran, Distributor">
                    </div>

                    <div class="row" style="margin:0 -10px;">
                        <div class="col-md-6" style="padding:0 10px;">
                            <div class="field-group">
                                <label class="field-label" for="email"><i class="bi bi-envelope-fill"></i> Email</label>
                                <input type="email" id="email" name="email" class="field-input" placeholder="contoh: info@mitra.id" value="<?= htmlspecialchars($mitra['email'] ?? ''); ?>">
                            </div>
                        </div>
                        <div class="col-md-6" style="padding:0 10px;">
                            <div class="field-group">
                                <label class="field-label" for="no_telepon"><i class="bi bi-telephone-fill"></i> No Telepon</label>
                                <input type="text" id="no_telepon" name="no_telepon" class="field-input" placeholder="contoh: 0812-3456-7890" value="<?= htmlspecialchars($mitra['no_telepon'] ?? ''); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="website"><i class="bi bi-globe2"></i> Website</label>
                        <input type="text" id="website" name="website" class="field-input" placeholder="contoh: https://www.mitra.id (opsional)" value="<?= htmlspecialchars($mitra['website'] ?? ''); ?>">
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="alamat"><i class="bi bi-geo-alt-fill"></i> Alamat</label>
                        <textarea id="alamat" name="alamat" class="field-input" rows="2" placeholder="Masukkan alamat lengkap mitra" style="resize:vertical;"><?= htmlspecialchars($mitra['alamat'] ?? ''); ?></textarea>
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="deskripsi"><i class="bi bi-card-text"></i> Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" class="field-input" rows="3" placeholder="Ceritakan singkat tentang mitra ini" style="resize:vertical;"><?= htmlspecialchars($mitra['deskripsi'] ?? ''); ?></textarea>
                    </div>

                    <div class="form-divider"></div>

                    <div class="field-group">
                        <label class="field-label" for="urutan_tampil"><i class="bi bi-sort-numeric-down"></i> Urutan Tampil <span class="req">*</span></label>
                        <input type="number" id="urutan_tampil" name="urutan_tampil" class="field-input" value="<?= (int)$mitra['urutan_tampil']; ?>" min="1" style="max-width:140px;" required>
                        <p class="field-hint"><i class="bi bi-info-circle"></i> Angka lebih kecil = tampil lebih awal di Landing Page.</p>
                    </div>

                    <div class="form-divider"></div>

                    <div class="field-group" style="margin-bottom:0;">
                        <label class="field-label"><i class="bi bi-image-fill"></i> Logo Mitra</label>

                        <div class="current-logo-box">
                            <?php if (!empty($mitra['logo_mitra']) && $mitra['logo_mitra'] !== 'default.png'): ?>
                                <img src="<?= base_url('assets/uploads/mitra/'.$mitra['logo_mitra']); ?>" alt="Logo saat ini" class="current-logo">
                            <?php else: ?>
                                <div class="current-logo-placeholder"><i class="bi bi-image"></i></div>
                            <?php endif; ?>
                            <div>
                                <div class="cl-label">Logo Saat Ini</div>
                                <div class="cl-name"><?= htmlspecialchars($mitra['logo_mitra'] ?? 'default.png'); ?></div>
                            </div>
                        </div>

                        <p style="font-size:0.78rem;color:var(--text-secondary);margin-bottom:8px;font-weight:500;">
                            <i class="bi bi-arrow-up-circle" style="color:var(--amber-cream);"></i> Unggah logo baru untuk mengganti yang saat ini:
                        </p>

                        <div class="upload-zone" id="uploadZone">
                            <input type="file" name="logo_mitra" id="logo_mitra" accept="image/jpeg,image/png,image/gif">
                            <div class="upload-icon-wrap"><i class="bi bi-cloud-arrow-up-fill"></i></div>
                            <h6>Klik atau seret file baru ke sini</h6>
                            <p>JPG, PNG, GIF — maks. 2 MB</p>
                        </div>

                        <div class="preview-wrap" id="previewWrap">
                            <img id="previewImg" src="" alt="Preview baru" class="preview-img">
                            <div class="preview-info"><div class="preview-name" id="previewName"></div><div class="preview-size" id="previewSize"></div></div>
                            <button type="button" class="btn-clear-preview" id="clearFile" title="Batalkan pilihan"><i class="bi bi-x-lg"></i></button>
                        </div>

                        <p class="field-hint mt-2"><i class="bi bi-info-circle"></i> Biarkan kosong jika tidak ingin mengubah logo.</p>
                    </div>

                    <div class="form-divider"></div>

                    <div class="form-actions">
                        <a href="<?= base_url('admin/mitra'); ?>" class="btn-cancel"><i class="bi bi-x-lg"></i> Batal</a>
                        <button type="submit" class="btn-save"><i class="bi bi-floppy-fill"></i> Simpan Perubahan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- SIDEBAR INFO -->
    <div class="col-lg-4" style="padding:0 12px;">

        <div class="info-card">
            <div class="info-card-header"><i class="bi bi-info-circle-fill"></i> Detail Mitra</div>
            <div class="info-card-body">
                <div class="meta-row"><span class="meta-label">ID</span><span class="meta-value">#<?= $mitra['id_mitra']; ?></span></div>
                <div class="meta-row"><span class="meta-label">Kategori</span><span class="meta-value"><?= htmlspecialchars($mitra['kategori_mitra']); ?></span></div>
                <div class="meta-row"><span class="meta-label">Urutan</span><span class="meta-value"><?= (int)$mitra['urutan_tampil']; ?></span></div>
                <div class="meta-row">
                    <span class="meta-label">Status</span>
                    <span class="meta-value">
                        <?php if ($mitra['status_mitra'] === 'Active'): ?>
                            <span class="badge-active"><i class="bi bi-check-circle-fill"></i> Aktif</span>
                        <?php else: ?>
                            <span class="badge-inactive"><i class="bi bi-x-circle-fill"></i> Nonaktif</span>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="info-card">
            <div class="info-card-header"><i class="bi bi-lightning-charge-fill"></i> Aksi Cepat</div>
            <div class="info-card-body" style="padding:10px 14px;">
                <a href="<?= base_url('admin/mitra'); ?>" class="quick-link"><i class="bi bi-arrow-left-circle" style="color:var(--amber-cream);"></i> Kembali ke Daftar</a>
                <a href="<?= base_url('admin/mitra/add'); ?>" class="quick-link"><i class="bi bi-plus-circle" style="color:var(--forest-green);"></i> Tambah Mitra Lain</a>
                <button type="button" class="quick-link danger w-100 text-left" style="border:none;background:transparent;font-family:inherit;cursor:pointer;" id="btnHapusSidebar" data-id="<?= $mitra['id_mitra']; ?>" data-nama="<?= htmlspecialchars($mitra['nama_mitra']); ?>">
                    <i class="bi bi-trash3" style="font-size:1rem;margin-right:10px;"></i> Hapus Mitra Permanen
                </button>
            </div>
        </div>

        <div class="info-card">
            <div class="info-card-header"><i class="bi bi-lightbulb-fill"></i> Catatan Edit</div>
            <div class="info-card-body" style="padding:14px 18px;">
                <p style="font-size:0.77rem;color:var(--text-secondary);margin-bottom:8px;">Kosongkan kolom logo jika tidak ingin menggantinya.</p>
                <p style="font-size:0.77rem;color:var(--text-secondary);margin-bottom:8px;">Perubahan urutan tampil langsung berlaku di Landing Page.</p>
                <p style="font-size:0.77rem;color:var(--text-secondary);margin:0;">Untuk mengubah status aktif/nonaktif, gunakan toggle di halaman daftar mitra. Menghapus mitra bersifat permanen dan tidak dapat dibatalkan.</p>
            </div>
        </div>

    </div>
</div>

<!-- MODAL HAPUS PERMANEN -->
<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:420px;">
        <div class="modal-content" style="border-radius:16px;border:none;box-shadow:var(--shadow-hover);">
            <div class="modal-header" style="border-bottom:1px solid rgba(74,44,17,0.06);padding:18px 22px 14px;">
                <h5 class="modal-title font-weight-bold" style="font-size:0.9rem;">Hapus Mitra Permanen</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body text-center" style="padding:22px 22px 16px;">
                <div style="width:56px;height:56px;background:rgba(239,68,68,0.1);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-size:1.5rem;color:#dc2626;">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <p style="font-size:0.875rem;color:var(--text-secondary);margin:0;">
                    Anda akan menghapus mitra <strong id="modalNamaMitra" style="color:var(--dark-coffee);"></strong> secara permanen.
                </p>
                <p style="font-size:0.78rem;color:#dc2626;font-weight:600;margin:8px 0 0;">
                    <i class="bi bi-info-circle"></i> Tindakan ini TIDAK BISA dibatalkan.
                </p>
                <div class="mt-3 text-left">
                    <label style="font-size:0.7rem;font-weight:700;color:var(--text-secondary);text-transform:uppercase;letter-spacing:0.4px;">Ketik nama mitra untuk konfirmasi</label>
                    <input type="text" id="inputKonfirmHapus" style="width:100%;padding:9px 13px;border:1px solid rgba(74,44,17,0.18);border-radius:9px;font-size:0.85rem;font-family:inherit;margin-top:6px;" placeholder="Ketik nama mitra di sini...">
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-end" style="gap:8px;border-top:1px solid rgba(74,44,17,0.06);padding:14px 22px;">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" style="border-radius:9px;">Batal</button>
                <a href="#" id="btnKonfirmHapus" class="btn btn-danger btn-sm" style="border-radius:9px; pointer-events:none; opacity:0.5;">
                    <i class="bi bi-trash3-fill"></i> Ya, Hapus Permanen
                </a>
            </div>
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

    fileInput.addEventListener('change', function(){if(this.files[0]) showPreview(this.files[0]);});
    zone.addEventListener('dragover',  function(e){e.preventDefault();this.classList.add('dragover');});
    zone.addEventListener('dragleave', function(){this.classList.remove('dragover');});
    zone.addEventListener('drop',      function(){this.classList.remove('dragover');});

    document.getElementById('clearFile').addEventListener('click', function(){
        fileInput.value=''; previewWrap.style.display='none'; previewImg.src='';
    });

    function showPreview(file){
        var reader=new FileReader();
        reader.onload=function(e){
            previewImg.src=e.target.result;
            previewName.textContent=file.name;
            previewSize.textContent=fmtBytes(file.size);
            previewWrap.style.display='flex';
        };
        reader.readAsDataURL(file);
    }

    function fmtBytes(b){
        if(b<1024) return b+' B';
        if(b<1048576) return (b/1024).toFixed(1)+' KB';
        return (b/1048576).toFixed(1)+' MB';
    }

    var namaMitraAktif = '';
    $('#btnHapusSidebar').click(function(){
        var id=$(this).data('id'), nama=$(this).data('nama');
        namaMitraAktif = nama;
        $('#modalNamaMitra').text('"'+nama+'"');
        $('#inputKonfirmHapus').val('');
        $('#btnKonfirmHapus').attr('href',"<?= base_url('admin/mitra/delete/'); ?>"+id)
            .css({'pointer-events':'none','opacity':'0.5'});
        $('#modalHapus').modal('show');
    });

    $('#inputKonfirmHapus').on('input', function(){
        var match = ($(this).val().trim() === namaMitraAktif.trim());
        $('#btnKonfirmHapus').css(match ? {'pointer-events':'auto','opacity':'1'} : {'pointer-events':'none','opacity':'0.5'});
    });

    setTimeout(function(){$('.flash-alert').fadeOut('slow');},4000);
});
</script>