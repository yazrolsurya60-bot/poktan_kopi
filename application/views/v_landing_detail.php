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

        /* --- PROFILE TWO-COLUMN LAYOUT --- */
        .profile-layout { display: flex; gap: 30px; align-items: flex-start; }
        .profile-side { width: 230px; flex-shrink: 0; text-align: center; }
        .profile-side-logo {
            width: 110px; height: 110px; margin: 0 auto 14px; border-radius: 50%;
            background: var(--card-white); display: flex; align-items: center; justify-content: center;
            padding: 14px; box-shadow: var(--shadow-soft); border: 1px solid rgba(111,78,55,0.08);
        }
        .profile-side-logo img { max-width: 100%; max-height: 100%; object-fit: contain; }
        .profile-side-name { font-size: 1.15rem; font-weight: 800; color: var(--dark-coffee); margin-bottom: 8px; line-height: 1.3; }
        .profile-side-status {
            display: inline-flex; align-items: center; gap: 5px; padding: 4px 14px; border-radius: 50px;
            background: rgba(45,106,79,0.12); color: var(--forest-green); font-size: 0.75rem; font-weight: 700;
            margin-bottom: 18px;
        }
        .profile-side-meta { text-align: left; border-top: 1px solid rgba(111,78,55,0.08); padding-top: 16px; }
        .profile-meta-row { display: flex; justify-content: space-between; padding: 7px 0; font-size: 0.8rem; }
        .profile-meta-row span:first-child { color: var(--text-secondary); font-weight: 500; }
        .profile-meta-row span:last-child { color: var(--dark-coffee); font-weight: 700; text-align: right; }

        .profile-main { flex: 1; min-width: 0; }
        .profile-row {
            display: flex; gap: 18px; padding: 14px 0; border-bottom: 1px solid rgba(111,78,55,0.07);
        }
        .profile-row:last-child { border-bottom: none; }
        .profile-row-label { width: 130px; flex-shrink: 0; font-size: 0.82rem; font-weight: 700; color: var(--text-secondary); display: flex; align-items: flex-start; gap: 8px; padding-top: 1px; }
        .profile-row-label i { color: var(--roasted-brown); font-size: 0.95rem; flex-shrink: 0; margin-top: 1px; }
        .profile-row-value { flex: 1; font-size: 0.92rem; font-weight: 600; color: var(--dark-coffee); line-height: 1.55; word-break: break-word; }
        .profile-row-value a { color: var(--roasted-brown); text-decoration: underline; }

        .profile-doc-box {
            display: flex; align-items: center; gap: 14px; margin-top: 22px;
            padding: 14px 16px; background: var(--bg-cream); border: 1px solid rgba(111,78,55,0.08); border-radius: 14px;
        }
        .profile-doc-icon {
            width: 44px; height: 44px; border-radius: 10px; background: var(--card-white); border: 1px solid rgba(111,78,55,0.08);
            display: flex; align-items: center; justify-content: center; overflow: hidden; flex-shrink: 0;
        }
        .profile-doc-icon img { width: 100%; height: 100%; object-fit: contain; }
        .profile-doc-info { flex: 1; min-width: 0; }
        .profile-doc-name { font-size: 0.85rem; font-weight: 700; color: var(--dark-coffee); word-break: break-all; }
        .profile-doc-meta { font-size: 0.72rem; color: var(--text-secondary); }
        .profile-doc-dl { width: 36px; height: 36px; border-radius: 9px; background: var(--card-white); border: 1px solid rgba(111,78,55,0.1); display: flex; align-items: center; justify-content: center; color: var(--roasted-brown); flex-shrink: 0; text-decoration: none; transition: var(--transition-smooth); }
        .profile-doc-dl:hover { background: var(--roasted-brown); color: #fff; }

        @media (max-width: 767px) {
            .profile-layout { flex-direction: column; align-items: center; }
            .profile-side { width: 100%; }
            .profile-side-meta { text-align: center; }
            .profile-meta-row { justify-content: center; gap: 8px; }
            .profile-row { flex-direction: column; gap: 4px; }
            .profile-row-label { width: 100%; }
        }

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
                <div class="col-lg-10">
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

                            <div class="profile-layout">
                                <!-- SISI KIRI: Logo, Nama, Status, Meta -->
                                <div class="profile-side">
                                    <div class="profile-side-logo">
                                        <img src="<?= base_url('assets/uploads/mitra/'.$mitra['logo_mitra']); ?>" alt="Logo <?= htmlspecialchars($mitra['nama_mitra']); ?>" onerror="this.src='<?= base_url('assets/uploads/mitra/default.png'); ?>'">
                                    </div>
                                    <div class="profile-side-name"><?= htmlspecialchars($mitra['nama_mitra']); ?></div>
                                    <span class="profile-side-status"><i class="bi bi-check-circle-fill"></i> Aktif</span>

                                    <div class="profile-side-meta">
                                        <div class="profile-meta-row"><span>Kategori</span><span><?= htmlspecialchars($mitra['kategori_mitra']); ?></span></div>
                                        <?php if (isset($mitra['urutan_tampil'])): ?>
                                        <div class="profile-meta-row"><span>Urutan Tampil</span><span><?= (int)$mitra['urutan_tampil']; ?></span></div>
                                        <?php endif; ?>
                                        <?php if (!empty($mitra['created_at'])): ?>
                                        <div class="profile-meta-row"><span>Bergabung</span><span><?= date('d M Y', strtotime($mitra['created_at'])); ?></span></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- SISI KANAN: Detail Field per Baris -->
                                <div class="profile-main">

                                    <div class="profile-row">
                                        <div class="profile-row-label"><i class="bi bi-building"></i> Nama Mitra</div>
                                        <div class="profile-row-value"><?= htmlspecialchars($mitra['nama_mitra']); ?></div>
                                    </div>

                                    <?php if (!empty($mitra['email'])): ?>
                                    <div class="profile-row">
                                        <div class="profile-row-label"><i class="bi bi-envelope-fill"></i> Email</div>
                                        <div class="profile-row-value"><?= htmlspecialchars($mitra['email']); ?></div>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (!empty($mitra['no_telepon'])): ?>
                                    <div class="profile-row">
                                        <div class="profile-row-label"><i class="bi bi-telephone-fill"></i> No Telepon</div>
                                        <div class="profile-row-value"><?= htmlspecialchars($mitra['no_telepon']); ?></div>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (!empty($mitra['website'])): ?>
                                    <div class="profile-row">
                                        <div class="profile-row-label"><i class="bi bi-globe2"></i> Website</div>
                                        <div class="profile-row-value">
                                            <a href="<?= (strpos($mitra['website'], 'http') === 0) ? htmlspecialchars($mitra['website']) : 'https://'.htmlspecialchars($mitra['website']); ?>" target="_blank" rel="noopener"><?= htmlspecialchars($mitra['website']); ?></a>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (!empty($mitra['alamat'])): ?>
                                    <div class="profile-row">
                                        <div class="profile-row-label"><i class="bi bi-geo-alt-fill"></i> Alamat</div>
                                        <div class="profile-row-value"><?= nl2br(htmlspecialchars($mitra['alamat'])); ?></div>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (!empty($mitra['deskripsi'])): ?>
                                    <div class="profile-row">
                                        <div class="profile-row-label"><i class="bi bi-card-text"></i> Deskripsi</div>
                                        <div class="profile-row-value"><?= nl2br(htmlspecialchars($mitra['deskripsi'])); ?></div>
                                    </div>
                                    <?php endif; ?>

                                    <!-- Dokumen / Logo Mitra -->
                                    <?php if (!empty($mitra['logo_mitra']) && $mitra['logo_mitra'] !== 'default.png'): ?>
                                    <div class="profile-doc-box">
                                        <div class="profile-doc-icon">
                                            <img src="<?= base_url('assets/uploads/mitra/'.$mitra['logo_mitra']); ?>" alt="Logo Mitra">
                                        </div>
                                        <div class="profile-doc-info">
                                            <div class="profile-doc-name"><?= htmlspecialchars($mitra['logo_mitra']); ?></div>
                                            <div class="profile-doc-meta">Logo / Dokumen Mitra</div>
                                        </div>
                                        <a href="<?= base_url('assets/uploads/mitra/'.$mitra['logo_mitra']); ?>" download class="profile-doc-dl" title="Unduh"><i class="bi bi-download"></i></a>
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