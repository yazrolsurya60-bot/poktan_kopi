# LiberChain

## 📖 Project Overview

**LiberChain** is a web‑based management system for coffee farmer cooperatives (Poktan). It enables administrators, farmers (Petani), product managers, couriers, and partners to manage:

- **Farm (Lahan) data** – locations, sizes, owners.
- **Harvest (Panen) records** – periodic harvest data per farm.
- **Products** – coffee batch details, pricing, images.
- **User management** – admins, farmers, couriers, partners.
- **Reporting & dashboards** – visual insights for production, sales, and logistics.

Built on **CodeIgniter 3** (PHP) following an MVC architecture, the application provides a clean, responsive UI for both desktop and mobile browsers.

---

## ✨ Key Features

- **Role‑based access control** (Admin, Farmer, Courier, Partner)
- Full CRUD operations for farms, harvests, products, and users
- File upload handling for product images
- Interactive dashboards with charts and tables
- Export functionality (CSV/Excel) for farmer and product data
- Multi‑language support (future‑proof i18n)
- Secure authentication & session handling
- Modern responsive design with gradients, glass‑morphism effects, and subtle micro‑animations

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|------------|
| **Backend** | PHP 7.x, CodeIgniter 3 (MVC) |
| **Database** | MySQL / MariaDB |
| **Frontend** | HTML5, CSS3 (vanilla, custom UI components), JavaScript (jQuery) |
| **Server** | Apache (XAMPP) |
| **Version Control** | Git |

---

## 📦 Installation Guide

1. **Prerequisites**
   - XAMPP (Apache, PHP, MySQL) installed on Windows.
   - Composer (optional, for future dependency management).
2. **Clone the repository**
   ```bash
   git clone https://github.com/yazrolsurya60-bot/poktan_kopi.git
   ```
3. **Configure the database**
   - Create a new MySQL database, e.g., `liberchain`.
   - Import the provided SQL dump (`database/poktan_kopi.sql`) if available.
4. **Update configuration**
   - Edit `application/config/config.php`:
     ```php
     $config['base_url'] = 'http://localhost/poktan_kopi/';
     $db['default'] = array(
       'hostname' => 'localhost',
       'username' => 'root',
       'password' => '',
       'database' => 'liberchain',
       // ... other settings ...
     );
     ```
5. **Set folder permissions**
   - Ensure `uploads/` and `application/cache/` are writable by Apache.
6. **Run the application**
   - Start Apache & MySQL via XAMPP.
   - Navigate to `http://localhost/poktan_kopi/` in your browser.

---

## ⚙️ Configuration Details

- **Base URL** – defined in `application/config/config.php`.
- **Encryption key** – set `$config['encryption_key']` for session security.
- **Email settings** – optional SMTP configuration in `application/config/email.php` for notifications.
- **Environment** – switch `$config['environment']` between `development` and `production` to control error reporting.

---

## 🚀 Running Locally

```bash
# Using PHP built‑in server (for quick testing)
php -S localhost:8000 -t public
```

Or simply use XAMPP’s Apache service as described above.

---

## 📂 Directory Structure

```
├─ application/            # CodeIgniter MVC core
│   ├─ config/            # Configuration files (config.php, routes.php, etc.)
│   ├─ controllers/       # Controllers (Welcome.php, admin/, petani/)
│   ├─ models/            # Data models (Panen_model.php, etc.)
│   └─ views/             # HTML templates (admin/, petani/, landing/)
├─ assets/                # CSS, JS, images used by the UI
├─ uploads/               # Uploaded product images
├─ database/              # Optional SQL dump files
└─ README.md              # Project documentation (this file)
```

---

## 🤝 Contributing

1. Fork the repository.
2. Create a feature branch (`git checkout -b feature/your-feature`).
3. Commit changes with clear messages.
4. Open a Pull Request targeting `main`.
5. Ensure all existing tests pass (`phpunit` – if a test suite exists).

---

## 📄 License

This project is licensed under the **MIT License** – see the `LICENSE` file for details.

---

## 📞 Support & Contact

For questions or contributions, reach out to the repository maintainer:
- **GitHub**: https://github.com/yazrolsurya60-bot/poktan_kopi
- **Email**: dev@example.com

---

*Generated on 2026‑06‑25.*
