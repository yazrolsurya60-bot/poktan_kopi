<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi - Pembeli</title>
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
        
        .sidebar { width: var(--sidebar-width); height: 100vh; position: fixed; top: 0; left: 0; background: linear-gradient(180deg, var(--dark-coffee) 0%, #1a0e04 100%); color: var(--bg-cream); z-index: 100; transition: var(--transition-smooth); box-shadow: 4px 0 25px rgba(44,24,8,0.2); display: flex; flex-direction: column; }
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

        .status-badge { padding: 4px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: 600; display: inline-block; }
        .status-badge.pending { background: #FEF3C7; color: #92400E; }
        .status-badge.processing { background: #DBEAFE; color: #1E40AF; }
        .status-badge.delivery { background: #EDE9FE; color: #5B21B6; }
        .status-badge.complete { background: #D1FAE5; color: #065F46; }
        .status-badge.cancelled { background: #FEE2E2; color: #991B1B; }
        .status-badge.lunas { background: #D1FAE5; color: #065F46; }
        .status-badge.belum-bayar { background: #FEF3C7; color: #92400E; }
        .status-badge.ditolak { background: #FEE2E2; color: #991B1B; }
        .status-badge.menunggu { background: #FEF3C7; color: #92400E; }
        .status-badge.diverifikasi { background: #DBEAFE; color: #1E40AF; }

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

        .detail-label { font-weight: 600; color: var(--text-secondary); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.3px; }
        .detail-value { font-weight: 600; }
        .btn-amber { background: var(--amber-cream); color: white; border-radius: 8px; padding: 8px 20px; font-weight: 600; border: none; transition: var(--transition-smooth); }
        .btn-amber:hover { opacity: 0.85; color: white; transform: translateY(-2px); box-shadow: 0 4px 15px rgba(230, 161, 92, 0.3); }
        .btn-danger-custom { background: #EF4444; color: white; border-radius: 8px; padding: 8px 20px; font-weight: 600; border: none; transition: var(--transition-smooth); }
        .btn-danger-custom:hover { opacity: 0.85; color: white; transform: translateY(-2px); box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3); }
        .btn-outline-secondary-custom { background: transparent; color: var(--text-secondary); border: 1px solid rgba(74, 44, 17, 0.15); border-radius: 8px; padding: 8px 20px; font-weight: 600; transition: var(--transition-smooth); }
        .btn-outline-secondary-custom:hover { background: var(--bg-cream); color: var(--dark-coffee); text-decoration: none; }
        
        .empty-state { text-align: center; padding: 40px 20px; color: var(--text-secondary); }
        .empty-state i { font-size: 3rem; color: var(--amber-cream); opacity: 0.5; display: block; margin-bottom: 16px; }

        .payment-info-box { background: var(--bg-cream); border-radius: 10px; padding: 16px 20px; }
        .payment-info-box table { font-size: 0.9rem; }
        .payment-info-box table td { padding: 4px 8px; }
        .payment-info-box .bank-name { font-weight: 700; color: var(--roasted-brown); }
        
        .instruction-alert { border-radius: 10px; border: none; }
        .instruction-alert i { font-size: 1.1rem; }

        /* Virtual Account style */
        .va-number { font-size: 1.3rem; font-weight: 700; letter-spacing: 3px; color: var(--roasted-brown); background: var(--bg-cream); padding: 8px 16px; border-radius: 10px; display: inline-block; }
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
                <a href="<?= base_url('pembeli/dashboard'); ?>"><i class="bi bi-house-door-fill"></i>Beranda Akun</a>
            </li>
            <li class="menu-item">
                <a href="<?= base_url('landing/produk'); ?>"><i class="bi bi-shop-window"></i>Katalog Belanja</a>
            </li>
            <li class="menu-item active">
                <a href="<?= base_url('pembeli/transaksi/history'); ?>">
                    <i class="bi bi-receipt"></i>Riwayat Transaksi
                    <span class="menu-badge">8</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="<?= base_url('pembeli/tracking'); ?>"><i class="bi bi-geo-alt-fill"></i>Status Pengiriman</a>
            </li>
            <li class="menu-item">
                <a href="<?= base_url('pembeli/poin'); ?>"><i class="bi bi-gift-fill"></i>Tukar Poin Hadiah</a>
            </li>
            <li class="menu-item">
                <a href="<?= base_url('pembeli/profil'); ?>"><i class="bi bi-person-fill"></i>Profil Saya</a>
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
    <div class="page-header d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle" style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
                <i class="bi bi-list"></i>
            </button>
            <h2 class="d-inline-block align-middle mb-0">📄 Detail Transaksi #<?= $transaksi['id_transaksi'] ?? 'N/A'; ?></h2>
            <p class="subtitle mb-0 mt-1">Informasi lengkap pesanan Anda</p>
        </div>
        <div class="d-flex align-items-center gap-3" style="gap: 12px;">
            <div style="position: relative;">
                <button class="notif-btn" id="notifToggle">
                    <i class="bi bi-bell" style="font-size: 1.2rem;"></i>
                    <span class="notif-dot" id="notifCount">3</span>
                </button>
                <div class="notif-dropdown" id="notifDropdown">
                    <div class="notif-dropdown-header">
                        <span>Notifikasi</span>
                        <a href="#" id="markAllRead">Tandai semua dibaca</a>
                    </div>
                    <div class="notif-dropdown-list">
                        <div class="notif-item unread">
                            <div class="notif-icon success"><i class="bi bi-check-circle"></i></div>
                            <div class="notif-text">Pesanan #INV-2026-008 telah sampai tujuan <span class="notif-time">5 menit lalu</span></div>
                        </div>
                        <div class="notif-item unread">
                            <div class="notif-icon info"><i class="bi bi-truck"></i></div>
                            <div class="notif-text">Kurir sedang menuju lokasi Anda <span class="notif-time">15 menit lalu</span></div>
                        </div>
                        <div class="notif-item">
                            <div class="notif-icon warning"><i class="bi bi-star-fill"></i></div>
                            <div class="notif-text">Anda mendapatkan 50 poin reward! <span class="notif-time">1 jam lalu</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2" style="cursor: pointer; padding: 6px 12px; border-radius: 10px; background: var(--card-white); border: 1px solid rgba(74,44,17,0.06);">
                <i class="bi bi-person-circle" style="font-size: 1.5rem; color: var(--amber-cream);"></i>
                <span style="font-weight:500; font-size:0.85rem;">Pembeli</span>
            </div>
        </div>
    </div>

    <!-- ALERT -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" style="border-radius:10px; border:none;">
            <i class="bi bi-check-circle mr-1"></i> <?= $this->session->flashdata('success'); ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" style="border-radius:10px; border:none;">
            <i class="bi bi-exclamation-circle mr-1"></i> <?= $this->session->flashdata('error'); ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>

    <?php if (empty($transaksi)): ?>
        <div class="custom-card">
            <div class="card-body-custom empty-state">
                <i class="bi bi-exclamation-circle"></i>
                <h5>Transaksi tidak ditemukan</h5>
                <p class="text-muted">Data transaksi yang Anda cari tidak tersedia.</p>
                <a href="<?= base_url('pembeli/transaksi/history'); ?>" class="btn-amber">
                    <i class="bi bi-arrow-left mr-1"></i> Kembali ke Riwayat
                </a>
            </div>
        </div>
    <?php else: ?>

    <div class="row">
        <!-- INFORMASI TRANSAKSI -->
        <div class="col-md-6 mb-4">
            <div class="custom-card">
                <div class="card-header-custom">
                    <h6><i class="bi bi-info-circle text-primary mr-2"></i> Informasi Pesanan</h6>
                    <?php 
                    $status = $transaksi['status_pesanan'] ?? 'Pending';
                    $status_map = [
                        'Selesai' => 'complete',
                        'Complete' => 'complete',
                        'Dikirim' => 'delivery',
                        'Shipped' => 'delivery',
                        'Diproses' => 'processing',
                        'Processing' => 'processing',
                        'Pending' => 'pending',
                        'Dibatalkan' => 'cancelled',
                        'Cancelled' => 'cancelled'
                    ];
                    $badge_class = $status_map[$status] ?? 'pending';
                    ?>
                    <span class="status-badge <?= $badge_class; ?>">
                        <?= $status; ?>
                    </span>
                </div>
                <div class="card-body-custom">
                    <div class="row mb-2">
                        <div class="col-5 detail-label">ID Transaksi</div>
                        <div class="col-7 detail-value">#<?= $transaksi['id_transaksi'] ?? 'N/A'; ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 detail-label">Tanggal</div>
                        <div class="col-7"><?= date('d/m/Y H:i', strtotime($transaksi['tanggal_transaksi'] ?? date('Y-m-d H:i:s'))); ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 detail-label">Metode Bayar</div>
                        <div class="col-7"><?= $transaksi['metode_bayar'] ?? '-'; ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 detail-label">Status Bayar</div>
                        <div class="col-7">
                            <?php 
                            $status_bayar = $transaksi['status_bayar'] ?? 'Belum Bayar';
                            $bayar_class = $status_bayar == 'Lunas' ? 'lunas' : ($status_bayar == 'Diverifikasi' ? 'diverifikasi' : ($status_bayar == 'Ditolak' ? 'ditolak' : 'belum-bayar'));
                            ?>
                            <span class="status-badge <?= $bayar_class; ?>">
                                <?= $status_bayar; ?>
                            </span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 detail-label">Alamat Kirim</div>
                        <div class="col-7"><?= $transaksi['alamat_kirim'] ?? '-'; ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 detail-label">Kota</div>
                        <div class="col-7"><?= $transaksi['kota_kirim'] ?? '-'; ?></div>
                    </div>
                    <?php if (!empty($transaksi['alasan_batal'])): ?>
                    <div class="row mb-2">
                        <div class="col-5 detail-label">Alasan Batal</div>
                        <div class="col-7" style="color: #EF4444;"><?= $transaksi['alasan_batal']; ?></div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- DETAIL PRODUK -->
        <div class="col-md-6 mb-4">
            <div class="custom-card">
                <div class="card-header-custom">
                    <h6><i class="bi bi-box-seam text-success mr-2"></i> Detail Produk</h6>
                    <span class="badge" style="background: var(--bg-cream); color: var(--text-secondary);"><?= count($details ?? []); ?> item</span>
                </div>
                <div class="card-body-custom" style="padding:0;">
                    <?php if (empty($details)): ?>
                        <div class="empty-state" style="padding: 20px;">
                            <i class="bi bi-box" style="font-size: 2rem;"></i>
                            <p>Tidak ada produk dalam transaksi ini</p>
                        </div>
                    <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-custom mb-0">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $total_terhitung = 0;
                                foreach ($details as $d): 
                                    $subtotal = ($d['harga_satuan'] ?? 0) * ($d['jumlah'] ?? 0);
                                    $total_terhitung += $subtotal;
                                ?>
                                <tr>
                                    <td><?= $d['nama_produk'] ?? 'Produk tidak tersedia'; ?></td>
                                    <td class="text-center"><?= $d['jumlah'] ?? 0; ?></td>
                                    <td class="text-right">Rp <?= number_format($subtotal, 0, ',', '.'); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2" class="text-right">Subtotal</th>
                                    <th class="text-right">Rp <?= number_format($transaksi['total_harga'] ?? $total_terhitung, 0, ',', '.'); ?></th>
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-right">Ongkir</th>
                                    <th class="text-right">Rp <?= number_format($transaksi['ongkir'] ?? 0, 0, ',', '.'); ?></th>
                                </tr>
                                <?php 
                                $grand_total = ($transaksi['total_harga'] ?? 0) + ($transaksi['ongkir'] ?? 0);
                                ?>
                                <tr style="border-top: 2px solid var(--amber-cream);">
                                    <th colspan="2" class="text-right" style="font-size:1rem;">Grand Total</th>
                                    <th class="text-right" style="font-size:1.1rem; color: var(--amber-cream); font-weight:700;">
                                        Rp <?= number_format($grand_total, 0, ',', '.'); ?>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================ -->
    <!-- 🔥 INFORMASI PEMBAYARAN - VIRTUAL ACCOUNT                    -->
    <!-- ============================================================ -->
    <div class="row">
        <div class="col-12">
            <div class="custom-card">
                <div class="card-header-custom" style="background: <?= $status_bayar == 'Lunas' ? '#D1FAE5' : ($status_bayar == 'Ditolak' ? '#FEE2E2' : '#FEF3C7'); ?>;">
                    <h6>
                        <i class="bi bi-credit-card mr-2"></i> 
                        Informasi Pembayaran
                        <span class="status-badge <?= $bayar_class; ?> ml-2">
                            <?= $status_bayar; ?>
                        </span>
                    </h6>
                </div>
                <div class="card-body-custom">

                    <?php if ($status_bayar == 'Belum Bayar' || $status_bayar == 'Pending' || $status_bayar == 'Menunggu Pembayaran'): ?>
                        <!-- 🔥 STATUS: BELUM BAYAR / PENDING - VIRTUAL ACCOUNT -->
                        <div class="alert alert-warning instruction-alert">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-info-circle mr-3 mt-1" style="font-size:1.3rem;"></i>
                                <div>
                                    <h6 class="mb-2" style="font-weight:700;">⏳ Menunggu Pembayaran</h6>
                                    <p class="mb-2">Silakan lakukan pembayaran melalui Virtual Account berikut:</p>
                                    
                                    <div class="payment-info-box">
                                        <table class="table table-sm table-borderless mb-0">
                                            <tr>
                                                <td width="160"><strong>Virtual Account</strong></td>
                                                <td>: <span class="va-number">8888-1234-5678-<?= str_pad($transaksi['id_transaksi'], 4, '0', STR_PAD_LEFT); ?></span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Bank</strong></td>
                                                <td>: <span class="bank-name">BCA</span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Atas Nama</strong></td>
                                                <td>: <span class="bank-name">POKTAN Liberchain</span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Pembayaran</strong></td>
                                                <td>: <strong style="color: var(--roasted-brown); font-size:1.1rem;">Rp <?= number_format($grand_total, 0, ',', '.'); ?></strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                    
                                    <small class="text-muted mt-2 d-block">
                                        <i class="bi bi-clock mr-1"></i> 
                                        Pembayaran akan terverifikasi otomatis setelah Anda transfer ke Virtual Account di atas.
                                        <br>
                                        <i class="bi bi-info-circle mr-1"></i>
                                        Pastikan nominal transfer sesuai dengan total pembayaran.
                                    </small>
                                </div>
                            </div>
                        </div>

                    <?php elseif ($status_bayar == 'Diverifikasi'): ?>
                        <!-- 🔥 STATUS: DIVERIFIKASI -->
                        <div class="alert alert-info instruction-alert">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-hourglass-split mr-3 mt-1" style="font-size:1.3rem;"></i>
                                <div>
                                    <h6 class="mb-2" style="font-weight:700;">🔄 Pembayaran Sedang Diverifikasi</h6>
                                    <p class="mb-0">Admin sedang memverifikasi pembayaran Anda. Mohon tunggu sebentar.</p>
                                    <small class="text-muted mt-2 d-block">
                                        <i class="bi bi-clock mr-1"></i> Proses verifikasi maksimal 1x24 jam.
                                    </small>
                                </div>
                            </div>
                        </div>

                    <?php elseif ($status_bayar == 'Lunas'): ?>
                        <!-- 🔥 STATUS: LUNAS -->
                        <div class="alert alert-success instruction-alert">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-check-circle-fill mr-3 mt-1" style="font-size:1.3rem;"></i>
                                <div>
                                    <h6 class="mb-2" style="font-weight:700;">✅ Pembayaran Lunas</h6>
                                    <p class="mb-0">Pembayaran Anda telah dikonfirmasi. Pesanan akan segera diproses.</p>
                                    <small class="text-muted mt-2 d-block">
                                        <i class="bi bi-truck mr-1"></i> Status pesanan akan berubah menjadi "Diproses" setelah admin mengkonfirmasi.
                                    </small>
                                </div>
                            </div>
                        </div>

                    <?php elseif ($status_bayar == 'Ditolak'): ?>
                        <!-- 🔥 STATUS: DITOLAK -->
                        <div class="alert alert-danger instruction-alert">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-x-circle-fill mr-3 mt-1" style="font-size:1.3rem;"></i>
                                <div>
                                    <h6 class="mb-2" style="font-weight:700;">❌ Pembayaran Ditolak</h6>
                                    <p class="mb-0">Pembayaran Anda ditolak oleh admin dengan alasan:</p>
                                    <div class="mt-2 p-2" style="background: rgba(239,68,68,0.1); border-radius:8px;">
                                        <em>"<?= $bukti['keterangan'] ?? 'Data tidak valid. Silakan hubungi admin.'; ?>"</em>
                                    </div>
                                    <small class="text-muted mt-2 d-block">
                                        <i class="bi bi-arrow-repeat mr-1"></i> Silakan hubungi admin untuk informasi lebih lanjut.
                                    </small>
                                </div>
                            </div>
                        </div>

                    <?php else: ?>
                        <!-- 🔥 STATUS: LAINNYA (fallback) -->
                        <div class="alert alert-secondary instruction-alert">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-info-circle mr-3 mt-1" style="font-size:1.3rem;"></i>
                                <div>
                                    <h6 class="mb-2" style="font-weight:700;">ℹ️ Status Pembayaran</h6>
                                    <p class="mb-0">Status pembayaran: <strong><?= $status_bayar; ?></strong></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- 🔥 TAMPILKAN BUKTI YANG SUDAH DIUPLOAD (JIKA ADA) -->
                    <?php if (!empty($bukti) && $bukti['status_verifikasi'] != 'Ditolak'): ?>
                    <div class="mt-3 p-3" style="background: var(--bg-cream); border-radius:10px;">
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted">Bank</small>
                                <div class="font-weight-bold"><?= $bukti['nama_bank'] ?? '-'; ?></div>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">Nama Pengirim</small>
                                <div class="font-weight-bold"><?= $bukti['nama_pengirim'] ?? '-'; ?></div>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">Tanggal Transfer</small>
                                <div class="font-weight-bold"><?= date('d/m/Y', strtotime($bukti['tanggal_transfer'] ?? date('Y-m-d'))); ?></div>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">Jumlah Transfer</small>
                                <div class="font-weight-bold">Rp <?= number_format($bukti['jumlah_transfer'] ?? 0, 0, ',', '.'); ?></div>
                            </div>
                            <?php if (!empty($bukti['file_bukti'])): ?>
                            <div class="col-12 mt-2">
                                <a href="<?= base_url('uploads/bukti/' . $bukti['file_bukti']); ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> Lihat Bukti
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- 🔥 TOMBOL AKSI -->
                    <div class="mt-3 d-flex flex-wrap" style="gap:10px;">
                        <a href="<?= base_url('pembeli/transaksi/history'); ?>" class="btn-outline-secondary-custom">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <a href="<?= base_url('pembeli/transaksi/invoice/' . $transaksi['id_transaksi']); ?>" target="_blank" class="btn-amber">
                            <i class="bi bi-file-pdf"></i> Download Invoice
                        </a>
                        <?php 
                        $status_cancel = $transaksi['status_pesanan'] ?? '';
                        if (in_array($status_cancel, ['Pending', 'Diproses', 'Menunggu Pembayaran'])): 
                        ?>
                            <button class="btn-danger-custom" data-toggle="modal" data-target="#modalBatal">
                                <i class="bi bi-x-circle"></i> Batalkan Pesanan
                            </button>
                        <?php endif; ?>
                    </div>

                    <!-- 🔥 CATATAN -->
                    <div class="mt-3 pt-3 border-top" style="border-color: rgba(74,44,17,0.08);">
                        <small class="text-muted">
                            <i class="bi bi-info-circle mr-1"></i>
                            <strong>Catatan:</strong> Pembayaran via Virtual Account akan terverifikasi otomatis. 
                            Jika ada kendala, silakan hubungi customer service.
                        </small>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php endif; // end if empty transaksi ?>
</div>

<!-- MODAL BATAL -->
<div class="modal fade" id="modalBatal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none; padding-bottom: 0;">
                <h5 class="modal-title" style="font-weight:700;"><i class="bi bi-exclamation-triangle-fill text-danger mr-2"></i> Batalkan Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?= base_url('pembeli/transaksi/batalkan/' . ($transaksi['id_transaksi'] ?? '')); ?>" method="POST">
                <div class="modal-body">
                    <p>Yakin ingin membatalkan pesanan #<?= $transaksi['id_transaksi'] ?? 'N/A'; ?>?</p>
                    <div class="form-group">
                        <label style="font-weight:600; font-size:0.85rem;">Alasan Pembatalan</label>
                        <textarea name="alasan" class="form-control" rows="3" placeholder="Tulis alasan pembatalan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: none; padding-top: 0;">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" style="border-radius:8px;">Batal</button>
                    <button type="submit" class="btn-danger-custom">Ya, Batalkan Pesanan</button>
                </div>
            </form>
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

    console.log('✅ Halaman Detail Transaksi Pembeli siap digunakan!');
</script>
</body>
</html>