<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mitra - <?= htmlspecialchars($mitra['nama_mitra']); ?></title>
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
            --radius-card: 20px;
            --transition-smooth: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-cream);
            color: var(--dark-coffee);
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

        /* --- DETAIL SECTION --- */
        .detail-section {
            padding: 120px 0 80px;
            min-height: 100vh;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-secondary);
            font-weight: 600;
            text-decoration: none;
            margin-bottom: 30px;
            transition: var(--transition-smooth);
        }

        .btn-back:hover {
            color: var(--dark-coffee);
            transform: translateX(-5px);
            text-decoration: none;
        }

        .detail-card {
            background: var(--card-white);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-soft);
            overflow: hidden;
            border: 1px solid rgba(74, 44, 17, 0.04);
            position: relative;
        }

        .detail-header {
            background: linear-gradient(135deg, rgba(74,44,17,0.05), rgba(230,161,92,0.1));
            padding: 60px 40px;
            text-align: center;
            border-bottom: 1px solid rgba(74, 44, 17, 0.05);
        }

        .detail-logo-wrapper {
            width: 160px;
            height: 160px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(74, 44, 17, 0.1);
        }

        .detail-logo {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .detail-category {
            display: inline-block;
            padding: 6px 16px;
            background: rgba(230, 161, 92, 0.15);
            color: var(--roasted-brown);
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }

        .detail-name {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--dark-coffee);
            margin-bottom: 10px;
        }

        .detail-body {
            padding: 50px 40px;
        }

        .info-box {
            background: var(--bg-cream);
            padding: 25px;
            border-radius: 16px;
            margin-bottom: 20px;
            border: 1px solid rgba(74, 44, 17, 0.05);
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .info-icon {
            width: 50px;
            height: 50px;
            background: rgba(230, 161, 92, 0.2);
            color: var(--roasted-brown);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .info-text h5 {
            font-size: 0.9rem;
            color: var(--text-secondary);
            margin-bottom: 5px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .info-text p {
            font-size: 1.1rem;
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
                            <span class="detail-category"><?= htmlspecialchars($mitra['kategori_mitra']); ?></span>
                            <h1 class="detail-name"><?= htmlspecialchars($mitra['nama_mitra']); ?></h1>
                            <p class="text-secondary mb-0">Mitra Resmi POKTAN Liberchain</p>
                        </div>
                        <div class="detail-body">
                            <h4 class="mb-4">Informasi Mitra</h4>
                            
                            <div class="info-box">
                                <div class="info-icon"><i class="bi bi-calendar-check"></i></div>
                                <div class="info-text">
                                    <h5>Tanggal Bergabung</h5>
                                    <p><?= date('d M Y', strtotime($mitra['created_at'])); ?></p>
                                </div>
                            </div>
                            
                            <div class="info-box">
                                <div class="info-icon"><i class="bi bi-award"></i></div>
                                <div class="info-text">
                                    <h5>Status Kemitraan</h5>
                                    <p class="text-success"><i class="bi bi-check-circle-fill mr-1"></i> Aktif Tersertifikasi</p>
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
