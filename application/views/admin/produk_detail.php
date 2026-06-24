<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - Sistem Supply Chain Kopi</title>
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
            --sidebar-width: 260px;
            --shadow-soft: 0 8px 30px rgb(74, 44, 17, 0.05);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-cream);
            color: var(--dark-coffee);
        }

        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }

        #sidebar {
            min-width: var(--sidebar-width);
            max-width: var(--sidebar-width);
            background: var(--dark-coffee);
            color: #fff;
            min-height: 100vh;
            position: fixed;
            transition: all 0.3s;
        }

        .sidebar-header {
            padding: 30px 25px;
            background: #1F1005;
        }

        .sidebar-header h3 {
            font-size: 20px;
            font-weight: 700;
            color: var(--amber-cream);
            margin: 0;
        }

        ul.components {
            padding: 20px 0;
        }

        ul li a {
            padding: 15px 25px;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s;
        }

        ul li a:hover, ul li.active > a {
            color: #fff;
            background: rgba(230, 161, 92, 0.1);
            border-left: 4px solid var(--amber-cream);
        }

        #content {
            width: calc(100% - var(--sidebar-width));
            padding: 40px;
            min-height: 100vh;
            margin-left: var(--sidebar-width);
            transition: all 0.3s;
        }

        .card-custom {
            background: var(--card-white);
            border: none;
            border-radius: 16px;
            box-shadow: var(--shadow-soft);
            padding: 30px;
        }

        .detail-label {
            font-size: 13px;
            color: var(--text-secondary);
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .detail-value {
            font-size: 16px;
            font-weight: 700;
            color: var(--dark-coffee);
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Poktan Kopi v1.0</h3>
            </div>
            <ul class="list-unstyled components">
                <li><a href="#"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
                <li class="active"><a href="<?= base_url('admin/produk'); ?>"><i class="bi bi-box-seam"></i> Manajemen Produk</a></li>
                <li><a href="#"><i class="bi bi-people"></i> Data Petani</a></li>
                <li><a href="#"><i class="bi bi-cart3"></i> Transaksi</a></li>
                <li><a href="#"><i class="bi bi-graph-up"></i> Laporan</a></li>
            </ul>
        </nav>

        <div id="content">
            <div class="mb-4">
                <h2 style="font-weight: 700; font-size: 28px; color: var(--dark-coffee); margin-bottom: 5px;">Detail Spesifikasi Produk</h2>
                <p style="color: var(--text-secondary); margin: 0;">Melihat data teknis komoditas kopi secara lengkap</p>
            </div>

            <div class="card-custom">
                <div class="row">
                    <div class="col-md-6">
                        <div class="detail-label">Nama Produk</div>
                        <div class="detail-value"><?= $produk->nama_produk; ?></div>

                        <div class="detail-label">Jenis Kopi</div>
                        <div class="detail-value"><span class="badge bg-light text-dark border px-3 py-2"><?= $produk->jenis_kopi; ?></span></div>

                        <div class="detail-label">Grade Kopi</div>
                        <div class="detail-value"><?= $produk->grade; ?></div>

                        <div class="detail-label">Harga per Kilogram</div>
                        <div class="detail-value" style="color: var(--roasted-brown); font-size: 20px;">Rp <?= number_format($produk->harga, 0, ',', '.'); ?></div>

                        <div class="detail-label">Stok Tersedia</div>
                        <div class="detail-value"><?= $produk->stok_produk; ?> Pcs</div>
                    </div>

                    <div class="col-md-6">
                        <div class="detail-label">Altitude (Ketinggian Tanam)</div>
                        <div class="detail-value"><?= !empty($produk->altitude) ? $produk->altitude : '-'; ?></div>

                        <div class="detail-label">Proses Pengolahan</div>
                        <div class="detail-value"><?= !empty($produk->proses) ? $produk->proses : '-'; ?></div>

                        <div class="detail-label">Flavor Notes (Catatan Rasa)</div>
                        <div class="detail-value" style="font-style: italic; font-weight: 500;"><?= !empty($produk->flavor_notes) ? $produk->flavor_notes : '-'; ?></div>

                        <div class="detail-label">Status Penjualan</div>
                        <div class="detail-value">
                            <span class="badge <?= strtolower($produk->status_produk) == 'aktif' ? 'badge-success' : 'badge-danger'; ?> px-3 py-2">
                                <?= $produk->status_produk; ?>
                            </span>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="detail-label">Deskripsi Produk</div>
                        <div class="p-3 bg-light rounded" style="font-size: 15px; color: #555; line-height: 1.6; border: 1px solid #E2DCD5;">
                            <?= !empty($produk->deskripsi) ? nl2br($produk->deskripsi) : 'Tidak ada deskripsi.'; ?>
                        </div>
                    </div>
                </div>

                <div class="text-right mt-4 border-top pt-3">
                    <a href="<?= base_url('admin/produk'); ?>" class="btn btn-secondary px-4" style="border-radius: 8px;">
                        <i class="bi bi-arrow-left mr-1"></i> Kembali ke List
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>