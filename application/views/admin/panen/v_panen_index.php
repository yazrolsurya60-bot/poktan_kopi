<!-- M04-F06: Filter Panen -->
<div class="custom-card mb-4 d-print-none" style="background: #fff; border-radius: 14px; border: 1px solid rgba(74, 44, 17, 0.06); box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
	<div class="card-body-custom" style="padding: 20px 24px;">
		<form method="GET" action="<?= base_url('admin/panen'); ?>" class="filter-form">
			<div class="row align-items-end" style="margin: 0 -8px;">
				<div class="col-md-3" style="padding: 0 8px;">
					<label style="font-size: 0.72rem; font-weight: 700; color: #70655E; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; display: block;">MULAI TANGGAL</label>
					<input type="date" name="start_date" class="form-control form-control-sm py-2 px-3"
						value="<?= $this->input->get('start_date'); ?>" style="border-radius: 8px; border: 1px solid #E5E0DB; background-color: #FAF6F0; font-size: 0.85rem;">
				</div>
				<div class="col-md-3" style="padding: 0 8px;">
					<label style="font-size: 0.72rem; font-weight: 700; color: #70655E; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; display: block;">SAMPAI TANGGAL</label>
					<input type="date" name="end_date" class="form-control form-control-sm py-2 px-3"
						value="<?= $this->input->get('end_date'); ?>" style="border-radius: 8px; border: 1px solid #E5E0DB; background-color: #FAF6F0; font-size: 0.85rem;">
				</div>
				<div class="col-md-3" style="padding: 0 8px;">
					<label style="font-size: 0.72rem; font-weight: 700; color: #70655E; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; display: block;">KUALITAS</label>
					<input type="text" name="kualitas" class="form-control form-control-sm py-2 px-3"
						placeholder="Contoh: Grade A" value="<?= $this->input->get('kualitas'); ?>" style="border-radius: 8px; border: 1px solid #E5E0DB; background-color: #FAF6F0; font-size: 0.85rem;">
				</div>
				<div class="col-md-3" style="padding: 0 8px;">
					<button type="submit" class="btn w-100 py-2 border-0 font-weight-bold"
						style="background-color: #D9D2C9; color: #4A2C11; border-radius: 8px; font-size: 0.85rem; transition: all 0.2s ease;">
						<i class="bi bi-funnel-fill mr-1"></i> Terapkan Filter
					</button>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- Tombol Export & Print -->
<div class="d-flex justify-content-end mb-3 d-print-none" style="gap: 10px;">
	<a href="<?= base_url('admin/panen/export_excel?' . $_SERVER['QUERY_STRING']); ?>"
		class="btn text-white px-3 py-2 font-weight-bold d-inline-flex align-items-center"
		style="background-color: #10B981; border-radius: 8px; font-size: 0.85rem; border: none;">
		<i class="bi bi-file-earmark-excel mr-1"></i> Export Excel
	</a>
	<button onclick="window.print()" class="btn text-white px-3 py-2 font-weight-bold d-inline-flex align-items-center"
		style="background-color: #6B7280; border-radius: 8px; font-size: 0.85rem; border: none;">
		<i class="bi bi-printer mr-1"></i> Cetak / PDF
	</button>
</div>

<!-- TABLE DATA -->
<div class="custom-card" style="background: #fff; border-radius: 14px; border: 1px solid rgba(74, 44, 17, 0.06); box-shadow: 0 4px 12px rgba(0,0,0,0.03); overflow: hidden;">
	<div class="card-header-custom d-flex justify-content-between align-items-center" style="padding: 18px 24px; border-bottom: 1px solid rgba(74, 44, 17, 0.06);">
		<span class="font-weight-bold text-dark" style="font-size: 0.95rem;">
			<i class="bi bi-list-ul mr-2" style="color: #E6A15C;"></i>Data Panen Semua Petani
		</span>
		<span class="badge px-3 py-1 font-weight-normal" style="background: #FAF6F0; color: #70655E; border-radius: 20px; font-size: 0.75rem;">
			<?= count($panen_list); ?> Data
		</span>
	</div>
	<div class="card-body-custom p-0">
		<div class="table-responsive">
			<table class="table mb-0" style="font-size: 0.85rem;">
				<thead>
					<tr style="background-color: #FAF6F0; border-bottom: 2px solid rgba(74, 44, 17, 0.06);">
						<th class="border-0 text-muted py-3" style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; padding-left: 24px; width: 6%;">NO</th>
						<th class="border-0 text-muted py-3" style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; width: 15%;">TANGGAL PANEN</th>
						<th class="border-0 text-muted py-3" style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; width: 20%;">NAMA PETANI</th>
						<th class="border-0 text-muted py-3" style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; width: 20%;">LAHAN</th>
						<th class="border-0 text-muted py-3" style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; width: 14%;">JUMLAH (KG)</th>
						<th class="border-0 text-muted py-3" style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; width: 13%;">KUALITAS</th>
						<th class="border-0 text-muted py-3 text-center d-print-none" style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; padding-right: 24px; width: 12%;">AKSI</th>
					</tr>
				</thead>
				<tbody>
					<?php if (empty($panen_list)): ?>
						<tr>
							<td colspan="7" class="text-center py-5 border-0 text-muted">
								<i class="bi bi-inbox d-block mb-3" style="font-size: 2.5rem; color: #A8988A;"></i>
								<p class="mb-0" style="font-size: 0.9rem; color: #70655E;">Belum ada data panen dari petani.</p>
							</td>
						</tr>
					<?php else: ?>
						<?php $no = 1; foreach ($panen_list as $p): ?>
							<tr style="border-bottom: 1px solid rgba(74, 44, 17, 0.04);">
								<td class="align-middle py-3" style="padding-left: 24px; color: #2C1808;"><?= $no++; ?></td>
								<td class="align-middle py-3" style="color: #2C1808;"><?= date('d M Y', strtotime($p['tanggal_panen'])); ?></td>
								<td class="align-middle py-3 font-weight-bold" style="color: #2C1808;">
									<?= htmlspecialchars($p['nama_petani'] ?? 'Unknown Petani'); ?>
								</td>
								<td class="align-middle py-3" style="color: #70655E;"><?= htmlspecialchars($p['nama_lahan'] ?? '-'); ?></td>
								<td class="align-middle py-3 font-weight-bold" style="color: #10B981;">
									<?= number_format($p['jumlah_panen'], 0, ',', '.'); ?> Kg
								</td>
								<td class="align-middle py-3">
									<span class="badge font-weight-bold px-3 py-1" style="border: 1px solid #D9D2C9; background: #F8F9FA; color: #70655E; border-radius: 20px; font-size: 0.75rem;">
										<?= htmlspecialchars($p['kualitas'] ?? '-'); ?>
									</span>
								</td>
								<td class="align-middle py-3 text-center d-print-none" style="padding-right: 24px;">
									<a href="<?= base_url('admin/panen/detail/' . $p['id_panen']); ?>"
										class="btn btn-sm text-primary font-weight-bold"
										style="background-color: #DBEAFE; border-radius: 6px; padding: 4px 12px; font-size: 0.8rem;" title="Detail Panen">
										<i class="bi bi-eye mr-1"></i> Detail
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
	<?php if (!empty($panen_list)): ?>
		<div class="p-3 border-top" style="border-color: rgba(74,44,17,0.05); background-color: #fff;">
			<small class="text-muted">
				<i class="bi bi-info-circle mr-1"></i> Menampilkan <strong><?= count($panen_list); ?></strong> data panen
				<?php if (!empty($this->input->get('start_date')) || !empty($this->input->get('end_date')) || !empty($this->input->get('kualitas'))): ?>
					(hasil filter)
				<?php endif; ?>
			</small>
		</div>
	<?php endif; ?>
</div>
