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
<<<<<<< HEAD
		<div class="sidebar-menu-wrapper">
			<ul class="sidebar-menu">
				<li class="menu-item active">
					<a href="<?= base_url('admin/dashboard'); ?>">
						<i class="bi bi-grid-1x2-fill"></i>Dashboard
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/user'); ?>">
						<i class="bi bi-people-fill"></i>Manajemen User
						<?php if (isset($user_baru) && $user_baru > 0): ?>
							<span class="menu-badge" style="background: #EF4444; color: white;"><?= $user_baru; ?></span>
						<?php endif; ?>
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/petani'); ?>">
						<i class="bi bi-person-badge-fill"></i>Data Petani
						<?php if (isset($petani_baru_count) && $petani_baru_count > 0): ?>
							<span class="menu-badge"
								style="background: #F59E0B; color: white;"><?= $petani_baru_count; ?></span>
						<?php endif; ?>
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/lahan'); ?>">
						<i class="bi bi-map-fill"></i>Manajemen Lahan
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/panen'); ?>">
						<i class="bi bi-tree-fill"></i>Manajemen Panen
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/produk'); ?>">
						<i class="bi bi-box-seam-fill"></i>Manajemen Produk
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/transaksi'); ?>">
						<i class="bi bi-wallet2"></i>Transaksi
						<?php if (isset($transaksi_pending) && $transaksi_pending > 0): ?>
							<span class="menu-badge"
								style="background: #EF4444; color: white;"><?= $transaksi_pending; ?></span>
						<?php endif; ?>
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/kurir'); ?>">
						<i class="bi bi-truck"></i>Manajemen Kurir
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/mitra'); ?>">
						<i class="bi bi-shop"></i>Manajemen Mitra
						<?php if (isset($mitra_baru) && $mitra_baru > 0): ?>
							<span class="menu-badge" style="background: #F59E0B; color: white;"><?= $mitra_baru; ?></span>
						<?php endif; ?>
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/tracking'); ?>">
						<i class="bi bi-geo-alt-fill"></i>Tracking Pengiriman
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/laporan'); ?>">
						<i class="bi bi-file-earmark-bar-graph-fill"></i>Analisis & Laporan
					</a>
				</li>
			</ul>
		</div>
		<div class="sidebar-footer">
			<button class="btn-logout" onclick="window.location.href='<?= base_url('auth/logout'); ?>'">
				<i class="bi bi-box-arrow-right"></i> Keluar
			</button>
=======
		<div class="kpi-number rupiah">Rp <?= number_format($kpi_total_revenue ?? 0, 0, ',', '.'); ?></div>
		<div class="kpi-footer">
			<span class="label">Akumulasi seluruh penjualan</span>
>>>>>>> c50a8c46b5d9744b96ff8d6c8a37c62a316dedd7
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
<<<<<<< HEAD
						<div class="notif-dropdown-list" id="notifList">
							<?php if (!empty($notifikasi)): ?>
								<?php foreach ($notifikasi as $n): ?>
									<?php
									$icon_type = $n['icon'] ?? 'info';
									$icon_map = [
										'success' => 'bi-check-circle-fill',
										'warning' => 'bi-exclamation-triangle-fill',
										'danger' => 'bi-x-circle-fill',
										'info' => 'bi-info-circle-fill',
										'primary' => 'bi-star-fill'
									];
									$icon_class = $icon_map[$icon_type] ?? 'bi-info-circle-fill';
									?>
									<a class="notif-item <?= (isset($n['status_baca']) && $n['status_baca'] == '0') ? 'unread' : ''; ?>"
										href="<?= base_url('admin/dashboard/read/' . $n['id_notifikasi']); ?>">
										<div class="notif-icon <?= $icon_type; ?>">
											<i class="bi <?= $icon_class; ?>"></i>
										</div>
										<div class="notif-text">
											<?= htmlspecialchars($n['isi_notifikasi'] ?? $n['judul'] ?? 'Notifikasi'); ?>
											<span
												class="notif-time"><?= date('d M Y, H:i', strtotime($n['tanggal_buat'])); ?></span>
										</div>
										<?php if (isset($n['status_baca']) && $n['status_baca'] == '0'): ?>
											<span class="notif-badge-new">Baru</span>
										<?php endif; ?>
									</a>
=======
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
>>>>>>> c50a8c46b5d9744b96ff8d6c8a37c62a316dedd7
								<?php endforeach; ?>
							<?php else: ?>
								<tr>
									<td colspan="4" class="text-center py-3 text-muted">Belum ada pesanan</td>
								</tr>
							<?php endif; ?>
<<<<<<< HEAD
						</div>
						<div class="p-2 text-center border-top"
							style="background:#FAF6F0; border-color:rgba(74,44,17,0.06);">
							<a href="<?= base_url('admin/dashboard/settings'); ?>"
								class="small text-secondary font-weight-bold text-decoration-none">
								<i class="bi bi-gear-fill mr-1"></i> Pengaturan Notifikasi
							</a>
						</div>
					</div>
				</div>

				<!-- USER BADGE -->
				<?php
				$nama = $this->session->userdata('nama') ?? 'Admin';
				$role = $this->session->userdata('role') ?? 'Admin';
				?>
				<div class="user-badge">
					<i class="bi bi-person-circle"></i>
					<div>
						<div class="user-name"><?= $nama; ?></div>
						<div class="user-role"><?= $role; ?></div>
					</div>
				</div>

			</div>
		</div>

		<!-- ============================================ -->
		<!-- QUICK ACTION BUTTONS - RAPI PAKAI GRID -->
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
		<!-- KPI CARDS - RAPI PAKAI GRID -->
		<!-- ============================================ -->
		<div class="kpi-grid">
			<!-- Total Pendapatan -->
			<div class="kpi-card">
				<div class="kpi-decoration"></div>
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
				<div class="kpi-decoration"></div>
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
				<div class="kpi-decoration"></div>
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
				<div class="kpi-decoration"></div>
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
							<span class="badge"
								style="background: var(--bg-cream); color: var(--text-secondary); font-weight:500;"><?= date('Y'); ?></span>
							<button class="btn btn-sm btn-link text-muted" onclick="refreshChart()"
								style="padding:0 4px;">
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
										<span
											style="font-weight:600; font-size:0.85rem;"><?= $product['nama'] ?? $product['nama_produk'] ?? 'Produk'; ?></span>
									</div>
									<div class="text-right">
										<span style="font-weight:600; font-size:0.85rem;"><?= $product['total_terjual'] ?? 0; ?>
											kg</span>
										<small class="d-block text-muted" style="font-size:0.7rem;">Rp
											<?= number_format($product['pendapatan'] ?? 0, 0, ',', '.'); ?></small>
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
						<a href="<?= base_url('admin/transaksi'); ?>" class="text-muted"
							style="font-size:0.75rem;">Lihat semua <i class="bi bi-chevron-right"></i></a>
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
													<span
														class="status-badge <?= strtolower($order['status_pesanan'] ?? 'pending'); ?>">
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
						<a href="<?= base_url('admin/petani'); ?>" class="text-muted" style="font-size:0.75rem;">Lihat
							semua <i class="bi bi-chevron-right"></i></a>
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
												<td><?= date('d-m-Y', strtotime($farmer['created_at'] ?? $farmer['tanggal_daftar'] ?? date('Y-m-d'))); ?>
												</td>
												<td>
													<span
														class="status-badge <?= ($status == 'Active' || $status == 'verified') ? 'verified' : 'review'; ?>">
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
		<!-- SETTING NOTIFIKASI - TANPA LAPORAN BULANAN -->
		<!-- ============================================ -->
		<div class="row">
			<div class="col-12">
				<div class="custom-card">
					<div class="card-header-custom">
						<h6><i class="bi bi-gear-fill text-secondary mr-2"></i> Preferensi Notifikasi</h6>
						<span class="badge"
							style="background: var(--bg-cream); color: var(--text-secondary); font-weight:500;">Pengaturan</span>
					</div>
					<div class="card-body-custom">
						<?php
						// Default settings untuk Admin - TANPA LAPORAN BULANAN
						$default_settings = [
							'notif_transaksi' => 1,
							'notif_pembayaran' => 1,
							'notif_stok' => 1,
							'notif_petani' => 1,
							'notif_kurir' => 1,
							'notif_sistem' => 1
						];

						// Gabungkan dengan data dari database
						if (!empty($settings)) {
							foreach ($default_settings as $key => $value) {
								if (isset($settings[$key])) {
									$default_settings[$key] = (int) $settings[$key];
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
										<label class="custom-control-label" for="notif_transaksi"
											style="font-size:0.85rem;">Transaksi Baru</label>
									</div>
								</div>
								<div class="col-md-3 col-6 mb-2">
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="notif_pembayaran"
											name="notif_pembayaran" <?= $default_settings['notif_pembayaran'] == 1 ? 'checked' : ''; ?>>
										<label class="custom-control-label" for="notif_pembayaran"
											style="font-size:0.85rem;">Konfirmasi Bayar</label>
									</div>
								</div>
								<div class="col-md-3 col-6 mb-2">
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="notif_stok"
											name="notif_stok" <?= $default_settings['notif_stok'] == 1 ? 'checked' : ''; ?>>
										<label class="custom-control-label" for="notif_stok"
											style="font-size:0.85rem;">Peringatan Stok</label>
									</div>
								</div>
								<div class="col-md-3 col-6 mb-2">
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="notif_petani"
											name="notif_petani" <?= $default_settings['notif_petani'] == 1 ? 'checked' : ''; ?>>
										<label class="custom-control-label" for="notif_petani"
											style="font-size:0.85rem;">Registrasi Petani</label>
									</div>
								</div>
								<div class="col-md-3 col-6 mb-2">
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="notif_kurir"
											name="notif_kurir" <?= $default_settings['notif_kurir'] == 1 ? 'checked' : ''; ?>>
										<label class="custom-control-label" for="notif_kurir"
											style="font-size:0.85rem;">Status Pengiriman</label>
									</div>
								</div>
								<div class="col-md-3 col-6 mb-2">
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="notif_sistem"
											name="notif_sistem" <?= $default_settings['notif_sistem'] == 1 ? 'checked' : ''; ?>>
										<label class="custom-control-label" for="notif_sistem"
											style="font-size:0.85rem;">Update Sistem</label>
									</div>
								</div>
							</div>
							<div class="mt-3 pt-2 border-top" style="border-color: rgba(74,44,17,0.06);">
								<button type="submit" class="btn"
									style="background: var(--roasted-brown); color: white; border-radius:10px; padding: 8px 24px; font-weight:600; font-size:0.85rem;">
									<i class="bi bi-save mr-1"></i> Simpan Pengaturan
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

=======
						</tbody>
					</table>
				</div>
			</div>
		</div>
>>>>>>> c50a8c46b5d9744b96ff8d6c8a37c62a316dedd7
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

<<<<<<< HEAD
		if (toggleBtn) toggleBtn.addEventListener('click', toggleSidebar);
		if (overlay) overlay.addEventListener('click', toggleSidebar);

		document.addEventListener('click', function (e) {
			if (window.innerWidth > 991.98) return;
			if (!sidebar.contains(e.target) && toggleBtn && !toggleBtn.contains(e.target)) {
				if (sidebar.classList.contains('open')) toggleSidebar();
			}
		});

		// ============================================
		// 2. NOTIFICATION DROPDOWN
		// ============================================
		const notifToggle = document.getElementById('notifToggle');
		const notifDropdown = document.getElementById('notifDropdown');

		if (notifToggle) {
			notifToggle.addEventListener('click', function (e) {
				e.stopPropagation();
				notifDropdown.classList.toggle('show');
			});
		}

		document.addEventListener('click', function (e) {
			if (notifDropdown && !notifDropdown.contains(e.target) && !notifToggle.contains(e.target)) {
				notifDropdown.classList.remove('show');
			}
		});

		// ============================================
		// 3. MARK ALL READ
		// ============================================
		function markAllRead() {
			if (confirm('Tandai semua notifikasi sebagai sudah dibaca?')) {
				$.ajax({
					url: '<?= base_url('api/notifikasi/mark_all_read'); ?>',
					type: 'POST',
					dataType: 'json',
					success: function (response) {
						if (response.success) location.reload();
						else alert('Gagal menandai semua notifikasi.');
					},
					error: function () {
						alert('Terjadi kesalahan. Silakan coba lagi.');
					}
				});
			}
		}

		document.getElementById('markAllReadBtn')?.addEventListener('click', function (e) {
			e.preventDefault();
			markAllRead();
		});

		// ============================================
		// 4. CHART
		// ============================================
		let salesChart;

		function initChart() {
			const ctx = document.getElementById('salesChart')?.getContext('2d');
			if (!ctx) return;

			const chartLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
			const chartData = <?= isset($grafik_penjualan['values']) ? json_encode($grafik_penjualan['values']) : json_encode(array_fill(0, 12, 0)); ?>;

			salesChart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: chartLabels,
					datasets: [{
						label: 'Penjualan (Kg)',
						data: chartData,
						borderColor: '#E6A15C',
						backgroundColor: 'rgba(230, 161, 92, 0.08)',
						fill: true,
						tension: 0.4,
						pointBackgroundColor: '#E6A15C',
						pointBorderColor: '#FFFFFF',
						pointBorderWidth: 2,
						pointRadius: 4,
						pointHoverRadius: 7,
						borderWidth: 2.5
					}]
				},
				options: {
					responsive: true,
					maintainAspectRatio: false,
					plugins: {
						legend: {
							display: false
						},
						tooltip: {
							backgroundColor: '#2C1808',
							titleColor: '#E6A15C',
							bodyColor: '#FAF6F0',
							cornerRadius: 8,
							padding: 10,
							callbacks: {
								label: function (context) {
									return context.parsed.y.toLocaleString('id-ID') + ' kg';
								}
							}
						}
					},
					scales: {
						y: {
							beginAtZero: true,
							grid: {
								color: 'rgba(74, 44, 17, 0.06)',
								drawBorder: false
							},
							ticks: {
								font: {
									size: 10,
									family: 'Plus Jakarta Sans'
								},
								color: '#70655E',
								stepSize: 50,
								callback: function (value) {
									return value.toLocaleString('id-ID') + ' kg';
								}
							}
						},
						x: {
							grid: {
								display: false
							},
							ticks: {
								font: {
									size: 10,
									family: 'Plus Jakarta Sans'
								},
								color: '#70655E'
							}
						}
					},
					interaction: {
						intersect: false,
						mode: 'index'
=======
				if (!empty($settings)) {
					foreach ($default_settings as $key => $value) {
						if (isset($settings[$key])) {
							$default_settings[$key] = (int)$settings[$key];
						}
>>>>>>> c50a8c46b5d9744b96ff8d6c8a37c62a316dedd7
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

<<<<<<< HEAD
		function refreshChart() {
			if (salesChart) {
				$.get('<?= base_url('admin/dashboard/get_chart_data'); ?>', function (data) {
					if (data.success) {
						salesChart.data.datasets[0].data = data.values;
						salesChart.update();
					}
				});
			}
		}
=======
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
>>>>>>> c50a8c46b5d9744b96ff8d6c8a37c62a316dedd7

    /* --- Chart --- */
    var ctx = document.getElementById('salesChart').getContext('2d');
    var chartLabels = <?= json_encode($grafik_penjualan['labels'] ?? ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des']); ?>;
    var chartData = <?= json_encode($grafik_penjualan['values'] ?? array_fill(0, 12, 0)); ?>;

<<<<<<< HEAD
		// ============================================
		// 6. SWITCH HANDLING
		// ============================================
		document.querySelectorAll('.custom-control-input').forEach(function (switchEl) {
			switchEl.addEventListener('change', function () {
				const label = this.closest('.custom-control').querySelector('.custom-control-label');
				const setting = label ? label.textContent.trim() : 'Unknown';
				console.log('Notifikasi ' + setting + (this.checked ? ' diaktifkan' : ' dinonaktifkan'));
			});
		});

		// ============================================
		// 7. REAL-TIME NOTIFICATION & SOUND EFFECT
		// ============================================
		let currentUnreadCount = <?= isset($unread_count) ? (int)$unread_count : 0; ?>;

		function playNotifSound() {
			const audio = document.getElementById('notifSound');
			if (audio) {
				audio.currentTime = 0;
				let promise = audio.play();
				if (promise !== undefined) {
					promise.catch(function(e) {
						console.log('🔇 Autoplay ditahan browser sampai ada interaksi klik pertama user.');
					});
				}
			}
		}

		function fetchRealtimeNotifications() {
			$.ajax({
				url: '<?= base_url("api/notifikasi/get"); ?>',
				type: 'GET',
				dataType: 'json',
				success: function(response) {
					if (response.success) {
						const newCount = parseInt(response.unread) || 0;
						const countEl = $('#notifCount');
						const notifBtn = $('#notifToggle');

						// 🔔 Bunyikan suara & animasi jika ada notifikasi baru
						if (newCount > currentUnreadCount) {
							playNotifSound();
							notifBtn.addClass('ring');
							setTimeout(function() {
								notifBtn.removeClass('ring');
							}, 1000);
						}

						// Update badge counter
						currentUnreadCount = newCount;
						if (newCount > 0) {
							countEl.text(newCount).show();
						} else {
							countEl.text(0).hide();
						}

						// Update item list dropdown secara dinamis
						if (response.notifikasi && response.notifikasi.length > 0) {
							let htmlList = '';
							$.each(response.notifikasi, function(i, n) {
								let iconType = n.icon || 'info';
								let iconMap = {
									'success': 'bi-check-circle-fill',
									'warning': 'bi-exclamation-triangle-fill',
									'danger': 'bi-x-circle-fill',
									'info': 'bi-info-circle-fill',
									'primary': 'bi-star-fill'
								};
								let iconClass = iconMap[iconType] || 'bi-info-circle-fill';

								htmlList += `
									<a class="notif-item ${n.status_baca == '0' ? 'unread' : ''}" href="<?= base_url('admin/dashboard/read/'); ?>${n.id_notifikasi}">
										<div class="notif-icon ${iconType}">
											<i class="bi ${iconClass}"></i>
										</div>
										<div class="notif-text">
											${n.isi_notifikasi || n.judul || 'Notifikasi'}
											<span class="notif-time">${n.tanggal_buat}</span>
										</div>
										${n.status_baca == '0' ? '<span class="notif-badge-new">Baru</span>' : ''}
									</a>
								`;
							});
							$('#notifList').html(htmlList);
						}
					}
				},
				error: function(err) {
					console.warn('⚠️ Gagal memuat notifikasi real-time');
				}
			});
		}

		// Run real-time polling every 5 seconds
		setInterval(fetchRealtimeNotifications, 5000);

		// ============================================
		// 8. INITIALIZE
		// ============================================
		document.addEventListener('DOMContentLoaded', function () {
			initChart();
		});

		console.log('✅ Dashboard Admin siap digunakan!');
		console.log('📋 Fitur yang tersedia:');
		console.log('   - KPI Cards (M11-F01) - Data Real');
		console.log('   - Grafik Penjualan (M10-F02) - Data Real');
		console.log('   - Produk Terlaris (M10-F04) - Data Real');
		console.log('   - Pesanan Terbaru (M11-F01) - Data Real');
		console.log('   - Petani Baru (M11-F01) - Data Real');
		console.log('   - Quick Action (M11-F04) - 5 Aksi Rapi');
		console.log('   - Notifikasi Real-time & Audio Sound via API (Auto 5 detik)');
		console.log('   - Setting Notifikasi (M11-F03) - 6 Opsi (Tanpa Laporan Bulanan)');
	</script>
</body>

</html>
=======
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
>>>>>>> c50a8c46b5d9744b96ff8d6c8a37c62a316dedd7
