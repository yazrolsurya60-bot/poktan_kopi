<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Pesanan - Liberchain</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --roasted-brown: #4A2C11;
            --dark-coffee: #2C1808;
            --amber-cream: #E6A15C;
            --bg-cream: #FAF6F0;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #FAF6F0 0%, #e8e0d8 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .card-custom {
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(44,24,8,0.12);
            border: 1px solid rgba(74,44,17,0.08);
            overflow: hidden;
            background: #FFFFFF;
        }
        .card-header-custom {
            background: linear-gradient(135deg, var(--dark-coffee), var(--roasted-brown));
            padding: 24px 30px;
            border-bottom: 3px solid var(--amber-cream);
            text-align: center;
        }
        .card-header-custom h4 {
            color: white;
            font-weight: 800;
            margin: 0;
        }
        .card-header-custom p {
            color: rgba(255,255,255,0.7);
            margin: 4px 0 0;
            font-size: 0.9rem;
        }
        .card-header-custom .icon-big {
            font-size: 2.8rem;
            color: var(--amber-cream);
            display: block;
            margin-bottom: 6px;
        }
        .form-control {
            border-radius: 10px;
            border: 2px solid rgba(74,44,17,0.12);
            padding: 12px 16px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            background: var(--bg-cream);
        }
        .form-control:focus {
            border-color: var(--roasted-brown);
            box-shadow: 0 0 0 3px rgba(74,44,17,0.08);
            background: white;
        }
        .btn-coklat {
            background: var(--roasted-brown);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px 24px;
            font-weight: 700;
            font-size: 0.95rem;
            width: 100%;
            transition: all 0.3s ease;
        }
        .btn-coklat:hover {
            background: var(--dark-coffee);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(74,44,17,0.3);
            color: white;
        }
        .text-link-coklat {
            color: var(--roasted-brown);
            font-weight: 600;
            text-decoration: none;
        }
        .text-link-coklat:hover {
            text-decoration: underline;
        }
        .alert-custom {
            border-radius: 10px;
            border: none;
        }
        .divider {
            border: none;
            border-top: 2px solid var(--bg-cream);
            margin: 20px 0;
        }
        .label-icon {
            color: var(--roasted-brown);
            margin-right: 6px;
        }
        .small-note {
            font-size: 0.78rem;
            color: #999;
            margin-top: 4px;
        }
        .small-note i {
            color: var(--amber-cream);
        }
        .footer-link {
            color: var(--roasted-brown);
            font-weight: 600;
        }
        .footer-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card card-custom">
                <div class="card-header-custom">
                    <span class="icon-big"><i class="bi bi-box-seam"></i></span>
                    <h4>Cek Status Pesanan</h4>
                    <p>Masukkan invoice dan email untuk tracking</p>
                </div>
                <div class="card-body p-4">
                    
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-custom alert-dismissible fade show">
                            <i class="bi bi-exclamation-circle mr-2"></i> <?= $this->session->flashdata('error'); ?>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-custom alert-dismissible fade show">
                            <i class="bi bi-check-circle mr-2"></i> <?= $this->session->flashdata('success'); ?>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    <?php endif; ?>
                    
                    <form action="<?= base_url('guest/tracking/cek'); ?>" method="POST">
                        <div class="form-group">
                            <label class="font-weight-bold" style="color: var(--dark-coffee);">
                                <i class="bi bi-receipt label-icon"></i> Nomor Invoice
                            </label>
                            <input type="text" name="invoice" class="form-control" placeholder="Contoh: INV-000001" required>
                            <div class="small-note">
                                <i class="bi bi-info-circle"></i> Lihat di email atau halaman sukses checkout
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="font-weight-bold" style="color: var(--dark-coffee);">
                                <i class="bi bi-envelope label-icon"></i> Email Pembeli
                            </label>
                            <input type="email" name="email" class="form-control" placeholder="email@example.com" required>
                            <div class="small-note">
                                <i class="bi bi-info-circle"></i> Email yang digunakan saat checkout
                            </div>
                        </div>
                        
                        <button type="submit" class="btn-coklat">
                            <i class="bi bi-search mr-2"></i> Cek Pesanan
                        </button>
                    </form>
                    
                    <hr class="divider">
                    
                    <div class="text-center">
                        <p class="mb-1">
                            <a href="<?= base_url('auth/login'); ?>" class="footer-link">
                                <i class="bi bi-box-arrow-in-right mr-1"></i> Login untuk lihat riwayat lengkap
                            </a>
                        </p>
                        <p class="mb-0">
                            <small class="text-muted">
                                Belum punya akun? <a href="<?= base_url('auth/register'); ?>" class="footer-link">Daftar di sini</a>
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Auto close alert after 5 seconds
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
    });
</script>
</body>
</html>