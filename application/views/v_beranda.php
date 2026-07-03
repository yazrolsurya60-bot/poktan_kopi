<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liberchain | Platform Rantai Pasok Kopi Terintegrasi</title>
    <meta name="description" content="Membangun masa depan kopi Indonesia yang berkelanjutan dan adil melalui traceability dan kolaborasi organik.">
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

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-cream);
            color: var(--dark-coffee);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }
        h1,h2,h3,h4,h5,h6 { font-family: 'Outfit', sans-serif; }
        a { transition: var(--transition-smooth); }

        /* --- NAVBAR --- */
        .navbar-custom {
            background: rgba(245,241,234,0.92);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 14px 0;
            border-bottom: 1px solid rgba(111,78,55,0.07);
            transition: var(--transition-smooth);
            z-index: 1000;
        }
        .navbar-custom.scrolled {
            background: rgba(245,241,234,0.98);
            box-shadow: 0 4px 30px rgba(59,42,30,0.08);
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
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--roasted-brown), var(--amber-cream));
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 1.2rem;
        }
        .nav-links { display: flex; align-items: center; gap: 28px; margin-left: auto; margin-right: 28px; }
        .nav-links a { color: var(--text-secondary); font-weight: 600; font-size: 0.9rem; text-decoration: none; transition: var(--transition-smooth); }
        .nav-links a:hover { color: var(--roasted-brown); text-decoration: none; }
        .nav-links a.active { color: var(--roasted-brown); font-weight: 800; }
        .nav-btn {
            background: var(--dark-coffee); color: white;
            padding: 9px 26px; border-radius: 50px;
            font-weight: 700; font-size: 0.88rem;
            transition: var(--transition-smooth);
            border: 2px solid var(--dark-coffee);
            text-decoration: none;
        }
        .nav-btn:hover {
            background: var(--forest-green); border-color: var(--forest-green);
            color: white; text-decoration: none; transform: translateY(-2px);
        }
        .nav-btn-outline {
            background: transparent; border: 2px solid var(--roasted-brown);
            color: var(--roasted-brown); padding: 9px 22px; border-radius: 50px;
            font-weight: 700; font-size: 0.88rem; text-decoration: none;
            transition: var(--transition-smooth); position: relative;
        }
        .nav-btn-outline:hover { background: var(--roasted-brown); color: white; text-decoration: none; }

        /* --- HERO --- */
        .hero {
            padding: 160px 0 100px;
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute; top: -200px; right: -200px;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(111,78,55,0.07) 0%, transparent 70%);
            border-radius: 50%;
        }
        .hero::after {
            content: '';
            position: absolute; bottom: -150px; left: -150px;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(45,106,79,0.06) 0%, transparent 70%);
            border-radius: 50%;
        }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(111,78,55,0.08); border: 1px solid rgba(111,78,55,0.15);
            color: var(--roasted-brown); padding: 8px 20px; border-radius: 50px;
            font-size: 0.78rem; font-weight: 700; letter-spacing: 0.5px;
            text-transform: uppercase; margin-bottom: 28px;
        }
        .hero-title {
            font-size: 3.8rem; font-weight: 800;
            color: var(--dark-coffee); line-height: 1.1;
            margin-bottom: 24px; letter-spacing: -1.5px;
        }
        .hero-title span {
            color: var(--roasted-brown);
            background: linear-gradient(to bottom, transparent 60%, rgba(45,106,79,0.12) 60%);
        }
        .hero-desc {
            font-size: 1.15rem; color: var(--text-secondary);
            line-height: 1.75; margin-bottom: 40px; max-width: 500px;
        }
        .hero-actions { display: flex; gap: 16px; flex-wrap: wrap; }
        .btn-hero {
            padding: 14px 32px; border-radius: 50px; font-weight: 700;
            font-size: 0.95rem; display: inline-flex; align-items: center; gap: 10px;
            transition: var(--transition-smooth); text-decoration: none;
        }
        .btn-hero-primary {
            background: var(--dark-coffee); color: white; border: 2px solid var(--dark-coffee);
        }
        .btn-hero-primary:hover {
            background: var(--forest-green); border-color: var(--forest-green);
            color: white; text-decoration: none; transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(45,106,79,0.25);
        }
        .btn-hero-ghost {
            background: transparent; color: var(--dark-coffee);
            border: 2px solid rgba(59,42,30,0.2);
        }
        .btn-hero-ghost:hover {
            border-color: var(--dark-coffee); color: var(--dark-coffee);
            text-decoration: none; transform: translateY(-2px);
        }

        /* Hero visual card */
        .hero-visual {
            position: relative; z-index: 1;
        }
        .hero-card {
            background: var(--card-white);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 30px 60px rgba(59,42,30,0.10);
            border: 1px solid rgba(111,78,55,0.06);
            position: relative;
            overflow: hidden;
        }
        .hero-card::before {
            content: '';
            position: absolute; top: 0; right: 0;
            width: 200px; height: 200px;
            background: radial-gradient(circle, rgba(111,78,55,0.05), transparent 70%);
            border-radius: 50%;
        }
        .hero-card-icon {
            width: 64px; height: 64px;
            background: linear-gradient(135deg, var(--roasted-brown), var(--amber-cream));
            border-radius: 20px; display: flex; align-items: center; justify-content: center;
            color: white; font-size: 1.6rem; margin-bottom: 24px;
        }
        .hero-card h3 { font-weight: 700; font-size: 1.3rem; margin-bottom: 12px; }
        .hero-card p { color: var(--text-secondary); font-size: 0.95rem; line-height: 1.6; margin-bottom: 24px; }
        .hero-stat-row {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px;
            padding-top: 24px; border-top: 1px solid rgba(111,78,55,0.08);
        }
        .hero-stat { text-align: center; }
        .hero-stat .num { font-family: 'Outfit'; font-size: 1.8rem; font-weight: 800; color: var(--dark-coffee); line-height: 1; }
        .hero-stat .num.green { color: var(--forest-green); }
        .hero-stat .label { font-size: 0.72rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; margin-top: 4px; }

        /* --- STATS BAR --- */
        .stats-bar-section {
            background: var(--card-white);
            border-top: 1px solid rgba(111,78,55,0.06);
            border-bottom: 1px solid rgba(111,78,55,0.06);
            padding: 50px 0;
        }
        .stats-grid { display: flex; justify-content: center; gap: 80px; flex-wrap: wrap; }
        .stat-item { text-align: center; position: relative; }
        .stat-item:not(:last-child)::after {
            content: ''; position: absolute; right: -40px; top: 10%; height: 80%;
            width: 1px; background: rgba(111,78,55,0.1);
        }
        .stat-num { font-family: 'Outfit'; font-size: 2.8rem; font-weight: 800; color: var(--dark-coffee); line-height: 1; }
        .stat-num.brown { color: var(--roasted-brown); }
        .stat-num.green { color: var(--forest-green); }
        .stat-label { font-size: 0.82rem; color: var(--text-secondary); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-top: 8px; }

        /* --- FEATURES --- */
        .features { padding: 100px 0; }
        .section-badge {
            display: inline-block; background: rgba(111,78,55,0.06);
            color: var(--roasted-brown); padding: 6px 16px; border-radius: 50px;
            font-size: 0.75rem; font-weight: 700; letter-spacing: 0.5px;
            text-transform: uppercase; margin-bottom: 16px;
        }
        .section-title { font-size: 2.5rem; font-weight: 800; color: var(--dark-coffee); margin-bottom: 16px; letter-spacing: -0.5px; }
        .section-desc { font-size: 1.05rem; color: var(--text-secondary); max-width: 550px; margin: 0 auto 60px; line-height: 1.7; }

        .feature-card {
            background: var(--card-white);
            border-radius: var(--radius-card);
            padding: 40px 30px;
            text-align: center;
            transition: var(--transition-smooth);
            border: 1px solid rgba(111,78,55,0.06);
            height: 100%;
        }
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
            border-color: transparent;
        }
        .feature-icon {
            width: 72px; height: 72px;
            background: rgba(111,78,55,0.06);
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-size: 1.8rem; color: var(--roasted-brown);
            margin: 0 auto 24px;
            transition: var(--transition-smooth);
        }
        .feature-card:hover .feature-icon {
            background: var(--roasted-brown); color: white;
            transform: scale(1.1) rotate(5deg);
        }
        .feature-icon.green { background: rgba(45,106,79,0.08); color: var(--forest-green); }
        .feature-card:hover .feature-icon.green { background: var(--forest-green); color: white; }
        .feature-title { font-weight: 700; font-size: 1.2rem; margin-bottom: 12px; }
        .feature-desc { color: var(--text-secondary); font-size: 0.92rem; line-height: 1.65; }

        /* --- HOW IT WORKS --- */
        .how-section {
            background: var(--dark-coffee);
            padding: 100px 0;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .how-section::before {
            content: '';
            position: absolute; top: -100px; right: -100px;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(139,94,60,0.15), transparent 70%);
            border-radius: 50%;
        }
        .how-title { font-size: 2.5rem; font-weight: 800; color: white; margin-bottom: 16px; letter-spacing: -0.5px; }
        .how-desc { color: rgba(255,255,255,0.7); font-size: 1.05rem; max-width: 550px; margin: 0 auto 60px; line-height: 1.7; }

        .step-card {
            text-align: center;
            padding: 30px 20px;
            position: relative;
        }
        .step-num {
            font-family: 'Outfit'; font-size: 3rem; font-weight: 800;
            color: rgba(230,161,92,0.2); line-height: 1; margin-bottom: 16px;
        }
        .step-icon {
            width: 60px; height: 60px;
            background: rgba(255,255,255,0.08);
            border-radius: 16px; display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem; color: rgba(230,161,92,0.9);
            margin: 0 auto 20px;
            border: 1px solid rgba(255,255,255,0.08);
        }
        .step-title { font-weight: 700; font-size: 1.1rem; margin-bottom: 10px; color: white; }
        .step-desc { color: rgba(255,255,255,0.6); font-size: 0.9rem; line-height: 1.6; }
        .step-connector {
            position: absolute; top: 90px; right: -30px;
            color: rgba(255,255,255,0.15); font-size: 1.5rem;
        }

        /* --- CTA --- */
        .cta-section { padding: 100px 0 80px; }
        .cta-box {
            background: linear-gradient(135deg, var(--roasted-brown) 0%, var(--dark-coffee) 100%);
            border-radius: 28px; padding: 70px 50px; text-align: center;
            position: relative; overflow: hidden;
        }
        .cta-box::before {
            content: ''; position: absolute; top: -60px; right: -60px;
            width: 250px; height: 250px;
            background: rgba(255,255,255,0.06); border-radius: 50%;
        }
        .cta-box::after {
            content: ''; position: absolute; bottom: -60px; left: -60px;
            width: 250px; height: 250px;
            background: rgba(255,255,255,0.06); border-radius: 50%;
        }
        .cta-title { color: white; font-size: 2.5rem; font-weight: 800; margin-bottom: 16px; position: relative; z-index: 2; }
        .cta-desc { color: rgba(255,255,255,0.85); font-size: 1.1rem; margin-bottom: 40px; position: relative; z-index: 2; max-width: 600px; margin-left: auto; margin-right: auto; }
        .btn-white {
            background: white; color: var(--roasted-brown); padding: 15px 35px;
            border-radius: 50px; font-weight: 700; display: inline-block;
            transition: var(--transition-smooth); text-decoration: none;
            position: relative; z-index: 2;
        }
        .btn-white:hover { transform: translateY(-3px); box-shadow: 0 12px 24px rgba(0,0,0,0.15); color: var(--dark-coffee); text-decoration: none; }

        /* --- FOOTER --- */
        .footer {
            background: var(--dark-coffee); color: rgba(255,255,255,0.65); padding: 60px 0 30px;
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

        /* --- RESPONSIVE --- */
        @media (max-width: 991px) {
            .nav-links { display: none !important; }
            .hero-title { font-size: 2.8rem; }
            .hero { text-align: center; }
            .hero-desc { margin-left: auto; margin-right: auto; }
            .hero-actions { justify-content: center; }
            .stats-grid { gap: 40px; }
            .stat-item:not(:last-child)::after { display: none; }
            .step-connector { display: none; }
        }
        @media (max-width: 575px) {
            .hero-title { font-size: 2.2rem; }
            .hero { padding: 130px 0 60px; }
            .section-title { font-size: 2rem; }
            .cta-title { font-size: 1.8rem; }
            .cta-box { padding: 50px 24px; }
            .hero-stat-row { grid-template-columns: 1fr; gap: 12px; }
        }
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
                <a href="<?= base_url(); ?>" class="active">Beranda</a>
                <a href="<?= base_url('produk'); ?>">Produk</a>
                <a href="<?= base_url('landing/mitra'); ?>">Mitra</a>
                <a href="<?= base_url('tentang'); ?>">Tentang Kami</a>
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
    <section class="hero">
        <div class="container" style="position: relative; z-index: 1;">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="hero-badge">
                        <i class="bi bi-patch-check-fill"></i> Platform Supply Chain Kopi
                    </div>
                    <h1 class="hero-title">
                        Revolusi Rantai<br>Pasok <span>Kopi</span>
                    </h1>
                    <p class="hero-desc">
                        Membangun masa depan kopi Indonesia yang berkelanjutan, transparan, dan adil bagi petani melalui sistem traceability terintegrasi.
                    </p>
                    <div class="hero-actions">
                        <a href="<?= base_url('produk'); ?>" class="btn-hero btn-hero-primary">
                            Lihat Produk <i class="bi bi-arrow-right"></i>
                        </a>
                        <a href="<?= base_url('tentang'); ?>" class="btn-hero btn-hero-ghost">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="hero-visual">
                        <div class="hero-card">
                            <div class="hero-card-icon">
                                <i class="bi bi-diagram-3-fill"></i>
                            </div>
                            <h3>Ekosistem Terintegrasi</h3>
                            <p>Satu platform digital yang menghubungkan petani, pengolah, distributor, dan konsumen dalam rantai pasok yang transparan.</p>
                            <div class="hero-stat-row">
                                <div class="hero-stat">
                                    <div class="num"><?= number_format($total_petani) ?></div>
                                    <div class="label">Petani</div>
                                </div>
                                <div class="hero-stat">
                                    <div class="num green"><?= number_format($total_mitra) ?></div>
                                    <div class="label">Mitra</div>
                                </div>
                                <div class="hero-stat">
                                    <div class="num brown"><?= number_format($total_produk) ?></div>
                                    <div class="label">Produk</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS BAR -->
    <section class="stats-bar-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-num"><?= number_format($total_petani) ?></div>
                    <div class="stat-label">Petani</div>
                </div>
                <div class="stat-item">
                    <div class="stat-num brown"><?= number_format($total_produk) ?></div>
                    <div class="stat-label">Produk</div>
                </div>
                <div class="stat-item">
                    <div class="stat-num green"><?= number_format($total_mitra) ?></div>
                    <div class="stat-label">Mitra</div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES -->
    <section class="features">
        <div class="container text-center">
            <span class="section-badge">Keunggulan</span>
            <h2 class="section-title">Mengapa Memilih Liberchain?</h2>
            <p class="section-desc">Solusi menyeluruh untuk ekosistem kopi yang transparan, adil, dan berkelanjutan.</p>

            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="bi bi-geo-alt-fill"></i></div>
                        <h4 class="feature-title">Lacak Jejak</h4>
                        <p class="feature-desc">Transparansi penuh dari kebun hingga cangkir. Akses data asal-usul dan proses pengolahan kopi Anda secara real-time.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon green"><i class="bi bi-people-fill"></i></div>
                        <h4 class="feature-title">Pemberdayaan Petani</h4>
                        <p class="feature-desc">Akses pasar lebih luas dan sistem pembayaran adil. Petani mendapatkan nilai yang pantas untuk kerja keras mereka.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="bi bi-tree-fill"></i></div>
                        <h4 class="feature-title">Keberlanjutan</h4>
                        <p class="feature-desc">Mendorong praktik pertanian ramah lingkungan untuk menjaga ekosistem kopi Indonesia tetap lestari.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS -->
    <section class="how-section">
        <div class="container text-center">
            <span class="section-badge" style="background: rgba(255,255,255,0.08); color: rgba(230,161,92,0.9);">Cara Kerja</span>
            <h2 class="how-title">Dari Lahan ke Cangkir</h2>
            <p class="how-desc">Setiap langkah dalam perjalanan kopi tercatat dan dapat dilacak melalui platform kami.</p>

            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="step-card">
                        <div class="step-num">01</div>
                        <div class="step-icon"><i class="bi bi-flower1"></i></div>
                        <h4 class="step-title">Budidaya</h4>
                        <p class="step-desc">Petani mencatat data lahan, varietas, dan proses perawatan tanaman kopi.</p>
                        <div class="step-connector d-none d-lg-block"><i class="bi bi-arrow-right"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="step-card">
                        <div class="step-num">02</div>
                        <div class="step-icon"><i class="bi bi-basket-fill"></i></div>
                        <h4 class="step-title">Panen</h4>
                        <p class="step-desc">Data panen seperti jumlah, kualitas grade, dan waktu panen dicatat otomatis.</p>
                        <div class="step-connector d-none d-lg-block"><i class="bi bi-arrow-right"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="step-card">
                        <div class="step-num">03</div>
                        <div class="step-icon"><i class="bi bi-box-seam-fill"></i></div>
                        <h4 class="step-title">Produk</h4>
                        <p class="step-desc">Kopi diolah menjadi produk siap jual dengan spesifikasi dan detail lengkap.</p>
                        <div class="step-connector d-none d-lg-block"><i class="bi bi-arrow-right"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="step-card">
                        <div class="step-num">04</div>
                        <div class="step-icon"><i class="bi bi-cup-hot-fill"></i></div>
                        <h4 class="step-title">Konsumen</h4>
                        <p class="step-desc">Konsumen menikmati kopi dengan mengetahui asal-usul dan perjalanannya.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-box">
                <h2 class="cta-title">Bergabung dengan Ekosistem Kopi Kami</h2>
                <p class="cta-desc">Jadilah bagian dari revolusi rantai pasok kopi Indonesia yang lebih transparan, adil, dan berkelanjutan.</p>
                <div style="position: relative; z-index: 2; display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                    <a href="<?= base_url('auth/register'); ?>" class="btn-white">Daftar Sekarang</a>
                    <a href="<?= base_url('tentang'); ?>" class="btn-white" style="background: transparent; color: white; border: 2px solid rgba(255,255,255,0.3);">Hubungi Kami</a>
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
                <div class="col-lg-4 col-6 mb-4">
                    <h5 class="footer-title">Kontak</h5>
                    <ul class="footer-links">
                        <li class="d-flex align-items-start mb-3" style="gap:8px;">
                            <i class="bi bi-geo-alt mt-1"></i>
                            <span>Jl. Kopi Arabika No. 12, Dataran Tinggi Gayo, Aceh</span>
                        </li>
                        <li class="d-flex align-items-center mb-3" style="gap:8px;">
                            <i class="bi bi-envelope"></i> hello@liberchain.id
                        </li>
                        <li class="d-flex align-items-center" style="gap:8px;">
                            <i class="bi bi-telephone"></i> +62 811 2233 4455
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar-custom');
            if (window.scrollY > 20) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>
