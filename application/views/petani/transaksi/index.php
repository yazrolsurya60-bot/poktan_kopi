<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Produk Saya - Petani Kopi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
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

        .menu-item a .menu-badge.danger {
            background: #EF4444;
            color: white;
        }

        .menu-item a .menu-badge.success {
            background: #10B981;
            color: white;
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

        /* ============================================ */
        /* HEADER RIGHT - NOTIF + USER BADGE */
        /* ============================================ */

        .header-right {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        /* ============================================ */
        /* USER BADGE */
        /* ============================================ */

        .user-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            border-radius: 10px;
            background: var(--card-white);
            border: 1px solid rgba(74, 44, 17, 0.06);
            font-weight: 500;
            font-size: 0.85rem;
            cursor: default;
            min-width: 90px;
            transition: var(--transition-smooth);
        }

        .user-badge:hover {
            background: var(--bg-cream);
            border-color: var(--amber-cream);
        }

        .user-badge i {
            font-size: 1.4rem;
            color: var(--amber-cream);
            flex-shrink: 0;
        }

        .user-badge .user-name {
            font-weight: 600;
            font-size: 0.82rem;
            color: var(--dark-coffee);
            line-height: 1.2;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-badge .user-role {
            font-size: 0.6rem;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
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

        .notif-badge-new {
            background: var(--amber-cream);
            color: white;
            font-size: 0.55rem;
            padding: 2px 8px;
            border-radius: 10px;
            align-self: center;
        }

        .notif-empty {
            text-align: center;
            padding: 40px 20px;
        }

        .notif-empty i {
            font-size: 2.5rem;
            color: #D1C9C0;
            display: block;
            margin-bottom: 10px;
        }

        .notif-empty p {
            color: var(--text-secondary);
            font-size: 0.85rem;
            margin: 0;
        }

        /* ============================================ */
        /* MAIN CONTENT */
        /* ============================================ */
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
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
            padding: 0;
        }

        .table-custom {
            font-size: 0.85rem;
            margin-bottom: 0;
        }

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

        .table-custom tbody tr:hover {
            background: rgba(250, 246, 240, 0.3);
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            display: inline-block;
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

        .btn-detail {
            background: var(--amber-cream);
            color: white;
            border: none;
            padding: 5px 14px;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
            transition: var(--transition-smooth);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-detail:hover {
            background: var(--roasted-brown);
            color: white;
            text-decoration: none;
            transform: translateY(-1px);
            box-shadow: var(--shadow-hover);
        }

        /* ============================================ */
        /* RESPONSIVE */
        /* ============================================ */

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

            .user-badge {
                padding: 4px 10px;
                min-width: 60px;
            }

            .user-badge i {
                font-size: 1.1rem;
            }

            .user-badge .user-name {
                font-size: 0.7rem;
            }

            .user-badge .user-role {
                font-size: 0.5rem;
            }

            .header-right {
                gap: 8px;
            }

            .notif-dropdown {
                width: calc(100vw - 32px);
                right: -60px;
            }

            .sidebar-overlay.active {
                display: block;
            }
        }

        @media (max-width: 575.98px) {
            .main-content {
                padding: 16px 12px 20px;
            }

            .user-badge {
                padding: 4px 8px;
                min-width: 50px;
                gap: 4px;
            }

            .user-badge i {
                font-size: 0.9rem;
            }

            .user-badge .user-name {
                font-size: 0.6rem;
            }

            .user-badge .user-role {
                display: none;
            }

            .header-right {
                gap: 6px;
            }

            .notif-dropdown {
                width: calc(100vw - 24px);
                right: -70px;
            }

            .table-custom thead th,
            .table-custom tbody td {
                padding: 8px 6px;
                font-size: 0.7rem;
            }

            .btn-detail {
                font-size: 0.65rem;
                padding: 4px 10px;
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

        /* 🔔 NOTIFIKASI ANIMASI */
        @keyframes notifPulse {
            0%, 100% { transform: scale(1); }
            30% { transform: scale(1.5); background: #EF4444; }
            60% { transform: scale(0.9); }
        }

        @keyframes bellRing {
            0%, 100% { transform: rotate(0); }
            25% { transform: rotate(10deg); }
            50% { transform: rotate(-10deg); }
            75% { transform: rotate(5deg); }
        }

        .notif-dot.pulse {
            animation: notifPulse 0.6s ease 3;
        }

        .notif-btn.ring {
            animation: bellRing 0.5s ease 1;
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
            <span>PETANI <br><small style="font-weight:400; font-size:0.7rem; color:#A8988A;">Liberchain</small></span>
        </div>
        <div class="sidebar-menu-wrapper">
            <ul class="sidebar-menu">
                <li class="menu-item">
                    <a href="<?= base_url('petani/dashboard'); ?>">
                        <i class="bi bi-grid-1x2-fill"></i>Dashboard
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('petani/lahan'); ?>">
                        <i class="bi bi-geo-alt-fill"></i>Kelola Lahan
                        <span class="menu-badge success">3</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('petani/panen'); ?>">
                        <i class="bi bi-tree-fill"></i>Manajemen Panen
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('petani/produk'); ?>">
                        <i class="bi bi-box-seam"></i>Katalog Produk
                        <span class="menu-badge">5</span>
                    </a>
                </li>
                <li class="menu-item active">
                    <a href="<?= base_url('petani/transaksi'); ?>">
                        <i class="bi bi-cart-check-fill"></i>Pesanan Masuk
                        <span class="menu-badge danger"><?= count($transaksi ?? []); ?></span>
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
        <!-- PAGE HEADER -->
        <div class="page-header">
            <div>
                <button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle"
                    style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
                    <i class="bi bi-list"></i>
                </button>
                <h2 class="d-inline-block align-middle mb-0">Transaksi Produk Saya</h2>
                <p class="subtitle mb-0 mt-1">Daftar transaksi dari produk yang Anda jual</p>
            </div>
            <div class="header-right">
                <!-- NOTIFICATION BELL -->
                <div style="position: relative;">
                    <button class="notif-btn" id="notifToggle">
                        <i class="bi bi-bell" style="font-size: 1.2rem;"></i>
                        <?php if (isset($unread_count) && $unread_count > 0): ?>
                            <span class="notif-dot" id="notifCount"><?= $unread_count; ?></span>
                        <?php else: ?>
                            <span class="notif-dot" id="notifCount" style="display:none;">0</span>
                        <?php endif; ?>
                    </button>
                    <div class="notif-dropdown" id="notifDropdown">
                        <div class="notif-dropdown-header">
                            <span><?= isset($unread_count) && $unread_count > 0 ? $unread_count . ' Notifikasi Belum Dibaca' : 'Semua Notifikasi'; ?></span>
                            <div>
                                <?php if (isset($unread_count) && $unread_count > 0): ?>
                                    <a href="#" id="markAllReadBtn" class="mr-2">Tandai semua</a>
                                <?php endif; ?>
                                <a href="<?= base_url('petani/dashboard/history'); ?>">Lihat Semua</a>
                            </div>
                        </div>
                        <div class="notif-dropdown-list" id="notifList">
                            <?php if (!empty($notifikasi)): ?>
                                <?php foreach ($notifikasi as $n): ?>
                                    <a class="notif-item <?= (isset($n['status_baca']) && $n['status_baca'] == '0') ? 'unread' : ''; ?>"
                                        href="<?= base_url('petani/dashboard/read/' . $n['id_notifikasi']); ?>">
                                        <?php
                                        $icon_type = $n['icon'] ?? 'info';
                                        $icon_map = [
                                            'success' => 'bi-check-circle-fill',
                                            'warning' => 'bi-exclamation-triangle-fill',
                                            'danger' => 'bi-x-circle-fill',
                                            'info' => 'bi-info-circle-fill'
                                        ];
                                        $icon_class = $icon_map[$icon_type] ?? 'bi-info-circle-fill';
                                        ?>
                                        <div class="notif-icon <?= $icon_type; ?>">
                                            <i class="bi <?= $icon_class; ?>"></i>
                                        </div>
                                        <div class="notif-text">
                                            <?= htmlspecialchars($n['isi_notifikasi']); ?>
                                            <span class="notif-time"><?= date('d M Y, H:i', strtotime($n['tanggal_buat'])); ?></span>
                                        </div>
                                        <?php if (isset($n['status_baca']) && $n['status_baca'] == '0'): ?>
                                            <span class="notif-badge-new">Baru</span>
                                        <?php endif; ?>
                                    </a>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="notif-empty">
                                    <i class="bi bi-bell-slash"></i>
                                    <p>Tidak ada notifikasi</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-2 text-center border-top" style="background:#FAF6F0; border-color:rgba(74,44,17,0.06);">
                            <a href="<?= base_url('petani/dashboard/settings'); ?>" class="small text-secondary font-weight-bold text-decoration-none">
                                <i class="bi bi-gear-fill mr-1"></i> Pengaturan Notifikasi
                            </a>
                        </div>
                    </div>
                </div>

                <!-- USER BADGE -->
                <?php
                $nama = $this->session->userdata('nama') ?? 'Petani';
                $role = $this->session->userdata('role') ?? 'Petani';
                ?>
                <div class="user-badge">
                    <i class="bi bi-person-circle"></i>
                    <div>
                        <div class="user-name"><?= $nama; ?></div>
                        <div class="user-role"><?= $role; ?></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TRANSAKSI TABLE -->
        <div class="custom-card">
            <div class="card-header-custom">
                <h6><i class="bi bi-receipt mr-2"></i> Daftar Transaksi</h6>
                <span class="badge" style="background: var(--bg-cream); color: var(--text-secondary); font-weight:500;">
                    <?= count($transaksi ?? []); ?> transaksi
                </span>
            </div>
            <div class="card-body-custom">
                <?php if (empty($transaksi)): ?>
                    <div class="text-center py-5">
                        <i class="bi bi-inbox" style="font-size: 3rem; color: #ddd;"></i>
                        <h5 class="mt-3">Belum ada transaksi</h5>
                        <p class="text-muted">Produk Anda belum ada yang dipesan.</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-custom">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Pembeli</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($transaksi as $t): ?>
                                    <tr>
                                        <td><strong>#<?= $t['id_transaksi']; ?></strong></td>
                                        <td><?= $t['nama_pembeli'] ?? 'Guest'; ?></td>
                                        <td><strong>Rp <?= number_format($t['grand_total'] ?? 0, 0, ',', '.'); ?></strong></td>
                                        <td>
                                            <?php
                                            $status = $t['status_pesanan'] ?? 'Pending';
                                            $class = 'pending';
                                            if ($status == 'Selesai') $class = 'complete';
                                            elseif ($status == 'Dikirim') $class = 'delivery';
                                            elseif ($status == 'Diproses') $class = 'processing';
                                            elseif ($status == 'Dibatalkan') $class = 'cancelled';
                                            ?>
                                            <span class="status-badge <?= $class; ?>">
                                                <?= $status; ?>
                                            </span>
                                        </td>
                                        <td><?= date('d/m/Y H:i', strtotime($t['tanggal_transaksi'])); ?></td>
                                        <td>
                                            <a href="<?= base_url('petani/transaksi/detail/' . $t['id_transaksi']); ?>"
                                                class="btn-detail">
                                                <i class="bi bi-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
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

        document.addEventListener('click', function(e) {
            if (window.innerWidth > 991.98) return;
            if (!sidebar.contains(e.target) && toggleBtn && !toggleBtn.contains(e.target)) {
                if (sidebar.classList.contains('open')) {
                    toggleSidebar();
                }
            }
        });

        // ============================================
        // 2. NOTIFICATION DROPDOWN
        // ============================================
        const notifToggle = document.getElementById('notifToggle');
        const notifDropdown = document.getElementById('notifDropdown');

        if (notifToggle) {
            notifToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                notifDropdown.classList.toggle('show');
            });
        }

        document.addEventListener('click', function(e) {
            if (notifDropdown && !notifDropdown.contains(e.target) && notifToggle && !notifToggle.contains(e.target)) {
                notifDropdown.classList.remove('show');
            }
        });

        // ============================================
        // 3. MARK ALL READ
        // ============================================
        function markAllRead() {
            if (confirm('Tandai semua notifikasi sebagai sudah dibaca?')) {
                $.ajax({
                    url: '<?= base_url('petani/dashboard/mark_all_read_ajax'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            alert('Gagal menandai semua notifikasi.');
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                });
            }
        }

        document.getElementById('markAllReadBtn')?.addEventListener('click', function(e) {
            e.preventDefault();
            markAllRead();
        });

        console.log('✅ Halaman Transaksi Produk Saya siap digunakan!');
        console.log('📋 Data transaksi dari database real-time');
    </script>

</body>
</html>
