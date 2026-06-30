<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail User - Sistem Supply Chain Kopi</title>
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

        .container-main {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .card-detail {
            background: var(--card-white);
            border: 1px solid rgba(74, 44, 17, 0.08);
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: var(--shadow-soft);
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--roasted-brown), var(--amber-cream));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            margin-bottom: 20px;
        }

        .detail-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 20px;
        }

        .detail-item {
            padding: 0;
        }

        .detail-label {
            font-weight: 600;
            color: var(--text-secondary);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .detail-value {
            font-size: 1rem;
            color: var(--dark-coffee);
            font-weight: 500;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
            margin-top: 10px;
        }

        .status-active {
            background: #DCFCE7;
            color: #166534;
        }

        .status-inactive {
            background: #FEE2E2;
            color: #7F1D1D;
        }

        .status-pending {
            background: #FEF3C7;
            color: #92400E;
        }

        .verified-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: #DCFCE7;
            color: #166534;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-left: 10px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-custom {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: var(--transition-smooth);
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-activate {
            background: #10B981;
            color: white;
        }

        .btn-activate:hover {
            background: #059669;
            transform: translateY(-2px);
            color: white;
        }

        .btn-deactivate {
            background: #EF4444;
            color: white;
        }

        .btn-deactivate:hover {
            background: #DC2626;
            transform: translateY(-2px);
            color: white;
        }

        .btn-back {
            background: transparent;
            color: var(--amber-cream);
            border: 2px solid var(--amber-cream);
        }

        .btn-back:hover {
            background: var(--amber-cream);
            color: white;
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
                <i class="bi bi-person-circle mr-2"></i>Detail User
            </h1>
        </div>
    </div>

    <div class="container-main">
        <a href="<?= base_url('admin/users'); ?>" class="back-link">
            <i class="bi bi-arrow-left"></i>Kembali ke Manajemen User
        </a>

        <div class="card-detail">
            <div class="user-avatar">
                <i class="bi bi-person-fill"></i>
            </div>

            <h2 style="font-weight: 700; color: var(--dark-coffee); margin-bottom: 5px;">
                <?= $user['nama']; ?>
                <?php if ($user['role'] === 'Petani' && $user['is_verified'] === '1'): ?>
                    <span class="verified-badge">
                        <i class="bi bi-check-circle-fill"></i> Terverifikasi
                    </span>
                <?php endif; ?>
            </h2>
            <p style="color: var(--text-secondary); margin-bottom: 20px;">
                <strong><?= ucfirst($user['role']); ?></strong> • Bergabung <?= date('d F Y', strtotime($user['created_at'])); ?>
            </p>

            <div class="detail-row">
                <div class="detail-item">
                    <div class="detail-label">Username</div>
                    <div class="detail-value"><?= $user['username']; ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Nama Lengkap</div>
                    <div class="detail-value"><?= $user['nama']; ?></div>
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-item">
                    <div class="detail-label">Email</div>
                    <div class="detail-value"><?= $user['email'] ?? 'N/A'; ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Nomor Telepon</div>
                    <div class="detail-value"><?= $user['no_telepon'] ?? 'N/A'; ?></div>
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-item">
                    <div class="detail-label">Role</div>
                    <div class="detail-value"><?= ucfirst($user['role']); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Status</div>
                    <div class="detail-value">
                        <?php if ($user['status'] === 'Active'): ?>
                            <span class="status-badge status-active">
                                <i class="bi bi-check-circle"></i> Aktif
                            </span>
                        <?php elseif ($user['status'] === 'Inactive'): ?>
                            <span class="status-badge status-inactive">
                                <i class="bi bi-x-circle"></i> Nonaktif
                            </span>
                        <?php else: ?>
                            <span class="status-badge status-pending">
                                <i class="bi bi-clock-history"></i> Menunggu
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-item">
                    <div class="detail-label">Tanggal Dibuat</div>
                    <div class="detail-value"><?= date('d F Y H:i', strtotime($user['created_at'])); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Terakhir Diperbarui</div>
                    <div class="detail-value"><?= date('d F Y H:i', strtotime($user['updated_at'])); ?></div>
                </div>
            </div>

            <?php if ($user['role'] === 'Petani'): ?>
                <div class="detail-row">
                    <div class="detail-item">
                        <div class="detail-label">Status Verifikasi Petani</div>
                        <div class="detail-value">
                            <?php if ($user['is_verified'] === '1'): ?>
                                <span class="status-badge status-active">
                                    <i class="bi bi-check-circle"></i> Terverifikasi
                                </span>
                            <?php else: ?>
                                <span class="status-badge status-inactive">
                                    <i class="bi bi-x-circle"></i> Belum Terverifikasi
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="action-buttons">
                <?php if ($user['status'] === 'Active'): ?>
                    <a href="<?= base_url('admin/users/deactivate/' . $user['id_user']); ?>" class="btn-custom btn-deactivate" onclick="return confirm('Nonaktifkan akun ini?')">
                        <i class="bi bi-toggle-off"></i> Nonaktifkan
                    </a>
                <?php else: ?>
                    <a href="<?= base_url('admin/users/activate/' . $user['id_user']); ?>" class="btn-custom btn-activate" onclick="return confirm('Aktifkan akun ini?')">
                        <i class="bi bi-toggle-on"></i> Aktifkan
                    </a>
                <?php endif; ?>
                <a href="<?= base_url('admin/users'); ?>" class="btn-custom btn-back">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
