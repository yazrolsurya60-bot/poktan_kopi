<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruang Member - Pembeli Kopi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
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
            letter-spacing: 0.5px;
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
           USER AVATAR - RAPI
           ============================================ */
        .user-avatar-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px 14px 6px 10px;
            border-radius: 50px;
            background: var(--card-white);
            border: 1px solid rgba(74, 44, 17, 0.06);
            cursor: pointer;
            transition: var(--transition-smooth);
        }

        .user-avatar-wrapper:hover {
            box-shadow: var(--shadow-soft);
            border-color: var(--amber-cream);
        }

        .user-avatar-img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--amber-cream);
        }

        .user-avatar-icon {
            font-size: 1.8rem;
            color: var(--amber-cream);
        }

        .user-avatar-name {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--dark-coffee);
            max-width: 100px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-avatar-role {
            font-size: 0.6rem;
            color: var(--text-secondary);
            background: var(--bg-cream);
            padding: 1px 10px;
            border-radius: 20px;
            font-weight: 600;
        }

        /* ============================================
           NOTIFICATION BELL
           ============================================ */
        .notif-btn {
            position: relative;
            background: var(--card-white);
            border: 1px solid rgba(74, 44, 17, 0.06);
            border-radius: 50px;
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
            text-decoration: none;
            color: inherit;
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
        .notif-item .notif-icon.primary {
            background: #EDE9FE;
            color: #5B21B6;
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

        /* ============================================
           QUICK ACTION BUTTONS
           ============================================ */
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

        /* ============================================
           KPI CARDS - RAPI & TIDAK DEMPET
           ============================================ */
        .stat-box {
            background: var(--card-white);
            border: 1px solid rgba(74, 44, 17, 0.06);
            border-radius: var(--radius-card);
            padding: 24px 28px;
            position: relative;
            box-shadow: var(--shadow-soft);
            transition: var(--transition-smooth);
            overflow: hidden;
            height: 100%;
            min-height: 140px;
        }

        .stat-box:hover {
            transform: translateY(-4px);
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
            margin-bottom: 4px;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            margin: 4px 0 2px;
            color: var(--dark-coffee);
            line-height: 1.2;
        }

        .stat-number-sm {
            font-size: 1.5rem;
        }

        .stat-change {
            font-size: 0.7rem;
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

        /* ============================================
           CUSTOM CARD
           ============================================ */
        .custom-card {
            background: var(--card-white);
            border: 1px solid rgba(74, 44, 17, 0.06);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-soft);
            transition: var(--transition-smooth);
            overflow: hidden;
            height: 100%;
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

        /* ============================================
           CHART
           ============================================ */
        .chart-container {
            position: relative;
            height: 200px;
            width: 100%;
        }

        /* ============================================
           TABLE
           ============================================ */
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
            padding: 12px 10px;
        }

        .table-custom tbody td {
            padding: 10px 10px;
            border-bottom: 1px solid rgba(74, 44, 17, 0.04);
            vertical-align: middle;
        }

        .table-custom tbody tr:hover {
            background: rgba(250, 246, 240, 0.3);
        }

        /* ============================================
           STATUS BADGE
           ============================================ */
        .status-badge {
            padding: 4px 14px;
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
        .status-badge.shipped, .status-badge.dikirim {
            background: #EDE9FE;
            color: #5B21B6;
        }
        .status-badge.complete, .status-badge.selesai {
            background: #D1FAE5;
            color: #065F46;
        }
        .status-badge.cancelled, .status-badge.dibatalkan {
            background: #FEE2E2;
            color: #991B1B;
        }

        /* ============================================
           RECOMMENDATION PRODUCTS
           ============================================ */
        .rec-product-card {
            background: #FFF;
            border: 1px solid rgba(74, 44, 17, 0.08);
            border-radius: 12px;
            transition: all 0.3s ease;
            height: 100%;
            padding: 16px;
            text-align: center;
        }

        .rec-product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(44, 24, 8, 0.08);
            border-color: var(--amber-cream) !important;
        }

        .rec-product-img-box {
            height: 140px;
            border-radius: 10px;
            overflow: hidden;
            background: #fafaf5;
            border: 1px solid rgba(74, 44, 17, 0.04);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .rec-product-img-box img {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        .rec-product-img-box i {
            font-size: 2.5rem;
            color: var(--amber-cream);
        }

        .rec-product-name {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--dark-coffee);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 38px;
            line-height: 1.2;
            margin-top: 10px;
            margin-bottom: 4px;
        }

        .rec-product-price {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--amber-cream);
            margin-bottom: 4px;
        }

        .rec-product-rating {
            font-size: 0.7rem;
            color: #F59E0B;
            margin-bottom: 10px;
        }

        .rec-product-rating span {
            color: var(--text-secondary);
            font-weight: 400;
        }

        .btn-beli-rec {
            background: var(--amber-cream);
            color: white;
            border-radius: 8px;
            font-weight: 600;
            padding: 6px 16px;
            font-size: 0.75rem;
            transition: all 0.2s;
            display: inline-block;
            text-decoration: none;
            border: none;
        }

        .btn-beli-rec:hover {
            background: var(--roasted-brown);
            color: white;
            text-decoration: none;
        }

        /* ============================================
           HEADER RIGHT - RAPI
           ============================================ */
        .header-right {
            display: flex;
            align-items: center;
            gap: 16px;
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
            .stat-number {
                font-size: 1.5rem;
            }
            .stat-box {
                min-height: 120px;
                padding: 18px 20px;
            }
            .rec-product-img-box {
                height: 100px;
            }
            .header-right {
                gap: 10px;
            }
            .user-avatar-name {
                max-width: 60px;
                font-size: 0.75rem;
            }
            .user-avatar-role {
                display: none;
            }
        }

        @media (max-width: 575.98px) {
            .main-content {
                padding: 16px 12px 20px;
            }
            .stat-box {
                padding: 14px 16px;
                min-height: 100px;
            }
            .stat-number {
                font-size: 1.2rem;
            }
            .stat-badge {
                width: 32px;
                height: 32px;
                font-size: 0.9rem;
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
            .rec-product-img-box {
                height: 80px;
            }
            .rec-product-name {
                font-size: 0.75rem;
                height: 32px;
            }
            .rec-product-price {
                font-size: 0.75rem;
            }
            .user-avatar-wrapper {
                padding: 4px 10px 4px 6px;
            }
            .user-avatar-icon {
                font-size: 1.4rem;
            }
            .user-avatar-name {
                max-width: 50px;
                font-size: 0.7rem;
            }
            .header-right {
                gap: 6px;
            }
            .notif-btn {
                padding: 6px 10px;
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

        /* ============================================
           UTILITY
           ============================================ */
        .text-amber {
            color: var(--amber-cream);
        }
        .bg-amber-soft {
            background: #FDF5ED;
        }
        .gap-2 {
            gap: 8px;
        }
        .gap-3 {
            gap: 16px;
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
                <i class="bi bi-cup-hot-fill"></i>
            </div>
            <span>MEMBER <br><small style="font-weight:400; font-size:0.7rem; color:#A8988A;">Liberchain</small></span>
        </div>
        <div class="sidebar-menu-wrapper">
            <ul class="sidebar-menu">
                <li class="menu-item active">
                    <a href="<?= base_url('pembeli/dashboard'); ?>">
                        <i class="bi bi-house-door-fill"></i>Beranda Akun
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('landing/produk'); ?>">
                        <i class="bi bi-shop-window"></i>Katalog Belanja
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('pembeli/transaksi'); ?>">
                        <i class="bi bi-receipt"></i>Riwayat Transaksi
                        <span class="menu-badge"><?= $kpi_total_transaksi ?? 0 ?></span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('pembeli/tracking'); ?>">
                        <i class="bi bi-geo-alt-fill"></i>Status Pengiriman
                        <span class="menu-badge"><?= $kpi_pesanan_dikirim ?? 0 ?></span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('pembeli/profil'); ?>">
                        <i class="bi bi-person-fill"></i>Profil Saya
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

        <!-- ==========================================
        PAGE HEADER
        ========================================== -->
        <div class="page-header d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle"
                    style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
                    <i class="bi bi-list"></i>
                </button>
                <h2 class="d-inline-block align-middle mb-0">Ruang Belanja Member</h2>
                <p class="subtitle mb-0 mt-1">
                    Selamat datang, <span id="memberName" style="color: var(--amber-cream); font-weight:600;">
                        <?= $this->session->userdata('nama') ?? 'Pembeli' ?>
                    </span>!
                    <span id="currentDateTime" style="color: var(--text-secondary); font-size:0.85rem;"></span>
                </p>
            </div>

            <!-- HEADER RIGHT - NOTIF & AVATAR -->
            <div class="header-right">

                <!-- NOTIFICATION BELL -->
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
                            <div>
                                <?php if (isset($unread_count) && $unread_count > 0): ?>
                                    <a href="#" id="markAllReadBtn" class="mr-2" style="font-size:0.7rem; text-decoration:none;">Tandai semua</a>
                                <?php endif; ?>
                                <a href="<?= base_url('pembeli/dashboard/history'); ?>" style="font-size:0.7rem; text-decoration:none;">Lihat Semua</a>
                            </div>
                        </div>
                        <div class="notif-dropdown-list" id="notifList">
                            <?php if (!empty($notifikasi)): ?>
                                <?php foreach ($notifikasi as $n): ?>
                                    <a class="notif-item <?= (isset($n['status_baca']) && $n['status_baca'] == 0) ? 'unread' : ''; ?>"
                                        href="<?= base_url('pembeli/dashboard/read/' . $n['id_notifikasi']); ?>">
                                        <?php
                                        $icon_type = $n['icon'] ?? 'info';
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
                                            <?= htmlspecialchars($n['isi_notifikasi'] ?? $n['judul'] ?? 'Notifikasi'); ?>
                                            <span class="notif-time"><?= date('d M Y, H:i', strtotime($n['tanggal_buat'])); ?></span>
                                        </div>
                                        <?php if (isset($n['status_baca']) && $n['status_baca'] == 0): ?>
                                            <span class="notif-badge-new">Baru</span>
                                        <?php endif; ?>
                                    </a>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center text-muted py-5 px-3">
                                    <i class="bi bi-bell-slash d-block mb-2" style="font-size:2rem;"></i>
                                    <p class="small mb-0">Tidak ada notifikasi</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-2 text-center border-top" style="background:#FAF6F0; border-color:rgba(74,44,17,0.06);">
                            <a href="<?= base_url('pembeli/dashboard/settings'); ?>"
                                class="small text-secondary font-weight-bold text-decoration-none">
                                <i class="bi bi-gear-fill mr-1"></i> Pengaturan Notifikasi
                            </a>
                        </div>
                    </div>
                </div>

                <!-- USER AVATAR - RAPI & TIDAK DEMPET -->
                <div class="user-avatar-wrapper" onclick="window.location.href='<?= base_url('pembeli/profil'); ?>'">
                    <?php 
                    $user_foto = $this->session->userdata('foto');
                    if (!empty($user_foto) && file_exists('./uploads/profil/' . $user_foto)): 
                    ?>
                        <img src="<?= base_url('uploads/profil/' . $user_foto); ?>" alt="Avatar" class="user-avatar-img">
                    <?php else: ?>
                        <i class="bi bi-person-circle user-avatar-icon"></i>
                    <?php endif; ?>
                    <span class="user-avatar-name"><?= $this->session->userdata('nama') ?? 'Pembeli' ?></span>
                    <span class="user-avatar-role">Member</span>
                    <i class="bi bi-chevron-down" style="font-size:0.6rem; color: var(--text-secondary);"></i>
                </div>

            </div>
        </div>

        <!-- ==========================================
        QUICK ACTION BUTTONS
        ========================================== -->
        <h5 class="font-weight-bold mb-3"
            style="font-size: 0.75rem; color: var(--text-secondary); letter-spacing: 0.7px; text-transform: uppercase;">
            <i class="bi bi-lightning-fill text-warning mr-1"></i> Aksi Cepat
        </h5>
        <div class="row mb-4">
            <div class="col-lg-3 col-md-4 col-6 mb-2">
                <a href="<?= base_url('landing/produk'); ?>" class="quick-action-btn">
                    <i class="bi bi-bag-fill"></i> Belanja Sekarang
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-6 mb-2">
                <a href="<?= base_url('pembeli/transaksi'); ?>" class="quick-action-btn">
                    <i class="bi bi-clock-history"></i> Riwayat Pesanan
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-6 mb-2">
                <a href="<?= base_url('pembeli/tracking'); ?>" class="quick-action-btn">
                    <i class="bi bi-geo-alt-fill"></i> Lacak Kiriman
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-6 mb-2">
                <a href="<?= base_url('pembeli/profil'); ?>" class="quick-action-btn">
                    <i class="bi bi-person-fill"></i> Profil Saya
                </a>
            </div>
        </div>

        <!-- ==========================================
        KPI CARDS - RAPI & TIDAK DEMPET
        ========================================== -->
        <div class="row mb-4">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="stat-box">
                    <div class="stat-decoration"></div>
                    <div class="stat-title">Total Transaksi</div>
                    <div class="stat-number"><?= $kpi_total_transaksi ?? 0; ?></div>
                    <div class="stat-change up"><i class="bi bi-arrow-up"></i> Data real-time</div>
                    <div class="stat-badge" style="background: #059669; color: white;">
                        <i class="bi bi-receipt"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="stat-box">
                    <div class="stat-decoration"></div>
                    <div class="stat-title">Total Belanja</div>
                    <div class="stat-number">Rp <?= number_format($kpi_total_belanja ?? 0, 0, ',', '.'); ?></div>
                    <div class="stat-change up"><i class="bi bi-arrow-up"></i> Data real-time</div>
                    <div class="stat-badge" style="background: var(--amber-cream); color: white;">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="stat-box">
                    <div class="stat-decoration"></div>
                    <div class="stat-title">Pengiriman Aktif</div>
                    <div class="stat-number"><?= $kpi_pesanan_dikirim ?? 0; ?></div>
                    <div class="stat-change up"><i class="bi bi-arrow-up"></i> Data real-time</div>
                    <div class="stat-badge" style="background: var(--dark-coffee); color: white;">
                        <i class="bi bi-truck"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==========================================
        REKOMENDASI PRODUK
        ========================================== -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="custom-card">
                    <div class="card-header-custom">
                        <h6><i class="bi bi-star-fill text-warning mr-2"></i> Rekomendasi Untuk Anda</h6>
                        <span class="badge" style="background: var(--bg-cream); color: var(--text-secondary); font-weight:500;">Terpopuler</span>
                    </div>
                    <div class="card-body-custom">
                        <div class="row">
                            <?php if (!empty($rekomendasi_produk)): ?>
                                <?php foreach ($rekomendasi_produk as $rec): ?>
                                    <?php 
                                    $rec = (array)$rec;
                                    $id_produk = $rec['id_produk'] ?? 0;
                                    $nama = $rec['nama_produk'] ?? 'Produk Kopi';
                                    $harga = 'Rp ' . number_format($rec['harga'] ?? 0, 0, ',', '.') . '/kg';
                                    $foto = !empty($rec['foto_utama']) ? base_url('uploads/produk/' . $rec['foto_utama']) : '';
                                    
                                    $seed = crc32($nama);
                                    $rating_val = 4.0 + (($seed % 10) / 10);
                                    $rating_stars = '';
                                    for ($i = 1; $i <= 5; $i++) {
                                        $rating_stars .= ($i <= round($rating_val)) ? '★' : '☆';
                                    }
                                    $terjual_val = ($seed % 200) + 15;
                                    ?>
                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <div class="rec-product-card">
                                            <div class="rec-product-img-box">
                                                <?php if ($foto): ?>
                                                    <img src="<?= $foto ?>" alt="<?= htmlspecialchars($nama) ?>">
                                                <?php else: ?>
                                                    <i class="bi bi-cup-hot"></i>
                                                <?php endif; ?>
                                            </div>
                                            <div class="rec-product-name"><?= htmlspecialchars($nama); ?></div>
                                            <div class="rec-product-price"><?= $harga; ?></div>
                                            <div class="rec-product-rating">
                                                <?= $rating_stars; ?> <span>(<?= $terjual_val; ?> kg terjual)</span>
                                            </div>
                                            <a href="<?= base_url('landing/produk/detail/' . $id_produk); ?>" class="btn-beli-rec">
                                                <i class="bi bi-cart-plus mr-1"></i> Beli
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="col-12 text-center py-4 text-muted">
                                    <i class="bi bi-box2" style="font-size: 2.5rem;"></i>
                                    <p class="mt-2 mb-0 small">Belum ada rekomendasi produk saat ini.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==========================================
        RIWAYAT TRANSAKSI & GRAFIK
        ========================================== -->
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="custom-card">
                    <div class="card-header-custom">
                        <h6><i class="bi bi-clock-history text-primary mr-2"></i> Riwayat Transaksi Terbaru</h6>
                        <a href="<?= base_url('pembeli/transaksi'); ?>" class="text-muted" style="font-size:0.75rem;">
                            Lihat semua <i class="bi bi-chevron-right"></i>
                        </a>
                    </div>
                    <div class="card-body-custom" style="padding:0;">
                        <div class="table-responsive">
                            <table class="table table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th>Invoice</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($pesanan_terbaru)): ?>
                                        <?php foreach ($pesanan_terbaru as $trx): ?>
                                            <tr>
                                                <td><b>#<?= $trx['id_transaksi']; ?></b></td>
                                                <td>Rp <?= number_format($trx['grand_total'] ?? $trx['total_harga'] ?? 0, 0, ',', '.'); ?></td>
                                                <td>
                                                    <span class="status-badge <?= strtolower($trx['status_pesanan'] ?? 'pending'); ?>">
                                                        <?= ucfirst($trx['status_pesanan'] ?? 'Pending'); ?>
                                                    </span>
                                                </td>
                                                <td><?= date('d M Y', strtotime($trx['tanggal_transaksi'] ?? date('Y-m-d'))); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center py-3 text-muted">Belum ada transaksi</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="custom-card">
                    <div class="card-header-custom">
                        <h6><i class="bi bi-graph-up-arrow text-warning mr-2"></i> Grafik Belanja</h6>
                        <span class="badge" style="background: var(--bg-cream); color: var(--text-secondary); font-weight:500;"><?= date('Y'); ?></span>
                    </div>
                    <div class="card-body-custom">
                        <div class="chart-container">
                            <canvas id="shoppingChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==========================================
        SETTING NOTIFIKASI
        ========================================== -->
        <div class="row">
            <div class="col-12">
                <div class="custom-card">
                    <div class="card-header-custom">
                        <h6><i class="bi bi-gear-fill text-secondary mr-2"></i> Preferensi Notifikasi</h6>
                        <span class="badge" style="background: var(--bg-cream); color: var(--text-secondary); font-weight:500;">Pengaturan</span>
                    </div>
                    <div class="card-body-custom">
                        <?php
                        $default_settings = [
                            'notif_pesanan' => 1,
                            'notif_kurir' => 1,
                            'notif_pembayaran' => 1,
                            'notif_sistem' => 1
                        ];

                        if (!empty($settings)) {
                            foreach ($default_settings as $key => $value) {
                                if (isset($settings[$key])) {
                                    $default_settings[$key] = $settings[$key];
                                }
                            }
                        }
                        ?>
                        <form method="POST" action="<?= base_url('pembeli/dashboard/settings'); ?>">
                            <div class="row">
                                <div class="col-md-3 col-6 mb-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="notif_pesanan" name="notif_pesanan"
                                            <?= $default_settings['notif_pesanan'] == 1 ? 'checked' : ''; ?>>
                                        <label class="custom-control-label" for="notif_pesanan" style="font-size:0.85rem;">Status Pesanan</label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 mb-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="notif_kurir" name="notif_kurir"
                                            <?= $default_settings['notif_kurir'] == 1 ? 'checked' : ''; ?>>
                                        <label class="custom-control-label" for="notif_kurir" style="font-size:0.85rem;">Tracking Kiriman</label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 mb-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="notif_pembayaran" name="notif_pembayaran"
                                            <?= $default_settings['notif_pembayaran'] == 1 ? 'checked' : ''; ?>>
                                        <label class="custom-control-label" for="notif_pembayaran" style="font-size:0.85rem;">Konfirmasi Bayar</label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 mb-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="notif_sistem" name="notif_sistem"
                                            <?= $default_settings['notif_sistem'] == 1 ? 'checked' : ''; ?>>
                                        <label class="custom-control-label" for="notif_sistem" style="font-size:0.85rem;">Update Sistem</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 pt-2 border-top" style="border-color: rgba(74,44,17,0.06);">
                                <button type="submit" class="btn"
                                    style="background: var(--roasted-brown); color: white; border-radius:10px; padding: 8px 24px; font-weight:600; font-size:0.85rem;">
                                    <i class="bi bi-save mr-1"></i> Simpan Pengaturan
                                </button>
                                <button type="button" class="btn btn-link text-muted" style="font-size:0.85rem;" onclick="markAllRead()">
                                    <i class="bi bi-check2-all mr-1"></i> Tandai Semua Dibaca
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- ==========================================
    SCRIPTS
    ========================================== -->
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
            if (notifDropdown && !notifDropdown.contains(e.target) && !notifToggle.contains(e.target)) {
                notifDropdown.classList.remove('show');
            }
        });

        // ============================================
        // 3. MARK ALL READ
        // ============================================
        function markAllRead() {
            if (confirm('Tandai semua notifikasi sebagai sudah dibaca?')) {
                $.ajax({
                    url: '<?= base_url('pembeli/dashboard/mark_all_read'); ?>',
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

        // ============================================
        // 4. CHART.JS - GRAFIK BELANJA
        // ============================================
        let shoppingChart;

        function initChart() {
            const ctx = document.getElementById('shoppingChart')?.getContext('2d');
            if (!ctx) return;

            shoppingChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Liberika', 'Arabika', 'Robusta', 'Lainnya'],
                    datasets: [{
                        data: [40, 30, 20, 10],
                        backgroundColor: ['#E6A15C', '#4A2C11', '#2C1808', '#FAF6F0'],
                        borderColor: '#FFFFFF',
                        borderWidth: 2,
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: { size: 10, family: 'Plus Jakarta Sans' },
                                color: '#70655E',
                                padding: 12,
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                        tooltip: {
                            backgroundColor: '#2C1808',
                            titleColor: '#E6A15C',
                            bodyColor: '#FAF6F0',
                            cornerRadius: 8,
                            padding: 10,
                            callbacks: {
                                label: function(context) {
                                    return context.label + ': ' + context.parsed + '%';
                                }
                            }
                        }
                    },
                    cutout: '70%'
                }
            });
        }

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
                el.textContent = '• ' + now.toLocaleDateString('id-ID', options);
            }
        }
        updateDateTime();
        setInterval(updateDateTime, 60000);

        // ============================================
        // 6. AUTO-REFRESH NOTIFICATION
        // ============================================
        let lastUnreadCount = <?= $unread_count ?? 0; ?>;

        function refreshNotificationCount() {
            $.get('<?= base_url('pembeli/dashboard/get_notifications_ajax'); ?>', function(response) {
                if (response.success) {
                    const currentCount = response.unread;
                    const countEl = document.getElementById('notifCount');
                    const notifBtn = document.getElementById('notifToggle');

                    if (countEl) {
                        if (currentCount > 0) {
                            countEl.textContent = currentCount;
                            countEl.style.display = 'flex';

                            if (currentCount > lastUnreadCount) {
                                playNotifSound();
                                if (notifBtn) {
                                    notifBtn.classList.add('ring');
                                    setTimeout(function() {
                                        notifBtn.classList.remove('ring');
                                    }, 600);
                                }
                            }
                        } else {
                            countEl.style.display = 'none';
                        }
                    }
                    lastUnreadCount = currentCount;
                }
            }).fail(function() {
                console.log('⚠️ Gagal refresh notifikasi');
            });
        }

        // ============================================
        // 7. PLAY NOTIFICATION SOUND
        // ============================================
        function playNotifSound() {
            const audio = document.getElementById('notifSound');
            if (audio) {
                audio.currentTime = 0;
                audio.play().catch(function(e) {
                    console.log('🔇 Sound play error:', e.message);
                });
            }
        }

        // Add audio element
        const audioHtml = `
            <audio id="notifSound" preload="auto">
                <source src="<?= base_url('assets/sounds/notifikasi.wav'); ?>" type="audio/wav">
            </audio>
        `;
        document.body.insertAdjacentHTML('beforeend', audioHtml);

        // ============================================
        // 8. INITIALIZE ALL
        // ============================================
        document.addEventListener('DOMContentLoaded', function() {
            initChart();

            const memberNameEl = document.getElementById('memberName');
            if (memberNameEl) {
                memberNameEl.textContent = '<?= $this->session->userdata('nama') ?? 'Pembeli' ?>';
            }
        });

        // Refresh notifikasi setiap 30 detik
        setInterval(refreshNotificationCount, 30000);

        console.log('✅ Dashboard Pembeli siap digunakan!');
        console.log('📋 Fitur yang tersedia:');
        console.log('   - KPI Cards (Rapi & Tidak Dempet)');
        console.log('   - Rekomendasi Produk');
        console.log('   - Riwayat Transaksi');
        console.log('   - Grafik Belanja');
        console.log('   - Quick Action');
        console.log('   - Notifikasi Real-time');
        console.log('   - Setting Notifikasi');
        console.log('   - User Avatar (Rapi)');
    </script>

</body>

</html>
