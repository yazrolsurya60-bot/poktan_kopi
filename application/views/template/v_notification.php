<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// 🔴 PASTIKAN $role ADA
if (!isset($role)) {
    $role = $this->session->userdata('role') ?? 'Admin';
}
?>

<!-- 🔔 AUDIO NOTIFIKASI -->
<audio id="notifSound" preload="auto">
    <source src="<?= base_url('assets/sounds/notifikasi.wav'); ?>" type="audio/wav">
</audio>

<!-- NOTIFICATION BELL -->
<div style="position: relative;">
    <button class="notif-btn" id="notifToggle" onclick="toggleNotifDropdown(event)">
        <i class="bi bi-bell" style="font-size: 1.2rem;"></i>
        <?php if (isset($unread_count) && $unread_count > 0): ?>
            <span class="notif-dot" id="notifCount"><?= $unread_count; ?></span>
        <?php else: ?>
            <span class="notif-dot" id="notifCount" style="display:none;">0</span>
        <?php endif; ?>
    </button>

    <!-- NOTIFICATION DROPDOWN - RESPONSIF -->
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
        <div class="notif-dropdown-footer">
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
<style>
/* ============================================ */
/* NOTIFICATION DROPDOWN - RESPONSIF */
/* ============================================ */

.notif-btn {
    position: relative;
    background: var(--card-white, #FFFFFF);
    border: 1px solid rgba(74, 44, 17, 0.06);
    border-radius: 12px;
    padding: 8px 14px;
    color: var(--dark-coffee, #2C1808);
    transition: all 0.2s ease;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
}

.notif-btn:hover {
    background: var(--bg-cream, #FAF6F0);
    box-shadow: 0 2px 12px rgba(74, 44, 17, 0.06);
}

.notif-btn .notif-dot {
    position: absolute;
    top: -4px;
    right: -4px;
    width: 18px;
    height: 18px;
    background: #EF4444;
    border-radius: 50%;
    font-size: 0.6rem;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    border: 2px solid white;
}

.notif-dropdown {
    position: absolute;
    right: 0;
    top: calc(100% + 10px);
    width: 380px;
    max-height: 420px;
    background: var(--card-white, #FFFFFF);
    border-radius: 16px;
    box-shadow: 0 8px 40px rgba(74, 44, 17, 0.12);
    border: 1px solid rgba(74, 44, 17, 0.06);
    overflow: hidden;
    display: none;
    z-index: 9999;
}

.notif-dropdown.show {
    display: block;
    animation: slideDown 0.25s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.notif-dropdown-header {
    padding: 14px 18px;
    border-bottom: 1px solid rgba(74, 44, 17, 0.06);
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: 600;
    font-size: 0.85rem;
}

.notif-dropdown-header a {
    font-size: 0.7rem;
    color: #E6A15C;
    font-weight: 500;
    text-decoration: none;
}

.notif-dropdown-header a:hover {
    text-decoration: underline;
}

.notif-dropdown-list {
    max-height: 280px;
    overflow-y: auto;
    overflow-x: hidden;
}

.notif-dropdown-footer {
    padding: 10px 16px;
    text-align: center;
    border-top: 1px solid rgba(74, 44, 17, 0.06);
    background: #FAF6F0;
}

.notif-item {
    padding: 12px 16px;
    border-bottom: 1px solid rgba(74, 44, 17, 0.04);
    display: flex;
    align-items: flex-start;
    gap: 12px;
    transition: all 0.2s ease;
    cursor: pointer;
    text-decoration: none;
    color: inherit;
}

.notif-item:hover {
    background: #FAF6F0;
    text-decoration: none;
    color: inherit;
}

.notif-item .notif-icon {
    width: 36px;
    height: 36px;
    min-width: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
}

.notif-item .notif-icon.success {
    background: #D1FAE5;
    color: #065F46;
}
.notif-item .notif-icon.warning {
    background: #FEF3C7;
    color: #92400E;
}
.notif-item .notif-icon.info {
    background: #DBEAFE;
    color: #1E40AF;
}
.notif-item .notif-icon.danger {
    background: #FEE2E2;
    color: #991B1B;
}

.notif-item .notif-text {
    flex: 1;
    font-size: 0.82rem;
    min-width: 0;
}

.notif-item .notif-text .notif-time {
    font-size: 0.65rem;
    color: #70655E;
    display: block;
    margin-top: 2px;
}

.notif-item.unread {
    background: rgba(230, 161, 92, 0.05);
}

.notif-item.unread .notif-text {
    font-weight: 600;
}

.notif-badge-new {
    background: #E6A15C;
    color: white;
    font-size: 0.5rem;
    padding: 2px 8px;
    border-radius: 10px;
    align-self: center;
    flex-shrink: 0;
}

/* ============================================ */
/* RESPONSIF - HP & TABLET */
/* ============================================ */

/* TABLET (768px - 1024px) */
@media (max-width: 1024px) {
    .notif-dropdown {
        width: 350px;
        right: 0;
        max-height: 400px;
    }
}

/* HP LARGE (576px - 768px) */
@media (max-width: 768px) {
    .notif-dropdown {
        width: calc(100vw - 30px);
        right: -10px;
        max-height: 380px;
        left: auto;
        min-width: unset;
        border-radius: 14px;
        top: calc(100% + 8px);
    }
    
    .notif-dropdown-header {
        padding: 12px 14px;
        font-size: 0.78rem;
    }
    
    .notif-dropdown-header a {
        font-size: 0.65rem;
    }
    
    .notif-item {
        padding: 10px 12px;
        gap: 10px;
    }
    
    .notif-item .notif-icon {
        width: 30px;
        height: 30px;
        min-width: 30px;
        font-size: 0.75rem;
    }
    
    .notif-item .notif-text {
        font-size: 0.75rem;
    }
    
    .notif-item .notif-text .notif-time {
        font-size: 0.6rem;
    }
    
    .notif-badge-new {
        font-size: 0.45rem;
        padding: 2px 6px;
    }
    
    .notif-dropdown-footer {
        padding: 8px 12px;
        font-size: 0.7rem;
    }
    
    .notif-dropdown-list {
        max-height: 250px;
    }
}

/* HP KECIL (di bawah 480px) */
@media (max-width: 480px) {
    .notif-dropdown {
        width: calc(100vw - 16px);
        right: -4px;
        max-height: 350px;
        border-radius: 12px;
        top: calc(100% + 6px);
        box-shadow: 0 4px 24px rgba(74, 44, 17, 0.15);
    }
    
    .notif-dropdown-header {
        padding: 10px 12px;
        font-size: 0.7rem;
        flex-wrap: wrap;
        gap: 4px;
    }
    
    .notif-dropdown-header span {
        font-size: 0.7rem;
    }
    
    .notif-dropdown-header a {
        font-size: 0.6rem;
    }
    
    .notif-dropdown-header div {
        display: flex;
        gap: 6px;
        align-items: center;
    }
    
    .notif-item {
        padding: 8px 10px;
        gap: 8px;
    }
    
    .notif-item .notif-icon {
        width: 26px;
        height: 26px;
        min-width: 26px;
        font-size: 0.65rem;
    }
    
    .notif-item .notif-text {
        font-size: 0.68rem;
        line-height: 1.3;
    }
    
    .notif-item .notif-text .notif-time {
        font-size: 0.55rem;
        margin-top: 1px;
    }
    
    .notif-badge-new {
        font-size: 0.4rem;
        padding: 1px 5px;
    }
    
    .notif-dropdown-footer {
        padding: 6px 10px;
        font-size: 0.65rem;
    }
    
    .notif-dropdown-footer a {
        font-size: 0.6rem;
    }
    
    /* Tombol notifikasi di HP */
    .notif-btn {
        padding: 6px 10px;
        border-radius: 10px;
        gap: 4px;
    }
    
    .notif-btn i {
        font-size: 1rem !important;
    }
    
    .notif-btn .notif-dot {
        width: 16px;
        height: 16px;
        font-size: 0.5rem;
        top: -3px;
        right: -3px;
        border-width: 1.5px;
    }
}

/* HP SANGAT KECIL (di bawah 360px) */
@media (max-width: 360px) {
    .notif-dropdown {
        width: calc(100vw - 12px);
        right: -2px;
        max-height: 300px;
        border-radius: 10px;
        top: calc(100% + 4px);
    }
    
    .notif-dropdown-header {
        padding: 8px 10px;
        font-size: 0.6rem;
    }
    
    .notif-dropdown-header span {
        font-size: 0.6rem;
    }
    
    .notif-dropdown-header a {
        font-size: 0.55rem;
    }
    
    .notif-item {
        padding: 6px 8px;
        gap: 6px;
    }
    
    .notif-item .notif-icon {
        width: 22px;
        height: 22px;
        min-width: 22px;
        font-size: 0.55rem;
    }
    
    .notif-item .notif-text {
        font-size: 0.6rem;
    }
    
    .notif-item .notif-text .notif-time {
        font-size: 0.5rem;
    }
    
    .notif-dropdown-list {
        max-height: 200px;
    }
    
    .notif-badge-new {
        font-size: 0.35rem;
        padding: 1px 4px;
    }
    
    .notif-btn {
        padding: 4px 8px;
        border-radius: 8px;
    }
    
    .notif-btn i {
        font-size: 0.85rem !important;
    }
    
    .notif-btn .notif-dot {
        width: 14px;
        height: 14px;
        font-size: 0.4rem;
        top: -2px;
        right: -2px;
        border-width: 1px;
    }
}

/* ============================================ */
/* ANIMASI */
/* ============================================ */

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

/* ============================================ */
/* SCROLLBAR CUSTOM */
/* ============================================ */

.notif-dropdown-list::-webkit-scrollbar {
    width: 3px;
}

.notif-dropdown-list::-webkit-scrollbar-track {
    background: transparent;
}

.notif-dropdown-list::-webkit-scrollbar-thumb {
    background: rgba(230, 161, 92, 0.3);
    border-radius: 10px;
}

/* Firefox scrollbar */
.notif-dropdown-list {
    scrollbar-width: thin;
    scrollbar-color: rgba(230, 161, 92, 0.3) transparent;
}
</style>

<script>
// ============================================
// 1. TOGGLE DROPDOWN - SUPPORT TOUCH
// ============================================
function toggleNotifDropdown(event) {
    if (event) {
        event.stopPropagation();
        event.preventDefault();
    }
    var dropdown = document.getElementById('notifDropdown');
    if (dropdown) {
        dropdown.classList.toggle('show');
    }
}

// ============================================
// 2. TUTUP DROPDOWN SAAT KLIK DI LUAR
// ============================================
document.addEventListener('click', function(e) {
    var dropdown = document.getElementById('notifDropdown');
    var toggle = document.getElementById('notifToggle');
    
    if (dropdown && toggle) {
        if (!dropdown.contains(e.target) && !toggle.contains(e.target)) {
            dropdown.classList.remove('show');
        }
    }
});

// ============================================
// 3. TUTUP DROPDOWN SAAT SCROLL DI HP
// ============================================
var touchStartY = 0;
document.addEventListener('touchstart', function(e) {
    var dropdown = document.getElementById('notifDropdown');
    var toggle = document.getElementById('notifToggle');
    
    if (dropdown && toggle) {
        if (!dropdown.contains(e.target) && !toggle.contains(e.target)) {
            dropdown.classList.remove('show');
        }
    }
}, { passive: true });

// ============================================
// 4. PLAY NOTIFICATION SOUND
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
// 5. AUTO-REFRESH NOTIFICATION COUNT
// ============================================
var lastUnreadCount = <?= isset($unread_count) ? $unread_count : 0; ?>;

function refreshNotificationCount() {
    var role = '<?= $role ?? $this->session->userdata('role') ?? 'Admin'; ?>';
    
    $.get('<?= base_url() ?>' + role + '/dashboard/get_notifications_ajax', function(response) {
        if (response.success) {
            var currentCount = response.unread;
            var countEl = document.getElementById('notifCount');
            var notifBtn = document.getElementById('notifToggle');
            
            if (countEl) {
                if (currentCount > 0) {
                    countEl.textContent = currentCount;
                    countEl.style.display = 'flex';
                    
                    if (currentCount > lastUnreadCount) {
                        playNotifSound();
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
// 6. MARK ALL READ
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

console.log('🔔 Notifikasi responsif siap digunakan!');
console.log('📱 Support semua ukuran layar');
</script>
