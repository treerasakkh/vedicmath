<?php

namespace App\View\Components\Solutions;

use App\Traits\EasyArray;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SubtractionTen extends Component
{
    use EasyArray;
    public $row1;
    public $row2;
    public $row3;
    public $row4;
    public $blank;
    public $showSolution;
    public $question;
    public $item;
    public $numDashes = 0;
    public $showLabel;
    /**
     * Create a new component instance.
     */
    public function __construct(int $num1, int $num2, bool $showSolution,int $item,bool $showLabel=true)
     {

        $this->item = $item;
        $product = $num1 - $num2;
        $this->showSolution = $showSolution;
        $this->showLabel = $showLabel;
        $fnum1 =number_format($num1);
        $fnum2 =number_format($num2);
        $this->question = "{$fnum1} - {$fnum2}";

        $maxDigits = floor(log($num1, 10)) + 2;
        $row1 = $this->make($num1)->padLeft($maxDigits, 0)->get();
        $row2 = $this->make([])->padLeft($maxDigits, '')->get();
        $row3 = $this->make($num2)->padLeft($maxDigits, 0)->get();
        $blank = $this->make([])->padLeft($maxDigits, '&nbsp;')->get();
        $row3Original = $row3;
        $row4 = $this->make($product)->padLeft($maxDigits, '')->get();

        $keeper = 0;
        for ($i = $maxDigits - 1; $i > -1; $i--) {

            if ($row3Original[$i] + $keeper > $row1[$i]) {
                $row2[$i] = (10 - ($row3Original[$i] + $keeper));
                $row3[$i - 1] = '<span class="dash">' . $row3[$i - 1] . '</span>';
                $keeper = 1;
                $this->numDashes++;
            } else {
                $keeper = 0;
            }
        }

        $row1 = $this->make($row1,)->clearFrontZero('&nbsp;')->get();
        $row3 = $this->make($row3,)->clearFrontZero('&nbsp;')->get();
        $row2 = array_map(function ($x) {
            return $x != '' ? view('components.solutions.box-front-plus',['digit'=>$x])->render() : '&nbsp;';
            // return $x != '' ? '<span class="front-plus">' . $x . '</span>' : '&nbsp;';
        }, $row2);



        $this->row1 = '<td>' . implode('</td><td>', $row1) . '</td>';
        $this->row2 = '<td>' . implode('</td><td >', $row2) . '</td>';
        $this->row3 = '<td>' . implode('</td><td>', $row3) . '</td>';
        $this->row4 = '<td>' . implode('</td><td>', $row4) . '</td>';

        $this->blank = '<td>' . implode('</td><td>', $blank) . '</td>';
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.solutions.subtraction-ten');
    }
}
