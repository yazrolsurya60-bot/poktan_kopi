<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk - Petani Kopi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-cream);
            color: var(--dark-coffee);
            overflow-x: hidden;
        }

        /* --- SIDEBAR PREMIUM --- */
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

        /* Sidebar Footer - Tombol Keluar */
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

        /* --- MAIN CONTENT --- */
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

        /* --- NOTIFICATION BELL --- */
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

        /* --- NOTIFICATION DROPDOWN --- */
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
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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
        }

        .notif-item:hover {
            background: var(--bg-cream);
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

        .notif-item .notif-icon.success {
            background: #D1FAE5;
            color: #065F46;
        }

        .notif-item .notif-icon.warning {
            background: #FEF3C7;
            color: #92400E;
        }

        .notif-item .notif-icon.info {
            background: #DBEAFE;
            color: #1E40AF;
        }

        .notif-item .notif-icon.danger {
            background: #FEE2E2;
            color: #991B1B;
        }

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

        /* --- ACTION CARDS --- */
        .action-card {
            background: var(--card-white);
            border: 1px solid rgba(74, 44, 17, 0.06);
            border-radius: var(--radius-card);
            padding: 18px 22px;
            display: flex;
            align-items: center;
            color: var(--dark-coffee);
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: var(--transition-smooth);
            box-shadow: var(--shadow-soft);
            position: relative;
            overflow: hidden;
        }

        .action-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--amber-cream), transparent);
            opacity: 0;
            transition: var(--transition-smooth);
        }

        .action-card:hover {
            text-decoration: none;
            color: var(--dark-coffee);
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
            border-color: transparent;
        }

        .action-card:hover::after {
            opacity: 1;
        }

        .action-icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            border-radius: 10px;
            background: #FDF5ED;
            color: var(--amber-cream);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.2rem;
            transition: var(--transition-smooth);
        }

        .action-card:hover .action-icon {
            background: var(--amber-cream);
            color: white;
            transform: scale(1.05);
        }

        .action-card .action-arrow {
            margin-left: auto;
            color: var(--text-secondary);
            transition: var(--transition-smooth);
            font-size: 0.9rem;
        }

        .action-card:hover .action-arrow {
            color: var(--amber-cream);
            transform: translateX(4px);
        }

        /* --- STAT BOX --- */
        .stat-box {
            background: var(--card-white);
            border: 1px solid rgba(74, 44, 17, 0.06);
            border-radius: var(--radius-card);
            padding: 22px 24px;
            position: relative;
            box-shadow: var(--shadow-soft);
            transition: var(--transition-smooth);
            overflow: hidden;
        }

        .stat-box:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
        }

        .stat-box .stat-decoration {
            position: absolute;
            right: -20px;
            top: -20px;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(230, 161, 92, 0.05);
            pointer-events: none;
        }

        .stat-title {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--text-secondary);
            letter-spacing: 0.7px;
        }

        .stat-num {
            font-size: 1.7rem;
            font-weight: 700;
            margin-top: 6px;
            margin-bottom: 0;
            color: var(--dark-coffee);
        }

        .stat-change {
            font-size: 0.75rem;
            font-weight: 600;
            margin-top: 4px;
        }

        .stat-change.up {
            color: #10b981;
        }

        .stat-change.down {
            color: #EF4444;
        }

        .stat-badge {
            position: absolute;
            right: 20px;
            top: 20px;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: var(--bg-cream);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: var(--roasted-brown);
            transition: var(--transition-smooth);
        }

        .stat-box:hover .stat-badge {
            transform: scale(1.05) rotate(-3deg);
        }

        /* --- CUSTOM CARD --- */
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

        .custom-card .card-header-custom {
            padding: 18px 24px;
            border-bottom: 1px solid rgba(74, 44, 17, 0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .custom-card .card-header-custom h6 {
            font-weight: 700;
            color: var(--dark-coffee);
            margin: 0;
            font-size: 0.85rem;
        }

        .custom-card .card-body-custom {
            padding: 24px;
        }

        /* --- CHART --- */
        .chart-container {
            position: relative;
            height: 250px;
            width: 100%;
        }

        /* --- TABEL --- */
        .table-custom {
            font-size: 0.85rem;
        }

        .table-custom thead th {
            border-bottom: 2px solid rgba(74, 44, 17, 0.06);
            color: var(--text-secondary);
            font-weight: 600;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 10px 8px;
        }

        .table-custom tbody td {
            padding: 10px 8px;
            border-bottom: 1px solid rgba(74, 44, 17, 0.04);
            vertical-align: middle;
        }

        .table-custom tbody tr:hover {
            background: rgba(250, 246, 240, 0.3);
        }

        /* --- STATUS BADGE --- */
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
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

        .status-badge.stok_aman {
            background: #D1FAE5;
            color: #065F46;
        }

        .status-badge.stok_tipis {
            background: #FEF3C7;
            color: #92400E;
        }

        .status-badge.stok_habis {
            background: #FEE2E2;
            color: #991B1B;
        }

        /* --- QUICK ACTION BUTTONS --- */
        .quick-action-btn {
            padding: 10px 16px;
            border: 1px solid rgba(74, 44, 17, 0.06);
            border-radius: 10px;
            background: var(--card-white);
            color: var(--dark-coffee);
            transition: var(--transition-smooth);
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
            font-size: 0.85rem;
            cursor: pointer;
            width: 100%;
            text-decoration: none;
        }

        .quick-action-btn:hover {
            background: var(--bg-cream);
            border-color: var(--amber-cream);
            transform: translateX(4px);
            text-decoration: none;
            color: var(--dark-coffee);
        }

        .quick-action-btn i {
            font-size: 1.1rem;
            color: var(--amber-cream);
        }

        /* --- CALENDAR / JADWAL PANEN (M11-F01) --- */
        .harvest-schedule-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 10px 0;
            border-bottom: 1px solid rgba(74, 44, 17, 0.05);
        }

        .harvest-schedule-item:last-child {
            border-bottom: none;
        }

        .schedule-date {
            min-width: 50px;
            text-align: center;
        }

        .schedule-date .day {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark-coffee);
            line-height: 1;
        }

        .schedule-date .month {
            font-size: 0.6rem;
            text-transform: uppercase;
            color: var(--text-secondary);
            font-weight: 600;
        }

        .schedule-info {
            flex: 1;
        }

        .schedule-info .title {
            font-weight: 600;
            font-size: 0.85rem;
        }

        .schedule-info .detail {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        /* --- RESPONSIVE --- */
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

            .stat-num {
                font-size: 1.3rem;
            }

            .action-card {
                padding: 14px 16px;
                font-size: 0.8rem;
            }

            .action-icon {
                width: 36px;
                height: 36px;
                min-width: 36px;
                font-size: 1rem;
            }

            .chart-container {
                height: 200px;
            }

            .notif-dropdown {
                width: calc(100vw - 32px);
                right: -60px;
            }
        }

        @media (max-width: 575.98px) {
            .main-content {
                padding: 16px 12px 20px;
            }

            .stat-box {
                padding: 16px 18px;
            }

            .stat-num {
                font-size: 1.1rem;
            }

            .stat-badge {
                width: 36px;
                height: 36px;
                font-size: 1rem;
                right: 14px;
                top: 14px;
            }

            .custom-card .card-body-custom {
                padding: 16px;
            }

            .notif-dropdown {
                width: calc(100vw - 24px);
                right: -70px;
            }
        }

        /* SIDEBAR OVERLAY */
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

        /* SCROLLBAR */
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

    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebarMenu">
        <div class="sidebar-brand">
            <div class="brand-icon">
                <i class="bi bi-patch-check-fill"></i>
            </div>
            <span>POKTAN <br><small style="font-weight:400; font-size:0.7rem; color:#A8988A;">Liberchain</small></span>
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
                <li class="menu-item">
                    <a href="<?= base_url('admin/panen'); ?>">
                        <i class="bi bi-tree-fill"></i>Manajemen Panen
                    </a>
                </li>
                <li class="menu-item active">
                    <a href="<?= base_url('admin/produk'); ?>">
                        <i class="bi bi-box-seam-fill"></i>Manajemen Produk
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('admin/transaksi'); ?>">
                        <i class="bi bi-wallet2"></i>Transaksi
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
                        <i class="bi bi-file-earmark-bar-graph-fill"></i>Analisis & Laporan
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

    
<div class="main-content">
<div class="card-custom">
            <div class="card-body">
                <form action="<?= base_url('admin/produk/update/' . $produk->id_produk); ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Nama Produk</label>
                                <input type="text" name="nama_produk" class="form-control" value="<?= $produk->nama_produk; ?>" required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Jenis Kopi</label>
                                <select name="jenis_kopi" class="form-control" required>
                                    <option value="Arabica" <?= $produk->jenis_kopi == 'Arabica' ? 'selected' : ''; ?>>Arabica</option>
                                    <option value="Robusta" <?= $produk->jenis_kopi == 'Robusta' ? 'selected' : ''; ?>>Robusta</option>
                                    <option value="Liberica" <?= $produk->jenis_kopi == 'Liberica' ? 'selected' : ''; ?>>Liberica</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Grade</label>
                                <select name="grade" class="form-control" required>
                                    <option value="A" <?= $produk->grade == 'A' ? 'selected' : ''; ?>>A</option>
                                    <option value="AA" <?= $produk->grade == 'AA' ? 'selected' : ''; ?>>AA</option>
                                    <option value="B" <?= $produk->grade == 'B' ? 'selected' : ''; ?>>B</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Harga</label>
                                <input type="number" name="harga" class="form-control" value="<?= $produk->harga; ?>" required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Stok</label>
                                <input type="number" name="stok_produk" class="form-control" value="<?= $produk->stok_produk; ?>" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Altitude</label>
                                <input type="text" name="altitude" class="form-control" value="<?= $produk->altitude; ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Proses Pengolahan</label>
                                <input type="text" name="proses" class="form-control" value="<?= $produk->proses; ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Flavor Notes</label>
                                <textarea class="form-control" rows="2" name="flavor_notes"><?= $produk->flavor_notes; ?></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Deskripsi</label>
                                <textarea class="form-control" rows="3" name="deskripsi"><?= $produk->deskripsi; ?></textarea>
                            </div>

                            
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Foto Utama</label>
                                <input type="file" name="foto_utama" class="form-control" accept="image/*">
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Galeri Tambahan (Bisa pilih banyak)</label>
                                <input type="file" name="galeri[]" multiple class="form-control" accept="image/*">
                            </div>
<div class="form-group mb-3">
                                <label class="font-weight-bold">Status Produk</label>
                                <select name="status_produk" class="form-control">
                                    <option value="Aktif" <?= $produk->status_produk == 'Aktif' ? 'selected' : ''; ?>>Aktif</option>
                                    <option value="Nonaktif" <?= $produk->status_produk == 'Nonaktif' ? 'selected' : ''; ?>>Nonaktif</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="text-right mt-4 border-top pt-3">
                        <a href="<?= base_url('admin/produk'); ?>" class="btn btn-light px-4 mr-2" style="border-radius: 8px;">Batal</a>
                        <button type="submit" class="btn text-white px-4" style="background: var(--amber-cream); border-radius: 8px;">
                            <i class="bi bi-check-lg mr-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ============================================
        // 1. SIDEBAR TOGGLE
        // ============================================
        const sidebar = document.getElementById('sidebarMenu');
        const overlay = document.getElementById('sidebarOverlay');
        const toggleBtn = document.getElementById('sidebarToggle');

        function toggleSidebar() {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
            document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
        }

        if (toggleBtn) {
            toggleBtn.addEventListener('click', toggleSidebar);
        }
        if (overlay) {
            overlay.addEventListener('click', toggleSidebar);
        }

        document.addEventListener('click', function (e) {
            if (window.innerWidth > 991.98) return;
            if (!sidebar.contains(e.target) && toggleBtn && !toggleBtn.contains(e.target)) {
                if (sidebar.classList.contains('open')) {
                    toggleSidebar();
                }
            }
        });

        // ============================================
        // 2. NOTIFICATION DROPDOWN (M11-F01)
        // ============================================
        const notifToggle = document.getElementById('notifToggle');
        const notifDropdown = document.getElementById('notifDropdown');

        if (notifToggle) {
            notifToggle.addEventListener('click', function (e) {
                e.stopPropagation();
                notifDropdown.classList.toggle('show');
            });
        }

        document.addEventListener('click', function (e) {
            if (notifDropdown && !notifDropdown.contains(e.target) && !notifToggle.contains(e.target)) {
                notifDropdown.classList.remove('show');
            }
        });

        // ============================================
        // 3. MARK ALL READ (M11-F03)
        // ============================================
        function markAllRead() {
            document.querySelectorAll('.notif-item.unread').forEach(item => {
                item.classList.remove('unread');
            });
            document.getElementById('notifCount').textContent = '0';
            document.getElementById('notifCount').style.display = 'none';
        }

        document.getElementById('markAllRead')?.addEventListener('click', function (e) {
            e.preventDefault();
            markAllRead();
        });

        // ============================================
        // 4. CHART.JS - GRAFIK PANEN (M11-F01)
        // ============================================
        let harvestChart;

        function initChart() {
            const ctx = document.getElementById('harvestChart')?.getContext('2d');
            if (!ctx) return;

            harvestChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Hasil Panen (Kg)',
                        data: [180, 210, 240, 190, 260, 290, 270, 310, 330, 290, 350, 320],
                        backgroundColor: 'rgba(230, 161, 92, 0.8)',
                        borderColor: '#E6A15C',
                        borderWidth: 2,
                        borderRadius: 6,
                        barPercentage: 0.6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#2C1808',
                            titleColor: '#E6A15C',
                            bodyColor: '#FAF6F0',
                            cornerRadius: 8,
                            padding: 10,
                            callbacks: {
                                label: function (context) {
                                    return context.parsed.y + ' kg';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(74, 44, 17, 0.06)',
                                drawBorder: false,
                            },
                            ticks: {
                                font: { size: 10, family: 'Plus Jakarta Sans' },
                                color: '#70655E',
                                stepSize: 50,
                                callback: function (value) { return value + ' kg'; }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: { size: 10, family: 'Plus Jakarta Sans' },
                                color: '#70655E',
                            }
                        }
                    }
                }
            });
        }

        function refreshChart() {
            if (harvestChart) {
                // Update dengan data baru dari AJAX
                // $.get('<?= base_url('api/petani/chart_data'); ?>', function(data) {
                //     harvestChart.data.datasets[0].data = data.values;
                //     harvestChart.update();
                // });
                harvestChart.update();
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            initChart();
        });

        // ============================================
        // 5. CURRENT DATE TIME
        // ============================================
        function updateDateTime() {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            const el = document.getElementById('currentDateTime');
            if (el) {
                el.textContent = now.toLocaleDateString('id-ID', options);
            }
        }
        updateDateTime();
        setInterval(updateDateTime, 60000);

        // ============================================
        // 6. SWITCH HANDLING (M11-F03)
        // ============================================
        document.querySelectorAll('.custom-control-input').forEach(switchEl => {
            switchEl.addEventListener('change', function () {
                const label = this.closest('.custom-control').querySelector('.custom-control-label');
                const setting = label ? label.textContent.trim() : 'Unknown';
                const status = this.checked ? 'diaktifkan' : 'dinonaktifkan';

                // Save to database via AJAX
                // $.post('<?= base_url('api/petani/notifikasi/setting'); ?>', {
                //     key: this.id,
                //     value: this.checked ? 1 : 0
                // });

                console.log(`Notifikasi ${setting} ${status}`);
            });
        });

        console.log('✅ Dashboard Petani siap digunakan!');
        console.log('📋 Fitur yang tersedia:');
        console.log('   - KPI Cards (M11-F01)');
        console.log('   - Grafik Panen (M11-F01)');
        console.log('   - Produk Terjual (M11-F01)');
        console.log('   - Pesanan Masuk (M11-F01)');
        console.log('   - Peringatan Stok (M11-F01)');
        console.log('   - Jadwal Panen (M11-F01)');
        console.log('   - Quick Action (M11-F04)');
        console.log('   - Notifikasi Real-time (M11-F01)');
        console.log('   - Setting Notifikasi (M11-F03)');
    </script>
</body>

</html>

