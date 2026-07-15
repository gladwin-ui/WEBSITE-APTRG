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
                'krti_code' => 'RP',
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
                'logo_path' => 'images/logo-frigate.png',
                'image_path' => 'images/placeholder-uav.svg',
                'order' => 1,
            ],
            [
                'slug' => 'bangau',
                'team_name' => 'Bangau Team',
                'krti_division' => 'Fixed Wing',
                'krti_code' => 'FW',
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
                'logo_path' => 'images/logo-bangau.png',
                'image_path' => 'images/placeholder-uav.svg',
                'order' => 2,
            ],
            [
                'slug' => 'raven',
                'team_name' => 'Raven Team',
                'krti_division' => 'VTOL',
                'krti_code' => 'VTOL',
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
                'logo_path' => 'images/logo-raven.png',
                'image_path' => 'images/placeholder-uav.svg',
                'order' => 3,
            ],
            [
                'slug' => 'strix',
                'team_name' => 'Strix Team',
                'krti_division' => 'Long Endurance Low Altitude',
                'krti_code' => 'LELA',
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
                'logo_path' => 'images/logo-strix.png',
                'image_path' => 'images/placeholder-uav.svg',
                'order' => 4,
            ],
            [
                'slug' => 'falcon',
                'team_name' => 'Falcon Team',
                'krti_division' => 'Technology Development',
                'krti_code' => 'TD',
                'aircraft_type' => 'Advanced Propulsion & Avionics Platform',
                'tagline' => 'Innovating Indigenous UAV Technology',
                'description' => 'Falcon Team adalah tim riset inovasi teknologi mandiri APTRG yang merancang komponen inti wahana terbang dari nol, termasuk flight controller mandiri, sistem propulsi canggih, dan airframe komposit modular.',
                'mission_theme' => 'Kemandirian teknologi pesawat tanpa awak: pengembangan Flight Controller, Propulsion System, dan Airframe Innovation.',
                'specs' => [
                    'Wingspan' => '1.500 mm',
                    'Propulsi' => 'Custom Indigenous Propulsion System',
                    'Payload' => '1.000 g',
                    'Kecepatan Maks' => '110 km/jam',
                    'Endurance' => '35 menit',
                ],
                'logo_path' => 'images/logo-falcon.svg',
                'image_path' => 'images/placeholder-uav.svg',
                'order' => 5,
            ],
        ];

        foreach ($teams as $team) {
            CompetitionTeam::updateOrCreate(['slug' => $team['slug']], $team);
        }
    }
}
