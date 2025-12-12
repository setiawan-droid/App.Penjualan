Aplikasi Penjualan – Dokumentasi & README
 Deskripsi Proyek

Aplikasi Penjualan ini adalah sistem Point of Sale (POS) sederhana berbasis Laravel 12 + Breeze yang digunakan untuk mengelola barang, transaksi penjualan, laporan, serta pencatatan log aktivitas pengguna.
Aplikasi ini cocok digunakan untuk toko kecil, minimarket, koperasi sekolah, atau UKM.

 Fitur Utama
 1. Autentikasi & Manajemen Pengguna

Login & Logout (Laravel Breeze)

Registrasi pengguna

Logging aktivitas login & logout ke file khusus (auth.log)

 2. Manajemen Barang

Daftar barang dalam bentuk tabel elegan

Tambah barang

Edit barang

Hapus barang

Pencarian barang berdasarkan nama

 3. Kasir / Penjualan

Memilih barang dari tabel produk

Menambah barang ke keranjang

Menambah / mengurangi qty

Menghapus item dari keranjang

Validasi pembayaran:

Tidak boleh melakukan checkout jika uang bayar kurang

Proses transaksi tersimpan ke:

tabel transaksis

tabel transaksi_items

 4. Laporan Penjualan

Filter laporan berdasarkan tanggal awal – akhir

Export PDF laporan penjualan

PDF berisi:

Judul besar: "Laporan Penjualan"

Periode laporan

Garis pemisah

Tabel transaksi

Tanda tangan user di bagian bawah

 5. Logging Aktivitas

File khusus untuk logging:

local.INFO

local.WARNING

local.ERROR

authlog (login/logout)

Mendukung debugging dan audit sistem

 Teknologi yang Digunakan
Kategori	Teknologi
Framework Backend	Laravel 12
Autentikasi	Laravel Breeze
Basis Data	MySQL
Frontend	Blade + Tailwind (bawaan Breeze)
Logging	Laravel Log Channels
Export PDF	DomPDF / Snappy / Laravel PDF

 Struktur Direktori Penting

app/
 ├─ Http/
 │   ├─ Controllers/
 │   │   ├─ BarangController.php
 │   │   ├─ KasirController.php
 │   │   └─ LaporanController.php
 │   └─ Requests/
 ├─ Models/
 │   ├─ Barang.php
 │   ├─ Transaksi.php
 │   └─ TransaksiItem.php

resources/
 ├─ views/
 │   ├─ barang/
 │   ├─ kasir/
 │   ├─ laporan/
 │   └─ layouts/

routes/
 └─ web.php

 Struktur Database
1. tabel barang
Field	Tipe	Keterangan
id	bigint	Primary key
nama	varchar	Nama barang
harga	decimal	Harga barang
stok	int	Jumlah stok
created_at	timestamp	
updated_at	timestamp	
2. tabel transaksis
Field	Tipe
id	bigint
user_id	bigint (relasi ke users)
kode_transaksi	string
total	decimal
bayar	decimal
kembalian	decimal
created_at	timestamp
updated_at	timestamp
3. tabel transaksi_items
Field	Tipe
id	bigint
transaksi_id	bigint
product_id	bigint
qty	int
harga	decimal
subtotal	decimal

Cara Instalasi

Clone repository

git clone https://github.com/username/penjualan.git


Masuk folder proyek

cd penjualan


Instal dependency

composer install
npm install && npm run build


Copy file environment

cp .env.example .env


Buat database MySQL dan set .env

Generate key

php artisan key:generate


Migrasi database

php artisan migrate


Jalankan aplikasi

php artisan serve

 Cara Menggunakan Aplikasi
 1. Login

Masukkan email & password.

 2. Kelola Barang

Menu Barang → Tambah Barang untuk menambahkan produk.

 3. Transaksi Kasir

Pilih barang dari tabel

Tambahkan ke keranjang

Atur qty

Klik Checkout

Masukkan uang bayar

Sistem validasi:

Jika uang kurang → muncul peringatan

Jika cukup → transaksi tersimpan

4. Cetak Laporan

Masuk menu Laporan, pilih periode, klik Export PDF.

Logging

Semua login & logout direkam:

storage/logs/auth.log


Semua error aplikasi:

storage/logs/laravel.log
storage/logs/local.ERROR
storage/logs/local.WARNING
storage/logs/local.INFO

Kontribusi

Pull Request dipersilakan:

Tambah fitur stok otomatis

Dashboard grafik laporan

Role admin vs kasir