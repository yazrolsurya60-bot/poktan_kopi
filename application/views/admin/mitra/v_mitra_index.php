<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Mitra - LiberChain</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --roasted-brown: #4A2C11;
            --dark-coffee:   #2C1808;
            --amber-cream:   #E6A15C;
            --forest-green:  #2D6A4F;
            --bg-cream:      #FAF6F0;
            --card-white:    #FFFFFF;
            --text-secondary:#70655E;
            --sidebar-width: 260px;
            --shadow-soft:   0 8px 30px rgba(44,24,8,0.08);
            --shadow-hover:  0 12px 40px rgba(44,24,8,0.15);
            --radius-card:   14px;
            --transition-smooth: all 0.3s cubic-bezier(0.4,0,0.2,1);
        }
        * { box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-cream); color: var(--dark-coffee); overflow-x: hidden; }

        /* ===== SIDEBAR ===== */
        .sidebar { width: var(--sidebar-width); height: 100vh; position: fixed; top: 0; left: 0; background: linear-gradient(180deg, var(--dark-coffee) 0%, #1a0e04 100%); color: var(--bg-cream); z-index: 100; transition: var(--transition-smooth); box-shadow: 4px 0 25px rgba(44,24,8,0.2); display: flex; flex-direction: column; }
        .sidebar-brand { padding: 28px 24px 20px; font-size: 1.1rem; font-weight: 700; letter-spacing: 0.5px; border-bottom: 1px solid rgba(250,246,240,0.08); color: var(--amber-cream); display: flex; align-items: center; gap: 10px; }
        .sidebar-brand .brand-icon { width: 40px; height: 40px; background: rgba(230,161,92,0.15); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; }
        .sidebar-menu-wrapper { flex: 1; overflow-y: auto; padding: 15px 0; }
        .sidebar-menu { list-style: none; margin: 0; padding: 0; }
        .menu-item a { display: flex; align-items: center; padding: 12px 24px; color: #A8988A; font-weight: 500; font-size: 0.9rem; transition: var(--transition-smooth); text-decoration: none; position: relative; margin: 2px 10px; border-radius: 10px; }
        .menu-item a i { font-size: 1.15rem; margin-right: 14px; width: 22px; text-align: center; }
        .menu-item a:hover { color: #fff; background: rgba(230,161,92,0.12); }
        .menu-item.active a { background: rgba(230,161,92,0.18); border-left: 3px solid var(--amber-cream); color: #fff; }
        .sidebar-footer { padding: 16px 20px; border-top: 1px solid rgba(250,246,240,0.06); margin-top: auto; }
        .btn-logout { width: 100%; padding: 10px 16px; border: 1px solid rgba(250,246,240,0.1); border-radius: 10px; background: transparent; color: #A8988A; font-weight: 500; font-size: 0.85rem; transition: var(--transition-smooth); display: flex; align-items: center; justify-content: center; gap: 10px; cursor: pointer; }
        .btn-logout:hover { background: rgba(230,161,92,0.1); color: #fff; border-color: rgba(230,161,92,0.2); }

        /* ===== MAIN ===== */
        .main-content { margin-left: var(--sidebar-width); padding: 30px 40px 50px; min-height: 100vh; transition: var(--transition-smooth); }

        /* ===== PAGE HEADER ===== */
        .page-header { border-bottom: 1px solid rgba(74,44,17,0.08); padding-bottom: 20px; margin-bottom: 28px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; }
        .page-header h2 { font-weight: 700; color: var(--dark-coffee); letter-spacing: -0.02em; }
        .page-header .subtitle { color: var(--text-secondary); font-size: 0.875rem; margin-top: 2px; }

        /* ===== NOTIF BELL ===== */
        .notif-btn { position: relative; background: var(--card-white); border: 1px solid rgba(74,44,17,0.06); border-radius: 12px; padding: 8px 14px; color: var(--dark-coffee); transition: var(--transition-smooth); cursor: pointer; display: flex; align-items: center; gap: 8px; }
        .notif-btn:hover { background: var(--bg-cream); box-shadow: var(--shadow-soft); }
        .notif-btn .notif-dot { position: absolute; top: -4px; right: -4px; width: 18px; height: 18px; background: #EF4444; border-radius: 50%; font-size: 0.6rem; color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; border: 2px solid white; }
        .notif-dropdown { position: absolute; right: 0; top: calc(100% + 10px); width: 360px; max-height: 400px; background: var(--card-white); border-radius: var(--radius-card); box-shadow: var(--shadow-hover); border: 1px solid rgba(74,44,17,0.06); overflow: hidden; display: none; z-index: 200; }
        .notif-dropdown.show { display: block; animation: slideDown 0.25s ease; }
        @keyframes slideDown { from { opacity:0; transform:translateY(-10px); } to { opacity:1; transform:translateY(0); } }
        .notif-dropdown-header { padding: 14px 18px; border-bottom: 1px solid rgba(74,44,17,0.06); display: flex; justify-content: space-between; align-items: center; font-weight: 600; font-size: 0.85rem; }
        .notif-dropdown-header a { font-size: 0.75rem; color: var(--amber-cream); font-weight: 500; text-decoration: none; }
        .notif-dropdown-list { max-height: 280px; overflow-y: auto; }
        .notif-item { padding: 12px 18px; border-bottom: 1px solid rgba(74,44,17,0.04); display: flex; align-items: flex-start; gap: 12px; transition: var(--transition-smooth); cursor: pointer; text-decoration: none; color: inherit; }
        .notif-item:hover { background: var(--bg-cream); text-decoration: none; color: inherit; }
        .notif-item.unread { background: rgba(230,161,92,0.05); }
        .notif-item.unread .notif-text { font-weight: 600; }
        .notif-icon { width: 34px; height: 34px; min-width: 34px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; }
        .notif-icon.success { background: #D1FAE5; color: #065F46; }
        .notif-icon.warning { background: #FEF3C7; color: #92400E; }
        .notif-icon.info    { background: #DBEAFE; color: #1E40AF; }
        .notif-icon.danger  { background: #FEE2E2; color: #991B1B; }
        .notif-text { flex: 1; font-size: 0.82rem; }
        .notif-time { font-size: 0.7rem; color: var(--text-secondary); display: block; margin-top: 2px; }
        .notif-badge-new { background: var(--amber-cream); color: white; font-size: 0.55rem; padding: 2px 7px; border-radius: 10px; align-self: center; }
        .user-badge { display: flex; align-items: center; gap: 8px; padding: 6px 12px; border-radius: 10px; background: var(--card-white); border: 1px solid rgba(74,44,17,0.06); font-weight: 500; font-size: 0.85rem; cursor: default; }
        .role-pill { font-size: 0.65rem; font-weight: 700; padding: 2px 8px; border-radius: 10px; background: rgba(230,161,92,0.15); color: var(--amber-cream); text-transform: uppercase; letter-spacing: 0.5px; }

        /* ===== STAT CARDS ===== */
        .stat-card { background: var(--card-white); border-radius: var(--radius-card); box-shadow: var(--shadow-soft); border: 1px solid rgba(74,44,17,0.06); padding: 20px 22px; display: flex; align-items: center; gap: 16px; transition: var(--transition-smooth); height: 100%; }
        .stat-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-hover); }
        .stat-icon { width: 50px; height: 50px; border-radius: 13px; display: flex; align-items: center; justify-content: center; font-size: 1.35rem; flex-shrink: 0; }
        .stat-icon.brown  { background: rgba(74,44,17,0.08);   color: var(--roasted-brown); }
        .stat-icon.green  { background: rgba(45,106,79,0.1);   color: var(--forest-green); }
        .stat-icon.red    { background: rgba(239,68,68,0.09);  color: #dc2626; }
        .stat-icon.amber  { background: rgba(230,161,92,0.15); color: #c47b2a; }
        .stat-value { font-size: 1.65rem; font-weight: 800; color: var(--dark-coffee); line-height: 1; margin-bottom: 3px; }
        .stat-label { font-size: 0.72rem; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.5px; }

        /* ===== TABLE CARD ===== */
        .table-card { background: var(--card-white); border-radius: var(--radius-card); box-shadow: var(--shadow-soft); border: 1px solid rgba(74,44,17,0.06); overflow: hidden; }
        .table-card-header { padding: 18px 22px; border-bottom: 1px solid rgba(74,44,17,0.06); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; }
        .table-title { font-size: 0.9rem; font-weight: 700; color: var(--dark-coffee); margin: 0; display: flex; align-items: center; gap: 8px; }
        .table-title i { color: var(--amber-cream); }

        /* filter */
        .filter-form { display: flex; align-items: center; flex-wrap: wrap; gap: 7px; }
        .filter-form input, .filter-form select { padding: 7px 11px; border: 1px solid rgba(74,44,17,0.15); border-radius: 9px; font-size: 0.8rem; color: var(--dark-coffee); background: var(--bg-cream); transition: var(--transition-smooth); height: auto; font-family: inherit; }
        .filter-form input:focus, .filter-form select:focus { border-color: var(--amber-cream); box-shadow: 0 0 0 3px rgba(230,161,92,0.15); outline: none; background: #fff; }
        .btn-filter { padding: 7px 15px; border: 1px solid rgba(74,44,17,0.15); border-radius: 9px; background: transparent; color: var(--text-secondary); font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: var(--transition-smooth); display: inline-flex; align-items: center; gap: 5px; font-family: inherit; }
        .btn-filter:hover { background: var(--bg-cream); color: var(--roasted-brown); border-color: var(--roasted-brown); }
        .btn-reset { padding: 7px 13px; border: 1px solid rgba(239,68,68,0.2); border-radius: 9px; background: rgba(239,68,68,0.05); color: #dc2626; font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: var(--transition-smooth); display: inline-flex; align-items: center; gap: 5px; text-decoration: none; font-family: inherit; }
        .btn-reset:hover { background: rgba(239,68,68,0.1); color: #dc2626; text-decoration: none; }

        /* table */
        .mitra-table { margin: 0; font-size: 0.85rem; }
        .mitra-table thead th { border: none; border-bottom: 2px solid rgba(74,44,17,0.07); color: var(--text-secondary); font-weight: 700; font-size: 0.68rem; text-transform: uppercase; letter-spacing: 0.8px; padding: 12px 16px; background: rgba(250,246,240,0.5); white-space: nowrap; }
        .mitra-table tbody td { vertical-align: middle; border-top: none; border-bottom: 1px solid rgba(74,44,17,0.04); padding: 13px 16px; font-weight: 500; color: var(--dark-coffee); }
        .mitra-table tbody tr { transition: var(--transition-smooth); }
        .mitra-table tbody tr:hover { background: rgba(230,161,92,0.04); }
        .mitra-table tbody tr:last-child td { border-bottom: none; }

        .logo-thumb { width: 46px; height: 46px; object-fit: contain; border-radius: 10px; border: 1px solid rgba(74,44,17,0.08); background: var(--bg-cream); padding: 3px; }
        .logo-placeholder { width: 46px; height: 46px; border-radius: 10px; border: 1px dashed rgba(74,44,17,0.2); background: var(--bg-cream); display: flex; align-items: center; justify-content: center; color: var(--text-secondary); font-size: 1.1rem; }
        .mitra-name { font-weight: 700; color: var(--dark-coffee); margin: 0; font-size: 0.875rem; }
        .mitra-meta { font-size: 0.7rem; color: var(--text-secondary); margin: 0; }
        .kontak-line { font-size: 0.78rem; color: var(--dark-coffee); margin: 0 0 3px; font-weight: 500; display: flex; align-items: center; gap: 6px; }
        .kontak-line:last-child { margin-bottom: 0; }
        .kontak-line i { color: var(--amber-cream); font-size: 0.75rem; width: 13px; }
        .kontak-line.muted { color: var(--text-secondary); font-weight: 400; }
        .kontak-empty { color: var(--text-secondary); font-size: 0.8rem; }
        .kategori-pill { display: inline-block; padding: 3px 10px; border-radius: 20px; background: rgba(74,44,17,0.07); color: var(--roasted-brown); font-size: 0.7rem; font-weight: 600; }

        .urutan-input { width: 64px; text-align: center; font-weight: 700; font-size: 0.875rem; color: var(--dark-coffee); background: rgba(250,246,240,0.7); border: 1px solid rgba(230,161,92,0.25); border-radius: 8px; padding: 5px 6px; height: auto; transition: var(--transition-smooth); }
        .urutan-input:focus { background: #fff; border-color: var(--amber-cream); box-shadow: 0 0 0 3px rgba(230,161,92,0.15); outline: none; }
        .urutan-saved { background: rgba(45,106,79,0.12) !important; border-color: rgba(45,106,79,0.35) !important; }

        .status-badge { display: inline-flex; align-items: center; gap: 5px; padding: 5px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: 700; letter-spacing: 0.3px; cursor: pointer; transition: var(--transition-smooth); border: 1px solid transparent; white-space: nowrap; }
        .status-badge.active   { background: rgba(45,106,79,0.1);  color: var(--forest-green); border-color: rgba(45,106,79,0.2); }
        .status-badge.inactive { background: rgba(239,68,68,0.09); color: #dc2626;              border-color: rgba(239,68,68,0.18); }
        .status-badge.active:hover   { background: rgba(45,106,79,0.18); }
        .status-badge.inactive:hover { background: rgba(239,68,68,0.15); }

        .btn-action-group { display: flex; gap: 6px; justify-content: flex-end; }
        .btn-icon { width: 34px; height: 34px; border-radius: 9px; display: flex; align-items: center; justify-content: center; transition: var(--transition-smooth); border: none; cursor: pointer; font-size: 0.9rem; text-decoration: none; }
        .btn-icon:hover { transform: translateY(-2px); text-decoration: none; }
        .btn-edit   { background: rgba(230,161,92,0.12); color: #c47b2a; }
        .btn-edit:hover   { background: var(--amber-cream); color: #fff; box-shadow: 0 4px 12px rgba(230,161,92,0.35); }
        .btn-delete { background: rgba(239,68,68,0.09); color: #dc2626; }
        .btn-delete:hover { background: #dc2626; color: #fff; box-shadow: 0 4px 12px rgba(239,68,68,0.3); }

        /* empty state */
        .empty-state { padding: 55px 20px; text-align: center; }
        .empty-icon { width: 72px; height: 72px; background: rgba(74,44,17,0.06); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 1.8rem; color: var(--text-secondary); }
        .empty-state h6 { font-weight: 700; color: var(--dark-coffee); margin-bottom: 5px; }
        .empty-state p  { color: var(--text-secondary); font-size: 0.85rem; margin: 0 0 16px; }

        /* flash */
        .flash-alert { border-radius: 12px; border: none; display: flex; align-items: center; gap: 12px; padding: 13px 17px; font-weight: 500; font-size: 0.875rem; margin-bottom: 22px; }
        .flash-success { background: rgba(45,106,79,0.1); color: var(--forest-green); border-left: 4px solid var(--forest-green); }
        .flash-danger  { background: rgba(239,68,68,0.09); color: #dc2626; border-left: 4px solid #dc2626; }
        .flash-alert i { font-size: 1.1rem; flex-shrink: 0; }

        /* add btn */
        .btn-add { background: var(--roasted-brown); color: #fff; border: none; border-radius: 11px; padding: 10px 20px; font-weight: 700; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 8px; transition: var(--transition-smooth); text-decoration: none; cursor: pointer; font-family: inherit; box-shadow: 0 4px 14px rgba(74,44,17,0.22); }
        .btn-add:hover { background: var(--dark-coffee); color: #fff; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(44,24,8,0.28); text-decoration: none; }

        /* table footer */
        .table-footer { padding: 12px 20px; border-top: 1px solid rgba(74,44,17,0.05); color: var(--text-secondary); font-size: 0.77rem; font-weight: 500; }

        /* ===== SCROLLBAR - SAMA DENGAN DASHBOARD ===== */
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
        
        /* ===== RESPONSIF - SAMA DENGAN DASHBOARD ===== */
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
            .sidebar {
                left: calc(-1 * var(--sidebar-width));
                box-shadow: none;
            }
            .sidebar.open {
                left: 0;
                box-shadow: 0 0 40px rgba(0, 0, 0, 0.3);
            }
            .sidebar-overlay.active {
                display: block;
            }
            .main-content {
                margin-left: 0;
                padding: 20px 16px 30px;
            }
            .page-header h2 {
                font-size: 1.3rem;
            }
            .notif-dropdown {
                width: calc(100vw - 32px);
                right: -60px;
            }
            .table-card-header {
                flex-direction: column;
                align-items: stretch;
            }
            .table-card-header .d-flex {
                flex-wrap: wrap;
                width: 100%;
            }
            .filter-form {
                width: 100%;
                flex-wrap: wrap;
            }
            .filter-form input,
            .filter-form select {
                flex: 1;
                min-width: 120px;
            }
            .btn-add {
                width: 100%;
                justify-content: center;
                margin-top: 8px;
            }
            .stat-card {
                padding: 16px 18px;
            }
            .stat-value {
                font-size: 1.3rem;
            }
            .stat-icon {
                width: 42px;
                height: 42px;
                font-size: 1.1rem;
            }
            .mitra-table thead th {
                font-size: 0.6rem;
                padding: 8px 10px;
            }
            .mitra-table tbody td {
                padding: 10px 10px;
                font-size: 0.78rem;
            }
            .btn-action-group {
                gap: 4px;
            }
            .btn-icon {
                width: 30px;
                height: 30px;
                font-size: 0.8rem;
            }
            .urutan-input {
                width: 50px;
                font-size: 0.75rem;
                padding: 4px 4px;
            }
            .logo-thumb,
            .logo-placeholder {
                width: 36px;
                height: 36px;
            }
        }

        @media (max-width: 575.98px) {
            .main-content {
                padding: 16px 12px 20px;
            }
            .stat-card {
                padding: 14px 14px;
                gap: 10px;
            }
            .stat-value {
                font-size: 1.1rem;
            }
            .stat-icon {
                width: 36px;
                height: 36px;
                font-size: 0.9rem;
            }
            .stat-label {
                font-size: 0.6rem;
            }
            .filter-form input,
            .filter-form select {
                min-width: 100%;
                flex: 1 1 100%;
            }
            .btn-filter,
            .btn-reset {
                flex: 1;
                justify-content: center;
            }
            .mitra-table thead th {
                font-size: 0.55rem;
                padding: 6px 6px;
                white-space: normal;
            }
            .mitra-table tbody td {
                padding: 8px 6px;
                font-size: 0.7rem;
            }
            .notif-dropdown {
                width: calc(100vw - 24px);
                right: -70px;
            }
            .table-title {
                font-size: 0.8rem;
            }
            .btn-add {
                font-size: 0.75rem;
                padding: 8px 14px;
            }
            .kontak-line {
                font-size: 0.7rem;
            }
            .mitra-name {
                font-size: 0.75rem;
            }
            .status-badge {
                font-size: 0.6rem;
                padding: 3px 8px;
            }
            .btn-icon {
                width: 26px;
                height: 26px;
                font-size: 0.7rem;
            }
            .urutan-input {
                width: 40px;
                font-size: 0.7rem;
                padding: 3px 3px;
            }
            .logo-thumb,
            .logo-placeholder {
                width: 30px;
                height: 30px;
            }
            .page-header .subtitle {
                font-size: 0.75rem;
            }
            .user-badge {
                padding: 4px 10px;
                font-size: 0.75rem;
            }
            .user-badge i {
                font-size: 1.1rem !important;
            }
        }

        /* ===== SIDEBAR TOGGLE BUTTON ===== */
        .sidebar-toggle-btn {
            display: none;
            background: var(--card-white);
            border: 1px solid rgba(74,44,17,0.08);
            border-radius: 10px;
            padding: 6px 12px;
            color: var(--dark-coffee);
            cursor: pointer;
            transition: var(--transition-smooth);
        }
        .sidebar-toggle-btn:hover {
            background: var(--bg-cream);
        }

        @media (max-width: 991.98px) {
            .sidebar-toggle-btn {
                display: inline-flex;
                align-items: center;
                gap: 6px;
            }
        }
    </style>
</head>
<body>

<!-- ========== SIDEBAR OVERLAY ========== -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- ========== SIDEBAR ========== -->
<div class="sidebar" id="sidebarMenu">
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="bi bi-patch-check-fill"></i></div>
        <span>POKTAN <br><small style="font-weight:400;font-size:0.7rem;color:#A8988A;">Liberchain</small></span>
    </div>
    <div class="sidebar-menu-wrapper">
        <ul class="sidebar-menu">
            <li class="menu-item"><a href="<?= base_url('admin/dashboard'); ?>"><i class="bi bi-grid-1x2-fill"></i>Dashboard</a></li>
            <li class="menu-item"><a href="<?= base_url('admin/user'); ?>"><i class="bi bi-people-fill"></i>Manajemen User</a></li>
            <li class="menu-item"><a href="<?= base_url('admin/petani'); ?>"><i class="bi bi-person-badge-fill"></i>Data Petani</a></li>
            <li class="menu-item"><a href="<?= base_url('admin/lahan'); ?>"><i class="bi bi-map-fill"></i>Manajemen Lahan</a></li>
            <li class="menu-item"><a href="<?= base_url('admin/panen'); ?>"><i class="bi bi-tree-fill"></i>Rekap Panen</a></li>
            <li class="menu-item"><a href="<?= base_url('admin/produk'); ?>"><i class="bi bi-box-seam-fill"></i>Manajemen Produk</a></li>
            <li class="menu-item"><a href="<?= base_url('admin/transaksi'); ?>"><i class="bi bi-wallet2"></i>Transaksi</a></li>
            <li class="menu-item"><a href="<?= base_url('admin/kurir'); ?>"><i class="bi bi-truck"></i>Manajemen Kurir</a></li>
            <li class="menu-item active"><a href="<?= base_url('admin/mitra'); ?>"><i class="bi bi-shop"></i>Manajemen Mitra</a></li>
            <li class="menu-item"><a href="<?= base_url('admin/laporan'); ?>"><i class="bi bi-file-earmark-bar-graph-fill"></i>Analisis & Laporan</a></li>
        </ul>
    </div>
    <div class="sidebar-footer">
        <button class="btn-logout" onclick="window.location.href='<?= base_url('auth/logout'); ?>'">
            <i class="bi bi-box-arrow-right"></i> Keluar
        </button>
    </div>
</div>

<!-- ========== MAIN ========== -->
<div class="main-content">

    <!-- PAGE HEADER -->
    <div class="page-header">
        <div>
            <button class="sidebar-toggle-btn" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            <h2 class="d-inline-block align-middle mb-0">Manajemen Mitra</h2>
            <p class="subtitle mb-0 mt-1">Kelola mitra, reseller, cafe, dan partner bisnis LiberChain</p>
        </div>
        <div class="d-flex align-items-center" style="gap:10px;">
            <!-- NOTIF BELL -->
            <div style="position:relative;">
                <button class="notif-btn" id="notifToggle" type="button">
                    <i class="bi bi-bell" style="font-size:1.15rem;"></i>
                    <?php if (isset($unread_count) && $unread_count > 0): ?>
                        <span class="notif-dot"><?= $unread_count; ?></span>
                    <?php else: ?>
                        <span class="notif-dot" style="display:none;">0</span>
                    <?php endif; ?>
                </button>
                <div class="notif-dropdown" id="notifDropdown">
                    <div class="notif-dropdown-header">
                        <span><?= (isset($unread_count) && $unread_count > 0) ? $unread_count.' Notifikasi Belum Dibaca' : 'Notifikasi'; ?></span>
                        <div>
                            <?php if (isset($unread_count) && $unread_count > 0): ?>
                                <a href="#" id="markAllReadBtn" class="mr-2">Tandai semua</a>
                            <?php endif; ?>
                            <a href="<?= base_url('admin/dashboard/history'); ?>">Lihat Semua</a>
                        </div>
                    </div>
                    <div class="notif-dropdown-list" id="notifList">
                        <?php if (!empty($notifikasi)): ?>
                            <?php
                            $icon_map = ['success'=>'bi-check-circle-fill','warning'=>'bi-exclamation-triangle-fill','danger'=>'bi-x-circle-fill','info'=>'bi-info-circle-fill'];
                            foreach ($notifikasi as $n):
                                $icon_type  = $n['icon'] ?? 'info';
                                $icon_class = $icon_map[$icon_type] ?? 'bi-info-circle-fill';
                            ?>
                            <a class="notif-item <?= ($n['status_baca'] == '0') ? 'unread' : ''; ?>"
                               href="<?= base_url('admin/dashboard/read/'.$n['id_notifikasi']); ?>">
                                <div class="notif-icon <?= $icon_type; ?>"><i class="bi <?= $icon_class; ?>"></i></div>
                                <div class="notif-text">
                                    <?= htmlspecialchars($n['isi_notifikasi']); ?>
                                    <span class="notif-time"><i class="bi bi-clock"></i> <?= date('d M Y, H:i', strtotime($n['tanggal_buat'])); ?></span>
                                </div>
                                <?php if ($n['status_baca'] == '0'): ?><span class="notif-badge-new">Baru</span><?php endif; ?>
                            </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center text-muted py-5 px-3">
                                <i class="bi bi-bell-slash d-block mb-2" style="font-size:2rem;"></i>
                                <p class="small mb-0">Tidak ada notifikasi</p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="p-2 text-center border-top" style="background:#FAF6F0;border-color:rgba(74,44,17,0.06);">
                        <a href="<?= base_url('admin/dashboard/settings'); ?>" class="small text-secondary font-weight-bold text-decoration-none">
                            <i class="bi bi-gear-fill mr-1"></i> Pengaturan Notifikasi
                        </a>
                    </div>
                </div>
            </div>
            <!-- USER ROLE BADGE -->
            <div class="user-badge">
                <i class="bi bi-person-circle" style="font-size:1.4rem;color:var(--amber-cream);"></i>
                <div>
                    <div style="font-size:0.82rem;font-weight:600;line-height:1.2;"><?= $this->session->userdata('nama') ?? 'Admin'; ?></div>
                    <div style="font-size:0.6rem;color:var(--text-secondary);text-transform:uppercase;letter-spacing:0.5px;"><?= $this->session->userdata('role') ?? 'Admin'; ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- FLASH -->
    <?php if ($this->session->flashdata('success')): ?>
    <div class="flash-alert flash-success">
        <i class="bi bi-check-circle-fill"></i><span><?= $this->session->flashdata('success'); ?></span>
    </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
    <div class="flash-alert flash-danger">
        <i class="bi bi-exclamation-triangle-fill"></i><span><?= $this->session->flashdata('error'); ?></span>
    </div>
    <?php endif; ?>

    <!-- STAT CARDS -->
    <?php
        $total_mitra    = count($mitra);
        $total_active   = 0; $total_inactive = 0;
        foreach ($mitra as $m) {
            if ($m['status_mitra'] === 'Active') $total_active++; else $total_inactive++;
        }
    ?>
    <div class="row mb-4" style="margin:0 -10px;">
        <div class="col-6 col-md-3" style="padding:0 10px 18px;">
            <div class="stat-card">
                <div class="stat-icon brown"><i class="bi bi-shop"></i></div>
                <div><div class="stat-value"><?= $total_mitra; ?></div><div class="stat-label">Total Mitra</div></div>
            </div>
        </div>
        <div class="col-6 col-md-3" style="padding:0 10px 18px;">
            <div class="stat-card">
                <div class="stat-icon green"><i class="bi bi-check-circle-fill"></i></div>
                <div><div class="stat-value"><?= $total_active; ?></div><div class="stat-label">Mitra Aktif</div></div>
            </div>
        </div>
        <div class="col-6 col-md-3" style="padding:0 10px 18px;">
            <div class="stat-card">
                <div class="stat-icon red"><i class="bi bi-x-circle-fill"></i></div>
                <div><div class="stat-value"><?= $total_inactive; ?></div><div class="stat-label">Nonaktif</div></div>
            </div>
        </div>
        <div class="col-6 col-md-3" style="padding:0 10px 18px;">
            <div class="stat-card">
                <div class="stat-icon amber"><i class="bi bi-handshake-fill"></i></div>
                <div><div class="stat-value"><?= $total_active; ?></div><div class="stat-label">Kerjasama Aktif</div></div>
            </div>
        </div>
    </div>

    <!-- TABLE CARD -->
    <div class="table-card">
        <div class="table-card-header">
            <h5 class="table-title"><i class="bi bi-list-stars"></i> Daftar Mitra Terdaftar</h5>
            <div class="d-flex align-items-center flex-wrap" style="gap:8px;">
                <!-- Filter Form -->
                <form action="<?= base_url('admin/mitra'); ?>" method="GET" class="filter-form" id="filterForm">
                    <input type="text" name="search" placeholder="Cari nama mitra..." value="<?= htmlspecialchars($this->input->get('search') ?? ''); ?>">
                    <select name="kategori">
                        <option value="">Semua Kategori</option>
                        <?php foreach ($kategori_list as $kat): ?>
                        <option value="<?= htmlspecialchars($kat); ?>" <?= ($this->input->get('kategori') == $kat) ? 'selected' : ''; ?>><?= htmlspecialchars($kat); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select name="status">
                        <option value="">Semua Status</option>
                        <option value="Active"   <?= ($this->input->get('status')=='Active')   ? 'selected':''  ;?>>Aktif</option>
                        <option value="Inactive" <?= ($this->input->get('status')=='Inactive') ? 'selected':''  ;?>>Nonaktif</option>
                    </select>
                    <button type="submit" class="btn-filter"><i class="bi bi-funnel-fill"></i> Filter</button>
                    <?php if (!empty($this->input->get('search')) || !empty($this->input->get('kategori')) || !empty($this->input->get('status'))): ?>
                    <a href="<?= base_url('admin/mitra'); ?>" class="btn-reset"><i class="bi bi-x-lg"></i> Reset</a>
                    <?php endif; ?>
                </form>
                <a href="<?= base_url('admin/mitra/add'); ?>" class="btn-add"><i class="bi bi-plus-lg"></i> Tambah Mitra</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table mitra-table">
                <thead>
                    <tr>
                        <th style="width:4%">#</th>
                        <th style="width:6%">Logo</th>
                        <th style="width:19%">Nama Mitra</th>
                        <th style="width:12%">Kategori</th>
                        <th style="width:17%">Kontak</th>
                        <th style="width:8%">Urutan</th>
                        <th style="width:11%">Status</th>
                        <th style="width:19%;text-align:right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($mitra)): ?>
                    <tr><td colspan="8">
                        <div class="empty-state">
                            <div class="empty-icon"><i class="bi bi-shop"></i></div>
                            <h6>Belum Ada Data Mitra</h6>
                            <p><?= (!empty($this->input->get('search')) || !empty($this->input->get('kategori')) || !empty($this->input->get('status'))) ? 'Tidak ada mitra yang cocok dengan filter.' : 'Tambahkan mitra pertama Anda.'; ?></p>
                            <a href="<?= base_url('admin/mitra/add'); ?>" class="btn-add" style="font-size:0.8rem;padding:9px 16px;"><i class="bi bi-plus-lg"></i> Tambah Mitra</a>
                        </div>
                    </td></tr>
                    <?php else: $no = 1; foreach ($mitra as $m): ?>
                    <tr>
                        <td style="color:var(--text-secondary);font-weight:600;"><?= $no++; ?></td>
                        <td>
                            <?php if (!empty($m['logo_mitra']) && $m['logo_mitra'] !== 'default.png'): ?>
                                <img src="<?= base_url('assets/uploads/mitra/'.$m['logo_mitra']); ?>" alt="Logo" class="logo-thumb">
                            <?php else: ?>
                                <div class="logo-placeholder"><i class="bi bi-image"></i></div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <p class="mitra-name"><?= htmlspecialchars($m['nama_mitra']); ?></p>
                            <p class="mitra-meta">ID #<?= $m['id_mitra']; ?></p>
                        </td>
                        <td><span class="kategori-pill"><?= htmlspecialchars($m['kategori_mitra']); ?></span></td>
                        <td>
                            <?php if (!empty($m['no_telepon'])): ?>
                                <p class="kontak-line"><i class="bi bi-telephone-fill"></i> <?= htmlspecialchars($m['no_telepon']); ?></p>
                            <?php endif; ?>
                            <?php if (!empty($m['email'])): ?>
                                <p class="kontak-line muted"><i class="bi bi-envelope-fill"></i> <?= htmlspecialchars($m['email']); ?></p>
                            <?php endif; ?>
                            <?php if (empty($m['no_telepon']) && empty($m['email'])): ?>
                                <span class="kontak-empty">&mdash;</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <input type="number" class="form-control urutan-input" data-id="<?= $m['id_mitra']; ?>" value="<?= (int)$m['urutan_tampil']; ?>" min="1" title="Edit urutan">
                        </td>
                        <td>
                            <?php if ($m['status_mitra'] === 'Active'): ?>
                                <span class="status-badge active status-toggle" data-id="<?= $m['id_mitra']; ?>" title="Klik untuk nonaktifkan">
                                    <i class="bi bi-check-circle-fill"></i> Aktif
                                </span>
                            <?php else: ?>
                                <span class="status-badge inactive status-toggle" data-id="<?= $m['id_mitra']; ?>" title="Klik untuk aktifkan">
                                    <i class="bi bi-x-circle-fill"></i> Nonaktif
                                </span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="btn-action-group">
                                <a href="<?= base_url('admin/mitra/edit/'.$m['id_mitra']); ?>" class="btn-icon btn-edit" title="Edit Mitra"><i class="bi bi-pencil-square"></i></a>
                                <button type="button" class="btn-icon btn-delete btn-hapus-trigger"
                                        data-id="<?= $m['id_mitra']; ?>"
                                        data-nama="<?= htmlspecialchars($m['nama_mitra']); ?>"
                                        title="Hapus Permanen">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>

        <?php if (!empty($mitra)): ?>
        <div class="table-footer">
            Menampilkan <strong><?= count($mitra); ?></strong> mitra
            <?php if (!empty($this->input->get('search')) || !empty($this->input->get('kategori')) || !empty($this->input->get('status'))): ?>
            (hasil filter) &mdash; <a href="<?= base_url('admin/mitra'); ?>" style="color:var(--amber-cream);">Lihat semua</a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div><!-- /.table-card -->

</div><!-- /.main-content -->

<!-- ========== MODAL KONFIRMASI HAPUS PERMANEN ========== -->
<div class="modal fade modal-hapus" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:440px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="modalHapusLabel" style="font-size:0.95rem;">Hapus Mitra Permanen</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body text-center">
                <div class="hapus-icon-wrap"><i class="bi bi-exclamation-triangle-fill"></i></div>
                <p style="font-size:0.875rem;color:var(--text-secondary);margin:0;">
                    Anda akan menghapus mitra<br>
                    <strong id="modalNamaMitra" style="color:var(--dark-coffee);"></strong> secara permanen.
                </p>
                <p class="mt-2" style="font-size:0.78rem;color:#dc2626;font-weight:600;">
                    <i class="bi bi-info-circle"></i> Tindakan ini TIDAK BISA dibatalkan. Data dan logo akan dihapus selamanya dari database.
                </p>
                <div class="mt-3 text-left">
                    <label style="font-size:0.72rem;font-weight:700;color:var(--text-secondary);text-transform:uppercase;letter-spacing:0.4px;">Ketik nama mitra untuk konfirmasi</label>
                    <input type="text" id="inputKonfirmHapus" style="width:100%;padding:9px 13px;border:1px solid rgba(74,44,17,0.18);border-radius:9px;font-size:0.85rem;font-family:inherit;margin-top:6px;" placeholder="Ketik nama mitra di sini...">
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-end" style="gap:8px;">
                <button type="button" class="btn-batal-hapus" data-dismiss="modal"><i class="bi bi-x-lg"></i> Batal</button>
                <a href="#" id="btnKonfirmHapus" class="btn-konfirm-hapus" style="pointer-events:none;opacity:0.5;"><i class="bi bi-trash3-fill"></i> Ya, Hapus Permanen</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function () {

    /* --- Sidebar Toggle --- */
    const sidebar = document.getElementById('sidebarMenu');
    const overlay = document.getElementById('sidebarOverlay');
    const toggleBtn = document.getElementById('sidebarToggle');

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
            document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
        });
    }

    if (overlay) {
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        });
    }

    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 991.98) {
            if (!sidebar.contains(e.target) && toggleBtn && !toggleBtn.contains(e.target)) {
                sidebar.classList.remove('open');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        }
    });

    /* --- Jam real-time --- */
    function updateTime() {
        var days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        var months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        var now = new Date();
        var str = days[now.getDay()] + ', ' + now.getDate() + ' ' + months[now.getMonth()] + ' ' + now.getFullYear() + '  |  ' + String(now.getHours()).padStart(2,'0') + ':' + String(now.getMinutes()).padStart(2,'0') + ':' + String(now.getSeconds()).padStart(2,'0');
        $('#currentDateTime').text(str);
    }
    updateTime(); setInterval(updateTime, 1000);

    /* --- Notif toggle --- */
    $('#notifToggle').click(function (e) {
        e.stopPropagation();
        $('#notifDropdown').toggleClass('show');
    });
    $(document).click(function () { $('#notifDropdown').removeClass('show'); });
    $('#notifDropdown').click(function (e) { e.stopPropagation(); });

    /* --- Mark all read --- */
    $('#markAllReadBtn').click(function (e) {
        e.preventDefault();
        $.post("<?= base_url('admin/dashboard/mark_all_read'); ?>", function () {
            $('#notifList .notif-item').removeClass('unread');
            $('.notif-badge-new').remove();
            $('.notif-dot').hide();
            $('.notif-dropdown-header span').text('Semua Notifikasi');
            $('#markAllReadBtn').remove();
        });
    });

    /* --- Toggle status via AJAX --- */
    $(document).on('click', '.status-toggle', function () {
        var badge = $(this), id = badge.data('id');
        $.ajax({
            url: "<?= base_url('admin/mitra/toggle/'); ?>" + id,
            type: "POST", dataType: "json",
            success: function (res) {
                if (res.success) {
                    if (badge.hasClass('active')) {
                        badge.removeClass('active').addClass('inactive')
                             .html('<i class="bi bi-x-circle-fill"></i> Nonaktif')
                             .attr('title','Klik untuk aktifkan');
                    } else {
                        badge.removeClass('inactive').addClass('active')
                             .html('<i class="bi bi-check-circle-fill"></i> Aktif')
                             .attr('title','Klik untuk nonaktifkan');
                    }
                }
            }
        });
    });

    /* --- Update urutan via AJAX --- */
    $('.urutan-input').on('change', function () {
        var inp = $(this), id = inp.data('id'), urutan = parseInt(inp.val());
        if (isNaN(urutan) || urutan < 1) { inp.val(1); urutan = 1; }
        $.ajax({
            url: "<?= base_url('admin/mitra/update_urutan/'); ?>" + id,
            type: "POST", data: { urutan_tampil: urutan }, dataType: "json",
            success: function (res) {
                if (res.success) {
                    inp.addClass('urutan-saved');
                    setTimeout(function () { inp.removeClass('urutan-saved'); }, 1400);
                }
            }
        });
    });

    /* --- Modal Hapus --- */
    var namaMitraAktif = '';
    $(document).on('click', '.btn-hapus-trigger', function () {
        var id   = $(this).data('id');
        var nama = $(this).data('nama');
        namaMitraAktif = nama;
        $('#modalNamaMitra').text('"' + nama + '"');
        $('#inputKonfirmHapus').val('');
        $('#btnKonfirmHapus')
            .attr('href', "<?= base_url('admin/mitra/delete/'); ?>" + id)
            .css({'pointer-events':'none','opacity':'0.5'});
        $('#modalHapus').modal('show');
    });

    $('#inputKonfirmHapus').on('input', function () {
        var match = ($(this).val().trim() === namaMitraAktif.trim());
        $('#btnKonfirmHapus').css(match ? {'pointer-events':'auto','opacity':'1'} : {'pointer-events':'none','opacity':'0.5'});
    });

    $('#modalHapus').on('hidden.bs.modal', function () {
        $('#inputKonfirmHapus').val('');
        $('#btnKonfirmHapus').css({'pointer-events':'none','opacity':'0.5'});
    });

    /* --- Auto-dismiss flash --- */
    setTimeout(function () { $('.flash-alert').fadeOut('slow'); }, 4500);
});
</script>
</body>
</html>
