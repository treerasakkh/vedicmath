@props(['num1', 'num2', 'item'])
<div class="border p-4">
    <div class="grid  grid-cols-4 mb-12 gap-y-3">
        <div class="col-span-1">
            ข้อ {{ $item }}
        </div>
        <div class="col-span-3">
            {{ number_format($num1) }} &divide; {{ number_format($num2) }}
        </div>
        <div class="col-span-1">&nbsp;</div>
        <div class="col-span-3">
            <span class="border-b-4 border-gray-400 border-double">ตอบ</span>
        </div>
    </div>
</div>
