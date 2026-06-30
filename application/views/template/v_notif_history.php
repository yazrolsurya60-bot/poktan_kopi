<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kotak Masuk Notifikasi - Poktan</title>
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
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-cream); color: var(--dark-coffee); }
        .box-container { background: var(--card-white); border: 1px solid #EFEAE2; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.01); padding: 30px; margin-top: 40px; }
        .notif-item { border: 1px solid #EFEAE2; border-radius: 10px; transition: all 0.2s ease; padding: 18px 20px; display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; }
        .notif-item:hover { border-color: var(--amber-cream); background-color: #FDF5ED; }
        .notif-item.unread { background-color: #FDF5ED; border-color: rgba(230, 161, 92, 0.35); border-left: 4px solid var(--amber-cream); }
        .notif-item.read { background-color: var(--card-white); border-color: #EFEAE2; }
        .back-btn { background-color: var(--roasted-brown); color: white; font-weight: 600; border-radius: 8px; padding: 8px 16px; transition: opacity 0.2s; text-decoration: none; }
        .back-btn:hover { color: white; opacity: 0.9; text-decoration: none; }
        .mark-all-btn { background: transparent; border: 1px solid var(--amber-cream); color: var(--roasted-brown); border-radius: 8px; padding: 8px 16px; font-weight: 600; font-size: 0.85rem; transition: all 0.2s; cursor: pointer; }
        .mark-all-btn:hover { background: var(--amber-cream); color: white; }
        
        .notif-icon-success { background: #D1FAE5; color: #065F46; }
        .notif-icon-warning { background: #FEF3C7; color: #92400E; }
        .notif-icon-danger { background: #FEE2E2; color: #991B1B; }
        .notif-icon-info { background: #DBEAFE; color: #1E40AF; }
        .notif-icon-primary { background: #EDE9FE; color: #5B21B6; }
        .notif-icon-default { background: #FDF5ED; color: var(--amber-cream); }
        
        .icon-circle { width: 40px; height: 40px; min-width: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; }
        
        .notif-empty {
            text-align: center;
            padding: 60px 20px;
        }
        .notif-empty i {
            font-size: 4rem;
            color: #D1C9C0;
            display: block;
            margin-bottom: 16px;
        }
        .notif-empty h5 {
            color: var(--dark-coffee);
            font-weight: 600;
        }
        .notif-empty p {
            color: var(--text-secondary);
        }
        
        .notif-judul {
            font-weight: 700;
            color: var(--dark-coffee);
            font-size: 0.95rem;
            margin-bottom: 4px;
        }
        .notif-isi {
            color: #4a3a2e;
            font-size: 0.9rem;
            word-wrap: break-word;
            line-height: 1.5;
        }
        .notif-tanggal {
            font-size: 0.7rem;
            color: var(--text-secondary);
            min-width: 130px;
            text-align: right;
        }
        .notif-badge-baru {
            background: var(--amber-cream);
            color: white;
            font-size: 0.55rem;
            padding: 2px 10px;
            border-radius: 20px;
            margin-left: 8px;
            font-weight: 600;
        }
        @media (max-width: 576px) {
            .notif-item { flex-wrap: wrap; }
            .notif-tanggal { text-align: left; margin-top: 8px; min-width: auto; }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="box-container">
        <!-- Header Top -->
        <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4 flex-wrap" style="border-color: rgba(74,44,17,0.08);">
            <div>
                <h4 class="font-weight-bold mb-1" style="color: var(--roasted-brown);">
                    <i class="bi bi-clock-history mr-2" style="color: var(--amber-cream);"></i> Riwayat Pemberitahuan
                </h4>
                <p class="text-muted small mb-0">Daftar rekaman seluruh log aktivitas notifikasi akun Anda.</p>
            </div>
            <div class="d-flex gap-2 mt-2 mt-md-0" style="gap: 8px;">
                <?php if(!empty($history)): ?>
                    <button class="mark-all-btn" id="markAllReadBtn">
                        <i class="bi bi-check2-all mr-1"></i> Tandai Semua Dibaca
                    </button>
                <?php endif; ?>
                <a href="<?= base_url($this->session->userdata('role').'/dashboard'); ?>" class="back-btn shadow-sm">
                    <i class="bi bi-arrow-left mr-1"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Statistik Ringkas -->
        <?php if(!empty($history)): 
            $total = count($history);
            $unread = 0;
            foreach($history as $h) {
                // Support object dan array
                if (is_object($h)) {
                    $status = $h->status_baca ?? 0;
                } else {
                    $status = $h['status_baca'] ?? 0;
                }
                if($status == 0) $unread++;
            }
        ?>
            <div class="d-flex flex-wrap gap-3 mb-4" style="gap: 16px;">
                <span class="badge" style="background: var(--bg-cream); color: var(--text-secondary); padding: 8px 16px; font-weight:600; font-size:0.8rem;">
                    <i class="bi bi-inbox mr-1"></i> Total: <?= $total; ?>
                </span>
                <?php if($unread > 0): ?>
                    <span class="badge" style="background: #FEF3C7; color: #92400E; padding: 8px 16px; font-weight:600; font-size:0.8rem;">
                        <i class="bi bi-envelope-fill mr-1"></i> Belum Dibaca: <?= $unread; ?>
                    </span>
                <?php else: ?>
                    <span class="badge" style="background: #D1FAE5; color: #065F46; padding: 8px 16px; font-weight:600; font-size:0.8rem;">
                        <i class="bi bi-check-circle-fill mr-1"></i> Semua Sudah Dibaca
                    </span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- List Riwayat Box -->
        <div class="list-group mt-3">
            <?php if(!empty($history)): ?>
                <?php foreach($history as $h): 
                    // ============================================
                    // AMBIL DATA - Support object dan array
                    // ============================================
                    if (is_object($h)) {
                        $is_read = $h->status_baca ?? 0;
                        $icon_type = $h->icon ?? 'default';
                        $judul = $h->judul ?? 'Notifikasi';
                        $isi = $h->isi_notifikasi ?? $h->pesan ?? '';
                        $tanggal = isset($h->tanggal_buat) ? date('d M Y, H:i', strtotime($h->tanggal_buat)) : 
                                   (isset($h->created_at) ? date('d M Y, H:i', strtotime($h->created_at)) : '');
                        $link = $h->link ?? '#';
                    } else {
                        $is_read = $h['status_baca'] ?? 0;
                        $icon_type = $h['icon'] ?? 'default';
                        $judul = $h['judul'] ?? 'Notifikasi';
                        $isi = $h['isi_notifikasi'] ?? $h['pesan'] ?? '';
                        $tanggal = isset($h['tanggal_buat']) ? date('d M Y, H:i', strtotime($h['tanggal_buat'])) : 
                                   (isset($h['created_at']) ? date('d M Y, H:i', strtotime($h['created_at'])) : '');
                        $link = $h['link'] ?? '#';
                    }

                    // Map icon
                    $icon_map = [
                        'success' => 'bi-check-circle-fill',
                        'warning' => 'bi-exclamation-triangle-fill',
                        'danger' => 'bi-x-circle-fill',
                        'info' => 'bi-info-circle-fill',
                        'primary' => 'bi-star-fill',
                        'default' => 'bi-envelope-fill'
                    ];
                    $icon_class = $icon_map[$icon_type] ?? 'bi-envelope-fill';
                ?>
                    <div class="notif-item <?= $is_read == 0 ? 'unread' : 'read'; ?>">
                        <div class="d-flex align-items-center flex-wrap" style="flex: 1; min-width: 0;">
                            <div class="icon-circle notif-icon-<?= $icon_type; ?> mr-3">
                                <i class="bi <?= $icon_class; ?>"></i>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <?php if(!empty($judul)): ?>
                                    <div class="notif-judul">
                                        <?= htmlspecialchars($judul); ?>
                                        <?php if($is_read == 0): ?>
                                            <span class="notif-badge-baru">Baru</span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="notif-isi">
                                    <?= htmlspecialchars($isi); ?>
                                </div>
                            </div>
                        </div>
                        <div class="notif-tanggal">
                            <i class="bi bi-calendar3 mr-1"></i>
                            <?= $tanggal; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="notif-empty">
                    <i class="bi bi-inbox"></i>
                    <h5>Kotak Masuk Kosong</h5>
                    <p>Belum ada riwayat notifikasi masuk ke akun Anda.</p>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Pagination (jika diperlukan) -->
        <?php if(!empty($history) && count($history) >= 50): ?>
            <div class="mt-4 text-center">
                <nav>
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled"><span class="page-link">Sebelumnya</span></li>
                        <li class="page-item active"><span class="page-link" style="background-color: var(--roasted-brown); border-color: var(--roasted-brown);">1</span></li>
                        <li class="page-item"><a class="page-link" href="#" style="color: var(--roasted-brown);">2</a></li>
                        <li class="page-item"><a class="page-link" href="#" style="color: var(--roasted-brown);">3</a></li>
                        <li class="page-item"><a class="page-link" href="#" style="color: var(--roasted-brown);">Selanjutnya</a></li>
                    </ul>
                </nav>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    $('#markAllReadBtn').on('click', function() {
        if(confirm('Tandai semua notifikasi sebagai sudah dibaca?')) {
            $.ajax({
                url: '<?= base_url('api/notifikasi/mark_all_read'); ?>',
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    if(response.success) {
                        location.reload();
                    } else {
                        alert('Gagal menandai semua notifikasi.');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            });
        }
    });
});
</script>
</body>
</html>
