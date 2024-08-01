<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Operation;

class OperationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $operations = [
            ['code' => 'addition', 'explain' => 'การบวก'],
            ['code' => 'subtraction', 'explain' => 'การลบ'],
            ['code' => 'multiplication', 'explain' => 'การคูณ'],
            ['code' => 'division', 'explain' => 'การหาร'],
            ['code' => 'total', 'explain' => 'รวม'],
            ['code' => 'mixed', 'explain' => 'การบวกลบระคน'],
        ];

        foreach ($operations as $operation) {
            Operation::create($operation);
        }
    }
}
