<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'POKTAN - Liberchain'; ?></title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
    /* --- ROOT STYLE & LAYOUT --- */
    body {
        font-family: 'Nunito', sans-serif;
        background-color: #f6f9ff;
        margin: 0;
        padding: 0;
    }

    /* --- SIDEBAR UTAMA (Cokelat Gelap) --- */
    .sidebar {
        width: 280px;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #2b1b0c;
        /* Warna cokelat gelap sesuai gambar */
        color: #d9c3b0;
        display: flex;
        flex-direction: column;
        z-index: 1000;
        border-right: 1px solid #3d2a19;
    }

    /* --- BRAND HEADER SIDEBAR --- */
    .sidebar-brand {
        padding: 24px 20px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .brand-icon {
        background-color: #4a341e;
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #e6a753;
        font-size: 22px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .brand-text h4 {
        color: #f7e6d5;
        font-size: 18px;
        font-weight: 700;
        margin: 0;
        letter-spacing: 1px;
    }

    .brand-text p {
        color: #8c735c;
        font-size: 12px;
        margin: 0;
    }

    /* --- FITUR GULIRKAN (Scrollable Menu Area) --- */
    .sidebar-menu-wrapper {
        flex: 1;
        overflow-y: auto;
        /* Membuat menu bisa digulirkan jika penuh */
        padding-left: 15px;
        /* Memberi ruang untuk efek lengkungan active */
        padding-right: 10px;
    }

    /* Kustomisasi Scrollbar agar terlihat rapi dan tipis */
    .sidebar-menu-wrapper::-webkit-scrollbar {
        width: 5px;
    }

    .sidebar-menu-wrapper::-webkit-scrollbar-thumb {
        background-color: #4a341e;
        border-radius: 10px;
    }

    /* --- LIST MENU NAVIGASI --- */
    .sidebar-nav {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-nav .nav-item {
        margin-bottom: 8px;
        position: relative;
    }

    .sidebar-nav .nav-link {
        display: flex;
        align-items: center;
        padding: 14px 20px;
        color: #a68c74;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        border-radius: 16px 0 0 16px;
        /* Sisi kiri melengkung */
        transition: all 0.3s ease;
        gap: 15px;
    }

    .sidebar-nav .nav-link i {
        font-size: 20px;
        transition: all 0.3s ease;
    }

    /* Efek Hover Menu */
    .sidebar-nav .nav-link:hover {
        color: #f7e6d5;
        background-color: rgba(255, 255, 255, 0.03);
    }

    /* --- MENU AKTIF (Efek Lengkung Menjorok ke Luar) --- */
    .sidebar-nav .nav-item.active .nav-link {
        background-color: #5c3c1e;
        /* Warna cokelat highlight menu aktif */
        color: #ffffff;
        font-weight: 700;
    }

    /* Pembatas indikator garis tegak vertikal di ujung kiri jika diperlukan */
    .sidebar-nav .nav-item.active::before {
        content: '';
        position: absolute;
        left: -15px;
        top: 15%;
        height: 70%;
        width: 5px;
        background-color: #e6a753;
        border-radius: 0 4px 4px 0;
    }

    /* --- BADGE ANGKA NOTIFIKASI --- */
    .badge-count {
        background-color: #442d17;
        color: #e6a753;
        font-size: 12px;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 10px;
        margin-left: auto;
    }

    /* --- TOMBOL KELUAR / LOGOUT (Paling Bawah) --- */
    .sidebar-footer {
        padding: 20px;
        border-top: 1px solid #3d2a19;
    }

    .btn-logout {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.2);
        border: 1px solid #4a341e;
        color: #a68c74;
        padding: 12px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-logout:hover {
        background-color: #6b211a;
        color: #fff;
        border-color: #8c2a20;
        text-decoration: none;
    }

    /* --- AREA KONTEN UTAMA (Disebelah Sidebar) --- */
    .content-wrapper {
        margin-left: 280px;
        /* Lebar sama dengan sidebar */
        padding: 30px;
        min-height: 100vh;
    }
    </style>
</head>

<body>

    <div class="sidebar">

        <div class="sidebar-brand">
            <div class="brand-icon">
                <i class="bi bi-patch-check-fill"></i>
            </div>
            <div class="brand-text">
                <h4>POKTAN</h4>
                <p>Liberchain</p>
            </div>
        </div>

        <div class="sidebar-menu-wrapper">
            <ul class="sidebar-nav">

                <li
                    class="nav-item <?= ($this->uri->segment(2) == 'dashboard' || $this->uri->segment(1) == 'dashboard') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/dashboard') ?>" class="nav-link">
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-people-fill"></i>
                        <span>Manajemen User</span>
                        <span class="badge-count">12</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-person-vcard-fill"></i>
                        <span>Data Petani</span>
                    </a>
                </li>

                <li class="nav-item <?= ($this->uri->segment(2) == 'lahan') ? 'active' : '' ?>">
                    <a href="<?= base_url($this->session->userdata('role') == 'Admin' ? 'admin/lahan' : 'petani/lahan') ?>"
                        class="nav-link">
                        <i class="bi bi-map-fill"></i>
                        <span>Manajemen Lahan</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-tree-fill"></i>
                        <span>Manajemen Panen</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-box-seam-fill"></i>
                        <span>Manajemen Produk</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-wallet2"></i>
                        <span>Transaksi</span>
                        <span class="badge-count">8</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-truck"></i>
                        <span>Manajemen Kurir</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-shop"></i>
                        <span>Manajemen Mitra</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-bar-chart-line-fill"></i>
                        <span>Laporan & Analytics</span>
                    </a>
                </li>

            </ul>
        </div>

        <div class="sidebar-footer">
            <a href="<?= base_url('auth/logout') ?>" class="btn-logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Keluar</span>
            </a>
        </div>

    </div>

    <div class="content-wrapper">