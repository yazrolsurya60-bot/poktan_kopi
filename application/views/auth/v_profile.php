<style>
    /* PROFIL STYLE (TETAP UTUH SESUAI ASLINYA) */
    .profile-cover {
        background: linear-gradient(135deg, var(--roasted-brown) 0%, var(--dark-coffee) 100%);
        border-radius: var(--radius-card) var(--radius-card) 0 0;
        padding: 35px 35px 30px 35px;
        position: relative;
        overflow: hidden;
        min-height: 120px;
        display: flex;
        align-items: center;
        gap: 25px;
    }

    .profile-cover::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: rgba(230, 161, 92, 0.05);
        border-radius: 50%;
        pointer-events: none;
    }

    .profile-avatar {
        width: 110px;
        height: 110px;
        min-width: 110px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--amber-cream), #d48a42);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3.5rem;
        color: white;
        border: 5px solid white;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.25);
        overflow: hidden;
        transition: var(--transition-smooth);
        position: relative;
        z-index: 2;
    }

    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-cover .user-info {
        color: white;
        position: relative;
        z-index: 2;
        flex: 1;
    }

    .profile-cover .user-info h4 {
        font-weight: 800;
        font-size: 1.5rem;
        margin-bottom: 6px;
        letter-spacing: -0.02em;
    }

    .profile-cover .user-info .badge-role {
        background: rgba(255, 255, 255, 0.12);
        color: white;
        padding: 4px 16px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        display: inline-block;
    }

    .badge-status {
        padding: 4px 16px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        display: inline-block;
    }
    .badge-status.active { background: #D1FAE5; color: #065F46; }
    .badge-status.inactive { background: #FEE2E2; color: #991B1B; }

    .profile-card {
        background: var(--card-white);
        border-radius: var(--radius-card);
        box-shadow: var(--shadow-soft);
        overflow: hidden;
        transition: var(--transition-smooth);
    }
    .profile-card .card-body-custom {
        padding: 30px 35px 30px;
    }
    .profile-card label {
        font-weight: 600;
        font-size: 0.7rem;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.7px;
        margin-bottom: 4px;
    }
    .input-group-custom { position: relative; }
    .input-group-custom .input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-secondary);
        font-size: 1rem;
        opacity: 0.5;
    }
    .profile-card .form-control {
        border-radius: 10px;
        padding: 12px 16px 12px 44px;
        border: 1px solid rgba(74, 44, 17, 0.08);
        font-size: 0.9rem;
        background: #FAF8F6;
        transition: var(--transition-smooth);
        height: 48px;
    }
    .profile-card .form-control:focus {
        border-color: var(--amber-cream);
        box-shadow: 0 0 0 3px rgba(230, 161, 92, 0.12);
        background: white;
    }
    .profile-card .form-control:disabled {
        background: #F3F0EB;
        cursor: not-allowed;
        opacity: 0.8;
    }
    .btn-edit {
        background: var(--roasted-brown);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 10px 28px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: var(--transition-smooth);
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-edit:hover { background: #3d2410; color: white; transform: translateY(-2px); }
    .btn-save {
        background: var(--amber-cream);
        color: white;
        border-radius: 10px;
        padding: 12px 32px;
        font-weight: 600;
        font-size: 0.9rem;
        border: none;
        transition: var(--transition-smooth);
    }
    .btn-cancel {
        background: transparent;
        color: var(--text-secondary);
        border: 1px solid #EFEAE2;
        border-radius: 10px;
        padding: 12px 32px;
        font-weight: 600;
        font-size: 0.9rem;
    }
    .btn-change-password {
        background: transparent;
        color: var(--roasted-brown);
        border: 2px solid var(--roasted-brown);
        border-radius: 8px;
        padding: 4px 16px;
        font-size: 0.7rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-change-password:hover { background: var(--roasted-brown); color: white; text-decoration: none; }
    .stat-mini-card {
        background: var(--bg-cream);
        border-radius: 12px;
        padding: 16px 12px;
        text-align: center;
        border: 1px solid rgba(74, 44, 17, 0.04);
        height: 100%;
    }
    .stat-mini-card .number { font-size: 1.6rem; font-weight: 800; color: var(--roasted-brown); }
    .stat-mini-card .label { font-size: 0.65rem; color: var(--text-secondary); text-transform: uppercase; font-weight: 600; }
    .info-row {
        display: flex;
        align-items: center;
        padding: 14px 0;
        border-bottom: 1px solid rgba(74, 44, 17, 0.05);
    }
    .info-row .info-icon {
        width: 44px; height: 44px; min-width: 44px;
        border-radius: 12px; background: var(--bg-cream);
        display: flex; align-items: center; justify-content: center;
        color: var(--amber-cream); font-size: 1.2rem; margin-right: 16px;
    }
    .info-row .info-label { font-size: 0.7rem; color: var(--text-secondary); text-transform: uppercase; font-weight: 500; }
    .info-row .info-value { font-size: 0.95rem; font-weight: 600; color: var(--dark-coffee); }
    .badge-email-verified { font-size: 0.6rem; padding: 4px 12px; border-radius: 20px; font-weight: 600; margin-left: 8px; }
    .badge-email-verified.verified { background: #D1FAE5; color: #065F46; }
    .badge-email-verified.unverified { background: #FEF3C7; color: #92400E; }
    .alert-custom { border-radius: 12px; padding: 14px 20px; font-weight: 600; border: none; display: flex; align-items: center; gap: 10px; }
    .alert-custom.success { background: #D1FAE5; color: #065F46; }
    .alert-custom.error { background: #FEE2E2; color: #991B1B; }
    .section-title { font-weight: 700; color: var(--roasted-brown); display: flex; align-items: center; gap: 10px; font-size: 0.9rem; }
    .section-title i { color: var(--amber-cream); font-size: 1.1rem; }
    .divider-custom { border: none; border-top: 2px solid rgba(74, 44, 17, 0.06); margin: 24px 0; }
</style>

<!-- ALERT -->
<?php if ($this->session->flashdata('success')): ?>
    <div class="alert-custom success mb-3">
        <i class="bi bi-check-circle-fill"></i> <?= $this->session->flashdata('success') ?>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <div class="alert-custom error mb-3">
        <i class="bi bi-exclamation-triangle-fill"></i> <?= $this->session->flashdata('error') ?>
    </div>
<?php endif; ?>

<!-- === PROFIL CARD === -->
<div class="profile-card">
    <!-- COVER -->
    <div class="profile-cover">
        <div class="profile-avatar">
            <?php if (!empty($user->foto) && file_exists('./uploads/profil/' . $user->foto)): ?>
                <img src="<?= base_url('uploads/profil/' . $user->foto) ?>" alt="Foto Profil">
            <?php else: ?>
                <i class="bi bi-person-fill"></i>
            <?php endif; ?>
        </div>
        <div class="user-info">
            <h4><?= $user->nama ?? 'Budi Pembeli' ?></h4>
            <div>
                <span class="badge-role"><i class="bi bi-person"></i> <?= $user->role ?? 'Pembeli' ?></span>
                <span class="badge-status <?= strtolower($user->status ?? 'Active') == 'active' ? 'active' : 'inactive'; ?> ml-2">
                    <i class="bi bi-circle-fill" style="font-size:0.4rem; margin-right:4px;"></i>
                    <?= ucfirst($user->status ?? 'Active') ?>
                </span>
            </div>
        </div>
    </div>

    <!-- BODY -->
    <div class="card-body-custom">
        <!-- STATISTIK MINI (3 KOLOM) -->
        <div class="row mb-4">
            <div class="col-4">
                <div class="stat-mini-card">
                    <div class="stat-icon" style="color: var(--amber-cream);"><i class="bi bi-receipt"></i></div>
                    <div class="number"><?= $total_transaksi ?? 0 ?></div>
                    <div class="label">Transaksi</div>
                </div>
            </div>
            <div class="col-4">
                <div class="stat-mini-card">
                    <div class="stat-icon" style="color: var(--amber-cream);"><i class="bi bi-truck"></i></div>
                    <div class="number"><?= $pesanan_dikirim ?? 0 ?></div>
                    <div class="label">Dikirim</div>
                </div>
            </div>
            <div class="col-4">
                <div class="stat-mini-card">
                    <div class="stat-icon" style="color: var(--amber-cream);"><i class="bi bi-check-circle"></i></div>
                    <div class="number"><?= $pesanan_selesai ?? 0 ?></div>
                    <div class="label">Selesai</div>
                </div>
            </div>
        </div>

        <hr class="divider-custom">

        <!-- FORM DATA DIRI -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap" style="gap: 12px;">
            <h6 class="section-title"><i class="bi bi-person-gear"></i> Data Diri</h6>
            <button class="btn-edit" id="btnEdit" onclick="toggleEdit()">
                <i class="bi bi-pencil"></i> Ubah Data
            </button>
        </div>

        <form id="profileForm" method="POST" action="<?= base_url('pembeli/profil/update'); ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <div class="input-group-custom">
                            <span class="input-icon"><i class="bi bi-person"></i></span>
                            <input type="text" name="nama" class="form-control" id="inputNama" value="<?= $user->nama ?? '' ?>" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Username</label>
                        <div class="input-group-custom">
                            <span class="input-icon"><i class="bi bi-at"></i></span>
                            <input type="text" name="username" class="form-control" id="inputUsername" value="<?= $user->username ?? '' ?>" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Foto Profil</label>
                        <div class="input-group-custom">
                            <span class="input-icon"><i class="bi bi-image"></i></span>
                            <input type="file" name="foto" class="form-control" id="inputFoto" style="padding-left:44px; padding-top:10px;" disabled>
                        </div>
                        <small class="text-muted" style="font-size:0.7rem;">Format: JPG, PNG, GIF | Maks: 2MB</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Bergabung Sejak</label>
                        <div class="input-group-custom">
                            <span class="input-icon"><i class="bi bi-calendar3"></i></span>
                            <input type="text" class="form-control" value="<?= !empty($user->created_at) ? date('d F Y', strtotime($user->created_at)) : '-' ?>" disabled>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TOMBOL AKSI -->
            <div id="editActions" style="display: none;" class="mt-3 pt-3 border-top">
                <button type="submit" class="btn-save">
                    <i class="bi bi-check-circle"></i> Simpan Perubahan
                </button>
                <button type="button" class="btn-cancel ml-2" onclick="cancelEdit()">
                    <i class="bi bi-x-circle"></i> Batal
                </button>
            </div>
        </form>

        <hr class="divider-custom">

        <!-- KEAMANAN AKUN -->
        <h6 class="section-title mb-3"><i class="bi bi-shield-lock"></i> Keamanan Akun</h6>

        <div class="info-row">
            <div class="info-icon"><i class="bi bi-key"></i></div>
            <div style="flex:1;">
                <div class="info-label">Password</div>
                <div class="info-value">••••••••</div>
            </div>
            <a href="<?= base_url('auth/ubah_password'); ?>" class="btn-change-password">
                <i class="bi bi-pencil"></i> Ubah
            </a>
        </div>

    </div>
</div>

<script>
    let isEditing = false;

    function toggleEdit() {
        isEditing = !isEditing;
        const inputs = document.querySelectorAll('#profileForm .form-control');
        const fileInput = document.getElementById('inputFoto');
        const actions = document.getElementById('editActions');
        const btnEdit = document.getElementById('btnEdit');

        inputs.forEach(input => {
            input.disabled = !isEditing;
            input.style.background = isEditing ? 'white' : '#F3F0EB';
            input.style.opacity = isEditing ? '1' : '0.8';
        });

        if (fileInput) {
            fileInput.disabled = !isEditing;
        }

        if (isEditing) {
            actions.style.display = 'block';
            btnEdit.innerHTML = '<i class="bi bi-x-circle"></i> Batalkan';
            btnEdit.className = 'btn-cancel';
        } else {
            actions.style.display = 'none';
            btnEdit.innerHTML = '<i class="bi bi-pencil"></i> Ubah Data';
            btnEdit.className = 'btn-edit';
        }
    }

    function cancelEdit() {
        if (isEditing) {
            toggleEdit();
            document.getElementById('inputNama').value = '<?= $user->nama ?? '' ?>';
            document.getElementById('inputUsername').value = '<?= $user->username ?? '' ?>';
            document.getElementById('inputEmail').value = '<?= $user->email ?? '' ?>';
            document.getElementById('inputFoto').value = '';
        }
    }
</script>