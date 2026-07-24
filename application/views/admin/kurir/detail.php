<style>
	:root {
		--roasted-brown: #4A2C11;
		--dark-coffee: #2C1808;
		--amber-cream: #E6A15C;
		--bg-cream: #FAF6F0;
		--card-white: #FFFFFF;
		--text-secondary: #70655E;
		--shadow-soft: 0 8px 30px rgba(44, 24, 8, 0.08);
		--radius-card: 14px;
	}

	.custom-card { background: var(--card-white); border: 1px solid rgba(74, 44, 17, 0.06); border-radius: var(--radius-card); box-shadow: var(--shadow-soft); overflow: hidden; }
	.custom-card .card-header-custom { padding: 18px 24px; border-bottom: 1px solid rgba(74, 44, 17, 0.06); display: flex; align-items: center; gap: 10px; }
	.custom-card .card-header-custom h6 { font-weight: 700; color: var(--dark-coffee); margin: 0; font-size: 0.9rem; }
	.card-body-custom { padding: 22px 24px; }

	.profile-row { display: flex; align-items: center; gap: 18px; }
	.profile-avatar { width: 64px; height: 64px; border-radius: 50%; background: var(--bg-cream); color: var(--roasted-brown); display: flex; align-items: center; justify-content: center; font-size: 1.8rem; flex-shrink: 0; }
	.profile-info dt { font-size: 0.7rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: .5px; }
	.profile-info dd { font-size: 0.9rem; color: var(--dark-coffee); font-weight: 600; margin-bottom: 10px; }

	.status-badge { padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
	.status-badge.badge-active   { background: #D1FAE5; color: #065F46; }
	.status-badge.badge-inactive { background: #FEF3C7; color: #92400E; }

	.timeline { position: relative; padding-left: 22px; }
	.timeline::before { content:''; position:absolute; left:6px; top:4px; bottom:4px; width:2px; background: rgba(74,44,17,0.1); }
	.timeline-item { position: relative; padding-bottom: 18px; }
	.timeline-item::before { content:''; position:absolute; left:-22px; top:3px; width:10px; height:10px; border-radius:50%; background: var(--amber-cream); border: 2px solid var(--card-white); }
	.timeline-item .t-status { font-weight:700; font-size:0.85rem; color: var(--dark-coffee); text-transform: capitalize; }
	.timeline-item .t-time { font-size: 0.72rem; color: var(--text-secondary); }
	.timeline-item .t-desc { font-size: 0.8rem; color: var(--text-secondary); margin-top: 2px; }

	.tracking-block { border: 1px solid rgba(74,44,17,0.06); border-radius: 12px; padding: 16px 18px; margin-bottom: 16px; }
	.tracking-block .tb-header { display:flex; justify-content: space-between; align-items: center; margin-bottom: 12px; flex-wrap: wrap; gap: 6px; }
	.tracking-block .tb-invoice { font-weight: 700; color: var(--roasted-brown); font-size: 0.88rem; }
	.status-pill { padding: 3px 10px; border-radius: 20px; font-size: 0.7rem; font-weight: 600; text-transform: capitalize; background: var(--bg-cream); color: var(--roasted-brown); }
</style>

<!-- TOMBOL KEMBALI & BREADCRUMB -->
<div class="d-flex justify-content-between align-items-center mb-4">
	<div class="breadcrumb-custom" style="font-size:0.82rem;">
		<a href="<?= base_url('admin/kurir'); ?>" style="color:var(--amber-cream); text-decoration:none;">Manajemen Kurir</a> / Detail Kurir
	</div>
	<a href="<?= base_url('admin/kurir'); ?>" class="btn btn-light btn-sm" style="border-radius:10px; border:1px solid rgba(74,44,17,0.08); font-weight:600;">
		<i class="bi bi-arrow-left mr-1"></i> Kembali
	</a>
</div>

<!-- PROFIL KURIR -->
<div class="custom-card mb-4">
	<div class="card-header-custom">
		<i class="bi bi-person-vcard-fill" style="color:var(--amber-cream);"></i>
		<h6>Profil Kurir</h6>
	</div>
	<div class="card-body-custom">
		<div class="profile-row mb-3">
			<div class="profile-avatar"><i class="bi bi-person-circle"></i></div>
			<div>
				<h5 class="mb-1" style="font-weight:700;"><?= htmlspecialchars($kurir['nama_kurir']); ?></h5>
				<?php
				$badge_class = ['Active' => 'badge-active', 'Inactive' => 'badge-inactive'];
				$cls = $badge_class[$kurir['status']] ?? 'badge-inactive';
				?>
				<span class="status-badge <?= $cls; ?>"><?= $kurir['status']; ?></span>
				<?php if (!empty($kurir['deleted_at'])): ?>
					<span class="status-badge" style="background:#FEE2E2; color:#991B1B;">Dihapus (Soft Delete)</span>
				<?php endif; ?>
			</div>
		</div>
		<dl class="row profile-info mb-0">
			<div class="col-md-4">
				<dt>No. Telepon</dt>
				<dd><?= htmlspecialchars($kurir['no_telepon']); ?></dd>
			</div>
			<div class="col-md-4">
				<dt>Email</dt>
				<dd><?= $kurir['email'] ? htmlspecialchars($kurir['email']) : '-'; ?></dd>
			</div>
			<div class="col-md-4">
				<dt>Lokasi Terakhir</dt>
				<dd><?= $kurir['lokasi_terakhir'] ? htmlspecialchars($kurir['lokasi_terakhir']) : '-'; ?></dd>
			</div>
			<div class="col-md-4">
				<dt>Terdaftar Sejak</dt>
				<dd><?= date('d F Y', strtotime($kurir['created_at'])); ?></dd>
			</div>
			<div class="col-md-4">
				<dt>Update Terakhir</dt>
				<dd><?= date('d F Y, H:i', strtotime($kurir['updated_at'])); ?></dd>
			</div>
		</dl>
	</div>
</div>

<!-- HISTORY PENGIRIMAN -->
<div class="custom-card">
	<div class="card-header-custom">
		<i class="bi bi-clock-history" style="color:var(--amber-cream);"></i>
		<h6>History Pengiriman (<?= count($pengiriman); ?>)</h6>
	</div>
	<div class="card-body-custom">
		<?php if (empty($pengiriman)): ?>
			<div class="text-center text-muted py-4">
				<i class="bi bi-inbox d-block mb-2" style="font-size:2rem;"></i>
				<p class="mb-0">Kurir ini belum pernah menangani pengiriman apa pun.</p>
			</div>
		<?php else: ?>
			<?php foreach ($pengiriman as $p): ?>
				<div class="tracking-block">
					<div class="tb-header">
						<span class="tb-invoice"><?= htmlspecialchars($p['invoice'] ?? '-'); ?></span>
						<span class="status-pill"><?= str_replace('_', ' ', $p['status_pengiriman']); ?></span>
					</div>
					<p class="text-muted small mb-2">
						Total: Rp <?= number_format($p['total_harga'] ?? 0, 0, ',', '.'); ?>
						&middot; Dibuat: <?= date('d M Y, H:i', strtotime($p['tracking_created_at'])); ?>
					</p>

					<?php if (!empty($p['history'])): ?>
						<div class="timeline mt-3">
							<?php foreach ($p['history'] as $h): ?>
								<div class="timeline-item">
									<div class="t-status"><?= str_replace('_', ' ', $h['status']); ?></div>
									<div class="t-time"><?= date('d M Y, H:i', strtotime($h['created_at'])); ?></div>
									<?php if (!empty($h['keterangan'])): ?>
										<div class="t-desc"><?= htmlspecialchars($h['keterangan']); ?></div>
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
						</div>
					<?php else: ?>
						<p class="text-muted small mb-0">Belum ada jejak history untuk pengiriman ini.</p>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>