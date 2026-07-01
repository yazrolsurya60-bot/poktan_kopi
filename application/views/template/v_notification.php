<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// 🔴 PASTIKAN $role ADA
if (!isset($role)) {
    $role = $this->session->userdata('role') ?? 'Admin';
}
?>

<!-- 🔔 AUDIO NOTIFIKASI -->
<audio id="notifSound" preload="auto">
    <source src="<?= base_url('assets/sounds/notifikasi.mav'); ?>" type="audio/mpeg">
</audio>

<!-- NOTIFICATION BELL -->
<div style="position: relative;">
    <button class="notif-btn" id="notifToggle" onclick="toggleNotifDropdown()">
        <i class="bi bi-bell" style="font-size: 1.2rem;"></i>
        <?php if (isset($unread_count) && $unread_count > 0): ?>
            <span class="notif-dot" id="notifCount"><?= $unread_count; ?></span>
        <?php else: ?>
            <span class="notif-dot" id="notifCount" style="display:none;">0</span>
        <?php endif; ?>
    </button>

    <!-- NOTIFICATION DROPDOWN -->
    <div class="notif-dropdown" id="notifDropdown">
        <div class="notif-dropdown-header">
            <span>
                <?= (isset($unread_count) && $unread_count > 0) ? $unread_count . ' Notifikasi Belum Dibaca' : 'Semua Notifikasi'; ?>
            </span>
            <div>
                <?php if (isset($unread_count) && $unread_count > 0): ?>
                    <a href="#" id="markAllReadBtn" class="mr-2"
                        style="font-size:0.7rem; text-decoration:none;">Tandai semua</a>
                <?php endif; ?>
                <a href="<?= base_url($role . '/dashboard/history'); ?>"
                    style="font-size:0.7rem; text-decoration:none;">Lihat Semua</a>
            </div>
        </div>
        <div class="notif-dropdown-list" id="notifList">
            <?php if (!empty($notifikasi)): ?>
                <?php foreach ($notifikasi as $n): ?>
                    <a class="notif-item <?= (isset($n['status_baca']) && $n['status_baca'] == '0') ? 'unread' : ''; ?>"
                        href="<?= base_url($role . '/dashboard/read/' . $n['id_notifikasi']); ?>">
                        <?php
                        $icon_type = $n['icon'] ?? 'info';
                        $icon_map = [
                            'success' => 'bi-check-circle-fill',
                            'warning' => 'bi-exclamation-triangle-fill',
                            'danger' => 'bi-x-circle-fill',
                            'info' => 'bi-info-circle-fill'
                        ];
                        $icon_class = $icon_map[$icon_type] ?? 'bi-info-circle-fill';
                        ?>
                        <div class="notif-icon <?= $icon_type; ?>">
                            <i class="bi <?= $icon_class; ?>"></i>
                        </div>
                        <div class="notif-text">
                            <?= htmlspecialchars($n['isi_notifikasi']); ?>
                            <span class="notif-time"><?= date('d M Y, H:i', strtotime($n['tanggal_buat'])); ?></span>
                        </div>
                        <?php if (isset($n['status_baca']) && $n['status_baca'] == '0'): ?>
                            <span class="notif-badge-new">Baru</span>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center text-muted py-5 px-3">
                    <i class="bi bi-bell-slash d-block mb-2" style="font-size:2rem;"></i>
                    <p class="small mb-0">Tidak ada notifikasi</p>
                </div>
            <?php endif; ?>
        </div>
        <div class="p-2 text-center border-top"
            style="background:#FAF6F0; border-color:rgba(74,44,17,0.06);">
            <a href="<?= base_url($role . '/dashboard/settings'); ?>"
                class="small text-secondary font-weight-bold text-decoration-none">
                <i class="bi bi-gear-fill mr-1"></i> Pengaturan Notifikasi
            </a>
        </div>
    </div>
</div>

<!-- ============================================ -->
<!-- 🔔 SCRIPT NOTIFIKASI DENGAN SUARA -->
<!-- ============================================ -->
<script>
// ============================================
// 1. TOGGLE DROPDOWN
// ============================================
function toggleNotifDropdown() {
    var dropdown = document.getElementById('notifDropdown');
    if (dropdown) {
        dropdown.classList.toggle('show');
    }
}

// ============================================
// 2. PLAY NOTIFICATION SOUND
// ============================================
function playNotifSound() {
    var audio = document.getElementById('notifSound');
    if (audio) {
        audio.currentTime = 0;
        audio.play().catch(function(e) {
            console.log('🔇 Sound play error:', e.message);
        });
    }
}

// ============================================
// 3. AUTO-REFRESH NOTIFICATION COUNT
// ============================================
var lastUnreadCount = <?= isset($unread_count) ? $unread_count : 0; ?>;

function refreshNotificationCount() {
    var role = '<?= $role ?? $this->session->userdata('role') ?? 'Admin'; ?>';
    
    $.get('<?= base_url() ?>' + role + '/dashboard/get_notifications_ajax', function(response) {
        if (response.success) {
            var currentCount = response.unread;
            var countEl = document.getElementById('notifCount');
            var notifBtn = document.getElementById('notifToggle');
            
            // Update badge
            if (countEl) {
                if (currentCount > 0) {
                    countEl.textContent = currentCount;
                    countEl.style.display = 'flex';
                    
                    // 🔔 PLAY SOUND JIKA ADA NOTIFIKASI BARU
                    if (currentCount > lastUnreadCount) {
                        playNotifSound();
                        
                        // Efek lonceng bergetar
                        if (notifBtn) {
                            notifBtn.classList.add('ring');
                            setTimeout(function() {
                                notifBtn.classList.remove('ring');
                            }, 600);
                        }
                    }
                } else {
                    countEl.style.display = 'none';
                }
            }
            
            lastUnreadCount = currentCount;
        }
    }).fail(function() {
        console.log('⚠️ Gagal refresh notifikasi');
    });
}

// Refresh notifikasi setiap 30 detik
setInterval(refreshNotificationCount, 30000);

// ============================================
// 4. MARK ALL READ
// ============================================
document.getElementById('markAllReadBtn')?.addEventListener('click', function(e) {
    e.preventDefault();
    var role = '<?= $role ?? $this->session->userdata('role') ?? 'Admin'; ?>';
    
    if (confirm('Tandai semua notifikasi sebagai sudah dibaca?')) {
        $.ajax({
            url: '<?= base_url() ?>' + role + '/dashboard/mark_all_read_ajax',
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
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

// ============================================
// 5. TAMBAHKAN ANIMASI CSS
// ============================================
document.addEventListener('DOMContentLoaded', function() {
    var style = document.createElement('style');
    style.textContent = `
        @keyframes pulse-dot {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.4); }
        }
        
        @keyframes bellRing {
            0%, 100% { transform: rotate(0); }
            25% { transform: rotate(10deg); }
            50% { transform: rotate(-10deg); }
            75% { transform: rotate(5deg); }
        }
        
        .notif-btn.ring {
            animation: bellRing 0.5s ease 1;
        }
    `;
    document.head.appendChild(style);
});

console.log('🔔 Notifikasi dengan suara siap digunakan!');
console.log('📋 Notifikasi akan di-refresh setiap 30 detik');
</script>
