<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Panen - Admin</title>
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
        .custom-card { background: var(--card-white); border: 1px solid rgba(74, 44, 17, 0.06); border-radius: 14px; box-shadow: 0 8px 30px rgba(44, 24, 8, 0.08); overflow: hidden; }
        .custom-card .card-header-custom { padding: 18px 24px; border-bottom: 1px solid rgba(74, 44, 17, 0.06); font-weight: 700; font-size: 0.9rem; }
        .custom-card .card-body-custom { padding: 24px; }
        .btn-custom { border-radius: 8px; font-size: 0.85rem; font-weight: 600; padding: 8px 20px; }
        
        .detail-row { border-bottom: 1px solid rgba(74, 44, 17, 0.05); padding-bottom: 10px; margin-bottom: 15px; }
        .detail-label { font-size: 0.8rem; color: var(--text-secondary); text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 4px; }
        .detail-value { font-size: 1rem; font-weight: 600; color: var(--dark-coffee); }
        .foto-box img { width: 100%; max-width: 400px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="bi bi-patch-check-fill"></i></div>
        <span>ADMIN <br><small style="font-weight:400; font-size:0.7rem; color:#A8988A;">Liberchain</small></span>
    </div>
    <div class="sidebar-menu-wrapper">
        <ul class="sidebar-menu">
            <li class="menu-item">
                <a href="<?= base_url('admin/dashboard'); ?>">
                    <i class="bi bi-grid-1x2-fill"></i>Dashboard
                </a>
            </li>
            <li class="menu-item">
                <a href="<?= base_url('admin/user'); ?>">
                    <i class="bi bi-people-fill"></i>Manajemen User
                    <span class="menu-badge" style="margin-left: auto; background: rgba(230, 161, 92, 0.2); color: #E6A15C; font-size: 0.7rem; padding: 2px 10px; border-radius: 20px; font-weight: 600;">12</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="<?= base_url('admin/petani'); ?>">
                    <i class="bi bi-person-badge-fill"></i>Data Petani
                </a>
            </li>
            <li class="menu-item">
                <a href="<?= base_url('admin/lahan'); ?>">
                    <i class="bi bi-map-fill"></i>Manajemen Lahan
                </a>
            </li>
            <li class="menu-item active">
                <a href="<?= base_url('admin/panen'); ?>">
                    <i class="bi bi-tree-fill"></i>Manajemen Panen
                </a>
            </li>
            <li class="menu-item">
                <a href="<?= base_url('admin/produk'); ?>">
                    <i class="bi bi-box-seam-fill"></i>Manajemen Produk
                </a>
            </li>
            <li class="menu-item">
                <a href="<?= base_url('admin/transaksi'); ?>">
                    <i class="bi bi-wallet2"></i>Transaksi
                    <span class="menu-badge" style="margin-left: auto; background: rgba(230, 161, 92, 0.2); color: #E6A15C; font-size: 0.7rem; padding: 2px 10px; border-radius: 20px; font-weight: 600;">8</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="<?= base_url('admin/kurir'); ?>">
                    <i class="bi bi-truck"></i>Manajemen Kurir
                </a>
            </li>
            <li class="menu-item">
                <a href="<?= base_url('admin/mitra'); ?>">
                    <i class="bi bi-shop"></i>Manajemen Mitra
                </a>
            </li>
            <li class="menu-item">
                <a href="<?= base_url('admin/laporan'); ?>">
                    <i class="bi bi-file-earmark-bar-graph-fill"></i>Laporan & Analytics
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="main-content">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-0">Detail Panen</h2>
            <p class="subtitle mb-0 mt-1">Informasi lengkap hasil panen Petani.</p>
        </div>
        <div>
            <a href="<?= base_url('admin/panen'); ?>" class="btn btn-custom btn-secondary" style="background:#E5E7EB; border:none; color:#4B5563;"><i class="bi bi-arrow-left"></i> Kembali</a>
        </div>
    </div>

    <div class="custom-card">
        <div class="card-header-custom">
            <i class="bi bi-info-circle mr-2 text-warning"></i>Informasi Panen Petani: <span class="text-primary"><?= htmlspecialchars($panen['nama_petani'] ?? 'Unknown'); ?></span>
        </div>
        <div class="card-body-custom">
            <div class="row">
                <div class="col-md-7">
                    <div class="detail-row">
                        <div class="detail-label">Petani</div>
                        <div class="detail-value text-primary"><?= htmlspecialchars($panen['nama_petani'] ?? 'Unknown'); ?></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Tanggal Panen</div>
                        <div class="detail-value"><?= date('d F Y', strtotime($panen['tanggal_panen'])); ?></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Lahan</div>
                        <div class="detail-value"><?= htmlspecialchars($panen['nama_lahan'] ?? '-'); ?> <br><small class="text-muted"><i class="bi bi-geo-alt"></i> <?= htmlspecialchars($panen['lokasi'] ?? '-'); ?></small></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Jumlah Panen</div>
                        <div class="detail-value text-success" style="font-size: 1.3rem;"><?= number_format($panen['jumlah_panen'], 0, ',', '.'); ?> Kg</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Kualitas / Grade</div>
                        <div class="detail-value"><span class="badge badge-light" style="font-size:0.9rem; border:1px solid #ccc; padding:6px 12px;"><?= htmlspecialchars($panen['kualitas'] ?? '-'); ?></span></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Catatan Tambahan</div>
                        <div class="detail-value" style="font-weight: 500; font-size: 0.9rem; color: #555;">
                            <?= !empty($panen['catatan']) ? nl2br(htmlspecialchars($panen['catatan'])) : '<i>Tidak ada catatan</i>'; ?>
                        </div>
                    </div>
                    <div class="detail-row" style="border:none;">
                        <div class="detail-label">Dicatat Pada</div>
                        <div class="detail-value" style="font-size: 0.8rem; font-weight: 400;"><?= date('d F Y H:i:s', strtotime($panen['created_at'])); ?></div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="detail-label mb-2">Foto Hasil Panen</div>
                    <div class="foto-box">
                        <?php if ($panen['foto_panen']): ?>
                            <img src="<?= base_url('uploads/panen/'.$panen['foto_panen']); ?>" alt="Foto Panen">
                        <?php else: ?>
                            <div class="alert alert-secondary text-center">Belum ada foto yang diunggah.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
</body>
</html>
