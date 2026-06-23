<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mitra - <?= htmlspecialchars($mitra['nama_mitra']); ?></title>
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
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5, h6 { font-family: 'Outfit', sans-serif; }

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
        .nav-btn:hover { background: var(--forest-green); border-color: var(--forest-green); color: white; text-decoration: none; transform: translateY(-2px); }

        /* --- DETAIL HERO BANNER --- */
        .detail-section { padding: 120px 0 80px; min-height: 100vh; }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-secondary);
            font-weight: 600;
            text-decoration: none;
            margin-bottom: 28px;
            transition: var(--transition-smooth);
        }
        .btn-back:hover { color: var(--dark-coffee); transform: translateX(-5px); text-decoration: none; }

        .detail-card {
            background: var(--card-white);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-soft);
            overflow: hidden;
            border: 1px solid rgba(111, 78, 55, 0.06);
            position: relative;
        }

        .detail-header {
            background: linear-gradient(120deg, var(--dark-coffee) 0%, var(--roasted-brown) 55%, var(--amber-cream) 130%);
            padding: 60px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .detail-header::before {
            content: ''; position: absolute; top: -50px; right: -50px;
            width: 200px; height: 200px; background: rgba(255,255,255,0.07); border-radius: 50%;
        }

        .detail-logo-wrapper {
            width: 150px;
            height: 150px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 18px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.18);
            position: relative;
            z-index: 1;
        }
        .detail-logo { max-width: 100%; max-height: 100%; object-fit: contain; }

        .detail-category {
            display: inline-block;
            padding: 6px 18px;
            background: rgba(255,255,255,0.18);
            color: #fff;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 14px;
            position: relative; z-index: 1;
        }

        .detail-name { font-size: 2.3rem; font-weight: 800; color: #fff; margin-bottom: 8px; position: relative; z-index: 1; }
        .detail-tagline { color: rgba(255,255,255,0.78); margin-bottom: 0; position: relative; z-index: 1; }

        .detail-body { padding: 45px 40px 50px; }
        .detail-body h4 { font-weight: 700; margin-bottom: 22px; }

        .info-box {
            background: var(--bg-cream);
            padding: 22px;
            border-radius: 16px;
            margin-bottom: 16px;
            border: 1px solid rgba(111, 78, 55, 0.07);
            display: flex;
            align-items: center;
            gap: 18px;
            transition: var(--transition-smooth);
        }
        .info-box:hover { box-shadow: var(--shadow-soft); transform: translateY(-2px); }

        .info-icon {
            width: 48px; height: 48px;
            background: rgba(139, 94, 60, 0.15);
            color: var(--roasted-brown);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
            flex-shrink: 0;
        }
        .info-icon.green { background: rgba(45,106,79,0.12); color: var(--forest-green); }

        .info-text h5 { font-size: 0.85rem; color: var(--text-secondary); margin-bottom: 4px; font-family: 'Plus Jakarta Sans', sans-serif; }
        .info-text p { font-size: 1.05rem; font-weight: 700; color: var(--dark-coffee); margin-bottom: 0; }

        .badge-aktif { color: var(--forest-green); }

        .cta-mini {
            margin-top: 8px;
            background: var(--bg-cream);
            border: 1px dashed rgba(111,78,55,0.25);
            border-radius: 16px;
            padding: 22px;
            text-align: center;
        }
        .cta-mini p { color: var(--text-secondary); margin-bottom: 14px; font-size: 0.9rem; }
        .btn-mini { background: var(--roasted-brown); color: #fff; border-radius: 50px; padding: 10px 24px; font-weight: 700; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 7px; transition: var(--transition-smooth); }
        .btn-mini:hover { background: var(--forest-green); color: #fff; text-decoration: none; transform: translateY(-2px); }

        /* --- FOOTER --- */
        .footer { background: var(--dark-coffee); color: rgba(255,255,255,0.7); padding: 32px 0; text-align: center; font-size: 0.85rem; }

        @media (max-width: 767px) {
            .detail-section { padding: 100px 0 50px; }
            .detail-header { padding: 45px 24px; }
            .detail-body { padding: 32px 24px; }
            .detail-name { font-size: 1.8rem; }
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
            <a href="<?= base_url('auth/login'); ?>" class="nav-btn ml-auto">Masuk</a>
        </div>
    </nav>

    <!-- DETAIL SECTION -->
    <section class="detail-section">
        <div class="container">
            <a href="<?= base_url('landing'); ?>" class="btn-back">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar Mitra
            </a>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="detail-card">
                        <div class="detail-header">
                            <div class="detail-logo-wrapper">
                                <img src="<?= base_url('assets/uploads/mitra/'.$mitra['logo_mitra']); ?>" alt="Logo <?= htmlspecialchars($mitra['nama_mitra']); ?>" class="detail-logo" onerror="this.src='<?= base_url('assets/uploads/mitra/default.png'); ?>'">
                            </div>
                            <span class="detail-category"><i class="bi bi-tag-fill"></i> <?= htmlspecialchars($mitra['kategori_mitra']); ?></span>
                            <h1 class="detail-name"><?= htmlspecialchars($mitra['nama_mitra']); ?></h1>
                            <p class="detail-tagline">Mitra Resmi POKTAN Liberchain</p>
                        </div>
                        <div class="detail-body">
                            <h4>Informasi Mitra</h4>

                            <div class="info-box">
                                <div class="info-icon"><i class="bi bi-hash"></i></div>
                                <div class="info-text">
                                    <h5>ID Mitra</h5>
                                    <p>#<?= htmlspecialchars($mitra['id_mitra']); ?></p>
                                </div>
                            </div>

                            <div class="info-box">
                                <div class="info-icon"><i class="bi bi-shop"></i></div>
                                <div class="info-text">
                                    <h5>Kategori Bisnis</h5>
                                    <p><?= htmlspecialchars($mitra['kategori_mitra']); ?></p>
                                </div>
                            </div>

                            <div class="info-box">
                                <div class="info-icon green"><i class="bi bi-award"></i></div>
                                <div class="info-text">
                                    <h5>Status Kemitraan</h5>
                                    <p class="badge-aktif"><i class="bi bi-check-circle-fill mr-1"></i> Aktif Tersertifikasi</p>
                                </div>
                            </div>

                            <?php if (!empty($mitra['created_at'])): ?>
                            <div class="info-box">
                                <div class="info-icon"><i class="bi bi-calendar-check"></i></div>
                                <div class="info-text">
                                    <h5>Tanggal Bergabung</h5>
                                    <p><?= date('d M Y', strtotime($mitra['created_at'])); ?></p>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="cta-mini">
                                <p>Tertarik bermitra dengan POKTAN Liberchain seperti <?= htmlspecialchars($mitra['nama_mitra']); ?>?</p>
                                <a href="<?= base_url('auth/login'); ?>" class="btn-mini"><i class="bi bi-handshake"></i> Hubungi Kami</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <p class="mb-0">&copy; <?= date('Y'); ?> POKTAN Liberchain. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>