<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Liberchain</title>
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
            --radius-card: 16px;
            --transition-smooth: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-cream); color: var(--dark-coffee); }

        /* NAVBAR */
        .navbar-custom { background: rgba(245,241,234,0.95); backdrop-filter: blur(10px); padding: 15px 0; border-bottom: 1px solid rgba(111,78,55,0.07); }
        .navbar-brand { font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.5rem; color: var(--dark-coffee) !important; display: flex; align-items: center; gap: 10px; }
        .brand-icon { width: 40px; height: 40px; background: linear-gradient(135deg, var(--roasted-brown), var(--amber-cream)); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem; }
        .nav-btn { background: var(--dark-coffee); color: white; padding: 9px 26px; border-radius: 50px; font-weight: 700; font-size: 0.88rem; transition: var(--transition-smooth); border: 2px solid var(--dark-coffee); text-decoration: none; }
        .nav-btn:hover { background: var(--forest-green); border-color: var(--forest-green); color: white; text-decoration: none; }
        .nav-btn-outline { background: transparent; border-color: var(--roasted-brown); color: var(--roasted-brown); }
        .nav-btn-outline:hover { background: var(--roasted-brown); color: white; }
        .cart-badge { background: #EF4444; color: white; border-radius: 50%; padding: 2px 8px; font-size: 0.7rem; margin-left: 4px; }

        /* MAIN */
        .checkout-section { padding: 120px 0 80px; min-height: 100vh; }
        .page-title { font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 2rem; color: var(--dark-coffee); margin-bottom: 6px; }
        .page-subtitle { color: var(--text-secondary); font-size: 0.95rem; }

        /* STEPS */
        .steps-bar { display: flex; align-items: center; gap: 0; margin-bottom: 36px; }
        .step { display: flex; align-items: center; gap: 8px; font-size: 0.82rem; font-weight: 600; color: var(--text-secondary); }
        .step.active { color: var(--roasted-brown); }
        .step.done { color: var(--forest-green); }
        .step-num { width: 28px; height: 28px; border-radius: 50%; border: 2px solid currentColor; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 700; }
        .step.done .step-num { background: var(--forest-green); border-color: var(--forest-green); color: white; }
        .step.active .step-num { background: var(--roasted-brown); border-color: var(--roasted-brown); color: white; }
        .step-line { flex: 1; height: 2px; background: rgba(111,78,55,0.15); margin: 0 10px; max-width: 60px; }

        /* CARD */
        .form-card { background: var(--card-white); border-radius: var(--radius-card); box-shadow: var(--shadow-soft); border: 1px solid rgba(111,78,55,0.06); padding: 28px; margin-bottom: 20px; }
        .card-section-title { font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1rem; color: var(--dark-coffee); margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid var(--bg-cream); display: flex; align-items: center; gap: 8px; }

        /* FORM */
        .form-group label { font-weight: 600; font-size: 0.85rem; color: var(--dark-coffee); margin-bottom: 6px; }
        .form-control { border: 2px solid rgba(111,78,55,0.15); border-radius: 10px; padding: 10px 14px; font-size: 0.9rem; color: var(--dark-coffee); background: var(--bg-cream); transition: var(--transition-smooth); }
        .form-control:focus { border-color: var(--roasted-brown); background: white; box-shadow: 0 0 0 3px rgba(111,78,55,0.08); }
        select.form-control { cursor: pointer; }

        /* METODE BAYAR */
        .payment-option { border: 2px solid rgba(111,78,55,0.15); border-radius: 12px; padding: 14px 16px; cursor: pointer; transition: var(--transition-smooth); display: flex; align-items: center; gap: 12px; margin-bottom: 10px; }
        .payment-option:hover { border-color: var(--roasted-brown); background: rgba(111,78,55,0.03); }
        .payment-option.selected { border-color: var(--roasted-brown); background: rgba(111,78,55,0.05); }
        .payment-option input[type="radio"] { accent-color: var(--roasted-brown); width: 16px; height: 16px; }
        .payment-icon { width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; }
        .payment-label { font-weight: 600; font-size: 0.9rem; color: var(--dark-coffee); margin: 0; }
        .payment-desc { font-size: 0.75rem; color: var(--text-secondary); margin: 0; }

        /* ONGKIR */
        .ongkir-result { background: var(--bg-cream); border-radius: 10px; padding: 12px 16px; margin-top: 10px; display: none; }
        .ongkir-result.show { display: block; }

        /* ORDER SUMMARY */
        .summary-card { background: var(--card-white); border-radius: var(--radius-card); box-shadow: var(--shadow-soft); border: 1px solid rgba(111,78,55,0.06); padding: 28px; position: sticky; top: 100px; }
        .summary-title { font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.1rem; color: var(--dark-coffee); margin-bottom: 20px; padding-bottom: 14px; border-bottom: 2px solid var(--bg-cream); }
        .order-item { display: flex; align-items: center; gap: 12px; padding: 10px 0; border-bottom: 1px solid rgba(111,78,55,0.06); }
        .order-item:last-child { border-bottom: none; }
        .order-img { width: 48px; height: 48px; object-fit: cover; border-radius: 8px; background: var(--bg-cream); flex-shrink: 0; }
        .order-item-name { font-weight: 600; font-size: 0.85rem; color: var(--dark-coffee); }
        .order-item-qty { font-size: 0.75rem; color: var(--text-secondary); }
        .order-item-price { font-weight: 700; font-size: 0.85rem; color: var(--roasted-brown); margin-left: auto; white-space: nowrap; }
        .summary-divider { border: none; border-top: 2px solid var(--bg-cream); margin: 16px 0; }
        .summary-row { display: flex; justify-content: space-between; font-size: 0.88rem; margin-bottom: 10px; }
        .summary-row .label { color: var(--text-secondary); }
        .summary-row .value { font-weight: 700; color: var(--dark-coffee); }
        .summary-row.total { font-size: 1.1rem; font-weight: 800; margin-top: 4px; }
        .summary-row.total .value { color: var(--roasted-brown); font-size: 1.2rem; }

        /* BUTTONS */
        .btn-checkout { background: var(--dark-coffee); color: white; border: none; border-radius: 50px; padding: 14px 28px; font-weight: 700; font-size: 0.95rem; width: 100%; margin-top: 20px; transition: var(--transition-smooth); cursor: pointer; }
        .btn-checkout:hover { background: var(--forest-green); transform: translateY(-2px); box-shadow: 0 8px 25px rgba(45,106,79,0.3); }
        .btn-back { background: transparent; color: var(--roasted-brown); border: 2px solid rgba(111,78,55,0.2); border-radius: 50px; padding: 12px 28px; font-weight: 600; font-size: 0.9rem; width: 100%; margin-top: 10px; transition: var(--transition-smooth); text-decoration: none; display: block; text-align: center; }
        .btn-back:hover { background: var(--bg-cream); color: var(--roasted-brown); text-decoration: none; }

        /* FOOTER */
        .footer { background: var(--dark-coffee); color: rgba(255,255,255,0.7); padding: 28px 0; text-align: center; font-size: 0.85rem; }
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
        <div class="ml-auto d-flex align-items-center" style="gap: 12px;">
            <a href="<?= base_url('transaksi/keranjang'); ?>" class="nav-btn nav-btn-outline">
                <i class="bi bi-cart"></i> Keranjang
            </a>
            <?php if ($this->session->userdata('id_user')): ?>
                <a href="<?= base_url('auth/logout'); ?>" class="nav-btn">Keluar</a>
            <?php else: ?>
                <a href="<?= base_url('auth/login'); ?>" class="nav-btn">Masuk</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- MAIN -->
<section class="checkout-section">
    <div class="container">

        <!-- Header -->
        <div class="mb-4">
            <h1 class="page-title"><i class="bi bi-bag-check mr-2"></i>Checkout</h1>
            <p class="page-subtitle">Lengkapi data pengiriman dan pilih metode pembayaran</p>
        </div>

        <!-- Steps -->
        <div class="steps-bar mb-4">
            <div class="step done">
                <div class="step-num"><i class="bi bi-check"></i></div>
                <span>Keranjang</span>
            </div>
            <div class="step-line"></div>
            <div class="step active">
                <div class="step-num">2</div>
                <span>Checkout</span>
            </div>
            <div class="step-line"></div>
            <div class="step">
                <div class="step-num">3</div>
                <span>Selesai</span>
            </div>
        </div>

        <!-- Flash error -->
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger" style="border-radius: 12px; border: none;"><?= $this->session->flashdata('error'); ?></div>
        <?php endif; ?>

        <form action="<?= base_url('transaksi/proses_checkout'); ?>" method="POST" id="checkout-form">
        <div class="row">

            <!-- KIRI: Form -->
            <div class="col-lg-7">

                <!-- Data Penerima -->
                <div class="form-card">
                    <div class="card-section-title">
                        <i class="bi bi-person-circle" style="color: var(--roasted-brown);"></i>
                        Data Penerima
                    </div>
                    <div class="form-group">
                        <label>Nama Penerima <span class="text-danger">*</span></label>
                        <input type="text" name="nama_penerima" class="form-control"
                               value="<?= $user->nama ?? ''; ?>" placeholder="Nama lengkap penerima" required>
                    </div>
                    <div class="form-group">
                        <label>Nomor HP <span class="text-danger">*</span></label>
                        <input type="text" name="no_hp" class="form-control"
                               value="<?= $user->no_hp ?? ''; ?>" placeholder="08xxxxxxxxxx" required>
                    </div>
                </div>

                <!-- Alamat Pengiriman -->
                <div class="form-card">
                    <div class="card-section-title">
                        <i class="bi bi-geo-alt" style="color: var(--roasted-brown);"></i>
                        Alamat Pengiriman
                    </div>
                    <div class="form-group">
                        <label>Alamat Lengkap <span class="text-danger">*</span></label>
                        <textarea name="alamat_kirim" class="form-control" rows="3"
                                  placeholder="Jl. Nama Jalan, No. Rumah, RT/RW, Kelurahan, Kecamatan" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Kota Tujuan <span class="text-danger">*</span></label>
                                <select name="kota_kirim" id="kota_kirim" class="form-control" required>
                                    <option value="">-- Pilih Kota --</option>
                                    <?php foreach ($kota as $k): ?>
                                        <option value="<?= $k; ?>"><?= $k; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kode Pos</label>
                                <input type="text" name="kode_pos" class="form-control" placeholder="12345">
                            </div>
                        </div>
                    </div>

                    <!-- Hasil ongkir -->
                    <div class="ongkir-result" id="ongkir-result">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div style="font-weight: 700; font-size: 0.85rem; color: var(--dark-coffee);">
                                    <i class="bi bi-truck mr-1" style="color: var(--roasted-brown);"></i>
                                    Estimasi Pengiriman: <span id="estimasi_hari">-</span> hari
                                </div>
                                <div style="font-size: 0.78rem; color: var(--text-secondary);">Kota asal: Pontianak</div>
                            </div>
                            <div style="font-weight: 800; color: var(--roasted-brown); font-size: 1rem;" id="ongkir_display">Rp 0</div>
                        </div>
                        <input type="hidden" name="ongkir" id="ongkir_val" value="0">
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <div class="form-card">
                    <div class="card-section-title">
                        <i class="bi bi-credit-card" style="color: var(--roasted-brown);"></i>
                        Metode Pembayaran
                    </div>

                    <div class="payment-option" onclick="selectPayment('Transfer Bank', this)">
                        <input type="radio" name="metode_bayar" value="Transfer Bank" required>
                        <div class="payment-icon" style="background: #EEF2FF; color: #4F46E5;">
                            <i class="bi bi-bank"></i>
                        </div>
                        <div>
                            <p class="payment-label">Transfer Bank</p>
                            <p class="payment-desc">BCA, Mandiri, BNI, BRI</p>
                        </div>
                    </div>

                    <div class="payment-option" onclick="selectPayment('COD', this)">
                        <input type="radio" name="metode_bayar" value="COD">
                        <div class="payment-icon" style="background: #F0FDF4; color: #16A34A;">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                        <div>
                            <p class="payment-label">COD (Bayar di Tempat)</p>
                            <p class="payment-desc">Bayar saat barang tiba</p>
                        </div>
                    </div>

                    <div class="payment-option" onclick="selectPayment('E-Wallet', this)">
                        <input type="radio" name="metode_bayar" value="E-Wallet">
                        <div class="payment-icon" style="background: #FFF7ED; color: #EA580C;">
                            <i class="bi bi-phone"></i>
                        </div>
                        <div>
                            <p class="payment-label">E-Wallet</p>
                            <p class="payment-desc">GoPay, OVO, DANA, ShopeePay</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- KANAN: Summary -->
            <div class="col-lg-5">
                <div class="summary-card">
                    <div class="summary-title"><i class="bi bi-receipt mr-2"></i>Ringkasan Pesanan</div>

                    <!-- Item list -->
                    <div id="order-items">
                        <?php foreach ($cart_items as $item): ?>
                        <?php $subtotal = $item['harga_satuan'] * $item['jumlah']; ?>
                        <div class="order-item">
                            <img src="<?= base_url('uploads/produk/' . ($item['foto_produk'] ?: 'default.jpg')); ?>"
                                 class="order-img" alt="<?= $item['nama_produk']; ?>">
                            <div>
                                <div class="order-item-name"><?= $item['nama_produk']; ?></div>
                                <div class="order-item-qty">x<?= $item['jumlah']; ?> kg</div>
                            </div>
                            <div class="order-item-price">Rp <?= number_format($subtotal, 0, ',', '.'); ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <hr class="summary-divider">

                    <div class="summary-row">
                        <span class="label">Subtotal</span>
                        <span class="value">Rp <?= number_format($subtotal, 0, ',', '.'); ?></span>
                    </div>
                    <div class="summary-row">
                        <span class="label">Ongkir</span>
                        <span class="value" id="ongkir_summary" style="color: var(--text-secondary); font-weight: 500;">
                            Pilih kota dulu
                        </span>
                    </div>

                    <hr class="summary-divider">

                    <div class="summary-row total">
                        <span>Total</span>
                        <span class="value" id="grand_total_display">
                            Rp <?= number_format($subtotal, 0, ',', '.'); ?>
                        </span>
                    </div>

                    <button type="submit" class="btn-checkout" id="btn-submit">
                        <i class="bi bi-bag-check mr-1"></i> Buat Pesanan
                    </button>
                    <a href="<?= base_url('transaksi/keranjang'); ?>" class="btn-back">
                        <i class="bi bi-arrow-left mr-1"></i> Kembali ke Keranjang
                    </a>
                </div>
            </div>

        </div>
        </form>

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
    var subtotal = <?= $subtotal; ?>;

    // Pilih metode bayar
    function selectPayment(value, el) {
        $('.payment-option').removeClass('selected');
        $(el).addClass('selected');
        $(el).find('input[type="radio"]').prop('checked', true);
    }

    // Hitung ongkir otomatis saat pilih kota
    $('#kota_kirim').on('change', function () {
        var kota = $(this).val();
        if (!kota) return;

        $.ajax({
            url: '<?= base_url("transaksi/hitung_ongkir"); ?>',
            type: 'POST',
            data: { kota_asal: 'Pontianak', kota_tujuan: kota },
            dataType: 'json',
            success: function (res) {
                if (res.status === 'success') {
                    var ongkir = res.tarif;
                    var grand  = subtotal + ongkir;

                    $('#ongkir_val').val(ongkir);
                    $('#ongkir_display').text(res.tarif_formatted);
                    $('#estimasi_hari').text(res.estimasi);
                    $('#ongkir-result').addClass('show');
                    $('#ongkir_summary').text(res.tarif_formatted).css({ color: 'var(--dark-coffee)', fontWeight: '700' });
                    $('#grand_total_display').text('Rp ' + grand.toLocaleString('id-ID'));
                } else {
                    $('#ongkir_val').val(0);
                    $('#ongkir_summary').text('Tidak tersedia').css({ color: 'var(--text-secondary)', fontWeight: '500' });
                    $('#ongkir-result').removeClass('show');
                    $('#grand_total_display').text('Rp ' + subtotal.toLocaleString('id-ID'));
                }
            }
        });
    });

    // Validasi sebelum submit
    $('#checkout-form').on('submit', function (e) {
        var metode = $('input[name="metode_bayar"]:checked').val();
        if (!metode) {
            e.preventDefault();
            alert('Pilih metode pembayaran dulu ya!');
        }
    });
</script>

</body>
</html>