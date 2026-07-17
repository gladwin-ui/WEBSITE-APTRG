<?php

namespace Database\Seeders;

use App\Models\CompetitionTeam;
use Illuminate\Database\Seeder;

class CompetitionTeamSeeder extends Seeder
{
    public function run(): void
    {
        $teams = [
            [
                'slug' => 'frigate',
                'team_name' => 'Frigate Team',
                'krti_division' => 'Racing Plane',
                'krti_code' => 'KRTI',
                'aircraft_type' => 'Fixed Wing High-Speed Racer',
                'tagline' => 'Speed, Precision, Dominance',
                'description' => 'Frigate Team adalah tim kebanggaan APTRG dalam divisi Racing Plane KRTI. Tim ini berfokus pada pengembangan wahana aerodinamis berkecepatan tinggi dengan kestabilan manuver ekstrem untuk menyelesaikan lintasan sirkuit udara dengan catatan waktu tercepat.',
                'mission_theme' => 'F.A.T (Fast And on Track) — wahana tercepat menyelesaikan lintasan. Fokus: pesawat cepat, lincah, gesit, manuver presisi di sirkuit udara.',
                'specs' => [
                    'Wingspan' => '1.150 mm',
                    'Propulsi' => 'Brushless Motor 2814 KV1400',
                    'Payload' => '350 g',
                    'Kecepatan Maks' => '160 km/jam',
                    'Endurance' => '12 menit',
                ],
                'logo_path' => 'images/logo-frigate.svg',
                'image_path' => 'images/placeholder-uav.svg',
                'order' => 1,
            ],
            [
                'slug' => 'bangau',
                'team_name' => 'Bangau Team',
                'krti_division' => 'Fixed Wing',
                'krti_code' => 'KRTI',
                'aircraft_type' => 'Fixed Wing Autonomous Mapper & Dropper',
                'tagline' => 'Accurate Mapping, Rapid Emergency Delivery',
                'description' => 'Bangau Team mengkhususkan diri pada pesawat bersayap tetap (Fixed Wing) berautonomi tinggi yang dirancang untuk menjalankan misi pemetaan wilayah luas serta pengantaran logistik darurat secara presisi.',
                'mission_theme' => 'Misi mapping, monitoring, dan pengiriman paket darurat (dropping) di wilayah bencana secara autonomous.',
                'specs' => [
                    'Wingspan' => '1.800 mm',
                    'Propulsi' => 'Brushless Motor 3520 KV850',
                    'Payload' => '1.200 g',
                    'Kecepatan Maks' => '95 km/jam',
                    'Endurance' => '45 menit',
                ],
                'logo_path' => 'images/logo-bangau.svg',
                'image_path' => 'images/placeholder-uav.svg',
                'order' => 2,
            ],
            [
                'slug' => 'raven',
                'team_name' => 'Raven Team',
                'krti_division' => 'VTOL',
                'krti_code' => 'KRTI',
                'aircraft_type' => 'Hybrid VTOL Autonomous Carrier',
                'tagline' => 'Agile Vertical Takeoff, Precise Autonomous Navigation',
                'description' => 'Raven Team merancang wahana Vertical Take-off and Landing (VTOL) yang memadukan keunggulan lepas landas tanpa landasan pacu dengan kemampuan navigasi otonom dalam maupun luar ruangan.',
                'mission_theme' => 'Wahana yang mampu take-off & landing vertikal, misi utama pick and drop serta terbang otonom di dalam ruangan.',
                'specs' => [
                    'Wingspan' => '1.400 mm',
                    'Propulsi' => 'Quad-Rotor VTOL + Forward Pusher',
                    'Payload' => '800 g',
                    'Kecepatan Maks' => '85 km/jam',
                    'Endurance' => '25 menit',
                ],
                'logo_path' => 'images/logo-raven.svg',
                'image_path' => 'images/placeholder-uav.svg',
                'order' => 3,
            ],
            [
                'slug' => 'strix',
                'team_name' => 'Strix Team',
                'krti_division' => 'Long Endurance Low Altitude',
                'krti_code' => 'KRTI',
                'aircraft_type' => 'Long Endurance Surveillance UAV',
                'tagline' => 'Endless Vigilance, Long Range Surveillance',
                'description' => 'Strix Team berfokus pada wahana dengan efisiensi energi tertinggi yang mampu bertahan terbang dalam durasi panjang pada ketinggian rendah untuk misi surveilans dan deteksi dini bencana.',
                'mission_theme' => 'Pemanfaatan UAV long endurance terbang rendah untuk misi validasi hot spot (titik panas / kebakaran hutan) jarak jauh.',
                'specs' => [
                    'Wingspan' => '2.400 mm',
                    'Propulsi' => 'High-Efficiency Brushless KV520',
                    'Payload' => '600 g',
                    'Kecepatan Maks' => '75 km/jam',
                    'Endurance' => '90 menit',
                ],
                'logo_path' => 'images/logo-strix.svg',
                'image_path' => 'images/placeholder-uav.svg',
                'order' => 4,
            ],
            [
                'slug' => 'avalerion',
                'team_name' => 'Avalerion',
                'krti_division' => 'Fixed Wing',
                'krti_code' => 'TEKNOFEST',
                'aircraft_type' => 'International UAV Competition Platform',
                'tagline' => 'Global Excellence in TEKNOFEST UAV Turkey',
                'description' => 'Avalerion adalah tim delegasi internasional APTRG yang berfokus pada pengembangan sistem pesawat tanpa awak (UAV) canggih untuk berlaga dalam ajang kompetisi bergengsi TEKNOFEST International Unmanned Aerial Vehicle Competition di Turki.',
                'mission_theme' => 'Pengembangan wahana UAV misi khusus untuk kompetisi internasional TEKNOFEST UAV di Turki dengan presisi otonom tinggi.',
                'specs' => [
                    'Wingspan' => '1.800 mm',
                    'Propulsi' => 'High-Efficiency Brushless Motor',
                    'Payload' => '1.500 g',
                    'Kecepatan Maks' => '100 km/jam',
                    'Endurance' => '40 menit',
                ],
                'logo_path' => 'images/logo-avalerion.svg',
                'image_path' => 'images/placeholder-uav.svg',
                'order' => 5,
            ],
        ];

        $slugs = [];
        foreach ($teams as $team) {
            CompetitionTeam::updateOrCreate(['slug' => $team['slug']], $team);
            $slugs[] = $team['slug'];
        }

        // Hapus tim lama yang sudah tidak ada di dalam daftar $teams (contoh: falcon yang diganti avalerion)
        CompetitionTeam::whereNotIn('slug', $slugs)->delete();
    }
}
