<li class="nav-item dropdown" style="list-style: none;">
    <a class="nav-link text-dark position-relative p-2" href="#" id="notifDrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="bi bi-bell-fill" style="font-size: 1.35rem; color: var(--roasted-brown);"></i>
        <?php 
        // Hitung notifikasi yang BELUM DIBACA
        $unread_count = 0;
        if(!empty($notifikasi)) {
            foreach($notifikasi as $n) {
                if(isset($n['is_read']) && $n['is_read'] == 0) {
                    $unread_count++;
                }
            }
        }
        ?>
        <?php if($unread_count > 0): ?>
            <span class="badge badge-danger position-absolute" style="top: 2px; right: 2px; border-radius: 50%; font-size: 0.65rem; padding: 4px 6px; border: 2px solid var(--card-white);"><?= $unread_count; ?></span>
        <?php endif; ?>
    </a>
    <div class="dropdown-menu dropdown-menu-right shadow-lg border-0 p-0 mt-2" style="width: 380px; border-radius: 14px; overflow: hidden;">
        <!-- Header Dropdown -->
        <div class="p-3 font-weight-bold text-white d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, var(--dark-coffee), #1a0e04);">
            <span style="font-size: 0.9rem; letter-spacing: 0.5px;">
                <i class="bi bi-envelope-paper-fill mr-2 text-warning"></i>
                <?= $unread_count > 0 ? $unread_count . ' Notifikasi Belum Dibaca' : 'Semua Notifikasi'; ?>
            </span>
            <a href="<?= base_url('notifikasi/history'); ?>" class="badge badge-warning text-dark px-2 py-1 small" style="font-size: 0.75rem; font-weight: 600; text-decoration: none;">
                Lihat Semua
            </a>
        </div>
        
        <!-- List Item Pesan -->
        <div style="max-height: 300px; overflow-y: auto; background-color: var(--card-white);">
            <?php if(!empty($notifikasi)): ?>
                <?php foreach($notifikasi as $n): ?>
                    <a class="dropdown-item p-3 border-bottom d-flex align-items-start <?= (isset($n['is_read']) && $n['is_read'] == 0) ? 'bg-light' : ''; ?>" 
                       href="<?= base_url('notifikasi/read/'.$n['id_notifikasi']); ?>" 
                       style="white-space: normal; transition: background 0.2s; <?= (isset($n['is_read']) && $n['is_read'] == 0) ? 'border-left: 3px solid var(--amber-cream);' : ''; ?>">
                        
                        <!-- Icon berdasarkan tipe notifikasi -->
                        <div class="mr-3 mt-1 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; min-width: 36px; border-radius: 10px; <?= $n['icon'] ?? 'info'; ?>">
                            <?php 
                            $icon_map = [
                                'success' => 'bi-check-circle-fill',
                                'warning' => 'bi-exclamation-triangle-fill',
                                'danger' => 'bi-x-circle-fill',
                                'info' => 'bi-info-circle-fill',
                                'primary' => 'bi-star-fill'
                            ];
                            $icon_class = isset($n['icon']) && isset($icon_map[$n['icon']]) ? $icon_map[$n['icon']] : 'bi-info-circle-fill';
                            
                            $bg_color = [
                                'success' => '#D1FAE5',
                                'warning' => '#FEF3C7',
                                'danger' => '#FEE2E2',
                                'info' => '#DBEAFE',
                                'primary' => '#EDE9FE'
                            ];
                            $bg = isset($n['icon']) && isset($bg_color[$n['icon']]) ? $bg_color[$n['icon']] : '#FDF5ED';
                            
                            $text_color = [
                                'success' => '#065F46',
                                'warning' => '#92400E',
                                'danger' => '#991B1B',
                                'info' => '#1E40AF',
                                'primary' => '#5B21B6'
                            ];
                            $color = isset($n['icon']) && isset($text_color[$n['icon']]) ? $text_color[$n['icon']] : 'var(--amber-cream)';
                            ?>
                            <div style="width: 36px; height: 36px; border-radius: 10px; background: <?= $bg; ?>; display: flex; align-items: center; justify-content: center; color: <?= $color; ?>;">
                                <i class="bi <?= $icon_class; ?>" style="font-size: 1rem;"></i>
                            </div>
                        </div>
                        
                        <div style="flex: 1; min-width: 0;">
                            <?php if(isset($n['judul']) && !empty($n['judul'])): ?>
                                <p class="mb-1 small text-dark font-weight-bold" style="line-height: 1.3;"><?= htmlspecialchars($n['judul']); ?></p>
                            <?php endif; ?>
                            <p class="mb-1 small text-dark <?= (isset($n['is_read']) && $n['is_read'] == 0) ? 'font-weight-semibold' : ''; ?>" style="line-height: 1.4;">
                                <?= htmlspecialchars($n['pesan'] ?? $n['isi_notifikasi']); ?>
                            </p>
                            <small class="text-muted d-block" style="font-size: 0.65rem;">
                                <i class="bi bi-clock mr-1"></i>
                                <?= isset($n['created_at']) ? date('d M Y, H:i', strtotime($n['created_at'])) : (isset($n['tanggal_buat']) ? date('d M Y, H:i', strtotime($n['tanggal_buat'])) : ''); ?>
                            </small>
                        </div>
                        
                        <?php if(isset($n['is_read']) && $n['is_read'] == 0): ?>
                            <span class="badge badge-pill" style="background: var(--amber-cream); color: white; font-size: 0.55rem; padding: 3px 8px; align-self: center;">Baru</span>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center text-muted py-5 px-3">
                    <i class="bi bi-bell-slash d-block mb-2" style="font-size: 2.5rem; color: #C0B7B1;"></i>
                    <p class="small mb-0">Tidak ada notifikasi</p>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Footer Dropdown -->
        <div class="p-2 text-center border-top" style="background-color: #FAF6F0; border-color: rgba(74,44,17,0.06);">
            <div class="d-flex justify-content-center gap-3" style="gap: 16px;">
                <?php if($unread_count > 0): ?>
                    <a href="#" id="markAllReadBtn" class="small text-secondary font-weight-bold text-decoration-none" style="font-size: 0.75rem;">
                        <i class="bi bi-check2-all mr-1"></i> Tandai semua dibaca
                    </a>
                    <span class="text-muted" style="font-size: 0.7rem;">|</span>
                <?php endif; ?>
                <a href="<?= base_url('notifikasi/setting'); ?>" class="small text-secondary font-weight-bold text-decoration-none" style="font-size: 0.75rem;">
                    <i class="bi bi-gear-fill mr-1"></i> Pengaturan
                </a>
            </div>
        </div>
    </div>
