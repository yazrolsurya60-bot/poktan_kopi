<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Sistem Supply Chain Kopi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
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

        ul li a:hover,
        ul li.active>a {
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

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #E2DCD5;
            padding: 10px 15px;
            height: auto;
        }

        .form-control:focus {
            border-color: var(--amber-cream);
            box-shadow: 0 0 0 0.2rem rgba(230, 161, 92, 0.25);
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
                <li>
                    <a href="#"><i class="bi bi-speedometer2"></i> Dashboard</a>
                </li>
                <li class="active">
                    <a href="<?= base_url('admin/produk'); ?>"><i class="bi bi-box-seam"></i> Manajemen Produk</a>
                </li>
                <li>
                    <a href="#"><i class="bi bi-people"></i> Data Petani</a>
                </li>
                <li>
                    <a href="#"><i class="bi bi-cart3"></i> Transaksi</a>
                </li>
                <li>
                    <a href="#"><i class="bi bi-graph-up"></i> Laporan</a>
                </li>
            </ul>
        </nav>

        <div id="content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 style="font-weight: 700; font-size: 28px; color: var(--dark-coffee); margin-bottom: 5px;">Tambah
                        Produk Baru</h2>
                    <p style="color: var(--text-secondary); margin: 0;">Silakan lengkapi spesifikasi produk komoditas
                        kopi</p>
                </div>
            </div>

            <div class="card-custom">
               <form action="<?= base_url('admin/produk/simpan'); ?>"
                    method="post"
                    enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Nama Produk</label>
                                <input type="text" name="nama_produk" class="form-control"
                                    placeholder="Masukkan nama produk" required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Jenis Kopi</label>
                                <select name="jenis_kopi" class="form-control" required>
                                    <option value="">Pilih Jenis Kopi</option>
                                    <option value="Arabica">Arabica</option>
                                    <option value="Robusta">Robusta</option>
                                    <option value="Liberica">Liberica</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Grade</label>
                                <select name="grade" class="form-control" required>
                                    <option value="">Pilih Grade</option>
                                    <option value="A">A</option>
                                    <option value="AA">AA</option>
                                    <option value="B">B</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Harga (Rp)</label>
                                <input type="number" name="harga" class="form-control" placeholder="Contoh: 120000"
                                    required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Stok</label>
                                <input type="number" name="stok_produk" class="form-control" placeholder="Contoh: 50"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Altitude</label>
                                <input type="text" name="altitude" class="form-control" placeholder="Contoh: 1200 mdpl">
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Proses Pengolahan</label>
                                <input type="text" name="proses" class="form-control"
                                    placeholder="Contoh: Full Washed, Natural">
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Flavor Notes</label>
                                <textarea class="form-control" rows="2" name="flavor_notes"
                                    placeholder="Contoh: Fruity, Chocolatey, Nutty..."></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Deskripsi</label>
                                <textarea class="form-control" rows="3" name="deskripsi"
                                    placeholder="Tuliskan deskripsi lengkap produk..."></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Status Produk</label>
                                <select name="status_produk" class="form-control">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Nonaktif">Nonaktif</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Foto Produk</label>
                                <input type="file" name="foto_utama" class="form-control" accept=".jpg,.jpeg,.png">
                            </div>
                        </div>

                    </div>

                    <div class="text-right mt-4 border-top pt-3">
                        <a href="<?= base_url('admin/produk'); ?>" class="btn btn-light px-4 mr-2"
                            style="border-radius: 8px;">Batal</a>
                        <button type="submit" class="btn text-white px-4"
                            style="background: var(--amber-cream); border-radius: 8px;">
                            <i class="bi bi-save mr-1"></i> Simpan Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>