<<<<<<< HEAD
<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Rekap Panen - Admin</title>
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
			--shadow-soft: 0 8px 30px rgba(16, 9, 3, 0.08);
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

		/* ============================================ */
		/* SIDEBAR */
		/* ============================================ */

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
		/* MAIN CONTENT */
		/* ============================================ */

		.main-content {
			margin-left: var(--sidebar-width);
			padding: 30px 40px 40px;
			min-height: 100vh;
			transition: var(--transition-smooth);
		}

		/* ============================================ */
		/* PAGE HEADER */
		/* ============================================ */

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
		}

		.user-badge i {
			font-size: 1.4rem;
			color: var(--amber-cream);
		}

		.user-badge .user-name {
			font-weight: 600;
			font-size: 0.82rem;
			color: var(--dark-coffee);
			line-height: 1.2;
		}

		.user-badge .user-role {
			font-size: 0.6rem;
			color: var(--text-secondary);
			text-transform: uppercase;
			letter-spacing: 0.5px;
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
		/* CUSTOM CARD */
		/* ============================================ */

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
			font-weight: 700;
			font-size: 0.9rem;
			color: var(--dark-coffee);
		}

		.custom-card .card-header-custom i {
			color: var(--amber-cream);
		}

		.custom-card .card-body-custom {
			padding: 24px;
		}

		/* ============================================ */
		/* TABLE */
		/* ============================================ */

		.table-custom {
			font-size: 0.85rem;
			width: 100%;
			margin-bottom: 0;
		}

		.table-custom thead th {
			border-bottom: 2px solid rgba(74, 44, 17, 0.06);
			color: var(--text-secondary);
			font-weight: 600;
			font-size: 0.7rem;
			text-transform: uppercase;
			letter-spacing: 0.5px;
			padding: 12px 10px;
			background: rgba(250, 246, 240, 0.5);
		}

		.table-custom tbody td {
			padding: 12px 10px;
			border-bottom: 1px solid rgba(74, 44, 17, 0.04);
			vertical-align: middle;
		}

		.table-custom tbody tr:hover {
			background: rgba(250, 246, 240, 0.3);
		}

		.table-custom tbody tr:last-child td {
			border-bottom: none;
		}

		/* ============================================ */
		/* BUTTONS */
		/* ============================================ */

		.btn-custom {
			border-radius: 8px;
			font-size: 0.8rem;
			font-weight: 600;
			padding: 6px 14px;
			border: none;
			transition: var(--transition-smooth);
			display: inline-flex;
			align-items: center;
			gap: 6px;
		}

		.btn-custom:hover {
			transform: translateY(-2px);
			box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
		}

		.btn-custom-info {
			background: #DBEAFE;
			color: #1E40AF;
		}

		.btn-custom-info:hover {
			background: #1E40AF;
			color: #fff;
		}

		.btn-custom-success {
			background: #10b981;
			color: #fff;
		}

		.btn-custom-success:hover {
			background: #059669;
			color: #fff;
		}

		.btn-custom-secondary {
			background: #E5E7EB;
			color: #4B5563;
		}

		.btn-custom-secondary:hover {
			background: #D1D5DB;
			color: #1F2937;
		}

		.btn-custom-print {
			background: #6B7280;
			color: #fff;
		}

		.btn-custom-print:hover {
			background: #4B5563;
			color: #fff;
		}

		/* ============================================ */
		/* FILTER FORM */
		/* ============================================ */

		.filter-form .form-control-sm {
			border-radius: 8px;
			border: 1px solid rgba(74, 44, 17, 0.15);
			font-size: 0.8rem;
			padding: 6px 12px;
			background: var(--bg-cream);
			transition: var(--transition-smooth);
		}

		.filter-form .form-control-sm:focus {
			border-color: var(--amber-cream);
			box-shadow: 0 0 0 3px rgba(230, 161, 92, 0.15);
			outline: none;
			background: #fff;
		}

		.filter-form label {
			font-size: 0.72rem;
			font-weight: 600;
			color: var(--text-secondary);
			text-transform: uppercase;
			letter-spacing: 0.5px;
			margin-bottom: 4px;
		}

		/* ============================================ */
		/* SCROLLBAR */
		/* ============================================ */

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

		/* ============================================ */
		/* STATUS BADGE DI TABEL */
		/* ============================================ */

		.badge-kualitas {
			font-size: 0.7rem;
			font-weight: 600;
			padding: 4px 10px;
			border-radius: 20px;
			border: 1px solid #ccc;
			background: #f8f9fa;
			color: var(--text-secondary);
		}

		.text-success {
			color: #10b981 !important;
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

			.sidebar-overlay.active {
				display: block;
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

			.filter-form .row {
				gap: 10px;
			}

			.filter-form .col-md-3 {
				flex: 0 0 48%;
				max-width: 48%;
			}
		}

		@media (max-width: 575.98px) {
			.main-content {
				padding: 16px 12px 20px;
			}

			.page-header .subtitle {
				font-size: 0.75rem;
			}

			.notif-dropdown {
				width: calc(100vw - 24px);
				right: -70px;
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

			.custom-card .card-header-custom {
				font-size: 0.8rem;
				padding: 14px 16px;
			}

			.custom-card .card-body-custom {
				padding: 16px;
			}

			.table-custom {
				font-size: 0.7rem;
			}

			.table-custom thead th {
				font-size: 0.55rem;
				padding: 6px 6px;
				white-space: nowrap;
			}

			.table-custom tbody td {
				padding: 8px 6px;
				font-size: 0.7rem;
			}

			.filter-form .col-md-3 {
				flex: 0 0 100%;
				max-width: 100%;
			}

			.filter-form .row {
				gap: 6px;
			}

			.btn-custom {
				font-size: 0.7rem;
				padding: 5px 10px;
			}

			.d-flex.justify-content-end.mb-3 {
				flex-wrap: wrap;
				gap: 6px;
			}

			.d-flex.justify-content-end.mb-3 a,
			.d-flex.justify-content-end.mb-3 button {
				flex: 1;
				justify-content: center;
				min-width: 80px;
			}
		}

		/* ============================================ */
		/* PRINT STYLES */
		/* ============================================ */

		@media print {
			.sidebar {
				display: none !important;
			}

			.main-content {
				margin-left: 0 !important;
				padding: 20px !important;
			}

			.page-header {
				border-bottom: 1px solid #ddd !important;
			}

			.d-print-none {
				display: none !important;
			}

			.custom-card {
				box-shadow: none !important;
				border: 1px solid #ddd !important;
			}

			.btn-custom {
				display: none !important;
			}

			.table-custom thead th {
				background: #f5f5f5 !important;
			}

			.notif-btn {
				display: none !important;
			}

			.user-badge {
				display: none !important;
			}

			.header-right {
				display: none !important;
			}
		}
	</style>
</head>

<body>

	<?php $this->load->view('admin/layout/sidebar'); ?>

	<!-- MAIN CONTENT -->
	<div class="main-content">

		<!-- PAGE HEADER -->
		<div class="page-header">
			<div>
				<button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle"
					style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
					<i class="bi bi-list"></i>
				</button>
				<h2 class="d-inline-block align-middle mb-0">Rekap Hasil Panen</h2>
				<p class="subtitle mb-0 mt-1">Laporan rekapitulasi data panen dari seluruh petani (M04-F02).</p>
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
=======
<!-- M04-F06: Filter Panen -->
<div class="custom-card mb-4 d-print-none" style="background: #fff; border-radius: 14px; border: 1px solid rgba(74, 44, 17, 0.06); box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
	<div class="card-body-custom" style="padding: 20px 24px;">
		<form method="GET" action="<?= base_url('admin/panen'); ?>" class="filter-form">
			<div class="row align-items-end" style="margin: 0 -8px;">
				<div class="col-md-3" style="padding: 0 8px;">
					<label style="font-size: 0.72rem; font-weight: 700; color: #70655E; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; display: block;">MULAI TANGGAL</label>
					<input type="date" name="start_date" class="form-control form-control-sm py-2 px-3"
						value="<?= $this->input->get('start_date'); ?>" style="border-radius: 8px; border: 1px solid #E5E0DB; background-color: #FAF6F0; font-size: 0.85rem;">
				</div>
				<div class="col-md-3" style="padding: 0 8px;">
					<label style="font-size: 0.72rem; font-weight: 700; color: #70655E; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; display: block;">SAMPAI TANGGAL</label>
					<input type="date" name="end_date" class="form-control form-control-sm py-2 px-3"
						value="<?= $this->input->get('end_date'); ?>" style="border-radius: 8px; border: 1px solid #E5E0DB; background-color: #FAF6F0; font-size: 0.85rem;">
				</div>
				<div class="col-md-3" style="padding: 0 8px;">
					<label style="font-size: 0.72rem; font-weight: 700; color: #70655E; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; display: block;">KUALITAS</label>
					<input type="text" name="kualitas" class="form-control form-control-sm py-2 px-3"
						placeholder="Contoh: Grade A" value="<?= $this->input->get('kualitas'); ?>" style="border-radius: 8px; border: 1px solid #E5E0DB; background-color: #FAF6F0; font-size: 0.85rem;">
				</div>
				<div class="col-md-3" style="padding: 0 8px;">
					<button type="submit" class="btn w-100 py-2 border-0 font-weight-bold"
						style="background-color: #D9D2C9; color: #4A2C11; border-radius: 8px; font-size: 0.85rem; transition: all 0.2s ease;">
						<i class="bi bi-funnel-fill mr-1"></i> Terapkan Filter
>>>>>>> c50a8c46b5d9744b96ff8d6c8a37c62a316dedd7
					</button>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- Tombol Export & Print -->
<div class="d-flex justify-content-end mb-3 d-print-none" style="gap: 10px;">
	<a href="<?= base_url('admin/panen/export_excel?' . $_SERVER['QUERY_STRING']); ?>"
		class="btn text-white px-3 py-2 font-weight-bold d-inline-flex align-items-center"
		style="background-color: #10B981; border-radius: 8px; font-size: 0.85rem; border: none;">
		<i class="bi bi-file-earmark-excel mr-1"></i> Export Excel
	</a>
	<button onclick="window.print()" class="btn text-white px-3 py-2 font-weight-bold d-inline-flex align-items-center"
		style="background-color: #6B7280; border-radius: 8px; font-size: 0.85rem; border: none;">
		<i class="bi bi-printer mr-1"></i> Cetak / PDF
	</button>
</div>

<!-- TABLE DATA -->
<div class="custom-card" style="background: #fff; border-radius: 14px; border: 1px solid rgba(74, 44, 17, 0.06); box-shadow: 0 4px 12px rgba(0,0,0,0.03); overflow: hidden;">
	<div class="card-header-custom d-flex justify-content-between align-items-center" style="padding: 18px 24px; border-bottom: 1px solid rgba(74, 44, 17, 0.06);">
		<span class="font-weight-bold text-dark" style="font-size: 0.95rem;">
			<i class="bi bi-list-ul mr-2" style="color: #E6A15C;"></i>Data Panen Semua Petani
		</span>
		<span class="badge px-3 py-1 font-weight-normal" style="background: #FAF6F0; color: #70655E; border-radius: 20px; font-size: 0.75rem;">
			<?= count($panen_list); ?> Data
		</span>
	</div>
	<div class="card-body-custom p-0">
		<div class="table-responsive">
			<table class="table mb-0" style="font-size: 0.85rem;">
				<thead>
					<tr style="background-color: #FAF6F0; border-bottom: 2px solid rgba(74, 44, 17, 0.06);">
						<th class="border-0 text-muted py-3" style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; padding-left: 24px; width: 6%;">NO</th>
						<th class="border-0 text-muted py-3" style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; width: 15%;">TANGGAL PANEN</th>
						<th class="border-0 text-muted py-3" style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; width: 20%;">NAMA PETANI</th>
						<th class="border-0 text-muted py-3" style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; width: 20%;">LAHAN</th>
						<th class="border-0 text-muted py-3" style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; width: 14%;">JUMLAH (KG)</th>
						<th class="border-0 text-muted py-3" style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; width: 13%;">KUALITAS</th>
						<th class="border-0 text-muted py-3 text-center d-print-none" style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; padding-right: 24px; width: 12%;">AKSI</th>
					</tr>
				</thead>
				<tbody>
					<?php if (empty($panen_list)): ?>
						<tr>
							<td colspan="7" class="text-center py-5 border-0 text-muted">
								<i class="bi bi-inbox d-block mb-3" style="font-size: 2.5rem; color: #A8988A;"></i>
								<p class="mb-0" style="font-size: 0.9rem; color: #70655E;">Belum ada data panen dari petani.</p>
							</td>
						</tr>
					<?php else: ?>
						<?php $no = 1; foreach ($panen_list as $p): ?>
							<tr style="border-bottom: 1px solid rgba(74, 44, 17, 0.04);">
								<td class="align-middle py-3" style="padding-left: 24px; color: #2C1808;"><?= $no++; ?></td>
								<td class="align-middle py-3" style="color: #2C1808;"><?= date('d M Y', strtotime($p['tanggal_panen'])); ?></td>
								<td class="align-middle py-3 font-weight-bold" style="color: #2C1808;">
									<?= htmlspecialchars($p['nama_petani'] ?? 'Unknown Petani'); ?>
								</td>
								<td class="align-middle py-3" style="color: #70655E;"><?= htmlspecialchars($p['nama_lahan'] ?? '-'); ?></td>
								<td class="align-middle py-3 font-weight-bold" style="color: #10B981;">
									<?= number_format($p['jumlah_panen'], 0, ',', '.'); ?> Kg
								</td>
								<td class="align-middle py-3">
									<span class="badge font-weight-bold px-3 py-1" style="border: 1px solid #D9D2C9; background: #F8F9FA; color: #70655E; border-radius: 20px; font-size: 0.75rem;">
										<?= htmlspecialchars($p['kualitas'] ?? '-'); ?>
									</span>
								</td>
								<td class="align-middle py-3 text-center d-print-none" style="padding-right: 24px;">
									<a href="<?= base_url('admin/panen/detail/' . $p['id_panen']); ?>"
										class="btn btn-sm text-primary font-weight-bold"
										style="background-color: #DBEAFE; border-radius: 6px; padding: 4px 12px; font-size: 0.8rem;" title="Detail Panen">
										<i class="bi bi-eye mr-1"></i> Detail
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
	<?php if (!empty($panen_list)): ?>
		<div class="p-3 border-top" style="border-color: rgba(74,44,17,0.05); background-color: #fff;">
			<small class="text-muted">
				<i class="bi bi-info-circle mr-1"></i> Menampilkan <strong><?= count($panen_list); ?></strong> data panen
				<?php if (!empty($this->input->get('start_date')) || !empty($this->input->get('end_date')) || !empty($this->input->get('kualitas'))): ?>
					(hasil filter)
				<?php endif; ?>
			</small>
		</div>
	<?php endif; ?>
</div>
