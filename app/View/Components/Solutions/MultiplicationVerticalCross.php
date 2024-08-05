<?php

namespace App\View\Components\Solutions;

use App\Traits\EasyArray;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MultiplicationVerticalCross extends Component
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
    public $item;

    public function __construct(int $num1, int $num2, bool $showSolution,int $item)
    {
        //
        $this->showSolution = $showSolution;
        $this->item = $item;
        $product = $num1 * $num2;
        $maxNumber = max($num1, $num2);
        $maxNumberDigits = strlen($maxNumber . '');
        $maxDigits = 2 * $maxNumberDigits;
        $num1Array = $this->make($num1)->padLeft($maxDigits, 0)->get();
        $num2Array = $this->make($num2)->padLeft($maxDigits, 0)->get();
        $productArray = $this->make($product)->padLeft($maxDigits, 0)->get();
        $preProductArray = $this->make([])->padLeft($maxDigits, 0)->get();
        $blankArray = $this->make([])->padLeft($maxDigits, '&nbsp;')->get();

        // find product by this method
        // $i for $num1  and $j for $num2
        //วิธีทำ
        for ($i = $maxDigits - 1; $i > $maxNumberDigits-1; $i--) {

            $stand = $num1Array[$i];

            for ($j = $maxDigits - 1; $j > $maxNumberDigits-1; $j--) {
                $runner = $num2Array[$j];
                $temp = $runner * $stand;

                $preProductArray[$i - ($maxDigits - 1 - $j)] += $temp;
            }
        }

        //ห้อยเลขด้านหน้า
        $preProductArray = array_map(fn($x)=>$this->hang($x),$preProductArray);
        //non front zero
        $num1Array = $this->make($num1Array)->clearFrontZero('&nbsp;')->get();
        $num2Array = $this->make($num2Array)->clearFrontZero('&nbsp;')->get();
        $preProductArray = $this->make($preProductArray)->clearFrontZero('&nbsp;')->get();
        $productArray = $this->make($productArray)->clearFrontZero('&nbsp;')->get();

        $this->row1 = '<td class="text-right pr-2 -pl-2">' . implode('</td><td class="text-right pr-2 -pl-2">', $num1Array) . '</td>';
        $this->row2 = '<td class="text-right pr-2 -pl-2">' . implode('</td><td class="text-right pr-2 -pl-2">', $num2Array) . '</td>';
        $this->row3 = '<td class="text-right pr-2 -pl-2">' . implode('</td><td class="text-right pr-2 -pl-2">', $preProductArray) . '</td>';
        $this->row4 = '<td class="text-right pr-2 -pl-2">' . implode('</td><td class="text-right pr-2 -pl-2">', $productArray) . '</td>';
        $this->blank = '<td class="text-right pr-2 -pl-2">' . implode('</td><td class="text-right pr-2 -pl-2">', $blankArray) . '</td>';
    }

    private function hang($x){
        $strX = (string)$x;
        $len = strlen($strX);

        if($len == 1){
            return $x;
        }

        $strHang = substr($strX, 0, $len-1);
        $strNormal = substr($strX, -1);
        return '<sub>'.$strHang.'</sub>'.$strNormal;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.solutions.multiplication-vertical-cross');
    }
}
