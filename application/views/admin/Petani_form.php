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