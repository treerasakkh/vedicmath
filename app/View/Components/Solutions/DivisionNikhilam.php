<?php

namespace App\View\Components\Solutions;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DivisionNikhilam extends Component
{

    public $num1;
    public $num2;
    /**
     * Create a new component instance.
     */
    public function __construct(int $num1, int $num2)
    {
        //
    }


    private function generateNumbers(): array
    {
        // สุ่ม $num2 ที่มี 2 หลัก (ตั้งแต่ 10 ถึง 99)
        $num2 = rand(10, 99);
        
        // สุ่มตัวคูณ $multiplier ที่ทำให้ $num1 มี 3 หลัก
        $multiplier = rand(2, intdiv(999, $num2));
        
        // คำนวณ $num1 ที่มี 3 หลักโดยการคูณ $num2 กับ $multiplier
        $num1 = $num2 * $multiplier;
    
        // ตรวจสอบให้แน่ใจว่า $num1 มี 3 หลัก
        if ($num1 < 100 || $num1 > 999) {
            // ถ้า $num1 ไม่ใช่ 3 หลัก ให้เรียกฟังก์ชันนี้ใหม่
            return $this->generateNumbers();
        }
    
        return [$num1, $num2];
    }
    
    
    

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.solutions.division-nikhilam');
    }
}
