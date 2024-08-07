<?php
namespace App\View\Components\Solutions;

use App\Traits\EasyArray;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdditionDot extends Component
{
    use EasyArray;

    public $showSolution;
    public $question;
    public $product;
    public $solutionRows;
    public $questionRows;
    public $blank;
    public $item;
    public function __construct(array $numbers , bool $showSolution,int $item) 
    {

        $this->item = $item;

        $product = array_sum($numbers);
        $this->showSolution = $showSolution;
        $this->question = implode(' + ', $numbers);
        $maxDecimalPlace = $this->maxDecimalPlace($numbers);
        $countNumbers = count($numbers);

        // ทำให้แต่ละจำนวนอยู่ในรูปทศนิยมที่มีตำแหน่งเท่ากัน
        $numbers = array_map(fn($num) => number_format($num, $maxDecimalPlace, '.', ''), $numbers);

        // หาจำนวนหลักที่มากที่สุด
        $maxDigits = max(array_map('strlen', $numbers)) + 1;

        // ทำให้มีหลักเท่ากัน
        $originalNumbers = array_map(fn($num) => $this->make($num)->padLeft($maxDigits, '&nbsp;')->get(), $numbers);
        $numbers = array_map(fn($num) => $this->make($num)->padLeft($maxDigits, 0)->get(), $numbers);

        // หาคำตอบ
        $keeper = 0;
        $walker = 0;
        for ($col = $maxDigits - 1; $col > -1; $col--) {
            for ($row = 0; $row < $countNumbers; $row++) {
                if ($numbers[0][$col] == '.') continue;

                if ($row == 0) {
                    $walker = $numbers[0][$col] + $keeper;
                    $keeper = 0;
                } else {
                    $walker += $numbers[$row][$col];
                }

                if ($walker > 9) {
                    $numbers[$row][$col] = view('components.solutions.box-dot',['digit'=>$numbers[$row][$col]])->render();
                    // $numbers[$row][$col] = '<span class="dot">' . $numbers[$row][$col] . '</span>';
                    $walker -= 10;
                    $keeper += 1;
                }
            }
        }

        // เคลียร์ 0 สำหรับคำตอบ
        foreach ($numbers as &$numArray) {
            foreach ($numArray as &$digit) {
                if ($digit != 0) break;
                $digit = '&nbsp;';
            }
        }

        // ทำให้อยู่ในรูปคอลัมน์ของแถว
        $this->solutionRows = array_map(fn($x) => '<td>' . implode('</td><td>', $x) . '</td>', $numbers);
        $this->questionRows = array_map(fn($x) => '<td>' . implode('</td><td>', $x) . '</td>', $originalNumbers);

        // product ให้เป็นทศนิยมที่เท่ากับโจทย์
        $productFormatted = number_format($product, $maxDecimalPlace, '.', '');
        $productArray = $this->make($productFormatted)->padLeft($maxDigits, '&nbsp;')->get();
        $this->product = '<td>' . implode('</td><td>', $productArray) . '</td>';

        // แถวว่าง
        $blankArray = $this->make([])->padLeft($maxDigits, '&nbsp;')->get();
        $this->blank = '<td>' . implode('</td><td>', $blankArray) . '</td>';
    }

    private function maxDecimalPlace(array $numbers): int
    {
        return max(array_map(fn($num) => strlen(explode('.', strval($num))[1] ?? ''), $numbers));
    }

    public function render(): View|Closure|string
    {
        return view('components.solutions.addition-dot');
    }
}
