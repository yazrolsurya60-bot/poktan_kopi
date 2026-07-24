<!-- STYLES KHUSUS MANAJEMEN USER -->
<style>
	:root {
		--roasted-brown: #4A2C11;
		--dark-coffee: #2C1808;
		--amber-cream: #E6A15C;
		--bg-cream: #FAF6F0;
		--card-white: #FFFFFF;
		--text-secondary: #70655E;
	}

	.btn-custom-primary {
		background: var(--dark-coffee) !important;
		color: #ffffff !important;
		border-radius: 10px;
		padding: 8px 20px;
		font-weight: 600;
		font-size: 0.85rem;
		border: none;
		transition: all 0.3s ease;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		text-decoration: none !important;
	}

	.btn-custom-primary:hover {
		background: var(--roasted-brown) !important;
		color: #ffffff !important;
		transform: translateY(-1px);
	}

	.btn-icon-round {
		width: 32px;
		height: 32px;
		border-radius: 50%;
		border: 1px solid #E5E7EB;
		background: #ffffff;
		color: #6B7280;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		transition: all 0.2s ease;
		text-decoration: none !important;
		font-size: 0.85rem;
	}

	.btn-icon-round:hover {
		background: #F9FAFB;
		color: var(--dark-coffee);
		border-color: #D1D5DB;
	}

	.btn-icon-round-danger {
		width: 32px;
		height: 32px;
		border-radius: 50%;
		border: 1px solid #FCA5A5;
		background: #ffffff;
		color: #EF4444;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		transition: all 0.2s ease;
		text-decoration: none !important;
		font-size: 0.85rem;
	}

	.btn-icon-round-danger:hover {
		background: #FEE2E2;
		color: #DC2626;
	}

	.badge-role {
		background: #F3F4F6;
		color: #4B5563;
		padding: 4px 14px;
		border-radius: 20px;
		font-weight: 500;
		font-size: 0.78rem;
		display: inline-block;
	}

	.badge-status-active {
		background: #DCFCE7;
		color: #15803D;
		padding: 4px 12px;
		border-radius: 20px;
		font-weight: 600;
		font-size: 0.75rem;
		display: inline-flex;
		align-items: center;
		gap: 4px;
	}

	.badge-status-inactive {
		background: #FEE2E2;
		color: #B91C1C;
		padding: 4px 12px;
		border-radius: 20px;
		font-weight: 600;
		font-size: 0.75rem;
		display: inline-flex;
		align-items: center;
		gap: 4px;
	}

	.table-custom-user {
		width: 100%;
		border-collapse: separate;
		border-spacing: 0;
	}

	.table-custom-user th {
		background: #FAF8F5;
		color: #70655E;
		font-size: 0.72rem;
		font-weight: 700;
		letter-spacing: 0.5px;
		padding: 12px 16px;
		border-bottom: 1px solid #F0EBE1;
		text-transform: uppercase;
	}

	.table-custom-user td {
		padding: 14px 16px;
		border-bottom: 1px solid #F0EBE1;
		vertical-align: middle;
		font-size: 0.88rem;
		color: #2C1808;
	}

	.custom-card-user {
		background: #ffffff;
		border-radius: 16px;
		border: 1px solid rgba(74, 44, 17, 0.06);
		box-shadow: 0 4px 20px rgba(44, 24, 8, 0.04);
		overflow: hidden;
	}
</style>

<!-- ALERT MESSAGES -->
<?php if ($this->session->flashdata('success')): ?>
	<div class="alert alert-success alert-dismissible fade show mb-3" style="border-radius: 12px;">
		<i class="bi bi-check-circle-fill mr-2"></i> <?= $this->session->flashdata('success') ?>
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
	<div class="alert alert-danger alert-dismissible fade show mb-3" style="border-radius: 12px;">
		<i class="bi bi-exclamation-circle-fill mr-2"></i> <?= $this->session->flashdata('error') ?>
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
<?php endif; ?>

<!-- SEARCH & FILTER CARD -->
<div class="custom-card-user mb-4" style="padding: 24px;">
	<form method="get" action="<?= site_url('admin/user') ?>">
		<div class="row align-items-end">
			<div class="col-md-4">
				<label for="search" class="form-label" style="font-weight: 600; font-size: 0.85rem; color: #2C1808;">
					<i class="bi bi-search mr-1"></i> Cari User
				</label>
				<input type="text" name="search" id="search" class="form-control" style="border-radius: 8px; height: 42px;"
					placeholder="Nama, username, atau nomor telepon"
					value="<?= htmlspecialchars($search ?? '') ?>" />
			</div>
			<div class="col-md-3">
				<label for="role" class="form-label" style="font-weight: 600; font-size: 0.85rem; color: #2C1808;">Role</label>
				<select name="role" id="role" class="form-control" style="border-radius: 8px; height: 42px;">
					<option value="">Semua Role</option>
					<option value="Admin" <?= ($role_filter ?? '') === 'Admin' ? 'selected' : '' ?>>Admin</option>
					<option value="Petani" <?= ($role_filter ?? '') === 'Petani' ? 'selected' : '' ?>>Petani</option>
					<option value="Pembeli" <?= ($role_filter ?? '') === 'Pembeli' ? 'selected' : '' ?>>Pembeli</option>
					<option value="Guest" <?= ($role_filter ?? '') === 'Guest' ? 'selected' : '' ?>>Guest</option>
				</select>
			</div>
			<div class="col-md-3">
				<label for="status" class="form-label" style="font-weight: 600; font-size: 0.85rem; color: #2C1808;">Status</label>
				<select name="status" id="status" class="form-control" style="border-radius: 8px; height: 42px;">
					<option value="">Semua Status</option>
					<option value="Active" <?= ($status ?? '') === 'Active' ? 'selected' : '' ?>>Aktif</option>
					<option value="Inactive" <?= ($status ?? '') === 'Inactive' ? 'selected' : '' ?>>Nonaktif</option>
				</select>
			</div>
			<div class="col-md-2">
				<button type="submit" class="btn-custom-primary w-100" style="height: 42px;">
					<i class="bi bi-search mr-2"></i> Cari
				</button>
			</div>
		</div>
		<?php if (!empty($search) || !empty($role_filter) || !empty($status)): ?>
			<div class="mt-2">
				<a href="<?= site_url('admin/user') ?>" class="btn btn-sm btn-link text-muted p-0" style="font-size: 0.8rem;">
					<i class="bi bi-x-circle mr-1"></i> Reset Filter
				</a>
			</div>
		<?php endif; ?>
	</form>
</div>

<!-- USER TABLE CARD -->
<div class="custom-card-user">
	<div class="d-flex justify-content-between align-items-center" style="padding: 20px 24px; border-bottom: 1px solid #F0EBE1;">
		<h6 class="mb-0" style="font-weight: 700; color: #2C1808; display: flex; align-items: center; gap: 8px;">
			<i class="bi bi-people-fill" style="color: #E6A15C; font-size: 1.1rem;"></i> Daftar User
		</h6>
		<a href="<?= site_url('admin/user/add') ?>" class="btn-custom-primary">
			<i class="bi bi-plus-lg mr-2"></i> Tambah User
		</a>
	</div>

	<div class="table-responsive">
		<table class="table-custom-user mb-0">
			<thead>
				<tr>
					<th style="width: 50px;">#</th>
					<th>NAMA</th>
					<th>USERNAME</th>
					<th>NOMOR TELEPON</th>
					<th>ROLE</th>
					<th>STATUS</th>
					<th class="text-center" style="width: 160px;">AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($users)): ?>
					<?php $i = 1; foreach ($users as $user): ?>
						<tr>
							<td><?= $i++ ?></td>
							<td><strong style="color: #2C1808;"><?= htmlspecialchars($user['nama'] ?? '-') ?></strong></td>
							<td><?= htmlspecialchars($user['username']) ?></td>
							<td><?= htmlspecialchars($user['no_telepon'] ?? '-') ?></td>
							<td>
								<span class="badge-role">
									<?= ucfirst($user['role'] ?? '-') ?>
								</span>
							</td>
							<td>
								<?php if (($user['status'] ?? '') === 'Active'): ?>
									<span class="badge-status-active">
										<i class="bi bi-check-circle"></i> Aktif
									</span>
								<?php else: ?>
									<span class="badge-status-inactive">
										<i class="bi bi-x-circle"></i> Nonaktif
									</span>
								<?php endif; ?>
							</td>
							<td class="text-center">
								<div class="d-inline-flex gap-1" style="gap: 6px;">
									<a href="<?= site_url('admin/user/edit/' . $user['id_user']) ?>" class="btn-icon-round" title="Edit">
										<i class="bi bi-pencil"></i>
									</a>

									<?php if (strtolower($user['role'] ?? '') !== 'admin'): ?>
										<?php if (($user['status'] ?? '') === 'Active'): ?>
											<a href="<?= site_url('admin/user/deactivate/' . $user['id_user']) ?>"
												class="btn-icon-round"
												title="Nonaktifkan"
												onclick="return confirm('Apakah Anda yakin ingin menonaktifkan user ini?')">
												<i class="bi bi-pause-circle"></i>
											</a>
										<?php else: ?>
											<a href="<?= site_url('admin/user/activate/' . $user['id_user']) ?>"
												class="btn-icon-round"
												title="Aktifkan"
												onclick="return confirm('Apakah Anda yakin ingin mengaktifkan user ini?')">
												<i class="bi bi-play-circle"></i>
											</a>
										<?php endif; ?>
									<?php endif; ?>

									<?php if (strtolower($user['role'] ?? '') === 'petani' && isset($user['is_verified']) && $user['is_verified'] === '0'): ?>
										<a href="<?= site_url('admin/users/verify_petani/' . $user['id_user']) ?>"
											class="btn-icon-round"
											title="Verifikasi Petani"
											onclick="return confirm('Apakah Anda yakin ingin memverifikasi akun Petani ini?')">
											<i class="bi bi-patch-check"></i>
										</a>
									<?php endif; ?>

									<a href="<?= site_url('admin/user/delete/' . $user['id_user']) ?>" 
										class="btn-icon-round-danger"
										onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')"
										title="Hapus">
										<i class="bi bi-trash"></i>
									</a>
								</div>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php else: ?>
					<tr>
						<td colspan="7" class="text-center py-5 text-muted">
							<i class="bi bi-people d-block mb-2" style="font-size: 2rem; color: #D1D5DB;"></i>
							Belum ada data user
						</td>
					</tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>