<x-frame class="{{ $spaceWide === true ? 'p-16' : 'py-1 px-4' }}">
    <x-item class="absolute left-4 top-4">{{ $item }}</x-item>
    @if ($showLabel)
        <div class="absolute left-6 top-16 text-[12px] text-gray-600 w-16">(จัดตำแหน่งผลคูณ)</div>
    @endif
    <table class="text-center">
        <tr>{!! $row1 !!}</tr>
        <tr class="*:border-b *:border-b-gray-500">{!! $row2 !!}</tr>

        @if ($showSolution)
            @foreach ($solutionrows as $row)
                <tr>{!! $row !!}</tr>
            @endforeach
            <tr class="border-t border-b-4 border-double border-gray-400 *:w-6">{!! $product !!}</tr>
        @else
            @for ($i = 0; $i < count($solutionrows); $i++)
                <tr>{!! $blank !!}</tr>
            @endfor
            <tr class="border-t border-b-4 border-double border-gray-400 *:w-6">{!! $blank !!}</tr>
        @endif
    </table>
    <x-solutions.box-multiply class="pl-1 pt-[12px]" />

</x-frame>
