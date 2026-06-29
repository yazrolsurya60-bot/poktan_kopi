<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Petani - Sistem Supply Chain Kopi</title>
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
            --shadow-soft: 0 8px 30px rgba(44, 24, 8, 0.08);
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-cream);
            color: var(--dark-coffee);
        }

        .page-header {
            background: linear-gradient(135deg, var(--roasted-brown) 0%, var(--dark-coffee) 100%);
            color: white;
            padding: 40px 0;
            margin-bottom: 30px;
            box-shadow: 0 8px 20px rgba(44, 24, 8, 0.15);
        }

        .page-title {
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .page-description {
            font-size: 0.95rem;
            opacity: 0.9;
        }

        .container-main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .card-petani {
            background: var(--card-white);
            border: 1px solid rgba(74, 44, 17, 0.08);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: var(--shadow-soft);
            transition: var(--transition-smooth);
        }

        .card-petani:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-2px);
        }

        .petani-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .petani-info {
            flex: 1;
        }

        .petani-nama {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark-coffee);
            margin-bottom: 5px;
        }

        .petani-meta {
            font-size: 0.85rem;
            color: var(--text-secondary);
            display: flex;
            gap: 20px;
            margin-bottom: 10px;
        }

        .petani-status {
            display: inline-block;
            padding: 4px 12px;
            background: #FEE2E2;
            color: #7F1D1D;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-verify {
            background: #10B981;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: var(--transition-smooth);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-verify:hover {
            background: #059669;
            transform: translateY(-2px);
            color: white;
        }

        .btn-reject {
            background: #EF4444;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: var(--transition-smooth);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-reject:hover {
            background: #DC2626;
            transform: translateY(-2px);
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-secondary);
        }

        .empty-state-icon {
            font-size: 3rem;
            color: var(--amber-cream);
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .alert-custom {
            border-radius: 12px;
            margin-bottom: 20px;
            border: none;
        }

        .alert-custom i {
            margin-right: 10px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--amber-cream);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 20px;
            transition: var(--transition-smooth);
        }

        .back-link:hover {
            color: var(--roasted-brown);
            gap: 10px;
        }
    </style>
</head>

<body>
    <div class="page-header">
        <div class="container-main">
            <h1 class="page-title">
                <i class="bi bi-check-circle mr-2"></i>Verifikasi Akun Petani
            </h1>
            <p class="page-description">Kelola permintaan verifikasi akun dari calon petani yang baru mendaftar</p>
        </div>
    </div>

    <div class="container-main">
        <a href="<?= base_url('admin/users'); ?>" class="back-link">
            <i class="bi bi-arrow-left"></i>Kembali ke Manajemen User
        </a>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-custom">
                <i class="bi bi-check-circle-fill"></i>
                <?= $this->session->flashdata('success'); ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-custom">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <?= $this->session->flashdata('error'); ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php endif; ?>

        <?php if (!empty($petani)): ?>
            <?php foreach ($petani as $p): ?>
                <div class="card-petani">
                    <div class="petani-header">
                        <div class="petani-info">
                            <div class="petani-nama">
                                <i class="bi bi-person-circle mr-2" style="color: var(--amber-cream);"></i>
                                <?= $p['nama']; ?>
                            </div>
                            <div class="petani-meta">
                                <span>
                                    <i class="bi bi-at mr-1"></i>
                                    <strong><?= $p['username']; ?></strong>
                                </span>
                                <span>
                                    <i class="bi bi-telephone mr-1"></i>
                                    <?= $p['no_telepon']; ?>
                                </span>
                                <span>
                                    <i class="bi bi-calendar mr-1"></i>
                                    <?= date('d M Y', strtotime($p['created_at'])); ?>
                                </span>
                            </div>
                            <span class="petani-status">
                                <i class="bi bi-clock-history mr-1"></i>Menunggu Verifikasi
                            </span>
                        </div>
                        <div class="action-buttons">
                            <a href="<?= base_url('admin/users/verify_petani/' . $p['id_user']); ?>" class="btn-verify" onclick="return confirm('Verifikasi akun petani ini?')">
                                <i class="bi bi-check-circle"></i>Verifikasi
                            </a>
                            <a href="<?= base_url('admin/users/reject_petani/' . $p['id_user']); ?>" class="btn-reject" onclick="return confirm('Tolak akun petani ini?')">
                                <i class="bi bi-x-circle"></i>Tolak
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-inbox"></i>
                </div>
                <h5 style="font-weight: 700; color: var(--dark-coffee); margin-bottom: 10px;">Tidak Ada Petani yang Menunggu Verifikasi</h5>
                <p>Semua akun petani sudah diverifikasi. Periksa kembali nanti untuk petani baru yang mendaftar.</p>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
