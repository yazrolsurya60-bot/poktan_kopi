<style>
    .custom-card { background: var(--card-white); border: 1px solid rgba(74, 44, 17, 0.06); border-radius: var(--radius-card); box-shadow: var(--shadow-soft); overflow: hidden; }
    .card-header-custom { padding: 18px 28px; border-bottom: 1px solid rgba(74, 44, 17, 0.06); font-weight: 700; font-size: 1rem; color: var(--dark-coffee); display: flex; align-items: center; gap: 12px; background: var(--bg-cream); }
    .card-header-custom i { color: var(--amber-cream); font-size: 1.2rem; }
    .card-header-custom .badge-required { font-size: 0.65rem; font-weight: 600; color: var(--text-secondary); background: rgba(74, 44, 17, 0.06); padding: 3px 12px; border-radius: 20px; margin-left: auto; }
    .card-body-custom { padding: 28px 28px 20px; }
    .form-group { margin-bottom: 18px; }
    .form-group label { font-weight: 600; font-size: 0.78rem; color: var(--text-secondary); margin-bottom: 5px; display: flex; align-items: center; gap: 4px; }
    .form-group label .required { color: #EF4444; font-weight: 700; }
    .form-control, .form-select { border-radius: 10px; border: 1px solid rgba(74, 44, 17, 0.12); padding: 10px 16px; font-size: 0.88rem; background: var(--card-white); height: 44px; }
    .form-control:focus, .form-select:focus { border-color: var(--amber-cream); box-shadow: 0 0 0 4px rgba(230, 161, 92, 0.1); outline: none; }
    .form-control[readonly] { background-color: #f8f9fa; color: #6c757d; }
    .file-upload-wrapper input[type="file"] { display: block; width: 100%; padding: 9px 14px; border: 2px dashed rgba(74, 44, 17, 0.12); border-radius: 10px; background: var(--bg-cream); cursor: pointer; font-size: 0.82rem; color: var(--text-secondary); height: 44px; }
    .file-upload-wrapper input[type="file"]::file-selector-button { padding: 5px 16px; border: none; border-radius: 6px; background: var(--amber-cream); color: white; font-weight: 600; font-size: 0.72rem; cursor: pointer; margin-right: 10px; }
    .file-helper { font-size: 0.7rem; color: var(--text-secondary); margin-top: 4px; display: block; }
    .btn-custom { border-radius: 10px; font-size: 0.85rem; font-weight: 600; padding: 10px 28px; border: none; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; }
    .btn-primary-custom { background: var(--amber-cream); color: white; }
    .btn-primary-custom:hover { background: var(--roasted-brown); color: white; text-decoration: none; }
    .btn-secondary-custom { background: var(--bg-cream); color: var(--text-secondary); border: 1px solid rgba(74, 44, 17, 0.08); }
    .btn-secondary-custom:hover { background: #e8e0d8; color: var(--dark-coffee); text-decoration: none; }
    .form-actions { padding-top: 20px; border-top: 1px solid rgba(74, 44, 17, 0.06); display: flex; justify-content: flex-end; gap: 12px; margin-top: 8px; }
</style>

<!-- FORM CARD EDIT -->
<div class="custom-card">
    <div class="card-header-custom">
        <i class="bi bi-box-seam-fill"></i>
        Formulir Edit Produk Kopi
        <span class="badge-required">
            <i class="bi bi-asterisk text-danger" style="font-size:0.5rem;"></i> Wajib diisi
        </span>
    </div>

    <div class="card-body-custom">
        <form action="<?= base_url('petani/produk/update/' . $produk->id_produk); ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <!-- KOLOM KIRI -->
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Nama Produk <span class="required">*</span></label>
                        <select name="nama_produk" id="nama_produk" class="form-control" required>
                            <option value="">-- Pilih Nama Produk --</option>
                            <option value="Ceri" <?= isset($produk) && $produk->nama_produk == 'Ceri' ? 'selected' : ''; ?>>Ceri</option>
                            <option value="Biji Kopi" <?= isset($produk) && $produk->nama_produk == 'Biji Kopi' ? 'selected' : ''; ?>>Biji Kopi</option>
                            <option value="Kopi Bubuk" <?= isset($produk) && $produk->nama_produk == 'Kopi Bubuk' ? 'selected' : ''; ?>>Kopi Bubuk</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Jenis Kopi <span class="required">*</span></label>
                        <select name="jenis_kopi" id="jenis_kopi" class="form-control" required>
                            <option value="Liberica">Liberica</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Proses Pengolahan</label>
                        <input type="text" name="proses" id="proses" class="form-control" value="<?= isset($produk) ? ($produk->proses ?? '') : ''; ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Harga (Rp) / Kg</label>
                        <input type="number" name="harga" id="harga" class="form-control" value="<?= isset($produk) ? $produk->harga : ''; ?>" readonly>
                        <small class="text-muted" style="display:block; margin-top:3px; color:var(--text-secondary);">Harga ditentukan oleh Admin</small>
                    </div>

                    <div class="form-group">
                        <label>Stok Ketersediaan (Kg) <span class="required">*</span></label>
                        <input type="number" name="stok_produk" id="stok" class="form-control" value="<?= isset($produk) ? $produk->stok_produk : ''; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Total Pendapatan (Rp)</label>
                        <input type="text" name="total" id="total" class="form-control" style="font-weight:700; color:var(--roasted-brown);" readonly
                               value="<?php 
                               if (isset($produk)) {
                                   $harga = $produk->harga ?? 0;
                                   $stok = $produk->stok_produk ?? 0;
                                   echo 'Rp ' . number_format($harga * $stok, 0, ',', '.');
                               } else {
                                   echo 'Rp 0';
                               }
                               ?>">
                        <small class="text-muted" style="display:block; margin-top:3px; color:var(--text-secondary);">Harga × Stok = Total Pendapatan</small>
                    </div>
                </div>

                <!-- KOLOM KANAN -->
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Altitude (Ketinggian Tanam)</label>
                        <input type="text" name="altitude" class="form-control" placeholder="Contoh: 900 Meter" value="<?= isset($produk) ? $produk->altitude : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label>Status Produk <span class="required">*</span></label>
                        <select name="status_produk" class="form-control">
                            <option value="Aktif" <?= isset($produk) && $produk->status_produk == 'Aktif' ? 'selected' : ''; ?>>Aktif</option>
                            <option value="Nonaktif" <?= isset($produk) && $produk->status_produk == 'Nonaktif' ? 'selected' : ''; ?>>Nonaktif</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Foto Produk</label>
                        <div class="file-upload-wrapper">
                            <input type="file" name="foto_utama" accept=".jpg,.jpeg,.png">
                            <span class="file-helper">
                                <i class="bi bi-info-circle"></i> Format: JPG, PNG. Maks 2MB
                            </span>
                        </div>
                        <?php if (isset($produk) && !empty($produk->foto_utama)): ?>
                            <div class="mt-2">
                                <small class="text-muted">Foto saat ini:</small><br>
                                <img src="<?= base_url('uploads/produk/' . $produk->foto_utama); ?>" width="80" height="80" style="object-fit:cover; border-radius:8px; margin-top:4px; border:1px solid rgba(74,44,17,0.06);">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- FORM ACTIONS -->
            <div class="form-actions">
                <a href="<?= base_url('petani/produk'); ?>" class="btn btn-secondary-custom btn-custom">
                    <i class="bi bi-arrow-left"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary-custom btn-custom">
                    <i class="bi bi-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const namaProduk = document.getElementById('nama_produk');
        const jenisKopi = document.getElementById('jenis_kopi');
        const proses = document.getElementById('proses');
        const harga = document.getElementById('harga');
        const stok = document.getElementById('stok');
        const total = document.getElementById('total');

        const hargaProduk = { 'Ceri': 7000, 'Biji Kopi': 70000, 'Kopi Bubuk': 120000 };

        function hitungTotal() {
            const hargaVal = parseFloat(harga.value) || 0;
            const stokVal = parseFloat(stok.value) || 0;
            const totalVal = hargaVal * stokVal;
            total.value = (totalVal > 0) ? 'Rp ' + totalVal.toLocaleString('id-ID') : 'Rp 0';
        }

        if (namaProduk && jenisKopi) {
            namaProduk.addEventListener('change', function() {
                const value = this.value;
                jenisKopi.value = (value !== '') ? 'Liberica' : '';

                if (proses) {
                    switch(value) {
                        case 'Ceri': proses.value = 'Tanpa Proses'; break;
                        case 'Biji Kopi': proses.value = 'Pencucian, Pengupasan, Penjemuran'; break;
                        case 'Kopi Bubuk': proses.value = 'Pencucian, Pengupasan, Penjemuran, Penggilingan, Pengemasan'; break;
                        default: proses.value = '';
                    }
                }

                if (harga) {
                    harga.value = (value && hargaProduk[value]) ? hargaProduk[value] : '';
                }
                hitungTotal();
            });
        }

        if (stok) {
            stok.addEventListener('input', hitungTotal);
        }
    });
</script>
