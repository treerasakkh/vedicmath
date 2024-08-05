<x-frame class="p-16">
    <x-item class="absolute top-4 left-4">{{ $item }}</x-item>
    <div class="absolute left-6 top-12 text-[12px] text-gray-600 w-16">(แนวตั้งและแนวไขว้)</div>

    @if ($showSolution == true)
        <table class="mt-8">
            <tr class="relative after:absolute after:content-['x'] after:top-3 after:-right-3">{!! $row1 !!}</tr>
            <tr class="border-b border-b-gray-400">{!! $row2 !!}</tr>
            <tr>{!! $row3 !!}</tr>
            <tr class="border-t border-b-4 border-double border-gray-400 *:w-6 font-semibold">{!! $row4 !!}</tr>
        </table>
    @else
        <table class="mt-8">
            <tr class="relative after:absolute after:content-['x'] after:top-3 after:-right-3">{!! $row1 !!}</tr>
            <tr class="border-b border-b-gray-400">{!! $row2 !!}</tr>
            <tr>{!! $blank !!}</tr>
            <tr class="border-t border-b-4 border-double border-gray-400 *:w-6 ">{!! $blank !!}</tr>
        </table>
    @endif
</x-frame>
