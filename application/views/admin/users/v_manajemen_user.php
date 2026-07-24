<<<<<<< HEAD
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

	<?php $this->load->view('admin/layout/sidebar'); ?>
=======
<!-- STYLES KHUSUS MANAJEMEN USER -->
<style>
	:root {
		--roasted-brown: #4A2C11;
		--dark-coffee: #2C1808;
		--amber-cream: #E6A15C;
		--bg-cream: #FAF6F0;
		--card-white: #FFFFFF;
		--text-secondary: #70655E;
	}

	.btn-custom-primary {
		background: var(--dark-coffee) !important;
		color: #ffffff !important;
		border-radius: 10px;
		padding: 8px 20px;
		font-weight: 600;
		font-size: 0.85rem;
		border: none;
		transition: all 0.3s ease;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		text-decoration: none !important;
	}

	.btn-custom-primary:hover {
		background: var(--roasted-brown) !important;
		color: #ffffff !important;
		transform: translateY(-1px);
	}

	.btn-icon-round {
		width: 32px;
		height: 32px;
		border-radius: 50%;
		border: 1px solid #E5E7EB;
		background: #ffffff;
		color: #6B7280;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		transition: all 0.2s ease;
		text-decoration: none !important;
		font-size: 0.85rem;
	}

	.btn-icon-round:hover {
		background: #F9FAFB;
		color: var(--dark-coffee);
		border-color: #D1D5DB;
	}

	.btn-icon-round-danger {
		width: 32px;
		height: 32px;
		border-radius: 50%;
		border: 1px solid #FCA5A5;
		background: #ffffff;
		color: #EF4444;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		transition: all 0.2s ease;
		text-decoration: none !important;
		font-size: 0.85rem;
	}

	.btn-icon-round-danger:hover {
		background: #FEE2E2;
		color: #DC2626;
	}

	.badge-role {
		background: #F3F4F6;
		color: #4B5563;
		padding: 4px 14px;
		border-radius: 20px;
		font-weight: 500;
		font-size: 0.78rem;
		display: inline-block;
	}

	.badge-status-active {
		background: #DCFCE7;
		color: #15803D;
		padding: 4px 12px;
		border-radius: 20px;
		font-weight: 600;
		font-size: 0.75rem;
		display: inline-flex;
		align-items: center;
		gap: 4px;
	}

	.badge-status-inactive {
		background: #FEE2E2;
		color: #B91C1C;
		padding: 4px 12px;
		border-radius: 20px;
		font-weight: 600;
		font-size: 0.75rem;
		display: inline-flex;
		align-items: center;
		gap: 4px;
	}

	.table-custom-user {
		width: 100%;
		border-collapse: separate;
		border-spacing: 0;
	}

	.table-custom-user th {
		background: #FAF8F5;
		color: #70655E;
		font-size: 0.72rem;
		font-weight: 700;
		letter-spacing: 0.5px;
		padding: 12px 16px;
		border-bottom: 1px solid #F0EBE1;
		text-transform: uppercase;
	}

	.table-custom-user td {
		padding: 14px 16px;
		border-bottom: 1px solid #F0EBE1;
		vertical-align: middle;
		font-size: 0.88rem;
		color: #2C1808;
	}

	.custom-card-user {
		background: #ffffff;
		border-radius: 16px;
		border: 1px solid rgba(74, 44, 17, 0.06);
		box-shadow: 0 4px 20px rgba(44, 24, 8, 0.04);
		overflow: hidden;
	}
</style>

<!-- ALERT MESSAGES -->
<?php if ($this->session->flashdata('success')): ?>
	<div class="alert alert-success alert-dismissible fade show mb-3" style="border-radius: 12px;">
		<i class="bi bi-check-circle-fill mr-2"></i> <?= $this->session->flashdata('success') ?>
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
<?php endif; ?>
>>>>>>> c50a8c46b5d9744b96ff8d6c8a37c62a316dedd7

<?php if ($this->session->flashdata('error')): ?>
	<div class="alert alert-danger alert-dismissible fade show mb-3" style="border-radius: 12px;">
		<i class="bi bi-exclamation-circle-fill mr-2"></i> <?= $this->session->flashdata('error') ?>
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
<?php endif; ?>

<!-- SEARCH & FILTER CARD -->
<div class="custom-card-user mb-4" style="padding: 24px;">
	<form method="get" action="<?= site_url('admin/user') ?>">
		<div class="row align-items-end">
			<div class="col-md-4">
				<label for="search" class="form-label" style="font-weight: 600; font-size: 0.85rem; color: #2C1808;">
					<i class="bi bi-search mr-1"></i> Cari User
				</label>
				<input type="text" name="search" id="search" class="form-control" style="border-radius: 8px; height: 42px;"
					placeholder="Nama, username, atau nomor telepon"
					value="<?= htmlspecialchars($search ?? '') ?>" />
			</div>
			<div class="col-md-3">
				<label for="role" class="form-label" style="font-weight: 600; font-size: 0.85rem; color: #2C1808;">Role</label>
				<select name="role" id="role" class="form-control" style="border-radius: 8px; height: 42px;">
					<option value="">Semua Role</option>
					<option value="Admin" <?= ($role_filter ?? '') === 'Admin' ? 'selected' : '' ?>>Admin</option>
					<option value="Petani" <?= ($role_filter ?? '') === 'Petani' ? 'selected' : '' ?>>Petani</option>
					<option value="Pembeli" <?= ($role_filter ?? '') === 'Pembeli' ? 'selected' : '' ?>>Pembeli</option>
					<option value="Guest" <?= ($role_filter ?? '') === 'Guest' ? 'selected' : '' ?>>Guest</option>
				</select>
			</div>
			<div class="col-md-3">
				<label for="status" class="form-label" style="font-weight: 600; font-size: 0.85rem; color: #2C1808;">Status</label>
				<select name="status" id="status" class="form-control" style="border-radius: 8px; height: 42px;">
					<option value="">Semua Status</option>
					<option value="Active" <?= ($status ?? '') === 'Active' ? 'selected' : '' ?>>Aktif</option>
					<option value="Inactive" <?= ($status ?? '') === 'Inactive' ? 'selected' : '' ?>>Nonaktif</option>
				</select>
			</div>
			<div class="col-md-2">
				<button type="submit" class="btn-custom-primary w-100" style="height: 42px;">
					<i class="bi bi-search mr-2"></i> Cari
				</button>
			</div>
		</div>
		<?php if (!empty($search) || !empty($role_filter) || !empty($status)): ?>
			<div class="mt-2">
				<a href="<?= site_url('admin/user') ?>" class="btn btn-sm btn-link text-muted p-0" style="font-size: 0.8rem;">
					<i class="bi bi-x-circle mr-1"></i> Reset Filter
				</a>
			</div>
		<?php endif; ?>
	</form>
</div>

<!-- USER TABLE CARD -->
<div class="custom-card-user">
	<div class="d-flex justify-content-between align-items-center" style="padding: 20px 24px; border-bottom: 1px solid #F0EBE1;">
		<h6 class="mb-0" style="font-weight: 700; color: #2C1808; display: flex; align-items: center; gap: 8px;">
			<i class="bi bi-people-fill" style="color: #E6A15C; font-size: 1.1rem;"></i> Daftar User
		</h6>
		<a href="<?= site_url('admin/user/add') ?>" class="btn-custom-primary">
			<i class="bi bi-plus-lg mr-2"></i> Tambah User
		</a>
	</div>

	<div class="table-responsive">
		<table class="table-custom-user mb-0">
			<thead>
				<tr>
					<th style="width: 50px;">#</th>
					<th>NAMA</th>
					<th>USERNAME</th>
					<th>NOMOR TELEPON</th>
					<th>ROLE</th>
					<th>STATUS</th>
					<th class="text-center" style="width: 160px;">AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($users)): ?>
					<?php $i = 1; foreach ($users as $user): ?>
						<tr>
							<td><?= $i++ ?></td>
							<td><strong style="color: #2C1808;"><?= htmlspecialchars($user['nama'] ?? '-') ?></strong></td>
							<td><?= htmlspecialchars($user['username']) ?></td>
							<td><?= htmlspecialchars($user['no_telepon'] ?? '-') ?></td>
							<td>
								<span class="badge-role">
									<?= ucfirst($user['role'] ?? '-') ?>
								</span>
							</td>
							<td>
								<?php if (($user['status'] ?? '') === 'Active'): ?>
									<span class="badge-status-active">
										<i class="bi bi-check-circle"></i> Aktif
									</span>
								<?php else: ?>
									<span class="badge-status-inactive">
										<i class="bi bi-x-circle"></i> Nonaktif
									</span>
								<?php endif; ?>
							</td>
							<td class="text-center">
								<div class="d-inline-flex gap-1" style="gap: 6px;">
									<a href="<?= site_url('admin/user/edit/' . $user['id_user']) ?>" class="btn-icon-round" title="Edit">
										<i class="bi bi-pencil"></i>
									</a>

									<?php if (strtolower($user['role'] ?? '') !== 'admin'): ?>
										<?php if (($user['status'] ?? '') === 'Active'): ?>
											<a href="<?= site_url('admin/user/deactivate/' . $user['id_user']) ?>"
												class="btn-icon-round"
												title="Nonaktifkan"
												onclick="return confirm('Apakah Anda yakin ingin menonaktifkan user ini?')">
												<i class="bi bi-pause-circle"></i>
											</a>
										<?php else: ?>
											<a href="<?= site_url('admin/user/activate/' . $user['id_user']) ?>"
												class="btn-icon-round"
												title="Aktifkan"
												onclick="return confirm('Apakah Anda yakin ingin mengaktifkan user ini?')">
												<i class="bi bi-play-circle"></i>
											</a>
										<?php endif; ?>
									<?php endif; ?>

									<?php if (strtolower($user['role'] ?? '') === 'petani' && isset($user['is_verified']) && $user['is_verified'] === '0'): ?>
										<a href="<?= site_url('admin/users/verify_petani/' . $user['id_user']) ?>"
											class="btn-icon-round"
											title="Verifikasi Petani"
											onclick="return confirm('Apakah Anda yakin ingin memverifikasi akun Petani ini?')">
											<i class="bi bi-patch-check"></i>
										</a>
									<?php endif; ?>

									<a href="<?= site_url('admin/user/delete/' . $user['id_user']) ?>" 
										class="btn-icon-round-danger"
										onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')"
										title="Hapus">
										<i class="bi bi-trash"></i>
									</a>
								</div>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php else: ?>
					<tr>
						<td colspan="7" class="text-center py-5 text-muted">
							<i class="bi bi-people d-block mb-2" style="font-size: 2rem; color: #D1D5DB;"></i>
							Belum ada data user
						</td>
					</tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>