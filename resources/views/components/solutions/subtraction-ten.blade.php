<x-frame class="p-16">
    <x-item class="absolute top-6 left-6">{{ $item }}</x-item>
    <x-question class="absolute top-7 left-14">{{ $question }} </x-question>
    <div class='absolute top-12 left-14 text-[10px] text-gray-600'>(ใช้หลักทบสิบ)</div>
    <table class="mt-10">
        <tr > {!! $row1 !!} </tr>
        <tr class="text-red-500 "> {!! $showSolution ? $row2 : $blank !!} </tr>
        <tr> {!! $showSolution ? $row3 : $blank !!} </tr>
        <tr class="border-t border-b-4 border-double border-gray-400 *:w-5"> {!! $showSolution ? $row4 : $blank !!} </tr>
    </table>
    <x-solutions.box-minus class="pt-16" />
</x-frame>
