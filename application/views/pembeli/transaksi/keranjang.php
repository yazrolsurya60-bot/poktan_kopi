<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Kopi Supply Chain</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: #f5f0eb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        /* Navbar */
        .navbar-custom {
            background: linear-gradient(135deg, #2d1810 0%, #4a2c1a 100%);
            padding: 15px 0;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }
        
        .navbar-custom .navbar-brand {
            color: #d4a574 !important;
            font-weight: bold;
            font-size: 24px;
        }
        
        .navbar-custom .navbar-brand i {
            color: #d4a574;
        }
        
        .navbar-custom .nav-link {
            color: #e8d5c4 !important;
            font-weight: 500;
            transition: 0.3s;
        }
        
        .navbar-custom .nav-link:hover {
            color: #d4a574 !important;
        }
        
        .navbar-custom .nav-link i {
            margin-right: 5px;
        }
        
        .badge-cart {
            background: #d4a574;
            color: #2d1810;
            border-radius: 50%;
            padding: 2px 8px;
            font-size: 12px;
            font-weight: bold;
            position: relative;
            top: -10px;
            right: 5px;
        }
        
        /* Hero Section */
        .hero-cart {
            background: linear-gradient(135deg, #4a2c1a 0%, #6b3f28 100%);
            padding: 40px 0;
            margin-bottom: 30px;
            border-radius: 0 0 30px 30px;
            color: white;
        }
        
        .hero-cart h1 {
            font-size: 32px;
            font-weight: bold;
        }
        
        .hero-cart h1 i {
            color: #d4a574;
        }
        
        .hero-cart .subtitle {
            color: #d4a574;
            font-size: 16px;
        }
        
        /* Card Keranjang */
        .cart-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            padding: 25px;
            margin-bottom: 30px;
        }
        
        .cart-empty {
            text-align: center;
            padding: 60px 20px;
        }
        
        .cart-empty i {
            font-size: 80px;
            color: #d4a574;
            margin-bottom: 20px;
        }
        
        .cart-empty h3 {
            color: #2d1810;
            font-weight: 600;
        }
        
        .cart-empty p {
            color: #8a7a6e;
            font-size: 16px;
        }
        
        .btn-shop {
            background: linear-gradient(135deg, #d4a574 0%, #b8834a 100%);
            border: none;
            color: white;
            padding: 12px 40px;
            border-radius: 50px;
            font-weight: 600;
            transition: 0.3s;
        }
        
        .btn-shop:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(212, 165, 116, 0.4);
            color: white;
        }
        
        /* Tabel Keranjang */
        .table-cart {
            margin-bottom: 0;
        }
        
        .table-cart thead th {
            background: #f5f0eb;
            color: #4a2c1a;
            border: none;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 15px;
        }
        
        .table-cart tbody td {
            padding: 20px 15px;
            vertical-align: middle;
            border-bottom: 1px solid #f0e8e0;
        }
        
        .table-cart tbody tr:hover {
            background: #faf8f6;
        }
        
        .product-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .product-image {
            width: 60px;
            height: 60px;
            background: #f5f0eb;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: #b8834a;
        }
        
        .product-name {
            font-weight: 600;
            color: #2d1810;
            font-size: 16px;
        }
        
        .product-grade {
            font-size: 12px;
            color: #8a7a6e;
        }
        
        .product-price {
            font-weight: 700;
            color: #2d1810;
            font-size: 16px;
        }
        
        .qty-wrapper {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .qty-wrapper input {
            width: 60px;
            text-align: center;
            border: 2px solid #e8ddd0;
            border-radius: 10px;
            padding: 8px;
            font-weight: 600;
            background: #faf8f6;
        }
        
        .qty-wrapper input:focus {
            border-color: #d4a574;
            outline: none;
        }
        
        .btn-qty {
            background: #f5f0eb;
            border: none;
            border-radius: 10px;
            padding: 8px 12px;
            font-weight: 600;
            color: #4a2c1a;
            transition: 0.3s;
        }
        
        .btn-qty:hover {
            background: #d4a574;
            color: white;
        }
        
        .btn-update {
            background: #d4a574;
            border: none;
            border-radius: 10px;
            padding: 8px 15px;
            color: white;
            font-weight: 600;
            font-size: 12px;
            transition: 0.3s;
        }
        
        .btn-update:hover {
            background: #b8834a;
            color: white;
        }
        
        .btn-remove {
            background: none;
            border: none;
            color: #c0392b;
            font-size: 18px;
            transition: 0.3s;
            padding: 5px 10px;
            border-radius: 10px;
        }
        
        .btn-remove:hover {
            background: #fde8e5;
            color: #a93226;
        }
        
        .subtotal-text {
            font-weight: 700;
            color: #2d1810;
        }
        
        /* Footer Tabel */
        .table-footer {
            background: #faf8f6;
            border-radius: 0 0 20px 20px;
            padding: 20px 25px;
        }
        
        .table-footer .total-label {
            font-size: 18px;
            font-weight: 600;
            color: #4a2c1a;
        }
        
        .table-footer .total-amount {
            font-size: 28px;
            font-weight: 800;
            color: #2d1810;
        }
        
        .table-footer .total-amount span {
            color: #b8834a;
        }
        
        /* Action Buttons */
        .cart-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .btn-continue {
            background: #f5f0eb;
            border: 2px solid #e8ddd0;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            color: #4a2c1a;
            transition: 0.3s;
        }
        
        .btn-continue:hover {
            background: #e8ddd0;
            color: #2d1810;
            text-decoration: none;
        }
        
        .btn-checkout {
            background: linear-gradient(135deg, #d4a574 0%, #b8834a 100%);
            border: none;
            border-radius: 50px;
            padding: 15px 45px;
            font-weight: 700;
            font-size: 18px;
            color: white;
            transition: 0.3s;
            box-shadow: 0 4px 20px rgba(212, 165, 116, 0.3);
        }
        
        .btn-checkout:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(212, 165, 116, 0.5);
            color: white;
        }
        
        .btn-checkout i {
            margin-right: 10px;
        }
        
        /* Footer */
        .footer-custom {
            background: #2d1810;
            color: #8a7a6e;
            padding: 30px 0;
            margin-top: 50px;
        }
        
        .footer-custom a {
            color: #d4a574;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero-cart h1 {
                font-size: 24px;
            }
            
            .table-cart thead {
                display: none;
            }
            
            .table-cart tbody td {
                display: block;
                padding: 10px 15px;
                border-bottom: 1px solid #f0e8e0;
            }
            
            .table-cart tbody td:before {
                content: attr(data-label);
                font-weight: 600;
                display: inline-block;
                width: 100px;
            }
            
            .table-cart tbody tr {
                display: block;
                margin-bottom: 15px;
                border: 1px solid #f0e8e0;
                border-radius: 15px;
                padding: 10px;
            }
            
            .cart-actions {
                flex-direction: column;
            }
            
            .cart-actions .btn {
                width: 100%;
                text-align: center;
            }
            
            .table-footer {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url() ?>">
            <i class="fas fa-coffee"></i> KopiChain
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('landing') ?>">
                        <i class="fas fa-home"></i> Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('pembeli/produk') ?>">
                        <i class="fas fa-coffee"></i> Produk
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= base_url('pembeli/transaksi/keranjang') ?>">
                        <i class="fas fa-shopping-cart"></i> Keranjang
                        <?php 
                            $id_user = $this->session->userdata('id_user');
                            if ($id_user) {
                                $count = $this->Keranjang_model->count_item($id_user);
                                if ($count > 0) {
                                    echo '<span class="badge badge-cart">'.$count.'</span>';
                                }
                            }
                        ?>
                    </a>
                </li>
                <?php if($this->session->userdata('id_user')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('pembeli/transaksi/riwayat') ?>">
                            <i class="fas fa-history"></i> Riwayat
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown">
                            <i class="fas fa-user"></i> <?= $this->session->userdata('nama') ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="<?= base_url('pembeli/dashboard') ?>">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('auth/logout') ?>">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('auth/login') ?>">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero-cart">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1><i class="fas fa-shopping-cart"></i> Keranjang Belanja</h1>
                <p class="subtitle">Kelola pesanan kopi Anda sebelum checkout</p>
            </div>
            <div class="col-md-4 text-right">
                <?php if(!empty($keranjang)): ?>
                    <span class="badge badge-light p-3" style="font-size:16px; background:rgba(255,255,255,0.2); color:white;">
                        <i class="fas fa-box"></i> <?= count($keranjang) ?> item
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<div class="container">

    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> <?= $this->session->flashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>
    
    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>

    <?php if(empty($keranjang)): ?>
        <!-- Keranjang Kosong -->
        <div class="cart-card">
            <div class="cart-empty">
                <i class="fas fa-shopping-basket"></i>
                <h3>Keranjang Belanja Kosong</h3>
                <p>Belum ada produk di keranjang Anda. Yuk, mulai belanja kopi berkualitas!</p>
                <a href="<?= base_url('landing') ?>" class="btn btn-shop mt-3">
                    <i class="fas fa-coffee"></i> Mulai Belanja
                </a>
            </div>
        </div>
    <?php else: ?>
        <!-- Keranjang Berisi -->
        <div class="cart-card">
            <div class="table-responsive">
                <table class="table table-cart">
                    <thead>
                        <tr>
                            <th style="width:40%;">Produk</th>
                            <th style="width:20%;">Harga</th>
                            <th style="width:20%;">Jumlah</th>
                            <th style="width:15%;">Subtotal</th>
                            <th style="width:5%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total = 0;
                        foreach($keranjang as $item): 
                            if(is_object($item)) {
                                // Member
                                $subtotal = ($item->harga_satuan ?? 0) * $item->qty;
                                $total += $subtotal;
                        ?>
                            <tr>
                                <td data-label="Produk">
                                    <div class="product-info">
                                        <div class="product-image">
                                            <?php if(isset($item->foto_produk) && $item->foto_produk): ?>
                                                <img src="<?= base_url('uploads/produk/'.$item->foto_produk) ?>" style="width:50px;height:50px;object-fit:cover;border-radius:10px;">
                                            <?php else: ?>
                                                <i class="fas fa-coffee"></i>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <div class="product-name"><?= $item->nama_produk ?? 'Produk #'.$item->id_produk ?></div>
                                            <?php if(isset($item->grade_produk) && $item->grade_produk): ?>
                                                <div class="product-grade"><i class="fas fa-tag"></i> <?= $item->grade_produk ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Harga">
                                    <div class="product-price">Rp <?= number_format($item->harga_satuan ?? 0, 0, ',', '.') ?></div>
                                </td>
                                <td data-label="Jumlah">
                                    <form action="<?= base_url('pembeli/transaksi/update_keranjang') ?>" method="post" class="qty-wrapper">
                                        <input type="hidden" name="id_produk" value="<?= $item->id_produk ?>">
                                        <input type="number" name="qty" value="<?= $item->qty ?>" min="1" max="99" required>
                                        <button type="submit" class="btn-update">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                    </form>
                                </td>
                                <td data-label="Subtotal">
                                    <div class="subtotal-text">Rp <?= number_format($subtotal, 0, ',', '.') ?></div>
                                </td>
                                <td>
                                    <a href="<?= base_url('pembeli/transaksi/hapus_keranjang/'.$item->id_produk) ?>" 
                                       class="btn-remove" 
                                       onclick="return confirm('Yakin ingin menghapus item ini?')">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php 
                            } else {
                                // Guest
                                $subtotal = ($item['harga'] ?? 0) * ($item['qty'] ?? 0);
                                $total += $subtotal;
                        ?>
                            <tr>
                                <td data-label="Produk">
                                    <div class="product-info">
                                        <div class="product-image">
                                            <i class="fas fa-coffee"></i>
                                        </div>
                                        <div>
                                            <div class="product-name"><?= $item['nama_produk'] ?? 'Produk #'.$item['id_produk'] ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Harga">
                                    <div class="product-price">Rp <?= number_format($item['harga'] ?? 0, 0, ',', '.') ?></div>
                                </td>
                                <td data-label="Jumlah">
                                    <form action="<?= base_url('pembeli/transaksi/update_keranjang') ?>" method="post" class="qty-wrapper">
                                        <input type="hidden" name="id_produk" value="<?= $item['id_produk'] ?>">
                                        <input type="number" name="qty" value="<?= $item['qty'] ?>" min="1" max="99" required>
                                        <button type="submit" class="btn-update">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                    </form>
                                </td>
                                <td data-label="Subtotal">
                                    <div class="subtotal-text">Rp <?= number_format($subtotal, 0, ',', '.') ?></div>
                                </td>
                                <td>
                                    <a href="<?= base_url('pembeli/transaksi/hapus_keranjang/'.$item['id_produk']) ?>" 
                                       class="btn-remove" 
                                       onclick="return confirm('Yakin ingin menghapus item ini?')">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php 
                            }
                        endforeach; 
                        ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Footer Total -->
            <div class="table-footer d-flex justify-content-between align-items-center">
                <div>
                    <span class="total-label"><i class="fas fa-calculator"></i> Total Belanja</span>
                </div>
                <div class="text-right">
                    <div class="total-amount">Rp <span><?= number_format($total, 0, ',', '.') ?></span></div>
                    <small style="color:#8a7a6e;">Belum termasuk ongkos kirim</small>
                </div>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="cart-actions">
            <a href="<?= base_url('landing') ?>" class="btn-continue">
                <i class="fas fa-arrow-left"></i> Lanjut Belanja
            </a>
            <div>
                <?php if(!$this->session->userdata('id_user')): ?>
                    <a href="<?= base_url('auth/login') ?>" class="btn btn-info btn-lg" style="border-radius:50px; padding:12px 30px; margin-right:10px;">
                        <i class="fas fa-sign-in-alt"></i> Login untuk Checkout
                    </a>
                <?php endif; ?>
                <a href="<?= base_url('pembeli/transaksi/checkout') ?>" class="btn-checkout">
                    <i class="fas fa-credit-card"></i> Checkout Sekarang
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Footer -->
<footer class="footer-custom">
    <div class="container text-center">
        <p class="mb-0">
            <i class="fas fa-coffee" style="color:#d4a574;"></i> 
            &copy; <?= date('Y') ?> KopiChain - Supply Chain Kopi Terintegrasi
        </p>
        <small>Dukung Petani Kopi Indonesia</small>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
// Auto dismiss alert
$(document).ready(function() {
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
});
</script>
</body>
</html>