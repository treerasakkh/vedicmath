<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AdditionBook;
use App\Models\Solutions\AdditionDot;

class AdditionBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $addDot = new AdditionDot('p1-3','easy');
        //
        $level = 'p1-3';

        for ($i = 0; $i < 50; $i++) {
            $addDot->setLevel($level);
            $addDot->setDifficulty('easy');
            $addDot->setOrder($i);
        }

        for ($i = 0; $i < 50; $i++) {
            $difficulty = 'medium';
        }

        for ($i = 0; $i < 50; $i++) {
            $difficulty = 'hard';
        }

        $level = 'p4-6';
        for ($i = 0; $i < 50; $i++) {
            $difficulty = 'easy';
        }

        for ($i = 0; $i < 50; $i++) {
            $difficulty = 'medium';
        }

        for ($i = 0; $i < 50; $i++) {
            $difficulty = 'hard';
        }

        $level = 'm1-3';
        for ($i = 0; $i < 50; $i++) {
            $difficulty = 'easy';
        }

        for ($i = 0; $i < 50; $i++) {
            $difficulty = 'medium';
        }

        for ($i = 0; $i < 50; $i++) {
            $difficulty = 'hard';
        }

    }
}
