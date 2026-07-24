<!-- STYLES KHUSUS FORM TAMBAH USER -->
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

<!-- FORM CARD -->
<div class="custom-card" style="background: #fff; border-radius: 14px; border: 1px solid rgba(74, 44, 17, 0.08); padding: 24px;">
	<div class="card-header-custom d-flex justify-content-between align-items-center mb-4" style="border-bottom: 1px solid #F0EBE1; padding-bottom: 16px;">
		<h5 class="mb-0" style="font-weight: 700; color: #2C1808;">
			<i class="bi bi-person-plus-fill text-success mr-2"></i> Form Tambah User
		</h5>
	</div>
	<div class="card-body-custom">
		<form method="post" action="<?= site_url('admin/user/add') ?>">
			<div class="form-group mb-3">
				<label for="nama" class="form-label" style="font-weight: 600; font-size: 0.85rem;">
					<i class="bi bi-person mr-1 text-muted"></i> Nama Lengkap
				</label>
				<input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama lengkap" required value="<?= set_value('nama') ?>" style="border-radius: 8px; height: 42px;" />
			</div>
			<div class="form-group mb-3">
				<label for="username" class="form-label" style="font-weight: 600; font-size: 0.85rem;">
					<i class="bi bi-at mr-1 text-muted"></i> Username
				</label>
				<input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username" required value="<?= set_value('username') ?>" style="border-radius: 8px; height: 42px;" />
			</div>
			<div class="form-group mb-3">
				<label for="no_telepon" class="form-label" style="font-weight: 600; font-size: 0.85rem;">
					<i class="bi bi-telephone mr-1 text-muted"></i> Nomor Telepon
				</label>
				<input type="tel" name="no_telepon" id="no_telepon" class="form-control" placeholder="0812345678" required value="<?= set_value('no_telepon') ?>" style="border-radius: 8px; height: 42px;" />
			</div>
			<div class="form-group mb-3">
				<label for="password" class="form-label" style="font-weight: 600; font-size: 0.85rem;">
					<i class="bi bi-lock mr-1 text-muted"></i> Password
				</label>
				<input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required style="border-radius: 8px; height: 42px;" />
			</div>
			<div class="form-group mb-4">
				<label for="role" class="form-label" style="font-weight: 600; font-size: 0.85rem;">
					<i class="bi bi-tag mr-1 text-muted"></i> Role
				</label>
				<select name="role" id="role" class="form-control" required style="border-radius: 8px; height: 42px;">
					<option value="">-- Pilih Role --</option>
					<option value="Admin" <?= set_value('role') === 'Admin' ? 'selected' : '' ?>>Admin</option>
					<option value="Petani" <?= set_value('role') === 'Petani' ? 'selected' : '' ?>>Petani</option>
					<option value="Pembeli" <?= set_value('role') === 'Pembeli' ? 'selected' : '' ?>>Pembeli</option>
					<option value="Guest" <?= set_value('role') === 'Guest' ? 'selected' : '' ?>>Guest</option>
				</select>
			</div>
			<div class="d-flex gap-2" style="gap: 10px;">
				<button type="submit" class="btn-custom-primary">
					<i class="bi bi-save mr-2"></i> Simpan
				</button>
				<a href="<?= site_url('admin/user') ?>" class="btn-custom-secondary">
					<i class="bi bi-arrow-left mr-2"></i> Batal
				</a>
			</div>
		</form>
	</div>
</div>