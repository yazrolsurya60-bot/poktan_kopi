<<<<<<< HEAD
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

		/* ============================================ */
		/* SIDEBAR - DISAMAKAN DENGAN HALAMAN LAIN */
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

		/* ============================================ */
		/* QUICK ACTION - DISAMAKAN DENGAN HALAMAN LAIN */
		/* ============================================ */

		.quick-action-btn {
			padding: 10px 16px;
			border: 1px solid rgba(74, 44, 17, 0.06);
			border-radius: 10px;
			background: var(--card-white);
			color: var(--dark-coffee);
			transition: var(--transition-smooth);
			display: inline-flex;
			align-items: center;
			gap: 10px;
			font-weight: 500;
			font-size: 0.85rem;
			cursor: pointer;
			text-decoration: none;
			box-shadow: var(--shadow-soft);
		}

		.quick-action-btn:hover {
			background: var(--bg-cream);
			border-color: var(--amber-cream);
			transform: translateX(4px);
			text-decoration: none;
			color: var(--dark-coffee);
			box-shadow: var(--shadow-hover);
		}

		.quick-action-btn i {
			font-size: 1.1rem;
			color: var(--amber-cream);
		}

		.quick-action-btn.btn-excel {
			background: #1B7C3C;
			color: white;
			border-color: #1B7C3C;
		}

		.quick-action-btn.btn-excel:hover {
			background: #14632F;
			color: white;
			border-color: #14632F;
			transform: translateY(-2px);
			box-shadow: 0 4px 12px rgba(27, 124, 60, 0.3);
		}

		.quick-action-btn.btn-pdf {
			background: #DC143C;
			color: white;
			border-color: #DC143C;
		}

		.quick-action-btn.btn-pdf:hover {
			background: #B01030;
			color: white;
			border-color: #B01030;
			transform: translateY(-2px);
			box-shadow: 0 4px 12px rgba(220, 20, 60, 0.3);
		}

		.quick-action-btn.btn-print {
			background: var(--dark-coffee);
			color: white;
			border-color: var(--dark-coffee);
		}

		.quick-action-btn.btn-print:hover {
			background: #1a0e04;
			color: white;
			border-color: #1a0e04;
			transform: translateY(-2px);
			box-shadow: 0 4px 12px rgba(44, 24, 8, 0.3);
		}

		/* ============================================ */
		/* BTN DETAIL TRANSAKSI - DISAMAKAN */
		/* ============================================ */

		.btn-detail-transaksi {
			background: var(--amber-cream);
			color: white;
			border: none;
			padding: 6px 14px;
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
			transform: translateY(-2px);
			box-shadow: var(--shadow-hover);
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
			padding-bottom: 20px;
			margin-bottom: 28px;
			border-bottom: 1px solid rgba(74, 44, 17, 0.06);
			display: flex;
			justify-content: space-between;
			align-items: center;
			flex-wrap: wrap;
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

		/* ============================================ */
		/* STATISTIK CARDS */
		/* ============================================ */

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

		/* ============================================ */
		/* CUSTOM CARD */
		/* ============================================ */

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

		/* ============================================ */
		/* TABLE */
		/* ============================================ */

		.table-custom {
			font-size: 0.85rem;
			margin-bottom: 0;
			width: 100%;
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
			white-space: nowrap;
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

		.table-custom tbody tr:last-child td {
			border-bottom: none;
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

		/* ============================================ */
		/* STATUS BADGE */
		/* ============================================ */

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

		/* ============================================ */
		/* QUICK ACTION */
		/* ============================================ */

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
		/* RESPONSIVE - SAMA DENGAN DASHBOARD */
		/* ============================================ */

		@media (max-width: 1199.98px) {
			.stat-card .stat-number {
				font-size: 1.5rem;
			}

			.table-custom thead th,
			.table-custom tbody td {
				padding: 12px 10px;
				font-size: 0.8rem;
			}
		}

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

			.page-header .page-title {
				font-size: 1.2rem;
			}

			.page-header .subtitle {
				font-size: 0.8rem;
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

			.table-custom thead th,
			.table-custom tbody td {
				padding: 10px 8px;
				font-size: 0.75rem;
			}

			.table-custom thead th {
				font-size: 0.6rem;
			}

			.quick-action-btn {
				font-size: 0.75rem;
				padding: 8px 14px;
			}

			.btn-detail-transaksi {
				font-size: 0.65rem;
				padding: 4px 10px;
			}
		}

		@media (max-width: 575.98px) {
			.main-content {
				padding: 16px 12px 20px;
			}

			.page-header .page-title {
				font-size: 1rem;
			}

			.page-header .subtitle {
				font-size: 0.7rem;
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

			.stat-card {
				padding: 14px 14px;
			}

			.stat-card .stat-number {
				font-size: 1.1rem;
			}

			.stat-card .stat-icon {
				width: 36px;
				height: 36px;
				font-size: 0.9rem;
			}

			.stat-card .stat-title {
				font-size: 0.6rem;
			}

			.stat-card .stat-footer {
				font-size: 0.65rem;
			}

			.table-custom thead th {
				font-size: 0.5rem;
				padding: 6px 6px;
				white-space: normal;
			}

			.table-custom tbody td {
				padding: 8px 6px;
				font-size: 0.65rem;
			}

			.avatar-circle {
				width: 28px;
				height: 28px;
				font-size: 0.6rem;
			}

			.quick-action-btn {
				font-size: 0.65rem;
				padding: 6px 10px;
				gap: 5px;
			}

			.quick-action-btn i {
				font-size: 0.8rem;
			}

			.btn-detail-transaksi {
				font-size: 0.6rem;
				padding: 3px 8px;
				gap: 3px;
			}

			.btn-detail-transaksi i {
				font-size: 0.6rem;
			}

			.custom-card .card-header-custom {
				padding: 12px 16px;
			}

			.custom-card .card-header-custom h6 {
				font-size: 0.75rem;
			}

			.row.mb-4 {
				margin: 0 -6px;
			}

			.row.mb-4 .col-6 {
				padding: 0 6px;
			}

			.d-flex.flex-wrap .quick-action-btn {
				flex: 1;
				justify-content: center;
			}
		}

		/* ============================================ */
		/* UTILITY */
		/* ============================================ */

		.text-truncate {
			overflow: hidden;
			text-overflow: ellipsis;
			white-space: nowrap;
		}

		.gap-1 {
			gap: 4px;
		}

		.gap-2 {
			gap: 8px;
		}

		.gap-3 {
			gap: 12px;
		}

		.gap-4 {
			gap: 16px;
		}

		.gap-5 {
			gap: 24px;
		}

		.d-flex-center {
			display: flex;
			align-items: center;
			justify-content: center;
		}

		/* ============================================ */
		/* ANIMATION */
		/* ============================================ */

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

		/* ============================================ */
		/* EMPTY STATE */
		/* ============================================ */

		.empty-state {
			padding: 60px 20px;
			text-align: center;
		}

		.empty-state i {
			font-size: 3rem;
			color: #D1C9C0;
			display: block;
			margin-bottom: 16px;
		}

		.empty-state h6 {
			font-weight: 700;
			color: var(--dark-coffee);
		}

		.empty-state p {
			color: var(--text-secondary);
			font-size: 0.85rem;
		}

		/* ============================================ */
		/* FOOTER BOTTOM */
		/* ============================================ */

		.footer-bottom {
			color: var(--text-secondary);
			font-size: 0.8rem;
			border-top: 1px solid rgba(74, 44, 17, 0.06);
			padding-top: 20px;
			margin-top: 30px;
			text-align: center;
		}
	</style>
</head>

<body>

	<?php $this->load->view('admin/layout/sidebar'); ?>
=======
<style>
	:root {
		--roasted-brown: #4A2C11;
		--dark-coffee: #2C1808;
		--amber-cream: #E6A15C;
		--amber-light: #FDF5ED;
		--bg-cream: #FAF6F0;
		--card-white: #FFFFFF;
		--text-secondary: #70655E;
		--shadow-soft: 0 8px 30px rgba(44, 24, 8, 0.08);
		--shadow-hover: 0 12px 40px rgba(44, 24, 8, 0.15);
		--radius-card: 16px;
		--transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
	}

	/* QUICK ACTION */
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

	/* STATISTIK CARDS */
	.stat-card {
		background: var(--card-white);
		border-radius: var(--radius-card);
		padding: 20px 22px;
		box-shadow: var(--shadow-soft);
		transition: var(--transition-smooth);
		border: 1px solid rgba(74, 44, 17, 0.04);
		height: 100%;
		position: relative;
		overflow: hidden;
	}

	.stat-card::before {
		content: '';
		position: absolute;
		top: 0; left: 0; right: 0; height: 3px;
		background: linear-gradient(90deg, var(--amber-cream), var(--roasted-brown));
		opacity: 0;
		transition: var(--transition-smooth);
	}

	.stat-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-hover); }
	.stat-card:hover::before { opacity: 1; }

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
	}

	.stat-card .stat-number {
		font-size: 1.8rem;
		font-weight: 800;
		color: var(--dark-coffee);
	}

	/* TABLE & CUSTOM CARD */
	.custom-card {
		background: var(--card-white);
		border-radius: var(--radius-card);
		box-shadow: var(--shadow-soft);
		border: 1px solid rgba(74, 44, 17, 0.04);
		overflow: hidden;
	}

	.custom-card .card-header-custom {
		padding: 16px 24px;
		border-bottom: 1px solid rgba(74, 44, 17, 0.06);
		display: flex;
		align-items: center;
		justify-content: space-between;
		background: rgba(250, 246, 240, 0.3);
	}

	.table-custom { font-size: 0.85rem; margin-bottom: 0; width: 100%; }
	.table-custom thead th {
		background: rgba(250, 246, 240, 0.4);
		border-bottom: 2px solid rgba(74, 44, 17, 0.06);
		color: var(--text-secondary);
		font-weight: 600;
		font-size: 0.7rem;
		text-transform: uppercase;
		padding: 14px 12px;
	}
	.table-custom tbody td {
		padding: 14px 12px;
		border-bottom: 1px solid rgba(74, 44, 17, 0.04);
		vertical-align: middle;
	}

	.status-badge {
		padding: 5px 14px;
		border-radius: 20px;
		font-size: 0.7rem;
		font-weight: 600;
		display: inline-block;
	}
	.status-badge.pending { background: #FEF3C7; color: #92400E; }
	.status-badge.processing { background: #DBEAFE; color: #1E40AF; }
	.status-badge.delivery { background: #EDE9FE; color: #5B21B6; }
	.status-badge.complete { background: #D1FAE5; color: #065F46; }
	.status-badge.cancelled { background: #FEE2E2; color: #991B1B; }

	.btn-detail-transaksi {
		background: var(--amber-cream);
		color: white;
		border: none;
		padding: 6px 14px;
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
		transform: translateY(-2px);
		box-shadow: var(--shadow-hover);
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
	}
</style>

<!-- QUICK ACTION -->
<div class="row mb-4 fade-in">
	<div class="col-12">
		<div class="d-flex flex-wrap" style="gap: 10px;">
			<a href="<?= base_url('admin/transaksi'); ?>" class="quick-action-btn">
				<i class="bi bi-arrow-repeat"></i> Refresh
			</a>
			<a href="<?= base_url('admin/transaksi/export_excel'); ?>" class="quick-action-btn btn-excel" onclick="return confirm('Download laporan Excel?')">
				<i class="bi bi-file-earmark-excel-fill"></i> Export Excel
			</a>
			<a href="<?= base_url('admin/transaksi/export_pdf'); ?>" class="quick-action-btn btn-pdf" onclick="return confirm('Download laporan PDF?')">
				<i class="bi bi-file-earmark-pdf-fill"></i> Export PDF
			</a>
		</div>
	</div>
</div>
>>>>>>> c50a8c46b5d9744b96ff8d6c8a37c62a316dedd7

<!-- STATISTIK CARDS -->
<div class="row mb-4 fade-in">
	<div class="col-xl-3 col-lg-6 col-6 mb-3">
		<div class="stat-card">
			<div class="stat-icon" style="background: #FEF3C7; color: #92400E;"><i class="bi bi-clock"></i></div>
			<div class="stat-title">Pending</div>
			<div class="stat-number"><?= $count_pending ?? 0; ?></div>
		</div>
	</div>
	<div class="col-xl-3 col-lg-6 col-6 mb-3">
		<div class="stat-card">
			<div class="stat-icon" style="background: #DBEAFE; color: #1E40AF;"><i class="bi bi-spinner"></i></div>
			<div class="stat-title">Diproses</div>
			<div class="stat-number"><?= $count_diproses ?? 0; ?></div>
		</div>
	</div>
	<div class="col-xl-3 col-lg-6 col-6 mb-3">
		<div class="stat-card">
			<div class="stat-icon" style="background: #EDE9FE; color: #5B21B6;"><i class="bi bi-truck"></i></div>
			<div class="stat-title">Dikirim</div>
			<div class="stat-number"><?= $count_dikirim ?? 0; ?></div>
		</div>
	</div>
	<div class="col-xl-3 col-lg-6 col-6 mb-3">
		<div class="stat-card">
			<div class="stat-icon" style="background: #D1FAE5; color: #065F46;"><i class="bi bi-check-circle"></i></div>
			<div class="stat-title">Selesai</div>
			<div class="stat-number"><?= $count_selesai ?? 0; ?></div>
		</div>
	</div>
</div>

<!-- TABEL TRANSAKSI -->
<div class="custom-card fade-in">
	<div class="card-header-custom">
		<h6 class="mb-0"><i class="bi bi-receipt"></i> Daftar Transaksi</h6>
		<span class="badge" style="background:var(--bg-cream); color:var(--text-secondary); font-weight:600; padding:6px 14px; border-radius:20px;">
			Total: <?= count($transaksi ?? []); ?> transaksi
		</span>
	</div>
	<div class="card-body p-0">
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
								<td>
									<?php
									$metode = $t['metode_bayar'] ?? 'Transfer';
									if ($metode == 'Transfer Bank' || $metode == 'Transfer') {
										echo 'Virtual Account';
									} else {
										echo $metode;
									}
									?>
								</td>
								<td><span style="font-size:0.8rem; color:var(--text-secondary);"><?= date('d/m/Y', strtotime($t['tanggal_transaksi'] ?? date('Y-m-d'))); ?></span></td>
								<td class="text-center">
									<a href="<?= base_url('admin/transaksi/detail/' . $t['id_transaksi']); ?>" class="btn-detail-transaksi">
										<i class="bi bi-eye"></i> Detail
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="8" class="text-center py-5 text-muted">
								<i class="bi bi-inbox" style="font-size:3rem; display:block; margin-bottom:12px; opacity:0.3;"></i>
								Belum ada transaksi
							</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>