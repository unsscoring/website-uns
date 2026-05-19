# Fase 1: Security & Critical Fixes — Analisis Detail

> **Audit:** 19 Mei 2026  
> **Status:** HIGH Priority — Harus dikerjakan pertama  
> **Link ke roadmap:** [ROADMAP.md](./ROADMAP.md)

---

## 1.1 — Blokir Akses File Sensitif via `.htaccess`

### File Terkait
- `/.htaccess` (root)

### Kondisi Saat Ini
```apache
# .htaccess saat ini
Options +SymLinksIfOwnerMatch
RewriteEngine On
RewriteRule ^$ public/ [L]
RewriteRule (.*) public/$1 [L]

# Allow Installatron requests
RewriteCond %{REQUEST_FILENAME} deleteme\.\w+\.php
RewriteRule (.*) - [L]

RewriteRule ^ index.php [L]
```

**Tidak ada aturan yang memblokir akses ke file-file sensitif.**

### Dampak
Siapa pun bisa mengakses:
| URL | Isi |
|-----|-----|
| `https://unggulnusantarasport.com/.env` | **Kredensial database, APP_KEY, secrets** |
| `https://unggulnusantarasport.com/composer.json` | Versi dependency (untuk mencari CVE) |
| `https://unggulnusantarasport.com/composer.lock` | Versi eksak semua package |
| `https://unggulnusantarasport.com/.git/HEAD` | Konfirmasi repo structure |
| `https://unggulnusantarasport.com/storage/logs/laravel.log` | Stack traces, error messages |
| `https://unggulnusantarasport.com/database/database.sqlite` | **Seluruh isi database** (jika pakai SQLite) |

### Solusi

Tambahkan rules berikut di **atas** semua rule lain:

```apache
# Block sensitive files
RewriteRule ^\.env$ - [R=404,L]
RewriteRule ^composer\.(json|lock)$ - [R=404,L]
RewriteRule ^package\.(json|lock)$ - [R=404,L]
RewriteRule ^\.git/ - [R=404,L]
RewriteRule ^\.gitignore$ - [R=404,L]
RewriteRule ^storage/logs/ - [R=404,L]
RewriteRule ^vendor/ - [R=404,L]
RewriteRule ^node_modules/ - [R=404,L]
RewriteRule ^artisan$ - [R=404,L]
RewriteRule ^phpunit\.xml$ - [R=404,L]
RewriteRule ^README\.md$ - [R=404,L]
RewriteRule ^.*\.sqlite$ - [R=404,L]
```

### Verifikasi
```bash
curl -I https://unggulnusantarasport.com/.env
# Harus return: HTTP/2 404
```

---

## 1.2 — Hardcoded Password di Google OAuth

### File Terkait
- `app/Http/Controllers/OauthController.php:47-53`

### Kode Bermasalah
```php
$newUser = User::create([
    'name' => $user->name,
    'email' => $user->email,
    'gauth_id'=> $user->id,
    'gauth_type'=> 'google',
    'password' => encrypt('admin@123')  // <-- HARDCODED!
]);
```

### Dampak
1. **Semua user** yang login via Google mendapat password **sama**: `admin@123`
2. Password disimpan menggunakan `encrypt()` (two-way encryption), bukan `Hash::make()` (one-way hashing). Artinya password bisa di-decrypt.
3. Jika ada user Google OAuth yang tahu pola ini, dia bisa mencoba login via form login biasa dengan password `admin@123` ke akun Google OAuth mana pun.
4. Tidak sesuai standar Laravel — seharusnya pakai `Hash::make()` seperti di `config/hashing.php`.

### Solusi

```php
$newUser = User::create([
    'name' => $user->name,
    'email' => $user->email,
    'gauth_id' => $user->id,
    'gauth_type' => 'google',
    'password' => Hash::make(Str::random(32)),  // Random + hashed
]);
```

Tambahkan import di atas file:
```php
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
```

---

## 1.3 — Authorization Check di Verifikasi

### Overview
Saat ini verifikasi kontingen/atlet/pembayaran bisa diakses oleh **siapa pun yang tahu ID**-nya. Tidak ada pengecekan apakah user tersebut **berhak** mengakses data tersebut.

### File Terkena Dampak

| File | Celah |
|------|-------|
| `AdminVerifikasiKontingen.php` | Admin bisa verifikasi kontingen **kejuaraan mana pun** — tidak dicek apakah admin tersebut terkait dengan kejuaraan |
| `AdminVerifikasiAtlet.php` | Admin bisa akses atlet kontingen **kejuaraan mana pun** |
| `AdminVerifikasiPembayaran.php` | Admin bisa akses pembayaran **kontingen mana pun** |
| `SuperadminVerifikasiKejuaraan.php` | **Tidak ada authorization check sama sekali** — beda dengan versi Admin yang punya cek `Auth::user()->kejuaraans->contains()` |
| `SuperadminVerifikasiKontingen.php` | Superadmin bisa verifikasi kontingen **kejuaraan mana pun** |
| `SuperadminVerifikasiAtlet.php` | Superadmin bisa akses atlet **kontingen mana pun** |
| `SuperadminVerifikasiPembayaran.php` | Superadmin bisa akses pembayaran **kontingen mana pun** |
| `ManajerKejuaraanKontingen.php` | Manajer bisa akses kontingen **kejuaraan mana pun** hanya dengan mengganti ID di URL |
| `ManajerKejuaraanAtlet.php` | Manajer bisa akses atlet **kejuaraan mana pun** |

### Contoh Eksploitasi

**Admin mengakses kontingen kejuaraan yang bukan miliknya:**
```
GET /admin/verifikasi/999/kontingen  ← 999 adalah ID kontingen kejuaraan lain
```
Karena `AdminVerifikasiKontingen::mount(Kontingen $kontingen)` tidak mengecek apakah admin memiliki akses ke kejuaraan yang memiliki kontingen tersebut, request ini **berhasil**.

### Pengecekan yang Sudah Ada (parsial)

Hanya `AdminVerifikasiKejuaraan.php` yang punya authorization check:
```php
// AdminVerifikasiKejuaraan.php:22-24
if (!Auth::user()->kejuaraans->contains($kejuaraan->id)) {
    abort(404);
}
```
Tapi **SuperadminVerifikasiKejuaraan** tidak memilikinya.

### Solusi

**Opsi A: Policy (Recommended)**

Buat Policy classes:

```bash
php artisan make:policy KejuaraanPolicy --model=Kejuaraan
php artisan make:policy KontingenPolicy --model=Kontingen
```

```php
// KejuaraanPolicy.php
public function view(User $user, Kejuaraan $kejuaraan)
{
    if ($user->hasRole('superadmin')) return true;
    if ($user->hasRole('admin')) {
        return $user->kejuaraans->contains($kejuaraan->id);
    }
    return false;
}
```

```php
// KontingenPolicy.php
public function view(User $user, Kontingen $kontingen)
{
    if ($user->hasRole('superadmin')) return true;
    if ($user->hasRole('admin')) {
        return $user->kejuaraans->contains($kontingen->kejuaraans_id);
    }
    if ($user->hasRole('manajer')) {
        return $kontingen->users_id === $user->id;
    }
    return false;
}
```

Kemudian di setiap mount:
```php
public function mount(Kontingen $kontingen)
{
    $this->authorize('view', $kontingen);
    // ...
}
```

**Opsi B: Gate (Cepat tapi kurang rapi)**

Di `AppServiceProvider::boot()`:
```php
Gate::define('access-kejuaraan', function (User $user, Kejuaraan $kejuaraan) {
    if ($user->hasRole('superadmin')) return true;
    return $user->kejuaraans->contains($kejuaraan->id);
});

Gate::define('access-kontingen', function (User $user, Kontingen $kontingen) {
    if ($user->hasRole('superadmin')) return true;
    if ($user->hasRole('admin')) {
        return $user->kejuaraans->contains($kontingen->kejuaraans_id);
    }
    if ($user->hasRole('manajer')) {
        return $kontingen->users_id === $user->id;
    }
    return false;
});
```

---

## 1.4 — Aktifkan Password Reset

### File Terkait
- `config/fortify.php:148`

### Kondisi Saat Ini
```php
'features' => [
    Features::registration(),
    // Features::resetPasswords(),       // <-- DICOMMENT
    // Features::emailVerification(),
    ...
],
```

### Dampak
- User yang lupa password **tidak bisa reset**
- Halaman `/forgot-password` return 404
- Tidak ada workflow "Lupa Password" di halaman login

### Yang Perlu Disiapkan Sebelum Uncomment

1. **Konfigurasi mail** di `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=unggulnusantarasportscoring@gmail.com
MAIL_PASSWORD=xxxx
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="unggulnusantarasportscoring@gmail.com"
MAIL_FROM_NAME="Unggul Nusantara Sport"
```

2. **Buat blade view** (opsional, Laravel punya default):
```bash
php artisan vendor:publish --tag=laravel-mail
```

3. **Uncomment** `Features::resetPasswords()` di `config/fortify.php:148`

### Verifikasi
Kunjungi `/login`, seharusnya muncul link "Lupa password?".

---

## 1.5 — Aktifkan Email Verification

### File Terkait
- `config/fortify.php:149`

### Kondisi Saat Ini
```php
'features' => [
    Features::registration(),
    // Features::resetPasswords(),
    // Features::emailVerification(),   // <-- DICOMMENT
    ...
],
```

### Dampak
- User bisa register dengan email palsu
- Tidak ada verifikasi bahwa user benar-benar pemilik email
- Bot/spam registration tidak tercegah

### Yang Perlu Dilakukan

1. **Pastikan mail sudah terkonfigurasi** (lihat 1.4)
2. **Tambahkan `MustVerifyEmail` di User model:**
```php
// app/Models/User.php
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    // ...
}
```

3. **Uncomment** `Features::emailVerification()` di `config/fortify.php:149`

4. **Update route middleware** — rute yang butuh verified email harus pakai middleware `verified`. Saat ini beberapa rute sudah pakai (lihat `routes/web.php:78-84`), sudah benar.

### Verifikasi
Register user baru → seharusnya dapat email verifikasi. Akses dashboard sebelum verifikasi → redirect ke halaman verifikasi.

---

## 1.6 — Rate Limiting + CAPTCHA

### A. Rate Limiting

### Kondisi Saat Ini
Fortify sudah mengkonfigurasi rate limiter:
```php
// config/fortify.php:117-120
'limiters' => [
    'login' => 'login',
    'two-factor' => 'two-factor',
],
```

Default Fortify rate limiter: **5 percobaan per menit per email+IP**. Ini sudah cukup untuk mencegah brute force login. Tidak perlu perubahan.

### B. CAPTCHA / Bot Protection

### Kondisi Saat Ini
**Tidak ada CAPTCHA sama sekali.** Form register bisa di-submit oleh bot tanpa hambatan.

### Solusi

Gunakan **Google reCAPTCHA v3** (invisible, tidak mengganggu UX):

1. Install package:
```bash
composer require anhskohbo/no-captcha
```

2. Tambahkan di `.env`:
```env
NOCAPTCHA_SITEKEY=your-site-key
NOCAPTCHA_SECRET=your-secret-key
```

3. Tambahkan rule custom untuk register form. Override Fortify register action atau tambahkan di `AppServiceProvider::boot()`:
```php
Validator::extend('captcha', function ($attribute, $value) {
    $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        'secret' => config('no-captcha.secret'),
        'response' => $value,
    ]);
    return $response->json('success');
});
```

4. Blade form register:
```html
{!! NoCaptcha::renderJs() !!}
{!! NoCaptcha::display() !!}
```

---

## 1.7 — Set Expiry Token Sanctum

### File Terkait
- `config/sanctum.php:50`

### Kondisi Saat Ini
```php
// config/sanctum.php
'expiration' => null,  // Token tidak pernah expire
```

### Dampak
Sekali user mendapat API token, token tersebut **berlaku selamanya**. Jika token bocor (misalnya dari localStorage XSS), attacker bisa mengakses API tanpa batas waktu.

### Solusi
```php
'expiration' => 60 * 24,  // 24 jam (dalam menit)
```

Atau sesuaikan dengan kebutuhan:
- `60 * 24 * 7` = 7 hari
- `60 * 24 * 30` = 30 hari
- `null` = tidak expire (tidak direkomendasikan untuk production)

### Catatan
Saat ini API (`routes/api.php`) hanya punya 1 endpoint `/api/user` yang diproteksi `auth:sanctum`. Dampak terbatas untuk sekarang, tapi tetap harus di-set untuk production readiness.

---

## Ringkasan Urutan Pengerjaan

| # | Item | Prioritas | Estimasi |
|---|------|-----------|----------|
| 1.1 | Blokir file sensitif `.htaccess` | **CRITICAL** | 10 menit |
| 1.2 | Hardcoded OAuth password | **CRITICAL** | 5 menit |
| 1.3 | Authorization check verifikasi | **CRITICAL** | 2-3 jam |
| 1.4 | Password reset | HIGH | 30 menit |
| 1.5 | Email verification | HIGH | 15 menit |
| 1.6 | CAPTCHA | MEDIUM | 30 menit |
| 1.7 | Sanctum expiry | LOW | 1 menit |

**Total estimasi:** ~4-5 jam untuk seluruh Fase 1.
