<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preferensi Notifikasi - Poktan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --roasted-brown: #4A2C11;
            --dark-coffee: #2C1808;
            --amber-cream: #E6A15C;
            --bg-cream: #FAF6F0;
            --card-white: #FFFFFF;
            --text-secondary: #70655E;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-cream);
            color: var(--dark-coffee);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .setting-card {
            background: var(--card-white);
            border: 1px solid #EFEAE2;
            border-radius: 16px;
            padding: 35px 40px;
            max-width: 720px;
            width: 100%;
            margin: 0 auto;
            box-shadow: 0 4px 30px rgba(74, 44, 17, 0.06);
        }

        .setting-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .setting-header .icon-wrapper {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 56px;
            height: 56px;
            background-color: #FDF5ED;
            border-radius: 14px;
            color: var(--amber-cream);
            font-size: 1.6rem;
            margin-bottom: 12px;
        }

        .setting-header h5 {
            font-weight: 700;
            color: var(--roasted-brown);
            margin-bottom: 4px;
            font-size: 1.1rem;
        }

        .setting-header p {
            color: var(--text-secondary);
            font-size: 0.85rem;
            margin-bottom: 0;
        }

        .alert-custom {
            border-radius: 8px;
            padding: 10px 16px;
            font-size: 0.85rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
            border: none;
        }

        .alert-custom.success {
            background-color: #D1FAE5;
            color: #065F46;
        }

        .alert-custom.error {
            background-color: #FEE2E2;
            color: #991B1B;
        }

        .category-header {
            background: var(--bg-cream);
            border-radius: 10px;
            padding: 8px 16px;
            margin-top: 20px;
            margin-bottom: 16px;
            font-weight: 700;
            font-size: 0.75rem;
            color: var(--text-secondary);
            letter-spacing: 0.7px;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .category-header i {
            font-size: 0.9rem;
            color: var(--amber-cream);
        }

        .switch-group {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 14px 0;
            border-bottom: 1px solid rgba(74, 44, 17, 0.05);
        }

        .switch-group:last-of-type {
            border-bottom: none;
        }

        .switch-group .switch-icon {
            width: 38px;
            height: 38px;
            min-width: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            margin-top: 2px;
        }

        .switch-group .switch-content {
            flex: 1;
            min-width: 0;
        }

        .switch-group .switch-content .switch-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--dark-coffee);
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .switch-group .switch-content .switch-desc {
            color: var(--text-secondary);
            font-size: 0.75rem;
            margin-top: 2px;
            display: block;
            line-height: 1.4;
        }

        .custom-switch {
            padding-left: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .custom-switch .custom-control-input {
            display: none;
        }

        .custom-switch .custom-control-label {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 24px;
            background: #E5E7EB;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            flex-shrink: 0;
            margin-bottom: 0;
        }

        .custom-switch .custom-control-label::after {
            content: '';
            position: absolute;
            top: 2px;
            left: 2px;
            width: 20px;
            height: 20px;
            background: white;
            border-radius: 50%;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .custom-switch .custom-control-input:checked+.custom-control-label {
            background: var(--roasted-brown);
        }

        .custom-switch .custom-control-input:checked+.custom-control-label::after {
            transform: translateX(20px);
        }

        .btn-save {
            background-color: var(--roasted-brown);
            color: white;
            border-radius: 10px;
            padding: 12px 28px;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.2s;
            border: none;
            width: 100%;
        }

        .btn-save:hover {
            background-color: #3d2410;
            color: white;
            opacity: 0.95;
        }

        .btn-cancel {
            border-radius: 10px;
            padding: 10px;
            font-size: 0.9rem;
            border: 1px solid #EFEAE2;
            background: white;
            color: var(--text-secondary);
            font-weight: 600;
            transition: all 0.2s;
            text-align: center;
            display: block;
            width: 100%;
            text-decoration: none;
        }

        .btn-cancel:hover {
            background: var(--bg-cream);
            text-decoration: none;
            color: var(--dark-coffee);
        }

        .btn-group-action {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid rgba(74, 44, 17, 0.06);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        @media (max-width: 576px) {
            .setting-card {
                padding: 20px;
            }

            .switch-group {
                flex-wrap: wrap;
                gap: 10px;
            }

            .switch-group .switch-icon {
                width: 32px;
                height: 32px;
                min-width: 32px;
                font-size: 0.85rem;
            }

            .switch-group .switch-content .switch-label {
                font-size: 0.8rem;
            }

            .custom-switch .custom-control-label {
                width: 38px;
                height: 20px;
            }

            .custom-switch .custom-control-label::after {
                width: 16px;
                height: 16px;
            }

            .custom-switch .custom-control-input:checked+.custom-control-label::after {
                transform: translateX(18px);
            }
        }
    </style>
</head>

<body>

    <div class="setting-card">
        <!-- HEADER -->
        <div class="setting-header">
            <div class="icon-wrapper">
                <i class="bi bi-gear-wide-connected"></i>
            </div>
            <h5>Konfigurasi Lansiran Sistem</h5>
            <p>Atur jenis pemberitahuan operasional yang ingin Anda terima.</p>
        </div>

        <!-- ALERT -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert-custom success">
                <i class="bi bi-check-circle-fill mr-2"></i><?= $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert-custom error">
                <i class="bi bi-exclamation-triangle-fill mr-2"></i><?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= base_url($this->session->userdata('role') . '/dashboard/settings'); ?>">

            <?php 
            $role = $this->session->userdata('role');
            $is_admin = ($role == 'Admin');
            $is_petani = ($role == 'Petani');
            $is_pembeli = ($role == 'Pembeli');
            ?>

            <!-- ============================================ -->
            <!-- KATEGORI: TRANSAKSI & PEMBAYARAN -->
            <!-- ============================================ -->
            <div class="category-header">
                <i class="bi bi-credit-card"></i> TRANSAKSI & PEMBAYARAN
            </div>

            <!-- Transaksi Baru (Admin & Petani) -->
            <?php if ($is_admin || $is_petani): ?>
                <div class="switch-group">
                    <div class="switch-icon" style="background: #DBEAFE; color: #1E40AF;">
                        <i class="bi bi-cart-plus"></i>
                    </div>
                    <div class="switch-content">
                        <div class="switch-label">
                            <span><?= $is_admin ? 'Lansiran Transaksi Masuk Baru' : 'Lansiran Pesanan Baru' ?></span>
                            <div class="custom-switch ml-auto">
                                <input type="checkbox" class="custom-control-input" id="notif_transaksi" name="notif_transaksi"
                                    <?= isset($settings['notif_transaksi']) && $settings['notif_transaksi'] == 1 ? 'checked' : ''; ?>>
                                <label class="custom-control-label" for="notif_transaksi"></label>
                            </div>
                        </div>
                        <small class="switch-desc"><?= $is_admin ? 'Dapatkan pesan instan setiap kali ada order masuk.' : 'Notifikasi saat ada pesanan baru dari pembeli.' ?></small>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Status Pesanan (Pembeli) -->
            <?php if ($is_pembeli): ?>
                <div class="switch-group">
                    <div class="switch-icon" style="background: #DBEAFE; color: #1E40AF;">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <div class="switch-content">
                        <div class="switch-label">
                            <span>Lansiran Status Pesanan</span>
                            <div class="custom-switch ml-auto">
                                <input type="checkbox" class="custom-control-input" id="notif_pesanan" name="notif_pesanan"
                                    <?= isset($settings['notif_pesanan']) && $settings['notif_pesanan'] == 1 ? 'checked' : ''; ?>>
                                <label class="custom-control-label" for="notif_pesanan"></label>
                            </div>
                        </div>
                        <small class="switch-desc">Notifikasi setiap ada perubahan status pesanan Anda.</small>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Konfirmasi Pembayaran (Semua Role) -->
            <div class="switch-group">
                <div class="switch-icon" style="background: #D1FAE5; color: #065F46;">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="switch-content">
                    <div class="switch-label">
                        <span>Lansiran Konfirmasi Pembayaran</span>
                        <div class="custom-switch ml-auto">
                            <input type="checkbox" class="custom-control-input" id="notif_pembayaran" name="notif_pembayaran"
                                <?= isset($settings['notif_pembayaran']) && $settings['notif_pembayaran'] == 1 ? 'checked' : ''; ?>>
                            <label class="custom-control-label" for="notif_pembayaran"></label>
                        </div>
                    </div>
                    <small class="switch-desc">Notifikasi saat pembayaran berhasil diverifikasi oleh admin.</small>
                </div>
            </div>

            <!-- ============================================ -->
            <!-- KATEGORI: STOK & PRODUK -->
            <!-- ============================================ -->
            <?php if ($is_admin || $is_petani): ?>
                <div class="category-header">
                    <i class="bi bi-box-seam"></i> STOK & PRODUK
                </div>

                <!-- Peringatan Stok (Admin & Petani) -->
                <div class="switch-group">
                    <div class="switch-icon" style="background: #FEF3C7; color: #92400E;">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                    <div class="switch-content">
                        <div class="switch-label">
                            <span>Lansiran Peringatan Minimum Stok</span>
                            <div class="custom-switch ml-auto">
                                <input type="checkbox" class="custom-control-input" id="notif_stok" name="notif_stok"
                                    <?= isset($settings['notif_stok']) && $settings['notif_stok'] == 1 ? 'checked' : ''; ?>>
                                <label class="custom-control-label" for="notif_stok"></label>
                            </div>
                        </div>
                        <small class="switch-desc">Kirim peringatan otomatis saat stok kopi di gudang mencapai batas minimum.</small>
                    </div>
                </div>
            <?php endif; ?>

            <!-- ============================================ -->
            <!-- KATEGORI: PENGIRIMAN & KURIR -->
            <!-- ============================================ -->
            <?php if ($is_admin || $is_petani || $is_pembeli): ?>
                <div class="category-header">
                    <i class="bi bi-truck"></i> PENGIRIMAN & KURIR
                </div>

                <!-- Status Pengiriman (Admin & Petani & Pembeli) -->
                <div class="switch-group">
                    <div class="switch-icon" style="background: #EDE9FE; color: #5B21B6;">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <div class="switch-content">
                        <div class="switch-label">
                            <span><?= $is_pembeli ? 'Lansiran Tracking Kiriman' : 'Lansiran Status Pengiriman' ?></span>
                            <div class="custom-switch ml-auto">
                                <input type="checkbox" class="custom-control-input" id="notif_kurir" name="notif_kurir"
                                    <?= isset($settings['notif_kurir']) && $settings['notif_kurir'] == 1 ? 'checked' : ''; ?>>
                                <label class="custom-control-label" for="notif_kurir"></label>
                            </div>
                        </div>
                        <small class="switch-desc"><?= $is_pembeli ? 'Update tracking kurir dan status pengiriman pesanan Anda.' : 'Update tracking kurir dan status pengiriman.' ?></small>
                    </div>
                </div>
            <?php endif; ?>

            <!-- ============================================ -->
            <!-- KATEGORI: PENGGUNA & REGISTRASI -->
            <!-- ============================================ -->
            <?php if ($is_admin): ?>
                <div class="category-header">
                    <i class="bi bi-people"></i> PENGGUNA & REGISTRASI
                </div>

                <!-- Registrasi Petani (Hanya Admin) -->
                <div class="switch-group">
                    <div class="switch-icon" style="background: #FDE68A; color: #78350F;">
                        <i class="bi bi-person-plus"></i>
                    </div>
                    <div class="switch-content">
                        <div class="switch-label">
                            <span>Lansiran Registrasi Petani Baru</span>
                            <div class="custom-switch ml-auto">
                                <input type="checkbox" class="custom-control-input" id="notif_petani" name="notif_petani"
                                    <?= isset($settings['notif_petani']) && $settings['notif_petani'] == 1 ? 'checked' : ''; ?>>
                                <label class="custom-control-label" for="notif_petani"></label>
                            </div>
                        </div>
                        <small class="switch-desc">Notifikasi saat ada petani baru yang mendaftar di platform.</small>
                    </div>
                </div>
            <?php endif; ?>

            <!-- ============================================ -->
            <!-- KATEGORI: LAPORAN -->
            <!-- ============================================ -->
            <?php if ($is_admin || $is_petani || $is_pembeli): ?>
                <div class="category-header">
                    <i class="bi bi-megaphone"></i> LAPORAN
                </div>

                <!-- Promo & Diskon (Hanya Pembeli) -->
                <?php if ($is_pembeli): ?>
                    <div class="switch-group">
                        <div class="switch-icon" style="background: #FCE4EC; color: #C62828;">
                            <i class="bi bi-gift"></i>
                        </div>
                        <div class="switch-content">
                            <div class="switch-label">
                                <span>Lansiran Promo & Diskon</span>
                                <div class="custom-switch ml-auto">
                                    <input type="checkbox" class="custom-control-input" id="notif_promo" name="notif_promo"
                                        <?= isset($settings['notif_promo']) && $settings['notif_promo'] == 1 ? 'checked' : ''; ?>>
                                    <label class="custom-control-label" for="notif_promo"></label>
                                </div>
                            </div>
                            <small class="switch-desc">Informasi promo dan diskon spesial untuk pelanggan setia.</small>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Laporan Bulanan (Admin & Petani) -->
                <?php if ($is_admin || $is_petani): ?>
                    <div class="switch-group">
                        <div class="switch-icon" style="background: #E8EAF6; color: #283593;">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <div class="switch-content">
                            <div class="switch-label">
                                <span>Lansiran Laporan Bulanan</span>
                                <div class="custom-switch ml-auto">
                                    <input type="checkbox" class="custom-control-input" id="notif_laporan" name="notif_laporan"
                                        <?= isset($settings['notif_laporan']) && $settings['notif_laporan'] == 1 ? 'checked' : ''; ?>>
                                    <label class="custom-control-label" for="notif_laporan"></label>
                                </div>
                            </div>
                            <small class="switch-desc">Notifikasi saat laporan bulanan siap untuk diunduh.</small>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <!-- ============================================ -->
            <!-- KATEGORI: SISTEM (Semua Role) -->
            <!-- ============================================ -->
            <div class="category-header">
                <i class="bi bi-server"></i> SISTEM & MAINTENANCE
            </div>

            <!-- Update Sistem (Semua Role) -->
            <div class="switch-group" style="border-bottom: none;">
                <div class="switch-icon" style="background: #F3E5F5; color: #6A1B9A;">
                    <i class="bi bi-shield-check"></i>
                </div>
                <div class="switch-content">
                    <div class="switch-label">
                        <span>Lansiran Maintenance & Update Sistem</span>
                        <div class="custom-switch ml-auto">
                            <input type="checkbox" class="custom-control-input" id="notif_sistem" name="notif_sistem"
                                <?= isset($settings['notif_sistem']) && $settings['notif_sistem'] == 1 ? 'checked' : ''; ?>>
                            <label class="custom-control-label" for="notif_sistem"></label>
                        </div>
                    </div>
                    <small class="switch-desc">Terima kabar pemeliharaan server dan update fitur dari tim teknis.</small>
                </div>
            </div>

            <!-- BUTTONS -->
            <div class="btn-group-action">
                <button type="submit" class="btn-save">
                    <i class="bi bi-shield-check mr-2"></i> Simpan Konfigurasi
                </button>

                <?php 
                // ============================================
                // 🔴 TENTUKAN DASHBOARD URL BERDASARKAN ROLE
                // ============================================
                if ($role == 'Admin') {
                    $dashboard_url = base_url('admin/dashboard');
                } elseif ($role == 'Petani') {
                    $dashboard_url = base_url('petani/dashboard');
                } elseif ($role == 'Pembeli') {
                    $dashboard_url = base_url('pembeli/dashboard');
                } else {
                    $dashboard_url = base_url();
                }
                ?>

                <a href="<?= $dashboard_url; ?>" class="btn-cancel">
                    <i class="bi bi-arrow-left mr-1"></i> Kembali ke Dashboard
                </a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.custom-control-input').forEach(function(input) {
                updateLabelStyle(input);
                input.addEventListener('change', function() {
                    updateLabelStyle(this);
                });
            });

            function updateLabelStyle(input) {
                const label = input.nextElementSibling;
                if (label && label.classList.contains('custom-control-label')) {
                    if (input.checked) {
                        label.style.background = '#4A2C11';
                    } else {
                        label.style.background = '#E5E7EB';
                    }
                }
            }
        });
    </script>

</body>

</html>
