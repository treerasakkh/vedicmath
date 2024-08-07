@props(['left'=>'','middle'=>'','right'=>''])

<div {{ $attributes->merge(["class"=>"flex"]) }}>
    <div class="w-auto px-4 text-right">{{ $left }}</div>
    <div class="w-4 px-4 text-center border-b">{{ $middle }}</div>
    <div class="w-20 px-4 text-right">{!! $right !!}</div>
</div>