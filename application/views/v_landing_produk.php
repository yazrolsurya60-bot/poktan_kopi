<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Kopi - Liberchain</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
            --shadow-soft: 0 10px 40px rgba(111,78,55,0.10);
            --shadow-hover: 0 20px 50px rgba(59,42,30,0.18);
            --radius-card: 16px;
            --transition-smooth: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-cream);
            color: var(--dark-coffee);
        }
        .navbar-custom {
            background: rgba(245, 241, 234, 0.92);
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
        .product-section {
            padding: 130px 0 80px;
        }
        .product-card {
            background: var(--card-white);
            border-radius: var(--radius-card);
            padding: 20px;
            box-shadow: var(--shadow-soft);
            transition: var(--transition-smooth);
            height: 100%;
            border: 1px solid rgba(111, 78, 55, 0.06);
            display: flex;
            flex-direction: column;
        }
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
        }
        .product-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 12px;
            background: var(--bg-cream);
        }
        .product-name {
            font-weight: 700;
            font-size: 1.1rem;
            margin-top: 14px;
            margin-bottom: 4px;
        }
        .product-price {
            font-weight: 700;
            color: var(--roasted-brown);
            font-size: 1.2rem;
        }
        .product-stock {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }
        .btn-beli {
            background: var(--roasted-brown);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 8px 20px;
            font-weight: 700;
            font-size: 0.85rem;
            transition: var(--transition-smooth);
            cursor: pointer;
            width: 100%;
            margin-top: 12px;
        }
        .btn-beli:hover {
            background: var(--forest-green);
            color: white;
            transform: translateY(-2px);
        }
        .btn-beli i {
            margin-right: 6px;
        }
        .footer {
            background: var(--dark-coffee);
            color: rgba(255,255,255,0.7);
            padding: 32px 0;
            text-align: center;
            font-size: 0.85rem;
        }
        .cart-badge {
            background: #EF4444;
            color: white;
            border-radius: 50%;
            padding: 2px 8px;
            font-size: 0.7rem;
            margin-left: 4px;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top">
    <div class="container d-flex align-items-center">
        <a class="navbar-brand" href="<?= base_url(); ?>">
            <div class="brand-icon"><i class="bi bi-patch-check-fill"></i></div>
            Liberchain
        </a>
        <div class="ml-auto d-flex align-items-center gap-3">
            <a href="<?= base_url('transaksi/keranjang'); ?>" class="nav-btn" style="background: transparent; border-color: var(--roasted-brown); color: var(--roasted-brown); position: relative;">
                <i class="bi bi-cart"></i> Keranjang
                <span class="cart-badge" id="cart_count">0</span>
            </a>
            <a href="<?= base_url('auth/login'); ?>" class="nav-btn">Masuk</a>
        </div>
    </div>
</nav>

<!-- PRODUCT SECTION -->
<section class="product-section">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="font-weight-bold">☕ Produk Kopi</h1>
            <p class="text-muted">Pilih produk kopi terbaik dari petani kami</p>
        </div>

        <div class="row">
            <?php if (!empty($produk)): ?>
                <?php foreach ($produk as $p): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="product-card">
                        <img src="<?= base_url('uploads/produk/' . ($p['foto_produk'] ?: 'default.jpg')); ?>" 
                             alt="<?= $p['nama_produk']; ?>" 
                             class="product-image">
                        <h5 class="product-name"><?= $p['nama_produk']; ?></h5>
                        <div class="product-price">Rp <?= number_format($p['harga_produk'], 0, ',', '.'); ?> /kg</div>
                        <div class="product-stock">Stok: <?= $p['stok_produk']; ?> kg</div>
                        <button class="btn-beli" onclick="tambahKeranjang(<?= $p['id_produk']; ?>)">
                            <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="bi bi-box-seam" style="font-size: 3rem; opacity: 0.3;"></i>
                    <h4 class="mt-3">Belum ada produk</h4>
                    <p class="text-muted">Produk akan muncul di sini setelah petani menambahkan.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <p class="mb-0">&copy; <?= date('Y'); ?> POKTAN Liberchain. All rights reserved.</p>
    </div>
</footer>

<!-- ============================================ -->
<!-- SCRIPT JQUERY + AJAX UNTUK TOMBOL BELI      -->
<!-- ============================================ -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function tambahKeranjang(id_produk) {
    $.ajax({
        url: '<?= base_url("transaksi/tambah_keranjang"); ?>',
        type: 'POST',
        data: { id_produk: id_produk, jumlah: 1 },
        dataType: 'json',
        success: function(response) {
            if (response.status == 'success') {
                $('#cart_count').text(response.total_item);
                alert('✅ Produk ditambahkan ke keranjang!');
            } else {
                alert('❌ ' + response.message);
            }
        },
        error: function() {
            alert('❌ Gagal menambahkan produk');
        }
    });
}

// Update cart count saat halaman dimuat
$(document).ready(function() {
    $.ajax({
        url: '<?= base_url("transaksi/cart_count"); ?>',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#cart_count').text(data.total || 0);
        }
    });
});
</script>

</body>
</html>