<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Assign Kurir - Sistem Supply Chain Kopi</title>
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

		.main-content {
			margin-left: var(--sidebar-width);
			padding: 30px 40px 40px;
			min-height: 100vh;
			transition: var(--transition-smooth);
		}

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
			gap: 10px;
		}

		.custom-card .card-header-custom h6 {
			font-weight: 700;
			color: var(--dark-coffee);
			margin: 0;
			font-size: 0.9rem;
		}

		.badge-count {
			background: var(--bg-cream);
			color: var(--roasted-brown);
			font-size: 0.7rem;
			font-weight: 700;
			padding: 2px 12px;
			border-radius: 12px;
		}

		.card-body-custom {
			padding: 0;
		}

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

		.status-badge {
			padding: 4px 12px;
			border-radius: 20px;
			font-size: 0.7rem;
			font-weight: 600;
			text-transform: capitalize;
		}

		.status-badge.badge-pending {
			background: #FEF3C7;
			color: #92400E;
		}

		.status-badge.badge-diproses {
			background: #DBEAFE;
			color: #1E40AF;
		}

		.status-badge.badge-success {
			background: #D1FAE5;
			color: #065F46;
		}

		.form-select-custom {
			padding: 7px 10px;
			border: 1.5px solid rgba(74, 44, 17, 0.1);
			border-radius: 8px;
			font-size: 0.8rem;
			color: var(--dark-coffee);
			background: var(--bg-cream);
			outline: none;
			min-width: 150px;
		}

		.form-select-custom:focus {
			border-color: var(--amber-cream);
			box-shadow: 0 0 0 3px rgba(230, 161, 92, 0.15);
		}

		.btn-primary-custom {
			background: var(--roasted-brown);
			color: #fff;
			border: none;
			border-radius: 8px;
			padding: 7px 14px;
			font-size: 0.8rem;
			font-weight: 600;
			transition: var(--transition-smooth);
			display: inline-flex;
			align-items: center;
		}

		.btn-primary-custom:hover {
			background: var(--amber-cream);
			color: #fff;
		}

		.kurir-chip {
			background: var(--bg-cream);
			color: var(--roasted-brown);
			padding: 7px 16px;
			border-radius: 20px;
			font-size: 0.82rem;
			font-weight: 500;
			display: inline-flex;
			align-items: center;
		}

		.btn-assigned {
			background: #D1FAE5;
			color: #065F46;
			padding: 7px 14px;
			border-radius: 8px;
			font-size: 0.8rem;
			font-weight: 600;
			display: inline-flex;
			align-items: center;
			gap: 6px;
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
				<div class="breadcrumb-custom d-none d-md-block">
					<a href="<?= base_url('admin/kurir'); ?>">Manajemen Kurir</a> / Assign Kurir
				</div>
				<h2 class="d-inline-block align-middle mb-0">Assign Kurir</h2>
				<p class="subtitle mb-0 mt-1">Tugaskan kurir untuk pengiriman yang belum memiliki kurir</p>
			</div>
			<a href="<?= base_url('admin/kurir'); ?>" class="btn btn-light" style="border-radius:10px; border:1px solid rgba(74,44,17,0.08); font-size:0.85rem;">
				<i class="bi bi-arrow-left mr-1"></i> Kembali
			</a>
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

		<?php if (empty($kurir_aktif)): ?>
			<div class="alert alert-warning" style="border-radius:12px; border:none; background:#FEF3C7; color:#92400E; font-size:0.85rem;">
				<i class="bi bi-exclamation-triangle-fill mr-2"></i>
				Tidak ada kurir dengan status <strong>Active</strong> saat ini. Aktifkan kurir terlebih dahulu di
				<a href="<?= base_url('admin/kurir'); ?>" style="color:#92400E; text-decoration:underline;">Manajemen Kurir</a>.
			</div>
		<?php endif; ?>

		<!-- TABEL PENGIRIMAN BELUM ADA KURIR -->
		<div class="custom-card mb-4">
			<div class="card-header-custom">
				<i class="bi bi-truck"></i>
				<h6>Pengiriman Menunggu Kurir</h6>
				<span class="badge-count"><?= count($pengiriman_pending); ?></span>
			</div>
			<div class="card-body-custom">
				<?php if (empty($pengiriman_pending)): ?>
					<div class="text-center text-muted py-5">
						<i class="bi bi-check2-circle d-block mb-2" style="font-size:2.5rem;"></i>
						<p class="mb-0">Semua pengiriman sudah memiliki kurir. Tidak ada yang perlu ditugaskan.</p>
					</div>
				<?php else: ?>
					<div class="table-responsive">
						<table class="table table-custom">
							<thead>
								<tr>
									<th width="40">#</th>
									<th>Invoice</th>
									<th>Pembeli</th>
									<th>Total Harga</th>
									<th>Status Pesanan</th>
									<th>Tanggal Dibuat</th>
									<th width="220" class="text-center">Tugaskan Kurir</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; foreach ($pengiriman_pending as $row): ?>
									<tr>
										<td class="text-muted"><?= $no++; ?></td>
										<td class="link-name"><?= htmlspecialchars($row['invoice'] ?? '-'); ?></td>
										<td><?= htmlspecialchars($row['nama_pembeli'] ?? '-'); ?></td>
										<td>Rp <?= number_format($row['grand_total'] ?? $row['total_harga'] ?? 0, 0, ',', '.'); ?></td>
										<td>
											<span class="status-badge <?= ($row['status_pesanan'] == 'Diproses') ? 'badge-diproses' : 'badge-pending'; ?>">
												<?= $row['status_pesanan'] ?? 'Pending'; ?>
											</span>
										</td>
										<td class="text-muted small"><?= date('d M Y, H:i', strtotime($row['tanggal_transaksi'] ?? date('Y-m-d H:i:s'))); ?></td>
										<td>
											<?php if (!empty($row['id_kurir']) && $row['id_kurir'] > 0): ?>
												<!-- 🔥 SUDAH ADA KURIR -->
												<span class="btn-assigned">
													<i class="bi bi-check-circle-fill"></i> Sudah Ditugaskan
												</span>
											<?php else: ?>
												<!-- 🔥 BELUM ADA KURIR -->
												<form action="<?= base_url('admin/kurir/proses_assign'); ?>" method="post" class="d-flex" style="gap:6px;">
													<input type="hidden" name="id_transaksi" value="<?= $row['id_transaksi']; ?>">
													<select name="id_kurir" class="form-select-custom" required <?= empty($kurir_aktif) ? 'disabled' : ''; ?>>
														<option value="">Pilih Kurir</option>
														<?php foreach ($kurir_aktif as $k): ?>
															<option value="<?= $k['id_kurir']; ?>"><?= htmlspecialchars($k['nama_kurir']); ?></option>
														<?php endforeach; ?>
													</select>
													<button type="submit" class="btn-primary-custom" <?= empty($kurir_aktif) ? 'disabled' : ''; ?>>
														<i class="bi bi-send-check-fill"></i>
													</button>
												</form>
											<?php endif; ?>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<!-- DAFTAR KURIR ACTIVE SEBAGAI REFERENSI -->
		<div class="custom-card">
			<div class="card-header-custom">
				<i class="bi bi-person-check-fill"></i>
				<h6>Kurir Tersedia (Active)</h6>
			</div>
			<div class="card-body-custom" style="padding: 18px 22px;">
				<?php if (empty($kurir_aktif)): ?>
					<p class="text-muted small mb-0">Belum ada kurir berstatus Active.</p>
				<?php else: ?>
					<div class="d-flex flex-wrap" style="gap:8px;">
						<?php foreach ($kurir_aktif as $k): ?>
							<div class="kurir-chip">
								<i class="bi bi-person-circle mr-1"></i>
								<?= htmlspecialchars($k['nama_kurir']); ?>
								<span class="text-muted small ml-1">(<?= htmlspecialchars($k['no_telepon']); ?>)</span>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	<script>
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
	</script>
</body>

</html>