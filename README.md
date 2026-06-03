<div align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  
  <br>
  
  # 🎓 Scholaris - Sistem Rekomendasi Beasiswa Cerdas
  
  **Aplikasi Sistem Pendukung Keputusan (SPK) Penentuan Prioritas Penerima Beasiswa Mahasiswa <br> Menggunakan Metode Simple Additive Weighting (SAW).**
  
  [![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
  [![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
  [![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)](https://alpinejs.dev)
  [![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
</div>

---

## 📖 Tentang Proyek

**Scholaris** adalah sebuah Sistem Pendukung Keputusan (SPK) tingkat perguruan tinggi yang dirancang untuk mempermudah panitia dan pihak jurusan dalam menyeleksi dan memprioritaskan kandidat penerima beasiswa secara adil, transparan, dan otomatis. 

Sistem ini menerapkan metode perhitungan **SAW (Simple Additive Weighting)**, sebuah algoritma *Multi-Attribute Decision Making* yang bekerja dengan cara mencari penjumlahan terbobot dari rating kinerja pada setiap alternatif (mahasiswa) pada semua atribut (kriteria).

## ✨ Fitur Unggulan

Proyek ini dibangun dengan standar **Enterprise-Grade Clean Code**, mengimplementasikan *Service Layer Pattern*, *Form Request Validations*, dan antarmuka UI/UX yang modern.

- 🔐 **Autentikasi Multi-Role:** Akses aman yang terbagi secara presisi untuk 3 tipe pengguna: **Admin Jurusan**, **Dosen Pembimbing**, dan **Mahasiswa**.
- 📝 **Registrasi Mahasiswa Mandiri:** Mahasiswa dapat mendaftar akun mereka sendiri, memilih Program Studi, dan menunjuk Dosen Pembimbing secara langsung dari *dropdown* database dinamis.
- 🧮 **Mesin Perhitungan SAW Otomatis:** Perhitungan matriks keputusan, normalisasi matriks, hingga nilai preferensi akhir dieksekusi secara instan dan akurat.
- 📊 **Dashboard Analitik Interaktif:** Visualisasi data pendaftar (berdasarkan program studi dan angkatan) yang disajikan dengan grafik dinamis menggunakan *ApexCharts*.
- 🔔 **Sistem Notifikasi Real-Time:** Memberikan peringatan (*alert*) setiap ada pembaruan status pendaftaran ke dashboard Dosen Pembimbing maupun Mahasiswa.
- 👥 **Master Manajemen Pengguna (Admin):** Fasilitas bagi Admin untuk membuat, memodifikasi, dan menghapus seluruh tipe pengguna (*Admin, Dosen, Mahasiswa*) dalam satu pintu berteknologi *Database Transaction*.

## 🛠️ Teknologi yang Digunakan

*   **Backend:** PHP 8.x, Laravel 11.x
*   **Frontend:** HTML5, Alpine.js, Tailwind CSS
*   **Database:** MySQL / MariaDB
*   **Arsitektur Kode:** MVC, Repository/Service Pattern, Fat-Model Thin-Controller
*   **Visualisasi:** ApexCharts

## 🚀 Panduan Instalasi (Development)

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi di komputer lokal Anda:

1. **Clone repositori ini:**
   ```bash
   git clone https://github.com/username/scholaris.git
   cd scholaris
   ```

2. **Instal dependensi Composer:**
   ```bash
   composer install
   ```

3. **Instal dependensi NPM (Tailwind & Vite):**
   ```bash
   npm install
   npm run build
   ```

4. **Siapkan konfigurasi `.env`:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Atur koneksi database Anda (DB_DATABASE, DB_USERNAME, DB_PASSWORD) di dalam file `.env`.*

5. **Jalankan Migrasi & Seeder Database:**
   ```bash
   php artisan migrate --seed
   ```

6. **Jalankan server lokal:**
   ```bash
   php artisan serve
   ```
   *Sistem kini dapat diakses melalui `http://localhost:8000`.*

---

## 👨‍💻 Tim Pengembang

Proyek ini dirancang dan dikembangkan dengan penuh dedikasi oleh:

| Nama Lengkap | NIM |
| :--- | :--- |
| **Moh Maghribi Ramadhan** | `F55124104` |
| **Irpandi** | `F55124096` |
| **Annisa Nurqalbiyah** | `F55124089` |
| **Ramon Pasungke** | `F55124115` |

<br>
<div align="center">
  <i>Dibuat untuk Tugas Sistem Cerdas / Sistem Pendukung Keputusan</i>
</div>
