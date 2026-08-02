<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Liberchain</title>
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
            --dark-coffee:   #3B2A1E;
            --amber-cream:   #8B5E3C;
            --forest-green:  #2D6A4F;
            --bg-cream:      #F5F1EA;
            --card-white:    #FFFFFF;
            --text-secondary:#7A6A5C;
            --shadow-soft:   0 10px 40px rgba(111,78,55,0.06);
            --shadow-hover:  0 20px 50px rgba(59,42,30,0.12);
            --radius-card:   20px;
            --transition-smooth: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-cream);
            color: var(--dark-coffee);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5, h6 { font-family: 'Outfit', sans-serif; }
        a { transition: var(--transition-smooth); }

        /* --- NAVBAR --- */
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

        /* --- HERO SECTION --- */
        .hero-section {
            padding: 120px 0 80px;
            position: relative;
            text-align: center;
            background: radial-gradient(circle at top right, rgba(111,78,55,0.05), transparent 40%),
                        radial-gradient(circle at bottom left, rgba(45,106,79,0.05), transparent 40%);
        }
        
        .hero-badge {
            display: inline-block;
            background: rgba(111,78,55,0.08);
            color: var(--roasted-brown);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--dark-coffee);
            margin-bottom: 20px;
            letter-spacing: -1px;
        }
        .hero-title span { color: var(--roasted-brown); }

        .hero-subtitle {
            font-size: 1.15rem;
            color: var(--text-secondary);
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.7;
        }

        /* --- MOBILE RESPONSIVE --- */
        @media (max-width: 768px) {
            .hero-section {
                padding: 100px 0 60px;
            }
            .hero-title {
                font-size: 2.2rem;
                letter-spacing: -0.5px;
            }
            .hero-subtitle {
                font-size: 1rem;
                max-width: 100%;
                padding: 0 15px;
            }
            .story-content {
                padding: 30px 20px;
            }
            .story-title {
                font-size: 1.5rem;
            }
            .story-text {
                font-size: 0.95rem;
            }
            .value-card {
                padding: 30px 20px;
            }
            .value-title {
                font-size: 1.1rem;
            }
            .footer {
                padding: 40px 0 20px;
            }
            .footer-brand {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 576px) {
            .hero-section {
                padding: 80px 0 50px;
            }
            .hero-title {
                font-size: 1.8rem;
            }
            .hero-badge {
                font-size: 0.75rem;
                padding: 5px 12px;
            }
            .section-header h2 {
                font-size: 1.5rem;
            }
        }

        /* --- STORY SECTION --- */
        .story-section { padding: 80px 0; }
        .story-content {
            background: var(--card-white);
            border-radius: var(--radius-card);
            padding: 50px;
            box-shadow: var(--shadow-soft);
            border: 1px solid rgba(111,78,55,0.05);
        }
        .story-title {
            font-weight: 700;
            margin-bottom: 25px;
            font-size: 2rem;
            color: var(--dark-coffee);
        }
        .story-text {
            color: var(--text-secondary);
            font-size: 1.05rem;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        /* --- VALUES SECTION --- */
        .values-section { padding: 60px 0 100px; }
        .section-header { text-align: center; margin-bottom: 50px; }
        .value-card {
            background: transparent;
            padding: 40px 30px;
            border-radius: var(--radius-card);
            text-align: center;
            transition: var(--transition-smooth);
            border: 1px solid rgba(111,78,55,0.08);
            height: 100%;
        }
        .value-card:hover {
            background: var(--card-white);
            box-shadow: var(--shadow-hover);
            transform: translateY(-10px);
            border-color: transparent;
        }
        .value-icon {
            width: 70px;
            height: 70px;
            background: rgba(111,78,55,0.05);
            color: var(--roasted-brown);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin: 0 auto 25px;
            transition: var(--transition-smooth);
        }
        .value-card:hover .value-icon {
            background: var(--roasted-brown);
            color: white;
            transform: scale(1.1) rotate(5deg);
        }
        .value-title {
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 15px;
            color: var(--dark-coffee);
        }
        .value-desc {
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* --- FOOTER --- */
        .footer {
            background: var(--dark-coffee);
            color: rgba(255,255,255,0.65);
            padding: 60px 0 30px;
        }
        .footer-brand {
            color: white; font-family: 'Outfit', sans-serif; font-weight: 700;
            font-size: 1.4rem; display: flex; align-items: center; gap: 10px; margin-bottom: 16px;
        }
        .footer-desc { font-size: 0.9rem; line-height: 1.7; max-width: 300px; }
        .footer-title { color: white; font-weight: 600; font-size: 1rem; margin-bottom: 20px; }
        .footer-links { list-style: none; padding: 0; margin: 0; }
        .footer-links li { margin-bottom: 12px; }
        .footer-links a { color: rgba(255,255,255,0.6); text-decoration: none; font-size: 0.9rem; transition: var(--transition-smooth); }
        .footer-links a:hover { color: white; padding-left: 5px; }
        .footer-divider { border-top: 1px solid rgba(255,255,255,0.08); margin: 40px 0 25px; }
        .footer-bottom { font-size: 0.85rem; color: rgba(255,255,255,0.4); text-align: center; }
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
            <li><a href="<?= base_url('produk'); ?>"><i class="bi bi-box-seam mr-2"></i>Produk</a></li>
            <li><a href="<?= base_url('landing/mitra'); ?>"><i class="bi bi-shop mr-2"></i>Mitra</a></li>
            <li><a href="<?= base_url('tentang'); ?>" class="active"><i class="bi bi-info-circle mr-2"></i>Tentang Kami</a></li>
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
                <a href="<?= base_url('produk'); ?>">Produk</a>
                <a href="<?= base_url('landing/mitra'); ?>">Mitra</a>
                <a href="<?= base_url('tentang'); ?>" class="active">Tentang Kami</a>
            </div>
            <div class="ml-auto d-flex align-items-center" style="gap: 8px;">
                <a href="<?= base_url('transaksi/keranjang'); ?>" class="nav-btn d-none d-sm-inline-block" style="background: transparent; border-color: var(--roasted-brown); color: var(--roasted-brown); position: relative; padding: 8px 18px;">
                    <i class="bi bi-cart"></i> <span class="d-none d-md-inline">Keranjang</span>
                    <span class="cart-badge" id="cart_count" style="background: #EF4444; color: white; border-radius: 50%; padding: 2px 8px; font-size: 0.7rem; margin-left: 4px;">0</span>
                </a>
                <a href="<?= base_url('auth/login'); ?>" class="nav-btn" style="padding: 8px 18px; font-size:0.85rem;">Masuk</a>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero-section">
        <div class="container">
            <span class="hero-badge">Tentang Liberchain</span>
            <h1 class="hero-title">Menghubungkan Petani<br>dan <span>Pecinta Kopi</span></h1>
            <p class="hero-subtitle">Kami percaya bahwa setiap cangkir kopi memiliki cerita panjang dari lahan hingga ke meja Anda. Liberchain hadir untuk memastikan cerita itu jujur, adil, dan transparan.</p>
        </div>
    </section>

    <!-- STORY SECTION -->
    <section class="story-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="story-content">
                        <div class="row align-items-center">
                            <div class="col-md-6 mb-4 mb-md-0 pr-md-5">
                                <h2 class="story-title">Misi Kami</h2>
                                <p class="story-text">Liberchain dibangun atas kesadaran bahwa rantai pasok kopi tradisional sering kali merugikan pihak yang paling berjasa: <strong>Petani Kopi</strong>.</p>
                                <p class="story-text">Melalui platform manajemen kelompok tani ini, kami menciptakan ekosistem terintegrasi (Traceability) yang memungkinkan konsumen melacak asal-usul kopi mereka secara real-time, sekaligus memastikan petani mendapatkan nilai yang layak untuk kerja keras mereka.</p>
                            </div>
                            <div class="col-md-6 text-center">
                                <!-- Ilustrasi atau Logo Besar -->
                                <div style="font-size: 8rem; color: var(--amber-cream); opacity: 0.5;">
                                    <i class="bi bi-tree"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- VALUES SECTION -->
    <section class="values-section">
        <div class="container">
            <div class="section-header">
                <h2 style="font-weight: 800; color: var(--dark-coffee);">Nilai Inti Kami</h2>
                <p style="color: var(--text-secondary); max-width: 500px; margin: 10px auto 0;">Fondasi yang menggerakkan setiap langkah Liberchain dalam memajukan industri kopi Indonesia.</p>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="value-card">
                        <div class="value-icon"><i class="bi bi-shield-check"></i></div>
                        <h4 class="value-title">Transparansi</h4>
                        <p class="value-desc">Semua proses mulai dari masa panen, pengolahan, hingga distribusi dapat dilacak secara terbuka oleh semua pihak.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="value-card">
                        <div class="value-icon"><i class="bi bi-people"></i></div>
                        <h4 class="value-title">Keadilan</h4>
                        <p class="value-desc">Menghilangkan perantara tidak efisien untuk memastikan petani mendapatkan porsi keuntungan yang paling adil.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="value-card">
                        <div class="value-icon"><i class="bi bi-globe-americas"></i></div>
                        <h4 class="value-title">Keberlanjutan</h4>
                        <p class="value-desc">Mendukung metode pertanian organik dan ramah lingkungan untuk menjaga kelestarian alam dan kualitas kopi jangka panjang.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="footer-brand">
                        <i class="bi bi-patch-check-fill" style="color: var(--amber-cream);"></i> Liberchain
                    </div>
                    <p class="footer-desc">Platform ekosistem rantai pasok kopi terintegrasi yang memberdayakan petani lokal melalui transparansi dan teknologi.</p>
                </div>
                <div class="col-lg-2 col-6 mb-4 offset-lg-2">
                    <h5 class="footer-title">Navigasi</h5>
                    <ul class="footer-links">
                        <li><a href="<?= base_url(); ?>">Beranda</a></li>
                        <li><a href="<?= base_url('produk'); ?>">Produk</a></li>
                        <li><a href="<?= base_url('landing/mitra'); ?>">Mitra</a></li>
                        <li><a href="<?= base_url('tentang'); ?>">Tentang Kami</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-12 mb-4">
                    <h5 class="footer-title">Kontak</h5>
                    <ul class="footer-links">
                        <li class="d-flex align-items-start mb-3" style="gap:8px;">
                            <i class="bi bi-geo-alt mt-1"></i>
                            <span style="word-break: break-word;">Dusun Batu Layar, Desa Sendoyan, Kecamatan Sejangkung, Kab. Sambas, Provinsi Kalbar</span>
                        </li>
                        <li class="d-flex align-items-center mb-3" style="gap:8px;">
                            <i class="bi bi-whatsapp"></i> 0815-2285-4631
                        </li>
                        <li class="d-flex align-items-center mb-3" style="gap:8px;">
                            <i class="bi bi-instagram"></i> <a href="https://www.instagram.com/poktanbatulayarsejahtera/" target="_blank"><span style="word-break: break-all;">@poktanbatulayarsejahtera</span></a>
                        </li>
                        <li class="d-flex align-items-center mb-3" style="gap:8px;">
                            <i class="bi bi-facebook"></i> <a href="https://www.facebook.com/profile.php?id=100094666534288" target="_blank">Poktan Batu Layar Sejahtera</a>
                        </li>
                        <li class="d-flex align-items-center" style="gap:8px;">
                            <i class="bi bi-youtube"></i> <a href="https://www.youtube.com/@PoktanBatuLayarSejahtera" target="_blank">Poktan Batu Layar Sejahtera</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-divider"></div>
            <div class="footer-bottom">
                &copy; <?= date('Y'); ?> POKTAN Liberchain. All Rights Reserved.
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    
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
