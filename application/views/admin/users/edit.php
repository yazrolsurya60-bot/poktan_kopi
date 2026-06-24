<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Sistem Supply Chain Kopi</title>
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

        /* --- MAIN CONTENT --- */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 30px 40px 40px;
            min-height: 100vh;
            transition: var(--transition-smooth);
        }

        /* --- PAGE HEADER --- */
        .page-header {
            border-bottom: 1px solid rgba(74, 44, 17, 0.08);
            padding-bottom: 20px;
            margin-bottom: 30px;
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

        /* --- CUSTOM CARD --- */
        .custom-card {
            background: var(--card-white);
            border: 1px solid rgba(74, 44, 17, 0.06);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-soft);
            transition: var(--transition-smooth);
            overflow: hidden;
            max-width: 600px;
            margin: 0 auto;
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

        /* --- FORM --- */
        .form-custom .form-group {
            margin-bottom: 20px;
        }

        .form-custom label {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--dark-coffee);
            margin-bottom: 6px;
        }

        .form-custom .form-control,
        .form-custom .form-select {
            border: 1px solid rgba(74, 44, 17, 0.12);
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 0.9rem;
            transition: var(--transition-smooth);
            background: var(--card-white);
            color: var(--dark-coffee);
        }

        .form-custom .form-control:focus,
        .form-custom .form-select:focus {
            border-color: var(--amber-cream);
            box-shadow: 0 0 0 3px rgba(230, 161, 92, 0.15);
        }

        .form-custom .form-control::placeholder {
            color: #B8B0A8;
            font-size: 0.85rem;
        }

        .form-custom .form-text {
            font-size: 0.75rem;
            color: var(--text-secondary);
            margin-top: 4px;
        }

        /* --- BUTTONS --- */
        .btn-custom-primary {
            background: var(--roasted-brown);
            color: white;
            border-radius: 10px;
            padding: 10px 28px;
            font-weight: 600;
            font-size: 0.85rem;
            border: none;
            transition: var(--transition-smooth);
        }

        .btn-custom-primary:hover {
            background: var(--dark-coffee);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-soft);
        }

        .btn-custom-secondary {
            background: transparent;
            color: var(--text-secondary);
            border: 1px solid rgba(74, 44, 17, 0.15);
            border-radius: 10px;
            padding: 10px 28px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: var(--transition-smooth);
        }

        .btn-custom-secondary:hover {
            background: var(--bg-cream);
            border-color: var(--roasted-brown);
            color: var(--roasted-brown);
            text-decoration: none;
        }

        /* --- ALERT --- */
        .alert-custom {
            border-radius: var(--radius-card);
            border: none;
            padding: 16px 20px;
            margin-bottom: 24px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .alert-custom.alert-success {
            background: #D1FAE5;
            color: #065F46;
        }

        .alert-custom.alert-danger {
            background: #FEE2E2;
            color: #991B1B;
        }

        /* --- RESPONSIVE --- */
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

            .custom-card {
                max-width: 100%;
            }
        }

        @media (max-width: 575.98px) {
            .main-content {
                padding: 16px 12px 20px;
            }

            .custom-card .card-body-custom {
                padding: 16px;
            }

            .btn-custom-primary,
            .btn-custom-secondary {
                width: 100%;
                margin-bottom: 8px;
                text-align: center;
            }

            .btn-group-custom {
                flex-direction: column;
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
        .sidebar-menu-wrapper::-webkit-scrollbar {
            width: 3px;
        }

        .sidebar-menu-wrapper::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-menu-wrapper::-webkit-scrollbar-thumb {
            background: rgba(230, 161, 92, 0.3);
            border-radius: 10px;
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
                <li class="menu-item active">
                    <a href="<?= base_url('admin/user'); ?>">
                        <i class="bi bi-people-fill"></i>Manajemen User
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('admin/petani'); ?>">
                        <i class="bi bi-person-badge-fill"></i>Data Petani
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
                        <span class="menu-badge">8</span>
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
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('admin/laporan'); ?>">
                        <i class="bi bi-file-earmark-bar-graph-fill"></i>Laporan & Analytics
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
                <h2 class="d-inline-block align-middle mb-0">Edit User</h2>
                <p class="subtitle mb-0 mt-1">Edit data user yang sudah terdaftar</p>
            </div>
            <div class="d-flex align-items-center gap-3" style="gap: 12px;">
                <div class="d-flex align-items-center gap-2" style="cursor: pointer; padding: 6px 12px; border-radius: 10px; background: var(--card-white); border: 1px solid rgba(74,44,17,0.06);">
                    <i class="bi bi-person-circle" style="font-size: 1.5rem; color: var(--amber-cream);"></i>
                    <span style="font-weight:500; font-size:0.85rem;">Admin</span>
                </div>
            </div>
        </div>

        <!-- ALERT MESSAGES -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert-custom alert-success">
                <i class="bi bi-check-circle-fill mr-2"></i> <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert-custom alert-danger">
                <i class="bi bi-exclamation-circle-fill mr-2"></i> <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php $user = $user ?? []; ?>

        <!-- FORM CARD -->
        <div class="custom-card">
            <div class="card-header-custom">
                <h6><i class="bi bi-pencil-square text-primary mr-2"></i> Form Edit User</h6>
                <span class="badge" style="background: var(--bg-cream); color: var(--text-secondary); font-weight:500;">
                    ID: <?= $user['id_user'] ?? '-' ?>
                </span>
            </div>
            <div class="card-body-custom">
                <form method="post" action="<?= site_url('admin/user/edit/' . ($user['id_user'] ?? '')) ?>" class="form-custom">
                    <div class="form-group">
                        <label for="username">
                            <i class="bi bi-person mr-1 text-muted"></i> Username
                        </label>
                        <input type="text" name="username" id="username" class="form-control" 
                               value="<?= htmlspecialchars($user['username'] ?? '') ?>" 
                               placeholder="Masukkan username" required />
                    </div>
                    <div class="form-group">
                        <label for="email">
                            <i class="bi bi-envelope mr-1 text-muted"></i> Email
                        </label>
                        <input type="email" name="email" id="email" class="form-control" 
                               value="<?= htmlspecialchars($user['email'] ?? '') ?>" 
                               placeholder="Masukkan email" required />
                    </div>
                    <div class="form-group">
                        <label for="password">
                            <i class="bi bi-lock mr-1 text-muted"></i> Password
                        </label>
                        <input type="password" name="password" id="password" class="form-control" 
                               placeholder="Kosongkan jika tidak ingin mengubah password" />
                        <small class="form-text">
                            <i class="bi bi-info-circle mr-1"></i> Kosongkan jika tidak ingin mengubah password
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="role">
                            <i class="bi bi-tag mr-1 text-muted"></i> Role
                        </label>
                        <select name="role" id="role" class="form-select" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="Admin" <?= (isset($user['role']) && $user['role'] === 'Admin') ? 'selected' : '' ?>>Admin</option>
                            <option value="Petani" <?= (isset($user['role']) && $user['role'] === 'Petani') ? 'selected' : '' ?>>Petani</option>
                            <option value="Pembeli" <?= (isset($user['role']) && $user['role'] === 'Pembeli') ? 'selected' : '' ?>>Pembeli</option>
                            <option value="Guest" <?= (isset($user['role']) && $user['role'] === 'Guest') ? 'selected' : '' ?>>Guest</option>
                        </select>
                    </div>
                    <div class="d-flex gap-2 btn-group-custom" style="gap: 10px; margin-top: 24px;">
                        <button type="submit" class="btn-custom-primary">
                            <i class="bi bi-pencil-square mr-1"></i> Update
                        </button>
                        <a href="<?= site_url('admin/user') ?>" class="btn-custom-secondary">
                            <i class="bi bi-arrow-left mr-1"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ============================================
        // SIDEBAR TOGGLE
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

        console.log('✅ Form Edit User siap digunakan!');
    </script>
</body>

</html>