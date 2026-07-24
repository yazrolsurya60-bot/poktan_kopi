<!-- Tabel Data -->
<table class="data-table">
    <thead>
        <tr>
            <th style="width: 30px;">No</th>
            <th>Nama Petani</th>
            <th>NIK</th>
            <th>No HP</th>
            <th>Alamat</th>
            <th style="text-align: center;">Status</th>
            <th>Tgl Daftar</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($daftar_petani)): ?>
            <?php $no = 1; foreach ($daftar_petani as $p): ?>
                <?php
                    $status_petani = $p['status_petani'] ?? '';
                    $stat = strtolower($status_petani);
                    if ($stat == 'active') $badge = 'badge-active';
                    elseif ($stat == 'suspended') $badge = 'badge-suspended';
                    elseif ($stat == 'inactive') $badge = 'badge-inactive';
                    else $badge = 'badge-other';

                    $nama_petani    = $p['nama_petani'] ?? '-';
                    $nik            = $p['nik'] ?? '';
                    $no_hp          = $p['no_hp'] ?? '';
                    $alamat         = $p['alamat'] ?? '';
                    $tanggal_raw    = $p['tanggal_daftar'] ?? '';
                    $tanggal_ts     = !empty($tanggal_raw) ? strtotime($tanggal_raw) : false;
                    $tanggal_daftar = $tanggal_ts ? date('d/m/Y', $tanggal_ts) : '-';
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><strong><?= htmlspecialchars($nama_petani); ?></strong></td>
                    <td><?= htmlspecialchars($nik ?: '-'); ?></td>
                    <td><?= htmlspecialchars($no_hp ?: '-'); ?></td>
                    <td><?= htmlspecialchars($alamat ?: '-'); ?></td>
                    <td style="text-align: center;">
                        <span class="badge-status <?= $badge; ?>"><?= htmlspecialchars($status_petani ?: '-'); ?></span>
                    </td>
                    <td><?= $tanggal_daftar; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="7" style="text-align: center; padding: 20px; color: #aaa;">Belum ada data petani.</td></tr>
        <?php endif; ?>
    </tbody>
</table>