<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard - Sistem Supply Chain Kopi</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
		rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<!-- Chart.js -->
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

		/* --- ACTION CARDS --- */
		.action-card {
			background: var(--card-white);
			border: 1px solid rgba(74, 44, 17, 0.06);
			border-radius: var(--radius-card);
			padding: 18px 22px;
			display: flex;
			align-items: center;
			transition: var(--transition-smooth);
			color: var(--dark-coffee);
			font-weight: 600;
			font-size: 0.9rem;
			box-shadow: var(--shadow-soft);
			text-decoration: none;
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

		.status-badge.verified {
			background: #D1FAE5;
			color: #065F46;
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

		/* --- SETTING NOTIFIKASI --- */
		.custom-switch .custom-control-label::before {
			background-color: #EFEAE2;
			border-color: #DDD;
			border-radius: 20px;
			width: 44px;
			height: 22px;
		}

		.custom-switch .custom-control-label::after {
			width: 18px;
			height: 18px;
			border-radius: 50%;
		}

		.custom-switch .custom-control-input:checked~.custom-control-label::before {
			background-color: var(--roasted-brown);
			border-color: var(--roasted-brown);
		}

		.custom-switch .custom-control-label {
			font-weight: 600;
			cursor: pointer;
			padding-top: 2px;
			font-size: 0.85rem;
			padding-left: 10px;
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
	<!-- KONDISI MENU: JIKA YANG DIKLIK ADALAH KURIR -->
	<!-- ================================================================= -->
	<?php if (isset($active_menu) && $active_menu === 'kurir'): ?>

		<!-- TAMPILKAN TABEL KURIR DI SINI -->
		<div class="row">
			<div class="col-md-12">
				<div class="card shadow-sm mb-4">
					<div class="card-header bg-white d-flex justify-content-between align-items-center">
						<h6 class="m-0 font-weight-bold text-primary">Daftar Kurir Kelompok Kopi</h6>
						<a href="<?= base_url('admin/kurir/tambah') ?>" class="btn btn-primary btn-sm">
							<i class="bi bi-plus-circle mr-2"></i>Tambah Kurir
						</a>
					</div>
					<div class="card-body p-0">
						<div class="table-responsive">
							<table class="table table-hover mb-0">
								<thead>
									<tr>
										<th>Nama Kurir</th>
										<th>No. Telepon</th>
										<th>Kendaraan</th>
										<th>Plat Nomor</th>
										<th>Status</th>
										<th class="text-center">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php if (empty($kurir)): ?>
										<tr>
											<td colspan="6" class="text-center py-4">Belum ada data kurir.</td>
										</tr>
									<?php else: ?>
										<?php foreach ($kurir as $k): ?>
											<tr>
												<td><?= htmlspecialchars($k->nama_kurir) ?></td>
												<td><?= htmlspecialchars($k->no_telepon) ?></td>
												<td><?= htmlspecialchars($k->jenis_kendaraan) ?></td>
												<td><?= htmlspecialchars($k->plat_nomor) ?></td>
												<td><?= $k->status_kurir ?></td>
												<td class="text-center">
													<a href="<?= base_url('admin/kurir/edit/' . $k->id_kurir) ?>"
														class="text-warning mr-2"><i class="bi bi-pencil-fill"></i></a>
													<a href="<?= base_url('admin/kurir/hapus/' . $k->id_kurir) ?>"
														class="text-danger" onclick="return confirm('Hapus kurir?')"><i
															class="bi bi-trash-fill"></i></a>
												</td>
											</tr>
										<?php endforeach; ?>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- ================================================================= -->
		<!-- JIKA YANG DIKLIK BUKAN KURIR (MENU UTAMA), TAMPILKAN DASHBOARD ASLI -->
		<!-- ================================================================= -->
	<?php else: ?>

		<!-- Pindahkan / Biarkan seluruh kode isi dashboard asli kelompokmu berada di sini -->
		<!-- (Mulai dari KPI Card, Grafik, Ringkasan, Form Notif dll milik timmu) -->

	<?php endif; ?>
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
				<li class="menu-item active">
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
		<div class="page-header d-flex justify-content-between align-items-center flex-wrap">
			<div>
				<button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle"
					style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
					<i class="bi bi-list"></i>
				</button>
				<h2 class="d-inline-block align-middle mb-0">Manajemen Petani</h2>
				<p class="subtitle mb-0 mt-1 text-muted">Dashboard / Manajemen Petani</p>
			</div>
			<div class="d-flex align-items-center gap-3" style="gap: 12px;">
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
								<?= isset($unread_count) && $unread_count > 0 ? $unread_count . ' Notifikasi Belum Dibaca' : 'Semua Notifikasi'; ?>
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
				<!-- USER AVATAR -->
				<div class="d-flex align-items-center gap-2"
					style="cursor: pointer; padding: 6px 12px; border-radius: 10px; background: var(--card-white); border: 1px solid rgba(74,44,17,0.06);">
					<i class="bi bi-person-circle" style="font-size: 1.5rem; color: var(--amber-cream);"></i>
					<span style="font-weight:500; font-size:0.85rem;">Admin</span>
				</div>
			</div>
		</div>

		
<!-- MAIN BODY CONTENT -->
<div class="page-body" style="padding: 24px; background-color: #f8f9fa; min-height: calc(100vh - 80px);">
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-3 d-flex align-items-center">
                <div class="rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 50px; height: 50px; background-color: #FFF3E0; color: #E6A15C;">
                    <i class="bi bi-people-fill fs-4"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted fw-bold" style="font-size: 0.85rem;">Total Petani</h6>
                    <h3 class="mb-0 fw-bold"><?= isset($total_petani) ? $total_petani : 0; ?></h3>
                    <small class="text-muted" style="font-size: 0.7rem;">Semua Petani</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-3 d-flex align-items-center">
                <div class="rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 50px; height: 50px; background-color: #E8F5E9; color: #4CAF50;">
                    <i class="bi bi-arrow-down-circle-fill fs-4"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted fw-bold" style="font-size: 0.85rem;">Active</h6>
                    <h3 class="mb-0 fw-bold"><?= isset($active_count) ? $active_count : 0; ?></h3>
                    <?php $pct_active = isset($total_petani) && $total_petani > 0 ? round(($active_count / $total_petani) * 100, 1) : 0; ?>
                    <small class="text-muted" style="font-size: 0.7rem;"><?= $pct_active; ?>% dari total</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-3 d-flex align-items-center">
                <div class="rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 50px; height: 50px; background-color: #FFF8E1; color: #FFC107;">
                    <i class="bi bi-people-fill fs-4"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted fw-bold" style="font-size: 0.85rem;">Inactive</h6>
                    <h3 class="mb-0 fw-bold"><?= isset($inactive_count) ? $inactive_count : 0; ?></h3>
                    <?php $pct_inactive = isset($total_petani) && $total_petani > 0 ? round(($inactive_count / $total_petani) * 100, 1) : 0; ?>
                    <small class="text-muted" style="font-size: 0.7rem;"><?= $pct_inactive; ?>% dari total</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-3 d-flex align-items-center">
                <div class="rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 50px; height: 50px; background-color: #FFEBEE; color: #F44336;">
                    <i class="bi bi-arrow-down-circle-fill fs-4"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted fw-bold" style="font-size: 0.85rem;">Suspended</h6>
                    <h3 class="mb-0 fw-bold"><?= isset($suspended_count) ? $suspended_count : 0; ?></h3>
                    <?php $pct_suspend = isset($total_petani) && $total_petani > 0 ? round(($suspended_count / $total_petani) * 100, 1) : 0; ?>
                    <small class="text-muted" style="font-size: 0.7rem;"><?= $pct_suspend; ?>% dari total</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <!-- TOOLBAR -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex gap-3">
                <div class="input-group" style="width: 250px;">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" id="searchPetani" class="form-control border-start-0 ps-0" placeholder="Cari petani...">
                </div>
                <form action="<?= base_url('admin/petani'); ?>" method="GET" class="d-flex">
                    <select name="status" class="form-select text-muted" onchange="this.form.submit()" style="width: 150px;">
                        <option value="">Semua Status</option>
                        <option value="Active" <?= (isset($status_filter) && $status_filter == 'Active') ? 'selected' : ''; ?>>Active</option>
                        <option value="Inactive" <?= (isset($status_filter) && $status_filter == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                        <option value="Suspended" <?= (isset($status_filter) && $status_filter == 'Suspended') ? 'selected' : ''; ?>>Suspended</option>
                    </select>
                </form>
            </div>
            <div class="d-flex gap-2">
                <a href="<?= base_url('admin/petani/tambah'); ?>" class="btn px-4 text-white rounded-3 shadow-sm" style="background-color: #6d4c41; font-weight: 500;">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Petani
                </a>
                <a href="<?= base_url('admin/petani/export_page'); ?>" class="btn px-3 bg-white text-muted border rounded-3 shadow-sm">
                    <i class="bi bi-box-arrow-up me-1"></i> Export <i class="bi bi-chevron-down ms-1" style="font-size:0.7rem;"></i>
                </a>
            </div>
        </div>

        <!-- TABLE -->
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="border-collapse: separate; border-spacing: 0 8px;">
                <thead>
                    <tr style="background-color: transparent;">
                        <th class="border-0 text-muted pb-3" style="font-weight: 600; font-size: 0.85rem; padding-left: 15px;">No</th>
                        <th class="border-0 text-muted pb-3" style="font-weight: 600; font-size: 0.85rem;">Foto</th>
                        <th class="border-0 text-muted pb-3" style="font-weight: 600; font-size: 0.85rem;">Nama Petani</th>
                        <th class="border-0 text-muted pb-3" style="font-weight: 600; font-size: 0.85rem;">NIK</th>
                        <th class="border-0 text-muted pb-3" style="font-weight: 600; font-size: 0.85rem;">No HP</th>
                        <th class="border-0 text-muted pb-3" style="font-weight: 600; font-size: 0.85rem;">Status</th>
                        <th class="border-0 text-muted pb-3" style="font-weight: 600; font-size: 0.85rem; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tbodyPetani">
                    <?php if (!empty($daftar_petani)): ?>
                        <?php $no = 1; foreach ($daftar_petani as $p): ?>
                            <tr style="box-shadow: 0 2px 6px rgba(0,0,0,0.02); background-color: #fff; border-radius: 8px;">
                                <td class="border-0 fw-bold" style="border-top-left-radius: 8px; border-bottom-left-radius: 8px; padding-left: 15px; width: 50px;"><?= $no++; ?></td>
                                <td class="border-0">
                                    <?php if(!empty($p['foto_profil'])): ?>
                                        <img src="<?= base_url('uploads/dokumen/'.$p['foto_profil']); ?>" class="rounded-circle object-fit-cover" width="40" height="40">
                                    <?php else: ?>
                                        <div class="rounded-circle bg-secondary d-flex justify-content-center align-items-center text-white" style="width: 40px; height: 40px; font-size: 1.2rem;">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="border-0 fw-bold text-dark"><?= htmlspecialchars($p['nama_petani']); ?></td>
                                <td class="border-0 text-muted"><?= htmlspecialchars($p['nik']); ?></td>
                                <td class="border-0 text-muted"><?= htmlspecialchars($p['no_hp']); ?></td>
                                <td class="border-0">
                                    <?php 
                                        $badge_color = 'bg-secondary';
                                        $text_color = 'text-white';
                                        if ($p['status_petani'] == 'Active') { $badge_color = '#E8F5E9'; $text_color = '#4CAF50'; }
                                        if ($p['status_petani'] == 'Inactive') { $badge_color = '#FFF8E1'; $text_color = '#FFC107'; }
                                        if ($p['status_petani'] == 'Suspended') { $badge_color = '#FFEBEE'; $text_color = '#F44336'; }
                                    ?>
                                    <span class="badge rounded-pill px-3 py-2" style="background-color: <?= $badge_color; ?>; color: <?= $text_color; ?>; font-weight: 600; letter-spacing: 0.5px;">
                                        <?= $p['status_petani']; ?>
                                    </span>
                                </td>
                                <td class="border-0" style="border-top-right-radius: 8px; border-bottom-right-radius: 8px; text-align: center;">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="<?= base_url('admin/petani/detail/' . $p['id_petani']); ?>" class="btn btn-sm" style="background-color: #F5E6D3; color: #8D6E63; border-radius: 6px;">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="<?= base_url('admin/petani/edit/' . $p['id_petani']); ?>" class="btn btn-sm" style="background-color: #FFF3E0; color: #FF9800; border-radius: 6px;">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <a href="<?= base_url('admin/petani/hapus/' . $p['id_petani']); ?>" onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-sm" style="background-color: #FFEBEE; color: #F44336; border-radius: 6px;">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="text-center py-4 border-0">Belum ada data petani.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted" id="countPetani">Menampilkan <?= isset($daftar_petani) ? count($daftar_petani) : 0; ?> data</small>
            <!-- Pagination Placeholder -->
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item disabled"><a class="page-link text-muted border-0 bg-light" href="#">&laquo;</a></li>
                <li class="page-item active"><a class="page-link border-0 text-white" style="background-color: #6d4c41;" href="#">1</a></li>
                <li class="page-item"><a class="page-link text-muted border-0" href="#">&raquo;</a></li>
            </ul>
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
			if (confirm('Tandai semua notifikasi sebagai sudah dibaca?')) {
				$.ajax({
					url: '<?= base_url('admin/dashboard/mark_all_read_ajax'); ?>',
					type: 'POST',
					dataType: 'json',
					success: function (response) {
						if (response.success) {
							location.reload();
						} else {
							alert('Gagal menandai semua notifikasi.');
						}
					},
					error: function () {
						alert('Terjadi kesalahan. Silakan coba lagi.');
					}
				});
			}
		}

		$('#markAllReadBtn').on('click', function (e) {
			e.preventDefault();
			markAllRead();
		});

		// ============================================
		// 4. CHART.JS - GRAFIK PENJUALAN (M10-F02)
		// ============================================
		let salesChart;

		function initChart() {
			const ctx = document.getElementById('salesChart')?.getContext('2d');
			if (!ctx) return;

			const chartData = <?= isset($grafik_penjualan['values']) ? json_encode($grafik_penjualan['values']) : json_encode([120, 150, 180, 140, 200, 230, 210, 250, 270, 240, 300, 280]); ?>;
			const chartLabels = <?= isset($grafik_penjualan['labels']) ? json_encode($grafik_penjualan['labels']) : json_encode(['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des']); ?>;

			salesChart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: chartLabels,
					datasets: [{
						label: 'Penjualan (Kg)',
						data: chartData,
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
								font: {
									size: 10,
									family: 'Plus Jakarta Sans'
								},
								color: '#70655E',
								stepSize: 50,
								callback: function (value) {
									return value + ' kg';
								}
							}
						},
						x: {
							grid: {
								display: false
							},
							ticks: {
								font: {
									size: 10,
									family: 'Plus Jakarta Sans'
								},
								color: '#70655E',
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

		function refreshChart() {
			if (salesChart) {
				$.get('<?= base_url('admin/dashboard/get_chart_data'); ?>', function (data) {
					if (data.success) {
						salesChart.data.datasets[0].data = data.values;
						salesChart.update();
					}
				});
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
		document.querySelectorAll('.custom-control-input').forEach(function (switchEl) {
			switchEl.addEventListener('change', function () {
				const label = this.closest('.custom-control').querySelector('.custom-control-label');
				const setting = label ? label.textContent.trim() : 'Unknown';
				const status = this.checked ? 'diaktifkan' : 'dinonaktifkan';
				console.log('Notifikasi ' + setting + ' ' + status);
			});
		});

		// ============================================
		// 7. AUTO REFRESH NOTIFIKASI (SETIAP 60 DETIK)
		// ============================================
		function refreshNotifications() {
			$.ajax({
				url: '<?= base_url('admin/dashboard/get_notifications_ajax'); ?>',
				type: 'GET',
				dataType: 'json',
				success: function (response) {
					if (response.success) {
						const countEl = document.getElementById('notifCount');
						if (response.unread > 0) {
							countEl.textContent = response.unread;
							countEl.style.display = 'flex';
						} else {
							countEl.style.display = 'none';
						}
					}
				}
			});
		}

		// Refresh setiap 60 detik
		// setInterval(refreshNotifications, 60000);

		console.log('âœ… Modul 11: Dashboard f& Notifikasi siap digunakan!');
		console.log('ðŸ“‹ Fitur yang tersedia:');
		console.log('   - KPI Cards (M11-F01)');
		console.log('   - Grafik Penjualan (M10-F02)');
		console.log('   - Produk Terlaris (M10-F04)');
		console.log('   - Pesanan Terbaru (M11-F01)');
		console.log('   - Petani Baru (M11-F01)');
		console.log('   - Quick Action (M11-F04)');
		console.log('   - Notifikasi Real-time (M11-F01)');
		console.log('   - Setting Notifikasi (M11-F03)');
	</script>
	<script>
	// ── Pencarian Petani (client-side) ──
	document.getElementById('searchPetani').addEventListener('keyup', function() {
		var keyword = this.value.toLowerCase();
		var rows = document.querySelectorAll('#tbodyPetani tr');
		var visibleCount = 0;
		rows.forEach(function(row) {
			var text = row.textContent.toLowerCase();
			if (text.indexOf(keyword) > -1) {
				row.style.display = '';
				visibleCount++;
			} else {
				row.style.display = 'none';
			}
		});
		// Update counter
		var counter = document.getElementById('countPetani');
		if (counter) counter.textContent = 'Menampilkan ' + visibleCount + ' data';
	});
	</script>
</body>

</html>
