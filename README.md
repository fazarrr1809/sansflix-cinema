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
sansflix-cinema/
├── app/ # Logic aplikasi (Controller, Model, Service)
├── bootstrap/
├── config/
├── database/ # Migration & Seeder
├── public/ # Asset publik
├── resources/ # Blade views & frontend assets
├── routes/ # Routing web
├── tests/
├── .env.example
├── composer.json
├── package.json
└── README.md


---

## ⚙️ Cara Instalasi

### 1️ Clone Repository
```bash
git clone https://github.com/fazarrr1809/sansflix-cinema.git
cd sansflix-cinema

### 2️⃣ Install Dependency
''' bash
composer install
npm install

### 3️⃣ Konfigurasi Environment
''' bash
cp .env.example .env
php artisan key:generate
Atur konfigurasi database pada file .env

### 4️⃣ Migrasi & Seeder Database
''' bash
php artisan migrate --seed

### 5️⃣ Jalankan Aplikasi
''' bash
php artisan serve
npm run dev

Akses aplikasi di:
http://127.0.0.1:8000/


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


