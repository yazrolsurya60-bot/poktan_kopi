<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Panel Produksi - Petani Kopi'; ?></title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- Load JS Dependencies in Head for inline script support -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    
    <!-- PWA Meta Tags -->
    <meta name="application-name" content="LiberChain">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#4A2C11">
    <link rel="manifest" href="<?= base_url('pwa/manifest') ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url('assets/images/pwa/icon-192x192.png') ?>">
    
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

        /* --- SIDEBAR --- */
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
            border-bottom: 1px solid rgba(250, 246, 240, 0.08);
            color: var(--amber-cream);
            display: flex; align-items: center; gap: 10px;
        }
        .sidebar-brand .brand-icon {
            width: 40px; height: 40px;
            background: rgba(230, 161, 92, 0.15);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem;
        }
        .sidebar-menu-wrapper { flex: 1; overflow-y: auto; padding: 15px 0; }
        
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

        .sidebar-menu { list-style: none; margin: 0; padding: 0; }
        .menu-item a {
            display: flex; align-items: center; padding: 12px 24px;
            color: #A8988A; font-weight: 500; font-size: 0.9rem;
            text-decoration: none; transition: var(--transition-smooth);
            position: relative; margin: 2px 10px; border-radius: 10px;
        }
        .menu-item a i { font-size: 1.15rem; margin-right: 14px; width: 22px; text-align: center; }
        .menu-item a .menu-badge {
            margin-left: auto; background: rgba(230, 161, 92, 0.2);
            color: var(--amber-cream); font-size: 0.7rem; padding: 2px 10px;
            border-radius: 20px; font-weight: 600;
        }
        .menu-item a .menu-badge.danger { background: #EF4444; color: white; }
        .menu-item a .menu-badge.success { background: #10B981; color: white; }
        .menu-item.active a, .menu-item a:hover {
            color: #ffffff; background: rgba(230, 161, 92, 0.12);
        }
        .menu-item.active a {
            background: rgba(230, 161, 92, 0.18);
            border-left: 3px solid var(--amber-cream);
        }
        .sidebar-footer {
            padding: 16px 20px; border-top: 1px solid rgba(250, 246, 240, 0.06); margin-top: auto;
        }
        .sidebar-footer .btn-logout {
            width: 100%; padding: 10px 16px; border: 1px solid rgba(250, 246, 240, 0.1);
            border-radius: 10px; background: transparent; color: #A8988A;
            font-weight: 500; font-size: 0.85rem; display: flex; align-items: center; justify-content: center; gap: 10px; cursor: pointer;
            transition: var(--transition-smooth);
        }
        .sidebar-footer .btn-logout:hover { background: rgba(230, 161, 92, 0.1); color: #ffffff; border-color: rgba(230, 161, 92, 0.2); }

        /* --- MAIN CONTENT & HEADER --- */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 30px 40px 40px;
            min-height: 100vh;
            transition: var(--transition-smooth);
        }
        .page-header {
            border-bottom: 1px solid rgba(74, 44, 17, 0.08);
            padding-bottom: 20px; margin-bottom: 30px;
            display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;
        }
        .page-header h2 { font-weight: 700; color: var(--dark-coffee); letter-spacing: -0.02em; }
        .page-header .subtitle { color: var(--text-secondary); font-size: 0.9rem; margin-top: 2px; }
        
        .header-right { display: flex; align-items: center; gap: 12px; position: relative; flex-shrink: 0; }
        .user-badge {
            display: flex; align-items: center; gap: 8px; padding: 6px 12px;
            border-radius: 10px; background: var(--card-white); border: 1px solid rgba(74, 44, 17, 0.06);
            font-weight: 500; font-size: 0.85rem; min-width: 90px;
        }
        .user-badge i { font-size: 1.4rem; color: var(--amber-cream); }
        .user-badge .user-name { font-weight: 600; font-size: 0.82rem; line-height: 1.2; color: var(--dark-coffee); }
        .user-badge .user-role { font-size: 0.6rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.5px; }
        
        /* NOTIFIKASI */
        .notif-btn {
            position: relative; background: var(--card-white); border: 1px solid rgba(74, 44, 17, 0.06);
            border-radius: 12px; padding: 8px 14px; color: var(--dark-coffee); cursor: pointer;
            transition: var(--transition-smooth); display: flex; align-items: center; gap: 8px;
        }
        .notif-btn:hover { background: var(--bg-cream); box-shadow: var(--shadow-soft); }
        .notif-btn .notif-dot {
            position: absolute; top: -4px; right: -4px; width: 18px; height: 18px;
            background: #EF4444; border-radius: 50%; font-size: 0.6rem; color: white;
            display: flex; align-items: center; justify-content: center; font-weight: 700; border: 2px solid white;
        }
        .notif-dropdown {
            position: absolute; right: 0; top: calc(100% + 10px); width: 380px; max-height: 420px;
            background: var(--card-white); border-radius: var(--radius-card); box-shadow: var(--shadow-hover);
            border: 1px solid rgba(74, 44, 17, 0.08); display: none; z-index: 9999; overflow: hidden;
        }
        .notif-dropdown.show { display: block; animation: slideDown 0.25s ease; }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        .notif-dropdown-header { padding: 14px 18px; border-bottom: 1px solid rgba(74, 44, 17, 0.06); display: flex; justify-content: space-between; font-weight: 600; font-size: 0.85rem; align-items: center; }
        .notif-dropdown-header a { font-size: 0.75rem; color: var(--amber-cream); font-weight: 500; text-decoration: none; }
        .notif-dropdown-list { max-height: 300px; overflow-y: auto; }
        .notif-item { padding: 12px 18px; border-bottom: 1px solid rgba(74, 44, 17, 0.04); display: flex; gap: 12px; cursor: pointer; text-decoration: none; color: inherit; align-items: flex-start; transition: var(--transition-smooth); }
        .notif-item:hover { background: var(--bg-cream); text-decoration: none; color: inherit; }
        .notif-item .notif-icon { width: 36px; height: 36px; min-width: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; flex-shrink:0; }
        .notif-item .notif-icon.success { background: #D1FAE5; color: #065F46; }
        .notif-item .notif-icon.warning { background: #FEF3C7; color: #92400E; }
        .notif-item .notif-icon.info { background: #DBEAFE; color: #1E40AF; }
        .notif-item .notif-icon.danger { background: #FEE2E2; color: #991B1B; }
        .notif-item .notif-text { flex: 1; font-size: 0.85rem; min-width: 0; word-break: break-word; }
        .notif-item .notif-text .notif-time { font-size: 0.7rem; color: var(--text-secondary); display: block; margin-top: 2px; }
        .notif-item.unread { background: rgba(230, 161, 92, 0.05); }
        .notif-item.unread .notif-text { font-weight: 600; }
        .notif-badge-new { background: var(--amber-cream); color: white; font-size: 0.55rem; padding: 2px 8px; border-radius: 10px; align-self: center; flex-shrink: 0; }

        /* TOAST */
        .toast-container { position: fixed; bottom: 20px; right: 20px; z-index: 9999; display: flex; flex-direction: column; gap: 10px; }
        .toast-item { padding: 12px 24px; border-radius: 10px; color: white; font-weight: 600; font-size: 0.85rem; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15); transform: translateX(100%); opacity: 0; transition: all 0.4s; }
        .toast-item.show { transform: translateX(0); opacity: 1; }
        .toast-item.success { background: #065F46; }
        .toast-item.error { background: #991B1B; }

        /* OVERLAY & MEDIA QUERIES */
        .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.5); z-index: 999; backdrop-filter: blur(2px); }
        .sidebar-overlay.active { display: block; }
        
        @keyframes bellRing {
            0%, 100% { transform: rotate(0); }
            25% { transform: rotate(12deg); }
            50% { transform: rotate(-12deg); }
            75% { transform: rotate(6deg); }
        }
        .notif-btn.ring { animation: bellRing 0.5s ease 1; }

        @media (max-width: 991.98px) {
            .sidebar { left: calc(-1 * var(--sidebar-width)); box-shadow: none; }
            .sidebar.open { left: 0; box-shadow: 0 0 40px rgba(0, 0, 0, 0.3); }
            .main-content { margin-left: 0; padding: 20px 16px 30px; }
            .notif-dropdown { width: 340px; right: 0; }
        }
        @media (max-width: 575.98px) {
            .notif-dropdown { position: fixed; top: 70px; left: 12px; right: 12px; width: calc(100vw - 24px); max-height: 80vh; }
            .notif-dropdown-list { max-height: 55vh; }
            .user-badge .user-role { display: none; }
        }
    </style>
</head>
<body>

    <!-- AUDIO NOTIFIKASI DISSEMBUNYIKAN AGAR TIDAK MUNCUL IKON SPEAKER DI TAB -->
 	<audio id="notifSound" preload="auto">
		<source src="<?= base_url('assets/sounds/notifikasi.wav'); ?>" type="audio/wav">
		<source src="<?= base_url('assets/sounds/notifikasi.mp3'); ?>" type="audio/mpeg">
	</audio>

    <!-- SIDEBAR OVERLAY -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- MAIN CONTENT START -->
    <div class="main-content">
        <!-- TOPBAR / PAGE HEADER -->
        <div class="page-header">
            <div>
                <button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle" style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
                    <i class="bi bi-list"></i>
                </button>
                <h2 class="d-inline-block align-middle mb-0"><?= isset($title_page) ? $title_page : 'Halaman'; ?></h2>
                <p class="subtitle mb-0 mt-1"><?= isset($subtitle) ? $subtitle : ''; ?></p>
            </div>
            
            <div class="header-right">
                <!-- NOTIFICATION BELL -->
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
                            <span id="notifHeaderTitle"><?= isset($unread_count) && $unread_count > 0 ? $unread_count . ' Notifikasi Belum Dibaca' : 'Semua Notifikasi'; ?></span>
                            <div>
                                <?php if (isset($unread_count) && $unread_count > 0): ?>
                                    <a href="#" id="markAllReadBtn" class="mr-2" style="font-size:0.7rem; text-decoration:none;">Tandai semua</a>
                                <?php endif; ?>
                                <a href="<?= base_url('petani/dashboard/history'); ?>" style="font-size:0.7rem; text-decoration:none;">Lihat Semua</a>
                            </div>
                        </div>

                        <div class="notif-dropdown-list" id="notifList">
                            <?php if (!empty($notifikasi)): ?>
                                <?php foreach ($notifikasi as $n): ?>
                                    <a class="notif-item <?= (isset($n['status_baca']) && $n['status_baca'] == '0') ? 'unread' : ''; ?>" href="<?= base_url('petani/dashboard/read/' . $n['id_notifikasi']); ?>">
                                        <?php
                                        $icon_type = $n['icon'] ?? 'info';
                                        $icon_map = ['success' => 'bi-check-circle-fill', 'warning' => 'bi-exclamation-triangle-fill', 'danger' => 'bi-x-circle-fill', 'info' => 'bi-info-circle-fill'];
                                        $icon_class = $icon_map[$icon_type] ?? 'bi-info-circle-fill';
                                        ?>
                                        <div class="notif-icon <?= $icon_type; ?>">
                                            <i class="bi <?= $icon_class; ?>"></i>
                                        </div>
                                        <div class="notif-text">
                                            <?= htmlspecialchars($n['isi_notifikasi'] ?? $n['judul'] ?? 'Notifikasi'); ?>
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
                            <a href="<?= base_url('petani/dashboard/settings'); ?>" class="small text-secondary font-weight-bold text-decoration-none">
                                <i class="bi bi-gear-fill mr-1"></i> Pengaturan Notifikasi
                            </a>
                        </div>
                    </div>
                </div>

                <!-- USER BADGE -->
                <div class="user-badge">
                    <i class="bi bi-person-circle"></i>
                    <div>
                        <div class="user-name"><?= $this->session->userdata('nama') ?? 'Petani'; ?></div>
                        <div class="user-role"><?= isset($role) ? $role : 'Petani'; ?></div>
                    </div>
                </div>
            </div>
        </div>
