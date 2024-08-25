@props(['product', 'remainder'])
<div {{ $attributes }}>
    <span class="border-b-4 border-double border-black ">ตอบ</span>
    <span>{{ number_format($product) }}</span>

    @if ($remainder != 0)
        <span>เศษ {{ number_format($remainder) }}</span>
    @endif

</div>
