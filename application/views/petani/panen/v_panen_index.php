<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Panen - Petani</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* ... existing styles ... */
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
        /* Sidebar Styles (sama dengan dashboard) */
        .sidebar { width: var(--sidebar-width); height: 100vh; position: fixed; top: 0; left: 0; background: linear-gradient(180deg, var(--dark-coffee) 0%, #1a0e04 100%); color: var(--bg-cream); z-index: 100; transition: var(--transition-smooth); box-shadow: 4px 0 25px rgba(44,24,8,0.2); display: flex; flex-direction: column; }
        .sidebar-brand { padding: 28px 24px 20px; font-size: 1.1rem; font-weight: 700; border-bottom: 1px solid rgba(250,246,240,0.08); color: var(--amber-cream); display: flex; align-items: center; gap: 10px; }
        .sidebar-brand .brand-icon { width: 40px; height: 40px; background: rgba(230, 161, 92, 0.15); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; }
        .sidebar-menu-wrapper { flex: 1; overflow-y: auto; padding: 15px 0; }
        .sidebar-menu { list-style: none; margin: 0; padding: 0; }
        .menu-item a { display: flex; align-items: center; padding: 12px 24px; color: #A8988A; font-weight: 500; font-size: 0.9rem; text-decoration: none; transition: var(--transition-smooth); position: relative; margin: 2px 10px; border-radius: 10px; }
        .menu-item a i { font-size: 1.15rem; margin-right: 14px; width: 22px; text-align: center; }
        .menu-item.active a, .menu-item a:hover { color: #ffffff; background: rgba(230, 161, 92, 0.12); }
        .menu-item.active a { background: rgba(230, 161, 92, 0.18); border-left: 3px solid var(--amber-cream); }
        .menu-item.active a::before { content: ''; position: absolute; left: 0; top: 50%; transform: translateY(-50%); width: 3px; height: 24px; background: var(--amber-cream); border-radius: 0 3px 3px 0; }
        .sidebar-footer { padding: 16px 20px; border-top: 1px solid rgba(250, 246, 240, 0.06); margin-top: auto; }
        .sidebar-footer .btn-logout { width: 100%; padding: 10px 16px; border: 1px solid rgba(250, 246, 240, 0.1); border-radius: 10px; background: transparent; color: #A8988A; font-weight: 500; font-size: 0.85rem; transition: var(--transition-smooth); display: flex; align-items: center; justify-content: center; gap: 10px; cursor: pointer; }
        .sidebar-footer .btn-logout:hover { background: rgba(230, 161, 92, 0.1); color: #ffffff; border-color: rgba(230, 161, 92, 0.2); }
        .main-content { margin-left: var(--sidebar-width); padding: 30px 40px 40px; min-height: 100vh; transition: var(--transition-smooth); }
        .page-header { border-bottom: 1px solid rgba(74,44,17,0.08); padding-bottom: 20px; margin-bottom: 30px; }
        .page-header h2 { font-weight: 700; color: var(--dark-coffee); letter-spacing: -0.02em; }
        .page-header .subtitle { color: var(--text-secondary); font-size: 0.9rem; margin-top: 2px; }
        
        .custom-card { background: var(--card-white); border: 1px solid rgba(74, 44, 17, 0.06); border-radius: var(--radius-card); box-shadow: var(--shadow-soft); }
        .custom-card .card-header-custom { padding: 18px 24px; border-bottom: 1px solid rgba(74, 44, 17, 0.06); display: flex; align-items: center; justify-content: space-between; }
        .custom-card .card-body-custom { padding: 24px; }
        
        .table-custom { font-size: 0.85rem; width: 100%; }
        .table-custom thead th { border-bottom: 2px solid rgba(74, 44, 17, 0.06); color: var(--text-secondary); font-weight: 600; font-size: 0.75rem; text-transform: uppercase; padding: 12px 10px; }
        .table-custom tbody td { padding: 12px 10px; border-bottom: 1px solid rgba(74, 44, 17, 0.04); vertical-align: middle; }
        .table-custom tbody tr:hover { background: rgba(250, 246, 240, 0.3); }

        .btn-custom { border-radius: 8px; font-size: 0.8rem; font-weight: 600; padding: 6px 14px; transition: var(--transition-smooth); }
        .btn-custom-primary { background-color: var(--amber-cream); color: white; border: none; }
        .btn-custom-primary:hover { background-color: #d18d48; color: white; }
        .btn-custom-info { background-color: #DBEAFE; color: #1E40AF; border: none; }
        .btn-custom-warning { background-color: #FEF3C7; color: #92400E; border: none; }
        .btn-custom-danger { background-color: #FEE2E2; color: #991B1B; border: none; }
        /* SCROLLBAR */
        .sidebar-menu-wrapper::-webkit-scrollbar { width: 3px; }
        .sidebar-menu-wrapper::-webkit-scrollbar-track { background: transparent; }
        .sidebar-menu-wrapper::-webkit-scrollbar-thumb { background: rgba(230, 161, 92, 0.3); border-radius: 10px; }
    </style>
</head>
<body>

<div class="sidebar" id="sidebarMenu">
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="bi bi-patch-check-fill"></i></div>
        <span>PETANI <br><small style="font-weight:400; font-size:0.7rem; color:#A8988A;">Liberchain</small></span>
    </div>
    <div class="sidebar-menu-wrapper">
        <ul class="sidebar-menu">
            <li class="menu-item">
                <a href="<?= base_url('petani/dashboard'); ?>">
                    <i class="bi bi-grid-1x2-fill"></i>Dashboard
                </a>
            </li>
            <li class="menu-item">
                <a href="<?= base_url('petani/lahan'); ?>">
                    <i class="bi bi-geo-alt-fill"></i>Kelola Lahan
                    <span class="menu-badge" style="margin-left: auto; background: rgba(230, 161, 92, 0.2); color: #E6A15C; font-size: 0.7rem; padding: 2px 10px; border-radius: 20px; font-weight: 600;">3</span>
                </a>
            </li>
            <li class="menu-item active">
                <a href="<?= base_url('petani/panen'); ?>">
                    <i class="bi bi-tree-fill"></i>Manajemen Panen
                </a>
            </li>
            <li class="menu-item">
                <a href="<?= base_url('petani/produk'); ?>">
                    <i class="bi bi-box-seam"></i>Katalog Produk
                    <span class="menu-badge" style="margin-left: auto; background: rgba(230, 161, 92, 0.2); color: #E6A15C; font-size: 0.7rem; padding: 2px 10px; border-radius: 20px; font-weight: 600;">5</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="<?= base_url('petani/transaksi'); ?>">
                    <i class="bi bi-cart-check-fill"></i>Pesanan Masuk
                    <span class="menu-badge" style="margin-left: auto; background: rgba(230, 161, 92, 0.2); color: #E6A15C; font-size: 0.7rem; padding: 2px 10px; border-radius: 20px; font-weight: 600;">8</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="<?= base_url('petani/tracking'); ?>">
                    <i class="bi bi-truck"></i>Tracking Kiriman
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

<div class="main-content">
    <div class="page-header d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <h2 class="d-inline-block align-middle mb-0">Manajemen Panen</h2>
            <p class="subtitle mb-0 mt-1">Kelola data hasil panen kopi Anda (M04-F02).</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= base_url('petani/panen/export_excel?' . $_SERVER['QUERY_STRING']); ?>" class="btn btn-custom" style="background:#10b981; color:white;">
                <i class="bi bi-file-earmark-excel"></i> Export Excel
            </a>
            <button onclick="window.print()" class="btn btn-custom btn-secondary-custom">
                <i class="bi bi-printer"></i> Cetak/PDF
            </button>
            <a href="<?= base_url('petani/panen/tambah'); ?>" class="btn btn-custom btn-custom-primary ml-2">
                <i class="bi bi-plus-lg"></i> Tambah Panen
            </a>
        </div>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px;">
        <?= $this->session->flashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>

    <!-- M04-F07: Grafik Statistik Panen -->
    <div class="custom-card mb-4 d-print-none">
        <div class="card-header-custom">
            <h6><i class="bi bi-graph-up mr-2 text-warning"></i>Statistik Panen (6 Bulan Terakhir)</h6>
        </div>
        <div class="card-body-custom">
            <div style="height: 250px; width: 100%;">
                <canvas id="panenChart"></canvas>
            </div>
        </div>
    </div>

    <!-- M04-F06: Filter Panen -->
    <div class="custom-card mb-4 d-print-none">
        <div class="card-body-custom" style="padding: 16px 24px;">
            <form method="GET" action="<?= base_url('petani/panen'); ?>" class="row align-items-end">
                <div class="col-md-3">
                    <label style="font-size:0.75rem; color:var(--text-secondary);">Mulai Tanggal</label>
                    <input type="date" name="start_date" class="form-control form-control-sm" value="<?= $this->input->get('start_date'); ?>">
                </div>
                <div class="col-md-3">
                    <label style="font-size:0.75rem; color:var(--text-secondary);">Sampai Tanggal</label>
                    <input type="date" name="end_date" class="form-control form-control-sm" value="<?= $this->input->get('end_date'); ?>">
                </div>
                <div class="col-md-3">
                    <label style="font-size:0.75rem; color:var(--text-secondary);">Kualitas</label>
                    <input type="text" name="kualitas" class="form-control form-control-sm" placeholder="Contoh: Grade A" value="<?= $this->input->get('kualitas'); ?>">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-sm btn-custom btn-secondary-custom w-100 mt-2">Terapkan Filter</button>
                </div>
            </form>
        </div>
    </div>

    <div class="custom-card">
        <div class="card-header-custom">
            <h6><i class="bi bi-list-ul mr-2 text-warning"></i>Daftar Hasil Panen</h6>
        </div>
        <div class="card-body-custom">
            <div class="table-responsive">
                <table class="table table-custom">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Panen</th>
                            <th>Lahan</th>
                            <th>Jumlah (Kg)</th>
                            <th>Kualitas</th>
                            <th class="text-center d-print-none">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($panen_list)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4">Belum ada data panen dicatat.</td>
                        </tr>
                        <?php else: ?>
                        <?php $no = 1; foreach ($panen_list as $p): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= date('d M Y', strtotime($p['tanggal_panen'])); ?></td>
                            <td><?= htmlspecialchars($p['nama_lahan'] ?? '-'); ?></td>
                            <td class="font-weight-bold"><?= number_format($p['jumlah_panen'], 0, ',', '.'); ?> Kg</td>
                            <td><span class="badge badge-light" style="font-size:0.75rem; border:1px solid #ccc;"><?= htmlspecialchars($p['kualitas'] ?? '-'); ?></span></td>
                            <td class="text-center d-print-none">
                                <a href="<?= base_url('petani/panen/detail/'.$p['id_panen']); ?>" class="btn btn-custom btn-custom-info" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?= base_url('petani/panen/edit/'.$p['id_panen']); ?>" class="btn btn-custom btn-custom-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="<?= base_url('petani/panen/hapus/'.$p['id_panen']); ?>" class="btn btn-custom btn-custom-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data panen ini?');">
                                    <i class="bi bi-trash"></i>
                                </a>
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

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Data Statistik Panen dari PHP
        const statsData = <?= json_encode($statistik ?? []); ?>;
        const labels = statsData.map(item => item.bulan);
        const dataValues = statsData.map(item => item.total_panen);

        const ctx = document.getElementById('panenChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Panen (Kg)',
                        data: dataValues,
                        backgroundColor: '#E6A15C',
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, title: { display: true, text: 'Kilogram (Kg)' } }
                    }
                }
            });
        }
    });
</script>
</body>
</html>

