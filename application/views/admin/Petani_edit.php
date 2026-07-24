<!-- MAIN BODY CONTENT -->
		<div class="card border-0 shadow-sm rounded-4" style="border-radius: 14px; background: #fff;">
			<div class="card-body p-4">
				<!-- HEADER -->
				<div class="d-flex align-items-center mb-4">
					<a href="<?= base_url('admin/petani'); ?>" class="btn btn-light rounded-circle mr-3 d-flex justify-content-center align-items-center" style="width: 40px; height: 40px; border: 1px solid #e0e0e0;">
						<i class="bi bi-arrow-left text-dark"></i>
					</a>
					<div>
						<h4 class="mb-0 fw-bold" style="font-weight: 700;">Edit Data Petani</h4>
						<small class="text-muted">Perbarui rincian informasi untuk <?= htmlspecialchars($petani['nama_petani']); ?></small>
					</div>
				</div>

				<?php echo validation_errors('<div class="alert alert-danger p-2" style="font-size:0.85rem; border-radius:8px;">', '</div>'); ?>

				<form action="<?= base_url('admin/petani/update_aksi/' . $petani['id_petani']); ?>" method="POST" enctype="multipart/form-data">
					<div class="row gx-5">
						<!-- KIRI -->
						<div class="col-md-6">
							<div class="form-group mb-3">
								<label class="form-label" style="font-size: 0.85rem; font-weight: 600;">Nama Petani <span class="text-danger">*</span></label>
								<input type="text" name="nama_petani" class="form-control rounded-3 py-2" value="<?= htmlspecialchars($petani['nama_petani']); ?>" required style="border-radius: 8px;">
							</div>
							<div class="form-group mb-3">
								<label class="form-label" style="font-size: 0.85rem; font-weight: 600;">NIK <span class="text-danger">*</span></label>
								<input type="text" name="nik" class="form-control rounded-3 py-2" value="<?= htmlspecialchars($petani['nik']); ?>" required style="border-radius: 8px;">
							</div>
							<div class="form-group mb-3">
								<label class="form-label" style="font-size: 0.85rem; font-weight: 600;">No HP <span class="text-danger">*</span></label>
								<input type="tel" name="no_hp" pattern="[0-9]{9,15}" class="form-control rounded-3 py-2" value="<?= htmlspecialchars($petani['no_hp']); ?>" required style="border-radius: 8px;">
							</div>
							<div class="form-group mb-3">
								<label class="form-label" style="font-size: 0.85rem; font-weight: 600;">Alamat <span class="text-danger">*</span></label>
								<textarea name="alamat" class="form-control rounded-3 py-2" rows="4" required style="border-radius: 8px;"><?= htmlspecialchars($petani['alamat']); ?></textarea>
							</div>
							<div class="form-group mb-3">
								<label class="form-label" style="font-size: 0.85rem; font-weight: 600;">Wilayah <span class="text-danger">*</span></label>
								<div class="border rounded-3 p-3" style="background-color: #fafafa; border-radius: 8px;">
									<?php
										$id_wilayah_terpilih = array_column($petani['wilayah'] ?? [], 'id_wilayah');
									?>
									<?php if (!empty($semua_wilayah)): ?>
										<?php foreach ($semua_wilayah as $w): ?>
											<div class="form-check mb-2">
												<input class="form-check-input" type="checkbox" name="wilayah[]" value="<?= $w['id_wilayah']; ?>" id="wilayah_<?= $w['id_wilayah']; ?>" <?= in_array($w['id_wilayah'], $id_wilayah_terpilih) ? 'checked' : ''; ?>>
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
								<div class="d-flex align-items-center mb-3">
									<?php if(!empty($petani['foto_profil'])): ?>
										<img src="<?= base_url('uploads/dokumen/'.$petani['foto_profil']); ?>" class="rounded-circle object-fit-cover mr-3" width="70" height="70" style="object-fit:cover;">
									<?php else: ?>
										<div class="rounded-circle bg-secondary d-flex justify-content-center align-items-center text-white mr-3" style="width: 70px; height: 70px; font-size: 2rem;">
											<i class="bi bi-person"></i>
										</div>
									<?php endif; ?>
									<input type="file" name="foto_profil" class="form-control form-control-sm w-50">
								</div>
								<small class="text-muted d-block" style="font-size: 0.75rem;">Biarkan kosong jika tidak ingin mengubah foto. (JPG, PNG maks 2MB)</small>
							</div>
							<div class="form-group mb-3 mt-4">
								<label class="form-label" style="font-size: 0.85rem; font-weight: 600;">Status <span class="text-danger">*</span></label>
								<select name="status" class="form-control custom-select rounded-3 py-2" style="border-radius: 8px;">
									<option value="Active" <?= $petani['status_petani'] == 'Active' ? 'selected' : ''; ?>>Active</option>
									<option value="Inactive" <?= $petani['status_petani'] == 'Inactive' ? 'selected' : ''; ?>>Inactive</option>
									<option value="Suspended" <?= $petani['status_petani'] == 'Suspended' ? 'selected' : ''; ?>>Suspended</option>
								</select>
							</div>
						</div>
					</div>

					<div class="mt-5 d-flex justify-content-end gap-3 border-top pt-4" style="gap: 10px;">
						<a href="<?= base_url('admin/petani'); ?>" class="btn btn-light px-4 py-2 border fw-bold" style="color: #6c757d; border-radius: 8px; font-weight: 600;">Batal</a>
						<button type="submit" class="btn px-4 py-2 fw-bold text-white shadow-sm" style="background-color: var(--roasted-brown, #4A2C11); border-radius: 8px; font-weight: 600;">Simpan Perubahan</button>
					</div>
				</form>
			</div>
		</div>
	</div>