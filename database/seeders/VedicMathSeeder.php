<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VedicMathSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $this->call([
            AdditionDotSeeder::class,
            SubtractionTenSeeder::class,
            SubtractionTenNineSeeder::class,
            SubtractionDirectSeeder::class,
            SubtractionNikhilamSeeder::class,
            AdditionSubtractionMixedSeeder::class,
            MultiplicationAlignedSeeder::class,
            MultiplicationBaseShiftSeeder::class,
            MultiplicationVerticalCrossSeeder::class,
            DivisionNikhilamSeeder::class,
            DivisionParavartSeeder::class,
        ]);
    }
}
