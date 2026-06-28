<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ruang Member - Pembeli Kopi</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
		rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
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
			height: 200px;
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

		/* --- TRACKING MAP (M07-F04) --- */
		#trackingMap {
			height: 200px;
			border-radius: 10px;
			overflow: hidden;
			border: 1px solid rgba(74, 44, 17, 0.06);
		}

		/* --- RECOMMENDATION PRODUCTS (M11-F01) --- */
		.rec-product-item {
			display: flex;
			align-items: center;
			gap: 14px;
			padding: 10px 0;
			border-bottom: 1px solid rgba(74, 44, 17, 0.05);
			transition: var(--transition-smooth);
		}

		.rec-product-item:last-child {
			border-bottom: none;
		}

		.rec-product-item:hover {
			padding-left: 8px;
			background: rgba(250, 246, 240, 0.3);
			border-radius: 8px;
		}

		.rec-product-img {
			width: 50px;
			height: 50px;
			border-radius: 10px;
			background: var(--bg-cream);
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 1.5rem;
			color: var(--amber-cream);
		}

		.rec-product-info {
			flex: 1;
		}

		.rec-product-info .name {
			font-weight: 600;
			font-size: 0.85rem;
		}

		.rec-product-info .price {
			font-size: 0.8rem;
			color: var(--amber-cream);
			font-weight: 600;
		}

		.rec-product-info .rating {
			font-size: 0.7rem;
			color: #F59E0B;
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
				height: 180px;
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
						<i class="bi bi-geo-alt-fill"></i>Lacak Pengiriman
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
		<!-- PAGE HEADER -->
		<div class="page-header d-flex justify-content-between align-items-center flex-wrap">
			<div>
				<button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle"
					style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
					<i class="bi bi-list"></i>
				</button>
				<h2 class="d-inline-block align-middle mb-0">Ruang Belanja Member</h2>
				<p class="subtitle mb-0 mt-1">Selamat datang, <span id="memberName"
						style="color: var(--amber-cream); font-weight:600;"><?= $this->session->userdata('nama') ?? 'Pembeli' ?></span>!
					<span id="currentDateTime" style="color: var(--text-secondary); font-size:0.85rem;"></span>
				</p>
			</div>
			<div class="d-flex align-items-center gap-3" style="gap: 12px;">
				<!-- NOTIFICATION BELL (M11-F01) - DINAMIS DARI DATABASE -->
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
							<a href="<?= base_url('pembeli/dashboard/history'); ?>"
								style="font-size:0.75rem; color: var(--amber-cream); font-weight:500; text-decoration:none;">Lihat
								Semua</a>
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
						<div class="p-2 text-center border-top"
							style="background:#FAF6F0; border-color:rgba(74,44,17,0.06);">
							<a href="<?= base_url('pembeli/dashboard/settings'); ?>"
								class="small text-secondary font-weight-bold text-decoration-none">
								<i class="bi bi-gear-fill mr-1"></i> Pengaturan Notifikasi
							</a>
						</div>
					</div>
				</div>
				<!-- USER AVATAR -->
				<div class="d-flex align-items-center gap-2"
					style="cursor: pointer; padding: 6px 12px; border-radius: 10px; background: var(--card-white); border: 1px solid rgba(74,44,17,0.06);">
					<i class="bi bi-person-circle" style="font-size: 1.5rem; color: var(--amber-cream);"></i>
					<span style="font-weight:500; font-size:0.85rem;"><?= $this->session->userdata('nama') ?? 'Pembeli' ?></span>
				</div>
			</div>
		</div>

		<!-- QUICK ACTION BUTTONS (M11-F04) -->
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
		</div>

		<!-- KPI CARDS (TANPA POIN) -->
		<div class="row mb-4">
			<div class="col-lg-4 mb-4">
				<div class="stat-box">
					<div class="stat-decoration"></div>
					<div class="stat-title">Total Transaksi</div>
					<h3 class="stat-num"><?= $kpi_total_transaksi ?? 0; ?></h3>
					<div class="stat-change up"><i class="bi bi-arrow-up"></i> Data real-time</div>
					<div class="stat-badge" style="background: #059669; color: white;"><i class="bi bi-receipt"></i>
					</div>
				</div>
			</div>
			<div class="col-lg-4 mb-4">
				<div class="stat-box">
					<div class="stat-decoration"></div>
					<div class="stat-title">Total Belanja</div>
					<h3 class="stat-num">Rp <?= number_format($kpi_total_belanja ?? 0, 0, ',', '.'); ?></h3>
					<div class="stat-change up"><i class="bi bi-arrow-up"></i> Data real-time</div>
					<div class="stat-badge" style="background: var(--amber-cream); color: white;"><i
							class="bi bi-cash-stack"></i></div>
				</div>
			</div>
			<div class="col-lg-4 mb-4">
				<div class="stat-box">
					<div class="stat-decoration"></div>
					<div class="stat-title">Pengiriman Aktif</div>
					<h3 class="stat-num"><?= $kpi_pesanan_dikirim ?? 0; ?></h3>
					<div class="stat-change up"><i class="bi bi-arrow-up"></i> Data real-time</div>
					<div class="stat-badge" style="background: var(--dark-coffee); color: white;"><i class="bi bi-truck"></i></div>
				</div>
			</div>
		</div>

		<!-- TRACKING MAP & REKOMENDASI -->
		<div class="row">
			<!-- TRACKING PENGIRIMAN (M07-F04) -->
			<div class="col-lg-7 mb-4">
				<div class="custom-card">
					<div class="card-header-custom">
						<h6><i class="bi bi-geo-alt-fill text-success mr-2"></i> Lacak Pengiriman Aktif</h6>
						<span class="badge" style="background: #DBEAFE; color: #1E40AF; font-weight:500;"><?= $kpi_pesanan_dikirim ?? 0; ?>
							dalam perjalanan</span>
					</div>
					<div class="card-body-custom">
						<div id="trackingMap"></div>
						<div class="mt-3 d-flex justify-content-between align-items-center flex-wrap">
							<div>
								<span style="font-weight:600; font-size:0.85rem;">#INV-2026-008</span>
								<span class="status-badge delivery ms-2">Sedang Dikirim</span>
								<div style="font-size:0.75rem; color: var(--text-secondary);">
									<i class="bi bi-truck mr-1"></i> Kurir: Budi Santoso · Estimasi tiba: 30 menit
								</div>
							</div>
							<a href="<?= base_url('pembeli/tracking'); ?>" class="btn btn-sm"
								style="background: var(--bg-cream); color: var(--dark-coffee); border-radius:8px; font-weight:600;">
								Lihat Detail <i class="bi bi-chevron-right"></i>
							</a>
						</div>
					</div>
				</div>
			</div>

			<!-- REKOMENDASI PRODUK (M11-F01) -->
			<div class="col-lg-5 mb-4">
				<div class="custom-card">
					<div class="card-header-custom">
						<h6><i class="bi bi-star-fill text-warning mr-2"></i> Rekomendasi Untuk Anda</h6>
						<span class="badge"
							style="background: var(--bg-cream); color: var(--text-secondary); font-weight:500;">Terpopuler</span>
					</div>
					<div class="card-body-custom" style="padding: 16px 20px;">
						<?php $recommendations = [
							['nama' => 'Liberika Grade A Premium', 'harga' => 'Rp 180.000/kg', 'rating' => '★★★★★', 'terjual' => '285 kg'],
							['nama' => 'Arabika Specialty Single Origin', 'harga' => 'Rp 210.000/kg', 'rating' => '★★★★☆', 'terjual' => '192 kg'],
							['nama' => 'Robusta Grade A', 'harga' => 'Rp 130.000/kg', 'rating' => '★★★★☆', 'terjual' => '156 kg'],
							['nama' => 'Liberika Grade B', 'harga' => 'Rp 125.000/kg', 'rating' => '★★★★', 'terjual' => '98 kg']
						]; ?>
						<?php foreach ($recommendations as $rec): ?>
							<div class="rec-product-item">
								<div class="rec-product-img">
									<i class="bi bi-cup-hot"></i>
								</div>
								<div class="rec-product-info">
									<div class="name"><?= $rec['nama']; ?></div>
									<div class="price"><?= $rec['harga']; ?></div>
									<div class="rating">
										<?= $rec['rating']; ?> <span
											style="color: var(--text-secondary); font-weight:400;">(<?= $rec['terjual']; ?>)</span>
									</div>
								</div>
								<a href="<?= base_url('landing/produk/detail'); ?>" class="btn btn-sm"
									style="background: var(--amber-cream); color: white; border-radius:8px; font-weight:600; padding: 4px 12px; font-size:0.7rem;">
									Beli
								</a>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>

		<!-- RIWAYAT TRANSAKSI -->
		<div class="row">
			<!-- RIWAYAT TRANSAKSI TERBARU (M06-F08) -->
			<div class="col-lg-8 mb-4">
				<div class="custom-card">
					<div class="card-header-custom">
						<h6><i class="bi bi-clock-history text-primary mr-2"></i> Riwayat Transaksi Terbaru</h6>
						<a href="<?= base_url('pembeli/transaksi'); ?>" class="text-muted"
							style="font-size:0.75rem;">Lihat semua <i class="bi bi-chevron-right"></i></a>
					</div>
					<div class="card-body-custom" style="padding:0;">
						<div class="table-responsive">
							<table class="table table-custom mb-0">
								<thead>
									<tr>
										<th>Invoice</th>
										<th>Produk</th>
										<th>Total</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<?php if (!empty($pesanan_terbaru)): ?>
										<?php foreach ($pesanan_terbaru as $trx): ?>
											<tr>
												<td><b>#<?= $trx['id_transaksi']; ?></b></td>
												<td><?= $trx['nama_produk'] ?? 'Produk'; ?></td>
												<td>Rp <?= number_format($trx['total_harga'] ?? 0, 0, ',', '.'); ?></td>
												<td>
													<span class="status-badge <?= strtolower($trx['status_pesanan'] ?? 'pending'); ?>">
														<?= ucfirst($trx['status_pesanan'] ?? 'Pending'); ?>
													</span>
												</td>
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

			<!-- GRAFIK BELANJA BULANAN (M10-F02) -->
			<div class="col-lg-4 mb-4">
				<div class="custom-card">
					<div class="card-header-custom">
						<h6><i class="bi bi-graph-up-arrow text-warning mr-2"></i> Grafik Belanja</h6>
						<span class="badge"
							style="background: var(--bg-cream); color: var(--text-secondary); font-weight:500;">2026</span>
					</div>
					<div class="card-body-custom">
						<div class="chart-container">
							<canvas id="shoppingChart"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- SETTING NOTIFIKASI (M11-F03) - SESUAI ROLE PEMBELI -->
		<div class="row">
			<div class="col-12">
				<div class="custom-card">
					<div class="card-header-custom">
						<h6><i class="bi bi-gear-fill text-secondary mr-2"></i> Preferensi Notifikasi</h6>
						<span class="badge"
							style="background: var(--bg-cream); color: var(--text-secondary); font-weight:500;">Pengaturan</span>
					</div>
					<div class="card-body-custom">
						<?php
						// Default settings untuk Pembeli
						$default_settings = [
							'notif_pesanan' => 1,
							'notif_kurir' => 1,
							'notif_pembayaran' => 1,
							'notif_promo' => 0,
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
								<!-- Status Pesanan -->
								<div class="col-md-3 col-6 mb-2">
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="notif_pesanan" name="notif_pesanan"
											<?= $default_settings['notif_pesanan'] == 1 ? 'checked' : ''; ?>>
										<label class="custom-control-label" for="notif_pesanan"
											style="font-size:0.85rem;">Status Pesanan</label>
									</div>
								</div>
								<!-- Tracking Kiriman -->
								<div class="col-md-3 col-6 mb-2">
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="notif_kurir" name="notif_kurir"
											<?= $default_settings['notif_kurir'] == 1 ? 'checked' : ''; ?>>
										<label class="custom-control-label" for="notif_kurir"
											style="font-size:0.85rem;">Tracking Kiriman</label>
									</div>
								</div>
								<!-- Konfirmasi Bayar -->
								<div class="col-md-3 col-6 mb-2">
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="notif_pembayaran" name="notif_pembayaran"
											<?= $default_settings['notif_pembayaran'] == 1 ? 'checked' : ''; ?>>
										<label class="custom-control-label" for="notif_pembayaran"
											style="font-size:0.85rem;">Konfirmasi Bayar</label>
									</div>
								</div>
								<!-- Promo & Diskon -->
								<div class="col-md-3 col-6 mb-2">
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="notif_promo" name="notif_promo"
											<?= $default_settings['notif_promo'] == 1 ? 'checked' : ''; ?>>
										<label class="custom-control-label" for="notif_promo"
											style="font-size:0.85rem;">Promo & Diskon</label>
									</div>
								</div>
								<!-- Update Sistem -->
								<div class="col-md-3 col-6 mb-2">
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="notif_sistem" name="notif_sistem"
											<?= $default_settings['notif_sistem'] == 1 ? 'checked' : ''; ?>>
										<label class="custom-control-label" for="notif_sistem"
											style="font-size:0.85rem;">Update Sistem</label>
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

		<!-- Leaflet JS -->
		<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
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
			// 2. NOTIFICATION DROPDOWN (M11-F01)
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
			// 3. MARK ALL READ (M11-F03)
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

			document.getElementById('markAllRead')?.addEventListener('click', function(e) {
				e.preventDefault();
				markAllRead();
			});

			// ============================================
			// 4. TRACKING MAP (M07-F04)
			// ============================================
			let trackingMap;

			function initTrackingMap() {
				const mapContainer = document.getElementById('trackingMap');
				if (!mapContainer) return;

				trackingMap = L.map('trackingMap').setView([-6.2, 106.8], 13);

				L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
					attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
				}).addTo(trackingMap);

				const kurirIcon = L.divIcon({
					html: '<div style="background: #4A2C11; color: white; border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; border: 3px solid #E6A15C;"><i class="bi bi-truck" style="font-size: 14px;"></i></div>',
					className: '',
					iconSize: [30, 30],
					iconAnchor: [15, 15]
				});

				const marker = L.marker([-6.18, 106.82], {
						icon: kurirIcon
					})
					.addTo(trackingMap)
					.bindPopup('<b>Kurir: Budi Santoso</b><br>Sedang menuju lokasi Anda<br>Estimasi tiba: 30 menit');

				const routePoints = [
					[-6.15, 106.80],
					[-6.17, 106.81],
					[-6.19, 106.82],
					[-6.20, 106.83],
					[-6.18, 106.82]
				];

				const routeLine = L.polyline(routePoints, {
					color: '#E6A15C',
					weight: 3,
					opacity: 0.7,
					dashArray: '8, 8'
				}).addTo(trackingMap);

				let pointIndex = 0;
				setInterval(() => {
					if (pointIndex < routePoints.length) {
						marker.setLatLng(routePoints[pointIndex]);
						pointIndex++;
						if (pointIndex === routePoints.length) {
							pointIndex = 0;
						}
					}
				}, 3000);

				setTimeout(() => {
					trackingMap.flyTo([-6.18, 106.82], 14);
				}, 500);

				setTimeout(() => {
					trackingMap.invalidateSize();
				}, 1000);
			}

			// ============================================
			// 5. CHART.JS - GRAFIK BELANJA (M10-F02)
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
									font: {
										size: 10,
										family: 'Plus Jakarta Sans'
									},
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
			// 6. CURRENT DATE TIME & MEMBER NAME
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
			// 7. SWITCH HANDLING (M11-F03)
			// ============================================
			document.querySelectorAll('.custom-control-input').forEach(switchEl => {
				switchEl.addEventListener('change', function() {
					const label = this.closest('.custom-control').querySelector('.custom-control-label');
					const setting = label ? label.textContent.trim() : 'Unknown';
					const status = this.checked ? 'diaktifkan' : 'dinonaktifkan';
					console.log('Notifikasi ' + setting + ' ' + status);
				});
			});

			// ============================================
			// 8. INITIALIZE ALL
			// ============================================
			document.addEventListener('DOMContentLoaded', function() {
				initTrackingMap();
				initChart();

				const memberNameEl = document.getElementById('memberName');
				if (memberNameEl) {
					memberNameEl.textContent = '<?= $this->session->userdata('nama') ?? 'Pembeli' ?>';
				}
			});

			window.addEventListener('resize', function() {
				if (trackingMap) {
					trackingMap.invalidateSize();
				}
			});

			console.log('✅ Dashboard Pembeli siap digunakan!');
			console.log('📋 Fitur yang tersedia:');
			console.log('   - KPI Cards (M11-F01)');
			console.log('   - Tracking Peta (M07-F04)');
			console.log('   - Rekomendasi Produk (M11-F01)');
			console.log('   - Riwayat Transaksi (M06-F08)');
			console.log('   - Grafik Belanja (M10-F02)');
			console.log('   - Quick Action (M11-F04)');
			console.log('   - Notifikasi Real-time (M11-F01)');
			console.log('   - Setting Notifikasi (M11-F03)');
		</script>
</body>

</html>
