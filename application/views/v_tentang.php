<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Liberchain</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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

        /* --- HERO SECTION --- */
        .hero-section {
            padding: 160px 0 100px;
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
            color: rgba(255,255,255,0.7);
            padding: 60px 0 30px;
            border-top: 1px solid rgba(255,255,255,0.05);
        }
        .footer-brand { color: white; font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.5rem; margin-bottom: 20px; }
        .footer-desc { font-size: 0.9rem; line-height: 1.6; margin-bottom: 20px; }
        .footer-title { color: white; font-weight: 600; margin-bottom: 20px; font-size: 1.1rem; }
        .footer-links { list-style: none; padding: 0; margin: 0; }
        .footer-links li { margin-bottom: 12px; }
        .footer-links a { color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.9rem; }
        .footer-links a:hover { color: white; padding-left: 5px; }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,0.1); margin-top: 50px; padding-top: 25px; text-align: center; font-size: 0.85rem; }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top">
        <div class="container d-flex align-items-center">
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
            <div class="ml-auto d-flex align-items-center" style="gap: 16px;">
                <a href="<?= base_url('transaksi/keranjang'); ?>" class="nav-btn" style="background: transparent; border-color: var(--roasted-brown); color: var(--roasted-brown); position: relative;">
                    <i class="bi bi-cart"></i> Keranjang
                    <span class="cart-badge" id="cart_count" style="background: #EF4444; color: white; border-radius: 50%; padding: 2px 8px; font-size: 0.7rem; margin-left: 4px;">0</span>
                </a>
                <a href="<?= base_url('auth/login'); ?>" class="nav-btn">Masuk</a>
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
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="footer-brand"><i class="bi bi-patch-check-fill text-warning"></i> Liberchain</div>
                    <p class="footer-desc">Platform ekosistem rantai pasok kopi terintegrasi yang memberdayakan petani lokal melalui transparansi dan teknologi.</p>
                </div>
                <div class="col-lg-2 col-md-4 mb-4 mb-md-0 offset-lg-2">
                    <h5 class="footer-title">Navigasi</h5>
                    <ul class="footer-links">
                        <li><a href="<?= base_url(); ?>">Beranda</a></li>
                        <li><a href="<?= base_url('produk'); ?>">Produk</a></li>
                        <li><a href="<?= base_url('landing/mitra'); ?>">Mitra</a></li>
                        <li><a href="<?= base_url('tentang'); ?>">Tentang Kami</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-8">
                    <h5 class="footer-title">Kontak Kami</h5>
                    <ul class="footer-links">
                        <li class="d-flex align-items-start gap-2 mb-3">
                            <i class="bi bi-geo-alt mt-1"></i> 
                            <span>Jl. Kopi Arabika No. 12, Dataran Tinggi Gayo, Aceh, Indonesia</span>
                        </li>
                        <li class="d-flex align-items-center gap-2 mb-3">
                            <i class="bi bi-envelope"></i> hello@liberchain.id
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <i class="bi bi-telephone"></i> +62 811 2233 4455
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                &copy; <?= date('Y'); ?> POKTAN Liberchain. All Rights Reserved.
            </div>
        </div>
    </footer>

</body>
</html>
