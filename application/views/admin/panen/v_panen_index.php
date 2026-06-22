<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Panen - Admin</title>
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
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-cream); color: var(--dark-coffee); overflow-x: hidden; }
        .sidebar { width: var(--sidebar-width); height: 100vh; position: fixed; top: 0; left: 0; background: linear-gradient(180deg, var(--dark-coffee) 0%, #1a0e04 100%); color: var(--bg-cream); }
        .sidebar-brand { padding: 28px 24px 20px; font-size: 1.1rem; font-weight: 700; border-bottom: 1px solid rgba(250,246,240,0.08); color: var(--amber-cream); display: flex; align-items: center; gap: 10px; }
        .sidebar-brand .brand-icon { width: 40px; height: 40px; background: rgba(230, 161, 92, 0.15); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; }
        .sidebar-menu-wrapper { padding: 15px 0; }
        .sidebar-menu { list-style: none; margin: 0; padding: 0; }
        .menu-item a { display: flex; align-items: center; padding: 12px 24px; color: #A8988A; font-weight: 500; font-size: 0.9rem; text-decoration: none; margin: 2px 10px; border-radius: 10px; }
        .menu-item a i { font-size: 1.15rem; margin-right: 14px; width: 22px; text-align: center; }
        .menu-item.active a { background: rgba(230, 161, 92, 0.18); border-left: 3px solid var(--amber-cream); color: #fff; }
        
        .main-content { margin-left: var(--sidebar-width); padding: 30px 40px; }
        .page-header { border-bottom: 1px solid rgba(74,44,17,0.08); padding-bottom: 20px; margin-bottom: 30px; }
        .custom-card { background: var(--card-white); border: 1px solid rgba(74, 44, 17, 0.06); border-radius: 14px; box-shadow: 0 8px 30px rgba(44, 24, 8, 0.08); overflow: hidden; }
        .custom-card .card-header-custom { padding: 18px 24px; border-bottom: 1px solid rgba(74, 44, 17, 0.06); font-weight: 700; font-size: 0.9rem; }
        .custom-card .card-body-custom { padding: 24px; }
        
        .table-custom { font-size: 0.85rem; width: 100%; }
        .table-custom thead th { border-bottom: 2px solid rgba(74, 44, 17, 0.06); color: var(--text-secondary); font-weight: 600; font-size: 0.75rem; text-transform: uppercase; padding: 12px 10px; }
        .table-custom tbody td { padding: 12px 10px; border-bottom: 1px solid rgba(74, 44, 17, 0.04); vertical-align: middle; }
        .table-custom tbody tr:hover { background: rgba(250, 246, 240, 0.3); }
        .btn-custom { border-radius: 8px; font-size: 0.8rem; font-weight: 600; padding: 6px 14px; }
        .btn-custom-info { background-color: #DBEAFE; color: #1E40AF; border: none; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="bi bi-patch-check-fill"></i></div>
        <span>ADMIN <br><small style="font-weight:400; font-size:0.7rem; color:#A8988A;">Liberchain</small></span>
    </div>
    <div class="sidebar-menu-wrapper">
        <ul class="sidebar-menu">
            <li class="menu-item"><a href="<?= base_url('admin/dashboard'); ?>"><i class="bi bi-grid-1x2-fill"></i>Dashboard</a></li>
            <li class="menu-item active"><a href="<?= base_url('admin/panen'); ?>"><i class="bi bi-textarea-rose"></i>Rekap Panen</a></li>
        </ul>
    </div>
</div>

<div class="main-content">
    <div class="page-header d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <h2 class="mb-0">Rekap Hasil Panen</h2>
            <p class="subtitle mb-0 mt-1">Laporan rekapitulasi data panen dari seluruh petani (M04-F02).</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= base_url('admin/panen/export_excel?' . $_SERVER['QUERY_STRING']); ?>" class="btn btn-custom" style="background:#10b981; color:white;">
                <i class="bi bi-file-earmark-excel"></i> Export Excel
            </a>
            <button onclick="window.print()" class="btn btn-custom btn-secondary-custom">
                <i class="bi bi-printer"></i> Cetak/PDF
            </button>
        </div>
    </div>

    <!-- M04-F06: Filter Panen -->
    <div class="custom-card mb-4 d-print-none">
        <div class="card-body-custom" style="padding: 16px 24px;">
            <form method="GET" action="<?= base_url('admin/panen'); ?>" class="row align-items-end">
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
                    <button type="submit" class="btn btn-sm btn-custom btn-secondary-custom w-100 mt-2" style="background:#E5E7EB; color:#4B5563; border:none; border-radius:8px; padding:6px;">Terapkan Filter</button>
                </div>
            </form>
        </div>
    </div>

    <div class="custom-card">
        <div class="card-header-custom">
            <i class="bi bi-list-ul mr-2 text-warning"></i>Data Panen Semua Petani
        </div>
        <div class="card-body-custom">
            <div class="table-responsive">
                <table class="table table-custom">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Panen</th>
                            <th>Nama Petani</th>
                            <th>Lahan</th>
                            <th>Jumlah (Kg)</th>
                            <th>Kualitas</th>
                            <th class="text-center d-print-none">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($panen_list)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4">Belum ada data panen dari petani.</td>
                        </tr>
                        <?php else: ?>
                        <?php $no = 1; foreach ($panen_list as $p): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= date('d M Y', strtotime($p['tanggal_panen'])); ?></td>
                            <td class="font-weight-bold"><?= htmlspecialchars($p['nama_petani'] ?? 'Unknown Petani'); ?></td>
                            <td><?= htmlspecialchars($p['nama_lahan'] ?? '-'); ?></td>
                            <td class="text-success font-weight-bold"><?= number_format($p['jumlah_panen'], 0, ',', '.'); ?> Kg</td>
                            <td><span class="badge badge-light" style="font-size:0.75rem; border:1px solid #ccc;"><?= htmlspecialchars($p['kualitas'] ?? '-'); ?></span></td>
                            <td class="text-center d-print-none">
                                <a href="<?= base_url('admin/panen/detail/'.$p['id_panen']); ?>" class="btn btn-custom btn-custom-info" title="Detail">
                                    <i class="bi bi-eye"></i> Detail
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
</body>
</html>
