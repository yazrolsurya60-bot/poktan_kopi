<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi - Pembeli</title>
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
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-cream); color: var(--dark-coffee); overflow-x: hidden; }
        
        /* SIDEBAR */
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
            box-shadow: 4px 0 25px rgba(44,24,8,0.2);
            display: flex;
            flex-direction: column;
        }
        .sidebar-brand { padding: 28px 24px 20px; font-size: 1.1rem; font-weight: 700; border-bottom: 1px solid rgba(250,246,240,0.08); color: var(--amber-cream); display: flex; align-items: center; gap: 10px; }
        .sidebar-brand .brand-icon { width: 40px; height: 40px; background: rgba(230, 161, 92, 0.15); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; }
        .sidebar-menu-wrapper { flex: 1; overflow-y: auto; padding: 15px 0; }
        .sidebar-menu { list-style: none; margin: 0; padding: 0; }
        .menu-item a { display: flex; align-items: center; padding: 12px 24px; color: #A8988A; font-weight: 500; font-size: 0.9rem; text-decoration: none; transition: var(--transition-smooth); position: relative; margin: 2px 10px; border-radius: 10px; }
        .menu-item a i { font-size: 1.15rem; margin-right: 14px; width: 22px; text-align: center; }
        .menu-item a .menu-badge { margin-left: auto; background: rgba(230, 161, 92, 0.2); color: var(--amber-cream); font-size: 0.7rem; padding: 2px 10px; border-radius: 20px; font-weight: 600; }
        .menu-item.active a, .menu-item a:hover { color: #ffffff; background: rgba(230, 161, 92, 0.12); }
        .menu-item.active a { background: rgba(230, 161, 92, 0.18); border-left: 3px solid var(--amber-cream); }
        .menu-item.active a::before { content: ''; position: absolute; left: 0; top: 50%; transform: translateY(-50%); width: 3px; height: 24px; background: var(--amber-cream); border-radius: 0 3px 3px 0; }
        .sidebar-footer { padding: 16px 20px; border-top: 1px solid rgba(250, 246, 240, 0.06); margin-top: auto; }
        .sidebar-footer .btn-logout { width: 100%; padding: 10px 16px; border: 1px solid rgba(250, 246, 240, 0.1); border-radius: 10px; background: transparent; color: #A8988A; font-weight: 500; font-size: 0.85rem; transition: var(--transition-smooth); display: flex; align-items: center; justify-content: center; gap: 10px; cursor: pointer; }
        .sidebar-footer .btn-logout:hover { background: rgba(230, 161, 92, 0.1); color: #ffffff; border-color: rgba(230, 161, 92, 0.2); }

        .main-content { margin-left: var(--sidebar-width); padding: 30px 40px 40px; min-height: 100vh; transition: var(--transition-smooth); }
        .page-header { border-bottom: 1px solid rgba(74,44,17,0.08); padding-bottom: 20px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; }
        .page-header h2 { font-weight: 700; color: var(--dark-coffee); letter-spacing: -0.02em; margin-bottom: 0; }
        .page-header .subtitle { color: var(--text-secondary); font-size: 0.9rem; margin-top: 2px; }

        /* HEADER RIGHT */
        .header-right { display: flex; align-items: center; gap: 16px; }

        /* NOTIFICATION BELL */
        .notif-btn { position: relative; background: var(--card-white); border: 1px solid rgba(74, 44, 17, 0.06); border-radius: 50px; padding: 8px 14px; color: var(--dark-coffee); transition: var(--transition-smooth); cursor: pointer; display: flex; align-items: center; gap: 8px; }
        .notif-btn:hover { background: var(--bg-cream); box-shadow: var(--shadow-soft); }
        .notif-btn .notif-dot { position: absolute; top: -4px; right: -4px; width: 18px; height: 18px; background: #EF4444; border-radius: 50%; font-size: 0.6rem; color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; border: 2px solid white; }

        /* USER AVATAR */
        .user-avatar-wrapper { display: flex; align-items: center; gap: 10px; padding: 6px 14px 6px 10px; border-radius: 50px; background: var(--card-white); border: 1px solid rgba(74, 44, 17, 0.06); cursor: pointer; transition: var(--transition-smooth); }
        .user-avatar-wrapper:hover { box-shadow: var(--shadow-soft); border-color: var(--amber-cream); }
        .user-avatar-icon { font-size: 1.6rem; color: var(--amber-cream); }
        .user-avatar-name { font-weight: 600; font-size: 0.85rem; color: var(--dark-coffee); max-width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

        /* NOTIFICATION DROPDOWN */
        .notif-dropdown { position: absolute; right: 0; top: calc(100% + 10px); width: 380px; max-height: 400px; background: var(--card-white); border-radius: var(--radius-card); box-shadow: var(--shadow-hover); border: 1px solid rgba(74, 44, 17, 0.06); overflow: hidden; display: none; z-index: 50; }
        .notif-dropdown.show { display: block; animation: slideDown 0.25s ease; }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        .notif-dropdown-header { padding: 14px 18px; border-bottom: 1px solid rgba(74, 44, 17, 0.06); display: flex; justify-content: space-between; align-items: center; font-weight: 600; }
        .notif-dropdown-header a { font-size: 0.75rem; color: var(--amber-cream); font-weight: 500; text-decoration: none; }
        .notif-dropdown-list { max-height: 300px; overflow-y: auto; }
        .notif-item { padding: 12px 18px; border-bottom: 1px solid rgba(74, 44, 17, 0.04); display: flex; align-items: flex-start; gap: 12px; transition: var(--transition-smooth); cursor: pointer; text-decoration: none; color: inherit; }
        .notif-item:hover { background: var(--bg-cream); text-decoration: none; color: inherit; }
        .notif-item .notif-icon { width: 36px; height: 36px; min-width: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; }
        .notif-item .notif-icon.success { background: #D1FAE5; color: #065F46; }
        .notif-item .notif-icon.warning { background: #FEF3C7; color: #92400E; }
        .notif-item .notif-icon.info { background: #DBEAFE; color: #1E40AF; }
        .notif-item .notif-icon.danger { background: #FEE2E2; color: #991B1B; }
        .notif-item .notif-icon.primary { background: #EDE9FE; color: #5B21B6; }
        .notif-item .notif-text { flex: 1; font-size: 0.85rem; }
        .notif-item .notif-text .notif-time { font-size: 0.7rem; color: var(--text-secondary); display: block; margin-top: 2px; }
        .notif-item.unread { background: rgba(230, 161, 92, 0.05); }
        .notif-item.unread .notif-text { font-weight: 600; }
        .notif-badge-new { background: var(--amber-cream); color: white; font-size: 0.55rem; padding: 2px 8px; border-radius: 10px; align-self: center; }

        /* STATUS BADGE */
        .status-badge { padding: 4px 14px; border-radius: 20px; font-size: 0.7rem; font-weight: 600; display: inline-block; }
        .status-badge.pending { background: #FEF3C7; color: #92400E; }
        .status-badge.processing { background: #DBEAFE; color: #1E40AF; }
        .status-badge.delivery { background: #EDE9FE; color: #5B21B6; }
        .status-badge.complete { background: #D1FAE5; color: #065F46; }
        .status-badge.cancelled { background: #FEE2E2; color: #991B1B; }
        .status-badge.lunas { background: #D1FAE5; color: #065F46; }
        .status-badge.belum-bayar { background: #FEF3C7; color: #92400E; }
        .status-badge.dikirim { background: #EDE9FE; color: #5B21B6; }
        .status-badge.selesai { background: #D1FAE5; color: #065F46; }
        .status-badge.dibatalkan { background: #FEE2E2; color: #991B1B; }

        /* CUSTOM CARD */
        .custom-card { background: var(--card-white); border: none; border-radius: var(--radius-card); box-shadow: var(--shadow-soft); transition: var(--transition-smooth); overflow: hidden; }
        .custom-card:hover { box-shadow: var(--shadow-hover); }
        .custom-card .card-header-custom { padding: 18px 24px; border-bottom: 1px solid rgba(74, 44, 17, 0.06); display: flex; align-items: center; justify-content: space-between; background: transparent; }
        .custom-card .card-header-custom h6 { font-weight: 700; color: var(--dark-coffee); margin: 0; font-size: 0.85rem; }
        .custom-card .card-body-custom { padding: 0; }

        /* TABLE */
        .table-custom { font-size: 0.85rem; margin-bottom: 0; }
        .table-custom thead th { border-bottom: 2px solid rgba(74, 44, 17, 0.06); color: var(--text-secondary); font-weight: 600; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 16px; }
        .table-custom tbody td { padding: 12px 16px; border-bottom: 1px solid rgba(74, 44, 17, 0.04); vertical-align: middle; }
        .table-custom tbody tr:hover { background: rgba(250, 246, 240, 0.3); }
        .table-custom tbody tr:last-child td { border-bottom: none; }

        /* STAT BOX MINI */
        .stat-box-mini { background: var(--card-white); border-radius: var(--radius-card); padding: 16px 20px; border-left: 4px solid var(--amber-cream); box-shadow: var(--shadow-soft); transition: var(--transition-smooth); height: 100%; }
        .stat-box-mini:hover { transform: translateY(-2px); box-shadow: var(--shadow-hover); }
        .stat-box-mini .label { font-size: 0.7rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; }
        .stat-box-mini .value { font-size: 1.5rem; font-weight: 700; color: var(--dark-coffee); }

        /* FILTER */
        .filter-section { display: flex; gap: 10px; flex-wrap: wrap; align-items: center; }
        .filter-section select, .filter-section input { border-radius: 8px; border: 1px solid rgba(74, 44, 17, 0.1); padding: 6px 12px; font-size: 0.85rem; background: var(--card-white); outline: none; transition: var(--transition-smooth); }
        .filter-section select:focus, .filter-section input:focus { border-color: var(--amber-cream); }
        .btn-filter { background: var(--amber-cream); color: white; border: none; border-radius: 8px; padding: 6px 16px; font-weight: 600; font-size: 0.85rem; transition: var(--transition-smooth); cursor: pointer; }
        .btn-filter:hover { opacity: 0.85; color: white; }
        .btn-outline-filter { background: transparent; color: var(--text-secondary); border: 1px solid rgba(74, 44, 17, 0.1); border-radius: 8px; padding: 6px 16px; font-weight: 500; font-size: 0.85rem; transition: var(--transition-smooth); cursor: pointer; }
        .btn-outline-filter:hover { background: var(--bg-cream); }

        /* SIDEBAR OVERLAY */
        .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 99; }
        .sidebar-overlay.active { display: block; }

        /* BUTTON DETAIL */
        .btn-detail { background: var(--amber-cream); color: white; border-radius: 8px; padding: 4px 12px; font-size: 0.7rem; font-weight: 600; border: none; transition: var(--transition-smooth); cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; }
        .btn-detail:hover { background: var(--roasted-brown); color: white; text-decoration: none; }

        /* EMPTY STATE */
        .empty-state { padding: 40px 0; text-align: center; color: var(--text-secondary); }
        .empty-state i { font-size: 2.5rem; display: block; margin-bottom: 12px; color: #D1C9C0; }
        .empty-state p { margin-bottom: 0; font-size: 0.9rem; }

        /* RESPONSIVE */
        @media (max-width: 991.98px) {
            .sidebar { left: calc(-1 * var(--sidebar-width)); box-shadow: none; }
            .sidebar.open { left: 0; box-shadow: 0 0 40px rgba(0,0,0,0.3); }
            .main-content { margin-left: 0; padding: 20px 16px 30px; }
            .page-header h2 { font-size: 1.3rem; }
            .notif-dropdown { width: calc(100vw - 32px); right: -60px; }
            .header-right { gap: 10px; }
            .user-avatar-name { max-width: 60px; font-size: 0.75rem; }
        }
        @media (max-width: 575.98px) {
            .main-content { padding: 16px 12px 20px; }
            .notif-dropdown { width: calc(100vw - 24px); right: -70px; }
            .stat-box-mini { padding: 12px 16px; }
            .stat-box-mini .value { font-size: 1.1rem; }
            .table-custom { font-size: 0.75rem; }
            .table-custom thead th { padding: 8px 10px; font-size: 0.6rem; }
            .table-custom tbody td { padding: 8px 10px; }
            .status-badge { font-size: 0.6rem; padding: 3px 10px; }
            .filter-section { gap: 6px; }
            .filter-section select, .filter-section input { font-size: 0.75rem; padding: 4px 8px; }
            .btn-filter, .btn-outline-filter { font-size: 0.75rem; padding: 4px 12px; }
            .user-avatar-name { max-width: 50px; font-size: 0.7rem; }
            .user-avatar-wrapper { padding: 4px 10px 4px 6px; }
            .user-avatar-icon { font-size: 1.3rem; }
            .header-right { gap: 6px; }
            .notif-btn { padding: 6px 10px; }
        }

        /* SCROLLBAR */
        .sidebar-menu-wrapper::-webkit-scrollbar, .notif-dropdown-list::-webkit-scrollbar { width: 3px; }
        .sidebar-menu-wrapper::-webkit-scrollbar-thumb, .notif-dropdown-list::-webkit-scrollbar-thumb { background: rgba(230, 161, 92, 0.3); border-radius: 10px; }
    </style>
</head>
<body>

<!-- SIDEBAR OVERLAY -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebarMenu">
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="bi bi-cup-hot-fill"></i></div>
        <span>MEMBER <br><small style="font-weight:400; font-size:0.7rem; color:#A8988A;">Liberchain</small></span>
    </div>
    <div class="sidebar-menu-wrapper">
        <ul class="sidebar-menu">
            <li class="menu-item">
                <a href="<?= base_url('pembeli/dashboard'); ?>">
                    <i class="bi bi-house-door-fill"></i>Beranda Akun
                </a>
            </li>
            <li class="menu-item">
                <a href="<?= base_url('landing/produk'); ?>">
                    <i class="bi bi-shop-window"></i>Katalog Belanja
                </a>
            </li>
            <li class="menu-item active">
                <a href="<?= base_url('pembeli/transaksi/history'); ?>">
                    <i class="bi bi-receipt"></i>Riwayat Transaksi
                    <span class="menu-badge"><?= $total_transaksi ?? 0; ?></span>
                </a>
            </li>
            <li class="menu-item">
                <a href="<?= base_url('pembeli/tracking'); ?>">
                    <i class="bi bi-geo-alt-fill"></i>Status Pengiriman
                    <span class="menu-badge"><?= $total_dikirim ?? 0; ?></span>
                </a>
            </li>
            <li class="menu-item">
                <a href="<?= base_url('pembeli/profil'); ?>">
                    <i class="bi bi-person-fill"></i>Profil Saya
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
            <h2 class="d-inline-block align-middle">📋 Riwayat Transaksi</h2>
            <p class="subtitle mb-0 mt-1">Kelola dan lihat semua pesanan Anda</p>
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
                        <span><?= isset($unread_count) && $unread_count > 0 ? $unread_count . ' Notifikasi Belum Dibaca' : 'Semua Notifikasi'; ?></span>
                        <div>
                            <?php if (isset($unread_count) && $unread_count > 0): ?>
                                <a href="#" id="markAllReadBtn" class="mr-2" style="font-size:0.7rem; text-decoration:none;">Tandai semua</a>
                            <?php endif; ?>
                            <a href="<?= base_url('pembeli/dashboard/history'); ?>" style="font-size:0.75rem; color: var(--amber-cream); font-weight:500; text-decoration:none;">Lihat Semua</a>
                        </div>
                    </div>
                    <div class="notif-dropdown-list" id="notifList">
                        <?php if (!empty($notifikasi)): ?>
                            <?php foreach ($notifikasi as $n): ?>
                                <a class="notif-item <?= (isset($n['status_baca']) && $n['status_baca'] == 0) ? 'unread' : ''; ?>" 
                                   href="<?= base_url('pembeli/dashboard/read/' . $n['id_notifikasi']); ?>">
                                    <?php
                                    $icon_type = $n['icon'] ?? 'info';
                                    $icon_map = [
                                        'success' => 'bi-check-circle-fill',
                                        'warning' => 'bi-exclamation-triangle-fill',
                                        'danger'  => 'bi-x-circle-fill',
                                        'info'    => 'bi-info-circle-fill',
                                        'primary' => 'bi-star-fill'
                                    ];
                                    $icon_class = $icon_map[$icon_type] ?? 'bi-info-circle-fill';
                                    ?>
                                    <div class="notif-icon <?= $icon_type; ?>">
                                        <i class="bi <?= $icon_class; ?>"></i>
                                    </div>
                                    <div class="notif-text">
                                        <?= htmlspecialchars($n['judul'] ?? 'Notifikasi'); ?><br>
                                        <small><?= htmlspecialchars($n['isi_notifikasi']); ?></small>
                                        <span class="notif-time"><?= date('d M Y, H:i', strtotime($n['tanggal_buat'])); ?></span>
                                    </div>
                                    <?php if (isset($n['status_baca']) && $n['status_baca'] == 0): ?>
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
                        <a href="<?= base_url('pembeli/dashboard/settings'); ?>" class="small text-secondary font-weight-bold text-decoration-none">
                            <i class="bi bi-gear-fill mr-1"></i> Pengaturan Notifikasi
                        </a>
                    </div>
                </div>
            </div>

            <!-- USER AVATAR -->
            <div class="user-avatar-wrapper" onclick="window.location.href='<?= base_url('pembeli/profil'); ?>'">
                <?php 
                $user_foto = $this->session->userdata('foto');
                if (!empty($user_foto) && file_exists('./uploads/profil/' . $user_foto)): 
                ?>
                    <img src="<?= base_url('uploads/profil/' . $user_foto); ?>" alt="Avatar" style="width:32px;height:32px;border-radius:50%;object-fit:cover;border:2px solid var(--amber-cream);">
                <?php else: ?>
                    <i class="bi bi-person-circle user-avatar-icon"></i>
                <?php endif; ?>
                <span class="user-avatar-name"><?= $this->session->userdata('nama') ?? 'Pembeli' ?></span>
                <span class="user-avatar-role" style="font-size:0.6rem; color: var(--text-secondary); background: var(--bg-cream); padding:1px 10px; border-radius:20px; font-weight:600;">Member</span>
                <i class="bi bi-chevron-down" style="font-size:0.6rem; color: var(--text-secondary);"></i>
            </div>
        </div>
    </div>

    <!-- STATISTIK -->
    <div class="row mb-4">
        <div class="col-md-3 col-6 mb-2">
            <div class="stat-box-mini" style="border-left-color: var(--amber-cream);">
                <div class="label">Total Transaksi</div>
                <div class="value"><?= $total_transaksi ?? 0; ?></div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-2">
            <div class="stat-box-mini" style="border-left-color: #10B981;">
                <div class="label">Selesai</div>
                <div class="value"><?= $total_selesai ?? 0; ?></div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-2">
            <div class="stat-box-mini" style="border-left-color: #F59E0B;">
                <div class="label">Pending</div>
                <div class="value"><?= $total_pending ?? 0; ?></div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-2">
            <div class="stat-box-mini" style="border-left-color: #EF4444;">
                <div class="label">Dibatalkan</div>
                <div class="value"><?= $total_batal ?? 0; ?></div>
            </div>
        </div>
    </div>

    <!-- FILTER -->
    <div class="custom-card mb-4">
        <div class="card-body-custom" style="padding: 16px 20px;">
            <div class="filter-section">
                <select class="form-control-sm" id="filterStatus">
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="processing">Diproses</option>
                    <option value="delivery">Dikirim</option>
                    <option value="complete">Selesai</option>
                    <option value="cancelled">Dibatalkan</option>
                </select>
                <input type="date" class="form-control-sm" id="filterDateFrom" placeholder="Dari">
                <span style="color: var(--text-secondary); font-size:0.85rem;">sampai</span>
                <input type="date" class="form-control-sm" id="filterDateTo" placeholder="Sampai">
                <button class="btn-filter" onclick="applyFilter()"><i class="bi bi-search"></i> Filter</button>
                <button class="btn-outline-filter" onclick="resetFilter()"><i class="bi bi-arrow-counterclockwise"></i> Reset</button>
            </div>
        </div>
    </div>

    <!-- TABEL -->
    <div class="custom-card">
        <div class="card-header-custom">
            <h6><i class="bi bi-clock-history text-primary mr-2"></i> Daftar Transaksi</h6>
            <span class="badge" style="background: var(--bg-cream); color: var(--text-secondary); font-weight:500; padding: 6px 14px; border-radius: 20px;">
                <?= $total_transaksi ?? 0; ?> transaksi
            </span>
        </div>
        <div class="card-body-custom">
            <div class="table-responsive">
                <table class="table table-custom">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Tanggal</th>
                            <th>Produk</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Status Bayar</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($transaksi)): ?>
                            <?php foreach ($transaksi as $t): ?>
                            <tr>
                                <td><strong style="color: var(--dark-coffee);">#<?= $t['id_transaksi']; ?></strong></td>
                                <td style="color: var(--text-secondary); font-size:0.8rem;">
                                    <?= isset($t['tanggal_transaksi']) ? date('d/m/Y H:i', strtotime($t['tanggal_transaksi'])) : date('d/m/Y H:i'); ?>
                                </td>
                                <td>
                                    <?php 
                                    $produk_list = $t['produk_list'] ?? '';
                                    if (!empty($produk_list)) {
                                        $produk_array = explode(', ', $produk_list);
                                        if (count($produk_array) > 2) {
                                            echo implode(', ', array_slice($produk_array, 0, 2)) . ' ...';
                                        } else {
                                            echo $produk_list;
                                        }
                                    } else {
                                        echo '<span class="text-muted">-</span>';
                                    }
                                    ?>
                                </td>
                                <td style="font-weight:600; color: var(--dark-coffee);">
                                    Rp <?= number_format($t['grand_total'] ?? $t['total_harga'] ?? 0, 0, ',', '.'); ?>
                                </td>
                                <td>
                                    <?php
                                        $status_class = 'pending';
                                        $status_pesanan = $t['status_pesanan'] ?? 'Pending';
                                        if ($status_pesanan == 'Selesai' || $status_pesanan == 'Complete') $status_class = 'complete';
                                        elseif ($status_pesanan == 'Dikirim' || $status_pesanan == 'Shipped') $status_class = 'delivery';
                                        elseif ($status_pesanan == 'Diproses' || $status_pesanan == 'Processing') $status_class = 'processing';
                                        elseif ($status_pesanan == 'Dibatalkan' || $status_pesanan == 'Cancelled') $status_class = 'cancelled';
                                    ?>
                                    <span class="status-badge <?= $status_class; ?>">
                                        <?= ucfirst($status_pesanan); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php
                                        $status_bayar = $t['status_bayar'] ?? 'Belum Bayar';
                                        $bayar_class = $status_bayar == 'Lunas' ? 'lunas' : 'belum-bayar';
                                    ?>
                                    <span class="status-badge <?= $bayar_class; ?>">
                                        <?= $status_bayar; ?>
                                    </span>
                                </td>
                                <td style="text-align:center;">
                                    <a href="<?= base_url('pembeli/transaksi/detail/' . $t['id_transaksi']); ?>" class="btn-detail">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        <p>Belum ada transaksi</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
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
    document.getElementById('markAllReadBtn')?.addEventListener('click', function(e) {
        e.preventDefault();
        if (confirm('Tandai semua notifikasi sebagai sudah dibaca?')) {
            $.ajax({
                url: '<?= base_url('pembeli/dashboard/mark_all_read_ajax'); ?>',
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
    });

    // ============================================
    // 4. FILTER FUNCTION
    // ============================================
    function applyFilter() {
        const status = document.getElementById('filterStatus').value;
        const dateFrom = document.getElementById('filterDateFrom').value;
        const dateTo = document.getElementById('filterDateTo').value;
        
        let url = window.location.href.split('?')[0];
        let params = [];
        if (status) params.push('status=' + status);
        if (dateFrom) params.push('date_from=' + dateFrom);
        if (dateTo) params.push('date_to=' + dateTo);
        if (params.length > 0) url += '?' + params.join('&');
        
        window.location.href = url;
    }

    function resetFilter() {
        window.location.href = window.location.href.split('?')[0];
    }

    // ============================================
    // 5. SET FILTER VALUE FROM URL
    // ============================================
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        const dateFrom = urlParams.get('date_from');
        const dateTo = urlParams.get('date_to');
        
        if (status) document.getElementById('filterStatus').value = status;
        if (dateFrom) document.getElementById('filterDateFrom').value = dateFrom;
        if (dateTo) document.getElementById('filterDateTo').value = dateTo;
    });

    console.log('✅ Halaman Riwayat Transaksi Pembeli siap digunakan!');
</script>
</body>
</html>
