<?php

namespace App\View\Components\Solutions;

use App\Traits\EasyArray;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SubtractionDirect extends Component
{
    use EasyArray;
    /**
     * Create a new component instance.
     */
    public $row1;
    public $row2;
    public $row3;
    public $row4;
    public $blank;
    public $showSolution;
    public $question;
    public $item;

    public function __construct(int $num1, int $num2, bool $showSolution, int $item)
    {

        $this->showSolution = $showSolution;
        $this->item = $item;
        $this->question = number_format($num1) . " - " . number_format($num2);

        $product = $num1 - $num2;
        $maxDigits = strlen('' . $num1);
        $num1Array = $this->make($num1)->padLeft($maxDigits + 1, 0)->get();
        $num2Array = $this->make($num2)->padLeft($maxDigits + 1, 0)->get();
        $blankArray = $this->make([])->padLeft($maxDigits + 1, '&nbsp;')->get();
        $subColumnArray = $this->make([])->padLeft($maxDigits + 1, 0)->get();

        for ($i = 0; $i < $maxDigits; $i++) {
            $subColumn = $num1Array[$i] - $num2Array[$i];
            $subColumnArray[$i] = $subColumn < 0 ? '<span class="bar">' . abs($subColumn) . '</span>' : $subColumn;
        }

        $num1Array = $this->make($num1Array)->clearFrontZero()->get();
        $num2Array = $this->make($num2Array)->clearFrontZero()->get();
        $subColumnArray = $this->make($subColumnArray)->clearFrontZero()->get();
        $productArray = $this->make($product)->padLeft($maxDigits+1, '')->get();

        $this->row1 = '<td>' . implode('</td><td>', $num1Array) . '</td>';
        $this->row2 = '<td>' . implode('</td><td>', $num2Array) . '</td>';
        $this->row3 = '<td>' . implode('</td><td>', $subColumnArray) . '</td>';
        $this->row4 = '<td>' . implode('</td><td>', $productArray) . '</td>';
        $this->blank = '<td>' . implode('</td><td>', $blankArray) . '</td>';
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.solutions.subtraction-direct');
    }
}
