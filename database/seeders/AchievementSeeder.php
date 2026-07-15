<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\CompetitionTeam;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        $frigate = CompetitionTeam::where('slug', 'frigate')->first();
        $bangau  = CompetitionTeam::where('slug', 'bangau')->first();
        $raven   = CompetitionTeam::where('slug', 'raven')->first();
        $strix   = CompetitionTeam::where('slug', 'strix')->first();
        $falcon  = CompetitionTeam::where('slug', 'falcon')->first();

        $achievements = [
            [
                'title' => 'Juara 1 Racing Plane KRTI 2024',
                'competition' => 'KRTI',
                'year' => 2024,
                'rank' => 'Juara 1',
                'category' => 'Divisi Racing Plane',
                'level' => 'Nasional',
                'competition_team_id' => $frigate?->id,
                'description' => 'Berhasil memecahkan rekor putaran tercepat pada lintasan sirkuit Racing Plane Kontes Robot Terbang Indonesia 2024.',
            ],
            [
                'title' => 'Juara 2 Fixed Wing Kelas Monitoring KRTI 2024',
                'competition' => 'KRTI',
                'year' => 2024,
                'rank' => 'Juara 2',
                'category' => 'Divisi Fixed Wing – Kelas Monitoring & Mapping',
                'level' => 'Nasional',
                'competition_team_id' => $bangau?->id,
                'description' => 'Misi pemetaan akurat dan pengiriman logistik darurat otonom dengan skor ketepatan target 98%.',
            ],
            [
                'title' => 'Juara 3 VTOL Indoor KRTI 2023',
                'competition' => 'KRTI',
                'year' => 2023,
                'rank' => 'Juara 3',
                'category' => 'Divisi VTOL Kelas Non Water-Based Fire Extinguisher',
                'level' => 'Nasional',
                'competition_team_id' => $raven?->id,
                'description' => 'Keberhasilan misi pick and drop serta manuver otonom di dalam ruangan berhalangan.',
            ],
            [
                'title' => 'Juara Harapan 1 LELA KRTI 2023',
                'competition' => 'KRTI',
                'year' => 2023,
                'rank' => 'Juara Harapan 1',
                'category' => 'Divisi Long Endurance Low Altitude (LELA)',
                'level' => 'Nasional',
                'competition_team_id' => $strix?->id,
                'description' => 'Validasi titik panas kebakaran hutan dengan endurance terbang di atas 60 menit non-stop.',
            ],
            [
                'title' => 'Best Design Technology Development KRTI 2022',
                'competition' => 'KRTI',
                'year' => 2022,
                'rank' => 'Best Design',
                'category' => 'Divisi Technology Development (Airframe Innovation)',
                'level' => 'Nasional',
                'competition_team_id' => $falcon?->id,
                'description' => 'Penghargaan desain struktur komposit modular teringan dan paling kokoh.',
            ],
            [
                'title' => 'Juara 1 Racing Plane KRTI 2022',
                'competition' => 'KRTI',
                'year' => 2022,
                'rank' => 'Juara 1',
                'category' => 'Divisi Racing Plane',
                'level' => 'Nasional',
                'competition_team_id' => $frigate?->id,
                'description' => 'Dominasi kecepatan wahana balap udara di ajang KRTI 2022.',
            ],
            [
                'title' => 'Juara 4 KOMURINDO 2021',
                'competition' => 'KOMURINDO',
                'year' => 2021,
                'rank' => 'Juara 4',
                'category' => 'Kategori Muatan Roket & Telemetri',
                'level' => 'Nasional',
                'competition_team_id' => null,
                'description' => 'Pengembangan muatan telemetri roket atmosferik dengan pengiriman data real-time ke ground station.',
            ],
            [
                'title' => 'Juara 2 Fixed Wing KRTI 2021',
                'competition' => 'KRTI',
                'year' => 2021,
                'rank' => 'Juara 2',
                'category' => 'Divisi Fixed Wing',
                'level' => 'Nasional',
                'competition_team_id' => $bangau?->id,
                'description' => 'Misi pemetaan wilayah terdampak bencana dan pengiriman obat darurat.',
            ],
            [
                'title' => 'Best System TEKNOFEST 2020',
                'competition' => 'TEKNOFEST',
                'year' => 2020,
                'rank' => 'Best Design',
                'category' => 'International UAV Competition',
                'level' => 'Internasional',
                'competition_team_id' => $falcon?->id,
                'description' => 'Partisipasi dan penghargaan inovasi avionik pada kompetisi UAV internasional TEKNOFEST.',
            ],
            [
                'title' => 'Juara 1 Racing Plane KRTI 2019',
                'competition' => 'KRTI',
                'year' => 2019,
                'rank' => 'Juara 1',
                'category' => 'Divisi Racing Plane',
                'level' => 'Nasional',
                'competition_team_id' => $frigate?->id,
                'description' => 'Menjadi juara pertama kompetisi pesawat balap tanpa awak nasional.',
            ],
            [
                'title' => 'Juara 3 VTOL KRTI 2019',
                'competition' => 'KRTI',
                'year' => 2019,
                'rank' => 'Juara 3',
                'category' => 'Divisi VTOL Autonomous',
                'level' => 'Nasional',
                'competition_team_id' => $raven?->id,
                'description' => 'Prestasi wahana vertikal otonom dalam penyelesaian misi presisi.',
            ],
        ];

        foreach ($achievements as $achievement) {
            Achievement::updateOrCreate([
                'title' => $achievement['title'],
                'year' => $achievement['year'],
            ], $achievement);
        }
    }
}
