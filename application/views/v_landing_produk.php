<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Kopi - Liberchain</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- PWA Meta Tags -->
    <meta name="application-name" content="LiberChain">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="LiberChain">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#4A2C11">
    <meta name="msapplication-TileColor" content="#FAF6F0">
    <meta name="msapplication-TileImage" content="<?= base_url('assets/images/pwa/icon-192x192.png') ?>">
    <link rel="manifest" href="<?= base_url('pwa/manifest') ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url('assets/images/pwa/icon-192x192.png') ?>">
    <link rel="icon" type="image/png" sizes="512x512" href="<?= base_url('assets/images/pwa/icon-512x512.png') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/images/pwa/apple-touch-icon.png') ?>">
    <link rel="apple-touch-icon" sizes="192x192" href="<?= base_url('assets/images/pwa/icon-192x192.png') ?>">
    
    <style>
        :root {
            --roasted-brown: #6F4E37;
            --dark-coffee: #3B2A1E;
            --amber-cream: #8B5E3C;
            --forest-green: #2D6A4F;
            --bg-cream: #F5F1EA;
            --card-white: #FFFFFF;
            --text-secondary: #7A6A5C;
            --shadow-soft: 0 10px 40px rgba(111,78,55,0.10);
            --shadow-hover: 0 20px 50px rgba(59,42,30,0.18);
            --radius-card: 16px;
            --transition-smooth: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-cream);
            color: var(--dark-coffee);
        }
        .navbar-custom {
            background: rgba(245, 241, 234, 0.92);
            backdrop-filter: blur(10px);
            padding: 15px 0;
            border-bottom: 1px solid rgba(111, 78, 55, 0.07);
        }
        .navbar-brand {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--dark-coffee) !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--roasted-brown), var(--amber-cream));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }
        .nav-links { display: flex; align-items: center; gap: 28px; margin-left: auto; margin-right: 28px; }
        .nav-links a { color: var(--text-secondary); font-weight: 600; font-size: 0.9rem; text-decoration: none; transition: var(--transition-smooth); }
        .nav-links a:hover { color: var(--roasted-brown); text-decoration: none; }
        .nav-links a.active { color: var(--roasted-brown); font-weight: 800; }
        .nav-btn {
            background: var(--dark-coffee);
            color: white;
            padding: 9px 26px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.88rem;
            transition: var(--transition-smooth);
            border: 2px solid var(--dark-coffee);
            text-decoration: none;
        }
        .nav-btn:hover {
            background: var(--forest-green);
            border-color: var(--forest-green);
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
        }
        .product-section {
            padding: 130px 0 80px;
        }
        .product-card {
            background: var(--card-white);
            border-radius: var(--radius-card);
            padding: 20px;
            box-shadow: var(--shadow-soft);
            transition: var(--transition-smooth);
            height: 100%;
            border: 1px solid rgba(111, 78, 55, 0.06);
            display: flex;
            flex-direction: column;
        }
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
        }
        .product-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 12px;
            background: var(--bg-cream);
        }
        .product-name {
            font-weight: 700;
            font-size: 1.1rem;
            margin-top: 14px;
            margin-bottom: 4px;
        }
        .product-price {
            font-weight: 700;
            color: var(--roasted-brown);
            font-size: 1.2rem;
        }
        .product-stock {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }
        .btn-beli {
            background: var(--roasted-brown);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 8px 20px;
            font-weight: 700;
            font-size: 0.85rem;
            transition: var(--transition-smooth);
            cursor: pointer;
            width: 100%;
            margin-top: 12px;
        }
        .btn-beli:hover {
            background: var(--forest-green);
            color: white;
            transform: translateY(-2px);
        }
        .btn-beli i {
            margin-right: 6px;
        }
        .footer {
            background: var(--dark-coffee);
            color: rgba(255,255,255,0.7);
            padding: 32px 0;
            text-align: center;
            font-size: 0.85rem;
        }
        .cart-badge {
            background: #EF4444;
            color: white;
            border-radius: 50%;
            padding: 2px 8px;
            font-size: 0.7rem;
            margin-left: 4px;
        }
        
        /* Mobile offcanvas menu */
        .navbar-toggler {
            border: none;
            padding: 8px 10px;
            font-size: 1.5rem;
            color: var(--dark-coffee);
            background: transparent;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            outline: none !important;
            box-shadow: none !important;
        }
        .navbar-toggler:focus { outline: none; }
        .mobile-menu-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.4);
            z-index: 999;
        }
        .mobile-menu-overlay.active { display: block; }
        .mobile-menu {
            position: fixed;
            top: 0; left: -300px;
            width: 280px;
            height: 100vh;
            background: var(--card-white);
            z-index: 1001;
            transition: all 0.3s ease;
            padding: 20px;
            box-shadow: 4px 0 20px rgba(0,0,0,0.1);
            overflow-y: auto;
        }
        .mobile-menu.open { left: 0; }
        .mobile-menu-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid rgba(111,78,55,0.08);
        }
        .mobile-menu-header .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 800;
            font-size: 1.2rem;
            color: var(--dark-coffee);
        }
        .mobile-menu-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text-secondary);
            cursor: pointer;
        }
        .mobile-menu-links { list-style: none; padding: 0; margin: 0; }
        .mobile-menu-links li { margin-bottom: 4px; }
        .mobile-menu-links a {
            display: block;
            padding: 12px 16px;
            border-radius: 10px;
            color: var(--dark-coffee);
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            transition: var(--transition-smooth);
        }
        .mobile-menu-links a:hover,
        .mobile-menu-links a.active {
            background: rgba(230,161,92,0.1);
            color: var(--roasted-brown);
        }
        .mobile-menu-actions {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(111,78,55,0.08);
        }
        .mobile-menu-actions .btn {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<!-- Mobile Menu Overlay -->
<div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>

<!-- Mobile Offcanvas Menu -->
<div class="mobile-menu" id="mobileMenu">
    <div class="mobile-menu-header">
        <div class="brand">
            <div class="brand-icon"><i class="bi bi-patch-check-fill"></i></div>
            Liberchain
        </div>
        <button class="mobile-menu-close" id="mobileMenuClose"><i class="bi bi-x-lg"></i></button>
    </div>
    <ul class="mobile-menu-links">
        <li><a href="<?= base_url(); ?>"><i class="bi bi-house-door mr-2"></i>Beranda</a></li>
        <li><a href="<?= base_url('produk'); ?>" class="active"><i class="bi bi-box-seam mr-2"></i>Produk</a></li>
        <li><a href="<?= base_url('landing/mitra'); ?>"><i class="bi bi-shop mr-2"></i>Mitra</a></li>
        <li><a href="<?= base_url('tentang'); ?>"><i class="bi bi-info-circle mr-2"></i>Tentang Kami</a></li>
    </ul>
    <div class="mobile-menu-actions">
        <a href="<?= base_url('transaksi/keranjang'); ?>" class="btn btn-outline-dark">
            <i class="bi bi-cart mr-2"></i>Keranjang
        </a>
        <a href="<?= base_url('auth/login'); ?>" class="btn" style="background: var(--dark-coffee); color: white;">
            <i class="bi bi-box-arrow-in-right mr-2"></i>Masuk
        </a>
    </div>
</div>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top">
    <div class="container d-flex align-items-center">
        <button class="navbar-toggler d-lg-none" id="navbarToggler" type="button" aria-label="Toggle navigation">
            <i class="bi bi-list"></i>
        </button>
        <a class="navbar-brand" href="<?= base_url(); ?>">
            <div class="brand-icon"><i class="bi bi-patch-check-fill"></i></div>
            Liberchain
        </a>
        <div class="nav-links d-none d-lg-flex">
            <a href="<?= base_url(); ?>">Beranda</a>
            <a href="<?= base_url('produk'); ?>" class="active">Produk</a>
            <a href="<?= base_url('landing/mitra'); ?>">Mitra</a>
            <a href="<?= base_url('tentang'); ?>">Tentang Kami</a>
        </div>
        <div class="ml-auto d-flex align-items-center" style="gap: 8px;">
            <a href="<?= base_url('transaksi/keranjang'); ?>" class="nav-btn d-none d-sm-inline-block" style="background: transparent; border-color: var(--roasted-brown); color: var(--roasted-brown); position: relative; padding: 8px 18px;">
                <i class="bi bi-cart"></i> <span class="d-none d-md-inline">Keranjang</span>
                <span class="cart-badge" id="cart_count">0</span>
            </a>
            <a href="<?= base_url('auth/login'); ?>" class="nav-btn" style="padding: 8px 18px; font-size:0.85rem;">Masuk</a>
        </div>
    </div>
</nav>

<!-- PRODUCT SECTION -->
<section class="product-section">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="font-weight-bold">☕ Produk Kopi</h1>
            <p class="text-muted">Pilih produk kopi terbaik dari petani kami</p>
        </div>

        <div class="row">
            <?php if (!empty($produk)): ?>
               <?php foreach ($produk as $p): ?>
<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
    <div class="product-card">

        <img src="<?= base_url('uploads/produk/' . (!empty($p->foto_utama) ? $p->foto_utama : 'default.jpg')); ?>"
             alt="<?= $p->nama_produk; ?>"
             class="product-image">

        <h5 class="product-name"><?= $p->nama_produk; ?></h5>

        <div class="product-price">
            Rp <?= number_format($p->harga, 0, ',', '.'); ?> /kg
        </div>

        <div class="product-stock">
            Stok: <?= $p->stok_produk; ?> kg
        </div>

        <button class="btn-beli" onclick="tambahKeranjang(<?= $p->id_produk; ?>)">
            <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
        </button>

    </div>
</div>
<?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="bi bi-box-seam" style="font-size: 3rem; opacity: 0.3;"></i>
                    <h4 class="mt-3">Belum ada produk</h4>
                    <p class="text-muted">Produk akan muncul di sini setelah petani menambahkan.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <p class="mb-0">&copy; <?= date('Y'); ?> POKTAN Liberchain. All rights reserved.</p>
    </div>
</footer>

<!-- ============================================ -->
<!-- SCRIPT JQUERY + AJAX UNTUK TOMBOL BELI      -->
<!-- ============================================ -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- PWA Service Worker Registration -->
<script>
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('<?= base_url('pwa/service_worker') ?>')
            .then(function(registration) {
                console.log('[LiberChain PWA] ServiceWorker registered:', registration.scope);
            })
            .catch(function(error) {
                console.warn('[LiberChain PWA] ServiceWorker registration failed:', error);
            });
    });
}
</script>

<script>
function tambahKeranjang(id_produk) {
    $.ajax({
        url: '<?= base_url("transaksi/tambah_keranjang"); ?>',
        type: 'POST',
        data: { id_produk: id_produk, jumlah: 1 },
        dataType: 'json',
        success: function(response) {
            if (response.status == 'success') {
                $('#cart_count').text(response.total_item);
                alert('✅ Produk ditambahkan ke keranjang!');
            } else {
                alert('❌ ' + response.message);
            }
        },
        error: function() {
            alert('❌ Gagal menambahkan produk');
        }
    });
}

// Update cart count saat halaman dimuat
$(document).ready(function() {
    $.ajax({
        url: '<?= base_url("transaksi/cart_count"); ?>',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#cart_count').text(data.total || 0);
        }
    });
});

// Mobile Menu Toggle
document.addEventListener('DOMContentLoaded', function() {
    const toggler = document.getElementById('navbarToggler');
    const mobileMenu = document.getElementById('mobileMenu');
    const overlay = document.getElementById('mobileMenuOverlay');
    const closeBtn = document.getElementById('mobileMenuClose');
    
    function openMenu() {
        mobileMenu.classList.add('open');
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    function closeMenu() {
        mobileMenu.classList.remove('open');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }
    
    if (toggler) toggler.addEventListener('click', openMenu);
    if (closeBtn) closeBtn.addEventListener('click', closeMenu);
    if (overlay) overlay.addEventListener('click', closeMenu);
});
</script>

</body>
</html>