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
        --radius-card: 14px;
        --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* CUSTOM CARD */
    .custom-card {
        background: var(--card-white);
        border: 1px solid rgba(74, 44, 17, 0.06);
        border-radius: var(--radius-card);
        box-shadow: var(--shadow-soft);
        transition: var(--transition-smooth);
        overflow: hidden;
    }

    .custom-card:hover {
        box-shadow: var(--shadow-hover);
    }

    .card-header-custom {
        padding: 18px 28px;
        border-bottom: 1px solid rgba(74, 44, 17, 0.06);
        font-weight: 700;
        font-size: 1rem;
        color: var(--dark-coffee);
        display: flex;
        align-items: center;
        gap: 12px;
        background: var(--bg-cream);
    }

    .card-header-custom i {
        color: var(--amber-cream);
        font-size: 1.2rem;
    }

    .card-header-custom .badge-required {
        font-size: 0.65rem;
        font-weight: 600;
        color: var(--text-secondary);
        background: rgba(74, 44, 17, 0.06);
        padding: 3px 12px;
        border-radius: 20px;
        margin-left: auto;
    }

    .card-body-custom {
        padding: 28px 28px 20px;
    }

    /* FORM STYLES */
    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        font-weight: 600;
        font-size: 0.78rem;
        color: var(--text-secondary);
        margin-bottom: 5px;
        letter-spacing: 0.2px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .form-group label .required {
        color: #EF4444;
        font-weight: 700;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid rgba(74, 44, 17, 0.12);
        padding: 10px 16px;
        font-size: 0.88rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
        transition: var(--transition-smooth);
        background: var(--card-white);
        height: 44px;
    }

    .form-control:focus {
        border-color: var(--amber-cream);
        box-shadow: 0 0 0 4px rgba(230, 161, 92, 0.1);
        outline: none;
    }

    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2370655E' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        padding-right: 36px;
    }

    /* FILE UPLOAD */
    .file-upload-wrapper input[type="file"] {
        display: block;
        width: 100%;
        padding: 9px 14px;
        border: 2px dashed rgba(74, 44, 17, 0.12);
        border-radius: 10px;
        background: var(--bg-cream);
        cursor: pointer;
        transition: var(--transition-smooth);
        font-size: 0.82rem;
        color: var(--text-secondary);
        height: 44px;
    }

    .file-upload-wrapper input[type="file"]::file-selector-button {
        padding: 5px 16px;
        border: none;
        border-radius: 6px;
        background: var(--amber-cream);
        color: white;
        font-weight: 600;
        font-size: 0.72rem;
        cursor: pointer;
        margin-right: 10px;
    }

    /* BUTTONS */
    .btn-custom {
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        padding: 10px 28px;
        border: none;
        transition: var(--transition-smooth);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none !important;
    }

    .btn-primary-custom {
        background: var(--amber-cream);
        color: white;
    }

    .btn-primary-custom:hover {
        background: var(--roasted-brown);
        color: white;
        transform: translateY(-2px);
    }

    .btn-secondary-custom {
        background: var(--bg-cream);
        color: var(--text-secondary);
        border: 1px solid rgba(74, 44, 17, 0.08);
    }

    .btn-secondary-custom:hover {
        background: #e8e0d8;
        color: var(--dark-coffee);
    }

    .form-actions {
        padding-top: 20px;
        border-top: 1px solid rgba(74, 44, 17, 0.06);
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 8px;
    }
</style>

<!-- FORM CARD -->
<div class="custom-card fade-in">
    <div class="card-header-custom">
        <i class="bi bi-box-seam-fill"></i>
        Formulir Edit Produk Kopi
        <span class="badge-required">
            <i class="bi bi-asterisk text-danger" style="font-size:0.5rem;"></i> Wajib diisi
        </span>
    </div>

    <div class="card-body-custom">
        <form action="<?= base_url('admin/produk/update/' . $produk->id_produk); ?>" method="post" enctype="multipart/form-data">

            <div class="row">
                <!-- KOLOM KIRI -->
                <div class="col-lg-6">
                    <!-- NAMA PRODUK -->
                    <div class="form-group">
                        <label>Nama Produk <span class="required">*</span></label>
                        <select name="nama_produk" id="nama_produk" class="form-control" required>
                            <option value="">-- Pilih Nama Produk --</option>
                            <option value="Ceri" <?= isset($produk) && $produk->nama_produk == 'Ceri' ? 'selected' : ''; ?>>Ceri</option>
                            <option value="Biji Kopi" <?= isset($produk) && $produk->nama_produk == 'Biji Kopi' ? 'selected' : ''; ?>>Biji Kopi</option>
                            <option value="Kopi Bubuk" <?= isset($produk) && $produk->nama_produk == 'Kopi Bubuk' ? 'selected' : ''; ?>>Kopi Bubuk</option>
                        </select>
                    </div>

                    <!-- JENIS KOPI -->
                    <div class="form-group">
                        <label>Jenis Kopi <span class="required">*</span></label>
                        <select name="jenis_kopi" id="jenis_kopi" class="form-control" required>
                            <option value="Liberica">Liberica</option>
                        </select>
                    </div>

                    <!-- PROSES PENGOLAHAN (SEKARANG BISA DIEDIT) -->
                    <div class="form-group">
                        <label>Proses Pengolahan</label>
                        <input type="text" name="proses" id="proses" class="form-control" 
                               placeholder="Masukkan proses pengolahan" 
                               value="<?= isset($produk) ? ($produk->proses ?? '') : ''; ?>">
                    </div>

                    <!-- HARGA (Rp) (SEKARANG BISA DIEDIT) -->
                    <div class="form-group">
                        <label>Harga (Rp) <span class="required">*</span></label>
                        <input type="number" name="harga" id="harga" class="form-control" 
                               placeholder="Masukkan harga produk" 
                               value="<?= isset($produk) ? $produk->harga : ''; ?>" required>
                    </div>

                    <!-- STOK KETERSEDIAAN -->
                    <div class="form-group">
                        <label>Stok Ketersediaan (Kg) <span class="required">*</span></label>
                        <input type="number" name="stok_produk" id="stok" class="form-control"
                               placeholder="Masukkan jumlah stok (contoh: 50)" 
                               value="<?= isset($produk) ? $produk->stok_produk : ''; ?>" required>
                    </div>
                </div>

                <!-- KOLOM KANAN -->
                <div class="col-lg-6">
                    <!-- ALTITUDE -->
                    <div class="form-group">
                        <label>Altitude (Ketinggian Tanam)</label>
                        <input type="text" name="altitude" class="form-control"
                               placeholder="Contoh: 25 Meter" 
                               value="<?= isset($produk) ? $produk->altitude : ''; ?>">
                    </div>

                    <!-- STATUS PRODUK -->
                    <div class="form-group">
                        <label>Status Produk <span class="required">*</span></label>
                        <select name="status_produk" class="form-control" required>
                            <option value="Aktif" <?= isset($produk) && $produk->status_produk == 'Aktif' ? 'selected' : ''; ?>>Aktif</option>
                            <option value="Nonaktif" <?= isset($produk) && $produk->status_produk == 'Nonaktif' ? 'selected' : ''; ?>>Nonaktif</option>
                        </select>
                    </div>

                    <!-- FOTO PRODUK -->
                    <div class="form-group">
                        <label>Foto Produk</label>
                        <div class="file-upload-wrapper">
                            <input type="file" name="foto_utama" accept=".jpg,.jpeg,.png">
                            <small class="text-muted" style="font-size: 0.7rem; display:block; margin-top:4px;">
                                <i class="bi bi-info-circle"></i> Format: JPG, PNG. Maks 2MB
                            </small>
                        </div>
                        <?php if (isset($produk) && !empty($produk->foto_utama)): ?>
                            <div class="mt-2">
                                <small class="text-muted">Foto saat ini:</small><br>
                                <img src="<?= base_url('uploads/produk/' . $produk->foto_utama); ?>" 
                                     width="80" height="80" style="object-fit:cover; border-radius:8px; margin-top:4px; border:1px solid rgba(74,44,17,0.06);">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- FORM ACTIONS -->
            <div class="form-actions">
                <a href="<?= base_url('admin/produk'); ?>" class="btn btn-secondary-custom btn-custom">
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

        const hargaDefault = {
            'Ceri': 7000,
            'Biji Kopi': 70000,
            'Kopi Bubuk': 120000
        };

        const prosesDefault = {
            'Ceri': 'Tanpa Proses',
            'Biji Kopi': 'Pencucian, Pengupasan, Penjemuran',
            'Kopi Bubuk': 'Pencucian, Pengupasan, Penjemuran, Penggilingan, Pengemasan'
        };

        if (namaProduk) {
            namaProduk.addEventListener('change', function() {
                const value = this.value;
                
                if (jenisKopi && value !== '') {
                    jenisKopi.value = 'Liberica';
                }

                // Hanya isi default jika Admin mengubah pilihan nama produk
                if (proses && value && prosesDefault[value]) {
                    proses.value = prosesDefault[value];
                }

                if (harga && value && hargaDefault[value]) {
                    harga.value = hargaDefault[value];
                }
            });
        }
    });
</script>