<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Performance Kurir - Sistem Supply Chain Kopi</title>
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

		body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-cream); color: var(--dark-coffee); overflow-x: hidden; }

		.sidebar {
			width: var(--sidebar-width); height: 100vh; position: fixed; top: 0; left: 0;
			background: linear-gradient(180deg, var(--dark-coffee) 0%, #1a0e04 100%);
			color: var(--bg-cream); z-index: 100; transition: var(--transition-smooth);
			box-shadow: 4px 0 25px rgba(44, 24, 8, 0.2); display: flex; flex-direction: column;
		}
		.sidebar-brand { padding: 28px 24px 20px; font-size: 1.1rem; font-weight: 700; border-bottom: 1px solid rgba(250, 246, 240, 0.08); color: var(--amber-cream); display: flex; align-items: center; gap: 10px; }
		.sidebar-brand .brand-icon { width: 40px; height: 40px; background: rgba(230, 161, 92, 0.15); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; }
		.sidebar-menu-wrapper { flex: 1; overflow-y: auto; padding: 15px 0; }
		.sidebar-menu { list-style: none; margin: 0; padding: 0; }
		.menu-item a { display: flex; align-items: center; padding: 12px 24px; color: #A8988A; font-weight: 500; font-size: 0.9rem; transition: var(--transition-smooth); text-decoration: none; margin: 2px 10px; border-radius: 10px; }
		.menu-item a i { font-size: 1.15rem; margin-right: 14px; width: 22px; text-align: center; }
		.menu-item.active a, .menu-item a:hover { color: #ffffff; background: rgba(230, 161, 92, 0.12); }
		.menu-item.active a { background: rgba(230, 161, 92, 0.18); border-left: 3px solid var(--amber-cream); }
		.sidebar-footer { padding: 16px 20px; border-top: 1px solid rgba(250, 246, 240, 0.06); margin-top: auto; }
		.sidebar-footer .btn-logout { width: 100%; padding: 10px 16px; border: 1px solid rgba(250, 246, 240, 0.1); border-radius: 10px; background: transparent; color: #A8988A; font-weight: 500; font-size: 0.85rem; transition: var(--transition-smooth); display: flex; align-items: center; justify-content: center; gap: 10px; cursor: pointer; }
		.sidebar-footer .btn-logout:hover { background: rgba(230, 161, 92, 0.1); color: #ffffff; border-color: rgba(230, 161, 92, 0.2); }

		.main-content { margin-left: var(--sidebar-width); padding: 30px 40px 40px; min-height: 100vh; transition: var(--transition-smooth); }
		.page-header { border-bottom: 1px solid rgba(74, 44, 17, 0.08); padding-bottom: 20px; margin-bottom: 30px; }
		.page-header h2 { font-weight: 700; color: var(--dark-coffee); letter-spacing: -0.02em; }
		.page-header .subtitle { color: var(--text-secondary); font-size: 0.9rem; margin-top: 2px; }
		.breadcrumb-custom { font-size: 0.78rem; color: var(--text-secondary); margin-bottom: 4px; }
		.breadcrumb-custom a { color: var(--amber-cream); text-decoration: none; }

		.custom-card { background: var(--card-white); border: 1px solid rgba(74, 44, 17, 0.06); border-radius: var(--radius-card); box-shadow: var(--shadow-soft); overflow: hidden; }
		.custom-card .card-header-custom { padding: 18px 24px; border-bottom: 1px solid rgba(74, 44, 17, 0.06); display: flex; align-items: center; gap: 10px; }
		.custom-card .card-header-custom h6 { font-weight: 700; color: var(--dark-coffee); margin: 0; font-size: 0.9rem; }
		.card-body-custom { padding: 0; }

		.table-custom { font-size: 0.85rem; margin-bottom: 0; }
		.table-custom thead th { background: var(--bg-cream); border-bottom: 2px solid rgba(74, 44, 17, 0.06); color: var(--text-secondary); font-weight: 700; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 16px; border-top: none; }
		.table-custom tbody td { padding: 12px 16px; border-bottom: 1px solid rgba(74, 44, 17, 0.04); vertical-align: middle; }
		.table-custom tbody tr:hover { background: rgba(250, 246, 240, 0.5); }
		.link-name { color: var(--roasted-brown); font-weight: 600; }

		.progress-mini { height: 6px; border-radius: 4px; background: rgba(74,44,17,0.06); overflow: hidden; min-width: 90px; }
		.progress-mini .bar { height: 100%; background: var(--amber-cream); }

		.metric-pill { display:inline-flex; align-items:center; gap:5px; font-size:0.78rem; font-weight:600; padding: 3px 10px; border-radius: 20px; }
		.metric-success { background:#D1FAE5; color:#065F46; }
		.metric-warning { background:#FEF3C7; color:#92400E; }
		.metric-danger  { background:#FEE2E2; color:#991B1B; }

		.sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.4); z-index: 99; }
		.sidebar-overlay.active { display: block; }

		@media (max-width: 991.98px) {
			.sidebar { left: calc(-1 * var(--sidebar-width)); box-shadow: none; }
			.sidebar.open { left: 0; box-shadow: 0 0 40px rgba(0, 0, 0, 0.3); }
			.main-content { margin-left: 0; padding: 20px 16px 30px; }
			.page-header h2 { font-size: 1.3rem; }
		}

		.sidebar-menu-wrapper::-webkit-scrollbar { width: 3px; }
		.sidebar-menu-wrapper::-webkit-scrollbar-track { background: transparent; }
		.sidebar-menu-wrapper::-webkit-scrollbar-thumb { background: rgba(230, 161, 92, 0.3); border-radius: 10px; }
	</style>
</head>

<body>

	<div class="sidebar-overlay" id="sidebarOverlay"></div>

	<div class="sidebar" id="sidebarMenu">
		<div class="sidebar-brand">
			<div class="brand-icon"><i class="bi bi-patch-check-fill"></i></div>
			<span>POKTAN <br><small style="font-weight:400; font-size:0.7rem; color:#A8988A;">Liberchain</small></span>
		</div>
		<div class="sidebar-menu-wrapper">
			<ul class="sidebar-menu">
				<li class="menu-item"><a href="<?= base_url('admin/dashboard'); ?>"><i class="bi bi-grid-1x2-fill"></i>Dashboard</a></li>
				<li class="menu-item"><a href="<?= base_url('admin/user'); ?>"><i class="bi bi-people-fill"></i>Manajemen User</a></li>
				<li class="menu-item"><a href="<?= base_url('admin/petani'); ?>"><i class="bi bi-person-badge-fill"></i>Data Petani</a></li>
				<li class="menu-item"><a href="<?= base_url('admin/lahan'); ?>"><i class="bi bi-map-fill"></i>Manajemen Lahan</a></li>
				<li class="menu-item"><a href="<?= base_url('admin/panen'); ?>"><i class="bi bi-tree-fill"></i>Manajemen Panen</a></li>
				<li class="menu-item"><a href="<?= base_url('admin/produk'); ?>"><i class="bi bi-box-seam-fill"></i>Manajemen Produk</a></li>
				<li class="menu-item"><a href="<?= base_url('admin/transaksi'); ?>"><i class="bi bi-wallet2"></i>Transaksi</a></li>
				<li class="menu-item active"><a href="<?= base_url('admin/kurir'); ?>"><i class="bi bi-truck"></i>Manajemen Kurir</a></li>
				<li class="menu-item"><a href="<?= base_url('admin/mitra'); ?>"><i class="bi bi-shop"></i>Manajemen Mitra</a></li>
				<li class="menu-item"><a href="<?= base_url('admin/laporan'); ?>"><i class="bi bi-file-earmark-bar-graph-fill"></i>Laporan & Analytics</a></li>
			</ul>
		</div>
		<div class="sidebar-footer">
			<button class="btn-logout" onclick="window.location.href='<?= base_url('auth/logout'); ?>'"><i class="bi bi-box-arrow-right"></i> Keluar</button>
		</div>
	</div>

	<div class="main-content">

		<div class="page-header d-flex justify-content-between align-items-center flex-wrap">
			<div>
				<button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle" style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
					<i class="bi bi-list"></i>
				</button>
				<div class="breadcrumb-custom d-none d-md-block">
					<a href="<?= base_url('admin/kurir'); ?>">Manajemen Kurir</a> / Performance Kurir
				</div>
				<h2 class="d-inline-block align-middle mb-0">Performance Kurir</h2>
				<p class="subtitle mb-0 mt-1">Laporan kinerja seluruh kurir berdasarkan riwayat pengiriman</p>
			</div>
			<a href="<?= base_url('admin/kurir'); ?>" class="btn btn-light" style="border-radius:10px; border:1px solid rgba(74,44,17,0.08); font-size:0.85rem;">
				<i class="bi bi-arrow-left mr-1"></i> Kembali
			</a>
		</div>

		<div class="custom-card">
			<div class="card-header-custom">
				<i class="bi bi-bar-chart-fill"></i>
				<h6>Ringkasan Kinerja Kurir</h6>
			</div>
			<div class="card-body-custom">
				<?php if (empty($performance)): ?>
					<div class="text-center text-muted py-5">
						<i class="bi bi-inbox d-block mb-2" style="font-size:2.5rem;"></i>
						<p class="mb-0">Belum ada data kurir untuk ditampilkan.</p>
					</div>
				<?php else: ?>
					<div class="table-responsive">
						<table class="table table-custom">
							<thead>
								<tr>
									<th width="40">#</th>
									<th>Nama Kurir</th>
									<th>Status</th>
									<th>Total Pengiriman</th>
									<th>Selesai</th>
									<th>Sedang Berjalan</th>
									<th>Dibatalkan</th>
									<th>Tingkat Selesai</th>
									<th>Rata² Waktu Kirim</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; foreach ($performance as $row):
									$persen = $row['total_pengiriman'] > 0
										? round(($row['selesai'] / $row['total_pengiriman']) * 100)
										: 0;
								?>
									<tr>
										<td class="text-muted"><?= $no++; ?></td>
										<td class="link-name">
											<a href="<?= base_url('admin/kurir/detail/' . $row['id_kurir']); ?>" class="link-name" style="text-decoration:none;">
												<?= htmlspecialchars($row['nama_kurir']); ?>
											</a>
										</td>
										<td>
											<?php
											$badge_class = ['Active' => 'metric-success', 'Inactive' => 'metric-warning'];
											$cls = $badge_class[$row['status']] ?? 'metric-warning';
											?>
											<span class="metric-pill <?= $cls; ?>"><?= $row['status']; ?></span>
										</td>
										<td><?= $row['total_pengiriman']; ?></td>
										<td><span class="metric-pill metric-success"><?= $row['selesai']; ?></span></td>
										<td><span class="metric-pill metric-warning"><?= $row['sedang_berjalan']; ?></span></td>
										<td><span class="metric-pill metric-danger"><?= $row['dibatalkan']; ?></span></td>
										<td>
											<div class="d-flex align-items-center" style="gap:8px;">
												<div class="progress-mini">
													<div class="bar" style="width: <?= $persen; ?>%;"></div>
												</div>
												<span class="text-muted small"><?= $persen; ?>%</span>
											</div>
										</td>
										<td class="text-muted small">
											<?= $row['rata_rata_jam_kirim'] !== null ? $row['rata_rata_jam_kirim'] . ' jam' : '-'; ?>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
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

		if (toggleBtn) toggleBtn.addEventListener('click', toggleSidebar);
		if (overlay) overlay.addEventListener('click', toggleSidebar);

		document.addEventListener('click', function(e) {
			if (window.innerWidth > 991.98) return;
			if (!sidebar.contains(e.target) && toggleBtn && !toggleBtn.contains(e.target)) {
				if (sidebar.classList.contains('open')) toggleSidebar();
			}
		});
	</script>
</body>

</html>
