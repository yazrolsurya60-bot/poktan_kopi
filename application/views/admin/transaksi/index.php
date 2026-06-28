<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Manajemen Transaksi - Sistem Supply Chain Kopi</title>
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

		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: 'Plus Jakarta Sans', sans-serif;
			background: var(--bg-cream);
			color: var(--dark-coffee);
			overflow-x: hidden;
		}

		/* ===== SIDEBAR ===== */
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

		.sidebar-menu-wrapper::-webkit-scrollbar {
			width: 3px;
		}

		.sidebar-menu-wrapper::-webkit-scrollbar-thumb {
			background: rgba(230, 161, 92, 0.3);
			border-radius: 10px;
		}

		.sidebar-menu {
			list-style: none;
			margin: 0;
			padding: 0;
		}

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

		.menu-item a i {
			font-size: 1.1rem;
			margin-right: 14px;
			width: 22px;
			text-align: center;
		}

		.menu-item a .menu-badge {
			margin-left: auto;
			background: rgba(230, 161, 92, 0.2);
			color: var(--amber-cream);
			font-size: 0.65rem;
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

		/* ===== MAIN CONTENT ===== */
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
			font-size: 1.6rem;
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

		.breadcrumb-custom {
			background: transparent;
			padding: 0;
			margin: 0;
			font-size: 0.85rem;
		}

		.breadcrumb-custom .breadcrumb-item a {
			color: var(--text-secondary);
			text-decoration: none;
			transition: var(--transition-smooth);
		}

		.breadcrumb-custom .breadcrumb-item a:hover {
			color: var(--amber-cream);
		}

		.breadcrumb-custom .breadcrumb-item.active {
			color: var(--dark-coffee);
			font-weight: 600;
		}

		/* ===== NOTIFICATION - SAMA DENGAN DASHBOARD ===== */
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
			animation: pulse-dot 2s infinite;
		}

		.notif-dot.hidden {
			display: none;
		}

		@keyframes pulse-dot {

			0%,
			100% {
				transform: scale(1);
			}

			50% {
				transform: scale(1.1);
			}
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
			cursor: pointer;
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

		/* ===== STATISTIK CARDS ===== */
		.stat-card {
			background: var(--card-white);
			border-radius: var(--radius-card);
			padding: 20px 22px;
			position: relative;
			box-shadow: var(--shadow-soft);
			transition: var(--transition-smooth);
			border: 1px solid rgba(74, 44, 17, 0.04);
			height: 100%;
			overflow: hidden;
		}

		.stat-card::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			height: 3px;
			background: linear-gradient(90deg, var(--amber-cream), var(--roasted-brown));
			opacity: 0;
			transition: var(--transition-smooth);
		}

		.stat-card:hover {
			transform: translateY(-4px);
			box-shadow: var(--shadow-hover);
		}

		.stat-card:hover::before {
			opacity: 1;
		}

		.stat-card .stat-icon {
			width: 48px;
			height: 48px;
			border-radius: 14px;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 1.4rem;
			margin-bottom: 12px;
		}

		.stat-card .stat-title {
			font-size: 0.7rem;
			font-weight: 600;
			text-transform: uppercase;
			color: var(--text-secondary);
			letter-spacing: 0.5px;
			margin-bottom: 4px;
		}

		.stat-card .stat-number {
			font-size: 1.8rem;
			font-weight: 800;
			color: var(--dark-coffee);
			line-height: 1.2;
		}

		.stat-card .stat-footer {
			margin-top: 8px;
			font-size: 0.75rem;
			color: var(--text-secondary);
			display: flex;
			align-items: center;
			gap: 6px;
		}

		.stat-card .stat-footer .trend-up {
			color: #10B981;
		}

		.stat-card .stat-footer .trend-down {
			color: #EF4444;
		}

		/* ===== CUSTOM CARD ===== */
		.custom-card {
			background: var(--card-white);
			border-radius: var(--radius-card);
			box-shadow: var(--shadow-soft);
			transition: var(--transition-smooth);
			overflow: hidden;
			border: 1px solid rgba(74, 44, 17, 0.04);
		}

		.custom-card:hover {
			box-shadow: var(--shadow-hover);
		}

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

		.custom-card .card-body-custom {
			padding: 0;
		}

		/* ===== TABLE ===== */
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
			padding: 14px 12px;
		}

		.table-custom tbody td {
			padding: 14px 12px;
			border-bottom: 1px solid rgba(74, 44, 17, 0.04);
			vertical-align: middle;
		}

		.table-custom tbody tr {
			transition: var(--transition-smooth);
		}

		.table-custom tbody tr:hover {
			background: rgba(250, 246, 240, 0.4);
		}

		.avatar-circle {
			width: 34px;
			height: 34px;
			border-radius: 50%;
			background: var(--amber-light);
			display: flex;
			align-items: center;
			justify-content: center;
			color: var(--amber-cream);
			font-weight: 700;
			font-size: 0.8rem;
			flex-shrink: 0;
		}

		/* ===== STATUS BADGE ===== */
		.status-badge {
			padding: 5px 14px;
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

		.status-badge.lunas {
			background: #D1FAE5;
			color: #065F46;
		}

		.status-badge.batal {
			background: #FEE2E2;
			color: #991B1B;
		}

		/* ===== QUICK ACTION ===== */
		.quick-action-btn {
			padding: 10px 18px;
			border-radius: 12px;
			transition: var(--transition-smooth);
			display: inline-flex;
			align-items: center;
			gap: 10px;
			font-weight: 600;
			font-size: 0.82rem;
			cursor: pointer;
			text-decoration: none;
			box-shadow: var(--shadow-soft);
			border: 1px solid rgba(74, 44, 17, 0.06);
			background: var(--card-white);
			color: var(--dark-coffee);
		}

		.quick-action-btn:hover {
			transform: translateY(-2px);
			text-decoration: none;
			color: var(--dark-coffee);
			box-shadow: var(--shadow-hover);
		}

		.quick-action-btn i {
			font-size: 1.1rem;
		}

		.quick-action-btn.btn-excel {
			background: #1B7C3C;
			color: white;
			border-color: #1B7C3C;
		}

		.quick-action-btn.btn-excel:hover {
			background: #14632F;
			color: white;
		}

		.quick-action-btn.btn-pdf {
			background: #DC143C;
			color: white;
			border-color: #DC143C;
		}

		.quick-action-btn.btn-pdf:hover {
			background: #B01030;
			color: white;
		}

		.quick-action-btn.btn-print {
			background: var(--dark-coffee);
			color: white;
			border-color: var(--dark-coffee);
		}

		.quick-action-btn.btn-print:hover {
			background: #1a0e04;
			color: white;
		}

		.btn-detail-transaksi {
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

		.btn-detail-transaksi:hover {
			background: var(--roasted-brown);
			color: white;
			text-decoration: none;
			transform: translateY(-1px);
			box-shadow: var(--shadow-hover);
		}

		/* ===== SIDEBAR OVERLAY ===== */
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

		/* ===== FOOTER ===== */
		.footer-bottom {
			color: var(--text-secondary);
			font-size: 0.8rem;
			border-top: 1px solid rgba(74, 44, 17, 0.06);
			padding-top: 20px;
			margin-top: 30px;
			text-align: center;
		}

		/* ===== RESPONSIVE ===== */
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

			.page-header .page-title {
				font-size: 1.2rem;
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

			.stat-card {
				padding: 16px 18px;
			}

			.stat-card .stat-number {
				font-size: 1.3rem;
			}

			.stat-card .stat-icon {
				width: 40px;
				height: 40px;
				font-size: 1.1rem;
			}

			.notif-dropdown {
				width: calc(100vw - 24px);
				right: -70px;
			}

			.quick-action-btn {
				font-size: 0.75rem;
				padding: 8px 12px;
			}
		}

		.fade-in {
			animation: fadeInUp 0.6s ease forwards;
		}

		@keyframes fadeInUp {
			from {
				opacity: 0;
				transform: translateY(20px);
			}

			to {
				opacity: 1;
				transform: translateY(0);
			}
		}

		::-webkit-scrollbar {
			width: 6px;
			height: 6px;
		}

		::-webkit-scrollbar-track {
			background: var(--bg-cream);
		}

		::-webkit-scrollbar-thumb {
			background: var(--amber-cream);
			border-radius: 10px;
		}

		::-webkit-scrollbar-thumb:hover {
			background: var(--roasted-brown);
		}
	</style>
</head>

<body>

	<!-- SIDEBAR OVERLAY -->
	<div class="sidebar-overlay" id="sidebarOverlay"></div>

	<!-- SIDEBAR -->
	<div class="sidebar" id="sidebarMenu">
		<div class="sidebar-brand">
			<div class="brand-icon"><i class="bi bi-patch-check-fill"></i></div>
			<div class="brand-text">POKTAN <small>Liberchain</small></div>
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
						<span class="menu-badge">12</span>
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
				<li class="menu-item active">
					<a href="<?= base_url('admin/transaksi'); ?>">
						<i class="bi bi-wallet2"></i>Transaksi
						<span class="menu-badge"><?= count($transaksi ?? []); ?></span>
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
		<div class="page-header d-flex justify-content-between align-items-center flex-wrap">
			<div>
				<button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle"
					style="border-radius:12px; border:1px solid rgba(74,44,17,0.08);">
					<i class="bi bi-list"></i>
				</button>
				<h1 class="page-title d-inline-block align-middle mb-0">
					<i class="bi bi-wallet2"></i>Manajemen Transaksi
				</h1>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb breadcrumb-custom">
						<li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard'); ?>">Dashboard</a></li>
						<li class="breadcrumb-item active" aria-current="page">Transaksi</li>
					</ol>
				</nav>
			</div>
			<div class="d-flex align-items-center gap-3">

			            <!-- NOTIFIKASI BELL -->
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
                        <span><?= isset($unread_count) && $unread_count > 0 ? $unread_count . ' Belum Dibaca' : 'Semua Notifikasi'; ?></span>
                        <a href="<?= base_url('notifikasi/history'); ?>">Lihat Semua</a>
                    </div>
                    <div class="notif-dropdown-list">
                        <?php if (!empty($notifikasi)): ?>
                            <?php foreach ($notifikasi as $n): ?>
                                <?php
                                    $icon_type = $n['icon'] ?? 'info';
                                    $icon_map  = ['success' => 'bi-check-circle-fill', 'warning' => 'bi-exclamation-triangle-fill', 'danger' => 'bi-x-circle-fill', 'info' => 'bi-info-circle-fill'];
                                    $icon_class = $icon_map[$icon_type] ?? 'bi-info-circle-fill';
                                ?>
                                <a class="notif-item-drop <?= ($n['status_baca'] ?? '0') == '0' ? 'unread' : ''; ?>"
                                   href="<?= base_url('notifikasi/read/' . $n['id_notifikasi']); ?>">
                                    <div class="notif-icon <?= $icon_type; ?>">
                                        <i class="bi <?= $icon_class; ?>"></i>
                                    </div>
                                    <div style="flex:1; font-size:0.85rem;">
                                        <?= htmlspecialchars($n['isi_notifikasi']); ?>
                                        <span style="font-size:0.7rem; color:var(--text-secondary); display:block; margin-top:2px;"><?= date('d M Y, H:i', strtotime($n['tanggal_buat'])); ?></span>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center text-muted py-4">
                                <i class="bi bi-bell-slash d-block mb-1" style="font-size:1.8rem;"></i>
                                <small>Tidak ada notifikasi</small>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="p-2 text-center border-top" style="background:#FAF6F0;">
                        <a href="<?= base_url('notifikasi/setting'); ?>" class="small text-secondary font-weight-bold text-decoration-none">
                            <i class="bi bi-gear-fill mr-1"></i> Pengaturan Notifikasi
                        </a>
                    </div>
                </div>
            </div>

            <!-- USER AVATAR -->
            <div class="d-flex align-items-center" style="cursor:pointer; padding:6px 12px; border-radius:10px; background:var(--card-white); border:1px solid rgba(74,44,17,0.06);">
                <i class="bi bi-person-circle" style="font-size:1.5rem; color:var(--amber-cream);"></i>
                <span class="ml-2" style="font-weight:500; font-size:0.85rem;">Admin</span>
            </div>
			</div>
		</div>

		<!-- QUICK ACTION - RAPI & TIDAK BERDEMPET -->
		<div class="row mb-4 fade-in">
			<div class="col-12">
				<div class="d-flex flex-wrap" style="gap: 10px;">
					<a href="<?= base_url('admin/transaksi'); ?>" class="quick-action-btn" style="padding: 10px 20px;">
						<i class="bi bi-arrow-repeat"></i> Refresh
					</a>
					<a href="<?= base_url('admin/transaksi/export_excel'); ?>" class="quick-action-btn btn-excel" style="padding: 10px 20px;" onclick="return confirm('Download laporan Excel?')">
						<i class="bi bi-file-earmark-excel-fill"></i> Export Excel
					</a>
					<a href="<?= base_url('admin/transaksi/export_pdf'); ?>" class="quick-action-btn btn-pdf" style="padding: 10px 20px;" onclick="return confirm('Download laporan PDF?')">
						<i class="bi bi-file-earmark-pdf-fill"></i> Export PDF
					</a>
					<a href="#" class="quick-action-btn btn-print" style="padding: 10px 20px;" onclick="window.print(); return false;">
						<i class="bi bi-printer-fill"></i> Print
					</a>
				</div>
			</div>
		</div>

		<!-- STATISTIK CARDS -->
		<div class="row mb-4">
			<div class="col-xl-3 col-lg-6 col-6 mb-3">
				<div class="stat-card fade-in">
					<div class="stat-icon" style="background: #FEF3C7; color: #92400E;"><i class="bi bi-clock"></i></div>
					<div class="stat-title">Pending</div>
					<div class="stat-number"><?= $count_pending ?? 0; ?></div>
					<div class="stat-footer"><span class="trend-up"><i class="bi bi-arrow-up"></i> <?= $count_pending ?? 0; ?></span> menunggu verifikasi</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-6 col-6 mb-3">
				<div class="stat-card fade-in">
					<div class="stat-icon" style="background: #DBEAFE; color: #1E40AF;"><i class="bi bi-spinner"></i></div>
					<div class="stat-title">Diproses</div>
					<div class="stat-number"><?= $count_diproses ?? 0; ?></div>
					<div class="stat-footer"><span class="trend-up"><i class="bi bi-arrow-up"></i> <?= $count_diproses ?? 0; ?></span> sedang diproses</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-6 col-6 mb-3">
				<div class="stat-card fade-in">
					<div class="stat-icon" style="background: #EDE9FE; color: #5B21B6;"><i class="bi bi-truck"></i></div>
					<div class="stat-title">Dikirim</div>
					<div class="stat-number"><?= $count_dikirim ?? 0; ?></div>
					<div class="stat-footer"><span class="trend-up"><i class="bi bi-arrow-up"></i> <?= $count_dikirim ?? 0; ?></span> dalam perjalanan</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-6 col-6 mb-3">
				<div class="stat-card fade-in">
					<div class="stat-icon" style="background: #D1FAE5; color: #065F46;"><i class="bi bi-check-circle"></i></div>
					<div class="stat-title">Selesai</div>
					<div class="stat-number"><?= $count_selesai ?? 0; ?></div>
					<div class="stat-footer"><span class="trend-up"><i class="bi bi-arrow-up"></i> <?= $count_selesai ?? 0; ?></span> transaksi selesai</div>
				</div>
			</div>
		</div>

		<!-- TABEL TRANSAKSI -->
		<div class="custom-card fade-in">
			<div class="card-header-custom">
				<h6><i class="bi bi-receipt"></i> Daftar Transaksi</h6>
				<span class="badge" style="background:var(--bg-cream); color:var(--text-secondary); font-weight:600; padding:6px 14px; border-radius:20px;">
					<i class="bi bi-database"></i> <?= count($transaksi ?? []); ?> transaksi
				</span>
			</div>
			<div class="card-body-custom">
				<div class="table-responsive">
					<table class="table table-custom">
						<thead>
							<tr>
								<th>ID</th>
								<th>Pembeli</th>
								<th>Total</th>
								<th>Status Pesanan</th>
								<th>Status Bayar</th>
								<th>Metode</th>
								<th>Tanggal</th>
								<th class="text-center">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($transaksi)): ?>
								<?php foreach ($transaksi as $t): ?>
									<tr>
										<td><span class="font-weight-bold" style="color:var(--dark-coffee);">#<?= $t['id_transaksi']; ?></span></td>
										<td>
											<div class="d-flex align-items-center gap-2">
												<div class="avatar-circle"><?= strtoupper(substr($t['nama_pembeli'] ?? 'G', 0, 1)); ?></div>
												<span><?= $t['nama_pembeli'] ?? 'Guest'; ?></span>
											</div>
										</td>
										<td><span class="font-weight-bold" style="color:var(--roasted-brown);">Rp <?= number_format($t['grand_total'] ?? 0, 0, ',', '.'); ?></span></td>
										<td>
											<?php
											$status = strtolower($t['status_pesanan'] ?? 'pending');
											$class = 'pending';
											if ($status == 'selesai' || $status == 'complete') $class = 'complete';
											elseif ($status == 'dikirim' || $status == 'delivery') $class = 'delivery';
											elseif ($status == 'diproses' || $status == 'processing') $class = 'processing';
											elseif ($status == 'batal' || $status == 'cancelled') $class = 'cancelled';
											?>
											<span class="status-badge <?= $class; ?>">
												<?= $t['status_pesanan'] ?? 'Pending'; ?>
											</span>
										</td>
										<td>
											<?php
											$bayar = strtolower($t['status_bayar'] ?? 'pending');
											$bayar_class = ($bayar == 'lunas' || $bayar == 'paid') ? 'complete' : (($bayar == 'batal' || $bayar == 'cancelled') ? 'cancelled' : 'pending');
											?>
											<span class="status-badge <?= $bayar_class; ?>">
												<?= $t['status_bayar'] ?? 'Pending'; ?>
											</span>
										</td>
										<td><?= $t['metode_bayar'] ?? 'Transfer'; ?></td>
										<td><span style="font-size:0.8rem; color:var(--text-secondary);"><?= date('d/m/Y', strtotime($t['tanggal_transaksi'] ?? date('Y-m-d'))); ?></span></td>
										<td class="text-center">
											<a href="<?= base_url('admin/transaksi/detail/' . $t['id_transaksi']); ?>"
												class="btn-detail-transaksi">
												<i class="bi bi-eye"></i> Detail
											</a>
										</td>
									</tr>
								<?php endforeach; ?>
							<?php else: ?>
								<tr>
									<td colspan="8" class="text-center py-5 text-muted">
										<i class="bi bi-inbox" style="font-size:3rem; display:block; margin-bottom:12px; opacity:0.3;"></i>
										<h6 style="font-weight:600;">Belum ada transaksi</h6>
										<p style="font-size:0.85rem;">Transaksi akan muncul di sini setelah ada pembelian</p>
									</td>
								</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<!-- SCRIPTS -->
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	<script>
		// ==========================================
		// 1. SIDEBAR TOGGLE
		// ==========================================
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

		document.addEventListener('click', function(e) {
			if (window.innerWidth > 991.98) return;
			if (!sidebar.contains(e.target) && toggleBtn && !toggleBtn.contains(e.target)) {
				if (sidebar.classList.contains('open')) toggleSidebar();
			}
		});

		// ==========================================
		// 2. NOTIFICATION DROPDOWN
		// ==========================================
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

		// ==========================================
		// 3. MARK ALL READ
		// ==========================================
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

		console.log('✅ Halaman Manajemen Transaksi siap digunakan!');
		console.log('📋 Data transaksi dari database real-time');
	</script>
</body>

</html>
