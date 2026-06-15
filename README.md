# RagaShop

RagaShop adalah aplikasi **e-commerce berbasis web** yang memungkinkan pengguna untuk melakukan pembelian produk secara online serta menyediakan panel admin untuk mengelola seluruh aktivitas toko.

## Fitur Utama

### 👤 Pembeli

* Registrasi dan Login akun
* Melihat daftar produk
* Mencari produk
* Melihat detail produk
* Menambahkan produk ke keranjang
* Checkout pesanan
* Melihat riwayat pembelian
* Mengelola profil pengguna

### 🛠️ Admin

* Login Admin
* Dashboard Admin
* CRUD Produk
* CRUD Kategori
* Mengelola Pesanan
* Mengelola Data Pengguna
* Mengelola Stok Produk
* Melihat Statistik Penjualan

## Teknologi yang Digunakan

* Laravel
* PHP
* MySQL
* Bootstrap / AdminLTE
* JavaScript
* HTML & CSS

## 📂 Struktur Sistem

### Role Pengguna

1. **Customer**

   * Melakukan pembelian produk
   * Mengelola akun pribadi
   * Melihat riwayat transaksi

2. **Admin**

   * Mengelola produk
   * Mengelola kategori
   * Mengelola pesanan
   * Mengelola pengguna

## 🚀 Instalasi

### Clone Repository

```bash
git clone https://github.com/username/ragashop.git
```

### Masuk ke Folder Project

```bash
cd ragashop
```

### Install Dependency

```bash
composer install
```

### Copy File Environment

```bash
cp .env.example .env
```

### Generate Application Key

```bash
php artisan key:generate
```

### Konfigurasi Database

Edit file `.env`

```env
DB_DATABASE=ragashop
DB_USERNAME=root
DB_PASSWORD=
```

### Migrasi Database

```bash
php artisan migrate
```

### Jalankan Server

```bash
php artisan serve
```

Akses aplikasi melalui:

```text
http://127.0.0.1:8000
```

## 📈 Pengembangan Selanjutnya

* Sistem pembayaran online
* Wishlist produk
* Notifikasi pesanan
* Laporan penjualan PDF
* Integrasi API pengiriman
