<!-- SIDEBAR -->
	<div class="sidebar" id="sidebarMenu">
		<div class="sidebar-brand">
			<div class="brand-icon">
				<i class="bi bi-cup-hot-fill"></i>
			</div>
			<span>MEMBER <br><small style="font-weight:400; font-size:0.7rem; color:#A8988A;">Liberchain</small></span>
		</div>
		<div class="sidebar-menu-wrapper">
			<ul class="sidebar-menu">
				
				<!-- BERANDA AKUN -->
				<li class="menu-item <?= strpos(current_url(), 'pembeli/dashboard') !== false && strpos(current_url(), 'history') === false && strpos(current_url(), 'settings') === false ? 'active' : '' ?>">
					<a href="<?= base_url('pembeli/dashboard'); ?>">
						<i class="bi bi-house-door-fill"></i>Beranda Akun
					</a>
				</li>

				<!-- KATALOG BELANJA -->
				<li class="menu-item <?= strpos(current_url(), 'landing/produk') !== false ? 'active' : '' ?>">
					<a href="<?= base_url('landing/produk'); ?>">
						<i class="bi bi-shop-window"></i>Katalog Belanja
					</a>
				</li>

				<!-- RIWAYAT TRANSAKSI -->
				<li class="menu-item <?= strpos(current_url(), 'pembeli/transaksi') !== false ? 'active' : '' ?>">
					<a href="<?= base_url('pembeli/transaksi'); ?>">
						<i class="bi bi-receipt"></i>Riwayat Transaksi
						<?php if (isset($kpi_total_transaksi) && $kpi_total_transaksi > 0): ?>
							<span class="menu-badge"><?= $kpi_total_transaksi; ?></span>
						<?php endif; ?>
					</a>
				</li>

				<!-- STATUS PENGIRIMAN -->
				<li class="menu-item <?= strpos(current_url(), 'pembeli/tracking') !== false ? 'active' : '' ?>">
					<a href="<?= base_url('pembeli/tracking'); ?>">
						<i class="bi bi-geo-alt-fill"></i>Status Pengiriman
						<?php if (isset($kpi_pesanan_dikirim) && $kpi_pesanan_dikirim > 0): ?>
							<span class="menu-badge"><?= $kpi_pesanan_dikirim; ?></span>
						<?php endif; ?>
					</a>
				</li>

				<!-- PROFIL SAYA -->
				<li class="menu-item <?= strpos(current_url(), 'pembeli/profil') !== false ? 'active' : '' ?>">
					<a href="<?= base_url('pembeli/profil'); ?>">
						<i class="bi bi-person-fill"></i>Profil Saya
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