<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --roasted-brown: #4A2C11;
            --dark-coffee: #2C1808;
            --amber-cream: #E6A15C;
            --amber-light: #FDF5ED;
            --bg-cream: #FAF6F0;
            --card-white: #FFFFFF;
            --text-secondary: #70655E;
            --text-muted: #A8988A;
            --sidebar-width: 260px;
            --shadow-soft: 0 8px 30px rgba(44, 24, 8, 0.08);
            --shadow-hover: 0 12px 40px rgba(44, 24, 8, 0.15);
            --radius-card: 16px;
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-cream);
            color: var(--dark-coffee);
            overflow-x: hidden;
        }

        /* SIDEBAR (TETAP SAMA) */
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
            letter-spacing: 0.5px;
            border-bottom: 1px solid rgba(250, 246, 240, 0.08);
            color: var(--amber-cream);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-brand .brand-icon {
            width: 44px;
            height: 44px;
            background: rgba(230, 161, 92, 0.15);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            border: 1px solid rgba(230, 161, 92, 0.1);
        }

        .sidebar-brand .brand-text small {
            font-weight: 400;
            font-size: 0.7rem;
            color: var(--text-muted);
            display: block;
            margin-top: -2px;
        }

        .sidebar-menu-wrapper {
            flex: 1;
            overflow-y: auto;
            padding: 12px 0;
        }

        .sidebar-menu-wrapper::-webkit-scrollbar { width: 3px; }
        .sidebar-menu-wrapper::-webkit-scrollbar-thumb { background: rgba(230, 161, 92, 0.3); border-radius: 10px; }

        .sidebar-menu { list-style: none; margin: 0; padding: 0; }
        .menu-item a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #A8988A;
            font-weight: 500;
            font-size: 0.85rem;
            transition: var(--transition-smooth);
            text-decoration: none;
            position: relative;
            margin: 2px 12px;
            border-radius: 10px;
        }
        .menu-item a i { font-size: 1.1rem; margin-right: 14px; width: 22px; text-align: center; }
        .menu-item a .menu-badge {
            margin-left: auto;
            background: rgba(230, 161, 92, 0.2);
            color: var(--amber-cream);
            font-size: 0.65rem;
            padding: 2px 10px;
            border-radius: 20px;
            font-weight: 600;
        }
        .menu-item.active a, .menu-item a:hover { color: #ffffff; background: rgba(230, 161, 92, 0.12); }
        .menu-item.active a { background: rgba(230, 161, 92, 0.18); border-left: 3px solid var(--amber-cream); }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid rgba(250, 246, 240, 0.06);
            margin-top: auto;
        }
        .sidebar-footer .btn-logout {
            width: 100%;
            padding: 10px 16px;
            border: 1px solid rgba(250, 246, 240, 0.08);
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
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 30px 40px 40px;
            min-height: 100vh;
            transition: var(--transition-smooth);
        }

        .page-header {
            padding-bottom: 20px;
            margin-bottom: 28px;
            border-bottom: 1px solid rgba(74, 44, 17, 0.06);
        }

        .page-header .page-title {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--dark-coffee);
            letter-spacing: -0.03em;
        }

        .page-header .page-title i {
            color: var(--amber-cream);
            margin-right: 10px;
        }

        .page-header .subtitle {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-top: 4px;
        }

        /* NOTIFICATION (TETAP SAMA) */
        .notif-btn {
            position: relative;
            background: var(--card-white);
            border: 1px solid rgba(74, 44, 17, 0.06);
            border-radius: 12px;
            padding: 8px 14px;
            color: var(--dark-coffee);
            transition: var(--transition-smooth);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .notif-btn:hover { background: var(--bg-cream); box-shadow: var(--shadow-soft); transform: translateY(-1px); }
        .notif-btn .notif-dot {
            position: absolute;
            top: -4px;
            right: -4px;
            width: 20px;
            height: 20px;
            background: #EF4444;
            border-radius: 50%;
            font-size: 0.6rem;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            border: 2px solid white;
            animation: pulse-dot 2s infinite;
        }
        @keyframes pulse-dot { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.1); } }

        .notif-dropdown {
            position: absolute;
            right: 0;
            top: calc(100% + 10px);
            width: 380px;
            max-height: 400px;
            background: var(--card-white);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-hover);
            border: 1px solid rgba(74, 44, 17, 0.06);
            overflow: hidden;
            display: none;
            z-index: 50;
        }
        .notif-dropdown.show { display: block; animation: slideDown 0.25s ease; }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        .notif-dropdown-header {
            padding: 14px 18px;
            border-bottom: 1px solid rgba(74, 44, 17, 0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
        }
        .notif-dropdown-header a { font-size: 0.75rem; color: var(--amber-cream); font-weight: 500; text-decoration: none; }
        .notif-item {
            padding: 12px 18px;
            border-bottom: 1px solid rgba(74, 44, 17, 0.04);
            display: flex;
            align-items: flex-start;
            gap: 12px;
            transition: var(--transition-smooth);
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }
        .notif-item:hover { background: var(--bg-cream); }
        .notif-item .notif-icon {
            width: 36px;
            height: 36px;
            min-width: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }
        .notif-item .notif-icon.success { background: #D1FAE5; color: #065F46; }
        .notif-item .notif-icon.warning { background: #FEF3C7; color: #92400E; }
        .notif-item .notif-icon.info { background: #DBEAFE; color: #1E40AF; }
        .notif-item .notif-icon.danger { background: #FEE2E2; color: #991B1B; }
        .notif-item .notif-text { flex: 1; font-size: 0.85rem; }
        .notif-item .notif-text .notif-time { font-size: 0.7rem; color: var(--text-secondary); display: block; margin-top: 2px; }
        .notif-item.unread .notif-text { font-weight: 600; }

        /* STATUS BADGE */
        .status-badge {
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            display: inline-block;
        }
        .status-badge.pending { background: #FEF3C7; color: #92400E; }
        .status-badge.processing { background: #DBEAFE; color: #1E40AF; }
        .status-badge.delivery { background: #EDE9FE; color: #5B21B6; }
        .status-badge.complete { background: #D1FAE5; color: #065F46; }
        .status-badge.cancelled { background: #FEE2E2; color: #991B1B; }

        /* CUSTOM CARD - PREMIUM */
        .custom-card {
            background: var(--card-white);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-soft);
            transition: var(--transition-smooth);
            overflow: hidden;
            border: 1px solid rgba(74, 44, 17, 0.04);
        }
        .custom-card:hover { box-shadow: var(--shadow-hover); }
        .custom-card .card-header-custom {
            padding: 16px 24px;
            border-bottom: 1px solid rgba(74, 44, 17, 0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(250, 246, 240, 0.3);
        }
        .custom-card .card-header-custom h6 {
            font-weight: 700;
            color: var(--dark-coffee);
            margin: 0;
            font-size: 0.9rem;
        }
        .custom-card .card-header-custom h6 i {
            color: var(--amber-cream);
            margin-right: 8px;
        }
        .custom-card .card-body-custom { padding: 24px; }

        /* TABLE */
        .table-custom { font-size: 0.85rem; margin-bottom: 0; }
        .table-custom thead th {
            background: rgba(250, 246, 240, 0.4);
            border-bottom: 2px solid rgba(74, 44, 17, 0.06);
            color: var(--text-secondary);
            font-weight: 600;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 12px 10px;
        }
        .table-custom tbody td {
            padding: 12px 10px;
            border-bottom: 1px solid rgba(74, 44, 17, 0.04);
            vertical-align: middle;
        }
        .table-custom tbody tr:hover { background: rgba(250, 246, 240, 0.4); }

        /* DETAIL LABEL */
        .detail-label {
            font-weight: 600;
            color: var(--text-secondary);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        .detail-value {
            font-weight: 600;
            color: var(--dark-coffee);
        }

        /* BUTTONS */
        .btn-amber {
            background: linear-gradient(135deg, var(--roasted-brown), var(--amber-cream));
            color: white;
            border-radius: 10px;
            padding: 8px 20px;
            font-weight: 600;
            border: none;
            transition: var(--transition-smooth);
        }
        .btn-amber:hover { opacity: 0.85; color: white; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(230, 161, 92, 0.3); }

        .btn-outline-amber {
            background: transparent;
            color: var(--amber-cream);
            border: 1px solid var(--amber-cream);
            border-radius: 10px;
            padding: 8px 20px;
            font-weight: 600;
            transition: var(--transition-smooth);
        }
        .btn-outline-amber:hover { background: var(--amber-cream); color: white; transform: translateY(-2px); }

        .btn-back {
            background: transparent;
            color: var(--text-secondary);
            border: 1px solid rgba(74, 44, 17, 0.1);
            border-radius: 10px;
            padding: 8px 20px;
            font-weight: 600;
            transition: var(--transition-smooth);
        }
        .btn-back:hover { background: var(--bg-cream); border-color: var(--roasted-brown); color: var(--dark-coffee); transform: translateY(-2px); }

        /* RESPONSIVE */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 99;
        }
        .sidebar-overlay.active { display: block; }

        @media (max-width: 991.98px) {
            .sidebar { left: calc(-1 * var(--sidebar-width)); box-shadow: none; }
            .sidebar.open { left: 0; box-shadow: 0 0 40px rgba(0, 0, 0, 0.3); }
            .main-content { margin-left: 0; padding: 20px 16px 30px; }
            .page-header .page-title { font-size: 1.2rem; }
            .notif-dropdown { width: calc(100vw - 32px); right: -60px; }
        }
        @media (max-width: 575.98px) {
            .main-content { padding: 16px 12px 20px; }
            .custom-card .card-body-custom { padding: 16px; }
            .notif-dropdown { width: calc(100vw - 24px); right: -70px; }
        }

        .fade-in { animation: fadeInUp 0.6s ease forwards; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>

    <!-- SIDEBAR OVERLAY -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- SIDEBAR (TETAP SAMA) -->
    <div class="sidebar" id="sidebarMenu">
        <div class="sidebar-brand">
            <div class="brand-icon"><i class="bi bi-patch-check-fill"></i></div>
            <div class="brand-text">POKTAN <small>Liberchain</small></div>
        </div>
        <div class="sidebar-menu-wrapper">
            <ul class="sidebar-menu">
                <li class="menu-item"><a href="<?= base_url('admin/dashboard'); ?>"><i class="bi bi-grid-1x2-fill"></i>Dashboard</a></li>
                <li class="menu-item"><a href="<?= base_url('admin/user'); ?>"><i class="bi bi-people-fill"></i>Manajemen User <span class="menu-badge">12</span></a></li>
                <li class="menu-item"><a href="<?= base_url('admin/petani'); ?>"><i class="bi bi-person-badge-fill"></i>Data Petani</a></li>
                <li class="menu-item"><a href="<?= base_url('admin/lahan'); ?>"><i class="bi bi-map-fill"></i>Manajemen Lahan</a></li>
                <li class="menu-item"><a href="<?= base_url('admin/panen'); ?>"><i class="bi bi-tree-fill"></i>Manajemen Panen</a></li>
                <li class="menu-item"><a href="<?= base_url('admin/produk'); ?>"><i class="bi bi-box-seam-fill"></i>Manajemen Produk</a></li>
                <li class="menu-item active"><a href="<?= base_url('admin/transaksi'); ?>"><i class="bi bi-wallet2"></i>Transaksi</a></li>
                <li class="menu-item"><a href="<?= base_url('admin/kurir'); ?>"><i class="bi bi-truck"></i>Manajemen Kurir</a></li>
                <li class="menu-item"><a href="<?= base_url('admin/mitra'); ?>"><i class="bi bi-shop"></i>Manajemen Mitra</a></li>
                <li class="menu-item"><a href="<?= base_url('admin/laporan'); ?>"><i class="bi bi-file-earmark-bar-graph-fill"></i>Laporan & Analytics</a></li>
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

        <!-- PAGE HEADER -->
        <div class="page-header d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle" style="border-radius:12px; border:1px solid rgba(74,44,17,0.08);">
                    <i class="bi bi-list"></i>
                </button>
                <h1 class="page-title d-inline-block align-middle mb-0">
                    <i class="bi bi-file-text"></i> Detail Transaksi #<?= $transaksi['id_transaksi']; ?>
                </h1>
                <p class="subtitle mb-0 mt-1">Informasi lengkap transaksi</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div style="position: relative;">
                    <button class="notif-btn" id="notifToggle">
                        <i class="bi bi-bell" style="font-size: 1.2rem;"></i>
                        <span class="notif-dot" id="notifCount">3</span>
                    </button>
                    <div class="notif-dropdown" id="notifDropdown">
                        <div class="notif-dropdown-header">
                            <span>Notifikasi</span>
                            <a href="#" id="markAllRead">Tandai semua dibaca</a>
                        </div>
                        <div class="notif-dropdown-list">
                            <div class="notif-item unread">
                                <div class="notif-icon success"><i class="bi bi-check-circle"></i></div>
                                <div class="notif-text">Pesanan #INV-2026-008 telah sampai tujuan <span class="notif-time">5 menit lalu</span></div>
                            </div>
                            <div class="notif-item unread">
                                <div class="notif-icon info"><i class="bi bi-truck"></i></div>
                                <div class="notif-text">Kurir sedang menuju lokasi <span class="notif-time">15 menit lalu</span></div>
                            </div>
                            <div class="notif-item">
                                <div class="notif-icon warning"><i class="bi bi-star-fill"></i></div>
                                <div class="notif-text">Anda mendapatkan 50 poin reward! <span class="notif-time">1 jam lalu</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2" style="cursor:pointer; padding:8px 16px; border-radius:12px; background:var(--card-white); border:1px solid rgba(74,44,17,0.06); box-shadow:var(--shadow-soft);">
                    <i class="bi bi-person-circle" style="font-size:1.5rem; color:var(--amber-cream);"></i>
                    <span style="font-weight:600; font-size:0.85rem;">Admin</span>
                </div>
            </div>
        </div>

        <!-- ALERT -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle mr-1"></i> <?= $this->session->flashdata('success'); ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-circle mr-1"></i> <?= $this->session->flashdata('error'); ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php endif; ?>

        <div class="row">
            <!-- INFORMASI TRANSAKSI -->
            <div class="col-md-6 mb-4">
                <div class="custom-card fade-in">
                    <div class="card-header-custom">
                        <h6><i class="bi bi-info-circle"></i> Informasi Pesanan</h6>
                        <span class="status-badge <?= strtolower($transaksi['status_pesanan']) == 'selesai' ? 'complete' : (strtolower($transaksi['status_pesanan']) == 'pending' ? 'pending' : (strtolower($transaksi['status_pesanan']) == 'dikirim' ? 'delivery' : (strtolower($transaksi['status_pesanan']) == 'diproses' ? 'processing' : 'cancelled'))); ?>">
                            <?= $transaksi['status_pesanan']; ?>
                        </span>
                    </div>
                    <div class="card-body-custom">
                        <div class="row mb-2">
                            <div class="col-5 detail-label">ID Transaksi</div>
                            <div class="col-7 detail-value">#<?= $transaksi['id_transaksi']; ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 detail-label">Pembeli</div>
                            <div class="col-7 detail-value"><?= $transaksi['nama_pembeli'] ?? 'Guest'; ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 detail-label">Email</div>
                            <div class="col-7 detail-value"><?= $transaksi['email'] ?? '-'; ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 detail-label">No HP</div>
                            <div class="col-7 detail-value"><?= $transaksi['no_hp'] ?: $transaksi['user_hp'] ?? '-'; ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 detail-label">Alamat Kirim</div>
                            <div class="col-7 detail-value"><?= $transaksi['alamat_kirim']; ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 detail-label">Kota</div>
                            <div class="col-7 detail-value"><?= $transaksi['kota_kirim']; ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 detail-label">Kode Pos</div>
                            <div class="col-7 detail-value"><?= $transaksi['kode_pos']; ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 detail-label">Metode Bayar</div>
                            <div class="col-7 detail-value"><?= $transaksi['metode_bayar']; ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 detail-label">Status Bayar</div>
                            <div class="col-7">
                                <span class="status-badge <?= strtolower($transaksi['status_bayar']) == 'lunas' ? 'complete' : (strtolower($transaksi['status_bayar']) == 'batal' ? 'cancelled' : 'pending'); ?>">
                                    <?= $transaksi['status_bayar']; ?>
                                </span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 detail-label">Tanggal Transaksi</div>
                            <div class="col-7 detail-value"><?= date('d/m/Y H:i', strtotime($transaksi['tanggal_transaksi'])); ?></div>
                        </div>
                        <?php if ($transaksi['alasan_batal']): ?>
                            <div class="row mb-2">
                                <div class="col-5 detail-label">Alasan Batal</div>
                                <div class="col-7 detail-value" style="color: #EF4444;"><?= $transaksi['alasan_batal']; ?></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- DETAIL PRODUK -->
            <div class="col-md-6 mb-4">
                <div class="custom-card fade-in">
                    <div class="card-header-custom">
                        <h6><i class="bi bi-box-seam"></i> Detail Produk</h6>
                        <span class="badge" style="background:var(--bg-cream); color:var(--text-secondary); font-weight:600; padding:6px 14px; border-radius:20px;">
                            <?= count($details); ?> item
                        </span>
                    </div>
                    <div class="card-body-custom" style="padding:0;">
                        <div class="table-responsive">
                            <table class="table table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-right">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($details as $d): ?>
                                        <tr>
                                            <td><?= $d['nama_produk']; ?></td>
                                            <td class="text-center"><?= $d['jumlah']; ?></td>
                                            <td class="text-right">Rp <?= number_format($d['subtotal'], 0, ',', '.'); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2" class="text-right">Subtotal</th>
                                        <th class="text-right">Rp <?= number_format($transaksi['total_harga'], 0, ',', '.'); ?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" class="text-right">Ongkir</th>
                                        <th class="text-right">Rp <?= number_format($transaksi['ongkir'], 0, ',', '.'); ?></th>
                                    </tr>
                                    <tr style="border-top: 2px solid var(--amber-cream);">
                                        <th colspan="2" class="text-right" style="font-size:1rem;">Grand Total</th>
                                        <th class="text-right" style="font-size:1.1rem; color: var(--amber-cream); font-weight:700;">
                                            Rp <?= number_format($transaksi['grand_total'], 0, ',', '.'); ?>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- UPDATE STATUS -->
                <?php if ($transaksi['status_pesanan'] != 'Selesai' && $transaksi['status_pesanan'] != 'Dibatalkan'): ?>
                    <div class="custom-card mt-3 fade-in">
                        <div class="card-header-custom" style="background: #FEF3C7;">
                            <h6><i class="bi bi-arrow-repeat text-warning"></i> Update Status Pesanan</h6>
                        </div>
                        <div class="card-body-custom">
                            <form action="<?= base_url('admin/transaksi/update_status/' . $transaksi['id_transaksi']); ?>" method="POST">
                                <div class="row">
                                    <div class="col-md-8">
                                        <select name="status" class="form-control" style="border-radius:10px; border:1px solid rgba(74,44,17,0.12); padding:10px 14px;" required>
                                            <option value="">Pilih Status</option>
                                            <option value="Pending" <?= $transaksi['status_pesanan'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                            <option value="Diproses" <?= $transaksi['status_pesanan'] == 'Diproses' ? 'selected' : ''; ?>>Diproses</option>
                                            <option value="Dikirim" <?= $transaksi['status_pesanan'] == 'Dikirim' ? 'selected' : ''; ?>>Dikirim</option>
                                            <option value="Selesai">Selesai</option>
                                            <option value="Dibatalkan">Dibatalkan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn-amber btn-block">Update Status</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- TOMBOL -->
                <div class="mt-3 d-flex flex-wrap gap-2">
                    <a href="<?= base_url('admin/transaksi'); ?>" class="btn-back">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <a href="<?= base_url('admin/transaksi/invoice/' . $transaksi['id_transaksi']); ?>" target="_blank" class="btn-amber">
                        <i class="bi bi-file-pdf"></i> Invoice
                    </a>
                </div>
            </div>
        </div>

        <!-- BUKTI PEMBAYARAN -->
        <?php if ($bukti): ?>
            <div class="row">
                <div class="col-12">
                    <div class="custom-card fade-in">
                        <div class="card-header-custom">
                            <h6><i class="bi bi-credit-card"></i> Bukti Pembayaran</h6>
                            <span class="status-badge <?= strtolower($bukti['status_verifikasi']) == 'diverifikasi' ? 'complete' : (strtolower($bukti['status_verifikasi']) == 'ditolak' ? 'cancelled' : 'pending'); ?>">
                                <?= $bukti['status_verifikasi']; ?>
                            </span>
                        </div>
                        <div class="card-body-custom">
                            <div class="row">
                                <div class="col-md-3"><strong>Bank:</strong> <?= $bukti['nama_bank']; ?></div>
                                <div class="col-md-3"><strong>Pengirim:</strong> <?= $bukti['nama_pengirim']; ?></div>
                                <div class="col-md-3"><strong>Tanggal:</strong> <?= date('d/m/Y', strtotime($bukti['tanggal_transfer'])); ?></div>
                                <div class="col-md-3"><strong>Jumlah:</strong> Rp <?= number_format($bukti['jumlah_transfer'], 0, ',', '.'); ?></div>
                            </div>
                            <div class="mt-3">
                                <a href="<?= base_url('uploads/bukti/' . $bukti['file_bukti']); ?>" target="_blank" class="btn-outline-amber">
                                    <i class="bi bi-eye"></i> Lihat Bukti
                                </a>
                            </div>
                            <?php if ($transaksi['status_bayar'] == 'Pending' && $bukti['status_verifikasi'] == 'Pending'): ?>
                                <div class="mt-3 pt-3 border-top" style="border-color: rgba(74,44,17,0.06);">
                                    <form action="<?= base_url('admin/transaksi/konfirmasi_bayar'); ?>" method="POST">
                                        <input type="hidden" name="id_transaksi" value="<?= $transaksi['id_transaksi']; ?>">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <select name="status" class="form-control" style="border-radius:10px; border:1px solid rgba(74,44,17,0.12); padding:10px 14px;" required>
                                                    <option value="">Pilih Verifikasi</option>
                                                    <option value="Diverifikasi">✅ Verifikasi - Terima</option>
                                                    <option value="Ditolak">❌ Tolak</option>
                                                </select>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" name="keterangan" class="form-control" placeholder="Keterangan (opsional)" style="border-radius:10px; border:1px solid rgba(74,44,17,0.12); padding:10px 14px;">
                                            </div>
                                            <div class="col-md-2">
                                                <button type="submit" class="btn-amber btn-block">Proses</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebarMenu');
        const overlay = document.getElementById('sidebarOverlay');
        const toggleBtn = document.getElementById('sidebarToggle');

        function toggleSidebar() {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
            document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
        }

        if (toggleBtn) toggleBtn.addEventListener('click', toggleSidebar);
        if (overlay) overlay.addEventListener('click', toggleSidebar);

        const notifToggle = document.getElementById('notifToggle');
        const notifDropdown = document.getElementById('notifDropdown');

        if (notifToggle) {
            notifToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                notifDropdown.classList.toggle('show');
            });
        }

        document.addEventListener('click', function(e) {
            if (notifDropdown && !notifDropdown.contains(e.target) && !notifToggle.contains(e.target)) {
                notifDropdown.classList.remove('show');
            }
        });

        function markAllRead() {
            document.querySelectorAll('.notif-item.unread').forEach(item => item.classList.remove('unread'));
            document.getElementById('notifCount').textContent = '0';
            document.getElementById('notifCount').style.display = 'none';
        }

        document.getElementById('markAllRead')?.addEventListener('click', function(e) {
            e.preventDefault();
            markAllRead();
        });

        console.log('✅ Halaman Detail Transaksi siap digunakan!');
    </script>
</body>
</html>