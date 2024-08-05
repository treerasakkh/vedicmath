<?php

namespace App\View\Components\Solutions;

use App\Traits\EasyArray;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MultiplicationAligned extends Component
{
    use EasyArray;
     /**
     * Create a new component instance.
     */
    public  $row1;
    public  $row2;
    public  $solutionrows;
    public  $product;
    public  $blank;
    public  $showSolution;
    private $maxDigits;

    public $item;

    public function __construct(int $num1, int $num2, bool $showSolution,int $item)
    {
        //

        $this->item = $item;
        $this->showSolution = $showSolution;
        $product = $num1 * $num2;

        $maxNumber = max($num1, $num2);
        $maxNumberDigits = strlen('' . $maxNumber);
        $this->maxDigits = 2 * $maxNumberDigits;

        $lenNum1 = strlen('' . $num1);
        $lenNum2 = strlen('' . $num2);
        $matchFunction = 'solve' . $lenNum1 . $lenNum2;

        $solutionrows = match ($matchFunction) {
            'solve22' => $this->solve22($num1, $num2),
            'solve32' => $this->solve32($num1, $num2),
            'solve33' => $this->solve33($num1, $num2),
            'solve42' => $this->solve42($num1, $num2),
            'solve43' => $this->solve43($num1, $num2),
            'solve44' => $this->solve44($num1, $num2),
        };

        // dd($solutionrows);
        $row1 = $this->make($num1)->padLeft($this->maxDigits, '')->get();
        $row2 = $this->make($num2)->padLeft($this->maxDigits, '')->get();
        $product = $this->make($product)->padLeft($this->maxDigits, '')->get();
        $blank = $this->make([])->padLeft($this->maxDigits, '&nbsp;')->get();

        $this->row1 = '<td class="pl-4  w-10 border">' . implode('</td><td class="border">', $row1) . '</td>';
        $this->row2 = '<td class="pl-4  w-10 border">' . implode('</td><td class="border">', $row2) . '</td>';
        $this->product = '<td class="pl-4  w-10 border">' . implode('</td><td class="border">', $product) . '</td>';
        $this->blank = '<td class="pl-4  w-10 border">' . implode('</td><td class="border">', $blank) . '</td>';

        $numSolutionrows = count($solutionrows);

        for ($i = 0; $i < $numSolutionrows; $i++) {
            $solutionrows[$i] = '<td class="pl-4  w-10 border">' . implode('</td><td class="border">', $solutionrows[$i]) . '</td>';
        }
        // dd($solutionrows);

        $this->solutionrows = $solutionrows;
    }

    private function solve22($num1, $num2)
    {
        $num1 = $this->make($num1)->get();
        $num2 = $this->make($num2)->get();

        $row1 = [...$this->createTwoDigits($num2[0] * $num1[0]), ...$this->createTwoDigits($num2[1] * $num1[1])];
        $row2 = ['', ...$this->createTwoDigits($num2[1] * $num1[0]), ''];
        $row3 = ['', ...$this->createTwoDigits($num2[0] * $num1[1]), ''];

        return [$row1, $row2, $row3];
    }

    private function solve32($num1, $num2)
    {
        $num1 = $this->make($num1)->get();
        $num2 = $this->make($num2)->get();

        $row1 = ['', '', ...$this->createTwoDigits($num2[1] * $num1[0]), ...$this->createTwoDigits($num2[1] * $num1[2])];
        $row2 = ['', '', '', ...$this->createTwoDigits($num2[1] * $num1[1]), ''];
        $row3 = ['', ...$this->createTwoDigits($num2[0] * $num1[0]), ...$this->createTwoDigits($num2[0] * $num1[2]), ''];
        $row4 = ['', '', ...$this->createTwoDigits($num2[0] * $num1[1]), '', ''];
        return [$row1, $row2, $row3, $row4];
    }
    private function solve33($num1, $num2)
    {
        $num1 = $this->make($num1)->get();
        $num2 = $this->make($num2)->get();

        $row1 = ['', '', ...$this->createTwoDigits($num2[2] * $num1[0]), ...$this->createTwoDigits($num2[2] * $num1[2])];
        $row2 = ['', ...$this->createTwoDigits($num2[0] * $num1[1]), ...$this->createTwoDigits($num2[2] * $num1[1]), ''];
        $row3 = ['', ...$this->createTwoDigits($num2[1] * $num1[0]), ...$this->createTwoDigits($num2[1] * $num1[2]), ''];
        $row4 = ['', '', ...$this->createTwoDigits($num2[1] * $num1[1]), '', ''];
        $row5 = [...$this->createTwoDigits($num2[0] * $num1[0]), ...$this->createTwoDigits($num2[0] * $num1[2]), '', ''];

        return [$row1, $row2, $row3, $row4, $row5];
    }
    private function solve42($num1, $num2)
    {
        $num1 = $this->make($num1)->get();
        $num2 = $this->make($num2)->get();

        $row1 = ['', '', '', '', ...$this->createTwoDigits($num2[1] * $num1[1]), ...$this->createTwoDigits($num2[1] * $num1[3])];
        $row2 = ['', '', '', ...$this->createTwoDigits($num2[1] * $num1[0]), ...$this->createTwoDigits($num2[1] * $num1[2]), ''];
        $row3 = ['', '', '', ...$this->createTwoDigits($num2[0] * $num1[1]), ...$this->createTwoDigits($num2[0] * $num1[3]), ''];
        $row4 = ['', '', ...$this->createTwoDigits($num2[0] * $num1[0]), ...$this->createTwoDigits($num2[0] * $num1[2]), '', ''];

        return [$row1, $row2, $row3, $row4];
    }
    private function solve43($num1, $num2)
    {
        $num1 = $this->make($num1)->get();
        $num2 = $this->make($num2)->get();

        $row1 = ['', '', '', '', ...$this->createTwoDigits($num2[2] * $num1[1]), ...$this->createTwoDigits($num2[2] * $num1[3])];
        $row2 = ['', '', '', ...$this->createTwoDigits($num2[2] * $num1[0]), ...$this->createTwoDigits($num2[2] * $num1[2]), ''];
        $row3 = ['', '', '', ...$this->createTwoDigits($num2[1] * $num1[1]), ...$this->createTwoDigits($num2[1] * $num1[3]), ''];
        $row4 = ['', '', ...$this->createTwoDigits($num2[1] * $num1[0]), ...$this->createTwoDigits($num2[1] * $num1[2]), '', ''];
        $row5 = ['', '', ...$this->createTwoDigits($num2[0] * $num1[1]), ...$this->createTwoDigits($num2[0] * $num1[3]), '', ''];
        $row6 = ['',  ...$this->createTwoDigits($num2[0] * $num1[0]), ...$this->createTwoDigits($num2[0] * $num1[2]), '', '',''];

        return [$row1, $row2, $row3, $row4, $row5, $row6];
    }
    private function solve44($num1, $num2)
    {
        $num1 = $this->make($num1)->get();
        $num2 = $this->make($num2)->get();

        $row1 = ['', '', '', '', ...$this->createTwoDigits($num2[3] * $num1[1]), ...$this->createTwoDigits($num2[3] * $num1[3])];
        $row2 = ['', '', '', ...$this->createTwoDigits($num2[3] * $num1[0]), ...$this->createTwoDigits($num2[3] * $num1[2]), ''];
        $row3 = ['', '', '', ...$this->createTwoDigits($num2[2] * $num1[1]), ...$this->createTwoDigits($num2[2] * $num1[3]), ''];
        $row4 = ['', '', ...$this->createTwoDigits($num2[2] * $num1[0]), ...$this->createTwoDigits($num2[2] * $num1[2]), '', ''];
        $row5 = ['', '', ...$this->createTwoDigits($num2[1] * $num1[1]), ...$this->createTwoDigits($num2[1] * $num1[3]), '', ''];
        $row6 = ['',  ...$this->createTwoDigits($num2[1] * $num1[0]), ...$this->createTwoDigits($num2[1] * $num1[2]), '', '',''];
        $row7 = ['',...$this->createTwoDigits($num2[0] * $num1[1]), ...$this->createTwoDigits($num2[0] * $num1[3]), '', '',''];
        $row8 = [...$this->createTwoDigits($num2[0] * $num1[0]), ...$this->createTwoDigits($num2[0] * $num1[2]), '', '','',''];
        return [$row1, $row2, $row3, $row4, $row5, $row6,$row7,$row8];

    }

    private function createTwoDigits($number)
    {
        return $this->make($number)->padLeft(2, 0)->get();
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.solutions.multiplication-aligned');
    }
}
