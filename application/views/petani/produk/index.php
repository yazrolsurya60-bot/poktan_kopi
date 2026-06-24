<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Produk</title>

    <style>

        body{
            font-family: Arial, sans-serif;
            background:#f8f5f0;
            padding:20px;
        }

        h2{
            color:#3B2416;
        }

        .btn{
            background:#6B4226;
            color:white;
            padding:10px 15px;
            text-decoration:none;
            border-radius:5px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
            background:white;
        }

        th{
            background:#6B4226;
            color:white;
            padding:10px;
        }

        td{
            padding:10px;
            border:1px solid #ddd;
        }

    </style>

</head>
<body>

<h2>Manajemen Produk</h2>

<a href="<?= site_url('petani/produk/tambah') ?>" class="btn">
Tambah Produk
</a>

<table>

<tr>
    <th>No</th>
    <th>Nama Produk</th>
    <th>Jenis Kopi</th>
    <th>Grade</th>
    <th>Harga</th>
    <th>Stok</th>
    <th>Status</th>
</tr>

<?php if(!empty($produk)): ?>

<?php $no=1; foreach($produk as $row): ?>

<tr>

<td><?= $no++ ?></td>

<td><?= $row->nama_produk ?></td>

<td><?= $row->jenis_kopi ?></td>

<td><?= $row->grade ?></td>

<td>Rp <?= number_format($row->harga) ?></td>

<td><?= $row->stok_produk ?></td>

<td><?= $row->status_produk ?></td>

</tr>

<?php endforeach; ?>

<?php endif; ?>

</table>

</body>
</html>