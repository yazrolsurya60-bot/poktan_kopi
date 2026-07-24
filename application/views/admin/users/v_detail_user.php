<!-- STYLES KHUSUS PAGE DETAIL USER -->
	<style>
		.page-header-detail {
			background: linear-gradient(135deg, var(--roasted-brown) 0%, var(--dark-coffee) 100%);
			color: white;
			padding: 30px 40px;
			margin-bottom: 30px;
			border-radius: var(--radius-card, 14px);
			box-shadow: 0 8px 20px rgba(44, 24, 8, 0.15);
		}

		.page-title-detail {
			font-weight: 700;
			font-size: 1.8rem;
			margin-bottom: 0;
			letter-spacing: -0.5px;
		}

		.card-detail {
			background: var(--card-white, #FFFFFF);
			border: 1px solid rgba(74, 44, 17, 0.08);
			border-radius: 12px;
			padding: 30px;
			margin-bottom: 20px;
			box-shadow: var(--shadow-soft, 0 8px 30px rgba(44, 24, 8, 0.08));
		}

		.user-avatar {
			width: 80px;
			height: 80px;
			background: linear-gradient(135deg, var(--roasted-brown, #4A2C11), var(--amber-cream, #E6A15C));
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

		.detail-label {
			font-weight: 600;
			color: var(--text-secondary, #70655E);
			font-size: 0.85rem;
			text-transform: uppercase;
			letter-spacing: 0.5px;
			margin-bottom: 5px;
		}

		.detail-value {
			font-size: 1rem;
			color: var(--dark-coffee, #2C1808);
			font-weight: 500;
		}

		.status-badge {
			display: inline-block;
			padding: 6px 14px;
			border-radius: 8px;
			font-weight: 600;
			font-size: 0.85rem;
			margin-top: 5px;
		}

		.status-active { background: #DCFCE7; color: #166534; }
		.status-inactive { background: #FEE2E2; color: #7F1D1D; }
		.status-pending { background: #FEF3C7; color: #92400E; }

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
			transition: all 0.3s ease;
			border: none;
			text-decoration: none;
			display: inline-flex;
			align-items: center;
			gap: 8px;
		}

		.btn-activate { background: #10B981; color: white; }
		.btn-activate:hover { background: #059669; color: white; transform: translateY(-2px); }
		.btn-deactivate { background: #EF4444; color: white; }
		.btn-deactivate:hover { background: #DC2626; color: white; transform: translateY(-2px); }
		.btn-back { background: transparent; color: var(--amber-cream, #E6A15C); border: 2px solid var(--amber-cream, #E6A15C); }
		.btn-back:hover { background: var(--amber-cream, #E6A15C); color: white; text-decoration: none; }

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

		@media (max-width: 575.98px) {
			.detail-row { grid-template-columns: 1fr; gap: 15px; }
			.action-buttons { flex-direction: column; }
			.btn-custom { width: 100%; justify-content: center; }
		}
	</style>


		<a href="<?= base_url('admin/user'); ?>" class="back-link">
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
				<a href="<?= base_url('admin/user'); ?>" class="btn-custom btn-back">
					<i class="bi bi-arrow-left"></i> Kembali
				</a>
			</div>
		</div>
	</div>
