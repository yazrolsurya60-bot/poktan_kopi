<style>
	:root {
		--dark-coffee: #2C1808;
		--roasted-brown: #4A2C11;
		--amber-orange: #D97706;
		--text-muted: #8C827A;
		--bg-cream: #FAF6F0;
		--card-white: #FFFFFF;
		--radius-card: 16px;
	}

	/* CSS Tombol Kembali & Navigation */
	.btn-back-custom {
		background: #FFFFFF;
		border: 1px solid rgba(0, 0, 0, 0.08);
		color: #4A5568;
		padding: 8px 18px;
		border-radius: 10px;
		font-size: 0.85rem;
		font-weight: 500;
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		gap: 6px;
		transition: all 0.2s ease;
		box-shadow: 0 2px 5px rgba(0,0,0,0.03);
	}
	.btn-back-custom:hover {
		background: #F8FAFC;
		color: #1A202C;
		text-decoration: none;
	}

	/* CSS Card & Table */
	.custom-card-perf {
		background: var(--card-white);
		border-radius: var(--radius-card);
		box-shadow: 0 10px 30px rgba(0,0,0,0.03);
		border: 1px solid rgba(0,0,0,0.03);
		overflow: hidden;
		margin-top: 25px;
	}
	.card-header-perf {
		padding: 20px 24px;
		background: #FFFFFF;
		border-bottom: 1px solid #F1F5F9;
		display: flex;
		align-items: center;
		gap: 10px;
	}
	.card-header-perf h6 {
		margin: 0;
		font-weight: 700;
		color: #1E293B;
		font-size: 0.95rem;
		display: flex;
		align-items: center;
		gap: 8px;
	}

	.table-perf {
		width: 100%;
		margin-mb: 0;
		font-size: 0.83rem;
	}
	.table-perf thead th {
		background: #FAF6F0;
		color: #78716C;
		font-weight: 700;
		font-size: 0.68rem;
		text-transform: uppercase;
		letter-spacing: 0.6px;
		padding: 14px 18px;
		border: none;
		white-space: nowrap;
	}
	.table-perf tbody td {
		padding: 16px 18px;
		vertical-align: middle;
		border-bottom: 1px solid #F3F4F6;
		color: #334155;
	}

	/* Badges & Status Pills */
	.status-pill {
		padding: 4px 12px;
		border-radius: 20px;
		font-size: 0.72rem;
		font-weight: 600;
		display: inline-block;
	}
	.status-pill.active { background: #D1FAE5; color: #059669; }
	.status-pill.inactive { background: #FEF3C7; color: #D97706; }

	/* Stat Bubbles (Selesai, Sedang Berjalan, Dibatalkan) */
	.num-bubble {
		width: 28px;
		height: 28px;
		border-radius: 50%;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		font-weight: 700;
		font-size: 0.8rem;
		margin: 0 auto;
	}
	.num-bubble.green  { background: #DCFCE7; color: #16A34A; }
	.num-bubble.yellow { background: #FEF3C7; color: #D97706; }
	.num-bubble.red    { background: #FEE2E2; color: #DC2626; }

	/* Progress Bar */
	.progress-perf {
		height: 6px;
		border-radius: 10px;
		background: #E2E8F0;
		overflow: hidden;
		width: 80px;
		display: inline-block;
	}
	.progress-bar-perf {
		background: #D97706;
		border-radius: 10px;
		height: 100%;
	}
</style>

<!-- HEADER NAVIGASI & TOMBOL KEMBALI SEPERTI FOTO 1 -->
<div class="d-flex justify-content-between align-items-flex-start mb-3">
	<div>
		<div style="font-size: 0.85rem; color: #C2410C; margin-bottom: 4px; font-weight: 500;">
			<a href="<?= base_url('admin/kurir'); ?>" style="color: #D97706; text-decoration: none;">Manajemen Kurir</a> 
			<span style="color: #9CA3AF;">/ Performance Kurir</span>
		</div>
	</div>
	<div>
		<a href="<?= base_url('admin/kurir'); ?>" class="btn-back-custom">
			<i class="bi bi-arrow-left"></i> Kembali
		</a>
	</div>
</div>

<!-- TABEL LAPORAN PERFORMANCE KURIR -->
<div class="custom-card-perf">
	<div class="card-header-perf">
		<h6><i class="bi bi-bar-chart-fill" style="color: #1E293B;"></i> Ringkasan Kinerja Kurir</h6>
	</div>
	<div class="card-body p-0">
		<?php if (empty($performance)): ?>
			<div class="text-center py-5">
				<i class="bi bi-inbox text-muted d-block mb-2" style="font-size: 2rem;"></i>
				<p class="text-muted mb-0">Belum ada data kinerja kurir.</p>
			</div>
		<?php else: ?>
			<div class="table-responsive">
				<table class="table table-perf">
					<thead>
						<tr>
							<th width="40">#</th>
							<th>NAMA KURIR</th>
							<th>STATUS</th>
							<th class="text-center">TOTAL PENGIRIMAN</th>
							<th class="text-center">SELESAI</th>
							<th class="text-center">SEDANG BERJALAN</th>
							<th class="text-center">DIBATALKAN</th>
							<th>TINGKAT SELESAI</th>
							<th>RATA² WAKTU KIRIM</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$no = 1; 
						foreach ($performance as $p): 
							$total     = (int) ($p['total_pengiriman'] ?? 0);
							$delivered = (int) ($p['total_delivered'] ?? 0);
							$proses    = (int) ($p['total_proses'] ?? 0);
							$canceled  = (int) ($p['total_canceled'] ?? 0);
							$rate      = ($total > 0) ? round(($delivered / $total) * 100) : 0;
							$avg_time  = $p['avg_time'] ?? (($delivered > 0) ? '1 jam' : '0 jam');
						?>
							<tr>
								<td style="color: #94A3B8;"><?= $no++; ?></td>
								<td style="font-weight: 600; color: #1E293B;"><?= htmlspecialchars($p['nama_kurir']); ?></td>
								<td>
									<span class="status-pill <?= strtolower($p['status']); ?>">
										<?= $p['status']; ?>
									</span>
								</td>
								<td class="text-center" style="font-weight: 500;"><?= $total; ?></td>
								<td class="text-center">
									<div class="num-bubble green"><?= $delivered; ?></div>
								</td>
								<td class="text-center">
									<div class="num-bubble yellow"><?= $proses; ?></div>
								</td>
								<td class="text-center">
									<div class="num-bubble red"><?= $canceled; ?></div>
								</td>
								<td>
									<div class="d-flex align-items-center gap-2">
										<div class="progress-perf">
											<div class="progress-bar-perf" style="width: <?= $rate; ?>%;"></div>
										</div>
										<span style="font-size: 0.75rem; font-weight: 600; color: #475569; margin-left: 8px;"><?= $rate; ?>%</span>
									</div>
								</td>
								<td style="color: #64748B;"><?= ($total > 0) ? $avg_time : '-'; ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php endif; ?>
	</div>
</div>