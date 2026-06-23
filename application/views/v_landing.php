<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mitra Kami - POKTAN Liberchain Supply Chain Kopi</title>
    <meta name="description" content="Daftar mitra terpercaya yang telah bekerja sama dengan Kelompok Tani Kopi Liberchain dalam mendistribusikan kopi kualitas terbaik.">
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
            --shadow-soft:   0 10px 40px rgba(111,78,55,0.10);
            --shadow-hover:  0 20px 50px rgba(59,42,30,0.18);
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

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }

        a { transition: var(--transition-smooth); }

        /* --- NAVBAR --- */
        .navbar-custom {
            background: rgba(245, 241, 234, 0.92);
            backdrop-filter: blur(10px);
            padding: 15px 0;
            border-bottom: 1px solid rgba(111, 78, 55, 0.07);
            transition: var(--transition-smooth);
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
        .nav-links a { color: var(--text-secondary); font-weight: 600; font-size: 0.9rem; text-decoration: none; }
        .nav-links a:hover { color: var(--roasted-brown); text-decoration: none; }

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
            padding: 130px 0 70px;
            position: relative;
            text-align: center;
            overflow: hidden;
            background: radial-gradient(ellipse at top, rgba(139,94,60,0.10) 0%, rgba(245,241,234,0) 60%);
        }

        .hero-bg-shape {
            position: absolute;
            top: -100px;
            right: -100px;
            width: 420px;
            height: 420px;
            background: radial-gradient(circle, rgba(139,94,60,0.16) 0%, rgba(245,241,234,0) 70%);
            z-index: 0;
            border-radius: 50%;
        }

        .hero-bg-shape-2 {
            position: absolute;
            bottom: -60px;
            left: -160px;
            width: 520px;
            height: 520px;
            background: radial-gradient(circle, rgba(45,106,79,0.10) 0%, rgba(245,241,234,0) 70%);
            z-index: 0;
            border-radius: 50%;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(111,78,55,0.08);
            border: 1px solid rgba(111,78,55,0.18);
            color: var(--roasted-brown);
            padding: 7px 18px;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            margin-bottom: 24px;
            position: relative;
            z-index: 1;
            animation: fadeUp 0.8s ease forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .hero-title {
            font-size: 3.4rem;
            font-weight: 800;
            color: var(--dark-coffee);
            margin-bottom: 18px;
            line-height: 1.18;
            position: relative;
            z-index: 1;
            animation: fadeUp 1s ease 0.1s forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        .hero-title span {
            color: var(--amber-cream);
            position: relative;
            display: inline-block;
        }

        .hero-title span::after {
            content: '';
            position: absolute;
            left: 0; right: 0; bottom: 2px;
            height: 10px;
            background: rgba(45,106,79,0.18);
            z-index: -1;
            border-radius: 6px;
        }

        .hero-subtitle {
            font-size: 1.15rem;
            color: var(--text-secondary);
            max-width: 620px;
            margin: 0 auto 36px;
            position: relative;
            z-index: 1;
            animation: fadeUp 1s ease 0.25s forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        @keyframes fadeUp {
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- STATS BAR --- */
        .stats-bar {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: center;
            gap: 50px;
            flex-wrap: wrap;
            margin-top: 10px;
            animation: fadeUp 1s ease 0.4s forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        .stat-item { text-align: center; }
        .stat-item .stat-num { font-size: 2rem; font-weight: 800; color: var(--dark-coffee); line-height: 1; }
        .stat-item .stat-num.green { color: var(--forest-green); }
        .stat-item .stat-label { font-size: 0.78rem; color: var(--text-secondary); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-top: 4px; }

        /* --- CATEGORY FILTER --- */
        .filter-bar {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
            margin: 50px 0 10px;
        }

        .filter-chip {
            padding: 9px 20px;
            border-radius: 50px;
            background: var(--card-white);
            border: 1px solid rgba(111,78,55,0.15);
            color: var(--text-secondary);
            font-size: 0.82rem;
            font-weight: 700;
            cursor: pointer;
            transition: var(--transition-smooth);
            user-select: none;
        }

        .filter-chip:hover { border-color: var(--roasted-brown); color: var(--roasted-brown); }
        .filter-chip.active { background: var(--roasted-brown); color: #fff; border-color: var(--roasted-brown); box-shadow: 0 6px 16px rgba(111,78,55,0.3); }

        /* --- MITRA GRID --- */
        .mitra-section {
            padding: 30px 0 100px;
        }

        .mitra-card {
            background: var(--card-white);
            border-radius: var(--radius-card);
            padding: 35px 28px;
            text-align: center;
            box-shadow: var(--shadow-soft);
            transition: var(--transition-smooth);
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid rgba(111, 78, 55, 0.06);
            position: relative;
            overflow: hidden;
        }

        .mitra-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--roasted-brown), var(--forest-green));
            opacity: 0;
            transition: var(--transition-smooth);
        }

        .mitra-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(139, 94, 60, 0.3);
        }

        .mitra-card:hover::before { opacity: 1; }

        .mitra-logo-wrapper {
            width: 116px;
            height: 116px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: var(--bg-cream);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            box-shadow: inset 0 4px 10px rgba(111, 78, 55, 0.07);
            transition: var(--transition-smooth);
        }

        .mitra-card:hover .mitra-logo-wrapper {
            transform: scale(1.05) rotate(2deg);
            background: #ffffff;
            box-shadow: 0 10px 20px rgba(139, 94, 60, 0.18);
        }

        .mitra-logo { max-width: 100%; max-height: 100%; object-fit: contain; }

        .mitra-category {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-weight: 700;
            color: var(--amber-cream);
            background: rgba(139,94,60,0.1);
            padding: 4px 12px;
            border-radius: 50px;
            margin-bottom: 12px;
        }

        .mitra-name {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark-coffee);
            margin-bottom: 10px;
        }

        .mitra-link {
            margin-top: auto;
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--forest-green);
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .mitra-card:hover .mitra-link { gap: 9px; }

        /* --- CTA SECTION --- */
        .cta-section {
            background: linear-gradient(120deg, var(--dark-coffee) 0%, var(--roasted-brown) 55%, var(--amber-cream) 130%);
            border-radius: 28px;
            margin: 0 auto 90px;
            max-width: 1100px;
            padding: 56px 50px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: -50px; right: -50px;
            width: 220px; height: 220px;
            background: rgba(255,255,255,0.07);
            border-radius: 50%;
        }

        .cta-section h2 { color: #fff; font-weight: 800; font-size: 2rem; margin-bottom: 12px; position: relative; z-index: 1; }
        .cta-section p { color: rgba(255,255,255,0.82); font-size: 1.02rem; max-width: 520px; margin: 0 auto 28px; position: relative; z-index: 1; }

        .btn-cta {
            background: #fff;
            color: var(--roasted-brown);
            border: none;
            border-radius: 50px;
            padding: 13px 32px;
            font-weight: 800;
            font-size: 0.92rem;
            display: inline-flex;
            align-items: center;
            gap: 9px;
            transition: var(--transition-smooth);
            text-decoration: none;
            position: relative;
            z-index: 1;
            box-shadow: 0 8px 24px rgba(0,0,0,0.22);
        }

        .btn-cta:hover {
            background: var(--forest-green);
            color: #fff;
            transform: translateY(-3px);
            text-decoration: none;
            box-shadow: 0 12px 30px rgba(45,106,79,0.4);
        }

        /* --- EMPTY STATE --- */
        .empty-state-wrap {
            background: var(--card-white);
            border-radius: var(--radius-card);
            border: 1px dashed rgba(111,78,55,0.2);
            padding: 70px 30px;
            text-align: center;
        }
        .empty-state-wrap i { font-size: 3.4rem; color: var(--amber-cream); opacity: 0.55; display: block; margin-bottom: 18px; }
        .empty-state-wrap h4 { font-weight: 700; color: var(--dark-coffee); }
        .empty-state-wrap p { color: var(--text-secondary); margin-bottom: 0; }

        /* --- FOOTER --- */
        .footer {
            background: var(--dark-coffee);
            color: rgba(255,255,255,0.7);
            padding: 50px 0 28px;
        }
        .footer-brand {
            color: white;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
        }
        .footer-desc { font-size: 0.85rem; color: rgba(255,255,255,0.55); max-width: 320px; line-height: 1.6; }
        .footer-col-title { color: #fff; font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.6px; margin-bottom: 16px; }
        .footer-link { display: block; color: rgba(255,255,255,0.6); font-size: 0.85rem; text-decoration: none; margin-bottom: 10px; }
        .footer-link:hover { color: var(--amber-cream); text-decoration: none; }
        .footer-divider { border-top: 1px solid rgba(255,255,255,0.08); margin: 32px 0 22px; }
        .footer-bottom { font-size: 0.8rem; color: rgba(255,255,255,0.45); text-align: center; }

        @media (max-width: 767px) {
            .hero-title { font-size: 2.2rem; }
            .hero-section { padding: 110px 0 50px; }
            .stats-bar { gap: 28px; }
            .nav-links { display: none; }
            .cta-section { padding: 40px 24px; border-radius: 20px; margin-left: 16px; margin-right: 16px; }
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
                <a href="<?= base_url(); ?>">Mitra</a>
                <a href="<?= base_url('produk'); ?>">Produk</a>
                <a href="<?= base_url('tentang'); ?>">Tentang Kami</a>
            </div>
            <a href="<?= base_url('auth/login'); ?>" class="nav-btn">Masuk</a>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero-section">
        <div class="hero-bg-shape"></div>
        <div class="hero-bg-shape-2"></div>
        <div class="container">
            <span class="hero-badge"><i class="bi bi-stars"></i> Supply Chain Kopi Terintegrasi</span>
            <h1 class="hero-title">Jaringan Mitra <span>Terpercaya</span></h1>
            <p class="hero-subtitle">Membangun ekosistem kopi yang transparan dan berkelanjutan bersama mitra-mitra terbaik kami di seluruh Indonesia.</p>

            <?php
                $total_mitra = count($mitra_list);
                $kategori_unik = [];
                foreach ($mitra_list as $m) {
                    if (!empty($m['kategori_mitra']) && !in_array($m['kategori_mitra'], $kategori_unik)) {
                        $kategori_unik[] = $m['kategori_mitra'];
                    }
                }
                $total_kategori = count($kategori_unik);
            ?>
            <div class="stats-bar">
                <div class="stat-item">
                    <div class="stat-num"><?= $total_mitra; ?>+</div>
                    <div class="stat-label">Mitra Terdaftar</div>
                </div>
                <div class="stat-item">
                    <div class="stat-num green"><?= $total_kategori; ?></div>
                    <div class="stat-label">Kategori Bisnis</div>
                </div>
                <div class="stat-item">
                    <div class="stat-num">34</div>
                    <div class="stat-label">Provinsi Terjangkau</div>
                </div>
            </div>
        </div>
    </section>

    <!-- MITRA GRID -->
    <section class="mitra-section">
        <div class="container">

            <?php if (!empty($mitra_list) && !empty($kategori_unik)): ?>
            <div class="filter-bar" id="filterBar">
                <span class="filter-chip active" data-filter="all">Semua Mitra</span>
                <?php foreach ($kategori_unik as $kat): ?>
                <span class="filter-chip" data-filter="<?= htmlspecialchars(strtolower($kat)); ?>"><?= htmlspecialchars($kat); ?></span>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <div class="row justify-content-center mt-4" id="mitraGrid">
                <?php if (empty($mitra_list)): ?>
                    <div class="col-12">
                        <div class="empty-state-wrap">
                            <i class="bi bi-shop"></i>
                            <h4>Belum ada mitra yang tergabung</h4>
                            <p>Jadilah yang pertama bermitra dengan kami!</p>
                        </div>
                    </div>
                <?php else: ?>
                    <?php
                    $delay = 0;
                    foreach ($mitra_list as $mitra):
                        $kat_attr = htmlspecialchars(strtolower($mitra['kategori_mitra'] ?? ''));
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 mitra-grid-item" data-category="<?= $kat_attr; ?>" style="animation: fadeUp 0.8s ease <?= $delay; ?>s forwards; opacity: 0; transform: translateY(30px);">
                        <a href="<?= base_url('landing/detail/'.$mitra['id_mitra']); ?>" style="text-decoration: none; display: block; height: 100%;">
                            <div class="mitra-card">
                                <div class="mitra-logo-wrapper">
                                    <img src="<?= base_url('assets/uploads/mitra/'.$mitra['logo_mitra']); ?>" alt="Logo <?= htmlspecialchars($mitra['nama_mitra']); ?>" class="mitra-logo" onerror="this.src='<?= base_url('assets/uploads/mitra/default.png'); ?>'">
                                </div>
                                <div class="mitra-category"><i class="bi bi-tag-fill"></i> <?= htmlspecialchars($mitra['kategori_mitra']); ?></div>
                                <h3 class="mitra-name"><?= htmlspecialchars($mitra['nama_mitra']); ?></h3>
                                <span class="mitra-link">Lihat Profil <i class="bi bi-arrow-right"></i></span>
                            </div>
                        </a>
                    </div>
                    <?php
                    $delay += 0.08;
                    endforeach;
                    ?>
                <?php endif; ?>
            </div>

            <?php if (!empty($mitra_list)): ?>
            <div id="noResultState" class="empty-state-wrap" style="display:none;">
                <i class="bi bi-search"></i>
                <h4>Tidak ada mitra di kategori ini</h4>
                <p>Coba pilih kategori lain.</p>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="cta-section">
        <h2>Ingin Bermitra Dengan Kami?</h2>
        <p>Bergabunglah dengan jaringan mitra Liberchain dan jadi bagian dari ekosistem kopi yang transparan, berkelanjutan, dan saling menguntungkan.</p>
        <a href="<?= base_url('auth/login'); ?>" class="btn-cta"><i class="bi bi-handshake"></i> Hubungi Kami</a>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mb-4">
                    <div class="footer-brand">
                        <div class="brand-icon"><i class="bi bi-patch-check-fill"></i></div>
                        POKTAN Liberchain
                    </div>
                    <p class="footer-desc">Platform supply chain kopi yang menghubungkan petani, mitra, dan pembeli dalam satu ekosistem yang transparan dan berkelanjutan.</p>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="footer-col-title">Navigasi</div>
                    <a href="<?= base_url(); ?>" class="footer-link">Mitra Kami</a>
                    <a href="<?= base_url('auth/login'); ?>" class="footer-link">Masuk</a>
                </div>
                <div class="col-md-4 col-6 mb-4">
                    <div class="footer-col-title">Kontak</div>
                    <span class="footer-link"><i class="bi bi-envelope mr-1"></i> info@liberchain.id</span>
                    <span class="footer-link"><i class="bi bi-geo-alt mr-1"></i> Indonesia</span>
                </div>
            </div>
            <div class="footer-divider"></div>
            <p class="footer-bottom mb-0">&copy; <?= date('Y'); ?> Sistem Supply Chain Kopi Terintegrasi. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    $(function () {
        $('.filter-chip').on('click', function () {
            var filter = $(this).data('filter');
            $('.filter-chip').removeClass('active');
            $(this).addClass('active');

            var visibleCount = 0;
            $('.mitra-grid-item').each(function () {
                var cat = $(this).data('category');
                if (filter === 'all' || cat === filter) {
                    $(this).show();
                    visibleCount++;
                } else {
                    $(this).hide();
                }
            });

            if (visibleCount === 0) {
                $('#noResultState').show();
            } else {
                $('#noResultState').hide();
            }
        });
    });
    </script>
</body>
</html>