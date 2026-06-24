<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

    <div class="card-body-custom">

       <form action="<?= base_url('admin/produk/simpan'); ?>"
      method="post"
      enctype="multipart/form-data">

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group mb-3">
                        <label>Nama Produk</label>
                        <input type="text"
                               name="nama_produk"
                               class="form-control"
                               placeholder="Masukkan nama produk"
                               required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Jenis Kopi</label>
                        <select name="jenis_kopi" class="form-control">
                            <option value="">Pilih Jenis Kopi</option>
                            <option>Arabica</option>
                            <option>Robusta</option>
                            <option>Liberica</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Grade</label>
                        <select name="grade" class="form-control">
                            <option value="">Pilih Grade</option>
                            <option>A</option>
                            <option>AA</option>
                            <option>B</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Harga (Rp)</label>
                        <input type="number"
                               name="harga"
                               class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label>Stok</label>
                        <input type="number"
                               name="stok_produk"
                               class="form-control">
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group mb-3">
                        <label>Altitude</label>
                        <input type="text"
                               name="altitude"
                               class="form-control"
                               placeholder="800 - 1200 mdpl">
                    </div>

                    <div class="form-group mb-3">
                        <label>Proses</label>
                        <input type="text"
                               name="proses"
                               class="form-control"
                               placeholder="Honey, Natural, Washed">
                    </div>

                    <div class="form-group mb-3">
                        <label>Flavor Notes</label>
                        <textarea class="form-control"
                                  rows="3"
                                  name="flavor_notes"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>Deskripsi</label>
                        <textarea class="form-control"
                                  rows="3"
                                  name="deskripsi"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>Status Produk</label>

                        <select name="status_produk"
                                class="form-control">

                            <option value="Aktif">
                                Aktif
                            </option>

                            <option value="Nonaktif">
                                Nonaktif
                            </option>

                        </select>

                    </div>

                </div>

            </div>

            <div class="text-end mt-4">

                <a href="<?= base_url('admin/produk'); ?>"
                   class="btn btn-light">

                    Batal

                </a>

                <button type="submit"
                        class="btn text-white"
                        style="background:#E6A15C;">

                    Simpan Produk

                </button>

            </div>

        </form>

    </div>

</div>