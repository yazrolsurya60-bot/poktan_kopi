<style>
	:root {
		--roasted-brown: #4A2C11;
		--dark-coffee: #2C1808;
		--amber-cream: #E6A15C;
		--amber-light: #FDF5ED;
		--bg-cream: #FAF6F0;
		--card-white: #FFFFFF;
		--text-secondary: #70655E;
		--shadow-soft: 0 8px 30px rgba(44, 24, 8, 0.08);
		--shadow-hover: 0 12px 40px rgba(44, 24, 8, 0.15);
		--radius-card: 16px;
		--transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
	}

	/* QUICK ACTION */
	.quick-action-btn {
		padding: 10px 18px;
		border-radius: 12px;
		transition: var(--transition-smooth);
		display: inline-flex;
		align-items: center;
		gap: 10px;
		font-weight: 600;
		font-size: 0.82rem;
		cursor: pointer;
		text-decoration: none;
		box-shadow: var(--shadow-soft);
		border: 1px solid rgba(74, 44, 17, 0.06);
		background: var(--card-white);
		color: var(--dark-coffee);
	}

	.quick-action-btn:hover {
		transform: translateY(-2px);
		text-decoration: none;
		color: var(--dark-coffee);
		box-shadow: var(--shadow-hover);
	}

	.quick-action-btn.btn-excel {
		background: #1B7C3C;
		color: white;
		border-color: #1B7C3C;
	}

	.quick-action-btn.btn-excel:hover {
		background: #14632F;
		color: white;
	}

	.quick-action-btn.btn-pdf {
		background: #DC143C;
		color: white;
		border-color: #DC143C;
	}

	.quick-action-btn.btn-pdf:hover {
		background: #B01030;
		color: white;
	}

	/* STATISTIK CARDS */
	.stat-card {
		background: var(--card-white);
		border-radius: var(--radius-card);
		padding: 20px 22px;
		box-shadow: var(--shadow-soft);
		transition: var(--transition-smooth);
		border: 1px solid rgba(74, 44, 17, 0.04);
		height: 100%;
		position: relative;
		overflow: hidden;
	}

	.stat-card::before {
		content: '';
		position: absolute;
		top: 0; left: 0; right: 0; height: 3px;
		background: linear-gradient(90deg, var(--amber-cream), var(--roasted-brown));
		opacity: 0;
		transition: var(--transition-smooth);
	}

	.stat-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-hover); }
	.stat-card:hover::before { opacity: 1; }

	.stat-card .stat-icon {
		width: 48px;
		height: 48px;
		border-radius: 14px;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 1.4rem;
		margin-bottom: 12px;
	}

	.stat-card .stat-title {
		font-size: 0.7rem;
		font-weight: 600;
		text-transform: uppercase;
		color: var(--text-secondary);
	}

	.stat-card .stat-number {
		font-size: 1.8rem;
		font-weight: 800;
		color: var(--dark-coffee);
	}

	/* TABLE & CUSTOM CARD */
	.custom-card {
		background: var(--card-white);
		border-radius: var(--radius-card);
		box-shadow: var(--shadow-soft);
		border: 1px solid rgba(74, 44, 17, 0.04);
		overflow: hidden;
	}

	.custom-card .card-header-custom {
		padding: 16px 24px;
		border-bottom: 1px solid rgba(74, 44, 17, 0.06);
		display: flex;
		align-items: center;
		justify-content: space-between;
		background: rgba(250, 246, 240, 0.3);
	}

	.table-custom { font-size: 0.85rem; margin-bottom: 0; width: 100%; }
	.table-custom thead th {
		background: rgba(250, 246, 240, 0.4);
		border-bottom: 2px solid rgba(74, 44, 17, 0.06);
		color: var(--text-secondary);
		font-weight: 600;
		font-size: 0.7rem;
		text-transform: uppercase;
		padding: 14px 12px;
	}
	.table-custom tbody td {
		padding: 14px 12px;
		border-bottom: 1px solid rgba(74, 44, 17, 0.04);
		vertical-align: middle;
	}

	.status-badge {
		padding: 5px 14px;
		border-radius: 20px;
		font-size: 0.7rem;
		font-weight: 600;
		display: inline-block;
	}
	.status-badge.pending { background: #FEF3C7; color: #92400E; }
	.status-badge.processing { background: #DBEAFE; color: #1E40AF; }
	.status-badge.delivery { background: #EDE9FE; color: #5B21B6; }
	.status-badge.complete { background: #D1FAE5; color: #065F46; }
	.status-badge.cancelled { background: #FEE2E2; color: #991B1B; }

	.btn-detail-transaksi {
		background: var(--amber-cream);
		color: white;
		border: none;
		padding: 6px 14px;
		border-radius: 8px;
		font-size: 0.75rem;
		font-weight: 600;
		transition: var(--transition-smooth);
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		gap: 5px;
	}

	.btn-detail-transaksi:hover {
		background: var(--roasted-brown);
		color: white;
		text-decoration: none;
		transform: translateY(-2px);
		box-shadow: var(--shadow-hover);
	}

	.avatar-circle {
		width: 34px;
		height: 34px;
		border-radius: 50%;
		background: var(--amber-light);
		display: flex;
		align-items: center;
		justify-content: center;
		color: var(--amber-cream);
		font-weight: 700;
		font-size: 0.8rem;
	}
</style>

<!-- QUICK ACTION -->
<div class="row mb-4 fade-in">
	<div class="col-12">
		<div class="d-flex flex-wrap" style="gap: 10px;">
			<a href="<?= base_url('admin/transaksi'); ?>" class="quick-action-btn">
				<i class="bi bi-arrow-repeat"></i> Refresh
			</a>
			<a href="<?= base_url('admin/transaksi/export_excel'); ?>" class="quick-action-btn btn-excel" onclick="return confirm('Download laporan Excel?')">
				<i class="bi bi-file-earmark-excel-fill"></i> Export Excel
			</a>
			<a href="<?= base_url('admin/transaksi/export_pdf'); ?>" class="quick-action-btn btn-pdf" onclick="return confirm('Download laporan PDF?')">
				<i class="bi bi-file-earmark-pdf-fill"></i> Export PDF
			</a>
		</div>
	</div>
</div>

<!-- STATISTIK CARDS -->
<div class="row mb-4 fade-in">
	<div class="col-xl-3 col-lg-6 col-6 mb-3">
		<div class="stat-card">
			<div class="stat-icon" style="background: #FEF3C7; color: #92400E;"><i class="bi bi-clock"></i></div>
			<div class="stat-title">Pending</div>
			<div class="stat-number"><?= $count_pending ?? 0; ?></div>
		</div>
	</div>
	<div class="col-xl-3 col-lg-6 col-6 mb-3">
		<div class="stat-card">
			<div class="stat-icon" style="background: #DBEAFE; color: #1E40AF;"><i class="bi bi-spinner"></i></div>
			<div class="stat-title">Diproses</div>
			<div class="stat-number"><?= $count_diproses ?? 0; ?></div>
		</div>
	</div>
	<div class="col-xl-3 col-lg-6 col-6 mb-3">
		<div class="stat-card">
			<div class="stat-icon" style="background: #EDE9FE; color: #5B21B6;"><i class="bi bi-truck"></i></div>
			<div class="stat-title">Dikirim</div>
			<div class="stat-number"><?= $count_dikirim ?? 0; ?></div>
		</div>
	</div>
	<div class="col-xl-3 col-lg-6 col-6 mb-3">
		<div class="stat-card">
			<div class="stat-icon" style="background: #D1FAE5; color: #065F46;"><i class="bi bi-check-circle"></i></div>
			<div class="stat-title">Selesai</div>
			<div class="stat-number"><?= $count_selesai ?? 0; ?></div>
		</div>
	</div>
</div>

<!-- TABEL TRANSAKSI -->
<div class="custom-card fade-in">
	<div class="card-header-custom">
		<h6 class="mb-0"><i class="bi bi-receipt"></i> Daftar Transaksi</h6>
		<span class="badge" style="background:var(--bg-cream); color:var(--text-secondary); font-weight:600; padding:6px 14px; border-radius:20px;">
			Total: <?= count($transaksi ?? []); ?> transaksi
		</span>
	</div>
	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table table-custom">
				<thead>
					<tr>
						<th>ID</th>
						<th>Pembeli</th>
						<th>Total</th>
						<th>Status Pesanan</th>
						<th>Status Bayar</th>
						<th>Metode</th>
						<th>Tanggal</th>
						<th class="text-center">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($transaksi)): ?>
						<?php foreach ($transaksi as $t): ?>
							<tr>
								<td><span class="font-weight-bold" style="color:var(--dark-coffee);">#<?= $t['id_transaksi']; ?></span></td>
								<td>
									<div class="d-flex align-items-center gap-2">
										<div class="avatar-circle"><?= strtoupper(substr($t['nama_pembeli'] ?? 'G', 0, 1)); ?></div>
										<span><?= $t['nama_pembeli'] ?? 'Guest'; ?></span>
									</div>
								</td>
								<td><span class="font-weight-bold" style="color:var(--roasted-brown);">Rp <?= number_format($t['grand_total'] ?? 0, 0, ',', '.'); ?></span></td>
								<td>
									<?php
									$status = strtolower($t['status_pesanan'] ?? 'pending');
									$class = 'pending';
									if ($status == 'selesai' || $status == 'complete') $class = 'complete';
									elseif ($status == 'dikirim' || $status == 'delivery') $class = 'delivery';
									elseif ($status == 'diproses' || $status == 'processing') $class = 'processing';
									elseif ($status == 'batal' || $status == 'cancelled') $class = 'cancelled';
									?>
									<span class="status-badge <?= $class; ?>">
										<?= $t['status_pesanan'] ?? 'Pending'; ?>
									</span>
								</td>
								<td>
									<?php
									$bayar = strtolower($t['status_bayar'] ?? 'pending');
									$bayar_class = ($bayar == 'lunas' || $bayar == 'paid') ? 'complete' : (($bayar == 'batal' || $bayar == 'cancelled') ? 'cancelled' : 'pending');
									?>
									<span class="status-badge <?= $bayar_class; ?>">
										<?= $t['status_bayar'] ?? 'Pending'; ?>
									</span>
								</td>
								<td>
									<?php
									$metode = $t['metode_bayar'] ?? 'Transfer';
									if ($metode == 'Transfer Bank' || $metode == 'Transfer') {
										echo 'Virtual Account';
									} else {
										echo $metode;
									}
									?>
								</td>
								<td><span style="font-size:0.8rem; color:var(--text-secondary);"><?= date('d/m/Y', strtotime($t['tanggal_transaksi'] ?? date('Y-m-d'))); ?></span></td>
								<td class="text-center">
									<a href="<?= base_url('admin/transaksi/detail/' . $t['id_transaksi']); ?>" class="btn-detail-transaksi">
										<i class="bi bi-eye"></i> Detail
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="8" class="text-center py-5 text-muted">
								<i class="bi bi-inbox" style="font-size:3rem; display:block; margin-bottom:12px; opacity:0.3;"></i>
								Belum ada transaksi
							</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>