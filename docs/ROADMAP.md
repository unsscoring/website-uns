# Roadmap Improvement — Website UNS

> **Status:** Live di [unggulnusantarasport.com](https://unggulnusantarasport.com)  
> **Tanggal Audit:** 19 Mei 2026

---

## Daftar Isi
- [Fase 1: Security & Critical Fixes (HIGH)](#fase-1-security--critical-fixes-high)
- [Fase 2: Bug Fixes (HIGH)](#fase-2-bug-fixes-high)
- [Fase 3: Code Quality (HIGH)](#fase-3-code-quality-high)
- [Fase 4: Performance (HIGH)](#fase-4-performance-high)
- [Fase 5: Deployment Readiness (HIGH)](#fase-5-deployment-readiness-high)
- [Fase 6: Fitur Baru (MEDIUM)](#fase-6-fitur-baru-medium)
- [Fase 7: UX & Polish (MEDIUM-LOW)](#fase-7-ux--polish-medium-low)

---

## Fase 1: Security & Critical Fixes (HIGH)

### 1.1 — Blokir akses file sensitif via `.htaccess`
**File:** `.htaccess`  
**Masalah:** `.env`, `.git/`, `composer.json`, `composer.lock`, `storage/logs/`, `.sqlite` bisa diakses publik.  
**Solusi:** Tambahkan `RewriteRule` untuk menolak akses file sensitif.

### 1.2 — Hardcoded default password di OAuth
**File:** `app/Http/Controllers/OauthController.php:52`  
**Masalah:** Semua user Google OAuth dapat password default `encrypt('admin@123')`.  
**Solusi:** Generate random password per user via `Str::random(32)`.

### 1.3 — Tambahkan authorization check di semua verifikasi
**Files:**
- `app/Livewire/Superadmin/SuperadminVerifikasi/*.php`
- `app/Livewire/Admin/AdminVerifikasi/*.php`
- `app/Livewire/Manajer/ManajerKejuaraan/*.php`

**Masalah:** Tidak ada pengecekan ownership — user bisa akses kontingen/atlet milik user lain jika tahu ID-nya.  
**Solusi:** Tambahkan `authorize()` method atau Policy/Gate di setiap komponen.

### 1.4 — Aktifkan password reset
**File:** `config/fortify.php:148`  
**Masalah:** `Features::resetPasswords()` dicomment, user tidak bisa reset password.  
**Solusi:** Uncomment dan konfigurasi mail.

### 1.5 — Aktifkan email verification
**File:** `config/fortify.php:149`  
**Masalah:** `Features::emailVerification()` dicomment.  
**Solusi:** Uncomment, implement `MustVerifyEmail` di User model.

### 1.6 — Tambahkan rate limiting + CAPTCHA
**Masalah:** Tidak ada rate limiting di login/register, tidak ada reCAPTCHA.  
**Solusi:** Pasang `Laravel Fortify rate limiter`, tambahkan Google reCAPTCHA v3 di form register/login.

### 1.7 — Set expiry token Sanctum
**File:** `config/sanctum.php:50`  
**Masalah:** API token never expires (`'expiration' => null`).  
**Solusi:** Set ke `60 * 24` (24 jam) atau sesuai kebutuhan.

---

## Fase 2: Bug Fixes (HIGH)

### 2.1 — GuestController crash untuk user tidak login
**File:** `app/Http/Controllers/GuestController.php:10`  
**Masalah:** `auth()->user()->hasRole()` dipanggil tanpa cek `auth()->check()`, fatal error untuk guest.  
**Solusi:** Tambahkan `if (!auth()->check()) { return redirect()->route('login'); }` di awal method.

### 2.2 — Dead code di catch block update informasi kejuaraan
**Files:**
- `app/Livewire/Admin/AdminKejuaraanUpdate/AdminKejuaraanUpdateInformasi.php:121-177`
- `app/Livewire/Superadmin/SuperadminKejuaraanUpdate/SuperadminKejuaraanUpdateInformasi.php:121-178`

**Masalah:** Catch block panggil `$this->validate()` yang akan selalu throw, `$this->kejuaraan->update()` di bawahnya **tidak pernah jalan**.  
**Solusi:** Hapus `$this->validate()` dari catch block. Validasi sudah jalan di method `updateInformasi()`.

### 2.3 — `$buktiPath` undefined + double update di pembayaran
**File:** `app/Livewire/Manajer/ManajerKejuaraan/ManajerKejuaraanPembayaran.php:117-139`  
**Masalah:** `$buktiPath` didefinisikan dalam `if`, dipakai di luar. Update dipanggil 2x.  
**Solusi:** Definisikan `$buktiPath` di luar `if` dengan default `null`. Hapus update ganda.

### 2.4 — Validation rule unique salah (spasi ekstra)
**Files:**
- `app/Livewire/Admin/AdminKejuaraanUpdate/AdminKejuaraanUpdateInformasi.php:70,98`
- `app/Livewire/Superadmin/SuperadminKejuaraanUpdate/SuperadminKejuaraanUpdateInformasi.php:70,98`

**Masalah:** Rule `'unique:kejuaraans, $slug,'` punya spasi ekstra.  
**Solusi:** Ubah jadi `'unique:kejuaraans,slug,' . $this->kejuaraan->id`.

### 2.5 — Nama field mismatch: `link_pendaftaran` vs `link_kejuaraan`
**Files:**
- `app/Livewire/Admin/AdminKejuaraanCreate.php:36`
- `app/Livewire/Superadmin/SuperadminKejuaraanCreate.php:36`

**Masalah:** Validasi pakai `link_pendaftaran` tapi binding pakai `link_kejuaraan`.  
**Solusi:** Samakan jadi `link_kejuaraan`.

### 2.6 — `nama_kategori` tidak ada di model KejuaraanKategori
**Files:**
- `app/Livewire/Admin/AdminKejuaraanUpdate/AdminKejuaraanUpdateKategori.php:218`
- `app/Livewire/Superadmin/SuperadminKejuaraanUpdate/SuperadminKejuaraanUpdateKategori.php:219`

**Masalah:** Akses `$kategori->nama_kategori`, harusnya `$kategori->refKategori->nama_kategori`.  
**Solusi:** Ganti akses properti via relasi.

### 2.7 — `Kontingen::$nama` vs `$nama_kontingen`
**File:** `SuperadminVerifikasiKejuaraan.php:54,63`  
**Masalah:** Akses `$kontingen->nama`, field sebenarnya `nama_kontingen`.  
**Solusi:** Ganti ke `$kontingen->nama_kontingen`.

### 2.8 — Delete button di admin kejuaraan tidak berfungsi
**File:** `resources/views/livewire/admin/admin-kejuaraan.blade.php:161`  
**Masalah:** Panggil `confirmDeleteAkun()` padahal itu method milik `SuperadminManajemenAkun`, bukan `AdminKejuaraan`.  
**Solusi:** Ganti jadi `confirmDeleteKejuaraan` + tambahkan method delete di `AdminKejuaraan`.

### 2.9 — Race condition `no_pendaftaran`
**Files:**
- `AdminVerifikasiAtlet.php:117`
- `SuperadminVerifikasiAtlet.php:117`
- `ManajerKejuaraanAtlet.php:121`

**Masalah:** `Atlet::count() + 1` rawan duplikasi concurrent request.  
**Solusi:** Pakai database sequence/auto-increment, atau lock table.

---

## Fase 3: Code Quality (HIGH)

### 3.1 — Refactor duplikasi Admin/Superadmin
**Masalah:** 12+ komponen di `app/Livewire/Admin/` dan `app/Livewire/Superadmin/` punya logika identik (beda namespace saja).  
**Solusi:** Buat base class (abstract) atau trait bersama, lalu Admin dan Superadmin extend komponen tersebut.

### 3.2 — Hapus komponen kosong yang tidak terpakai
**Files:**
- `Guest/GuestKejuaraanController.php`
- `Guest/TentangKamiController.php`
- `AdminKejuaraanUpdateContact.php`
- `SuperadminKejuaraanUpdateContact.php`
- `resources/views/livewire/guest/guest-kejuaraan-controller.blade.php`
- `resources/views/welcome.blade.php`

**Masalah:** Komponen-komponen ini tidak punya logika apa pun.  
**Solusi:** Hapus jika tidak dibutuhkan, atau implementasikan.

### 3.3 — Hapus duplikat `Schema::defaultStringLength` di AppServiceProvider
**File:** `app/Providers/AppServiceProvider.php:23-27`  
**Solusi:** Hapus baris duplikat.

### 3.4 — Hapus dependency conflict: `@tailwindcss/vite` v4 + Tailwind CSS v3
**File:** `package.json`  
**Masalah:** `@tailwindcss/vite ^4.1.12` tidak kompatibel dengan `tailwindcss ^3.4.17`.  
**Solusi:** Hapus `@tailwindcss/vite` dari dependencies, atau upgrade Tailwind ke v4.

---

## Fase 4: Performance (HIGH)

### 4.1 — Tambahkan pagination
**Files:**
- `AdminKejuaraan.php` — `Kejuaraan::latest()->get()`
- `SuperadminKejuaraan.php` — `Kejuaraan::latest()->get()`
- `AdminVerifikasi.php` — `Kejuaraan::where('open_pendaftaran', true)->get()`
- `AdminVerifikasiKejuaraan.php` — `Kontingen::where(...)->get()`

**Solusi:** Ganti `.get()` dengan `.paginate(10)`.

### 4.2 — Cache referensi statis
**Files:** Semua komponen yang panggil `RefGolongan::get()`, `RefRegulasi::get()`, `RefStatus::get()` berulang kali.  
**Solusi:** Cache dengan `Cache::rememberForever()` atau load sekali di mount lalu simpan di property.

### 4.3 — Optimasi S3 temporaryUrl di landing page
**File:** `resources/views/livewire/guest/home-controller.blade.php`  
**Masalah:** Setiap poster gambar menghasilkan 1 API call ke S3. 10 kejuaraan = 10 API call setiap page load.  
**Solusi:** Generate pre-signed URL sekali lalu cache. Atau gunakan CDN.

### 4.4 — Eager loading relasi
**Masalah:** Banyak N+1 query — `$kontingen->atlets`, `$kategori->refKategori`, dll dipanggil berulang.  
**Solusi:** Gunakan `with(['atlets', 'kejuaraan', ...])` di query.

---

## Fase 5: Deployment Readiness (HIGH)

### 5.1 — Fix Fortify `'home'` config
**File:** `config/fortify.php:76`  
**Masalah:** `'home' => '/dashboard'` tapi `/dashboard` bergantung pada role user (GuestController rusak).  
**Solusi:** Buat middleware redirect based-on-role, atau ganti `'home'` ke `/`.

### 5.2 — Hapus Jetstream Teams yang tidak terpakai
**Files:**
- `resources/views/navigation-menu.blade.php` (Teams UI)
- `resources/views/components/switchable-team.blade.php`

**Masalah:** Komponen Teams dirender tapi tidak ada Team model/relation, fatal error jika diklik.  
**Solusi:** Hapus atau comment out bagian Teams dari navigation-menu.

### 5.3 — Fix asset path backslash
**Files:**
- `resources/views/layouts/guest.blade.php:22`
- `resources/views/components/layouts/guest.blade.php:17`

**Masalah:** Path pakai `\` (backslash), tidak valid di Linux.  
**Solusi:** Ganti ke `/` (forward slash).

### 5.4 — Fix bundle.js sebagai CSS
**File:** `resources/views/layouts/admin.blade.php:521`  
**Masalah:** `<script src="...bundle.css">` — file CSS diload sebagai JavaScript.  
**Solusi:** Ganti jadi `bundle.js`.

### 5.5 — Hapus rule Installatron dari `.htaccess`
**File:** `.htaccess:9-10`  
**Masalah:** Rule `deleteme\.\w+\.php` — leftover instalasi.  
**Solusi:** Hapus.

### 5.6 — Fix sidebar link yang salah
**File:** `resources/views/layouts/admin.blade.php:235-272`  
**Masalah:** Link superadmin mengarah ke `/manajer/atlet`, `/manajer/pembayaran`.  
**Solusi:** Ganti ke route superadmin yang benar.

---

## Fase 6: Fitur Baru (MEDIUM)

### 6.1 — Activity/Audit Log
Semua perubahan status (verifikasi kontingen, atlet, pembayaran) harus tercatat:
- Siapa yang mengubah
- Status sebelum → sesudah
- Timestamp
- Catatan

**Implementasi:** Pakai package `spatie/laravel-activitylog`.

### 6.2 — Notifikasi Email
User manajer harus dapat notifikasi saat:
- Kontingen diterima/ditolak
- Atlet diterima/ditolak
- Pembayaran diverifikasi/ditolak

**Implementasi:** Laravel Notifications + Mail.

### 6.3 — Soft Deletes
Semua model utama (Kejuaraan, Kontingen, Atlet) harus pakai soft delete agar data tidak hilang permanen jika tidak sengaja terhapus.  
**Implementasi:** Tambah trait `SoftDeletes` + kolom `deleted_at`.

### 6.4 — Search & Filter di list kejuaraan
Admin/superadmin list kejuaraan saat ini tidak punya search. SuperadminManajemenAkun sudah punya — tiru polanya.  
**Implementasi:** Tambah input search di admin/superadmin kejuaraan.

### 6.5 — Export Excel untuk semua role
AdminKejuaraan dan SuperadminKejuaraan saat ini tidak punya export. Export hanya ada di verifikasi kejuaraan.  
**Implementasi:** Tambahkan tombol export di halaman list kejuaraan.

### 6.6 — Preview gambar sebelum upload
Upload poster/logo kejuaraan, bukti pembayaran tidak ada preview thumbnail.  
**Implementasi:** Gunakan Livewire `wire:model` temporary URL + JavaScript FileReader.

### 6.7 — Password complexity rules
**File:** `app/Actions/Fortify/PasswordValidationRules.php` (atau default rules)  
**Masalah:** Hanya `min:8`. Tidak ada mixed case, digit, atau special character.  
**Implementasi:** Tambahkan `mixedCase`, `numbers`, `symbols`, dan `uncompromised`.

### 6.8 — Pendaftaran date window enforcement
**Masalah:** Kolom `pendaftaran_awal` dan `pendaftaran_akhir` di tabel `kejuaraans` tidak pernah divalidasi saat manajer daftar.  
**Implementasi:** Cek `now()` against `pendaftaran_awal` / `pendaftaran_akhir` sebelum izinkan pendaftaran kontingen.

### 6.9 — Loading indicator / spinner
**Masalah:** Submit form tidak ada indikator loading.  
**Implementasi:** Gunakan Livewire `wire:loading` + spinner component.

### 6.10 — Multi-level kategori dinamis
Kategori saat ini flat. Untuk kompetisi besar, perlu struktur: Provinsi → Kota → Kontingen → Atlet. Atau filter kategori berdasarkan golongan/regulasi yang dipilih secara cascading.

---

## Fase 7: UX & Polish (MEDIUM-LOW)

### 7.1 — Inline validation errors (bukan SweetAlert)
**Masalah:** Semua error validasi muncul sebagai SweetAlert modal — user harus dismiss untuk lihat pesan error. Tidak ada inline error di bawah field.  
**Implementasi:** Gunakan `@error('field')` blade directive, kurangi SweetAlert hanya untuk success/error operasi.

### 7.2 — S3 URL expire handling
**Masalah:** Pre-signed URL S3 expired 5 menit — gambar hilang saat halaman dibuka lama.  
**Implementasi:** Regenerate URL via AJAX atau ganti ke proxy internal.

### 7.3 — Clear form setelah submit sukses
**Masalah:** Field form pembayaran tidak clear setelah submit sukses.  
**Implementasi:** Reset property Livewire di method submit.

### 7.4 — Konsistensi indentasi Blade views
Blade template campur 2-space dan 4-space indent.  
**Implementasi:** Jalankan `laravel/pint` pada semua blade file.

### 7.5 — Tambahkan konfirmasi dialog di semua delete
**Masalah:** Tidak semua tombol delete punya SweetAlert konfirmasi.  
**Implementasi:** Standarisasi pola `confirmDelete` di semua komponen.

### 7.6 — CDN integrity hash
**File:** `resources/views/layouts/admin.blade.php`  
**Masalah:** SweetAlert2 CDN tanpa atribut `integrity`.  
**Implementasi:** Tambahkan `integrity="sha384-..."` + `crossorigin="anonymous"`.

---

## Ringkasan Statistik

| Fase | HIGH | MEDIUM | LOW | TOTAL |
|------|------|--------|-----|-------|
| Fase 1 - Security | 7 | — | — | 7 |
| Fase 2 - Bug Fixes | 9 | — | — | 9 |
| Fase 3 - Code Quality | 4 | — | — | 4 |
| Fase 4 - Performance | 4 | — | — | 4 |
| Fase 5 - Deployment | 6 | — | — | 6 |
| Fase 6 - Fitur Baru | — | 10 | — | 10 |
| Fase 7 - UX Polish | — | 2 | 4 | 6 |
| **TOTAL** | **30** | **12** | **4** | **46** |

---

## Rekomendasi Urutan Pengerjaan

```
Fase 1 → Fase 2 → Fase 5 → Fase 4 → Fase 3 → Fase 6 → Fase 7
```

Prioritaskan **Fase 1 (Security)** dan **Fase 2 (Bug Fixes)** terlebih dahulu karena berdampak langsung pada data dan fungsionalitas. Lanjutkan **Fase 5 (Deployment)** untuk memastikan aplikasi production-ready. **Fase 3 (Code Quality)** sebaiknya dikerjakan sebelum menambah fitur baru di **Fase 6** untuk menghindari duplikasi bug yang sudah ada.
