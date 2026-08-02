<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?> - Liberchain</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --roasted-brown: #4A2C11;
            --dark-coffee: #2C1808;
            --amber-cream: #E6A15C;
            --bg-cream: #FAF6F0;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #FAF6F0 0%, #e8e0d8 100%);
            min-height: 100vh;
            padding: 20px 0;
        }
        .card-custom {
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(44,24,8,0.12);
            border: 1px solid rgba(74,44,17,0.08);
            background: #FFFFFF;
        }
        .card-header-custom {
            background: linear-gradient(135deg, var(--dark-coffee), var(--roasted-brown));
            padding: 24px 30px;
            border-bottom: 3px solid var(--amber-cream);
        }
        .card-header-custom h4 {
            color: white;
            font-weight: 800;
            margin: 0;
        }
        .status-badge {
            font-size: 1.1rem;
            padding: 8px 16px;
            border-radius: 10px;
            font-weight: 600;
        }
        .timeline {
            position: relative;
            padding-left: 30px;
        }
        .timeline-item {
            position: relative;
            padding-bottom: 20px;
            border-left: 2px solid var(--amber-cream);
            padding-left: 20px;
        }
        .timeline-item:last-child {
            border-left: 2px solid transparent;
        }
        .timeline-dot {
            position: absolute;
            left: -9px;
            top: 0;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: var(--amber-cream);
            border: 3px solid white;
            box-shadow: 0 0 0 2px var(--amber-cream);
        }
        .timeline-date {
            font-size: 0.85rem;
            color: #999;
        }
        .btn-coklat {
            background: var(--roasted-brown);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px 24px;
            font-weight: 700;
            text-decoration: none;
            display: inline-block;
        }
        .btn-coklat:hover {
            background: var(--dark-coffee);
            color: white;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            
            <!-- Header -->
            <div class="card card-custom mb-3">
                <div class="card-header-custom">
                    <h4>Detail Pesanan</h4>
                    <p class="mb-0" style="color: rgba(255,255,255,0.7);">Invoice: <?= $transaksi['invoice']; ?></p>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Nama Penerima:</strong> <?= $transaksi['nama_penerima']; ?></p>
                            <p><strong>Alamat:</strong> <?= $transaksi['alamat_kirim']; ?></p>
                            <p><strong>Kota:</strong> <?= $transaksi['kota_kirim']; ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>No. HP:</strong> <?= $transaksi['no_hp']; ?></p>
                            <p><strong>Tanggal:</strong> <?= date('d/m/Y H:i', strtotime($transaksi['tanggal_transaksi'])); ?></p>
                            <p><strong>Total:</strong> Rp <?= number_format($transaksi['grand_total'], 0, ',', '.'); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Tracking -->
            <div class="card card-custom mb-3">
                <div class="card-body p-4">
                    <h5 class="font-weight-bold mb-3" style="color: var(--dark-coffee);">
                        <i class="bi bi-truck mr-2"></i> Status Pengiriman
                    </h5>
                    
                    <?php if ($tracking): ?>
                        <div class="text-center mb-4">
                            <span class="status-badge badge-<?= $status_info['class'] ?? 'secondary'; ?>">
                                <?= $status_info['label'] ?? 'Pending'; ?>
                            </span>
                        </div>

                        <?php if (!empty($tracking->tanggal_kirim)): ?>
                            <p><i class="bi bi-calendar-check mr-2"></i> <strong>Tanggal Kirim:</strong> <?= date('d/m/Y H:i', strtotime($tracking->tanggal_kirim)); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($tracking->estimasi_tiba)): ?>
                            <p><i class="bi bi-clock mr-2"></i> <strong>Estimasi Tiba:</strong> <?= date('d/m/Y H:i', strtotime($tracking->estimasi_tiba)); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($tracking->tanggal_terima)): ?>
                            <p><i class="bi bi-check-circle mr-2"></i> <strong>Diterima:</strong> <?= date('d/m/Y H:i', strtotime($tracking->tanggal_terima)); ?></p>
                        <?php endif; ?>
                    <?php else: ?>
                        <p class="text-muted">Belum ada informasi tracking untuk pesanan ini.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- History -->
            <?php if (!empty($history)): ?>
            <div class="card card-custom mb-3">
                <div class="card-body p-4">
                    <h5 class="font-weight-bold mb-3" style="color: var(--dark-coffee);">
                        <i class="bi bi-clock-history mr-2"></i> Riwayat Status
                    </h5>
                    <div class="timeline">
                        <?php foreach ($history as $h): ?>
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <strong><?= ucfirst($h->status ?? ''); ?></strong>
                                <div class="timeline-date">
                                    <?= date('d/m/Y H:i', strtotime($h->created_at ?? '')); ?>
                                </div>
                                <?php if (!empty($h->keterangan)): ?>
                                    <p class="mb-0"><?= $h->keterangan; ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Actions -->
            <div class="text-center">
                <a href="<?= base_url('guest/tracking'); ?>" class="btn-coklat">
                    <i class="bi bi-arrow-left mr-2"></i> Cek Pesanan Lain
                </a>
            </div>

        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>