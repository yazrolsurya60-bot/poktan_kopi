<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Install LiberChain - PWA</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --roasted-brown: #4A2C11;
            --dark-coffee: #2C1808;
            --amber-cream: #E6A15C;
            --bg-cream: #FAF6F0;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #FAF6F0 0%, #e8e0d8 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .card-custom {
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(44,24,8,0.12);
            border: 1px solid rgba(74,44,17,0.08);
            background: #FFFFFF;
            max-width: 500px;
        }
        .card-header-custom {
            background: linear-gradient(135deg, var(--dark-coffee), var(--roasted-brown));
            padding: 30px;
            text-align: center;
            color: white;
        }
        .card-body-custom {
            padding: 30px;
        }
        .btn-coklat {
            background: var(--roasted-brown);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 14px 28px;
            font-weight: 700;
            width: 100%;
            text-decoration: none;
            display: inline-block;
        }
        .btn-coklat:hover {
            background: var(--dark-coffee);
            color: white;
        }
    </style>
</head>
<body>
    <div class="card card-custom">
        <div class="card-header-custom">
            <i class="bi bi-download" style="font-size: 3rem; color: var(--amber-cream); display: block; margin-bottom: 10px;"></i>
            <h3>Install LiberChain App</h3>
        </div>
        <div class="card-body-custom">
            <h5>Cara Install:</h5>
            <ol>
                <li>Tap menu browser (⋮) di pojok kanan atas</li>
                <li>Pilih "Add to Home Screen" atau "Install App"</li>
                <li>Tap "Install" untuk menginstall aplikasi</li>
            </ol>
            <hr>
            <a href="<?= base_url(); ?>" class="btn-coklat">Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>
</parameter>
<parameter name="task_progress">- [x] Buat manifest.json untuk PWA
- [x] Buat service worker untuk offline functionality
- [x] Update views dengan meta tags PWA
- [x] Buat icon PWA
- [x] Buat controller PWA
- [ ] Verifikasi instalasi PWA</parameter>
</write_to_file>