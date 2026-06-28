<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Manajemen Produk - Sistem Supply Chain Kopi</title>
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

		/* ===== MAIN CONTENT ===== */
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

		/* ===== NOTIFICATION ===== */
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

		.notif-badge-new {
			background: var(--amber-cream);
			color: white;
			font-size: 0.55rem;
			padding: 2px 8px;
			border-radius: 10px;
			align-self: center;
		}

		/* ===== TABLE ===== */
		.table-custom {
			font-size: 0.85rem;
			width: 100%;
			background: var(--card-white);
			border-radius: var(--radius-card);
			overflow: hidden;
			box-shadow: var(--shadow-soft);
		}

		.table-custom thead th {
			background: var(--bg-cream);
			border-bottom: 2px solid rgba(74, 44, 17, 0.06);
			color: var(--text-secondary);
			font-weight: 600;
			font-size: 0.7rem;
			text-transform: uppercase;
			letter-spacing: 0.5px;
			padding: 14px 16px;
		}

		.table-custom tbody td {
			padding: 14px 16px;
			border-bottom: 1px solid rgba(74, 44, 17, 0.04);
			vertical-align: middle;
			background: var(--card-white);
		}

		.table-custom tbody tr:hover td {
			background: rgba(250, 246, 240, 0.4);
		}

		.table-custom tbody tr:last-child td {
			border-bottom: none;
		}

		/* ===== STATUS BADGE ===== */
		.status-badge {
			padding: 4px 14px;
			border-radius: 20px;
			font-size: 0.7rem;
			font-weight: 600;
			display: inline-block;
		}

		.status-badge.aktif {
			background: #D1FAE5;
			color: #065F46;
		}

		.status-badge.nonaktif {
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

		/* ===== TOMBOL ===== */
		.btn-detail {
			background: #DBEAFE;
			color: #1E40AF;
			border: none;
			padding: 4px 12px;
			border-radius: 6px;
			font-size: 0.75rem;
			font-weight: 600;
			transition: var(--transition-smooth);
		}

		.btn-detail:hover {
			background: #1E40AF;
			color: white;
		}

		.btn-edit {
			background: #FEF3C7;
			color: #92400E;
			border: none;
			padding: 4px 12px;
			border-radius: 6px;
			font-size: 0.75rem;
			font-weight: 600;
			transition: var(--transition-smooth);
		}

		.btn-edit:hover {
			background: #92400E;
			color: white;
		}

		.btn-hapus {
			background: #FEE2E2;
			color: #991B1B;
			border: none;
			padding: 4px 12px;
			border-radius: 6px;
			font-size: 0.75rem;
			font-weight: 600;
			transition: var(--transition-smooth);
		}

		.btn-hapus:hover {
			background: #991B1B;
			color: white;
		}

		.btn-tambah {
			background: var(--amber-cream);
			color: white;
			border: none;
			padding: 10px 24px;
			border-radius: 10px;
			font-weight: 600;
			font-size: 0.85rem;
			transition: var(--transition-smooth);
			display: inline-flex;
			align-items: center;
			gap: 8px;
		}

		.btn-tambah:hover {
			background: var(--roasted-brown);
			color: white;
			transform: translateY(-2px);
			box-shadow: var(--shadow-hover);
			text-decoration: none;
		}

		/* ===== SEARCH ===== */
		.search-input {
			border: 1px solid rgba(74, 44, 17, 0.1);
			border-radius: 10px;
			padding: 10px 16px;
			font-size: 0.85rem;
			font-family: 'Plus Jakarta Sans', sans-serif;
			transition: var(--transition-smooth);
			background: var(--card-white);
		}

		.search-input:focus {
			border-color: var(--amber-cream);
			box-shadow: 0 0 0 3px rgba(230, 161, 92, 0.15);
			outline: none;
		}

		.btn-search {
			background: var(--roasted-brown);
			color: white;
			border: none;
			padding: 10px 20px;
			border-radius: 10px;
			font-weight: 600;
			font-size: 0.85rem;
			transition: var(--transition-smooth);
		}

		.btn-search:hover {
			background: var(--dark-coffee);
			color: white;
		}

		.btn-reset {
			background: var(--bg-cream);
			color: var(--text-secondary);
			border: 1px solid rgba(74, 44, 17, 0.1);
			padding: 10px 20px;
			border-radius: 10px;
			font-weight: 600;
			font-size: 0.85rem;
			transition: var(--transition-smooth);
		}

		.btn-reset:hover {
			background: #e8e0d8;
			color: var(--dark-coffee);
			text-decoration: none;
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

			.page-header h2 {
				font-size: 1.3rem;
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

			.table-custom thead th,
			.table-custom tbody td {
				padding: 10px 12px;
				font-size: 0.75rem;
			}

			.notif-dropdown {
				width: calc(100vw - 24px);
				right: -70px;
			}

			.btn-tambah {
				padding: 8px 16px;
				font-size: 0.75rem;
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
				<li class="menu-item active">
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
		<div class="page-header d-flex justify-content-between align-items-center flex-wrap">
			<div>
				<button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle"
					style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
					<i class="bi bi-list"></i>
				</button>
				<h2 class="d-inline-block align-middle mb-0">
					<i class="bi bi-box-seam-fill" style="color: var(--amber-cream);"></i> Manajemen Produk
				</h2>
				<p class="subtitle mb-0 mt-1">
					Kelola data produk komoditas kopi Anda di sini &bull;
					<span id="currentDateTime" style="color: var(--text-secondary); font-size:0.85rem;"></span>
				</p>
			</div>
			<div class="d-flex align-items-center gap-3" style="gap: 12px;">
				<!-- NOTIFICATION -->
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
							<span>
								<?= (isset($unread_count) && $unread_count > 0) ? $unread_count . ' Notifikasi Belum Dibaca' : 'Semua Notifikasi'; ?>
							</span>
							<div>
								<?php if (isset($unread_count) && $unread_count > 0): ?>
									<a href="#" id="markAllReadBtn" class="mr-2" style="font-size:0.7rem;">Tandai semua</a>
								<?php endif; ?>
								<a href="<?= base_url('admin/dashboard/history'); ?>" style="font-size:0.7rem;">Lihat Semua</a>
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
						<div class="p-2 text-center border-top" style="background:#FAF6F0; border-color:rgba(74,44,17,0.06);">
							<a href="<?= base_url('admin/dashboard/settings'); ?>" class="small text-secondary font-weight-bold text-decoration-none">
								<i class="bi bi-gear-fill mr-1"></i> Pengaturan Notifikasi
							</a>
						</div>
					</div>
				</div>

				<!-- USER AVATAR -->
				<div class="d-flex align-items-center gap-2"
					style="cursor: pointer; padding: 6px 12px; border-radius: 10px; background: var(--card-white); border: 1px solid rgba(74,44,17,0.06);">
					<i class="bi bi-person-circle" style="font-size: 1.5rem; color: var(--amber-cream);"></i>
					<span style="font-weight:500; font-size:0.85rem;">Admin</span>
				</div>
			</div>
		</div>

		<!-- SEARCH & TAMBAH -->
		<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap" style="gap: 15px;">
			<form method="get" action="<?= base_url('admin/produk'); ?>" class="d-flex align-items-center" style="gap: 10px; flex-grow: 1; max-width: 600px;">
				<input type="text" name="keyword" class="search-input form-control" placeholder="Cari nama produk, jenis kopi, atau grade..." value="<?= $this->input->get('keyword'); ?>" style="flex:1;">
				<button type="submit" class="btn-search">
					<i class="bi bi-search"></i> Cari
				</button>
				<a href="<?= base_url('admin/produk'); ?>" class="btn-reset">
					Reset
				</a>
			</form>
			<a href="<?= base_url('admin/produk/tambah'); ?>" class="btn-tambah">
				<i class="bi bi-plus-lg"></i> Tambah Produk
			</a>
		</div>

		<!-- TABLE -->
		<div class="table-responsive">
			<table class="table-custom">
				<thead>
					<tr>
						<th style="width:50px;">No</th>
						<th style="width:80px;">Foto</th>
						<th>Nama Produk</th>
						<th>Jenis Kopi</th>
						<th>Grade</th>
						<th>Harga</th>
						<th>Stok</th>
						<th>Status</th>
						<th style="width:240px;">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($produk)): ?>
						<?php $no = 1;
						foreach ($produk as $row): ?>
							<tr>
								<td><?= $no++; ?></td>
								<td>
									<?php if (!empty($row->foto_utama)) : ?>
										<img src="<?= base_url('uploads/produk/' . $row->foto_utama); ?>"
											width="55" height="55" style="object-fit:cover; border-radius:10px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
									<?php else : ?>
										<div style="width:55px; height:55px; background:var(--bg-cream); border-radius:10px; display:flex; align-items:center; justify-content:center; color:var(--text-secondary); font-size:0.7rem;">
											No Image
										</div>
									<?php endif; ?>
								</td>
								<td class="font-weight-bold" style="font-size: 0.9rem; color: var(--dark-coffee);"><?= $row->nama_produk; ?></td>
								<td><?= $row->jenis_kopi; ?></td>
								<td>
									<span style="background:var(--bg-cream); padding:4px 12px; border-radius:6px; font-size:0.75rem; font-weight:600;">
										<?= $row->grade; ?>
									</span>
								</td>
								<td class="font-weight-bold" style="color: var(--dark-coffee);">Rp <?= number_format($row->harga, 0, ',', '.'); ?></td>
								<td>
									<?= $row->stok_produk; ?>
									<small class="text-muted" style="font-size:0.65rem;">kg</small>
								</td>
								<td>
									<?php
									$status_class = 'aktif';
									$status_text = $row->status_produk ?? 'Aktif';
									if (strtolower($status_text) == 'nonaktif') $status_class = 'nonaktif';
									?>
									<span class="status-badge <?= $status_class; ?>"><?= $status_text; ?></span>
								</td>
								<td>
									<div class="d-flex flex-wrap" style="gap: 4px;">
										<a class="btn-detail" href="<?= base_url('admin/produk/detail/' . $row->id_produk); ?>">
											<i class="bi bi-eye"></i> Detail
										</a>
										<a class="btn-edit" href="<?= base_url('admin/produk/edit/' . $row->id_produk); ?>">
											<i class="bi bi-pencil-square"></i> Edit
										</a>
										<a class="btn-hapus" href="<?= base_url('admin/produk/hapus/' . $row->id_produk); ?>"
											onclick="return confirm('Yakin ingin menghapus produk ini?')">
											<i class="bi bi-trash"></i> Hapus
										</a>
									</div>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="9" class="text-center py-4 text-muted">
								<i class="bi bi-box" style="font-size:2rem; display:block; margin-bottom:8px; opacity:0.3;"></i>
								Belum ada produk. <a href="<?= base_url('admin/produk/tambah'); ?>" style="color: var(--amber-cream); font-weight:600;">Tambah produk pertama</a>
							</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
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

		if (toggleBtn) toggleBtn.addEventListener('click', toggleSidebar);
		if (overlay) overlay.addEventListener('click', toggleSidebar);

		document.addEventListener('click', function(e) {
			if (window.innerWidth > 991.98) return;
			if (!sidebar.contains(e.target) && toggleBtn && !toggleBtn.contains(e.target)) {
				if (sidebar.classList.contains('open')) toggleSidebar();
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
		// 4. CURRENT DATE TIME
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
				el.textContent = 'Jumat, 26 Juni 2026 pukul 21.58';
			}
		}
		updateDateTime();

		console.log('✅ Manajemen Produk siap digunakan!');
		console.log('📋 Fitur yang tersedia:');
		console.log('   - Tabel Produk dengan Data Real');
		console.log('   - Search & Filter Produk');
		console.log('   - CRUD Produk (Tambah, Edit, Hapus, Detail)');
		console.log('   - Notifikasi Real-time');
		console.log('   - Status Stok & Produk');
	</script>
</body>

</html>
