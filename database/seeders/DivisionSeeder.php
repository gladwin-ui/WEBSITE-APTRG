<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    public function run(): void
    {
        $divisions = [
            [
                'slug' => 'mekanik',
                'name' => 'Divisi Mekanik',
                'short_description' => 'Perancangan, fabrikasi, dan pemeliharaan wahana terbang.',
                'description' => 'Divisi yang bertugas merancang struktur wahana, membangun airframe, serta memelihara alat. Anggotanya juga bertindak sebagai pilot utama wahana.',
                'responsibilities' => [
                    'Merancang desain dan struktur wahana',
                    'Perancangan sistem aktuator dan elektronika wahana',
                    'Pengimplementasian pembuatan/fabrikasi wahana',
                    'Pemeliharaan alat dan perkakas mekanik',
                    'Menjadi pilot dan operator wahana',
                ],
                'icon' => 'wrench',
                'image_path' => 'images/placeholder-division.svg',
                'order' => 1,
            ],
            [
                'slug' => 'sistem',
                'name' => 'Divisi Sistem',
                'short_description' => 'Sistem kendali, telemetri, dan autonomous wahana.',
                'description' => 'Divisi yang menangani kesatuan komponen elektronik dan perangkat lunak yang menghubungkan aliran informasi, materi, dan energi pada wahana.',
                'responsibilities' => [
                    'Merancang dan konfigurasi sistem kendali wahana',
                    'Merancang dan konfigurasi sistem telemetri',
                    'Menentukan konfigurasi sistem autonomous',
                    'Power budget, sistem elektronika, dan integrasi sensor',
                ],
                'icon' => 'cpu-chip',
                'image_path' => 'images/placeholder-division.svg',
                'order' => 2,
            ],
            [
                'slug' => 'gcs',
                'name' => 'Divisi GCS (Ground Control Station)',
                'short_description' => 'Pusat kendali darat dan pengolahan data penerbangan.',
                'description' => 'Divisi yang menyediakan fasilitas kendali wahana autopilot dari darat, mengirim command, serta menerjemahkan data telemetri menjadi visualisasi yang mudah dipahami.',
                'responsibilities' => [
                    'Konfigurasi wahana terbang',
                    'Berkomunikasi dengan wahana terbang',
                    'Menerima data dan mengirim command',
                    'Menerjemahkan data menjadi grafik/tampilan',
                    'Menyimpan data untuk keperluan analisis',
                ],
                'icon' => 'computer-desktop',
                'image_path' => 'images/placeholder-division.svg',
                'order' => 3,
            ],
            [
                'slug' => 'non-technical',
                'name' => 'Divisi Non-Technical',
                'short_description' => 'Keorganisasian, media, dan manajemen lab.',
                'description' => 'Divisi yang mengelola keorganisasian lab: perencanaan kegiatan, administrasi, kearsipan, dokumentasi, dan media. Tetap fleksibel untuk ikut riset bersama divisi lain.',
                'responsibilities' => [
                    'Menyusun rencana kegiatan lab',
                    'Pengelolaan surat-menyurat dan kearsipan',
                    'Aerial shooting dan dokumentasi',
                    'Unit manager dan branding lab',
                    'Pengelolaan media sosial dan kerja sama',
                ],
                'icon' => 'users',
                'image_path' => 'images/placeholder-division.svg',
                'order' => 4,
            ],
        ];

        foreach ($divisions as $division) {
            Division::create($division);
        }
    }
}
