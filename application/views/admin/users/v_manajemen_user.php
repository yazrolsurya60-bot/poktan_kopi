<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User - Sistem Supply Chain Kopi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
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
            transition: var(--transition-smooth);
            text-decoration: none;
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

        /* --- MAIN CONTENT --- */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 30px 40px 40px;
            min-height: 100vh;
            transition: var(--transition-smooth);
        }

        /* --- PAGE HEADER --- */
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
        /* USER BADGE - SAMA DENGAN DASHBOARD */
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

        /* ============================================ */
        /* NOTIFICATION BELL & DROPDOWN */
        /* ============================================ */

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

        .notif-dropdown-header a:hover {
            text-decoration: underline;
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

        /* ============================================ */
        /* SCROLLBAR NOTIFIKASI */
        /* ============================================ */

        .notif-dropdown-list::-webkit-scrollbar {
            width: 3px;
        }
        .notif-dropdown-list::-webkit-scrollbar-track {
            background: transparent;
        }
        .notif-dropdown-list::-webkit-scrollbar-thumb {
            background: rgba(230, 161, 92, 0.3);
            border-radius: 10px;
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

        /* --- TABLE --- */
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
            padding: 12px 16px;
            background-color: var(--bg-cream);
        }

        .table-custom tbody td {
            padding: 12px 16px;
            border-bottom: 1px solid rgba(74, 44, 17, 0.04);
            vertical-align: middle;
        }

        .table-custom tbody tr:hover {
            background: rgba(250, 246, 240, 0.3);
        }

        /* --- STATUS BADGE --- */
        .status-badge {
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            display: inline-block;
        }

        .status-badge.active {
            background: #D1FAE5;
            color: #065F46;
        }

        .status-badge.inactive {
            background: #FEE2E2;
            color: #991B1B;
        }

        .status-badge.pending {
            background: #FEF3C7;
            color: #92400E;
        }

        /* --- BUTTONS --- */
        .btn-custom-primary {
            background: var(--roasted-brown);
            color: white;
            border-radius: 10px;
            padding: 8px 20px;
            font-weight: 600;
            font-size: 0.85rem;
            border: none;
            transition: var(--transition-smooth);
        }

        .btn-custom-primary:hover {
            background: var(--dark-coffee);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-soft);
        }

        .btn-custom-outline {
            border: 1px solid rgba(74, 44, 17, 0.15);
            border-radius: 10px;
            padding: 6px 14px;
            font-size: 0.75rem;
            font-weight: 600;
            transition: var(--transition-smooth);
            background: transparent;
            color: var(--text-secondary);
        }

        .btn-custom-outline:hover {
            background: var(--bg-cream);
            border-color: var(--roasted-brown);
            color: var(--roasted-brown);
            text-decoration: none;
        }

        .btn-custom-outline-danger {
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: 10px;
            padding: 6px 14px;
            font-size: 0.75rem;
            font-weight: 600;
            transition: var(--transition-smooth);
            background: transparent;
            color: #EF4444;
        }

        .btn-custom-outline-danger:hover {
            background: #FEE2E2;
            border-color: #EF4444;
            color: #991B1B;
            text-decoration: none;
        }

        /* --- ALERT --- */
        .alert-custom {
            border-radius: var(--radius-card);
            border: none;
            padding: 16px 20px;
            margin-bottom: 24px;
        }

        .alert-custom.alert-success {
            background: #D1FAE5;
            color: #065F46;
        }

        .alert-custom.alert-danger {
            background: #FEE2E2;
            color: #991B1B;
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

            .table-responsive {
                font-size: 0.75rem;
            }

            .table-custom thead th,
            .table-custom tbody td {
                padding: 8px 10px;
            }

            .user-badge {
                padding: 4px 10px;
                min-width: 70px;
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
        }

        @media (max-width: 575.98px) {
            .main-content {
                padding: 16px 12px 20px;
            }

            .custom-card .card-body-custom {
                padding: 16px;
            }

            .btn-custom-primary,
            .btn-custom-outline,
            .btn-custom-outline-danger {
                font-size: 0.7rem;
                padding: 4px 10px;
            }

            .user-badge {
                padding: 4px 8px;
                min-width: 60px;
                gap: 5px;
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

        /* SCROLLBAR */
        .sidebar-menu-wrapper::-webkit-scrollbar {
            width: 3px;
        }

        .sidebar-menu-wrapper::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-menu-wrapper::-webkit-scrollbar-thumb {
            background: rgba(230, 161, 92, 0.3);
            border-radius: 10px;
        }

        /* TOGGLE SWITCH UNTUK STATUS */
        .status-toggle {
            cursor: pointer;
            transition: var(--transition-smooth);
        }

        .status-toggle:hover {
            opacity: 0.8;
            transform: scale(1.05);
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
                <li class="menu-item active">
                    <a href="<?= base_url('admin/user'); ?>">
                        <i class="bi bi-people-fill"></i>Manajemen User
                        <span class="menu-badge"><?= count($users); ?></span>
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
                <li class="menu-item">
                    <a href="<?= base_url('admin/produk'); ?>">
                        <i class="bi bi-box-seam-fill"></i>Manajemen Produk
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('admin/transaksi'); ?>">
                        <i class="bi bi-wallet2"></i>Transaksi
                        <span class="menu-badge">8</span>
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

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <!-- PAGE HEADER -->
        <div class="page-header">
            <div>
                <button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle" style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
                    <i class="bi bi-list"></i>
                </button>
                <h2 class="d-inline-block align-middle mb-0">Manajemen User</h2>
                <p class="subtitle mb-0 mt-1">Kelola data user aplikasi</p>
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

					<!-- NOTIFICATION DROPDOWN -->
					<div class="notif-dropdown" id="notifDropdown">
						<div class="notif-dropdown-header">
							<span>
								<?= (isset($unread_count) && $unread_count > 0) ? $unread_count . ' Notifikasi Belum Dibaca' : 'Semua Notifikasi'; ?>
							</span>
							<div>
								<?php if (isset($unread_count) && $unread_count > 0): ?>
									<a href="#" id="markAllReadBtn" class="mr-2"
										style="font-size:0.7rem; text-decoration:none;">Tandai semua</a>
								<?php endif; ?>
								<a href="<?= base_url('admin/dashboard/history'); ?>"
									style="font-size:0.7rem; text-decoration:none;">Lihat Semua</a>
							</div>
						</div>
						<div class="notif-dropdown-list" id="notifList">
							<?php if (!empty($notifikasi)): ?>
								<?php foreach ($notifikasi as $n): ?>
									<a class="notif-item <?= (isset($n['status_baca']) && $n['status_baca'] == '0') ? 'unread' : ''; ?>"
										href="<?= base_url('admin/dashboard/read/' . $n['id_notifikasi']); ?>">
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
											<span
												class="notif-time"><?= date('d M Y, H:i', strtotime($n['tanggal_buat'])); ?></span>
										</div>
										<?php if (isset($n['status_baca']) && $n['status_baca'] == '0'): ?>
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
						<div class="p-2 text-center border-top"
							style="background:#FAF6F0; border-color:rgba(74,44,17,0.06);">
							<a href="<?= base_url('admin/dashboard/settings'); ?>"
								class="small text-secondary font-weight-bold text-decoration-none">
								<i class="bi bi-gear-fill mr-1"></i> Pengaturan Notifikasi
							</a>
						</div>
					</div>
				</div>

                <!-- USER BADGE -->
                <?php
                $nama = $this->session->userdata('nama') ?? 'Admin';
                $role = $this->session->userdata('role') ?? 'Admin';
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

        <!-- ALERT MESSAGES -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert-custom alert-success">
                <i class="bi bi-check-circle-fill mr-2"></i> <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert-custom alert-danger">
                <i class="bi bi-exclamation-circle-fill mr-2"></i> <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- SEARCH & FILTER -->
        <div class="custom-card" style="max-width: 100%; margin-bottom: 20px;">
            <div class="card-body-custom">
                <form method="get" action="<?= site_url('admin/user') ?>" class="form-custom">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-0">
                                <label for="search">
                                    <i class="bi bi-search mr-1"></i> Cari User
                                </label>
                                <input type="text" name="search" id="search" class="form-control" 
                                       placeholder="Nama, username, atau nomor telepon" 
                                       value="<?= htmlspecialchars($search ?? '') ?>" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-0">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="">Semua Role</option>
                                    <option value="Admin" <?= ($role ?? '') === 'Admin' ? 'selected' : '' ?>>Admin</option>
                                    <option value="Petani" <?= ($role ?? '') === 'Petani' ? 'selected' : '' ?>>Petani</option>
                                    <option value="Pembeli" <?= ($role ?? '') === 'Pembeli' ? 'selected' : '' ?>>Pembeli</option>
                                    <option value="Guest" <?= ($role ?? '') === 'Guest' ? 'selected' : '' ?>>Guest</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-0">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">Semua Status</option>
                                    <option value="Active" <?= ($status ?? '') === 'Active' ? 'selected' : '' ?>>Aktif</option>
                                    <option value="Inactive" <?= ($status ?? '') === 'Inactive' ? 'selected' : '' ?>>Nonaktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn-custom-primary" style="width: 100%;">
                                <i class="bi bi-search mr-1"></i> Cari
                            </button>
                        </div>
                    </div>
                    <?php if (!empty($search) || !empty($role) || !empty($status)): ?>
                        <div class="mt-3">
                            <a href="<?= site_url('admin/user') ?>" class="btn-custom-outline" style="font-size: 0.8rem; padding: 6px 14px;">
                                <i class="bi bi-x-circle mr-1"></i> Reset Filter
                            </a>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <!-- USER TABLE -->
        <div class="custom-card">
            <div class="card-header-custom">
                <h6><i class="bi bi-people-fill text-warning mr-2"></i> Daftar User</h6>
                <div>
                    <a href="<?= site_url('admin/user/add') ?>" class="btn-custom-primary">
                        <i class="bi bi-plus-circle mr-1"></i> Tambah User
                    </a>
                </div>
            </div>
            <div class="card-body-custom" style="padding:0;">
                <div class="table-responsive">
                    <table class="table table-custom mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($users)): ?>
                                <?php $i = 1;
                                foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td>
                                            <span style="font-weight:600;"><?= htmlspecialchars($user['nama'] ?? '-') ?></span>
                                        </td>
                                        <td><?= htmlspecialchars($user['username']) ?></td>
                                        <td><?= htmlspecialchars($user['email']) ?></td>
                                        <td>
                                            <span class="badge" style="background: <?= $user['role'] === 'Admin' ? 'var(--amber-cream)' : 'var(--bg-cream)'; ?>; color: <?= $user['role'] === 'Admin' ? 'white' : 'var(--text-secondary)'; ?>; padding: 4px 12px; border-radius: 20px; font-weight:600; font-size:0.7rem;">
                                                <?= ucfirst($user['role']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if ($user['status'] === 'Active'): ?>
                                                <span class="status-badge active" style="cursor: default;">
                                                    <i class="bi bi-check-circle mr-1"></i>Aktif
                                                </span>
                                            <?php else: ?>
                                                <span class="status-badge inactive" style="cursor: default;">
                                                    <i class="bi bi-x-circle mr-1"></i>Nonaktif
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= site_url('admin/user/edit/' . $user['id_user']) ?>" class="btn-custom-outline" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <?php if ($user['role'] !== 'Admin'): ?>
                                                <?php if ($user['status'] === 'Active'): ?>
                                                    <a href="<?= site_url('admin/user/deactivate/' . $user['id_user']) ?>" 
                                                       class="btn-custom-outline" 
                                                       title="Nonaktifkan"
                                                       onclick="return confirm('Apakah Anda yakin ingin menonaktifkan user ini?')">
                                                        <i class="bi bi-pause-circle"></i>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?= site_url('admin/user/activate/' . $user['id_user']) ?>" 
                                                       class="btn-custom-outline" 
                                                       title="Aktifkan"
                                                       onclick="return confirm('Apakah Anda yakin ingin mengaktifkan user ini?')">
                                                        <i class="bi bi-play-circle"></i>
                                                    </a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if ($user['role'] === 'Petani' && $user['is_verified'] === '0'): ?>
                                                <a href="<?= site_url('admin/users/verify_petani/' . $user['id_user']) ?>" 
                                                   class="btn-custom-outline" 
                                                   title="Verifikasi Petani"
                                                   onclick="return confirm('Apakah Anda yakin ingin memverifikasi akun Petani ini?')">
                                                    <i class="bi bi-patch-check"></i>
                                                </a>
                                            <?php endif; ?>
                                            <a href="javascript:void(0)" class="btn-custom-outline-danger" 
                                               onclick="if(confirm('Apakah Anda yakin ingin menghapus user ini?')){ window.location.href='<?= site_url('admin/user/delete/' . $user['id_user']) ?>'; }" 
                                               title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        <i class="bi bi-people d-block mb-2" style="font-size:2rem;"></i>
                                        <p class="mb-0">Belum ada data user</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
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
                    url: '<?= base_url('admin/dashboard/mark_all_read_ajax'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) location.reload();
                        else alert('Gagal menandai semua notifikasi.');
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
        // 4. STATUS TOGGLE
        // ============================================
        $(document).on('click', '.status-toggle', function() {
            const id = $(this).data('id');
            const currentStatus = $(this).data('status');
            const newStatus = currentStatus === 'active' ? 'inactive' : 'active';
            const $this = $(this);

            if (confirm('Ubah status user ini menjadi ' + newStatus + '?')) {
                $.ajax({
                    url: '<?= site_url('admin/user/toggle/') ?>' + id,
                    type: 'POST',
                    data: { status: newStatus },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            alert('Gagal mengubah status user.');
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                });
            }
        });

        console.log('✅ Manajemen User siap digunakan!');
    </script>
</body>

</html>
