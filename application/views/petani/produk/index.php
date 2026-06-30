<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk Kopi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
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

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-cream);
            color: var(--dark-coffee);
            overflow-x: hidden;
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, var(--dark-coffee) 0%, #1a0e04 100%);
            color: var(--bg-cream);
            z-index: 100;
            transition: var(--transition-smooth);
            box-shadow: 4px 0 25px rgba(44, 24, 8, 0.2);
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            padding: 28px 24px 20px;
            font-size: 1.1rem;
            font-weight: 700;
            border-bottom: 1px solid rgba(250, 246, 240, 0.08);
            color: var(--amber-cream);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-brand .brand-icon {
            width: 40px;
            height: 40px;
            background: rgba(230, 161, 92, 0.15);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }

        .sidebar-menu-wrapper {
            flex: 1;
            overflow-y: auto;
            padding: 15px 0;
        }

        .sidebar-menu {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .menu-item a {
            display: flex;
            align-items: center;
            padding: 12px 24px;
            color: #A8988A;
            font-weight: 500;
            font-size: 0.9rem;
            text-decoration: none;
            transition: var(--transition-smooth);
            position: relative;
            margin: 2px 10px;
            border-radius: 10px;
        }

        .menu-item a i {
            font-size: 1.15rem;
            margin-right: 14px;
            width: 22px;
            text-align: center;
        }

        .menu-item a .menu-badge {
            margin-left: auto;
            background: rgba(230, 161, 92, 0.2);
            color: var(--amber-cream);
            font-size: 0.7rem;
            padding: 2px 10px;
            border-radius: 20px;
            font-weight: 600;
        }

        .menu-item a:hover {
            color: #ffffff;
            background: rgba(230, 161, 92, 0.12);
            text-decoration: none;
        }

        .menu-item.active a {
            color: #ffffff;
            background: rgba(230, 161, 92, 0.18);
        }

        .menu-item.active a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 24px;
            background: var(--amber-cream);
            border-radius: 0 3px 3px 0;
        }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid rgba(250, 246, 240, 0.06);
            margin-top: auto;
        }

        .sidebar-footer .btn-logout {
            width: 100%;
            padding: 10px 16px;
            border: 1px solid rgba(250, 246, 240, 0.1);
            border-radius: 10px;
            background: transparent;
            color: #A8988A;
            font-weight: 500;
            font-size: 0.85rem;
            transition: var(--transition-smooth);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
        }

        .sidebar-footer .btn-logout:hover {
            background: rgba(230, 161, 92, 0.1);
            color: #ffffff;
            border-color: rgba(230, 161, 92, 0.2);
            text-decoration: none;
        }

        /* --- KONTEN UTAMA --- */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 30px 40px 40px;
            min-height: 100vh;
        }

        .page-header {
            border-bottom: 1px solid rgba(74, 44, 17, 0.08);
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .custom-card {
            background: var(--card-white);
            border: 1px solid rgba(74, 44, 17, 0.06);
            border-radius: 14px;
            box-shadow: 0 8px 30px rgba(44, 24, 8, 0.08);
        }

        .table-modern thead th {
            background-color: #f8f9fa;
            color: #6c757d;
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #edf2f7 !important;
            border-top: none !important;
        }

        .table-modern tbody td {
            border-bottom: 1px solid #edf2f7 !important;
            color: #495057;
            font-size: 0.9rem;
            vertical-align: middle;
        }

        .table-modern tbody tr:hover {
            background-color: #fdfcfb;
        }

        .btn-custom {
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 8px 20px;
            border: none;
        }

        .btn-primary-custom {
            background-color: var(--amber-cream);
            color: white;
        }

        .btn-primary-custom:hover {
            background-color: #d18d48;
            color: white;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            font-size: 0.85rem;
            color: white;
        }

        /* SCROLLBAR */
        .sidebar-menu-wrapper::-webkit-scrollbar { width: 3px; }
        .sidebar-menu-wrapper::-webkit-scrollbar-track { background: transparent; }
        .sidebar-menu-wrapper::-webkit-scrollbar-thumb { background: rgba(230, 161, 92, 0.3); border-radius: 10px; }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebarMenu">
        <div class="sidebar-brand">
            <div class="brand-icon">
                <i class="bi bi-patch-check-fill"></i>
            </div>
            <span>PETANI <br><small style="font-weight:400; font-size:0.7rem; color:#A8988A;">Liberchain</small></span>
        </div>

        <div class="sidebar-menu-wrapper">
            <ul class="sidebar-menu">
                <li class="menu-item <?= ($this->uri->segment(2) == 'dashboard' || $this->uri->segment(2) == '') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/dashboard'); ?>">
                        <i class="bi bi-grid-1x2-fill"></i> Dashboard
                    </a>
                </li>
                <li class="menu-item <?= ($this->uri->segment(2) == 'lahan') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/lahan'); ?>">
                        <i class="bi bi-geo-alt-fill"></i> Kelola Lahan
                    </a>
                </li>
                <li class="menu-item <?= ($this->uri->segment(2) == 'panen') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/panen'); ?>">
                        <i class="bi bi-tree-fill"></i> Manajemen Panen
                    </a>
                </li>
                <li class="menu-item <?= ($this->uri->segment(2) == 'produk') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/produk'); ?>">
                        <i class="bi bi-box-seam"></i> Katalog Produk
                    </a>
                </li>
                <li class="menu-item <?= ($this->uri->segment(2) == 'transaksi') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/transaksi'); ?>">
                        <i class="bi bi-cart-check-fill"></i> Pesanan Masuk
                    </a>
                </li>
                <li class="menu-item <?= ($this->uri->segment(2) == 'tracking') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/tracking'); ?>">
                        <i class="bi bi-truck"></i> Tracking Kiriman
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidebar-footer">
            <button class="btn-logout" onclick="window.location.href='<?= base_url('auth/logout'); ?>'">
                <i class="bi bi-box-arrow-right"></i> Keluar
            </button>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="page-header d-flex justify-content-between align-items-center">
            <div>
                <h2 class="font-weight-bold text-dark mb-1">Katalog Produk</h2>
                <p class="text-muted mb-0" style="font-size: 0.9rem;">Kelola daftar produk kopi yang siap dipasarkan ke pembeli.</p>
            </div>
            <a href="<?= base_url('petani/produk/tambah'); ?>" class="btn btn-primary-custom shadow-sm">
                <i class="fas fa-plus mr-2"></i> Tambah Produk
            </a>
        </div>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="fas fa-check-circle mr-1"></i> <?= $this->session->flashdata('success'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="custom-card">
            <div class="table-responsive">
                <table class="table table-modern table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th width="10%" class="text-center">Foto</th>
                            <th width="20%">Nama Produk</th>
                            <th width="15%">Jenis Kopi & Grade</th>
                            <th width="15%">Harga (Rp)</th>
                            <th width="10%">Stok</th>
                            <th width="10%" class="text-center">Status</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($produk)): ?>
                            <?php $no=1; foreach($produk as $row): ?>
                            <tr>
                                <td class="text-center text-muted font-weight-bold"><?= $no++ ?></td>
                                <td class="text-center">
                                    <?php if(!empty($row->foto_utama)): ?>
                                        <img src="<?= base_url('uploads/produk/' . $row->foto_utama) ?>" class="img-thumbnail rounded" style="max-width: 60px; height: 60px; object-fit: cover;">
                                    <?php else: ?>
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted" style="width: 60px; height: 60px; margin: 0 auto;">
                                            <i class="bi bi-image" style="font-size: 1.5rem;"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="font-weight-bold text-dark d-block"><?= htmlspecialchars($row->nama_produk) ?></span>
                                </td>
                                <td>
                                    <span class="text-coffee-primary font-weight-bold"><?= htmlspecialchars($row->jenis_kopi) ?></span><br>
                                    <small class="text-muted">Grade: <?= htmlspecialchars($row->grade) ?></small>
                                </td>
                                <td class="font-weight-bold text-dark">Rp <?= number_format($row->harga, 0, ',', '.') ?></td>
                                <td>
                                    <span class="badge badge-light border border-secondary text-dark px-2 py-1"><?= htmlspecialchars($row->stok_produk) ?> Kg</span>
                                </td>
                                <td class="text-center">
                                    <?php if(strtolower($row->status_produk) == 'tersedia'): ?>
                                        <span class="badge badge-success px-2 py-1">Tersedia</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger px-2 py-1">Habis</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a href="<?= base_url('petani/produk/detail/' . $row->id_produk) ?>" class="btn btn-action mr-1" style="background-color: #5c3d2e;" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?= base_url('petani/produk/edit/' . $row->id_produk) ?>" class="btn btn-warning btn-action mr-1" title="Edit">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="<?= base_url('petani/produk/hapus/' . $row->id_produk) ?>" class="btn btn-danger btn-action" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted py-5 bg-white">
                                    <i class="fas fa-box-open fa-3x mb-3 text-secondary"></i>
                                    <h6 class="font-weight-bold text-secondary mb-1">Belum Ada Katalog Produk</h6>
                                    <small class="text-muted">Tambahkan produk kopi Anda untuk mulai menjual ke pembeli.</small>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>