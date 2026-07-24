
		<!-- MAIN BODY CONTENT -->
		<div class="card border-0 shadow-sm rounded-4" style="border-radius: 14px; background: #fff;">
			<div class="card-body p-4">
				<!-- HEADER -->
				<div class="d-flex align-items-center mb-4">
					<a href="<?= base_url('admin/petani'); ?>" class="btn btn-light rounded-circle mr-3 d-flex justify-content-center align-items-center" style="width: 40px; height: 40px; border: 1px solid #e0e0e0;">
						<i class="bi bi-arrow-left text-dark"></i>
					</a>
					<div>
						<h4 class="mb-0 fw-bold" style="font-weight: 700;">Filter & Cetak Data Petani</h4>
						<small class="text-muted">Pilih parameter filter sebelum mengunduh berkas laporan</small>
					</div>
				</div>

				<form action="<?= base_url('admin/petani/export_pdf'); ?>" method="GET" target="_blank">
					<div class="row gx-4">
						<div class="col-md-4 mb-3">
							<label class="form-label" style="font-size: 0.85rem; font-weight: 600;">Status Petani</label>
							<select name="status" class="form-control custom-select rounded-3 py-2" style="border-radius: 8px;">
								<option value="">-- Semua Status --</option>
								<option value="Active">Active</option>
								<option value="Inactive">Inactive</option>
								<option value="Suspended">Suspended</option>
							</select>
						</div>

						<div class="col-md-4 mb-3">
							<label class="form-label" style="font-size: 0.85rem; font-weight: 600;">Wilayah</label>
							<select name="id_wilayah" class="form-control custom-select rounded-3 py-2" style="border-radius: 8px;">
								<option value="">-- Semua Wilayah --</option>
								<?php if (!empty($semua_wilayah)): ?>
									<?php foreach ($semua_wilayah as $w): ?>
										<option value="<?= $w['id_wilayah']; ?>"><?= htmlspecialchars($w['nama_wilayah']); ?></option>
									<?php endforeach; ?>
								<?php endif; ?>
							</select>
						</div>

						<div class="col-md-4 mb-3">
							<label class="form-label" style="font-size: 0.85rem; font-weight: 600;">Format Laporan</label>
							<select name="format" class="form-control custom-select rounded-3 py-2" style="border-radius: 8px;">
								<option value="pdf">PDF Document (.pdf)</option>
								<option value="excel">Excel Spreadsheet (.xlsx)</option>
							</select>
						</div>
					</div>

					<div class="mt-4 d-flex justify-content-end gap-3 border-top pt-4" style="gap: 10px;">
						<a href="<?= base_url('admin/petani'); ?>" class="btn btn-light px-4 py-2 border fw-bold" style="color: #6c757d; border-radius: 8px; font-weight: 600;">Batal</a>
						<button type="submit" class="btn px-4 py-2 fw-bold text-white shadow-sm" style="background-color: var(--roasted-brown, #4A2C11); border-radius: 8px; font-weight: 600;">
							<i class="bi bi-download mr-2"></i> Export Data
						</button>
					</div>
				</form>
			</div>
		</div>
<<<<<<< HEAD

		<!-- ================================================================= -->
		<!-- JIKA YANG DIKLIK BUKAN KURIR (MENU UTAMA), TAMPILKAN DASHBOARD ASLI -->
		<!-- ================================================================= -->
	<?php else: ?>

		<!-- Pindahkan / Biarkan seluruh kode isi dashboard asli kelompokmu berada di sini -->
		<!-- (Mulai dari KPI Card, Grafik, Ringkasan, Form Notif dll milik timmu) -->

	<?php endif; ?>
	<?php $this->load->view('admin/layout/sidebar'); ?>

	<!-- MAIN CONTENT -->
	<div class="main-content">
		<!-- PAGE HEADER -->
		<div class="page-header d-flex justify-content-between align-items-center flex-wrap">
			<div>
				<button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle"
					style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
					<i class="bi bi-list"></i>
				</button>
				<h2 class="d-inline-block align-middle mb-0">Manajemen Petani</h2>
				<p class="subtitle mb-0 mt-1 text-muted">Dashboard / Manajemen Petani / Export</p>
			</div>
			<div class="d-flex align-items-center gap-3" style="gap: 12px;">
				<!-- NOTIFICATION BELL -->
				<div style="position: relative;">
					<button class="notif-btn" id="notifToggle">
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
								<?= isset($unread_count) && $unread_count > 0 ? $unread_count . ' Notifikasi Belum Dibaca' : 'Semua Notifikasi'; ?>
							</span>
							<div>
								<?php if (isset($unread_count) && $unread_count > 0): ?>
									<a href="#" id="markAllReadBtn" class="mr-2"
										style="font-size:0.7rem; text-decoration:none;">Tandai semua</a>
								<?php endif; ?>
								<a href="<?= base_url('admin/dashboard/history'); ?>"
									style="font-size:0.7rem; text-decoration:none;">Lihat Semua</a>
							</div>
						</div>
						<div class="notif-dropdown-list" id="notifList">
							<?php if (!empty($notifikasi)): ?>
								<?php foreach ($notifikasi as $n): ?>
									<a class="notif-item <?= (isset($n['status_baca']) && $n['status_baca'] == '0') ? 'unread' : ''; ?>"
										href="<?= base_url('admin/dashboard/read/' . $n['id_notifikasi']); ?>">
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
											<span
												class="notif-time"><?= date('d M Y, H:i', strtotime($n['tanggal_buat'])); ?></span>
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
							<a href="<?= base_url('admin/dashboard/settings'); ?>"
								class="small text-secondary font-weight-bold text-decoration-none">
								<i class="bi bi-gear-fill mr-1"></i> Pengaturan Notifikasi
							</a>
						</div>
					</div>
				</div>
				<!-- USER AVATAR -->
				<div class="d-flex align-items-center gap-2"
					style="cursor: pointer; padding: 6px 12px; border-radius: 10px; background: var(--card-white); border: 1px solid rgba(74,44,17,0.06);">
					<i class="bi bi-person-circle" style="font-size: 1.5rem; color: var(--amber-cream);"></i>
					<span style="font-weight:500; font-size:0.85rem;">Admin</span>
				</div>
			</div>
		</div>

		
<!-- MAIN BODY CONTENT -->
<div class="page-body d-flex justify-content-center" style="padding: 24px; background-color: #f8f9fa; min-height: calc(100vh - 80px);">
<div style="width: 100%; max-width: 500px; margin-top: 2rem;">
    <!-- HEADER -->
    <div class="d-flex align-items-center mb-4">
        <a href="<?= base_url('admin/petani'); ?>" class="btn btn-light rounded-circle me-3 d-flex justify-content-center align-items-center" style="width: 40px; height: 40px; border: 1px solid #e0e0e0;">
            <i class="bi bi-arrow-left text-dark"></i>
        </a>
        <div>
            <h4 class="mb-0 fw-bold">Export Data Petani</h4>
            <small class="text-muted">Dashboard / Manajemen Petani / Export</small>
        </div>
    </div>

    <!-- Flash Message -->
    <?php if ($this->session->flashdata('pesan')): ?>
    <div class="alert alert-success rounded-3 mb-3"><?= $this->session->flashdata('pesan'); ?></div>
    <?php endif; ?>

    <!-- KARTU EXPORT -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-5 text-center">
            <div class="mb-3" style="font-size: 3rem; color: #4CAF50;">
                <i class="bi bi-file-earmark-spreadsheet"></i>
            </div>
            <h5 class="fw-bold">Export Data Petani</h5>
            <p class="text-muted small mb-4">Pilih format file yang ingin di-export</p>
            
            <form action="<?= base_url('admin/petani/export_process'); ?>" method="POST" class="text-start">
                <div class="mb-3">
                    <label class="border rounded-3 p-3 w-100 d-flex align-items-center gap-3" style="cursor: pointer; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f0faf0'" onmouseout="this.style.backgroundColor=''">
                        <input type="radio" name="format" value="excel" checked class="form-check-input mt-0" style="transform: scale(1.2);">
                        <i class="bi bi-file-earmark-excel-fill text-success fs-4"></i>
                        <div>
                            <span class="fw-bold d-block">Excel (.xls)</span>
                            <small class="text-muted">Download spreadsheet yang bisa dibuka di Microsoft Excel</small>
                        </div>
                    </label>
                </div>
                <div class="mb-4">
                    <label class="border rounded-3 p-3 w-100 d-flex align-items-center gap-3" style="cursor: pointer; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#fff5f5'" onmouseout="this.style.backgroundColor=''">
                        <input type="radio" name="format" value="pdf" class="form-check-input mt-0" style="transform: scale(1.2);">
                        <i class="bi bi-file-earmark-pdf-fill text-danger fs-4"></i>
                        <div>
                            <span class="fw-bold d-block">PDF (.pdf)</span>
                            <small class="text-muted">Buka halaman cetak PDF di tab baru</small>
                        </div>
                    </label>
                </div>

                <div class="d-flex gap-3 mt-4">
                    <a href="<?= base_url('admin/petani'); ?>" class="btn btn-light px-4 py-2 rounded-3 border fw-bold w-50" style="color: #6c757d;">Batal</a>
                    <button type="submit" class="btn px-4 py-2 rounded-3 fw-bold text-white shadow-sm w-50" style="background-color: #6d4c41;">
                        <i class="bi bi-download me-2"></i>Export
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
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

		if (toggleBtn) {
			toggleBtn.addEventListener('click', toggleSidebar);
		}
		if (overlay) {
			overlay.addEventListener('click', toggleSidebar);
		}

		document.addEventListener('click', function (e) {
			if (window.innerWidth > 991.98) return;
			if (!sidebar.contains(e.target) && toggleBtn && !toggleBtn.contains(e.target)) {
				if (sidebar.classList.contains('open')) {
					toggleSidebar();
				}
			}
		});

		// ============================================
		// 2. NOTIFICATION DROPDOWN (M11-F01)
		// ============================================
		const notifToggle = document.getElementById('notifToggle');
		const notifDropdown = document.getElementById('notifDropdown');

		if (notifToggle) {
			notifToggle.addEventListener('click', function (e) {
				e.stopPropagation();
				notifDropdown.classList.toggle('show');
			});
		}

		document.addEventListener('click', function (e) {
			if (notifDropdown && !notifDropdown.contains(e.target) && !notifToggle.contains(e.target)) {
				notifDropdown.classList.remove('show');
			}
		});

		// ============================================
		// 3. MARK ALL READ (M11-F03)
		// ============================================
		function markAllRead() {
			if (confirm('Tandai semua notifikasi sebagai sudah dibaca?')) {
				$.ajax({
					url: '<?= base_url('admin/dashboard/mark_all_read_ajax'); ?>',
					type: 'POST',
					dataType: 'json',
					success: function (response) {
						if (response.success) {
							location.reload();
						} else {
							alert('Gagal menandai semua notifikasi.');
						}
					},
					error: function () {
						alert('Terjadi kesalahan. Silakan coba lagi.');
					}
				});
			}
		}

		$('#markAllReadBtn').on('click', function (e) {
			e.preventDefault();
			markAllRead();
		});

		// ============================================
		// 4. CHART.JS - GRAFIK PENJUALAN (M10-F02)
		// ============================================
		let salesChart;

		function initChart() {
			const ctx = document.getElementById('salesChart')?.getContext('2d');
			if (!ctx) return;

			const chartData = <?= isset($grafik_penjualan['values']) ? json_encode($grafik_penjualan['values']) : json_encode([120, 150, 180, 140, 200, 230, 210, 250, 270, 240, 300, 280]); ?>;
			const chartLabels = <?= isset($grafik_penjualan['labels']) ? json_encode($grafik_penjualan['labels']) : json_encode(['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des']); ?>;

			salesChart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: chartLabels,
					datasets: [{
						label: 'Penjualan (Kg)',
						data: chartData,
						borderColor: '#E6A15C',
						backgroundColor: 'rgba(230, 161, 92, 0.08)',
						fill: true,
						tension: 0.4,
						pointBackgroundColor: '#E6A15C',
						pointBorderColor: '#FFFFFF',
						pointBorderWidth: 2,
						pointRadius: 4,
						pointHoverRadius: 7,
						borderWidth: 2.5
					}]
				},
				options: {
					responsive: true,
					maintainAspectRatio: false,
					plugins: {
						legend: {
							display: false
						},
						tooltip: {
							backgroundColor: '#2C1808',
							titleColor: '#E6A15C',
							bodyColor: '#FAF6F0',
							cornerRadius: 8,
							padding: 10,
							callbacks: {
								label: function (context) {
									return context.parsed.y + ' kg';
								}
							}
						}
					},
					scales: {
						y: {
							beginAtZero: true,
							grid: {
								color: 'rgba(74, 44, 17, 0.06)',
								drawBorder: false,
							},
							ticks: {
								font: {
									size: 10,
									family: 'Plus Jakarta Sans'
								},
								color: '#70655E',
								stepSize: 50,
								callback: function (value) {
									return value + ' kg';
								}
							}
						},
						x: {
							grid: {
								display: false
							},
							ticks: {
								font: {
									size: 10,
									family: 'Plus Jakarta Sans'
								},
								color: '#70655E',
							}
						}
					},
					interaction: {
						intersect: false,
						mode: 'index'
					}
				}
			});
		}

		function refreshChart() {
			if (salesChart) {
				$.get('<?= base_url('admin/dashboard/get_chart_data'); ?>', function (data) {
					if (data.success) {
						salesChart.data.datasets[0].data = data.values;
						salesChart.update();
					}
				});
			}
		}

		document.addEventListener('DOMContentLoaded', function () {
			initChart();
		});

		// ============================================
		// 5. CURRENT DATE TIME
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
				el.textContent = now.toLocaleDateString('id-ID', options);
			}
		}
		updateDateTime();
		setInterval(updateDateTime, 60000);

		// ============================================
		// 6. SWITCH HANDLING (M11-F03)
		// ============================================
		document.querySelectorAll('.custom-control-input').forEach(function (switchEl) {
			switchEl.addEventListener('change', function () {
				const label = this.closest('.custom-control').querySelector('.custom-control-label');
				const setting = label ? label.textContent.trim() : 'Unknown';
				const status = this.checked ? 'diaktifkan' : 'dinonaktifkan';
				console.log('Notifikasi ' + setting + ' ' + status);
			});
		});

		// ============================================
		// 7. AUTO REFRESH NOTIFIKASI (SETIAP 60 DETIK)
		// ============================================
		function refreshNotifications() {
			$.ajax({
				url: '<?= base_url('admin/dashboard/get_notifications_ajax'); ?>',
				type: 'GET',
				dataType: 'json',
				success: function (response) {
					if (response.success) {
						const countEl = document.getElementById('notifCount');
						if (response.unread > 0) {
							countEl.textContent = response.unread;
							countEl.style.display = 'flex';
						} else {
							countEl.style.display = 'none';
						}
					}
				}
			});
		}

		// Refresh setiap 60 detik
		// setInterval(refreshNotifications, 60000);

		console.log('✅ Modul 11: Dashboard f& Notifikasi siap digunakan!');
		console.log('📋 Fitur yang tersedia:');
		console.log('   - KPI Cards (M11-F01)');
		console.log('   - Grafik Penjualan (M10-F02)');
		console.log('   - Produk Terlaris (M10-F04)');
		console.log('   - Pesanan Terbaru (M11-F01)');
		console.log('   - Petani Baru (M11-F01)');
		console.log('   - Quick Action (M11-F04)');
		console.log('   - Notifikasi Real-time (M11-F01)');
		console.log('   - Setting Notifikasi (M11-F03)');
	</script>
</body>

</html>
=======
	</div>
>>>>>>> c50a8c46b5d9744b96ff8d6c8a37c62a316dedd7
