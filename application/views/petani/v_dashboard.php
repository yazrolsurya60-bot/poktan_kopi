<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Panel Produksi - Petani Kopi</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
			transition: var(--transition-smooth);
		}

		.menu-item a .menu-badge.danger {
			background: #EF4444;
			color: white;
		}

		.menu-item a .menu-badge.warning {
			background: #F59E0B;
			color: white;
		}

		.menu-item a .menu-badge.success {
			background: #10B981;
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

		/* --- QUICK ACTION BUTTONS --- */
		.quick-action-btn {
			padding: 12px 16px;
			border: 1px solid rgba(74, 44, 17, 0.06);
			border-radius: 10px;
			background: var(--card-white);
			color: var(--dark-coffee);
			transition: var(--transition-smooth);
			display: flex;
			align-items: center;
			gap: 12px;
			font-weight: 600;
			font-size: 0.85rem;
			cursor: pointer;
			width: 100%;
			text-decoration: none;
			box-shadow: var(--shadow-soft);
		}

		.quick-action-btn:hover {
			background: var(--bg-cream);
			border-color: var(--amber-cream);
			transform: translateY(-2px);
			box-shadow: var(--shadow-hover);
			text-decoration: none;
			color: var(--dark-coffee);
		}

		.quick-action-btn .q-icon {
			width: 38px;
			height: 38px;
			border-radius: 10px;
			background: rgba(230, 161, 92, 0.1);
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 1.1rem;
			color: var(--amber-cream);
			transition: var(--transition-smooth);
		}

		.quick-action-btn:hover .q-icon {
			background: var(--amber-cream);
			color: white;
		}

		.quick-action-btn .q-text {
			flex: 1;
		}

		.quick-action-btn .q-arrow {
			color: var(--text-secondary);
			transition: var(--transition-smooth);
		}

		.quick-action-btn:hover .q-arrow {
			color: var(--amber-cream);
			transform: translateX(4px);
		}

		/* --- CALENDAR / JADWAL PANEN --- */
		.harvest-schedule-item {
			display: flex;
			align-items: center;
			gap: 14px;
			padding: 10px 0;
			border-bottom: 1px solid rgba(74, 44, 17, 0.05);
		}

		.harvest-schedule-item:last-child {
			border-bottom: none;
		}

		.schedule-date {
			min-width: 50px;
			text-align: center;
		}

		.schedule-date .day {
			font-size: 1.3rem;
			font-weight: 700;
			color: var(--dark-coffee);
			line-height: 1;
		}

		.schedule-date .month {
			font-size: 0.6rem;
			text-transform: uppercase;
			color: var(--text-secondary);
			font-weight: 600;
		}

		.schedule-info {
			flex: 1;
		}

		.schedule-info .title {
			font-weight: 600;
			font-size: 0.85rem;
		}

		.schedule-info .detail {
			font-size: 0.75rem;
			color: var(--text-secondary);
		}

		/* ============================================ */
		/* TOAST NOTIFICATION */
		/* ============================================ */
		.toast-container {
			position: fixed;
			bottom: 20px;
			right: 20px;
			z-index: 9999;
			display: flex;
			flex-direction: column;
			gap: 10px;
		}

		.toast-item {
			padding: 12px 24px;
			border-radius: 10px;
			color: white;
			font-weight: 600;
			font-size: 0.85rem;
			box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
			transform: translateX(100%);
			opacity: 0;
			transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
			font-family: 'Plus Jakarta Sans', sans-serif;
			max-width: 400px;
		}

		.toast-item.show {
			transform: translateX(0);
			opacity: 1;
		}

		.toast-item.success {
			background: #065F46;
		}

		.toast-item.error {
			background: #991B1B;
		}

		.toast-item.warning {
			background: #92400E;
		}

		.toast-item.info {
			background: #1E40AF;
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

			.quick-action-btn {
				padding: 10px 14px;
				font-size: 0.8rem;
			}

			.quick-action-btn .q-icon {
				width: 32px;
				height: 32px;
				font-size: 0.9rem;
			}

			.sidebar-overlay.active {
				display: block;
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

			.quick-action-btn {
				padding: 8px 12px;
				font-size: 0.75rem;
				gap: 8px;
			}

			.quick-action-btn .q-icon {
				width: 28px;
				height: 28px;
				font-size: 0.8rem;
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
		/* 🔔 NOTIFIKASI ANIMASI */
		/* ============================================ */

		@keyframes notifPulse {

			0%,
			100% {
				transform: scale(1);
			}

			30% {
				transform: scale(1.5);
				background: #EF4444;
			}

			60% {
				transform: scale(0.9);
			}
		}

		@keyframes bellRing {

			0%,
			100% {
				transform: rotate(0);
			}

			25% {
				transform: rotate(10deg);
			}

			50% {
				transform: rotate(-10deg);
			}

			75% {
				transform: rotate(5deg);
			}
		}

		.notif-dot.pulse {
			animation: notifPulse 0.6s ease 3;
		}

		.notif-btn.ring {
			animation: bellRing 0.5s ease 1;
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
			<span>PETANI <br><small style="font-weight:400; font-size:0.7rem; color:#A8988A;">Liberchain</small></span>
		</div>
		<div class="sidebar-menu-wrapper">
			<ul class="sidebar-menu">
				<li class="menu-item active">
					<a href="<?= base_url('petani/dashboard'); ?>">
						<i class="bi bi-grid-1x2-fill"></i>Dashboard
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('petani/lahan'); ?>">
						<i class="bi bi-geo-alt-fill"></i>Kelola Lahan
						<span class="menu-badge success"><?= $kpi_lahan_aktif ?? 0 ?></span>
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('petani/panen'); ?>">
						<i class="bi bi-tree-fill"></i>Manajemen Panen
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('petani/produk'); ?>">
						<i class="bi bi-box-seam"></i>Katalog Produk
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('petani/transaksi'); ?>">
						<i class="bi bi-cart-check-fill"></i>Pesanan Masuk
						<span class="menu-badge danger"><?= $kpi_pesanan_masuk ?? 0 ?></span>
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
				<button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle"
					style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
					<i class="bi bi-list"></i>
				</button>
				<h2 class="d-inline-block align-middle mb-0">Panel Produksi</h2>
				<p class="subtitle mb-0 mt-1">Selamat datang, <span
						style="color: var(--amber-cream); font-weight:600;">
						<?= $this->session->userdata('nama') ?? 'Petani' ?>
					</span>!
					<span id="currentDateTime" style="color: var(--text-secondary); font-size:0.85rem;"></span>
				</p>
			</div>
			<div class="header-right">
				<!-- NOTIFICATION BELL (M11-F01) -->
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
							<a href="<?= base_url('petani/dashboard/history'); ?>"
								style="font-size:0.75rem; color: var(--amber-cream); font-weight:500; text-decoration:none;">Lihat
								Semua</a>
						</div>
						<div class="notif-dropdown-list" id="notifList">
							<?php if (!empty($notifikasi)): ?>
								<?php foreach ($notifikasi as $n): ?>
									<a class="notif-item <?= (isset($n['status_baca']) && $n['status_baca'] == '0') ? 'unread' : ''; ?>"
										href="<?= base_url('petani/dashboard/read/' . $n['id_notifikasi']); ?>">
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
							<a href="<?= base_url('petani/dashboard/settings'); ?>"
								class="small text-secondary font-weight-bold text-decoration-none">
								<i class="bi bi-gear-fill mr-1"></i> Pengaturan Notifikasi
							</a>
						</div>
					</div>
				</div>

				<!-- USER BADGE -->
				<?php
				$nama = $this->session->userdata('nama') ?? 'Petani';
				$role = $this->session->userdata('role') ?? 'Petani';
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

		<!-- QUICK ACTION BUTTONS - TANPA TUGASKAN KURIR -->
		<h5 class="font-weight-bold mb-3"
			style="font-size: 0.75rem; color: var(--text-secondary); letter-spacing: 0.7px; text-transform: uppercase;">
			<i class="bi bi-lightning-fill text-warning mr-1"></i> Aksi Cepat
		</h5>
		<div class="row mb-4">
			<div class="col-lg-3 col-md-4 col-6 mb-3">
				<a href="<?= base_url('petani/lahan/tambah'); ?>" class="quick-action-btn">
					<div class="q-icon"><i class="bi bi-geo-alt-fill"></i></div>
					<span class="q-text">Tambah Lahan</span>
					<i class="bi bi-chevron-right q-arrow"></i>
				</a>
			</div>
			<div class="col-lg-3 col-md-4 col-6 mb-3">
				<a href="<?= base_url('petani/panen/tambah'); ?>" class="quick-action-btn">
					<div class="q-icon"><i class="bi bi-calendar-plus-fill"></i></div>
					<span class="q-text">Input Panen</span>
					<i class="bi bi-chevron-right q-arrow"></i>
				</a>
			</div>
			<div class="col-lg-3 col-md-4 col-6 mb-3">
				<a href="<?= base_url('petani/produk/tambah'); ?>" class="quick-action-btn">
					<div class="q-icon"><i class="bi bi-plus-circle-fill"></i></div>
					<span class="q-text">Tambah Produk</span>
					<i class="bi bi-chevron-right q-arrow"></i>
				</a>
			</div>
			<div class="col-lg-3 col-md-4 col-6 mb-3">
				<a href="<?= base_url('petani/transaksi'); ?>" class="quick-action-btn">
					<div class="q-icon"><i class="bi bi-box-seam-fill"></i></div>
					<span class="q-text">Proses Pesanan</span>
					<i class="bi bi-chevron-right q-arrow"></i>
				</a>
			</div>
		</div>

		<!-- KPI CARDS - DATA REAL -->
		<div class="row mb-4">
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="stat-box">
					<div class="stat-decoration"></div>
					<div class="stat-title">Total Hasil Panen</div>
					<h3 class="stat-num"><?= number_format($kpi_total_panen ?? 0, 0, ',', '.'); ?> Kg</h3>
					<div class="stat-change up"><i class="bi bi-arrow-up"></i> Data real-time</div>
					<div class="stat-badge" style="background: var(--amber-cream); color: white;"><i
							class="bi bi-archive-fill"></i></div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="stat-box">
					<div class="stat-decoration"></div>
					<div class="stat-title">Omset Penjualan</div>
					<h3 class="stat-num">Rp <?= number_format($kpi_omset_penjualan ?? 0, 0, ',', '.'); ?></h3>
					<div class="stat-change up"><i class="bi bi-arrow-up"></i> Data real-time</div>
					<div class="stat-badge" style="background: #059669; color: white;"><i class="bi bi-cash-stack"></i>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="stat-box">
					<div class="stat-decoration"></div>
					<div class="stat-title">Lahan Aktif</div>
					<h3 class="stat-num"><?= $kpi_lahan_aktif ?? 0; ?> Kebun</h3>
					<div class="stat-change up"><i class="bi bi-arrow-up"></i> Data real-time</div>
					<div class="stat-badge"><i class="bi bi-globe-asia-australia"></i></div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="stat-box">
					<div class="stat-decoration"></div>
					<div class="stat-title">Pesanan Masuk</div>
					<h3 class="stat-num"><?= $kpi_pesanan_masuk ?? 0; ?> Pesanan</h3>
					<div class="stat-change up"><i class="bi bi-arrow-up"></i> Data real-time</div>
					<div class="stat-badge" style="background: var(--dark-coffee); color: white;"><i
							class="bi bi-cart-fill"></i></div>
				</div>
			</div>
		</div>

		<!-- GRAFIK & PRODUK -->
		<div class="row">
			<!-- GRAFIK PANEN - DATA REAL -->
			<div class="col-lg-8 mb-4">
				<div class="custom-card">
					<div class="card-header-custom">
						<h6><i class="bi bi-graph-up-arrow text-warning mr-2"></i> Grafik Hasil Panen Bulanan</h6>
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
							<canvas id="harvestChart"></canvas>
						</div>
					</div>
				</div>
			</div>

			<!-- TOP PRODUK TERJUAL - DATA REAL -->
			<div class="col-lg-4 mb-4">
				<div class="custom-card">
					<div class="card-header-custom">
						<h6><i class="bi bi-trophy-fill text-warning mr-2"></i> Produk Terjual</h6>
						<span class="badge" style="background: #D1FAE5; color: #065F46; font-weight:500;">Top 5</span>
					</div>
					<div class="card-body-custom" style="padding: 16px 20px;">
						<?php if (!empty($produk_terjual)): ?>
							<?php foreach ($produk_terjual as $index => $product): ?>
								<div class="d-flex align-items-center justify-content-between py-2 <?= $index < count($produk_terjual) - 1 ? 'border-bottom' : ''; ?>"
									style="border-color: rgba(74,44,17,0.05);">
									<div class="d-flex align-items-center gap-2">
										<span class="badge"
											style="background: <?= $index === 0 ? 'var(--amber-cream)' : 'var(--bg-cream)'; ?>; color: <?= $index === 0 ? 'white' : 'var(--text-secondary)'; ?>; width: 24px; height:24px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:0.7rem;">
											<?= $index + 1; ?>
										</span>
										<span style="font-weight:600; font-size:0.85rem;"><?= $product['nama'] ?? $product['nama_produk']; ?></span>
									</div>
									<div class="text-right">
										<span style="font-weight:600; font-size:0.85rem;"><?= number_format($product['total_terjual'] ?? 0, 0, ',', '.'); ?> kg</span>
										<small class="d-block text-muted" style="font-size:0.7rem;">Rp <?= number_format($product['pendapatan'] ?? 0, 0, ',', '.'); ?></small>
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

		<!-- PESANAN MASUK & STOK -->
		<div class="row">
			<!-- PESANAN MASUK TERBARU - DATA REAL -->
			<div class="col-lg-6 mb-4">
				<div class="custom-card">
					<div class="card-header-custom">
						<h6><i class="bi bi-cart-fill text-success mr-2"></i> Pesanan Masuk Terbaru</h6>
						<a href="<?= base_url('petani/transaksi'); ?>" class="text-muted" style="font-size:0.75rem;">Lihat semua <i class="bi bi-chevron-right"></i></a>
					</div>
					<div class="card-body-custom" style="padding:0;">
						<div class="table-responsive">
							<table class="table table-custom mb-0">
								<thead>
									<tr>
										<th>Invoice</th>
										<th>Produk</th>
										<th>Qty</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<?php if (!empty($pesanan_masuk)): ?>
										<?php foreach ($pesanan_masuk as $order): ?>
											<tr>
												<td><b>#<?= $order['invoice'] ?? 'INV-001'; ?></b></td>
												<td><?= $order['nama_produk'] ?? 'Produk'; ?></td>
												<td><span class="badge" style="background: var(--bg-cream); color: var(--dark-coffee);"><?= $order['qty'] ?? '0'; ?> kg</span></td>
												<td><span class="status-badge <?= strtolower($order['status_pesanan'] ?? 'pending'); ?>"><?= ucfirst($order['status_pesanan'] ?? 'Pending'); ?></span></td>
											</tr>
										<?php endforeach; ?>
									<?php else: ?>
										<tr>
											<td colspan="4" class="text-center py-3 text-muted">Belum ada pesanan masuk</td>
										</tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<!-- PERINGATAN STOK - DATA REAL -->
			<div class="col-lg-6 mb-4">
				<div class="custom-card">
					<div class="card-header-custom">
						<h6><i class="bi bi-bell-fill text-warning mr-2"></i> Peringatan Stok</h6>
						<span class="badge" style="background: #FEF3C7; color: #92400E; font-weight:500;">Perlu Diisi</span>
					</div>
					<div class="card-body-custom" style="padding:0;">
						<div class="table-responsive">
							<table class="table table-custom mb-0">
								<thead>
									<tr>
										<th>Nama Komoditas</th>
										<th>Sisa Stok</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<?php if (!empty($notif_stok_tipis)): ?>
										<?php foreach ($notif_stok_tipis as $stok): ?>
											<tr>
												<td><b><?= $stok['nama_produk'] ?? 'Produk'; ?></b></td>
												<td><span style="font-weight:600;"><?= $stok['stok_produk'] ?? 0; ?> kg</span></td>
												<td>
													<?php
													$stok_value = $stok['stok_produk'] ?? 0;
													if ($stok_value <= 0) {
														$status_class = 'stok_habis';
														$status_text = 'Habis';
													} elseif ($stok_value < 20) {
														$status_class = 'stok_tipis';
														$status_text = 'Menipis';
													} else {
														$status_class = 'stok_aman';
														$status_text = 'Aman';
													}
													?>
													<span class="status-badge <?= $status_class; ?>">
														<?= $status_text; ?>
													</span>
												</td>
											</tr>
										<?php endforeach; ?>
									<?php else: ?>
										<tr>
											<td colspan="3" class="text-center py-3 text-muted">Semua stok aman</td>
										</tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- RINGKASAN PRODUK & SETTING NOTIFIKASI -->
		<div class="row">
			<!-- RINGKASAN PRODUK - PENGGANTI JADWAL PANEN -->
			<div class="col-lg-6 mb-4">
				<div class="custom-card">
					<div class="card-header-custom">
						<h6><i class="bi bi-box-seam-fill text-warning mr-2"></i> Ringkasan Produk</h6>
						<span class="badge" style="background: var(--bg-cream); color: var(--text-secondary); font-weight:500;">Stok & Harga</span>
					</div>
					<div class="card-body-custom">
						<?php
						// Ambil 3 produk terbaru dari database
						$this->db->where('id_user', $id_user);
						$this->db->limit(3);
						$this->db->order_by('id_produk', 'DESC');
						$produk_terbaru = $this->db->get('tb_produk')->result_array();
						?>
						<?php if (!empty($produk_terbaru)): ?>
							<?php foreach ($produk_terbaru as $p): ?>
								<div class="d-flex align-items-center justify-content-between py-2 border-bottom" style="border-color: rgba(74,44,17,0.05);">
									<div>
										<span style="font-weight:600; font-size:0.85rem;"><?= $p['nama_produk'] ?? 'Produk' ?></span>
										<div style="font-size:0.75rem; color: var(--text-secondary);">
											<i class="bi bi-tag mr-1"></i> Rp <?= number_format($p['harga'] ?? 0, 0, ',', '.') ?>
											<span class="mx-1">•</span>
											<i class="bi bi-box mr-1"></i> <?= $p['stok_produk'] ?? 0 ?> kg
										</div>
									</div>
									<?php
									$stok = $p['stok_produk'] ?? 0;
									if ($stok <= 0) {
										$badge_class = 'danger';
										$badge_text = 'Habis';
									} elseif ($stok < 20) {
										$badge_class = 'warning';
										$badge_text = 'Menipis';
									} else {
										$badge_class = 'success';
										$badge_text = 'Aman';
									}
									?>
									<span class="badge" style="background: <?= $badge_class == 'danger' ? '#FEE2E2' : ($badge_class == 'warning' ? '#FEF3C7' : '#D1FAE5') ?>; color: <?= $badge_class == 'danger' ? '#991B1B' : ($badge_class == 'warning' ? '#92400E' : '#065F46') ?>; padding: 4px 12px; border-radius: 20px; font-weight:600; font-size:0.7rem;">
										<?= $badge_text ?>
									</span>
								</div>
							<?php endforeach; ?>
						<?php else: ?>
							<div class="text-center py-3 text-muted">
								<i class="bi bi-box-seam d-block mb-2" style="font-size:2rem;"></i>
								<p>Belum ada produk. <a href="<?= base_url('petani/produk/tambah'); ?>" style="color: var(--amber-cream); font-weight:600;">Tambahkan produk pertama</a></p>
							</div>
						<?php endif; ?>
						<div class="mt-3 text-center">
							<a href="<?= base_url('petani/produk'); ?>" class="btn btn-sm" style="background: var(--bg-cream); color: var(--dark-coffee); border-radius:8px; font-weight:600; padding: 6px 20px;">
								<i class="bi bi-arrow-right mr-1"></i> Kelola Semua Produk
							</a>
						</div>
					</div>
				</div>
			</div>

			<!-- SETTING NOTIFIKASI -->
			<div class="col-lg-6 mb-4">
				<div class="custom-card">
					<div class="card-header-custom">
						<h6><i class="bi bi-gear-fill text-secondary mr-2"></i> Preferensi Notifikasi</h6>
						<span class="badge" style="background: var(--bg-cream); color: var(--text-secondary); font-weight:500;">Pengaturan</span>
					</div>
					<div class="card-body-custom">
						<?php
						// 🔴 DEFAULT SETTINGS UNTUK PETANI - LENGKAP 7 ITEM
						$default_settings = [
							'notif_transaksi' => 1,   // Pesanan Baru
							'notif_pembayaran' => 1,  // Konfirmasi Bayar
							'notif_stok' => 1,        // Peringatan Stok
							'notif_kurir' => 1,       // Status Kiriman
							'notif_panen' => 0,       // 🔴 JADWAL PANEN DINONAKTIFKAN
							'notif_laporan' => 0,     // Laporan Bulanan
							'notif_sistem' => 1       // Update Sistem
						];

						// 🔴 GABUNGKAN DENGAN DATA DARI DATABASE
						if (!empty($settings)) {
							foreach ($default_settings as $key => $value) {
								if (isset($settings[$key])) {
									$default_settings[$key] = (int)$settings[$key];
								}
							}
						}
						?>
						<form method="POST" action="<?= base_url('petani/dashboard/settings'); ?>" id="settingsForm">
							<div class="row">
								<!-- Pesanan Baru -->
								<div class="col-md-6 col-6 mb-2">
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="notif_transaksi" name="notif_transaksi"
											<?= $default_settings['notif_transaksi'] == 1 ? 'checked' : ''; ?>>
										<label class="custom-control-label" for="notif_transaksi" style="font-size:0.85rem;">Pesanan Baru</label>
									</div>
								</div>
								<!-- Konfirmasi Bayar -->
								<div class="col-md-6 col-6 mb-2">
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="notif_pembayaran" name="notif_pembayaran"
											<?= $default_settings['notif_pembayaran'] == 1 ? 'checked' : ''; ?>>
										<label class="custom-control-label" for="notif_pembayaran" style="font-size:0.85rem;">Konfirmasi Bayar</label>
									</div>
								</div>
								<!-- Peringatan Stok -->
								<div class="col-md-6 col-6 mb-2">
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="notif_stok" name="notif_stok"
											<?= $default_settings['notif_stok'] == 1 ? 'checked' : ''; ?>>
										<label class="custom-control-label" for="notif_stok" style="font-size:0.85rem;">Peringatan Stok</label>
									</div>
								</div>
								<!-- Status Kiriman -->
								<div class="col-md-6 col-6 mb-2">
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="notif_kurir" name="notif_kurir"
											<?= $default_settings['notif_kurir'] == 1 ? 'checked' : ''; ?>>
										<label class="custom-control-label" for="notif_kurir" style="font-size:0.85rem;">Status Kiriman</label>
									</div>
								</div>
								<!-- Update Sistem -->
								<div class="col-md-6 col-6 mb-2">
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="notif_sistem" name="notif_sistem"
											<?= $default_settings['notif_sistem'] == 1 ? 'checked' : ''; ?>>
										<label class="custom-control-label" for="notif_sistem" style="font-size:0.85rem;">Update Sistem</label>
									</div>
								</div>
							</div>
							<div class="mt-3 pt-2 border-top" style="border-color: rgba(74,44,17,0.06);">
								<button type="submit" class="btn" style="background: var(--roasted-brown); color: white; border-radius:10px; padding: 8px 24px; font-weight:600; font-size:0.85rem;">
									<i class="bi bi-save mr-1"></i> Simpan Pengaturan
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- TOAST CONTAINER -->
		<div class="toast-container" id="toastContainer"></div>

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
			// 3. TOAST NOTIFICATION
			// ============================================
			function showToast(message, type = 'success') {
				const container = document.getElementById('toastContainer');
				if (!container) return;

				const toast = document.createElement('div');
				toast.className = `toast-item ${type}`;
				toast.textContent = message;
				container.appendChild(toast);

				setTimeout(() => {
					toast.classList.add('show');
				}, 100);

				setTimeout(() => {
					toast.classList.remove('show');
					setTimeout(() => {
						toast.remove();
					}, 400);
				}, 3000);
			}

			// ============================================
			// 4. MARK ALL READ
			// ============================================
			function markAllRead() {
				if (confirm('Tandai semua notifikasi sebagai sudah dibaca?')) {
					$.ajax({
						url: '<?= base_url('petani/dashboard/mark_all_read_ajax'); ?>',
						type: 'POST',
						dataType: 'json',
						success: function(response) {
							if (response.success) {
								location.reload();
							} else {
								showToast('Gagal menandai semua notifikasi.', 'error');
							}
						},
						error: function() {
							showToast('Terjadi kesalahan. Silakan coba lagi.', 'error');
						}
					});
				}
			}

			// ============================================
			// 5. CHART.JS - GRAFIK PANEN (DATA REAL)
			// ============================================
			let harvestChart;

			function initChart() {
				const ctx = document.getElementById('harvestChart')?.getContext('2d');
				if (!ctx) return;

				const chartLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
				const chartData = <?= isset($grafik_panen['values']) ? json_encode($grafik_panen['values']) : json_encode(array_fill(0, 12, 0)); ?>;

				harvestChart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: chartLabels,
						datasets: [{
							label: 'Hasil Panen (Kg)',
							data: chartData,
							backgroundColor: 'rgba(230, 161, 92, 0.8)',
							borderColor: '#E6A15C',
							borderWidth: 2,
							borderRadius: 6,
							barPercentage: 0.6
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
									label: function(context) {
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
									drawBorder: false,
								},
								ticks: {
									font: {
										size: 10,
										family: 'Plus Jakarta Sans'
									},
									color: '#70655E',
									stepSize: 50,
									callback: function(value) {
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
									color: '#70655E',
								}
							}
						}
					}
				});
			}

			function refreshChart() {
				if (harvestChart) {
					$.get('<?= base_url('petani/dashboard/get_chart_data'); ?>', function(data) {
						if (data.success) {
							harvestChart.data.datasets[0].data = data.values;
							harvestChart.update();
							showToast('Grafik berhasil diperbarui!', 'success');
						}
					}).fail(function() {
						showToast('Gagal memperbarui grafik.', 'error');
					});
				}
			}

			document.addEventListener('DOMContentLoaded', function() {
				initChart();
			});

			// ============================================
			// 6. CURRENT DATE TIME
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
			// 7. SWITCH HANDLING - UPDATE VIA AJAX (REAL-TIME)
			// ============================================
			document.querySelectorAll('.custom-control-input').forEach(function(switchEl) {
				switchEl.removeEventListener('change', handleSwitchChange);
				switchEl.addEventListener('change', handleSwitchChange);
			});

			function handleSwitchChange() {
				const field = this.getAttribute('id');
				const value = this.checked ? 1 : 0;

				const allowedFields = ['notif_transaksi', 'notif_pembayaran', 'notif_stok', 'notif_kurir', 'notif_panen', 'notif_laporan', 'notif_sistem'];
				if (!allowedFields.includes(field)) {
					return;
				}

				const label = this.closest('.custom-control').querySelector('.custom-control-label');
				if (label) {
					label.style.opacity = '0.5';
				}

				$.ajax({
					url: '<?= base_url('petani/dashboard/update_settings_ajax'); ?>',
					type: 'POST',
					data: {
						field: field,
						value: value
					},
					dataType: 'json',
					success: function(response) {
						if (label) {
							label.style.opacity = '1';
						}

						if (response.success) {
							const labelText = label ? label.textContent.trim() : field;
							showToast('✅ ' + labelText + ' ' + (value === 1 ? 'diaktifkan' : 'dinonaktifkan'), 'success');
							console.log('✅ Setting ' + field + ' updated to ' + value);
						} else {
							this.checked = !this.checked;
							showToast('❌ Gagal memperbarui pengaturan', 'error');
						}
					}.bind(this),
					error: function() {
						if (label) {
							label.style.opacity = '1';
						}
						this.checked = !this.checked;
						showToast('❌ Terjadi kesalahan. Silakan coba lagi.', 'error');
					}.bind(this)
				});
			}

			// ============================================
			// 8. FORM SETTINGS - SUBMIT VIA AJAX
			// ============================================
			const settingsForm = document.getElementById('settingsForm');
			if (settingsForm) {
				settingsForm.addEventListener('submit', function(e) {
					e.preventDefault();

					const formData = new FormData(this);
					const data = {};
					formData.forEach((value, key) => {
						data[key] = value === 'on' ? 1 : 0;
					});

					const btn = this.querySelector('button[type="submit"]');
					const originalText = btn.innerHTML;
					btn.innerHTML = '<i class="bi bi-hourglass-split mr-1"></i> Menyimpan...';
					btn.disabled = true;

					$.ajax({
						url: this.action,
						type: 'POST',
						data: data,
						dataType: 'json',
						success: function(response) {
							btn.innerHTML = originalText;
							btn.disabled = false;

							if (response.success) {
								showToast('✅ Pengaturan notifikasi berhasil diperbarui!', 'success');
								Object.keys(data).forEach(key => {
									const el = document.getElementById(key);
									if (el) {
										el.checked = data[key] === 1;
									}
								});
							} else {
								showToast('❌ Gagal memperbarui pengaturan', 'error');
							}
						},
						error: function() {
							btn.innerHTML = originalText;
							btn.disabled = false;
							showToast('❌ Terjadi kesalahan. Silakan coba lagi.', 'error');
						}
					});
				});
			}

			// ============================================
			// 9. AUTO-REFRESH NOTIFICATION COUNT
			// ============================================
			function refreshNotificationCount() {
				$.get('<?= base_url('petani/dashboard/get_notifications_ajax'); ?>', function(response) {
					if (response.success) {
						const countEl = document.getElementById('notifCount');
						if (countEl) {
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

			setInterval(refreshNotificationCount, 30000);

			console.log('✅ Dashboard Petani siap digunakan!');
			console.log('📋 Fitur yang tersedia:');
			console.log('   - KPI Cards - Data Real');
			console.log('   - Grafik Panen - Data Real');
			console.log('   - Produk Terjual - Data Real');
			console.log('   - Pesanan Masuk - Data Real');
			console.log('   - Peringatan Stok - Data Real');
			console.log('   - Jadwal Panen - Data Real');
			console.log('   - Quick Action');
			console.log('   - Notifikasi Real-time');
			console.log('   - Setting Notifikasi (selaras dengan database)');
			console.log('   - Switch update via AJAX (real-time)');
			console.log('   - Form settings submit via AJAX');
		</script>

</body>

</html>
