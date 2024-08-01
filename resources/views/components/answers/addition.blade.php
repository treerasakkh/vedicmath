<div class="border p-4">
    <div class="text-sm">ข้อ {{ $item }}</div>
    <div class="flex justify-end">
        <div>
            @foreach ($numbers as $number)
                <div class="text-right tracking-widest">{{ $number }}</div>
            @endforeach
        </div>
        <div class="flex items-center pl-1">+</div>
    </div>
    <div class="grid grid-cols-8">
        <div class="col-span-3">&nbsp;</div>
        <div class="col-span-5 border-t border-b-4 border-double border-gray-500">&nbsp;</div>
    </div>
</div>
