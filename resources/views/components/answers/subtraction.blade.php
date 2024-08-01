@props(['num1', 'num2','item'])
<div class="flex justify-end border p-4 text-right tracking-widest">
    <div class="w-[50%] text-left text-sm text-gray-500">
        ข้อ {{ $item }}
    </div>
    <div class="w-[40%] mr-2 ">
        <div class="pr-2"> {{ $num1 }}</div>
        <div class="pr-2"> {{ $num2 }}</div>
        <div class="pr-2 border-t border-b-2 border-gray-400">&nbsp;</div>
    </div>
    <div class="w-[10%] flex mt-3 font-bold"> - </div>
</div>
