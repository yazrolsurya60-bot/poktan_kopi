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
        .page-header { border-bottom: 1px solid rgba(74,44,17,0.08); padding-bottom: 20px; margin-bottom: 30px; }
        .page-header h2 { font-weight: 700; color: var(--dark-coffee); letter-spacing: -0.02em; }
        .page-header .subtitle { color: var(--text-secondary); font-size: 0.9rem; margin-top: 2px; }

        .notif-btn { position: relative; background: var(--card-white); border: 1px solid rgba(74, 44, 17, 0.06); border-radius: 12px; padding: 8px 14px; color: var(--dark-coffee); transition: var(--transition-smooth); cursor: pointer; display: flex; align-items: center; gap: 8px; }
        .notif-btn:hover { background: var(--bg-cream); box-shadow: var(--shadow-soft); }
        .notif-btn .notif-dot { position: absolute; top: -4px; right: -4px; width: 18px; height: 18px; background: #EF4444; border-radius: 50%; font-size: 0.6rem; color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; border: 2px solid white; }

        .notif-dropdown { position: absolute; right: 0; top: calc(100% + 10px); width: 380px; max-height: 400px; background: var(--card-white); border-radius: var(--radius-card); box-shadow: var(--shadow-hover); border: 1px solid rgba(74, 44, 17, 0.06); overflow: hidden; display: none; z-index: 50; }
        .notif-dropdown.show { display: block; animation: slideDown 0.25s ease; }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        .notif-dropdown-header { padding: 14px 18px; border-bottom: 1px solid rgba(74, 44, 17, 0.06); display: flex; justify-content: space-between; align-items: center; font-weight: 600; }
        .notif-dropdown-header a { font-size: 0.75rem; color: var(--amber-cream); font-weight: 500; }
        .notif-dropdown-list { max-height: 300px; overflow-y: auto; }
        .notif-item { padding: 12px 18px; border-bottom: 1px solid rgba(74, 44, 17, 0.04); display: flex; align-items: flex-start; gap: 12px; transition: var(--transition-smooth); cursor: pointer; }
        .notif-item:hover { background: var(--bg-cream); }
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

        .status-badge { padding: 4px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: 600; }
        .status-badge.pending { background: #FEF3C7; color: #92400E; }
        .status-badge.processing { background: #DBEAFE; color: #1E40AF; }
        .status-badge.delivery { background: #EDE9FE; color: #5B21B6; }
        .status-badge.complete { background: #D1FAE5; color: #065F46; }
        .status-badge.cancelled { background: #FEE2E2; color: #991B1B; }

        .custom-card { background: var(--card-white); border: 1px solid rgba(74, 44, 17, 0.06); border-radius: var(--radius-card); box-shadow: var(--shadow-soft); transition: var(--transition-smooth); overflow: hidden; }
        .custom-card:hover { box-shadow: var(--shadow-hover); }
        .custom-card .card-header-custom { padding: 18px 24px; border-bottom: 1px solid rgba(74, 44, 17, 0.06); display: flex; align-items: center; justify-content: space-between; }
        .custom-card .card-header-custom h6 { font-weight: 700; color: var(--dark-coffee); margin: 0; font-size: 0.85rem; }
        .custom-card .card-body-custom { padding: 24px; }

        .table-custom { font-size: 0.85rem; }
        .table-custom thead th { border-bottom: 2px solid rgba(74, 44, 17, 0.06); color: var(--text-secondary); font-weight: 600; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 10px; }
        .table-custom tbody td { padding: 12px 10px; border-bottom: 1px solid rgba(74, 44, 17, 0.04); vertical-align: middle; }
        .table-custom tbody tr:hover { background: rgba(250, 246, 240, 0.3); }

        .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 99; }
        .sidebar-overlay.active { display: block; }

        @media (max-width: 991.98px) {
            .sidebar { left: calc(-1 * var(--sidebar-width)); box-shadow: none; }
            .sidebar.open { left: 0; box-shadow: 0 0 40px rgba(0,0,0,0.3); }
            .main-content { margin-left: 0; padding: 20px 16px 30px; }
            .page-header h2 { font-size: 1.3rem; }
            .notif-dropdown { width: calc(100vw - 32px); right: -60px; }
        }
        @media (max-width: 575.98px) {
            .main-content { padding: 16px 12px 20px; }
            .notif-dropdown { width: calc(100vw - 24px); right: -70px; }
            .custom-card .card-body-custom { padding: 16px; }
        }
        @media (max-width: 991.98px) { .sidebar-overlay.active { display: block; } }

        .sidebar-menu-wrapper::-webkit-scrollbar, .notif-dropdown-list::-webkit-scrollbar { width: 3px; }
        .sidebar-menu-wrapper::-webkit-scrollbar-thumb, .notif-dropdown-list::-webkit-scrollbar-thumb { background: rgba(230, 161, 92, 0.3); border-radius: 10px; }

        .stat-box-mini { background: var(--card-white); border-radius: var(--radius-card); padding: 16px 20px; border-left: 4px solid var(--amber-cream); box-shadow: var(--shadow-soft); transition: var(--transition-smooth); height: 100%; }
        .stat-box-mini:hover { transform: translateY(-2px); box-shadow: var(--shadow-hover); }
        .stat-box-mini .label { font-size: 0.7rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; }
        .stat-box-mini .value { font-size: 1.5rem; font-weight: 700; color: var(--dark-coffee); }

        .filter-section { display: flex; gap: 10px; flex-wrap: wrap; align-items: center; }
        .filter-section select, .filter-section input { border-radius: 8px; border: 1px solid rgba(74, 44, 17, 0.1); padding: 6px 12px; font-size: 0.85rem; background: var(--card-white); }
        .btn-filter { background: var(--amber-cream); color: white; border: none; border-radius: 8px; padding: 6px 16px; font-weight: 600; font-size: 0.85rem; }
        .btn-filter:hover { opacity: 0.85; color: white; }
        .btn-outline-filter { background: transparent; color: var(--text-secondary); border: 1px solid rgba(74, 44, 17, 0.1); border-radius: 8px; padding: 6px 16px; font-weight: 500; font-size: 0.85rem; }
        .btn-outline-filter:hover { background: var(--bg-cream); }
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
                    <i class="bi bi-geo-alt-fill"></i>Lacak Pengiriman
                    <span class="menu-badge">2</span>
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
    <div class="page-header d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle" style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
                <i class="bi bi-list"></i>
            </button>
            <h2 class="d-inline-block align-middle mb-0">📋 Riwayat Transaksi</h2>
            <p class="subtitle mb-0 mt-1">Kelola dan lihat semua pesanan Anda</p>
        </div>
        <div class="d-flex align-items-center gap-3" style="gap: 12px;">
            <!-- NOTIFICATION BELL (M11-F01) - DINAMIS DARI DATABASE -->
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
                        <a href="<?= base_url('pembeli/dashboard/history'); ?>" style="font-size:0.75rem; color: var(--amber-cream); font-weight:500; text-decoration:none;">Lihat Semua</a>
                    </div>
                    <div class="notif-dropdown-list" id="notifList">
                        <?php if (!empty($notifikasi)): ?>
                            <?php foreach ($notifikasi as $n): ?>
                                <a class="notif-item <?= (isset($n->status_baca) && $n->status_baca == 0) ? 'unread' : ''; ?>" 
                                   href="<?= base_url('pembeli/dashboard/read/' . $n->id_notifikasi); ?>">
                                    <?php
                                    $icon_type = $n->icon ?? 'info';
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
                                        <?= htmlspecialchars($n->judul ?? 'Notifikasi'); ?><br>
                                        <small><?= htmlspecialchars($n->isi_notifikasi); ?></small>
                                        <span class="notif-time"><?= date('d M Y, H:i', strtotime($n->tanggal_buat)); ?></span>
                                    </div>
                                    <?php if (isset($n->status_baca) && $n->status_baca == 0): ?>
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
            <div class="d-flex align-items-center gap-2" style="cursor: pointer; padding: 6px 12px; border-radius: 10px; background: var(--card-white); border: 1px solid rgba(74,44,17,0.06);">
                <i class="bi bi-person-circle" style="font-size: 1.5rem; color: var(--amber-cream);"></i>
                <span style="font-weight:500; font-size:0.85rem;"><?= $this->session->userdata('nama') ?? 'Pembeli' ?></span>
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
                <select class="form-control-sm">
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="processing">Diproses</option>
                    <option value="delivery">Dikirim</option>
                    <option value="complete">Selesai</option>
                    <option value="cancelled">Dibatalkan</option>
                </select>
                <input type="date" class="form-control-sm">
                <span style="color: var(--text-secondary);">sampai</span>
                <input type="date" class="form-control-sm">
                <button class="btn-filter"><i class="bi bi-search"></i> Filter</button>
                <button class="btn-outline-filter"><i class="bi bi-arrow-counterclockwise"></i> Reset</button>
            </div>
        </div>
    </div>

    <!-- TABEL -->
    <div class="custom-card">
        <div class="card-header-custom">
            <h6><i class="bi bi-clock-history text-primary mr-2"></i> Daftar Transaksi</h6>
            <span class="badge" style="background: var(--bg-cream); color: var(--text-secondary); font-weight:500;"><?= $total_transaksi ?? 0; ?> transaksi</span>
        </div>
        <div class="card-body-custom" style="padding:0;">
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Tanggal</th>
                            <th>Produk</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Status Bayar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($transaksi)): ?>
                            <?php foreach ($transaksi as $t): ?>
                            <tr>
                                <td><b>#<?= $t['id_transaksi']; ?></b></td>
                                <td><?= isset($t['tanggal_transaksi']) ? date('d/m/Y H:i', strtotime($t['tanggal_transaksi'])) : date('d/m/Y H:i'); ?></td>
                                <td>
                                    <?php 
                                        $nama_produk = $t['nama_produk'] ?? '-';
                                        $jml = $t['jumlah_item'] ?? 1;
                                        echo $nama_produk . ($jml > 1 ? ' +' . ($jml - 1) . ' lainnya' : '');
                                    ?>
                                </td>
                                <td>Rp <?= number_format($t['grand_total'] ?? $t['total_harga'] ?? 0, 0, ',', '.'); ?></td>
                                <td>
                                    <?php
                                        $status_class = 'pending';
                                        $status_pesanan = $t['status_pesanan'] ?? 'Pending';
                                        if ($status_pesanan == 'Selesai') $status_class = 'complete';
                                        elseif ($status_pesanan == 'Dikirim') $status_class = 'delivery';
                                        elseif ($status_pesanan == 'Diproses') $status_class = 'processing';
                                        elseif ($status_pesanan == 'Dibatalkan') $status_class = 'cancelled';
                                    ?>
                                    <span class="status-badge <?= $status_class; ?>">
                                        <?= $status_pesanan; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php
                                        $status_bayar = $t['status_bayar'] ?? 'Belum Bayar';
                                        $bayar_class = $status_bayar == 'Lunas' ? 'complete' : 'pending';
                                    ?>
                                    <span class="status-badge <?= $bayar_class; ?>">
                                        <?= $status_bayar; ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?= base_url('pembeli/transaksi/detail/' . $t['id_transaksi']); ?>" 
                                       class="btn btn-sm" style="background: var(--amber-cream); color: white; border-radius:8px; padding:4px 12px; font-size:0.7rem;">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center" style="padding: 40px 0; color: var(--text-secondary);">
                                    <i class="bi bi-inbox" style="font-size: 2rem; display: block; margin-bottom: 10px;"></i>
                                    Belum ada transaksi
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

    // NOTIFICATION DROPDOWN
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

    function markAllRead() {
        document.querySelectorAll('.notif-item.unread').forEach(item => item.classList.remove('unread'));
        document.getElementById('notifCount').textContent = '0';
        document.getElementById('notifCount').style.display = 'none';
    }

    document.getElementById('markAllRead')?.addEventListener('click', function(e) {
        e.preventDefault();
        markAllRead();
    });

    console.log('✅ Halaman Riwayat Transaksi Pembeli siap digunakan!');
</script>
</body>
</html>
