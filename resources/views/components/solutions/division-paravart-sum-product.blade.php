@props(['tables','product','isMore'])
<div {{ $attributes }}>
    <span>ผลหารรวมกันได้</span>
    @foreach ($tables as $table)
        <span>{{ $table->product>=0?$table->product:'('.$table->product.')' }}</span>
        <span>{{ $loop->last ? '' : ' + ' }}</span>
    @endforeach
    <x-solutions.division-more :$isMore />
    <span> = {{ $product }}</span>
</div>
