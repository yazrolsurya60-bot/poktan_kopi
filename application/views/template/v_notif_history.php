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
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-cream); color: var(--dark-coffee); }
        .box-container { background: var(--card-white); border: 1px solid #EFEAE2; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.01); padding: 30px; margin-top: 40px; }
        .notif-item { border: 1px solid #EFEAE2; border-radius: 10px; transition: all 0.2s ease; padding: 18px 20px; display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; }
        .notif-item:hover { border-color: var(--amber-cream); background-color: #FDF5ED; }
        .notif-item.unread { background-color: #FDF5ED; border-color: rgba(230, 161, 92, 0.35); font-weight: 600; border-left: 4px solid var(--amber-cream); }
        .notif-item.read { background-color: var(--card-white); border-color: #EFEAE2; }
        .back-btn { background-color: var(--roasted-brown); color: white; font-weight: 600; border-radius: 8px; padding: 8px 16px; transition: opacity 0.2s; text-decoration: none; }
        .back-btn:hover { color: white; opacity: 0.9; text-decoration: none; }
        .mark-all-btn { background: transparent; border: 1px solid var(--amber-cream); color: var(--roasted-brown); border-radius: 8px; padding: 8px 16px; font-weight: 600; font-size: 0.85rem; transition: all 0.2s; cursor: pointer; }
        .mark-all-btn:hover { background: var(--amber-cream); color: white; }
        
<<<<<<< HEAD
=======
        /* Icon color mapping */
>>>>>>> 433eb8e300ef0f8efe1ca5225c15c9218cf570ab
        .notif-icon-success { background: #D1FAE5; color: #065F46; }
        .notif-icon-warning { background: #FEF3C7; color: #92400E; }
        .notif-icon-danger { background: #FEE2E2; color: #991B1B; }
        .notif-icon-info { background: #DBEAFE; color: #1E40AF; }
        .notif-icon-primary { background: #EDE9FE; color: #5B21B6; }
        .notif-icon-default { background: #FDF5ED; color: var(--amber-cream); }
        
        .icon-circle { width: 40px; height: 40px; min-width: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; }
    </style>
</head>
<body>

<div class="container">
    <div class="box-container">
<<<<<<< HEAD
=======
        <!-- Header Top -->
>>>>>>> 433eb8e300ef0f8efe1ca5225c15c9218cf570ab
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

<<<<<<< HEAD
=======
        <!-- Statistik Ringkas -->
>>>>>>> 433eb8e300ef0f8efe1ca5225c15c9218cf570ab
        <?php if(!empty($history)): 
            $total = count($history);
            $unread = 0;
            foreach($history as $h) {
<<<<<<< HEAD
                if(($h->status_baca ?? 0) == 0) $unread++;
=======
                if(($h['is_read'] ?? $h['status_baca'] ?? 0) == 0) $unread++;
>>>>>>> 433eb8e300ef0f8efe1ca5225c15c9218cf570ab
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

<<<<<<< HEAD
        <div class="list-group mt-3">
            <?php if(!empty($history)): ?>
                <?php foreach($history as $h): 
                    $is_read = $h->status_baca ?? 0;
                    $icon_type = $h->icon ?? 'default';
=======
        <!-- List Riwayat Box -->
        <div class="list-group mt-3">
            <?php if(!empty($history)): ?>
                <?php foreach($history as $h): 
                    $is_read = $h['is_read'] ?? $h['status_baca'] ?? 0;
                    $icon_type = $h['icon'] ?? 'default';
>>>>>>> 433eb8e300ef0f8efe1ca5225c15c9218cf570ab
                    $icon_map = [
                        'success' => 'bi-check-circle-fill',
                        'warning' => 'bi-exclamation-triangle-fill',
                        'danger' => 'bi-x-circle-fill',
                        'info' => 'bi-info-circle-fill',
                        'primary' => 'bi-star-fill',
                        'default' => 'bi-envelope-fill'
                    ];
                    $icon_class = isset($icon_map[$icon_type]) ? $icon_map[$icon_type] : 'bi-envelope-fill';
                ?>
                    <div class="notif-item <?= $is_read == 0 ? 'unread' : 'read'; ?>">
                        <div class="d-flex align-items-center flex-wrap" style="flex: 1; min-width: 0;">
                            <div class="icon-circle notif-icon-<?= $icon_type; ?> mr-3">
                                <i class="bi <?= $icon_class; ?>"></i>
                            </div>
                            <div style="flex: 1; min-width: 0;">
<<<<<<< HEAD
                                <?php if(isset($h->judul) && !empty($h->judul)): ?>
                                    <div class="font-weight-bold small" style="color: var(--dark-coffee);"><?= htmlspecialchars($h->judul); ?></div>
                                <?php endif; ?>
                                <span class="text-dark small" style="font-size: 0.9rem; word-wrap: break-word;">
                                    <?= htmlspecialchars($h->isi_notifikasi); ?>
=======
                                <?php if(isset($h['judul']) && !empty($h['judul'])): ?>
                                    <div class="font-weight-bold small" style="color: var(--dark-coffee);"><?= htmlspecialchars($h['judul']); ?></div>
                                <?php endif; ?>
                                <span class="text-dark small" style="font-size: 0.9rem; word-wrap: break-word;">
                                    <?= htmlspecialchars($h['pesan'] ?? $h['isi_notifikasi']); ?>
>>>>>>> 433eb8e300ef0f8efe1ca5225c15c9218cf570ab
                                </span>
                                <?php if($is_read == 0): ?>
                                    <span class="badge badge-pill ml-2" style="background: var(--amber-cream); color: white; font-size: 0.55rem; padding: 3px 8px;">Baru</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <small class="text-muted ml-3 font-weight-normal text-right" style="min-width: 120px; font-size: 0.7rem;">
                            <i class="bi bi-calendar3 mr-1"></i>
<<<<<<< HEAD
                            <?= isset($h->tanggal_buat) ? date('d M Y, H:i', strtotime($h->tanggal_buat)) : ''; ?>
=======
                            <?= isset($h['created_at']) ? date('d M Y, H:i', strtotime($h['created_at'])) : (isset($h['tanggal_buat']) ? date('d M Y, H:i', strtotime($h['tanggal_buat'])) : ''); ?>
>>>>>>> 433eb8e300ef0f8efe1ca5225c15c9218cf570ab
                        </small>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="bi bi-folder-x text-muted d-block" style="font-size: 3rem;"></i>
                    <p class="text-muted mt-2">Belum ada riwayat notifikasi masuk ke akun ini.</p>
                </div>
            <?php endif; ?>
        </div>
<<<<<<< HEAD
=======
        
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
>>>>>>> 433eb8e300ef0f8efe1ca5225c15c9218cf570ab
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
<<<<<<< HEAD
=======
    // Mark all as read
>>>>>>> 433eb8e300ef0f8efe1ca5225c15c9218cf570ab
    $('#markAllReadBtn').on('click', function() {
        if(confirm('Tandai semua notifikasi sebagai sudah dibaca?')) {
            $.ajax({
                url: '<?= base_url('api/notifikasi/mark_all_read'); ?>',
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    if(response.success) {
                        location.reload();
                    }
                },
                error: function() {
                    alert('Gagal menandai semua notifikasi. Silakan coba lagi.');
                }
            });
        }
    });
});
</script>
</body>
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> 433eb8e300ef0f8efe1ca5225c15c9218cf570ab
