<div align="center">
  
  # 🎓 SCHOLARIS
  **Sistem Cerdas Rekomendasi Beasiswa Berbasis Algoritma SAW**
  
  <p align="center">
    Aplikasi web cerdas untuk membantu institusi pendidikan (sekolah/kampus) dalam menentukan prioritas penerima beasiswa secara objektif dan transparan menggunakan algoritma <strong>Simple Additive Weighting (SAW)</strong>.
  </p>
</div>

---

## 🌟 Fitur Utama

Aplikasi ini memiliki 3 level pengguna (Role) dengan hak akses dan fitur yang berbeda:

### 1. 👨‍🎓 Mahasiswa
* **Pendaftaran Beasiswa**: Mengisi form pengajuan (Data Diri, Akademik, Kriteria) dan mengunggah dokumen persyaratan (KTP, KK, SKTM, Transkrip Nilai, Sertifikat).
* **Pantau Status**: Fitur *stepper* interaktif untuk memantau status pengajuan (Menunggu Verifikasi, Sedang Diproses, Selesai).
* **Lihat Skor SAW**: Melihat hasil perhitungan SAW secara detail beserta peringkat (Ranking) yang diperoleh dibandingkan pendaftar lain.

### 2. 👨‍🏫 Dosen Pembimbing
* **Verifikasi Dokumen**: Melihat daftar mahasiswa bimbingan yang mengajukan beasiswa, lengkap dengan *live search* dan filter.
* **Review Pengajuan**: Tampilan *split-screen* untuk meninjau kecocokan data kriteria yang diinput dengan dokumen fisik yang diunggah.
* **Laporan Eksekutif**: *Dashboard* analitik yang menampilkan ringkasan kelulusan mahasiswa bimbingan dengan visualisasi progres dan skor SAW.

### 3. 👨‍💻 Administrator (Jurusan/Kampus)
* **Manajemen Pendaftar**: Mengelola seluruh data mahasiswa yang mendaftar beasiswa di tingkat fakultas/kampus.
* **Eksekusi Algoritma SAW**: Tombol pintar untuk memicu perhitungan dan pembobotan seluruh pendaftar secara otomatis.
* **Manajemen Kriteria & Bobot**: Menambah, mengubah, atau menghapus kriteria penilaian (IPK, Penghasilan Orang Tua, Prestasi, Keaktifan) serta mengatur tipe (*Benefit/Cost*).
* **Export Laporan (PDF/Excel)**: Mencetak hasil akhir pemeringkatan beasiswa sebagai dokumen resmi untuk pencairan dana.

---

## 🛠️ Teknologi yang Digunakan

* **Framework:** Laravel 10 (PHP 8.2+)
* **Database:** MySQL
* **Frontend:** TailwindCSS, Alpine.js, Blade Components
* **Autentikasi:** Laravel Breeze
* **Library Tambahan:**
  * `barryvdh/laravel-dompdf` (Cetak Laporan PDF)
  * `maatwebsite/excel` (Export Data Excel)

---

## 🚀 Panduan Instalasi

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi secara lokal.

### 1. Kebutuhan Sistem
Pastikan Anda telah menginstal:
* PHP >= 8.2
* Composer
* MySQL atau MariaDB
* Node.js & NPM

### 2. Kloning Repositori
```bash
git clone https://github.com/username/scholaris.git
cd scholaris
```

### 3. Instalasi Dependensi
```bash
composer install
npm install
```

### 4. Konfigurasi Environment
Salin file `.env.example` menjadi `.env` lalu sesuaikan konfigurasi *database* Anda.
```bash
cp .env.example .env
```
Sesuaikan baris berikut di file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=projek_mk
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Migrasi Database dan Seeder
Jalankan perintah ini untuk membangun tabel dan mengisi *dummy data* (Akun bawaan dan data uji coba SAW).
```bash
php artisan migrate:fresh --seed
```

### 7. Compile Assets (TailwindCSS & JS)
```bash
npm run build
# Atau gunakan npm run dev untuk development
```

### 8. Jalankan Server
```bash
php artisan serve
```
Akses aplikasi melalui browser di: `http://localhost:8000`

---

## 🔑 Akses Login Bawaan (Dummy Data)

Setelah menjalankan `migrate:fresh --seed`, Anda dapat menggunakan akun berikut untuk masuk ke dalam sistem:

| Role | Email | Password | Keterangan |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin@scholaris.ac.id` | `password` | Akses penuh untuk manajemen SAW dan ekspor laporan. |
| **Dosen** | `dosen@scholaris.ac.id` | `password` | Meninjau mahasiswa bimbingan dan melihat statistik lulus. |
| **Mahasiswa** | `mhs1@scholaris.ac.id` | `password` | (Tersedia mhs1 hingga mhs20) |

> **Catatan**: Data mahasiswa simulasi (mhs1 - mhs15) secara otomatis sudah diverifikasi dan dihitung peringkat SAW-nya oleh *Seeder* untuk memudahkan pengujian.

---

## 🧮 Tentang Algoritma SAW

Metode **Simple Additive Weighting (SAW)** sering juga dikenal dengan istilah metode penjumlahan terbobot. Konsep dasar metode SAW adalah mencari penjumlahan terbobot dari rating kinerja pada setiap alternatif pada semua atribut.

Sistem SCHOLARIS secara cerdas:
1. Menentukan nilai kriteria setiap pendaftar.
2. Melakukan **Normalisasi** matriks keputusan (berdasarkan sifat kriteria *Benefit* atau *Cost*).
3. Melakukan **Pembobotan** terhadap hasil normalisasi.
4. Menghasilkan **Skor Akhir (Preferensi)** untuk melakukan pemeringkatan secara *real-time*.

---

<div align="center">
  <p>Dibuat dengan ❤️ untuk sistem pendidikan yang lebih transparan.</p>
</div>
