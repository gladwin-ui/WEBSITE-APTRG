<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            LabProfileSeeder::class,
            DivisionSeeder::class,
            CompetitionTeamSeeder::class,
            AchievementSeeder::class,
            MemberSeeder::class,
        ]);
    }
}
