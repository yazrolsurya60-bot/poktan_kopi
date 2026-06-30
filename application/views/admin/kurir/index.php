<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Manajemen Kurir - Sistem Supply Chain Kopi</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<style>
		:root {
			--roasted-brown: #4A2C11;
			--dark-coffee: #2C1808;
			--amber-cream: #E6A15C;
			--bg-cream: #FAF6F0;
			--card-white: #FFFFFF;
			--text-secondary: #70655E;
			--sidebar-width: 260px;
			--shadow-soft: 0 8px 30px rgba(44, 24, 8, 0.08);
			--shadow-hover: 0 12px 40px rgba(44, 24, 8, 0.15);
			--radius-card: 14px;
			--transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
		}

		body {
			font-family: 'Plus Jakarta Sans', sans-serif;
			background-color: var(--bg-cream);
			color: var(--dark-coffee);
			overflow-x: hidden;
		}

		/* --- SIDEBAR --- */
		.sidebar {
			width: var(--sidebar-width);
			height: 100vh;
			position: fixed;
			top: 0;
			left: 0;
			background: linear-gradient(180deg, var(--dark-coffee) 0%, #1a0e04 100%);
			color: var(--bg-cream);
			z-index: 100;
			transition: var(--transition-smooth);
			box-shadow: 4px 0 25px rgba(44, 24, 8, 0.2);
			display: flex;
			flex-direction: column;
		}

		.sidebar-brand {
			padding: 28px 24px 20px;
			font-size: 1.1rem;
			font-weight: 700;
			letter-spacing: 0.5px;
			border-bottom: 1px solid rgba(250, 246, 240, 0.08);
			color: var(--amber-cream);
			display: flex;
			align-items: center;
			gap: 10px;
		}

		.sidebar-brand .brand-icon {
			width: 40px;
			height: 40px;
			background: rgba(230, 161, 92, 0.15);
			border-radius: 10px;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 1.3rem;
		}

		.sidebar-menu-wrapper {
			flex: 1;
			overflow-y: auto;
			padding: 15px 0;
		}

		.sidebar-menu {
			list-style: none;
			margin: 0;
			padding: 0;
		}

		.menu-item a {
			display: flex;
			align-items: center;
			padding: 12px 24px;
			color: #A8988A;
			font-weight: 500;
			font-size: 0.9rem;
			transition: var(--transition-smooth);
			text-decoration: none;
			position: relative;
			margin: 2px 10px;
			border-radius: 10px;
		}

		.menu-item a i {
			font-size: 1.15rem;
			margin-right: 14px;
			width: 22px;
			text-align: center;
		}

		.menu-item a .menu-badge {
			margin-left: auto;
			background: rgba(230, 161, 92, 0.2);
			color: var(--amber-cream);
			font-size: 0.7rem;
			padding: 2px 10px;
			border-radius: 20px;
			font-weight: 600;
		}

		.menu-item.active a,
		.menu-item a:hover {
			color: #ffffff;
			background: rgba(230, 161, 92, 0.12);
		}

		.menu-item.active a {
			background: rgba(230, 161, 92, 0.18);
			border-left: 3px solid var(--amber-cream);
		}

		.sidebar-footer {
			padding: 16px 20px;
			border-top: 1px solid rgba(250, 246, 240, 0.06);
			margin-top: auto;
		}

		.sidebar-footer .btn-logout {
			width: 100%;
			padding: 10px 16px;
			border: 1px solid rgba(250, 246, 240, 0.1);
			border-radius: 10px;
			background: transparent;
			color: #A8988A;
			font-weight: 500;
			font-size: 0.85rem;
			transition: var(--transition-smooth);
			display: flex;
			align-items: center;
			justify-content: center;
			gap: 10px;
			cursor: pointer;
		}

		.sidebar-footer .btn-logout:hover {
			background: rgba(230, 161, 92, 0.1);
			color: #ffffff;
			border-color: rgba(230, 161, 92, 0.2);
		}

		/* --- MAIN CONTENT --- */
		.main-content {
			margin-left: var(--sidebar-width);
			padding: 30px 40px 40px;
			min-height: 100vh;
			transition: var(--transition-smooth);
		}

		/* --- PAGE HEADER --- */
		.page-header {
			border-bottom: 1px solid rgba(74, 44, 17, 0.08);
			padding-bottom: 20px;
			margin-bottom: 30px;
		}

		.page-header h2 {
			font-weight: 700;
			color: var(--dark-coffee);
			letter-spacing: -0.02em;
		}

		.page-header .subtitle {
			color: var(--text-secondary);
			font-size: 0.9rem;
			margin-top: 2px;
		}

		.breadcrumb-custom {
			font-size: 0.78rem;
			color: var(--text-secondary);
			margin-bottom: 4px;
		}

		.breadcrumb-custom a {
			color: var(--amber-cream);
			text-decoration: none;
		}

		/* --- SUMMARY / STAT BOX --- */
		.stat-box {
			background: var(--card-white);
			border: 1px solid rgba(74, 44, 17, 0.06);
			border-radius: var(--radius-card);
			padding: 20px 22px;
			position: relative;
			box-shadow: var(--shadow-soft);
			transition: var(--transition-smooth);
			overflow: hidden;
			display: flex;
			align-items: center;
			gap: 16px;
		}

		.stat-box:hover {
			transform: translateY(-3px);
			box-shadow: var(--shadow-hover);
		}

		.stat-icon-box {
			width: 48px;
			height: 48px;
			min-width: 48px;
			border-radius: 12px;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 1.3rem;
		}

		.bg-success-soft { background: #D1FAE5; color: #065F46; }
		.bg-warning-soft { background: #FEF3C7; color: #92400E; }
		.bg-danger-soft  { background: #FEE2E2; color: #991B1B; }

		.stat-title {
			font-size: 0.7rem;
			font-weight: 700;
			text-transform: uppercase;
			color: var(--text-secondary);
			letter-spacing: 0.5px;
			margin: 0;
		}

		.stat-num {
			font-size: 1.5rem;
			font-weight: 700;
			margin: 2px 0 0;
			color: var(--dark-coffee);
		}

		/* --- CUSTOM CARD --- */
		.custom-card {
			background: var(--card-white);
			border: 1px solid rgba(74, 44, 17, 0.06);
			border-radius: var(--radius-card);
			box-shadow: var(--shadow-soft);
			overflow: hidden;
		}

		.custom-card .card-header-custom {
			padding: 18px 24px;
			border-bottom: 1px solid rgba(74, 44, 17, 0.06);
			display: flex;
			align-items: center;
			justify-content: space-between;
			flex-wrap: wrap;
			gap: 10px;
		}

		.custom-card .card-header-custom h6 {
			font-weight: 700;
			color: var(--dark-coffee);
			margin: 0;
			font-size: 0.9rem;
		}

		.custom-card .card-body-custom {
			padding: 0;
		}

		/* --- FORM CONTROL --- */
		.form-control-custom {
			padding: 8px 14px;
			border: 1.5px solid rgba(74, 44, 17, 0.1);
			border-radius: 10px;
			font-size: 0.85rem;
			color: var(--dark-coffee);
			background: var(--bg-cream);
			outline: none;
			transition: var(--transition-smooth);
		}

		.form-control-custom:focus {
			border-color: var(--amber-cream);
			box-shadow: 0 0 0 3px rgba(230, 161, 92, 0.15);
		}

		/* --- TABEL --- */
		.table-custom {
			font-size: 0.85rem;
			margin-bottom: 0;
		}

		.table-custom thead th {
			background: var(--bg-cream);
			border-bottom: 2px solid rgba(74, 44, 17, 0.06);
			color: var(--text-secondary);
			font-weight: 700;
			font-size: 0.7rem;
			text-transform: uppercase;
			letter-spacing: 0.5px;
			padding: 12px 16px;
			border-top: none;
		}

		.table-custom tbody td {
			padding: 12px 16px;
			border-bottom: 1px solid rgba(74, 44, 17, 0.04);
			vertical-align: middle;
		}

		.table-custom tbody tr:hover {
			background: rgba(250, 246, 240, 0.5);
		}

		.link-name {
			color: var(--roasted-brown);
			font-weight: 600;
		}

		/* --- STATUS BADGE --- */
		.status-badge {
			padding: 4px 12px;
			border-radius: 20px;
			font-size: 0.7rem;
			font-weight: 600;
		}

		.status-badge.badge-active   { background: #D1FAE5; color: #065F46; }
		.status-badge.badge-inactive { background: #FEF3C7; color: #92400E; }
		.status-badge.badge-offline  { background: #FEE2E2; color: #991B1B; }

		/* --- ACTION BUTTONS --- */
		.btn-icon {
			width: 32px;
			height: 32px;
			border-radius: 8px;
			border: none;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			font-size: 0.85rem;
			cursor: pointer;
			transition: var(--transition-smooth);
			text-decoration: none;
		}

		.btn-detail { background: #DBEAFE; color: #1E40AF; }
		.btn-detail:hover { background: #1E40AF; color: #fff; }
		.btn-toggle { background: #EDE9FE; color: #5B21B6; }
		.btn-toggle:hover { background: #5B21B6; color: #fff; }
		.btn-edit   { background: #FEF3C7; color: #92400E; }
		.btn-edit:hover   { background: #92400E; color: #fff; }
		.btn-delete { background: #FEE2E2; color: #991B1B; }
		.btn-delete:hover { background: #991B1B; color: #fff; }

		.btn-primary-custom {
			background: var(--roasted-brown);
			color: #fff;
			border: none;
			border-radius: 10px;
			padding: 8px 18px;
			font-size: 0.85rem;
			font-weight: 600;
			transition: var(--transition-smooth);
			text-decoration: none;
			display: inline-flex;
			align-items: center;
			gap: 6px;
		}

		.btn-primary-custom:hover {
			background: var(--amber-cream);
			color: #fff;
		}

		.btn-outline-custom {
			border: 1.5px solid rgba(74, 44, 17, 0.12);
			color: var(--dark-coffee);
			background: var(--card-white);
			border-radius: 10px;
			padding: 8px 16px;
			font-size: 0.85rem;
			font-weight: 600;
			transition: var(--transition-smooth);
			text-decoration: none;
			display: inline-flex;
			align-items: center;
			gap: 6px;
		}

		.btn-outline-custom:hover {
			background: var(--bg-cream);
			border-color: var(--amber-cream);
			color: var(--dark-coffee);
		}

		/* --- SIDEBAR OVERLAY --- */
		.sidebar-overlay {
			display: none;
			position: fixed;
			inset: 0;
			background: rgba(0, 0, 0, 0.4);
			z-index: 99;
		}

		.sidebar-overlay.active {
			display: block;
		}

		/* --- RESPONSIVE --- */
		@media (max-width: 991.98px) {
			.sidebar {
				left: calc(-1 * var(--sidebar-width));
				box-shadow: none;
			}

			.sidebar.open {
				left: 0;
				box-shadow: 0 0 40px rgba(0, 0, 0, 0.3);
			}

			.main-content {
				margin-left: 0;
				padding: 20px 16px 30px;
			}

			.page-header h2 {
				font-size: 1.3rem;
			}
		}

		/* SCROLLBAR */
		.sidebar-menu-wrapper::-webkit-scrollbar {
			width: 3px;
		}

		.sidebar-menu-wrapper::-webkit-scrollbar-track {
			background: transparent;
		}

		.sidebar-menu-wrapper::-webkit-scrollbar-thumb {
			background: rgba(230, 161, 92, 0.3);
			border-radius: 10px;
		}
	</style>
</head>

<body>

	<!-- SIDEBAR OVERLAY -->
	<div class="sidebar-overlay" id="sidebarOverlay"></div>

	<!-- SIDEBAR -->
	<div class="sidebar" id="sidebarMenu">
		<div class="sidebar-brand">
			<div class="brand-icon">
				<i class="bi bi-patch-check-fill"></i>
			</div>
			<span>POKTAN <br><small style="font-weight:400; font-size:0.7rem; color:#A8988A;">Liberchain</small></span>
		</div>
		<div class="sidebar-menu-wrapper">
			<ul class="sidebar-menu">
				<li class="menu-item">
					<a href="<?= base_url('admin/dashboard'); ?>">
						<i class="bi bi-grid-1x2-fill"></i>Dashboard
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/user'); ?>">
						<i class="bi bi-people-fill"></i>Manajemen User
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/petani'); ?>">
						<i class="bi bi-person-badge-fill"></i>Data Petani
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/lahan'); ?>">
						<i class="bi bi-map-fill"></i>Manajemen Lahan
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/panen'); ?>">
						<i class="bi bi-tree-fill"></i>Manajemen Panen
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/produk'); ?>">
						<i class="bi bi-box-seam-fill"></i>Manajemen Produk
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/transaksi'); ?>">
						<i class="bi bi-wallet2"></i>Transaksi
					</a>
				</li>
				<li class="menu-item active">
					<a href="<?= base_url('admin/kurir'); ?>">
						<i class="bi bi-truck"></i>Manajemen Kurir
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/mitra'); ?>">
						<i class="bi bi-shop"></i>Manajemen Mitra
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/laporan'); ?>">
						<i class="bi bi-file-earmark-bar-graph-fill"></i>Laporan & Analytics
					</a>
				</li>
			</ul>
		</div>
		<div class="sidebar-footer">
			<button class="btn-logout" onclick="window.location.href='<?= base_url('auth/logout'); ?>'">
				<i class="bi bi-box-arrow-right"></i> Keluar
			</button>
		</div>
	</div>

	<!-- MAIN CONTENT -->
	<div class="main-content">

		<!-- PAGE HEADER -->
		<div class="page-header d-flex justify-content-between align-items-center flex-wrap">
			<div>
				<button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle" style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
					<i class="bi bi-list"></i>
				</button>
				<h2 class="d-inline-block align-middle mb-0">Manajemen Kurir</h2>
				<p class="subtitle mb-0 mt-1">Kelola data kurir pengiriman Poktan Liberchain</p>
			</div>
			<div class="d-flex align-items-center" style="gap: 12px;">
				<div class="d-flex align-items-center gap-2" style="cursor: pointer; padding: 6px 12px; border-radius: 10px; background: var(--card-white); border: 1px solid rgba(74,44,17,0.06);">
					<i class="bi bi-person-circle" style="font-size: 1.5rem; color: var(--amber-cream);"></i>
					<span style="font-weight:500; font-size:0.85rem;"><?= $this->session->userdata('nama') ?? 'Admin'; ?></span>
				</div>
			</div>
		</div>

		<!-- FLASH MESSAGE -->
		<?php if ($this->session->flashdata('success')): ?>
			<div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius:12px; border:none; background:#D1FAE5; color:#065F46; font-size:0.85rem;">
				<i class="bi bi-check-circle-fill mr-2"></i><?= $this->session->flashdata('success'); ?>
				<button type="button" class="close" data-dismiss="alert" style="font-size:1rem;">&times;</button>
			</div>
		<?php endif; ?>

		<?php if ($this->session->flashdata('error')): ?>
			<div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius:12px; border:none; background:#FEE2E2; color:#991B1B; font-size:0.85rem;">
				<i class="bi bi-exclamation-circle-fill mr-2"></i><?= $this->session->flashdata('error'); ?>
				<button type="button" class="close" data-dismiss="alert" style="font-size:1rem;">&times;</button>
			</div>
		<?php endif; ?>

		<!-- SUMMARY CARDS -->
		<div class="row mb-4">
			<div class="col-md-6 mb-3">
				<div class="stat-box">
					<div class="stat-icon-box bg-success-soft"><i class="bi bi-person-check-fill"></i></div>
					<div>
						<p class="stat-title">Active</p>
						<h3 class="stat-num"><?= $kurir_active ?? 0; ?></h3>
					</div>
				</div>
			</div>
			<div class="col-md-6 mb-3">
				<div class="stat-box">
					<div class="stat-icon-box bg-warning-soft"><i class="bi bi-pause-circle-fill"></i></div>
					<div>
						<p class="stat-title">Inactive</p>
						<h3 class="stat-num"><?= $kurir_inactive ?? 0; ?></h3>
					</div>
				</div>
			</div>
		</div>

		<!-- TABEL KURIR -->
		<div class="custom-card">
			<div class="card-header-custom">
				<h6><i class="bi bi-people-fill mr-2"></i>Daftar Kurir</h6>
				<div class="d-flex flex-wrap" style="gap: 8px;">
					<form method="get" action="<?= base_url('admin/kurir'); ?>" class="d-flex">
						<input type="text" name="keyword" class="form-control-custom" placeholder="Cari nama / telepon..." value="<?= htmlspecialchars($keyword ?? ''); ?>" style="min-width:180px;">
					</form>
					<a href="<?= base_url('admin/kurir/assign'); ?>" class="btn-outline-custom">
						<i class="bi bi-truck"></i> Assign Kurir
					</a>
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
					<div class="text-center text-muted py-5">
						<i class="bi bi-inbox d-block mb-2" style="font-size:2.5rem;"></i>
						<p class="mb-0">Belum ada data kurir.</p>
					</div>
				<?php else: ?>
					<div class="table-responsive">
						<table class="table table-custom">
							<thead>
								<tr>
									<th width="40">#</th>
									<th>Nama Kurir</th>
									<th>No. Telepon</th>
									<th>Email</th>
									<th>Lokasi Terakhir</th>
									<th>Status</th>
									<th>Terdaftar</th>
									<th width="140" class="text-center">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; foreach ($list_kurir as $row): ?>
									<tr>
										<td class="text-muted"><?= $no++; ?></td>
										<td class="link-name"><?= htmlspecialchars($row['nama_kurir']); ?></td>
										<td><?= htmlspecialchars($row['no_telepon']); ?></td>
										<td class="text-muted small"><?= $row['email'] ? htmlspecialchars($row['email']) : '-'; ?></td>
										<td class="text-muted small"><?= $row['lokasi_terakhir'] ? htmlspecialchars($row['lokasi_terakhir']) : '-'; ?></td>
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

									<!-- MODAL EDIT (per baris) -->
									<div class="modal fade" id="modalEdit<?= $row['id_kurir']; ?>" tabindex="-1">
										<div class="modal-dialog modal-dialog-centered">
											<div class="modal-content" style="border-radius:16px; border:none;">
												<form action="<?= base_url('admin/kurir/edit/' . $row['id_kurir']); ?>" method="post">
													<div class="modal-header" style="border-bottom:1px solid rgba(74,44,17,0.06);">
														<h5 class="modal-title font-weight-bold" style="font-size:1rem; color:var(--dark-coffee);">
															<i class="bi bi-pencil-square mr-2"></i>Edit Kurir
														</h5>
														<button type="button" class="close" data-dismiss="modal">&times;</button>
													</div>
													<div class="modal-body" style="padding:20px 24px;">
														<div class="form-group">
															<label class="small font-weight-bold" style="color:var(--dark-coffee);">Nama Kurir</label>
															<input type="text" name="nama_kurir" class="form-control form-control-custom" value="<?= htmlspecialchars($row['nama_kurir']); ?>" required>
														</div>
														<div class="form-group">
															<label class="small font-weight-bold" style="color:var(--dark-coffee);">No. Telepon</label>
															<input type="text" name="no_telepon" class="form-control form-control-custom" value="<?= htmlspecialchars($row['no_telepon']); ?>" required>
														</div>
														<div class="form-group">
															<label class="small font-weight-bold" style="color:var(--dark-coffee);">Email</label>
															<input type="email" name="email" class="form-control form-control-custom" value="<?= htmlspecialchars($row['email'] ?? ''); ?>">
														</div>
														<div class="form-group">
															<label class="small font-weight-bold" style="color:var(--dark-coffee);">Lokasi Terakhir</label>
															<input type="text" name="lokasi_terakhir" class="form-control form-control-custom" value="<?= htmlspecialchars($row['lokasi_terakhir'] ?? ''); ?>">
														</div>
														<div class="form-group mb-0">
															<label class="small font-weight-bold" style="color:var(--dark-coffee);">Status</label>
															<select name="status" class="form-control form-control-custom">
																<option value="Active" <?= $row['status'] == 'Active' ? 'selected' : ''; ?>>Active</option>
																<option value="Inactive" <?= $row['status'] == 'Inactive' ? 'selected' : ''; ?>>Inactive</option>
															</select>
														</div>
													</div>
													<div class="modal-footer" style="border-top:1px solid rgba(74,44,17,0.06);">
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
	</div>

	<!-- MODAL TAMBAH KURIR -->
	<div class="modal fade" id="modalTambah" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content" style="border-radius:16px; border:none;">
				<form action="<?= base_url('admin/kurir/tambah'); ?>" method="post">
					<div class="modal-header" style="border-bottom:1px solid rgba(74,44,17,0.06);">
						<h5 class="modal-title font-weight-bold" style="font-size:1rem; color:var(--dark-coffee);">
							<i class="bi bi-person-plus-fill mr-2"></i>Tambah Kurir Baru
						</h5>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body" style="padding:20px 24px;">
						<div class="form-group">
							<label class="small font-weight-bold" style="color:var(--dark-coffee);">Nama Kurir <span class="text-danger">*</span></label>
							<input type="text" name="nama_kurir" class="form-control form-control-custom" placeholder="Masukkan nama lengkap kurir" required>
						</div>
						<div class="form-group">
							<label class="small font-weight-bold" style="color:var(--dark-coffee);">No. Telepon <span class="text-danger">*</span></label>
							<input type="text" name="no_telepon" class="form-control form-control-custom" placeholder="Contoh: 081234567890" required>
						</div>
						<div class="form-group">
							<label class="small font-weight-bold" style="color:var(--dark-coffee);">Email <span class="text-muted">(opsional)</span></label>
							<input type="email" name="email" class="form-control form-control-custom" placeholder="Contoh: kurir@poktan.com">
						</div>
						<div class="form-group">
							<label class="small font-weight-bold" style="color:var(--dark-coffee);">Lokasi Terakhir <span class="text-muted">(opsional)</span></label>
							<input type="text" name="lokasi_terakhir" class="form-control form-control-custom" placeholder="Contoh: Terminal Buah Batu">
						</div>
						<div class="form-group mb-0">
							<label class="small font-weight-bold" style="color:var(--dark-coffee);">Status <span class="text-danger">*</span></label>
							<select name="status" class="form-control form-control-custom">
								<option value="Active">Active</option>
								<option value="Inactive" selected>Inactive</option>
							</select>
						</div>
					</div>
					<div class="modal-footer" style="border-top:1px solid rgba(74,44,17,0.06);">
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
			<div class="modal-content" style="border-radius:16px; border:none;">
				<div class="modal-header border-0 pb-0">
					<h5 class="modal-title font-weight-bold" style="font-size:1rem;">Hapus Kurir</h5>
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
					<a href="#" id="btnConfirmHapus" class="btn btn-danger" style="border-radius:10px;">Ya, Hapus</a>
				</div>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	<script>
		// SIDEBAR TOGGLE
		const sidebar = document.getElementById('sidebarMenu');
		const overlay = document.getElementById('sidebarOverlay');
		const toggleBtn = document.getElementById('sidebarToggle');

		function toggleSidebar() {
			sidebar.classList.toggle('open');
			overlay.classList.toggle('active');
			document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
		}

		if (toggleBtn) {
			toggleBtn.addEventListener('click', toggleSidebar);
		}
		if (overlay) {
			overlay.addEventListener('click', toggleSidebar);
		}

		document.addEventListener('click', function(e) {
			if (window.innerWidth > 991.98) return;
			if (!sidebar.contains(e.target) && toggleBtn && !toggleBtn.contains(e.target)) {
				if (sidebar.classList.contains('open')) {
					toggleSidebar();
				}
			}
		});

		// KONFIRMASI HAPUS
		function confirmDelete(id, nama) {
			document.getElementById('namaKurirHapus').textContent = nama;
			document.getElementById('btnConfirmHapus').href = '<?= base_url('admin/kurir/hapus/'); ?>' + id;
			$('#modalHapus').modal('show');
		}
	</script>
</body>

</html>
