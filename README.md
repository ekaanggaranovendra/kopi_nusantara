# Kopi Bubuk Lokal Nusantara (Tugas Praktikum Cloud Computing - Kelompok 5)

Aplikasi web sederhana (Laravel + MySQL) untuk UMKM fiktif penjual kopi bubuk.

## Fitur
- Halaman utama: profil UMKM, 6 produk + harga, footer info kelompok
- `/health` -> menampilkan `OK` (juga mengecek koneksi database)
- Form pesanan tersimpan ke MySQL + riwayat pesanan

## Foto Produk
Taruh foto di `public/images/` dengan nama: `kopi-gayo.jpg`, `kopi-toraja.jpg`, `kopi-lampung.jpg`,
`kopi-bali.jpg`, `kopi-flores.jpg`, `kopi-java.jpg` (disarankan rasio 4:3, maks ~200 KB per file).
Jika file belum ada, otomatis tampil placeholder.

## Instalasi
Syarat: PHP 8.2+, Composer, MySQL/MariaDB.

1. Buat project Laravel dasar, lalu salin file dari repo ini (timpa jika diminta):
   ```bash
   composer create-project laravel/laravel kopi-nusantara
   cd kopi-nusantara
   # salin: app/, database/, resources/, routes/web.php, README.md
   ```
   (Atau clone repo ini lalu jalankan `composer install`.)
2. Siapkan environment:
   ```bash
   cp .env.example .env      # jika clone repo
   php artisan key:generate
   ```
   Edit `.env`: isi `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.
3. Buat database kosong:
   ```sql
   CREATE DATABASE kopi_nusantara CHARACTER SET utf8mb4;
   ```
4. Migrasi & jalankan:
   ```bash
   php artisan migrate
   php artisan serve --host=0.0.0.0 --port=8000
   ```
5. Buka `http://localhost:8000` dan `http://localhost:8000/health`.

## Deploy ke VM (ringkas)
`composer install --no-dev --optimize-autoloader`, arahkan Nginx/Apache root ke `public/`,
`chmod -R 775 storage bootstrap/cache`, lalu `php artisan migrate --force`.

## Keamanan
- `.env` tidak boleh di-commit (sudah ada di `.gitignore` bawaan Laravel).
- Password database hanya ada di `.env`, tidak ada di kode.
