<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Level;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            ['code' => 'p1-3', 'explain' => 'ป.1-3'],
            ['code' => 'p4-6', 'explain' => 'ป.4-6'],
            ['code' => 'm1-3', 'explain' => 'ม.1-3'],
        ];

        foreach ($levels as $level) {
            Level::create($level);
        }
    }
}
