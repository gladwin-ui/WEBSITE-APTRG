<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $divMekanik = Division::where('slug', 'mekanik')->first();
        $divSistem  = Division::where('slug', 'sistem')->first();
        $divGcs     = Division::where('slug', 'gcs')->first();
        $divNonTech = Division::where('slug', 'non-technical')->first();

        // Level 1: Kapten
        $kapten = Member::create([
            'name' => 'Muhammad Arya Pratama',
            'position' => 'Kapten',
            'level' => 1,
            'parent_id' => null,
            'division_id' => null,
            'study_program' => 'S1 Teknik Telekomunikasi',
            'batch' => '2022',
            'photo_path' => 'images/avatar-placeholder.svg',
            'order' => 1,
        ]);

        // Level 2: Wakil Kapten Internal & Eksternal
        $wakilInternal = Member::create([
            'name' => 'Rizki Akbar Ramadhan',
            'position' => 'Wakil Kapten Internal',
            'level' => 2,
            'parent_id' => $kapten->id,
            'division_id' => null,
            'study_program' => 'S1 Teknik Elektro',
            'batch' => '2022',
            'photo_path' => 'images/avatar-placeholder.svg',
            'order' => 1,
        ]);

        $wakilEksternal = Member::create([
            'name' => 'Faisal Kurniawan Putra',
            'position' => 'Wakil Kapten Eksternal',
            'level' => 2,
            'parent_id' => $kapten->id,
            'division_id' => null,
            'study_program' => 'S1 Teknik Telekomunikasi',
            'batch' => '2022',
            'photo_path' => 'images/avatar-placeholder.svg',
            'order' => 2,
        ]);

        // Level 3: Sekretaris & Bendahara (parent ke Wakil Internal)
        Member::create([
            'name' => 'Nabila Putri Zahra',
            'position' => 'Sekretaris',
            'level' => 3,
            'parent_id' => $wakilInternal->id,
            'division_id' => null,
            'study_program' => 'S1 Teknik Telekomunikasi',
            'batch' => '2023',
            'photo_path' => 'images/avatar-placeholder.svg',
            'order' => 1,
        ]);

        Member::create([
            'name' => 'Aulia Rahmawati',
            'position' => 'Bendahara',
            'level' => 3,
            'parent_id' => $wakilInternal->id,
            'division_id' => null,
            'study_program' => 'S1 Teknik Elektro',
            'batch' => '2023',
            'photo_path' => 'images/avatar-placeholder.svg',
            'order' => 2,
        ]);

        // Level 4: Koordinator Divisi (parent ke Wakil Eksternal)
        Member::create([
            'name' => 'Dimas Satria Wibowo',
            'position' => 'Koordinator Divisi Mekanik',
            'level' => 4,
            'parent_id' => $wakilEksternal->id,
            'division_id' => $divMekanik?->id,
            'study_program' => 'S1 Teknik Elektro',
            'batch' => '2022',
            'photo_path' => 'images/avatar-placeholder.svg',
            'order' => 1,
        ]);

        Member::create([
            'name' => 'Rayhan Firdaus Alghifari',
            'position' => 'Koordinator Divisi Sistem',
            'level' => 4,
            'parent_id' => $wakilEksternal->id,
            'division_id' => $divSistem?->id,
            'study_program' => 'S1 Teknik Telekomunikasi',
            'batch' => '2022',
            'photo_path' => 'images/avatar-placeholder.svg',
            'order' => 2,
        ]);

        Member::create([
            'name' => 'Hafizh Maulana Hakim',
            'position' => 'Koordinator Divisi GCS',
            'level' => 4,
            'parent_id' => $wakilEksternal->id,
            'division_id' => $divGcs?->id,
            'study_program' => 'S1 Teknik Komputer',
            'batch' => '2022',
            'photo_path' => 'images/avatar-placeholder.svg',
            'order' => 3,
        ]);

        Member::create([
            'name' => 'Clarissa Putri Maharani',
            'position' => 'Koordinator Divisi Non-Technical',
            'level' => 4,
            'parent_id' => $wakilEksternal->id,
            'division_id' => $divNonTech?->id,
            'study_program' => 'S1 Teknik Telekomunikasi',
            'batch' => '2023',
            'photo_path' => 'images/avatar-placeholder.svg',
            'order' => 4,
        ]);
    }
}
