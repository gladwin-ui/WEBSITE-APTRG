# PROMPT: Website Profil Laboratorium APTRG (Laravel)

## ROLE
Kamu adalah senior Laravel + frontend engineer. Bangun sebuah **website profil (company-profile style) untuk Laboratorium APTRG Telkom University** dari nol, dengan **data dummy** dan **logo/foto dummy** (belum ada aset asli).

---

## 1. KONTEKS PROYEK

**APTRG** = *Aeromodelling and Payload Telemetry Research Group* — laboratorium riset di bawah Fakultas Teknik Elektro, Telkom University, Bandung.
Fokus: UAV / pesawat tanpa awak, aeromodelling, payload telemetry, aerial robotics, image vision, monitoring & surveillance.
Tagline resmi: **"Fight Together, Win Together, Yes We Can"**
Instagram: `@aptrg`

Website ini adalah **etalase publik** lab: profil, divisi, tim lomba, prestasi, dan struktur kepengurusan.

---

## 2. TECH STACK (WAJIB)

| Item | Ketentuan |
|---|---|
| Framework | Laravel 11 (atau 12 jika default installer) |
| Template engine | Blade + Blade Components |
| CSS | **Tailwind CSS v3** via Vite (JANGAN Tailwind v4, JANGAN Bootstrap) |
| JS | Alpine.js (hanya untuk mobile menu, accordion, filter) |
| Database | MySQL |
| Data | **Seeder dummy** (Model + Migration + Seeder). JANGAN hardcode data di Blade |
| Icon | SVG inline (heroicons style), JANGAN pakai font-icon CDN |
| Auth / Admin panel | **TIDAK ADA** di fase ini. Website read-only publik |

---

## 3. ATURAN DESAIN UI (KERAS — JANGAN DILANGGAR)

1. **DILARANG menggunakan gradient sama sekali.** Tidak ada `bg-gradient-*`, tidak ada `linear-gradient`, tidak ada gradient overlay pada hero/card/button. Semua warna adalah **flat solid color**.
2. Palet warna **merah–putih** (identitas Indonesia + APTRG):

```js
// tailwind.config.js -> theme.extend.colors
colors: {
  primary: {
    DEFAULT: '#C1121F', // merah utama (button, aksen, heading bar)
    dark:    '#8E0D17', // hover / state aktif
    light:   '#F7E4E6', // background section lembut (flat, bukan gradient)
  },
  ink:  '#111111',      // teks utama
  body: '#4B4B4B',      // teks paragraf
  line: '#E5E5E5',      // border / divider
  surface: '#FFFFFF',   // background kartu
  canvas:  '#F7F7F7',   // background section abu netral
}
```

3. Style bahasa visual: **flat, clean, bersih, tegas.**
   - Kartu: `bg-surface` + `border border-line` + `rounded-lg`. Boleh shadow tipis (`shadow-sm`), **tanpa** shadow berwarna.
   - Button primary: `bg-primary text-white hover:bg-primary-dark`. Button secondary: `border border-primary text-primary hover:bg-primary hover:text-white`.
   - Hero: background **putih solid** atau **merah solid**, dengan garis aksen merah tebal. Tidak ada gradient, tidak ada image-overlay gradient.
   - Aksen berulang: garis merah setebal 4px di bawah judul section.
4. **Responsive mobile-first** (breakpoint: mobile 1 kolom → `md` 2 kolom → `lg` 3–4 kolom). Navbar jadi hamburger menu (Alpine) di bawah `md`. Tes mental di 360px, 768px, 1280px.
5. Tipografi: font sans (Inter / Figtree bawaan Laravel). Heading `font-bold tracking-tight`, body `leading-relaxed`.
6. Aksesibilitas dasar: kontras cukup, `alt` pada semua gambar, `aria-label` pada tombol icon.

---

## 4. STRUKTUR DATABASE

### 4.1 `lab_profiles` (singleton — 1 row)
| kolom | tipe |
|---|---|
| id | id |
| name | string — "Aeromodelling and Payload Telemetry Research Group" |
| abbreviation | string — "APTRG" |
| tagline | string — "Fight Together, Win Together, Yes We Can" |
| faculty | string — "Fakultas Teknik Elektro, Telkom University" |
| founded_year | year |
| about | text (2–3 paragraf) |
| vision | text |
| mission | json (array of string) |
| research_focus | json (array of string: Aerorobotik, Sistem Telemetri, Image Vision, Monitoring & Surveillance, Autonomous System) |
| logo_path | string (dummy) |
| instagram | string |
| email | string |
| address | string |

### 4.2 `divisions` (4 divisi internal lab)
| kolom | tipe |
|---|---|
| id, slug, name | — |
| short_description | string |
| description | text |
| responsibilities | json (array of string) |
| icon | string (nama key svg component) |
| image_path | string (dummy) |
| order | integer |

### 4.3 `competition_teams` (tim lomba KRTI)
| kolom | tipe |
|---|---|
| id, slug | — |
| team_name | string — "Frigate", "Bangau", dst |
| krti_division | string — "Racing Plane" |
| krti_code | string — "RP" |
| aircraft_type | string — "Fixed Wing High-Speed" dst |
| tagline | string |
| description | text |
| mission_theme | text (tema misi divisi KRTI) |
| specs | json (key-value: Wingspan, Propulsi, Payload, Kecepatan, Endurance) |
| logo_path | string (dummy) |
| image_path | string (dummy) |
| order | integer |

### 4.4 `achievements`
| kolom | tipe |
|---|---|
| id | — |
| title | string |
| competition | string — "KRTI", "KOMURINDO", "TEKNOFEST" |
| year | year |
| rank | string — "Juara 1", "Juara 2", "Juara 3", "Juara Harapan 1", "Best Design" |
| category | string — "Divisi Fixed Wing – Kelas Mapping" |
| level | enum('Nasional','Internasional') |
| competition_team_id | foreignId nullable → competition_teams |
| description | text nullable |

### 4.5 `members` (struktur kepengurusan — self-referencing tree)
| kolom | tipe |
|---|---|
| id | — |
| name | string |
| position | string — "Kapten", "Wakil Kapten Internal", "Wakil Kapten Eksternal", "Sekretaris", "Bendahara", "Koordinator Divisi Mekanik", dst |
| level | tinyint — 1=Kapten, 2=Wakil, 3=Sekretaris/Bendahara, 4=Koordinator |
| parent_id | foreignId nullable → members (self) |
| division_id | foreignId nullable → divisions |
| study_program | string — "S1 Teknik Telekomunikasi" dst |
| batch | string — "2022" |
| photo_path | string (dummy) |
| order | integer |

**Hierarki wajib (level & parent):**
```
Kapten (L1)
├── Wakil Kapten Internal (L2)
│    ├── Sekretaris (L3)
│    └── Bendahara (L3)
└── Wakil Kapten Eksternal (L2)
     ├── Koordinator Divisi Mekanik (L4)
     ├── Koordinator Divisi Sistem (L4)
     ├── Koordinator Divisi GCS (L4)
     └── Koordinator Divisi Non-Technical (L4)
```
> Catatan: keempat Koordinator di-parent-kan ke Wakil Eksternal agar tree rapi, tapi **secara visual di org chart, Sekretaris & Bendahara diletakkan sejajar di baris ke-3, dan 4 Koordinator sejajar di baris ke-4 di bawah keduanya**, sesuai urutan: Kapten → Wakil Internal & Wakil Eksternal → Sekretaris & Bendahara → 4 Koordinator.

---

## 5. ISI DATA DUMMY (PAKAI PERSIS INI)

### 5.1 Divisi Internal Lab (4)

**1. Divisi Mekanik**
- Short: Perancangan, fabrikasi, dan pemeliharaan wahana terbang.
- Deskripsi: Divisi yang bertugas merancang struktur wahana, membangun airframe, serta memelihara alat. Anggotanya juga bertindak sebagai pilot utama wahana.
- Responsibilities: `["Merancang desain dan struktur wahana", "Perancangan sistem aktuator dan elektronika wahana", "Pengimplementasian pembuatan/fabrikasi wahana", "Pemeliharaan alat dan perkakas mekanik", "Menjadi pilot dan operator wahana"]`

**2. Divisi Sistem**
- Short: Sistem kendali, telemetri, dan autonomous wahana.
- Deskripsi: Divisi yang menangani kesatuan komponen elektronik dan perangkat lunak yang menghubungkan aliran informasi, materi, dan energi pada wahana.
- Responsibilities: `["Merancang dan konfigurasi sistem kendali wahana", "Merancang dan konfigurasi sistem telemetri", "Menentukan konfigurasi sistem autonomous", "Power budget, sistem elektronika, dan integrasi sensor"]`

**3. Divisi GCS (Ground Control Station)**
- Short: Pusat kendali darat dan pengolahan data penerbangan.
- Deskripsi: Divisi yang menyediakan fasilitas kendali wahana autopilot dari darat, mengirim command, serta menerjemahkan data telemetri menjadi visualisasi yang mudah dipahami.
- Responsibilities: `["Konfigurasi wahana terbang", "Berkomunikasi dengan wahana terbang", "Menerima data dan mengirim command", "Menerjemahkan data menjadi grafik/tampilan", "Menyimpan data untuk keperluan analisis"]`

**4. Divisi Non-Technical**
- Short: Keorganisasian, media, dan manajemen lab.
- Deskripsi: Divisi yang mengelola keorganisasian lab: perencanaan kegiatan, administrasi, kearsipan, dokumentasi, dan media. Tetap fleksibel untuk ikut riset bersama divisi lain.
- Responsibilities: `["Menyusun rencana kegiatan lab", "Pengelolaan surat-menyurat dan kearsipan", "Aerial shooting dan dokumentasi", "Unit manager dan branding lab", "Pengelolaan media sosial dan kerja sama"]`

### 5.2 Tim Lomba KRTI (5 — data faktual divisi KRTI)

> KRTI (Kontes Robot Terbang Indonesia, Kemdiktisaintek) memperlombakan 5 divisi: **Racing Plane (RP), Fixed-Wing (FW), Vertical Take-off and Landing (VTOL), Technology Development (TD), dan Long Endurance Low Altitude (LELA).**

| Tim | Divisi KRTI | Kode | Tema/Misi |
|---|---|---|---|
| **Frigate Team** | Racing Plane | RP | F.A.T (*Fast And on Track*) — wahana tercepat menyelesaikan lintasan. Fokus: pesawat cepat, lincah, gesit, manuver presisi di sirkuit udara. |
| **Bangau Team** | Fixed Wing | FW | Misi mapping, monitoring, dan pengiriman paket darurat (*dropping*) di wilayah bencana secara autonomous. |
| **Raven Team** | VTOL | VTOL | Wahana yang mampu take-off & landing vertikal, misi utama *pick and drop* serta terbang otonom di dalam ruangan. |
| **Strix Team** | Long Endurance Low Altitude | LELA | Pemanfaatan UAV *long endurance* terbang rendah untuk misi validasi *hot spot* (titik panas / kebakaran hutan) jarak jauh. |
| **Falcon Team** *(opsional, tandai sebagai tim ke-5)* | Technology Development | TD | Kemandirian teknologi pesawat tanpa awak: pengembangan Flight Controller, Propulsion System, dan Airframe Innovation. |

Specs dummy (contoh untuk tiap tim, variasikan angkanya):
`{"Wingspan": "1.200 mm", "Propulsi": "Brushless 2216 KV1400", "Payload": "500 g", "Kecepatan Maks": "120 km/jam", "Endurance": "18 menit"}`

### 5.3 Prestasi (minimal 10 row dummy, campur tahun 2019–2025)
Contoh pola:
- Juara 1 — KRTI 2024 — Divisi Racing Plane — Nasional — tim Frigate
- Juara 2 — KRTI 2024 — Divisi Fixed Wing Kelas Monitoring — Nasional — tim Bangau
- Juara 3 — KRTI 2023 — Divisi VTOL Kelas Non Water-Based Fire Extinguisher — Nasional — tim Raven
- Juara Harapan 1 — KRTI 2023 — Divisi LELA — Nasional — tim Strix
- Best Design — KRTI 2022 — Divisi Technology Development — Nasional — tim Falcon
- Juara 4 — KOMURINDO 2021 — Kategori Muatan Roket — Nasional — (tanpa tim)
- dst. (nama tim & tahun boleh dummy, tapi format harus konsisten)

### 5.4 Anggota Kepengurusan (9 orang, nama dummy Indonesia)
Kapten, Wakil Internal, Wakil Eksternal, Sekretaris, Bendahara, + 4 Koordinator (Mekanik, Sistem, GCS, Non-Technical).

---

## 6. HALAMAN & ROUTE

| Route | Nama | Isi |
|---|---|---|
| `/` | `home` | Hero (nama lab + tagline + CTA), ringkasan profil, **stat counter** (4 Divisi, 5 Tim KRTI, N Prestasi, Est. tahun), preview 4 divisi, preview 3 prestasi terbaru, preview tim KRTI, CTA Instagram |
| `/profil` | `profile` | Tentang lab, Visi, Misi (list), Fokus riset (grid kartu), lokasi & kontak |
| `/divisi` | `divisions.index` | Grid 4 kartu divisi |
| `/divisi/{slug}` | `divisions.show` | Detail divisi + list tanggung jawab + koordinator divisi tsb |
| `/tim-krti` | `teams.index` | Grid kartu 5 tim lomba, tiap kartu tampil logo dummy + nama tim + badge kode divisi (RP/FW/VTOL/LELA/TD) |
| `/tim-krti/{slug}` | `teams.show` | Detail tim: tema misi, deskripsi, tabel spesifikasi, prestasi tim tsb |
| `/prestasi` | `achievements.index` | List/timeline prestasi + **filter by tahun & by kompetisi** (Alpine, client-side, tanpa reload) |
| `/struktur` | `structure` | Org chart hierarkis |

Semua di-render lewat **Controller** yang query dari Eloquent Model. JANGAN query langsung di Blade.

---

## 7. KOMPONEN BLADE YANG WAJIB DIBUAT

- `components/layout/app.blade.php` — layout utama (`<x-layout.app>`)
- `components/layout/navbar.blade.php` — sticky navbar, logo APTRG dummy, menu: Beranda, Profil, Divisi, Tim KRTI, Prestasi, Struktur. Hamburger + Alpine di mobile. Link aktif diberi border-bottom merah.
- `components/layout/footer.blade.php` — logo, alamat, Instagram, copyright
- `components/section-heading.blade.php` — props: `title`, `subtitle`. Render judul + garis merah 4px di bawahnya.
- `components/card.blade.php`
- `components/badge.blade.php` — props: `color` (red/gray)
- `components/stat.blade.php` — props: `value`, `label`
- `components/org-node.blade.php` — props: `member`. Kartu 1 orang di org chart (foto dummy bulat, nama, jabatan, prodi/angkatan)

---

## 8. ORG CHART (`/struktur`) — SPESIFIK

- Desktop (≥`lg`): bagan pohon vertikal, tiap level dipisah garis penghubung. Buat garis penghubung dengan **CSS border murni** (`border-l`, `border-t`, pseudo-element), **JANGAN pakai library chart eksternal**.
  ```
  Baris 1:                    [ Kapten ]
  Baris 2:     [ Wakil Internal ]      [ Wakil Eksternal ]
  Baris 3:        [ Sekretaris ]          [ Bendahara ]
  Baris 4:  [Kor. Mekanik] [Kor. Sistem] [Kor. GCS] [Kor. Non-Technical]
  ```
- Mobile (<`lg`): bagan berubah jadi **list bertingkat vertikal** dengan indent + garis kiri merah per level. Tidak boleh horizontal-scroll.
- Data diambil dari `Member::orderBy('level')->orderBy('order')` lalu dikelompokkan per level di Controller.

---

## 9. ASET DUMMY

Buat sendiri di `public/images/`:
- `logo-aptrg.svg` — placeholder: lingkaran merah solid + teks "APTRG" putih di tengah.
- `logo-frigate.svg`, `logo-bangau.svg`, `logo-raven.svg`, `logo-strix.svg`, `logo-falcon.svg` — placeholder: kotak/lingkaran solid (merah / hitam / abu, **tanpa gradient**) + inisial huruf tim.
- `placeholder-uav.svg`, `placeholder-division.svg` — kotak abu solid dengan icon pesawat sederhana + teks "IMAGE PLACEHOLDER".
- `avatar-placeholder.svg` — lingkaran abu + siluet orang.

Semua SVG dibuat manual (inline path sederhana). **JANGAN** pakai layanan eksternal (ui-avatars, placehold.co, unsplash) karena harus jalan offline.

---

## 10. LARANGAN (HARD RULES)

1. ❌ **JANGAN buat automated test apa pun** (no PHPUnit, no Pest, no feature/unit test).
2. ❌ **JANGAN pakai gradient** dalam bentuk apa pun.
3. ❌ JANGAN pakai Bootstrap, jQuery, atau CSS framework selain Tailwind.
4. ❌ JANGAN hardcode data konten di file Blade — semua dari database via seeder.
5. ❌ JANGAN bikin fitur auth / admin CRUD di fase ini.
6. ❌ JANGAN pakai gambar/aset dari internet.

---

## 11. LANGKAH EKSEKUSI

1. Inisialisasi project Laravel + install & konfigurasi Tailwind v3 + Alpine via Vite.
2. Set `tailwind.config.js` dengan palet warna di Bagian 3.
3. Buat semua Migration → Model (dengan `$fillable`, `$casts` untuk kolom json, relasi Eloquent) → Seeder.
4. `DatabaseSeeder` memanggil: `LabProfileSeeder`, `DivisionSeeder`, `CompetitionTeamSeeder`, `AchievementSeeder`, `MemberSeeder` (urutan penting karena FK).
5. Buat aset SVG dummy di `public/images/`.
6. Buat layout + komponen Blade.
7. Buat Controller + Route + View per halaman (urut: home → profil → divisi → tim → prestasi → struktur).
8. Jalankan `php artisan migrate:fresh --seed` dan `npm run build`, pastikan tidak ada error.
9. **Update `README.md`** (lihat Bagian 12).

---

## 12. README.md (WAJIB DIBUAT & DIPERBARUI)

Buat `README.md` di root sebagai dokumen spesifikasi hidup, berisi:
- Deskripsi proyek & tech stack
- Cara instalasi (`composer install`, `.env`, `php artisan key:generate`, `migrate:fresh --seed`, `npm install && npm run dev`)
- Struktur database (tabel + relasi)
- Daftar route & halaman
- Palet warna & aturan desain (no-gradient rule)
- **Status fitur** dengan indikator: ✅ selesai / 🔄 in progress / 📋 planned / 🐛 bug
- Section "Roadmap": 📋 Admin panel CRUD, 📋 Upload aset asli, 📋 Halaman galeri kegiatan, 📋 Integrasi feed Instagram

Setiap kali ada perubahan kode, **README.md wajib diperbarui**.

---

## 13. DEFINITION OF DONE

- [ ] `php artisan migrate:fresh --seed` sukses tanpa error
- [ ] 8 route di Bagian 6 semuanya bisa diakses tanpa error
- [ ] Tidak ada satu pun class/style gradient di seluruh codebase (cek dengan `grep -r "gradient" resources/`)
- [ ] Semua halaman rapi di lebar 360px, 768px, dan 1280px
- [ ] Org chart terbaca jelas di mobile maupun desktop
- [ ] Semua data berasal dari seeder, bukan hardcode Blade
- [ ] `README.md` lengkap dan sinkron dengan kode
