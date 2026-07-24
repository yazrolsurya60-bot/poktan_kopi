<style>
    /* STYLING ASLI KHUSUS KONTEN DASHBOARD PEMBELI */
    .quick-action-btn {
        padding: 10px 16px;
        border: 1px solid rgba(74, 44, 17, 0.06);
        border-radius: 10px;
        background: var(--card-white);
        color: var(--dark-coffee);
        transition: var(--transition-smooth);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        width: 100%;
        text-decoration: none;
        text-align: center;
    }
    .quick-action-btn:hover {
        background: var(--bg-cream);
        border-color: var(--amber-cream);
        transform: translateY(-2px);
        box-shadow: var(--shadow-soft);
        text-decoration: none;
        color: var(--dark-coffee);
    }
    .quick-action-btn i {
        font-size: 1.1rem;
        color: var(--amber-cream);
    }

    .stat-box {
        background: var(--card-white);
        border: 1px solid rgba(74, 44, 17, 0.06);
        border-radius: var(--radius-card);
        padding: 22px 24px;
        position: relative;
        box-shadow: var(--shadow-soft);
        transition: var(--transition-smooth);
        overflow: hidden;
        height: 100%;
        min-height: 130px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .stat-box:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-hover);
    }
    .stat-box .stat-decoration {
        position: absolute;
        right: -20px;
        top: -20px;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(230, 161, 92, 0.05);
        pointer-events: none;
    }
    .stat-title {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--text-secondary);
        letter-spacing: 0.7px;
        margin-bottom: 4px;
    }
    .stat-number {
        font-size: 1.6rem;
        font-weight: 700;
        margin: 4px 0 2px;
        color: var(--dark-coffee);
        line-height: 1.2;
        word-break: break-word;
        padding-right: 10px;
    }
    .stat-change {
        font-size: 0.7rem;
        font-weight: 600;
        margin-top: 4px;
    }
    .stat-change.up { color: #10b981; }
    .stat-change.down { color: #EF4444; }

    .stat-badge {
        position: absolute;
        right: 20px;
        top: 20px;
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: var(--bg-cream);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        color: var(--roasted-brown);
        transition: var(--transition-smooth);
    }
    .stat-box:hover .stat-badge {
        transform: scale(1.05) rotate(-3deg);
    }

    .custom-card {
        background: var(--card-white);
        border: 1px solid rgba(74, 44, 17, 0.06);
        border-radius: var(--radius-card);
        box-shadow: var(--shadow-soft);
        transition: var(--transition-smooth);
        overflow: hidden;
        height: 100%;
    }
    .custom-card:hover {
        box-shadow: var(--shadow-hover);
    }
    .custom-card .card-header-custom {
        padding: 18px 24px;
        border-bottom: 1px solid rgba(74, 44, 17, 0.06);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .custom-card .card-header-custom h6 {
        font-weight: 700;
        color: var(--dark-coffee);
        margin: 0;
        font-size: 0.85rem;
    }
    .custom-card .card-body-custom {
        padding: 24px;
    }

    .chart-container {
        position: relative;
        height: 220px;
        width: 100%;
    }

    .table-custom {
        font-size: 0.85rem;
    }
    .table-custom thead th {
        border-bottom: 2px solid rgba(74, 44, 17, 0.06);
        color: var(--text-secondary);
        font-weight: 600;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 10px;
        white-space: nowrap;
    }
    .table-custom tbody td {
        padding: 10px 10px;
        border-bottom: 1px solid rgba(74, 44, 17, 0.04);
        vertical-align: middle;
        white-space: nowrap;
    }
    .table-custom tbody tr:hover {
        background: rgba(250, 246, 240, 0.3);
    }

    .status-badge {
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        display: inline-block;
    }
    .status-badge.pending { background: #FEF3C7; color: #92400E; }
    .status-badge.processing { background: #DBEAFE; color: #1E40AF; }
    .status-badge.shipped, .status-badge.dikirim { background: #EDE9FE; color: #5B21B6; }
    .status-badge.complete, .status-badge.selesai { background: #D1FAE5; color: #065F46; }
    .status-badge.cancelled, .status-badge.dibatalkan { background: #FEE2E2; color: #991B1B; }

    .rec-product-card {
        background: #FFF;
        border: 1px solid rgba(74, 44, 17, 0.08);
        border-radius: 12px;
        transition: all 0.3s ease;
        height: 100%;
        padding: 16px;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .rec-product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(44, 24, 8, 0.08);
        border-color: var(--amber-cream) !important;
    }
    .rec-product-img-box {
        height: 140px;
        border-radius: 10px;
        overflow: hidden;
        background: #fafaf5;
        border: 1px solid rgba(74, 44, 17, 0.04);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .rec-product-img-box img {
        height: 100%;
        width: 100%;
        object-fit: cover;
    }
    .rec-product-img-box i {
        font-size: 2.5rem;
        color: var(--amber-cream);
    }
    .rec-product-name {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--dark-coffee);
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 38px;
        line-height: 1.2;
        margin-top: 10px;
        margin-bottom: 4px;
    }
    .rec-product-price {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--amber-cream);
        margin-bottom: 4px;
    }
    .rec-product-rating {
        font-size: 0.7rem;
        color: #F59E0B;
        margin-bottom: 10px;
    }
    .rec-product-rating span {
        color: var(--text-secondary);
        font-weight: 400;
    }
    .btn-beli-rec {
        background: var(--amber-cream);
        color: white;
        border-radius: 8px;
        font-weight: 600;
        padding: 6px 16px;
        font-size: 0.75rem;
        transition: all 0.2s;
        display: inline-block;
        text-decoration: none;
        border: none;
        width: 100%;
    }
    .btn-beli-rec:hover {
        background: var(--roasted-brown);
        color: white;
        text-decoration: none;
    }
</style>

<!-- QUICK ACTION BUTTONS -->
<h5 class="font-weight-bold mb-3"
    style="font-size: 0.75rem; color: var(--text-secondary); letter-spacing: 0.7px; text-transform: uppercase;">
    <i class="bi bi-lightning-fill text-warning mr-1"></i> Aksi Cepat
</h5>
<div class="row mb-4">
    <div class="col-lg-3 col-md-4 col-6 mb-2">
        <a href="<?= base_url('landing/produk'); ?>" class="quick-action-btn">
            <i class="bi bi-bag-fill"></i> Belanja Sekarang
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6 mb-2">
        <a href="<?= base_url('pembeli/transaksi'); ?>" class="quick-action-btn">
            <i class="bi bi-clock-history"></i> Riwayat Pesanan
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6 mb-2">
        <a href="<?= base_url('pembeli/tracking'); ?>" class="quick-action-btn">
            <i class="bi bi-geo-alt-fill"></i> Lacak Kiriman
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6 mb-2">
        <a href="<?= base_url('pembeli/profil'); ?>" class="quick-action-btn">
            <i class="bi bi-person-fill"></i> Profil Saya
        </a>
    </div>
</div>

<!-- KPI CARDS -->
<div class="row mb-4">
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="stat-box">
            <div class="stat-decoration"></div>
            <div class="stat-title">Total Transaksi</div>
            <div class="stat-number"><?= $kpi_total_transaksi ?? 0; ?></div>
            <div class="stat-change up"><i class="bi bi-arrow-up"></i> Data real-time</div>
            <div class="stat-badge" style="background: #059669; color: white;">
                <i class="bi bi-receipt"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="stat-box">
            <div class="stat-decoration"></div>
            <div class="stat-title">Total Belanja</div>
            <div class="stat-number">Rp <?= number_format($kpi_total_belanja ?? 0, 0, ',', '.'); ?></div>
            <div class="stat-change up"><i class="bi bi-arrow-up"></i> Data real-time</div>
            <div class="stat-badge" style="background: var(--amber-cream); color: white;">
                <i class="bi bi-cash-stack"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="stat-box">
            <div class="stat-decoration"></div>
            <div class="stat-title">Pengiriman Aktif</div>
            <div class="stat-number"><?= $kpi_pesanan_dikirim ?? 0; ?></div>
            <div class="stat-change up"><i class="bi bi-arrow-up"></i> Data real-time</div>
            <div class="stat-badge" style="background: var(--dark-coffee); color: white;">
                <i class="bi bi-truck"></i>
            </div>
        </div>
    </div>
</div>

<!-- REKOMENDASI PRODUK -->
<div class="row mb-4">
    <div class="col-12">
        <div class="custom-card">
            <div class="card-header-custom">
                <h6><i class="bi bi-star-fill text-warning mr-2"></i> Rekomendasi Untuk Anda</h6>
                <span class="badge" style="background: var(--bg-cream); color: var(--text-secondary); font-weight:500;">Terpopuler</span>
            </div>
            <div class="card-body-custom">
                <div class="row">
                    <?php if (!empty($rekomendasi_produk)): ?>
                        <?php foreach ($rekomendasi_produk as $rec): ?>
                            <?php 
                            $rec = (array)$rec;
                            $id_produk = $rec['id_produk'] ?? 0;
                            $nama = $rec['nama_produk'] ?? 'Produk Kopi';
                            $harga = 'Rp ' . number_format($rec['harga'] ?? 0, 0, ',', '.') . '/kg';
                            $foto = !empty($rec['foto_utama']) ? base_url('uploads/produk/' . $rec['foto_utama']) : '';
                            
                            $seed = crc32($nama);
                            $rating_val = 4.0 + (($seed % 10) / 10);
                            $rating_stars = '';
                            for ($i = 1; $i <= 5; $i++) {
                                $rating_stars .= ($i <= round($rating_val)) ? '★' : '☆';
                            }
                            $terjual_val = ($seed % 200) + 15;
                            ?>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="rec-product-card">
                                    <div class="rec-product-img-box">
                                        <?php if ($foto): ?>
                                            <img src="<?= $foto ?>" alt="<?= htmlspecialchars($nama) ?>">
                                        <?php else: ?>
                                            <i class="bi bi-cup-hot"></i>
                                        <?php endif; ?>
                                    </div>
                                    <div class="rec-product-name"><?= htmlspecialchars($nama); ?></div>
                                    <div class="rec-product-price"><?= $harga; ?></div>
                                    <div class="rec-product-rating">
                                        <?= $rating_stars; ?> <span>(<?= $terjual_val; ?> kg terjual)</span>
                                    </div>
                                    <a href="<?= base_url('landing/produk/detail/' . $id_produk); ?>" class="btn-beli-rec">
                                        <i class="bi bi-cart-plus mr-1"></i> Beli
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12 text-center py-4 text-muted">
                            <i class="bi bi-box2" style="font-size: 2.5rem;"></i>
                            <p class="mt-2 mb-0 small">Belum ada rekomendasi produk saat ini.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- RIWAYAT TRANSAKSI & GRAFIK -->
<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="custom-card">
            <div class="card-header-custom">
                <h6><i class="bi bi-clock-history text-primary mr-2"></i> Riwayat Transaksi Terbaru</h6>
                <a href="<?= base_url('pembeli/transaksi'); ?>" class="text-muted" style="font-size:0.75rem;">
                    Lihat semua <i class="bi bi-chevron-right"></i>
                </a>
            </div>
            <div class="card-body-custom" style="padding:0;">
                <div class="table-responsive">
                    <table class="table table-custom mb-0">
                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pesanan_terbaru)): ?>
                                <?php foreach ($pesanan_terbaru as $trx): ?>
                                    <tr>
                                        <td><b>#<?= $trx['id_transaksi']; ?></b></td>
                                        <td>Rp <?= number_format($trx['grand_total'] ?? $trx['total_harga'] ?? 0, 0, ',', '.'); ?></td>
                                        <td>
                                            <span class="status-badge <?= strtolower($trx['status_pesanan'] ?? 'pending'); ?>">
                                                <?= ucfirst($trx['status_pesanan'] ?? 'Pending'); ?>
                                            </span>
                                        </td>
                                        <td><?= date('d M Y', strtotime($trx['tanggal_transaksi'] ?? date('Y-m-d'))); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-3 text-muted">Belum ada transaksi</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="custom-card">
            <div class="card-header-custom">
                <h6><i class="bi bi-graph-up-arrow text-warning mr-2"></i> Grafik Belanja</h6>
                <span class="badge" style="background: var(--bg-cream); color: var(--text-secondary); font-weight:500;"><?= date('Y'); ?></span>
            </div>
            <div class="card-body-custom">
                <div class="chart-container">
                    <canvas id="shoppingChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SETTING NOTIFIKASI -->
<div class="row">
    <div class="col-12">
        <div class="custom-card">
            <div class="card-header-custom">
                <h6><i class="bi bi-gear-fill text-secondary mr-2"></i> Preferensi Notifikasi</h6>
                <span class="badge" style="background: var(--bg-cream); color: var(--text-secondary); font-weight:500;">Pengaturan</span>
            </div>
            <div class="card-body-custom">
                <?php
                $default_settings = [
                    'notif_pesanan' => 1,
                    'notif_kurir' => 1,
                    'notif_pembayaran' => 1,
                    'notif_sistem' => 1
                ];

                if (!empty($settings)) {
                    foreach ($default_settings as $key => $value) {
                        if (isset($settings[$key])) {
                            $default_settings[$key] = $settings[$key];
                        }
                    }
                }
                ?>
                <form method="POST" action="<?= base_url('pembeli/dashboard/settings'); ?>">
                    <div class="row">
                        <div class="col-md-3 col-6 mb-2">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="notif_pesanan" name="notif_pesanan"
                                    <?= $default_settings['notif_pesanan'] == 1 ? 'checked' : ''; ?>>
                                <label class="custom-control-label" for="notif_pesanan" style="font-size:0.85rem;">Status Pesanan</label>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-2">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="notif_kurir" name="notif_kurir"
                                    <?= $default_settings['notif_kurir'] == 1 ? 'checked' : ''; ?>>
                                <label class="custom-control-label" for="notif_kurir" style="font-size:0.85rem;">Tracking Kiriman</label>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-2">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="notif_pembayaran" name="notif_pembayaran"
                                    <?= $default_settings['notif_pembayaran'] == 1 ? 'checked' : ''; ?>>
                                <label class="custom-control-label" for="notif_pembayaran" style="font-size:0.85rem;">Konfirmasi Bayar</label>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-2">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="notif_sistem" name="notif_sistem"
                                    <?= $default_settings['notif_sistem'] == 1 ? 'checked' : ''; ?>>
                                <label class="custom-control-label" for="notif_sistem" style="font-size:0.85rem;">Update Sistem</label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 pt-2 border-top" style="border-color: rgba(74,44,17,0.06);">
                        <button type="submit" class="btn"
                            style="background: var(--roasted-brown); color: white; border-radius:10px; padding: 8px 24px; font-weight:600; font-size:0.85rem;">
                            <i class="bi bi-save mr-1"></i> Simpan Pengaturan
                        </button>
                        <button type="button" class="btn btn-link text-muted" style="font-size:0.85rem;" onclick="markAllRead()">
                            <i class="bi bi-check2-all mr-1"></i> Tandai Semua Dibaca
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Inisialisasi Chart Grafik Belanja
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('shoppingChart')?.getContext('2d');
        if (ctx) {
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Liberika', 'Arabika', 'Robusta', 'Lainnya'],
                    datasets: [{
                        data: [40, 30, 20, 10],
                        backgroundColor: ['#E6A15C', '#4A2C11', '#2C1808', '#FAF6F0'],
                        borderColor: '#FFFFFF',
                        borderWidth: 2,
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: { size: 10, family: 'Plus Jakarta Sans' },
                                color: '#70655E',
                                padding: 12,
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        }
                    },
                    cutout: '70%'
                }
            });
        }
    });
</script>