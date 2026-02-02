# Hupuna Button Contact
A base WordPress plugin for floating contact buttons (Hotline, Zalo, Telegram, Whatsapp, Viber, Tiktok, Instagram, Youtube, Fanpage, etc.).  
Designed for learning, internal use, and internship projects.
Base plugin for contact buttons (Hotline, Zalo, Tiktok, etc.)

---

## ✨ Features

- 📞 Hotline (Phone)
- 💬 Zalo
- ✈️ Telegram
- 💜 Viber
- 🟢 Whatsapp
- 📷 Instagram
- ▶️ Youtube
- 🎵 Tiktok
- 👍 Facebook Fanpage
- 🔗 Custom link message
- 📨 Contact Form 7 integration
- 🎨 Custom color for each service
- 📍 Position: top/bottom – left/right
- 📱 Hide on Mobile / Tablet / Desktop
- 🔍 Size scale (zoom in / zoom out)
- ⚡ Lightweight, no external dependencies

---

## 📦 Installation

1. Clone or download this repository.
2. Upload the plugin folder to:

wp-content/plugins/hupuna-button-contact


3. Activate **Hupuna Button Contact** in WordPress Admin → Plugins.
4. Go to **Button Contact** menu to configure your buttons.

---

## 🗂 Project Structure

hupuna-button-contact/
├── assets/
│ ├── css/
│ ├── js/
│ └── images/
├── inc/
│ ├── class-hbc.php # Core bootstrap
│ ├── class-hbc-settings.php # Admin settings
│ └── class-hbc-frontend.php # Frontend render
├── templates/
│ ├── setting-page.php # Admin UI
│ └── fontend-page.php # Frontend HTML
├── languages/
├── hupuna-button-contact.php # Main plugin file
├── uninstall.php # Cleanup on delete
├── readme.txt # WordPress.org readme
└── README.md # GitHub readme

---

## 🗃 Data Storage

All plugin settings are stored in WordPress options table:

wp_options.option_name = hupuna_button_contact_settings


---

## 🧹 Uninstall

When deleting the plugin from WordPress Admin, all plugin data will be removed automatically via:

uninstall.php


---

## 🧑‍💻 Development

- WordPress 5.8+
- PHP 7.2+
- OOP structure (Core / Admin / Frontend)
- Uses WordPress Settings API
- Template-based frontend rendering

---

## 🧾 Changelog

### 1.0.0
- Initial release

---

## 📄 License

GPL v2 or later  
https://www.gnu.org/licenses/gpl-2.0.html