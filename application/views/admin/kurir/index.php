<style>
	:root {
		--roasted-brown: #4A2C11;
		--dark-coffee: #2C1808;
		--amber-cream: #E6A15C;
		--bg-cream: #FAF6F0;
		--card-white: #FFFFFF;
		--text-secondary: #70655E;
		--shadow-soft: 0 8px 30px rgba(44, 24, 8, 0.08);
		--shadow-hover: 0 12px 40px rgba(44, 24, 8, 0.15);
		--radius-card: 14px;
		--transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
	}

	.stat-box {
		background: var(--card-white);
		border: 1px solid rgba(74, 44, 17, 0.06);
		border-radius: var(--radius-card);
		padding: 20px 22px;
		box-shadow: var(--shadow-soft);
		transition: var(--transition-smooth);
		display: flex;
		align-items: center;
		gap: 16px;
		height: 100%;
	}
	.stat-box:hover { transform: translateY(-3px); box-shadow: var(--shadow-hover); }

	.stat-icon-box {
		width: 48px; height: 48px; min-width: 48px;
		border-radius: 12px; display: flex; align-items: center; justify-content: center;
		font-size: 1.3rem;
	}
	.bg-success-soft { background: #D1FAE5; color: #065F46; }
	.bg-warning-soft { background: #FEF3C7; color: #92400E; }

	.stat-title { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; color: var(--text-secondary); letter-spacing: 0.5px; margin: 0; }
	.stat-num { font-size: 1.5rem; font-weight: 700; margin: 2px 0 0; color: var(--dark-coffee); }

	.custom-card { background: var(--card-white); border: 1px solid rgba(74, 44, 17, 0.06); border-radius: var(--radius-card); box-shadow: var(--shadow-soft); overflow: hidden; }
	.custom-card .card-header-custom { padding: 18px 24px; border-bottom: 1px solid rgba(74, 44, 17, 0.06); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; background: rgba(250, 246, 240, 0.3); }
	.custom-card .card-header-custom h6 { font-weight: 700; color: var(--dark-coffee); margin: 0; font-size: 0.9rem; }
	.custom-card .card-header-custom h6 i { color: var(--amber-cream); }

	.form-control-custom { padding: 8px 14px; border: 1.5px solid rgba(74, 44, 17, 0.1); border-radius: 10px; font-size: 0.85rem; color: var(--dark-coffee); background: var(--bg-cream); outline: none; transition: var(--transition-smooth); width: 100%; }
	.form-control-custom:focus { border-color: var(--amber-cream); box-shadow: 0 0 0 3px rgba(230, 161, 92, 0.15); background: var(--card-white); }

	.table-custom { font-size: 0.85rem; margin-bottom: 0; width: 100%; }
	.table-custom thead th { background: var(--bg-cream); border-bottom: 2px solid rgba(74, 44, 17, 0.06); color: var(--text-secondary); font-weight: 700; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 16px; border-top: none; white-space: nowrap; }
	.table-custom tbody td { padding: 12px 16px; border-bottom: 1px solid rgba(74, 44, 17, 0.04); vertical-align: middle; }
	.table-custom tbody tr:hover { background: rgba(250, 246, 240, 0.5); }
	.link-name { color: var(--roasted-brown); font-weight: 600; }

	.status-badge { padding: 4px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: 600; display: inline-block; }
	.status-badge.badge-active   { background: #D1FAE5; color: #065F46; }
	.status-badge.badge-inactive { background: #FEF3C7; color: #92400E; }

	.btn-icon { width: 32px; height: 32px; border-radius: 8px; border: none; display: inline-flex; align-items: center; justify-content: center; font-size: 0.85rem; cursor: pointer; transition: var(--transition-smooth); text-decoration: none; }
	.btn-detail { background: #DBEAFE; color: #1E40AF; }
	.btn-detail:hover { background: #1E40AF; color: #fff; }
	.btn-toggle { background: #EDE9FE; color: #5B21B6; }
	.btn-toggle:hover { background: #5B21B6; color: #fff; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(91, 33, 182, 0.3); }
	.btn-edit   { background: #FEF3C7; color: #92400E; }
	.btn-edit:hover   { background: #92400E; color: #fff; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(146, 64, 14, 0.3); }
	.btn-delete { background: #FEE2E2; color: #991B1B; }
	.btn-delete:hover { background: #991B1B; color: #fff; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(153, 27, 27, 0.3); }

	.btn-primary-custom { background: var(--roasted-brown); color: #fff; border: none; border-radius: 10px; padding: 8px 18px; font-size: 0.85rem; font-weight: 600; transition: var(--transition-smooth); text-decoration: none; display: inline-flex; align-items: center; gap: 6px; cursor: pointer; }
	.btn-primary-custom:hover { background: var(--amber-cream); color: #fff; transform: translateY(-2px); text-decoration: none; }
	.btn-outline-custom { border: 1.5px solid rgba(74, 44, 17, 0.12); color: var(--dark-coffee); background: var(--card-white); border-radius: 10px; padding: 8px 16px; font-size: 0.85rem; font-weight: 600; transition: var(--transition-smooth); text-decoration: none; display: inline-flex; align-items: center; gap: 6px; cursor: pointer; }
	.btn-outline-custom:hover { background: var(--bg-cream); border-color: var(--amber-cream); color: var(--dark-coffee); text-decoration: none; }
</style>

<!-- FLASH MESSAGE -->
<?php if ($this->session->flashdata('success')): ?>
	<div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
		<i class="bi bi-check-circle-fill mr-2"></i><?= $this->session->flashdata('success'); ?>
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
	<div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
		<i class="bi bi-exclamation-circle-fill mr-2"></i><?= $this->session->flashdata('error'); ?>
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
<?php endif; ?>

<!-- RINGKASAN STATISTIK -->
<div class="row mb-4">
	<div class="col-md-6 mb-3 mb-md-0">
		<div class="stat-box">
			<div class="stat-icon-box bg-success-soft"><i class="bi bi-person-check-fill"></i></div>
			<div>
				<p class="stat-title">ACTIVE</p>
				<h3 class="stat-num"><?= $kurir_active ?? 0; ?></h3>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="stat-box">
			<div class="stat-icon-box bg-warning-soft"><i class="bi bi-pause-circle-fill"></i></div>
			<div>
				<p class="stat-title">INACTIVE</p>
				<h3 class="stat-num"><?= $kurir_inactive ?? 0; ?></h3>
			</div>
		</div>
	</div>
</div>

<!-- TABEL DAFTAR KURIR -->
<div class="custom-card">
	<div class="card-header-custom">
		<h6><i class="bi bi-people-fill mr-2"></i>Daftar Kurir</h6>
		<div class="d-flex flex-wrap" style="gap: 8px;">
			<form method="get" action="<?= base_url('admin/kurir'); ?>" class="d-flex">
				<input type="text" name="keyword" class="form-control-custom" placeholder="Cari nama / telepon..." value="<?= htmlspecialchars($keyword ?? ''); ?>" style="min-width:180px;">
			</form>

			<a href="<?= base_url('admin/kurir/performance'); ?>" class="btn-outline-custom">
				<i class="bi bi-bar-chart-fill"></i> Performance
			</a>
			<button type="button" class="btn-primary-custom" data-toggle="modal" data-target="#modalTambah">
				<i class="bi bi-plus-circle-fill"></i> Tambah Kurir
			</button>
		</div>
	</div>
	<div class="card-body-custom">
		<?php if (empty($list_kurir)): ?>
			<div class="empty-state text-center py-5">
				<i class="bi bi-inbox text-muted d-block mb-2" style="font-size: 2.5rem;"></i>
				<p class="mb-0 text-muted">Belum ada data kurir.</p>
			</div>
		<?php else: ?>
			<div class="table-responsive">
				<table class="table table-custom">
					<thead>
						<tr>
							<th width="40">#</th>
							<th>NAMA KURIR</th>
							<th>NO. TELEPON</th>
							<th>EMAIL</th>
							<th>LOKASI TERAKHIR</th>
							<th>STATUS</th>
							<th>TERDAFTAR</th>
							<th width="140" class="text-center">AKSI</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; foreach ($list_kurir as $row): ?>
							<tr>
								<td class="text-muted"><?= $no++; ?></td>
								<td class="link-name"><?= htmlspecialchars($row['nama_kurir']); ?></td>
								<td><?= htmlspecialchars($row['no_telepon']); ?></td>
								<td class="text-muted small"><?= !empty($row['email']) ? htmlspecialchars($row['email']) : '-'; ?></td>
								<td class="text-muted small"><?= !empty($row['lokasi_terakhir']) ? htmlspecialchars($row['lokasi_terakhir']) : '-'; ?></td>
								<td>
									<?php
									$badge_class = [
										'Active'   => 'badge-active',
										'Inactive' => 'badge-inactive',
									];
									$cls = $badge_class[$row['status']] ?? 'badge-inactive';
									?>
									<span class="status-badge <?= $cls; ?>"><?= $row['status']; ?></span>
								</td>
								<td class="text-muted small"><?= date('d M Y', strtotime($row['created_at'])); ?></td>
								<td class="text-center">
									<a href="<?= base_url('admin/kurir/detail/' . $row['id_kurir']); ?>" class="btn-icon btn-detail" title="Detail & History">
										<i class="bi bi-eye"></i>
									</a>
									<a href="<?= base_url('admin/kurir/toggle/' . $row['id_kurir']); ?>" class="btn-icon btn-toggle" title="Toggle Active/Inactive">
										<i class="bi bi-arrow-repeat"></i>
									</a>
									<button type="button" class="btn-icon btn-edit" title="Edit" data-toggle="modal" data-target="#modalEdit<?= $row['id_kurir']; ?>">
										<i class="bi bi-pencil"></i>
									</button>
									<button type="button" class="btn-icon btn-delete" title="Hapus" onclick="confirmDelete(<?= $row['id_kurir']; ?>, '<?= htmlspecialchars($row['nama_kurir'], ENT_QUOTES); ?>')">
										<i class="bi bi-trash"></i>
									</button>
								</td>
							</tr>

							<!-- MODAL EDIT -->
							<div class="modal fade" id="modalEdit<?= $row['id_kurir']; ?>" tabindex="-1">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<form action="<?= base_url('admin/kurir/edit/' . $row['id_kurir']); ?>" method="post">
											<div class="modal-header">
												<h5 class="modal-title">
													<i class="bi bi-pencil-square mr-2"></i>Edit Kurir
												</h5>
												<button type="button" class="close" data-dismiss="modal">&times;</button>
											</div>
											<div class="modal-body">
												<div class="form-group">
													<label class="small font-weight-bold">Nama Kurir</label>
													<input type="text" name="nama_kurir" class="form-control form-control-custom" value="<?= htmlspecialchars($row['nama_kurir']); ?>" required>
												</div>
												<div class="form-group">
													<label class="small font-weight-bold">No. Telepon</label>
													<input type="text" name="no_telepon" class="form-control form-control-custom" value="<?= htmlspecialchars($row['no_telepon']); ?>" required>
												</div>
												<div class="form-group">
													<label class="small font-weight-bold">Email</label>
													<input type="email" name="email" class="form-control form-control-custom" value="<?= htmlspecialchars($row['email'] ?? ''); ?>">
												</div>
												<div class="form-group">
													<label class="small font-weight-bold">Lokasi Terakhir</label>
													<input type="text" name="lokasi_terakhir" class="form-control form-control-custom" value="<?= htmlspecialchars($row['lokasi_terakhir'] ?? ''); ?>">
												</div>
												<div class="form-group mb-0">
													<label class="small font-weight-bold">Status</label>
													<select name="status" class="form-control form-control-custom">
														<option value="Active" <?= $row['status'] == 'Active' ? 'selected' : ''; ?>>Active</option>
														<option value="Inactive" <?= $row['status'] == 'Inactive' ? 'selected' : ''; ?>>Inactive</option>
													</select>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn-outline-custom" data-dismiss="modal">Batal</button>
												<button type="submit" class="btn-primary-custom">
													<i class="bi bi-check-circle-fill"></i> Simpan
												</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php endif; ?>
	</div>
</div>

<!-- MODAL TAMBAH KURIR -->
<div class="modal fade" id="modalTambah" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<form action="<?= base_url('admin/kurir/tambah'); ?>" method="post">
				<div class="modal-header">
					<h5 class="modal-title">
						<i class="bi bi-person-plus-fill mr-2"></i>Tambah Kurir Baru
					</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="small font-weight-bold">Nama Kurir <span class="text-danger">*</span></label>
						<input type="text" name="nama_kurir" class="form-control form-control-custom" placeholder="Masukkan nama lengkap kurir" required>
					</div>
					<div class="form-group">
						<label class="small font-weight-bold">No. Telepon <span class="text-danger">*</span></label>
						<input type="text" name="no_telepon" class="form-control form-control-custom" placeholder="Contoh: 081234567890" required>
					</div>
					<div class="form-group">
						<label class="small font-weight-bold">Email <span class="text-muted">(opsional)</span></label>
						<input type="email" name="email" class="form-control form-control-custom" placeholder="Contoh: kurir@poktan.com">
					</div>
					<div class="form-group">
						<label class="small font-weight-bold">Lokasi Terakhir <span class="text-muted">(opsional)</span></label>
						<input type="text" name="lokasi_terakhir" class="form-control form-control-custom" placeholder="Contoh: Terminal Buah Batu">
					</div>
					<div class="form-group mb-0">
						<label class="small font-weight-bold">Status <span class="text-danger">*</span></label>
						<select name="status" class="form-control form-control-custom">
							<option value="Active">Active</option>
							<option value="Inactive" selected>Inactive</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn-outline-custom" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn-primary-custom">
						<i class="bi bi-check-circle-fill"></i> Simpan Kurir
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- MODAL KONFIRMASI HAPUS -->
<div class="modal fade" id="modalHapus" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header border-0 pb-0">
				<h5 class="modal-title">Hapus Kurir</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body text-center py-4">
				<i class="bi bi-exclamation-triangle-fill text-danger d-block mb-3" style="font-size:2.5rem;"></i>
				<p class="mb-1">Yakin ingin menghapus kurir:</p>
				<p class="font-weight-bold" style="font-size:1.1rem;" id="namaKurirHapus"></p>
				<p class="text-muted small mb-0">Kurir yang masih punya pengiriman aktif tidak dapat dihapus.</p>
			</div>
			<div class="modal-footer border-0 pt-0 justify-content-center" style="gap:8px;">
				<button type="button" class="btn-outline-custom" data-dismiss="modal">Batal</button>
				<a href="#" id="btnConfirmHapus" class="btn btn-danger" style="border-radius:10px; padding:8px 18px; font-weight:600;">Ya, Hapus</a>
			</div>
		</div>
	</div>
</div>

<script>
	function confirmDelete(id, nama) {
		document.getElementById('namaKurirHapus').textContent = nama;
		document.getElementById('btnConfirmHapus').href = '<?= base_url('admin/kurir/hapus/'); ?>' + id;
		$('#modalHapus').modal('show');
	}
</script>