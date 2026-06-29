<!DOCTYPE html>
<html>
<head>
    <title>Cek Status Pesanan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background: #f5f1ea; font-family: 'Segoe UI', sans-serif; }
        .card-custom { border-radius: 16px; box-shadow: 0 10px 40px rgba(44,24,8,0.1); border: none; }
        .btn-custom { background: #4A2C11; color: white; border-radius: 50px; padding: 12px 30px; font-weight: 600; }
        .btn-custom:hover { background: #2C1808; color: white; }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-custom">
                <div class="card-header bg-white text-center border-0 pt-4">
                    <div style="font-size: 3rem;">🔍</div>
                    <h4 class="font-weight-bold" style="color: #4A2C11;">Cek Status Pesanan</h4>
                    <p class="text-muted">Masukkan invoice dan email untuk tracking</p>
                </div>
                <div class="card-body p-4">
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
                    <?php endif; ?>
                    
                    <form action="<?= base_url('guest/tracking/cek'); ?>" method="POST">
                        <div class="form-group">
                            <label class="font-weight-bold">Nomor Invoice</label>
                            <input type="text" name="invoice" class="form-control" placeholder="Contoh: INV-000001" required>
                            <small class="text-muted">Lihat di email atau halaman sukses checkout</small>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Email Pembeli</label>
                            <input type="email" name="email" class="form-control" placeholder="email@example.com" required>
                            <small class="text-muted">Email yang digunakan saat checkout</small>
                        </div>
                        <button type="submit" class="btn btn-custom btn-block">
                            <i class="bi bi-search mr-2"></i> Cek Pesanan
                        </button>
                    </form>
                    
                    <hr>
                    <p class="text-center mb-0">
                        <a href="<?= base_url('auth/login'); ?>" class="text-muted">
                            <i class="bi bi-box-arrow-in-right"></i> Login untuk lihat riwayat lengkap
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>