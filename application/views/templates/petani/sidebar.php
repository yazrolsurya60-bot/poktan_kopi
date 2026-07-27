<?php $segment2 = $this->uri->segment(2); ?>
    <!-- SIDEBAR MENU -->
    <div class="sidebar" id="sidebarMenu">
        <div class="sidebar-brand">
            <div class="brand-icon">
                <i class="bi bi-patch-check-fill"></i>
            </div>
            <span>PETANI <br><small style="font-weight:400; font-size:0.7rem; color:#A8988A;">Liberchain</small></span>
        </div>
        <div class="sidebar-menu-wrapper">
            <ul class="sidebar-menu">
                <li class="menu-item <?= ($segment2 == 'dashboard' || $segment2 == '') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/dashboard'); ?>">
                        <i class="bi bi-grid-1x2-fill"></i>Dashboard
                    </a>
                </li>
                <li class="menu-item <?= ($segment2 == 'lahan') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/lahan'); ?>">
                        <i class="bi bi-geo-alt-fill"></i>Kelola Lahan
                    </a>
                </li>
                <li class="menu-item <?= ($segment2 == 'panen') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/panen'); ?>">
                        <i class="bi bi-tree-fill"></i>Manajemen Panen
                    </a>
                </li>
                <li class="menu-item <?= ($segment2 == 'produk') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/produk'); ?>">
                        <i class="bi bi-box-seam"></i>Katalog Produk
                    </a>
                </li>
                <li class="menu-item <?= ($segment2 == 'transaksi') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/transaksi'); ?>">
                        <i class="bi bi-cart-check-fill"></i>Pesanan Masuk
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

