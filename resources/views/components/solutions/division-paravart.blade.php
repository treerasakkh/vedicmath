<x-frame>
    <x-item class="absolute top-4 left-6">{{ $item }}</x-item>
    <x-question class="absolute top-4 left-14">
        {!! $question ?? 'question?' !!}
        @if ($showLabel)
            <span class="text-xs text-gray-400">(หารโดยใช้วิธีพาราวารท)</span>
        @endif
    </x-question>

    <div class="mt-6">

        @if ($showSolution === true)
            @foreach ($tables as $table)
                <x-solutions.division-paravart-table :table="$table" />
                <x-solutions.division-paravart-remainder :remainder="$table->remainder" :$divisor :is-third-table="$loop->iteration === 4" />
            @endforeach

            @if (count($tables) > 1)
                <x-solutions.division-paravart-sum-product :$tables :$product :$isMore />
            @endif

            <x-solutions.division-answer :product="$product" :remainder="$remainder" />
        @else
            <x-solutions.division-blank-table :num-rows="15" :num-columns="9" />
        @endif

    </div>
</x-frame>
