<?php

namespace Database\Seeders;

use App\Models\Method;
use App\Models\Operation;
use Illuminate\Database\Seeder;

class MethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $additionId = Operation::where('code', 'addition')->first()->id;
        $subtractionId = Operation::where('code', 'subtraction')->first()->id;
        $multiplicationId = Operation::where('code', 'multiplication')->first()->id;
        $divisionId = Operation::where('code', 'division')->first()->id;
        $mixedId = Operation::where('code', 'mixed')->first()->id;

        $methods = [
            ['code' => 'addition_dot', 'explain' => 'การบวกแบบทดจุด', 'operation_id' => $additionId],
            ['code' => 'subtraction_ten', 'explain' => 'การลบโดยใช้หลักทบสิบ', 'operation_id' => $subtractionId],
            ['code' => 'subtraction_ten_nine', 'explain' => 'การลบโดยใช้หลักทบสิบทบเก้า', 'operation_id' => $subtractionId],
            ['code' => 'subtraction_direct', 'explain' => 'การลบโดยใช้การลบตรงหลัก', 'operation_id' => $subtractionId],
            ['code' => 'subtraction_nikhilam', 'explain' => 'การลบโดยใช้วิธีนิขิลัม', 'operation_id' => $subtractionId],
            ['code' => 'addition_subtraction_mixed', 'explain' => 'การบวกลบระคน', 'operation_id' => $mixedId],
            ['code' => 'multiplication_aligned', 'explain' => 'การคูณโดยการจัดตำแหน่งผลคูณ', 'operation_id' => $multiplicationId],
            ['code' => 'multiplication_vertical_cross', 'explain' => 'การคูณแนวตั้งและแนวไขว้', 'operation_id' => $multiplicationId],
            ['code' => 'multiplication_base_shift', 'explain' => 'การคูณโดยวิธีเบี่ยงฐาน', 'operation_id' => $multiplicationId],
            ['code' => 'division_nikhilam', 'explain' => 'การหารโดยใช้วิธีนิขิลัม', 'operation_id' => $divisionId],
            ['code' => 'division_paravart', 'explain' => 'การหารโดยใช้วิธีพาราวารท', 'operation_id' => $divisionId],
        ];

        foreach ($methods as $method) {
            Method::create($method);
        }
    }
}
