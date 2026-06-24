<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title; ?> - Sistem Supply Chain Kopi</title>
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
		}

		body {
			font-family: 'Plus Jakarta Sans', sans-serif;
			background-color: var(--bg-cream);
			color: var(--dark-coffee);
			overflow-x: hidden;
		}

		#wrapper {
			display: flex;
			width: 100%;
		}

		#sidebar-wrapper {
			width: var(--sidebar-width);
			min-height: 100vh;
			background-color: var(--dark-coffee);
			color: #fff;
			padding: 24px;
			position: fixed;
			z-index: 1000;
		}

		.brand-title {
			font-size: 1.25rem;
			font-weight: 700;
			color: var(--amber-cream);
			margin-bottom: 32px;
			display: flex;
			align-items: center;
			gap: 10px;
		}

		.sidebar-nav {
			list-style: none;
			padding: 0;
			margin: 0;
		}

		.menu-item {
			margin-bottom: 8px;
		}

		.menu-link {
			display: flex;
			align-items: center;
			gap: 12px;
			padding: 12px 16px;
			color: #DDD6D0;
			text-decoration: none;
			border-radius: 12px;
			font-weight: 500;
			transition: all 0.2s ease;
		}

		.menu-link:hover,
		.menu-item.active .menu-link {
			background-color: var(--roasted-brown);
			color: #fff;
			text-decoration: none;
		}

		.menu-item.active .menu-link {
			border-left: 4px solid var(--amber-cream);
		}

		#page-content-wrapper {
			width: 100%;
			padding-left: var(--sidebar-width);
			min-height: 100vh;
		}

		.main-content {
			padding: 40px;
		}

		.custom-card {
			background: var(--card-white);
			border-radius: 16px;
			border: none;
			box-shadow: var(--shadow-soft);
			margin-bottom: 30px;
			overflow: hidden;
		}

		.card-header-custom {
			padding: 20px 24px;
			border-bottom: 1px solid #F0EAE1;
			display: flex;
			justify-content: space-between;
			align-items: center;
		}

		.card-header-custom h6 {
			margin: 0;
			font-weight: 700;
			color: var(--dark-coffee);
		}

		.status-badge {
			padding: 6px 12px;
			border-radius: 8px;
			font-size: 0.78rem;
			font-weight: 600;
			display: inline-block;
		}

		.status-badge.complete {
			background: #e8f5e9;
			color: #388e3c;
		}

		.status-badge.cancelled {
			background: #fdecea;
			color: #c62828;
		}
	</style>
</head>

<body>
	<div id="wrapper">
		<div id="sidebar-wrapper">
			<div class="brand-title">
				<i class="bi bi-boxes"></i>
				<span>LiberChain</span>
			</div>
			<ul class="sidebar-nav">
				<li class="menu-item">
					<a href="<?= base_url('admin/dashboard') ?>" class="menu-link">
						<i class="bi bi-grid-1x2-fill"></i> <span>Dashboard</span>
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/user') ?>" class="menu-link">
						<i class="bi bi-people-fill"></i> <span>User</span>
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/petani') ?>" class="menu-link">
						<i class="bi bi-person-badge-fill"></i> <span>Kelola Petani</span>
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/produk') ?>" class="menu-link">
						<i class="bi bi-cup-hot-fill"></i> <span>Kelola Produk</span>
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/stok') ?>" class="menu-link">
						<i class="bi bi-archive-fill"></i> <span>Stok</span>
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/transaksi') ?>" class="menu-link">
						<i class="bi bi-cart-check-fill"></i> <span>Transaksi</span>
					</a>
				</li>
				<li class="menu-item active">
					<a href="<?= base_url('admin/kurir') ?>" class="menu-link">
						<i class="bi bi-truck"></i> <span>Kurir</span>
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/laporan') ?>" class="menu-link">
						<i class="bi bi-file-earmark-bar-graph-fill"></i> <span>Laporan</span>
					</a>
				</li>
				<li class="menu-item mt-4">
					<a href="<?= base_url('auth/logout') ?>" class="menu-link text-danger">
						<i class="bi bi-box-arrow-right"></i> <span>Keluar</span>
					</a>
				</li>
			</ul>
		</div>

		<div id="page-content-wrapper">
			<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4 py-3">
				<h5 class="m-0 font-weight-bold" style="color: var(--dark-coffee);"><?= $title; ?></h5>
				<div class="ml-auto d-flex align-items-center">
					<span class="text-muted small mr-3"><?= date('l, d F Y') ?></span>
					<i class="bi bi-person-circle mr-2" style="font-size: 1.25rem;"></i>
					<span class="font-weight-bold small"><?= $this->session->userdata('nama') ?></span>
				</div>
			</nav>

			<div class="main-content">
				<?php if ($this->session->flashdata('success')): ?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<i class="bi bi-check-circle mr-2"></i><?= $this->session->flashdata('success') ?>
						<button type="button" class="close" data-dismiss="alert">&times;</button>
					</div>
				<?php endif; ?>

				<div class="row mb-4">
					<div class="col-md-4">
						<div class="custom-card p-3 text-center">
							<span class="text-muted small font-weight-bold">TOTAL KURIR</span>
							<h3 class="font-weight-bold mt-1"><?= $this->Kurir_model->count_by_status(); ?></h3>
						</div>
					</div>
					<div class="col-md-4">
						<div class="custom-card p-3 text-center" style="border-bottom: 4px solid #388e3c;">
							<span class="text-muted small font-weight-bold text-success">TERSEDIA</span>
							<h3 class="font-weight-bold mt-1 text-success"><?= $this->Kurir_model->count_by_status('Active'); ?></h3>
						</div>
					</div>
					<div class="col-md-4">
						<div class="custom-card p-3 text-center" style="border-bottom: 4px solid #c62828;">
							<span class="text-muted small font-weight-bold text-danger">NONAKTIF</span>
							<h3 class="font-weight-bold mt-1 text-danger"><?= $this->Kurir_model->count_by_status('Offline'); ?></h3>
						</div>
					</div>
				</div>

				<div class="custom-card">
					<div class="card-header-custom">
						<h6><i class="bi bi-list-stars mr-2"></i>Daftar Kurir Kelompok Kopi</h6>
						<a href="<?= base_url('admin/kurir/tambah') ?>" class="btn btn-sm" style="background: var(--roasted-brown); color: #fff; border-radius: 8px;">
							<i class="bi bi-plus-circle mr-2"></i>Tambah Kurir
						</a>
					</div>
					<div class="card-body-custom p-0">
						<div class="table-responsive">
							<table class="table table-hover mb-0" style="vertical-align: middle;">
								<thead class="thead-light">
									<tr>
										<th class="pl-4">Nama Kurir</th>
										<th>No. Telepon</th>
										<th>Kendaraan</th>
										<th>Plat Nomor</th>
										<th>Status</th>
										<th class="text-center pr-4">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php if (empty($kurir)): ?>
										<tr>
											<td colspan="6" class="text-center py-4 text-muted">Belum ada data kurir.</td>
										</tr>
									<?php else: ?>
										<?php foreach ($kurir as $k): ?>
											<tr>
												<td class="pl-4 font-weight-bold"><?= htmlspecialchars($k->nama_kurir) ?></td>
												<td><?= htmlspecialchars($k->no_telepon) ?></td>
												<td><?= htmlspecialchars($k->jenis_kendaraan) ?></td>
												<td><span class="badge badge-secondary p-2"><?= htmlspecialchars($k->plat_nomor) ?></span></td>
												<td>
													<span class="status-badge <?= ($k->status_kurir === 'Tersedia') ? 'complete' : 'cancelled' ?>">
														<?= $k->status_kurir ?>
													</span>
												</td>
												<td class="text-center pr-4">
													<a href="<?= base_url('admin/kurir/edit/' . $k->id_kurir) ?>" class="btn btn-sm btn-link text-warning mr-1">
														<i class="bi bi-pencil-fill"></i>
													</a>
													<a href="<?= base_url('admin/kurir/hapus/' . $k->id_kurir) ?>" class="btn btn-sm btn-link text-danger" onclick="return confirm('Hapus data kurir ini?')">
														<i class="bi bi-trash-fill"></i>
													</a>
												</td>
											</tr>
										<?php endforeach; ?>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>