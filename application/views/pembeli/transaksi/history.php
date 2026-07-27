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

    /* STATISTIK MINI */
    .stat-box-mini {
        background: var(--card-white);
        border-radius: var(--radius-card);
        padding: 20px 24px;
        box-shadow: var(--shadow-soft);
        border: 1px solid rgba(74, 44, 17, 0.06);
        transition: var(--transition-smooth);
        height: 100%;
        position: relative;
        overflow: hidden;
    }
    .stat-box-mini:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-hover);
    }
    .stat-box-mini .label {
        font-size: 0.7rem;
        font-weight: 700;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.7px;
        margin-bottom: 6px;
    }
    .stat-box-mini .value {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--dark-coffee);
        line-height: 1.1;
    }

    /* CUSTOM CARD */
    .custom-card {
        background: var(--card-white);
        border-radius: var(--radius-card);
        border: 1px solid rgba(74, 44, 17, 0.06);
        box-shadow: var(--shadow-soft);
        overflow: hidden;
        margin-bottom: 24px;
    }
    .card-header-custom {
        padding: 18px 24px;
        border-bottom: 1px solid rgba(74, 44, 17, 0.06);
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: transparent;
    }
    .card-header-custom h6 {
        margin: 0;
        font-weight: 700;
        font-size: 0.85rem;
        color: var(--dark-coffee);
    }
    .card-body-custom {
        padding: 0;
    }

    /* FILTER SECTION (DIPERBAIKI AGAR TIDAK KETUTUP/TERPOTONG) */
    .filter-section {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        align-items: center;
        padding: 18px 24px;
    }
    .filter-section select, .filter-section input {
        border-radius: 10px;
        border: 1px solid rgba(74, 44, 17, 0.1);
        padding: 10px 14px;
        font-size: 0.85rem;
        background: var(--card-white);
        color: var(--dark-coffee);
        outline: none;
        height: 42px;
        line-height: normal;
        transition: var(--transition-smooth);
    }
    .filter-section select:focus, .filter-section input:focus {
        border-color: var(--amber-cream);
        box-shadow: 0 0 0 3px rgba(230, 161, 92, 0.15);
    }
    .btn-filter {
        background: var(--amber-cream);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 8px 20px;
        height: 42px;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: var(--transition-smooth);
    }
    .btn-filter:hover {
        background: var(--roasted-brown);
        transform: translateY(-1px);
    }
    .btn-outline-filter {
        background: transparent;
        color: var(--text-secondary);
        border: 1px solid rgba(74, 44, 17, 0.1);
        border-radius: 10px;
        padding: 8px 20px;
        height: 42px;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: var(--transition-smooth);
    }
    .btn-outline-filter:hover {
        background: var(--bg-cream);
        color: var(--dark-coffee);
    }

    /* TABEL CUSTOM */
    .table-custom {
        margin: 0;
        font-size: 0.85rem;
    }
    .table-custom thead th {
        border: none;
        border-bottom: 2px solid rgba(74, 44, 17, 0.06);
        color: var(--text-secondary);
        font-weight: 700;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 14px 20px;
        background: transparent;
    }
    .table-custom tbody td {
        padding: 14px 20px;
        vertical-align: middle;
        border-bottom: 1px solid rgba(74, 44, 17, 0.04);
        color: var(--dark-coffee);
    }
    .table-custom tbody tr:hover {
        background: rgba(250, 246, 240, 0.4);
    }

    /* STATUS BADGE */
    .status-badge {
        display: inline-block;
        padding: 5px 14px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 700;
    }
    .status-badge.complete, .status-badge.lunas { background: #D1FAE5; color: #065F46; }
    .status-badge.pending { background: #FEF3C7; color: #92400E; }
    .status-badge.processing { background: #DBEAFE; color: #1E40AF; }
    .status-badge.delivery, .status-badge.dikirim { background: #EDE9FE; color: #5B21B6; }
    .status-badge.cancelled, .status-badge.dibatalkan { background: #FEE2E2; color: #991B1B; }
    .status-badge.belum-bayar { background: #FEF3C7; color: #92400E; }

    /* TOMBOL DETAIL */
    .btn-detail {
        background: var(--amber-cream);
        color: white;
        border-radius: 8px;
        padding: 6px 14px;
        font-size: 0.75rem;
        font-weight: 600;
        border: none;
        transition: var(--transition-smooth);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .btn-detail:hover {
        background: var(--roasted-brown);
        color: white;
        text-decoration: none;
        transform: translateY(-1px);
    }
</style>

<!-- STATISTIK (4 KOTAK SEPERTI TAMPILAN LAMA) -->
<div class="row mb-4">
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="stat-box-mini" style="border-left: 4px solid var(--amber-cream);">
            <div class="label">Total Transaksi</div>
            <div class="value"><?= $total_transaksi ?? 0; ?></div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="stat-box-mini" style="border-left: 4px solid #10B981;">
            <div class="label">Selesai</div>
            <div class="value"><?= $total_selesai ?? 0; ?></div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="stat-box-mini" style="border-left: 4px solid #F59E0B;">
            <div class="label">Pending</div>
            <div class="value"><?= $total_pending ?? 0; ?></div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="stat-box-mini" style="border-left: 4px solid #EF4444;">
            <div class="label">Dibatalkan</div>
            <div class="value"><?= $total_batal ?? 0; ?></div>
        </div>
    </div>
</div>

<!-- FILTER SECTION -->
<div class="custom-card mb-4">
    <div class="filter-section">
        <select class="form-control-sm" id="filterStatus" style="width: auto; min-width: 150px;">
            <option value="">Semua Status</option>
            <option value="pending">Pending</option>
            <option value="processing">Diproses</option>
            <option value="delivery">Dikirim</option>
            <option value="complete">Selesai</option>
            <option value="cancelled">Dibatalkan</option>
        </select>
        <input type="date" class="form-control-sm" id="filterDateFrom">
        <span style="color: var(--text-secondary); font-size:0.85rem;">sampai</span>
        <input type="date" class="form-control-sm" id="filterDateTo">
        <button class="btn-filter" onclick="applyFilter()"><i class="bi bi-search mr-1"></i> Filter</button>
        <button class="btn-outline-filter" onclick="resetFilter()"><i class="bi bi-arrow-counterclockwise mr-1"></i> Reset</button>
    </div>
</div>

<!-- TABEL DAFTAR TRANSAKSI -->
<div class="custom-card">
    <div class="card-header-custom">
        <h6><i class="bi bi-clock-history text-primary mr-2"></i> Daftar Transaksi</h6>
        <span class="badge" style="background: var(--bg-cream); color: var(--text-secondary); font-weight:600; padding: 6px 14px; border-radius: 20px;">
            <?= $total_transaksi ?? 0; ?> transaksi
        </span>
    </div>
    <div class="card-body-custom">
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Tanggal</th>
                        <th>Produk</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Status Bayar</th>
                        <th style="text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($transaksi)): ?>
                        <?php foreach ($transaksi as $t): ?>
                        <tr>
                            <td><strong style="color: var(--dark-coffee);">#<?= $t['id_transaksi']; ?></strong></td>
                            <td style="color: var(--text-secondary); font-size:0.82rem;">
                                <?= isset($t['tanggal_transaksi']) ? date('d/m/Y H:i', strtotime($t['tanggal_transaksi'])) : date('d/m/Y H:i'); ?>
                            </td>
                            <td>
                                <?php 
                                $produk_list = $t['produk_list'] ?? '';
                                if (!empty($produk_list)) {
                                    $produk_array = explode(', ', $produk_list);
                                    if (count($produk_array) > 2) {
                                        echo htmlspecialchars(implode(', ', array_slice($produk_array, 0, 2))) . ' ...';
                                    } else {
                                        echo htmlspecialchars($produk_list);
                                    }
                                } else {
                                    echo '<span class="text-muted">-</span>';
                                }
                                ?>
                            </td>
                            <td style="font-weight:700; color: var(--dark-coffee);">
                                Rp <?= number_format($t['grand_total'] ?? $t['total_harga'] ?? 0, 0, ',', '.'); ?>
                            </td>
                            <td>
                                <?php
                                    $status_class = 'pending';
                                    $status_pesanan = $t['status_pesanan'] ?? 'Pending';
                                    if ($status_pesanan == 'Selesai' || $status_pesanan == 'Complete') $status_class = 'complete';
                                    elseif ($status_pesanan == 'Dikirim' || $status_pesanan == 'Shipped') $status_class = 'delivery';
                                    elseif ($status_pesanan == 'Diproses' || $status_pesanan == 'Processing') $status_class = 'processing';
                                    elseif ($status_pesanan == 'Dibatalkan' || $status_pesanan == 'Cancelled') $status_class = 'cancelled';
                                ?>
                                <span class="status-badge <?= $status_class; ?>">
                                    <?= ucfirst($status_pesanan); ?>
                                </span>
                            </td>
                            <td>
                                <?php
                                    $status_bayar = $t['status_bayar'] ?? 'Belum Bayar';
                                    $bayar_class = $status_bayar == 'Lunas' ? 'lunas' : 'belum-bayar';
                                ?>
                                <span class="status-badge <?= $bayar_class; ?>">
                                    <?= $status_bayar; ?>
                                </span>
                            </td>
                            <td style="text-align:center;">
                                <a href="<?= base_url('pembeli/transaksi/detail/' . $t['id_transaksi']); ?>" class="btn-detail">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">
                                <div class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox d-block mb-2" style="font-size: 2.5rem; color: #D1C9C0;"></i>
                                    <p class="small mb-0">Belum ada riwayat transaksi</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function applyFilter() {
        const status = document.getElementById('filterStatus').value;
        const dateFrom = document.getElementById('filterDateFrom').value;
        const dateTo = document.getElementById('filterDateTo').value;
        
        let url = window.location.href.split('?')[0];
        let params = [];
        if (status) params.push('status=' + status);
        if (dateFrom) params.push('date_from=' + dateFrom);
        if (dateTo) params.push('date_to=' + dateTo);
        if (params.length > 0) url += '?' + params.join('&');
        
        window.location.href = url;
    }

    function resetFilter() {
        window.location.href = window.location.href.split('?')[0];
    }

    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        const dateFrom = urlParams.get('date_from');
        const dateTo = urlParams.get('date_to');
        
        if (status) document.getElementById('filterStatus').value = status;
        if (dateFrom) document.getElementById('filterDateFrom').value = dateFrom;
        if (dateTo) document.getElementById('filterDateTo').value = dateTo;
    });
</script>