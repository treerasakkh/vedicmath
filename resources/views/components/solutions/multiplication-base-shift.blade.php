<x-frame class="block">
    <x-item class="absolute top-4 left-4">{{ $item }}</x-item>
    <div class="mt-8">
        <div class="w-[100%]">
            <x-solutions.mbs-row :left="$row1Left" :middle="$row1Middle" :right="$row1Right" />
            <x-solutions.mbs-row :left="$row2Left" :middle="$row2Middle" :right="$row2Right" class="border-b border-b-gray-400"  />
            <x-solutions.mbs-row :left="$row3Left" :middle="$row3Middle" :right="$row3Right" class="border-b-4 border-b-gray-400 border-double pt-4" />
            <div class="mt-4 ">ดังนั้น {{ $num1 }} &times; {{ $num2 }} = {!! $resultLeftStr.$resultRightStr !!}</div>
            <div class="mt-1"><span class="border-b-4 border-b-gray-400 border-double">ตอบ </span>{{ number_format($product) }}</div>
        </div>
    </div>
</x-frame>
