# Website Profil Laboratorium APTRG Telkom University

Website profil resmi (*company-profile style*) untuk **Laboratorium APTRG (Aeromodelling and Payload Telemetry Research Group) Telkom University**. Laboratorium ini berada di bawah naungan Fakultas Teknik Elektro, Telkom University, Bandung dengan fokus riset pada UAV (pesawat tanpa awak), aeromodelling, payload telemetry, aerial robotics, image vision, serta monitoring & surveillance.

Tagline Resmi: **"Fight Together, Win Together, Yes We Can"**  
Instagram Resmi: **@aptrg**

---

## ⚠️ Keputusan Desain Penting

1. **Aturan Flat Solid Design Mutlak (Tanpa Gradient)**:
   - DILARANG KERAS menggunakan gradient dalam bentuk apa pun (`bg-gradient-*`, `linear-gradient`, overlay gradient) pada seluruh halaman, kartu, tombol, maupun hero section.
   - Semua elemen UI menggunakan warna **flat solid color** yang bersih dan tegas.
2. **Palet Warna Resmi (Merah–Putih Identitas Indonesia & APTRG)**:
   - `primary`: `#C1121F` (Merah utama untuk tombol, aksen, garis bawah judul)
   - `primary-dark`: `#8E0D17` (Hover & state aktif)
   - `primary-light`: `#F7E4E6` (Background section lembut)
   - `ink`: `#111111` (Teks judul utama)
   - `body`: `#4B4B4B` (Teks paragraf)
   - `line`: `#E5E5E5` (Border & divider)
   - `surface`: `#FFFFFF` (Kartu & komponen putih solid)
   - `canvas`: `#F7F7F7` (Background section abu netral)
3. **Data dari Database (Tanpa Hardcode Blade)**:
   - Seluruh data konten (profil lab, 4 divisi, 5 tim KRTI, prestasi 2019–2025, dan struktur kepengurusan) bersumber dari database MySQL melalui Eloquent Model dan Seeder.
4. **Org Chart Murni CSS Border**:
   - Struktur kepengurusan pada desktop (`>= lg`) menggunakan bagan pohon vertikal dengan garis penghubung dari CSS border murni, tanpa library chart eksternal.
   - Pada perangkat mobile (`< lg`), bagan bertransformasi otomatis menjadi list vertikal bertingkat dengan indentasi per level.

---

## 🛠️ Tech Stack

| Item | Teknologi | Keterangan |
|---|---|---|
| **Framework** | Laravel 11 | Backend PHP framework |
| **Template Engine** | Blade + Blade Components | Desain komponen reusable (`x-layout.app`, `x-card`, dll) |
| **Styling CSS** | Tailwind CSS v3 | Flat solid design via Vite |
| **Interaktivitas JS** | Alpine.js | Mobile menu, filter client-side tanpa reload |
| **Database** | MySQL | Relational database dengan migrasi lengkap |
| **Aset Visual** | SVG Lokal Inline | Logo dan placeholder flat solid (offline compatible) |

---

## 🚀 Cara Instalasi & Menjalankan Proyek

1. **Kloning Proyek & Masuk ke Folder:**
   ```bash
   cd "D:\APTRG\WEBSITE APTRG"
   ```

2. **Install Dependensi PHP & Node.js:**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment (`.env`):**
   Salin file `.env.example` ke `.env` (jika belum ada) dan atur koneksi database MySQL:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=aptrg_web
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

5. **Jalankan Migrasi & Seeder Data Dummy:**
   Pastikan database MySQL `aptrg_web` sudah dibuat, kemudian jalankan:
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Build Aset Frontend (Vite):**
   - Untuk production static build:
     ```bash
     npm run build
     ```
   - Untuk development / hot-reload:
     ```bash
     npm run dev
     ```

7. **Jalankan Web Server Laravel:**
   ```bash
   php artisan serve
   ```
   Website dapat diakses pada browser di URL: `http://localhost:8000`

---

## 🗄️ Struktur Database & Relasi

1. **`lab_profiles` (Singleton - 1 baris):**
   - Menyimpan nama lab, singkatan, tagline, fakultas, tahun berdiri, tentang, visi, misi (JSON), fokus riset (JSON), kontak, dan alamat.
2. **`divisions` (4 Divisi Internal):**
   - Divisi Mekanik, Sistem, GCS, dan Non-Technical.
   - Kolom: `slug`, `name`, `short_description`, `description`, `responsibilities` (JSON), `icon`, `image_path`, `order`.
   - Relasi: `hasMany(Member::class)`.
3. **`competition_teams` (5 Tim KRTI):**
   - Frigate (RP), Bangau (FW), Raven (VTOL), Strix (LELA), Falcon (TD).
   - Kolom: `slug`, `team_name`, `krti_division`, `krti_code`, `aircraft_type`, `tagline`, `description`, `mission_theme`, `specs` (JSON), `logo_path`, `image_path`, `order`.
   - Relasi: `hasMany(Achievement::class)`.
4. **`achievements` (Daftar Prestasi):**
   - Kolom: `title`, `competition`, `year`, `rank`, `category`, `level` ('Nasional','Internasional'), `competition_team_id` (FK nullable), `description`.
   - Relasi: `belongsTo(CompetitionTeam::class)`.
5. **`members` (Struktur Kepengurusan Hierarkis):**
   - Hierarki 4 level: Kapten (L1) → Wakil Internal & Eksternal (L2) → Sekretaris & Bendahara (L3) → 4 Koordinator Divisi (L4).
   - Kolom: `name`, `position`, `level`, `parent_id` (FK self-referencing nullable), `division_id` (FK nullable), `study_program`, `batch`, `photo_path`, `order`.
   - Relasi: `belongsTo(Member::class, 'parent_id')`, `hasMany(Member::class, 'parent_id')`, `belongsTo(Division::class)`.

---

## 🗺️ Daftar Route & Halaman

| Route URL | Route Name | Controller | Keterangan Halaman |
|---|---|---|---|
| `/` | `home` | `HomeController@index` | Hero, statistik lab, ringkasan profil, preview 4 divisi, preview 5 tim KRTI, 3 prestasi terbaru, CTA Instagram |
| `/profil` | `profile` | `ProfileController@index` | Sejarah lab, visi, misi, fokus riset multidisiplin, lokasi & kontak |
| `/divisi` | `divisions.index` | `DivisionController@index` | Galeri sinematik "Timed Cards" (GSAP, klik-saja) 4 divisi internal; mobile memakai daftar kartu sederhana |
| `/divisi/{slug}` | `divisions.show` | `DivisionController@show` | Detail divisi lengkap, daftar tanggung jawab, dan profil koordinator divisi |
| `/tim-krti` | `teams.index` | `CompetitionTeamController@index` | Accordion horizontal interaktif (Alpine) 5 tim lomba; mobile memakai accordion vertikal |
| `/tim-krti/{slug}` | `teams.show` | `CompetitionTeamController@show` | Detail tim KRTI, deskripsi, tema misi, tabel spesifikasi teknis, dan prestasi tim |
| `/prestasi` | `achievements.index` | `AchievementController@index` | Daftar prestasi 2019–2025 dengan filter interaktif client-side Alpine.js tanpa reload |
| `/struktur` | `structure` | `StructureController@index` | Bagan struktur kepengurusan hierarkis (pohon CSS desktop, list indent mobile) |

---

## ✅ Requirement & Status Implementasi

| Fitur / Modul | Status | Keterangan |
|---|---|---|
| **Konfigurasi Laravel 11 & Tailwind CSS v3** | ✅ Selesai | Menggunakan palet merah-putih flat solid (tanpa gradient) |
| **Skema Database & Migrasi (5 Tabel)** | ✅ Selesai | `lab_profiles`, `divisions`, `competition_teams`, `achievements`, `members` |
| **Seeder Data Resmi & Dummy** | ✅ Selesai | Seeder lengkap sesuai ketentuan Bagian 4 & 5 spesifikasi |
| **Aset Dummy SVG Lokal** | ✅ Selesai | Semua SVG dibuat manual di `public/images/` dengan warna flat solid |
| **Blade Reusable Components** | ✅ Selesai | Layout utama, navbar, footer, card, badge, stat, org-node |
| **8 Halaman Publik Lengkap** | ✅ Selesai | Semua route diuji dan dapat diakses dengan desain responsif |
| **Filter Prestasi Interaktif Client-Side** | ✅ Selesai | Filter berdasarkan tahun dan kompetisi memakai Alpine.js tanpa reload |
| **Org Chart Tree CSS Murni** | ✅ Selesai | Bagan vertikal di desktop dan list bertingkat di mobile |
| **Halaman Divisi → accordion full-height interaktif (Alpine)** | ✅ Selesai | Desktop: 4 panel accordion horizontal ~78vh, hover/klik memperlebar panel aktif (animasi 500ms) berisi ikon + nomor + judul + deskripsi + 3 tanggung jawab + koordinator + tombol Detail; panel nonaktif jadi strip (nomor + ikon + nama vertikal). **Mobile fallback**: berubah jadi accordion vertikal yang membuka ke bawah |
| **Redesign halaman detail Divisi** | ✅ Selesai | Hero menyatu + overlay solid, spotlight koordinator menimpa hero, body 2 kolom (konten + sidebar sticky), tanggung jawab list garis merah, galeri variatif |
| **Lazy loading gambar** | ✅ Selesai | Native `loading="lazy"` + `decoding="async"` pada foto below-the-fold (galeri, org chart, kartu tim); hero divisi tetap eager + `fetchpriority="high"` |
| **Divisi → animasi Timed Cards (GSAP, klik-saja) + fallback mobile** | ✅ Selesai | Desktop `/divisi`: background fullscreen divisi aktif (foto asli divisi), antrian kartu kanan-bawah bisa diklik, panel detail kiri-bawah, panah navigasi; TANPA auto-play. Mobile (<768px): daftar kartu sederhana. Kolom `video_path` (nullable) di `competition_teams` disiapkan untuk tahap video |
| **Tim Lomba → accordion full-height interaktif (Alpine)** | ✅ Selesai | Desktop `/tim-krti`: 5 panel accordion horizontal ~72vh (logo strip vertikal, panel aktif berisi logo + nomor + nama + divisi KRTI + tagline + deskripsi + 3 spesifikasi + tombol detail). Mobile: accordion vertikal |

---

## 📋 Roadmap Pengembangan Lanjutan

- 📋 **Admin Panel CRUD**: Pengelolaan data profil, divisi, tim, prestasi, dan pengurus tanpa menyentuh seeder.
- 📋 **Upload Aset Asli**: Penggantian logo dummy SVG dan foto pengurus dengan aset asli laboratorium.
- 📋 **Halaman Galeri Kegiatan**: Fitur penayangan dokumentasi penerbangan, uji wahana, dan aktivitas lab.
- 📋 **Integrasi Feed Instagram**: Sinkronisasi otomatis postingan kegiatan terbaru dari akun `@aptrg`.

---

## 📝 Changelog

### v1.2.1 (21 Juli 2026)
- **Tukar animasi halaman Divisi ↔ Tim Lomba**: `/divisi` kini memakai galeri sinematik **Timed Cards** (GSAP, klik-saja, foto asli divisi sebagai background fullscreen, data via `window.TC_ITEMS`), sedangkan `/tim-krti` memakai **accordion horizontal interaktif** (Alpine) yang sebelumnya milik halaman Divisi. Komponen baru `x-team-panel-body` (logo + nomor + divisi KRTI + tagline + 3 spesifikasi + tombol detail); `initTimedCards()` dibuat generik (`window.TC_ITEMS || window.TEAMS`).

### v1.2.0 (21 Juli 2026)
- **Halaman `/tim-krti` dirombak jadi galeri sinematik "Timed Cards"** (adaptasi pen Juxtopposed, GSAP core tanpa ScrollTrigger): background fullscreen = media tim aktif, antrian kartu kanan-bawah **bisa diklik** untuk dijadikan aktif (tanpa auto-play), panel kiri-bawah berisi nama/divisi/deskripsi + tombol "Lihat Misi & Spesifikasi", panah navigasi manual + progress bar + nomor slide. Scene di-scope `.tc-scene` (`position:fixed` + `isolation:isolate`) agar navbar tetap di atas; **mobile (<768px) memakai layout daftar kartu terpisah** (`.tc-mobile`).
- Kolom baru `competition_teams.video_path` (nullable, migration terpisah) untuk tahap video background berikutnya; data JS dikirim via `@json($teamsData)` dari `CompetitionTeamController@index` dengan fallback media ke foto lab yang sudah ada (digilir per tim, placeholder generik diabaikan).
- Dependensi baru: `gsap`; font `Oswald` (Google Fonts) untuk judul besar.

### v1.1.0 (17 Juli 2026)
- Redesign kartu halaman `/divisi` menjadi **split card**: panel merah flat solid `#C1121F` di kiri (ikon khas divisi + nomor urut 2 digit), konten di kanan (judul, deskripsi singkat, chip tanggung jawab maks 3 + "+N lainnya", link "Lihat detail" dengan panah bergeser saat hover).
- Komponen baru: `x-division-icon` (inline SVG heroicons outline: wrench / cpu / signal / megaphone) dan `x-division-card`.
- Seeder divisi diperbarui: kolom `icon` memakai key `wrench`, `cpu`, `signal`, `megaphone`; `image_path` diarahkan ke foto asli divisi.
- Redesign halaman detail `/divisi/{slug}`: hero menyatu dengan overlay solid, **spotlight koordinator** menimpa tepi bawah hero, body dua kolom (konten + sidebar "Sekilas Divisi" sticky), tanggung jawab jadi list beraksen garis merah, dan galeri variatif (1 foto utama + 2 thumbnail).
- **Lazy loading gambar** di seluruh site: atribut native `loading="lazy"` + `decoding="async"` pada gambar below-the-fold (galeri divisi, ilustrasi wahana, foto org chart struktur, logo kartu tim, footer). Gambar hero divisi tetap eager dengan `fetchpriority="high"` agar tampil instan. Tanpa library/JS eksternal.
- **Halaman `/divisi` dirombak jadi accordion full-height interaktif** (Alpine.js): 4 panel horizontal ~78vh di desktop yang melebar saat hover/klik dengan animasi `transition-[flex-grow]` 500ms, dan **fallback accordion vertikal** di mobile. Komponen baru `x-division-panel-body`; relasi `Division::coordinator()` (Member level 4) + accessor `Member::initials` untuk avatar fallback inisial. Komponen `x-division-card` yang lama dihapus (tidak terpakai).

### v1.0.0 (13 Juli 2026)
- Pembangunan awal website profil Laboratorium APTRG Telkom University berbasis Laravel 11 + Tailwind CSS v3 + Alpine.js.
- Implementasi desain visual flat solid color merah-putih (#C1121F) mutlak tanpa gradient.
- Pembuatan 5 tabel database dan seeder data dummy untuk profil, divisi, tim KRTI, prestasi, dan struktur organisasi.
- Implementasi 8 route publik dan bagan organisasi CSS border murni yang responsif.
