<style>
    :root {
        --roasted-brown: #4A2C11;
        --dark-coffee: #2C1808;
        --amber-cream: #E6A15C;
        --bg-cream: #FAF6F0;
        --card-white: #FFFFFF;
        --text-secondary: #70655E;
        --shadow-soft: 0 8px 30px rgba(44, 24, 8, 0.08);
        --radius-card: 14px;
    }

    .custom-card { background: var(--card-white); border-radius: var(--radius-card); box-shadow: var(--shadow-soft); overflow: hidden; border: 1px solid rgba(74,44,17,0.06); }
    .custom-card .card-header-custom { padding: 16px 24px; border-bottom: 1px solid rgba(74,44,17,0.06); display: flex; align-items: center; justify-content: space-between; background: rgba(250,246,240,0.3); }
    .custom-card .card-header-custom h6 { font-weight: 700; margin: 0; font-size: 0.9rem; }

    .table-custom { font-size: 0.85rem; margin-bottom: 0; width: 100%;}
    .table-custom thead th { background: rgba(250,246,240,0.4); border-bottom: 2px solid rgba(74,44,17,0.06); color: var(--text-secondary); font-weight: 600; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 10px; }
    .table-custom tbody td { padding: 12px 10px; border-bottom: 1px solid rgba(74,44,17,0.04); vertical-align: middle; }

    .status-badge { padding: 4px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: 600; display: inline-block; }
    .status-badge.pending { background: #FEF3C7; color: #92400E; }
    .status-badge.complete { background: #D1FAE5; color: #065F46; }
    .status-badge.cancelled { background: #FEE2E2; color: #991B1B; }

    .btn-verifikasi { background: #10B981; color: white; border: none; border-radius: 8px; padding: 6px 16px; font-weight: 600; font-size: 0.75rem; transition: all 0.3s ease; }
    .btn-verifikasi:hover { background: #059669; color: white; }
    .btn-tolak { background: #EF4444; color: white; border: none; border-radius: 8px; padding: 6px 16px; font-weight: 600; font-size: 0.75rem; transition: all 0.3s ease; }
    .btn-tolak:hover { background: #DC2626; color: white; }
    .fade-in { animation: fadeInUp 0.6s ease forwards; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
</style>

<div class="d-flex justify-content-end mb-3">
    <a href="<?= base_url('admin/transaksi'); ?>" class="btn btn-outline-secondary" style="border-radius:10px; font-size:0.85rem;">
        <i class="bi bi-arrow-left mr-1"></i> Kembali ke Transaksi
    </a>
</div>

<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show"><?= $this->session->flashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show"><?= $this->session->flashdata('error'); ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
<?php endif; ?>

<!-- STATISTIK -->
<div class="row mb-4 fade-in">
    <div class="col-md-3 col-6 mb-2">
        <div class="custom-card" style="border-left: 4px solid #F59E0B;">
            <div class="card-body p-3">
                <div style="font-size:0.7rem; color:var(--text-secondary); text-transform:uppercase;">Menunggu</div>
                <div style="font-size:1.5rem; font-weight:700; color:var(--dark-coffee);"><?= $count_menunggu ?? 0; ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6 mb-2">
        <div class="custom-card" style="border-left: 4px solid #10B981;">
            <div class="card-body p-3">
                <div style="font-size:0.7rem; color:var(--text-secondary); text-transform:uppercase;">Diverifikasi</div>
                <div style="font-size:1.5rem; font-weight:700; color:var(--dark-coffee);">0</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6 mb-2">
        <div class="custom-card" style="border-left: 4px solid #EF4444;">
            <div class="card-body p-3">
                <div style="font-size:0.7rem; color:var(--text-secondary); text-transform:uppercase;">Ditolak</div>
                <div style="font-size:1.5rem; font-weight:700; color:var(--dark-coffee);">0</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6 mb-2">
        <div class="custom-card" style="border-left: 4px solid var(--amber-cream);">
            <div class="card-body p-3">
                <div style="font-size:0.7rem; color:var(--text-secondary); text-transform:uppercase;">Total</div>
                <div style="font-size:1.5rem; font-weight:700; color:var(--dark-coffee);"><?= $count_menunggu ?? 0; ?></div>
            </div>
        </div>
    </div>
</div>

<!-- TABEL BUKTI -->
<div class="custom-card fade-in">
    <div class="card-header-custom">
        <h6 class="mb-0"><i class="bi bi-receipt mr-2"></i> Bukti Pembayaran Menunggu Verifikasi</h6>
        <span class="badge" style="background:var(--bg-cream); color:var(--text-secondary); font-weight:500;"><?= $count_menunggu ?? 0; ?> menunggu</span>
    </div>
    <div class="card-body p-0">
        <?php if (empty($transaksi_pending)): ?>
            <div class="text-center py-5 text-muted">
                <i class="bi bi-check2-circle" style="font-size:3rem; display:block; opacity:0.3;"></i>
                <h6 style="font-weight:600;">Semua Sudah Diverifikasi</h6>
                <p style="font-size:0.85rem;">Tidak ada bukti pembayaran yang menunggu konfirmasi.</p>
            </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th>ID / Tgl</th>
                        <th>Pembeli</th>
                        <th>Detail Pembayaran</th>
                        <th>Bukti</th>
                        <th>Grand Total</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transaksi_pending as $t): ?>
                    <tr>
                        <td>
                            <div style="font-weight:700;">#<?= $t['id_transaksi']; ?></div>
                            <div style="font-size:0.75rem; color:var(--text-secondary);"><?= date('d/m/Y H:i', strtotime($t['tanggal_transaksi'])); ?></div>
                            <?php 
                            $metode = $t['metode_bayar'] ?? 'Transfer';
                            if ($metode == 'Transfer Bank' || $metode == 'Transfer') {
                                $metode = 'Virtual Account';
                            }
                            ?>
                            <span class="status-badge pending" style="font-size:0.65rem;"><?= $metode; ?></span>
                        </td>
                        <td>
                            <div style="font-weight:600;"><?= $t['nama_pembeli'] ?? 'Guest'; ?></div>
                        </td>
                        <td style="font-size:0.82rem;">
                            <div><i class="bi bi-bank mr-1" style="color:var(--amber-cream);"></i><?= $t['nama_bank'] ?? '-'; ?></div>
                            <div><i class="bi bi-person mr-1" style="color:var(--amber-cream);"></i><?= $t['nama_pengirim'] ?? '-'; ?></div>
                            <div style="font-weight:700; color:var(--roasted-brown);">Rp <?= number_format($t['jumlah_transfer'] ?? 0, 0, ',', '.'); ?></div>
                        </td>
                        <td>
                            <?php if ($t['file_bukti']): ?>
                                <a href="<?= base_url('uploads/bukti/' . $t['file_bukti']); ?>" target="_blank">
                                    <img src="<?= base_url('uploads/bukti/' . $t['file_bukti']); ?>"
                                         style="width:52px; height:52px; object-fit:cover; border-radius:8px; border:2px solid rgba(74,44,17,0.1); cursor:pointer;"
                                         alt="Bukti Bayar">
                                </a>
                            <?php else: ?>
                                <span style="color:var(--text-secondary); font-size:0.78rem;">Belum upload</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div style="font-weight:800; color:var(--roasted-brown); font-size:0.95rem;">Rp <?= number_format($t['grand_total'] ?? 0, 0, ',', '.'); ?></div>
                            <span class="status-badge pending" style="font-size:0.65rem;"><?= $t['status_verifikasi'] ?? 'Pending'; ?></span>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-verifikasi mb-1 w-100"
                                    data-toggle="modal" data-target="#modalVerif"
                                    data-id="<?= $t['id_transaksi']; ?>" data-action="Diverifikasi">
                                <i class="bi bi-check-lg mr-1"></i> Verifikasi
                            </button>
                            <button class="btn btn-sm btn-tolak w-100"
                                    data-toggle="modal" data-target="#modalVerif"
                                    data-id="<?= $t['id_transaksi']; ?>" data-action="Ditolak">
                                <i class="bi bi-x-lg mr-1"></i> Tolak
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- MODAL VERIFIKASI -->
<div class="modal fade" id="modalVerif" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius:16px; border:none; box-shadow:0 20px 60px rgba(44,24,8,0.2);">
            <div class="modal-header" style="border-bottom:none; padding-bottom:0;">
                <h5 class="modal-title" style="font-weight:700;" id="modalVerifTitle">Konfirmasi Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?= base_url('admin/transaksi/konfirmasi_bayar'); ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id_transaksi" id="modal_id">
                    <input type="hidden" name="status" id="modal_status">
                    <p id="modal_desc" style="color:var(--text-secondary); font-size:0.9rem;"></p>
                    <div class="form-group">
                        <label style="font-weight:600; font-size:0.85rem;">Keterangan (opsional)</label>
                        <textarea name="keterangan" class="form-control" rows="3"
                                  placeholder="Tambahkan keterangan jika perlu..."
                                  style="border-radius:10px; border:2px solid rgba(74,44,17,0.15);"></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="border-top:none; padding-top:0;">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" style="border-radius:8px;">Batal</button>
                    <button type="submit" id="modal_btn" class="btn btn-success" style="border-radius:8px; font-weight:600;">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#modalVerif').on('show.bs.modal', function(e) {
            var btn = $(e.relatedTarget);
            var id = btn.data('id');
            var action = btn.data('action');
            $('#modal_id').val(id);
            $('#modal_status').val(action);
            if (action === 'Diverifikasi') {
                $('#modalVerifTitle').text('✅ Verifikasi Pembayaran');
                $('#modal_desc').text('Transaksi #' + id + ' akan ditandai LUNAS dan pesanan berubah ke Diproses.');
                $('#modal_btn').removeClass('btn-danger').addClass('btn-success').text('Ya, Verifikasi');
            } else {
                $('#modalVerifTitle').text('❌ Tolak Pembayaran');
                $('#modal_desc').text('Bukti pembayaran transaksi #' + id + ' akan ditolak. Pembeli diminta upload ulang.');
                $('#modal_btn').removeClass('btn-success').addClass('btn-danger').text('Ya, Tolak');
            }
        });
    });
</script>