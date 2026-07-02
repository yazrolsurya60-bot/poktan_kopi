<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Data Lahan</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f4f7f6;
    }

    .detail-container {
        max-width: 850px;
        margin: 40px auto;
        background: #ffffff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    }

    .btn-back {
        display: inline-block;
        padding: 8px 20px;
        background: #eef2f3;
        color: #4a5568;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .image-wrapper {
        width: 100%;
        height: 280px;
        border-radius: 15px;
        overflow: hidden;
        margin-bottom: 25px;
    }

    .image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .label-text {
        color: #718096;
        font-size: 14px;
        display: block;
        margin-bottom: 4px;
    }

    .value-text {
        color: #2d3748;
        font-weight: 600;
        font-size: 16px;
    }

    .status-pill {
        background: #c6f6d5;
        color: #22543d;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
    }

    #map {
        width: 100%;
        height: 300px;
        border-radius: 15px;
        border: 1px solid #e2e8f0;
        margin-top: 10px;
    }
    </style>
</head>

<body>

    <div class="detail-container">
        <a href="<?= base_url('petani/lahan') ?>" class="btn-back">← Kembali</a>

        <div class="image-wrapper">
            <img src="<?= base_url('assets/uploads/lahan/'.$lahan['foto_lahan']) ?>" alt="Foto Lahan">
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="margin: 0; color: #1a202c;"><?= htmlspecialchars($lahan['nama_lahan']) ?></h2>
            <span class="status-pill"><?= htmlspecialchars($lahan['status_lahan']) ?></span>
        </div>

        <div class="info-grid">
            <div>
                <span class="label-text">Jenis Kopi</span>
                <span class="value-text"><?= htmlspecialchars($lahan['jenis_kopi']) ?></span>
            </div>
            <!-- REVISI: Menampilkan data Jenis Tanah -->
            <div>
                <span class="label-text">Jenis Tanah</span>
                <span
                    class="value-text"><?= !empty($lahan['jenis_tanah']) ? htmlspecialchars($lahan['jenis_tanah']) : '-' ?></span>
            </div>
            <div>
                <span class="label-text">Luas Lahan</span>
                <span class="value-text"><?= htmlspecialchars($lahan['luas']) ?> Ha</span>
            </div>
            <div>
                <span class="label-text">Lokasi</span>
                <span class="value-text"><?= htmlspecialchars($lahan['lokasi']) ?></span>
            </div>
            <div style="grid-column: span 2;">
                <span class="label-text">Koordinat</span>
                <span class="value-text"><?= htmlspecialchars($lahan['latitude']) ?>,
                    <?= htmlspecialchars($lahan['longitude']) ?></span>
            </div>
        </div>

        <div style="margin-top: 25px;">
            <span class="label-text">Peta Lokasi</span>
            <div id="map"></div>
        </div>

        <div style="margin-top: 25px; border-top: 1px solid #edf2f7; padding-top: 20px;">
            <span class="label-text">Catatan Lahan</span>
            <p style="color: #4a5568; line-height: 1.6;">
                <?= !empty($lahan['catatan']) ? htmlspecialchars($lahan['catatan']) : 'Tidak ada catatan tambahan.' ?>
            </p>
        </div>

        <div style="margin-top: 30px; border-top: 1px solid #edf2f7; padding-top: 20px;">
            <h4 style="color: #1a202c; margin-bottom: 15px;">Riwayat Panen</h4>
            <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <thead>
                    <tr style="background: #f7fafc; text-align: left;">
                        <th style="padding: 12px; border: 1px solid #e2e8f0;">Tanggal</th>
                        <th style="padding: 12px; border: 1px solid #e2e8f0;">Jumlah (Kg)</th>
                        <th style="padding: 12px; border: 1px solid #e2e8f0;">Kualitas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($riwayat_panen)): ?>
                    <?php foreach($riwayat_panen as $p): ?>
                    <tr>
                        <td style="padding: 12px; border: 1px solid #e2e8f0;">
                            <?= htmlspecialchars($p->tanggal_panen); ?></td>
                        <td style="padding: 12px; border: 1px solid #e2e8f0;"><?= htmlspecialchars($p->jumlah_panen); ?>
                            Kg</td>
                        <td style="padding: 12px; border: 1px solid #e2e8f0;"><?= htmlspecialchars($p->kualitas); ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="3"
                            style="padding: 20px; text-align: center; border: 1px solid #e2e8f0; color: #718096;">
                            Belum ada riwayat panen.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
    var lat = <?= $lahan['latitude'] ?>;
    var lng = <?= $lahan['longitude'] ?>;
    var map = L.map('map').setView([lat, lng], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(map);
    L.marker([lat, lng]).addTo(map).bindPopup("<b><?= htmlspecialchars($lahan['nama_lahan']) ?></b>").openPopup();
    </script>

</body>

</html>