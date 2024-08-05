<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Frame extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return <<<'blade'
<div {{$attributes->merge(["class"=>"relative border border-gray-300 rounded-md p-6 flex justify-end"]) }}>
    {{$slot}}
</div>
blade;
    }
}
