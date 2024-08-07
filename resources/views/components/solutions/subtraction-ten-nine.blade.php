<x-frame class="p-16">
    <x-item class="absolute top-6 left-6">{{ $item }}</x-item>
    <x-question class="absolute top-7 left-14">{{ $question }}</x-question>
    <div class="absolute top-14 left-14 text-[10px] text-gray-600">(ใช้หลักทบสิบทบเก้า)</div>

    <div class="mt-5 flex">
        <table class="mt-10">
            <tr >{!! $row1 !!}</tr>
            <tr>{!! $showSolution ? $row2 : $blank !!}</tr>
            <tr class="border-t border-b-4 border-double border-gray-400 *:w-5">{!! $showSolution ? $row3 : $blank !!}</tr>
        </table>
        <x-solutions.box-plus class="pt-14" />
    </div>
</x-frame>
