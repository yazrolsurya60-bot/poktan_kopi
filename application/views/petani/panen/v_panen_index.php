<style>
    .custom-card { border-radius: 14px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.05); overflow: hidden; background: #fff; }
    .card-header-custom { padding: 18px 24px; border-bottom: 1px solid rgba(74, 44, 17, 0.06); font-weight: 700; color: #2C1808; font-size: 0.95rem; }
    .card-body-custom { padding: 24px; }
    
    .table-custom { font-size: 0.85rem; width: 100%; margin-bottom: 0; }
    .table-custom thead th { border-bottom: 2px solid rgba(74, 44, 17, 0.06); color: #70655E; font-weight: 600; text-transform: uppercase; padding: 12px; }
    .table-custom tbody td { padding: 12px; border-bottom: 1px solid rgba(74, 44, 17, 0.04); vertical-align: middle; }
    .table-custom tbody tr:hover { background: rgba(250, 246, 240, 0.5); }
    
    .btn-custom { border-radius: 8px; font-size: 0.85rem; font-weight: 600; padding: 8px 16px; }
</style>

<!-- KONTEN UTAMA -->
<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert" style="border-radius: 10px;">
        <i class="bi bi-check-circle-fill mr-1"></i> <?= $this->session->flashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<!-- M04-F07: Grafik Statistik Panen -->
<div class="custom-card mb-4 d-print-none">
    <div class="card-header-custom">
        <i class="bi bi-graph-up mr-2 text-warning"></i> Statistik Panen (6 Bulan Terakhir)
    </div>
    <div class="card-body-custom">
        <div style="height: 250px; width: 100%;">
            <canvas id="panenChart"></canvas>
        </div>
    </div>
</div>

<div class="d-flex justify-content-end mb-3 gap-2 d-print-none">
    <a href="<?= base_url('petani/panen/tambah'); ?>" class="btn btn-custom text-white" style="background-color: #E6A15C;">
        <i class="bi bi-plus-lg"></i> Tambah Panen
    </a>
</div>

<div class="custom-card">
    <div class="card-header-custom">
        <i class="bi bi-list-ul mr-2 text-warning"></i> Daftar Hasil Panen
    </div>
    <div class="card-body-custom p-0">
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th>Tanggal Panen</th>
                        <th>Lahan</th>
                        <th>Jumlah (Kg)</th>
                        <th>Kualitas</th>
                        <th class="text-center d-print-none" width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($panen_list)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-folder-x" style="font-size: 2rem;"></i><br>
                                Belum ada data panen dicatat.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($panen_list as $p): ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="font-weight-bold text-dark"><?= date('d M Y', strtotime($p['tanggal_panen'])); ?></td>
                                <td><?= htmlspecialchars($p['nama_lahan'] ?? '-'); ?></td>
                                <td class="font-weight-bold text-success"><?= number_format($p['jumlah_panen'], 0, ',', '.'); ?> Kg</td>
                                <td><span class="badge border text-dark py-1 px-2" style="background: #f8f9fa; font-size:0.75rem; font-weight:500;"><?= htmlspecialchars($p['kualitas'] ?? '-'); ?></span></td>
                                <td class="text-center d-print-none">
                                    <a href="<?= base_url('petani/panen/detail/' . $p['id_panen']); ?>" class="btn btn-sm btn-info text-white" style="border-radius:6px;" title="Detail"><i class="bi bi-eye"></i></a>
                                    <a href="<?= base_url('petani/panen/edit/' . $p['id_panen']); ?>" class="btn btn-sm btn-warning text-white" style="border-radius:6px;" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <a href="<?= base_url('petani/panen/hapus/' . $p['id_panen']); ?>" class="btn btn-sm btn-danger text-white" style="border-radius:6px;" title="Hapus" onclick="return confirm('Hapus data panen ini?')"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Muat library Chart.js Khusus Halaman Ini -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
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