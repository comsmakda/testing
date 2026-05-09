# 🚀 SMK SMKN 2 Pinrang - Deployment System

Sistem web berbasis PHP Native yang dirancang dengan arsitektur *Front Controller* untuk kebutuhan manajemen internal SMKN 2 Pinrang. Proyek ini dioptimalkan untuk dijalankan di lingkungan server modern menggunakan **Coolify** dan **Nixpacks**.

## 📂 Struktur Folder Utama

```text
.
├── app/                # Logika Aplikasi (Controller & Model)
├── config/             # Konfigurasi Database & Aplikasi
├── core/               # Core Router & Library
├── public/             # Document Root (File yang dapat diakses publik)
│   └── index.php       # Pintu utama aplikasi (Front Controller)
├── .htaccess           # Konfigurasi untuk Apache (Localhost)
└── README.md           # Dokumentasi Proyek