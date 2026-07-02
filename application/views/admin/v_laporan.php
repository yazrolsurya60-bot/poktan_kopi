<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Laporan & Analisis - Sistem Supply Chain Kopi</title>
	<meta name="description" content="Dashboard laporan dan analisis sistem supply chain kopi Poktan Liberchain">
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

		/* --- SIDEBAR --- */
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
			text-decoration: none;
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

		/* --- NOTIF BELL --- */
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

		/* --- NOTIF DROPDOWN --- */
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

		.notif-item-drop {
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

		.notif-item-drop:hover {
			background: var(--bg-cream);
			text-decoration: none;
			color: inherit;
		}

		.notif-item-drop .notif-icon {
			width: 36px;
			height: 36px;
			min-width: 36px;
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 0.9rem;
		}

		.notif-icon.success {
			background: #D1FAE5;
			color: #065F46;
		}

		.notif-icon.warning {
			background: #FEF3C7;
			color: #92400E;
		}

		.notif-icon.info {
			background: #DBEAFE;
			color: #1E40AF;
		}

		.notif-icon.danger {
			background: #FEE2E2;
			color: #991B1B;
		}

		/* --- KPI STAT BOX --- */
		.stat-box {
			background: var(--card-white);
			border: 1px solid rgba(74, 44, 17, 0.06);
			border-radius: var(--radius-card);
			padding: 22px 24px;
			position: relative;
			box-shadow: var(--shadow-soft);
			transition: var(--transition-smooth);
			overflow: hidden;
			min-height: 180px;
			display: flex;
			flex-direction: column;
			justify-content: space-between;
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
			margin-bottom: 4px;
		}

		.stat-num {
			font-size: 1.7rem;
			font-weight: 700;
			margin-top: 8px;
			margin-bottom: 12px;
			color: var(--dark-coffee);
			line-height: 1.3;
			word-break: break-word;
		}

		.stat-change {
			font-size: 0.75rem;
			font-weight: 600;
			margin-top: 8px;
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
			padding: 18px 24px 12px;
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
			padding: 20px 24px 24px;
		}

		/* --- CHART --- */
		.chart-container {
			position: relative;
			height: 300px;
			width: 100%;
		}

		.chart-container-sm {
			position: relative;
			height: 200px;
			width: 100%;
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
			padding: 10px 8px;
			background: #FDFAF6;
		}

		.table-custom tbody td {
			padding: 10px 8px;
			border-bottom: 1px solid rgba(74, 44, 17, 0.04);
			vertical-align: middle;
		}

		.table-custom tbody tr:hover {
			background: rgba(250, 246, 240, 0.5);
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

		.status-badge.diproses {
			background: #DBEAFE;
			color: #1E40AF;
		}

		.status-badge.dikirim {
			background: #EDE9FE;
			color: #5B21B6;
		}

		.status-badge.selesai {
			background: #D1FAE5;
			color: #065F46;
		}

		.status-badge.dibatalkan {
			background: #FEE2E2;
			color: #991B1B;
		}

		.status-badge.active {
			background: #D1FAE5;
			color: #065F46;
		}

		.status-badge.inactive {
			background: #F3F4F6;
			color: #6B7280;
		}

		/* --- TAB LAPORAN --- */
		.laporan-tabs {
			background: var(--card-white);
			border-radius: var(--radius-card);
			border: 1px solid rgba(74, 44, 17, 0.06);
			box-shadow: var(--shadow-soft);
			margin-bottom: 24px;
			overflow: hidden;
		}

		.laporan-tabs .nav-tabs {
			border-bottom: 1px solid rgba(74, 44, 17, 0.08);
			padding: 0 16px;
			background: #FDFAF6;
			flex-wrap: nowrap;
			overflow-x: auto;
		}

		.laporan-tabs .nav-tabs .nav-link {
			color: var(--text-secondary);
			font-weight: 600;
			font-size: 0.82rem;
			padding: 14px 16px;
			border: none;
			border-bottom: 3px solid transparent;
			border-radius: 0;
			white-space: nowrap;
			transition: var(--transition-smooth);
		}

		.laporan-tabs .nav-tabs .nav-link:hover {
			color: var(--roasted-brown);
			border-bottom-color: rgba(230, 161, 92, 0.3);
			background: transparent;
		}

		.laporan-tabs .nav-tabs .nav-link.active {
			color: var(--roasted-brown);
			border-bottom: 3px solid var(--amber-cream);
			background: transparent;
			font-weight: 700;
		}

		.laporan-tabs .tab-content {
			padding: 24px;
		}

		/* --- EXPORT BUTTONS --- */
		.btn-export-excel {
			background: #065F46;
			color: white;
			border: none;
			border-radius: 10px;
			padding: 8px 16px;
			font-size: 0.82rem;
			font-weight: 600;
			transition: var(--transition-smooth);
			text-decoration: none;
			display: inline-flex;
			align-items: center;
			gap: 6px;
		}

		.btn-export-excel:hover {
			background: #047857;
			color: white;
			text-decoration: none;
			transform: translateY(-1px);
			box-shadow: 0 4px 12px rgba(6, 95, 70, 0.3);
		}

		.btn-print-pdf {
			background: #991B1B;
			color: white;
			border: none;
			border-radius: 10px;
			padding: 8px 16px;
			font-size: 0.82rem;
			font-weight: 600;
			transition: var(--transition-smooth);
			text-decoration: none;
			display: inline-flex;
			align-items: center;
			gap: 6px;
		}

		.btn-print-pdf:hover {
			background: #B91C1C;
			color: white;
			text-decoration: none;
			transform: translateY(-1px);
			box-shadow: 0 4px 12px rgba(153, 27, 27, 0.3);
		}

		/* --- RANK BADGE --- */
		.rank-badge {
			width: 28px;
			height: 28px;
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 0.75rem;
			font-weight: 700;
		}

		.rank-badge.gold {
			background: var(--amber-cream);
			color: white;
		}

		.rank-badge.silver {
			background: #9CA3AF;
			color: white;
		}

		.rank-badge.bronze {
			background: #B45309;
			color: white;
		}

		.rank-badge.other {
			background: var(--bg-cream);
			color: var(--text-secondary);
		}

		/* --- KEUANGAN SUMMARY --- */
		.keu-summary-card {
			border-radius: 10px;
			padding: 18px 20px;
			border-left: 4px solid;
			margin-bottom: 8px;
		}

		.keu-summary-card.pendapatan {
			border-color: #10b981;
			background: #F0FDF4;
		}

		.keu-summary-card.pengeluaran {
			border-color: #EF4444;
			background: #FEF2F2;
		}

		.keu-summary-card.laba {
			border-color: var(--amber-cream);
			background: #FFF7ED;
		}

		/* --- STOK INDICATOR --- */
		.stok-bar {
			height: 6px;
			border-radius: 3px;
			background: rgba(74, 44, 17, 0.08);
			margin-top: 4px;
		}

		.stok-bar-fill {
			height: 100%;
			border-radius: 3px;
			transition: width 0.5s ease;
		}

		/* --- SIDEBAR OVERLAY --- */
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

			.laporan-tabs .nav-tabs {
				flex-wrap: nowrap;
				overflow-x: auto;
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

			.stat-num {
				font-size: 1.3rem;
			}

			.stat-box {
				padding: 16px 18px;
				min-height: 160px;
			}
		}

		/* SCROLLBAR */
		.sidebar-menu-wrapper::-webkit-scrollbar,
		.notif-dropdown-list::-webkit-scrollbar,
		.laporan-tabs .nav-tabs::-webkit-scrollbar {
			width: 3px;
			height: 3px;
		}

		.sidebar-menu-wrapper::-webkit-scrollbar-thumb,
		.notif-dropdown-list::-webkit-scrollbar-thumb,
		.laporan-tabs .nav-tabs::-webkit-scrollbar-thumb {
			background: rgba(230, 161, 92, 0.3);
			border-radius: 10px;
		}


		/* ============================================ */
		/* ═══════════════════════════════════════════════ */
		/* TAMBAHAN CSS UNTUK USER PROFILE SAJA          */
		/* ═══════════════════════════════════════════════ */
		/* ============================================ */

		/* --- HEADER RIGHT - KONTAINER USER & NOTIF --- */
		.header-right {
			display: flex;
			align-items: center;
			gap: 12px;
			flex-shrink: 0;
		}

		/* --- USER BADGE UTAMA --- */
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

		/* --- ICON USER --- */
		.user-badge i {
			font-size: 1.4rem;
			color: var(--amber-cream);
			flex-shrink: 0;
		}

		/* --- NAMA USER --- */
		.user-badge .user-name {
			font-weight: 600;
			font-size: 0.82rem;
			color: var(--dark-coffee);
			line-height: 1.2;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
		}

		/* --- ROLE USER --- */
		.user-badge .user-role {
			font-size: 0.6rem;
			color: var(--text-secondary);
			text-transform: uppercase;
			letter-spacing: 0.5px;
			white-space: nowrap;
		}

		/* --- RESPONSIVE USER BADGE --- */
		@media (max-width: 991.98px) {
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
		}

		@media (max-width: 575.98px) {
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
				<li class="menu-item">
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
				<li class="menu-item active">
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
				<button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle" style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
					<i class="bi bi-list"></i>
				</button>
				<h2 class="d-inline-block align-middle mb-0">Analisis & Laporan</h2>
				<p class="subtitle mb-0 mt-1">Ringkasan data bisnis dan analitik </p>
			</div>
			<div class="d-flex align-items-center flex-wrap mt-2 mt-md-0" style="gap: 10px;">
				<!-- Tombol Export -->
				<a href="<?= base_url('admin/laporan/export_excel?tab=penjualan'); ?>" id="btnExcelHeader" class="btn-export-excel" target="_blank">
					<i class="bi bi-file-earmark-excel-fill"></i> Export Excel
				</a>
				<!-- Dropdown Pilih Poktan untuk Cetak PDF -->
				<div class="dropdown" id="dropdownPdfWrap">
					<button class="btn-print-pdf dropdown-toggle" type="button" id="dropdownPdfBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor:pointer;">
						<i class="bi bi-printer-fill"></i> Cetak PDF
					</button>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownPdfBtn" style="min-width:230px; border-radius:10px; box-shadow:0 8px 24px rgba(44,24,8,0.15); border:none; padding:8px;">
						<div style="font-size:0.72rem; font-weight:700; color:#70655E; text-transform:uppercase; letter-spacing:0.5px; padding:4px 12px 8px;">Pilih Kelompok Tani</div>
						<a class="dropdown-item pdf-poktan-link" href="#" data-poktan="1"
						   style="border-radius:8px; font-size:0.83rem; padding:8px 12px;">
							<i class="bi bi-geo-alt-fill mr-1" style="color:#8B4513;"></i>
							<b>Kel. Tani Harum Manis</b><br>
							<small style="color:#888; margin-left:18px;">Desa Sempadian, Tekarang</small>
						</a>
						<a class="dropdown-item pdf-poktan-link" href="#" data-poktan="2"
						   style="border-radius:8px; font-size:0.83rem; padding:8px 12px; margin-top:4px;">
							<i class="bi bi-geo-alt-fill mr-1" style="color:#8B4513;"></i>
							<b>Kel. Tani Batu Layar Sejahtera</b><br>
							<small style="color:#888; margin-left:18px;">Desa Sendoyan, Sejangkung</small>
						</a>
					</div>
				</div>

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
											<span class="notif-time"><?= date('d M Y, H:i', strtotime($n['tanggal_buat'])); ?></span>
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
				$nama = $this->session->userdata('nama') ?? 'User';
				$role = $this->session->userdata('role') ?? 'Member';
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

		<!-- KPI CARDS -->
		<?php $kpi = $kpi ?? []; ?>
		<div class="row mb-4">
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="stat-box">
					<div class="stat-decoration"></div>
					<div class="stat-title">Total Pendapatan</div>
					<h3 class="stat-num">Rp <?= number_format($kpi['total_pendapatan'] ?? 0, 0, ',', '.'); ?></h3>
					<div class="stat-change up"><i class="bi bi-arrow-up"></i> Akumulasi seluruh penjualan</div>
					<div class="stat-badge" style="background:var(--amber-cream); color:white;"><i class="bi bi-cash-coin"></i></div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="stat-box">
					<div class="stat-decoration"></div>
					<div class="stat-title">Volume Penjualan</div>
					<h3 class="stat-num"><?= number_format($kpi['volume_penjualan'] ?? 0, 0, ',', '.'); ?> kg</h3>
					<div class="stat-change up"><i class="bi bi-arrow-up"></i> Total kopi terjual</div>
					<div class="stat-badge"><i class="bi bi-basket-fill"></i></div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="stat-box">
					<div class="stat-decoration"></div>
					<div class="stat-title">Laba Bersih (Est.)</div>
					<h3 class="stat-num">Rp <?= number_format($kpi['laba_bersih'] ?? 0, 0, ',', '.'); ?></h3>
					<div class="stat-change up"><i class="bi bi-arrow-up"></i> Estimasi 30% dari pendapatan</div>
					<div class="stat-badge" style="background:#D1FAE5; color:#065F46;"><i class="bi bi-graph-up-arrow"></i></div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="stat-box">
					<div class="stat-decoration"></div>
					<div class="stat-title">Total Transaksi</div>
					<h3 class="stat-num"><?= number_format($kpi['total_transaksi'] ?? 0, 0, ',', '.'); ?></h3>
					<div class="stat-change up"><i class="bi bi-arrow-up"></i> Semua status pesanan</div>
					<div class="stat-badge"><i class="bi bi-receipt-cutoff"></i></div>
				</div>
			</div>
		</div>

		<!-- TAB NAVIGASI LAPORAN -->
		<div class="laporan-tabs">
			<ul class="nav nav-tabs" id="laporanTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="tab-ringkasan" data-toggle="tab" href="#ringkasan" role="tab" data-tab="ringkasan">
						<i class="bi bi-bar-chart-line-fill mr-1"></i> Ringkasan
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="tab-penjualan" data-toggle="tab" href="#penjualan" role="tab" data-tab="penjualan">
						<i class="bi bi-cart-fill mr-1"></i> Penjualan
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="tab-petani" data-toggle="tab" href="#petani-tab" role="tab" data-tab="petani">
						<i class="bi bi-person-badge-fill mr-1"></i> Petani
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="tab-produk" data-toggle="tab" href="#produk" role="tab" data-tab="produk">
						<i class="bi bi-box-seam-fill mr-1"></i> Produk
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="tab-keuangan" data-toggle="tab" href="#keuangan" role="tab" data-tab="keuangan">
						<i class="bi bi-wallet2 mr-1"></i> Keuangan
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="tab-panen" data-toggle="tab" href="#panen" role="tab" data-tab="panen">
						<i class="bi bi-tree-fill mr-1"></i> Panen
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="tab-tracking" data-toggle="tab" href="#tracking" role="tab" data-tab="tracking">
						<i class="bi bi-truck mr-1"></i> Tracking
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="tab-mitra" data-toggle="tab" href="#mitra" role="tab" data-tab="mitra">
						<i class="bi bi-shop mr-1"></i> Mitra
					</a>
				</li>
			</ul>

			<div class="tab-content" id="laporanTabContent">

				<!-- TAB RINGKASAN -->
				<div class="tab-pane fade show active" id="ringkasan" role="tabpanel">
					<div class="row">
						<!-- Grafik Penjualan Bulanan -->
						<div class="col-lg-8 mb-4">
							<div class="custom-card">
								<div class="card-header-custom">
									<h6><i class="bi bi-graph-up-arrow text-warning mr-2"></i> Grafik Penjualan Bulanan</h6>
									<div>
										<select id="chartTypeToggle" class="form-control form-control-sm d-inline-block" style="width:auto; font-size:0.8rem; border-color:rgba(74,44,17,0.1);">
											<option value="pendapatan">Pendapatan (Rp)</option>
											<option value="volume">Volume (Kg)</option>
										</select>
									</div>
								</div>
								<div class="card-body-custom">
									<div class="chart-container">
										<canvas id="chartPenjualanBulanan"></canvas>
									</div>
								</div>
							</div>
						</div>
						<!-- Grafik Produk Terlaris (Doughnut) -->
						<div class="col-lg-4 mb-4">
							<div class="custom-card h-100">
								<div class="card-header-custom">
									<h6><i class="bi bi-trophy-fill text-warning mr-2"></i> Produk Terlaris</h6>
									<span class="badge" style="background:#D1FAE5; color:#065F46;">Top 5</span>
								</div>
								<div class="card-body-custom">
									<div class="chart-container-sm">
										<canvas id="chartProdukTerlaris"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Statistik -->
					<div class="row">
						<div class="col-md-3 col-6 mb-3">
							<div class="p-3 rounded" style="background:#FFF7ED; border:1px solid rgba(230,161,92,0.2);">
								<div class="stat-title">Petani Aktif</div>
								<h4 class="font-weight-bold mt-1 mb-0" style="color:var(--dark-coffee);"><?= $kpi['total_petani'] ?? 0; ?></h4>
							</div>
						</div>
						<div class="col-md-3 col-6 mb-3">
							<div class="p-3 rounded" style="background:#F0FDF4; border:1px solid rgba(16,185,129,0.2);">
								<div class="stat-title">Mitra Aktif</div>
								<h4 class="font-weight-bold mt-1 mb-0" style="color:var(--dark-coffee);"><?= $kpi['total_mitra'] ?? 0; ?></h4>
							</div>
						</div>
						<div class="col-md-3 col-6 mb-3">
							<div class="p-3 rounded" style="background:#EFF6FF; border:1px solid rgba(59,130,246,0.2);">
								<div class="stat-title">Rata-rata Transaksi</div>
								<h4 class="font-weight-bold mt-1 mb-0" style="color:var(--dark-coffee);">Rp <?= number_format($kpi['rata_transaksi'] ?? 0, 0, ',', '.'); ?></h4>
							</div>
						</div>
						<div class="col-md-3 col-6 mb-3">
							<div class="p-3 rounded" style="background:#FEF2F2; border:1px solid rgba(239,68,68,0.2);">
								<div class="stat-title">Status Transaksi</div>
								<?php $tr = $tracking ?? [];
								$stat = $tr['statistik'] ?? []; ?>
								<h4 class="font-weight-bold mt-1 mb-0" style="color:var(--dark-coffee);"><?= $tr['total'] ?? 0; ?></h4>
							</div>
						</div>
					</div>
				</div>

				<!-- TAB PENJUALAN -->
				<div class="tab-pane fade" id="penjualan" role="tabpanel">
					<form method="POST" action="<?= base_url('admin/laporan/filter'); ?>" class="mb-3 d-flex align-items-center flex-wrap" style="gap:10px;">
						<div class="d-flex align-items-center" style="gap:8px;">
							<label class="mb-0 font-weight-600" style="font-size:0.85rem; font-weight:600;">Filter Status:</label>
							<select name="status" class="form-control form-control-sm" style="width:auto; border-color:rgba(74,44,17,0.1); font-size:0.85rem;" onchange="this.form.submit()">
								<option value="semua" <?= ($filter_status ?? '') == 'semua' || ($filter_status ?? '') == '' ? 'selected' : ''; ?>>Semua Status</option>
								<option value="Pending" <?= ($filter_status ?? '') == 'Pending'    ? 'selected' : ''; ?>>Pending</option>
								<option value="Diproses" <?= ($filter_status ?? '') == 'Diproses'   ? 'selected' : ''; ?>>Diproses</option>
								<option value="Dikirim" <?= ($filter_status ?? '') == 'Dikirim'    ? 'selected' : ''; ?>>Dikirim</option>
								<option value="Selesai" <?= ($filter_status ?? '') == 'Selesai'    ? 'selected' : ''; ?>>Selesai</option>
								<option value="Dibatalkan" <?= ($filter_status ?? '') == 'Dibatalkan' ? 'selected' : ''; ?>>Dibatalkan</option>
							</select>
						</div>
						<a href="<?= base_url('admin/laporan'); ?>" class="btn btn-sm" style="background:var(--bg-cream); border:1px solid rgba(74,44,17,0.1); color:var(--text-secondary); border-radius:8px; font-size:0.82rem;">
							<i class="bi bi-arrow-counterclockwise mr-1"></i> Reset
						</a>
					</form>

					<div class="table-responsive">
						<table class="table table-custom mb-0">
							<thead>
								<tr>
									<th>#</th>
									<th>ID Transaksi</th>
									<th>Pembeli / Mitra</th>
									<th>Produk</th>
									<th>Jml (Kg)</th>
									<th>Total</th>
									<th>Metode Bayar</th>
									<th>Status</th>
									<th>Tanggal</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($penjualan)): ?>
									<?php foreach ($penjualan as $i => $p): ?>
										<?php
										$status_raw = strtolower($p['status_pesanan'] ?? 'pending');
										$status_class = in_array($status_raw, ['pending', 'diproses', 'dikirim', 'selesai', 'dibatalkan']) ? $status_raw : 'pending';
										?>
										<tr>
											<td><?= $i + 1; ?></td>
											<td><span class="font-weight-bold" style="color:var(--roasted-brown);"><?= htmlspecialchars($p['id_transaksi'] ?? 'TRX-' . str_pad($p['id_transaksi'] ?? ($i + 1), 3, '0', STR_PAD_LEFT)); ?></span></td>
											<td><?= htmlspecialchars($p['nama_pembeli'] ?? '-'); ?></td>
											<td><?= htmlspecialchars($p['nama_produk'] ?? '-'); ?></td>
											<td><?= number_format($p['jumlah_kg'] ?? 0, 0, ',', '.'); ?> kg</td>
											<td class="font-weight-bold">Rp <?= number_format($p['total_harga'] ?? 0, 0, ',', '.'); ?></td>
											<td><?= htmlspecialchars($p['metode_bayar'] ?? '-'); ?></td>
											<td><span class="status-badge <?= $status_class; ?>"><?= htmlspecialchars($p['status_pesanan'] ?? 'Pending'); ?></span></td>
											<td><?= isset($p['tanggal']) ? date('d/m/Y', strtotime($p['tanggal'])) : '-'; ?></td>
										</tr>
									<?php endforeach; ?>
								<?php else: ?>
									<tr>
										<td colspan="9" class="text-center py-4 text-muted">Belum ada data penjualan</td>
									</tr>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>

				<!-- TAB PETANI -->
				<div class="tab-pane fade" id="petani-tab" role="tabpanel">
					<div class="table-responsive">
						<table class="table table-custom mb-0">
							<thead>
								<tr>
									<th>Rank</th>
									<th>Nama Petani</th>
									<th>Status</th>
									<th>Lahan Aktif</th>
									<th>Total Panen (Kg)</th>
									<th>Omset</th>
									<th>Bergabung</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($petani)): ?>
									<?php foreach ($petani as $i => $p): ?>
										<?php $rankClass = $i == 0 ? 'gold' : ($i == 1 ? 'silver' : ($i == 2 ? 'bronze' : 'other')); ?>
										<tr>
											<td>
												<div class="rank-badge <?= $rankClass; ?>">
													<?php if ($i == 0): ?><i class="bi bi-trophy-fill" style="font-size:0.7rem;"></i>
													<?php elseif ($i == 1): ?><i class="bi bi-award-fill" style="font-size:0.7rem;"></i>
													<?php elseif ($i == 2): ?><i class="bi bi-award" style="font-size:0.7rem;"></i>
														<?php else: ?><?= $i + 1; ?><?php endif; ?>
												</div>
											</td>
											<td class="font-weight-bold"><?= htmlspecialchars($p['nama_petani']); ?></td>
											<td><span class="status-badge <?= strtolower($p['status_petani'] ?? 'pending'); ?>"><?= $p['status_petani'] ?? '-'; ?></span></td>
											<td><?= $p['lahan_aktif'] ?? 0; ?> lahan</td>
											<td class="font-weight-bold"><?= number_format($p['total_panen'] ?? 0, 0, ',', '.'); ?> kg</td>
											<td>Rp <?= number_format($p['omset'] ?? 0, 0, ',', '.'); ?></td>
											<td><?= isset($p['tanggal_daftar']) ? date('d/m/Y', strtotime($p['tanggal_daftar'])) : '-'; ?></td>
										</tr>
									<?php endforeach; ?>
								<?php else: ?>
									<tr>
										<td colspan="7" class="text-center py-4 text-muted">Belum ada data petani</td>
									</tr>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>

				<!-- TAB PRODUK -->
				<div class="tab-pane fade" id="produk" role="tabpanel">
					<div class="table-responsive">
						<table class="table table-custom mb-0">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama Produk</th>
									<th>Jenis</th>
									<th>Harga/Kg</th>
									<th>Stok</th>
									<th>Total Terjual</th>
									<th>Pendapatan</th>
									<th>Status Stok</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($produk)): ?>
									<?php foreach ($produk as $i => $pr): ?>
										<?php
										$stok = $pr['stok_produk'] ?? 0;
										$stokPct = min(100, ($stok / 200) * 100);
										$stokColor = $stok < 20 ? '#EF4444' : ($stok < 50 ? '#F59E0B' : '#10b981');
										$stokLabel = $pr['status'] ?? ($stok < 20 ? 'Stok Sedikit' : 'Tersedia');
										$stokClass = $stok < 20 ? 'dibatalkan' : 'selesai';
										?>
										<tr>
											<td><?= $i + 1; ?></td>
											<td class="font-weight-bold"><?= htmlspecialchars($pr['nama_produk'] ?? '-'); ?></td>
											<td><?= htmlspecialchars($pr['jenis'] ?? '-'); ?></td>
											<td>Rp <?= number_format($pr['harga'] ?? 0, 0, ',', '.'); ?></td>
											<td>
												<span class="font-weight-bold"><?= $stok; ?> kg</span>
												<div class="stok-bar">
													<div class="stok-bar-fill" style="width:<?= $stokPct; ?>%; background:<?= $stokColor; ?>;"></div>
												</div>
											</td>
											<td><?= number_format($pr['total_terjual'] ?? 0, 0, ',', '.'); ?> kg</td>
											<td>Rp <?= number_format($pr['pendapatan'] ?? 0, 0, ',', '.'); ?></td>
											<td><span class="status-badge <?= $stokClass; ?>"><?= $stokLabel; ?></span></td>
										</tr>
									<?php endforeach; ?>
								<?php else: ?>
									<tr>
										<td colspan="8" class="text-center py-4 text-muted">Belum ada data produk</td>
									</tr>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>

				<!-- TAB KEUANGAN -->
				<div class="tab-pane fade" id="keuangan" role="tabpanel">
					<?php $keu = $keuangan ?? []; ?>
					<div class="row mb-4">
						<div class="col-md-4 mb-3">
							<div class="keu-summary-card pendapatan">
								<div class="stat-title" style="color:#065F46;">Pendapatan Kotor</div>
								<h3 class="font-weight-bold mb-0 mt-1" style="color:#065F46;">Rp <?= number_format($keu['pendapatan_kotor'] ?? 0, 0, ',', '.'); ?></h3>
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="keu-summary-card pengeluaran">
								<div class="stat-title" style="color:#991B1B;">Estimasi Biaya</div>
								<h3 class="font-weight-bold mb-0 mt-1" style="color:#991B1B;">Rp <?= number_format($keu['estimasi_biaya'] ?? 0, 0, ',', '.'); ?></h3>
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="keu-summary-card laba">
								<div class="stat-title" style="color:var(--roasted-brown);">Laba Bersih (Est.)</div>
								<h3 class="font-weight-bold mb-0 mt-1" style="color:var(--roasted-brown);">Rp <?= number_format($keu['laba_bersih'] ?? 0, 0, ',', '.'); ?></h3>
							</div>
						</div>
					</div>
					<div class="custom-card mb-4">
						<div class="card-header-custom">
							<h6><i class="bi bi-graph-up text-warning mr-2"></i> Tren Keuangan Bulanan</h6>
						</div>
						<div class="card-body-custom">
							<div class="chart-container">
								<canvas id="chartKeuangan"></canvas>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-custom mb-0">
							<thead>
								<tr>
									<th>Bulan</th>
									<th>Pendapatan</th>
									<th>Estimasi Biaya</th>
									<th>Laba Bersih</th>
									<th>Margin</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($keu['detail'])): ?>
									<?php foreach ($keu['detail'] as $k): ?>
										<?php $margin = $k['pendapatan'] > 0 ? round(($k['laba'] / $k['pendapatan']) * 100, 1) : 0; ?>
										<tr>
											<td class="font-weight-bold"><?= $k['bulan']; ?></td>
											<td>Rp <?= number_format($k['pendapatan'], 0, ',', '.'); ?></td>
											<td>Rp <?= number_format($k['pengeluaran'], 0, ',', '.'); ?></td>
											<td class="font-weight-bold" style="color:#10b981;">Rp <?= number_format($k['laba'], 0, ',', '.'); ?></td>
											<td><span class="badge" style="background:#D1FAE5; color:#065F46; font-weight:600;"><?= $margin; ?>%</span></td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>

				<!-- TAB PANEN -->
				<div class="tab-pane fade" id="panen" role="tabpanel">
					<div class="table-responsive">
						<table class="table table-custom mb-0">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama Petani</th>
									<th>Lahan</th>
									<th>Jenis Kopi</th>
									<th>Jumlah Panen</th>
									<th>Kualitas</th>
									<th>Tanggal Panen</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($panen)): ?>
									<?php foreach ($panen as $i => $pn): ?>
										<tr>
											<td><?= $i + 1; ?></td>
											<td class="font-weight-bold"><?= htmlspecialchars($pn['nama_petani'] ?? '-'); ?></td>
											<td><?= htmlspecialchars($pn['lahan'] ?? '-'); ?></td>
											<td><?= htmlspecialchars($pn['jenis_kopi'] ?? '-'); ?></td>
											<td class="font-weight-bold"><?= number_format($pn['jumlah_panen'] ?? 0, 0, ',', '.'); ?> kg</td>
											<td>
												<?php $kualitas = $pn['kualitas'] ?? 'Grade A'; ?>
												<span class="status-badge <?= $kualitas == 'Grade A' ? 'selesai' : 'diproses'; ?>"><?= $kualitas; ?></span>
											</td>
											<td><?= isset($pn['tanggal_panen']) ? date('d/m/Y', strtotime($pn['tanggal_panen'])) : '-'; ?></td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>

				<!-- TAB TRACKING -->
				<div class="tab-pane fade" id="tracking" role="tabpanel">
					<?php $trk = $tracking ?? [];
					$trk_stat = $trk['statistik'] ?? []; ?>
					<div class="row mb-4">
						<?php
						$statColors = ['Pending' => '#FEF3C7', 'Diproses' => '#DBEAFE', 'Dikirim' => '#EDE9FE', 'Selesai' => '#D1FAE5', 'Dibatalkan' => '#FEE2E2'];
						$textColors  = ['Pending' => '#92400E', 'Diproses' => '#1E40AF', 'Dikirim' => '#5B21B6', 'Selesai' => '#065F46', 'Dibatalkan' => '#991B1B'];
						foreach ($trk_stat as $stat_key => $stat_val):
						?>
							<div class="col mb-3">
								<div class="text-center p-3 rounded" style="background:<?= $statColors[$stat_key] ?? '#F3F4F6'; ?>;">
									<div class="font-weight-bold" style="font-size:1.5rem; color:<?= $textColors[$stat_key] ?? '#374151'; ?>;"><?= $stat_val; ?></div>
									<small style="color:<?= $textColors[$stat_key] ?? '#374151'; ?>; font-weight:600;"><?= $stat_key; ?></small>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="table-responsive">
						<table class="table table-custom mb-0">
							<thead>
								<tr>
									<th>#</th>
									<th>ID Transaksi</th>
									<th>Kurir</th>
									<th>No. Resi</th>
									<th>Estimasi Tiba</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($trk['log'])): ?>
									<?php foreach ($trk['log'] as $i => $lg): ?>
										<?php $s_class = strtolower(str_replace(' ', '', $lg['status_pesanan'] ?? 'pending')); ?>
										<tr>
											<td><?= $i + 1; ?></td>
											<td class="font-weight-bold" style="color:var(--roasted-brown);"><?= htmlspecialchars($lg['id_transaksi'] ?? '-'); ?></td>
											<td><?= htmlspecialchars($lg['kurir'] ?? '-'); ?></td>
											<td><?= htmlspecialchars($lg['resi'] ?? '-'); ?></td>
											<td><?= htmlspecialchars($lg['estimasi'] ?? '-'); ?></td>
											<td><span class="status-badge <?= in_array($s_class, ['pending', 'diproses', 'dikirim', 'selesai', 'dibatalkan']) ? $s_class : 'diproses'; ?>"><?= htmlspecialchars($lg['status_pesanan'] ?? '-'); ?></span></td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>

				<!-- TAB MITRA -->
				<div class="tab-pane fade" id="mitra" role="tabpanel">
					<div class="table-responsive">
						<table class="table table-custom mb-0">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama Mitra</th>
									<th>Status</th>
									<th>Total Order</th>
									<th>Total Pembelian</th>
									<th>Produk Favorit</th>
									<th>Rating</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($mitra)): ?>
									<?php foreach ($mitra as $i => $m): ?>
										<tr>
											<td><?= $i + 1; ?></td>
											<td class="font-weight-bold"><?= htmlspecialchars($m['nama_mitra'] ?? '-'); ?></td>
											<td><span class="status-badge <?= strtolower($m['status_mitra'] ?? 'active'); ?>"><?= $m['status_mitra'] ?? '-'; ?></span></td>
											<td><?= number_format($m['total_order'] ?? 0, 0, ',', '.'); ?> order</td>
											<td>Rp <?= number_format($m['total_pembelian'] ?? 0, 0, ',', '.'); ?></td>
											<td><?= htmlspecialchars($m['produk_favorit'] ?? '-'); ?></td>
											<td>
												<?php $rating = (int)($m['rating'] ?? 0);
												for ($s = 0; $s < 5; $s++): ?>
													<i class="bi bi-star<?= $s < $rating ? '-fill' : ''; ?>" style="font-size:0.8rem; color:<?= $s < $rating ? 'var(--amber-cream)' : '#D1D5DB'; ?>;"></i>
												<?php endfor; ?>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>

			</div><!-- /tab-content -->
		</div><!-- /laporan-tabs -->
	</div><!-- /main-content -->

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	<script>
		// DATA CHART DARI PHP
		const chartPenjualanData = {
			labels: <?= json_encode($chart_penjualan['labels']     ?? []); ?>,
			pendapatan: <?= json_encode($chart_penjualan['pendapatan'] ?? []); ?>,
			volume: <?= json_encode($chart_penjualan['volume']     ?? []); ?>
		};
		const chartProdukData = {
			labels: <?= json_encode($chart_produk['labels'] ?? []); ?>,
			data: <?= json_encode($chart_produk['data']   ?? []); ?>
		};
		const chartKeuanganData = {
			labels: <?= json_encode(array_column($keuangan['detail'] ?? [], 'bulan'));      ?>,
			pendapatan: <?= json_encode(array_column($keuangan['detail'] ?? [], 'pendapatan')); ?>,
			pengeluaran: <?= json_encode(array_column($keuangan['detail'] ?? [], 'pengeluaran')); ?>,
			laba: <?= json_encode(array_column($keuangan['detail'] ?? [], 'laba'));       ?>
		};

		// 1. GRAFIK PENJUALAN BULANAN
		let chartPenjualan;

		function initChartPenjualan(mode) {
			const ctx = document.getElementById('chartPenjualanBulanan');
			if (!ctx) return;
			const dataset = mode === 'volume' ? chartPenjualanData.volume : chartPenjualanData.pendapatan;
			const label = mode === 'volume' ? 'Volume (Kg)' : 'Pendapatan (Rp)';
			if (chartPenjualan) chartPenjualan.destroy();

			chartPenjualan = new Chart(ctx.getContext('2d'), {
				type: 'line',
				data: {
					labels: chartPenjualanData.labels,
					datasets: [{
						label: label,
						data: dataset,
						borderColor: '#E6A15C',
						backgroundColor: 'rgba(230, 161, 92, 0.08)',
						fill: true,
						tension: 0.4,
						pointBackgroundColor: '#E6A15C',
						pointBorderColor: '#FFFFFF',
						pointBorderWidth: 2,
						pointRadius: 4,
						pointHoverRadius: 7,
						borderWidth: 2.5
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
								label: function(ctx) {
									return mode === 'volume' ? ctx.parsed.y + ' kg' : 'Rp ' + ctx.parsed.y.toLocaleString('id-ID');
								}
							}
						}
					},
					scales: {
						y: {
							beginAtZero: true,
							grid: {
								color: 'rgba(74,44,17,0.06)'
							},
							ticks: {
								font: {
									size: 10
								},
								color: '#70655E',
								callback: function(val) {
									return mode === 'volume' ? val + ' kg' : 'Rp ' + (val / 1000000).toFixed(0) + 'jt';
								}
							}
						},
						x: {
							grid: {
								display: false
							},
							ticks: {
								font: {
									size: 10
								},
								color: '#70655E'
							}
						}
					},
					interaction: {
						intersect: false,
						mode: 'index'
					}
				}
			});
		}

		// 2. CHART PRODUK TERLARIS
		function initChartProduk() {
			const ctx = document.getElementById('chartProdukTerlaris');
			if (!ctx) return;
			new Chart(ctx.getContext('2d'), {
				type: 'doughnut',
				data: {
					labels: chartProdukData.labels,
					datasets: [{
						data: chartProdukData.data,
						backgroundColor: ['#E6A15C', '#4A2C11', '#10b981', '#6B7280', '#DBEAFE'],
						borderColor: '#FFFFFF',
						borderWidth: 3,
						hoverOffset: 6
					}]
				},
				options: {
					responsive: true,
					maintainAspectRatio: false,
					cutout: '65%',
					plugins: {
						legend: {
							position: 'bottom',
							labels: {
								font: {
									size: 10
								},
								boxWidth: 12,
								padding: 8
							}
						},
						tooltip: {
							backgroundColor: '#2C1808',
							titleColor: '#E6A15C',
							bodyColor: '#FAF6F0',
							cornerRadius: 8,
							callbacks: {
								label: function(ctx) {
									if (ctx.label === 'Belum Ada Penjualan') {
										return ctx.label;
									}
									return ctx.label + ': ' + ctx.parsed + ' kg';
								}
							}
						}
					}
				}
			});
		}

		// 3. CHART KEUANGAN
		function initChartKeuangan() {
			const ctx = document.getElementById('chartKeuangan');
			if (!ctx) return;
			new Chart(ctx.getContext('2d'), {
				type: 'bar',
				data: {
					labels: chartKeuanganData.labels,
					datasets: [{
							label: 'Pendapatan',
							data: chartKeuanganData.pendapatan,
							backgroundColor: 'rgba(16, 185, 129, 0.7)',
							borderColor: '#10b981',
							borderWidth: 1,
							borderRadius: 6
						},
						{
							label: 'Biaya',
							data: chartKeuanganData.pengeluaran,
							backgroundColor: 'rgba(239, 68, 68, 0.7)',
							borderColor: '#EF4444',
							borderWidth: 1,
							borderRadius: 6
						},
						{
							label: 'Laba',
							data: chartKeuanganData.laba,
							backgroundColor: 'rgba(230, 161, 92, 0.85)',
							borderColor: '#E6A15C',
							borderWidth: 1,
							borderRadius: 6,
							type: 'line',
							tension: 0.4,
							fill: false,
							pointRadius: 4
						}
					]
				},
				options: {
					responsive: true,
					maintainAspectRatio: false,
					plugins: {
						legend: {
							position: 'top',
							labels: {
								font: {
									size: 10
								}
							}
						},
						tooltip: {
							backgroundColor: '#2C1808',
							titleColor: '#E6A15C',
							bodyColor: '#FAF6F0',
							cornerRadius: 8,
							callbacks: {
								label: function(ctx) {
									return ctx.dataset.label + ': Rp ' + ctx.parsed.y.toLocaleString('id-ID');
								}
							}
						}
					},
					scales: {
						y: {
							beginAtZero: true,
							grid: {
								color: 'rgba(74,44,17,0.06)'
							},
							ticks: {
								font: {
									size: 10
								},
								color: '#70655E',
								callback: function(val) {
									return 'Rp ' + (val / 1000000).toFixed(0) + 'jt';
								}
							}
						},
						x: {
							grid: {
								display: false
							},
							ticks: {
								font: {
									size: 10
								},
								color: '#70655E'
							}
						}
					}
				}
			});
		}

		// OTHER INTERACTIVITY
		const sidebar = document.getElementById('sidebarMenu');
		const overlay = document.getElementById('sidebarOverlay');
		const toggleBtn = document.getElementById('sidebarToggle');
		if (toggleBtn) toggleBtn.addEventListener('click', () => {
			sidebar.classList.toggle('open');
			overlay.classList.toggle('active');
		});
		if (overlay) overlay.addEventListener('click', () => {
			sidebar.classList.remove('open');
			overlay.classList.remove('active');
		});

		const notifToggle = document.getElementById('notifToggle');
		const notifDropdown = document.getElementById('notifDropdown');
		if (notifToggle) notifToggle.addEventListener('click', (e) => {
			e.stopPropagation();
			notifDropdown.classList.toggle('show');
		});
		document.addEventListener('click', (e) => {
			if (notifDropdown && !notifDropdown.contains(e.target) && notifToggle && !notifToggle.contains(e.target)) notifDropdown.classList.remove('show');
		});

		document.querySelectorAll('#laporanTab .nav-link').forEach(link => {
			link.addEventListener('shown.bs.tab', (e) => {
				const tabName = e.target.getAttribute('data-tab') || 'penjualan';
				const btnExcel = document.getElementById('btnExcelHeader');
				if (btnExcel) btnExcel.href = '<?= base_url('admin/laporan/export_excel'); ?>?tab=' + tabName;
				// Simpan tab aktif untuk dropdown PDF
				document.querySelectorAll('.pdf-poktan-link').forEach(function(el) {
					el.setAttribute('data-tab', tabName);
				});
			});
		});

		// Handler dropdown poktan PDF
		document.querySelectorAll('.pdf-poktan-link').forEach(function(el) {
			el.setAttribute('data-tab', 'penjualan'); // default tab
			el.addEventListener('click', function(e) {
				e.preventDefault();
				const poktan = this.getAttribute('data-poktan');
				const tab    = this.getAttribute('data-tab') || 'penjualan';
				const url    = '<?= base_url('admin/laporan/print_pdf'); ?>?tab=' + tab + '&poktan=' + poktan;
				window.open(url, '_blank');
			});
		});

		const chartTypeSelect = document.getElementById('chartTypeToggle');
		if (chartTypeSelect) chartTypeSelect.addEventListener('change', function() {
			initChartPenjualan(this.value);
		});
		$('#tab-keuangan').on('shown.bs.tab', function() {
			initChartKeuangan();
		});

		function updateDateTime() {
			const el = document.getElementById('currentDateTime');
			if (el) el.textContent = new Date().toLocaleDateString('id-ID', {
				weekday: 'long',
				year: 'numeric',
				month: 'long',
				day: 'numeric',
				hour: '2-digit',
				minute: '2-digit'
			});
		}
		updateDateTime();
		setInterval(updateDateTime, 60000);

		document.addEventListener('DOMContentLoaded', function() {
			initChartPenjualan('pendapatan');
			initChartProduk();
		});
		if (document.readyState !== 'loading') {
			initChartPenjualan('pendapatan');
			initChartProduk();
		}
	</script>
</body>

</html>
