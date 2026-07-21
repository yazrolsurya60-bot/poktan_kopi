<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Kotak Masuk Notifikasi - Poktan</title>
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
		}

		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: 'Plus Jakarta Sans', sans-serif;
			background-color: var(--bg-cream);
			color: var(--dark-coffee);
			min-height: 100vh;
		}

		.box-container {
			background: var(--card-white);
			border: 1px solid #EFEAE2;
			border-radius: 16px;
			box-shadow: 0 4px 15px rgba(0, 0, 0, 0.01);
			padding: 30px;
			margin-top: 40px;
			margin-bottom: 40px;
		}

		/* ============================================ */
		/* NOTIF ITEM - LOGIKA WARNA BENAR */
		/* ============================================ */

		.notif-item {
			border: 1px solid #EFEAE2;
			border-radius: 10px;
			transition: all 0.2s ease;
			padding: 18px 20px;
			display: flex;
			align-items: center;
			justify-content: space-between;
			margin-bottom: 12px;
			text-decoration: none;
			color: inherit;
			cursor: pointer;
		}

		.notif-item:hover {
			border-color: var(--amber-cream);
			text-decoration: none;
			color: inherit;
		}

		/* ✅ BELUM DIBACA - WARNA KUNING (HIGHLIGHT) */
		.notif-item.unread {
			background-color: var(--card-white);
			border-color: #EFEAE2;
		}

		.notif-item.unread:hover {
			background-color: #FEF9C3;
			/* Kuning lebih pekat saat hover */
		}

		/* ✅ SUDAH DIBACA - WARNA PUTIH (NORMAL) */
		.notif-item.read {
			background-color: #FEFCE8;
			/* Kuning terang */
			border-color: #FDE68A;
			/* Border kuning */
			border-left: 4px solid var(--amber-cream);
		}

		.notif-item.read:hover {
			background-color: #FAFAFA;
		}

		/* ============================================ */
		/* HEADER */
		/* ============================================ */

		.back-btn {
			background-color: var(--roasted-brown);
			color: white;
			font-weight: 600;
			border-radius: 8px;
			padding: 8px 16px;
			transition: opacity 0.2s;
			text-decoration: none;
			display: inline-flex;
			align-items: center;
			gap: 6px;
		}

		.back-btn:hover {
			color: white;
			opacity: 0.9;
			text-decoration: none;
		}

		.mark-all-btn {
			background: transparent;
			border: 1px solid var(--amber-cream);
			color: var(--roasted-brown);
			border-radius: 8px;
			padding: 8px 16px;
			font-weight: 600;
			font-size: 0.85rem;
			transition: all 0.2s;
			cursor: pointer;
			display: inline-flex;
			align-items: center;
			gap: 6px;
		}

		.mark-all-btn:hover {
			background: var(--amber-cream);
			color: white;
		}

		/* ============================================ */
		/* ICON CIRCLE */
		/* ============================================ */

		.notif-icon-success {
			background: #D1FAE5;
			color: #065F46;
		}

		.notif-icon-warning {
			background: #FEF3C7;
			color: #92400E;
		}

		.notif-icon-danger {
			background: #FEE2E2;
			color: #991B1B;
		}

		.notif-icon-info {
			background: #DBEAFE;
			color: #1E40AF;
		}

		.notif-icon-primary {
			background: #EDE9FE;
			color: #5B21B6;
		}

		.notif-icon-default {
			background: #FDF5ED;
			color: var(--amber-cream);
		}

		.icon-circle {
			width: 40px;
			height: 40px;
			min-width: 40px;
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 1.1rem;
		}

		/* ============================================ */
		/* EMPTY STATE */
		/* ============================================ */

		.notif-empty {
			text-align: center;
			padding: 60px 20px;
		}

		.notif-empty i {
			font-size: 4rem;
			color: #D1C9C0;
			display: block;
			margin-bottom: 16px;
		}

		.notif-empty h5 {
			color: var(--dark-coffee);
			font-weight: 600;
		}

		.notif-empty p {
			color: var(--text-secondary);
		}

		/* ============================================ */
		/* TEXT STYLE */
		/* ============================================ */

		.notif-judul {
			font-weight: 700;
			color: var(--dark-coffee);
			font-size: 0.95rem;
			margin-bottom: 4px;
			display: flex;
			align-items: center;
			flex-wrap: wrap;
			gap: 6px;
		}

		.notif-isi {
			color: #4a3a2e;
			font-size: 0.9rem;
			word-wrap: break-word;
			line-height: 1.5;
		}

		.notif-tanggal {
			font-size: 0.7rem;
			color: var(--text-secondary);
			min-width: 130px;
			text-align: right;
			flex-shrink: 0;
		}

		/* ============================================ */
		/* RESPONSIF */
		/* ============================================ */

		@media (max-width: 768px) {
			.box-container {
				padding: 20px 16px;
				margin-top: 20px;
				margin-bottom: 20px;
				border-radius: 12px;
			}

			.notif-item {
				padding: 14px 16px;
				flex-wrap: wrap;
			}

			.notif-tanggal {
				text-align: left;
				margin-top: 8px;
				min-width: auto;
				width: 100%;
				padding-left: 52px;
			}

			.notif-judul {
				font-size: 0.85rem;
			}

			.notif-isi {
				font-size: 0.8rem;
			}

			.icon-circle {
				width: 34px;
				height: 34px;
				min-width: 34px;
				font-size: 0.9rem;
			}
		}

		@media (max-width: 576px) {
			.box-container {
				padding: 16px 12px;
				margin-top: 12px;
				border-radius: 10px;
			}

			.notif-item {
				padding: 12px 14px;
				border-radius: 8px;
			}

			.notif-judul {
				font-size: 0.8rem;
				gap: 4px;
			}

			.notif-isi {
				font-size: 0.75rem;
			}

			.notif-tanggal {
				font-size: 0.6rem;
				padding-left: 46px;
			}

			.icon-circle {
				width: 30px;
				height: 30px;
				min-width: 30px;
				font-size: 0.75rem;
			}

			.d-flex.justify-content-between.align-items-center {
				flex-direction: column;
				align-items: flex-start !important;
				gap: 12px;
			}

			.d-flex.gap-2.mt-2.mt-md-0 {
				width: 100%;
				flex-wrap: wrap;
			}

			.mark-all-btn,
			.back-btn {
				font-size: 0.75rem;
				padding: 6px 12px;
			}

			.badge {
				font-size: 0.65rem !important;
				padding: 4px 10px !important;
			}
		}

		@media (max-width: 400px) {
			.box-container {
				padding: 12px 8px;
			}

			.notif-item {
				padding: 10px 10px;
			}

			.notif-judul {
				font-size: 0.7rem;
			}

			.notif-isi {
				font-size: 0.65rem;
			}

			.notif-tanggal {
				font-size: 0.55rem;
				padding-left: 38px;
			}

			.icon-circle {
				width: 26px;
				height: 26px;
				min-width: 26px;
				font-size: 0.65rem;
				margin-right: 10px !important;
			}
		}
	</style>
</head>

<body>

	<div class="container">
		<div class="box-container">
			<!-- HEADER -->
			<div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4 flex-wrap"
				style="border-color: rgba(74,44,17,0.08); gap: 12px;">
				<div>
					<h4 class="font-weight-bold mb-1" style="color: var(--roasted-brown);">
						<i class="bi bi-clock-history mr-2" style="color: var(--amber-cream);"></i> Riwayat Pemberitahuan
					</h4>
					<p class="text-muted small mb-0">Daftar rekaman seluruh log aktivitas notifikasi akun Anda.</p>
				</div>
				<div class="d-flex gap-2" style="gap: 8px; flex-wrap: wrap;">
					<?php if (!empty($history)): ?>
						<button class="mark-all-btn" id="markAllReadBtn">
							<i class="bi bi-check2-all mr-1"></i> Tandai Semua Dibaca
						</button>
					<?php endif; ?>
					<a href="<?= base_url($this->session->userdata('role') . '/dashboard'); ?>" class="back-btn shadow-sm">
						<i class="bi bi-arrow-left mr-1"></i> Kembali
					</a>
				</div>
			</div>

			<!-- STATISTIK BADGE -->
			<?php if (!empty($history)):
				$total = count($history);
				$unread = 0;
				foreach ($history as $h) {
					if (is_object($h)) {
						$status = $h->status_baca ?? 0;
					} else {
						$status = $h['status_baca'] ?? 0;
					}
					if ($status == 0) $unread++;
				}
				$read = $total - $unread;
			?>
				<div class="d-flex flex-wrap gap-3 mb-4" style="gap: 12px;">
					<!-- TOTAL -->
					<span class="badge" style="background: var(--bg-cream); color: var(--text-secondary); padding: 8px 16px; font-weight:600; font-size:0.8rem;">
						<i class="bi bi-inbox mr-1"></i> Total: <?= $total; ?>
					</span>

					<!-- BELUM DIBACA (KUNING) -->
					<?php if ($unread > 0): ?>
						<span class="badge" style="background: #FFFFFF; color: #92400E; padding: 8px 16px; font-weight:600; font-size:0.8rem; border: 1px solid #EFEAE2;">
							<i class="bi bi-envelope mr-1"></i> Sudah Dibaca: <?= $unread; ?>
						</span>
					<?php endif; ?>

					<!-- SUDAH DIBACA (PUTIH) -->
					<?php if ($read > 0): ?>
						<span class="badge" style="background: #FEF3C7; color: var(--text-secondary); padding: 8px 16px; font-weight:600; font-size:0.8rem; border: 1px solid #EFEAE2;">
							<i class="bi bi-check-circle mr-1"></i> Belum Dibaca: <?= $read; ?>
						</span>
					<?php endif; ?>

					<!-- KONDISI SEMUA BELUM DIBACA (PUTIH) -->
					<?php if ($unread == $total && $total > 0): ?>
						<span class="badge" style="background: #FFFFFF; color: var(--text-secondary); padding: 8px 16px; font-weight:600; font-size:0.8rem; border: 1px solid #EFEAE2;">
							<i class="bi bi-envelope mr-1"></i> Semua Sudah Dibaca
						</span>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<!-- LIST RIWAYAT -->
			<div class="list-group mt-3">
				<?php if (!empty($history)): ?>
					<?php foreach ($history as $h):
						if (is_object($h)) {
							$is_read = $h->status_baca ?? 0;
							$icon_type = $h->icon ?? 'default';
							$judul = $h->judul ?? 'Notifikasi';
							$isi = $h->isi_notifikasi ?? $h->pesan ?? '';
							$tanggal = isset($h->tanggal_buat) ? date('d M Y, H:i', strtotime($h->tanggal_buat)) : (isset($h->created_at) ? date('d M Y, H:i', strtotime($h->created_at)) : '');
							$link = $h->link ?? '#';
							$id_notif = $h->id_notifikasi ?? 0;
						} else {
							$is_read = $h['status_baca'] ?? 0;
							$icon_type = $h['icon'] ?? 'default';
							$judul = $h['judul'] ?? 'Notifikasi';
							$isi = $h['isi_notifikasi'] ?? $h['pesan'] ?? '';
							$tanggal = isset($h['tanggal_buat']) ? date('d M Y, H:i', strtotime($h['tanggal_buat'])) : (isset($h['created_at']) ? date('d M Y, H:i', strtotime($h['created_at'])) : '');
							$link = $h['link'] ?? '#';
							$id_notif = $h['id_notifikasi'] ?? 0;
						}

						$icon_map = [
							'success' => 'bi-check-circle-fill',
							'warning' => 'bi-exclamation-triangle-fill',
							'danger' => 'bi-x-circle-fill',
							'info' => 'bi-info-circle-fill',
							'primary' => 'bi-star-fill',
							'default' => 'bi-envelope-fill'
						];
						$icon_class = $icon_map[$icon_type] ?? 'bi-envelope-fill';

						$role = $this->session->userdata('role');
						$read_url = base_url($role . '/dashboard/read/' . $id_notif . '?redirect=' . urlencode($link));
					?>
						<!-- LOGIKA: status_baca == 0 -> unread (Kuning), status_baca == 1 -> read (Putih) -->
						<a class="notif-item <?= $is_read == 0 ? 'unread' : 'read'; ?>"
							href="<?= $read_url; ?>">
							<div class="d-flex align-items-center" style="flex: 1; min-width: 0; gap: 12px;">
								<div class="icon-circle notif-icon-<?= $icon_type; ?>">
									<i class="bi <?= $icon_class; ?>"></i>
								</div>

								<div style="flex: 1; min-width: 0;">
									<?php if (!empty($judul)): ?>
										<div class="notif-judul">
											<?= htmlspecialchars($judul); ?>

											<!-- BADGE ITEM: BELUM DIBACA = KUNING, SUDAH DIBACA = PUTIH -->
											<?php if ($is_read == 0): ?>
												<span class="badge" style="font-size:0.5rem; padding:2px 8px; background: #FEF3C7; color: #92400E; border: 1px solid #FDE68A; border-radius:10px; font-weight:600;">
													Sudah Dibaca
												</span>
											<?php else: ?>
												<span class="badge" style="font-size:0.5rem; padding:2px 8px; background: #FFFFFF; color: var(--text-secondary); border: 1px solid #EFEAE2; border-radius:10px; font-weight:600;">
													Belum Dibaca
												</span>
											<?php endif; ?>
										</div>
									<?php endif; ?>
									<div class="notif-isi">
										<?= htmlspecialchars($isi); ?>
									</div>
								</div>
							</div>

							<div class="notif-tanggal">
								<i class="bi bi-calendar3 mr-1"></i>
								<?= $tanggal; ?>
							</div>
						</a>
					<?php endforeach; ?>
				<?php else: ?>
					<div class="notif-empty">
						<i class="bi bi-inbox"></i>
						<h5>Kotak Masuk Kosong</h5>
						<p>Belum ada riwayat notifikasi masuk ke akun Anda.</p>
					</div>
				<?php endif; ?>
			</div>

			<?php if (!empty($history) && count($history) >= 50): ?>
				<div class="mt-4 text-center">
					<nav>
						<ul class="pagination justify-content-center">
							<li class="page-item disabled"><span class="page-link">Sebelumnya</span></li>
							<li class="page-item active"><span class="page-link" style="background-color: var(--roasted-brown); border-color: var(--roasted-brown);">1</span></li>
							<li class="page-item"><a class="page-link" href="#" style="color: var(--roasted-brown);">2</a></li>
							<li class="page-item"><a class="page-link" href="#" style="color: var(--roasted-brown);">3</a></li>
							<li class="page-item"><a class="page-link" href="#" style="color: var(--roasted-brown);">Selanjutnya</a></li>
						</ul>
					</nav>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#markAllReadBtn').on('click', function() {
				if (confirm('Tandai semua notifikasi sebagai sudah dibaca?')) {
					$.ajax({
						url: '<?= base_url('api/notifikasi/mark_all_read'); ?>',
						type: 'POST',
						dataType: 'json',
						success: function(response) {
							if (response.success) {
								location.reload();
							} else {
								alert('Gagal menandai semua notifikasi.');
							}
						},
						error: function() {
							alert('Terjadi kesalahan. Silakan coba lagi.');
						}
					});
				}
			});
		});
	</script>
</body>

</html>
