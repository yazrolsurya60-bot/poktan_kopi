<!-- STYLE KHUSUS KOMPONEN DASHBOARD -->
<style>
    .action-card { background: var(--card-white); border: 1px solid rgba(74, 44, 17, 0.06); border-radius: var(--radius-card); padding: 18px 22px; display: flex; align-items: center; color: var(--dark-coffee); font-weight: 600; font-size: 0.9rem; text-decoration: none; transition: var(--transition-smooth); box-shadow: var(--shadow-soft); position: relative; overflow: hidden; }
    .action-card::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, var(--amber-cream), transparent); opacity: 0; transition: var(--transition-smooth); }
    .action-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-hover); border-color: transparent; text-decoration: none; color: var(--dark-coffee); }
    .action-card:hover::after { opacity: 1; }
    .action-icon { width: 44px; height: 44px; border-radius: 10px; background: #FDF5ED; color: var(--amber-cream); display: flex; align-items: center; justify-content: center; margin-right: 15px; font-size: 1.2rem; transition: var(--transition-smooth); }
    .action-card:hover .action-icon { background: var(--amber-cream); color: white; transform: scale(1.05); }
    
    .stat-box { background: var(--card-white); border: 1px solid rgba(74, 44, 17, 0.06); border-radius: var(--radius-card); padding: 22px 24px; position: relative; box-shadow: var(--shadow-soft); transition: var(--transition-smooth); overflow: hidden; height: 100%; min-height: 130px; display: flex; flex-direction: column; justify-content: space-between; }
    .stat-box:hover { transform: translateY(-3px); box-shadow: var(--shadow-hover); }
    .stat-box .stat-decoration { position: absolute; right: -20px; top: -20px; width: 80px; height: 80px; border-radius: 50%; background: rgba(230, 161, 92, 0.05); pointer-events: none; }
    .stat-title { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; color: var(--text-secondary); letter-spacing: 0.7px; line-height: 1.3; }
    .stat-num { font-size: 1.6rem; font-weight: 700; margin-top: 4px; margin-bottom: 0; color: var(--dark-coffee); line-height: 1.2; }
    .stat-change { font-size: 0.75rem; font-weight: 600; margin-top: 4px; }
    .stat-change.up { color: #10b981; }
    .stat-change.down { color: #EF4444; }
    .stat-badge { position: absolute; right: 20px; top: 20px; width: 42px; height: 42px; border-radius: 12px; background: var(--bg-cream); display: flex; align-items: center; justify-content: center; font-size: 1.1rem; color: var(--roasted-brown); transition: var(--transition-smooth); }
    .stat-box:hover .stat-badge { transform: scale(1.05) rotate(-3deg); }
    
    .custom-card { background: var(--card-white); border: 1px solid rgba(74, 44, 17, 0.06); border-radius: var(--radius-card); box-shadow: var(--shadow-soft); transition: var(--transition-smooth); overflow: hidden; height: 100%; }
    .custom-card:hover { box-shadow: var(--shadow-hover); }
    .custom-card .card-header-custom { padding: 18px 24px; border-bottom: 1px solid rgba(74, 44, 17, 0.06); display: flex; align-items: center; justify-content: space-between; }
    .custom-card .card-header-custom h6 { font-weight: 700; color: var(--dark-coffee); margin: 0; font-size: 0.85rem; }
    .custom-card .card-body-custom { padding: 24px; }
    .chart-container { position: relative; height: 250px; width: 100%; }
    
    .table-custom { font-size: 0.85rem; }
    .table-custom thead th { border-bottom: 2px solid rgba(74, 44, 17, 0.06); color: var(--text-secondary); font-weight: 600; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; padding: 10px 8px; white-space: nowrap; }
    .table-custom tbody td { padding: 10px 8px; border-bottom: 1px solid rgba(74, 44, 17, 0.04); vertical-align: middle; white-space: nowrap; }
    
    .status-badge { padding: 4px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: 600; display: inline-block; }
    .status-badge.pending { background: #FEF3C7; color: #92400E; }
    .status-badge.processing { background: #DBEAFE; color: #1E40AF; }
    .status-badge.complete { background: #D1FAE5; color: #065F46; }
    .status-badge.stok_aman { background: #D1FAE5; color: #065F46; }
    .status-badge.stok_tipis { background: #FEF3C7; color: #92400E; }
    .status-badge.stok_habis { background: #FEE2E2; color: #991B1B; }

    .quick-action-btn { padding: 12px 16px; border: 1px solid rgba(74, 44, 17, 0.06); border-radius: 10px; background: var(--card-white); color: var(--dark-coffee); transition: var(--transition-smooth); display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 0.85rem; text-decoration: none; box-shadow: var(--shadow-soft); }
    .quick-action-btn:hover { background: var(--bg-cream); border-color: var(--amber-cream); transform: translateY(-2px); box-shadow: var(--shadow-hover); text-decoration: none; color: var(--dark-coffee); }
    .quick-action-btn .q-icon { width: 38px; height: 38px; border-radius: 10px; background: rgba(230, 161, 92, 0.1); display: flex; align-items: center; justify-content: center; font-size: 1.1rem; color: var(--amber-cream); transition: var(--transition-smooth); flex-shrink: 0; }
    .quick-action-btn:hover .q-icon { background: var(--amber-cream); color: white; }
    .quick-action-btn .q-text { flex: 1; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

    @media (max-width: 991.98px) {
        .stat-num { font-size: 1.35rem; }
        .chart-container { height: 200px; }
    }
    @media (max-width: 575.98px) {
        .stat-box { padding: 16px; min-height: 110px; }
        .stat-num { font-size: 1.15rem; }
        .custom-card .card-body-custom { padding: 16px; }
        .quick-action-btn { padding: 8px 10px; font-size: 0.75rem; gap: 8px; }
        .quick-action-btn .q-icon { width: 28px; height: 28px; font-size: 0.8rem; }
    }
</style>

<!-- QUICK ACTION BUTTONS -->
<h5 class="font-weight-bold mb-3 mt-2" style="font-size: 0.75rem; color: var(--text-secondary); letter-spacing: 0.7px; text-transform: uppercase;">
    <i class="bi bi-lightning-fill text-warning mr-1"></i> Aksi Cepat
</h5>
<div class="row mb-4">
    <div class="col-lg-3 col-md-4 col-6 mb-3">
        <a href="<?= base_url('petani/lahan/tambah'); ?>" class="quick-action-btn">
            <div class="q-icon"><i class="bi bi-geo-alt-fill"></i></div>
            <span class="q-text">Tambah Lahan</span>
            <i class="bi bi-chevron-right q-arrow"></i>
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6 mb-3">
        <a href="<?= base_url('petani/panen/tambah'); ?>" class="quick-action-btn">
            <div class="q-icon"><i class="bi bi-calendar-plus-fill"></i></div>
            <span class="q-text">Input Panen</span>
            <i class="bi bi-chevron-right q-arrow"></i>
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6 mb-3">
        <a href="<?= base_url('petani/produk/tambah'); ?>" class="quick-action-btn">
            <div class="q-icon"><i class="bi bi-plus-circle-fill"></i></div>
            <span class="q-text">Tambah Produk</span>
            <i class="bi bi-chevron-right q-arrow"></i>
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6 mb-3">
        <a href="<?= base_url('petani/transaksi'); ?>" class="quick-action-btn">
            <div class="q-icon"><i class="bi bi-box-seam-fill"></i></div>
            <span class="q-text">Proses Pesanan</span>
            <i class="bi bi-chevron-right q-arrow"></i>
        </a>
    </div>
</div>

<!-- KPI CARDS -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-box">
            <div class="stat-decoration"></div>
            <div class="stat-title">Total Hasil Panen</div>
            <h3 class="stat-num"><?= number_format($kpi_total_panen ?? 0, 0, ',', '.'); ?> Kg</h3>
            <div class="stat-change up"><i class="bi bi-arrow-up"></i> Data real-time</div>
            <div class="stat-badge" style="background: var(--amber-cream); color: white;"><i class="bi bi-archive-fill"></i></div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-box">
            <div class="stat-decoration"></div>
            <div class="stat-title">Omset Penjualan</div>
            <h3 class="stat-num">Rp <?= number_format($kpi_omset_penjualan ?? 0, 0, ',', '.'); ?></h3>
            <div class="stat-change up"><i class="bi bi-arrow-up"></i> Data real-time</div>
            <div class="stat-badge" style="background: #059669; color: white;"><i class="bi bi-cash-stack"></i></div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-box">
            <div class="stat-decoration"></div>
            <div class="stat-title">Lahan Aktif</div>
            <h3 class="stat-num"><?= $kpi_lahan_aktif ?? 0; ?> Kebun</h3>
            <div class="stat-change up"><i class="bi bi-arrow-up"></i> Data real-time</div>
            <div class="stat-badge"><i class="bi bi-globe-asia-australia"></i></div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-box">
            <div class="stat-decoration"></div>
            <div class="stat-title">Pesanan Masuk</div>
            <h3 class="stat-num"><?= $kpi_pesanan_masuk ?? 0; ?> Pesanan</h3>
            <div class="stat-change up"><i class="bi bi-arrow-up"></i> Data real-time</div>
            <div class="stat-badge" style="background: var(--dark-coffee); color: white;"><i class="bi bi-cart-fill"></i></div>
        </div>
    </div>
</div>

<!-- GRAFIK & PRODUK -->
<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="custom-card">
            <div class="card-header-custom">
                <h6><i class="bi bi-graph-up-arrow text-warning mr-2"></i> Grafik Hasil Panen Bulanan</h6>
                <div>
                    <span class="badge" style="background: var(--bg-cream); color: var(--text-secondary); font-weight:500;"><?= date('Y'); ?></span>
                    <button class="btn btn-sm btn-link text-muted" onclick="refreshChart()" style="padding:0 4px;">
                        <i class="bi bi-arrow-repeat"></i>
                    </button>
                </div>
            </div>
            <div class="card-body-custom">
                <div class="chart-container">
                    <canvas id="harvestChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="custom-card">
            <div class="card-header-custom">
                <h6><i class="bi bi-trophy-fill text-warning mr-2"></i> Produk Terjual</h6>
                <span class="badge" style="background: #D1FAE5; color: #065F46; font-weight:500;">Top 5</span>
            </div>
            <div class="card-body-custom" style="padding: 16px 20px;">
                <?php if (!empty($produk_terjual)): ?>
                    <?php foreach ($produk_terjual as $index => $product): ?>
                        <div class="d-flex align-items-center justify-content-between py-2 <?= $index < count($produk_terjual) - 1 ? 'border-bottom' : ''; ?>" style="border-color: rgba(74,44,17,0.05);">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge" style="background: <?= $index === 0 ? 'var(--amber-cream)' : 'var(--bg-cream)'; ?>; color: <?= $index === 0 ? 'white' : 'var(--text-secondary)'; ?>; width: 24px; height:24px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:0.7rem;">
                                    <?= $index + 1; ?>
                                </span>
                                <span style="font-weight:600; font-size:0.85rem;"><?= $product['nama'] ?? $product['nama_produk']; ?></span>
                            </div>
                            <div class="text-right">
                                <span style="font-weight:600; font-size:0.85rem;"><?= number_format($product['total_terjual'] ?? 0, 0, ',', '.'); ?> kg</span>
                                <small class="d-block text-muted" style="font-size:0.7rem;">Rp <?= number_format($product['pendapatan'] ?? 0, 0, ',', '.'); ?></small>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-3 text-muted">Belum ada data produk terjual</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- PESANAN MASUK & STOK -->
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="custom-card">
            <div class="card-header-custom">
                <h6><i class="bi bi-cart-fill text-success mr-2"></i> Pesanan Masuk Terbaru</h6>
                <a href="<?= base_url('petani/transaksi'); ?>" class="text-muted" style="font-size:0.75rem;">Lihat semua <i class="bi bi-chevron-right"></i></a>
            </div>
            <div class="card-body-custom" style="padding:0;">
                <div class="table-responsive">
                    <table class="table table-custom mb-0">
                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Produk</th>
                                <th>Qty</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pesanan_masuk)): ?>
                                <?php foreach ($pesanan_masuk as $order): ?>
                                    <tr>
                                        <td><b>#<?= $order['invoice'] ?? 'INV-001'; ?></b></td>
                                        <td><?= $order['nama_produk'] ?? 'Produk'; ?></td>
                                        <td><span class="badge" style="background: var(--bg-cream); color: var(--dark-coffee);"><?= $order['qty'] ?? '0'; ?> kg</span></td>
                                        <td><span class="status-badge <?= strtolower($order['status_pesanan'] ?? 'pending'); ?>"><?= ucfirst($order['status_pesanan'] ?? 'Pending'); ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-3 text-muted">Belum ada pesanan masuk</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="custom-card">
            <div class="card-header-custom">
                <h6><i class="bi bi-bell-fill text-warning mr-2"></i> Peringatan Stok</h6>
                <span class="badge" style="background: #FEF3C7; color: #92400E; font-weight:500;">Perlu Diisi</span>
            </div>
            <div class="card-body-custom" style="padding:0;">
                <div class="table-responsive">
                    <table class="table table-custom mb-0">
                        <thead>
                            <tr>
                                <th>Nama Komoditas</th>
                                <th>Sisa Stok</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($notif_stok_tipis)): ?>
                                <?php foreach ($notif_stok_tipis as $stok): ?>
                                    <tr>
                                        <td><b><?= $stok['nama_produk'] ?? 'Produk'; ?></b></td>
                                        <td><span style="font-weight:600;"><?= $stok['stok_produk'] ?? 0; ?> kg</span></td>
                                        <td>
                                            <?php
                                            $stok_value = $stok['stok_produk'] ?? 0;
                                            if ($stok_value <= 0) {
                                                $status_class = 'stok_habis'; $status_text = 'Habis';
                                            } elseif ($stok_value < 20) {
                                                $status_class = 'stok_tipis'; $status_text = 'Menipis';
                                            } else {
                                                $status_class = 'stok_aman'; $status_text = 'Aman';
                                            }
                                            ?>
                                            <span class="status-badge <?= $status_class; ?>"><?= $status_text; ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center py-3 text-muted">Semua stok aman</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- RINGKASAN PRODUK & SETTING NOTIFIKASI -->
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="custom-card">
            <div class="card-header-custom">
                <h6><i class="bi bi-box-seam-fill text-warning mr-2"></i> Ringkasan Produk</h6>
                <span class="badge" style="background: var(--bg-cream); color: var(--text-secondary); font-weight:500;">Stok & Harga</span>
            </div>
            <div class="card-body-custom">
                <?php
                $id_user_query = $id_user ?? $this->session->userdata('id_user');
                $this->db->where('id_user', $id_user_query);
                $this->db->limit(3);
                $this->db->order_by('id_produk', 'DESC');
                $produk_terbaru = $this->db->get('tb_produk')->result_array();
                ?>
                <?php if (!empty($produk_terbaru)): ?>
                    <?php foreach ($produk_terbaru as $p): ?>
                        <div class="d-flex align-items-center justify-content-between py-2 border-bottom" style="border-color: rgba(74,44,17,0.05);">
                            <div>
                                <span style="font-weight:600; font-size:0.85rem;"><?= $p['nama_produk'] ?? 'Produk' ?></span>
                                <div style="font-size:0.75rem; color: var(--text-secondary);">
                                    <i class="bi bi-tag mr-1"></i> Rp <?= number_format($p['harga'] ?? 0, 0, ',', '.') ?>
                                    <span class="mx-1">•</span>
                                    <i class="bi bi-box mr-1"></i> <?= $p['stok_produk'] ?? 0 ?> kg
                                </div>
                            </div>
                            <?php
                            $stok = $p['stok_produk'] ?? 0;
                            if ($stok <= 0) { $badge_class = 'danger'; $badge_text = 'Habis'; } 
                            elseif ($stok < 20) { $badge_class = 'warning'; $badge_text = 'Menipis'; } 
                            else { $badge_class = 'success'; $badge_text = 'Aman'; }
                            ?>
                            <span class="badge" style="background: <?= $badge_class == 'danger' ? '#FEE2E2' : ($badge_class == 'warning' ? '#FEF3C7' : '#D1FAE5') ?>; color: <?= $badge_class == 'danger' ? '#991B1B' : ($badge_class == 'warning' ? '#92400E' : '#065F46') ?>; padding: 4px 12px; border-radius: 20px; font-weight:600; font-size:0.7rem;">
                                <?= $badge_text ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-3 text-muted">
                        <i class="bi bi-box-seam d-block mb-2" style="font-size:2rem;"></i>
                        <p>Belum ada produk. <a href="<?= base_url('petani/produk/tambah'); ?>" style="color: var(--amber-cream); font-weight:600;">Tambahkan produk pertama</a></p>
                    </div>
                <?php endif; ?>
                <div class="mt-3 text-center">
                    <a href="<?= base_url('petani/produk'); ?>" class="btn btn-sm" style="background: var(--bg-cream); color: var(--dark-coffee); border-radius:8px; font-weight:600; padding: 6px 20px;">
                        <i class="bi bi-arrow-right mr-1"></i> Kelola Semua Produk
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="custom-card">
            <div class="card-header-custom">
                <h6><i class="bi bi-gear-fill text-secondary mr-2"></i> Preferensi Notifikasi</h6>
                <span class="badge" style="background: var(--bg-cream); color: var(--text-secondary); font-weight:500;">Pengaturan</span>
            </div>
            <div class="card-body-custom">
                <?php
                $default_settings = ['notif_transaksi' => 1, 'notif_pembayaran' => 1, 'notif_stok' => 1, 'notif_kurir' => 1, 'notif_panen' => 0, 'notif_laporan' => 0, 'notif_sistem' => 1];
                if (!empty($settings)) {
                    foreach ($default_settings as $key => $value) {
                        if (isset($settings[$key])) { $default_settings[$key] = (int)$settings[$key]; }
                    }
                }
                ?>
                <form method="POST" action="<?= base_url('petani/dashboard/settings'); ?>" id="settingsForm">
                    <div class="row">
                        <?php 
                        $fields = [
                            'notif_transaksi' => 'Pesanan Baru', 'notif_pembayaran' => 'Konfirmasi Bayar', 
                            'notif_stok' => 'Peringatan Stok', 'notif_kurir' => 'Status Kiriman', 
                            'notif_sistem' => 'Update Sistem'
                        ];
                        foreach($fields as $id => $label): ?>
                        <div class="col-md-6 col-6 mb-2">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="<?= $id; ?>" name="<?= $id; ?>" <?= $default_settings[$id] == 1 ? 'checked' : ''; ?>>
                                <label class="custom-control-label" for="<?= $id; ?>" style="font-size:0.85rem;"><?= $label; ?></label>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="mt-3 pt-2 border-top" style="border-color: rgba(74,44,17,0.06);">
                        <button type="submit" class="btn" style="background: var(--roasted-brown); color: white; border-radius:10px; padding: 8px 24px; font-weight:600; font-size:0.85rem;">
                            <i class="bi bi-save mr-1"></i> Simpan Pengaturan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT KHUSUS DASHBOARD (Dieksekusi setelah JQuery load dari Head) -->
<script>
    let harvestChart;
    function initChart() {
        const ctx = document.getElementById('harvestChart')?.getContext('2d');
        if (!ctx) return;
        const chartLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
        const chartData = <?= isset($grafik_panen['values']) ? json_encode($grafik_panen['values']) : json_encode(array_fill(0, 12, 0)); ?>;

        harvestChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [{ label: 'Hasil Panen (Kg)', data: chartData, backgroundColor: 'rgba(230, 161, 92, 0.8)', borderColor: '#E6A15C', borderWidth: 2, borderRadius: 6, barPercentage: 0.6 }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { backgroundColor: '#2C1808', titleColor: '#E6A15C', bodyColor: '#FAF6F0', cornerRadius: 8, padding: 10, callbacks: { label: function(context) { return context.parsed.y.toLocaleString('id-ID') + ' kg'; } } }
                },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(74, 44, 17, 0.06)', drawBorder: false }, ticks: { font: { size: 10, family: 'Plus Jakarta Sans' }, color: '#70655E', stepSize: 50, callback: function(value) { return value.toLocaleString('id-ID') + ' kg'; } } },
                    x: { grid: { display: false }, ticks: { font: { size: 10, family: 'Plus Jakarta Sans' }, color: '#70655E' } }
                }
            }
        });
    }

    function refreshChart() {
        if (harvestChart) {
            $.get('<?= base_url('petani/dashboard/get_chart_data'); ?>', function(data) {
                if (data.success) {
                    harvestChart.data.datasets[0].data = data.values; harvestChart.update();
                    if(typeof showToast === 'function') showToast('Grafik berhasil diperbarui!', 'success');
                }
            }).fail(function() {
                if(typeof showToast === 'function') showToast('Gagal memperbarui grafik.', 'error');
            });
        }
    }

    document.querySelectorAll('.custom-control-input').forEach(function(switchEl) {
        switchEl.addEventListener('change', function() {
            const field = this.getAttribute('id');
            const value = this.checked ? 1 : 0;
            const allowedFields = ['notif_transaksi', 'notif_pembayaran', 'notif_stok', 'notif_kurir', 'notif_panen', 'notif_laporan', 'notif_sistem'];
            if (!allowedFields.includes(field)) return;

            const label = this.closest('.custom-control').querySelector('.custom-control-label');
            if (label) label.style.opacity = '0.5';

            $.ajax({
                url: '<?= base_url('petani/dashboard/update_settings_ajax'); ?>',
                type: 'POST',
                data: { field: field, value: value },
                dataType: 'json',
                success: function(response) {
                    if (label) label.style.opacity = '1';
                    if (response.success) {
                        const labelText = label ? label.textContent.trim() : field;
                        if(typeof showToast === 'function') showToast('✅ ' + labelText + ' ' + (value === 1 ? 'diaktifkan' : 'dinonaktifkan'), 'success');
                    } else {
                        this.checked = !this.checked;
                        if(typeof showToast === 'function') showToast('❌ Gagal memperbarui pengaturan', 'error');
                    }
                }.bind(this),
                error: function() {
                    if (label) label.style.opacity = '1'; this.checked = !this.checked;
                    if(typeof showToast === 'function') showToast('❌ Terjadi kesalahan. Silakan coba lagi.', 'error');
                }.bind(this)
            });
        });
    });

    const settingsForm = document.getElementById('settingsForm');
    if (settingsForm) {
        settingsForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const data = {};
            formData.forEach((value, key) => { data[key] = value === 'on' ? 1 : 0; });
            const btn = this.querySelector('button[type="submit"]');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="bi bi-hourglass-split mr-1"></i> Menyimpan...'; btn.disabled = true;

            $.ajax({
                url: this.action, type: 'POST', data: data, dataType: 'json',
                success: function(response) {
                    btn.innerHTML = originalText; btn.disabled = false;
                    if (response.success) {
                        if(typeof showToast === 'function') showToast('✅ Pengaturan notifikasi berhasil diperbarui!', 'success');
                        Object.keys(data).forEach(key => { const el = document.getElementById(key); if (el) el.checked = data[key] === 1; });
                    } else { if(typeof showToast === 'function') showToast('❌ Gagal memperbarui pengaturan', 'error'); }
                },
                error: function() {
                    btn.innerHTML = originalText; btn.disabled = false;
                    if(typeof showToast === 'function') showToast('❌ Terjadi kesalahan. Silakan coba lagi.', 'error');
                }
            });
        });
    }

    document.addEventListener('DOMContentLoaded', function() { initChart(); });
</script>