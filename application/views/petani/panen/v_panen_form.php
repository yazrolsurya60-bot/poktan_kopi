<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($panen) ? 'Edit Panen' : 'Tambah Panen'; ?> - Petani</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* ... existing styles ... */
        :root {
            --roasted-brown: #4A2C11;
            --dark-coffee: #2C1808;
            --amber-cream: #E6A15C;
            --bg-cream: #FAF6F0;
            --card-white: #FFFFFF;
            --text-secondary: #70655E;
            --sidebar-width: 260px;
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-cream); color: var(--dark-coffee); overflow-x: hidden; }
        .sidebar { width: var(--sidebar-width); height: 100vh; position: fixed; top: 0; left: 0; background: linear-gradient(180deg, var(--dark-coffee) 0%, #1a0e04 100%); color: var(--bg-cream); }
        .sidebar-brand { padding: 28px 24px 20px; font-size: 1.1rem; font-weight: 700; border-bottom: 1px solid rgba(250,246,240,0.08); color: var(--amber-cream); display: flex; align-items: center; gap: 10px; }
        .sidebar-brand .brand-icon { width: 40px; height: 40px; background: rgba(230, 161, 92, 0.15); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; }
        .sidebar-menu-wrapper { padding: 15px 0; }
        .sidebar-menu { list-style: none; margin: 0; padding: 0; }
        .menu-item a { display: flex; align-items: center; padding: 12px 24px; color: #A8988A; font-weight: 500; font-size: 0.9rem; text-decoration: none; margin: 2px 10px; border-radius: 10px; }
        .menu-item a i { font-size: 1.15rem; margin-right: 14px; width: 22px; text-align: center; }
        .menu-item.active a { background: rgba(230, 161, 92, 0.18); border-left: 3px solid var(--amber-cream); color: #fff; }
        
        .main-content { margin-left: var(--sidebar-width); padding: 30px 40px; }
        .page-header { border-bottom: 1px solid rgba(74,44,17,0.08); padding-bottom: 20px; margin-bottom: 30px; }
        .custom-card { background: var(--card-white); border: 1px solid rgba(74, 44, 17, 0.06); border-radius: 14px; box-shadow: 0 8px 30px rgba(44, 24, 8, 0.08); }
        .custom-card .card-header-custom { padding: 18px 24px; border-bottom: 1px solid rgba(74, 44, 17, 0.06); font-weight: 700; font-size: 0.9rem; }
        .custom-card .card-body-custom { padding: 24px; }
        .form-control, .custom-select { border-radius: 8px; font-size: 0.85rem; border: 1px solid rgba(74, 44, 17, 0.2); }
        .form-control:focus, .custom-select:focus { border-color: var(--amber-cream); box-shadow: 0 0 0 0.2rem rgba(230, 161, 92, 0.25); }
        .btn-custom { border-radius: 8px; font-size: 0.85rem; font-weight: 600; padding: 8px 20px; border: none; }
        .btn-primary-custom { background-color: var(--amber-cream); color: white; }
        .btn-primary-custom:hover { background-color: #d18d48; color: white; }
        .btn-secondary-custom { background-color: #E5E7EB; color: #4B5563; }
        .btn-secondary-custom:hover { background-color: #D1D5DB; color: #374151; }
        label { font-weight: 600; font-size: 0.85rem; color: var(--text-secondary); }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="bi bi-patch-check-fill"></i></div>
        <span>PETANI <br><small style="font-weight:400; font-size:0.7rem; color:#A8988A;">Liberchain</small></span>
    </div>
    <div class="sidebar-menu-wrapper">
        <ul class="sidebar-menu">
            <li class="menu-item"><a href="<?= base_url('petani/dashboard'); ?>"><i class="bi bi-grid-1x2-fill"></i>Dashboard</a></li>
            <li class="menu-item active"><a href="<?= base_url('petani/panen'); ?>"><i class="bi bi-textarea-rose"></i>Manajemen Panen</a></li>
        </ul>
    </div>
</div>

<div class="main-content">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-0"><?= isset($panen) ? 'Edit Panen' : 'Tambah Panen Baru'; ?></h2>
            <p class="subtitle mb-0 mt-1"><?= isset($panen) ? 'Perbarui data' : 'Catat data'; ?> hasil panen kopi Anda (M04-F01/M04-F04).</p>
        </div>
        <div>
            <a href="<?= base_url('petani/panen'); ?>" class="btn btn-custom btn-secondary-custom"><i class="bi bi-arrow-left"></i> Kembali</a>
        </div>
    </div>

    <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger" style="border-radius: 10px;">
        <?= $this->session->flashdata('error'); ?>
    </div>
    <?php endif; ?>

    <div class="custom-card">
        <div class="card-header-custom">
            <i class="bi bi-file-earmark-text mr-2 text-warning"></i>Form Data Panen
        </div>
        <div class="card-body-custom">
            <?php 
            $action_url = isset($panen) ? base_url('petani/panen/edit/'.$panen['id_panen']) : base_url('petani/panen/tambah');
            ?>
            <form action="<?= $action_url; ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Pilih Lahan <span class="text-danger">*</span></label>
                        <select name="id_lahan" class="custom-select" required>
                            <option value="">-- Pilih Lahan --</option>
                            <?php foreach ($lahan_list as $l): ?>
                                <option value="<?= $l['id_lahan']; ?>" <?= (isset($panen) && $panen['id_lahan'] == $l['id_lahan']) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($l['nama_lahan']) . ' - ' . htmlspecialchars($l['lokasi']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Tanggal Panen <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_panen" class="form-control" value="<?= isset($panen) ? $panen['tanggal_panen'] : date('Y-m-d'); ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Jumlah Panen (Kg) <span class="text-danger">*</span></label>
                        <input type="number" name="jumlah_panen" class="form-control" min="1" value="<?= isset($panen) ? $panen['jumlah_panen'] : ''; ?>" required placeholder="Contoh: 150">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Kualitas (Teks) <span class="text-danger">*</span></label>
                        <input type="text" name="kualitas" class="form-control" value="<?= isset($panen) ? $panen['kualitas'] : ''; ?>" required placeholder="Contoh: Grade A / Campur / Sortasi 1">
                    </div>
                </div>

                <div class="form-group">
                    <label>Catatan Tambahan (Opsional)</label>
                    <textarea name="catatan" class="form-control" rows="3" placeholder="Masukkan catatan kondisi panen atau lahan..."><?= isset($panen) ? $panen['catatan'] : ''; ?></textarea>
                </div>

                <div class="form-group">
                    <label>Foto Panen <?= !isset($panen) ? '<span class="text-danger">*</span>' : '(Abaikan jika tidak ingin mengubah foto)'; ?></label>
                    <input type="file" name="foto_panen" class="form-control-file" <?= !isset($panen) ? 'required' : ''; ?> accept="image/*">
                    <small class="form-text text-muted">Format: JPG/PNG/GIF, Max: 2MB.</small>
                    <?php if (isset($panen) && $panen['foto_panen']): ?>
                        <div class="mt-2">
                            <img src="<?= base_url('uploads/panen/'.$panen['foto_panen']); ?>" alt="Foto Panen" class="img-thumbnail" style="height: 120px;">
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-custom btn-primary-custom"><i class="bi bi-save mr-1"></i> Simpan Data Panen</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
</body>
</html>
