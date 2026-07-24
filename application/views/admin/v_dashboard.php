<style>
/* ============================================ */
/* STYLING DASHBOARD */
/* ============================================ */

/* Aksi Cepat Grid */
.quick-actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 16px;
    margin-bottom: 24px;
}
.quick-action-btn {
    background: var(--card-white);
    border: 1px solid rgba(74, 44, 17, 0.06);
    border-radius: var(--radius-card);
    padding: 14px 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    color: var(--dark-coffee);
    font-weight: 600;
    font-size: 0.85rem;
    text-decoration: none;
    box-shadow: var(--shadow-soft);
    transition: var(--transition-smooth);
}
.quick-action-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-hover);
    color: var(--roasted-brown);
    text-decoration: none;
}
.quick-action-btn i {
    font-size: 1.1rem;
    color: var(--amber-cream);
}

/* KPI Grid & Cards */
.kpi-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    margin-bottom: 28px;
}
.kpi-card {
    background: var(--card-white);
    border-radius: var(--radius-card);
    padding: 22px 24px;
    border: 1px solid rgba(74, 44, 17, 0.06);
    box-shadow: var(--shadow-soft);
    position: relative;
    overflow: hidden;
    transition: var(--transition-smooth);
}
.kpi-card:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-hover);
}
.kpi-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}
.kpi-title {
    font-size: 0.72rem;
    font-weight: 700;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.6px;
}
.kpi-badge {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}
.kpi-badge.amber { background: rgba(230, 161, 92, 0.18); color: #c47b2a; }
.kpi-badge.blue  { background: rgba(59, 130, 246, 0.12); color: #2563eb; }
.kpi-badge.green { background: rgba(16, 185, 129, 0.12); color: #059669; }
.kpi-badge.dark  { background: rgba(44, 24, 8, 0.08);   color: var(--dark-coffee); }

.kpi-number {
    font-size: 1.8rem;
    font-weight: 800;
    color: var(--dark-coffee);
    line-height: 1.1;
    margin-bottom: 6px;
}
.kpi-footer .label {
    font-size: 0.75rem;
    color: var(--text-secondary);
}

/* Custom Cards */
.custom-card {
    background: var(--card-white);
    border-radius: var(--radius-card);
    border: 1px solid rgba(74, 44, 17, 0.06);
    box-shadow: var(--shadow-soft);
    overflow: hidden;
    height: 100%;
}
.card-header-custom {
    padding: 18px 22px;
    border-bottom: 1px solid rgba(74, 44, 17, 0.06);
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.card-header-custom h6 {
    margin: 0;
    font-weight: 700;
    font-size: 0.92rem;
    color: var(--dark-coffee);
    display: flex;
    align-items: center;
}
.card-body-custom {
    padding: 22px;
}

/* Tabel Custom */
.table-custom {
    margin: 0;
}
.table-custom thead th {
    border: none;
    border-bottom: 1px solid rgba(74, 44, 17, 0.06);
    color: var(--text-secondary);
    font-weight: 700;
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 12px 18px;
    background: transparent;
}
.table-custom tbody td {
    padding: 14px 18px;
    vertical-align: middle;
    border-top: none;
    border-bottom: 1px solid rgba(74, 44, 17, 0.04);
    font-size: 0.85rem;
    color: var(--dark-coffee);
}
.table-custom tbody tr:last-child td {
    border-bottom: none;
}

/* Status Badge */
.status-badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 0.72rem;
    font-weight: 700;
}
.status-badge.selesai, .status-badge.verified, .status-badge.active {
    background: #D1FAE5;
    color: #065F46;
}
.status-badge.pending, .status-badge.review {
    background: #FEF3C7;
    color: #92400E;
}

/* Chart Container */
.chart-container {
    position: relative;
    height: 300px;
    width: 100%;
}
</style>


<!-- ============================================ -->
<!-- QUICK ACTION BUTTONS -->
<!-- ============================================ -->
<h5 class="font-weight-bold mb-3"
	style="font-size: 0.75rem; color: var(--text-secondary); letter-spacing: 0.7px; text-transform: uppercase;">
	<i class="bi bi-lightning-fill text-warning mr-1"></i> Aksi Cepat
</h5>
<div class="quick-actions-grid">
	<a href="<?= base_url('admin/petani'); ?>" class="quick-action-btn">
		<i class="bi bi-person-check-fill"></i>
		<span class="btn-label">Verifikasi Petani</span>
	</a>
	<a href="<?= base_url('admin/transaksi/konfirmasi'); ?>" class="quick-action-btn">
		<i class="bi bi-credit-card-fill"></i>
		<span class="btn-label">Konfirmasi Bayar</span>
	</a>
	<a href="<?= base_url('admin/laporan'); ?>" class="quick-action-btn">
		<i class="bi bi-file-earmark-pdf-fill"></i>
		<span class="btn-label">Buat Laporan</span>
	</a>
	<a href="<?= base_url('admin/produk/tambah'); ?>" class="quick-action-btn">
		<i class="bi bi-plus-circle-fill"></i>
		<span class="btn-label">Tambah Produk</span>
	</a>
	<a href="<?= base_url('admin/mitra/add'); ?>" class="quick-action-btn">
		<i class="bi bi-shop"></i>
		<span class="btn-label">Tambah Mitra</span>
	</a>
</div>

<!-- ============================================ -->
<!-- KPI CARDS -->
<!-- ============================================ -->
<div class="kpi-grid">
	<!-- Total Pendapatan -->
	<div class="kpi-card">
		<div class="kpi-top">
			<span class="kpi-title">Total Pendapatan</span>
			<div class="kpi-badge amber">
				<i class="bi bi-currency-dollar"></i>
			</div>
		</div>
		<div class="kpi-number rupiah">Rp <?= number_format($kpi_total_revenue ?? 0, 0, ',', '.'); ?></div>
		<div class="kpi-footer">
			<span class="label">Akumulasi seluruh penjualan</span>
		</div>
	</div>

	<!-- Total Transaksi -->
	<div class="kpi-card">
		<div class="kpi-top">
			<span class="kpi-title">Total Transaksi</span>
			<div class="kpi-badge blue">
				<i class="bi bi-receipt"></i>
			</div>
		</div>
		<div class="kpi-number"><?= number_format($kpi_transaksi_aktif ?? 0, 0, ',', '.'); ?></div>
		<div class="kpi-footer">
			<span class="label">Semua status pesanan</span>
		</div>
	</div>

	<!-- Petani Aktif -->
	<div class="kpi-card">
		<div class="kpi-top">
			<span class="kpi-title">Petani Aktif</span>
			<div class="kpi-badge green">
				<i class="bi bi-people-fill"></i>
			</div>
		</div>
		<div class="kpi-number"><?= number_format($kpi_petani_terverifikasi ?? 0, 0, ',', '.'); ?></div>
		<div class="kpi-footer">
			<span class="label">Petani terverifikasi</span>
		</div>
	</div>

	<!-- Mitra Aktif -->
	<div class="kpi-card">
		<div class="kpi-top">
			<span class="kpi-title">Mitra Aktif</span>
			<div class="kpi-badge dark">
				<i class="bi bi-shop"></i>
			</div>
		</div>
		<div class="kpi-number"><?= number_format($kpi_mitra_cafe ?? 0, 0, ',', '.'); ?></div>
		<div class="kpi-footer">
			<span class="label">Kerjasama aktif</span>
		</div>
	</div>
</div>

<!-- ============================================ -->
<!-- GRAFIK & PRODUK TERLARIS -->
<!-- ============================================ -->
<div class="row">
	<div class="col-lg-8 mb-4">
		<div class="custom-card">
			<div class="card-header-custom">
				<h6><i class="bi bi-graph-up-arrow text-warning mr-2"></i> Grafik Penjualan Bulanan</h6>
				<div>
					<span class="badge" style="background: var(--bg-cream); color: var(--text-secondary); font-weight:500;"><?= date('Y'); ?></span>
					<button class="btn btn-sm btn-link text-muted" onclick="refreshChart()" style="padding:0 4px;">
						<i class="bi bi-arrow-repeat"></i>
					</button>
				</div>
			</div>
			<div class="card-body-custom">
				<div class="chart-container">
					<canvas id="salesChart"></canvas>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4 mb-4">
		<div class="custom-card">
			<div class="card-header-custom">
				<h6><i class="bi bi-trophy-fill text-warning mr-2"></i> Produk Terlaris</h6>
				<span class="badge" style="background: #D1FAE5; color: #065F46; font-weight:500;">Top 5</span>
			</div>
			<div class="card-body-custom" style="padding: 16px 20px;">
				<?php if (!empty($produk_terlaris)): ?>
					<?php foreach ($produk_terlaris as $index => $product): ?>
						<div class="d-flex align-items-center justify-content-between py-2 <?= $index < count($produk_terlaris) - 1 ? 'border-bottom' : ''; ?>"
							style="border-color: rgba(74,44,17,0.05);">
							<div class="d-flex align-items-center gap-2">
								<span class="badge"
									style="background: <?= $index === 0 ? 'var(--amber-cream)' : 'var(--bg-cream)'; ?>; color: <?= $index === 0 ? 'white' : 'var(--text-secondary)'; ?>; width: 24px; height:24px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:0.7rem;">
									<?= $index + 1; ?>
								</span>
								<span style="font-weight:600; font-size:0.85rem;"><?= $product['nama'] ?? $product['nama_produk'] ?? 'Produk'; ?></span>
							</div>
							<div class="text-right">
								<span style="font-weight:600; font-size:0.85rem;"><?= $product['total_terjual'] ?? 0; ?> kg</span>
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

<!-- ============================================ -->
<!-- PESANAN TERBARU & PETANI BARU -->
<!-- ============================================ -->
<div class="row">
	<div class="col-lg-6 mb-4">
		<div class="custom-card">
			<div class="card-header-custom">
				<h6><i class="bi bi-clock-history text-primary mr-2"></i> Pesanan Terbaru</h6>
				<a href="<?= base_url('admin/transaksi'); ?>" class="text-muted" style="font-size:0.75rem;">Lihat semua <i class="bi bi-chevron-right"></i></a>
			</div>
			<div class="card-body-custom" style="padding:0;">
				<div class="table-responsive">
					<table class="table table-custom mb-0">
						<thead>
							<tr>
								<th>Invoice</th>
								<th>Metode Bayar</th>
								<th>Total</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($pesanan_terbaru)): ?>
								<?php foreach ($pesanan_terbaru as $order): ?>
									<tr>
										<td><b>#<?= $order['id_transaksi']; ?></b></td>
										<td><?= $order['metode_bayar'] ?? 'Transfer'; ?></td>
										<td>Rp <?= number_format($order['total_harga'] ?? 0, 0, ',', '.'); ?></td>
										<td>
											<span class="status-badge <?= strtolower($order['status_pesanan'] ?? 'pending'); ?>">
												<?= ucfirst($order['status_pesanan'] ?? 'Pending'); ?>
											</span>
										</td>
									</tr>
								<?php endforeach; ?>
							<?php else: ?>
								<tr>
									<td colspan="4" class="text-center py-3 text-muted">Belum ada pesanan</td>
								</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<!-- PETANI BARU -->
	<div class="col-lg-6 mb-4">
		<div class="custom-card">
			<div class="card-header-custom">
				<h6><i class="bi bi-person-plus-fill text-success mr-2"></i> Petani Baru</h6>
				<a href="<?= base_url('admin/petani'); ?>" class="text-muted" style="font-size:0.75rem;">Lihat semua <i class="bi bi-chevron-right"></i></a>
			</div>
			<div class="card-body-custom" style="padding:0;">
				<div class="table-responsive">
					<table class="table table-custom mb-0">
						<thead>
							<tr>
								<th>Nama</th>
								<th>Status</th>
								<th>Tgl Daftar</th>
								<th>Verifikasi</th>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($petani_baru)): ?>
								<?php foreach ($petani_baru as $farmer): ?>
									<tr>
										<td><b><?= $farmer['nama'] ?? $farmer['nama_petani'] ?? '-'; ?></b></td>
										<td>
											<?php
											$status = $farmer['status'] ?? $farmer['status_petani'] ?? 'Pending';
											echo $status == 'Active' ? 'Aktif' : 'Menunggu';
											?>
										</td>
										<td><?= date('d-m-Y', strtotime($farmer['created_at'] ?? $farmer['tanggal_daftar'] ?? date('Y-m-d'))); ?></td>
										<td>
											<span class="status-badge <?= ($status == 'Active' || $status == 'verified') ? 'verified' : 'review'; ?>">
												<?= ($status == 'Active' || $status == 'verified') ? 'Terverifikasi' : 'Review'; ?>
											</span>
										</td>
									</tr>
								<?php endforeach; ?>
							<?php else: ?>
								<tr>
									<td colspan="4" class="text-center py-3 text-muted">Belum ada petani baru</td>
								</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- ============================================ -->
<!-- SETTING NOTIFIKASI -->
<!-- ============================================ -->
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
					'notif_transaksi'  => 1,
					'notif_pembayaran' => 1,
					'notif_stok'       => 1,
					'notif_petani'     => 1,
					'notif_kurir'      => 1,
					'notif_sistem'     => 1
				];

				if (!empty($settings)) {
					foreach ($default_settings as $key => $value) {
						if (isset($settings[$key])) {
							$default_settings[$key] = (int)$settings[$key];
						}
					}
				}
				?>
				<form method="POST" action="<?= base_url('admin/dashboard/settings'); ?>">
					<div class="row">
						<div class="col-md-3 col-6 mb-2">
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" id="notif_transaksi"
									name="notif_transaksi" <?= $default_settings['notif_transaksi'] == 1 ? 'checked' : ''; ?>>
								<label class="custom-control-label" for="notif_transaksi" style="font-size:0.85rem;">Transaksi Baru</label>
							</div>
						</div>
						<div class="col-md-3 col-6 mb-2">
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" id="notif_pembayaran"
									name="notif_pembayaran" <?= $default_settings['notif_pembayaran'] == 1 ? 'checked' : ''; ?>>
								<label class="custom-control-label" for="notif_pembayaran" style="font-size:0.85rem;">Konfirmasi Bayar</label>
							</div>
						</div>
						<div class="col-md-3 col-6 mb-2">
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" id="notif_stok"
									name="notif_stok" <?= $default_settings['notif_stok'] == 1 ? 'checked' : ''; ?>>
								<label class="custom-control-label" for="notif_stok" style="font-size:0.85rem;">Peringatan Stok</label>
							</div>
						</div>
						<div class="col-md-3 col-6 mb-2">
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" id="notif_petani"
									name="notif_petani" <?= $default_settings['notif_petani'] == 1 ? 'checked' : ''; ?>>
								<label class="custom-control-label" for="notif_petani" style="font-size:0.85rem;">Registrasi Petani</label>
							</div>
						</div>
						<div class="col-md-3 col-6 mb-2">
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" id="notif_kurir"
									name="notif_kurir" <?= $default_settings['notif_kurir'] == 1 ? 'checked' : ''; ?>>
								<label class="custom-control-label" for="notif_kurir" style="font-size:0.85rem;">Status Pengiriman</label>
							</div>
						</div>
						<div class="col-md-3 col-6 mb-2">
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" id="notif_sistem"
									name="notif_sistem" <?= $default_settings['notif_sistem'] == 1 ? 'checked' : ''; ?>>
								<label class="custom-control-label" for="notif_sistem" style="font-size:0.85rem;">Update Sistem</label>
							</div>
						</div>
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

<!-- ============================================ -->
<!-- SCRIPT JS JAM REALTIME & CHART -->
<!-- ============================================ -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
var salesChart;
$(document).ready(function() {
    /* --- Jam Real-time --- */
    function updateTime() {
        var days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        var months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        var now = new Date();
        var str = ' ! ' + days[now.getDay()] + ', ' + now.getDate() + ' ' + months[now.getMonth()] + ' ' + now.getFullYear() + ' pukul ' + String(now.getHours()).padStart(2,'0') + '.' + String(now.getMinutes()).padStart(2,'0');
        $('#currentDateTime').text(str);
    }
    updateTime();
    setInterval(updateTime, 1000);

    /* --- Chart --- */
    var ctx = document.getElementById('salesChart').getContext('2d');
    var chartLabels = <?= json_encode($grafik_penjualan['labels'] ?? ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des']); ?>;
    var chartData = <?= json_encode($grafik_penjualan['values'] ?? array_fill(0, 12, 0)); ?>;

    salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Penjualan (kg)',
                data: chartData,
                borderColor: '#E6A15C',
                backgroundColor: 'rgba(230, 161, 92, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: '#E6A15C'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(74, 44, 17, 0.05)' },
                    ticks: {
                        callback: function(value) { return value.toLocaleString('id-ID') + ' kg'; },
                        font: { size: 10 }
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 10 } }
                }
            }
        }
    });
});

function refreshChart() {
    $.ajax({
        url: "<?= base_url('admin/dashboard/get_chart_data'); ?>",
        type: "GET",
        dataType: "json",
        success: function(res) {
            if(res.success && salesChart) {
                salesChart.data.datasets[0].data = res.values;
                salesChart.update();
            }
        }
    });
}
</script>
