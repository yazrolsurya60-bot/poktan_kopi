<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - LiberChain</title>
    <!-- Bootstrap 5 - sesuai yang dipakai di Petani views -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            margin: 0;
        }

        /* ─── SIDEBAR ─── */
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
            overflow: hidden;
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
            gap: 10px;
            flex-shrink: 0;
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

        .sidebar-menu-wrapper::-webkit-scrollbar { width: 3px; }
        .sidebar-menu-wrapper::-webkit-scrollbar-thumb { background: rgba(230,161,92,0.3); border-radius: 10px; }

        .sidebar-menu {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .sidebar-heading {
            color: #735a47;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 16px 24px 6px 24px;
        }

        .menu-item a {
            display: flex;
            align-items: center;
            padding: 11px 24px;
            color: #A8988A;
            font-weight: 500;
            font-size: 0.88rem;
            text-decoration: none;
            transition: var(--transition-smooth);
            position: relative;
            margin: 2px 10px;
            border-radius: 10px;
        }

        .menu-item a i {
            font-size: 1.1rem;
            margin-right: 13px;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }

        .menu-item a .menu-badge {
            margin-left: auto;
            background: rgba(230, 161, 92, 0.2);
            color: var(--amber-cream);
            font-size: 0.68rem;
            padding: 2px 9px;
            border-radius: 20px;
            font-weight: 600;
        }

        .menu-item a:hover {
            color: #ffffff;
            background: rgba(230, 161, 92, 0.12);
            text-decoration: none;
        }

        .menu-item.active > a {
            color: #ffffff;
            background: rgba(230, 161, 92, 0.18);
        }

        .menu-item.active > a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 22px;
            background: var(--amber-cream);
            border-radius: 0 3px 3px 0;
        }

        .sidebar-footer {
            padding: 14px 18px;
            border-top: 1px solid rgba(250, 246, 240, 0.06);
            flex-shrink: 0;
        }

        .btn-logout {
            width: 100%;
            padding: 10px 16px;
            border: 1px solid rgba(250, 246, 240, 0.1);
            border-radius: 10px;
            background: transparent;
            color: #A8988A;
            font-weight: 500;
            font-size: 0.85rem;
            font-family: inherit;
            transition: var(--transition-smooth);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-logout:hover {
            background: rgba(230, 161, 92, 0.1);
            color: #ffffff;
            border-color: rgba(230, 161, 92, 0.2);
            text-decoration: none;
        }

        /* ─── MAIN CONTENT ─── */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: var(--transition-smooth);
        }

        /* ─── TOPBAR ─── */
        .topbar {
            background: #ffffff;
            padding: 14px 32px;
            border-bottom: 1px solid rgba(74, 44, 17, 0.07);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 2px 12px rgba(44, 24, 8, 0.05);
        }

        .topbar-left { display: flex; align-items: center; gap: 12px; }

        #sidebarToggle {
            display: none;
            border: none;
            background: none;
            font-size: 1.4rem;
            color: var(--dark-coffee);
            cursor: pointer;
            padding: 4px;
            border-radius: 8px;
        }

        .topbar-title { font-size: 1.15rem; font-weight: 700; color: var(--dark-coffee); }
        .topbar-subtitle { font-size: 0.78rem; color: var(--text-secondary); }

        .topbar-right { display: flex; align-items: center; gap: 12px; }

        .topbar-avatar {
            width: 36px;
            height: 36px;
            background: var(--roasted-brown);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 0.85rem;
            font-weight: 700;
        }

        .topbar-user-name { font-size: 0.85rem; font-weight: 600; color: var(--dark-coffee); }
        .topbar-user-role { font-size: 0.72rem; color: var(--text-secondary); }

        /* ─── OVERLAY ─── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 99;
        }

        .sidebar-overlay.active { display: block; }

        /* ─── PAGE BODY ─── */
        .page-body {
            padding: 28px 32px 40px;
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 991.98px) {
            .sidebar {
                left: calc(-1 * var(--sidebar-width));
                box-shadow: none;
            }
            .sidebar.open {
                left: 0;
                box-shadow: 0 0 40px rgba(0, 0, 0, 0.3);
            }
            .main-content { margin-left: 0; }
            #sidebarToggle { display: block; }
            .page-body { padding: 20px 16px 30px; }
            .topbar { padding: 12px 16px; }
        }
    </style>
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebarMenu">
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="bi bi-patch-check-fill"></i></div>
        <span>ADMIN<br><small style="font-weight:400;font-size:0.68rem;color:#A8988A;">LiberChain</small></span>
    </div>

    <div class="sidebar-menu-wrapper">
        <ul class="sidebar-menu">
            <li class="menu-item <?= ($this->uri->segment(2) == 'dashboard' || ($this->uri->segment(2) == '' && $this->uri->segment(1) == 'admin')) ? 'active' : ''; ?>">
                <a href="<?= base_url('admin/dashboard'); ?>"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
            </li>

            <li class="sidebar-heading">Manajemen Data</li>

            <li class="menu-item <?= ($this->uri->segment(2) == 'user' || $this->uri->segment(2) == 'users') ? 'active' : ''; ?>">
                <a href="<?= base_url('admin/user'); ?>"><i class="bi bi-people-fill"></i> Manajemen User</a>
            </li>
            <li class="menu-item <?= ($this->uri->segment(2) == 'petani') ? 'active' : ''; ?>">
                <a href="<?= base_url('admin/petani'); ?>"><i class="bi bi-person-badge-fill"></i> Manajemen Petani</a>
            </li>
            <li class="menu-item <?= ($this->uri->segment(2) == 'lahan') ? 'active' : ''; ?>">
                <a href="<?= base_url('admin/lahan'); ?>"><i class="bi bi-map-fill"></i> Manajemen Lahan</a>
            </li>
            <li class="menu-item <?= ($this->uri->segment(2) == 'panen') ? 'active' : ''; ?>">
                <a href="<?= base_url('admin/panen'); ?>"><i class="bi bi-tree-fill"></i> Manajemen Panen</a>
            </li>

            <li class="sidebar-heading">Produk & Transaksi</li>

            <li class="menu-item <?= ($this->uri->segment(2) == 'produk') ? 'active' : ''; ?>">
                <a href="<?= base_url('admin/produk'); ?>"><i class="bi bi-box-seam-fill"></i> Manajemen Produk</a>
            </li>
            <li class="menu-item <?= ($this->uri->segment(2) == 'transaksi') ? 'active' : ''; ?>">
                <a href="<?= base_url('admin/transaksi'); ?>"><i class="bi bi-wallet2"></i> Transaksi</a>
            </li>
            <li class="menu-item <?= ($this->uri->segment(2) == 'kurir') ? 'active' : ''; ?>">
                <a href="<?= base_url('admin/kurir'); ?>"><i class="bi bi-truck"></i> Manajemen Kurir</a>
            </li>
            <li class="menu-item <?= ($this->uri->segment(2) == 'mitra') ? 'active' : ''; ?>">
                <a href="<?= base_url('admin/mitra'); ?>"><i class="bi bi-shop"></i> Manajemen Mitra</a>
            </li>

            <li class="sidebar-heading">Laporan</li>

            <li class="menu-item <?= ($this->uri->segment(2) == 'laporan') ? 'active' : ''; ?>">
                <a href="<?= base_url('admin/laporan'); ?>"><i class="bi bi-file-earmark-bar-graph-fill"></i> Laporan & Analytics</a>
            </li>
        </ul>
    </div>

    <div class="sidebar-footer">
        <a href="<?= base_url('auth/logout'); ?>" class="btn-logout">
            <i class="bi bi-box-arrow-right"></i> Keluar
        </a>
    </div>
</div>

<!-- MAIN CONTENT -->
<div class="main-content">
    <!-- TOPBAR -->
    <div class="topbar">
        <div class="topbar-left">
            <button id="sidebarToggle"><i class="bi bi-list"></i></button>
            <div>
                <div class="topbar-title">Admin Panel</div>
                <div class="topbar-subtitle">LiberChain System</div>
            </div>
        </div>
        <div class="topbar-right">
            <div class="d-flex align-items-center gap-2">
                <div class="topbar-avatar">A</div>
                <div>
                    <div class="topbar-user-name"><?= $this->session->userdata('nama') ?? 'Admin'; ?></div>
                    <div class="topbar-user-role">Administrator</div>
                </div>
            </div>
        </div>
    </div>

    <!-- PAGE BODY START -->
    <div class="page-body">
