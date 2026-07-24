<style>
	.detail-row {
		border-bottom: 1px solid rgba(74, 44, 17, 0.05);
		padding-bottom: 10px;
		margin-bottom: 15px;
	}

	.detail-label {
		font-size: 0.8rem;
		color: var(--text-secondary, #70655E);
		text-transform: uppercase;
		font-weight: 700;
		letter-spacing: 0.5px;
		margin-bottom: 4px;
	}

	.detail-value {
		font-size: 1rem;
		font-weight: 600;
		color: var(--dark-coffee, #2C1808);
	}

	.foto-box img {
		width: 100%;
		max-width: 400px;
		border-radius: 10px;
		box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
	}

	.back-link {
		display: inline-flex;
		align-items: center;
		gap: 6px;
		color: var(--amber-cream, #E6A15C);
		text-decoration: none;
		font-weight: 600;
		margin-bottom: 20px;
		transition: all 0.3s ease;
	}

	.back-link:hover { color: var(--roasted-brown, #4A2C11); gap: 10px; text-decoration: none; }
</style>

<a href="<?= base_url('admin/panen'); ?>" class="back-link">
	<i class="bi bi-arrow-left"></i>Kembali ke Rekap Hasil Panen
</a>

<div class="custom-card">
	<div class="card-header-custom" style="padding: 18px 24px; border-bottom: 1px solid rgba(74, 44, 17, 0.06); font-weight: 700; font-size: 0.9rem;">
		<i class="bi bi-info-circle mr-2 text-warning"></i>Informasi Panen Petani: <span
			class="text-primary"><?= htmlspecialchars($panen['nama_petani'] ?? 'Unknown'); ?></span>
	</div>
	<div class="card-body-custom" style="padding: 24px;">
		<div class="row">
			<div class="col-md-7">
				<div class="detail-row">
					<div class="detail-label">Petani</div>
					<div class="detail-value text-primary">
						<?= htmlspecialchars($panen['nama_petani'] ?? 'Unknown'); ?></div>
				</div>
				<div class="detail-row">
					<div class="detail-label">Tanggal Panen</div>
					<div class="detail-value"><?= date('d F Y', strtotime($panen['tanggal_panen'])); ?></div>
				</div>
				<div class="detail-row">
					<div class="detail-label">Lahan</div>
					<div class="detail-value"><?= htmlspecialchars($panen['nama_lahan'] ?? '-'); ?> <br><small
							class="text-muted"><i class="bi bi-geo-alt"></i>
							<?= htmlspecialchars($panen['lokasi'] ?? '-'); ?></small></div>
				</div>
				<div class="detail-row">
					<div class="detail-label">Jumlah Panen</div>
					<div class="detail-value text-success" style="font-size: 1.3rem;">
						<?= number_format($panen['jumlah_panen'], 0, ',', '.'); ?> Kg</div>
				</div>
				<div class="detail-row">
					<div class="detail-label">Kualitas / Grade</div>
					<div class="detail-value"><span class="badge badge-light"
							style="font-size:0.9rem; border:1px solid #ccc; padding:6px 12px;"><?= htmlspecialchars($panen['kualitas'] ?? '-'); ?></span>
					</div>
				</div>
				<div class="detail-row">
					<div class="detail-label">Catatan Tambahan</div>
					<div class="detail-value" style="font-weight: 500; font-size: 0.9rem; color: #555;">
						<?= !empty($panen['catatan']) ? nl2br(htmlspecialchars($panen['catatan'])) : '<i>Tidak ada catatan</i>'; ?>
					</div>
				</div>
				<div class="detail-row" style="border:none;">
					<div class="detail-label">Dicatat Pada</div>
					<div class="detail-value" style="font-size: 0.8rem; font-weight: 400;">
						<?= date('d F Y H:i:s', strtotime($panen['created_at'])); ?></div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="detail-label mb-2">Foto Hasil Panen</div>
				<div class="foto-box">
					<?php if (!empty($panen['foto_panen'])): ?>
						<img src="<?= base_url('uploads/panen/' . $panen['foto_panen']); ?>" alt="Foto Panen">
					<?php else: ?>
						<div class="alert alert-secondary text-center">Belum ada foto yang diunggah.</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
