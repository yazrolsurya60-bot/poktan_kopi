<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Mitra - Sistem Supply Chain Kopi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --roasted-brown: #4A2C11;
            --dark-coffee: #2C1808;
            --amber-cream: #E6A15C;
            --bg-cream: #FAF6F0;
            --card-white: #FFFFFF;
            --text-secondary: #70655E;
            --sidebar-width: 260px;
            --shadow-soft: 0 8px 30px rgba(44, 24, 8, 0.08);
            --shadow-hover: 0 12px 40px rgba(44, 24, 8, 0.15);
            --radius-card: 14px;
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-cream);
            color: var(--dark-coffee);
            overflow-x: hidden;
        }

        /* --- SIDEBAR PREMIUM --- */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, var(--dark-coffee) 0%, #1a0e04 100%);
            color: var(--bg-cream);
            z-index: 100;
            transition: var(--transition-smooth);
            box-shadow: 4px 0 25px rgba(44, 24, 8, 0.2);
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            padding: 28px 24px 20px;
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            border-bottom: 1px solid rgba(250, 246, 240, 0.08);
            color: var(--amber-cream);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-brand .brand-icon {
            width: 40px;
            height: 40px;
            background: rgba(230, 161, 92, 0.15);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }

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
        }

        .custom-card .card-header-custom {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(74, 44, 17, 0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .custom-card .card-body-custom {
            padding: 24px;
        }

        /* --- TABLE STYLE --- */
        .table-custom {
            margin-bottom: 0;
            color: var(--dark-coffee);
            font-size: 0.85rem;
        }

        .table-custom thead th {
            border-bottom: 2px solid rgba(74, 44, 17, 0.1);
            border-top: none;
            color: var(--text-secondary);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.5px;
            padding: 12px 16px;
        }

        .table-custom tbody td {
            vertical-align: middle;
            border-bottom: 1px solid rgba(74, 44, 17, 0.04);
            padding: 16px;
            font-weight: 500;
        }

        .table-custom tbody tr {
            transition: var(--transition-smooth);
        }

        .table-custom tbody tr:hover {
            background-color: var(--bg-cream);
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .status-badge.active {
            background: rgba(16, 185, 129, 0.15);
            background: rgba(34, 197, 94, 0.1);
            color: #16a34a;
            border: 1px solid rgba(34, 197, 94, 0.2);
        }

        .status-badge.inactive {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .status-badge.active:hover { background: rgba(34, 197, 94, 0.2); box-shadow: 0 0 15px rgba(34, 197, 94, 0.2); }
        .status-badge.inactive:hover { background: rgba(239, 68, 68, 0.2); box-shadow: 0 0 15px rgba(239, 68, 68, 0.2); }

        .btn-action-group {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
        }

        .btn-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition-smooth);
            border: none;
            font-size: 1rem;
        }

        .btn-edit { background: rgba(230, 161, 92, 0.1); color: var(--amber-cream); }
        .btn-edit:hover { background: var(--amber-cream); color: white; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(230, 161, 92, 0.3); }

        .btn-delete { background: rgba(239, 68, 68, 0.1); color: #dc2626; }
        .btn-delete:hover { background: #dc2626; color: white; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(239, 68, 68, 0.3); }

        .urutan-input {
            text-align: center;
            font-weight: 700;
            color: var(--dark-coffee);
            background: rgba(250, 246, 240, 0.5);
            border: 1px solid rgba(230, 161, 92, 0.3);
            border-radius: 8px;
            transition: var(--transition-smooth);
        }

        .urutan-input:focus {
            background: white;
            border-color: var(--amber-cream);
            box-shadow: 0 0 0 3px rgba(230, 161, 92, 0.15);
        }
    </style>
</head>
<body>

    <!-- SIDEBAR OVERLAY -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebarMenu">
        <div class="sidebar-brand">
            <div class="brand-icon">
                <i class="bi bi-patch-check-fill"></i>
            </div>
            <span>POKTAN <br><small style="font-weight:400; font-size:0.7rem; color:#A8988A;">Liberchain</small></span>
        </div>
        <div class="sidebar-menu-wrapper">
            <ul class="sidebar-menu">
                <li class="menu-item">
                    <a href="<?= base_url('admin/dashboard'); ?>">
                        <i class="bi bi-grid-1x2-fill"></i>Dashboard
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('admin/user'); ?>">
                        <i class="bi bi-people-fill"></i>Manajemen User
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('admin/petani'); ?>">
                        <i class="bi bi-person-badge-fill"></i>Data Petani
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('admin/lahan'); ?>">
                        <i class="bi bi-map-fill"></i>Manajemen Lahan
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('admin/panen'); ?>">
                        <i class="bi bi-tree-fill"></i>Manajemen Panen
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('admin/produk'); ?>">
                        <i class="bi bi-box-seam-fill"></i>Manajemen Produk
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('admin/transaksi'); ?>">
                        <i class="bi bi-wallet2"></i>Transaksi
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('admin/kurir'); ?>">
                        <i class="bi bi-truck"></i>Manajemen Kurir
                    </a>
                </li>
                <li class="menu-item active">
                    <a href="<?= base_url('admin/mitra'); ?>">
                        <i class="bi bi-shop"></i>Manajemen Mitra
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('admin/laporan'); ?>">
                        <i class="bi bi-file-earmark-bar-graph-fill"></i>Laporan & Analytics
                    </a>
                </li>
            </ul>
        </div>
        <div class="sidebar-footer">
            <button class="btn-logout" onclick="window.location.href='<?= base_url('auth/logout'); ?>'">
                <i class="bi bi-box-arrow-right"></i> Keluar
            </button>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <!-- PAGE HEADER -->
        <div class="page-header d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle" style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
                    <i class="bi bi-list"></i>
                </button>
                <h2 class="d-inline-block align-middle mb-0">Manajemen Mitra</h2>
                <p class="subtitle mb-0 mt-1">Kelola data mitra dan urutan tampil di Landing Page</p>
            </div>
        </div>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-custom alert-success d-flex align-items-center">
                <i class="bi bi-check-circle-fill mr-3" style="font-size: 1.2rem;"></i>
                <div><?= $this->session->flashdata('success'); ?></div>
            </div>
        <?php endif; ?>

        <!-- CUSTOM CARD -->
        <div class="custom-card">
            <div class="card-header-custom">
                <h5 class="mb-0"><i class="bi bi-list-stars mr-2" style="color: var(--amber-cream);"></i> Daftar Mitra Terdaftar</h5>
                <!-- Filters -->
                <form action="<?= base_url('admin/mitra'); ?>" method="GET" class="form-inline mb-0">
                    <div class="input-group mr-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="background:transparent; border-right:none;"><i class="bi bi-search"></i></span>
                        </div>
                        <input type="text" name="search" class="form-control" placeholder="Cari mitra..." style="border-left:none;" value="<?= $this->input->get('search'); ?>">
                    </div>
                    <select name="kategori" class="form-control mr-2">
                        <option value="">Semua Kategori</option>
                        <?php foreach($kategori_list as $kat): ?>
                            <option value="<?= $kat; ?>" <?= ($this->input->get('kategori') == $kat) ? 'selected' : ''; ?>><?= $kat; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select name="status" class="form-control mr-2">
                        <option value="">Semua Status</option>
                        <option value="Active" <?= ($this->input->get('status') == 'Active') ? 'selected' : ''; ?>>Active</option>
                        <option value="Inactive" <?= ($this->input->get('status') == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                    </select>
                    <button type="submit" class="btn-custom-outline"><i class="bi bi-funnel"></i> Filter</button>
                </form>

                <a href="<?= base_url('admin/mitra/add'); ?>" class="btn-custom-primary">
                    <i class="bi bi-plus-lg"></i> Tambah Mitra Baru
                </a>
            </div>
            
            <div class="card-body-custom pt-3 pb-4">
                <div class="table-responsive">
                    <table class="table table-custom table-hover">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="10%">Logo</th>
                                <th width="25%">Nama Mitra</th>
                                <th width="15%">Kategori</th>
                                <th width="10%">Urutan</th>
                                <th width="15%">Status</th>
                                <th width="20%" class="text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($mitra)): ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4" style="color: var(--text-secondary);">
                                        <i class="bi bi-inbox-fill d-block mb-2" style="font-size: 2rem;"></i>
                                        Tidak ada data mitra ditemukan.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php $no=1; foreach($mitra as $m): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <img src="<?= base_url('assets/uploads/mitra/'.$m['logo_mitra']); ?>" alt="Logo" class="mitra-logo-thumb">
                                    </td>
                                    <td>
                                        <span class="d-block font-weight-bold"><?= htmlspecialchars($m['nama_mitra']); ?></span>
                                    </td>
                                    <td><?= htmlspecialchars($m['kategori_mitra']); ?></td>
                                    <td>
                                        <input type="number" class="form-control form-control-sm urutan-input" data-id="<?= $m['id_mitra']; ?>" value="<?= $m['urutan_tampil']; ?>" style="width: 70px; display: inline-block; padding: 4px 8px; height: auto;">
                                    </td>
                                    <td>
                                        <?php if($m['status_mitra'] == 'Active'): ?>
                                            <span class="status-badge active status-toggle" data-id="<?= $m['id_mitra']; ?>" title="Klik untuk nonaktifkan"><i class="bi bi-check-circle-fill"></i> Active</span>
                                        <?php else: ?>
                                            <span class="status-badge inactive status-toggle" data-id="<?= $m['id_mitra']; ?>" title="Klik untuk aktifkan"><i class="bi bi-x-circle-fill"></i> Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="btn-action-group">
                                            <a href="<?= base_url('admin/mitra/edit/'.$m['id_mitra']); ?>" class="btn-icon btn-edit" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="<?= base_url('admin/mitra/delete/'.$m['id_mitra']); ?>" class="btn-icon btn-delete" title="Hapus" onclick="return confirm('Yakin ingin menghapus mitra ini secara Soft Delete?');">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Sidebar Toggle
            $('#sidebarToggle').click(function() {
                $('#sidebarMenu').addClass('open');
                $('#sidebarOverlay').addClass('active');
            });

            $('#sidebarOverlay').click(function() {
                $('#sidebarMenu').removeClass('open');
                $(this).removeClass('active');
            });

            // Toggle Status via AJAX
            $('.status-toggle').click(function() {
                let id = $(this).data('id');
                let badge = $(this);
                
                $.ajax({
                    url: "<?= base_url('admin/mitra/toggle/') ?>" + id,
                    type: "POST",
                    dataType: "json",
                    success: function(res) {
                        if(res.success) {
                            if(badge.hasClass('active')) {
                                badge.removeClass('active').addClass('inactive').html('<i class="bi bi-x-circle"></i> Inactive');
                            } else {
                                badge.removeClass('inactive').addClass('active').html('<i class="bi bi-check2-circle"></i> Active');
                            }
                        }
                    }
                });
            });
            // Update Urutan via AJAX
            $('.urutan-input').change(function() {
                let id = $(this).data('id');
                let urutan = $(this).val();
                
                $.ajax({
                    url: "<?= base_url('admin/mitra/update_urutan/') ?>" + id,
                    type: "POST",
                    data: {urutan_tampil: urutan},
                    dataType: "json",
                    success: function(res) {
                        if(res.success) {
                            // Flash a small green background to indicate success
                            $('.urutan-input[data-id="'+id+'"]').css('background-color', '#d4edda');
                            setTimeout(() => {
                                $('.urutan-input[data-id="'+id+'"]').css('background-color', '');
                            }, 1000);
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
