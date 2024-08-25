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
    public $typeLabel;
    public $mulOfBase;
    public $num1Ratio;
    public $num2Ratio;
    public $question;

    public $row1Left;
    public $row1Middle;
    public $row1Right;

    public $row2Left;
    public $row2Middle;
    public $row2Right;

    public $row3Left;
    public $row3Middle;
    public $row3Right;

    public $row4Left;
    public $row4Middle;
    public $row4Right;

    public $resultLeftStr;
    public $resultRightStr;
    public $lastResultLeftstr;

    protected $isDiffDigitsOne;
    public int $base = 0;
    public string $expand;
    /**
     * Create a new component instance.
     */
    public function __construct(int $num1, int $num2, bool $showSolution, int $item)
    {
        //
        $this->item = $item;
        $this->num1 = $num1;
        $this->num2 = $num2;
        $this->showSolution = $showSolution;
        $this->product = $num1 * $num2;

        $isEqualDigits = $this->isEqualDigits($num1, $num2);
        $isFirstDigitOne = $this->isFirstDigitOne($num1, $num2);
        $isDiffDigitsOne = $this->isDiffDigitsOne($num1, $num2);

        if ($isEqualDigits && $isFirstDigitOne) {
            $this->solveByPrimary($num1, $num2);
        }

        if ($isEqualDigits && !$isFirstDigitOne) {
            $this->isNearPrimaryBase($num1, $num2) ? $this->solveByPrimary($num1, $num2) : $this->solveBySecondary($num1, $num2);
        }

        if (!$isEqualDigits) {
            $this->isDiffDigitsOne($num1, $num2) ? $this->solveByPrimary($num1, $num2) : $this->solveByDiff($num1, $num2);
        }

        $this->setQuestion($num1, $num2);
        $this->setTypeLabel();
        $this->setExpand();
    }

    protected function solveBySecondary(int $num1, int $num2): void
    {
        $this->type = 'secondary-base';
        $this->solveSecondaryBase($num1, $num2);
    }

    protected function solveByPrimary(int $num1, int $num2): void
    {
        $this->type = 'primary-base';
        $this->solvePrimaryBase($num1, $num2);
    }

    protected function solveByDiff(int $num1, int $num2): void
    {
        $this->type = 'different-base';
        $this->solveDifferentBase($num1, $num2);
    }

    protected function solvePrimaryBase(int $num1, int $num2): void
    {
        $num1Digits = $this->countDigits($num1);
        $num2Digits = $this->countDigits($num2);
        $isSameDigits = $this->isSameDigits($num1, $num2);
        $isDiffDigitsOne = $this->isDiffDigitsOne($num1, $num2);
        $numDigits = $isSameDigits ? $num1Digits : ($isDiffDigitsOne ? max($num1Digits, $num2Digits) : min($num1Digits, $num2Digits));

        $base = 10 ** ($numDigits - 1);

        if ($this->getFirstDigit($num1) > 5 && !$isDiffDigitsOne) {
            $base *= 10;
            $numDigits++;
        }

        $this->base = $base;

        $shift1 = $num1 - $base;
        $shift2 = $num2 - $base;
        $resultLeft = $num1 + $shift2;
        $resultRight = $shift1 * $shift2;

        $num1Str = (string)$num1;
        $num2Str = (string)$num2;
        $shift1Str = $this->getSign($shift1, $numDigits - 1);
        $shift2Str = $this->getSign($shift2, $numDigits - 1);
        $resultLeftStr = (string)$resultLeft;
        $resultRightStr = $this->setNumber($resultRight)->setDigitNormal(log($this->base,10))->formatNumber();

        list($this->row1Left, $this->row1Middle, $this->row1Right) = [$num1Str, '', $shift1Str];
        list($this->row2Left, $this->row2Middle, $this->row2Right) = [$num2Str, '', $shift2Str];
        list($this->row3Left, $this->row3Middle, $this->row3Right) = ['', '', ''];
        list($this->row4Left, $this->row4Middle, $this->row4Right) = [$resultLeftStr, '/', $resultRightStr];
        list($this->resultLeftStr, $this->resultRightStr) = [$resultLeftStr,  $resultRightStr];
    }

    protected function solveSecondaryBase(int $num1, int $num2)
    {

        $numDigits = $this->countDigits($num1);
        $firstNum1Digit = $this->getFirstDigit($num1);
        $firstNum2Digit = $this->getFirstDigit($num2);

        if ($firstNum1Digit === $firstNum2Digit) {
            $mulOfBase = $this->isNearUpperBase($num1, $num2) ? ($firstNum1Digit + 1) : $firstNum1Digit;
        } else {
            $mulOfBase = round(($firstNum1Digit + $firstNum2Digit) / 2);
        }

        $this->mulOfBase = $mulOfBase;

        $basicBase = 10 ** ($numDigits - 1);

        $this->base = $mulOfBase * $basicBase;
        $shift1 = $num1 - $this->base;
        $shift2 = $num2 - $this->base;
        $resultLeft = $num1 + $shift2;
        $resultRight = $shift1 * $shift2;

        $num1Str = (string)$num1;
        $num2Str = (string)$num2;
        $shift1Str = $this->getSign($shift1, $numDigits - 1);
        $shift2Str = $this->getSign($shift2, $numDigits - 1);
        $resultLeftStr = (string)$resultLeft;
        $resultRightStr = $this->setNumber($resultRight)->setDigitNormal($numDigits - 1)->formatNumber();
        $lastResultLeftStr = (string)($resultLeft * $mulOfBase);
        $lastResultRightStr = $resultRightStr;

        list($this->row1Left, $this->row1Middle, $this->row1Right) = [$num1Str, '', $shift1Str];
        list($this->row2Left, $this->row2Middle, $this->row2Right) = [$num2Str, '', $shift2Str];
        list($this->row3Left, $this->row3Middle, $this->row3Right) = [$resultLeftStr, '/', $resultRightStr];
        list($this->row4Left, $this->row4Middle, $this->row4Right) = [$lastResultLeftStr, '/', $lastResultRightStr];
        list($this->resultLeftStr, $this->resultRightStr) = [$resultLeftStr,  $resultRightStr];
    }

    protected function solveDifferentBase(int $num1, int $num2): void
    {
        $num1Digits = $this->countDigits($num1);
        $num2Digits = $this->countDigits($num2);
        $firstNum1Digit = $this->getFirstDigit($num1);
        $firstNum2Digit = $this->getFirstDigit($num2);
        $num1Base = $this->getBase($num1);
        $num2Base = $this->getBase($num2);
        $gcd = $this->gcd($num1Base, $num2Base);

        $num1Ratio = $num1Base / $gcd;
        $num2Ratio = $num2Base / $gcd;
        $this->num1Ratio = $num1Ratio;
        $this->num2Ratio = $num2Ratio;

        $shift1 = $num1 - $num1Base;
        $shift2 = $num2 - $num2Base;
        $resultLeft = $num1 * $num2Ratio + $shift2 * $num1Ratio;
        $resultRight = $shift1 * $shift2;

        $num1Str = (string)$num1;
        $num2Str = (string)$num2;
        $shift1Str = $this->getSign($shift1, $this->getShiftLength($firstNum1Digit, $num1Digits));
        $shift2Str = $this->getSign($shift2, $this->getShiftLength($firstNum2Digit, $num2Digits));
        $resultLeftStr = (string)$resultLeft;
        $resultRightStr = $this->setNumber($resultRight)->setDigitNormal(min($num1Digits, $num2Digits) - 1)->formatNumber();

        list($this->row1Left, $this->row1Middle, $this->row1Right) = [$num1Str, '', $shift1Str];
        list($this->row2Left, $this->row2Middle, $this->row2Right) = [$num2Str, '', $shift2Str];
        list($this->row3Left, $this->row3Middle, $this->row3Right) = ['', '', ''];
        list($this->row4Left, $this->row4Middle, $this->row4Right) = [$resultLeftStr, '/', $resultRightStr];
        list($this->resultLeftStr, $this->resultRightStr) = [$resultLeftStr,  $resultRightStr];
    }
    protected function setTypeLabel(): void
    {
        $this->typeLabel = match ($this->type) {
            'secondary-base' => 'ใช้ฐานฑุติยภูมิ',
            'different-base' => 'ใช้วิธีต่างฐาน',
            default => 'ใช้ฐานปฐมภูมิ'
        };
    }

    protected function setExpand(): void
    {
        $base = $this->type === 'different-base' ? '' : ' ฐาน ' . number_format($this->base);
        $this->expand = $this->typeLabel . $base;
    }
    protected function isNearPrimaryBase(int $num1, int $num2): bool
    {
        $isNearUpper = $this->getFirstDigit($num1) > 6 && $this->getFirstDigit($num2) > 6;
        $isNearLower = $this->getFirstDigit($num1) < 4 && $this->getFirstDigit($num2) < 4;
        $isLengthMore=$this->getLength($num1)>2 && $this->getLength($num2)>2;
        return $isLengthMore && ($isNearUpper || $isNearLower);
    }

    protected function getLength($num):int
    {
        return strlen((string)$num);
    }
    protected function isDiffDigitsOne(int $num1, int $num2): bool
    {
        return abs(strlen((string)$num1) - strlen((string)$num2)) === 1;
    }

    protected function isFirstDigitOne(int $num1, int $num2): bool
    {
        return substr((string)$num1, 0, 1) === "1" && substr((string)$num2, 0, 1) === "1";
    }

    protected function isEqualDigits(int $num1, int $num2): bool
    {
        return strlen((string)$num1) === strlen((string)$num2);
    }

    protected function setQuestion(int $num1, $num2): void
    {
        $this->question = number_format($num1) . ' &times; ' . number_format($num2);
    }

    protected function isNearUpperBase(int $num1, int $num2): bool
    {
        return $this->getSecondDigit($num1) > 5 && $this->getSecondDigit($num2) > 5;
    }

    protected function isNearLowerBase(int $num1, int $num2): bool
    {
        return $this->getSecondDigit($num1) < 5 && $this->getSecondDigit($num2) < 5;
    }

    protected function getShiftLength(int $firstDigit, int $numDigits): int
    {
        return $firstDigit > 6 ? $numDigits : $numDigits - 1;
    }

    protected function getBase(int $num): int
    {
        $numDigits = $this->countDigits($num);
        $numDigits += $this->getFirstDigit($num) > 6 ? 0 : -1;
        return 10 ** $numDigits;
    }

    protected function getSign($num, $lenght): string
    {
        return $num < 0 ? ('- ' . str_pad(abs($num), $lenght, 0, STR_PAD_LEFT)) : ('+ ' . str_pad($num, $lenght, 0, STR_PAD_LEFT));
    }

    protected function getFirstDigit($num): int
    {
        return intVal(substr((string)$num, 0, 1));
    }

    protected function getSecondDigit($num): int
    {
        return intVal(substr((string)$num, 1, 1));
    }

    protected function isSameDigits(int $num1, int $num2): bool
    {
        return $this->countDigits($num1) === $this->countDigits($num2);
    }

    protected function  countDigits(int $number): int
    {
        // แปลงตัวเลขเป็นสตริง
        $numberStr = strval($number);

        // นับความยาวของสตริง
        return strlen($numberStr);
    }

    protected function gcd($a, $b)
    {
        if ($b == 0) {
            return $a;
        }
        return $this->gcd($b, $a % $b);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.solutions.multiplication-base-shift');
    }
}
