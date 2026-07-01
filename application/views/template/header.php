<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Sistem Supply Chain Kopi' ?></title>

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Leaflet JS (untuk map) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Chart.js (untuk grafik) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <style>
        :root {
            --roasted-brown: #4A2C11;
            --dark-coffee: #2C1808;
            --amber-cream: #E6A15C;
            --bg-cream: #FAF6F0;
            --card-white: #FFFFFF;
            --text-secondary: #70655E;
            --sidebar-width: 260px;
            --shadow-soft: 0 8px 30px rgba(44, 24, 8, 0.08);
            --shadow-hover: 0 12px 40px rgba(44, 24, 8, 0.15);
            --radius-card: 14px;
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-cream);
            color: var(--dark-coffee);
            overflow-x: hidden;
        }

        /* ============================================
           SIDEBAR
           ============================================ */
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

        .menu-item.active a,
        .menu-item a:hover {
            color: #ffffff;
            background: rgba(230, 161, 92, 0.12);
        }

        .menu-item.active a {
            background: rgba(230, 161, 92, 0.18);
            border-left: 3px solid var(--amber-cream);
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
        }

        /* ============================================
           MAIN CONTENT
           ============================================ */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 30px 40px 40px;
            min-height: 100vh;
            transition: var(--transition-smooth);
        }

        .page-header {
            border-bottom: 1px solid rgba(74, 44, 17, 0.08);
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .page-header h2 {
            font-weight: 700;
            color: var(--dark-coffee);
            letter-spacing: -0.02em;
        }

        .page-header .subtitle {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-top: 2px;
        }

        /* ============================================
           NOTIFICATION BELL
           ============================================ */
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

        .notif-btn:hover {
            background: var(--bg-cream);
            box-shadow: var(--shadow-soft);
        }

        .notif-btn .notif-dot {
            position: absolute;
            top: -4px;
            right: -4px;
            width: 18px;
            height: 18px;
            background: #EF4444;
            border-radius: 50%;
            font-size: 0.6rem;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            border: 2px solid white;
        }

        /* ============================================
           NOTIFICATION DROPDOWN
           ============================================ */
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

        .notif-dropdown.show {
            display: block;
            animation: slideDown 0.25s ease;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .notif-dropdown-header {
            padding: 14px 18px;
            border-bottom: 1px solid rgba(74, 44, 17, 0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
        }

        .notif-dropdown-header a {
            font-size: 0.75rem;
            color: var(--amber-cream);
            font-weight: 500;
            text-decoration: none;
        }

        .notif-dropdown-list {
            max-height: 300px;
            overflow-y: auto;
        }

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

        .notif-item:hover {
            background: var(--bg-cream);
            text-decoration: none;
            color: inherit;
        }

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
        .notif-item .notif-icon.primary { background: #EDE9FE; color: #5B21B6; }

        .notif-item .notif-text {
            flex: 1;
            font-size: 0.85rem;
        }

        .notif-item .notif-text .notif-time {
            font-size: 0.7rem;
            color: var(--text-secondary);
            display: block;
            margin-top: 2px;
        }

        .notif-item.unread {
            background: rgba(230, 161, 92, 0.05);
        }

        .notif-item.unread .notif-text {
            font-weight: 600;
        }

        .notif-badge-new {
            background: var(--amber-cream);
            color: white;
            font-size: 0.55rem;
            padding: 2px 8px;
            border-radius: 10px;
            align-self: center;
        }

        /* ============================================
           STATUS BADGE (konsisten dengan dashboard)
           ============================================ */
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .status-badge.pending { background: #FEF3C7; color: #92400E; }
        .status-badge.processing { background: #DBEAFE; color: #1E40AF; }
        .status-badge.delivery { background: #EDE9FE; color: #5B21B6; }
        .status-badge.complete { background: #D1FAE5; color: #065F46; }
        .status-badge.cancelled { background: #FEE2E2; color: #991B1B; }

        /* ============================================
           RESPONSIVE
           ============================================ */
        @media (max-width: 991.98px) {
            .sidebar {
                left: calc(-1 * var(--sidebar-width));
                box-shadow: none;
            }
            .sidebar.open {
                left: 0;
                box-shadow: 0 0 40px rgba(0, 0, 0, 0.3);
            }
            .main-content {
                margin-left: 0;
                padding: 20px 16px 30px;
            }
            .page-header h2 { font-size: 1.3rem; }
            .notif-dropdown {
                width: calc(100vw - 32px);
                right: -60px;
            }
        }

        @media (max-width: 575.98px) {
            .main-content { padding: 16px 12px 20px; }
            .notif-dropdown {
                width: calc(100vw - 24px);
                right: -70px;
            }
        }

        /* ============================================
           SIDEBAR OVERLAY
           ============================================ */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 99;
        }

        .sidebar-overlay.active { display: block; }

        @media (max-width: 991.98px) {
            .sidebar-overlay.active { display: block; }
        }

        /* ============================================
           SCROLLBAR
           ============================================ */
        .sidebar-menu-wrapper::-webkit-scrollbar,
        .notif-dropdown-list::-webkit-scrollbar {
            width: 3px;
        }

        .sidebar-menu-wrapper::-webkit-scrollbar-track,
        .notif-dropdown-list::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-menu-wrapper::-webkit-scrollbar-thumb,
        .notif-dropdown-list::-webkit-scrollbar-thumb {
            background: rgba(230, 161, 92, 0.3);
            border-radius: 10px;
        }
    </style>
</head>
<body>

<!-- SIDEBAR OVERLAY -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- ============================================
     SIDEBAR - DINAMIS BERDASARKAN ROLE
     ============================================ -->
<?php
$role = $this->session->userdata('role');
$nama_user = $this->session->userdata('nama') ?? 'User';
$base_url = base_url();
?>

<div class="sidebar" id="sidebarMenu">
    <div class="sidebar-brand">
        <div class="brand-icon">
            <?php if ($role == 'Admin'): ?>
                <i class="bi bi-patch-check-fill"></i>
            <?php elseif ($role == 'Petani'): ?>
                <i class="bi bi-patch-check-fill"></i>
            <?php else: ?>
                <i class="bi bi-cup-hot-fill"></i>
            <?php endif; ?>
        </div>
        <span>
            <?php if ($role == 'Admin'): ?>
                ADMIN <br><small style="font-weight:400; font-size:0.7rem; color:#A8988A;">Liberchain</small>
            <?php elseif ($role == 'Petani'): ?>
                PETANI <br><small style="font-weight:400; font-size:0.7rem; color:#A8988A;">Liberchain</small>
            <?php else: ?>
                MEMBER <br><small style="font-weight:400; font-size:0.7rem; color:#A8988A;">Liberchain</small>
            <?php endif; ?>
        </span>
    </div>

    <div class="sidebar-menu-wrapper">
        <ul class="sidebar-menu">

            <?php if ($role == 'Admin'): ?>
                <!-- ====== MENU ADMIN ====== -->
                <li class="menu-item <?= current_url() == base_url('admin/dashboard') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/dashboard'); ?>"><i class="bi bi-grid-1x2-fill"></i>Dashboard</a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'admin/user') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/user'); ?>"><i class="bi bi-people-fill"></i>Manajemen User <span class="menu-badge">12</span></a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'admin/petani') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/petani'); ?>"><i class="bi bi-person-badge-fill"></i>Data Petani</a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'admin/lahan') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/lahan'); ?>"><i class="bi bi-map-fill"></i>Manajemen Lahan</a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'admin/panen') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/panen'); ?>"><i class="bi bi-tree-fill"></i>Manajemen Panen</a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'admin/produk') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/produk'); ?>"><i class="bi bi-box-seam-fill"></i>Manajemen Produk</a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'admin/transaksi') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/transaksi'); ?>"><i class="bi bi-wallet2"></i>Transaksi <span class="menu-badge">8</span></a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'admin/kurir') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/kurir'); ?>"><i class="bi bi-truck"></i>Manajemen Kurir</a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'admin/mitra') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/mitra'); ?>"><i class="bi bi-shop"></i>Manajemen Mitra</a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'admin/laporan') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/laporan'); ?>"><i class="bi bi-file-earmark-bar-graph-fill"></i>Laporan & Analytics</a>
                </li>

            <?php elseif ($role == 'Petani'): ?>
                <!-- ====== MENU PETANI ====== -->
                <li class="menu-item <?= current_url() == base_url('petani/dashboard') ? 'active' : '' ?>">
                    <a href="<?= base_url('petani/dashboard'); ?>"><i class="bi bi-grid-1x2-fill"></i>Dashboard</a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'petani/lahan') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('petani/lahan'); ?>"><i class="bi bi-geo-alt-fill"></i>Kelola Lahan <span class="menu-badge">3</span></a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'petani/panen') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('petani/panen'); ?>"><i class="bi bi-tree-fill"></i>Manajemen Panen</a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'petani/produk') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('petani/produk'); ?>"><i class="bi bi-box-seam"></i>Katalog Produk <span class="menu-badge">5</span></a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'petani/transaksi') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('petani/transaksi'); ?>"><i class="bi bi-cart-check-fill"></i>Pesanan Masuk <span class="menu-badge">8</span></a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'petani/tracking') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('petani/tracking'); ?>"><i class="bi bi-truck"></i>Tracking Kiriman</a>
                </li>

            <?php elseif ($role == 'Kurir'): ?>
                <!-- ====== MENU KURIR ====== -->
                <li class="menu-item <?= strpos(current_url(), 'kurir/tracking') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('kurir/tracking'); ?>"><i class="bi bi-truck"></i>Dashboard Kurir</a>
                </li>

            <?php else: ?>
                <!-- ====== MENU PEMBELI ====== -->
                <li class="menu-item <?= current_url() == base_url('pembeli/dashboard') ? 'active' : '' ?>">
                    <a href="<?= base_url('pembeli/dashboard'); ?>"><i class="bi bi-house-door-fill"></i>Beranda Akun</a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'landing/produk') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('landing/produk'); ?>"><i class="bi bi-shop-window"></i>Katalog Belanja</a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'pembeli/transaksi') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('pembeli/transaksi'); ?>"><i class="bi bi-receipt"></i>Riwayat Transaksi <span class="menu-badge">8</span></a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'pembeli/tracking') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('pembeli/tracking'); ?>"><i class="bi bi-geo-alt-fill"></i>Lacak Pengiriman <span class="menu-badge">2</span></a>
                </li>
    
                <li class="menu-item <?= strpos(current_url(), 'pembeli/profil') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('pembeli/profil'); ?>"><i class="bi bi-person-fill"></i>Profil Saya</a>
                </li>
            <?php endif; ?>

        </ul>
    </div>

    <div class="sidebar-footer">
        <button class="btn-logout" onclick="window.location.href='<?= base_url('auth/logout'); ?>'">
            <i class="bi bi-box-arrow-right"></i> Keluar
        </button>
    </div>
</div>

<!-- ============================================
     MAIN CONTENT WRAPPER
     ============================================ -->
<div class="main-content">

    <!-- ============================================
         PAGE HEADER
         ============================================ -->
    <div class="page-header d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle" style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
                <i class="bi bi-list"></i>
            </button>
            <h2 class="d-inline-block align-middle mb-0"><?= $title ?? 'Dashboard' ?></h2>
            <p class="subtitle mb-0 mt-1">
                Selamat datang, <span style="color: var(--amber-cream); font-weight:600;"><?= $nama_user ?></span>!
                <span id="currentDateTime" style="color: var(--text-secondary); font-size:0.85rem;"></span>
            </p>
        </div>

        <div class="d-flex align-items-center gap-3" style="gap: 12px;">
            <!-- ==========================================
                 NOTIFICATION BELL (SAMA DENGAN DASHBOARD)
                 ========================================== -->
            <div style="position: relative;">
                <button class="notif-btn" id="notifToggle">
                    <i class="bi bi-bell" style="font-size: 1.2rem;"></i>
                    <?php if (isset($unread_count) && $unread_count > 0): ?>
                        <span class="notif-dot" id="notifCount"><?= $unread_count ?></span>
                    <?php else: ?>
                        <span class="notif-dot" id="notifCount" style="display:none;">0</span>
                    <?php endif; ?>
                </button>

                <div class="notif-dropdown" id="notifDropdown">
                    <div class="notif-dropdown-header">
                        <span><?= isset($unread_count) && $unread_count > 0 ? $unread_count . ' Notifikasi Belum Dibaca' : 'Semua Notifikasi'; ?></span>
                        <a href="<?= base_url('notifikasi/history'); ?>">Lihat Semua</a>
                    </div>
                    <div class="notif-dropdown-list" id="notifList">
                        <?php if (!empty($notifikasi)): ?>
                            <?php foreach ($notifikasi as $n): ?>
                                <?php if (is_object($n)): ?>
                                    <a class="notif-item <?= (isset($n->status_baca) && $n->status_baca == 0) ? 'unread' : ''; ?>" 
                                       href="<?= base_url('notifikasi/read/'.$n->id_notifikasi); ?>">
                                        <?php
                                        $icon_type = $n->icon ?? 'info';
                                        $icon_map = [
                                            'success' => 'bi-check-circle-fill',
                                            'warning' => 'bi-exclamation-triangle-fill',
                                            'danger' => 'bi-x-circle-fill',
                                            'info' => 'bi-info-circle-fill',
                                            'primary' => 'bi-star-fill'
                                        ];
                                        $icon_class = $icon_map[$icon_type] ?? 'bi-info-circle-fill';
                                        ?>
                                        <div class="notif-icon <?= $icon_type; ?>">
                                            <i class="bi <?= $icon_class; ?>"></i>
                                        </div>
                                        <div class="notif-text">
                                            <?= htmlspecialchars($n->judul ?? 'Notifikasi'); ?><br>
                                            <small><?= htmlspecialchars($n->isi_notifikasi); ?></small>
                                            <span class="notif-time"><?= date('d M Y, H:i', strtotime($n->tanggal_buat)); ?></span>
                                        </div>
                                        <?php if (isset($n->status_baca) && $n->status_baca == 0): ?>
                                            <span class="notif-badge-new">Baru</span>
                                        <?php endif; ?>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center text-muted py-5 px-3">
                                <i class="bi bi-bell-slash d-block mb-2" style="font-size:2rem;"></i>
                                <p class="small mb-0">Tidak ada notifikasi</p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="p-2 text-center border-top" style="background:#FAF6F0; border-color:rgba(74,44,17,0.06);">
                        <a href="<?= base_url('notifikasi/setting'); ?>" class="small text-secondary font-weight-bold text-decoration-none">
                            <i class="bi bi-gear-fill mr-1"></i> Pengaturan Notifikasi
                        </a>
                    </div>
                </div>
            </div>

            <!-- USER AVATAR -->
            <div style="cursor: pointer; padding: 6px 12px; border-radius: 10px; background: var(--card-white); border: 1px solid rgba(74,44,17,0.06);">
                <i class="bi bi-person-circle" style="font-size: 1.5rem; color: var(--amber-cream);"></i>
                <span style="font-weight:500; font-size:0.85rem;"><?= $nama_user ?></span>
            </div>
        </div>
    </div>
    <!-- END PAGE HEADER -->
