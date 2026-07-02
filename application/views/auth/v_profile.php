<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Member</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --roasted-brown: #4A2C11;
            --dark-coffee: #2C1808;
            --amber-cream: #E6A15C;
            --bg-cream: #FAF6F0;
            --card-white: #FFFFFF;
            --text-secondary: #70655E;
            --sidebar-width: 260px;
            --shadow-soft: 0 8px 30px rgba(44, 24, 8, 0.08);
            --shadow-hover: 0 12px 40px rgba(44, 24, 8, 0.15);
            --radius-card: 16px;
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
            overflow-x: hidden;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, var(--dark-coffee) 0%, #1a0e04 100%);
            color: var(--bg-cream);
            z-index: 100;
            transition: var(--transition-smooth);
            box-shadow: 4px 0 25px rgba(44, 24, 8, 0.2);
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            padding: 28px 24px 20px;
            font-size: 1.1rem;
            font-weight: 700;
            border-bottom: 1px solid rgba(250, 246, 240, 0.08);
            color: var(--amber-cream);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-brand .brand-icon {
            width: 40px;
            height: 40px;
            background: rgba(230, 161, 92, 0.15);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }

        .sidebar-menu-wrapper {
            flex: 1;
            overflow-y: auto;
            padding: 15px 0;
        }

        .sidebar-menu-wrapper::-webkit-scrollbar {
            width: 3px;
        }
        .sidebar-menu-wrapper::-webkit-scrollbar-thumb {
            background: rgba(230, 161, 92, 0.3);
            border-radius: 10px;
        }

        .sidebar-menu {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .menu-item a {
            display: flex;
            align-items: center;
            padding: 12px 24px;
            color: #A8988A;
            font-weight: 500;
            font-size: 0.9rem;
            text-decoration: none;
            transition: var(--transition-smooth);
            position: relative;
            margin: 2px 10px;
            border-radius: 10px;
        }

        .menu-item a i {
            font-size: 1.15rem;
            margin-right: 14px;
            width: 22px;
            text-align: center;
        }

        .menu-item a .menu-badge {
            margin-left: auto;
            background: rgba(230, 161, 92, 0.2);
            color: var(--amber-cream);
            font-size: 0.7rem;
            padding: 2px 10px;
            border-radius: 20px;
            font-weight: 600;
        }

        .menu-item.active a,
        .menu-item a:hover {
            color: #ffffff;
            background: rgba(230, 161, 92, 0.12);
        }

        .menu-item.active a {
            background: rgba(230, 161, 92, 0.18);
            border-left: 3px solid var(--amber-cream);
        }

        .menu-item.active a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 24px;
            background: var(--amber-cream);
            border-radius: 0 3px 3px 0;
        }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid rgba(250, 246, 240, 0.06);
            margin-top: auto;
        }

        .sidebar-footer .btn-logout {
            width: 100%;
            padding: 10px 16px;
            border: 1px solid rgba(250, 246, 240, 0.1);
            border-radius: 10px;
            background: transparent;
            color: #A8988A;
            font-weight: 500;
            font-size: 0.85rem;
            transition: var(--transition-smooth);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
        }

        .sidebar-footer .btn-logout:hover {
            background: rgba(230, 161, 92, 0.1);
            color: #ffffff;
            border-color: rgba(230, 161, 92, 0.2);
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 30px 40px 40px;
            min-height: 100vh;
            transition: var(--transition-smooth);
        }

        .page-header {
            border-bottom: 1px solid rgba(74, 44, 17, 0.08);
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .page-header h2 {
            font-weight: 700;
            color: var(--dark-coffee);
            letter-spacing: -0.02em;
        }

        .page-header .subtitle {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-top: 2px;
        }

        .breadcrumb-custom {
            background: transparent;
            padding: 0;
            margin: 0;
            font-size: 0.85rem;
        }

        .breadcrumb-custom .breadcrumb-item a {
            color: var(--text-secondary);
            text-decoration: none;
            transition: var(--transition-smooth);
        }

        .breadcrumb-custom .breadcrumb-item a:hover {
            color: var(--amber-cream);
        }

        .breadcrumb-custom .breadcrumb-item.active {
            color: var(--dark-coffee);
            font-weight: 600;
        }

        /* ===== NOTIFICATION ===== */
        .notif-btn {
            position: relative;
            background: var(--card-white);
            border: 1px solid rgba(74, 44, 17, 0.06);
            border-radius: 12px;
            padding: 8px 14px;
            color: var(--dark-coffee);
            transition: var(--transition-smooth);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .notif-btn:hover {
            background: var(--bg-cream);
            box-shadow: var(--shadow-soft);
        }

        .notif-btn .notif-dot {
            position: absolute;
            top: -4px;
            right: -4px;
            width: 18px;
            height: 18px;
            background: #EF4444;
            border-radius: 50%;
            font-size: 0.6rem;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            border: 2px solid white;
            animation: pulse-dot 2s infinite;
        }

        .notif-dot.hidden {
            display: none;
        }

        @keyframes pulse-dot {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .notif-dropdown {
            position: absolute;
            right: 0;
            top: calc(100% + 10px);
            width: 380px;
            max-height: 400px;
            background: var(--card-white);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-hover);
            border: 1px solid rgba(74, 44, 17, 0.06);
            overflow: hidden;
            display: none;
            z-index: 50;
        }

        .notif-dropdown.show {
            display: block;
            animation: slideDown 0.25s ease;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .notif-dropdown-header {
            padding: 14px 18px;
            border-bottom: 1px solid rgba(74, 44, 17, 0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
        }

        .notif-dropdown-header a {
            font-size: 0.75rem;
            color: var(--amber-cream);
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
        }

        .notif-dropdown-header a:hover {
            text-decoration: underline;
        }

        .notif-dropdown-list {
            max-height: 300px;
            overflow-y: auto;
        }

        .notif-item {
            padding: 12px 18px;
            border-bottom: 1px solid rgba(74, 44, 17, 0.04);
            display: flex;
            align-items: flex-start;
            gap: 12px;
            transition: var(--transition-smooth);
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }

        .notif-item:hover {
            background: var(--bg-cream);
            text-decoration: none;
            color: inherit;
        }

        .notif-item .notif-icon {
            width: 36px;
            height: 36px;
            min-width: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }

        .notif-item .notif-icon.success { background: #D1FAE5; color: #065F46; }
        .notif-item .notif-icon.warning { background: #FEF3C7; color: #92400E; }
        .notif-item .notif-icon.info { background: #DBEAFE; color: #1E40AF; }
        .notif-item .notif-icon.danger { background: #FEE2E2; color: #991B1B; }
        .notif-item .notif-icon.primary { background: #EDE9FE; color: #5B21B6; }

        .notif-item .notif-text {
            flex: 1;
            font-size: 0.85rem;
        }

        .notif-item .notif-text .notif-time {
            font-size: 0.7rem;
            color: var(--text-secondary);
            display: block;
            margin-top: 2px;
        }

        .notif-item.unread {
            background: rgba(230, 161, 92, 0.05);
        }

        .notif-item.unread .notif-text {
            font-weight: 600;
        }

        .notif-badge-new {
            background: var(--amber-cream);
            color: white;
            font-size: 0.55rem;
            padding: 2px 8px;
            border-radius: 10px;
            align-self: center;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 99;
        }

        .sidebar-overlay.active {
            display: block;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                left: calc(-1 * var(--sidebar-width));
                box-shadow: none;
            }
            .sidebar.open {
                left: 0;
                box-shadow: 0 0 40px rgba(0, 0, 0, 0.3);
            }
            .main-content {
                margin-left: 0;
                padding: 20px 16px 30px;
            }
            .page-header h2 {
                font-size: 1.3rem;
            }
            .notif-dropdown {
                width: calc(100vw - 32px);
                right: -60px;
            }
            .sidebar-overlay.active {
                display: block;
            }
        }

        @media (max-width: 575.98px) {
            .main-content {
                padding: 16px 12px 20px;
            }
            .notif-dropdown {
                width: calc(100vw - 24px);
                right: -70px;
            }
        }

        /* ============================================================
           PROFIL STYLE - DESAIN BARU (TIDAK KETUTUPAN)
           ============================================================ */

        /* --- COVER & AVATAR - DESAIN TERPISAH --- */
        .profile-cover {
            background: linear-gradient(135deg, var(--roasted-brown) 0%, var(--dark-coffee) 100%);
            border-radius: var(--radius-card) var(--radius-card) 0 0;
            padding: 35px 35px 30px 35px;
            position: relative;
            overflow: hidden;
            min-height: 120px;
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .profile-cover::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 400px;
            height: 400px;
            background: rgba(230, 161, 92, 0.05);
            border-radius: 50%;
            pointer-events: none;
        }

        .profile-cover::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 300px;
            height: 300px;
            background: rgba(230, 161, 92, 0.03);
            border-radius: 50%;
            pointer-events: none;
        }

        /* AVATAR - Tidak overlap dengan cover */
        .profile-avatar {
            width: 110px;
            height: 110px;
            min-width: 110px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--amber-cream), #d48a42);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.5rem;
            color: white;
            border: 5px solid white;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            transition: var(--transition-smooth);
            position: relative;
            z-index: 2;
        }

        .profile-avatar:hover {
            transform: scale(1.03);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* USER INFO - Sejajar dengan avatar */
        .profile-cover .user-info {
            color: white;
            position: relative;
            z-index: 2;
            flex: 1;
        }

        .profile-cover .user-info h4 {
            font-weight: 800;
            font-size: 1.5rem;
            margin-bottom: 6px;
            letter-spacing: -0.02em;
        }

        .profile-cover .user-info .badge-role {
            background: rgba(255, 255, 255, 0.12);
            color: white;
            padding: 4px 16px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            display: inline-block;
        }

        .profile-cover .user-info .badge-role i {
            margin-right: 4px;
        }

        .profile-cover .user-info .badge-status {
            padding: 4px 16px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            display: inline-block;
        }

        .badge-status.active {
            background: #D1FAE5;
            color: #065F46;
        }

        .badge-status.inactive {
            background: #FEE2E2;
            color: #991B1B;
        }

        /* --- CARD --- */
        .profile-card {
            background: var(--card-white);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-soft);
            overflow: hidden;
            transition: var(--transition-smooth);
            margin-top: 0;
        }

        .profile-card:hover {
            box-shadow: var(--shadow-hover);
        }

        .profile-card .card-body-custom {
            padding: 30px 35px 30px;
        }

        /* --- FORM --- */
        .profile-card .form-group {
            margin-bottom: 18px;
        }

        .profile-card label {
            font-weight: 600;
            font-size: 0.7rem;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.7px;
            margin-bottom: 4px;
        }

        .input-group-custom {
            position: relative;
        }

        .input-group-custom .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            font-size: 1rem;
            opacity: 0.5;
        }

        .profile-card .form-control {
            border-radius: 10px;
            padding: 12px 16px 12px 44px;
            border: 1px solid rgba(74, 44, 17, 0.08);
            font-size: 0.9rem;
            background: #FAF8F6;
            transition: var(--transition-smooth);
            height: 48px;
        }

        .profile-card .form-control:focus {
            border-color: var(--amber-cream);
            box-shadow: 0 0 0 3px rgba(230, 161, 92, 0.12);
            background: white;
        }

        .profile-card .form-control:disabled {
            background: #F3F0EB;
            cursor: not-allowed;
            opacity: 0.8;
        }

        /* --- TOMBOL --- */
        .btn-edit {
            background: var(--roasted-brown);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 28px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: var(--transition-smooth);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-edit:hover {
            background: #3d2410;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(74, 44, 17, 0.15);
        }

        .btn-save {
            background: var(--amber-cream);
            color: white;
            border-radius: 10px;
            padding: 12px 32px;
            font-weight: 600;
            font-size: 0.9rem;
            border: none;
            transition: var(--transition-smooth);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-save:hover {
            background: #d48a42;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(230, 161, 92, 0.3);
        }

        .btn-cancel {
            background: transparent;
            color: var(--text-secondary);
            border: 1px solid #EFEAE2;
            border-radius: 10px;
            padding: 12px 32px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: var(--transition-smooth);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-cancel:hover {
            background: var(--bg-cream);
            color: var(--dark-coffee);
        }

        .btn-change-password {
            background: transparent;
            color: var(--roasted-brown);
            border: 2px solid var(--roasted-brown);
            border-radius: 8px;
            padding: 4px 16px;
            font-size: 0.7rem;
            font-weight: 600;
            transition: var(--transition-smooth);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-change-password:hover {
            background: var(--roasted-brown);
            color: white;
            text-decoration: none;
        }

        /* --- STATISTIK MINI (3 KOLOM) --- */
        .stat-mini-card {
            background: var(--bg-cream);
            border-radius: 12px;
            padding: 16px 12px;
            text-align: center;
            transition: var(--transition-smooth);
            border: 1px solid rgba(74, 44, 17, 0.04);
            height: 100%;
        }

        .stat-mini-card:hover {
            background: #f5eee6;
            transform: translateY(-3px);
            box-shadow: var(--shadow-soft);
        }

        .stat-mini-card .stat-icon {
            font-size: 1.3rem;
            color: var(--amber-cream);
            margin-bottom: 2px;
        }

        .stat-mini-card .number {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--roasted-brown);
            line-height: 1.2;
        }

        .stat-mini-card .label {
            font-size: 0.65rem;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        /* --- INFO ROW --- */
        .info-row {
            display: flex;
            align-items: center;
            padding: 14px 0;
            border-bottom: 1px solid rgba(74, 44, 17, 0.05);
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-row .info-icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            border-radius: 12px;
            background: var(--bg-cream);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--amber-cream);
            font-size: 1.2rem;
            margin-right: 16px;
            transition: var(--transition-smooth);
        }

        .info-row:hover .info-icon {
            background: var(--amber-cream);
            color: white;
        }

        .info-row .info-label {
            font-size: 0.7rem;
            color: var(--text-secondary);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-row .info-value {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--dark-coffee);
        }

        /* --- BADGE EMAIL --- */
        .badge-email-verified {
            font-size: 0.6rem;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 600;
            margin-left: 8px;
        }

        .badge-email-verified.verified {
            background: #D1FAE5;
            color: #065F46;
        }

        .badge-email-verified.unverified {
            background: #FEF3C7;
            color: #92400E;
        }

        /* --- ALERT --- */
        .alert-custom {
            border-radius: 12px;
            padding: 14px 20px;
            font-weight: 600;
            border: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-custom.success {
            background: #D1FAE5;
            color: #065F46;
        }

        .alert-custom.error {
            background: #FEE2E2;
            color: #991B1B;
        }

        /* --- SECTION TITLE --- */
        .section-title {
            font-weight: 700;
            color: var(--roasted-brown);
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
        }

        .section-title i {
            color: var(--amber-cream);
            font-size: 1.1rem;
        }

        /* --- DIVIDER --- */
        .divider-custom {
            border: none;
            border-top: 2px solid rgba(74, 44, 17, 0.06);
            margin: 24px 0;
        }

        /* --- FOOTER --- */
        .footer-bottom {
            color: var(--text-secondary);
            font-size: 0.75rem;
            border-top: 1px solid rgba(74, 44, 17, 0.06);
            padding-top: 20px;
            margin-top: 30px;
            text-align: center;
        }

        /* ============================================================
           SCROLLBAR GLOBAL
           ============================================================ */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg-cream); }
        ::-webkit-scrollbar-thumb { background: var(--amber-cream); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--roasted-brown); }

        /* ============================================================
           RESPONSIVE FIX
           ============================================================ */
        @media (max-width: 767.98px) {
            .profile-cover {
                flex-direction: column;
                align-items: center;
                text-align: center;
                padding: 30px 20px 25px;
                gap: 15px;
            }

            .profile-cover .user-info {
                text-align: center;
            }

            .profile-avatar {
                width: 90px;
                height: 90px;
                min-width: 90px;
                font-size: 2.8rem;
            }

            .profile-cover .user-info h4 {
                font-size: 1.2rem;
            }

            .profile-card .card-body-custom {
                padding: 20px;
            }

            .stat-mini-card .number {
                font-size: 1.3rem;
            }

            .btn-edit {
                padding: 8px 18px;
                font-size: 0.75rem;
            }

            .btn-save, .btn-cancel {
                padding: 10px 20px;
                font-size: 0.8rem;
            }

            .d-flex.justify-content-between.align-items-center.mb-4 {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 12px;
            }

            .info-row {
                flex-wrap: wrap;
                gap: 8px;
            }

            .info-row .info-icon {
                width: 36px;
                height: 36px;
                min-width: 36px;
                font-size: 1rem;
            }

            .info-row .info-value {
                font-size: 0.85rem;
            }

            .btn-change-password {
                margin-left: auto;
            }
        }

        @media (max-width: 575.98px) {
            .main-content {
                padding: 16px 12px 20px;
            }

            .profile-avatar {
                width: 75px;
                height: 75px;
                min-width: 75px;
                font-size: 2.2rem;
            }

            .profile-cover .user-info h4 {
                font-size: 1rem;
            }

            .profile-cover .user-info .badge-role,
            .profile-cover .user-info .badge-status {
                font-size: 0.6rem;
                padding: 2px 12px;
            }

            .stat-mini-card {
                padding: 12px 8px;
            }

            .stat-mini-card .number {
                font-size: 1.1rem;
            }

            .stat-mini-card .label {
                font-size: 0.55rem;
            }

            .info-row .info-value {
                font-size: 0.8rem;
            }

            .badge-email-verified {
                font-size: 0.5rem;
                padding: 2px 8px;
                margin-left: 4px;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR OVERLAY -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebarMenu">
        <div class="sidebar-brand">
            <div class="brand-icon"><i class="bi bi-cup-hot-fill"></i></div>
            <span>MEMBER <br><small style="font-weight:400; font-size:0.7rem; color:#A8988A;">Liberchain</small></span>
        </div>
        <div class="sidebar-menu-wrapper">
            <ul class="sidebar-menu">
                <li class="menu-item">
                    <a href="<?= base_url('pembeli/dashboard'); ?>">
                        <i class="bi bi-house-door-fill"></i>Beranda Akun
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('landing/produk'); ?>">
                        <i class="bi bi-shop-window"></i>Katalog Belanja
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('pembeli/transaksi'); ?>">
                        <i class="bi bi-receipt"></i>Riwayat Transaksi
                        <span class="menu-badge"><?= $total_transaksi ?? 0 ?></span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('pembeli/tracking'); ?>">
                        <i class="bi bi-geo-alt-fill"></i>Status Pengiriman
                        <span class="menu-badge"><?= $pesanan_dikirim ?? 0 ?></span>
                    </a>
                </li>
                <li class="menu-item active">
                    <a href="<?= base_url('pembeli/profil'); ?>">
                        <i class="bi bi-person-fill"></i>Profil Saya
                    </a>
                </li>
            </ul>
        </div>
        <div class="sidebar-footer">
            <button class="btn-logout" onclick="window.location.href='<?= base_url('auth/logout'); ?>'">
                <i class="bi bi-box-arrow-right"></i> Keluar
            </button>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <!-- PAGE HEADER -->
        <div class="page-header d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <button class="btn btn-light d-inline-block d-lg-none mr-2" id="sidebarToggle"
                    style="border-radius:10px; border:1px solid rgba(74,44,17,0.08);">
                    <i class="bi bi-list"></i>
                </button>
                <h2 class="d-inline-block align-middle mb-0">
                    <i class="bi bi-person-fill" style="color: var(--amber-cream);"></i> Profil Saya
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom">
                        <li class="breadcrumb-item"><a href="<?= base_url('pembeli/dashboard'); ?>">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profil Saya</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex align-items-center gap-3" style="gap: 12px;">
                <!-- NOTIFICATION -->
                <div style="position: relative;">
                    <button class="notif-btn" id="notifToggle">
                        <i class="bi bi-bell" style="font-size: 1.2rem;"></i>
                        <?php if (isset($unread_count) && $unread_count > 0): ?>
                            <span class="notif-dot" id="notifCount"><?= $unread_count ?></span>
                        <?php else: ?>
                            <span class="notif-dot" id="notifCount" style="display:none;">0</span>
                        <?php endif; ?>
                    </button>

                    <div class="notif-dropdown" id="notifDropdown">
                        <div class="notif-dropdown-header">
                            <span><?= isset($unread_count) && $unread_count > 0 ? $unread_count . ' Notifikasi Belum Dibaca' : 'Semua Notifikasi'; ?></span>
                            <div>
                                <?php if (isset($unread_count) && $unread_count > 0): ?>
                                    <a href="#" id="markAllReadBtn" class="mr-2" style="font-size:0.7rem;">Tandai semua</a>
                                <?php endif; ?>
                                <a href="<?= base_url('pembeli/dashboard/history'); ?>" style="font-size:0.7rem;">Lihat Semua</a>
                            </div>
                        </div>
                        <div class="notif-dropdown-list" id="notifList">
                            <?php if (!empty($notifikasi)): ?>
                                <?php foreach ($notifikasi as $n): ?>
                                    <a class="notif-item <?= (isset($n->status_baca) && $n->status_baca == 0) ? 'unread' : ''; ?>"
                                       href="<?= base_url('pembeli/dashboard/read/' . $n->id_notifikasi); ?>">
                                        <?php
                                        $icon_type = $n->icon ?? 'info';
                                        $icon_map = [
                                            'success' => 'bi-check-circle-fill',
                                            'warning' => 'bi-exclamation-triangle-fill',
                                            'danger'  => 'bi-x-circle-fill',
                                            'info'    => 'bi-info-circle-fill',
                                            'primary' => 'bi-star-fill'
                                        ];
                                        $icon_class = $icon_map[$icon_type] ?? 'bi-info-circle-fill';
                                        ?>
                                        <div class="notif-icon <?= $icon_type; ?>">
                                            <i class="bi <?= $icon_class; ?>"></i>
                                        </div>
                                        <div class="notif-text">
                                            <?= htmlspecialchars($n->isi_notifikasi ?? 'Notifikasi'); ?>
                                            <span class="notif-time"><?= date('d M Y, H:i', strtotime($n->tanggal_buat)); ?></span>
                                        </div>
                                        <?php if (isset($n->status_baca) && $n->status_baca == 0): ?>
                                            <span class="notif-badge-new">Baru</span>
                                        <?php endif; ?>
                                    </a>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center text-muted py-5 px-3">
                                    <i class="bi bi-bell-slash d-block mb-2" style="font-size:2rem;"></i>
                                    <p class="small mb-0">Tidak ada notifikasi</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-2 text-center border-top" style="background:#FAF6F0; border-color:rgba(74,44,17,0.06);">
                            <a href="<?= base_url('pembeli/dashboard/settings'); ?>" class="small text-secondary font-weight-bold text-decoration-none">
                                <i class="bi bi-gear-fill mr-1"></i> Pengaturan Notifikasi
                            </a>
                        </div>
                    </div>
                </div>

                <!-- USER AVATAR -->
                <div class="d-flex align-items-center gap-2"
                    style="cursor: pointer; padding: 6px 12px; border-radius: 10px; background: var(--card-white); border: 1px solid rgba(74,44,17,0.06);">
                    <i class="bi bi-person-circle" style="font-size: 1.5rem; color: var(--amber-cream);"></i>
                    <span style="font-weight:500; font-size:0.85rem;"><?= $user->nama ?? 'Pembeli' ?></span>
                </div>
            </div>
        </div>

        <!-- ALERT -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert-custom success mb-3">
                <i class="bi bi-check-circle-fill"></i> <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert-custom error mb-3">
                <i class="bi bi-exclamation-triangle-fill"></i> <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- === PROFIL CARD === -->
        <div class="profile-card">

            <!-- COVER - DESAIN BARU (AVATAR & USER INFO SEJAJAR) -->
            <div class="profile-cover">
                <div class="profile-avatar">
                    <?php if (!empty($user->foto) && file_exists('./uploads/profil/' . $user->foto)): ?>
                        <img src="<?= base_url('uploads/profil/' . $user->foto) ?>" alt="Foto Profil">
                    <?php else: ?>
                        <i class="bi bi-person-fill"></i>
                    <?php endif; ?>
                </div>
                <div class="user-info">
                    <h4><?= $user->nama ?? 'Budi Pembeli' ?></h4>
                    <div>
                        <span class="badge-role"><i class="bi bi-person"></i> <?= $user->role ?? 'Pembeli' ?></span>
                        <span class="badge-status <?= strtolower($user->status ?? 'Active') == 'active' ? 'active' : 'inactive'; ?> ml-2">
                            <i class="bi bi-circle-fill" style="font-size:0.4rem; margin-right:4px;"></i>
                            <?= ucfirst($user->status ?? 'Active') ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- BODY -->
            <div class="card-body-custom">

                <!-- STATISTIK MINI (3 KOLOM - TANPA POIN) -->
                <div class="row mb-4">
                    <div class="col-4">
                        <div class="stat-mini-card">
                            <div class="stat-icon"><i class="bi bi-receipt"></i></div>
                            <div class="number"><?= $total_transaksi ?? 0 ?></div>
                            <div class="label">Transaksi</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-mini-card">
                            <div class="stat-icon"><i class="bi bi-truck"></i></div>
                            <div class="number"><?= $pesanan_dikirim ?? 0 ?></div>
                            <div class="label">Dikirim</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-mini-card">
                            <div class="stat-icon"><i class="bi bi-check-circle"></i></div>
                            <div class="number"><?= $pesanan_selesai ?? 0 ?></div>
                            <div class="label">Selesai</div>
                        </div>
                    </div>
                </div>

                <hr class="divider-custom">

                <!-- FORM DATA DIRI -->
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap" style="gap: 12px;">
                    <h6 class="section-title">
                        <i class="bi bi-person-gear"></i> Data Diri
                    </h6>
                    <button class="btn-edit" id="btnEdit" onclick="toggleEdit()">
                        <i class="bi bi-pencil"></i> Ubah Data
                    </button>
                </div>

                <form id="profileForm" method="POST" action="<?= base_url('pembeli/profil/update'); ?>">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <div class="input-group-custom">
                                    <span class="input-icon"><i class="bi bi-person"></i></span>
                                    <input type="text" name="nama" class="form-control" id="inputNama"
                                        value="<?= $user->nama ?? 'Budi Pembeli' ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username</label>
                                <div class="input-group-custom">
                                    <span class="input-icon"><i class="bi bi-at"></i></span>
                                    <input type="text" name="username" class="form-control" id="inputUsername"
                                        value="<?= $user->username ?? 'pembeli' ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <div class="input-group-custom">
                                    <span class="input-icon"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" id="inputEmail"
                                        value="<?= $user->email ?? 'pembeli@poktan.com' ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bergabung Sejak</label>
                                <div class="input-group-custom">
                                    <span class="input-icon"><i class="bi bi-calendar3"></i></span>
                                    <input type="text" class="form-control" id="inputJoined"
                                        value="<?= !empty($user->created_at) ? date('d F Y', strtotime($user->created_at)) : '21 June 2026' ?>"
                                        disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TOMBOL AKSI (hidden by default) -->
                    <div id="editActions" style="display: none;" class="mt-3 pt-3 border-top">
                        <button type="submit" class="btn-save">
                            <i class="bi bi-check-circle"></i> Simpan Perubahan
                        </button>
                        <button type="button" class="btn-cancel ml-2" onclick="cancelEdit()">
                            <i class="bi bi-x-circle"></i> Batal
                        </button>
                    </div>
                </form>

                <hr class="divider-custom">

                <!-- KEAMANAN AKUN -->
                <h6 class="section-title mb-3">
                    <i class="bi bi-shield-lock"></i> Keamanan Akun
                </h6>

                <div class="info-row">
                    <div class="info-icon"><i class="bi bi-key"></i></div>
                    <div style="flex:1;">
                        <div class="info-label">Password</div>
                        <div class="info-value">••••••••</div>
                    </div>
                    <a href="<?= base_url('auth/ubah_password'); ?>" class="btn-change-password">
                        <i class="bi bi-pencil"></i> Ubah
                    </a>
                </div>

                <div class="info-row">
                    <div class="info-icon"><i class="bi bi-envelope"></i></div>
                    <div style="flex:1;">
                        <div class="info-label">Email Terverifikasi</div>
                        <div class="info-value">
                            <?= $user->email ?? 'pembeli@poktan.com' ?>
                            <?php if (!empty($user->email_verified_at)): ?>
                                <span class="badge-email-verified verified"><i class="bi bi-check-circle-fill"></i> Terverifikasi</span>
                            <?php else: ?>
                                <span class="badge-email-verified unverified"><i class="bi bi-exclamation-circle-fill"></i> Belum Verifikasi</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-icon"><i class="bi bi-clock-history"></i></div>
                    <div style="flex:1;">
                        <div class="info-label">Aktivitas Terakhir</div>
                        <div class="info-value"><?= date('d F Y, H:i') ?></div>
                    </div>
                </div>

            </div>
        </div>

        <!-- FOOTER -->
        <div class="footer-bottom">
            &copy; <?= date('Y'); ?> POKTAN Liberchain. All rights reserved.
        </div>

    </div>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ============================================
        // 1. SIDEBAR TOGGLE
        // ============================================
        const sidebar = document.getElementById('sidebarMenu');
        const overlay = document.getElementById('sidebarOverlay');
        const toggleBtn = document.getElementById('sidebarToggle');

        function toggleSidebar() {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
            document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
        }

        if (toggleBtn) toggleBtn.addEventListener('click', toggleSidebar);
        if (overlay) overlay.addEventListener('click', toggleSidebar);

        document.addEventListener('click', function(e) {
            if (window.innerWidth > 991.98) return;
            if (!sidebar.contains(e.target) && toggleBtn && !toggleBtn.contains(e.target)) {
                if (sidebar.classList.contains('open')) toggleSidebar();
            }
        });

        // ============================================
        // 2. NOTIFICATION DROPDOWN
        // ============================================
        const notifToggle = document.getElementById('notifToggle');
        const notifDropdown = document.getElementById('notifDropdown');

        if (notifToggle) {
            notifToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                notifDropdown.classList.toggle('show');
            });
        }

        document.addEventListener('click', function(e) {
            if (notifDropdown && !notifDropdown.contains(e.target) && !notifToggle.contains(e.target)) {
                notifDropdown.classList.remove('show');
            }
        });

        // ============================================
        // 3. MARK ALL READ
        // ============================================
        function markAllRead() {
            if (confirm('Tandai semua notifikasi sebagai sudah dibaca?')) {
                $.ajax({
                    url: '<?= base_url('pembeli/dashboard/mark_all_read'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) location.reload();
                        else alert('Gagal menandai semua notifikasi.');
                    },
                    error: function() {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                });
            }
        }

        document.getElementById('markAllReadBtn')?.addEventListener('click', function(e) {
            e.preventDefault();
            markAllRead();
        });

        // ============================================
        // 4. EDIT PROFILE
        // ============================================
        let isEditing = false;

        function toggleEdit() {
            isEditing = !isEditing;
            const inputs = document.querySelectorAll('#profileForm .form-control');
            const actions = document.getElementById('editActions');
            const btnEdit = document.getElementById('btnEdit');

            inputs.forEach(input => {
                input.disabled = !isEditing;
                input.style.background = isEditing ? 'white' : '#F3F0EB';
                input.style.opacity = isEditing ? '1' : '0.8';
                const icon = input.closest('.input-group-custom')?.querySelector('.input-icon');
                if (icon) {
                    icon.style.opacity = isEditing ? '0.5' : '0.3';
                }
            });

            if (isEditing) {
                actions.style.display = 'block';
                btnEdit.innerHTML = '<i class="bi bi-x-circle"></i> Batalkan';
                btnEdit.className = 'btn-cancel';
                btnEdit.style.background = 'transparent';
                btnEdit.style.color = 'var(--text-secondary)';
                btnEdit.style.border = '1px solid #EFEAE2';
            } else {
                actions.style.display = 'none';
                btnEdit.innerHTML = '<i class="bi bi-pencil"></i> Ubah Data';
                btnEdit.className = 'btn-edit';
                btnEdit.style.background = 'var(--roasted-brown)';
                btnEdit.style.color = 'white';
                btnEdit.style.border = 'none';
            }
        }

        function cancelEdit() {
            if (isEditing) {
                toggleEdit();
                document.getElementById('inputNama').value = '<?= $user->nama ?? 'Budi Pembeli' ?>';
                document.getElementById('inputUsername').value = '<?= $user->username ?? 'pembeli' ?>';
                document.getElementById('inputEmail').value = '<?= $user->email ?? 'pembeli@poktan.com' ?>';
            }
        }

        console.log('✅ Halaman Profil Pembeli siap digunakan!');
        console.log('📋 Fitur:');
        console.log('   - Edit Profil (toggle)');
        console.log('   - Notifikasi Real-time');
        console.log('   - Statistik Transaksi (3 kolom)');
        console.log('   - Keamanan Akun');
    </script>
</body>

</html>
