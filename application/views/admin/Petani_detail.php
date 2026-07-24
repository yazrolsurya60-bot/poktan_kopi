
		<?php 
		if (!function_exists('get_status_badge')) {
			function get_status_badge($status) {
				if ($status == 'Active' || $status == 'Terverifikasi') return '<span class="badge" style="background-color: #E8F5E9; color: #4CAF50; padding: 6px 12px; border-radius: 6px;">'.$status.'</span>';
				if ($status == 'Pending' || $status == 'Inactive' || $status == 'Menunggu Verifikasi') return '<span class="badge" style="background-color: #FFF8E1; color: #FFC107; padding: 6px 12px; border-radius: 6px;">'.$status.'</span>';
				if ($status == 'Ditolak' || $status == 'Suspended') return '<span class="badge" style="background-color: #FFEBEE; color: #F44336; padding: 6px 12px; border-radius: 6px;">'.$status.'</span>';
				return '<span class="badge bg-secondary">'.$status.'</span>';
			}
		}

		if (!function_exists('get_doc_badge')) {
			function get_doc_badge($status) {
				if ($status == 'Terverifikasi') return '<span class="badge" style="background-color: #E8F5E9; color: #4CAF50;">Terverifikasi</span>';
				if ($status == 'Ditolak') return '<span class="badge" style="background-color: #FFEBEE; color: #F44336;">Ditolak</span>';
				return '<span class="badge" style="background-color: #FFF8E1; color: #FFC107;">Menunggu</span>';
			}
		}
		?>

		<!-- MAIN BODY CONTENT -->
		<div class="row gx-4">
			<!-- KIRI: Profil & Dokumen -->
			<div class="col-md-4 mb-4">
				<!-- Card Profil -->
				<div class="card border-0 shadow-sm rounded-4 mb-4" style="border-radius:14px; background:#fff;">
					<div class="card-body p-4 text-center">
						<div class="d-flex justify-content-start mb-3">
							<a href="<?= base_url('admin/petani'); ?>" class="btn btn-light rounded-circle d-flex justify-content-center align-items-center" style="width: 40px; height: 40px; border: 1px solid #e0e0e0;">
								<i class="bi bi-arrow-left text-dark"></i>
							</a>
						</div>
<<<<<<< HEAD
					</div>
				</div>
			</div>
		</div>

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
				<p class="subtitle mb-0 mt-1 text-muted">Dashboard / Manajemen Petani / Detail</p>
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
=======
						
						<div class="mb-3">
							<?php if(!empty($petani['foto_profil'])): ?>
								<img src="<?= base_url('uploads/dokumen/'.$petani['foto_profil']); ?>" class="rounded-circle object-fit-cover shadow-sm mx-auto" width="140" height="140" style="border: 4px solid #fff; object-fit:cover;">
>>>>>>> c50a8c46b5d9744b96ff8d6c8a37c62a316dedd7
							<?php else: ?>
								<div class="rounded-circle bg-secondary d-flex justify-content-center align-items-center text-white shadow-sm mx-auto" style="width: 140px; height: 140px; font-size: 4rem; border: 4px solid #fff;">
									<i class="bi bi-person"></i>
								</div>
							<?php endif; ?>
						</div>
						
						<h5 class="fw-bold mb-1 d-flex justify-content-center align-items-center gap-2" style="font-weight:700; gap:8px;">
							<?= htmlspecialchars($petani['nama_petani']); ?> 
							<?= get_status_badge($petani['status_petani']); ?>
						</h5>
						<p class="text-muted small mb-4">Bergabung sejak <?= date('d F Y', strtotime($petani['tanggal_daftar'])); ?></p>
						
						<a href="<?= base_url('admin/petani/edit/' . $petani['id_petani']); ?>" class="btn w-100 py-2 rounded-3 fw-bold" style="background-color: #FDF5ED; color: #8D6E63; border: 1px solid #F5E6D3; font-weight:600; border-radius:8px;">
							<i class="bi bi-pencil-square mr-2"></i> Edit Petani
						</a>

						<?php if($petani['status_petani'] == 'Pending' || $petani['status_petani'] == 'Inactive'): ?>
						<a href="<?= base_url('admin/petani/verifikasi/' . $petani['id_petani']); ?>" class="btn w-100 py-2 rounded-3 fw-bold mt-2 text-white" style="background-color: #4CAF50; font-weight:600; border-radius:8px;">
							<i class="bi bi-check-circle mr-2"></i> Verifikasi Sekarang
						</a>
						<?php endif; ?>
					</div>
				</div>

				<!-- Card Dokumen -->
				<h6 class="fw-bold mb-3" style="font-weight:700;">Dokumen Petani</h6>
				<div class="d-flex flex-column gap-3" style="gap:15px;">
					<!-- Sertifikat -->
					<div class="card border-0 shadow-sm rounded-4" style="border-radius:14px; background:#fff;">
						<div class="card-body p-3">
							<div class="d-flex align-items-center justify-content-between mb-2">
								<div class="d-flex align-items-center gap-2" style="gap:8px;">
									<i class="bi bi-patch-check text-muted" style="font-size:1.4rem;"></i>
									<span class="fw-bold" style="font-size:0.85rem; font-weight:600;">Sertifikat</span>
								</div>
								<?= get_doc_badge(isset($petani['status_sertifikat']) ? $petani['status_sertifikat'] : 'Menunggu'); ?>
							</div>
							<?php if(!empty($petani['file_sertifikat'])): ?>
								<div class="d-flex align-items-center gap-2 mb-2" style="gap:8px;">
									<i class="bi bi-file-earmark-check text-success"></i>
									<small class="text-muted text-truncate" style="max-width:140px;"><?= $petani['file_sertifikat']; ?></small>
									<a href="<?= base_url('uploads/dokumen/'.$petani['file_sertifikat']); ?>" target="_blank" class="btn btn-sm rounded-2 ml-auto" style="background:#f0f0f0;color:#555;font-size:0.75rem;"><i class="bi bi-eye mr-1"></i>Lihat</a>
								</div>
								<div class="d-flex gap-2" style="gap:10px;">
									<a href="<?= base_url('admin/petani/verifikasi_dokumen/'.$petani['id_petani'].'/status_sertifikat/Terverifikasi'); ?>" onclick="return confirm('Approve Sertifikat?')" class="btn btn-sm w-50 fw-bold text-white rounded-2" style="background:#4CAF50;font-size:0.75rem;"><i class="bi bi-check-lg mr-1"></i>Approve</a>
									<a href="<?= base_url('admin/petani/verifikasi_dokumen/'.$petani['id_petani'].'/status_sertifikat/Ditolak'); ?>" onclick="return confirm('Reject Sertifikat?')" class="btn btn-sm w-50 fw-bold text-white rounded-2" style="background:#F44336;font-size:0.75rem;"><i class="bi bi-x-lg mr-1"></i>Reject</a>
								</div>
							<?php else: ?>
								<form action="<?= base_url('admin/petani/upload_dokumen/'.$petani['id_petani']); ?>" method="POST" enctype="multipart/form-data">
									<input type="hidden" name="jenis_dokumen" value="file_sertifikat">
									<div class="d-flex gap-2 align-items-center" style="gap:8px;">
										<input type="file" name="file_dokumen" class="form-control form-control-sm rounded-2" accept=".jpg,.jpeg,.png,.pdf" required style="font-size:0.75rem;">
										<button type="submit" class="btn btn-sm text-white rounded-2 fw-bold" style="background:var(--roasted-brown, #4A2C11);white-space:nowrap;font-size:0.75rem;"><i class="bi bi-upload mr-1"></i>Upload</button>
									</div>
								</form>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>

			<!-- KANAN: Informasi Petani -->
			<div class="col-md-8 mb-4">
				<div class="card border-0 shadow-sm rounded-4 h-100" style="border-radius:14px; background:#fff;">
					<div class="card-body p-4 p-md-5">
						<h5 class="fw-bold mb-4" style="font-weight:700;">Informasi Detail Petani</h5>
						
						<table class="table table-borderless">
							<tbody>
								<tr>
									<td class="text-muted" style="width: 150px;">NIK</td>
									<td class="fw-bold text-dark">: <?= htmlspecialchars($petani['nik']); ?></td>
								</tr>
								<tr>
									<td class="text-muted">No HP</td>
									<td class="fw-bold text-dark">: <?= htmlspecialchars($petani['no_hp']); ?></td>
								</tr>
								<tr>
									<td class="text-muted align-top">Alamat</td>
									<td class="fw-bold text-dark">: <?= nl2br(htmlspecialchars($petani['alamat'])); ?></td>
								</tr>
								<tr>
									<td class="text-muted align-top">Wilayah</td>
									<td class="fw-bold text-dark">:
										<?php if (!empty($petani['wilayah'])): ?>
											<?php foreach ($petani['wilayah'] as $w): ?>
												<div class="mb-2">
													<span class="badge rounded-pill px-3 py-2" style="background-color: #F5E6D3; color: #8D6E63; font-weight: 600;">
														<?= htmlspecialchars($w['nama_wilayah']); ?>
													</span>
													<?php if (!empty($w['alamat_wilayah'])): ?>
														<div class="text-muted" style="font-size: 0.78rem; font-weight: 400; margin-top: 2px;">
															<?= htmlspecialchars($w['alamat_wilayah']); ?>
														</div>
													<?php endif; ?>
												</div>
											<?php endforeach; ?>
										<?php else: ?>
											<span class="text-muted">-</span>
										<?php endif; ?>
									</td>
								</tr>
								<tr>
									<td colspan="2"><hr class="my-3 text-muted"></td>
								</tr>
								<tr>
									<td class="text-muted">Tanggal Daftar</td>
									<td class="fw-bold text-dark">: <?= date('d F Y', strtotime($petani['tanggal_daftar'])); ?></td>
								</tr>
								<tr>
									<td class="text-muted">Status Akun</td>
									<td class="fw-bold text-dark">: <?= $petani['status_petani']; ?></td>
								</tr>
								<?php if(!empty($petani['catatan_verifikasi'])): ?>
								<tr>
									<td class="text-muted align-top">Catatan Admin</td>
									<td class="fw-bold text-danger">: <?= nl2br(htmlspecialchars($petani['catatan_verifikasi'])); ?></td>
								</tr>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
