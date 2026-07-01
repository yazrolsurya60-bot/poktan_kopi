<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Assign Kurir - Sistem Supply Chain Kopi</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<style>
		:root {
			--roasted-brown: #4A2C11;
			--dark-coffee: #2C1808;
			--amber-cream: #E6A15C;
			--bg-cream: #FAF6F0;
			--card-white: #FFFFFF;
			--text-secondary: #70655E;
			--shadow-soft: 0 8px 30px rgba(44, 24, 8, 0.08);
			--radius-card: 14px;
			--transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
		}

		body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-cream); color: var(--dark-coffee); }

		.main-content { padding: 30px 24px 40px; max-width: 1100px; margin: 0 auto; min-height: 100vh; }

		.page-header { border-bottom: 1px solid rgba(74, 44, 17, 0.08); padding-bottom: 20px; margin-bottom: 24px; }
		.page-header h2 { font-weight: 700; color: var(--dark-coffee); }
		.page-header .subtitle { color: var(--text-secondary); font-size: 0.9rem; margin-top: 2px; }

		.custom-card { background: var(--card-white); border: 1px solid rgba(74, 44, 17, 0.06); border-radius: var(--radius-card); box-shadow: var(--shadow-soft); overflow: hidden; margin-bottom: 20px; }
		.custom-card .card-header-custom { padding: 18px 24px; border-bottom: 1px solid rgba(74, 44, 17, 0.06); display: flex; align-items: center; gap: 10px; }
		.custom-card .card-header-custom h6 { font-weight: 700; color: var(--dark-coffee); margin: 0; font-size: 0.9rem; }
		.badge-count { background: var(--bg-cream); color: var(--roasted-brown); font-size: 0.7rem; font-weight: 700; padding: 2px 12px; border-radius: 12px; }
		.card-body-custom { padding: 0; }

		.table-custom { font-size: 0.85rem; margin-bottom: 0; }
		.table-custom thead th { background: var(--bg-cream); border-bottom: 2px solid rgba(74, 44, 17, 0.06); color: var(--text-secondary); font-weight: 700; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 16px; border-top: none; }
		.table-custom tbody td { padding: 12px 16px; border-bottom: 1px solid rgba(74, 44, 17, 0.04); vertical-align: middle; }
		.link-name { color: var(--roasted-brown); font-weight: 600; }

		.status-badge { padding: 4px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: 600; text-transform: capitalize; background: #FEF3C7; color: #92400E; }

		.form-select-custom { padding: 7px 10px; border: 1.5px solid rgba(74, 44, 17, 0.1); border-radius: 8px; font-size: 0.8rem; color: var(--dark-coffee); background: var(--bg-cream); outline: none; min-width: 150px; }
		.form-select-custom:focus { border-color: var(--amber-cream); box-shadow: 0 0 0 3px rgba(230, 161, 92, 0.15); }

		.btn-primary-custom { background: var(--roasted-brown); color: #fff; border: none; border-radius: 8px; padding: 7px 14px; font-size: 0.8rem; font-weight: 600; transition: var(--transition-smooth); display: inline-flex; align-items: center; }
		.btn-primary-custom:hover { background: var(--amber-cream); color: #fff; }
	</style>
</head>

<body>

	<div class="main-content">

		<div class="page-header d-flex justify-content-between align-items-center flex-wrap">
			<div>
				<h2 class="mb-0">Assign Kurir</h2>
				<p class="subtitle mb-0 mt-1">Tugaskan kurir untuk pengiriman hasil panen Anda</p>
			</div>
			<a href="<?= base_url('petani/dashboard'); ?>" class="btn btn-light" style="border-radius:10px; border:1px solid rgba(74,44,17,0.08); font-size:0.85rem;">
				<i class="bi bi-arrow-left mr-1"></i> Kembali ke Dashboard
			</a>
		</div>

		<?php if ($this->session->flashdata('success')): ?>
			<div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius:12px; border:none; background:#D1FAE5; color:#065F46; font-size:0.85rem;">
				<i class="bi bi-check-circle-fill mr-2"></i><?= $this->session->flashdata('success'); ?>
				<button type="button" class="close" data-dismiss="alert" style="font-size:1rem;">&times;</button>
			</div>
		<?php endif; ?>

		<?php if ($this->session->flashdata('error')): ?>
			<div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius:12px; border:none; background:#FEE2E2; color:#991B1B; font-size:0.85rem;">
				<i class="bi bi-exclamation-circle-fill mr-2"></i><?= $this->session->flashdata('error'); ?>
				<button type="button" class="close" data-dismiss="alert" style="font-size:1rem;">&times;</button>
			</div>
		<?php endif; ?>

		<?php if (empty($kurir_aktif)): ?>
			<div class="alert alert-warning" style="border-radius:12px; border:none; background:#FEF3C7; color:#92400E; font-size:0.85rem;">
				<i class="bi bi-exclamation-triangle-fill mr-2"></i>
				Belum ada kurir yang aktif saat ini. Silakan coba lagi nanti.
			</div>
		<?php endif; ?>

		<div class="custom-card">
			<div class="card-header-custom">
				<i class="bi bi-truck"></i>
				<h6>Pengiriman Anda yang Menunggu Kurir</h6>
				<span class="badge-count"><?= count($pengiriman_pending); ?></span>
			</div>
			<div class="card-body-custom">
				<?php if (empty($pengiriman_pending)): ?>
					<div class="text-center text-muted py-5">
						<i class="bi bi-check2-circle d-block mb-2" style="font-size:2.5rem;"></i>
						<p class="mb-0">Semua pengiriman hasil panen Anda sudah memiliki kurir.</p>
					</div>
				<?php else: ?>
					<div class="table-responsive">
						<table class="table table-custom">
							<thead>
								<tr>
									<th width="40">#</th>
									<th>Invoice</th>
									<th>Total Harga</th>
									<th>Status Pengiriman</th>
									<th>Tanggal Dibuat</th>
									<th width="220" class="text-center">Tugaskan Kurir</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; foreach ($pengiriman_pending as $row): ?>
									<tr>
										<td class="text-muted"><?= $no++; ?></td>
										<td class="link-name"><?= htmlspecialchars($row['invoice'] ?? '-'); ?></td>
										<td>Rp <?= number_format($row['total_harga'] ?? 0, 0, ',', '.'); ?></td>
										<td><span class="status-badge"><?= str_replace('_', ' ', $row['status_pengiriman']); ?></span></td>
										<td class="text-muted small"><?= date('d M Y, H:i', strtotime($row['created_at'])); ?></td>
										<td>
											<form action="<?= base_url('petani/kurir/proses_assign'); ?>" method="post" class="d-flex" style="gap:6px;">
												<input type="hidden" name="id_tracking" value="<?= $row['id_tracking']; ?>">
												<select name="id_kurir" class="form-select-custom" required <?= empty($kurir_aktif) ? 'disabled' : ''; ?>>
													<option value="">Pilih Kurir</option>
													<?php foreach ($kurir_aktif as $k): ?>
														<option value="<?= $k['id_kurir']; ?>"><?= htmlspecialchars($k['nama_kurir']); ?></option>
													<?php endforeach; ?>
												</select>
												<button type="submit" class="btn-primary-custom" <?= empty($kurir_aktif) ? 'disabled' : ''; ?>>
													<i class="bi bi-send-check-fill"></i>
												</button>
											</form>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
