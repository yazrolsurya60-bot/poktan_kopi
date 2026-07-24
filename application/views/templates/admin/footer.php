</div> 
    <!-- Tag Penutup Global .main-content -->

    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- PWA Service Worker Registration -->
    <script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('<?= base_url('pwa/service_worker') ?>')
                .then(function(registration) {
                    console.log('[LiberChain PWA] ServiceWorker registered:', registration.scope);
                })
                .catch(function(error) {
                    console.warn('[LiberChain PWA] ServiceWorker registration failed:', error);
                });
        });
    }
    </script>
    
    <script>
        // ============================================
        // 1. SIDEBAR TOGGLE
        // ============================================
        const sidebar = document.getElementById('sidebarMenu');
        const overlay = document.getElementById('sidebarOverlay');
        const toggleBtn = document.getElementById('sidebarToggle');

        function toggleSidebar() {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
            document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
        }

        if (toggleBtn) toggleBtn.addEventListener('click', toggleSidebar);
        if (overlay) overlay.addEventListener('click', toggleSidebar);

        document.addEventListener('click', function(e) {
            if (window.innerWidth > 991.98) return;
            if (!sidebar.contains(e.target) && toggleBtn && !toggleBtn.contains(e.target)) {
                if (sidebar.classList.contains('open')) toggleSidebar();
            }
        });

        // ============================================
        // 2. NOTIFICATION DROPDOWN
        // ============================================
        const notifToggle = document.getElementById('notifToggle');
        const notifDropdown = document.getElementById('notifDropdown');

        if (notifToggle) {
            notifToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                notifDropdown.classList.toggle('show');
            });
        }

        document.addEventListener('click', function(e) {
            if (notifDropdown && !notifDropdown.contains(e.target) && !notifToggle.contains(e.target)) {
                notifDropdown.classList.remove('show');
            }
        });

        // ============================================
        // 3. MARK ALL READ
        // ============================================
        function markAllRead() {
            if (confirm('Tandai semua notifikasi sebagai sudah dibaca?')) {
                $.ajax({
                    url: '<?= base_url('api/notifikasi/mark_all_read'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) location.reload();
                        else alert('Gagal menandai semua notifikasi.');
                    },
                    error: function() {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                });
            }
        }

        document.getElementById('markAllReadBtn')?.addEventListener('click', function(e) {
            e.preventDefault();
            markAllRead();
        });

        // ============================================
        // 4. REAL-TIME NOTIFICATION & SOUND EFFECT
        // ============================================
        let currentUnreadCount = <?= isset($unread_count) ? (int)$unread_count : 0; ?>;

        function playNotifSound() {
            const audio = document.getElementById('notifSound');
            if (audio) {
                audio.currentTime = 0;
                let promise = audio.play();
                if (promise !== undefined) {
                    promise.catch(function(e) {
                        console.log('Autoplay ditahan browser');
                    });
                }
            }
        }

        function fetchRealtimeNotifications() {
            $.ajax({
                url: '<?= base_url("api/notifikasi/get"); ?>',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        const newCount = parseInt(response.unread) || 0;
                        const countEl = $('#notifCount');
                        const notifBtn = $('#notifToggle');

                        if (newCount > currentUnreadCount) {
                            playNotifSound();
                            notifBtn.addClass('ring');
                            setTimeout(function() {
                                notifBtn.removeClass('ring');
                            }, 1000);
                        }

                        currentUnreadCount = newCount;
                        if (newCount > 0) {
                            countEl.text(newCount).show();
                        } else {
                            countEl.text(0).hide();
                        }

                        if (response.notifikasi && response.notifikasi.length > 0) {
                            let htmlList = '';
                            $.each(response.notifikasi, function(i, n) {
                                let iconType = n.icon || 'info';
                                let iconMap = {
                                    'success': 'bi-check-circle-fill',
                                    'warning': 'bi-exclamation-triangle-fill',
                                    'danger':  'bi-x-circle-fill',
                                    'info':    'bi-info-circle-fill',
                                    'primary': 'bi-star-fill'
                                };
                                let iconClass = iconMap[iconType] || 'bi-info-circle-fill';

                                htmlList += `
                                    <a class="notif-item ${n.status_baca == '0' ? 'unread' : ''}" href="<?= base_url('admin/dashboard/read/'); ?>${n.id_notifikasi}">
                                        <div class="notif-icon ${iconType}">
                                            <i class="bi ${iconClass}"></i>
                                        </div>
                                        <div class="notif-text">
                                            ${n.isi_notifikasi || n.judul || 'Notifikasi'}
                                            <span class="notif-time">${n.tanggal_buat}</span>
                                        </div>
                                        ${n.status_baca == '0' ? '<span class="notif-badge-new">Baru</span>' : ''}
                                    </a>
                                `;
                            });
                            $('#notifList').html(htmlList);
                        }
                    }
                },
                error: function(err) {
                    console.warn('Gagal memuat notifikasi real-time');
                }
            });
        }

        setInterval(fetchRealtimeNotifications, 5000);
    </script>
</body>

</html>
