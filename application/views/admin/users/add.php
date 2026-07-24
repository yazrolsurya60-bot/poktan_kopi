<!-- STYLES KHUSUS FORM TAMBAH USER -->
<style>
	.btn-custom-primary {
		background: var(--roasted-brown, #4A2C11) !important;
		color: #ffffff !important;
		border-radius: 10px;
		padding: 10px 28px;
		font-weight: 600;
		font-size: 0.85rem;
		border: none;
		transition: all 0.3s ease;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		text-decoration: none !important;
	}

	.btn-custom-primary:hover {
		background: var(--dark-coffee, #2C1808) !important;
		color: #ffffff !important;
		transform: translateY(-2px);
	}

	.btn-custom-secondary {
		background: transparent;
		color: var(--text-secondary, #70655E);
		border: 1px solid rgba(74, 44, 17, 0.15);
		border-radius: 10px;
		padding: 10px 28px;
		font-weight: 600;
		font-size: 0.85rem;
		transition: all 0.3s ease;
		display: inline-flex;
		align-items: center;
		justify-content: center;
	}

	.btn-custom-secondary:hover {
		background: var(--bg-cream, #FAF6F0);
		color: var(--roasted-brown, #4A2C11);
		text-decoration: none;
	}
</style>

<!-- ALERT MESSAGES -->
<?php if ($this->session->flashdata('success')): ?>
	<div class="alert alert-success alert-dismissible fade show mb-3" style="border-radius: 12px;">
		<i class="bi bi-check-circle-fill mr-2"></i> <?= $this->session->flashdata('success') ?>
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
	<div class="alert alert-danger alert-dismissible fade show mb-3" style="border-radius: 12px;">
		<i class="bi bi-exclamation-circle-fill mr-2"></i> <?= $this->session->flashdata('error') ?>
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
<?php endif; ?>

<<<<<<< HEAD
        .sidebar-menu-wrapper {
            flex: 1;
            overflow-y: auto;
            padding: 15px 0;
        }

        .sidebar-menu {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .menu-item a {
            display: flex;
            align-items: center;
            padding: 12px 24px;
            color: #A8988A;
            font-weight: 500;
            font-size: 0.9rem;
            transition: var(--transition-smooth);
            text-decoration: none;
            position: relative;
            margin: 2px 10px;
            border-radius: 10px;
        }

        .menu-item a i {
            font-size: 1.15rem;
            margin-right: 14px;
            width: 22px;
            text-align: center;
        }

        .menu-item a .menu-badge {
            margin-left: auto;
            background: rgba(230, 161, 92, 0.2);
            color: var(--amber-cream);
            font-size: 0.7rem;
            padding: 2px 10px;
            border-radius: 20px;
            font-weight: 600;
        }

        .menu-item.active a,
        .menu-item a:hover {
            color: #ffffff;
            background: rgba(230, 161, 92, 0.12);
        }

        .menu-item.active a {
            background: rgba(230, 161, 92, 0.18);
            border-left: 3px solid var(--amber-cream);
        }

        .menu-item.active a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 24px;
            background: var(--amber-cream);
            border-radius: 0 3px 3px 0;
        }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid rgba(250, 246, 240, 0.06);
            margin-top: auto;
        }

        .sidebar-footer .btn-logout {
            width: 100%;
            padding: 10px 16px;
            border: 1px solid rgba(250, 246, 240, 0.1);
            border-radius: 10px;
            background: transparent;
            color: #A8988A;
            font-weight: 500;
            font-size: 0.85rem;
            transition: var(--transition-smooth);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
        }

        .sidebar-footer .btn-logout:hover {
            background: rgba(230, 161, 92, 0.1);
            color: #ffffff;
            border-color: rgba(230, 161, 92, 0.2);
        }

        /* --- MAIN CONTENT --- */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 30px 40px 40px;
            min-height: 100vh;
            transition: var(--transition-smooth);
        }

        /* --- PAGE HEADER --- */
        .page-header {
            border-bottom: 1px solid rgba(74, 44, 17, 0.08);
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .page-header h2 {
            font-weight: 700;
            color: var(--dark-coffee);
            letter-spacing: -0.02em;
        }

        .page-header .subtitle {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-top: 2px;
        }

        /* --- CUSTOM CARD --- */
        .custom-card {
            background: var(--card-white);
            border: 1px solid rgba(74, 44, 17, 0.06);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-soft);
            transition: var(--transition-smooth);
            overflow: hidden;
            max-width: 600px;
            margin: 0 auto;
        }

        .custom-card:hover {
            box-shadow: var(--shadow-hover);
        }

        .custom-card .card-header-custom {
            padding: 18px 24px;
            border-bottom: 1px solid rgba(74, 44, 17, 0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .custom-card .card-header-custom h6 {
            font-weight: 700;
            color: var(--dark-coffee);
            margin: 0;
            font-size: 0.85rem;
        }

        .custom-card .card-body-custom {
            padding: 24px;
        }

        /* --- FORM --- */
        .form-custom .form-group {
            margin-bottom: 20px;
        }

        .form-custom label {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--dark-coffee);
            margin-bottom: 6px;
        }

        .form-custom .form-control,
        .form-custom .form-select {
            border: 1px solid rgba(74, 44, 17, 0.12);
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 0.9rem;
            transition: var(--transition-smooth);
            background: var(--card-white);
            color: var(--dark-coffee);
        }

        .form-custom .form-control:focus,
        .form-custom .form-select:focus {
            border-color: var(--amber-cream);
            box-shadow: 0 0 0 3px rgba(230, 161, 92, 0.15);
        }

        .form-custom .form-control::placeholder {
            color: #B8B0A8;
            font-size: 0.85rem;
        }

        /* --- BUTTONS --- */
        .btn-custom-primary {
            background: var(--roasted-brown);
            color: white;
            border-radius: 10px;
            padding: 10px 28px;
            font-weight: 600;
            font-size: 0.85rem;
            border: none;
            transition: var(--transition-smooth);
        }

        .btn-custom-primary:hover {
            background: var(--dark-coffee);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-soft);
        }

        .btn-custom-secondary {
            background: transparent;
            color: var(--text-secondary);
            border: 1px solid rgba(74, 44, 17, 0.15);
            border-radius: 10px;
            padding: 10px 28px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: var(--transition-smooth);
        }

        .btn-custom-secondary:hover {
            background: var(--bg-cream);
            border-color: var(--roasted-brown);
            color: var(--roasted-brown);
            text-decoration: none;
        }

        /* --- ALERT --- */
        .alert-custom {
            border-radius: var(--radius-card);
            border: none;
            padding: 16px 20px;
            margin-bottom: 24px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .alert-custom.alert-success {
            background: #D1FAE5;
            color: #065F46;
        }

        .alert-custom.alert-danger {
            background: #FEE2E2;
            color: #991B1B;
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 991.98px) {
            .sidebar {
                left: calc(-1 * var(--sidebar-width));
                box-shadow: none;
            }

            .sidebar.open {
                left: 0;
                box-shadow: 0 0 40px rgba(0, 0, 0, 0.3);
            }

            .main-content {
                margin-left: 0;
                padding: 20px 16px 30px;
            }

            .page-header h2 {
                font-size: 1.3rem;
            }

            .custom-card {
                max-width: 100%;
            }
        }

        @media (max-width: 575.98px) {
            .main-content {
                padding: 16px 12px 20px;
            }

            .custom-card .card-body-custom {
                padding: 16px;
            }

            .btn-custom-primary,
            .btn-custom-secondary {
                width: 100%;
                margin-bottom: 8px;
                text-align: center;
            }

            .btn-group-custom {
                flex-direction: column;
            }
        }

        /* SIDEBAR OVERLAY */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 99;
        }

        .sidebar-overlay.active {
            display: block;
        }

        /* SCROLLBAR */
        .sidebar-menu-wrapper::-webkit-scrollbar {
            width: 3px;
        }

        .sidebar-menu-wrapper::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-menu-wrapper::-webkit-scrollbar-thumb {
            background: rgba(230, 161, 92, 0.3);
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <?php $this->load->view('admin/layout/sidebar'); ?>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <!-- PAGE HEADER -->
        <div class="page-header d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle" style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
                    <i class="bi bi-list"></i>
                </button>
                <h2 class="d-inline-block align-middle mb-0">Tambah User</h2>
                <p class="subtitle mb-0 mt-1">Tambahkan user baru ke sistem</p>
            </div>
            <div class="d-flex align-items-center gap-3" style="gap: 12px;">
                <div class="d-flex align-items-center gap-2" style="cursor: pointer; padding: 6px 12px; border-radius: 10px; background: var(--card-white); border: 1px solid rgba(74,44,17,0.06);">
                    <i class="bi bi-person-circle" style="font-size: 1.5rem; color: var(--amber-cream);"></i>
                    <span style="font-weight:500; font-size:0.85rem;">Admin</span>
                </div>
            </div>
        </div>

        <!-- ALERT MESSAGES -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert-custom alert-success">
                <i class="bi bi-check-circle-fill mr-2"></i> <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert-custom alert-danger">
                <i class="bi bi-exclamation-circle-fill mr-2"></i> <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- FORM CARD -->
        <div class="custom-card">
            <div class="card-header-custom">
                <h6><i class="bi bi-person-plus-fill text-success mr-2"></i> Form Tambah User</h6>
                <i class="bi bi-person text-muted" style="font-size:1.2rem;"></i>
            </div>
            <div class="card-body-custom">
                <form method="post" action="<?= site_url('admin/user/add') ?>" class="form-custom">
                    <div class="form-group">
                        <label for="nama">
                            <i class="bi bi-person mr-1 text-muted"></i> Nama Lengkap
                        </label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama lengkap" required 
                               value="<?= set_value('nama') ?>" />
                    </div>
                    <div class="form-group">
                        <label for="username">
                            <i class="bi bi-at mr-1 text-muted"></i> Username
                        </label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username" required 
                               value="<?= set_value('username') ?>" />
                    </div>
                    <div class="form-group">
                        <label for="no_telepon">
                            <i class="bi bi-telephone mr-1 text-muted"></i> Nomor Telepon
                        </label>
                        <input type="tel" name="no_telepon" id="no_telepon" class="form-control" placeholder="0812345678 atau 62812345678" required 
                               value="<?= set_value('no_telepon') ?>" />
                    </div>
                    <div class="form-group">
                        <label for="email">
                            <i class="bi bi-envelope mr-1 text-muted"></i> Email
                        </label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email" required 
                               value="<?= set_value('email') ?>" />
                    </div>
                    <div class="form-group">
                        <label for="password">
                            <i class="bi bi-lock mr-1 text-muted"></i> Password
                        </label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required />
                    </div>
                    <div class="form-group">
                        <label for="role">
                            <i class="bi bi-tag mr-1 text-muted"></i> Role
                        </label>
                        <select name="role" id="role" class="form-select" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="Admin" <?= set_value('role') === 'Admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="Petani" <?= set_value('role') === 'Petani' ? 'selected' : '' ?>>Petani</option>
                            <option value="Pembeli" <?= set_value('role') === 'Pembeli' ? 'selected' : '' ?>>Pembeli</option>
                            <option value="Guest" <?= set_value('role') === 'Guest' ? 'selected' : '' ?>>Guest</option>
                        </select>
                    </div>
                    <div class="d-flex gap-2 btn-group-custom" style="gap: 10px; margin-top: 24px;">
                        <button type="submit" class="btn-custom-primary">
                            <i class="bi bi-save mr-1"></i> Simpan
                        </button>
                        <a href="<?= site_url('admin/user') ?>" class="btn-custom-secondary">
                            <i class="bi bi-arrow-left mr-1"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ============================================
        // SIDEBAR TOGGLE
        // ============================================
        const sidebar = document.getElementById('sidebarMenu');
        const overlay = document.getElementById('sidebarOverlay');
        const toggleBtn = document.getElementById('sidebarToggle');

        function toggleSidebar() {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
            document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
        }

        if (toggleBtn) {
            toggleBtn.addEventListener('click', toggleSidebar);
        }
        if (overlay) {
            overlay.addEventListener('click', toggleSidebar);
        }

        document.addEventListener('click', function(e) {
            if (window.innerWidth > 991.98) return;
            if (!sidebar.contains(e.target) && toggleBtn && !toggleBtn.contains(e.target)) {
                if (sidebar.classList.contains('open')) {
                    toggleSidebar();
                }
            }
        });

        console.log('✅ Form Tambah User siap digunakan!');
    </script>
</body>

</html>
=======
<!-- FORM CARD -->
<div class="custom-card" style="background: #fff; border-radius: 14px; border: 1px solid rgba(74, 44, 17, 0.08); padding: 24px;">
	<div class="card-header-custom d-flex justify-content-between align-items-center mb-4" style="border-bottom: 1px solid #F0EBE1; padding-bottom: 16px;">
		<h5 class="mb-0" style="font-weight: 700; color: #2C1808;">
			<i class="bi bi-person-plus-fill text-success mr-2"></i> Form Tambah User
		</h5>
	</div>
	<div class="card-body-custom">
		<form method="post" action="<?= site_url('admin/user/add') ?>">
			<div class="form-group mb-3">
				<label for="nama" class="form-label" style="font-weight: 600; font-size: 0.85rem;">
					<i class="bi bi-person mr-1 text-muted"></i> Nama Lengkap
				</label>
				<input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama lengkap" required value="<?= set_value('nama') ?>" style="border-radius: 8px; height: 42px;" />
			</div>
			<div class="form-group mb-3">
				<label for="username" class="form-label" style="font-weight: 600; font-size: 0.85rem;">
					<i class="bi bi-at mr-1 text-muted"></i> Username
				</label>
				<input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username" required value="<?= set_value('username') ?>" style="border-radius: 8px; height: 42px;" />
			</div>
			<div class="form-group mb-3">
				<label for="no_telepon" class="form-label" style="font-weight: 600; font-size: 0.85rem;">
					<i class="bi bi-telephone mr-1 text-muted"></i> Nomor Telepon
				</label>
				<input type="tel" name="no_telepon" id="no_telepon" class="form-control" placeholder="0812345678" required value="<?= set_value('no_telepon') ?>" style="border-radius: 8px; height: 42px;" />
			</div>
			<div class="form-group mb-3">
				<label for="password" class="form-label" style="font-weight: 600; font-size: 0.85rem;">
					<i class="bi bi-lock mr-1 text-muted"></i> Password
				</label>
				<input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required style="border-radius: 8px; height: 42px;" />
			</div>
			<div class="form-group mb-4">
				<label for="role" class="form-label" style="font-weight: 600; font-size: 0.85rem;">
					<i class="bi bi-tag mr-1 text-muted"></i> Role
				</label>
				<select name="role" id="role" class="form-control" required style="border-radius: 8px; height: 42px;">
					<option value="">-- Pilih Role --</option>
					<option value="Admin" <?= set_value('role') === 'Admin' ? 'selected' : '' ?>>Admin</option>
					<option value="Petani" <?= set_value('role') === 'Petani' ? 'selected' : '' ?>>Petani</option>
					<option value="Pembeli" <?= set_value('role') === 'Pembeli' ? 'selected' : '' ?>>Pembeli</option>
					<option value="Guest" <?= set_value('role') === 'Guest' ? 'selected' : '' ?>>Guest</option>
				</select>
			</div>
			<div class="d-flex gap-2" style="gap: 10px;">
				<button type="submit" class="btn-custom-primary">
					<i class="bi bi-save mr-2"></i> Simpan
				</button>
				<a href="<?= site_url('admin/user') ?>" class="btn-custom-secondary">
					<i class="bi bi-arrow-left mr-2"></i> Batal
				</a>
			</div>
		</form>
	</div>
</div>
>>>>>>> c50a8c46b5d9744b96ff8d6c8a37c62a316dedd7
