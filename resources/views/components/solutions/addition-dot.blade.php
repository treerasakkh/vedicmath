<x-frame>
    <x-item class="absolute top-4 left-6">{{ $item }}</x-item>
    @if ($showSolution == true)
        <table >
            @foreach ($solutionRows as $row)
                <tr class="{{ ($loop->index==0?'plus-sign':'').' *:w-5' }}"> {!! $row !!}</tr>
            @endforeach
            <tr class="border-t border-b-4 border-double border-gray-400 *:w-6">{!! $product !!}</tr>
        </table>
    @else
        <table>
            @foreach ($questionRows as $row)
                <tr class="{{ ($loop->index==0?'plus-sign':'').' *:w-5' }}"> {!! $row !!}</tr>
            @endforeach
            <tr class="border-t border-b-4 border-double border-gray-400 *:w-6">{!! $blank !!}</tr>
        </table>
    @endif
</x-frame>