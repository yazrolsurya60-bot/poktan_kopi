</div> 
    <!-- END MAIN CONTENT -->

    <!-- TOAST CONTAINER -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- BOOTSTRAP JS -->
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
    
    <!-- GLOBAL SCRIPTS -->
    <script>

        // SIDEBAR TOGGLE
        const sidebar = document.getElementById('sidebarMenu');
        const overlay = document.getElementById('sidebarOverlay');
        const toggleBtn = document.getElementById('sidebarToggle');

        function toggleSidebar() {
            if (sidebar) sidebar.classList.toggle('open');
            if (overlay) overlay.classList.toggle('active');
            document.body.style.overflow = (sidebar && sidebar.classList.contains('open')) ? 'hidden' : '';
        }
        if (toggleBtn) toggleBtn.addEventListener('click', toggleSidebar);
        if (overlay) overlay.addEventListener('click', toggleSidebar);

        document.addEventListener('click', function(e) {
            if (window.innerWidth > 991.98) return;
            if (sidebar && !sidebar.contains(e.target) && toggleBtn && !toggleBtn.contains(e.target)) {
                if (sidebar.classList.contains('open')) toggleSidebar();
            }
        });

        // NOTIFICATION DROPDOWN
        const notifToggle = document.getElementById('notifToggle');
        const notifDropdown = document.getElementById('notifDropdown');

        if (notifToggle) {
            notifToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                if (notifDropdown) notifDropdown.classList.toggle('show');
            });
        }
        document.addEventListener('click', function(e) {
            if (notifDropdown && !notifDropdown.contains(e.target) && notifToggle && !notifToggle.contains(e.target)) {
                notifDropdown.classList.remove('show');
            }
        });

        // MARK ALL READ FUNCTION
        function markAllRead() {
            if (confirm('Tandai semua notifikasi sebagai sudah dibaca?')) {
                $.ajax({
                    url: '<?= base_url('petani/dashboard/mark_all_read_ajax'); ?>',
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

        // TOAST NOTIFICATION FUNCTION
        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            if (!container) return;
            const toast = document.createElement('div');
            toast.className = `toast-item ${type}`;
            toast.textContent = message;
            container.appendChild(toast);
            setTimeout(() => toast.classList.add('show'), 100);
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 400);
            }, 3000);
        }

        // CURRENT DATE TIME UPDATER
        function updateDateTime() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
            const el = document.getElementById('currentDateTime');
            if (el) { el.textContent = '• ' + now.toLocaleDateString('id-ID', options); }
        }
        document.addEventListener('DOMContentLoaded', function() {
            updateDateTime();
            setInterval(updateDateTime, 60000);
        });

        // AUDIO PLAY FUNCTION
        function playNotifSound() {
            const sound = document.getElementById('notifSound');
            if (sound) { 
                sound.currentTime = 0; 
                sound.play().catch(err => console.log('Autoplay prevented:', err)); 
            }
        }

        // REAL-TIME POLLING NOTIFIKASI PETANI (Gaya Admin/Pembeli)
        let currentUnreadCount = <?= isset($unread_count) ? (int)$unread_count : 0; ?>;

        function fetchRealtimeNotifications() {
            $.ajax({
                url: '<?= base_url('api/notifikasi/get'); ?>',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        const newCount = parseInt(response.unread_count || response.unread) || 0;
                        const countEl = $('#notifCount');
                        const notifBtn = $('#notifToggle');
                        const headerTitle = $('#notifHeaderTitle');

                        // Hanya berbunyi jika jumlah notifikasi benar-benar bertambah secara real-time
                        if (newCount > currentUnreadCount) {
                            playNotifSound();
                            notifBtn.addClass('ring');
                            setTimeout(() => notifBtn.removeClass('ring'), 1000);
                        }

                        currentUnreadCount = newCount;
                        if (newCount > 0) {
                            countEl.text(newCount).show();
                            if (headerTitle.length) headerTitle.text(newCount + ' Notifikasi Belum Dibaca');
                        } else {
                            countEl.hide();
                            if (headerTitle.length) headerTitle.text('Semua Notifikasi');
                        }

                        if (response.notifikasi && response.notifikasi.length > 0) {
                            let htmlList = '';
                            const iconMap = { 
                                'success': 'bi-check-circle-fill', 
                                'warning': 'bi-exclamation-triangle-fill', 
                                'danger': 'bi-x-circle-fill', 
                                'info': 'bi-info-circle-fill',
                                'primary': 'bi-star-fill'
                            };

                            response.notifikasi.forEach(n => {
                                const iconType = n.icon || 'info';
                                const iconClass = iconMap[iconType] || 'bi-info-circle-fill';
                                const isUnread = (n.status_baca == 0 || n.status_baca == '0');
                                
                                htmlList += `
                                    <a class="notif-item ${isUnread ? 'unread' : ''}" href="<?= base_url('petani/dashboard/read/'); ?>${n.id_notifikasi}">
                                        <div class="notif-icon ${iconType}">
                                            <i class="bi ${iconClass}"></i>
                                        </div>
                                        <div class="notif-text">
                                            ${n.isi_notifikasi || n.judul || 'Notifikasi'}
                                            <span class="notif-time">${n.tanggal_buat}</span>
                                        </div>
                                        ${isUnread ? '<span class="notif-badge-new">Baru</span>' : ''}
                                    </a>`;
                            });
                            $('#notifList').html(htmlList);
                        }
                    }
                },
                error: function(err) {
                    console.warn('Gagal memuat notifikasi real-time petani');
                }
            });
        }

        setInterval(fetchRealtimeNotifications, 5000);
    </script>
</body>
</html>
