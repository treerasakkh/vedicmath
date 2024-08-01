<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Difficulty;

class DifficultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $difficulties = [
            ['code' => 'easy', 'explain' => 'ง่าย'],
            ['code' => 'medium', 'explain' => 'ปานกลาง'],
            ['code' => 'hard', 'explain' => 'ยาก'],
        ];

        foreach ($difficulties as $difficulty) {
            Difficulty::create($difficulty);
        }
    }
}
