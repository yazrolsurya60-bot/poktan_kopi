<main id="main" class="main">
    <div class="pagetitle">
        <h1>Profil Detil Informasi Kebun</h1>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <?php if(!empty($lahan['foto_lahan'])): ?>
                <img src="<?= base_url('assets/uploads/lahan/'.$lahan['foto_lahan']) ?>" class="card-img-top"
                    style="height: 230px; object-fit: cover;">
                <?php else: ?>
                <div class="bg-secondary text-white text-center py-5" style="height: 230px;"><i class="bi bi-image"
                        style="font-size: 40px;"></i><br>Foto Sampul Kebun Belum Diunggah</div>
                <?php endif; ?>

                <div class="card-body pt-3">
                    <h5 class="card-title p-0 mb-3"><?= $lahan['nama_lahan'] ?></h5>
                    <table class="table table-bordered text-sm">
                        <tr>
                            <th width="35%">Jenis Tanaman Kopi</th>
                            <td><?= $lahan['jenis_kopi'] ?></td>
                        </tr>
                        <tr>
                            <th>Luas Wilayah</th>
                            <td><?= $lahan['luas'] ?> Hektar</td>
                        </tr>
                        <tr>
                            <th>Alamat / Lokasi</th>
                            <td><?= $lahan['lokasi'] ?></td>
                        </tr>
                        <tr>
                            <th>Koordinat GPS</th>
                            <td><?= $lahan['latitude'] ?>, <?= $lahan['longitude'] ?></td>
                        </tr>
                        <tr>
                            <th>Status Produktivitas</th>
                            <td><span class="badge bg-info"><?= $lahan['status_lahan'] ?></span></td>
                        </tr>
                    </table>

                    <div class="p-3 bg-light rounded mb-3">
                        <h6><strong>Catatan Perawatan Lahan:</strong></h6>
                        <p class="mb-0 text-muted">
                            <?= !empty($lahan['catatan']) ? nl2br($lahan['catatan']) : 'Tidak ada catatan khusus.' ?>
                        </p>
                    </div>

                    <a href="<?= base_url('petani/lahan/edit/'.$lahan['id_lahan']) ?>"
                        class="btn btn-warning text-white btn-sm">Ubah Data</a>
                    <a href="<?= base_url('petani/lahan') ?>" class="btn btn-secondary btn-sm">Kembali</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body pt-3">
                    <h5><i class="bi bi-geo"></i> Verifikasi Lokasi Peta Tunggal</h5>
                    <div id="mapSingleDetail" style="height: 440px; border-radius: 8px; border: 1px solid #ccc;"></div>
                </div>
            </div>
        </div>
    </div>
</main>

<link rel="stylesheet" href="<?= base_url('assets/leaflet/leaflet.css') ?>" />
<script src="<?= base_url('assets/leaflet/leaflet.js') ?>"></script>
<script>
var map = L.map('mapSingleDetail').setView([<?= $lahan['latitude'] ?>, <?= $lahan['longitude'] ?>], 14);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
L.marker([<?= $lahan['latitude'] ?>, <?= $lahan['longitude'] ?>]).addTo(map).bindPopup(
    "<b><?= $lahan['nama_lahan'] ?></b>").openPopup();
</script>