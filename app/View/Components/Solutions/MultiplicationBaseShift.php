<?php

namespace App\View\Components\Solutions;

use App\Traits\Hang;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MultiplicationBaseShift extends Component
{
    use Hang;
    public $item;
    public $showSolution;
    public $num1;
    public $num2;
    public $product;
    public $type;
    
    public $row1Left;
    public $row1Middle;
    public $row1Right;

    public $row2Left;
    public $row2Middle;
    public $row2Right;

    public $row3Left;
    public $row3Middle;
    public $row3Right;

    public $resultLeftStr;
    public $resultRightStr;
    /**
     * Create a new component instance.
     */
    public function __construct(int $num1, int $num2, bool $showSolution, int $item)
    {
        //
        $this->item = $item;
        $this->showSolution = $showSolution;
        $this->num1 = $num1;
        $this->num2 = $num2;
        $this->product = $num1 * $num2;

        if (!$this->haveSameNumberOfDigits($num1, $num2)) {
            $this->type = 'diff';
        } else {
            $this->type = ($this->isFirstDigitOne($num1) && $this->isFirstDigitOne($num2)) ? 'primary' : 'secondary';
        }

        $this->solvePrimary();
    }

    private function solvePrimary()
    {
        $num1 = $this->num1;
        $num2 = $this->num2;
        $numDigits = $this->countDigits($num1);

        $base = 10 ** ($numDigits - 1);
        $shift1 = $num1 - $base;
        $shift2 = $num2 - $base;
        $resultLeft = $num1 + $shift2;
        $resultRight = $shift1 * $shift2;

        $num1Str = (string)$num1;
        $num2Str = (string)$num2;
        $shift1Str = $this->getSign($shift1);
        $shift2Str = $this->getSign($shift2);
        $resultLeftStr = (string)$resultLeft;
        $resultRightStr = $this->setNumber($resultRight)->setDigitNormal($numDigits - 1)->formatNumber();

        list($this->row1Left, $this->row1Middle, $this->row1Right) = [$num1Str, '', $shift1Str];
        list($this->row2Left, $this->row2Middle, $this->row2Right) = [$num2Str, '', $shift2Str];
        list($this->row3Left, $this->row3Middle, $this->row3Right) = [$resultLeftStr, '/', $resultRightStr];
        list($this->resultLeftStr, $this->resultRightStr) =[$resultLeftStr,  $resultRightStr];
    }

    private function getSign($num):string
    {
        return $num <0?('- '.abs($num)):('+ '.$num);
    }
    private function isFirstDigitOne($number)
    {
        // แปลงจำนวนให้เป็น string เพื่อการตรวจสอบ
        $numberStr = (string)$number;

        // ตรวจสอบว่าตัวเลขหลักแรกเป็น 1 หรือไม่
        if ($numberStr[0] === '1') {
            return true;
        }

        return false;
    }

    private function haveSameNumberOfDigits(int $num1, int $num2): bool
    {
        // ใช้ฟังก์ชัน countDigits เพื่อเช็คว่าจำนวนสองจำนวนมีหลักเท่ากันหรือไม่
        return $this->countDigits($num1) === $this->countDigits($num2);
    }

    private function  countDigits(int $number): int
    {
        // แปลงตัวเลขเป็นสตริง
        $numberStr = strval($number);

        // นับความยาวของสตริง
        return strlen($numberStr);
    }
    private function checkSameLeadingDigit(int $num1, int $num2): bool
    {
        // แปลงตัวเลขเป็นสตริง
        $num1Str = strval($num1);
        $num2Str = strval($num2);

        // ตรวจสอบว่าเลขหน้าตัวแรกเหมือนกันหรือไม่
        return $num1Str[0] === $num2Str[0];
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.solutions.multiplication-base-shift');
    }
}
