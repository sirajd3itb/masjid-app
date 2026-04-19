# 🕌 Masjid Raya Siti Hajar Al-Madinah — Website Resmi

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white">
  <img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white">
  <img src="https://img.shields.io/badge/SQLite-003B57?style=for-the-badge&logo=sqlite&logoColor=white">
  <img src="https://img.shields.io/badge/Deploy-AlwaysData-00A86B?style=for-the-badge">
</p>

> Website resmi Masjid Raya Siti Hajar Al-Madinah yang menampilkan informasi jadwal kegiatan, sistem donasi, dan panel admin untuk pengelolaan konten.

---

## 📋 Daftar Isi

1. [Tentang Proyek](#-tentang-proyek)
2. [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
3. [Struktur Folder](#-struktur-folder-penjelasan-lengkap)
4. [Cara Kerja Website (Alur Kode)](#-cara-kerja-website-alur-kode)
5. [Struktur Database](#-struktur-database)
6. [Fitur-Fitur Website](#-fitur-fitur-website)
7. [Cara Install di Komputer Sendiri](#-cara-install-di-komputer-sendiri-dari-nol)
8. [Cara Deploy ke AlwaysData](#-cara-deploy-ke-alwaysdata)
9. [Akun Admin Default](#-akun-admin-default)
10. [Pertanyaan Umum (FAQ)](#-pertanyaan-umum-faq)

---

## 🏛️ Tentang Proyek

Website ini adalah **website profil masjid** yang dibuat menggunakan **Laravel** — sebuah framework (kerangka kerja) PHP yang populer. 

**Apa itu Laravel?**
Bayangkan membangun rumah. Jika membangun dari nol, Anda harus membuat fondasi, dinding, atap, instalasi listrik, dll. Laravel adalah seperti **rumah setengah jadi** yang sudah punya fondasi, sistem listrik, dan pipa air — Anda tinggal mendekorasi dan menambahkan ruangan sesuai kebutuhan.

**Website ini memiliki dua sisi:**
- 🌐 **Halaman Publik** — Yang bisa dilihat siapa saja. Berisi informasi masjid, daftar kegiatan, dan cara donasi.
- 🔒 **Panel Admin** — Hanya bisa diakses pengurus yang punya akun. Untuk mengelola event, mencatat donasi, dan upload laporan keuangan.

---

## 🛠️ Teknologi yang Digunakan

| Teknologi | Fungsi | Analogi Sederhana |
|-----------|--------|-------------------|
| **PHP** | Bahasa pemrograman utama | Bahasa yang dipakai untuk "berpikir" |
| **Laravel 12** | Framework PHP | Kerangka/template awal yang mempercepat pembuatan web |
| **SQLite** | Database (penyimpanan data) | Buku besar digital tempat semua data disimpan |
| **Blade** | Template engine (tampilan) | Cara menulis halaman web dengan komponen yang bisa dipakai ulang |
| **Vite** | Bundler aset (CSS/JS) | Alat yang memadatkan file CSS dan JavaScript agar lebih cepat |
| **AlwaysData** | Hosting (server online) | Rumah di internet tempat website berjalan 24 jam |

---

## 📂 Struktur Folder — Penjelasan Lengkap

```
masjid-app/
│
├── 📁 app/                    ← Otak website (logika bisnis)
│   ├── 📁 Http/
│   │   └── 📁 Controllers/    ← Pengontrol: menerima permintaan & mengirim respon
│   │       ├── AdminController.php      → Mengatur halaman dashboard admin
│   │       ├── EventController.php      → Mengatur CRUD (tambah/edit/hapus) event
│   │       ├── DonationController.php   → Mengatur pencatatan donasi
│   │       ├── KeuanganController.php   → Mengatur laporan keuangan
│   │       └── ProfileController.php    → Mengatur profil pengguna
│   └── 📁 Models/             ← Perwakilan data di database
│       ├── User.php            → Data pengguna/admin
│       ├── Event.php           → Data kegiatan/event
│       ├── Donation.php        → Data donasi
│       └── Keuangan.php        → Data laporan keuangan
│
├── 📁 database/               ← Semua yang berhubungan dengan database
│   ├── 📁 migrations/         ← "Resep" pembuatan tabel database
│   ├── 📁 seeders/            ← Data awal (termasuk akun admin pertama)
│   └── database.sqlite        ← File database SQLite (buku besarnya)
│
├── 📁 resources/              ← Tampilan (yang dilihat pengunjung)
│   ├── 📁 views/              ← File HTML/Blade (halaman-halaman website)
│   │   ├── welcome.blade.php           → Halaman utama (landing page)
│   │   ├── 📁 admin/                  → Halaman-halaman panel admin
│   │   │   ├── dashboard.blade.php    → Ringkasan statistik
│   │   │   ├── 📁 events/             → Kelola event (daftar/tambah/edit)
│   │   │   ├── 📁 donations/          → Kelola donasi
│   │   │   └── 📁 keuangan/           → Laporan keuangan
│   │   └── 📁 layouts/               → Template dasar (header/sidebar)
│   │       └── admin.blade.php        → Layout panel admin (sidebar + topbar)
│   └── 📁 css/ & 📁 js/       ← File CSS dan JavaScript
│
├── 📁 routes/                 ← Peta jalan website (URL apa menuju ke mana)
│   ├── web.php                → Semua URL dan controller yang menanganinya
│   └── auth.php               → URL untuk login/register/logout
│
├── 📁 public/                 ← File yang bisa diakses langsung dari internet
│   ├── index.php              → Pintu masuk utama semua request
│   └── 📁 storage/            → Gambar yang di-upload (event, dll)
│
├── 📁 config/                 ← Pengaturan-pengaturan Laravel
├── 📁 storage/                ← File sementara, logs, cache
├── .env                       ← Konfigurasi rahasia (password DB, nama app, dll)
├── composer.json              ← Daftar library PHP yang dipakai
└── package.json               ← Daftar library JavaScript yang dipakai
```

---

## 🔄 Cara Kerja Website (Alur Kode)

### Analogi Sederhana
Bayangkan website seperti **restoran**:
- **Pengunjung** = Tamu restoran yang memesan makanan
- **Routes (web.php)** = Menu restoran (daftar pilihan yang tersedia)
- **Controller** = Pelayan yang menerima pesanan dan meneruskan ke dapur
- **Model** = Dapur yang mengolah data dari gudang (database)
- **View (Blade)** = Piring berisi makanan yang disajikan ke tamu

### Alur Detail — Contoh: Membuka Halaman Event

```
Pengunjung mengetik URL:
https://website-masjid.com/admin/events
           │
           ▼
┌─────────────────────────────────┐
│  routes/web.php                 │  ← "Apakah URL ini terdaftar?"
│  Route::get('events', ...)      │  ← Ya! Kirim ke EventController
└─────────────────────────────────┘
           │
           ▼
┌─────────────────────────────────┐
│  EventController@index()        │  ← Controller menerima permintaan
│  $events = Event::latest()->get() │  ← Minta data ke Model
└─────────────────────────────────┘
           │
           ▼
┌─────────────────────────────────┐
│  Model: Event.php               │  ← Model pergi ke database
│  SELECT * FROM events           │  ← Ambil semua data event
│  ORDER BY created_at DESC       │
└─────────────────────────────────┘
           │
           ▼
┌─────────────────────────────────┐
│  admin/events/index.blade.php   │  ← View merender data menjadi HTML
│  @foreach($events as $event)    │  ← Tampilkan setiap event sebagai kartu
│      <div class="event-card">   │
└─────────────────────────────────┘
           │
           ▼
     🖥️ Halaman tampil di browser pengunjung
```

### Alur Tambah Event Baru

```
Admin isi form → Klik "Simpan" → POST /admin/events
    │
    ▼
EventController@store()
    │
    ├─► Validasi data (judul wajib diisi, gambar maks 2MB, dll)
    │       ├─ Gagal? → Kembali ke form dengan pesan error
    │       └─ Berhasil? → Lanjut
    │
    ├─► Jika ada gambar: simpan ke storage/app/public/events/
    │
    ├─► Event::create($data) → Tulis ke database
    │
    └─► Redirect ke halaman daftar event + pesan "Berhasil!"
```

---

## 🗄️ Struktur Database

Website ini menggunakan **4 tabel utama** di database:

### Tabel `users` — Data Admin
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | integer | Nomor unik otomatis |
| name | string | Nama pengguna (contoh: "admin") |
| email | string | Alamat email untuk login |
| password | string | Password yang sudah dienkripsi (tidak tersimpan polos) |
| created_at | datetime | Kapan akun dibuat |

### Tabel `events` — Data Kegiatan
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | integer | Nomor unik otomatis |
| judul | string | Nama kegiatan (contoh: "Pengajian Malam Jumat") |
| deskripsi | text | Penjelasan detail kegiatan |
| tanggal | date | Tanggal pelaksanaan |
| lokasi | string | Tempat kegiatan (opsional) |
| gambar | string | Path/lokasi file gambar (opsional) |
| created_at | datetime | Kapan event dibuat |

### Tabel `donations` — Data Donasi
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | integer | Nomor unik otomatis |
| nama_donatur | string | Nama orang yang berdonasi |
| nominal | integer | Jumlah donasi dalam rupiah |
| metode | string | Cara donasi (Transfer BCA, BNI, dll) |
| keterangan | text | Catatan tambahan (opsional) |
| tanggal | date | Tanggal donasi diterima |

### Tabel `keuangan` — Laporan Keuangan
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | integer | Nomor unik otomatis |
| judul | string | Judul laporan |
| deskripsi | text | Keterangan laporan |
| file_path | string | Lokasi file PDF/dokumen |
| file_name | string | Nama file asli |
| periode | string | Periode laporan (contoh: "Maret 2026") |

---

## ✨ Fitur-Fitur Website

### 🌐 Halaman Publik (`/`)
- **Hero section** — Tampilan utama dengan nama masjid dan latar yang indah
- **Tentang Masjid** — Sejarah dan informasi singkat
- **Jadwal Sholat** — Waktu sholat (statis, bisa disesuaikan)
- **Daftar Event** — Kegiatan mendatang yang diambil dari database secara otomatis
- **Info Donasi** — Nomor rekening untuk donasi
- **Kontak** — Informasi kontak masjid

### 🔒 Panel Admin (`/admin`)
Hanya bisa diakses setelah login.

| Menu | Fungsi |
|------|--------|
| **Dashboard** | Ringkasan: jumlah event, total donasi, laporan keuangan |
| **Kelola Event** | Tambah, edit, hapus kegiatan yang tampil di website |
| **Data Donasi** | Catat donasi yang masuk + lihat total |
| **Laporan Keuangan** | Upload dan kelola file laporan keuangan |
| **Profil** | Ubah nama dan password admin |

---

## 💻 Cara Install di Komputer Sendiri (Dari Nol)

> 🎯 Panduan ini ditulis untuk pemula yang belum pernah membuat program. Ikuti setiap langkah dengan teliti!

### Prasyarat — Yang Harus Sudah Terinstall

Sebelum mulai, pastikan komputer sudah punya:

1. **PHP 8.2+** — Bahasa pemrograman utama
   - Download di: https://www.php.net/downloads
   - Cek sudah terinstall: buka Command Prompt, ketik `php -v`

2. **Composer** — Manajer paket/library untuk PHP
   - Download di: https://getcomposer.org/download/
   - Cek sudah terinstall: ketik `composer -V`

3. **Node.js** — Untuk menjalankan alat pemrosesan CSS/JS
   - Download di: https://nodejs.org (pilih versi LTS)
   - Cek sudah terinstall: ketik `node -v`

4. **Git** — Untuk mengunduh kode dari GitHub
   - Download di: https://git-scm.com/downloads
   - Cek sudah terinstall: ketik `git --version`

---

### Langkah 1 — Unduh Kode dari GitHub

Buka Command Prompt (Windows) atau Terminal (Mac/Linux), lalu ketik:

```bash
git clone https://github.com/USERNAME/masjid-app.git
cd masjid-app
```

> **Catatan:** Ganti `USERNAME` dengan username GitHub pemilik repository.

---

### Langkah 2 — Install Library PHP

```bash
composer install
```

Perintah ini akan mengunduh semua library PHP yang dibutuhkan (bisa 1-5 menit tergantung kecepatan internet).

---

### Langkah 3 — Buat File Konfigurasi

```bash
cp .env.example .env
```

Perintah ini menyalin file `.env.example` menjadi `.env`. File `.env` adalah tempat konfigurasi rahasia (seperti nama database, URL, dll).

---

### Langkah 4 — Generate Kunci Aplikasi

```bash
php artisan key:generate
```

Perintah ini membuat kode unik untuk mengenkripsi data sensitif seperti session dan cookie.

---

### Langkah 5 — Buat Database dan Tabel

```bash
php artisan migrate
```

Perintah ini menjalankan semua "resep" (migration) untuk membuat tabel-tabel di database. File database SQLite akan otomatis dibuat di `database/database.sqlite`.

---

### Langkah 6 — Buat Akun Admin Pertama

```bash
php artisan db:seed
```

Perintah ini menjalankan Seeder — sebuah skrip yang otomatis membuat akun admin pertama dengan kredensial default.

---

### Langkah 7 — Install Library JavaScript

```bash
npm install
```

Perintah ini mengunduh semua library JavaScript yang dibutuhkan (untuk CSS dan animasi).

---

### Langkah 8 — Build Aset CSS & JavaScript

```bash
npm run build
```

Perintah ini memproses dan memadatkan file CSS dan JavaScript agar siap dipakai.

---

### Langkah 9 — Buat Link ke Folder Gambar

```bash
php artisan storage:link
```

Perintah ini membuat "shortcut" agar gambar yang di-upload bisa diakses dari browser.

---

### Langkah 10 — Jalankan Website!

```bash
php artisan serve
```

Website sekarang berjalan! Buka browser dan kunjungi: **http://localhost:8000**

---

### Ringkasan Semua Perintah (Copy-Paste Sekaligus)

```bash
git clone https://github.com/USERNAME/masjid-app.git
cd masjid-app
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
npm install
npm run build
php artisan storage:link
php artisan serve
```

---

## 🌐 Cara Deploy ke AlwaysData

AlwaysData adalah layanan hosting (server online) tempat website berjalan 24/7.

### Langkah 1 — Persiapkan Kode

Di komputer lokal, pastikan semua perubahan sudah di-commit ke Git:

```bash
git add .
git commit -m "Pesan perubahan yang Anda buat"
git push origin main
```

> **Apa itu commit?** Bayangkan seperti menyimpan dokumen Word. Setiap `commit` adalah satu versi simpanan.

---

### Langkah 2 — Login ke Panel AlwaysData

1. Buka https://admin.alwaysdata.com
2. Login dengan akun Anda

---

### Langkah 3 — Buka Terminal SSH (Web Terminal)

1. Di menu kiri, cari **SSH**
2. Klik **Web terminal** di samping username SSH Anda
3. Layar terminal hitam akan terbuka

---

### Langkah 4 — Masuk ke Folder Project

```bash
cd www
ls
```

Pastikan Anda melihat file-file Laravel seperti `artisan`, `app`, `composer.json`.

---

### Langkah 5 — Pull Perubahan Terbaru dari GitHub

```bash
git pull origin main
```

Perintah ini mengunduh semua perubahan terbaru dari GitHub ke server.

---

### Langkah 6 — Install/Update Library

```bash
composer install --no-dev --optimize-autoloader
```

---

### Langkah 7 — Jalankan Migrasi Database

```bash
php artisan migrate --force
```

---

### Langkah 8 — Jalankan Seeder (Jika Akun Admin Belum Ada)

```bash
php artisan db:seed
```

---

### Langkah 9 — Bersihkan Cache

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

---

### Langkah 10 — Buat Link Storage

```bash
php artisan storage:link
```

Website Anda sekarang online dan dapat diakses!

---

## 🔑 Akun Admin Default

Setelah menjalankan `php artisan db:seed`, akun admin dibuat dengan kredensial berikut:

| Field | Nilai |
|-------|-------|
| **Nama** | admin |
| **Email** | admin@masjidsitihajaralmadinah.com |
| **Password** | tugasmasjid2026 |
| **URL Login** | `/login` |

> ⚠️ **Penting:** Segera ganti password setelah pertama kali login di lingkungan produksi!

---

## ❓ Pertanyaan Umum (FAQ)

**Q: Saya dapat error "Class not found" setelah clone. Kenapa?**
> A: Jalankan `composer install` terlebih dahulu. Error ini terjadi karena library PHP belum terinstall.

**Q: Halaman muncul tapi gambar tidak tampil.**
> A: Jalankan `php artisan storage:link` untuk membuat link ke folder penyimpanan gambar.

**Q: Saya lupa password admin, bagaimana cara reset?**
> A: Jalankan `php artisan db:seed` untuk membuat ulang akun dengan password default, atau buka `database/seeders/DatabaseSeeder.php` dan ubah password sebelum menjalankan seeder.

**Q: Apa bedanya `npm run dev` dan `npm run build`?**
> A: `dev` untuk pengembangan (lebih cepat, tidak dioptimasi). `build` untuk produksi (dioptimasi, lebih lambat tapi hasil lebih ringan). Gunakan `build` saat deploy ke server.

**Q: Kenapa ada file `.env` dan `.env.example`?**
> A: `.env.example` adalah contoh template yang boleh dikShare ke publik (tidak berisi data rahasia). `.env` berisi konfigurasi asli yang **tidak boleh** di-upload ke GitHub (sudah ada di `.gitignore`).

---

## 📞 Kontak

Masjid Raya Siti Hajar Al-Madinah

- 📧 Email: info@masjidsitihajaralmadinah.com

---

<p align="center">
  Dibuat dengan ❤️ untuk kemakmuran Masjid Raya Siti Hajar Al-Madinah
</p>
