<x-frame class="py-1 px-4">
    <x-item class="absolute left-4 top-4">{{ $item }}</x-item>
    <div class="absolute left-6 top-16 text-[12px] text-gray-600 w-16">(จัดตำแหน่งผลคูณ)</div>
    @if($showSolution == true)
    <table class="text-center">
        <tr class="relative after:absolute after:content-['x'] after:top-3 after:-right-3">{!! $row1 !!}</tr>
        <tr class="*:border-b *:border-b-gray-500">{!! $row2 !!}</tr>
        @foreach ($solutionrows as $row )
            <tr>{!! $row !!}</tr>
        @endforeach
        <tr class="border-t border-b-4 border-double border-gray-400 *:w-6">{!! $product !!}</tr>
    </table>
    @else
    <table class="text-center">
        <tr class="relative after:absolute after:content-['x'] after:top-3 after:-right-3">{!! $row1 !!}</tr>
        <tr class="*:border-b *:border-b-gray-500">{!! $row2 !!}</tr>

        @for($i = 0; $i < count($solutionrows);$i++)
            <tr>  {!! $blank !!}  </tr>
        @endfor
        <tr class="border-t border-b-4 border-double border-gray-400 *:w-6">{!! $blank !!}</tr>
    </table>
    @endif
</x-frame>