<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Sistem Supply Chain Kopi</title>
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

    .reset-container {
        width: 100%;
        max-width: 500px;
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

    .reset-card {
        background: var(--card-white);
        border: 1px solid rgba(74, 44, 17, 0.06);
        border-radius: var(--radius-card);
        box-shadow: 0 15px 35px rgba(44, 24, 8, 0.06);
        padding: 35px;
        position: relative;
        overflow: hidden;
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

    .brand-header {
        text-align: center;
        margin-bottom: 25px;
    }

    .brand-icon {
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

    .brand-header h4 {
        font-weight: 700;
        color: var(--dark-coffee);
        margin-bottom: 2px;
        letter-spacing: -0.5px;
    }

    .brand-header p {
        color: var(--text-secondary);
        font-size: 0.85rem;
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

    .form-control-custom:focus+i {
        color: var(--amber-cream);
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
        cursor: pointer;
    }

    .btn-custom:hover {
        background: var(--dark-coffee);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(44, 24, 8, 0.25);
        color: white;
    }

    .btn-secondary-custom {
        background: transparent;
        color: var(--amber-cream);
        border: 2px solid var(--amber-cream);
        border-radius: 10px;
        padding: 11px 24px;
        font-weight: 600;
        font-size: 0.95rem;
        width: 100%;
        transition: var(--transition-smooth);
        cursor: pointer;
    }

    .btn-secondary-custom:hover {
        background: var(--amber-cream);
        color: white;
    }

    .login-footer {
        text-align: center;
        margin-top: 20px;
        font-size: 0.85rem;
        color: var(--text-secondary);
    }

    .login-footer a {
        font-weight: 700;
        color: var(--amber-cream);
        text-decoration: none;
    }

    .login-footer a:hover {
        color: var(--roasted-brown);
    }

    .otp-input-group {
        display: flex;
        gap: 10px;
        margin-top: 5px;
        justify-content: space-between;
    }

    .otp-input {
        width: 50px;
        height: 50px;
        font-size: 1.5rem;
        text-align: center;
        background-color: #FAF6F0;
        border: 2px solid rgba(74, 44, 17, 0.08);
        border-radius: 10px;
        font-weight: 600;
        color: var(--dark-coffee);
        transition: var(--transition-smooth);
    }

    .otp-input:focus {
        background-color: #ffffff;
        border-color: var(--amber-cream);
        box-shadow: 0 0 0 4px rgba(230, 161, 92, 0.15);
        outline: none;
    }

    .step-indicator {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-bottom: 20px;
        font-size: 0.9rem;
        color: var(--text-secondary);
    }

    .step-badge {
        width: 30px;
        height: 30px;
        background: var(--amber-cream);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
    }

    .info-box {
        background: #E0F2FE;
        border: 1px solid #BAE6FD;
        border-radius: 10px;
        padding: 12px 16px;
        margin-bottom: 20px;
        font-size: 0.85rem;
        color: #0369A1;
    }

    .info-box i {
        margin-right: 8px;
    }

    .text-muted-sm {
        font-size: 0.8rem;
        color: var(--text-secondary);
    }
    </style>
</head>

<body>

    <div class="ambient-bg"></div>

    <div class="reset-container">

        <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert"
            style="border-radius: 10px; font-size: 0.85rem;">
            <i class="bi bi-exclamation-triangle-fill mr-2"></i> <?= $this->session->flashdata('error'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
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

        <div class="reset-card">

            <div class="brand-header">
                <div class="brand-icon">
                    <i class="bi bi-key"></i>
                </div>
                <h4>Lupa Password</h4>
                <p>Pulihkan akses ke akun Anda</p>
            </div>

            <form method="POST" action="<?= base_url('auth/forgot_password'); ?>">
                <div class="form-group mb-4">
                    <label for="email">Alamat Email</label>
                    <div class="input-group-custom">
                        <input type="email" name="email" id="email" class="form-control-custom"
                            placeholder="contoh@domain.com" required>
                        <i class="bi bi-envelope"></i>
                    </div>

                    <?php if (empty($reset_step)): ?>
                    <!-- STEP 1: Input Nomor Telepon -->
                    <div class="step-indicator">
                        <span class="step-badge">1</span>
                        <span>Nomor Telepon</span>

                    </div>

                    <form method="post" action="<?= base_url('auth/forgot_password'); ?>">
                        <input type="hidden" name="action" value="request_otp">

                        <div class="info-box">
                            <i class="bi bi-info-circle"></i>
                            Masukkan nomor telepon yang terdaftar di akun Anda untuk menerima kode OTP.
                        </div>

                        <div class="form-group">
                            <label for="no_telepon"><i class="bi bi-telephone mr-2"></i>Nomor Telepon (WhatsApp)</label>
                            <div class="input-group-custom">
                                <input type="tel" class="form-control-custom" id="no_telepon" name="no_telepon"
                                    placeholder="0812345678 atau 62812345678" required />
                                <i class="bi bi-telephone"></i>
                            </div>
                            <small class="text-muted-sm">Gunakan nomor yang terdaftar di akun Anda.</small>
                            <?php if (form_error('no_telepon')): ?>
                            <small class="text-danger"><?= form_error('no_telepon'); ?></small>
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn-custom">
                            <i class="bi bi-arrow-right mr-2"></i>Kirim OTP
                        </button>
                    </form>

                    <?php elseif ($reset_step === 'otp_verification'): ?>
                    <!-- STEP 2: Verifikasi OTP -->
                    <div class="step-indicator">
                        <span class="step-badge">2</span>
                        <span>Verifikasi OTP</span>
                    </div>

                    <div class="info-box">
                        <i class="bi bi-info-circle"></i>
                        Kode OTP telah dikirim ke WhatsApp Anda. Masukkan kode 6 digit yang Anda terima.
                    </div>

                    <form method="post" action="<?= base_url('auth/forgot_password'); ?>">
                        <input type="hidden" name="action" value="verify_otp_reset">

                        <div class="form-group">
                            <label for="otp"><i class="bi bi-shield-check mr-2"></i>Kode OTP</label>
                            <div class="otp-input-group">
                                <input type="text" class="otp-input" id="otp1" maxlength="1" inputmode="numeric" />
                                <input type="text" class="otp-input" id="otp2" maxlength="1" inputmode="numeric" />
                                <input type="text" class="otp-input" id="otp3" maxlength="1" inputmode="numeric" />
                                <input type="text" class="otp-input" id="otp4" maxlength="1" inputmode="numeric" />
                                <input type="text" class="otp-input" id="otp5" maxlength="1" inputmode="numeric" />
                                <input type="text" class="otp-input" id="otp6" maxlength="1" inputmode="numeric" />
                            </div>
                            <input type="hidden" id="otp" name="otp" />
                            <?php if (form_error('otp')): ?>
                            <small class="text-danger"><?= form_error('otp'); ?></small>
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn-custom">
                            <i class="bi bi-check-circle mr-2"></i>Verifikasi OTP
                        </button>
                    </form>

                    <form method="post" action="<?= base_url('auth/forgot_password'); ?>" style="margin-top: 15px;">
                        <input type="hidden" name="action" value="resend_otp_reset">
                        <button type="submit" class="btn-secondary-custom">
                            <i class="bi bi-arrow-repeat mr-2"></i>Kirim Ulang OTP
                        </button>
                    </form>

                    <div class="login-footer" style="margin-top: 25px;">
                        <a href="<?= base_url('auth/forgot_password'); ?>">
                            <i class="bi bi-arrow-left mr-1"></i>Mulai Lagi
                        </a>
                    </div>

                    <?php elseif ($reset_step === 'password_change'): ?>
                    <!-- STEP 3: Ubah Password -->
                    <div class="step-indicator">
                        <span class="step-badge">3</span>
                        <span>Password Baru</span>
                    </div>

                    <div class="info-box">
                        <i class="bi bi-info-circle"></i>
                        Masukkan password baru untuk akun Anda.
                    </div>

                    <form method="post" action="<?= base_url('auth/forgot_password'); ?>">
                        <input type="hidden" name="action" value="change_password">

                        <div class="form-group">
                            <label for="password"><i class="bi bi-lock mr-2"></i>Password Baru</label>
                            <div class="input-group-custom">
                                <input type="password" class="form-control-custom" id="password" name="password"
                                    placeholder="Minimal 6 karakter" required />
                                <i class="bi bi-lock"></i>
                            </div>
                            <?php if (form_error('password')): ?>
                            <small class="text-danger"><?= form_error('password'); ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password"><i class="bi bi-lock mr-2"></i>Konfirmasi Password</label>
                            <div class="input-group-custom">
                                <input type="password" class="form-control-custom" id="confirm_password"
                                    name="confirm_password" placeholder="Ketik ulang password" required />
                                <i class="bi bi-lock"></i>
                            </div>
                            <?php if (form_error('confirm_password')): ?>
                            <small class="text-danger"><?= form_error('confirm_password'); ?></small>
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn-custom">
                            <i class="bi bi-check-circle mr-2"></i>Ubah Password
                        </button>
                    </form>

                    <?php endif; ?>

                    <div class="login-footer">
                        <a href="<?= base_url('auth/login'); ?>">
                            <i class="bi bi-arrow-left mr-1"></i>Kembali ke Login
                        </a>
                    </div>

                </div>

        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

        <script>
        // OTP Input Handling
        document.querySelectorAll('.otp-input').forEach((input, index) => {
            input.addEventListener('keyup', function(e) {
                if (this.value.length === 1 && index < 5) {
                    document.querySelectorAll('.otp-input')[index + 1].focus();
                }
                if (e.key === 'Backspace' && index > 0) {
                    this.value = '';
                    document.querySelectorAll('.otp-input')[index - 1].focus();
                }

                // Combine all OTP values
                const otpValue = Array.from(document.querySelectorAll('.otp-input'))
                    .map(input => input.value)
                    .join('');
                document.getElementById('otp').value = otpValue;
            });

            input.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
                if (this.value.length > 1) {
                    this.value = this.value.slice(0, 1);
                }
            });
        });
        </script>

</body>

</html>