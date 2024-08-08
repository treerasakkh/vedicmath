<x-frame>
    <x-item class="absolute top-4 left-4">{{ $item }}</x-item>
    <div class="absolute top-5 left-16 text-gray-800">
        <div>{{ $question  }}</div>
        <div class="mt-2 text-xs text-gray-500 w-20">{{ $showSolution?'(ใช้วิธีแปลงตัวลบเป็นจำนวนบาร์)':''}}</div>
    </div>
    <table class="w-32  mt-6">
        <tr class="*:w-6">{!! $showSolution?$row1:$blank !!}</tr>
        <tr>{!! $showSolution?$row2:$blank !!}</tr>
        <tr>{!! $showSolution?$row3:$blank !!}</tr>
        <tr>{!! $showSolution?$row4:$blank !!}</tr>
        <tr class="border-t border-b-4 border-double border-gray-400 font-semibold">{!! $showSolution?$product:$blank !!}</tr>
    </table>
    <x-solutions.box-plus class="mt-6 py-10" />
</x-frame>

