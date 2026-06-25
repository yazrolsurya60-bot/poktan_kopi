<style>
    

margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{

background:#F7F2EC;

color:#3F2A1D;

}

:root{

--brown:#5C3B22;

--coffee:#7B5235;

--cream:#F7F2EC;

--white:#fff;

--shadow:0 10px 35px rgba(0,0,0,.08);

}

.navbar{

background:white;

box-shadow:var(--shadow);

padding:18px 0;

}

.logo{

font-size:24px;

font-weight:700;

color:var(--brown);

}

.nav-link{

font-weight:500;

margin-left:18px;

color:#555;

}

.nav-link:hover{

color:var(--brown);

}

.btn-login{

background:var(--brown);

color:white;

padding:10px 22px;

border-radius:30px;

}

.btn-login:hover{

background:#432915;

color:white;

}

.hero{

padding:120px 0;

}

.hero h1{

font-size:55px;

font-weight:800;

line-height:1.2;

}

.hero h1 span{

color:var(--coffee);

}

.hero p{

font-size:18px;

margin-top:20px;

color:#666;

}

.btn-produk{

background:var(--brown);

color:white;

padding:15px 35px;

border-radius:50px;

font-weight:600;

margin-right:15px;

}

.btn-produk:hover{

background:#432915;

color:white;

}

.btn-mitra{

border:2px solid var(--brown);

color:var(--brown);

padding:15px 35px;

border-radius:50px;

font-weight:600;

}

.btn-mitra:hover{

background:var(--brown);

color:white;

}

.hero-img{

width:100%;

border-radius:25px;

box-shadow:var(--shadow);

}

.section{

padding:90px 0;

}

.section-title{

font-size:38px;

font-weight:700;

margin-bottom:20px;

}

.card-feature{

background:white;

border:none;

border-radius:20px;

padding:35px;

box-shadow:var(--shadow);

transition:.3s;

height:100%;

}

.card-feature:hover{

transform:translateY(-8px);

}

.icon-box{

width:70px;

height:70px;

background:#F5E9DD;

display:flex;

justify-content:center;

align-items:center;

border-radius:50%;

font-size:28px;

color:var(--brown);

margin-bottom:20px;

}

.stats{

background:var(--brown);

color:white;

padding:70px 0;

}

.stats h2{

font-size:48px;

font-weight:700;

}

.stats p{

margin:0;

font-size:18px;

}

</style>

</head>

<body>

<nav class="navbar navbar-expand-lg">

<div class="container">

<a class="navbar-brand logo" href="#">

<i class="bi bi-cup-hot-fill"></i>

Liberchain

</a>

<button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse" id="menu">

<ul class="navbar-nav ms-auto align-items-center">

<li class="nav-item">

<a class="nav-link" href="#">Produk</a>

</li>

<li class="nav-item">

<a class="nav-link" href="#">Mitra</a>

</li>

<li class="nav-item">

<a class="nav-link" href="#">Tentang</a>

</li>

<li class="nav-item">

<a class="nav-link" href="#">Kontak</a>

</li>

<li class="nav-item ms-3">

<a class="btn btn-login" href="<?= base_url('auth/login')?>">

Masuk

</a>

</li>

</ul>

</div>

</div>

</nav>

<section class="hero">

<div class="container">

<div class="row align-items-center">

<div class="col-lg-6">

<h1>

Jaringan Kopi

<span>Indonesia</span>

yang Transparan

</h1>

<p>

Liberchain menghubungkan petani kopi, mitra bisnis,

dan pembeli dalam satu platform digital yang aman,

mudah dan terpercaya.

</p>

<div class="mt-4">

<a href="<?=base_url('landing/produk')?>" class="btn btn-produk">

Jelajahi Produk

</a>

<a href="<?=base_url('landing/mitra')?>" class="btn btn-mitra">

Gabung Mitra

</a>

</div>

</div>

<div class="col-lg-6 text-center">

<img src="<?=base_url('assets/img/hero-coffee.png')?>"

class="hero-img">

</div>

</div>

</div>

</section>

<section class="section">

<div class="container">

<div class="text-center mb-5">

<h2 class="section-title">

Mengapa Memilih Liberchain?

</h2>

<p>

Platform digital untuk mempertemukan petani,

mitra bisnis dan pembeli kopi Indonesia.

</p>

</div>

<div class="row g-4">

<div class="col-lg-3">

<div class="card-feature">

<div class="icon-box">

<i class="bi bi-tree-fill"></i>

</div>

<h5>Langsung Dari Petani</h5>

<p>

Produk berasal langsung dari petani binaan.

</p>

</div>

</div>

<div class="col-lg-3">

<div class="card-feature">

<div class="icon-box">

<i class="bi bi-truck"></i>

</div>

<h5>Pengiriman Cepat</h5>

<p>

Distribusi ke seluruh Indonesia.

</p>

</div>

</div>

<div class="col-lg-3">

<div class="card-feature">

<div class="icon-box">

<i class="bi bi-shield-check"></i>

</div>

<h5>Transaksi Aman</h5>

<p>

Pembayaran lebih aman dan terpercaya.

</p>

</div>

</div>

<div class="col-lg-3">

<div class="card-feature">

<div class="icon-box">

<i class="bi bi-award-fill"></i>

</div>

<h5>Kualitas Premium</h5>

<p>

Produk kopi grade terbaik Indonesia.

</p>

</div>

</div>

</div>

</div>

</section>
<section class="stats">

<div class="container">

<div class="row text-center">

<div class="col-lg-3">

<h2>150+</h2>

<p>Produk</p>

</div>

<div class="col-lg-3">

<h2>35</h2>

<p>Petani</p>

</div>

<div class="col-lg-3">

<h2>20</h2>

<p>Mitra</p>

</div>

<div class="col-lg-3">

<h2>12</h2>

<p>Provinsi</p>

</div>

</div>

</div>

</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- ========================= -->
<!-- PRODUK UNGGULAN -->
<!-- ========================= -->

<section class="section">

<div class="container">

<div class="text-center mb-5">

<h2 class="section-title">
Produk Unggulan
</h2>

<p class="text-muted">
Nikmati kopi pilihan terbaik langsung dari petani Liberchain.
</p>

</div>

<div class="row">

<?php foreach($produk as $row): ?>

<div class="col-lg-3 col-md-6 mb-4">

<div class="card-feature p-0 overflow-hidden">

<?php if(!empty($row->foto_utama)): ?>

<img src="<?= base_url('uploads/produk/'.$row->foto_utama); ?>"

style="height:220px;width:100%;object-fit:cover;">

<?php else: ?>

<img src="<?= base_url('assets/img/no-image.png');?>"

style="height:220px;width:100%;object-fit:cover;">

<?php endif; ?>

<div class="p-4">

<span class="badge bg-success mb-2">

<?= $row->jenis_kopi; ?>

</span>

<h5 style="font-weight:700;">

<?= $row->nama_produk; ?>

</h5>

<p class="text-muted mb-2">

Grade <?= $row->grade; ?>

</p>

<h4 style="color:var(--brown);font-weight:700;">

Rp <?= number_format($row->harga,0,",","."); ?>

</h4>

<div class="mt-3">

<a href="<?= base_url('landing/detail/'.$row->id_produk);?>"

class="btn btn-produk w-100">

Lihat Detail

</a>

</div>

</div>

</div>

</div>

<?php endforeach; ?>

</div>

<div class="text-center mt-4">

<a href="<?= base_url('landing/produk');?>"

class="btn btn-mitra">

Lihat Semua Produk

</a>

</div>

</div>

</section>

<section class="section" style="background:white;">

<div class="container">

<div class="text-center mb-5">

<h2 class="section-title">

Mitra Kami

</h2>

<p>

Liberchain telah bekerja sama dengan berbagai pelaku industri kopi.

</p>

</div>

<div class="row">

<div class="col-lg-4">

<div class="card-feature text-center">

<div class="icon-box mx-auto">

<i class="bi bi-shop"></i>

</div>

<h5>Coffee Shop</h5>

<p>

Mitra kedai kopi di seluruh Indonesia.

</p>

</div>

</div>

<div class="col-lg-4">

<div class="card-feature text-center">

<div class="icon-box mx-auto">

<i class="bi bi-building"></i>

</div>

<h5>Distributor</h5>

<p>

Penyalur kopi premium ke berbagai daerah.

</p>

</div>

</div>

<div class="col-lg-4">

<div class="card-feature text-center">

<div class="icon-box mx-auto">

<i class="bi bi-globe2"></i>

</div>

<h5>Exportir</h5>

<p>

Membawa kopi Indonesia ke pasar dunia.

</p>

</div>

</div>

</div>

</div>

</section>

<section class="section">

<div class="container">

<div class="text-center mb-5">

<h2 class="section-title">

Apa Kata Mereka?

</h2>

</div>

<div class="row">

<div class="col-lg-4">

<div class="card-feature">

⭐⭐⭐⭐⭐

<p class="mt-3">

"Kualitas kopi sangat premium dan pengirimannya cepat."

</p>

<hr>

<b>Coffee Aroma</b>

</div>

</div>

<div class="col-lg-4">

<div class="card-feature">

⭐⭐⭐⭐⭐

<p class="mt-3">

"Platform yang memudahkan kami membeli kopi langsung dari petani."

</p>

<hr>

<b>Roastery Bandung</b>

</div>

</div>

<div class="col-lg-4">

<div class="card-feature">

⭐⭐⭐⭐⭐

<p class="mt-3">

"Pelayanan sangat baik dan produk selalu fresh."

</p>

<hr>

<b>Kopi Nusantara</b>

</div>

</div>

</div>

</div>

</section>


</body>
</html>