<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mitra - Sistem Supply Chain Kopi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --roasted-brown: #4A2C11;
            --dark-coffee: #2C1808;
            --amber-cream: #E6A15C;
            --bg-cream: #FAF6F0;
            --card-white: #FFFFFF;
            --text-secondary: #70655E;
            --sidebar-width: 260px;
            --radius-card: 14px;
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-cream);
            color: var(--dark-coffee);
        }
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 30px 40px;
            min-height: 100vh;
        }
        .custom-card {
            background: var(--card-white);
            border: 1px solid rgba(74, 44, 17, 0.06);
            border-radius: var(--radius-card);
            box-shadow: 0 8px 30px rgba(44, 24, 8, 0.08);
            padding: 30px;
        }
        .form-control-custom {
            border: 1px solid rgba(74, 44, 17, 0.15);
            border-radius: 10px;
            padding: 10px 16px;
            font-size: 0.9rem;
            color: var(--dark-coffee);
            transition: var(--transition-smooth);
        }
        .form-control-custom:focus {
            border-color: var(--amber-cream);
            box-shadow: 0 0 0 3px rgba(230, 161, 92, 0.2);
            outline: none;
        }
        .btn-custom-primary {
            background: var(--roasted-brown);
            color: #ffffff;
            border: none;
            border-radius: 10px;
            padding: 10px 24px;
            font-weight: 600;
            transition: var(--transition-smooth);
            box-shadow: 0 4px 15px rgba(74, 44, 17, 0.2);
        }
        .btn-custom-primary:hover {
            background: var(--dark-coffee);
            color: #ffffff;
            transform: translateY(-2px);
        }
        .btn-custom-outline {
            border: 1px solid rgba(74, 44, 17, 0.2);
            border-radius: 10px;
            padding: 10px 24px;
            font-weight: 600;
            color: var(--text-secondary);
            background: transparent;
            text-decoration: none;
            display: inline-block;
        }
        .btn-custom-outline:hover {
            background: var(--bg-cream);
            color: var(--roasted-brown);
            border-color: var(--roasted-brown);
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="main-content" style="margin-left: 0; max-width: 800px; margin: 40px auto;">
        <h3 class="mb-4 font-weight-bold">Tambah Mitra Baru</h3>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger" style="border-radius: 10px;"><?= $this->session->flashdata('error'); ?></div>
        <?php endif; ?>

        <div class="custom-card">
            <form action="<?= base_url('admin/mitra/add'); ?>" method="POST" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label class="font-weight-bold text-secondary">Nama Mitra</label>
                    <input type="text" name="nama_mitra" class="form-control form-control-custom" placeholder="Masukkan nama mitra (contoh: Cafe Senja)" required>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold text-secondary">Kategori Mitra</label>
                    <input type="text" name="kategori_mitra" class="form-control form-control-custom" placeholder="contoh: Cafe, Restoran, Distributor" required>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold text-secondary">Urutan Tampil</label>
                        <input type="number" name="urutan_tampil" class="form-control form-control-custom" value="1" min="1" required>
                        <small class="form-text text-muted">Untuk prioritas tampil di Landing Page (angka kecil tampil lebih dulu).</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold text-secondary">Logo Mitra</label>
                        <input type="file" name="logo_mitra" class="form-control-file" accept="image/*">
                        <small class="form-text text-muted">Maksimal 2MB. Format: JPG, PNG, GIF.</small>
                    </div>
                </div>

                <hr class="mt-4 mb-4" style="border-color: rgba(74, 44, 17, 0.1);">

                <div class="d-flex justify-content-end gap-2" style="gap: 10px;">
                    <a href="<?= base_url('admin/mitra'); ?>" class="btn-custom-outline">Batal</a>
                    <button type="submit" class="btn-custom-primary"><i class="bi bi-save mr-2"></i> Simpan Mitra</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
