
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
