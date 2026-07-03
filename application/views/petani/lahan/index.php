<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
    }

    .menu-item a:hover {
        color: #ffffff;
        background: rgba(230, 161, 92, 0.12);
        text-decoration: none;
    }

    .menu-item.active a {
        color: #ffffff;
        background: rgba(230, 161, 92, 0.18);
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
        text-decoration: none;
    }

    /* --- STYLING KONTEN --- */
    .main-content {
        margin-left: var(--sidebar-width);
        padding: 30px 40px 40px;
        min-height: 100vh;
        transition: var(--transition-smooth);
    }

    .text-coffee-primary {
        color: #241408;
    }

    .bg-success-light {
        background-color: #e8f5e9 !important;
    }

    .bg-warning-light {
        background-color: #fff3e0 !important;
    }

    .bg-info-light {
        background-color: #e3f2fd !important;
    }

    .text-orange {
        color: #f57c00 !important;
    }

    .bg-orange-light {
        background-color: #fff3e0 !important;
    }

    .table-modern thead th {
        background-color: #f8f9fa;
        color: #6c757d;
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #edf2f7 !important;
        border-top: none !important;
    }

    .table-modern tbody td {
        border-bottom: 1px solid #edf2f7 !important;
        color: #495057;
        font-size: 0.9rem;
    }

    .table-modern tbody tr:hover {
        background-color: #fdfcfb;
    }

    .btn-action {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        font-size: 0.85rem;
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

    .notif-empty {
        text-align: center;
        padding: 40px 20px;
    }

    .notif-empty i {
        font-size: 2.5rem;
        color: #D1C9C0;
        display: block;
        margin-bottom: 10px;
    }

    .notif-empty p {
        color: var(--text-secondary);
        font-size: 0.85rem;
        margin: 0;
    }

    /* 🔔 NOTIFIKASI ANIMASI */
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

    /* RESPONSIVE NOTIF & BADGE */
    @media (max-width: 991.98px) {
        .user-badge {
            padding: 4px 10px;
            min-width: 60px;
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
        .user-badge {
            padding: 4px 8px;
            min-width: 50px;
            gap: 4px;
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
    </style>
</head>

<body>

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
                <li
                    class="menu-item <?= ($this->uri->segment(2) == 'dashboard' || $this->uri->segment(2) == '') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/dashboard'); ?>">
                        <i class="bi bi-grid-1x2-fill"></i> Dashboard
                    </a>
                </li>
                <li class="menu-item <?= ($this->uri->segment(2) == 'lahan') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/lahan'); ?>">
                        <i class="bi bi-geo-alt-fill"></i> Kelola Lahan
                        <span class="menu-badge"><?= count($lahan) ?></span>
                    </a>
                </li>
                <li class="menu-item <?= ($this->uri->segment(2) == 'panen') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/panen'); ?>">
                        <i class="bi bi-tree-fill"></i> Manajemen Panen
                    </a>
                </li>
                <li class="menu-item <?= ($this->uri->segment(2) == 'produk') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/produk'); ?>">
                        <i class="bi bi-box-seam"></i> Katalog Produk
                    </a>
                </li>
                <li class="menu-item <?= ($this->uri->segment(2) == 'transaksi') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/transaksi'); ?>">
                        <i class="bi bi-cart-check-fill"></i> Pesanan Masuk
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

    <!-- MAIN KONTEN -->
    <div class="main-content">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle"
                    style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
                    <i class="bi bi-list"></i>
                </button>
                <h3 class="font-weight-bold text-coffee-primary d-inline-block align-middle mb-1"
                    style="letter-spacing: -0.5px;">Manajemen Lahan</h3>
                <p class="text-muted small mb-0">Dashboard / Kelola Lahan</p>
            </div>

            <!-- HEADER RIGHT - NOTIF + USER BADGE -->
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
                            <span><?= (isset($unread_count) && $unread_count > 0) ? $unread_count . ' Notifikasi Belum Dibaca' : 'Semua Notifikasi'; ?></span>
                            <div>
                                <?php if (isset($unread_count) && $unread_count > 0): ?>
                                <a href="#" id="markAllReadBtn" class="mr-2">Tandai semua</a>
                                <?php endif; ?>
                                <a href="<?= base_url('petani/dashboard/history'); ?>">Lihat Semua</a>
                            </div>
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
                            <div class="notif-empty">
                                <i class="bi bi-bell-slash"></i>
                                <p>Tidak ada notifikasi</p>
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

        <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="fas fa-check-circle mr-1"></i> <?= $this->session->flashdata('success'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>

        <!-- Statistik -->
        <div class="row no-gutters mx-n2 mb-4">
            <div class="col-12 col-sm-6 col-md-3 px-2 mb-3 mb-md-0">
                <div class="card border-0 shadow-sm h-100" style="border-radius: var(--radius-card);">
                    <div class="card-body d-flex align-items-center justify-content-between p-3">
                        <div>
                            <span class="text-muted font-weight-bold small d-block mb-1">Total Lahan</span>
                            <h2 class="font-weight-bold text-dark mb-0"><?= count($lahan) ?></h2>
                            <span class="text-muted" style="font-size: 11px;">Semua Lahan</span>
                        </div>
                        <div class="bg-warning-light text-warning rounded p-3 d-flex align-items-center justify-content-center"
                            style="width: 48px; height: 48px; border-radius: 12px !important;">
                            <i class="fas fa-map fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3 px-2 mb-3 mb-md-0">
                <div class="card border-0 shadow-sm h-100" style="border-radius: var(--radius-card);">
                    <div class="card-body d-flex align-items-center justify-content-between p-3">
                        <div>
                            <span class="text-muted font-weight-bold small d-block mb-1">Lahan Aktif</span>
                            <h2 class="font-weight-bold text-dark mb-0">
                                <?php
								$aktif = 0;
								foreach ($lahan as $lh) {
									if (strtolower($lh['status_lahan']) == 'active' || $lh['status_lahan'] == 'aktif') $aktif++;
								}
								echo $aktif;
								?>
                            </h2>
                            <span class="text-success font-weight-bold d-block mt-1" style="font-size: 11px;">
                                <?= count($lahan) > 0 ? round(($aktif / count($lahan)) * 100, 1) : 0; ?>% dari total
                            </span>
                        </div>
                        <div class="bg-success-light text-success rounded p-3 d-flex align-items-center justify-content-center"
                            style="width: 48px; height: 48px; border-radius: 12px !important;">
                            <i class="fas fa-check-circle fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3 px-2 mb-3 mb-sm-0">
                <div class="card border-0 shadow-sm h-100" style="border-radius: var(--radius-card);">
                    <div class="card-body d-flex align-items-center justify-content-between p-3">
                        <div>
                            <span class="text-muted font-weight-bold small d-block mb-1">Lahan Nonaktif</span>
                            <h2 class="font-weight-bold text-dark mb-0">
                                <?php
								$nonaktif = 0;
								foreach ($lahan as $lh) {
									if (strtolower($lh['status_lahan']) == 'inactive' || $lh['status_lahan'] == 'nonaktif') $nonaktif++;
								}
								echo $nonaktif;
								?>
                            </h2>
                            <span class="text-muted d-block mt-1" style="font-size: 11px;">
                                <?= count($lahan) > 0 ? round(($nonaktif / count($lahan)) * 100, 1) : 0; ?>% dari total
                            </span>
                        </div>
                        <div class="bg-orange-light text-orange rounded p-3 d-flex align-items-center justify-content-center"
                            style="width: 48px; height: 48px; border-radius: 12px !important;">
                            <i class="fas fa-times-circle fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3 px-2">
                <div class="card border-0 shadow-sm h-100" style="border-radius: var(--radius-card);">
                    <div class="card-body d-flex align-items-center justify-content-between p-3">
                        <div>
                            <span class="text-muted font-weight-bold small d-block mb-1">Total Luas (Ha)</span>
                            <h2 class="font-weight-bold text-dark mb-0">
                                <?php
								$total_luas = 0;
								foreach ($lahan as $lh) {
									$total_luas += (float)$lh['luas'];
								}
								echo number_format($total_luas, 2, ',', '.');
								?>
                            </h2>
                            <span class="text-info font-weight-bold d-block mt-1" style="font-size: 11px;">Hektar
                                Lahan</span>
                        </div>
                        <div class="bg-info-light text-info rounded p-3 d-flex align-items-center justify-content-center"
                            style="width: 48px; height: 48px; border-radius: 12px !important;">
                            <i class="fas fa-chart-area fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter & Tambah -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: var(--radius-card);">
            <div class="card-body p-3">
                <form action="<?= base_url('petani/lahan') ?>" method="GET" class="m-0">
                    <div class="form-row align-items-center justify-content-between">
                        <div class="col-12 col-md-8">
                            <div class="form-row">
                                <div class="col-12 col-sm-5 mb-2 mb-sm-0">
                                    <!-- REVISI DI SINI: name diubah dari 'lokasi' menjadi 'keyword' -->
                                    <input type="text" name="keyword"
                                        class="form-control form-control-sm bg-light border-0 pl-3"
                                        placeholder="Cari nama lahan atau alamat..."
                                        value="<?= $this->input->get('keyword'); ?>"
                                        style="height: 38px; border-radius: 6px;">
                                </div>
                                <div class="col-12 col-sm-4 mb-2 mb-sm-0">
                                    <select name="status_lahan" class="form-control form-control-sm bg-light border-0"
                                        style="height: 38px; border-radius: 6px;">
                                        <option value="">Semua Status</option>
                                        <option value="Active"
                                            <?= $this->input->get('status_lahan') == 'Active' ? 'selected' : ''; ?>>
                                            Active</option>
                                        <option value="Inactive"
                                            <?= $this->input->get('status_lahan') == 'Inactive' ? 'selected' : ''; ?>>
                                            Inactive</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3 d-flex">
                                    <button type="submit" class="btn btn-sm text-white flex-grow-1 mr-2"
                                        style="border-radius: 6px; background-color: var(--amber-cream); border-color: var(--amber-cream);">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                    <a href="<?= base_url('petani/lahan') ?>" class="btn btn-sm btn-secondary"
                                        style="border-radius: 6px;">
                                        <i class="fas fa-sync-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 text-right mt-2 mt-md-0">
                            <a href="<?= base_url('petani/lahan/tambah') ?>"
                                class="btn font-weight-bold text-white px-3"
                                style="background-color: var(--roasted-brown); height: 38px; border-radius: 6px; display: inline-flex; align-items: center;">
                                <i class="fas fa-plus mr-2"></i> Tambah Lahan
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Data Lahan -->
        <div class="card border-0 shadow-sm" style="border-radius: var(--radius-card); overflow: hidden;">
            <div class="table-responsive">
                <table class="table table-modern align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th width="10%" class="text-center">Foto Lahan</th>
                            <th width="16%">Nama Lahan</th>
                            <th width="12%">Jenis Kopi</th>
                            <th width="12%">Jenis Tanah</th> <!-- KOLOM BARU -->
                            <th width="8%">Luas (Ha)</th>
                            <th width="15%">Lokasi / Alamat</th>
                            <th width="12%">Catatan</th>
                            <th class="text-center" width="10%">Status</th>
                            <th class="text-center" width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($lahan)): ?>
                        <?php $no = 1;
							foreach ($lahan as $lh): ?>
                        <tr>
                            <td class="text-center align-middle font-weight-bold text-muted"><?= $no++; ?></td>
                            <td class="text-center align-middle">
                                <?php if (!empty($lh['foto_lahan'])): ?>
                                <img src="<?= base_url('assets/uploads/lahan/' . $lh['foto_lahan']) ?>"
                                    class="img-thumbnail rounded shadow-sm"
                                    style="max-width: 60px; height: auto; object-fit: cover;">
                                <?php else: ?>
                                <span class="badge badge-secondary p-1 small text-white" style="font-size: 10px;">No
                                    Photo</span>
                                <?php endif; ?>
                            </td>
                            <td class="align-middle">
                                <span class="font-weight-bold text-dark"><?= $lh['nama_lahan']; ?></span>
                                <small class="text-muted d-block" style="font-size: 10px;">Lat/Lng:
                                    <?= $lh['latitude'] ?? '-'; ?>, <?= $lh['longitude'] ?? '-'; ?></small>
                            </td>
                            <td class="align-middle font-weight-bold text-coffee-primary">
                                <?= isset($lh['jenis_kopi']) ? $lh['jenis_kopi'] : '-'; ?>
                            </td>
                            <td class="align-middle text-dark font-weight-medium">
                                <?= isset($lh['jenis_tanah']) ? $lh['jenis_tanah'] : '<span class="text-muted font-italic">-</span>'; ?>
                                <!-- DATA BARU -->
                            </td>
                            <td class="align-middle font-weight-bold text-dark">
                                <?= number_format((float)$lh['luas'], 2, ',', '.'); ?>
                            </td>
                            <td class="align-middle text-muted small">
                                <?= isset($lh['lokasi']) ? character_limiter($lh['lokasi'], 35) : '-'; ?>
                            </td>
                            <td class="align-middle text-secondary small">
                                <?= (!empty($lh['catatan'])) ? character_limiter($lh['catatan'], 30) : '<span class="text-light-muted">-</span>'; ?>
                            </td>
                            <td class="text-center align-middle">
                                <?php if (strtolower($lh['status_lahan']) == 'active' || $lh['status_lahan'] == 'aktif'): ?>
                                <span class="badge bg-success-light text-success font-weight-bold px-3 py-2"
                                    style="border-radius: 4px; font-size: 11px;">Active</span>
                                <?php else: ?>
                                <span class="badge bg-warning-light text-orange font-weight-bold px-3 py-2"
                                    style="border-radius: 4px; font-size: 11px;">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="<?= base_url('petani/lahan/detail/' . $lh['id_lahan']) ?>"
                                        class="btn btn-action mr-1 text-white" style="background-color: #5c3d2e;"
                                        title="Detail"><i class="fas fa-eye"></i></a>
                                    <a href="<?= base_url('petani/lahan/edit/' . $lh['id_lahan']) ?>"
                                        class="btn btn-warning btn-action text-white mr-1" title="Edit"><i
                                            class="fas fa-pencil-alt"></i></a>
                                    <a href="<?= base_url('petani/lahan/hapus/' . $lh['id_lahan']) ?>"
                                        class="btn btn-danger btn-action" title="Hapus"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data lahan ini?')"><i
                                            class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="10" class="text-center text-muted py-5 bg-white">
                                <!-- Colspan disesuaikan jadi 10 -->
                                <i class="fas fa-folder-open fa-3x mb-3 text-secondary"></i>
                                <h6 class="font-weight-bold text-secondary mb-1">Belum Ada Data Lahan Kopi</h6>
                                <small class="text-muted">Silakan lakukan penambahan titik koordinat lahan baru
                                    menggunakan menu di atas.</small>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarMenu = document.getElementById('sidebarMenu');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            sidebarMenu.classList.toggle('open');
            sidebarOverlay.classList.toggle('active');
        });
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', function() {
            sidebarMenu.classList.remove('open');
            sidebarOverlay.classList.remove('active');
        });
    }

    // ============================================
    // NOTIFICATION DROPDOWN
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
        if (notifDropdown && !notifDropdown.contains(e.target) && notifToggle && !notifToggle.contains(e
                .target)) {
            notifDropdown.classList.remove('show');
        }
    });

    // ============================================
    // MARK ALL READ
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
                        alert('Gagal menandai semua notifikasi.');
                    }
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
    </script>
</body>

</html>