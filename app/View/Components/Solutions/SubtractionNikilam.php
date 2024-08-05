<?php

namespace App\View\Components\Solutions;

use App\Traits\EasyArray;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SubtractionNikilam extends Component
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

    public function __construct(int $num1, int $num2, bool $showSolution,int $item)
    {

        $this->item = $item;
        $this->showSolution = $showSolution;
        $this->question = number_format($num1).' - '.number_format($num2);

        $product = $num1 - $num2;
        $maxDigits = strlen('' . $num1) + 1;
        $num1Array = $this->make($num1)->padLeft($maxDigits, 0)->numberAll()->get();
        $num2Array = $this->make($num2)->padLeft($maxDigits, 0)->numberAll()->get();
        $nikilamArray = $this->make([])->padLeft($maxDigits, 0)->numberAll()->get();
        $preproductArray = $nikilamArray;
        $blankArray = $this->make([])->padLeft($maxDigits, '&nbsp;')->get();

        for ($i = $maxDigits; $i--; $i > -1) {

            if ($num2Array[$i] > 5) {
                $nikilamArray[$i] = 10 - $num2Array[$i];
                $num2Array[$i - 1] = $num2Array[$i - 1] + 1;
            } else {
                $nikilamArray[$i] = -$num2Array[$i];
            }
        }

        for ($i = 0; $i < $maxDigits; $i++) {
            $preproductArray[$i] = $num1Array[$i] + $nikilamArray[$i];
        }

        $num1Array = $this->make($num1Array)->clearFrontZero()->get();
        
        for ($i = 0; $i < $maxDigits; $i++) {
            
            if($nikilamArray[$i]<0){
                $nikilamArray[$i] = '<span class="bar">'.abs($nikilamArray[$i]).'</span>';
            }

            if($preproductArray[$i]>9){
                $preproductArray[$i] = '<div><sub>1</sub>'.substr(''.$preproductArray[$i],-1).'</div>';
            }

            if($preproductArray[$i]<0){
                $preproductArray[$i] = '<span class="bar">'.abs($preproductArray[$i]).'</span>';
            }
        }
        
        $nikilamArray = $this->make($nikilamArray)->clearFrontZero()->get();
        $preproductArray = $this->make($preproductArray)->clearFrontZero()->get();
        $productArray = $this->make($product)->padleft($maxDigits, '')->get();

        $this->row1 = '<td class="text-right pr-2 -pl-2">' . implode('</td><td class="text-right pr-2 -pl-2">', $num1Array) . '</td>';
        $this->row2 = '<td class="text-right pr-2 -pl-2">' . implode('</td><td class="text-right pr-2 -pl-2">', $nikilamArray) . '</td>';
        $this->row3 = '<td class="text-right pr-2 -pl-2">' . implode('</td><td class="text-right pr-2 -pl-2">', $preproductArray) . '</td>';
        $this->row4 = '<td class="text-right pr-2 -pl-2">' . implode('</td><td class="text-right pr-2 -pl-2">', $productArray) . '</td>';
        $this->blank = '<td class="text-right pr-2 -pl-2">' . implode('</td><td class="text-right pr-2 -pl-2">', $blankArray) . '</td>';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.solutions.subtraction-nikhilam');
    }
}
