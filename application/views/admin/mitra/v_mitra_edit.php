<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mitra - LiberChain</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --roasted-brown: #4A2C11; --dark-coffee: #2C1808; --amber-cream: #E6A15C;
            --forest-green: #2D6A4F; --bg-cream: #FAF6F0; --card-white: #FFFFFF;
            --text-secondary: #70655E; --sidebar-width: 260px;
            --shadow-soft: 0 8px 30px rgba(44,24,8,0.08); --shadow-hover: 0 12px 40px rgba(44,24,8,0.15);
            --radius-card: 14px; --transition-smooth: all 0.3s cubic-bezier(0.4,0,0.2,1);
        }
        * { box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-cream); color: var(--dark-coffee); overflow-x: hidden; }

        .sidebar { width: var(--sidebar-width); height: 100vh; position: fixed; top:0; left:0; background: linear-gradient(180deg,var(--dark-coffee) 0%,#1a0e04 100%); color: var(--bg-cream); z-index:100; box-shadow: 4px 0 25px rgba(44,24,8,0.2); display:flex; flex-direction:column; }
        .sidebar-brand { padding:28px 24px 20px; font-size:1.1rem; font-weight:700; border-bottom:1px solid rgba(250,246,240,0.08); color:var(--amber-cream); display:flex; align-items:center; gap:10px; }
        .sidebar-brand .brand-icon { width:40px; height:40px; background:rgba(230,161,92,0.15); border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:1.3rem; }
        .sidebar-menu-wrapper { flex:1; overflow-y:auto; padding:15px 0; }
        .sidebar-menu { list-style:none; margin:0; padding:0; }
        .menu-item a { display:flex; align-items:center; padding:12px 24px; color:#A8988A; font-weight:500; font-size:0.9rem; transition:var(--transition-smooth); text-decoration:none; margin:2px 10px; border-radius:10px; }
        .menu-item a i { font-size:1.15rem; margin-right:14px; width:22px; text-align:center; }
        .menu-item a:hover { color:#fff; background:rgba(230,161,92,0.12); }
        .menu-item.active a { background:rgba(230,161,92,0.18); border-left:3px solid var(--amber-cream); color:#fff; }
        .sidebar-footer { padding:16px 20px; border-top:1px solid rgba(250,246,240,0.06); margin-top:auto; }
        .btn-logout { width:100%; padding:10px 16px; border:1px solid rgba(250,246,240,0.1); border-radius:10px; background:transparent; color:#A8988A; font-weight:500; font-size:0.85rem; transition:var(--transition-smooth); display:flex; align-items:center; justify-content:center; gap:10px; cursor:pointer; }
        .btn-logout:hover { background:rgba(230,161,92,0.1); color:#fff; }

        .main-content { margin-left:var(--sidebar-width); padding:30px 40px 50px; min-height:100vh; }
        .page-header { border-bottom:1px solid rgba(74,44,17,0.08); padding-bottom:20px; margin-bottom:28px; }
        .page-header h2 { font-weight:700; color:var(--dark-coffee); letter-spacing:-0.02em; }
        .page-header .subtitle { color:var(--text-secondary); font-size:0.875rem; margin-top:2px; }

        /* Notif */
        .notif-btn { position:relative; background:var(--card-white); border:1px solid rgba(74,44,17,0.06); border-radius:12px; padding:8px 14px; color:var(--dark-coffee); transition:var(--transition-smooth); cursor:pointer; display:flex; align-items:center; gap:8px; }
        .notif-btn:hover { background:var(--bg-cream); box-shadow:var(--shadow-soft); }
        .notif-btn .notif-dot { position:absolute; top:-4px; right:-4px; width:18px; height:18px; background:#EF4444; border-radius:50%; font-size:0.6rem; color:white; display:flex; align-items:center; justify-content:center; font-weight:700; border:2px solid white; }
        .notif-dropdown { position:absolute; right:0; top:calc(100% + 10px); width:340px; max-height:380px; background:var(--card-white); border-radius:var(--radius-card); box-shadow:var(--shadow-hover); border:1px solid rgba(74,44,17,0.06); overflow:hidden; display:none; z-index:200; }
        .notif-dropdown.show { display:block; animation:slideDown 0.25s ease; }
        @keyframes slideDown { from{opacity:0;transform:translateY(-10px);}to{opacity:1;transform:translateY(0);} }
        .notif-dropdown-header { padding:14px 18px; border-bottom:1px solid rgba(74,44,17,0.06); display:flex; justify-content:space-between; align-items:center; font-weight:600; font-size:0.85rem; }
        .notif-dropdown-header a { font-size:0.75rem; color:var(--amber-cream); font-weight:500; text-decoration:none; }
        .notif-dropdown-list { max-height:260px; overflow-y:auto; }
        .notif-item { padding:11px 18px; border-bottom:1px solid rgba(74,44,17,0.04); display:flex; align-items:flex-start; gap:11px; transition:var(--transition-smooth); text-decoration:none; color:inherit; }
        .notif-item:hover { background:var(--bg-cream); text-decoration:none; color:inherit; }
        .notif-item.unread { background:rgba(230,161,92,0.05); }
        .notif-item.unread .notif-text { font-weight:600; }
        .notif-icon { width:33px; height:33px; min-width:33px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:0.85rem; }
        .notif-icon.success{background:#D1FAE5;color:#065F46;} .notif-icon.warning{background:#FEF3C7;color:#92400E;} .notif-icon.info{background:#DBEAFE;color:#1E40AF;} .notif-icon.danger{background:#FEE2E2;color:#991B1B;}
        .notif-text { flex:1; font-size:0.8rem; }
        .notif-time { font-size:0.7rem; color:var(--text-secondary); display:block; margin-top:2px; }
        .notif-badge-new { background:var(--amber-cream); color:white; font-size:0.55rem; padding:2px 7px; border-radius:10px; align-self:center; }
        .user-badge { display:flex; align-items:center; gap:8px; padding:6px 12px; border-radius:10px; background:var(--card-white); border:1px solid rgba(74,44,17,0.06); font-weight:500; font-size:0.85rem; }
        .role-pill { font-size:0.65rem; font-weight:700; padding:2px 8px; border-radius:10px; background:rgba(230,161,92,0.15); color:var(--amber-cream); text-transform:uppercase; letter-spacing:0.5px; }

        /* Breadcrumb */
        .breadcrumb-nav { display:flex; align-items:center; gap:10px; margin-bottom:6px; }
        .btn-back { width:36px; height:36px; border-radius:9px; background:rgba(74,44,17,0.07); border:1px solid rgba(74,44,17,0.1); display:flex; align-items:center; justify-content:center; color:var(--roasted-brown); font-size:1rem; text-decoration:none; transition:var(--transition-smooth); }
        .btn-back:hover { background:var(--amber-cream); color:#fff; border-color:transparent; text-decoration:none; }
        .breadcrumb-text { font-size:0.75rem; color:var(--text-secondary); font-weight:500; }
        .breadcrumb-text span { color:var(--dark-coffee); font-weight:700; }
        .edit-pill { display:inline-flex; align-items:center; gap:5px; padding:4px 12px; background:rgba(230,161,92,0.15); border:1px solid rgba(230,161,92,0.25); border-radius:20px; color:var(--amber-cream); font-size:0.7rem; font-weight:700; letter-spacing:0.4px; }

        /* Form card */
        .form-card { background:var(--card-white); border-radius:var(--radius-card); box-shadow:var(--shadow-soft); border:1px solid rgba(74,44,17,0.06); overflow:hidden; }
        .form-card-header { padding:18px 24px; border-bottom:1px solid rgba(74,44,17,0.06); background:rgba(250,246,240,0.5); display:flex; align-items:center; gap:12px; }
        .form-card-header .hdr-icon { width:36px; height:36px; border-radius:10px; background:rgba(230,161,92,0.15); display:flex; align-items:center; justify-content:center; color:var(--amber-cream); font-size:1rem; }
        .form-card-header h5 { margin:0; font-weight:700; font-size:0.9rem; color:var(--dark-coffee); }
        .form-card-header p  { margin:0; font-size:0.77rem; color:var(--text-secondary); }
        .form-card-body { padding:26px; }

        .field-group { margin-bottom:20px; }
        .field-label { font-size:0.78rem; font-weight:700; color:var(--dark-coffee); margin-bottom:7px; display:flex; align-items:center; gap:6px; }
        .field-label i { color:var(--amber-cream); }
        .req { color:#dc2626; }
        .field-input { width:100%; padding:10px 14px; border:1px solid rgba(74,44,17,0.15); border-radius:10px; font-size:0.875rem; font-family:inherit; color:var(--dark-coffee); background:var(--bg-cream); transition:var(--transition-smooth); appearance:none; -webkit-appearance:none; }
        .field-input:focus { border-color:var(--amber-cream); box-shadow:0 0 0 3px rgba(230,161,92,0.18); outline:none; background:#fff; }
        .field-hint { font-size:0.73rem; color:var(--text-secondary); margin-top:5px; display:flex; align-items:center; gap:5px; }
        .field-hint i { color:var(--amber-cream); }
        .form-divider { height:1px; background:rgba(74,44,17,0.06); margin:22px 0; }

        /* Current logo */
        .current-logo-box { display:flex; align-items:center; gap:14px; padding:14px 16px; background:rgba(250,246,240,0.6); border:1px solid rgba(74,44,17,0.08); border-radius:11px; margin-bottom:14px; }
        .current-logo { width:62px; height:62px; object-fit:contain; border-radius:10px; border:1px solid rgba(74,44,17,0.08); background:#fff; padding:4px; }
        .current-logo-placeholder { width:62px; height:62px; border-radius:10px; border:1px dashed rgba(74,44,17,0.18); background:#fff; display:flex; align-items:center; justify-content:center; color:var(--text-secondary); font-size:1.4rem; }
        .cl-label { font-size:0.7rem; font-weight:600; color:var(--text-secondary); text-transform:uppercase; letter-spacing:0.5px; }
        .cl-name  { font-size:0.82rem; font-weight:600; color:var(--dark-coffee); word-break:break-all; margin-top:2px; }

        /* Upload */
        .upload-zone { border:2px dashed rgba(74,44,17,0.15); border-radius:12px; padding:18px 14px; text-align:center; background:rgba(250,246,240,0.5); transition:var(--transition-smooth); cursor:pointer; position:relative; }
        .upload-zone:hover { border-color:var(--amber-cream); background:rgba(230,161,92,0.04); }
        .upload-zone.dragover { border-color:var(--amber-cream); background:rgba(230,161,92,0.07); }
        .upload-zone input[type="file"] { position:absolute; inset:0; opacity:0; cursor:pointer; width:100%; height:100%; }
        .upload-icon-wrap { width:40px; height:40px; border-radius:10px; background:rgba(230,161,92,0.12); display:flex; align-items:center; justify-content:center; margin:0 auto 8px; color:var(--amber-cream); font-size:1.15rem; }
        .upload-zone h6 { font-size:0.82rem; font-weight:700; color:var(--dark-coffee); margin:0 0 3px; }
        .upload-zone p  { font-size:0.72rem; color:var(--text-secondary); margin:0; }

        /* Preview */
        .preview-wrap { display:none; margin-top:11px; padding:11px; background:#fff; border-radius:10px; border:1px solid rgba(230,161,92,0.22); align-items:center; gap:11px; }
        .preview-img  { width:54px; height:54px; object-fit:contain; border-radius:9px; border:1px solid rgba(74,44,17,0.08); }
        .preview-info { flex:1; min-width:0; }
        .preview-name { font-size:0.8rem; font-weight:600; color:var(--dark-coffee); word-break:break-all; }
        .preview-size { font-size:0.72rem; color:var(--text-secondary); }
        .btn-clear-preview { width:28px; height:28px; border-radius:7px; border:none; background:rgba(239,68,68,0.09); color:#dc2626; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:var(--transition-smooth); flex-shrink:0; font-size:0.85rem; }
        .btn-clear-preview:hover { background:#dc2626; color:#fff; }

        /* Actions */
        .form-actions { display:flex; justify-content:flex-end; align-items:center; gap:10px; }
        .btn-save { background:var(--roasted-brown); color:#fff; border:none; border-radius:10px; padding:10px 22px; font-weight:700; font-size:0.875rem; display:inline-flex; align-items:center; gap:8px; transition:var(--transition-smooth); cursor:pointer; font-family:inherit; box-shadow:0 4px 14px rgba(74,44,17,0.22); }
        .btn-save:hover { background:var(--dark-coffee); color:#fff; transform:translateY(-2px); box-shadow:0 8px 20px rgba(44,24,8,0.28); }
        .btn-cancel { border:1px solid rgba(74,44,17,0.15); border-radius:10px; padding:10px 20px; font-weight:600; font-size:0.875rem; color:var(--text-secondary); background:transparent; text-decoration:none; display:inline-flex; align-items:center; gap:7px; transition:var(--transition-smooth); }
        .btn-cancel:hover { background:var(--bg-cream); color:var(--roasted-brown); border-color:var(--roasted-brown); text-decoration:none; }

        /* Info card */
        .info-card { background:var(--card-white); border-radius:var(--radius-card); box-shadow:var(--shadow-soft); border:1px solid rgba(74,44,17,0.06); overflow:hidden; margin-bottom:14px; }
        .info-card-header { padding:14px 18px; border-bottom:1px solid rgba(74,44,17,0.05); background:rgba(250,246,240,0.5); font-size:0.8rem; font-weight:700; color:var(--dark-coffee); display:flex; align-items:center; gap:7px; }
        .info-card-header i { color:var(--amber-cream); }
        .info-card-body { padding:14px 18px; }
        .meta-row { display:flex; justify-content:space-between; align-items:center; padding:7px 0; border-bottom:1px solid rgba(74,44,17,0.04); font-size:0.78rem; }
        .meta-row:last-child { border-bottom:none; }
        .meta-label { color:var(--text-secondary); font-weight:500; }
        .meta-value { color:var(--dark-coffee); font-weight:700; text-align:right; }
        .badge-active   { color:var(--forest-green); background:rgba(45,106,79,0.1);  padding:3px 9px; border-radius:20px; font-size:0.7rem; }
        .badge-inactive { color:#dc2626;             background:rgba(239,68,68,0.09); padding:3px 9px; border-radius:20px; font-size:0.7rem; }
        .quick-link { display:flex; align-items:center; gap:10px; padding:9px 11px; border-radius:9px; color:var(--dark-coffee); font-size:0.8rem; font-weight:600; text-decoration:none; transition:var(--transition-smooth); }
        .quick-link:hover { background:rgba(230,161,92,0.08); color:var(--dark-coffee); text-decoration:none; }
        .quick-link i { font-size:1rem; }
        .quick-link.danger { color:#dc2626; }
        .quick-link.danger:hover { background:rgba(239,68,68,0.07); color:#dc2626; }

        /* flash */
        .flash-alert { border-radius:12px; border:none; display:flex; align-items:center; gap:12px; padding:13px 17px; font-weight:500; font-size:0.875rem; margin-bottom:22px; }
        .flash-danger { background:rgba(239,68,68,0.09); color:#dc2626; border-left:4px solid #dc2626; }
        .flash-alert i { font-size:1.1rem; flex-shrink:0; }

        @media (max-width:991px) { .main-content{margin-left:0;padding:20px 16px 40px;} .notif-dropdown{right:-60px;width:300px;} }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="bi bi-patch-check-fill"></i></div>
        <span>ADMIN <br><small style="font-weight:400;font-size:0.7rem;color:#A8988A;">Liberchain</small></span>
    </div>
    <div class="sidebar-menu-wrapper">
        <ul class="sidebar-menu">
            <li class="menu-item"><a href="<?= base_url('admin/dashboard'); ?>"><i class="bi bi-grid-1x2-fill"></i>Dashboard</a></li>
            <li class="menu-item"><a href="<?= base_url('admin/user'); ?>"><i class="bi bi-people-fill"></i>Manajemen User</a></li>
            <li class="menu-item"><a href="<?= base_url('admin/petani'); ?>"><i class="bi bi-person-badge-fill"></i>Data Petani</a></li>
            <li class="menu-item"><a href="<?= base_url('admin/lahan'); ?>"><i class="bi bi-map-fill"></i>Manajemen Lahan</a></li>
            <li class="menu-item"><a href="<?= base_url('admin/panen'); ?>"><i class="bi bi-tree-fill"></i>Rekap Panen</a></li>
            <li class="menu-item"><a href="<?= base_url('admin/produk'); ?>"><i class="bi bi-box-seam-fill"></i>Manajemen Produk</a></li>
            <li class="menu-item"><a href="<?= base_url('admin/transaksi'); ?>"><i class="bi bi-wallet2"></i>Transaksi</a></li>
            <li class="menu-item"><a href="<?= base_url('admin/kurir'); ?>"><i class="bi bi-truck"></i>Manajemen Kurir</a></li>
            <li class="menu-item active"><a href="<?= base_url('admin/mitra'); ?>"><i class="bi bi-shop"></i>Manajemen Mitra</a></li>
            <li class="menu-item"><a href="<?= base_url('admin/laporan'); ?>"><i class="bi bi-file-earmark-bar-graph-fill"></i>Laporan & Analytics</a></li>
        </ul>
    </div>
    <div class="sidebar-footer">
        <button class="btn-logout" onclick="window.location.href='<?= base_url('auth/logout'); ?>'">
            <i class="bi bi-box-arrow-right"></i> Keluar
        </button>
    </div>
</div>

<!-- MAIN -->
<div class="main-content">
    <div class="page-header d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <div class="breadcrumb-nav">
                <a href="<?= base_url('admin/mitra'); ?>" class="btn-back" title="Kembali"><i class="bi bi-arrow-left"></i></a>
                <span class="breadcrumb-text">Manajemen Mitra &rsaquo; <span>Edit Mitra</span></span>
                <span class="edit-pill"><i class="bi bi-pencil-fill"></i> Mode Edit</span>
            </div>
            <h2 class="mb-0"><?= htmlspecialchars($mitra['nama_mitra']); ?></h2>
            <p class="subtitle mb-0 mt-1">ID #<?= $mitra['id_mitra']; ?> &mdash; <?= htmlspecialchars($mitra['kategori_mitra']); ?> &mdash; <span id="currentDateTime" style="color:var(--amber-cream);font-weight:500;"></span></p>
        </div>
        <div class="d-flex align-items-center" style="gap:10px;">
            <!-- NOTIF BELL -->
            <div style="position:relative;">
                <button class="notif-btn" id="notifToggle" type="button">
                    <i class="bi bi-bell" style="font-size:1.15rem;"></i>
                    <?php if (isset($unread_count) && $unread_count > 0): ?>
                        <span class="notif-dot"><?= $unread_count; ?></span>
                    <?php else: ?>
                        <span class="notif-dot" style="display:none;">0</span>
                    <?php endif; ?>
                </button>
                <div class="notif-dropdown" id="notifDropdown">
                    <div class="notif-dropdown-header">
                        <span><?= (isset($unread_count) && $unread_count > 0) ? $unread_count.' Belum Dibaca' : 'Notifikasi'; ?></span>
                        <a href="<?= base_url('admin/dashboard/history'); ?>">Lihat Semua</a>
                    </div>
                    <div class="notif-dropdown-list">
                        <?php if (!empty($notifikasi)):
                            $icon_map = ['success'=>'bi-check-circle-fill','warning'=>'bi-exclamation-triangle-fill','danger'=>'bi-x-circle-fill','info'=>'bi-info-circle-fill'];
                            foreach ($notifikasi as $n):
                                $icon_type  = $n['icon'] ?? 'info';
                                $icon_class = $icon_map[$icon_type] ?? 'bi-info-circle-fill';
                        ?>
                        <a class="notif-item <?= ($n['status_baca']=='0')?'unread':''; ?>" href="<?= base_url('admin/dashboard/read/'.$n['id_notifikasi']); ?>">
                            <div class="notif-icon <?= $icon_type; ?>"><i class="bi <?= $icon_class; ?>"></i></div>
                            <div class="notif-text"><?= htmlspecialchars($n['isi_notifikasi']); ?><span class="notif-time"><i class="bi bi-clock"></i> <?= date('d M Y, H:i',strtotime($n['tanggal_buat'])); ?></span></div>
                            <?php if ($n['status_baca']=='0'): ?><span class="notif-badge-new">Baru</span><?php endif; ?>
                        </a>
                        <?php endforeach; else: ?>
                        <div class="text-center text-muted py-4"><i class="bi bi-bell-slash d-block mb-2" style="font-size:1.8rem;"></i><p class="small mb-0">Tidak ada notifikasi</p></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- USER BADGE -->
            <div class="user-badge">
                <i class="bi bi-person-circle" style="font-size:1.4rem;color:var(--amber-cream);"></i>
                <div><div style="font-size:0.82rem;font-weight:600;line-height:1.2;">Admin</div><span class="role-pill">Administrator</span></div>
            </div>
        </div>
    </div>

    <!-- FLASH -->
    <?php if ($this->session->flashdata('error')): ?>
    <div class="flash-alert flash-danger">
        <i class="bi bi-exclamation-triangle-fill"></i><span><?= $this->session->flashdata('error'); ?></span>
    </div>
    <?php endif; ?>

    <div class="row" style="margin:0 -12px;">
        <!-- FORM UTAMA -->
        <div class="col-lg-8" style="padding:0 12px;margin-bottom:20px;">
            <div class="form-card">
                <div class="form-card-header">
                    <div class="hdr-icon"><i class="bi bi-pencil-square"></i></div>
                    <div><h5>Edit Informasi Mitra</h5><p>Perbarui data mitra — perubahan langsung berlaku</p></div>
                </div>
                <div class="form-card-body">
                    <!-- ACTION: POST ke admin/mitra/edit/{id}, enctype multipart untuk upload file -->
                    <form action="<?= base_url('admin/mitra/edit/'.$mitra['id_mitra']); ?>" method="POST" enctype="multipart/form-data" id="formEdit">

                        <div class="field-group">
                            <label class="field-label" for="nama_mitra"><i class="bi bi-building"></i> Nama Mitra <span class="req">*</span></label>
                            <input type="text" id="nama_mitra" name="nama_mitra" class="field-input"
                                   value="<?= htmlspecialchars($mitra['nama_mitra']); ?>" required>
                        </div>

                        <div class="field-group">
                            <label class="field-label" for="kategori_mitra"><i class="bi bi-tag-fill"></i> Kategori Mitra <span class="req">*</span></label>
                            <input type="text" id="kategori_mitra" name="kategori_mitra" class="field-input"
                                   value="<?= htmlspecialchars($mitra['kategori_mitra']); ?>" required
                                   placeholder="contoh: Cafe, Restoran, Distributor">
                        </div>

                        <div class="row" style="margin:0 -10px;">
                            <div class="col-md-6" style="padding:0 10px;">
                                <div class="field-group">
                                    <label class="field-label" for="email"><i class="bi bi-envelope-fill"></i> Email</label>
                                    <input type="email" id="email" name="email" class="field-input"
                                           placeholder="contoh: info@mitra.id"
                                           value="<?= htmlspecialchars($mitra['email'] ?? ''); ?>">
                                </div>
                            </div>
                            <div class="col-md-6" style="padding:0 10px;">
                                <div class="field-group">
                                    <label class="field-label" for="no_telepon"><i class="bi bi-telephone-fill"></i> No Telepon</label>
                                    <input type="text" id="no_telepon" name="no_telepon" class="field-input"
                                           placeholder="contoh: 0812-3456-7890"
                                           value="<?= htmlspecialchars($mitra['no_telepon'] ?? ''); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="field-group">
                            <label class="field-label" for="website"><i class="bi bi-globe2"></i> Website</label>
                            <input type="text" id="website" name="website" class="field-input"
                                   placeholder="contoh: https://www.mitra.id (opsional)"
                                   value="<?= htmlspecialchars($mitra['website'] ?? ''); ?>">
                        </div>

                        <div class="field-group">
                            <label class="field-label" for="alamat"><i class="bi bi-geo-alt-fill"></i> Alamat</label>
                            <textarea id="alamat" name="alamat" class="field-input" rows="2"
                                      placeholder="Masukkan alamat lengkap mitra"
                                      style="resize:vertical;"><?= htmlspecialchars($mitra['alamat'] ?? ''); ?></textarea>
                        </div>

                        <div class="field-group">
                            <label class="field-label" for="deskripsi"><i class="bi bi-card-text"></i> Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" class="field-input" rows="3"
                                      placeholder="Ceritakan singkat tentang mitra ini"
                                      style="resize:vertical;"><?= htmlspecialchars($mitra['deskripsi'] ?? ''); ?></textarea>
                        </div>

                        <div class="form-divider"></div>

                        <div class="field-group">
                            <label class="field-label" for="urutan_tampil"><i class="bi bi-sort-numeric-down"></i> Urutan Tampil <span class="req">*</span></label>
                            <input type="number" id="urutan_tampil" name="urutan_tampil" class="field-input"
                                   value="<?= (int)$mitra['urutan_tampil']; ?>" min="1" style="max-width:140px;" required>
                            <p class="field-hint"><i class="bi bi-info-circle"></i> Angka lebih kecil = tampil lebih awal di Landing Page.</p>
                        </div>

                        <div class="form-divider"></div>

                        <!-- LOGO SECTION -->
                        <div class="field-group" style="margin-bottom:0;">
                            <label class="field-label"><i class="bi bi-image-fill"></i> Logo Mitra</label>

                            <!-- Tampilkan logo saat ini -->
                            <div class="current-logo-box">
                                <?php if (!empty($mitra['logo_mitra']) && $mitra['logo_mitra'] !== 'default.png'): ?>
                                    <img src="<?= base_url('assets/uploads/mitra/'.$mitra['logo_mitra']); ?>"
                                         alt="Logo saat ini" class="current-logo">
                                <?php else: ?>
                                    <div class="current-logo-placeholder"><i class="bi bi-image"></i></div>
                                <?php endif; ?>
                                <div>
                                    <div class="cl-label">Logo Saat Ini</div>
                                    <div class="cl-name"><?= htmlspecialchars($mitra['logo_mitra'] ?? 'default.png'); ?></div>
                                </div>
                            </div>

                            <p style="font-size:0.78rem;color:var(--text-secondary);margin-bottom:8px;font-weight:500;">
                                <i class="bi bi-arrow-up-circle" style="color:var(--amber-cream);"></i>
                                Unggah logo baru untuk mengganti yang saat ini:
                            </p>

                            <!-- Upload field — name="logo_mitra" sesuai controller _do_upload() -->
                            <div class="upload-zone" id="uploadZone">
                                <input type="file" name="logo_mitra" id="logo_mitra" accept="image/jpeg,image/png,image/gif">
                                <div class="upload-icon-wrap"><i class="bi bi-cloud-arrow-up-fill"></i></div>
                                <h6>Klik atau seret file baru ke sini</h6>
                                <p>JPG, PNG, GIF — maks. 2 MB</p>
                            </div>

                            <!-- Preview file baru -->
                            <div class="preview-wrap" id="previewWrap">
                                <img id="previewImg" src="" alt="Preview baru" class="preview-img">
                                <div class="preview-info"><div class="preview-name" id="previewName"></div><div class="preview-size" id="previewSize"></div></div>
                                <button type="button" class="btn-clear-preview" id="clearFile" title="Batalkan pilihan"><i class="bi bi-x-lg"></i></button>
                            </div>

                            <p class="field-hint mt-2"><i class="bi bi-info-circle"></i> Biarkan kosong jika tidak ingin mengubah logo.</p>
                        </div>

                        <div class="form-divider"></div>

                        <div class="form-actions">
                            <a href="<?= base_url('admin/mitra'); ?>" class="btn-cancel"><i class="bi bi-x-lg"></i> Batal</a>
                            <button type="submit" class="btn-save"><i class="bi bi-floppy-fill"></i> Simpan Perubahan</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- SIDEBAR INFO -->
        <div class="col-lg-4" style="padding:0 12px;">

            <!-- Detail Mitra -->
            <div class="info-card">
                <div class="info-card-header"><i class="bi bi-info-circle-fill"></i> Detail Mitra</div>
                <div class="info-card-body">
                    <div class="meta-row"><span class="meta-label">ID</span><span class="meta-value">#<?= $mitra['id_mitra']; ?></span></div>
                    <div class="meta-row"><span class="meta-label">Kategori</span><span class="meta-value"><?= htmlspecialchars($mitra['kategori_mitra']); ?></span></div>
                    <div class="meta-row"><span class="meta-label">Urutan</span><span class="meta-value"><?= (int)$mitra['urutan_tampil']; ?></span></div>
                    <div class="meta-row">
                        <span class="meta-label">Status</span>
                        <span class="meta-value">
                            <?php if ($mitra['status_mitra'] === 'Active'): ?>
                                <span class="badge-active"><i class="bi bi-check-circle-fill"></i> Aktif</span>
                            <?php else: ?>
                                <span class="badge-inactive"><i class="bi bi-x-circle-fill"></i> Nonaktif</span>
                            <?php endif; ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Aksi Cepat -->
            <div class="info-card">
                <div class="info-card-header"><i class="bi bi-lightning-charge-fill"></i> Aksi Cepat</div>
                <div class="info-card-body" style="padding:10px 14px;">
                    <a href="<?= base_url('admin/mitra'); ?>" class="quick-link"><i class="bi bi-arrow-left-circle" style="color:var(--amber-cream);"></i> Kembali ke Daftar</a>
                    <a href="<?= base_url('admin/mitra/add'); ?>" class="quick-link"><i class="bi bi-plus-circle" style="color:var(--forest-green);"></i> Tambah Mitra Lain</a>
                    <!-- Hapus Permanen via modal -->
                    <button type="button" class="quick-link danger w-100 text-left" style="border:none;background:transparent;font-family:inherit;cursor:pointer;"
                            id="btnHapusSidebar"
                            data-id="<?= $mitra['id_mitra']; ?>"
                            data-nama="<?= htmlspecialchars($mitra['nama_mitra']); ?>">
                        <i class="bi bi-trash3" style="font-size:1rem;margin-right:10px;"></i> Hapus Mitra Permanen
                    </button>
                </div>
            </div>

            <!-- Tips -->
            <div class="info-card">
                <div class="info-card-header"><i class="bi bi-lightbulb-fill"></i> Catatan Edit</div>
                <div class="info-card-body" style="padding:14px 18px;">
                    <p style="font-size:0.77rem;color:var(--text-secondary);margin-bottom:8px;">Kosongkan kolom logo jika tidak ingin menggantinya.</p>
                    <p style="font-size:0.77rem;color:var(--text-secondary);margin-bottom:8px;">Perubahan urutan tampil langsung berlaku di Landing Page.</p>
                    <p style="font-size:0.77rem;color:var(--text-secondary);margin:0;">Untuk mengubah status aktif/nonaktif, gunakan toggle di halaman daftar mitra. Menghapus mitra bersifat permanen dan tidak dapat dibatalkan.</p>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- MODAL HAPUS PERMANEN -->
<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:420px;">
        <div class="modal-content" style="border-radius:16px;border:none;box-shadow:var(--shadow-hover);">
            <div class="modal-header" style="border-bottom:1px solid rgba(74,44,17,0.06);padding:18px 22px 14px;">
                <h5 class="modal-title font-weight-bold" style="font-size:0.9rem;">Hapus Mitra Permanen</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body text-center" style="padding:22px 22px 16px;">
                <div style="width:56px;height:56px;background:rgba(239,68,68,0.1);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-size:1.5rem;color:#dc2626;">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <p style="font-size:0.875rem;color:var(--text-secondary);margin:0;">
                    Anda akan menghapus mitra <strong id="modalNamaMitra" style="color:var(--dark-coffee);"></strong> secara permanen.
                </p>
                <p style="font-size:0.78rem;color:#dc2626;font-weight:600;margin:8px 0 0;">
                    <i class="bi bi-info-circle"></i> Tindakan ini TIDAK BISA dibatalkan.
                </p>
                <div class="mt-3 text-left">
                    <label style="font-size:0.7rem;font-weight:700;color:var(--text-secondary);text-transform:uppercase;letter-spacing:0.4px;">Ketik nama mitra untuk konfirmasi</label>
                    <input type="text" id="inputKonfirmHapus" style="width:100%;padding:9px 13px;border:1px solid rgba(74,44,17,0.18);border-radius:9px;font-size:0.85rem;font-family:inherit;margin-top:6px;" placeholder="Ketik nama mitra di sini...">
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-end" style="gap:8px;border-top:1px solid rgba(74,44,17,0.06);padding:14px 22px;">
                <button type="button" data-dismiss="modal" style="border:1px solid rgba(74,44,17,0.15);border-radius:9px;padding:8px 16px;background:transparent;color:var(--text-secondary);font-weight:600;font-size:0.85rem;cursor:pointer;font-family:inherit;">Batal</button>
                <a href="#" id="btnKonfirmHapus" style="background:#dc2626;color:#fff;border:none;border-radius:9px;padding:8px 18px;font-weight:700;font-size:0.85rem;display:inline-flex;align-items:center;gap:6px;text-decoration:none;pointer-events:none;opacity:0.5;">
                    <i class="bi bi-trash3-fill"></i> Ya, Hapus Permanen
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(function () {

    /* Jam real-time */
    function updateTime() {
        var days=['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'], months=['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        var now=new Date();
        $('#currentDateTime').text(days[now.getDay()]+', '+now.getDate()+' '+months[now.getMonth()]+' '+now.getFullYear()+'  |  '+String(now.getHours()).padStart(2,'0')+':'+String(now.getMinutes()).padStart(2,'0')+':'+String(now.getSeconds()).padStart(2,'0'));
    }
    updateTime(); setInterval(updateTime,1000);

    /* Notif toggle */
    $('#notifToggle').click(function(e){e.stopPropagation();$('#notifDropdown').toggleClass('show');});
    $(document).click(function(){$('#notifDropdown').removeClass('show');});

    /* Logo preview */
    var fileInput = document.getElementById('logo_mitra');
    var previewWrap = document.getElementById('previewWrap');
    var previewImg  = document.getElementById('previewImg');
    var previewName = document.getElementById('previewName');
    var previewSize = document.getElementById('previewSize');
    var zone = document.getElementById('uploadZone');

    fileInput.addEventListener('change', function(){if(this.files[0]) showPreview(this.files[0]);});
    zone.addEventListener('dragover',  function(e){e.preventDefault();this.classList.add('dragover');});
    zone.addEventListener('dragleave', function(){this.classList.remove('dragover');});
    zone.addEventListener('drop',      function(){this.classList.remove('dragover');});

    document.getElementById('clearFile').addEventListener('click', function(){
        fileInput.value=''; previewWrap.style.display='none'; previewImg.src='';
    });

    function showPreview(file){
        var reader=new FileReader();
        reader.onload=function(e){
            previewImg.src=e.target.result;
            previewName.textContent=file.name;
            previewSize.textContent=fmtBytes(file.size);
            previewWrap.style.display='flex';
        };
        reader.readAsDataURL(file);
    }

    function fmtBytes(b){
        if(b<1024) return b+' B';
        if(b<1048576) return (b/1024).toFixed(1)+' KB';
        return (b/1048576).toFixed(1)+' MB';
    }

    /* Modal hapus dari sidebar */
    var namaMitraAktif = '';
    $('#btnHapusSidebar').click(function(){
        var id=$(this).data('id'), nama=$(this).data('nama');
        namaMitraAktif = nama;
        $('#modalNamaMitra').text('"'+nama+'"');
        $('#inputKonfirmHapus').val('');
        $('#btnKonfirmHapus').attr('href',"<?= base_url('admin/mitra/delete/'); ?>"+id)
            .css({'pointer-events':'none','opacity':'0.5'});
        $('#modalHapus').modal('show');
    });

    $('#inputKonfirmHapus').on('input', function(){
        var match = ($(this).val().trim() === namaMitraAktif.trim());
        $('#btnKonfirmHapus').css(match ? {'pointer-events':'auto','opacity':'1'} : {'pointer-events':'none','opacity':'0.5'});
    });

    $('#modalHapus').on('hidden.bs.modal', function(){
        $('#inputKonfirmHapus').val('');
        $('#btnKonfirmHapus').css({'pointer-events':'none','opacity':'0.5'});
    });

    /* Flash dismiss */
    setTimeout(function(){$('.flash-alert').fadeOut('slow');},4000);
});
</script>
</body>
</html>