@props(['left'=>'','middle'=>'','right'=>''])

<div {{ $attributes->merge(["class"=>"flex"]) }}>
    <div class="w-28 px-4 text-right">{!! $left !!}</div>
    <div class="w-4 px-4 text-center ">{!! $middle !!}</div>
    <div class="w-24 px-4 text-right">{!! $right !!}</div>
</div>