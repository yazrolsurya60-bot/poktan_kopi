<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mitra Kami - POKTAN Liberchain Supply Chain Kopi</title>
    <meta name="description" content="Daftar mitra terpercaya yang telah bekerja sama dengan Kelompok Tani Kopi Liberchain dalam mendistribusikan kopi kualitas terbaik.">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --roasted-brown: #4A2C11;
            --dark-coffee: #2C1808;
            --amber-cream: #E6A15C;
            --bg-cream: #FAF6F0;
            --card-white: #FFFFFF;
            --text-secondary: #70655E;
            --shadow-soft: 0 10px 40px rgba(44, 24, 8, 0.08);
            --shadow-hover: 0 20px 50px rgba(44, 24, 8, 0.15);
            --radius-card: 20px;
            --transition-smooth: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

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

        /* --- NAVBAR --- */
        .navbar-custom {
            background: rgba(250, 246, 240, 0.9);
            backdrop-filter: blur(10px);
            padding: 15px 0;
            border-bottom: 1px solid rgba(74, 44, 17, 0.05);
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

        .nav-btn {
            background: var(--dark-coffee);
            color: white;
            padding: 8px 24px;
            border-radius: 50px;
            font-weight: 600;
            transition: var(--transition-smooth);
            border: 2px solid var(--dark-coffee);
            text-decoration: none;
        }

        .nav-btn:hover {
            background: transparent;
            color: var(--dark-coffee);
            text-decoration: none;
        }

        /* --- HERO SECTION --- */
        .hero-section {
            padding: 120px 0 80px;
            position: relative;
            text-align: center;
            overflow: hidden;
        }

        .hero-bg-shape {
            position: absolute;
            top: -100px;
            right: -100px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(230,161,92,0.15) 0%, rgba(250,246,240,0) 70%);
            z-index: -1;
            border-radius: 50%;
        }

        .hero-bg-shape-2 {
            position: absolute;
            bottom: -50px;
            left: -150px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(74,44,17,0.08) 0%, rgba(250,246,240,0) 70%);
            z-index: -1;
            border-radius: 50%;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--dark-coffee);
            margin-bottom: 20px;
            line-height: 1.2;
            animation: fadeUp 1s ease forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        .hero-title span {
            color: var(--amber-cream);
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: var(--text-secondary);
            max-width: 600px;
            margin: 0 auto 40px;
            animation: fadeUp 1s ease 0.2s forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        @keyframes fadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* --- MITRA GRID --- */
        .mitra-section {
            padding: 40px 0 100px;
        }

        .mitra-card {
            background: var(--card-white);
            border-radius: var(--radius-card);
            padding: 35px 30px;
            text-align: center;
            box-shadow: var(--shadow-soft);
            transition: var(--transition-smooth);
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid rgba(74, 44, 17, 0.04);
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
            background: linear-gradient(90deg, var(--roasted-brown), var(--amber-cream));
            opacity: 0;
            transition: var(--transition-smooth);
        }

        .mitra-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(230, 161, 92, 0.3);
        }

        .mitra-card:hover::before {
            opacity: 1;
        }

        .mitra-logo-wrapper {
            width: 120px;
            height: 120px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: var(--bg-cream);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            box-shadow: inset 0 4px 10px rgba(74, 44, 17, 0.05);
            transition: var(--transition-smooth);
        }

        .mitra-card:hover .mitra-logo-wrapper {
            transform: scale(1.05) rotate(2deg);
            background: #ffffff;
            box-shadow: 0 10px 20px rgba(230, 161, 92, 0.15);
        }

        .mitra-logo {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .mitra-category {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            color: var(--amber-cream);
            margin-bottom: 8px;
        }

        .mitra-name {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--dark-coffee);
            margin-bottom: 0;
        }

        /* --- FOOTER --- */
        .footer {
            background: var(--dark-coffee);
            color: rgba(255,255,255,0.7);
            padding: 40px 0;
            text-align: center;
            font-size: 0.9rem;
        }

        .footer-brand {
            color: white;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url(); ?>">
                <div class="brand-icon"><i class="bi bi-patch-check-fill"></i></div>
                Liberchain
            </a>
            <div class="ml-auto">
                <a href="<?= base_url('auth/login'); ?>" class="nav-btn">Masuk</a>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero-section">
        <div class="hero-bg-shape"></div>
        <div class="hero-bg-shape-2"></div>
        <div class="container">
            <h1 class="hero-title">Jaringan Mitra <span>Terpercaya</span></h1>
            <p class="hero-subtitle">Membangun ekosistem kopi yang transparan dan berkelanjutan bersama mitra-mitra terbaik kami di seluruh Indonesia.</p>
        </div>
    </section>

    <!-- MITRA GRID -->
    <section class="mitra-section">
        <div class="container">
            <div class="row justify-content-center">
                <?php if(empty($mitra_list)): ?>
                    <div class="col-12 text-center">
                        <div style="padding: 60px 0; color: var(--text-secondary);">
                            <i class="bi bi-shop" style="font-size: 4rem; opacity: 0.5; margin-bottom: 20px; display: block;"></i>
                            <h4>Belum ada mitra yang tergabung</h4>
                            <p>Jadilah yang pertama bermitra dengan kami!</p>
                        </div>
                    </div>
                <?php else: ?>
                    <?php 
                    // Animation delay logic
                    $delay = 0;
                    foreach($mitra_list as $mitra): 
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4" style="animation: fadeUp 0.8s ease <?= $delay; ?>s forwards; opacity: 0; transform: translateY(30px);">
                        <a href="<?= base_url('landing/detail/'.$mitra['id_mitra']); ?>" style="text-decoration: none; display: block; height: 100%;">
                            <div class="mitra-card">
                                <div class="mitra-logo-wrapper">
                                    <img src="<?= base_url('assets/uploads/mitra/'.$mitra['logo_mitra']); ?>" alt="Logo <?= htmlspecialchars($mitra['nama_mitra']); ?>" class="mitra-logo" onerror="this.src='<?= base_url('assets/uploads/mitra/default.png'); ?>'">
                                </div>
                                <div class="mitra-category"><?= htmlspecialchars($mitra['kategori_mitra']); ?></div>
                                <h3 class="mitra-name"><?= htmlspecialchars($mitra['nama_mitra']); ?></h3>
                            </div>
                        </a>
                    </div>
                    <?php 
                    $delay += 0.1;
                    endforeach; 
                    ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="footer-brand">POKTAN Liberchain</div>
            <p class="mb-0">&copy; <?= date('Y'); ?> Sistem Supply Chain Kopi Terintegrasi. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
