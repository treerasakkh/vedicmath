<x-frame class="p-16">
    <x-item class="absolute top-6 left-6">{{ $item }}</x-item>
    <x-question class="absolute top-7 left-14">{{ $question }}</x-question>
    <div class=' absolute top-12 left-14 text-[10px] text-gray-600'>(ใช้วิธีนิขิลัม)</div>

    @if ($showSolution == true)
        <table class="mt-8">
            <tr class="relative after:absolute after:content-['+'] after:top-4">{!! $row1 !!}
            </tr>
            <tr class="border-b border-b-gray-400">{!! $row2 !!}</tr>
            <tr class=" text-red-500">{!! $row3 !!}</tr>
            <tr class="border-t border-b-4 border-double border-gray-400 *:w-5">{!! $row4 !!}</tr>
        </table>
    @else
        <table class="mt-8">
            <tr class="relative after:absolute after:content-['+'] after:top-4">{!! $row1 !!}
            </tr>
            <tr class="border-b border-b-gray-400">{!! $blank !!}</tr>
            <tr>{!! $blank !!}</tr>
            <tr class="border-t border-b-4 border-double border-gray-400 *:w-5">{!! $blank !!}</tr>
        </table>
    @endif
</x-frame>
