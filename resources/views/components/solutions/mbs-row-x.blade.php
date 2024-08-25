@props(['number','multiply'])
<div class="relative">
    {{ $number }}
    <div class="absolute -right-6 top-0 text-red-500">&times;{{ $multiply }}</div>
</div>