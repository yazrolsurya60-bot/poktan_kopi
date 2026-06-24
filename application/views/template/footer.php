</div>
<!-- END MAIN CONTENT -->

<!-- ============================================
     SCRIPTS
     ============================================ -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    $(document).ready(function() {

        // ============================================
        // 1. SIDEBAR TOGGLE (Responsive)
        // ============================================
        const sidebar = document.getElementById('sidebarMenu');
        const overlay = document.getElementById('sidebarOverlay');
        const toggleBtn = document.getElementById('sidebarToggle');

        function toggleSidebar() {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
            document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
        }

        if (toggleBtn) {
            toggleBtn.addEventListener('click', toggleSidebar);
        }
        if (overlay) {
            overlay.addEventListener('click', toggleSidebar);
        }

        // Tutup sidebar saat klik di luar (mobile)
        document.addEventListener('click', function(e) {
            if (window.innerWidth > 991.98) return;
            if (!sidebar.contains(e.target) && toggleBtn && !toggleBtn.contains(e.target)) {
                if (sidebar.classList.contains('open')) {
                    toggleSidebar();
                }
            }
        });

        // ============================================
        // 2. NOTIFICATION DROPDOWN TOGGLE
        // ============================================
        const notifToggle = document.getElementById('notifToggle');
        const notifDropdown = document.getElementById('notifDropdown');

        if (notifToggle && notifDropdown) {
            notifToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                notifDropdown.classList.toggle('show');
            });

            document.addEventListener('click', function(e) {
                if (!notifDropdown.contains(e.target) && !notifToggle.contains(e.target)) {
                    notifDropdown.classList.remove('show');
                }
            });
        }

        // ============================================
        // 3. MARK ALL READ via AJAX
        // ============================================
        $('#markAllReadBtn').on('click', function(e) {
            e.preventDefault();
            if (confirm('Tandai semua notifikasi sebagai sudah dibaca?')) {
                $.ajax({
                    url: '<?= base_url('api/notifikasi/mark_all_read'); ?>',
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
        // 4. UPDATE CURRENT DATE TIME
        // ============================================
        function updateDateTime() {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            const el = document.getElementById('currentDateTime');
            if (el) {
                el.textContent = '• ' + now.toLocaleDateString('id-ID', options);
            }
        }
        updateDateTime();
        setInterval(updateDateTime, 60000);

        // ============================================
        // 5. INISIALISASI CHART (jika ada di halaman)
        // ============================================
        // Fungsi ini akan dipanggil dari view jika diperlukan
        // Contoh: initChart() di dashboard masing-masing

        // ============================================
        // 6. REFRESH NOTIFIKASI (opsional, setiap 60 detik)
        // ============================================
        // function refreshNotifications() {
        //     $.ajax({
        //         url: '<?= base_url('api/notifikasi/get'); ?>',
        //         type: 'GET',
        //         dataType: 'json',
        //         success: function(response) {
        //             if (response.success && response.unread > 0) {
        //                 $('#notifCount').text(response.unread).show();
        //             } else {
        //                 $('#notifCount').hide();
        //             }
        //         }
        //     });
        // }
        // setInterval(refreshNotifications, 60000);

        console.log('✅ Template loaded. Role: <?= $role ?? 'guest' ?>');
    });
</script>

</body>
</html>