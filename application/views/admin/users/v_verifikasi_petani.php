<!-- STYLES KHUSUS PAGE VERIFIKASI PETANI -->
	<style>
		.card-petani {
			background: var(--card-white, #FFFFFF);
			border: 1px solid rgba(74, 44, 17, 0.08);
			border-radius: 12px;
			padding: 20px;
			margin-bottom: 20px;
			box-shadow: var(--shadow-soft, 0 8px 30px rgba(44, 24, 8, 0.08));
			transition: all 0.3s ease;
		}

		.card-petani:hover {
			box-shadow: 0 12px 40px rgba(44, 24, 8, 0.15);
			transform: translateY(-2px);
		}

		.petani-header {
			display: flex;
			justify-content: space-between;
			align-items: flex-start;
		}

		.petani-info { flex: 1; }

		.petani-nama {
			font-size: 1.1rem;
			font-weight: 700;
			color: var(--dark-coffee, #2C1808);
			margin-bottom: 5px;
		}

		.petani-meta {
			font-size: 0.85rem;
			color: var(--text-secondary, #70655E);
			display: flex;
			gap: 20px;
			margin-bottom: 10px;
			flex-wrap: wrap;
		}

		.petani-status {
			display: inline-block;
			padding: 4px 12px;
			background: #FEE2E2;
			color: #7F1D1D;
			border-radius: 6px;
			font-size: 0.75rem;
			font-weight: 600;
		}

		.action-buttons-petani {
			display: flex;
			gap: 10px;
		}

		.btn-verify {
			background: #10B981;
			color: white;
			border: none;
			padding: 8px 16px;
			border-radius: 8px;
			font-weight: 600;
			font-size: 0.85rem;
			cursor: pointer;
			transition: all 0.3s ease;
			display: inline-flex;
			align-items: center;
			gap: 6px;
			text-decoration: none !important;
		}

		.btn-verify:hover { background: #059669; transform: translateY(-2px); color: white; }

		.btn-reject {
			background: #EF4444;
			color: white;
			border: none;
			padding: 8px 16px;
			border-radius: 8px;
			font-weight: 600;
			font-size: 0.85rem;
			cursor: pointer;
			transition: all 0.3s ease;
			display: inline-flex;
			align-items: center;
			gap: 6px;
			text-decoration: none !important;
		}

		.btn-reject:hover { background: #DC2626; transform: translateY(-2px); color: white; }

		.empty-state {
			text-align: center;
			padding: 60px 20px;
			color: var(--text-secondary, #70655E);
			background: var(--card-white);
			border-radius: 12px;
			border: 1px solid rgba(74,44,17,0.06);
		}

		.empty-state-icon {
			font-size: 3rem;
			color: var(--amber-cream, #E6A15C);
			margin-bottom: 20px;
			opacity: 0.5;
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

		@media (max-width: 767.98px) {
			.petani-header { flex-direction: column; gap: 15px; }
			.action-buttons-petani { width: 100%; justify-content: flex-end; }
		}
	</style>


		<a href="<?= base_url('admin/user'); ?>" class="back-link">
			<i class="bi bi-arrow-left"></i>Kembali ke Manajemen User
		</a>

		<?php if ($this->session->flashdata('success')): ?>
			<div class="alert alert-success alert-custom alert-dismissible fade show" style="border-radius:12px;">
				<i class="bi bi-check-circle-fill mr-2"></i>
				<?= $this->session->flashdata('success'); ?>
				<button type="button" class="close" data-dismiss="alert">&times;</button>
			</div>
		<?php endif; ?>

		<?php if ($this->session->flashdata('error')): ?>
			<div class="alert alert-danger alert-custom alert-dismissible fade show" style="border-radius:12px;">
				<i class="bi bi-exclamation-triangle-fill mr-2"></i>
				<?= $this->session->flashdata('error'); ?>
				<button type="button" class="close" data-dismiss="alert">&times;</button>
			</div>
		<?php endif; ?>

		<?php if (!empty($petani)): ?>
			<?php foreach ($petani as $p): ?>
				<div class="card-petani">
					<div class="petani-header">
						<div class="petani-info">
							<div class="petani-nama">
								<i class="bi bi-person-circle mr-2" style="color: var(--amber-cream, #E6A15C);"></i>
								<?= $p['nama']; ?>
							</div>
							<div class="petani-meta">
								<span>
									<i class="bi bi-at mr-1"></i>
									<strong><?= $p['username']; ?></strong>
								</span>
								<span>
									<i class="bi bi-telephone mr-1"></i>
									<?= $p['no_telepon']; ?>
								</span>
								<span>
									<i class="bi bi-calendar mr-1"></i>
									<?= date('d M Y', strtotime($p['created_at'])); ?>
								</span>
							</div>
							<span class="petani-status">
								<i class="bi bi-clock-history mr-1"></i>Menunggu Verifikasi
							</span>
						</div>
						<div class="action-buttons-petani">
							<a href="<?= base_url('admin/users/verify_petani/' . $p['id_user']); ?>" class="btn-verify" onclick="return confirm('Verifikasi akun petani ini?')">
								<i class="bi bi-check-circle"></i>Verifikasi
							</a>
							<a href="<?= base_url('admin/users/reject_petani/' . $p['id_user']); ?>" class="btn-reject" onclick="return confirm('Tolak akun petani ini?')">
								<i class="bi bi-x-circle"></i>Tolak
							</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<div class="empty-state">
				<div class="empty-state-icon">
					<i class="bi bi-inbox"></i>
				</div>
				<h5 style="font-weight: 700; color: var(--dark-coffee, #2C1808); margin-bottom: 10px;">Tidak Ada Petani yang Menunggu Verifikasi</h5>
				<p class="mb-0">Semua akun petani sudah diverifikasi. Periksa kembali nanti untuk petani baru yang mendaftar.</p>
			</div>
		<?php endif; ?>
	</div>
