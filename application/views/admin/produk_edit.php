<<<<<<< HEAD
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
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
            --radius-card: 14px;
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-cream);
            color: var(--dark-coffee);
            overflow-x: hidden;
        }

        /* --- SIDEBAR PREMIUM --- */
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

        /* Sidebar Footer - Tombol Keluar */
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

        /* --- MAIN CONTENT --- */
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

        /* --- NOTIFICATION BELL --- */
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
        }

        /* --- NOTIFICATION DROPDOWN --- */
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
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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
        }

        .notif-item:hover {
            background: var(--bg-cream);
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

        .notif-item .notif-icon.success {
            background: #D1FAE5;
            color: #065F46;
        }

        .notif-item .notif-icon.warning {
            background: #FEF3C7;
            color: #92400E;
        }

        .notif-item .notif-icon.info {
            background: #DBEAFE;
            color: #1E40AF;
        }

        .notif-item .notif-icon.danger {
            background: #FEE2E2;
            color: #991B1B;
        }

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

        /* --- ACTION CARDS --- */
        .action-card {
            background: var(--card-white);
            border: 1px solid rgba(74, 44, 17, 0.06);
            border-radius: var(--radius-card);
            padding: 18px 22px;
            display: flex;
            align-items: center;
            color: var(--dark-coffee);
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: var(--transition-smooth);
            box-shadow: var(--shadow-soft);
            position: relative;
            overflow: hidden;
        }

        .action-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--amber-cream), transparent);
            opacity: 0;
            transition: var(--transition-smooth);
        }

        .action-card:hover {
            text-decoration: none;
            color: var(--dark-coffee);
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
            border-color: transparent;
        }

        .action-card:hover::after {
            opacity: 1;
        }

        .action-icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            border-radius: 10px;
            background: #FDF5ED;
            color: var(--amber-cream);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.2rem;
            transition: var(--transition-smooth);
        }

        .action-card:hover .action-icon {
            background: var(--amber-cream);
            color: white;
            transform: scale(1.05);
        }

        .action-card .action-arrow {
            margin-left: auto;
            color: var(--text-secondary);
            transition: var(--transition-smooth);
            font-size: 0.9rem;
        }

        .action-card:hover .action-arrow {
            color: var(--amber-cream);
            transform: translateX(4px);
        }

        /* --- STAT BOX --- */
        .stat-box {
            background: var(--card-white);
            border: 1px solid rgba(74, 44, 17, 0.06);
            border-radius: var(--radius-card);
            padding: 22px 24px;
            position: relative;
            box-shadow: var(--shadow-soft);
            transition: var(--transition-smooth);
            overflow: hidden;
        }

        .stat-box:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
        }

        .stat-box .stat-decoration {
            position: absolute;
            right: -20px;
            top: -20px;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(230, 161, 92, 0.05);
            pointer-events: none;
        }

        .stat-title {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--text-secondary);
            letter-spacing: 0.7px;
        }

        .stat-num {
            font-size: 1.7rem;
            font-weight: 700;
            margin-top: 6px;
            margin-bottom: 0;
            color: var(--dark-coffee);
        }

        .stat-change {
            font-size: 0.75rem;
            font-weight: 600;
            margin-top: 4px;
        }

        .stat-change.up {
            color: #10b981;
        }

        .stat-change.down {
            color: #EF4444;
        }

        .stat-badge {
            position: absolute;
            right: 20px;
            top: 20px;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: var(--bg-cream);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: var(--roasted-brown);
            transition: var(--transition-smooth);
        }

        .stat-box:hover .stat-badge {
            transform: scale(1.05) rotate(-3deg);
        }

        /* --- CUSTOM CARD --- */
        .custom-card {
            background: var(--card-white);
            border: 1px solid rgba(74, 44, 17, 0.06);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-soft);
            transition: var(--transition-smooth);
            overflow: hidden;
        }

        .custom-card:hover {
            box-shadow: var(--shadow-hover);
        }

        .custom-card .card-header-custom {
            padding: 18px 24px;
            border-bottom: 1px solid rgba(74, 44, 17, 0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .custom-card .card-header-custom h6 {
            font-weight: 700;
            color: var(--dark-coffee);
            margin: 0;
            font-size: 0.85rem;
        }

        .custom-card .card-body-custom {
            padding: 24px;
        }

        /* ===== FORM ===== */
        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            font-weight: 600;
            font-size: 0.78rem;
            color: var(--text-secondary);
            margin-bottom: 5px;
            letter-spacing: 0.2px;
        }

        .form-group label .required {
            color: #EF4444;
            font-weight: 700;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            border: 1px solid rgba(74, 44, 17, 0.12);
            padding: 10px 16px;
            font-size: 0.88rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: var(--transition-smooth);
            background: var(--card-white);
            height: 44px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--amber-cream);
            box-shadow: 0 0 0 4px rgba(230, 161, 92, 0.1);
            outline: none;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2370655E' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 36px;
        }

        /* ===== FILE UPLOAD ===== */
        .file-upload-wrapper {
            position: relative;
        }

        .file-upload-wrapper input[type="file"] {
            display: block;
            width: 100%;
            padding: 9px 14px;
            border: 2px dashed rgba(74, 44, 17, 0.12);
            border-radius: 10px;
            background: var(--bg-cream);
            cursor: pointer;
            transition: var(--transition-smooth);
            font-size: 0.82rem;
            color: var(--text-secondary);
            height: 44px;
        }

        .file-upload-wrapper input[type="file"]:hover {
            border-color: var(--amber-cream);
            background: rgba(230, 161, 92, 0.04);
        }

        .file-upload-wrapper input[type="file"]::file-selector-button {
            padding: 5px 16px;
            border: none;
            border-radius: 6px;
            background: var(--amber-cream);
            color: white;
            font-weight: 600;
            font-size: 0.72rem;
            cursor: pointer;
            margin-right: 10px;
            transition: var(--transition-smooth);
        }

        .file-upload-wrapper input[type="file"]::file-selector-button:hover {
            background: var(--roasted-brown);
        }

        .file-helper {
            font-size: 0.7rem;
            color: var(--text-secondary);
            margin-top: 4px;
            display: block;
        }

        .file-helper i {
            font-size: 0.65rem;
        }

        /* ===== BUTTON ===== */
        .btn-custom {
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 10px 28px;
            border: none;
            transition: var(--transition-smooth);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary-custom {
            background: var(--amber-cream);
            color: white;
        }

        .btn-primary-custom:hover {
            background: var(--roasted-brown);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
            text-decoration: none;
        }

        .btn-secondary-custom {
            background: var(--bg-cream);
            color: var(--text-secondary);
            border: 1px solid rgba(74, 44, 17, 0.08);
        }

        .btn-secondary-custom:hover {
            background: #e8e0d8;
            color: var(--dark-coffee);
            transform: translateY(-2px);
            text-decoration: none;
        }

        .form-actions {
            padding-top: 20px;
            border-top: 1px solid rgba(74, 44, 17, 0.06);
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 8px;
        }

        /* --- RESPONSIVE --- */
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

            .stat-num {
                font-size: 1.3rem;
            }

            .action-card {
                padding: 14px 16px;
                font-size: 0.8rem;
            }

            .action-icon {
                width: 36px;
                height: 36px;
                min-width: 36px;
                font-size: 1rem;
            }

            .notif-dropdown {
                width: calc(100vw - 32px);
                right: -60px;
            }
            .custom-card .card-body-custom {
                padding: 20px;
            }
        }

        @media (max-width: 575.98px) {
            .main-content {
                padding: 16px 12px 20px;
            }

            .stat-box {
                padding: 16px 18px;
            }

            .stat-num {
                font-size: 1.1rem;
            }

            .stat-badge {
                width: 36px;
                height: 36px;
                font-size: 1rem;
                right: 14px;
                top: 14px;
            }

            .custom-card .card-body-custom {
                padding: 16px;
            }

            .notif-dropdown {
                width: calc(100vw - 24px);
                right: -70px;
            }
            .form-actions {
                flex-direction: column-reverse;
            }
            .form-actions .btn-custom {
                width: 100%;
                justify-content: center;
            }
        }

        /* SIDEBAR OVERLAY */
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
            .sidebar-overlay.active {
                display: block;
            }
        }

        /* SCROLLBAR */
        .sidebar-menu-wrapper::-webkit-scrollbar,
        .notif-dropdown-list::-webkit-scrollbar {
            width: 3px;
        }

        .sidebar-menu-wrapper::-webkit-scrollbar-track,
        .notif-dropdown-list::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-menu-wrapper::-webkit-scrollbar-thumb,
        .notif-dropdown-list::-webkit-scrollbar-thumb {
            background: rgba(230, 161, 92, 0.3);
            border-radius: 10px;
        }
    </style>
</head>

<body>

    
    <?php $this->load->view('admin/layout/sidebar'); ?>
=======
<style>
    :root {
        --roasted-brown: #4A2C11;
        --dark-coffee: #2C1808;
        --amber-cream: #E6A15C;
        --bg-cream: #FAF6F0;
        --card-white: #FFFFFF;
        --text-secondary: #70655E;
        --shadow-soft: 0 8px 30px rgba(44, 24, 8, 0.08);
        --shadow-hover: 0 12px 40px rgba(44, 24, 8, 0.15);
        --radius-card: 14px;
        --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* CUSTOM CARD */
    .custom-card {
        background: var(--card-white);
        border: 1px solid rgba(74, 44, 17, 0.06);
        border-radius: var(--radius-card);
        box-shadow: var(--shadow-soft);
        transition: var(--transition-smooth);
        overflow: hidden;
    }

    .custom-card:hover {
        box-shadow: var(--shadow-hover);
    }

    .card-header-custom {
        padding: 18px 28px;
        border-bottom: 1px solid rgba(74, 44, 17, 0.06);
        font-weight: 700;
        font-size: 1rem;
        color: var(--dark-coffee);
        display: flex;
        align-items: center;
        gap: 12px;
        background: var(--bg-cream);
    }

    .card-header-custom i {
        color: var(--amber-cream);
        font-size: 1.2rem;
    }

    .card-header-custom .badge-required {
        font-size: 0.65rem;
        font-weight: 600;
        color: var(--text-secondary);
        background: rgba(74, 44, 17, 0.06);
        padding: 3px 12px;
        border-radius: 20px;
        margin-left: auto;
    }

    .card-body-custom {
        padding: 28px 28px 20px;
    }

    /* FORM STYLES */
    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        font-weight: 600;
        font-size: 0.78rem;
        color: var(--text-secondary);
        margin-bottom: 5px;
        letter-spacing: 0.2px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .form-group label .required {
        color: #EF4444;
        font-weight: 700;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid rgba(74, 44, 17, 0.12);
        padding: 10px 16px;
        font-size: 0.88rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
        transition: var(--transition-smooth);
        background: var(--card-white);
        height: 44px;
    }

    .form-control:focus {
        border-color: var(--amber-cream);
        box-shadow: 0 0 0 4px rgba(230, 161, 92, 0.1);
        outline: none;
    }

    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2370655E' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        padding-right: 36px;
    }

    /* FILE UPLOAD */
    .file-upload-wrapper input[type="file"] {
        display: block;
        width: 100%;
        padding: 9px 14px;
        border: 2px dashed rgba(74, 44, 17, 0.12);
        border-radius: 10px;
        background: var(--bg-cream);
        cursor: pointer;
        transition: var(--transition-smooth);
        font-size: 0.82rem;
        color: var(--text-secondary);
        height: 44px;
    }

    .file-upload-wrapper input[type="file"]::file-selector-button {
        padding: 5px 16px;
        border: none;
        border-radius: 6px;
        background: var(--amber-cream);
        color: white;
        font-weight: 600;
        font-size: 0.72rem;
        cursor: pointer;
        margin-right: 10px;
    }

    /* BUTTONS */
    .btn-custom {
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        padding: 10px 28px;
        border: none;
        transition: var(--transition-smooth);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none !important;
    }

    .btn-primary-custom {
        background: var(--amber-cream);
        color: white;
    }

    .btn-primary-custom:hover {
        background: var(--roasted-brown);
        color: white;
        transform: translateY(-2px);
    }

    .btn-secondary-custom {
        background: var(--bg-cream);
        color: var(--text-secondary);
        border: 1px solid rgba(74, 44, 17, 0.08);
    }

    .btn-secondary-custom:hover {
        background: #e8e0d8;
        color: var(--dark-coffee);
    }

    .form-actions {
        padding-top: 20px;
        border-top: 1px solid rgba(74, 44, 17, 0.06);
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 8px;
    }
</style>

<!-- FORM CARD -->
<div class="custom-card fade-in">
    <div class="card-header-custom">
        <i class="bi bi-box-seam-fill"></i>
        Formulir Edit Produk Kopi
        <span class="badge-required">
            <i class="bi bi-asterisk text-danger" style="font-size:0.5rem;"></i> Wajib diisi
        </span>
    </div>
>>>>>>> c50a8c46b5d9744b96ff8d6c8a37c62a316dedd7

    <div class="card-body-custom">
        <form action="<?= base_url('admin/produk/update/' . $produk->id_produk); ?>" method="post" enctype="multipart/form-data">

            <div class="row">
                <!-- KOLOM KIRI -->
                <div class="col-lg-6">
                    <!-- NAMA PRODUK -->
                    <div class="form-group">
                        <label>Nama Produk <span class="required">*</span></label>
                        <select name="nama_produk" id="nama_produk" class="form-control" required>
                            <option value="">-- Pilih Nama Produk --</option>
                            <option value="Ceri" <?= isset($produk) && $produk->nama_produk == 'Ceri' ? 'selected' : ''; ?>>Ceri</option>
                            <option value="Biji Kopi" <?= isset($produk) && $produk->nama_produk == 'Biji Kopi' ? 'selected' : ''; ?>>Biji Kopi</option>
                            <option value="Kopi Bubuk" <?= isset($produk) && $produk->nama_produk == 'Kopi Bubuk' ? 'selected' : ''; ?>>Kopi Bubuk</option>
                        </select>
                    </div>

                    <!-- JENIS KOPI -->
                    <div class="form-group">
                        <label>Jenis Kopi <span class="required">*</span></label>
                        <select name="jenis_kopi" id="jenis_kopi" class="form-control" required>
                            <option value="Liberica">Liberica</option>
                        </select>
                    </div>

                    <!-- PROSES PENGOLAHAN (SEKARANG BISA DIEDIT) -->
                    <div class="form-group">
                        <label>Proses Pengolahan</label>
                        <input type="text" name="proses" id="proses" class="form-control" 
                               placeholder="Masukkan proses pengolahan" 
                               value="<?= isset($produk) ? ($produk->proses ?? '') : ''; ?>">
                    </div>

                    <!-- HARGA (Rp) (SEKARANG BISA DIEDIT) -->
                    <div class="form-group">
                        <label>Harga (Rp) <span class="required">*</span></label>
                        <input type="number" name="harga" id="harga" class="form-control" 
                               placeholder="Masukkan harga produk" 
                               value="<?= isset($produk) ? $produk->harga : ''; ?>" required>
                    </div>

                    <!-- STOK KETERSEDIAAN -->
                    <div class="form-group">
                        <label>Stok Ketersediaan (Kg) <span class="required">*</span></label>
                        <input type="number" name="stok_produk" id="stok" class="form-control"
                               placeholder="Masukkan jumlah stok (contoh: 50)" 
                               value="<?= isset($produk) ? $produk->stok_produk : ''; ?>" required>
                    </div>
                </div>

                <!-- KOLOM KANAN -->
                <div class="col-lg-6">
                    <!-- ALTITUDE -->
                    <div class="form-group">
                        <label>Altitude (Ketinggian Tanam)</label>
                        <input type="text" name="altitude" class="form-control"
                               placeholder="Contoh: 25 Meter" 
                               value="<?= isset($produk) ? $produk->altitude : ''; ?>">
                    </div>

                    <!-- STATUS PRODUK -->
                    <div class="form-group">
                        <label>Status Produk <span class="required">*</span></label>
                        <select name="status_produk" class="form-control" required>
                            <option value="Aktif" <?= isset($produk) && $produk->status_produk == 'Aktif' ? 'selected' : ''; ?>>Aktif</option>
                            <option value="Nonaktif" <?= isset($produk) && $produk->status_produk == 'Nonaktif' ? 'selected' : ''; ?>>Nonaktif</option>
                        </select>
                    </div>

                    <!-- FOTO PRODUK -->
                    <div class="form-group">
                        <label>Foto Produk</label>
                        <div class="file-upload-wrapper">
                            <input type="file" name="foto_utama" accept=".jpg,.jpeg,.png">
                            <small class="text-muted" style="font-size: 0.7rem; display:block; margin-top:4px;">
                                <i class="bi bi-info-circle"></i> Format: JPG, PNG. Maks 2MB
                            </small>
                        </div>
                        <?php if (isset($produk) && !empty($produk->foto_utama)): ?>
                            <div class="mt-2">
                                <small class="text-muted">Foto saat ini:</small><br>
                                <img src="<?= base_url('uploads/produk/' . $produk->foto_utama); ?>" 
                                     width="80" height="80" style="object-fit:cover; border-radius:8px; margin-top:4px; border:1px solid rgba(74,44,17,0.06);">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- FORM ACTIONS -->
            <div class="form-actions">
                <a href="<?= base_url('admin/produk'); ?>" class="btn btn-secondary-custom btn-custom">
                    <i class="bi bi-arrow-left"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary-custom btn-custom">
                    <i class="bi bi-save"></i> Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const namaProduk = document.getElementById('nama_produk');
        const jenisKopi = document.getElementById('jenis_kopi');
        const proses = document.getElementById('proses');
        const harga = document.getElementById('harga');

        const hargaDefault = {
            'Ceri': 7000,
            'Biji Kopi': 70000,
            'Kopi Bubuk': 120000
        };

        const prosesDefault = {
            'Ceri': 'Tanpa Proses',
            'Biji Kopi': 'Pencucian, Pengupasan, Penjemuran',
            'Kopi Bubuk': 'Pencucian, Pengupasan, Penjemuran, Penggilingan, Pengemasan'
        };

        if (namaProduk) {
            namaProduk.addEventListener('change', function() {
                const value = this.value;
                
                if (jenisKopi && value !== '') {
                    jenisKopi.value = 'Liberica';
                }

                // Hanya isi default jika Admin mengubah pilihan nama produk
                if (proses && value && prosesDefault[value]) {
                    proses.value = prosesDefault[value];
                }

                if (harga && value && hargaDefault[value]) {
                    harga.value = hargaDefault[value];
                }
            });
        }
    });
</script>