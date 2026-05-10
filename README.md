# 🚀 PHP Testing — COM SMKN 2 PINRANG

Project testing deployment PHP menggunakan **Coolify** + **Cloudflare Tunnel** + **Git**.

## 📋 Deskripsi

Halaman `index.php` sederhana yang menampilkan informasi server secara real-time, digunakan untuk memverifikasi bahwa deployment PHP berjalan dengan benar di infrastruktur Coolify.

## ⚙️ Stack

| Komponen | Detail |
|---|---|
| Hosting | Coolify v4 (Self-hosted) |
| Tunnel | Cloudflare Tunnel |
| Domain | comsmkn2pinrang.my.id |
| Language | PHP 8.x |
| Proxy | Traefik (via Coolify) |
| Virtualisasi | Proxmox |

## 📁 Struktur

```
/
└── index.php   # Halaman utama — menampilkan info server PHP
└── README.md   # Dokumentasi project
```

## 🖥️ Fitur index.php

- Versi PHP yang berjalan
- Waktu server real-time
- Hostname container
- Informasi OS
- Environment variables server
- Status HTTPS / Cloudflare
- Memory limit & max execution time

## 🚀 Cara Deploy di Coolify

1. Push project ini ke GitHub
2. Buka Coolify → **Projects** → **New Resource**
3. Pilih **Application** → **Git Repository**
4. Hubungkan repo ini
5. Set **Build Pack** ke `PHP` atau gunakan `Dockerfile`
6. Set domain: `https://namaapp.comsmkn2pinrang.my.id`
7. Klik **Deploy**

## 🐳 Dockerfile (Opsional)

Jika ingin menggunakan Docker, buat file `Dockerfile`:

```dockerfile
FROM php:8.2-apache
COPY . /var/www/html/
EXPOSE 80
```

## 🌐 Akses

Setelah deploy, akses via:
```
https://php.comsmkn2pinrang.my.id
```

---

**COM SMKN 2 PINRANG** &copy; 2026