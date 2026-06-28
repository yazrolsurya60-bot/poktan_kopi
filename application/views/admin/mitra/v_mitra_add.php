<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mitra - LiberChain</title>
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
        .user-badge { display:flex; align-items:center; gap:8px; padding:6px 12px; border-radius:10px; background:var(--card-white); border:1px solid rgba(74,44,17,0.06); font-weight:500; font-size:0.85rem; cursor:default; }
        .role-pill { font-size:0.65rem; font-weight:700; padding:2px 8px; border-radius:10px; background:rgba(230,161,92,0.15); color:var(--amber-cream); text-transform:uppercase; letter-spacing:0.5px; }

        /* Breadcrumb back */
        .breadcrumb-nav { display:flex; align-items:center; gap:10px; margin-bottom:6px; }
        .btn-back { width:36px; height:36px; border-radius:9px; background:rgba(74,44,17,0.07); border:1px solid rgba(74,44,17,0.1); display:flex; align-items:center; justify-content:center; color:var(--roasted-brown); font-size:1rem; text-decoration:none; transition:var(--transition-smooth); }
        .btn-back:hover { background:var(--amber-cream); color:#fff; border-color:transparent; text-decoration:none; }
        .breadcrumb-text { font-size:0.75rem; color:var(--text-secondary); font-weight:500; }
        .breadcrumb-text span { color:var(--dark-coffee); font-weight:700; }

        /* Form card */
        .form-card { background:var(--card-white); border-radius:var(--radius-card); box-shadow:var(--shadow-soft); border:1px solid rgba(74,44,17,0.06); overflow:hidden; }
        .form-card-header { padding:18px 24px; border-bottom:1px solid rgba(74,44,17,0.06); background:rgba(250,246,240,0.5); display:flex; align-items:center; gap:12px; }
        .form-card-header .hdr-icon { width:36px; height:36px; border-radius:10px; background:rgba(230,161,92,0.15); display:flex; align-items:center; justify-content:center; color:var(--amber-cream); font-size:1rem; }
        .form-card-header h5 { margin:0; font-weight:700; font-size:0.9rem; color:var(--dark-coffee); }
        .form-card-header p { margin:0; font-size:0.77rem; color:var(--text-secondary); }
        .form-card-body { padding:26px; }

        .field-group { margin-bottom:20px; }
        .field-label { font-size:0.78rem; font-weight:700; color:var(--dark-coffee); margin-bottom:7px; display:flex; align-items:center; gap:6px; }
        .field-label i { color:var(--amber-cream); }
        .req { color:#dc2626; }
        .field-input { width:100%; padding:10px 14px; border:1px solid rgba(74,44,17,0.15); border-radius:10px; font-size:0.875rem; font-family:inherit; color:var(--dark-coffee); background:var(--bg-cream); transition:var(--transition-smooth); appearance:none; -webkit-appearance:none; }
        .field-input:focus { border-color:var(--amber-cream); box-shadow:0 0 0 3px rgba(230,161,92,0.18); outline:none; background:#fff; }
        .field-input::placeholder { color:#b5a89e; }
        .field-hint { font-size:0.73rem; color:var(--text-secondary); margin-top:5px; display:flex; align-items:center; gap:5px; }
        .field-hint i { color:var(--amber-cream); }
        .form-divider { height:1px; background:rgba(74,44,17,0.06); margin:22px 0; }

        /* Upload zone */
        .upload-zone { border:2px dashed rgba(74,44,17,0.15); border-radius:12px; padding:22px 16px; text-align:center; background:rgba(250,246,240,0.5); transition:var(--transition-smooth); cursor:pointer; position:relative; }
        .upload-zone:hover { border-color:var(--amber-cream); background:rgba(230,161,92,0.04); }
        .upload-zone.dragover { border-color:var(--amber-cream); background:rgba(230,161,92,0.07); }
        .upload-zone input[type="file"] { position:absolute; inset:0; opacity:0; cursor:pointer; width:100%; height:100%; }
        .upload-icon-wrap { width:46px; height:46px; border-radius:12px; background:rgba(230,161,92,0.12); display:flex; align-items:center; justify-content:center; margin:0 auto 10px; color:var(--amber-cream); font-size:1.3rem; }
        .upload-zone h6 { font-size:0.84rem; font-weight:700; color:var(--dark-coffee); margin:0 0 3px; }
        .upload-zone p  { font-size:0.73rem; color:var(--text-secondary); margin:0; }

        /* Preview */
        .preview-wrap { display:none; margin-top:12px; padding:12px; background:#fff; border-radius:10px; border:1px solid rgba(74,44,17,0.08); align-items:center; gap:12px; }
        .preview-img  { width:58px; height:58px; object-fit:contain; border-radius:9px; border:1px solid rgba(74,44,17,0.08); }
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

        /* Tips */
        .tips-card { background:var(--card-white); border-radius:var(--radius-card); box-shadow:var(--shadow-soft); border:1px solid rgba(74,44,17,0.06); padding:20px 22px; margin-bottom:14px; }
        .tips-card h6 { font-size:0.8rem; font-weight:700; color:var(--dark-coffee); margin-bottom:12px; display:flex; align-items:center; gap:6px; }
        .tips-card h6 i { color:var(--amber-cream); }
        .tip-item { display:flex; align-items:flex-start; gap:8px; padding:7px 0; border-bottom:1px solid rgba(74,44,17,0.04); font-size:0.77rem; color:var(--text-secondary); font-weight:500; }
        .tip-item:last-child { border-bottom:none; }
        .tip-item i { color:var(--forest-green); font-size:0.82rem; margin-top:2px; flex-shrink:0; }

        /* flash */
        .flash-alert { border-radius:12px; border:none; display:flex; align-items:center; gap:12px; padding:13px 17px; font-weight:500; font-size:0.875rem; margin-bottom:22px; }
        .flash-danger { background:rgba(239,68,68,0.09); color:#dc2626; border-left:4px solid #dc2626; }
        .flash-alert i { font-size:1.1rem; flex-shrink:0; }

        @media (max-width:991px) { .main-content{margin-left:0;padding:20px 16px 40px;} }
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
                <span class="breadcrumb-text">Manajemen Mitra &rsaquo; <span>Tambah Mitra</span></span>
            </div>
            <h2 class="mb-0">Tambah Mitra Baru</h2>
            <p class="subtitle mb-0 mt-1">Daftarkan mitra, reseller, atau partner bisnis baru</p>
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
                <div><div style="font-size:0.82rem;font-weight:600;line-height:1.2;">Admin</div></div>
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
                    <div class="hdr-icon"><i class="bi bi-person-lines-fill"></i></div>
                    <div><h5>Informasi Mitra</h5><p>Lengkapi data berikut untuk mendaftarkan mitra baru</p></div>
                </div>
                <div class="form-card-body">
                    <!-- ACTION: POST ke admin/mitra/add, enctype multipart untuk upload file -->
                    <form action="<?= base_url('admin/mitra/add'); ?>" method="POST" enctype="multipart/form-data" id="formAdd">

                        <div class="field-group">
                            <label class="field-label" for="nama_mitra"><i class="bi bi-building"></i> Nama Mitra <span class="req">*</span></label>
                            <input type="text" id="nama_mitra" name="nama_mitra" class="field-input"
                                   placeholder="contoh: Cafe Senja Arabica" required
                                   value="<?= set_value('nama_mitra'); ?>">
                        </div>

                        <div class="field-group">
                            <label class="field-label" for="kategori_mitra"><i class="bi bi-tag-fill"></i> Kategori Mitra <span class="req">*</span></label>
                            <input type="text" id="kategori_mitra" name="kategori_mitra" class="field-input"
                                   placeholder="contoh: Cafe, Restoran, Distributor, Reseller" required
                                   value="<?= set_value('kategori_mitra'); ?>">
                            <p class="field-hint"><i class="bi bi-lightbulb"></i> Kategori digunakan sebagai filter di Landing Page.</p>
                        </div>

                        <div class="field-group">
                            <label class="field-label" for="urutan_tampil"><i class="bi bi-sort-numeric-down"></i> Urutan Tampil <span class="req">*</span></label>
                            <input type="number" id="urutan_tampil" name="urutan_tampil" class="field-input"
                                   value="<?= set_value('urutan_tampil','1'); ?>" min="1" style="max-width:140px;" required>
                            <p class="field-hint"><i class="bi bi-info-circle"></i> Angka lebih kecil = tampil lebih awal di Landing Page.</p>
                        </div>

                        <div class="form-divider"></div>

                        <!-- UPLOAD LOGO — name="logo_mitra" sesuai controller _do_upload() -->
                        <div class="field-group" style="margin-bottom:0;">
                            <label class="field-label"><i class="bi bi-image-fill"></i> Logo Mitra</label>
                            <div class="upload-zone" id="uploadZone">
                                <input type="file" name="logo_mitra" id="logo_mitra" accept="image/jpeg,image/png,image/gif">
                                <div class="upload-icon-wrap"><i class="bi bi-cloud-arrow-up-fill"></i></div>
                                <h6>Klik atau seret file ke sini</h6>
                                <p>JPG, PNG, GIF — maks. 2 MB</p>
                            </div>
                            <!-- Preview -->
                            <div class="preview-wrap" id="previewWrap">
                                <img id="previewImg" src="" alt="Preview" class="preview-img">
                                <div class="preview-info"><div class="preview-name" id="previewName"></div><div class="preview-size" id="previewSize"></div></div>
                                <button type="button" class="btn-clear-preview" id="clearFile" title="Hapus pilihan"><i class="bi bi-x-lg"></i></button>
                            </div>
                            <p class="field-hint mt-2"><i class="bi bi-info-circle"></i> Kosongkan jika belum punya logo — akan pakai gambar default.</p>
                        </div>

                        <div class="form-divider"></div>

                        <div class="form-actions">
                            <a href="<?= base_url('admin/mitra'); ?>" class="btn-cancel"><i class="bi bi-x-lg"></i> Batal</a>
                            <button type="submit" class="btn-save"><i class="bi bi-floppy-fill"></i> Simpan Mitra</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- SIDEBAR TIPS -->
        <div class="col-lg-4" style="padding:0 12px;">
            <div class="tips-card">
                <h6><i class="bi bi-lightbulb-fill"></i> Tips Pengisian</h6>
                <div class="tip-item"><i class="bi bi-check-circle-fill"></i><span>Gunakan nama resmi mitra sesuai perjanjian kerjasama.</span></div>
                <div class="tip-item"><i class="bi bi-check-circle-fill"></i><span>Kategori mempermudah pengunjung menemukan mitra yang tepat.</span></div>
                <div class="tip-item"><i class="bi bi-check-circle-fill"></i><span>Urutan kecil (1, 2, 3) tampil lebih awal di Landing Page.</span></div>
                <div class="tip-item"><i class="bi bi-check-circle-fill"></i><span>Logo ideal: 200×200px, format PNG transparan lebih disarankan.</span></div>
                <div class="tip-item"><i class="bi bi-check-circle-fill"></i><span>Status awal otomatis <strong>Aktif</strong> dan dapat diubah di daftar mitra.</span></div>
            </div>
            <div class="tips-card" style="background:linear-gradient(135deg,rgba(45,106,79,0.04) 0%,rgba(230,161,92,0.04) 100%);">
                <h6><i class="bi bi-globe2"></i> Tampil di Landing Page</h6>
                <div class="tip-item"><i class="bi bi-shop"></i><span>Mitra aktif akan muncul otomatis di halaman publik LiberChain.</span></div>
                <div class="tip-item"><i class="bi bi-toggle-on"></i><span>Mitra nonaktif tersembunyi dari publik namun data tetap tersimpan.</span></div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(function () {

    /* Notif toggle */
    $('#notifToggle').click(function (e) { e.stopPropagation(); $('#notifDropdown').toggleClass('show'); });
    $(document).click(function () { $('#notifDropdown').removeClass('show'); });

    /* Logo preview */
    var fileInput = document.getElementById('logo_mitra');
    var previewWrap = document.getElementById('previewWrap');
    var previewImg  = document.getElementById('previewImg');
    var previewName = document.getElementById('previewName');
    var previewSize = document.getElementById('previewSize');
    var zone = document.getElementById('uploadZone');

    fileInput.addEventListener('change', function () { if (this.files[0]) showPreview(this.files[0]); });

    zone.addEventListener('dragover',  function (e) { e.preventDefault(); this.classList.add('dragover'); });
    zone.addEventListener('dragleave', function ()   { this.classList.remove('dragover'); });
    zone.addEventListener('drop',      function ()   { this.classList.remove('dragover'); });

    document.getElementById('clearFile').addEventListener('click', function () {
        fileInput.value = '';
        previewWrap.style.display = 'none';
        previewImg.src = '';
    });

    function showPreview(file) {
        var reader = new FileReader();
        reader.onload = function (e) {
            previewImg.src       = e.target.result;
            previewName.textContent = file.name;
            previewSize.textContent = fmtBytes(file.size);
            previewWrap.style.display = 'flex';
        };
        reader.readAsDataURL(file);
    }

    function fmtBytes(b) {
        if (b < 1024) return b + ' B';
        if (b < 1048576) return (b/1024).toFixed(1) + ' KB';
        return (b/1048576).toFixed(1) + ' MB';
    }

    /* Flash dismiss */
    setTimeout(function () { $('.flash-alert').fadeOut('slow'); }, 4000);
});
</script>
</body>
</html>