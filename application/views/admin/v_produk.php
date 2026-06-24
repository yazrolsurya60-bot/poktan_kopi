<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Manajemen Produk - Sistem Supply Chain Kopi</title>
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

		/* --- SIDEBAR PREMIUM (PERSIS DASHBOARD) --- */
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

		.menu-item.active a::before {
			content: '';
			position: absolute;
			left: 0;
			top: 50%;
			transform: translateY(-50%);
			width: 3px;
			height: 24px;
			background: var(--amber-cream);
			border-radius: 0 3px 3px 0;
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

		/* --- MAIN CONTENT & CONTAINERS --- */
		.main-content {
			margin-left: var(--sidebar-width);
			padding: 30px 40px 40px;
			min-height: 100vh;
			transition: var(--transition-smooth);
		}

		.card-custom {
			background: var(--card-white);
			border: 1px solid rgba(74, 44, 17, 0.06);
			border-radius: var(--radius-card);
			box-shadow: var(--shadow-soft);
			padding: 30px;
			margin-bottom: 30px;
			transition: var(--transition-smooth);
		}

		.card-custom:hover {
			box-shadow: var(--shadow-hover);
		}

		.btn-add {
			background: var(--amber-cream);
			color: white;
			border: none;
			padding: 12px 24px;
			border-radius: 10px;
			font-weight: 600;
			transition: var(--transition-smooth);
			text-decoration: none;
			display: inline-flex;
			align-items: center;
			gap: 8px;
		}

		.btn-add:hover {
			background: #d48f49;
			color: white;
			transform: translateY(-2px);
			text-decoration: none;
		}

		/* --- TABLE STYLING --- */
		.table-custom {
			width: 100%;
			border-collapse: separate;
			border-spacing: 0 12px;
			font-size: 0.85rem;
		}

		.table-custom thead th {
			border: none;
			color: var(--text-secondary);
			font-weight: 600;
			font-size: 0.7rem;
			text-transform: uppercase;
			letter-spacing: 0.5px;
			padding: 10px 15px;
		}

		.table-custom tbody tr {
			background-color: #fff;
			box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
			transition: var(--transition-smooth);
		}

		.table-custom tbody tr:hover {
			transform: scale(1.005);
			box-shadow: 0 4px 12px rgba(74, 44, 17, 0.05);
			background: rgba(250, 246, 240, 0.3);
		}

		.table-custom tbody td {
			padding: 15px;
			border: none;
			vertical-align: middle;
		}

		.table-custom tbody tr td:first-child {
			border-top-left-radius: 10px;
			border-bottom-left-radius: 10px;
		}

		.table-custom tbody tr td:last-child {
			border-top-right-radius: 10px;
			border-bottom-right-radius: 10px;
		}

		.status-badge {
			padding: 6px 14px;
			border-radius: 20px;
			font-size: 0.7rem;
			font-weight: 600;
		}

		.status-badge.complete {
			background: #D1FAE5;
			color: #065F46;
		}

		/* --- RESPONSIVE OVERRIDES --- */
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
		}

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

		.sidebar-menu-wrapper::-webkit-scrollbar {
			width: 3px;
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

	<!-- SIDEBAR (PERSIS DENGAN v_dashboard.php) -->
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
						<span class="menu-badge">12</span>
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
				<li class="menu-item active">
					<a href="<?= base_url('admin/produk'); ?>">
						<i class="bi bi-box-seam-fill"></i>Manajemen Produk
					</a>
				</li>
				<li class="menu-item">
					<a href="<?= base_url('admin/transaksi'); ?>">
						<i class="bi bi-wallet2"></i>Transaksi
						<span class="menu-badge">8</span>
					</a>
				</li>
				<li class="menu-item">
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

	<!-- MAIN CONTENT CONTAINER -->
	<div class="main-content">
		
		<!-- HEADER HALAMAN DENGAN HAMBURGER MENU RESPONSIF -->
		<div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
			<div>
				<button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle" style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
					<i class="bi bi-list"></i>
				</button>
				<h2 class="d-inline-block align-middle mb-0" style="font-weight: 700; font-size: 28px; color: var(--dark-coffee);">
					Manajemen Produk
				</h2>
				<p style="color: var(--text-secondary); margin: 5px 0 0 0; font-size: 0.9rem;">Kelola data produk komoditas kopi Anda di sini</p>
			</div>
			<a href="<?= base_url('admin/produk/tambah'); ?>" class="btn-add mt-2 mt-sm-0">
				<i class="bi bi-plus-lg"></i> Tambah Produk
			</a>
		</div>

		<!-- KONTEN UTAMA DATA TABEL -->
		<div class="card-custom">

			<!-- FILTER PRODUK -->
			<form method="get" action="<?= base_url('admin/produk'); ?>" class="mb-4">
				<div class="row">
					<div class="col-md-5 mb-2 mb-md-0">
						<input type="text" name="keyword" class="form-control" style="border-radius: 8px;"
							placeholder="Cari nama produk, jenis kopi, atau grade..."
							value="<?= $this->input->get('keyword'); ?>">
					</div>
					<div class="col-md-2 col-6">
						<button type="submit" class="btn btn-primary btn-block" style="border-radius: 8px; background: var(--roasted-brown); border: none;">
							<i class="bi bi-search"></i> Cari
						</button>
					</div>
					<div class="col-md-2 col-6">
						<a href="<?= base_url('admin/produk'); ?>" class="btn btn-secondary btn-block" style="border-radius: 8px;">
							Reset
						</a>
					</div>
				</div>
			</form>

			<!-- TABEL PRODUK -->
			<div class="table-responsive">
				<table class="table-custom">
					<thead>
						<tr>
							<th>No</th>
							<th>Foto</th>
							<th>Nama Produk</th>
							<th>Jenis Kopi</th>
							<th>Grade</th>
							<th>Harga</th>
							<th>Stok</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($produk as $row): ?>
							<tr>
								<td><?= $no++; ?></td>
								<td>
									<?php if(!empty($row->foto_utama)) : ?>
										<img src="<?= base_url('uploads/produk/'.$row->foto_utama); ?>"
											width="65" height="65" style="object-fit:cover; border-radius:10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
									<?php else : ?>
										<span class="text-muted" style="font-size: 0.75rem;">Tidak ada foto</span>
									<?php endif; ?>
								</td>
								<td class="font-weight-bold" style="font-size: 0.9rem;"><?= $row->nama_produk; ?></td>
								<td><?= $row->jenis_kopi; ?></td>
								<td><span class="badge badge-light" style="padding: 5px 10px; border-radius: 6px;"><?= $row->grade; ?></span></td>
								<td class="font-weight-bold text-dark">Rp <?= number_format($row->harga, 0, ',', '.'); ?></td>
								<td><?= $row->stok_produk; ?> <small class="text-muted">kg</small></td>
								<td><span class="status-badge complete"><?= $row->status_produk; ?></span></td>
								<td>
									<div class="btn-group" role="group">
										<a class="btn btn-sm btn-info text-white mr-1" style="border-radius: 6px;"
											href="<?= base_url('admin/produk/detail/' . $row->id_produk); ?>"><i class="bi bi-eye"></i> Detail</a>
										<a class="btn btn-sm btn-warning text-white mr-1" style="border-radius: 6px;"
											href="<?= base_url('admin/produk/edit/' . $row->id_produk); ?>"><i class="bi bi-pencil-square"></i> Edit</a>
										<a class="btn btn-sm btn-danger" style="border-radius: 6px;"
											href="<?= base_url('admin/produk/hapus/' . $row->id_produk); ?>"
											onclick="return confirm('Yakin hapus produk ini?')"><i class="bi bi-trash"></i> Hapus</a>
									</div>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	<script>
		// JS TOGGLE SIDEBAR RESPONSIF (PERSIS DASHBOARD)
		const sidebar = document.getElementById('sidebarMenu');
		const overlay = document.getElementById('sidebarOverlay');
		const toggleBtn = document.getElementById('sidebarToggle');

		function toggleSidebar() {
			sidebar.classList.toggle('open');
			overlay.classList.toggle('active');
			document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
		}

		if (toggleBtn) toggleBtn.addEventListener('click', toggleSidebar);
		if (overlay) overlay.addEventListener('click', toggleSidebar);

		document.addEventListener('click', function(e) {
			if (window.innerWidth > 991.98) return;
			if (!sidebar.contains(e.target) && toggleBtn && !toggleBtn.contains(e.target)) {
				if (sidebar.classList.contains('open')) {
					toggleSidebar();
				}
			}
		});
	</script>
</body>

</html>