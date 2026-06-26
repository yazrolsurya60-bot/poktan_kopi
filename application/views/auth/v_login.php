<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Sistem Supply Chain Kopi</title>
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
        --shadow-soft: 0 8px 30px rgba(44, 24, 8, 0.08);
        --shadow-hover: 0 12px 40px rgba(44, 24, 8, 0.15);
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
        position: relative;
        overflow-x: hidden;
    }

    /* Ambient coffee beans vector decorations */
    .ambient-bg {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 0;
        pointer-events: none;
        opacity: 0.05;
        background-image: url('https://www.transparenttextures.com/patterns/pinstripe.png');
    }

    .login-container {
        width: 100%;
        max-width: 480px;
        z-index: 10;
        animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-card {
        background: var(--card-white);
        border: 1px solid rgba(74, 44, 17, 0.06);
        border-radius: var(--radius-card);
        box-shadow: 0 15px 35px rgba(44, 24, 8, 0.06);
        padding: 40px;
        position: relative;
        overflow: hidden;
    }

    .login-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, var(--roasted-brown), var(--amber-cream));
    }

    .brand-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .brand-icon {
        width: 56px;
        height: 56px;
        background: rgba(230, 161, 92, 0.12);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: var(--amber-cream);
        margin: 0 auto 15px;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }

        100% {
            transform: scale(1);
        }
    }

    .brand-header h4 {
        font-weight: 700;
        color: var(--dark-coffee);
        margin-bottom: 4px;
        letter-spacing: -0.5px;
    }

    .brand-header p {
        color: var(--text-secondary);
        font-size: 0.9rem;
    }

    .form-group label {
        font-weight: 600;
        font-size: 0.85rem;
        color: var(--dark-coffee);
        margin-bottom: 6px;
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
        transition: var(--transition-smooth);
        z-index: 10;
    }

    .form-control-custom {
        width: 100%;
        padding: 12px 16px 12px 48px;
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

    .form-control-custom:focus+i {
        color: var(--amber-cream);
    }

    .btn-custom {
        background: var(--roasted-brown);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 12px 24px;
        font-weight: 600;
        font-size: 0.95rem;
        width: 100%;
        transition: var(--transition-smooth);
        box-shadow: 0 4px 15px rgba(74, 44, 17, 0.15);
        cursor: pointer;
    }

    .btn-custom:hover {
        background: var(--dark-coffee);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(44, 24, 8, 0.25);
        color: white;
    }

    .btn-custom:active {
        transform: translateY(0);
    }

    .forgot-link {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--amber-cream);
        text-decoration: none;
        transition: var(--transition-smooth);
    }

    .forgot-link:hover {
        color: var(--roasted-brown);
        text-decoration: none;
    }

    .register-footer {
        text-align: center;
        margin-top: 25px;
        font-size: 0.85rem;
        color: var(--text-secondary);
    }

    .register-footer a {
        font-weight: 700;
        color: var(--amber-cream);
        text-decoration: none;
    }

    .register-footer a:hover {
        color: var(--roasted-brown);
    }

    /* Premium Simulation Email Box */
    .simulation-card {
        background: #E0F2FE;
        border: 1px solid #BAE6FD;
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 24px;
        box-shadow: 0 4px 12px rgba(2, 132, 199, 0.08);
        animation: slideIn 0.5s ease-out;
    }

    .simulation-title {
        font-weight: 700;
        font-size: 0.85rem;
        color: #0369A1;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    </style>
</head>

<body>

    <div class="ambient-bg"></div>

    <div class="login-container">

        <!-- Simulation Email verification block if needed -->
        <?php if ($this->session->flashdata('verify_needed')): 
            $verifyData = $this->session->flashdata('verify_needed');
        ?>
        <div class="simulation-card">
            <div class="simulation-title">
                <i class="bi bi-envelope-exclamation-fill"></i> MOCK INBOX: Verifikasi Email
            </div>
            <p style="font-size: 0.8rem; color: #0c4a6e; margin-bottom: 10px;">
                Kami mensimulasikan email verifikasi yang dikirimkan ke <b><?= $verifyData['email']; ?></b>.
            </p>
            <a href="<?= base_url('auth/verify/' . $verifyData['token']); ?>"
                class="btn btn-sm btn-info text-white font-weight-bold" style="border-radius: 8px;">
                <i class="bi bi-patch-check-fill mr-1"></i> Klik untuk Verifikasi Akun
            </a>
        </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert"
            style="border-radius: 10px; font-size: 0.85rem;">
            <i class="bi bi-check-circle-fill mr-2"></i> <?= $this->session->flashdata('success'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert"
            style="border-radius: 10px; font-size: 0.85rem;">
            <i class="bi bi-exclamation-triangle-fill mr-2"></i> <?= $this->session->flashdata('error'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>

        <div class="login-card">
            <div class="brand-header">
                <div class="brand-icon">
                    <i class="bi bi-cup-hot-fill"></i>
                </div>
                <h4>Poktan Kopi</h4>
                <p>Sistem Supply Chain Kopi Liberika</p>
            </div>

            <form method="POST" action="<?= base_url('auth/login'); ?>">
                <div class="form-group">
                    <label for="username_or_email">Username atau Email</label>
                    <div class="input-group-custom">
                        <input type="text" name="username_or_email" id="username_or_email" class="form-control-custom"
                            placeholder="Masukkan username atau email" value="<?= set_value('username_or_email'); ?>"
                            required>
                        <i class="bi bi-person"></i>
                    </div>
                    <?= form_error('username_or_email', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="form-group mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label for="password" class="mb-0">Password</label>
                        <a href="<?= base_url('auth/forgot_password'); ?>" class="forgot-link">Lupa Password?</a>
                    </div>
                    <div class="input-group-custom">
                        <input type="password" name="password" id="password" class="form-control-custom"
                            placeholder="Masukkan password" required>
                        <i class="bi bi-lock"></i>
                    </div>
                    <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                </div>

                <button type="submit" class="btn btn-custom">
                    <i class="bi bi-box-arrow-in-right mr-1"></i> Masuk Sekarang
                </button>
                <a href="<?= base_url('landing'); ?>" class="btn btn-custom mt-3">
                    <i class="bi bi-arrow-left mr-1"></i> Kembali ke Halaman Landing
                </a>
            </form>

            <div class="register-footer">
                Belum punya akun? <a href="<?= base_url('auth/register'); ?>">Daftar di sini</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>