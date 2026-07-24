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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    
    <!-- PWA Meta Tags -->
    <meta name="application-name" content="LiberChain">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="LiberChain">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#4A2C11">
    <meta name="msapplication-TileColor" content="#FAF6F0">
    <meta name="msapplication-TileImage" content="<?= base_url('assets/images/pwa/icon-192x192.png') ?>">
    <link rel="manifest" href="<?= base_url('pwa/manifest') ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url('assets/images/pwa/icon-192x192.png') ?>">
    <link rel="icon" type="image/png" sizes="512x512" href="<?= base_url('assets/images/pwa/icon-512x512.png') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/images/pwa/apple-touch-icon.png') ?>">
    <link rel="apple-touch-icon" sizes="192x192" href="<?= base_url('assets/images/pwa/icon-192x192.png') ?>">
    
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
			z-index: 1000;
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
			background: rgba(0, 0, 0, 0.5);
			z-index: 999;
			backdrop-filter: blur(2px);
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
			gap: 16px;
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
			position: relative;
		}

		/* ============================================ */
		/* USER BADGE */
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
		/* NOTIFICATION BELL & DROPDOWN RESPONSIF */
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
			max-height: 420px;
			background: var(--card-white);
			border-radius: var(--radius-card);
			box-shadow: var(--shadow-hover);
			border: 1px solid rgba(74, 44, 17, 0.08);
			overflow: hidden;
			display: none;
			z-index: 9999;
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
			font-size: 0.85rem;
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

		.notif-item .notif-icon.success { background: #D1FAE5; color: #065F46; }
		.notif-item .notif-icon.warning { background: #FEF3C7; color: #92400E; }
		.notif-item .notif-icon.info { background: #DBEAFE; color: #1E40AF; }
		.notif-item .notif-icon.danger { background: #FEE2E2; color: #991B1B; }
		.notif-item .notif-icon.primary { background: #EDE9FE; color: #5B21B6; }

		.notif-item .notif-text {
			flex: 1;
			font-size: 0.85rem;
			min-width: 0;
			word-break: break-word;
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
			flex-shrink: 0;
		}

		/* ANIMASI BERGETAR PADA LONCENG */
		@keyframes bellRing {
			0%, 100% { transform: rotate(0); }
			25% { transform: rotate(12deg); }
			50% { transform: rotate(-12deg); }
			75% { transform: rotate(6deg); }
		}

		.notif-btn.ring {
			animation: bellRing 0.5s ease 1;
		}

		/* ============================================ */
		/* KPI CARDS */
		/* ============================================ */

		.kpi-grid {
			display: grid;
			grid-template-columns: repeat(4, 1fr);
			gap: 20px;
			margin-bottom: 30px;
		}

		@media (max-width: 1199.98px) {
			.kpi-grid {
				grid-template-columns: repeat(2, 1fr);
				gap: 16px;
			}
		}

		@media (max-width: 575.98px) {
			.kpi-grid {
				grid-template-columns: 1fr 1fr;
				gap: 12px;
			}
		}

		.kpi-card {
			background: var(--card-white);
			border: 1px solid rgba(74, 44, 17, 0.06);
			border-radius: var(--radius-card);
			padding: 20px 22px 18px;
			position: relative;
			box-shadow: var(--shadow-soft);
			transition: var(--transition-smooth);
			overflow: hidden;
			min-height: 120px;
			display: flex;
			flex-direction: column;
			justify-content: space-between;
		}

		.kpi-card:hover {
			transform: translateY(-4px);
			box-shadow: var(--shadow-hover);
			border-color: rgba(230, 161, 92, 0.2);
		}

		.kpi-card .kpi-decoration {
			position: absolute;
			right: -30px;
			top: -30px;
			width: 100px;
			height: 100px;
			border-radius: 50%;
			background: rgba(230, 161, 92, 0.04);
			pointer-events: none;
		}

		.kpi-card .kpi-top {
			display: flex;
			align-items: flex-start;
			justify-content: space-between;
			margin-bottom: 4px;
		}

		.kpi-card .kpi-title {
			font-size: 0.65rem;
			font-weight: 700;
			text-transform: uppercase;
			color: var(--text-secondary);
			letter-spacing: 0.7px;
			margin: 0;
			line-height: 1.3;
		}

		.kpi-card .kpi-badge {
			width: 38px;
			height: 38px;
			min-width: 38px;
			border-radius: 10px;
			background: var(--bg-cream);
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 1rem;
			color: var(--roasted-brown);
			transition: var(--transition-smooth);
		}

		.kpi-card:hover .kpi-badge {
			transform: scale(1.05) rotate(-3deg);
		}

		.kpi-card .kpi-badge.amber { background: var(--amber-cream); color: white; }
		.kpi-card .kpi-badge.green { background: #059669; color: white; }
		.kpi-card .kpi-badge.dark { background: var(--dark-coffee); color: white; }
		.kpi-card .kpi-badge.blue { background: #3B82F6; color: white; }

		.kpi-card .kpi-number {
			font-size: 1.6rem;
			font-weight: 700;
			color: var(--dark-coffee);
			margin: 2px 0 0;
			line-height: 1.2;
			padding-right: 10px;
			letter-spacing: -0.5px;
			word-break: break-word;
		}

		.kpi-card .kpi-number.rupiah {
			font-size: 1.3rem;
		}

		.kpi-card .kpi-footer {
			display: flex;
			align-items: center;
			gap: 6px;
			margin-top: 8px;
			font-size: 0.7rem;
			color: var(--text-secondary);
		}

		.kpi-card .kpi-footer .label {
			color: var(--text-secondary);
			font-weight: 400;
		}

		/* ============================================ */
		/* QUICK ACTION BUTTONS - RAPI */
		/* ============================================ */

		.quick-actions-grid {
			display: grid;
			grid-template-columns: repeat(5, 1fr);
			gap: 12px;
			margin-bottom: 30px;
		}

		@media (max-width: 991.98px) {
			.quick-actions-grid {
				grid-template-columns: repeat(3, 1fr);
				gap: 10px;
			}
		}

		@media (max-width: 575.98px) {
			.quick-actions-grid {
				grid-template-columns: repeat(2, 1fr);
				gap: 8px;
			}
		}

		.quick-action-btn {
			padding: 12px 14px;
			border: 1px solid rgba(74, 44, 17, 0.06);
			border-radius: 10px;
			background: var(--card-white);
			color: var(--dark-coffee);
			transition: var(--transition-smooth);
			display: flex;
			align-items: center;
			justify-content: center;
			gap: 10px;
			font-weight: 600;
			font-size: 0.8rem;
			cursor: pointer;
			width: 100%;
			text-decoration: none;
			text-align: center;
		}

		.quick-action-btn:hover {
			background: var(--bg-cream);
			border-color: var(--amber-cream);
			transform: translateY(-2px);
			box-shadow: var(--shadow-soft);
			text-decoration: none;
			color: var(--dark-coffee);
		}

		.quick-action-btn i {
			font-size: 1.1rem;
			color: var(--amber-cream);
		}

		.quick-action-btn .btn-label {
			font-size: 0.7rem;
			font-weight: 500;
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

		/* ============================================ */
		/* CHART */
		/* ============================================ */

		.chart-container {
			position: relative;
			height: 250px;
			width: 100%;
		}

		/* ============================================ */
		/* TABLE */
		/* ============================================ */

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
			white-space: nowrap;
		}

		.table-custom tbody td {
			padding: 10px 8px;
			border-bottom: 1px solid rgba(74, 44, 17, 0.04);
			vertical-align: middle;
			white-space: nowrap;
		}

		.table-custom tbody tr:hover {
			background: rgba(250, 246, 240, 0.3);
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

		.status-badge.pending { background: #FEF3C7; color: #92400E; }
		.status-badge.processing { background: #DBEAFE; color: #1E40AF; }
		.status-badge.delivery { background: #EDE9FE; color: #5B21B6; }
		.status-badge.complete { background: #D1FAE5; color: #065F46; }
		.status-badge.cancelled { background: #FEE2E2; color: #991B1B; }
		.status-badge.verified { background: #D1FAE5; color: #065F46; }
		.status-badge.review { background: #FEF3C7; color: #92400E; }

		/* ============================================ */
		/* CUSTOM SWITCH */
		/* ============================================ */

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
		/* OPTIMATED RESPONSIVE CSS */
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

			/* Fix Notif Dropdown Tablet */
			.notif-dropdown {
				width: 340px;
				right: 0;
			}

			.user-badge {
				padding: 4px 10px;
				min-width: 70px;
			}

			.user-badge i {
				font-size: 1.1rem;
			}

			.user-badge .user-name {
				font-size: 0.75rem;
			}

			.user-badge .user-role {
				font-size: 0.55rem;
			}

			.header-right {
				gap: 8px;
			}
		}

		@media (max-width: 575.98px) {
			.main-content {
				padding: 16px 12px 20px;
			}

			/* Notif Dropdown Mobile - Full Width Pass */
			.notif-dropdown {
				position: fixed;
				top: 70px;
				left: 12px;
				right: 12px;
				width: calc(100vw - 24px);
				max-height: 80vh;
			}

			.notif-dropdown-list {
				max-height: 55vh;
			}

			.user-badge {
				padding: 4px 8px;
				min-width: auto;
				gap: 5px;
			}

			.user-badge i {
				font-size: 1rem;
			}

			.user-badge .user-name {
				font-size: 0.68rem;
			}

			.user-badge .user-role {
				display: none;
			}

			.header-right {
				gap: 6px;
			}

			.page-header {
				margin-bottom: 20px;
				padding-bottom: 14px;
			}

			.page-header .subtitle {
				font-size: 0.75rem;
			}

			.kpi-card .kpi-number {
				font-size: 1.25rem;
			}

			.kpi-card .kpi-number.rupiah {
				font-size: 1.05rem;
			}

			.custom-card .card-header-custom {
				padding: 14px 16px;
			}

			.custom-card .card-body-custom {
				padding: 16px;
			}

			.chart-container {
				height: 200px;
			}
		}

		@media (max-width: 380px) {
			.quick-actions-grid {
				grid-template-columns: 1fr;
			}
			
			.kpi-grid {
				grid-template-columns: 1fr;
			}
		}
	</style>
</head>

<body>

	<!-- 🔔 AUDIO NOTIFIKASI REAL-TIME -->
	<audio id="notifSound" preload="auto">
		<source src="<?= base_url('assets/sounds/notifikasi.wav'); ?>" type="audio/wav">
		<source src="<?= base_url('assets/sounds/notifikasi.mp3'); ?>" type="audio/mpeg">
	</audio>

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
				<li class="menu-item active">
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
							<span class="menu-badge"
								style="background: #F59E0B; color: white;"><?= $petani_baru_count; ?></span>
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
							<span class="menu-badge"
								style="background: #EF4444; color: white;"><?= $transaksi_pending; ?></span>
						<?php endif; ?>
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
						<?php if (isset($mitra_baru) && $mitra_baru > 0): ?>
							<span class="menu-badge" style="background: #F59E0B; color: white;"><?= $mitra_baru; ?></span>
						<?php endif; ?>
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/tracking'); ?>">
						<i class="bi bi-geo-alt-fill"></i>Tracking Pengiriman
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

	<!-- SIDEBAR OVERLAY -->
	<div class="sidebar-overlay" id="sidebarOverlay"></div>

	<!-- MAIN CONTENT -->
	<div class="main-content">

		<!-- PAGE HEADER -->
		<div class="page-header">
			<div>
				<button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle"
					style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
					<i class="bi bi-list"></i>
				</button>
				<h2 class="d-inline-block align-middle mb-0">Dashboard</h2>
				<p class="subtitle mb-0 mt-1">
					Selamat datang, <span style="color: var(--amber-cream); font-weight:600;">
						<?= $this->session->userdata('nama') ?? 'Admin' ?>
					</span>!
					<span id="currentDateTime" style="color: var(--text-secondary); font-size:0.85rem;"></span>
				</p>
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
									<?php
									$icon_type = $n['icon'] ?? 'info';
									$icon_map = [
										'success' => 'bi-check-circle-fill',
										'warning' => 'bi-exclamation-triangle-fill',
										'danger' => 'bi-x-circle-fill',
										'info' => 'bi-info-circle-fill',
										'primary' => 'bi-star-fill'
									];
									$icon_class = $icon_map[$icon_type] ?? 'bi-info-circle-fill';
									?>
									<a class="notif-item <?= (isset($n['status_baca']) && $n['status_baca'] == '0') ? 'unread' : ''; ?>"
										href="<?= base_url('admin/dashboard/read/' . $n['id_notifikasi']); ?>">
										<div class="notif-icon <?= $icon_type; ?>">
											<i class="bi <?= $icon_class; ?>"></i>
										</div>
										<div class="notif-text">
											<?= htmlspecialchars($n['isi_notifikasi'] ?? $n['judul'] ?? 'Notifikasi'); ?>
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

		<!-- ============================================ -->
		<!-- QUICK ACTION BUTTONS - RAPI PAKAI GRID -->
		<!-- ============================================ -->
		<h5 class="font-weight-bold mb-3"
			style="font-size: 0.75rem; color: var(--text-secondary); letter-spacing: 0.7px; text-transform: uppercase;">
			<i class="bi bi-lightning-fill text-warning mr-1"></i> Aksi Cepat
		</h5>
		<div class="quick-actions-grid">
			<a href="<?= base_url('admin/petani'); ?>" class="quick-action-btn">
				<i class="bi bi-person-check-fill"></i>
				<span class="btn-label">Verifikasi Petani</span>
			</a>
			<a href="<?= base_url('admin/transaksi/konfirmasi'); ?>" class="quick-action-btn">
				<i class="bi bi-credit-card-fill"></i>
				<span class="btn-label">Konfirmasi Bayar</span>
			</a>
			<a href="<?= base_url('admin/laporan'); ?>" class="quick-action-btn">
				<i class="bi bi-file-earmark-pdf-fill"></i>
				<span class="btn-label">Buat Laporan</span>
			</a>
			<a href="<?= base_url('admin/produk/tambah'); ?>" class="quick-action-btn">
				<i class="bi bi-plus-circle-fill"></i>
				<span class="btn-label">Tambah Produk</span>
			</a>
			<a href="<?= base_url('admin/mitra/add'); ?>" class="quick-action-btn">
				<i class="bi bi-shop"></i>
				<span class="btn-label">Tambah Mitra</span>
			</a>
		</div>

		<!-- ============================================ -->
		<!-- KPI CARDS - RAPI PAKAI GRID -->
		<!-- ============================================ -->
		<div class="kpi-grid">
			<!-- Total Pendapatan -->
			<div class="kpi-card">
				<div class="kpi-decoration"></div>
				<div class="kpi-top">
					<span class="kpi-title">Total Pendapatan</span>
					<div class="kpi-badge amber">
						<i class="bi bi-currency-dollar"></i>
					</div>
				</div>
				<div class="kpi-number rupiah">Rp <?= number_format($kpi_total_revenue ?? 0, 0, ',', '.'); ?></div>
				<div class="kpi-footer">
					<span class="label">Akumulasi seluruh penjualan</span>
				</div>
			</div>

			<!-- Total Transaksi -->
			<div class="kpi-card">
				<div class="kpi-decoration"></div>
				<div class="kpi-top">
					<span class="kpi-title">Total Transaksi</span>
					<div class="kpi-badge blue">
						<i class="bi bi-receipt"></i>
					</div>
				</div>
				<div class="kpi-number"><?= number_format($kpi_transaksi_aktif ?? 0, 0, ',', '.'); ?></div>
				<div class="kpi-footer">
					<span class="label">Semua status pesanan</span>
				</div>
			</div>

			<!-- Petani Aktif -->
			<div class="kpi-card">
				<div class="kpi-decoration"></div>
				<div class="kpi-top">
					<span class="kpi-title">Petani Aktif</span>
					<div class="kpi-badge green">
						<i class="bi bi-people-fill"></i>
					</div>
				</div>
				<div class="kpi-number"><?= number_format($kpi_petani_terverifikasi ?? 0, 0, ',', '.'); ?></div>
				<div class="kpi-footer">
					<span class="label">Petani terverifikasi</span>
				</div>
			</div>

			<!-- Mitra Aktif -->
			<div class="kpi-card">
				<div class="kpi-decoration"></div>
				<div class="kpi-top">
					<span class="kpi-title">Mitra Aktif</span>
					<div class="kpi-badge dark">
						<i class="bi bi-shop"></i>
					</div>
				</div>
				<div class="kpi-number"><?= number_format($kpi_mitra_cafe ?? 0, 0, ',', '.'); ?></div>
				<div class="kpi-footer">
					<span class="label">Kerjasama aktif</span>
				</div>
			</div>
		</div>

		<!-- ============================================ -->
		<!-- GRAFIK & PRODUK TERLARIS -->
		<!-- ============================================ -->
		<div class="row">
			<div class="col-lg-8 mb-4">
				<div class="custom-card">
					<div class="card-header-custom">
						<h6><i class="bi bi-graph-up-arrow text-warning mr-2"></i> Grafik Penjualan Bulanan</h6>
						<div>
							<span class="badge"
								style="background: var(--bg-cream); color: var(--text-secondary); font-weight:500;"><?= date('Y'); ?></span>
							<button class="btn btn-sm btn-link text-muted" onclick="refreshChart()"
								style="padding:0 4px;">
								<i class="bi bi-arrow-repeat"></i>
							</button>
						</div>
					</div>
					<div class="card-body-custom">
						<div class="chart-container">
							<canvas id="salesChart"></canvas>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 mb-4">
				<div class="custom-card">
					<div class="card-header-custom">
						<h6><i class="bi bi-trophy-fill text-warning mr-2"></i> Produk Terlaris</h6>
						<span class="badge" style="background: #D1FAE5; color: #065F46; font-weight:500;">Top 5</span>
					</div>
					<div class="card-body-custom" style="padding: 16px 20px;">
						<?php if (!empty($produk_terlaris)): ?>
							<?php foreach ($produk_terlaris as $index => $product): ?>
								<div class="d-flex align-items-center justify-content-between py-2 <?= $index < count($produk_terlaris) - 1 ? 'border-bottom' : ''; ?>"
									style="border-color: rgba(74,44,17,0.05);">
									<div class="d-flex align-items-center gap-2">
										<span class="badge"
											style="background: <?= $index === 0 ? 'var(--amber-cream)' : 'var(--bg-cream)'; ?>; color: <?= $index === 0 ? 'white' : 'var(--text-secondary)'; ?>; width: 24px; height:24px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:0.7rem;">
											<?= $index + 1; ?>
										</span>
										<span
											style="font-weight:600; font-size:0.85rem;"><?= $product['nama'] ?? $product['nama_produk'] ?? 'Produk'; ?></span>
									</div>
									<div class="text-right">
										<span style="font-weight:600; font-size:0.85rem;"><?= $product['total_terjual'] ?? 0; ?>
											kg</span>
										<small class="d-block text-muted" style="font-size:0.7rem;">Rp
											<?= number_format($product['pendapatan'] ?? 0, 0, ',', '.'); ?></small>
									</div>
								</div>
							<?php endforeach; ?>
						<?php else: ?>
							<div class="text-center py-3 text-muted">Belum ada data produk terjual</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>

		<!-- ============================================ -->
		<!-- PESANAN TERBARU & PETANI BARU -->
		<!-- ============================================ -->
		<div class="row">
			<div class="col-lg-6 mb-4">
				<div class="custom-card">
					<div class="card-header-custom">
						<h6><i class="bi bi-clock-history text-primary mr-2"></i> Pesanan Terbaru</h6>
						<a href="<?= base_url('admin/transaksi'); ?>" class="text-muted"
							style="font-size:0.75rem;">Lihat semua <i class="bi bi-chevron-right"></i></a>
					</div>
					<div class="card-body-custom" style="padding:0;">
						<div class="table-responsive">
							<table class="table table-custom mb-0">
								<thead>
									<tr>
										<th>Invoice</th>
										<th>Metode Bayar</th>
										<th>Total</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<?php if (!empty($pesanan_terbaru)): ?>
										<?php foreach ($pesanan_terbaru as $order): ?>
											<tr>
												<td><b>#<?= $order['id_transaksi']; ?></b></td>
												<td><?= $order['metode_bayar'] ?? 'Transfer'; ?></td>
												<td>Rp <?= number_format($order['total_harga'] ?? 0, 0, ',', '.'); ?></td>
												<td>
													<span
														class="status-badge <?= strtolower($order['status_pesanan'] ?? 'pending'); ?>">
														<?= ucfirst($order['status_pesanan'] ?? 'Pending'); ?>
													</span>
												</td>
											</tr>
										<?php endforeach; ?>
									<?php else: ?>
										<tr>
											<td colspan="4" class="text-center py-3 text-muted">Belum ada pesanan</td>
										</tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- PETANI BARU -->
			<div class="col-lg-6 mb-4">
				<div class="custom-card">
					<div class="card-header-custom">
						<h6><i class="bi bi-person-plus-fill text-success mr-2"></i> Petani Baru</h6>
						<a href="<?= base_url('admin/petani'); ?>" class="text-muted" style="font-size:0.75rem;">Lihat
							semua <i class="bi bi-chevron-right"></i></a>
					</div>
					<div class="card-body-custom" style="padding:0;">
						<div class="table-responsive">
							<table class="table table-custom mb-0">
								<thead>
									<tr>
										<th>Nama</th>
										<th>Status</th>
										<th>Tgl Daftar</th>
										<th>Verifikasi</th>
									</tr>
								</thead>
								<tbody>
									<?php if (!empty($petani_baru)): ?>
										<?php foreach ($petani_baru as $farmer): ?>
											<tr>
												<td><b><?= $farmer['nama'] ?? $farmer['nama_petani'] ?? '-'; ?></b></td>
												<td>
													<?php
													$status = $farmer['status'] ?? $farmer['status_petani'] ?? 'Pending';
													echo $status == 'Active' ? 'Aktif' : 'Menunggu';
													?>
												</td>
												<td><?= date('d-m-Y', strtotime($farmer['created_at'] ?? $farmer['tanggal_daftar'] ?? date('Y-m-d'))); ?>
												</td>
												<td>
													<span
														class="status-badge <?= ($status == 'Active' || $status == 'verified') ? 'verified' : 'review'; ?>">
														<?= ($status == 'Active' || $status == 'verified') ? 'Terverifikasi' : 'Review'; ?>
													</span>
												</td>
											</tr>
										<?php endforeach; ?>
									<?php else: ?>
										<tr>
											<td colspan="4" class="text-center py-3 text-muted">Belum ada petani baru</td>
										</tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- ============================================ -->
		<!-- SETTING NOTIFIKASI - TANPA LAPORAN BULANAN -->
		<!-- ============================================ -->
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
						// Default settings untuk Admin - TANPA LAPORAN BULANAN
						$default_settings = [
							'notif_transaksi' => 1,
							'notif_pembayaran' => 1,
							'notif_stok' => 1,
							'notif_petani' => 1,
							'notif_kurir' => 1,
							'notif_sistem' => 1
						];

						// Gabungkan dengan data dari database
						if (!empty($settings)) {
							foreach ($default_settings as $key => $value) {
								if (isset($settings[$key])) {
									$default_settings[$key] = (int) $settings[$key];
								}
							}
						}
						?>
						<form method="POST" action="<?= base_url('admin/dashboard/settings'); ?>">
							<div class="row">
								<div class="col-md-3 col-6 mb-2">
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="notif_transaksi"
											name="notif_transaksi" <?= $default_settings['notif_transaksi'] == 1 ? 'checked' : ''; ?>>
										<label class="custom-control-label" for="notif_transaksi"
											style="font-size:0.85rem;">Transaksi Baru</label>
									</div>
								</div>
								<div class="col-md-3 col-6 mb-2">
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="notif_pembayaran"
											name="notif_pembayaran" <?= $default_settings['notif_pembayaran'] == 1 ? 'checked' : ''; ?>>
										<label class="custom-control-label" for="notif_pembayaran"
											style="font-size:0.85rem;">Konfirmasi Bayar</label>
									</div>
								</div>
								<div class="col-md-3 col-6 mb-2">
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="notif_stok"
											name="notif_stok" <?= $default_settings['notif_stok'] == 1 ? 'checked' : ''; ?>>
										<label class="custom-control-label" for="notif_stok"
											style="font-size:0.85rem;">Peringatan Stok</label>
									</div>
								</div>
								<div class="col-md-3 col-6 mb-2">
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="notif_petani"
											name="notif_petani" <?= $default_settings['notif_petani'] == 1 ? 'checked' : ''; ?>>
										<label class="custom-control-label" for="notif_petani"
											style="font-size:0.85rem;">Registrasi Petani</label>
									</div>
								</div>
								<div class="col-md-3 col-6 mb-2">
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="notif_kurir"
											name="notif_kurir" <?= $default_settings['notif_kurir'] == 1 ? 'checked' : ''; ?>>
										<label class="custom-control-label" for="notif_kurir"
											style="font-size:0.85rem;">Status Pengiriman</label>
									</div>
								</div>
								<div class="col-md-3 col-6 mb-2">
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="notif_sistem"
											name="notif_sistem" <?= $default_settings['notif_sistem'] == 1 ? 'checked' : ''; ?>>
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
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>

	<!-- SCRIPTS -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	
	<!-- PWA Service Worker Registration -->
	<script>
	if ('serviceWorker' in navigator) {
		window.addEventListener('load', function() {
			navigator.serviceWorker.register('<?= base_url('pwa/service_worker') ?>')
				.then(function(registration) {
					console.log('[LiberChain PWA] ServiceWorker registered:', registration.scope);
				})
				.catch(function(error) {
					console.warn('[LiberChain PWA] ServiceWorker registration failed:', error);
				});
		});
	}
	</script>
	
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

		document.addEventListener('click', function (e) {
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
		// 3. MARK ALL READ
		// ============================================
		function markAllRead() {
			if (confirm('Tandai semua notifikasi sebagai sudah dibaca?')) {
				$.ajax({
					url: '<?= base_url('api/notifikasi/mark_all_read'); ?>',
					type: 'POST',
					dataType: 'json',
					success: function (response) {
						if (response.success) location.reload();
						else alert('Gagal menandai semua notifikasi.');
					},
					error: function () {
						alert('Terjadi kesalahan. Silakan coba lagi.');
					}
				});
			}
		}

		document.getElementById('markAllReadBtn')?.addEventListener('click', function (e) {
			e.preventDefault();
			markAllRead();
		});

		// ============================================
		// 4. CHART
		// ============================================
		let salesChart;

		function initChart() {
			const ctx = document.getElementById('salesChart')?.getContext('2d');
			if (!ctx) return;

			const chartLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
			const chartData = <?= isset($grafik_penjualan['values']) ? json_encode($grafik_penjualan['values']) : json_encode(array_fill(0, 12, 0)); ?>;

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
									return context.parsed.y.toLocaleString('id-ID') + ' kg';
								}
							}
						}
					},
					scales: {
						y: {
							beginAtZero: true,
							grid: {
								color: 'rgba(74, 44, 17, 0.06)',
								drawBorder: false
							},
							ticks: {
								font: {
									size: 10,
									family: 'Plus Jakarta Sans'
								},
								color: '#70655E',
								stepSize: 50,
								callback: function (value) {
									return value.toLocaleString('id-ID') + ' kg';
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
			if (el) el.textContent = now.toLocaleDateString('id-ID', options);
		}
		updateDateTime();
		setInterval(updateDateTime, 60000);

		// ============================================
		// 6. SWITCH HANDLING
		// ============================================
		document.querySelectorAll('.custom-control-input').forEach(function (switchEl) {
			switchEl.addEventListener('change', function () {
				const label = this.closest('.custom-control').querySelector('.custom-control-label');
				const setting = label ? label.textContent.trim() : 'Unknown';
				console.log('Notifikasi ' + setting + (this.checked ? ' diaktifkan' : ' dinonaktifkan'));
			});
		});

		// ============================================
		// 7. REAL-TIME NOTIFICATION & SOUND EFFECT
		// ============================================
		let currentUnreadCount = <?= isset($unread_count) ? (int)$unread_count : 0; ?>;

		function playNotifSound() {
			const audio = document.getElementById('notifSound');
			if (audio) {
				audio.currentTime = 0;
				let promise = audio.play();
				if (promise !== undefined) {
					promise.catch(function(e) {
						console.log('🔇 Autoplay ditahan browser sampai ada interaksi klik pertama user.');
					});
				}
			}
		}

		function fetchRealtimeNotifications() {
			$.ajax({
				url: '<?= base_url("api/notifikasi/get"); ?>',
				type: 'GET',
				dataType: 'json',
				success: function(response) {
					if (response.success) {
						const newCount = parseInt(response.unread) || 0;
						const countEl = $('#notifCount');
						const notifBtn = $('#notifToggle');

						// 🔔 Bunyikan suara & animasi jika ada notifikasi baru
						if (newCount > currentUnreadCount) {
							playNotifSound();
							notifBtn.addClass('ring');
							setTimeout(function() {
								notifBtn.removeClass('ring');
							}, 1000);
						}

						// Update badge counter
						currentUnreadCount = newCount;
						if (newCount > 0) {
							countEl.text(newCount).show();
						} else {
							countEl.text(0).hide();
						}

						// Update item list dropdown secara dinamis
						if (response.notifikasi && response.notifikasi.length > 0) {
							let htmlList = '';
							$.each(response.notifikasi, function(i, n) {
								let iconType = n.icon || 'info';
								let iconMap = {
									'success': 'bi-check-circle-fill',
									'warning': 'bi-exclamation-triangle-fill',
									'danger': 'bi-x-circle-fill',
									'info': 'bi-info-circle-fill',
									'primary': 'bi-star-fill'
								};
								let iconClass = iconMap[iconType] || 'bi-info-circle-fill';

								htmlList += `
									<a class="notif-item ${n.status_baca == '0' ? 'unread' : ''}" href="<?= base_url('admin/dashboard/read/'); ?>${n.id_notifikasi}">
										<div class="notif-icon ${iconType}">
											<i class="bi ${iconClass}"></i>
										</div>
										<div class="notif-text">
											${n.isi_notifikasi || n.judul || 'Notifikasi'}
											<span class="notif-time">${n.tanggal_buat}</span>
										</div>
										${n.status_baca == '0' ? '<span class="notif-badge-new">Baru</span>' : ''}
									</a>
								`;
							});
							$('#notifList').html(htmlList);
						}
					}
				},
				error: function(err) {
					console.warn('⚠️ Gagal memuat notifikasi real-time');
				}
			});
		}

		// Run real-time polling every 5 seconds
		setInterval(fetchRealtimeNotifications, 5000);

		// ============================================
		// 8. INITIALIZE
		// ============================================
		document.addEventListener('DOMContentLoaded', function () {
			initChart();
		});

		console.log('✅ Dashboard Admin siap digunakan!');
		console.log('📋 Fitur yang tersedia:');
		console.log('   - KPI Cards (M11-F01) - Data Real');
		console.log('   - Grafik Penjualan (M10-F02) - Data Real');
		console.log('   - Produk Terlaris (M10-F04) - Data Real');
		console.log('   - Pesanan Terbaru (M11-F01) - Data Real');
		console.log('   - Petani Baru (M11-F01) - Data Real');
		console.log('   - Quick Action (M11-F04) - 5 Aksi Rapi');
		console.log('   - Notifikasi Real-time & Audio Sound via API (Auto 5 detik)');
		console.log('   - Setting Notifikasi (M11-F03) - 6 Opsi (Tanpa Laporan Bulanan)');
	</script>
</body>

</html>