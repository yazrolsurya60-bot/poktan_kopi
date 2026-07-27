
<!-- KONTEN NOTIFIKASI / FLASH MESSAGE -->
<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 10px;">
        <i class="bi bi-check-circle-fill mr-1"></i> <?= $this->session->flashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<style>
    /* CSS Spesifik Katalog Produk */
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
        font-weight: 600;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 10px 12px;
        text-align: center;
        white-space: nowrap;
    }
    .table-custom tbody td {
        padding: 10px 12px;
        border-bottom: 1px solid rgba(74, 44, 17, 0.04);
        vertical-align: middle;
        background: var(--card-white);
        text-align: center;
    }
    .table-custom tbody tr:hover td {
        background: rgba(250, 246, 240, 0.4);
    }
    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        display: inline-block;
    }
    .status-badge.aktif { background: #D1FAE5; color: #065F46; }
    .status-badge.nonaktif { background: #FEE2E2; color: #991B1B; }
    
    .btn-detail { background: #DBEAFE; color: #1E40AF; border: none; padding: 3px 10px; border-radius: 6px; font-size: 0.7rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 3px; }
    .btn-detail:hover { background: #1E40AF; color: white; text-decoration: none; }
    .btn-edit { background: #FEF3C7; color: #92400E; border: none; padding: 3px 10px; border-radius: 6px; font-size: 0.7rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 3px; }
    .btn-edit:hover { background: #92400E; color: white; text-decoration: none; }
    .btn-hapus { background: #FEE2E2; color: #991B1B; border: none; padding: 3px 10px; border-radius: 6px; font-size: 0.7rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 3px; }
    .btn-hapus:hover { background: #991B1B; color: white; text-decoration: none; }
    
    .search-input { border: 1px solid rgba(74, 44, 17, 0.1); border-radius: 10px; padding: 10px 16px; font-size: 0.85rem; background: var(--card-white); }
    .search-input:focus { border-color: var(--amber-cream); outline: none; }
    .btn-search { background: var(--roasted-brown); color: white; border: none; padding: 10px 20px; border-radius: 10px; font-weight: 600; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 6px; text-decoration: none; }
    .btn-search:hover { background: var(--dark-coffee); color: white; }
    .btn-reset { background: var(--bg-cream); color: var(--text-secondary); border: 1px solid rgba(74, 44, 17, 0.1); padding: 10px 20px; border-radius: 10px; font-weight: 600; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }
    .btn-reset:hover { background: #e8e0d8; color: var(--dark-coffee); text-decoration: none; }
    .btn-tambah { background: var(--amber-cream); color: white; border: none; padding: 10px 24px; border-radius: 10px; font-weight: 600; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
    .btn-tambah:hover { background: var(--roasted-brown); color: white; text-decoration: none; }
</style>

<!-- SEARCH & TAMBAH -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap" style="gap: 15px;">
    <form method="get" action="<?= base_url('petani/produk'); ?>" class="d-flex align-items-center" style="gap: 10px; flex-grow: 1; max-width: 600px;">
        <input type="text" name="keyword" class="search-input form-control" placeholder="Cari nama produk, jenis kopi..." value="<?= $this->input->get('keyword'); ?>" style="flex:1;">
        <button type="submit" class="btn-search">
            <i class="bi bi-search"></i> Cari
        </button>
        <a href="<?= base_url('petani/produk'); ?>" class="btn-reset">
            Reset
        </a>
    </form>
    <a href="<?= base_url('petani/produk/tambah'); ?>" class="btn-tambah">
        <i class="bi bi-plus-lg"></i> Tambah Produk
    </a>
</div>

<!-- TABLE -->
<div class="table-responsive">
    <table class="table-custom">
        <thead>
            <tr>
                <th style="width:35px;">No</th>
                <th style="width:60px;">Foto</th>
                <th style="width:150px; text-align:center;">Nama Produk</th>
                <th style="width:100px;">Jenis Kopi</th>
                <th style="width:160px;">Proses Pengolahan</th>
                <th style="width:120px;">Harga</th>
                <th style="width:80px;">Stok</th>
                <th style="width:130px;">Total Pendapatan</th>
                <th style="width:80px;">Status</th>
                <th style="width:220px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($produk)): ?>
                <?php $no = 1; foreach ($produk as $row): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>
                            <?php if (!empty($row->foto_utama)) : ?>
                                <img src="<?= base_url('uploads/produk/' . $row->foto_utama); ?>" width="45" height="45" style="object-fit:cover; border-radius:10px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                            <?php else : ?>
                                <div style="width:45px; height:45px; background:var(--bg-cream); border-radius:10px; display:flex; align-items:center; justify-content:center; color:var(--text-secondary); font-size:0.6rem; margin:0 auto;">No Image</div>
                            <?php endif; ?>
                        </td>
                        <td style="text-align:center; font-weight:600; color:var(--dark-coffee);"><?= $row->nama_produk; ?></td>
                        <td><?= $row->jenis_kopi; ?></td>
                        <td><?= !empty($row->proses) ? $row->proses : '<span style="color:#999; font-style:italic;">-</span>'; ?></td>
                        <td style="font-weight:600; color:var(--dark-coffee);">Rp <?= number_format($row->harga, 0, ',', '.'); ?></td>
                        <td><?= $row->stok_produk; ?> <small style="font-size:0.6rem; color:var(--text-secondary);">kg</small></td>
                        <td style="font-weight:700; color:var(--roasted-brown);">
                            <?php
                            $harga = $row->harga ?? 0;
                            $stok = $row->stok_produk ?? 0;
                            echo 'Rp ' . number_format($harga * $stok, 0, ',', '.');
                            ?>
                        </td>
                        <td>
                            <?php
                            $status_class = (strtolower($row->status_produk ?? 'aktif') == 'nonaktif') ? 'nonaktif' : 'aktif';
                            ?>
                            <span class="status-badge <?= $status_class; ?>"><?= $row->status_produk ?? 'Aktif'; ?></span>
                        </td>
                        <td>
                            <div class="d-flex flex-wrap justify-content-center" style="gap: 3px;">
                                <a class="btn-detail" href="<?= base_url('petani/produk/detail/' . $row->id_produk); ?>">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <a class="btn-edit" href="<?= base_url('petani/produk/edit/' . $row->id_produk); ?>">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <a class="btn-hapus" href="<?= base_url('petani/produk/hapus/' . $row->id_produk); ?>" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10" class="text-center py-4 text-muted">
                        <i class="bi bi-box" style="font-size:2rem; display:block; margin-bottom:8px; opacity:0.3;"></i>
                        Belum ada produk. <a href="<?= base_url('petani/produk/tambah'); ?>" style="color: var(--amber-cream); font-weight:600;">Tambah produk pertama</a>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
