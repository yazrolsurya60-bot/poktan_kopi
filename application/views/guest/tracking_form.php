<!DOCTYPE html>
<html>
<head>
    <title>Cek Status Pesanan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>🔍 Cek Status Pesanan</h4>
                </div>
                <div class="card-body">
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php endif; ?>
                    
                    <form action="<?php echo base_url('guest/tracking/cek'); ?>" method="POST">
                        <div class="form-group">
                            <label>Nomor Invoice</label>
                            <input type="text" name="invoice" class="form-control" placeholder="INV-000001" required>
                        </div>
                        <div class="form-group">
                            <label>Email Pembeli</label>
                            <input type="email" name="email" class="form-control" placeholder="email@example.com" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Cek Pesanan</button>
                    </form>
                    
                    <hr>
                    <p class="text-center"><a href="<?php echo base_url('auth/login'); ?>">Login untuk lihat riwayat</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>