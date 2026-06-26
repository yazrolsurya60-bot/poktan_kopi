<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Sistem Supply Chain Kopi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
    :root {
        --roasted-brown: #4A2C11;
        --dark-coffee: #2C1808;
        --amber-cream: #E6A15C;
        --bg-cream: #FAF6F0;
        --card-white: #FFFFFF;
        --text-secondary: #70655E;
        --radius-card: 16px;
        --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: linear-gradient(135deg, #FAF6F0 0%, #EFEAE2 100%);
        color: var(--dark-coffee);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .reset-container {
        width: 100%;
        max-width: 450px;
        z-index: 10;
    }

    .reset-card {
        background: var(--card-white);
        border: 1px solid rgba(74, 44, 17, 0.06);
        border-radius: var(--radius-card);
        box-shadow: 0 15px 35px rgba(44, 24, 8, 0.06);
        padding: 35px;
        position: relative;
    }

    .reset-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, var(--roasted-brown), var(--amber-cream));
    }

    .header-section {
        text-align: center;
        margin-bottom: 25px;
    }

    .header-icon {
        width: 50px;
        height: 50px;
        background: rgba(230, 161, 92, 0.12);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        color: var(--amber-cream);
        margin: 0 auto 12px;
    }

    .header-section h4 {
        font-weight: 700;
        color: var(--dark-coffee);
        margin-bottom: 4px;
    }

    .header-section p {
        color: var(--text-secondary);
        font-size: 0.85rem;
    }

    .form-group label {
        font-weight: 600;
        font-size: 0.85rem;
        color: var(--dark-coffee);
    }

    .input-group-custom {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-group-custom i {
        position: absolute;
        left: 16px;
        color: var(--text-secondary);
        font-size: 1.1rem;
        z-index: 10;
    }

    .form-control-custom {
        width: 100%;
        padding: 11px 16px 11px 48px;
        background-color: #FAF6F0;
        border: 1px solid rgba(74, 44, 17, 0.08);
        border-radius: 10px;
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--dark-coffee);
        transition: var(--transition-smooth);
    }

    .form-control-custom:focus {
        background-color: #ffffff;
        border-color: var(--amber-cream);
        box-shadow: 0 0 0 4px rgba(230, 161, 92, 0.15);
        outline: none;
    }

    .btn-custom {
        background: var(--roasted-brown);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 11px 24px;
        font-weight: 600;
        font-size: 0.95rem;
        width: 100%;
        transition: var(--transition-smooth);
        box-shadow: 0 4px 15px rgba(74, 44, 17, 0.15);
    }

    .btn-custom:hover {
        background: var(--dark-coffee);
        transform: translateY(-2px);
        color: white;
    }
    </style>
</head>

<body>

    <div class="reset-container">
        <div class="reset-card">
            <div class="header-section">
                <div class="header-icon">
                    <i class="bi bi-shield-lock-fill"></i>
                </div>
                <h4>Reset Password</h4>
                <p>Masukkan kata sandi baru Anda di bawah ini</p>
            </div>

            <form method="POST" action="<?= base_url('auth/reset_password/' . $token); ?>">
                <div class="form-group">
                    <label for="password">Password Baru</label>
                    <div class="input-group-custom">
                        <input type="password" name="password" id="password" class="form-control-custom"
                            placeholder="Minimal 6 karakter" required>
                        <i class="bi bi-lock"></i>
                    </div>
                    <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="form-group mb-4">
                    <label for="confirm_password">Konfirmasi Password Baru</label>
                    <div class="input-group-custom">
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control-custom"
                            placeholder="Ulangi password baru" required>
                        <i class="bi bi-lock-check"></i>
                    </div>
                    <?= form_error('confirm_password', '<small class="text-danger">', '</small>'); ?>
                </div>

                <button type="submit" class="btn btn-custom">
                    <i class="bi bi-key-fill mr-1"></i> Perbarui Password
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>