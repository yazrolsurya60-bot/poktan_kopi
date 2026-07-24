<style>
    :root {
        --roasted-brown: #4A2C11;
        --dark-coffee: #2C1808;
        --amber-cream: #E6A15C;
        --amber-light: #FDF5ED;
        --bg-cream: #FAF6F0;
        --card-white: #FFFFFF;
        --text-secondary: #70655E;
        --shadow-soft: 0 8px 30px rgba(44, 24, 8, 0.08);
        --shadow-hover: 0 12px 40px rgba(44, 24, 8, 0.15);
        --radius-card: 16px;
        --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* STATUS BADGE */
    .status-badge {
        padding: 5px 14px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        display: inline-block;
    }
    .status-badge.pending { background: #FEF3C7; color: #92400E; }
    .status-badge.processing { background: #DBEAFE; color: #1E40AF; }
    .status-badge.delivery { background: #EDE9FE; color: #5B21B6; }
    .status-badge.complete { background: #D1FAE5; color: #065F46; }
    .status-badge.cancelled { background: #FEE2E2; color: #991B1B; }

    /* CUSTOM CARD */
    .custom-card {
        background: var(--card-white);
        border-radius: var(--radius-card);
        box-shadow: var(--shadow-soft);
        transition: var(--transition-smooth);
        overflow: hidden;
        border: 1px solid rgba(74, 44, 17, 0.04);
    }
    .custom-card:hover { box-shadow: var(--shadow-hover); }
    .custom-card .card-header-custom {
        padding: 16px 24px;
        border-bottom: 1px solid rgba(74, 44, 17, 0.06);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: rgba(250, 246, 240, 0.3);
    }
    .custom-card .card-header-custom h6 {
        font-weight: 700;
        color: var(--dark-coffee);
        margin: 0;
        font-size: 0.9rem;
    }
    .custom-card .card-header-custom h6 i {
        color: var(--amber-cream);
        margin-right: 8px;
    }
    .custom-card .card-body-custom { padding: 24px; }

    /* TABLE */
    .table-custom { font-size: 0.85rem; margin-bottom: 0; width: 100%; }
    .table-custom thead th {
        background: rgba(250, 246, 240, 0.4);
        border-bottom: 2px solid rgba(74, 44, 17, 0.06);
        color: var(--text-secondary);
        font-weight: 600;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 10px;
    }
    .table-custom tbody td {
        padding: 12px 10px;
        border-bottom: 1px solid rgba(74, 44, 17, 0.04);
        vertical-align: middle;
    }
    .table-custom tbody tr:hover { background: rgba(250, 246, 240, 0.4); }

    /* DETAIL LABEL */
    .detail-label {
        font-weight: 600;
        color: var(--text-secondary);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    .detail-value {
        font-weight: 600;
        color: var(--dark-coffee);
    }

    /* BUTTONS */
    .btn-amber {
        background: linear-gradient(135deg, var(--roasted-brown), var(--amber-cream));
        color: white;
        border-radius: 10px;
        padding: 8px 20px;
        font-weight: 600;
        border: none;
        transition: var(--transition-smooth);
    }
    .btn-amber:hover { opacity: 0.85; color: white; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(230, 161, 92, 0.3); }

    .btn-outline-amber {
        background: transparent;
        color: var(--amber-cream);
        border: 1px solid var(--amber-cream);
        border-radius: 10px;
        padding: 8px 20px;
        font-weight: 600;
        transition: var(--transition-smooth);
    }
    .btn-outline-amber:hover { background: var(--amber-cream); color: white; transform: translateY(-2px); }

    .btn-back {
        background: transparent;
        color: var(--text-secondary);
        border: 1px solid rgba(74, 44, 17, 0.1);
        border-radius: 10px;
        padding: 8px 20px;
        font-weight: 600;
        transition: var(--transition-smooth);
    }
    .btn-back:hover { background: var(--bg-cream); border-color: var(--roasted-brown); color: var(--dark-coffee); transform: translateY(-2px); }

    .fade-in { animation: fadeInUp 0.6s ease forwards; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
</style>

<!-- ALERT -->
<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle mr-1"></i> <?= $this->session->flashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="bi bi-exclamation-circle mr-1"></i> <?= $this->session->flashdata('error'); ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
<?php endif; ?>

<div class="row">
    <!-- INFORMASI TRANSAKSI -->
    <div class="col-md-6 mb-4">
        <div class="custom-card fade-in">
            <div class="card-header-custom">
                <h6><i class="bi bi-info-circle"></i> Informasi Pesanan</h6>
                <span class="status-badge <?= strtolower($transaksi['status_pesanan']) == 'selesai' ? 'complete' : (strtolower($transaksi['status_pesanan']) == 'pending' ? 'pending' : (strtolower($transaksi['status_pesanan']) == 'dikirim' ? 'delivery' : (strtolower($transaksi['status_pesanan']) == 'diproses' ? 'processing' : 'cancelled'))); ?>">
                    <?= $transaksi['status_pesanan']; ?>
                </span>
            </div>
            <div class="card-body-custom">
                <div class="row mb-2">
                    <div class="col-5 detail-label">ID Transaksi</div>
                    <div class="col-7 detail-value">#<?= $transaksi['id_transaksi']; ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 detail-label">Pembeli</div>
                    <div class="col-7 detail-value"><?= $transaksi['nama_pembeli'] ?? 'Guest'; ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 detail-label">Email</div>
                    <div class="col-7 detail-value"><?= $transaksi['email'] ?? '-'; ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 detail-label">No HP</div>
                    <div class="col-7 detail-value"><?= $transaksi['no_hp'] ?: ($transaksi['user_hp'] ?? '-'); ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 detail-label">Alamat Kirim</div>
                    <div class="col-7 detail-value"><?= $transaksi['alamat_kirim']; ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 detail-label">Kota</div>
                    <div class="col-7 detail-value"><?= $transaksi['kota_kirim']; ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 detail-label">Kode Pos</div>
                    <div class="col-7 detail-value"><?= $transaksi['kode_pos']; ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 detail-label">Metode Bayar</div>
                    <div class="col-7 detail-value"><?= $transaksi['metode_bayar']; ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 detail-label">Status Bayar</div>
                    <div class="col-7">
                        <span class="status-badge <?= strtolower($transaksi['status_bayar']) == 'lunas' ? 'complete' : (strtolower($transaksi['status_bayar']) == 'batal' ? 'cancelled' : 'pending'); ?>">
                            <?= $transaksi['status_bayar']; ?>
                        </span>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 detail-label">Tanggal Transaksi</div>
                    <div class="col-7 detail-value"><?= date('d/m/Y H:i', strtotime($transaksi['tanggal_transaksi'])); ?></div>
                </div>
                <?php if (!empty($transaksi['alasan_batal'])): ?>
                    <div class="row mb-2">
                        <div class="col-5 detail-label">Alasan Batal</div>
                        <div class="col-7 detail-value" style="color: #EF4444;"><?= $transaksi['alasan_batal']; ?></div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- DETAIL PRODUK -->
    <div class="col-md-6 mb-4">
        <div class="custom-card fade-in">
            <div class="card-header-custom">
                <h6><i class="bi bi-box-seam"></i> Detail Produk</h6>
                <span class="badge" style="background:var(--bg-cream); color:var(--text-secondary); font-weight:600; padding:6px 14px; border-radius:20px;">
                    <?= count($details); ?> item
                </span>
            </div>
            <div class="card-body-custom p-0">
                <div class="table-responsive">
                    <table class="table table-custom mb-0">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th class="text-center">Qty</th>
                                <th class="text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($details as $d): ?>
                                <tr>
                                    <td><?= $d['nama_produk']; ?></td>
                                    <td class="text-center"><?= $d['jumlah']; ?></td>
                                    <td class="text-right">Rp <?= number_format($d['subtotal'], 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" class="text-right">Subtotal</th>
                                <th class="text-right">Rp <?= number_format($transaksi['total_harga'], 0, ',', '.'); ?></th>
                            </tr>
                            <tr>
                                <th colspan="2" class="text-right">Ongkir</th>
                                <th class="text-right">Rp <?= number_format($transaksi['ongkir'], 0, ',', '.'); ?></th>
                            </tr>
                            <tr style="border-top: 2px solid var(--amber-cream);">
                                <th colspan="2" class="text-right" style="font-size:1rem;">Grand Total</th>
                                <th class="text-right" style="font-size:1.1rem; color: var(--amber-cream); font-weight:700;">
                                    Rp <?= number_format($transaksi['grand_total'], 0, ',', '.'); ?>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- UPDATE STATUS -->
        <?php if ($transaksi['status_pesanan'] != 'Selesai' && $transaksi['status_pesanan'] != 'Dibatalkan'): ?>
            <div class="custom-card mt-3 fade-in">
                <div class="card-header-custom" style="background: #FEF3C7;">
                    <h6><i class="bi bi-arrow-repeat text-warning"></i> Update Status Pesanan</h6>
                </div>
                <div class="card-body-custom">
                    <form action="<?= base_url('admin/transaksi/update_status/' . $transaksi['id_transaksi']); ?>" method="POST">
                        <div class="row">
                            <div class="col-md-8 mb-2 mb-md-0">
                                <select name="status" class="form-control" style="border-radius:10px; border:1px solid rgba(74,44,17,0.12);" required>
                                    <option value="">Pilih Status</option>
                                    <option value="Pending" <?= $transaksi['status_pesanan'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Diproses" <?= $transaksi['status_pesanan'] == 'Diproses' ? 'selected' : ''; ?>>Diproses</option>
                                    <option value="Dikirim" <?= $transaksi['status_pesanan'] == 'Dikirim' ? 'selected' : ''; ?>>Dikirim</option>
                                    <option value="Selesai">Selesai</option>
                                    <option value="Dibatalkan">Dibatalkan</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn-amber btn-block">Update Status</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <!-- TOMBOL AKSI -->
        <div class="mt-3 d-flex flex-wrap gap-2">
            <a href="<?= base_url('admin/transaksi'); ?>" class="btn-back text-decoration-none">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <a href="<?= base_url('admin/transaksi/invoice/' . $transaksi['id_transaksi']); ?>" target="_blank" class="btn-amber text-decoration-none">
                <i class="bi bi-file-pdf"></i> Invoice
            </a>
        </div>
    </div>
</div>

<!-- BUKTI PEMBAYARAN -->
<?php if ($bukti): ?>
    <div class="row fade-in">
        <div class="col-12">
            <div class="custom-card">
                <div class="card-header-custom">
                    <h6><i class="bi bi-credit-card"></i> Bukti Pembayaran</h6>
                    <span class="status-badge <?= strtolower($bukti['status_verifikasi']) == 'diverifikasi' ? 'complete' : (strtolower($bukti['status_verifikasi']) == 'ditolak' ? 'cancelled' : 'pending'); ?>">
                        <?= $bukti['status_verifikasi']; ?>
                    </span>
                </div>
                <div class="card-body-custom">
                    <div class="row">
                        <div class="col-md-3"><strong>Bank:</strong> <?= $bukti['nama_bank']; ?></div>
                        <div class="col-md-3"><strong>Pengirim:</strong> <?= $bukti['nama_pengirim']; ?></div>
                        <div class="col-md-3"><strong>Tanggal:</strong> <?= date('d/m/Y', strtotime($bukti['tanggal_transfer'])); ?></div>
                        <div class="col-md-3"><strong>Jumlah:</strong> Rp <?= number_format($bukti['jumlah_transfer'], 0, ',', '.'); ?></div>
                    </div>
                    <div class="mt-3">
                        <a href="<?= base_url('uploads/bukti/' . $bukti['file_bukti']); ?>" target="_blank" class="btn-outline-amber text-decoration-none">
                            <i class="bi bi-eye"></i> Lihat Bukti Transfer
                        </a>
                    </div>
                    <?php if ($transaksi['status_bayar'] == 'Pending' && $bukti['status_verifikasi'] == 'Pending'): ?>
                        <div class="mt-3 pt-3 border-top" style="border-color: rgba(74,44,17,0.06);">
                            <form action="<?= base_url('admin/transaksi/konfirmasi_bayar'); ?>" method="POST">
                                <input type="hidden" name="id_transaksi" value="<?= $transaksi['id_transaksi']; ?>">
                                <div class="row">
                                    <div class="col-md-5 mb-2 mb-md-0">
                                        <select name="status" class="form-control" style="border-radius:10px; border:1px solid rgba(74,44,17,0.12);" required>
                                            <option value="">Pilih Verifikasi</option>
                                            <option value="Diverifikasi">✅ Verifikasi - Terima</option>
                                            <option value="Ditolak">❌ Tolak</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5 mb-2 mb-md-0">
                                        <input type="text" name="keterangan" class="form-control" placeholder="Keterangan (opsional)" style="border-radius:10px; border:1px solid rgba(74,44,17,0.12);">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn-amber btn-block">Proses</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>