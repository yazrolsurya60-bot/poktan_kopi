<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Member</title>
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-cream);
            color: var(--dark-coffee);
            overflow-x: hidden;
        }

        /* ============================================
           SIDEBAR - SAMA DENGAN DASHBOARD PEMBELI
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
            .notif-dropdown {
                width: calc(100vw - 32px);
                right: -60px;
            }
        }

        @media (max-width: 575.98px) {
            .main-content {
                padding: 16px 12px 20px;
            }
            .profile-card {
                padding: 20px !important;
            }
            .notif-dropdown {
                width: calc(100vw - 24px);
                right: -70px;
            }
        }

        .sidebar-menu-wrapper::-webkit-scrollbar {
            width: 3px;
        }
        .sidebar-menu-wrapper::-webkit-scrollbar-thumb {
            background: rgba(230, 161, 92, 0.3);
            border-radius: 10px;
        }

        /* ============================================
           PROFIL CUSTOM STYLE - PREMIUM COFFEE THEME
           ============================================ */

        /* Profile Cover */
        .profile-cover {
            background: linear-gradient(135deg, var(--roasted-brown), var(--dark-coffee));
            border-radius: var(--radius-card) var(--radius-card) 0 0;
            padding: 30px 30px 70px 30px;
            position: relative;
        }

        .profile-cover .avatar-wrapper {
            position: absolute;
            bottom: -50px;
            left: 30px;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: var(--amber-cream);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: white;
            border: 4px solid white;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-cover .user-info {
            margin-left: 120px;
            color: white;
        }

        .profile-cover .user-info h4 {
            font-weight: 700;
            margin-bottom: 2px;
        }

        .profile-cover .user-info .badge-role {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            padding: 4px 16px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .profile-cover .user-info .level-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 14px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.75rem;
        }

        .level-badge.bronze {
            background: #FDE68A;
            color: #78350F;
        }
        .level-badge.silver {
            background: #E5E7EB;
            color: #1F2937;
        }
        .level-badge.gold {
            background: #FBBF24;
            color: #78350F;
        }
        .level-badge.platinum {
            background: #A78BFA;
            color: #FFFFFF;
        }

        .profile-card {
            background: var(--card-white);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-soft);
            overflow: hidden;
            transition: var(--transition-smooth);
            margin-top: 50px;
        }

        .profile-card:hover {
            box-shadow: var(--shadow-hover);
        }

        .profile-card .card-body-custom {
            padding: 30px;
        }

        .profile-card .form-control {
            border-radius: 10px;
            padding: 12px 16px;
            border: 1px solid rgba(74, 44, 17, 0.08);
            font-size: 0.9rem;
            background: #FAF8F6;
            transition: var(--transition-smooth);
        }

        .profile-card .form-control:focus {
            border-color: var(--amber-cream);
            box-shadow: 0 0 0 3px rgba(230, 161, 92, 0.12);
            background: white;
        }

        .profile-card .form-control:disabled {
            background: #F3F0EB;
            cursor: not-allowed;
            opacity: 0.8;
        }

        .profile-card label {
            font-weight: 600;
            font-size: 0.75rem;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-edit {
            background: var(--roasted-brown);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 8px 24px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: var(--transition-smooth);
        }

        .btn-edit:hover {
            background: #3d2410;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(74, 44, 17, 0.15);
        }

        .btn-edit-outline {
            background: transparent;
            color: var(--roasted-brown);
            border: 2px solid var(--roasted-brown);
            border-radius: 10px;
            padding: 8px 20px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: var(--transition-smooth);
        }

        .btn-edit-outline:hover {
            background: var(--roasted-brown);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(74, 44, 17, 0.15);
        }

        .btn-save {
            background: var(--amber-cream);
            color: white;
            border-radius: 10px;
            padding: 10px 28px;
            font-weight: 600;
            font-size: 0.9rem;
            border: none;
            transition: var(--transition-smooth);
        }

        .btn-save:hover {
            background: #d48a42;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(230, 161, 92, 0.3);
        }

        .btn-cancel {
            background: transparent;
            color: var(--text-secondary);
            border: 1px solid #EFEAE2;
            border-radius: 10px;
            padding: 10px 28px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: var(--transition-smooth);
        }

        .btn-cancel:hover {
            background: var(--bg-cream);
            color: var(--dark-coffee);
        }

        .stat-mini-card {
            background: var(--bg-cream);
            border-radius: 10px;
            padding: 16px 20px;
            text-align: center;
            transition: var(--transition-smooth);
        }

        .stat-mini-card:hover {
            background: #f5eee6;
            transform: translateY(-2px);
        }

        .stat-mini-card .number {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--roasted-brown);
        }

        .stat-mini-card .label {
            font-size: 0.7rem;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .status-badge-user {
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .status-badge-user.active {
            background: #D1FAE5;
            color: #065F46;
        }
        .status-badge-user.inactive {
            background: #FEE2E2;
            color: #991B1B;
        }
        .status-badge-user.pending {
            background: #FEF3C7;
            color: #92400E;
        }

        .info-row {
            display: flex;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid rgba(74, 44, 17, 0.05);
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-row .info-icon {
            width: 40px;
            height: 40px;
            min-width: 40px;
            border-radius: 10px;
            background: var(--bg-cream);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--amber-cream);
            font-size: 1.1rem;
            margin-right: 14px;
        }

        .info-row .info-label {
            font-size: 0.7rem;
            color: var(--text-secondary);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-row .info-value {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--dark-coffee);
        }

        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .upload-btn-wrapper input[type=file] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .upload-btn-wrapper .btn-upload {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            padding: 6px 16px;
            font-size: 0.8rem;
            font-weight: 600;
            transition: var(--transition-smooth);
        }

        .upload-btn-wrapper .btn-upload:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
        }

        .alert-custom {
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 0.9rem;
            font-weight: 600;
            border: none;
        }

        .alert-custom.success {
            background: #D1FAE5;
            color: #065F46;
        }

        .alert-custom.error {
            background: #FEE2E2;
            color: #991B1B;
        }

        .badge-email-verified {
            font-size: 0.6rem;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 600;
        }

        .badge-email-verified.verified {
            background: #D1FAE5;
            color: #065F46;
        }

        .badge-email-verified.unverified {
            background: #FEF3C7;
            color: #92400E;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR OVERLAY -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- SIDEBAR - SAMA DENGAN DASHBOARD PEMBELI -->
    <div class="sidebar" id="sidebarMenu">
        <div class="sidebar-brand">
            <div class="brand-icon"><i class="bi bi-cup-hot-fill"></i></div>
            <span>MEMBER <br><small style="font-weight:400; font-size:0.7rem; color:#A8988A;">Liberchain</small></span>
        </div>
        <div class="sidebar-menu-wrapper">
            <ul class="sidebar-menu">
                <li class="menu-item">
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
                        <span class="menu-badge"><?= $total_transaksi ?? 0 ?></span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('pembeli/tracking'); ?>">
                        <i class="bi bi-geo-alt-fill"></i>Lacak Pengiriman
                        <span class="menu-badge"><?= $pesanan_dikirim ?? 0 ?></span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('pembeli/poin'); ?>">
                        <i class="bi bi-gift-fill"></i>Tukar Poin Hadiah
                    </a>
                </li>
                <li class="menu-item active">
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

        <!-- PAGE HEADER -->
        <div class="page-header d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle"
                    style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
                    <i class="bi bi-list"></i>
                </button>
                <h2 class="d-inline-block align-middle mb-0">Profil Saya</h2>
                <p class="subtitle mb-0 mt-1">Kelola data diri dan preferensi akun Anda</p>
            </div>
            <div class="d-flex align-items-center gap-3" style="gap: 12px;">
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
                            <a href="<?= base_url('pembeli/dashboard/history'); ?>" style="font-size:0.75rem; color: var(--amber-cream); font-weight:500; text-decoration:none;">Lihat Semua</a>
                        </div>
                        <div class="notif-dropdown-list" id="notifList">
                            <?php if (!empty($notifikasi)): ?>
                                <?php foreach ($notifikasi as $n): ?>
                                    <a class="notif-item <?= (isset($n->status_baca) && $n->status_baca == 0) ? 'unread' : ''; ?>"
                                       href="<?= base_url('pembeli/dashboard/read/' . $n->id_notifikasi); ?>">
                                        <?php
                                        $icon_type = $n->icon ?? 'info';
                                        $icon_map = [
                                            'success' => 'bi-check-circle-fill',
                                            'warning' => 'bi-exclamation-triangle-fill',
                                            'danger'  => 'bi-x-circle-fill',
                                            'info'    => 'bi-info-circle-fill',
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
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center text-muted py-5 px-3">
                                    <i class="bi bi-bell-slash d-block mb-2" style="font-size:2rem;"></i>
                                    <p class="small mb-0">Tidak ada notifikasi</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-2 text-center border-top" style="background:#FAF6F0; border-color:rgba(74,44,17,0.06);">
                            <a href="<?= base_url('pembeli/dashboard/settings'); ?>" class="small text-secondary font-weight-bold text-decoration-none">
                                <i class="bi bi-gear-fill mr-1"></i> Pengaturan Notifikasi
                            </a>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2"
                    style="cursor: pointer; padding: 6px 12px; border-radius: 10px; background: var(--card-white); border: 1px solid rgba(74,44,17,0.06);">
                    <i class="bi bi-person-circle" style="font-size: 1.5rem; color: var(--amber-cream);"></i>
                    <span style="font-weight:500; font-size:0.85rem;"><?= $user->nama ?? 'Pembeli' ?></span>
                </div>
            </div>
        </div>

        <!-- ALERT -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert-custom success mb-3">
                <i class="bi bi-check-circle-fill mr-2"></i> <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert-custom error mb-3">
                <i class="bi bi-exclamation-triangle-fill mr-2"></i> <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- === PROFIL CARD === -->
        <div class="profile-card">

            <!-- COVER -->
            <div class="profile-cover">
                <div class="avatar-wrapper">
                    <div class="profile-avatar">
                        <?php if (!empty($user->foto) && file_exists('./uploads/profil/' . $user->foto)): ?>
                            <img src="<?= base_url('uploads/profil/' . $user->foto) ?>" alt="Foto Profil">
                        <?php else: ?>
                            <i class="bi bi-person-fill"></i>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="user-info">
                    <h4><?= $user->nama ?? 'Budi Pembeli' ?></h4>
                    <div>
                        <span class="badge-role"><i class="bi bi-person mr-1"></i><?= $user->role ?? 'Pembeli' ?></span>
                        <span class="badge-role ml-2"><i class="bi bi-shield-check mr-1"></i><?= ucfirst($user->status ?? 'Active') ?></span>
                        <span class="level-badge <?= $level_class ?? 'bronze' ?> ml-2">
                            <i class="bi bi-award-fill"></i> <?= $level_name ?? 'Bronze' ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- BODY -->
            <div class="card-body-custom">

                <!-- STATISTIK MINI -->
                <div class="row mb-4">
                    <div class="col-4">
                        <div class="stat-mini-card">
                            <div class="number"><?= $total_transaksi ?? 0 ?></div>
                            <div class="label">Transaksi</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-mini-card">
                            <div class="number"><?= $total_poin ?? 0 ?></div>
                            <div class="label">Poin</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-mini-card">
                            <div class="number"><?= $pesanan_dikirim ?? 0 ?></div>
                            <div class="label">Dikirim</div>
                        </div>
                    </div>
                </div>

                <hr style="border-color: rgba(74,44,17,0.06);">

                <!-- FORM DATA DIRI -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="font-weight-bold mb-0" style="color: var(--roasted-brown);">
                        <i class="bi bi-person-gear mr-2" style="color: var(--amber-cream);"></i> Data Diri
                    </h6>
                    <button class="btn-edit" id="btnEdit" onclick="toggleEdit()">
                        <i class="bi bi-pencil mr-1"></i> Ubah Data
                    </button>
                </div>

                <form id="profileForm" method="POST" action="<?= base_url('pembeli/profil/update'); ?>"
                    enctype="multipart/form-data">

                    <!-- Upload Foto -->
                    <div class="form-group">
                        <label>Foto Profil</label>
                        <div class="upload-btn-wrapper">
                            <button class="btn-upload" type="button">
                                <i class="bi bi-camera mr-1"></i> Ganti Foto
                            </button>
                            <input type="file" accept="image/*" name="foto" id="inputFoto" onchange="previewFoto(this)">
                        </div>
                        <small class="text-muted">Format: JPG, PNG, GIF. Maks: 2MB</small>
                        <div id="previewFoto" class="mt-2" style="display:none;">
                            <img id="previewImg" src="#" alt="Preview Foto" style="max-width:150px; border-radius:10px; border:2px solid var(--amber-cream);">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" id="inputNama"
                                    value="<?= $user->nama ?? '' ?>" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" id="inputUsername"
                                    value="<?= $user->username ?? '' ?>" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" id="inputEmail"
                                    value="<?= $user->email ?? '' ?>" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bergabung Sejak</label>
                                <input type="text" class="form-control" id="inputJoined"
                                    value="<?= !empty($user->created_at) ? date('d F Y', strtotime($user->created_at)) : date('d F Y') ?>"
                                    disabled>
                            </div>
                        </div>
                    </div>

                    <!-- TOMBOL AKSI (hidden by default) -->
                    <div id="editActions" style="display: none;" class="mt-3 pt-3 border-top">
                        <button type="submit" class="btn-save">
                            <i class="bi bi-check-circle mr-1"></i> Simpan Perubahan
                        </button>
                        <button type="button" class="btn-cancel ml-2" onclick="cancelEdit()">
                            <i class="bi bi-x-circle mr-1"></i> Batal
                        </button>
                    </div>
                </form>

                <hr style="border-color: rgba(74,44,17,0.06);">

                <!-- KEAMANAN AKUN -->
                <h6 class="font-weight-bold mb-3" style="color: var(--roasted-brown);">
                    <i class="bi bi-shield-lock mr-2" style="color: var(--amber-cream);"></i> Keamanan Akun
                </h6>

                <div class="info-row">
                    <div class="info-icon"><i class="bi bi-key"></i></div>
                    <div style="flex:1;">
                        <div class="info-label">Password</div>
                        <div class="info-value">••••••••</div>
                    </div>
                    <a href="<?= base_url('auth/ubah_password'); ?>" class="btn btn-sm btn-edit-outline"
                        style="font-size:0.7rem; padding:4px 14px;">
                        Ubah Password
                    </a>
                </div>

                <div class="info-row">
                    <div class="info-icon"><i class="bi bi-envelope"></i></div>
                    <div style="flex:1;">
                        <div class="info-label">Email Terverifikasi</div>
                        <div class="info-value">
                            <?= $user->email ?? 'email@domain.com' ?>
                            <?php if (!empty($user->email_verified_at)): ?>
                                <span class="badge-email-verified verified">Terverifikasi</span>
                            <?php else: ?>
                                <span class="badge-email-verified unverified">Belum Verifikasi</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-icon"><i class="bi bi-clock-history"></i></div>
                    <div style="flex:1;">
                        <div class="info-label">Aktivitas Terakhir</div>
                        <div class="info-value"><?= date('d F Y, H:i') ?></div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- SCRIPTS -->
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
        // 3. EDIT PROFILE - INTERAKTIF
        // ============================================
        let isEditing = false;

        function toggleEdit() {
            isEditing = !isEditing;
            const inputs = document.querySelectorAll('#profileForm .form-control');
            const actions = document.getElementById('editActions');
            const btnEdit = document.getElementById('btnEdit');

            inputs.forEach(input => {
                input.disabled = !isEditing;
                if (isEditing) {
                    input.style.background = 'white';
                    input.style.opacity = '1';
                } else {
                    input.style.background = '#F3F0EB';
                    input.style.opacity = '0.8';
                }
            });

            if (isEditing) {
                actions.style.display = 'block';
                btnEdit.innerHTML = '<i class="bi bi-x-circle mr-1"></i> Batalkan';
                btnEdit.className = 'btn-cancel';
                btnEdit.style.background = 'transparent';
                btnEdit.style.color = 'var(--text-secondary)';
                btnEdit.style.border = '1px solid #EFEAE2';
            } else {
                actions.style.display = 'none';
                btnEdit.innerHTML = '<i class="bi bi-pencil mr-1"></i> Ubah Data';
                btnEdit.className = 'btn-edit';
                btnEdit.style.background = 'var(--roasted-brown)';
                btnEdit.style.color = 'white';
                btnEdit.style.border = 'none';
            }
        }

        function cancelEdit() {
            isEditing = true;
            toggleEdit();
            // Reset nilai input ke nilai awal
            document.getElementById('inputNama').value = '<?= $user->nama ?? '' ?>';
            document.getElementById('inputUsername').value = '<?= $user->username ?? '' ?>';
            document.getElementById('inputEmail').value = '<?= $user->email ?? '' ?>';
            // Reset file input
            document.getElementById('inputFoto').value = '';
            // Hide preview
            document.getElementById('previewFoto').style.display = 'none';
        }

        // ============================================
        // 4. PREVIEW FOTO SEBELUM UPLOAD
        // ============================================
        function previewFoto(input) {
            var preview = document.getElementById('previewFoto');
            var previewImg = document.getElementById('previewImg');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            }
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

        console.log('✅ Halaman Profil Pembeli siap digunakan!');
    </script>
</body>

</html>
