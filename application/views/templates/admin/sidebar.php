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
				
				<!-- DASHBOARD -->
				<li class="menu-item <?= strpos(current_url(), 'admin/dashboard') !== false ? 'active' : '' ?>">
					<a href="<?= base_url('admin/dashboard'); ?>">
						<i class="bi bi-grid-1x2-fill"></i>Dashboard
					</a>
				</li>

				<!-- MANAJEMEN USER -->
				<li class="menu-item <?= (strpos(current_url(), 'admin/user') !== false || strpos(current_url(), 'admin/users') !== false) ? 'active' : '' ?>">
					<a href="<?= base_url('admin/user'); ?>">
						<i class="bi bi-people-fill"></i>Manajemen User
						<?php if (isset($user_baru) && $user_baru > 0): ?>
							<span class="menu-badge" style="background: #EF4444; color: white;"><?= $user_baru; ?></span>
						<?php endif; ?>
					</a>
				</li>

				<!-- DATA PETANI -->
				<li class="menu-item <?= strpos(current_url(), 'admin/petani') !== false ? 'active' : '' ?>">
					<a href="<?= base_url('admin/petani'); ?>">
						<i class="bi bi-person-badge-fill"></i>Data Petani
						<?php if (isset($petani_baru_count) && $petani_baru_count > 0): ?>
							<span class="menu-badge" style="background: #F59E0B; color: white;"><?= $petani_baru_count; ?></span>
						<?php endif; ?>
					</a>
				</li>

				<!-- MANAJEMEN LAHAN -->
				<li class="menu-item <?= strpos(current_url(), 'admin/lahan') !== false ? 'active' : '' ?>">
					<a href="<?= base_url('admin/lahan'); ?>">
						<i class="bi bi-map-fill"></i>Manajemen Lahan
					</a>
				</li>

				<!-- MANAJEMEN PANEN -->
				<li class="menu-item <?= strpos(current_url(), 'admin/panen') !== false ? 'active' : '' ?>">
					<a href="<?= base_url('admin/panen'); ?>">
						<i class="bi bi-tree-fill"></i>Manajemen Panen
					</a>
				</li>

				<!-- MANAJEMEN PRODUK -->
				<li class="menu-item <?= strpos(current_url(), 'admin/produk') !== false ? 'active' : '' ?>">
					<a href="<?= base_url('admin/produk'); ?>">
						<i class="bi bi-box-seam-fill"></i>Manajemen Produk
					</a>
				</li>

				<!-- TRANSAKSI -->
				<li class="menu-item <?= strpos(current_url(), 'admin/transaksi') !== false ? 'active' : '' ?>">
					<a href="<?= base_url('admin/transaksi'); ?>">
						<i class="bi bi-wallet2"></i>Transaksi
						<?php if (isset($transaksi_pending) && $transaksi_pending > 0): ?>
							<span class="menu-badge" style="background: #EF4444; color: white;"><?= $transaksi_pending; ?></span>
						<?php endif; ?>
					</a>
				</li>

				<!-- MANAJEMEN KURIR -->
				<li class="menu-item <?= strpos(current_url(), 'admin/kurir') !== false ? 'active' : '' ?>">
					<a href="<?= base_url('admin/kurir'); ?>">
						<i class="bi bi-truck"></i>Manajemen Kurir
					</a>
				</li>

				<!-- MANAJEMEN MITRA -->
				<li class="menu-item <?= strpos(current_url(), 'admin/mitra') !== false ? 'active' : '' ?>">
					<a href="<?= base_url('admin/mitra'); ?>">
						<i class="bi bi-shop"></i>Manajemen Mitra
						<?php if (isset($mitra_baru) && $mitra_baru > 0): ?>
							<span class="menu-badge" style="background: #F59E0B; color: white;"><?= $mitra_baru; ?></span>
						<?php endif; ?>
					</a>
				</li>

				<!-- TRACKING PENGIRIMAN -->
				<li class="menu-item <?= strpos(current_url(), 'admin/tracking') !== false ? 'active' : '' ?>">
					<a href="<?= base_url('admin/tracking'); ?>">
						<i class="bi bi-geo-alt-fill"></i>Tracking Pengiriman
					</a>
				</li>

				<!-- ANALISIS & LAPORAN -->
				<li class="menu-item <?= strpos(current_url(), 'admin/laporan') !== false ? 'active' : '' ?>">
					<a href="<?= base_url('admin/laporan'); ?>">
						<i class="bi bi-file-earmark-bar-graph-fill"></i>Analisis & Laporan
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

	<!-- SIDEBAR OVERLAY -->
	<div class="sidebar-overlay" id="sidebarOverlay"></div>
