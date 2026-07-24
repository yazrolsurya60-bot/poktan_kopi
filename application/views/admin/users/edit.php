<!-- STYLES KHUSUS FORM EDIT USER -->
<style>
	.btn-custom-primary {
		background: var(--roasted-brown, #4A2C11) !important;
		color: #ffffff !important;
		border-radius: 10px;
		padding: 10px 28px;
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
		background: var(--dark-coffee, #2C1808) !important;
		color: #ffffff !important;
		transform: translateY(-2px);
	}

	.btn-custom-secondary {
		background: transparent;
		color: var(--text-secondary, #70655E);
		border: 1px solid rgba(74, 44, 17, 0.15);
		border-radius: 10px;
		padding: 10px 28px;
		font-weight: 600;
		font-size: 0.85rem;
		transition: all 0.3s ease;
		display: inline-flex;
		align-items: center;
		justify-content: center;
	}

	.btn-custom-secondary:hover {
		background: var(--bg-cream, #FAF6F0);
		color: var(--roasted-brown, #4A2C11);
		text-decoration: none;
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

<?php $user = $user ?? []; ?>

<!-- FORM CARD -->
<div class="custom-card" style="background: #fff; border-radius: 14px; border: 1px solid rgba(74, 44, 17, 0.08); padding: 24px;">
	<div class="card-header-custom d-flex justify-content-between align-items-center mb-4" style="border-bottom: 1px solid #F0EBE1; padding-bottom: 16px;">
		<h5 class="mb-0" style="font-weight: 700; color: #2C1808;">
			<i class="bi bi-pencil-square text-primary mr-2"></i> Form Edit User
		</h5>
		<span class="badge badge-light p-2">ID: <?= $user['id_user'] ?? '-' ?></span>
	</div>
	<div class="card-body-custom">
		<form method="post" action="<?= site_url('admin/user/edit/' . ($user['id_user'] ?? '')) ?>">
			<div class="form-group mb-3">
				<label for="nama" class="form-label" style="font-weight: 600; font-size: 0.85rem;">
					<i class="bi bi-person mr-1 text-muted"></i> Nama Lengkap
				</label>
				<input type="text" name="nama" id="nama" class="form-control" 
					   value="<?= htmlspecialchars($user['nama'] ?? '') ?>" 
					   placeholder="Masukkan nama lengkap" required style="border-radius: 8px; height: 42px;" />
			</div>
			<div class="form-group mb-3">
				<label for="username" class="form-label" style="font-weight: 600; font-size: 0.85rem;">
					<i class="bi bi-at mr-1 text-muted"></i> Username
				</label>
				<input type="text" name="username" id="username" class="form-control" 
					   value="<?= htmlspecialchars($user['username'] ?? '') ?>" 
					   placeholder="Masukkan username" required style="border-radius: 8px; height: 42px;" />
			</div>
			<div class="form-group mb-3">
				<label for="no_telepon" class="form-label" style="font-weight: 600; font-size: 0.85rem;">
					<i class="bi bi-telephone mr-1 text-muted"></i> Nomor Telepon
				</label>
				<input type="tel" name="no_telepon" id="no_telepon" class="form-control" 
					   value="<?= htmlspecialchars($user['no_telepon'] ?? '') ?>" 
					   placeholder="0812345678" style="border-radius: 8px; height: 42px;" />
			</div>
			<div class="form-group mb-3">
				<label for="password" class="form-label" style="font-weight: 600; font-size: 0.85rem;">
					<i class="bi bi-lock mr-1 text-muted"></i> Password
				</label>
				<input type="password" name="password" id="password" class="form-control" 
					   placeholder="Kosongkan jika tidak ingin mengubah password" style="border-radius: 8px; height: 42px;" />
				<small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password</small>
			</div>
			<div class="form-group mb-3">
				<label for="role" class="form-label" style="font-weight: 600; font-size: 0.85rem;">
					<i class="bi bi-tag mr-1 text-muted"></i> Role
				</label>
				<select name="role" id="role" class="form-control" required style="border-radius: 8px; height: 42px;">
					<option value="">-- Pilih Role --</option>
					<option value="Admin" <?= (isset($user['role']) && $user['role'] === 'Admin') ? 'selected' : '' ?>>Admin</option>
					<option value="Petani" <?= (isset($user['role']) && $user['role'] === 'Petani') ? 'selected' : '' ?>>Petani</option>
					<option value="Pembeli" <?= (isset($user['role']) && $user['role'] === 'Pembeli') ? 'selected' : '' ?>>Pembeli</option>
					<option value="Guest" <?= (isset($user['role']) && $user['role'] === 'Guest') ? 'selected' : '' ?>>Guest</option>
				</select>
			</div>
			<?php if (isset($user['role']) && $user['role'] === 'Petani'): ?>
			<div class="form-group mb-4">
				<label for="is_verified" class="form-label" style="font-weight: 600; font-size: 0.85rem;">
					<i class="bi bi-patch-check mr-1 text-muted"></i> Status Verifikasi
				</label>
				<select name="is_verified" id="is_verified" class="form-control" style="border-radius: 8px; height: 42px;">
					<option value="0" <?= (isset($user['is_verified']) && $user['is_verified'] === '0') ? 'selected' : '' ?>>Belum Terverifikasi</option>
					<option value="1" <?= (isset($user['is_verified']) && $user['is_verified'] === '1') ? 'selected' : '' ?>>Terverifikasi</option>
				</select>
			</div>
			<?php endif; ?>
			<div class="d-flex gap-2" style="gap: 10px;">
				<button type="submit" class="btn-custom-primary">
					<i class="bi bi-check-lg mr-2"></i> Update
				</button>
				<a href="<?= site_url('admin/user') ?>" class="btn-custom-secondary">
					<i class="bi bi-arrow-left mr-2"></i> Batal
				</a>
			</div>
		</form>
	</div>
</div>