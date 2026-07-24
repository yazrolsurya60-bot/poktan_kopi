
		<!-- MAIN BODY CONTENT -->
		<div class="card border-0 shadow-sm rounded-4" style="border-radius: 14px; background: #fff;">
			<div class="card-body p-4">
				<!-- HEADER -->
				<div class="d-flex align-items-center mb-4">
					<a href="<?= base_url('admin/petani'); ?>" class="btn btn-light rounded-circle mr-3 d-flex justify-content-center align-items-center" style="width: 40px; height: 40px; border: 1px solid #e0e0e0;">
						<i class="bi bi-arrow-left text-dark"></i>
					</a>
					<div>
						<h4 class="mb-0 fw-bold" style="font-weight: 700;">Verifikasi Data Petani</h4>
						<small class="text-muted">Periksa kembali data sebelum menyetujui akun <?= htmlspecialchars($petani['nama_petani']); ?></small>
					</div>
				</div>

				<?php echo validation_errors('<div class="alert alert-danger p-2" style="font-size:0.85rem; border-radius:8px;">', '</div>'); ?>

<<<<<<< HEAD
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
				<p class="subtitle mb-0 mt-1 text-muted">Dashboard / Manajemen Petani / Verifikasi</p>
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
=======
				<form action="<?= base_url('admin/petani/verifikasi_aksi/' . $petani['id_petani']); ?>" method="POST">
					<div class="row gx-5">
						<!-- INFORMASI RINGKAS -->
						<div class="col-md-6 mb-4">
							<div class="p-3 border rounded-3 bg-light">
								<h6 class="fw-bold mb-3" style="font-weight:700;">Ringkasan Profil</h6>
								<p class="mb-1"><strong>Nama:</strong> <?= htmlspecialchars($petani['nama_petani']); ?></p>
								<p class="mb-1"><strong>NIK:</strong> <?= htmlspecialchars($petani['nik']); ?></p>
								<p class="mb-1"><strong>No HP:</strong> <?= htmlspecialchars($petani['no_hp']); ?></p>
								<p class="mb-0"><strong>Status Saat Ini:</strong> <?= htmlspecialchars($petani['status_petani']); ?></p>
>>>>>>> c50a8c46b5d9744b96ff8d6c8a37c62a316dedd7
							</div>
						</div>

						<!-- FORM VERIFIKASI -->
						<div class="col-md-6 mb-4">
							<div class="form-group mb-3">
								<label class="form-label" style="font-size: 0.85rem; font-weight: 600;">Status Verifikasi Baru <span class="text-danger">*</span></label>
								<select name="status" class="form-control custom-select rounded-3 py-2" style="border-radius: 8px;" required>
									<option value="Active" <?= $petani['status_petani'] == 'Active' ? 'selected' : ''; ?>>Active (Setujui)</option>
									<option value="Inactive" <?= $petani['status_petani'] == 'Inactive' ? 'selected' : ''; ?>>Inactive (Pending/Tangguhkan)</option>
									<option value="Suspended" <?= $petani['status_petani'] == 'Suspended' ? 'selected' : ''; ?>>Suspended (Tolak/Blokir)</option>
								</select>
							</div>
							<div class="form-group mb-3">
								<label class="form-label" style="font-size: 0.85rem; font-weight: 600;">Catatan Verifikasi</label>
								<textarea name="catatan" class="form-control rounded-3 py-2" rows="4" placeholder="Tuliskan catatan atau alasan jika menolak/mengubah status..." style="border-radius: 8px;"><?= htmlspecialchars($petani['catatan_verifikasi'] ?? ''); ?></textarea>
							</div>
						</div>
					</div>

					<div class="mt-4 d-flex justify-content-end gap-3 border-top pt-4" style="gap: 10px;">
						<a href="<?= base_url('admin/petani/detail/' . $petani['id_petani']); ?>" class="btn btn-light px-4 py-2 border fw-bold" style="color: #6c757d; border-radius: 8px; font-weight: 600;">Batal</a>
						<button type="submit" class="btn px-4 py-2 fw-bold text-white shadow-sm" style="background-color: var(--roasted-brown, #4A2C11); border-radius: 8px; font-weight: 600;">Simpan Hasil Verifikasi</button>
					</div>
				</form>
			</div>
		</div>
	</div>
