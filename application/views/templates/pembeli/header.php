<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#4A2C11">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="LiberChain">
    <meta name="description" content="Platform Supply Chain Kopi">
    <link rel="manifest" href="<?= base_url('pwa/manifest'); ?>">
    <link rel="apple-touch-icon" href="<?= base_url('assets/images/pwa/icon-192x192.png'); ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url('assets/images/pwa/icon-192x192.png'); ?>">
    <link rel="icon" type="image/png" sizes="512x512" href="<?= base_url('assets/images/pwa/icon-512x512.png'); ?>">
    <title><?= $title ?? 'LiberChain'; ?></title>
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
            background: var(--bg-cream);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, var(--dark-coffee), var(--roasted-brown));">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="<?= base_url(); ?>">
                <i class="bi bi-cup-hot mr-2"></i>LiberChain
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('pembeli/dashboard'); ?>">
                            <i class="bi bi-speedometer2 mr-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('pembeli/transaksi/history'); ?>">
                            <i class="bi bi-receipt mr-1"></i> Transaksi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('pembeli/tracking'); ?>">
                            <i class="bi bi-truck mr-1"></i> Tracking
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-toggle="dropdown">
                            <i class="bi bi-person-circle mr-1"></i> <?= $this->session->userdata('nama') ?? 'User'; ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">
                                <i class="bi bi-box-arrow-right mr-2"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">