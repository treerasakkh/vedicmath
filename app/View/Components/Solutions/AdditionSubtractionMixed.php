<?php

namespace App\View\Components\Solutions;

use App\Traits\EasyArray;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdditionSubtractionMixed extends Component
{
    use EasyArray;
    public $numbers;
    public $item;
    public $showSolution;
    public $question;
    public $row1;
    public $row2;
    public $row3;
    public $row4;
    public $product;
    public $blank ;
    /**
     * Create a new component instance.
     */
    public function __construct(array $numbers, int $item, bool $showSolution)
    {
        $this->numbers = $numbers;
        $this->item = $item;
        $this->showSolution = $showSolution;
        $this->question = $numbers[0] . array_reduce(array_slice($numbers, 1), function ($carry, $number) {

            return $carry . ($number >= 0 ? ' + ' : ' - ') . number_format(abs($number));
        }, '');


        $rows = [];
        $tdRows = [];

        // Process each number in the array
        foreach ($numbers as $number) {
            $arrayNumber = $this->make(abs($number))->padLeft(7, '&nbsp;')->get();

            if ($number < 0) {
                $arrayNumber = array_map(fn ($x) => $x == '&nbsp;' ? '' : '<span class="bar">' . $x . '</span>', $arrayNumber);
            }

            $rows[] = $arrayNumber;
        }

        foreach($numbers as $number){
            $rows[] = $this->make($number)->padLeft(7,0)->get();
        }

        // Convert rows to table data rows
        foreach ($rows as $row) {
            $tdRows[] = '<td>' . implode('</td><td>', $row) . '</td>';
        }

        $arrayProduct = $this->make(array_sum($numbers))->padLeft(7, '&nbsp;')->get();
        $this->product = '<td>' . implode('</td><td>', $arrayProduct) . '</td>';

        // Assign the table rows to class properties
        $this->row1 = $tdRows[0] ?? '';
        $this->row2 = $tdRows[1] ?? '';
        $this->row3 = $tdRows[2] ?? '';
        $this->row4 = $tdRows[3] ?? '';

        $blank =['&nbsp;','&nbsp;','&nbsp;','&nbsp;','&nbsp;'];
        $this->blank = '<td>' . implode('</td><td>', $blank) . '</td>';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.solutions.addition-subtraction-mixed');
    }
}
