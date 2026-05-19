# AGENTS.md — Aturan Kerja Agent

## Aturan Wajib

### 1. Buat Roadmap Dulu
Setiap kali menerima tugas implementasi, **selalu buat roadmap/todolist terlebih dahulu**. Jangan langsung menulis kode. Jabarkan langkah-langkah yang akan dikerjakan secara runtut.

### 2. Buat Issue Dulu
Setelah roadmap, **buat issue** yang mendeskripsikan tugas sebelum mulai implementasi. Gunakan format:
- Judul: singkat dan jelas
- Deskripsi: apa yang akan dikerjakan, mengapa, dan bagaimana pendekatannya

### 3. Pahami Konteks Sebelum Implementasi
Jangan menulis kode sebelum **benar-benar paham** struktur, alur, dan konvensi codebase. Baca file terkait, telusuri dependensi, cek pattern yang sudah ada.

### 4. Fullscan Jika Belum Paham
Jika masih belum paham konteks, **lakukan fullscan codebase**. Baca sebanyak mungkin file yang relevan. Lama tidak masalah — yang penting paham.

### 5. Tanya Jika Masih Tidak Paham
Jika setelah fullscan masih ada yang tidak jelas, **bertanya kepada user**. Jangan berasumsi atau menebak.

### 6. E2E Testing di Akhir Roadmap
Setiap kali menyelesaikan seluruh roadmap (setelah semua task selesai), **wajib lakukan E2E testing** untuk memastikan seluruh fitur berjalan dengan baik dari ujung ke ujung.
- Jalankan `php artisan test` untuk menjalankan semua test (Unit + Feature)
- Jika ada test yang gagal, perbaiki sebelum menyatakan selesai
- Jika project belum punya test untuk fitur baru, buatkan test coverage-nya

---

## Alur Kerja Standar

```
Terima Tugas → Roadmap → Issue → Pahami Konteks → Konfirmasi → Implementasi → E2E Testing → Selesai
```

- Jika di titik "Pahami Konteks" masih ragu → **fullscan**
- Jika di titik "Konfirmasi" masih ragu → **tanya user**
- Di titik **E2E Testing** → jalankan `php artisan test`, pastikan semua test pass

---

## Tech Stack Project Ini

- **Framework:** Laravel (PHP)
- **Frontend:** Blade + Tailwind CSS + Vite
- **Package Manager:** Composer (PHP), npm (JS)

## Perintah Umum

```bash
# Install dependencies
composer install
npm install

# Build frontend
npm run build

# Dev server
npm run dev

# Test
php artisan test
```
