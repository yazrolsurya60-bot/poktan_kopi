<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Manajemen Kurir - Sistem Supply Chain Kopi</title>
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
			--text-muted: #A8988A;
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

		.menu-item a .menu-badge.danger {
			background: #EF4444;
			color: white;
		}

		.menu-item a .menu-badge.warning {
			background: #F59E0B;
			color: white;
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
		/* STAT BOX / SUMMARY CARDS */
		/* ============================================ */

		.stat-box {
			background: var(--card-white);
			border: 1px solid rgba(74, 44, 17, 0.06);
			border-radius: var(--radius-card);
			padding: 20px 22px;
			position: relative;
			box-shadow: var(--shadow-soft);
			transition: var(--transition-smooth);
			overflow: hidden;
			display: flex;
			align-items: center;
			gap: 16px;
			height: 100%;
		}

		.stat-box:hover {
			transform: translateY(-3px);
			box-shadow: var(--shadow-hover);
		}

		.stat-icon-box {
			width: 48px;
			height: 48px;
			min-width: 48px;
			border-radius: 12px;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 1.3rem;
		}

		.bg-success-soft { background: #D1FAE5; color: #065F46; }
		.bg-warning-soft { background: #FEF3C7; color: #92400E; }
		.bg-danger-soft  { background: #FEE2E2; color: #991B1B; }

		.stat-title {
			font-size: 0.7rem;
			font-weight: 700;
			text-transform: uppercase;
			color: var(--text-secondary);
			letter-spacing: 0.5px;
			margin: 0;
		}

		.stat-num {
			font-size: 1.5rem;
			font-weight: 700;
			margin: 2px 0 0;
			color: var(--dark-coffee);
		}

		/* ============================================ */
		/* CUSTOM CARD */
		/* ============================================ */

		.custom-card {
			background: var(--card-white);
			border: 1px solid rgba(74, 44, 17, 0.06);
			border-radius: var(--radius-card);
			box-shadow: var(--shadow-soft);
			overflow: hidden;
		}

		.custom-card .card-header-custom {
			padding: 18px 24px;
			border-bottom: 1px solid rgba(74, 44, 17, 0.06);
			display: flex;
			align-items: center;
			justify-content: space-between;
			flex-wrap: wrap;
			gap: 10px;
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
		}

		.custom-card .card-body-custom {
			padding: 0;
		}

		/* ============================================ */
		/* FORM CONTROL */
		/* ============================================ */

		.form-control-custom {
			padding: 8px 14px;
			border: 1.5px solid rgba(74, 44, 17, 0.1);
			border-radius: 10px;
			font-size: 0.85rem;
			color: var(--dark-coffee);
			background: var(--bg-cream);
			outline: none;
			transition: var(--transition-smooth);
			width: 100%;
			font-family: 'Plus Jakarta Sans', sans-serif;
		}

		.form-control-custom:focus {
			border-color: var(--amber-cream);
			box-shadow: 0 0 0 3px rgba(230, 161, 92, 0.15);
			background: var(--card-white);
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
			background: var(--bg-cream);
			border-bottom: 2px solid rgba(74, 44, 17, 0.06);
			color: var(--text-secondary);
			font-weight: 700;
			font-size: 0.7rem;
			text-transform: uppercase;
			letter-spacing: 0.5px;
			padding: 12px 16px;
			border-top: none;
			white-space: nowrap;
		}

		.table-custom tbody td {
			padding: 12px 16px;
			border-bottom: 1px solid rgba(74, 44, 17, 0.04);
			vertical-align: middle;
		}

		.table-custom tbody tr {
			transition: var(--transition-smooth);
		}

		.table-custom tbody tr:hover {
			background: rgba(250, 246, 240, 0.5);
		}

		.table-custom tbody tr:last-child td {
			border-bottom: none;
		}

		.link-name {
			color: var(--roasted-brown);
			font-weight: 600;
		}

		/* ============================================ */
		/* STATUS BADGE */
		/* ============================================ */

		.status-badge {
			padding: 4px 12px;
			border-radius: 20px;
			font-size: 0.7rem;
			font-weight: 600;
			display: inline-block;
		}

		.status-badge.badge-active   { background: #D1FAE5; color: #065F46; }
		.status-badge.badge-inactive { background: #FEF3C7; color: #92400E; }
		.status-badge.badge-offline  { background: #FEE2E2; color: #991B1B; }

		/* ============================================ */
		/* ACTION BUTTONS */
		/* ============================================ */

		.btn-icon {
			width: 32px;
			height: 32px;
			border-radius: 8px;
			border: none;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			font-size: 0.85rem;
			cursor: pointer;
			transition: var(--transition-smooth);
			text-decoration: none;
		}

		.btn-toggle { background: #EDE9FE; color: #5B21B6; }
		.btn-toggle:hover { background: #5B21B6; color: #fff; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(91, 33, 182, 0.3); }
		.btn-edit   { background: #FEF3C7; color: #92400E; }
		.btn-edit:hover   { background: #92400E; color: #fff; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(146, 64, 14, 0.3); }
		.btn-delete { background: #FEE2E2; color: #991B1B; }
		.btn-delete:hover { background: #991B1B; color: #fff; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(153, 27, 27, 0.3); }

		.btn-primary-custom {
			background: var(--roasted-brown);
			color: #fff;
			border: none;
			border-radius: 10px;
			padding: 8px 18px;
			font-size: 0.85rem;
			font-weight: 600;
			transition: var(--transition-smooth);
			text-decoration: none;
			display: inline-flex;
			align-items: center;
			gap: 6px;
			cursor: pointer;
			font-family: 'Plus Jakarta Sans', sans-serif;
		}

		.btn-primary-custom:hover {
			background: var(--amber-cream);
			color: #fff;
			transform: translateY(-2px);
			box-shadow: 0 4px 12px rgba(230, 161, 92, 0.3);
			text-decoration: none;
		}

		.btn-outline-custom {
			border: 1.5px solid rgba(74, 44, 17, 0.12);
			color: var(--dark-coffee);
			background: var(--card-white);
			border-radius: 10px;
			padding: 8px 16px;
			font-size: 0.85rem;
			font-weight: 600;
			transition: var(--transition-smooth);
			text-decoration: none;
			display: inline-flex;
			align-items: center;
			gap: 6px;
			cursor: pointer;
			font-family: 'Plus Jakarta Sans', sans-serif;
		}

		.btn-outline-custom:hover {
			background: var(--bg-cream);
			border-color: var(--amber-cream);
			color: var(--dark-coffee);
			text-decoration: none;
		}

		/* ============================================ */
		/* BREADCRUMB */
		/* ============================================ */

		.breadcrumb-custom {
			font-size: 0.78rem;
			color: var(--text-secondary);
			margin-bottom: 4px;
		}

		.breadcrumb-custom a {
			color: var(--amber-cream);
			text-decoration: none;
		}

		.breadcrumb-custom a:hover {
			text-decoration: underline;
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
		/* RESPONSIVE */
		/* ============================================ */

		@media (max-width: 1199.98px) {
			.stat-num {
				font-size: 1.3rem;
			}
			.table-custom thead th,
			.table-custom tbody td {
				padding: 10px 12px;
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

			.page-header h2 {
				font-size: 1.3rem;
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

			.stat-box {
				padding: 16px 18px;
			}

			.stat-icon-box {
				width: 40px;
				height: 40px;
				min-width: 40px;
				font-size: 1.1rem;
			}

			.stat-num {
				font-size: 1.2rem;
			}

			.table-custom thead th,
			.table-custom tbody td {
				padding: 10px 10px;
				font-size: 0.75rem;
			}

			.table-custom thead th {
				font-size: 0.6rem;
			}

			.custom-card .card-header-custom {
				padding: 14px 18px;
				flex-direction: column;
				align-items: stretch;
			}

			.custom-card .card-header-custom .d-flex {
				flex-wrap: wrap;
			}

			.custom-card .card-header-custom .d-flex form {
				flex: 1;
				min-width: 150px;
			}

			.btn-primary-custom,
			.btn-outline-custom {
				font-size: 0.75rem;
				padding: 6px 14px;
			}

			.btn-icon {
				width: 28px;
				height: 28px;
				font-size: 0.75rem;
			}
		}

		@media (max-width: 575.98px) {
			.main-content {
				padding: 16px 12px 20px;
			}

			.page-header h2 {
				font-size: 1.1rem;
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

			.stat-box {
				padding: 14px 16px;
				gap: 12px;
			}

			.stat-icon-box {
				width: 36px;
				height: 36px;
				min-width: 36px;
				font-size: 0.9rem;
			}

			.stat-num {
				font-size: 1rem;
			}

			.stat-title {
				font-size: 0.6rem;
			}

			.table-custom thead th {
				font-size: 0.5rem;
				padding: 6px 8px;
				white-space: normal;
			}

			.table-custom tbody td {
				padding: 8px 8px;
				font-size: 0.7rem;
			}

			.link-name {
				font-size: 0.75rem;
			}

			.btn-primary-custom,
			.btn-outline-custom {
				font-size: 0.65rem;
				padding: 5px 10px;
				gap: 4px;
			}

			.btn-primary-custom i,
			.btn-outline-custom i {
				font-size: 0.7rem;
			}

			.btn-icon {
				width: 24px;
				height: 24px;
				font-size: 0.65rem;
				border-radius: 6px;
			}

			.status-badge {
				font-size: 0.6rem;
				padding: 2px 8px;
			}

			.modal-body {
				padding: 16px 18px !important;
			}

			.modal-footer {
				padding: 12px 16px !important;
				flex-wrap: wrap;
			}

			.modal-footer .btn-primary-custom,
			.modal-footer .btn-outline-custom {
				flex: 1;
				justify-content: center;
			}

			.custom-card .card-header-custom {
				padding: 12px 14px;
			}

			.custom-card .card-header-custom h6 {
				font-size: 0.8rem;
			}

			.custom-card .card-header-custom .d-flex form input {
				min-width: 100px;
				font-size: 0.7rem;
				padding: 6px 10px;
			}

			.row.mb-4 .col-md-4 {
				padding: 0 6px;
			}

			.row.mb-4 .col-md-4 .stat-box {
				padding: 12px 14px;
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

		.gap-1 { gap: 4px; }
		.gap-2 { gap: 8px; }
		.gap-3 { gap: 12px; }
		.gap-4 { gap: 16px; }
		.gap-5 { gap: 24px; }

		.d-flex-center {
			display: flex;
			align-items: center;
			justify-content: center;
		}

		/* ============================================ */
		/* ALERT / FLASH MESSAGE */
		/* ============================================ */

		.alert {
			border-radius: 12px;
			border: none;
			font-size: 0.85rem;
			padding: 14px 18px;
			display: flex;
			align-items: center;
		}

		.alert-success {
			background: #D1FAE5;
			color: #065F46;
		}

		.alert-danger {
			background: #FEE2E2;
			color: #991B1B;
		}

		.alert .close {
			font-size: 1.2rem;
			line-height: 1;
			padding: 0 0 0 12px;
			opacity: 0.5;
		}

		.alert .close:hover {
			opacity: 1;
		}

		/* ============================================ */
		/* MODAL */
		/* ============================================ */

		.modal-content {
			border-radius: 16px;
			border: none;
			box-shadow: var(--shadow-hover);
		}

		.modal-header {
			border-bottom: 1px solid rgba(74, 44, 17, 0.06);
			padding: 18px 24px;
		}

		.modal-header .modal-title {
			font-weight: 700;
			font-size: 1rem;
			color: var(--dark-coffee);
		}

		.modal-header .modal-title i {
			color: var(--amber-cream);
		}

		.modal-body {
			padding: 20px 24px;
		}

		.modal-footer {
			border-top: 1px solid rgba(74, 44, 17, 0.06);
			padding: 14px 24px;
		}

		.modal-footer .btn {
			font-family: 'Plus Jakarta Sans', sans-serif;
			border-radius: 10px;
		}

		/* ============================================ */
		/* EMPTY STATE */
		/* ============================================ */

		.empty-state {
			padding: 60px 20px;
			text-align: center;
		}

		.empty-state i {
			font-size: 2.5rem;
			color: #D1C9C0;
			display: block;
			margin-bottom: 16px;
		}

		.empty-state p {
			color: var(--text-secondary);
			font-size: 0.85rem;
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
						<?php if (isset($user_baru) && $user_baru > 0): ?>
							<span class="menu-badge" style="background: #EF4444; color: white;"><?= $user_baru; ?></span>
						<?php endif; ?>
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/petani'); ?>">
						<i class="bi bi-person-badge-fill"></i>Data Petani
						<?php if (isset($petani_baru_count) && $petani_baru_count > 0): ?>
							<span class="menu-badge" style="background: #F59E0B; color: white;"><?= $petani_baru_count; ?></span>
						<?php endif; ?>
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
						<?php if (isset($transaksi_pending) && $transaksi_pending > 0): ?>
							<span class="menu-badge" style="background: #EF4444; color: white;"><?= $transaksi_pending; ?></span>
						<?php endif; ?>
					</a>
				</li>
				<li class="menu-item active">
					<a href="<?= base_url('admin/kurir'); ?>">
						<i class="bi bi-truck"></i>Manajemen Kurir
						<?php if (isset($kurir_active) && $kurir_active > 0): ?>
							<span class="menu-badge" style="background: #10B981; color: white;"><?= $kurir_active; ?></span>
						<?php endif; ?>
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/mitra'); ?>">
						<i class="bi bi-shop"></i>Manajemen Mitra
						<?php if (isset($mitra_baru) && $mitra_baru > 0): ?>
							<span class="menu-badge" style="background: #F59E0B; color: white;"><?= $mitra_baru; ?></span>
						<?php endif; ?>
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
				<h2 class="d-inline-block align-middle mb-0">
					<i class="bi bi-truck" style="color:var(--amber-cream);"></i> Manajemen Kurir
				</h2>
				<p class="subtitle mb-0 mt-1">Kelola data kurir pengiriman Poktan Liberchain</p>
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

		<!-- FLASH MESSAGE -->
		<?php if ($this->session->flashdata('success')): ?>
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				<i class="bi bi-check-circle-fill mr-2"></i><?= $this->session->flashdata('success'); ?>
				<button type="button" class="close" data-dismiss="alert">&times;</button>
			</div>
		<?php endif; ?>

		<?php if ($this->session->flashdata('error')): ?>
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<i class="bi bi-exclamation-circle-fill mr-2"></i><?= $this->session->flashdata('error'); ?>
				<button type="button" class="close" data-dismiss="alert">&times;</button>
			</div>
		<?php endif; ?>

		<!-- SUMMARY CARDS -->
		<div class="row mb-4">
			<div class="col-md-4 mb-3">
				<div class="stat-box">
					<div class="stat-icon-box bg-success-soft"><i class="bi bi-person-check-fill"></i></div>
					<div>
						<p class="stat-title">Active</p>
						<h3 class="stat-num"><?= $kurir_active ?? 0; ?></h3>
					</div>
				</div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="stat-box">
					<div class="stat-icon-box bg-warning-soft"><i class="bi bi-pause-circle-fill"></i></div>
					<div>
						<p class="stat-title">Inactive</p>
						<h3 class="stat-num"><?= $kurir_inactive ?? 0; ?></h3>
					</div>
				</div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="stat-box">
					<div class="stat-icon-box bg-danger-soft"><i class="bi bi-wifi-off"></i></div>
					<div>
						<p class="stat-title">Offline</p>
						<h3 class="stat-num"><?= $kurir_offline ?? 0; ?></h3>
					</div>
				</div>
			</div>
		</div>

		<!-- TABEL KURIR -->
		<div class="custom-card">
			<div class="card-header-custom">
				<h6><i class="bi bi-people-fill mr-2"></i>Daftar Kurir</h6>
				<div class="d-flex flex-wrap" style="gap: 8px;">
					<form method="get" action="<?= base_url('admin/kurir'); ?>" class="d-flex">
						<input type="text" name="keyword" class="form-control-custom" placeholder="Cari nama / telepon..." value="<?= htmlspecialchars($keyword ?? ''); ?>" style="min-width:180px;">
					</form>
					<a href="<?= base_url('admin/kurir/assign'); ?>" class="btn-outline-custom">
						<i class="bi bi-truck"></i> Tugaskan Kurir
					</a>
					<button type="button" class="btn-primary-custom" data-toggle="modal" data-target="#modalTambah">
						<i class="bi bi-plus-circle-fill"></i> Tambah Kurir
					</button>
				</div>
			</div>
			<div class="card-body-custom">
				<?php if (empty($list_kurir)): ?>
					<div class="empty-state">
						<i class="bi bi-inbox"></i>
						<p class="mb-0">Belum ada data kurir.</p>
					</div>
				<?php else: ?>
					<div class="table-responsive">
						<table class="table table-custom">
							<thead>
								<tr>
									<th width="40">#</th>
									<th>Nama Kurir</th>
									<th>No. Telepon</th>
									<th>Email</th>
									<th>Lokasi Terakhir</th>
									<th>Status</th>
									<th>Terdaftar</th>
									<th width="140" class="text-center">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; foreach ($list_kurir as $row): ?>
									<tr>
										<td class="text-muted"><?= $no++; ?></td>
										<td class="link-name"><?= htmlspecialchars($row['nama_kurir']); ?></td>
										<td><?= htmlspecialchars($row['no_telepon']); ?></td>
										<td class="text-muted small"><?= $row['email'] ? htmlspecialchars($row['email']) : '-'; ?></td>
										<td class="text-muted small"><?= $row['lokasi_terakhir'] ? htmlspecialchars($row['lokasi_terakhir']) : '-'; ?></td>
										<td>
											<?php
											$badge_class = [
												'Active'   => 'badge-active',
												'Inactive' => 'badge-inactive',
												'Offline'  => 'badge-offline',
											];
											$cls = $badge_class[$row['status']] ?? 'badge-offline';
											?>
											<span class="status-badge <?= $cls; ?>"><?= $row['status']; ?></span>
										</td>
										<td class="text-muted small"><?= date('d M Y', strtotime($row['created_at'])); ?></td>
										<td class="text-center">
											<a href="<?= base_url('admin/kurir/toggle/' . $row['id_kurir']); ?>" class="btn-icon btn-toggle" title="Toggle Active/Inactive">
												<i class="bi bi-arrow-repeat"></i>
											</a>
											<button type="button" class="btn-icon btn-edit" title="Edit" data-toggle="modal" data-target="#modalEdit<?= $row['id_kurir']; ?>">
												<i class="bi bi-pencil"></i>
											</button>
											<button type="button" class="btn-icon btn-delete" title="Hapus" onclick="confirmDelete(<?= $row['id_kurir']; ?>, '<?= htmlspecialchars($row['nama_kurir'], ENT_QUOTES); ?>')">
												<i class="bi bi-trash"></i>
											</button>
										</td>
									</tr>

									<!-- MODAL EDIT (per baris) -->
									<div class="modal fade" id="modalEdit<?= $row['id_kurir']; ?>" tabindex="-1">
										<div class="modal-dialog modal-dialog-centered">
											<div class="modal-content">
												<form action="<?= base_url('admin/kurir/edit/' . $row['id_kurir']); ?>" method="post">
													<div class="modal-header">
														<h5 class="modal-title">
															<i class="bi bi-pencil-square mr-2"></i>Edit Kurir
														</h5>
														<button type="button" class="close" data-dismiss="modal">&times;</button>
													</div>
													<div class="modal-body">
														<div class="form-group">
															<label class="small font-weight-bold">Nama Kurir</label>
															<input type="text" name="nama_kurir" class="form-control form-control-custom" value="<?= htmlspecialchars($row['nama_kurir']); ?>" required>
														</div>
														<div class="form-group">
															<label class="small font-weight-bold">No. Telepon</label>
															<input type="text" name="no_telepon" class="form-control form-control-custom" value="<?= htmlspecialchars($row['no_telepon']); ?>" required>
														</div>
														<div class="form-group">
															<label class="small font-weight-bold">Email</label>
															<input type="email" name="email" class="form-control form-control-custom" value="<?= htmlspecialchars($row['email'] ?? ''); ?>">
														</div>
														<div class="form-group">
															<label class="small font-weight-bold">Lokasi Terakhir</label>
															<input type="text" name="lokasi_terakhir" class="form-control form-control-custom" value="<?= htmlspecialchars($row['lokasi_terakhir'] ?? ''); ?>">
														</div>
														<div class="form-group mb-0">
															<label class="small font-weight-bold">Status</label>
															<select name="status" class="form-control form-control-custom">
																<option value="Active" <?= $row['status'] == 'Active' ? 'selected' : ''; ?>>Active</option>
																<option value="Inactive" <?= $row['status'] == 'Inactive' ? 'selected' : ''; ?>>Inactive</option>
																<option value="Offline" <?= $row['status'] == 'Offline' ? 'selected' : ''; ?>>Offline</option>
															</select>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn-outline-custom" data-dismiss="modal">Batal</button>
														<button type="submit" class="btn-primary-custom">
															<i class="bi bi-check-circle-fill"></i> Simpan
														</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<!-- MODAL TAMBAH KURIR -->
	<div class="modal fade" id="modalTambah" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<form action="<?= base_url('admin/kurir/tambah'); ?>" method="post">
					<div class="modal-header">
						<h5 class="modal-title">
							<i class="bi bi-person-plus-fill mr-2"></i>Tambah Kurir Baru
						</h5>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label class="small font-weight-bold">Nama Kurir <span class="text-danger">*</span></label>
							<input type="text" name="nama_kurir" class="form-control form-control-custom" placeholder="Masukkan nama lengkap kurir" required>
						</div>
						<div class="form-group">
							<label class="small font-weight-bold">No. Telepon <span class="text-danger">*</span></label>
							<input type="text" name="no_telepon" class="form-control form-control-custom" placeholder="Contoh: 081234567890" required>
						</div>
						<div class="form-group">
							<label class="small font-weight-bold">Email <span class="text-muted">(opsional)</span></label>
							<input type="email" name="email" class="form-control form-control-custom" placeholder="Contoh: kurir@poktan.com">
						</div>
						<div class="form-group">
							<label class="small font-weight-bold">Lokasi Terakhir <span class="text-muted">(opsional)</span></label>
							<input type="text" name="lokasi_terakhir" class="form-control form-control-custom" placeholder="Contoh: Terminal Buah Batu">
						</div>
						<div class="form-group mb-0">
							<label class="small font-weight-bold">Status <span class="text-danger">*</span></label>
							<select name="status" class="form-control form-control-custom">
								<option value="Active">Active</option>
								<option value="Inactive">Inactive</option>
								<option value="Offline" selected>Offline</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn-outline-custom" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn-primary-custom">
							<i class="bi bi-check-circle-fill"></i> Simpan Kurir
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- MODAL KONFIRMASI HAPUS -->
	<div class="modal fade" id="modalHapus" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header border-0 pb-0">
					<h5 class="modal-title">Hapus Kurir</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body text-center py-4">
					<i class="bi bi-exclamation-triangle-fill text-danger d-block mb-3" style="font-size:2.5rem;"></i>
					<p class="mb-1">Yakin ingin menghapus kurir:</p>
					<p class="font-weight-bold" style="font-size:1.1rem;" id="namaKurirHapus"></p>
					<p class="text-muted small mb-0">Kurir yang masih punya pengiriman aktif tidak dapat dihapus.</p>
				</div>
				<div class="modal-footer border-0 pt-0 justify-content-center" style="gap:8px;">
					<button type="button" class="btn-outline-custom" data-dismiss="modal">Batal</button>
					<a href="#" id="btnConfirmHapus" class="btn" style="background:#dc2626; color:white; border-radius:10px; padding:8px 18px; font-weight:600;">Ya, Hapus</a>
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
		// 4. KONFIRMASI HAPUS
		// ============================================
		function confirmDelete(id, nama) {
			document.getElementById('namaKurirHapus').textContent = nama;
			document.getElementById('btnConfirmHapus').href = '<?= base_url('admin/kurir/hapus/'); ?>' + id;
			$('#modalHapus').modal('show');
		}

		console.log('✅ Halaman Manajemen Kurir siap digunakan!');
	</script>
</body>

</html>
