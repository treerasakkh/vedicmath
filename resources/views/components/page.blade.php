@props(['pageNumber' => ''])
<section {{ $attributes->merge(['class' => 'sheet padding-20mm relative']) }}>
    <div class="absolute top-12 right-20">{{ $pageNumber }}</div>
    {{ $slot }}
</section>
