# Scholaris Design System (v2.0)

Scholaris adalah sistem rekomendasi beasiswa akademik berbasis algoritma **Simple Additive Weighting (SAW)**. Sistem desain ini dirancang untuk menjembatani wibawa institusi pendidikan dengan efisiensi platform SaaS modern, memberikan transparansi penuh bagi mahasiswa dan kendali data bagi administrator.

---

## 1. Filosofi & Prinsip Desain

- **Akademik & Bergengsi**: Menggunakan palet warna navy yang dalam dan tipografi yang kuat untuk menciptakan kesan otoritas, stabilitas, dan prestise.
- **Transparansi Algoritma**: Visualisasi data (SAW score) harus mudah dipahami, tidak mengintimidasi, dan membantu pengguna memahami proses seleksi.
- **Kejelasan Status**: Memberikan kepastian bagi mahasiswa melalui indikator progres yang jelas dan bahasa yang komunikatif.
- **Modernitas Terukur**: Menggunakan sudut membulat 12px, bayangan lembut, dan whitespace yang luas untuk menghindari kesan birokrasi yang kaku.

---

## 2. Identitas Visual

### 2.1 Palet Warna

| Peran             | Nama        | Hex Code  | Penggunaan Utama                                  |
| :---------------- | :---------- | :-------- | :------------------------------------------------ |
| **Brand Primary** | Deep Navy   | `#1B2A4A` | Sidebar Admin, Header, Teks Judul, Navigasi.      |
| **Brand Accent**  | Teal Green  | `#1D9E75` | CTA Utama, Indikator "Lolos", Progress Bar Aktif. |
| **Surface**       | Ghost White | `#F9F9F9` | Latar belakang halaman utama.                     |
| **Surface-Dim**   | Soft Slate  | `#E2E8F0` | Kartu informasi mahasiswa, area konten sekunder.  |
| **Success**       | Emerald     | `#10B981` | Badge status "Lolos" atau "Terverifikasi".        |
| **Warning**       | Amber       | `#F59E0B` | Badge status "Menunggu" atau "Cadangan".          |
| **Danger**        | Crimson     | `#EF4444` | Badge status "Ditolak" atau "Tidak Lolos".        |

### 2.2 Tipografi

Sistem tipografi menggunakan skala geometris untuk menjaga ritme visual yang konsisten.

- **Primary Font**: `Inter` (Sans-Serif) – Untuk semua elemen fungsional, label, dan isi konten.
- **Branding Font**: `Elegant Serif` (misal: Playfair Display) – Digunakan terbatas pada logo (Wordmark) dan headline besar pada halaman login untuk kesan institusional.

**Skala Tipografi (Desktop):**

- **Display/H1**: 32px, Bold, Navy (Judul Halaman)
- **Headline/H2**: 24px, Semibold, Navy (Judul Seksi/Kartu)
- **Body Large**: 18px, Medium (Teks Pengantar)
- **Body Base**: 16px, Regular (Konten Standar/Input)
- **Label/Small**: 14px, Medium (Badge, Teks Tabel, Caption)

---

## 3. Komponen Utama & Pola UI

### 3.1 Kartu Statistik (Stats Cards)

- **Struktur**: Ikon (linear background), Label (Caption), Nilai Utama (Large Bold).
- **Visual**: Background putih, rounded 12px, border-radius 12px, shadow `0 4px 6px -1px rgb(0 0 0 / 0.1)`.

### 3.2 Tabel Ranking SAW

- **Baris**: Background putih dengan hover state lembut. Baris Top-N (kuota) diberi highlight hijau sangat transparan.
- **Kolom Skor SAW**: Wajib menyertakan _inline progress bar_ ramping (height: 8px) berwarna Teal Green untuk merepresentasikan nilai 0.0 - 1.0 secara visual.
- **Badge Status**: Pill-shaped, semi-transparent background dengan warna teks yang kontras (Success/Warning/Danger).

### 3.3 Stepper Progress (Pelacakan Beasiswa)

- **State**:
    - _Selesai_: Ikon check hijau + garis hijau solid.
    - _Sedang Berjalan_: Lingkaran dengan border hijau + teks bold.
    - _Belum Mulai_: Ikon abu-abu + garis putus-putus.

---

## 4. Sistem Layout & Grid

- **Grid (Desktop)**: 12 Kolom, Gutter 24px, Margin Samping minimal 32px.
- **Spacing System**: Kelipatan 4px atau 8px (4, 8, 16, 24, 32, 48, 64) untuk menjaga konsistensi vertikal dan horizontal.
- **Responsive Breakpoints**:
    - Mobile: < 768px (Navigasi bawah/bottom nav)
    - Tablet: 768px - 1024px
    - Desktop: > 1024px (Navigasi samping/sidebar tetap)

---

## 5. Bahasa & Konten

- **Nada Bicara**: Profesional, Informatif, dan Empati.
- **Bahasa**: Bahasa Indonesia Baku untuk istilah sistem akademik (contoh: "Unduh Dokumen" bukan "Download File").
- **Transparansi Data**: Setiap angka skor harus dapat ditelusuri sumbernya (misal: menampilkan rumus atau kriteria pembobotannya).

---

## 6. Aset Visual

- **Ikonografi**: Menggunakan set ikon linear/outline yang konsisten (seperti Lucide atau Google Symbols) dengan stroke-width yang seragam.
- **Citra**: Gunakan foto profil mahasiswa asli atau ilustrasi geometris abstrak. Hindari clipart generik.
