<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Liberchain</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
    :root {
        --roasted-brown: #6F4E37;
        --dark-coffee: #3B2A1E;
        --amber-cream: #8B5E3C;
        --forest-green: #2D6A4F;
        --bg-cream: #F5F1EA;
        --card-white: #FFFFFF;
        --text-secondary: #7A6A5C;
        --shadow-soft: 0 10px 40px rgba(111, 78, 55, 0.10);
        --shadow-hover: 0 20px 50px rgba(59, 42, 30, 0.18);
        --radius-card: 16px;
        --transition-smooth: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--bg-cream);
        color: var(--dark-coffee);
    }

    /* ===== NAVBAR ===== */
    .navbar-custom {
        background: rgba(245, 241, 234, 0.95);
        backdrop-filter: blur(10px);
        padding: 15px 0;
        border-bottom: 1px solid rgba(111, 78, 55, 0.07);
    }

    .navbar-brand {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        font-size: 1.5rem;
        color: var(--dark-coffee) !important;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .brand-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--roasted-brown), var(--amber-cream));
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
    }

    .nav-btn {
        background: var(--dark-coffee);
        color: white;
        padding: 9px 26px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.88rem;
        transition: var(--transition-smooth);
        border: 2px solid var(--dark-coffee);
        text-decoration: none;
    }

    .nav-btn:hover {
        background: var(--forest-green);
        border-color: var(--forest-green);
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
    }

    .nav-btn-outline {
        background: transparent;
        border-color: var(--roasted-brown);
        color: var(--roasted-brown);
        position: relative;
    }

    .nav-btn-outline:hover {
        background: var(--roasted-brown);
        color: white;
    }

    .cart-badge {
        background: #EF4444;
        color: white;
        border-radius: 50%;
        padding: 2px 8px;
        font-size: 0.7rem;
        margin-left: 4px;
    }

    /* ===== HALAMAN UTAMA ===== */
    .cart-section {
        padding: 120px 0 80px;
        min-height: 100vh;
    }

    .page-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        font-size: 2rem;
        color: var(--dark-coffee);
        margin-bottom: 6px;
    }

    .page-subtitle {
        color: var(--text-secondary);
        font-size: 0.95rem;
        margin-bottom: 0;
    }

    /* ===== CARD KERANJANG ===== */
    .cart-card {
        background: var(--card-white);
        border-radius: var(--radius-card);
        box-shadow: var(--shadow-soft);
        border: 1px solid rgba(111, 78, 55, 0.06);
        overflow: hidden;
    }

    .cart-table thead th {
        background: var(--bg-cream);
        color: var(--text-secondary);
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 2px solid rgba(111, 78, 55, 0.1);
        padding: 14px 20px;
    }

    .cart-table tbody td {
        padding: 18px 20px;
        vertical-align: middle;
        border-bottom: 1px solid rgba(111, 78, 55, 0.06);
    }

    .cart-table tbody tr:last-child td {
        border-bottom: none;
    }

    .cart-table tbody tr:hover {
        background: rgba(245, 241, 234, 0.5);
    }

    .product-img {
        width: 64px;
        height: 64px;
        object-fit: cover;
        border-radius: 12px;
        background: var(--bg-cream);
        flex-shrink: 0;
    }

    .product-name-text {
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--dark-coffee);
        margin-bottom: 2px;
    }

    .product-farmer {
        font-size: 0.78rem;
        color: var(--text-secondary);
    }

    .price-text {
        font-weight: 700;
        color: var(--roasted-brown);
        font-size: 0.95rem;
    }

    .subtotal-text {
        font-weight: 800;
        color: var(--dark-coffee);
        font-size: 0.95rem;
    }

    /* ===== QTY CONTROL ===== */
    .qty-control {
        display: flex;
        align-items: center;
        gap: 6px;
        justify-content: center;
    }

    .qty-btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: 2px solid rgba(111, 78, 55, 0.2);
        background: transparent;
        color: var(--roasted-brown);
        font-weight: 700;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition-smooth);
        line-height: 1;
    }

    .qty-btn:hover {
        background: var(--roasted-brown);
        border-color: var(--roasted-brown);
        color: white;
    }

    .qty-input {
        width: 48px;
        height: 32px;
        border: 2px solid rgba(111, 78, 55, 0.15);
        border-radius: 8px;
        text-align: center;
        font-weight: 700;
        font-size: 0.9rem;
        color: var(--dark-coffee);
        background: var(--bg-cream);
    }

    .qty-input:focus {
        outline: none;
        border-color: var(--roasted-brown);
    }

    /* ===== HAPUS BTN ===== */
    .btn-hapus {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: 2px solid rgba(239, 68, 68, 0.2);
        background: transparent;
        color: #EF4444;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition-smooth);
        margin: 0 auto;
    }

    .btn-hapus:hover {
        background: #EF4444;
        border-color: #EF4444;
        color: white;
    }

    /* ===== SUMMARY CARD ===== */
    .summary-card {
        background: var(--card-white);
        border-radius: var(--radius-card);
        box-shadow: var(--shadow-soft);
        border: 1px solid rgba(111, 78, 55, 0.06);
        padding: 28px;
        position: sticky;
        top: 100px;
    }

    .summary-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--dark-coffee);
        margin-bottom: 20px;
        padding-bottom: 14px;
        border-bottom: 2px solid var(--bg-cream);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
        font-size: 0.9rem;
    }

    .summary-row.total {
        font-weight: 800;
        font-size: 1.1rem;
        color: var(--dark-coffee);
        padding-top: 14px;
        border-top: 2px solid var(--bg-cream);
        margin-top: 6px;
    }

    .summary-row .label {
        color: var(--text-secondary);
    }

    .summary-row .value {
        font-weight: 700;
        color: var(--roasted-brown);
    }

    .summary-row.total .value {
        color: var(--dark-coffee);
        font-size: 1.2rem;
    }

    .btn-checkout {
        background: var(--dark-coffee);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 14px 28px;
        font-weight: 700;
        font-size: 0.95rem;
        width: 100%;
        margin-top: 20px;
        transition: var(--transition-smooth);
        text-decoration: none;
        display: block;
        text-align: center;
    }

    .btn-checkout:hover {
        background: var(--forest-green);
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(45, 106, 79, 0.3);
    }

    .btn-lanjut {
        background: transparent;
        color: var(--roasted-brown);
        border: 2px solid rgba(111, 78, 55, 0.2);
        border-radius: 50px;
        padding: 12px 28px;
        font-weight: 600;
        font-size: 0.9rem;
        width: 100%;
        margin-top: 10px;
        transition: var(--transition-smooth);
        text-decoration: none;
        display: block;
        text-align: center;
    }

    .btn-lanjut:hover {
        background: var(--bg-cream);
        color: var(--roasted-brown);
        text-decoration: none;
    }

    /* Mobile offcanvas menu */
    .navbar-toggler {
        border: none;
        padding: 8px 10px;
        font-size: 1.5rem;
        color: var(--dark-coffee);
        background: transparent;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        outline: none !important;
        box-shadow: none !important;
    }
    .navbar-toggler:focus { outline: none; }
    .mobile-menu-overlay {
        display: none;
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.4);
        z-index: 999;
    }
    .mobile-menu-overlay.active { display: block; }
    .mobile-menu {
        position: fixed;
        top: 0; left: -300px;
        width: 280px;
        height: 100vh;
        background: var(--card-white);
        z-index: 1001;
        transition: all 0.3s ease;
        padding: 20px;
        box-shadow: 4px 0 20px rgba(0,0,0,0.1);
        overflow-y: auto;
    }
    .mobile-menu.open { left: 0; }
    .mobile-menu-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid rgba(111,78,55,0.08);
    }
    .mobile-menu-header .brand {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 800;
        font-size: 1.2rem;
        color: var(--dark-coffee);
    }
    .mobile-menu-close {
        background: none;
        border: none;
        font-size: 1.5rem;
        color: var(--text-secondary);
        cursor: pointer;
    }
    .mobile-menu-links { list-style: none; padding: 0; margin: 0; }
    .mobile-menu-links li { margin-bottom: 4px; }
    .mobile-menu-links a {
        display: block;
        padding: 12px 16px;
        border-radius: 10px;
        color: var(--dark-coffee);
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        transition: var(--transition-smooth);
    }
    .mobile-menu-links a:hover,
    .mobile-menu-links a.active {
        background: rgba(230,161,92,0.1);
        color: var(--roasted-brown);
    }
    .mobile-menu-actions {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid rgba(111,78,55,0.08);
    }
    .mobile-menu-actions .btn {
        width: 100%;
        padding: 12px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 10px;
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
    }

    .empty-icon {
        width: 100px;
        height: 100px;
        background: var(--bg-cream);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        font-size: 2.5rem;
        color: var(--text-secondary);
    }

    .empty-state h4 {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        color: var(--dark-coffee);
        margin-bottom: 8px;
    }

    .empty-state p {
        color: var(--text-secondary);
        font-size: 0.9rem;
    }

    .btn-shop {
        background: var(--roasted-brown);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 12px 32px;
        font-weight: 700;
        font-size: 0.9rem;
        transition: var(--transition-smooth);
        text-decoration: none;
        display: inline-block;
        margin-top: 10px;
    }

    .btn-shop:hover {
        background: var(--forest-green);
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
    }

    /* ===== ALERT ===== */
    .alert-custom {
        border-radius: 12px;
        border: none;
        font-weight: 600;
        font-size: 0.9rem;
    }

    /* ===== FOOTER ===== */
    .footer {
        background: var(--dark-coffee);
        color: rgba(255, 255, 255, 0.7);
        padding: 28px 0;
        text-align: center;
        font-size: 0.85rem;
    }
    </style>
</head>

<body>

    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>

    <!-- Mobile Offcanvas Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-header">
            <div class="brand">
                <div class="brand-icon"><i class="bi bi-patch-check-fill"></i></div>
                Liberchain
            </div>
            <button class="mobile-menu-close" id="mobileMenuClose"><i class="bi bi-x-lg"></i></button>
        </div>
        <ul class="mobile-menu-links">
            <li><a href="<?= base_url(); ?>"><i class="bi bi-house-door mr-2"></i>Beranda</a></li>
            <li><a href="<?= base_url('produk'); ?>"><i class="bi bi-box-seam mr-2"></i>Produk</a></li>
            <li><a href="<?= base_url('landing/mitra'); ?>"><i class="bi bi-shop mr-2"></i>Mitra</a></li>
            <li><a href="<?= base_url('tentang'); ?>"><i class="bi bi-info-circle mr-2"></i>Tentang Kami</a></li>
        </ul>
        <div class="mobile-menu-actions">
            <a href="<?= base_url('transaksi/keranjang'); ?>" class="btn btn-outline-dark">
                <i class="bi bi-cart mr-2"></i>Keranjang
            </a>
            <?php if ($this->session->userdata('id_user')): ?>
            <a href="<?= base_url('auth/logout'); ?>" class="btn" style="background: var(--dark-coffee); color: white;">
                <i class="bi bi-box-arrow-right mr-2"></i>Keluar
            </a>
            <?php else: ?>
            <a href="<?= base_url('auth/login'); ?>" class="btn" style="background: var(--dark-coffee); color: white;">
                <i class="bi bi-box-arrow-in-right mr-2"></i>Masuk
            </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top">
        <div class="container d-flex align-items-center">
            <button class="navbar-toggler d-lg-none" id="navbarToggler" type="button" aria-label="Toggle navigation">
                <i class="bi bi-list"></i>
            </button>
            <a class="navbar-brand" href="<?= base_url(); ?>">
                <div class="brand-icon"><i class="bi bi-patch-check-fill"></i></div>
                Liberchain
            </a>
            <div class="ml-auto d-flex align-items-center" style="gap: 8px;">
                <a href="<?= base_url('transaksi/keranjang'); ?>" class="nav-btn nav-btn-outline d-none d-sm-inline-block" style="padding: 8px 18px; font-size:0.85rem;">
                    <i class="bi bi-cart"></i> <span class="d-none d-md-inline">Keranjang</span>
                    <span class="cart-badge"><?= $total_item ?? 0; ?></span>
                </a>
                <?php if ($this->session->userdata('id_user')): ?>
                <a href="<?= base_url('auth/logout'); ?>" class="nav-btn" style="padding: 8px 18px; font-size:0.85rem;">Keluar</a>
                <?php else: ?>
                <a href="<?= base_url('auth/login'); ?>" class="nav-btn" style="padding: 8px 18px; font-size:0.85rem;">Masuk</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- MAIN SECTION -->
    <section class="cart-section">
        <div class="container">

            <!-- Page Header -->
            <div class="mb-4">
                <h1 class="page-title"><i class="bi bi-cart3 mr-2"></i>Keranjang Belanja</h1>
                <p class="page-subtitle">
                    <?php if (!empty($cart_items)): ?>
                    <?= $total_item; ?> produk dalam keranjang kamu
                    <?php else: ?>
                    Keranjang kamu masih kosong
                    <?php endif; ?>
                </p>
            </div>

            <!-- Flash Messages -->
            <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-custom"><?= $this->session->flashdata('success'); ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-custom"><?= $this->session->flashdata('error'); ?></div>
            <?php endif; ?>

            <?php if (empty($cart_items)): ?>
            <!-- EMPTY STATE -->
            <div class="cart-card">
                <div class="empty-state">
                    <div class="empty-icon"><i class="bi bi-cart-x"></i></div>
                    <h4>Keranjang Masih Kosong</h4>
                    <p>Belum ada produk yang kamu tambahkan.<br>Yuk, temukan kopi terbaik dari petani kami!</p>
                    <a href="<?= base_url('produk'); ?>" class="btn-shop">
                        <i class="bi bi-bag mr-1"></i> Lihat Produk
                    </a>
                </div>
            </div>

            <?php else: ?>
            <!-- CART + SUMMARY -->
            <div class="row">

                <!-- Tabel Keranjang -->
                <div class="col-lg-8 mb-4">
                    <div class="cart-card">
                        <div class="table-responsive">
                            <table class="table cart-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Subtotal</th>
                                        <th class="text-center">Hapus</th>
                                    </tr>
                                </thead>
                                <tbody id="cart-body">
                                    <?php foreach ($cart_items as $item): ?>
                                    <?php $subtotal = $item['harga_satuan'] * $item['jumlah']; ?>
                                    <tr id="cart-row-<?= $item['id_keranjang']; ?>">
                                        <!-- Produk -->
                                        <td>
                                            <div class="d-flex align-items-center" style="gap: 14px;">
                                                <img src="<?= base_url('uploads/produk/' . ($item['foto_produk'] ?: 'default.jpg')); ?>"
                                                    alt="<?= $item['nama_produk']; ?>" class="product-img">
                                                <div>
                                                    <div class="product-name-text"><?= $item['nama_produk']; ?></div>
                                                    <div class="product-farmer">
                                                        <i class="bi bi-person-fill mr-1"></i>oleh
                                                        <?= $item['nama_petani']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <!-- Harga -->
                                        <td class="text-center">
                                            <span class="price-text">Rp
                                                <?= number_format($item['harga_satuan'], 0, ',', '.'); ?></span>
                                        </td>
                                        <!-- Jumlah -->
                                        <td class="text-center">
                                            <div class="qty-control">
                                                <button class="qty-btn btn-qty" data-id="<?= $item['id_keranjang']; ?>"
                                                    data-action="minus">−</button>
                                                <input type="number" class="qty-input" value="<?= $item['jumlah']; ?>"
                                                    min="1" max="<?= $item['stok_produk']; ?>"
                                                    data-id="<?= $item['id_keranjang']; ?>">
                                                <button class="qty-btn btn-qty" data-id="<?= $item['id_keranjang']; ?>"
                                                    data-action="plus">+</button>
                                            </div>
                                        </td>
                                        <!-- Subtotal -->
                                        <td class="text-center">
                                            <span class="subtotal-text" id="subtotal-<?= $item['id_keranjang']; ?>">
                                                Rp <?= number_format($subtotal, 0, ',', '.'); ?>
                                            </span>
                                        </td>
                                        <!-- Hapus -->
                                        <td>
                                            <button class="btn-hapus btn-hapus-item"
                                                data-id="<?= $item['id_keranjang']; ?>">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Lanjutkan Belanja -->
                    <div class="mt-3">
                        <a href="<?= base_url('produk'); ?>" class="btn-lanjut"
                            style="width: auto; display: inline-block; padding: 10px 24px;">
                            <i class="bi bi-arrow-left mr-1"></i> Lanjutkan Belanja
                        </a>
                    </div>
                </div>

                <!-- Summary -->
                <div class="col-lg-4">
                    <div class="summary-card">
                        <div class="summary-title"><i class="bi bi-receipt mr-2"></i>Ringkasan Pesanan</div>

                        <div class="summary-row">
                            <span class="label">Total Produk</span>
                            <span class="value"><?= $total_item; ?> item</span>
                        </div>
                        <div class="summary-row">
                            <span class="label">Subtotal</span>
                            <span class="value" id="total_keranjang_summary">Rp
                                <?= number_format($total_harga, 0, ',', '.'); ?></span>
                        </div>
                        <div class="summary-row">
                            <span class="label">Ongkir</span>
                            <span class="value" style="color: var(--text-secondary); font-weight: 500;">Dihitung saat
                                checkout</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total</span>
                            <span class="value" id="total_keranjang">Rp
                                <?= number_format($total_harga, 0, ',', '.'); ?></span>
                        </div>

                        <a href="<?= base_url('transaksi/checkout'); ?>" class="btn-checkout">
                            <i class="bi bi-bag-check mr-1"></i> Checkout Sekarang
                        </a>
                        <a href="<?= base_url('produk'); ?>" class="btn-lanjut">
                            <i class="bi bi-shop mr-1"></i> Lanjutkan Belanja
                        </a>
                    </div>
                </div>

            </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <p class="mb-0">&copy; <?= date('Y'); ?> POKTAN Liberchain. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {

        // Update qty via input langsung
        $('.qty-input').on('change', function() {
            var id = $(this).data('id');
            var qty = parseInt($(this).val());
            var max = parseInt($(this).attr('max'));
            if (qty < 1) qty = 1;
            if (qty > max) {
                alert('Stok tidak mencukupi');
                qty = max;
            }
            $(this).val(qty);
            updateCart(id, qty);
        });

        // Tombol + / -
        $('.btn-qty').on('click', function() {
            var id = $(this).data('id');
            var action = $(this).data('action');
            var input = $('.qty-input[data-id="' + id + '"]');
            var qty = parseInt(input.val());
            var max = parseInt(input.attr('max'));

            if (action === 'plus') {
                if (qty >= max) {
                    alert('Stok tidak mencukupi');
                    return;
                }
                qty++;
            } else {
                if (qty <= 1) return;
                qty--;
            }
            input.val(qty);
            updateCart(id, qty);
        });

        // Hapus item
        $('.btn-hapus-item').on('click', function() {
            if (!confirm('Hapus produk ini dari keranjang?')) return;
            var id = $(this).data('id');
            $.ajax({
                url: '<?= base_url("transaksi/hapus_keranjang"); ?>',
                type: 'POST',
                data: {
                    id_keranjang: id
                },
                dataType: 'json',
                success: function(res) {
                    if (res.status === 'success') {
                        $('#cart-row-' + id).fadeOut(300, function() {
                            $(this).remove();
                            updateTotals(res.total_harga);
                            if (res.total_item == 0) location.reload();
                        });
                    } else {
                        alert(res.message);
                    }
                }
            });
        });

        function updateCart(id, qty) {
            $.ajax({
                url: '<?= base_url("transaksi/update_keranjang"); ?>',
                type: 'POST',
                data: {
                    id_keranjang: id,
                    jumlah: qty
                },
                dataType: 'json',
                success: function(res) {
                    if (res.status === 'success') {
                        // Hitung ulang subtotal baris
                        var row = $('#cart-row-' + id);
                        var priceRaw = row.find('td:eq(1) .price-text').text().replace(/[^0-9]/g,
                            '');
                        var price = parseInt(priceRaw);
                        var subtotal = price * qty;
                        $('#subtotal-' + id).text('Rp ' + subtotal.toLocaleString('id-ID'));
                        updateTotals(res.total_harga);
                    } else {
                        alert(res.message);
                    }
                }
            });
        }

        function updateTotals(formatted) {
            var text = 'Rp ' + formatted;
            $('#total_keranjang').text(text);
            $('#total_keranjang_summary').text(text);
        }
    });
    
    // Mobile Menu Toggle
    document.addEventListener('DOMContentLoaded', function() {
        const toggler = document.getElementById('navbarToggler');
        const mobileMenu = document.getElementById('mobileMenu');
        const overlay = document.getElementById('mobileMenuOverlay');
        const closeBtn = document.getElementById('mobileMenuClose');
        
        function openMenu() {
            mobileMenu.classList.add('open');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        
        function closeMenu() {
            mobileMenu.classList.remove('open');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
        
        if (toggler) toggler.addEventListener('click', openMenu);
        if (closeBtn) closeBtn.addEventListener('click', closeMenu);
        if (overlay) overlay.addEventListener('click', closeMenu);
    });
    </script>

</body>

</html>