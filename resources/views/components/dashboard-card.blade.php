@props(['heading', 'title', 'subtitle', 'url'])
<a href="{{ $url }}">
    <div
        {{ $attributes->merge(['class' => 'border px-2 py-4 rounded-sm relative h-40 flex justify-center items-center ']) }}>
        <div class="absolute top-2 left-4 text-gray-400 ">{{ $heading }}</div>
        <div class="text-center">
            <div class="text-lg">{{ $title }}</div>
            <div class="text-gray-400 text-sm">{{ $subtitle }}</div>

        </div>
    </div>
</a>
