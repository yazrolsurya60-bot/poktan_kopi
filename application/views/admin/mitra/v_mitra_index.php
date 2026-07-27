<style>
    :root {
        --roasted-brown: #4A2C11;
        --dark-coffee:   #2C1808;
        --amber-cream:   #E6A15C;
        --forest-green:  #2D6A4F;
        --bg-cream:      #FAF6F0;
        --card-white:    #FFFFFF;
        --text-secondary:#70655E;
        --shadow-soft:   0 8px 30px rgba(44,24,8,0.08);
        --shadow-hover:  0 12px 40px rgba(44,24,8,0.15);
        --radius-card:   14px;
        --transition-smooth: all 0.3s cubic-bezier(0.4,0,0.2,1);
    }

    /* ===== STAT CARDS ===== */
    .stat-card { background: var(--card-white); border-radius: var(--radius-card); box-shadow: var(--shadow-soft); border: 1px solid rgba(74,44,17,0.06); padding: 20px 22px; display: flex; align-items: center; gap: 16px; transition: var(--transition-smooth); height: 100%; }
    .stat-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-hover); }
    .stat-icon { width: 50px; height: 50px; border-radius: 13px; display: flex; align-items: center; justify-content: center; font-size: 1.35rem; flex-shrink: 0; }
    .stat-icon.brown  { background: rgba(74,44,17,0.08);   color: var(--roasted-brown); }
    .stat-icon.green  { background: rgba(45,106,79,0.1);   color: var(--forest-green); }
    .stat-icon.red    { background: rgba(239,68,68,0.09);  color: #dc2626; }
    .stat-icon.amber  { background: rgba(230,161,92,0.15); color: #c47b2a; }
    .stat-value { font-size: 1.65rem; font-weight: 800; color: var(--dark-coffee); line-height: 1; margin-bottom: 3px; }
    .stat-label { font-size: 0.72rem; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.5px; }

    /* ===== TABLE CARD ===== */
    .table-card { background: var(--card-white); border-radius: var(--radius-card); box-shadow: var(--shadow-soft); border: 1px solid rgba(74,44,17,0.06); overflow: hidden; }
    .table-card-header { padding: 18px 22px; border-bottom: 1px solid rgba(74,44,17,0.06); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; }
    .table-title { font-size: 0.9rem; font-weight: 700; color: var(--dark-coffee); margin: 0; display: flex; align-items: center; gap: 8px; }
    .table-title i { color: var(--amber-cream); }

    /* filter */
    .filter-form { display: flex; align-items: center; flex-wrap: wrap; gap: 7px; }
    .filter-form input, .filter-form select { padding: 7px 11px; border: 1px solid rgba(74,44,17,0.15); border-radius: 9px; font-size: 0.8rem; color: var(--dark-coffee); background: var(--bg-cream); transition: var(--transition-smooth); height: auto; font-family: inherit; }
    .filter-form input:focus, .filter-form select:focus { border-color: var(--amber-cream); box-shadow: 0 0 0 3px rgba(230,161,92,0.15); outline: none; background: #fff; }

    /* search box with clickable icon */
    .search-wrap { position: relative; display: inline-flex; align-items: center; }
    .search-wrap input[name="search"] { padding-right: 34px; }
    .btn-search-icon { position: absolute; right: 4px; top: 50%; transform: translateY(-50%); width: 26px; height: 26px; border: none; border-radius: 7px; background: transparent; color: var(--text-secondary); display: flex; align-items: center; justify-content: center; cursor: pointer; transition: var(--transition-smooth); padding: 0; font-size: 0.85rem; }
    .btn-search-icon:hover { background: var(--amber-cream); color: #fff; }
    .btn-filter { padding: 7px 15px; border: 1px solid rgba(74,44,17,0.15); border-radius: 9px; background: transparent; color: var(--text-secondary); font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: var(--transition-smooth); display: inline-flex; align-items: center; gap: 5px; font-family: inherit; }
    .btn-filter:hover { background: var(--bg-cream); color: var(--roasted-brown); border-color: var(--roasted-brown); }
    .btn-reset { padding: 7px 13px; border: 1px solid rgba(239,68,68,0.2); border-radius: 9px; background: rgba(239,68,68,0.05); color: #dc2626; font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: var(--transition-smooth); display: inline-flex; align-items: center; gap: 5px; text-decoration: none; font-family: inherit; }
    .btn-reset:hover { background: rgba(239,68,68,0.1); color: #dc2626; text-decoration: none; }

    /* table */
    .mitra-table { margin: 0; font-size: 0.85rem; }
    .mitra-table thead th { border: none; border-bottom: 2px solid rgba(74,44,17,0.07); color: var(--text-secondary); font-weight: 700; font-size: 0.68rem; text-transform: uppercase; letter-spacing: 0.8px; padding: 12px 16px; background: rgba(250,246,240,0.5); white-space: nowrap; }
    .mitra-table tbody td { vertical-align: middle; border-top: none; border-bottom: 1px solid rgba(74,44,17,0.04); padding: 13px 16px; font-weight: 500; color: var(--dark-coffee); }
    .mitra-table tbody tr { transition: var(--transition-smooth); }
    .mitra-table tbody tr:hover { background: rgba(230,161,92,0.04); }
    .mitra-table tbody tr:last-child td { border-bottom: none; }

    .logo-thumb { width: 46px; height: 46px; object-fit: contain; border-radius: 10px; border: 1px solid rgba(74,44,17,0.08); background: var(--bg-cream); padding: 3px; }
    .logo-placeholder { width: 46px; height: 46px; border-radius: 10px; border: 1px dashed rgba(74,44,17,0.2); background: var(--bg-cream); display: flex; align-items: center; justify-content: center; color: var(--text-secondary); font-size: 1.1rem; }
    .mitra-name { font-weight: 700; color: var(--dark-coffee); margin: 0; font-size: 0.875rem; }
    .mitra-meta { font-size: 0.7rem; color: var(--text-secondary); margin: 0; }
    .kontak-line { font-size: 0.78rem; color: var(--dark-coffee); margin: 0 0 3px; font-weight: 500; display: flex; align-items: center; gap: 6px; }
    .kontak-line:last-child { margin-bottom: 0; }
    .kontak-line i { color: var(--amber-cream); font-size: 0.75rem; width: 13px; }
    .kontak-line.muted { color: var(--text-secondary); font-weight: 400; }
    .kontak-empty { color: var(--text-secondary); font-size: 0.8rem; }
    .kategori-pill { display: inline-block; padding: 3px 10px; border-radius: 20px; background: rgba(74,44,17,0.07); color: var(--roasted-brown); font-size: 0.7rem; font-weight: 600; }

    .urutan-input { width: 64px; text-align: center; font-weight: 700; font-size: 0.875rem; color: var(--dark-coffee); background: rgba(250,246,240,0.7); border: 1px solid rgba(230,161,92,0.25); border-radius: 8px; padding: 5px 6px; height: auto; transition: var(--transition-smooth); }
    .urutan-input:focus { background: #fff; border-color: var(--amber-cream); box-shadow: 0 0 0 3px rgba(230,161,92,0.15); outline: none; }
    .urutan-saved { background: rgba(45,106,79,0.12) !important; border-color: rgba(45,106,79,0.35) !important; }

    .status-badge { display: inline-flex; align-items: center; gap: 5px; padding: 5px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: 700; letter-spacing: 0.3px; cursor: pointer; transition: var(--transition-smooth); border: 1px solid transparent; white-space: nowrap; }
    .status-badge.active   { background: rgba(45,106,79,0.1);  color: var(--forest-green); border-color: rgba(45,106,79,0.2); }
    .status-badge.inactive { background: rgba(239,68,68,0.09); color: #dc2626;              border-color: rgba(239,68,68,0.18); }
    .status-badge.active:hover   { background: rgba(45,106,79,0.18); }
    .status-badge.inactive:hover { background: rgba(239,68,68,0.15); }

    .btn-action-group { display: flex; gap: 6px; justify-content: flex-end; }
    .btn-icon { width: 34px; height: 34px; border-radius: 9px; display: flex; align-items: center; justify-content: center; transition: var(--transition-smooth); border: none; cursor: pointer; font-size: 0.9rem; text-decoration: none; }
    .btn-icon:hover { transform: translateY(-2px); text-decoration: none; }
    .btn-edit   { background: rgba(230,161,92,0.12); color: #c47b2a; }
    .btn-edit:hover   { background: var(--amber-cream); color: #fff; box-shadow: 0 4px 12px rgba(230,161,92,0.35); }
    .btn-delete { background: rgba(239,68,68,0.09); color: #dc2626; }
    .btn-delete:hover { background: #dc2626; color: #fff; box-shadow: 0 4px 12px rgba(239,68,68,0.3); }

    /* empty state */
    .empty-state { padding: 55px 20px; text-align: center; }
    .empty-icon { width: 72px; height: 72px; background: rgba(74,44,17,0.06); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 1.8rem; color: var(--text-secondary); }
    .empty-state h6 { font-weight: 700; color: var(--dark-coffee); margin-bottom: 5px; }
    .empty-state p  { color: var(--text-secondary); font-size: 0.85rem; margin: 0 0 16px; }

    /* flash */
    .flash-alert { border-radius: 12px; border: none; display: flex; align-items: center; gap: 12px; padding: 13px 17px; font-weight: 500; font-size: 0.875rem; margin-bottom: 22px; }
    .flash-success { background: rgba(45,106,79,0.1); color: var(--forest-green); border-left: 4px solid var(--forest-green); }
    .flash-danger  { background: rgba(239,68,68,0.09); color: #dc2626; border-left: 4px solid #dc2626; }
    .flash-alert i { font-size: 1.1rem; flex-shrink: 0; }

    /* add btn */
    .btn-add { background: var(--roasted-brown); color: #fff; border: none; border-radius: 11px; padding: 10px 20px; font-weight: 700; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 8px; transition: var(--transition-smooth); text-decoration: none; cursor: pointer; font-family: inherit; box-shadow: 0 4px 14px rgba(74,44,17,0.22); }
    .btn-add:hover { background: var(--dark-coffee); color: #fff; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(44,24,8,0.28); text-decoration: none; }

    .table-footer { padding: 12px 20px; border-top: 1px solid rgba(74,44,17,0.05); color: var(--text-secondary); font-size: 0.77rem; font-weight: 500; }
</style>

<!-- FLASH ALERT -->
<?php if ($this->session->flashdata('success')): ?>
<div class="flash-alert flash-success">
    <i class="bi bi-check-circle-fill"></i><span><?= $this->session->flashdata('success'); ?></span>
</div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
<div class="flash-alert flash-danger">
    <i class="bi bi-exclamation-triangle-fill"></i><span><?= $this->session->flashdata('error'); ?></span>
</div>
<?php endif; ?>

<!-- STAT CARDS -->
<?php
    $total_mitra    = count($mitra);
    $total_active   = 0; $total_inactive = 0;
    foreach ($mitra as $m) {
        if ($m['status_mitra'] === 'Active') $total_active++; else $total_inactive++;
    }
?>
<div class="row mb-4" style="margin:0 -10px;">
    <div class="col-6 col-md-3" style="padding:0 10px 18px;">
        <div class="stat-card">
            <div class="stat-icon brown"><i class="bi bi-shop"></i></div>
            <div><div class="stat-value"><?= $total_mitra; ?></div><div class="stat-label">Total Mitra</div></div>
        </div>
    </div>
    <div class="col-6 col-md-3" style="padding:0 10px 18px;">
        <div class="stat-card">
            <div class="stat-icon green"><i class="bi bi-check-circle-fill"></i></div>
            <div><div class="stat-value"><?= $total_active; ?></div><div class="stat-label">Mitra Aktif</div></div>
        </div>
    </div>
    <div class="col-6 col-md-3" style="padding:0 10px 18px;">
        <div class="stat-card">
            <div class="stat-icon red"><i class="bi bi-x-circle-fill"></i></div>
            <div><div class="stat-value"><?= $total_inactive; ?></div><div class="stat-label">Nonaktif</div></div>
        </div>
    </div>
    <div class="col-6 col-md-3" style="padding:0 10px 18px;">
        <div class="stat-card">
            <div class="stat-icon amber"><i class="bi bi-handshake-fill"></i></div>
            <div><div class="stat-value"><?= $total_active; ?></div><div class="stat-label">Kerjasama Aktif</div></div>
        </div>
    </div>
</div>

<!-- TABLE CARD -->
<div class="table-card">
    <div class="table-card-header">
        <h5 class="table-title"><i class="bi bi-list-stars"></i> Daftar Mitra Terdaftar</h5>
        <div class="d-flex align-items-center flex-wrap" style="gap:8px;">
            <form action="<?= base_url('admin/mitra'); ?>" method="GET" class="filter-form" id="filterForm">
                <div class="search-wrap">
                    <input type="text" name="search" placeholder="Cari nama mitra..." value="<?= htmlspecialchars($this->input->get('search') ?? ''); ?>">
                    <button type="submit" class="btn-search-icon" title="Cari"><i class="bi bi-search"></i></button>
                </div>
                <select name="kategori">
                    <option value="">Semua Kategori</option>
                    <?php foreach ($kategori_list as $kat): ?>
                    <option value="<?= htmlspecialchars($kat); ?>" <?= ($this->input->get('kategori') == $kat) ? 'selected' : ''; ?>><?= htmlspecialchars($kat); ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="status">
                    <option value="">Semua Status</option>
                    <option value="Active"   <?= ($this->input->get('status')=='Active')   ? 'selected':''  ;?>>Aktif</option>
                    <option value="Inactive" <?= ($this->input->get('status')=='Inactive') ? 'selected':''  ;?>>Nonaktif</option>
                </select>
                <button type="submit" class="btn-filter"><i class="bi bi-funnel-fill"></i> Filter</button>
                <?php if (!empty($this->input->get('search')) || !empty($this->input->get('kategori')) || !empty($this->input->get('status'))): ?>
                <a href="<?= base_url('admin/mitra'); ?>" class="btn-reset"><i class="bi bi-x-lg"></i> Reset</a>
                <?php endif; ?>
            </form>
            <a href="<?= base_url('admin/mitra/add'); ?>" class="btn-add"><i class="bi bi-plus-lg"></i> Tambah Mitra</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table mitra-table">
            <thead>
                <tr>
                    <th style="width:4%">#</th>
                    <th style="width:6%">Logo</th>
                    <th style="width:19%">Nama Mitra</th>
                    <th style="width:12%">Kategori</th>
                    <th style="width:17%">Kontak</th>
                    <th style="width:8%">Urutan</th>
                    <th style="width:11%">Status</th>
                    <th style="width:19%;text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($mitra)): ?>
                <tr><td colspan="8">
                    <div class="empty-state">
                        <div class="empty-icon"><i class="bi bi-shop"></i></div>
                        <h6>Belum Ada Data Mitra</h6>
                        <p><?= (!empty($this->input->get('search')) || !empty($this->input->get('kategori')) || !empty($this->input->get('status'))) ? 'Tidak ada mitra yang cocok dengan filter.' : 'Tambahkan mitra pertama Anda.'; ?></p>
                        <a href="<?= base_url('admin/mitra/add'); ?>" class="btn-add" style="font-size:0.8rem;padding:9px 16px;"><i class="bi bi-plus-lg"></i> Tambah Mitra</a>
                    </div>
                </td></tr>
                <?php else: $no = 1; foreach ($mitra as $m): ?>
                <tr>
                    <td style="color:var(--text-secondary);font-weight:600;"><?= $no++; ?></td>
                    <td>
                        <?php if (!empty($m['logo_mitra']) && $m['logo_mitra'] !== 'default.png'): ?>
                            <img src="<?= base_url('assets/uploads/mitra/'.$m['logo_mitra']); ?>" alt="Logo" class="logo-thumb">
                        <?php else: ?>
                            <div class="logo-placeholder"><i class="bi bi-image"></i></div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <p class="mitra-name"><?= htmlspecialchars($m['nama_mitra']); ?></p>
                        <p class="mitra-meta">ID #<?= $m['id_mitra']; ?></p>
                    </td>
                    <td><span class="kategori-pill"><?= htmlspecialchars($m['kategori_mitra']); ?></span></td>
                    <td>
                        <?php if (!empty($m['no_telepon'])): ?>
                            <p class="kontak-line"><i class="bi bi-telephone-fill"></i> <?= htmlspecialchars($m['no_telepon']); ?></p>
                        <?php endif; ?>
                        <?php if (!empty($m['email'])): ?>
                            <p class="kontak-line muted"><i class="bi bi-envelope-fill"></i> <?= htmlspecialchars($m['email']); ?></p>
                        <?php endif; ?>
                        <?php if (empty($m['no_telepon']) && empty($m['email'])): ?>
                            <span class="kontak-empty">&mdash;</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <input type="number" class="form-control urutan-input" data-id="<?= $m['id_mitra']; ?>" value="<?= (int)$m['urutan_tampil']; ?>" min="1" title="Edit urutan">
                    </td>
                    <td>
                        <?php if ($m['status_mitra'] === 'Active'): ?>
                            <span class="status-badge active status-toggle" data-id="<?= $m['id_mitra']; ?>" title="Klik untuk nonaktifkan">
                                <i class="bi bi-check-circle-fill"></i> Aktif
                            </span>
                        <?php else: ?>
                            <span class="status-badge inactive status-toggle" data-id="<?= $m['id_mitra']; ?>" title="Klik untuk aktifkan">
                                <i class="bi bi-x-circle-fill"></i> Nonaktif
                            </span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="btn-action-group">
                            <a href="<?= base_url('admin/mitra/edit/'.$m['id_mitra']); ?>" class="btn-icon btn-edit" title="Edit Mitra"><i class="bi bi-pencil-square"></i></a>
                            <button type="button" class="btn-icon btn-delete btn-hapus-trigger"
                                    data-id="<?= $m['id_mitra']; ?>"
                                    data-nama="<?= htmlspecialchars($m['nama_mitra']); ?>"
                                    title="Hapus Permanen">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>

    <?php if (!empty($mitra)): ?>
    <div class="table-footer">
        Menampilkan <strong><?= count($mitra); ?></strong> mitra
        <?php if (!empty($this->input->get('search')) || !empty($this->input->get('kategori')) || !empty($this->input->get('status'))): ?>
        (hasil filter) &mdash; <a href="<?= base_url('admin/mitra'); ?>" style="color:var(--amber-cream);">Lihat semua</a>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>

<!-- MODAL HAPUS PERMANEN -->
<div class="modal fade modal-hapus" id="modalHapus" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:440px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" style="font-size:0.95rem;">Hapus Mitra Permanen</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body text-center">
                <div class="hapus-icon-wrap"><i class="bi bi-exclamation-triangle-fill"></i></div>
                <p style="font-size:0.875rem;color:var(--text-secondary);margin:0;">
                    Anda akan menghapus mitra<br>
                    <strong id="modalNamaMitra" style="color:var(--dark-coffee);"></strong> secara permanen.
                </p>
                <p class="mt-2" style="font-size:0.78rem;color:#dc2626;font-weight:600;">
                    <i class="bi bi-info-circle"></i> Tindakan ini TIDAK BISA dibatalkan.
                </p>
                <div class="mt-3 text-left">
                    <label style="font-size:0.72rem;font-weight:700;color:var(--text-secondary);text-transform:uppercase;letter-spacing:0.4px;">Ketik nama mitra untuk konfirmasi</label>
                    <input type="text" id="inputKonfirmHapus" style="width:100%;padding:9px 13px;border:1px solid rgba(74,44,17,0.18);border-radius:9px;font-size:0.85rem;font-family:inherit;margin-top:6px;" placeholder="Ketik nama mitra di sini...">
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-end" style="gap:8px;">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" style="border-radius:9px;">Batal</button>
                <a href="#" id="btnKonfirmHapus" class="btn btn-danger btn-sm" style="border-radius:9px; pointer-events:none; opacity:0.5;"><i class="bi bi-trash3-fill"></i> Ya, Hapus Permanen</a>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    /* Toggle status via AJAX */
    $(document).on('click', '.status-toggle', function () {
        var badge = $(this), id = badge.data('id');
        $.ajax({
            url: "<?= base_url('admin/mitra/toggle/'); ?>" + id,
            type: "POST", dataType: "json",
            success: function (res) {
                if (res.success) {
                    if (badge.hasClass('active')) {
                        badge.removeClass('active').addClass('inactive')
                             .html('<i class="bi bi-x-circle-fill"></i> Nonaktif')
                             .attr('title','Klik untuk aktifkan');
                    } else {
                        badge.removeClass('inactive').addClass('active')
                             .html('<i class="bi bi-check-circle-fill"></i> Aktif')
                             .attr('title','Klik untuk nonaktifkan');
                    }
                }
            }
        });
    });

    /* Update urutan via AJAX */
    $('.urutan-input').on('change', function () {
        var inp = $(this), id = inp.data('id'), urutan = parseInt(inp.val());
        if (isNaN(urutan) || urutan < 1) { inp.val(1); urutan = 1; }
        $.ajax({
            url: "<?= base_url('admin/mitra/update_urutan/'); ?>" + id,
            type: "POST", data: { urutan_tampil: urutan }, dataType: "json",
            success: function (res) {
                if (res.success) {
                    inp.addClass('urutan-saved');
                    setTimeout(function () { inp.removeClass('urutan-saved'); }, 1400);
                }
            }
        });
    });

    /* Modal Hapus */
    var namaMitraAktif = '';
    $(document).on('click', '.btn-hapus-trigger', function () {
        var id   = $(this).data('id');
        var nama = $(this).data('nama');
        namaMitraAktif = nama;
        $('#modalNamaMitra').text('"' + nama + '"');
        $('#inputKonfirmHapus').val('');
        $('#btnKonfirmHapus')
            .attr('href', "<?= base_url('admin/mitra/delete/'); ?>" + id)
            .css({'pointer-events':'none','opacity':'0.5'});
        $('#modalHapus').modal('show');
    });

    $('#inputKonfirmHapus').on('input', function () {
        var match = ($(this).val().trim() === namaMitraAktif.trim());
        $('#btnKonfirmHapus').css(match ? {'pointer-events':'auto','opacity':'1'} : {'pointer-events':'none','opacity':'0.5'});
    });

    setTimeout(function () { $('.flash-alert').fadeOut('slow'); }, 4500);

    /* Submit filter form saat tekan Enter di kolom pencarian */
    $('#filterForm input[name="search"]').on('keydown', function (e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
            e.preventDefault();
            $('#filterForm').trigger('submit');
        }
    });
});
</script>