# Kopi Bubuk Lokal Nusantara
**Tugas Praktikum Cloud Computing - Kelompok 5**

Aplikasi web sederhana berbasis Laravel dan MySQL untuk UMKM fiktif penjual kopi bubuk lokal Nusantara.

## Fitur
- Halaman utama yang menampilkan profil UMKM.
- Menampilkan 6 produk kopi beserta harga.
- Footer informasi kelompok.
- Endpoint `/health` untuk mengecek status aplikasi dan koneksi database.
- Form pemesanan yang menyimpan data ke MySQL.
- Riwayat pesanan.

## Foto Produk
Letakkan foto produk di folder `public/images/` dengan nama file berikut:
- `kopi-gayo.jpg`
- `kopi-toraja.jpg`
- `kopi-lampung.jpg`
- `kopi-bali.jpg`
- `kopi-flores.jpg`
- `kopi-java.jpg`

Disarankan menggunakan rasio gambar 4:3 dengan ukuran maksimal sekitar 200 KB per file. Jika foto belum tersedia, aplikasi akan menampilkan placeholder.

## Instalasi
Persyaratan:
- PHP 8.2 atau lebih baru
- Composer
- MySQL atau MariaDB

1. Clone repository atau siapkan project Laravel, kemudian masuk ke folder project.

   ```bash
   composer install
   ```

2. Siapkan file environment. Jika file `.env` belum tersedia, salin dari `.env.example`.

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. Atur konfigurasi database pada file `.env`, termasuk `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD`.

4. Buat database MySQL dengan nama `kopi_nusantara`.

   ```sql
   CREATE DATABASE kopi_nusantara CHARACTER SET utf8mb4;
   ```

5. Jalankan migrasi database dan server Laravel.

   ```bash
   php artisan migrate
   php artisan serve --host=0.0.0.0 --port=8000
   ```

6. Buka alamat berikut di browser:
   - Halaman utama: `http://localhost:8000`
   - Health check: `http://localhost:8000/health`

## Deployment ke Virtual Machine (VM)
Untuk deployment, instal dependensi produksi dan arahkan konfigurasi Nginx atau Apache ke folder `public/`.

```bash
composer install --no-dev --optimize-autoloader
chmod -R 775 storage bootstrap/cache
php artisan migrate --force
```

Pastikan konfigurasi web server, PHP, dan database sudah disesuaikan dengan lingkungan VM.

## Keamanan
- File `.env` tidak boleh diunggah ke repository GitHub.
- Password database disimpan di file `.env`, bukan ditulis langsung di kode aplikasi.
- Pastikan file `.env` masuk ke `.gitignore`.
