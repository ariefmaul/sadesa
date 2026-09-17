# SADeSA

**SADeSA (Sistem Administrasi Desa)** adalah platform digital pelayanan dan administrasi desa yang dirancang untuk menghubungkan pemerintah desa, masyarakat, dan proses administrasi secara terintegrasi.

SADeSA bukan hanya sistem profil satu desa, tetapi merupakan sistem **multi-desa dan multi-wilayah** yang memiliki pengelolaan Provinsi, Kota/Kabupaten, Kecamatan, Desa, pengguna, dokumen, pengajuan layanan, hingga proses verifikasi dan pencetakan dokumen.

Sistem dibangun dengan pendekatan modern, responsif, dan berbasis role sehingga setiap pengguna hanya mendapatkan akses terhadap fitur yang sesuai dengan kewenangannya.

---

## Fitur Utama

### Manajemen Wilayah

SADeSA mendukung struktur wilayah administratif:

* Provinsi
* Kota/Kabupaten
* Kecamatan
* Desa

Data wilayah dikelola secara terstruktur sehingga satu sistem dapat menangani banyak wilayah dan desa.

---

## Role Pengguna

SADeSA menggunakan sistem role-based access control.

### Super Admin

Super Admin memiliki akses untuk mengelola data dan konfigurasi utama sistem.

Fitur:

* Dashboard
* Manajemen Provinsi
* Manajemen Kota/Kabupaten
* Manajemen Kecamatan
* Manajemen Desa
* Manajemen Admin Desa
* Manajemen Template Surat

---

### Admin Desa

Admin Desa bertanggung jawab terhadap administrasi dan pelayanan pada desa yang dikelolanya.

Fitur:

* Dashboard
* Verifikasi Masyarakat
* Pengajuan layanan
* Template Surat
* Pengumuman Desa
* Transparansi Anggaran

Admin Desa dapat memproses data masyarakat serta pengajuan layanan sesuai dengan kewenangannya.

---

### Masyarakat

Masyarakat menggunakan SADeSA untuk mengakses pelayanan administrasi desa secara digital.

Fitur utama meliputi:

* Dashboard masyarakat
* Pengajuan layanan administrasi
* Melihat status pengajuan
* Mengakses informasi desa
* Mendapatkan informasi/pengumuman
* Mengakses layanan yang tersedia sesuai hak akses

---

### Mesin

Role Mesin digunakan untuk mendukung proses otomatisasi verifikasi dan pencetakan dokumen.

Fitur:

* Scan
* Verifikasi dokumen menggunakan token
* Proses verifikasi
* Pencetakan dokumen

---

### Mesin Cetak

Role Mesin Cetak digunakan untuk proses yang berhubungan dengan pencetakan dokumen yang telah diverifikasi.

Fokus utama:

* Scan
* Verifikasi
* Cetak dokumen
* Konfirmasi dokumen telah dicetak

---

## Alur Pelayanan

Secara umum, alur pelayanan SADeSA dirancang seperti berikut:

```text
Masyarakat
    │
    ▼
Pengajuan Layanan
    │
    ▼
Admin Desa
    │
    ├── Verifikasi
    │
    ▼
Dokumen Diproses
    │
    ▼
Token / Verifikasi Dokumen
    │
    ▼
Mesin
    │
    ▼
Mesin Cetak
    │
    ▼
Dokumen Dicetak
```

Alur dapat menyesuaikan dengan jenis layanan dan proses administrasi yang tersedia dalam sistem.

---

# Modul Sistem

## 1. Dashboard

Setiap role memiliki dashboard yang berbeda sesuai dengan kebutuhan dan kewenangannya.

Dashboard menggunakan sistem:

* Menu utama
* Quick actions
* Navigasi berdasarkan role
* Informasi yang relevan dengan pengguna

---

## 2. Manajemen Wilayah

Super Admin dapat mengelola data:

```text
Provinsi
└── Kota/Kabupaten
    └── Kecamatan
        └── Desa
```

Struktur tersebut digunakan sebagai dasar pengelolaan desa dan pengguna dalam sistem.

---

## 3. Manajemen Admin Desa

Super Admin dapat membuat dan mengelola akun Admin Desa.

Data yang dikelola antara lain:

* Nama
* NIK
* Jenis kelamin
* Desa
* Email
* Password
* Role
* Status verifikasi

Admin Desa dikaitkan dengan desa tertentu sehingga kewenangannya dapat dibatasi berdasarkan wilayah yang dikelola.

---

## 4. Verifikasi Masyarakat

Admin Desa dapat melakukan proses verifikasi terhadap masyarakat yang terdaftar dalam sistem.

Tujuannya adalah memastikan akun masyarakat dapat digunakan untuk mengakses pelayanan desa.

---

## 5. Pengajuan Layanan

Masyarakat dapat mengajukan layanan administrasi desa melalui sistem.

Admin Desa kemudian dapat memproses pengajuan sesuai dengan prosedur pelayanan.

Status pengajuan digunakan untuk memberikan informasi mengenai perkembangan proses layanan kepada masyarakat.

---

## 6. Template Surat

SADeSA menyediakan pengelolaan template surat untuk mendukung pembuatan dokumen administrasi desa.

Template dapat dikelola oleh pihak yang memiliki kewenangan sesuai role.

Template digunakan sebagai dasar pembuatan dokumen layanan sehingga proses administrasi dapat dilakukan secara lebih terstruktur.

---

## 7. Verifikasi dan Pencetakan Dokumen

Dokumen yang telah diproses dapat melalui mekanisme verifikasi menggunakan token.

Role Mesin menangani proses:

```text
Scan
↓
Verifikasi Token
↓
Validasi Dokumen
↓
Dokumen Siap Cetak
```

Setelah dokumen dinyatakan valid, proses pencetakan dapat dilakukan oleh sistem mesin cetak.

---

## 8. Pengumuman Desa

Admin Desa dapat mengelola informasi dan pengumuman yang ditujukan kepada masyarakat desa.

Pengumuman digunakan untuk menyampaikan informasi resmi terkait pelayanan maupun kegiatan desa.

---

## 9. Transparansi Anggaran

SADeSA menyediakan modul transparansi anggaran desa untuk membantu masyarakat mendapatkan informasi mengenai pengelolaan anggaran desa.

Modul ini menjadi bagian dari upaya meningkatkan keterbukaan informasi publik dalam pelayanan pemerintahan desa.

---

# Teknologi

SADeSA dikembangkan menggunakan teknologi web modern.

### Backend

* PHP
* Laravel 13
* Laravel Eloquent ORM
* Laravel Routing
* Laravel Middleware
* Laravel Validation
* MySQL

### Frontend

* Blade
* Tailwind CSS
* JavaScript
* Alpine.js
* SweetAlert
* SVG / Icon system

### Architecture

Sistem menggunakan pendekatan:

```text
Browser
   │
   ▼
Laravel Route
   │
   ▼
Middleware / Authorization
   │
   ▼
Controller
   │
   ▼
Model / Eloquent
   │
   ▼
MySQL
```

---

# Keamanan

SADeSA menerapkan beberapa mekanisme keamanan untuk membatasi akses pengguna.

Di antaranya:

* Authentication
* Role-based authorization
* Middleware
* Laravel validation
* CSRF protection
* Password hashing
* Database constraints
* Validasi data wilayah
* Pembatasan akses berdasarkan role

Role yang tersedia:

```text
super_admin
admin_desa
masyarakat
mesin
mesin_cetak
```

---

# Struktur Role

```text
                    SADeSA
                       │
          ┌────────────┼────────────┐
          │            │            │
     Super Admin   Admin Desa   Masyarakat
          │            │            │
          │            │            └── Pengajuan
          │            │
          │            ├── Verifikasi
          │            ├── Pengajuan
          │            ├── Template Surat
          │            ├── Pengumuman
          │            └── Transparansi Anggaran
          │
          ├── Provinsi
          ├── Kota/Kabupaten
          ├── Kecamatan
          ├── Desa
          ├── Admin Desa
          └── Template Surat

                       │
                       ▼
              Mesin / Mesin Cetak
                       │
                 Scan & Cetak
```

---

# UI / Design System

SADeSA menggunakan desain yang berorientasi pada aplikasi pemerintahan digital modern.

Karakteristik desain:

* Modern
* Clean
* Profesional
* Responsif
* Minimalis
* Mudah digunakan
* Konsisten antar halaman

Palet warna utama:

```text
Navy       #0A2540
Dark Blue  #0B3D91
Blue       #2563EB
Green      #86EFAC
White      #FFFFFF
```

Navy dan dark blue digunakan sebagai warna utama sistem, sedangkan blue dan green digunakan sebagai accent dan status tertentu.

---

# CRUD

Modul administrasi menggunakan pola CRUD:

```text
Create
  ↓
Read
  ↓
Update
  ↓
Delete
```

Setiap halaman data dirancang memiliki:

* Tambah
* Edit
* Hapus
* Pencarian
* Pagination jika diperlukan
* Empty state
* Feedback proses

Penghapusan data menggunakan konfirmasi SweetAlert untuk mencegah penghapusan secara tidak sengaja.

---

# Pencarian Data

SADeSA menggunakan pendekatan pencarian yang disesuaikan dengan jumlah data.

Untuk data yang relatif kecil:

```text
Database
   ↓
Laravel
   ↓
Browser
   ↓
JavaScript Search
```

Pencarian dapat dilakukan langsung pada data yang sudah ditampilkan tanpa reload halaman.

Untuk dataset yang besar, sistem dapat menggunakan:

```text
Search
   ↓
Laravel Query
   ↓
Database
   ↓
Pagination
```

Pendekatan ini digunakan agar browser tidak harus memuat seluruh data sekaligus.

---

# Performance

SADeSA dirancang dengan perhatian terhadap performa aplikasi.

Prinsip yang digunakan:

> Load only what is needed, process only what is needed, render only what is needed.

Beberapa pendekatan yang digunakan:

* Pagination
* Query database yang efisien
* Select kolom yang diperlukan
* Eager loading relationship
* Menghindari N+1 query
* Client-side search untuk dataset kecil
* Server-side search untuk dataset besar
* Menghindari query database di Blade
* Mengurangi proses yang tidak diperlukan
* JavaScript yang ringan

Tujuannya adalah membuat halaman tetap responsif ketika jumlah data bertambah.

---

# Struktur Project

Struktur utama Laravel:

```text
app/
├── Http/
│   ├── Controllers/
│   └── Middleware/
├── Models/
│
database/
├── migrations/
├── seeders/
└── factories/
│
resources/
├── views/
├── css/
└── js/
│
routes/
├── web.php
│
public/
│
storage/
│
.env
composer.json
package.json
```

Struktur dapat berkembang mengikuti kebutuhan modul SADeSA.

---

# Instalasi

Clone repository:

```bash
git clone <repository-url>
cd sadesa
```

Install dependency Laravel:

```bash
composer install
```

Install dependency frontend:

```bash
npm install
```

Buat file environment:

```bash
cp .env.example .env
```

Untuk Windows:

```bash
copy .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Atur konfigurasi database pada `.env`.

Contoh:

```env
APP_NAME=SADeSA
APP_ENV=local
APP_DEBUG=true

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sadesa
DB_USERNAME=root
DB_PASSWORD=
```

Jalankan migration:

```bash
php artisan migrate
```

Jika project memiliki seeder:

```bash
php artisan db:seed
```

Jalankan server Laravel:

```bash
php artisan serve
```

Jalankan Vite:

```bash
npm run dev
```

Aplikasi dapat diakses melalui:

```text
http://127.0.0.1:8000
```

---

# Development

Untuk menjalankan project selama development:

Terminal 1:

```bash
php artisan serve
```

Terminal 2:

```bash
npm run dev
```

Jika menggunakan database yang berbeda, sesuaikan konfigurasi `.env`.

---

# Artisan Commands

Beberapa command yang umum digunakan:

```bash
php artisan migrate
php artisan migrate:fresh --seed
php artisan db:seed
php artisan route:list
php artisan optimize:clear
php artisan storage:link
```

Untuk melihat route yang tersedia:

```bash
php artisan route:list
```

Untuk membersihkan cache:

```bash
php artisan optimize:clear
```

---

# Pengembangan Selanjutnya

Pengembangan SADeSA dapat terus diarahkan pada:

* Peningkatan performa
* Penyempurnaan pelayanan digital
* Integrasi dokumen
* Pengembangan proses verifikasi
* Pengembangan sistem pencetakan
* Peningkatan transparansi desa
* Peningkatan pengalaman pengguna
* Penguatan keamanan
* Optimasi database
* Pengembangan layanan masyarakat

---

# Prinsip Pengembangan

Setiap pengembangan fitur SADeSA harus memperhatikan:

1. **Sederhana** — fitur tidak dibuat lebih kompleks dari kebutuhan.
2. **Cepat** — proses aplikasi harus efisien.
3. **Aman** — setiap akses harus memiliki authorization yang tepat.
4. **Responsif** — aplikasi harus nyaman digunakan pada berbagai ukuran layar.
5. **Konsisten** — UI dan pola CRUD harus seragam.
6. **Terukur** — fitur harus menggunakan data nyata dari database.
7. **Maintainable** — kode harus mudah dipahami dan dikembangkan.
8. **Scalable** — sistem harus siap menangani pertumbuhan data dan jumlah pengguna.

---

# Status Project

**SADeSA — Sistem Administrasi Desa**

Status: **Active Development**

Platform:

```text
Web Application
```

Architecture:

```text
Laravel + MySQL + Blade + Tailwind CSS + JavaScript
```

Target:

```text
Pemerintah Desa
Admin Desa
Masyarakat
Operasional Verifikasi & Pencetakan Dokumen
```
