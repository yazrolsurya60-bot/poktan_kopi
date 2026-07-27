<!-- MAIN BODY CONTENT -->
<div class="card border-0 shadow-sm rounded-4" style="border-radius: 14px; background: #fff;">
	<div class="card-body p-4">
		<!-- HEADER -->
		<div class="d-flex align-items-center mb-4">
			<a href="<?= base_url('admin/petani'); ?>"
				class="btn btn-light rounded-circle mr-3 d-flex justify-content-center align-items-center"
				style="width: 40px; height: 40px; border: 1px solid #e0e0e0;">
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
					<select name="id_wilayah" class="form-control custom-select rounded-3 py-2"
						style="border-radius: 8px;">
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
				<a href="<?= base_url('admin/petani'); ?>" class="btn btn-light px-4 py-2 border fw-bold"
					style="color: #6c757d; border-radius: 8px; font-weight: 600;">Batal</a>
				<button type="submit" class="btn px-4 py-2 fw-bold text-white shadow-sm"
					style="background-color: var(--roasted-brown, #4A2C11); border-radius: 8px; font-weight: 600;">
					<i class="bi bi-download mr-2"></i> Export Data
				</button>
			</div>
		</form>
	</div>
</div>
</div>