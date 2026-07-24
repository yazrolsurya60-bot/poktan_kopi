<style>
	:root {
		--roasted-brown: #4A2C11;
		--dark-coffee: #2C1808;
		--amber-cream: #E6A15C;
		--bg-cream: #FAF6F0;
		--card-white: #FFFFFF;
		--text-secondary: #70655E;
		--shadow-soft: 0 8px 30px rgba(16, 9, 3, 0.08);
		--shadow-hover: 0 12px 40px rgba(44, 24, 8, 0.15);
		--radius-card: 14px;
		--transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
	}

	/* SEARCH & BUTTONS TOP */
	.search-input {
		border: 1px solid rgba(74, 44, 17, 0.12);
		border-radius: 10px;
		padding: 10px 16px;
		font-size: 0.85rem;
		transition: var(--transition-smooth);
		background: var(--card-white);
	}

	.search-input:focus {
		border-color: var(--amber-cream);
		box-shadow: 0 0 0 3px rgba(230, 161, 92, 0.15);
		outline: none;
	}

	.btn-search {
		background: var(--dark-coffee);
		color: #FFFFFF;
		border: none;
		padding: 10px 22px;
		border-radius: 10px;
		font-weight: 600;
		font-size: 0.85rem;
		transition: var(--transition-smooth);
		display: inline-flex;
		align-items: center;
		gap: 6px;
		text-decoration: none !important;
	}

	.btn-search:hover {
		background: var(--roasted-brown);
		color: #FFFFFF;
	}

	.btn-reset {
		background: var(--card-white);
		color: var(--dark-coffee);
		border: 1px solid rgba(74, 44, 17, 0.12);
		padding: 10px 22px;
		border-radius: 10px;
		font-weight: 500;
		font-size: 0.85rem;
		transition: var(--transition-smooth);
		display: inline-flex;
		align-items: center;
		gap: 6px;
		text-decoration: none !important;
	}

	.btn-reset:hover {
		background: var(--bg-cream);
		color: var(--dark-coffee);
	}

	.btn-tambah {
		background: #E6A15C;
		color: #FFFFFF;
		border: none;
		padding: 10px 22px;
		border-radius: 10px;
		font-weight: 600;
		font-size: 0.85rem;
		transition: var(--transition-smooth);
		display: inline-flex;
		align-items: center;
		gap: 8px;
		text-decoration: none !important;
	}

	.btn-tambah:hover {
		background: var(--roasted-brown);
		color: #FFFFFF;
		box-shadow: var(--shadow-hover);
	}

	/* TABLE STYLING */
	.table-custom {
		font-size: 0.85rem;
		width: 100%;
		background: var(--card-white);
		border-radius: var(--radius-card);
		overflow: hidden;
		box-shadow: var(--shadow-soft);
		border: 1px solid rgba(74, 44, 17, 0.06);
	}

	.table-custom thead th {
		background: var(--bg-cream);
		border-bottom: 2px solid rgba(74, 44, 17, 0.06);
		color: var(--text-secondary);
		font-weight: 700;
		font-size: 0.7rem;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		padding: 14px 12px;
		text-align: center;
		white-space: nowrap;
	}

	.table-custom tbody td {
		padding: 14px 12px;
		border-bottom: 1px solid rgba(74, 44, 17, 0.04);
		vertical-align: middle;
		background: var(--card-white);
		text-align: center;
		color: var(--dark-coffee);
	}

	.table-custom tbody tr:hover td {
		background: rgba(250, 246, 240, 0.4);
	}

	/* STATUS BADGE */
	.status-badge {
		padding: 5px 14px;
		border-radius: 20px;
		font-size: 0.72rem;
		font-weight: 600;
		display: inline-block;
	}

	.status-badge.aktif {
		background: #D1FAE5;
		color: #065F46;
	}

	.status-badge.nonaktif {
		background: #FEE2E2;
		color: #991B1B;
	}

	/* ACTION BUTTONS IN TABLE */
	.btn-detail {
		background: #DBEAFE;
		color: #1E40AF;
		border: none;
		padding: 5px 10px;
		border-radius: 6px;
		font-size: 0.72rem;
		font-weight: 600;
		transition: var(--transition-smooth);
		display: inline-flex;
		align-items: center;
		gap: 4px;
		text-decoration: none !important;
	}

	.btn-detail:hover {
		background: #1E40AF;
		color: #FFFFFF;
	}

	.btn-edit {
		background: #FEF3C7;
		color: #92400E;
		border: none;
		padding: 5px 10px;
		border-radius: 6px;
		font-size: 0.72rem;
		font-weight: 600;
		transition: var(--transition-smooth);
		display: inline-flex;
		align-items: center;
		gap: 4px;
		text-decoration: none !important;
	}

	.btn-edit:hover {
		background: #92400E;
		color: #FFFFFF;
	}

	.btn-hapus {
		background: #FEE2E2;
		color: #991B1B;
		border: none;
		padding: 5px 10px;
		border-radius: 6px;
		font-size: 0.72rem;
		font-weight: 600;
		transition: var(--transition-smooth);
		display: inline-flex;
		align-items: center;
		gap: 4px;
		text-decoration: none !important;
	}

	.btn-hapus:hover {
		background: #991B1B;
		color: #FFFFFF;
	}

	.stok-unit {
		font-size: 0.65rem;
		color: var(--text-secondary);
	}
</style>

<!-- SEARCH & TAMBAH -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap" style="gap: 15px;">
	<form method="get" action="<?= base_url('admin/produk'); ?>" class="d-flex align-items-center" style="gap: 10px; flex-grow: 1; max-width: 600px;">
		<input type="text" name="keyword" class="search-input form-control" placeholder="Cari nama produk, jenis kopi..." value="<?= $this->input->get('keyword'); ?>" style="flex:1;">
		<button type="submit" class="btn-search">
			<i class="bi bi-search"></i> Cari
		</button>
		<a href="<?= base_url('admin/produk'); ?>" class="btn-reset">
			Reset
		</a>
	</form>
	<a href="<?= base_url('admin/produk/tambah'); ?>" class="btn-tambah">
		<i class="bi bi-plus-lg"></i> Tambah Produk
	</a>
</div>

<!-- TABLE PRODUK -->
<div class="table-responsive">
	<table class="table-custom">
		<thead>
			<tr>
				<th style="width:40px;">NO</th>
				<th style="width:70px;">FOTO</th>
				<th style="width:160px; text-align:center;">NAMA PRODUK</th>
				<th style="width:110px;">JENIS KOPI</th>
				<th style="width:180px;">PROSES PENGOLAHAN</th>
				<th style="width:130px;">HARGA</th>
				<th style="width:80px;">STOK</th>
				<th style="width:90px;">STATUS</th>
				<th style="width:220px;">AKSI</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($produk)): ?>
				<?php $no = 1; foreach ($produk as $row): ?>
					<tr>
						<td><?= $no++; ?></td>
						<td>
							<?php if (!empty($row->foto_utama)) : ?>
								<img src="<?= base_url('uploads/produk/' . $row->foto_utama); ?>"
									width="45" height="45" style="object-fit:cover; border-radius:10px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
							<?php else : ?>
								<div style="width:45px; height:45px; background:var(--bg-cream); border-radius:10px; display:flex; align-items:center; justify-content:center; color:var(--text-secondary); font-size:0.6rem; margin:0 auto;">
									No Image
								</div>
							<?php endif; ?>
						</td>
						<td style="text-align:center; font-weight:700; color:var(--dark-coffee);"><?= $row->nama_produk; ?></td>
						<td><?= $row->jenis_kopi; ?></td>
						<td style="max-width: 200px; line-height: 1.4; text-align: center;"><?= !empty($row->proses) ? $row->proses : '<span style="color:#999; font-style:italic;">-</span>'; ?></td>
						<td style="font-weight:700; color:var(--dark-coffee);">Rp <?= number_format($row->harga, 0, ',', '.'); ?></td>
						<td>
							<span style="font-weight: 600;"><?= $row->stok_produk; ?></span>
							<small class="stok-unit">kg</small>
						</td>
						<td>
							<?php
							$status_class = 'aktif';
							$status_text = $row->status_produk ?? 'Aktif';
							if (strtolower($status_text) == 'nonaktif') $status_class = 'nonaktif';
							?>
							<span class="status-badge <?= $status_class; ?>"><?= $status_text; ?></span>
						</td>
						<td>
							<div class="d-flex flex-wrap justify-content-center" style="gap: 4px;">
								<a class="btn-detail" href="<?= base_url('admin/produk/detail/' . $row->id_produk); ?>">
									<i class="bi bi-eye"></i> Detail
								</a>
								<a class="btn-edit" href="<?= base_url('admin/produk/edit/' . $row->id_produk); ?>">
									<i class="bi bi-pencil-square"></i> Edit
								</a>
								<a class="btn-hapus" href="<?= base_url('admin/produk/hapus/' . $row->id_produk); ?>"
									onclick="return confirm('Yakin ingin menghapus produk ini?')">
									<i class="bi bi-trash"></i> Hapus
								</a>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="9" class="text-center py-4 text-muted">
						<i class="bi bi-box" style="font-size:2rem; display:block; margin-bottom:8px; opacity:0.3;"></i>
						Belum ada produk. <a href="<?= base_url('admin/produk/tambah'); ?>" style="color: var(--amber-cream); font-weight:600;">Tambah produk pertama</a>
					</td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>