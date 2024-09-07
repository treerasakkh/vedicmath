<div class="relative border rounded-sm pt-12 pl-6 pb-4">
    <x-item class="absolute top-4 left-6">{{ $item ?? 0 }}</x-item>
    <x-question class="absolute top-4 left-14">
        {!! $question ?? 'question?' !!}
        @if ($showLabel)
            <span class="text-xs text-gray-400">(หารโดยใช้วิธีนิขิลัม)</span>
        @endif
    </x-question>

    @if ($showSolution)
        @foreach ($solutions as $solution)
            <x-solutions.division-nikhilam-table :table="$solution->arrTable" :column-line="$solution->columnVerticalLine" :horizon-line="$solution->beginHorizonLine" />
            <x-solutions.division-nikhilam-remainder :remainder="$solution->remainder" :divisor="$solution->divisor" :is-more="$loop->last && $isMoreThreeTables" />
        @endforeach

        @if (count($solutions) > 1)
            <x-solutions.division-nikhilam-sum-product :$arrProducts :$product :$isMoreThreeTables />
        @endif

        <x-solutions.division-answer :product="$product" :remainder="$remainder" />
    @else
        <x-solutions.division-blank-table :num-rows="$isM13 ? 15 : 15" :num-columns="9" />
    @endif
</div>
