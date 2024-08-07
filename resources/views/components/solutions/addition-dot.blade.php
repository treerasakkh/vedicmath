<x-frame>
    <x-item class="absolute top-4 left-6">{{ $item }}</x-item>
    <table>
        @foreach ($showSolution ? $solutionRows : $questionRows as $row)
            <tr class=" *:w-5">
                {!! $row !!}
            </tr>
        @endforeach
        <tr class="border-t border-b-4 border-double border-gray-400 *:w-6">
            {!! $showSolution ? $product : $blank !!}
        </tr>
    </table>
    <x-solutions.box-plus />
</x-frame>
