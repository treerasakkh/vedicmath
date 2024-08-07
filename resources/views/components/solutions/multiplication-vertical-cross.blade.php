<x-frame class="p-16">
    <x-item class="absolute top-4 left-4">{{ $item }}</x-item>
    <div class="absolute left-6 top-12 text-[12px] text-gray-600 w-16">(แนวตั้งและแนวไขว้)</div>

    <table class="mt-8">
        <tr>{!! $row1 !!}</tr>
        <tr class="border-b border-b-gray-400">{!! $row2 !!}</tr>
        <tr>{!! $showSolution ? $row3 : $blank !!}</tr>
        <tr class="border-t border-b-4 border-double border-gray-400 *:w-6 font-semibold">{!! $showSolution ? $row4 : $blank !!}</tr>
    </table>
    <x-solutions.box-multiply class="mt-8 pl-1 pt-[12px]" />
</x-frame>
