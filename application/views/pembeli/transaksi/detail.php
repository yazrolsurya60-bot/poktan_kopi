
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
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-cream); color: var(--dark-coffee); overflow-x: hidden; }
        
 

        .status-badge { padding: 4px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: 600; display: inline-block; }
        .status-badge.pending { background: #FEF3C7; color: #92400E; }
        .status-badge.processing { background: #DBEAFE; color: #1E40AF; }
        .status-badge.delivery { background: #EDE9FE; color: #5B21B6; }
        .status-badge.complete { background: #D1FAE5; color: #065F46; }
        .status-badge.cancelled { background: #FEE2E2; color: #991B1B; }
        .status-badge.lunas { background: #D1FAE5; color: #065F46; }
        .status-badge.belum-bayar { background: #FEF3C7; color: #92400E; }
        .status-badge.ditolak { background: #FEE2E2; color: #991B1B; }
        .status-badge.menunggu { background: #FEF3C7; color: #92400E; }
        .status-badge.diverifikasi { background: #DBEAFE; color: #1E40AF; }

        .custom-card { background: var(--card-white); border: 1px solid rgba(74, 44, 17, 0.06); border-radius: var(--radius-card); box-shadow: var(--shadow-soft); transition: var(--transition-smooth); overflow: hidden; }
        .custom-card:hover { box-shadow: var(--shadow-hover); }
        .custom-card .card-header-custom { padding: 18px 24px; border-bottom: 1px solid rgba(74, 44, 17, 0.06); display: flex; align-items: center; justify-content: space-between; }
        .custom-card .card-header-custom h6 { font-weight: 700; color: var(--dark-coffee); margin: 0; font-size: 0.85rem; }
        .custom-card .card-body-custom { padding: 24px; }

        .table-custom { font-size: 0.85rem; }
        .table-custom thead th { border-bottom: 2px solid rgba(74, 44, 17, 0.06); color: var(--text-secondary); font-weight: 600; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 10px; }
        .table-custom tbody td { padding: 12px 10px; border-bottom: 1px solid rgba(74, 44, 17, 0.04); vertical-align: middle; }
        .table-custom tbody tr:hover { background: rgba(250, 246, 240, 0.3); }

        .detail-label { font-weight: 600; color: var(--text-secondary); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.3px; }
        .detail-value { font-weight: 600; }
        .btn-amber { background: var(--amber-cream); color: white; border-radius: 8px; padding: 8px 20px; font-weight: 600; border: none; transition: var(--transition-smooth); }
        .btn-amber:hover { opacity: 0.85; color: white; transform: translateY(-2px); box-shadow: 0 4px 15px rgba(230, 161, 92, 0.3); }
        .btn-danger-custom { background: #EF4444; color: white; border-radius: 8px; padding: 8px 20px; font-weight: 600; border: none; transition: var(--transition-smooth); }
        .btn-danger-custom:hover { opacity: 0.85; color: white; transform: translateY(-2px); box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3); }
        .btn-outline-secondary-custom { background: transparent; color: var(--text-secondary); border: 1px solid rgba(74, 44, 17, 0.15); border-radius: 8px; padding: 8px 20px; font-weight: 600; transition: var(--transition-smooth); }
        .btn-outline-secondary-custom:hover { background: var(--bg-cream); color: var(--dark-coffee); text-decoration: none; }
        
        .empty-state { text-align: center; padding: 40px 20px; color: var(--text-secondary); }
        .empty-state i { font-size: 3rem; color: var(--amber-cream); opacity: 0.5; display: block; margin-bottom: 16px; }

        .payment-info-box { background: var(--bg-cream); border-radius: 10px; padding: 16px 20px; }
        .payment-info-box table { font-size: 0.9rem; }
        .payment-info-box table td { padding: 4px 8px; }
        .payment-info-box .bank-name { font-weight: 700; color: var(--roasted-brown); }
        
        .instruction-alert { border-radius: 10px; border: none; }
        .instruction-alert i { font-size: 1.1rem; }
    </style>
</head>
<body>


    <!-- ALERT -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" style="border-radius:10px; border:none;">
            <i class="bi bi-check-circle mr-1"></i> <?= $this->session->flashdata('success'); ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" style="border-radius:10px; border:none;">
            <i class="bi bi-exclamation-circle mr-1"></i> <?= $this->session->flashdata('error'); ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>

    <?php if (empty($transaksi)): ?>
        <div class="custom-card">
            <div class="card-body-custom empty-state">
                <i class="bi bi-exclamation-circle"></i>
                <h5>Transaksi tidak ditemukan</h5>
                <p class="text-muted">Data transaksi yang Anda cari tidak tersedia.</p>
                <a href="<?= base_url('pembeli/transaksi/history'); ?>" class="btn-amber">
                    <i class="bi bi-arrow-left mr-1"></i> Kembali ke Riwayat
                </a>
            </div>
        </div>
    <?php else: ?>

    <div class="row">
        <!-- INFORMASI TRANSAKSI -->
        <div class="col-md-6 mb-4">
            <div class="custom-card">
                <div class="card-header-custom">
                    <h6><i class="bi bi-info-circle text-primary mr-2"></i> Informasi Pesanan</h6>
                    <?php 
                    $status = $transaksi['status_pesanan'] ?? 'Pending';
                    $status_map = [
                        'Selesai' => 'complete',
                        'Complete' => 'complete',
                        'Dikirim' => 'delivery',
                        'Shipped' => 'delivery',
                        'Diproses' => 'processing',
                        'Processing' => 'processing',
                        'Pending' => 'pending',
                        'Dibatalkan' => 'cancelled',
                        'Cancelled' => 'cancelled'
                    ];
                    $badge_class = $status_map[$status] ?? 'pending';
                    ?>
                    <span class="status-badge <?= $badge_class; ?>">
                        <?= $status; ?>
                    </span>
                </div>
                <div class="card-body-custom">
                    <div class="row mb-2">
                        <div class="col-5 detail-label">ID Transaksi</div>
                        <div class="col-7 detail-value">#<?= $transaksi['id_transaksi'] ?? 'N/A'; ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 detail-label">Tanggal</div>
                        <div class="col-7"><?= date('d/m/Y H:i', strtotime($transaksi['tanggal_transaksi'] ?? date('Y-m-d H:i:s'))); ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 detail-label">Metode Bayar</div>
                        <div class="col-7">COD (Bayar di Tempat)</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 detail-label">Status Bayar</div>
                        <div class="col-7">
                            <?php 
                            $status_bayar = $transaksi['status_bayar'] ?? 'Belum Bayar';
                            $bayar_class = $status_bayar == 'Lunas' ? 'lunas' : ($status_bayar == 'Diverifikasi' ? 'diverifikasi' : ($status_bayar == 'Ditolak' ? 'ditolak' : 'belum-bayar'));
                            ?>
                            <span class="status-badge <?= $bayar_class; ?>">
                                <?= $status_bayar; ?>
                            </span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 detail-label">Alamat Kirim</div>
                        <div class="col-7"><?= $transaksi['alamat_kirim'] ?? '-'; ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 detail-label">Kota</div>
                        <div class="col-7"><?= $transaksi['kota_kirim'] ?? '-'; ?></div>
                    </div>
                    <?php if (!empty($transaksi['alasan_batal'])): ?>
                    <div class="row mb-2">
                        <div class="col-5 detail-label">Alasan Batal</div>
                        <div class="col-7" style="color: #EF4444;"><?= $transaksi['alasan_batal']; ?></div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- DETAIL PRODUK -->
        <div class="col-md-6 mb-4">
            <div class="custom-card">
                <div class="card-header-custom">
                    <h6><i class="bi bi-box-seam text-success mr-2"></i> Detail Produk</h6>
                    <span class="badge" style="background: var(--bg-cream); color: var(--text-secondary);"><?= count($details ?? []); ?> item</span>
                </div>
                <div class="card-body-custom" style="padding:0;">
                    <?php if (empty($details)): ?>
                        <div class="empty-state" style="padding: 20px;">
                            <i class="bi bi-box" style="font-size: 2rem;"></i>
                            <p>Tidak ada produk dalam transaksi ini</p>
                        </div>
                    <?php else: ?>
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
                                <?php 
                                $total_terhitung = 0;
                                foreach ($details as $d): 
                                    $subtotal = ($d['harga_satuan'] ?? 0) * ($d['jumlah'] ?? 0);
                                    $total_terhitung += $subtotal;
                                ?>
                                <tr>
                                    <td><?= $d['nama_produk'] ?? 'Produk tidak tersedia'; ?></td>
                                    <td class="text-center"><?= $d['jumlah'] ?? 0; ?></td>
                                    <td class="text-right">Rp <?= number_format($subtotal, 0, ',', '.'); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2" class="text-right">Subtotal</th>
                                    <th class="text-right">Rp <?= number_format($transaksi['total_harga'] ?? $total_terhitung, 0, ',', '.'); ?></th>
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-right">Ongkir</th>
                                    <th class="text-right">Rp <?= number_format($transaksi['ongkir'] ?? 0, 0, ',', '.'); ?></th>
                                </tr>
                                <?php 
                                $grand_total = ($transaksi['total_harga'] ?? 0) + ($transaksi['ongkir'] ?? 0);
                                ?>
                                <tr style="border-top: 2px solid var(--amber-cream);">
                                    <th colspan="2" class="text-right" style="font-size:1rem;">Grand Total</th>
                                    <th class="text-right" style="font-size:1.1rem; color: var(--amber-cream); font-weight:700;">
                                        Rp <?= number_format($grand_total, 0, ',', '.'); ?>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================ -->
    <!-- 🔥 INFORMASI PEMBAYARAN - COD ONLY                           -->
    <!-- ============================================================ -->
    <div class="row">
        <div class="col-12">
            <div class="custom-card">
                <div class="card-header-custom" style="background: <?= $status_bayar == 'Lunas' ? '#D1FAE5' : ($status_bayar == 'Ditolak' ? '#FEE2E2' : '#FEF3C7'); ?>;">
                    <h6>
                        <i class="bi bi-cash-coin mr-2"></i> 
                        Informasi Pembayaran
                        <span class="status-badge <?= $bayar_class; ?> ml-2">
                            <?= $status_bayar; ?>
                        </span>
                    </h6>
                </div>
                <div class="card-body-custom">

                    <?php if ($status_bayar == 'Belum Bayar' || $status_bayar == 'Pending' || $status_bayar == 'Menunggu Pembayaran'): ?>
                        <!-- 🔥 STATUS: BELUM BAYAR / PENDING - COD -->
                        <div class="alert alert-warning instruction-alert">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-info-circle mr-3 mt-1" style="font-size:1.3rem;"></i>
                                <div>
                                    <h6 class="mb-2" style="font-weight:700;">🚚 Bayar di Tempat (COD)</h6>
                                    <p class="mb-2">Pesanan Anda akan dikirim dan dibayar tunai saat barang diterima. Mohon siapkan uang pas sesuai total pembayaran berikut:</p>

                                    <div class="payment-info-box">
                                        <table class="table table-sm table-borderless mb-0">
                                            <tr>
                                                <td width="160"><strong>Metode Bayar</strong></td>
                                                <td>: <span class="bank-name">COD (Bayar di Tempat)</span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Pembayaran</strong></td>
                                                <td>: <strong style="color: var(--roasted-brown); font-size:1.1rem;">Rp <?= number_format($grand_total, 0, ',', '.'); ?></strong></td>
                                            </tr>
                                        </table>
                                    </div>

                                    <small class="text-muted mt-2 d-block">
                                        <i class="bi bi-clock mr-1"></i>
                                        Status pembayaran akan diperbarui oleh kurir/admin setelah uang diterima saat pengiriman.
                                        <br>
                                        <i class="bi bi-info-circle mr-1"></i>
                                        Pastikan ada orang yang dapat menerima pesanan dan melakukan pembayaran di alamat tujuan.
                                    </small>
                                </div>
                            </div>
                        </div>

                    <?php elseif ($status_bayar == 'Diverifikasi'): ?>
                        <!-- 🔥 STATUS: DIVERIFIKASI -->
                        <div class="alert alert-info instruction-alert">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-hourglass-split mr-3 mt-1" style="font-size:1.3rem;"></i>
                                <div>
                                    <h6 class="mb-2" style="font-weight:700;">🔄 Pembayaran Sedang Diverifikasi</h6>
                                    <p class="mb-0">Admin sedang memverifikasi pembayaran COD Anda. Mohon tunggu sebentar.</p>
                                    <small class="text-muted mt-2 d-block">
                                        <i class="bi bi-clock mr-1"></i> Proses verifikasi maksimal 1x24 jam.
                                    </small>
                                </div>
                            </div>
                        </div>

                    <?php elseif ($status_bayar == 'Lunas'): ?>
                        <!-- 🔥 STATUS: LUNAS -->
                        <div class="alert alert-success instruction-alert">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-check-circle-fill mr-3 mt-1" style="font-size:1.3rem;"></i>
                                <div>
                                    <h6 class="mb-2" style="font-weight:700;">✅ Pembayaran Lunas</h6>
                                    <p class="mb-0">Pembayaran COD Anda telah dikonfirmasi diterima. Pesanan akan segera diproses.</p>
                                    <small class="text-muted mt-2 d-block">
                                        <i class="bi bi-truck mr-1"></i> Status pesanan akan berubah menjadi "Diproses" setelah admin mengkonfirmasi.
                                    </small>
                                </div>
                            </div>
                        </div>

                    <?php elseif ($status_bayar == 'Ditolak'): ?>
                        <!-- 🔥 STATUS: DITOLAK -->
                        <div class="alert alert-danger instruction-alert">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-x-circle-fill mr-3 mt-1" style="font-size:1.3rem;"></i>
                                <div>
                                    <h6 class="mb-2" style="font-weight:700;">❌ Pembayaran Ditolak</h6>
                                    <p class="mb-0">Pembayaran Anda ditolak oleh admin dengan alasan:</p>
                                    <div class="mt-2 p-2" style="background: rgba(239,68,68,0.1); border-radius:8px;">
                                        <em>"<?= $bukti['keterangan'] ?? 'Data tidak valid. Silakan hubungi admin.'; ?>"</em>
                                    </div>
                                    <small class="text-muted mt-2 d-block">
                                        <i class="bi bi-arrow-repeat mr-1"></i> Silakan hubungi admin untuk informasi lebih lanjut.
                                    </small>
                                </div>
                            </div>
                        </div>

                    <?php else: ?>
                        <!-- 🔥 STATUS: LAINNYA (fallback) -->
                        <div class="alert alert-secondary instruction-alert">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-info-circle mr-3 mt-1" style="font-size:1.3rem;"></i>
                                <div>
                                    <h6 class="mb-2" style="font-weight:700;">ℹ️ Status Pembayaran</h6>
                                    <p class="mb-0">Status pembayaran: <strong><?= $status_bayar; ?></strong></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- 🔥 TAMPILKAN BUKTI/KETERANGAN COD (JIKA ADA) -->
                    <?php if (!empty($bukti) && $bukti['status_verifikasi'] != 'Ditolak'): ?>
                    <div class="mt-3 p-3" style="background: var(--bg-cream); border-radius:10px;">
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted">Nama Penerima</small>
                                <div class="font-weight-bold"><?= $bukti['nama_pengirim'] ?? '-'; ?></div>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">Tanggal Diterima</small>
                                <div class="font-weight-bold"><?= date('d/m/Y', strtotime($bukti['tanggal_transfer'] ?? date('Y-m-d'))); ?></div>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">Jumlah Diterima</small>
                                <div class="font-weight-bold">Rp <?= number_format($bukti['jumlah_transfer'] ?? 0, 0, ',', '.'); ?></div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- 🔥 TOMBOL AKSI -->
                    <div class="mt-3 d-flex flex-wrap" style="gap:10px;">
                        <a href="<?= base_url('pembeli/transaksi/history'); ?>" class="btn-outline-secondary-custom">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <a href="<?= base_url('pembeli/transaksi/invoice/' . $transaksi['id_transaksi']); ?>" target="_blank" class="btn-amber">
                            <i class="bi bi-file-pdf"></i> Download Invoice
                        </a>
                        <?php 
                        $status_cancel = $transaksi['status_pesanan'] ?? '';
                        if (in_array($status_cancel, ['Pending', 'Diproses', 'Menunggu Pembayaran'])): 
                        ?>
                            <button class="btn-danger-custom" data-toggle="modal" data-target="#modalBatal">
                                <i class="bi bi-x-circle"></i> Batalkan Pesanan
                            </button>
                        <?php endif; ?>
                    </div>

                    <!-- 🔥 CATATAN -->
                    <div class="mt-3 pt-3 border-top" style="border-color: rgba(74,44,17,0.08);">
                        <small class="text-muted">
                            <i class="bi bi-info-circle mr-1"></i>
                            <strong>Catatan:</strong> Pembayaran dilakukan secara tunai saat barang diterima (COD). 
                            Jika ada kendala, silakan hubungi customer service.
                        </small>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php endif; // end if empty transaksi ?>
</div>

<!-- MODAL BATAL -->
<div class="modal fade" id="modalBatal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none; padding-bottom: 0;">
                <h5 class="modal-title" style="font-weight:700;"><i class="bi bi-exclamation-triangle-fill text-danger mr-2"></i> Batalkan Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?= base_url('pembeli/transaksi/batalkan/' . ($transaksi['id_transaksi'] ?? '')); ?>" method="POST">
                <div class="modal-body">
                    <p>Yakin ingin membatalkan pesanan #<?= $transaksi['id_transaksi'] ?? 'N/A'; ?>?</p>
                    <div class="form-group">
                        <label style="font-weight:600; font-size:0.85rem;">Alasan Pembatalan</label>
                        <textarea name="alasan" class="form-control" rows="3" placeholder="Tulis alasan pembatalan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: none; padding-top: 0;">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" style="border-radius:8px;">Batal</button>
                    <button type="submit" class="btn-danger-custom">Ya, Batalkan Pesanan</button>
                </div>
            </form>
        </div>
    </div>
</div>

