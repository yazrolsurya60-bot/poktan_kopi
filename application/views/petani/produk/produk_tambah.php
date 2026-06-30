<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk Kopi - Petani</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        :root {
            --roasted-brown: #4A2C11;
            --dark-coffee: #2C1808;
            --amber-cream: #E6A15C;
            --bg-cream: #FAF6F0;
            --card-white: #FFFFFF;
            --text-secondary: #70655E;
            --sidebar-width: 260px;
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-cream);
            color: var(--dark-coffee);
            overflow-x: hidden;
        }

        /* --- SIDEBAR --- */
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
            text-decoration: none;
            transition: var(--transition-smooth);
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

        .menu-item a:hover {
            color: #ffffff;
            background: rgba(230, 161, 92, 0.12);
            text-decoration: none;
        }

        .menu-item.active a {
            color: #ffffff;
            background: rgba(230, 161, 92, 0.18);
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
            text-decoration: none;
        }

        /* --- KONTEN UTAMA --- */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 30px 40px 40px;
            min-height: 100vh;
        }

        .page-header {
            border-bottom: 1px solid rgba(74, 44, 17, 0.08);
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .custom-card {
            background: var(--card-white);
            border: 1px solid rgba(74, 44, 17, 0.06);
            border-radius: 14px;
            box-shadow: 0 8px 30px rgba(44, 24, 8, 0.08);
        }

        .card-header-custom {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(74, 44, 17, 0.06);
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--dark-coffee);
        }

        .card-body-custom {
            padding: 24px;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid rgba(74, 44, 17, 0.2);
            padding: 10px 15px;
            font-size: 0.9rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--amber-cream);
            box-shadow: 0 0 0 0.2rem rgba(230, 161, 92, 0.25);
        }

        .btn-custom {
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            padding: 10px 24px;
            border: none;
            transition: var(--transition-smooth);
        }

        .btn-primary-custom {
            background-color: var(--amber-cream);
            color: white;
        }

        .btn-primary-custom:hover {
            background-color: #d18d48;
            color: white;
        }

        .btn-secondary-custom {
            background-color: #E5E7EB;
            color: #4B5563;
        }

        .btn-secondary-custom:hover {
            background-color: #D1D5DB;
            color: #374151;
        }

        label {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--text-secondary);
            margin-bottom: 8px;
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

    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebarMenu">
        <div class="sidebar-brand">
            <div class="brand-icon">
                <i class="bi bi-patch-check-fill"></i>
            </div>
            <span>PETANI <br><small style="font-weight:400; font-size:0.7rem; color:#A8988A;">Liberchain</small></span>
        </div>

        <div class="sidebar-menu-wrapper">
            <ul class="sidebar-menu">
                <li
                    class="menu-item <?= ($this->uri->segment(2) == 'dashboard' || $this->uri->segment(2) == '') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/dashboard'); ?>">
                        <i class="bi bi-grid-1x2-fill"></i> Dashboard
                    </a>
                </li>
                <li class="menu-item <?= ($this->uri->segment(2) == 'lahan') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/lahan'); ?>">
                        <i class="bi bi-geo-alt-fill"></i> Kelola Lahan
                    </a>
                </li>
                <li class="menu-item <?= ($this->uri->segment(2) == 'panen') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/panen'); ?>">
                        <i class="bi bi-tree-fill"></i> Manajemen Panen
                    </a>
                </li>
                <li class="menu-item <?= ($this->uri->segment(2) == 'produk') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/produk'); ?>">
                        <i class="bi bi-box-seam"></i> Katalog Produk
                    </a>
                </li>
                <li class="menu-item <?= ($this->uri->segment(2) == 'transaksi') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/transaksi'); ?>">
                        <i class="bi bi-cart-check-fill"></i> Pesanan Masuk
                    </a>
                </li>
                <li class="menu-item <?= ($this->uri->segment(2) == 'tracking') ? 'active' : ''; ?>">
                    <a href="<?= base_url('petani/tracking'); ?>">
                        <i class="bi bi-truck"></i> Tracking Kiriman
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
        <div class="page-header">
            <h2 class="font-weight-bold text-dark mb-1">Tambah Produk Baru</h2>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Silakan lengkapi spesifikasi produk komoditas kopi
                untuk ditambahkan ke katalog.</p>
        </div>

        <div class="custom-card">
            <div class="card-body-custom">
                <form action="<?= base_url('petani/produk/simpan'); ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label>Nama Produk</label>
                                <input type="text" name="nama_produk" class="form-control"
                                    placeholder="Contoh: Biji Kopi Arabica Organik" required>
                            </div>

                            <div class="form-group mb-4">
                                <label>Jenis Kopi</label>
                                <select name="jenis_kopi" class="form-control" required>
                                    <option value="">-- Pilih Jenis Kopi --</option>
                                    <option value="Arabica">Arabica</option>
                                    <option value="Robusta">Robusta</option>
                                    <option value="Liberica">Liberica</option>
                                </select>
                            </div>

                            <div class="form-group mb-4">
                                <label>Grade</label>
                                <select name="grade" class="form-control" required>
                                    <option value="">-- Pilih Grade --</option>
                                    <option value="A">Grade A</option>
                                    <option value="AA">Grade AA</option>
                                    <option value="B">Grade B</option>
                                    <option value="C">Grade C</option>
                                </select>
                            </div>

                            <div class="form-group mb-4">
                                <label>Harga (Rp) / Kg</label>
                                <input type="number" name="harga" class="form-control" placeholder="Contoh: 120000"
                                    required>
                            </div>

                            <div class="form-group mb-4">
                                <label>Stok Ketersediaan (Kg)</label>
                                <input type="number" name="stok_produk" class="form-control" placeholder="Contoh: 50"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label>Altitude (Ketinggian Tanam)</label>
                                <input type="text" name="altitude" class="form-control"
                                    placeholder="Contoh: 1200 - 1500 mdpl">
                            </div>

                            <div class="form-group mb-4">
                                <label>Proses Pengolahan</label>
                                <input type="text" name="proses" class="form-control"
                                    placeholder="Contoh: Full Washed, Natural, Honey">
                            </div>

                            <div class="form-group mb-4">
                                <label>Flavor Notes (Catatan Rasa)</label>
                                <textarea class="form-control" rows="2" name="flavor_notes"
                                    placeholder="Contoh: Fruity, Chocolatey, Nutty..."></textarea>
                            </div>

                            <div class="form-group mb-4">
                                <label>Deskripsi Tambahan</label>
                                <textarea class="form-control" rows="3" name="deskripsi"
                                    placeholder="Tuliskan deskripsi lengkap produk kopi Anda..."></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label>Status Produk</label>
                                        <select name="status_produk" class="form-control">
                                            <option value="Tersedia">Tersedia</option>
                                            <option value="Habis">Habis</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label>Foto Produk (Opsional)</label>
                                        <input type="file" name="foto_utama" class="form-control p-1"
                                            accept=".jpg,.jpeg,.png">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-right mt-4 pt-3 border-top">
                        <a href="<?= base_url('petani/produk'); ?>" class="btn btn-secondary-custom mr-2">Batal</a>
                        <button type="submit" class="btn btn-primary-custom">
                            <i class="bi bi-save mr-1"></i> Simpan Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>