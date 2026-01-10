# 🎬 Sansflix Cinema - Modern Movie Ticket & F&B Booking System

<p align="center">
  <img src="https://fazarrizwanuli.wordpress.com/wp-content/uploads/2026/01/sansflix-logo.png.png?w=1024" width="300" alt="Sansflix Logo">
</p>

## 🚀 Tentang Proyek
**Sansflix Cinema** adalah platform manajemen bioskop digital yang memungkinkan pengguna memesan tiket film dan makanan secara daring. Aplikasi ini dirancang untuk memberikan pengalaman "Movie Night" yang mulus, mulai dari pemilihan kursi hingga pencetakan e-tiket.

---

## ✨ Fitur Utama

### 👤 Fitur Pengguna (Frontend)
- **Smart Booking System**: Pilih kursi bioskop secara interaktif berdasarkan jadwal tayang.
- **Concessions (F&B)**: Pesan camilan seperti popcorn dan minuman sebelum menonton.
- **Social Login**: Masuk instan menggunakan akun Google (OAuth2).
- **Personalized Profile**: Kelola identitas, unggah avatar, dan pantau usia (min. 15 tahun).
- **History & E-Ticket**: Lihat riwayat pesanan dan unduh tiket dalam format PDF.

### 🛠️ Fitur Admin (Filament Dashboard)
- **User Management**: Pantau data pengguna, hitung umur otomatis, dan manajemen keamanan.
- **Movie & Schedule**: Kelola daftar film, studio, dan jam tayang.
- **Food Inventory**: Kelola stok dan menu makanan/minuman.
- **Order Tracking**: Monitoring transaksi tiket dan makanan secara real-time.

---

## 🛠️ Tech Stack
- **Framework**: [Laravel 12](https://laravel.com)
- **Admin Panel**: [Filament PHP v3](https://filamentphp.com)
- **Styling**: [Tailwind CSS](https://tailwindcss.com) & [Alpine.js](https://alpinejs.dev)
- **Database**: MySQL / MariaDB
- **Integrasi**: Laravel Socialite (Google Login), DomPDF (Export Ticket)

---

## 📦 Panduan Instalasi Lokal

Ikuti langkah-langkah di bawah untuk menjalankan Sansflix di komputer Anda:

1. **Clone Repository**
   ```bash
   git clone [https://github.com/fazarrr1809/sansflix-cinema.git](https://github.com/fazarrr1809/sansflix-cinema.git)
   cd sansflix-cinema
2. **Instal Dependensi (PHP & JS)**
   composer install
   npm install && npm run build
