@props(['remainder','divisor','isMore'])
<div {{ $attributes->merge(['class'=>'mt-1 mb-2']) }}>
    <span>เศษ {!! number_format($remainder) !!}</span>
    @if ($remainder >= $divisor)
        <span> ≥ {{ number_format($divisor) }} หารต่อ</span>
    @endif
    
    <x-solutions.division-more :is-more="$isMore" />
</div>