# Website UNS — Unggul Nusantara Sport

Platform manajemen kejuaraan olahraga berbasis web milik **Unggul Nusantara Sport** — organisasi penyelenggara kejuaraan pencak silat dan olahraga bela diri di Indonesia. Sistem ini menangani seluruh alur kompetisi secara digital: dari pembuatan event kejuaraan, pendaftaran kontingen dan atlet, unggah berkas persyaratan, hingga verifikasi dan konfirmasi pembayaran.

Dibangun dengan Laravel 11, Livewire 3, dan Tailwind CSS.

> **Live:** [https://unggulnusantarasport.com](https://unggulnusantarasport.com) — domain resmi yang digunakan untuk production saat ini.

---

## Daftar Isi

- [Fitur Utama](#fitur-utama)
- [Role & Hak Akses](#role--hak-akses)
- [Tech Stack](#tech-stack)
- [Struktur Database](#struktur-database)
- [Instalasi](#instalasi)

---

## Fitur Utama

### Manajemen Kejuaraan
Superadmin dan admin dapat membuat, mengedit, dan mengelola kejuaraan olahraga. Setiap kejuaraan memiliki:
- Informasi dasar (nama, penyelenggara, deskripsi, poster, logo)
- Periode pendaftaran (tanggal buka & tutup)
- Detail teknis (TM lokasi/waktu, pelaksanaan lokasi/waktu)
- Persyaratan data atlet (NIK, NISN, asal sekolah, asal perguruan)
- Kategori pertandingan (diambil dari referensi golongan & regulasi)
- Kontak panitia (hingga 3 contact person)
- Berkas lampiran (file persyaratan)
- Unduhan (file yang bisa di-download peserta)
- Link grup WA dan link kejuaraan
- Data tambahan (custom JSON field)

### Pendaftaran Kontingen & Atlet
Manajer dapat:
- Mendaftarkan kontingen ke kejuaraan yang sedang dibuka
- Menambahkan atlet per kontingen, memilih kategori pertandingan
- Mengunggah berkas kontingen dan atlet
- Melakukan konfirmasi pembayaran (upload bukti + catatan)

### Verifikasi Multi-Tahap
Admin dan superadmin melakukan verifikasi 3 tahap per kontingen:
1. **Verifikasi Kontingen** — cek data dan berkas kontingen
2. **Verifikasi Atlet** — cek data dan berkas per atlet
3. **Verifikasi Pembayaran** — cek bukti bayar, validasi, update status

Setiap tahap memiliki status: `pending`, `terima`, `tolak`.

### Manajemen Kategori Referensi
Superadmin mengelola referensi kategori pertandingan yang terdiri dari:
- **Golongan** (misal: Tanding, Seni, Regu)
- **Regulasi** (misal: Dewasa, Remaja, Anak-anak)
- **Kategori** (kombinasi golongan + regulasi + bobot)

### Google OAuth
Login menggunakan akun Google. User yang login via Google otomatis mendapat role `manajer`.

---

## Role & Hak Akses

| Role | Hak Akses |
|------|-----------|
| **Superadmin** | Full akses: CRUD kejuaraan, manajemen akun user, manajemen referensi kategori, verifikasi kontingen & atlet & pembayaran |
| **Admin** | CRUD kejuaraan, verifikasi kontingen & atlet & pembayaran (tidak bisa manajemen akun & ref kategori) |
| **Manajer** | Mendaftarkan kontingen ke kejuaraan, menambah atlet, upload berkas, konfirmasi pembayaran, lihat dashboard sendiri |
| **Guest** | Melihat landing page daftar kejuaraan dan halaman detail kejuaraan |

---

## Tech Stack

| Layer | Teknologi |
|-------|-----------|
| **Framework** | Laravel 11 |
| **PHP** | ^8.2 |
| **Frontend** | Blade + Livewire 3 + Tailwind CSS + Vite |
| **Auth** | Laravel Jetstream 5.3 (Livewire stack) + Sanctum + Socialite (Google OAuth) |
| **Permission** | spatie/laravel-permission 6.21 |
| **Excel** | maatwebsite/excel 3.1 |
| **Storage** | Flysystem AWS S3 |
| **Database** | MySQL / SQLite |

---

## Struktur Database

### Tabel Utama

| Tabel | Deskripsi |
|-------|-----------|
| `users` | Pengguna sistem, support 2FA, Google OAuth, profile photo |
| `kejuaraans` | Data kejuaraan (nama, deskripsi, periode, kontak, poster, logo, dll) |
| `kontingens` | Kontingen yang didaftarkan manajer ke kejuaraan |
| `atlets` | Atlet yang didaftarkan dalam kontingen |
| `manajers` | Data manajer (opsional) |
| `kejuaraan_kategoris` | Pivot: kategori yang dibuka dalam kejuaraan |
| `kejuaraan_berkas` | Berkas lampiran persyaratan kejuaraan |
| `kejuaraan_unduhans` | File unduhan untuk peserta kejuaraan |
| `kontingen_berkas` | Berkas yang diupload kontingen |
| `atlet_berkas` | Berkas yang diupload per atlet |
| `user_kejuaraans` | Pivot: user yang terhubung ke kejuaraan |

### Tabel Referensi

| Tabel | Deskripsi |
|-------|-----------|
| `ref_golongans` | Referensi golongan (Tanding, Seni, dll) |
| `ref_regulasis` | Referensi regulasi (Dewasa, Remaja, dll) |
| `ref_kategoris` | Referensi kategori lengkap (golongan + regulasi + bobot) |
| `ref_statuses` | Referensi status (pending/terima/tolak) |

### Diagram Relasi

```
users ──┬── kontingens ──┬── atlets ── ref_kategoris ──┬── ref_golongans
        │                │                              └── ref_regulasis
        │                └── ref_statuses (status, status_pembayaran)
        │
        └── user_kejuaraans ── kejuaraans ──┬── kejuaraan_kategoris ── ref_kategoris
                                             ├── kejuaraan_berkas
                                             ├── kejuaraan_unduhans
                                             └── kontingens
```

---

## Instalasi

```bash
# Clone
git clone git@github.com:unsscoring/website-uns.git
cd website-uns

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Konfigurasi .env (sesuaikan database, Google OAuth, dll)
# DB_CONNECTION=mysql
# DB_DATABASE=website_uns
# GOOGLE_CLIENT_ID=
# GOOGLE_CLIENT_SECRET=
# GOOGLE_REDIRECT_URI=

# Migration & seeding
php artisan migrate
php artisan db:seed

# Build frontend
npm run build

# Jalankan server
php artisan serve
```

---

## Lisensi

Proyek ini adalah sistem internal **Unggul Nusantara Sport**.
