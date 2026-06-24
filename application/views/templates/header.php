<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Sistem Supply Chain Kopi' ?></title>

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
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

    * {
        box-sizing: border-box;
    }

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

    .status-badge.pending {
        background: #FEF3C7;
        color: #92400E;
    }

    .status-badge.processing {
        background: #DBEAFE;
        color: #1E40AF;
    }

    .status-badge.delivery {
        background: #EDE9FE;
        color: #5B21B6;
    }

    .status-badge.complete {
        background: #D1FAE5;
        color: #065F46;
    }

    .status-badge.cancelled {
        background: #FEE2E2;
        color: #991B1B;
    }

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

        .page-header h2 {
            font-size: 1.3rem;
        }
    }

    @media (max-width: 575.98px) {
        .main-content {
            padding: 16px 12px 20px;
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

    .sidebar-overlay.active {
        display: block;
    }

    @media (max-width: 991.98px) {
        .sidebar-overlay.active {
            display: block;
        }
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
                MEMBER <br><small style="font-weight:400; font-size:0.7rem; color:#A8988A;">Kafi</small>
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
                    <a href="<?= base_url('admin/user'); ?>"><i class="bi bi-people-fill"></i>Manajemen User <span
                            class="menu-badge">12</span></a>
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
                    <a href="<?= base_url('admin/transaksi'); ?>"><i class="bi bi-wallet2"></i>Transaksi <span
                            class="menu-badge">8</span></a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'admin/kurir') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/kurir'); ?>"><i class="bi bi-truck"></i>Manajemen Kurir</a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'admin/mitra') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/mitra'); ?>"><i class="bi bi-shop"></i>Manajemen Mitra</a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'admin/laporan') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/laporan'); ?>"><i class="bi bi-file-earmark-bar-graph-fill"></i>Laporan
                        & Analytics</a>
                </li>

                <?php elseif ($role == 'Petani'): ?>
                <!-- ====== MENU PETANI ====== -->
                <li class="menu-item <?= current_url() == base_url('petani/dashboard') ? 'active' : '' ?>">
                    <a href="<?= base_url('petani/dashboard'); ?>"><i class="bi bi-grid-1x2-fill"></i>Dashboard</a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'petani/lahan') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('petani/lahan'); ?>"><i class="bi bi-geo-alt-fill"></i>Kelola Lahan <span
                            class="menu-badge">3</span></a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'petani/panen') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('petani/panen'); ?>"><i class="bi bi-textarea-rose"></i>Manajemen Panen</a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'petani/produk') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('petani/produk'); ?>"><i class="bi bi-box-seam"></i>Katalog Produk <span
                            class="menu-badge">5</span></a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'petani/transaksi') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('petani/transaksi'); ?>"><i class="bi bi-cart-check-fill"></i>Pesanan Masuk
                        <span class="menu-badge">8</span></a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'petani/tracking') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('petani/tracking'); ?>"><i class="bi bi-truck"></i>Tracking Kiriman</a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'petani/laporan') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('petani/laporan'); ?>"><i
                            class="bi bi-file-earmark-bar-graph-fill"></i>Laporan</a>
                </li>

                <?php else: ?>
                <!-- ====== MENU PEMBELI ====== -->
                <li class="menu-item <?= current_url() == base_url('pembeli/dashboard') ? 'active' : '' ?>">
                    <a href="<?= base_url('pembeli/dashboard'); ?>"><i class="bi bi-house-door-fill"></i>Beranda
                        Akun</a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'landing/produk') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('landing/produk'); ?>"><i class="bi bi-shop-window"></i>Katalog Belanja</a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'pembeli/transaksi') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('pembeli/transaksi'); ?>"><i class="bi bi-receipt"></i>Riwayat Transaksi <span
                            class="menu-badge">8</span></a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'pembeli/tracking') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('pembeli/tracking'); ?>"><i class="bi bi-geo-alt-fill"></i>Lacak Pengiriman
                        <span class="menu-badge">2</span></a>
                </li>
                <li class="menu-item <?= strpos(current_url(), 'pembeli/poin') !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('pembeli/poin'); ?>"><i class="bi bi-gift-fill"></i>Tukar Poin Hadiah</a>
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
                <button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle"
                    style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
                    <i class="bi bi-list"></i>
                </button>
                <h2 class="d-inline-block align-middle mb-0"><?= $title ?? 'Dashboard' ?></h2>
                <p class="subtitle mb-0 mt-1">
                    Selamat datang, <span
                        style="color: var(--amber-cream); font-weight:600;"><?= $this->session->userdata('nama') ?? 'User' ?></span>!
                    <span id="currentDateTime" style="color: var(--text-secondary); font-size:0.85rem;"></span>
                </p>
            </div>

            <div class="d-flex align-items-center gap-3" style="gap: 12px;">
                <!-- ==========================================
             NOTIFICATION BELL & DROPDOWN
             ========================================== -->
                <?php if (!empty($notifikasi) || isset($notifikasi)): ?>
                <?php $this->load->view('template/v_notification'); ?>
                <?php else: ?>
                <!-- Fallback jika tidak ada data notifikasi -->
                <div style="position: relative;">
                    <button class="notif-btn" id="notifToggle"
                        style="background: var(--card-white); border: 1px solid rgba(74,44,17,0.06); border-radius: 12px; padding: 8px 14px; color: var(--dark-coffee); cursor: pointer; display: flex; align-items: center; gap: 8px;">
                        <i class="bi bi-bell" style="font-size: 1.2rem;"></i>
                        <span class="notif-dot" id="notifCount" style="display:none;">0</span>
                    </button>
                </div>
                <?php endif; ?>

                <!-- USER AVATAR -->
                <div
                    style="cursor: pointer; padding: 6px 12px; border-radius: 10px; background: var(--card-white); border: 1px solid rgba(74,44,17,0.06);">
                    <i class="bi bi-person-circle" style="font-size: 1.5rem; color: var(--amber-cream);"></i>
                    <span
                        style="font-weight:500; font-size:0.85rem;"><?= $this->session->userdata('nama') ?? 'User' ?></span>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->