<!-- MAIN BODY CONTENT -->
		<div class="card border-0 shadow-sm rounded-4" style="border-radius: 14px; background: #fff;">
			<div class="card-body p-4">
				<!-- HEADER -->
				<div class="d-flex align-items-center mb-4">
					<a href="<?= base_url('admin/petani'); ?>" class="btn btn-light rounded-circle mr-3 d-flex justify-content-center align-items-center" style="width: 40px; height: 40px; border: 1px solid #e0e0e0;">
						<i class="bi bi-arrow-left text-dark"></i>
					</a>
					<div>
						<h4 class="mb-0 fw-bold" style="font-weight: 700;">Form Data Petani</h4>
						<small class="text-muted">Isi seluruh informasi utama petani dengan benar</small>
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
				<p class="subtitle mb-0 mt-1 text-muted">Dashboard / Manajemen Petani / Tambah</p>
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
				<form action="<?= base_url('admin/petani/tambah_aksi'); ?>" method="POST" enctype="multipart/form-data">
					<div class="row gx-5">
						<!-- KIRI -->
						<div class="col-md-6">
							<div class="form-group mb-3">
								<label class="form-label" style="font-size: 0.85rem; font-weight: 600;">Nama Petani <span class="text-danger">*</span></label>
								<input type="text" name="nama_petani" class="form-control rounded-3 py-2" placeholder="Masukkan nama petani" value="<?= set_value('nama_petani'); ?>" required style="border-radius: 8px;">
							</div>
							<div class="form-group mb-3">
								<label class="form-label" style="font-size: 0.85rem; font-weight: 600;">NIK <span class="text-danger">*</span></label>
								<input type="text" name="nik" class="form-control rounded-3 py-2" placeholder="Masukkan NIK" value="<?= set_value('nik'); ?>" required style="border-radius: 8px;">
							</div>
							<div class="form-group mb-3">
								<label class="form-label" style="font-size: 0.85rem; font-weight: 600;">No HP <span class="text-danger">*</span></label>
								<input type="tel" name="no_hp" pattern="[0-9]{9,15}" class="form-control rounded-3 py-2" placeholder="Masukkan no HP" value="<?= set_value('no_hp'); ?>" required style="border-radius: 8px;">
							</div>
							<div class="form-group mb-3">
								<label class="form-label" style="font-size: 0.85rem; font-weight: 600;">Alamat <span class="text-danger">*</span></label>
								<textarea name="alamat" class="form-control rounded-3 py-2" rows="4" placeholder="Masukkan alamat lengkap" required style="border-radius: 8px;"><?= set_value('alamat'); ?></textarea>
							</div>
							<div class="form-group mb-3">
								<label class="form-label" style="font-size: 0.85rem; font-weight: 600;">Wilayah <span class="text-danger">*</span></label>
								<div class="border rounded-3 p-3" style="background-color: #fafafa; border-radius: 8px;">
									<?php if (!empty($semua_wilayah)): ?>
										<?php foreach ($semua_wilayah as $w): ?>
											<div class="form-check mb-2">
												<input class="form-check-input" type="checkbox" name="wilayah[]" value="<?= $w['id_wilayah']; ?>" id="wilayah_<?= $w['id_wilayah']; ?>" <?= set_checkbox('wilayah[]', $w['id_wilayah']); ?>>
												<label class="form-check-label" for="wilayah_<?= $w['id_wilayah']; ?>" style="font-size: 0.85rem;">
													<?= htmlspecialchars($w['nama_wilayah']); ?>
													<?php if (!empty($w['alamat_wilayah'])): ?>
														<div class="text-muted" style="font-size: 0.72rem; font-weight: 400;"><?= htmlspecialchars($w['alamat_wilayah']); ?></div>
													<?php endif; ?>
												</label>
											</div>
										<?php endforeach; ?>
									<?php else: ?>
										<small class="text-muted">Belum ada data wilayah.</small>
									<?php endif; ?>
								</div>
								<small class="text-muted" style="font-size: 0.75rem;">Centang satu atau lebih wilayah tempat petani ini terdaftar.</small>
>>>>>>> c50a8c46b5d9744b96ff8d6c8a37c62a316dedd7
							</div>
						</div>

						<!-- KANAN -->
						<div class="col-md-6">
							<div class="form-group mb-3">
								<label class="form-label" style="font-size: 0.85rem; font-weight: 600;">Foto Profil</label>
								<div class="border rounded-4 text-center d-flex flex-column justify-content-center align-items-center p-3" style="border-style: dashed !important; border-width: 2px !important; border-color: #d0d0d0 !important; height: 160px; background-color: #fafafa; border-radius: 12px;">
									<i class="bi bi-cloud-arrow-up" style="font-size: 2.5rem; color: #8D6E63;"></i>
									<p class="mb-1 fw-bold mt-2" style="font-size: 0.9rem; font-weight: 600;">Upload foto profil</p>
									<small class="text-muted" style="font-size: 0.75rem;">JPG, PNG (maks. 2MB)</small>
									<input type="file" name="foto_profil" class="form-control form-control-sm mt-2 w-75 mx-auto" style="font-size: 0.75rem;">
								</div>
							</div>
							<div class="form-group mb-3 mt-4">
								<label class="form-label" style="font-size: 0.85rem; font-weight: 600;">Status <span class="text-danger">*</span></label>
								<select name="status" class="form-control custom-select rounded-3 py-2" style="border-radius: 8px;">
									<option value="Active" <?= set_select('status', 'Active'); ?>>Active</option>
									<option value="Inactive" <?= set_select('status', 'Inactive', TRUE); ?>>Inactive</option>
									<option value="Suspended" <?= set_select('status', 'Suspended'); ?>>Suspended</option>
								</select>
							</div>
						</div>
					</div>

					<div class="mt-5 d-flex justify-content-end gap-3 border-top pt-4" style="gap: 10px;">
						<a href="<?= base_url('admin/petani'); ?>" class="btn btn-light px-4 py-2 border fw-bold" style="color: #6c757d; border-radius: 8px; font-weight: 600;">Batal</a>
						<button type="submit" class="btn px-4 py-2 fw-bold text-white shadow-sm" style="background-color: var(--roasted-brown, #4A2C11); border-radius: 8px; font-weight: 600;">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>