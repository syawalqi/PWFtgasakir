# LaporIn – Sistem Pengaduan Masyarakat Berbasis Web
> Dokumentasi Lengkap Proyek: PRD · SRS · Tech Stack · Database · API

---

## Daftar Isi

1. [Project Overview](#1-project-overview)
2. [Product Requirements Document (PRD)](#2-product-requirements-document-prd)
3. [Software Requirements Specification (SRS)](#3-software-requirements-specification-srs)
4. [Tech Stack](#4-tech-stack)
   - 4.5 [Keputusan Desain & Tradeoffs](#45-keputusan-desain--tradeoffs)
5. [Arsitektur Sistem](#5-arsitektur-sistem)
6. [Database Design](#6-database-design)
7. [API Specification](#7-api-specification)
   - 7.4 [Rate Limiting](#74-rate-limiting)
   - 7.5 [Error Handling & HTTP Status Codes](#75-error-handling--http-status-codes)
   - 7.6 [Strategi Caching](#76-strategi-caching)
8. [UI/UX Flow & Wireframe Description](#8-uiux-flow--wireframe-description)
9. [Timeline & Milestone](#9-timeline--milestone)
   - 9.1 [Rencana Pengujian (Testing Plan)](#91-rencana-pengujian-testing-plan)
10. [Risiko & Mitigasi](#10-risiko--mitigasi)

---

## 1. Project Overview

| Atribut | Detail |
|---|---|
| **Nama Proyek** | LaporIn |
| **Judul Formal** | Rancang Bangun Sistem Pengaduan Masyarakat Berbasis Web Menggunakan Laravel |
| **Versi Dokumen** | v1.0.0 |
| **Tanggal** | 2025 |
| **Tipe Aplikasi** | Web Application (Full-Stack Monolith + REST API) |
| **Framework Utama** | Laravel 11 |
| **Database Tool** | MySQL Workbench |
| **Bahasa** | PHP 8.2, JavaScript (Vanilla/Alpine.js) |

### 1.1 Latar Belakang

Selama ini masyarakat kesulitan menyampaikan keluhan kepada pihak terkait karena tidak adanya kanal resmi yang terpusat, mudah diakses, dan dapat dipantau progresnya. Laporan yang masuk via telepon atau tatap muka sering tidak terdokumentasi dengan baik dan sulit di-*tracking*.

**LaporIn** hadir sebagai solusi digital yang menjembatani masyarakat (user) dengan pengelola/admin untuk menyampaikan, memproses, dan menyelesaikan aduan secara transparan dan terstruktur.

### 1.2 Tujuan Proyek

- Menyediakan platform pelaporan aduan yang mudah digunakan oleh masyarakat.
- Memberikan admin sistem yang efisien untuk mengelola dan menindaklanjuti laporan.
- Menjamin transparansi status aduan yang dapat dipantau oleh pelapor secara real-time.
- Menghasilkan dokumentasi proyek akhir berbasis Laravel yang komprehensif.

### 1.3 Metodologi Penelitian

Metodologi yang digunakan dalam perancangan dan pembangunan sistem **LaporIn** adalah **metode Waterfall (SDLC klasik)**, yang terdiri dari enam tahapan berurutan:

1. **Analisis Kebutuhan (Requirements)** — Mengidentifikasi kebutuhan fungsional dan non-fungsional melalui studi literatur dan observasi proses pengaduan konvensional. Hasil berupa dokumen PRD dan SRS.
2. **Desain Sistem (Design)** — Merancang arsitektur MVC, skema database (MySQL Workbench EER Diagram), API contract, dan wireframe UI.
3. **Implementasi (Implementation)** — Menulis kode menggunakan Laravel 11, Blade, Tailwind CSS, dan Alpine.js sesuai desain yang telah disetujui.
4. **Pengujian (Testing)** — Melakukan unit testing (PHPUnit), integration testing, dan User Acceptance Testing (UAT) oleh calon pengguna.
5. **Deployment** — Men-deploy aplikasi ke shared hosting atau VPS dan memastikan semua fitur berfungsi di environment production.
6. **Pemeliharaan (Maintenance)** — Dokumentasi final, perbaikan bug minor, dan penyerahan laporan proyek akhir.

Alasan pemilihan Waterfall: cakupan proyek sudah didefinisikan secara jelas sejak awal, tidak ada ekspektasi perubahan requirement signifikan selama pengerjaan, dan setiap fase memiliki deliverable yang dapat diverifikasi secara berurutan — sesuai dengan format proyek akhir akademik.

### 1.4 Scope

**In Scope:**
- Manajemen pengguna (registrasi, login, role-based access)
- CRUD aduan oleh user
- CRUD kategori aduan oleh admin
- Manajemen status aduan oleh admin
- Sistem tanggapan (response) admin ke aduan
- REST API untuk semua fitur utama
- Dashboard statistik sederhana

**Out of Scope:**
- Notifikasi email/SMS
- Mobile App (Android/iOS)
- Pembayaran / modul finansial
- Multi-bahasa (i18n)
- Real-time chat (WebSocket)

**Future Enhancement (Backlog):**
- Pelaporan anonim dengan ID unik untuk tracking
- Notifikasi perubahan status via email
- Integrasi WhatsApp/Telegram bot

---

## 2. Product Requirements Document (PRD)

### 2.1 User Personas

#### Persona 1 – Masyarakat (User)
| Atribut | Detail |
|---|---|
| **Nama** | Budi Santoso |
| **Usia** | 32 tahun |
| **Profesi** | Warga Perumahan |
| **Goals** | Melaporkan masalah jalan rusak di lingkungannya dan memantau progresnya |
| **Pain Points** | Tidak tahu harus melapor ke mana, laporan tidak pernah ditindaklanjuti |
| **Tech Literacy** | Menengah (bisa menggunakan smartphone & browser) |

#### Persona 2 – Administrator
| Atribut | Detail |
|---|---|
| **Nama** | Siti Rahayu |
| **Usia** | 28 tahun |
| **Profesi** | Staff Pengelola Sistem / Petugas Aduan |
| **Goals** | Mengelola semua aduan masuk secara terorganisir dan memberi respons tepat waktu |
| **Pain Points** | Aduan menumpuk, tidak ada kategorisasi, sulit memantau status |
| **Tech Literacy** | Tinggi |

---

### 2.2 User Stories

#### Role: User (Masyarakat)

| ID | User Story | Priority | Acceptance Criteria |
|---|---|---|---|
| US-01 | Sebagai user, saya ingin bisa **mendaftar akun** agar dapat menggunakan layanan | High | Form register dengan name, email, password. Validasi email unik. Redirect ke dashboard setelah berhasil. |
| US-02 | Sebagai user, saya ingin bisa **login** agar dapat mengakses akun saya | High | Login dengan email & password. Gagal login tampilkan pesan error. Session tersimpan. |
| US-03 | Sebagai user, saya ingin bisa **membuat aduan baru** agar masalah saya dapat dilaporkan | High | Form dengan judul, kategori, deskripsi. Aduan tersimpan dengan status `pending`. |
| US-04 | Sebagai user, saya ingin bisa **melihat daftar aduan saya** agar dapat memantau semua laporan | High | Halaman list hanya menampilkan aduan milik user yang login. Ada badge status. |
| US-05 | Sebagai user, saya ingin bisa **melihat detail aduan** beserta tanggapan admin | High | Halaman detail menampilkan semua info aduan + riwayat tanggapan admin. |
| US-06 | Sebagai user, saya ingin bisa **mengedit aduan** yang masih berstatus `pending` | Medium | Edit hanya bisa jika status masih `pending`. Validasi input. |
| US-07 | Sebagai user, saya ingin bisa **menghapus aduan** yang masih berstatus `pending` | Medium | Konfirmasi hapus. Hanya bisa dihapus jika status `pending`. |
| US-08 | Sebagai user, saya ingin bisa **logout** dari sistem | High | Session dihapus. Redirect ke halaman login. |

#### Role: Admin

| ID | User Story | Priority | Acceptance Criteria |
|---|---|---|---|
| UA-01 | Sebagai admin, saya ingin bisa **melihat semua aduan** masuk | High | Dashboard/list menampilkan semua aduan dari semua user. |
| UA-02 | Sebagai admin, saya ingin bisa **memfilter aduan** berdasarkan status | High | Dropdown filter: All / Pending / Diproses / Selesai. |
| UA-03 | Sebagai admin, saya ingin bisa **melihat detail aduan** dari user | High | Halaman detail lengkap: info user, isi aduan, riwayat response. |
| UA-04 | Sebagai admin, saya ingin bisa **mengubah status aduan** | High | Status bisa diubah ke: `pending`, `diproses`, `selesai`. |
| UA-05 | Sebagai admin, saya ingin bisa **memberi tanggapan** pada aduan | High | Form textarea untuk response. Tanggapan tersimpan dengan timestamp. |
| UA-06 | Sebagai admin, saya ingin bisa **mengelola kategori aduan** (CRUD) | High | Tambah, edit, hapus kategori. Validasi nama unik. |
| UA-07 | Sebagai admin, saya ingin melihat **statistik aduan** di dashboard | Medium | Widget: total aduan, pending, diproses, selesai. |

---

### 2.3 Functional Requirements

| Kode | Fitur | Deskripsi |
|---|---|---|
| FR-01 | Autentikasi | Sistem mendukung registrasi user baru dan login menggunakan email & password. |
| FR-02 | Role-Based Access | Terdapat dua role: `user` dan `admin`. Akses menu dibatasi berdasarkan role. |
| FR-03 | Manajemen Aduan | User dapat membuat, melihat, mengedit, dan menghapus aduannya sendiri. |
| FR-04 | Manajemen Kategori | Admin dapat membuat, mengedit, dan menghapus kategori aduan. |
| FR-05 | Update Status Aduan | Admin dapat mengubah status aduan menjadi `pending`, `diproses`, atau `selesai`. |
| FR-06 | Sistem Tanggapan | Admin dapat menambahkan tanggapan tertulis pada setiap aduan. |
| FR-07 | REST API | Sistem menyediakan endpoint API dengan autentikasi token (Sanctum). |
| FR-08 | Validasi Input | Semua form memiliki validasi sisi server. |
| FR-09 | Dashboard Statistik | Admin dapat melihat ringkasan jumlah aduan berdasarkan status. |
| FR-10 | Upload Gambar Aduan | User dapat melampirkan satu gambar (max 2MB, format jpg/png) pada setiap aduan. Gambar disimpan di local storage Laravel. |

### 2.4 Non-Functional Requirements

| Kode | Kategori | Requirement |
|---|---|---|
| NFR-01 | Performance | Halaman utama load dalam < 3 detik pada koneksi standar. |
| NFR-02 | Security | Password di-hash dengan bcrypt. SQL Injection dicegah via Eloquent ORM. CSRF protection aktif. |
| NFR-03 | Usability | UI responsif (mobile-friendly) menggunakan Tailwind CSS 3.x dengan utility-first approach. |
| NFR-04 | Maintainability | Kode mengikuti standar PSR-12. Struktur MVC Laravel dipatuhi. |
| NFR-05 | Availability | Aplikasi dapat berjalan di environment lokal (XAMPP/Laragon) maupun server shared hosting. |
| NFR-06 | Scalability | Arsitektur mendukung penambahan fitur tanpa mengubah struktur inti. |
| NFR-07 | Storage | Upload gambar dibatasi maksimal 2MB per file, format JPEG/PNG. Disimpan di `storage/app/public/complaints/`. |

---

## 3. Software Requirements Specification (SRS)

### 3.1 Gambaran Sistem

LaporIn dibangun menggunakan arsitektur **MVC (Model-View-Controller)** berbasis Laravel. Sistem terdiri dari dua antarmuka utama:

1. **Web Interface** – Diakses via browser oleh user dan admin.
2. **REST API** – Diakses oleh client eksternal menggunakan token (Sanctum).

```
┌─────────────────────────────────────────┐
│              CLIENT LAYER               │
│   Browser (User/Admin) │ API Client     │
└────────────┬────────────┬───────────────┘
             │            │
             ▼            ▼
┌─────────────────────────────────────────┐
│           APPLICATION LAYER             │
│  Routes → Middleware → Controller       │
│  Request Validation → Service/Model     │
└────────────────────┬────────────────────┘
                     │
                     ▼
┌─────────────────────────────────────────┐
│             DATA LAYER                  │
│      Eloquent ORM → MySQL Database      │
└─────────────────────────────────────────┘
```

### 3.2 Spesifikasi Use Case

#### UC-01: Register User
- **Actor:** Guest (belum login)
- **Pre-condition:** Pengguna belum memiliki akun
- **Main Flow:**
  1. Pengguna membuka halaman `/register`
  2. Mengisi form: Name, Email, Password, Confirm Password
  3. Sistem memvalidasi input (email unik, password minimal 8 karakter, password match)
  4. Jika valid, sistem membuat akun baru dengan role `user`
  5. Redirect ke `/dashboard`
- **Alternative Flow:** Jika email sudah terdaftar → tampilkan error "Email sudah digunakan"

#### UC-02: Login
- **Actor:** User / Admin
- **Pre-condition:** Pengguna sudah memiliki akun
- **Main Flow:**
  1. Pengguna membuka halaman `/login`
  2. Mengisi email dan password
  3. Sistem memvalidasi kredensial
  4. Jika valid, sistem membuat session
  5. Redirect ke `/dashboard` (user) atau `/admin/dashboard` (admin)
- **Alternative Flow:** Kredensial salah → tampilkan error "Email atau password salah"

#### UC-03: Buat Aduan
- **Actor:** User (terautentikasi)
- **Pre-condition:** User sudah login
- **Main Flow:**
  1. User membuka halaman `/complaints/create`
  2. Mengisi form: Judul, Kategori (dropdown), Deskripsi
  3. **(Opsional)** Mengunggah gambar pendukung (max 2MB, JPG/PNG)
  4. Submit form
  5. Sistem menyimpan aduan dengan `status = pending`, `user_id` dari session, dan menyimpan gambar ke `storage/app/public/complaints/` jika ada
  6. Redirect ke halaman daftar aduan dengan pesan sukses
- **Validasi:**
  - `title`: wajib, min 5 karakter, max 255 karakter
  - `category_id`: wajib, harus ada di tabel `complaint_categories`
  - `description`: wajib, min 20 karakter
  - `image`: opsional, file, image, max:2048 (2MB), mimes:jpg,jpeg,png

#### UC-04: Update Status Aduan (Admin)
- **Actor:** Admin
- **Pre-condition:** Admin sudah login, aduan sudah ada
- **Main Flow:**
  1. Admin membuka detail aduan
  2. Memilih status baru dari dropdown: `pending`, `diproses`, `selesai`
  3. Klik tombol "Update Status"
  4. Sistem memperbarui field `status` di tabel `complaints`
  5. Halaman di-refresh dengan status terbaru
- **Gate:** Hanya admin yang bisa mengakses fungsi ini

#### UC-05: Beri Tanggapan (Admin)
- **Actor:** Admin
- **Pre-condition:** Admin login, aduan tersedia
- **Main Flow:**
  1. Admin membuka detail aduan
  2. Mengisi form tanggapan (textarea)
  3. Submit
  4. Sistem menyimpan response dengan `complaint_id`, `user_id` (admin), dan `message`
  5. Tanggapan tampil di halaman detail aduan

### 3.3 Spesifikasi Validasi Form

#### Form Register
| Field | Aturan |
|---|---|
| name | required, string, min:3, max:100 |
| email | required, email, unique:users |
| password | required, min:8, confirmed |

#### Form Login
| Field | Aturan |
|---|---|
| email | required, email |
| password | required |

#### Form Buat/Edit Aduan
| Field | Aturan |
|---|---|
| title | required, string, min:5, max:255 |
| category_id | required, exists:complaint_categories,id |
| description | required, string, min:20 |
| image | nullable, image, max:2048, mimes:jpg,jpeg,png |

#### Form Kategori
| Field | Aturan |
|---|---|
| name | required, string, min:3, max:100, unique:complaint_categories |

#### Form Tanggapan
| Field | Aturan |
|---|---|
| message | required, string, min:10 |

### 3.4 Gate & Policy

```php
// Gate Definitions (AuthServiceProvider)

// Hanya admin yang bisa mengelola kategori
Gate::define('manage-categories', fn($user) => $user->role === 'admin');

// Hanya admin yang bisa update status
Gate::define('update-complaint-status', fn($user) => $user->role === 'admin');

// Admin bisa lihat semua, user hanya miliknya
Gate::define('view-all-complaints', fn($user) => $user->role === 'admin');

// Hanya admin yang bisa memberi tanggapan
Gate::define('create-response', fn($user) => $user->role === 'admin');
```

```php
// ComplaintPolicy
public function update(User $user, Complaint $complaint): bool
{
    return $user->id === $complaint->user_id 
        && $complaint->status === 'pending';
}

public function delete(User $user, Complaint $complaint): bool
{
    return $user->id === $complaint->user_id 
        && $complaint->status === 'pending';
}
```

---

## 4. Tech Stack

### 4.1 Stack Lengkap

```
┌─────────────────────────────────────────────────────────┐
│                      TECH STACK                         │
├───────────────┬─────────────────────────────────────────┤
│   Layer       │   Teknologi                             │
├───────────────┼─────────────────────────────────────────┤
│ Language      │ PHP 8.2+                                │
│ Framework     │ Laravel 11.x                            │
│ Database      │ MySQL 8.0+                              │
│ DB Design     │ MySQL Workbench 8.0                     │
│ ORM           │ Eloquent ORM (built-in Laravel)         │
│ Auth          │ Laravel Breeze / Laravel Sanctum (API)  │
│ Frontend      │ Blade Template Engine                   │
│ CSS Framework │ Tailwind CSS 3.x                        │
│ JS Utilities  │ Alpine.js 3.x (interaktivitas ringan)   │
│ API Auth      │ Laravel Sanctum (Token-based)           │
│ Dev Server    │ Laragon / XAMPP / Laravel Herd          │
│ Version Ctrl  │ Git + GitHub                            │
│ Package Mgr   │ Composer (PHP) · npm (JS/CSS)           │
│ Testing       │ PHPUnit (built-in Laravel)              │
└───────────────┴─────────────────────────────────────────┘
```

### 4.2 Detail Setiap Teknologi

#### PHP 8.2+
- Named Arguments, Enums, Fibers
- Typed Properties, Match Expression
- Lebih aman dan performa lebih baik dari PHP 7.x

#### Laravel 11.x
- **Routing:** `routes/web.php` (web), `routes/api.php` (API)
- **Middleware:** `auth`, `admin` (custom), `sanctum`
- **Eloquent ORM:** Active Record pattern untuk semua interaksi DB
- **Artisan CLI:** Scaffold controller, migration, model, seeder
- **Blade:** Template engine dengan komponen reusable
- **Validation:** Form Request classes
- **Gate/Policy:** Authorization tanpa paket tambahan

#### MySQL 8.0 + MySQL Workbench
- Relational database dengan Foreign Key Constraints
- MySQL Workbench untuk desain EER Diagram secara visual
- Export SQL schema langsung ke project
- InnoDB Engine untuk mendukung transaksi dan FK

#### Laravel Sanctum
- API token authentication
- SPA authentication support
- Lebih ringan dari Passport untuk proyek skala sedang

#### Tailwind CSS 3.x
- Utility-first CSS framework
- Responsive design built-in
- Custom komponen tanpa meninggalkan HTML

#### Alpine.js 3.x
- Framework JS ringan untuk interaktivitas (toggle, modal, dropdown)
- Tidak memerlukan build process yang kompleks
- Terintegrasi langsung di Blade

### 4.3 Versi Dependencies (composer.json & package.json)

```json
// composer.json
{
    "require": {
        "php": "^8.2",
        "laravel/framework": "^11.0",
        "laravel/sanctum": "^4.0",
        "laravel/tinker": "^2.9"
    },
    "require-dev": {
        "laravel/breeze": "^2.0",
        "fakerphp/faker": "^1.23",
        "phpunit/phpunit": "^11.0"
    }
}
```

```json
// package.json
{
    "devDependencies": {
        "@tailwindcss/forms": "^0.5",
        "alpinejs": "^3.13",
        "autoprefixer": "^10.4",
        "postcss": "^8.4",
        "tailwindcss": "^3.4",
        "vite": "^5.0"
    }
}
```

---

## 4.5 Keputusan Desain & Tradeoffs

Dokumentasi keputusan teknis yang diambil selama perancangan sistem beserta alasannya. Bagian ini menunjukkan bahwa setiap pilihan teknologi dan arsitektur dibuat secara sadar, bukan sekadar mengikuti *default* atau tutorial.

### 4.5.1 Mengapa Laravel (bukan framework lain)?

| Alternatif | Alasan Tidak Dipilih |
|---|---|
| CodeIgniter 4 | Ekosistem lebih kecil, tidak memiliki ORM sekuat Eloquent, tidak ada built-in Artisan CLI. |
| Node.js (Express/NestJS) | Tim pengembang tidak memiliki pengalaman JavaScript backend; PHP stack lebih familiar. |
| Django (Python) | Overhead belajar tinggi untuk kebutuhan proyek yang relatif sederhana. |

**Keputusan:** Laravel dipilih karena ekosistem lengkap (Eloquent ORM, Blade, Artisan, Breeze, Sanctum) yang memungkinkan *scaffolding* cepat dan mengikuti konvensi MVC yang terstandarisasi — cocok untuk proyek akhir dengan batasan waktu 6 minggu.

### 4.5.2 Mengapa Sanctum (bukan Passport)?

Laravel Passport menyediakan OAuth2 server penuh — cocok untuk aplikasi yang memerlukan third-party OAuth clients, authorization code grant, dan PKCE. LaporIn hanya membutuhkan API token sederhana untuk mobile/web client yang dikontrol sendiri. Sanctum lebih ringan, tidak memerlukan konfigurasi OAuth server, dan menggunakan token-based authentication yang cukup untuk seluruh kebutuhan API LaporIn.

### 4.5.3 Mengapa Alpine.js (bukan React/Vue)?

Fitur interaktivitas LaporIn terbatas pada: toggle modal, dropdown filter, dan preview gambar. Menggunakan React atau Vue dengan build process (Webpack/Vite + JSX/SFC) akan menambah kompleksitas yang tidak proporsional. Alpine.js bekerja langsung di dalam Blade template tanpa build step, mengurangi *time-to-first-interaction*.

### 4.5.4 Mengapa `ENUM` untuk status aduan (bukan tabel `statuses` terpisah)?

| Pendekatan | Kelebihan | Kekurangan |
|---|---|---|
| ENUM pada kolom | Cepat, sederhana, tervalidasi di level database | Sulit menambah status baru (perlu ALTER TABLE) |
| Tabel `statuses` + FK | Fleksibel, mudah menambah status | Overhead join, overengineering untuk 3 status |

Status aduan LaporIn bersifat *fixed* dan kecil (3 nilai: `pending`, `diproses`, `selesai`). Sangat tidak mungkin akan bertambah secara dinamis. Maka ENUM adalah pilihan yang tepat — menghindari join yang tidak perlu.

### 4.5.5 Mengapa Tailwind CSS (bukan Bootstrap)?

Tailwind CSS dipilih karena:

1. **Utility-first** — menulis style langsung di HTML tanpa perlu context-switch ke file CSS terpisah, produktif untuk solo developer.
2. **Ukuran output kecil** — hanya class yang dipakai yang masuk ke production build (via purge).
3. **Konsistensi** — design system bawaan (spacing, color, typography scale) mencegah inkonsistensi visual antar halaman.
4. User story mengharuskan responsif — Tailwind memiliki responsive utility built-in (`sm:`, `md:`, `lg:`) tanpa perlu menulis media queries manual.
5. Preferensi pengembang — Galih sudah familier dan eksplisit memilih Tailwind untuk semua proyek.

### 4.5.6 Pertimbangan Soft Delete pada Aduan

**Tidak diterapkan** pada versi ini, tetapi dipertimbangkan. Soft delete (`use SoftDeletes` pada model Complaint) memungkinkan pemulihan aduan yang terhapus secara tidak sengaja oleh admin. Ditunda karena:
- User story hanya mengizinkan penghapusan aduan berstatus `pending` (oleh pemilik aduan sendiri)
- Menambah kompleksitas query (setiap query harus mem-filter `deleted_at IS NULL`)
- Fitur recovery dapat ditambahkan sebagai enhancement tanpa mengubah struktur inti

---

## 5. Arsitektur Sistem

### 5.1 Struktur Direktori Laravel

```
lapor-in/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   └── AuthController.php
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── ComplaintController.php
│   │   │   │   ├── CategoryController.php
│   │   │   │   └── ResponseController.php
│   │   │   ├── User/
│   │   │   │   ├── DashboardController.php
│   │   │   │   └── ComplaintController.php
│   │   │   ├── PageController.php
│   │   │   └── Api/
│   │   │       ├── AuthController.php
│   │   │       ├── ComplaintController.php
│   │   │       ├── CategoryController.php
│   │   │       └── ResponseController.php
│   │   ├── Middleware/
│   │   │   └── RoleMiddleware.php      # Parameterized: role:user / role:admin
│   │   └── Requests/
│   │       ├── StoreComplaintRequest.php
│   │       ├── UpdateComplaintRequest.php
│   │       ├── StoreCategoryRequest.php
│   │       ├── StoreResponseRequest.php
│   │       ├── LoginRequest.php          # Provided by Breeze
│   │       └── RegisterRequest.php       # Validasi inline di RegisteredUserController
│   ├── Models/
│   │   ├── User.php
│   │   ├── Complaint.php
│   │   ├── ComplaintCategory.php
│   │   └── Response.php
│   ├── Policies/
│   │   └── ComplaintPolicy.php
│   └── Providers/
│       ├── AuthServiceProvider.php       # Gate definitions: manage-categories, update-complaint-status, dll.
│       └── AppServiceProvider.php
├── database/
│   ├── migrations/
│   │   ├── 2014_10_12_000000_create_users_table.php
│   │   ├── 2025_01_01_000004_add_role_to_users_table.php   # Menambahkan kolom role ENUM
│   │   ├── 2025_01_01_000001_create_complaint_categories_table.php
│   │   ├── 2025_01_01_000002_create_complaints_table.php
│   │   └── 2025_01_01_000003_create_responses_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── AdminSeeder.php
│       └── CategorySeeder.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php
│       │   └── admin.blade.php
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── user/
│       │   ├── dashboard.blade.php
│       │   ├── complaints/
│       │   │   ├── index.blade.php
│       │   │   ├── create.blade.php
│       │   │   ├── edit.blade.php
│       │   │   └── show.blade.php
│       └── admin/
│           ├── dashboard.blade.php
│           ├── complaints/
│           │   ├── index.blade.php
│           │   └── show.blade.php
│           ├── categories/
│           │   ├── index.blade.php
│           │   ├── create.blade.php
│           │   └── edit.blade.php
│           └── responses/
│               └── create.blade.php
│       ├── pages/
│       │   └── about.blade.php
│       └── errors/
│           ├── 403.blade.php
│           ├── 404.blade.php
│           └── 500.blade.php
├── routes/
│   ├── web.php
│   └── api.php
└── tests/
    └── Feature/
        ├── AuthTest.php
        ├── ComplaintTest.php
        ├── CategoryTest.php
        └── AdminTest.php            # Authorisasi negatif + admin flow
```

### 5.2 Routing Structure

```php
// routes/web.php

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated User Routes
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [User\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('complaints', User\ComplaintController::class);
});

// About Page — accessible by guest and authenticated users
Route::get('/about', [PageController::class, 'about'])->name('about');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('complaints', Admin\ComplaintController::class)->only(['index', 'show']);
    Route::patch('complaints/{complaint}/status', [Admin\ComplaintController::class, 'updateStatus'])->name('complaints.status');
    Route::resource('categories', Admin\CategoryController::class);
    Route::post('complaints/{complaint}/responses', [Admin\ResponseController::class, 'store'])->name('responses.store');
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
```

```php
// routes/api.php
// Semua endpoint dibungkus throttle:60,1

// Auth — public
Route::post('/auth/register', [Api\AuthController::class, 'register']);
Route::post('/auth/login', [Api\AuthController::class, 'login']);

// Categories — public (read-only)
Route::get('/categories', [Api\CategoryController::class, 'index']);

// Authenticated API — Sanctum token
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/auth/logout', [Api\AuthController::class, 'logout']);
    Route::get('/auth/me', [Api\AuthController::class, 'me']);

    // User complaints
    Route::apiResource('complaints', Api\ComplaintController::class)->except(['show']);
    Route::get('/complaints/{complaint}', [Api\ComplaintController::class, 'show']);

    // Responses (read)
    Route::get('/complaints/{complaint}/responses', [Api\ResponseController::class, 'index']);

    // Admin-only
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/complaints', [Api\ComplaintController::class, 'adminIndex']);
        Route::patch('/admin/complaints/{complaint}/status', [Api\ComplaintController::class, 'updateStatus']);

        Route::post('/categories', [Api\CategoryController::class, 'store']);
        Route::put('/categories/{category}', [Api\CategoryController::class, 'update']);
        Route::delete('/categories/{category}', [Api\CategoryController::class, 'destroy']);

        Route::post('/complaints/{complaint}/responses', [Api\ResponseController::class, 'store']);
    });
});
```

---

## 6. Database Design

### 6.1 EER Diagram (Deskripsi untuk MySQL Workbench)

```
┌──────────────────┐       ┌──────────────────────┐       ┌──────────────────┐
│      users       │       │     complaints        │       │complaint_categories│
├──────────────────┤       ├──────────────────────┤       ├──────────────────┤
│ PK id            │1     *│ PK id                │*     1│ PK id            │
│    name          ├───────│ FK user_id            ├───────│    name          │
│    email         │       │ FK category_id        │       │    created_at    │
│    password      │       │    title              │       │    updated_at    │
│    role          │       │    description        │       └──────────────────┘
│    created_at    │       │    status             │
│    updated_at    │       │    image (nullable)   │
└──────────────────┘       │    created_at         │
         │1                │    updated_at         │
         │                 └──────────────────────┘
         │                          │1
         │                          │
         │*                         │*
┌────────┴─────────────────────────┐
│           responses              │
├──────────────────────────────────┤
│ PK id                            │
│ FK complaint_id                  │
│ FK user_id  (admin yang memberi) │
│    message                       │
│    created_at                    │
│    updated_at                    │
└──────────────────────────────────┘
```

### 6.2 DDL (SQL Schema)

```sql
-- =============================================
-- DATABASE: lapor_in
-- Generated for MySQL Workbench
-- =============================================

CREATE DATABASE IF NOT EXISTS `lapor_in`
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE `lapor_in`;

-- -----------------------------------------------
-- Tabel: users
-- -----------------------------------------------
CREATE TABLE `users` (
    `id`                BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name`              VARCHAR(100)    NOT NULL,
    `email`             VARCHAR(150)    NOT NULL UNIQUE,
    `email_verified_at` TIMESTAMP       NULL DEFAULT NULL,
    `password`          VARCHAR(255)    NOT NULL,
    `role`              ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    `remember_token`    VARCHAR(100)    NULL DEFAULT NULL,
    `created_at`        TIMESTAMP       NULL DEFAULT NULL,
    `updated_at`        TIMESTAMP       NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------
-- Tabel: complaint_categories
-- -----------------------------------------------
CREATE TABLE `complaint_categories` (
    `id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name`       VARCHAR(100)    NOT NULL UNIQUE,
    `created_at` TIMESTAMP       NULL DEFAULT NULL,
    `updated_at` TIMESTAMP       NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `complaint_categories_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------
-- Tabel: complaints
-- -----------------------------------------------
CREATE TABLE `complaints` (
    `id`          BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id`     BIGINT UNSIGNED NOT NULL,
    `category_id` BIGINT UNSIGNED NOT NULL,
    `title`       VARCHAR(255)    NOT NULL,
    `description` TEXT            NOT NULL,
    `status`      ENUM('pending', 'diproses', 'selesai') NOT NULL DEFAULT 'pending',
    `image`       VARCHAR(255)    NULL DEFAULT NULL COMMENT 'path to storage/app/public/complaints/',
    `created_at`  TIMESTAMP       NULL DEFAULT NULL,
    `updated_at`  TIMESTAMP       NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `complaints_user_id_foreign` (`user_id`),
    KEY `complaints_category_id_foreign` (`category_id`),
    KEY `complaints_status_index` (`status`),
    CONSTRAINT `complaints_user_id_foreign`
        FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `complaints_category_id_foreign`
        FOREIGN KEY (`category_id`) REFERENCES `complaint_categories` (`id`)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------
-- Tabel: responses
-- -----------------------------------------------
CREATE TABLE `responses` (
    `id`           BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `complaint_id` BIGINT UNSIGNED NOT NULL,
    `user_id`      BIGINT UNSIGNED NOT NULL,
    `message`      TEXT            NOT NULL,
    `created_at`   TIMESTAMP       NULL DEFAULT NULL,
    `updated_at`   TIMESTAMP       NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `responses_complaint_id_foreign` (`complaint_id`),
    KEY `responses_user_id_foreign` (`user_id`),
    CONSTRAINT `responses_complaint_id_foreign`
        FOREIGN KEY (`complaint_id`) REFERENCES `complaints` (`id`)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `responses_user_id_foreign`
        FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

> **Catatan Keamanan — Application-Level Enforcement:**
> Tabel `responses` tidak memiliki constraint di level database untuk membatasi `user_id` hanya ke admin. Validasi bahwa hanya admin yang dapat memberi tanggapan dilakukan di level aplikasi melalui Gate (`Gate::define('create-response', ...)`) dan Middleware. Ini adalah tradeoff yang disengaja — menambahkan trigger/check constraint di MySQL untuk validasi role akan mengunci logika autorisasi ke database dan mempersulit perubahan role di masa depan. Selama semua operasi INSERT/UPDATE pada tabel `responses` melewati Controller yang dilindungi Middleware dan Gate, keamanan tetap terjaga.

-- -----------------------------------------------
-- Seeder Data: complaint_categories
-- -----------------------------------------------
INSERT INTO `complaint_categories` (`name`, `created_at`, `updated_at`) VALUES
    ('Infrastruktur',  NOW(), NOW()),
    ('Kebersihan',     NOW(), NOW()),
    ('Keamanan',       NOW(), NOW()),
    ('Pelayanan',      NOW(), NOW()),
    ('Lainnya',        NOW(), NOW());

-- -----------------------------------------------
-- Seeder Data: Admin Account
-- (password: admin123 -> bcrypt)
-- -----------------------------------------------
INSERT INTO `users` (`name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
    ('Super Admin', 'admin@lapor.in',
     '$2y$12$....', -- ganti dengan hash bcrypt dari 'admin123'
     'admin', NOW(), NOW());
```

### 6.3 Eloquent Model Definitions

```php
// app/Models/User.php
class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password', 'role'];
    protected $hidden   = ['password', 'remember_token'];
    protected $casts    = ['password' => 'hashed'];

    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class);
    }

    public function responses(): HasMany
    {
        return $this->hasMany(Response::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}

// app/Models/Complaint.php
class Complaint extends Model
{
    protected $fillable = ['user_id', 'category_id', 'title', 'description', 'status', 'image'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ComplaintCategory::class, 'category_id');
    }

    public function responses(): HasMany
    {
        return $this->hasMany(Response::class);
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'pending'  => 'bg-yellow-100 text-yellow-800',
            'diproses' => 'bg-blue-100 text-blue-800',
            'selesai'  => 'bg-green-100 text-green-800',
            default    => 'bg-gray-100 text-gray-800',
        };
    }
}

// app/Models/ComplaintCategory.php
class ComplaintCategory extends Model
{
    protected $fillable = ['name'];

    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class, 'category_id');
    }
}

// app/Models/Response.php
class Response extends Model
{
    protected $fillable = ['complaint_id', 'user_id', 'message'];

    public function complaint(): BelongsTo
    {
        return $this->belongsTo(Complaint::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
```

### 6.4 Laravel Migration Files

```php
// create_complaint_categories_table
Schema::create('complaint_categories', function (Blueprint $table) {
    $table->id();
    $table->string('name', 100)->unique();
    $table->timestamps();
});

// create_complaints_table
Schema::create('complaints', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
    $table->foreignId('category_id')->constrained('complaint_categories')->restrictOnDelete();
    $table->string('title');
    $table->text('description');
    $table->enum('status', ['pending', 'diproses', 'selesai'])->default('pending');
    $table->string('image')->nullable();  // path relatif, opsional
    $table->timestamps();
    $table->index('status');
});

// create_responses_table
Schema::create('responses', function (Blueprint $table) {
    $table->id();
    $table->foreignId('complaint_id')->constrained()->cascadeOnDelete();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->text('message');
    $table->timestamps();
});
```

---

## 7. API Specification

### 7.1 Base URL & Header

```
Base URL : http://localhost:8000/api
Auth Type: Bearer Token (Sanctum)
Content-Type: application/json
Accept: application/json
```

### 7.2 Endpoint List

#### 🔐 Auth Endpoints

| Method | Endpoint | Auth | Deskripsi |
|---|---|---|---|
| POST | `/api/auth/register` | No | Registrasi user baru |
| POST | `/api/auth/login` | No | Login & mendapatkan token |
| POST | `/api/auth/logout` | Yes | Logout & hapus token |
| GET | `/api/auth/me` | Yes | Ambil data user yang login |

#### 📋 Complaint Endpoints

| Method | Endpoint | Auth | Role | Deskripsi |
|---|---|---|---|---|
| GET | `/api/complaints` | Yes | user | List aduan milik user |
| POST | `/api/complaints` | Yes | user | Buat aduan baru |
| GET | `/api/complaints/{id}` | Yes | user/admin | Detail aduan |
| PUT | `/api/complaints/{id}` | Yes | user | Edit aduan (status=pending) |
| DELETE | `/api/complaints/{id}` | Yes | user | Hapus aduan (status=pending) |
| GET | `/api/admin/complaints` | Yes | admin | List semua aduan |
| PATCH | `/api/admin/complaints/{id}/status` | Yes | admin | Update status aduan |

#### 🏷 Category Endpoints

| Method | Endpoint | Auth | Role | Deskripsi |
|---|---|---|---|---|
| GET | `/api/categories` | No | - | List semua kategori |
| POST | `/api/categories` | Yes | admin | Tambah kategori |
| PUT | `/api/categories/{id}` | Yes | admin | Edit kategori |
| DELETE | `/api/categories/{id}` | Yes | admin | Hapus kategori |

#### 💬 Response Endpoints

| Method | Endpoint | Auth | Role | Deskripsi |
|---|---|---|---|---|
| GET | `/api/complaints/{id}/responses` | Yes | user/admin | List tanggapan |
| POST | `/api/complaints/{id}/responses` | Yes | admin | Tambah tanggapan |

### 7.2.1 Query Parameters (Filtering, Search & Pagination)

Endpoint GET yang mengembalikan list mendukung parameter berikut:

| Parameter | Tipe | Default | Endpoint | Deskripsi |
|---|---|---|---|---|
| `page` | integer | 1 | Semua GET list | Nomor halaman untuk pagination |
| `per_page` | integer | 10 | Semua GET list | Jumlah item per halaman (max: 50) |
| `status` | string | — | `GET /api/admin/complaints` | Filter aduan: `pending`, `diproses`, `selesai` |
| `search` | string | — | `GET /api/admin/complaints` | Pencarian berdasarkan judul aduan (partial match, case-insensitive) |
| `category_id` | integer | — | `GET /api/admin/complaints` | Filter aduan berdasarkan kategori |

**Contoh:**

```http
GET /api/admin/complaints?status=pending&search=jalan&page=1&per_page=15
```

```http
GET /api/complaints?page=2&per_page=5
```

> **Catatan:** Parameter `status`, `search`, dan `category_id` hanya tersedia pada endpoint admin (`/api/admin/complaints`). Endpoint `/api/complaints` (user) hanya mendukung pagination (`page` & `per_page`) karena user hanya melihat aduan miliknya sendiri.

---

### 7.3 Request & Response Examples

#### POST /api/auth/login
```json
// Request Body
{
    "email": "user@example.com",
    "password": "password123"
}

// Response 200 OK
{
    "success": true,
    "message": "Login berhasil",
    "data": {
        "token": "1|abc123xyz...",
        "token_type": "Bearer",
        "user": {
            "id": 1,
            "name": "Budi Santoso",
            "email": "user@example.com",
            "role": "user"
        }
    }
}

// Response 422 Unprocessable Entity
{
    "success": false,
    "message": "Email atau password salah.",
    "errors": {
        "email": ["Email atau password salah."]
    }
}
```

#### GET /api/complaints
```json
// Response 200 OK
{
    "success": true,
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "title": "Jalan Rusak di RT 03",
                "description": "Jalan di depan gang 3 sudah berlubang...",
                "status": "diproses",
                "image": "complaints/abc123.jpg",
                "created_at": "2025-05-01T08:00:00.000Z",
                "category": {
                    "id": 1,
                    "name": "Infrastruktur"
                },
                "responses_count": 2
            }
        ],
        "per_page": 10,
        "total": 1
    }
}
```

#### POST /api/complaints

> **Content-Type:** `multipart/form-data` (bukan `application/json`) karena endpoint ini menerima upload gambar opsional.

```http
POST /api/complaints
Content-Type: multipart/form-data

--boundary
Content-Disposition: form-data; name="title"

Lampu Jalan Mati
--boundary
Content-Disposition: form-data; name="category_id"

3
--boundary
Content-Disposition: form-data; name="description"

Lampu jalan di RT 05 sudah mati sejak 2 minggu yang lalu dan berbahaya di malam hari.
--boundary
Content-Disposition: form-data; name="image"; filename="lampu.jpg"
Content-Type: image/jpeg

<binary file data>
--boundary--
```

```json
// Response 201 Created
{
    "success": true,
    "message": "Aduan berhasil dibuat",
    "data": {
        "id": 5,
        "user_id": 2,
        "category_id": 3,
        "title": "Lampu Jalan Mati",
        "description": "Lampu jalan di RT 05...",
        "status": "pending",
        "image": "complaints/lampu_abc123.jpg",
        "created_at": "2025-05-15T10:30:00.000Z"
    }
}
```

> **Akses Gambar dari API Client:**
> Field `image` pada response berisi path relatif dari `storage/app/public/`. Untuk mengakses gambar, gunakan URL:
> ```
> http://localhost:8000/storage/complaints/lampu_abc123.jpg
> ```
> Ini memerlukan symbolic link yang dibuat dengan perintah:
> ```bash
> php artisan storage:link
> ```
> Perintah ini membuat symlink `public/storage` → `storage/app/public/` sehingga file dapat diakses secara publik. Jalankan sekali setelah clone project atau setelah `composer install`.

#### PATCH /api/admin/complaints/{id}/status
```json
// Request Body
{
    "status": "diproses"
}

// Response 200 OK
{
    "success": true,
    "message": "Status aduan berhasil diperbarui",
    "data": {
        "id": 5,
        "status": "diproses",
        "updated_at": "2025-05-15T11:00:00.000Z"
    }
}
```

---

### 7.4 Rate Limiting

Untuk mencegah penyalahgunaan API, diterapkan rate limiting berbasis IP menggunakan middleware bawaan Laravel:

```php
// routes/api.php
Route::middleware('throttle:60,1')->group(function () {
    // semua endpoint API
});
```

| Aturan | Nilai |
|---|---|
| Maksimum request | 60 requests per menit per IP |
| Response saat limit tercapai | HTTP 429 Too Many Requests |
| Header response | `X-RateLimit-Limit`, `X-RateLimit-Remaining` |

### 7.5 Error Handling & HTTP Status Codes

| Kode | Kondisi | Response Body |
|---|---|---|
| 200 | Operasi sukses | `{"success": true, "data": {...}}` |
| 201 | Resource berhasil dibuat | `{"success": true, "message": "...", "data": {...}}` |
| 401 | Token tidak valid / expired | `{"success": false, "message": "Unauthenticated."}` |
| 403 | Role tidak memiliki akses | `{"success": false, "message": "Forbidden."}` |
| 404 | Resource tidak ditemukan | `{"success": false, "message": "Not found."}` |
| 422 | Validasi gagal | `{"success": false, "message": "...", "errors": {...}}` |
| 429 | Rate limit tercapai | `{"success": false, "message": "Too many requests."}` |
| 500 | Internal server error | `{"success": false, "message": "Server error."}` |

**Web error pages:** Menggunakan view kustom di `resources/views/errors/` untuk halaman 404, 403, dan 500 dengan layout yang konsisten.

### 7.6 Strategi Caching

Untuk mengoptimalkan performa, diterapkan caching pada data yang jarang berubah:

```php
// Kategori — di-cache permanen, dihapus saat admin mengubah data
$categories = Cache::rememberForever('complaint_categories', fn() =>
    ComplaintCategory::withCount('complaints')->get()
);

// Statistik dashboard admin — cache 5 menit
$stats = Cache::remember('admin_stats', 300, fn() => [
    'total'      => Complaint::count(),
    'pending'    => Complaint::where('status', 'pending')->count(),
    'diproses'   => Complaint::where('status', 'diproses')->count(),
    'selesai'    => Complaint::where('status', 'selesai')->count(),
]);
```

Cache dihapus secara selektif setiap kali admin melakukan operasi yang memengaruhi data:

```php
// Di CategoryController — hapus cache kategori saat data berubah
public function store(StoreCategoryRequest $request): RedirectResponse
{
    ComplaintCategory::create($request->validated());
    Cache::forget('complaint_categories');  // invalidasi spesifik
    return redirect()->route('admin.categories.index');
}

// Di ComplaintController — hapus cache statistik saat status berubah
public function updateStatus(Request $request, Complaint $complaint): RedirectResponse
{
    $complaint->update(['status' => $request->status]);
    Cache::forget('admin_stats');           // invalidasi spesifik
    return redirect()->route('admin.complaints.show', $complaint);
}
```

> Gunakan `Cache::forget()` secara spesifik, bukan `Cache::flush()`. Flush menghapus seluruh cache termasuk data yang tidak perlu di-invalidasi.

---

## 8. UI/UX Flow & Wireframe Description

### 8.1 Flow Diagram

```
[GUEST]
   │
   ├── /login ──────────────────────► [Admin Dashboard]
   │                                        │
   └── /register ──► /login                 ├── Lihat Semua Aduan
                         │                  ├── Filter by Status
                         ▼                  ├── Detail Aduan
                  [User Dashboard]          │     └── Update Status
                         │                  │     └── Beri Tanggapan
                         ├── My Complaints  └── CRUD Kategori
                         │     ├── Create
                         │     ├── View Detail
                         │     ├── Edit (jika pending)
                         │     └── Delete (jika pending)
                         └── About
```

### 8.2 Halaman & Komponen

#### Layout Admin (`layouts/admin.blade.php`)
- Sidebar navigasi: Dashboard | Complaints | Categories | About
- Header dengan nama admin + tombol logout
- Flash message area (success/error)
- Breadcrumb

#### Layout User (`layouts/app.blade.php`)
- Navbar: Dashboard | My Complaints | About | Logout
- Flash message area
- Footer

#### Admin Dashboard
- **Stat Cards (4 buah):**
  - Total Aduan (warna biru)
  - Pending (warna kuning)
  - Diproses (warna oranye)
  - Selesai (warna hijau)
- **Tabel Aduan Terbaru** (5 baris)

#### Admin – Daftar Aduan
- Filter dropdown (All/Pending/Diproses/Selesai)
- Search bar (berdasarkan judul)
- Tabel: No | Pelapor | Judul | Kategori | Status | Tanggal | Aksi
- Badge status berwarna
- Tombol "Detail" per baris

#### Admin – Detail Aduan
- Info Card: Judul, Pelapor, Kategori, Tanggal, Status
- Dropdown + tombol "Update Status"
- Section "Tanggapan" dengan list tanggapan + avatar admin
- Form textarea "Tambah Tanggapan"

#### Admin – Kelola Kategori
- Tabel: No | Nama | Jumlah Aduan | Aksi (Edit/Hapus)
- Tombol "+ Tambah Kategori"
- Halaman create/edit kategori (form 1 field: nama)

#### User – Dashboard
- Greeting card dengan nama user
- Mini stat: Total Aduanku | Pending | Diproses | Selesai
- Tombol besar "Buat Aduan Baru"

#### User – Daftar Aduan
- Card-based list (bukan tabel)
- Setiap card: Judul | Kategori | Tanggal | Badge Status
- Tombol "Detail", "Edit" (jika pending), "Hapus" (jika pending)

#### User – Form Aduan
- Input: Judul
- Select: Kategori
- Textarea: Deskripsi
- Input file: Upload Gambar (opsional, preview thumbnail)
- Tombol Submit + Kembali

#### User – Detail Aduan
- Info lengkap aduan
- Status badge besar
- Timeline tanggapan admin (chat bubble style)

#### Halaman About (User & Admin)
- Halaman statis berisi informasi tentang aplikasi LaporIn
- Menjelaskan tujuan platform, cara kerja, dan kontak pengelola
- Dapat diakses tanpa login (guest) maupun setelah login
- Tidak memiliki fungsionalitas dinamis — murni informasional

---

## 9. Timeline & Milestone

| Minggu | Tahap | Target |
|---|---|---|
| 1 | Setup & Foundation | Install Laravel, konfigurasi DB, setup auth Breeze, migration, seeder |
| 2 | Core User Features | Register/Login, CRUD Complaint (user) + upload gambar, halaman list & detail |
| 3 | Admin Panel | CRUD Kategori, Lihat semua aduan, update status, beri response |
| 4 | API Development | Endpoint auth, complaints, categories, responses dengan Sanctum + rate limiting |
| 5 | UI Polish & Gate | Tailwind styling, Gate/Policy, filter, badge status, error pages |
| 6 | Testing & Finalisasi | Unit test, integration test, bug fix, dokumentasi, deployment ke shared hosting |
| 7 | **Buffer & Review** | Cadangan untuk bug kritis, revisi dosen pembimbing, finalisasi laporan |

> **Catatan Realistis:** Minggu 1 adalah minggu dengan risiko *slippage* tertinggi. Setup environment (XAMPP/Laragon, Composer, Node, database) sering memakan waktu tak terduga — terutama jika ada perbedaan versi atau konflik dependensi. Jika Week 1 molor, jangan mengorbankan Week 2; sebagai gantinya, kurangi scope minor (misalnya: tunda custom error pages ke Week 5, atau kurangi jumlah seeder data). Jangan pernah memperpendek Week 6 (Testing) karena testing yang terburu-buru hampir selalu menghasilkan bug yang lebih mahal diperbaiki setelah deployment.

### 9.1 Rencana Pengujian (Testing Plan)

| Jenis Test | Tools | Cakupan | Target |
|---|---|---|---|---|
| Unit Test | PHPUnit | Model (relasi, scope, accessor), Form Request validation rules, Gate & Policy authorization logic | >80% code coverage untuk Models dan Policies |
| Integration Test | PHPUnit | Controller actions (status code, redirect, session flash), middleware gate, role-based access control | Semua use case utama |
| Security/Auth Test | PHPUnit | **Authorisasi negatif:** user tidak bisa akses route admin, user tidak bisa edit/hapus aduan user lain, user tidak bisa update status, guest tidak bisa akses endpoint authenticated, admin tidak bisa membuat aduan atas nama user lain | Semua Gate & Policy harus di-cover |
| Manual UAT | Checklist manual | 3 skenario: user membuat aduan + upload gambar, admin update status + beri tanggapan, user memantau progres | Dijalankan oleh 2 orang (developer + 1 orang luar) |

**Skenario UAT:**
1. **User membuat aduan** — Register → login → buat aduan dengan upload gambar → lihat di daftar aduan → verifikasi status `pending`
2. **Admin menindaklanjuti** — Login admin → filter aduan pending → buka detail → ubah status ke `diproses` → tambah tanggapan → verifikasi tanggapan muncul
3. **User memantau progres** — Login user → buka detail aduan → verifikasi status berubah menjadi `diproses` → lihat tanggapan admin

**Skenario Negative Test (Authorization):**

| ID | Skenario | Expected Result |
|---|---|---|
| NEG-01 | User mencoba akses `/admin/dashboard` | Redirect ke `/user/dashboard` atau 403 |
| NEG-02 | User mencoba akses `/admin/complaints` | Redirect atau 403 |
| NEG-03 | User mencoba edit aduan user lain via URL `/user/complaints/{id}/edit` | 403 Forbidden |
| NEG-04 | User mencoba hapus aduan yang sudah `diproses` | 403 Forbidden (hanya `pending` yang bisa dihapus) |
| NEG-05 | User mencoba update status aduan via API | 403 Forbidden |
| NEG-06 | Guest (belum login) mengakses `/user/dashboard` | Redirect ke `/login` |
| NEG-07 | Guest mengakses API endpoint dengan token invalid | 401 Unauthenticated |
| NEG-08 | Admin mencoba membuat aduan di endpoint `/user/complaints/create` | Redirect atau 403 (admin tidak punya akses user routes) |

---

## 10. Risiko & Mitigasi

| Risiko | Dampak | Kemungkinan | Mitigasi |
|---|---|---|---|
| Scope creep (fitur bertambah) | Tinggi | Sedang | Tetap di scope yang sudah ditentukan, fitur tambahan jadi backlog |
| Bug pada relasi Eloquent | Sedang | Rendah | Gunakan `with()` eager loading, test dengan Tinker |
| Konflik role (user akses admin) | Tinggi | Rendah | Middleware `IsAdmin` di semua route admin + Gate |
| Database tidak konsisten | Tinggi | Rendah | Gunakan Foreign Key Constraint + Migration |
| API tidak aman | Tinggi | Sedang | Sanctum token, validate input, rate limiting |
| Deadline tidak tercapai | Tinggi | Sedang | Prioritaskan FR utama, non-essential di akhir |

---

> **Dokumen ini dibuat untuk keperluan proyek akhir LaporIn.**
> Versi: 1.0.0 | Framework: Laravel 11 | Database Tool: MySQL Workbench
