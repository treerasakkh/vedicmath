<?php

namespace App\View\Components\Solutions;

use App\Traits\EasyArray;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SubtractionTenNine extends Component
{
    use EasyArray;
        /**
         * Create a new component instance.
         */
        public $row1;
        public $row2;
        public $row3;
        public $blank;
        public $showSolution;
        public $question;
        public $item=0;
        public function __construct(int $num1,int $num2,bool $showSolution,int $item)
        {

            $product = $num1 - $num2;
            $this->showSolution = $showSolution;
            $this->item = $item;
            $fNum1 = number_format($num1);
            $fNum2 = number_format($num2);
            $this->question ="{$fNum1} - {$fNum2}";
            $maxDigits = strlen((string)$num1) +1;
            $num2Digits = strlen((string)$num2);
            $tob109 = 10**$num2Digits - $num2;
            $num1Array = $this->make($num1)->padLeft($maxDigits,'')->get();
            $tob109Array = $this->make($tob109)->padLeft($num2Digits,0)->get();
            $tob109Array = ['<span class="bar text-red-500">1</span>',...$tob109Array];
            $tob109Array = $this->make($tob109Array)->padLeft($maxDigits,'')->get();
            $productArray = $this->make($product)->padLeft($maxDigits,'')->get();
            $blankArray = $this->make([])->padLeft($maxDigits,'&nbsp;')->get();
    
            $this->row1 = '<td >'.implode('</td><td >',$num1Array).'</td>';
            $this->row2 = '<td >'.implode('</td><td >',$tob109Array).'</td>';
            $this->row3 = '<td >'.implode('</td><td >',$productArray).'</td>';
            $this->blank = '<td >'.implode('</td><td >',$blankArray).'</td>';
        }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.solutions.subtraction-ten-nine');
    }
}
