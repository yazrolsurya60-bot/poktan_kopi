<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - Sistem Supply Chain Kopi</title>
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
            -ms-overflow-style: none;  /* Sembunyikan untuk Internet Explorer dan Edge */
            scrollbar-width: none;  /* Sembunyikan untuk Firefox */
        }

        /* Sembunyikan scrollbar untuk Chrome, Safari, dan Opera */
        .sidebar-menu-wrapper::-webkit-scrollbar {
            display: none;
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

        /* --- MAIN CONTENT & CONTAINERS --- */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 30px 40px 40px;
            min-height: 100vh;
            transition: var(--transition-smooth);
        }

        .card-custom {
            background: var(--card-white);
            border: 1px solid rgba(74, 44, 17, 0.06);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-soft);
            padding: 30px;
            margin-bottom: 30px;
        }

        .detail-label {
            font-size: 13px;
            color: var(--text-secondary);
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .detail-value {
            font-size: 16px;
            font-weight: 700;
            color: var(--dark-coffee);
            margin-bottom: 20px;
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
        <a href="<?= base_url('petani/dashboard'); ?>">
            <i class="bi bi-grid-1x2-fill"></i>Dashboard
        </a>
    </li>

    <li class="menu-item">
        <a href="<?= base_url('petani/lahan'); ?>">
            <i class="bi bi-geo-alt-fill"></i>Kelola Lahan
            <span class="menu-badge">3</span>
        </a>
    </li>

    <li class="menu-item">
        <a href="<?= base_url('petani/panen'); ?>">
            <i class="bi bi-tree-fill"></i>Manajemen Panen
        </a>
    </li>

    <li class="menu-item active">
        <a href="<?= base_url('petani/produk'); ?>">
            <i class="bi bi-box-seam-fill"></i>Katalog Produk
            <span class="menu-badge">5</span>
        </a>
    </li>

    <li class="menu-item">
        <a href="<?= base_url('petani/transaksi'); ?>">
            <i class="bi bi-cart-fill"></i>Pesanan Masuk
            <span class="menu-badge">8</span>
        </a>
    </li>

    <li class="menu-item">
        <a href="<?= base_url('petani/tracking'); ?>">
            <i class="bi bi-truck"></i>Tracking Kiriman
        </a>
    </li>

    <li class="menu-item">
        <a href="<?= base_url('petani/laporan'); ?>">
            <i class="bi bi-bar-chart-fill"></i>Laporan
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

    <!-- MAIN CONTENT CONTAINER -->
    <div class="main-content">
        <div class="mb-4">
            <button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle" style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
                <i class="bi bi-list"></i>
            </button>
            <h2 class="d-inline-block align-middle mb-0" style="font-weight: 700; font-size: 28px; color: var(--dark-coffee); margin-bottom: 5px;">Detail Spesifikasi Produk</h2>
            <p style="color: var(--text-secondary); margin: 0;">Melihat data teknis komoditas kopi secara lengkap</p>
        </div>

        <!-- ISI KONTEN ASLI MILIK KAMU (TANPA DIUBAH) -->
        <div class="card-custom">
            <div class="row">
                <div class="col-md-6">
                    <div class="detail-label">Nama Produk</div>
                    <div class="detail-value"><?= $produk->nama_produk; ?></div>

                    <div class="detail-label">Jenis Kopi</div>
                    <div class="detail-value"><span class="badge bg-light text-dark border px-3 py-2"><?= $produk->jenis_kopi; ?></span></div>

                    <div class="detail-label">Grade Kopi</div>
                    <div class="detail-value"><?= $produk->grade; ?></div>

                    <div class="detail-label">Harga per Kilogram</div>
                    <div class="detail-value" style="color: var(--roasted-brown); font-size: 20px;">Rp <?= number_format($produk->harga, 0, ',', '.'); ?></div>

                    <div class="detail-label">Stok Tersedia</div>
                    <div class="detail-value"><?= $produk->stok_produk; ?> Pcs</div>
                </div>

                <div class="col-md-6">
                    <div class="detail-label">Altitude (Ketinggian Tanam)</div>
                    <div class="detail-value"><?= !empty($produk->altitude) ? $produk->altitude : '-'; ?></div>

                    <div class="detail-label">Proses Pengolahan</div>
                    <div class="detail-value"><?= !empty($produk->proses) ? $produk->proses : '-'; ?></div>

                    <div class="detail-label">Flavor Notes (Catatan Rasa)</div>
                    <div class="detail-value" style="font-style: italic; font-weight: 500;"><?= !empty($produk->flavor_notes) ? $produk->flavor_notes : '-'; ?></div>

                    <div class="detail-label">Status Penjualan</div>
                    <div class="detail-value">
                        <span class="badge <?= strtolower($produk->status_produk) == 'aktif' ? 'badge-success' : 'badge-danger'; ?> px-3 py-2">
                            <?= $produk->status_produk; ?>
                        </span>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <div class="detail-label">Deskripsi Produk</div>
                    <div class="p-3 bg-light rounded" style="font-size: 15px; color: #555; line-height: 1.6; border: 1px solid #E2DCD5;">
                        <?= !empty($produk->deskripsi) ? nl2br($produk->deskripsi) : 'Tidak ada deskripsi.'; ?>
                    </div>
                </div>
            </div>

            <div class="text-right mt-4 border-top pt-3">
                <a href="<?= base_url('petani/produk'); ?>" class="btn btn-secondary px-4" style="border-radius: 8px;">
                    <i class="bi bi-arrow-left mr-1"></i> Kembali ke List
                </a>
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
    </script>
</body>

</html>