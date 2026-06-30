<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Akun - Liberchain</title>
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
        .verif-wrap { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 40px 16px; }
        .verif-card { background: var(--card-white); border-radius: var(--radius-card); box-shadow: var(--shadow-soft); border: 1px solid rgba(111,78,55,0.06); padding: 36px; max-width: 460px; width: 100%; }
        .verif-icon { width: 56px; height: 56px; border-radius: 16px; background: linear-gradient(135deg, var(--roasted-brown), var(--amber-cream)); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem; margin-bottom: 18px; }
        .verif-title { font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.4rem; margin-bottom: 6px; }
        .verif-subtitle { color: var(--text-secondary); font-size: 0.9rem; margin-bottom: 26px; }
        .method-toggle { display: flex; gap: 10px; margin-bottom: 20px; }
        .method-btn { flex: 1; border: 2px solid rgba(111,78,55,0.15); border-radius: 10px; padding: 12px; text-align: center; cursor: pointer; font-weight: 700; font-size: 0.85rem; color: var(--text-secondary); transition: var(--transition-smooth); background: var(--bg-cream); }
        .method-btn i { display: block; font-size: 1.2rem; margin-bottom: 4px; }
        .method-btn.active { border-color: var(--roasted-brown); background: white; color: var(--roasted-brown); }
        .form-control { border: 2px solid rgba(111,78,55,0.15); border-radius: 10px; padding: 10px 14px; font-size: 0.9rem; color: var(--dark-coffee); background: var(--bg-cream); }
        .form-control:focus { border-color: var(--roasted-brown); background: white; box-shadow: 0 0 0 3px rgba(111,78,55,0.08); outline: none; }
        .btn-coffee { background: var(--dark-coffee); border: 2px solid var(--dark-coffee); color: white; font-weight: 700; padding: 11px; border-radius: 50px; width: 100%; transition: var(--transition-smooth); }
        .btn-coffee:hover { background: var(--forest-green); border-color: var(--forest-green); color: white; }
        .btn-coffee:disabled { opacity: 0.55; cursor: not-allowed; }
        .otp-inputs { display: flex; gap: 10px; justify-content: center; margin: 22px 0; }
        .otp-inputs input { width: 44px; height: 52px; text-align: center; font-size: 1.3rem; font-weight: 700; border: 2px solid rgba(111,78,55,0.2); border-radius: 10px; background: var(--bg-cream); color: var(--dark-coffee); }
        .otp-inputs input:focus { border-color: var(--roasted-brown); background: white; outline: none; }
        .resend-row { text-align: center; font-size: 0.85rem; color: var(--text-secondary); margin-bottom: 18px; }
        .resend-row a { color: var(--roasted-brown); font-weight: 700; text-decoration: none; cursor: pointer; }
        .resend-row a.disabled { color: var(--text-secondary); cursor: not-allowed; pointer-events: none; }
        .alert-soft { border-radius: 10px; font-size: 0.85rem; padding: 10px 14px; }
        .demo-box { background: #FFF8E1; border: 1px dashed #D4A017; border-radius: 10px; padding: 12px 14px; font-size: 0.82rem; color: #7A5A00; margin-bottom: 16px; }
        .back-link { display: inline-flex; align-items: center; gap: 6px; color: var(--text-secondary); font-size: 0.85rem; text-decoration: none; margin-top: 18px; }
        .back-link:hover { color: var(--roasted-brown); }
        .step-pill { display: inline-block; background: var(--bg-cream); color: var(--text-secondary); font-size: 0.72rem; font-weight: 700; letter-spacing: .04em; padding: 4px 12px; border-radius: 50px; margin-bottom: 14px; }
    </style>
</head>
<body>

<div class="verif-wrap">
    <div class="verif-card">

        <span class="step-pill"><i class="bi bi-shield-check"></i> VERIFIKASI SEBELUM CHECKOUT</span>

        <!-- ===== STEP 1: PILIH METODE & KIRIM KODE ===== -->
        <div id="step-kirim">
            <div class="verif-icon"><i class="bi bi-patch-check-fill"></i></div>
            <div class="verif-title">Verifikasi Akun Kamu</div>
            <div class="verif-subtitle">Demi keamanan transaksi (mencegah pesanan dari akun/kontak palsu), kami perlu memverifikasi kontak kamu sebelum lanjut checkout.</div>

            <div class="method-toggle">
                <div class="method-btn active" id="btn-email" onclick="pilihMetode('email')">
                    <i class="bi bi-envelope-fill"></i> Email
                </div>
                <div class="method-btn" id="btn-whatsapp" onclick="pilihMetode('whatsapp')">
                    <i class="bi bi-whatsapp"></i> WhatsApp/SMS
                </div>
            </div>

            <div class="form-group">
                <label id="label-tujuan">Alamat Email</label>
                <input type="text" id="input-tujuan" class="form-control" placeholder="nama@email.com"
                       value="<?= isset($user['email']) ? htmlspecialchars($user['email']) : '' ?>">
            </div>

            <div id="alert-kirim" class="alert-soft" style="display:none;"></div>

            <button class="btn-coffee mt-2" id="btn-kirim-kode" onclick="kirimKode()">
                <i class="bi bi-send-fill mr-1"></i> Kirim Kode Verifikasi
            </button>

            <a href="<?= base_url('transaksi/keranjang'); ?>" class="back-link">
                <i class="bi bi-arrow-left"></i> Batal, kembali ke keranjang
            </a>
        </div>

        <!-- ===== STEP 2: INPUT KODE OTP ===== -->
        <div id="step-cek" style="display:none;">
            <div class="verif-icon"><i class="bi bi-key-fill"></i></div>
            <div class="verif-title">Masukkan Kode OTP</div>
            <div class="verif-subtitle">Kami sudah mengirim kode 6 digit ke <strong id="tujuan-text"></strong>. Kode berlaku 5 menit.</div>

            <div id="demo-box" class="demo-box" style="display:none;"></div>

            <div class="otp-inputs">
                <input type="text" maxlength="1" inputmode="numeric" class="otp-digit">
                <input type="text" maxlength="1" inputmode="numeric" class="otp-digit">
                <input type="text" maxlength="1" inputmode="numeric" class="otp-digit">
                <input type="text" maxlength="1" inputmode="numeric" class="otp-digit">
                <input type="text" maxlength="1" inputmode="numeric" class="otp-digit">
                <input type="text" maxlength="1" inputmode="numeric" class="otp-digit">
            </div>

            <div id="alert-cek" class="alert-soft" style="display:none;"></div>

            <button class="btn-coffee" id="btn-verif" onclick="cekKode()">
                <i class="bi bi-check-circle-fill mr-1"></i> Verifikasi & Lanjut Checkout
            </button>

            <div class="resend-row mt-3">
                Tidak menerima kode? <a id="link-resend" onclick="kirimKode(true)">Kirim Ulang</a>
                <span id="resend-timer" style="display:none;"></span>
            </div>

            <a href="javascript:void(0)" class="back-link" onclick="gantiMetode()">
                <i class="bi bi-arrow-left"></i> Ganti email / nomor
            </a>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let metodeAktif = 'email';
const redirectTo = <?= json_encode(base_url($redirect_to)); ?>;
let resendInterval = null;

function pilihMetode(metode) {
    metodeAktif = metode;
    document.getElementById('btn-email').classList.toggle('active', metode === 'email');
    document.getElementById('btn-whatsapp').classList.toggle('active', metode === 'whatsapp');

    const label = document.getElementById('label-tujuan');
    const input = document.getElementById('input-tujuan');
    if (metode === 'email') {
        label.textContent = 'Alamat Email';
        input.placeholder = 'nama@email.com';
        input.value = <?= json_encode($user['email'] ?? '') ?>;
    } else {
        label.textContent = 'Nomor WhatsApp / HP';
        input.placeholder = '08xxxxxxxxxx';
        input.value = <?= json_encode($user['no_telp'] ?? '') ?>;
    }
}

function tampilAlert(elId, tipe, pesan) {
    const el = document.getElementById(elId);
    el.style.display = 'block';
    el.className = 'alert-soft ' + (tipe === 'success' ? 'alert alert-success' : 'alert alert-danger');
    el.textContent = pesan;
}

function mulaiTimerResend() {
    let sisa = 60;
    const link = document.getElementById('link-resend');
    const timer = document.getElementById('resend-timer');
    link.classList.add('disabled');
    timer.style.display = 'inline';
    if (resendInterval) clearInterval(resendInterval);
    resendInterval = setInterval(() => {
        sisa--;
        timer.textContent = '(' + sisa + 's)';
        if (sisa <= 0) {
            clearInterval(resendInterval);
            link.classList.remove('disabled');
            timer.style.display = 'none';
        }
    }, 1000);
}

function kirimKode(isResend) {
    const tujuan = document.getElementById('input-tujuan').value.trim();
    if (!tujuan) {
        tampilAlert('alert-kirim', 'error', 'Isi email atau nomor WhatsApp dulu ya.');
        return;
    }

    const btn = document.getElementById('btn-kirim-kode');
    btn.disabled = true;

    $.post('<?= base_url('verifikasi/kirim'); ?>', { metode: metodeAktif, tujuan: tujuan }, function (res) {
        btn.disabled = false;
        if (res.status === 'success') {
            document.getElementById('step-kirim').style.display = 'none';
            document.getElementById('step-cek').style.display = 'block';
            document.getElementById('tujuan-text').textContent = tujuan;

            const demoBox = document.getElementById('demo-box');
            if (res.simulasi) {
                demoBox.style.display = 'block';
                demoBox.innerHTML = '<i class="bi bi-info-circle-fill mr-1"></i> Mode demo (gateway WA/Email asli belum dipasang). Kode kamu: <strong>' + res.kode_demo + '</strong>';
            } else {
                demoBox.style.display = 'none';
            }

            document.querySelectorAll('.otp-digit')[0].focus();
            mulaiTimerResend();
        } else {
            tampilAlert('alert-kirim', 'error', res.message);
        }
    }, 'json').fail(function () {
        btn.disabled = false;
        tampilAlert('alert-kirim', 'error', 'Gagal menghubungi server, coba lagi.');
    });
}

function gantiMetode() {
    document.getElementById('step-cek').style.display = 'none';
    document.getElementById('step-kirim').style.display = 'block';
    document.getElementById('alert-kirim').style.display = 'none';
}

function cekKode() {
    const digits = document.querySelectorAll('.otp-digit');
    let kode = '';
    digits.forEach(d => kode += d.value);

    if (kode.length !== 6) {
        tampilAlert('alert-cek', 'error', 'Masukkan 6 digit kode dengan lengkap.');
        return;
    }

    const btn = document.getElementById('btn-verif');
    btn.disabled = true;

    $.post('<?= base_url('verifikasi/cek'); ?>', { kode: kode }, function (res) {
        btn.disabled = false;
        if (res.status === 'success') {
            tampilAlert('alert-cek', 'success', res.message);
            setTimeout(() => { window.location.href = res.redirect || redirectTo; }, 700);
        } else {
            tampilAlert('alert-cek', 'error', res.message);
            digits.forEach(d => d.value = '');
            digits[0].focus();
        }
    }, 'json').fail(function () {
        btn.disabled = false;
        tampilAlert('alert-cek', 'error', 'Gagal menghubungi server, coba lagi.');
    });
}

// Auto-pindah fokus antar kotak OTP
document.addEventListener('DOMContentLoaded', function () {
    const digits = document.querySelectorAll('.otp-digit');
    digits.forEach((d, i) => {
        d.addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value && i < digits.length - 1) digits[i + 1].focus();
        });
        d.addEventListener('keydown', function (e) {
            if (e.key === 'Backspace' && !this.value && i > 0) digits[i - 1].focus();
        });
        d.addEventListener('paste', function (e) {
            e.preventDefault();
            const paste = (e.clipboardData || window.clipboardData).getData('text').replace(/[^0-9]/g, '').slice(0, 6);
            paste.split('').forEach((ch, idx) => { if (digits[idx]) digits[idx].value = ch; });
            if (paste.length) digits[Math.min(paste.length, digits.length) - 1].focus();
        });
    });
});
</script>

</body>
</html>