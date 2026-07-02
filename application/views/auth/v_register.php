<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Sistem Supply Chain Kopi</title>
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

    .register-container {
        width: 100%;
        max-width: 500px;
        z-index: 10;
        animation: fadeIn 0.6s ease-out;
    }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .register-card {
            background: var(--card-white);
            border: 1px solid rgba(74, 44, 17, 0.06);
            border-radius: var(--radius-card);
            box-shadow: 0 15px 35px rgba(44, 24, 8, 0.06);
            padding: 35px;
            position: relative;
            overflow: hidden;
        }

        .register-card::after {
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

        .form-control-custom:focus + i {
            color: var(--amber-cream);
        }

        .role-selector {
            display: flex;
            gap: 15px;
            margin-top: 5px;
        }

        .role-option {
            flex: 1;
            position: relative;
        }

        .role-option input {
            position: absolute;
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .register-card {
        background: var(--card-white);
        border: 1px solid rgba(74, 44, 17, 0.06);
        border-radius: var(--radius-card);
        box-shadow: 0 15px 35px rgba(44, 24, 8, 0.06);
        padding: 35px;
        position: relative;
        overflow: hidden;
    }

    .register-card::after {
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

    /* Role selector styling */
    .role-selector {
        display: flex;
        gap: 15px;
        margin-top: 5px;
    }

    .role-option {
        flex: 1;
        position: relative;
    }

    .role-option input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    .role-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 12px;
        background-color: #FAF6F0;
        border: 2px solid rgba(74, 44, 17, 0.08);
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        font-size: 0.85rem;
        transition: var(--transition-smooth);
    }

    .role-label i {
        font-size: 1.4rem;
        margin-bottom: 4px;
        color: var(--text-secondary);
    }

    .role-option input:checked+.role-label {
        background-color: #ffffff;
        border-color: var(--amber-cream);
        box-shadow: 0 4px 15px rgba(230, 161, 92, 0.1);
        color: var(--roasted-brown);
    }

    .role-option input:checked+.role-label i {
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

        .role-label i {
            font-size: 1.4rem;
            margin-bottom: 4px;
            color: var(--text-secondary);
        }

        .role-option input:checked + .role-label {
            background-color: #ffffff;
            border-color: var(--amber-cream);
            box-shadow: 0 4px 15px rgba(230, 161, 92, 0.1);
            color: var(--roasted-brown);
        }

        .role-option input:checked + .role-label i {
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

        .btn-link-custom {
            color: var(--amber-cream);
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.85rem;
        }

        .btn-link-custom:hover {
            color: var(--roasted-brown);
            text-decoration: underline;
        }

        .timer {
            font-weight: 700;
            color: var(--roasted-brown);
        }
    }
    </style>
</head>

<body>

    <div class="ambient-bg"></div>

    <div class="register-container">

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
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px; font-size: 0.85rem;">
                <i class="bi bi-check-circle-fill mr-2"></i> <?= $this->session->flashdata('success'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="register-card">

            <div class="brand-header">
                <div class="brand-icon">
                    <i class="bi bi-cup-hot"></i>
                </div>
                <h4>Poktan Kopi</h4>
                <p>Daftar Akun Baru</p>
            </div>

            <?php if (empty($register_step)): ?>
                <!-- STEP 1: Formulir Registrasi -->
                <div class="step-indicator">
                    <span class="step-badge">1</span>
                    <span>Data Pribadi</span>
                </div>

                <form method="post" action="<?= base_url('auth/register'); ?>">
                    <input type="hidden" name="action" value="register_form">

                    <div class="form-group">
                        <label for="nama"><i class="bi bi-person mr-2"></i>Nama Lengkap</label>
                        <div class="input-group-custom">
                            <input type="text" class="form-control-custom" id="nama" name="nama" placeholder="Masukkan nama lengkap" required
                                value="<?= set_value('nama'); ?>" />
                            <i class="bi bi-person"></i>
                        </div>
                        <?php if (form_error('nama')): ?>
                            <small class="text-danger"><?= form_error('nama'); ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="username"><i class="bi bi-at mr-2"></i>Username</label>
                        <div class="input-group-custom">
                            <input type="text" class="form-control-custom" id="username" name="username" placeholder="Masukkan username" required
                                value="<?= set_value('username'); ?>" />
                            <i class="bi bi-at"></i>
                        </div>
                        <?php if (form_error('username')): ?>
                            <small class="text-danger"><?= form_error('username'); ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="no_telepon"><i class="bi bi-telephone mr-2"></i>Nomor Telepon (WhatsApp)</label>
                        <div class="input-group-custom">
                            <input type="tel" class="form-control-custom" id="no_telepon" name="no_telepon" placeholder="0812345678 atau 62812345678" required
                                value="<?= set_value('no_telepon'); ?>" />
                            <i class="bi bi-telephone"></i>
                        </div>
                        <small class="text-muted-sm">Gunakan nomor yang terdaftar di WhatsApp. OTP akan dikirim ke nomor ini.</small>
                        <?php if (form_error('no_telepon')): ?>
                            <small class="text-danger"><?= form_error('no_telepon'); ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="password"><i class="bi bi-lock mr-2"></i>Password</label>
                        <div class="input-group-custom">
                            <input type="password" class="form-control-custom" id="password" name="password" placeholder="Minimal 6 karakter" required
                                value="<?= set_value('password'); ?>" />
                            <i class="bi bi-lock"></i>
                        </div>
                        <?php if (form_error('password')): ?>
                            <small class="text-danger"><?= form_error('password'); ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label><i class="bi bi-briefcase mr-2"></i>Daftar Sebagai</label>
                        <div class="role-selector">
                            <div class="role-option">
                                <input type="radio" id="petani" name="role" value="Petani" required <?= (set_value('role') === 'Petani' ? 'checked' : ''); ?> />
                                <label for="petani" class="role-label">
                                    <i class="bi bi-shop"></i>
                                    <span>Petani</span>
                                </label>
                            </div>
                            <div class="role-option">
                                <input type="radio" id="pembeli" name="role" value="Pembeli" required <?= (set_value('role') === 'Pembeli' ? 'checked' : ''); ?> />
                                <label for="pembeli" class="role-label">
                                    <i class="bi bi-bag"></i>
                                    <span>Pembeli</span>
                                </label>
                            </div>
                        </div>
                        <?php if (form_error('role')): ?>
                            <small class="text-danger"><?= form_error('role'); ?></small>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn-custom">
                        <i class="bi bi-arrow-right mr-2"></i>Lanjutkan ke OTP
                    </button>
                </form>

            <?php elseif ($register_step === 'otp_verification'): ?>
                <!-- STEP 2: Verifikasi OTP -->
                <div class="step-indicator">
                    <span class="step-badge">2</span>
                    <span>Verifikasi OTP</span>
                </div>

                <div class="info-box">
                    <i class="bi bi-info-circle"></i>
                    Kode OTP telah dikirim ke WhatsApp Anda. Masukkan kode 6 digit yang Anda terima.
                </div>

                <form method="post" action="<?= base_url('auth/register'); ?>">
                    <input type="hidden" name="action" value="verify_otp">

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
                        <input type="hidden" id="kode_otp" name="kode_otp" />
                        <?php if (form_error('kode_otp')): ?>
                            <small class="text-danger"><?= form_error('kode_otp'); ?></small>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn-custom">
                        <i class="bi bi-check-circle mr-2"></i>Verifikasi OTP
                    </button>
                </form>

                <form method="post" action="<?= base_url('auth/register'); ?>" style="margin-top: 15px;">
                    <input type="hidden" name="action" value="resend_otp">
                    <button type="submit" class="btn-secondary-custom">
                        <i class="bi bi-arrow-repeat mr-2"></i>Kirim Ulang OTP
                    </button>
                </form>

                <div class="login-footer" style="margin-top: 25px;">
                    <a href="<?= base_url('auth/register'); ?>">
                        <i class="bi bi-arrow-left mr-1"></i>Kembali ke Formulir
                    </a>
                </div>

            <?php endif; ?>

            <div class="login-footer">
                Sudah punya akun? <a href="<?= base_url('auth/login'); ?>">Masuk di sini</a>
            </div>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // OTP Input Handling
        document.querySelectorAll('.otp-input').forEach((input, index) => {
            input.addEventListener('keyup', function (e) {
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
                document.getElementById('kode_otp').value = otpValue;
            });

            input.addEventListener('input', function () {
                this.value = this.value.replace(/[^0-9]/g, '');
                if (this.value.length > 1) {
                    this.value = this.value.slice(0, 1);
                }
            });
        });

        // Form submit handler to ensure OTP is combined before submission
        // Find the form that has the verify_otp action hidden input
        const verifyForms = Array.from(document.querySelectorAll('form')).filter(form => 
            form.querySelector('input[name="action"][value="verify_otp"]')
        );
        
        if (verifyForms.length > 0) {
            verifyForms[0].addEventListener('submit', function(e) {
                const otpValue = Array.from(document.querySelectorAll('.otp-input'))
                    .map(input => input.value)
                    .join('');
                document.getElementById('kode_otp').value = otpValue;
                
                // Log for debugging
                console.log('Submitting OTP:', otpValue);
                
                // If OTP is empty, prevent submission
                if (otpValue.length !== 6) {
                    e.preventDefault();
                    alert('Mohon masukkan kode OTP 6 digit yang lengkap.');
                    return false;
                }
            });
        }
    </script>

</body>

</html>