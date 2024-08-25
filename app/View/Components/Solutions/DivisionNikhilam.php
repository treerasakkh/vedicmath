<?php

namespace App\View\Components\Solutions;

use App\Traits\EasyArray;
use App\Traits\Hang;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use stdClass;

class DivisionNikhilam extends Component
{
    use EasyArray, Hang;


    public int $dividend;
    public int $divisor;
    public int $product;
    public int $remainder;
    public array $solutions = [];
    public array $arrProducts = [];

    public int $item;
    public string $question;
    public bool $showSolution;
    public bool $isMoreThreeTables = false;
    public bool $isM13;
    /**
     * Create a new component instance.
     */
    public function __construct(int $dividend, int $divisor, int $item, bool $showSolution,bool $isM13 = false)
    {
        $this->dividend = $dividend;
        $this->divisor = $divisor;
        $this->product = intdiv($dividend,$divisor);
        $this->remainder = $dividend % $divisor;
        $this->question = $this->formatQuestion($dividend,$divisor);
        $this->item = $item;
        $this->showSolution = $showSolution;
        $this->solutions =  $this->generateSolutions($dividend,$divisor);
        $this->isM13 = $isM13;

        if (count($this->solutions)==3 && $divisor<=$this->solutions[2]->remainder) {
            $this->isMoreThreeTables = true;
        }

        $this->arrProducts = array_map(fn ($solution) => $solution->arrProduct, $this->solutions);
    }

    /**
     * Format the question string.
     */
    private function formatQuestion(int $dividend, int $divisor): string
    {
        return sprintf('%s &divide; %s', number_format($dividend), number_format($divisor));
    }

    /**
     * Generate the solutions array.
     */
    private function generateSolutions(int $dividend, int $divisor): array
    {
        $solutions = [];
        while (count($solutions) < 3) {
            $solution = $this->solve($dividend, $divisor);
            $solutions[] = $solution;
            if ($solution->remainder < $divisor) break;
            $dividend = $solution->remainder;
        }
        return $solutions;
    }

    
    private function solve(int $dividend, int $divisor): stdClass
    {
        $lenDividend = strlen((string)$dividend);
        $lenDivisor = strlen((string) $divisor);

        //กรณีที่ตัวตั้งและตัวหารมีหลักเท่ากัน ให้สร้างใหม่
        if ($lenDividend == $lenDivisor) {
            $newDigits = $this->make(10 ** ($lenDividend) - $dividend)->padLeft($lenDividend, 0)->get();
            $newDigits = array_map(fn ($x) => -1 * $x, $newDigits);
            $arrDividend = array_merge([1], $newDigits);
            $lenDividend++;
        } else {
            $arrDividend = $this->make($dividend)->get();
        }

        $cutPoint = $lenDividend - $lenDivisor;


        $arrDivisor = $this->make($divisor)->get();
        $arrNikhilam = $this->make(10 ** ($lenDivisor) - $divisor)->padLeft($lenDivisor, 0)->numberAll()->get();

        $beginHorizonLine = $lenDivisor + 2;
        $columnVerticalLine = $lenDivisor + 1 + $cutPoint;
        //สร้างแถวทางซ้าย
        $arrBeginRow = $arrDivisor;
        $arrMiddleRows = [];

        for ($i = 0; $i < $cutPoint; $i++) {
            $arrMiddleRows[] = $i === 0 ? $arrNikhilam : $this->make([])->padLeft($lenDivisor, '')->get();
        }


        $arrLastRow = $this->make([])->padLeft($lenDivisor, '')->get();

        $arrLeft = array_merge([$arrBeginRow], $arrMiddleRows, [$arrLastRow]);

        //สร้างแถวกลางคั่น
        $arrMiddleRows = [];

        for ($i = 0; $i < $cutPoint; $i++) {
            $arrMiddleRows[] = $this->make([''])->get();
        }

        $arrDelimeter = array_merge([[')']], $arrMiddleRows, [['']]);

        //สร้างแถวขวา
        $arrBeginRow = $arrDividend;

        //สร้างแถวว่างๆ ก่อน
        $arrMiddleRows = [];

        for ($i = 0; $i < $cutPoint; $i++) {
            $arrMiddleRows[] = $this->make([''])->padleft($lenDividend, '')->get();
        }

        $arrLastRow = $this->make($arrDividend[0])->padright($lenDividend, '')->get();

        // หาผลคูณ
        for ($i = 0; $i < $cutPoint; $i++) {

            //ผลคูณแต่ละล็อต และผลรวมด้านซ้าย
            for ($j = 0; $j < $lenDivisor; $j++) {
                $product = $arrLastRow[$i] * $arrNikhilam[$j];
                $arrMiddleRows[$i][$j + $i + 1] = $product;
            }

            //หาผลรวมของผลหารตัวต่อไป
            $sum = $arrDividend[$i + 1];
            for ($k = 0; $k < $cutPoint; $k++) {
                $sum += intval($arrMiddleRows[$k][$i + 1]);
            }
            $arrLastRow[$i + 1] = $sum;
        }

        //หาผลรวมของส่วนด้านขวาของตัวตั้ง
        for ($i = $cutPoint; $i < $lenDividend; $i++) {
            $sum = $arrDividend[$i];
            for ($k = 0; $k < $cutPoint; $k++) {
                $sum += intval($arrMiddleRows[$k][$i]);
            }
            $arrLastRow[$i] = $sum;
        }

        $arrProduct = array_slice($arrLastRow, 0, $cutPoint);


        $arrRight = array_merge([$arrDividend], $arrMiddleRows, [$arrLastRow]);

        //รวมเป็นตัวเดียวกัน
        $arrGroup = [];
        for ($i = 0; $i < $cutPoint + 2; $i++) {
            $arrGroup[] = array_merge($arrLeft[$i], $arrDelimeter[$i], $arrRight[$i]);
        }
        //หาเศษ
        $remainder = $this->findRemainder(array_slice($arrLastRow, $cutPoint));
        //ห้อย หรือ บาร์

        for ($col = $lenDivisor; $col < $lenDivisor + $lenDividend + 1; $col++) {
            for ($row = 0; $row < count($arrGroup); $row++) {
                $current = $arrGroup[$row][$col];
                $arrGroup[$row][$col] = is_numeric($current) ? $this->setNumber($arrGroup[$row][$col])->setDigitNormal(1)->formatNumber() : $current;
            }
        }

        return (object)[
            'arrTable' => $arrGroup,
            'remainder' => $remainder,
            'beginHorizonLine' => $beginHorizonLine,
            'columnVerticalLine' => $columnVerticalLine,
            'divisor' => $divisor,
            'arrProduct' => $arrProduct,
        ];
    }

    private function arrayToTable($arr): string
    {
        $tbody = '';
        for ($i = 0; $i < count($arr); $i++) {
            $tbody .= '<tr><td class="border">' . implode('</td><td class="border min-w-6 min-h-6">', $arr[$i]) . '</td></tr>';
        }
        return '<table>' . $tbody . '</table>';
    }
    private function findRemainder($digits): int
    {
        $len = count($digits);

        $remainder = 0;

        for ($i = 0; $i < $len; $i++) {
            $remainder += intval($digits[$len - $i - 1]) * (10 ** $i);
        }

        return $remainder;
    }

    private function generateNumbers(): array
    {
        // สุ่ม $divisor ที่มี 2 หลัก (ตั้งแต่ 10 ถึง 99)
        $divisor = rand(10, 99);

        // สุ่มตัวคูณ $multiplier ที่ทำให้ $dividend มี 3 หลัก
        $multiplier = rand(2, intdiv(999, $divisor));

        // คำนวณ $dividend ที่มี 3 หลักโดยการคูณ $divisor กับ $multiplier
        $dividend = $divisor * $multiplier;

        // ตรวจสอบให้แน่ใจว่า $dividend มี 3 หลัก
        if ($dividend < 100 || $dividend > 999) {
            // ถ้า $dividend ไม่ใช่ 3 หลัก ให้เรียกฟังก์ชันนี้ใหม่
            return $this->generateNumbers();
        }

        return [$dividend, $divisor];
    }




    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.solutions.division-nikhilam');
    }
}
