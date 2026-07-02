<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk Kopi - Petani</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
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

        /* ===== SIDEBAR ===== */
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

        /* ===== SIDEBAR OVERLAY ===== */
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

        /* ===== MAIN CONTENT ===== */
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

        /* ===== NOTIFICATION ===== */
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

        /* ===== CUSTOM CARD ===== */
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

        .card-header-custom {
            padding: 18px 28px;
            border-bottom: 1px solid rgba(74, 44, 17, 0.06);
            font-weight: 700;
            font-size: 1rem;
            color: var(--dark-coffee);
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--bg-cream);
        }

        .card-header-custom i {
            color: var(--amber-cream);
            font-size: 1.2rem;
        }

        .card-header-custom .badge-required {
            font-size: 0.65rem;
            font-weight: 600;
            color: var(--text-secondary);
            background: rgba(74, 44, 17, 0.06);
            padding: 3px 12px;
            border-radius: 20px;
            margin-left: auto;
        }

        .card-body-custom {
            padding: 28px 28px 20px;
        }

        /* ===== FORM ===== */
        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            font-weight: 600;
            font-size: 0.78rem;
            color: var(--text-secondary);
            margin-bottom: 5px;
            letter-spacing: 0.2px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .form-group label .required {
            color: #EF4444;
            font-weight: 700;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            border: 1px solid rgba(74, 44, 17, 0.12);
            padding: 10px 16px;
            font-size: 0.88rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: var(--transition-smooth);
            background: var(--card-white);
            height: 44px;
        }

        .form-control::placeholder {
            color: #B8B0A8;
            font-size: 0.82rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--amber-cream);
            box-shadow: 0 0 0 4px rgba(230, 161, 92, 0.1);
            outline: none;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 70px;
            height: auto;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2370655E' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 36px;
        }

        /* ===== FILE UPLOAD ===== */
        .file-upload-wrapper {
            position: relative;
        }

        .file-upload-wrapper input[type="file"] {
            display: block;
            width: 100%;
            padding: 9px 14px;
            border: 2px dashed rgba(74, 44, 17, 0.12);
            border-radius: 10px;
            background: var(--bg-cream);
            cursor: pointer;
            transition: var(--transition-smooth);
            font-size: 0.82rem;
            color: var(--text-secondary);
            height: 44px;
        }

        .file-upload-wrapper input[type="file"]:hover {
            border-color: var(--amber-cream);
            background: rgba(230, 161, 92, 0.04);
        }

        .file-upload-wrapper input[type="file"]::file-selector-button {
            padding: 5px 16px;
            border: none;
            border-radius: 6px;
            background: var(--amber-cream);
            color: white;
            font-weight: 600;
            font-size: 0.72rem;
            cursor: pointer;
            margin-right: 10px;
            transition: var(--transition-smooth);
        }

        .file-upload-wrapper input[type="file"]::file-selector-button:hover {
            background: var(--roasted-brown);
        }

        .file-helper {
            font-size: 0.7rem;
            color: var(--text-secondary);
            margin-top: 4px;
            display: block;
        }

        .file-helper i {
            font-size: 0.65rem;
        }

        /* ===== BUTTON ===== */
        .btn-custom {
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 10px 28px;
            border: none;
            transition: var(--transition-smooth);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary-custom {
            background: var(--amber-cream);
            color: white;
        }

        .btn-primary-custom:hover {
            background: var(--roasted-brown);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
            text-decoration: none;
        }

        .btn-secondary-custom {
            background: var(--bg-cream);
            color: var(--text-secondary);
            border: 1px solid rgba(74, 44, 17, 0.08);
        }

        .btn-secondary-custom:hover {
            background: #e8e0d8;
            color: var(--dark-coffee);
            transform: translateY(-2px);
            text-decoration: none;
        }

        .form-actions {
            padding-top: 20px;
            border-top: 1px solid rgba(74, 44, 17, 0.06);
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 8px;
        }

        /* ===== RESPONSIVE ===== */
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

            .card-body-custom {
                padding: 20px 18px;
            }
        }

        @media (max-width: 575.98px) {
            .main-content {
                padding: 14px 10px 20px;
            }

            .card-body-custom {
                padding: 16px 12px;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .form-actions .btn-custom {
                width: 100%;
                justify-content: center;
            }

            .card-header-custom {
                padding: 14px 16px;
                font-size: 0.9rem;
                flex-wrap: wrap;
            }

            .card-header-custom .badge-required {
                font-size: 0.6rem;
                padding: 2px 10px;
            }
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
            <span>PETANI <br><small style="font-weight:400; font-size:0.7rem; color:#A8988A;">Liberchain</small></span>
        </div>

        <div class="sidebar-menu-wrapper">
            <ul class="sidebar-menu">
                <li class="menu-item">
                    <a href="<?= base_url('petani/dashboard'); ?>">
                        <i class="bi bi-grid-1x2-fill"></i> Dashboard
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('petani/lahan'); ?>">
                        <i class="bi bi-geo-alt-fill"></i> Kelola Lahan
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('petani/panen'); ?>">
                        <i class="bi bi-tree-fill"></i> Manajemen Panen
                    </a>
                </li>
                <li class="menu-item active">
                    <a href="<?= base_url('petani/produk'); ?>">
                        <i class="bi bi-box-seam-fill"></i> Katalog Produk
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('petani/transaksi'); ?>">
                        <i class="bi bi-cart-check-fill"></i> Pesanan Masuk
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('petani/tracking'); ?>">
                        <i class="bi bi-truck"></i> Tracking Kiriman
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
                <button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle"
                    style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
                    <i class="bi bi-list"></i>
                </button>
                <h2 class="d-inline-block align-middle mb-0">
                    <i class="bi bi-plus-circle-fill" style="color: var(--amber-cream);"></i> Tambah Produk Baru
                </h2>
                <p class="subtitle mb-0 mt-1">
                    Lengkapi spesifikasi produk kopi untuk ditambahkan ke katalog
                </p>
            </div>
            <div class="d-flex align-items-center gap-3" style="gap: 12px;">
                <!-- NOTIFICATION -->
                <div style="position: relative;">
                    <button class="notif-btn" id="notifToggle">
                        <i class="bi bi-bell" style="font-size: 1.2rem;"></i>
                        <span class="notif-dot">3</span>
                    </button>
                </div>

                <!-- USER AVATAR -->
                <div class="d-flex align-items-center gap-2"
                    style="cursor: pointer; padding: 6px 12px; border-radius: 10px; background: var(--card-white); border: 1px solid rgba(74,44,17,0.06);">
                    <i class="bi bi-person-circle" style="font-size: 1.5rem; color: var(--amber-cream);"></i>
                    <span style="font-weight:500; font-size:0.85rem;">Petani</span>
                </div>
            </div>
        </div>

        <!-- FORM CARD -->
        <div class="custom-card">
            <div class="card-header-custom">
                <i class="bi bi-box-seam-fill"></i>
                Formulir Produk Kopi
                <span class="badge-required">
                    <i class="bi bi-asterisk text-danger" style="font-size:0.5rem;"></i> Wajib diisi
                </span>
            </div>

            <div class="card-body-custom">
                <form action="<?= base_url('petani/produk/simpan'); ?>" method="post" enctype="multipart/form-data">

                    <div class="row">
                        <!-- KOLOM KIRI -->
                        <div class="col-lg-6">
                            <!-- NAMA PRODUK - DROPDOWN -->
                            <div class="form-group">
                                <label>Nama Produk <span class="required">*</span></label>
                                <select name="nama_produk" id="nama_produk" class="form-control" required>
                                    <option value="">-- Pilih Nama Produk --</option>
                                    <option value="Ceri">Ceri</option>
                                    <option value="Biji Kopi">Biji Kopi</option>
                                    <option value="Kopi Bubuk">Kopi Bubuk</option>
                                </select>
                            </div>

                            <!-- JENIS KOPI -->
                            <div class="form-group">
                                <label>Jenis Kopi <span class="required">*</span></label>
                                <select name="jenis_kopi" id="jenis_kopi" class="form-control" required>
                                    <option value="Liberica">Liberica</option>
                                </select>
                            </div>

                            <!-- PROSES PENGOLAHAN -->
                            <div class="form-group">
                                <label>Proses Pengolahan</label>
                                <input type="text" name="proses" id="proses" class="form-control" placeholder="Otomatis terisi berdasarkan Nama Produk" readonly>
                            </div>

                            <!-- HARGA - Auto fill dari Admin -->
                            <div class="form-group">
                                <label>Harga (Rp) / Kg</label>
                                <input type="number" name="harga" id="harga" class="form-control" placeholder="Otomatis terisi" readonly>
                                <small class="text-muted" style="display:block; margin-top:3px; color:var(--text-secondary);">Harga ditentukan oleh Admin</small>
                            </div>

                            <!-- STOK - Input Petani -->
                            <div class="form-group">
                                <label>Stok Ketersediaan (Kg) <span class="required">*</span></label>
                                <input type="number" name="stok_produk" id="stok" class="form-control"
                                    placeholder="Contoh: 50" required>
                            </div>

                            <!-- TOTAL - Otomatis -->
                            <div class="form-group">
                                <label>Total Pendapatan (Rp)</label>
                                <input type="text" name="total" id="total" class="form-control" style="font-weight:700; color:var(--roasted-brown);" readonly>
                                <small class="text-muted" style="display:block; margin-top:3px; color:var(--text-secondary);">Harga × Stok = Total Pendapatan</small>
                            </div>
                        </div>

                        <!-- KOLOM KANAN -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Altitude (Ketinggian Tanam)</label>
                                <input type="text" name="altitude" class="form-control"
                                    placeholder="Contoh: 900 Meter">
                            </div>

                            <div class="form-group">
                                <label>Status Produk <span class="required">*</span></label>
                                <select name="status_produk" class="form-control">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Nonaktif">Nonaktif</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Foto Produk</label>
                                <div class="file-upload-wrapper">
                                    <input type="file" name="foto_utama" accept=".jpg,.jpeg,.png">
                                    <span class="file-helper">
                                        <i class="bi bi-info-circle"></i> Format: JPG, PNG. Maks 2MB
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FORM ACTIONS -->
                    <div class="form-actions">
                        <a href="<?= base_url('petani/produk'); ?>" class="btn btn-secondary-custom btn-custom">
                            <i class="bi bi-arrow-left"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary-custom btn-custom">
                            <i class="bi bi-save"></i> Simpan Produk
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        // ============================================
        // AUTO SET JENIS KOPI = LIBERICA & PROSES & HARGA & TOTAL
        // ============================================
        document.addEventListener('DOMContentLoaded', function() {
            const namaProduk = document.getElementById('nama_produk');
            const jenisKopi = document.getElementById('jenis_kopi');
            const proses = document.getElementById('proses');
            const harga = document.getElementById('harga');
            const stok = document.getElementById('stok');
            const total = document.getElementById('total');

            // Daftar harga dari Admin
            const hargaProduk = {
                'Ceri': 7000,
                'Biji Kopi': 70000,
                'Kopi Bubuk': 120000
            };

            // Fungsi hitung total
            function hitungTotal() {
                const hargaVal = parseFloat(harga.value) || 0;
                const stokVal = parseFloat(stok.value) || 0;
                const totalVal = hargaVal * stokVal;
                
                if (total && totalVal > 0) {
                    total.value = 'Rp ' + totalVal.toLocaleString('id-ID');
                } else {
                    total.value = 'Rp 0';
                }
            }

            if (namaProduk && jenisKopi) {
                namaProduk.addEventListener('change', function() {
                    const value = this.value;
                    
                    // Set Jenis Kopi ke Liberica
                    if (value !== '') {
                        jenisKopi.value = 'Liberica';
                    } else {
                        jenisKopi.value = '';
                    }

                    // Set Proses Pengolahan
                    if (proses) {
                        switch(value) {
                            case 'Ceri':
                                proses.value = 'Tanpa Proses';
                                break;
                            case 'Biji Kopi':
                                proses.value = 'Pencucian, Pengupasan, Penjemuran';
                                break;
                            case 'Kopi Bubuk':
                                proses.value = 'Pencucian, Pengupasan, Penjemuran, Penggilingan, Pengemasan';
                                break;
                            default:
                                proses.value = '';
                        }
                    }

                    // Set Harga
                    if (harga) {
                        if (value && hargaProduk[value]) {
                            harga.value = hargaProduk[value];
                        } else {
                            harga.value = '';
                        }
                    }

                    // Hitung total
                    hitungTotal();
                });
            }

            // Auto-calculate Total saat Stok berubah
            if (stok) {
                stok.addEventListener('input', function() {
                    hitungTotal();
                });
            }
        });

        console.log('✅ Form Tambah Produk Petani siap digunakan!');
        console.log('📋 Fitur yang tersedia:');
        console.log('   - Nama Produk (dropdown: Ceri, Biji Kopi, Kopi Bubuk)');
        console.log('   - Jenis Kopi (wajib)');
        console.log('   - Proses Pengolahan (auto-fill)');
        console.log('   - Harga (auto-fill dari Admin)');
        console.log('   - Stok (wajib)');
        console.log('   - Total (auto-calculate: Harga × Stok)');
        console.log('   - Status (wajib)');
        console.log('   - Foto (opsional)');
    </script>
</body>

</html>