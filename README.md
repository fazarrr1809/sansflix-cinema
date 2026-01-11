# 🎬 Sansflix Cinema  
**Modern Online Cinema Ticket & Food Booking Platform**

<p align="center">
  <img src="https://fazarrizwanuli.wordpress.com/wp-content/uploads/2026/01/sansflix-logo.png.png?w=1024" width="300" alt="Sansflix Logo">
</p>

Sansflix Cinema adalah aplikasi web berbasis **Laravel** yang dirancang untuk memberikan pengalaman pemesanan tiket bioskop dan makanan secara **mudah, cepat, dan modern**.  
Pengguna dapat memilih film, jadwal, kursi, hingga memesan makanan dan minuman dalam satu sistem terpadu.

---

## 🚀 Fitur Utama

### 👤 Fitur Pengguna
- 🎟️ **Booking Tiket Bioskop Online**
  - Pilih film, studio, jadwal, dan kursi secara interaktif
- 🍿 **Pemesanan Food & Beverages**
  - Pesan snack dan minuman bersamaan dengan tiket
- 📄 **E-Ticket & Struk PDF**
  - Tiket dan bukti pembayaran otomatis dalam format PDF
- 🔐 **Login dengan Google (OAuth)**
  - Autentikasi cepat dan aman tanpa registrasi manual
- 👤 **Profil Pengguna**
  - Upload avatar dan kelola data akun
- 🔞 **Validasi Umur**
  - Sistem memastikan pengguna memenuhi batas usia minimal (15 tahun)

---

### 🛠️ Fitur Admin (Dashboard)
- 🎬 Manajemen film, studio, dan jadwal tayang
- 👥 Manajemen pengguna
- 🍔 Manajemen menu & stok makanan
- 📦 Monitoring transaksi tiket dan F&B
- 📊 Dashboard berbasis **Filament Admin Panel**

---

## 🧩 Teknologi yang Digunakan

### Backend
- **Laravel 12**
- PHP 8+
- MySQL / MariaDB

### Frontend
- Tailwind CSS
- Alpine.js
- Swiper.js
- Vite

### Tools & Library
- Filament (Admin Panel)
- Laravel Socialite (Google OAuth)
- DomPDF (Export PDF)
- PHPUnit (Testing)

---

## 📂 Struktur Project

Struktur direktori ini mengikuti standar arsitektur **Laravel 11**, yang memisahkan logika bisnis, tampilan, dan konfigurasi secara sistematis:

### text
sansflix-cinema/
├── app/
│   ├── Filament/       # Konfigurasi Admin Panel (Resources, Widgets, Pages)
│   ├── Http/
│   │   └── Controllers/# Logika alur aplikasi (Auth, Booking, Movie, News, dll)
│   ├── Mail/           # Class untuk pengiriman email konfirmasi (Ticket & Receipt)
│   └── Models/         # Definisi Database & Relasi Eloquent (Movie, Showtime, User, dll)
├── bootstrap/          # Inisialisasi framework & konfigurasi routing aplikasi
├── config/             # Kumpulan file konfigurasi sistem (Database, Mail, Services)
├── database/
│   ├── migrations/     # Skema struktur tabel database
│   └── seeders/        # Data dummy untuk pengujian sistem (Movie, Showtime, Promo)
├── public/             # Entry point (index.php) dan asset yang dapat diakses publik
├── resources/
│   ├── css/            # Style utama menggunakan Tailwind CSS
│   ├── js/             # Script frontend & integrasi Swiper.js
│   └── views/          # Template tampilan menggunakan Blade Engine
├── routes/
│   ├── web.php         # Definisi routing utama untuk user
│   └── console.php     # Perintah custom artisan
├── storage/            # Tempat penyimpanan file upload (Avatar, Bukti Bayar) & Log
├── tests/              # File pengujian unit dan fitur
├── .env.example        # Template konfigurasi environment
├── composer.json       # Daftar dependency PHP (Laravel, Filament, Socialite)
├── package.json        # Daftar dependency Node.js (Tailwind, Vite, Alpine.js)
└── README.md           # Dokumentasi proyek

---

## ⚙️ Cara Instalasi

### 1️⃣ Install Dependency
```bash
composer install
npm install

2️⃣ Konfigurasi Environment
cp .env.example .env
php artisan key:generate

3️⃣ Migrasi & Seeder Database
php artisan migrate --seed

4️⃣ Jalankan Aplikasi
php artisan serve
npm run dev
Akses aplikasi di browser:
http://127.0.0.1:8000/

---
📌 Tujuan Project

Project ini dikembangkan sebagai:

🎓 Project akademik

💼 Portofolio pengembangan web

🧪 Simulasi sistem booking bioskop modern

Seluruh data, transaksi, dan tampilan bersifat simulasi/fiktif.

.

🔒 Catatan Keamanan

Pastikan .env tidak diunggah ke repository

OAuth Google memerlukan konfigurasi client ID & secret sendiri

📜 Lisensi
Project ini dibuat untuk keperluan pembelajaran dan pengembangan.
Silakan gunakan dan modifikasi sesuai kebutuhan.


