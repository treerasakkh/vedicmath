<?php

namespace App\View\Components\Answers;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Addition extends Component
{
    public array $numbers;
    public int $item = 0;

    /**
     * Create a new component instance.
     */
    public function __construct($numbers,$item=0)
    {
        $this->numbers = $numbers;
        $this->item = $item;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.answers.addition');
    }
}
