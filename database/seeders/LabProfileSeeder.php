<?php

namespace Database\Seeders;

use App\Models\LabProfile;
use Illuminate\Database\Seeder;

class LabProfileSeeder extends Seeder
{
    public function run(): void
    {
        LabProfile::updateOrCreate(
            ['abbreviation' => 'APTRG'],
            [
                'name' => 'Aeromodelling and Payload Telemetry Research Group',
                'tagline' => 'Fight Together, Win Together, Yes We Can',
                'faculty' => 'Fakultas Teknik Elektro, Telkom University',
                'founded_year' => 2013,
                'about' => "Aeromodelling and Payload Telemetry Research Group (APTRG) adalah laboratorium riset di bawah naungan Fakultas Teknik Elektro, Telkom University, Bandung yang berfokus pada pengembangan teknologi pesawat tanpa awak (Unmanned Aerial Vehicle / UAV), aeromodelling, sistem telemetri muatan, aerial robotics, image vision, serta teknologi monitoring & surveillance.\n\nSebagai wadah riset dan inovasi mahasiswa, APTRG menggabungkan dedikasi riset ilmiah dengan kompetisi prestasi tinggi. Kami merancang, memfabrikasi, dan menerbangkan berbagai tipe wahana terbang dari tipe fixed-wing, racing plane, hingga VTOL berautonomous tinggi untuk menyelesaikan misi-misi nyata di lapangan.",
                'vision' => 'Menjadi pusat riset terkemuka dalam bidang teknologi pesawat tanpa awak (UAV), telemetri payload, dan aerial robotics yang unggul di tingkat nasional maupun internasional.',
                'mission' => [
                    'Melakukan riset dan inovasi berkelanjutan dalam bidang aeromodelling, avionik, sistem telemetri, dan kecerdasan buatan udara.',
                    'Membentuk sumber daya manusia berdaya saing tinggi yang siap menghadapi tantangan industri dirgantara dan sistem otonom masa depan.',
                    'Berpartisipasi aktif dan menorehkan prestasi dalam kompetisi nasional seperti KRTI maupun ajang internasional.',
                    'Menjalankan pengabdian masyarakat dan kolaborasi riset pemanfaatan teknologi UAV untuk penanggulangan bencana dan monitoring wilayah.',
                ],
                'research_focus' => [
                    'Aeromodinamis',
                    'Telemetry',
                    'Monitoring and Mapping',
                    'Autonomous System',
                ],
                'logo_path' => 'images/logo-aptrg.svg',
                'instagram' => '@aptrg',
                'email' => 'info@aptrg.telkomuniversity.ac.id',
                'address' => 'Laboratorium APTRG, Fakultas Teknik Elektro, Telkom University, Jl. Telekomunikasi No. 1, Terusan Buahbatu - Bojongsoang, Bandung 40257, Jawa Barat, Indonesia',
            ]
        );
    }
}
